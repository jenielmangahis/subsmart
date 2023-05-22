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
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $this->load->model('categories_model');
        $this->load->model('items_model');
        $this->load->model('accounting_journal_entries_model');
        $this->load->model('accounting_transfer_funds_model');
        $this->load->model('accounting_bank_deposit_model');
        $this->load->model('accounting_inventory_qty_adjustments_model');
        $this->load->model('item_starting_value_adj_model', 'starting_value_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('accounting_pay_down_credit_card_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('accounting_refund_receipt_model');
        $this->load->model('accounting_account_transactions_model');

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

        $this->page_data['company_name'] = $this->page_data['clients']->business_name;

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
            case 'account_list' :
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

                if(!empty(get('show-company-name'))) {
                    $this->page_data['show_company_name'] = false;
                }

                if(!empty(get('company-name'))) {
                    $this->page_data['company_name'] = get('company-name');
                }

                $this->page_data['report_title'] = 'Account List';
                if(!empty(get('show-report-title'))) {
                    $this->page_data['show_report_title'] = false;
                }

                if(!empty(get('report-title'))) {
                    $this->page_data['report_title'] = get('report-title');
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

                $compAccs = $this->chart_of_accounts_model->get_by_company_id(logged('company_id'));
                $accounts = [];
                foreach($compAccs as $account)
                {
                    $balance = number_format(floatval($account->balance), 2);
                    if(!empty(get('divide-by-100'))) {
                        $balance = number_format(floatval($balance) / 100, 2);
                    }

                    if(!empty(get('without-cents'))) {
                        $balance = number_format(floatval($balance), 0);
                    }

                    if(!empty(get('negative-numbers'))) {
                        switch(get('negative-numbers')) {
                            case '(100)' :
                                if(substr($balance, 0, 1) === '-') {
                                    $balance = str_replace('-', '', $balance);
                                    $balance = '('.$balance.')';
                                }
                            break;
                            case '100-' :
                                if(substr($balance, 0, 1) === '-') {
                                    $balance = str_replace('-', '', $balance);
                                    $balance = $balance.'-';
                                }
                            break;
                        }
                    }

                    if(!empty(get('show-in-red'))) {
                        if(empty(get('negative-numbers'))) {
                            if(substr($balance, 0, 1) === '-') {
                                $balance = '<span class="text-danger">'.$balance.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($balance, 0, 1) === '(' && substr($balance, -1) === ')') {
                                        $balance = '<span class="text-danger">'.$balance.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($balance, -1) === '-') {
                                        $balance = '<span class="text-danger">'.$balance.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $accounts[] = [
                        'account_id' => $account->id,
                        'name' => $account->name,
                        'type' => $this->account_model->getName($account->account_id),
                        'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                        'create_date' => date("m/d/Y h:i:s A", strtotime($account->created_at)),
                        'created_by' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($account->updated_at)),
                        'last_modified_by' => '',
                        'description' => $account->description,
                        'balance' => $balance,
                        'status' => $account->active
                    ];
                }

                if(!empty(get('account'))) {
                    $this->page_data['filter_account'] = new stdClass();
                    $this->page_data['filter_account']->id = get('account');

                    if(intval(get('account')) > 0) {
                        $account = $this->chart_of_accounts_model->getById(get('account'));
                        $this->page_data['filter_account']->name = $account->name;

                        $filters = [
                            'account_id' => get('account')
                        ];

                        $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                            return $v['account_id'] === $filters['account_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $names = [
                            'balance-sheet-accounts' => 'All Balance Sheet Accounts',
                            'asset-accounts' => 'All Asset Accounts',
                            'current-asset-accounts' => 'All Current Asset Accounts',
                            'bank-accounts' => 'All Bank Accounts',
                            'accounts-receivable-accounts' => 'All Accounts receivable (A/R) Accounts',
                            'other-current-assets-accounts' => 'All Other Current Assets Accounts',
                            'fixed-assets-accounts' => 'All Fixed Assets Accounts',
                            'other-assets-accounts' => 'All Other Assets Accounts',
                            'liability-accounts' => 'All Liability Accounts',
                            'accounts-payable-accounts' => 'All Accounts payable (A/P) Accounts',
                            'credit-card-accounts' => 'All Credit Card Accounts',
                            'other-current-liabilities-accounts' => 'All Other Current Liabilities Accounts',
                            'long-term-liabilities-accounts' => 'All Long Term Liabilities Accounts',
                            'equity-accounts' => 'All Equity Accounts',
                            'income-expense-accounts' => 'All Income/Expense Accounts',
                            'income-accounts' => 'All Income Accounts',
                            'cost-of-goods-sold-accounts' => 'All Cost of Goods Sold Accounts',
                            'expenses-accounts' => 'All Expenses Accounts',
                            'other-income-accounts' => 'All Other Income Accounts',
                            'other-expense-accounts' => 'All Other Expense Accounts'
                        ];
                        $this->page_data['filter_account']->name = $names[get('account')];

                        $type = get('account');

                        $accounts = array_filter($accounts, function($v, $k) use ($type) {
                            switch($type) {
                                case 'balance-sheet-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false || strpos($v['type'], 'Liabilities') !== false || $v['type'] === 'Equity' || $v['type'] === 'Credit Card';
                                break;
                                case 'asset-account' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false;
                                break;
                                case 'current-asset-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || $v['type'] === 'Other Current Assets';
                                break;
                                case 'bank-accounts' :
                                    return $v['type'] === 'Bank';
                                break;
                                case 'accounts-receivable-accounts' :
                                    return $v['type'] === 'Accounts receivable (A/R)';
                                break;
                                case 'other-current-assets-accounts' :
                                    return $v['type'] === 'Other Current Assets';
                                break;
                                case 'fixed-assets-accounts' :
                                    return $v['type'] === 'Fixed Assets';
                                break;
                                case 'other-assets-accounts' :
                                    return $v['type'] === 'Other Assets';
                                break;
                                case 'liability-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || strpos($v['type'], 'Liabilities') !== false;
                                break;
                                case 'accounts-payable-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'credit-card-accounts' :
                                    return $v['type'] === 'Credit Card';
                                break;
                                case 'other-current-liabilities-accounts' :
                                    return $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'long-term-liabilities-accounts' :
                                    return $v['type'] === 'Long Term Liabilities';
                                break;
                                case 'equity-accounts' :
                                    return $v['type'] === 'Equity';
                                break;
                                case 'income-expense-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold' || strpos($v['type'], 'Income') !== false || strpos($v['type'], 'Expense') !== false;
                                break;
                                case 'income-accounts' :
                                    return $v['type'] === 'Income';
                                break;
                                case 'cost-of-goods-sold-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold';
                                break;
                                case 'expenses-accounts' :
                                    return $v['type'] === 'Expenses';
                                break;
                                case 'other-income-accounts' :
                                    return $v['type'] === 'Other Income';
                                break;
                                case 'other-expense-accounts' :
                                    return $v['type'] === 'Other Expense';
                                break;
                            };
                        }, ARRAY_FILTER_USE_BOTH);
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

                    $accounts = array_filter($accounts, function($v, $k) use ($filters) {
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

                    $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                        return strtotime($v['last_modified']) >= strtotime($filters['start-date']) && strtotime($v['last_modified']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('deleted'))) {
                    if(get('deleted') === 'deleted') {
                        $accounts = array_fitler($accounts, function($v, $k) {
                            return empty($v['status']);
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                } else {
                    $accounts = array_filter($accounts, function($v, $k) {
                        return $v['status'] === '1';
                    }, ARRAY_FILTER_USE_BOTH);
                }

                $sort = [
                    'column' => !empty(get('column')) ? str_replace('-', '_', get('column')) : 'type',
                    'order' => empty(get('order')) ? 'asc' : 'desc'
                ];

                usort($accounts, function($a, $b) use ($sort) {
                    if(strpos($sort['column'], 'date') !== false || in_array($sort['column'], ['create_date', 'last_modified'])) {
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

                $this->page_data['accounts'] = $accounts;
            break;
            case 'general_ledger' :
                $this->page_data['start_date'] = date("m/01/Y");
                $this->page_data['end_date'] = date("m/d/Y");
                $this->page_data['report_period'] = date("F 1-j, Y");
                if(!empty(get('date'))) {
                    $this->page_data['filter_date'] = get('date');
                    if(get('date') !== 'all-dates') {
                        $this->page_data['start_date'] = str_replace('-', '/', get('from'));
                        $this->page_data['end_date'] = str_replace('-', '/', get('to'));
                    } else {
                        $this->page_data['start_date'] = null;
                        $this->page_data['start_date'] = null;
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

                $dateFilter = [
                    'start_date' => $this->page_data['start_date'],
                    'end_date' => $this->page_data['end_date']
                ];

                $compAccs = $this->chart_of_accounts_model->get_by_company_id(logged('company_id'));
                $accounts = [];
                foreach($compAccs as $account)
                {
                    $transactions = $this->accounting_account_transactions_model->get_account_transactions($account->id);

                    usort($transactions, function($a, $b) {
                        return strtotime($a->transaction_date) < strtotime($b->transaction_date);
                    });

                    $amountTotal = 0.00;
                    $debitTotal = 0.00;
                    $creditTotal = 0.00;
                    $taxAmountTotal = 0.00;
                    $taxableAmountTotal = 0.00;
                    $beginningBalance = floatval(str_replace(',', '', $account->balance));

                    $accTransacs = [];

                    foreach($transactions as $transaction)
                    {
                        $balance = $beginningBalance;
                        if($transaction->type === 'increase') {
                            $beginningBalance -= floatval(str_replace(',', '', $transaction->amount));
                        } else {
                            $beginningBalance += floatval(str_replace(',', '', $transaction->amount));
                        }
                        if(strtotime($transaction->transaction_date) >= strtotime($dateFilter['start_date']) && strtotime($transaction->transaction_date) <= strtotime($dateFilter['end_date'])) {
                            $name = '';
                            $customer = '';
                            $vendor = '';
                            $employee = '';
                            $transacItem = '';
                            $memo = '';
                            $qty = '';
                            $rate = '';
                            $transacAccount = '';
                            $split = '';
                            $openBalance = '';
                            $arPaid = '';
                            $apPaid = '';
                            $checkPrinted = '';
    
                            switch($transaction->transaction_type) {
                                case 'Check' :
                                    $check = $this->vendors_model->get_check_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($check->payment_date));
                                    $num = $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no);
                                    $createDate = date("m/d/Y h:i:s A", strtotime($check->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($check->updated_at));
    
                                    switch($check->payee_type) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                            $name = $payee->display_name;
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($check->payee_id);
                                            $name = $payee->FName . ' ' . $payee->LName;
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($check->bank_account_id);
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($check->id, 'Check');
                                    }
    
                                    if(!is_null($check->check_no)) {
                                        $checkPrinted = 'Printed';
                                    }
                                break;
                                case 'Expense' :
                                    $expense = $this->vendors_model->get_expense_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($expense->payment_date));
                                    $num = $expense->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($expense->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($expense->updated_at));
    
                                    switch($expense->payee_type) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                                            $name = $payee->display_name;
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($expense->payee_id);
                                            $name = $payee->FName . ' ' . $payee->LName;
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($expense->payment_account_id);
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($expense->id, 'Expense');
                                    }
                                break;
                                case 'Bill' :
                                    $bill = $this->vendors_model->get_bill_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($bill->bill_date));
                                    $num = $bill->bill_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($bill->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($bill->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                                    $name = $payee->display_name;
                                    $vendor = $payee->display_name;
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                                        $split = $apAcc->name;
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($bill->id, 'Bill');
    
                                        $openBalance = number_format(floatval(str_replace(',', '', $bill->remaining_balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $bill->remaining_balance)) > 0) {
                                        $apPaid = 'Unpaid';
                                    } else {
                                        $apPaid = 'Paid';
                                    }
                                break;
                                case 'Vendor Credit' :
                                    $vCredit = $this->vendors_model->get_vendor_credit_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($vCredit->payment_date));
                                    $num = $vCredit->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($vCredit->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($vCredit->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
                                    $name = $payee->display_name;
                                    $vendor = $payee->display_name;
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                                        $split = $apAcc->name;
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($vCredit->id, 'Vendor Credit');
    
                                        $openBalance = number_format(floatval(str_replace(',', '', $vCredit->remaining_balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $vCredit->remaining_balance)) > 0) {
                                        $apPaid = 'Unpaid';
                                    } else {
                                        $apPaid = 'Paid';
                                    }
                                break;
                                case 'CC Credit' :
                                    $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($ccCredit->payment_date));
                                    $num = $ccCredit->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($ccCredit->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($ccCredit->updated_at));
    
                                    switch($ccCredit->payee_type) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                            $name = $payee->display_name;
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($ccCredit->payee_id);
                                            $name = $payee->FName . ' ' . $payee->LName;
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($expense->payment_account_id);
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($ccCredit->id, 'Credit Card Credit');
                                    }
                                break;
                                case 'Bill Payment' :
                                    $billPayment = $this->vendors_model->get_bill_payment_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($billPayment->payment_date));
                                    $num = $billPayment->to_print_check_no === "1" ? "To print" : ($billPayment->check_no === null ? '' : $billPayment->check_no);
                                    $createDate = date("m/d/Y h:i:s A", strtotime($billPayment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($billPayment->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
                                    $name = $payee->display_name;
                                    $vendor = $payee->display_name;
    
                                    $accountType = $this->account_model->getById($account->account_id);
    
                                    if($accountType->account_name !== 'Accounts payable (A/P)') {
                                        $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                                        $split = $apAcc->name;
                                    } else {
                                        $split = $this->chart_of_accounts_model->getName($billPayment->payment_account_id);
                                    }
    
                                    $apPaid = 'Paid';
    
                                    if(!is_null($billPayment->check_no)) {
                                        $checkPrinted = 'Printed';
                                    }
                                break;
                                case 'Invoice' :
                                    $invoice = $this->invoice_model->getinvoice($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($invoice->date_issued));
                                    $num = $invoice->invoice_number;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($invoice->date_created));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($invoice->date_updated));
    
                                    $payee = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $accountType = $this->account_model->getById($account->account_id);
                                    $invoiceItems = $this->invoice_model->get_invoice_items($invoice->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                                        $split = $arAcc->name;
    
                                        $invoiceItem = $this->invoice_model->get_invoice_item_by_id($transaction->child_id, $invoice->id);
                                        $transacItem = $this->items_model->getItemById($invoiceItem->items_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $invoiceItem->cost)), 2);
                                    } else {
                                        if(count($invoiceItems) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($invoiceItems[0]->items_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($invoiceItems[0]->items_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $itemAcc = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $itemAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
    
                                            $split = $itemAcc->name;
                                        }
    
                                        $openBalance = number_format(floatval(str_replace(',', '', $invoice->balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $invoice->balance)) > 0.00) {
                                        $arPaid = 'Unpaid';
                                    } else {
                                        $arPaid = 'Paid';
                                    }
                                break;
                                case 'Credit Memo' :
                                    $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($creditMemo->credit_memo_date));
                                    $num = $creditMemo->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($creditMemo->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($creditMemo->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Credit Memo', $creditMemo->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                                        $split = $arAcc->name;
    
                                        $creditMemoItem = $this->accounting_credit_memo_model->get_transaction_item_by_id($transaction->child_id);
                                        $transacItem = $this->items_model->getItemById($creditMemoItem->item_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $creditMemoItem->price)), 2);
                                    } else {
                                        if(count($items) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($items[0]->item_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
                    
                                            $split = $account->name;
                                        }
    
                                        $openBalance = '-'.number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $creditMemo->balance)) > 0.00) {
                                        $arPaid = 'Unpaid';
                                    } else {
                                        $arPaid = 'Paid';
                                    }
                                break;
                                case 'Sales Receipt' :
                                    $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($salesReceipt->sales_receipt_date));
                                    $num = $salesReceipt->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($salesReceipt->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($salesReceipt->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Sales Receipt', $salesReceipt->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($salesReceipt->deposit_to_account);
    
                                        $salesReceiptItem = $this->accounting_credit_memo_model->get_transaction_item_by_id($transaction->child_id);
                                        $transacItem = $this->items_model->getItemById($salesReceiptItem->item_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $salesReceiptItem->price)), 2);
                                    } else {
                                        if(count($items) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($items[0]->item_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
                    
                                            $split = $account->name;
                                        }
                                    }
                                break;
                                case 'Refund Receipt' :
                                    $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($refundReceipt->refund_receipt_date));
                                    $num = $refundReceipt->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($refundReceipt->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($refundReceipt->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Refund Receipt', $refundReceipt->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($refundReceipt->refund_from_account);
    
                                        $refundReceiptItem = $this->accounting_credit_memo_model->get_transaction_item_by_id($transaction->child_id);
                                        $transacItem = $this->items_model->getItemById($refundReceiptItem->item_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $refundReceiptItem->price)), 2);
                                    } else {
                                        if(count($items) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($items[0]->item_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
                    
                                            $split = $account->name;
                                        }
                                    }
                                break;
                                case 'Payment' :
                                    $payment = $this->accounting_receive_payment_model->getReceivePaymentDetails($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($payment->payment_date));
                                    $num = $payment->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($payment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($payment->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($payment->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $accountType = $this->account_model->getById($account->account_id);
                                    
                                    if($accountType->account_name !== 'Accounts receivable (A/R)') {
                                        $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                                        $split = $arAcc->name;
                                    } else {
                                        $split = $this->chart_of_accounts_model->getName($payment->deposit_to);
                                    }
    
                                    $arPaid = 'Paid';
                                break;
                                case 'Deposit' :
                                    $deposit = $this->accounting_bank_deposit_model->getById($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($deposit->date));
                                    $createDate = date("m/d/Y h:i:s A", strtotime($deposit->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($deposit->updated_at));
    
                                    $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);
    
                                    if($transaction->is_category === '1') {
                                        $fund = $this->accounting_bank_deposit_model->get_fund($transaction->child_id);
                        
                                        switch($fund->received_from_key) {
                                            case 'vendor':
                                                $payee = $this->vendors_model->get_vendor_by_id($fund->received_from_id);
                                                $vendor = $payee->display_name;
                                            break;
                                            case 'customer':
                                                $payee = $this->accounting_customers_model->get_by_id($fund->received_from_id);
                                                $customer = $payee->first_name . ' ' . $payee->last_name;
                                            break;
                                            case 'employee':
                                                $payee = $this->users_model->getUser($fund->received_from_id);
                                                $employee = $payee->FName . ' ' . $payee->LName;
                                            break;
                                        }
    
                                        $split = $this->chart_of_accounts_model->getName($deposit->account_id);
                                    } else {
                                        if(count($funds) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $split = $this->chart_of_accounts_model->getName($funds[0]->received_from_account_id);
                                        }
                                    }
                                break;
                                case 'Transfer' :
                                    $transfer = $this->accounting_transfer_funds_model->getById($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($transfer->transfer_date));
                                    $createDate = date("m/d/Y h:i:s A", strtotime($transfer->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($transfer->updated_at));
    
                                    if($account->id === $transfer->transfer_from_account_id) {
                                        $split = $this->chart_of_accounts_model->getById($transfer->transfer_to_account_id);
                                    } else {
                                        $split = $this->chart_of_accounts_model->getById($transfer->transfer_from_account_id);
                                    }
                                break;
                                case 'Journal' :
                                    $journalEntry = $this->accounting_journal_entries_model->getById($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($journalEntry->journal_date));
                                    $num = $journalEntry->journal_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($journalEntry->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($journalEntry->updated_at));
    
                                    $entries = $this->accounting_journal_entries_model->getEntries($journalEntry->id);
    
                                    foreach($entries as $entry) {
                                        if($entry->id === $transaction->child_id) {
                                            $journalEntryItem = $entry;
                                        }
                                    }
    
                                    switch($journalEntryItem->name_key) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($journalEntryItem->name_id);
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($journalEntryItem->name_id);
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($journalEntryItem->name_id);
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    $split = '-Split-';
                                break;
                                case 'Inventory Qty Adjust' :
                                    $adjustment = $this->accounting_inventory_qty_adjustments_model->get_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($adjustment->adjustment_date));
                                    $num = $adjustment->adjustment_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($adjustment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($adjustment->updated_at));
    
                                    if($account->id !== $adjustment->inventory_adjustment_account_id) {
                                        $split = $this->chart_of_accounts_model->getName($adjustment->inventory_adjustment_account_id);
                                    } else {
                                        
                                    }
                                break;
                                case 'Inventory Starting Value' :
                                    $adjustment = $this->starting_value_model->get_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($adjustment->as_of_date));
                                    $num = $adjustment->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($adjustment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($adjustment->updated_at));
    
                                    $rate = number_format(floatval(str_replace(',', '', $adjustment->initial_cost)), 2);
    
                                    $split = $this->chart_of_accounts_model->getName($adjustment->inv_asset_account);
                                break;
                                case 'CC Payment' :
                                    $ccPayment = $this->accounting_pay_down_credit_card_model->get_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($ccPayment->date));
                                    $createDate = date("m/d/Y h:i:s A", strtotime($ccPayment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($ccPayment->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
                                    $name = !is_null($payee) ? $payee->display_name : "";
                                    $vendor = !is_null($payee) ? $payee->display_name : "";
    
                                    $split = $ccPayment->credit_card_id === $account->id ? $this->chart_of_accounts_model->getName($ccPayment->bank_account_id) : $this->chart_of_accounts_model->getName($ccPayment->credit_card_id);
                                break;
                            }
    
                            $debit = $transaction->type === 'increase' ? number_format($transaction->amount, 2) : '';
                            $credit = $transaction->type === 'decrease' ? number_format($transaction->amount, 2) : '';
                            $amount = number_format($transaction->amount, 2);
                            $amount = $transaction->type === 'decrease' ? '-'.$amount : $amount;
    
                            $debitTotal += floatval($debit);
                            $creditTotal += floatval($credit);
                            $amountTotal += floatval($amount);
    
                            if(!empty(get('divide-by-100'))) {
                                $rate = number_format(floatval($rate) / 100, 2);
                                $amount = number_format(floatval($amount) / 100, 2);
                            }
    
                            if(!empty(get('without-cents'))) {
                                $rate = number_format(floatval($rate), 0);
                                $amount = number_format(floatval($amount), 0);
                            }
    
                            if(!empty(get('negative-numbers'))) {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '-') {
                                            $rate = str_replace('-', '', $rate);
                                            $rate = '('.$rate.')';
                                        }
    
                                        if(substr($amount, 0, 1) === '-') {
                                            $amount = str_replace('-', '', $amount);
                                            $amount = '('.$amount.')';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, 0, 1) === '-') {
                                            $rate = str_replace('-', '', $rate);
                                            $rate = $rate.'-';
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
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }
    
                                    if(substr($amount, 0, 1) === '-') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                } else {
                                    switch(get('negative-numbers')) {
                                        case '(100)' :
                                            if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                                $rate = '<span class="text-danger">'.$rate.'</span>';
                                            }
    
                                            if(substr($amount, 0, 1) === '(' && substr($amount, -1) === ')') {
                                                $amount = '<span class="text-danger">'.$amount.'</span>';
                                            }
                                        break;
                                        case '100-' :
                                            if(substr($rate, -1) === '-') {
                                                $rate = '<span class="text-danger">'.$rate.'</span>';
                                            }
    
                                            if(substr($amount, -1) === '-') {
                                                $amount = '<span class="text-danger">'.$amount.'</span>';
                                            }
                                        break;
                                    }
                                }
                            }
    
                            $accTransacs[] = [
                                'date' => $date,
                                'transaction_type' => $transaction->transaction_type,
                                'num' => $num,
                                'adj' => '',
                                'create_date' => $createDate,
                                'created_by' => '', 
                                'last_modified' => $lastModified,
                                'last_modified_by' => '',
                                'name' => $name,
                                'customer' => $customer,
                                'vendor' => $vendor,
                                'employee' => $employee,
                                'product_service' => $transacItem,
                                'memo_description' => $memo,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $account->name,
                                'split' => $split,
                                'invoice_date' => '',
                                'ar_paid' => $arPaid,
                                'ap_paid' => $apPaid,
                                'clr' => '',
                                'check_printed' => $checkPrinted,
                                'debit' => $debit,
                                'credit' => $credit,
                                'open_balance' => $openBalance,
                                'amount' => $amount,
                                'balance' => number_format($balance, 2),
                                'online_banking' => '',
                                'tax_name' => '',
                                'tax_amount' => $taxAmount,
                                'taxable_amount' => $taxableAmount
                            ];
                        }
                    }

                    if($this->page_data['filter_date'] !== 'all-dates') {
                        $accTransacs = array_filter($accTransacs, function($v, $k) use ($dateFilter) {
                            return strtotime($v['date']) >= strtotime($dateFilter['start_date']) && strtotime($v['date']) <= strtotime($dateFilter['end_date']);
                        }, ARRAY_FILTER_USE_BOTH);
                    }

                    $beginningBalance = number_format($beginningBalance, 2);
                    $amountTotal = number_format($amountTotal, 2);
                    $debitTotal = number_format($debitTotal, 2);
                    $creditTotal = number_format($creditTotal, 2);
                    $taxAmountTotal = number_format($taxAmountTotal, 2);
                    $taxableAmountTotal = number_format($taxableAmountTotal, 2);

                    if(!empty(get('divide-by-100'))) {
                        $rate = number_format(floatval($rate) / 100, 2);
                        $beginningBalance = number_format(floatval($beginningBalance) / 100, 2);
                        $amountTotal = number_format(floatval($amountTotal) / 100, 2);
                        $debitTotal = number_format(floatval($debitTotal) / 100, 2);
                        $creditTotal = number_format(floatval($creditTotal) / 100, 2);
                        $taxAmountTotal = number_format(floatval($taxAmountTotal) / 100, 2);
                        $taxableAmountTotal = number_format(floatval($taxableAmountTotal) / 100, 2);
                    }

                    if(!empty(get('without-cents'))) {
                        $rate = number_format(floatval($rate), 0);
                        $beginningBalance = number_format(floatval($beginningBalance), 0);
                        $amountTotal = number_format(floatval($amountTotal), 0);
                        $debitTotal = number_format(floatval($debitTotal), 0);
                        $creditTotal = number_format(floatval($creditTotal), 0);
                        $taxAmountTotal = number_format(floatval($taxAmountTotal), 0);
                        $taxableAmountTotal = number_format(floatval($taxableAmountTotal), 0);
                    }

                    if(!empty(get('negative-numbers'))) {
                        switch(get('negative-numbers')) {
                            case '(100)' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = '('.$rate.')';
                                }

                                if(substr($beginningBalance, 0, 1) === '-') {
                                    $beginningBalance = str_replace('-', '', $beginningBalance);
                                    $beginningBalance = '('.$beginningBalance.')';
                                }

                                if(substr($amountTotal, 0, 1) === '-') {
                                    $amountTotal = str_replace('-', '', $amountTotal);
                                    $amountTotal = '('.$amountTotal.')';
                                }

                                if(substr($debitTotal, 0, 1) === '-') {
                                    $debitTotal = str_replace('-', '', $debitTotal);
                                    $debitTotal = '('.$debitTotal.')';
                                }

                                if(substr($creditTotal, 0, 1) === '-') {
                                    $creditTotal = str_replace('-', '', $creditTotal);
                                    $creditTotal = '('.$creditTotal.')';
                                }

                                if(substr($taxAmountTotal, 0, 1) === '-') {
                                    $taxAmountTotal = str_replace('-', '', $taxAmountTotal);
                                    $taxAmountTotal = '('.$taxAmountTotal.')';
                                }

                                if(substr($taxableAmountTotal, 0, 1) === '-') {
                                    $taxableAmountTotal = str_replace('-', '', $taxableAmountTotal);
                                    $taxableAmountTotal = '('.$taxableAmountTotal.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = $rate.'-';
                                }

                                if(substr($beginningBalance, 0, 1) === '-') {
                                    $beginningBalance = str_replace('-', '', $beginningBalance);
                                    $beginningBalance = $beginningBalance.'-';
                                }

                                if(substr($amountTotal, 0, 1) === '-') {
                                    $amountTotal = str_replace('-', '', $amountTotal);
                                    $amountTotal = $amountTotal.'-';
                                }

                                if(substr($debitTotal, 0, 1) === '-') {
                                    $debitTotal = str_replace('-', '', $debitTotal);
                                    $debitTotal = $debitTotal.'-';
                                }

                                if(substr($creditTotal, 0, 1) === '-') {
                                    $creditTotal = str_replace('-', '', $creditTotal);
                                    $creditTotal = $creditTotal.'-';
                                }

                                if(substr($taxAmountTotal, 0, 1) === '-') {
                                    $taxAmountTotal = str_replace('-', '', $taxAmountTotal);
                                    $taxAmountTotal = $taxAmountTotal.'-';
                                }

                                if(substr($taxableAmountTotal, 0, 1) === '-') {
                                    $taxableAmountTotal = str_replace('-', '', $taxableAmountTotal);
                                    $taxableAmountTotal = $taxableAmountTotal.'-';
                                }
                            break;
                        }
                    }

                    if(!empty(get('show-in-red'))) {
                        if(empty(get('negative-numbers'))) {
                            if(substr($rate, 0, 1) === '-') {
                                $rate = '<span class="text-danger">'.$rate.'</span>';
                            }

                            if(substr($beginningBalance, 0, 1) === '-') {
                                $beginningBalance = '<span class="text-danger">'.$beginningBalance.'</span>';
                            }

                            if(substr($amountTotal, 0, 1) === '-') {
                                $amountTotal = '<span class="text-danger">'.$amountTotal.'</span>';
                            }

                            if(substr($debitTotal, 0, 1) === '-') {
                                $debitTotal = '<span class="text-danger">'.$debitTotal.'</span>';
                            }

                            if(substr($creditTotal, 0, 1) === '-') {
                                $creditTotal = '<span class="text-danger">'.$creditTotal.'</span>';
                            }

                            if(substr($taxAmountTotal, 0, 1) === '-') {
                                $taxAmountTotal = '<span class="text-danger">'.$taxAmountTotal.'</span>';
                            }

                            if(substr($taxableAmountTotal, 0, 1) === '-') {
                                $taxableAmountTotal = '<span class="text-danger">'.$taxableAmountTotal.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($beginningBalance, 0, 1) === '(' && substr($beginningBalance, -1) === ')') {
                                        $beginningBalance = '<span class="text-danger">'.$beginningBalance.'</span>';
                                    }

                                    if(substr($amountTotal, 0, 1) === '(' && substr($amountTotal, -1) === ')') {
                                        $amountTotal = '<span class="text-danger">'.$amountTotal.'</span>';
                                    }

                                    if(substr($debitTotal, 0, 1) === '(' && substr($debitTotal, -1) === ')') {
                                        $debitTotal = '<span class="text-danger">'.$debitTotal.'</span>';
                                    }

                                    if(substr($creditTotal, 0, 1) === '(' && substr($creditTotal, -1) === ')') {
                                        $creditTotal = '<span class="text-danger">'.$creditTotal.'</span>';
                                    }

                                    if(substr($taxAmountTotal, 0, 1) === '(' && substr($taxAmountTotal, -1) === ')') {
                                        $taxAmountTotal = '<span class="text-danger">'.$taxAmountTotal.'</span>';
                                    }

                                    if(substr($taxableAmountTotal, 0, 1) === '(' && substr($taxableAmountTotal, -1) === ')') {
                                        $taxableAmountTotal = '<span class="text-danger">'.$taxableAmountTotal.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, -1) === '-') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($beginningBalance, -1) === '-') {
                                        $beginningBalance = '<span class="text-danger">'.$beginningBalance.'</span>';
                                    }

                                    if(substr($amountTotal, -1) === '-') {
                                        $amountTotal = '<span class="text-danger">'.$amountTotal.'</span>';
                                    }

                                    if(substr($debitTotal, -1) === '-') {
                                        $debitTotal = '<span class="text-danger">'.$debitTotal.'</span>';
                                    }

                                    if(substr($creditTotal, -1) === '-') {
                                        $creditTotal = '<span class="text-danger">'.$creditTotal.'</span>';
                                    }

                                    if(substr($taxAmountTotal, -1) === '-') {
                                        $taxAmountTotal = '<span class="text-danger">'.$taxAmountTotal.'</span>';
                                    }

                                    if(substr($taxableAmountTotal, -1) === '-') {
                                        $taxableAmountTotal = '<span class="text-danger">'.$taxableAmountTotal.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $accounts[] = [
                        'account_id' => $account->id,
                        'type' => $this->account_model->getName($account->account_id),
                        // 'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                        'name' => $account->name,
                        'debit_total' => $debitTotal,
                        'credit_total' => $creditTotal,
                        'amount_total' => $amountTotal,
                        'tax_amount_total' => $taxAmountTotal,
                        'taxable_amount_total' => $taxableAmountTotal,
                        'beginning_balance' => $beginningBalance,
                        'transactions' => $accTransacs
                    ];
                }

                if(!empty(get('distribution-account'))) {
                    $this->page_data['filter_distribution_account'] = new stdClass();
                    $this->page_data['filter_distribution_account']->id = get('distribution-account');

                    if(intval(get('distribution-account')) > 0) {
                        $account = $this->chart_of_accounts_model->getById(get('distribution-account'));
                        $this->page_data['filter_distribution_account']->name = $account->name;

                        $filters = [
                            'account_id' => get('distribution-account')
                        ];

                        $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                            return $v['account_id'] === $filters['account_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $names = [
                            'balance-sheet-accounts' => 'All Balance Sheet Accounts',
                            'asset-accounts' => 'All Asset Accounts',
                            'current-asset-accounts' => 'All Current Asset Accounts',
                            'bank-accounts' => 'All Bank Accounts',
                            'accounts-receivable-accounts' => 'All Accounts receivable (A/R) Accounts',
                            'other-current-assets-accounts' => 'All Other Current Assets Accounts',
                            'fixed-assets-accounts' => 'All Fixed Assets Accounts',
                            'other-assets-accounts' => 'All Other Assets Accounts',
                            'liability-accounts' => 'All Liability Accounts',
                            'accounts-payable-accounts' => 'All Accounts payable (A/P) Accounts',
                            'credit-card-accounts' => 'All Credit Card Accounts',
                            'other-current-liabilities-accounts' => 'All Other Current Liabilities Accounts',
                            'long-term-liabilities-accounts' => 'All Long Term Liabilities Accounts',
                            'equity-accounts' => 'All Equity Accounts',
                            'income-expense-accounts' => 'All Income/Expense Accounts',
                            'income-accounts' => 'All Income Accounts',
                            'cost-of-goods-sold-accounts' => 'All Cost of Goods Sold Accounts',
                            'expenses-accounts' => 'All Expenses Accounts',
                            'other-income-accounts' => 'All Other Income Accounts',
                            'other-expense-accounts' => 'All Other Expense Accounts'
                        ];
                        $this->page_data['filter_distribution_account']->name = $names[get('distribution-account')];

                        $type = get('distribution-account');

                        $accounts = array_filter($accounts, function($v, $k) use ($type) {
                            switch($type) {
                                case 'balance-sheet-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false || strpos($v['type'], 'Liabilities') !== false || $v['type'] === 'Equity' || $v['type'] === 'Credit Card';
                                break;
                                case 'asset-account' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false;
                                break;
                                case 'current-asset-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || $v['type'] === 'Other Current Assets';
                                break;
                                case 'bank-accounts' :
                                    return $v['type'] === 'Bank';
                                break;
                                case 'accounts-receivable-accounts' :
                                    return $v['type'] === 'Accounts receivable (A/R)';
                                break;
                                case 'other-current-assets-accounts' :
                                    return $v['type'] === 'Other Current Assets';
                                break;
                                case 'fixed-assets-accounts' :
                                    return $v['type'] === 'Fixed Assets';
                                break;
                                case 'other-assets-accounts' :
                                    return $v['type'] === 'Other Assets';
                                break;
                                case 'liability-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || strpos($v['type'], 'Liabilities') !== false;
                                break;
                                case 'accounts-payable-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'credit-card-accounts' :
                                    return $v['type'] === 'Credit Card';
                                break;
                                case 'other-current-liabilities-accounts' :
                                    return $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'long-term-liabilities-accounts' :
                                    return $v['type'] === 'Long Term Liabilities';
                                break;
                                case 'equity-accounts' :
                                    return $v['type'] === 'Equity';
                                break;
                                case 'income-expense-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold' || strpos($v['type'], 'Income') !== false || strpos($v['type'], 'Expense') !== false;
                                break;
                                case 'income-accounts' :
                                    return $v['type'] === 'Income';
                                break;
                                case 'cost-of-goods-sold-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold';
                                break;
                                case 'expenses-accounts' :
                                    return $v['type'] === 'Expenses';
                                break;
                                case 'other-income-accounts' :
                                    return $v['type'] === 'Other Income';
                                break;
                                case 'other-expense-accounts' :
                                    return $v['type'] === 'Other Expense';
                                break;
                            };
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                }

                $this->page_data['accounts'] = $accounts;

                if(!empty(get('accounting-method'))) {
                    $this->page_data['accounting_method'] = get('accounting-method');
                }

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

                    $index = array_search('Debit', $columns);
                    if($index === false) {
                        $index = array_search('Credit', $columns);
                    }

                    if($index === false) {
                        $index = array_search('Amount', $columns);
                    }

                    if($index === false) {
                        $index = array_search('Tax Amount', $columns);
                    }

                    if($index === false) {
                        $index = array_search('Taxable Amount', $columns);
                    }

                    $this->page_data['total_index'] = $index === false ? count($columns) : $index;

                    $balanceIndex = array_search('Balance', $columns);
                    if($balanceIndex === false) {
                        $balanceIndex = count($columns);
                    }

                    $this->page_data['balance_index'] = $balanceIndex;
                }

                if(!empty(get('show-company-name'))) {
                    $this->page_data['show_company_name'] = false;
                }

                if(!empty(get('company-name'))) {
                    $this->page_data['company_name'] = get('company-name');
                }

                $this->page_data['report_title'] = 'General Ledger';
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
            case 'journal' :
                $this->page_data['start_date'] = date("m/01/Y");
                $this->page_data['end_date'] = date("m/d/Y");
                $this->page_data['report_period'] = date("F 1-j, Y");
                if(!empty(get('date'))) {
                    $this->page_data['filter_date'] = get('date');
                    if(get('date') !== 'all-dates') {
                        $this->page_data['start_date'] = str_replace('-', '/', get('from'));
                        $this->page_data['end_date'] = str_replace('-', '/', get('to'));
                    } else {
                        $this->page_data['start_date'] = null;
                        $this->page_data['start_date'] = null;
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

                $transactions = [];

                $invoices = $this->invoice_model->get_all_company_invoice(logged('company_id'));
                foreach($invoices as $invoice)
                {
                    $employee = $this->users_model->getUser($invoice->user_id);
                    $createdBy = $employee->FName . ' ' . $employee->LName;

                    $customer = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $payments = $this->invoice_model->getPayments($invoice->invoice_number);

                    usort($payments, function($a, $b) {
                        return strtotime($a->payment_date) < strtotime($b->payment_date);
                    });

                    $invoiceItems = $this->invoice_model->get_invoice_items($invoice->id);
                    $subRows = [];
                    foreach($invoiceItems as $invoiceItem)
                    {
                        $item = $this->items_model->getItemById($invoiceItem->items_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $invoiceItem->cost));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($invoiceItem->qty);
                        $rate = number_format(floatval($rate), 2);

                        $qty = '-'.number_format(floatval($invoiceItem->qty), 2);
                        $expenseQty = number_format(floatval($invoiceItem->qty), 2);

                        if(!empty(get('divide-by-100'))) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Invoice',
                            'transaction_id' => $invoice->id,
                            'is_item_category' => 1,
                            'child_id' => $invoiceItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Invoice',
                            'transaction_id' => $invoice->id,
                            'is_item_category' => 1,
                            'child_id' => $invoiceItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ',')
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Invoice',
                            'transaction_id' => $invoice->id,
                            'is_item_category' => 1,
                            'child_id' => $invoiceItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'ar_paid' => floatval(str_replace(',', '', $invoice->balance)) > 0.00 ? 'Unpaid' : 'Paid'
                            ];
                        }
                    }

                    $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                        'transaction_type' => 'Invoice',
                        'to_print' => '',
                        'num' => $invoice->invoice_number,
                        'created_by' => $createdBy,
                        'last_modified_by' => '',
                        'due_date' => date("m/d/Y", strtotime($invoice->due_date)),
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($invoice->date_updated)),
                        'open_balance' => number_format(floatval(str_replace(',', '', $invoice->balance)), 2, '.', ','),
                        'payment_date' => date("m/d/Y", strtotime($payments[0]->payment_date)),
                        'method' => 'Invoice',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($invoice->date_created)),
                        'name_type' => 'customer',
                        'name_id' => $invoice->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $invoice->message_to_customer,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $arAcc->id,
                        'account' => $arAcc->name,
                        'ar_paid' => floatval(str_replace(',', '', $invoice->balance)) > 0.00 ? 'Unpaid' : 'Paid',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $invoice->grand_total)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $filters = [
                    'company_id' => logged('company_id'),
                    'start-date' => date("Y-m-d", strtotime($this->page_data['start_date'])),
                    'end-date' => date("Y-m-d", strtotime($this->page_data['end_date']))
                ];
                $expenses = $this->expenses_model->get_company_expense_transactions($filters);
                foreach($expenses as $expense)
                {
                    $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
                    $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

                    $type = $paymentAccType->account_name === 'Credit Card' ? 'Credit Card Expense' : 'Expense';

                    switch($expense->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($expense->payee_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
                    $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Expense',
                            'transaction_id' => $expense->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $expenseItem)
                    {
                        $item = $this->items_model->getItemById($expenseItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Expense',
                            'transaction_id' => $expense->id,
                            'is_item_category' => 1,
                            'child_id' => $expenseItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $expenseItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($expenseItem->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($expense->payment_date)),
                        'transaction_type' => $type,
                        'to_print' => '',
                        'num' => $expense->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($expense->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => $type,
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($expense->created_at)),
                        'name_type' => $expense->payee_type,
                        'name_id' => $expense->payee_id,
                        'name' => $name,
                        'customer' => $expense->payee_type === 'customer' ? $name : '',
                        'vendor' => $expense->payee_type === 'vendor' ? $name : '',
                        'employee' => $expense->payee_type === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $expense->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $paymentAcc->id,
                        'account' => $paymentAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $expense->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $checks = $this->expenses_model->get_company_check_transactions($filters);
                foreach($checks as $check)
                {
                    $bankAcc = $this->chart_of_accounts_model->getById($check->bank_account_id);
                    switch($check->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($check->payee_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $categories = $this->expenses_model->get_transaction_categories($check->id, 'Check');
                    $items = $this->expenses_model->get_transaction_items($check->id, 'Check');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Check',
                            'transaction_id' => $check->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $checkItem)
                    {
                        $item = $this->items_model->getItemById($checkItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Check',
                            'transaction_id' => $check->id,
                            'is_item_category' => 1,
                            'child_id' => $checkItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $checkItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($checkItem->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($check->payment_date)),
                        'transaction_type' => 'Check',
                        'to_print' => $check->to_print,
                        'num' => $check->check_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($check->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Check',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($check->created_at)),
                        'name_type' => $check->payee_type,
                        'name_id' => $check->payee_id,
                        'name' => $name,
                        'customer' => $check->payee_type === 'customer' ? $name : '',
                        'vendor' => $check->payee_type === 'vendor' ? $name : '',
                        'employee' => $check->payee_type === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $check->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $bankAcc->id,
                        'account' => $bankAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $check->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $payments = $this->accounting_receive_payment_model->get_payments_by_company_id($filters['company_id']);
                foreach($payments as $payment)
                {
                    $depositToAcc = $this->chart_of_accounts_model->getById($payment->deposit_to);

                    $customer = $this->accounting_customers_model->get_by_id($payment->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                    $where = [
                        'account_id' => $arAcc->id,
                        'transaction_type' => 'Payment',
                        'transaction_id' => $payment->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $subRows = [
                        [
                            'account' => $arAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $name,
                            'payment_date' => date("m/d/Y", strtotime($payment->payment_date)),
                            'ar_paid' => 'Paid'
                        ]
                    ];

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($payment->payment_date)),
                        'transaction_type' => 'Payment',
                        'to_print' => '',
                        'num' => $payment->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($payment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Payment',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($payment->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $payment->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $payment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $depositToAcc->id,
                        'account' => $depositToAcc->name,
                        'ar_paid' => 'Paid',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $payment->amount_received)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $journalEntries = $this->accounting_journal_entries_model->get_company_journal_entries($filters);
                foreach($journalEntries as $journalEntry)
                {
                    $employee = $this->users_model->getUser($journalEntry->created_by);
                    $createdBy = $employee->FName . ' ' . $employee->LName;

                    $entries = $this->accounting_journal_entries_model->getEntries($journalEntry->id);

                    switch($entries[0]->name_key) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($entries[0]->name_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($entries[0]->name_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($entries[0]->name_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $account = $this->chart_of_accounts_model->getById($entries[0]->account_id);

                    $subRows = [];
                    foreach($entries as $index => $entry)
                    {
                        if($index > 0) {
                            $entryAcc = $this->chart_of_accounts_model->getById($entry->account_id);

                            switch($entry->name_key) {
                                case 'vendor':
                                    $vendor = $this->vendors_model->get_vendor_by_id($entry->name_id);
                                    $name = $vendor->display_name;
                                break;
                                case 'customer':
                                    $customer = $this->accounting_customers_model->get_by_id($entry->name_id);
                                    $name = $customer->first_name . ' ' . $customer->last_name;
                                break;
                                case 'employee':
                                    $employee = $this->users_model->getUser($entry->name_id);
                                    $name = $employee->FName . ' ' . $employee->LName;
                                break;
                            }

                            $subRows[] = [
                                'account' => $entryAcc->name,
                                'customer' => $entry->name_key === 'customer' ? $name : '',
                                'vendor' => $entry->name_key === 'vendor' ? $name : '',
                                'employee' => $entry->name_key === 'employee' ? $name : '',
                                'debit' => !empty($entry->debit) ? number_format(floatval(str_replace(',', '', $entry->debit)), 2, '.', ',') : '',
                                'credit' => !empty($entry->credit) ? number_format(floatval(str_replace(',', '', $entry->credit)), 2, '.', ',') : ''
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($journalEntry->journal_date)),
                        'transaction_type' => 'Journal Entry',
                        'to_print' => '',
                        'num' => $journalEntry->journal_no,
                        'created_by' => $createdBy,
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($journalEntry->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Journal Entry',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($journalEntry->created_at)),
                        'name_type' => $entries[0]->name_key,
                        'name_id' => $entries[0]->name_id,
                        'name' => $name,
                        'customer' => $entries[0]->name_key === 'customer' ? $name : '',
                        'vendor' => $entries[0]->name_key === 'vendor' ? $name : '',
                        'employee' => $entries[0]->name_key === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $entries[0]->description,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => !empty($entries[0]->debit) ? number_format(floatval(str_replace(',', '', $entries[0]->debit)), 2, '.', ',') : '',
                        'credit' => !empty($entries[0]->credit) ? number_format(floatval(str_replace(',', '', $entries[0]->credit)), 2, '.', ',') : '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $bills = $this->expenses_model->get_company_bill_transactions($filters);
                foreach($bills as $bill)
                {
                    $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                    $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                    $name = $payee->display_name;

                    $categories = $this->expenses_model->get_transaction_categories($bill->id, 'Bill');
                    $items = $this->expenses_model->get_transaction_items($bill->id, 'Bill');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Bill',
                            'transaction_id' => $bill->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $billItem)
                    {
                        $item = $this->items_model->getItemById($billItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Bill',
                            'transaction_id' => $bill->id,
                            'is_item_category' => 1,
                            'child_id' => $billItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $billItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($billItem->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($bill->bill_date)),
                        'transaction_type' => 'Bill',
                        'to_print' => '',
                        'num' => $bill->bill_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($bill->updated_at)),
                        'open_balance' => number_format(floatval(str_replace(',', '', $bill->remaining_balance)), 2, '.', ','),
                        'payment_date' => '',
                        'method' => 'Bill',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($bill->created_at)),
                        'name_type' => 'vendor',
                        'name_id' => $bill->vendor_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $bill->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $apAcc->id,
                        'account' => $apAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $bill->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $ccCredits = $this->expenses_model->get_company_cc_credit_transactions($filters);
                foreach($ccCredits as $ccCredit)
                {
                    $account = $this->chart_of_accounts_model->getById($ccCredit->bank_credit_account_id);

                    switch($ccCredit->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($ccCredit->payee_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $categories = $this->expenses_model->get_transaction_categories($ccCredit->id, 'Credit Card Credit');
                    $items = $this->expenses_model->get_transaction_items($ccCredit->id, 'Credit Card Credit');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'CC Credit',
                            'transaction_id' => $ccCredit->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $ccCreditItem)
                    {
                        $item = $this->items_model->getItemById($ccCreditItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'CC Credit',
                            'transaction_id' => $ccCredit->id,
                            'is_item_category' => 1,
                            'child_id' => $ccCreditItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $ccCreditItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($ccCreditItem->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                        'transaction_type' => 'Credit Card Credit',
                        'to_print' => '',
                        'num' => $ccCredit->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($ccCredit->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Credit Card Credit',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($ccCredit->created_at)),
                        'name_type' => $ccCredit->payee_type,
                        'name_id' => $ccCredit->payee_id,
                        'name' => $name,
                        'customer' => $ccCredit->payee_type === 'customer' ? $name : '',
                        'vendor' => $ccCredit->payee_type === 'vendor' ? $name : '',
                        'employee' => $ccCredit->payee_type === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $ccCredit->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $ccCredit->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $vendorCredits = $this->expenses_model->get_company_vendor_credit_transactions($filters);
                foreach($vendorCredits as $vCredit)
                {
                    $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));

                    $payee = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
                    $name = $payee->display_name;

                    $categories = $this->expenses_model->get_transaction_categories($vCredit->id, 'Vendor Credit');
                    $items = $this->expenses_model->get_transaction_items($vCredit->id, 'Vendor Credit');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Vendor Credit',
                            'transaction_id' => $vCredit->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $vCreditItem)
                    {
                        $item = $this->items_model->getItemById($vCreditItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Vendor Credit',
                            'transaction_id' => $vCredit->id,
                            'is_item_category' => 1,
                            'child_id' => $vCreditItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $vCreditItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($vCreditItem->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $openBalance = '-'.number_format(floatval(str_replace(',', '', $vCredit->remaining_balance)), 2, '.', ',');
                    if(!empty(get('divide-by-100'))) {
                        $openBalance = number_format(floatval($openBalance) / 100, 2);
                    }

                    if(!empty(get('without-cents'))) {
                        $openBalance = number_format(floatval($openBalance), 0);
                    }

                    if(!empty(get('negative-numbers'))) {
                        switch(get('negative-numbers')) {
                            case '(100)' :
                                if(substr($openBalance, 0, 1) === '-') {
                                    $openBalance = str_replace('-', '', $openBalance);
                                    $openBalance = '('.$openBalance.')';
                                }
                            break;
                            case '100-' :
                                if(substr($openBalance, 0, 1) === '-') {
                                    $openBalance = str_replace('-', '', $openBalance);
                                    $openBalance = $openBalance.'-';
                                }
                            break;
                        }
                    }

                    if(!empty(get('show-in-red'))) {
                        if(empty(get('negative-numbers'))) {
                            if(substr($openBalance, 0, 1) === '-') {
                                $openBalance = '<span class="text-danger">'.$openBalance.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($openBalance, 0, 1) === '(' && substr($openBalance, -1) === ')') {
                                        $openBalance = '<span class="text-danger">'.$openBalance.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($openBalance, -1) === '-') {
                                        $openBalance = '<span class="text-danger">'.$openBalance.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                        'transaction_type' => 'Vendor Credit',
                        'to_print' => '',
                        'num' => $vCredit->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($vCredit->updated_at)),
                        'open_balance' => $openBalance,
                        'payment_date' => '',
                        'method' => 'Vendor Credit',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($vCredit->created_at)),
                        'name_type' => 'vendor',
                        'name_id' => $vCredit->vendor_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $vCredit->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $apAcc->id,
                        'account' => $apAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $vCredit->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $billPayments = $this->expenses_model->get_company_bill_payment_items($filters);
                foreach($billPayments as $billPayment)
                {
                    $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
                    $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

                    $type = $paymentAccType->account_name === 'Credit Card' ? 'Bill Payment (Credit Card)' : 'Bill Payment (Check)';

                    $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
                    $name = $payee->display_name;

                    $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                    $where = [
                        'account_id' => $apAcc->id,
                        'transaction_type' => 'Bill Payment',
                        'transaction_id' => $billPayment->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $subRows = [
                        [
                            'account' => $apAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'vendor' => $name,
                            'payment_date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                            'ap_paid' => 'Paid'
                        ]
                    ];

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                        'transaction_type' => $type,
                        'to_print' => $billPayment->to_print_check_no,
                        'num' => $billPayment->check_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($billPayment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => $type,
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($billPayment->created_at)),
                        'name_type' => 'vendor',
                        'name_id' => $billPayment->payee_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $billPayment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $paymentAcc->id,
                        'account' => $paymentAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => 'Paid',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $billPayment->amount_to_apply)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $transfers = $this->expenses_model->get_company_transfers($filters);
                foreach($transfers as $transfer)
                {
                    $account = $this->chart_of_accounts_model->getById($transfer->transfer_from_account_id);

                    $transferToAcc = $this->chart_of_accounts_model->getById($transfer->transfer_to_account_id);
                    $where = [
                        'account_id' => $transferToAcc->id,
                        'transaction_type' => 'Transfer',
                        'transaction_id' => $transfer->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $subRows = [
                        [
                            'account' => $transferToAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ]
                    ];

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($transfer->transfer_date)),
                        'transaction_type' => 'Transfer',
                        'to_print' => '',
                        'num' => '',
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($transfer->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Transfer',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($transfer->created_at)),
                        'name_type' => '',
                        'name_id' => '',
                        'name' => '',
                        'customer' => '',
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $transfer->transfer_memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $transfer->transfer_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $deposits = $this->accounting_bank_deposit_model->get_company_deposits($filters);
                foreach($deposits as $deposit)
                {
                    $account = $this->chart_of_accounts_model->getById($deposit->account_id);

                    $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);

                    $subRows = [];
                    foreach($funds as $fund)
                    {
                        $fundAcc = $this->chart_of_accounts_model->getById($fund->received_from_account_id);

                        $where = [
                            'account_id' => $fundAcc->id,
                            'transaction_type' => 'Deposit',
                            'transaction_id' => $deposit->id,
                            'is_category' => 1,
                            'child_id' => $fund->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $vendor = '';
                        $customer = '';
                        $employee = '';
                        switch($fund->received_from_key) {
                            case 'vendor':
                                $receivedFrom = $this->vendors_model->get_vendor_by_id($fund->received_from_id);
                                $vendor = $receivedFrom->display_name;
                            break;
                            case 'customer':
                                $receivedFrom = $this->accounting_customers_model->get_by_id($fund->received_from_id);
                                $customer = $receivedFrom->first_name . ' ' . $receivedFrom->last_name;
                            break;
                            case 'employee':
                                $receivedFrom = $this->users_model->getUser($fund->received_from_id);
                                $employee = $receivedFrom->FName . ' ' . $receivedFrom->LName;
                            break;
                        }

                        $subRows[] = [
                            'account' => $fundAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer,
                            'vendor' => $vendor,
                            'employee' => $employee
                        ];
                    }

                    if(count($funds) < 2 && count($funds) > 0) {
                        switch($funds[0]->received_from_key) {
                            case 'vendor':
                                $receivedFrom = $this->vendors_model->get_vendor_by_id($funds[0]->received_from_id);
                                $name = $receivedFrom->display_name;
                                $vendor = $name;
                            break;
                            case 'customer':
                                $receivedFrom = $this->accounting_customers_model->get_by_id($funds[0]->received_from_id);
                                $name = $receivedFrom->first_name . ' ' . $receivedFrom->last_name;
                                $customer = $name;
                            break;
                            case 'employee':
                                $receivedFrom = $this->users_model->getUser($funds[0]->received_from_id);
                                $name = $receivedFrom->FName . ' ' . $receivedFrom->LName;
                                $employee = $name;
                            break;
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($deposit->date)),
                        'transaction_type' => 'Deposit',
                        'to_print' => '',
                        'num' => '',
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($deposit->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Deposit',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($deposit->created_at)),
                        'name_type' => count($funds) < 2 && count($funds) > 0 ? $funds[0]->received_from_key : '',
                        'name_id' => count($funds) < 2 && count($funds) > 0 ? $funds[0]->received_from_id : '',
                        'name' => $name,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'employee' => $employee,
                        'product_service' => '',
                        'memo_description' => $deposit->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $deposit->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $salesReceipts = $this->accounting_sales_receipt_model->get_all_by_company_id(logged('company_id'));
                foreach($salesReceipts as $salesReceipt)
                {
                    $account = $this->chart_of_accounts_model->getById($salesReceipt->deposit_to_account);

                    $salesReceiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Sales Receipt', $salesReceipt->id);

                    $customer = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $subRows = [];
                    foreach($salesReceiptItems as $salesReceiptItem)
                    {
                        $item = $this->items_model->getItemById($salesReceiptItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $salesReceiptItem->price));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($salesReceiptItem->quantity);
                        $rate = number_format(floatval($rate), 2);

                        $qty = '-'.number_format(floatval($salesReceiptItem->quantity), 2);
                        $expenseQty = number_format(floatval($salesReceiptItem->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Sales Receipt',
                            'transaction_id' => $salesReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $salesReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Sales Receipt',
                            'transaction_id' => $salesReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $salesReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Sales Receipt',
                            'transaction_id' => $salesReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $salesReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($salesReceipt->sales_receipt_date)),
                        'transaction_type' => 'Sales Receipt',
                        'to_print' => '',
                        'num' => $salesReceipt->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($salesReceipt->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Sales Receipt',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($salesReceipt->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $salesReceipt->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $salesReceipt->message_on_statement,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $salesReceipt->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $creditMemos = $this->accounting_credit_memo_model->get_company_credit_memos(['company_id' => logged('company_id')]);
                foreach($creditMemos as $creditMemo)
                {
                    $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                    $creditMemoItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Credit Memo', $creditMemo->id);

                    $customer = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $subRows = [];
                    foreach($creditMemoItems as $creditMemoItem)
                    {
                        $item = $this->items_model->getItemById($creditMemoItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $creditMemoItem->price));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($creditMemoItem->quantity);
                        $rate = number_format(floatval($rate), 2);

                        $qty = number_format(floatval($creditMemo->quantity), 2);
                        $expenseQty = '-'.number_format(floatval($creditMemo->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Credit Memo',
                            'transaction_id' => $creditMemo->id,
                            'is_item_category' => 1,
                            'child_id' => $creditMemoItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Credit Memo',
                            'transaction_id' => $creditMemo->id,
                            'is_item_category' => 1,
                            'child_id' => $creditMemoItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Credit Memo',
                            'transaction_id' => $creditMemo->id,
                            'is_item_category' => 1,
                            'child_id' => $creditMemoItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                        'transaction_type' => 'Credit Memo',
                        'to_print' => '',
                        'num' => $creditMemo->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($creditMemo->updated_at)),
                        'open_balance' => number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2, '.', ','),
                        'payment_date' => '',
                        'method' => 'Credit Memo',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($creditMemo->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $creditMemo->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $creditMemo->message_on_statement,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $arAcc->id,
                        'account' => $arAcc->name,
                        'ar_paid' => floatval(str_replace(',', '', $creditMemo->balance)) > 0.00 ? 'Unpaid' : 'Paid',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $creditMemo->total_amount)), 2, '.', ','),
                        'online_banking' => ''
                    ];
                }

                $refundReceipts = $this->accounting_refund_receipt_model->get_company_refund_receipts(['company_id' => logged('company_id')]);
                foreach($refundReceipts as $refundReceipt)
                {
                    $account = $this->chart_of_accounts_model->getById($refundReceipt->refund_from_account);

                    $refundReceiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Refund Receipt', $refundReceipt->id);

                    $customer = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $subRows = [];
                    foreach($refundReceiptItems as $refundReceiptItem)
                    {
                        $item = $this->items_model->getItemById($refundReceiptItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $refundReceiptItem->price));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($refundReceiptItem->quantity);
                        $rate = number_format(floatval($rate), 2);

                        $qty = number_format(floatval($refundReceiptItem->quantity), 2);
                        $expenseQty = '-'.number_format(floatval($refundReceiptItem->quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Refund Receipt',
                            'transaction_id' => $refundReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $refundReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Refund Receipt',
                            'transaction_id' => $refundReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $refundReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Refund Receipt',
                            'transaction_id' => $refundReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $refundReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                        'transaction_type' => 'Refund Receipt',
                        'to_print' => $refundReceipt->print_later,
                        'num' => $refundReceipt->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($refundReceipt->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Refund Receipt',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($refundReceipt->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $refundReceipt->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $refundReceipt->message_on_statement,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $refundReceipt->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $qtyAdjustments = $this->accounting_inventory_qty_adjustments_model->get_company_quantity_adjustments($filters);
                foreach($qtyAdjustments as $adjustment)
                {
                    $account = $this->chart_of_accounts_model->getById($adjustment->inventory_adjustment_account_id);

                    $adjustmentItems = $this->accounting_inventory_qty_adjustments_model->get_adjusted_products($adjustment->id);

                    $subRows = [];
                    foreach($adjustmentItems as $adjustmentItem)
                    {
                        $item = $this->items_model->getItemById($adjustmentItem->product_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Inventory Qty Adjust',
                            'transaction_id' => $adjustment->id,
                            'is_item_category' => 1,
                            'child_id' => $adjustmentItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $item->cost));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($adjustmentItem->change_in_quantity), 2);

                        if(!empty(get('divide-by-100'))) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty(get('without-cents'))) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty(get('negative-numbers'))) {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty(get('show-in-red'))) {
                            if(empty(get('negative-numbers'))) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch(get('negative-numbers')) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ',')
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($adjustment->adjustment_date)),
                        'transaction_type' => 'Inventory Qty Adjust',
                        'to_print' => '',
                        'num' => $adjustment->adjustment_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($adjustment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Inventory Qty Adjust',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($adjustment->created_at)),
                        'name_type' => '',
                        'name_id' => '',
                        'name' => '',
                        'customer' => '',
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $adjustment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $adjustment->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                // $purchOrders = $this->expenses_model->get_company_purch_order_transactions($filters);
                // foreach($purchOrders as $purchOrder)
                // {
                //     $categories = $this->expenses_model->get_transaction_categories($purchOrder->id, 'Purchase Order');
                //     $items = $this->expenses_model->get_transaction_items($purchOrder->id, 'Purchase Order');

                //     $totalCount = count($categories) + count($items);

                //     if(count($categories) > 0) {
                //         $account = $this->chart_of_accounts_model->getById($categories[0]->expense_account_id);
                //     } else {
                //         $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);
                //         $account = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                //     }

                //     $transactions[] = [
                //         'date' => date("m/d/Y", strtotime($purchOrder->purchase_order_date)),
                //         'transaction_type' => 'Purchase Order',
                //         'num' => $purchOrder->purchase_order_no,
                //         'created_by' => '',
                //         'last_modified_by' => '',
                //         'due_date' => '',
                //         'last_modified' => date("m/d/Y h:i:s A", strtotime($purchOrder->updated_at)),
                //         'open_balance' => '',
                //         'payment_date' => '',
                //         'method' => 'Purchase Order',
                //         'adj' => '',
                //         'created' => date("m/d/Y h:i:s A", strtotime($purchOrder->created_at)),
                //         'name' => '',
                //         'customer' => '',
                //         'vendor' => '',
                //         'employee' => '',
                //         'product_service' => '',
                //         'memo_description' => $purchOrder->memo,
                //         'qty' => '',
                //         'rate' => '',
                //         'account' => $account->name,
                //         'ar_paid' => '',
                //         'ap_paid' => '',
                //         'clr' => '',
                //         'check_printed' => '',
                //         'debit' => '',
                //         'credit' => '',
                //         'online_banking' => ''
                //     ];
                // }

                $adjustments = $this->starting_value_model->get_by_company_id(logged('company_id'));
                foreach($adjustments as $adjustment)
                {
                    $account = $this->chart_of_accounts_model->getById($adjustment->inv_adj_account);

                    $item = $this->items_model->getItemById($adjustment->item_id)[0];
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                    $where = [
                        'account_id' => $invAssetAcc->id,
                        'transaction_type' => 'Inventory Starting Value',
                        'transaction_id' => $adjustment->id,
                        'is_item_category' => 1,
                        'child_id' => $adjustmentItem->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $rate = floatval(str_replace(',', '', $adjustment->initial_cost));
                    $rate = number_format(floatval($rate), 2);
                    $qty = number_format(floatval($adjustmentItem->initial_qty), 2);

                    if(!empty(get('divide-by-100'))) {
                        $rate = number_format(floatval($rate) / 100, 2);
                        $qty = number_format(floatval($qty) / 100, 2);
                    }

                    if(!empty(get('without-cents'))) {
                        $rate = number_format(floatval($rate), 0);
                        $qty = number_format(floatval($qty), 0);
                    }

                    if(!empty(get('negative-numbers'))) {
                        switch(get('negative-numbers')) {
                            case '(100)' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = '('.$rate.')';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = str_replace('-', '', $qty);
                                    $qty = '('.$qty.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = $rate.'-';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = str_replace('-', '', $qty);
                                    $qty = $qty.'-';
                                }
                            break;
                        }
                    }

                    if(!empty(get('show-in-red'))) {
                        if(empty(get('negative-numbers'))) {
                            if(substr($rate, 0, 1) === '-') {
                                $rate = '<span class="text-danger">'.$rate.'</span>';
                            }

                            if(substr($qty, 0, 1) === '-') {
                                $qty = '<span class="text-danger">'.$qty.'</span>';
                            }
                        } else {
                            switch(get('negative-numbers')) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                        $qty = '<span class="text-danger">'.$qty.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, -1) === '-') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($qty, -1) === '-') {
                                        $qty = '<span class="text-danger">'.$qty.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    if(!empty($accTransacData)) {
                        $subRows = [
                            [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $adjustment->total_amount)), 2, '.', ',')
                            ]
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($adjustment->as_of_date)),
                        'transaction_type' => 'Inventory Starting Value',
                        'to_print' => '',
                        'num' => $adjustment->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($adjustment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Inventory Starting Value',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($adjustment->created_at)),
                        'name_type' => '',
                        'name_id' => '',
                        'name' => '',
                        'customer' => '',
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $adjustment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $adjustment->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $ccPayments = $this->expenses_model->get_company_cc_payment_transactions($filters);
                foreach($ccPayments as $ccPayment)
                {
                    $account = $this->chart_of_accounts_model->getById($ccPayment->bank_account_id);
                    $ccAcc = $this->chart_of_accounts_model->getById($ccPayment->credit_card_id);

                    $employee = $this->users_model->getUser($ccPayment->created_by);
                    $createdBy = $employee->FName . ' ' . $employee->LName;

                    $where = [
                        'account_id' => $ccAcc->id,
                        'transaction_type' => 'CC Payment',
                        'transaction_id' => $ccPayment->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    if(!empty($accTransacData)) {
                        $subRows = [
                            [
                                'account' => $ccAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'vendor' => $name
                            ]
                        ];
                    }

                    $vendor = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
                    $name = $vendor->display_name;

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($ccPayment->date)),
                        'transaction_type' => 'Credit Card Payment',
                        'to_print' => '',
                        'num' => '',
                        'created_by' => $createdBy,
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($ccPayment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Credit Card Payment',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($ccPayment->created_at)),
                        'name_type' => !empty($ccPayment->payee_id) ? 'vendor' : '',
                        'name_id' => $ccPayment->payee_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $ccPayment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $ccPayment->amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $sort = [
                    'column' => !empty(get('column')) ? str_replace('-', '_', get('column')) : 'date',
                    'order' => empty(get('order')) ? 'asc' : 'desc'
                ];

                usort($transactions, function($a, $b) use ($sort) {
                    switch($sort['column']) {
                        case 'date' :
                            if($sort['order'] === 'asc') {
                                if($a['date'] === $b['date']) {
                                    return strtotime($a['created']) > strtotime($b['created']);
                                }
                                return strtotime($a['date']) > strtotime($b['date']);
                            } else {
                                if($a['date'] === $b['date']) {
                                    return strtotime($a['created']) < strtotime($b['created']);
                                }
                                return strtotime($a['date']) < strtotime($b['date']);
                            }
                        break;
                        case 'created' :
                            if($sort['order'] === 'asc') {
                                return strtotime($a['created']) > strtotime($b['created']);
                            } else {
                                return strtotime($a['created']) < strtotime($b['created']);
                            }
                        break;
                        case 'last-modified' :
                            if($sort['order'] === 'asc') {
                                return strtotime($a['last_modified']) > strtotime($b['last_modified']);
                            } else {
                                return strtotime($a['last_modified']) < strtotime($b['last_modified']);
                            }
                        break;
                        default :
                            if($sort['order'] === 'asc') {
                                return strcmp($a[$sort['column']], $a[$sort['column']]);
                            } else {
                                return strcmp($b[$sort['column']], $b[$sort['column']]);
                            }
                        break;
                    }
                });

                $dateFilter = [
                    'start_date' => $this->page_data['start_date'],
                    'end_date' => $this->page_data['end_date']
                ];

                if($this->page_data['filter_date'] !== 'all-dates') {
                    $transactions = array_filter($transactions, function($v, $k) use ($dateFilter) {
                        return strtotime($v['date']) >= strtotime($dateFilter['start_date']) && strtotime($v['date']) <= strtotime($dateFilter['end_date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty(get('transaction-type'))) {
                    $transacType = get('transaction-type');
                    $transactions = array_filter($transactions, function($v, $k) use ($transacType) {
                        switch($transacType) {
                            case 'credit-card-expense' :
                                return $v['transaction_type'] === 'Credit Card Expense';
                            break;
                            case 'check' :
                                return $v['transaction_type'] === 'Check';
                            break;
                            case 'invoice' :
                                return $v['transaction_type'] === 'Invoice';
                            break;
                            case 'payment' :
                                return $v['transaction_type'] === 'Payment';
                            break;
                            case 'journal-entry' :
                                return $v['transaction_type'] === 'Journal Entry';
                            break;
                            case 'bill' :
                                return $v['transaction_type'] === 'Bill';
                            break;
                            case 'credit-card-credit' :
                                return $v['transaction_type'] === 'Credit Card Credit';
                            break;
                            case 'vendor-credit' :
                                return $v['transaction_type'] === 'Vendor Credit';
                            break;
                            case 'bill-payment-check' :
                                return $v['transaction_type'] === 'Bill Payment (Check)';
                            break;
                            case 'bill-payment-credit-card' :
                                return $v['transaction_type'] === 'Bill Payment (Credit Card)';
                            break;
                            case 'transfer' :
                                return $v['transaction_type'] === 'Transfer';
                            break;
                            case 'deposit' :
                                return $v['transaction_type'] === 'Deposit';
                            break;
                            case 'cash-expense' :
                                return $v['transaction_type'] === 'Expense';
                            break;
                            case 'sales-receipt' :
                                return $v['transaction_type'] === 'Sales Receipt';
                            break;
                            case 'credit-memo' :
                                return $v['transaction_type'] === 'Credit Memo';
                            break;
                            case 'refund' :
                                return $v['transaction_type'] === 'Refund';
                            break;
                            case 'inventory-qty-adjust' :
                                return $v['transaction_type'] === 'Inventory Qty Adjust';
                            break;
                            case 'expense' :
                                return $v['transaction_type'] === 'Expense' || $v['transaction_type'] === 'Credit Card Expense';
                            break;
                            case 'inventory-starting-value' :
                                return $v['transaction_type'] === 'Inventory Starting Value';
                            break;
                            case 'credit-card-payment' :
                                return $v['transaction_type'] === 'Credit Card Payment';
                            break;
                        }
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['filter_transaction_type'] = get('transaction-type');
                }

                if(!empty($post['account'])) {
                    $this->page_data['filter_account'] = new stdClass();
                    $this->page_data['filter_account']->id = $post['account'];

                    if(intval($post['account']) > 0) {
                        $account = $this->chart_of_accounts_model->getById($post['account']);
                        $this->page_data['filter_account']->name = $account->name;

                        $filters = [
                            'account_id' => $post['account']
                        ];

                        $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                            return $v['account_id'] === $filters['account_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $names = [
                            'balance-sheet-accounts' => 'All Balance Sheet Accounts',
                            'asset-accounts' => 'All Asset Accounts',
                            'current-asset-accounts' => 'All Current Asset Accounts',
                            'bank-accounts' => 'All Bank Accounts',
                            'accounts-receivable-accounts' => 'All Accounts receivable (A/R) Accounts',
                            'other-current-assets-accounts' => 'All Other Current Assets Accounts',
                            'fixed-assets-accounts' => 'All Fixed Assets Accounts',
                            'other-assets-accounts' => 'All Other Assets Accounts',
                            'liability-accounts' => 'All Liability Accounts',
                            'accounts-payable-accounts' => 'All Accounts payable (A/P) Accounts',
                            'credit-card-accounts' => 'All Credit Card Accounts',
                            'other-current-liabilities-accounts' => 'All Other Current Liabilities Accounts',
                            'long-term-liabilities-accounts' => 'All Long Term Liabilities Accounts',
                            'equity-accounts' => 'All Equity Accounts',
                            'income-expense-accounts' => 'All Income/Expense Accounts',
                            'income-accounts' => 'All Income Accounts',
                            'cost-of-goods-sold-accounts' => 'All Cost of Goods Sold Accounts',
                            'expenses-accounts' => 'All Expenses Accounts',
                            'other-income-accounts' => 'All Other Income Accounts',
                            'other-expense-accounts' => 'All Other Expense Accounts'
                        ];
                        $this->page_data['filter_account']->name = $names[$post['account']];

                        $type = $post['account'];

                        $accounts = array_filter($accounts, function($v, $k) use ($type) {
                            switch($type) {
                                case 'balance-sheet-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false || strpos($v['type'], 'Liabilities') !== false || $v['type'] === 'Equity' || $v['type'] === 'Credit Card';
                                break;
                                case 'asset-account' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false;
                                break;
                                case 'current-asset-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || $v['type'] === 'Other Current Assets';
                                break;
                                case 'bank-accounts' :
                                    return $v['type'] === 'Bank';
                                break;
                                case 'accounts-receivable-accounts' :
                                    return $v['type'] === 'Accounts receivable (A/R)';
                                break;
                                case 'other-current-assets-accounts' :
                                    return $v['type'] === 'Other Current Assets';
                                break;
                                case 'fixed-assets-accounts' :
                                    return $v['type'] === 'Fixed Assets';
                                break;
                                case 'other-assets-accounts' :
                                    return $v['type'] === 'Other Assets';
                                break;
                                case 'liability-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || strpos($v['type'], 'Liabilities') !== false;
                                break;
                                case 'accounts-payable-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'credit-card-accounts' :
                                    return $v['type'] === 'Credit Card';
                                break;
                                case 'other-current-liabilities-accounts' :
                                    return $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'long-term-liabilities-accounts' :
                                    return $v['type'] === 'Long Term Liabilities';
                                break;
                                case 'equity-accounts' :
                                    return $v['type'] === 'Equity';
                                break;
                                case 'income-expense-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold' || strpos($v['type'], 'Income') !== false || strpos($v['type'], 'Expense') !== false;
                                break;
                                case 'income-accounts' :
                                    return $v['type'] === 'Income';
                                break;
                                case 'cost-of-goods-sold-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold';
                                break;
                                case 'expenses-accounts' :
                                    return $v['type'] === 'Expenses';
                                break;
                                case 'other-income-accounts' :
                                    return $v['type'] === 'Other Income';
                                break;
                                case 'other-expense-accounts' :
                                    return $v['type'] === 'Other Expense';
                                break;
                            };
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                }

                if(!empty(get('name'))) {
                    $filterName = explode('-', get('name'));

                    $transactions = array_filter($transactions, function($v, $k) use ($filterName) {
                        return $v['name_type'] === $filterName[0] && $v['name_id'] === $filterName[1];
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['filter_name'] = new stdClass();
                    $this->page_data['filter_name']->id = get('name');

                    switch($filterName[0]) {
                        case 'customer' :
                            $customer = $this->accounting_customers_model->get_by_id($filterName[1]);
                            $this->page_data['filter_name']->name = $customer->first_name . ' ' . $customer->last_name;
                        break;
                        case 'vendor' :
                            $vendor = $this->vendors_model->get_vendor_by_id($filterName[1]);
                            $this->page_data['filter_name']->name = $vendor->display_name;
                        break;
                        case 'employee' :
                            $employee = $this->users_model->getUser($filterName[1]);
                            $this->page_data['filter_name']->name = $employee->FName . ' ' . $employee->LName;
                        break;
                    }
                }

                if(!empty(get('check-printed'))) {
                    $checkPrinted = get('check-printed');

                    $transactions = array_filter($transactions, function($v, $k) use ($checkPrinted) {
                        if($checkPrinted === 'printed') {
                            return $v['to_print'] === null;
                        } else {
                            return $v['to_print'] !== null;
                        }
                    }, ARRAY_FILTER_USE_BOTH);
                    $this->page_data['filter_check_printed'] = get('check-printed');
                }

                if(!empty(get('num'))) {
                    $num = get('num');

                    $transactions = array_filter($transactions, function($v, $k) use ($num) {
                        return $v['num'] === $num;
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['filter_num'] = get('num');
                }

                $this->page_data['transactions'] = $transactions;

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

                    // $index = array_search('Debit', $columns);
                    // if($index === false) {
                    //     $index = array_search('Credit', $columns);
                    // }

                    // if($index === false) {
                    //     $index = array_search('Amount', $columns);
                    // }

                    // if($index === false) {
                    //     $index = array_search('Tax Amount', $columns);
                    // }

                    // if($index === false) {
                    //     $index = array_search('Taxable Amount', $columns);
                    // }

                    // $this->page_data['total_index'] = $index === false ? count($columns) : $index;

                    // $balanceIndex = array_search('Balance', $columns);
                    // if($balanceIndex === false) {
                    //     $balanceIndex = count($columns);
                    // }

                    // $this->page_data['balance_index'] = $balanceIndex;
                }

                if(!empty(get('show-company-name'))) {
                    $this->page_data['show_company_name'] = false;
                }

                if(!empty(get('company-name'))) {
                    $this->page_data['company_name'] = get('company-name');
                }

                $this->page_data['report_title'] = 'Journal';
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
        }

        $this->load->view("accounting/reports/standard_report_pages/$view", $this->page_data);
    }

    private function account_col($transactionId, $transactionType)
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        $totalCount = count($categories) + count($items);

        if ($totalCount > 1) {
            $category = '-Split-';
        } else {
            if ($totalCount === 1) {
                if (count($categories) === 1 && count($items) === 0) {
                    $accountId = $categories[0]->expense_account_id;
                } else {
                    $itemId = $items[0]->item_id;
                    $item = $this->items_model->getByID($itemId);
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($itemId);
                    if($item->type === 'Product' || $item->type === 'product') {
                        $accountId = $itemAccDetails->inv_asset_acc_id;
                    } else {
                        $accountId = $itemAccDetails->expense_account_id;
                    }
                }

                $category = $this->chart_of_accounts_model->getName($accountId);
            }
        }

        return $category;
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
                        'create_date' => date("m/d/Y h:i:s A", strtotime($timeActivity->created_at)),
                        'created_by' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($timeActivity->updated_at)),
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
                        'create_date' => date("m/d/Y h:i:s A", strtotime($timeActivity->created_at)),
                        'created_by' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($timeActivity->updated_at)),
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
            case 'Account List' :
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

                $compAccs = $this->chart_of_accounts_model->get_by_company_id(logged('company_id'));
                $accounts = [];
                foreach($compAccs as $account)
                {
                    $balance = number_format(floatval($account->balance), 2);
                    if(!empty($post['divide-by-100'])) {
                        $balance = number_format(floatval($balance) / 100, 2);
                    }

                    if(!empty($post['without-cents'])) {
                        $balance = number_format(floatval($balance), 0);
                    }

                    if(!empty($post['negative-numbers'])) {
                        switch($post['negative-numbers']) {
                            case '(100)' :
                                if(substr($balance, 0, 1) === '-') {
                                    $balance = str_replace('-', '', $balance);
                                    $balance = '('.$balance.')';
                                }
                            break;
                            case '100-' :
                                if(substr($balance, 0, 1) === '-') {
                                    $balance = str_replace('-', '', $balance);
                                    $balance = $balance.'-';
                                }
                            break;
                        }
                    }

                    if(!empty($post['show-in-red'])) {
                        if(empty($post['negative-numbers'])) {
                            if(substr($balance, 0, 1) === '-') {
                                $balance = '<span class="text-danger">'.$balance.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($balance, 0, 1) === '(' && substr($balance, -1) === ')') {
                                        $balance = '<span class="text-danger">'.$balance.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($balance, -1) === '-') {
                                        $balance = '<span class="text-danger">'.$balance.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $accounts[] = [
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'type' => $this->account_model->getName($account->account_id),
                        'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                        'create_date' => date("m/d/Y h:i:s A", strtotime($account->created_at)),
                        'created_by' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($account->updated_at)),
                        'last_modified_by' => '',
                        'description' => $account->description,
                        'balance' => $balance,
                        'status' => $account->active
                    ];
                }

                if(!empty($post['account'])) {
                    $this->page_data['filter_account'] = new stdClass();
                    $this->page_data['filter_account']->id = $post['account'];

                    if(intval($post['account']) > 0) {
                        $account = $this->chart_of_accounts_model->getById($post['account']);
                        $this->page_data['filter_account']->name = $account->name;

                        $filters = [
                            'account_id' => $post['account']
                        ];

                        $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                            return $v['account_id'] === $filters['account_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $names = [
                            'balance-sheet-accounts' => 'All Balance Sheet Accounts',
                            'asset-accounts' => 'All Asset Accounts',
                            'current-asset-accounts' => 'All Current Asset Accounts',
                            'bank-accounts' => 'All Bank Accounts',
                            'accounts-receivable-accounts' => 'All Accounts receivable (A/R) Accounts',
                            'other-current-assets-accounts' => 'All Other Current Assets Accounts',
                            'fixed-assets-accounts' => 'All Fixed Assets Accounts',
                            'other-assets-accounts' => 'All Other Assets Accounts',
                            'liability-accounts' => 'All Liability Accounts',
                            'accounts-payable-accounts' => 'All Accounts payable (A/P) Accounts',
                            'credit-card-accounts' => 'All Credit Card Accounts',
                            'other-current-liabilities-accounts' => 'All Other Current Liabilities Accounts',
                            'long-term-liabilities-accounts' => 'All Long Term Liabilities Accounts',
                            'equity-accounts' => 'All Equity Accounts',
                            'income-expense-accounts' => 'All Income/Expense Accounts',
                            'income-accounts' => 'All Income Accounts',
                            'cost-of-goods-sold-accounts' => 'All Cost of Goods Sold Accounts',
                            'expenses-accounts' => 'All Expenses Accounts',
                            'other-income-accounts' => 'All Other Income Accounts',
                            'other-expense-accounts' => 'All Other Expense Accounts'
                        ];
                        $this->page_data['filter_account']->name = $names[$post['account']];

                        $type = $post['account'];

                        $accounts = array_filter($accounts, function($v, $k) use ($type) {
                            switch($type) {
                                case 'balance-sheet-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false || strpos($v['type'], 'Liabilities') !== false || $v['type'] === 'Equity' || $v['type'] === 'Credit Card';
                                break;
                                case 'asset-account' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false;
                                break;
                                case 'current-asset-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || $v['type'] === 'Other Current Assets';
                                break;
                                case 'bank-accounts' :
                                    return $v['type'] === 'Bank';
                                break;
                                case 'accounts-receivable-accounts' :
                                    return $v['type'] === 'Accounts receivable (A/R)';
                                break;
                                case 'other-current-assets-accounts' :
                                    return $v['type'] === 'Other Current Assets';
                                break;
                                case 'fixed-assets-accounts' :
                                    return $v['type'] === 'Fixed Assets';
                                break;
                                case 'other-assets-accounts' :
                                    return $v['type'] === 'Other Assets';
                                break;
                                case 'liability-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || strpos($v['type'], 'Liabilities') !== false;
                                break;
                                case 'accounts-payable-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'credit-card-accounts' :
                                    return $v['type'] === 'Credit Card';
                                break;
                                case 'other-current-liabilities-accounts' :
                                    return $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'long-term-liabilities-accounts' :
                                    return $v['type'] === 'Long Term Liabilities';
                                break;
                                case 'equity-accounts' :
                                    return $v['type'] === 'Equity';
                                break;
                                case 'income-expense-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold' || strpos($v['type'], 'Income') !== false || strpos($v['type'], 'Expense') !== false;
                                break;
                                case 'income-accounts' :
                                    return $v['type'] === 'Income';
                                break;
                                case 'cost-of-goods-sold-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold';
                                break;
                                case 'expenses-accounts' :
                                    return $v['type'] === 'Expenses';
                                break;
                                case 'other-income-accounts' :
                                    return $v['type'] === 'Other Income';
                                break;
                                case 'other-expense-accounts' :
                                    return $v['type'] === 'Other Expense';
                                break;
                            };
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                }

                if(!empty($post['create-date'])) {
                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', $post['create-date-from'])),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', $post['create-date-to']))
                    ];

                    $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                        return strtotime($v['create_date']) >= strtotime($filters['start-date']) && strtotime($v['create_date']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['last-modified-date'])) {
                    $filters = [
                        'start-date' => str_replace('-', '/', str_replace('-', '/', $post['last-modified-date-from'])),
                        'end-date' => str_replace('-', '/', str_replace('-', '/', $post['last-modified-date-to']))
                    ];

                    $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                        return strtotime($v['last_modified']) >= strtotime($filters['start-date']) && strtotime($v['last_modified']) <= strtotime($filters['end-date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['deleted'])) {
                    if($post['deleted'] === 'deleted') {
                        $accounts = array_fitler($accounts, function($v, $k) {
                            return empty($v['status']);
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                } else {
                    $accounts = array_filter($accounts, function($v, $k) {
                        return $v['status'] === '1';
                    }, ARRAY_FILTER_USE_BOTH);
                }

                $sort = [
                    'column' => $post['column'] !== 'default' ? str_replace('-', '_', $post['column']) : 'type',
                    'order' => $post['order']
                ];

                usort($accounts, function($a, $b) use ($sort) {
                    if(strpos($sort['column'], 'date') !== false || in_array($sort['column'], ['create_date', 'last_modified'])) {
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

                    $writer->writeSheetRow('Sheet1', $post['fields'], ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);
                    $row += 2;
                    foreach($accounts as $account) {
                        $data = [];

                        $style = [];
                        foreach($post['fields'] as $field) {
                            if($field === 'Balance') {
                                if(stripos($account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], '<span class="text-danger">') !== false) {
                                    $account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('<span class="text-danger">', '', $account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                    $account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('</span>', '', $account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                // if(substr($account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], 0, 1) === '-') {
                                    $style[] = ['color' => '#FF0000'];
                                } else {
                                    $style[] = ['color' => '#000000'];
                                }
                            } else {
                                $style[] = ['color' => '#000000'];
                            }
                            $data[] = $account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))];
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

                    $fileName = str_replace(' ', '_', $companyName).'_Account_List';
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header("Content-Disposition: attachment;filename=Account_List.xlsx");
                    header('Cache-Control: max-age=0');
                    $writer->writeToStdOut();
                } else {
                    $html = '
                        <table style="padding-top:-40px;">
                            <tr>
                                <td style="text-align: '.$headerAlignment.'">';
                                    $html .= empty($post['show-company-name']) ? '<h2 style="margin: 0">'.$companyName.'</h2>' : '';
                                    $html .= empty($post['show-report-title']) ? '<h3 style="margin: 0">'.$reportName.'</h3>' : '';
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

                        foreach($accounts as $account) {
                            $html .= '<tr>';
                            foreach($post['fields'] as $field) {
                                $html .= '<td>'.str_replace('class="text-danger"', 'style="color: red"', $account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]).'</td>';
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

                    $fileName = str_replace(' ', '_', $companyName).'_Account_List';

                    tcpdf();
                    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $title = "Account List";
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
                    $obj_pdf->Output(str_replace(' ', '_', $companyName).'_Account_List.pdf', 'D');
                }
            break;
            case 'General Ledger' :
                $start_date = date("m/01/Y");
                $end_date = date("m/d/Y");
                $report_period = date("F 1-j, Y");
                if(!empty($post['date'])) {
                    $this->page_data['filter_date'] = $post['date'];
                    if($post['date'] !== 'all-dates') {
                        $start_date = str_replace('-', '/', $post['from']);
                        $end_date = str_replace('-', '/', $post['to']);
                    } else {
                        $start_date = null;
                        $start_date = null;
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

                $dateFilter = [
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ];

                $sort = [
                    'column' => !empty($post['column']) ? str_replace('-', '_', $post['column']) : 'date',
                    'order' => empty($post['order']) ? 'asc' : 'desc'
                ];

                $compAccs = $this->chart_of_accounts_model->get_by_company_id(logged('company_id'));
                $accounts = [];
                foreach($compAccs as $account)
                {
                    $transactions = $this->accounting_account_transactions_model->get_account_transactions($account->id);

                    usort($transactions, function($a, $b) {
                        return strtotime($a->transaction_date) < strtotime($b->transaction_date);
                    });

                    $amountTotal = 0.00;
                    $debitTotal = 0.00;
                    $creditTotal = 0.00;
                    $taxAmountTotal = 0.00;
                    $taxableAmountTotal = 0.00;
                    $beginningBalance = floatval(str_replace(',', '', $account->balance));

                    $accTransacs = [];

                    foreach($transactions as $transaction)
                    {
                        $balance = $beginningBalance;
                        if($transaction->type === 'increase') {
                            $beginningBalance -= floatval(str_replace(',', '', $transaction->amount));
                        } else {
                            $beginningBalance += floatval(str_replace(',', '', $transaction->amount));
                        }
                        if(strtotime($transaction->transaction_date) >= strtotime($dateFilter['start_date']) && strtotime($transaction->transaction_date) <= strtotime($dateFilter['end_date'])) {
                            $name = '';
                            $customer = '';
                            $vendor = '';
                            $employee = '';
                            $transacItem = '';
                            $memo = '';
                            $qty = '';
                            $rate = '';
                            $transacAccount = '';
                            $split = '';
                            $openBalance = '';
                            $arPaid = '';
                            $apPaid = '';
                            $checkPrinted = '';
    
                            switch($transaction->transaction_type) {
                                case 'Check' :
                                    $check = $this->vendors_model->get_check_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($check->payment_date));
                                    $num = $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no);
                                    $createDate = date("m/d/Y h:i:s A", strtotime($check->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($check->updated_at));
    
                                    switch($check->payee_type) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                            $name = $payee->display_name;
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($check->payee_id);
                                            $name = $payee->FName . ' ' . $payee->LName;
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($check->bank_account_id);
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($check->id, 'Check');
                                    }
    
                                    if(!is_null($check->check_no)) {
                                        $checkPrinted = 'Printed';
                                    }
                                break;
                                case 'Expense' :
                                    $expense = $this->vendors_model->get_expense_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($expense->payment_date));
                                    $num = $expense->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($expense->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($expense->updated_at));
    
                                    switch($expense->payee_type) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                                            $name = $payee->display_name;
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($expense->payee_id);
                                            $name = $payee->FName . ' ' . $payee->LName;
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($expense->payment_account_id);
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($expense->id, 'Expense');
                                    }
                                break;
                                case 'Bill' :
                                    $bill = $this->vendors_model->get_bill_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($bill->bill_date));
                                    $num = $bill->bill_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($bill->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($bill->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                                    $name = $payee->display_name;
                                    $vendor = $payee->display_name;
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                                        $split = $apAcc->name;
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($bill->id, 'Bill');
    
                                        $openBalance = number_format(floatval(str_replace(',', '', $bill->remaining_balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $bill->remaining_balance)) > 0) {
                                        $apPaid = 'Unpaid';
                                    } else {
                                        $apPaid = 'Paid';
                                    }
                                break;
                                case 'Vendor Credit' :
                                    $vCredit = $this->vendors_model->get_vendor_credit_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($vCredit->payment_date));
                                    $num = $vCredit->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($vCredit->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($vCredit->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
                                    $name = $payee->display_name;
                                    $vendor = $payee->display_name;
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                                        $split = $apAcc->name;
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($vCredit->id, 'Vendor Credit');
    
                                        $openBalance = number_format(floatval(str_replace(',', '', $vCredit->remaining_balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $vCredit->remaining_balance)) > 0) {
                                        $apPaid = 'Unpaid';
                                    } else {
                                        $apPaid = 'Paid';
                                    }
                                break;
                                case 'CC Credit' :
                                    $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($ccCredit->payment_date));
                                    $num = $ccCredit->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($ccCredit->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($ccCredit->updated_at));
    
                                    switch($ccCredit->payee_type) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                            $name = $payee->display_name;
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($ccCredit->payee_id);
                                            $name = $payee->FName . ' ' . $payee->LName;
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($expense->payment_account_id);
    
                                        if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                                            $category = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
    
                                            $payee = $this->accounting_customers_model->get_by_id($category->customer_id);
                                            $name = $payee->first_name . ' ' . $payee->last_name;
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        } else {
                                            $checkItem = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                                            $rate = number_format(floatval(str_replace(',', '', $checkItem->amount)), 2);
                                        }
                                    } else {
                                        $split = $this->account_col($ccCredit->id, 'Credit Card Credit');
                                    }
                                break;
                                case 'Bill Payment' :
                                    $billPayment = $this->vendors_model->get_bill_payment_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($billPayment->payment_date));
                                    $num = $billPayment->to_print_check_no === "1" ? "To print" : ($billPayment->check_no === null ? '' : $billPayment->check_no);
                                    $createDate = date("m/d/Y h:i:s A", strtotime($billPayment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($billPayment->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
                                    $name = $payee->display_name;
                                    $vendor = $payee->display_name;
    
                                    $accountType = $this->account_model->getById($account->account_id);
    
                                    if($accountType->account_name !== 'Accounts payable (A/P)') {
                                        $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                                        $split = $apAcc->name;
                                    } else {
                                        $split = $this->chart_of_accounts_model->getName($billPayment->payment_account_id);
                                    }
    
                                    $apPaid = 'Paid';
    
                                    if(!is_null($billPayment->check_no)) {
                                        $checkPrinted = 'Printed';
                                    }
                                break;
                                case 'Invoice' :
                                    $invoice = $this->invoice_model->getinvoice($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($invoice->date_issued));
                                    $num = $invoice->invoice_number;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($invoice->date_created));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($invoice->date_updated));
    
                                    $payee = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $accountType = $this->account_model->getById($account->account_id);
                                    $invoiceItems = $this->invoice_model->get_invoice_items($invoice->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                                        $split = $arAcc->name;
    
                                        $invoiceItem = $this->invoice_model->get_invoice_item_by_id($transaction->child_id, $invoice->id);
                                        $transacItem = $this->items_model->getItemById($invoiceItem->items_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $invoiceItem->cost)), 2);
                                    } else {
                                        if(count($invoiceItems) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($invoiceItems[0]->items_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($invoiceItems[0]->items_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $itemAcc = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $itemAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
    
                                            $split = $itemAcc->name;
                                        }
    
                                        $openBalance = number_format(floatval(str_replace(',', '', $invoice->balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $invoice->balance)) > 0.00) {
                                        $arPaid = 'Unpaid';
                                    } else {
                                        $arPaid = 'Paid';
                                    }
                                break;
                                case 'Credit Memo' :
                                    $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($creditMemo->credit_memo_date));
                                    $num = $creditMemo->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($creditMemo->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($creditMemo->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Credit Memo', $creditMemo->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                                        $split = $arAcc->name;
    
                                        $creditMemoItem = $this->accounting_credit_memo_model->get_transaction_item_by_id($transaction->child_id);
                                        $transacItem = $this->items_model->getItemById($creditMemoItem->item_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $creditMemoItem->price)), 2);
                                    } else {
                                        if(count($items) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($items[0]->item_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
                    
                                            $split = $account->name;
                                        }
    
                                        $openBalance = '-'.number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2);
                                    }
    
                                    if(floatval(str_replace(',', '', $creditMemo->balance)) > 0.00) {
                                        $arPaid = 'Unpaid';
                                    } else {
                                        $arPaid = 'Paid';
                                    }
                                break;
                                case 'Sales Receipt' :
                                    $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($salesReceipt->sales_receipt_date));
                                    $num = $salesReceipt->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($salesReceipt->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($salesReceipt->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Sales Receipt', $salesReceipt->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($salesReceipt->deposit_to_account);
    
                                        $salesReceiptItem = $this->accounting_credit_memo_model->get_transaction_item_by_id($transaction->child_id);
                                        $transacItem = $this->items_model->getItemById($salesReceiptItem->item_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $salesReceiptItem->price)), 2);
                                    } else {
                                        if(count($items) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($items[0]->item_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
                    
                                            $split = $account->name;
                                        }
                                    }
                                break;
                                case 'Refund Receipt' :
                                    $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($refundReceipt->refund_receipt_date));
                                    $num = $refundReceipt->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($refundReceipt->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($refundReceipt->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Refund Receipt', $refundReceipt->id);
    
                                    if($transaction->is_item_category === '1') {
                                        $split = $this->chart_of_accounts_model->getName($refundReceipt->refund_from_account);
    
                                        $refundReceiptItem = $this->accounting_credit_memo_model->get_transaction_item_by_id($transaction->child_id);
                                        $transacItem = $this->items_model->getItemById($refundReceiptItem->item_id)[0]->title;
    
                                        $rate = number_format(floatval(str_replace(',', '', $refundReceiptItem->price)), 2);
                                    } else {
                                        if(count($items) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $item = $this->items_model->getItemById($items[0]->item_id)[0];
                                            $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);
                    
                                            if($itemAccDetails->income_account_id === null) {
                                                $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                                            } else {
                                                $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                                            }
                    
                                            $split = $account->name;
                                        }
                                    }
                                break;
                                case 'Payment' :
                                    $payment = $this->accounting_receive_payment_model->getReceivePaymentDetails($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($payment->payment_date));
                                    $num = $payment->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($payment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($payment->updated_at));
    
                                    $payee = $this->accounting_customers_model->get_by_id($payment->customer_id);
                                    $name = $payee->first_name . ' ' . $payee->last_name;
                                    $customer = $payee->first_name . ' ' . $payee->last_name;
    
                                    $accountType = $this->account_model->getById($account->account_id);
                                    
                                    if($accountType->account_name !== 'Accounts receivable (A/R)') {
                                        $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                                        $split = $arAcc->name;
                                    } else {
                                        $split = $this->chart_of_accounts_model->getName($payment->deposit_to);
                                    }
    
                                    $arPaid = 'Paid';
                                break;
                                case 'Deposit' :
                                    $deposit = $this->accounting_bank_deposit_model->getById($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($deposit->date));
                                    $createDate = date("m/d/Y h:i:s A", strtotime($deposit->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($deposit->updated_at));
    
                                    $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);
    
                                    if($transaction->is_category === '1') {
                                        $fund = $this->accounting_bank_deposit_model->get_fund($transaction->child_id);
                        
                                        switch($fund->received_from_key) {
                                            case 'vendor':
                                                $payee = $this->vendors_model->get_vendor_by_id($fund->received_from_id);
                                                $vendor = $payee->display_name;
                                            break;
                                            case 'customer':
                                                $payee = $this->accounting_customers_model->get_by_id($fund->received_from_id);
                                                $customer = $payee->first_name . ' ' . $payee->last_name;
                                            break;
                                            case 'employee':
                                                $payee = $this->users_model->getUser($fund->received_from_id);
                                                $employee = $payee->FName . ' ' . $payee->LName;
                                            break;
                                        }
    
                                        $split = $this->chart_of_accounts_model->getName($deposit->account_id);
                                    } else {
                                        if(count($funds) > 1) {
                                            $split = '-Split-';
                                        } else {
                                            $split = $this->chart_of_accounts_model->getName($funds[0]->received_from_account_id);
                                        }
                                    }
                                break;
                                case 'Transfer' :
                                    $transfer = $this->accounting_transfer_funds_model->getById($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($transfer->transfer_date));
                                    $createDate = date("m/d/Y h:i:s A", strtotime($transfer->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($transfer->updated_at));
    
                                    if($account->id === $transfer->transfer_from_account_id) {
                                        $split = $this->chart_of_accounts_model->getById($transfer->transfer_to_account_id);
                                    } else {
                                        $split = $this->chart_of_accounts_model->getById($transfer->transfer_from_account_id);
                                    }
                                break;
                                case 'Journal' :
                                    $journalEntry = $this->accounting_journal_entries_model->getById($transaction->transaction_id, logged('company_id'));
                                    $date = date("m/d/Y", strtotime($journalEntry->journal_date));
                                    $num = $journalEntry->journal_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($journalEntry->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($journalEntry->updated_at));
    
                                    $entries = $this->accounting_journal_entries_model->getEntries($journalEntry->id);
    
                                    foreach($entries as $entry) {
                                        if($entry->id === $transaction->child_id) {
                                            $journalEntryItem = $entry;
                                        }
                                    }
    
                                    switch($journalEntryItem->name_key) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($journalEntryItem->name_id);
                                            $vendor = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($journalEntryItem->name_id);
                                            $customer = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($journalEntryItem->name_id);
                                            $employee = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
    
                                    $split = '-Split-';
                                break;
                                case 'Inventory Qty Adjust' :
                                    $adjustment = $this->accounting_inventory_qty_adjustments_model->get_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($adjustment->adjustment_date));
                                    $num = $adjustment->adjustment_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($adjustment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($adjustment->updated_at));
    
                                    if($account->id !== $adjustment->inventory_adjustment_account_id) {
                                        $split = $this->chart_of_accounts_model->getName($adjustment->inventory_adjustment_account_id);
                                    } else {
                                        
                                    }
                                break;
                                case 'Inventory Starting Value' :
                                    $adjustment = $this->starting_value_model->get_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($adjustment->as_of_date));
                                    $num = $adjustment->ref_no;
                                    $createDate = date("m/d/Y h:i:s A", strtotime($adjustment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($adjustment->updated_at));
    
                                    $rate = number_format(floatval(str_replace(',', '', $adjustment->initial_cost)), 2);
    
                                    $split = $this->chart_of_accounts_model->getName($adjustment->inv_asset_account);
                                break;
                                case 'CC Payment' :
                                    $ccPayment = $this->accounting_pay_down_credit_card_model->get_by_id($transaction->transaction_id);
                                    $date = date("m/d/Y", strtotime($ccPayment->date));
                                    $createDate = date("m/d/Y h:i:s A", strtotime($ccPayment->created_at));
                                    $lastModified = date("m/d/Y h:i:s A", strtotime($ccPayment->updated_at));
    
                                    $payee = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
                                    $name = !is_null($payee) ? $payee->display_name : "";
                                    $vendor = !is_null($payee) ? $payee->display_name : "";
    
                                    $split = $ccPayment->credit_card_id === $account->id ? $this->chart_of_accounts_model->getName($ccPayment->bank_account_id) : $this->chart_of_accounts_model->getName($ccPayment->credit_card_id);
                                break;
                            }
    
                            $debit = $transaction->type === 'increase' ? number_format($transaction->amount, 2) : '';
                            $credit = $transaction->type === 'decrease' ? number_format($transaction->amount, 2) : '';
                            $amount = number_format($transaction->amount, 2);
                            $amount = $transaction->type === 'decrease' ? '-'.$amount : $amount;
    
                            $debitTotal += floatval($debit);
                            $creditTotal += floatval($credit);
                            $amountTotal += floatval($amount);
    
                            if(!empty($post['divide-by-100'])) {
                                $rate = number_format(floatval($rate) / 100, 2);
                                $amount = number_format(floatval($amount) / 100, 2);
                            }
    
                            if(!empty($post['without-cents'])) {
                                $rate = number_format(floatval($rate), 0);
                                $amount = number_format(floatval($amount), 0);
                            }
    
                            if(!empty($post['negative-numbers'])) {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '-') {
                                            $rate = str_replace('-', '', $rate);
                                            $rate = '('.$rate.')';
                                        }
    
                                        if(substr($amount, 0, 1) === '-') {
                                            $amount = str_replace('-', '', $amount);
                                            $amount = '('.$amount.')';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, 0, 1) === '-') {
                                            $rate = str_replace('-', '', $rate);
                                            $rate = $rate.'-';
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
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }
    
                                    if(substr($amount, 0, 1) === '-') {
                                        $amount = '<span class="text-danger">'.$amount.'</span>';
                                    }
                                } else {
                                    switch($post['negative-numbers']) {
                                        case '(100)' :
                                            if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                                $rate = '<span class="text-danger">'.$rate.'</span>';
                                            }
    
                                            if(substr($amount, 0, 1) === '(' && substr($amount, -1) === ')') {
                                                $amount = '<span class="text-danger">'.$amount.'</span>';
                                            }
                                        break;
                                        case '100-' :
                                            if(substr($rate, -1) === '-') {
                                                $rate = '<span class="text-danger">'.$rate.'</span>';
                                            }
    
                                            if(substr($amount, -1) === '-') {
                                                $amount = '<span class="text-danger">'.$amount.'</span>';
                                            }
                                        break;
                                    }
                                }
                            }
    
                            $accTransacs[] = [
                                'date' => $date,
                                'transaction_type' => $transaction->transaction_type,
                                'num' => $num,
                                'adj' => '',
                                'create_date' => $createDate,
                                'created_by' => '', 
                                'last_modified' => $lastModified,
                                'last_modified_by' => '',
                                'name' => $name,
                                'customer' => $customer,
                                'vendor' => $vendor,
                                'employee' => $employee,
                                'product_service' => $transacItem,
                                'memo_description' => $memo,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $account->name,
                                'split' => $split,
                                'invoice_date' => '',
                                'ar_paid' => $arPaid,
                                'ap_paid' => $apPaid,
                                'clr' => '',
                                'check_printed' => $checkPrinted,
                                'debit' => $debit,
                                'credit' => $credit,
                                'open_balance' => $openBalance,
                                'amount' => $amount,
                                'balance' => number_format($balance, 2),
                                'online_banking' => '',
                                'tax_name' => '',
                                'tax_amount' => $taxAmount,
                                'taxable_amount' => $taxableAmount
                            ];
                        }
                    }

                    if($this->page_data['filter_date'] !== 'all-dates') {
                        $accTransacs = array_filter($accTransacs, function($v, $k) use ($dateFilter) {
                            return strtotime($v['date']) >= strtotime($dateFilter['start_date']) && strtotime($v['date']) <= strtotime($dateFilter['end_date']);
                        }, ARRAY_FILTER_USE_BOTH);
                    }

                    usort($accTransacs, function($a, $b) use ($sort) {
                        if($sort['column'] === 'date' || $sort['column'] === 'create-date' || $sort['column'] === 'last-modified') {
                            if($sort['order'] === 'asc') {
                                return strtotime($a[str_replace('-', '_', $sort['column'])]) > strtotime($b[str_replace('-', '_', $sort['column'])]);
                            } else {
                                return strtotime($a[str_replace('-', '_', $sort['column'])]) < strtotime($b[str_replace('-', '_', $sort['column'])]);
                            }
                        } else {
                            if($sort['order'] === 'asc') {
                                return strcmp($a[str_replace('-', '_', $sort['column'])], $b[str_replace('-', '_', $sort['column'])]);
                            } else {
                                return strcmp($b[str_replace('-', '_', $sort['column'])], $a[str_replace('-', '_', $sort['column'])]);
                            }
                        }
                    });

                    $beginningBalance = number_format($beginningBalance, 2);
                    $amountTotal = number_format($amountTotal, 2);
                    $debitTotal = number_format($debitTotal, 2);
                    $creditTotal = number_format($creditTotal, 2);
                    $taxAmountTotal = number_format($taxAmountTotal, 2);
                    $taxableAmountTotal = number_format($taxableAmountTotal, 2);

                    if(!empty($post['divide-by-100'])) {
                        $rate = number_format(floatval($rate) / 100, 2);
                        $beginningBalance = number_format(floatval($beginningBalance) / 100, 2);
                        $amountTotal = number_format(floatval($amountTotal) / 100, 2);
                        $debitTotal = number_format(floatval($debitTotal) / 100, 2);
                        $creditTotal = number_format(floatval($creditTotal) / 100, 2);
                        $taxAmountTotal = number_format(floatval($taxAmountTotal) / 100, 2);
                        $taxableAmountTotal = number_format(floatval($taxableAmountTotal) / 100, 2);
                    }

                    if(!empty($post['without-cents'])) {
                        $rate = number_format(floatval($rate), 0);
                        $beginningBalance = number_format(floatval($beginningBalance), 0);
                        $amountTotal = number_format(floatval($amountTotal), 0);
                        $debitTotal = number_format(floatval($debitTotal), 0);
                        $creditTotal = number_format(floatval($creditTotal), 0);
                        $taxAmountTotal = number_format(floatval($taxAmountTotal), 0);
                        $taxableAmountTotal = number_format(floatval($taxableAmountTotal), 0);
                    }

                    if(!empty($post['negative-numbers'])) {
                        switch($post['negative-numbers']) {
                            case '(100)' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = '('.$rate.')';
                                }

                                if(substr($beginningBalance, 0, 1) === '-') {
                                    $beginningBalance = str_replace('-', '', $beginningBalance);
                                    $beginningBalance = '('.$beginningBalance.')';
                                }

                                if(substr($amountTotal, 0, 1) === '-') {
                                    $amountTotal = str_replace('-', '', $amountTotal);
                                    $amountTotal = '('.$amountTotal.')';
                                }

                                if(substr($debitTotal, 0, 1) === '-') {
                                    $debitTotal = str_replace('-', '', $debitTotal);
                                    $debitTotal = '('.$debitTotal.')';
                                }

                                if(substr($creditTotal, 0, 1) === '-') {
                                    $creditTotal = str_replace('-', '', $creditTotal);
                                    $creditTotal = '('.$creditTotal.')';
                                }

                                if(substr($taxAmountTotal, 0, 1) === '-') {
                                    $taxAmountTotal = str_replace('-', '', $taxAmountTotal);
                                    $taxAmountTotal = '('.$taxAmountTotal.')';
                                }

                                if(substr($taxableAmountTotal, 0, 1) === '-') {
                                    $taxableAmountTotal = str_replace('-', '', $taxableAmountTotal);
                                    $taxableAmountTotal = '('.$taxableAmountTotal.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = $rate.'-';
                                }

                                if(substr($beginningBalance, 0, 1) === '-') {
                                    $beginningBalance = str_replace('-', '', $beginningBalance);
                                    $beginningBalance = $beginningBalance.'-';
                                }

                                if(substr($amountTotal, 0, 1) === '-') {
                                    $amountTotal = str_replace('-', '', $amountTotal);
                                    $amountTotal = $amountTotal.'-';
                                }

                                if(substr($debitTotal, 0, 1) === '-') {
                                    $debitTotal = str_replace('-', '', $debitTotal);
                                    $debitTotal = $debitTotal.'-';
                                }

                                if(substr($creditTotal, 0, 1) === '-') {
                                    $creditTotal = str_replace('-', '', $creditTotal);
                                    $creditTotal = $creditTotal.'-';
                                }

                                if(substr($taxAmountTotal, 0, 1) === '-') {
                                    $taxAmountTotal = str_replace('-', '', $taxAmountTotal);
                                    $taxAmountTotal = $taxAmountTotal.'-';
                                }

                                if(substr($taxableAmountTotal, 0, 1) === '-') {
                                    $taxableAmountTotal = str_replace('-', '', $taxableAmountTotal);
                                    $taxableAmountTotal = $taxableAmountTotal.'-';
                                }
                            break;
                        }
                    }

                    if(!empty($post['show-in-red'])) {
                        if(empty($post['negative-numbers'])) {
                            if(substr($rate, 0, 1) === '-') {
                                $rate = '<span class="text-danger">'.$rate.'</span>';
                            }

                            if(substr($beginningBalance, 0, 1) === '-') {
                                $beginningBalance = '<span class="text-danger">'.$beginningBalance.'</span>';
                            }

                            if(substr($amountTotal, 0, 1) === '-') {
                                $amountTotal = '<span class="text-danger">'.$amountTotal.'</span>';
                            }

                            if(substr($debitTotal, 0, 1) === '-') {
                                $debitTotal = '<span class="text-danger">'.$debitTotal.'</span>';
                            }

                            if(substr($creditTotal, 0, 1) === '-') {
                                $creditTotal = '<span class="text-danger">'.$creditTotal.'</span>';
                            }

                            if(substr($taxAmountTotal, 0, 1) === '-') {
                                $taxAmountTotal = '<span class="text-danger">'.$taxAmountTotal.'</span>';
                            }

                            if(substr($taxableAmountTotal, 0, 1) === '-') {
                                $taxableAmountTotal = '<span class="text-danger">'.$taxableAmountTotal.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($beginningBalance, 0, 1) === '(' && substr($beginningBalance, -1) === ')') {
                                        $beginningBalance = '<span class="text-danger">'.$beginningBalance.'</span>';
                                    }

                                    if(substr($amountTotal, 0, 1) === '(' && substr($amountTotal, -1) === ')') {
                                        $amountTotal = '<span class="text-danger">'.$amountTotal.'</span>';
                                    }

                                    if(substr($debitTotal, 0, 1) === '(' && substr($debitTotal, -1) === ')') {
                                        $debitTotal = '<span class="text-danger">'.$debitTotal.'</span>';
                                    }

                                    if(substr($creditTotal, 0, 1) === '(' && substr($creditTotal, -1) === ')') {
                                        $creditTotal = '<span class="text-danger">'.$creditTotal.'</span>';
                                    }

                                    if(substr($taxAmountTotal, 0, 1) === '(' && substr($taxAmountTotal, -1) === ')') {
                                        $taxAmountTotal = '<span class="text-danger">'.$taxAmountTotal.'</span>';
                                    }

                                    if(substr($taxableAmountTotal, 0, 1) === '(' && substr($taxableAmountTotal, -1) === ')') {
                                        $taxableAmountTotal = '<span class="text-danger">'.$taxableAmountTotal.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, -1) === '-') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($beginningBalance, -1) === '-') {
                                        $beginningBalance = '<span class="text-danger">'.$beginningBalance.'</span>';
                                    }

                                    if(substr($amountTotal, -1) === '-') {
                                        $amountTotal = '<span class="text-danger">'.$amountTotal.'</span>';
                                    }

                                    if(substr($debitTotal, -1) === '-') {
                                        $debitTotal = '<span class="text-danger">'.$debitTotal.'</span>';
                                    }

                                    if(substr($creditTotal, -1) === '-') {
                                        $creditTotal = '<span class="text-danger">'.$creditTotal.'</span>';
                                    }

                                    if(substr($taxAmountTotal, -1) === '-') {
                                        $taxAmountTotal = '<span class="text-danger">'.$taxAmountTotal.'</span>';
                                    }

                                    if(substr($taxableAmountTotal, -1) === '-') {
                                        $taxableAmountTotal = '<span class="text-danger">'.$taxableAmountTotal.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $accounts[] = [
                        'account_id' => $account->id,
                        'type' => $this->account_model->getName($account->account_id),
                        'name' => $account->name,
                        'debit_total' => $debitTotal,
                        'credit_total' => $creditTotal,
                        'amount_total' => $amountTotal,
                        'tax_amount_total' => $taxAmountTotal,
                        'taxable_amount_total' => $taxableAmountTotal,
                        'beginning_balance' => $beginningBalance,
                        'transactions' => $accTransacs
                    ];
                }

                if(!empty($post['distribution-account'])) {
                    if(intval($post['distribution-account']) > 0) {
                        $account = $this->chart_of_accounts_model->getById($post['distribution-account']);

                        $filters = [
                            'account_id' => $post['distribution-account']
                        ];

                        $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                            return $v['account_id'] === $filters['account_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $names = [
                            'balance-sheet-accounts' => 'All Balance Sheet Accounts',
                            'asset-accounts' => 'All Asset Accounts',
                            'current-asset-accounts' => 'All Current Asset Accounts',
                            'bank-accounts' => 'All Bank Accounts',
                            'accounts-receivable-accounts' => 'All Accounts receivable (A/R) Accounts',
                            'other-current-assets-accounts' => 'All Other Current Assets Accounts',
                            'fixed-assets-accounts' => 'All Fixed Assets Accounts',
                            'other-assets-accounts' => 'All Other Assets Accounts',
                            'liability-accounts' => 'All Liability Accounts',
                            'accounts-payable-accounts' => 'All Accounts payable (A/P) Accounts',
                            'credit-card-accounts' => 'All Credit Card Accounts',
                            'other-current-liabilities-accounts' => 'All Other Current Liabilities Accounts',
                            'long-term-liabilities-accounts' => 'All Long Term Liabilities Accounts',
                            'equity-accounts' => 'All Equity Accounts',
                            'income-expense-accounts' => 'All Income/Expense Accounts',
                            'income-accounts' => 'All Income Accounts',
                            'cost-of-goods-sold-accounts' => 'All Cost of Goods Sold Accounts',
                            'expenses-accounts' => 'All Expenses Accounts',
                            'other-income-accounts' => 'All Other Income Accounts',
                            'other-expense-accounts' => 'All Other Expense Accounts'
                        ];
                        $type = $post['distribution-account'];

                        $accounts = array_filter($accounts, function($v, $k) use ($type) {
                            switch($type) {
                                case 'balance-sheet-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false || strpos($v['type'], 'Liabilities') !== false || $v['type'] === 'Equity' || $v['type'] === 'Credit Card';
                                break;
                                case 'asset-account' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false;
                                break;
                                case 'current-asset-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || $v['type'] === 'Other Current Assets';
                                break;
                                case 'bank-accounts' :
                                    return $v['type'] === 'Bank';
                                break;
                                case 'accounts-receivable-accounts' :
                                    return $v['type'] === 'Accounts receivable (A/R)';
                                break;
                                case 'other-current-assets-accounts' :
                                    return $v['type'] === 'Other Current Assets';
                                break;
                                case 'fixed-assets-accounts' :
                                    return $v['type'] === 'Fixed Assets';
                                break;
                                case 'other-assets-accounts' :
                                    return $v['type'] === 'Other Assets';
                                break;
                                case 'liability-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || strpos($v['type'], 'Liabilities') !== false;
                                break;
                                case 'accounts-payable-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'credit-card-accounts' :
                                    return $v['type'] === 'Credit Card';
                                break;
                                case 'other-current-liabilities-accounts' :
                                    return $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'long-term-liabilities-accounts' :
                                    return $v['type'] === 'Long Term Liabilities';
                                break;
                                case 'equity-accounts' :
                                    return $v['type'] === 'Equity';
                                break;
                                case 'income-expense-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold' || strpos($v['type'], 'Income') !== false || strpos($v['type'], 'Expense') !== false;
                                break;
                                case 'income-accounts' :
                                    return $v['type'] === 'Income';
                                break;
                                case 'cost-of-goods-sold-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold';
                                break;
                                case 'expenses-accounts' :
                                    return $v['type'] === 'Expenses';
                                break;
                                case 'other-income-accounts' :
                                    return $v['type'] === 'Other Income';
                                break;
                                case 'other-expense-accounts' :
                                    return $v['type'] === 'Other Expense';
                                break;
                            };
                        }, ARRAY_FILTER_USE_BOTH);
                    }
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
                    if(empty($post['show-report-period'])) {
                        $writer->writeSheetRow('Sheet1', [$report_period], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row++;
                    }

                    $writer->writeSheetRow('Sheet1', $post['fields'], ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);
                    $row += 2;

                    foreach($accounts as $account) {
                        $rowHead = [];
                        $balanceRow = [];
                        $totalRow = [];

                        foreach($post['fields'] as $index => $field)
                        {
                            $rowHead[$index] = '';
                            $balanceRow[$index] = '';
                            $totalRow[$index] = '';

                            if($index === 0) {
                                $rowHead[$index] = $account['name'];
                                $balanceRow[$index] = 'Beginning Balance';
                                $totalRow[$index] = 'Total for '.$account['name'];
                            }

                            if($field === 'Balance') {
                                $balanceRow[$index] = $account['beginning_balance'];
                            }

                            if($field === 'Debit') {
                                $rowHead[$index] = $account['debit_total'];
                                $totalRow[$index] = $account['debit_total'];
                            }

                            if($field === 'Credit') {
                                $rowHead[$index] = $account['credit_total'];
                                $totalRow[$index] = $account['credit_total'];
                            }

                            if($field === 'Amount') {
                                $rowHead[$index] = $account['amount_total'];
                                $totalRow[$index] = $account['amount_total'];
                            }

                            if($field === 'Tax Amount') {
                                $rowHead[$index] = $account['tax_amount_total'];
                                $totalRow[$index] = $account['tax_amount_total'];
                            }

                            if($field === 'Taxable Amount') {
                                $rowHead[$index] = $account['taxable_amount_total'];
                                $totalRow[$index] = $account['taxable_amount_total'];
                            }
                        }

                        $writer->writeSheetRow('Sheet1', $rowHead, ['font-style' => 'bold']);
                        $row++;
                        $writer->writeSheetRow('Sheet1', $balanceRow, ['font-style' => 'bold']);
                        $row++;

                        foreach($account['transactions'] as $transaction)
                        {
                            $data = [];
                            $style = [];

                            foreach($post['fields'] as $field)
                            {
                                if(stripos($transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], '<span class="text-danger">') !== false) {
                                    $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('<span class="text-danger">', '', $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                    $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('</span>', '', $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                    $style[] = ['color' => '#FF0000'];
                                } else {
                                    $style[] = ['color' => '#000000'];
                                }

                                $data[] = $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))];
                            }

                            $writer->writeSheetRow('Sheet1', $data, $style);
                            $row++;
                        }

                        $writer->writeSheetRow('Sheet1', $totalRow, ['font-style' => 'bold', 'border' => 'top,bottom']);
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

                    $footerText = $post['accounting_method'] === 'cash' ? 'Cash basis ' : 'Accrual basis ';
                    $footerText .= $date;

                    $writer->writeSheetRow('Sheet1', [$footerText], ['halign' => $footerAlignment, 'valign' => 'center']);
                    $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);

                    $fileName = str_replace(' ', '_', $companyName).'_General_Ledger';
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header("Content-Disposition: attachment;filename=General_Ledger.xlsx");
                    header('Cache-Control: max-age=0');
                    $writer->writeToStdOut();
                } else {
                    $html = '
                        <table style="padding-top:-40px;">
                            <tr>
                                <td style="text-align: '.$headerAlignment.'">';
                                    $html .= empty($post['show-company-name']) ? '<h2 style="margin: 0">'.$companyName.'</h2>' : '';
                                    $html .= empty($post['show-report-title']) ? '<h3 style="margin: 0">'.$reportName.'</h3>' : '';
                                    $html .= empty($post['show-report-period']) ? '<h4 style="margin: 0">'.$report_period.'</h4>' : '';
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

                        foreach($accounts as $account)
                        {
                            $html .= '<tr>
                                <td colspan="'.count($post['fields']).'"><b>'.$account['name'].'</b></td>
                            </tr>';

                            $balanceIndex = array_search('Balance', $post['fields']);
                            if($balanceIndex === false) {
                                $balanceIndex = count($post['fields']);
                            }

                            $html .= '<tr>
                                <td colspan="'.$balanceIndex.'">Beginning Balance</td>';

                            foreach($post['fields'] as $index => $field)
                            {
                                if($index > $balanceIndex - 1) {
                                    $value = $field === 'Balance' ? $account['beginning_balance'] : '';
                                    $html .= '<td>'.$value.'</td>';
                                }
                            }

                            $html .= '</tr>';

                            foreach($account['transactions'] as $transaction)
                            {
                                $html .= '<tr>';
                                foreach($post['fields'] as $field) {
                                    $html .= '<td>'.str_replace('class="text-danger"', 'style="color: red"', $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]).'</td>';
                                }
                                $html .= '</tr>';
                            }

                            $count = array_search('Debit', $post['fields']);
                            if($count === false) {
                                $count = array_search('Credit', $post['fields']);
                            }
                            if($count === false) {
                                $count = array_search('Amount', $post['fields']);
                            }
                            if($count === false) {
                                $count = array_search('Tax Amount', $post['fields']);
                            }
                            if($count === false) {
                                $count = array_search('Taxable Amount', $post['fields']);
                            }
                            if($count === false) {
                                $count = count($post['fields']);
                            }

                            $total = '<td style="border-top: 1px solid black; border-bottom: 1px solid black" colspan="'.$count.'"><b>Total for '.$account['name'].'</b></td>';
                            foreach($post['fields'] as $index => $field)
                            {
                                if($index > $count - 1) {
                                    $value = $field === 'Debit' || $field === 'Credit' || $field === 'Amount' || $field === 'Tax Amount' || $field === 'Taxable Amount' ? $account[strtolower(str_replace(' ', '_', str_replace('/', '_', $field))).'_total'] : '';
                                    $total .= '<td style="border-top: 1px solid black; border-bottom: 1px solid black"><b>'.$value.'</b></td>';
                                }
                            }

                            $html .= '<tr>';
                            $html .= $total;
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

                    $footerText = $post['accounting_method'] === 'cash' ? 'Cash basis ' : 'Accrual basis ';
                    $footerText .= $date;
                    $html .= '<tr style="text-align: '.$footerAlignment.'">
                                <td colspan="'.count($post['fields']).'">
                                    <p style="margin: 0">'.$footerText.'</p>
                                </td>
                            </tr>
                        </tfoot>
                    </table>';

                    $fileName = str_replace(' ', '_', $companyName).'_General_Ledger';

                    tcpdf();
                    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $title = "General Ledger";
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
                    $obj_pdf->Output(str_replace(' ', '_', $companyName).'_General_Ledger.pdf', 'D');
                }
            break;
// 123
            case 'Journal' :
                $start_date = date("m/01/Y");
                $end_date = date("m/d/Y");
                $report_period = date("F 1-j, Y");
                if(!empty($post['date'])) {
                    $this->page_data['filter_date'] = $post['date'];
                    if($post['date'] !== 'all-dates') {
                        $start_date = str_replace('-', '/', $post['from']);
                        $end_date = str_replace('-', '/', $post['to']);
                    } else {
                        $start_date = null;
                        $start_date = null;
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

                $transactions = [];

                $invoices = $this->invoice_model->get_all_company_invoice(logged('company_id'));
                foreach($invoices as $invoice)
                {
                    $employee = $this->users_model->getUser($invoice->user_id);
                    $createdBy = $employee->FName . ' ' . $employee->LName;

                    $customer = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $payments = $this->invoice_model->getPayments($invoice->invoice_number);

                    usort($payments, function($a, $b) {
                        return strtotime($a->payment_date) < strtotime($b->payment_date);
                    });

                    $invoiceItems = $this->invoice_model->get_invoice_items($invoice->id);
                    $subRows = [];
                    foreach($invoiceItems as $invoiceItem)
                    {
                        $item = $this->items_model->getItemById($invoiceItem->items_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $invoiceItem->cost));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($invoiceItem->qty);
                        $rate = number_format(floatval($rate), 2);

                        $qty = '-'.number_format(floatval($invoiceItem->qty), 2);
                        $expenseQty = number_format(floatval($invoiceItem->qty), 2);

                        if(!empty($post['divide-by-100'])) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Invoice',
                            'transaction_id' => $invoice->id,
                            'is_item_category' => 1,
                            'child_id' => $invoiceItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Invoice',
                            'transaction_id' => $invoice->id,
                            'is_item_category' => 1,
                            'child_id' => $invoiceItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ',')
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Invoice',
                            'transaction_id' => $invoice->id,
                            'is_item_category' => 1,
                            'child_id' => $invoiceItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'ar_paid' => floatval(str_replace(',', '', $invoice->balance)) > 0.00 ? 'Unpaid' : 'Paid'
                            ];
                        }
                    }

                    $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                        'transaction_type' => 'Invoice',
                        'to_print' => '',
                        'num' => $invoice->invoice_number,
                        'created_by' => $createdBy,
                        'last_modified_by' => '',
                        'due_date' => date("m/d/Y", strtotime($invoice->due_date)),
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($invoice->date_updated)),
                        'open_balance' => number_format(floatval(str_replace(',', '', $invoice->balance)), 2, '.', ','),
                        'payment_date' => date("m/d/Y", strtotime($payments[0]->payment_date)),
                        'method' => 'Invoice',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($invoice->date_created)),
                        'name_type' => 'customer',
                        'name_id' => $invoice->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $invoice->message_to_customer,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $arAcc->id,
                        'account' => $arAcc->name,
                        'ar_paid' => floatval(str_replace(',', '', $invoice->balance)) > 0.00 ? 'Unpaid' : 'Paid',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $invoice->grand_total)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $filters = [
                    'company_id' => logged('company_id'),
                    'start-date' => date("Y-m-d", strtotime($start_date)),
                    'end-date' => date("Y-m-d", strtotime($end_date))
                ];
                $expenses = $this->expenses_model->get_company_expense_transactions($filters);
                foreach($expenses as $expense)
                {
                    $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
                    $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

                    $type = $paymentAccType->account_name === 'Credit Card' ? 'Credit Card Expense' : 'Expense';

                    switch($expense->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($expense->payee_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
                    $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Expense',
                            'transaction_id' => $expense->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $expenseItem)
                    {
                        $item = $this->items_model->getItemById($expenseItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Expense',
                            'transaction_id' => $expense->id,
                            'is_item_category' => 1,
                            'child_id' => $expenseItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $expenseItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($expenseItem->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($expense->payment_date)),
                        'transaction_type' => $type,
                        'to_print' => '',
                        'num' => $expense->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($expense->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => $type,
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($expense->created_at)),
                        'name_type' => $expense->payee_type,
                        'name_id' => $expense->payee_id,
                        'name' => $name,
                        'customer' => $expense->payee_type === 'customer' ? $name : '',
                        'vendor' => $expense->payee_type === 'vendor' ? $name : '',
                        'employee' => $expense->payee_type === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $expense->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $paymentAcc->id,
                        'account' => $paymentAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $expense->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $checks = $this->expenses_model->get_company_check_transactions($filters);
                foreach($checks as $check)
                {
                    $bankAcc = $this->chart_of_accounts_model->getById($check->bank_account_id);
                    switch($check->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($check->payee_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $categories = $this->expenses_model->get_transaction_categories($check->id, 'Check');
                    $items = $this->expenses_model->get_transaction_items($check->id, 'Check');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Check',
                            'transaction_id' => $check->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $checkItem)
                    {
                        $item = $this->items_model->getItemById($checkItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Check',
                            'transaction_id' => $check->id,
                            'is_item_category' => 1,
                            'child_id' => $checkItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $checkItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($checkItem->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($check->payment_date)),
                        'transaction_type' => 'Check',
                        'to_print' => $check->to_print,
                        'num' => $check->check_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($check->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Check',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($check->created_at)),
                        'name_type' => $check->payee_type,
                        'name_id' => $check->payee_id,
                        'name' => $name,
                        'customer' => $check->payee_type === 'customer' ? $name : '',
                        'vendor' => $check->payee_type === 'vendor' ? $name : '',
                        'employee' => $check->payee_type === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $check->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $bankAcc->id,
                        'account' => $bankAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $check->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $payments = $this->accounting_receive_payment_model->get_payments_by_company_id($filters['company_id']);
                foreach($payments as $payment)
                {
                    $depositToAcc = $this->chart_of_accounts_model->getById($payment->deposit_to);

                    $customer = $this->accounting_customers_model->get_by_id($payment->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));
                    $where = [
                        'account_id' => $arAcc->id,
                        'transaction_type' => 'Payment',
                        'transaction_id' => $payment->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $subRows = [
                        [
                            'account' => $arAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $name,
                            'payment_date' => date("m/d/Y", strtotime($payment->payment_date)),
                            'ar_paid' => 'Paid'
                        ]
                    ];

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($payment->payment_date)),
                        'transaction_type' => 'Payment',
                        'to_print' => '',
                        'num' => $payment->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($payment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Payment',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($payment->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $payment->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $payment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $depositToAcc->id,
                        'account' => $depositToAcc->name,
                        'ar_paid' => 'Paid',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $payment->amount_received)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $journalEntries = $this->accounting_journal_entries_model->get_company_journal_entries($filters);
                foreach($journalEntries as $journalEntry)
                {
                    $employee = $this->users_model->getUser($journalEntry->created_by);
                    $createdBy = $employee->FName . ' ' . $employee->LName;

                    $entries = $this->accounting_journal_entries_model->getEntries($journalEntry->id);

                    switch($entries[0]->name_key) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($entries[0]->name_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($entries[0]->name_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($entries[0]->name_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $account = $this->chart_of_accounts_model->getById($entries[0]->account_id);

                    $subRows = [];
                    foreach($entries as $index => $entry)
                    {
                        if($index > 0) {
                            $entryAcc = $this->chart_of_accounts_model->getById($entry->account_id);

                            switch($entry->name_key) {
                                case 'vendor':
                                    $vendor = $this->vendors_model->get_vendor_by_id($entry->name_id);
                                    $name = $vendor->display_name;
                                break;
                                case 'customer':
                                    $customer = $this->accounting_customers_model->get_by_id($entry->name_id);
                                    $name = $customer->first_name . ' ' . $customer->last_name;
                                break;
                                case 'employee':
                                    $employee = $this->users_model->getUser($entry->name_id);
                                    $name = $employee->FName . ' ' . $employee->LName;
                                break;
                            }

                            $subRows[] = [
                                'account' => $entryAcc->name,
                                'customer' => $entry->name_key === 'customer' ? $name : '',
                                'vendor' => $entry->name_key === 'vendor' ? $name : '',
                                'employee' => $entry->name_key === 'employee' ? $name : '',
                                'debit' => !empty($entry->debit) ? number_format(floatval(str_replace(',', '', $entry->debit)), 2, '.', ',') : '',
                                'credit' => !empty($entry->credit) ? number_format(floatval(str_replace(',', '', $entry->credit)), 2, '.', ',') : ''
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($journalEntry->journal_date)),
                        'transaction_type' => 'Journal Entry',
                        'to_print' => '',
                        'num' => $journalEntry->journal_no,
                        'created_by' => $createdBy,
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($journalEntry->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Journal Entry',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($journalEntry->created_at)),
                        'name_type' => $entries[0]->name_key,
                        'name_id' => $entries[0]->name_id,
                        'name' => $name,
                        'customer' => $entries[0]->name_key === 'customer' ? $name : '',
                        'vendor' => $entries[0]->name_key === 'vendor' ? $name : '',
                        'employee' => $entries[0]->name_key === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $entries[0]->description,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => !empty($entries[0]->debit) ? number_format(floatval(str_replace(',', '', $entries[0]->debit)), 2, '.', ',') : '',
                        'credit' => !empty($entries[0]->credit) ? number_format(floatval(str_replace(',', '', $entries[0]->credit)), 2, '.', ',') : '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $bills = $this->expenses_model->get_company_bill_transactions($filters);
                foreach($bills as $bill)
                {
                    $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                    $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                    $name = $payee->display_name;

                    $categories = $this->expenses_model->get_transaction_categories($bill->id, 'Bill');
                    $items = $this->expenses_model->get_transaction_items($bill->id, 'Bill');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Bill',
                            'transaction_id' => $bill->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $billItem)
                    {
                        $item = $this->items_model->getItemById($billItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Bill',
                            'transaction_id' => $bill->id,
                            'is_item_category' => 1,
                            'child_id' => $billItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $billItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($billItem->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($bill->bill_date)),
                        'transaction_type' => 'Bill',
                        'to_print' => '',
                        'num' => $bill->bill_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($bill->updated_at)),
                        'open_balance' => number_format(floatval(str_replace(',', '', $bill->remaining_balance)), 2, '.', ','),
                        'payment_date' => '',
                        'method' => 'Bill',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($bill->created_at)),
                        'name_type' => 'vendor',
                        'name_id' => $bill->vendor_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $bill->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $apAcc->id,
                        'account' => $apAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $bill->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $ccCredits = $this->expenses_model->get_company_cc_credit_transactions($filters);
                foreach($ccCredits as $ccCredit)
                {
                    $account = $this->chart_of_accounts_model->getById($ccCredit->bank_credit_account_id);

                    switch($ccCredit->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                            $name = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                            $name = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($ccCredit->payee_id);
                            $name = $payee->FName . ' ' . $payee->LName;
                        break;
                    }

                    $categories = $this->expenses_model->get_transaction_categories($ccCredit->id, 'Credit Card Credit');
                    $items = $this->expenses_model->get_transaction_items($ccCredit->id, 'Credit Card Credit');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'CC Credit',
                            'transaction_id' => $ccCredit->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $ccCreditItem)
                    {
                        $item = $this->items_model->getItemById($ccCreditItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'CC Credit',
                            'transaction_id' => $ccCredit->id,
                            'is_item_category' => 1,
                            'child_id' => $ccCreditItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $ccCreditItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($ccCreditItem->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                        'transaction_type' => 'Credit Card Credit',
                        'to_print' => '',
                        'num' => $ccCredit->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($ccCredit->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Credit Card Credit',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($ccCredit->created_at)),
                        'name_type' => $ccCredit->payee_type,
                        'name_id' => $ccCredit->payee_id,
                        'name' => $name,
                        'customer' => $ccCredit->payee_type === 'customer' ? $name : '',
                        'vendor' => $ccCredit->payee_type === 'vendor' ? $name : '',
                        'employee' => $ccCredit->payee_type === 'employee' ? $name : '',
                        'product_service' => '',
                        'memo_description' => $ccCredit->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $ccCredit->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $vendorCredits = $this->expenses_model->get_company_vendor_credit_transactions($filters);
                foreach($vendorCredits as $vCredit)
                {
                    $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));

                    $payee = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
                    $name = $payee->display_name;

                    $categories = $this->expenses_model->get_transaction_categories($vCredit->id, 'Vendor Credit');
                    $items = $this->expenses_model->get_transaction_items($vCredit->id, 'Vendor Credit');

                    $subRows = [];
                    foreach($categories as $category)
                    {
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                        $customer = '';
                        if(!empty($category->customer_id)) {
                            $customer = $this->accounting_customers_model->get_by_id($category->customer_id);
                            $customer = $customer->first_name . ' ' . $customer->last_name;
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Vendor Credit',
                            'transaction_id' => $vCredit->id,
                            'is_category' => 1,
                            'child_id' => $category->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $subRows[] = [
                            'account' => $expenseAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer
                        ];
                    }

                    foreach($items as $vCreditItem)
                    {
                        $item = $this->items_model->getItemById($vCreditItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Vendor Credit',
                            'transaction_id' => $vCredit->id,
                            'is_item_category' => 1,
                            'child_id' => $vCreditItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $vCreditItem->rate));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($vCreditItem->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $subRows[] = [
                            'product_service' => $item->title,
                            'qty' => $qty,
                            'rate' => $rate,
                            'account' => $invAssetAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ];
                    }

                    $openBalance = '-'.number_format(floatval(str_replace(',', '', $vCredit->remaining_balance)), 2, '.', ',');

                    if(!empty($post['divide-by-100'])) {
                        $openBalance = number_format(floatval($openBalance) / 100, 2);
                    }

                    if(!empty($post['without-cents'])) {
                        $openBalance = number_format(floatval($openBalance), 0);
                    }

                    if(!empty($post['negative-numbers'])) {
                        switch($post['negative-numbers']) {
                            case '(100)' :
                                if(substr($openBalance, 0, 1) === '-') {
                                    $openBalance = str_replace('-', '', $openBalance);
                                    $openBalance = '('.$openBalance.')';
                                }
                            break;
                            case '100-' :
                                if(substr($openBalance, 0, 1) === '-') {
                                    $openBalance = str_replace('-', '', $openBalance);
                                    $openBalance = $openBalance.'-';
                                }
                            break;
                        }
                    }

                    if(!empty($post['show-in-red'])) {
                        if(empty($post['negative-numbers'])) {
                            if(substr($openBalance, 0, 1) === '-') {
                                $openBalance = '<span class="text-danger">'.$openBalance.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($openBalance, 0, 1) === '(' && substr($openBalance, -1) === ')') {
                                        $openBalance = '<span class="text-danger">'.$openBalance.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($openBalance, -1) === '-') {
                                        $openBalance = '<span class="text-danger">'.$openBalance.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                        'transaction_type' => 'Vendor Credit',
                        'to_print' => '',
                        'num' => $vCredit->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($vCredit->updated_at)),
                        'open_balance' => $openBalance,
                        'payment_date' => '',
                        'method' => 'Vendor Credit',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($vCredit->created_at)),
                        'name_type' => 'vendor',
                        'name_id' => $vCredit->vendor_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $vCredit->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $apAcc->id,
                        'account' => $apAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $vCredit->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $billPayments = $this->expenses_model->get_company_bill_payment_items($filters);
                foreach($billPayments as $billPayment)
                {
                    $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
                    $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

                    $type = $paymentAccType->account_name === 'Credit Card' ? 'Bill Payment (Credit Card)' : 'Bill Payment (Check)';

                    $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
                    $name = $payee->display_name;

                    $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));
                    $where = [
                        'account_id' => $apAcc->id,
                        'transaction_type' => 'Bill Payment',
                        'transaction_id' => $billPayment->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $subRows = [
                        [
                            'account' => $apAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'vendor' => $name,
                            'payment_date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                            'ap_paid' => 'Paid'
                        ]
                    ];

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                        'transaction_type' => $type,
                        'to_print' => $billPayment->to_print_check_no,
                        'num' => $billPayment->check_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($billPayment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => $type,
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($billPayment->created_at)),
                        'name_type' => 'vendor',
                        'name_id' => $billPayment->payee_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $billPayment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $paymentAcc->id,
                        'account' => $paymentAcc->name,
                        'ar_paid' => '',
                        'ap_paid' => 'Paid',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $billPayment->amount_to_apply)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $transfers = $this->expenses_model->get_company_transfers($filters);
                foreach($transfers as $transfer)
                {
                    $account = $this->chart_of_accounts_model->getById($transfer->transfer_from_account_id);

                    $transferToAcc = $this->chart_of_accounts_model->getById($transfer->transfer_to_account_id);
                    $where = [
                        'account_id' => $transferToAcc->id,
                        'transaction_type' => 'Transfer',
                        'transaction_id' => $transfer->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $subRows = [
                        [
                            'account' => $transferToAcc->name,
                            'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                        ]
                    ];

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($transfer->transfer_date)),
                        'transaction_type' => 'Transfer',
                        'to_print' => '',
                        'num' => '',
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($transfer->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Transfer',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($transfer->created_at)),
                        'name_type' => '',
                        'name_id' => '',
                        'name' => '',
                        'customer' => '',
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $transfer->transfer_memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $transfer->transfer_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $deposits = $this->accounting_bank_deposit_model->get_company_deposits($filters);
                foreach($deposits as $deposit)
                {
                    $account = $this->chart_of_accounts_model->getById($deposit->account_id);

                    $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);

                    $subRows = [];
                    foreach($funds as $fund)
                    {
                        $fundAcc = $this->chart_of_accounts_model->getById($fund->received_from_account_id);

                        $where = [
                            'account_id' => $fundAcc->id,
                            'transaction_type' => 'Deposit',
                            'transaction_id' => $deposit->id,
                            'is_category' => 1,
                            'child_id' => $fund->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $vendor = '';
                        $customer = '';
                        $employee = '';
                        switch($fund->received_from_key) {
                            case 'vendor':
                                $receivedFrom = $this->vendors_model->get_vendor_by_id($fund->received_from_id);
                                $vendor = $receivedFrom->display_name;
                            break;
                            case 'customer':
                                $receivedFrom = $this->accounting_customers_model->get_by_id($fund->received_from_id);
                                $customer = $receivedFrom->first_name . ' ' . $receivedFrom->last_name;
                            break;
                            case 'employee':
                                $receivedFrom = $this->users_model->getUser($fund->received_from_id);
                                $employee = $receivedFrom->FName . ' ' . $receivedFrom->LName;
                            break;
                        }

                        $subRows[] = [
                            'account' => $fundAcc->name,
                            'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                            'customer' => $customer,
                            'vendor' => $vendor,
                            'employee' => $employee
                        ];
                    }

                    if(count($funds) < 2 && count($funds) > 0) {
                        switch($funds[0]->received_from_key) {
                            case 'vendor':
                                $receivedFrom = $this->vendors_model->get_vendor_by_id($funds[0]->received_from_id);
                                $name = $receivedFrom->display_name;
                                $vendor = $name;
                            break;
                            case 'customer':
                                $receivedFrom = $this->accounting_customers_model->get_by_id($funds[0]->received_from_id);
                                $name = $receivedFrom->first_name . ' ' . $receivedFrom->last_name;
                                $customer = $name;
                            break;
                            case 'employee':
                                $receivedFrom = $this->users_model->getUser($funds[0]->received_from_id);
                                $name = $receivedFrom->FName . ' ' . $receivedFrom->LName;
                                $employee = $name;
                            break;
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($deposit->date)),
                        'transaction_type' => 'Deposit',
                        'to_print' => '',
                        'num' => '',
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($deposit->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Deposit',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($deposit->created_at)),
                        'name_type' => count($funds) < 2 && count($funds) > 0 ? $funds[0]->received_from_key : '',
                        'name_id' => count($funds) < 2 && count($funds) > 0 ? $funds[0]->received_from_id : '',
                        'name' => $name,
                        'customer' => $customer,
                        'vendor' => $vendor,
                        'employee' => $employee,
                        'product_service' => '',
                        'memo_description' => $deposit->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $deposit->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $salesReceipts = $this->accounting_sales_receipt_model->get_all_by_company_id(logged('company_id'));
                foreach($salesReceipts as $salesReceipt)
                {
                    $account = $this->chart_of_accounts_model->getById($salesReceipt->deposit_to_account);

                    $salesReceiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Sales Receipt', $salesReceipt->id);

                    $customer = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $subRows = [];
                    foreach($salesReceiptItems as $salesReceiptItem)
                    {
                        $item = $this->items_model->getItemById($salesReceiptItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $salesReceiptItem->price));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($salesReceiptItem->quantity);
                        $rate = number_format(floatval($rate), 2);

                        $qty = '-'.number_format(floatval($salesReceiptItem->quantity), 2);
                        $expenseQty = number_format(floatval($salesReceiptItem->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Sales Receipt',
                            'transaction_id' => $salesReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $salesReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Sales Receipt',
                            'transaction_id' => $salesReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $salesReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Sales Receipt',
                            'transaction_id' => $salesReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $salesReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($salesReceipt->sales_receipt_date)),
                        'transaction_type' => 'Sales Receipt',
                        'to_print' => '',
                        'num' => $salesReceipt->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($salesReceipt->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Sales Receipt',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($salesReceipt->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $salesReceipt->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $salesReceipt->message_on_statement,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => number_format(floatval(str_replace(',', '', $salesReceipt->total_amount)), 2, '.', ','),
                        'credit' => '',
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $creditMemos = $this->accounting_credit_memo_model->get_company_credit_memos(['company_id' => logged('company_id')]);
                foreach($creditMemos as $creditMemo)
                {
                    $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                    $creditMemoItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Credit Memo', $creditMemo->id);

                    $customer = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $subRows = [];
                    foreach($creditMemoItems as $creditMemoItem)
                    {
                        $item = $this->items_model->getItemById($creditMemoItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $creditMemoItem->price));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($creditMemoItem->quantity);
                        $rate = number_format(floatval($rate), 2);

                        $qty = number_format(floatval($creditMemo->quantity), 2);
                        $expenseQty = '-'.number_format(floatval($creditMemo->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Credit Memo',
                            'transaction_id' => $creditMemo->id,
                            'is_item_category' => 1,
                            'child_id' => $creditMemoItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Credit Memo',
                            'transaction_id' => $creditMemo->id,
                            'is_item_category' => 1,
                            'child_id' => $creditMemoItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Credit Memo',
                            'transaction_id' => $creditMemo->id,
                            'is_item_category' => 1,
                            'child_id' => $creditMemoItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                        'transaction_type' => 'Credit Memo',
                        'to_print' => '',
                        'num' => $creditMemo->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($creditMemo->updated_at)),
                        'open_balance' => number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2, '.', ','),
                        'payment_date' => '',
                        'method' => 'Credit Memo',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($creditMemo->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $creditMemo->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $creditMemo->message_on_statement,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $arAcc->id,
                        'account' => $arAcc->name,
                        'ar_paid' => floatval(str_replace(',', '', $creditMemo->balance)) > 0.00 ? 'Unpaid' : 'Paid',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $creditMemo->total_amount)), 2, '.', ','),
                        'online_banking' => ''
                    ];
                }

                $refundReceipts = $this->accounting_refund_receipt_model->get_company_refund_receipts(['company_id' => logged('company_id')]);
                foreach($refundReceipts as $refundReceipt)
                {
                    $account = $this->chart_of_accounts_model->getById($refundReceipt->refund_from_account);

                    $refundReceiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Refund Receipt', $refundReceipt->id);

                    $customer = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
                    $name = $customer->first_name . ' ' . $customer->last_name;

                    $subRows = [];
                    foreach($refundReceiptItems as $refundReceiptItem)
                    {
                        $item = $this->items_model->getItemById($refundReceiptItem->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $incomeAcc = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                        $expenseAcc = $this->chart_of_accounts_model->getById($itemAccDetails->expense_account_id);

                        $incomeRate = floatval(str_replace(',', '', $refundReceiptItem->price));
                        $incomeRate = number_format(floatval($incomeRate), 2);
                        $rate = floatval(str_replace(',', '', $item->cost)) * floatval($refundReceiptItem->quantity);
                        $rate = number_format(floatval($rate), 2);

                        $qty = number_format(floatval($refundReceiptItem->quantity), 2);
                        $expenseQty = '-'.number_format(floatval($refundReceiptItem->quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $incomeRate = number_format(floatval($incomeRate) / 100, 2);
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                            $expenseQty = number_format(floatval($expenseQty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $incomeRate = number_format(floatval($incomeRate), 0);
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                            $expenseQty = number_format(floatval($expenseQty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = '('.$incomeRate.')';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = '('.$expenseQty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($incomeRate, 0, 1) === '-') {
                                        $incomeRate = str_replace('-', '', $incomeRate);
                                        $incomeRate = $incomeRate.'-';
                                    }

                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }

                                    if(substr($expenseQty, 0, 1) === '-') {
                                        $expenseQty = str_replace('-', '', $expenseQty);
                                        $expenseQty = $expenseQty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($incomeRate, 0, 1) === '-') {
                                    $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                }

                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }

                                if(substr($expenseQty, 0, 1) === '-') {
                                    $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($incomeRate, 0, 1) === '(' && substr($incomeRate, -1) === ')') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, 0, 1) === '(' && substr($expenseQty, -1) === ')') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($incomeRate, -1) === '-') {
                                            $incomeRate = '<span class="text-danger">'.$incomeRate.'</span>';
                                        }

                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }

                                        if(substr($expenseQty, -1) === '-') {
                                            $expenseQty = '<span class="text-danger">'.$expenseQty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        $where = [
                            'account_id' => $incomeAcc->id,
                            'transaction_type' => 'Refund Receipt',
                            'transaction_id' => $refundReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $refundReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $incomeRate,
                                'account' => $incomeAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Refund Receipt',
                            'transaction_id' => $refundReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $refundReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }

                        $where = [
                            'account_id' => $expenseAcc->id,
                            'transaction_type' => 'Refund Receipt',
                            'transaction_id' => $refundReceipt->id,
                            'is_item_category' => 1,
                            'child_id' => $refundReceiptItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $expenseQty,
                                'rate' => $rate,
                                'account' => $expenseAcc->name,
                                'credit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'customer' => $name
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                        'transaction_type' => 'Refund Receipt',
                        'to_print' => $refundReceipt->print_later,
                        'num' => $refundReceipt->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($refundReceipt->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Refund Receipt',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($refundReceipt->created_at)),
                        'name_type' => 'customer',
                        'name_id' => $refundReceipt->customer_id,
                        'name' => $name,
                        'customer' => $name,
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $refundReceipt->message_on_statement,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $refundReceipt->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $qtyAdjustments = $this->accounting_inventory_qty_adjustments_model->get_company_quantity_adjustments($filters);
                foreach($qtyAdjustments as $adjustment)
                {
                    $account = $this->chart_of_accounts_model->getById($adjustment->inventory_adjustment_account_id);

                    $adjustmentItems = $this->accounting_inventory_qty_adjustments_model->get_adjusted_products($adjustment->id);

                    $subRows = [];
                    foreach($adjustmentItems as $adjustmentItem)
                    {
                        $item = $this->items_model->getItemById($adjustmentItem->product_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                        $where = [
                            'account_id' => $invAssetAcc->id,
                            'transaction_type' => 'Inventory Qty Adjust',
                            'transaction_id' => $adjustment->id,
                            'is_item_category' => 1,
                            'child_id' => $adjustmentItem->id
                        ];

                        $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                        $rate = floatval(str_replace(',', '', $item->cost));
                        $rate = number_format(floatval($rate), 2);
                        $qty = number_format(floatval($adjustmentItem->change_in_quantity), 2);

                        if(!empty($post['divide-by-100'])) {
                            $rate = number_format(floatval($rate) / 100, 2);
                            $qty = number_format(floatval($qty) / 100, 2);
                        }

                        if(!empty($post['without-cents'])) {
                            $rate = number_format(floatval($rate), 0);
                            $qty = number_format(floatval($qty), 0);
                        }

                        if(!empty($post['negative-numbers'])) {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = '('.$rate.')';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = '('.$qty.')';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, 0, 1) === '-') {
                                        $rate = str_replace('-', '', $rate);
                                        $rate = $rate.'-';
                                    }

                                    if(substr($qty, 0, 1) === '-') {
                                        $qty = str_replace('-', '', $qty);
                                        $qty = $qty.'-';
                                    }
                                break;
                            }
                        }

                        if(!empty($post['show-in-red'])) {
                            if(empty($post['negative-numbers'])) {
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = '<span class="text-danger">'.$rate.'</span>';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = '<span class="text-danger">'.$qty.'</span>';
                                }
                            } else {
                                switch($post['negative-numbers']) {
                                    case '(100)' :
                                        if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                    case '100-' :
                                        if(substr($rate, -1) === '-') {
                                            $rate = '<span class="text-danger">'.$rate.'</span>';
                                        }

                                        if(substr($qty, -1) === '-') {
                                            $qty = '<span class="text-danger">'.$qty.'</span>';
                                        }
                                    break;
                                }
                            }
                        }

                        if(!empty($accTransacData)) {
                            $subRows[] = [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ',')
                            ];
                        }
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($adjustment->adjustment_date)),
                        'transaction_type' => 'Inventory Qty Adjust',
                        'to_print' => '',
                        'num' => $adjustment->adjustment_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($adjustment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Inventory Qty Adjust',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($adjustment->created_at)),
                        'name_type' => '',
                        'name_id' => '',
                        'name' => '',
                        'customer' => '',
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $adjustment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $adjustment->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $adjustments = $this->starting_value_model->get_by_company_id(logged('company_id'));
                foreach($adjustments as $adjustment)
                {
                    $account = $this->chart_of_accounts_model->getById($adjustment->inv_adj_account);

                    $item = $this->items_model->getItemById($adjustment->item_id)[0];
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($item->id);

                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                    $where = [
                        'account_id' => $invAssetAcc->id,
                        'transaction_type' => 'Inventory Starting Value',
                        'transaction_id' => $adjustment->id,
                        'is_item_category' => 1,
                        'child_id' => $adjustmentItem->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    $rate = floatval(str_replace(',', '', $adjustment->initial_cost));
                    $rate = number_format(floatval($rate), 2);
                    $qty = number_format(floatval($adjustmentItem->initial_qty), 2);

                    if(!empty($post['divide-by-100'])) {
                        $rate = number_format(floatval($rate) / 100, 2);
                        $qty = number_format(floatval($qty) / 100, 2);
                    }

                    if(!empty($post['without-cents'])) {
                        $rate = number_format(floatval($rate), 0);
                        $qty = number_format(floatval($qty), 0);
                    }

                    if(!empty($post['negative-numbers'])) {
                        switch($post['negative-numbers']) {
                            case '(100)' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = '('.$rate.')';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = str_replace('-', '', $qty);
                                    $qty = '('.$qty.')';
                                }
                            break;
                            case '100-' :
                                if(substr($rate, 0, 1) === '-') {
                                    $rate = str_replace('-', '', $rate);
                                    $rate = $rate.'-';
                                }

                                if(substr($qty, 0, 1) === '-') {
                                    $qty = str_replace('-', '', $qty);
                                    $qty = $qty.'-';
                                }
                            break;
                        }
                    }

                    if(!empty($post['show-in-red'])) {
                        if(empty($post['negative-numbers'])) {
                            if(substr($rate, 0, 1) === '-') {
                                $rate = '<span class="text-danger">'.$rate.'</span>';
                            }

                            if(substr($qty, 0, 1) === '-') {
                                $qty = '<span class="text-danger">'.$qty.'</span>';
                            }
                        } else {
                            switch($post['negative-numbers']) {
                                case '(100)' :
                                    if(substr($rate, 0, 1) === '(' && substr($rate, -1) === ')') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($qty, 0, 1) === '(' && substr($qty, -1) === ')') {
                                        $qty = '<span class="text-danger">'.$qty.'</span>';
                                    }
                                break;
                                case '100-' :
                                    if(substr($rate, -1) === '-') {
                                        $rate = '<span class="text-danger">'.$rate.'</span>';
                                    }

                                    if(substr($qty, -1) === '-') {
                                        $qty = '<span class="text-danger">'.$qty.'</span>';
                                    }
                                break;
                            }
                        }
                    }

                    if(!empty($accTransacData)) {
                        $subRows = [
                            [
                                'product_service' => $item->title,
                                'qty' => $qty,
                                'rate' => $rate,
                                'account' => $invAssetAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $adjustment->total_amount)), 2, '.', ',')
                            ]
                        ];
                    }

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($adjustment->as_of_date)),
                        'transaction_type' => 'Inventory Starting Value',
                        'to_print' => '',
                        'num' => $adjustment->ref_no,
                        'created_by' => '',
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($adjustment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Inventory Starting Value',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($adjustment->created_at)),
                        'name_type' => '',
                        'name_id' => '',
                        'name' => '',
                        'customer' => '',
                        'vendor' => '',
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $adjustment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $adjustment->total_amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $ccPayments = $this->expenses_model->get_company_cc_payment_transactions($filters);
                foreach($ccPayments as $ccPayment)
                {
                    $account = $this->chart_of_accounts_model->getById($ccPayment->bank_account_id);
                    $ccAcc = $this->chart_of_accounts_model->getById($ccPayment->credit_card_id);

                    $employee = $this->users_model->getUser($ccPayment->created_by);
                    $createdBy = $employee->FName . ' ' . $employee->LName;

                    $where = [
                        'account_id' => $ccAcc->id,
                        'transaction_type' => 'CC Payment',
                        'transaction_id' => $ccPayment->id
                    ];

                    $accTransacData = $this->accounting_account_transactions_model->get_with_custom_where($where);

                    if(!empty($accTransacData)) {
                        $subRows = [
                            [
                                'account' => $ccAcc->name,
                                'debit' => number_format(floatval(str_replace(',', '', $accTransacData->amount)), 2, '.', ','),
                                'vendor' => $name
                            ]
                        ];
                    }

                    $vendor = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
                    $name = $vendor->display_name;

                    $transactions[] = [
                        'date' => date("m/d/Y", strtotime($ccPayment->date)),
                        'transaction_type' => 'Credit Card Payment',
                        'to_print' => '',
                        'num' => '',
                        'created_by' => $createdBy,
                        'last_modified_by' => '',
                        'due_date' => '',
                        'last_modified' => date("m/d/Y h:i:s A", strtotime($ccPayment->updated_at)),
                        'open_balance' => '',
                        'payment_date' => '',
                        'method' => 'Credit Card Payment',
                        'adj' => '',
                        'created' => date("m/d/Y h:i:s A", strtotime($ccPayment->created_at)),
                        'name_type' => !empty($ccPayment->payee_id) ? 'vendor' : '',
                        'name_id' => $ccPayment->payee_id,
                        'name' => $name,
                        'customer' => '',
                        'vendor' => $name,
                        'employee' => '',
                        'product_service' => '',
                        'memo_description' => $ccPayment->memo,
                        'qty' => '',
                        'rate' => '',
                        'account_id' => $account->id,
                        'account' => $account->name,
                        'ar_paid' => '',
                        'ap_paid' => '',
                        'clr' => '',
                        'check_printed' => '',
                        'debit' => '',
                        'credit' => number_format(floatval(str_replace(',', '', $ccPayment->amount)), 2, '.', ','),
                        'online_banking' => '',
                        'sub_rows' => $subRows
                    ];
                }

                $sort = [
                    'column' => !empty(get('column')) ? str_replace('-', '_', get('column')) : 'date',
                    'order' => empty(get('order')) ? 'asc' : 'desc'
                ];

                usort($transactions, function($a, $b) use ($sort) {
                    switch($sort['column']) {
                        case 'date' :
                            if($sort['order'] === 'asc') {
                                if($a['date'] === $b['date']) {
                                    return strtotime($a['created']) > strtotime($b['created']);
                                }
                                return strtotime($a['date']) > strtotime($b['date']);
                            } else {
                                if($a['date'] === $b['date']) {
                                    return strtotime($a['created']) < strtotime($b['created']);
                                }
                                return strtotime($a['date']) < strtotime($b['date']);
                            }
                        break;
                        case 'created' :
                            if($sort['order'] === 'asc') {
                                return strtotime($a['created']) > strtotime($b['created']);
                            } else {
                                return strtotime($a['created']) < strtotime($b['created']);
                            }
                        break;
                        case 'last-modified' :
                            if($sort['order'] === 'asc') {
                                return strtotime($a['last_modified']) > strtotime($b['last_modified']);
                            } else {
                                return strtotime($a['last_modified']) < strtotime($b['last_modified']);
                            }
                        break;
                        default :
                            if($sort['order'] === 'asc') {
                                return strcmp($a[$sort['column']], $a[$sort['column']]);
                            } else {
                                return strcmp($b[$sort['column']], $b[$sort['column']]);
                            }
                        break;
                    }
                });

                $dateFilter = [
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ];

                if($post['date'] !== 'all-dates') {
                    $transactions = array_filter($transactions, function($v, $k) use ($dateFilter) {
                        return strtotime($v['date']) >= strtotime($dateFilter['start_date']) && strtotime($v['date']) <= strtotime($dateFilter['end_date']);
                    }, ARRAY_FILTER_USE_BOTH);
                }

                if(!empty($post['transaction-type'])) {
                    $transacType = $post['transaction-type'];
                    $transactions = array_filter($transactions, function($v, $k) use ($transacType) {
                        switch($transacType) {
                            case 'credit-card-expense' :
                                return $v['transaction_type'] === 'Credit Card Expense';
                            break;
                            case 'check' :
                                return $v['transaction_type'] === 'Check';
                            break;
                            case 'invoice' :
                                return $v['transaction_type'] === 'Invoice';
                            break;
                            case 'payment' :
                                return $v['transaction_type'] === 'Payment';
                            break;
                            case 'journal-entry' :
                                return $v['transaction_type'] === 'Journal Entry';
                            break;
                            case 'bill' :
                                return $v['transaction_type'] === 'Bill';
                            break;
                            case 'credit-card-credit' :
                                return $v['transaction_type'] === 'Credit Card Credit';
                            break;
                            case 'vendor-credit' :
                                return $v['transaction_type'] === 'Vendor Credit';
                            break;
                            case 'bill-payment-check' :
                                return $v['transaction_type'] === 'Bill Payment (Check)';
                            break;
                            case 'bill-payment-credit-card' :
                                return $v['transaction_type'] === 'Bill Payment (Credit Card)';
                            break;
                            case 'transfer' :
                                return $v['transaction_type'] === 'Transfer';
                            break;
                            case 'deposit' :
                                return $v['transaction_type'] === 'Deposit';
                            break;
                            case 'cash-expense' :
                                return $v['transaction_type'] === 'Expense';
                            break;
                            case 'sales-receipt' :
                                return $v['transaction_type'] === 'Sales Receipt';
                            break;
                            case 'credit-memo' :
                                return $v['transaction_type'] === 'Credit Memo';
                            break;
                            case 'refund' :
                                return $v['transaction_type'] === 'Refund';
                            break;
                            case 'inventory-qty-adjust' :
                                return $v['transaction_type'] === 'Inventory Qty Adjust';
                            break;
                            case 'expense' :
                                return $v['transaction_type'] === 'Expense' || $v['transaction_type'] === 'Credit Card Expense';
                            break;
                            case 'inventory-starting-value' :
                                return $v['transaction_type'] === 'Inventory Starting Value';
                            break;
                            case 'credit-card-payment' :
                                return $v['transaction_type'] === 'Credit Card Payment';
                            break;
                        }
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['filter_transaction_type'] = get('transaction-type');
                }

                if(!empty($post['account'])) {
                    $this->page_data['filter_account'] = new stdClass();
                    $this->page_data['filter_account']->id = $post['account'];

                    if(intval($post['account']) > 0) {
                        $account = $this->chart_of_accounts_model->getById($post['account']);
                        $this->page_data['filter_account']->name = $account->name;

                        $filters = [
                            'account_id' => $post['account']
                        ];

                        $accounts = array_filter($accounts, function($v, $k) use ($filters) {
                            return $v['account_id'] === $filters['account_id'];
                        }, ARRAY_FILTER_USE_BOTH);
                    } else {
                        $names = [
                            'balance-sheet-accounts' => 'All Balance Sheet Accounts',
                            'asset-accounts' => 'All Asset Accounts',
                            'current-asset-accounts' => 'All Current Asset Accounts',
                            'bank-accounts' => 'All Bank Accounts',
                            'accounts-receivable-accounts' => 'All Accounts receivable (A/R) Accounts',
                            'other-current-assets-accounts' => 'All Other Current Assets Accounts',
                            'fixed-assets-accounts' => 'All Fixed Assets Accounts',
                            'other-assets-accounts' => 'All Other Assets Accounts',
                            'liability-accounts' => 'All Liability Accounts',
                            'accounts-payable-accounts' => 'All Accounts payable (A/P) Accounts',
                            'credit-card-accounts' => 'All Credit Card Accounts',
                            'other-current-liabilities-accounts' => 'All Other Current Liabilities Accounts',
                            'long-term-liabilities-accounts' => 'All Long Term Liabilities Accounts',
                            'equity-accounts' => 'All Equity Accounts',
                            'income-expense-accounts' => 'All Income/Expense Accounts',
                            'income-accounts' => 'All Income Accounts',
                            'cost-of-goods-sold-accounts' => 'All Cost of Goods Sold Accounts',
                            'expenses-accounts' => 'All Expenses Accounts',
                            'other-income-accounts' => 'All Other Income Accounts',
                            'other-expense-accounts' => 'All Other Expense Accounts'
                        ];
                        $this->page_data['filter_account']->name = $names[$post['account']];

                        $type = $post['account'];

                        $accounts = array_filter($accounts, function($v, $k) use ($type) {
                            switch($type) {
                                case 'balance-sheet-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false || strpos($v['type'], 'Liabilities') !== false || $v['type'] === 'Equity' || $v['type'] === 'Credit Card';
                                break;
                                case 'asset-account' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || strpos($v['type'], 'Assets') !== false;
                                break;
                                case 'current-asset-accounts' :
                                    return $v['type'] === 'Bank' || $v['type'] === 'Accounts receivable (A/R)' || $v['type'] === 'Other Current Assets';
                                break;
                                case 'bank-accounts' :
                                    return $v['type'] === 'Bank';
                                break;
                                case 'accounts-receivable-accounts' :
                                    return $v['type'] === 'Accounts receivable (A/R)';
                                break;
                                case 'other-current-assets-accounts' :
                                    return $v['type'] === 'Other Current Assets';
                                break;
                                case 'fixed-assets-accounts' :
                                    return $v['type'] === 'Fixed Assets';
                                break;
                                case 'other-assets-accounts' :
                                    return $v['type'] === 'Other Assets';
                                break;
                                case 'liability-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || strpos($v['type'], 'Liabilities') !== false;
                                break;
                                case 'accounts-payable-accounts' :
                                    return $v['type'] === 'Accounts payable (A/P)' || $v['type'] === 'Credit Card' || $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'credit-card-accounts' :
                                    return $v['type'] === 'Credit Card';
                                break;
                                case 'other-current-liabilities-accounts' :
                                    return $v['type'] === 'Other Current Liabilities';
                                break;
                                case 'long-term-liabilities-accounts' :
                                    return $v['type'] === 'Long Term Liabilities';
                                break;
                                case 'equity-accounts' :
                                    return $v['type'] === 'Equity';
                                break;
                                case 'income-expense-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold' || strpos($v['type'], 'Income') !== false || strpos($v['type'], 'Expense') !== false;
                                break;
                                case 'income-accounts' :
                                    return $v['type'] === 'Income';
                                break;
                                case 'cost-of-goods-sold-accounts' :
                                    return $v['type'] === 'Cost of Goods Sold';
                                break;
                                case 'expenses-accounts' :
                                    return $v['type'] === 'Expenses';
                                break;
                                case 'other-income-accounts' :
                                    return $v['type'] === 'Other Income';
                                break;
                                case 'other-expense-accounts' :
                                    return $v['type'] === 'Other Expense';
                                break;
                            };
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                }

                if(!empty($post['name'])) {
                    $filterName = explode('-', $post['name']);

                    $transactions = array_filter($transactions, function($v, $k) use ($filterName) {
                        return $v['name_type'] === $filterName[0] && $v['name_id'] === $filterName[1];
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['filter_name'] = new stdClass();
                    $this->page_data['filter_name']->id = $post['name'];

                    switch($filterName[0]) {
                        case 'customer' :
                            $customer = $this->accounting_customers_model->get_by_id($filterName[1]);
                            $this->page_data['filter_name']->name = $customer->first_name . ' ' . $customer->last_name;
                        break;
                        case 'vendor' :
                            $vendor = $this->vendors_model->get_vendor_by_id($filterName[1]);
                            $this->page_data['filter_name']->name = $vendor->display_name;
                        break;
                        case 'employee' :
                            $employee = $this->users_model->getUser($filterName[1]);
                            $this->page_data['filter_name']->name = $employee->FName . ' ' . $employee->LName;
                        break;
                    }
                }

                if(!empty($post['check-printed'])) {
                    $checkPrinted = $post['check-printed'];

                    $transactions = array_filter($transactions, function($v, $k) use ($checkPrinted) {
                        if($checkPrinted === 'printed') {
                            return $v['to_print'] === null;
                        } else {
                            return $v['to_print'] !== null;
                        }
                    }, ARRAY_FILTER_USE_BOTH);
                    $this->page_data['filter_check_printed'] = $post['check-printed'];
                }

                if(!empty($post['num'])) {
                    $num = $post['num'];

                    $transactions = array_filter($transactions, function($v, $k) use ($num) {
                        return $v['num'] === $num;
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['filter_num'] = $post['num'];
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
                    if(empty($post['show-report-period'])) {
                        $writer->writeSheetRow('Sheet1', [$report_period], ['halign' => $headerAlignment, 'valign' => 'center', 'font-style' => 'bold']);
                        $writer->markMergedCell('Sheet1', $row, 0, $row, count($post['fields']) - 1);
                        $row++;
                    }

                    $writer->writeSheetRow('Sheet1', $post['fields'], ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);
                    $row += 2;

                    foreach($transactions as $transaction)
                    {
                        $data = [];

                        $style = [];
                        foreach($post['fields'] as $field) {
                            if($field === 'Balance') {
                                if(stripos($transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], '<span class="text-danger">') !== false) {
                                    $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('<span class="text-danger">', '', $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                    $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('</span>', '', $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                // if(substr($transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], 0, 1) === '-') {
                                    $style[] = ['color' => '#FF0000'];
                                } else {
                                    $style[] = ['color' => '#000000'];
                                }
                            } else {
                                $style[] = ['color' => '#000000'];
                            }
                            $data[] = $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))];
                        }

                        $writer->writeSheetRow('Sheet1', $data, $style);

                        $row++;

                        foreach($transaction['sub_rows'] as $subRow) {
                            $data = [];

                            $style = [];
                            foreach($post['fields'] as $field) {
                                if($field === 'Balance') {
                                    if(stripos($subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], '<span class="text-danger">') !== false) {
                                        $subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('<span class="text-danger">', '', $subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                        $subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))] = str_replace('</span>', '', $subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]);
                                    // if(substr($subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))], 0, 1) === '-') {
                                        $style[] = ['color' => '#FF0000'];
                                    } else {
                                        $style[] = ['color' => '#000000'];
                                    }
                                } else {
                                    $style[] = ['color' => '#000000'];
                                }
                                $data[] = $subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))];
                            }

                            $writer->writeSheetRow('Sheet1', $data, $style);

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

                    $fileName = str_replace(' ', '_', $companyName).'_Journal';
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header("Content-Disposition: attachment;filename=Journal.xlsx");
                    header('Cache-Control: max-age=0');
                    $writer->writeToStdOut();
                } else {
                    $html = '
                        <table style="padding-top:-40px;">
                            <tr>
                                <td style="text-align: '.$headerAlignment.'">';
                                    $html .= empty($post['show-company-name']) ? '<h2 style="margin: 0">'.$companyName.'</h2>' : '';
                                    $html .= empty($post['show-report-title']) ? '<h3 style="margin: 0">'.$reportName.'</h3>' : '';
                                    $html .= empty($post['show-report-period']) ? '<h4 style="margin: 0">'.$report_period.'</h4>' : '';
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

                        foreach($transactions as $transaction)
                        {
                            $html .= '<tr>';
                            foreach($post['fields'] as $field)
                            {
                                $html .= '<td>'.str_replace('class="text-danger"', 'style="color: red"', $transaction[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]).'</td>';
                            }
                            $html .= '</tr>';

                            foreach($transaction['sub_rows'] as $subRow)
                            {
                                $html .= '<tr>';
                                foreach($post['fields'] as $field)
                                {
                                    $html .= '<td>'.str_replace('class="text-danger"', 'style="color: red"', $subRow[strtolower(str_replace(' ', '_', str_replace('/', '_', $field)))]).'</td>';
                                }
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

                    $fileName = str_replace(' ', '_', $companyName).'_Journal';

                    tcpdf();
                    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $title = "Journal";
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
                    $obj_pdf->Output(str_replace(' ', '_', $companyName).'_Journal.pdf', 'D');
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