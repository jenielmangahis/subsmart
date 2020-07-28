<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
		$this->load->model('vendors_model');
		$this->load->model('terms_model');
        $this->load->model('expenses_model');
        $this->load->model('rules_model');
        $this->load->model('receipt_model');
//        The "?v=rand()" is to remove browser caching. It needs to remove in the live website.
        add_css(array(
            "assets/css/accounting/accounting.css?v=".rand(),
            "assets/css/accounting/accounting.modal.css?v=".rand(),
            "assets/css/accounting/sidebar.css",
			"assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
        ));

        add_footer_js(array(
            "assets/js/accounting/accounting.js?v=".rand(),
            "assets/plugins/dropzone/dist/dropzone.js",
            "https://cdn.jsdelivr.net/npm/sweetalert2@9"
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
        $this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->page_data['checks'] = $this->expenses_model->getCheck();
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
        $this->page_data['rules'] = $this->rules_model->getRules();
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
//    Expenses
    public function getVendor(){

    }

    public function timeActivity(){
        $new_data = array(
            'date' => $this->input->post('date'),
            'name' => $this->input->post('name'),
            'customer' => $this->input->post('customer'),
            'service' => $this->input->post('service'),
            'billable' => $this->input->post('billable'),
            'start_end_times' => $this->input->post('start_end_times'),
            'time' => $this->input->post('time'),
            'description' => $this->input->post('description')
        );
        $query = $this->expenses_model->timeActivity($new_data);
        if ($query == true){
            redirect('accounting/expenses');
        }else{
            redirect('accounting/expenses');
        }
    }

    public function addBill(){
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_num'),
            'permit_number' => $this->input->post('permit_num'),
        );
        $query = $this->expenses_model->addBill($new_data);
        if ($query == true){
            redirect('accounting/expenses');
        }else{
            redirect('accounting/expenses');
        }
    }

    public function getCheckData(){
        if (isset($_POST['id'])){
            $query = $this->db->get_where('accounting_check',array(
                'vendor_id' => $_POST['id']
            ));
            $vendors_detail = $this->db->get_where('accounting_vendors',array('vendor_id'=>$_POST['id']));
            if ($query->row()->print_later == 1){
                $print = true;
            }else{
                $print = false;
            }
            $std = new stdClass();
            $std->check_id = $query->row()->id;
            $std->vendor_id = $_POST['id'];
            $std->vendor_name = $vendors_detail->row()->f_name.'&nbsp;'.$vendors_detail->row()->l_name;
            $std->mailing = $query->row()->mailing_address;
            $std->payment_date = $query->row()->payment_date;
            $std->check_number = $query->row()->check_number;
            $std->print_later = $print;
            $std->permit_number = $query->row()->permit_number;

            echo json_encode($std);
        }
    }
    public function addCheck(){
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'bank_id' => $this->input->post('bank_id'),
            'payment_date' => $this->input->post('payment_date'),
            'check_num' => $this->input->post('check_num'),
            'print_later' => $this->input->post('print_later'),
            'permit_number' => $this->input->post('permit_num'),
        );
        $query = $this->expenses_model->addCheck($new_data);
        if ($query == true){
            $this->session->set_flashdata('checked','New Check added.');
            redirect('accounting/expenses');
        }else{
            $this->session->set_flashdata('check_failed','Vendor already exist.');
            redirect('accounting/expenses');
        }
    }

    public function editCheckData(){
	    $update = array(
            'check_id' => $this->input->post('check_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'bank_id' => $this->input->post('bank_id'),
            'payment_date' => $this->input->post('payment_date'),
            'check_num' => $this->input->post('check_num'),
            'print_later' => $this->input->post('print_later'),
            'permit_number' => $this->input->post('permit_num'),
        );
	    $query = $this->expenses_model->editCheckData($update);
	    if ($query == true){
            $this->session->set_flashdata('checked_updated','Data Updated.');
            redirect('accounting/expenses');
        }else{
            $this->session->set_flashdata('checked_up_failed','Something is wrong in the process.');
            redirect('accounting/expenses');
        }
    }
    public function deleteCheckData(){

        $id = $this->input->post('id');
        $this->expenses_model->deleteCheckData($id);
//        if ($delete == true){
//            redirect('accounting/expenses');
//        }else{
//            redirect('accounting/expenses');
//        }
    }

    public function addExpense(){
	    $new_data = array(
	        'vendor_id' => $this->input->post('vendor_id'),
	        'payment_account' => $this->input->post('payment_account'),
	        'payment_date' => $this->input->post('payment_date'),
	        'payment_method' => $this->input->post('payment_method'),
	        'ref_number' => $this->input->post('ref_num'),
	        'permit_number' => $this->input->post('permit_num'),
        );
	    $query = $this->expenses_model->addExpense($new_data);
        if ($query == true){
            redirect('accounting/expenses');
        }else{
            redirect('accounting/expenses');
        }
    }

    public function vendorCredit(){
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_number' => $this->input->post('ref_num'),
            'permit_number' => $this->input->post('permit_num'),
        );
        $query = $this->expenses_model->vendorCredit($new_data);
        if ($query == true){
            redirect('accounting/expenses');
        }else{
            redirect('accounting/expenses');
        }
    }

    public function payDown(){
        $new_data = array(
            'credit_card_id' => $this->input->post('credit_card_id'),
            'amount' => $this->input->post('amount'),
            'date_payment' => $this->input->post('date_payment'),
            'payment_account' => $this->input->post('payment_account'),
            'check_number' => $this->input->post('check_num'),
        );
        $query = $this->expenses_model->payDown($new_data);
        if ($query == true){
            redirect('accounting/expenses');
        }else{
            redirect('accounting/expenses');
        }
    }

    /***Rules***/
    public function addRules(){
        $new_data = array(
            'rules_name' => $this->input->post('rules_name'),
            'apply' => $this->input->post('apply'),
            'banks' => $this->input->post('banks'),
            'include' => $this->input->post('include'),
            'transaction_type' => $this->input->post('trans_type'),
            'payee' => $this->input->post('payee'),
            'memo' => $this->input->post('memo'),
            'auto' => $this->input->post('auto')
        );
        $rules_id = $this->rules_model->addRules($new_data);
        if ($rules_id != null){
            //Condition insertion
            $description = $this->input->post('description');
            $contain = $this->input->post('contain');
            $comment = $this->input->post('comment');
            $this->rules_model->addConditions($description,$contain,$comment,$rules_id);
            //Category Insertion
            $category = $this->input->post('category');
            $percentage = $this->input->post('percentage');
            $this->rules_model->addCategory($category,$percentage,$rules_id);

            $this->session->set_flashdata('rules_added','New rules added');
            redirect('accounting/rules');
        }else{
            $this->session->set_flashdata('rules_failed','Rules name already exist.');
            redirect('accounting/rules');
        }


    }

    /*** Receipt ***/
    public function uploadReceiptImage(){
        $img = $this->input->post('form_data');
        $config = array(
            'upload_path' => './uploads/Accounting/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()){
            $data = array('form_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'receipt_img' => $file['file_name']
            );
            $this->db->insert('accounting_receipts',$data);
            echo json_encode($data);
        }

    }

    public function updateReceipt(){
        $new_data = array(
            'document_type' => $this->input->post('document_type'),
            'payee_id' => $this->input->post('payee_id'),
            'bank_account' => $this->input->post('bank_account'),
            'transaction_date' => $this->input->post('transaction_date'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'total_amount' => $this->input->post('total_amount'),
            'memo' => $this->input->post('memo'),
            'ref_number' => $this->input->post('ref_number')
        );
        $update = $this->receipt_model->updateReceipt($new_data);
        if ($update == true){
            $this->session->set_flashdata('receipt_updated','Receipt updated.');
            redirect('accounting/receipts');
        }else{
            $this->session->set_flashdata('receipt_updateFailed','Something is wrong in the process.');
            redirect('accounting/receipts');
        }
    }

    public function deleteReceiptData(){
        $id = $this->input->post('id');
        $this->receipt_model->deleteReceiptData($id);
    }
}