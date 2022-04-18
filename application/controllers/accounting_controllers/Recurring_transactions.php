<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recurring_transactions extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_recurring_transactions_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('vendors_model');
        $this->load->model('accounting_bank_deposit_model');
        $this->load->model('accounting_transfer_funds_model');
        $this->load->model('accounting_journal_entries_model');
        $this->load->model('expenses_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('tags_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('payment_records_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_refund_receipt_model');
        $this->load->model('accounting_delayed_credit_model');
        $this->load->model('accounting_delayed_charge_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('invoice_settings_model');

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
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
            "assets/js/accounting/recurring-transactions.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/recurring_transactions', $this->page_data);
    }

    public function load_recurring_transactions()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];

        $where = [
            'company_id' => getLoggedCompanyID()
        ];

        if($post['type'] !== "all") {
            $where['recurring_type'] = $post['type'];
        }

        if($post['transaction_type'] !== "all") {
            $where['txn_type'] = $post['transaction_type'];
        }

        $items = $this->accounting_recurring_transactions_model->getCompanyRecurringTransactions($where, $columnName, $order);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($items) > 0) {
            foreach($items as $item) {
                switch($item['txn_type']) {
                    case 'expense' :
                        $expense = $this->vendors_model->get_expense_by_id($item['txn_id']);
                        $total = number_format($expense->total_amount, 2, '.', ',');

                        switch($expense->payee_type) {
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
                    break;
                    case 'check' :
                        $check = $this->vendors_model->get_check_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($check->total_amount, 2, '.', ',');

                        switch($check->payee_type) {
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
                    break;
                    case 'bill' :
                        $bill = $this->vendors_model->get_bill_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($bill->total_amount, 2, '.', ',');
                        $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'purchase order' :
                        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($purchaseOrder->total_amount, 2, '.', ',');
                        $payee = $this->vendors_model->get_vendor_by_id($purchaseOrder->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'vendor credit' :
                        $vCredit = $this->vendors_model->get_vendor_credit_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($vCredit->total_amount, 2, '.', ',');
                        $payee = $this->vendors_model->get_vendor_by_id($vCredit->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'credit card credit' :
                        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($ccCredit->total_amount, 2, '.', ',');

                        switch($ccCredit->payee_type) {
                            case 'vendor':
                                $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'customer':
                                $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                            break;
                            case 'employee':
                                $payee = $this->users_model->getUser($ccCredit->payee_id);
                                $payeeName = $payee->FName . ' ' . $payee->LName;
                            break;
                        }
                    break;
                    case 'deposit' :
                        $deposit = $this->accounting_bank_deposit_model->getById($item['txn_id'], logged('company_id'));
                        $total = number_format($deposit->total_amount, 2, '.', ',');
                        $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);
                        $flag = true;

                        foreach($funds as $fund) {
                            if($fund->received_from_key !== $funds[0]->received_from_key && $fund->received_from_id !== $funds[0]->received_from_id) {
                                $flag = false;
                                break;
                            }
                        }

                        if($flag) {
                            switch($funds[0]->received_from_key) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($funds[0]->received_from_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($funds[0]->received_from_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($funds[0]->received_from_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }
                        } else {
                            $payeeName = '';
                        }
                    break;
                    case 'transfer' :
                        $transfer = $this->accounting_transfer_funds_model->getById($item['txn_id'], logged('company_id'));
                        $total = number_format($transfer->transfer_amount, 2, '.', ',');
                        $payeeName = '';
                    break;
                    case 'journal entry' :
                        $total = '0.00';
                        $payeeName = '';
                    break;
                    case 'npcharge' :
                        $charge = $this->accounting_delayed_charge_model->getDelayedChargeDetails($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($charge->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($charge->total_amount, 2, '.', ',');
                    break;
                    case 'npcredit' :
                        $credit = $this->accounting_delayed_credit_model->getDelayedCreditDetails($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($credit->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($credit->total_amount, 2, '.', ',');
                    break;
                    case 'credit memo' :
                        $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($creditMemo->total_amount, 2, '.', ',');
                    break;
                    case 'invoice' :
                        $invoice = $this->invoice_model->getinvoice($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($invoice->grand_total, 2, '.', ',');
                    break;
                    case 'refund' :
                        $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($refundReceipt->total_amount, 2, '.', ',');
                    break;
                    case 'sales receipt' :
                        $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($salesReceipt->total_amount, 2, '.', ',');
                    break;
                }

                $previous = !is_null($item['previous_date']) && $item['previous_date'] !== '' ? date("m/d/Y", strtotime($item['previous_date'])) : null;
                $next = date("m/d/Y", strtotime($item['next_date']));

                $every = $item['recurr_every'];
                switch ($item['recurring_interval']) {
                    case 'daily' :
                        $interval = 'Every Day';

                        if(intval($every) > 1) {
                            $interval = "Every $every Days";
                        }
                    break;
                    case 'weekly' :
                        $interval = 'Every Week';

                        if(intval($every) > 1) {
                            $interval = "Every $every Weeks";
                        }
                    break;
                    case 'monthly' :
                        $interval = 'Every Month';

                        if(intval($every) > 1) {
                            $interval = "Every $every Months";
                        }
                    break;
                    case 'yearly' :
                        $interval = 'Every Year';
                    break;
                    default :
                        $interval = '';
                        $previous = '';
                        $next = '';
                    break;
                }

                if($search !== "") {
                    if(stripos($item['template_name'], $search) !== false) {
                        $data[] = [
                            'id' => $item['id'],
                            'template_name' => $item['template_name'],
                            'recurring_type' => ucfirst($item['recurring_type']),
                            'txn_type' => ucwords(str_replace('np', '', $item['txn_type'])),
                            'txn_id' => $item['txn_id'],
                            'recurring_interval' => $interval,
                            'previous_date' => $previous,
                            'next_date' => $item['status'] === "2" ? "Paused" : $next,
                            'customer_vendor' => $payeeName,
                            'amount' => $total,
                            'status' => $item['status']
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $item['id'],
                        'template_name' => $item['template_name'],
                        'recurring_type' => ucfirst($item['recurring_type']),
                        'txn_type' => ucwords(str_replace('np', '', $item['txn_type'])),
                        'txn_id' => $item['txn_id'],
                        'recurring_interval' => $interval,
                        'previous_date' => $previous,
                        'next_date' => $item['status'] === "2" ? "Paused" : $next,
                        'customer_vendor' => $payeeName,
                        'amount' => $total,
                        'status' => $item['status']
                    ];
                }
            }
        }

        usort($data, function($a, $b) use ($columnName, $order) {
            switch($columnName) {
                case 'template_name' :
                    if($order === 'asc') {
                        return strcmp($a['template_name'], $b['template_name']);
                    } else {
                        return strcmp($b['template_name'], $a['template_name']);
                    }
                break;
                case 'txn_type' :
                    if($order === 'asc') {
                        return strcmp($a['txn_type'], $b['txn_type']);
                    } else {
                        return strcmp($b['txn_type'], $a['txn_type']);
                    }
                break;
                case 'previous_date' :
                    if($order === 'asc') {
                        return strtotime($a['previous_date']) > strtotime($b['previous_date']);
                    } else {
                        return strtotime($a['previous_date']) < strtotime($b['previous_date']);
                    }
                break;
                case 'next_date' :
                    if($order === 'asc') {
                        return strtotime($a['next_date']) > strtotime($b['next_date']);
                    } else {
                        return strtotime($a['next_date']) < strtotime($b['next_date']);
                    }
                break;
            }
        });

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($items),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function delete($id)
    {
        $result = [];
        $recurringData = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

        switch($recurringData->txn_type) {
            case 'invoice' :
                $deleteTransac = $this->invoice_model->delete_invoice($recurringData->txn_id);
                $this->invoice_model->delete_items($recurringData->txn_id);
            break;
            case 'credit memo' :
                $deleteTransac = $this->accounting_credit_memo_model->deleteCreditMemo($recurringData->txn_id);
                $this->accounting_credit_memo_model->delete_customer_transaction_items('Credit Memo', $recurringData->txn_id);
            break;
            case 'sales receipt' :
                $deleteTransac = $this->accounting_sales_receipt_model->deleteSalesReceipt($recurringData->txn_id);
                $this->accounting_credit_memo_model->delete_customer_transaction_items('Sales Receipt', $recurringData->txn_id);
            break;
            case 'refund' :
                $deleteTransac = $this->accounting_refund_receipt_model->deleteRefundReceipt($recurringData->txn_id);
                $this->accounting_credit_memo_model->delete_customer_transaction_items('Refund Receipt', $recurringData->txn_id);
            break;
            case 'npcharge' :
                $deleteTransac = $this->accounting_delayed_charge_model->deleteDelayedCharge($recurringData->txn_id);
                $this->accounting_credit_memo_model->delete_customer_transaction_items('Delayed Charge', $recurringData->txn_id);
            break;
            case 'npcredit' :
                $deleteTransac = $this->accounting_delayed_credit_model->deleteDelayedCredit($recurringData->txn_id);
                $this->accounting_credit_memo_model->delete_customer_transaction_items('Delayed Credit', $recurringData->txn_id);
            break;
            case 'expense' :
                $deleteTransac = $this->expenses_model->delete_expense($recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_categories('Expense', $recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_items('Expense', $recurringData->txn_id);
            break;
            case 'check' :
                $deleteTransac = $this->expenses_model->delete_check($recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_categories('Check', $recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_items('Check', $recurringData->txn_id);
            break;
            case 'bill' :
                $deleteTransac = $this->expenses_model->delete_bill($recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_categories('Bill', $recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_items('Bill', $recurringData->txn_id);
            break;
            case 'purchase order' :
                $deleteTransac = $this->expenses_model->delete_purchase_order($recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_categories('Purchase Order', $recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_items('Purchase Order', $recurringData->txn_id);
            break;
            case 'vendor credit' :
                $deleteTransac = $this->expenses_model->delete_vendor_credit($recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_categories('Vendor Credit', $recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_items('Vendor Credit', $recurringData->txn_id);
            break;
            case 'credit card credit' :
                $deleteTransac = $this->expenses_model->delete_credit_card_credit($recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_categories('Credit Card Credit', $recurringData->txn_id);
                $this->expenses_model->delete_vendor_transaction_items('Credit Card Credit', $recurringData->txn_id);
            break;
            case 'deposit' :
                $deleteTransac = $this->accounting_bank_deposit_model->delete_deposit($recurringData->txn_id);
                $this->accounting_bank_deposit_model->deleteFunds($recurringData->txn_id);
            break;
            case 'transfer' :
                $deleteTransac = $this->accounting_transfer_funds_model->delete_transfer($recurringData->txn_id);
            break;
            case 'journal entry' :
                $deleteTransac = $this->accounting_journal_entries_model->delete_entry($recurringData->txn_id);
                $this->accounting_journal_entries_model->deleteEntries($recurringData->txn_id);
            break;
        }

        $delete = $this->accounting_recurring_transactions_model->delete($id);

        $result['success'] = $delete;
        $result['message'] = $delete ? 'Successfully Deleted' : 'Failed to Delete';

        echo json_encode($result);
        exit;
    }

    public function get($id)
    {
        $data = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

        switch($data->txn_type) {
            case 'deposit' :
                $data->transaction = $this->accounting_bank_deposit_model->getById($data->txn_id, logged('company_id'));

                $tags = [];
                if($data->transaction->tags !== null) {
                    foreach(json_decode($data->transaction->tags, true) as $tag) {
                        $t = $this->tags_model->getTagById($tag);
                        $tags[] = [
                            'id' => $tag,
                            'name' => $t->name
                        ];
                    }
                }

                $data->transaction->tags = json_encode($tags);
                $data->transaction->items = $this->accounting_bank_deposit_model->getFunds($data->transaction->id);
            break;
            case 'transfer' :
                $data->transaction = $this->accounting_transfer_funds_model->getById($data->txn_id, logged('company_id'));
            break;
            case 'journal entry' :
                $data->transaction = $this->accounting_journal_entries_model->getById($data->txn_id, logged('company_id'));
                $data->transaction->items = $this->accounting_journal_entries_model->getEntries($data->transaction->id);
            break;
        }

        $result = [
            'data' => $data,
            'success' => $data ? true : false,
            'message' => $data ? 'Success' : 'Error'
        ];

        echo json_encode($result);
        exit;
    }

    public function update($type, $id)
    {
        $data = $this->input->post();

        switch($type) {
            case 'deposit' :
                $this->form_validation->set_rules('bank_account', 'Bank Account', 'required');

                if($data['cash_back_amount'] !== "") {
                    $this->form_validation->set_rules('cash_back_target', 'Cash back account', 'required|differs[bank_account]');
                }

                $this->form_validation->set_rules('account[]', 'Account', 'required');
                $this->form_validation->set_rules('amount[]', 'Amount', 'required');
            break;
            case 'transfer' :
                $this->form_validation->set_rules('transfer_from', 'Transfer From Account', 'required');
                $this->form_validation->set_rules('transfer_to', 'Transfer To Account', 'required|differs[transfer_from]');
                $this->form_validation->set_rules('transfer_amount', 'Amount', 'required');
            break;
            case 'expense' :
                $this->form_validation->set_rules('expense_payment_account', 'Payment account', 'required');

                if (isset($data['expense_account'])) {
                    $this->form_validation->set_rules('expense_account[]', 'Expense name', 'required');
                    $this->form_validation->set_rules('category_amount[]', 'Category amount', 'required');
                }
        
                if (isset($data['item'])) {
                    $this->form_validation->set_rules('item[]', 'Item', 'required');
                    $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
                    $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
                }
            break;
            case 'check' :
                $this->form_validation->set_rules('bank_account', 'Bank account', 'required');

                if (isset($data['expense_account'])) {
                    $this->form_validation->set_rules('expense_account[]', 'Expense name', 'required');
                    $this->form_validation->set_rules('category_amount[]', 'Category amount', 'required');
                }
        
                if (isset($data['item'])) {
                    $this->form_validation->set_rules('item[]', 'Item', 'required');
                    $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
                    $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
                }
            break;
            case 'bill' :
                $this->form_validation->set_rules('vendor_id', 'Vendor', 'required');

                if (isset($data['expense_account'])) {
                    $this->form_validation->set_rules('expense_account[]', 'Expense name', 'required');
                    $this->form_validation->set_rules('category_amount[]', 'Category amount', 'required');
                }
        
                if (isset($data['item'])) {
                    $this->form_validation->set_rules('item[]', 'Item', 'required');
                    $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
                    $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
                }
            break;
            case 'purchase-order' :
                $this->form_validation->set_rules('vendor_id', 'Vendor', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
        
                if (isset($data['expense_account'])) {
                    $this->form_validation->set_rules('expense_account[]', 'Expense name', 'required');
                    $this->form_validation->set_rules('category_amount[]', 'Category amount', 'required');
                }
        
                if (isset($data['item'])) {
                    $this->form_validation->set_rules('item[]', 'Item', 'required');
                    $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
                    $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
                }
            break;
            case 'vendor-credit' :
                $this->form_validation->set_rules('vendor_id', 'Vendor', 'required');

                if (isset($data['expense_account'])) {
                    $this->form_validation->set_rules('expense_account[]', 'Expense name', 'required');
                    $this->form_validation->set_rules('category_amount[]', 'Category amount', 'required');
                }
        
                if (isset($data['item'])) {
                    $this->form_validation->set_rules('item[]', 'Item', 'required');
                    $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
                    $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
                }
            break;
            case 'credit-card-credit' :
                $this->form_validation->set_rules('bank_credit_account', 'Bank/Credit account', 'required');

                if (isset($data['expense_account'])) {
                    $this->form_validation->set_rules('expense_account[]', 'Expense name', 'required');
                    $this->form_validation->set_rules('category_amount[]', 'Category amount', 'required');
                }
        
                if (isset($data['item'])) {
                    $this->form_validation->set_rules('item[]', 'Item', 'required');
                    $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
                    $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
                }
            break;
            case 'invoice' :
                $this->form_validation->set_rules('customer', 'Customer', 'required');
                $this->form_validation->set_rules('item[]', 'Item', 'required');
                $this->form_validation->set_rules('quantity[]', 'Item total', 'required');
                $this->form_validation->set_rules('item_amount[]', 'Item total', 'required');
                $this->form_validation->set_rules('item_total[]', 'Item total', 'required');
            break;
            case 'credit-memo' :
                $this->form_validation->set_rules('item[]', 'Item', 'required');
            break;
            case 'sales-receipt' :
                $this->form_validation->set_rules('item[]', 'Item', 'required');
            break;
            case 'refund' :
                $this->form_validation->set_rules('item[]', 'Item', 'required');
            break;
            case 'npcharge' :
                $this->form_validation->set_rules('item[]', 'Item', 'required');
                $this->form_validation->set_rules('customer', 'Customer', 'required');
            break;
            case 'npcredit' :
                $this->form_validation->set_rules('item[]', 'Item', 'required');
                $this->form_validation->set_rules('customer', 'Customer', 'required');
            break;
        }

        $this->form_validation->set_rules('template_name', 'Template Name', 'required');
        $this->form_validation->set_rules('recurring_type', 'Recurring Type', 'required');

        if($data['recurring_type'] !== 'unscheduled') {
            $this->form_validation->set_rules('recurring_interval', 'Recurring interval', 'required');

            if($data['recurring_interval'] !== 'daily') {
                if($data['recurring_interval'] === 'monthly') {
                    $this->form_validation->set_rules('recurring_week', 'Recurring week', 'required');
                } else if($data['recurring_interval'] === 'yearly') {
                    $this->form_validation->set_rules('recurring_month', 'Recurring month', 'required');
                }

                $this->form_validation->set_rules('recurring_day', 'Recurring day', 'required');
            }
            if($data['recurring_interval'] !== 'yearly') {
                $this->form_validation->set_rules('recurr_every', 'Recurring interval', 'required');
            }
            $this->form_validation->set_rules('end_type', 'Recurring end type', 'required');

            if($data['end_type'] === 'by') {
                $this->form_validation->set_rules('end_date', 'Recurring end date', 'required');
            } else if($data['end_type'] === 'after') {
                $this->form_validation->set_rules('max_occurence', 'Recurring max occurence', 'required');
            }
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            if($type === 'journal_entry') {
                $totalDebit = array_sum(array_map(function($item) { 
                    return $item;
                }, $data['debits']));
        
                $totalCredit = array_sum(array_map(function($item) { 
                    return $item;
                }, $data['credits']));

                if(isset($data['accounts']) && count($data['accounts']) < 2 || !isset($data['accounts'])) {
                    $return['data'] = null;
                    $return['success'] = false;
                    $return['message'] = 'You must fill out at least two detail lines.';

                    echo json_encode($return);
                    exit;
                } else if($totalDebit !== $totalCredit) {
                    $return['data'] = null;
                    $return['success'] = false;
                    $return['message'] = 'Please balance debits and credits.';

                    echo json_encode($return);
                    exit;
                }
            }

            $recurringData = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

            if($data['recurring_type'] !== 'unscheduled') {
                $currentDate = date("m/d/Y", strtotime($recurringData->previous_date));
                $startDate = !is_null($recurringData->previous_date) ? $currentDate : date("m/d/Y", strtotime($data['start_date']));
                $startDate = $data['start_date'] === '' ? date("m/d/Y") : $startDate;
                $every = $data['recurr_every'];

                switch($data['recurring_interval']) {
                    case 'daily' :
                        $next = $startDate;
                    break;
                    case 'weekly' :
                        $days = [
                            'sunday',
                            'monday',
                            'tuesday',
                            'wednesday',
                            'thursday',
                            'friday',
                            'saturday'
                        ];

                        $day = $data['recurring_day'];
                        $dayNum = array_search($day, $days);
                        $next = $startDate;

                        if(intval(date("w", strtotime($next))) !== $dayNum) {
                            do {
                                $next = date("m/d/Y", strtotime("$next +1 day"));
                            } while(intval(date("w", strtotime($next))) !== $dayNum);
                        }
                    break;
                    case 'monthly' :
                        if($data['recurring_week'] === 'day') {
                            $day = $data['recurring_day'] === 'last' ? 't' : $data['recurring_day'];
                            $next = date("m/$day/Y", strtotime($startDate));

                            if(strtotime(date("m/d/Y")) > strtotime($next)) {
                                $next = date("m/$day/Y", strtotime("$next +$every months"));
                            }
                        } else {
                            $week = $data['recurring_week'];
                            $day = $data['recurring_day'];
                            $next = date("m/d/Y", strtotime("$week $day ".date("Y-m", strtotime($startDate))));

                            if(strtotime(date("m/d/Y")) > strtotime($next)) {
                                $next = date("m/d/Y", strtotime("$week $day ".date("Y-m", strtotime("$startDate +$every months"))));
                            }
                        }
                    break;
                    case 'yearly' :
                        $month = $data['recurring_month'];
                        $day = $data['recurring_day'];
                        $previous = date("$month/$day/Y", strtotime($startDate));
                        $next = date("$month/$day/Y", strtotime($startDate));

                        if(strtotime(date("m/d/Y")) > strtotime($next)) {
                            $next = date("$month/$day/Y", strtotime("$next +1 year"));
                        }
                    break;
                }
            }

            $recurringData = [
                'template_name' => $data['template_name'],
                'recurring_type' => $data['recurring_type'],
                'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['days_in_advance'] !== '' ? $data['days_in_advance'] : null : null,
                'recurring_interval' => $data['recurring_interval'],
                'recurring_month' => $data['recurring_interval'] === 'yearly' ? $data['recurring_month'] : null,
                'recurring_week' => $data['recurring_interval'] === 'monthly' ? $data['recurring_week'] : null,
                'recurring_day' => $data['recurring_interval'] !== 'daily' ? $data['recurring_day'] : null,
                'recurr_every' => $data['recurring_interval'] !== 'yearly' ? $data['recurr_every'] : null,
                'start_date' => $data['recurring_type'] !== 'unscheduled' ? $data['start_date'] !== "" ? date('Y-m-d', strtotime($data['start_date'])) : null : null,
                'end_type' => $data['end_type'],
                'end_date' => $data['end_type'] === 'by' ? date('Y-m-d', strtotime($data['end_date'])) : null,
                'max_occurrences' => $data['end_type'] === 'after' ? $data['max_occurrence'] : null,
                'next_date' => date("Y-m-d", strtotime($next))
            ];

            $recurringUpdate = $this->accounting_recurring_transactions_model->updateRecurringTransaction($id, $recurringData);

            if($recurringUpdate) {
                $recurringData = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

                switch($type) {
                    case 'deposit' :
                        $transactionUpdate = $this->update_deposit($data, $recurringData);
                    break;
                    case 'transfer' :
                        $transactionUpdate = $this->update_transfer($data, $recurringData);
                    break;
                    case 'journal-entry' :
                        $transactionUpdate = $this->update_journal($data, $recurringData);
                    break;
                    case 'expense' :
                        $transactionUpdate = $this->update_expense($data, $recurringData);
                    break;
                    case 'check' :
                        $transactionUpdate = $this->update_check($data, $recurringData);
                    break;
                    case 'bill' :
                        $transactionUpdate = $this->update_bill($data, $recurringData);
                    break;
                    case 'purchase-order' :
                        $transactionUpdate = $this->update_purchase_order($data, $recurringData);
                    break;
                    case 'vendor-credit' :
                        $transactionUpdate = $this->update_vendor_credit($data, $recurringData);
                    break;
                    case 'credit-card-credit' :
                        $transactionUpdate = $this->update_credit_card_credit($data, $recurringData);
                    break;
                    case 'invoice' :
                        $transactionUpdate = $this->update_invoice($data, $recurringData);
                    break;
                    case 'credit-memo' :
                        $transactionUpdate = $this->update_credit_memo($data, $recurringData);
                    break;
                    case 'sales-receipt' :
                        $transactionUpdate = $this->update_sales_receipt($data, $recurringData);
                    break;
                    case 'refund' :
                        $transactionUpdate = $this->update_refund_receipt($data, $recurringData);
                    break;
                    case 'npcharge' :
                        $transactionUpdate = $this->update_delayed_charge($data, $recurringData);
                    break;
                    case 'npcredit' :
                        $transactionUpdate = $this->update_delayed_credit($data, $recurringData);
                    break;
                }
            }

            $return['success'] = $recurringUpdate && $transactionUpdate ? true : false;
            $return['message'] =  $recurringUpdate && $transactionUpdate ? 'Update Successful!' : 'An unexpected error occured!';
        }

        echo json_encode($return);
    }

    private function update_deposit($data, $recurringData)
    {
        $this->load->model('accounting_bank_deposit_model');
        $bankAccount = explode('-', $data['bank_account']);
        $cashBackTarget = explode('-', $data['cash_back_target']);

        $totalAmount = array_sum(array_map(function($item) {
            return floatval($item);
        }, $data['amount']));

        $totalAmount = $totalAmount - floatval($data['cash_back_amount']);

        $depositData = [
            'account_key' => $bankAccount[0],
            'account_id' => $bankAccount[1],
            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
            'total_amount' => number_format($totalAmount, 2, '.', ','),
            'cash_back_account_key' => $cashBackTarget[0],
            'cash_back_account_id' => $cashBackTarget[1],
            'cash_back_memo' => $data['cash_back_memo'],
            'cash_back_amount' => $data['cash_back_amount'],
            'memo' => $data['memo'],
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $transactionUpdate = $this->accounting_bank_deposit_model->update($recurringData->txn_id, $depositData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Deposit', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Deposit', $recurringData->txn_id);

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Deposit', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Deposit',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Deposit', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            // NEW
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Deposit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Deposit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->accounting_bank_deposit_model->deleteFunds($recurringData->txn_id);

            $fundsData = [];
            foreach ($data['funds_account'] as $key => $value) {
                $receivedFrom = explode('-', $data['received_from'][$key]);

                $fundsData = [
                    'bank_deposit_id' => $recurringData->txn_id,
                    'received_from_key' => $receivedFrom[0],
                    'received_from_id' => $receivedFrom[1],
                    'received_from_account_id' => $value,
                    'description' => $data['description'][$key],
                    'payment_method' => $data['payment_method'][$key],
                    'ref_no' => $data['reference_no'][$key],
                    'amount' => $data['amount'][$key]
                ];

                $this->accounting_bank_deposit_model->insert_fund($fundsData);
            }
        }

        return $transactionUpdate;
    }

    private function update_transfer($data, $recurringData)
    {
        $this->load->model('accounting_transfer_funds_model');

        $transferData = [
            'transfer_from_account_id' => $data['transfer_from_account'],
            'transfer_to_account_id' => $data['transfer_to_account'],
            'transfer_amount' => $data['transfer_amount'],
            'transfer_memo' => $data['memo'],
        ];

        $transactionUpdate = $this->accounting_transfer_funds_model->update($recurringData->txn_id, $transferData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Transfer', $recurringData->txn_id);

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Transfer', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Transfer',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Transfer',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }
        }
        
        return $transactionUpdate;
    }

    private function update_journal($data, $recurringData)
    {
        $this->load->model('accounting_journal_entries_model');
        $entryData = [
            'memo' => $data['memo']
        ];

        $transactionUpdate = $this->accounting_journal_entries_model->update($recurringData->txn_id, $entryData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Journal', $recurringData->txn_id);

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Journal', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            $deleteEntries = $this->accounting_journal_entries_model->deleteEntries($recurringData->txn_id);

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Journal',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Journal',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $entryItems = [];
            foreach ($data['accounts'] as $key => $value) {
                $name = explode('-', $data['names'][$key]);

                $entryItems[] = [
                    'journal_entry_id' => $recurringData->txn_id,
                    'account_id' => $value,
                    'debit' => $data['debits'][$key],
                    'credit' => $data['credits'][$key],
                    'description' => $data['descriptions'][$key],
                    'name_key' => $name[0],
                    'name_id' => $name[1]
                ];
            }

            $entryItemsId = $this->accounting_journal_entries_model->insertEntryItems($entryItems);
        }

        return $transactionUpdate;
    }

    private function update_expense($data, $recurringData)
    {
        $payee = explode('-', $data['payee']);
        $expenseData = [
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'payment_account_id' => $data['expense_payment_account'],
            'payment_method_id' => $data['payment_method'],
            'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
            'memo' => $data['memo'],
            'total_amount' => $data['total_amount']
        ];

        $transactionUpdate = $this->vendors_model->update_expense($recurringData->txn_id, $expenseData);

        if ($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Expense', $recurringData->txn_id);

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Expense', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Expense',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Expense', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Expense',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Expense',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->update_categories('Expense', $recurringData->txn_id, $data);
            $this->update_items('Expense', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_check($data, $recurringData)
    {
        $payee = explode('-', $data['payee']);

        $checkData = [
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'bank_account_id' => $data['bank_account'],
            'mailing_address' => nl2br($data['mailing_address']),
            'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
            'check_no' => isset($data['print_later']) ? null : $data['check_no'] === '' ? null : $data['check_no'],
            'to_print' => $data['print_later'],
            'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
            'memo' => $data['memo'],
            'total_amount' => $data['total_amount']
        ];

        $transactionUpdate = $this->vendors_model->update_check($recurringData->txn_id, $checkData);

        if ($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Check', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Check', $recurringData->txn_id);

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Check', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Check',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Check', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Check',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Check',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->update_categories('Check', $recurringData->txn_id, $data);
            $this->update_items('Check', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_bill($data, $recurringData)
    {
        $billData = [
            'vendor_id' => $data['vendor_id'],
            'mailing_address' => $data['mailing_address'],
            'term_id' => $data['term_id'],
            'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
            'memo' => $data['memo'],
            'remaining_balance' => $data['total_amount'],
            'total_amount' => $data['total_amount']
        ];

        $transactionUpdate = $this->vendors_model->update_bill($recurringData->txn_id, $billData);

        if ($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Bill', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Bill', $recurringData->txn_id);

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Bill', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Bill',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Bill', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Bill',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Bill',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->update_categories('Bill', $recurringData->txn_id, $data);
            $this->update_items('Bill', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_purchase_order($data, $recurringData)
    {
        $purchOrder = [
            'vendor_id' => $data['vendor_id'],
            'email' => $data['email'],
            'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
            'mailing_address' => nl2br($data['mailing_address']),
            'customer_id' => $data['customer'],
            'shipping_address' => nl2br($data['shipping_address']),
            'ship_via' => $data['ship_via'],
            'message_to_vendor' => $data['message_to_vendor'],
            'memo' => $data['memo'],
            'total_amount' => $data['total_amount']
        ];

        $transactionUpdate = $this->vendors_model->update_purchase_order($recurringData->txn_id, $purchOrder);

        if ($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Purchase Order', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Purchase Order', $recurringData->txn_id);

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Purchase Order', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Purchase Order',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Purchase Order', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Purchase Order',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Purchase Order',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->update_categories('Purchase Order', $recurringData->txn_id, $data);
            $this->update_items('Purchase Order', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_vendor_credit($data, $recurringData)
    {
        $vCredit = [
            'vendor_id' => $data['vendor_id'],
            'mailing_address' => $data['mailing_address'],
            'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
            'memo' => $data['memo'],
            'total_amount' => $data['total_amount']
        ];

        $transactionUpdate = $this->vendors_model->update_vendor_credit($recurringData->txn_id, $vCredit);

        if ($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Vendor Credit', $recurringData->txn_id);

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Vendor Credit', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Vendor Credit',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Vendor Credit', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Vendor Credit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Vendor Credit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->update_categories('Vendor Credit', $recurringData->txn_id, $data);
            $this->update_items('Vendor Credit', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_credit_card_credit($data, $recurringData)
    {
        $payee = explode('-', $data['payee']);

        $creditData = [
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'bank_credit_account_id' => $data['bank_credit_account'],
            'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
            'memo' => $data['memo'],
            'total_amount' => $data['total_amount']
        ];

        $transactionUpdate = $this->vendors_model->update_credit_card_credit($recurringData->txn_id, $creditData);

        if ($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('CC Credit', $recurringData->txn_id);

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'CC Credit', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'CC Credit',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'CC Credit', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'CC Credit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'CC Credit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->update_categories('Credit Card Credit', $recurringData->txn_id, $data);
            $this->update_items('Credit Card Credit', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_invoice($data, $recurringData)
    {
        if ($data['credit_card_payments'] == 1) {
            $credit_card = 'Credit Card';
        } else {
            $credit_card = '0';
        }

        if ($data['bank_transfer'] == 1) {
            $bank_transfer = 'Bank Transfer';
        } else {
            $bank_transfer = '0';
        }

        if ($data['instapay'] == 1) {
            $instapay = 'Instapay';
        } else {
            $instapay = '0';
        }

        if ($data['check'] == 1) {
            $check = 'Check';
        } else {
            $check = '0';
        }

        if ($data['cash'] == 1) {
            $cash = 'Cash';
        } else {
            $cash = '0';
        }

        if ($data['deposit'] == 1) {
            $deposit = 'Deposit';
        } else {
            $deposit = '0';
        }

        $invoiceData = [
            'customer_id' => $data['customer'],
            'job_location' => $data['job_location'],
            'job_name' => $data['job_name'],
            'work_order_number' => $data['job_no'],
            'po_number' => $data['purchase_order_no'],
            'invoice_number' => $data['invoice_no'],
            'date_issued' => date("Y-m-d", strtotime($data['date_issued'])),
            'due_date' => date("Y-m-d", strtotime($data['due_date'])),
            'status' => $data['status'],
            'customer_email' => $data['customer_email'],
            'billing_address' => nl2br($data['billing_address']),
            'shipping_to_address' => nl2br($data['shipping_to']),
            'ship_via' => $data['ship_via'],
            'shipping_date' => date("Y-m-d", strtotime($data['shipping_date'])),
            'tracking_number' => $data['tracking_no'],
            'terms' => $data['terms'],
            'location_scale' => $data['location_of_sale'],
            'attachments' => json_encode($data['attachments']),
            'tags' => json_encode($data['tags']),
            'total_due' => $data['total_amount'],
            'balance' => $data['total_amount'],
            'deposit_request' => $data['deposit_amount'],
            'deposit_request_type' => $data['deposit_request_type'],
            'payment_methods' => $credit_card.','.$bank_transfer.','.$instapay.','.$check.','.$cash.','.$deposit,
            'message_to_customer' => $data['message_to_customer'],
            'terms_and_conditions' => $data['terms_and_conditions'],
            'sub_total' => $data['subtotal'],
            'taxes' => $data['tax_total'],
            'adjustment_name' => $data['adjustment_name'],
            'adjustment_value' => $data['adjustment_value'],
            'grand_total' => $data['total_amount']
        ];

        $transactionUpdate = $this->invoice_model->update_invoice($recurringData->txn_id, $invoiceData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Invoice', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Invoice', $recurringData->txn_id);

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Invoice', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Invoice', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Invoice',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Invoice',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Invoice',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            $invoiceItems = $this->invoice_model->get_invoice_items($recurringData->txn_id);
            $this->invoice_model->delete_items($recurringData->txn_id);

            foreach($data['item'] as $key => $input) {
                $explode = explode('-', $input);

                if($explode[0] === 'package') {
                    $packageItems = $this->items_model->get_package_items($explode[1]);
                }

                $invoiceItem = [
                    'invoice_id' => $recurringData->txn_id,
                    'items_id' => $explode[0] === 'item' ? $explode[1] : '',
                    'location_id' => $data['location'][$key],
                    'qty' => $data['quantity'][$key],
                    'package_id' => $explode[0] === 'package' ? $explode[1] : '',
                    'package_item_details' => $explode[0] === 'package' ? json_encode($packageItems) : null,
                    'cost' => $data['item_amount'][$key],
                    'tax' => $data['item_tax'][$key],
                    'discount' => $data['discount'][$key],
                    'total' => $data['item_total'][$key],
                    'tax_rate_used' => $data['item_tax'][$key]
                ];

                if(!is_null($invoiceItems[$key])) {
                    $invoiceItem['date_craeted'] = date("Y-m-d H:i:s" , strtotime($invoiceItems->date_craeted));
                }

                $addInvoiceItem = $this->invoice_model->add_invoice_items($invoiceItem);
            }
        }

        return $transactionUpdate;
    }

    private function update_credit_memo($data, $recurringData)
    {
        $creditMemoData = [
            'customer_id' => $data['customer'],
            'email' => $data['email'],
            'send_later' => !isset($data['template_name']) ? $data['send_later'] : null,
            'credit_memo_date' => !isset($data['template_name']) ? date("Y-m-d", strtotime($data['credit_memo_date'])) : null,
            'billing_address' => nl2br($data['billing_address']),
            'location_of_sale' => $data['location_of_sale'],
            'po_number' => $data['purchase_order_no'],
            'sales_rep' => $data['sales_rep'],
            'message_credit_memo' => $data['message_credit_memo'],
            'message_on_statement' => $data['message_on_statement'],
            'adjustment_name' => $data['adjustment_name'],
            'adjustment_value' => $data['adjustment_value'],
            'balance' => $data['total_amount'],
            'total_amount' => $data['total_amount'],
            'subtotal' => $data['subtotal'],
            'tax_total' => $data['tax_total'],
            'discount_total' => $data['discount_total'],
        ];

        $transactionUpdate = $this->accounting_credit_memo_model->updateCreditMemo($recurringData->txn_id, $creditMemoData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Credit Memo', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Credit Memo', $recurringData->txn_id);

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Credit Memo', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Credit Memo', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            // NEW
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Credit Memo',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Credit Memo',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Credit Memo',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            $this->update_customer_transaction_items('Credit Memo', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_sales_receipt($data, $recurringData)
    {
        $salesReceiptdata = [
            'customer_id' => $data['customer'],
            'email' => $data['email'],
            'billing_address' => nl2br($data['billing_address']),
            'location_of_sale' => $data['location_of_sale'],
            'po_number' => $data['purchase_order_no'],
            'sales_rep' => $data['sales_rep'],
            'payment_method' => $data['payment_method'],
            'reference_no' => $data['ref_no'],
            'deposit_to_account' => $data['deposit_to_account'],
            'message_sales_receipt' => $data['message_sales_receipt'],
            'message_on_statement' => $data['message_on_statement'],
            'adjustment_name' => $data['adjustment_name'],
            'adjustment_value' => $data['adjustment_value'],
            'total_amount' => $data['total_amount'],
            'subtotal' => $data['subtotal'],
            'tax_total' => $data['tax_total'],
            'discount_total' => $data['discount_total']
        ];

        $transactionUpdate = $this->accounting_sales_receipt_model->updateSalesReceipt($recurringData->txn_id, $salesReceiptdata);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Sales Receipt', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Sales Receipt', $recurringData->txn_id);

            // OLD
            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Sales Receipt', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Sales Receipt', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            // NEW
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Sales Receipt',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Sales Receipt',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Sales Receipt',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            $this->update_customer_transaction_items('Sales Receipt', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_refund_receipt($data, $recurringData)
    {
        $refundReceiptData = [
            'customer_id' => $data['customer'],
            'email' => $data['email'],
            'billing_address' => nl2br($data['billing_address']),
            'location_of_sale' => $data['location_of_sale'],
            'po_number' => $data['purchase_order_no'],
            'sales_rep' => $data['sales_rep'],
            'payment_method' => $data['payment_method'],
            'refund_from_account' => $data['refund_from_account'],
            'check_no' => !is_null($data['print_later']) ? null : $data['check_no'],
            'print_later' => $data['print_later'],
            'message_refund_receipt' => $data['message_refund_receipt'],
            'message_on_statement' => $data['message_on_statement'],
            'adjustment_name' => $data['adjustment_name'],
            'adjustment_value' => $data['adjustment_value'],
            'total_amount' => $data['total_amount'],
            'subtotal' => $data['subtotal'],
            'tax_total' => $data['tax_total'],
            'discount_total' => $data['discount_total']
        ];

        $transactionUpdate = $this->accounting_refund_receipt_model->updateRefundReceipt($recurringData->txn_id, $refundReceiptData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Refund Receipt', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Refund Receipt', $recurringData->txn_id);

            // OLD
            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Refund Receipt', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Refund Receipt', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            // NEW
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Refund Receipt',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Refund Receipt',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Refund Receipt',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            $this->update_customer_transaction_items('Refund Receipt', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_delayed_credit($data, $recurringData)
    {
        $delayedCreditData = [
            'customer_id' => $data['customer'],
            'memo' => $data['memo'],
            'adjustment_name' => $data['adjustment_name'],
            'adjustment_value' => $data['adjustment_value'],
            'total_amount' => $data['total_amount'],
            'subtotal' => $data['subtotal'],
            'tax_total' => $data['tax_total'],
            'discount_total' => $data['discount_total']
        ];

        $transactionUpdate = $this->accounting_delayed_credit_model->updateDelayedCredit($recurringData->txn_id, $delayedCreditData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Delayed Credit', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Delayed Credit', $recurringData->txn_id);

            // OLD
            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Delayed Credit', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Delayed Credit', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            // NEW
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Delayed Credit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Delayed Credit',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Delayed Credit',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            $this->update_customer_transaction_items('Delayed Credit', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_delayed_charge($data, $recurringData)
    {
        $delayedChargeData = [
            'customer_id' => $data['customer'],
            'memo' => $data['memo'],
            'adjustment_name' => $data['adjustment_name'],
            'adjustment_value' => $data['adjustment_value'],
            'total_amount' => $data['total_amount'],
            'subtotal' => $data['subtotal'],
            'tax_total' => $data['tax_total'],
            'discount_total' => $data['discount_total'],
        ];

        $transactionUpdate = $this->accounting_delayed_charge_model->updateDelayedCharge($recurringData->txn_id, $delayedChargeData);

        if($transactionUpdate) {
            $attachments = $this->accounting_attachments_model->get_attachments('Delayed Charge', $recurringData->txn_id);
            $tags = $this->tags_model->get_transaction_tags('Delayed Charge', $recurringData->txn_id);

            // OLD
            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(!isset($data['attachments']) || !in_array($attachment->id, $data['attachments'])) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Delayed Charge', 'attachment_id' => $attachment->id, 'linked_id' => $recurringData->txn_id]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if(count($tags) > 0) {
                foreach($tags as $key => $tag) {
                    if(!isset($data['tags']) || !isset($data['tags'][$key])) {
                        $this->tags_model->unlink_tag(['transaction_type' => 'Delayed Charge', 'tag_id' => $tag->id, 'transaction_id' => $recurringData->txn_id]);
                    }
                }
            }

            // NEW
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Delayed Charge',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Delayed Charge',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $recurringData->txn_id,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            if(isset($data['tags']) && is_array($data['tags'])) {
                $order = 1;
                foreach($data['tags'] as $key => $tagId) {
                    $linkTagData = [
                        'transaction_type' => 'Delayed Charge',
                        'transaction_id' => $recurringData->txn_id,
                        'tag_id' => $tagId,
                        'order_no' => $order
                    ];

                    if($tags[$key] === null) {
                        $linkTagId = $this->tags_model->link_tag($linkTagData);
                    } else {
                        $updateOrder = $this->tags_model->update_link($linkTagData);
                    }

                    $order++;
                }
            }

            $this->update_customer_transaction_items('Delayed Charge', $recurringData->txn_id, $data);
        }

        return $transactionUpdate;
    }

    private function update_categories($transactionType, $transactionId, $data)
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);

        if ($data['expense_account'] !== null) {
            foreach ($data['expense_account'] as $index => $value) {
                $categoryDetails = [
                    'expense_account_id' => $value,
                    'category' => $data['category'][$index],
                    'description' => $data['description'][$index],
                    'amount' => $data['category_amount'][$index],
                    'billable' => $data['category_billable'][$index],
                    'markup_percentage' => $data['category_markup'][$index],
                    'tax' => $data['category_tax'][$index],
                    'customer_id' => $data['category_customer'][$index],
                ];

                if (!is_null($categories[$index])) {
                    $this->vendors_model->update_transaction_category_details($categories[$index]->id, $categoryDetails);
                } else {
                    $categoryDetails['transaction_type'] = $transactionType;
                    $categoryDetails['transaction_id'] = $transactionId;

                    $details = [
                        $categoryDetails
                    ];

                    $this->expenses_model->insert_vendor_transaction_categories($details);
                }
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $index => $category) {
                if ($data['expense_account'] === null || $data['expense_account'][$index] === null) {
                    $this->vendors_model->delete_transaction_category($category->id, $transactionType);
                }
            }
        }
    }

    private function update_items($transactionType, $transactionId, $data)
    {
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        if ($data['item'] !== null) {
            foreach ($data['item'] as $index => $value) {
                $itemDetails = [
                    'item_id' => $value,
                    'location_id' => $data['location'][$index],
                    'quantity' => $data['quantity'][$index],
                    'rate' => $data['item_amount'][$index],
                    'discount' => $data['discount'][$index],
                    'tax' => $data['item_tax'][$index],
                    'total' => $data['item_total'][$index]
                ];

                if (!is_null($items[$index])) {
                    $this->vendors_model->update_transaction_item($items[$index]->id, $itemDetails);
                } else {
                    $itemDetails['transaction_type'] = $transactionType;
                    $itemDetails['transaction_id'] = $transactionId;

                    $details = [
                        $itemDetails
                    ];

                    $this->expenses_model->insert_vendor_transaction_items($details);
                }
            }
        }

        if (count($items) > 0) {
            foreach ($items as $index => $item) {
                if ($data['item'] === null || $data['item'][$index] === null) {
                    $this->vendors_model->delete_transaction_item($item->id, $transactionType);
                }
            }
        }
    }

    private function update_customer_transaction_items($transactionType, $transactionId, $data)
    {
        $items = $this->accounting_credit_memo_model->get_customer_transaction_items($transactionType, $transactionId);
        $this->accounting_credit_memo_model->delete_customer_transaction_items($transactionType, $transactionId);

        $newItems = [];
        foreach($data['item'] as $key => $input) {
            $explode = explode('-', $input);

            if($explode[0] === 'package') {
                $packageItems = $this->items_model->get_package_items($explode[1]);
            }

            $itemData = [
                'transaction_type' => $transactionType,
                'transaction_id' => $transactionId,
                'item_id' => $explode[0] === 'item' ? $explode[1] : null,
                'package_id' => $explode[0] === 'package' ? $explode[1] : null,
                'package_item_details' => $explode[0] === 'package' ? json_encode($packageItems) : null,
                'location_id' => $data['location'][$key],
                'quantity' => $data['quantity'][$key],
                'price' => $data['item_amount'][$key],
                'discount' => $data['discount'][$key],
                'tax' => $data['item_tax'][$key],
                'total' => $data['item_total'][$key]
            ];

            if(!is_null($items[$key])) {
                $itemData['created_at'] = date("Y-m-d H:i:s", strtotime($items[$key]->created_at));
            }

            $newItems[] = $itemData;
        }

        $this->accounting_credit_memo_model->insert_transaction_items($newItems);
    }

    public function print()
    {
        $post = $this->input->post();
        $order = $post['order'];
        $columnName = $post['column'];
        $search = $post['search'];

        $where = [
            'company_id' => getLoggedCompanyID(),
            'status' => 1
        ];

        if($post['type'] !== "all") {
            $where['recurring_type'] = $post['type'];
        }

        if($post['transaction_type'] !== "all") {
            $where['txn_type'] = $post['transaction_type'];
        }

        $items = $this->accounting_recurring_transactions_model->getCompanyRecurringTransactions($where, $columnName, $order);

        $tableHtml = "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Template Name</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Txn Type</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Interval</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Previous Date</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Next Date</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Customer/Vendor</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Amount</th>";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";

        $data = [];
        foreach($items as $item) {
            switch($item['txn_type']) {
                case 'expense' :
                    $expense = $this->vendors_model->get_expense_by_id($item['txn_id']);
                    $total = number_format($expense->total_amount, 2, '.', ',');

                    switch($expense->payee_type) {
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
                break;
                case 'check' :
                    $check = $this->vendors_model->get_check_by_id($item['txn_id'], logged('company_id'));
                    $total = number_format($check->total_amount, 2, '.', ',');

                    switch($check->payee_type) {
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
                break;
                case 'bill' :
                    $bill = $this->vendors_model->get_bill_by_id($item['txn_id'], logged('company_id'));
                    $total = number_format($bill->total_amount, 2, '.', ',');
                    $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                    $payeeName = $payee->display_name;
                break;
                case 'purchase order' :
                    $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($item['txn_id'], logged('company_id'));
                    $total = number_format($purchaseOrder->total_amount, 2, '.', ',');
                    $payee = $this->vendors_model->get_vendor_by_id($purchaseOrder->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'vendor credit' :
                    $vCredit = $this->vendors_model->get_vendor_credit_by_id($item['txn_id'], logged('company_id'));
                    $total = number_format($vCredit->total_amount, 2, '.', ',');
                    $payee = $this->vendors_model->get_vendor_by_id($vCredit->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'credit card credit' :
                    $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($item['txn_id'], logged('company_id'));
                    $total = number_format($ccCredit->total_amount, 2, '.', ',');

                    switch($ccCredit->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                            $payeeName = $payee->display_name;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                            $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($ccCredit->payee_id);
                            $payeeName = $payee->FName . ' ' . $payee->LName;
                        break;
                    }
                break;
                case 'deposit' :
                    $deposit = $this->accounting_bank_deposit_model->getById($item['txn_id'], logged('company_id'));
                    $total = number_format($deposit->total_amount, 2, '.', ',');
                break;
                case 'transfer' :
                    $transfer = $this->accounting_transfer_funds_model->getById($item['txn_id'], logged('company_id'));
                    $total = number_format($transfer->transfer_amount, 2, '.', ',');
                break;
                case 'journal entry' :
                    $total = '0.00';
                break;
            }

            $previous = !is_null($item['previous_date']) && $item['previous_date'] !== '' ? date("m/d/Y", strtotime($item['previous_date'])) : null;
            $next = date("m/d/Y", strtotime($item['next_date']));

            $every = $item['recurr_every'];
            switch ($item['recurring_interval']) {
                case 'daily' :
                    $interval = 'Every Day';

                    if(intval($every) > 1) {
                        $interval = "Every $every Days";
                    }
                break;
                case 'weekly' :
                    $interval = 'Every Week';

                    if(intval($every) > 1) {
                        $interval = "Every $every Weeks";
                    }
                break;
                case 'monthly' :
                    $interval = 'Every Month';

                    if(intval($every) > 1) {
                        $interval = "Every $every Months";
                    }
                break;
                case 'yearly' :
                    $interval = 'Every Year';
                break;
                default :
                    $interval = '';
                    $previous = '';
                    $next = '';
                break;
            }

            if($search !== "") {
                if(stripos($item['template_name'], $search) !== false) {
                    $data[] = [
                        'id' => $item['id'],
                        'template_name' => $item['template_name'],
                        'recurring_type' => ucfirst($item['recurring_type']),
                        'txn_type' => ucwords($item['txn_type']),
                        'recurring_interval' => $interval,
                        'previous_date' => $previous,
                        'next_date' => $next,
                        'customer_vendor' => $payeeName,
                        'amount' => $total
                    ];
                }
            } else {
                $data[] = [
                    'id' => $item['id'],
                    'template_name' => $item['template_name'],
                    'recurring_type' => ucfirst($item['recurring_type']),
                    'txn_type' => ucwords($item['txn_type']),
                    'recurring_interval' => $interval,
                    'previous_date' => $previous,
                    'next_date' => $next,
                    'customer_vendor' => $payeeName,
                    'amount' => $total
                ];
            }
        }

        foreach($data as $d) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['template_name']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['recurring_type']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['txn_type']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['recurring_interval']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['previous_date']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['next_date']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['customer_vendor']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$d['amount']."</td>";
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function skip_next_date($id)
    {
        $transaction = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

        $currentOccurrence = intval($transaction->current_occurrence) + 1;
        $every = $transaction->recurr_every;
        $nextDate = date("m/d/Y", strtotime($transaction->next_date));
        switch($transaction->recurring_interval) {
            case 'daily' :
                $nextDate = date("Y-m-d", strtotime("$nextDate +$every days"));
            break;
            case 'weekly' :
                $nextDate = date("Y-m-d", strtotime("$nextDate +$every weeks"));
            break;
            case 'monthly' :
                if($transaction->recurring_week === 'day') {
                    $day = $transaction->recurring_day === 'last' ? 't' : $transaction->recurring_day;
                    $nextDate = date("Y-m-$day", strtotime("$nextDate +$every months"));
                } else {
                    $week = $transaction->recurring_week;
                    $day = $transaction->recurring_day;
                    $nextDate = date("Y-m-d", strtotime("$week $day ".date("Y-m", strtotime("$nextDate +$every months"))));
                }
            break;
            case 'yearly' :
                $month = $transaction->recurring_month;
                $day = $transaction->recurring_day;

                $nextDate = date("Y-$month-$day", strtotime("$nextDate +1 year"));
            break;
        }

        if($transaction->end_type === 'after') {
            if($currentOccurrence === intval($transaction->max_occurrences)) {
                $nextDate = null;
            }
        } else {
            if($transaction->end_type !== 'none') {
                if(strtotime($nextDate) > strtotime($transaction->end_date)) {
                    $nextDate = null;
                }
            }
        }

        $recurringData = [
            'previous_date' => $transaction->next_date,
            'next_date' => $nextDate,
            'current_occurrence' => $currentOccurrence
        ];

        $update = $this->accounting_recurring_transactions_model->updateRecurringTransaction($transaction->id, $recurringData);

        echo json_encode([
            'success' => $update ? true : false
        ]);
    }

    public function pause($id)
    {
        $transaction = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

        $recurringData = [
            'status' => 2
        ];

        $update = $this->accounting_recurring_transactions_model->updateRecurringTransaction($transaction->id, $recurringData);

        echo json_encode([
            'success' => $update ? true : false
        ]);
    }

    public function resume($id)
    {
        $transaction = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);
        $nextDate = $transaction->next_date;

        if(strtotime(date("Y-m-d")) >= strtotime($nextDate)) {
            $every = $transaction->recurr_every;

            for($i = 0; strtotime(date("Y-m-d")) >= strtotime($nextDate); $i++) {
                switch($transaction->recurring_interval) {
                    case 'daily' :
                        $nextDate = date("Y-m-d", strtotime("$nextDate +$every days"));
                    break;
                    case 'weekly' :
                        $nextDate = date("Y-m-d", strtotime("$nextDate +$every weeks"));
                    break;
                    case 'monthly' :
                        if($transaction->recurring_week === 'day') {
                            $day = $transaction->recurring_day === 'last' ? 't' : $transaction->recurring_day;
                            $nextDate = date("Y-m-$day", strtotime("$nextDate +$every months"));
                        } else {
                            $week = $transaction->recurring_week;
                            $day = $transaction->recurring_day;
                            $nextDate = date("Y-m-d", strtotime("$week $day ".date("Y-m", strtotime("$nextDate +$every months"))));
                        }
                    break;
                    case 'yearly' :
                        $month = $transaction->recurring_month;
                        $day = $transaction->recurring_day;
    
                        $nextDate = date("Y-$month-$day", strtotime("$nextDate +1 year"));
                    break;
                }
            }

            if($transaction->end_type === 'after') {
                if($currentOccurrence === intval($transaction->max_occurrences)) {
                    $nextDate = null;
                }
            } else {
                if($transaction->end_type !== 'none') {
                    if(strtotime($nextDate) > strtotime($transaction->end_date)) {
                        $nextDate = null;
                    }
                }
            }
        }

        $recurringData = [
            'next_date' => $nextDate,
            'status' => 1
        ];

        $update = $this->accounting_recurring_transactions_model->updateRecurringTransaction($transaction->id, $recurringData);

        echo json_encode([
            'success' => $update ? true : false
        ]);
    }

    public function reminders_list()
    {
        add_footer_js(array(
            "assets/js/accounting/reminders-list.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/reminders_list', $this->page_data);
    }

    public function load_reminders_list()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];

        $where = [
            'company_id' => getLoggedCompanyID(),
            'recurring_type' => 'reminder'
        ];

        if($post['transaction_type'] !== "all") {
            $where['txn_type'] = $post['transaction_type'];
        }

        $items = $this->accounting_recurring_transactions_model->getCompanyRecurringTransactions($where, $columnName, $order);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($items) > 0) {
            foreach($items as $item) {
                switch($item['txn_type']) {
                    case 'expense' :
                        $expense = $this->vendors_model->get_expense_by_id($item['txn_id']);
                        $total = number_format($expense->total_amount, 2, '.', ',');

                        switch($expense->payee_type) {
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
                    break;
                    case 'check' :
                        $check = $this->vendors_model->get_check_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($check->total_amount, 2, '.', ',');

                        switch($check->payee_type) {
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
                    break;
                    case 'bill' :
                        $bill = $this->vendors_model->get_bill_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($bill->total_amount, 2, '.', ',');
                        $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'purchase order' :
                        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($purchaseOrder->total_amount, 2, '.', ',');
                        $payee = $this->vendors_model->get_vendor_by_id($purchaseOrder->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'vendor credit' :
                        $vCredit = $this->vendors_model->get_vendor_credit_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($vCredit->total_amount, 2, '.', ',');
                        $payee = $this->vendors_model->get_vendor_by_id($vCredit->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'credit card credit' :
                        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($item['txn_id'], logged('company_id'));
                        $total = number_format($ccCredit->total_amount, 2, '.', ',');

                        switch($ccCredit->payee_type) {
                            case 'vendor':
                                $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'customer':
                                $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                            break;
                            case 'employee':
                                $payee = $this->users_model->getUser($ccCredit->payee_id);
                                $payeeName = $payee->FName . ' ' . $payee->LName;
                            break;
                        }
                    break;
                    case 'deposit' :
                        $deposit = $this->accounting_bank_deposit_model->getById($item['txn_id'], logged('company_id'));
                        $total = number_format($deposit->total_amount, 2, '.', ',');
                        $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);
                        $flag = true;

                        foreach($funds as $fund) {
                            if($fund->received_from_key !== $funds[0]->received_from_key && $fund->received_from_id !== $funds[0]->received_from_id) {
                                $flag = false;
                                break;
                            }
                        }

                        if($flag) {
                            switch($funds[0]->received_from_key) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($funds[0]->received_from_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($funds[0]->received_from_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($funds[0]->received_from_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }
                        } else {
                            $payeeName = '';
                        }
                    break;
                    case 'transfer' :
                        $transfer = $this->accounting_transfer_funds_model->getById($item['txn_id'], logged('company_id'));
                        $total = number_format($transfer->transfer_amount, 2, '.', ',');
                        $payeeName = '';
                    break;
                    case 'journal entry' :
                        $total = '0.00';
                        $payeeName = '';
                    break;
                    case 'npcharge' :
                        $charge = $this->accounting_delayed_charge_model->getDelayedChargeDetails($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($charge->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($charge->total_amount, 2, '.', ',');
                    break;
                    case 'npcredit' :
                        $credit = $this->accounting_delayed_credit_model->getDelayedCreditDetails($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($credit->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($credit->total_amount, 2, '.', ',');
                    break;
                    case 'credit memo' :
                        $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($creditMemo->total_amount, 2, '.', ',');
                    break;
                    case 'invoice' :
                        $invoice = $this->invoice_model->getinvoice($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($invoice->grand_total, 2, '.', ',');
                    break;
                    case 'refund' :
                        $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($refundReceipt->total_amount, 2, '.', ',');
                    break;
                    case 'sales receipt' :
                        $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($item['txn_id']);
                        $payee = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                        $total = number_format($salesReceipt->total_amount, 2, '.', ',');
                    break;
                }

                $previous = !is_null($item['previous_date']) && $item['previous_date'] !== '' ? date("m/d/Y", strtotime($item['previous_date'])) : null;
                $next = date("m/d/Y", strtotime($item['next_date']));

                $every = $item['recurr_every'];
                switch ($item['recurring_interval']) {
                    case 'daily' :
                        $interval = 'Every Day';

                        if(intval($every) > 1) {
                            $interval = "Every $every Days";
                        }
                    break;
                    case 'weekly' :
                        $interval = 'Every Week';

                        if(intval($every) > 1) {
                            $interval = "Every $every Weeks";
                        }
                    break;
                    case 'monthly' :
                        $interval = 'Every Month';

                        if(intval($every) > 1) {
                            $interval = "Every $every Months";
                        }
                    break;
                    case 'yearly' :
                        $interval = 'Every Year';
                    break;
                    default :
                        $interval = '';
                        $previous = '';
                        $next = '';
                    break;
                }

                if($search !== "") {
                    if(stripos($item['template_name'], $search) !== false) {
                        $data[] = [
                            'id' => $item['id'],
                            'template_name' => $item['template_name'],
                            'recurring_type' => ucfirst($item['recurring_type']),
                            'txn_type' => ucwords(str_replace('np', '', $item['txn_type'])),
                            'txn_id' => $item['txn_id'],
                            'recurring_interval' => $interval,
                            'previous_date' => $previous,
                            'next_date' => $item['status'] === "2" ? "Paused" : $next,
                            'customer_vendor' => $payeeName,
                            'amount' => $total,
                            'status' => $item['status']
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $item['id'],
                        'template_name' => $item['template_name'],
                        'recurring_type' => ucfirst($item['recurring_type']),
                        'txn_type' => ucwords(str_replace('np', '', $item['txn_type'])),
                        'txn_id' => $item['txn_id'],
                        'recurring_interval' => $interval,
                        'previous_date' => $previous,
                        'next_date' => $item['status'] === "2" ? "Paused" : $next,
                        'customer_vendor' => $payeeName,
                        'amount' => $total,
                        'status' => $item['status']
                    ];
                }
            }
        }

        usort($data, function($a, $b) use ($columnName, $order) {
            switch($columnName) {
                case 'template_name' :
                    if($order === 'asc') {
                        return strcmp($a['template_name'], $b['template_name']);
                    } else {
                        return strcmp($b['template_name'], $a['template_name']);
                    }
                break;
                case 'txn_type' :
                    if($order === 'asc') {
                        return strcmp($a['txn_type'], $b['txn_type']);
                    } else {
                        return strcmp($b['txn_type'], $a['txn_type']);
                    }
                break;
                case 'previous_date' :
                    if($order === 'asc') {
                        return strtotime($a['previous_date']) > strtotime($b['previous_date']);
                    } else {
                        return strtotime($a['previous_date']) < strtotime($b['previous_date']);
                    }
                break;
                case 'next_date' :
                    if($order === 'asc') {
                        return strtotime($a['next_date']) > strtotime($b['next_date']);
                    } else {
                        return strtotime($a['next_date']) < strtotime($b['next_date']);
                    }
                break;
            }
        });

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($items),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function skip_batch()
    {
        $post = $this->input->post();
        $transactions = $this->accounting_recurring_transactions_model->get_transactions_by_ids($post['transaction_ids']);

        $updateData = [];
        foreach($post['transaction_ids'] as $id) {
            $transaction = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

            $currentOccurrence = intval($transaction->current_occurrence) + 1;
            $every = $transaction->recurr_every;
            $nextDate = date("m/d/Y", strtotime($transaction->next_date));
            switch($transaction->recurring_interval) {
                case 'daily' :
                    $nextDate = date("Y-m-d", strtotime("$nextDate +$every days"));
                break;
                case 'weekly' :
                    $nextDate = date("Y-m-d", strtotime("$nextDate +$every weeks"));
                break;
                case 'monthly' :
                    if($transaction->recurring_week === 'day') {
                        $day = $transaction->recurring_day === 'last' ? 't' : $transaction->recurring_day;
                        $nextDate = date("Y-m-$day", strtotime("$nextDate +$every months"));
                    } else {
                        $week = $transaction->recurring_week;
                        $day = $transaction->recurring_day;
                        $nextDate = date("Y-m-d", strtotime("$week $day ".date("Y-m", strtotime("$nextDate +$every months"))));
                    }
                break;
                case 'yearly' :
                    $month = $transaction->recurring_month;
                    $day = $transaction->recurring_day;

                    $nextDate = date("Y-$month-$day", strtotime("$nextDate +1 year"));
                break;
            }

            if($transaction->end_type === 'after') {
                if($currentOccurrence === intval($transaction->max_occurrences)) {
                    $nextDate = null;
                }
            } else {
                if($transaction->end_type !== 'none') {
                    if(strtotime($nextDate) > strtotime($transaction->end_date)) {
                        $nextDate = null;
                    }
                }
            }

            $updateData[] = [
                'id' => $transaction->id,
                'previous_date' => $transaction->next_date,
                'next_date' => $nextDate,
                'current_occurrence' => $currentOccurrence
            ];
        }

        $update = $this->accounting_recurring_transactions_model->update_by_batch($updateData);

        if($update !== count($post['transaction_ids'])) {
            $revertData = [];
            foreach($transactions as $transaction) {
                $revertData[] = [
                    'id' => $transaction->id,
                    'previous_date' => $transaction->previous_date,
                    'next_date' => $transaction->next_date,
                    'current_occurrence' => $transaction->current_occurence,
                    'updated_at' => $transaction->updated_at
                ];
            }

            $revert = $this->accounting_recurring_transactions_model->update_by_batch($revertData);
        }

        echo json_encode([
            'success' => $update === count($post['transaction_ids'])
        ]);
    }
}