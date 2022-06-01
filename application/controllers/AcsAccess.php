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
        $this->load->model('CompanySms_model');

        $messages   = $this->CompanySms_model->getAllUniqueSenderByProfId($this->customer_id);

        $this->page_data['page_title'] = 'Messages';
        $this->page_data['page_parent'] = 'Messages';
        $this->page_data['messages'] = $messages;
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
        $this->load->model('CompanySms_model');
        $this->load->model('Users_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $post = $this->input->post();

        $customer_data = $this->session->userdata('customer_data');
        $user = $this->Users_model->getUser($post['aid']);
        if( $user ){
            $enable_send_sms = 0; 
            $is_with_phone_m = 1;       
            if( isset($post['send_sms_notification']) ){
                $enable_send_sms = 1;                    
                if( $user->mobile != '' ){
                    if( in_array($user->company_id, $this->CompanySms_model->ringCentralCompanyIds()) ){
                        //Use ringcentral
                        /*$is_sent = $this->smsRingCentral($user->mobile, $post['sms_txt_message']);
                        if( $is_sent['is_success'] == 1 ){                    
                            $is_success = 1;
                        }else{
                            $msg = $is_sent['msg'];
                        }*/

                        $is_success = 1;

                    }else{
                        //Use twiio
                    }
                    $is_with_phone_m = 1;
                }else{
                    $is_with_phone_m = 0;
                }
            }else{
                $is_success = 1;
            }

            if( $is_with_phone_m == 1 ){
                if( $is_success == 1 ){
                    $data_sms = [
                        'company_id' => $customer_data['company_id'],
                        'prof_id' => $customer_data['prof_id'],
                        'user_id' => $post['aid'],
                        'sender_id' => $customer_data['prof_id'],
                        'sender_type' => 'customer',
                        'from_number' => '',
                        'to_number' => $user->mobile,
                        'txt_message' => $post['sms_txt_message'],
                        'enable_send_sms' => $enable_send_sms,
                        'date_created' => date("Y-m-d H:i:s")
                    ];

                    $this->CompanySms_model->create($data_sms);

                    $msg = '';
                }
            }else{
                $msg = 'Current agent has no mobile number sent. Cannot send sms notification.';
            }
            
        }else{
            $msg = 'Cannot find agent data';
        } 

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function cleanMobileNumber($to_number)
    {
        $to_number = str_replace("-", "", $to_number);
        $to_number = str_replace(" ", "", $to_number);
        $to_number = str_replace("(", "", $to_number);
        $to_number = str_replace(")", "", $to_number);

        return $to_number;
    }

    public function smsRingCentral($to_number, $txt_message)
    {
        include_once APPPATH . 'libraries/ringcentral_lite/src/ringcentrallite.php';

        $to_number = $this->cleanMobileNumber($to_number);
        $to_number = '+1'.$to_number;

        $message = replaceSmartTags($txt_message);

        $rc = new RingCentralLite(
            RINGCENTRAL_CLIENT_ID, //Client id
            RINGCENTRAL_CLIENT_SECRET, //Client secret
            RINGCENTRAL_DEV_URL //server url
        );
         
        $res = $rc->authorize(
            RINGCENTRAL_USER, //username
            RINGCENTRAL_EXT, //extension
            RINGCENTRAL_PASSWORD //password
        ); //password

        $params = array(
            'json'     => array(
                'to'   => array( array('phoneNumber' => $to_number) ), //Send to
                'from' => array('phoneNumber' => RINGCENTRAL_FROM), //Username
                'text' => $message
            )
        );

        $res = $rc->post('/restapi/v1.0/account/~/extension/~/sms', $params);
        $is_success = 0;
        $msg     = '';

        if (isset($res['errorCode'])) {
            $msg = $res['errorCode'] . " " . $res['message'];
        } else {
            $is_success = 1;
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];

        return $return;
    }
}

/* End of file AcsAccess.php */
/* Location: ./application/controllers/AcsAccess.php */
