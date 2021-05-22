<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Marketing extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function sms_campaigns(){
        $this->load->model('SmsBlast_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('SmsLogs_model');
        $this->load->model('SmsBlastSendTo_model');

        $condition[] = ['field' => 'send_date <=', 'value' => date("Y-m-d")];
        $smsBlast   = $this->SmsBlast_model->getAllIsPaidAndNotSent($condition);
        $total_sent = 0;
        foreach($smsBlast as $sms){
            $sms_sent = 0;
            switch ($sms->sending_type) {
                case $this->SmsBlast_model->sendingTypeAll():
                    $condition = array();
                    if( $sms->customer_type == $this->SmsBlast_model->customerTypeResidential() ){
                        $condition[] = ['customer_type' => 'Residential'];                        
                    }elseif( $sms->customer_type == $this->SmsBlast_model->customerTypeCommercial() ){
                        $condition[] = ['customer_type' => 'Commercial'];                        
                    }

                    $contacts = $this->AcsProfile_model->getAllByCompanyId($sms->company_id, $condition);
                    
                    foreach($contacts as $c){
                        $to_number = $this->cleanMobileNumber($c->phone_m);
                        $result    = $this->sendSms($to_number, $sms->sms_text);
                        if( $result['is_sent'] ){
                            $sms_sent++; 
                            $total_sent++;   
                        }

                        //Log to sms_sent
                        $data_logs = [
                            'user_id' => $sms->user_id,
                            'from_number' => RINGCENTRAL_USER,
                            'to_number' => $to_number,
                            'sms_message' => $sms->sms_text,
                            'is_sent' => $result['is_sent'],
                            'error_message' => $result['msg'],
                            'date_created' => date("Y-m-d H:i:s")
                        ];

                        $this->SmsLogs_model->create($data_logs);
                    }
                    break;
                case $this->SmsBlast_model->sendingTypeContactGroups():
                    $sendTo = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms->id);
                    foreach( $sendTo as $st ){
                        $condition[] = ['customer_group_id' => $st->customer_group_id];     
                        $contact = $this->AcsProfile_model->getAllByCompanyId($st->customer_id, $condition);
                        foreach( $contact as $c ){
                            $to_number = $this->cleanMobileNumber($c->phone_m);
                            $result    = $this->sendSms($to_number, $sms->sms_text);
                            if( $result['is_sent'] ){
                                $sms_sent++;    
                                $total_sent++;
                            }

                            //Log to sms_sent
                            $data_logs = [
                                'user_id' => $sms->user_id,
                                'from_number' => RINGCENTRAL_USER,
                                'to_number' => $to_number,
                                'sms_message' => $sms->sms_text,
                                'is_sent' => $result['is_sent'],
                                'error_message' => $result['msg'],
                                'date_created' => date("Y-m-d H:i:s")
                            ];
                            $this->SmsLogs_model->create($data_logs);
                        }
                    }
                    break;

                case $this->SmsBlast_model->sendingTypeCertainContact():
                    $sendTo = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms->id);
                    foreach( $sendTo as $st ){
                        $condition[] = ['phone_m !=' => ''];  
                        $contact = $this->AcsProfile_model->getByProfId($st->customer_id, $condition);
                        if( $contact ){
                            $to_number = $this->cleanMobileNumber($contact->phone_m);
                            $result    = $this->sendSms($to_number, $sms->sms_text);
                            if( $result['is_sent'] ){
                                $sms_sent++;    
                                $total_sent++;
                            }

                            //Log to sms_sent
                            $data_logs = [
                                'user_id' => $sms->user_id,
                                'from_number' => RINGCENTRAL_USER,
                                'to_number' => $to_number,
                                'sms_message' => $sms->sms_text,
                                'is_sent' => $result['is_sent'],
                                'error_message' => $result['msg'],
                                'date_created' => date("Y-m-d H:i:s")
                            ];
                            $this->SmsLogs_model->create($data_logs);
                        }
                    }

                    break;
                default:
                    break;

                sleep(1);
            }
            exit;
            if( $sms_sent > 0 ){
                $sms_data = ['is_sent' => 1, 'date_sent' => date("Y-m-d")];
                $this->SmsBlast_model->updateSmsBlast($sms->id, $sms_data);
            }
        }

        echo "Total sent sms " . $total_sent;
        exit;
    }

    public function sendSms($to_number, $message){        
        include_once APPPATH . 'libraries/ringcentral_lite/src/ringcentrallite.php';

        $rc = new RingCentralLite(
            RINGCENTRAL_CLIENT_ID, //Client id
            RINGCENTRAL_CLIENT_SECRET, //Client secret
            RINGCENTRAL_DEV_URL //server url
        ); 
         
        $res = $rc->authorize(
            RINGCENTRAL_USER, //username
            RINGCENTRAL_PASSWORD, //extension
            RINGCENTRAL_EXT); //password

        $params = array(
            'json'     => array(
                'to'   => array( array('phoneNumber' => $to_number) ), //Send to
                'from' => array('phoneNumber' => RINGCENTRAL_USER), //Username
                'text' => $message
            )
        );

        $res = $rc->post('/restapi/v1.0/account/~/extension/~/sms', $params);
        $is_sent = false;
        $msg     = '';

        if( isset($res['errorCode']) ){
            $msg = $res['errorCode'] . " " . $res['message'];
        }else{
            $is_sent = true;
        }

        $return = ['is_sent' => $is_sent, 'msg' => $msg];

        return $return;
    }

    public function cleanMobileNumber( $mobile_number ){
        $mobile_number = str_replace("-", "", $mobile_number);
        $mobile_number = str_replace(" ", "", $mobile_number);
        $mobile_number = str_replace("(", "", $mobile_number);
        $mobile_number = str_replace(")", "", $mobile_number);

        return $mobile_number;
    }

    public function test_sms(){
        $this->load->library('RingCentral');
        $message  = 'Sample Text Message';
        $platform = $this->ringcentral->getPlatform();
        $platform->login('+18504780530', '', 'Ringmybell2021');
        $apiResponse = $platform->post('/account/~/extension/~/sms', array(
            'from' => array('phoneNumber' => '+18504780530'),
            'to' => array(
                array('phoneNumber' => '+18504780530'),
            ),
            'text' => $message,
        ));
        echo "<pre>";
        print_r($apiResponse);
        exit;
    }
}

