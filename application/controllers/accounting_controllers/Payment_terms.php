<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_terms extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_terms_model');

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
            "assets/js/accounting/terms.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/terms', $this->page_data);
    }

    public function add()
    {
        $data = [
            'company_id' => getLoggedCompanyID(),
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'net_due_days' => $this->input->post('type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
            'discount_days' => 0,
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $term = $this->accounting_terms_model->create($data);
        $name = $data['name'];

        if($term) {
            $this->session->set_flashdata('success', "$name added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/terms');
    }

    public function load_terms()
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

        $terms = $this->accounting_terms_model->getCompanyTerms($order, $status);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($terms) > 0) {
            foreach($terms as $term) {
                if($search !== "") {
                    if(stripos($term['name'], $search) !== false) {
                        $data[] = [
                            'id' => $term['id'],
                            'name' => $term['name'],
                            'type' => $term['type'],
                            'net_due_days' => $term['net_due_days'],
                            'day_of_month_due' => $term['day_of_month_due'],
                            'minimum_days_to_pay' => $term['minimum_days_to_pay'],
                            'status' => $term['status']
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $term['id'],
                        'name' => $term['name'],
                        'type' => $term['type'],
                        'net_due_days' => $term['net_due_days'],
                        'day_of_month_due' => $term['day_of_month_due'],
                        'minimum_days_to_pay' => $term['minimum_days_to_pay'],
                        'status' => $term['status']
                    ];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($terms),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function delete($id)
    {
        $result = [];

        $delete = $this->accounting_terms_model->delete($id);
        $name = $this->accounting_terms_model->getById($id)->name;

        if($delete) {
            $this->session->set_flashdata('success', "$name is now inactive!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function activate($id)
    {
        $result = [];

        $activate = $this->accounting_terms_model->activate($id);
        $name = $this->accounting_terms_model->getById($id)->name;

        if($activate) {
            $this->session->set_flashdata('success', "$name is now active!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function update($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'net_due_days' => $this->input->post('type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
        ];

        $update = $this->accounting_terms_model->updateTerm($id, $data);
        $name = $data['name'];

        if($update) {
            $this->session->set_flashdata('success', "$name updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/terms');
    }
}