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
            "assets/css/accounting/accounting_includes/create_charge.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js"
        ));

		$this->page_data['menu_name'] =
            array(
                array("Dashboard",	array()),
                array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses", 	array('Expenses','Vendors')),
                array("Sales", 		array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll", 	array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",	array()),
                array("Taxes",		array("Sales Tax","Payroll Tax")),
                array("Mileage",	array()),
                array("Accounting",	array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/banking',array()),
                array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', 'credit_notes')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",	array('/accounting/salesTax','/accounting/payrollTax')),
                array('#',	array()),
                array("",	array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
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
                switch ($item['recurring_interval']) {
                    case 'daily' :
                        $interval = 'Every Day';
                    break;
                    case 'weekly' :
                        $interval = 'Every Week';
                    break;
                    case 'monthly' :
                        $interval = 'Every Month';
                    break;
                    case 'yearly' :
                        $interval = 'Every Year';
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
                            'previous_date' => $item['previous_date'] !== '' && $item['previous_date'] !== null ? date('m/d/Y', strtotime($item['previous_date'])) : null,
                            'next_date' => $item['next_date'] !== '' && $item['next_date'] !== null ? date('m/d/Y', strtotime($item['next_date'])) : null,
                            'customer_vendor' => null,
                            'amount' => null
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $item['id'],
                        'template_name' => $item['template_name'],
                        'recurring_type' => ucfirst($item['recurring_type']),
                        'txn_type' => ucwords($item['txn_type']),
                        'recurring_interval' => $interval,
                        'previous_date' => $item['previous_date'] !== '' && $item['previous_date'] !== null ? date('m/d/Y', strtotime($item['previous_date'])) : null,
                        'next_date' => $item['next_date'] !== '' && $item['next_date'] !== null ? date('m/d/Y', strtotime($item['next_date'])) : null,
                        'customer_vendor' => null,
                        'amount' => null
                    ];
                }
            }
        }

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
        $this->load->model('accounting_bank_deposit_model');
        $this->load->model('accounting_transfer_funds_model');
        $this->load->model('accounting_journal_entries_model');

        $data = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

        switch($data->txn_type) {
            case 'deposit' :
                $data->transaction = $this->accounting_bank_deposit_model->getById($data->txn_id);

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
                $data->transaction = $this->accounting_transfer_funds_model->getById($data->txn_id);
            break;
            case 'journal entry' :
                $data->transaction = $this->accounting_journal_entries_model->getById($data->txn_id);
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
                'end_date' => $data['end_type'] === 'by' ? $data['end_date'] !== "" ? date('Y-m-d', strtotime($data['end_date'])) : null : null,
                'max_occurences' => $data['end_type'] === 'after' ? $data['max_occurence'] : null,
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $recurringUpdate = $this->accounting_recurring_transactions_model->updateRecurringTransaction($id, $recurringData);

            if($recurringUpdate) {
                $recurringData = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

                switch($type) {
                    case 'deposit' :
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

                        $deleteFunds = $this->accounting_bank_deposit_model->deleteFunds($recurringData->txn_id);

                        $fundsData = [];
                        foreach($data['account'] as $key => $value) {
                            $account = explode('-', $value);
                            $receivedFrom = explode('-', $data['received_from'][$key]);

                            $fundsData[] =[
                                'bank_deposit_id' => $recurringData->txn_id,
                                'received_from_key' => $receivedFrom[0],
                                'received_from_id' => $receivedFrom[1],
                                'received_from_account_key' => $account[0],
                                'received_from_account_id' => $account[1],
                                'description' => $data['description'][$key],
                                'payment_method' => $data['payment_method'][$key],
                                'ref_no' => $data['reference_no'][$key],
                                'amount' => $data['amount'][$key],
                            ];
                        }

                        $fundsId = $this->accounting_bank_deposit_model->insertFunds($fundsData);
                    break;
                    case 'transfer' :
                        $this->load->model('accounting_transfer_funds_model');
                        $transferFrom = explode('-', $data['transfer_from']);
                        $transferTo = explode('-', $data['transfer_to']);

                        $transferData = [
                            'transfer_from_account_key' => $transferFrom[0],
                            'transfer_from_account_id' => $transferFrom[1],
                            'transfer_to_account_key' => $transferTo[0],
                            'transfer_to_account_id' => $transferTo[1],
                            'transfer_amount' => $data['transfer_amount'],
                            'transfer_memo' => $data['memo'],
                            'updated_at' => date('Y-m-d h:i:s')
                        ];

                        $transactionUpdate = $this->accounting_transfer_funds_model->update($recurringData->txn_id, $transferData);
                    break;
                    case 'journal_entry' :
                        $this->load->model('accounting_journal_entries_model');
                        $entryData = [
                            'memo' => $data['memo'],
                            'updated_at' => date('Y-m-d h:i:s')
                        ];

                        $transactionUpdate = $this->accounting_journal_entries_model->update($recurringData->txn_id, $entryData);

                        $deleteEntries = $this->accounting_journal_entries_model->deleteEntries($recurringData->txn_id);

                        $entryItems = [];
                        foreach ($data['accounts'] as $key => $value) {
                            $name = explode('-', $data['names'][$key]);
                            $account = explode('-', $value);
            
                            $entryItems[] = [
                                'journal_entry_id' => $recurringData->txn_id,
                                'account_key' => $account[0],
                                'account_id' => $account[1],
                                'debit' => $data['debits'][$key],
                                'credit' => $data['credits'][$key],
                                'description' => $data['descriptions'][$key],
                                'name_key' => $name[0],
                                'name_id' => $name[1]
                            ];
                        }

                        $entryItemsId = $this->accounting_journal_entries_model->insertEntryItems($entryItems);
                    break;
                }
            }

            $return['success'] = $recurringUpdate && $transactionUpdate ? true : false;
            $return['message'] =  $recurringUpdate && $transactionUpdate ? 'Update Successful!' : 'An unexpected error occured!';
        }

        echo json_encode($return);
    }
}