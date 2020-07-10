<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        add_css(array(
            "assets/css/accounting/banking.css?v=".rand(),
            "assets/css/accounting/accounting.modal.css?v=".rand(),
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
				array("",	array('/accounting/sales-overview','/accounting/all-sales','#','#','#','#')), 
				array("",	array('#','#','#','#','#')), 
				array('#',	array()), 
				array("",	array('#','#')), 
				array('#',	array()), 
				array("",	array('#','#')), 
			); 
		$this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator"); 
    }

    /*public function index()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('tools/business_tools', $this->page_data);
    }*/

    public function banking()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/dashboard', $this->page_data);
    }

    public function expenses()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/expenses', $this->page_data);
    }
    public function vendors(){
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/vendors', $this->page_data);
    }

    public function receivables()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/receivables', $this->page_data);
    }

    public function workers()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/workers', $this->page_data);
    }

    public function taxes()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/taxes', $this->page_data);
    }

    public function chart_of_accounts()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/chart_of_accounts', $this->page_data);
    }

    public function my_accountant()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/my_accountant', $this->page_data);
    }

    public function link_bank()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/banking', $this->page_data);
    }

    public function rules()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/rules', $this->page_data);
    }

    public function receipts()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/receipts', $this->page_data);
    }
    public function salesoverview()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/sales_overview', $this->page_data);
    }
    public function allsales()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/all_sales', $this->page_data);
    }

}