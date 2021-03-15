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
    
    
    public function loadDialPad(){
        $this->load->view('dashboard/dialpad');
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
    
    public function initiateCallOut()
    {
        $to = post('to');
        $platform = $this->ringcentral->getPlatform();
        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                $resp = $platform->post('/account/~/extension/~/ring-out',
                    array(
                      'from' => array( 'phoneNumber' => "+16505691634" ),
                      'to' => array( 'phoneNumber' => "$to" ),
                      'playPrompt' => true
                    ));

                echo json_encode(array('status'=>$resp->json()->status->callStatus, 'id'=> $resp->json()->id));
            }
        }
    }
    
    public function checkCallStatus()
    {
        $to = post('to');
        $platform = $this->ringcentral->getPlatform();
        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                $r = $platform->get('/account/~/extension/~/ringout/'.$to);
                //$jsonResponse = json_decode();
                print_r($r);
            }
        }
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
                //print_r($jsonResponse->records);

                foreach (array_reverse($jsonResponse->records) as $r):
                    $attachments = $r->attachments;
                    $hasAttachment = false;
                    $attach_id = 0;
                    $msg_id = 0;
                    foreach ($attachments as $attach):
                        if ($attach->type == "MmsAttachment"):
                            $hasAttachment = true;
                            $attach_id = $attach->id;
                            $msg_id = $r->id;
                        endif;
                    endforeach;

                    //$image_data = $this->fetchAttachments($r->id, $attachments[1]->id);
                    //echo $r->id;
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
                        <?php if (trim($msgItem[1]) != ""): ?>
                            <div style="<?= $style; ?>" class="alert alert-success <?= $align ?> col-md-10 mt-1 mb-1" role="alert">
                                <span style="<?= $color ?>" class="<?= $align; ?>">
                                    <?= trim($msgItem[1]); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php
                        if ($hasAttachment):
                            $image_data = $this->fetchAttachments($msg_id, $attach_id);
                            ?>
                            <img class="<?= $align ?>" style="width:30%" src="data:image/png;base64,<?php echo $image_data ?>">
                            <?php
                        endif;
                        ?>
                        <small class="muted timestamp col-lg-12 <?= $align ?>" datetime="<?= $r->lastModifiedTime; ?>" style="color:#868e96;"><?= date('Y-m-d G:i:s', strtotime($r->lastModifiedTime)) ?></small>
                    </div>
                    <?php
                endforeach;
                ?>
                <div class="col-lg-12" style="position: fixed;bottom: 41px;width: 1080px;">
                    <div class="input-group">
                        <span class="input-group-prepend ">
                            <input type="file" id="inputImage" name="inputImage"  onchange="loadFile(event)" style="position:absolute; left:-1000px; display: none;">
                            <button type="button" class="btn btn-default" onclick="openFileOption()"><i class="fas fa-photo-video fa-fw"></i></button>
                            <button type="button" class="btn btn-default"><i class="fas fa-microphone fa-fw"></i></button>
                        </span>

                        <img src="" id="outputImg" style="width:100px" />
                        <input type="text" name="replyMessage" id="replyMessage" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-append">
                            <button id="btnReply" type="button" onclick="sendReply()" class="btn btn-primary">Send</button>
                        </span>
                    </div>
                </div>
                <?php
            } else {
                echo 'Something went wrong, Please Try Again';
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
                echo 'Something went wrong, Please Try Again';
            }
        } else {
            //echo json_encode(array('msg'=>'Your are not Logged In to Ring Central or your Session has expired', 'status'=>false));
            echo 'Your are not Logged In to Ring Central or your Session has expired. <br /><br /><a class="btn btn-primary btn-small" onclick="oauth.loginPopup()" href="#">Login RingCentral Account</a>';
        }
    }

    public function fetchAttachments($id = NULL, $attachment_id = NULL) {
        $platform = $this->ringcentral->getPlatform();

        if ($this->session->rcData) {
            $platform->auth()->setData((array) $this->session->rcData);
            if ($platform->loggedIn()) {
                $queryParams = array(
                        //  'contentDisposition' => 'Inline', 9138346004, 2290591004
                );
                $r = $platform->get("/account/~/extension/~/message-store/$id/content/$attachment_id", $queryParams);
                $imageData = base64_encode($r->text());
                //echo $r->text();
                return $imageData;
            }
        }
    }

    public function sendMMS() {
        $this->load->helper('file');
        $rcsdk = $this->ringcentral->getRCSDK();
        $platform = $rcsdk->platform();
        $to = post('to');
        $message = post('message');

        $file_path = 'assets/ringcentral/tmpUpload/';
        $config['upload_path'] = $file_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';


        $this->load->library('upload', $config);
        $this->upload->initialize($config);


        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = $this->upload->data();
            if ($this->session->rcData) {
                $platform->auth()->setData((array) $this->session->rcData);
                if ($platform->loggedIn()) {
                    $body = array(
                        'from' => array('phoneNumber' => '+16505691634'),
                        'to' => array(array('phoneNumber' => $to)),
                        'text' => $message
                    );

                    $request = $rcsdk->createMultipartBuilder()
                            ->setBody($body)
                            ->add(fopen($data['full_path'], 'r'))
                            ->request('/account/~/extension/~/sms');
                    $r = $platform->sendRequest($request);
                    //print_r($r->json()->messageStatus);
                    echo json_encode(array('msg' => 'Successfully Sent', 'status' => true, 'number' => base64_encode($to)));
                }
            }
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
                echo json_encode(array('msg' => 'Successfully Sent', 'status' => true, 'number' => base64_encode($to)));
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

        header("Location: " . base_url());
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
