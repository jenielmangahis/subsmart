<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_sales extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');

        $this->page_data['page']->title = 'Sales Transactions';
        $this->page_data['page']->parent = 'Sales';

        add_css(array(
            // "assets/css/accounting/banking.css?v='rand()'",
            // "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
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

    public function index()
    {
        add_footer_js(array(
            "assets/js/v2/accounting/sales/all_sales/list.js"
        ));

        if(!empty(get('transaction'))) {
            $this->page_data['transaction'] = get('transaction');
        }

        $filters = [];
        if(!empty(get('type'))) {
            $filters['type'] = get('type');
            $this->page_data['type'] = get('type');
        }

        if(!empty(get('status'))) {
            $filters['status'] = get('status');
            $this->page_data['status'] = get('status');
        }

        if(!empty(get('delivery-method'))) {
            $filters['delivery_method'] = get('delivery-method');
            $this->page_data['delivery_method'] = get('delivery-method');
        }

        if(!empty(get('delivery-method'))) {
            $filters['delivery_method'] = get('delivery-method');
            $this->page_data['delivery_method'] = get('delivery-method');
        }

        if(!empty(get('date'))) {
            if($filters['type'] !== 'unbilled-income') {
                $filters['start-date'] = date("Y-m-d", strtotime(get('from')));
                $filters['end-date'] = date("Y-m-d", strtotime(get('to')));

                $this->page_data['from_date'] = date('m/d/Y', strtotime(get('from')));
                $this->page_data['to_date'] = date('m/d/Y', strtotime(get('to')));
            } else {
                $filters['start-date'] = date("Y-m-d", strtotime(str_replace('-', '/', get('date'))));
            }

            $this->page_data['date'] = get('date');
        }

        $get = $this->get_transactions($filters);

        $this->page_data['transactions'] = $get['transactions'];
        $this->page_data['headers'] = $get['headers'];
        $this->page_data['settingsCols'] = $get['settingsCols'];
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/sales/all_sales', $this->page_data);
    }

    private function get_transactions($filters = [])
    {
        $transactions = [];

        $headers = [
            '<td data-name="Date">DATE</td>',
            '<td data-name="Type">TYPE</td>',
            '<td data-name="No.">NO.</td>',
            '<td data-name="Customer">CUSTOMER</td>',
            '<td data-name="Method">METHOD</td>',
            '<td data-name="Source">SOURCE</td>',
            '<td data-name="Memo">MEMO</td>',
            '<td data-name="Due date">DUE DATE</td>',
            '<td data-name="Aging">AGING</td>',
            '<td data-name="Balance">BALANCE</td>',
            '<td data-name="Total">TOTAL</td>',
            '<td data-name="Last Delivered">LAST DELIVERED</td>',
            '<td data-name="Email">EMAIL</td>',
            '<td class="table-icon text-center" data-name="Attachments"><i class="bx bx-paperclip"></i></td>',
            '<td data-name="Status">STATUS</td>',
            '<td data-name="P.O. Number">P.O. NUMBER</td>',
            '<td data-name="Sales Rep">SALES REP</td>',
        ];

        $settingsCols = [
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                <label for="chk_type" class="form-check-label">Type</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                <label for="chk_no" class="form-check-label">No.</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                <label for="chk_customer" class="form-check-label">Customer</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_method" class="form-check-input">
                <label for="chk_method" class="form-check-label">Method</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_source" class="form-check-input">
                <label for="chk_source" class="form-check-label">Source</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                <label for="chk_memo" class="form-check-label">Memo</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                <label for="chk_due_date" class="form-check-label">Due date</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_aging" class="form-check-input">
                <label for="chk_aging" class="form-check-label">Aging</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                <label for="chk_balance" class="form-check-label">Balance</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                <label for="chk_email" class="form-check-label">Email</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                <label for="chk_attachments" class="form-check-label">Attachments</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                <label for="chk_status" class="form-check-label">Status</label>
            </div>'
        ];

        switch($filters['type']) {
            default :
                // $transactions = $this->get_invoices($transactions, $filters);
                // $transactions = $this->get_credit_memos($transactions, $filters);
                // $transactions = $this->get_sales_receipts($transactions, $filters);
                // $transactions = $this->get_refund_receipts($transactions, $filters);
                // $transactions = $this->get_delayed_credits($transactions, $filters);
                // $transactions = $this->get_delayed_charges($transactions, $filters);
                // $transactions = $this->get_estimates($transactions, $filters);
                // $transactions = $this->get_payments($transactions, $filters);
                // $transactions = $this->get_billable_expenses($transactions, $filters);
            break;
        }

        if(isset($filters['start-date']) && $filters['type'] !== 'unbilled-income') {
            $transactions = array_filter($transactions, function($v, $k) use ($filters) {
                return strtotime($v['date']) >= strtotime($filters['start-date']) && strtotime($v['date']) <= strtotime($filters['end-date']);
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($transactions, function($a, $b) {
            if($a['date'] === $b['date']) {
                return strtotime($b['date_created']) > strtotime($a['date_created']);
            }
            return strtotime($b['date']) > strtotime($a['date']);
        });

        return [
            'transactions' => $transactions,
            'headers' => $headers,
            'settingsCols' => $settingsCols
        ];
    }
}