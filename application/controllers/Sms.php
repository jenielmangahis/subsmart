<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Sms extends Widgets {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
		$this->page_data['page']->title = 'SMS';
        $this->page_data['page']->parent = 'Dashboard';
    }

    public function index() 
    {
        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('Clients_model');

        $cid = logged('company_id');

        $search = '';
        if( get('search') != '' ){
            $search  = get('search');
            $search_param = ['value' => $search];
            $customers = $this->Customer_advance_model->get_company_customer_data($cid, $search_param);
        }else{
            $customers = $this->Customer_advance_model->get_customer_data();
        }

        $is_with_sms_api = false;
        $client = $this->Clients_model->getById($cid);
        if( $client->default_sms_api != '' ){
            $is_with_sms_api = true;
        }
        
        $this->page_data['search'] = $search;
        $this->page_data['customers'] = $customers;
        $this->page_data['enable_input_mask'] = true;
        $this->page_data['is_with_sms_api'] = $is_with_sms_api;
        $this->load->view('v2/pages/dashboard/sms.php', $this->page_data);
    }

    public function ajax_company_send_sms() 
    {
        $this->load->helper('sms_helper');

        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('RingCentralSmsLogs_model');
        $this->load->model('RingCentralAccounts_model');
        $this->load->model('Clients_model');

        $is_success = 0;
        $msg = 'Cannot save data.';
        $from_number = '';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $customer = $this->Customer_advance_model->get_data_by_id('prof_id',$post['cid'],'acs_profile');
        if( $customer && $customer->company_id == $cid ){
            if( $customer->phone_m != '' ){
                $client = $this->Clients_model->getById($cid);

                if( $client->default_sms_api == 'ring_central' ){
                    $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($client->id);
                    if( $ringCentral ){
                        $sms_api = $this->CompanySms_model->apiRingCentral();                        
                        $is_sent = smsRingCentral($ringCentral, $customer->phone_m, $post['sms_txt_message']);                        
                        if( $is_sent['is_success'] == 1 ){                    
                            $is_success = 1;
                            $from_number = $is_sent['from_number'];
                        }else{
                            $msg = $is_sent['msg'];
                        }
                    }else{
                      $msg = 'You do not have a valid ring central account. Cannot send SMS.';  
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
                    $isWithSmsRecord = $this->CompanySms_model->getByProfId($customer->prof_id);
                    if( $isWithSmsRecord ){
                        $company_sms_id = $isWithSmsRecord->id;
                    }else{
                        $data_sms = [
                            'company_id' => $cid,
                            'user_id' => $uid,
                            'prof_id' => $customer->prof_id,
                            'from_number' => $from_number,
                            'sms_api' => $sms_api,
                            'to_number' => $customer->phone_m,                        
                            'date_created' => $created
                        ];

                        $company_sms_id = $this->CompanySms_model->create($data_sms); 
                    }

                    if( $sms_api == $this->CompanySms_model->apiRingCentral() ){
                        $data_ring_central = [
                            'company_sms_id' => $company_sms_id,
                            'from_number' => $from_number,
                            'to_number' => $customer->phone_m,
                            'date_created' => $created
                        ];

                        $this->RingCentralSmsLogs_model->create($data_ring_central);
                    }
                    
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
        $this->load->helper('sms_helper');
        $this->load->model('CompanySms_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('Clients_model');
        $this->load->model('RingCentralAccounts_model');

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $customer    = $this->Customer_advance_model->get_data_by_id('prof_id',$post['cid'],'acs_profile');
        $companySms  = $this->CompanySms_model->getByProfId($post['cid']);
        $client      = $this->Clients_model->getById($cid);
        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $sentMessages = array();
        if( $client->default_sms_api == 'ring_central' ){
            $sentMessages  = ringCentralMessageReplies($ringCentral, $customer->phone_m);    
        }

        $this->page_data['sentMessages'] = $sentMessages;
        $this->page_data['companySms'] = $companySms;
        $this->page_data['customer']   = $customer;
        $this->load->view('v2/pages/dashboard/ajax_customer_sent_messages.php', $this->page_data);
    }
}