<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once 'application/services/InvoiceCustomer.php';

class Accounting extends MY_Controller
{
    private $upload_path = "./uploads/accounting/";
    private $expenses_path = "./uploads/accounting/expenses/";

    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
        $this->hasAccessModule(45);
        $this->load->model('general_model');
        $this->load->model('vendors_model');
        $this->load->model('terms_model');
        $this->load->model('expenses_model');
        $this->load->model('rules_model');
        $this->load->model('receipt_model');
        $this->load->model('tags_model');
        $this->load->model('categories_model');
        $this->load->model('accounting_bank_accounts');
        $this->load->model('accounting_invoices_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_delayed_charge_model');
        $this->load->model('accounting_sales_time_activity_model');
        $this->load->model('Accounting_customers_model', 'accounting_customers_model');
        $this->load->model('accounting_refund_receipt_model');
        $this->load->model('accounting_delayed_credit_model');
        $this->load->model('accounting_purchase_order_model');
        $this->load->model('accounting_credit_card_model');
        $this->load->model('estimate_model');
        $this->load->model('account_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('accounting_expense_name_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('accounting_recurring_transactions_model');
        $this->load->model('items_model');
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Invoice_settings_model', 'invoice_settings_model');
        $this->load->model('AcsProfile_model', 'AcsProfile_model');
        $this->load->model('TaxRates_model');
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('General_model', 'general');
        $this->load->model('Accounting_account_settings_model', 'accounting_account_settings_model');
        $this->load->model('Accounting_statements_model', 'accounting_statements_model');
        $this->load->model('Accounting_management_reports', 'accounting_management_reports');
        $this->load->library('excel');
        //$this->load->library('pdf');
        //        The "?v=rand()" is to remove browser caching. It needs to remove in the live website.
        add_css(array(
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css?2021",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css",
            "assets/css/accounting/accounting_includes/receive_payment.css",
            "assets/css/accounting/accounting_includes/customer_sales_receipt_modal.css",
            "assets/css/accounting/accounting_includes/create_charge.css",
            "assets/css/accounting/accounting_includes/refund_receipt_modal.css",
            "assets/css/accounting/accounting_includes/delayed_credit_modal.css",
            "assets/css/accounting/invoices_page.css",
            "assets/css/accounting/accounting_includes/send_reminder_by_batch_modal.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js",
            "assets/js/accounting/sales/customer_includes/refund_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/delayed_credit_modal.js",
            "assets/js/accounting/sales/invoices_page.js",
            "assets/js/accounting/sales/customer_includes/send_reminder_by_batch_modal.js",
        ));

        $this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow", array()),
                array("Expenses", array('Expenses', 'Vendors')),
                array("Sales", array('Overview', 'All Sales', 'Estimates', 'Customers', 'Deposits', 'Work Order', 'Invoice', 'Jobs')),
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
                array("", array('/accounting/sales-overview', '/accounting/all-sales', '/accounting/newEstimateList', '/accounting/customers', '/accounting/deposits', '/accounting/listworkOrder', '/accounting/invoices', '/accounting/jobs')),
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

        $this->page_data['invoicesItems'] = $this->invoice_model->getInvoicesItems(logged('company_id'));
    }

    public function index()
    {
        redirect('/accounting/sales-overview', 'refresh');
    }

    public function banking()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['terms'] = $this->accounting_invoices_model->getPayTerms();
        $this->page_data['paymethods'] = $this->accounting_receive_payment_model->getpaymethod();

        //additional
        $this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->page_data['checks'] = $this->expenses_model->getCheck();
        $this->page_data['transactions'] = $this->expenses_model->getTransaction();
        $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
        $this->page_data['bills'] = $this->expenses_model->getBill();
        $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
        $this->page_data['expenses'] = $this->expenses_model->getExpense();
        $this->page_data['list_categories'] = $this->categories_model->getCategories();
        $this->page_data['attachments'] = $this->expenses_model->getAttachment();
        $this->page_data['items'] = $this->items_model->getItemlist();

        /*$this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->page_data['checks'] = $this->expenses_model->getCheck();
        $this->page_data['transactions'] = $this->expenses_model->getTransaction();
        $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
        $this->page_data['bills'] = $this->expenses_model->getBill();
        $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
        $this->page_data['expenses'] = $this->expenses_model->getExpense();
        $this->page_data['list_categories'] = $this->categories_model->getCategories();
        $this->page_data['attachments'] = $this->expenses_model->getAttachment();
        $this->page_data['items'] = $this->items_model->getItemlist();*/

        $this->load->view('accounting/dashboard', $this->page_data);
    }

    public function bank_connect()
    {
        $this->load->library('paypal_lib');
        $this->page_data['title'] = 'Bank Connect';
        $this->load->view('accounting/banking/link_bank', $this->page_data);
    }

    public function apply_for_capital()
    {
        $this->load->view('includes/header', $this->page_data);
        $this->load->view('accounting/apply_for_capital', $this->page_data);
    }


    // public function expenses()
    // {
    //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));
    //     $this->page_data['vendors'] = $this->vendors_model->getVendors();
    //     $this->page_data['checks'] = $this->expenses_model->getCheck();
    //     $this->page_data['transactions'] = $this->expenses_model->getTransaction();
    //     $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
    //     $this->page_data['bills'] = $this->expenses_model->getBill();
    //     $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
    //     $this->page_data['expenses'] = $this->expenses_model->getExpense();
    //     $this->page_data['list_categories'] = $this->categories_model->getCategories();
    //     $this->page_data['attachments'] = $this->expenses_model->getAttachment();
    //     $this->load->view('accounting/expenses', $this->page_data);
    // }
    // public function vendors(){
    //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));
    //     $this->page_data['vendors'] = $this->vendors_model->getVendors();
    //     $this->load->view('accounting/vendors', $this->page_data);
    // }

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

    public function my_accountant()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/my_accountant', $this->page_data);
    }

    public function link_bank()
    {
        $comp_id = logged('company_id');
        $get_company_account = array(
            'table' => 'accounting_bank_accounts',
            'where' => array('company_id' => $comp_id,),
            'select' => '*',
        );
        $this->page_data['accounts'] = $this->general_model->get_data_with_param($get_company_account, false);

        $get_company_banking_payment = array(
            'table' => 'banking_payments',
            'where' => array('company_id' => $comp_id,),
            'select' => '*',
        );
        $this->page_data['banking_payments'] = $this->general_model->get_data_with_param($get_company_banking_payment);

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/banking', $this->page_data);
    }

    public function test_payment()
    {
        $comp_id = logged('company_id');
        $get_company_account = array(
            'table' => 'accounting_bank_accounts',
            'where' => array('company_id' => $comp_id,),
            'select' => '*',
        );
        $this->page_data['accounts'] = $this->general_model->get_data_with_param($get_company_account, false);
        $this->load->view('accounting/banking/test_payment', $this->page_data);
    }

    public function import_transactions()
    {
        $comp_id = logged('company_id');

        $get_company_account = array(
            'table' => 'accounting_bank_accounts',
            'where' => array('company_id' => $comp_id,),
            'select' => '*',
        );
        $this->page_data['accounts'] = $this->general_model->get_data_with_param($get_company_account, false);

        $this->page_data['accounts'] = '';
        $this->load->view('accounting/banking/import_transaction', $this->page_data);
    }

    public function connect_policy()
    {
        $comp_id = logged('company_id');
        $this->page_data['accounts'] = '';
        $this->load->view('accounting/payroll/connect-policy', $this->page_data);
    }

    public function manage_connection()
    {
        $comp_id = logged('company_id');
        $this->page_data['accounts'] = '';
        $this->load->view('accounting/banking/manage-connection', $this->page_data);
    }

    public function bank_register()
    {
        $comp_id = logged('company_id');
        $this->page_data['accounts'] = '';
        $this->load->view('accounting/banking/bank-register', $this->page_data);
    }

    public function onSaveBakingPayment()
    {
        $banking_payments_data = array(
            'company_id' =>logged('company_id'),
            'description' => $_POST['description'],
            'payee' => $_POST['payee'],
            'amount' => $_POST['amount'],
            'assign_to' => $_POST['assign_to'],
            'is_paid' => 1,
        );
        $this->general->add_($banking_payments_data, 'banking_payments');
    }

    public function rules()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rules'] = $this->rules_model->getRules();
        add_css([
            'assets/css/accounting/banking/rules/rules.css',
            'https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css',

            // stepper
            'https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css',
        ]);
        add_footer_js([
            'assets/js/accounting/banking/rules/rules.js',

            // for some reason the oldest version is the only one that
            // works while implementing this. not sure why though.
            // https://cdn.datatables.net/rowreorder/
            'https://cdn.datatables.net/rowreorder/1.0.0/js/dataTables.rowReorder.min.js',

            'assets/js/accounting/banking/rules/libs/download/download.min.js',

            // stepper
            'https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js',
        ]);

        $this->load->view('accounting/rules', $this->page_data);
    }

    public function receipts()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['receipts'] = $this->receipt_model->getReceipt();
        $this->page_data['receipts_two'] = $this->receipt_model->getReceipt_two();
        add_css([
            'assets/css/accounting/receipts/receipts.css',
        ]);
        add_footer_js([
            'assets/js/accounting/banking/receipts/receipts.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            'https://apis.google.com/js/client.js?onload=checkAuth,onApiLoad',
        ]);

        $this->load->view('accounting/receipts', $this->page_data);
    }

    public function salesoverview()
    {
        add_css(array(
            "assets/css/accounting/sales-overview.css",
        ));
        add_footer_js(array(
            "assets/js/accounting/sales/overview.js",
        ));

        $company_id = getLoggedCompanyID();
        $start_date = date('Y-m-d', strtotime(date("Y-m-d") . ' - 365 days'));
        $end_date = date('Y-m-d');
        $invoices = $this->accounting_invoices_model->get_ranged_invoices_by_company_id($company_id, $start_date, $end_date);
        $receivable_payment = 0;
        $total_amount_received = 0;
        $receivable_last30_days = 0;
        $total_amount_received_last30_days = 0;
        $total_overdue = 0;
        $total_not_due = 0;
        $deposited_last30_days = 0;

        foreach ($invoices as $inv) {
            if (is_numeric($inv->grand_total)) {
                $receivable_payment += $inv->grand_total;
                if ($this->get_date_difference_indays($inv->date_issued, date("Y-m-d")) <= 30) {
                    $receivable_last30_days += $inv->grand_total;
                }
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            $amount_payment = 0;
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
                $amount_payment += $payment->payment_amount;
                if ($this->get_date_difference_indays($inv->date_issued, date("Y-m-d")) <= 30) {
                    $total_amount_received_last30_days += $payment->payment_amount;
                    $deposited_last30_days += $payment->payment_amount;
                }
            }
            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d")) {
                $total_overdue += $inv->grand_total - $amount_payment;
            } else {
                $total_not_due += $inv->grand_total - $amount_payment;
            }
        }

        //caculating this month overall income
        $receive_payments = $this->accounting_receive_payment_model->get_ranged_received_payment_by_company_id($company_id, date("Y-m-d", strtotime("first day of this month")), date("Y-m-d"));
        $income_this_month = 0;
        $income_last_month = 0;
        $income_per_day = array();

        $graph_data = array();
        $graph_data["type"] = "line";
        $graph_data["indexLabelFontSize"] = "12";
        $dataPoints = array();
        foreach ($receive_payments as $payment) {
            if (date("Y-m-d", strtotime($payment->payment_date)) >= date("Y-m-01") && date("Y-m-d", strtotime($payment->payment_date)) <= date("Y-m-d")) {
                $income_this_month += $payment->amount;
                $per_day_index = date("d", strtotime($payment->payment_date));
                $income_per_day[$per_day_index] += $payment->amount;
                $dataPoints["y"][] = $payment->amount;
            } else {
                $income_last_month += $payment->amount;
            }
        }
        $dataPoints["y"][] = 100;
        $graph_data["dataPoints"] = $dataPoints;
        // var_dump($receive_payments);

        //script for deposit widget
        $invoices_this_week = $this->invoice_model->get_ranged_PaidInv($company_id, date("Y-m-d", strtotime('monday this week')), date("Y-m-d", strtotime('sunday this week')));
        $total_deposit = 0;
        $statuses = array(0, 0, 0, 0);
        $deposit_transaction_count = 0;
        foreach ($invoices_this_week as $inv) {
            $total_deposit += $inv->grand_total;
            $deposit_transaction_count++;
            if ($inv->status == 'Submitted') {
                $statuses[0] += 1;
            } elseif ($inv->status == 'Approved') {
                $statuses[1] += 1;
            } elseif ($inv->status == 'Partially Paid') {
                $statuses[2] += 1;
            } elseif ($inv->status == 'Paid') {
                $statuses[3] += 1;
            }
        }
        $current_status = -1;
        $largest_status = 0;
        for ($i = 0; $i < count($statuses); $i++) {
            if ($statuses[$i] > $largest_status) {
                $current_status = $i;
                $largest_status = $statuses[$i];
                $i = -1;
            }
        }


        $this->page_data['unpaid_last_365'] = $receivable_payment - $total_amount_received;
        $this->page_data['unpaid_last_30'] = $receivable_last30_days - $total_amount_received_last30_days;
        $this->page_data['due_last_365'] = $total_overdue;
        $this->page_data['not_due_last_365'] = $total_not_due;
        $this->page_data['deposited_last30_days'] = $deposited_last30_days;
        $this->page_data['not_deposited_last30_days'] = $receivable_last30_days - $deposited_last30_days;
        $this->page_data['invoice_needs_attention'] = false;
        $this->page_data['income_this_month'] = $income_this_month;
        $this->page_data['income_last_month'] = $income_last_month;
        $this->page_data['deposit_current_status'] = $current_status;
        $this->page_data['deposit_total_amount'] = $total_deposit;
        $this->page_data['deposit_transaction_count'] = $deposit_transaction_count;
        $this->page_data['graph_data'] = "[" . $this->graph_data_to_text($graph_data) . "]";

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/sales_overview', $this->page_data);
    }

    public function graph_data_to_text($graph_data = array())
    {
        $the_text = "{";
        $data_keys = array_keys($graph_data);
        for ($i = 0; $i < count($data_keys); $i++) {
            $the_text .= $data_keys[$i] . ":";
            if (is_array($graph_data[$data_keys[$i]])) {
                $the_text .= "[" . $this->graph_data_to_text($graph_data[$data_keys[$i]]) . "]";
            } else {
                $the_text .= $graph_data[$data_keys[$i]];
            }
            $the_text .= ",";
        }
        $the_text .= "}";
        return $the_text;
    }

    public function allsales()
    {
        add_css(array(
        "assets/css/accounting/all_sales.css",
    ));
        add_footer_js(array(
        "assets/js/accounting/sales/all_sales.js"
    ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/all_sales', $this->page_data);
    }

    public function invoices()
    {
        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            "assets/css/accounting/customers.css",
        ));
        add_footer_js(array(
            "assets/js/accounting/sales/customers.js",
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js'
        ));
        
        $company_id = getLoggedCompanyID();
        $start_date = date('Y-m-d', strtotime(date("Y-m-d") . ' - 365 days'));
        $end_date = date('Y-m-d');
        $invoices = $this->accounting_invoices_model->get_ranged_invoices_by_company_id($company_id, $start_date, $end_date);
        $receivable_payment = 0;
        $total_amount_received = 0;
        $receivable_last30_days = 0;
        $total_amount_received_last30_days = 0;
        $total_overdue = 0;
        $total_not_due = 0;
        $deposited_last30_days = 0;

        foreach ($invoices as $inv) {
            if (is_numeric($inv->grand_total)) {
                $receivable_payment += $inv->grand_total;
                if ($this->get_date_difference_indays($inv->date_issued, date("Y-m-d")) <= 30) {
                    $receivable_last30_days += $inv->grand_total;
                }
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            $amount_payment = 0;
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
                $amount_payment += $payment->payment_amount;
                if ($this->get_date_difference_indays($inv->date_issued, date("Y-m-d")) <= 30) {
                    $total_amount_received_last30_days += $payment->payment_amount;
                    $deposited_last30_days += $payment->payment_amount;
                }
            }
            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d")) {
                $total_overdue += $inv->grand_total - $amount_payment;
            } else {
                $total_not_due += $inv->grand_total - $amount_payment;
            }
        }

        //caculating this month overall income
        $receive_payments = $this->accounting_receive_payment_model->get_ranged_received_payment_by_company_id($company_id, date("Y-m-d", strtotime("first day of this month")), date("Y-m-d"));
        $income_this_month = 0;
        $income_last_month = 0;
        $income_per_day = array();

        $graph_data = array();
        $graph_data["type"] = "line";
        $graph_data["indexLabelFontSize"] = "12";
        $dataPoints = array();
        foreach ($receive_payments as $payment) {
            if (date("Y-m-d", strtotime($payment->payment_date)) >= date("Y-m-01") && date("Y-m-d", strtotime($payment->payment_date)) <= date("Y-m-d")) {
                $income_this_month += $payment->amount;
                $per_day_index = date("d", strtotime($payment->payment_date));
                $income_per_day[$per_day_index] += $payment->amount;
                $dataPoints["y"][] = $payment->amount;
            } else {
                $income_last_month += $payment->amount;
            }
        }
        $dataPoints["y"][] = 100;
        $graph_data["dataPoints"] = $dataPoints;
        // var_dump($receive_payments);

        //script for deposit widget
        $invoices_this_week = $this->invoice_model->get_ranged_PaidInv($company_id, date("Y-m-d", strtotime('monday this week')), date("Y-m-d", strtotime('sunday this week')));
        $total_deposit = 0;
        $statuses = array(0, 0, 0, 0);
        $deposit_transaction_count = 0;
        foreach ($invoices_this_week as $inv) {
            $total_deposit += $inv->grand_total;
            $deposit_transaction_count++;
            if ($inv->status == 'Submitted') {
                $statuses[0] += 1;
            } elseif ($inv->status == 'Approved') {
                $statuses[1] += 1;
            } elseif ($inv->status == 'Partially Paid') {
                $statuses[2] += 1;
            } elseif ($inv->status == 'Paid') {
                $statuses[3] += 1;
            }
        }
        $current_status = -1;
        $largest_status = 0;
        for ($i = 0; $i < count($statuses); $i++) {
            if ($statuses[$i] > $largest_status) {
                $current_status = $i;
                $largest_status = $statuses[$i];
                $i = -1;
            }
        }


        $this->page_data['unpaid_last_365'] = $receivable_payment - $total_amount_received;
        $this->page_data['unpaid_last_30'] = $receivable_last30_days - $total_amount_received_last30_days;
        $this->page_data['due_last_365'] = $total_overdue;
        $this->page_data['not_due_last_365'] = $total_not_due;
        $this->page_data['deposited_last30_days'] = $deposited_last30_days;
        $this->page_data['not_deposited_last30_days'] = $receivable_last30_days - $deposited_last30_days;
        $this->page_data['invoice_needs_attention'] = false;
        $this->page_data['income_this_month'] = $income_this_month;
        $this->page_data['income_last_month'] = $income_last_month;
        $this->page_data['deposit_current_status'] = $current_status;
        $this->page_data['deposit_total_amount'] = $total_deposit;
        $this->page_data['deposit_transaction_count'] = $deposit_transaction_count;
        $this->page_data['graph_data'] = "[" . $this->graph_data_to_text($graph_data) . "]";

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['invoices'] = $this->invoice_model->getAllData($company_id);
        $this->page_data['page_title'] = "Invoices";
        // print_r($this->page_data);
        $this->load->view('accounting/invoices', $this->page_data);
    }

    public function inv_number_details()
    {
        $id = $this->input->post('id');

        $this->load->model('AcsProfile_model');
        $this->load->model('Clients_model');

        $invoice = $this->invoice_model->getinvoice($id);

        $customer = $this->accounting_customers_model->get_customer_by_id($invoice->customer_id);
        //  $client   = $this->Clients_model->getById($company_id);

        $item = $this->invoice_model->getInvoiceItems($invoice->id);

        $this->page_data['invoices'] = $invoice;
        $this->page_data['customers'] = $customer;
        $this->page_data['items'] = $item;
        // $this->page_data['client'] = $client;

        echo json_encode($this->page_data);
    }

    public function customers()
    {
        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            "assets/css/accounting/customers.css",
            "assets/css/accounting/accounting_includes/create_statement_modal.css",
            "assets/css/accounting/accounting_includes/time_activity.css",
            "assets/css/accounting/accounting_includes/create_invoice.css",
            "assets/css/accounting/accounting_includes/customer_types.css",
            "assets/css/accounting/accounting_includes/customer_single_modal.css",
        ));
        add_footer_js(array(
            "assets/js/accounting/sales/customers.js",
            "assets/js/accounting/sales/customer_includes/send_reminder.js",
            "assets/js/accounting/sales/customer_includes/create_statement_modal.js",
            "assets/js/accounting/sales/customer_includes/create_estimate.js",
            "assets/js/accounting/sales/customer_includes/time_activity.js",
            "assets/js/accounting/sales/customer_includes/create_invoice.js",
            "assets/js/accounting/sales/customer_includes/customer_types.js",
            "assets/js/accounting/sales/customer_includes/export_table.js",
            "assets/js/accounting/sales/customer_includes/customer_single_modal.js",
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js'
        ));

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        $this->page_data['page_title'] = "Customers";
        $this->page_data['accounting_timesheet_settings'] = $this->accounting_customers_model->get_accounting_timesheet_settings(logged("company_id"));

        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        $terms = $this->accounting_terms_model->getCompanyTerms_a(logged('company_id'));
        $this->page_data['number'] = $this->invoice_model->getlastInsert();

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
            $this->page_data['terms'] = $terms;
        }

        $this->load->view('accounting/customers', $this->page_data);
    }

    public function deposits()
    {
        $company_id = getLoggedCompanyID();

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Deposits";
        $this->page_data['clients'] = $this->invoice_model->getclientsData(logged('company_id'));
        $this->page_data['invoices'] = $this->invoice_model->getPaidInv($company_id);
        $this->load->view('accounting/deposits', $this->page_data);
    }

    public function addBankAccount()
    {
        if ($this->input->post('method') == "paypal") {
            $new_data = array(
                'paypal_email' => $this->input->post('email'),
                'payment_method' => $this->input->post('method'),
                'status' => 1,
                'created' => date('Y-m-d h:i:s'),
                'modified' => date('Y-m-d h:i:s')
            );
        } elseif ($this->input->post('method') == "stripe") {
            $new_data = array(
                'stripe_publish_key' => $this->input->post('publish_key'),
                'stripe_secret_key' => $this->input->post('secret_key'),
                'stripe_email' => $this->input->post('stripe_email'),
                'payment_method' => $this->input->post('method'),
                'status' => 1,
                'created' => date('Y-m-d h:i:s'),
                'modified' => date('Y-m-d h:i:s')
            );
        }
        $addQuery = $this->accounting_bank_accounts->create($new_data);

        if ($addQuery > 0) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    // private function uploadFile($files)
    // {
    //     $this->load->helper('string');
    //     $data = [];
    //     foreach($files['name'] as $key => $name) {
    //         $extension = end(explode('.', $name));

    //         do {
    //             $randomString = random_string('alnum');
    //             $fileNameToStore = $randomString . '.' .$extension;
    //             $exists = file_exists('./uploads/accounting/attachments/'.$fileNameToStore);
    //         } while ($exists);

    //         $fileType = explode('/', $files['type'][$key]);
    //         $uploadedName = str_replace('.'.$extension, '', $name);

    //         $data[] = [
    //             'company_id' => getLoggedCompanyID(),
    //             'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
    //             'uploaded_name' => $uploadedName,
    //             'stored_name' => $fileNameToStore,
    //             'file_extension' => $extension,
    //             'size' => $files['size'][$key],
    //             'notes' => null,
    //             'status' => 1,
    //             'created_at' => date('Y-m-d h:i:s'),
    //             'updated_at' => date('Y-m-d h:i:s')
    //         ];

    //         move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$fileNameToStore);
    //     }

    //     $insert = $this->accounting_attachments_model->insertBatch($data);

    //     return $insert;
    // }
    public function jobs()
    {
        add_css(array(
            'assets/css/accounting/jobs.css',
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Jobs";
        // $this->page_data['jobs'] = $this->accounting_invoices_model->getDataInvoices();
        $this->page_data['jobs'] = $this->jobs_model->get_all_jobs();
        $this->load->view('accounting/jobs', $this->page_data);
    }

    public function printSalesReceipt($id)
    {
        $this->page_data['users'] = $this->accounting_sales_receipt_model->getsalesReceiptsItems($id);
        $this->page_data['clients'] = $this->accounting_sales_receipt_model->getclientsData(logged('company_id'));

        $this->load->view('accounting/printSalesReceipt', $this->page_data);
    }

    public function invoice_edit($id)
    {
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) {
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        // $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $terms = $this->accounting_terms_model->getCompanyTerms_a($comp_id);

        $this->page_data['invoice'] = $this->invoice_model->getinvoice($id);
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->invoice_model->getInvoiceItems($id);
        $this->page_data['terms'] = $terms;
        // print_r($this->page_data['invoice']);

        $this->load->view('accounting/invoice_edit', $this->page_data);
    }

    public function addQuote()
    {
        $comp_id = logged('company_id');
        $user_id = logged('id');

        $new_data = array(
            'general_industry' => $this->input->post('general_industry'),
            'type_of_business' => $this->input->post('type_of_business'),
            'classification' => $this->input->post('classification'),
            'business_name' => $this->input->post('business_name'),
            'business_address' => $this->input->post('business_address'),
            'suite' => $this->input->post('suite'),
            'year_started' => $this->input->post('year_started'),
            'legal_entity_type' => $this->input->post('legal_entity_type'),
            'federal_identification_number' => $this->input->post('federal_identification_number'),
            'created_by' => logged('id'),
            'company_id' => $comp_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->account_model->createQuoteBusiness($new_data);

        $new_data = array(
            'total_est_annual_payroll' => $this->input->post('total_est_annual_payroll'),
            'payroll_frequency' => $this->input->post('payroll_frequency'),
            'quote_business' => $addQuery,
            'company_id' => $comp_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery2 = $this->account_model->createQuoteManagement($new_data);

        $a = $this->input->post('name');
        $b = $this->input->post('role');
        $c = $this->input->post('class_code');
        $d = $this->input->post('annual_payroll');
        $e = $this->input->post('ownership');

        $i = 0;
        foreach ($a as $row) {
            $data['name'] = $a[$i];
            $data['role'] = $b[$i];
            $data['class_code'] = $c[$i];
            $data['annual_payroll'] = $d[$i];
            $data['ownership'] = $e[$i];
            $data['quote_management_id'] = $addQuery2;
            // $data['created_at'] = date("Y-m-d H:i:s");
            // $data['updated_at'] = date("Y-m-d H:i:s");
            $addQuery3 = $this->account_model->createQuoteEmployees($data);
            $i++;
        }

        $new_data = array(
            'fname' => $this->input->post('total_est_annual_payroll'),
            'lname' => $this->input->post('payroll_frequency'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'requested_policy_start_date' => $this->input->post('requested_policy_start_date'),
            'quote_business' => $addQuery,
            'company_id' => $comp_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery3 = $this->account_model->createQuoteContacts($new_data);


        $this->load->view('accounting/workers-comp');
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

    public function workerscomp()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/workers_comp', $this->page_data);
    }

    public function reports()
    {
        add_css([
            'assets/css/accounting/reports/management_reports.css'
        ]);

        add_footer_js([
            'assets/js/accounting/reports/management_reports.js'
        ]);
        $this->load->model('accounting_customers_model');
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));
        ;
        // var_dump($this->page_data['management_reports']);
        $this->load->view('accounting/reports', $this->page_data);
    }
    public function get_management_report()
    {
        $management_report_id = $this->input->post("management_report_id");
        $management_report=$this->accounting_management_reports->get_management_reports_by_id($management_report_id);
        $preliminary_pages=$this->accounting_management_reports->get_management_reports_preliminary_pages_by_id($management_report_id);
        $reports=$this->accounting_management_reports->get_reports_by_management_report_id($management_report_id);

        $data = new stdClass();
        $data->	created_by = $management_report->created_by;
        $data->template_name = $management_report->template_name;
        $data->report_period = $management_report->report_period;
        $data->cover_show_logo = $management_report->cover_show_logo;
        $data->cover_style = $management_report->cover_style;
        $data->cover_title = $management_report->cover_title;
        $data->cover_subtitle = $management_report->cover_subtitle;
        $data->cover_report_period = $management_report->cover_report_period;
        $data->cover_prepared_by = $management_report->cover_prepared_by;
        $data->cover_prepared_date = $management_report->cover_prepared_date;
        $data->cover_disclaimer = $management_report->cover_disclaimer;
        $data->table_include_table_of_contents = $management_report->table_include_table_of_contents;
        $data->table_page_title = $management_report->table_page_title;
        $data->endnotes_include_page = $management_report->endnotes_include_page;
        $data->endnotes_break_down = $management_report->endnotes_break_down;
        $data->endnote_page_title = $management_report->endnote_page_title;
        $data->endnote_page_content = $management_report->endnote_page_content;
        $data->status = $management_report->status;
        $data->date_created	 = $management_report->date_created;
        $data->date_updated = $management_report->date_updated;
        $data->updated_by = $management_report->updated_by;
        $data->preliminary_pages_ctr = count($preliminary_pages);
        $data->reports_ctr = count($reports);
        
        echo json_encode($data);
    }
    public function update_management_report()
    {
        $management_report_id = $this->input->post("management_report_id");
        $cover_show_logo = 0;
        if($this->input->post("show-logo") == "on"){
            $cover_show_logo = 1;
        }
        $include_table_of_contents=0;
        if($this->input->post("include_table_of_contents") == "on"){
            $include_table_of_contents=1;
        }
        $end_notes_include_this_page =0;
        if($this->input->post("end_notes_include_this_page") == "on"){
            $end_notes_include_this_page =1;
        }
        $end_notes_include_breakdown_of_sub_accounts=0;
        if($this->input->post("end_notes_include_breakdown_of_sub_accounts") == "on"){
            $end_notes_include_breakdown_of_sub_accounts=1;
        }
        $data = array(
            "company_id" =>logged("company_id"),
            "template_name" =>$this->input->post("template_name"),
            "report_period" =>$this->input->post("template_report_period"),
            "cover_style" =>$this->input->post("cover_style"),
            "cover_show_logo" =>$cover_show_logo,
            "cover_title" =>$this->input->post("cover_page_cover_title"),
            "cover_subtitle" =>$this->input->post("cover_page_subtitle"),
            "cover_report_period" =>$this->input->post("cover_page_report_period"),
            "cover_prepared_by" =>$this->input->post("cover_page_prepared_by"),
            "cover_prepared_date" =>$this->input->post("cover_page_prepared_date"),
            "cover_disclaimer" =>$this->input->post("cover_page_disclaimer"),
            "table_include_table_of_contents" =>$include_table_of_contents,
            "table_page_title" =>$this->input->post("table_of_contents_page_title"),
            "endnotes_include_page" =>$end_notes_include_this_page,
            "endnotes_break_down" =>$end_notes_include_breakdown_of_sub_accounts,
            "endnote_page_title" =>$this->input->post("end_notes_page_title"),
            "endnote_page_content" =>$this->input->post("end_notes_page_content"),
            "status" =>1,
            "date_updated" =>date("Y-m-d h:s:i"),
            "updated_by" =>logged("id"),
        );
        $this->accounting_management_reports->update_management_report($data,$management_report_id);



        $deleted_report_pages=explode(",",$this->input->post("deleted_reports_pages"));
        $deleted_preliminary_pages=explode(",",$this->input->post("deleted_preliminary_pages"));
        
        for($i=0;$i<count($deleted_report_pages);$i++){
            $report_id =  $deleted_report_pages[$i];
            if($report_id!=""){
                $this->accounting_management_reports->delete_report_page($management_report_id, $report_id);
            }
        }
        for($i=0;$i<count($deleted_preliminary_pages);$i++){
            $preliminary_id =  $deleted_preliminary_pages[$i];
            if($preliminary_id!=""){
                $this->accounting_management_reports->delete_preliminary_page( $preliminary_id);
            }
        }


        $preliminary_content = $this->input->post("prelimenary_page_content");
        $include_this_page = $this->input->post("input_include_this_page");
        $preliminary_page_title = $this->input->post("preliminary_page_title");
        $preliminary_page_ids = $this->input->post("preliminary_page_ids");
            for($i = 0; $i < count($preliminary_content);$i++){
                $id=$preliminary_page_ids[$i];
                
                $data = array(
                    "management_report_id"=>$management_report_id,
                    "include_this_page"=>$include_this_page[$i],
                    "page_title"=>$preliminary_page_title[$i],
                    "page_content"=>$preliminary_content[$i],
                    "date_updated"=>date("Y-m-d h:i:s"),
                );
                $success=$this->accounting_management_reports->update_preliminary_page($data,$id);
                if(!$success){
                    $data["date_created"]=date("Y-m-d h:i:s");
                    $this->accounting_management_reports->insert_preliminary_page($data);
                }
            }
        
        $report_type = $this->input->post("report_type");
        $report_title = $this->input->post("report_title");
        $report_period = $this->input->post("report_period");
        $report_compare_prev_year = $this->input->post("input_report_compare_prev_year");
        $report_compare_prev_period = $this->input->post("input_report_compare_prev_period");
        $management_report_report_ids = $this->input->post("management_report_report_ids");
        if($report_type != ""){
            for($i =0; $i < count($report_type);$i++ ){
                $report_id=$management_report_report_ids[$i];
                
                $data=array(
                    "management_report_id"=>$management_report_id,
                    "report_page_type"=>$report_type[$i],
                    "report_page_title"=>$report_title[$i],
                    "report_page_period"=>$report_period[$i],
                    "report_page_compare_prev_year"=>$report_compare_prev_year[$i],
                    "report_page_compare_prev_period"=>$report_compare_prev_period[$i],
                    "date_updated"=>date("Y-m-d h:i:s"),
                );
                $success=$this->accounting_management_reports->update_reports($data,$report_id);
                if(!$success){
                    $data["date_created"]=date("Y-m-d h:i:s");
                    $this->accounting_management_reports->insert_report($data);
                }
            }
        }else{
            $this->accounting_management_reports->delete_reports_by_management_report_id($management_report_id);
        }

        $this->create_cover_page_pdf_template();
        $data = new stdClass();
        $data->result = "success";
        echo json_encode($data);
    }

    
    public function create_cover_page_pdf_template()
    {
        $management_report_id = $this->input->post("management_report_id");
        $management_report = $this->accounting_management_reports->get_management_reports_by_id($management_report_id);
        $this->page_data["management_report"]=$management_report;
        $filename = "management_report_cover_page".$management_report_id.".pdf";
        $this->load->library('pdf');
        $this->pdf->save_pdf('accounting/reports/management_reports/cover_page_template', $this->page_data, $filename, "P");
        // echo json_encode("success");





            
        // $invoice_id = $this->input->post("invoice_id");
        // $customer_id = $this->input->post("customer_id");
        // $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        // $user_info = $this->users_model->getUserById(logged("id"));

        // $invoice = get_invoice_by_id($invoice_id);
        // $user = get_user_by_id(logged('id'));
        // $this->page_data['invoice'] = $invoice;
        // $this->page_data['user'] = $user;
        // // $this->page_data['items'] = $user;
        // $this->page_data['items'] = $this->invoice_model->getItemsInv($invoice_id);
        // $this->page_data['users'] = $this->invoice_model->getInvoiceCustomer($invoice_id);

        // if (!empty($invoice)) {
        //     foreach ($invoice as $key => $value) {
        //         if (is_serialized($value)) {
        //             $invoice->{$key} = unserialize($value);
        //         }
        //     }
        //     $this->page_data['invoice'] = $invoice;
        //     $this->page_data['user'] = $user;
        // }
        // $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
        // $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
        // $filename = "nSmarTrac_invoice_".$invoice_id.".pdf";
        // $this->load->library('pdf');
        // $this->pdf->save_pdf('accounting/reports/management_reports/cover_page_template', $this->page_data, $filename, "P");

        // $data = new stdClass();
        // $data->business_name = $customer_info->business_name;
        // $data->business_email = $customer_info->business_email;
        // $data->acs_email = $customer_info->acs_email;
        // $data->firstname = $customer_info->first_name;
        // $data->lastname = $customer_info->last_name;
        // $data->user_email = $user_info->email;
        // $data->filelocation = base_url("assets/pdf/".$filename."") ;
        // echo json_encode($data);
    }

    public function managenent_report_delete_preliminary_page()
    {
        $preliminary_page_id = $this->input->post("preliminary_page_id");
        $this->accounting_management_reports->delete_preliminary_page($preliminary_page_id);

        $data = new stdClass();
        $data->result = "success";
        echo json_encode($data);
    }
    public function managenent_report_delete_report_page()
    {
        $management_report_id = $this->input->post("management_report_id");
        $report_id = $this->input->post("report_id");
        $this->accounting_management_reports->delete_report_page($management_report_id,$report_id);
        $data = new stdClass();
        $data->result = "success";
        echo json_encode($data);
    }

    public function management_report_add_prelim_page_html()
    {
        if($this->input->post("count") == 0){
            $this->page_data['data_count'] = $this->input->post("data_count");
            $this->page_data['prelim_pages']=null;
        }else{
            $this->page_data['prelim_pages'] = $this->accounting_management_reports->get_management_reports_preliminary_pages_by_id( $this->input->post("management_report_id"));
        }

        $new_page =$this->load->view('accounting/reports/management_reports/preliminary_pages', $this->page_data, true);
        $data = new stdClass();
        $data->new_page = $new_page;
        echo json_encode($data);
    }
    public function management_report_add_new_report_section_html()
    {
        if($this->input->post("count") == 0){
            $this->page_data['data_count'] = $this->input->post("data_count");
            $this->page_data['report_pages']=null;
        }else{
            $this->page_data['report_pages'] = $this->accounting_management_reports->get_report_pages_by_maagement_report_id($this->input->post("management_report_id"));
        }
        $new_report =$this->load->view('accounting/reports/management_reports/new_report_secitons', $this->page_data, true);
        $data = new stdClass();
        $data->new_report = $new_report;
        echo json_encode($data);
    }

    public function aging_summary_report()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomersInv();
        $this->page_data['page_title'] = "A/R Aging Summary Report";
        
        add_css([
            'assets/css/accounting/account_receivable/account_receivable.css'
        ]);

        add_footer_js([
            'assets/js/accounting/account_receivable/account_receivable.js',

            // download
            'assets/js/accounting/banking/rules/libs/download/download.min.js',

            // print
            'https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js',
            'https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js',

            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
        ]);

        $this->load->view('accounting/reports/aging_summary_report', $this->page_data);
    }

    public function balance_sheet()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Balance Sheet Report";
        $this->load->view('accounting/reports/balance_sheet', $this->page_data);
    }

    public function profit_and_loss()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Profit and Loss Report";
        $this->load->view('accounting/reports/profit_and_loss', $this->page_data);
    }

    public function balance_sheet_comparison()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Balance Sheet Comparison Report";
        $this->load->view('accounting/reports/balance_sheet_comparison', $this->page_data);
    }

    public function audit_log_report()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Balance Sheet Comparison Report";
        $this->load->view('accounting/reports/audit_log', $this->page_data);
    }

    public function balance_sheet_detail()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Balance Sheet Comparison Report";
        $this->load->view('accounting/reports/balance_sheet_detail', $this->page_data);
    }

    public function balance_sheet_summary()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Balance Sheet Comparison Report";
        $this->load->view('accounting/reports/balance_sheet_summary', $this->page_data);
    }

    public function business_snapshot()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Business Snapshot";
        $this->load->view('accounting/reports/business_snapshot', $this->page_data);
    }

    /* payscale */

    public function employeeinfo()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/employeeinfoReport', $this->page_data);
    }

    public function deleteVendor()
    {
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
        $id = $this->input->post('id');
        $new_data = array(
            'status' => 0,
            'date_modified' => date("Y-m-d H:i:s")
        );

        $editQuery = $this->vendors_model->update($id, $new_data);

        if ($editQuery > 0) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function editVendor()
    {
        $id = $this->input->post('id');
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
            'tax_id' => $this->input->post('business_number'),
            'default_expense_account' => $this->input->post('default_expense_amount'),
            'notes' => $this->input->post('notes'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $editQuery = $this->vendors_model->updateVendorWithVendorID($id, $new_data);

        if ($editQuery) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function createBill()
    {
        $id = logged('id');
        $filePath = "uploads/accounting/vendors/bill/" . $id;
        $file_name = "";

        if (!file_exists($filePath)) {
            mkdir($filePath);
        }

        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|pdf|xlx|xls|csv';
        $config['max_size'] = '20000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachFiles')) {
            $image = $this->upload->data();
            $file_name = $image['file_name'];
        }

        $config = $this->uploadlib->initialize($config);
        $this->load->library('upload', $config);

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

        if ($addQuery > 0) {
            echo json_encode(1);
        } else {
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

        if ($addQuery > 0) {
            $new_id = $addQuery;
            $term_id = mb_substr($this->input->post('term_name'), 0, 3) . $new_id;
            $updateQuery = $this->terms_model->update($new_id, array("term_id" => $term_id));

            if ($updateQuery > 0) {
                echo json_encode($updateQuery);
            }
        } else {
            echo json_encode(0);
        }
    }

    /*** Expenses ***/

    public function timeActivity()
    {
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
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addBill()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        $transaction = array(
            'type' => 'Bill',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);


        $new_data = array(
            'transaction_id' => $fquery,
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'total_amount' => $this->input->post('total_amount'),
            'attachments' => 'testing 2',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );


        $query = $this->expenses_model->addBill($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '1';
                $data['ven_type_id'] = $query;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category'] = $aa[$f];
                $data2['description'] = $bb[$f];
                $data2['amount'] = $cc[$f];
                $data2['type'] = 'Bill';
                $data2['type_id'] = $query;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function addBillpay()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        // $product['id'] = "1";
        // $product['prod'] = $this->input->post('prod');
        // $product['desc'] = $this->input->post('desc');
        // $product['qty'] = $this->input->post('qty');
        // $product['rate'] = $this->input->post('rate');
        // $product['amount'] = $this->input->post('amount');
        // $product['tax'] = $this->input->post('tax');
        // $prod[] = $product;


        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'bal_due' => $this->input->post('bal_due'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname'),

            'attachments' => 'testing 2',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );


        $query = $this->expenses_model->addBill($new_data);

        $new_data2[] = array(
            'category' => 'testing 2',
            'description' => 1,
            'amount' => $user_id,
        );

        foreach ($new_data2 as $datas => $data) {
            $category = $data['username'];
            $description = $data['description'];
            $amount = $data['amount'];
            $status = '1';
            $bill_id = $query;
            $date_created = date("Y-m-d H:i:s");
            $date_modified = date("Y-m-d H:i:s");

            $query = $this->expenses_model->addBillcategory($new_data);
        }


        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function getBillData()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $bills = $this->db->get_where('accounting_bill', array('id' => $id));
        $vendors = $this->db->get_where('accounting_vendors', array('vendor_id' => $bills->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id' => $id, 'transaction_id' => $transaction_id));

        $data = new stdClass();
        $data->vendor_id = $vendors->row()->vendor_id;
        $data->bill_id = $bills->row()->id;
        $data->vendor_name = $vendors->row()->f_name . '&nbsp;' . $vendors->row()->l_name;
        $data->address = $bills->row()->mailing_address;
        $data->terms = $bills->row()->terms;
        $data->bill_date = $bills->row()->bill_date;
        $data->due_date = $bills->row()->due_date;
        $data->bill_number = $bills->row()->bill_number;
        $data->permit_number = $bills->row()->permit_number;
        $data->memo = $bills->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0) ? true : false;
        echo json_encode($data);
    }
    public function editBillData()
    {
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
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteBillData()
    {
        $id = $this->input->post('id');
        $query = $this->expenses_model->deleteBillData($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    /*** Attachment for Expense Transaction***/
    public function expensesTransactionAttachment()
    {
        if (!empty($_FILES)) {
            $config = array(
                'upload_path' => './uploads/accounting/expenses/',
                'allowed_types' => '*',
                'overwrite' => true,
                'max_size' => '20000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")) {
                $uploadData = $this->upload->data();
                $data = array('attachment' => $uploadData['file_name']);
                $this->db->insert('accounting_expense_attachment', $data);
                echo json_encode($uploadData['file_name']);
            }
        }
    }

    public function removeTransactionAttachment()
    {
        $file = $this->input->post('name');
        $index = $this->input->post('index');
        if ($file && file_exists($this->expenses_path . $file[$index])) {
            unlink($this->expenses_path . $file[$index]);
            $this->db->where('attachment', $file[$index]);
            $this->db->delete('accounting_expense_attachment');
        }
    }

    public function displayListAttachment()
    {
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $attachments = $this->expenses_model->getAttachment();
        $display = '';
        foreach ($attachments as $attachment) {
            $tooltip = ($attachment->status == 0) ? "tooltip" : "";
            $cross_out = ($attachment->status == 0) ? "cross-out" : "";
            $exclamation = ($attachment->status == 0) ? "fa-times fa-exclamation-triangle" : "fa-times";
            $tipbox = ($attachment->status == 0) ? "tooltiptext" : "tooltiptext hide";
            $file = $attachment->attachment;
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            switch ($extension) {
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
            if ($attachment->expenses_id == $id && $attachment->type == $type) {
                $display .= '<div class="file-name-section">';
                $display .= '<span class="previewAttachment ' . $cross_out . '">' . $attachment->original_filename . '</span>';
                $display .= '<span class="previewAttachmentImage"><img src="/uploads/accounting/expenses/' . $file . '">.' . $extension . '</span>';
                $display .= '<a href="#" class="' . $tooltip . '" id="removeAttachment" data-id="' . $attachment->id . '" data-status="' . $attachment->status . '"><i class="fa ' . $exclamation . '"></i></a>';
                $display .= '<span class="' . $tipbox . '">This file is temporarily removed.</br> You can retrieve it by clicking the </br>exclamation icon "<i class="fa fa-exclamation-triangle"></i>". </span>';
                $display .= '<input type="hidden" name="attachment_id" id="attachmentId" value="' . $attachment->id . '">';
                $display .= '</div>';
            }
        }
        echo json_encode($display);
    }

    public function removeTemporaryAttachment()
    {
        $id = $this->input->post('attach_id');
        $status = $this->input->post('status');

        $query = $this->db->get_where('accounting_expense_attachment', array('id' => $id));
        if ($query->num_rows() == 1 && $status == 1) {
            $status = array(
                'status' => 0
            );
            $this->db->where('id', $id);
            $this->db->update('accounting_expense_attachment', $status);
            echo json_encode(0);
        } elseif ($query->num_rows() == 1 && $status == 0) {
            $status = array(
                'status' => 1
            );
            $this->db->where('id', $id);
            $this->db->update('accounting_expense_attachment', $status);
            echo json_encode(1);
        }
    }

    public function removePermanentlyAttachment()
    {
        $attachment_id = $this->input->post('attachment_id');
        for ($x = 0; $x < count($attachment_id); $x++) {
            $get_filename = $this->db->get_where('accounting_expense_attachment', array('id' => $attachment_id[$x]));
            unlink($this->expenses_path . $get_filename->row()->attachment);
            $this->db->where('id', $attachment_id[$x]);
            $this->db->delete('accounting_expense_attachment');
        }
    }

    public function addingFileAttachment()
    {
        $transaction_id = $this->input->post('transaction_id');
        $transaction_from_id = $this->input->post('trans_from_id');
        $file_id = $this->input->post('file_id');
        $id = $this->input->post('expenses_id');
        $type = $this->input->post('type');
        $get_attachment_id = $this->db->get_where('accounting_expense_attachment', array('id' => $file_id));
        $file_name = $get_attachment_id->row()->attachment;
        $original_fname = $this->input->post('original_fname');
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $encryption = md5(time()) . '.' . $extension;
        copy('./uploads/accounting/expenses/' . $file_name, './uploads/accounting/expenses/' . $encryption);
        $data = array(
            'transaction_id' => $transaction_id,
            'expenses_id' => $id,
            'type' => $type,
            'original_filename' => $original_fname,
            'attachment' => $encryption,
            'date_created' => date('Y-m-d H:i:s'),
            'status' => 1
        );
        $this->db->insert('accounting_expense_attachment', $data);
        $new_attachment_id = $this->db->insert_id();

        $added = array(
            'attachment_id' => $new_attachment_id,
            'attachment_from_id' => $get_attachment_id->row()->id,
            'trans_from_id' => $transaction_from_id,
            'expenses_type' => $type,
            'expenses_id' => $id,
            'date_created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('accounting_existing_attachment', $added);
        echo json_encode($id);
    }

    public function deleteTemporaryAttachment()
    {
        $attachments = $this->expenses_model->getAttachment();
        $result = null;
        foreach ($attachments as $attachment) {
            if ($attachment->transaction_id == 0) {
                unlink($this->expenses_path . $attachment->attachment);
            }
        }
        $this->db->where('transaction_id', 0);
        $this->db->delete('accounting_expense_attachment');
        echo json_encode($result);
    }

    public function showExistingFile()
    {
        $expense_id = $this->input->get('expenses_id');
        $type = $this->input->get('type');
        $transaction_id = $this->input->get('transaction_id');
        $attachments = $this->expenses_model->getAttachmentById($transaction_id);
        $disabled = null;
        $display = '';
        foreach ($attachments as $attachment) {
            $added = $this->expenses_model->getAddedAttachment($attachment->id, $expense_id, $type);
            if ($added == true) {
                $status = 'Added';
                $disabled = 'isDisabled';
            } else {
                $status = 'Add';
                $disabled = null;
            }


            $preview = "";
            if ($type == 'Check') {
                $preview = "-check";
            } elseif ($type == 'Bill') {
                $preview = "-bill";
            } elseif ($type == 'Expense') {
                $preview = "-expense";
            } elseif ($type == 'Vendor Credit') {
                $preview = "-vc";
            }
            $file = $attachment->attachment;
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            switch ($extension) {
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
            $display .= '<span>' . $attachment->original_filename . '</span>';
            $display .= '<img src="/uploads/accounting/expenses/' . $file . '" alt="Existing File" style="width: 250px;height: 150px;margin-bottom: 10px">';
            $display .= '<input type="hidden" id="attachmentType" value="' . $type . '">';
            $display .= '<input type="hidden" id="attachmentTypePreview" value="' . $preview . '">';
            $display .= '<input type="hidden" id="attachmentTransId" value="' . $transaction_id . '">';
            $display .= '<input type="hidden" id="attachTransFromId" value="' . $attachment->transaction_id . '">';
            $display .= '<input type="hidden" id="attachmentExpensesId" value="' . $expense_id . '">';
            $display .= '<a href="#" class="' . $disabled . '" id="addingFileAttachment" data-id="' . $attachment->id . '" data-fname="' . $attachment->original_filename . '" >' . $status . '</a>';
            $display .= '</div>';
            $display .= '<hr>';
        }

        echo json_encode($display);
    }

    public function rowCategories()
    {
        $transaction_id = $this->input->get('transaction_id');
        $row = $this->input->get('row');
        $cat_class = $this->input->get('cat_class');
        $des_class = $this->input->get('des_class');
        $amount_class = $this->input->get('amount_class');
        $counter = $this->input->get('counter');
        $remove = $this->input->get('remove_id');
        $select = $this->input->get('select');
        $preview = $this->input->get('preview');
        $get_categories = $this->db->get_where('accounting_expense_category', array('transaction_id' => $transaction_id));
        $result = $get_categories->result();
        $categories = '';
        $category_list = $this->categories_model->getCategories();
        if ($get_categories->num_rows() >= 2) {
            foreach ($result as $cnt => $data) {
                $category = ($data->category_id != null) ? $data->category_id : "";
                $description = ($data->description != null) ? $data->description : "";
                $amount = ($data->amount != null) ? $data->amount : 0;
                $cnt += 1;
                $categories .= '<tr id="' . $row . '">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="' . $counter . '">' . $cnt . '</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="' . $data->id . '">';
                        $categories .= '<span id="category-preview' . $preview . '">' . $list->category_name . '</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id' . $preview . '" class="form-control ' . $cat_class . ' ' . $select . '">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<option value="' . $list->id . '" selected>' . $list->category_name . '</option>';
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
                $categories .= '<td><span id="description-preview' . $preview . '">' . $description . '</span>';
                $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id' . $preview . '" class="form-control ' . $des_class . '" value="' . $description . '"  ></div>';
                $categories .= '</td>';
                $categories .= '<td><span id="amount-preview' . $preview . '">' . $amount . '</span>';
                $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id' . $preview . '" class="form-control ' . $amount_class . '" value="' . $amount . '" ></div>';
                $categories .= '</td>';
                $categories .= '<td style="text-align: center"><a href="#" id="' . $remove . '"><i class="fa fa-trash"></i></a></td>';
                $categories .= '</tr>';
            }
        } else {
            foreach ($result as $cnt => $data) {
                $category = ($data->category_id != null) ? $data->category_id : "";
                $description = ($data->description != null) ? $data->description : "";
                $amount = ($data->amount != null) ? $data->amount : 0;
                $cnt += 1;
                $categories .= '<tr id="' . $row . '">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="' . $counter . '">' . $cnt . '</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="' . $data->id . '">';
                        $categories .= '<span id="category-preview' . $preview . '">' . $list->category_name . '</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id' . $preview . '" class="form-control ' . $cat_class . ' ' . $select . '">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<option value="' . $list->id . '" selected>' . $list->category_name . '</option>';
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
                $categories .= '<td><span id="description-preview' . $preview . '">' . $description . '</span>';
                $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id' . $preview . '" class="form-control ' . $des_class . '" value="' . $description . '"  ></div>';
                $categories .= '</td>';
                $categories .= '<td><span id="amount-preview' . $preview . '">' . $amount . '</span>';
                $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id' . $preview . '" class="form-control ' . $amount_class . '" value="' . $amount . '" ></div>';
                $categories .= '</td>';
                $categories .= '<td style="text-align: center"><a href="#" id="' . $remove . '"><i class="fa fa-trash"></i></a></td>';
                $categories .= '</tr>';
            }
            $description = "";
            $amount = 0;
            $cnt = 2;
            $categories .= '<tr id="' . $row . '">';
            $categories .= '<td></td>';
            $categories .= '<td><span id="' . $counter . '">' . $cnt . '</span></td>';
            $categories .= '<td>';
            $categories .= '<div id="" style="display:none;">';
            $categories .= '<input type="hidden" id="prevent_process" value="true">';
            $categories .= '<select name="category[]" id="category-id' . $preview . '" class="form-control ' . $cat_class . ' ' . $select . '">';
            $categories .= '<option></option>';
            //            $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
            //            foreach ($category_list as $list){
            //                $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
            //            }
            $categories .= '</select>';
            $categories .= ' </div>';
            $categories .= '</td>';
            $categories .= '<td><span id="description-preview' . $preview . '">' . $description . '</span>';
            $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id' . $preview . '" class="form-control ' . $des_class . '" value="' . $description . '"  ></div>';
            $categories .= '</td>';
            $categories .= '<td><span id="amount-preview' . $preview . '"></span>';
            $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id' . $preview . '" class="form-control ' . $amount_class . '" value="' . $amount . '" ></div>';
            $categories .= '</td>';
            $categories .= '<td style="text-align: center"><a href="#" id="' . $remove . '"><i class="fa fa-trash"></i></a></td>';
            $categories .= '</tr>';
        }

        echo json_encode($categories);
    }

    public function defaultCategoryRow()
    {
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
        for ($x = 1; $x <= 2; $x++) {
            $default .= '<tr id="' . $row . '">';
            $default .= '<td></td>';
            $default .= '<td><span id="' . $counter . '">' . $x . '</span></td>';
            $default .= '<td>';
            $default .= '<span id="category-preview' . $preview . '"></span>';
            $default .= '<div id="" style="display:none;">';
            $default .= '<input type="hidden" id="prevent_process" value="true">';
            $default .= '<select name="category[]" id="category-id' . $preview . '" class="form-control ' . $cat_class . ' ' . $select . '">';
            $default .= '<option></option>';
            //            $default .= '<option value="0" disabled id="add-expense-categories">&plus; Add Category</option>';
            //            foreach ($category_list as $list){
            //                $default .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
            //            }
            $default .= '</select>';
            $default .= '</div>';
            $default .= '</td>';
            $default .= '<td><span id="description-preview' . $preview . '"></span>';
            $default .= '<div style="display: none;"><input type="text" name="description[]" id="description-id' . $preview . '" class="form-control ' . $des_class . '" value=""></div>';
            $default .= '</td>';
            $default .= '<td><span id="amount-preview' . $preview . '"></span>';
            $default .= '<div style="display: none;"><input type="text" name="amount[]" id="amount-id' . $preview . '" class="form-control ' . $amount_class . '" value="0" ></div>';
            $default .= '</td>';
            $default .= '<td style="text-align: center"><a href="#" id="' . $remove . '"><i class="fa fa-trash"></i></a></td>';
            $default .= '</tr>';
        }
        echo json_encode($default);
    }

    public function getCheckData()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $query = $this->db->get_where('accounting_check', array(
            'id' => $id
        ));
        $vendors_detail = $this->db->get_where('accounting_vendors', array('vendor_id' => $query->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id' => $id, 'transaction_id' => $transaction_id));
        if ($query->row()->print_later == 1) {
            $print = true;
        } else {
            $print = false;
        }
        $std = new stdClass();
        $std->check_id = $id;
        $std->vendor_id = $query->row()->vendor_id;
        $std->vendor_name = $vendors_detail->row()->f_name . '&nbsp;' . $vendors_detail->row()->l_name;
        $std->bank_account = $query->row()->bank_id;
        $std->mailing = $query->row()->mailing_address;
        $std->payment_date = $query->row()->payment_date;
        $std->check_number = $query->row()->check_number;
        $std->print_later = $print;
        $std->permit_number = $query->row()->permit_number;
        $std->memo = $query->row()->memo;
        $std->check_category = ($check_category->num_rows() > 0) ? true : false;

        echo json_encode($std);
    }
    // public function addCheck(){
    //     $new_data = array(
    //         'vendor_id' => $this->input->post('vendor_id'),
    //         'mailing_address' => $this->input->post('mailing_address'),
    //         'bank_id' => $this->input->post('bank_account'),
    //         'payment_date' => $this->input->post('payment_date'),
    //         'check_num' => $this->input->post('check_number'),
    //         'print_later' => $this->input->post('print_later'),
    //         'permit_number' => $this->input->post('permit_number'),
    //         'memo' => $this->input->post('memo'),
    //         'category' => $this->input->post('category'),
    //         'description' => $this->input->post('description'),
    //         'amount' => $this->input->post('amount'),
    //      'total' => $this->input->post('total'),
    // 		'total' => $this->input->post('total'),
    //         'file_name' => $this->input->post('filename'),
    //         'original_fname' => $this->input->post('original_fname')
    //     );
    //     $query = $this->expenses_model->addCheck($new_data);
    //     if ($query == true){
    //         echo json_encode(1);
    //     }else{
    //         echo json_encode(0);
    //     }
    // }

    public function editCheckData()
    {
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
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteCheckData()
    {
        $id = $this->input->post('id');
        $this->expenses_model->deleteCheckData($id);
    }

    // public function addExpense(){
    //     $new_data = array(
    //         'vendor_id' => $this->input->post('vendor_id'),
    //         'payment_account' => $this->input->post('payment_account'),
    //         'payment_date' => $this->input->post('payment_date'),
    //         'payment_method' => $this->input->post('payment_method'),
    //         'ref_number' => $this->input->post('ref_number'),
    //         'permit_number' => $this->input->post('permit_number'),
    //         'memo' => $this->input->post('memo'),
    //         'category' => $this->input->post('category'),
    //         'description' => $this->input->post('description'),
    //         'amount' => $this->input->post('amount'),
    //         'total' => $this->input->post('total'),
    //         'file_name' => $this->input->post('filename'),
    //         'original_fname' => $this->input->post('original_fname')
    //     );
    //     $query = $this->expenses_model->addExpense($new_data);
    //     if ($query == true){
    //         echo json_encode(1);
    //     }else{
    //         echo json_encode(0);
    //     }
    // }
    public function getExpenseData()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_expense = $this->db->get_where('accounting_expense', array('id' => $id));
        $vendors = $this->db->get_where('accounting_vendors', array('vendor_id' => $get_expense->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id' => $id, 'transaction_id' => $transaction_id));


        $data = new stdClass();
        $data->vendor_id = $get_expense->row()->vendor_id;
        $data->vendor_name = $vendors->row()->f_name . '&nbsp;' . $vendors->row()->l_name;
        $data->expense_id = $id;
        $data->payment_account = $get_expense->row()->payment_account;
        $data->payment_date = $get_expense->row()->payment_date;
        $data->payment_method = $get_expense->row()->payment_method;
        $data->ref_number = $get_expense->row()->ref_number;
        $data->permit_number = $get_expense->row()->permit_number;
        $data->memo = $get_expense->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0) ? true : false;

        echo json_encode($data);
    }

    public function updateExpenseData()
    {
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
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteExpenseData()
    {
        $id = $this->input->post('id');
        $this->expenses_model->deleteExpenseData($id);
    }

    public function vendorCredit()
    {
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
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function getVendorCredit()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_vc = $this->db->get_where('accounting_vendor_credit', array('id' => $id));
        $vendors = $this->db->get_where('accounting_vendors', array('vendor_id' => $get_vc->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id' => $id, 'transaction_id' => $transaction_id));

        $data = new stdClass();
        $data->vc_id = $id;
        $data->vendor_id = $get_vc->row()->vendor_id;
        $data->vendor_name = $vendors->row()->display_name;
        $data->mailing_address = $get_vc->row()->mailing_address;
        $data->payment_date = $get_vc->row()->payment_date;
        $data->ref_number = $get_vc->row()->ref_number;
        $data->permit_number = $get_vc->row()->permit_number;
        $data->memo = $get_vc->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0) ? true : false;

        echo json_encode($data);
    }

    public function updateVendorCredit()
    {
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
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteVendorCredit()
    {
        $id = $this->input->post('id');
        $this->expenses_model->deleteVendorCredit($id);
    }

    public function showExpenseTransactionsTable()
    {
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
        foreach ($transactions as $transaction) :
            if ($transaction->type == 'Check') {
                // Check
                foreach ($checks as $check) {
                    if ($transaction->id == $check->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = $check->check_number;
                        $modal_id = "editCheck";
                        $data_id = $check->id;
                        $transaction_id = $check->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $check->vendor_id) {
                                $vendors_name = $vendor->f_name . " " . $vendor->l_name;
                                $delete = 'deleteCheck';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $check->transaction_id));
                        $check_category_id = ($get_category->num_rows() != 0) ? $get_category->row()->category_id : 0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $check_category_id) {
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            } elseif ($transaction->type == 'Bill') {
                //                                            Bill
                foreach ($bills as $bill) {
                    if ($transaction->id == $bill->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editBill";
                        $transaction_id = $bill->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $bill->vendor_id) {
                                $vendors_name = $vendor->f_name . " " . $vendor->l_name;
                                $data_id = $bill->id;
                                $delete = 'deleteBill';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $bill->transaction_id));
                        $bill_category_id = ($get_category->num_rows() != 0) ? $get_category->row()->category_id : 0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $bill_category_id) {
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            } elseif ($transaction->type == 'Expense') {
                //                                            Expense
                foreach ($expenses as $expense) {
                    if ($transaction->id == $expense->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editExpense";
                        $transaction_id = $expense->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $expense->vendor_id) {
                                $vendors_name = $vendor->f_name . " " . $vendor->l_name;
                                $data_id = $expense->id;
                                $delete = 'deleteExpense';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $expense->transaction_id));
                        $expense_category_id = ($get_category->num_rows() != 0) ? $get_category->row()->category_id : 0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $expense_category_id) {
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            } elseif ($transaction->type == 'Vendor Credit') {
                //                                            Vendor Credit
                foreach ($vendor_credits as $vendor_credit) {
                    if ($transaction->id == $vendor_credit->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $payee = $vendor_credit->vendor_id;
                        $number = null;
                        $modal_id = "editVendorCredit";
                        $transaction_id = $vendor_credit->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $vendor_credit->vendor_id) {
                                $vendors_name = $vendor->f_name . " " . $vendor->l_name;
                                $data_id = $vendor_credit->id;
                                $delete = 'deleteVendorCredit';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $vendor_credit->transaction_id));
                        $vc_category_id = ($get_category->num_rows() != 0) ? $get_category->row()->category_id : 0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $vc_category_id) {
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
        $show .= '<td id="' . $modal_id . '" data-id="' . $data_id . '" data-transId="' . $transaction_id . '">' . $date . '</td>';
        $show .= '<td id="' . $modal_id . '" data-id="' . $data_id . '" data-transId="' . $transaction_id . '">' . $type . '</td>';
        $show .= '<td id="' . $modal_id . '" data-id="' . $data_id . '" data-transId="' . $transaction_id . '">' . $number . '</td>';
        $show .= '<td id="' . $modal_id . '" data-id="' . $data_id . '" data-transId="' . $transaction_id . '">' . $vendors_name . '</td>';
        $show .= '<td data-id="' . $data_id . '" data-transId="' . $transaction_id . '">';
        $show .= '<div style="display: inline-block;position: relative;width: 100%">';
        $show .= '<select name="category" id="expenseTransCategory" data-category="" data-id="' . $category_id . '" class="form-control select2-tbl-category">';
        $show .= '<option value="' . $category_list_id . '" selected>' . $category . '</option>';
        foreach ($list_categories as $list) :
                if ($list->category_name == $category) :
                    $show .= '<option value="' . $list->id . '">' . $list->category_name . '</option>';
        endif;
        endforeach;
        $show .= '</select>';
        $show .= '</div>';
        $show .= '<i class="fa fa-spinner fa-pulse" style="display: none;position: relative;"></i>';
        $show .= '</td>';
        $show .= '<td id="' . $modal_id . '" data-id="' . $data_id . '" data-transId="' . $transaction_id . '">' . $transaction->total . '</td>';
        $show .= '<td style="text-align: right;">';
        $show .= '<a href="#" id="' . $modal_id . '" data-id="' . $data_id . '" data-transId="' . $transaction_id . '" style="margin-right: 10px;color: #0077c5;font-weight: 600;">View/Edit</a>';
        $show .= '<div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">';
        $show .= '<span class="fa fa-caret-down" data-toggle="dropdown"></span>';
        $show .= '<ul class="dropdown-menu dropdown-menu-right">';
        $show .= '<li><a href="#" id="copy">Copy</a></li>';
        $show .= '<li id="' . $delete . '" data-id="' . $data_id . '" data-transId="' . $transaction_id . '">';
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
    public function getExpensesCategories()
    {
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
        if ($categories_by_id != null) {
            foreach ($query as $categories) {
                foreach ($categories_by_id as $category_by_id) {
                    if ($categories->id == $category_by_id->category_id) {
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type,
                            'selected' => true
                        );
                    }
                }
            }
            foreach ($query as $categories) {
                foreach ($categories_by_id as $category_by_id) {
                    if ($categories->id != $category_by_id->category_id) {
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type
                        );
                    }
                }
            }
        } else {
            foreach ($get_by_search as $categories) {
                $data[] = array(
                    'id' => $categories->id,
                    'text' => $categories->category_name,
                    'subtext' => $categories->type
                );
            }
        }

        echo json_encode($data);
    }

    public function addCategories()
    {
        $new_data = array(
            'account_type' => $this->input->post('account_type'),
            'detail_type' => $this->input->post('detail_type'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'sub_account' => $this->input->post('sub_account'),
        );
        $query = $this->expenses_model->addCategories($new_data);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function updateCategoryById()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $expenses_id = $this->input->post('expenses_id');
        $transaction_id = $this->input->post('transaction_id');
        if ($id == null) {
            $new_category = array(
                'transaction_id' => $transaction_id,
                'expenses_id' => $expenses_id,
                'category_id' => $category
            );
            $this->db->insert('accounting_expense_category', $new_category);
        } else {
            $data = array(
                'category_id' => $category
            );
            $this->db->where('id', $id);
            $this->db->update('accounting_expense_category', $data);
        }

        echo json_encode(1);
    }

    public function payDown()
    {
        $new_data = array(
            'credit_card_id' => $this->input->post('credit_card_id'),
            'amount' => $this->input->post('amount'),
            'date_payment' => $this->input->post('date_payment'),
            'payment_account' => $this->input->post('payment_account'),
            'check_number' => $this->input->post('check_num'),
        );
        $query = $this->expenses_model->payDown($new_data);
        if ($query == true) {
            redirect('accounting/expenses');
        } else {
            redirect('accounting/expenses');
        }
    }

    /***Rules***/
    public function edit_rules()
    {
        $id = $this->input->get('id');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rules'] = $this->rules_model->getRulesById($id);
        $this->page_data['conditions'] = $this->rules_model->getConditionById($id);
        $this->page_data['categories'] = $this->rules_model->getCategoryById($id);
        $this->load->view('accounting/rules/edit-rules', $this->page_data);
    }

    public function addRules()
    {
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
        if ($rules_id != null) {
            //Condition insertion
            $description = $this->input->post('description');
            $contain = $this->input->post('contain');
            $comment = $this->input->post('comment');
            $this->rules_model->addConditions($description, $contain, $comment, $rules_id);
            //Category Insertion
            $category = $this->input->post('category');
            $percentage = $this->input->post('percentage');
            $this->rules_model->addCategory($category, $percentage, $rules_id);

            $this->session->set_flashdata('rules_added', 'New rules added');
            redirect('accounting/rules');
        } else {
            $this->session->set_flashdata('rules_failed', 'Rules name already exist.');
            redirect('accounting/rules');
        }
    }

    public function editRules()
    {
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

        $rules_id = $this->rules_model->editRules($update, $con_id, $description, $contain, $comment, $cat_id, $category, $percentage);
        if ($rules_id == true) {
            $this->session->set_flashdata('updated_rules', 'Rules has been updated.');
            redirect('accounting/rules');
        } else {
            $this->session->set_flashdata('update_rules_failed', 'Something is wrong in the process.');
            redirect('accounting/rules');
        }
    }

    public function deleteRulesData()
    {
        $id = $this->input->post('id');
        $this->rules_model->deleteRulesData($id);
        $rules = $this->rules_model->getRules();
        $output = '';
        foreach ($rules as $rule) {
            $output = '<tr>';
            $output .= '<td><input type="checkbox" value="' . $rule->id . '"></td>';
            $output .= '<td>' . $rule->rules_name . '</td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td>' . ($rule->auto) ? "Auto" : "" . '</td>';
            $output .= '<td></td>';
            $output .= '<td>';
            $output .= '<a href="' . site_url() . 'accounting/edit_rules?id=' . $rule->id . '" style="color: #0b97c4;">View/Edit</a>&nbsp;';
            $output .= '<div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">';
            $output .= '<span class="fa fa-chevron-down" data-toggle="dropdown"></span>';
            $output .= '<ul class="dropdown-menu dropdown-menu-right">';
            $output .= '<li><a href="#" id="deleteRules" data-id="' . $rule->id . '">Delete</a></li>';
            $output .= '</ul>';
            $output .= '</div>';
            $output .= '</td>';
            $output .= '</tr>';
        }
        echo $output;
    }

    /*** Receipt ***/
    public function uploadReceiptImage()
    {
        if (!empty($_FILES)) {
            $config = array(
                'upload_path' => './uploads/accounting/',
                'allowed_types' => 'gif|jpg|png|jpeg|pdf',
                'overwrite' => true,
                'max_size' => '5000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")) {
                $uploadData = $this->upload->data();
                $data2 = array('receipt_img' => $uploadData['file_name'], 'user_id' => logged('id'));
                $this->db->insert('accounting_receipts', $data2);
                echo json_encode($uploadData['file_name']);
            } else {
                echo $this->upload->display_errors();
                ;
            }
        }
    }

    public function removeReceiptImage()
    {
        $file = $this->input->post('file');
        if ($file && file_exists($this->upload_path . $file)) {
            unlink($this->upload_path . $file);
            $this->db->where('receipt_img', $file);
            $this->db->delete('accounting_receipts');
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function getReceiptData()
    {
        if (isset($_POST['id'])) {
            $query = $this->db->get_where('accounting_receipts', array('id' => $_POST['id']));

            $data = new stdClass();
            $data->id = $_POST['id'];
            $data->receipt_img = $query->row()->receipt_img;
            $data->document_type = (empty($query->row()->document_type)) ? "null" : $query->row()->document_type;
            $data->payee_id = ($query->row()->payee_id == 0) ? "default" : $query->row()->payee_id;
            $data->bank_account = (empty($query->row()->bank_account)) ? "default" : $query->row()->bank_account;
            $data->transaction_date = $query->row()->transaction_date;
            $data->description = (empty($query->row()->description)) ? "" : $query->row()->description;
            $data->category = (empty($query->row()->category)) ? "default" : $query->row()->category;
            $data->total_amount = (empty($query->row()->total_amount)) ? "" : $query->row()->total_amount;
            $data->memo = (empty($query->row()->memo)) ? "" : $query->row()->memo;
            $data->ref_number = (empty($query->row()->ref_number)) ? "" : $query->row()->ref_number;
            $data->created_at = $query->row()->created_at;

            echo json_encode($data);
        }
    }

    public function updateReceipt()
    {
        $new_data = array(
            'receipt_id'            => $this->input->post('receipt_id'),
            'document_type'         => $this->input->post('document_type'),
            'payee_id'              => $this->input->post('payee_id'),
            'bank_account'          => $this->input->post('bank_account'),
            'transaction_date'      => $this->input->post('transaction_date'),
            'category'              => $this->input->post('category'),
            'description'           => $this->input->post('description'),
            'total_amount'          => $this->input->post('total_amount'),
            'memo'                  => $this->input->post('memo'),
            'ref_number'            => $this->input->post('ref_number')
        );
        $update = $this->receipt_model->updateReceipt($new_data);
        // dd($update);
        if ($update == true) {
            $this->session->set_flashdata('receipt_updated', 'Receipt updated.');
            redirect('accounting/receipts');
        } else {
            $this->session->set_flashdata('receipt_updateFailed', 'Something is wrong in the process.');
            redirect('accounting/receipts');
        }
    }

    public function receipt_create_expense()
    {
        $rID  = $this->input->post('rID');

        $receipts = $this->receipt_model->getReceiptBYID($rID);

        $transaction = array(
            'type'          => 'Expense',
            'total'         => $receipts->total_amount,
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);

        $new_data = array(
            'transaction_id'    => $fquery,
            'vendor_id'         => $this->input->post('vendor_id'),
            'payment_account'   => $this->input->post('payment_account'),
            'payment_date'      => $receipts->transaction_date,
            'payment_method'    => $this->input->post('payment_method'),
            'ref_number'        => $receipts->ref_number,
            // 'permit_number'     => $this->input->post('permit_num'),
            'memo'              => $receipts->memo,
            'amount'            => $receipts->total_amount,
            'attachments'       => 'test',
            'status'            => 1,
            'created_by'        => logged('id'),
            'created_at'        => date("Y-m-d H:i:s"),
            'updated_at'        => date("Y-m-d H:i:s")
        );
        $query = $this->expenses_model->addExpense($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category']       = $a[$i];
                $data['description']    = $b[$i];
                $data['amount']         = $e[$i];
                $data['ven_type']       = '1';
                $data['ven_type_id']    = $query;
                $data['status']         = '1';
                $data['created_at']     = date("Y-m-d H:i:s");
                $data['updated_at']     = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category']      = $aa[$f];
                $data2['description']   = $bb[$f];
                $data2['amount']        = $cc[$f];
                $data2['type']          = 'Expense';
                $data2['type_id']       = $query;
                $data2['status']        = '1';
                $data2['created_at']    = date("Y-m-d H:i:s");
                $data2['updated_at']    = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteReceiptData()
    {
        $id = $this->input->post('id');
        $this->receipt_model->deleteReceiptData($id);
    }

    public function lists()
    {
        $this->load->view('accounting/list', $this->page_data);
    }

    public function addInvoice()
    {
        if ($this->input->post('credit_card_paymentsmer_id') == 1) {
            $credit_card = 'Credit Card';
        } else {
            $credit_card = '0';
        }

        if ($this->input->post('bank_transfer') == 1) {
            $bank_transfer = 'Bank Transfer';
        } else {
            $bank_transfer = '0';
        }

        if ($this->input->post('instapay') == 1) {
            $instapay = 'Instapay';
        } else {
            $instapay = '0';
        }

        if ($this->input->post('check') == 1) {
            $check = 'Check';
        } else {
            $check = '0';
        }

        if ($this->input->post('cash') == 1) {
            $cash = 'Cash';
        } else {
            $cash = '0';
        }

        if ($this->input->post('deposit') == 1) {
            $deposit = 'Deposit';
        } else {
            $deposit = '0';
        }

        $company_id = getLoggedCompanyID();


        $new_data = array(
            'customer_id' => $this->input->post('customer_id'), //

            'job_location' => $this->input->post('invoice_job_location'), //
            'job_name' => $this->input->post('job_name'), //

            'tags' => $this->input->post('tags'), //
            // 'invoice_type'                      => $this->input->post('invoice_type'),//
            'work_order_number' => $this->input->post('work_order_number'), //
            'purchase_order' => $this->input->post('purchase_order'), //
            'invoice_number' => $this->input->post('invoice_number'), //
            'date_issued' => $this->input->post('date_issued'), //

            'customer_email' => $this->input->post('customer_email'), //
            'online_payments' => $this->input->post('online_payments'),
            'billing_address' => $this->input->post('billing_address'), //
            'shipping_to_address' => $this->input->post('shipping_to_address'), //
            'ship_via' => $this->input->post('ship_via'), //
            'shipping_date' => $this->input->post('shipping_date'), //
            'tracking_number' => $this->input->post('tracking_number'), //
            'terms' => $this->input->post('terms'), //
            // 'invoice_date' => $this->input->post('invoice_date'),
            'due_date' => $this->input->post('due_date'), //
            'location_scale' => $this->input->post('location_scale'), //
            'message_to_customer' => $this->input->post('message_to_customer'), //
            'terms_and_conditions' => $this->input->post('terms_and_conditions'), //
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => $this->input->post("attachement-filenames"),
            'status' => $this->input->post('status'), //

            'deposit_request_type' => $this->input->post('deposit_request_type'), //
            'deposit_request' => $this->input->post('deposit_amount'), //
            // 'payment_schedule' => $this->input->post('payment_schedule'),
            'payment_methods' => $credit_card . ',' . $bank_transfer . ',' . $instapay . ',' . $check . ',' . $cash . ',' . $deposit,

            'sub_total' => $this->input->post('subtotal'), //
            'taxes' => $this->input->post('taxes'), //
            'adjustment_name' => $this->input->post('adjustment_name'), //
            'adjustment_value' => $this->input->post('adjustment_value'), //
            'grand_total' => $this->input->post('grand_total'), //


            'user_id' => logged('id'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->invoice_model->createInvoice($new_data);

        //recording the status.
        $new_status_data=array(
            "invoice_id" => $addQuery,
            "status" => $this->input->post('status'),
            "note" => "First status"
        );
        $this->invoice_model->new_invoice_status($new_status_data);

        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }
        if ($addQuery > 0) {
            if ($this->input->post('agency_id')) {
                $this->db->insert('accounting_invoice_tax_agencies', [
                    'invoice_id' => $addQuery,
                    'agency_id' => $this->input->post('agency_id'),
                ]);
            }

            //echo json_encode($addQuery);
            // $new_data2 = array(
            //     'item' => $this->input->post('item'),
            //     'item_type' => $this->input->post('item_type'),
            //     // 'description' => $this->input->post('desc'),
            //     'qty' => $this->input->post('quantity'),
            //     // 'rate' => $this->input->post('rate'),
            //     'cost' => $this->input->post('price'),
            //     'discount' => $this->input->post('discount'),
            //     'tax' => $this->input->post('tax'),
            //     'total' => $this->input->post('total'),
            //     'type' => 'Accounting Invoice',
            //     'type_id' => $addQuery,
            //     'status' => '1',
            //     'created_at' => date("Y-m-d H:i:s"),
            //     'updated_at' => date("Y-m-d H:i:s")
            // );

            // $a = $this->input->post('item');
            // $b = $this->input->post('item_type');
            // $c = $this->input->post('quantity');
            // $d = $this->input->post('price');
            // $e = $this->input->post('discount');
            // $f = $this->input->post('tax');
            // $g = $this->input->post('total');

            // $i = 0;
            // foreach ($a as $row) {
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     $data['qty'] = $c[$i];
            //     $data['cost'] = $d[$i];
            //     $data['discount'] = $e[$i];
            //     $data['tax'] = $f[$i];
            //     $data['total'] = $g[$i];
            //     $data['type'] = 'Accounting Invoice';
            //     $data['type_id'] = $addQuery;
            //     $data['status'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     // $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;
            // }

            $a = $this->input->post('itemid');
            $packageID = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discounts = $this->input->post('discount');
            $gtotal = $this->input->post('total');
            $tax_rate = $this->input->post('agency_id');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = str_replace(',', '', $a[$i]);
                $data['package_id '] = $packageID[$i];
                $data['qty'] = str_replace(',', '', $quantity[$i]);
                $data['cost'] = str_replace(',', '', $price[$i]);
                $data['tax'] = str_replace(',', '', $h[$i]);
                $data['discount'] = str_replace(',', '', $discounts[$i]);
                $data['total'] = ((str_replace(',', '', $price[$i]) * str_replace(',', '', $quantity[$i])) + str_replace(',', '', $h[$i])) - str_replace(',', '', $discounts[$i]);
                $data['invoice_id'] = $addQuery;
                $data['tax_rate_used'] = $tax_rate;
                $addQuery2 = $this->invoice_model->add_invoice_items($data);
                $i++;
            }

            // }
            $userid = logged('id');

            // $getname = $this->estimate_model->getname($userid);

            //     $notif = array(

            //         'user_id'               => $userid,
            //         'title'                 => 'New Estimates',
            //         'content'               => $getname->FName. ' has created new Estimates.'. $this->input->post('estimate_number'),
            //         'date_created'          => date("Y-m-d H:i:s"),
            //         'status'                => '1',
            //         'company_id'            => getLoggedCompanyID()
            //     );

            //     $notification = $this->estimate_model->save_notification($notif);

            // redirect('accounting/banking');
            if ($this->input->post("submit-type") == "invoice_modal") {
                $return_data = new stdClass();
                $return_data->count_save = 1;
                $return_data->invoice_id = $addQuery;
                echo json_encode($return_data);
            } else {
                redirect('accounting/invoices');
            }
        } else {
            echo json_encode(0);
        }
    }


    public function getCustomersAcc()
    {
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->load->view('accounting/customer_invoice_modal', $this->page_data);
    }

    public function updateInvoice()
    {
        $id = $this->input->post('invoiceDataID');

        $update_data = array(
            'id' => $this->input->post('invoiceDataID'), //
            'customer_id' => $this->input->post('customer_id'), //
            'job_location' => $this->input->post('jobs_location'), //
            'job_name' => $this->input->post('job_name'), //
            'invoice_type' => $this->input->post('invoice_type'), //
            'po_number' => $this->input->post('purchase_order'), //
            'date_issued' => $this->input->post('date_issued'), //
            'due_date' => $this->input->post('due_date'), //
            'status' => $this->input->post('status'), //
            'customer_email' => $this->input->post('customer_email'), //
            'online_payments' => $this->input->post('online_payments'),
            'billing_address' => $this->input->post('billing_address'), //
            'shipping_to_address' => $this->input->post('shipping_to_address'),
            'ship_via' => $this->input->post('ship_via'), //
            'shipping_date' => $this->input->post('shipping_date'),
            'tracking_number' => $this->input->post('tracking_number'), //
            'terms' => $this->input->post('terms'), //
            'location_scale' => $this->input->post('location_scale'), //
            'message_on_invoice' => $this->input->post('message_on_invoice'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'job_number' => $this->input->post('job_number'), //to add on database
            // 'attachments'            => $this->input->post('attachments'),
            'tags' => $this->input->post('tags'), //
            // 'total_due'              => $this->input->post('total_due'),
            // 'balance'                => $this->input->post('balance'),
            'deposit_request_type' => $this->input->post('deposit_request_type'),
            'deposit_request' => $this->input->post('deposit_amount'),
            'message_to_customer' => $this->input->post('message_to_customer'),
            'terms_and_conditions' => $this->input->post('terms_and_conditions'),
            // 'signature'              => $this->input->post('signature'),
            // 'sign_date'              => $this->input->post('sign_date'),
            // 'is_recurring'           => $this->input->post('is_recurring'),
            // 'invoice_totals'         => $this->input->post('invoice_totals'),
            'phone' => $this->input->post('phone'),
            'payment_schedule' => $this->input->post('payment_schedule'),
            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),
            'date_updated' => date("Y-m-d H:i:s"),
        );

        $addQuery = $this->invoice_model->update_invoice_data($update_data);

        $last_invoice_status = $this->invoice_model->get_last_invoice_status($id);
        if ($last_invoice_status->status != $this->input->post('status')) {
            $new_status_data=array(
                "invoice_id" => $id,
                "status" => $this->input->post('status'),
                "note" => "Invoice edited"
            );
            $this->invoice_model->new_invoice_status($new_status_data);
        }

        $delete2 = $this->invoice_model->delete_items($id);


        // if($addQuery > 0){
        // $a = $this->input->post('items');
        // $b = $this->input->post('item_type');
        // $d = $this->input->post('quantity');
        // $f = $this->input->post('price');
        // $g = $this->input->post('discount');
        // $h = $this->input->post('tax');
        // $ii = $this->input->post('total');

        // $i = 0;
        // foreach($a as $row){
        //     $data['item'] = $a[$i];
        //     $data['item_type'] = $b[$i];
        //     $data['qty'] = $d[$i];
        //     $data['cost'] = $f[$i];
        //     $data['discount'] = $g[$i];
        //     $data['tax'] = $h[$i];
        //     $data['total'] = $ii[$i];
        //     $data['type'] = 'Work Order';
        //     $data['type_id'] = $id;
        //     // $data['status'] = '1';
        //     $data['created_at'] = date("Y-m-d H:i:s");
        //     $data['updated_at'] = date("Y-m-d H:i:s");
        //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //     $i++;
        // }
        // if($addQuery > 0){
        $a = $this->input->post('itemid');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $h = $this->input->post('tax');
        $total = $this->input->post('total');

        for ($i=0; $i < count($a); $i++) {
            $data['items_id'] = $a[$i];
            $data['qty'] = $quantity[$i];
            $data['cost'] = $price[$i];
            $data['tax'] = $h[$i];
            $data['total'] = $total[$i];
            $data['invoice_id '] = $id;
            $addQuery2 = $this->invoice_model->add_invoice_items($data);
        }

        redirect('accounting/invoices');
    }


    public function savenewestimateAccounting()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Standard',
            'type' => $this->input->post('estimate_type'),
            // 'ship_via' => $this->input->post('ship_via'),
            // 'ship_date' => $this->input->post('ship_date'),
            // 'tracking_no' => $this->input->post('tracking_no'),
            // 'ship_to' => $this->input->post('ship_to'),
            // 'tags' => $this->input->post('tags'),
            'attachments' => 'testing',
            // 'message_invoice' => $this->input->post('message_invoice'),
            // 'message_statement' => $this->input->post('message_statement'),
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),
            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            'sub_total' => $this->input->post('subtotal'), //
            // 'deposit_request' => $this->input->post('adjustment_name'),//
            // 'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'), //
            'tax1_total' => $this->input->post('taxes'),

            'adjustment_name' => $this->input->post('adjustment_name'), //
            'adjustment_value' => $this->input->post('adjustment_value'), //

            'markup_type' => '$', //
            'markup_amount' => $this->input->post('markup_input_form'), //

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            // $new_data2 = array(
            //     'item_type' => $this->input->post('type'),
            //     'description' => $this->input->post('desc'),
            //     'qty' => $this->input->post('qty'),
            //     'location' => $this->input->post('location'),
            //     'cost' => $this->input->post('cost'),
            //     'discount' => $this->input->post('discount'),
            //     'tax' => $this->input->post('tax'),
            //     'type' => '1',
            //     'type_id' => $addQuery,
            //     'status' => '1',
            //     'created_at' => date("Y-m-d H:i:s"),
            //     'updated_at' => date("Y-m-d H:i:s")
            // );
            // $a = $this->input->post('items');
            // $b = $this->input->post('item_type');
            // // $c = $this->input->post('desc');
            // $d = $this->input->post('quantity');
            // // $e = $this->input->post('location');
            // $f = $this->input->post('price');
            // $g = $this->input->post('discount');
            // $h = $this->input->post('tax');
            // $ii = $this->input->post('total');

            // $i = 0;
            // foreach ($a as $row) {
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     // $data['description'] = $c[$i];
            //     $data['qty'] = $d[$i];
            //     // $data['location'] = $e[$i];
            //     $data['cost'] = $f[$i];
            //     $data['discount'] = $g[$i];
            //     $data['tax'] = $h[$i];
            //     $data['total'] = $ii[$i];
            //     $data['type'] = 'Standard Estimate';
            //     $data['type_id'] = $addQuery;
            //     $data['status'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;

            $a = $this->input->post('itemid');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $gtotal = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $gtotal[$i];
                $data['estimates_id '] = $addQuery;
                $addQuery2 = $this->estimate_model->add_estimate_items($data);
                $i++;
            }

            // }
            $userid = logged('id');

            $getname = $this->estimate_model->getname($userid);

            $notif = array(

                'user_id' => $userid,
                'title' => 'New Estimates',
                'content' => $getname->FName . ' has created new Estimates.' . $this->input->post('estimate_number'),
                'date_created' => date("Y-m-d H:i:s"),
                'status' => '1',
                'company_id' => getLoggedCompanyID()
            );

            $notification = $this->estimate_model->save_notification($notif);

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimateBundleAccounting()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Bundle',
            'type' => $this->input->post('estimate_type'),
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            // 'estimate_type' => 'Bundle',
            'bundle1_message' => $this->input->post('bundle1_message'),
            'bundle2_message' => $this->input->post('bundle2_message'),
            // 'bundle1_total' => $this->input->post('bundle1_total'),
            // 'bundle2_total' => $this->input->post('bundle2_total'),
            'bundle_discount' => $this->input->post('bundle_discount'),


            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            'deposit_request' => '$',
            'deposit_amount' => $this->input->post('adjustment_input'), //
            'bundle1_total' => $this->input->post('grand_total'), //
            'bundle2_total' => $this->input->post('grand_total2'), //
            'sub_total' => $this->input->post('sub_total'), //
            'sub_total2' => $this->input->post('sub_total2'), //

            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),

            'grand_total' => $this->input->post('supergrandtotal'), //

            'adjustment_name' => $this->input->post('adjustment_name'), //
            'adjustment_value' => $this->input->post('adjustment_input'), //

            'markup_type' => '$', //
            'markup_amount' => $this->input->post('markup_input_form'), //

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            // $a = $this->input->post('items');
            // $b = $this->input->post('item_type');
            // $d = $this->input->post('quantity');
            // $f = $this->input->post('price');
            // $g = $this->input->post('discount');
            // $h = $this->input->post('tax');
            // $ii = $this->input->post('total');

            // $i = 0;
            // foreach ($a as $row) {
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     $data['qty'] = $d[$i];
            //     $data['cost'] = $f[$i];
            //     $data['discount'] = $g[$i];
            //     $data['tax'] = $h[$i];
            //     $data['total'] = $ii[$i];
            //     $data['type'] = 'Bundle Estimate';
            //     $data['type_id'] = $addQuery;
            //     $data['status'] = '1';
            //     $data['estimate_type'] = 'Bundle';
            //     $data['bundle_option_type'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;
            // }

            // $j = $this->input->post('items2');
            // $k = $this->input->post('item_type2');
            // $l = $this->input->post('quantity2');
            // $m = $this->input->post('price2');
            // $n = $this->input->post('discount2');
            // $o = $this->input->post('tax2');
            // $p = $this->input->post('total2');

            // $z = 0;
            // foreach ($j as $row2) {
            //     $data2['item'] = $j[$z];
            //     $data2['item_type'] = $k[$z];
            //     $data2['qty'] = $l[$z];
            //     $data2['cost'] = $m[$z];
            //     $data2['discount'] = $n[$z];
            //     $data2['tax'] = $o[$z];
            //     $data2['total'] = $p[$z];
            //     $data2['type'] = 'Bundle Estimate';
            //     $data2['type_id'] = $addQuery;
            //     $data2['status'] = '1';
            //     $data2['estimate_type'] = 'Bundle';
            //     $data2['bundle_option_type'] = '2';
            //     $data2['created_at'] = date("Y-m-d H:i:s");
            //     $data2['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
            //     $z++;
            // }
            // redirect('estimate');

            $a = $this->input->post('itemid');
            // $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['estimate_type'] = 'Bundle';
                $data['estimates_id '] = $addQuery;
                $data['bundle_option_type'] = '1';
                $addQuery2 = $this->estimate_model->add_estimate_details($data);
                $i++;
            }

            $a2 = $this->input->post('itemid2');
            // $packageID  = $this->input->post('packageID');
            $quantity2 = $this->input->post('quantity2');
            $price2 = $this->input->post('price2');
            $h2 = $this->input->post('tax2');
            $discount2 = $this->input->post('discount2');
            $total2 = $this->input->post('total2');

            $i2 = 0;
            foreach ($a2 as $row2) {
                $data2['items_id'] = $a2[$i2];
                // $data['package_id ']    = $packageID[$i];
                $data2['qty'] = $quantity2[$i2];
                $data2['cost'] = $price2[$i2];
                $data2['tax'] = $h2[$i2];
                $data2['discount'] = $discount2[$i2];
                $data2['total'] = $total2[$i2];
                $data2['estimate_type'] = 'Bundle';
                $data2['estimates_id '] = $addQuery;
                $data2['bundle_option_type'] = '2';
                $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                $i2++;
            }

            // $getname = $this->workorder_model->getname($user_id);

            // $notif = array(

            //     'user_id'               => $user_id,
            //     'title'                 => 'New Work Order',
            //     'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
            //     'date_created'          => date("Y-m-d H:i:s"),
            //     'status'                => '1',
            //     'company_id'            => getLoggedCompanyID()
            // );

            // $notification = $this->workorder_model->save_notification($notif);

            $userid = logged('id');

            $getname = $this->estimate_model->getname($userid);

            $notif = array(

                'user_id' => $userid,
                'title' => 'New Estimates',
                'content' => $getname->FName . ' has created new Bundle Estimates.' . $this->input->post('estimate_number'),
                'date_created' => date("Y-m-d H:i:s"),
                'status' => '1',
                'company_id' => getLoggedCompanyID()
            );

            $notification = $this->estimate_model->save_notification($notif);

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }


    public function savenewestimateOptionsAccounting()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Option',
            'type' => $this->input->post('estimate_type'),
            'attachments' => 'testing',
            // 'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            'option_message' => $this->input->post('option1_message'),
            'option2_message' => $this->input->post('option2_message'),
            'option1_total' => $this->input->post('grand_total'),
            'option2_total' => $this->input->post('grand_total2'),
            // 'bundle_discount' => $this->input->post('bundle_discount'),
            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),
            'sub_total' => $this->input->post('sub_total'), //
            'sub_total2' => $this->input->post('sub_total2'), //

            // 'tax1_total' => $this->input->post('total_tax_'),
            // 'tax2_total' => $this->input->post('total_tax2_'),

            // 'grand_total' => $this->input->post('supergrandtotal'),


            'user_id' => $user_id,
            'company_id' => $company_id,

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);

        // if ($addQuery > 0) {
        //     $a = $this->input->post('items');
        //     $b = $this->input->post('item_type');
        //     $d = $this->input->post('quantity');
        //     $f = $this->input->post('price');
        //     $g = $this->input->post('discount');
        //     $h = $this->input->post('tax');
        //     $ii = $this->input->post('total');

        //     $i = 0;
        //     foreach ($a as $row) {
        //         $data['item'] = $a[$i];
        //         $data['item_type'] = $b[$i];
        //         $data['qty'] = $d[$i];
        //         $data['cost'] = $f[$i];
        //         $data['discount'] = $g[$i];
        //         $data['tax'] = $h[$i];
        //         $data['total'] = $ii[$i];
        //         $data['type'] = 'Option Estimate';
        //         $data['type_id'] = $addQuery;
        //         $data['status'] = '1';
        //         $data['estimate_type'] = 'Option';
        //         $data['bundle_option_type'] = '1';
        //         $data['created_at'] = date("Y-m-d H:i:s");
        //         $data['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //         $i++;
        //     }

        //     $j = $this->input->post('items2');
        //     $k = $this->input->post('item_type2');
        //     $l = $this->input->post('quantity2');
        //     $m = $this->input->post('price2');
        //     $n = $this->input->post('discount2');
        //     $o = $this->input->post('tax2');
        //     $p = $this->input->post('total2');

        //     $z = 0;
        //     foreach ($j as $row2) {
        //         $data2['item'] = $j[$z];
        //         $data2['item_type'] = $k[$z];
        //         $data2['qty'] = $l[$z];
        //         $data2['cost'] = $m[$z];
        //         $data2['discount'] = $n[$z];
        //         $data2['tax'] = $o[$z];
        //         $data2['total'] = $p[$z];
        //         $data2['type'] = 'Option Estimate';
        //         $data2['type_id'] = $addQuery;
        //         $data2['status'] = '1';
        //         $data2['estimate_type'] = 'Option';
        //         $data2['bundle_option_type'] = '2';
        //         $data2['created_at'] = date("Y-m-d H:i:s");
        //         $data2['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
        //         $z++;
        //     }

        //     redirect('estimate');
        // }
        if ($addQuery > 0) {
            $a = $this->input->post('itemid');
            // $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['estimate_type'] = 'Option';
                $data['estimates_id '] = $addQuery;
                $data['bundle_option_type'] = '1';
                $addQuery2 = $this->estimate_model->add_estimate_details($data);
                $i++;
            }

            $a2 = $this->input->post('itemid2');
            // $packageID  = $this->input->post('packageID');
            $quantity2 = $this->input->post('quantity2');
            $price2 = $this->input->post('price2');
            $h2 = $this->input->post('tax2');
            $discount2 = $this->input->post('discount2');
            $total2 = $this->input->post('total2');

            $i2 = 0;
            foreach ($a2 as $row2) {
                $data2['items_id'] = $a2[$i2];
                // $data['package_id ']    = $packageID[$i];
                $data2['qty'] = $quantity2[$i2];
                $data2['cost'] = $price2[$i2];
                $data2['tax'] = $h2[$i2];
                $data2['discount'] = $discount2[$i2];
                $data2['total'] = $total2[$i2];
                $data2['estimate_type'] = 'Option';
                $data2['estimates_id '] = $addQuery;
                $data2['bundle_option_type'] = '2';
                $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                $i2++;
            }

            // $getname = $this->workorder_model->getname($user_id);

            // $notif = array(

            //     'user_id'               => $user_id,
            //     'title'                 => 'New Work Order',
            //     'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
            //     'date_created'          => date("Y-m-d H:i:s"),
            //     'status'                => '1',
            //     'company_id'            => getLoggedCompanyID()
            // );

            // $notification = $this->workorder_model->save_notification($notif);

            $userid = logged('id');

            $getname = $this->estimate_model->getname($userid);

            $notif = array(

                'user_id' => $userid,
                'title' => 'New Estimates',
                'content' => $getname->FName . ' has created new Options Estimates.' . $this->input->post('estimate_number'),
                'date_created' => date("Y-m-d H:i:s"),
                'status' => '1',
                'company_id' => getLoggedCompanyID()
            );

            $notification = $this->estimate_model->save_notification($notif);


            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }


    public function updateestimateBundleAccounting($id)
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'id' => $id,
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            // 'estimate_number'           => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Bundle',
            'type' => $this->input->post('estimate_type'),
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            // 'estimate_type' => 'Bundle',
            'bundle1_message' => $this->input->post('bundle1_message'),
            'bundle2_message' => $this->input->post('bundle2_message'),
            // 'bundle1_total' => $this->input->post('bundle1_total'),
            // 'bundle2_total' => $this->input->post('bundle2_total'),
            'bundle_discount' => $this->input->post('bundle_discount'),

            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            // 'deposit_request'           => '$',
            'deposit_amount' => $this->input->post('adjustment_input'), //
            'bundle1_total' => $this->input->post('grand_total'), //
            'bundle2_total' => $this->input->post('grand_total2'), //
            'sub_total' => $this->input->post('sub_total'), //
            'sub_total2' => $this->input->post('sub_total2'), //

            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),

            'grand_total' => $this->input->post('supergrandtotal'), //

            'adjustment_name' => $this->input->post('adjustment_name'), //
            'adjustment_value' => $this->input->post('adjustment_input'), //

            'markup_type' => '$', //
            'markup_amount' => $this->input->post('markup_input_form'), //

            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->update_estimateBundle($new_data);

        $delete2 = $this->estimate_model->delete_items($id);

        // if ($addQuery > 0) {

        $a = $this->input->post('itemid');
        // $packageID  = $this->input->post('packageID');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $h = $this->input->post('tax');
        $discount = $this->input->post('discount');
        $total = $this->input->post('total');

        $i = 0;
        foreach ($a as $row) {
            $data['items_id'] = $a[$i];
            // $data['package_id ']    = $packageID[$i];
            $data['qty'] = $quantity[$i];
            $data['cost'] = $price[$i];
            $data['tax'] = $h[$i];
            $data['discount'] = $discount[$i];
            $data['total'] = $total[$i];
            $data['estimate_type'] = 'Bundle';
            $data['estimates_id '] = $id;
            $data['bundle_option_type'] = '1';
            $addQuery2 = $this->estimate_model->add_estimate_details($data);
            $i++;
        }

        $a2 = $this->input->post('itemid2');
        // $packageID  = $this->input->post('packageID');
        $quantity2 = $this->input->post('quantity2');
        $price2 = $this->input->post('price2');
        $h2 = $this->input->post('tax2');
        $discount2 = $this->input->post('discount2');
        $total2 = $this->input->post('total2');

        $i2 = 0;
        foreach ($a2 as $row2) {
            $data2['items_id'] = $a2[$i2];
            // $data['package_id ']    = $packageID[$i];
            $data2['qty'] = $quantity2[$i2];
            $data2['cost'] = $price2[$i2];
            $data2['tax'] = $h2[$i2];
            $data2['discount'] = $discount2[$i2];
            $data2['total'] = $total2[$i2];
            $data2['estimate_type'] = 'Bundle';
            $data2['estimates_id '] = $id;
            $data2['bundle_option_type'] = '2';
            $addQuery2 = $this->estimate_model->add_estimate_details($data2);
            $i2++;
        }


        redirect('accounting/newEstimateList');
        // } else {
        //     echo json_encode(0);
        // }
    }

    public function updateestimateOptionsAccounting($id)
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'id' => $id,
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            // 'estimate_number'        => $this->input->post('estimate_number'),
            // 'email'                  => $this->input->post('email'),
            // 'billing_address'        => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Option',
            'type' => $this->input->post('estimate_type'),
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            // 'estimate_type'          => 'Bundle',
            'option_message' => $this->input->post('option1_message'),
            'option2_message' => $this->input->post('option2_message'),
            // 'bundle1_total'          => $this->input->post('bundle1_total'),
            // 'bundle2_total'          => $this->input->post('bundle2_total'),
            // 'bundle_discount'           => $this->input->post('bundle_discount'),

            // 'created_by'             => logged('id'),

            // 'sub_total'              => $this->input->post('sub_total'),
            // 'deposit_request'        => '$',
            // 'deposit_amount'            => $this->input->post('adjustment_input'),//
            'option1_total' => $this->input->post('grand_total'), //
            'option2_total' => $this->input->post('grand_total2'), //
            'sub_total' => $this->input->post('sub_total'), //
            'sub_total2' => $this->input->post('sub_total2'), //

            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),

            // 'grand_total'               => $this->input->post('supergrandtotal'),//

            // 'adjustment_name'           => $this->input->post('adjustment_name'),//
            // 'adjustment_value'          => $this->input->post('adjustment_input'),//

            // 'markup_type'               => '$',//
            // 'markup_amount'             => $this->input->post('markup_input_form'),//

            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->update_estimateOptions($new_data);

        $delete2 = $this->estimate_model->delete_items($id);

        // if ($addQuery > 0) {

        $a = $this->input->post('itemid');
        // $packageID  = $this->input->post('packageID');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $h = $this->input->post('tax');
        $discount = $this->input->post('discount');
        $total = $this->input->post('total');

        $i = 0;
        foreach ($a as $row) {
            $data['items_id'] = $a[$i];
            // $data['package_id ']    = $packageID[$i];
            $data['qty'] = $quantity[$i];
            $data['cost'] = $price[$i];
            $data['tax'] = $h[$i];
            $data['discount'] = $discount[$i];
            $data['total'] = $total[$i];
            $data['estimate_type'] = 'Option';
            $data['estimates_id '] = $id;
            $data['bundle_option_type'] = '1';
            $addQuery2 = $this->estimate_model->add_estimate_details($data);
            $i++;
        }

        $a2 = $this->input->post('itemid2');
        // $packageID  = $this->input->post('packageID');
        $quantity2 = $this->input->post('quantity2');
        $price2 = $this->input->post('price2');
        $h2 = $this->input->post('tax2');
        $discount2 = $this->input->post('discount2');
        $total2 = $this->input->post('total2');

        $i2 = 0;
        foreach ($a2 as $row2) {
            $data2['items_id'] = $a2[$i2];
            // $data['package_id ']    = $packageID[$i];
            $data2['qty'] = $quantity2[$i2];
            $data2['cost'] = $price2[$i2];
            $data2['tax'] = $h2[$i2];
            $data2['discount'] = $discount2[$i2];
            $data2['total'] = $total2[$i2];
            $data2['estimate_type'] = 'Option';
            $data2['estimates_id '] = $id;
            $data2['bundle_option_type'] = '2';
            $addQuery2 = $this->estimate_model->add_estimate_details($data2);
            $i2++;
        }


        redirect('accounting/newEstimateList');
        // } else {
        //     echo json_encode(0);
        // }
    }

    public function deleteInvoice()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_invoices_model->deleteInvoice($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addReceivePayment()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_no' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'amount' => $this->input->post('amount'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'testing',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_receive_payment_model->createReceivePayment($new_data);

        if ($addQuery > 0) {
            // echo json_encode($addQuery);
            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function savepaymethod()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();
        $new_data = array(
            'payment_method' => $this->input->post('new_pay_method'),
            'quick_name' => $this->input->post('new_pay_method'),
            'user_id' => $user_id,
            'company_id' => $company_id,
        );

        $addQuery = $this->accounting_receive_payment_model->savepaymentmethod($new_data);

        if ($addQuery > 0) {
            echo json_encode($addQuery);
        //$this->session->set_flashdata('Method added');
        } else {
            echo json_encode(0);
        }
    }

    public function updateReceivePayment()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'amount_received' => $this->input->post('amount_received'),
            'memo' => $this->input->post('memo'),
            'attachments' => $this->input->post('file_name'),
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $updateQuery = $this->accounting_receive_payment_model->updateReceivePayment($this->input->post('id'), $new_data);

        if ($updateQuery) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteReceivePayment()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_receive_payment_model->deleteReceivePayment($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    //add estimate

    public function saveEstimate()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'billing_address' => $this->input->post('billing_address'),
            'est_date' => $this->input->post('est_date'),
            'ex_date' => $this->input->post('ex_date'),
            'ship_via' => $this->input->post('ship_via'),
            'ship_date' => $this->input->post('ship_date'),
            'tracking_no' => $this->input->post('tracking_no'),
            'ship_to' => $this->input->post('ship_to'),
            'tags' => $this->input->post('tags'),
            'attachments' => 'testing',
            'message_invoice' => $this->input->post('message_invoice'),
            'message_statement' => $this->input->post('message_statement'),
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);

        // if($addQuery > 0){
        //     // echo json_encode($addQuery);
        //     redirect('accounting/banking');
        // }
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'product_services' => $this->input->post('prod'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'rate' => $this->input->post('rate'),
                'amount' => $this->input->post('amount'),
                'tax' => $this->input->post('tax'),
                'type' => '1',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('prod');
            $b = $this->input->post('desc');
            $c = $this->input->post('qty');
            $d = $this->input->post('rate');
            $e = $this->input->post('amount');
            $f = $this->input->post('tax');

            $i = 0;
            foreach ($a as $row) {
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '2';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimate()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Standard',
            // 'ship_via' => $this->input->post('ship_via'),
            // 'ship_date' => $this->input->post('ship_date'),
            // 'tracking_no' => $this->input->post('tracking_no'),
            // 'ship_to' => $this->input->post('ship_to'),
            // 'tags' => $this->input->post('tags'),
            'attachments' => 'testing',
            // 'message_invoice' => $this->input->post('message_invoice'),
            // 'message_statement' => $this->input->post('message_statement'),
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            'estimate_type' => 'Standard',

            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            'sub_total' => $this->input->post('sub_total'), //
            'deposit_request' => $this->input->post('adjustment_name'), //
            'deposit_amount' => $this->input->post('adjustment_input'), //
            'grand_total' => $this->input->post('grand_total'), //

            'adjustment_name' => $this->input->post('adjustment_name'), //
            'adjustment_value' => $this->input->post('adjustment_input'), //

            'markup_type' => '$', //
            'markup_amount' => $this->input->post('markup_input_form'), //

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            // $new_data2 = array(
            //     'item_type' => $this->input->post('type'),
            //     'description' => $this->input->post('desc'),
            //     'qty' => $this->input->post('qty'),
            //     'location' => $this->input->post('location'),
            //     'cost' => $this->input->post('cost'),
            //     'discount' => $this->input->post('discount'),
            //     'tax' => $this->input->post('tax'),
            //     'type' => '1',
            //     'type_id' => $addQuery,
            //     'status' => '1',
            //     'created_at' => date("Y-m-d H:i:s"),
            //     'updated_at' => date("Y-m-d H:i:s")
            // );
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            // $c = $this->input->post('desc');
            $d = $this->input->post('quantity');
            // $e = $this->input->post('location');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                // $data['description'] = $c[$i];
                $data['qty'] = $d[$i];
                // $data['location'] = $e[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Standard Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['status'] = 'Standard';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimateOptions()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Options',
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            'estimate_type' => 'Bundle',
            'bundle1_message' => $this->input->post('bundle1_message'),
            'bundle2_message' => $this->input->post('bundle2_message'),
            'bundle1_total' => $this->input->post('bundle1_total'),
            'bundle2_total' => $this->input->post('bundle2_total'),
            'bundle_discount' => $this->input->post('bundle_discount'),


            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            'deposit_request' => '$',
            'deposit_amount' => $this->input->post('adjustment_input'), //
            'grand_total' => $this->input->post('supergrandtotal'), //

            'adjustment_name' => $this->input->post('adjustment_name'), //
            'adjustment_value' => $this->input->post('adjustment_input'), //

            'markup_type' => '$', //
            'markup_amount' => $this->input->post('markup_input_form'), //

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Options Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['estimate_type'] = 'Options';
                $data['bundle_option_type'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            $j = $this->input->post('items2');
            $k = $this->input->post('item_type2');
            $l = $this->input->post('quantity2');
            $m = $this->input->post('price2');
            $n = $this->input->post('discount2');
            $o = $this->input->post('tax2');
            $p = $this->input->post('total2');

            $z = 0;
            foreach ($j as $row2) {
                $data2['item'] = $j[$z];
                $data2['item_type'] = $k[$z];
                $data2['qty'] = $l[$z];
                $data2['cost'] = $m[$z];
                $data2['discount'] = $n[$z];
                $data2['tax'] = $o[$z];
                $data2['total'] = $p[$z];
                $data2['type'] = 'Options Estimate';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['estimate_type'] = 'Options';
                $data2['bundle_option_type'] = '2';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
                $z++;
            }

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimateBundle()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Bundle',
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            'estimate_type' => 'Bundle',
            'bundle1_message' => $this->input->post('bundle1_message'),
            'bundle2_message' => $this->input->post('bundle2_message'),
            'bundle1_total' => $this->input->post('bundle1_total'),
            'bundle2_total' => $this->input->post('bundle2_total'),
            'bundle_discount' => $this->input->post('bundle_discount'),


            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            'deposit_request' => '$',
            'deposit_amount' => $this->input->post('adjustment_input'), //
            'grand_total' => $this->input->post('supergrandtotal'), //

            'adjustment_name' => $this->input->post('adjustment_name'), //
            'adjustment_value' => $this->input->post('adjustment_input'), //

            'markup_type' => '$', //
            'markup_amount' => $this->input->post('markup_input_form'), //

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Bundle Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['estimate_type'] = 'Bundle';
                $data['bundle_option_type'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            $j = $this->input->post('items2');
            $k = $this->input->post('item_type2');
            $l = $this->input->post('quantity2');
            $m = $this->input->post('price2');
            $n = $this->input->post('discount2');
            $o = $this->input->post('tax2');
            $p = $this->input->post('total2');

            $z = 0;
            foreach ($j as $row2) {
                $data2['item'] = $j[$z];
                $data2['item_type'] = $k[$z];
                $data2['qty'] = $l[$z];
                $data2['cost'] = $m[$z];
                $data2['discount'] = $n[$z];
                $data2['tax'] = $o[$z];
                $data2['total'] = $p[$z];
                $data2['type'] = 'Bundle Estimate';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['estimate_type'] = 'Bundle';
                $data2['bundle_option_type'] = '2';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
                $z++;
            }

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }

    public function addSalesReceipt()
    {
        if ($this->input->post('current_sales_recept_number') != "") {
            $this->updateSalesReceipt();
        } else {
            $recurringId = null;
            if ($this->input->post("recurring_selected") == 1) {
                $days_in_advance = null;
                $recurring_month = null;
                $recurring_week = null;
                $recurring_day = null;
                $recurr_every = null;
                if ($this->input->post("recurring-type") == "Schedule") {
                    $days_in_advance = $this->input->post("recurring-days-in-advance");
                } elseif ($this->input->post("recurring-type") == "Reminder") {
                    $days_in_advance = $this->input->post("remind-days-before");
                }
                if ($this->input->post("recurring-interval") == "Daily") {
                    $recurr_every = $this->input->post("daily-days");
                } elseif ($this->input->post("recurring-interval") == "Weekly") {
                    $recurr_every = $this->input->post("weekly-every");
                    $recurring_day = $this->input->post("weekly-weeks-on");
                } elseif ($this->input->post("recurring-interval") == "Monthly") {
                    $recurring_month = $this->input->post("recurring-interval");
                    $recurring_week = $this->input->post("monthly-week-order");
                    $recurring_day = $this->input->post("monthly-day-of-the-week");
                    $recurr_every = $this->input->post("monthly-months");
                } elseif ($this->input->post("recurring-interval") == "Yearly") {
                    $recurring_month = $this->input->post("yearly-month");
                    $recurring_day = $this->input->post("yearly-day");
                }
                $recurring_data = array(
                    'company_id' => logged('company_id'),
                    'template_name' => $this->input->post("recurring-template-name"),
                    'recurring_type' => $this->input->post("recurring-type"),
                    'days_in_advance' => $days_in_advance,
                    'txn_type' => $days_in_advance,
                    'txn_id' => $days_in_advance,
                    'recurring_interval' => $this->input->post("recurring-interval"),
                    'recurring_month' => $recurring_month,
                    'recurring_week' => $recurring_week,
                    'recurring_day' => $recurring_day,
                    'recurr_every' => $recurr_every,
                    'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                    'end_type' => $this->input->post("recurring-end-type"),
                    'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                    'max_occurences' => $this->input->post("after-occurrences"),
                    'recurring_auto_send_email' => $this->input->post("recurring_option_1"),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                );
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }

            $customer_id = $this->input->post('customer_id');
            $new_data = array(
                'customer_id' => $this->input->post('customer_id'),
                'email' => $this->input->post('email'),
                'billing_address' => $this->input->post('billing_address'),
                'sales_receipt_date' => date("Y-m-d", strtotime($this->input->post('sales_receipt_date'))),
                'ship_via' => $this->input->post('ship_via'),
                'shipping_date' => $this->input->post('shipping_date'),
                'tracking_no' => $this->input->post('tracking_no'),
                'shipping_to' => $this->input->post('shipping_to'),
                'location_scale' => $this->input->post('location_scale'),
                // 'amount' => $this->input->post('total_amount'),
                'payment_method' => $this->input->post('payment_method'),
                'ref_number' => $this->input->post('ref_number'),
                'deposit_to' => $this->input->post('deposit_to'),
                'message' => $this->input->post('message'),
                'message_on_statement' => $this->input->post('message_on_statement'),
                // 'attachments' => $this->input->post('file_name'),
                'attachments' => $this->input->post("attachement-filenames"),

                // 'shipping' => $this->input->post('shipping'),
                'status' => 1,
                'recurring_id' => $recurringId,
                'created_by' => logged('id'),
                'company_id' => logged('company_id'),

                'subtotal' => $this->input->post('subtotal'),
                'taxes' => $this->input->post('taxes'),
                'adjustment_name' => $this->input->post('adjustment_name'),
                'adjustment_value' => $this->input->post('adjustment_value'),
                'grand_total' => $this->input->post('grand_total'),

                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            );
            $addQuery = $this->accounting_sales_receipt_model->createSalesReceipts($new_data);
            $file_names = explode(",", $this->input->post("attachement-filenames"));
            for ($i = 0; $i < count($file_names); $i++) {
                if ($file_names[$i] != "") {
                    $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                    $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];

                    if (file_exists($source)) {
                        copy($source, $destination);
                        unlink($source);
                    }
                }
            }

            $new_recurring_data = array(
                'txn_type' => "Sales Receipt",
                'txn_id' => $addQuery,
                'customer_id' => $customer_id
            );
            $this->accounting_recurring_transactions_model->updateRecurringTransaction($recurringId, $new_recurring_data);
            if ($this->input->post('payment_method') == 'Cash') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'is_collected' => '1',
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Check') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'check_number' => $this->input->post('check_number'),
                    'routing_number' => $this->input->post('routing_number'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Credit Card') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'credit_number' => $this->input->post('credit_number'),
                    'credit_expiry' => $this->input->post('credit_expiry'),
                    'credit_cvc' => $this->input->post('credit_cvc'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Debit Card') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'credit_number' => $this->input->post('debit_credit_number'),
                    'credit_expiry' => $this->input->post('debit_credit_expiry'),
                    'credit_cvc' => $this->input->post('debit_credit_cvc'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'ACH') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'routing_number' => $this->input->post('ach_routing_number'),
                    'account_number' => $this->input->post('ach_account_number'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Venmo') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('account_credentials'),
                    'account_note' => $this->input->post('account_note'),
                    'confirmation' => $this->input->post('confirmation'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Paypal') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('paypal_account_credentials'),
                    'account_note' => $this->input->post('paypal_account_note'),
                    'confirmation' => $this->input->post('paypal_confirmation'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Square') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('square_account_credentials'),
                    'account_note' => $this->input->post('square_account_note'),
                    'confirmation' => $this->input->post('square_confirmation'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Warranty Work') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('warranty_account_credentials'),
                    'account_note' => $this->input->post('warranty_account_note'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Home Owner Financing') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('home_account_credentials'),
                    'account_note' => $this->input->post('home_account_note'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'e-Transfer') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('e_account_credentials'),
                    'account_note' => $this->input->post('e_account_note'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Other Credit Card Professor') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'credit_number' => $this->input->post('other_credit_number'),
                    'credit_expiry' => $this->input->post('other_credit_expiry'),
                    'credit_cvc' => $this->input->post('other_credit_cvc'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Other Payment Type') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('other_payment_account_credentials'),
                    'account_note' => $this->input->post('other_payment_account_note'),
                    'transaction_type' => "Sales Receipt",
                    'transaction_id' => $addQuery,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            }

            if ($addQuery > 0) {
                // $a = $this->input->post('items');
                // $b = $this->input->post('item_type');
                // $d = $this->input->post('quantity');
                // $f = $this->input->post('price');
                // $g = $this->input->post('discount');
                // $h = $this->input->post('tax');
                // $ii = $this->input->post('total');

                // $i = 0;
                // foreach ($a as $row) {
                //     $data['item'] = $a[$i];
                //     $data['item_type'] = $b[$i];
                //     $data['qty'] = $d[$i];
                //     $data['cost'] = $f[$i];
                //     $data['discount'] = $g[$i];
                //     $data['tax'] = $h[$i];
                //     $data['total'] = (($d[$i] * $f[$i]) + $h[$i]) - $g[$i];
                //     $data['type'] = 'Sales Receipt';
                //     $data['type_id'] = $addQuery;
                //     // $data['status'] = '1';
                //     $data['created_at'] = date("Y-m-d H:i:s");
                //     $data['updated_at'] = date("Y-m-d H:i:s");
                //     $additem_details_id = $this->accounting_invoices_model->additem_details($data);
                //     $i++;
                // } //change item details

                //echo json_encode($addQuery);


                $a = $this->input->post('item_ids');
                //  $packageID  = $this->input->post('packageID');
                $quantity = $this->input->post('quantity');
                $price = $this->input->post('price');
                $h = $this->input->post('tax');
                $discount = $this->input->post('discount');
                $total = $this->input->post('total');
                $item_names = $this->input->post('items');
                $item_type = $this->input->post('item_type');

                $i = 0;
                foreach ($a as $row) {
                    $data['	items_id'] = $a[$i];
                    //  $data['package_id ']    = $packageID[$i];
                    $data['qty'] = $quantity[$i];
                    $data['cost'] = $price[$i];
                    $data['tax'] = $h[$i];
                    $data['discount'] = $discount[$i];
                    $data['total'] = $total[$i];
                    $data['sales_receipt_id'] = $addQuery;
                    $this->accounting_sales_receipt_model->additem_details($data);
                    $i++;
                }


                $sales_receipt_file_name = 'sales_receipt_' . $addQuery . ".pdf";
                $packaging_slip_file_name = 'packaging_slip_' . $addQuery . ".pdf";
                $this->create_pdf_sales_receipt($sales_receipt_file_name, $customer_id, $addQuery, "print_sales_receipt");
                $this->create_pdf_sales_receipt($packaging_slip_file_name, $customer_id, $addQuery, "print_packaging_slip");

                $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

                $data = new stdClass();
                if ($this->input->post("submit_type") == "save-send") {
                    $data->email_sending_status = "updated receipt has been sent";
                }
                $data->business_name = $customer_info->business_name;
                $data->customer_email = $customer_info->email;
                $data->customer_full_name = $customer_info->first_name . ' ' . $customer_info->last_name;
                $data->file_location = base_url("assets/pdf/" . $sales_receipt_file_name);
                $data->count_save = 1;
                $data->sales_receipt_id = $addQuery;
                echo json_encode($data);
            } else {
                echo json_encode(0);
                // print_r($file_put_contents);die;
            }
        }
    }

    public function updateSalesReceipt()
    {
        $sales_receipt_id = $this->input->post('current_sales_recept_number');
        $recurring_already = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($sales_receipt_id);
        $recurringId = $recurring_already->recurring_id;

        if ($this->input->post("recurring_selected") == 1) {
            $days_in_advance = null;
            $recurring_month = null;
            $recurring_week = null;
            $recurring_day = null;
            $recurr_every = null;
            if ($this->input->post("recurring-type") == "Schedule") {
                $days_in_advance = $this->input->post("recurring-days-in-advance");
            } elseif ($this->input->post("recurring-type") == "Reminder") {
                $days_in_advance = $this->input->post("remind-days-before");
            }
            if ($this->input->post("recurring-interval") == "Daily") {
                $recurr_every = $this->input->post("daily-days");
            } elseif ($this->input->post("recurring-interval") == "Weekly") {
                $recurr_every = $this->input->post("weekly-every");
                $recurring_day = $this->input->post("weekly-weeks-on");
            } elseif ($this->input->post("recurring-interval") == "Monthly") {
                $recurring_month = $this->input->post("recurring-interval");
                $recurring_week = $this->input->post("monthly-week-order");
                $recurring_day = $this->input->post("monthly-day-of-the-week");
                $recurr_every = $this->input->post("monthly-months");
            } elseif ($this->input->post("recurring-interval") == "Yearly") {
                $recurring_month = $this->input->post("yearly-month");
                $recurring_day = $this->input->post("yearly-day");
            }
            $recurring_data = array(
                'company_id' => logged('company_id'),
                'template_name' => $this->input->post("recurring-template-name"),
                'recurring_type' => $this->input->post("recurring-type"),
                'days_in_advance' => $days_in_advance,
                'recurring_interval' => $this->input->post("recurring-interval"),
                'recurring_month' => $recurring_month,
                'recurring_week' => $recurring_week,
                'recurring_day' => $recurring_day,
                'recurr_every' => $recurr_every,
                'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                'end_type' => $this->input->post("recurring-end-type"),
                'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                'max_occurences' => $this->input->post("after-occurrences"),
                'recurring_auto_send_email' => $this->input->post("recurring_option_1"),
                'status' => 1,
                'updated_at' => date('Y-m-d h:i:s'),
                'txn_type' => "Sales Receipt",
                'txn_id' => $sales_receipt_id,
                'customer_id' => $this->input->post('customer_id')
            );
            if ($recurring_already->recurring_id != null) {
                $this->accounting_recurring_transactions_model->updateRecurringTransaction($recurring_already->recurring_id, $recurring_data);
            } else {
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }
        } else {
            if ($recurring_already->recurring_id != null) {
                $this->accounting_recurring_transactions_model->delete($recurring_already->recurring_id);
                $recurringId = null;
            }
        }
        $sates_receipt_details_old = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($sales_receipt_id);
        if ($sates_receipt_details_old->attachments != $this->input->post("attachement-filenames")) {
            $old_attachments = explode(",", $sates_receipt_details_old->attachments);
            for ($i = 0; $i < count($old_attachments); $i++) {
                if ($old_attachments[$i] != "") {
                    if (file_exists(("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]))) {
                        unlink("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]);
                    }
                }
            }
        }
        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'billing_address' => $this->input->post('billing_address'),
            'sales_receipt_date' => $this->input->post('sales_receipt_date'),
            'ship_via' => $this->input->post('ship_via'),
            'shipping_date' => $this->input->post('shipping_date'),
            'tracking_no' => $this->input->post('tracking_no'),
            'shipping_to' => $this->input->post('shipping_to'),
            'location_scale' => $this->input->post('location_scale'),
            // 'amount' => $this->input->post('total_amount'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'message' => $this->input->post('message'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => $this->input->post("attachement-filenames"),

            // 'shipping' => $this->input->post('shipping'),
            'status' => 1,
            'recurring_id' => $recurringId,
            'created_by' => logged('id'),
            'company_id' => logged('company_id'),

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $updateQuery = $this->accounting_sales_receipt_model->updateSalesReceipt($sales_receipt_id, $new_data);
        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];

                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }


        if ($updateQuery > 0) {
            $this->accounting_sales_receipt_model->delete_sales_receipt_items($sales_receipt_id);
            $a = $this->input->post('item_ids');
            //  $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');
            $item_names = $this->input->post('items');
            $item_type = $this->input->post('item_type');

            $i = 0;
            foreach ($a as $row) {
                $data['	items_id'] = $a[$i];
                //  $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['sales_receipt_id'] = $sales_receipt_id;
                $this->accounting_sales_receipt_model->additem_details($data);
                $i++;
            }
            $customer_id = $this->input->post('customer_id');
            $sales_receipt_file_name = 'sales_receipt_' . $sales_receipt_id . ".pdf";
            $packaging_slip_file_name = 'packaging_slip_' . $sales_receipt_id . ".pdf";
            $this->create_pdf_sales_receipt($sales_receipt_file_name, $customer_id, $sales_receipt_id, "print_sales_receipt");
            $this->create_pdf_sales_receipt($packaging_slip_file_name, $customer_id, $sales_receipt_id, "print_packaging_slip");

            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

            $data = new stdClass();
            if ($this->input->post("submit_type") == "save-send") {
                $data->email_sending_status = "updated receipt has been sent";
            }
            $data->business_name = $customer_info->business_name;
            $data->customer_email = $customer_info->email;
            $data->customer_full_name = $customer_info->first_name . ' ' . $customer_info->last_name;
            $data->file_location = base_url("assets/pdf/" . $sales_receipt_file_name);
            $data->count_save = 1;
            $data->sales_receipt_id = $sales_receipt_id;
            echo json_encode($data);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteSalesReceipt()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_sales_receipt_model->deleteSalesReceipt($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function updateRefundReceipt()
    {
        $refund_receipt_id = $this->input->post('current_refund_recept_number');
        $recurring_already = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($refund_receipt_id);
        $recurringId = $recurring_already->recurring_id;
        if ($this->input->post("recurring_selected") == 1) {
            $days_in_advance = null;
            $recurring_month = null;
            $recurring_week = null;
            $recurring_day = null;
            $recurr_every = null;
            if ($this->input->post("recurring-type") == "Schedule") {
                $days_in_advance = $this->input->post("recurring-days-in-advance");
            } elseif ($this->input->post("recurring-type") == "Reminder") {
                $days_in_advance = $this->input->post("remind-days-before");
            }
            if ($this->input->post("recurring-interval") == "Daily") {
                $recurr_every = $this->input->post("daily-days");
            } elseif ($this->input->post("recurring-interval") == "Weekly") {
                $recurr_every = $this->input->post("weekly-every");
                $recurring_day = $this->input->post("weekly-weeks-on");
            } elseif ($this->input->post("recurring-interval") == "Monthly") {
                $recurring_month = $this->input->post("recurring-interval");
                $recurring_week = $this->input->post("monthly-week-order");
                $recurring_day = $this->input->post("monthly-day-of-the-week");
                $recurr_every = $this->input->post("monthly-months");
            } elseif ($this->input->post("recurring-interval") == "Yearly") {
                $recurring_month = $this->input->post("yearly-month");
                $recurring_day = $this->input->post("yearly-day");
            }
            $recurring_data = array(
                    'company_id' => logged('company_id'),
                    'customer_id' => $this->input->post("customer_id"),
                    'template_name' => $this->input->post("recurring-template-name"),
                    'recurring_type' => $this->input->post("recurring-type"),
                    'days_in_advance' => $days_in_advance,
                    'txn_type' => "Refund Receipt",
                    'txn_id' => $refund_receipt_id,
                    'recurring_interval' => $this->input->post("recurring-interval"),
                    'recurring_month' => $recurring_month,
                    'recurring_week' => $recurring_week,
                    'recurring_day' => $recurring_day,
                    'recurr_every' => $recurr_every,
                    'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                    'end_type' => $this->input->post("recurring-end-type"),
                    'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                    'max_occurences' => $this->input->post("after-occurrences"),
                    'recurring_auto_send_email' => $this->input->post("recurring_option_1"),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                );
            if ($recurring_already->recurring_id != null) {
                $this->accounting_recurring_transactions_model->updateRecurringTransaction($recurring_already->recurring_id, $recurring_data);
            } else {
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }
        } else {
            if ($recurring_already->recurring_id != null) {
                $this->accounting_recurring_transactions_model->delete($recurring_already->recurring_id);
                $recurringId = null;
            }
        }
        $refund_receipt_details_old = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($refund_receipt_id);
        if ($refund_receipt_details_old->attachments != $this->input->post("attachement-filenames")) {
            $old_attachments = explode(",", $refund_receipt_details_old->attachments);
            for ($i = 0; $i < count($old_attachments); $i++) {
                if ($old_attachments[$i] != "") {
                    if (file_exists(("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]))) {
                        unlink("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]);
                    }
                }
            }
        }

        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }

        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();
        $customer_id = $this->input->post('customer_id');
        $new_data = array(
            'recurring_id' => $recurringId,
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('customer_email'),
            'refund_receipt_date' => $this->input->post('refund_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_sale' => $this->input->post('location_scale'),
            'payment_method' => $this->input->post('payment_method'),
            'refund_form' => $this->input->post('refund_form'),
            'tags' => $this->input->post('tags'),
            // 'total_amount' => $this->input->post('total_amount'),
            'message_refund' => $this->input->post('message_refund'),
            'message_statement' => $this->input->post('mess_statement'),
            // 'tax_rate' => $this->input->post('tax_rate'),
            'shipping' => $this->input->post('shipping'),
            'attachments' => $this->input->post("attachement-filenames"),
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),
            'created_by' => logged('id'),
            'date_modified' => date("Y-m-d H:i:s"),
            'cc_email' => $this->input->post('email-cc'),
            'bcc_email' => $this->input->post('email-bcc')
        );

        $updateQuery = $this->accounting_refund_receipt_model->updateRefundReceipt($refund_receipt_id, $new_data);
        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];

                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }
        if ($updateQuery) {
            $this->accounting_refund_receipt_model->delete_refund_receipt_items($refund_receipt_id);
            $a = $this->input->post('item_ids');
            //  $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');
            $item_names = $this->input->post('items');
            $item_type = $this->input->post('item_type');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                //  $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['refund_receipt_id'] = $refund_receipt_id;
                $this->accounting_refund_receipt_model->additem_details($data);
                $i++;
            }
            $refund_receipt_file_name = 'refund_receipt_' . $refund_receipt_id . ".pdf";
            $this->create_pdf_refund_receipt($refund_receipt_file_name, $customer_id, $refund_receipt_id, "print_refund_receipt");

            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

            $data = new stdClass();
            if ($this->input->post("submit_type") == "save-send") {
                $data->email_sending_status = "updated receipt has been sent";
            }
            $data->business_name = $customer_info->business_name;
            $data->customer_email = $this->input->post('customer_email');
            $data->customer_full_name = $customer_info->first_name . ' ' . $customer_info->last_name;
            $data->file_location = base_url("assets/pdf/" . $refund_receipt_file_name);
            $data->count_save = 1;
            $data->refund_receipt_id = $refund_receipt_id;
            echo json_encode($data);
        } else {
            echo json_encode(0);
        }
    }
    public function addRefundReceipt()
    {
        if ($this->input->post('current_refund_recept_number') != "") {
            $this->updateRefundReceipt();
        } else {
            $recurringId = null;
            if ($this->input->post("recurring_selected") == 1) {
                $days_in_advance = null;
                $recurring_month = null;
                $recurring_week = null;
                $recurring_day = null;
                $recurr_every = null;
                if ($this->input->post("recurring-type") == "Schedule") {
                    $days_in_advance = $this->input->post("recurring-days-in-advance");
                } elseif ($this->input->post("recurring-type") == "Reminder") {
                    $days_in_advance = $this->input->post("remind-days-before");
                }
                if ($this->input->post("recurring-interval") == "Daily") {
                    $recurr_every = $this->input->post("daily-days");
                } elseif ($this->input->post("recurring-interval") == "Weekly") {
                    $recurr_every = $this->input->post("weekly-every");
                    $recurring_day = $this->input->post("weekly-weeks-on");
                } elseif ($this->input->post("recurring-interval") == "Monthly") {
                    $recurring_month = $this->input->post("recurring-interval");
                    $recurring_week = $this->input->post("monthly-week-order");
                    $recurring_day = $this->input->post("monthly-day-of-the-week");
                    $recurr_every = $this->input->post("monthly-months");
                } elseif ($this->input->post("recurring-interval") == "Yearly") {
                    $recurring_month = $this->input->post("yearly-month");
                    $recurring_day = $this->input->post("yearly-day");
                }
                $recurring_data = array(
                    'company_id' => logged('company_id'),
                    'template_name' => $this->input->post("recurring-template-name"),
                    'recurring_type' => $this->input->post("recurring-type"),
                    'days_in_advance' => $days_in_advance,
                    'txn_type' => $days_in_advance,
                    'txn_id' => $days_in_advance,
                    'recurring_interval' => $this->input->post("recurring-interval"),
                    'recurring_month' => $recurring_month,
                    'recurring_week' => $recurring_week,
                    'recurring_day' => $recurring_day,
                    'recurr_every' => $recurr_every,
                    'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                    'end_type' => $this->input->post("recurring-end-type"),
                    'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                    'max_occurences' => $this->input->post("after-occurrences"),
                    'recurring_auto_send_email' => $this->input->post("recurring_option_1"),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                );
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }
            $company_id = getLoggedCompanyID();
            $user_id = getLoggedUserID();
            $customer_id = $this->input->post('customer_id');
            $new_data = array(
            'recurring_id' => $recurringId,
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('customer_email'),
            'refund_receipt_date' => $this->input->post('refund_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_sale' => $this->input->post('location_scale'),
            'payment_method' => $this->input->post('payment_method'),
            'refund_form' => $this->input->post('refund_form'),
            'tags' => $this->input->post('tags'),
            // 'total_amount' => $this->input->post('total_amount'),
            'message_refund' => $this->input->post('message_refund'),
            'message_statement' => $this->input->post('mess_statement'),
            // 'tax_rate' => $this->input->post('tax_rate'),
            'shipping' => $this->input->post('shipping'),
            'attachments' => $this->input->post("attachement-filenames"),
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),
            'created_by' => logged('id'),
            'date_modified' => date("Y-m-d H:i:s"),
            'cc_email' => $this->input->post('email-cc'),
            'bcc_email' => $this->input->post('email-bcc')
        );
            $addQuery = $this->accounting_refund_receipt_model->createRefundReceipts($new_data);

            $file_names = explode(",", $this->input->post("attachement-filenames"));
            for ($i = 0; $i < count($file_names); $i++) {
                if ($file_names[$i] != "") {
                    $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                    $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                    if (file_exists($source)) {
                        copy($source, $destination);
                        unlink($source);
                    }
                }
            }

            $new_recurring_data = array(
                'txn_type' => "Refund Receipt",
                'txn_id' => $addQuery,
                'customer_id' => $customer_id
            );
            $this->accounting_recurring_transactions_model->updateRecurringTransaction($recurringId, $new_recurring_data);

            if ($this->input->post('payment_method') == 'Cash') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'is_collected' => '1',
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Check') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'check_number' => $this->input->post('check_number'),
                'routing_number' => $this->input->post('routing_number'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Credit Card') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('credit_number'),
                'credit_expiry' => $this->input->post('credit_expiry'),
                'credit_cvc' => $this->input->post('credit_cvc'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Debit Card') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('debit_credit_number'),
                'credit_expiry' => $this->input->post('debit_credit_expiry'),
                'credit_cvc' => $this->input->post('debit_credit_cvc'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'ACH') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'routing_number' => $this->input->post('ach_routing_number'),
                'account_number' => $this->input->post('ach_account_number'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Venmo') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('account_credentials'),
                'account_note' => $this->input->post('account_note'),
                'confirmation' => $this->input->post('confirmation'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Paypal') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('paypal_account_credentials'),
                'account_note' => $this->input->post('paypal_account_note'),
                'confirmation' => $this->input->post('paypal_confirmation'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Square') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('square_account_credentials'),
                'account_note' => $this->input->post('square_account_note'),
                'confirmation' => $this->input->post('square_confirmation'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Warranty Work') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('warranty_account_credentials'),
                'account_note' => $this->input->post('warranty_account_note'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Home Owner Financing') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('home_account_credentials'),
                'account_note' => $this->input->post('home_account_note'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'e-Transfer') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('e_account_credentials'),
                'account_note' => $this->input->post('e_account_note'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Other Credit Card Professor') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('other_credit_number'),
                'credit_expiry' => $this->input->post('other_credit_expiry'),
                'credit_cvc' => $this->input->post('other_credit_cvc'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Other Payment Type') {
                $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('other_payment_account_credentials'),
                'account_note' => $this->input->post('other_payment_account_note'),
                'transaction_type' => "Sales Receipt",
                'transaction_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            }

            // $path = './assets/files/'.$company_id;
            // $companypath = $path . '/company';
            // if(!is_dir($path)){
            // if(is_writeable('./assets/files/')){
            //     if(mkdir($path,0755,TRUE)){
            //     echo "Created $path";
            //     if(mkdir($companypath,0755,TRUE)){
            //         echo "Created $companypath";
            //     } else {
            //         echo "Failed to create $companypath";
            //     }
            //     } else {
            //     echo "Failed to create $path";
            //     }

            // } else {
            //     echo 'PHP does not have the privileges to modify "./assets/files/" directory.';
            //     $stat = stat($path);
            //     print_r(posix_getpwuid($stat['uid']));

            //     chmod($path, 0755); // trying to change permissions
            //     //chown($path, $stat['uid']);
            // }

            // } else {
            // echo 'directory already exists.';
            // }

            if ($addQuery > 0) {
                $a = $this->input->post('item_ids');
                //  $packageID  = $this->input->post('packageID');
                $quantity = $this->input->post('quantity');
                $price = $this->input->post('price');
                $h = $this->input->post('tax');
                $discount = $this->input->post('discount');
                $total = $this->input->post('total');
                $item_names = $this->input->post('items');
                $item_type = $this->input->post('item_type');

                $i = 0;
                foreach ($a as $row) {
                    $data['items_id'] = $a[$i];
                    //  $data['package_id ']    = $packageID[$i];
                    $data['qty'] = $quantity[$i];
                    $data['cost'] = $price[$i];
                    $data['tax'] = $h[$i];
                    $data['discount'] = $discount[$i];
                    $data['total'] = $total[$i];
                    $data['refund_receipt_id'] = $addQuery;
                    $this->accounting_refund_receipt_model->additem_details($data);
                    $i++;
                }
                $refund_receipt_file_name = 'refund_receipt_' . $addQuery . ".pdf";
                $this->create_pdf_refund_receipt($refund_receipt_file_name, $customer_id, $addQuery, "print_refund_receipt");

                $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

                $data = new stdClass();
                if ($this->input->post("submit_type") == "save-send") {
                    $data->email_sending_status = "updated receipt has been sent";
                }
                $data->business_name = $customer_info->business_name;
                $data->customer_email = $this->input->post('customer_email');
                $data->customer_full_name = $customer_info->first_name . ' ' . $customer_info->last_name;
                $data->file_location = base_url("assets/pdf/" . $refund_receipt_file_name);
                $data->count_save = 1;
                $data->refund_receipt_id = $addQuery;
                echo json_encode($data);
            }
        }
    }
    public function create_pdf_refund_receipt($file_name, $customer_id, $refund_number, $action = "")
    {
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $refund_receipt_info = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($refund_number);
        $refund_receipt_items = $this->accounting_refund_receipt_model->get_refund_receipt_items($refund_number);
        $data = array(
            'business_name' => $customer_info->business_name,
            'business_address_street' => $refund_receipt_info->location_scale,
            'business_address_state' => "",
            'business_contact_number' => $customer_info->business_phone,
            'business_email' => $customer_info->business_email,
            'business_logo' => $customer_info->business_id . "/" . $customer_info->business_image,
            'refund_number' => $refund_receipt_info->id,
            'adjustment_name' => $refund_receipt_info->adjustment_name,
            'adjustment_value' => $refund_receipt_info->adjustment_value,
            'receipt_date' => $refund_receipt_info->date_created,
            'customer_full_name' => $customer_info->first_name . ' ' . $customer_info->last_name,
            'customer_adress_street' => $refund_receipt_info->billing_address,
            'customer_address_state' => '',
            'items' => $refund_receipt_items,
        );
        if ($action == "download_print_refund_receipt") {
            $this->pdf->load_view("accounting/customer_includes/refund_receipt/refund_receipt_to_pdf", $data, $file_name, "P");
        } elseif ($action == "print_refund_receipt") {
            $this->pdf->save_pdf("accounting/customer_includes/refund_receipt/refund_receipt_to_pdf", $data, $file_name, "P");
        }
    }
    public function view_print_refund_receipt()
    {
        $action = $this->input->post("action");
        if ($action == "print_packaging_slip") {
            $file_name = 'packaging_slip_' . $this->input->post("refund_number") . ".pdf";
        } else {
            $file_name = 'refund_receipt_' . $this->input->post("refund_number") . ".pdf";
        }
        $customer_id = $this->input->post("customer_id");
        $refund_number = $this->input->post("refund_number");

        $this->create_pdf_refund_receipt($file_name, $customer_id, $refund_number, $action);

        $data = new stdClass();
        $data->file_location = base_url("assets/pdf/" . $file_name);
        echo json_encode($data);
    }

    public function update_DelayedCredit()
    {
        $delayed_credit_id = $this->input->post("delayed_credit_id");
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();
        $customer_id =$this->input->post('customer_id');
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $dayed_credit_info = $this->accounting_delayed_credit_model->getDelayedCreditDetails($delayed_credit_id);

        $recurringId = null;
        if ($this->input->post("recurring_selected") == 1) {
            $days_in_advance = null;
            $recurring_month = null;
            $recurring_week = null;
            $recurring_day = null;
            $recurr_every = null;
            if ($this->input->post("recurring-type") == "Schedule") {
                $days_in_advance = $this->input->post("recurring-days-in-advance");
            } elseif ($this->input->post("recurring-type") == "Reminder") {
                $days_in_advance = $this->input->post("remind-days-before");
            }
            if ($this->input->post("recurring-interval") == "Daily") {
                $recurr_every = $this->input->post("daily-days");
            } elseif ($this->input->post("recurring-interval") == "Weekly") {
                $recurr_every = $this->input->post("weekly-every");
                $recurring_day = $this->input->post("weekly-weeks-on");
            } elseif ($this->input->post("recurring-interval") == "Monthly") {
                $recurring_month = $this->input->post("recurring-interval");
                $recurring_week = $this->input->post("monthly-week-order");
                $recurring_day = $this->input->post("monthly-day-of-the-week");
                $recurr_every = $this->input->post("monthly-months");
            } elseif ($this->input->post("recurring-interval") == "Yearly") {
                $recurring_month = $this->input->post("yearly-month");
                $recurring_day = $this->input->post("yearly-day");
            }
            $recurring_data = array(
                'company_id' => logged('company_id'),
                'template_name' => $this->input->post("recurring-template-name"),
                'recurring_type' => $this->input->post("recurring-type"),
                'days_in_advance' => $days_in_advance,
                'recurring_interval' => $this->input->post("recurring-interval"),
                'recurring_month' => $recurring_month,
                'recurring_week' => $recurring_week,
                'recurring_day' => $recurring_day,
                'recurr_every' => $recurr_every,
                'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                'end_type' => $this->input->post("recurring-end-type"),
                'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                'max_occurences' => $this->input->post("after-occurrences"),
                'status' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'txn_type' => "Delayed Charge",
                'txn_id' => $delayed_credit_id,
                'customer_id' => $customer_id
            );
            if ($dayed_credit_info->recurring_id != null) {
                $this->accounting_recurring_transactions_model->updateRecurringTransaction(
                    $dayed_credit_info->recurring_id,
                    $recurring_data
                );
            } else {
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }
        } else {
            if ($dayed_credit_info->recurring_id != null) {
                $this->accounting_recurring_transactions_model->delete($dayed_credit_info->recurring_id);
                $recurringId = null;
            }
        }
        if ($dayed_credit_info->attachments != $this->input->post("attachement-filenames")) {
            $old_attachments = explode(",", $dayed_credit_info->attachments);
            for ($i = 0; $i < count($old_attachments); $i++) {
                if ($old_attachments[$i] != "") {
                    if (file_exists(("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]))) {
                        unlink("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]);
                    }
                }
            }
        }
        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }


        $new_data = array(
        'customer_id' => $this->input->post('customer_id'),
        'delayed_credit_date' => $this->input->post('delayed_credit_date'),
        'tags' => $this->input->post('tags'),
        'total_amount' => $this->input->post('grand_total_amount'),
        // 'sub_total' => $this->input->post('sub_total'),
        'memo' => $this->input->post('memo'),
        'attachments' => $this->input->post("attachement-filenames"),
        'status' => 1,
        'user_id' => $user_id,
        'company_id' => $company_id,
        'recurring_id' => $recurringId,
        'created_by' => logged('id'),
        'date_modified' => date("Y-m-d H:i:s")
    );

        $update_query = $this->accounting_delayed_credit_model->updateDelayedCredit($delayed_credit_id, $new_data);
        
        // if($addQuery > 0){
        //     redirect('accounting/banking');
        //     // echo json_encode($addQuery);
        // }
        if ($update_query) {
            $this->accounting_delayed_credit_model->delete_delayed_credit_items($delayed_credit_id);
            $a = $this->input->post('item_ids');
            //  $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');
            $item_names = $this->input->post('items');
            $item_type = $this->input->post('item_type');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                //  $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['delayed_credit_id'] = $delayed_credit_id;
                $this->accounting_delayed_credit_model->additem_details($data);
                $i++;
            }
            $data = new stdClass();
            $data->count_save = 1;
            $data->delayed_credit_id = $delayed_credit_id;
            echo json_encode($data);
        } else {
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }
    public function addDelayedCredit()
    {
        if ($this->input->post('delayed_credit_id') != "") {
            $this->update_DelayedCredit();
        } else {
            $recurringId = null;
            if ($this->input->post("recurring_selected") == 1) {
                $days_in_advance = null;
                $recurring_month = null;
                $recurring_week = null;
                $recurring_day = null;
                $recurr_every = null;
                if ($this->input->post("recurring-type") == "Schedule") {
                    $days_in_advance = $this->input->post("recurring-days-in-advance");
                } elseif ($this->input->post("recurring-type") == "Reminder") {
                    $days_in_advance = $this->input->post("remind-days-before");
                }
                if ($this->input->post("recurring-interval") == "Daily") {
                    $recurr_every = $this->input->post("daily-days");
                } elseif ($this->input->post("recurring-interval") == "Weekly") {
                    $recurr_every = $this->input->post("weekly-every");
                    $recurring_day = $this->input->post("weekly-weeks-on");
                } elseif ($this->input->post("recurring-interval") == "Monthly") {
                    $recurring_month = $this->input->post("recurring-interval");
                    $recurring_week = $this->input->post("monthly-week-order");
                    $recurring_day = $this->input->post("monthly-day-of-the-week");
                    $recurr_every = $this->input->post("monthly-months");
                } elseif ($this->input->post("recurring-interval") == "Yearly") {
                    $recurring_month = $this->input->post("yearly-month");
                    $recurring_day = $this->input->post("yearly-day");
                }
                $recurring_data = array(
                    'company_id' => logged('company_id'),
                    'template_name' => $this->input->post("recurring-template-name"),
                    'recurring_type' => $this->input->post("recurring-type"),
                    'days_in_advance' => $days_in_advance,
                    'txn_type' => "Delayed Credit",
                    'txn_id' => 0,
                    'recurring_interval' => $this->input->post("recurring-interval"),
                    'recurring_month' => $recurring_month,
                    'recurring_week' => $recurring_week,
                    'recurring_day' => $recurring_day,
                    'recurr_every' => $recurr_every,
                    'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                    'end_type' => $this->input->post("recurring-end-type"),
                    'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                    'max_occurences' => $this->input->post("after-occurrences"),
                    'recurring_auto_send_email' => $this->input->post("recurring_option_1"),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                );
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }

            $company_id = getLoggedCompanyID();
            $user_id = getLoggedUserID();
            $customer_id =$this->input->post('customer_id');
            $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'delayed_credit_date' => $this->input->post('delayed_credit_date'),
            'tags' => $this->input->post('tags'),
            'total_amount' => $this->input->post('grand_total_amount'),
            // 'sub_total' => $this->input->post('sub_total'),
            'memo' => $this->input->post('memo'),
            'attachments' => $this->input->post("attachement-filenames"),
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'recurring_id' => $recurringId,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s")
        );
            $addQuery = $this->accounting_delayed_credit_model->createDelayedCredit($new_data);

            $file_names = explode(",", $this->input->post("attachement-filenames"));
            for ($i = 0; $i < count($file_names); $i++) {
                if ($file_names[$i] != "") {
                    $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                    $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                    if (file_exists($source)) {
                        copy($source, $destination);
                        unlink($source);
                    }
                }
            }

            $new_recurring_data = array(
            'txn_type' => "Delayed Credit",
            'txn_id' => $addQuery,
            'customer_id' => $customer_id
        );
            $this->accounting_recurring_transactions_model->updateRecurringTransaction($recurringId, $new_recurring_data);
            // if($addQuery > 0){
            //     redirect('accounting/banking');
            //     // echo json_encode($addQuery);
            // }
            if ($addQuery > 0) {
                $a = $this->input->post('item_ids');
                //  $packageID  = $this->input->post('packageID');
                $quantity = $this->input->post('quantity');
                $price = $this->input->post('price');
                $h = $this->input->post('tax');
                $discount = $this->input->post('discount');
                $total = $this->input->post('total');
                $item_names = $this->input->post('items');
                $item_type = $this->input->post('item_type');

                $i = 0;
                foreach ($a as $row) {
                    $data['items_id'] = $a[$i];
                    //  $data['package_id ']    = $packageID[$i];
                    $data['qty'] = $quantity[$i];
                    $data['cost'] = $price[$i];
                    $data['tax'] = $h[$i];
                    $data['discount'] = $discount[$i];
                    $data['total'] = $total[$i];
                    $data['delayed_credit_id'] = $addQuery;
                    $this->accounting_delayed_credit_model->additem_details($data);
                    $i++;
                }
                $data = new stdClass();
                $data->count_save = 1;
                $data->delayed_credit_id = $addQuery;
                echo json_encode($data);
            } else {
                echo json_encode(0);
                // print_r($file_put_contents);die;
            }
        }
    }

    public function addCreditMemo()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        // $profile = json_encode($people);

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'credit_memo_date' => $this->input->post('credit_memo_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_scale' => $this->input->post('location_scale'),
            'message_credit_memo' => $this->input->post('message_displayed_on_credit_memo'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'attachments' => 'testing',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),

            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_credit_memo_model->createCreditMemo($new_data);

        // if($addQuery > 0){
        //     redirect('accounting/banking');
        //     // echo json_encode($addQuery);
        // }

        // $path = './assets/files/'.$company_id;
        // $companypath = $path . '/company';
        // if(!is_dir($path)){
        // if(is_writeable('./assets/files/')){
        //     if(mkdir($path,0755,TRUE)){
        //     echo "Created $path";
        //     if(mkdir($companypath,0755,TRUE)){
        //         echo "Created $companypath";
        //     } else {
        //         echo "Failed to create $companypath";
        //     }
        //     } else {
        //     echo "Failed to create $path";
        //     }

        // } else {
        //     echo 'PHP does not have the privileges to modify "./assets/files/" directory.';
        //     $stat = stat($path);
        //     print_r(posix_getpwuid($stat['uid']));

        //     chmod($path, 0755); // trying to change permissions
        //     //chown($path, $stat['uid']);
        // }

        // } else {
        // echo 'directory already exists.';
        // }

        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = (float)$h[$i] * ($f[$i] * $d[$i]);
                $data['total'] = $ii[$i];
                $data['type'] = 'Credit Memo';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }

    public function updateCreditMemo()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'credit_memo_date' => $this->input->post('credit_memo_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_scale' => $this->input->post('location_scale'),
            'products' => $this->input->post('products'),
            'description' => $this->input->post('description'),
            'qty' => $this->input->post('qty'),
            'rate' => $this->input->post('rate'),
            'amount' => $this->input->post('amount'),
            'tax' => $this->input->post('tax'),
            'message_displayed_on_credit_memo' => $this->input->post('message_displayed_on_credit_memo'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'tax_rate' => $this->input->post('tax_rate'),
            'see_the_math' => $this->input->post('see_the_math'),
            'attachments' => $this->input->post('file_name'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $updateQuery = $this->accounting_credit_memo_model->updateCreditMemo($this->input->post('id'), $new_data);

        if ($updateQuery > 0) {
            echo json_encode($updateQuery);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteCreditMemo()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_credit_memo_model->deleteCreditMemo($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addDelayedCharge()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();
        if ($this->input->post('delayed_charge_id') != "") {
            $this->update_DelayedCharge();
        } else {
            $customer_id = $this->input->post('customer_id');
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
            $recurringId = null;
            if ($this->input->post("recurring_selected") == 1) {
                $days_in_advance = null;
                $recurring_month = null;
                $recurring_week = null;
                $recurring_day = null;
                $recurr_every = null;
                if ($this->input->post("recurring-type") == "Schedule") {
                    $days_in_advance = $this->input->post("recurring-days-in-advance");
                } elseif ($this->input->post("recurring-type") == "Reminder") {
                    $days_in_advance = $this->input->post("remind-days-before");
                }
                if ($this->input->post("recurring-interval") == "Daily") {
                    $recurr_every = $this->input->post("daily-days");
                } elseif ($this->input->post("recurring-interval") == "Weekly") {
                    $recurr_every = $this->input->post("weekly-every");
                    $recurring_day = $this->input->post("weekly-weeks-on");
                } elseif ($this->input->post("recurring-interval") == "Monthly") {
                    $recurring_month = $this->input->post("recurring-interval");
                    $recurring_week = $this->input->post("monthly-week-order");
                    $recurring_day = $this->input->post("monthly-day-of-the-week");
                    $recurr_every = $this->input->post("monthly-months");
                } elseif ($this->input->post("recurring-interval") == "Yearly") {
                    $recurring_month = $this->input->post("yearly-month");
                    $recurring_day = $this->input->post("yearly-day");
                }
                $recurring_data = array(
                    'company_id' => logged('company_id'),
                    'template_name' => $this->input->post("recurring-template-name"),
                    'recurring_type' => $this->input->post("recurring-type"),
                    'days_in_advance' => $days_in_advance,
                    'recurring_interval' => $this->input->post("recurring-interval"),
                    'recurring_month' => $recurring_month,
                    'recurring_week' => $recurring_week,
                    'recurring_day' => $recurring_day,
                    'recurr_every' => $recurr_every,
                    'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                    'end_type' => $this->input->post("recurring-end-type"),
                    'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                    'max_occurences' => $this->input->post("after-occurrences"),
                    'status' => 1
                );
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }


            $new_data = array(
                'customer_id' => $customer_id,
                'delayed_credit_date' => $this->input->post('delayed_charge_date'),
                'tags' => $this->input->post('tags'),
                'total_amount' => $this->input->post('grand_total_amount'),
                'memo' => $this->input->post('memo'),
                'attachments' => $this->input->post("attachement-filenames"),
                'status' => 1,
                'user_id' => $user_id,
                'company_id' => $company_id,
                'created_by' => logged('id'),
                'recurring_id' => $recurringId
            );
            $delayed_charge_id = $this->accounting_delayed_charge_model->createDelayedCharge($new_data);
            $file_names = explode(",", $this->input->post("attachement-filenames"));
            for ($i = 0; $i < count($file_names); $i++) {
                if ($file_names[$i] != "") {
                    $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                    $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];

                    if (file_exists($source)) {
                        copy($source, $destination);
                        unlink($source);
                    }
                }
            }

            $new_recurring_data = array(
                'txn_type' => "Delayed Charge",
                'txn_id' => $delayed_charge_id,
                'customer_id' => $customer_id,
            );
            $this->accounting_recurring_transactions_model->updateRecurringTransaction($recurringId, $new_recurring_data);

            // if($addQuery > 0){
            //     redirect('accounting/banking');
            //     // echo json_encode($addQuery);
            // }
            if ($delayed_charge_id > 0) {
                $a = $this->input->post('item_ids');
                //  $packageID  = $this->input->post('packageID');
                $quantity = $this->input->post('quantity');
                $price = $this->input->post('price');
                $h = $this->input->post('tax');
                $discount = $this->input->post('discount');
                $total = $this->input->post('total');
                $item_names = $this->input->post('items');
                $item_type = $this->input->post('item_type');
    
                $i = 0;
                foreach ($a as $row) {
                    $data['items_id'] = $a[$i];
                    //  $data['package_id ']    = $packageID[$i];
                    $data['qty'] = $quantity[$i];
                    $data['cost'] = $price[$i];
                    $data['tax'] = $h[$i];
                    $data['discount'] = $discount[$i];
                    $data['total'] = $total[$i];
                    $data['delayed_charge_id'] = $delayed_charge_id;
                    $this->accounting_delayed_charge_model->additem_details($data);
                    $i++;
                }
            }
            $data = new stdClass();
            $data->count_save = 1;
            $data->delayed_charge_id = $delayed_charge_id;
            echo json_encode($data);
        }
    }

    public function update_DelayedCharge()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $delayed_charge_id = $this->input->post("delayed_charge_id");
        $customer_id = $this->input->post('customer_id');
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $dayed_charge_info = $this->accounting_delayed_charge_model->getDelayedChargeDetails($delayed_charge_id);
        $recurringId = null;
        if ($this->input->post("recurring_selected") == 1) {
            $days_in_advance = null;
            $recurring_month = null;
            $recurring_week = null;
            $recurring_day = null;
            $recurr_every = null;
            if ($this->input->post("recurring-type") == "Schedule") {
                $days_in_advance = $this->input->post("recurring-days-in-advance");
            } elseif ($this->input->post("recurring-type") == "Reminder") {
                $days_in_advance = $this->input->post("remind-days-before");
            }
            if ($this->input->post("recurring-interval") == "Daily") {
                $recurr_every = $this->input->post("daily-days");
            } elseif ($this->input->post("recurring-interval") == "Weekly") {
                $recurr_every = $this->input->post("weekly-every");
                $recurring_day = $this->input->post("weekly-weeks-on");
            } elseif ($this->input->post("recurring-interval") == "Monthly") {
                $recurring_month = $this->input->post("recurring-interval");
                $recurring_week = $this->input->post("monthly-week-order");
                $recurring_day = $this->input->post("monthly-day-of-the-week");
                $recurr_every = $this->input->post("monthly-months");
            } elseif ($this->input->post("recurring-interval") == "Yearly") {
                $recurring_month = $this->input->post("yearly-month");
                $recurring_day = $this->input->post("yearly-day");
            }
            $recurring_data = array(
                'company_id' => logged('company_id'),
                'template_name' => $this->input->post("recurring-template-name"),
                'recurring_type' => $this->input->post("recurring-type"),
                'days_in_advance' => $days_in_advance,
                'recurring_interval' => $this->input->post("recurring-interval"),
                'recurring_month' => $recurring_month,
                'recurring_week' => $recurring_week,
                'recurring_day' => $recurring_day,
                'recurr_every' => $recurr_every,
                'start_date' => $this->input->post("recurring-start-date") != "" ? date("Y-m-d", strtotime($this->input->post("recurring-start-date"))) : null,
                'end_type' => $this->input->post("recurring-end-type"),
                'end_date' => $this->input->post("by-end-date") != "" ? date("Y-m-d", strtotime($this->input->post("by-end-date"))) : null,
                'max_occurences' => $this->input->post("after-occurrences"),
                'status' => 1,
                'updated_at' => date("Y-m-d H:i:s"),
                'txn_type' => "Delayed Charge",
                'txn_id' => $delayed_charge_id,
                'customer_id' => $customer_id
            );
            if ($dayed_charge_info->recurring_id != null) {
                $this->accounting_recurring_transactions_model->updateRecurringTransaction(
                    $dayed_charge_info->recurring_id,
                    $recurring_data
                );
            } else {
                $recurringId = $this->accounting_recurring_transactions_model->create($recurring_data);
            }
        } else {
            if ($dayed_charge_info->recurring_id != null) {
                $this->accounting_recurring_transactions_model->delete($dayed_charge_info->recurring_id);
                $recurringId = null;
            }
        }

        if ($dayed_charge_info->attachments != $this->input->post("attachement-filenames")) {
            $old_attachments = explode(",", $dayed_charge_info->attachments);
            for ($i = 0; $i < count($old_attachments); $i++) {
                if ($old_attachments[$i] != "") {
                    if (file_exists(("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]))) {
                        unlink("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]);
                    }
                }
            }
        }

        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }


        $new_data = array(
            'customer_id' => $customer_id,
            'delayed_credit_date' => $this->input->post('delayed_charge_date'),
            'tags' => $this->input->post('tags'),
            'total_amount' => $this->input->post('grand_total_amount'),
            'memo' => $this->input->post('memo'),
            'attachments' => $this->input->post("attachement-filenames"),
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'recurring_id' => $recurringId,
            'date_modified' => date("Y-m-d H:i:s")
        );

        $update_query = $this->accounting_delayed_charge_model->updateDelayedCharge($delayed_charge_id, $new_data);

        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }
        // if($addQuery > 0){
        //     redirect('accounting/banking');
        //     // echo json_encode($addQuery);
        // }
        if ($update_query) {
            $this->accounting_delayed_charge_model->delete_delayed_charge_items($delayed_charge_id);
            $a = $this->input->post('item_ids');
            //  $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');
            $item_names = $this->input->post('items');
            $item_type = $this->input->post('item_type');
    
            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                //  $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['delayed_charge_id'] = $delayed_charge_id;
                $this->accounting_delayed_charge_model->additem_details($data);
                $i++;
            }
        }
        $data = new stdClass();
        $data->count_save = 1;
        $data->delayed_charge_id = $delayed_charge_id;
        echo json_encode($data);
    }

    public function updateDelayedCharge()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'delayed_charge_date' => $this->input->post('delayed_charge_date'),
            'products' => $this->input->post('products'),
            'description' => $this->input->post('description'),
            'qty' => $this->input->post('qty'),
            'rate' => $this->input->post('rate'),
            'amount' => $this->input->post('amount'),
            'tax' => $this->input->post('tax'),
            'memo' => $this->input->post('memo'),
            'attachments' => $this->input->post('file_name'),
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_delayed_charge_model->updateDelayedCharge($this->input->post('id'), $new_data);

        if ($addQuery > 0) {
            echo json_encode($addQuery);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteDelayedCharge()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_delayed_charge_model->deleteDelayedCharge($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addSalesTimeActivity()
    {
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
        $query = $this->accounting_sales_time_activity_model->createTimeActivity($new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function updateSalesTimeActivity()
    {
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
        $query = $this->accounting_sales_time_activity_model->updateTimeActivity($this->input->post('id'), $new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteSalesTimeActivity()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_sales_time_activity_model->deleteTimeActivity($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addCustomersAccounting()
    {
        $new_data = array(
            'prof_id' => $this->input->post('prof_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'middle_name' => $this->input->post('middle_name'),
            'prefix' => $this->input->post('prefix'),
            'suffix' => $this->input->post('suffix'),
            'business_name' => $this->input->post('business_name'),
            'email' => $this->input->post('email'),
            'ssn' => $this->input->post('ssn'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'phone_h' => $this->input->post('phone_h'),
            'phone_w' => $this->input->post('phone_w'),
            'phone_m' => $this->input->post('phone_m'),
            'fax' => $this->input->post('fax'),
            'mail_add' => $this->input->post('mail_add'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'zip_code' => $this->input->post('zip_code'),
            'cross_street' => $this->input->post('cross_street'),
            'subdivision' => $this->input->post('subdivision'),
            'img_path' => $this->input->post('img_path'),
            'pay_history' => $this->input->post('pay_history')
        );
        $query = $this->accounting_customer_model->createCustomer($new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function updateCustomersAccounting()
    {
        $new_data = array(
            'prof_id' => $this->input->post('prof_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'middle_name' => $this->input->post('middle_name'),
            'prefix' => $this->input->post('prefix'),
            'suffix' => $this->input->post('suffix'),
            'business_name' => $this->input->post('business_name'),
            'email' => $this->input->post('email'),
            'ssn' => $this->input->post('ssn'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'phone_h' => $this->input->post('phone_h'),
            'phone_w' => $this->input->post('phone_w'),
            'phone_m' => $this->input->post('phone_m'),
            'fax' => $this->input->post('fax'),
            'mail_add' => $this->input->post('mail_add'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'zip_code' => $this->input->post('zip_code'),
            'cross_street' => $this->input->post('cross_street'),
            'subdivision' => $this->input->post('subdivision'),
            'img_path' => $this->input->post('img_path'),
            'pay_history' => $this->input->post('pay_history')
        );
        $query = $this->accounting_customer_model->updateCustomer($this->input->post('id'), $new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteCustomersAccounting()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_customer_model->deleteCustomer($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function searchCustomersAccounting()
    {
        $id = $this->input->post('id');
        $searchCustomer = $this->input->post('word');
        $query = $this->accounting_customer_model->searchCustomer($id, $searchCustomer);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    // Jan 2, 2021 Update
    public function modal_invoice()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/customer_invoice_modal', $this->page_data);
    }

    public function modal_estimate()
    {
        $this->load->view('accounting/customer_estimate_modal');
    }

    public function addpurchaseOrder()
    {
        $transaction = array(
            'type' => 'Puchase Order',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);

        $new_data = array(
            'transaction_id' => $fquery,
            'vendor_id' => $this->input->post('vendor_id'),
            'email' => $this->input->post('email'),
            // 'amount' => $this->input->post('amount'),
            'mailing_address' => $this->input->post('mailing_address'),
            'ship_to' => $this->input->post('ship_to'),
            'shipping_address' => $this->input->post('shipping_address'),
            // 'payment_date' => $this->input->post('payment_date'),
            'purchase_order_date' => $this->input->post('purchase_order_date'),
            'permit_num' => $this->input->post('permit_num'),
            'ship_via' => $this->input->post('ship_via'),
            'tags' => $this->input->post('tags'),
            'message' => $this->input->post('message'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'amount' => $this->input->post('total_amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $query = $this->accounting_purchase_order_model->createPurchase($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '1';
                $data['ven_type_id'] = $query;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category'] = $aa[$f];
                $data2['description'] = $bb[$f];
                $data2['amount'] = $cc[$f];
                $data2['type'] = 'Puchase Order';
                $data2['type_id'] = $query;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        // echo "yes";
        } else {
            echo json_encode(0);
        }
    }

    public function addvendorcredit()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mail_address' => $this->input->post('mail_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_no' => $this->input->post('ref_no'),
            'permit_no' => $this->input->post('permit_no'),
            'tags' => $this->input->post('tags'),
            'amount' => $this->input->post('amount'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'amount' => $this->input->post('amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_purchase_order_model->createPurchase($new_data);
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'amount' => $this->input->post('amount'),
                'ven_type' => '6',
                'ven_type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('category');
            $b = $this->input->post('description');
            $c = $this->input->post('amount');

            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '6';
                $data['ven_type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_purchase_order_model->createVendorDetails($data);
                $i++;
            }

            $aa = $this->input->post('prod');
            $bb = $this->input->post('desc');
            $cc = $this->input->post('qty');
            $dd = $this->input->post('rate');
            $ee = $this->input->post('amount');
            $ff = $this->input->post('tax');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['product_services'] = $aa[$i];
                $data2['description'] = $bb[$i];
                $data2['qty'] = $cc[$i];
                $data2['rate'] = $dd[$i];
                $data2['amount'] = $ee[$i];
                $data2['tax'] = $ff[$i];
                $data2['type'] = '1';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->createInvoiceProd($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function addvendorcreditcard()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mail_address' => $this->input->post('mail_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_no' => $this->input->post('ref_no'),
            'permit_no' => $this->input->post('permit_no'),
            'tags' => $this->input->post('tags'),
            'amount' => $this->input->post('amount'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'amount' => $this->input->post('amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_purchase_order_model->createPurchase($new_data);
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'amount' => $this->input->post('amount'),
                'ven_type' => '7',
                'ven_type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('category');
            $b = $this->input->post('description');
            $c = $this->input->post('amount');

            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '7';
                $data['ven_type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('prod');
            $bb = $this->input->post('desc');
            $cc = $this->input->post('qty');
            $dd = $this->input->post('rate');
            $ee = $this->input->post('amount');
            $ff = $this->input->post('tax');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['product_services'] = $aa[$i];
                $data2['description'] = $bb[$i];
                $data2['qty'] = $cc[$i];
                $data2['rate'] = $dd[$i];
                $data2['amount'] = $ee[$i];
                $data2['tax'] = $ff[$i];
                $data2['type'] = '1';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->createInvoiceProd($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function addcheck()
    {
        $transaction = array(
            'type' => 'Check',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);

        $new_data = array(
            'transaction_id' => $fquery,
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'bank_id' => $this->input->post('bank_id'),
            'payment_date' => $this->input->post('payment_date'),
            'check_number' => $this->input->post('check_num'),
            'print_later' => $this->input->post('print_later'),
            'permit_number' => $this->input->post('permit_num'),
            'memo' => $this->input->post('name'),
            'total_amount' => $this->input->post('total_amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")

        );

        $addQuery = $this->expenses_model->addCheck($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '1';
                $data['ven_type_id'] = $query;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category'] = $aa[$f];
                $data2['description'] = $bb[$f];
                $data2['amount'] = $cc[$f];
                $data2['type'] = 'Check';
                $data2['type_id'] = $query;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        // echo "yes";
        } else {
            echo json_encode(0);
        }
    }

    public function addExpense()
    {
        $transaction = array(
            'type' => 'Expense',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);

        $new_data = array(
            'transaction_id'        => $fquery,
            'vendor_id'             => $this->input->post('vendor_id'),
            'payment_account'       => $this->input->post('payment_account'),
            'payment_date'          => $this->input->post('payment_date'),
            'payment_method'        => $this->input->post('payment_method'),
            'ref_number'            => $this->input->post('ref_num'),
            'permit_number'         => $this->input->post('permit_num'),
            'memo'                  => $this->input->post('memo'),
            'amount'                => $this->input->post('total_amount'),
            'attachments'           => 'test',
            'status'                => 1,
            'created_by'            => logged('id'),
            'created_at'            => date("Y-m-d H:i:s"),
            'updated_at'            => date("Y-m-d H:i:s")
        );
        $query = $this->expenses_model->addExpense($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category']       = $a[$i];
                $data['description']    = $b[$i];
                $data['amount']         = $e[$i];
                $data['ven_type']       = '1';
                $data['ven_type_id']    = $query;
                $data['status']         = '1';
                $data['created_at']     = date("Y-m-d H:i:s");
                $data['updated_at']     = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category']      = $aa[$f];
                $data2['description']   = $bb[$f];
                $data2['amount']        = $cc[$f];
                $data2['type']          = 'Expense';
                $data2['type_id']       = $query;
                $data2['status']        = '1';
                $data2['created_at']    = date("Y-m-d H:i:s");
                $data2['updated_at']    = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    //
    public function addInvoiceNew()
    {
        $new_data = array(
            'customer_id'           => $this->input->post('customer_id'),
            'customer_email'        => $this->input->post('customer_email'),
            'online_payments'       => $this->input->post('online_payments'),
            'billing_address'       => $this->input->post('billing_address'),
            'shipping_to_address'   => $this->input->post('shipping_to_address'),
            'ship_via'              => $this->input->post('ship_via'),
            'shipping_date'         => $this->input->post('shipping_date'),
            'tracking_number'       => $this->input->post('tracking_number'),
            'terms'                 => $this->input->post('terms'),
            'invoice_date'          => $this->input->post('invoice_date'),
            'due_date'              => $this->input->post('due_date'),
            'location_scale'        => $this->input->post('location_scale'),
            'message_on_invoice'    => $this->input->post('message_on_invoice'),
            'message_on_statement'  => $this->input->post('message_on_statement'),
            // 'attachments'        => $this->input->post('file_name'),
            'attachments'           => 'test',
            'status'                => 1,
            'created_by'            => logged('id'),
            'created_at'            => date("Y-m-d H:i:s"),
            'updated_at'            => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_invoices_model->createInvoice($new_data);
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'product_services'      => $this->input->post('prod'),
                'description'           => $this->input->post('desc'),
                'qty'                   => $this->input->post('qty'),
                'rate'                  => $this->input->post('rate'),
                'amount'                => $this->input->post('amount'),
                'tax'                   => $this->input->post('tax'),
                'type'                  => '1',
                'type_id'               => $addQuery,
                'status'                => '1',
                'created_at'            => date("Y-m-d H:i:s"),
                'updated_at'            => date("Y-m-d H:i:s")
            );
            // $a['aa'] = $this->input->post('prod');
            // $b['bb'] = $this->input->post('desc');
            // $c['cc'] = $this->input->post('qty');
            $a = $this->input->post('prod');
            $b = $this->input->post('desc');
            $c = $this->input->post('qty');
            $d = $this->input->post('rate');
            $e = $this->input->post('amount');
            $f = $this->input->post('tax');

            $i = 0;
            foreach ($a as $row) {
                $data['product_services']   = $a[$i];
                $data['description']        = $b[$i];
                $data['qty']                = $c[$i];
                $data['rate']               = $d[$i];
                $data['amount']             = $e[$i];
                $data['tax']                = $f[$i];
                $data['type']               = '1';
                $data['type_id']            = $addQuery;
                $data['status']             = '1';
                $data['created_at']         = date("Y-m-d H:i:s");
                $data['updated_at']         = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }

            // redirect('accounting/banking');
            redirect('accounting/invoices');
        } else {
            echo json_encode(0);
        }
    }


    // New Forms
    public function addNewEstimate($customer_id = 0)
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['customer_id'] = $customer_id;
        // $this->page_data['items'] = $this->items_model->getItemlist();
        // $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['number'] = $this->estimate_model->getlastInsert();

        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        // print_r($this->page_data['number']);

        // $get_items = array(
        //     'where' => array(
        //         'items.company_id' => logged('company_id'),
        //         'is_active' => 1,
        //     ),
        //     'table' => 'items',
        //     'select' => 'items.id,title,price',
        // );
        // $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addnewEstimate', $this->page_data);
    }

    public function customer_credit_memo_modal()
    {
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId(logged('company_id'));
        $this->page_data['invoices'] = $this->invoice_model->getAllData(logged('company_id'));
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->workorder_model->getPackagelist(logged('company_id'));
        $this->page_data['estimates'] = $this->estimate_model->getAllByCompany(logged('company_id'));
        $this->page_data['sales_receipts'] = $this->accounting_sales_receipt_model->getAllByCompany(logged('company_id'));
        $this->page_data['credit_memo'] = $this->accounting_credit_memo_model->getAllByCompany(logged('company_id'));

        $this->load->view('accounting/customer_credit_memo_modal', $this->page_data);
    }

    public function addNewEstimateOptions($customer_id = 0)
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 20210000001;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0000000;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['customer_id'] = $customer_id;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addNewEstimateOptions', $this->page_data);
    }

    public function addNewEstimateBundle($customer_id = 0)
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['customer_id'] = $customer_id;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addNewEstimateBundle', $this->page_data);
    }

    public function addnewInvoice()
    {
        // $this->load->helper('url');
        // $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->page_data['items'] = $this->items_model->getItemlist();
        // $this->page_data['invoices'] = $this->accounting_invoices_model->getInvoices();
        // $this->page_data['page_title'] = "Invoices";
        // // print_r($this->page_data);
        // $this->load->view('accounting/addInvoice', $this->page_data);

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id'); //clients
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }

        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        $terms = $this->accounting_terms_model->getCompanyTerms_a($company_id);
        $this->page_data['number'] = $this->invoice_model->getlastInsert();

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
            $this->page_data['terms'] = $terms;
        }

        $this->page_data['clients'] = $this->invoice_model->getclientsData(logged('company_id'));

        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);

        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        $this->page_data['getSettings'] = $this->workorder_model->getSettings($company_id);

        $this->load->view('accounting/addInvoice', $this->page_data);
    }

    public function addnewcreditmemo()
    {
        $this->load->model('AcsProfile_model');
        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');

        $company_id = logged('company_id');
        $this->load->library('session');

        $users_data = $this->session->all_userdata();
        // foreach($users_data as $usersD){
        //     $userID = $usersD->id;

        // }

        // print_r($user_id);
        // $users = $this->users_model->getUserByID($user_id);
        // print_r($users);
        // echo $company_id;

        $role = logged('role');
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['number'] = $this->workorder_model->getlastInsert();

        $termsCondi = $this->workorder_model->getTerms($company_id);
        if ($termsCondi) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if ($termsUse) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }

        // print_r($this->page_data['terms_conditions']);
        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();


        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Work Order";
        // print_r($this->page_data['customers']);
        $this->load->view('accounting/addCreditMemo', $this->page_data);
    }

    public function NewworkOrder()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Work Order";

        $this->load->model('AcsProfile_model');
        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');

        $company_id = logged('company_id');
        $this->load->library('session');

        $users_data = $this->session->all_userdata();
        // foreach($users_data as $usersD){
        //     $userID = $usersD->id;

        // }

        // print_r($user_id);
        // $users = $this->users_model->getUserByID($user_id);
        // print_r($users);
        // echo $company_id;

        $role = logged('role');
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }

        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);

        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $termsCondi = $this->workorder_model->getTerms($company_id);
        if ($termsCondi) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if ($termsUse) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }


        $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        // $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        // $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        // $this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        // $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);

        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);

        // print_r($this->page_data);
        $this->load->view('accounting/NewworkOrder', $this->page_data);
    }

    public function listworkOrder()
    {
        // // $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // // $this->page_data['page_title'] = "Work Order List";
        // // print_r($this->page_data);
        // $is_allowed = $this->isAllowedModuleAccess(24);
        // if( !$is_allowed ){
        //     $this->page_data['module'] = 'workorder';
        //     echo $this->load->view('no_access_module', $this->page_data, true);
        //     die();
        // }

        // $is_allowed = $this->isAllowedModuleAccess(24);
        // if( !$is_allowed ){
        //     $this->page_data['module'] = 'workorder';
        //     echo $this->load->view('no_access_module', $this->page_data, true);
        //     die();
        // }

        // $role = logged('role');
        // $this->page_data['workorderStatusFilters'] = array ();
        // $this->page_data['workorders'] = array ();
        // // $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => logged('company_id')]);
        // if ($role == 2 || $role == 3) {
        //     $company_id = logged('company_id');

        //     if (!empty($tab_index)) {
        //         $this->page_data['tab_index'] = $tab_index;
        //         // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('status' => $tab_index), $company_id);
        //     } else {

        //         // search
        //         if (!empty(get('search'))) {

        //             $this->page_data['search'] = get('search');
        //             // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
        //         } elseif (!empty(get('order'))) {

        //             $this->page_data['search'] = get('search');
        //             // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

        //         } else {

        //             // $this->page_data['workorders'] = $this->workorder_model->getAllOrderByCompany($company_id);
        //         }
        //     }

        //     // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount($company_id);
        // }
        // if ($role == 4) {

        //     if (!empty($tab_index)) {

        //         $this->page_data['tab_index'] = $tab_index;
        //         // $this->page_data['workorders'] = $this->workorder_model->filterBy();

        //     } elseif (!empty(get('order'))) {

        //         $this->page_data['order'] = get('order');
        //         // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

        //     } else {

        //         if (!empty(get('search'))) {

        //             $this->page_data['search'] = get('search');
        //             // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
        //         } else {
        //             // $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();
        //         }
        //     }

        //     // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount();
        // }

        // // unserialized the value

        // $statusFilter = array();
        // foreach ($this->page_data['workorders'] as $workorder) {

        //     if (is_serialized($workorder)) {

        //         $workorder = unserialize($workorder);
        //     }
        // }

        $is_allowed = $this->isAllowedModuleAccess(24);
        if (!$is_allowed) {
            $this->page_data['module'] = 'workorder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $role = logged('role');
        $this->page_data['workorderStatusFilters'] = array();
        $this->page_data['workorders'] = array();
        $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => logged('company_id')]);
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
            // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('status' => $tab_index), $company_id);
            } else {

                // search
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('order'))) {
                    $this->page_data['search'] = get('search');
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);
                } else {

                    // $this->page_data['workorders'] = $this->workorder_model->getAllOrderByCompany($company_id);
                }
            }

            // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount($company_id);
        }
        if ($role == 4) {
            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
            // $this->page_data['workorders'] = $this->workorder_model->filterBy();
            } elseif (!empty(get('order'))) {
                $this->page_data['order'] = get('order');
            // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);
            } else {
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } else {
                    // $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();
                }
            }

            // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount();
        }

        $this->page_data['workorders'] = $this->workorder_model->getworkorderList();

        $company_id = logged('company_id');
        $this->page_data['company_work_order_used'] = $this->workorder_model->getcompany_work_order_used($company_id);

        // unserialized the value

        $statusFilter = array();
        foreach ($this->page_data['workorders'] as $workorder) {
            if (is_serialized($workorder)) {
                $workorder = unserialize($workorder);
            }
        }

        $this->load->view('accounting/work_order_list', $this->page_data);
    }

    public function newEstimateList($tab = '')
    {
        $is_allowed = $this->isAllowedModuleAccess(18);
        if (!$is_allowed) {
            $this->page_data['module'] = 'estimate';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $role = logged('role');
        if ($role == 2 || $role == 3 || $role == 1) {
            $this->page_data['jobs'] = $this->jobs_model->getByWhere([]);
        } else {
            $company_id = logged('company_id');
            $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => $company_id]);
        }
        if (!empty($tab)) {
            $query_tab = $tab;
            if ($tab == 'declined%20by%20customer') {
                $query_tab = 'Declined By Customer';
            }
            $this->page_data['tab'] = $tab;
            $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => lcfirst($query_tab)), $company_id, $role);
        } else {

            // search
            if (!empty(get('search'))) {
                $this->page_data['search'] = get('search');
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('search' => get('search')), $company_id, $role);
            } elseif (!empty(get('order'))) {
                $this->page_data['search'] = get('search');
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('order' => get('order')), $company_id, $role);
            } else {
                if ($role == 1 || $role == 2) {
                    $this->page_data['estimates'] = $this->estimate_model->getAllEstimates();
                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id);
                }
            }
        }

        $this->page_data['role'] = $role;
        $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount($company_id);

        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
        $client = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        $this->page_data['client'] = $client;
        $this->page_data['estimate'] = $estimate;

        // $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->page_data['page_title'] = "Estimate Lists";
        // print_r($this->page_data);
        $this->load->view('accounting/estimatesList', $this->page_data);
    }

    public function savenewWorkOrder()
    {
        postAllowed();

        $post = $this->input->post();

        //        echo '<pre>'; print_r($post); die;

        $user = (object)$this->session->userdata('logged');

        //
        if (is_array(post('item'))) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            $itemArray = array();

            foreach (post('item') as $key => $val) {
                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $additional_services = serialize($itemArray);
        } else {
            $additional_services = '';
        }

        //        print_r(post('customer')); die;

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        $company_id = logged('company_id');

        // create the workorder customer
        $this->load->model('Customer_model', 'customer_model');
        $customer_id = $this->customer_model->create([

            'customer_type' => post('customer')['customer_type'],
            'contact_name' => post('customer')['first_name'] . ' ' . post('customer')['last_name'],
            'contact_email' => post('customer')['email'],
            'mobile' => post('customer')['contact_mobile'],
            'phone' => serialize(post('customer')['contact_phone']),
            'notification_method' => serialize(post('customer')['notification_type']),
            'street_address' => post('customer')['monitored_location'],
            'suite_unit' => post('customer')['cross_street'],
            'city' => post('customer')['city'],
            'postal_code' => post('customer')['zip'],
            'state' => post('customer')['state'],
            'birthday' => date('Y-m-d', strtotime(post('customer')['contact_dob'])),
            'company_id' => $company_id
        ]);

        //        print_r(serialize(post('post_service_summary'))); die;


        if ($customer_id) {
            $id = $this->workorder_model->create([

                'user_id' => $user->id,
                'company_id' => $company_id,
                'customer_id' => $customer_id,
                'customer' => serialize(post('customer')),
                'emergency_call_list' => serialize(post('emergency_call_list')),
                'plan_type' => post('plan_type'),
                'account_type' => serialize(post('account_type')),
                'panel_type' => serialize(post('panel_type')),
                'panel_communication' => post('panel_communication'),
                'panel_location' => post('panel_location'),
                'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
                'job_type_id' => post('job_type_id'),
                'status_id' => post('status_id'),
                'priority_id' => post('job_priority'),
                'ip_cameras' => serialize(post('ip_cameras')),
                'dvr_nvr' => serialize(post('dvr_nvr')),
                'doorlocks' => serialize(post('doorlocks')),
                'automation' => serialize(post('automation')),
                'pers' => serialize(post('pers')),
                'additional_services' => $additional_services,
                'total' => serialize($eqpt_cost),
                'billing_date' => date('Y-m-d', strtotime(post('billing_date'))),
                'payment_type' => post('payment_type'),
                'billing_freq' => post('billing_freq'),
                'card_info' => serialize(post('card')),
                'company_rep_approval' => post('company_representative_approval_signature'),
                'primary_account_holder' => post('primary_account_holder_signature'),
                'secondary_account_holder' => post('secondery_account_holder_signature'),
                'company_rep_name' => post('company_representative_printed_name'),
                'primary_account_holder_name' => post('primary_account_holder_name'),
                'secondary_account_holder_name' => post('secondery_account_holder_name'),
                'post_service_summary' => serialize(post('post_service_summary')),
            ]);

            $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'New Workorder Created Successfully');

            // redirect('workorder');
        }
    }

    public function savenewWorkordertwo()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = array(

            'workorder_number' => $this->input->post('workorder_number'),
            'customer_id' => $this->input->post('customer_id'),
            'security_number' => $this->input->post('security_number'),
            'birthdate' => $this->input->post('birthdate'),
            'phone_number' => $this->input->post('phone_number'),
            'mobile_number' => $this->input->post('mobile_number'),
            'email' => $this->input->post('email'),
            'job_location' => $this->input->post('job_location'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip_code' => $this->input->post('zip_code'),
            'cross_street' => $this->input->post('cross_street'),
            'password' => $this->input->post('password'),
            'offer_code' => $this->input->post('offer_code'), //
            'job_tag' => $this->input->post('job_tag'),
            'schedule_date_given' => $this->input->post('schedule_date_given'),
            'job_type' => $this->input->post('job_type'),
            'job_name' => $this->input->post('job_name'),
            'job_description' => $this->input->post('job_description'),
            'payment_method' => $this->input->post('payment_method'),
            'payment_amount' => $this->input->post('payment_amount'),
            'account_holder_name' => $this->input->post('account_holder_name'),
            'account_number' => $this->input->post('account_number'),
            'expiry' => $this->input->post('expiry'),
            'cvc' => $this->input->post('cvc'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'status' => $this->input->post('status'),
            'priority' => $this->input->post('priority'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'terms_of_use' => $this->input->post('terms_of_use'),
            'instructions' => $this->input->post('instructions'),

            //signature
            // 'company_representative_signature' => $this->input->post('company_representative_signature'),
            // 'company_representative_name' => $this->input->post('company_representative_name'),
            // 'primary_account_holder_signature' => $this->input->post('primary_account_holder_signature'),
            // 'primary_account_holder_name' => $this->input->post('primary_account_holder_name'),
            // 'secondary_account_holder_signature' => $this->input->post('secondary_account_holder_signature'),
            // 'secondary_account_holder_name' => $this->input->post('secondary_account_holder_name'),
            'company_representative_signature' => 'company_representative_signature',
            'company_representative_name' => 'company_representative_name',
            'primary_account_holder_signature' => 'primary_account_holder_signature',
            'primary_account_holder_name' => 'primary_account_holder_name',
            'secondary_account_holder_signature' => 'secondary_account_holder_signature',
            'secondary_account_holder_name' => 'secondary_account_holder_name',


            //attachment
            // 'attached_photo' => $this->input->post('attached_photo'),
            // 'document_links' => $this->input->post('document_links'),
            'attached_photo' => 'attached_photo',
            'document_links' => 'document_links',

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'voucher_value' => $this->input->post('voucher_value'),
            'grand_total' => $this->input->post('grand_total'),

            'user_id' => $user_id,
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->workorder_model->save_workorder($new_data);


        // $custom_data = array(

        //     'custom1_field' => $this->input->post('custom1_field'),
        //     'custom1_value' => $this->input->post('custom1_value'),
        //     'custom2_field' => $this->input->post('custom2_field'),
        //     'custom2_value' => $this->input->post('custom2_value'),
        //     'custom3_field' => $this->input->post('custom3_field'),
        //     'custom3_value' => $this->input->post('custom3_value'),
        //     'custom4_field' => $this->input->post('custom4_field'),
        //     'custom4_value' => $this->input->post('custom4_value'),
        //     'custom5_field' => $this->input->post('custom5_field'),
        //     'custom5_value' => $this->input->post('custom5_value'),
        //     'workorder_id' => $addQuery,
        // );

        // $custom_dataQuery = $this->workorder_model->save_custom_fields($custom_data);

        $name = $this->input->post('custom_field');
        $value = $this->input->post('custom_value');

        $c = 0;
        foreach ($name as $row2) {
            $dataa['name'] = $name[$c];
            $dataa['value'] = $value[$c];
            $dataa['form_id'] = $addQuery;
            $dataa['company_id'] = $company_id;
            $dataa['date_added'] = date("Y-m-d H:i:s");
            $addQuery2a = $this->workorder_model->additem_details($dataa);
            $c++;
        }


        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Work Order';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            //redirect('workorder');
            redirect('accounting/listworkOrder');
        } else {
            echo json_encode(0);
        }
    }

    public function tickets()
    {
        $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('tickets/list', $this->page_data);
    }

    public function addexpensename()
    {
        $data = [
            'category_name' => $this->input->post('name'),
            'display_name' => $this->input->post('credit_card'),
            'type' => $this->input->post('type'),
            'sub_account' => $this->input->post('sub_account'),
            'date_created' => date("Y-m-d H:i:s"),
            'status' => 1,
        ];

        $expense = $this->accounting_expense_name_model->getexpensename($data);

        $return = [
            'data' => $expense,
            'success' => $expense ? true : false,
            'message' => $expense ? 'Success!' : 'Error!'
        ];
    }

    public function salesTax()
    {
        add_css([
            'assets/css/accounting/tax/settings/settings.css',
            'assets/css/accounting/tax/sales/sales.css',
            'assets/css/accounting/tax/dropdown-with-search/dropdown-with-search.css',
            'https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css'
        ]);

        add_footer_js([
            'assets/js/accounting/tax/dropdown-with-search/dropdown-with-search.js',
            'assets/js/accounting/tax/sales/sales.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js',

            'assets/js/accounting/invoice/addInvoice.js',
            'assets/js/accounting/invoice/accounting.min.js',
        ]);

        $this->load->view('accounting/sales/salesTax', $this->page_data);
    }

    public function payrollTax()
    {
        add_css('assets/css/accounting/payroll/payroll.css');
        add_footer_js('assets/js/accounting/tax/payroll/payroll.js');
        $this->load->view('accounting/sales/payrollTax', $this->page_data);
    }

    public function payrollTaxFillings()
    {
        add_css('assets/css/accounting/payroll/payroll.css');
        add_footer_js('assets/js/accounting/tax/payroll/fillings.js');
        $this->load->view('accounting/sales/payrollTaxFillings', $this->page_data);
    }

    public function taxEditSettings()
    {
        add_css([
            'assets/css/accounting/tax/settings/settings.css',
            'https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css',
            'assets/css/accounting/tax/dropdown-with-search/dropdown-with-search.css',
        ]);

        add_footer_js([
            'assets/js/accounting/tax/settings/settings.js',
            'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            // 'assets/js/accounting/tax/dropdown-with-search/dropdown-with-search.js', imported async.
            'https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js',
        ]);

        $this->load->view('accounting/sales/taxEditSettings', $this->page_data);
    }

    // public function sendmerchantEmail()
    // {
    //     $email = 'emploucelle@gmail.com';
    //     $data = array(
    //         'name' => '$name',
    //         'link' => '$code'
    //     );
    //     //Load email library
    //     $this->load->library('email');
    //     $config = array(
    //         'smtp_crypto' => 'ssl',
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'mail.nsmartrac.com',
    //         'smtp_port' => 465,
    //         'smtp_user' => 'no-reply@nsmartrac.com',
    //         'smtp_pass' => 'g0[05_rEa3?%',
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //     );
    //     $this->email->initialize($config);
    //     $this->email->set_newline("\r\n");

    //     $this->email->from('no-reply@nsmartrac.com', 'nSmartrac');
    //     $this->email->to($email);
    //     $this->email->subject('nSmartrac invitation');
    //     $message = $this->load->view('users/invite_link_template', $data, TRUE);
    //     $this->email->message($message);
    //     //Send mail
    //     $this->email->send();
    //     return true;
    // }

    public function sendmerchantEmail($id = null)
    {
        $this->load->library('email');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.googlemail.com';
        $config['smtp_port'] = '587';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'smartrac.noreply@gmail.com';
        $config['smtp_pass'] = 'smartrac123';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = true;

        $this->email->initialize($config);

        $subject = '
        <table></table>
        ';

        $email = $this->input->post('email');
        $header_message = "<html><head><title>" . $subject . "</title></head><body>";
        $footer_message = "</body></html>";
        $input_msg = $this->input->post('contact_reply');
        $msg = $header_message . $footer_message;

        $this->email->from('smartrac.noreply@gmail.com', 'NSMARTRAC');
        $this->email->to($email);
        $this->email->subject('NSMARTRAC - Merchant application');
        $this->email->message($subject);

        $this->email->send();

        // echo $this->email->print_debugger();
        echo "Successfully sent to your email";
    }

    public function estimateviewdetails($id)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
        $client = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        $this->page_data['client'] = $client;
        $this->page_data['estimate'] = $estimate;
        // $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('accounting/estimateviewdetails', $this->page_data);
    }

    public function estimateviewdetailsajax()
    {
        $id = $this->input->post('id');

        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getByProfIdajax($estimate->customer_id);
        $client = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        $this->page_data['client'] = $client;
        $this->page_data['estimate'] = $estimate;
        // $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        // $this->load->view('accounting/estimateviewdetails',$this->page_data);
        echo json_encode($this->page_data);
    }

    public function addLocationajax()
    {
        $id = $this->input->post('id');

        $this->load->model('AcsProfile_model');
        $this->load->model('Clients_model');

        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getdataAjax($id);
        //  $client   = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        // $this->page_data['client'] = $client;

        echo json_encode($this->page_data);
    }

    public function changeRebate()
    {
        $id = $this->input->post('id');
        $get_val = $this->input->post('get_val');

        $data = array(
            'id' => $id,
            'get_val' => $get_val
        );

        $this->items_model->changeRebate($data);

        echo json_encode(0);
    }

    public function findoffercode()
    {
        $offer_code = $this->input->post('offer_code');

        $company_id = logged('company_id');

        $offer = $this->items_model->getoffercode($offer_code);

        if (empty($offer)) {
            echo "empty";
        } else {
            $this->page_data['offer'] = $offer;
        }
        // $this->page_data['client'] = $client;

        echo json_encode($this->page_data);
    }

    public function updateEstimate($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role = logged('role');

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->load->view('accounting/updateEstimate', $this->page_data);
    }

    public function updateEstimateOptions($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role = logged('role');

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->load->view('accounting/updateEstimateOptions', $this->page_data);
    }

    public function work_order_templates()
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Templates";
        $this->page_data['company_work_order_used'] = $this->workorder_model->getcompany_work_order_used($company_id);

        $this->load->view('accounting/work_order_templates', $this->page_data);
    }

    public function testSave()
    {
        //print_r($_POST);
        // $folderPath = './uploads/';
        // // $this->input->post('get_val');

        // $image_parts = explode(";base64,", $this->input->post('signature_image'));

        // $image_type_aux = explode("image/", $image_parts[0]);

        // $image_type = $image_type_aux[1];

        // $image_base64 = base64_decode($image_parts[1]);

        // $file = $folderPath . uniqid() . '.'.$image_type;

        // file_put_contents($file, $image_base64);
        // echo "1";

        // $config['remove_spaces']=TRUE;
        // $config['encrypt_name'] = TRUE; // for encrypting the name
        // $config['upload_path'] = './uploads/';
        // $config['allowed_types'] = 'jpg|png|gif';
        // $config['max_size']    = '78000';

        // //load upload class library
        // $this->load->library('upload', $config);

        // //$this->upload->do_upload('filename') will upload selected file to destiny folder
        // if (!$this->upload->do_upload('signature_image'))
        // {
        //     // case - failure
        //     $upload_error = array('error' => $this->upload->display_errors());
        //     print_r($upload_error);
        // }
        // else
        // {
        //     echo "1";
        // }
        $dataURL = $this->input->post('dataURL');
        $dataURL2 = $this->input->post('dataURL2');
        $dataURL3 = $this->input->post('dataURL3');

        echo $dataURL . '<br>' . $dataURL2 . '<br>' . $dataURL3;

        // $list = json_decode($pixels, true);

        // $image->importImagePixels(0, 0, $width, $height, "RGB", Imagick::PIXEL_CHAR, $pixels);
        // $image->setImageFormat('jpg');
        // $image->writeImage("image.jpg");


        // $data = $this->input->post('output-2a');
        // list($type, $data) = explode(';', $data);
        // list(, $data)      = explode(',', $data);
        // $data = base64_decode($data);

        // file_put_contents('./uploads/image.png', $data);
        // echo "1";
    }

    public function send_customer_reminder()
    {
        $customer_name = $this->input->post("customer_name");
        $customer_email = $this->input->post("customer_email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;

        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);

        $mail->MsgHTML($content);

        $data = new stdClass();
        try {
            // $mail->addAddress($customer_email);
            $mail->addAddress($customer_email);
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }

        echo json_encode($data);
    }

    public function send_customer_reminder_by_batch()
    {
        $invoice_ids = $this->input->post("invoice_ids");
        $error_found_ctr = 0;
        $sent_ctr =0;
        for ($ids_i =0 ; $ids_i<count($invoice_ids); $ids_i++) {
            $invoice_id = $invoice_ids[$ids_i];
            $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);
            $customer_id = $inv->customer_id;
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

            $receivable_payment = 0;
            $total_amount_received = 0;
            if (is_numeric($inv->grand_total)) {
                $receivable_payment = $inv->grand_total;
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
            }

            $balance = ($receivable_payment - $total_amount_received) - $inv->deposit_request;

            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
                $status = "Overdue";
            } else {
                if ($balance <= 0) {
                    $status = "Paid";
                } else {
                    $status = "Open";
                }
            }

            $pdf_data["data_pdf"][] = array(
            "invoice_date" => $inv->date_issued,
            "invoice_no" => $inv->invoice_number,
            "payment" => $total_amount_received,
            "balance_due" => $balance,
            "inv_location_scale" => $inv->location_scale,
            "inv_ship_from" => $inv->bus_state,
            "inv_ship_via" => $inv->ship_via,
            "inv_taxes" => $inv->taxes,
            "inv_grand_total" => $inv->grand_total,
            "inv_sub_total" => $inv->sub_total,
            "inv_shipping_to_address" => $inv->shipping_to_address,
            "due_date" => $inv->due_date,
            "terms" => $this->accounting_invoices_model->get_terms_by_id($inv->terms)->name,
            "customer_name" => $customer_info->first_name . ' ' . $customer_info->last_name,
            "customer_mail_add" => $customer_info->acs_mail_add,
            "customer_phone_h" => $customer_info->customer_phone_h,
            "customer_city" => $customer_info->acs_city,
            "business_name" => $customer_info->business_name,
            "customer_id" => $customer_info->prof_id,
            "business_email" => $customer_info->business_email,
            "business_website" => $customer_info->website,
            "bus_street" => $customer_info->bus_street,
            "bus_city" => $customer_info->bus_city,
            "bus_state" => $customer_info->bus_state,
            "bus_postal_code" => $customer_info->bus_postal_code,
            "business_logo" => "uploads/users/business_profile/" . $customer_info->business_id . "/" . $customer_info->business_image,
            "invoice_items" => $this->invoice_model->getInvoiceItems($invoice_id),
            "status" => $status
        );


            $customer_name = $customer_info->first_name . ' ' . $customer_info->last_name;
            $customer_email = $customer_info->acs_email;
            $subject = `Reminder: Invoice `.$inv->invoice_number.` from Alarm Direct, Inc   `;
            $message = `Dear `.$customer_name.`,

    Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                        
    Thanks for your business!
    `.$customer_info->business_name;

            $pdf_file_name = "batched_inv_" . $customer_id . "_portalappinv.pdf";

            $html_pdf = "accounting/customer_includes/customer_single_modal/invoice_packaging_pdf";
            $orientation = "P";
            $this->pdf->save_pdf($html_pdf, $pdf_data, $pdf_file_name, $orientation);

            

            $this->page_data['customer_name'] = $customer_name;
            $this->page_data['message'] = $message;
            $this->page_data['subject'] = $subject;
    
            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            $from = MAIL_FROM;
    
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // seconds
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'nSmarTrac';
            $mail->Subject = $subject;
    
            $mail->IsHTML(true);
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
            $mail->addAttachment(dirname(__DIR__, 2) . '/assets/pdf/' . $pdf_file_name);
    
            $mail->Body = 'Send Transactions';
            $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
            $mail->MsgHTML($content);
            $mail->addAddress($customer_info->acs_email);
    
            $data = new stdClass();
            $data->status = "success";
            if (!$mail->Send()) {
                $data->status = "error";
                $data->status = "Mailer Error: " . $mail->ErrorInfo;
                $error_found_ctr++;
                exit;
            } else {
                $sent_ctr++;
            }
        }
        $data = new stdClass();
        $data->sent_ctr=$sent_ctr;
        $data->error_found_ctr=$error_found_ctr;
        echo json_encode($data);
    }

    public function send_customer_reminder1_unused()
    {
        $customer_name = $this->input->post("customer_name");
        $customer_email = $this->input->post("customer_email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        //get job data

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;

        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');

        $mail->Body = 'Send Reminders';
        $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
        $mail->MsgHTML($content);
        $mail->addAddress($customer_email);

        $data = new stdClass();

        // $this->load->library('email');
        // $config = array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'ssl://smtp.gmail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac2020',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8'
        // );
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");

        // $this->email->from("pintonnelfa@gmail.com", "Lou Test");
        // $this->email->to($customer_email);
        // $this->email->subject('Test email Sending Reminder');
        // $message = "this is just a test.";
        // $this->email->message($message);
        //Send mail

        if ($this->email->send()) {
            $data->status = "success";
        } else {
            $data->status = $this->email->send();
        }
        if (!$mail->Send()) {
            $data->status = "error";
            $data->status = "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
        $mail->ClearAllRecipients();

        //=======>>>>> willberts code for email
        // $this->load->library('email');
        // $this->email->clear(true);
        // $this->email->from($from);
        // $this->email->to($customer_email);
        // $this->email->subject($subject);
        // $this->email->message($content);
        // $this->email->attach(base_url("/assets/dashboard/images/logo.png"));
        // $this->email->send();


        echo json_encode($data);
        // $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data);
    }

    public function get_load_customers_table()
    {
        $counter = 0;
        $html = '';
        $customers = $this->accounting_customers_model->getAllByCompany();
        foreach ($customers as $cus) {
            $invoices = $this->accounting_invoices_model->get_invoices_by_customer_id($cus->prof_id);
            $receivable_payment = 0;
            $total_amount_received = 0;
            foreach ($invoices as $inv) {
                if (is_numeric($inv->grand_total)) {
                    $receivable_payment += $inv->grand_total;
                }
                $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
                foreach ($receive_payment as $payment) {
                    $total_amount_received += $payment->payment_amount;
                }
            }

            $first_option = "Create invoice";
            $first_option_class = "customer_craete_invoice_btn";
            $first_href = base_url('accounting/addnewInvoice');
            $amount = ($receivable_payment - $total_amount_received);
            if ($amount > 0) {
                $first_option = "Receive payment";
                $first_option_class = "customer_receive_payment_btn";
                $first_href ="";
            }
            $html .= '<tr>
								<td class="center"><input type="checkbox"
										name="checkbox' . $counter . '" data-customer-id="' . $cus->prof_id . '" data-email-add="' . $cus->email . '">
								</td>
								<td><a class="customer-full-page-btn" href="javascript:void(0)" data-customer-id="' . $cus->prof_id . '">' . $cus->first_name . ' ' . $cus->middle_name . ' ' . $cus->last_name . '</a>
								</td>
								<td>' . $cus->phone_h . '
								</td>
								<td class="text-right">' . "$" . number_format(($receivable_payment - $total_amount_received), 2) . '
								</td>
								<td>
									<div class="dropdown dropdown-btn text-right">
										<a href="'.$first_href.'"
											class="first-option ' . $first_option_class . '"
											data-customer-id="' . $cus->prof_id . '">' . $first_option . ' </a>
										<a type="button" id="dropdown-button-icon" data-toggle="dropdown">
											<span class="btn-label"><i class="fa fa-caret-down fa-sm"></i></span></span>
										</a>
										<ul class="dropdown-menu dropdown-menu-right customer-dropdown-menu" role="menu"
											aria-labelledby="dropdown-edit">
											';
            if ($amount > 0) {
                $html .= '<li>
												<a role="menuitem" tabindex="-1" href="javascript:void(0)"
													class="send-reminder"
													data-customer-id="' . $cus->prof_id . '"
													data-customer-name="' . $cus->first_name . ' ' . $cus->middle_name . ' ' . $cus->last_name . '">
													Send reminder
												</a>
											</li>
											<li>
												<a href="javascript:void(0)" class="created-statement-btn" data-toggle="modal" data-target="#create_statement_modal" data-email-add="' . $cus->email . '" data-customer-id="' . $cus->prof_id . '">
													Create statement
												</a>
											</li>
											<li>
												<a href="'.base_url('accounting/addnewInvoice').'"
													class="customer_craete_invoice_btn1" data-toggle="modal1" data-target="#create_invoice_modal1" data-email-add="' . $cus->email . '" data-customer-id="' . $cus->prof_id . '">
													Create invoice
												</a>
											</li>';
            }

            $html .= '<li>
												<a href="javascript:void(0)"
													class="created-sales-receipt" data-toggle="modal" data-target="#addsalesreceiptModal" data-email-add="' . $cus->email . '" data-customer-id="' . $cus->prof_id . '">
													Create sales receipt
												</a>
											</li>
											<li>
												<a href="javascript:void(0)"
													class="create-estimate-btn" data-toggle="modal" data-target="#newJobModal" data-email-add="' . $cus->email . '" data-customer-id="' . $cus->prof_id . '">
													Create estimate
												</a>
											</li>
											<li>
												<a href="javascript:void(0)"
													class="">
													Send payment link
												</a>
											</li>';
            if ($amount <= 0) {
                $html .= '<li>
												<a href="javascript:void(0)"
													class="create-charge-btn" data-toggle="modal" data-target="#create_charge_modal" data-email-add="' . $cus->email . '" data-customer-id="' . $cus->prof_id . '">
													Create charge
												</a>
											</li>
											<li>
												<a href="javascript:void(0)"
                                                class="time-activity-btn" data-toggle="modal" data-target="#time_activity_modal" data-email-add="' . $cus->email . '" data-customer-id="' . $cus->prof_id . '">
													Create time activity
												</a>
											</li>
											<li>
												<a href="javascript:void(0)"
													class="make-customer-inactive" data-customer-id="' . $cus->prof_id . '">
													Make inactive
												</a>
											</li>
											<li>
												<a href="javascript:void(0)" class="created-statement-btn" data-toggle="modal" data-target="#create_statement_modal" data-email-add="' . $cus->email . '" data-customer-id="' . $cus->prof_id . '">
													Create statement
												</a>
											</li>';
            }
            $html .= '<li role="separator" class="divider"></li>
										</ul>
									</div>
								</td>
							</tr>';
            $counter++;
        }
        $data = new stdClass();
        $data->html = $html;
        echo json_encode($data);
    }

    public function get_customer_info_for_receive_payment()
    {
        $customer_id = $this->input->post("customer_id");
        if ($customer_id == "") {
            $customer_id = 0;
        }
        $invoices = $this->accounting_invoices_model->get_invoices_by_customer_id($customer_id);
        $receivable_payment = 0;
        $html = '';
        $counter = 0;
        // var_dump($invoices);
        if ($invoices != null) {
            foreach ($invoices as $inv) {
                $customer_id = $inv->customer_id;
                $total_amount_received = 0;

                $payment_received = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
                foreach ($payment_received as $received) {
                    $total_amount_received += $received->payment_amount;
                }
                if (($inv->grand_total - $total_amount_received) > 0) {
                    $html .= '<tr>
                    <td class="center" style="width: 0;"><input type="checkbox" class="inv_cb" name="inv_cb_' . $counter . '" checked>
                    </td>
                    <td>
                    ' . $inv->invoice_number . '
                    <input type="text" class="hide" name="inv_number_' . $counter . '" value="' . $inv->invoice_number . '">
                    </td>
                    <td>
                    ' . $inv->due_date . '
                    </td>
                    <td class="text-right">' . number_format($inv->grand_total, 2) . '</td>
                    <td class="text-right">
                    ' . number_format($inv->grand_total - $total_amount_received, 2) . '
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="text-right inv_grand_amount" name="inv_' . $counter . '" value="' . number_format($inv->grand_total - $total_amount_received, 2) . '">
                        </div>
                    </td>
                </tr>';
                    $counter++;
                    $receivable_payment += $inv->grand_total - $total_amount_received;
                }
            }
        }
        $data = new stdClass();
        $data->html = $html;
        $data->receivable_payment = $receivable_payment;
        $data->display_receivable_payment = number_format($receivable_payment, 2);
        $data->inv_count = $counter;
        echo json_encode($data);
    }

    public function get_customer_filtered_info_for_receive_payment_modal()
    {
        $customer_id = $this->input->post("customer_id");
        $filter_date_from = $this->input->post("filter_date_from");
        $filter_date_to = $this->input->post("filter_date_to");
        $filter_overdue = $this->input->post("filter_overdue");

        $invoices = $this->accounting_invoices_model->get_filtered_invoices_by_customer_id($filter_date_from, $filter_date_to, $filter_overdue, $customer_id);

        $receivable_payment = 0;
        $html = '';
        $counter = 0;
        foreach ($invoices as $inv) {
            $customer_id = $inv->customer_id;
            $total_amount_received = 0;

            $payment_received = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            foreach ($payment_received as $received) {
                $total_amount_received += $received->payment_amount;
            }
            if (($inv->grand_total - $total_amount_received) > 0) {
                $html .= '<tr>
                    <td class="center" style="width: 0;"><input type="checkbox" class="inv_cb" name="inv_cb_' . $counter . '" checked>
                    </td>
                    <td>
                    ' . $inv->invoice_number . '
                    <input type="text" class="hide" name="inv_number_' . $counter . '" value="' . $inv->invoice_number . '">
                    </td>
                    <td>
                    ' . $inv->due_date . '
                    </td>
                    <td class="text-right">' . number_format($inv->grand_total, 2) . '</td>
                    <td class="text-right">
                    ' . number_format($inv->grand_total - $total_amount_received, 2) . '
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="text-right inv_grand_amount" name="inv_' . $counter . '" value="' . number_format($inv->grand_total - $total_amount_received, 2) . '">
                        </div>
                    </td>
                </tr>';
                $counter++;
                $receivable_payment += $inv->grand_total - $total_amount_received;
            }
        }
        $data = new stdClass();
        $data->html = $html;
        $data->receivable_payment = $receivable_payment;
        $data->display_receivable_payment = number_format($receivable_payment, 2);
        $data->inv_count = $counter;
        echo json_encode($data);
    }

    public function get_info_customer_reminder()
    {
        $customer_id = $this->input->post("customer_id");
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $invoices = $this->accounting_invoices_model->get_payements_by_customer_id($customer_id);
        $data = new stdClass();
        $data->cutsomer_email = $customer_info->email;
        $data->name = $customer_info->first_name . " " . $customer_info->last_name . "";
        $data->invoice_count = count($invoices);
        $data->business_name = $customer_info->business_name;
        echo json_encode($data);
    }

    public function find_cutsomer_by_invoice_number()
    {
        $find_inv = $this->input->post("find_inv_no");
        $invoice_info = $this->accounting_invoices_model->get_invoice_by_invoice_no($find_inv);
        $customer_id = "";
        if ($invoice_info != null) {
            $customer_id = $invoice_info->customer_id;
        }
        $data = new stdClass();
        $data->customer_id = $customer_id;
        echo json_encode($data);
    }

    public function save_receive_payment_from_modal($action = "")
    {
        $inv_count = $this->input->post("invoice_count");
        $customer_id = $this->input->post("customer_id");
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        // var_dump($this->input->post());
        $count_save = 0;

        $receive_payment_id = $this->input->post("receive_payment_id");
        $file_name = $this->receive_payment_generate_pdf($customer_info, $receive_payment_id);
        if ($receive_payment_id == "") {
            $receive_payment_id = 0;
            $insert = array(
                "customer_id" => $customer_id,
                "payment_date" => date("Y-m-d", strtotime($this->input->post("payment_date"))),
                "payment_method" => $this->input->post("payment_method"),
                "ref_no" => $this->input->post("ref_no"),
                "deposit_to" => $this->input->post("deposite_to"),
                "amount" => $this->input->post("amount_received"),
                "memo" => $this->input->post("memo"),
                "attachments" => $this->input->post("attachement-filenames"),
                "status" => "1",
                "user_id" => logged('id'),
                "company_id" => $customer_info->company_id,
                "created_by" => logged('id'),
            );
            $file_names = explode(",", $this->input->post("attachement-filenames"));
            for ($i = 0; $i < count($file_names); $i++) {
                if ($file_names[$i] != "") {
                    $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                    $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];

                    if (file_exists($source)) {
                        copy($source, $destination);
                        unlink($source);
                    }
                }
            }

            $receive_payment_id = $this->accounting_receive_payment_model->insert_receive_payment($insert);
            $count_save++;
            for ($i = 0; $i < $inv_count; $i++) {
                $invoice_info = $this->accounting_invoices_model->get_invoice_by_invoice_no($this->input->post("inv_number_" . $i));
                $amount = 0;
                $invoice_payments = $this->accounting_receive_payment_model->get_invoice_receive_payment($invoice_info->id, $receive_payment_id);
                $total_amount_received = 0;
                foreach ($invoice_payments as $receive) {
                    $total_amount_received += $receive->payment_amount;
                }
                if ($this->input->post("inv_cb_" . $i) == "on") {
                    $amount = str_replace(',', '', $this->input->post("inv_" . $i));
                    $insert = array(
                        "receive_payment_id" => $receive_payment_id,
                        "invoice_id" => $invoice_info->id,
                        "invoice_number" => $invoice_info->invoice_number,
                        "open_balance" => $invoice_info->grand_total - ($total_amount_received),
                        "payment_amount" => $amount
                    );
                    $this->accounting_receive_payment_model->insert_receive_payment_invoices($insert);

                    $update = array("balance" => $invoice_info->grand_total - ($total_amount_received + $amount));
                    if ($update["balance"] <= 0) {
                        $update["status"]="Paid";
                    } else {
                        $update["status"]="Partially Paid";
                    }
                    $update["date_updated"] = date("Y-m-d H:i:s");
                    $this->accounting_invoices_model->updateInvoices($invoice_info->id, $update);
                    $new_status_data=array(
                        "invoice_id" => $invoice_info->id,
                        "status" => $update["status"],
                        "note" => "Received payment"
                    );
                    $this->invoice_model->new_invoice_status($new_status_data);
                }
            }

            if ($this->input->post('payment_method') == 'Cash') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'is_collected' => '1',
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Check') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'check_number' => $this->input->post('check_number'),
                    'routing_number' => $this->input->post('routing_number'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Credit Card') {
                $payment_data = array(
                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'credit_number' => $this->input->post('credit_number'),
                    'credit_expiry' => $this->input->post('credit_expiry'),
                    'credit_cvc' => $this->input->post('credit_cvc'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Debit Card') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'credit_number' => $this->input->post('debit_credit_number'),
                    'credit_expiry' => $this->input->post('debit_credit_expiry'),
                    'credit_cvc' => $this->input->post('debit_credit_cvc'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'ACH') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'routing_number' => $this->input->post('ach_routing_number'),
                    'account_number' => $this->input->post('ach_account_number'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Venmo') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('account_credentials'),
                    'account_note' => $this->input->post('account_note'),
                    'confirmation' => $this->input->post('confirmation'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Paypal') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('paypal_account_credentials'),
                    'account_note' => $this->input->post('paypal_account_note'),
                    'confirmation' => $this->input->post('paypal_confirmation'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Square') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('square_account_credentials'),
                    'account_note' => $this->input->post('square_account_note'),
                    'confirmation' => $this->input->post('square_confirmation'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Warranty Work') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('warranty_account_credentials'),
                    'account_note' => $this->input->post('warranty_account_note'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Home Owner Financing') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('home_account_credentials'),
                    'account_note' => $this->input->post('home_account_note'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'e-Transfer') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('e_account_credentials'),
                    'account_note' => $this->input->post('e_account_note'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Other Credit Card Professor') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'credit_number' => $this->input->post('other_credit_number'),
                    'credit_expiry' => $this->input->post('other_credit_expiry'),
                    'credit_cvc' => $this->input->post('other_credit_cvc'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            } elseif ($this->input->post('payment_method') == 'Other Payment Type') {
                $payment_data = array(

                    'payment_method' => $this->input->post('payment_method'),
                    'amount' => $this->input->post('payment_amount'),
                    'account_credentials' => $this->input->post('other_payment_account_credentials'),
                    'account_note' => $this->input->post('other_payment_account_note'),
                    'transaction_type' => "Receive Payment",
                    'transaction_id' => $receive_payment_id,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                );

                $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
            }
        } else {
            $this->update_receive_payment_from_modal();
            $count_save++;
        }
        $config['upload_path'] = base_url("uploads/sample/upload");
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($this->input->post('attachment-file'))) {
            $uplaod_result = array('error' => $this->upload->display_errors());
        } else {
            $uplaod_result = $this->upload->data();
        }

        $data = new stdClass();
        $data->file_location = base_url("assets/pdf/" . $file_name);
        $data->receive_payment_id = $receive_payment_id;
        $data->customer_email = $customer_info->email;
        $data->business_name = $customer_info->business_name;
        $data->count_save = $count_save;
        $data->uplaod_result = $this->input->post();
        if ($action == "") {
            echo json_encode($data);
        } elseif ($action == "print-saver") {
            return $data;
        }
    }

    public function get_customer_search_result()
    {
        $value = $this->input->post("value");
        $search_results = $this->accounting_invoices_model->get_customer_search_result($value);
        $html = "";
        foreach ($search_results as $customer) {
            $html .= '<li class="customer-full-page-btn" data-customer-id="' . $customer->prof_id . '">
                <a  href="javascript:void(0)" >
                    ' . $customer->name . '
                </a>
            </li>';
        }
        $data = new stdClass();
        $data->html = $html;
        echo json_encode($data);
    }

    public function send_email_receive_payment($customer_id)
    {
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: Receive Payment || ' . $customer_info->first_name . " " . $customer_info->last_name . "";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        //get job data

        $this->page_data['company_name'] = $customer_info->business_name;
        $this->page_data['payement_date'] = $this->input->post("payment_date");
        $this->page_data['customer_name'] = $customer_info->first_name . " " . $customer_info->last_name;
        $this->page_data['amount_received'] = $this->input->post("amount_received");
        $this->page_data['payment_method'] = $this->input->post("payment_method");
        $this->page_data['ref_no'] = $this->input->post("ref_no");
        $this->page_data['deposite_to'] = $this->input->post("deposite_to");
        $this->page_data['memo'] = $this->input->post("memo");
        $this->page_data['action_request'] = "email";
        $this->page_data['has_logo'] = false;
        // $this->load->view('accounting/customer_includes/html_email_print', $this->page_data);
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        $filePath = base_url() . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image;
        if (@getimagesize($filePath)) {
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image, 'company_logo', $customer_info->business_image);
            $this->page_data['has_logo'] = true;
        }

        $mail->Body = 'Receive Payment.';
        $content = $this->load->view('accounting/customer_includes/html_email_print', $this->page_data, true);
        $mail->MsgHTML($content);
        $mail->addAddress($customer_info->email);
        if (!$mail->Send()) {
            return "Message could not be sent. <br> " . 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        } else {
            return "success";
        }
    }

    public function print_receive_payment()
    {
        $data = $this->save_receive_payment_from_modal("print-saver");
        echo json_encode($data);
    }

    public function update_receive_payment_from_modal()
    {
        $customer_id = $this->input->post("customer_id");
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $inv_count = $this->input->post("invoice_count");
        $receive_payment_id = $this->input->post("receive_payment_id");
        $receive_payment_details_old = $this->accounting_receive_payment_model->getReceivePaymentDetails($receive_payment_id);

        if ($receive_payment_details_old->attachments != $this->input->post("attachement-filenames")) {
            $old_attachments = explode(",", $receive_payment_details_old->attachments);
            for ($i = 0; $i < count($old_attachments); $i++) {
                if ($old_attachments[$i] != "") {
                    if (file_exists(("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]))) {
                        unlink("uploads/accounting/attachments/final-attachments/" . $old_attachments[$i]);
                    }
                }
            }
        }
        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    copy($source, $destination);
                    unlink($source);
                }
            }
        }

        $where = array(
            "id" => $receive_payment_id
        );
        $data = array(
            "customer_id" => $customer_id,
            "payment_date" => date("Y-m-d", strtotime($this->input->post("payment_date"))),
            "payment_method" => $this->input->post("payment_method"),
            "ref_no" => $this->input->post("ref_no"),
            "deposit_to" => $this->input->post("deposite_to"),
            "amount" => $this->input->post("amount_received"),
            "memo" => $this->input->post("memo"),
            "attachments" => $this->input->post("attachement-filenames"),
            "status" => "1",
            "user_id" => logged('id'),
            "company_id" => $customer_info->company_id,
            "created_by" => logged('id'),
        );
        $this->accounting_receive_payment_model->update_receive_payment_details($data, $receive_payment_id);

        $file_names = explode(",", $this->input->post("attachement-filenames"));
        for ($i = 0; $i < count($file_names); $i++) {
            if ($file_names[$i] != "") {
                $source = "uploads/accounting/attachments/forms/" . $file_names[$i];
                $destination = "uploads/accounting/attachments/final-attachments/" . $file_names[$i];
                if (file_exists($source)) {
                    $temp1 = copy($source, $destination);
                    $temp1 = unlink($source);
                }
            }
        }

        if ($this->input->post('payment_method') == 'Cash') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'is_collected' => '1',
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Check') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'check_number' => $this->input->post('check_number'),
                'routing_number' => $this->input->post('routing_number'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Credit Card') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('credit_number'),
                'credit_expiry' => $this->input->post('credit_expiry'),
                'credit_cvc' => $this->input->post('credit_cvc'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Debit Card') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('debit_credit_number'),
                'credit_expiry' => $this->input->post('debit_credit_expiry'),
                'credit_cvc' => $this->input->post('debit_credit_cvc'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'ACH') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'routing_number' => $this->input->post('ach_routing_number'),
                'account_number' => $this->input->post('ach_account_number'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Venmo') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('account_credentials'),
                'account_note' => $this->input->post('account_note'),
                'confirmation' => $this->input->post('confirmation'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Paypal') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('paypal_account_credentials'),
                'account_note' => $this->input->post('paypal_account_note'),
                'confirmation' => $this->input->post('paypal_confirmation'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Square') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('square_account_credentials'),
                'account_note' => $this->input->post('square_account_note'),
                'confirmation' => $this->input->post('square_confirmation'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Warranty Work') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('warranty_account_credentials'),
                'account_note' => $this->input->post('warranty_account_note'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Home Owner Financing') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('home_account_credentials'),
                'account_note' => $this->input->post('home_account_note'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'e-Transfer') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('e_account_credentials'),
                'account_note' => $this->input->post('e_account_note'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Other Credit Card Professor') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('other_credit_number'),
                'credit_expiry' => $this->input->post('other_credit_expiry'),
                'credit_cvc' => $this->input->post('other_credit_cvc'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        } elseif ($this->input->post('payment_method') == 'Other Payment Type') {
            $payment_data = array(

                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('other_payment_account_credentials'),
                'account_note' => $this->input->post('other_payment_account_note'),
                'transaction_type' => "Receive Payment",
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_receive_payment_model->update_payment_method($payment_data, $receive_payment_id);
        }

        for ($i = 0; $i < $inv_count; $i++) {
            $invoice_info = $this->accounting_invoices_model->get_invoice_by_invoice_no($this->input->post("inv_number_" . $i));
            $amount = 0;
            $invoice_payments = $this->accounting_receive_payment_model->get_invoice_receive_payment($invoice_info->id, $receive_payment_id);
            $total_amount_received = 0;
            
            if ($this->input->post("inv_cb_" . $i) == "on") {
                $amount = str_replace(',', '', $this->input->post("inv_" . $i));
                $where = array(
                    "receive_payment_id" => $receive_payment_id,
                    "invoice_id" => $invoice_info->id
                );
                $data = array(
                    "invoice_number" => $invoice_info->invoice_number,
                    "open_balance" => $invoice_info->grand_total - ($total_amount_received),
                    "payment_amount" => $amount,
                    "date_modified" => date("Y-m-d H:i:s"),
                );
                $updated = $this->accounting_receive_payment_model->update_receive_payment_invoices($data, $where);
                if (!$updated) {
                    $insert = array(
                        "receive_payment_id" => $receive_payment_id,
                        "invoice_id" => $invoice_info->id,
                        "invoice_number" => $invoice_info->invoice_number,
                        "open_balance" => $invoice_info->grand_total - ($total_amount_received),
                        "payment_amount" => $amount
                    );
                    $this->accounting_receive_payment_model->insert_receive_payment_invoices($insert);
                }
            } else {
                $where = array(
                    "receive_payment_id" => $receive_payment_id,
                    "invoice_id" => $invoice_info->id
                );
                $this->accounting_receive_payment_model->delete_receive_payment_invoices($where);
            }

            $total_amount_received = 0;
            $open_balance = $invoice_info->grand_total;
            $invoice_payments  = $this->accounting_receive_payment_model->get_invoice_receive_payment($invoice_info->id);
            
            foreach ($invoice_payments as $receive) {
                $total_amount_received += $receive->payment_amount;
                $where = array(
                    "receive_payment_id" => $receive->receive_payment_id,
                    "invoice_id" => $invoice_info->id
                );
                $data = array(
                    "open_balance" => $open_balance,
                    "date_modified" => date("Y-m-d H:i:s"),
                    "note" => "Open blance got updated due to Payment #".$receive_payment_id." got modified"
                );
                $updated = $this->accounting_receive_payment_model->update_receive_payment_invoices($data, $where);
                $open_balance -= $receive->payment_amount;
            }

            $this->accounting_invoices_model->updateInvoices($invoice_info->id, array("balance" => $invoice_info->grand_total - ($total_amount_received + $amount)));
        }
    }

    public function receive_payment_generate_pdf($customer_info = null, $receive_payment_id = null)
    {
        $data = array(
            'company_name' => $customer_info->business_name,
            'payement_date' => $this->input->post("payment_date"),
            'customer_name' => $customer_info->first_name . " " . $customer_info->last_name,
            'amount_received' => $this->input->post("amount_received"),
            'payment_method' => $this->input->post("payment_method"),
            'ref_no' => $this->input->post("ref_no"),
            'deposite_to' => $this->input->post("deposite_to"),
            'memo' => $this->input->post("memo"),
            'action_request' => "print",
            'business_id' => $customer_info->business_id,
            'has_logo' => $customer_info->business_image,
            'inv_count' => $this->input->post("invoice_count"),
            'business_name' => $customer_info->business_name,
            'business_address_street' => $customer_info->bus_street,
            'business_address_state' => $customer_info->bus_city . " " . $customer_info->bus_state . " " . $customer_info->bus_postal_code . " ",
            'business_contact_number' => $customer_info->business_phone,
            'business_email' => $customer_info->business_email,
            'business_logo' => $customer_info->business_id . "/" . $customer_info->business_image,
            'customer_adress_street' => $customer_info->acs_mail_add,
            'customer_address_state' => $customer_info->acs_city . " " . $customer_info->acs_state . " " . $customer_info->acs_zip_code . " ",
        );
        $file_name = "receive_payment_pdf_" . $receive_payment_id . ".pdf";
        $this->pdf->save_pdf("accounting/customer_includes/html_email_print", $data, "receive_payment_pdf_" . $receive_payment_id . ".pdf", "P");
        return $file_name;
    }

    public function get_customer_info_for_sales_receipt()
    {
        $customer_info = $this->accounting_customers_model->get_customer_by_id($this->input->post("customer_id"));
        $data = new stdClass();
        $data->customer_address = $customer_info->acs_mail_add . " " . $customer_info->acs_city . ", " . $customer_info->acs_state . " " . $customer_info->acs_zip_code;
        $data->business_address = $customer_info->bus_street . " " . $customer_info->bus_city . ", " . $customer_info->bus_state . " " . $customer_info->bus_postal_code;
        $data->date_now = date('m/d/Y');
        echo json_encode($data);
    }

    public function get_customer_info()
    {
        $customer_info = $this->accounting_customers_model->get_customer_by_id($this->input->post("customer_id"));
        $data = new stdClass();
        $data->customer_name = $customer_info->first_name . " " . $customer_info->last_name;
        $data->customer_email = $customer_info->acs_email;
        $data->business_name = $customer_info->business_name;
        $data->customer_address = $customer_info->acs_mail_add . " " . $customer_info->acs_city . ", " . $customer_info->acs_state . " " . $customer_info->acs_zip_code;
        $data->business_address = $customer_info->bus_street . " " . $customer_info->bus_city . ", " . $customer_info->bus_state . " " . $customer_info->bus_postal_code;
        $data->date_now = date('m/d/Y');
        echo json_encode($data);
    }

    public function create_pdf_sales_receipt($file_name, $customer_id, $sales_number, $action = "")
    {
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $sales_receipt_info = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($sales_number);
        $sales_receipt_items = $this->accounting_sales_receipt_model->get_sales_receipt_items($sales_number);
        $data = array(
            'business_name' => $customer_info->business_name,
            'business_address_street' => $sales_receipt_info->location_scale,
            'business_address_state' => "",
            'business_contact_number' => $customer_info->business_phone,
            'business_email' => $customer_info->business_email,
            'business_logo' => $customer_info->business_id . "/" . $customer_info->business_image,
            'sales_number' => $sales_receipt_info->id,
            'adjustment_name' => $sales_receipt_info->adjustment_name,
            'adjustment_value' => $sales_receipt_info->adjustment_value,
            'receipt_date' => $sales_receipt_info->date_created,
            'customer_full_name' => $customer_info->first_name . ' ' . $customer_info->last_name,
            'customer_adress_street' => $sales_receipt_info->billing_address,
            'customer_address_state' => '',
            'items' => $sales_receipt_items,
        );
        if ($action == "download_print_sales_receipt") {
            $this->pdf->load_view("accounting/customer_includes/sales_receipt/sales_receipt_to_pdf", $data, $file_name, "P");
        } elseif ($action == "download_print_packaging_slip") {
            $this->pdf->load_view("accounting/customer_includes/sales_receipt/sales_receipt_packaging_slip_pdf", $data, $file_name, "P");
        } elseif ($action == "print_sales_receipt") {
            $this->pdf->save_pdf("accounting/customer_includes/sales_receipt/sales_receipt_to_pdf", $data, $file_name, "P");
        } elseif ($action == "print_packaging_slip") {
            $this->pdf->save_pdf("accounting/customer_includes/sales_receipt/sales_receipt_packaging_slip_pdf", $data, $file_name, "P");
        }
    }

    public function view_print_sales_receipt()
    {
        $action = $this->input->post("action");
        if ($action == "print_packaging_slip") {
            $file_name = 'packaging_slip_' . $this->input->post("sales_number") . ".pdf";
        } else {
            $file_name = 'sales_receipt_' . $this->input->post("sales_number") . ".pdf";
        }
        $customer_id = $this->input->post("customer_id");
        $sales_number = $this->input->post("sales_number");

        $this->create_pdf_sales_receipt($file_name, $customer_id, $sales_number, $action);

        $data = new stdClass();
        $data->file_location = base_url("assets/pdf/" . $file_name);
        echo json_encode($data);
    }

    public function download_sales_receipt($sales_receipt_id = null, $action = "")
    {
        if ($sales_receipt_id != null) {
            if ($action == "download_print_sales_receipt") {
                $file_name = 'sales_receipt_' . $sales_receipt_id . ".pdf";
            } elseif ($action == "download_print_packaging_slip") {
                $file_name = 'packaging_slip_' . $sales_receipt_id . ".pdf";
            } else {
                $file_name = "";
            }
            if ($file_name != "") {
                $sales_receipt_details = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($sales_receipt_id);
                if ($sales_receipt_details) {
                    $customer_id = $sales_receipt_details->customer_id;
                    $this->create_pdf_sales_receipt($file_name, $customer_id, $sales_receipt_id, $action);
                } else {
                    redirect('accounting');
                }
            } else {
                redirect('accounting');
            }
        } else {
            redirect('accounting');
        }
    }
    public function download_refund_receipt($refund_receipt_id = null, $action = "")
    {
        if ($refund_receipt_id != null) {
            if ($action == "download_print_refund_receipt") {
                $file_name = 'refund_receipt_' . $refund_receipt_id . ".pdf";
            } else {
                $file_name = "";
            }
            if ($file_name != "") {
                $refund_receipt_details = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($refund_receipt_id);
                if ($refund_receipt_details) {
                    $customer_id = $refund_receipt_details->customer_id;
                    $this->create_pdf_refund_receipt($file_name, $customer_id, $refund_receipt_id, $action);
                } else {
                    redirect('accounting');
                }
            } else {
                redirect('accounting');
            }
        } else {
            redirect('accounting');
        }
    }

    public function sales_receipt_send_email()
    {
        $sales_receipt_id = $this->input->post("sales_receipt_id");
        $customer_email = $this->input->post("email");
        $data = new stdClass();
        if ($sales_receipt_id != "") {
            $sales_receipt_details = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($sales_receipt_id);
            if ($sales_receipt_details) {
                $customer_id = $sales_receipt_details->customer_id;
                $sales_receipt_file_name = 'sales_receipt_' . $sales_receipt_id . ".pdf";
                $packaging_slip_file_name = 'packaging_slip_' . $sales_receipt_id . ".pdf";

                $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

                $server = MAIL_SERVER;
                $port = MAIL_PORT;
                $username = MAIL_USERNAME;
                $password = MAIL_PASSWORD;
                $from = MAIL_FROM;
                $subject = $this->input->post("subject");

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->getSMTPInstance()->Timelimit = 5;
                $mail->Host = $server;
                $mail->SMTPAuth = true;
                $mail->Username = $username;
                $mail->Password = $password;
                $mail->SMTPSecure = 'ssl';
                $mail->Timeout = 10; // seconds
                $mail->Port = $port;
                $mail->From = $from;
                $mail->FromName = 'nSmarTrac';
                $mail->Subject = $subject;

                //get job data

                $this->page_data['company_name'] = $customer_info->business_name;
                $this->page_data['customer_name'] = $customer_info->first_name . " " . $customer_info->last_name;
                $this->page_data['sales_receipt_file_name'] = base_url("assets/pdf/" . $sales_receipt_file_name);
                $this->page_data['packaging_slip_file_name'] = base_url("assets/pdf/" . $packaging_slip_file_name);
                $this->page_data['has_logo'] = false;
                $this->page_data['email_body'] = $this->input->post("body");
                $this->page_data['sales_receipt_id'] = $sales_receipt_id;
                // $this->load->view('accounting/customer_includes/html_email_print', $this->page_data);
                $mail->IsHTML(true);
                $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
                $filePath = base_url() . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image;
                if (@getimagesize($filePath)) {
                    $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image, 'company_logo', $customer_info->business_image);
                    $this->page_data['has_logo'] = true;
                }

                $mail->Body = 'Receive Payment.';
                $content = $this->load->view('accounting/customer_includes/sales_receipt/sales_receipt_send_email', $this->page_data, true);
                $mail->MsgHTML($content);
                $mail->addAddress($customer_email);
                if (!$mail->Send()) {
                    $data->status = "Message could not be sent. <br> " . 'Mailer Error: ' . $mail->ErrorInfo;
                    exit;
                } else {
                    $data->status = "success";
                }
            }
        } else {
            $data->status = "data invalid";
        }
        echo json_encode($data);
    }
    public function refund_receipt_send_email()
    {
        $refund_receipt_id = $this->input->post("refund_receipt_id");
        $customer_email = $this->input->post("email");
        $data = new stdClass();
        if ($refund_receipt_id != "") {
            $refund_receipt_details = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($refund_receipt_id);
            if ($refund_receipt_details) {
                $customer_id = $refund_receipt_details->customer_id;
                $refund_receipt_file_name = 'refund_receipt_' . $refund_receipt_id . ".pdf";

                $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

                $server = MAIL_SERVER;
                $port = MAIL_PORT;
                $username = MAIL_USERNAME;
                $password = MAIL_PASSWORD;
                $from = MAIL_FROM;
                $subject = $this->input->post("subject");

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->getSMTPInstance()->Timelimit = 5;
                $mail->Host = $server;
                $mail->SMTPAuth = true;
                $mail->Username = $username;
                $mail->Password = $password;
                $mail->SMTPSecure = 'ssl';
                $mail->Timeout = 10; // seconds
                $mail->Port = $port;
                $mail->From = $from;
                $mail->FromName = 'nSmarTrac';
                $mail->Subject = $subject;

                //get job data

                $this->page_data['company_name'] = $customer_info->business_name;
                $this->page_data['customer_name'] = $customer_info->first_name . " " . $customer_info->last_name;
                $this->page_data['refund_receipt_file_name'] = base_url("assets/pdf/" . $refund_receipt_file_name);
                $this->page_data['has_logo'] = false;
                $this->page_data['email_body'] = $this->input->post("body");
                $this->page_data['refund_receipt_id'] = $refund_receipt_id;
                // $this->load->view('accounting/customer_includes/html_email_print', $this->page_data);
                $mail->IsHTML(true);
                $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
                $filePath = base_url() . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image;
                if (@getimagesize($filePath)) {
                    $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image, 'company_logo', $customer_info->business_image);
                    $this->page_data['has_logo'] = true;
                }

                $mail->Body = 'Receive Payment.';
                $content = $this->load->view('accounting/customer_includes/refund_receipt/refund_receipt_send_email', $this->page_data, true);
                $mail->MsgHTML($content);
                $mail->addAddress($customer_email);
                if (!$mail->Send()) {
                    $data->status = "Message could not be sent. <br> " . 'Mailer Error: ' . $mail->ErrorInfo;
                    exit;
                } else {
                    $data->status = "success";
                }
            }
        } else {
            $data->status = "data invalid";
        }
        echo json_encode($data);
    }

    public function sample_email()
    {
        $this->page_data['company_name'] = "Sample Company";
        $this->page_data['customer_name'] = "Sample Customer";
        $this->page_data['sales_receipt_file_name'] = "link";
        $this->page_data['packaging_slip_file_name'] = "link2";
        $this->page_data['has_logo'] = false;
        $this->page_data['email_body'] = 'Dear Sample Name,

        Please review the sales receipt below.
        We appreciate it very much.

        Thanks for your business!
        Sample Company';
        $this->page_data['sales_receipt_id'] = "1234";
        $this->load->view('accounting/customer_includes/sales_receipt/sales_receipt_send_email', $this->page_data);
    }

    public function receive_payment_send_email()
    {
        $receive_payment_id = $this->input->post("receive_payment_id");
        $customer_email = $this->input->post("email");
        $data = new stdClass();
        if ($receive_payment_id != "") {
            $receive_payment_details = $this->accounting_receive_payment_model->getReceivePaymentDetails($receive_payment_id);
            $customer_info = $this->accounting_customers_model->get_customer_by_id($receive_payment_details->customer_id);
            $file_name = 'receive_payment_pdf_' . $receive_payment_id . ".pdf";

            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            $from = MAIL_FROM;
            $subject = $this->input->post("subject");

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // seconds
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'nSmarTrac';
            $mail->Subject = $subject;

            //get job data

            $this->page_data['subject'] = $subject;
            $this->page_data['company_name'] = $customer_info->business_name;
            $this->page_data['file_link'] = base_url("assets/pdf/" . $file_name);
            $this->page_data['has_logo'] = false;
            $this->page_data['email_body'] = $this->input->post("body");
            // $this->load->view('accounting/customer_includes/html_email_print', $this->page_data);
            $mail->IsHTML(true);
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
            $filePath = base_url() . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image;
            if (@getimagesize($filePath)) {
                $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image, 'company_logo', $customer_info->business_image);
                $this->page_data['has_logo'] = true;
            }

            $mail->Body = 'Receive Payment.';
            $content = $this->load->view('accounting/customer_includes/receive_payment/receive_payment_send_email', $this->page_data, true);
            $mail->MsgHTML($content);
            $mail->addAddress($customer_email);
            if (!$mail->Send()) {
                $data->status = "Message could not be sent. <br> " . 'Mailer Error: ' . $mail->ErrorInfo;
                exit;
            } else {
                $data->status = "success";
            }
        } else {
            $data->status = "data invalid";
        }
        echo json_encode($data);
    }

    public function receive_payment_more_option()
    {
        $receive_payment_id = $this->input->post("receive_payment_id");
        $action = $this->input->post("action");
        $result = "";
        if ($action == "void") {
            $data = array(
                "status" => 0,
                "date_modified" => date("Y-m-d H:i:s")
            );
            if ($this->accounting_receive_payment_model->update_receive_payment_details($data, $receive_payment_id)) {
                $result = "success";
            } else {
                $result = "failed";
            }
        } elseif ($action == "delete") {
            if ($this->accounting_receive_payment_model->delete_receive_payment($receive_payment_id)) {
                $result = "success";
            } else {
                $result = "failed";
            }
        }
        $data = new stdClass();
        $data->result = $result;
        echo json_encode($data);
    }

    public function create_statement_get_result_by_customer()
    {
        $statement_modal_type = $this->input->post("statement-modal-type");
        $statement_type = $this->input->post("statement_type");
        $state_date = date("Y-m-d", strtotime($this->input->post("start_date")));
        $end_date = date("Y-m-d", strtotime($this->input->post("end_date")));
        $aviable_tbody = "";
        $unavaibale_tbody = "";
        $total_balance = 0;
        $customers_with_balance_ctr = 0;
        $total_number_of_customer = 0;
        $statement_ctr = 0;
        $missing_email_ctr = 0;
        $missing_statements_ctr = 0;

        if ($statement_modal_type == "by-batch") {
            $ids_array = $this->input->post("by_batch_ids");
        } else {
            $ids_array[] = $this->input->post("customer_id");
        }
        $total_number_of_customer = count($ids_array);
        for ($i = 0; $i < count($ids_array); $i++) {
            $customer_id = $ids_array[$i];
            $total_of_invoices = $this->accounting_invoices_model->get_sum_of_invoices_by_customer_id($customer_id, $state_date, $end_date, $statement_type);
            $total_of_sales_receipt = $this->accounting_sales_receipt_model->get_sum_of_sales_receipt_by_customer_id($customer_id, $state_date, $end_date, $statement_type);
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

            $balance = ($total_of_invoices['collectibles']->total_collectibles + $total_of_sales_receipt['billed']->total_amount_billed) - ($total_of_invoices['received']->total_amount_received + $total_of_sales_receipt['billed']->total_amount_billed);
            $first_td_html = '';

            if ($total_of_invoices['collectibles']->collectibles_count > 0) {
                $first_td_html = '<div class="form-check">
                <div class="checkbox checkbox-sec margin-right">
                    <input type="checkbox" name="customer_checkbox[]" value="' . $customer_id . '" id="customer_checkbox_' . $customer_id . '" class="customer_checkbox" checked>
                    <label for="customer_checkbox_' . $customer_id . '"><span></span></label>
                </div>
            </div>';
            }

            $missing_email = "";
            if ($customer_info->email == "") {
                $missing_email = "missing-email";
            }
            $html = '<tr class="' . $missing_email . '">
                <td class="column-check_box">
                    ' . $first_td_html . '
                </td>
                <td>' . $customer_info->first_name . " " . $customer_info->last_name . '
                    <input type="text" name="customer_ids[]"
                        style="display: none;">
                </td>
                <td class="column-email">
                    <div class="form-group">
                        <input type="email" value="' . $customer_info->email . '"
                            name="emails[]">
                    </div>
                </td>
                <td> $' . number_format($balance, 2, '.', ',') . '</td>
            </tr>';
            if ($total_of_invoices['collectibles']->collectibles_count > 0) {
                $statement_ctr++;
                $aviable_tbody .= $html;
            } else {
                $missing_statements_ctr++;
                $unavaibale_tbody .= $html;
            }
            if ($customer_info->email == "") {
                $missing_email_ctr++;
            }
            if ($balance > 0) {
                $customers_with_balance_ctr++;
                $total_balance += $balance;
            }
        }

        $data = new stdClass();
        $data->result = true;
        $data->transaction_count = $total_of_invoices['collectibles']->collectibles_count + $total_of_invoices['received']->received_count + $total_of_sales_receipt['billed']->billed_count;
        $data->statement_ctr = $statement_ctr;
        $data->missing_email_ctr = $missing_email_ctr;
        $data->missing_statements_ctr = $missing_statements_ctr;
        $data->balance = $total_balance;
        $data->customers_with_balance_ctr = $customers_with_balance_ctr;
        $data->total_number_of_customer = $total_number_of_customer;
        $data->display_balance = number_format($total_balance, 2, '.', ',');
        $data->aviable_tbody = $aviable_tbody;
        $data->unavaibale_tbody = $unavaibale_tbody;

        echo json_encode($data);
    }

    public function save_created_statement()
    {
        $start_date = date("Y-m-d", strtotime($this->input->post("start_date")));
        $end_date = date("Y-m-d", strtotime($this->input->post("end_date")));
        $statement_date = date("Y-m-d", strtotime($this->input->post("statement_date")));

        $statement_modal_type = $this->input->post("statement-modal-type");
        $statement_ids_holder_html = "";
        $file_name_ids = "";
        if ($statement_modal_type == "by-batch") {
            $ids_array = $this->input->post("by_batch_ids");
            $statement_ids = $this->input->post("by_batch_statement_ids");
            if ($statement_ids == null || $statement_ids == "") {
                $statement_ids = array();
            }
        } else {
            $ids_array[] = $this->input->post("customer_id");
            if ($this->input->post("current_statement_id") == "") {
                $statement_ids = array();
            } else {
                $statement_ids[] = $this->input->post("current_statement_id");
            }
        }
        for ($i = 0; $i < count($ids_array); $i++) {
            $customer_id = $ids_array[$i];
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
            if (count($statement_ids) == 0) {
                $insert = array(
                    "statement_type" => $this->input->post("statement_type"),
                    "statement_date" => $statement_date,
                    "customer_id" => $customer_id,
                    "start_date" => $start_date,
                    "end_date" => $end_date,
                    "company_id" => $customer_info->company_id,
                    "created_by" => logged('id'),
                    "status" => 1
                );
                $statement_id = $this->accounting_invoices_model->save_statement($insert);
                $statement_ids[] = $statement_id;
            } else {
                $statement_id = $statement_ids[$i];
                $data = array(
                    "statement_type" => $this->input->post("statement_type"),
                    "statement_date" => $statement_date,
                    "start_date" => $start_date,
                    "end_date" => $end_date,
                    "company_id" => $customer_info->company_id,
                    "created_by" => logged('id'),
                    "status" => 1,
                    "updated_at" => date("Y-m-d H:i:s")
                );
                $this->accounting_invoices_model->update_statement($data, $statement_id);
            }
            $statement_ids_holder_html .= '<input type="text" name="by_batch_statement_ids[]" value="' . $statement_id . '" style="display: none;">';
            $file_name_ids .= $statement_id;
        }

        if ($this->input->post("statement_type") == "Transaction Statement") {
            $file_name = "Transaction_Statement_" . $file_name_ids . ".pdf";
        } elseif ($this->input->post("statement_type") == "Open Item") {
            $file_name = "Open_Item_Statement_" . $file_name_ids . ".pdf";
        } elseif ($this->input->post("statement_type") == "Balance Forward") {
            $file_name = "Balance_forward_Statement_" . $file_name_ids . ".pdf";
        }
        $customer_checkboxes = $this->input->post("customer_checkbox");

        $this->created_statement_pdf($ids_array, $statement_ids, $this->input->post("statement_type"), $file_name, $customer_checkboxes);

        $data = new stdClass();
        $data->file_location = base_url("assets/pdf/" . $file_name);
        $data->statement_id = $statement_id;
        $data->statement_type = $this->input->post("statement_type");
        $data->result = true;
        $data->business_name = $customer_info->business_name;
        $data->customer_full_name = $customer_info->first_name . ' ' . $customer_info->last_name;
        $data->customer_id = $customer_id;
        $data->statement_ids_holder_html = $statement_ids_holder_html;
        $data->file_name_ids = $file_name_ids;
        echo json_encode($data);
    }

    public function created_statement_pdf($customer_ids = array(), $statement_ids = array(), $statement_type = "", $file_name = "", $customer_checkboxes = array())
    {
        if (count($customer_ids) > 0) {
            for ($i = 0; $i < count($customer_ids); $i++) {
                $customer_id = $customer_ids[$i];
                $selected_id_key = array_search($customer_id, $customer_checkboxes);

                if (is_bool($selected_id_key) != 1) {
                    $statement_id = $statement_ids[$i];
                    $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
                    $start_date = date("Y-m-d", strtotime($this->input->post("start_date")));
                    $end_date = date("Y-m-d", strtotime($this->input->post("end_date")));
                    $print_invoices = $this->accounting_invoices_model->get_reanged_invoices_by_customer_id($customer_id, $start_date, $end_date, $statement_type, "print");
                    $invoices = $this->accounting_invoices_model->get_reanged_invoices_by_customer_id($customer_id, $start_date, $end_date, $statement_type);
                    $sales_receipts = $this->accounting_sales_receipt_model->get_ranged_sales_receipts_by_customer_id($customer_id, $start_date, $end_date, $statement_type, "print");


                    $statement_date = date("Y-m-d", strtotime($this->input->post("statement_date")));

                    $has_logo = false;
                    // $this->load->view('accounting/customer_includes/html_email_print', $this->page_data);
                    $filePath = base_url() . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image;
                    if (@getimagesize($filePath)) {
                        $has_logo = true;
                    }

                    $data["pdf_data"][] = array(
                        'business_name' => $customer_info->business_name,
                        'business_address_street' => $customer_info->bus_street,
                        'business_address_state' => $customer_info->bus_city . " " . $customer_info->bus_state . " " . $customer_info->bus_postal_code . " ",
                        'business_contact_number' => $customer_info->business_phone,
                        'business_email' => $customer_info->business_email,
                        'business_logo' => $customer_info->business_id . "/" . $customer_info->business_image,
                        'customer_full_name' => $customer_info->first_name . ' ' . $customer_info->last_name,
                        'customer_adress_street' => $customer_info->acs_mail_add . " ",
                        'customer_address_state' => $customer_info->acs_city . " " . $customer_info->acs_state . " " . $customer_info->acs_zip_code . " ",
                        'statement_type' => $statement_type,
                        'statement_date' => $statement_date,
                        'invoices' => $invoices,
                        'print_invoices' => $print_invoices,
                        'sales_receipts' => $sales_receipts,
                        'statement_id' => $statement_id,
                        'has_logo' => $has_logo,
                        'business_logo' => $customer_info->business_id . '/' . $customer_info->business_image
                    );
                }
            }

            $this->pdf->save_pdf("accounting/customer_includes/create_statement/statement_pdf", $data, $file_name, "P");
        }
    }

    public function send_email_statement()
    {
        $statement_type = $this->input->post("statement_type");
        $customer_id = $this->input->post("customer_id");
        $file_name_ids = $this->input->post("file_name_ids");
        $data = new stdClass();
        if ($file_name_ids != "") {
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
            if ($statement_type == "Transaction Statement") {
                $file_name = "Transaction_Statement_" . $file_name_ids . ".pdf";
            } elseif ($statement_type == "Open Item") {
                $file_name = "Open_Item_Statement_" . $file_name_ids . ".pdf";
            } elseif ($statement_type == "Balance Forward") {
                $file_name = "Balance_forward_Statement_" . $file_name_ids . ".pdf";
            }
            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            $from = MAIL_FROM;
            $subject = $this->input->post("subject");

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // seconds
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'nSmarTrac';
            $mail->Subject = $subject;

            //get job data

            $this->page_data['subject'] = $subject;
            $this->page_data['company_name'] = $customer_info->business_name;
            $this->page_data['file_link'] = base_url("assets/pdf/" . $file_name);
            $this->page_data['has_logo'] = false;
            $this->page_data['email_body'] = $this->input->post("body");
            // $this->load->view('accounting/customer_includes/html_email_print', $this->page_data);
            $mail->IsHTML(true);
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
            $filePath = base_url() . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image;
            if (@getimagesize($filePath)) {
                $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/' . $customer_info->business_id . '/' . $customer_info->business_image, 'company_logo', $customer_info->business_image);
                $this->page_data['has_logo'] = true;
            }

            $mail->Body = 'Statement.';
            $content = $this->load->view('accounting/customer_includes/create_statement/statement_send_email', $this->page_data, true);
            $mail->MsgHTML($content);
            $customer_emails = explode(";", $this->input->post("email"));
            for ($i = 0; $i < (count($customer_emails) - 1); $i++) {
                $mail->addAddress($customer_emails[$i]);
            }
            // $mail->addAddress("pintonlou@gmail.com");

            if (!$mail->Send()) {
                $data->status = "Message could not be sent. <br> " . 'Mailer Error: ' . $mail->ErrorInfo;
                exit;
            } else {
                $data->status = "success";
            }
        } else {
            $data->status = "data invalid";
        }
        echo json_encode($data);
    }

    public function get_search_items()
    {
        $keyword = $this->input->post("iteam_search");
        $html = "";
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if ($row->discount == '') {
                $discount = 0;
            } else {
                $discount = $row->discount;
            }

            $html .= '<li data-id="' . $row->id . '" data-discount="' . $discount . '" data-price="' . $row->price . '" data-name="' . $row->title . '">' . $row->title . '</li>';
        }
        $data = new stdClass();
        $data->html = $html;
        echo json_encode($data);
    }

    public function save_time_activity()
    {
        $time_activity_id = $this->input->post("time_activity_id");
        $new_data['company_id'] = logged("company_id");
        $name = explode("-", $this->input->post('name'));
        $new_data['name_key'] = $name[0];
        $new_data['name_id'] = $name[1];
        $new_data['date'] = date("Y-m-d", strtotime($this->input->post('date')));
        $new_data['customer_id'] = $this->input->post('customer_id');
        $new_data['description'] = $this->input->post('description');
        $new_data['status'] = 1;
        if ($this->input->post('taxable') == "on") {
            $new_data['taxable'] = 1;
        } else {
            $new_data['taxable'] = 0;
        }
        if ($this->input->post('billable') == "on" && $this->input->post('make_time_activity_billable') == 1) {
            $new_data['billable'] = 1;
            $new_data['hourly_rate'] = $this->input->post('billable-amount');
        } else {
            $new_data['billable'] = 0;
            $new_data['hourly_rate'] = 0;
        }
        if ($this->input->post('show_services') == 1) {
            $new_data['service_id'] = $this->input->post('services');
        } else {
            $new_data['service_id'] = null;
        }
        if ($this->input->post('enter-start-end-times') == "on") {
            $new_data['start_time'] = date("H:i:s", strtotime($this->input->post('start-time')));
            $new_data['end_time'] = date("H:i:s", strtotime($this->input->post('end-time')));
            $new_data['break_duration'] = date("H:i:s", strtotime($this->input->post('break-duration')));
            $new_data['time'] = null;
        } else {
            $new_data['time'] = $this->input->post('time-duration');
            $new_data['start_time'] = null;
            $new_data['end_time'] = null;
            $new_data['break_duration'] = null;
        }

        $return_data = new stdClass();
        $return_data->count_save = 1;
        if ($this->input->post("time_activity_id") != "") {
            $new_data['updated_at'] = date("Y-m-d H:i:s");
            $res = $this->accounting_customers_model->update_time_activity($new_data, $time_activity_id);
            if ($res) {
                $return_data->count_save = 1;
            } else {
                $return_data->count_save = 0;
            }
        } else {
            $time_activity_id = $this->accounting_customers_model->add_time_activity($new_data);
        }
        $new_data = array(
            "service" => $this->input->post('show_services'),
            "billable" => $this->input->post('make_time_activity_billable')
        );
        $this->accounting_customers_model->update_accounting_timesheet_settings($new_data);

        $return_data->show_services = $this->input->post('show_services');
        $return_data->time_activity_id = $time_activity_id;
        echo json_encode($return_data);
    }

    public function make_customer_inactive()
    {
        $customer_ids = $this->input->post("customer_ids");
        for ($i = 0; $i < count($customer_ids); $i++) {
            $this->accounting_customers_model->make_customer_inactive($customer_ids[$i]);
        }
        $data = new stdClass();
        $data->result = "success";
        echo json_encode($data);
    }

    public function add_new_customer_type()
    {
        $insert = array(
            "title" => $this->input->post("customer_type"),
            "company_id" => logged("company_id")
        );
        $id = $this->accounting_customers_model->add_new_customer_type($insert);
        $data = new stdClass();
        $data->result = "success";
        if ($id > 0) {
            echo json_encode($data);
        } else {
            $data->result = "denied";
            echo json_encode($data);
        }
    }

    public function customer_print_invoice_pdf()
    {
        $invoice_id = $this->input->post("invoice_id");
        $pdf_file_name = $this->input->post("invoice_no") . "_portalappinv.pdf";
        $this->customer_generate_invoice_pdf($invoice_id, $pdf_file_name);
        $data = new stdClass();
        $data->status = "success";
        $data->pdf_link = base_url("assets/pdf/" . $pdf_file_name);
        echo json_encode($data);
    }

    public function get_load_customer_type_table()
    {
        $tbody_html = "";
        $customer_types = $this->accounting_customers_model->get_customer_type_by_company_id(logged("company_id"));
        foreach ($customer_types as $type) {
            $tbody_html .= '<tr>
                        <td>' . $type->title . '</td>
                        <td>
                            <a href="#" class="edit-customer-type-btn" data-id="' . $type->id . '" data-title="' . $type->title . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><span class="separator"></span>
                            <a href="#" class="delete-customer-type-btn" data-id="' . $type->id . '" data-title="' . $type->title . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>';
        }
        $data = new stdClass();
        $data->tbody_html = $tbody_html;
        echo json_encode($data);
    }

    public function delete_customer_type()
    {
        $id = $this->input->post('id');
        $affected = $this->accounting_customers_model->delete_customer_type($id);
        $data = new stdClass();
        $data->result = "success";
        if ($affected > 0) {
            echo json_encode($data);
        } else {
            $data->result = "denied";
            echo json_encode($data);
        }
    }

    public function update_customer_type()
    {
        $id = $this->input->post('customer-type-id');
        $data = array(
            "title" => $this->input->post("customer_type"),
            "company_id" => logged("company_id")
        );
        $affected = $this->accounting_customers_model->update_customer_type($id, $data);
        $data = new stdClass();
        $data->result = "success";
        if ($affected > 0) {
            echo json_encode($data);
        } else {
            $data->result = "denied";
            echo json_encode($data);
        }
    }

    public function single_customer_page_get_all_customers()
    {
        $counter = 0;
        $html = '';
        $customers = $this->accounting_customers_model->getAllByCompany();
        foreach ($customers as $cus) {
            $invoices = $this->accounting_invoices_model->get_invoices_by_customer_id($cus->prof_id);
            $receivable_payment = 0;
            $total_amount_received = 0;
            foreach ($invoices as $inv) {
                if (is_numeric($inv->grand_total)) {
                    $receivable_payment += $inv->grand_total;
                }
                $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
                foreach ($receive_payment as $payment) {
                    $total_amount_received += $payment->payment_amount;
                }
            }
            $amount = ($receivable_payment - $total_amount_received);
            $html .= '<li data-customer-id="' . $cus->prof_id . '" data-name="' . $cus->first_name . ' ' . $cus->middle_name . ' ' . $cus->last_name . '" data-open-balance="' . $amount . '">
                            <div class="name" >' . $cus->first_name . ' ' . $cus->middle_name . ' ' . $cus->last_name . '</div>
                            <div class="open-balance">$' . number_format(($amount), 2) . '</div>
                        </li>';
            $counter++;
        }
        $data = new stdClass();
        $data->html = $html;
        echo json_encode($data);
    }

    public function single_customer_get_customers_details()
    {
        $counter = 0;
        $html = '';
        $customer_id = $this->input->post("customer_id");
        $customer = $this->accounting_customers_model->getCustomerDetails($customer_id);
        $open_balance = 0;
        $overdue = 0;
        foreach ($customer as $cus) {
            $invoices = $this->accounting_invoices_model->get_invoices_by_customer_id($cus->prof_id);
            $receivable_payment = 0;
            $total_amount_received = 0;
            foreach ($invoices as $inv) {
                if (is_numeric($inv->grand_total)) {
                    $receivable_payment += $inv->grand_total;
                }
                $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
                $amount_received = 0;
                foreach ($receive_payment as $payment) {
                    $total_amount_received += $payment->payment_amount;
                    $amount_received += $payment->payment_amount;
                }
                if (date("Y-m-d", strtotime($inv->due_date)) < date("Y-m-d")) {
                    if (is_numeric($inv->grand_total)) {
                        $overdue += ($inv->grand_total - $amount_received);
                    }
                }
            }
            $open_balance += ($receivable_payment - $total_amount_received);
            $counter++;
            $attachment = $cus->attachment;
        }
        $attachements_html="";
        if ($attachment != "") {
            $files = explode(",", $attachment);
            for ($i=0;$i<count($files);$i++) {
                $ext=explode(".", $files[$i]);
                if ($ext[1] != "jpg" && $ext[1] != "jpeg" && $ext[1] != "png" && $ext[1] != "JPG" && $ext[1] != "JPEG" && $ext[1] != "PNG") {
                    $attachements_html.='<div class="img-holder" data-file-name="'.$files[$i].'"><div class="delete">x</div><img src="'.base_url().'assets/img/accounting/customers/document.png" ></div>';
                } else {
                    $attachements_html.='<div class="img-holder" data-file-name="'.$files[$i].'"><div class="delete">x</div><img src="'.base_url().'/uploads/accounting/attachments/final-attachments/'.$files[$i].'" ></div>';
                }
            }
        }
        $data = new stdClass();
        $data->open_balance = number_format(($open_balance), 2);
        $data->overdue = number_format(($overdue), 2);
        $data->customer_details = $customer;
        $data->attachements_html = $attachements_html;
        $data->customer_accounting_details = $this->accounting_customers_model->get_customer_accounting_details($customer_id);
        $data->company_details = $this->accounting_customers_model->get_customer_by_id($customer_id);
        echo json_encode($data);
    }

    public function filter_date_qualified($filter_date, $date)
    {
        if ($filter_date == "All dates") {
            return true;
        } elseif ($filter_date == "Today") {
            if (date("Y-m-d", strtotime($date)) == date("Y-m-d")) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "Yesterday") {
            if (date("Y-m-d", strtotime($date)) == date("Y-m-d", strtotime("-1 days"))) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "This week") {
            $firstday = date("Y-m-d", strtotime('monday this week'));
            $lastday = date("Y-m-d", strtotime('sunday this week'));
            if (date("Y-m-d", strtotime($date)) >= $firstday && date("Y-m-d", strtotime($date)) <= $lastday) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "This month") {
            if (date("Y-m", strtotime($date)) == date("Y-m")) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "This quarter") {
            $currentdate = date('Y-m-d');
            $month = date("n", strtotime($currentdate));
            $currentQuarter = ceil($month / 3);

            $date = date("Y-m", strtotime($date));
            $month = date("n", strtotime($currentdate));
            $customerQuarter = ceil($month / 3);

            if ($currentQuarter == $customerQuarter) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "This year") {
            if (date("Y", strtotime($date)) == date("Y")) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "Last week") {
            $firstday = date("Y-m-d", strtotime('monday last week'));
            $lastday = date("Y-m-d", strtotime('sunday last week'));
            if (date("Y-m-d", strtotime($date)) >= $firstday && date("Y-m-d", strtotime($date)) <= $lastday) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "Last month") {
            $firstday = date("Y-m-d", strtotime('first day of previous month'));
            $lastday = date("Y-m-d", strtotime('last day of previous month'));
            if (date("Y-m-d", strtotime($date)) >= $firstday && date("Y-m-d", strtotime($date)) <= $lastday) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "Last quarter") {
            $currentdate = date('Y-m-d');
            $month = date("n", strtotime($currentdate));
            $currentQuarter = ceil($month / 3) - 1;

            $date = date("Y-m", strtotime($date));
            $month = date("n", strtotime($currentdate));
            $customerQuarter = ceil($month / 3);

            if ($currentQuarter == $customerQuarter) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "Last quarter") {
            if (date("Y", strtotime($date)) == date("Y") - 1) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_date == "Last 365 days") {
            $firstday = date("Y-m-d", strtotime("-365 days"));
            $lastday = date("Y-m-d");
            if (date("Y-m-d", strtotime($date)) >= $firstday && date("Y-m-d", strtotime($date)) <= $lastday) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function single_customer_get_transaction_lists()
    {
        $tbody_html = "";
        $counter = 0;
        $customer_id = $this->input->post("customer_id");
        $filter_type = $this->input->post("filter_type");
        $filter_date = $this->input->post("filter_date");
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $invoices = $this->accounting_invoices_model->get_invoices_by_customer_id($customer_id);
        $tr_html = "";
        foreach ($invoices as $inv) {
            if ($inv->view_flag != 1 && $inv->void != 1) {
                $receivable_payment = 0;
                $total_amount_received = 0;
                $tr_html = "";
                if (is_numeric($inv->grand_total)) {
                    $receivable_payment = $inv->grand_total;
                }
                $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
                foreach ($receive_payment as $payment) {
                    $total_amount_received += $payment->payment_amount;
                }

                $balance = $receivable_payment - $total_amount_received;
                foreach ($receive_payment as $payment) {
                    $total_amount_received += $payment->payment_amount;
                    $amount_received = $payment->payment_amount;

                    $this->page_data['date'] = $payment->payment_date;
                    $this->page_data['type'] = "Payment";
                    $this->page_data['no'] = $payment->ref_no;
                    $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                    $this->page_data['method'] = $payment->payment_method;
                    $this->page_data['source'] = "";
                    $this->page_data['memo'] = $payment->memo;
                    $this->page_data['duedate'] = $inv->due_date;
                    $this->page_data['aging'] = $this->get_date_difference_indays($payment->payment_date, date("Y-m-d"));
                    $this->page_data['balance'] = $balance;
                    $this->page_data['total'] = $balance - $payment->payment_amount;
                    $this->page_data['last_delivered'] = "";
                    $this->page_data['email'] = $customer_info->acs_email;
                    $this->page_data['attatchement'] = "";
                    $this->page_data['status'] = "Closed";
                    $this->page_data['ponumber'] = "";
                    $this->page_data['sales_rep'] = "";
                    $this->page_data['customer_id'] = $customer_id;
                    $this->page_data['invoice_payment_id'] = $payment->id;
                    $this->page_data['invoice_id'] = $inv->id;
                    if ($this->filter_date_qualified($filter_date, $this->page_data['date']) && $this->filter_type_qualified($filter_type, $this->page_data)) {
                        $tr_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                    }
                }
                if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
                    $status = "Overdue";
                } else {
                    if ($balance <= 0) {
                        $status = "Paid";
                    } else {
                        $status = "Open";
                    }
                }
                $this->page_data['date'] = $inv->date_issued;
                $this->page_data['type'] = "Invoice";
                $this->page_data['no'] = $inv->invoice_number;
                $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                $this->page_data['method'] = "";
                $this->page_data['source'] = "";
                $this->page_data['memo'] = "";
                $this->page_data['duedate'] = $inv->due_date;
                $this->page_data['aging'] = $this->get_date_difference_indays($inv->date_issued, date("Y-m-d"));
                $this->page_data['balance'] = $balance;
                $this->page_data['total'] = $receivable_payment;
                $this->page_data['last_delivered'] = "";
                $this->page_data['email'] = $inv->customer_email;
                $this->page_data['attatchement'] = "";
                $this->page_data['status'] = $status;
                $this->page_data['invoice_status'] = $inv->status;
                $this->page_data['ponumber'] = "";
                $this->page_data['sales_rep'] = "";
                $this->page_data['customer_id'] = $customer_id;
                $this->page_data['invoice_payment_id'] = "";
                $this->page_data['invoice_id'] = $inv->id;
                $tbody_html .= $tr_html;
                if ($this->filter_date_qualified($filter_date, $this->page_data['date']) && $this->filter_type_qualified($filter_type, $this->page_data)) {
                    $tbody_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                }
            }
        }

        //Code for Sales Receipt

        // $sales_receipts = $this->accounting_sales_receipt_model->getAllByCustomerId($customer_id);
        // foreach ($sales_receipts as $receipt) {
        //     $this->page_data['date']=$receipt->sales_receipt_date;
        //     $this->page_data['type']="Sales Receipt";
        //     $this->page_data['no']=$receipt->ref_number;
        //     $this->page_data['customer']=$customer_info->first_name.' '.$customer_info->last_name;
        //     $this->page_data['method']=$receipt->payment_method;
        //     $this->page_data['source']="";
        //     $this->page_data['memo']=$receipt->message;
        //     $this->page_data['duedate']=$receipt->sales_receipt_date;
        //     $this->page_data['aging']=$this->get_date_difference_indays($receipt->sales_receipt_date, date("Y-m-d"));
        //     $this->page_data['balance']="0.00";
        //     $this->page_data['total']=$receipt->grand_total;
        //     $this->page_data['last_delivered']=$receipt->shipping_date;
        //     $this->page_data['email']=$customer_info->customer_email;
        //     $this->page_data['attatchement']="";
        //     $this->page_data['status']="Paid";
        //     $this->page_data['ponumber']="";
        //     $this->page_data['sales_rep']="";
        //     $this->page_data['customer_id']=$customer_id;
        //     $this->page_data['invoice_payment_id']="";
        //     $this->page_data['invoice_id']="";
        //     $this->page_data['sales_receipt_id']=$receipt->id;
        //     if ($this->filter_date_qualified($filter_date, $this->page_data['date']) && $this->filter_type_qualified($filter_type, $this->page_data)) {
        //         $tbody_html.=$this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
        //     }
        // }
        if ($filter_type == "All plus deposits") {
            $all_deposits = $this->accounting_customers_model->get_customer_deposits($customer_id);
            foreach ($all_deposits as $deposit) {
                $this->page_data['date'] = $deposit->date;
                $this->page_data['type'] = "Deposit";
                $this->page_data['no'] = "";
                $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                $this->page_data['method'] = "";
                $this->page_data['source'] = "";
                $this->page_data['memo'] = $deposit->memo;
                $this->page_data['duedate'] = "";
                $this->page_data['aging'] = $this->get_date_difference_indays($deposit->date, date("Y-m-d"));
                $this->page_data['balance'] = 0;
                $this->page_data['total'] = $deposit->total_amount;
                $this->page_data['last_delivered'] = "";
                $this->page_data['email'] = $customer_info->customer_email;
                $this->page_data['attatchement'] = "";
                $this->page_data['status'] = $deposit->status;
                $this->page_data['ponumber'] = "";
                $this->page_data['sales_rep'] = "";
                $this->page_data['customer_id'] = $customer_id;
                $this->page_data['invoice_payment_id'] = "";
                $this->page_data['invoice_id'] = "";
                $this->page_data['sales_receipt_id'] = "";
                $this->page_data['deposit_id'] = $deposit->id;
                if ($this->filter_date_qualified($filter_date, $this->page_data['date']) && $this->filter_type_qualified($filter_type, $this->page_data)) {
                    $tbody_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                }
            }
        } elseif ($filter_type == "Open estimates") {
            $all_estimates = $this->accounting_customers_model->get_customer_estimates($customer_id, "Submitted");
            foreach ($all_estimates as $estimates) {
                $this->page_data['date'] = $estimates->estimate_date;
                $this->page_data['type'] = "Estimate";
                $this->page_data['no'] = $estimates->purchase_order_number;
                $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                $this->page_data['method'] = "";
                $this->page_data['source'] = "";
                $this->page_data['memo'] = "";
                $this->page_data['expiration_date'] = $estimates->expiry_date;
                $this->page_data['accepted_date'] = $estimates->accepted_date;
                $this->page_data['accepted_by'] = ""; //to be ask
                $this->page_data['aging'] = $this->get_date_difference_indays($estimates->estimate_date, date("Y-m-d"));
                $this->page_data['balance'] = 0;
                $this->page_data['total'] = $estimates->estimate_value;
                $this->page_data['last_delivered'] = "";
                $this->page_data['email'] = $customer_info->customer_email;
                $this->page_data['attatchement'] = "";
                $this->page_data['status'] = "Open";
                $this->page_data['ponumber'] = "";
                $this->page_data['sales_rep'] = "";
                $this->page_data['customer_id'] = $customer_id;
                $this->page_data['invoice_payment_id'] = "";
                $this->page_data['invoice_id'] = "";
                $this->page_data['sales_receipt_id'] = "";
                $this->page_data['deposit_id'] = "";
                $this->page_data['estimate_id'] = $estimates->id;
                if ($this->filter_date_qualified($filter_date, $this->page_data['date']) && $this->filter_type_qualified($filter_type, $this->page_data)) {
                    $tbody_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                }
            }
        } elseif ($filter_type == "Unbilled income") {
            $all_estimates = $this->accounting_customers_model->get_customer_estimates($customer_id, "Accepted");
            foreach ($all_estimates as $estimates) {
                if ($this->accounting_invoices_model->get_invoice_by_estimate_id($estimates->id) == null) {
                    $this->page_data['date'] = $estimates->estimate_date;
                    $this->page_data['type'] = "Estimate";
                    $this->page_data['no'] = $estimates->purchase_order_number;
                    $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                    $this->page_data['method'] = "";
                    $this->page_data['source'] = "";
                    $this->page_data['memo'] = "";
                    $this->page_data['duedate'] = $estimates->expiry_date;
                    $this->page_data['aging'] = $this->get_date_difference_indays($estimates->estimate_date, date("Y-m-d"));
                    $this->page_data['balance'] = 0;
                    $this->page_data['total'] = $estimates->estimate_value;
                    $this->page_data['last_delivered'] = "";
                    $this->page_data['email'] = $customer_info->customer_email;
                    $this->page_data['attatchement'] = "";
                    $this->page_data['status'] = "Unbilled";
                    $this->page_data['ponumber'] = "";
                    $this->page_data['sales_rep'] = "";
                    $this->page_data['customer_id'] = $customer_id;
                    $this->page_data['invoice_payment_id'] = "";
                    $this->page_data['invoice_id'] = "";
                    $this->page_data['sales_receipt_id'] = "";
                    $this->page_data['deposit_id'] = "";
                    $this->page_data['estimate_id'] = $estimates->id;
                    if ($this->filter_date_qualified($filter_date, $this->page_data['date']) && $this->filter_type_qualified($filter_type, $this->page_data)) {
                        $tbody_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                    }
                }
            }
        } elseif ($filter_type == "Credit memos") {
            $all_credit_memos = $this->accounting_customers_model->get_customer_credit_memo($customer_id);
            foreach ($all_credit_memos as $credit_memo) {
                $this->page_data['date'] = $credit_memo->credit_memo_date;
                $this->page_data['type'] = "Credit memo";
                $this->page_data['no'] = "";
                $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                $this->page_data['method'] = "";
                $this->page_data['source'] = "";
                $this->page_data['memo'] = $credit_memo->message_credit_memo;
                $this->page_data['duedate'] = "";
                $this->page_data['aging'] = $this->get_date_difference_indays($credit_memo->credit_memo_date, date("Y-m-d"));
                $this->page_data['balance'] = 0;
                $this->page_data['total'] = $credit_memo->grand_total;
                $this->page_data['last_delivered'] = "";
                $this->page_data['email'] = $customer_info->customer_email;
                $this->page_data['attatchement'] = "";
                $this->page_data['status'] = $credit_memo->status;
                $this->page_data['ponumber'] = "";
                $this->page_data['sales_rep'] = "";
                $this->page_data['customer_id'] = $customer_id;
                $this->page_data['invoice_payment_id'] = "";
                $this->page_data['invoice_id'] = "";
                $this->page_data['sales_receipt_id'] = "";
                $this->page_data['deposit_id'] = "";
                $this->page_data['estimate_id'] = "";
                $this->page_data['credit_memo_id'] = $credit_memo->id;
                if ($this->filter_date_qualified($filter_date, $this->page_data['date']) && $this->filter_type_qualified($filter_type, $this->page_data)) {
                    $tbody_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                }
            }
        } elseif ($filter_type == "Statements") {
            $all_statements = $this->accounting_customers_model->get_customer_statement($customer_id);
            foreach ($all_statements as $statement) {
                $this->page_data['date'] = $statement->statement_date;
                $this->page_data['type'] = $statement->statement_type;
                $this->page_data['no'] = "";
                $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                $this->page_data['method'] = "";
                $this->page_data['source'] = "";
                $this->page_data['memo'] = "";
                $this->page_data['duedate'] = "";
                $this->page_data['aging'] = $this->get_date_difference_indays($statement->statement_date, date("Y-m-d"));
                $this->page_data['balance'] = "";
                $this->page_data['total'] = "";
                $this->page_data['last_delivered'] = "";
                $this->page_data['email'] = $customer_info->customer_email;
                $this->page_data['attatchement'] = "";
                $this->page_data['status'] = "";
                $this->page_data['ponumber'] = "";
                $this->page_data['sales_rep'] = "";
                $this->page_data['start_date'] = $statement->start_date;
                $this->page_data['end_date'] = $statement->end_date;
                $this->page_data['statement_type'] = $statement->statement_type;
                $this->page_data['customer_id'] = $customer_id;
                $this->page_data['invoice_payment_id'] = "";
                $this->page_data['invoice_id'] = "";
                $this->page_data['sales_receipt_id'] = "";
                $this->page_data['deposit_id'] = "";
                $this->page_data['estimate_id'] = "";
                $this->page_data['credit_memo_id'] = "";
                $this->page_data['statement_id'] = $statement->id;
                if ($this->filter_date_qualified($filter_date, $this->page_data['date'])) {
                    $tbody_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                }
            }
        } elseif ($filter_type == "Recurring templates") {
            // $all_statements = $this->accounting_customers_model->get_customer_statement($customer_id);
            $all_recurring_templates = $this->accounting_recurring_transactions_model->getAllByCompany_id($customer_id);
            foreach ($all_recurring_templates as $recurring_template) {
                $this->page_data['date'] = "";
                $this->page_data['filtered_type'] = "Recurring templates";
                $this->page_data['type'] = $recurring_template->recurring_type;
                $this->page_data['no'] = "";
                $this->page_data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
                $this->page_data['method'] = "";
                $this->page_data['source'] = "";
                $this->page_data['memo'] = "";
                $this->page_data['duedate'] = "";
                $this->page_data['aging'] = "";
                $this->page_data['balance'] = "";
                $this->page_data['total'] = "";
                $this->page_data['last_delivered'] = "";
                $this->page_data['email'] = "";
                $this->page_data['attatchement'] = "";
                $this->page_data['status'] = "";
                $this->page_data['ponumber'] = "";
                $this->page_data['sales_rep'] = "";
                $this->page_data['start_date'] = "";
                $this->page_data['end_date'] = "";
                $this->page_data['customer_id'] = "";
                $this->page_data['invoice_payment_id'] = "";
                $this->page_data['invoice_id'] = "";
                $this->page_data['sales_receipt_id'] = "";
                $this->page_data['deposit_id'] = "";
                $this->page_data['estimate_id'] = "";
                $this->page_data['credit_memo_id'] = "";
                $this->page_data['statement_id'] = "";
                $this->page_data['recurring_id'] = $recurring_template->id;
                $this->page_data['txn_type'] = $recurring_template->txn_type;
                $this->page_data['interval'] = $recurring_template->recurring_interval;
                $this->page_data['amount'] = "";
                $this->page_data['prev_date'] = "";
                $this->page_data['next_date'] = "";
                $recurring_id = $recurring_template->id;
                if ($recurring_template->txn_type == "Sales Receipt") {
                    $sales_receipts = $this->accounting_sales_receipt_model->get_recuring_sales_receipt($recurring_id);
                    foreach ($sales_receipts as $s_receipt) {
                        $this->page_data['amount'] = $s_receipt->grand_total;
                        $this->page_data['prev_date'] = $s_receipt->sales_receipt_date;
                        if ($recurring_template->recurring_type != "Unschedule") {
                            if ($recurring_template->recurring_interval == "Daily") {
                                if (date("Y-m-d", strtotime($s_receipt->sales_receipt_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $this->page_data['next_date'] = date('Y-m-d', strtotime($recurring_template->start_date . ' + ' . $recurring_template->recurr_every . ' days'));
                                } else {
                                    $this->page_data['next_date'] = date('Y-m-d', strtotime($s_receipt->sales_receipt_date . ' + ' . $recurring_template->recurr_every . ' days'));
                                }
                            } elseif ($recurring_template->recurring_interval == "Weekly") {
                                if (date("Y-m-d", strtotime($s_receipt->sales_receipt_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $next_week = date('Y-m-d', strtotime($recurring_template->start_date . " + " . $recurring_template->recurr_every . " weeks"));
                                } else {
                                    $next_week = date('Y-m-d', strtotime($s_receipt->sales_receipt_date . " + " . $recurring_template->recurr_every . " weeks"));
                                }
                                $next_date = date('Y-m-d', strtotime(strtolower($recurring_template->recurring_day) . ' this week', strtotime($next_week)));
                                $this->page_data['next_date'] = $next_date;
                            } elseif ($recurring_template->recurring_interval == "Monthly") {
                                if (date("Y-m-d", strtotime($s_receipt->sales_receipt_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $month_start = date("Y-m-d", strtotime('first day of this month', strtotime($recurring_template->start_date)));
                                } else {
                                    $month_start = date("Y-m-d", strtotime('first day of this month', strtotime($s_receipt->sales_receipt_date)));
                                }
                                $next_month = date('Y-m-d', strtotime($month_start . " + " . $recurring_template->recurr_every . " months"));
                                if (date("l", strtotime($next_month)) == $recurring_template->recurring_day) {
                                    if ($recurring_template->recurring_week == "First") {
                                        $next_date = $next_month;
                                    } else {
                                        $next_date = date("Y-m-d", strtotime($recurring_template->recurring_week . " " . $recurring_template->recurring_day . " " . date("Y-m-d", strtotime($next_month))));
                                        $next_date = date("Y-m-d", strtotime($next_date . " - 7 days"));
                                    }
                                } else {
                                    $next_date = date("Y-m-d", strtotime($recurring_template->recurring_week . " " . $recurring_template->recurring_day . " " . date("Y-m-d", strtotime($next_month))));
                                }
                                $this->page_data['next_date'] = $next_date;
                            } elseif ($recurring_template->recurring_interval == "Yearly") {
                                if (date("Y-m-d", strtotime($s_receipt->sales_receipt_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $next_year = date("Y", strtotime("+ 1 year", strtotime($recurring_template->start_date)));
                                } else {
                                }
                                $this->page_data['next_date'] = $recurring_template->recurring_month . " " . preg_replace('/[^0-9]/', '', $recurring_template->recurring_day) . " " . $next_year;
                            }
                        }
                    }
                } elseif ($recurring_template->txn_type == "Delayed Charge") {
                    $delayed_charges = $this->accounting_recurring_transactions_model->get_recuring_delayed_charges($recurring_id);
                    foreach ($delayed_charges as $charge) {
                        $this->page_data['amount'] = $charge->total_amount;
                        $this->page_data['prev_date'] = $charge->delayed_credit_date;
                        if ($recurring_template->recurring_type != "Unschedule") {
                            if ($recurring_template->recurring_interval == "Daily") {
                                if (date("Y-m-d", strtotime($charge->delayed_credit_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $this->page_data['next_date'] = date('Y-m-d', strtotime($recurring_template->start_date . ' + ' . $recurring_template->recurr_every . ' days'));
                                } else {
                                    $this->page_data['next_date'] = date('Y-m-d', strtotime($charge->delayed_credit_date . ' + ' . $recurring_template->recurr_every . ' days'));
                                }
                            } elseif ($recurring_template->recurring_interval == "Weekly") {
                                if (date("Y-m-d", strtotime($charge->delayed_credit_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $next_week = date('Y-m-d', strtotime($recurring_template->start_date . " + " . $recurring_template->recurr_every . " weeks"));
                                } else {
                                    $next_week = date('Y-m-d', strtotime($charge->delayed_credit_date . " + " . $recurring_template->recurr_every . " weeks"));
                                }
                                $next_date = date('Y-m-d', strtotime(strtolower($recurring_template->recurring_day) . ' this week', strtotime($next_week)));
                                $this->page_data['next_date'] = $next_date;
                            } elseif ($recurring_template->recurring_interval == "Monthly") {
                                if (date("Y-m-d", strtotime($charge->delayed_credit_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $month_start = date("Y-m-d", strtotime('first day of this month', strtotime($recurring_template->start_date)));
                                } else {
                                    $month_start = date("Y-m-d", strtotime('first day of this month', strtotime($charge->delayed_credit_date)));
                                }
                                $next_month = date('Y-m-d', strtotime($month_start . " + " . $recurring_template->recurr_every . " months"));
                                if (date("l", strtotime($next_month)) == $recurring_template->recurring_day) {
                                    if ($recurring_template->recurring_week == "First") {
                                        $next_date = $next_month;
                                    } else {
                                        $next_date = date("Y-m-d", strtotime($recurring_template->recurring_week . " " . $recurring_template->recurring_day . " " . date("Y-m-d", strtotime($next_month))));
                                        $next_date = date("Y-m-d", strtotime($next_date . " - 7 days"));
                                    }
                                } else {
                                    $next_date = date("Y-m-d", strtotime($recurring_template->recurring_week . " " . $recurring_template->recurring_day . " " . date("Y-m-d", strtotime($next_month))));
                                }
                                $this->page_data['next_date'] = $next_date;
                            } elseif ($recurring_template->recurring_interval == "Yearly") {
                                if (date("Y-m-d", strtotime($charge->delayed_credit_date)) <= date("Y-m-d", strtotime($recurring_template->start_date))) {
                                    $next_year = date("Y", strtotime("+ 1 year", strtotime($recurring_template->start_date)));
                                } else {
                                }
                                $this->page_data['next_date'] = $recurring_template->recurring_month . " " . preg_replace('/[^0-9]/', '', $recurring_template->recurring_day) . " " . $next_year;
                            }
                        }
                    }
                }

                if ($this->filter_date_qualified($filter_date, $this->page_data['date'])) {
                    $tbody_html .= $this->load->view('accounting/customer_includes/customer_single_modal/customer_transactions_tr', $this->page_data, true);
                }
            }
        }

        $data = new stdClass();
        $data->tbody_html = $tbody_html;
        echo json_encode($data);
    }

    public function tester()
    {
        $data_dates = "[";
        $date= date("Y-01-01");
        for ($i = 1; $i < 500 ;$i++) {
            if ($date <= date('Y-m-d', strtotime('12/31/'.date("Y")))) {
                $data_dates .= date("M d", strtotime($date)).",";
                $date= date("Y-m-d", strtotime("+ 1 day", strtotime($date)));
            } else {
                // $i=0;
            }
        }
        $data_dates.="]";
        var_dump($data_dates);
    }
    public function update_customer_notes()
    {
        $customer_id = $this->input->post("customer_id");
        $updated_info = array("notes" => $this->input->post("notes"));
        $success = $this->accounting_customers_model->updateCustomer($customer_id, $updated_info);
        $data = new stdClass();
        $data->customer_id = $customer_id;
        $data->result = "success";
        if (!$success) {
            $data->result = "not success";
        }
        echo json_encode($data);
    }

    public function save_sales_form_content()
    {
        $new_data = array(

            'sales_pref_inv_terms' => $this->input->post("sales_pref_inv_terms"),
            'sales_pref_del_method' => $this->input->post("sales_pref_del_method"),
            'sales_shipping' => $this->input->post("sales_shipping"),
            'sales_custom_fields' => $this->input->post("sales_custom_fields"),
            'sales_cust_trans_numbers' => $this->input->post("sales_cust_trans_numbers"),
            'sales_service_date' => $this->input->post("sales_service_date"),
            'sales_discount' => $this->input->post("sales_discount"),
            'sales_deposit' => $this->input->post("sales_deposit"),
            'sales_tips' => $this->input->post("sales_tips"),
            'sales_tags' => $this->input->post("sales_tags"),

        );

        $addQuery = $this->accounting_account_settings_model->addSalesForm($new_data);

        echo json_encode($addQuery);
    }


    public function save_product_services_content()
    {
        $new_data = array(

            'ps_column_sales_form' => $this->input->post("ps_column_sales_form"),
            'ps_show_sku_column' => $this->input->post("ps_show_sku_column"),
            'ps_price_rules' => $this->input->post("ps_price_rules"),
            'ps_track_qty_price' => $this->input->post("ps_track_qty_price"),
            'ps_track_inv_qty' => $this->input->post("ps_track_inv_qty"),

        );

        $addQuery = $this->accounting_account_settings_model->save_product_services_content($new_data);

        echo json_encode($addQuery);
    }

    public function save_exp_sales_form_content()
    {
        $new_data = array(

            'show_items_exp_pur_forms' => $this->input->post("show_items_exp_pur_forms"),
            'show_tags_exp_pur_forms' => $this->input->post("show_tags_exp_pur_forms"),
            'track_exp_items_cust' => $this->input->post("track_exp_items_cust"),
            'make_exp_items_billable' => $this->input->post("make_exp_items_billable"),
            'default_bill_payment_terms' => $this->input->post("default_bill_payment_terms"),
            'markup_default_rate' => $this->input->post("markup_default_rate"),
            'markup_default_rate_value' => $this->input->post("markup_default_rate_value"),
            'track_billable_exp_items' => $this->input->post("track_billable_exp_items"),
            'charge_sales_tax' => $this->input->post("charge_sales_tax"),

        );

        $addQuery = $this->accounting_account_settings_model->save_exp_sales_form_content($new_data);

        echo json_encode($addQuery);
    }

    public function save_adv_accounting()
    {
        $new_data = array(

            'acct_first_month_fiscal_year' => $this->input->post("acct_first_month_fiscal_year"),
            'acct_first_month_income_tax_yr' => $this->input->post("acct_first_month_income_tax_yr"),
            'acct_accounting_method' => $this->input->post("acct_accounting_method"),
            'acct_close_books' => $this->input->post("acct_close_books"),

        );

        $addQuery = $this->accounting_account_settings_model->save_adv_accounting($new_data);

        echo json_encode($addQuery);
    }

    public function save_progress_invoicing()
    {
        $new_data = array(

            'sales_progress_invoicing' => $this->input->post("sales_progress_invoicing"),

        );

        $addQuery = $this->accounting_account_settings_model->save_progress_invoicing($new_data);

        echo json_encode($addQuery);
    }

    public function save_adv_chart_of_accounts()
    {
        $new_data = array(

            'adv_enable_account_no' => $this->input->post("adv_enable_account_no"),
            'adv_tips_account' => $this->input->post("adv_tips_account"),
            'adv_markup_inc_acct' => $this->input->post("adv_markup_inc_acct"),

        );

        $addQuery = $this->accounting_account_settings_model->save_adv_chart_of_accounts($new_data);

        echo json_encode($addQuery);
    }

    public function sales_messages_save_button()
    {
        $new_data = array(

            'salutation' => $this->input->post("sales_messages_salutation"),
            'messages_name' => $this->input->post("sales_messages_name"),
            'document_type' => $this->input->post("sales_messages_document_type"),
            'subj_line' => $this->input->post("sales_messages_subj_line"),
            'messages_cc' => $this->input->post("sales_messages_cc"),
            'messages_bcc' => $this->input->post("sales_messages_bcc"),
            'messages_form' => $this->input->post("sales_messages_form"),
            'messages_note' => $this->input->post("sales_messages_note"),
            'messages_body' => $this->input->post("sales_messages_body"),
            'messages_enable' => $this->input->post("sales_messages_enable"),
            'send_to_admin' => $this->input->post("sales_messages_send_to_admin"),

        );

        $addQuery = $this->accounting_account_settings_model->sales_messages_save_button($new_data);

        echo json_encode($addQuery);
    }

    public function exp_messages_save_button()
    {
        $new_data = array(

            'salutation' => $this->input->post("exp_messages_salutation"),
            'messages_name' => $this->input->post("exp_messages_name"),
            'document_type' => $this->input->post("exp_messages_document_type"),
            'subj_line' => $this->input->post("exp_messages_subj_line"),
            'messages_cc' => $this->input->post("exp_messages_cc"),
            'messages_bcc' => $this->input->post("exp_messages_bcc"),
            'messages_form' => $this->input->post("exp_messages_form"),
            'messages_note' => $this->input->post("exp_messages_note"),
            'messages_body' => $this->input->post("exp_messages_body"),
            'messages_enable' => $this->input->post("exp_messages_enable"),
            'send_to_admin' => $this->input->post("exp_messages_send_to_admin"),

        );

        $addQuery = $this->accounting_account_settings_model->exp_messages_save_button($new_data);

        echo json_encode($addQuery);
    }

    public function get_date_difference_indays($date_from = "", $date_to = "")
    {
        $date_1 = strtotime($date_to); // or your date as well
        $date_2 = strtotime($date_from);
        $datediff = $date_1 - $date_2;
        return round($datediff / (60 * 60 * 24));
    }

    public function generate_share_invoice_link()
    {
        $invoice_id = $this->input->post("invoice_id");
        $token = "";
        $token_available = false;
        while (!$token_available) {
            $token = sha1(mt_rand(1, 90000) . 'SALT');
            if ($this->accounting_invoices_model->check_token_available_for_shared_invoice_link($token)) {
                $token_available = true;
            }
        }


        $pdf_file_name = $token . "_portalappinv.pdf";
        $this->customer_generate_invoice_pdf($invoice_id, $pdf_file_name);


        $expired_at = date('Y-m-d', strtotime(date("Y-m-d") . ' + 24 days'));
        $data = array(
            "invoice_id" => $invoice_id,
            "token" => $token,
            "expired_at" => $expired_at
        );
        $this->accounting_invoices_model->add_shared_invoice_link($data);


        $shared_link = base_url("portal/appinv/" . $token . "/view");
        $data = new stdClass();
        $data->shared_link = $shared_link;
        echo json_encode($data);
    }

    public function customer_generate_invoice_pdf($invoice_id, $pdf_file_name, $action = "")
    {
        $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);
        $customer_id = $inv->customer_id;
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);


        $receivable_payment = 0;
        $total_amount_received = 0;
        if (is_numeric($inv->grand_total)) {
            $receivable_payment = $inv->grand_total;
        }
        $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
        foreach ($receive_payment as $payment) {
            $total_amount_received += $payment->payment_amount;
        }

        $balance = ($receivable_payment - $total_amount_received) - $inv->deposit_request;

        if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
            $status = "Overdue";
        } else {
            if ($balance <= 0) {
                $status = "Paid";
            } else {
                $status = "Open";
            }
        }

        $pdf_data["data_pdf"][] = array(
            "invoice_date" => $inv->date_issued,
            "invoice_no" => $inv->invoice_number,
            "payment" => $total_amount_received,
            "balance_due" => $balance,
            "inv_location_scale" => $inv->location_scale,
            "inv_ship_from" => $inv->bus_state,
            "inv_ship_via" => $inv->ship_via,
            "inv_taxes" => $inv->taxes,
            "inv_grand_total" => $inv->grand_total,
            "inv_sub_total" => $inv->sub_total,
            "inv_shipping_to_address" => $inv->shipping_to_address,
            "due_date" => $inv->due_date,
            "terms" => $this->accounting_invoices_model->get_terms_by_id($inv->terms)->name,
            "customer_name" => $customer_info->first_name . ' ' . $customer_info->last_name,
            "customer_mail_add" => $customer_info->acs_mail_add,
            "customer_phone_h" => $customer_info->customer_phone_h,
            "customer_city" => $customer_info->acs_city,
            "business_name" => $customer_info->business_name,
            "customer_id" => $customer_info->prof_id,
            "business_email" => $customer_info->business_email,
            "business_website" => $customer_info->website,
            "bus_street" => $customer_info->bus_street,
            "bus_city" => $customer_info->bus_city,
            "bus_state" => $customer_info->bus_state,
            "bus_postal_code" => $customer_info->bus_postal_code,
            "business_logo" => "uploads/users/business_profile/" . $customer_info->business_id . "/" . $customer_info->business_image,
            "invoice_items" => $this->invoice_model->getInvoiceItems($invoice_id),
            "status" => $status
        );
        if ($action == "invoice-packaging-slip") {
            $html_pdf = "accounting/customer_includes/customer_single_modal/invoice_packaging_pdf";
            $orientation = "P";
        } else {
            $html_pdf = "accounting/customer_includes/public_view/shared_invoice_link_pdf";
            $orientation = "P";
        }
        $this->pdf->save_pdf($html_pdf, $pdf_data, $pdf_file_name, $orientation);
    }

    public function print_invoice_packaging_slip()
    {
        $invoice_id = $this->input->post("invoice_id");
        $pdf_file_name = $this->input->post("invoice_no") . "_packaging_slip.pdf";
        $this->customer_generate_invoice_pdf($invoice_id, $pdf_file_name, "invoice-packaging-slip");
        $data = new stdClass();
        $data->status = "success";
        $data->pdf_link = base_url("assets/pdf/" . $pdf_file_name);
        echo json_encode($data);
    }

    public function ajax_get_invoice_info()
    {
        $invoice_id = $this->input->post("invoice_id");
        $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);
        $customer_id = $inv->customer_id;
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $invoice_items = $this->invoice_model->getInvoiceItems($invoice_id);
        $data = new stdClass();
        $data->customer_info = $customer_info;
        $data->invoice_items = $invoice_items;
        $data->invoice_details = $inv;
        echo json_encode($data);
    }

    public function generate_customer_invoice_packaging_slip_by_batch()
    {
        // $customer_ids = $this->input->post("customer_ids");
        $invoice_ids = $this->input->post("invoice_ids");
        for ($ids_i = 0; $ids_i < count($invoice_ids); $ids_i++) {
            $invoice_id = $invoice_ids[$ids_i];
            $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);
            $customer_id = $inv->customer_id;
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);


            $receivable_payment = 0;
            $total_amount_received = 0;
            if (is_numeric($inv->grand_total)) {
                $receivable_payment = $inv->grand_total;
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
            }

            $balance = ($receivable_payment - $total_amount_received) - $inv->deposit_request;

            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
                $status = "Overdue";
            } else {
                if ($balance <= 0) {
                    $status = "Paid";
                } else {
                    $status = "Open";
                }
            }

            $pdf_data["data_pdf"][] = array(
                "invoice_date" => $inv->date_issued,
                "invoice_no" => $inv->invoice_number,
                "payment" => $total_amount_received,
                "balance_due" => $balance,
                "inv_location_scale" => $inv->location_scale,
                "inv_ship_from" => $inv->bus_state,
                "inv_ship_via" => $inv->ship_via,
                "inv_taxes" => $inv->taxes,
                "inv_grand_total" => $inv->grand_total,
                "inv_sub_total" => $inv->sub_total,
                "inv_shipping_to_address" => $inv->shipping_to_address,
                "due_date" => $inv->due_date,
                "terms" => $this->accounting_invoices_model->get_terms_by_id($inv->terms)->name,
                "customer_name" => $customer_info->first_name . ' ' . $customer_info->last_name,
                "customer_mail_add" => $customer_info->acs_mail_add,
                "customer_phone_h" => $customer_info->customer_phone_h,
                "customer_city" => $customer_info->acs_city,
                "business_name" => $customer_info->business_name,
                "customer_id" => $customer_info->prof_id,
                "business_email" => $customer_info->business_email,
                "business_website" => $customer_info->website,
                "bus_street" => $customer_info->bus_street,
                "bus_city" => $customer_info->bus_city,
                "bus_state" => $customer_info->bus_state,
                "bus_postal_code" => $customer_info->bus_postal_code,
                "business_logo" => "uploads/users/business_profile/" . $customer_info->business_id . "/" . $customer_info->business_image,
                "invoice_items" => $this->invoice_model->getInvoiceItems($invoice_id),
                "status" => $status
            );
        }
        $pdf_file_name = "batched_inv_" . $customer_id . "_portalappinv.pdf";

        $html_pdf = "accounting/customer_includes/customer_single_modal/invoice_packaging_pdf";
        $orientation = "P";
        $this->pdf->save_pdf($html_pdf, $pdf_data, $pdf_file_name, $orientation);

        $data = new stdClass();
        $data->status = "success";
        $data->pdf_link = base_url("assets/pdf/" . $pdf_file_name);
        $data->invoice_ids = $invoice_ids;
        echo json_encode($data);
    }

    public function print_transactions_by_batch()
    {
        // $customer_ids = $this->input->post("customer_ids");
        $invoice_ids = $this->input->post("invoice_ids");
        for ($ids_i = 0; $ids_i < count($invoice_ids); $ids_i++) {
            $invoice_id = $invoice_ids[$ids_i];
            $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);
            $customer_id = $inv->customer_id;
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);


            $receivable_payment = 0;
            $total_amount_received = 0;
            if (is_numeric($inv->grand_total)) {
                $receivable_payment = $inv->grand_total;
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
            }

            $balance = ($receivable_payment - $total_amount_received) - $inv->deposit_request;

            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
                $status = "Overdue";
            } else {
                if ($balance <= 0) {
                    $status = "Paid";
                } else {
                    $status = "Open";
                }
            }

            $pdf_data["data_pdf"][] = array(
                "invoice_date" => $inv->date_issued,
                "invoice_no" => $inv->invoice_number,
                "payment" => $total_amount_received,
                "balance_due" => $balance,
                "inv_location_scale" => $inv->location_scale,
                "inv_ship_from" => $inv->bus_state,
                "inv_ship_via" => $inv->ship_via,
                "inv_taxes" => $inv->taxes,
                "inv_grand_total" => $inv->grand_total,
                "inv_sub_total" => $inv->sub_total,
                "inv_shipping_to_address" => $inv->shipping_to_address,
                "due_date" => $inv->due_date,
                "terms" => $this->accounting_invoices_model->get_terms_by_id($inv->terms)->name,
                "customer_name" => $customer_info->first_name . ' ' . $customer_info->last_name,
                "customer_mail_add" => $customer_info->acs_mail_add,
                "customer_phone_h" => $customer_info->customer_phone_h,
                "customer_city" => $customer_info->acs_city,
                "business_name" => $customer_info->business_name,
                "customer_id" => $customer_info->prof_id,
                "business_email" => $customer_info->business_email,
                "business_website" => $customer_info->website,
                "bus_street" => $customer_info->bus_street,
                "bus_city" => $customer_info->bus_city,
                "bus_state" => $customer_info->bus_state,
                "bus_postal_code" => $customer_info->bus_postal_code,
                "business_logo" => "uploads/users/business_profile/" . $customer_info->business_id . "/" . $customer_info->business_image,
                "invoice_items" => $this->invoice_model->getInvoiceItems($invoice_id),
                "status" => $status
            );
        }
        $pdf_file_name = "batched_transactions_" . $customer_id . "_portalappinv.pdf";

        $html_pdf = "accounting/customer_includes/public_view/shared_invoice_link_pdf";
        $orientation = "P";
        $this->pdf->save_pdf($html_pdf, $pdf_data, $pdf_file_name, $orientation);

        $data = new stdClass();
        $data->status = "success";
        $data->pdf_link = base_url("assets/pdf/" . $pdf_file_name);
        $data->invoice_ids = $invoice_ids;
        echo json_encode($data);
        # code...
    }

    public function send_transaction()
    {
        $customer_id = $this->input->post("customer_id");
        $invoice_ids = $this->input->post("invoice_ids");
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

        for ($ids_i = 0; $ids_i < count($invoice_ids); $ids_i++) {
            $invoice_id = $invoice_ids[$ids_i];
            $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);


            $receivable_payment = 0;
            $total_amount_received = 0;
            if (is_numeric($inv->grand_total)) {
                $receivable_payment = $inv->grand_total;
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
            }

            $balance = ($receivable_payment - $total_amount_received) - $inv->deposit_request;

            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
                $status = "Overdue";
            } else {
                if ($balance <= 0) {
                    $status = "Paid";
                } else {
                    $status = "Open";
                }
            }

            $pdf_data["data_pdf"][] = array(
                "invoice_date" => $inv->date_issued,
                "invoice_no" => $inv->invoice_number,
                "payment" => $total_amount_received,
                "balance_due" => $balance,
                "inv_location_scale" => $inv->location_scale,
                "inv_ship_from" => $inv->bus_state,
                "inv_ship_via" => $inv->ship_via,
                "inv_taxes" => $inv->taxes,
                "inv_grand_total" => $inv->grand_total,
                "inv_sub_total" => $inv->sub_total,
                "inv_shipping_to_address" => $inv->shipping_to_address,
                "due_date" => $inv->due_date,
                "terms" => $this->accounting_invoices_model->get_terms_by_id($inv->terms)->name,
                "customer_name" => $customer_info->first_name . ' ' . $customer_info->last_name,
                "customer_mail_add" => $customer_info->acs_mail_add,
                "customer_phone_h" => $customer_info->customer_phone_h,
                "customer_city" => $customer_info->acs_city,
                "business_name" => $customer_info->business_name,
                "customer_id" => $customer_info->prof_id,
                "business_email" => $customer_info->business_email,
                "business_website" => $customer_info->website,
                "bus_street" => $customer_info->bus_street,
                "bus_city" => $customer_info->bus_city,
                "bus_state" => $customer_info->bus_state,
                "bus_postal_code" => $customer_info->bus_postal_code,
                "business_logo" => "uploads/users/business_profile/" . $customer_info->business_id . "/" . $customer_info->business_image,
                "invoice_items" => $this->invoice_model->getInvoiceItems($invoice_id),
                "status" => $status
            );
        }
        $pdf_file_name = "batched_transactions_" . $customer_id . "_portalappinv.pdf";

        $html_pdf = "accounting/customer_includes/public_view/shared_invoice_link_pdf";
        $orientation = "P";
        $this->pdf->save_pdf($html_pdf, $pdf_data, $pdf_file_name, $orientation);

        $subject = $customer_info->business_name . " || Transactions";

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        //get job data

        $this->page_data['customer_name'] = $customer_info->first_name . ' ' . $customer_info->last_name;
        $this->page_data['subject'] = $subject;

        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        $mail->addAttachment(dirname(__DIR__, 2) . '/assets/pdf/' . $pdf_file_name);

        $mail->Body = 'Send Transactions';
        $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
        $mail->MsgHTML($content);
        $mail->addAddress($customer_info->acs_email);

        $data = new stdClass();
        $data->status = "success";
        if (!$mail->Send()) {
            $data->status = "error";
            $data->status = "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }
        echo json_encode($data);
    }
    public function send_transaction_by_batch()
    {
        $invoice_ids = $this->input->post("invoice_ids");
        $email_error_ctr=0;
        $email_sent_ctr=0;
        for ($ids_i = 0; $ids_i < count($invoice_ids); $ids_i++) {
            $invoice_id = $invoice_ids[$ids_i];
            $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);
            $customer_id = $inv->customer_id;
            $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);

            $receivable_payment = 0;
            $total_amount_received = 0;
            if (is_numeric($inv->grand_total)) {
                $receivable_payment = $inv->grand_total;
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
            }

            $balance = ($receivable_payment - $total_amount_received) - $inv->deposit_request;

            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
                $status = "Overdue";
            } else {
                if ($balance <= 0) {
                    $status = "Paid";
                } else {
                    $status = "Open";
                }
            }

            $pdf_data["data_pdf"][] = array(
                "invoice_date" => $inv->date_issued,
                "invoice_no" => $inv->invoice_number,
                "payment" => $total_amount_received,
                "balance_due" => $balance,
                "inv_location_scale" => $inv->location_scale,
                "inv_ship_from" => $inv->bus_state,
                "inv_ship_via" => $inv->ship_via,
                "inv_taxes" => $inv->taxes,
                "inv_grand_total" => $inv->grand_total,
                "inv_sub_total" => $inv->sub_total,
                "inv_shipping_to_address" => $inv->shipping_to_address,
                "due_date" => $inv->due_date,
                "terms" => $this->accounting_invoices_model->get_terms_by_id($inv->terms)->name,
                "customer_name" => $customer_info->first_name . ' ' . $customer_info->last_name,
                "customer_mail_add" => $customer_info->acs_mail_add,
                "customer_phone_h" => $customer_info->customer_phone_h,
                "customer_city" => $customer_info->acs_city,
                "business_name" => $customer_info->business_name,
                "customer_id" => $customer_info->prof_id,
                "business_email" => $customer_info->business_email,
                "business_website" => $customer_info->website,
                "bus_street" => $customer_info->bus_street,
                "bus_city" => $customer_info->bus_city,
                "bus_state" => $customer_info->bus_state,
                "bus_postal_code" => $customer_info->bus_postal_code,
                "business_logo" => "uploads/users/business_profile/" . $customer_info->business_id . "/" . $customer_info->business_image,
                "invoice_items" => $this->invoice_model->getInvoiceItems($invoice_id),
                "status" => $status
            );
        
            $pdf_file_name = "batched_transactions_" . $customer_id . "_portalappinv.pdf";

            $html_pdf = "accounting/customer_includes/public_view/shared_invoice_link_pdf";
            $orientation = "P";
            $this->pdf->save_pdf($html_pdf, $pdf_data, $pdf_file_name, $orientation);

            $subject = $customer_info->business_name . " || Transactions";
            $customer_name = $customer_info->first_name . ' ' . $customer_info->last_name;
            $customer_email = $customer_info->acs_email;
            $subject = `Reminder: Invoice `.$inv->invoice_number.` from Alarm Direct, Inc   `;
            $message = `Hi `.$customer_name.`,
    
        Sending you your transaction. Please see attached file.
                                            
        Thanks for your business!
        `.$customer_info->business_name;

            $this->page_data['customer_name'] = $customer_name;
            $this->page_data['subject'] = $subject;
            $this->page_data['business_name'] = $customer_info->business_name;
            $this->page_data['message'] = $message;
            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            $from = MAIL_FROM;

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // seconds
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'nSmarTrac';
            $mail->Subject = $subject;

            $mail->IsHTML(true);
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
            $mail->addAttachment(dirname(__DIR__, 2) . '/assets/pdf/' . $pdf_file_name);

            $mail->Body = 'Send Transactions';
            $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
            $mail->MsgHTML($content);
            $mail->addAddress($customer_email);
            
            if (!$mail->Send()) {
                // $email_status = "Mailer Error: " . $mail->ErrorInfo;
                $email_error_ctr++;
                exit;
            } else {
                $email_sent_ctr++;
            }
        }
        $data = new stdClass();
        $data->email_error_ctr = $email_error_ctr;
        $data->email_sent_ctr = $email_sent_ctr;
        echo json_encode($data);
    }

    public function cashflowplanner()
    {
        add_css(array(
            "assets/css/accounting/accounting_includes/cashflow.css",
        ));
        add_footer_js(array(
            "assets/js/accounting/accounting/cashflow.js",
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();

        $this->page_data['page_title'] = "Cash Flow";
        
        $this->page_data['customers']       = $this->AcsProfile_model->getAllByCompanyId(logged('company_id'));
        $this->page_data['invoices']        = $this->invoice_model->getAllData(logged('company_id'));
        $this->page_data['clients']         = $this->invoice_model->getclientsData(logged('company_id'));
        $this->page_data['invoices_sales']  = $this->invoice_model->getAllDataSales(logged('company_id'));
        $this->page_data['OpenInvoices']    = $this->invoice_model->getAllOpenInvoices(logged('company_id'));
        $this->page_data['InvOverdue']      = $this->invoice_model->InvOverdue(logged('company_id'));
        $this->page_data['getAllInvPaid']   = $this->invoice_model->getAllInvPaid(logged('company_id'));
        $this->page_data['items']           = $this->items_model->getItemlist();
        $this->page_data['packages']        = $this->workorder_model->getPackagelist(logged('company_id'));
        $this->page_data['estimates']       = $this->estimate_model->getAllByCompanynDraft(logged('company_id'));
        $this->page_data['sales_receipts']  = $this->accounting_sales_receipt_model->getAllByCompany(logged('company_id'));
        $this->page_data['credit_memo']     = $this->accounting_credit_memo_model->getAllByCompany(logged('company_id'));
        $this->page_data['employees']       = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['statements']      = $this->accounting_statements_model->getAllComp(logged('company_id'));
        $this->page_data['rpayments']       = $this->accounting_receive_payment_model->getReceivePaymentsByComp(logged('company_id'));
        $this->page_data['checks']          = $this->vendors_model->get_check_by_comp(logged('company_id'));
        $this->page_data['expenses']        = $this->expenses_model->getExpenseByComp(logged('company_id'));
        $this->page_data['plans']           = $this->vendors_model->getcashflowplan(logged('company_id'));
        $this->page_data['totoverdues']     = $this->invoice_model->totalcountOverdue(logged('company_id'));
        $this->page_data['overdues']        = $this->invoice_model->overdue(logged('company_id'));

        $this->load->view('accounting/cashflowplanner1', $this->page_data);
    }

    public function update_money_in_out_chart()
    {
        $date_range = $this->input->post("date_range");
        $date_base_projected = date("Y-m-d", strtotime("- 3 months", strtotime(date("Y-m-01"))));
        if ($date_range== "12") {
            $date_ctr = date("Y-m-d", strtotime("- 9 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 2 months", strtotime(date("Y-m-01"))));
        } elseif ($date_range== "6") {
            $date_ctr = date("Y-m-d", strtotime("- 3 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 2 months", strtotime(date("Y-m-01"))));
        } elseif ($date_range== "3") {
            $date_ctr = date("Y-m-d", strtotime("- 1 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 1 months", strtotime(date("Y-m-01"))));
        } elseif ($date_range== "1") {
            $date_ctr = date("Y-m-01");
            $date_end = date("Y-m-t");
        } elseif ($date_range== "24") {
            $date_ctr = date("Y-m-d", strtotime("- 9 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 14 months", strtotime(date("Y-m-01"))));
        }

        $data_labels = array();
        $data_values = array();
        $data_projected_money_in = array();
        $data_projected_money_out = array();
        $data_values_money_in =array();
        $data_values_money_out =array();

        $data_start_range = $date_ctr;
        if ($date_base_projected < $date_ctr) {
            $date_ctr=$date_base_projected;
        }
        $prev_amount_receive = -1;
        $prev_amount_expense = -1;
        $prev_month ="";
        $current_amount = 0;
        $total_percentage_money_in =0;
        $total_percentage_money_out =0;
        $total_amount_receive =0;
        $total_amount_expense =0;
        $projected_data_ctr=0;
        $month_ctr=0;
        $month_indicator = "";
        $amount_in_a_month = 0;
        $amount_mony_in = 0;
        $amount_mony_out = 0;
        
        while ($date_ctr <= $date_end) {
            $amount_received = $this->accounting_receive_payment_model->amount_received_in_a_day($date_ctr)->money_in;
            $expense = $this->accounting_receive_payment_model->amount_expense_in_a_day($date_ctr)->money_out;
            $current_balance = ($amount_received-$expense)+0;
            if ($date_ctr >= $data_start_range) {
                if ($month_indicator == date("m", strtotime($date_ctr))) {
                    $amount_in_a_month+=$amount_received;
                    $amount_mony_in+=$amount_received;
                    $amount_mony_out+=$expense;
                } elseif ($month_indicator =="") {
                    $data_labels[]=strtoupper(date("M", strtotime($date_ctr)));
                    $month_indicator = date("m", strtotime($date_ctr));
                }
                if ($date_ctr == $date_end) {
                    $month_indicator="end";
                }
                if ($date_ctr <= $date_end && $month_indicator != date("m", strtotime($date_ctr)) && $month_indicator!="") {
                    if ($month_indicator!="end") {
                        $data_labels[]=strtoupper(date("M", strtotime($date_ctr)));
                    }
                    $data_values[] = $amount_in_a_month;
                    $data_values_money_in[] =$amount_mony_in+0;
                    $data_values_money_out[] =$amount_mony_out+0;
                    

                    $amount_in_a_month=$amount_received;
                    $amount_mony_in = $amount_received;
                    $amount_mony_out = $expense;
                    if ($date_ctr < date("Y-m-d")) {
                        $data_projected_money_in[]=null;
                        $data_projected_money_out[]=null;
                    }
                    
                    $month_indicator = date("m", strtotime($date_ctr));
                }
            }
            
            if ($date_ctr >= $date_base_projected && $date_ctr <= date("Y-m-d")) {
                if ($prev_amount_receive == -1) {
                    $prev_amount_receive = $amount_received;
                    $prev_amount_expense = $expense;
                    $total_percentage_money_in +=1;
                } else {
                    if ($prev_amount_receive >= $amount_received) {
                        $total_percentage_money_in += 0;
                    } else {
                        $total_percentage_money_in += 1-($prev_amount_receive/$amount_received);
                    }
                    if ($prev_amount_expense >= $expense) {
                        $total_percentage_money_out += 0;
                    } else {
                        $total_percentage_money_out += 1-($prev_amount_expense/$expense);
                    }
                    $prev_amount_receive = $amount_received;
                    $prev_amount_expense = $expense;
                }
                $total_amount_receive+=$amount_received;
                $total_amount_expense += $expense;
                $projected_data_ctr++;
            }
            if ($date_ctr >= date("Y-m-d")) {
                $projected_money_in = ($total_amount_receive/$projected_data_ctr)+(($total_amount_receive/$projected_data_ctr)*($total_percentage_money_in/$projected_data_ctr));
                $projected_money_out = ($total_amount_expense/$projected_data_ctr)+(($total_amount_expense/$projected_data_ctr)*($total_percentage_money_out/$projected_data_ctr));
                if (count($data_projected_money_in) == 0) {
                    $data_projected_money_in[] = $projected_money_in;
                } else {
                    if ($prev_month == date("m", strtotime($date_ctr))) {
                        $data_projected_money_in[count($data_projected_money_in)-1] += $projected_money_in;
                    } else {
                        $data_projected_money_in[] = $projected_money_in;
                    }
                }

                if (count($data_projected_money_out) == 0) {
                    $data_projected_money_out[] = $projected_money_out;
                } else {
                    if ($prev_month == date("m", strtotime($date_ctr))) {
                        $data_projected_money_out[count($data_projected_money_out)-1] += $projected_money_out;
                    } else {
                        $data_projected_money_out[] = $projected_money_out;
                    }
                }
                if ($prev_month != date("m", strtotime($date_ctr))) {
                    $prev_month = date("m", strtotime($date_ctr));
                }
            }
            $total_amount_receive+=$projected_money_in;
            $total_amount_expense-=$projected_money_out;
            
            $date_ctr = date("Y-m-d", strtotime("+ 1 day", strtotime($date_ctr)));
        }
        $data = new stdClass();
        $data->data_values_money_in = $data_values_money_in;
        $data->data_values_money_out = $data_values_money_out;
        $data->data_projected_money_in = $data_projected_money_in;
        $data->data_projected_money_out = $data_projected_money_out;
        $data->data_labels  =$data_labels;
        // $data->total_amount_receive=$total_amount_receive;
        // $data->total_percentage_money_in=$total_percentage_money_in;
        // $data->projected_data_ctr=$projected_data_ctr;
        echo json_encode($data);
    }
    public function update_cash_balance_chart1()
    {
        $date_range = $this->input->post("date_range");
        $bottom_x_labels = '<div class="line-divider"></div>';
        if ($date_range== "12") {
            $date_start = date("Y-m-d", strtotime("- 9 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 2 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "6") {
            $date_start = date("Y-m-d", strtotime("- 4 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 1 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "3") {
            $date_start = date("Y-m-d", strtotime("- 1 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 1 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "1") {
            $date_start = date("Y-m-01");
            $date_end = date("Y-m-t");
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "24") {
            $date_start = date("Y-m-d", strtotime("- 9 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 14 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        }
        $data_labels = array();
        $data_values = array();
        $data_projected = array();
        $total_values = array();
        $ctr=0;
        $data_start_range = $the_start_date;
        $date_base_projected = date("Y-m-d", strtotime("- 3 months", strtotime(date("Y-m-01"))));
        if ($date_base_projected < $the_start_date) {
            $the_start_date=$date_base_projected;
        }
        $total_balance=0;
        $total_moeny_in=0;
        $total_money_out=0;
        $data_ctr=0;
        $prev_balance=0;
        $total_percentage_balance=0;
        $prev_amount_receive=-1;
        $total_percentage_money_in=0;
        $prev_amount_expense=0;
        $total_percentage_money_out=0;
        $receive_ctr=0;
        $money_out_devisor_projected=0;
        while ($the_start_date <=$the_end_date) {
            if ($the_start_date>=$data_start_range) {
                $amount_received =
                            $this->accounting_receive_payment_model->amount_received_in_a_day($the_start_date)->money_in;
                $expense =
                            $this->accounting_receive_payment_model->amount_expense_in_a_day($the_start_date)->money_out;
                if ($the_start_date <= date("Y-m-d")) {
                    if ($amount_received> 0) {
                        if ($receive_ctr > 0) {
                            $expense=300;
                        }
                        $receive_ctr ++;
                    }
                    $value = ($amount_received-$expense)+0;//cash balance for the day
                    $data_labels[]=date("M d", strtotime($the_start_date));
                    $data_values[] = $data_values[count($data_values)-1]+$value;
                    $data_values_money_in[] =$amount_received+0;
                    $data_values_money_out[] =$expense+0;
                    if ($the_start_date < date("Y-m-d")) {
                        $data_projected[]=null;
                    }
                    $index=date("d", strtotime($the_start_date));
                    $total_values[$index-1] +=$value;
                }
            }
            if ($the_start_date>=$date_base_projected && $the_start_date <= date("Y-m-d")) {
                if ($prev_amount_receive==-1) {
                    $total_balance=$value;
                    $prev_amount_receive=$amount_received;
                    $prev_amount_expense=$expense;
                    $total_percentage_money_in +=1;
                    $total_percentage_money_out+=1;
                    $total_percentage_balance+=1;
                } else {
                    if ($prev_balance>= $value) {
                        $total_percentage_balance += 0;
                    } else {
                        $total_percentage_balance += 1-($prev_balance/$value);
                    }
                    if ($prev_amount_receive >= $amount_received) {
                        $total_percentage_money_in += 0;
                    } else {
                        $total_percentage_money_in += 1-($prev_amount_receive/$amount_received);
                    }
                    if ($prev_amount_expense >= $expense) {
                        $total_percentage_money_out += 0;
                    } else {
                        $total_percentage_money_out += 1-($prev_amount_expense/$expense);
                    }
                    $prev_balance = $value;
                    $prev_amount_receive = $amount_received;
                    $prev_amount_expense = $expense;
                }
                $total_balance += $value;
                $total_moeny_in +=$amount_received;
                $total_money_out+=$expense;
                $data_ctr++;
            }
            if ($the_start_date > date("Y-m-d")) {
                $projected_balance =($total_balance/$data_ctr)+(($total_balance/$data_ctr)*($total_percentage_balance/$data_ctr));
                $projected_money_in =($total_moeny_in/$data_ctr)+(($total_moeny_in/$data_ctr)*($total_percentage_money_out/$data_ctr));
                $projected_money_out =($total_money_out/($data_ctr+$money_out_devisor_projected))+(($total_money_out/($data_ctr+$money_out_devisor_projected))*($total_percentage_money_out/($data_ctr+$money_out_devisor_projected)));
                $projected_balance=$projected_money_in;
                if ($the_start_date > date("Y-m-d")) {
                    $data_labels[]=date("M d", strtotime($the_start_date));
                    $data_values[] = null;
                }
                if ($ctr==0) {
                    $data_projected[] = $total_balance+$projected_balance;
                } else {
                    $data_projected[] =($data_projected[count($data_projected)-1]+$projected_balance)-$projected_money_out;
                }
                // $data_values_money_out[]=floor($projected_money_out);
                // $data_values_money_in[]=$projected_money_in;
                $ctr++;
                $money_out_devisor_projected++;
                $total_money_out-=$projected_money_out;
                $data_ctr++;
            }
            $total_balance+=$projected_balance;
            $total_moeny_in+=$projected_money_in;
            $the_start_date = date("Y-m-d", strtotime("+ 1 day", strtotime($the_start_date)));
        }
    
        $data = new stdClass();
        $data->bottom_x_labels=$bottom_x_labels;
        $data->data_labels = $data_labels;
        $data->data_values = $data_values;
        $data->data_projected = $data_projected;
        $data->data_values_money_in = $data_values_money_in;
        $data->data_values_money_out = $data_values_money_out;
        $data->date_base_projected = $date_base_projected;
        $data->total_balance = $total_balance;
        $data->data_ctr = $data_ctr;
        echo json_encode($data);
    }
    public function update_cash_balance_chart()
    {
        $date_range = $this->input->post("date_range");
        $bottom_x_labels = '<div class="line-divider"></div>';
        if ($date_range== "12") {
            $date_start = date("Y-m-d", strtotime("- 9 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 2 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "6") {
            $date_start = date("Y-m-d", strtotime("- 4 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 1 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "3") {
            $date_start = date("Y-m-d", strtotime("- 1 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 1 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "1") {
            $date_start = date("Y-m-01");
            $date_end = date("Y-m-t");
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        } elseif ($date_range== "24") {
            $date_start = date("Y-m-d", strtotime("- 9 months", strtotime(date("Y-m-01"))));
            $date_end = date("Y-m-t", strtotime("+ 14 months", strtotime(date("Y-m-01"))));
            $the_start_date = $date_start;
            $the_end_date = $date_end;
            $ctr=1;
            while ($date_start <= $date_end) {
                $bottom_x_labels .= '<li class="moth month-'.$ctr.'">'.date("M", strtotime($date_start)).'</li>';
                $date_start = date("Y-m-d", strtotime("+ 1 month", strtotime($date_start)));
                $ctr++;
            }
        }

        $data_labels = array();
        $data_values = array();
        $data_projected = array();
        $total_values = array();
        $ctr=1;
        $current_balance=0;
        while ($the_start_date <= $the_end_date) {
            $value = rand(rand(1, $ctr+2), $ctr+2);
            $amount_received = $this->accounting_receive_payment_model->amount_received_in_a_day($the_start_date)->money_in;
            $expense = $this->accounting_receive_payment_model->amount_expense_in_a_day($the_start_date)->money_out;
            if ($the_start_date <= date("Y-m-d")) {
                $value = ($amount_received-$expense)+0;
                $data_labels[]=date("M d", strtotime($the_start_date));
                $data_values[] = $data_values[count($data_values)-1]+$value;
                $data_values_money_in[] =$amount_received+0;
                $data_values_money_out[] =$expense+0;
                if ($the_start_date == date("Y-m-d")) {
                    $data_projected[] = $data_values[count($data_values)-1] ;
                } elseif ($the_start_date < date("Y-m-d")) {
                    $data_projected[] = null;
                }
                $index = date("d", strtotime($the_start_date));
                $total_values[$index-1] += $data_values[count($data_values)-1]+$value;
                $current_balance=$data_values[count($data_values)-1]+$value;
            }
            if ($the_start_date > date("Y-m-d")) {
                if ($date_range== "1") {
                    $date_range = count($total_values);
                }
                $index = date("d", strtotime($the_start_date));
                $value = $total_values[$index-1]/$date_range;
                $total_values[$index-1]+=$value;
                
                if ($the_start_date > date("Y-m-d")) {
                    $data_labels[]=date("M d", strtotime($the_start_date));
                    $data_values[] = null;
                } elseif ($the_start_date == date("Y-m-d")) {
                    $value = $amount_received+0;
                }
                $current_balance+=$value;
                $data_projected[] = $current_balance;
            }
            $the_start_date = date("Y-m-d", strtotime("+ 1 day", strtotime($the_start_date)));
            $ctr++;
        }

        $data = new stdClass();
        $data->bottom_x_labels=$bottom_x_labels;
        $data->data_labels = $data_labels;
        $data->data_values = $data_values;
        $data->data_projected = $data_projected;
        $data->data_values_money_in = $data_values_money_in;
        $data->data_values_money_out = $data_values_money_out;
        echo json_encode($data);
    }
    public function add_attachement()
    {
        $data = new stdClass();
        if (0 < $_FILES['file']['error']) {
            $data->error = 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            $uniquesavename = time() . uniqid(rand());
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $destination = 'uploads/accounting/attachments/forms/' . $uniquesavename . '.' . $ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);
            $sourceFile = $_SERVER['DOCUMENT_ROOT'] . '/' . $destination;
            //$content = file_get_contents($sourceFile,FILE_USE_INCLUDE_PATH);

            $data->destination = $destination;
            $data->ext = $ext;
            $data->uniquesavename = $uniquesavename;
        }
        echo json_encode($data);
    }
    public function add_customer_info_attachement()
    {
        $data = new stdClass();
        if (0 < $_FILES['file']['error']) {
            $data->error = 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            $uniquesavename = time() . uniqid(rand());
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $destination = 'uploads/accounting/attachments/final-attachments/' . $uniquesavename . '.' . $ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);
            $sourceFile = $_SERVER['DOCUMENT_ROOT'] . '/' . $destination;
            //$content = file_get_contents($sourceFile,FILE_USE_INCLUDE_PATH);



            $customer_info=$this->accounting_customers_model->get_customer_by_id($_POST['customer_id']);
            if ($customer_info->asc_attachment!="") {
                $files=$customer_info->asc_attachment.",".$uniquesavename.".".$ext;
            } else {
                $files=$uniquesavename.".".$ext;
            }
            
            $this->accounting_customers_model->updateCustomer($_POST['customer_id'], array("attachment"=>$files));
            $data->destination = $destination;
            $data->ext = $ext;
            $data->uniquesavename = $uniquesavename;
        }
        

        echo json_encode($data);
    }

    public function delete_customer_info_attachement()
    {
        $filename = $this->input->post("filename");
        $attachments = $this->accounting_customers_model->get_customer_by_id($this->input->post("customer_id"))->asc_attachment;
        $files=explode(",", $attachments);
        $status="";
        $update_data = "";
        for ($i = 0; $i < count($files); $i++) {
            $destination = "uploads/accounting/attachments/final-attachments/" . $files[$i];
            if ($files[$i] == $filename) {
                if (file_exists($destination)) {
                    if (!unlink($destination)) {
                        $status .= "///// $destination cannot be deleted due to an error";
                    } else {
                        $status .= "///// $destination has been deleted";
                    }
                }
            } else {
                if ($update_data=="") {
                    $update_data.=$files[$i];
                } else {
                    $update_data.=",".$files[$i];
                }
            }
        }
        $this->accounting_customers_model->updateCustomer($this->input->post("customer_id"), array("attachment"=>$update_data));
        $data = new stdClass();
        $data->status = $status;
        echo json_encode($data);
    }

    public function delete_file_attachement()
    {
        $filenames = $this->input->post("filenames");
        $files = explode(",", $filenames);
        $status = "";
        for ($i = 0; $i < count($files); $i++) {
            $destination = "uploads/accounting/attachments/forms/" . $files[$i];
            if (file_exists($destination)) {
                if (!unlink($destination)) {
                    $status .= "///// $destination cannot be deleted due to an error";
                } else {
                    $status .= "///// $destination has been deleted";
                }
            }
        }
        $data = new stdClass();
        $data->status = $status;
        echo json_encode($data);
    }

    public function save_update_estimate_status()
    {
        $id = $this->input->post("id");
        $status = $this->input->post("est_status");

        $new_data = array(
            'id' => $id,
            'status' => $status,
        );

        $status = $this->estimate_model->save_update_estimate_status($new_data);
        $this->page_data['estimates'] = $status;

        echo json_encode($this->page_data);
    }

    public function send_estimates_customer()
    {
        // $id         = $this->input->post("id");
        // $status     = $this->input->post("est_status");

        $customer_name = $this->input->post("custname");
        $customer_email = $this->input->post("email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;

        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        // $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);

        $mail->MsgHTML($message);

        $data = new stdClass();
        try {
            $mail->addAddress($customer_email);
            $mail->addAddress('webtestcustomer@nsmartrac.com');
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

        echo json_encode($json_data);
    }

    public function send_estimates_customer_sr()
    {
        // $id         = $this->input->post("id");
        // $status     = $this->input->post("est_status");

        $customer_name = $this->input->post("custname");
        $customer_email = $this->input->post("email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;

        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        // $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);

        $mail->MsgHTML($message);

        $data = new stdClass();
        try {
            $mail->addAddress($customer_email);
            $mail->addAddress('webtestcustomer@nsmartrac.com');
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

        echo json_encode($json_data);
    }

    public function send_estimates_customer_cm()
    {
        // $id         = $this->input->post("id");
        // $status     = $this->input->post("est_status");

        $customer_name = $this->input->post("custname");
        $customer_email = $this->input->post("email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;

        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        // $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);

        $mail->MsgHTML($message);

        $data = new stdClass();
        try {
            $mail->addAddress($customer_email);
            $mail->addAddress('webtestcustomer@nsmartrac.com');
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

        echo json_encode($json_data);
    }
    public function filter_all_sales()
    {
        $the_html_tbody="";

        
        //scripts for invoices
        $where=" invoices.company_id =".logged("company_id");
        if ($this->input->post("filter_status") == "Open") {
            $where.=" AND (invoices.status!='Draft' AND invoices.status!='Declined' AND invoices.status!='Paid')";
        } elseif ($this->input->post("filter_status") == "Overdue") {
            $where.=" AND (invoices.status='Due' AND invoices.status='Overdue') ";
        } elseif ($this->input->post("filter_status") == "Paid") {
            $where.=" AND invoices.status='Paid' ";
        } elseif ($this->input->post("filter_status") == "Pending") {
            $where.=" AND invoices.status='Submitted' ";
        } elseif ($this->input->post("filter_status") == "Accepted") {
            $where.=" AND invoices.status='Approved' ";
        } elseif ($this->input->post("filter_status") == "Closed") {
            $where.=" AND invoices.status='Closed' ";
        } elseif ($this->input->post("filter_status") == "Rejected") {
            $where.=" AND invoices.status='Declined' ";
        } elseif ($this->input->post("filter_status") == "Expired") {
            $where.=" AND invoices.status='Expired' ";
        }
        if ($this->input->post("filter_date") != "All dates") {
            if ($this->input->post("filter_date") == "Last 365 days") {
                $where.=" AND (invoices.date_issued >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."')";
            } else {
                $where.=" AND (invoices.date_issued >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."' AND invoices.date_issued <= '".date("Y-m-d", strtotime($this->input->post("filter_date_to")))."')";
            }
        }
        if ($this->input->post("filter_customer") != "all") {
            $where.=" AND invoices.customer_id = ".$this->input->post("filter_customer");
        }
        $this->page_data['invoices']=$this->accounting_invoices_model->get_filtered_invoices($where);
        
        //scripts for estimates
        $where=" company_id =".logged("company_id");
        if ($this->input->post("filter_status") == "Open" || $this->input->post("filter_status") == "All statuses") {
            $where.=" AND (status!='Draft' AND status!='Declined By Customer' AND status!='Lost')";
        } elseif ($this->input->post("filter_status") == "Overdue") {
            $where.=" AND (status='Overdue') ";
        } elseif ($this->input->post("filter_status") == "Paid") {
            $where.=" AND status='Paid' ";
        } elseif ($this->input->post("filter_status") == "Pending") {
            $where.=" AND status='Submitted' ";
        } elseif ($this->input->post("filter_status") == "Accepted") {
            $where.=" AND (status='Accepted' AND status='Invoiced')";
        } elseif ($this->input->post("filter_status") == "Closed") {
            $where.=" AND status='Closed' ";
        } elseif ($this->input->post("filter_status") == "Rejected") {
            $where.=" AND status='Declined By Customer' ";
        } elseif ($this->input->post("filter_status") == "Expired") {
            $where.=" AND status='Lost' ";
        }
        if ($this->input->post("filter_date") != "All dates") {
            if ($this->input->post("filter_date") == "Last 365 days") {
                $where.=" AND (estimate_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."')";
            } else {
                $where.=" AND (estimate_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."' AND estimate_date <= '".date("Y-m-d", strtotime($this->input->post("filter_date_to")))."')";
            }
        }
        if ($this->input->post("filter_customer") != "all") {
            $where.=" AND customer_id = ".$this->input->post("filter_customer");
        }
        $this->page_data['estimates'] = $this->accounting_invoices_model->get_filtered_estimates($where);

        //scripts for sales_receipts
        $where=" accounting_sales_receipt.company_id =".logged("company_id");
        if ($this->input->post("filter_status") == "Open" || $this->input->post("filter_status") == "All statuses") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        } elseif ($this->input->post("filter_status") == "Overdue") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        } elseif ($this->input->post("filter_status") == "Paid") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        } elseif ($this->input->post("filter_status") == "Pending") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        } elseif ($this->input->post("filter_status") == "Accepted") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        } elseif ($this->input->post("filter_status") == "Closed") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        } elseif ($this->input->post("filter_status") == "Rejected") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        } elseif ($this->input->post("filter_status") == "Expired") {
            $where.=" AND accounting_sales_receipt.status=1 ";
        }
        if ($this->input->post("filter_date") != "All dates") {
            if ($this->input->post("filter_date") == "Last 365 days") {
                $where.=" AND (accounting_sales_receipt.sales_receipt_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."')";
            } else {
                $where.=" AND (accounting_sales_receipt.sales_receipt_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."' AND accounting_sales_receipt.sales_receipt_date <= '".date("Y-m-d", strtotime($this->input->post("filter_date_to")))."')";
            }
        }
        if ($this->input->post("filter_customer") != "all") {
            $where.=" AND accounting_sales_receipt.customer_id = ".$this->input->post("filter_customer");
        }
        $this->page_data['sales_receipts'] = $this->accounting_invoices_model->get_filtered_sales_receipt($where);
        //scripts for credit_memo
        $where=" accounting_credit_memo.company_id =".logged("company_id");
        if ($this->input->post("filter_status") == "Open" || $this->input->post("filter_status") == "All statuses") {
            $where.=" AND accounting_credit_memo.status=1 ";
        } elseif ($this->input->post("filter_status") == "Overdue") {
            $where.=" AND accounting_credit_memo.status=1 ";
        } elseif ($this->input->post("filter_status") == "Paid") {
            $where.=" AND accounting_credit_memo.status=1 ";
        } elseif ($this->input->post("filter_status") == "Pending") {
            $where.=" AND accounting_credit_memo.status=1 ";
        } elseif ($this->input->post("filter_status") == "Accepted") {
            $where.=" AND accounting_credit_memo.status=1 ";
        } elseif ($this->input->post("filter_status") == "Closed") {
            $where.=" AND accounting_credit_memo.status=1 ";
        } elseif ($this->input->post("filter_status") == "Rejected") {
            $where.=" AND accounting_credit_memo.status=1 ";
        } elseif ($this->input->post("filter_status") == "Expired") {
            $where.=" AND accounting_credit_memo.status=1 ";
        }
        if ($this->input->post("filter_date") != "All dates") {
            if ($this->input->post("filter_date") == "Last 365 days") {
                $where.=" AND (accounting_credit_memo.credit_memo_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."')";
            } else {
                $where.=" AND (accounting_credit_memo.credit_memo_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."' AND accounting_credit_memo.credit_memo_date <= '".date("Y-m-d", strtotime($this->input->post("filter_date_to")))."')";
            }
        }
        if ($this->input->post("filter_customer") != "all") {
            $where.=" AND accounting_credit_memo.customer_id = ".$this->input->post("filter_customer");
        }

        $this->page_data['credit_memo'] = $this->accounting_invoices_model->get_filtered_credit_memo($where);


        //scripts for credit_memo
        $where=" accounting_statements.company_id =".logged("company_id");
        if ($this->input->post("filter_status") == "Open" || $this->input->post("filter_status") == "All statuses") {
            $where.=" AND accounting_statements.status=1 ";
        } elseif ($this->input->post("filter_status") == "Overdue") {
            $where.=" AND accounting_statements.status=1 ";
        } elseif ($this->input->post("filter_status") == "Paid") {
            $where.=" AND accounting_statements.status=1 ";
        } elseif ($this->input->post("filter_status") == "Pending") {
            $where.=" AND accounting_statements.status=1 ";
        } elseif ($this->input->post("filter_status") == "Accepted") {
            $where.=" AND accounting_statements.status=1 ";
        } elseif ($this->input->post("filter_status") == "Closed") {
            $where.=" AND accounting_statements.status=1 ";
        } elseif ($this->input->post("filter_status") == "Rejected") {
            $where.=" AND accounting_statements.status=1 ";
        } elseif ($this->input->post("filter_status") == "Expired") {
            $where.=" AND accounting_statements.status=1 ";
        }
        if ($this->input->post("filter_date") != "All dates") {
            if ($this->input->post("filter_date") == "Last 365 days") {
                $where.=" AND (accounting_statements.statement_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."')";
            } else {
                $where.=" AND (accounting_statements.statement_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."' AND accounting_statements.statement_date <= '".date("Y-m-d", strtotime($this->input->post("filter_date_to")))."')";
            }
        }
        if ($this->input->post("filter_customer") != "all") {
            $where.=" AND accounting_statements.customer_id = ".$this->input->post("filter_customer");
        }

        $this->page_data['statements'] = $this->accounting_invoices_model->get_filtered_credit_statements($where);

        //scripts for rpayments
        $where="company_id =".logged("company_id");
        if ($this->input->post("filter_status") == "Open" || $this->input->post("filter_status") == "All statuses") {
            $where.=" AND status=1 ";
        } elseif ($this->input->post("filter_status") == "Overdue") {
            $where.=" AND status=1 ";
        } elseif ($this->input->post("filter_status") == "Paid") {
            $where.=" AND status=1 ";
        } elseif ($this->input->post("filter_status") == "Pending") {
            $where.=" AND status=1 ";
        } elseif ($this->input->post("filter_status") == "Accepted") {
            $where.=" AND status=1 ";
        } elseif ($this->input->post("filter_status") == "Closed") {
            $where.=" AND status=1 ";
        } elseif ($this->input->post("filter_status") == "Rejected") {
            $where.=" AND status=1 ";
        } elseif ($this->input->post("filter_status") == "Expired") {
            $where.=" AND status=1 ";
        }
        if ($this->input->post("filter_date") != "All dates") {
            if ($this->input->post("filter_date") == "Last 365 days") {
                $where.=" AND (payment_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."')";
            } else {
                $where.=" AND (payment_date >= '".date("Y-m-d", strtotime($this->input->post("filter_date_from")))."' AND payment_date <= '".date("Y-m-d", strtotime($this->input->post("filter_date_to")))."')";
            }
        }
        if ($this->input->post("filter_customer") != "all") {
            $where.=" AND customer_id = ".$this->input->post("filter_customer");
        }

        $this->page_data['rpayments'] = $this->accounting_invoices_model->get_filtered_credit_receive_payment($where);


        
        $this->page_data['filter_type']=$this->input->post("filter_type");
        $the_html_tbody.=$this->load->view('accounting/all_sales_includes/all_sales_table_filteres', $this->page_data, true);
        $data = new stdClass();
        $data->the_html_tbody = $the_html_tbody;
        echo json_encode($data);
    }

    public function filter_type_qualified($filter_type, $data)
    {
        if ($filter_type == "All transactions") {
            return true;
        } elseif ($filter_type == "All plus deposits") {
            return true;
        } elseif ($filter_type == "All invoices") {
            if ($data["type"] == "Invoice") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Open invoices") {
            if ($data["status"] == "Open") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Overdue invoices") {
            if ($data["status"] == "Overdue") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Open estimates") {
            if ($data["type"] == "Estimate" && $data["status"] == "Open") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Credit memos") {
            if ($data["type"] == "Credit memo") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Unbilled income") {
            if ($data["type"] == "Estimate" && $data["status"] == "Unbilled") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Recently paid") {
            $firstday = date("Y-m-d", strtotime('monday last week'));
            $lastday = date("Y-m-d", strtotime('sunday this week'));
            if ($data["status"] == "Paid" && $data["date"] >= $firstday && $data["date"] <= $lastday) {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Money received") {
            if ($data["type"] == "Payment") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Recurring templates") {
            if ($data["type"] == "Recurring template") {
                return true;
            } else {
                return false;
            }
        } elseif ($filter_type == "Statements") {
            if ($data["type"] == "Statements") {
                return true;
            } else {
                return false;
            }
        }
    }
    public function invoices_page_filter()
    {
        $the_html_tbody="";
        $status = $this->input->post("status");
        $date_range = $this->input->post("date_range");
        if ($date_range == "This month") {
            $start_date = date("Y-m-01");
            $end_date = date("Y-m-d");
        } elseif ($date_range == "Last month") {
            $start_date = date("Y-m-d", strtotime("first day of previous month"));
            $end_date = date("Y-m-d", strtotime("last day of previous month"));
        } elseif ($date_range == "Last 3 month") {
            $start_date = date("Y-m-d", strtotime("-3 month"));
            $end_date = date("Y-m-d");
        } elseif ($date_range == "Last 6 month") {
            $start_date = date("Y-m-d", strtotime("-6 month"));
            $end_date = date("Y-m-d");
        } elseif ($date_range == "Last 12 month") {
            $start_date = date("Y-m-d", strtotime("-12 month"));
            $end_date = date("Y-m-d");
        } elseif ($date_range == "Year to date") {
            $start_date = date("Y-01-01");
            $end_date = date("Y-m-d");
        } else {
            $start_date = $date_range."-01-01";
            $end_date = $date_range."-12-31";
        }
        if ($status != "All") {
            $status="AND invoices.status = '".$status."'";
        } else {
            $status = "";
        }
        if ($this->input->post("current_tab")!="") {
            $status="AND invoices.status = '".$this->input->post("current_tab")."'";
        }
        $where = " invoices.company_id = ".logged('company_id')." AND invoices.view_flag = 0 AND invoices.voided = 0  AND invoices.date_issued >= '".$start_date."' AND invoices.date_issued <= '".$end_date."' ".$status;
        $this->page_data['invoices'] = $this->accounting_invoices_model->get_filtered_invoices($where);
        $the_html_tbody.=$this->load->view('accounting/invoices_page_includes/invoices_page_table_filteres', $this->page_data, true);
        
        $data = new stdClass();
        
        $status="AND invoices.status = 'Due'";
        $where = " invoices.company_id = ".logged('company_id')." AND invoices.view_flag = 0 AND invoices.voided = 0  AND invoices.date_issued >= '".$start_date."' AND invoices.date_issued <= '".$end_date."' ".$status;
        $data->due_count = count($this->accounting_invoices_model->get_filtered_invoices($where));
        $status="AND invoices.status = 'Overdue'";
        $where = " invoices.company_id = ".logged('company_id')." AND invoices.view_flag = 0 AND invoices.voided = 0  AND invoices.date_issued >= '".$start_date."' AND invoices.date_issued <= '".$end_date."' ".$status;
        $data->overdue_count = count($this->accounting_invoices_model->get_filtered_invoices($where));
        $status="AND invoices.status = 'Partially Paid'";
        $where = " invoices.company_id = ".logged('company_id')." AND invoices.view_flag = 0 AND invoices.voided = 0  AND invoices.date_issued >= '".$start_date."' AND invoices.date_issued <= '".$end_date."' ".$status;
        $data->partially_paid_count = count($this->accounting_invoices_model->get_filtered_invoices($where));
        $status="AND invoices.status = 'Paid'";
        $where = " invoices.company_id = ".logged('company_id')." AND invoices.view_flag = 0 AND invoices.voided = 0  AND invoices.date_issued >= '".$start_date."' AND invoices.date_issued <= '".$end_date."' ".$status;
        $data->paid_count = count($this->accounting_invoices_model->get_filtered_invoices($where));
        $status="AND invoices.status = 'Draft'";
        $where = " invoices.company_id = ".logged('company_id')." AND invoices.view_flag = 0 AND invoices.voided = 0  AND invoices.date_issued >= '".$start_date."' AND invoices.date_issued <= '".$end_date."' ".$status;
        $data->draft_count = count($this->accounting_invoices_model->get_filtered_invoices($where));
        
        $data->the_html_tbody = $the_html_tbody;
        echo json_encode($data);
    }

    public function cashflowPDF()
    {
        $customers       = $this->AcsProfile_model->getAllByCompanyId(logged('company_id'));
        $invoices        = $this->invoice_model->getAllData(logged('company_id'));
        $clients         = $this->invoice_model->getclientsData(logged('company_id'));
        $invoices_sales  = $this->invoice_model->getAllDataSales(logged('company_id'));
        $OpenInvoices    = $this->invoice_model->getAllOpenInvoices(logged('company_id'));
        $InvOverdue      = $this->invoice_model->InvOverdue(logged('company_id'));
        $getAllInvPaid   = $this->invoice_model->getAllInvPaid(logged('company_id'));
        $items           = $this->items_model->getItemlist();
        $packages        = $this->workorder_model->getPackagelist(logged('company_id'));
        $estimates       = $this->estimate_model->getAllByCompanynDraft(logged('company_id'));
        $sales_receipts  = $this->accounting_sales_receipt_model->getAllByCompany(logged('company_id'));
        $credit_memo     = $this->accounting_credit_memo_model->getAllByCompany(logged('company_id'));
        $employees       = $this->users_model->getCompanyUsers(logged('company_id'));
        $statements      = $this->accounting_statements_model->getAllComp(logged('company_id'));
        $rpayments       = $this->accounting_receive_payment_model->getReceivePaymentsByComp(logged('company_id'));
        $checks          = $this->vendors_model->get_check_by_comp(logged('company_id'));
        $expenses        = $this->expenses_model->getExpenseByComp(logged('company_id'));
        $plans           = $this->vendors_model->getcashflowplan(logged('company_id'));


        $data = array(
            'customers'             => $customers,
            'checks'                => $checks,
            'expenses'              => $expenses,
            'clients'               => $clients,
            'sales_receipts'        => $sales_receipts,
            'invoices'              => $invoices,
            'plans'                 => $plans
        );

            
        $filename = "cashflow-report";
        $this->load->library('pdf');
        $this->pdf->load_view('accounting/cashflow_pdf_template', $data, $filename, "portrait");
    }
    public function get_info_for_send_invoice_reminder()
    {
        $invoice_id = $this->input->post("invoice_id");
        $customer_id = $this->input->post("customer_id");
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $user_info = $this->users_model->getUserById(logged("id"));

        $invoice = get_invoice_by_id($invoice_id);
        $user = get_user_by_id(logged('id'));
        $this->page_data['invoice'] = $invoice;
        $this->page_data['user'] = $user;
        // $this->page_data['items'] = $user;
        $this->page_data['items'] = $this->invoice_model->getItemsInv($invoice_id);
        $this->page_data['users'] = $this->invoice_model->getInvoiceCustomer($invoice_id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
        }
        $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
        $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
        $filename = "nSmarTrac_invoice_".$invoice_id.".pdf";
        $this->load->library('pdf');
        $this->pdf->save_pdf('invoice/pdf/template', $this->page_data, $filename, "P");

        $data = new stdClass();
        $data->business_name = $customer_info->business_name;
        $data->business_email = $customer_info->business_email;
        $data->acs_email = $customer_info->acs_email;
        $data->firstname = $customer_info->first_name;
        $data->lastname = $customer_info->last_name;
        $data->user_email = $user_info->email;
        $data->filelocation = base_url("assets/pdf/".$filename."") ;
        echo json_encode($data);
    }
    public function send_invoice_reminder()
    {
        $invoice_id = $this->input->post("invoice_id");
        $to = $this->input->post("to");
        $from = $this->input->post("from");
        $subject = $this->input->post("subject");
        $message = $this->input->post("email-body");
        $cc = $this->input->post("cc");
        $bcc = $this->input->post("bcc");

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        // $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;

        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        $mail->addAttachment(dirname(__DIR__, 2) . '/assets/pdf/' . "nSmarTrac_invoice_".$invoice_id.".pdf");
        $content = $this->load->view('accounting/invoices_page_includes/send_reminder_email_layout', $this->page_data, true);

        $mail->MsgHTML($content);

        $data = new stdClass();
        try {
            $mail->addAddress($to);
            $mail->addAddress('webtestcustomer@nsmartrac.com');
            $bccs = explode(",", $bcc);
            for ($i=0; $i < count($bccs);$i++) {
                if ($bccs[$i]!="") {
                    $mail->addBcc($bccs[$i]);
                }
            }
            $ccs = explode(",", $cc);
            for ($i=0; $i < count($ccs);$i++) {
                if ($ccs[$i]!="") {
                    $mail->addCc($ccs[$i]);
                }
            }
            
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }
        echo json_encode($data);
    }
    public function invoice_print_batch()
    {
        $checkboxes = $this->input->post("checkbox");
        $pdf_data=array();
        for ($i=0;$i<count($checkboxes); $i++) {
            $pdf_sub_data = array();
            $invoice_id = $checkboxes[$i];
            $invoice = get_invoice_by_id($invoice_id);
            $user = get_user_by_id(logged('id'));
            $pdf_sub_data['invoice'] = $invoice;
            $pdf_sub_data['user'] = $user;
            // $this->page_data['items'] = $user;
            $pdf_sub_data['items'] = $this->invoice_model->getItemsInv($invoice_id);
            $pdf_sub_data['users'] = $this->invoice_model->getInvoiceCustomer($invoice_id);

            if (!empty($invoice)) {
                foreach ($invoice as $key => $value) {
                    if (is_serialized($value)) {
                        $invoice->{$key} = unserialize($value);
                    }
                }
                $pdf_sub_data['invoice'] = $invoice;
                $pdf_sub_data['user'] = $user;
            }
            $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
            $pdf_sub_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $pdf_data[$i] = $pdf_sub_data;
        }
        $this->page_data["pdf_data"]=$pdf_data;
        $filename = "nSmarTrac_invoice_batch.pdf";
        $this->load->library('pdf');
        $this->pdf->save_pdf('accounting/invoices_page_includes/pdf_template', $this->page_data, $filename, "P");

        $data = new stdClass();
        $data->filelocation = "assets/pdf/".$filename."";
        echo json_encode($data);
    }
    public function invoice_delete_batch()
    {
        $checkboxes = $this->input->post("checkbox");
        for ($i=0;$i<count($checkboxes);$i++) {
            $invoice_id = $checkboxes[$i];
            $data = array(
                'id' => $invoice_id,
                'view_flag' => '1',
            );
            $this->invoice_model->deleteInvoice($data);
        }
        $data = new stdClass();
        $data->status = "success";
        echo json_encode($data);
    }
    public function invoice_send_batch()
    {
        $checkboxes = $this->input->post("checkbox");
        $errors="";
        if ($this->input->post("action") == "single-invoice") {
            $checkboxes = array($this->input->post("invoice_id"));
        }
        for ($i=0;$i<count($checkboxes);$i++) {
            $invoice_id = $checkboxes[$i];
            $invoice_info = get_invoice_by_id($invoice_id);
            $customer_info = $this->accounting_customers_model->get_customer_by_id($invoice_info->customer_id);
            $user_info = $this->users_model->getUserById(logged("id"));
            $this->create_pdf_for_invoice($invoice_id, $invoice_info->customer_id);
            $subject = "Invoice ".$invoice_info->invoice_number;
            $message = 'Dear ' . $customer_info->first_name . " " . $customer_info->last_name . ',

            We\'re sending you this invoice [' . $invoice_info->invoice_number . ']. 
                            
            Have a great day!
            ' . $customer_info->business_name;
            
            $to = $customer_info->acs_email;
            $from = $customer_info->business_email;
            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            // $from = MAIL_FROM;

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->Host = $server;
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // seconds
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'nSmarTrac';
            $mail->Subject = $subject;

            $this->page_data['message'] = $message;
            $this->page_data['subject'] = $subject;

            $mail->IsHTML(true);
            $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
            $mail->addAttachment(dirname(__DIR__, 2) . '/assets/pdf/' . "nSmarTrac_invoice_".$invoice_id.".pdf");
            $content = $this->load->view('accounting/invoices_page_includes/send_invoice', $this->page_data, true);

            $mail->MsgHTML($content);

            $data = new stdClass();
            try {
                // $mail->addAddress($to);
                $mail->addAddress('webtestcustomer@nsmartrac.com');
                $mail->Send();
                $data->status = "success";
            } catch (Exception $e) {
                $errors = $invoice_info->invoice_number.' Mailer Error: ' . $mail->ErrorInfo;
                $data->status = "error";
            }
        }
        $data->errors=$errors;
        echo json_encode($data);
    }
    public function create_pdf_for_invoice($invoice_id, $customer_id)
    {
        $invoice = get_invoice_by_id($invoice_id);
        $user = get_user_by_id(logged('id'));
        $this->page_data['invoice'] = $invoice;
        $this->page_data['user'] = $user;
        // $this->page_data['items'] = $user;
        $this->page_data['items'] = $this->invoice_model->getItemsInv($invoice_id);
        $this->page_data['users'] = $this->invoice_model->getInvoiceCustomer($invoice_id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
        }
        $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
        $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
        $filename = "nSmarTrac_invoice_".$invoice_id.".pdf";
        $this->load->library('pdf');
        $this->pdf->save_pdf('invoice/pdf/template', $this->page_data, $filename, "P");
    }
    public function invoice_viewer()
    {
        $invoice_id = $this->input->post("invoice_id");
        $customer_id = $this->input->post("customer_id");
        $invoice_info = get_invoice_by_id($invoice_id);
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $invoice_items = $this->invoice_model->getInvoiceItems($invoice_id);
        $html_items_and_price="";
        $html_items_description="";
        foreach ($invoice_items as $items) {
            $html_items_and_price.='<div class="item"><span class="title">'.$items->title.'</span><span class="price">$'.number_format($items->total, 2).'</span></div>';
            if ($items->description!="") {
                if ($html_items_description != "") {
                    $html_items_description.="<br>";
                }
                $html_items_description.=$items->description;
            }
        }
        $invoice_statuses = $this->invoice_model->get_invoice_statuses($invoice_id);
        $received_payments = $this->accounting_receive_payment_model->get_invoice_receive_payment($invoice_id);

        
        $ativities_storage = array();
        $status_from_payment_ctr =0;
        foreach ($invoice_statuses as $info) {
            $ativities_storage[] = array(
                "activity" => "status",
                "status" => $info->status,
                "activity_date" => $info->date_created,
                "activity_time" => strtotime($info->date_created),
                "status_note" => $info->note,
            );
            if ($info->note == "Received payment") {
                $status_from_payment_ctr++;
            }
        }
        foreach ($received_payments as $payment) {
            if ($payment->open_balance <= $payment->payment_amount) {
                $status = "Paid";
            } else {
                $status = "Partially paid";
            }
            $ativities_storage[] = array(
                "activity" => "payment",
                "status" => $status,
                "activity_date" => $payment->date_created,
                "activity_time" => strtotime($payment->date_created),
                "amount"=>$payment->payment_amount,
                "payment_id" => $payment->receive_payment_id,
                "status_note" => "",
            );
        }
        usort($ativities_storage, function ($a, $b) {
            return $a['activity_time'] - $b['activity_time'];
        });

        $status_steps='';
        $ctr=0;
        
        for ($i=0;$i<count($ativities_storage);$i++) {
            if ($ativities_storage[$i]["status_note"] != "Received payment") {
                $status=$ativities_storage[$i]["status"];
                $liner_circle = '<div class="circle default"></div><div class="line"></div>';
                $next_completed="next-completed";
                $ctr++;
                if ($ctr == count($ativities_storage)-$status_from_payment_ctr) {
                    $liner_circle = '<div class="circle default last-active-status"></div>';
                    $next_completed="";
                }
                $status_steps.='
                    <li class="status-step completed">
                        <div class="status-marker completed '.$next_completed.'">
                            '.$liner_circle.'
                        </div>
                        <div class="status-info">
                            <div class="status-title">'.$status.'</div>
                            <div class="status-event-info">
                                <div><span class="status-date">'.date("m/d/Y", strtotime($ativities_storage[$i]["activity_date"])).'</span></div>
                                <div>';
                                
                if ($ativities_storage[$i]["activity"] == "payment") {
                    $status_steps.='<span><span class="money">$'.number_format($ativities_storage[$i]["amount"], 2).'</span></span></div><a tabindex="0"
                                    class="action-button view-payment-button" data-receive-payment-id="'.$ativities_storage[$i]["payment_id"].'" data-customer-id="'.$customer_id.'" data-invoice-id="'.$invoice_id.'">View payment #'.$ativities_storage[$i]["payment_id"].'</a>';
                }
                $status_steps.='</div>
                        </div>
                    </li>';
            }
        }

        // foreach ($received_payments as $payment) {
        //     if ($payment->open_balance <= $payment->payment_amount) {
        //         $status = "Paid";
        //     } else {
        //         $status = "Partially paid";
        //     }
        //     $ctr++;
        //     $liner_circle = '<div class="circle default"></div>
        // <div class="line"></div>';
        //     $next_completed="next-completed";
        //     if ($ctr == count($received_payments)) {
        //         $liner_circle = '<div class="circle default last-active-status"></div>';
        //         $next_completed="";
        //     }
        //     $status_steps.='
        // <li class="status-step completed">
        //     <div class="status-marker completed '.$next_completed.'">
        //         '.$liner_circle.'
        //     </div>
        //     <div class="status-info">
        //         <div class="status-title">'.$status.'</div>
        //         <div class="status-event-info">
        //             <div><span class="status-date">'.date("m/d/Y", strtotime($payment->payment_date)).'</span></div>
        //             <div><span><span class="money">$'.number_format($payment->payment_amount, 2).'</span></span></div><a tabindex="0"
        //                 class="action-button view-payment-button" data-receive-payment-id="'.$payment->receive_payment_id.'" data-customer-id="'.$customer_id.'" data-invoice-id="'.$invoice_id.'">View payment #'.$payment->receive_payment_id.'</a>
        //         </div>
        //     </div>
        // </li>';
        // }
    

        $data = new stdClass();
        $data->customer_name = $customer_info->first_name." ".$customer_info->last_name;
        $data->customer_email = $customer_info->acs_email;
        $data->html_items_and_price = $html_items_and_price;
        $data->html_items_description = $html_items_description;
        $data->memo = $invoice_info->message_to_customer;
        $data->inv_number = $invoice_info->invoice_number;
        $data->status_steps = $status_steps;
        echo json_encode($data);
    }
    public function get_customer_received_payment()
    {
        $customer_id = $this->input->post("customer_id");
        $invoice_id = $this->input->post("invoice_id");
        $receive_payment_id = $this->input->post("receive_payment_id");
        if ($customer_id == "") {
            $customer_id = 0;
        }
        if ($receive_payment_id == "") {
            $receive_payment_id = 0;
        }
        $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($invoice_id);
        $receivable_payment = 0;
        $html = '';
        $counter = 0;
        $customer_id = $inv->customer_id;
        $total_amount_received = 0;

        $payment_received = $this->accounting_invoices_model->get_payements_by_invoice_and_receipt_payment_id($inv->id, $receive_payment_id);
        $total_amount_received += $payment_received->payment_amount;
        $html .= '<tr>
                    <td class="center" style="width: 0;"><input type="checkbox" class="inv_cb" name="inv_cb_' . $counter . '" checked>
                    </td>
                    <td>
                    ' . $inv->invoice_number . '
                    <input type="text" class="hide" name="inv_number_' . $counter . '" value="' . $inv->invoice_number . '">
                    </td>
                    <td>
                    ' . $inv->due_date . '
                    </td>
                    <td class="text-right">' . number_format($inv->grand_total, 2) . '</td>
                    <td class="text-right">
                    ' . number_format($payment_received->open_balance, 2) . '
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="text-right inv_grand_amount" name="inv_' . $counter . '" value="' . number_format($total_amount_received, 2) . '">
                        </div>
                    </td>
                </tr>';
        $counter++;
        $receivable_payment += $total_amount_received;
            


        $file_names = explode(",", $payment_received->attachments);
        $images="";
        for ($i =0; $i < count($file_names); $i++) {
            if ($file_names[$i]!="") {
                $images.='<img src="'.base_url("uploads/accounting/attachments/final-attachments/". $file_names[$i]).'">';
            }
        }
        $data = new stdClass();
        $data->html = $html;
        $data->receivable_payment = $receivable_payment;
        $data->display_receivable_payment = number_format($receivable_payment, 2);
        $data->inv_count = $counter;
        $data->payment_date = date("d/m/Y", strtotime($payment_received->payment_date));
        $data->ref_no = $payment_received->ref_no;
        $data->payment_method = $payment_received->payment_method;
        $data->deposit_to = $payment_received->deposit_to;
        $data->memo = $payment_received->memo;
        $data->attachments = $payment_received->attachments;
        $data->attachments_images = $images;
        echo json_encode($data);
    }

    public function savecashflowplan()
    {
        $date_plan      = $this->input->post("date_plan");
        $merchant_name  = $this->input->post("merchant_name");
        $plan_amount    = $this->input->post("plan_amount");
        $plan_type      = $this->input->post("plan_type");
        $plan_repeat    = $this->input->post("plan_repeat");

        $new_data = array(
            'date_plan'     => $date_plan,
            'merchant_name' => $merchant_name,
            'amount'        => $plan_amount,
            'type'          => $plan_type,
            'description'   => 'Planned',
            'repeating'     => $plan_repeat,
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        );

        $addQuery = $this->vendors_model->savecashflowplan($new_data);

        // if ($addQuery > 0) {
           
        // }

        $data = 'Success';

        echo json_encode($data);
    }

    public function updateOverdueCashflow()
    {
        $overId         = $this->input->post("overId");
        $overdate       = $this->input->post("overdate");
        $overtotal      = $this->input->post("overtotal");

        $new_data = array(
            'id'            => $overId,
            'due_date'      => $overdate,
            'grand_total'   => $overtotal,
        );

        $addQuery = $this->invoice_model->updateOverDueInv($new_data);

        // if ($addQuery > 0) {
           
        // }

        $data = 'Success';

        echo json_encode($data);
    }

    public function cashflowDataJson()
    {
        $invoices        = $this->invoice_model->getAllData2(logged('company_id'));
        // $response['price'] = $invoices;
        // echo json_encode($response,TRUE);

        $test = '{
            "price_usd": [
              [
                1637275269000,
                972.948
              ],
              [
                1637361668000,
                1025.88
              ],
              [
                1637448068000,
                1030.47
              ],
              [
                1637534467000,
                1100.52
              ],
              [
                1637620867000,
                1032.94
              ],
              [
                1637707266000,
                892.194
              ],
              [
                1637793667000,
                892.342
              ],
              [
                1637880069000,
                911.99
              ],
              [
                1637966467000,
                907.185
              ],
              [
                1637052867000,
                908.901
              ],
              [
                1637139267000,
                818.048
              ],
              [
                1637225688000,
                767.149
              ],
              [
                1637312369000,
                796.407
              ],
              [
                1637398766000,
                833.934
              ],
              [
                1637485168000,
                821.69
              ],
              [
                1637571566000,
                826.108
              ],
              [
                1637657968000,
                886.754
              ],
              [
                1637744368000,
                899.644
              ],
              [
                1637830768000,
                891.014
              ],
              [
                1637917166000,
                891.942
              ],
              [
                1637003569000,
                926.034
              ],
              [
                1637089968000,
                909.04
              ],
              [
                1637176365000,
                923.955
              ],
              [
                1637262769000,
                907.879
              ],
              [
                1637349165000,
                900.2
              ],
              [
                1637435567000,
                907.819
              ],
              [
                1637521968000,
                920.339
              ],
              [
                1637608969000,
                922.994
              ],
              [
                1637695366000,
                922.58
              ],
              [
                1637692760000,
                13411
              ]
            ]
          }';

        // echo $test;

        $temp = [];
        foreach ($invoices as $key1 => $value1) {
            foreach ($value1 as $key2 => $value2) {
                switch ($key2) {
                    case 'date_issued':
                        $temp[$key1][] = strtotime($value2);
                    break;
                    case 'grand_total':
                        $temp[$key1][] = floatval($value2);
                    break;
                    default:
                    break;
                }
            }
        }
        $response['price'] = $temp;
        echo json_encode($response, true);
    }

    public function employee_payscale($id)
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['roles'] = $this->vendors_model->getRoles(logged('company_id'));
        $this->page_data['employee'] = $this->vendors_model->getEmployeeByID($id);
        $this->load->view('accounting/employee_payscale', $this->page_data);
    }

    public function save_role()
    {
        $role_name      = $this->input->post("role_name");
        $role_amount    = $this->input->post("role_amount");
        

        $new_data = array(
            // 'role_name'     => $role_name,
            'title'         => $role_name,
            'role_amount'   => $role_amount,
            'company_id'    => logged('company_id'),
            'created_at'    => date("Y-m-d H:i:s")
        );

        $addQuery = $this->vendors_model->save_role($new_data);

        // if ($addQuery > 0) {
           
        // }

        $data = 'Success';

        echo json_encode($data);
    }

    public function get_role_amount()
    {
        $roleID      = $this->input->post("roleID");

        $this->page_data['roles'] = $this->vendors_model->getRoleAmount($roleID);

        echo json_encode($this->page_data);
    }

    public function banking_export()
    {
        $comp_id = logged('company_id');
        $get_company_banking_payment = array(
            'table' => 'banking_payments',
            'where' => array('company_id' => $comp_id,),
            'select' => '*',
        );
        $banking_payments = $this->general_model->get_data_with_param($get_company_banking_payment);

        $delimiter = ",";
        $time      = time();
        $filename  = "banking_payments".$time.".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Date Paid', 'Description', 'Payee', 'Amount', 'Assign To');
        fputcsv($f, $fields, $delimiter);

        if (!empty($banking_payments)) {
            foreach ($banking_payments as $item) {
                $csvData = array(
                    date_format(date_create($item->date_paid), "m/d/Y"),
                    $item->description,
                    $item->payee,
                    number_format($item->amount,2),
                    $item->assign_to
                );
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }
}

// date_plan: date_plan, merchant_name:merchant_name, plan_amount:plan_amount, plan_type:plan_type, plan_repeat:plan_repeat
