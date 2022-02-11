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
        $this->page_data['menu_icon'] = array("fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
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
                            'txn_id' => $item['txn_id'],
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
                        'txn_id' => $item['txn_id'],
                        'recurring_interval' => $interval,
                        'previous_date' => $previous,
                        'next_date' => $next,
                        'customer_vendor' => $payeeName,
                        'amount' => $total
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

                    break;
                    case 'check' :

                    break;
                    case 'bill' :

                    break;
                    case 'purchase-order' :

                    break;
                    case 'vendor-credit' :

                    break;
                    case 'credit-card-credit' :

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
}