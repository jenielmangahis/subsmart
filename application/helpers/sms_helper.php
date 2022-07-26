<?php

function smsRingCentral($ringCentral, $to_number, $txt_message)
{   
    include_once APPPATH . 'libraries/ringcentral_lite/src/ringcentrallite.php';    

    $to_number   = cleanMobileNumber($to_number);
    $to_number   = '+1'.$to_number;  
    //$from_number = RINGCENTRAL_FROM;

    //$message = replaceSmartTags($txt_message);
    $message = $txt_message;

    $rc = new RingCentralLite(
        base64_decode($ringCentral->client_id), //Client id
        base64_decode($ringCentral->client_secret), //Client secret
        RINGCENTRAL_DEV_URL //server url
    );
     
    $res = $rc->authorize(
        $ringCentral->rc_username, //username
        $ringCentral->rc_ext, //extension
        $ringCentral->rc_password //password
    ); //password

    $params = array(
        'json'     => array(
            'to'   => array( array('phoneNumber' => $to_number) ), //Send to
            'from' => array('phoneNumber' => $ringCentral->rc_from_number), 
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

    $return = ['is_success' => $is_success, 'msg' => $msg, 'from_number' => $ringCentral->rc_from_number];
    return $return;
}

function smsTwilio($twilio, $to_number, $message)
{
    include_once APPPATH . 'libraries/twilio/autoload.php'; 

    $is_sent = false;
    $msg = '';

    $to_number = cleanMobileNumber($to_number);
    $to_number = '+1'.$to_number;
    try {
        $client = new Twilio\Rest\Client(base64_decode($twilio->tw_sid), base64_decode($twilio->tw_token));
        $result = $client->messages->create(
            // Where to send a text message (your cell phone?)
            $to_number,
            array(
                'from' => $twilio->tw_number,
                'body' => $message
            )
        );

        $is_sent = true;
    }catch(Exception $e) {
      $msg = $e->getMessage();
    }

    $result = ['is_sent' => $is_sent, 'msg' => $msg];

    return $result;
}

function cleanMobileNumber($to_number)
{
    $to_number = str_replace("-", "", $to_number);
    $to_number = str_replace(".", "", $to_number);
    $to_number = str_replace(" ", "", $to_number);
    $to_number = str_replace("(", "", $to_number);
    $to_number = str_replace(")", "", $to_number);

    return $to_number;
}

function ringCentralMessageReplies($ringCentral, $to_number, $date_from)
{
    require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';
        
    $replies  = array();

    $rcsdk    = new RingCentral\SDK\SDK(base64_decode($ringCentral->client_id), base64_decode($ringCentral->client_secret), RINGCENTRAL_DEV_URL, 'Demo', '1.0.0');
    $platform = $rcsdk->platform();
    $platform->login($ringCentral->rc_username, $ringCentral->rc_ext, $ringCentral->rc_password);

    $to_number = cleanMobileNumber($to_number);
    $to_number = '+1'.$to_number;
    
    $queryParams = array(
        'availability' => array('Alive'),
        'dateFrom' => date('Y-m-d', strtotime($date_from)),
        //'direction' => array('Inbound'),
        'messageType' => array('SMS'),
        /*'page' => 1,
        'perPage' => 50,*/
        'phoneNumber' => $to_number
    );

    $apiResponse = $platform->get("/restapi/v1.0/account/~/extension/~/message-store", $queryParams);
    $jsonResponse = json_decode($apiResponse->text());
    foreach (array_reverse($jsonResponse->records) as $r){
        $sms_message = explode('-', $r->subject);
        $replies[] = ['msg' => $sms_message[0], 'from' => $r->from->phoneNumber, 'date' => date("Y-m-d g:i A", strtotime($r->creationTime))];
    } 

    return array_reverse($replies);
}

function ringCentralLastMessage($ringCentral, $prof_id)
{
    require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';

    $CI =& get_instance();
    $CI->load->model('CompanySms_model');

    $replies    = array();
    $companySms = $CI->CompanySms_model->getByProfId($prof_id);
    if( $companySms ){    
        try {
            $rcsdk    = new RingCentral\SDK\SDK(base64_decode($ringCentral->client_id), base64_decode($ringCentral->client_secret), RINGCENTRAL_DEV_URL, 'Demo', '1.0.0');
            $platform = $rcsdk->platform();
            $platform->login($ringCentral->rc_username, $ringCentral->rc_ext, $ringCentral->rc_password);

            $to_number = $companySms->to_number;
            $to_number = cleanMobileNumber($to_number);
            $to_number = '+1'.$to_number;

            $queryParams = array(
                'dateFrom' => date('Y-m-d', strtotime($companySms->created)),
                'availability' => array('Alive'),
                'distinctConversations' => 'true',
                'messageType' => array('SMS'),
                'phoneNumber' => $to_number,
                'page' => 1,
                'perPage' => 1,
            );

            $apiResponse = $platform->get("/restapi/v1.0/account/~/extension/~/message-store", $queryParams);
            $jsonResponse = json_decode($apiResponse->text());
            foreach (array_reverse($jsonResponse->records) as $r){
                $sms_message = explode('-', $r->subject);
                $replies[] = ['msg' => $sms_message[0], 'from' => $r->from->phoneNumber, 'date' => date("Y-m-d g:i A", strtotime($r->creationTime))];
            }      
        } catch (Exception $e) {
            $msg = $e->getMessage();    
        }    
        
    }

    return array_reverse($replies);
}

function ringCentralCreateContact($info = array())
{
    require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';
        
    $replies  = array();

    $rcsdk    = new RingCentral\SDK\SDK(RINGCENTRAL_CLIENT_ID, RINGCENTRAL_CLIENT_SECRET, RINGCENTRAL_DEV_URL, 'Demo', '1.0.0');
    $platform = $rcsdk->platform();
    $platform->login(RINGCENTRAL_USER, RINGCENTRAL_EXT, RINGCENTRAL_PASSWORD);

    $info['phone_number'] = cleanMobileNumber($info['phone_number']);

    $apiResponse = $platform->post("/restapi/v1.0/account/~/extension/~/address-book/contact", $info);
    echo "<pre>";
    print_r($apiResponse);
    exit;
    return $replies;
}

function validateRingCentralAccount($client_id, $client_secret, $rc_user, $rc_password, $rc_ext)
{   
    require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';
        
    $err_msg  = '';
    $is_valid = false;

    $rcsdk    = new RingCentral\SDK\SDK(base64_decode($client_id), base64_decode($client_secret), RINGCENTRAL_DEV_URL, 'Demo', '1.0.0');

    try {
        $platform = $rcsdk->platform();
        $platform->login($rc_user, $rc_ext, $rc_password);
        $is_valid = true;
    } catch (Exception $e) {
        $err_msg = $e->getMessage();
    }

    $is_valid = true; //Remove if done with call demo

    $return = ['is_valid' => $is_valid, 'err_msg' => $err_msg];

    return $return;
}

function validateTwilioAccount($sid, $token)
{
    include_once APPPATH . 'libraries/twilio/autoload.php'; 

    $is_valid = false;
    $err_msg = '';

    $to_number     = '+1'.$to_number;
    try {
        $client = new Twilio\Rest\Client(base64_decode($sid), base64_decode($token)); 
        
        $service = $client->verify->v2->services
                              ->create("My First Verify Service");

        $is_valid = true;
    }catch(Exception $e) {
      $err_msg = $e->getMessage();
    }

    $result = ['is_valid' => $is_valid, 'err_msg' => $err_msg];

    return $result;
}

function twilioReadReplies($twilio, $to_number)
{
    include_once APPPATH . 'libraries/twilio/autoload.php'; 

    $replies = array();
    $msg     = '';
    $to_number = '+1'.$to_number;

    try {
        $client = new Twilio\Rest\Client(base64_decode($twilio->tw_sid), base64_decode($twilio->tw_token));
        
        $messages = $client->messages
           ->read([
                "to" => $to_number
            ],
            20
        );
        foreach ($messages as $record) {
            $dateSent = $record->dateSent;            
            $replies[] = ['msg' => $record->body, 'date' => $dateSent->format('Y-m-d g:i A'), 'from' => $record->from];
        }        

        
    }catch(Exception $e) {
      $msg = $e->getMessage();
    }

    //$result = ['replies' => $replies, 'msg' => $msg];

    return $replies;
}

function smsReplaceSmartTags($message, $cid){

    $CI =& get_instance();
    $CI->load->model('Clients_model');
    $CI->load->model('Payment_records_model', 'payment_records_model');

    $company = $CI->Clients_model->getById($cid);

    $message = str_replace("{{customer.name}}", 'John Doe', $message);
    $message = str_replace("{{customer.first_name}}", 'John', $message);
    $message = str_replace("{{customer.last_name}}", 'Doe', $message);
    $message = str_replace("{{business.email}}", $company->email_address, $message);
    $message = str_replace("{{business.phone}}", $company->phone_number, $message);
    $message = str_replace("{{business.name}}", $company->business_name, $message);

    return $message;
}