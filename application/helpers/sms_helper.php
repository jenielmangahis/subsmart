<?php

function smsRingCentral($ringCentral, $to_number, $txt_message)
{   
    include APPPATH . 'libraries/ringcentral-php-master/vendor/autoload.php';

    $is_sent = 0;
    $msg    = 'Cannot send sms.';
    $msg_id = 0;
    
    $to_number   = cleanMobileNumber($to_number);
    $to_number   = '+1'.$to_number;  
    $server_url  = 'https://platform.ringcentral.com';

    $rcsdk = new RingCentral\SDK\SDK( $ringCentral->client_id,$ringCentral->client_secret,$server_url);
    $platform = $rcsdk->platform();
    try {
        $platform->login(["jwt" => $ringCentral->jwt]);
        $requestBody = array(
            'from' => array ('phoneNumber' => $ringCentral->rc_from_number),
            'to' => array( array('phoneNumber' => $to_number) ),            
            'text' => $txt_message
        );
        $endpoint = "/account/~/extension/~/sms";
        $resp = $platform->post($endpoint, $requestBody);
        $jsonObj = $resp->json();
        $msg_id  = $jsonObj->id;

        $msg = '';
        $is_sent = 1;
        
    } catch (\RingCentral\SDK\Http\ApiException $e) {
        $msg = "Unable to authenticate to platform. Check credentials. " . $e->getMessage() . PHP_EOL;        
    }
    
    $return = ['is_sent' => $is_sent, 'msg' => $msg, 'from_number' => $ringCentral->rc_from_number, 'msg_id' => $msg_id];
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

function smsVonage($to_number, $sms_message)
{
    include_once APPPATH . 'libraries/vonage/vendor/autoload.php';   

    $is_sent = 0;
    $msg = '';

    $return_data = array();
    $to_number   = cleanMobileNumber($to_number);
    $to_number   = '1'.$to_number;
    try {
        $basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($to_number, VONAGE_NUMBER, $sms_message)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            $is_sent = 1;        
            $return_data = [
                'message_id' => $message->getMessageId(),
                'remaining_balance' => $message->getRemainingBalance(),
                'to' => $message->getTo(),
                'status' => $message->getStatus()
            ];
        } else {
            $msg = 'Vonage : Cannot send sms with status : ' . $message->getStatus();
        } 
    } catch (Exception $e) {
        $msg = $to_number . '/' . $e->getMessage();
    }    

    $result = ['is_sent' => $is_sent, 'msg' => $msg, 'data' => $return_data];

    return $result;
}

function cleanMobileNumber($to_number, $extension = '+1')
{    
    $to_number = str_replace("-", "", $to_number);
    $to_number = str_replace(".", "", $to_number);
    $to_number = str_replace(" ", "", $to_number);
    $to_number = str_replace("(", "", $to_number);
    $to_number = str_replace(")", "", $to_number);
    //$to_number = str_replace($extension, "", $to_number);

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

function ringCentralAllMessages($ringCentral, $date_from)
{
    require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';
        
    $replies  = array();

    try {
        $rcsdk    = new RingCentral\SDK\SDK(base64_decode($ringCentral->client_id), base64_decode($ringCentral->client_secret), RINGCENTRAL_DEV_URL, 'Demo', '1.0.0');
        $platform = $rcsdk->platform();
        $platform->login($ringCentral->rc_username, $ringCentral->rc_ext, $ringCentral->rc_password);
        
        $queryParams = array(
            'availability' => array('Alive'),
            'dateFrom' => date('Y-m-d', strtotime($date_from)),
            //'direction' => array('Inbound'),
            'messageType' => array('SMS'),
            /*'page' => 1,
            'perPage' => 50,*/
            //'phoneNumber' => $to_number
        );
    
        $apiResponse = $platform->get("/restapi/v1.0/account/~/extension/~/message-store", $queryParams);
        $jsonResponse = json_decode($apiResponse->text());
        foreach (array_reverse($jsonResponse->records) as $r){
            //$sms_message = explode('-', $r->subject);
            $replies[] = ['msg' => trim($r->subject), 'from' => $r->from->phoneNumber, 'date' => date("Y-m-d g:i A", strtotime($r->creationTime))];
        } 
    } catch (\Throwable $th) {
        $error = 'API Error';
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

function validateRingCentralAccount($client_id, $client_secret, $rc_jwt)
{   
    include APPPATH . 'libraries/ringcentral-php-master/vendor/autoload.php';

    $is_valid = 0;
    $err_msg  = 'Invalid credentials.';
    $server_url  = 'https://platform.ringcentral.com';

    $rcsdk = new RingCentral\SDK\SDK( $client_id,$client_secret,$server_url);
    $platform = $rcsdk->platform();
    try {
        $platform->login(["jwt" => $rc_jwt]);
        
        $is_valid = 1;
        $err_msg  = '';
        
    } catch (\RingCentral\SDK\Http\ApiException $e) {
        $err_msg = "Unable to authenticate to platform. Check credentials.";        
    }
    
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

function crexendoAccessToken()
{
    $post = [
        'grant_type' => 'password',
        'client_id' => 'dsfsd',
        'client_secret' => 'dsf',
        'username' => 'sdf',
        'password' => 'dfsfa'
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://portal.crexendovip.com/ns-api/v2/tokens');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    echo "<pre>";
    print_r($result);
    print_r($response);

}

function crexendoRefreshToken()
{
    $post = [
        'grant_type' => 'refresh_token',
        'client_id' => 'dsfsd',
        'client_secret' => 'dsf',
        'refresh_token' => 'sdf',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://portal.crexendovip.com/ns-api/v2/tokens');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    echo "<pre>";
    print_r($result);
    print_r($response);

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