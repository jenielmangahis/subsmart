<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Calls extends Widgets {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();		
        $this->page_data['page']->parent = 'Dashboard';
    }

    public function index() 
    {
        $this->load->helper('sms_helper');
        
        $this->load->model('CompanyCallLogs_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('TwilioAccounts_model');
        $this->load->model('RingCentralAccounts_model');
        $this->load->model('Clients_model');

        $cid   = logged('company_id');
        $search = '';

        if( get('search') != '' ){
            $search  = get('search');
            $search_param = ['value' => $search];
            $customers = $this->Customer_advance_model->get_company_customer_data($cid, $search_param);
        }else{            
            $customers = $this->Customer_advance_model->get_company_customer_data($cid);
        }

        $twilioAccount = $this->TwilioAccounts_model->getByCompanyId($cid);
        $ringCentralAccount = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $enable_twilio_call = false;
        $enable_ringcentral_call = false;

        $client = $this->Clients_model->getById($cid);
        if( $client->default_sms_api == 'twilio' ){
            $enable_twilio_call = true;
        }elseif( $client->default_sms_api == 'ring_central' ){
            $enable_ringcentral_call = true;
        }

        //$calls = $this->CompanyCallLogs_model->getAllByCompanyId($cid);
        $this->page_data['page']->title = 'Calls and Logs';
        $this->page_data['twilioAccount'] = $twilioAccount;
        $this->page_data['ringCentralAccount'] = $ringCentralAccount;
        $this->page_data['enable_twilio_call'] = $enable_twilio_call;
        $this->page_data['enable_ringcentral_call'] = $enable_ringcentral_call;
        $this->page_data['search'] = $search;
        $this->page_data['customers'] = $customers;
        //$this->page_data['calls'] = $calls;
        $this->load->view('v2/pages/dashboard/calls.php', $this->page_data);
    }

    public function logs() 
    {
        $this->load->helper('sms_helper');
        
        $this->load->model('CompanyCallLogs_model');
        $this->load->model('Customer_advance_model');

        $cid   = logged('company_id');
        $search = '';

        if( get('search') != '' ){
            $search  = get('search');
            $search_param = ['search' => $search];
            $companyCallLogs = $this->CompanyCallLogs_model->getAllByCompanyId($cid, $search_param);
        }else{            
            $companyCallLogs = $this->CompanyCallLogs_model->getAllByCompanyId($cid);
        }

        //$calls = $this->CompanyCallLogs_model->getAllByCompanyId($cid);
        $this->page_data['page']->title = 'Call Logs';
        $this->page_data['search'] = $search;
        $this->page_data['companyCallLogs'] = $companyCallLogs;
        $this->load->view('v2/pages/dashboard/call_logs.php', $this->page_data);
    }

    public function ajax_log_start_call()
    {
        $this->load->model('CompanyCallLogs_model');
        $this->load->model('TwilioAccounts_model');
        $this->load->model('RingCentralAccounts_model');
        $this->load->model('Clients_model');

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $twilioAccount = $this->TwilioAccounts_model->getByCompanyId($cid);
        $ringCentralAccount = $this->RingCentralAccounts_model->getByCompanyId($cid);
        $client = $this->Clients_model->getById($cid);

        if( $client->default_sms_api == 'ring_central' ){
            $from_number = $ringCentralAccount->rc_username;
        }else{
            $from_number = $twilioAccount->tw_number;
        }

        if( $post['cid'] > 0 && $post['phoneNumber'] != '' ){
            $date_start = date("Y-m-d H:i:s");
            $data = [
                'company_id' => $cid,
                'user_id' => $uid,
                'prof_id' => $post['cid'],
                'api_type' => $post['apiType'],
                'to_number' => $post['phoneNumber'],
                'from_number' => $from_number,
                'start_call' => $date_start,                
                'date_created' => $date_start
            ];

            $lastid = $this->CompanyCallLogs_model->create($data);
            $this->session->set_userdata('companyCallId', $lastid);
        }
    }

    public function ajax_log_end_call()
    {
        $this->load->model('CompanyCallLogs_model');

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $callId = $this->session->userdata('companyCallId');
        if( $callId > 0 ){
            $companyCallLogs = $this->CompanyCallLogs_model->getById($callId);
            if( $companyCallLogs ){
                $data = ['end_call' => date("Y-m-d H:i:s")];
                $this->CompanyCallLogs_model->update($callId,$data);

                $this->session->unset_userdata('companyCallId');
            }
        }
    }
}