<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

    private $upload_path = "./uploads/accounting/";
    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
		$this->load->model('vendors_model');
		$this->load->model('terms_model');
        $this->load->model('expenses_model');
        $this->load->model('rules_model');
        $this->load->model('receipt_model');
        $this->load->model('categories_model');
        $this->load->library('excel');
//        The "?v=rand()" is to remove browser caching. It needs to remove in the live website.
        add_css(array(
            "assets/css/accounting/accounting.css?v=".rand(),
            "assets/css/accounting/accounting.modal.css?v=".rand(),
            "assets/css/accounting/sidebar.css",
			"assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js?v=".rand()
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
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->load->view('accounting/dashboard', $this->page_data);
    }

    public function expenses()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->page_data['checks'] = $this->expenses_model->getCheck();
        $this->page_data['transactions'] = $this->expenses_model->getTransaction();
        $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
        $this->page_data['bills'] = $this->expenses_model->getBill();
        $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
        $this->page_data['expenses'] = $this->expenses_model->getExpense();
        $this->page_data['list_categories'] = $this->categories_model->getCategories();
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->load->view('accounting/expenses', $this->page_data);
    }
    public function vendors(){
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->load->view('accounting/vendors', $this->page_data);
    }

    public function receivables()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/receivables', $this->page_data);
    }

    public function workers()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/workers', $this->page_data);
    }

    public function taxes()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/taxes', $this->page_data);
    }

    public function chart_of_accounts()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/chart_of_accounts', $this->page_data);
    }

    public function my_accountant()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/my_accountant', $this->page_data);
    }

    public function link_bank()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/banking', $this->page_data);
    }

    public function rules()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rules'] = $this->rules_model->getRules();
        $this->load->view('accounting/rules', $this->page_data);
    }

    public function receipts()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['receipts'] = $this->receipt_model->getReceipt();
        $this->load->view('accounting/receipts', $this->page_data);
    }
    public function salesoverview()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/sales_overview', $this->page_data);
    }
    public function allsales()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/all_sales', $this->page_data);
    }
	public function invoices()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Invoices";
        $this->load->view('accounting/invoices', $this->page_data);
    }
	public function customers()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Customers";
        $this->load->view('accounting/customers', $this->page_data);
    }
	public function deposits()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Deposits";
        $this->load->view('accounting/deposits', $this->page_data);
    }
	public function products_and_services()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Product and Services";
        $this->load->view('accounting/products_and_services', $this->page_data);
    }
    public function audit_log()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/audit_log', $this->page_data);
    }
	 public function payrolloverview()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/payroll_overview', $this->page_data);
    }	
	 public function employees()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/employees', $this->page_data);
    }
	public function contractors()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/contractors', $this->page_data);
    }
	public function workerscomp()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/workers_comp', $this->page_data);
    }
	public function reports()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Reports";
        $this->load->view('accounting/reports', $this->page_data);
    }
	
	/*** Vendors ***/
	public function addVendor()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Add Vendor";
		if (! empty($_FILES)){
            $config = array(
                'upload_path' => './uploads/accounting/',
                'allowed_types' => 'gif|jpg|png|jpeg|docx|doc|pdf',
                'max_size' => '20000',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload',$config);
			
            if ($this->upload->do_upload("file")){
				
                $uploadData = $this->upload->data();
            
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
					'attachments' => $uploadData['file_name'],
					'status' => 1,
					'created_by' => $this->input->post('created_by'),
					'date_created' => date("Y-m-d H:i:s"),
					'date_modified' => date("Y-m-d H:i:s")
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
				
			}else{
				echo json_encode($this->upload->display_errors());
			}

        }
    }
	
	public function deleteVendor(){

        $id = $this->input->post('id');
        $this->vendors_model->delete($id);
    }
	
	public function allVendors()
    {
        echo json_encode($this->vendors_model->getVendors());
    }
	public function vendordetails($id)
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Reports";
		
		$this->page_data['vendor_details'] = $this->vendors_model->getById($id);
        $this->load->view('accounting/vendor_details', $this->page_data);
    }
	public function invalidVendor()
    {
		$id =  $this->input->post('id');
				$new_data = array(
					'status' => 0,
					'date_modified' => date("Y-m-d H:i:s")
				);
				
				$editQuery = $this->vendors_model->update($id,$new_data);
				
				if($editQuery > 0){
					echo json_encode(1);
				}
				else{
					echo json_encode(0);
				}

    }
	public function editVendor()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Edit Vendor";
		
		$id =  $this->input->post('id');
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
					'date_modified' => date("Y-m-d H:i:s")
				);
				
				$editQuery = $this->vendors_model->update($id,$new_data);
				
				if($editQuery > 0){
					echo json_encode(1);
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
/*** Expenses ***/

    public function timeActivity(){
        $new_data = array(
            'date' => $this->input->post('date'),
            'name' => $this->input->post('name'),
            'customer' => $this->input->post('customer'),
            'service' => $this->input->post('service'),
            'billable' => $this->input->post('billable'),
            'taxable' => $this->input->post('taxable'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'break' => $this->input->post('break'),
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
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
        $this->expenses_model->addBill($new_data);

    }

    public function getBillData(){
        $id = $this->input->post('id');
        $bills = $this->db->get_where('accounting_bill',array('id'=> $id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id' => $bills->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('transaction_type_id'=>$id));


        $data = new stdClass();
        $data->transaction_id = $bills->row()->transaction_id;
        $data->vendor_id = $vendors->row()->id;
        $data->bill_id = $bills->row()->id;
        $data->vendor_name = $vendors->row()->f_name.'&nbsp;'.$vendors->row()->l_name;
        $data->address = $bills->row()->mailing_address;
        $data->terms = $bills->row()->terms;
        $data->bill_date = $bills->row()->bill_date;
        $data->due_date = $bills->row()->due_date;
        $data->bill_number = $bills->row()->bill_number;
        $data->permit_number = $bills->row()->permit_number;
        $data->check_category = ($check_category->num_rows > 0)?true:false;
        echo json_encode($data);
    }

    public function editBillData(){
        $data = array(
            'bill_id' => $this->input->post('bill_id'),
            'transaction_id' => $this->input->post('transaction_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_num'),
            'permit_number' => $this->input->post('permit_num'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
        $this->expenses_model->editBillData($data);
    }

    public function deleteBillData(){
        $id = $this->input->post('id');
        $this->expenses_model->deleteBillData($id);
    }

    public function getCheckData(){
        $id = $this->input->post('id');
        $query = $this->db->get_where('accounting_check',array(
            'id' => $id
        ));
        $vendors_detail = $this->db->get_where('accounting_vendors',array('vendor_id'=>$query->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('transaction_type_id'=>$id));
        if ($query->row()->print_later == 1){
            $print = true;
        }else{
            $print = false;
        }
        $std = new stdClass();
        $std->check_id = $id;
        $std->vendor_id = $query->row()->vendor_id;
        $std->transaction = $query->row()->transaction_id;
        $std->vendor_name = $vendors_detail->row()->f_name.'&nbsp;'.$vendors_detail->row()->l_name;
        $std->bank_account = $query->row()->bank_id;
        $std->mailing = $query->row()->mailing_address;
        $std->payment_date = $query->row()->payment_date;
        $std->check_number = $query->row()->check_number;
        $std->print_later = $print;
        $std->permit_number = $query->row()->permit_number;
        $std->check_category = ($check_category->num_rows() > 0)?true:false;


        echo json_encode($std);

    }
    public function rowCategories(){
        $id = $this->input->post('id');
        $row = $this->input->post('row');
        $cat_class = $this->input->post('cat_class');
        $des_class = $this->input->post('des_class');
        $amount_class = $this->input->post('amount_class');
        $counter = $this->input->post('counter');
        $remove = $this->input->post('remove_id');
        $select = $this->input->post('select');
        $get_categories = $this->db->get_where('accounting_expense_category',array('transaction_type_id'=>$id));
        $result = $get_categories->result();
        $categories = '';
        $category_list = $this->categories_model->getCategories();
        foreach ($result as $cnt => $data){
            $category = ($data->category_id != null)?$data->category_id:"";
            $description = ($data->description != null)?$data->description:"";
            $amount = ($data->amount!=null)?$data->amount:"";
            $cnt += 1;
            $categories .= '<tr id="'.$row.'">';
            $categories .= '<td></td>';
            $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
            $categories .= '<td>';
            $categories .= '<div id="" style="display:none;">';
            $categories .= '<select name="category[]" id="" class="form-control '.$cat_class.'&nssp;'.$select.'">';
            foreach ($category_list as $list){
                if ($list->id == $category){
                    $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
                }
            }
            foreach ($category_list as $list){
                $categories .= ' <option value="'.$list->id.'">'.$list->category_name.'</option>';
            }
            $categories .= '</select>';
            $categories .= ' </div>';
            $categories .= '</td>';
            $categories .= '<td><input type="text" name="description[]" class="form-control '.$des_class.'" value="'.$description.'" id="tbl-input" style="display: none;"></td>';
            $categories .= '<td><input type="text" name="amount[]" class="form-control '.$amount_class.'" value="'.$amount.'" id="tbl-input" style="display: none;"></td>';
            $categories .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
            $categories .= '</tr>';
        }
        echo $categories;
    }
    public function addCheck(){
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'bank_id' => $this->input->post('bank_account'),
            'payment_date' => $this->input->post('payment_date'),
            'check_num' => $this->input->post('check_number'),
            'print_later' => $this->input->post('print_later'),
            'permit_number' => $this->input->post('permit_number'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
        $this->expenses_model->addCheck($new_data);


//        if ($query == true){
//            $this->session->set_flashdata('checked','New Check added.');
//            redirect('accounting/expenses');
//        }else{
//            $this->session->set_flashdata('check_failed','Vendor already exist.');
//            redirect('accounting/expenses');
//        }
    }

    public function editCheckData(){
	    $update = array(
            'check_id' => $this->input->post('check_id'),
            'transaction_id' => $this->input->post('transaction_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'bank_id' => $this->input->post('bank_account'),
            'payment_date' => $this->input->post('payment_date'),
            'check_num' => $this->input->post('check_number'),
            'print_later' => $this->input->post('print_later'),
            'permit_number' => $this->input->post('permit_number'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
	    $this->expenses_model->editCheckData($update);

//	    if ($query == true){
//            $this->session->set_flashdata('checked_updated','Data Updated.');
//            redirect('accounting/expenses');
//        }else{
//            $this->session->set_flashdata('checked_up_failed','Something is wrong in the process.');
//            redirect('accounting/expenses');
//        }
    }
    public function deleteCheckData(){

        $id = $this->input->post('id');
        $this->expenses_model->deleteCheckData($id);
    }

    public function addExpense(){
	    $new_data = array(
	        'vendor_id' => $this->input->post('vendor_id'),
	        'payment_account' => $this->input->post('payment_account'),
	        'payment_date' => $this->input->post('payment_date'),
	        'payment_method' => $this->input->post('payment_method'),
	        'ref_number' => $this->input->post('ref_num'),
	        'permit_number' => $this->input->post('permit_num'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
	    $this->expenses_model->addExpense($new_data);
    }
    public function getExpenseData(){
        $id = $this->input->post('id');
        $get_expense = $this->db->get_where('accounting_expense',array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id'=> $get_expense->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('transaction_type_id'=>$id));


        $data = new stdClass();
        $data->vendor_id = $get_expense->row()->vendor_id;
        $data->vendor_name = $vendors->row()->f_name.'&nbsp;'.$vendors->row()->l_name;
        $data->transaction_id = $get_expense->row()->transaction_id;
        $data->expense_id = $id;
        $data->payment_account = $get_expense->row()->payment_account;
        $data->payment_date = $get_expense->row()->payment_date;
        $data->payment_method = $get_expense->row()->payment_method;
        $data->ref_number = $get_expense->row()->ref_number;
        $data->permit_number = $get_expense->row()->permit_number;
        $data->check_category = ($check_category->num_rows() > 0)?true:false;

        echo json_encode($data);

    }

    public function updateExpenseData(){
        $update = array(
            'transaction_id' => $this->input->post('transaction_id'),
            'expense_id' => $this->input->post('expense_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'payment_account' => $this->input->post('payment_account'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_num'),
            'permit_number' => $this->input->post('permit_num'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
        $this->expenses_model->updateExpenseData($update);
    }

    public function deleteExpenseData(){
        $id = $this->input->post('id');
        $this->expenses_model->deleteExpenseData($id);
    }

    public function vendorCredit(){
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_number' => $this->input->post('ref_number'),
            'permit_number' => $this->input->post('permit_number'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
        $this->expenses_model->vendorCredit($new_data);
    }
    public function getVendorCredit(){
        $id = $this->input->post('id');
        $get_vc = $this->db->get_where('accounting_vendor_credit',array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id'=> $get_vc->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('transaction_type_id'=>$id));


        $data = new stdClass();
        $data->vc_id = $id;
        $data->vendor_id = $get_vc->row()->vendor_id;
        $data->vendor_name = $vendors->row()->display_name;
        $data->transaction_id = $get_vc->row()->transaction_id;
        $data->mailing_address = $get_vc->row()->mailing_address;
        $data->payment_date = $get_vc->row()->payment_date;
        $data->ref_number = $get_vc->row()->ref_number;
        $data->permit_number = $get_vc->row()->permit_number;
        $data->check_number = ($check_category->num_rows() > 0)?true:false;

        echo json_encode($data);
    }
    public function updateVendorCredit(){
        $update = array(
            'vc_id' => $this->input->post('vc_id'),
            'transaction_id' => $this->input->post('transaction_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_number' => $this->input->post('ref_number'),
            'permit_number' => $this->input->post('permit_number'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount')
        );
        $this->expenses_model->updateVendorCredit($update);
    }

    public function deleteVendorCredit(){
        $id = $this->input->post('id');
        $this->expenses_model->deleteVendorCredit($id);
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
    public function edit_rules(){
        $id = $this->input->get('id');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rules'] = $this->rules_model->getRulesById($id);
        $this->page_data['conditions'] = $this->rules_model->getConditionById($id);
        $this->page_data['categories'] = $this->rules_model->getCategoryById($id);
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->load->view('accounting/rules/edit-rules', $this->page_data);
    }

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

    public function editRules(){
        $update = array(
            'rules_id' => $this->input->post('rules_id'),
            'rules_name' => $this->input->post('rules_name'),
            'apply' => $this->input->post('apply'),
            'banks' => $this->input->post('banks'),
            'include' => $this->input->post('include'),
            'transaction_type' => $this->input->post('trans_type'),
            'payee' => $this->input->post('payee'),
            'memo' => $this->input->post('memo'),
            'auto' => $this->input->post('auto')
        );
        //Condition
        $con_id = $this->input->post('con_id');
        $description = $this->input->post('description');
        $contain = $this->input->post('contain');
        $comment = $this->input->post('comment');
        //Category
        $cat_id = $this->input->post('cat_id');
        $category = $this->input->post('category');
        $percentage = $this->input->post('percentage');

        $rules_id = $this->rules_model->editRules($update,$con_id,$description,$contain,$comment,$cat_id,$category,$percentage);
        if ($rules_id == true){
            $this->session->set_flashdata('updated_rules','Rules has been updated.');
            redirect('accounting/rules');
        }else{
            $this->session->set_flashdata('update_rules_failed','Something is wrong in the process.');
            redirect('accounting/rules');
        }
    }

    public function deleteRulesData(){
        $id = $this->input->post('id');
        $this->rules_model->deleteRulesData($id);
        $rules = $this->rules_model->getRules();
        $output = '';
        foreach ($rules as $rule){
            $output = '<tr>';
            $output .= '<td><input type="checkbox" value="'.$rule->id.'"></td>';
            $output .= '<td>'.$rule->rules_name.'</td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td>'.($rule->auto)?"Auto":"".'</td>';
            $output .= '<td></td>';
            $output .= '<td>';
            $output .= '<a href="'.site_url().'accounting/edit_rules?id='.$rule->id.'" style="color: #0b97c4;">View/Edit</a>&nbsp;';
            $output .= '<div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">';
            $output .= '<span class="fa fa-chevron-down" data-toggle="dropdown"></span>';
            $output .= '<ul class="dropdown-menu dropdown-menu-right">';
            $output .= '<li><a href="#" id="deleteRules" data-id="'.$rule->id.'">Delete</a></li>';
            $output .= '</ul>';
            $output .= '</div>';
            $output .= '</td>';
            $output .= '</tr>';
        }
        echo $output;
    }

    /*** Receipt ***/
    public function uploadReceiptImage(){
        if (! empty($_FILES)){
            $config = array(
                'upload_path' => './uploads/accounting/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'overwrite' => TRUE,
                'max_size' => '5000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload',$config);
            if ($this->upload->do_upload("file")){
                $uploadData = $this->upload->data();
                $data2 = array('receipt_img' => $uploadData['file_name']);
                $this->db->insert('accounting_receipts',$data2);
                echo json_encode($uploadData['file_name']);
            }else{
                echo $this->upload->display_errors();;
            }

        }
    }

    public function removeReceiptImage(){
        $file = $this->input->post('file');
        if ($file && file_exists($this->upload_path. $file)){
            unlink( $this->upload_path. $file);
            $this->db->where('receipt_img',$file);
            $this->db->delete('accounting_receipts');
        }else{
           echo $this->upload->display_errors();
        }
    }

    public function getReceiptData(){
        if (isset($_POST['id'])){
            $query = $this->db->get_where('accounting_receipts',array('id'=>$_POST['id']));

            $data = new stdClass();
            $data->id = $_POST['id'];
            $data->receipt_img = $query->row()->receipt_img;
            $data->document_type = (empty($query->row()->document_type))?"null":$query->row()->document_type;
            $data->payee_id = ($query->row()->payee_id == 0)?"default":$query->row()->payee_id;
            $data->bank_account = (empty($query->row()->bank_account))?"default":$query->row()->bank_account;
            $data->transaction_date = $query->row()->transaction_date;
            $data->description = (empty($query->row()->description))?"":$query->row()->description;
            $data->category = (empty($query->row()->category))?"default":$query->row()->category;
            $data->total_amount = (empty($query->row()->total_amount))?"":$query->row()->total_amount;
            $data->memo = (empty($query->row()->memo))?"":$query->row()->memo;
            $data->ref_number = (empty($query->row()->ref_number))?"":$query->row()->ref_number;

            echo json_encode($data);
        }
    }

    public function updateReceipt(){
        $new_data = array(
            'receipt_id' => $this->input->post('receipt_id'),
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

     /*chart_of_accounts start*/
        public function add()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
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
        $this->page_data['alert'] = 'accounting/alert_promt';
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

    public function update_name()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $this->chart_of_accounts_model->update_name($id,$name);
    }

    public function inactive()
    {
        $id = $this->input->post('id');
        $this->chart_of_accounts_model->inactive($id);
    }

    public function import()
     {
        $this->page_data['page_title'] = "Import";
      if(isset($_FILES["file"]["name"]))
      {
       $path = $_FILES["file"]["tmp_name"];
       $object = PHPExcel_IOFactory::load($path);
       foreach($object->getWorksheetIterator() as $worksheet)
       {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        for($row=1; $row<=$highestRow; $row++)
        {
         $account_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
         $acc_detail_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
         $name = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
         $description = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
         $sub_acc_id = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
         $time = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
         $balance = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
         $time_date = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
         $data[] = array(
          'account_id'   => $account_id,
          'acc_detail_id'    => $acc_detail_id,
          'name'  => $name,
          'description'   => $description,
          'sub_acc_id'  => $sub_acc_id,
          'time'  => $time,
          'balance'  => $balance,
          'time_date'  => $time_date
         );
        }
       }
       $this->chart_of_accounts_model->insert($data);
       echo 'Data Imported successfully';
      } 
     }

     public function refresh()
     {
        $html = "";
        $i=1;
        foreach($this->chart_of_accounts_model->select() as $row)
        {
        $html .="<tr><td><input type='checkbox'></td><td class='edit_field' data-id='".$row->id."'>".$row->name."</td><td class='type'>".$this->account_model->getName($row->account_id)."</td><td class='detailtype'>".$this->account_detail_model->getName($row->acc_detail_id)."</td><td class='nbalance'>".$row->balance."</td><td class='balance'></td><td><div class='dropdown show'><a class='dropdown-toggle' href='#' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>View Register</a><div class='dropdown-menu' aria-labelledby='dropdownMenuLink'><a class='dropdown-item' href='#'>Connect Bank</a><a class='dropdown-item' href=".url('/accounting/chart_of_accounts/edit/'.$row->id).">Edit</a><a class='dropdown-item' href='#' onClick='make_inactive(".$row->id.")'>Make Inactive (Reduce usage)</a><a class='dropdown-item' href='#'>Run Report</a></div></div></td></tr>";
        $i++;
        }
        echo $html;            
     }
    /*chart_of_accounts end*/
}