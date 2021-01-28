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
        $this->load->model('invoice_model');
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
            }

            $this->load->view("accounting/". $view, $this->page_data);
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
                'net_pay' => $netPay,
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
                'transfer_date' => $data['date'],
                'transfer_memo' => $data['memo'],
                'transfer_attachments' => json_encode($filenames),
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
    
            $transferId = $this->accounting_transfer_funds_model->create($insertData);
    
            $return['data'] = $transferId;
            $return['success'] = $transferId ? true : false;
            $return['message'] = $transferId ? 'Transfer Successfully!' : 'An unexpected error occured!';
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

            $insertData = [
                'company_id' => logged('company_id'),
                'credit_card_id' => $data['credit_card'],
                'payee_id' => $data['payee'],
                'amount' => $data['amount'],
                'date' => $data['payment_date'],
                'bank_account_id' => $data['bank_account'],
                'memo' => $data['memo'],
                'attachments' => json_encode($filenames),
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
        $this->form_validation->set_rules('time', 'Time', 'required');
        if($data['billable'] === 1 || $data['billable'] === "1") {
            $this->form_validation->set_rules('hourly_rate', 'Hourly Rate', 'required');
        }

        if($data['start_end_time'] === 1 || $data['start_end_time'] === "1") {
            $this->form_validation->set_rules('start_time', 'Start Time', 'required');
            $this->form_validation->set_rules('end_time', 'End Time', 'required');
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            if(strpos($data['name'], 'employee-') === 0) {
                $nameKey = 'employee';
            } else {
                $nameKey = 'vendor';
            }
            $insertData = [
                'company_id' => logged('company_id'),
                'date' => $data['date'],
                'name_key' => $nameKey,
                'name_id' => ($nameKey === 'employee') ? str_replace('employee-', '', $data['name']) : str_replace('vendor-', '', $data['name']),
                'customer_id' => $data['customer'],
                'service_id' => $data['service'],
                'billable' => (isset($data['billable'])) ? 1 : 0,
                'hourly_rate' => (isset($data['billable'])) ? $data['hourly_rate'] : null,
                'taxable' => (isset($data['billable']) && isset($data['taxable'])) ? 1 : 0,
                'start_time' => (isset($data['start_end_time'])) ? $data['start_time'] : null,
                'end_time' => (isset($data['start_end_time'])) ? $data['end_time'] : null,
                'time' => $data['time'],
                'description' => $data['description'],
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
        $this->form_validation->set_rules('journal_date', 'Date', 'required');
        $this->form_validation->set_rules('journal_no', 'Journal No.', 'required');

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else if(isset($data['accounts']) && count($data['accounts']) < 2 || !isset($data['accounts'])) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'You must fill out at least two detail lines.';
        } else {
            $filenames = $this->move_files($files, 'journal_entry');

            $insertData = [];
            foreach ($data['accounts'] as $key => $value) {
                $name = explode('-', $data['names'][$key]);
                $account = explode('-', $value);

                $insertData[] = [
                    'company_id' => logged('company_id'),
                    'journal_no' => $data['journal_no'],
                    'journal_date' => $data['journal_date'],
                    'account_key' => $account[0],
                    'account_id' => $account[1],
                    'debits' => $data['debits'][$key],
                    'credits' => $data['credits'][$key],
                    'description' => $data['description'][$key],
                    'name_key' => $name[0],
                    'name_id' => $name[1],
                    'memo' => $data['memo'],
                    'attachments' => json_encode($filenames),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ];
            }

            $entryId = $this->accounting_journal_entries_model->insertBatch($insertData);

            $return['data'] = $entryId;
            $return['success'] = $entryId ? true : false;
            $return['message'] = $entryId ? 'Entry Successful!' : 'An unexpected error occured!';
        }

        return $return;
    }

    private function bank_deposit($data, $files) {
        $this->form_validation->set_rules('bank_account', 'Bank Account', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');

        if(isset($data['account']) && isset($data['amount'])) {
            $this->form_validation->set_rules('account[]', 'Account', 'required');
            $this->form_validation->set_rules('amount[]', 'Amount', 'required');
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

            $cashBackTarget = explode('-', $data['cash_back_target']);

            $insertData = [];
            foreach($data['account'] as $key => $value) {
                if(strpos($data['received_from'][$key], 'customer-') === 0) {
                    $nameKey = 'customer';
                    $nameId = str_replace('customer-', '', $data['received_from'][$key]);
                } else if(strpos($data['received_from'][$key], 'vendor-') === 0) {
                    $nameKey = 'vendor';
                    $nameId = str_replace('vendor-', '', $data['received_from'][$key]);
                } else if(strpos($data['received_from'][$key], 'employee-') === 0) {
                    $nameKey = 'employee';
                    $nameId = str_replace('employee-', '', $data['received_from'][$key]);
                } else {
                    $nameKey = null;
                    $nameId = null;
                }

                $insertData[] =[
                    'account_no' => $data['bank_account'],
                    'company_id' => logged('company_id'),
                    'date' => $data['date'],
                    'tags' => json_encode($data['tags']),
                    'received_from_key' => $nameKey,
                    'received_from_id' => $nameId,
                    'received_from_account' => $value,
                    'description' => $data['description'][$key],
                    'payment_method' => $data['payment_method'][$key],
                    'ref_no' => $data['reference_no'][$key],
                    'amount' => $data['amount'][$key],
                    'cash_back_account_key' => $cashBackTarget[0],
                    'cash_back_account_id' => $cashBackTarget[1],
                    'cash_back_memo' => $data['cash_back_memo'],
                    'cash_back_amount' => $data['cash_back_amount'],
                    'memo' => $data['memo'],
                    'attachments' => json_encode($filenames),
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ];
            }

            $depositId = $this->accounting_bank_deposit_model->insertBatch($insertData);

            $return['data'] = $depositId;
            $return['success'] = $depositId ? true : false;
            $return['message'] = $depositId ? 'Entry Successful!' : 'An unexpected error occured!';
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
            $insertData = [];
            $adjustmentAcc = explode('-', $data['inventory_adj_acc']);

            foreach($data['product'] as $key => $value) {
                $insertData[] = [
                    'adjustment_no' => $data['reference_no'],
                    'company_id' => logged('company_id'),
                    'adjustment_date' => $data['adjustment_date'],
                    'inventory_adjustment_account' => $adjustmentAcc[1],
                    'inventory_adjustment_account_type' => $adjustmentAcc[0],
                    'product_id' => $value,
                    'new_quantity' => $data['new_qty'][$key],
                    'change_in_quantity' => $data['change_in_qty'][$key],
                    'memo' => $data['memo'],
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ];
            }

            $adjustmentId = $this->accounting_inventory_qty_adjustments_model->insertBatch($insertData);

            $return['data'] = $adjustmentId;
            $return['success'] = $adjustmentId ? true : false;
            $return['message'] = $adjustmentId ? 'Entry Successful!' : 'An unexpected error occured!';
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
        } else {
            $insertData = [];

            $personTracking = explode('-', $data['person_tracking']);

            $weekDate = explode('-', $data['week_dates']);
            $weekStartDate = strtotime($weekDate[0]);
            $weekEndDate = strtotime($weekDate[1]);

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

                    $insertData[] = [
                        'name_key' => $personTracking[0],
                        'name_id' => $personTracking[1],
                        'week_start_date' => date('Y-m-d', $weekStartDate),
                        'week_end_date' => date('Y-m-d', $weekEndDate),
                        'customer_id' => $value,
                        'service_id' => $data['service'][$key],
                        'description' => $data['description'][$key],
                        'billable' => $billable,
                        'hourly_rate' => $hourlyRate,
                        'taxable' => $taxable,
                        'week_daily_hours' => json_encode($weekDailyHours),
                        'status' => 1,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
                }
            }

            if(count($insertData) > 0) {
                $timesheetRecordId = $this->accounting_weekly_timesheet_model->insertBatch($insertData);

                $return['data'] = $timesheetRecordId;
                $return['success'] = $timesheetRecordId ? true : false;
                $return['message'] = $timesheetRecordId ? 'Entry Successful!' : 'An unexpected error occured!';
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
            $insertData = [];

            $payPeriod = explode('-', $data['pay_period']);
            $payPeriodStart = date('Y-m-d', strtotime($payPeriod[0]));
            $payPeriodEnd = date('Y-m-d', strtotime($payPeriod[1]));

            $company_id = logged('company_id');
            $payrollNo = $this->accounting_payroll_model->getCompanyLastPayrollNo($company_id);

            foreach($data['select'] as $key => $value) {
                $emp = $this->users_model->getUser($value);
                $empTotalPay = ($emp->pay_rate * (float)$data['reg_pay_hours'][$key]) + (float)$data['commission'][$key];
                $empTotalPay = number_format($empTotalPay, 2, '.', ',');

                $empSocial = ($empTotalPay / 100) * 6.2;
                $empSocial = number_format($empSocial, 2, '.', ',');
                $empMedicare = ($empTotalPay / 100) * 1.45;
                $empMedicare = number_format($empMedicare, 2, '.', ',');
                $empTax = number_format($empSocial + $empMedicare, 2, '.', ',');

                $insertData[] = [
                    'payroll_no' => is_null($payrollNo) ? 1 : $payrollNo+1,
                    'pay_period_start' => $payPeriodStart,
                    'pay_period_end' => $payPeriodEnd,
                    'pay_date' => $data['pay_date'],
                    'company_id' => $company_id,
                    'employee_id' => $value,
                    'emp_hours' => $data['reg_pay_hours'][$key],
                    'emp_commission' => $data['commission'][$key],
                    'emp_total_pay' => $empTotalPay,
                    'emp_taxes' => $empTax,
                    'emp_net_pay' => $empTotalPay - $empTax,
                    'emp_memo' => ($data['memo'][$key] === '') ? null : $data['memo'][$key],
                    'status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ];
            }

            if(count($insertData) > 0) {
                $payrollId = $this->accounting_payroll_model->insertBatch($insertData);

                $return['data'] = $payrollId;
                $return['success'] = $payrollId ? true : false;
                $return['message'] = $payrollId ? 'Entry Successful!' : 'An unexpected error occured!';
            } else {
                $return['data'] = null;
                $return['success'] = false;
                $return['message'] = 'Nothing inserted.';
            }
        }

        return $return;
    }
}