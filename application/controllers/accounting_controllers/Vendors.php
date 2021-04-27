<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js"
        ));

		$this->page_data['menu_name'] =
            array(
                array("Dashboard",	array()),
                array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses", 	array('Expenses','Vendors')),
                array("Sales", 		array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll", 	array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",	array()),
                array("Taxes",		array("Sales Tax","Payroll Tax")),
                array("Mileage",	array()),
                array("Accounting",	array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/banking',array()),
                array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', 'credit_notes')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",	array('/accounting/salesTax','/accounting/payrollTax')),
                array('#',	array()),
                array("",	array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/expenses/vendors.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Vendors";
        $this->load->view('accounting/vendors/index', $this->page_data);
    }

    public function load_vendors()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $search = $post['columns'][0]['search']['value'];
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];

        $status = [
            1
        ];

        if($postData['inactive'] === '1' || $postData['inactive'] === 1) {
            array_push($status, 0);
        }

        $vendors = $this->vendors_model->getAllByCompany($status);

        $data = [];

        foreach($vendors as $vendor) {
            if($search !== "") {
                if(stripos($vendor->display_name, $search) !== false) {
                    $data[] = [
                        'id' => $vendor->id,
                        'name' => $vendor->display_name,
                        'company_name' => $vendor->company,
                        'address' => "$vendor->street<br>$vendor->city $vendor->state $vendor->zip",
                        'phone' => $vendor->phone,
                        'email' => $vendor->email,
                        'attachments' => '',
                        'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',')
                    ];
                }
            } else {
                $data[] = [
                    'id' => $vendor->id,
                    'name' => $vendor->display_name,
                    'company_name' => $vendor->company,
                    'address' => "$vendor->street<br>$vendor->city $vendor->state $vendor->zip",
                    'phone' => $vendor->phone,
                    'email' => $vendor->email,
                    'attachments' => '',
                    'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',')
                ];
            }
        }

        usort($data, function($a, $b) use ($order, $columnName) {
            if($order === 'asc') {
                return strcmp($a[$columnName], $b[$columnName]);
            } else {
                return strcmp($b[$columnName], $a[$columnName]);
            }
        });

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($vendors),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function add()
    {
        $id = logged('id');
        $filePath = "./uploads/accounting/vendors/".$id;
        $file_name = "";

        if (!file_exists($filePath)) {
            mkdir($filePath);
        }

		$config['upload_path']  =  $filePath;
        $config['allowed_types']   = 'gif|jpg|png|jpeg|doc|docx|pdf|xlx|xls|csv';
        $config['max_size']        = '20000';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachFiles'))
        {
            $image = $this->upload->data();
            $file_name = $image['file_name'];
        }

        $config = $this->uploadlib->initialize($config);
        $this->load->library('upload',$config);

        $new_data = array(
            'company_id' =>logged('company_id'),
            'title' => $this->input->post('title'),
            'f_name' => $this->input->post('f_name'),
            'm_name' => $this->input->post('m_name'),
            'l_name' => $this->input->post('l_name'),
            'suffix' => $this->input->post('suffix'),
            'email' => $this->input->post('email'),
            'company' => $this->input->post('company'),
            'display_name' => $this->input->post('display_name'),
            'to_display' => $this->input->post('to_display'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'website' => $this->input->post('website'),
            'billing_rate' => $this->input->post('billing_rate'),
            'terms' => $this->input->post('terms'),
            'opening_balance' => $this->input->post('opening_balance'),
            'opening_balance_as_of_date' => $this->input->post('opening_balance_as_of_date'),
            'account_number' => $this->input->post('account_number'),
            'tax_id' => $this->input->post('business_number'),
            'default_expense_account' => $this->input->post('default_expense_amount'),
            'notes' => $this->input->post('notes'),
            'attachments' => $file_name,
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->vendors_model->createVendor($new_data);

        if($addQuery > 0) {
            $this->session->set_flashdata('success', "New vendor successfully added!");
        } else{
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect("accounting/vendors");
    }

    public function view($vendorId)
    {
        add_footer_js(array(
            "assets/js/accounting/expenses/view-vendor.js"
        ));

        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);

        $this->page_data['vendor'] = $vendor;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Vendors";
        $this->load->view('accounting/vendors/view', $this->page_data);
    }
}