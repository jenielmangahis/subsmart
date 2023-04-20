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

        $this->load->model('accounting_report_type_notes_model');
        $this->load->model('accounting_custom_reports_model');
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

        $this->page_data['modalsView'] = $view.'_modals';
        $this->page_data['reportNote'] = $this->accounting_report_type_notes_model->get_note(logged('company_id'), $reportTypeId);
        add_footer_js([
            "assets/js/accounting/reports/standard_report_pages/$js.js",
            "assets/js/v2/printThis.js"
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

                    $rates = number_format(floatval($timeActivity->hourly_rate), 2);
                    $amount = $timeActivity->billable === '1' ? number_format($total, 2) : '';
                    if(!empty(get('divide-by-100'))) {
                        $rates = floatval($rates) / 100;
                        $amount = number_format(floatval($amount) / 100, 2);

                        $ratesExplode = explode('.', $rates);

                        $rates = number_format($rates, strlen($ratesExplode[1]) > 1 ? strlen($ratesExplode[1]) : 2 );
                    }

                    if(!empty(get('without-cents'))) {
                        $rates = number_format(floatval($rates), 0);
                        $amount = number_format(floatval($amount), 0);
                    }

                    if(!empty(get('negative-numbers'))) {
                        switch(get('negative-numbers')) {
                            case '(100)' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = '('.$rates.')';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = '('.$amount.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = $rates.'-';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = $amount.'-';
                                }
                            break;
                        }
                    }

                    if(!empty(get('show-in-red'))) {
                        if(empty(get('negative-numbers'))) {
                            if(substr($rates, 0, 1) === '-') {
                                $rates = '<span class="text-danger">'.$rates.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rates, 0, 1) === '(' && substr($rates, -1) === ')') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rates, -1) === '-') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                            }
                        }

                        if(empty(get('negative-numbers'))) {
                            if(substr($amount, 0, 1) === '-') {
                                $amount = '<span class="text-danger">'.$amount.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($amount, 0, 1) === '(' && substr($amount, -1) === ')') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($amount, -1) === '-') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $activities[] = [
                        'activity_date' => date("m/d/Y", strtotime($timeActivity->date)),
                        'create_date' => $timeActivity->created_at,
                        'created_by' => '',
                        'last_modified' => $timeActivity->updated_at,
                        'last_modified_by' => '',
                        'customer_id' => $timeActivity->customer_id,
                        'customer' => $customerName,
                        'employee_id' => $timeActivity->name_id,
                        'employee_key' => $timeActivity->name_key,
                        'employee' => $employeeName,
                        'item_id' => $timeActivity->service_id,
                        'product_service' => $productName,
                        'memo_desc' => $timeActivity->description,
                        'rates' => $rates,
                        'duration' => substr($timeActivity->time, 0, -3),
                        'start_time' => substr($timeActivity->start_time, 0, -3),
                        'end_time' => substr($timeActivity->end_time, 0, -3),
                        'break' => substr($timeActivity->break_duration, 0, -3),
                        'taxable' => $timeActivity->taxable === '1' ? 'Yes' : '',
                        'billable' => $timeActivity->billable === '1' ? 'Yes' : 'No',
                        'invoice_date' => '',
                        'amount' => $timeActivity->billable === '1' ? $amount : ''
                    ];
                }

                if(!empty(get('date'))) {
                    $filters = [
                        'start-date' => str_replace('-', '/', get('from')),
                        'end-date' => str_replace('-', '/', get('to'))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['activity_date']) >= strtotime($filters['start-date']) && strtotime($v['activity_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['filter_date'] = get('date');
                    $this->page_data['start_date'] = str_replace('-', '/', get('from'));
                    $this->page_data['end_date'] = str_replace('-', '/', get('to'));
                }

                $sort = [
                    'column' => !empty(get('column')) ? str_replace('-', '_', get('column')) : 'last_modified',
                    'order' => empty(get('order')) ? 'asc' : 'desc'
                ];

                usort($activities, function($a, $b) use ($sort) {
                    if(strpos($sort['column'], 'date') !== false || in_array($sort['column'], ['break', 'duration', 'end_time', 'start_time', 'last_modified'])) {
                        if($a[$sort['column']] === $b[$sort['column']]) {
                            return strtotime($b['create_date']) > strtotime($a['create_date']);
                        }

                        if($sort['order'] === 'asc') {
                            return strtotime($a[$sort['column']]) > strtotime($b[$sort['column']]);
                        } else {
                            return strtotime($a[$sort['column']]) < strtotime($b[$sort['column']]);
                        }
                    } else {
                        if($sort['order'] === 'asc') {
                            return strcmp($a[$sort['column']], $b[$sort['column']]);
                        } else {
                            return strcmp($b[$sort['column']], $a[$sort['column']]);
                        }
                    }
                });

                if(!empty(get('column'))) {
                    $this->page_data['sort_by'] = get('column');
                }

                if(!empty(get('order'))) {
                    $this->page_data['sort_in'] = get('order');
                }

                if(!empty(get('divide-by-100'))) {
                    $this->page_data['divide_by_100'] = get('divide-by-100');
                }

                if(!empty(get('without-cents'))) {
                    $this->page_data['without_cents'] = get('without-cents');
                }

                if(!empty(get('negative-numbers'))) {
                    $this->page_data['negative_numbers'] = get('negative-numbers');
                }

                if(!empty(get('show-in-red'))) {
                    $this->page_data['show_in_red'] = get('show-in-red');
                }

                if(!empty(get('limit'))) {
                    $this->page_data['limit'] = get('limit');
                    $activities = array_slice($activities, 0, intval(get('limit')));
                } else {
                    $activities = array_slice($activities, 0, 25);
                }

                if(!empty(get('columns'))) {
                    $columns = explode(',', get('columns'));
                    $this->page_data['columns'] = $columns;
                }

                if(!empty(get('customer'))) {
                    $this->page_data['filter_customer'] = new stdClass();
                    $this->page_data['filter_customer']->id = get('customer');
                    if(!in_array(get('customer'), ['all', 'not-specified', 'specified'])) {
                        $customer = $this->accounting_customers_model->get_by_id(get('customer'));
                        $customerName = $customer->first_name . ' ' . $customer->last_name;
                        $this->page_data['filter_customer']->name = $customerName;

                        $filters = [
                            'customer_id' => get('customer')
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['customer_id'] === $filters['customer_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $this->page_data['filter_customer']->name = ucwords(str_replace('-', ' ', get('customer')));

                        if(get('customer') === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty(get('product-service'))) {
                    $this->page_data['product_service'] = new stdClass();
                    $this->page_data['product_service']->id = get('product-service');
                    if(!in_array(get('product-service'), ['all', 'not-specified', 'specified'])) {
                        $item = $this->items_model->getByID(get('product-service'));
                        $this->page_data['product_service']->name = $item->title;

                        $filters = [
                            'item_id' => get('product-service')
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['item_id'] === $filters['item_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $this->page_data['product_service']->name = ucwords(str_replace('-', ' ', get('product-service')));

                        if(get('product-service') === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty(get('employee'))) {
                    $this->page_data['employee'] = new stdClass();
                    $this->page_data['employee']->id = get('employee');
                    if(!in_array(get('employee'), ['all', 'not-specified', 'specified'])) {
                        $explode = explode('-', get('employee'));

                        switch($explode[0]) {
                            case 'employee' :
                                $employee = $this->users_model->getUserByID($explode[1]);
                                $this->page_data['employee']->name = $employee->FName . ' ' . $employee->LName . ' - Employee';
                            break;
                            case 'vendor' :
                                $vendor = $this->vendors_model->get_vendor_by_id($explode[1]);
                                $this->page_data['employee']->name = $vendor->display_name . ' - Vendor';
                            break;
                        }

                        $filters = [
                            'key' => $explode[0],
                            'id' => $explode[1]
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['employee_key'] === $filters['key'] && $v['employee_id'] === $filters['id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $this->page_data['employee']->name = ucwords(str_replace('-', ' ', get('employee')));

                        if(get('employee') === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty(get('create-date'))) {
                    $this->page_data['create_date'] = get('create-date');
                    $this->page_data['create_date_from'] = str_replace('-', '/', get('create-date-from'));
                    $this->page_data['create_date_to'] = str_replace('-', '/', get('create-date-to'));

                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', get('create-date-from'))),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', get('create-date-to')))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['create_date']) >= strtotime($filters['start-date']) && strtotime($v['create_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('last-modified-date'))) {
                    $this->page_data['last_modified_date'] = get('last-modified-date');

                    if(get('last-modified-date') !== 'all-dates') {
                        $this->page_data['last_modified_date_from'] = str_replace('-', '/', get('last-modified-date-from'));
                        $this->page_data['last_modified_date_to'] = str_replace('-', '/', get('last-modified-date-to'));
    
                        $filters = [
                            'start-date' => str_replace('-', '/', str_replace('-', '/', get('last-modified-date-from'))),
                            'end-date' => str_replace('-', '/', str_replace('-', '/', get('last-modified-date-to')))
                        ];
    
                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return strtotime($v['last_modified']) >= strtotime($filters['start-date']) && strtotime($v['last_modified']) <= strtotime($filters['end-date']);
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                }

                if(!empty(get('billable'))) {
                    $this->page_data['billable'] = get('billable');

                    $filters = [
                        'billable' => get('billable')
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return $v['billable'] === ucfirst($filters['billable']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('memo'))) {
                    $this->page_data['memo'] = get('memo');

                    $filters = [
                        'memo' => get('memo')
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return stripos($v['memo_desc'], trim($filters['memo'])) !== false;
                    }, ARRAY_FILTER_USE_BOTH);
                }

                $this->page_data['activities'] = $activities;

                if(!empty(get('show-logo'))) {
                    $this->page_data['show_logo'] = true;
                    $this->page_data['company_logo'] = companyProfileImage(logged('company_id'));
                }

                $this->page_data['company_name'] = $this->page_data['clients']->business_name;
                if(!empty(get('show-company-name'))) {
                    $this->page_data['show_company_name'] = false;
                }

                if(!empty(get('company-name'))) {
                    $this->page_data['company_name'] = get('company-name');
                }

                $this->page_data['report_title'] = 'Recent/Edited Time Activities';
                if(!empty(get('show-report-title'))) {
                    $this->page_data['show_report_title'] = false;
                }

                if(!empty(get('report-title'))) {
                    $this->page_data['report_title'] = get('report-title');
                }

                if(!empty(get('show-report-period'))) {
                    $this->page_data['show_report_period'] = false;
                }

                $this->page_data['prepared_timestamp'] = "l, F j, Y h:i A eP";
                if(!empty(get('show-date-prepared'))) {
                    $this->page_data['show_date_prepared'] = false;
                    $this->page_data['prepared_timestamp'] = str_replace("l, F j, Y", "", $this->page_data['prepared_timestamp']);
                    $this->page_data['prepared_timestamp'] = trim($this->page_data['prepared_timestamp']);
                }

                if(!empty(get('show-time-prepared'))) {
                    $this->page_data['show_time_prepared'] = false;
                    $this->page_data['prepared_timestamp'] = str_replace("h:i A eP", "", $this->page_data['prepared_timestamp']);
                    $this->page_data['prepared_timestamp'] = trim($this->page_data['prepared_timestamp']);
                }

                if(!empty(get('header-alignment'))) {
                    $this->page_data['header_alignment'] = get('header-alignment') === 'left' ? 'start' : 'end';
                }

                if(!empty(get('footer-alignment'))) {
                    $this->page_data['footer_alignment'] = get('footer-alignment') === 'left' ? 'start' : 'end';
                }
            break;
            case 'time_activities_by_employee_detail' :
                $timeActivities = $this->accounting_single_time_activity_model->get_company_time_activities(['company_id' => logged('company_id')]);

                if(!empty(get('column'))) {
                    $this->page_data['sort_by'] = get('column');
                }

                if(!empty(get('order'))) {
                    $this->page_data['sort_in'] = get('order');
                }

                if(!empty(get('divide-by-100'))) {
                    $this->page_data['divide_by_100'] = get('divide-by-100');
                }

                if(!empty(get('without-cents'))) {
                    $this->page_data['without_cents'] = get('without-cents');
                }

                if(!empty(get('negative-numbers'))) {
                    $this->page_data['negative_numbers'] = get('negative-numbers');
                }

                if(!empty(get('show-in-red'))) {
                    $this->page_data['show_in_red'] = get('show-in-red');
                }

                if(!empty(get('columns'))) {
                    $columns = explode(',', get('columns'));
                    $this->page_data['columns'] = $columns;
                }

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

                    $rates = number_format(floatval($timeActivity->hourly_rate), 2);
                    $amount = $timeActivity->billable === '1' ? number_format($total, 2) : '';
                    if(!empty(get('divide-by-100'))) {
                        $rates = floatval($rates) / 100;
                        $amount = number_format(floatval($amount) / 100, 2);

                        $ratesExplode = explode('.', $rates);

                        $rates = number_format($rates, strlen($ratesExplode[1]) > 1 ? strlen($ratesExplode[1]) : 2 );
                    }

                    if(!empty(get('without-cents'))) {
                        $rates = number_format(floatval($rates), 0);
                        $amount = number_format(floatval($amount), 0);
                    }

                    if(!empty(get('negative-numbers'))) {
                        switch(get('negative-numbers')) {
                            case '(100)' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = '('.$rates.')';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = '('.$amount.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = $rates.'-';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = $amount.'-';
                                }
                            break;
                        }
                    }

                    if(!empty(get('show-in-red'))) {
                        if(empty(get('negative-numbers'))) {
                            if(substr($rates, 0, 1) === '-') {
                                $rates = '<span class="text-danger">'.$rates.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rates, 0, 1) === '(' && substr($rates, -1) === ')') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rates, -1) === '-') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                            }
                        }

                        if(empty(get('negative-numbers'))) {
                            if(substr($amount, 0, 1) === '-') {
                                $amount = '<span class="text-danger">'.$amount.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($amount, 0, 1) === '(' && substr($amount, -1) === ')') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($amount, -1) === '-') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $activities[] = [
                        'activity_date' => date("m/d/Y", strtotime($timeActivity->date)),
                        'create_date' => $timeActivity->created_at,
                        'created_by' => '',
                        'last_modified' => $timeActivity->updated_at,
                        'last_modified_by' => '',
                        'customer_id' => $timeActivity->customer_id,
                        'customer' => $customerName,
                        'employee_id' => $timeActivity->name_id,
                        'employee_key' => $timeActivity->name_key,
                        'employee' => $employeeName,
                        'item_id' => $timeActivity->service_id,
                        'product_service' => $productName,
                        'memo_desc' => $timeActivity->description,
                        'rates' => $rates,
                        'duration' => substr($timeActivity->time, 0, -3),
                        'start_time' => substr($timeActivity->start_time, 0, -3),
                        'end_time' => substr($timeActivity->end_time, 0, -3),
                        'break' => substr($timeActivity->break_duration, 0, -3),
                        'taxable' => $timeActivity->taxable === '1' ? 'Yes' : '',
                        'billable' => $timeActivity->billable === '1' ? 'Yes' : 'No',
                        'invoice_date' => '',
                        'amount' => $timeActivity->billable === '1' ? $amount : ''
                    ];
                }

                $this->page_data['start_date'] = date("m/01/Y");
                $this->page_data['end_date'] = date("m/d/Y");
                $this->page_data['report_period'] = date("F 1-j, Y");
                if(!empty(get('date'))) {
                    $this->page_data['filter_date'] = get('date');
                    if(get('date') !== 'all-dates') {
                        $this->page_data['start_date'] = str_replace('-', '/', get('from'));
                        $this->page_data['end_date'] = str_replace('-', '/', get('to'));
                    }

                    switch(get('date')) {
                        case 'all-dates' :
                            $this->page_data['report_period'] = 'All Dates';
                        break;
                        case 'today' :
                            $this->page_data['report_period'] = date("F j, Y", strtotime($this->page_data['start_date']));
                        break;
                        case 'yesterday' :
                            $this->page_data['report_period'] = date("F j, Y", strtotime($this->page_data['start_date']));
                        break;
                        case 'this-month' :
                            $this->page_data['report_period'] = date("F Y");
                        break;
                        case 'last-month' :
                            $this->page_data['report_period'] = date("F Y", strtotime($this->page_data['start_date']));
                        break;
                        case 'next-month' :
                            $this->page_data['report_period'] = date("F Y", strtotime($this->page_data['start_date']));
                        break;
                        case 'this-quarter' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $this->page_data['report_period'] = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'last-quarter' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $this->page_data['report_period'] = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'next-quarter' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $this->page_data['report_period'] = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'this-year' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $this->page_data['report_period'] = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'last-year' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $this->page_data['report_period'] = $startMonth.'-'.$endMonth.' '.date("Y", strtotime($startDate));
                        break;
                        case 'next-year' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $this->page_data['report_period'] = $startMonth.'-'.$endMonth.' '.date("Y", strtotime($startDate));
                        break;
                        case 'this-year-to-last-month' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $this->page_data['report_period'] = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'since-30-days-ago' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));

                            $this->page_data['report_period'] = 'Since '.$startDate;
                        break;
                        case 'since-60-days-ago' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));

                            $this->page_data['report_period'] = 'Since '.$startDate;
                        break;
                        case 'since-90-days-ago' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));

                            $this->page_data['report_period'] = 'Since '.$startDate;
                        break;
                        case 'since-365-days-ago' :
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));

                            $this->page_data['report_period'] = 'Since '.$startDate;
                        break;
                        default : 
                            $startDate = date("F j, Y", strtotime($this->page_data['start_date']));
                            $endDate = date("F j, Y", strtotime($this->page_data['end_date']));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $startYear = date("Y", strtotime($startDate));
                            $endYear = date("Y", strtotime($endDate));

                            if($startMonth === $endMonth && $startYear === $endYear) {
                                $this->page_data['report_period'] = date("F j", strtotime($startDate)).' - '.date("j, Y", strtotime($endDate));
                            } else if($startYear !== $endYear) {
                                $this->page_data['report_period'] = date("F j, Y", strtotime($startDate)).' - '.date("F j, Y", strtotime($endDate));
                            } else {
                                $this->page_data['report_period'] = date("F j", strtotime($startDate)).' - '.date("F j, Y", strtotime($endDate));
                            }
                        break;
                    }
                }

                if($this->page_data['filter_date'] !== 'all-dates') {
                    $filters = [
                        'start-date' => $this->page_data['start_date'],
                        'end-date' => $this->page_data['end_date']
                    ];
    
                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['activity_date']) >= strtotime($filters['start-date']) && strtotime($v['activity_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('customer'))) {
                    $this->page_data['filter_customer'] = new stdClass();
                    $this->page_data['filter_customer']->id = get('customer');
                    if(!in_array(get('customer'), ['all', 'not-specified', 'specified'])) {
                        $customer = $this->accounting_customers_model->get_by_id(get('customer'));
                        $customerName = $customer->first_name . ' ' . $customer->last_name;
                        $this->page_data['filter_customer']->name = $customerName;

                        $filters = [
                            'customer_id' => get('customer')
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['customer_id'] === $filters['customer_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $this->page_data['filter_customer']->name = ucwords(str_replace('-', ' ', get('customer')));

                        if(get('customer') === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty(get('product-service'))) {
                    $this->page_data['product_service'] = new stdClass();
                    $this->page_data['product_service']->id = get('product-service');
                    if(!in_array(get('customer'), ['all', 'not-specified', 'specified'])) {
                        $item = $this->items_model->getByID(get('product-service'));
                        $this->page_data['product_service']->name = $item->title;

                        $filters = [
                            'item_id' => get('product-service')
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['item_id'] === $filters['item_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $this->page_data['product_service']->name = ucwords(str_replace('-', ' ', get('product-service')));

                        if(get('product-service') === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty(get('employee'))) {
                    $this->page_data['employee'] = new stdClass();
                    $this->page_data['employee']->id = get('employee');
                    if(!in_array(get('employee'), ['all', 'not-specified', 'specified'])) {
                        $explode = explode('-', get('employee'));

                        switch($explode[0]) {
                            case 'employee' :
                                $employee = $this->users_model->getUserByID($explode[1]);
                                $this->page_data['employee']->name = $employee->FName . ' ' . $employee->LName . ' - Employee';
                            break;
                            case 'vendor' :
                                $vendor = $this->vendors_model->get_vendor_by_id($explode[1]);
                                $this->page_data['employee']->name = $vendor->display_name . ' - Vendor';
                            break;
                        }

                        $filters = [
                            'key' => $explode[0],
                            'id' => $explode[1]
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['employee_key'] === $filters['key'] && $v['employee_id'] === $filters['id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $this->page_data['employee']->name = ucwords(str_replace('-', ' ', get('employee')));

                        if(get('employee') === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty(get('create-date'))) {
                    $this->page_data['create_date'] = get('create-date');
                    $this->page_data['create_date_from'] = str_replace('-', '/', get('create-date-from'));
                    $this->page_data['create_date_to'] = str_replace('-', '/', get('create-date-to'));

                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', get('create-date-from'))),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', get('create-date-to')))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['create_date']) >= strtotime($filters['start-date']) && strtotime($v['create_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('last-modified-date'))) {
                    $this->page_data['last_modified_date'] = get('last-modified-date');
                    $this->page_data['last_modified_date_from'] = str_replace('-', '/', get('last-modified-date-from'));
                    $this->page_data['last_modified_date_to'] = str_replace('-', '/', get('last-modified-date-to'));

                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', get('last-modified-date-from'))),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', get('last-modified-date-to')))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['last_modified']) >= strtotime($filters['start-date']) && strtotime($v['last_modified']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('billable'))) {
                    $this->page_data['billable'] = get('billable');

                    $filters = [
                        'billable' => get('billable')
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return $v['billable'] === ucfirst($filters['billable']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('memo'))) {
                    $this->page_data['memo'] = get('memo');

                    $filters = [
                        'memo' => get('memo')
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return stripos($v['memo_desc'], trim($filters['memo'])) !== false;
                    }, ARRAY_FILTER_USE_BOTH);
                }

                $sort = [
                    'column' => !empty(get('column')) ? str_replace('-', '_', get('column')) : 'last_modified',
                    'order' => empty(get('order')) ? 'asc' : 'desc'
                ];

                usort($activities, function($a, $b) use ($sort) {
                    if(strpos($sort['column'], 'date') !== false || in_array($sort['column'], ['break', 'duration', 'end_time', 'start_time', 'last_modified'])) {
                        if($a[$sort['column']] === $b[$sort['column']]) {
                            return strtotime($b['create_date']) > strtotime($a['create_date']);
                        }

                        if($sort['order'] === 'asc') {
                            return strtotime($a[$sort['column']]) > strtotime($b[$sort['column']]);
                        } else {
                            return strtotime($a[$sort['column']]) < strtotime($b[$sort['column']]);
                        }
                    } else {
                        if($sort['order'] === 'asc') {
                            return strcmp($a[$sort['column']], $b[$sort['column']]);
                        } else {
                            return strcmp($b[$sort['column']], $a[$sort['column']]);
                        }
                    }
                });

                $grouped = [];
                if(get('group-by') !== 'none')
                {
                    switch(get('group-by')) {
                        case 'customer' :
                            usort($activities, function($a, $b) {
                                return strcmp($a['customer'], $b['customer']); 
                            });
                        break;
                        case 'product-service' :
                            usort($activities, function($a, $b) {
                                return strcmp($a['product_service'], $b['product_service']);
                            });
                        break;
                        case 'day' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'month' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'quarter' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'year' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'week' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'work-week' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        default :
                            usort($activities, function($a, $b) {
                                return strcmp($a['employee'], $b['employee']);
                            });
                        break;
                    }

                    foreach($activities as $activity)
                    {
                        switch(get('group-by')) {
                            case 'customer' :
                                $key = $activity['customer_id'];
                                $name = $activity['customer'];
                            break;
                            case 'product-service' :
                                $key = $activity['item_id'];
                                $name = $activity['product_service'];
                            break;
                            case 'day' :
                                $key = str_replace('/', '-', $activity['activity_date']);
                                $name = date("F j, Y", strtotime($activity['activity_date']));
                            break;
                            case 'week' :
                                $ddate = $activity['activity_date'];
                                $date = new DateTime($ddate);
                                $week = intval($date->format("W"));
                                $year = date('Y', strtotime($ddate));

                                $key = $week.'-'.$year;

                                $day = date("l", strtotime($ddate));
                                switch($day) {
                                    case 'Monday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -1 day'));
                                    break;
                                    case 'Tuesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -2 days'));
                                    break;
                                    case 'Wednesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -3 days'));
                                    break;
                                    case 'Thursday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -4 days'));
                                    break;
                                    case 'Friday' :
                                        $weekStart = date("F j", strtotime($ddate.' -5 days'));
                                    break;
                                    case 'Saturday' :
                                        $weekStart = date("F j", strtotime($ddate.' -6 days'));
                                    break;
                                    case 'Sunday' :
                                        $weekStart = date("F j", strtotime($ddate));
                                    break;
                                }

                                $weekEnd = date("F j, Y", strtotime($weekStart.' +6 days'));
                                $weekStartMonth = date("F", strtotime($weekStart));
                                $weekEndMonth = date("F", strtotime($weekEnd));
                                $weekStartYear = date("Y", strtotime($weekStart));
                                $weekEndYear = date("Y", strtotime($weekEnd));

                                if($weekStartMonth === $weekEndMonth && $weekStartYear === $weekEndYear) {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("j, Y", strtotime($weekEnd));
                                } else if($weekStartYear !== $weekEndYear) {
                                    $name = date("F j, Y", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                } else {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                }
                            break;
                            case 'work-week' :
                                $ddate = $activity['activity_date'];
                                $date = new DateTime($ddate);
                                $week = intval($date->format("W"));
                                $year = date('Y', strtotime($ddate));

                                $key = $week.'-'.$year;

                                $day = date("l", strtotime($ddate));
                                switch($day) {
                                    case 'Monday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -1 day'));
                                    break;
                                    case 'Tuesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -2 days'));
                                    break;
                                    case 'Wednesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -3 days'));
                                    break;
                                    case 'Thursday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -4 days'));
                                    break;
                                    case 'Friday' :
                                        $weekStart = date("F j", strtotime($ddate.' -5 days'));
                                    break;
                                    case 'Saturday' :
                                        $weekStart = date("F j", strtotime($ddate.' -6 days'));
                                    break;
                                    case 'Sunday' :
                                        $weekStart = date("F j", strtotime($ddate));
                                    break;
                                }

                                $weekEnd = date("F j, Y", strtotime($weekStart.' +6 days'));
                                $weekStartMonth = date("F", strtotime($weekStart));
                                $weekEndMonth = date("F", strtotime($weekEnd));
                                $weekStartYear = date("Y", strtotime($weekStart));
                                $weekEndYear = date("Y", strtotime($weekEnd));

                                if($weekStartMonth === $weekEndMonth && $weekStartYear === $weekEndYear) {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("j, Y", strtotime($weekEnd));
                                } else if($weekStartYear !== $weekEndYear) {
                                    $name = date("F j, Y", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                } else {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                }
                            break;
                            case 'month' :
                                $key = date("m-Y", strtotime($activity['activity_date']));
                                $name = date("F Y", strtotime($activity['activity_date']));
                            break;
                            case 'quarter' :
                                $month = date("n", strtotime($activity['activity_date']));

                                $quarter = ceil($month / 3);

                                switch($quarter) {
                                    case 1 :
                                        $key = date("01-03-Y", strtotime($activity['activity_date']));
                                        $name = "January - March ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                    case 2 :
                                        $key = date("04-06-Y", strtotime($activity['activity_date']));
                                        $name = "April - June ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                    case 3 :
                                        $key = date("07-09-Y", strtotime($activity['activity_date']));
                                        $name = "July - September ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                    case 4:
                                        $key = date("10-12-Y", strtotime($activity['activity_date']));
                                        $name = "October - December ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                }
                            break;
                            case 'year' :
                                $key = date("Y", strtotime($activity['activity_date']));
                                $name = date("Y", strtotime($activity['activity_date']));
                            break;
                            default :
                                $key = $activity['employee_key'].'-'.$activity['employee_id'];
                                $name = $activity['employee'];
                            break;
                        }
                        if(array_key_exists($key, $grouped)) {
                            $grouped[$key]['activities'][] = $activity;
                            $duration = $grouped[$key]['duration_total'];
                            $amount = $grouped[$key]['amount_total'];

                            $durationExplode = explode(':', $duration);
                            $totalHrs = intval($durationExplode[0]);
                            $totalMins = intval($durationExplode[1]);

                            $actDuration = $activity['duration'];
                            $actDurationExplode = explode(':', $actDuration);
                            $actHrs = intval($actDurationExplode[0]);
                            $actMins = intval($actDurationExplode[1]);
                            $actAmount = $activity['amount'];

                            $totalHrs += $actHrs;
                            $totalMins += $actMins;

                            if($totalMins >= 60) {
                                do {
                                    $totalHrs++;
                                    $totalMins -= 60;
                                } while($totalMins >= 60);
                            }

                            if(strlen($totalHrs) === 1) {
                                $totalHrs = '0'.$totalHrs;
                            }

                            if(strlen($totalMins) === 1) {
                                $totalMins = '0'.$totalMins;
                            }

                            $grouped[$key]['duration_total'] = $totalHrs.':'.$totalMins;
                            $grouped[$key]['amount_total'] = number_format(floatval($amount) + floatval($actAmount), 2);
                        } else {
                            $grouped[$key] = [
                                'name' => $name,
                                'duration_total' => $activity['duration'],
                                'amount_total' => $activity['amount'],
                                'activities' => [
                                    $activity
                                ]
                            ];
                        }
                    }
                } else {
                    $grouped = $activities;
                }

                if(!empty(get('group-by'))) {
                    $this->page_data['group_by'] = get('group-by');
                }

                $activities = $grouped;

                $this->page_data['activities'] = $activities;
                $this->page_data['company_name'] = $this->page_data['clients']->business_name;
                if(!empty(get('show-company-name'))) {
                    $this->page_data['show_company_name'] = false;
                }

                if(!empty(get('company-name'))) {
                    $this->page_data['company_name'] = get('company-name');
                }

                $this->page_data['report_title'] = 'Time Activities by Employee Detail';
                if(!empty(get('show-report-title'))) {
                    $this->page_data['show_report_title'] = false;
                }

                if(!empty(get('report-title'))) {
                    $this->page_data['report_title'] = get('report-title');
                }

                if(!empty(get('show-report-period'))) {
                    $this->page_data['show_report_period'] = false;
                }
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

    public function export($reportTypeId)
    {
        $this->load->library('PHPXLSXWriter');
        $this->load->helper('pdf_helper');
        $post = $this->input->post();
        $order = $post['order'];
        $columnName = $post['column'];

        $reportType = $this->accounting_report_types_model->get_by_id($reportTypeId);

        switch($reportType->name) {
            case 'Recent/Edited Time Activities' :
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

                    $rates = number_format(floatval($timeActivity->hourly_rate), 2);
                    $amount = $timeActivity->billable === '1' ? number_format($total, 2) : '';
                    if(!empty($post['divide-by-100'])) {
                        $rates = floatval($rates) / 100;
                        $amount = number_format(floatval($amount) / 100, 2);

                        $ratesExplode = explode('.', $rates);

                        $rates = number_format($rates, strlen($ratesExplode[1]) > 1 ? strlen($ratesExplode[1]) : 2 );
                    }

                    if(!empty($post['without-cents'])) {
                        $rates = number_format(floatval($rates), 0);
                        $amount = number_format(floatval($amount), 0);
                    }

                    if(!empty($post['negative-numbers'])) {
                        switch($post['negative-numbers']) {
                            case '(100)' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = '('.$rates.')';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = '('.$amount.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = $rates.'-';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = $amount.'-';
                                }
                            break;
                        }
                    }

                    if(!empty($post['show-in-red'])) {
                        if(empty($post['negative-numbers'])) {
                            if(substr($rates, 0, 1) === '-') {
                                $rates = '<span class="text-danger">'.$rates.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rates, 0, 1) === '(' && substr($rates, -1) === ')') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rates, -1) === '-') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                            }
                        }

                        if(empty($post['negative-numbers'])) {
                            if(substr($amount, 0, 1) === '-') {
                                $amount = '<span class="text-danger">'.$amount.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($amount, 0, 1) === '(' && substr($amount, -1) === ')') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($amount, -1) === '-') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $activities[] = [
                        'activity_date' => date("m/d/Y", strtotime($timeActivity->date)),
                        'create_date' => date("m/d/Y H:i:s A", strtotime($timeActivity->created_at)),
                        'created_by' => '',
                        'last_modified' => date("m/d/Y H:i:s A", strtotime($timeActivity->updated_at)),
                        'last_modified_by' => '',
                        'customer_id' => $timeActivity->customer_id,
                        'customer' => $customerName,
                        'employee_id' => $timeActivity->name_id,
                        'employee_key' => $timeActivity->name_key,
                        'employee' => $employeeName,
                        'item_id' => $timeActivity->service_id,
                        'product_service' => $productName,
                        'memo_description' => $timeActivity->description,
                        'rates' => !empty($timeActivity->hourly_rate) ? $rates : '',
                        'duration' => substr($timeActivity->time, 0, -3),
                        'start_time' => substr($timeActivity->start_time, 0, -3),
                        'end_time' => substr($timeActivity->end_time, 0, -3),
                        'break' => substr($timeActivity->break_duration, 0, -3),
                        'taxable' => $timeActivity->taxable === '1' ? 'Yes' : '',
                        'billable' => $timeActivity->billable === '1' ? 'Yes' : 'No',
                        'invoice_date' => '',
                        'amount' => $timeActivity->billable === '1' ? $amount : ''
                    ];
                }

                if(!empty($post['limit'])) {
                    $activities = array_slice($activities, 0, intval($post['limit']));
                }

                if(!empty($post['date'])) {
                    $filters = [
                        'start-date' => str_replace('-', '/', $post['from']),
                        'end-date' => str_replace('-', '/', $post['to'])
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['activity_date']) >= strtotime($filters['start-date']) && strtotime($v['activity_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                $sort = [
                    'column' => !empty($post['column']) ? str_replace('-', '_', $post['column']) : 'last_modified',
                    'order' => empty($post['order']) ? 'asc' : 'desc'
                ];

                usort($activities, function($a, $b) use ($sort) {
                    if(strpos($sort['column'], 'date') !== false || in_array($sort['column'], ['break', 'duration', 'end_time', 'start_time', 'last_modified'])) {
                        if($a[$sort['column']] === $b[$sort['column']]) {
                            return strtotime($b['create_date']) > strtotime($a['create_date']);
                        }

                        if($sort['order'] === 'asc') {
                            return strtotime($a[$sort['column']]) > strtotime($b[$sort['column']]);
                        } else {
                            return strtotime($a[$sort['column']]) < strtotime($b[$sort['column']]);
                        }
                    } else {
                        if($sort['order'] === 'asc') {
                            return strcmp($a[$sort['column']], $a[$sort['column']]);
                        } else {
                            return strcmp($b[$sort['column']], $b[$sort['column']]);
                        }
                    }
                });

                if(!empty($post['customer'])) {
                    if(!in_array($post['customer'], ['all', 'not-specified', 'specified'])) {
                        $customer = $this->accounting_customers_model->get_by_id($post['customer']);
                        $customerName = $customer->first_name . ' ' . $customer->last_name;

                        $filters = [
                            'customer_id' => $post['customer']
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['customer_id'] === $filters['customer_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        if($post['customer'] === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty($post['product-service'])) {
                    if(!in_array($post['product-service'], ['all', 'not-specified', 'specified'])) {
                        $item = $this->items_model->getByID($post['product-service']);

                        $filters = [
                            'item_id' => $post['product-service']
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['item_id'] === $filters['item_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {

                        if($post['product-service'] === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty($post['employee'])) {
                    if(!in_array($post['employee'], ['all', 'not-specified', 'specified'])) {
                        $explode = explode('-', $post['employee']);

                        switch($explode[0]) {
                            case 'employee' :
                                $employee = $this->users_model->getUserByID($explode[1]);
                            break;
                            case 'vendor' :
                                $vendor = $this->vendors_model->get_vendor_by_id($explode[1]);
                            break;
                        }

                        $filters = [
                            'key' => $explode[0],
                            'id' => $explode[1]
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['employee_key'] === $filters['key'] && $v['employee_id'] === $filters['id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        if($post['employee'] === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty($post['create-date'])) {
                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', $post['create-date-from'])),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', $post['create-date-to']))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['create_date']) >= strtotime($filters['start-date']) && strtotime($v['create_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['last-modified-date'])) {
                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', $post['last-modified-date-from'])),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', $post['last-modified-date-to']))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['last_modified']) >= strtotime($filters['start-date']) && strtotime($v['last_modified']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['billable'])) {
                    $filters = [
                        'billable' => $post['billable']
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return $v['billable'] === ucfirst($filters['billable']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['memo'])) {
                    $filters = [
                        'memo' => $post['memo']
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return stripos($v['memo_desc'], trim($filters['memo'])) !== false;
                    }, ARRAY_FILTER_USE_BOTH);
                }

                $companyName = $this->page_data['clients']->business_name;
                if(!empty($post['company-name'])) {
                    $companyName = str_replace('%20', ' ', $post['company-name']);
                }
                $reportName = $reportType->name;
                if(!empty($post['report-title'])) {
                    $reportName = str_replace('%20', ' ', $post['report-title']);
                }

                $headerAlignment = 'center';
                if(!empty($post['header-alignment'])) {
                    $headerAlignment = $post['header-alignment'];
                }

                $footerAlignment = 'center';
                if(!empty($post['footer-alignment'])) {
                    $footerAlignment = $post['footer-alignment'];
                }

                $preparedTimestamp = "l, F j, Y h:i A eP";
                if(!empty($post['show-date-prepared'])) {
                    $preparedTimestamp = str_replace("l, F j, Y", "", $preparedTimestamp);
                    $preparedTimestamp = trim($preparedTimestamp);
                }

                if(!empty($post['show-time-prepared'])) {
                    $preparedTimestamp = str_replace("h:i A eP", "", $preparedTimestamp);
                    $preparedTimestamp = trim($preparedTimestamp);
                }
                $date = date($preparedTimestamp);

                $reportNote = $this->accounting_report_type_notes_model->get_note(logged('company_id'), $reportTypeId);

                if($post['type'] === 'excel') {
                    $writer = new XLSXWriter();
                    $row = 0;

                    $header = [];
                    foreach($post['fields'] as $field)
                    {
                        $header[] = 'string';
                    }

                    $writer->writeSheetHeader('Sheet1', $header, array('suppress_row'=>true));
    
                    if(empty($post['show-company-name'])) {
                        $writer->writeSheetRow('Sheet1', [$companyName], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', 0, 0, 0, count($post['fields']) - 1);
                        $row++;
                    }
                    if(empty($post['show-report-title'])) {
                        $writer->writeSheetRow('Sheet1', [$reportName], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row++;
                    }
                    if(!empty($post['show-report-period'])) {
                        $reportPeriod = "Created/Edited: Since " . date("F j, Y");
                        $writer->writeSheetRow('Sheet1', [$reportPeriod], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row++;
                    }

                    $writer->writeSheetRow('Sheet1', $post['fields'], ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);
                    $row += 2;
                    foreach($activities as $activity) {
                        $data = [];

                        $style = [];
                        foreach($post['fields'] as $field) {
                            if($field === 'Rates' || $field === 'Amount') {
                                if(stripos($activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], '<span class="text-danger">') !== false) {
                                    $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('<span class="text-danger">', '', $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                    $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('</span>', '', $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                // if(substr($activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], 0, 1) === '-') {
                                    $style[] = ['color' => '#FF0000'];
                                } else {
                                    $style[] = ['color' => '#000000'];
                                }
                            } else {
                                $style[] = ['color' => '#000000'];
                            }
                            $data[] = $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))];
                        }

                        $writer->writeSheetRow('Sheet1', $data, $style);

                        $row++;
                    }

                    $writer->writeSheetRow('Sheet1', []);
                    $writer->writeSheetRow('Sheet1', []);

                    if(!empty($reportNote) && !empty($reportNote->notes)) {
                        $row += 1;
                        $writer->writeSheetRow('Sheet1', ['Notes'], ['font-style' => 'bold', 'border' => 'bottom']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row += 1;
                        $writer->writeSheetRow('Sheet1', [$reportNote->notes]);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $writer->writeSheetRow('Sheet1', []);
                        $row += 1;
                    }

                    $row += 1;

                    $writer->writeSheetRow('Sheet1', [$date], ['halign' => $footerAlignment, 'valign' => 'center']);
                    $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);

                    $fileName = str_replace(' ', '_', $companyName).'_Recent_Edited_Time_Activities';
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header("Content-Disposition: attachment;filename=Recent_Edited_Time_Activities.xlsx");
                    header('Cache-Control: max-age=0');
                    $writer->writeToStdOut();
                } else {
                    $html = '
                        <table style="padding-top:-40px;">
                            <tr>
                                <td style="text-align: '.$headerAlignment.'">';
                                    $html .= empty($post['show-company-name']) ? '<h2 style="margin: 0">'.$companyName.'</h2>' : '';
                                    $html .= empty($post['show-report-title']) ? '<h3 style="margin: 0">'.$reportName.'</h3>' : '';
                                    $html .= !empty($post['show-report-period']) ? '<h4 style="margin: 0">Created/Edited: Since '.date("F j, Y").'</h4>' : '';
                                $html .= '</td>
                            </tr>
                        </table>
                        <br /><br /><br />

                        <table style="width="100%;>
                        <thead>
                            <tr>';
                            foreach($post['fields'] as $field) {
                                $html .= '<th style="border-top: 1px solid black; border-bottom: 1px solid black"><b>'.$field.'</b></th>';
                            }
                        $html .= '</tr>
                        </thead>
                        <tbody>';

                        foreach($activities as $activity) {
                            $html .= '<tr>';
                            foreach($post['fields'] as $field) {
                                $html .= '<td>'.str_replace('class="text-danger"', 'style="color: red"', $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]).'</td>';
                            }
                            $html .= '</tr>';
                        }
                    
                    $html .= '</tbody>';
                    $html .= '<tfoot>';
                    if(!empty($reportNote) && !empty($reportNote->notes)) {
                    $html .= '<tr>
                            <td colspan="'.count($post['fields']).'" style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td colspan="'.count($post['fields']).'">
                                <h4><b>Notes</b></h4>
                                '.$reportNote->notes.'
                            </td>
                        </tr>';
                    }
                    $html .= '<tr style="text-align: '.$footerAlignment.'">
                                <td colspan="'.count($post['fields']).'">
                                    <p style="margin: 0">'.$date.'</p>
                                </td>
                            </tr>
                        </tfoot>
                    </table>';

                    $fileName = str_replace(' ', '_', $companyName).'_Recent_Edited_Time_Activities';

                    tcpdf();
                    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $title = "Recent/Edited Time Activities";
                    $obj_pdf->SetTitle($title);
                    $obj_pdf->setPrintHeader(false);
                    $obj_pdf->setPrintFooter(false);
                    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                    $obj_pdf->SetDefaultMonospacedFont('helvetica');
                    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                    $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
                    $obj_pdf->SetFont('helvetica', '', 9);
                    $obj_pdf->setFontSubsetting(false);
                    $obj_pdf->AddPage();
                    ob_end_clean();
                    $obj_pdf->writeHTML($html, true, false, true, false, '');
                    $obj_pdf->Output(str_replace(' ', '_', $companyName).'_Recent_Edited_Time_Activities.pdf', 'D');
                }
            break;
            case 'Time Activities by Employee Detail' :
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

                    $rates = number_format(floatval($timeActivity->hourly_rate), 2);
                    $amount = $timeActivity->billable === '1' ? number_format($total, 2) : '';
                    if(!empty($post['divide-by-100'])) {
                        $rates = floatval($rates) / 100;
                        $amount = number_format(floatval($amount) / 100, 2);

                        $ratesExplode = explode('.', $rates);

                        $rates = number_format($rates, strlen($ratesExplode[1]) > 1 ? strlen($ratesExplode[1]) : 2 );
                    }

                    if(!empty($post['without-cents'])) {
                        $rates = number_format(floatval($rates), 0);
                        $amount = number_format(floatval($amount), 0);
                    }

                    if(!empty($post['negative-numbers'])) {
                        switch($post['negative-numbers']) {
                            case '(100)' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = '('.$rates.')';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = '('.$amount.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rates, 0, 1) === '-') {
                                    $rates = str_replace('-', '', $rates);
                                    $rates = $rates.'-';
                                }
        
                                if(substr($amount, 0, 1) === '-') {
                                    $amount = str_replace('-', '', $amount);
                                    $amount = $amount.'-';
                                }
                            break;
                        }
                    }

                    if(!empty($post['show-in-red'])) {
                        if(empty($post['negative-numbers'])) {
                            if(substr($rates, 0, 1) === '-') {
                                $rates = '<span class="text-danger">'.$rates.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rates, 0, 1) === '(' && substr($rates, -1) === ')') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rates, -1) === '-') {
                                        $rates = '<span class="text-danger">'.$rates.'</span>';
                                    }
                                break;
                            }
                        }

                        if(empty($post['negative-numbers'])) {
                            if(substr($amount, 0, 1) === '-') {
                                $amount = '<span class="text-danger">'.$amount.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($amount, 0, 1) === '(' && substr($amount, -1) === ')') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($amount, -1) === '-') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $activities[] = [
                        'activity_date' => date("m/d/Y", strtotime($timeActivity->date)),
                        'create_date' => date("m/d/Y H:i:s A", strtotime($timeActivity->created_at)),
                        'created_by' => '',
                        'last_modified' => date("m/d/Y H:i:s A", strtotime($timeActivity->updated_at)),
                        'last_modified_by' => '',
                        'customer_id' => $timeActivity->customer_id,
                        'customer' => $customerName,
                        'employee_id' => $timeActivity->name_id,
                        'employee_key' => $timeActivity->name_key,
                        'employee' => $employeeName,
                        'item_id' => $timeActivity->service_id,
                        'product_service' => $productName,
                        'memo_description' => $timeActivity->description,
                        'rates' => !empty($timeActivity->hourly_rate) ? $rates : '',
                        'duration' => substr($timeActivity->time, 0, -3),
                        'start_time' => substr($timeActivity->start_time, 0, -3),
                        'end_time' => substr($timeActivity->end_time, 0, -3),
                        'break' => substr($timeActivity->break_duration, 0, -3),
                        'taxable' => $timeActivity->taxable === '1' ? 'Yes' : '',
                        'billable' => $timeActivity->billable === '1' ? 'Yes' : 'No',
                        'invoice_date' => '',
                        'amount' => $timeActivity->billable === '1' ? $amount : ''
                    ];
                }

                $start_date = date("m/01/Y");
                $end_date = date("m/d/Y");
                $report_period = date("F 1-j, Y");
                if(!empty($post['date'])) {
                    if($post['date'] !== 'all-dates') {
                        $start_date = str_replace('-', '/', $post['from']);
                        $end_date = str_replace('-', '/', $post['to']);
                    }

                    switch($post['date']) {
                        case 'all-dates' :
                            $report_period = 'All Dates';
                        break;
                        case 'today' :
                            $report_period = date("F j, Y", strtotime($start_date));
                        break;
                        case 'yesterday' :
                            $report_period = date("F j, Y", strtotime($start_date));
                        break;
                        case 'this-month' :
                            $report_period = date("F Y");
                        break;
                        case 'last-month' :
                            $report_period = date("F Y", strtotime($start_date));
                        break;
                        case 'next-month' :
                            $report_period = date("F Y", strtotime($start_date));
                        break;
                        case 'this-quarter' :
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $report_period = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'last-quarter' :
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $report_period = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'next-quarter' :
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $report_period = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'this-year' :
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $report_period = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'last-year' :
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $report_period = $startMonth.'-'.$endMonth.' '.date("Y", strtotime($startDate));
                        break;
                        case 'next-year' :
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $report_period = $startMonth.'-'.$endMonth.' '.date("Y", strtotime($startDate));
                        break;
                        case 'this-year-to-last-month' :
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $report_period = $startMonth.'-'.$endMonth.' '.date("Y");
                        break;
                        case 'since-30-days-ago' :
                            $startDate = date("F j, Y", strtotime($start_date));

                            $report_period = 'Since '.$startDate;
                        break;
                        case 'since-60-days-ago' :
                            $startDate = date("F j, Y", strtotime($start_date));

                            $report_period = 'Since '.$startDate;
                        break;
                        case 'since-90-days-ago' :
                            $startDate = date("F j, Y", strtotime($start_date));

                            $report_period = 'Since '.$startDate;
                        break;
                        case 'since-365-days-ago' :
                            $startDate = date("F j, Y", strtotime($start_date));

                            $report_period = 'Since '.$startDate;
                        break;
                        default : 
                            $startDate = date("F j, Y", strtotime($start_date));
                            $endDate = date("F j, Y", strtotime($end_date));

                            $startMonth = date("F", strtotime($startDate));
                            $endMonth = date("F", strtotime($endDate));

                            $startYear = date("Y", strtotime($startDate));
                            $endYear = date("Y", strtotime($endDate));

                            if($startMonth === $endMonth && $startYear === $endYear) {
                                $report_period = date("F j", strtotime($startDate)).' - '.date("j, Y", strtotime($endDate));
                            } else if($startYear !== $endYear) {
                                $report_period = date("F j, Y", strtotime($startDate)).' - '.date("F j, Y", strtotime($endDate));
                            } else {
                                $report_period = date("F j", strtotime($startDate)).' - '.date("F j, Y", strtotime($endDate));
                            }
                        break;
                    }
                }

                if($post['date'] !== 'all-dates') {
                    $filters = [
                        'start-date' => $start_date,
                        'end-date' => $end_date
                    ];
    
                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['activity_date']) >= strtotime($filters['start-date']) && strtotime($v['activity_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['customer'])) {
                    if(!in_array($post['customer'], ['all', 'not-specified', 'specified'])) {
                        $customer = $this->accounting_customers_model->get_by_id($post['customer']);
                        $customerName = $customer->first_name . ' ' . $customer->last_name;
                        $filter_customer->name = $customerName;

                        $filters = [
                            'customer_id' => $post['customer']
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['customer_id'] === $filters['customer_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        if($post['customer'] === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['customer_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty($post['product-service'])) {
                    if(!in_array($post['product-service'], ['all', 'not-specified', 'specified'])) {
                        $item = $this->items_model->getByID($post['product-service']);

                        $filters = [
                            'item_id' => $post['product-service']
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['item_id'] === $filters['item_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        if($post['product-service'] === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['item_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty($post['employee'])) {
                    if(!in_array($post['employee'], ['all', 'not-specified', 'specified'])) {
                        $explode = explode('-', $post['employee']);

                        switch($explode[0]) {
                            case 'employee' :
                                $employee = $this->users_model->getUserByID($explode[1]);
                            break;
                            case 'vendor' :
                                $vendor = $this->vendors_model->get_vendor_by_id($explode[1]);
                            break;
                        }

                        $filters = [
                            'key' => $explode[0],
                            'id' => $explode[1]
                        ];

                        $activities = array_filter($activities, function($v, $k) use ($filters) {
                            return $v['employee_key'] === $filters['key'] && $v['employee_id'] === $filters['id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        if($post['employee'] === 'not-specified') {
                            $activities = array_filter($activities, function($v, $k) {
                                return empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        } else {
                            $activities = array_filter($activities, function($v, $k) {
                                return !empty($v['employee_id']);
                            }, ARRAY_FILTER_USE_BOTH);
                        }
                    }
                }

                if(!empty($post['create-date'])) {
                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', $post['create-date-from'])),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', $post['create-date-to']))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['create_date']) >= strtotime($filters['start-date']) && strtotime($v['create_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['last-modified-date'])) {
                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', $post['last-modified-date-from'])),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', $post['last-modified-date-to']))
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return strtotime($v['last_modified']) >= strtotime($filters['start-date']) && strtotime($v['last_modified']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['billable'])) {
                    $filters = [
                        'billable' => $post['billable']
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return $v['billable'] === ucfirst($filters['billable']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['memo'])) {
                    $filters = [
                        'memo' => $post['memo']
                    ];

                    $activities = array_filter($activities, function($v, $k) use ($filters) {
                        return stripos($v['memo_desc'], trim($filters['memo'])) !== false;
                    }, ARRAY_FILTER_USE_BOTH);
                }

                $sort = [
                    'column' => !empty($post['column']) ? str_replace('-', '_', $post['column']) : 'last_modified',
                    'order' => empty($post['order']) ? 'asc' : 'desc'
                ];

                usort($activities, function($a, $b) use ($sort) {
                    if(strpos($sort['column'], 'date') !== false || in_array($sort['column'], ['break', 'duration', 'end_time', 'start_time', 'last_modified'])) {
                        if($a[$sort['column']] === $b[$sort['column']]) {
                            return strtotime($b['create_date']) > strtotime($a['create_date']);
                        }

                        if($sort['order'] === 'asc') {
                            return strtotime($a[$sort['column']]) > strtotime($b[$sort['column']]);
                        } else {
                            return strtotime($a[$sort['column']]) < strtotime($b[$sort['column']]);
                        }
                    } else {
                        if($sort['order'] === 'asc') {
                            return strcmp($a[$sort['column']], $b[$sort['column']]);
                        } else {
                            return strcmp($b[$sort['column']], $a[$sort['column']]);
                        }
                    }
                });

                $grouped = [];
                if($post['group-by'] !== 'none')
                {
                    switch($post['group-by']) {
                        case 'customer' :
                            usort($activities, function($a, $b) {
                                return strcmp($a['customer'], $b['customer']); 
                            });
                        break;
                        case 'product-service' :
                            usort($activities, function($a, $b) {
                                return strcmp($a['product_service'], $b['product_service']);
                            });
                        break;
                        case 'day' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'month' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'quarter' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'year' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'week' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        case 'work-week' :
                            usort($activities, function($a, $b) {
                                return strtotime($a['activity_date']) > strtotime($b['activity_date']);
                            });
                        break;
                        default :
                            usort($activities, function($a, $b) {
                                return strcmp($a['employee'], $b['employee']);
                            });
                        break;
                    }

                    foreach($activities as $activity)
                    {
                        switch($post['group-by']) {
                            case 'customer' :
                                $key = $activity['customer_id'];
                                $name = $activity['customer'];
                            break;
                            case 'product-service' :
                                $key = $activity['item_id'];
                                $name = $activity['product_service'];
                            break;
                            case 'day' :
                                $key = str_replace('/', '-', $activity['activity_date']);
                                $name = date("F j, Y", strtotime($activity['activity_date']));
                            break;
                            case 'week' :
                                $ddate = $activity['activity_date'];
                                $date = new DateTime($ddate);
                                $week = intval($date->format("W"));
                                $year = date('Y', strtotime($ddate));

                                $key = $week.'-'.$year;

                                $day = date("l", strtotime($ddate));
                                switch($day) {
                                    case 'Monday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -1 day'));
                                    break;
                                    case 'Tuesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -2 days'));
                                    break;
                                    case 'Wednesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -3 days'));
                                    break;
                                    case 'Thursday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -4 days'));
                                    break;
                                    case 'Friday' :
                                        $weekStart = date("F j", strtotime($ddate.' -5 days'));
                                    break;
                                    case 'Saturday' :
                                        $weekStart = date("F j", strtotime($ddate.' -6 days'));
                                    break;
                                    case 'Sunday' :
                                        $weekStart = date("F j", strtotime($ddate));
                                    break;
                                }

                                $weekEnd = date("F j, Y", strtotime($weekStart.' +6 days'));
                                $weekStartMonth = date("F", strtotime($weekStart));
                                $weekEndMonth = date("F", strtotime($weekEnd));
                                $weekStartYear = date("Y", strtotime($weekStart));
                                $weekEndYear = date("Y", strtotime($weekEnd));

                                if($weekStartMonth === $weekEndMonth && $weekStartYear === $weekEndYear) {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("j, Y", strtotime($weekEnd));
                                } else if($weekStartYear !== $weekEndYear) {
                                    $name = date("F j, Y", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                } else {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                }
                            break;
                            case 'work-week' :
                                $ddate = $activity['activity_date'];
                                $date = new DateTime($ddate);
                                $week = intval($date->format("W"));
                                $year = date('Y', strtotime($ddate));

                                $key = $week.'-'.$year;

                                $day = date("l", strtotime($ddate));
                                switch($day) {
                                    case 'Monday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -1 day'));
                                    break;
                                    case 'Tuesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -2 days'));
                                    break;
                                    case 'Wednesday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -3 days'));
                                    break;
                                    case 'Thursday' :
                                        $weekStart = date("F j, Y", strtotime($ddate.' -4 days'));
                                    break;
                                    case 'Friday' :
                                        $weekStart = date("F j", strtotime($ddate.' -5 days'));
                                    break;
                                    case 'Saturday' :
                                        $weekStart = date("F j", strtotime($ddate.' -6 days'));
                                    break;
                                    case 'Sunday' :
                                        $weekStart = date("F j", strtotime($ddate));
                                    break;
                                }

                                $weekEnd = date("F j, Y", strtotime($weekStart.' +6 days'));
                                $weekStartMonth = date("F", strtotime($weekStart));
                                $weekEndMonth = date("F", strtotime($weekEnd));
                                $weekStartYear = date("Y", strtotime($weekStart));
                                $weekEndYear = date("Y", strtotime($weekEnd));

                                if($weekStartMonth === $weekEndMonth && $weekStartYear === $weekEndYear) {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("j, Y", strtotime($weekEnd));
                                } else if($weekStartYear !== $weekEndYear) {
                                    $name = date("F j, Y", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                } else {
                                    $name = date("F j", strtotime($weekStart)).' - '.date("F j, Y", strtotime($weekEnd));
                                }
                            break;
                            case 'month' :
                                $key = date("m-Y", strtotime($activity['activity_date']));
                                $name = date("F Y", strtotime($activity['activity_date']));
                            break;
                            case 'quarter' :
                                $month = date("n", strtotime($activity['activity_date']));

                                $quarter = ceil($month / 3);

                                switch($quarter) {
                                    case 1 :
                                        $key = date("01-03-Y", strtotime($activity['activity_date']));
                                        $name = "January - March ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                    case 2 :
                                        $key = date("04-06-Y", strtotime($activity['activity_date']));
                                        $name = "April - June ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                    case 3 :
                                        $key = date("07-09-Y", strtotime($activity['activity_date']));
                                        $name = "July - September ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                    case 4:
                                        $key = date("10-12-Y", strtotime($activity['activity_date']));
                                        $name = "October - December ".date("Y", strtotime($activity['activity_date']));
                                    break;
                                }
                            break;
                            case 'year' :
                                $key = date("Y", strtotime($activity['activity_date']));
                                $name = date("Y", strtotime($activity['activity_date']));
                            break;
                            default :
                                $key = $activity['employee_key'].'-'.$activity['employee_id'];
                                $name = $activity['employee'];
                            break;
                        }
                        if(array_key_exists($key, $grouped)) {
                            $grouped[$key]['activities'][] = $activity;
                            $duration = $grouped[$key]['duration_total'];
                            $amount = $grouped[$key]['amount_total'];

                            $durationExplode = explode(':', $duration);
                            $totalHrs = intval($durationExplode[0]);
                            $totalMins = intval($durationExplode[1]);

                            $actDuration = $activity['duration'];
                            $actDurationExplode = explode(':', $actDuration);
                            $actHrs = intval($actDurationExplode[0]);
                            $actMins = intval($actDurationExplode[1]);
                            $actAmount = $activity['amount'];

                            $totalHrs += $actHrs;
                            $totalMins += $actMins;

                            if($totalMins >= 60) {
                                do {
                                    $totalHrs++;
                                    $totalMins -= 60;
                                } while($totalMins >= 60);
                            }

                            if(strlen($totalHrs) === 1) {
                                $totalHrs = '0'.$totalHrs;
                            }

                            if(strlen($totalMins) === 1) {
                                $totalMins = '0'.$totalMins;
                            }

                            $grouped[$key]['duration_total'] = $totalHrs.':'.$totalMins;
                            $grouped[$key]['amount_total'] = number_format(floatval($amount) + floatval($actAmount), 2);
                        } else {
                            $grouped[$key] = [
                                'name' => $name,
                                'duration_total' => $activity['duration'],
                                'amount_total' => $activity['amount'],
                                'activities' => [
                                    $activity
                                ]
                            ];
                        }
                    }
                } else {
                    $grouped = $activities;
                }

                $activities = $grouped;

                $companyName = $this->page_data['clients']->business_name;
                if(!empty($post['company-name'])) {
                    $companyName = str_replace('%20', ' ', $post['company-name']);
                }
                $reportName = $reportType->name;
                if(!empty($post['report-title'])) {
                    $reportName = str_replace('%20', ' ', $post['report-title']);
                }

                $headerAlignment = 'center';
                if(!empty($post['header-alignment'])) {
                    $headerAlignment = $post['header-alignment'];
                }

                $footerAlignment = 'center';
                if(!empty($post['footer-alignment'])) {
                    $footerAlignment = $post['footer-alignment'];
                }

                $preparedTimestamp = "l, F j, Y h:i A eP";
                if(!empty($post['show-date-prepared'])) {
                    $preparedTimestamp = str_replace("l, F j, Y", "", $preparedTimestamp);
                    $preparedTimestamp = trim($preparedTimestamp);
                }

                if(!empty($post['show-time-prepared'])) {
                    $preparedTimestamp = str_replace("h:i A eP", "", $preparedTimestamp);
                    $preparedTimestamp = trim($preparedTimestamp);
                }
                $date = date($preparedTimestamp);

                $reportNote = $this->accounting_report_type_notes_model->get_note(logged('company_id'), $reportTypeId);

                if($post['type'] === 'excel') {
                    $writer = new XLSXWriter();
                    $row = 0;

                    $header = [];
                    foreach($post['fields'] as $field)
                    {
                        $header[] = 'string';
                    }

                    $writer->writeSheetHeader('Sheet1', $header, array('suppress_row'=>true));
    
                    if(empty($post['show-company-name'])) {
                        $writer->writeSheetRow('Sheet1', [$companyName], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', 0, 0, 0, count($post['fields']) - 1);
                        $row++;
                    }
                    if(empty($post['show-report-title'])) {
                        $writer->writeSheetRow('Sheet1', [$reportName], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row++;
                    }
                    if(empty($post['show-report-period'])) {
                        $reportPeriod = "Activity: " . $report_period;
                        $writer->writeSheetRow('Sheet1', [$reportPeriod], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row++;
                    }

                    $writer->writeSheetRow('Sheet1', $post['fields'], ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);
                    $row += 2;

                    if($post['group-by'] === 'none') {
                        foreach($activities as $activity) {
                            $data = [];
    
                            $style = [];
                            foreach($post['fields'] as $field) {
                                if($field === 'Rates' || $field === 'Amount') {
                                    if(stripos($activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], '<span class="text-danger">') !== false) {
                                        $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('<span class="text-danger">', '', $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                        $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('</span>', '', $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                    // if(substr($activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], 0, 1) === '-') {
                                        $style[] = ['color' => '#FF0000'];
                                    } else {
                                        $style[] = ['color' => '#000000'];
                                    }
                                } else {
                                    $style[] = ['color' => '#000000'];
                                }
                                $data[] = $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))];
                            }
    
                            $writer->writeSheetRow('Sheet1', $data, $style);
    
                            $row++;
                        }
                    } else {
                        foreach($activities as $activity)
                        {
                            $groupHead = [];
                            $groupTotal = [];

                            foreach($post['fields'] as $field)
                            {
                                $groupHead[] = '';
                                $groupTotal[] = $field === 'Duration' || $field === 'Amount' ? $activity[strtolower($field).'_total'] : '';
                            }
                            $groupHead[0] = $activity['name'];
                            $groupTotal[0] = 'Total for '.$activity['name'];

                            $writer->writeSheetRow('Sheet1', $groupHead, ['font-style' => 'bold']);
                            $row++;

                            foreach($activity['activities'] as $act)
                            {
                                $data = [];
                                $style = [];
                                foreach($post['fields'] as $field) {
                                    if($field === 'Rates' || $field === 'Amount') {
                                        if(stripos($act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], '<span class="text-danger">') !== false) {
                                            $act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('<span class="text-danger">', '', $act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                            $act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('</span>', '', $act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                        // if(substr($act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], 0, 1) === '-') {
                                            $style[] = ['color' => '#FF0000'];
                                        } else {
                                            $style[] = ['color' => '#000000'];
                                        }
                                    } else {
                                        $style[] = ['color' => '#000000'];
                                    }
                                    $data[] = $act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))];
                                }
        
                                $writer->writeSheetRow('Sheet1', $data, $style);
        
                                $row++;
                            }

                            $writer->writeSheetRow('Sheet1', $groupTotal, ['font-style' => 'bold', 'border' => 'top']);
                            $row++;
                        }
                    }

                    $writer->writeSheetRow('Sheet1', []);
                    $writer->writeSheetRow('Sheet1', []);

                    if(!empty($reportNote) && !empty($reportNote->notes)) {
                        $row += 1;
                        $writer->writeSheetRow('Sheet1', ['Notes'], ['font-style' => 'bold', 'border' => 'bottom']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row += 1;
                        $writer->writeSheetRow('Sheet1', [$reportNote->notes]);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $writer->writeSheetRow('Sheet1', []);
                        $row += 1;
                    }

                    $row += 1;

                    $writer->writeSheetRow('Sheet1', [$date], ['halign' => $footerAlignment, 'valign' => 'center']);
                    $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);

                    $fileName = str_replace(' ', '_', $companyName).'_Time_Activities_by_Employee_Detail';
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header("Content-Disposition: attachment;filename=Time_Activities_by_Employee_Detail.xlsx");
                    header('Cache-Control: max-age=0');
                    $writer->writeToStdOut();
                } else {
                    $html = '
                        <table style="padding-top:-40px;">
                            <tr>
                                <td style="text-align: '.$headerAlignment.'">';
                                    $html .= empty($post['show-company-name']) ? '<h2 style="margin: 0">'.$companyName.'</h2>' : '';
                                    $html .= empty($post['show-report-title']) ? '<h3 style="margin: 0">'.$reportName.'</h3>' : '';
                                    $html .= empty($post['show-report-period']) ? '<h4 style="margin: 0">Activity: '.$report_period.'</h4>' : '';
                                $html .= '</td>
                            </tr>
                        </table>
                        <br /><br /><br />

                        <table style="width="100%;>
                        <thead>
                            <tr>';
                            foreach($post['fields'] as $field) {
                                $html .= '<th style="border-top: 1px solid black; border-bottom: 1px solid black"><b>'.$field.'</b></th>';
                            }
                        $html .= '</tr>
                        </thead>
                        <tbody>';

                    if($post['group-by'] === 'none') {
                        foreach($activities as $activity) {
                            $html .= '<tr>';
                            foreach($post['fields'] as $field) {
                                $html .= '<td>'.str_replace('class="text-danger"', 'style="color: red"', $activity[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]).'</td>';
                            }
                            $html .= '</tr>';
                        }
                    } else {
                        foreach($activities as $activity)
                        {
                            $html .= '<tr>
                                <td colspan="'.count($post['fields']).'"><b>'.$activity['name'].'</b></td>
                            </tr>';
                            
                            foreach($activity['activities'] as $act)
                            {
                                $html .= '<tr>';
                                foreach($post['fields'] as $field) {
                                    $html .= '<td>'.str_replace('class="text-danger"', 'style="color: red"', $act[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]).'</td>';
                                }
                                $html .= '</tr>';
                            }

                            $count = array_search('Duration', $post['fields']);
                            if($count === false) {
                                $count = array_search('Amount', $post['fields']);
                            }
                            if($count === false) {
                                $count = count($post['fields']);
                            }

                            $total = '<td style="border-top: 1px solid black" colspan="'.$count.'"><b>Total for '.$activity['name'].'</b></td>';
                            foreach($post['fields'] as $index => $field)
                            {
                                if($index > $count - 1) {
                                    $value = $field === 'Duration' || $field === 'Amount' ? $activity[strtolower($field).'_total'] : '';
                                    $total .= '<td style="border-top: 1px solid black"><b>'.$value.'</b></td>';
                                }
                            }

                            $html .= '<tr>';
                            $html .= $total;
                            $html .= '</tr>';
                        }
                    }
                    
                    $html .= '</tbody>';
                    $html .= '<tfoot>';
                    if(!empty($reportNote) && !empty($reportNote->notes)) {
                    $html .= '<tr>
                            <td colspan="'.count($post['fields']).'" style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td colspan="'.count($post['fields']).'">
                                <h4><b>Notes</b></h4>
                                '.$reportNote->notes.'
                            </td>
                        </tr>';
                    }
                    $html .= '<tr style="text-align: '.$footerAlignment.'">
                                <td colspan="'.count($post['fields']).'">
                                    <p style="margin: 0">'.$date.'</p>
                                </td>
                            </tr>
                        </tfoot>
                    </table>';

                    $fileName = str_replace(' ', '_', $companyName).'_Time_Activities_by_Employee_Detail';

                    tcpdf();
                    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $title = "Time Activities by Employee Detail";
                    $obj_pdf->SetTitle($title);
                    $obj_pdf->setPrintHeader(false);
                    $obj_pdf->setPrintFooter(false);
                    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                    $obj_pdf->SetDefaultMonospacedFont('helvetica');
                    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                    $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
                    $obj_pdf->SetFont('helvetica', '', 9);
                    $obj_pdf->setFontSubsetting(false);
                    $obj_pdf->AddPage();
                    ob_end_clean();
                    $obj_pdf->writeHTML($html, true, false, true, false, '');
                    $obj_pdf->Output(str_replace(' ', '_', $companyName).'_Time_Activities_by_Employee_Detail.pdf', 'D');
                }
            break;
        }
    }

    public function update_note($reportTypeId)
    {
        $post = $this->input->post();
        $reportNote = $this->accounting_report_type_notes_model->get_note(logged('company_id'), $reportTypeId);

        if(!is_null($reportNote)) {
            $query = $this->accounting_report_type_notes_model->update_note(logged('company_id'), $reportTypeId, $post['note']);
        } else {
            $query = $this->accounting_report_type_notes_model->add_note(['company_id' => logged('company_id'), 'report_type_id' => $reportTypeId, 'notes' => $post['note']]);
        }

        echo json_encode([
            'success' => $query ? true : false,
            'message' => $query ? 'Note updated successfully!' : 'Note update failed'
        ]);
    }

    public function add_custom_report_group()
    {
        $post = $this->input->post();

        $groupId = $this->accounting_custom_reports_model->add_custom_report_group($post['name']);

        echo json_encode([
            'data' => $groupId,
            'name' => $post['name']
        ]);
    }

    public function save_custom_report()
    {
        $post = $this->input->post();

        if(isset($post['custom_report_id'])) {
            $customReportData = [
                'report_type_id' => $post['report_id'],
                'name' => $post['name'],
                'custom_report_group_id' => $post['custom_report_group_id'],
                'share_with' => $post['share_with'],
                'created_by' => logged('id'),
                'date_range' => $post['date_range'],
                'report_settings' => json_encode($post['settings'])
            ];

            $update = $this->accounting_custom_reports_model->update_custom_report($post['custom_report_id'], $customReportData);

            if($update) {
                $customReportId = $post['custom_report_id'];
            }
        } else {
            $customReportData = [
                'company_id' => logged('company_id'),
                'report_type_id' => $post['report_id'],
                'name' => $post['name'],
                'custom_report_group_id' => $post['custom_report_group_id'],
                'share_with' => $post['share_with'],
                'created_by' => logged('id'),
                'date_range' => $post['date_range'],
                'report_settings' => json_encode($post['settings'])
            ];
    
            $customReportId = $this->accounting_custom_reports_model->add_custom_report($customReportData);
        }

        echo json_encode([
            'data' => $customReportId,
            'success' => $customReportId ? true : false,
            'message' => $customReportId ? 'Custom report saved successfully.' : 'Custom report saving failed.'
        ]);
    }

    public function check_name()
    {
        $name = $this->input->post('name');

        $checkName = $this->accounting_custom_reports_model->check_name($name, logged('company_id'));

        echo json_encode([
            'data' => $checkName,
            'exists' => $checkName ? true : false
        ]);
    }
}