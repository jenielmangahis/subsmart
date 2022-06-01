<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Sms extends Widgets {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
		$this->page_data['page']->title = 'Messages';
        $this->page_data['page']->parent = 'Dashboard';
    }

    public function index() 
    {
        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');

        $cid = logged('company_id');

        $search = '';
        if( get('search') != '' ){
            $search  = get('search');
            $search_param = ['value' => $search];
            $customers = $this->Customer_advance_model->get_company_customer_data($cid, $search_param);
        }else{
            $customers = $this->Customer_advance_model->get_customer_data();
        }
        
        $this->page_data['search'] = $search;
        $this->page_data['customers'] = $customers;
        $this->page_data['enable_input_mask'] = true;
        $this->load->view('v2/pages/dashboard/sms.php', $this->page_data);
    }

    public function ajax_company_send_sms() 
    {
        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $customer = $this->Customer_advance_model->get_data_by_id('prof_id',$post['cid'],'acs_profile');
        if( $customer && $customer->company_id == $cid ){
            $enable_send_sms = 0; 
            $is_with_phone_m = 1;       
            if( isset($post['send_sms_notification']) ){
                $enable_send_sms = 1;                    
                if( $customer->phone_m != '' ){
                    if( in_array($cid, $this->CompanySms_model->ringCentralCompanyIds()) ){
                        //Use ringcentral
                        $is_sent = $this->smsRingCentral($customer->phone_m, $post['sms_txt_message']);
                        if( $is_sent['is_success'] == 1 ){                    
                            $is_success = 1;
                        }else{
                            $msg = $is_sent['msg'];
                        }

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
                        'company_id' => $cid,
                        'prof_id' => $post['cid'],
                        'user_id' => $uid,
                        'sender_id' => $uid,
                        'sender_type' => 'agent',
                        'from_number' => '',
                        'to_number' => $customer->phone_m,
                        'txt_message' => $post['sms_txt_message'],
                        'enable_send_sms' => $enable_send_sms,
                        'date_created' => date("Y-m-d H:i:s")
                    ];

                    $this->CompanySms_model->create($data_sms);

                    $msg = '';
                }
            }else{
                $msg = 'Phone number is needed to send sms. <br /><a href="javascript:void(0);" data-customer-name="'.$customer->first_name . ' ' . $customer->last_name .'" data-id="'.$customer->prof_id.'" class="nsm-button primary btn-set-customer-mobile">Set Mobile Number</a>';
            }
            
        }else{
            $msg = 'Cannot find customer data';
        } 

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_company_delete_sms()
    {
        $this->load->model('CompanySms_model');
        
        $post = $this->input->post();

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid = logged('company_id');
        $sms = $this->CompanySms_model->getById($post['smsid']);
        if( $sms && $sms->company_id == $cid ){
            $this->CompanySms_model->delete($sms->id);

            $is_success = 1;
            $msg = '';            
        }
        
        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
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

    public function cleanMobileNumber($to_number)
    {
        $to_number = str_replace("-", "", $to_number);
        $to_number = str_replace(" ", "", $to_number);
        $to_number = str_replace("(", "", $to_number);
        $to_number = str_replace(")", "", $to_number);

        return $to_number;
    }

    public function ajax_company_resend_form()
    {
        $this->load->model('CompanySms_model');

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $companySms = $this->CompanySms_model->getById($post['smsid']);

        if( $companySms && $companySms->company_id == $cid ){
            
            $this->page_data['companySms'] = $companySms;
            $this->load->view('v2/pages/dashboard/ajax_company_resend_form.php', $this->page_data);
        }else{
            echo "Cannot find data";
        }
    }

    public function ajax_customer_sent_messages()
    {
        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $sentMessages = $this->CompanySms_model->getAllByProfId($post['cid']);
        $customer = $this->Customer_advance_model->get_data_by_id('prof_id',$post['cid'],'acs_profile');
        $this->page_data['sentMessages'] = $sentMessages;
        $this->page_data['customer'] = $customer;
        $this->load->view('v2/pages/dashboard/ajax_customer_sent_messages.php', $this->page_data);
    }
}