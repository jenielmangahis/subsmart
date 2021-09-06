<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_methods extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_payment_methods_model');
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
            "assets/js/accounting/payment-method.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/payment_methods', $this->page_data);
    }

    public function load_payment_methods()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $start = $post['start'];
        $limit = $post['length'];

        $status = [
            1
        ];

        if($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        $paymentMethods = $this->accounting_payment_methods_model->getCompanyPaymentMethods($order, $status);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($paymentMethods) > 0) {
            foreach($paymentMethods as $method) {
                if($search !== "") {
                    if(stripos($method['name'], $search) !== false) {
                        $data[] = [
                            'id' => $method['id'],
                            'name' => $method['name'],
                            'credit_card' => $method['credit_card'],
                            'status' => $method['status']
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $method['id'],
                        'name' => $method['name'],
                        'credit_card' => $method['credit_card'],
                        'status' => $method['status']
                    ];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($paymentMethods),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function add()
    {
        $data = [
            'company_id' => getLoggedCompanyID(),
            'name' => $this->input->post('name'),
            'credit_card' => $this->input->post('credit_card'),
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $paymentMethod = $this->accounting_payment_methods_model->create($data);
        $name = $data['name'];

        if($paymentMethod) {
            $this->session->set_flashdata('success', "$name added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/payment-methods');
    }

    public function inactive($id)
    {
        $result = [];

        $name = $this->accounting_payment_methods_model->getById($id)->name;
        $delete = $this->accounting_payment_methods_model->delete($id);

        if($delete) {
            $this->session->set_flashdata('success', "$name is now inactive!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function activate($id)
    {
        $result = [];

        $activate = $this->accounting_payment_methods_model->activate($id);
        $name = $this->accounting_payment_methods_model->getById($id)->name;

        if($activate) {
            $this->session->set_flashdata('success', "$name is now active!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function edit($id)
    {
        $this->page_data['paymentMethod'] = $this->accounting_payment_methods_model->getById($id);

        $this->load->view('accounting/modals/payment_method_modal', $this->page_data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'credit_card' => $this->input->post('credit_card')
        ];

        $update = $this->accounting_payment_methods_model->updatePaymentMethod($id, $data);

        $name = $data['name'];

        if($update) {
            $this->session->set_flashdata('success', "$name updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/payment-methods');
    }
}