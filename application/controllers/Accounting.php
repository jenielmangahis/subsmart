<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

    private $upload_path = "./uploads/accounting/";
    private $expenses_path = "./uploads/accounting/expenses/";
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
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js"
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
        $this->page_data['attachments'] = $this->expenses_model->getAttachment();
        $this->load->view('accounting/expenses', $this->page_data);
    }
    public function vendors(){
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['vendors'] = $this->vendors_model->getVendors();
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
        $this->page_data['alert'] = 'accounting/alert_promt';
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
        $this->page_data['receipts'] = $this->receipt_model->getReceipt();
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
            'business_number' => $this->input->post('business_number'),
            'default_expense_amount' => $this->input->post('default_expense_amount'),
            'notes' => $this->input->post('notes'),
            'attachments' => $file_name,
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->vendors_model->createVendor($new_data);

        if($addQuery > 0){

            $new_id = $addQuery;
            $comp = mb_substr($this->input->post('company'), 0, 3);
            $vendor_id = strtolower($comp) . $new_id;
			
            $updateQuery = $this->vendors_model->updateVendor($new_id, array("vendor_id" => $vendor_id));

            if($updateQuery){
                echo json_encode($updateQuery);
            }
        }
        else{
            echo json_encode(0);
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
        $this->page_data['page_title'] = "Vendor Details";

        $this->page_data['vendor_details'] = $this->vendors_model->getVendorDetails($id);
        $this->page_data['transaction_details'] = $this->vendors_model->getvendortransactions($id);
        $this->load->view('accounting/vendor_details', $this->page_data);
    }
    public function getvendortransactions($id = null)
    {
        $id = 1;
        $query = $this->vendors_model->getvendortransactions($id);
        print_r($query);
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
            'terms' => $this->input->post('terms'),
            'opening_balance' => $this->input->post('opening_balance'),
            'opening_balance_as_of_date' => $this->input->post('opening_balance_as_of_date'),
            'account_number' => $this->input->post('account_number'),
            'business_number' => $this->input->post('business_number'),
            'default_expense_amount' => $this->input->post('default_expense_amount'),
            'notes' => $this->input->post('notes'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $editQuery = $this->vendors_model->updateVendor($id,$new_data);

        if($editQuery){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }

    }

    public function createBill()
    {
        $id = logged('id');
        $filePath = "uploads/accounting/vendors/bill/".$id;
        $file_name = "";

        if (!file_exists($filePath)) {
             mkdir($filePath);
        }
		
		$config['upload_path']  =  $filePath;
        $config['allowed_types']   = 'gif|jpg|png|jpeg|doc|docx|pdf|xlx|xls|csv';
        $config['max_size']        = '20000';
        $config['encrypt_name']    = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachFiles'))
        {
            $image = $this->upload->data();
            $file_name = $image['file_name'];
        }

        $config = $this->uploadlib->initialize($config);
        $this->load->library('upload',$config);

        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'memo' => $this->input->post('memo'),
            'attachments' => $file_name,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->expense_model->create($new_data);

        if($addQuery > 0){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }

    public function getVendorData($id)
    {
        $data = $this->vendors_model->getVendorDetails($id);
        echo json_encode($data);
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
            'vendor_id' => $this->input->post('vendor_id'),
            'date' => $this->input->post('date'),
            'name' => $this->input->post('name'),
            'customer' => $this->input->post('customer'),
            'service' => $this->input->post('service'),
            'billable' => $this->input->post('billable'),
            'taxable' => $this->input->post('taxable'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'break' => $this->input->post('breakTime'),
            'time' => $this->input->post('time'),
            'description' => $this->input->post('description')
        );
        $query = $this->expenses_model->timeActivity($new_data);
        if ($query){
             echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function addBill(){
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
       $query = $this->expenses_model->addBill($new_data);
       if ($query == true){
           echo json_encode(1);
       }else{
           echo json_encode(0);
       }

    }

    public function getBillData(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $bills = $this->db->get_where('accounting_bill',array('id'=> $id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id' => $bills->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id' => $transaction_id));

        $data = new stdClass();
        $data->vendor_id = $vendors->row()->vendor_id;
        $data->bill_id = $bills->row()->id;
        $data->vendor_name = $vendors->row()->f_name.'&nbsp;'.$vendors->row()->l_name;
        $data->address = $bills->row()->mailing_address;
        $data->terms = $bills->row()->terms;
        $data->bill_date = $bills->row()->bill_date;
        $data->due_date = $bills->row()->due_date;
        $data->bill_number = $bills->row()->bill_number;
        $data->permit_number = $bills->row()->permit_number;
        $data->memo = $bills->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0)?true:false;
        echo json_encode($data);
    }

    public function editBillData(){
        
		$new_data = array(
			'bill_id' => $this->input->post('id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->editBillData($data);
        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }

    public function deleteBillData(){
        $id = $this->input->post('id');
        $query = $this->expenses_model->deleteBillData($id);

        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
    /*** Attachment for Expense Transaction***/
    public function expensesTransactionAttachment(){
        if (! empty($_FILES)){
            $config = array(
                'upload_path' => './uploads/accounting/expenses/',
                'allowed_types' => '*',
                'overwrite' => TRUE,
                'max_size' => '20000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload',$config);
            if ($this->upload->do_upload("file")){
                $uploadData = $this->upload->data();
                $data = array('attachment'=> $uploadData['file_name']);
                $this->db->insert('accounting_expense_attachment',$data);
                echo json_encode($uploadData['file_name']);
            }
        }
    }

    public function removeTransactionAttachment(){
        $file = $this->input->post('name');
        $index = $this->input->post('index');
        if ($file && file_exists($this->expenses_path. $file[$index])){
            unlink( $this->expenses_path. $file[$index]);
            $this->db->where('attachment',$file[$index]);
            $this->db->delete('accounting_expense_attachment');
        }

    }

    public function displayListAttachment(){
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $attachments = $this->expenses_model->getAttachment();
        $display = '';
        foreach ($attachments as $attachment){
            $tooltip = ($attachment->status == 0)?"tooltip":"";
            $cross_out = ($attachment->status == 0)?"cross-out":"";
            $exclamation = ($attachment->status == 0)?"fa-times fa-exclamation-triangle":"fa-times";
            $tipbox = ($attachment->status == 0)?"tooltiptext":"tooltiptext hide";
            $file = $attachment->attachment;
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            switch ($extension){
                case "txt":
                    $file = "default-txt.png";
                    break;
                case "pdf":
                    $file = "default-pdf.png";
                    break;
                case "xls":
                    $file = "default-excel.png";
                    break;
                case "xlsb":
                    $file = "default-excel.png";
                    break;
                case "xlsm":
                    $file = "default-excel.png";
                    break;
                case "xlsx":
                    $file = "default-excel.png";
                    break;
                case "docx":
                    $file = "default-word.png";
                    break;
                case "doc":
                    $file = "default-word.png";
                    break;
                default:
                    $file = $attachment->attachment;
                    break;
            }
            if ($attachment->expenses_id == $id && $attachment->type == $type){
                $display .= '<div class="file-name-section">';
                $display .= '<span class="previewAttachment '.$cross_out.'">'.$attachment->original_filename.'</span>';
                $display .= '<span class="previewAttachmentImage"><img src="/uploads/accounting/expenses/'.$file.'">.'.$extension.'</span>';
                $display .= '<a href="#" class="'.$tooltip.'" id="removeAttachment" data-id="'.$attachment->id.'" data-status="'.$attachment->status.'"><i class="fa '.$exclamation.'"></i></a>';
                $display .= '<span class="'.$tipbox.'">This file is temporarily removed.</br> You can retrieve it by clicking the </br>exclamation icon "<i class="fa fa-exclamation-triangle"></i>". </span>';
                $display .= '<input type="hidden" name="attachment_id" id="attachmentId" value="'.$attachment->id.'">';
                $display .= '</div>';
            }
        }
        echo json_encode($display);
    }

    public function removeTemporaryAttachment(){
        $id = $this->input->post('attach_id');
        $status = $this->input->post('status');

        $query = $this->db->get_where('accounting_expense_attachment',array('id'=>$id));
        if ($query->num_rows() == 1 && $status == 1){
            $status = array(
                'status' => 0
            );
            $this->db->where('id',$id);
            $this->db->update('accounting_expense_attachment',$status);
            echo json_encode(0);
        }elseif($query->num_rows() == 1 && $status == 0){
            $status = array(
                'status' => 1
            );
            $this->db->where('id',$id);
            $this->db->update('accounting_expense_attachment',$status);
            echo json_encode(1);
        }
    }
    public function removePermanentlyAttachment(){
        $attachment_id = $this->input->post('attachment_id');
        for ($x = 0; $x < count($attachment_id);$x++){
            $get_filename = $this->db->get_where('accounting_expense_attachment',array('id'=>$attachment_id[$x]));
            unlink( $this->expenses_path. $get_filename->row()->attachment);
            $this->db->where('id',$attachment_id[$x]);
            $this->db->delete('accounting_expense_attachment');
        }

    }

    public function addingFileAttachment(){
        $transaction_id = $this->input->post('transaction_id');
        $transaction_from_id = $this->input->post('trans_from_id');
        $file_id = $this->input->post('file_id');
        $id = $this->input->post('expenses_id');
        $type = $this->input->post('type');
        $get_attachment_id = $this->db->get_where('accounting_expense_attachment',array('id'=>$file_id));
        $file_name = $get_attachment_id->row()->attachment;
        $original_fname = $this->input->post('original_fname');
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $encryption = md5(time()).'.'.$extension;
        copy('./uploads/accounting/expenses/'.$file_name,'./uploads/accounting/expenses/'.$encryption);
        $data = array(
            'transaction_id' => $transaction_id,
            'expenses_id' => $id,
            'type' => $type,
            'original_filename' => $original_fname,
            'attachment' => $encryption,
            'date_created' => date('Y-m-d H:i:s'),
            'status' => 1
        );
        $this->db->insert('accounting_expense_attachment',$data);
        $new_attachment_id = $this->db->insert_id();

        $added = array(
            'attachment_id' => $new_attachment_id,
            'attachment_from_id' => $get_attachment_id->row()->id,
            'trans_from_id' => $transaction_from_id,
            'expenses_type' => $type,
            'expenses_id' => $id,
            'date_created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('accounting_existing_attachment',$added);
        echo json_encode($id);
    }

    public function deleteTemporaryAttachment(){
        $attachments = $this->expenses_model->getAttachment();
        $result = null;
        foreach ($attachments as $attachment){
            if ($attachment->transaction_id == 0){
                unlink( $this->expenses_path.$attachment->attachment);
            }
        }
        $this->db->where('transaction_id',0);
        $this->db->delete('accounting_expense_attachment');
        echo json_encode($result);
    }

    public function showExistingFile(){
        $expense_id = $this->input->get('expenses_id');
        $type = $this->input->get('type');
        $transaction_id = $this->input->get('transaction_id');
        $attachments = $this->expenses_model->getAttachmentById($transaction_id);
        $disabled = null;
        $display = '';
        foreach ($attachments as $attachment){
                $added = $this->expenses_model->getAddedAttachment($attachment->id,$expense_id,$type);
                if ($added == true){
                    $status = 'Added';
                    $disabled = 'isDisabled';
                }else{
                    $status = 'Add';
                    $disabled = null;
                }


                $preview = "";
                if($type == 'Check'){
                    $preview = "-check";
                }elseif ($type == 'Bill'){
                    $preview = "-bill";
                }elseif ($type == 'Expense'){
                    $preview = "-expense";
                }elseif ($type == 'Vendor Credit'){
                    $preview = "-vc";
                }
                $file = $attachment->attachment;
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                switch ($extension){
                    case "txt":
                        $file = "default-txt.png";
                        break;
                    case "pdf":
                        $file = "default-pdf.png";
                        break;
                    case "xls":
                        $file = "default-excel.png";
                        break;
                    case "xlsb":
                        $file = "default-excel.png";
                        break;
                    case "xlsm":
                        $file = "default-excel.png";
                        break;
                    case "xlsx":
                        $file = "default-excel.png";
                        break;
                    case "docx":
                        $file = "default-word.png";
                        break;
                    case "doc":
                        $file = "default-word.png";
                        break;
                    default:
                        $file = $attachment->attachment;
                        break;
                }
                $display .= '<div class="modal-existing-file-section">';
                $display .= '<span>'.$attachment->original_filename.'</span>';
                $display .= '<img src="/uploads/accounting/expenses/'.$file.'" alt="Existing File" style="width: 250px;height: 150px;margin-bottom: 10px">';
                $display .= '<input type="hidden" id="attachmentType" value="'.$type.'">';
                $display .= '<input type="hidden" id="attachmentTypePreview" value="'.$preview.'">';
                $display .= '<input type="hidden" id="attachmentTransId" value="'.$transaction_id.'">';
                $display .= '<input type="hidden" id="attachTransFromId" value="'.$attachment->transaction_id.'">';
                $display .= '<input type="hidden" id="attachmentExpensesId" value="'.$expense_id.'">';
                $display .= '<a href="#" class="'.$disabled.'" id="addingFileAttachment" data-id="'.$attachment->id.'" data-fname="'.$attachment->original_filename.'" >'.$status.'</a>';
                $display .= '</div>';
                $display .= '<hr>';
        }

        echo json_encode($display);
    }

    public function rowCategories(){
        $transaction_id = $this->input->get('transaction_id');
        $row = $this->input->get('row');
        $cat_class = $this->input->get('cat_class');
        $des_class = $this->input->get('des_class');
        $amount_class = $this->input->get('amount_class');
        $counter = $this->input->get('counter');
        $remove = $this->input->get('remove_id');
        $select = $this->input->get('select');
        $preview = $this->input->get('preview');
        $get_categories = $this->db->get_where('accounting_expense_category',array('transaction_id' => $transaction_id));
        $result = $get_categories->result();
        $categories = '';
        $category_list = $this->categories_model->getCategories();
        if ($get_categories->num_rows() >= 2){
            foreach ($result as $cnt => $data){
                $category = ($data->category_id != null)?$data->category_id:"";
                $description = ($data->description != null)?$data->description:"";
                $amount = ($data->amount!=null)?$data->amount:0;
                $cnt += 1;
                $categories .= '<tr id="'.$row.'">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="'.$data->id.'">';
                        $categories .= '<span id="category-preview'.$preview.'">'.$list->category_name.'</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
                        $categories .= '<option value="'.$list->id.'" selected>'.$list->category_name.'</option>';
                    }
                }
//                foreach ($category_list as $list){
//                    if($list->id != $category){
//                        $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//                    }
//                }
                $categories .= '</select>';
                $categories .= ' </div>';
                $categories .= '</td>';
                $categories .= '<td><span id="description-preview'.$preview.'">'.$description.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value="'.$description.'"  ></div>';
                $categories .= '</td>';
                $categories .= '<td><span id="amount-preview'.$preview.'">'.$amount.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="'.$amount.'" ></div>';
                $categories .= '</td>';
                $categories .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
                $categories .= '</tr>';
            }
        }else{
            foreach ($result as $cnt => $data){
                $category = ($data->category_id != null)?$data->category_id:"";
                $description = ($data->description != null)?$data->description:"";
                $amount = ($data->amount!=null)?$data->amount:0;
                $cnt += 1;
                $categories .= '<tr id="'.$row.'">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="'.$data->id.'">';
                        $categories .= '<span id="category-preview'.$preview.'">'.$list->category_name.'</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
                        $categories .= '<option value="'.$list->id.'" selected>'.$list->category_name.'</option>';
                    }
                }
//                foreach ($category_list as $list){
//                    if($list->id != $category){
//                        $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//                    }
//                }
                $categories .= '</select>';
                $categories .= ' </div>';
                $categories .= '</td>';
                $categories .= '<td><span id="description-preview'.$preview.'">'.$description.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value="'.$description.'"  ></div>';
                $categories .= '</td>';
                $categories .= '<td><span id="amount-preview'.$preview.'">'.$amount.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="'.$amount.'" ></div>';
                $categories .= '</td>';
                $categories .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
                $categories .= '</tr>';
            }
            $description = "";
            $amount = 0;
            $cnt = 2;
            $categories .= '<tr id="'.$row.'">';
            $categories .= '<td></td>';
            $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
            $categories .= '<td>';
            $categories .= '<div id="" style="display:none;">';
            $categories .= '<input type="hidden" id="prevent_process" value="true">';
            $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
            $categories .= '<option></option>';
//            $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
//            foreach ($category_list as $list){
//                $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//            }
            $categories .= '</select>';
            $categories .= ' </div>';
            $categories .= '</td>';
            $categories .= '<td><span id="description-preview'.$preview.'">'.$description.'</span>';
            $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value="'.$description.'"  ></div>';
            $categories .= '</td>';
            $categories .= '<td><span id="amount-preview'.$preview.'"></span>';
            $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="'.$amount.'" ></div>';
            $categories .= '</td>';
            $categories .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
            $categories .= '</tr>';
        }

        echo json_encode($categories);
    }

    public function defaultCategoryRow(){
        $row = $this->input->get('row');
        $cat_class = $this->input->get('cat_class');
        $des_class = $this->input->get('des_class');
        $amount_class = $this->input->get('amount_class');
        $counter = $this->input->get('counter');
        $remove = $this->input->get('remove_id');
        $select = $this->input->get('select');
        $preview = $this->input->get('preview');
        $category_list = $this->categories_model->getCategories();
        $default = '';
        for ($x = 1;$x <= 2;$x++){
            $default .= '<tr id="'.$row.'">';
            $default .= '<td></td>';
            $default .= '<td><span id="'.$counter.'">'.$x.'</span></td>';
            $default .= '<td>';
            $default .= '<span id="category-preview'.$preview.'"></span>';
            $default .= '<div id="" style="display:none;">';
            $default .= '<input type="hidden" id="prevent_process" value="true">';
            $default .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
            $default .= '<option></option>';
//            $default .= '<option value="0" disabled id="add-expense-categories">&plus; Add Category</option>';
//            foreach ($category_list as $list){
//                $default .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//            }
            $default .= '</select>';
            $default .= '</div>';
            $default .= '</td>';
            $default .= '<td><span id="description-preview'.$preview.'"></span>';
            $default .= '<div style="display: none;"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value=""></div>';
            $default .= '</td>';
            $default .= '<td><span id="amount-preview'.$preview.'"></span>';
            $default .= '<div style="display: none;"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="0" ></div>';
            $default .= '</td>';
            $default .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
            $default .= '</tr>';
        }
        echo json_encode($default);

    }

    public function getCheckData(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $query = $this->db->get_where('accounting_check',array(
            'id' => $id
        ));
        $vendors_detail = $this->db->get_where('accounting_vendors',array('vendor_id'=>$query->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id'=>$transaction_id));
        if ($query->row()->print_later == 1){
            $print = true;
        }else{
            $print = false;
        }
        $std = new stdClass();
        $std->check_id = $id;
        $std->vendor_id = $query->row()->vendor_id;
        $std->vendor_name = $vendors_detail->row()->f_name.'&nbsp;'.$vendors_detail->row()->l_name;
        $std->bank_account = $query->row()->bank_id;
        $std->mailing = $query->row()->mailing_address;
        $std->payment_date = $query->row()->payment_date;
        $std->check_number = $query->row()->check_number;
        $std->print_later = $print;
        $std->permit_number = $query->row()->permit_number;
        $std->memo = $query->row()->memo;
        $std->check_category = ($check_category->num_rows() > 0)?true:false;

        echo json_encode($std);

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
            'memo' => $this->input->post('memo'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
			'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->addCheck($new_data);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
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
            'memo' => $this->input->post('memo'),
            'category_id' => $this->input->post('category_id'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->editCheckData($update);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
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
            'ref_number' => $this->input->post('ref_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->addExpense($new_data);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    public function getExpenseData(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_expense = $this->db->get_where('accounting_expense',array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id'=> $get_expense->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id' => $transaction_id));


        $data = new stdClass();
        $data->vendor_id = $get_expense->row()->vendor_id;
        $data->vendor_name = $vendors->row()->f_name.'&nbsp;'.$vendors->row()->l_name;
        $data->expense_id = $id;
        $data->payment_account = $get_expense->row()->payment_account;
        $data->payment_date = $get_expense->row()->payment_date;
        $data->payment_method = $get_expense->row()->payment_method;
        $data->ref_number = $get_expense->row()->ref_number;
        $data->permit_number = $get_expense->row()->permit_number;
        $data->memo = $get_expense->row()->memo;
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
            'ref_number' => $this->input->post('ref_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category_id' => $this->input->post('category_id'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->updateExpenseData($update);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
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
            'memo' => $this->input->post('memo'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->vendorCredit($new_data);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    public function getVendorCredit(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_vc = $this->db->get_where('accounting_vendor_credit',array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id'=> $get_vc->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id'=>$transaction_id));

        $data = new stdClass();
        $data->vc_id = $id;
        $data->vendor_id = $get_vc->row()->vendor_id;
        $data->vendor_name = $vendors->row()->display_name;
        $data->mailing_address = $get_vc->row()->mailing_address;
        $data->payment_date = $get_vc->row()->payment_date;
        $data->ref_number = $get_vc->row()->ref_number;
        $data->permit_number = $get_vc->row()->permit_number;
        $data->memo = $get_vc->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0)?true:false;

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
            'memo' => $this->input->post('memo'),
            'category_id' => $this->input->post('category_id'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->updateVendorCredit($update);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function deleteVendorCredit(){
        $id = $this->input->post('id');
        $this->expenses_model->deleteVendorCredit($id);
    }

    public function showExpenseTransactionsTable(){
        $vendors = $this->vendors_model->getVendors();
        $checks = $this->expenses_model->getCheck();
        $transactions = $this->expenses_model->getTransaction();
        $bills = $this->expenses_model->getBill();
        $vendor_credits = $this->expenses_model->getVendorCredit();
        $expenses = $this->expenses_model->getExpense();
        $list_categories = $this->categories_model->getCategories();
        $date = null;
        $type = null;
        $number = null;
        $vendors_name = null;
        $category = null;
        $description = null;
        $total = null;
        $category_id = null;
        $modal = null;
        $modal_id = null;
        $data_id = null;
        $delete = null;
        $category_list_id = null;
        $transaction_id = null;
        $show = '';
        foreach ($transactions as $transaction):
            if ($transaction->type == 'Check'){
                // Check
                foreach ($checks as $check){
                    if ($transaction->id == $check->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = $check->check_number;
                        $modal_id = "editCheck";
                        $data_id = $check->id;
                        $transaction_id = $check->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $check->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $delete = 'deleteCheck';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $check->transaction_id));
                        $check_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $check_category_id){
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }

                    }
                }
            }elseif ($transaction->type == 'Bill'){
//                                            Bill
                foreach ($bills as $bill){
                    if ($transaction->id == $bill->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editBill";
                        $transaction_id = $bill->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $bill->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $bill->id;
                                $delete = 'deleteBill';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $bill->transaction_id));
                        $bill_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $bill_category_id){
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }

                    }
                }
            }elseif ($transaction->type == 'Expense'){
//                                            Expense
                foreach ($expenses as $expense){
                    if ($transaction->id == $expense->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editExpense";
                        $transaction_id = $expense->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $expense->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $expense->id;
                                $delete = 'deleteExpense';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $expense->transaction_id));
                        $expense_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $expense_category_id){
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }


                    }
                }
            }elseif ($transaction->type == 'Vendor Credit'){
//                                            Vendor Credit
                foreach ($vendor_credits as $vendor_credit){
                    if ($transaction->id == $vendor_credit->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $payee = $vendor_credit->vendor_id;
                        $number = null;
                        $modal_id = "editVendorCredit";
                        $transaction_id = $vendor_credit->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $vendor_credit->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $vendor_credit->id;
                                $delete = 'deleteVendorCredit';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $vendor_credit->transaction_id));
                        $vc_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $vc_category_id){
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            }
        $show .= '<tr style="cursor: pointer;">';
        $show .= '<td><input type="checkbox"></td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$date.'</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$type.'</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$number.'</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$vendors_name.'</td>';
        $show .= '<td data-id="'.$data_id.'" data-transId="'.$transaction_id.'">';
        $show .= '<div style="display: inline-block;position: relative;width: 100%">';
        $show .= '<select name="category" id="expenseTransCategory" data-category="" data-id="'.$category_id.'" class="form-control select2-tbl-category">';
        $show .= '<option value="'.$category_list_id.'" selected>'.$category.'</option>';
            foreach ($list_categories as $list):
                if ($list->category_name == $category):
                    $show .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
                endif;
            endforeach;
        $show .= '</select>';
        $show .= '</div>';
        $show .= '<i class="fa fa-spinner fa-pulse" style="display: none;position: relative;"></i>';
        $show .= '</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$transaction->total.'</td>';
        $show .= '<td style="text-align: right;">';
        $show .= '<a href="#" id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'" style="margin-right: 10px;color: #0077c5;font-weight: 600;">View/Edit</a>';
        $show .= '<div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">';
        $show .= '<span class="fa fa-caret-down" data-toggle="dropdown"></span>';
        $show .= '<ul class="dropdown-menu dropdown-menu-right">';
        $show .= '<li><a href="#" id="copy">Copy</a></li>';
        $show .= '<li id="'.$delete.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">';
        $show .= '<a href="#" >Delete</a>';
        $show .= '</li>';
        $show .= '<li><a href="#">Void</a></li>';
        $show .= '</ul>';
        $show .= '</div>';
        $show .= '</td>';
        $show .= '</tr>';

            $date = null;
            $type = null;
            $number = null;
            $vendors_name = null;
            $category = null;
            $description = null;
            $total = null;
            $category_id = null;
            $modal = null;
            $modal_id = null;
            $data_id = null;
            $delete = null;
            $category_list_id = null;
            $transaction_id = null;
        endforeach;
        echo json_encode($show);
    }

    /***Get Update Add category ***/
    public function getExpensesCategories(){
        $transaction_id = $this->input->get('transaction_id');
        $search = $this->input->get('search');
        $categories_by_id = $this->categories_model->getCategoriesByTransactionId($transaction_id);
        $query = $this->categories_model->getCategories();
        $get_by_search = $this->categories_model->getCategoriesBySearch($search);
        $data = array();
        $data[] = array(
            'id' => 0,
            'text' => '+ Add category',
            'disabled' => true
        );
        if ($categories_by_id != null){
            foreach ($query as $categories){
                foreach ($categories_by_id as $category_by_id){
                    if ($categories->id == $category_by_id->category_id){
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type,
                            'selected' => true
                        );
                    }
                }
            }
            foreach ($query as $categories){
                foreach ($categories_by_id as $category_by_id){
                    if ($categories->id != $category_by_id->category_id){
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type
                        );
                    }
                }
            }
        }else{
            foreach ($get_by_search as $categories){
                $data[] = array(
                    'id' => $categories->id,
                    'text' => $categories->category_name,
                    'subtext' => $categories->type
                );
            }
        }

        echo json_encode($data);
    }
    public function addCategories(){
        $new_data = array(
            'account_type' => $this->input->post('account_type'),
            'detail_type' => $this->input->post('detail_type'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'sub_account' => $this->input->post('sub_account'),
        );
        $query = $this->expenses_model->addCategories($new_data);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    public function updateCategoryById(){
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $expenses_id = $this->input->post('expenses_id');
        $transaction_id = $this->input->post('transaction_id');
        if ($id == null){
            $new_category = array(
                'transaction_id'=> $transaction_id,
                'expenses_id' => $expenses_id,
                'category_id' => $category
            );
            $this->db->insert('accounting_expense_category',$new_category);
        }else{
            $data = array(
                'category_id' => $category
            );
            $this->db->where('id',$id);
            $this->db->update('accounting_expense_category',$data);
        }

        echo json_encode(1);
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