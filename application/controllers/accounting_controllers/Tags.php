<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('tags_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css",
            "assets/css/accounting/accounting_includes/receive_payment.css",
            "assets/css/accounting/accounting_includes/customer_sales_receipt_modal.css",
            "assets/css/accounting/accounting_includes/create_charge.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js",
        ));

		$this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow",   array()),
                array("Expenses",   array('Expenses','Vendors')),
                array("Sales",      array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll",    array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",    array()),
                array("Taxes",      array("Sales Tax","Payroll Tax")),
                array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                // array('/accounting/banking',array()),
                // array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array('/accounting/cashflowplanner',array()),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', '/accounting/jobs')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",   array('/accounting/salesTax','/accounting/payrollTax')),
                array('#',  array()),
                array("",   array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/banking/tags.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/tags', $this->page_data);
    }

    public function get_group_tags()
    {
        $groupTags = $this->tags_model->getGroup();

        $return = [];

        foreach($groupTags as $group) {
            $return['results'][] = [
                'id' => $group['id'],
                'text' => $group['name']
            ];
        }

        echo json_encode($return);
    }

    public function load_all_tags()
    {
        $post = json_decode(file_get_contents('php://input'), true);

        $getTags = $this->tags_model->getTags();

        $tags = [];
        foreach($getTags as $key => $tag) {
            $nameColumn = '';
            if($tag['type'] === 'group' && count($tag['tags']) > 0) {
                $nameColumn .= '<a class="mr-3 cursor-pointer" data-toggle="collapse" data-target="#child-'.$key.'"><i class="fa fa-chevron-down"></i></a>';
            }

            if($tag['type'] === 'group'){
                $nameColumn .= '<span class="'.$tag['type'].'-span-'.$tag['id'].'">'.$tag['name'].' ('.count($tag['tags']).')</span>';
            } else {
                $nameColumn .= '<span class="'.$tag['type'].'-span-'.$tag['id'].'">'.$tag['name'].'</span>';
            }

            $actionsColumn = '';

            if($tag['type'] === 'group') {
                $nameColumn .= '
                <div class="form-group-'.$tag['id'].' hide">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="group_name" value="'.$tag['name'].'" data-id="'.$tag['id'].'" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" id="submiteUpdateTag" data-type="group" data-id="'.$tag['id'].'">Save</button>
                            <button type="button" class="close float-right text-dark" data-type="group" id="closeFormTag" data-id="'.$tag['id'].'" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                </div>';

                $actionsColumn .= '
                <div class="dropdown">
                    <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                        <span class="fa fa-caret-down"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" data-id="'.$tag['id'].'" data-name="'.$tag['name'].'" data-type="group">
                        <li><a href="javascript:void(0);" id="addNewTag" class="dropdown-item" >Add tag</a></li>
                        <li><a href="javascript:void(0);" id="updateTagGroup" class="dropdown-item">Edit group</a></li>
                        <li><a href="javascript:void(0);" id="deleteGroup" class="dropdown-item">Delete group</a></li>
                    </ul>
                </div>';
            } else {
                $nameColumn .= '
                <div class="form-'.$tag['type'].'-'.$tag['id'].' hide">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="tags_name" value="'.$tag['name'].'" data-id="'.$tag['id'].'" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" id="submiteUpdateTag" data-type="'.$tag['type'].'" data-id="'.$tag['id'].'">Save</button>
                            <button type="button" class="close float-right text-dark" data-type="'.$tag['type'].'" id="closeFormTag" data-id="'.$tag['id'].'" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                </div>';

                $actionsColumn .= '
                <div class="dropdown">
                    <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                        <span class="fa fa-caret-down"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" data-id="'.$tag['id'].'" data-type="'.$tag['type'].'">
                        <li><a href="javascript:void(0);" class="dropdown-item" id="updateTagGroup">Edit tag</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item" id="deleteTag" data-tag_id="'.$tag['id'].'">Delete tag</a></li>
                    </ul>
                </div>
                ';
            }

            $tags[] = [
                'name' => $nameColumn,
                'transactions' => '',
                'actions' => $actionsColumn,
                'type' => $tag['type'],
                'parentIndex' => $tag['parentIndex']
            ];
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($getTags),
            'recordsFiltered' => count($getTags),
            'data' => array_slice($tags, 0, 50)
        ];

        echo json_encode($result);
    }

    public function delete($id, $type)
    {
        $result = [];

        $delete = $this->tags_model->delete($id, $type);
        $result['success'] = $delete;
        $result['message'] = $delete ? 'Deleted' : 'Failed';

        echo json_encode($result);
        exit;
    }

    public function update($id, $type)
    {
        $result = [];
        $name = $this->input->post('name');

        $update = $this->tags_model->update($id, $name, $type);
        $result['success'] = $update;
        $result['message'] = $update ? 'Updated' : 'Failed';

        echo json_encode($result);
        exit;
    }

    public function add_group_tag()
    {
        $company_id  = getLoggedCompanyID();
        $new_data = array(
            'name' => $this->input->post('tags_group_name'),
            'company_id' => $company_id,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        );

        $tags = $this->tags_model->addtagGroup($new_data);

        $return = [
            'data' => $tags,
            'success' => $tags !== null ? true : false,
            'message' => $tags !== null ? 'Success' : 'Error'
        ];

        echo json_encode($return);
    }

    public function add_tag()
    {
        $company_id  = getLoggedCompanyID();
        $group_id = $this->input->post('group_id');

        $new_data = array(
            'name' => $this->input->post('tag_name'),
            'company_id' => $company_id,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        );
        
        if (isset($group_id) && $group_id) $new_data['group_tag_id'] = $group_id;


        $tags = $this->tags_model->add($new_data);

        $return = [
            'data' => $tags,
            'success' => $tags !== null ? true : false,
            'message' => $tags !== null ? 'Success' : 'Error'
        ];

        echo json_encode($return);

    }
}