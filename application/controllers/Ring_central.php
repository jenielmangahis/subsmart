<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ring_central extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->load->library('Ringcentral');
        
         
        add_header_js(array(
            
            'assets/ringcentral/config.js',
            'assets/ringcentral/es6-promise.auto.js',
            'assets/ringcentral/fetch.umd.js',
            'assets/ringcentral/pubnub.4.20.1.js',
            'assets/ringcentral/ringcentral.js'
        ));
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
    
    public function fetchSMS($direction=NULL,$to=NULL)
    {
        $platform = $this->ringcentral->getPlatform();
         
        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                
                $queryParams = array(
                    'availability' => array('Alive'),
                    'dateFrom'  =>'2021-02-22',
                    'direction' => $direction==NULL?array('Inbound'):"",
                    'messageType' => array('SMS'),
                    'phoneNumber' => $to!=NULL?$to:""
                );
                
                $r = $platform->get("/account/~/extension/~/message-store", $queryParams);
                
                $jsonResponse = json_decode($r->text());
                //print_r($jsonResponse->records);
                $msgs = array();
                foreach ($jsonResponse->records as $r):
                    //echo $r->subject.'<br />';
                    $fromNum = $r->from->phoneNumber;
                    if(!in_array($fromNum, $msgs)):
                        ?>
                        <a href="#" class="float-left col-lg-12 no-padding mt-3" style="border-bottom: 1px solid #ccc;">
                            <img class="img-sm rounded-circle float-left" width="43" src="<?= base_url('uploads/users/default.png'); ?>" alt="profile">
                            <div class="messages float-left ml-4 col-lg-8">
                                <h6 class="no-margin" style="font-weight: bold; width: auto;"><?= $r->from->phoneNumber ?> &nbsp;&nbsp;<small class="muted" style="color:#ccc;"><?= date('Y-m-d G:i:s', strtotime($r->lastModifiedTime)) ?></small></h6>
                                <p style="color:gray;" ><?= $r->subject ?></p>
                            </div>
                            <div class="ml-auto float-right mt-3">
                                <i class="fa fa-reply" aria-hidden="true"></i>
                            </div>
                        </a>
                        <?php
                        array_push($msgs, $fromNum);
                    endif;    
                endforeach;
                    
            } else {
                echo 'something went wrong';
            }
        }else{
            //echo json_encode(array('msg'=>'Your are not Logged In to Ring Central or your Session has expired', 'status'=>false));
            echo 'Your are not Logged In to Ring Central or your Session has expired';
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
                   //print_r("Message status: " . $apiResponse->json()->messageStatus . PHP_EOL);
                   echo json_encode(array('msg'=>'Successfully Sent', 'status'=>true));
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
            //header("Location: http://localhost/projects/nsmartrac/ring_central");
        }

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
