<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require('ringcentral/autoload.php');

use RingCentral\SDK\Http\ApiException;
use RingCentral\SDK\Http\HttpException;
use RingCentral\SDK\Http\ApiResponse;
use RingCentral\SDK\SDK;

class Ringcentral {

    function __construct() {
        
    }

    public function getPlatform() {
        $RINGCENTRAL_CLIENTID = 'G7hO3YZ8RcaDm1tg15P1rg';
        $RINGCENTRAL_CLIENTSECRET = '3F2ripB5QHSa2gLPN-WF1AY5eRTFd0RSSddW2OWfYLjg';
        $RINGCENTRAL_SERVER = 'https://platform.devtest.ringcentral.com';

        $RINGCENTRAL_USERNAME = '+16505691634';
        $RINGCENTRAL_PASSWORD = 'nSmarTrac2020!';
        $RINGCENTRAL_EXTENSION = '101';


        $rcsdk = new RingCentral\SDK\SDK($RINGCENTRAL_CLIENTID, $RINGCENTRAL_CLIENTSECRET, RingCentral\SDK\SDK::SERVER_SANDBOX);

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

    function send_sms($to = NULL, $message = NULL) {
        $platform = $this->getPlatform();
        
        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                try{
                    $apiResponse = $platform->post('/account/~/extension/~/sms', array(
                    'from' => array('phoneNumber' => '+16505691634'),
                    'to' => array(
                        array('phoneNumber' => $to),
                    ),
                    'text' => urldecode($message),
                    ));
                    return true;
                    
                } catch (ApiException $ex) {
                        print '  Message: ' . $e->apiResponse->response()->error() . PHP_EOL;
                   //return false;
                }
            } else {
                echo 'something went wrong';
            }
        }else{
            echo 'session expired';
        }
    }

    function getEngine() {
        
        $platform = $this->getPlatform();
        $RINGCENTRAL_REDIRECT_URL = "http://localhost/projects/nsmartrac/dashboard/ringcentral";
        
        if (isset($_REQUEST['oauth2callback'])) {
            if (!isset($_GET['code'])) {
                return;
            }
            $qs = $platform->parseAuthRedirectUrl($_SERVER['QUERY_STRING']);
            $qs["redirectUri"] = $RINGCENTRAL_REDIRECT_URL;

            $platform->login($qs);
            $_SESSION['sessionAccessToken'] = $platform->auth()->data();
            header("Location: http://localhost/projects/nsmartrac/dashboard/ringcentral");
        }

        if (!isset($_SESSION['sessionAccessToken'])) {
            header("Location: http://localhost/projects/nsmartrac/dashboard");
            exit();
        } else {
            $platform->auth()->setData((array) $_SESSION['sessionAccessToken']);
            if (!$platform->loggedIn()) {
                header("Location: http://localhost/projects/nsmartrac/dashboard");
                exit();
            }
            if (isset($_REQUEST['logout'])) {
                unset($_SESSION['sessionAccessToken']);
                $platform->logout();
                header("Location: http://localhost/projects/nsmartrac/dashboard");
                exit();
            } elseif (isset($_REQUEST['api'])) {
                if ($_REQUEST['api'] == "extension") {
                    $endpoint = "/restapi/v1.0/account/~/extension";
                    callGetRequest($endpoint, null);
                } elseif ($_REQUEST['api'] == "extension-call-log") {
                    $endpoint = "/restapi/v1.0/account/~/extension/~/call-log";
                    $params = array(
                        'fromDate' => '2018-12-01T00:00:00.000Z',
                    );
                    callGetRequest($endpoint, $params);
                } elseif ($_REQUEST['api'] == "account-call-log") {
                    $endpoint = "/restapi/v1.0/account/~/call-log";
                    $params = array(
                        'fromDate' => '2018-12-01T00:00:00.000Z',
                    );
                    callGetRequest($endpoint, $params);
                }
            }
        }

    }
    

    function callGetRequest($endpoint, $params) {
        $platform = $this->getPlatform();
        try {
            $resp = $platform->get($endpoint, $params);
            echo "<p>" . $resp->text() . "</p>";
        } catch (\RingCentral\SDK\Http\ApiException $e) {
            print 'Expected HTTP Error: ' . $e->getMessage() . PHP_EOL;
        }
    }

    function sample() {
        $platform = $this->getPlatform();
        $platform->login(getenv('+16505691634'), getenv('101'), getenv('nSmarTrac2020!'));
        $r = $platform->get("/restapi");

        print_r($r);
    }

}
