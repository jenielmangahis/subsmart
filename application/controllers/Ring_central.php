<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ring_central extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->load->library('RingCentral');


        add_header_js(array(
            'assets/ringcentral/config.js',
            'assets/ringcentral/es6-promise.auto.js',
            'assets/ringcentral/fetch.umd.js',
            'assets/ringcentral/pubnub.4.20.1.js',
            'assets/ringcentral/ringcentral.js',
            'assets/ringcentral/rc_authentication.js'
        ));
    }

    public function index() {
        $platform = $this->ringcentral->getPlatform();
        $RINGCENTRAL_REDIRECT_URL = base_url() . "ring_central/engine?oauth2callback";

        if (!$this->session->isRCLogin):
            $this->session->set_userdata('isRCLogin', false);
        endif;
//        
        $this->page_data['RINGCENTRAL_REDIRECT_URL'] = $RINGCENTRAL_REDIRECT_URL;
        $this->page_data['platform'] = $platform;
        $this->load->view('ringcentral/default', $this->page_data);
    }

    private function response($status) {
        if ($status == "Queued"):
            echo 'SMS Sent';
        else:
            echo 'Something went wrong';
        endif;
    }

    public function getNameByPhone($num = NULL) {
        $this->load->model('Ringcentral_model', 'rc_model');
        $name = $this->rc_model->getNameByPhone($num);

        if (!empty($name)):
            return json_encode(array('firstname' => $name->first_name, 'lastname' => $name->last_name, 'hasRecord' => true));
        else:
            return json_encode(array('hasRecord' => false));
        endif;
    }

    public function fetchPersonalSMS($to) {
        $platform = $this->ringcentral->getPlatform();
        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                $queryParams = array(
                    'availability' => array('Alive'),
                    'dateFrom' => '2021-02-22',
                    'messageType' => array('SMS'),
                    'page' => 1,
                    'perPage' => 10,
                    'phoneNumber' => base64_decode($to)
                );
                $r = $platform->get("/account/~/extension/~/message-store", $queryParams);
                $jsonResponse = json_decode($r->text());
                foreach (array_reverse($jsonResponse->records) as $r):

                    $msgItem = explode('-', $r->subject);
                    if ($r->direction == "Inbound"):
                        $align = "float-left text-left";
                        $style = "background:#d1d2d3; color:black; border-radius:15px 15px 15px 0px";
                        $color = "color:black;";
                    else:
                        $align = "float-right text-right";
                        $style = "background:#237fdd; color:white; border-radius:15px 15px 0px 15px";
                        $color = "color:white;";
                    endif;
                    ?>

                    <div class="col-lg-12 mb-3 float-left">
                        <div style="<?= $style; ?>" class="alert alert-success <?= $align ?> col-md-10 mt-1 mb-1" role="alert">
                            <span style="<?= $color ?>" class="<?= $align; ?>">
                                <?= trim($msgItem[1]); ?>
                            </span>
                        </div>
                        <small class="muted timestamp col-lg-12 <?= $align ?>" datetime="<?= $r->lastModifiedTime; ?>" style="color:#868e96;"><?= date('Y-m-d G:i:s', strtotime($r->lastModifiedTime)) ?></small>
                    </div>
                    <?php
                endforeach;
            } else {
                echo 'session is expired';
            }
        }
    }

    public function fetchSMS($direction = NULL, $to = NULL) {
        $platform = $this->ringcentral->getPlatform();

        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {

                $queryParams = array(
                    'availability' => array('Alive'),
                    'dateFrom' => '2021-02-22',
                    'direction' => $direction == NULL ? array('Inbound') : "",
                    'messageType' => array('SMS'),
                    'page' => 1,
                    'perPage' => 10,
                    'phoneNumber' => $to != NULL ? $to : ""
                );

                $r = $platform->get("/account/~/extension/~/message-store", $queryParams);

                $jsonResponse = json_decode($r->text());
                
                $this->data['jsonResponse'] = $jsonResponse;
                $this->load->view('ringcentral/inboundSMS', $this->data);
            } else {
                echo 'something went wrong';
            }
        } else {
            //echo json_encode(array('msg'=>'Your are not Logged In to Ring Central or your Session has expired', 'status'=>false));
            echo 'Your are not Logged In to Ring Central or your Session has expired. <br /><br /><a class="btn btn-primary btn-small" onclick="oauth.loginPopup()" href="#">Login RingCentral Account</a>';
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
                echo json_encode(array('msg' => 'Successfully Sent', 'status' => true));
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
        } else {
            echo json_encode(array('msg' => 'Your are not Logged In to Ring Central or your Session has expired', 'status' => false));
        }
    }

    public function logout() {
        $platform = $this->ringcentral->getPlatform();

        $this->session->unset_userdata('rcData');
        $this->session->set_userdata('isRCLogin', false);

        header("Location: " . base_url() . "/ring_central");
        //exit();
    }

    public function engine() {
        $platform = $this->ringcentral->getPlatform();
        $RINGCENTRAL_REDIRECT_URL = base_url() . "ring_central/engine?oauth2callback";

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
