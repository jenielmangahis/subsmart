<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();

        $this->load->library('session');

        //helper
        $this->load->helper('accounting/reports_helper');
        $this->load->helper('functions_helper');
        $this->load->model('general_model');
        $this->load->model('accounting_favorite_reports_model');
        $this->load->model('accounting_report_groups_model');
        $this->load->model('accounting_report_types_model');

        $this->load->model('accounting_customers_model');
        $this->load->model('vendors_model');
        $this->load->model('timesheet_model');
        $this->load->model('accounting_management_reports');

        $this->load->model('accounting_invoices_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('AcsBilling_model');
        $this->load->model('DepositDetail_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('items_model');
        $this->load->model('accounting_single_time_activity_model');
        $this->load->model('tags_model');

        add_css(array(
            // "assets/css/accounting/banking.css?v='rand()'",
            // "assets/css/accounting/accounting.css",
            // "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css",
            "assets/css/accounting/accounting_includes/receive_payment.css",
            "assets/css/accounting/accounting_includes/customer_sales_receipt_modal.css",
            "assets/css/accounting/accounting_includes/create_charge.css",
            "assets/css/accounting/invoices_page.css",
            "assets/css/accounting/accounting_includes/send_reminder_by_batch_modal.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/js/accounting/modal-forms1.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js",
            "assets/js/accounting/sales/invoices_page.js",
            "assets/js/accounting/sales/customer_includes/send_reminder_by_batch_modal.js"
        ));

		$this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow", array()),
                array("Expenses", array('Expenses', 'Vendors')),
                array("Sales", array('Overview', 'All Sales', 'Estimates', 'Customers', 'Deposits', 'Work Order', 'Invoice', 'Jobs', 'Products and services')),
                array("Payroll", array('Overview', 'Employees', 'Contractors', "Workers' Comp", 'Benifits')),
                array("Reports", array()),
                array("Taxes", array("Sales Tax", "Payroll Tax")),
                // array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts", "Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                // array('/accounting/banking',array()),
                // array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array('/accounting/cashflowplanner', array()),
                array("", array('/accounting/expenses', '/accounting/vendors')),
                array("", array('/accounting/sales-overview', '/accounting/all-sales', '/accounting/newEstimateList', '/accounting/customers', '/accounting/deposits', '/accounting/listworkOrder', '/accounting/invoices', '/accounting/jobs', '/accounting/products-and-services')),
                array("", array('/accounting/payroll-overview', '/accounting/employees', '/accounting/contractors', '/accounting/workers-comp', '#')),
                array('/accounting/reports', array()),
                array("", array('/accounting/salesTax', '/accounting/payrollTax')),
                // array('#',  array()),
                array("", array('/accounting/chart-of-accounts', '/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card", "fa-money", "fa-dollar", "fa-bar-chart", "fa-minus-circle", "fa-file", "fa-calculator");
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId(logged('company_id'));
        $this->page_data['invoices'] = $this->invoice_model->getAllData(logged('company_id'));
        $this->page_data['clients'] = $this->invoice_model->getclientsData(logged('company_id'));
        $this->page_data['invoices_sales'] = $this->invoice_model->getAllDataSales(logged('company_id'));
        $this->page_data['OpenInvoices'] = $this->invoice_model->getAllOpenInvoices(logged('company_id'));
        $this->page_data['InvOverdue'] = $this->invoice_model->InvOverdue(logged('company_id'));
        $this->page_data['getAllInvPaid'] = $this->invoice_model->getAllInvPaid(logged('company_id'));
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->workorder_model->getPackagelist(logged('company_id'));
        $this->page_data['estimates'] = $this->estimate_model->getAllByCompanynDraft(logged('company_id'));
        $this->page_data['sales_receipts'] = $this->accounting_sales_receipt_model->getAllByCompany(logged('company_id'));
        $this->page_data['credit_memo'] = $this->accounting_credit_memo_model->getAllByCompany(logged('company_id'));
        $this->page_data['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['statements'] = $this->accounting_statements_model->getAllComp(logged('company_id'));
        $this->page_data['rpayments'] = $this->accounting_receive_payment_model->getReceivePaymentsByComp(logged('company_id'));
        $this->page_data['checks'] = $this->vendors_model->get_check_by_comp(logged('company_id'));
        $this->page_data['payment_methods'] = $this->accounting_receive_payment_model->get_payment_methods(logged('company_id'));
        $this->page_data['deposits_to'] = $this->accounting_receive_payment_model->get_deposits_to(logged('company_id'));

        $this->page_data['invoicesItems'] = $this->invoice_model->getInvoicesItems(logged('company_id'));
    }
    public $report_type_id = '';

    public function index()
    {
        // add_css([
        //     'assets/css/accounting/reports/management_reports.css'
        // ]);

        add_footer_js([
            'assets/js/accounting/reports/index.js'
            // 'assets/js/accounting/reports/management_reports.js'
        ]);

        $reportGroups = $this->accounting_report_groups_model->get_report_groups();

        foreach($reportGroups as $key => $reportGroup) {
            if ($reportGroup->description === 'Favorites') {
                $reportGroups[$key]->report_types = $this->accounting_report_types_model->get_favorite_reports(logged('company_id'));
            } else {
                $reportGroups[$key]->report_types = $this->accounting_report_types_model->get_by_group($reportGroup->id);
            }
        }

        $this->page_data['reportGroups'] = $reportGroups;
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/index', $this->page_data);
    }

    public function add_to_favorites($reportTypeId)
    {
        $favoriteId = $this->accounting_favorite_reports_model->add_to_favorites($reportTypeId, logged('company_id'));

        echo json_encode([
            'data' => $favoriteId,
            'success' => $favoriteId ? true : false
        ]);
    }

    public function remove_from_favorites($reportTypeId)
    {
        $delete = $this->accounting_favorite_reports_model->remove_from_favorites($reportTypeId, logged('company_id'));

        echo json_encode([
            'data' => $reportTypeId,
            'success' => $delete ? true : false
        ]);
    }

    public function custom()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Custom Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/custom', $this->page_data);
    }

    public function management()
    {
        add_css([
            'assets/css/accounting/reports/management_reports.css'
        ]);

        add_footer_js([
            'assets/js/accounting/reports/management_reports.js'
        ]);

        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Management Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/management_reports', $this->page_data);
    }

    public function activities()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Activities Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/activities', $this->page_data);
    }

    public function analytics()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Analytics';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/analytics', $this->page_data);
    }

    public function payscale()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'PayScale';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/payscale', $this->page_data);
    }

    public function audit_log()
    {
        add_footer_js([
            'assets/js/accounting/reports/standard_report_pages/audit_log.js'
        ]);

        $this->page_data['company_users'] = $this->users_model->getActiveCompanyUsers(logged('company_id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Audit Log";

        $this->page_data['page']->title = 'Audit Log';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/standard_report_pages/audit_log', $this->page_data);
    }

    public function ffcra_cares_act_report()
    {
        add_footer_js([
            'assets/js/accounting/reports/standard_report_pages/ffcra_cares_act_report.js'
        ]);

        $this->page_data['company_users'] = $this->users_model->getActiveCompanyUsers(logged('company_id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "FFCRA Cares Act Report";

        $this->page_data['page']->title = 'FFCRA Cares Act Report';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/standard_report_pages/ffcra_cares_act_report', $this->page_data);
    }


    public function view_report($reportTypeId)
    {
        $reportType = $this->accounting_report_types_model->get_by_id($reportTypeId);
        $view = strtolower(str_replace(' ', '_', $reportType->name));
        $view = str_replace('-', '_', $view);
        $view = str_replace('&', 'and', $view);
        $view = str_replace('/', '_', $view);
        $js = str_replace('%', 'percentage', $view);

        add_footer_js([
            "assets/js/accounting/reports/standard_report_pages/$js.js"
        ]);

// CUSTOMER CONTACT LIST
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['customer'] = $this->AcsProfile_model->getCustomer();
        $this->page_data['customerType'] = $this->AcsProfile_model->getCustomerType();
        $this->page_data['status'] = $this->AcsProfile_model->getStatus();
        $this->page_data['reportTypeId'] = $reportTypeId;
        $this->page_data['page']->title = $reportType->name;
        $this->page_data['page']->parent = 'Reports';
        if(!empty($exportBtn)){
            $this->export_report($view, $this->page_data);
        }

        $sort_by = $this->input->post('sort_by');
        $cust = $this->input->post('customer');
        $fl_cust = $this->input->post('fl_customer');
        $fl_type = $this->input->post('fl_type');
        $fl_status = $this->input->post('fl_status');
        $header = $this->input->post('header');
        $exportBtn = $this->input->post('exportReport');

        $this->page_data['report_title'] = $reportType->name;
        $this->page_data['header'] = $header;
        $this->page_data['foot'] = false;
        $this->page_data['head'] = false;
        //$this->page_data['company_title'] = $this->page_data['clients']->business_name;

        //header and footer
        if(!empty($header)){
            if(in_array('isCompany', $header)){
                $this->page_data['company_title'] = $header['company'];
                $this->page_data['head'] = true;
            }else{
                $this->page_data['company_title'] = "";
            }

            if(in_array('isReport', $header)){
                $this->page_data['report_title'] = $header['report'];
                $this->page_data['head'] = true;
            }else{
                $this->page_data['report_title'] = "";
            }

            if(in_array('isDate', $header)){
                $this->page_data['date_prepared'] = date("l, F j, Y");
                $this->page_data['foot'] = true;


            }else{
                $this->page_data['date_prepared'] = "";
            }

            if(in_array('isTime', $header)){
                $this->page_data['time_prepared'] = date("h:i A eP");
                $this->page_data['foot'] = true;
            }else{
                $this->page_data['time_prepared'] = "";
            }
        }
        $gbArray = array();
        if($sort_by != 'default' && !empty($sort_by)){
            $getBill = $this->AcsBilling_model->getBilling($sort_by);
            $gb = json_decode(json_encode($getBill), true);
            foreach($gb as $g_b){
                array_push($gbArray, $g_b['fk_prof_id']);
            }
        }
        if(!empty($cust)){
            $custImp = implode(", ", $cust);
            $custExp = explode(",", $custImp);

            if(!empty($sort_by)){
                $column = billPro($custExp);
            }else{
                $column = $custExp;
            }
        $this->page_data['custExp'] = $cust;
        }
        $this->page_data['tblDefault'] = true;  
        if(!empty($sort_by) || !empty($cust) || !empty($fl_cust) || !empty($fl_type) || !empty($fl_status)){
             $this->page_data['tblDefault'] = false;  
        }
        $this->page_data['acs_profile'] = $this->AcsProfile_model->getProfile($sort_by, $column, $fl_cust, $fl_status, $fl_type);
        if($reportType->name === 'Profit and Loss by Tag Group') {
            $this->page_data['group_tags'] = $this->tags_model->getGroup();
        }
// DEPOSIT DETAILS
        $this->page_data['payment_records'] = $this->DepositDetail_model->getPaymentRecord(logged('company_id'));
        $this->page_data['payment_records_acs'] = $this->DepositDetail_model->getPaymentRecordACS(logged('company_id'));
        $this->page_data['getPaymentACS'] = $this->DepositDetail_model->getPaymentACS(logged('company_id'));
        // $this->page_data['invoices'] = $this->invoice_model->getPaidInv(getLoggedCompanyID());
        $payments = $this->invoice_model->get_company_payments(logged('company_id'));

        $deposits = [];
        foreach($payments as $payment)
        {
            $invoice = $this->invoice_model->get_invoice_by_invoice_number($payment->invoice_number, logged('company_id'));
            $customer = $this->accounting_customers_model->get_by_id($invoice->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;
            $deposits[$payment->payment_date]['invoices'][] = [
                'invoice_id' => $invoice->id,
                'customer_name' => $customerName,
                'payment_method' => $payment->payment_method,
                'ref_no' => $invoice->invoice_number,
                'fees' => floatval($payment->invoice_tip),
                'amount' => floatval($payment->invoice_amount)
            ];
        }

        foreach($deposits as $date => $deposit)
        {
            $amountCol = array_column($deposit['invoices'], 'amount');
            $deposits[$date]['total'] = array_sum($amountCol);

            $feesCol = array_column($deposit['invoices'], 'fees');
            $deposits[$date]['fees'] = array_sum($feesCol);
        }
        $this->page_data['deposits'] = $deposits;

        switch($view) {
            case 'recent_edited_time_activities' :
                $timeActivities = $this->accounting_single_time_activity_model->get_company_time_activities(['company_id' => logged('company_id')]);

                $activities = [];
                foreach($timeActivities as $timeActivity) {
                    $customer = $this->accounting_customers_model->get_by_id($timeActivity->customer_id);
                    $customerName = $customer->first_name . ' ' . $customer->last_name;
                    $productName = $this->items_model->getItemById($timeActivity->service_id)[0]->title;

                    switch($timeActivity->name_key) {
                        case 'employee' :
                            $employee = $this->users_model->getUser($timeActivity->name_id);
                            $employeeName = $employee->FName . ' ' . $employee->LName;
                        break;
                        case 'vendor' :
                            $vendor = $this->vendors_model->get_vendor_by_id($timeActivity->name_id);
                            $employeeName = $vendor->display_name;
                        break;
                    }

                    $price = floatval(str_replace(',', '', $timeActivity->hourly_rate));

                    $hours = substr($timeActivity->time, 0, -3);
                    $time = explode(':', $hours);
                    $hr = $time[0] + ($time[1] / 60);

                    $total = $hr * $price;

                    $activities[] = [
                        'activity_date' => date("m/d/Y", strtotime($timeActivity->date)),
                        'last_modified' => date("m/d/Y H:i:s A", strtotime($timeActivity->updated_at)),
                        'customer' => $customerName,
                        'employee' => $employeeName,
                        'product_service' => $productName,
                        'memo_desc' => $timeActivity->description,
                        'rates' => number_format(floatval($timeActivity->hourly_rate), 2),
                        'duration' => $timeActivity->time,
                        'billable' => $timeActivity->billable === '1' ? 'Yes' : 'No',
                        'amount' => $timeActivity->billable === '1' ? number_format($total, 2) : ''
                    ];
                }

                $this->page_data['activities'] = $activities;
            break;
        }

        $this->load->view("accounting/reports/standard_report_pages/$view", $this->page_data);
    }

    public function export_report(){
        $input = $this->input->post();
        $header = json_decode($input['headers']); //headers from table
        $customerData = json_decode($input['customerDatas'], true); //data from table

        
        $data_arr = array("success" => TRUE,"message" => 'Customer Settings Export added.');
        die(json_encode($data_arr));
    }

    public function estimatesByCustomer(){
        $data = array(
            "where" => array(
                "company_id" => logged('company_id')
            ),
            "where_not_in" => array(
                "status" => "Draft"
            ),
            "table" => "estimates",
            "select" => "id, user_id, customer_id, estimate_number, status, accepted_date, grand_total"
        );

        $customer = $this->estimate_model->getEstimatesByCustomerWithParam($data);
        $amountCustomer = array(
            "where" => array(
                "company_id" => logged('company_id')
            ),
            "where_not_in" => array(
                "status" => "Draft"
            ),
            "table" => "estimates",
            "select" => "SUM(grand_total) as ttlAmount, customer_id",
            "group_by" => "customer_id"
        );

        $distinct_customer = array(
            "where" => array(
                "company_id" => logged('company_id')
            ),
            "where_not_in" => array(
                "status" => "Draft"
            ),
            "table" => "estimates",
            "select" => "DISTINCT(customer_id) as id",
        );
        $customerId = $this->estimate_model->getEstimatesByCustomerWithParam($distinct_customer);
        $customerName = [];
        foreach($customerId as $cid){
            array_push($customerName, get_estimate_customer_name($cid->id));
        }
        $totalAmount = $this->estimate_model->getEstimatesByCustomerWithParam($amountCustomer);
        if($customer){
            $data_arr = array("success" => true, "customer" => $customer, "totalAmount" => $totalAmount, "customerName" => $customerName);
        }else{
            $data_arr = array("success" => false);
        }

        die(json_encode($data_arr));
    }

    public function view_reports_data()
    {
        $param = [];
        $input = $this->input->post();
        $customerCol = json_decode($input['customerCol']);
        $estimateCol = json_decode($input['estimateCol']);
        $estimateColText = json_decode($input['estimateColText']);
        $customerColText = json_decode($input['customerColText']);
        $group_by = $input['group_by'];
        $date_from = $input['date_from'];
        $date_to = $input['date_to'];
        
        $filter_estimate_data = array(
            'select' => 'id',
            'table' => 'estimates',
            'where' => array(
                'estimate_date >=' => $date_from,
                'estimate_date <=' => $date_to,
            )
            );

        if(($date_from != 'NaN-NaN-NaN') && ($date_to != 'NaN-NaN-NaN')){
            $filtered_data = $this->estimate_model->getEstimatesByCustomerWithParam($filter_estimate_data);
        }
        $customer = ($input['customerCol'] != '[]') ? selectCustomerEstimate($customerCol, 'customer') : 'null';
        $estimate = ($input['customerCol'] != '[]') ? selectCustomerEstimate($estimateCol, 'estimate') : 'null';

        if($customer != 'null' && $estimate != 'null'){
            $selected_col = array_merge($customerCol,$estimateCol);
            $header['header'] = array_merge($customerColText,$estimateColText);
        }else{
            if($customer != 'null'){
                $selected_col = $customer;
            }elseif($estimate != 'null'){
                $selected_col = $estimate;
            }else{
                $selected_col = array('acs_profile.first_name', 'estimates.estimate_number', 'estimates.status', 'estimates.accepted_date', 'estimates.expiry_date', 'estimates.grand_total');
            }
        }

        //get where param
        $where_date = [];
        $where = [];
        $date_filter = [];
        if(!empty($filtered_data)){
            foreach($filtered_data as $fltrData){
                array_push($where_date, $fltrData->id);
            }
            $param['where_in'] = array('id' => $where_date);
            $date_filter = array('estimates.id' => implode(',',$where_date));
            //array_push($where, $date_filter);
        }
        $company = array('estimates.company_id' => logged('company_id'));
        $user = array('estimates.user_id' => logged('id'));
        $where = array_merge($company, $user);
        $param['where'] = $where;
        
        //get select param
        if(!empty($selected_col)){
            $param['select'] = $selected_col;
        }   
        //get table param
        $param['table'] = 'estimates';
        //get join param
        $param['join'] = array('acs_profile' => 'acs_profile.prof_id = estimates.customer_id');
        //get group param
        if(!empty($group_by)){
            $param['group_by'] = "estimates.".$group_by;
        }

        $column = [];
        for($i=0; $i<count($selected_col); $i++){
            $pos = substr($selected_col[$i],strpos($selected_col[$i], '.')+1);
            $trimmed_pos = str_replace(' ','',$pos);
            array_push($column, $trimmed_pos);
        }
        $header['column'] = $column;
        $estimate_data = $this->estimate_model->getEstimatesByCustomerWithParam($param);

        $data_arr = array("success" => true, "data" => $estimate_data, "header" => $header, "column" => $column, "select" => $selected_col);
        die(json_encode($data_arr));
    }

    public function getCustomerContactList()
    {
        // $input = $this->input->post();
        
        // if(empty($input)){
        //     $data = array(
        //         'table' => 'acs_profile',
        //         'select' => 'acs_profile.first_name, acs_profile.last_name, acs_profile.phone_h, acs_profile.email, acs_profile.mail_add, acs_profile.city, acs_profile.state, acs_profile.zip_code',
        //         'join' => array('acs_billing' => 'acs_profile.prof_id = acs_billing.fk_prof_id'),
        //         'where' => array(
        //             'fk_user_id' => logged('id'),
        //             'company_id' => logged('company_id')
        //         ),
        //     );
        //     $acs_profile = $this->AcsProfile_model->getProfileWithParam($data);
        //     $data_arr = array("success" => true, "acs_profile" => $acs_profile);    
        // }

        // else{
        //     $customerCol = json_decode($input['customerCol']);
        //     $billingCol = json_decode($input['billingCol']);
        //     if($customerCol != 'null' && $billingCol != 'null'){
        //         $selected_col = array_merge($customerCol,$billingCol);
        //     }else{
        //         if($customerCol != 'null'){
        //             $selected_col = $customerCol;
        //         }elseif($billingCol != 'null'){
        //             $selected_col = $billingCol;
        //         }else{
        //             $selected_col = array('acs_profile.first_name, acs_profile.last_name, acs_profile.phone_h, acs_profile.email, acs_profile.mail_add, acs_profile.city, acs_profile.state, acs_profile.zip_code');
        //         }
        //     }
        //     if(!empty($selected_col)){
        //         $param['select'] = $selected_col;
        //     }   
        //     //get table param
        //     $param['table'] = 'acs_profile';
        //     //get join param
        //     $param['join'] = array('acs_billing' => 'acs_profile.prof_id = acs_billing.fk_prof_id');
        //     $param['where'] = array('acs_profile.fk_user_id' => logged('id'), 'acs_profile.company_id' => logged('company_id'));
        //     $acs_profile = $this->AcsProfile_model->getProfileWithParam($param);
        //     $data_arr = array("success" => true, "acs_profile" => $acs_profile);    
        // }
        // die(json_encode($data_arr));

        $DATA = array(
            'table' => 'acs_profile',
            'select' => 'CONCAT(first_name  , " ", last_name) AS CUSTOMER, phone_h AS PHONE_NUMBER, email AS EMAIL, mail_add AS BILLING_ADDRESS, CONCAT(city, " ", state, " ", zip_code) AS SHIPPING_ADDRESS',
            'where' => array(
                'fk_user_id' => logged('id'),
                'company_id' => logged('company_id')
            )
        );
        $REQUEST_DATA = $this->general_model->get_data_with_param($DATA);

        echo '{ "data":'.json_encode($REQUEST_DATA).'}';
    }

    public function saveNotes() {
        $TABLE = "accounting_report_types";
        $ID = $this->input->post('REPORT_ID');
        $NOTES = $this->input->post('REPORT_NOTES');

        $DATA = array(
            'notes' => $NOTES,
        );

        $INSERT = $this->accounting_customers_model->addNotes($TABLE, $DATA, $ID);
        echo "true";
    }

    public function getNotes() {
       $TABLE = "accounting_report_types";
       $ID = $this->input->post('REPORT_ID');
       
       $DATA = array(
            'table' => $TABLE,
            'select' => 'notes',
            'where' => array(
                'id' => $ID,
            )
        );
        $REQUEST_DATA = $this->general_model->get_data_with_param($DATA);

        echo $REQUEST_DATA[0]->notes;
    }

    public function EstimatesInvoiceByCustomer(){   
        $input = $this->input->post();
        $header = json_decode($input['header']);
        $company_name = $input['company_name'];
        $report_title = $input['report_title'];

        $cust_header = [];

        //default values
        $cust_header['company_title'] = $this->page_data['clients']->business_name;
        $cust_header['report_title'] = 'Estimates & Progress Invoicing Summary by Customer';
        $cust_header['date_prepared'] = date("l, F j, Y");
        $cust_header['time_prepared'] = date("h:i A eP");

        if(empty($input)){
            $data = array(
                "where" => array(
                    "company_id" => logged('company_id')
                ),
                "table" => "estimates",
                "select" => "id, customer_id, estimate_date, estimate_number, status, grand_total"
            );

            $customer = $this->estimate_model->getEstimatesByCustomerWithParam($data);
            $distinct_customer = array(
                "where" => array(
                    "company_id" => logged('company_id')
                ),
                "where_not_in" => array(
                    "status" => "Draft"
                ),
                "table" => "estimates",
                "select" => "DISTINCT(customer_id) as id",
            );
            $customerId = $this->estimate_model->getEstimatesByCustomerWithParam($distinct_customer);
            $customerName = [];
            foreach($customerId as $cid){
                array_push($customerName, get_estimate_customer_name($cid->id));
            }
            $data_arr = array("success"=> true, "def" => true, "customer" => $customer, "customerName" => $customerName, "custHeader" => $cust_header);
        }

        //header and footer
        if(!empty($header)){
            if(in_array('isCompany', $header)){
                $cust_header['company_title'] = $company_name;
                $cust_header['head'] = true;
            }else{
                $cust_header['company_title'] = "";
            }

            if(in_array('isReport', $header)){
                $cust_header['report_title'] = $report_title;
                $cust_header['head'] = true;
            }else{
                $cust_header['report_title'] = "";
            }

            if(in_array('isDate', $header)){
                $cust_header['date_prepared'] = date("l, F j, Y");
                $cust_header['foot'] = true;


            }else{
                $cust_header['foot'] = true;
                $cust_header['date_prepared'] = "";
            }

            if(in_array('isTime', $header)){
                $cust_header['time_prepared'] = date("h:i A eP");
                $cust_header['foot'] = true;
            }else{
                $cust_header['foot'] = true;
                $cust_header['time_prepared'] = "";
            }

            $data_arr = array("success" => true, "cust_header" => $cust_header);
        }
        die(json_encode($data_arr));
    }
}