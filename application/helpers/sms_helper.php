<?php

function smsRingCentral($to_number, $txt_message)
{   
    include_once APPPATH . 'libraries/ringcentral_lite/src/ringcentrallite.php';    

    $to_number = cleanMobileNumber($to_number);
    $to_number = '+1'.$to_number;

    //$message = replaceSmartTags($txt_message);
    $message = $txt_message;

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

function smsTwilio($to_number, $message)
{
    include_once APPPATH . 'libraries/twilio/autoload.php'; 

    $is_sent = false;
    $msg = '';

    $to_number     = '+1'.$to_number;
    $twilio_number = "+15017122661";
    try {
        $client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);
        $result = $client->messages->create(
            // Where to send a text message (your cell phone?)
            $to_number,
            array(
                'from' => TWILIO_NUMBER,
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