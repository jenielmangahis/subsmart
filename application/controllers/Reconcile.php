<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->checkLogin();
        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.modal.css?v='rand()'",
            "assets/css/accounting/sidebar.css",
			"assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css"
        ));

        add_footer_js(array(
            "assets/js/accounting/main.js",
            "assets/plugins/dropzone/dist/dropzone.js"
        ));

		$this->page_data['menu_name'] =
			array(
				array("Dashboard",	array()),
				array("Banking", 	array('Link Bank','Rules','Receipts')),
				array("Expenses", 	array('Expenses','Vendors')),
				array("Sales", 		array('Overview','All Sales','Invoices','Customers','Deposits','Products and Services')),
				array("Payroll", 	array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
				array("Reports",	array()),
				array("Taxes",		array("Sales Tax","Payroll Tax")),
				array("Mileage",	array()),
				array("Accounting",	array("Chart of Accounts","Reconcile"))
			); 
		$this->page_data['menu_link'] = 
			array(
				array('/accounting/banking',array()), 
				array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts')), 
				array("",	array('/accounting/expenses','/accounting/vendors')), 
				array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/invoices','/accounting/customers','/accounting/deposits','/accounting/products-and-services')), 
				array("",	array('#','#','#','#','#')), 
				array('#',	array()), 
				array("",	array('#','#')), 
				array('#',	array()), 
				array("",	array('/accounting/chart_of_accounts','#')), 
			); 
		$this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator"); 
    }
	
	public function index($id)
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['rows']  =  $this->reconcile_model->selectonwhere($id);
		$this->load->view('accounting/reconcile', $this->page_data);
	}

		public function indexmain()
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/reconcile/index', $this->page_data);
	}

	public function add()
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/reconcile/add', $this->page_data);
	}

	public function addReconcile()
	{
		$chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $ending_balance=$this->input->post('ending_balance');
        $ending_date=$this->input->post('ending_date');
        $first_date=$this->input->post('first_date');
        $service_charge=$this->input->post('service_charge');
        $expense_account=$this->input->post('expense_account');
        $second_date=$this->input->post('second_date');
        $interest_earned=$this->input->post('interest_earned');
        $income_account=$this->input->post('income_account');

        $this->reconcile_model->saverecords($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account);
        
        $this->session->set_flashdata('success', "Data inserted successfully!"); 
        redirect("accounting/reconcile");
	}

	public function edit($id)
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['reconcile'] = $this->reconcile_model->getById($id);
		$this->load->view('accounting/reconcile/edit', $this->page_data);
	}

	public function update($id)
	{
		$id=$id;
		$chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $ending_balance=$this->input->post('ending_balance');
        $ending_date=$this->input->post('ending_date');
        $first_date=$this->input->post('first_date');
        $service_charge=$this->input->post('service_charge');
        $expense_account=$this->input->post('expense_account');
        $second_date=$this->input->post('second_date');
        $interest_earned=$this->input->post('interest_earned');
        $income_account=$this->input->post('income_account');

        $this->reconcile_model->updaterecords($id,$chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account);
		
	}

	public function do_upload($id)
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
            $config['max_size'] = 1024 * 8;
    		$config['encrypt_name'] = TRUE;
		    $config['max_width'] = '1024';
		    $config['max_height'] = '1024';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    //$this->load->view('accounting/upload_success', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
            		$success = array('success' => "successfully added");
                    //$this->load->view('accounting/upload_success', $success);
            }
        $this->index($id);
    }
}