<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_modals extends MY_Controller {

    private $upload_path = "./uploads/accounting/attachments/";
    public $result = null;
    public $page_data = [];

    public function __construct() {
        parent::__construct();
        $this->checkLogin();

        add_css(array(
            'assets/css/accounting/accounting-modal-forms.css'
        ));

        add_footer_js(array(
            'assets/js/accounting/modal-forms.js'
        ));

        $this->load->model('vendors_model');
        $this->load->model('accounting_transfer_funds_model');
        $this->load->model('accounting_single_time_activity_model');
        $this->load->model('accounting_pay_down_credit_card_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_journal_entries_model');
        $this->load->model('accounting_inventory_qty_adjustments_model');
        $this->load->model('accounting_bank_deposit_model');
        $this->load->model('accounting_weekly_timesheet_model');
        $this->load->model('accounting_payroll_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('chart_of_accounts_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('tags_model');
        $this->load->model('job_tags_model');
        $this->load->model('users_model');
        $this->load->model('items_model');
        $this->load->model('accounting_recurring_transactions_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('accounting_attachments_model');
		$this->load->library('form_validation');
    }

    public function index($view ="") {
        if ($view) {
            switch ($view) {
                case 'pay_down_credit_card_modal':
                    $detailTypes = $this->account_detail_model->getDetailTypesById(3);
                    $accounts = $this->chart_of_accounts_model->select();

                    $bankAccounts = [];
                    foreach($detailTypes as $detailType) {
                        $detailTypeAccs = array_filter($accounts, function($v, $k) use ($detailType) {
                            return $v->acc_detail_id === $detailType->acc_detail_id;
                        }, ARRAY_FILTER_USE_BOTH);

                        if(!empty($detailTypeAccs)) {
                            $bankAccounts[$detailType->acc_detail_name] = $detailTypeAccs;
                        }
                    }
                    
                    $this->page_data['dropdown']['accounts'] = $bankAccounts;
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['creditCards'] = $this->chart_of_accounts_model->get_credit_card_accounts();
                break;
                case 'single_time_activity_modal':
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                    $this->page_data['dropdown']['services'] = $this->items_model->getItemsWithFilter(['type' => ['service', 'Service'], 'status' => [1]]);

                    $time = '00:00';
                    $endTime = '23:45';
                    
                    $times = [
                        [
                            'value' => $time,
                            'display' => date('h:i A', strtotime($time))
                        ]
                    ];

                    for($i = 0; $time != $endTime; $i++) {
                        $time = date('H:i', strtotime($time . '+ 15 minutes'));

                        $times[] = [
                            'value' => $time,
                            'display' => date('h:i A', strtotime($time))
                        ];
                    }

                    $this->page_data['dropdown']['times'] = $times;
                break;
                case 'journal_entry_modal':
                    $accounts = $this->chart_of_accounts_model->select();
                    $accountTypes = $this->account_model->getAccounts();

                    $bankAccounts = [];
                    foreach($accountTypes as $accType) {
                        $accName = strtolower($accType->account_name);

                        foreach($accounts as $account) {
                            if($account->account_id === $accType->id) {
                                $bankAccounts[$accType->account_name][] = [
                                    'value' => $accName.'-'.$account->id,
                                    'text' => $account->name,
                                ];
                            }
                        }
                    }

                    $lastJournalNo = (int)$this->accounting_journal_entries_model->getLastJournalNo();
                    $this->page_data['journal_no'] = $lastJournalNo + 1;
                    $this->page_data['accounts'] = $bankAccounts;
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                break;
                case 'transfer_modal' :
                    $accountTypes = [
                        'Bank',
                        'Other Current Assets',
                        'Fixed Assets',
                        'Credit Card',
                        'Other Current Liabilities',
                        'Long Term Liabilities',
                        'Equity'
                    ];

                    $accounts = [];

                    foreach($accountTypes as $accountType) {
                        $type = $this->account_model->getAccTypeByName($accountType);

                        $typeAccounts = $this->chart_of_accounts_model->getByAccountType($type->id, null, logged('company_id'));

                        if(count($typeAccounts) > 0) {
                            foreach($typeAccounts as $typeAcc) {
                                $childAcc = $this->chart_of_accounts_model->getChildAccounts($typeAcc->id);

                                $typeAcc->childAccs = $childAcc;

                                $accounts[$accountType][] = $typeAcc;
                            }
                        }
                    }

                    $this->page_data['accounts'] = $accounts;
                break;
                case 'bank_deposit_modal':
                    $accountTypes = $this->account_model->getAccTypeByName(['Bank', 'Other Current Assets']);

                    $bankAccounts = [];
                    $count = 1;
                    foreach($accountTypes as $accType) {
                        $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

                        if(count($accounts) > 0) {
                            foreach($accounts as $account) {
                                $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                                $account->childAccs = $childAccs;

                                $bankAccounts[$accType->account_name][] = $account;

                                if($count === 1) {
                                    $selectedBalance = $account->balance;
                                }

                                $count++;
                            }
                        }
                    }

                    $fundAccsTypes = [
                        'Income',
                        'Other Income',
                        'Bank',
                        'Other Current Assets',
                        'Fixed Assets',
                        'Accounts payable (A/P)',
                        'Credit Card',
                        'Other Current Liabilities',
                        'Long Term Liabilities',
                        'Equity',
                        'Cost of Goods Sold',
                        'Expenses',
                        'Other Expense'
                    ];
                    $fundsAccounts = [];

                    foreach($fundAccsTypes as $fundAccType) {
                        $type = $this->account_model->getAccTypeByName($fundAccType);

                        $fundAccs = $this->chart_of_accounts_model->getByAccountType($type->id, null, logged('company_id'));

                        if(count($fundAccs) > 0) {
                            foreach($fundAccs as $fundAcc) {
                                $childFundAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                                $fundAcc->childAccs = $childFundAccs;

                                $fundsAccounts[$fundAccType][] = $fundAcc;
                            }
                        }
                    }


                    if(strpos($selectedBalance, '-') !== false) {
                        $balance = str_replace('-', '', $selectedBalance);
                        $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
                    } else {
                        $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
                    }

                    $this->page_data['fundsAccounts'] = $fundsAccounts;
                    $this->page_data['balance'] = $selectedBalance;
                    $this->page_data['accounts'] = $bankAccounts;
                    $this->page_data['dropdown']['payment_methods'] = $this->accounting_payment_methods_model->getCompanyPaymentMethods();
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                break;
                case 'inventory_qty_modal':
                    $accounts = $this->chart_of_accounts_model->select();
                    $accountTypes = $this->account_model->getAccounts();

                    $bankAccounts = [];
                    foreach($accountTypes as $accType) {
                        $accName = strtolower($accType->account_name);

                        foreach($accounts as $account) {
                            if($account->account_id === $accType->id) {
                                $bankAccounts[$accType->account_name][] = [
                                    'value' => $accName.'-'.$account->id,
                                    'text' => $account->name,
                                ];
                            }
                        }
                    }


                    $lastAdjustmentNo = (int)$this->accounting_inventory_qty_adjustments_model->getLastAdjustmentNo();
                    $this->page_data['adjustment_no'] = $lastAdjustmentNo + 1;
                    $this->page_data['accounts'] = $bankAccounts;
                    $this->page_data['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
                break;
                case 'payroll_modal':
                    $this->page_data['pay_schedules'] = $this->users_model->getPaySchedules();
                break;
                case 'weekly_timesheet_modal':
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['services'] = $this->items_model->getItemsWithFilter(['type' => ['service', 'Service'], 'status' => [1]]);

                    $date = date('m/d/Y');
                    $yearLater = date('m/d/Y', strtotime($date . ' -1 year'));

                    $dateTime = new DateTime($yearLater);
                    $weekNo = $dateTime->format('W');
                    $newDate = new DateTime();
                    $firstDay = $newDate->setISODate($dateTime->format("Y"), $weekNo, 0);
                    $firstDayString = $firstDay->format('m/d/Y');
                    $lastDay = $newDate->setISODate($dateTime->format("Y"), $weekNo, 6);
                    $lastDayString = $lastDay->format('m/d/Y');

                    $weeks = [
                        [
                            'firstDay' => $firstDayString,
                            'lastDay' => $lastDayString,
                            'selected' => (strtotime($date) >= strtotime($firstDayString) && strtotime($date) <= strtotime($lastDayString)) ? true : false
                        ]
                    ];

                    for($i = 2; $i <= 105; $i++) {
                        $firstDay = $lastDay->add(new DateInterval('P1D'));
                        $firstDayString = $firstDay->format('m/d/Y');
                        $lastDay = $firstDay->add(new DateInterval('P6D'));
                        $lastDayString = $lastDay->format('m/d/Y');

                       $weeks[] = [
                           'firstDay' => $firstDayString,
                           'lastDay' => $lastDayString,
                           'selected' => (strtotime($date) >= strtotime($firstDayString) && strtotime($date) <= strtotime($lastDayString)) ? true : false
                       ];
                    }

                    $this->page_data['dropdown']['weeks'] = $weeks;
                break;
                case 'statement_modal' :
                    $data = [
                        'cust_bal_status' => 'open',
                        'company_id' => logged('company_id'),
                        'start_date' => date('Y-m-d', strtotime('-1 months')),
                        'end_date' => date('Y-m-d')
                    ];
                    $customers = $this->accounting_invoices_model->getStatementInvoices($data);

                    $display = [];
                    foreach($customers as $customer) {
                        $index = array_search($customer->customer_id, array_column($display, 'id'));
                        if($index === false) {
                            $display[] = [
                                'id' => $customer->customer_id,
                                'name' => $customer->first_name . ' ' . $customer->last_name,
                                'email' => $customer->email,
                                'balance' => ($customer->status === '1') ? number_format($customer->amount, 2, '.', ',') : 0.00
                            ];
                        } else {
                            if($customer->status === '1' || $customer->status === '2' && $input['statement_type'] === '3' && $input['cust_bal_status'] === 'overdue') {
                                $balance = (int)$display[$index]['balance'] + $customer->amount;
                                $display[$index]['balance'] = number_format($balance, 2, '.', ',');
                            }
                        }
                    }

                    $totalBalance = array_sum(array_map(function($item) { 
                        return $item['balance']; 
                    }, $display));

                    $withoutEmail = array_filter($display, function($value, $key) {
                        return $value['email'] === '';
                    }, ARRAY_FILTER_USE_BOTH);

                    $this->page_data['withoutEmail'] = $withoutEmail;
                    $this->page_data['total'] = number_format($totalBalance, 2, '.', ',');
                    $this->page_data['customers'] = $display;
                break;
                case 'expense_modal' :
                    $paymentAccs = [];
                    $paymentAccsType = $this->account_model->getAccTypeByName(['Bank', 'Credit Card', 'Other Current Assets']);

                    $count = 1;
                    foreach($paymentAccsType as $accType) {
                        $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

                        if(count($accounts) > 0) {
                            foreach($accounts as $account) {
                                $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                                $account->childAccs = $childAccs;

                                $paymentAccs[$accType->account_name][] = $account;

                                if($count === 1) {
                                    $selectedBalance = $account->balance;
                                }

                                $count++;
                            }
                        }
                    }

                    if(strpos($selectedBalance, '-') !== false) {
                        $balance = str_replace('-', '', $selectedBalance);
                        $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
                    } else {
                        $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
                    }

                    $this->page_data['dropdown']['payment_methods'] = $this->accounting_payment_methods_model->getCompanyPaymentMethods();
                    $this->page_data['balance'] = $selectedBalance;
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                    $this->page_data['dropdown']['categories'] = $this->get_category_accs();
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['payment_accounts'] = $paymentAccs;
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                break;
                case 'check_modal' :
                    $bankAccsType = $this->account_model->getAccTypeByName('Bank');

                    $bankAccs = [];
                    $accounts = $this->chart_of_accounts_model->getByAccountType($bankAccsType->id, null, logged('company_id'));
                    $count = 1;
                    if(count($accounts) > 0) {
                        foreach($accounts as $account) {
                            $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                            $account->childAccs = $childAccs;

                            $bankAccs[] = $account;

                            if($count === 1) {
                                $selectedBalance = $account->balance;
                            }

                            $count++;
                        }
                    }

                    if(strpos($selectedBalance, '-') !== false) {
                        $balance = str_replace('-', '', $selectedBalance);
                        $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
                    } else {
                        $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
                    }

                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                    $this->page_data['dropdown']['categories'] = $this->get_category_accs();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['bank_accounts'] = $bankAccs;
                    $this->page_data['balance'] = $selectedBalance;
                break;
                case 'bill_modal' :
                    $terms = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));

                    $selectedTerm = $terms[0];

                    if($selectedTerm->type === "1") {
                        $dueDate = date("m/d/Y", strtotime(date("m/d/Y")." +$selectedTerm->net_due_days days"));
                    } else {
                        if($selectedTerm->minimum_days_to_pay === null ||
                            $selectedTerm->minimum_days_to_pay === "" ||
                            $selectedTerm->minimum_days_to_pay === "0")
                        {
                            if(intval(date("d")) > intval($selectedTerm->day_of_month_due)) {
                                $dueDate = date("m/d/Y", strtotime(date("m/$selectedTerm->day_of_month_due/Y")." +1 month"));
                            } else {
                                $dueDate = date("m/$selectedTerm->day_of_month_due/Y");
                            }
                        } else {
                            if(intval(date("d") > intval(date("d", strtotime(date("m/$selectedTerm->day_of_month_due/Y")." -$selectedTerm->minimum_days_to_pay days"))))) {
                                $dueDate = date("m/d/Y", strtotime(date("m/$selectedTerm->day_of_month_due/Y")." +1 month"));
                            } else {
                                $dueDate = date("m/$selectedTerm->day_of_month_due/Y");
                            }
                        }
                    }

                    $this->page_data['due_date'] = $dueDate;
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['categories'] = $this->get_category_accs();
                    $this->page_data['dropdown']['terms'] = $terms;
                break;
                case 'pay_bills_modal' :
                    $paymentAccs = [];
                    $accountTypes = [
                        'Bank',
                        'Credit Card'
                    ];

                    foreach($accountTypes as $typeName) {
                        $accType = $this->account_model->getAccTypeByName($typeName);

                        $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

                        $count = 0;
                        if(count($accounts) > 0) {
                            foreach($accounts as $account) {
                                $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                                $account->childAccs = $childAccs;

                                $paymentAccs[$typeName][] = $account;

                                if($count === 1) {
                                    $selectedBalance = $account->balance;
                                }
    
                                $count++;
                            }
                        }
                    }

                    if(strpos($selectedBalance, '-') !== false) {
                        $balance = str_replace('-', '', $selectedBalance);
                        $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
                    } else {
                        $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
                    }

                    $this->page_data['dropdown']['payment_accounts'] = $paymentAccs;
                    $this->page_data['balance'] = $selectedBalance;
                    $this->page_data['dropdown']['payees'] = $this->vendors_model->getAllByCompany();
                break;
                case 'vendor_credit_modal' :
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['categories'] = $this->get_category_accs();
                break;
                case 'purchase_order_modal' :
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['categories'] = $this->get_category_accs();
                break;
                case 'credit_card_credit_modal' :
                    $creditCardAccs = [];
                    $accType = $this->account_model->getAccTypeByName('Credit Card');

                    $count = 1;
                    $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

                    if(count($accounts) > 0) {
                        foreach($accounts as $account) {
                            $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                            $account->childAccs = $childAccs;

                            $creditCardAccs[] = $account;

                            if($count === 1) {
                                $selectedBalance = $account->balance;
                            }

                            $count++;
                        }
                    }

                    if(strpos($selectedBalance, '-') !== false) {
                        $balance = str_replace('-', '', $selectedBalance);
                        $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
                    } else {
                        $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
                    }

                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                    $this->page_data['balance'] = $selectedBalance;
                    $this->page_data['dropdown']['categories'] = $this->get_category_accs();
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['bank_credit_accounts'] = $creditCardAccs;
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
                break;
            }

            $this->load->view("accounting/modals/". $view, $this->page_data);
        }
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

        foreach($accountTypes as $typeName) {
            $accType = $this->account_model->getAccTypeByName($typeName);

            $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

            if(count($accounts) > 0) {
                foreach($accounts as $account) {
                    $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                    $account->childAccs = $childAccs;

                    $categoryAccs[$typeName][] = $account;
                }
            }
        }

        return $categoryAccs;
    }

    public function get_recurring_modal_fields($modal)
    {
        if($modal) {
            $totalDays = date('t');

            $recurringDays = [];
            $ends = array('th','st','nd','rd','th','th','th','th','th','th');
            for($i = 1; $i <= (int)$totalDays; $i++) {
                if (($i %100) >= 11 && ($i%100) <= 13) {
                    $abbreviation = $i. 'th';
                } else {
                    $abbreviation = $i. $ends[$i % 10];
                }

                $recurringDays[$abbreviation] = $abbreviation;
            }
            $recurringDays['last'] = 'Last';

            $this->page_data['recurringDays'] = $recurringDays;

            if($modal === 'bank_deposit') {
                $accounts = $this->chart_of_accounts_model->select();
                $accountTypes = $this->account_model->getAccounts();

                $bankAccounts = [];
                $count = 1;
                foreach($accountTypes as $accType) {
                    $accName = strtolower($accType->account_name);

                    foreach($accounts as $account) {
                        if($account->account_id === $accType->id) {
                            $bankAccounts[$accType->account_name][] = [
                                'value' => $accName.'-'.$account->id,
                                'text' => $account->name,
                                'selected' => $count === 1 ? true : false
                            ];

                            if($count === 1) {
                                $selectedBalance = $account->balance;
                            }
                        }
                        $count++;
                    }
                }

                $this->page_data['accounts'] = $bankAccounts;
            }

            $this->load->view("accounting/modals/recurring_fields/recurring_".$modal."_fields", $this->page_data);
        }
    }

    public function load_job_tags() {
        $postData = json_decode(file_get_contents('php://input'), true);

        $tags = $this->tags_model->getTags();

        $data = [];
        $search = $postData['columns'][0]['search']['value'];

        foreach($tags as $tag) {
            if($search !== "") {
                if(stripos($tag['name'], $search) !== false) {
                    if($tag['type'] === 'group-tag') {
                        $groupIdExists = array_search($tags[$tag['parentIndex']]['id'], array_column($data, 'id'));

                        if($groupIdExists === false || $groupIdExists !== false && $tags[$groupIdExists]['type'] !== 'group') {
                            $data[] = [
                                'id' => $tags[$tag['parentIndex']]['id'],
                                'tag_name' => $tags[$tag['parentIndex']]['name'],
                                'type' => $tags[$tag['parentIndex']]['type'],
                                'parentIndex' => $tags[$tag['parentIndex']]['type'] === 'group-tag' ? $tags[$tag['parentIndex']]['parentIndex'] : null,
                                'tags' => $tags[$tag['parentIndex']]['type'] === 'group' ? $tags[$tag['parentIndex']]['tags'] : null
                            ];
                        }

                        $idExists = array_search($tag['id'], array_column($data, 'id'));

                        if($idExists === false || $idExists !== false && $data[$idExists]['type'] !== 'group-tag') {
                            $groupIndex = array_key_last($data);
                            $data[] = [
                                'id' => $tag['id'],
                                'tag_name' => $tag['name'],
                                'type' => $tag['type'],
                                'group_tag_id' => $tag['group_tag_id'],
                                'parentIndex' => $groupIndex,
                                'tags' => null
                            ];
                        }
                    } else if($tag['type'] === 'group') {
                        $groupIdExists = array_search($tags[$tag['parentIndex']]['id'], array_column($data, 'id'));

                        if($groupIdExists === false || $groupIdExists !== false && $tags[$groupIdExists]['type'] !== 'group') {
                            $data[] = [
                                'id' => $tag['id'],
                                'tag_name' => $tag['name'],
                                'type' => $tag['type'],
                                'parentIndex' => null,
                                'tags' => $tag['tags']
                            ];

                            $parentIndex = array_key_last($data);
                            foreach($tag['tags'] as $groupTag) {
                                $data[] = [
                                    'id' => $groupTag['id'],
                                    'tag_name' => $groupTag['name'],
                                    'type' => 'group-tag',
                                    'group_tag_id' => $tag['group_tag_id'],
                                    'parentIndex' => $parentIndex,
                                    'tags' => null
                                ];
                            }
                        }
                    } else {
                        $data[] = [
                            'id' => $tag['id'],
                            'tag_name' => $tag['name'],
                            'type' => $tag['type'],
                            'group_tag_id' => $tag['group_tag_id'],
                            'parentIndex' => null,
                            'tags' => null
                        ];
                    }
                }
            } else {
                $data[] = [
                    'id' => $tag['id'],
                    'tag_name' => $tag['name'],
                    'type' => $tag['type'],
                    'group_tag_id' => $tag['group_tag_id'],
                    'parentIndex' => $tag['type'] === 'group-tag' ? $tag['parentIndex'] : null,
                    'tags' => $tag['type'] === 'group' ? $tag['tags'] : null
                ];
            }
        }

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($tags),
            'recordsFiltered' => count($data),
            'data' => $data
        ];

        echo json_encode($result);
    }

    public function submit_job_tag() {
        $data = [
            'name' => $this->input->post('tag_name'),
            'group_tag_id' => $this->input->post('group_id') !== "" ? $this->input->post('group_id') : null, 
            'company_id' => logged('company_id')
        ];

        try {
            if($this->input->post('method') === 'create') {
                $jobTagId = $this->job_tags_model->create($data);
            } else {
                $id = $this->input->post('id');
                $jobTagId = $this->job_tags_model->update($id, $data);
            }

            $return = [
                'data' => $jobTagId,
                'success' => $jobTagId ? true : false,
                'message' => 'Success'
            ];
        } catch (\Exception $e) {
            $return = [
                'data' => null,
                'success' => false,
                'message' => 'Error'
            ];
        }

        echo json_encode($return);
    }

    public function group_job_tag_form() {
        $this->load->view("accounting/modals/group_tag_form");
    }

    public function job_tag_modal() {
        $this->load->view("accounting/modals/job_tags_modal");
    }

    public function job_tag_form() {
        $this->load->view("accounting/modals/job_tag_modal_form");
    }

    public function edit_group_tag_form() {
        $this->load->view("accounting/modals/edit_group_form");
    }

    public function get_job_tags() {
        $tags = $this->tags_model->getCompanyTags();

        $return = [];

        foreach($tags as $tag) {
            $name = $tag['name'];
            if($tag['group_tag_id'] !== null) {
                $group = $this->tags_model->getGroupById($tag['group_tag_id']);
                $name = $group->name.': '.$tag['name'];
            }
            $return['results'][] = [
                'id' => $tag['id'],
                'text' => $name
            ];
        }

        echo json_encode($return);
    }

    public function get_payroll_form($paySchedId)
    {
        $paySchedule = $this->users_model->getPaySchedule($paySchedId);
        $this->page_data['paySchedule'] = $paySchedule;
        $this->page_data['payDetails'] = $this->users_model->getPayDetailsByPaySched($paySchedule->id);
        $accounts = $this->chart_of_accounts_model->select();
        $accounts = array_filter($accounts, function($v, $k) {
            return $v->account_id === 3 || $v->account_id === "3";
        }, ARRAY_FILTER_USE_BOTH);

        $currentDay = date('m/d/Y');

        switch($paySchedule->pay_frequency) {
            case 'every-week' :
                $endDay = strtotime($paySchedule->next_pay_period_end);
                $payDate = strtotime($paySchedule->next_payday);

                if($payDate < strtotime(date('m/d/Y'))) {
                    do {
                        $payDate = strtotime(date('m/d/Y', $payDate).' +7 days');
                        $endDay = strtotime(date('m/d/Y', $endDay).' +7 days');
                    } while($payDate < strtotime(date('m/d/Y')));
                }
                $endDay = date('m/d/Y', $endDay);
                $payDate = date('m/d/Y', $payDate);
                $firstPayDate = date('m/d/Y', strtotime($payDate.' +5 weeks'));
                $lastDateString = date('m/d/Y', strtotime($endDay.' +5 weeks'));
                $firstDateString = date('m/d/Y', strtotime($lastDateString.' -6 days'));
                $dropdownLimit = 30;
            break;
            case 'every-other-week' :
                $endDay = strtotime($paySchedule->next_pay_period_end);
                $payDate = strtotime($paySchedule->next_payday);

                if($payDate < strtotime(date('m/d/Y'))) {
                    do {
                        $payDate = strtotime(date('m/d/Y', $payDate).' +2 weeks');
                        $endDay = strtotime(date('m/d/Y', $endDay).' +2 weeks');
                    } while($payDate <= strtotime(date('m/d/Y')));
                }
                $endDay = date('m/d/Y', $endDay);
                $payDate = date('m/d/Y', $payDate);
                $firstPayDate = date('m/d/Y', strtotime($payDate.' +8 weeks'));
                $lastDateString = date('m/d/Y', strtotime($endDay.' +8 weeks'));
                $firstDateString = date('m/d/Y', strtotime($lastDateString.' -13 days'));
                $dropdownLimit = 18;
            break;
            case 'twice-month' :
                $currentMonth = intval(date("m"));
                $currentYear = intval(date("Y"));
                $firstPayDay = $paySchedule->first_payday === "0" ? strtotime(date("m/t/Y", strtotime(date("m/d/Y")))) : strtotime(date("m/$paySchedule->first_payday/Y"));
                $secondPayDay = $paySchedule->second_payday === "0" ? strtotime(date("m/t/Y", strtotime(date("m/d/Y")))) : strtotime(date("m/$paySchedule->second_payday/Y"));
                $currentDate = strtotime(date("m/d/Y"));

                if($currentDate <= $firstPayDay) {
                    $payDate = $firstPayDay;
                    $payDateMonth = intval(date('m', $payDate));
                    $payDateYear = intval(date('Y', $payDate));

                    if($paySchedule->end_of_first_pay_period === 'end-date') {
                        switch($paySchedule->first_pay_month) {
                            case 'same' :
                                $endDay = $paySchedule->first_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear")));
                            break;
                            case 'previous' :
                                $endDay = $paySchedule->first_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear -1 month")));
                            break;
                            case 'next' :
                                $endDay = $paySchedule->first_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear +1 month"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear +1 month")));
                            break;
                        }
                    } else {
                        $endDay = strtotime(date("m/d/Y", $payDate)." -$paySchedule->first_pay_days_before days");
                    }

                    $payDate = date('m/d/Y', $payDate);
                    $payDateMonth = intval(date('m', strtotime($payDate)));
                    $payDateYear = date('Y', strtotime($payDate));
                    $payDateDay = date('d', strtotime($payDate));
                    $firstPayDate = $paySchedule->first_payday === "0" ? date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear +2 months")) : date('m/d/Y', strtotime("$payDate +2 months"));
                } else {
                    $payDate = $secondPayDay;
                    $payDateMonth = intval(date('m', $payDate));
                    $payDateYear = intval(date('Y', $payDate));

                    if($paySchedule->end_of_second_pay_period === 'end-date') {
                        switch($paySchedule->second_pay_month) {
                            case 'same' :
                                $endDay = $paySchedule->second_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_pay_day/$payDateYear")));
                            break;
                            case 'previous' :
                                $endDay = $paySchedule->second_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_pay_day/$payDateYear -1 month")));
                            break;
                            case 'next' :
                                $endDay = $paySchedule->second_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear +1 month"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_pay_day/$payDateYear +1 month")));
                            break;
                        }
                    } else {
                        $endDay = strtotime(date("m/d/Y", $payDate)." -$paySchedule->second_pay_days_before days");
                    }

                    $payDate = date('m/d/Y', $payDate);
                    $payDateMonth = intval(date('m', strtotime($payDate)));
                    $payDateYear = date('Y', strtotime($payDate));
                    $payDateDay = date('d', strtotime($payDate));
                    $firstPayDate = $paySchedule->second_payday === "0" ? date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear +2 months")) : date('m/d/Y', strtotime("$payDate +2 months"));
                }

                $endDay = date('m/d/Y', $endDay);
                $endDayMonth = intval(date('m', strtotime($endDay)));
                $endDayYear = date('Y', strtotime($endDay));

                $payDateMonth = date("m", strtotime($firstPayDate));
                $payDateYear = date("Y", strtotime($firstPayDate));
                $payDateDay = date("d", strtotime($firstPayDate));
                $first = $paySchedule->first_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_payday/$payDateYear"));
                $second = $paySchedule->second_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_payday/$payDateYear"));

                if($firstPayDate === $first) {
                    if($paySchedule->end_of_first_pay_period === 'end-date') {
                        switch($paySchedule->first_pay_month) {
                            case 'same' :
                                $lastDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear"));
                            break;
                            case 'previous' :
                                $lastDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear -1 month"));
                            break;
                            case 'next' :
                                $lastDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear +1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear +1 month"));
                            break;
                        }
                    } else {
                        $lastDateString = date("m/d/Y", strtotime("$firstPayDate -$paySchedule->first_pay_days_before days"));
                    }

                    $prevPayDate = $paySchedule->second_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_payday/$payDateYear -1 month"));
                    $prevPayMonth = date("m", strtotime($prevPayDate));
                    $prevPayYear = date("Y", strtotime($prevPayDate));

                    if($paySchedule->end_of_second_pay_period === 'end-date') {
                        switch($paySchedule->second_pay_month) {
                            case 'same' :
                                $firstDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->second_pay_day/$prevPayYear"));
                            break;
                            case 'previous' :
                                $firstDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear -1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->second_pay_day/$prevPayYear -1 month"));
                            break;
                            case 'next' :
                                $firstDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear +1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->second_pay_day/$prevPayYear +1 month"));
                            break;
                        }
                    } else {
                        $firstDateString = date("m/d/Y", strtotime("$prevPayDate -$paySchedule->second_pay_days_before days"));
                    }
                } else {
                    if($paySchedule->end_of_second_pay_period === 'end-date') {
                        switch($paySchedule->second_pay_month) {
                            case 'same' :
                                $lastDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_pay_day/$payDateYear"));
                            break;
                            case 'previous' :
                                $lastDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_pay_day/$payDateYear -1 month"));
                            break;
                            case 'next' :
                                $lastDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear +1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_pay_day/$payDateYear +1 month"));
                            break;
                        }
                    } else {
                        $lastDateString = date("m/d/Y", strtotime("$firstPayDate -$paySchedule->second_pay_days_before days"));
                    }

                    $prevPayDate = $paySchedule->first_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_payday/$payDateYear"));
                    $prevPayMonth = date("m", strtotime($prevPayDate));
                    $prevPayYear = date("Y", strtotime($prevPayDate));

                    if($paySchedule->end_of_first_pay_period === 'end-date') {
                        switch($paySchedule->first_pay_month) {
                            case 'same' :
                                $firstDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->first_pay_day/$prevPayYear"));
                            break;
                            case 'previous' :
                                $firstDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear -1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->first_pay_day/$prevPayYear -1 month"));
                            break;
                            case 'next' :
                                $firstDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear +1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->first_pay_day/$prevPayYear +1 month"));
                            break;
                        }
                    } else {
                        $firstDateString = date("m/d/Y", strtotime("$prevPayDate -$paySchedule->first_pay_days_before days"));
                    }
                }
                $firstDateString = date("m/d/Y", strtotime("$firstDateString +1 day"));
                
                $dropdownLimit = 17;
            break;
            case 'every-month' :
                $currentMonth = intval(date("m"));
                $currentYear = intval(date("Y"));
                $firstPayDate = $paySchedule->first_payday === "0" ? cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) : intval($paySchedule->first_payday);
                $firstPayDay = strtotime(date("m/$firstPayDate/Y"));
                $currentDate = strtotime(date("m/d/Y"));

                if($currentDate <= $firstPayDay) {
                    $payDate = $firstPayDay;
                } else {
                    $payDate = strtotime(date("m/d/Y").' +1 month');
                    $payDateMonth = intval(date('m', $payDate));
                    $payDateYear = intval(date('Y', $payDate));
                    $payDate = $paySchedule->first_payday === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear"))) : strtotime(date("$payDateMonth/$firstPayDate/$payDateYear"));
                }
                $payDateMonth = date('m', $payDate);
                $payDateYear = date('Y', $payDate);

                if($paySchedule->end_of_first_pay_period === 'end-date') {
                    switch($paySchedule->first_pay_month) {
                        case 'same' :
                            $endDay = $paySchedule->first_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear")));
                        break;
                        case 'previous' :
                            $endDay = $paySchedule->first_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear -1 month")));
                        break;
                        case 'next' :
                            $endDay = $paySchedule->first_pay_day === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear +1 month"))) : strtotime(date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear +1 month")));
                        break;
                    }
                } else {
                    $endDay = strtotime(date("m/d/Y", $payDate)." -$paySchedule->first_pay_days_before days");
                }

                $payDate = date('m/d/Y', $payDate);
                $endDay = date('m/d/Y', $endDay);
                $month = intval(date('m', strtotime($endDay)));
                $year = intval(date('Y', strtotime($endDay)));
                $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $payDateMonth = intval(date('m', strtotime($payDate)));
                $payDateYear = intval(date('Y', strtotime($payDate)));
                $payDateTotalDays = cal_days_in_month(CAL_GREGORIAN, $payDateMonth, $payDateYear);

                if($paySchedule->first_payday === "0") {
                    $firstPayDate = date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear +4 months"));
                } else {
                    $firstPayDate = date('m/d/Y', strtotime($payDate.' +4 months'));
                }
                $payDateMonth = intval(date('m', strtotime($firstPayDate)));
                $payDateYear = intval(date('Y', strtotime($firstPayDate)));

                $prevPayDate = $paySchedule->first_payday === "0" ? date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear -1 month")) : date('m/d/Y', strtotime("$payDateMonth/$paySchedule->first_payday/$payDateYear -1 month"));
                $prevPayDateMonth = intval(date('m', strtotime($prevPayDate)));
                $prevPayDateYear = intval(date('Y', strtotime($prevPayDate)));

                if($paySchedule->end_of_first_pay_period === 'end-date') {
                    switch($paySchedule->first_pay_month) {
                        case 'same' :
                            $lastDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear")) : date('m/d/Y', strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear"));
                            $firstDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$prevPayDateMonth/01/$prevPayDateYear")) : date('m/d/Y', strtotime("$prevPayDateMonth/$paySchedule->first_pay_day/$prevPayDateYear"));
                        break;
                        case 'previous' :
                            $lastDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear -1 month")) : date('m/d/Y', strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear -1 month"));
                            $firstDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$prevPayDateMonth/01/$prevPayDateYear -1 month")) : date('m/d/Y', strtotime("$prevPayDateMonth/$paySchedule->first_pay_day/$prevPayDateYear -1 month"));
                        break;
                        case 'next' :
                            $lastDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear +1 month")) : date('m/d/Y', strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear +1 month"));
                            $firstDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$prevPayDateMonth/01/$prevPayDateYear +1 month")) : date('m/d/Y', strtotime("$prevPayDateMonth/$paySchedule->first_pay_day/$prevPayDateYear +1 month"));
                        break;
                    }
                } else {
                    $lastDateString = date('m/d/Y', strtotime("$firstPayDate -$paySchedule->first_pay_days_before days"));
                    $firstDateString = date('m/d/Y', strtotime("$prevPayDate -$paySchedule->first_pay_days_before days"));
                }

                $firstDateString = date("m/d/Y", strtotime("$firstDateString +1 day"));

                $dropdownLimit = 11;
            break;
        }

        $payPeriod = [
            [
                'first_day' => $firstDateString,
                'last_day' => $lastDateString,
                'selected' => (strtotime($payDate) === strtotime($firstPayDate)) ? true : false,
                'pay_date' => $firstPayDate
            ]
        ];

        for($i = 0; count($payPeriod) < $dropdownLimit; $i++ ) {
            $lastDateString = date('m/d/Y', strtotime($firstDateString.' -1 day'));
            switch($paySchedule->pay_frequency) {
                case 'every-week' :
                    $firstDateString = date('m/d/Y', strtotime($lastDateString.' -6 days'));
                    $firstPayDate = date('m/d/Y', strtotime($firstPayDate.' -7 days'));
                break;
                case 'every-other-week' :
                    $firstDateString = date('m/d/Y', strtotime($lastDateString.' -13 days'));
                    $firstPayDate = date('m/d/Y', strtotime($firstPayDate.' -2 weeks'));
                break;
                case 'twice-month' :
                    $payDateMonth = intval(date('m', strtotime($firstPayDate)));
                    $payDateYear = intval(date('Y', strtotime($firstPayDate)));
                    $firstPayDay = $paySchedule->first_payday === "0" ? strtotime(date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear"))) : strtotime("$payDateMonth/$paySchedule->first_payday/$payDateYear");
                    if(strtotime($firstPayDate) === $firstPayDay) {
                        $firstPayDate = date('m/d/Y', strtotime("$payDateMonth/01/$payDateYear -1 month"));
                        $payDateMonth = intval(date('m', strtotime($firstPayDate)));
                        $payDateYear = intval(date('Y', strtotime($firstPayDate)));
                        $firstPayDate = $paySchedule->second_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_payday/$payDateYear"));
                    } else {
                        $firstPayDate = date('m/d/Y', $firstPayDay);
                    }

                    $payDateMonth = intval(date('m', strtotime($firstPayDate)));
                    $payDateYear = intval(date('Y', strtotime($firstPayDate)));
                    $firstPayDay = $paySchedule->first_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_payday/$payDateYear"));

                    if(date('m/d/Y', strtotime($firstPayDate)) === $firstPayDay) {
                        $prevPayDate = $paySchedule->second_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->second_payday/$payDateYear -1 month"));

                        if($paySchedule->end_of_second_pay_period === 'end-date') {
                            $prevPayMonth = date("m", strtotime($prevPayDate));
                            $prevPayYear = date("Y", strtotime($prevPayDate));

                            switch($paySchedule->second_pay_month) {
                                case 'same' :
                                    $firstDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->second_pay_day/$prevPayYear"));
                                break;
                                case 'previous' :
                                    $firstDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear -1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->second_pay_day/$prevPayYear -1 month"));
                                break;
                                case 'next' :
                                    $firstDateString = $paySchedule->second_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear +1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->second_pay_day/$prevPayYear +1 month"));
                                break;
                            }
                        } else {
                            $firstDateString = date('m/d/Y', strtotime("$prevPayDate -$paySchedule->second_pay_days_before days"));
                        }
                    } else {
                        $prevPayDate = $paySchedule->first_payday === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_payday/$payDateYear"));

                        if($paySchedule->end_of_first_pay_period === 'end-date') {
                            $prevPayMonth = date("m", strtotime($prevPayDate));
                            $prevPayYear = date("Y", strtotime($prevPayDate));

                            switch($paySchedule->first_pay_month) {
                                case 'same' :
                                    $firstDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->first_pay_day/$prevPayYear"));
                                break;
                                case 'previous' :
                                    $firstDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear -1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->first_pay_day/$prevPayYear -1 month"));
                                break;
                                case 'next' :
                                    $firstDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$prevPayMonth/01/$prevPayYear +1 month")) : date("m/d/Y", strtotime("$prevPayMonth/$paySchedule->first_pay_day/$prevPayYear +1 month"));
                                break;
                            }
                        } else {
                            $firstDateString = date('m/d/Y', strtotime("$prevPayDate -$paySchedule->first_pay_days_before days"));
                        }
                    }

                    $firstDateString = date('m/d/Y', strtotime("$firstDateString +1 day"));
                break;
                case 'every-month' :
                    if($paySchedule->first_payday === "0") {
                        $payDateMonth = intval(date('m', strtotime($firstPayDate)));
                        $payDateYear = intval(date('Y', strtotime($firstPayDate)));

                        $firstPayDate = date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear -1 month"));
                    } else {
                        $firstPayDate = date('m/d/Y', strtotime($firstPayDate.' -1 month'));
                    }

                    $payDateMonth = intval(date('m', strtotime($firstPayDate)));
                    $payDateYear = intval(date('Y', strtotime($firstPayDate)));

                    $prevPayDate = $paySchedule->first_payday === "0" ? date('m/t/Y', strtotime("$payDateMonth/01/$payDateYear -1 month")) : date('m/d/Y', strtotime("$payDateMonth/$paySchedule->first_payday/$payDateYear -1 month"));
                    $prevPayDateMonth = intval(date('m', strtotime($prevPayDate)));
                    $prevPayDateYear = intval(date('Y', strtotime($prevPayDate)));

                    if($paySchedule->end_of_first_pay_period === 'end-date') {
                        switch($paySchedule->first_pay_month) {
                            case 'same' :
                                $lastDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear"));
                                $firstDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$prevPayDateMonth/01/$prevPayDateYear")) : date('m/d/Y', strtotime("$prevPayDateMonth/$paySchedule->first_pay_day/$prevPayDateYear"));
                            break;
                            case 'previous' :
                                $lastDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear -1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear -1 month"));
                                $firstDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$prevPayDateMonth/01/$prevPayDateYear -1 month")) : date('m/d/Y', strtotime("$prevPayDateMonth/$paySchedule->first_pay_day/$prevPayDateYear -1 month"));
                            break;
                            case 'next' :
                                $lastDateString = $paySchedule->first_pay_day === "0" ? date("m/t/Y", strtotime("$payDateMonth/01/$payDateYear +1 month")) : date("m/d/Y", strtotime("$payDateMonth/$paySchedule->first_pay_day/$payDateYear +1 month"));
                                $firstDateString = $paySchedule->first_pay_day === "0" ? date('m/t/Y', strtotime("$prevPayDateMonth/01/$prevPayDateYear +1 month")) : date('m/d/Y', strtotime("$prevPayDateMonth/$paySchedule->first_pay_day/$prevPayDateYear +1 month"));
                            break;
                        }
                    } else {
                        $lastDateString = date('m/d/Y', strtotime("$firstPayDate -$paySchedule->first_pay_days_before days"));
                        $firstDateString = date('m/d/Y', strtotime("$prevPayDate -$paySchedule->first_pay_days_before days"));
                    }

                    $firstDateString = date("m/d/Y", strtotime("$firstDateString +1 day"));
                break;
            }

            $payPeriod[] = [
                'first_day' => $firstDateString,
                'last_day' => $lastDateString,
                'selected' => (strtotime($payDate) === strtotime($firstPayDate)) ? true : false,
                'pay_date' => $firstPayDate
            ];
        }

        $this->page_data['payPeriods'] = $payPeriod;
        $this->page_data['accounts'] = $accounts;
        $this->page_data['payDate'] = $payDate;

        $this->load->view('accounting/modals/payroll_form', $this->page_data);
    }

    public function generate_payroll() {
        $postData = $this->input->post();
        $socialSecurity = 6.2;
        $medicare = 1.45;
        $futa = 0.006;
        $sui = 0.00;
        // $sui = 2.7;

        $this->page_data['payPeriod'] = str_replace('-', ' to ', $postData['pay_period']);
        $this->page_data['payDate'] = date('l, M d', strtotime($postData['pay_date']));

        $employees = [];
        foreach($postData['select'] as $key => $empId) {
            $emp = $this->users_model->getUser($empId);

            $empTotalPay = ($emp->pay_rate * (float)$postData['reg_pay_hours'][$key]) + (float)$postData['commission'][$key];
            $empTotalPay = number_format($empTotalPay, 2, '.', ',');

            $empSocial = ($empTotalPay / 100) * $socialSecurity;
            $empSocial = number_format($empSocial, 2, '.', ',');
            $empMedicare = ($empTotalPay / 100) * $medicare;
            $empMedicare = number_format($empMedicare, 2, '.', ',');
            $empTax = number_format($empSocial + $empMedicare, 2, '.', ',');
            $employeeSUI = ($empTotalPay / 100) * $sui;
            $employeeSUI = number_format($employeeSUI, 2, '.', ',');

            $netPay = $empTotalPay - $empTax;

            $employees[] = [
                'id' => $emp->id,
                'name' => $emp->LName . ', ' . $emp->FName,
                'pay_method' => 'Paper check',
                'employee_hours' => $postData['reg_pay_hours'][$key],
                'total_pay' => $empTotalPay,
                'employee_tax' => $empTax,
                'net_pay' => number_format($netPay, 2, '.', ','),
                'employee_futa' => number_format($empTotalPay * $futa, 2, '.', ','),
                'employee_sui' => $employeeSUI
            ];
        }

        $totalHours = array_sum(array_column($employees, 'employee_hours'));
        $totalHours =  number_format($totalHours, 2, '.', ',');
        $totalPay = array_sum(array_column($employees, 'total_pay'));
        $totalPay = number_format($totalPay, 2, '.', ',');
        $totalTaxes = array_sum(array_column($employees, 'employee_tax'));
        $totalTaxes = number_format($totalTaxes, 2, '.', ',');
        $totalNetPay = array_sum(array_column($employees, 'net_pay'));
        $totalNetPay = number_format($totalNetPay, 2, '.', ',');
        $totalFuta = array_sum(array_column($employees, 'employee_futa'));
        $totalFuta = number_format($totalFuta, 2, '.', ',');
        $totalSUI = array_sum(array_column($employees, 'employee_sui'));
        $totalSUI = number_format($totalSUI, 2, '.', ',');

        $totalEmployerTax = $totalTaxes + $totalFuta + $totalSUI;

        $totalPayrollCost = $totalNetPay + $totalTaxes + $totalEmployerTax;

        $this->page_data['employees'] = $employees;
        $this->page_data['total'] = [
            'total_hours' => $totalHours,
            'total_pay' => $totalPay,
            'total_taxes' => $totalTaxes,
            'total_net_pay' => $totalNetPay,
            'total_employer_tax' => number_format($totalEmployerTax, 2, '.', ','),
            'total_payroll_cost' => number_format($totalPayrollCost, 2, '.', ',')
        ];

        $this->load->view("accounting/modals/payroll_summary", $this->page_data);
    }

    public function get_statement_customers() {
        $input = $this->input->post();
        $company_id = logged('company_id');

        $data = [
            'cust_bal_status' => $input['cust_bal_status'],
            'company_id' => $company_id,
            'start_date' => ($input['statement_type'] === '2') ? date('Y-m-d', strtotime(' -1 year')) : date('Y-m-d', strtotime($input['start_date'])),
            'end_date' => ($input['statement_type'] === '2') ? date('Y-m-d') : date('Y-m-d', strtotime($input['end_date']))
        ];

        if($input['statement_type'] === '1' || $input['statement_type'] === '2') {
            $customers = $this->accounting_invoices_model->getStatementInvoices($data);
        } else {
            $customers = $this->accounting_invoices_model->getTransactionInvoices($data);
        }

        $display = [];
        foreach($customers as $customer) {
            $index = array_search($customer->customer_id, array_column($display, 'id'));
            if($index === false) {
                $balance = ($customer->status === '1') ? $customer->amount : 0.00;
                $display[] = [
                    'id' => $customer->customer_id,
                    'name' => $customer->first_name . ' ' . $customer->last_name,
                    'email' => $customer->email,
                    'balance' => number_format($balance, 2, '.', ',')
                ];
            } else {
                if($customer->status === '1' || $customer->status === '2' && $input['statement_type'] === '3' && $input['cust_bal_status'] === 'overdue') {
                    $balance = (int)$display[$index]['balance'] + $customer->amount;
                    $display[$index]['balance'] = number_format($balance, 2, '.', ',');
                }
            }
        }

        $totalBalance = array_sum(array_map(function($item) { 
            return $item['balance']; 
        }, $display));

        $withoutEmail = [];
        foreach($display as $cust) {
            if($cust['email'] === '') {
                $withoutEmail[] = $cust;
            }
        }

        $result = [
            'customers' => $display,
            'total' => number_format($totalBalance, 2, '.', ','),
            'withoutEmail' => $withoutEmail
        ];

        echo json_encode($result);
    }

    public function getAccountBalance($accountId = "") {
        $account = $this->chart_of_accounts_model->getById($accountId);

        if(strpos($account->balance, '-') !== false) {
            $balance = str_replace('-', '', $account->balance);
            $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
        } else {
            $selectedBalance = '$'.number_format($account->balance, 2, '.', ',');
        }

        echo json_encode(['balance' => $selectedBalance]);
    }

    public function getItemDetails($id) {
        $item = $this->items_model->getItemById($id)[0];
        $locations = $this->items_model->getLocationByItemId($id);

        echo json_encode(['item' => $item, 'locations' => $locations]);
    }

    public function action() {
        $data = $this->input->post();
        $modalName = $data['modal_name'];

        if(isset($_FILES['attachments'])) {
            $files = $_FILES['attachments'];
        }

        try {
            switch ($modalName) {
                case 'transferModal':
                    $this->result = $this->transfer_funds($data, $files);
                break;
                case 'payDownCreditModal':
                    $this->result = $this->pay_down_credit_card($data, $files);
                break;
                case 'singleTimeModal';
                    $this->result = $this->single_time_activity($data);
                break;
                case 'journalEntryModal':
                    $this->result = $this->journal_entry($data, $files);
                break;
                case 'depositModal':
                    $this->result = $this->bank_deposit($data, $files);
                break;
                case 'inventoryModal':
                    $this->result = $this->inventory_qty_adjustment($data);
                break;
                case 'weeklyTimesheetModal':
                    $this->result = $this->weekly_timesheet($data);
                break;
                case 'payrollModal':
                    $this->result = $this->payroll($data);
                break;
                case 'statementModal':
                    $this->result = $this->statement($data);
                break;
                case 'commission-payroll-modal' :
                    $this->result = $this->payroll($data, 'commission-only');
                break;
                case 'bonus-payroll-modal' :
                    $this->result = $this->payroll($data, 'bonus');
                break;
                case 'expenseModal' :
                    $this->result = $this->expense($data);
                break;
                case 'checkModal' :
                    $this->result = $this->check($data);
                break;
                case 'billModal' :
                    $this->result = $this->bill($data);
                break;
                case 'payBillsModal' :
                    $this->result = $this->pay_bills($data);
                break;
                case 'vendorCreditModal' :
                    $this->result = $this->vendor_credit($data);
                break;
                case 'purchaseOrderModal' :
                    $this->result = $this->purchase_order($data);
                break;
                case 'creditCardCreditModal' :
                    $this->result = $this->credit_card_credit($data);
                break;
            }
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }

        echo json_encode($this->result);
        exit;
    }

    private function transfer_funds($data, $files) {
        $this->form_validation->set_rules('transfer_from', 'Transfer From Account', 'required');
        $this->form_validation->set_rules('transfer_to', 'Transfer To Account', 'required|differs[transfer_from]');
        $this->form_validation->set_rules('transfer_amount', 'Amount', 'required');

        if(isset($data['template_name'])) {
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
        } else {
            $this->form_validation->set_rules('date', 'Date', 'required|date');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $insertData = [
                'company_id' => logged('company_id'),
                'transfer_from_account_id' => $data['transfer_from'],
                'transfer_to_account_id' => $data['transfer_to'],
                'transfer_amount' => $data['transfer_amount'],
                'transfer_date' => isset($data['date']) ? date('Y-m-d', strtotime($data['date'])) : null,
                'transfer_memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'recurring' => isset($data['template_name']) ? 1 : 0,
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
    
            $transferId = $this->accounting_transfer_funds_model->create($insertData);

            if($transferId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                if(isset($data['template_name'])) {
                    $recurringData = [
                        'company_id' => getLoggedCompanyID(),
                        'template_name' => $data['template_name'],
                        'recurring_type' => $data['recurring_type'],
                        'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['days_in_advance'] !== '' ? $data['days_in_advance'] : null : null,
                        'txn_type' => 'transfer',
                        'txn_id' => $transferId,
                        'recurring_interval' => $data['recurring_interval'],
                        'recurring_month' => $data['recurring_mode'] === 'yearly' ? $data['recurring_month'] : null,
                        'recurring_week' => $data['recurring_mode'] === 'monthly' ? $data['recurring_week'] : null,
                        'recurring_day' => $data['recurring_mode'] !== 'daily' ? $data['recurring_day'] : null,
                        'recurr_every' => $data['recurring_mode'] !== 'yearly' ? $data['recurr_every'] : null,
                        'start_date' => $data['recurring_type'] !== 'unscheduled' ? date('Y-m-d', strtotime($data['start_date'])) : null,
                        'end_type' => $data['end_type'],
                        'end_date' => $data['end_type'] === 'by' ? date('Y-m-d', strtotime($data['end_date'])) : null,
                        'max_occurences' => $data['end_type'] === 'after' ? $data['max_occurence'] : null,
                        'status' => 1,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
    
                    $recurringId = $this->accounting_recurring_transactions_model->create($recurringData);
    
                    $return['data'] = $transferId;
                    $return['success'] = $transferId && $recurringId ? true : false;
                    $return['message'] = $transferId && $recurringId ? 'Template saved!' : 'An unexpected error occured!';
                }
            }

            $return['data'] = $transferId;
            $return['success'] = $transferId ? true : false;
            $return['message'] = $transferId ? 'Transfer Successfully!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function pay_down_credit_card($data, $files) {
        $this->form_validation->set_rules('credit_card', 'Credit Card', 'required');
        $this->form_validation->set_rules('payee', 'Payee', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('payment_date', 'Date of Payment', 'required');
        $this->form_validation->set_rules('bank_account', 'Date of Payment', 'required');

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $bankAccount = explode('-', $data['bank_account']);

            $insertData = [
                'company_id' => logged('company_id'),
                'credit_card_id' => $data['credit_card'],
                'payee_id' => $data['payee'],
                'amount' => $data['amount'],
                'date' => date('Y-m-d', strtotime($data['payment_date'])),
                'bank_account_id' => $data['bank_account'],
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $payDownId = $this->accounting_pay_down_credit_card_model->create($insertData);

            if($payDownId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                $creditAcc = $this->chart_of_accounts_model->getById($data['credit_card']);

                $newBalance = floatval($creditAcc->balance) - floatval($data['amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $this->chart_of_accounts_model->updateBalance(['id' => $creditAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);

                $bankAcc = $this->chart_of_accounts_model->getById($data['bank_account']);

                $newBalance = floatval($bankAcc->balance) - floatval($data['amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $this->chart_of_accounts_model->updateBalance(['id' => $bankAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);
            }

            $return['data'] = $payDownId;
            $return['success'] = $payDownId ? true : false;
            $return['message'] = $payDownId ? 'Payment Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function single_time_activity($data) {
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('customer', 'Customer', 'required');
        $this->form_validation->set_rules('service', 'Service', 'required');
        if($data['billable'] === 1 || $data['billable'] === "1") {
            $this->form_validation->set_rules('hourly_rate', 'Hourly Rate', 'required');
        }

        if($data['start_end_time'] === 1 || $data['start_end_time'] === "1") {
            $this->form_validation->set_rules('start_time', 'Start Time', 'required');
            $this->form_validation->set_rules('end_time', 'End Time', 'required');
        } else {
            $this->form_validation->set_rules('time', 'Time', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $name = explode('-', $data['name']);
            $insertData = [
                'company_id' => logged('company_id'),
                'date' => date('Y-m-d', strtotime($data['date'])),
                'name_key' => $name[0],
                'name_id' => $name[1],
                'customer_id' => $data['customer'],
                'service_id' => $data['service'],
                'billable' => (isset($data['billable'])) ? 1 : 0,
                'hourly_rate' => (isset($data['billable'])) ? $data['hourly_rate'] : null,
                'taxable' => (isset($data['billable']) && isset($data['taxable'])) ? 1 : 0,
                'start_time' => (isset($data['start_end_time'])) ? $data['start_time'] : null,
                'end_time' => (isset($data['start_end_time'])) ? $data['end_time'] : null,
                'time' => $data['time'],
                'description' => $data['description'],
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $activityId = $this->accounting_single_time_activity_model->create($insertData);
            
            $return['data'] = $activityId;
            $return['success'] = $activityId ? true : false;
            $return['message'] = $activityId ? 'Record Successfully!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function journal_entry($data, $files) {
        if(isset($data['template_name'])) {
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
        } else {
            $this->form_validation->set_rules('journal_date', 'Date', 'required');
            $this->form_validation->set_rules('journal_no', 'Journal No.', 'required');
        }

        $totalDebit = array_sum(array_map(function($item) { 
            return $item;
        }, $data['debits']));

        $totalCredit = array_sum(array_map(function($item) { 
            return $item;
        }, $data['credits']));

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(isset($data['accounts']) && count($data['accounts']) < 2 || !isset($data['accounts'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'You must fill out at least two detail lines.';
        } else if($totalDebit !== $totalCredit) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please balance debits and credits.';
        } else {
            $insertData = [
                'company_id' => logged('company_id'),
                'journal_no' => (!isset($data['template_name'])) ? $data['journal_no'] : null,
                'journal_date' => (!isset($data['template_name'])) ? date('Y-m-d', strtotime($data['journal_date'])) : null,
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $entryId = $this->accounting_journal_entries_model->create($insertData);

            if($entryId > 0) {
                if(isset($data['template_name'])) {
                    $recurringData = [
                        'company_id' => getLoggedCompanyID(),
                        'template_name' => $data['template_name'],
                        'recurring_type' => $data['recurring_type'],
                        'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['days_in_advance'] !== '' ? $data['days_in_advance'] : null : null,
                        'txn_type' => 'journal entry',
                        'txn_id' => $entryId,
                        'recurring_interval' => $data['recurring_interval'],
                        'recurring_month' => $data['recurring_mode'] === 'yearly' ? $data['recurring_month'] : null,
                        'recurring_week' => $data['recurring_mode'] === 'monthly' ? $data['recurring_week'] : null,
                        'recurring_day' => $data['recurring_mode'] !== 'daily' ? $data['recurring_day'] : null,
                        'recurr_every' => $data['recurring_mode'] !== 'yearly' ? $data['recurr_every'] : null,
                        'start_date' => $data['recurring_type'] !== 'unscheduled' ? date('Y-m-d', strtotime($data['start_date'])) : null,
                        'end_type' => $data['end_type'],
                        'end_date' => $data['end_type'] === 'by' ? date('Y-m-d', strtotime($data['end_date'])) : null,
                        'max_occurences' => $data['end_type'] === 'after' ? $data['max_occurence'] : null,
                        'status' => 1,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
    
                    $recurringId = $this->accounting_recurring_transactions_model->create($recurringData);
                }

                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                $entryItems = [];
                foreach ($data['accounts'] as $key => $value) {
                    $name = explode('-', $data['names'][$key]);
                    $account = explode('-', $value);
    
                    $entryItems[] = [
                        'journal_entry_id' => $entryId,
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
            }

            $return['data'] = $entryId;
            $return['success'] = $entryId && $entryItemsId ? true : false;
            $return['message'] = $entryId && $entryItemsId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function bank_deposit($data, $files) {
        $this->form_validation->set_rules('bank_account', 'Bank Account', 'required');

        if($data['cash_back_amount'] !== "") {
            $this->form_validation->set_rules('cash_back_target', 'Cash back account', 'required|differs[bank_account]');
        }

        if(isset($data['account']) && isset($data['amount'])) {
            $this->form_validation->set_rules('account[]', 'Account', 'required');
            $this->form_validation->set_rules('amount[]', 'Amount', 'required');
        }

        if(!isset($data['template_name'])) {
            $this->form_validation->set_rules('date', 'Date', 'required');
        } else {
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
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['account']) && !isset($data['amount'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one line item.';
        } else {
            $totalAmount = array_sum(array_map(function($item) {
                return floatval($item);
            }, $data['amount']));

            $totalAmount = $totalAmount - floatval($data['cash_back_amount']);

            $insertData = [
                'company_id' => logged('company_id'),
                'account_id' => $data['bank_account'],
                'date' => isset($data['template_name']) ? null : date('Y-m-d', strtotime($data['date'])),
                'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                'total_amount' => number_format($totalAmount, 2, '.', ','),
                'cash_back_account_id' => $data['cash_back_target'],
                'cash_back_memo' => $data['cash_back_memo'],
                'cash_back_amount' => $data['cash_back_amount'],
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'recurring' => isset($data['template_name']) ? 1 : 0,
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $depositId = $this->accounting_bank_deposit_model->create($insertData);

            if($depositId > 0) {
                if(isset($data['template_name'])) {
                    $recurringData = [
                        'company_id' => getLoggedCompanyID(),
                        'template_name' => $data['template_name'],
                        'recurring_type' => $data['recurring_type'],
                        'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['days_in_advance'] !== '' ? $data['days_in_advance'] : null : null,
                        'txn_type' => 'deposit',
                        'txn_id' => $depositId,
                        'recurring_interval' => $data['recurring_interval'],
                        'recurring_month' => $data['recurring_mode'] === 'yearly' ? $data['recurring_month'] : null,
                        'recurring_week' => $data['recurring_mode'] === 'monthly' ? $data['recurring_week'] : null,
                        'recurring_day' => $data['recurring_mode'] !== 'daily' ? $data['recurring_day'] : null,
                        'recurr_every' => $data['recurring_mode'] !== 'yearly' ? $data['recurr_every'] : null,
                        'start_date' => $data['recurring_type'] !== 'unscheduled' ? date('Y-m-d', strtotime($data['start_date'])) : null,
                        'end_type' => $data['end_type'],
                        'end_date' => $data['end_type'] === 'by' ? date('Y-m-d', strtotime($data['end_date'])) : null,
                        'max_occurences' => $data['end_type'] === 'after' ? $data['max_occurence'] : null,
                        'status' => 1,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
    
                    $recurringId = $this->accounting_recurring_transactions_model->create($recurringData);
                }

                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                $fundsData = [];
                foreach($data['account'] as $key => $value) {
                    $account = explode('-', $value);
                    $receivedFrom = explode('-', $data['received_from'][$key]);

                    $fundsData[] =[
                        'bank_deposit_id' => $depositId,
                        'received_from_key' => $receivedFrom[0],
                        'received_from_id' => $receivedFrom[1],
                        'received_from_account_key' => $account[0],
                        'received_from_account_id' => $account[1],
                        'description' => $data['description'][$key],
                        'payment_method' => $data['payment_method'][$key],
                        'ref_no' => $data['reference_no'][$key],
                        'amount' => $data['amount'][$key],
                    ];

                    if(!isset($data['template_name'])) {
                        $accountBalance = $this->chart_of_accounts_model->getBalance($account[1]);
                        $accountData = [
                            'id' => $account[1],
                            'company_id' => logged('company_id'),
                            'balance' => floatval($accountBalance) - floatval($data['amount'][$key])
                        ];
                        $withdraw = $this->chart_of_accounts_model->updateBalance($accountData);
                    }
                }

                $fundsId = $this->accounting_bank_deposit_model->insertFunds($fundsData);

                if(!isset($data['template_name'])) {
                    $depositToAcc = $this->chart_of_accounts_model->getById($bankAccount[1]);
                    $depositData = [
                        'id' => $depositToAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => floatval($depositToAcc->balance) + floatval($totalAmount)
                    ];
                    $deposit = $this->chart_of_accounts_model->updateBalance($depositData);

                    if($data['cash_back_amount'] !== "") {
                        $cashBackAccount = $this->chart_of_accounts_model->getById($cashBackTarget[1]);
                        $cashBackData = [
                            'id' => $cashBackAccount->id,
                            'company_id' => logged('company_id'),
                            'balance' => floatval($cashBackAccount->balance) + floatval($data['cash_back_amount'])
                        ];

                        $cashBack = $this->chart_of_accounts_model->updateBalance($cashBackData);
                    }
                }
            }

            $return['data'] = $depositId;
            $return['success'] = $depositId && $fundsId ? true : false;
            $return['message'] = $depositId && $fundsId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function inventory_qty_adjustment($data) {
        $this->form_validation->set_rules('adjustment_date', 'Date', 'required');
        $this->form_validation->set_rules('reference_no', 'Reference No.', 'required');
        $this->form_validation->set_rules('inventory_adj_acc', 'Inventory Adjustment Account', 'required');

        if(isset($data['product']) && isset($data['new_qty']) && isset($data['change_in_qty']) && isset($data['location'])) {
            $this->form_validation->set_rules('product[]', 'Product', 'required');
            $this->form_validation->set_rules('location[]', 'Location', 'required');
            $this->form_validation->set_rules('new_qty[]', 'New Quantity', 'required');
            $this->form_validation->set_rules('change_in_qty[]', 'Change in Quantity', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['product']) && !isset($data['new_qty']) && !isset($data['change_in_qty'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one inventory item.';
        } else {
            $adjustmentAcc = explode('-', $data['inventory_adj_acc']);
            $insertData = [
                'adjustment_no' => $data['reference_no'],
                'company_id' => logged('company_id'),
                'adjustment_date' => date('Y-m-d', strtotime($data['adjustment_date'])),
                'inventory_adjustment_account_id' => $adjustmentAcc[1],
                'inventory_adjustment_account_key' => $adjustmentAcc[0],
                'memo' => $data['memo'],
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $adjustmentId = $this->accounting_inventory_qty_adjustments_model->create($insertData);

            if($adjustmentId > 0) {
                $adjustmentProducts = [];
                $locationData = [];
                foreach($data['product'] as $key => $value) {
                    $adjustmentProducts[] = [
                        'adjustment_id' => $adjustmentId,
                        'product_id' => $value,
                        'location_id' => $data['location'][$key],
                        'new_quantity' => $data['new_qty'][$key],
                        'change_in_quantity' => $data['change_in_qty'][$key],
                    ];

                    $locationData[] = [
                        'id' => $data['location'][$key],
                        'qty' => $data['new_qty'][$key]
                    ];
                }

                $adjustQuantity = $this->items_model->updateBatchLocations($locationData);
                $adjustmentProdId = $this->accounting_inventory_qty_adjustments_model->insertAdjProduct($adjustmentProducts);
            }

            $return['data'] = $adjustmentId;
            $return['success'] = $adjustmentId && $adjustmentProdId && $adjustQuantity > 0 ? true : false;
            $return['message'] = $adjustmentId && $adjustmentProdId && $adjustQuantity > 0 ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function weekly_timesheet($data) {
        $this->form_validation->set_rules('person_tracking', 'Person being Tracked', 'required');
        $this->form_validation->set_rules('week_dates', 'Week Dates', 'required');

        if(isset($data['billable'])) {
            $this->form_validation->set_rules('hourly_rate[]', 'Week Dates', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(isset($data['customer']) && count($data['customer']) < 1 || !isset($data['customer'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'You must fill out at least two detail lines.';
        } else {
            $personTracking = explode('-', $data['person_tracking']);

            $weekDate = explode('-', $data['week_dates']);
            $weekStartDate = strtotime($weekDate[0]);
            $weekEndDate = strtotime($weekDate[1]);

            $insertData = [
                'company_id' => logged('company_id'),
                'name_key' => $personTracking[0],
                'name_id' => $personTracking[1],
                'week_start_date' => date('Y-m-d', $weekStartDate),
                'week_end_date' => date('Y-m-d', $weekEndDate),
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $timesheetRecordId = $this->accounting_weekly_timesheet_model->create($insertData);

            $employeeTimesheet = [];
            if($timesheetRecordId > 0) {
                foreach($data['customer'] as $key => $value) {
                    if($value !== "") {
                        $billable = isset($data['billable']) ? $data['billable'][$key] : null;
                        $hourlyRate = isset($data['billable'][$key]) ? $data['hourly_rate'][$key] : null;
                        $taxable = (isset($data['billable'][$key]) && isset($data['taxable'][$key])) ? $data['taxable'][$key] : null;
    
                        $weekDailyHours = [
                            'sunday' => $data['sunday_hours'][$key],
                            'monday' => $data['monday_hours'][$key],
                            'tuesday' => $data['tuesday_hours'][$key],
                            'wednesday' => $data['wednesday_hours'][$key],
                            'thursday' => $data['thursday_hours'][$key],
                            'friday' => $data['friday_hours'][$key],
                            'saturday' => $data['saturday_hours'][$key]
                        ];
    
                        $employeeTimesheet[] = [
                            'weekly_timesheet_id' => $timesheetRecordId,
                            'customer_id' => $value,
                            'service_id' => $data['service'][$key],
                            'description' => $data['description'][$key],
                            'billable' => $billable,
                            'hourly_rate' => $hourlyRate,
                            'taxable' => $taxable,
                            'week_daily_hours' => json_encode($weekDailyHours)
                        ];
                    }
                }
            }

            if(count($employeeTimesheet) > 0) {
                $timeSheetItemsId = $this->accounting_weekly_timesheet_model->insertEmployeeTimesheet($employeeTimesheet);

                $return['data'] = $timesheetRecordId;
                $return['success'] = $timesheetRecordId && $timeSheetItemsId ? true : false;
                $return['message'] = $timesheetRecordId && $timeSheetItemsId ? 'Entry Successful!' : 'An unexpected error occured!';
            } else {
                $return['data'] = null;
                $return['success'] = false;
                $return['message'] = 'Nothing inserted.';
            }
        }

        return $return;
    }

    private function payroll($data, $payType = 'all') {
        $this->form_validation->set_rules('pay_from', 'Pay from account', 'required');
        if($payType === 'all') {
            $this->form_validation->set_rules('pay_period', 'Pay Period', 'required');
        }
        $this->form_validation->set_rules('pay_date', 'Pay Date', 'required');

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $payPeriod = explode('-', $data['pay_period']);

            $company_id = logged('company_id');
            $payrollNo = $this->accounting_payroll_model->getCompanyLastPayrollNo($company_id);

            $insertData = [
                'payroll_no' => is_null($payrollNo) ? 1 : $payrollNo+1,
                'pay_from_account' => $data['pay_from'],
                'pay_period_start' => $data['pay_period'] !== null ? date('Y-m-d', strtotime($payPeriod[0])) : date('Y-m-d', strtotime($data['pay_date'])),
                'pay_period_end' => $data['pay_period'] !== null ? date('Y-m-d', strtotime($payPeriod[1])) : date('Y-m-d', strtotime($data['pay_date'])),
                'pay_date' => date('Y-m-d', strtotime($data['pay_date'])),
                'company_id' => $company_id,
                'pay_schedule_id' => $data['pay_schedule'],
                'payroll_type' => $payType,
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $payrollId = $this->accounting_payroll_model->create($insertData);

            $employees = [];

            if($payrollId > 0) {
                foreach($data['select'] as $key => $value) {
                    $emp = $this->users_model->getUser($value);
                    $empPayDetails = $this->users_model->getEmployeePayDetails($emp->id);
                    $empTotalPay = ($empPayDetails->pay_rate * (float)$data['reg_pay_hours'][$key]) + (float)$data['commission'][$key] + (float)$data['bonus'][$key];
                    $empTotalPay = number_format($empTotalPay, 2, '.', ',');
    
                    $empSocial = ($empTotalPay / 100) * 6.2;
                    $empSocial = number_format($empSocial, 2, '.', ',');
                    $empMedicare = ($empTotalPay / 100) * 1.45;
                    $empMedicare = number_format($empMedicare, 2, '.', ',');
                    $empTax = number_format($empSocial + $empMedicare, 2, '.', ',');
    
                    $employees[] = [
                        'payroll_id' => $payrollId,
                        'employee_id' => $value,
                        'employee_hours' => $data['reg_pay_hours'][$key],
                        'employee_commission' => $data['commission'][$key],
                        'employee_bonus' => $data['bonus'][$key],
                        'employee_total_pay' => $empTotalPay,
                        'employee_taxes' => $empTax,
                        'employee_net_pay' => $empTotalPay - $empTax,
                        'employee_memo' => ($data['memo'][$key] === '') ? null : $data['memo'][$key],
                    ];
                }
            }

            if(count($employees) > 0) {
                $payrollEmpId = $this->accounting_payroll_model->insertPayrollEmployees($employees);

                $totalNetPay = array_sum(array_column($employees, 'employee_net_pay'));
                $account = $this->chart_of_accounts_model->getById($data['pay_from']);
                $balance = floatval($account->balance) - floatval($totalNetPay);

                $update = $this->chart_of_accounts_model->updateBalance(['id' => $data['pay_from'], 'company_id' => $company_id, 'balance' => $balance]);

                $return['data'] = $payrollId;
                $return['success'] = $payrollId && $payrollEmpId ? true : false;
                $return['message'] = $payrollId && $payrollEmpId ? 'Entry Successful!' : 'An unexpected error occured!';
            } else {
                $return['data'] = null;
                $return['success'] = false;
                $return['message'] = 'Nothing inserted.';
            }
        }

        return $return;
    }

    private function statement($data) {
        $flag = true;

        $this->form_validation->set_rules('statement_type', 'Statement Type', 'required');
        $this->form_validation->set_rules('statement_date', 'Statement Date', 'required');
        $this->form_validation->set_rules('customer_balance_status', 'Customer Balance Status', 'required');

        if(isset($data['start_date']) && isset($data['end_date'])) {
            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('end_date', 'End Date', 'required');
        }

        if(isset($data['select_all'])) {
            $this->form_validation->set_rules('email[]', 'Email', 'required');
        } else {
            foreach($data['customer'] as $cust) {
                if($data['email'][$cust] === '') {
                    $flag = false;
                    break;
                }
            }
        }

        $return = [];

        if($this->form_validation->run() === false || $flag === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $insertData = [
                'statement_type' => $data['statement_type'],
                'statement_date' => date('Y-m-d', strtotime($data['statement_date'])),
                'customer_balance_status' => $data['customer_balance_status'],
                'start_date' => (isset($data['start_date'])) ? date('Y-m-d', strtotime($data['start_date'])) : null,
                'end_date' => (isset($data['end_date'])) ? date('Y-m-d', strtotime($data['end_date'])) : null,
                'company_id' => logged('company_id'),
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $statementId = $this->accounting_statements_model->create($insertData);

            if($statementId > 0) {
                $queryData = [
                    'cust_bal_status' => $data['customer_balance_status'],
                    'company_id' => logged('company_id'),
                    'start_date' => ($data['statement_type'] === '2') ? date('Y-m-d', strtotime(' -1 year')) : date('Y-m-d', strtotime($data['start_date'])),
                    'end_date' => ($data['statement_type'] === '2') ? date('Y-m-d') : date('Y-m-d', strtotime($data['end_date']))
                ];

                if($data['statement_type'] === '1' || $data['statement_type'] === '2') {
                    $invoices = $this->accounting_invoices_model->getStatementInvoices($queryData);
                } else {
                    $invoices = $this->accounting_invoices_model->getTransactionInvoices($queryData);
                }

                $statementCustomers = [];
                foreach($data['customer'] as $customer) {
                    $customerInvoices = array_filter($invoices, function($value, $key) use ($customer){
                        return $value->customer_id === $customer;
                    }, ARRAY_FILTER_USE_BOTH);

                    $balance = 0.00;
                    foreach($customerInvoices as $invoice) {
                        if($invoice->status === '1' || $invoice->status === '2' && $data['statement_type'] === '3' && $data['customer_balance_status'] === 'overdue') {
                            $balance += number_format($invoice->amount, 2, '.', ',');
                        }
                    }

                    $statementCustomers[] = [
                        'statement_id' => $statementId,
                        'customer_id' => $customer,
                        'email' => $data['email'][$customer],
                        'balance' => number_format($balance, 2, '.', ',')
                    ];
                }

                $statementCustomers = $this->accounting_statements_model->insertCustomers($statementCustomers);

                if(isset($data['subject']) && $statementCustomers > 0) {
                    $this->load->library('pdf');
                    $this->load->library('email');

                    foreach($data['customer'] as $customer) {
                        $custProfile = $this->AcsProfile_model->getByProfId((int)$customer);
                        
                        $pdfData = new stdClass();
                        $pdfData->statement_type = $data['statement_type'];
                        $pdfData->customers = [$customer];
                        $pdfData->statement_date = $data['statement_date'];
                        $pdfData->start_date = $data['start_date'];
                        $pdfData->end_date = $data['end_date'];

                        $pdfData = $this->generateStatementPdfData($pdfData);
                        $fileName = $custProfile->first_name.'_'.$custProfile->last_name.'_Statement_'.$statementId.'_from_ADI.pdf';

                        $this->pdf->save_pdf("accounting/modals/print_action/statement", ['data' => $pdfData], $fileName, 'portrait');

                        $this->email->clear(true);
                        $this->email->from('nsmartrac@gmail.com');
                        $this->email->to($data['email'][$customer]);
                        $this->email->subject($data['subject']);
                        $this->email->message($data['body']);
                        $this->email->attach(base_url("/assets/pdf/$fileName"));

                        $this->email->send();
                    }
                }
            }

            $return['data'] = $statementId;
            $return['success'] = $statementId && $statementCustomers ? true : false;
            $return['message'] = $statementId && $statementCustomers ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    public function showStatement() {
        echo $this->load->view("accounting/modals/print_action/statement", [], true);
        exit;
    }
    
    public function generatePDF() {
        $this->load->library('pdf');
        $post = $this->input->post();
        // $post = json_decode('{"received_from":{"0":"Aaron Weston"},"accounts":{"0":"Billable Expense Income"},"description":{"0":"test1"},"payment_method":{"0":"Credit Card"},"reference_no":{"0":"1"},"amount":{"0":"12.00"}}');
        $post = json_decode($post['json']);
        // $fileName = 'deposit-summary-statement-'.logged('id').'.pdf';
        $fileName = $post->title."-".logged('id').'.pdf';
        // $this->pdf->save_pdf('accounting/modals/print_action/summary', ['data' => $post], $fileName, 'portrait');
        $view = ''; 
        switch ($post->id) {
            case '1':
                # code...
                $view = "accounting/modals/print_action/summary";
                break;
            case '2':
                # code...
                $post = $this->generateStatementPdfData($post);
                $view = "accounting/modals/print_action/statement";
                break;
        }
        $this->pdf->save_pdf($view, ['data' => $post], $fileName, 'portrait');

        echo json_encode(['filename' => $fileName]);
        exit;
    }

    private function generateStatementPdfData($post) {
        $data = [
            'statement_type' => $post->statement_type,
            'customers' => []
        ];
        foreach($post->customers as $customer) {
            $items = [];
            $customerProfile = $this->AcsProfile_model->getByProfId((int)$customer);
            $balance = 0.00;
            if($post->statement_type === "1" || $post->statement_type === 1) {
                $overdueQuery = [
                    'company_id' => logged('company_id'),
                    'customer_id' => (int)$customer,
                    'end_date' => date('Y-m-d', strtotime($post->end_date))
                ];

                $overdueInvoices = $this->accounting_invoices_model->getCustomerOverdueInvoices($overdueQuery);

                $overdueAmount = 0.00;
                foreach($overdueInvoices as $inv) {
                    $overdueAmount = $overdueAmount + floatval($inv->amount);
                }
                $balance = $balance + floatval($overdueAmount);
                $items[] = [
                    'date' => $post->start_date,
                    'activity' => 'Balance Forward',
                    'amount' => '',
                    'balance' => $overdueAmount
                ];

                $invoiceQuery = [
                    'company_id' => logged('company_id'),
                    'customer_id' => (int)$customer,
                    'start_date' => date('Y-m-d', strtotime($post->start_date)),
                    'end_date' => date('Y-m-d', strtotime($post->end_date))
                ];
    
                $invoices = $this->accounting_invoices_model->getCustomerInvoicesByDate($invoiceQuery);
    
                foreach($invoices as $invoice) {
                    $balance = $balance + floatval($invoice->amount);
                    $items[] = [
                        'date' => date('m/d/Y', strtotime($invoice->invoice_date)),
                        'activity' => 'Invoice #' . $invoice->id,
                        'amount' => $invoice->amount,
                        'balance' => $balance
                    ];
    
                    if($invoice->status === 2 || $invoice->status === "2") {
                        $balance = $balance - floatval($invoice->amount);
                        $items[] = [
                            'date' => date('m/d/Y', $invoice->updated_at),
                            'activity' => 'Payment',
                            'amount' => $invoice->amount - ($invoice->amount * 2),
                            'balance' => $balance
                        ];
                    }
                }
            } else if($post->statement_type === "2" || $post->statement_type === 2) {
                $invoiceQuery = [
                    'company_id' => logged('company_id'),
                    'customer_id' => (int)$customer,
                    'start_date' => date('Y-m-d', strtotime(' -1 year')),
                    'end_date' => date('Y-m-d')
                ];

                $invoices = $this->accounting_invoices_model->getCustomerOpenInvoices($invoiceQuery);

                foreach($invoices as $invoice) {
                    $items[] = [
                        'date' => date('m/d/Y', strtotime($invoice->invoice_date)),
                        'activity' => 'Invoice #'.$invoice->id.': Due '.date('m/d/Y', strtotime($invoice->due_date)),
                        'amount' => $invoice->amount,
                        'balance' => $invoice->amount
                    ];
                }
            } else if($post->statement_type === "3" || $post->statement_type === 3) {
                $invoiceQuery = [
                    'cust_bal_status' => $post->cust_bal_status,
                    'company_id' => logged('company_id'),
                    'customer_id' => (int)$customer,
                    'start_date' => date('Y-m-d', strtotime($post->start_date)),
                    'end_date' => date('Y-m-d', strtotime($post->end_date))
                ];

                $invoices = $this->accounting_invoices_model->getCustomerTransactions($invoiceQuery);

                foreach($invoices as $invoice) {
                    $items[] = [
                        'date' => date('m/d/Y', strtotime($invoice->invoice_date)),
                        'activity' => 'Invoice #'.$invoice->id.': '.$invoice->message_on_statement,
                        'amount' => $invoice->amount,
                        'balance' => ($invoice->status === 2 || $invoice->status === "2") ? $invoice->amount : 0.00
                    ];
                }
            }

            if($post->statement_type === "1" || $post->statement_type === 1) {
                $totalDue = end($items)['balance'];
            } else {
                $totalDue = array_sum(array_map(function($item){
                    return $item['balance'];
                }, $items));
            }

            $data['customers'][$customer] = [
                'name' => $customerProfile->first_name . ' ' . $customerProfile->last_name,
                'date' => $post->statement_date,
                'total_due' => $totalDue,
                'items' => $items
            ];
        }

        return $data;
    }

    public function showPDF() {
        // Store the file name into variable 
        $file = $this->input->get('pdf');
        $filename = base_url("/assets/pdf/$file");
        
        // Header content type 
        header("Content-type: application/pdf"); 
        
        // header("Content-Length: " . filesize($filename)); 
        
        // Send the file to the browser. 
        @readfile($filename);
        exit;
    }

    public function downloadPDF() {
        $filename = $this->input->get('filename');
        $file = base_url("/assets/pdf/$filename");

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function showEmailModal() {
        $this->load->library('pdf');
        $post = $this->input->post();
        $post = json_decode($post['json']);

        if(count($post->customers) === 1) {
            $customer = $this->AcsProfile_model->getByProfId((int)$post->customers[0]);
            $this->page_data['email'] = $customer->email;
            $this->page_data['customer_name'] = $customer->first_name . ' ' . $customer->last_name;
        } else {
            $this->page_data['customer_count'] = count($post->customers);
        }

        $this->page_data['company_name'] = 'ADI';
        $filename = 'statement-summary-'.logged('id').'.pdf';
        $this->page_data['filename'] = $filename;

        $post = $this->generateStatementPdfData($post);

        $this->pdf->save_pdf("accounting/modals/print_action/statement", ['data' => $post], $filename, 'portrait');

        $this->load->view("accounting/modals/send_statement_modal", $this->page_data);
    }

    private function expense($data)
    {
        $this->load->model('expenses_model');

        $this->form_validation->set_rules('payment_account', 'Payment account', 'required');
        $this->form_validation->set_rules('payment_date', 'Payment date', 'required');

        if(isset($data['expense_name'])) {
            $this->form_validation->set_rules('expense_name[]', 'Expense name', 'required');
        }

        if(isset($data['item'])) {
            $this->form_validation->set_rules('item[]', 'Item', 'required');
            $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
            $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
        }

        $return = [];
        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['expense_name']) && !isset($data['item'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one line item.';
        } else {
            $payee = explode('-', $data['payee']);

            $expenseData = [
                'company_id' => logged('company_id'),
                'payee_type' => $payee[0],
                'payee_id' => $payee[1],
                'payment_account_id' => $data['payment_account'],
                'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
                'payment_method_id' => $data['payment_method'],
                'ref_no' => $data['ref_no'] === '' ? null : $data['ref_no'],
                'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
                'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'total_amount' => $data['total_amount'],
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
    
            $expenseId = $this->expenses_model->addExpense($expenseData);

            if($expenseId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                $paymentAcc = $this->chart_of_accounts_model->getById($data['payment_account']);
                $newBalance = floatval($paymentAcc->balance) + floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $paymentAccData = [
                    'id' => $paymentAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($paymentAccData);

                if(isset($data['expense_name'])) {
                    $categoryDetails = [];
                    foreach($data['expense_name'] as $index => $value) {
                        $categoryDetails[] = [
                            'transaction_type' => 'Expense',
                            'transaction_id' => $expenseId,
                            'expense_account_id' => $value,
                            'category' => $data['category'][$index],
                            'description' => $data['description'][$index],
                            'amount' => $data['category_amount'][$index],
                            'billable' => $data['category_billable'][$index],
                            'markup_percentage' => $data['category_markup'][$index],
                            'tax' => $data['category_tax'][$index],
                            'customer_id' => $data['category_customer'][$index],
                        ];

                        $expenseAcc = $this->chart_of_accounts_model->getById($value);
                        $newBalance = floatval($expenseAcc->balance) + floatval($data['category_amount'][$index]);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
    
                    $this->expenses_model->insert_vendor_transaction_categories($categoryDetails);
                }
    
                if(isset($data['item'])) {
                    $itemDetails = [];
                    foreach($data['item'] as $index => $value) {
                        $itemDetails[] = [
                            'transaction_type' => 'Expense',
                            'transaction_id' => $expenseId,
                            'item_id' => $value,
                            'location_id' => $data['location'][$index],
                            'quantity' => $data['quantity'][$index],
                            'rate' => $data['item_amount'][$index],
                            'discount' => $data['discount'][$index],
                            'tax' => $data['item_tax'][$index],
                            'total' => $data['item_total'][$index]
                        ];

                        $location = $this->items_model->getItemLocation($data['location'][$index], $value);

                        $newQty = intval($location->qty) + intval($data['quantity'][$index]);

                        $this->items_model->updateLocationQty($data['location'][$index], $value, $newQty);

                        $itemAccDetails = $this->items_model->getItemAccountingDetails($value);

                        if($itemAccDetails) {
                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($invAssetAcc->balance) + floatval($data['item_total'][$index]);
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];
    
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                        }
                    }
    
                    $this->expenses_model->insert_vendor_transaction_items($itemDetails);
                }
            }
    
            $return['data'] = $expenseId;
            $return['success'] = $expenseId ? true : false;
            $return['message'] = $expenseId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function check($data)
    {
        $this->load->model('expenses_model');

        $this->form_validation->set_rules('bank_account', 'Bank account', 'required');
        $this->form_validation->set_rules('payment_date', 'Payment date', 'required');

        if(isset($data['expense_name'])) {
            $this->form_validation->set_rules('expense_name[]', 'Expense name', 'required');
        }

        if(isset($data['item'])) {
            $this->form_validation->set_rules('item[]', 'Item', 'required');
            $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
            $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['expense_name']) && !isset($data['item'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one line item.';
        } else {
            $payee = explode('-', $data['payee']);

            $checkData = [
                'company_id' => logged('company_id'),
                'payee_type' => $payee[0],
                'payee_id' => $payee[1],
                'bank_account_id' => $data['bank_account'],
                'mailing_address' => $data['mailing_address'],
                'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
                'check_no' => $data['check_no'] === 'To print' ? null : $data['check_no'],
                'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
                'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'total_amount' => $data['total_amount'],
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
    
            $checkId = $this->expenses_model->addCheck($checkData);
    
            if($checkId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                $bankAcc = $this->chart_of_accounts_model->getById($data['bank_account']);
                $newBalance = floatval($bankAcc->balance) - floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $bankAccData = [
                    'id' => $bankAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($bankAccData);

                if(isset($data['expense_name'])) {
                    $categoryDetails = [];
                    foreach($data['expense_name'] as $index => $value) {
                        $categoryDetails[] = [
                            'transaction_type' => 'Check',
                            'transaction_id' => $checkId,
                            'expense_account_id' => $value,
                            'category' => $data['category'][$index],
                            'description' => $data['description'][$index],
                            'amount' => $data['category_amount'][$index],
                            'billable' => $data['category_billable'][$index],
                            'markup_percentage' => $data['category_markup'][$index],
                            'tax' => $data['category_tax'][$index],
                            'customer_id' => $data['category_customer'][$index],
                        ];

                        $expenseAcc = $this->chart_of_accounts_model->getById($value);
                        $newBalance = floatval($expenseAcc->balance) + floatval($data['category_amount'][$index]);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
    
                    $this->expenses_model->insert_vendor_transaction_categories($categoryDetails);
                }
    
                if(isset($data['item'])) {
                    $itemDetails = [];
                    foreach($data['item'] as $index => $value) {
                        $itemDetails[] = [
                            'transaction_type' => 'Check',
                            'transaction_id' => $checkId,
                            'item_id' => $value,
                            'location_id' => $data['location'][$index],
                            'quantity' => $data['quantity'][$index],
                            'rate' => $data['item_amount'][$index],
                            'discount' => $data['discount'][$index],
                            'tax' => $data['item_tax'][$index],
                            'total' => $data['item_total'][$index]
                        ];

                        $location = $this->items_model->getItemLocation($data['location'][$index], $value);

                        $newQty = intval($location->qty) + intval($data['quantity'][$index]);

                        $this->items_model->updateLocationQty($data['location'][$index], $value, $newQty);

                        $itemAccDetails = $this->items_model->getItemAccountingDetails($value);

                        if($itemAccDetails) {
                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($invAssetAcc->balance) + floatval($data['item_total'][$index]);
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];
    
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                        }
                    }
    
                    $this->expenses_model->insert_vendor_transaction_items($itemDetails);
                }
            }

            $return['data'] = $checkId;
            $return['success'] = $checkId ? true : false;
            $return['message'] = $checkId ? 'Entry Successful!' : 'An unexpected error occured!';
        }


        return $return;
    }

    private function bill($data)
    {
        $this->load->model('expenses_model');

        $this->form_validation->set_rules('vendor_id', 'Vendor', 'required');
        $this->form_validation->set_rules('bill_date', 'Bill date', 'required');
        $this->form_validation->set_rules('due_date', 'Due date', 'required');

        if(isset($data['expense_name'])) {
            $this->form_validation->set_rules('expense_name[]', 'Expense name', 'required');
        }

        if(isset($data['item'])) {
            $this->form_validation->set_rules('item[]', 'Item', 'required');
            $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
            $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['expense_name']) && !isset($data['item'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one line item.';
        } else {
            $billData = [
                'company_id' => logged('company_id'),
                'vendor_id' => $data['vendor_id'],
                'mailing_address' => $data['mailing_address'],
                'term_id' => $data['term_id'],
                'bill_date' => date("Y-m-d", strtotime($data['bill_date'])),
                'due_date' => date("Y-m-d", strtotime($data['due_date'])),
                'bill_no' => $data['bill_no'] !== "" ? $data['bill_no'] : null,
                'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
                'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'remaining_balance' => $data['total_amount'],
                'total_amount' => $data['total_amount'],
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
    
            $billId = $this->expenses_model->addBill($billData);
    
            if($billId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                if(isset($data['expense_name'])) {
                    $categoryDetails = [];
                    foreach($data['expense_name'] as $index => $value) {
                        $categoryDetails[] = [
                            'transaction_type' => 'Bill',
                            'transaction_id' => $billId,
                            'expense_account_id' => $value,
                            'category' => $data['category'][$index],
                            'description' => $data['description'][$index],
                            'amount' => $data['category_amount'][$index],
                            'billable' => $data['category_billable'][$index],
                            'markup_percentage' => $data['category_markup'][$index],
                            'tax' => $data['category_tax'][$index],
                            'customer_id' => $data['category_customer'][$index],
                        ];

                        $expenseAcc = $this->chart_of_accounts_model->getById($value);
                        $newBalance = floatval($expenseAcc->balance) + floatval($data['category_amount'][$index]);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
    
                    $this->expenses_model->insert_vendor_transaction_categories($categoryDetails);
                }
    
                if(isset($data['item'])) {
                    $itemDetails = [];
                    foreach($data['item'] as $index => $value) {
                        $itemDetails[] = [
                            'transaction_type' => 'Bill',
                            'transaction_id' => $billId,
                            'item_id' => $value,
                            'location_id' => $data['location'][$index],
                            'quantity' => $data['quantity'][$index],
                            'rate' => $data['item_amount'][$index],
                            'discount' => $data['discount'][$index],
                            'tax' => $data['item_tax'][$index],
                            'total' => $data['item_total'][$index]
                        ];

                        $location = $this->items_model->getItemLocation($data['location'][$index], $value);

                        $newQty = intval($location->qty) + intval($data['quantity'][$index]);

                        $this->items_model->updateLocationQty($data['location'][$index], $value, $newQty);

                        $itemAccDetails = $this->items_model->getItemAccountingDetails($value);

                        if($itemAccDetails) {
                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($invAssetAcc->balance) + floatval($data['item_total'][$index]);
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];
    
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                        }
                    }
    
                    $this->expenses_model->insert_vendor_transaction_items($itemDetails);
                }
            }

            $return['data'] = $billId;
            $return['success'] = $billId ? true : false;
            $return['message'] = $billId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    public function load_bills()
    {
        $this->load->model('expenses_model');

        $post = json_decode(file_get_contents('php://input'), true);
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];

        $filters = [];

        if($post['payee'] !== 'all') {
            $filters['vendor_id'] = $post['payee'];
        }

        switch($post['due_date']) {
            case 'last-365-days' :
                $filters['start_date'] = date("Y-m-d", strtotime(date("m/d/Y")." -365 days"));
                // $filters['end_date'] = date("Y-m-d");
            break;
            case 'custom' :
                if($post['from_date'] !== '') {
                    $filters['start_date'] = date("Y-m-d", strtotime($post['from_date']));
                }

                if($post['to_date'] !== '') {
                    $filters['end_date'] = date("Y-m-d", strtotime($post['to_date']));
                }
            break;
            case 'today' :
                $filters['start_date'] = date("Y-m-d");
                $filters['end_date'] = date("Y-m-d");
            break;
            case 'yesterday' :
                $filters['start_date'] = date("Y-m-d", strtotime(date("m/d/Y")." -1 day"));
                $filters['end_date'] = date("Y-m-d", strtotime(date("m/d/Y")." -1 day"));
            break;
            case 'yesterday' :
                $filters['start_date'] = date("Y-m-d", strtotime(date("m/d/Y")." -1 day"));
                $filters['end_date'] = date("Y-m-d", strtotime(date("m/d/Y")." -1 day"));
            break;
            case 'this-week' :
                $filters['start_date'] = date("Y-m-d", strtotime("this week -1 day"));
                $filters['end_date'] = date("Y-m-d", strtotime("sunday -1 day"));
            break;
            case 'this-month' :
                $filters['start_date'] = date("Y-m-01");
                $filters['end_date'] = date("Y-m-t");
            break;
            case 'this-quarter' :
                $quarters = [
                    1 => [
                        'start' => date("01/01/Y"),
                        'end' => date("03/t/Y")
                    ],
                    2 => [
                        'start' => date("04/01/Y"),
                        'end' => date("06/t/Y")
                    ],
                    3 => [
                        'start' => date("07/01/Y"),
                        'end' => date("09/t/Y")
                    ],
                    4 => [
                        'start' => date("10/01/Y"),
                        'end' => date("12/t/Y")
                    ]
                ];
                $month = date('n');
                $quarter = ceil($month / 3);

                $filters['start_date'] = $quarters[$quarter]['start'];
                $filters['end_date'] = $quarters[$quarter]['end'];
            break;
            case 'this-year' :
                $filters['start_date'] = date("Y-01-01");
                $filters['end_date'] = date("Y-12-t");
            break;
            case 'last-week' :
                $filters['start_date'] = date("Y-m-d", strtotime("this week -1 week -1 day"));
                $filters['end_date'] = date("Y-m-d", strtotime("sunday -1 week -1 day"));
            break;
            case 'last-month' :
                $filters['start_date'] = date("Y-m-01", strtotime(date("m/01/Y")." -1 month"));
                $filters['end_date'] = date("Y-m-t", strtotime(date("m/01/Y")." -1 month"));
            break;
            case 'last-quarter' :
                $quarters = [
                    1 => [
                        'start' => date("01/01/Y"),
                        'end' => date("03/t/Y")
                    ],
                    2 => [
                        'start' => date("04/01/Y"),
                        'end' => date("06/t/Y")
                    ],
                    3 => [
                        'start' => date("07/01/Y"),
                        'end' => date("09/t/Y")
                    ],
                    4 => [
                        'start' => date("10/01/Y"),
                        'end' => date("12/t/Y")
                    ]
                ];
                $month = date('n');
                $quarter = ceil($month / 3);

                $filters['start_date'] = date("Y-m-d", strtotime($quarters[$quarter]['start']." -3 months"));
                $filters['end_date'] = date("Y-m-t", strtotime($filters['start-date']." +2 months"));
            break;
            case 'last-year' :
                $filters['start_date'] = date("Y-01-01", strtotime(date("01/01/Y")." -1 year"));
                $filters['end_date'] = date("Y-12-t", strtotime(date("12/t/Y")." -1 year"));
            break;
        }

        $bills = $this->expenses_model->get_open_bills($filters);

        $data = [];
        foreach($bills as $bill) {
            $vendor = $this->vendors_model->get_vendor_by_id($bill->vendor_id);

            $data[] = [
                'id' => $bill->id,
                'payee_id' => $bill->vendor_id,
                'payee' => $vendor->display_name,
                'ref_no' => $bill->bill_no !== null && $bill->bill_no !== "" ? $bill->bill_no : "",
                'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                'open_balance' => number_format($bill->remaining_balance, 2, '.', ','),
                'vendor_credits' => number_format(floatval($vendor->vendor_credits), 2, '.', ',')
            ];
        }

        if($post['overdue_only'] === "1") {
            $data = array_filter($data, function($v, $k) {
                return strtotime(date("Y-m-d")) > strtotime($v['due_date']);
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($data, function($a, $b) use ($order, $columnName) {
            if($columnName !== 'due_date') {
                if($columnName === 'open_balance') {
                    if($order === 'asc') {
                        return floatval($a[$columnName]) > floatval($b[$columnName]);
                    } else {
                        return floatval($b[$columnName]) > floatval($a[$columnName]);
                    }
                } else {
                    if($order === 'asc') {
                        return strcmp($a[$columnName], $b[$columnName]);
                    } else {
                        return strcmp($b[$columnName], $a[$columnName]);
                    }
                }
            } else {
                if($order === 'asc') {
                    return strtotime($a[$columnName]) > strtotime($b[$columnname]);
                } else {
                    return strtotime($a[$columnName]) < strtotime($b[$columnname]);
                }
            }
        });

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($bills),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    private function pay_bills($data)
    {
        $this->load->model('expenses_model');

        $this->form_validation->set_rules('payment_account', 'Payment account', 'required');
        $this->form_validation->set_rules('payment_date', 'Payment date', 'required');
        $this->form_validation->set_rules('bills[]', 'Bill', 'required');
        $this->form_validation->set_rules('payment_amount[]', 'Payment amount', 'required');

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $payees = array_unique($data['payee']);

            $startingCheckNo = $data['starting_check_no'] === "" ? null : intval($data['starting_check_no']);
            foreach($payees as $payee) {
                $paymentTotal = 0.00;
                $itemKeys = array_keys($data['payee'], $payee);
                foreach($itemKeys as $key) {
                    $paymentTotal += floatval($data['total_amount'][$key]);
                }

                $billPayment = [
                    'company_id' => logged('company_id'),
                    'payee_id' => $payee,
                    'payment_account_id' => $data['payment_account'],
                    'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
                    'check_no' => isset($data['print_later']) ? null : $startingCheckNo,
                    'to_print_check_no' => $data['print_later'],
                    'total_amount' => $paymentTotal,
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $billPaymentId = $this->expenses_model->insert_bill_payment($billPayment);

                if($billPaymentId) {
                    $paymentAcc = $this->chart_of_accounts_model->getById($data['payment_account']);
                    $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

                    if($paymentAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($paymentAcc->balance) + floatval($paymentTotal);
                    } else {
                        $newBalance = floatval($paymentAcc->balance) - floatval($paymentTotal);
                    }

                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $paymentAccData = [
                        'id' => $paymentAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($paymentAccData);

                    $paymentItems = [];
                    foreach($itemKeys as $key) {
                        $paymentItems[] = [
                            'bill_payment_id' => $billPaymentId,
                            'bill_id' => $data['bills'][$key],
                            'credit_applied_amount' => $data['credit_applied'][$key],
                            'payment_amount' => $data['payment_amount'][$key],
                            'total_amount' => $data['total_amount'][$key]
                        ];

                        $bill = $this->expenses_model->get_bill_data($data['bills'][$key]);

                        if(floatval($data['total_amount'][$key]) === floatval($bill->remaining_balance)) {
                            $billData = [
                                'remaining_balance' => 0.00,
                                'status' => 2,
                                'updated_at' => date("Y-m-d H:i:s")
                            ];
                        } else {
                            $remainingBal = floatval($bill->remaining_balance) - floatval($data['total_amount'][$key]);
                            $billData = [
                                'remaining_balance' => number_format($remainingBal, 2, '.', ','),
                                'updated_at' => date("Y-m-d H:i:s")
                            ];
                        }
    
                        $this->expenses_model->update_bill_data($bill->id, $billData);
                    }

                    $this->expenses_model->insert_bill_payment_items($paymentItems);
                }

                if($data['starting_check_no'] !== "") {
                    $startingCheckNo++;
                }
            }
    
            $return = [];
            $return['data'] = $billPaymentId;
            $return['success'] = $billPaymentId ? true : false;
            $return['message'] = $billPaymentId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function vendor_credit($data)
    {
        $this->load->model('expenses_model');

        $this->form_validation->set_rules('vendor_id', 'Vendor', 'required');
        $this->form_validation->set_rules('payment_date', 'Payment date', 'required');

        if(isset($data['expense_name'])) {
            $this->form_validation->set_rules('expense_name[]', 'Expense name', 'required');
        }

        if(isset($data['item'])) {
            $this->form_validation->set_rules('item[]', 'Item', 'required');
            $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
            $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['expense_name']) && !isset($data['item'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one line item.';
        } else {
            $vendorCredit = [
                'company_id' => logged('company_id'),
                'vendor_id' => $data['vendor_id'],
                'mailing_address' => $data['mailing_address'],
                'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
                'ref_no' => $data['ref_no'] === '' ? null : $data['ref_no'],
                'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
                'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'total_amount' => $data['total_amount'],
                'remaining_balance' => $data['total_amount'],
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
    
            $vendorCreditId = $this->expenses_model->add_vendor_credit($vendorCredit);
    
            if($vendorCreditId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                $vendor = $this->vendors_model->get_vendor_by_id($data['vendor_id']);

                if($vendor->vendor_credits === null & $vendor->vendor_credits === "") {
                    $vendorCredits = floatval($data['total_amount']);
                } else {
                    $vendorCredits = floatval($data['total_amount']) + floatval($vendor->vendor_credits);
                }

                $vendorData = [
                    'vendor_credits' => number_format($vendorCredits, 2, '.', ',')
                ];

                $this->vendors_model->updateVendor($vendor->id, $vendorData);

                if(isset($data['expense_name'])) {
                    $categoryDetails = [];
                    foreach($data['expense_name'] as $index => $value) {
                        $categoryDetails[] = [
                            'transaction_type' => 'Vendor Credit',
                            'transaction_id' => $vendorCreditId,
                            'expense_account_id' => $value,
                            'category' => $data['category'][$index],
                            'description' => $data['description'][$index],
                            'amount' => $data['category_amount'][$index],
                            'billable' => $data['category_billable'][$index],
                            'markup_percentage' => $data['category_markup'][$index],
                            'tax' => $data['category_tax'][$index],
                            'customer_id' => $data['category_customer'][$index],
                        ];

                        $expenseAcc = $this->chart_of_accounts_model->getById($value);
                        $newBalance = floatval($expenseAcc->balance) - floatval($data['category_amount'][$index]);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
    
                    $this->expenses_model->insert_vendor_transaction_categories($categoryDetails);
                }
    
                if(isset($data['item'])) {
                    $itemDetails = [];
                    foreach($data['item'] as $index => $value) {
                        $itemDetails[] = [
                            'transaction_type' => 'Vendor Credit',
                            'transaction_id' => $vendorCreditId,
                            'item_id' => $value,
                            'location_id' => $data['location'][$index],
                            'quantity' => $data['quantity'][$index],
                            'rate' => $data['item_amount'][$index],
                            'discount' => $data['discount'][$index],
                            'tax' => $data['item_tax'][$index],
                            'total' => $data['item_total'][$index]
                        ];

                        $location = $this->items_model->getItemLocation($data['location'][$index], $value);

                        $newQty = intval($location->qty) - intval($data['quantity'][$index]);

                        $this->items_model->updateLocationQty($data['location'][$index], $value, $newQty);

                        $itemAccDetails = $this->items_model->getItemAccountingDetails($value);

                        if($itemAccDetails) {
                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($data['item_amount'][$index]) - 5.00;
                            $newBalance = floatval($invAssetAcc->balance) + $newBalance;
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];
    
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);

                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($invAssetAcc->balance) - floatval($data['item_total'][$index]);
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];
    
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                        }
                    }
    
                    $this->expenses_model->insert_vendor_transaction_items($itemDetails);
                }
            }

            $return['data'] = $vendorCreditId;
            $return['success'] = $vendorCreditId ? true : false;
            $return['message'] = $vendorCreditId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    public function item_list_modal()
    {
        $items = $this->items_model->getItemsWithFilter(['type' => ['inventory', 'product'], 'status' => [1]]);

        $items = array_filter($items, function($item, $k) {
            $accDetails = $this->items_model->getItemAccountingDetails($item->id);
            return $accDetails !== null;
        }, ARRAY_FILTER_USE_BOTH);

        $this->page_data['items'] = $items;
        $this->load->view('accounting/modals/item_list_modal', $this->page_data);
    }

    public function get_term_details($termId)
    {
        $term = $this->accounting_terms_model->getById($termId);

        echo json_encode($term);
    }

    private function purchase_order($data)
    {
        $this->load->model('expenses_model');

        $this->form_validation->set_rules('vendor_id', 'Vendor', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('purchase_order_date', 'Purchase order date', 'required');

        if(isset($data['expense_name'])) {
            $this->form_validation->set_rules('expense_name[]', 'Expense name', 'required');
        }

        if(isset($data['item'])) {
            $this->form_validation->set_rules('item[]', 'Item', 'required');
            $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
            $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['expense_name']) && !isset($data['item'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one line item.';
        } else {
            $lastPO = $this->expenses_model->get_last_purchase_order(logged('company_id'));

            $purchaseOrder = [
                'company_id' => logged('company_id'),
                'vendor_id' => $data['vendor_id'],
                'purchase_order_no' => $lastPO === null ? 1 : intval($lastPO->purchase_order_no)+1,
                'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
                'email' => $data['email'],
                'mailing_address' => nl2br($data['mailing_address']),
                'customer_id' => $data['customer'],
                'shipping_address' => nl2br($data['shipping_address']),
                'purchase_order_date' => date("Y-m-d", strtotime($data['purchase_order_date'])),
                'ship_via' => $data['ship_via'],
                'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                'message_to_vendor' => $data['message_to_vendor'],
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'total_amount' => $data['total_amount'],
                'remaining_balance' => $data['status'] === "open" ? $data['total_amount'] : 0.00,
                'status' => $data['status'] === "open" ? 1 : 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
    
            $purchaseOrderId = $this->expenses_model->add_purchase_order($purchaseOrder);
    
            if($purchaseOrderId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                if(isset($data['expense_name'])) {
                    $categoryDetails = [];
                    foreach($data['expense_name'] as $index => $value) {
                        $categoryDetails[] = [
                            'transaction_type' => 'Purchase Order',
                            'transaction_id' => $purchaseOrderId,
                            'expense_account_id' => $value,
                            'category' => $data['category'][$index],
                            'description' => $data['description'][$index],
                            'amount' => $data['category_amount'][$index],
                            'billable' => $data['category_billable'][$index],
                            'markup_percentage' => $data['category_markup'][$index],
                            'tax' => $data['category_tax'][$index],
                            'customer_id' => $data['category_customer'][$index],
                        ];
                    }
    
                    $this->expenses_model->insert_vendor_transaction_categories($categoryDetails);
                }
    
                if(isset($data['item'])) {
                    $itemDetails = [];
                    foreach($data['item'] as $index => $value) {
                        $itemDetails[] = [
                            'transaction_type' => 'Purchase Order',
                            'transaction_id' => $purchaseOrderId,
                            'item_id' => $value,
                            'location_id' => $data['location'][$index],
                            'quantity' => $data['quantity'][$index],
                            'rate' => $data['item_amount'][$index],
                            'discount' => $data['discount'][$index],
                            'tax' => $data['item_tax'][$index],
                            'total' => $data['item_total'][$index]
                        ];

                        $itemAccDetails = $this->items_model->getItemAccountingDetails($value);

                        $newQtyPO = intval($itemAccDetails->qty_po) + intval($data['quantity'][$index]);

                        $this->items_model->updateItemAccountingDetails(['qty_po' => $newQtyPO], $value);
                    }
    
                    $this->expenses_model->insert_vendor_transaction_items($itemDetails);
                }
            }

            $return['data'] = $purchaseOrderId;
            $return['success'] = $purchaseOrderId ? true : false;
            $return['message'] = $purchaseOrderId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    public function get_vendor_details($vendorId)
    {
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);

        echo json_encode($vendor);
    }

    public function get_customer_details($customerId)
    {
        $customer = $this->accounting_customers_model->getCustomerDetails($customerId);

        echo json_encode($customer[0]);
    }

    public function get_employee_details($employeeId)
    {
        $employee = $this->users_model->getUserByID($employeeId);

        echo json_encode($employee);
    }

    private function credit_card_credit($data)
    {
        $this->load->model('expenses_model');

        $this->form_validation->set_rules('bank_credit_account', 'Bank/Credit account', 'required');
        $this->form_validation->set_rules('payment_date', 'Payment date', 'required');

        if(isset($data['expense_name'])) {
            $this->form_validation->set_rules('expense_name[]', 'Expense name', 'required');
        }

        if(isset($data['item'])) {
            $this->form_validation->set_rules('item[]', 'Item', 'required');
            $this->form_validation->set_rules('quantity[]', 'Item quantity', 'required');
            $this->form_validation->set_rules('item_amount[]', 'Item quantity', 'required');
        }

        $return = [];
        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(!isset($data['expense_name']) && !isset($data['item'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Please enter at least one line item.';
        } else {
            $payee = explode('-', $data['payee']);

            $creditData = [
                'company_id' => logged('company_id'),
                'payee_type' => $payee[0],
                'payee_id' => $payee[1],
                'bank_credit_account_id' => $data['bank_credit_account'],
                'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
                'ref_no' => $data['ref_no'] === "" ? null : $data['ref_no'],
                'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
                'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                'memo' => $data['memo'],
                'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
                'total_amount' => $data['total_amount'],
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $creditId = $this->expenses_model->add_credit_card_credit($creditData);

            $creditAcc = $this->chart_of_accounts_model->getById($data['bank_credit_account']);

            $newBalance = floatval($creditAcc->balance) - floatval($data['total_amount']);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $this->chart_of_accounts_model->updateBalance(['id' => $creditAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);
    
            if($creditId) {
                if(isset($data['attachments']) && is_array($data['attachments'])) {
                    foreach($data['attachments'] as $attachmentId) {
                        $attachment = $this->accounting_attachments_model->getById($attachmentId);
                        $attachmentData = [
                            'linked_to_count' => intval($attachment->linked_to_count) + 1
                        ];
        
                        $this->accounting_attachments_model->updateAttachment($attachmentId, $attachmentData);
                    }
                }

                if(isset($data['expense_name'])) {
                    $categoryDetails = [];
                    foreach($data['expense_name'] as $index => $value) {
                        $categoryDetails[] = [
                            'transaction_type' => 'Credit Card Credit',
                            'transaction_id' => $creditId,
                            'expense_account_id' => $value,
                            'category' => $data['category'][$index],
                            'description' => $data['description'][$index],
                            'amount' => $data['category_amount'][$index],
                            'billable' => $data['category_billable'][$index],
                            'markup_percentage' => $data['category_markup'][$index],
                            'tax' => $data['category_tax'][$index],
                            'customer_id' => $data['category_customer'][$index],
                        ];

                        $expenseAcc = $this->chart_of_accounts_model->getById($value);
                        $newBalance = floatval($expenseAcc->balance) - floatval($data['category_amount'][$index]);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
    
                    $this->expenses_model->insert_vendor_transaction_categories($categoryDetails);
                }
    
                if(isset($data['item'])) {
                    $itemDetails = [];
                    foreach($data['item'] as $index => $value) {
                        $itemDetails[] = [
                            'transaction_type' => 'Credit Card Credit',
                            'transaction_id' => $creditId,
                            'item_id' => $value,
                            'location_id' => $data['location'][$index],
                            'quantity' => $data['quantity'][$index],
                            'rate' => $data['item_amount'][$index],
                            'discount' => $data['discount'][$index],
                            'tax' => $data['item_tax'][$index],
                            'total' => $data['item_total'][$index]
                        ];

                        $location = $this->items_model->getItemLocation($data['location'][$index], $value);

                        $newQty = intval($location->qty) - intval($data['quantity'][$index]);

                        $this->items_model->updateLocationQty($data['location'][$index], $value, $newQty);

                        $itemAccDetails = $this->items_model->getItemAccountingDetails($value);

                        if($itemAccDetails) {
                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($data['item_amount'][$index]) - 5.00;
                            $newBalance = floatval($invAssetAcc->balance) + $newBalance;
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];
    
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);

                            $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                            $newBalance = floatval($invAssetAcc->balance) - floatval($data['item_total'][$index]);
                            $newBalance = number_format($newBalance, 2, '.', ',');

                            $invAssetAccData = [
                                'id' => $invAssetAcc->id,
                                'company_id' => logged('company_id'),
                                'balance' => $newBalance
                            ];
    
                            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                        }
                    }
    
                    $this->expenses_model->insert_vendor_transaction_items($itemDetails);
                }
            }
    
            $return['data'] = $creditId;
            $return['success'] = $creditId ? true : false;
            $return['message'] = $creditId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    public function get_linkable_transactions($transactionType, $vendorId)
    {
        $this->load->model('expenses_model');
        switch($transactionType) {
            case 'expense' :
                $purchaseOrders = $this->expenses_model->get_vendor_open_purchase_orders($vendorId);
                $bills = $this->expenses_model->get_vendor_open_bills($vendorId);
                $vendorCredits = $this->expenses_model->get_vendor_unapplied_vendor_credits($vendorId);
            break;
            case 'check' :
                $purchaseOrders = $this->expenses_model->get_vendor_open_purchase_orders($vendorId);
                $bills = $this->expenses_model->get_vendor_open_bills($vendorId);
                $vendorCredits = $this->expenses_model->get_vendor_unapplied_vendor_credits($vendorId);
            break;
        }

        $transactions = [];

        if(isset($purchaseOrders) && count($purchaseOrders) > 0) {
            foreach($purchaseOrders as $purchaseOrder) {
                $transactions[] = [
                    'type' => 'Purchase Order',
                    'id' => $purchaseOrder->id,
                    'number' => $purchaseOrder->purchase_order_no === null || $purchaseOrder->purchase_order_no === '' ? '' : $purchaseOrder->purchase_order_no,
                    'date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'formatted_date' => date("F j", strtotime($purchaseOrder->purchase_order_date)),
                    'total' => '$'.number_format(floatval($purchaseOrder->total_amount), 2, '.', ','),
                    'balance' => '$'.number_format(floatval($purchaseOrder->total_amount), 2, '.', ',')
                ];
            }
        }

        if(isset($bills) && count($bills) > 0) {
            foreach($bills as $bill) {
                $transactions[] = [
                    'type' => 'Bill',
                    'id' => $bill->id,
                    'number' => $bill->bill_no === null || $bill->bill_no === '' ? '' : $bill->bill_no,
                    'date' => date("m/d/Y", strtotime($bill->due_date)),
                    'formatted_date' => date("F j", strtotime($bill->due_date)),
                    'total' => '$'.number_format(floatval($bill->total_amount), 2, '.', ','),
                    'balance' => '$'.number_format(floatval($bill->remaining_balance), 2, '.', ',')
                ];
            }
        }

        if(isset($vendorCredits) && count($vendorCredits) > 0) {
            foreach($vendorCredits as $vendorCredit) {
                $transactions[] = [
                    'type' => 'Vendor Credit',
                    'id' => $vendorCredit->id,
                    'number' => $vendorCredit->ref_no === null || $vendorCredit->ref_no === '' ? '' : $vendorCredit->ref_no,
                    'date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                    'formatted_date' => date("F j", strtotime($vendorCredit->payment_date)),
                    'total' => '$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ','),
                    'balance' => '$'.number_format(floatval($vendorCredit->remaining_balance), 2, '.', ',')
                ];
            }
        }

        echo json_encode($transactions);
    }
}