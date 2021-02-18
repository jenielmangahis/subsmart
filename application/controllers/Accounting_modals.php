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
        $this->load->model('AcsProfile_model');
        $this->load->model('job_tags_model');
        $this->load->model('users_model');
		$this->load->library('form_validation');
    }

    public function index($view ="") {
        if ($view) {
            switch ($view) {
                case 'pay_down_credit_card_modal':
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getVendors();
                break;
                case 'single_time_activity_modal':
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getVendors();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));

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
                    $lastJournalNo = (int)$this->accounting_journal_entries_model->getLastJournalNo();
                    $this->page_data['journal_no'] = $lastJournalNo + 1;
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getVendors();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                break;
                case 'bank_deposit_modal':
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

                    if(strpos($selectedBalance, '-') !== false) {
                        $balance = str_replace('-', '', $selectedBalance);
                        $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
                    } else {
                        $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
                    }

                    $this->page_data['balance'] = $selectedBalance;
                    $this->page_data['accounts'] = $bankAccounts;
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getVendors();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                break;
                case 'inventory_qty_modal':
                    $lastAdjustmentNo = (int)$this->accounting_inventory_qty_adjustments_model->getLastAdjustmentNo();
                    $this->page_data['adjustment_no'] = $lastAdjustmentNo + 1;
                break;
                case 'payroll_modal':
                    $this->page_data['employees'] = $this->users_model->getActiveCompanyUsers(logged('company_id'));

                    $currentDay = date('m/d/Y');
                    $startDay = date('m/d/Y', strtotime($date . ' -6 months'));

                    $startDateTime = new DateTime($startDay);
                    $startWeekNo = $startDateTime->format('W');
                    $newDateTime = new DateTime();
                    $firstDate = $newDateTime->setISODate($startDateTime->format("Y"), $startWeekNo, 1);
                    $firstDateString = $firstDate->format('m/d/Y');
                    $lastDate = $newDateTime->setISODate($startDateTime->format("Y"), $startWeekNo, 7);
                    $lastDateString = $lastDate->format('m/d/Y');

                    $payPeriod = [
                        [
                            'first_day' => $firstDateString,
                            'last_day' => $lastDateString,
                            'selected' => (strtotime($currentDay) >= strtotime($firstDateString) && strtotime($currentDay) <= strtotime($lastDateString)) ? true : false
                        ]
                    ];

                    for($i = 0; count($payPeriod) < 30; $i++ ) {
                        $firstDate = $lastDate->add(new DateInterval('P1D'));
                        $firstDateString = $firstDate->format('m/d/Y');
                        $lastDate = $firstDate->add(new DateInterval('P6D'));
                        $lastDateString = $lastDate->format('m/d/Y');

                        $payPeriod[] = [
                            'first_day' => $firstDateString,
                            'last_day' => $lastDateString,
                            'selected' => (strtotime($currentDay) >= strtotime($firstDateString) && strtotime($currentDay) <= strtotime($lastDateString)) ? true : false
                        ];
                    }

                    krsort($payPeriod);
                    $this->page_data['payPeriods'] = $payPeriod;
                break;
                case 'weekly_timesheet_modal':
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getVendors();
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();

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
            }

            $this->load->view("accounting/". $view, $this->page_data);
        }
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

            $this->load->view("accounting/recurring_".$modal."_fields", $this->page_data);
        }
    }

    public function load_job_tags() {
        $postData = json_decode(file_get_contents('php://input'), true);

        $tags = $this->job_tags_model->getJobTagsByCompany();

        $data = [];
        $search = $postData['columns'][0]['search']['value'];

        foreach($tags as $tag) {
            if($search !== "" ) {
                if(stripos($tag->name, $search) !== false) {
                    $data[] = [
                        'id' => $tag->id,
                        'tag_name' => $tag->name
                    ];
                }
            } else {
                $data[] = [
                    'id' => $tag->id,
                    'tag_name' => $tag->name
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

    public function job_tag_modal() {
        $this->load->view("accounting/job_tags_modal");
    }

    public function job_tag_form() {
        $this->load->view("accounting/job_tag_modal_form");
    }

    public function get_job_tags() {
        $tags = $this->job_tags_model->getJobTagsByCompany();

        $return = [];

        foreach($tags as $tag) {
            $return['results'][] = [
                'id' => $tag->id,
                'text' => $tag->name
            ];
        }

        echo json_encode($return);
    }

    public function generate_payroll() {
        $postData = $this->input->post();
        $socialSecurity = 6.2;
        $medicare = 1.45;
        $futa = 0.006;
        $sui = 2.7;

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
            'total_employer_tax' => $totalEmployerTax,
            'total_payroll_cost' => number_format($totalPayrollCost, 2, '.', ',')
        ];

        $this->load->view("accounting/payroll_summary", $this->page_data);
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
            }
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }

        echo json_encode($this->result);
        exit;
    }

    private function transfer_funds($data, $files) {
        $this->form_validation->set_rules('transfer_from', 'Transfer From Account', 'required');
        $this->form_validation->set_rules('transfer_to', 'Transfer To Account', 'required');
        $this->form_validation->set_rules('transfer_amount', 'Amount', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required|date');

        if(isset($data['template_name'])) {
            $this->form_validation->set_rules('template_name', 'Template Name', 'required');
            $this->form_validation->set_rules('recurring_type', 'Recurring Type', 'required');

            if($data['recurring_type'] !== 'unscheduled') {
                $this->form_validation->set_rules('day_in_advance', 'Days in advance', 'required');
                $this->form_validation->set_rules('recurring_mode', 'Recurring mode', 'required');

                if($data['recurring_mode'] !== 'daily') {
                    if($data['recurring_mode'] === 'monthly') {
                        $this->form_validation->set_rules('recurring_week', 'Recurring week', 'required');
                    } else if($data['recurring_mode'] === 'yearly') {
                        $this->form_validation->set_rules('recurring_month', 'Recurring month', 'required');
                    }

                    $this->form_validation->set_rules('recurring_day', 'Recurring day', 'required');
                }
                if($data['recurring_mode'] !== 'yearly') {
                    $this->form_validation->set_rules('recurring_interval', 'Recurring interval', 'required');
                }
                $this->form_validation->set_rules('recurring_start_date', 'Recurring start date', 'required');
                $this->form_validation->set_rules('recurring_end_type', 'Recurring end type', 'required');

                if($data['recurring_end_type'] === 'by') {
                    $this->form_validation->set_rules('recurring_end_by', 'Recurring end by', 'required');
                } else if($data['recurring_end_type'] === 'after') {
                    $this->form_validation->set_rules('recurring_max_occurence', 'Recurring max occurence', 'required');
                }
            }
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            $filenames = $this->move_files($files, 'transfer');

            $transferFrom = explode('-', $data['transfer_from']);
            $transferTo = explode('-', $data['transfer_to']);

            $insertData = [
                'company_id' => logged('company_id'),
                'transfer_from_account_key' => $transferFrom[0],
                'transfer_from_account_id' => $transferFrom[1],
                'transfer_to_account_key' => $transferTo[0],
                'transfer_to_account_id' => $transferTo[1],
                'transfer_amount' => $data['transfer_amount'],
                'transfer_date' => date('Y-m-d', strtotime($data['date'])),
                'transfer_memo' => $data['memo'],
                'transfer_attachments' => json_encode($filenames),
                'recurring' => isset($data['template_name']) ? 1 : 0,
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
    
            $transferId = $this->accounting_transfer_funds_model->create($insertData);

            if(isset($data['template_name'])) {
                $recurringData = [
                    'transfer_id' => $transferId,
                    'template_name' => $data['template_name'],
                    'recurring_type' => $data['recurring_type'],
                    'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['day_in_advance'] : null,
                    'recurring_mode' => $data['recurring_mode'],
                    'recurring_month' => $data['recurring_mode'] === 'yearly' ? $data['recurring_month'] : null,
                    'recurring_week' => $data['recurring_mode'] === 'monthly' ? $data['recurring_week'] : null,
                    'recurring_day' => $data['recurring_mode'] !== 'daily' ? $data['recurring_day'] : null,
                    'recurring_interval' => $data['recurring_mode'] !== 'yearly' ? $data['recurring_interval'] : null,
                    'recurring_start_date' => date('Y-m-d', strtotime($data['recurring_start_date'])),
                    'recurring_end_type' => $data['recurring_end_type'],
                    'recurring_end_by' => $data['recurring_end_type'] === 'by' ? date('Y-m-d', strtotime($data['recurring_end_by'])) : null,
                    'recurring_max_occurences' => $data['recurring_end_type'] === 'after' ? $data['recurring_max_occurence'] : null,
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ];

                $recurringId = $this->accounting_transfer_funds_model->insertRecurringDetails($recurringData);

                $return['data'] = $transferId;
                $return['success'] = $transferId && $recurringId ? true : false;
                $return['message'] = $transferId && $recurringId ? 'Transfer Successfully!' : 'An unexpected error occured!';
            } else {
                $return['data'] = $transferId;
                $return['success'] = $transferId ? true : false;
                $return['message'] = $transferId ? 'Transfer Successfully!' : 'An unexpected error occured!';
            }
        }

        return $return;
    }

    private function move_files($files, $folder) {
        $filenames = [];
        $path = $this->upload_path . '' . $folder;

        if(count($files) > 0) {
            foreach ($files['name'] as $key => $value) {
                move_uploaded_file($files['tmp_name'][$key], $path . '/' . $value);

                $filenames[] = $value;
            }
        }

        return $filenames;
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
            $filenames = $this->move_files($files, 'pay_down_credit_card');
            $bankAccount = explode('-', $data['bank_account']);

            $insertData = [
                'company_id' => logged('company_id'),
                'credit_card_id' => $data['credit_card'],
                'payee_id' => $data['payee'],
                'amount' => $data['amount'],
                'date' => date('Y-m-d', strtotime($data['payment_date'])),
                'bank_account_key' => $bankAccount[0],
                'bank_account_id' => $bankAccount[1],
                'memo' => $data['memo'],
                'attachments' => json_encode($filenames),
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $payDownId = $this->accounting_pay_down_credit_card_model->create($insertData);

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
                $this->form_validation->set_rules('day_in_advance', 'Days in advance', 'required');
                $this->form_validation->set_rules('recurring_mode', 'Recurring mode', 'required');

                if($data['recurring_mode'] !== 'daily') {
                    if($data['recurring_mode'] === 'monthly') {
                        $this->form_validation->set_rules('recurring_week', 'Recurring week', 'required');
                    } else if($data['recurring_mode'] === 'yearly') {
                        $this->form_validation->set_rules('recurring_month', 'Recurring month', 'required');
                    }

                    $this->form_validation->set_rules('recurring_day', 'Recurring day', 'required');
                }
                if($data['recurring_mode'] !== 'yearly') {
                    $this->form_validation->set_rules('recurring_interval', 'Recurring interval', 'required');
                }
                $this->form_validation->set_rules('recurring_start_date', 'Recurring start date', 'required');
                $this->form_validation->set_rules('recurring_end_type', 'Recurring end type', 'required');

                if($data['recurring_end_type'] === 'by') {
                    $this->form_validation->set_rules('recurring_end_by', 'Recurring end by', 'required');
                } else if($data['recurring_end_type'] === 'after') {
                    $this->form_validation->set_rules('recurring_max_occurence', 'Recurring max occurence', 'required');
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
            $filenames = $this->move_files($files, 'journal_entry');

            $insertData = [
                'company_id' => logged('company_id'),
                'journal_no' => (!isset($data['template_name'])) ? $data['journal_no'] : null,
                'journal_date' => (!isset($data['template_name'])) ? date('Y-m-d', strtotime($data['journal_date'])) : null,
                'memo' => $data['memo'],
                'attachments' => json_encode($filenames),
                'created_by' => logged('id'),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $entryId = $this->accounting_journal_entries_model->create($insertData);

            if($entryId > 0) {
                if(isset($data['template_name'])) {
                    $recurringData = [
                        'journal_entry_id' => $entryId,
                        'template_name' => $data['template_name'],
                        'recurring_type' => $data['recurring_type'],
                        'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['day_in_advance'] : null,
                        'recurring_mode' => $data['recurring_mode'],
                        'recurring_month' => $data['recurring_mode'] === 'yearly' ? $data['recurring_month'] : null,
                        'recurring_week' => $data['recurring_mode'] === 'monthly' ? $data['recurring_week'] : null,
                        'recurring_day' => $data['recurring_mode'] !== 'daily' ? $data['recurring_day'] : null,
                        'recurring_interval' => $data['recurring_mode'] !== 'yearly' ? $data['recurring_interval'] : null,
                        'recurring_start_date' => date('Y-m-d', strtotime($data['recurring_start_date'])),
                        'recurring_end_type' => $data['recurring_end_type'],
                        'recurring_end_by' => $data['recurring_end_type'] === 'by' ? date('Y-m-d', strtotime($data['recurring_end_by'])) : null,
                        'recurring_max_occurences' => $data['recurring_end_type'] === 'after' ? $data['recurring_max_occurence'] : null,
                        'status' => 1,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
    
                    $recurringId = $this->accounting_journal_entries_model->insertRecurringDetails($recurringData);
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
                        'description' => $data['description'][$key],
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
                $this->form_validation->set_rules('day_in_advance', 'Days in advance', 'required');
                $this->form_validation->set_rules('recurring_mode', 'Recurring mode', 'required');

                if($data['recurring_mode'] !== 'daily') {
                    if($data['recurring_mode'] === 'monthly') {
                        $this->form_validation->set_rules('recurring_week', 'Recurring week', 'required');
                    } else if($data['recurring_mode'] === 'yearly') {
                        $this->form_validation->set_rules('recurring_month', 'Recurring month', 'required');
                    }

                    $this->form_validation->set_rules('recurring_day', 'Recurring day', 'required');
                }
                if($data['recurring_mode'] !== 'yearly') {
                    $this->form_validation->set_rules('recurring_interval', 'Recurring interval', 'required');
                }
                $this->form_validation->set_rules('recurring_start_date', 'Recurring start date', 'required');
                $this->form_validation->set_rules('recurring_end_type', 'Recurring end type', 'required');

                if($data['recurring_end_type'] === 'by') {
                    $this->form_validation->set_rules('recurring_end_by', 'Recurring end by', 'required');
                } else if($data['recurring_end_type'] === 'after') {
                    $this->form_validation->set_rules('recurring_max_occurence', 'Recurring max occurence', 'required');
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
            $filenames = $this->move_files($files, 'bank_deposit');

            $bankAccount = explode('-', $data['bank_account']);
            $cashBackTarget = explode('-', $data['cash_back_target']);

            $totalAmount = array_sum(array_map(function($item) {
                return floatval($item);
            }, $data['amount']));

            $totalAmount = $totalAmount - floatval($data['cash_back_amount']);

            $insertData = [
                'company_id' => logged('company_id'),
                'account_key' => $bankAccount[0],
                'account_id' => $bankAccount[1],
                'date' => isset($data['template_name']) ? null : date('Y-m-d', strtotime($data['date'])),
                'tags' => json_encode($data['tags']),
                'total_amount' => number_format($totalAmount, 2, '.', ','),
                'cash_back_account_key' => $cashBackTarget[0],
                'cash_back_account_id' => $cashBackTarget[1],
                'cash_back_memo' => $data['cash_back_memo'],
                'cash_back_amount' => $data['cash_back_amount'],
                'memo' => $data['memo'],
                'attachments' => json_encode($filenames),
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
                        'bank_deposit_id' => $depositId,
                        'template_name' => $data['template_name'],
                        'recurring_type' => $data['recurring_type'],
                        'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['day_in_advance'] : null,
                        'recurring_mode' => $data['recurring_mode'],
                        'recurring_month' => $data['recurring_mode'] === 'yearly' ? $data['recurring_month'] : null,
                        'recurring_week' => $data['recurring_mode'] === 'monthly' ? $data['recurring_week'] : null,
                        'recurring_day' => $data['recurring_mode'] !== 'daily' ? $data['recurring_day'] : null,
                        'recurring_interval' => $data['recurring_mode'] !== 'yearly' ? $data['recurring_interval'] : null,
                        'recurring_start_date' => date('Y-m-d', strtotime($data['recurring_start_date'])),
                        'recurring_end_type' => $data['recurring_end_type'],
                        'recurring_end_by' => $data['recurring_end_type'] === 'by' ? date('Y-m-d', strtotime($data['recurring_end_by'])) : null,
                        'recurring_max_occurences' => $data['recurring_end_type'] === 'after' ? $data['recurring_max_occurence'] : null,
                        'status' => 1,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
    
                    $recurringId = $this->accounting_bank_deposit_model->insertRecurringDetails($recurringData);
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

                    $accountBalance = $this->chart_of_accounts_model->getBalance($account[1]);
                    $accountData = [
                        'id' => $account[1],
                        'company_id' => logged('company_id'),
                        'balance' => floatval($accountBalance) - floatval($data['amount'][$key])
                    ];
                    $withdraw = $this->chart_of_accounts_model->updateBalance($accountData);
                }

                $fundsId = $this->accounting_bank_deposit_model->insertFunds($fundsData);

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

        if(isset($data['product']) && isset($data['new_qty']) && isset($data['change_in_qty'])) {
            $this->form_validation->set_rules('product[]', 'Product', 'required');
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
                foreach($data['product'] as $key => $value) {
                    $adjustmentProducts[] = [
                        'adjustment_id' => $adjustmentId,
                        'product_id' => $value,
                        'new_quantity' => $data['new_qty'][$key],
                        'change_in_quantity' => $data['change_in_qty'][$key],
                    ];
                }

                $adjustmentProdId = $this->accounting_inventory_qty_adjustments_model->insertAdjProduct($adjustmentProducts);
            }

            $return['data'] = $adjustmentId;
            $return['success'] = $adjustmentId && $adjustmentProdId ? true : false;
            $return['message'] = $adjustmentId && $adjustmentProdId ? 'Entry Successful!' : 'An unexpected error occured!';
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

    private function payroll($data) {
        $this->form_validation->set_rules('pay_from', 'Pay from account', 'required');
        $this->form_validation->set_rules('pay_period', 'Pay Period', 'required');
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
                'pay_period_start' => date('Y-m-d', strtotime($payPeriod[0])),
                'pay_period_end' => date('Y-m-d', strtotime($payPeriod[1])),
                'pay_date' => date('Y-m-d', strtotime($data['pay_date'])),
                'company_id' => $company_id,
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
                    $empTotalPay = ($emp->pay_rate * (float)$data['reg_pay_hours'][$key]) + (float)$data['commission'][$key];
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
                        'employee_total_pay' => $empTotalPay,
                        'employee_taxes' => $empTax,
                        'employee_net_pay' => $empTotalPay - $empTax,
                        'employee_memo' => ($data['memo'][$key] === '') ? null : $data['memo'][$key],
                    ];
                }
            }

            if(count($employees) > 0) {
                $payrollEmpId = $this->accounting_payroll_model->insertPayrollEmployees($employees);

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

        $this->load->view("accounting/send_statement_modal", $this->page_data);
    }
}