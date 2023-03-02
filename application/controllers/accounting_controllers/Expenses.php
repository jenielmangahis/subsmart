<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expenses extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('expenses_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('vendors_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('items_model');
        $this->load->model('accounting_invoices_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('tags_model');

        $this->page_data['page']->title = 'Expenses';
        $this->page_data['page']->parent = 'Expenses';

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
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/expenses/expenses/list.js"
        ));

        $filters = [
            'company_id' => logged('company_id'),
            'type' => 'all-transactions',
            'delivery_method' => 'any',
            'category' => 'all',
            'start-date' => date("Y-m-d", strtotime(date("m/d/Y")." -365 days")),
            'end-date' => date("Y-m-d")
        ];

        $this->page_data['transactions'] = $this->get_transactions($filters);
        $this->page_data['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['unlinked_attachments'] = $this->accounting_attachments_model->get_unlinked_attachments();
        $this->page_data['page_title'] = "Expenses";
        $this->load->view('v2/pages/accounting/expenses/expenses/list', $this->page_data);
    }

    private function get_category_accs()
    {
        $categoryAccs = [];
        $accountTypes = [
            'Expenses',
            'Bank',
            'Accounts receivable (A/R)',
            'Other Current Assets',
            'Fixed Assets',
            'Accounts payable (A/P)',
            'Credit Card',
            'Other Current Liabilities',
            'Long Term Liabilities',
            'Equity',
            'Income',
            'Cost of Goods Sold',
            'Other Income',
            'Other Expense'
        ];

        foreach ($accountTypes as $typeName) {
            $accType = $this->account_model->getAccTypeByName($typeName);

            $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

            if (count($accounts) > 0) {
                foreach ($accounts as $account) {
                    $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                    $account->childAccs = $childAccs;

                    $categoryAccs[$typeName][] = $account;
                }
            }
        }

        return $categoryAccs;
    }

    public function get_expense_transactions()
    {
        $post = $this->input->post();

        $filters = $this->set_filters($post);

        $data = $this->get_transactions($filters);

        echo json_encode($data);
    }

    private function get_transactions($filters, $for = 'table')
    {
        switch ($filters['type']) {
            case 'all-transactions':
                if (!isset($filters['payee']) || $filters['payee']['type'] === 'vendor') {
                    $bills = $this->expenses_model->get_company_bill_transactions($filters);
                }
                if (!isset($filters['status'])) {
                    $expenses = $this->expenses_model->get_company_expense_transactions($filters);
                    $checks = $this->expenses_model->get_company_check_transactions($filters);
                    $purchOrders = $this->expenses_model->get_company_purch_order_transactions($filters);
                    $vendorCredits = $this->expenses_model->get_company_vendor_credit_transactions($filters);
                    $ccPayments = $this->expenses_model->get_company_cc_payment_transactions($filters);
                    $billPayments = $this->expenses_model->get_company_bill_payment_items($filters);
                    $creditCardCredits = $this->expenses_model->get_company_cc_credit_transactions($filters);
                    $transfers = $this->expenses_model->get_company_transfers($filters);
                }
            break;
            case 'bill':
                $bills = $this->expenses_model->get_company_bill_transactions($filters);
            break;
            case 'expenses':
                $expenses = $this->expenses_model->get_company_expense_transactions($filters);
            break;
            case 'check':
                $checks = $this->expenses_model->get_company_check_transactions($filters);
            break;
            case 'purchase-order':
                $purchOrders = $this->expenses_model->get_company_purch_order_transactions($filters);
            break;
            case 'vendor-credit':
                $vendorCredits = $this->expenses_model->get_company_vendor_credit_transactions($filters);
            break;
            case 'credit-card-payment':
                $ccPayments = $this->expenses_model->get_company_cc_payment_transactions($filters);
            break;
            case 'bill-payments':
                $billPayments = $this->expenses_model->get_company_bill_payment_items($filters);
            break;
        }

        $transactions = [];
        if (isset($bills) && count($bills) > 0 && $filters['delivery_method'] === 'any') {
            foreach ($bills as $bill) {
                $attachments = $this->accounting_attachments_model->get_attachments('Bill', $bill->id);
                $category = $this->category_col($bill->id, 'Bill', $for);

                $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);

                if($filters['category'] === 'all' || is_array($category) && $filters['category'] === $category['id']) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">';
                        
                        if($bill->status !== "2") {
                            $manageCol .= '<li><a class="dropdown-item" href="#">Schedule payment</a></li>';
                            $manageCol .= '<li><a class="dropdown-item" href="#">Mark as paid</a></li>';
                        }
                        $manageCol .= '<li>
                                    <a class="dropdown-item view-edit-bill" href="#">View/Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item copy-transaction" href="#">Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </li>
                                <li>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </li>
                            </ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $bill->id,
                        'date' => date("m/d/Y", strtotime($bill->bill_date)),
                        'type' => 'Bill',
                        'number' => $bill->bill_no,
                        'payee' => $payee->display_name,
                        'method' => '',
                        'source' => '',
                        'category' => $category,
                        'memo' => $bill->memo,
                        'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                        'balance' => '$'.number_format(floatval($bill->remaining_balance), 2, '.', ','),
                        'total' => '$'.number_format(floatval($bill->total_amount), 2, '.', ','),
                        'status' => $bill->status === "2" ? "Paid" : "Open",
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($bill->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if (isset($billPayments) && count($billPayments) > 0) {
            foreach ($billPayments as $billPayment) {
                $attachments = $this->accounting_attachments_model->get_attachments('Bill Payment', $billPayment->id);

                $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
                $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
                $paymentType = $paymentAccType->account_name === 'Bank' ? 'Check' : 'Credit Card';

                $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);

                if($filters['category'] === 'all') {
                    if($for === 'table') {
                        if($paymentType === 'Check') {
                            $manageCol = '<div class="dropdown table-management">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item print-check" href="#">Print check</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item view-edit-bill-payment" href="#">View/Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                    </li>
                            ';

                            if($billPayment->status !== '4') {
                                $manageCol .= '<li>
                                    <a class="dropdown-item void-transaction" href="#">Void</a>
                                </li>';
                            }

                            $manageCol .= '</ul>
                            </div>';
                        } else {
                            $manageCol = '<div class="dropdown table-management">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item view-edit-bill-payment" href="#">View/Edit</a>
                                    </li>
                                </ul>
                            </div>
                            ';
                        }
                    }

                    $transactions[] = [
                        'id' => $billPayment->id,
                        'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                        'type' => "Bill Payment ($paymentType)",
                        'number' => $billPayment->check_no,
                        'payee' => $payee->display_name,
                        'method' => '',
                        'source' => '',
                        'category' => '',
                        'memo' => is_null($billPayment->memo) ? '' : $billPayment->memo,
                        'due_date' => '',
                        'balance' => '$'.number_format(floatval($billPayment->available_credits_amount), 2, '.', ','),
                        'total' => '$'.number_format(floatval($billPayment->total_amount), 2, '.', ','),
                        'status' => $billPayment->status === '4' ? 'Voided' : 'Applied',
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($billPayment->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if (isset($checks) && count($checks) > 0) {
            foreach ($checks as $check) {
                $attachments = $this->accounting_attachments_model->get_attachments('Check', $check->id);
                $category = $this->category_col($check->id, 'Check', $for);

                switch ($check->payee_type) {
                    case 'vendor':
                        $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'customer':
                        $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee':
                        $payee = $this->users_model->getUser($check->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }

                if($filters['category'] === 'all' || is_array($category) && $filters['category'] === $category['id'] || $filters['category'] === $check->bank_account_id) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </li>
                                <li>
                                    <a class="dropdown-item view-edit-check" href="#">View/Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item copy-transaction" href="#">Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </li>
                        ';

                        if($check->status !== '4') {
                            $manageCol .= '<li>
                                <a class="dropdown-item void-transaction" href="#">Void</a>
                            </li>';
                        }

                        $manageCol .= '</ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $check->id,
                        'date' => date("m/d/Y", strtotime($check->payment_date)),
                        'type' => 'Check',
                        'number' => $check->check_no,
                        'payee' => $payeeName,
                        'method' => '',
                        'source' => '',
                        'category' => $category,
                        'memo' => $check->memo,
                        'due_date' => '',
                        'balance' => '$0.00',
                        'total' => '-$'.number_format(floatval($check->total_amount), 2, '.', ','),
                        'status' => $check->status === "1" ? "Paid" : "Voided",
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($check->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if (isset($creditCardCredits) && count($creditCardCredits) > 0 && $filters['delivery_method'] === 'any') {
            foreach ($creditCardCredits as $creditCardCredit) {
                $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $creditCardCredit->id);
                $category = $this->category_col($creditCardCredit->id, 'Credit Card Credit', $for);

                switch ($creditCardCredit->payee_type) {
                    case 'vendor':
                        $payee = $this->vendors_model->get_vendor_by_id($creditCardCredit->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'customer':
                        $payee = $this->accounting_customers_model->get_by_id($creditCardCredit->payee_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee':
                        $payee = $this->users_model->getUser($creditCardCredit->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }

                if($filters['category'] === 'all' || is_array($category) && $filters['category'] === $category['id'] || $filters['category'] === $creditCardCredit->bank_credit_account_id) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </li>
                                <li>
                                    <a class="dropdown-item view-edit-cc-credit" href="#">View/Edit</a>
                                </li>
                            </ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $creditCardCredit->id,
                        'date' => date("m/d/Y", strtotime($creditCardCredit->payment_date)),
                        'type' => 'Credit Card Credit',
                        'number' => $creditCardCredit->ref_no,
                        'payee' => $payeeName,
                        'method' => '',
                        'source' => '',
                        'category' => $category,
                        'memo' => $creditCardCredit->memo,
                        'due_date' => '',
                        'balance' => '$0.00',
                        'total' => '-$'.number_format(floatval($creditCardCredit->total_amount), 2, '.', ','),
                        'status' => '',
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($creditCardCredit->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if (isset($ccPayments) && count($ccPayments) > 0 && $filters['delivery_method'] === 'any') {
            foreach ($ccPayments as $ccPayment) {
                $attachments = $this->accounting_attachments_model->get_attachments('CC Payment', $ccPayment->id);

                $payee = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);

                if($filters['category'] === 'all' || $filters['category'] === $ccPayment->credit_card_id || $filters['category'] === $ccPayment->bank_account_id) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item view-edit-cc-payment" href="#">View/Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </li>';

                        if($ccPayment->status !== '4') {
                            $manageCol .= '<li><a class="dropdown-item void-transaction" href="#">Void</a></li>';
                        }

                        $manageCol .= '</ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $ccPayment->id,
                        'date' => date("m/d/Y", strtotime($ccPayment->date)),
                        'type' => 'Credit Card Payment',
                        'number' => '',
                        'payee' => $payee->display_name,
                        'method' => '',
                        'source' => '',
                        'category' => '',
                        'memo' => $ccPayment->memo,
                        'due_date' => '',
                        'balance' => '$0.00',
                        'total' => '$'.number_format(floatval($ccPayment->amount), 2, '.', ','),
                        'status' => '',
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($ccPayment->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if (isset($expenses) && count($expenses) > 0 && $filters['delivery_method'] === 'any') {
            foreach ($expenses as $expense) {
                $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);
                $category = $this->category_col($expense->id, 'Expense', $for);

                switch ($expense->payee_type) {
                    case 'vendor':
                        $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'customer':
                        $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee':
                        $payee = $this->users_model->getUser($expense->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }

                $method = $this->accounting_payment_methods_model->getById($expense->payment_method_id);

                if($filters['category'] === 'all' || is_array($category) && $filters['category'] === $category['id'] || $filters['category'] === $expense->payment_account_id) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </li>
                                <li>
                                    <a class="dropdown-item view-edit-expense" href="#">View/Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/expense/'.$expense->id.'" target="_blank">Print</a>
                                </li>
                                <li>
                                    <a class="dropdown-item copy-transaction" href="#">Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </li>
                        ';

                        if($expense->status !== '4') {
                            $manageCol .= '<li>
                                <a class="dropdown-item void-transaction" href="#">Void</a>
                            </li>';
                        }

                        $manageCol .= '</ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $expense->id,
                        'date' => date("m/d/Y", strtotime($expense->payment_date)),
                        'type' => 'Expense',
                        'number' => $expense->ref_no,
                        'payee' => $payeeName,
                        'method' => is_null($method) ? '' : $method->name,
                        'source' => '',
                        'category' => $category,
                        'memo' => $expense->memo,
                        'due_date' => '',
                        'balance' => '$0.00',
                        'total' => '$'.number_format(floatval($expense->total_amount), 2, '.', ','),
                        'status' => $expense->status === "1" ? 'Paid' : 'Voided',
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if (isset($purchOrders) && count($purchOrders) > 0 && $filters['delivery_method'] === 'any') {
            foreach ($purchOrders as $purchOrder) {
                $attachments = $this->accounting_attachments_model->get_attachments('Purchase Order', $purchOrder->id);
                $category = $this->category_col($purchOrder->id, 'Purchase Order', $for);

                $payee = $this->vendors_model->get_vendor_by_id($purchOrder->vendor_id);

                if($filters['category'] === 'all' || is_array($category) && $filters['category'] === $category['id']) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">';

                            if($purchOrder->status === '1') {
                                $manageCol .= '<li>
                                    <a class="dropdown-item" href="#">Send</a>
                                </li>
                                <li>
                                    <a class="dropdown-item copy-to-bill" href="#">Copy to bill</a>
                                </li>';
                            }

                            $manageCol .= '<li>
                                    <a class="dropdown-item" href="/accounting/expenses/print-transaction/purchase-order/'.$purchOrder->id.'" target="_blank">Print</a>
                                </li>
                                <li>
                                    <a class="dropdown-item view-edit-purch-order" href="#">View/Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item copy-transaction" href="#">Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </li>
                                <li>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </li>
                        ';

                        $manageCol .= '</ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $purchOrder->id,
                        'date' => date("m/d/Y", strtotime($purchOrder->purchase_order_date)),
                        'type' => 'Purchase Order',
                        'number' => $purchOrder->purchase_order_no,
                        'payee' => $payee->display_name,
                        'method' => '',
                        'source' => '',
                        'category' => $category,
                        'memo' => $purchOrder->memo,
                        'due_date' => '',
                        'balance' => '$0.00',
                        'total' => '$'.number_format(floatval($purchOrder->total_amount), 2, '.', ','),
                        'status' => $purchOrder->status === "1" ? "Open" : "Closed",
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($purchOrder->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if(isset($transfers) && count($transfers) > 0 && is_null($filters['payee']) && $filters['delivery_method'] === 'any') {
            foreach($transfers as $transfer) {
                $attachments = $this->accounting_attachments_model->get_attachments('Transfer', $transfer->id);

                if($filters['category'] === 'all' || $filters['category'] === $transfer->transfer_from_account_id || $filters['category'] === $transfer->transfer_to_account_id) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item view-edit-transfer" href="#">View/Edit</a>
                                </li>
                            </ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $transfer->id,
                        'date' => date("m/d/Y", strtotime($transfer->transfer_date)),
                        'type' => 'Transfer',
                        'number' => '',
                        'payee' => '',
                        'method' => '',
                        'source' => '',
                        'category' => '',
                        'memo' => $transfer->transfer_memo,
                        'due_date' => '',
                        'balance' => '$0.00',
                        'total' => '-$'.number_format(floatval($transfer->transfer_amount), 2, '.', ','),
                        'status' => '',
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($transfer->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        if (isset($vendorCredits) && count($vendorCredits) > 0 && $filters['delivery_method'] === 'any') {
            foreach ($vendorCredits as $vendorCredit) {
                $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $vendorCredit->id);
                $category = $this->category_col($vendorCredit->id, 'Vendor Credit', $for);

                $payee = $this->vendors_model->get_vendor_by_id($vendorCredit->vendor_id);

                if($filters['category'] === 'all' || is_array($category) && $filters['category'] === $category['id']) {
                    if($for === 'table') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item attach-file" href="#">Attach a file</a>
                                </li>
                                <li>
                                    <a class="dropdown-item view-edit-vendor-credit" href="#">View/Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item copy-transaction" href="#">Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </li>
                            </ul>
                        </div>';
                    }

                    $transactions[] = [
                        'id' => $vendorCredit->id,
                        'date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                        'type' => 'Vendor Credit',
                        'number' => $vendorCredit->ref_no,
                        'payee' => $payee->display_name,
                        'method' => '',
                        'source' => '',
                        'category' => $category,
                        'memo' => $vendorCredit->memo,
                        'due_date' => '',
                        'balance' => '$'.number_format(floatval($vendorCredit->remaining_balance), 2, '.', ','),
                        'total' => '-$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ','),
                        'status' => $vendorCredit->status === "1" ? "Open" : "Closed",
                        'attachments' => $for === 'table' ? $attachments : count($attachments),
                        'date_created' => date("m/d/Y H:i:s", strtotime($vendorCredit->created_at)),
                        'manage' => $for === 'table' ? $manageCol : ''
                    ];
                }
            }
        }

        usort($transactions, function($a, $b) {
            if($a['date'] === $b['date']) {
                return strtotime($a['date_created']) < strtotime($b['date_created']);
            }
            return strtotime($a['date']) < strtotime($b['date']);
        });

        return $transactions;
    }

    private function set_filters($post)
    {
        $filters = [
            'company_id' => logged('company_id'),
            'type' => $post['type'],
            'delivery_method' => $post['delivery_method'],
            'category' => $post['category']
        ];

        if ($post['payee'] !== 'all') {
            $payee = explode('-', $post['payee']);
            $filters['payee'] = [
                'type' => $payee[0],
                'id' => $payee[1]
            ];
        }

        if ($post['status'] !== 'all') {
            $filters['status'] = $post['status'];
        }

        if($post['from_date'] !== '') {
            $filters['start-date'] = date("Y-m-d", strtotime($post['from_date']));        
        }
        if($post['to_date'] !== '') {
            $filters['end-date'] = date("Y-m-d", strtotime($post['to_date']));
        }

        return $filters;
    }

    private function category_col($transactionId, $transactionType, $for = 'table')
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        $totalCount = count($categories) + count($items);

        if ($totalCount > 1) {
            $category = '-Split-';
        } else {
            if ($totalCount === 1) {
                if (count($categories) === 1 && count($items) === 0) {
                    $expenseAcc = $categories[0]->expense_account_id;
                } else {
                    $itemId = $items[0]->item_id;
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($itemId);
                    $expenseAcc = $itemAccDetails->inv_asset_acc_id;
                }

                if($for === 'table') {
                    $category = [
                        'id' => $expenseAcc,
                        'name' => $this->chart_of_accounts_model->getName($expenseAcc)
                    ];
                } else {
                    $category = $this->chart_of_accounts_model->getName($expenseAcc);
                }
            }
        }

        return $category;
    }

    public function categorize_transactions($categoryId)
    {
        $post = $this->input->post();

        $categories = [];
        foreach ($post['transaction_id'] as $index => $transactionId) {
            switch ($post['transaction_type'][$index]) {
                case 'bill':
                    $transaction = $this->vendors_model->get_bill_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Bill');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'expense':
                    $transaction = $this->vendors_model->get_expense_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Expense');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'check':
                    $transaction = $this->vendors_model->get_check_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Check');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'purchase-order':
                    $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Purchase Order');
                    $category = $category[0];
                break;
                case 'vendor-credit':
                    $transaction = $this->vendors_model->get_vendor_credit_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Vendor Credit');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'credit-card-credit':
                    $transaction = $this->vendors_model->get_credit_card_credit_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Credit Card Credit');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
            }

            $categories[] = [
                'id' => $category->id,
                'expense_account_id' => $categoryId
            ];
        }

        $update = $this->vendors_model->update_multiple_category_by_id($categories);
        $updatedCount = count($post['transaction_id']);
        $newCategory = $this->chart_of_accounts_model->getById($categoryId);

        $this->session->set_flashdata("success", "Category updated to $newCategory->name for $updatedCount transactions.");
    }

    public function print_multiple()
    {
        $this->load->library('pdf');
        $view = "accounting/modals/print_action/print_transactions";
        $fileName = 'print.pdf';
        $transactions = $this->input->post('transactions');

        $data = [];
        foreach ($transactions as $transaction) {
            $explode = explode('_', $transaction);
            $transactionType = $explode[0];
            $transactionId = $explode[1];

            switch ($transactionType) {
                case 'expense':
                    $transaction = $this->vendors_model->get_expense_by_id($transactionId, logged('company_id'));
                    $items = $this->expenses_model->get_transaction_items($transactionId, 'Expense');
                    $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Expense');
    
                    switch ($transaction->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($transaction->payee_id);
                            $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                            $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                            $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                            $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                            $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";
    
                            $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($transaction->payee_id);
                            $payeeName = $payee->first_name !== null && $payee->first_name !== ""  ? $payee->first_name : "";
                            $payeeName .= $payee->middle_name !== null && $payee->middle_name !== ""  ? " $payee->middle_name" : "";
                            $payeeName .= $payee->last_name !== null && $payee->last_name !== ""  ? " $payee->last_name" : "";
                            $payeeName .= $payee->suffix !== null && $payee->suffix !== ""  ? " $payee->suffix" : "";
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($expense->payee_id);
                            $payeeName = $payee->FName . ' ' . $payee->LName;
                        break;
                    }
                break;
                case 'purchase-order':
                    $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId, logged('company_id'));
                    $items = $this->expenses_model->get_transaction_items($transactionId, 'Purchase Order');
                    $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Purchase Order');
    
                    $payee = $this->vendors_model->get_vendor_by_id($transaction->vendor_id);
                    $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                    $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                    $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                    $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                    $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";
    
                    $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
                break;
            }

            $tableItems = [];
            foreach ($items as $item) {
                $itemDetails = $this->items_model->getItemById($item->item_id)[0];

                if ($transactionType === 'expense') {
                    $tableItems[] = [
                        'name' => $itemDetails->title,
                        'description' => '',
                        'amount' => number_format(floatval($item->total), 2, '.', ',')
                    ];
                } else {
                    $tableItems[] = [
                        'activity' => $itemDetails->title,
                        'qty' => $item->quantity,
                        'rate' => number_format(floatval($item->rate), 2, '.', ','),
                        'amount' => number_format(floatval($item->total), 2, '.', ','),
                    ];
                }
            }

            foreach ($categories as $category) {
                $categoryAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                if ($transactionType === 'expense') {
                    $tableItems[] = [
                        'name' => $categoryAcc->name,
                        'description' => $category->description,
                        'amount' => number_format(floatval($category->amount), 2, '.', ',')
                    ];
                } else {
                    $tableItems[] = [
                        'activity' => $categoryAcc->name,
                        'qty' => '',
                        'rate' => '',
                        'amount' => number_format(floatval($category->amount), 2, '.', ','),
                    ];
                }
            }

            usort($tableItems, function ($a, $b) use ($transactionType) {
                if ($transactionType === 'expense') {
                    return strcmp($a['name'], $b['name']);
                } else {
                    return strcmp($a['activity'], $b['activity']);
                }
            });

            $data[] = [
                'type' => $transactionType,
                'payee' => $payee,
                'payeeName' => $payeeName,
                'transaction' => $transaction,
                'table_items' => $tableItems
            ];
        }

        $this->pdf->save_pdf($view, ['data' => $data], $fileName, 'portrait');

        $pdf = file_get_contents(base_url("/assets/pdf/$fileName"));

        if (file_exists(getcwd()."/assets/pdf/$fileName")) {
            unlink(getcwd()."/assets/pdf/$fileName");
        }

        // Header content type
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="print.pdf";');

        ob_clean();
        flush();
        echo $pdf;
        exit;
    }

    public function print_transaction($transactionType, $transactionId)
    {
        $this->load->library('pdf');
        $view = "accounting/modals/print_action/print_transactions";
        $fileName = 'print.pdf';

        $data = [];

        switch ($transactionType) {
            case 'expense':
                $transaction = $this->vendors_model->get_expense_by_id($transactionId, logged('company_id'));
                $items = $this->expenses_model->get_transaction_items($transactionId, 'Expense');
                $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Expense');

                switch ($transaction->payee_type) {
                    case 'vendor':
                        $payee = $this->vendors_model->get_vendor_by_id($transaction->payee_id);
                        $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                        $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                        $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                        $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                        $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";

                        $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
                    break;
                    case 'customer':
                        $payee = $this->accounting_customers_model->get_by_id($transaction->payee_id);
                        $payeeName = $payee->first_name !== null && $payee->first_name !== ""  ? $payee->first_name : "";
                        $payeeName .= $payee->middle_name !== null && $payee->middle_name !== ""  ? " $payee->middle_name" : "";
                        $payeeName .= $payee->last_name !== null && $payee->last_name !== ""  ? " $payee->last_name" : "";
                        $payeeName .= $payee->suffix !== null && $payee->suffix !== ""  ? " $payee->suffix" : "";
                    break;
                    case 'employee':
                        $payee = $this->users_model->getUser($expense->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }
            break;
            case 'purchase-order':
                $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId, logged('company_id'));
                $items = $this->expenses_model->get_transaction_items($transactionId, 'Purchase Order');
                $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Purchase Order');

                $payee = $this->vendors_model->get_vendor_by_id($transaction->vendor_id);
                $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";

                $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
            break;
        }
        
        $tableItems = [];

        foreach ($items as $item) {
            $itemDetails = $this->items_model->getItemById($item->item_id)[0];

            if ($transactionType === 'expense') {
                $tableItems[] = [
                    'name' => $itemDetails->title,
                    'description' => '',
                    'amount' => number_format(floatval($item->total), 2, '.', ',')
                ];
            } else {
                $tableItems[] = [
                    'activity' => $itemDetails->title,
                    'qty' => $item->quantity,
                    'rate' => number_format(floatval($item->rate), 2, '.', ','),
                    'amount' => number_format(floatval($item->total), 2, '.', ','),
                ];
            }
        }

        foreach ($categories as $category) {
            $categoryAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

            if ($transactionType === 'expense') {
                $tableItems[] = [
                    'name' => $categoryAcc->name,
                    'description' => $category->description,
                    'amount' => number_format(floatval($category->amount), 2, '.', ',')
                ];
            } else {
                $tableItems[] = [
                    'activity' => $categoryAcc->name,
                    'qty' => '',
                    'rate' => '',
                    'amount' => number_format(floatval($category->amount), 2, '.', ','),
                ];
            }
        }

        usort($tableItems, function ($a, $b) use ($transactionType) {
            if ($transactionType === 'expense') {
                return strcmp($a['name'], $b['name']);
            } else {
                return strcmp($a['activity'], $b['activity']);
            }
        });

        $data[] = [
            'type' => $transactionType,
            'payee' => $payee,
            'payeeName' => $payeeName,
            'transaction' => $transaction,
            'table_items' => $tableItems
        ];

        $this->pdf->save_pdf($view, ['data' => $data], $fileName, 'portrait');

        $pdf = file_get_contents(base_url("/assets/pdf/$fileName"));

        if (file_exists(getcwd()."/assets/pdf/$fileName")) {
            unlink(getcwd()."/assets/pdf/$fileName");
        }
        // Header content type
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="print.pdf";');

        ob_clean();
        flush();
        echo $pdf;
        exit;
    }

    public function attach_file_modal($transactionType, $transactionId)
    {
        $transaction = $this->get_transaction($transactionType, $transactionId);

        // if ($transaction->attachments !== "" && $transaction->attachments !== null) {
        //     $attachmentIds = json_decode($transaction->attachments, true);
        // } else {
        //     $attachmentIds = null;
        // }

        $this->page_data['id'] = $transactionId;
        $this->page_data['transactionType'] = $transactionType;
        $this->page_data['attachments'] = $this->accounting_attachments_model->get_unlinked_attachments();

        $this->load->view('accounting/expenses/attach_file_modal', $this->page_data);
    }

    public function attach_files($transactionType, $transactionId)
    {
        $transaction = $this->get_transaction($transactionType, $transactionId);
        $attachments = json_decode($transaction->attachments, true);

        $files = $_FILES['file'];

        if (count($files['name']) > 0) {
            $insert = $this->uploadFile($files);

            if ($attachments === null) {
                $attachments = $insert;
            } else {
                foreach ($insert as $id) {
                    $attachments[] = $id;
                }
            }

            $attachments = json_encode($attachments);

            switch ($transactionType) {
                case 'expense':
                    $update = $this->vendors_model->update_expense($transactionId, ['attachments' => $attachments]);
                break;
                case 'check':
                    $update = $this->vendors_model->update_check($transactionId, ['attachments' => $attachments]);
                break;
                case 'bill':
                    $update = $this->vendors_model->update_bill($transactionId, ['attachments' => $attachments]);
                break;
                case 'bill-payment':
                    $update = $this->vendors_model->update_bill_payment($transactionId, ['attachments' => $attachments]);
                break;
                case 'purchase-order':
                    $update = $this->vendors_model->update_purchase_order($transactionId, ['attachments' => $attachments]);
                break;
                case 'vendor-credit':
                    $update = $this->vendors_model->update_vendor_credit($transactionId, ['attachments' => $attachments]);
                break;
                case 'credit-card-credit':
                    $update = $this->vendors_model->update_credit_card_credit($transactionId, ['attachments' => $attachments]);
                break;
            }
            
            if ($update) {
                $this->session->set_flashdata('success', count($insert)." attachments sucessfully attached.");
                echo json_encode('success');
            } else {
                $this->session->set_flashdata('error', "Unexpected error, please try again!");
                echo json_encode('error');
            }
        } else {
            echo json_encode('error');
        }
    }

    private function get_transaction($transactionType, $transactionId)
    {
        switch ($transactionType) {
            case 'expense':
                $transaction = $this->vendors_model->get_expense_by_id($transactionId, logged('company_id'));
            break;
            case 'check':
                $transaction = $this->vendors_model->get_check_by_id($transactionId, logged('company_id'));
            break;
            case 'bill':
                $transaction = $this->vendors_model->get_bill_by_id($transactionId, logged('company_id'));
            break;
            case 'bill-payment':
                $transaction = $this->vendors_model->get_bill_payment_by_id($transactionId, logged('company_id'));
            break;
            case 'purchase-order':
                $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId, logged('company_id'));
            break;
            case 'vendor-credit':
                $transaction = $this->vendors_model->get_vendor_credit_by_id($transactionId, logged('company_id'));
            break;
            case 'credit-card-credit':
                $transaction = $this->vendors_model->get_credit_card_credit_by_id($transactionId, logged('company_id'));
            break;
        }

        return $transaction;
    }

    private function uploadFile($files)
    {
        $this->load->helper('string');
        $data = [];
        foreach ($files['name'] as $key => $name) {
            $extension = end(explode('.', $name));

            do {
                $randomString = random_string('alnum');
                $fileNameToStore = $randomString . '.' .$extension;
                $exists = file_exists('./uploads/accounting/attachments/'.$fileNameToStore);
            } while ($exists);

            $fileType = explode('/', $files['type'][$key]);
            $uploadedName = str_replace('.'.$extension, '', $name);

            $data[] = [
                'company_id' => getLoggedCompanyID(),
                'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
                'uploaded_name' => $uploadedName,
                'stored_name' => $fileNameToStore,
                'file_extension' => $extension,
                'size' => $files['size'][$key],
                'notes' => null,
                'linked_to_count' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$fileNameToStore);
        }

        $attachmentIds = [];
        foreach ($data as $attachment) {
            $attachmentIds[] = $this->accounting_attachments_model->create($attachment);
        }

        return $attachmentIds;
    }

    public function attach($transactionType, $transactionId)
    {
        $attachmentId = $this->input->post('id');
        $attachment = $this->accounting_attachments_model->getById($attachmentId);

        switch ($transactionType) {
            case 'expense':
                $linkedType = 'Expense';
            break;
            case 'check':
                $linkedType = 'Check';
            break;
            case 'bill':
                $linkedType = 'Bill';
            break;
            case 'bill-payment':
                $linkedType = 'Bill Payment';
            break;
            case 'purchase-order':
                $linkedType = 'Purchase Order';
            break;
            case 'vendor-credit':
                $linkedType = 'Vendor Credit';
            break;
            case 'credit-card-credit':
                $linkedType = 'CC Credit';
            break;
            case 'vendor' :
                $linkedType = 'Vendor';
            break;
        }

        $attachments = $this->accounting_attachments_model->get_attachments($transactionType, $transactionId);

        $attachmentData = [
            'type' => $linkedType,
            'attachment_id' => $attachmentId,
            'linked_id' => $transactionId,
            'order_no' => count($attachments) + 1
        ];

        $attach = $this->accounting_attachments_model->link_attachment($attachmentData);

        if ($attach) {
            $this->session->set_flashdata('success', "$attachment->uploaded_name.$attachment->file_extension sucessfully attached.");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect('accounting/expenses');
    }

    public function print_transactions()
    {
        $post = $this->input->post();
        $order = $post['order'];
        $columnName = $post['column'];

        $filters = $this->set_filters($post);

        $transactions = $this->get_transactions($filters, 'print');

        usort($transactions, function ($a, $b) use ($order, $columnName) {
            if ($columnName !== 'date') {
                if($a[$columnName] === $b[$columnName]) {
                    return strtotime($a['date_created']) > strtotime($b['date_created']);
                }
                if ($order === 'asc') {
                    return strcmp($a[$columnName], $b[$columnName]);
                } else {
                    return strcmp($b[$columnName], $a[$columnName]);
                }
            } else {
                if ($order === 'asc') {
                    if(strtotime($a[$columnName]) === strtotime($b[$columnName])) {
                        return strtotime($a['date_created']) > strtotime($b['date_created']);
                    }
                    return strtotime($a[$columnName]) > strtotime($b[$columnName]);
                } else {
                    if(strtotime($a[$columnName]) === strtotime($b[$columnName])) {
                        return strtotime($a['date_created']) < strtotime($b['date_created']);
                    }
                    return strtotime($a[$columnName]) < strtotime($b[$columnName]);
                }
            }
        });

        switch($post['type']) {
            case 'all' :
                $type = 'All transactions';
            break;
            case 'expenses' :
                $type = 'Expense';
            break;
            case 'bill' :
                $type = 'Bill';
            break;
            case 'bill-payments' :
                $type = 'Bill payments';
            break;
            case 'check' :
                $type = 'Check';
            break;
            case 'purchase-order' :
                $type = 'Purchase order';
            break;
            case 'recently-paid' :
                $type = 'Recently paid';
            break;
            case 'vendor-credit' :
                $type = 'Vendor Credit';
            break;
            case 'credit-card-payment' :
                $type = 'Credit Card Payment';
            break;
        }

        $status = $post['status'] === 'all' ? 'All statuses' : ucfirst($post['status']);

        $tableHtml = "<h3 style='text-align: center;'>";
        $tableHtml .= "Type: $type · Status: $status";
        $tableHtml .= $post['date'] !== 'custom' ? " · Date: ".ucfirst(str_replace("-", " ", $post['date'])) : " · Delivery method: ".ucfirst(str_replace("-", " ", $post['delivery_method']));
        $tableHtml .= "</h3>";
        $tableHtml .= "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Date</th>";
        $tableHtml .= $post['chk_type'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>" : "";
        $tableHtml .= $post['chk_number'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>No.</th>" : "";
        $tableHtml .= $post['chk_payee'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Payee</th>" : "";
        $tableHtml .= $post['chk_method'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Method</th>" : "";
        $tableHtml .= $post['chk_source'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Source</th>" : "";
        $tableHtml .= $post['chk_category'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Category</th>" : "";
        $tableHtml .= $post['chk_memo'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Memo</th>" : "";
        $tableHtml .= $post['chk_due_date'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Due date</th>" : "";
        $tableHtml .= $post['chk_balance'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Balance</th>" : "";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Total</th>";
        $tableHtml .= $post['chk_status'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Status</th>" : "";
        $tableHtml .= $post['chk_attachments'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Attachments</th>" : "";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";

        foreach($transactions as $transaction) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['date']."</td>";
            $tableHtml .= $post['chk_type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['type']."</td>" : "";
            $tableHtml .= $post['chk_number'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['number']."</td>" : "";
            $tableHtml .= $post['chk_payee'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['payee']."</td>" : "";
            $tableHtml .= $post['chk_method'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['method']."</td>" : "";
            $tableHtml .= $post['chk_source'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['source']."</td>" : "";
            $tableHtml .= $post['chk_category'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['category']."</td>" : "";
            $tableHtml .= $post['chk_memo'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['memo']."</td>" : "";
            $tableHtml .= $post['chk_due_date'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['due_date']."</td>" : "";
            $tableHtml .= $post['chk_balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['balance']."</td>" : "";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['total']."</td>";
            $tableHtml .= $post['chk_status'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['status']."</td>" : "";
            $tableHtml .= $post['chk_attachments'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['attachments']."</td>" : "";
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function export()
    {
        $this->load->library('PHPXLSXWriter');
        $post = $this->input->post();

        $filters = $this->set_filters($post);

        $transactions = $this->get_transactions($filters, 'print');

        usort($transactions, function($a, $b) {
            if(strtotime($a['date']) === strtotime($b['date'])) {
                return strtotime($a['date_created']) < strtotime($b['date_created']);
            }
            return strtotime($a['date']) < strtotime($b['date']);
        });

        switch($post['type']) {
            case 'all-transactions' :
                $type = 'All transactions';
            break;
            case 'expense' :
                $type = 'Expense';
            break;
            case 'bill' :
                $type = 'Bill';
            break;
            case 'bill-payments' :
                $type = 'Bill payments';
            break;
            case 'check' :
                $type = 'Check';
            break;
            case 'purchase-order' :
                $type = 'Purchase order';
            break;
            case 'recently-paid' :
                $type = 'Recently paid';
            break;
            case 'vendor-credit' :
                $type = 'Vendor Credit';
            break;
            case 'credit-card-payment' :
                $type = 'Credit Card Payment';
            break;
        }

        $status = $post['status'] === 'all' ? 'All statuses' : ucfirst($post['status']);
        $excelHead = "Type: $type · Status: $status · Delivery method: ".ucfirst(str_replace("-", " ", $post['delivery_method']));
        $excelHead .= $post['date'] !== 'custom' ? " · Date: ".ucfirst(str_replace("-", " ", $post['date'])) : "";

        $writer = new XLSXWriter();
        $writer->writeSheetRow('Sheet1', [$excelHead], ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);
        $headers = [];

        $headers[] = "Date";
        if(in_array('type', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Type";
        }
        if(in_array('number', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "No.";
        }
        if(in_array('payee', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Payee";
        }
        if(in_array('method', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Method";
        }
        if(in_array('source', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Source";
        }
        if(in_array('category', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Category";
        }
        if(in_array('memo', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Memo";
        }
        if(in_array('due_date', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Due date";
        }
        if(in_array('balance', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Balance";
        }
        $headers[] = "Total";
        if(in_array('status', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Status";
        }
        if(in_array('attachments', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Attachments";
        }
        $writer->markMergedCell('Sheet1', 0, 0, 0, count($headers) - 1);
        $writer->writeSheetRow('Sheet1', $headers, ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);

        foreach($transactions as $transaction) {
            $keys = array_keys($transaction);

            foreach($keys as $key) {
                if(!in_array($key, ['date', 'total']) && !in_array($key, $post['fields']) || is_null($post['fields']) && !in_array($key, ['date', 'total'])) {
                    unset($transaction[$key]);
                }
            }

            $writer->writeSheetRow('Sheet1', $transaction);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="expenses.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }

    public function update_transaction_category()
    {
        $post = $this->input->post();

        switch ($post['transaction_type']) {
            case 'bill':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Bill');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'expense':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Expense');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'check':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Check');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'vendor-credit':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Vendor Credit');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'credit-card-credit':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Credit Card Credit');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
        }

        $post['transaction_type'] = str_replace('-', ' ', $post['transaction_type']);
        $post['transaction_type'] = ucwords($post['transaction_type']);

        $update = $this->vendors_model->update_transaction_category($post);

        echo json_encode([
            'data' => $update,
            'success' => $update ? true : false,
            'message' => $update ? "Successfully updated!" : "Unexpected Error"
        ]);
    }

    public function copy_to_bill($purchaseOrderId)
    {
        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($purchaseOrderId, logged('company_id'));
        $terms = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));

        $selectedTerm = $terms[0];
        if ($selectedTerm->type === "1") {
            $dueDate = date("m/d/Y", strtotime(date("m/d/Y")." +$selectedTerm->net_due_days days"));
        } else {
            if ($selectedTerm->minimum_days_to_pay === null ||
                $selectedTerm->minimum_days_to_pay === "" ||
                $selectedTerm->minimum_days_to_pay === "0") {
                if (intval(date("d")) > intval($selectedTerm->day_of_month_due)) {
                    $dueDate = date("m/d/Y", strtotime(date("m/$selectedTerm->day_of_month_due/Y")." +1 month"));
                } else {
                    $dueDate = date("m/$selectedTerm->day_of_month_due/Y");
                }
            } else {
                if (intval(date("d") > intval(date("d", strtotime(date("m/$selectedTerm->day_of_month_due/Y")." -$selectedTerm->minimum_days_to_pay days"))))) {
                    $dueDate = date("m/d/Y", strtotime(date("m/$selectedTerm->day_of_month_due/Y")." +1 month"));
                } else {
                    $dueDate = date("m/$selectedTerm->day_of_month_due/Y");
                }
            }
        }

        $categories = $this->expenses_model->get_transaction_categories($purchaseOrderId, 'Purchase Order');
        $items = $this->expenses_model->get_transaction_items($purchaseOrderId, 'Purchase Order');

        $linkableTransactions = [];

        $purchaseOrders = $this->expenses_model->get_vendor_open_purchase_orders($bill->vendor_id);

        foreach ($purchaseOrders as $purchaseOrder) {
            $balance = '$'.number_format(floatval(str_replace(',', '', $purchaseOrder->remaining_balance)), 2, '.', ',');
            $total = '$'.number_format(floatval(str_replace(',', '', $purchaseOrder->total_amount)), 2, '.', ',');

            if($purchaseOrder->status === "1" && array_search($purchaseOrder->id, array_column($linkedTransactions, 'linked_transaction_id')) === false) {
                $linkableTransactions[] = [
                    'type' => 'Purchase Order',
                    'data_type' => 'purchase-order',
                    'id' => $purchaseOrder->id,
                    'number' => $purchaseOrder->purchase_order_no === null || $purchaseOrder->purchase_order_no === '' ? '' : $purchaseOrder->purchase_order_no,
                    'date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'formatted_date' => date("F j", strtotime($purchaseOrder->purchase_order_date)),
                    'total' => str_replace('$-', '-$', $total),
                    'balance' => str_replace('$-', '-$', $balance)
                ];
            }
        }

        $this->page_data['linkableTransactions'] = $linkableTransactions;
        $this->page_data['due_date'] = $dueDate;
        $this->page_data['tags'] = $this->tags_model->get_transaction_tags('Purchase Order', $purchaseOrderId);
        $this->page_data['purchaseOrder'] = $purchaseOrder;
        $this->page_data['total_payment'] = number_format(floatval($totalPayment), 2, '.', ',');
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['term'] = $selectedTerm;

        $this->load->view('v2/includes/accounting/modal_forms/bill_modal', $this->page_data);
    }
}
