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
            "assets/css/accounting/invoices_page.css",
            "assets/css/accounting/accounting_includes/send_reminder_by_batch_modal.css"
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
            "assets/js/accounting/sales/invoices_page.js",
            "assets/js/accounting/sales/customer_includes/send_reminder_by_batch_modal.js"
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
                // array("Mileage",    array()),
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
                // array('#',  array()),
                array("",   array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/banking/tags/tags.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/tags/index', $this->page_data);
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
        $search = $post['columns'][0]['search']['value'];
        $getTags = $this->tags_model->getTags();

        $tags = [];
        foreach($getTags as $key => $tag) {
            if ($search !== "") {
                if (stripos($tag['name'], $search) !== false) {
                    if ($tag['type'] === 'group-tag') {
                        $groupIdExists = array_search($getTags[$tag['parentIndex']]['id'], array_column($tags, 'id'));

                        if ($groupIdExists === false || $groupIdExists !== false && $getTags[$groupIdExists]['type'] !== 'group') {
                            $childTags = array_filter($getTags[$tag['parentIndex']]['tags'], function($v, $k) use ($search) {
                                return stripos($v['name'], $search) !== false;
                            }, ARRAY_FILTER_USE_BOTH);

                            $childs = [];
                            foreach($childTags as $childTag) {
                                $childs[] = $childTag;
                            }

                            $tags[] = [
                                'id' => $getTags[$tag['parentIndex']]['id'],
                                'name' => $getTags[$tag['parentIndex']]['name'],
                                'transactions' => '',
                                'type' => $getTags[$tag['parentIndex']]['type'],
                                'parentIndex' => $getTags[$tag['parentIndex']]['parentIndex'],
                                'tags' => $childs
                            ];
                        }

                        $idExists = array_search($tag['id'], array_column($tags, 'id'));

                        if ($idExists === false || $idExists !== false && $getTags[$idExists]['type'] !== 'group-tag') {
                            $groupIndex = array_key_last($tags);
                            $tags[] = [
                                'id' => $tag['id'],
                                'name' => $tag['name'],
                                'transactions' => '',
                                'type' => $tag['type'],
                                'parentIndex' => $tag['parentIndex']
                            ];
                        }
                    } elseif ($tag['type'] === 'group') {
                        $groupIdExists = array_search($getTags[$tag['parentIndex']]['id'], array_column($tags, 'id'));

                        if ($groupIdExists === false || $groupIdExists !== false && $getTags[$groupIdExists]['type'] !== 'group') {
                            $tags[] = [
                                'id' => $tag['id'],
                                'name' => $tag['name'],
                                'transactions' => '',
                                'type' => $tag['type'],
                                'parentIndex' => $tag['parentIndex'],
                                'tags' => $tag['tags']
                            ];

                            $parentIndex = array_key_last($tags);
                            foreach ($tag['tags'] as $groupTag) {
                                $tags[] = [
                                    'id' => $groupTag['id'],
                                    'name' => $groupTag['name'],
                                    'transactions' => '',
                                    'type' => 'group-tag',
                                    'parentIndex' => $parentIndex
                                ];
                            }
                        }
                    } else {
                        $tags[] = [
                            'id' => $tag['id'],
                            'name' => $tag['name'],
                            'transactions' => '',
                            'type' => $tag['type'],
                            'parentIndex' => $tag['parentIndex']
                        ];
                    }
                }
            } else {
                $tags[] = [
                    'id' => $tag['id'],
                    'name' => $tag['name'],
                    'transactions' => '',
                    'type' => $tag['type'],
                    'parentIndex' => $tag['parentIndex'],
                ];

                if($tag['type'] === 'group') {
                    $tags[array_key_last($tags)]['tags'] = $tag['tags'];
                }
            }
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

    public function delete_tags()
    {
        $tags = $this->input->post('tags');

        foreach($tags as $tag) {
            $explode = explode('-', $tag);
            $id = $explode[array_key_last($explode)];
            if(stripos($tag, 'tag') !== false) {
                $this->tags_model->delete($id, 'tag');
            } else {
                $this->tags_model->delete($id, 'group');
            }
        }
    }
    
    public function transactions()
    {
        $this->page_data['untagged'] = $this->input->get('untagged') === 'true';
        $this->load->view('accounting/tags/transactions', $this->page_data);
    }
}