<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taxes extends MY_Controller {
	
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
				array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')), 
				array('/accounting/reports',array()), 
				array("",	array('#','#')), 
				array('#',	array()), 
				array("",	array('/accounting/chart_of_accounts','#')), 
			); 
		$this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator"); 

    }
	public function edit_settings()
	{
		$this->load->view('accounting/taxes/edit-settings', $this->page_data);
	}
}