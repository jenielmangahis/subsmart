<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts extends MY_Controller {
	
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
				array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
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
				array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')), 
				array("",	array('/accounting/expenses','/accounting/vendors')), 
				array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/invoices','/accounting/customers','/accounting/deposits','/accounting/products-and-services')),
				array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')), 
				array('/accounting/reports',array()), 
				array("",	array('#','#')), 
				array('#',	array()), 
				array("",	array('/accounting/chart_of_accounts','#')), 
			); 
		$this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator"); 

    }
	public function add()
	{
		$this->load->view('accounting/chart_of_accounts/add', $this->page_data);
	}

	public function addChartofaccounts()
	{
		$account_id=$this->input->post('account_type');
		$acc_detail_id=$this->input->post('detail_type');
		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$sub_acc_id=$this->input->post('sub_account_type');
		$time=$this->input->post('choose_time');
		$balance=$this->input->post('balance');
		$time_date=$this->input->post('time_date');

		$this->chart_of_accounts_model->saverecords($account_id,$acc_detail_id,$name,$description,$sub_acc_id,$time,$balance,$time_date);
		
		//$this->session->set_flashdata('error', "Please try again!");
	    $this->session->set_flashdata('success', "Data inserted successfully!"); 
		redirect("accounting/chart_of_accounts");
		//$this->load->view('accounting/chart_of_accounts', $this->page_data);
	}

	public function edit($id)
	{
		$this->page_data['chart_of_accounts'] = $this->chart_of_accounts_model->getById($id);
		$this->load->view('accounting/chart_of_accounts/edit', $this->page_data);
	}

	public function update()
	{
		$id=$this->input->post('id');
		$account_id=$this->input->post('account_type');
		$acc_detail_id=$this->input->post('detail_type');
		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$sub_acc_id=$this->input->post('sub_account_type');
		$time=$this->input->post('choose_time');
		$balance=$this->input->post('balance');
		$time_date=$this->input->post('time_date');
		if($time != 'Other')
		{
			$time_date = '';
		}

		$this->chart_of_accounts_model->updaterecords($id,$account_id,$acc_detail_id,$name,$description,$sub_acc_id,$time,$balance,$time_date);
		
	    $this->session->set_flashdata('success', "Data updated successfully!"); 
		redirect("accounting/chart_of_accounts");
	}

	public function fetch_acc_detail()
	{
		if($this->input->post('account_id'))
		{
			echo $this->accounts_has_account_details_model->fetch_acc_detail_id($this->input->post('account_id'));
		}
	}
}