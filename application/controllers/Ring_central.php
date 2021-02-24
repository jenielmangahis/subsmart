<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ring_central extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->load->library('Ringcentral');
    }

    public function index() {
        $platform = $this->ringcentral->getPlatform();
        $RINGCENTRAL_REDIRECT_URL = base_url()."ring_central/engine?oauth2callback";

        if (!$this->session->isRCLogin):
            $this->session->set_userdata('isRCLogin', false);
        endif;
//        
        $this->page_data['RINGCENTRAL_REDIRECT_URL'] = $RINGCENTRAL_REDIRECT_URL;
        $this->page_data['platform'] = $platform;
        $this->load->view('ringcentral/default', $this->page_data);
    }
    
    private function response($status)
    {
        if($status=="Queued"):
            echo 'SMS Sent';
        else:
            echo 'Something went wrong';
        endif;
    }
    
    public function fetchSMS($to)
    {
        $platform = $this->ringcentral->getPlatform();
         
        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                
                $queryParams = array(
                    
                );
                
                $r = $platform->get("/account/~/extension/~/message-store", $queryParams);
                
                $jsonResponse = json_decode($r->text());
                //print_r($jsonResponse->records);
                
                foreach ($jsonResponse->records as $r):
                    echo $r->subject.'<br />';
                endforeach;
                    
            } else {
                echo 'something went wrong';
            }
        }else{
            echo json_encode(array('msg'=>'Your are not Logged In to Ring Central or your Session has expired', 'status'=>false));
        }
        
    }

    public function sendSMS($to = NULL, $message = NULL) {
        $platform = $this->ringcentral->getPlatform();
        $to = post('to');
        $message = post('message');
        
        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                $apiResponse = $platform->post('/account/~/extension/~/sms', array(
                    'from' => array('phoneNumber' => '+16505691634'),
                    'to' => array(
                        array('phoneNumber' => $to),
                    ),
                    'text' => $message,
                    ));
                   print_r("Message status: " . $apiResponse->json()->messageStatus . PHP_EOL);
//                try{
//                    $apiResponse = $platform->post('/account/~/extension/~/sms', array(
//                    'from' => array('phoneNumber' => '+16505691634'),
//                    'to' => array(
//                        array('phoneNumber' => $to),
//                    ),
//                    'text' => $message,
//                    ));
//                    $this->response($apiResponse->json()->messageStatus);
//                } catch (\RingCentral\SDK\Http\ApiException $ex) {
//                    echo $ex->apiResponse->response()->error();
//                }
            } else {
                echo 'something went wrong';
            }
        }else{
            echo json_encode(array('msg'=>'Your are not Logged In to Ring Central or your Session has expired', 'status'=>false));
        }
    }
    

    public function logout() {
        $platform = $this->ringcentral->getPlatform();

        $this->session->unset_userdata('rcData');
        $this->session->set_userdata('isRCLogin', false);

        header("Location: ". base_url()."/ring_central");
        //exit();
    }

    public function engine() {
        $platform = $this->ringcentral->getPlatform();
        $RINGCENTRAL_REDIRECT_URL = base_url()."ring_central/engine?oauth2callback";

        if (isset($_REQUEST['oauth2callback'])) {
            if (!isset($_GET['code'])) {
                return;
            }
            $qs = $platform->parseAuthRedirectUrl($_SERVER['QUERY_STRING']);
            $qs["redirectUri"] = $RINGCENTRAL_REDIRECT_URL;

            $platform->login($qs);
            $this->session->set_userdata(array('rcData' => $platform->auth()->data(), 'isRCLogin' => true));
            //$this->sendSMS($platform);
            header("Location: http://localhost/projects/nsmartrac/ring_central");
        }

//        if (!isset($_SESSION['sessionAccessToken'])) {
//            //header("Location: http://localhost/projects/nsmartrac/dashboard/ringCentral");
//            //exit();
//            echo 'something is wrong in fetching session';
//        } else {
//            $platform->auth()->setData((array) $_SESSION['sessionAccessToken']);
//            if (!$platform->loggedIn()) {
//               // header("Location: http://localhost/projects/nsmartrac/dashboard/ringCentral");
//               echo 'not successfully logged in';
//                exit();
//            }
//            if (isset($_REQUEST['logout'])) {
//                unset($_SESSION['sessionAccessToken']);
//                $platform->logout();
//                header("Location: http://localhost/projects/nsmartrac/ring_central");
//                exit();
//            } elseif (isset($_REQUEST['api'])) {
//                if ($_REQUEST['api'] == "extension") {
//                    $endpoint = "/restapi/v1.0/account/~/extension";
//                    callGetRequest($endpoint, null);
//                } elseif ($_REQUEST['api'] == "extension-call-log") {
//                    $endpoint = "/restapi/v1.0/account/~/extension/~/call-log";
//                    $params = array(
//                        'fromDate' => '2018-12-01T00:00:00.000Z',
//                    );
//                    callGetRequest($endpoint, $params);
//                } elseif ($_REQUEST['api'] == "account-call-log") {
//                    $endpoint = "/restapi/v1.0/account/~/call-log";
//                    $params = array(
//                        'fromDate' => '2018-12-01T00:00:00.000Z',
//                    );
//                    callGetRequest($endpoint, $params);
//                }
//            }
//        }
    }

    function callGetRequest($endpoint, $params) {
        $platform = $this->ringcentral->getPlatform();
        try {
            $resp = $platform->get($endpoint, $params);
            echo "<p>" . $resp->text() . "</p>";
        } catch (\RingCentral\SDK\Http\ApiException $e) {
            print 'Expected HTTP Error: ' . $e->getMessage() . PHP_EOL;
        }
    }

}
