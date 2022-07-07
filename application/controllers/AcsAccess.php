<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsAccess extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $customer_data    = $this->session->userdata('customer_data');
        $this->customer_id = $customer_data['prof_id'];

        $this->page_data = [
            'url' => assets_url()
        ];

        $this->data = [
            'assets' => assets_url(),
            'body_classes'  => setting('login_theme') == '1' ? 'login-page login-background' : 'login-page-side login-background'
        ];
    }

    public function dashboard()
    {
        $this->page_data['page_title'] = 'Dashboard';
        $this->page_data['page_parent'] = 'Dashboard';
        $this->load->view('customer_access/dashboard', $this->page_data);
    }

    public function messages()
    {
        $this->load->helper('sms_helper');
        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');

        $companySms = $this->CompanySms_model->getByProfId($this->customer_id);
        $customer   = $this->Customer_advance_model->get_data_by_id('prof_id',$this->customer_id,'acs_profile');
        
        $sentMessages = array();
        if( $companySms ){
            if( $companySms->sms_api == $this->CompanySms_model->apiRingCentral() ){
                $sentMessages  = ringCentralMessageReplies($customer->phone_m);    
            }
        }           
        
        $this->page_data['sentMessages'] = $sentMessages;
        $this->page_data['companySms']   = $companySms;     
        $this->page_data['page_title']   = 'SMS';
        $this->page_data['page_parent']  = 'SMS';
        $this->load->view('customer_access/messages/list', $this->page_data);
    }

    public function logout()
    {
        $this->session->unset_userdata('customer_data');
        redirect('login/customer','refresh');
    }

    public function ajax_load_messages_list()
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('CustomerMessageReply_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Users_model');

        $post = $this->input->post();

        $customerMessage = $this->CustomerMessages_model->getById($post['mid']);
        $customerMessageReplies = $this->CustomerMessageReply_model->getAllByCustomerMessageId($customerMessage->id);
        foreach($customerMessageReplies as $r){
            $name = '';
            if( $r->prof_id > 0 ){
                $person = $this->AcsProfile_model->getByProfId($r->prof_id);
                if($person){
                    $name = $person->first_name . ' ' . $person->last_name;
                }
            }else{
                $person = $this->Users_model->getUser($r->user_id);
                if($person){
                    $name = $person->FName . ' ' . $person->LName;
                }
            }

            $r->name = $name;
        }

        $this->page_data['customerMessage'] = $customerMessage;
        $this->page_data['customerMessageReplies'] = $customerMessageReplies;
        $this->load->view('customer_access/messages/ajax_load_messages_list', $this->page_data);
    }

    public function ajax_load_message_thread()
    {
        $this->load->model('CustomerMessageReply_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Users_model');

        $post = $this->input->post();

        $customerMessageReplies = $this->CustomerMessageReply_model->getAllByCustomerMessageId($post['cid']);
        foreach($customerMessageReplies as $r){
            $name = '';
            if( $r->prof_id > 0 ){
                $person = $this->AcsProfile_model->getByProfId($r->prof_id);
                if($person){
                    $name = $person->first_name . ' ' . $person->last_name;
                }
            }else{
                $person = $this->Users_model->getUser($r->user_id);
                if($person){
                    $name = $person->FName . ' ' . $person->LName;
                }
            }

            $r->name = $name;
        }

        $this->page_data['customerMessageReplies'] = $customerMessageReplies;
        $this->load->view('customer_access/messages/ajax_load_message_thread', $this->page_data);
    }

    public function ajax_send_message_reply()
    {
        $this->load->helper('sms_helper');

        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('RingCentralSmsLogs_model');

        $is_success = 0;
        $msg = 'Cannot save data.';
        $from_number = '';

        $post = $this->input->post();

        $customer = $this->Customer_advance_model->get_data_by_id('prof_id',$this->customer_id,'acs_profile');
        if( $customer ){
            if( $customer->phone_m != '' ){
                if( in_array($customer->company_id, $this->CompanySms_model->ringCentralCompanyIds()) ){
                    //Use ringcentral
                    $sms_api = $this->CompanySms_model->apiRingCentral();
                    $from = cleanMobileNumber($customer->phone_m);
                    $from = '+1' . $from;
                    $is_sent = smsRingCentral(RINGCENTRAL_FROM, $from, $post['sms_txt_message']);                        
                    if( $is_sent['is_success'] == 1 ){                    
                        $is_success = 1;
                        $from_number = $is_sent['from_number'];
                    }else{
                        $msg = $is_sent['msg'];
                    }

                }else{
                    //Use twiio
                    $sms_api = $this->CompanySms_model->apiTwilio();
                    $twilio  = smsTwilio($customer->phone_m, $post['sms_txt_message']);
                    if( $twilio['is_sent'] ){
                        $is_success = 1;
                    }else{
                        $msg = $is_sent['msg'];
                    }
                }

                if( $is_success ){
                    $created = date("Y-m-d H:i:s");
                    $companySms = $this->CompanySms_model->getByProfId($customer->prof_id);
                    if( $sms_api == $this->CompanySms_model->apiRingCentral() ){
                        $data_ring_central = [
                            'company_sms_id' => $companySms->id,
                            'from_number' => $from_number,
                            'to_number' => RINGCENTRAL_FROM,
                            'date_created' => $created
                        ];

                        $this->RingCentralSmsLogs_model->create($data_ring_central);
                    }
                    
                    $msg = '';
                }

            }else{
                $msg = 'Cannot send sms. Customer must have a valid phone number';
            }
            
        }else{
            $msg = 'Cannot find customer data';
        } 

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_load_sent_messages()
    {
        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('Users_model');

        $uid  = logged('id');
        $post = $this->input->post();

        $customer_data = $this->session->userdata('customer_data');
        $user = $this->Users_model->getUser($post['aid']);
        
        $sentMessages = $this->CompanySms_model->getAllByProfIdAndUserId($customer_data['prof_id'],$post['aid']);
        $customer = $this->Customer_advance_model->get_data_by_id('prof_id',$customer_data['prof_id'],'acs_profile');
        $agent = $this->Users_model->getUser($post['aid']);

        $this->page_data['sentMessages'] = $sentMessages;
        $this->page_data['customer'] = $customer;
        $this->page_data['agent'] = $agent;
        $this->load->view('customer_access/messages/ajax_sent_messages.php', $this->page_data);
    }
}

/* End of file AcsAccess.php */
/* Location: ./application/controllers/AcsAccess.php */
