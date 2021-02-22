<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require('ringcentral/autoload.php');
use \RingCentral\SDK\Http\ApiException;

class RingCentral {

    function __construct() {
        
    }

    private function getPlatform() {
        $RINGCENTRAL_CLIENTID = 'G7hO3YZ8RcaDm1tg15P1rg';
        $RINGCENTRAL_CLIENTSECRET = '3F2ripB5QHSa2gLPN-WF1AY5eRTFd0RSSddW2OWfYLjg';
        $RINGCENTRAL_SERVER = 'https://platform.devtest.ringcentral.com';

        $RINGCENTRAL_USERNAME = '+16505691634';
        $RINGCENTRAL_PASSWORD = 'nSmarTrac2020!';
        $RINGCENTRAL_EXTENSION = '101';


        $rcsdk = new RingCentral\SDK\SDK($RINGCENTRAL_CLIENTID, $RINGCENTRAL_CLIENTSECRET, $RINGCENTRAL_SERVER);

        $platform = $rcsdk->platform();

        return $platform;
    }

    function read_extension_phone_number() {
        $platform = $this->getPlatform();
        $resp = $platform->get("/restapi/v1.0/account/~/extension/~/phone-number");
        $jsonObj = $resp->json();
        foreach ($resp->json()->records as $record) {
            foreach ($record->features as $feature) {
                if ($feature == "SmsSender") {
                    return send_sms($record->phoneNumber);
                }
            }
        }
    }

    function send_sms($fromNumber = NULL) {
        $platform = $this->getPlatform();
        $RECIPIENT = '+639989803926';
        try {
            $resp = $platform->post('/account/~/extension/~/sms',
                    array(
                        'from' => array('phoneNumber' => '+639177722713'),
                        'to' => array(
                            array('phoneNumber' => $RECIPIENT)
                        ),
                        'text' => 'Hello World from PHP'
            ));
            print_r("SMS sent. Message status: " . $resp->json()->messageStatus . PHP_EOL);
        } catch (ApiException $e) {
            //print '  Message: ' . $e->apiResponse->response()->error() . PHP_EOL;
            print_r($e->apiResponse->response()->error() . PHP_EOL);
        }
    }
    
    function sample()
    {
        $platform = $this->getPlatform();
        $platform->login(getenv('+16505691634'), getenv('101'), getenv('nSmarTrac2020!'));
        $r = $platform->get("/restapi");
        
        print_r($r);
    }

}
