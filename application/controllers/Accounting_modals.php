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
        $this->load->model('accounting_bank_deposit_model');
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
                break;
                case 'journal_entry_modal':
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getVendors();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
                break;
                case 'bank_deposit_modal':
                    $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
                    $this->page_data['dropdown']['vendors'] = $this->vendors_model->getVendors();
                    $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
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

            $insertData = [
                'company_id' => logged('company_id'),
                'transfer_from_account' => $data['transfer_from'],
                'transfer_to_account' => $data['transfer_to'],
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
                if(strpos($data['names'][$key], 'customer-') === 0) {
                    $nameKey = 'customer';
                    $nameId = str_replace('customer-', '', $data['names'][$key]);
                } else if(strpos($data['names'][$key], 'vendor-') === 0) {
                    $nameKey = 'vendor';
                    $nameId = str_replace('vendor-', '', $data['names'][$key]);
                } else if(strpos($data['names'][$key], 'employee-') === 0) {
                    $nameKey = 'employee';
                    $nameId = str_replace('employee-', '', $data['names'][$key]);
                } else {
                    $nameKey = null;
                    $nameId = null;
                }

                $insertData[] = [
                    'company_id' => logged('company_id'),
                    'journal_no' => $data['journal_no'],
                    'journal_date' => $data['journal_date'],
                    'account_no' => $value,
                    'debits' => $data['debits'][$key],
                    'credits' => $data['credits'][$key],
                    'description' => $data['description'][$key],
                    'name_key' => $nameKey,
                    'name_id' => $nameId,
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
                    'cash_back_account' => $data['cash_back_target'],
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
}