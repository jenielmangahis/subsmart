<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('vendors_model');
		$this->load->model('terms_model');
//        The "?v=rand()" is to remove browser caching. It needs to remove in the live website.
        add_css(array(
            "assets/css/accounting/banking.css?v=".rand(),
            "assets/css/accounting/accounting.modal.css?v=".rand(),
            "assets/css/accounting/sidebar.css",
			"assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
        ));

        add_footer_js(array(
            "assets/js/accounting/main.js",
            "assets/plugins/dropzone/dist/dropzone.js",
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
	public function invoices()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Invoices";
        $this->load->view('accounting/invoices', $this->page_data);
    }
	public function customers()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Customers";
        $this->load->view('accounting/customers', $this->page_data);
    }
	public function deposits()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Deposits";
        $this->load->view('accounting/deposits', $this->page_data);
    }
	public function products_and_services()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Product and Services";
        $this->load->view('accounting/products_and_services', $this->page_data);
    }
    public function audit_log()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/audit_log', $this->page_data);
    }
	 public function payrolloverview()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/payroll_overview', $this->page_data);
    }	
	 public function employees()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/employees', $this->page_data);
    }
	public function contractors()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/contractors', $this->page_data);
    }
	public function workerscomp()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/workers_comp', $this->page_data);
    }
	public function reports()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Reports";
        $this->load->view('accounting/reports', $this->page_data);
    }
	
	/*** Vendors ***/
	
	public function addVendor()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Add Vendor";
		
		$new_data = array(
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
			'terms' => $this->input->post('terns'),
			'opening_balance' => $this->input->post('opening_balance'),
			'opening_balance_as_of_date' => $this->input->post('opening_balance_as_of_date'),
			'account_number' => $this->input->post('account_number'),
			'business_number' => $this->input->post('business_number'),
			'default_expense_amount' => $this->input->post('default_expense_amount'),
			'notes' => $this->input->post('notes'),
			'status' => 1,
			'created_by' => $this->input->post('created_by'),
			'date_created' => $this->input->post('date_created'),
			'date_modified' => $this->input->post('date_modified')
		);
		
		$addQuery = $this->vendors_model->create($new_data);
		
		if($addQuery > 0){
			
			$new_id = $addQuery;
			$vendor_id = mb_substr($this->input->post('company'), 0, 3) . $new_id;
			$updateQuery = $this->vendors_model->update($new_id, array("vendor_id" =>$vendor_id));
			
			if($updateQuery > 0){
				echo json_encode($updateQuery);
			}
		}
		else{
			echo json_encode(0);
		}
		
    }
	public function addTerms()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Add Vendor";
		
		$new_data = array(
			'term_name' => $this->input->post('term_name'),
			'status' => 1,
			'created_by' => $this->input->post('created_by'),
			'date_created' => $this->input->post('date_created'),
			'date_modified' => $this->input->post('date_modified')
		);
		
		$addQuery = $this->terms_model->create($new_data);
		
		if($addQuery > 0){
			
			$new_id = $addQuery;
			$term_id = mb_substr($this->input->post('term_name'), 0, 3) . $new_id;
			$updateQuery = $this->terms_model->update($new_id, array("term_id" =>$term_id));
			
			if($updateQuery > 0){
				echo json_encode($updateQuery);
			}
		}
		else{
			echo json_encode(0);
		}
		
    }
}