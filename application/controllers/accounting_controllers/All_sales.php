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
        $this->load->model('accounting_refund_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_delayed_credit_model');
        $this->load->model('accounting_delayed_charge_model');
        $this->load->model('accounting_statements_model');

        $this->page_data['page']->title = 'Sales Transactions';
        $this->page_data['page']->parent = 'Sales';

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

        if(!empty(get('customer'))) {
            $filters['customer_id'] = get('customer');
            $this->page_data['customer'] = new stdClass();
            $this->page_data['customer']->id = get('customer');
            $customer = $this->accounting_customers_model->get_by_id(get('customer'));
            $customerName = $customer->first_name . ' ' . $customer->last_name;
            $this->page_data['customer']->name = $customerName;
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
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                <label for="chk_po_number" class="form-check-label">P.O. Number</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
            </div>'
        ];

        switch($filters['type']) {
            default :
                $transactions = $this->get_invoices($transactions, $filters);
                $transactions = $this->get_credit_memos($transactions, $filters);
                $transactions = $this->get_sales_receipts($transactions, $filters);
                $transactions = $this->get_refund_receipts($transactions, $filters);
                $transactions = $this->get_delayed_credits($transactions, $filters);
                $transactions = $this->get_delayed_charges($transactions, $filters);
                $transactions = $this->get_estimates($transactions, $filters);
                $transactions = $this->get_payments($transactions, $filters);
                $transactions = $this->get_billable_expenses($transactions, $filters);
            break;
            case 'estimates' :
                $headers = [
                    '<td data-name="Date">DATE</td>',
                    '<td data-name="Type">TYPE</td>',
                    '<td data-name="No.">NO.</td>',
                    '<td data-name="Customer">CUSTOMER</td>',
                    '<td data-name="Memo">MEMO</td>',
                    '<td data-name="Expiration Date">EXPIRATION DATE</td>',
                    '<td data-name="Total">TOTAL</td>',
                    '<td data-name="Last Delivered">LAST DELIVERED</td>',
                    '<td data-name="Email">EMAIL</td>',
                    '<td data-name="Accepted Date">ACCEPTED DATE</td>',
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
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_expiration_date" class="form-check-input">
                        <label for="chk_expiration_date" class="form-check-label">Expiration Date</label>
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
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_acccepted_date" class="form-check-input">
                        <label for="chk_acccepted_date" class="form-check-label">Accepted Date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                        <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                        <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                    </div>'
                ];

                $transactions = $this->get_estimates($transactions, $filters);
            break;
            case 'invoices' :
                $headers = [
                    '<td data-name="Date">DATE</td>',
                    '<td data-name="Type">TYPE</td>',
                    '<td data-name="No.">NO.</td>',
                    '<td data-name="Customer">CUSTOMER</td>',
                    '<td data-name="Memo">MEMO</td>',
                    '<td data-name="Due Date">DUE DATE</td>',
                    '<td data-name="Total">TOTAL</td>',
                    '<td data-name="Last Delivered">LAST DELIVERED</td>',
                    '<td data-name="Email">EMAIL</td>',
                    '<td data-name="Accepted Date">ACCEPTED DATE</td>',
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
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                        <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                        <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                    </div>'
                ];

                $transactions = $this->get_invoices($transactions, $filters);
            break;
            case 'sales-receipts' :
                $transactions = $this->get_sales_receipts($transactions, $filters);
            break;
            case 'credit-memos' :
                $transactions = $this->get_credit_memos($transactions, $filters);
            break;
            case 'unbilled-income' :
                $transactions = $this->get_unbilled_incomes($transactions, $filters);
            break;
            case 'recently-paid' :
                $transactions = $this->get_recently_paid_invoices($transactions, $filters);
            break;
            case 'money-received' :
                $transactions = $this->get_payments($transactions, $filters);
            break;
            case 'statements' :

            break;
        }

        if(isset($filters['start-date']) && $filters['type'] !== 'unbilled-income') {
            $transactions = array_filter($transactions, function($v, $k) use ($filters) {
                return strtotime($v['date']) >= strtotime($filters['start-date']) && strtotime($v['date']) <= strtotime($filters['end-date']);
            }, ARRAY_FILTER_USE_BOTH);
        }

        if(isset($filters['customer_id'])) {
            $transactions = array_filter($transactions, function($v, $k) use ($filters) {
                return $filters['customer_id'] === $v['customer_id'];
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

    private function get_invoices($transactions, $filters = [])
    {
        $invoices = $this->invoice_model->get_all_company_invoice(logged('company_id'));
        
        foreach($invoices as $invoice)
        {
            $customer = $this->accounting_customers_model->get_by_id($invoice->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-invoice' href='/invoice/preview/$invoice->id?format=print' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-invoice' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-invoice' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item delete-invoice' href='#'>Delete</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-invoice' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            $flag = true;
            switch($filters['status']) {
                case 'open' :
                    if(in_array($invoice->status, ['Draft', 'Declined', 'Paid'])) {
                        $flag = false;
                    }
                break;
                case 'overdue' :
                    if(in_array($invoice->status, ['Draft', 'Declined', 'Paid'])) {
                        $flag = false;
                    } else {
                        if(strtotime($invoice->due_date) > strtotime(date("m/d/Y"))) {
                            $flag = false;
                        }
                    }
                break;
                case 'paid' :
                    if($invoice->status !== 'Paid' || floatval($invoice->balance) > 0.00) {
                        $flag = false;
                    }
                break;
            }

            if($flag) {
                $transactions[] = [
                    'id' => $invoice->id,
                    'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                    'type' => 'Invoice',
                    'no' => $invoice->invoice_number,
                    'customer' => $customerName,
                    'customer_id' => $invoice->customer_id,
                    'method' => '',
                    'source' => '',
                    'memo' => $invoice->message_on_invoice,
                    'due_date' => date("m/d/Y", strtotime($invoice->due_date)),
                    'aging' => '',
                    'balance' => number_format(floatval(str_replace(',', '', $invoice->balance)), 2, '.', ','),
                    'total' => number_format(floatval(str_replace(',', '', $invoice->grand_total)), 2, '.', ','),
                    'last_delivered' => '',
                    'email' => $invoice->customer_email,
                    'attachments' => '',
                    'status' => $invoice->status,
                    'po_number' => '',
                    'sales_rep' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($invoice->date_created)),
                    'manage' => $manageCol
                ];
            }
        }

        return $transactions;
    }

    private function get_credit_memos($transactions, $filters = [])
    {
        $creditMemos = $this->accounting_credit_memo_model->get_company_credit_memos(['company_id' => logged('company_id')]);

        foreach($creditMemos as $creditMemo)
        {
            $customer = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-credit-memo' href='/accounting/customers/print-transaction/credit-memo/$creditMemo->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-credit-memo' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-credit-memo' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-credit-memo' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            if($filters['type'] === 'open-invoices' && floatval($creditMemo->balance) > 0 || $filters['type'] !== 'open-invoices') {
                $transactions[] = [
                    'id' => $creditMemo->id,
                    'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                    'type' => 'Credit Memo',
                    'no' => $creditMemo->ref_no,
                    'customer' => $customerName,
                    'customer_id' => $creditMemo->customer_id,
                    'method' => '',
                    'source' => '',
                    'memo' => $creditMemo->message_credit_memo,
                    'due_date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                    'aging' => '',
                    'balance' => number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2, '.', ','),
                    'total' => number_format(floatval(str_replace(',', '', $creditMemo->total_amount)), 2, '.', ','),
                    'last_delivered' => '',
                    'email' => $creditMemo->email,
                    'attachments' => '',
                    'status' => floatval($creditMemo->balance) > 0 ? 'Unapplied' : 'Applied',
                    'po_number' => '',
                    'sales_rep' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($creditMemo->created_at)),
                    'manage' => $manageCol
                ];
            }
        }

        return $transactions;
    }

    private function get_sales_receipts($transactions, $filters = [])
    {
        $salesReceipts = $this->accounting_sales_receipt_model->get_all_by_company_id(logged('company_id'));

        foreach($salesReceipts as $salesReceipt)
        {
            $customer = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-sales-receipt' href='/accounting/customers/print-transaction/sales-receipt/$salesReceipt->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-sales-receipt' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-sales-receipt' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item delete-sales-receipt' href='#'>Delete</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-sales-receipt' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            $transactions[] = [
                'id' => $salesReceipt->id,
                'date' => date("m/d/Y", strtotime($salesReceipt->sales_receipt_date)),
                'type' => 'Sales Receipt',
                'no' => $salesReceipt->ref_no,
                'customer' => $customerName,
                'customer_id' => $salesReceipt->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $salesReceipt->message_sales_receipt,
                'due_date' => '',
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $salesReceipt->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $salesReceipt->email,
                'attachments' => '',
                'status' => 'Paid',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($salesReceipt->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_refund_receipts($transactions, $filters = [])
    {
        $refundReceipts = $this->accounting_refund_receipt_model->get_company_refund_receipts(['company_id' => logged('company_id')]);

        foreach($refundReceipts as $refundReceipt)
        {
            $customer = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-refund-receipt-check' href='#'>Print check</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-refund-receipt' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item print-refund-receipt' href='/accounting/customers/print-transaction/refund-receipt/$refundReceipt->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-refund-receipt' href='#'>View/Edit</a>
                    </li>
                </ul>
            </div>";

            $transactions[] = [
                'id' => $refundReceipt->id,
                'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                'type' => 'Refund',
                'no' => $refundReceipt->ref_no,
                'customer' => $customerName,
                'customer_id' => $refundReceipt->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $refundReceipt->message_refund_receipt,
                'due_date' => '',
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $refundReceipt->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $refundReceipt->email,
                'attachments' => '',
                'status' => 'Paid',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($refundReceipt->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_delayed_credits($transactions, $filters = [])
    {
        $delayedCredits = $this->accounting_delayed_credit_model->get_company_delayed_credits(['company_id' => logged('company_id')]);

        foreach($delayedCredits as $delayedCredit)
        {
            $customer = $this->accounting_customers_model->get_by_id($delayedCredit->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-delayed-credit" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $delayedCredit->id,
                'date' => date("m/d/Y", strtotime($delayedCredit->delayed_credit_date)),
                'type' => 'Credit',
                'no' => $delayedCredit->ref_no,
                'customer' => $customerName,
                'customer_id' => $delayedCredit->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $delayedCredit->memo,
                'due_date' => date("m/d/Y", strtotime($delayedCredit->delayed_credit_date)),
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $delayedCredit->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => '',
                'attachments' => '',
                'status' => floatval($delayedCredit->remaining_balance) > 0 ? 'Open' : 'Closed',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($delayedCredit->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_delayed_charges($transactions, $filters = [])
    {
        $delayedCharges = $this->accounting_delayed_charge_model->get_company_delayed_charges(['company_id' => logged('company_id')]);

        foreach($delayedCharges as $delayedCharge)
        {
            $customer = $this->accounting_customers_model->get_by_id($delayedCharge->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-delayed-charge" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $delayedCharge->id,
                'date' => date("m/d/Y", strtotime($delayedCharge->delayed_charge_date)),
                'type' => 'Charge',
                'no' => $delayedCharge->ref_no,
                'customer' => $customerName,
                'customer_id' => $delayedCharge->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $delayedCharge->memo,
                'due_date' => date("m/d/Y", strtotime($delayedCharge->delayed_charge_date)),
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $delayedCharge->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => '',
                'attachments' => '',
                'status' => floatval($delayedCharge->remaining_balance) > 0 ? 'Open' : 'Closed',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($delayedCharge->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_estimates($transactions, $filters = [])
    {
        $estimates = $this->estimate_model->getAllByCompany(logged('company_id'));

        foreach($estimates as $estimate)
        {
            $customer = $this->accounting_customers_model->get_by_id($estimate->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item create-invoice' href='#'>Create invoice</a>
                    </li>
                    <li>
                        <a class='dropdown-item print-estimate' href='/estimate/print/$estimate->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-estimate' href='#' acs-id='$estimate->customer_id' est-id='$estimate->id'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item update-estimate-status' href='#'>Update status</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-estimate' href='#'>View/Edit</a>
                    </li>
                </ul>
            </div>";

            $total1 = ((float)$estimate->option1_total) + ((float)$estimate->option2_total);
            $total2 = ((float)$estimate->bundle1_total) + ((float)$estimate->bundle2_total);

            if ($estimate->estimate_type == 'Option') {
                $grandTotal = $total1;
            } elseif ($estimate->estimate_type == 'Bundle') {
                $grandTotal = $total2;
            } else {
                $grandTotal = $estimate->grand_total;
            }

            $flag = true;
            switch($filters['status']) {
                case 'open' :
                    if(in_array($estimate->status, ['Invoiced', 'Lost', 'Declined By Customer'])) {
                        $flag = false;
                    }
                break;
                case 'closed' :
                    if(in_array($estimate->status, ['Draft', 'Submitted', 'Accepted'])) {
                        $flag = false;
                    }
                break;
                case 'draft' :
                    if($estimate->status !== 'Draft') {
                        $flag = false;
                    }
                break;
                case 'submitted' :
                    if($estimate->status !== 'Submitted') {
                        $flag = false;
                    }
                break;
                case 'accepted' :
                    if($estimate->status !== 'Accepted') {
                        $flag = false;
                    }
                break;
                case 'invoiced' :
                    if($estimate->status !== 'Invoiced') {
                        $flag = false;
                    }
                break;
                case 'lost' :
                    if($estimate->status !== 'Lost') {
                        $flag = false;
                    }
                break;
                case 'declined-by-customer' :
                    if($estimate->status !== 'Declined By Customer') {
                        $flag = false;
                    }
                break;
                case 'expired' :
                    if(in_array($estimate->status, ['Invoiced', 'Lost', 'Declined By Customer']) || !in_array($estimate->status, ['Invoiced', 'Lost', 'Declined By Customer']) && strtotime($estimate->expiry_date) > strtotime(date('m/d/Y'))) {
                        $flag = false;
                    }
                break;
            }

            if($flag) {
                if($filters['type'] === 'estimates') {
                    $transactions[] = [
                        'id' => $estimate->id,
                        'date' => date("m/d/Y", strtotime($estimate->estimate_date)),
                        'type' => 'Estimate',
                        'no' => $estimate->estimate_number,
                        'customer' => $customerName,
                        'customer_id' => $estimate->customer_id,
                        'memo' => $estimate->customer_message,
                        'expiration_date' => date("m/d/Y", strtotime($estimate->expiry_date)),
                        'total' => number_format(floatval(str_replace(',', '', $grandTotal)), 2, '.', ','),
                        'last_delivered' => '',
                        'email' => '',
                        'accepted_date' => !empty($estimate->accepted_date) && in_array($estimate->status, ['Accepted', 'Invoiced']) ? date("m/d/Y", strtotime($estimate->accepted_date)) : '',
                        'attachments' => '',
                        'status' => $estimate->status,
                        'po_number' => '',
                        'sales_rep' => '',
                        'date_created' => date("m/d/Y H:i:s", strtotime($estimate->created_at)),
                        'manage' => $manageCol
                    ];
                } else {
                    $transactions[] = [
                        'id' => $estimate->id,
                        'date' => date("m/d/Y", strtotime($estimate->estimate_date)),
                        'type' => 'Estimate',
                        'no' => $estimate->estimate_number,
                        'customer' => $customerName,
                        'customer_id' => $estimate->customer_id,
                        'method' => '',
                        'source' => '',
                        'memo' => $estimate->customer_message,
                        'due_date' => date("m/d/Y", strtotime($estimate->expiry_date)),
                        'aging' => '',
                        'balance' => '0.00',
                        'total' => number_format(floatval(str_replace(',', '', $grandTotal)), 2, '.', ','),
                        'last_delivered' => '',
                        'email' => '',
                        'attachments' => '',
                        'status' => $estimate->status,
                        'po_number' => '',
                        'sales_rep' => '',
                        'date_created' => date("m/d/Y H:i:s", strtotime($estimate->created_at)),
                        'manage' => $manageCol
                    ];
                }
            }
        }

        return $transactions;
    }

    private function get_payments($transactions, $filters = [])
    {
        $payments = $this->accounting_receive_payment_model->get_company_receive_payments(['company_id' => logged('company_id')]);

        foreach($payments as $payment)
        {
            $customer = $this->accounting_customers_model->get_by_id($payment->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item view-edit-payment" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $payment->id,
                'date' => date("m/d/Y", strtotime($payment->payment_date)),
                'type' => 'Payment',
                'no' => $payment->ref_no,
                'customer' => $customerName,
                'customer_id' => $payment->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $payment->memo,
                'due_date' => date("m/d/Y", strtotime($payment->payment_date)),
                'aging' => '',
                'balance' => '0.00',
                'total' => '-'.number_format(floatval(str_replace(',', '', $payment->amount_received)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $customer->email,
                'attachments' => '',
                'status' => 'Closed',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($payment->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_billable_expenses($transactions, $filters = [])
    {
        $billableExpenses = $this->accounting_customers_model->get_company_billable_expenses(logged('company_id'));

        foreach($billableExpenses as $billableExpense)
        {
            $customer = $this->accounting_customers_model->get_by_id($billableExpense->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-billable-expense" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            switch($billableExpense->transaction_type) {
                case 'Expense' :
                    $expense = $this->vendors_model->get_expense_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($expense->payment_date));
                break;
                case 'Check' :
                    $check = $this->vendors_model->get_check_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($check->payment_date));
                break;
                case 'Bill' :
                    $bill = $this->vendors_model->get_bill_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($bill->bill_date));
                break;
                case 'Vendor Credit' :
                    $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($vendorCredit->payment_date));
                break;
                case 'Credit Card Credit' :
                    $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($ccCredit->payment_date));
                break;
            }

            $transactions[] = [
                'id' => $billableExpense->id,
                'date' => $date,
                'type' => 'Billable Expense Charge',
                'no' => '',
                'customer' => $customerName,
                'customer_id' => $billableExpense->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $billableExpense->description,
                'due_date' => $date,
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $billableExpense->amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => '',
                'attachments' => '',
                'status' => floatval($billableExpense->received) > 0 ? 'Closed' : 'Open',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($billableExpense->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_unbilled_incomes($transactions, $filters = [])
    {
        $delayedCredits = $this->accounting_delayed_credit_model->get_company_delayed_credits(['company_id' => logged('company_id')]);
        $delayedCharges = $this->accounting_delayed_charge_model->get_company_delayed_charges(['company_id' => logged('company_id')]);
        $billableExpenses = $this->accounting_customers_model->get_company_billable_expenses(logged('company_id'));

        foreach($delayedCredits as $credit)
        {
            $customer = $this->accounting_customers_model->get_by_id($credit->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            if($credit->status === '1' && strtotime($credit->delayed_credit_date) <= strtotime($filters['start-date'])) {
                $transactions[] = [
                    'id' => $credit->id,
                    'date' => date("m/d/Y", strtotime($credit->delayed_credit_date)),
                    'type' => 'Credit',
                    'no' => $credit->ref_no,
                    'customer' => $customerName,
                    'customer_id' => $credit->customer_id,
                    'memo' => $credit->memo,
                    'total' => number_format(floatval(str_replace(',', '', $credit->total_amount)), 2, '.', ','),
                    'attachments' => '',
                    'status' => floatval($credit->remaining_balance) > 0 ? 'Open' : 'Closed'
                ];
            }
        }

        foreach($delayedCharges as $charge)
        {
            $customer = $this->accounting_customers_model->get_by_id($charge->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            if($charge->status === '1' && strtotime($charge->delayed_charge_date) <= strtotime($filters['start-date'])) {
                $transactions[] = [
                    'id' => $charge->id,
                    'date' => date("m/d/Y", strtotime($charge->delayed_charge_date)),
                    'type' => 'Charge',
                    'no' => $charge->ref_no,
                    'customer' => $customerName,
                    'customer_id' => $charge->customer_id,
                    'memo' => $charge->memo,
                    'total' => number_format(floatval(str_replace(',', '', $charge->total_amount)), 2, '.', ','),
                    'attachments' => '',
                    'status' => floatval($charge->remaining_balance) > 0 ? 'Open' : 'Closed'
                ];
            }
        }

        foreach($billableExpenses as $billableExpense)
        {
            $customer = $this->accounting_customers_model->get_by_id($billableExpense->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            switch($billableExpense->transaction_type) {
                case 'Expense' :
                    $expense = $this->vendors_model->get_expense_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($expense->payment_date));
                break;
                case 'Check' :
                    $check = $this->vendors_model->get_check_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($check->payment_date));
                break;
                case 'Bill' :
                    $bill = $this->vendors_model->get_bill_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($bill->bill_date));
                break;
                case 'Vendor Credit' :
                    $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($vendorCredit->payment_date));
                break;
                case 'Credit Card Credit' :
                    $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($ccCredit->payment_date));
                break;
            }

            $transactions[] = [
                'id' => $billableExpense->id,
                'date' => $date,
                'type' => 'Billable Expense Charge',
                'no' => '',
                'customer' => $customerName,
                'customer_id' => $billableExpense->customer_id,
                'memo' => $billableExpense->description,
                'total' => number_format(floatval(str_replace(',', '', $billableExpense->amount)), 2, '.', ','),
                'attachments' => '',
                'status' => floatval($billableExpense->received) > 0 ? 'Closed' : 'Open'
            ];
        }

        return $transactions;
    }

    private function get_recently_paid_invoices($transactions, $filters = [])
    {
        $payments = $this->invoice_model->get_company_payments(logged('company_id'));

        foreach($payments as $payment)
        {
            $customer = $this->accounting_customers_model->get_by_id($payment->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $invoice = $this->invoice_model->get_invoice_by_invoice_number($payment->invoice_number, logged('company_id'));

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-invoice' href='/invoice/preview/$invoice->id?format=print' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-invoice' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-invoice' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item delete-invoice' href='#'>Delete</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-invoice' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            $transactions[] = [
                'id' => $invoice->id,
                'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                'type' => 'Invoice',
                'no' => $invoice->invoice_number,
                'customer' => $customerName,
                'customer_id' => $invoice->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $invoice->message_on_invoice,
                'due_date' => date("m/d/Y", strtotime($invoice->due_date)),
                'aging' => '',
                'balance' => number_format(floatval(str_replace(',', '', $invoice->balance)), 2, '.', ','),
                'total' => number_format(floatval(str_replace(',', '', $invoice->grand_total)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $invoice->customer_email,
                'latest_payment' => date("m/d/Y", strtotime($payment->payment_date)),
                'attachments' => '',
                'status' => $invoice->INV_status,
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($invoice->date_created)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }
}