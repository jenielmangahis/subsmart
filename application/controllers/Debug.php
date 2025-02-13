<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Debug extends MY_Controller {
    public function __construct()
    {

        parent::__construct();

        $this->load->model('IndustryType_model');
        $this->load->model('Users_model');
        $this->load->model('ServiceCategory_model');
        $this->load->model('PayScale_model');

    }

    public function generateEmployeeNumber()
    {   
        $this->load->helper(array('url', 'hashids_helper'));
        //echo $date = date("n/j/Y");

        $eid      = hashids_encrypt(277, '', 15);
        echo $eid;
        exit;
        $users = $this->users_model->getAllUsers();
        foreach($users as $u){
            $employee_number = $this->users_model->generateRandomEmployeeNumber();
            $this->users_model->update($u->id, ['employee_number' => $employee_number]);
        }

        exit;
    }

    public function checkProfileImage(){
        $image = (userProfileImage(logged('id'))) ? userProfileImage(logged('id')) : $url->assets;
        $filename='something';
        file_put_contents($filename,file_get_contents($image));
        $size = getimagesize($filename);
        echo "<pre>";
        var_dump($size);
        exit;
    }

    public function sendEmail()
    {
        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

                $server = 'smtp-pulse.com';
                $port   = 465 ;
                $username = 'bryann.revina03@gmail.com';
                $password = 'r3TtorotcfFbtR';
                $from     = 'bryann.revina03@gmail.com';

        $mail = new PHPMailer;
                $mail->SMTPDebug = 4;                         
                $mail->isSMTP();                                     
                $mail->Host = $server; 
                $mail->SMTPAuth = true;  
                     
                $mail->Username   = $username; 
                $mail->Password   = $password;

                //$mail->getSMTPInstance()->Timelimit = 5;
                $mail->SMTPSecure = 'ssl';   
                //$mail->SMTPSecure = "tls";                           
                //$mail->Timeout    =   10; // set the timeout (seconds)
                $mail->Port = $port;

                $mail->From = $from;
                $mail->FromName = 'NsmarTrac';
                $mail->addAddress('bryann.revina03@gmail.com', 'Bryann');  
                $mail->isHTML(true);                          
                $mail->Subject = 'Sample SMTP Sending';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

                if(!$mail->Send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }

        exit;
        }

        public function sendEmailSub()
        {
                include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

                $server    = MAIL_SERVER;
                $recipient = 'bryann.revina03@gmail.com';
                $port      = MAIL_PORT ;
                $username  = MAIL_USERNAME;
                $password  = MAIL_PASSWORD;
                $from      = MAIL_FROM;

                $mail = new PHPMailer;
                $mail->SMTPDebug = 4;                         
                $mail->isSMTP();                                     
                $mail->Host = $server; 
                $mail->SMTPAuth = true;  
                     
                $mail->Username   = $username; 
                $mail->Password   = $password;

                $mail->getSMTPInstance()->Timelimit = 5;
                $mail->SMTPSecure = 'ssl';   
                //$mail->SMTPSecure = "tls";                           
                $mail->Timeout    =   10; // set the timeout (seconds)
                $mail->Port = $port;

                $subject = "NsmarTrac : Estimate"; 
                $msg = "<p>Hi Bryann,</p>";
                $msg .= "<p>Please check the estimate for your approval.</p>";
                $msg .= "<p>Click <a href='#'>Your Estimate</a> to view and approve estimate.</p><br />";
                $msg .= "<p>Thank you <br /><br /> NsmarTrac Team</p>";

                $mail->From = $from;
                $mail->FromName = 'NsmarTrac';
                $mail->addAddress($recipient, $recipient);  
                $mail->isHTML(true);                          
                $mail->Subject = $subject;
                $mail->Body    = $msg;

                if(!$mail->Send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent test';
                }

        exit;
        }

    public function pdf_maker()
    {
        $this->load->helper('pdf_helper');
        /*
            ---- ---- ---- ----
            your code here
            ---- ---- ---- ----
        */
            
        $this->load->view('debug/pdf_sample', $data);
    }

    public function readDirFiles()
    {
        $this->load->model('Icons_model');

        $dir  = new DirectoryIterator("./uploads/icons/");
        $icon_counter = 1; 
        foreach ($dir as $fileinfo) {
            if (strpos($fileinfo->getFilename(), '.png') !== false) {
                $icon_name = preg_replace('/[0-9]+/', '', $fileinfo->getFilename());
                $icon_name = str_replace("px", "", $icon_name);
                $icon_name = str_replace("_", " ", $icon_name);
                $icon_name = str_replace(".png", " ", $icon_name);
                $icon_name = ucwords($icon_name);
                echo $icon_name . "<br/ >";
                $data = [
                    'name' => $icon_name,
                    'image' => $fileinfo->getFilename()
                ];

                $this->Icons_model->create($data);

                $icon_counter++;
            }
            //echo $fileinfo->getFilename() . "<br />";
         }
        
        echo "Total icons : " . $icon_counter;
        exit;            
    }

    public function googleColor(){
        $this->load->model('ColorSettings_model');
        $company_id = logged('company_id');
        
        $googleColor = $this->ColorSettings_model->getByCompanyIdAndColorName($company_id, 'Google');
        $bgcolor = $googleColor->color_name;
        echo "<pre>";
        print_r($googleColor);
        exit;
    }

    public function stripeOnboarding(){
        // Stripe SDK
        include APPPATH . 'libraries/stripe/init.php'; 
        \Stripe\Stripe::setApiKey("sk_test_51IcoTsKPiost1m5gz29sxuGcntYe2NsiBInRphNPMvRQiNN9FQeNmOfG72Lpky3NU5XD0gXCCNZabc2xdsjfZQcM00GzFDajwW");

        $stripe = new \Stripe\StripeClient(
          'sk_test_51IcoTsKPiost1m5gz29sxuGcntYe2NsiBInRphNPMvRQiNN9FQeNmOfG72Lpky3NU5XD0gXCCNZabc2xdsjfZQcM00GzFDajwW'
        );

        $account = \Stripe\Account::create([
          'type' => 'standard',
        ]);

        $result = $stripe->accountLinks->create([
          'account' => $account->id,
          'refresh_url' => 'https://localhost/nguyen/nsmart_v2/debug/activateStripe',
          'return_url' => 'https://localhost/nguyen/nsmart_v2/debug/activateStripe',
          'type' => 'account_onboarding',
        ]);

        echo "<pre>";
        print_r($account);
        print_r($result);
        exit;
    }

    public function activateStripe(){
        echo "<pre>";
        print_r($_POST);
        print_r($_GET);
        exit;
    }

    public function twilioSms()
    {
        include_once APPPATH . 'libraries/twilio/autoload.php'; 

        $is_sent = false;
        $msg = '';

        $to_number     = '+18506195914';
        try {
            $client = new Twilio\Rest\Client(TWILIO_SID, TWILIO_TOKEN);
            $result = $client->messages->create(
                // Where to send a text message (your cell phone?)
                $to_number,
                array(
                    //'from' => '+15005550006',
                    'from' => TWILIO_NUMBER,
                    'body' => 'This is a test sms twilio'
                )
            );

            $is_sent = true;
        }catch(Exception $e) {
          $msg = $e->getMessage();
        }

        echo $msg;
        var_dump($is_sent);
        exit;
    }

    public function twilioSmsReplies()
    {
        $this->load->helper('sms_helper');
        $this->load->model('TwilioAccounts_model');

        $cid = logged('company_id');
        $twilioAccount = $this->TwilioAccounts_model->getByCompanyId($cid);
        $twilio = twilioReadReplies($twilioAccount, '8506195914');
        echo "<pre>";
        print_r($twilio);

        exit;
    }

    public function validateTwilioAccount()
    {
        $this->load->helper('sms_helper');            
        $twilio = validateTwilioAccount('ACf262b7f581f8d1eb2a3d4ddf48f0fdb2', '6b0e320e49625b6c9ce157efa14a4931');
        echo "<pre>";
        print_r($twilio);

        exit;
    }

    public function ringCentral()
    {
        $this->load->helper('sms_helper');
        $this->load->model('RingCentralAccounts_model');

        $cid  = logged('company_id');

        $ringCentralAccount = $this->RingCentralAccounts_model->getByCompanyId($cid);
        //$ringcentral = smsRingCentral($ringCentralAccount, '+18509417380', 'test ringcentral');
        $ringcentral = smsRingCentral($ringCentralAccount, '+18509417380', 'test ringcentral');

        echo "<pre>";
        print_r($ringcentral);
        exit;
    }

    public function ringCentralLogin()
    {
        require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';

        $this->load->model('RingCentralAccounts_model');

        $cid  = logged('company_id');
        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $rcsdk    = new RingCentral\SDK\SDK('BP5ojuryTlKehE63y3jKiA', '-5KVulKCSsqPFDc4zgvUgQ0g4or5UeTEC7TVew30IVdg', 'https://platform.devtest.ringcentral.com', 'Demo', '1.0.0');
        $platform = $rcsdk->platform();
        $platform->login('+14703172053', '101', 'Ringmybell2022!');

        $queryParams = array(
            'extensionNumber' => '101',
            'phoneNumber' => '+14703172053',
            //'direction' => undefined,
            'type' => 'Voice',
            //'view' => undefined,
            //'withRecording' => undefined,
            //'recordingType' => undefined,
            //'dateFrom' => undefined,
            //'dateTo' => undefined,
            //'page' => undefined,
            //'perPage' => undefined,
            //'sessionId' => undefined
        );


        $accountId = 'BP5ojuryTlKehE63y3jKiA';
        $resp = $platform->get("/restapi/v1.0/account/~/extension/~/call-log", $queryParams);
        $jsonResponse = json_decode($resp->text());
        echo "<pre>;";
        print_r($jsonResponse);
        exit;
    }

    public function ringCentralBusinessHrs()
    {
        require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';

        // PATH PARAMETERS
        $accountId = 'BP5ojuryTlKehE63y3jKiA';
        $extensionId = '-5KVulKCSsqPFDc4zgvUgQ0g4or5UeTEC7TVew30IVdg';

        $rcsdk = new RingCentral\SDK\SDK('BP5ojuryTlKehE63y3jKiA', '-5KVulKCSsqPFDc4zgvUgQ0g4or5UeTEC7TVew30IVdg', 'https://platform.devtest.ringcentral.com');
        $platform = $rcsdk->platform();
        $platform->login('+14703172053', '101', 'Ringmybell2022!');
        $r = $platform->get("/restapi/v1.0/account/~/extension/~/business-hours");
        echo "<pre>";
        print_r($r);
        exit;
        // PROCESS RESPONSE
    }

    public function ringCentralCallOut()
    {
        require_once APPPATH . 'libraries/ringcentral-sdk/vendor/autoload.php';

        $this->load->model('RingCentralAccounts_model');

        $cid  = logged('company_id');
        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $rcsdk    = new RingCentral\SDK\SDK($ringCentral->client_id, $ringCentral->client_secret, RINGCENTRAL_DEV_URL, 'Demo', '1.0.0');
        $platform = $rcsdk->platform();
        $platform->login($ringCentral->rc_username, $ringCentral->rc_ext, $ringCentral->rc_password);

        $resp = $platform->post('/account/~/extension/~/ring-out',
            array(
              'from' => array('phoneNumber' => $ringCentral->rc_username ),
              'to' => array('phoneNumber' => '+18509417380'),
              'playPrompt' => true
            ));

        print_r ("Call placed. Call status: " . $resp->json()->status->callStatus);
    }

    public function checkRingCentralAccount()
    {
        $this->load->helper('sms_helper');

        $ringcentral = smsCheckRingCentralAccount('nUlEWd9qRE6SmXr-glhWIA2', 'LLF8Pl45Suiad2qgQ4nxkQUl31OB7tRBmXkw1U1Rv0sA', '+18504780530', 'Ringmybell2022', '101');

        echo "<pre>";
        print_r($ringcentral);
        exit;   
    }

    public function stripeRetrieveAccount(){
        // Stripe SDK
        include APPPATH . 'libraries/stripe/init.php'; 
        
        $account = 'acct_1Id8zGFoVrhiZ0yk';
        $stripe = new \Stripe\StripeClient(
          'sk_test_51IcoTsKPiost1m5gz29sxuGcntYe2NsiBInRphNPMvRQiNN9FQeNmOfG72Lpky3NU5XD0gXCCNZabc2xdsjfZQcM00GzFDajwW'
        );
        $result = $stripe->accounts->retrieve(
          $account,
          []
        );

        echo "<pre>";
        print_r($result);
        exit;
    }

    public function googleEventTime(){
        $date_time = '2021-04-13T14:30:00+08:00';
        $date = new DateTime($date_time);
        $formatted = $date->format('g:i A');
        echo $formatted;
        exit;
    }

    public function convergeApi(){
        include APPPATH . 'libraries/Converge/src/Converge.php';
        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => '2179135',
            'user_id' => 'adiAPI',
            'pin' => 'U3L0MSDPDQ254QBJSGTZSN4DQS00FBW5ELIFSR0FZQ3VGBE7PXP07RMKVL024AVR',
            'demo' => false,
        ]);
        $createSale = $converge->request('ccsale', [
            'ssl_card_number' => '40000000000100002',
            'ssl_exp_date' => '0423',
            'ssl_cvv2cvc2' => '123',
            'ssl_amount' => '10.00',
            'ssl_avs_address' => '44 Miller Road',
            'ssl_avs_zip' => '07960',
        ]);
        echo "<pre>";
        print_r($createSale);
        exit;
    }

    public function deals_invoice_pdf($id){
        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('DealsSteals_model');
        $this->load->model('Business_model');
        
        $dealsSteals = $this->DealsSteals_model->getById($id);
        $company     = $this->Business_model->getByCompanyId($dealsSteals->company_id);
        $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($dealsSteals->order_number);
        $this->page_data['dealsSteals']   = $dealsSteals;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $content = $this->load->view('promote/deals_customer_invoice_pdf_template_a', $this->page_data, TRUE);  
            
        $this->load->library('Reportpdf');

        $title = 'deals_invoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);        
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        //echo $display;
        $content = ob_get_contents();
        ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output($title, 'I');
    }

    public function qr_generator(){
        require_once APPPATH . 'libraries/qr_generator/QrCode.php';

        $qrApi = new \Qr\QrCode();
        $maxSize   = $qrApi->getQrFormatOptions();
        $optionQrFormat    = $qrApi->getQrFormatOptions();
        $optionNetworkType = $qrApi->getWifiNetworkTypeOptions();

        $target_dir = "./uploads/jobs_qr/";
    
        if(!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $directory_name = WWW_ROOT . '/upload/qr/'; 
        $qr_data  = 'https://localhost/nguyen/nsmart_v2/index.php/debug/qr_generator';
        $ecc      = 'M';                       
        $size     = 3;
        $filename = 'qr'.md5($qr_data.'|'.$ecc.'|'.$size).'.png';   
        $qrApi->setFileName($target_dir . $filename);
        $qrApi->setErrorCorrectionLevel($ecc);
        $qrApi->setMatrixPointSize($size);
        $qrApi->setQrData($qr_data);               
        $qr_data = $qrApi->generateQR();

        echo "<pre>";
        print_r($qr_data);
        exit;
    }

    public function customer_create_qr_image(){
        $this->load->model('AcsProfile_model');

        $customers = $this->AcsProfile_model->getAll(50);
        foreach( $customers as $c ){
            if( $c->qr_img == '' ){
                $this->generate_qr_image($c->prof_id);
            }
        }
    }

    public function generate_qr_image($profile_id){
        require_once APPPATH . 'libraries/qr_generator/QrCode.php';

        $this->load->model('General_model', 'general');
        
        $target_dir = "./uploads/customer_qr/";
        
        if(!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $qr_data  = base_url('/customer/preview/' . $profile_id);
        $ecc      = 'M';                       
        $size     = 3;
        $filename = 'qr'.md5($qr_data.'|'.$ecc.'|'.$size).'.png'; 

        $qrApi = new \Qr\QrCode();  
        $qrApi->setFileName($target_dir . $filename);
        $qrApi->setErrorCorrectionLevel($ecc);
        $qrApi->setMatrixPointSize($size);
        $qrApi->setQrData($qr_data);               
        $qr_data = $qrApi->generateQR();

        $profile_data = ['qr_img' => $filename];
        $this->general->update_with_key_field($profile_data, $profile_id,'acs_profile','prof_id');
    }

    public function test_debug(){
        echo date("Y-m-d", strtotime("+3 months"));
        exit;
    }

    public function createIndustryTypeTemplates(){
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');

        $modelTemplateModules = $this->IndustryTemplateModules_model->getAllByTemplateId(3);
        $industryTypes = $this->IndustryType_model->getAll();

        foreach($industryTypes as $i){
            $isTemplateExists = $this->IndustryTemplateModules_model->getAllByTemplateId($i->id);
            if( empty($isTemplateExists) )
            foreach( $modelTemplateModules as $mt ){
                $data[] = ['industry_template_id' => $i->id, 'industry_module_id' => $mt->industry_module_id];
            }                
        }

        echo "<pre>";
        print_r($data);
        exit;

    }

    public function checkCC(){
        $data_cc = [
            'card_number' => '',
            'exp_date' => '', //format 11/22
            'cvc' => '',
            'ssl_first_name' => '',
            'ssl_last_name' => '',
            'ssl_amount' => 1,
            'ssl_address' => '',
            'ssl_zip' => ''
        ];
        $result = $this->converge_verify_cc($data_cc);

        echo "<pre>";
        print_r($data_cc);
        print_r($result);
    }

    public function converge_verify_cc( $data ){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $msg = '';
        $is_success = 0;

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $createSale = $converge->request('ccverify', [
            'ssl_card_number' => $data['card_number'],
            'ssl_exp_date' => $data['exp_date'],
            'ssl_cvv2cvc2' => $data['cvc'],
            'ssl_first_name' => $data['ssl_first_name'],
            'ssl_last_name' => $data['ssl_last_name'],
            'ssl_amount' => $data['ssl_amount'],
            'ssl_avs_address' => $data['ssl_address'],
            'ssl_avs_zip' => $data['ssl_zip'],
        ]);

        if( $createSale['success'] == 1 ){
            $is_success = 1;
        }else{
            $msg = $createSale['errorMessage'];
        }
        
        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function testSendMail(){
        $subject = 'This is a sample email';
        $to   = 'webtestcustomer@nsmartrac.com';
        $body = 'This is a sample content';

        $data = [
            'to' => $to, 
            'subject' => $subject, 
            'body' => $body,
            'cc' => '',
            'bcc' => '',
            'attachment' => ''
        ];

        $isSent = sendEmail($data);
        if( $isSent['is_valid'] ){
            echo "Email sent";
        }else{
            echo $isSent['err_msg'];
        }

        exit;
    }

    public function fixCompanyLicense(){
        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');

        $clients = $this->Clients_model->getAll();
        $total_updated = 0;
        foreach($clients as $c){
            $nsmart_plan_id = $c->nsmart_plan_id;
            $plan = $this->NsmartPlan_model->getById($nsmart_plan_id);

            if( $plan ){
                $client_update = ['number_of_license' => $plan->num_license];
                $this->Clients_model->update($c->id, ['number_of_license' => $plan->num_license]);

                $total_updated++;
            }
        }

        echo "Total Updated : " . $total_updated;
    }

    public function send_invoice_email(){
        $cid = 1;
        $payment_id = 1;
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');
        $this->load->model('Clients_model');

        $company_id = $cid;        
        $payment    = $this->CompanySubscriptionPayments_model->getById($payment_id);
        $company    = $this->Business_model->getByCompanyId($payment->company_id);
        $client     = $this->Clients_model->getById($cid);

        $this->page_data['payment'] = $payment;     
        $this->page_data['client']  = $client; 
        $body    = $this->load->view('mycrm/email_template/registration_invoice', $this->page_data, true);
        $attachment = $this->create_attachment_invoice($payment_id);

        $subject = 'nSmarTrac: Registration';
        $to   = 'webtestcustomer@nsmartrac.com';

        $data = [
            'to' => 'webtestcustomer@nsmartrac.com', 
            'subject' => $subject, 
            'body' => $body,
            'cc' => '',
            'bcc' => '',
            'attachment' => $attachment
        ];

        $isSent = sendEmail($data);
        return true;
    }

    public function create_attachment_invoice(){

        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');
        $this->load->model('Clients_model');
        $payment_id = 17;
        $payment    = $this->CompanySubscriptionPayments_model->getById($payment_id);
        $company    = $this->Clients_model->getById($payment->company_id);            
        $this->page_data['payment']   = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/registration_subscription_invoice_pdf_template_a', $this->page_data, TRUE);  
        echo $content;exit;

        $this->load->library('Reportpdf');
        $title = 'subscription_invoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        //$obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetMargins(10, 5, 10, 0, true);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        //$obj_pdf->SetFont('courierI', '', 9);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $obj_pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        ob_clean();
        $obj_pdf->lastPage();
        // $obj_pdf->Output($title, 'I');
        $filename = strtolower($payment->order_number) . ".pdf";
        $file     = dirname(__DIR__, 2) . '/uploads/subscription_invoice/' . $filename;
        $obj_pdf->Output($file, 'F');
        //$obj_pdf->Output($file, 'F');
        return $file;
    }

    public function testStartupChecklistGenerator(){
        $checklist = generateClientChecklist();
        echo $checklist;exit;
    }

    public function nmi_payment_recurring_monthly()
    {
        //include APPPATH . 'libraries/nmi/examples/common.php';
        include_once APPPATH . 'libraries/nmi/src/Client.php';

        // Setup the request.
        $request = new Request();
        $request->setSoftwareName('SoftwareName');
        $request->setSoftwareVersion('SoftwareVersion');
        $request->setTerminalID('99954615');
        $request->setTransactionKey('3DNajYnBtGUSeDyX');

        // Setup the request detail.
        $request->setRequestType(RequestType_Recurring);
        $request->setSubType(SubType_RecurringSetup);

        $request->setRecurringInitialAmount('50');
        $request->setRecurringRegularAmount('300');
        $request->setRecurringRegularFrequency(Frequency_Monthly);
        $request->setRecurringRegularMaximumPayments(10);
        $request->setRecurringFinalAmount('10');

        $request->setPAN('341111597241002');
        $request->setExpiryDate('2212');

        $request->setUserReference(rand());

        //echo '<p>'.$request->toString();

        // Setup the client.
        $client = new Client();
        $client->addServerURL('https://test.cardeasexml.com/generic.cex', 45000);
        $client->setRequest($request);

        // Process the request.
        $client->processRequest();

        // Get the response.
        $response = $client->getResponse();
        echo "<pre>";
        print_r($response);
        echo '<p>'.$response->toString();
        exit;
    }

    public function nmi_payment_single_payment()
    {
        //include APPPATH . 'libraries/nmi/examples/common.php';
        include_once APPPATH . 'libraries/nmi/src/Client.php';

        // Setup the request.
        $request = new Request();
        $request->setSoftwareName(NMI_SOFTWARE_NAME);
        $request->setSoftwareVersion(NMI_SOFTWARE_VERSION);
        $request->setTerminalID(NMI_TERMINAL_ID);
        $request->setTransactionKey(NMI_TRANSACTION_KEY);

        // Setup the request detail.
        $request->setRequestType(RequestType_Auth);
        $request->setAmount(412);
        $request->setPAN('3001111111111116');
        $request->setExpiryDate('2212');

        //echo '<p>'.$request->toString();

        // Setup the client.
        $client = new Client();
        $client->addServerURL('https://test.cardeasexml.com/generic.cex', 45000);
        $client->setRequest($request);

        // Process the request.
        $client->processRequest();

        // Get the response.
        $response = $client->getResponse();
        echo "<pre>";
        print_r($response);
        //echo '<p>'.$response->toString();
        exit;
    }

    public function testSms()
    {
        //$to_number = '+8504638629';
        $to_number = '+8506195914';
        $result = $this->sendSms($to_number, 'this is a test sms');
        echo "<pre>";
        print_r($result);
        exit;
    }

    public function ringCentralReplies()
    {
        $this->load->helper('sms_helper');
        $this->load->model('RingCentralAccounts_model');

        $cid  = logged('company_id');
        $cid  = 2;
        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $to_number = '8506195914';
        //$to_number = '8503081341';
        //$to_number = '8504780530';
        $date_from = '2023-02-01';
        $replies = ringCentralMessageReplies($ringCentral,$to_number,$date_from);

        echo "<pre>";
        print_r($replies);
        exit;
    }

    public function ringCentralLastMessage()
    {
        $this->load->helper('sms_helper');
        $this->load->model('RingCentralAccounts_model');

        $cid  = logged('company_id');
        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($cid);
        $to_number   = '8506195914';            
        $lastMessage = ringCentralLastMessage($ringCentral, 4888);

        echo "<pre>";
        print_r($lastMessage);
        exit;
    }

    public function ringCentralCreateContact()
    {
        $this->load->helper('sms_helper');

        try {
           $data = [
                'firstName' => 'Charlie',
                'lastName' => 'Williams',
                'businessPhone' => '+15551234567',
                'businessAddress' => [
                    'street' => '20 Davis Dr.',
                    'city' => 'Belmont',
                    'state' => 'CA',
                    'zip' => 94002
                ]
            ];
            $contact = ringCentralCreateContact($data); 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        

        echo "<pre>";
        print_r($contact);
        exit;
    }

    public function sendSms($to_number, $message)
    {
        include_once APPPATH . 'libraries/ringcentral_lite/src/ringcentrallite.php';

        $message = replaceSmartTags($message);

        $rc = new RingCentralLite(
            RINGCENTRAL_CLIENT_ID, //Client id
            RINGCENTRAL_CLIENT_SECRET, //Client secret
            RINGCENTRAL_DEV_URL //server url
        );
         
        $res = $rc->authorize(
            RINGCENTRAL_USER, //username
            RINGCENTRAL_PASSWORD, //extension
            RINGCENTRAL_EXT
        ); //password

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

        if (isset($res['errorCode'])) {
            $msg = $res['errorCode'] . " " . $res['message'];
        } else {
            $is_sent = true;
        }

        $return = ['is_sent' => $is_sent, 'msg' => $msg];

        return $return;
    }

    public function userTimezone()
    {
        $this->load->model('Settings_model');

        $company_id = logged('company_id');
        $settings = $this->Settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);
        $a_settings = unserialize($settings[0]->value);
        date_default_timezone_set($a_settings['calendar_timezone']);            
        echo "<pre>";
        print_r($a_settings);
        echo date('Y-m-d h:i:s');
        echo date_default_timezone_get();        
        exit;
    }

    public function estimateTrackerImage()
    {
        $this->load->helper(array('hashids_helper'));

        $estimate_id = 9;
        $eid = hashids_encrypt($estimate_id, '', 15);

        $src = base_url('tracker/estimate_image_tracker?id='.$eid);
        echo "<img src='".$src."' />";
        echo $src;
        exit;
    }

    public function plaid_demo()
    {
        $this->load->helper(array('plaid_helper'));

        $client_id = '630c41bbbc22bd0014dea7b4';
        $client_secret = '8342cb37d9c5b7f1efc0385c1388cc';
        $client_name = 'nSMART LLC';
        $client_user_id = 'user_good';
        $plaidToken = linkTokenCreate($client_id, $client_secret, $client_user_id, $client_name);

        $this->session->set_userdata('plaid_token', $plaidToken['token']);

        $this->page_data['plaidToken'] = $plaidToken;        
        $this->page_data['client_name'] = $client_name;    
        $this->load->view('v2/pages/debug/plaid_demo', $this->page_data);
    }

    public function plaidAuth()
    {
        $this->load->helper(array('plaid_helper'));

        $post = $this->input->post();

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $accessToken  = exchangeToken($client_id, $client_secret, $post['token']);
        if( isset($accessToken) ){
            if( $accessToken->access_token != '' ){
                $plaidAccount = authGet($client_id, $client_secret, $accessToken->access_token, $post['account_id']); 
                echo 'account';
                echo "<pre>";                    
                print_r($plaidAccount);
            } 
        }

        exit;
    }

    public function plaidProcessorAuth()
    {
        $this->load->helper(array('plaid_helper'));

        $post = $this->input->post();

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $accessToken  = exchangeToken($client_id, $client_secret, $post['token']);
        if( isset($accessToken) ){
            if( $accessToken->access_token != '' ){
                $processorToken       = processorToken($client_id, $client_secret, $accessToken->access_token, $post['account_id']);
                $processorAuthAccount = processorAuthGet($client_id, $client_secret, $processorToken->processor_token);
                echo 'account';
                echo "<pre>";                    
                print_r($processorAuthAccount);
            } 
        }

        exit;
    }

    public function plaidIdentityGet()
    {
        $this->load->helper(array('plaid_helper'));

        $post = $this->input->post();

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $accessToken  = exchangeToken($client_id, $client_secret, $post['token']);
        if( isset($accessToken) ){
            if( $accessToken->access_token != '' ){
                $plaidIdentity = identityGet($client_id, $client_secret, $accessToken->access_token);
                echo 'account';
                echo "<pre>";                    
                print_r($plaidIdentity);
            } 
        }

        exit;
    }

    public function plaidInfoView()
    {
        $this->load->helper(array('plaid_helper'));

        $post = $this->input->post();

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $accessToken  = exchangeToken($client_id, $client_secret, $post['token']);
        $plaidIdentity = array();
        $plaidAccount  = array();
        $plaidTransactions = array();
        $plaidBalance = array();
        $plaidRecurringTransactions = array();
        $start_date = '2022-01-01';
        $end_date   = '2022-08-25';
        if( isset($accessToken) ){
            if( $accessToken->access_token != '' ){
                $plaidTransactions = transactionGet($client_id, $client_secret, $accessToken->access_token, $start_date, $end_date, $post['account_id']);
                $plaidIdentity = identityGet($client_id, $client_secret, $accessToken->access_token);
                $plaidAccount  = authGet($client_id, $client_secret, $accessToken->access_token, $post['account_id']);  
                $plaidBalance  = balanceGet($client_id, $client_secret, $accessToken->access_token, $post['account_id']);                     
                $plaidRecurringTransactions = recurringTransactionsGet($client_id, $client_secret, $accessToken->access_token, $post['account_id']);
            } 
        }

        $this->page_data['plaidIdentity'] = $plaidIdentity;
        $this->page_data['plaidAccount']  = $plaidAccount;
        $this->page_data['plaidTransactions'] = $plaidTransactions;
        $this->page_data['plaidBalance'] = $plaidBalance;
        $this->load->view('v2/pages/debug/ajax_plaid_info', $this->page_data);
    }

    public function testReplace()
    {
        $sms_message = 'business.name Workorder 123';
        $sms_message = str_replace("business.name", 'nsmart', $sms_message);
        echo $sms_message;
        exit;
    }

    public function autoSmsApi()
    {
        $post = [
            'company_id' => 1,
            'object_id' => 3,
            'module_name' => 'estimate',
            'status' => 'Draft',
            'user_id' => 81,
            'agent_id' => 81
        ];

        $url = 'https://nsmartrac.com/api/create_auto_sms_notification';
        $ch = curl_init();        
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);            
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
        
        $response = curl_exec($ch);
        $data = json_decode($response);

        echo "<pre>";
        print_r($response);
        exit;
    }

    public function plaid_process_data()
    {
        $this->load->helper(array('plaid_helper'));

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $plaidToken = linkTokenCreate($client_id, $client_secret, $client_user_id, $client_name);
        $token = $this->session->userdata('plaid_token');
        $this->page_data['token'] = $token;        
        $this->page_data['client_name'] = $client_name;    
        $this->load->view('v2/pages/debug/plaid_demo_2', $this->page_data);
    }

    public function plaid_recipient_list()
    {
        $this->load->helper(array('plaid_helper'));

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $recipients = recipientList($client_id, $client_secret);

        echo "<pre>";
        print_r($recipients);
        exit;
    }

    public function plaid_create_public_token()
    {
        $this->load->helper(array('plaid_helper'));

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $recipients = recipientList($client_id, $client_secret);

    }

    public function plaid_transfer()
    {
        $this->load->model('PlaidAccount_model');
        $this->load->helper(array('plaid_helper'));

        $cid = logged('company_id');    
        $plaidAccount = $this->PlaidAccount_model->getByCompanyId($cid);
    }

    public function portal_validate_login()
    {
        $this->load->model('UserPortalAccount_model');

        $post = [
            'portal_username' => 'admin@gmail.com',
            'portal_password' => 'secret',
        ];

        $url = 'https://portal.urpowerpro.com/api/v1/user/validate_login';
        $ch = curl_init();        
        curl_setopt($ch, CURLOPT_URL,$url);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_POST, 1);            
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
        
        $response = curl_exec($ch);
        $data     = json_decode($response);

        echo "<pre>";
        print_r($ch);
        print_r($response);
        
        exit;
    }

    public function adt_portal_db()
    {
        $this->load->model('AdtPortal_model');

        $email  = 'admin@gmail.com';
        $result = $this->AdtPortal_model->getByEmail($email);
        $hash_pw = 'secret';
        $pwCheck = password_verify($hash_pw, $result->password);
        echo $hash_pw . ' / ' .  $result->password;
        echo "<pre>";
        print_r($result);
        var_dump($pwCheck);
        exit;
    }

    public function syncAdtPortalProjects()
    {
        $this->load->helper('adt_portal_helper');
        $this->load->model('UserPortalAccount_model');

        $total_updated = 0;
        $portalUsers = $this->UserPortalAccount_model->getAll();        
        foreach( $portalUsers as $pu ){
            $projectResult = portalSyncProjectsNonAPI($pu->user_id, $pu->company_id, $pu->username, $pu->password_plain);            
            if( $projectResult['total_projects'] > 0 ){
                $updateResult  = portalUpdateIsSyncProjectsNonAPI($projectResult['project_ids']);
                $total_updated += $updateResult['total_updated'];
            }
        }

        echo 'Total Sync projects : ' . $total_updated;
        exit;
    }

    public function testConverge()
    {
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $data = [
            'company_id' => 1,
            'amount' => 200,
            'card_number' => '4000000000000002',
            'exp_month' => '04',
            'exp_year' => '2024',
            'card_cvc' => '123',
            'address' => 'test@gmail.com',
            'zip' => '4026'
        ];


        $is_success = false;
        $msg = '';
        
        $comp_id = logged('company_id');
        $convergeCred = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($comp_id);
        if ($convergeCred) {
            $exp_year = date("m/d/" . $data['exp_year']);
            $exp_date = $data['exp_month'] . date("y", strtotime($exp_year));
            $converge = new \wwwroth\Converge\Converge([
                'merchant_id' => $convergeCred->converge_merchant_id,
                'user_id' => $convergeCred->converge_merchant_user_id,
                'pin' => $convergeCred->converge_merchant_pin,
                'demo' => false,
            ]);
            $createSale = $converge->request('ccsale', [
                'ssl_card_number' => $data['card_number'],
                'ssl_exp_date' => $exp_date,
                'ssl_cvv2cvc2' => $data['card_cvc'],
                'ssl_amount' => $data['amount'],
                'ssl_avs_address' => $data['address'],
                'ssl_avs_zip' => $data['zip'],
            ]);

            if ($createSale['success'] == 1) {
                $is_success = true;
                $msg = '';
            } else {
                $is_success = false;
                $msg = $createSale['errorMessage'];
            }
        } else {
            $msg = 'Converge account not found';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo "<pre>";
        print_r($return);
        exit;
    }

    public function debugConvergeToken()
    {
        $merchantID = "2159250"; //Converge 6 or 7-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
        $merchantUserID = "nsmartapi"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
        $merchantPinCode = "UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X"; //Converge PIN (64 CHAR A/N)
        $url = "https://api.convergepay.com/hosted-payments/transaction_token"; // URL to Converge production session token server

        $firstname = 'Bryann'; //Post first name
        $lastname  = 'Revina';
        $address   = 'Santa Rosa Laguna';
        $zipcode   = '4026';
        //$amount    = $post['total_amount']; //Post Tran Amount
        $amount    = 100; //Post Tran Amount

        /*$ch = curl_init();    // initialize curl handle
        curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
        curl_setopt($ch,CURLOPT_POST, true); // set POST method
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);*/

        $ch = curl_init();    // initialize curl handle
        curl_setopt($ch, CURLOPT_URL,$url); // set POST target URL
        curl_setopt($ch,CURLOPT_POST, true); // set POST method
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set up the post fields. If you want to add custom fields, you would add them in Converge, and add the field name in the curlopt_postfields string.
        curl_setopt($ch,CURLOPT_POSTFIELDS,
          "ssl_merchant_id=$merchantID".
          "&ssl_user_id=$merchantUserID".
          "&ssl_pin=$merchantPinCode".
          "&ssl_transaction_type=ccsale".
          "&ssl_amount=$amount"
        );

        /*curl_setopt($ch,CURLOPT_POSTFIELDS,
        "ssl_merchant_id=$merchantID".
        "&ssl_user_id=$merchantUserID".
        "&ssl_pin=$merchantPinCode".
        "&ssl_transaction_type=CCSALE".
        "&ssl_first_name=$firstname".
        "&ssl_last_name=$lastname".
        "&ssl_avs_address=$address".
        "&ssl_avs_zip=$zipcode".
        "&ssl_get_token=Y".
        "&ssl_add_token=Y".
        "&ssl_amount=$amount"
        );*/

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result = curl_exec($ch); // run the curl procss
        curl_close($ch); // Close cURL


        echo "<pre>";
        print_r($result);
        exit;
    }

    public function createHashIdForExistingJobs()
    {
        $this->load->model('Jobs_model');

        $this->load->helper(array('hashids_helper'));

        $total_updated = 0;
        $jobs = $this->Jobs_model->admin_get_all_jobs();
        foreach($jobs as $job){
            $job_hash_id = hashids_encrypt($job->id, '', 15);
            $this->Jobs_model->update($job->id, ['hash_id' => $job_hash_id]);

            $total_updated++;
        }

        echo 'Total Updated ' . $total_updated;
        exit;
    }

    public function createAppointmentNumberForExistingAppointments()
    {
        $this->load->model('Appointment_model');

        $this->load->helper(array('hashids_helper'));

        $total_updated = 0;
        $appointments = $this->Appointment_model->getAll();
        foreach($appointments as $apt){
            $appointment_number = $this->Appointment_model->generateAppointmentNumber($apt->id);
            $this->Appointment_model->update($apt->id, ['appointment_number' => $appointment_number]);

            $total_updated++;
        }

        echo 'Total Updated ' . $total_updated;
        exit;
    }

    public function testGoogleCalendarHelper()
    {
        $this->load->helper('google_calendar_helper');

        $company_id = logged('company_id');
        $gCalendar  = createSyncToCalendar(1, 'appointment', $company_id);
    }

    public function testGoogleCalendarList()
    {
        include APPPATH . 'libraries/google-calendar-api.php';

        $this->load->model('GoogleAccounts_model');

        $company_id = logged('company_id');
        $googleAccount      = $this->GoogleAccounts_model->getByCompanyId($company_id);
        $google_credentials = google_credentials();

        $capi = new GoogleCalendarApi();
        $data = $capi->getToken($google_credentials['client_id'], $google_credentials['redirect_url'], $google_credentials['client_secret'], $googleAccount->google_refresh_token);

        //$calendar = $capi->getCalendarsList($data['access_token']);
        $createCalendar = $capi->createCalendar($google_credentials['api_key'], $data['access_token'], 'Nsmart Sample');

        echo "<pre>";
        print_r($data);
        //print_r($calendar);
        print_r($createCalendar);
        exit;
    }

    public function plaidGetTransactions()
    {
        $this->load->helper(array('plaid_helper'));

        $post = $this->input->post();
        
        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $access_token = 'access-development-35757939-7790-4f43-b2b7-17a501e89670';
        $account_id   = 'rwy7A4QmZrinR7Lm839pTK4j9ADYADSVmzE8K';

        $start_date = date('Y-m-d', strtotime("-1 week"));
        $end_date   = date("Y-m-d");
        //$balance      = balanceGet($client_id, $client_secret, $access_token, $account_id);
        //$plaidToken        = linkTokenCreate($client_id, $client_secret, $client_user_id, $client_name);
        $plaidTransactions = transactionGet($client_id, $client_secret, $access_token, $start_date, $end_date, $account_id, 5);
        echo "<pre>";
        print_r($plaidTransactions);
        exit;
    }

    public function rcReadAllReplies()
    {
        $this->load->helper('sms_helper');
        $this->load->model('RingCentralAccounts_model');

        $cid = logged('company_id');
        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $date_from = '2022-04-03';
        $messages  = ringCentralAllMessages($ringCentral, $date_from);

        echo "<pre>";
        print_r($messages);
        exit;
    }

    public function createDefaultGoogleCalendar()
    {
        include APPPATH . 'libraries/google-calendar-api.php';

        $this->load->model('GoogleAccounts_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $google_credentials = google_credentials();

        $googleAccount = $this->GoogleAccounts_model->getByCompanyId($company_id);
        if( $googleAccount ){
            $company = $this->Business_model->getByCompanyId($company_id);
            $calendar_name = $company->business_name . ' - CALENDAR TEST';

            echo "<pre>";
            $capi = new GoogleCalendarApi();
            $token = $capi->getToken($google_credentials['client_id'], $google_credentials['redirect_url'], $google_credentials['client_secret'], $googleAccount->google_refresh_token);
            echo $token['access_token'];
            print_r($token);            
            $colors = $capi->getColors($google_credentials['api_key'], $token['access_token']);
            print_r($colors);
            $updateCalendar = $capi->updateCalendar(8, $google_credentials['api_key'], $token['access_token'], $googleAccount->auto_sync_calendar_id);
            
            
            print_r($updateCalendar);
        }

        exit;
    }

    public function createDefaultCalendarsForExistingGoogleAccounts()
    {
        include APPPATH . 'libraries/google-calendar-api.php';

        $this->load->model('GoogleAccounts_model');
        $this->load->model('Business_model');
        $this->load->model('GoogleCalendar_model');

        $google_credentials = google_credentials();

        $googleAccount  = $this->GoogleAccounts_model->getAll();
        if( $googleAccount && $google_credentials ){
            $googleAccounts = $this->GoogleAccounts_model->getAll();
            foreach( $googleAccounts as $g ){
                if( $g->company_id > 0 ){
                    $company = $this->Business_model->getByCompanyId($g->company_id);
                    if( $company ){
                        $calendar_appointment_name = $company->business_name . ' - APPOINTMENTS';
                        $calendar_events_name = $company->business_name . ' - EVENTS';
                        $calendar_tc_off_name = $company->business_name . ' - TC OFF';

                        $capi = new GoogleCalendarApi();
                        $token = $capi->getToken($google_credentials['client_id'], $google_credentials['redirect_url'], $google_credentials['client_secret'], $g->google_refresh_token);
                        if( isset($token['access_token']) && $token['access_token'] != '' ){
                            //Appointment
                            $calendarAppointment = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_appointment_name);
                            if( isset($calendarAppointment['id']) ){
                                $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarAppointmentColorID(), $google_credentials['api_key'], $token['access_token'], $calendarAppointment['id']);
                                //Create calendar
                                $calendar_data = [
                                    'company_id' => $g->company_id,
                                    'calendar_id' => $calendarAppointment['id'],
                                    'calendar_name' => $calendar_appointment_name,
                                    'calendar_type' => $this->GoogleCalendar_model->calendarTypeAppointment(),
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $this->GoogleCalendar_model->create($calendar_data);
                            }

                            //Event
                            $calendarEvent = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_events_name);
                            if( isset($calendarEvent['id']) ){
                                $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarEventColorID(), $google_credentials['api_key'], $token['access_token'], $calendarEvent['id']);
                                //Create calendar
                                $calendar_data = [
                                    'company_id' => $g->company_id,
                                    'calendar_id' => $calendarEvent['id'],
                                    'calendar_name' => $calendar_events_name,
                                    'calendar_type' => $this->GoogleCalendar_model->calendarTypeEvent(),
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $this->GoogleCalendar_model->create($calendar_data);
                            }

                            //TC Off
                            $calendarTCOff = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_tc_off_name);
                            if( isset($calendarTCOff['id']) ){
                                $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarTCOffColorID(), $google_credentials['api_key'], $token['access_token'], $calendarTCOff['id']);
                                //Create calendar
                                $calendar_data = [
                                    'company_id' => $g->company_id,
                                    'calendar_id' => $calendarTCOff['id'],
                                    'calendar_name' => $calendar_tc_off_name,
                                    'calendar_type' => $this->GoogleCalendar_model->calendarTypeTCOff(),
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $this->GoogleCalendar_model->create($calendar_data);
                            }
                        }
                    }
                }                
            }
        }        
    }

    public function createJobsServicesCalendarsForExistingGoogleAccounts()
    {
        include APPPATH . 'libraries/google-calendar-api.php';

        $this->load->model('GoogleAccounts_model');
        $this->load->model('Business_model');
        $this->load->model('GoogleCalendar_model');

        $google_credentials = google_credentials();

        $googleAccount  = $this->GoogleAccounts_model->getAll();
        if( $googleAccount && $google_credentials ){
            $googleAccounts = $this->GoogleAccounts_model->getAll();
            foreach( $googleAccounts as $g ){
                if( $g->company_id > 0 ){
                    $company = $this->Business_model->getByCompanyId($g->company_id);
                    if( $company ){
                        $calendar_job_name = $company->business_name . ' - JOBS';
                        $calendar_services_name = $company->business_name . ' - SERVICE TICKET';

                        $capi = new GoogleCalendarApi();
                        $token = $capi->getToken($google_credentials['client_id'], $google_credentials['redirect_url'], $google_credentials['client_secret'], $g->google_refresh_token);
                        if( isset($token['access_token']) && $token['access_token'] != '' ){
                            //Jobs
                            $calendarJob = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_job_name);
                            if( isset($calendarJob['id']) ){
                                $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarJobsColorID(), $google_credentials['api_key'], $token['access_token'], $calendarJob['id']);
                                //Create calendar
                                $calendar_data = [
                                    'company_id' => $g->company_id,
                                    'calendar_id' => $calendarJob['id'],
                                    'calendar_name' => $calendar_job_name,
                                    'calendar_type' => $this->GoogleCalendar_model->calendarTypeJob(),
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $this->GoogleCalendar_model->create($calendar_data);
                            }

                            //Service Ticket
                            $calendarEvent = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_services_name);
                            if( isset($calendarEvent['id']) ){
                                $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarServiceTicketColorID(), $google_credentials['api_key'], $token['access_token'], $calendarEvent['id']);
                                //Create calendar
                                $calendar_data = [
                                    'company_id' => $g->company_id,
                                    'calendar_id' => $calendarEvent['id'],
                                    'calendar_name' => $calendar_services_name,
                                    'calendar_type' => $this->GoogleCalendar_model->calendarTypeServiceTicket(),
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $this->GoogleCalendar_model->create($calendar_data);
                            }
                        }
                    }
                }                
            }
        }        
    }

    public function createCalendarAutoSms()
    {
        $this->load->helper('google_calendar_helper');

        $company_id  = 1;
        $module_name = 'job';
        $job_id      = 261;
        /*$module_name = 'appointment';
        $job_id      = 14;*/

        $sms = createSmsNotification($job_id, $module_name, $company_id);
        echo "<pre>";
        print_r($sms);
        exit;
    }

    public function migrateAppointments()
    {
        $this->load->model('Appointment_model');
        $this->load->model('General_model');
        $this->load->model('Jobs_model');
        $this->load->model('JobTags_model');
        $this->load->model('Business_model');
        $this->load->model('Tickets_model');

        $this->load->helper(array('hashids_helper'));

        $total_services = 0;
        $total_jobs     = 0;

        $start_date   = '2023-01-13';
        $end_date     = '2023-03-25';                

        $appointments = $this->Appointment_model->getAllByDateRange($start_date, $end_date);
        foreach($appointments as $a){
            if (strpos($a->appointment_number, 'JOB') !== false) {
                $get_job_settings = array(
                    'where' => array(
                        'company_id' => $a->company_id
                    ),
                    'table' => 'job_settings',
                    'select' => '*',
                );
                $job_settings = $this->General_model->get_data_with_param($get_job_settings);
                $is_with_job_settings = 0;
                if( $job_settings ){
                    $prefix   = $job_settings[0]->job_num_prefix;
                    $next_num = str_pad($job_settings[0]->job_num_next, 5, '0', STR_PAD_LEFT);
                    $is_with_job_settings = 1;        
                }else{
                    $prefix = 'JOB-';
                    $lastId = $this->Jobs_model->getlastInsert($a->company_id);
                    if( $lastId ){
                        $next_num = $lastId->id + 1;
                        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
                    }else{
                        $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
                    }
                }

                $job_number = $prefix . $next_num;                

                $assigned_employees = json_decode($a->assigned_employee_ids);

                $employee_id  = 0;
                $employee2_id = 0;
                $employee3_id = 0;
                $employee4_id = 0;
                $employee5_id = 0;
                $employee6_id = 0;
                $start_eid = 1;
                foreach($assigned_employees as $uid){
                    if( $start_eid == 1 ){
                        $employee_id = $uid;
                    }elseif( $start_eid == 2 ){
                        $employee2_id = $uid;
                    }elseif( $start_eid == 3 ){
                        $employee3_id = $uid;
                    }elseif( $start_eid == 4 ){
                        $employee4_id = $uid;
                    }elseif( $start_eid == 5 ){
                        $employee5_id = $uid;
                    }elseif( $start_eid == 6 ){
                        $employee6_id = $uid;
                    }

                    $start_eid++;
                }

                //Tags
                $tags   = explode(",", $a->tag_ids);
                $a_tags = array();
                foreach($tags as $tag_id){
                    $jobTag = $this->JobTags_model->getById($tag_id);
                    if( $jobTag ){
                        $a_tags[] = $jobTag->name;
                    }
                }

                $jobs_data = [
                    'job_number' => $job_number,
                    'work_order_id' => 0,
                    'lead_source_id' => 0,
                    'company_id' => $a->company_id,
                    'job_location ' => $a->mail_add ? $a->mail_add : '',
                    'job_name' => $a->customer_name,
                    'customer_id' => $a->prof_id,
                    'employee_id' => $employee_id,
                    'employee2_id' => $employee2_id,
                    'employee3_id' => $employee3_id,
                    'employee4_id' => $employee4_id,
                    'employee4_id' => $employee5_id,
                    'employee4_id' => $employee6_id,
                    'job_description' => 'Jobs from Appointments',
                    'job_type' => 'Service',
                    'start_date' => date("Y-m-d", strtotime($a->appointment_date)),
                    'end_date' => date("Y-m-d", strtotime($a->appointment_date)),
                    'start_time' => date('g:i a', strtotime($a->appointment_time_from)),
                    'end_time' => date('g:i a', strtotime($a->appointment_time_to)),
                    'status' => 'Scheduled',
                    'tags' => !empty($a_tags) ? implode(",", $a_tags) : '',
                    'priority' => $a->priority
                ];
                
                //Create Job
                $jobs_id = $this->General_model->add_return_id($jobs_data, 'jobs');

                if( $jobs_id > 0 ){
                    //Create hash_id
                    $job_hash_id = hashids_encrypt($jobs_id, '', 15);
                    $this->Jobs_model->update($jobs_id, ['hash_id' => $job_hash_id]);

                    //Update job settings
                    if( $is_with_job_settings ){
                        $jobs_settings_data = array(
                            'job_num_next' => $job_settings[0]->job_num_next + 1
                        );
                        $this->General_model->update_with_key($jobs_settings_data, $job_settings[0]->id, 'job_settings');
                    }         

                    //Delete appointment
                    $this->Appointment_model->delete($a->id);

                    $total_jobs++;       

                }                

            }elseif(strpos($a->appointment_number, 'SERVICES') !== false){
                $prefix = 'SERVICE-';
                $lastInserted = $this->Tickets_model->getlastInsert($a->company_id);
                if( $lastInserted ){
                    $next = $lastInserted->ticket_no;
                    $arr = explode("-", $next);
                    $val = $arr[1];
                    $next_num = $val + 1;
                }else{
                    $next_num = 1;
                }

                $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

                $ticket_no = $prefix . $next_num;

                $assigned_employees = json_decode($a->assigned_employee_ids);
                $technicians = serialize($assigned_employees);

                //Tags
                $tags   = explode(",", $a->tag_ids);
                $a_tags = array();
                foreach($tags as $tag_id){
                    $jobTag = $this->JobTags_model->getById($tag_id);
                    if( $jobTag ){
                        $a_tags[] = $jobTag->name;
                    }
                }

                $default_msg = 'I would be happy to have an opportunity to work with you.';
                $default_terms_condition = 'YOU EXPRESSLY AUTHORIZE ADI AND ITS AFFILIATES TO RECEIVE PAYMENT FOR THE LISTED SERVICES ABOVE. BY SIGNING BELOW BUYER AGREES TO THE TERMS OF YOUR SERVICE AGREEMENT AND ACKNOWLEDGES RECEIPT OF A COPY OF THIS SERVICE AGREEMENT.';

                $taxes = $a->cost *  0.075;
                $grand_total = $a->cost + $taxes;

                $business = $this->Business_model->getByCompanyId($a->company_id);
                $service_ticket_data = [
                    'company_id' => $a->company_id,
                    'employee_id' => $a->user_id,
                    'created_by' => $a->user_id,
                    'customer_id' => $a->prof_id,
                    'business_name' => $business->business_name,
                    'service_location' => $a->mail_add ? $a->mail_add : '',
                    'service_type' => 'Services',
                    'acs_city' => $a->cust_city,
                    'acs_state' => $a->cust_state,
                    'acs_zip' => $a->cust_zip_code,
                    'service_description' => $a->customer_name,
                    'job_tag' => !empty($a_tags) ? implode(",", $a_tags) : '',
                    'ticket_no' => $ticket_no,
                    'ticket_date' => date("Y-m-d", strtotime($a->appointment_date)),
                    'scheduled_time' => date('g:i a', strtotime($a->appointment_time_from)),
                    'scheduled_time_to' => date('g:i a', strtotime($a->appointment_time_to)),
                    'technicians' => $technicians,
                    'ticket_status' => 'Scheduled',
                    'message' => $default_msg,
                    'terms_conditions' => $default_terms_condition,
                    'customer_phone' => $a->cust_phone,
                    'subtotal' => $a->cost,
                    'taxes' => $taxes,
                    'billing_date ' => 0,
                    'grandtotal' => $grand_total,
                    'payment_method' => 'Cash',
                    'payment_amount' => 0
                ];

                //Create Ticket
                $service_ticket_id = $this->Tickets_model->save_tickets($service_ticket_data);

                if( $service_ticket_id > 0 ){
                    //Create payment
                    $payment_data = array(
                        'payment_method'            => 'Cash',
                        'amount'                    => $grand_total,
                        'is_collected'              => '1',
                        'ticket_id'                  => $service_ticket_id,
                        'date_created'              => date("Y-m-d H:i:s"),
                        'date_updated'              => date("Y-m-d H:i:s")
                    );

                    $pay = $this->Tickets_model->save_payment($payment_data);

                    //Delete appointment
                    $this->Appointment_model->delete($a->id);

                    $total_services++;       
                } 
            }
        }

        echo "Total Jobs :" . $total_jobs . "<br />";
        echo "Total Services :" . $total_services . "<br />";
        exit;
    }

    public function generateHashId()
    {   
        $this->load->model('Jobs_model');

        $this->load->helper(array('url', 'hashids_helper'));
        $id  = 1232;
        $eid = hashids_encrypt($id, '', 15);
        echo $eid;
    }

    public function testJob()
    {
        $this->load->model('Jobs_model');
        $job = $this->Jobs_model->get_specific_job(312);
        echo "<pre>";
        print_r($job);
        exit;
    }

    public function fixMobile()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('General_model');

        $customers = $this->AcsProfile_model->getAll();
        $total_updated = 0;
        $total_m = 0;
        $total_h = 0;
        foreach($customers as $c){
            if (strpos($c->phone_h, 'Mobile') !== false) {
                $collection = explode('Mobile:', $c->phone_h);
                $data = array();
                if( trim($collection[1]) != '' ){
                    $phone_m = formatPhoneNumber($collection[1]);
                    $phone_h = formatPhoneNumber($collection[0]);
                    //$data['id'] = $c->prof_id;
                    if( trim($phone_m) != '' && $c->phone_m == '' ){
                        $data['phone_m'] = $phone_m;    
                        $total_m++;
                    }elseif( $c->phone_m == '' && trim($phone_h) != ''){
                        $data['phone_m'] = $phone_h;  
                        $total_m++;
                    }

                    if( trim($phone_h) != '' ){
                        $data['phone_h'] = $phone_h;    
                        $total_h++;
                    }else{
                        $data['phone_h'] = '';    
                    }
                    
                    $this->General_model->update_with_key_field($data, $c->prof_id,'acs_profile','prof_id');
                    $total_updated++;
                }
            }
        }

        echo "Total Updated : " . $total_updated . "<br />";
        echo "Total Phone M : " . $total_m . "/" . "Total Phone H : " . $total_h;

        exit;
    }

    public function fixEventsAttendees(){
        $this->load->model('Event_model');

        $events = $this->Event_model->getAllEvents();

        $total_updated = 0;
        foreach($events as $e){
            $attendees = json_encode([0 => $e->employee_id]);
            $this->Event_model->update($e->id, ['employee_id' => $attendees]);

            $total_updated++;
        }

        echo 'Total updated : ' . $total_updated;
    }

    public function smsVonage(){        
        $this->load->helper('sms_helper');

        //$sms_number = '8506195914';
        $sms_number = '9179082622';
        $sms_msg    = 'Job order: JOB-00076 has been scheduled';
        $result = smsVonage($sms_number, $sms_msg);

        echo "<pre>";
        print_r($result);
    }

    public function testJson(){
        $json_data = '{"msg":"","is_valid":1,"data":[{"id":"10","parent_company_id":"23","link_company_id":"86","link_user_id":"203","status":"Verified","hash_id":"8DKgl9avmeG1vzA","date_activated":"2023-03-06 05:21:04","created":"2023-03-10 05:47:50","user_email":"bryann.revina10@gmail.com","parent_company_name":"sample company 3","link_company_name":"test business"},{"id":"9","parent_company_id":"23","link_company_id":"87","link_user_id":"204","status":"Verified","hash_id":"3VXyMYerEdOBQn6","date_activated":"2023-03-06 05:21:04","created":"2023-03-10 05:47:29","user_email":"bryann.revinax11x@gmail.com","parent_company_name":"sample company 3","link_company_name":"test business x11"}]}';

        $data = json_decode($json_data);
        echo "<pre>";
        print_r($data);
        exit;
    }

    public function fixJobItemsCostValue(){
        $this->load->model('Jobs_model');

        $total_updated = 0;
        $jobItems = $this->Jobs_model->get_all_job_items();
        foreach($jobItems as $ji){
            if( $ji->cost == 0 && $ji->price > 0 ){
                $cost = $ji->price;
                $data = ['cost' => $cost];     
                echo $ji->job_id .'/'. $ji->items_id . "<br />";           
                $this->Jobs_model->updateJobItemByJobIdAndItemId($ji->job_id, $ji->items_id, $data);

                $total_updated++;
            }
        }

        echo 'Total Updated : ' . $total_updated;
    }

    public function estimateEmailTemplate(){
        $this->load->helper(array('url', 'hashids_helper'));
        $this->load->model('Estimate_model', 'estimate_model');

        $estimate_id  = 172;            
        $estimateData = $this->estimate_model->getEstimate($estimate_id);
        if( $estimateData ){
            $eid  = hashids_encrypt($estimateData->id, '', 15);
            $c_id = $estimateData->company_id;
            $p_id = $estimateData->customer_id;

            $customerData = $this->estimate_model->get_customerData_data($p_id);

            $items_dataOP1 = $this->estimate_model->getItemlistByIDOption1($estimate_id);
            $items_dataOP2 = $this->estimate_model->getItemlistByIDOption2($estimate_id);

            $items_dataBD1 = $this->estimate_model->getItemlistByIDBundle1($estimate_id);
            $items_dataBD2 = $this->estimate_model->getItemlistByIDBundle2($estimate_id);
            $items = $this->estimate_model->getEstimatesItems($estimate_id);

            
            $urlApprove = base_url('share_Link/approveEstimate/' . $eid);
            $urlDecline = base_url('share_Link/declineEstimate/' . $eid);

            $business = $this->business_model->getByCompanyId($c_id);
            $imageUrl = getCompanyBusinessProfileImage();

            $data = array(
                // 'workorder'             => $workorder,
                'imageUrl'                      => $urlLogo,
                'estimateID'                    => $estimateData->id,
                'urlApprove'                    => $urlApprove,
                'urlDecline'                    => $urlDecline,
                'company'                       => $business->business_name,
                'business_address'              => "$business->address, $business->city $business->postal_code",
                'phone_number'                  => $business->business_phone,
                'email_address'                 => $business->business_email,

                'acs_name'                      => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
                'acsemail'                      => $customerData->email,
                'acsaddress'                    => $customerData->mail_add,
                'phone_m'                       => $customerData->phone_m,

                'items_dataOP1'                 => $items_dataOP1,
                'items_dataOP2'                 => $items_dataOP2,
                'items_dataBD1'                 => $items_dataBD1,
                'items_dataBD2'                 => $items_dataBD2,

                'estimate_number'               => $estimateData->estimate_number,
                'job_location'                  => $estimateData->job_location,
                'job_name'                      => $estimateData->job_name,
                'estimate_date'                 => $estimateData->estimate_date,
                'expiry_date'                   => $estimateData->expiry_date,
                'purchase_order_number'         => $estimateData->purchase_order_number,
                'status'                        => $estimateData->status,
                'estimate_type'                 => $estimateData->estimate_type,
                'type'                          => $estimateData->type,
                'deposit_request'               => $estimateData->deposit_request,
                'deposit_amount'                => $estimateData->deposit_amount,
                'customer_message'              => $estimateData->customer_message,
                'terms_conditions'              => $estimateData->terms_conditions,
                'instructions'                  => $estimateData->instructions,
                'email'                         => $estimateData->email,
                'phone'                         => $estimateData->phone_number,
                'mobile'                        => $estimateData->mobile_number,
                'terms_and_conditions'          => $estimateData->terms_and_conditions,
                'terms_of_use'                  => $estimateData->terms_of_use,
                'job_description'               => $estimateData->job_description,
                'instructions'                  => $estimateData->instructions,
                'bundle1_message'               => $estimateData->bundle1_message,
                'bundle2_message'               => $estimateData->bundle2_message,

                'items'                         => $items,

                'bundle_discount'               => $estimateData->bundle_discount,
                // 'deposit_amount'                => $estimateData->deposit_amount,
                'bundle1_total'                 => $estimateData->bundle1_total,
                'bundle2_total'                 => $estimateData->bundle2_total,

                'option_message'                => $estimateData->option_message,
                'option2_message'               => $estimateData->option2_message,
                'option1_total'                 => $estimateData->option1_total,
                'option2_total'                 => $estimateData->option2_total,

                'sub_total'                     => $estimateData->sub_total,
                'sub_total2'                    => $estimateData->sub_total2,
                'tax1_total'                    => $estimateData->tax1_total,
                'tax2_total'                    => $estimateData->tax2_total,

                'grand_total'                   => $estimateData->grand_total,
                'adjustment_name'               => $estimateData->adjustment_name,
                'adjustment_value'              => $estimateData->adjustment_value,
                'markup_type'                   => $estimateData->markup_type,
                'markup_amount'                 => $estimateData->markup_amount,
                'eid'                           => $eid
                // 'source' => $source
            );

            $recipient  = 'bryann.revina03@gmail.com';               

            $mail = email__getInstance(['subject' => 'Estimate Details', 'nmsart']);
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Body = $this->load->view('estimate/send_email_acs_v2', $data, true);

            if(!$mail->Send()) {                    
                $msg = 'Mailer Error: ' . $mail->ErrorInfo;
                echo $msg;
            }else{
                $msg = '';
                $is_sent = 1;

                echo 'Sent';
            }
        }else{
            $msg = 'Cannot find estimate data';
            echo $msg;
        }
    }

    public function testNiceJob()
    {
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $REFRESH_TOKEN = '12434545';
        $CLIENT_ID = '32423423';
        $CLIENT_SECRET = '4dsaf324532';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.nicejob.com/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=refresh_token&refresh_token=$REFRESH_TOKEN&client_id=$CLIENT_ID&client_secret=$CLIENT_SECRET");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        echo "<pre>";
        print_r($result);
    }

    public function testCustomerLastId()
    {
        $this->load->model('AcsProfile_model');

        $customer = $this->AcsProfile_model->get_last_id();
        echo "<pre>";
        print_r($customer);
        exit;
    }

    public function debugCronAutoSms()
    {
        debugCreateCronAutoSmsNotification(31, 649, 'job', 'Scheduled', 0, 107, 0);
        exit;
    }

    public function qb_import_timesheet()
    {
        $this->load->library('QuickbooksApi');
        $this->load->model('CompanyApiConnector_model');

        $timesheet_data = [
            "NameOf" => "Employee",
            "EmployeeRef" => [
                "value" => "1165",
                "name" => "Tommy Nguyen"
            ],
            "StartTime" => "2023-05-15T08:00:00-08:00",
            "EndTime" => "2023-05-15T17:00:00-08:00",
            "BillableStatus" => "NotBillable",
            "Taxable" => false,
            "HourlyRate" => 15,
            "Description"=> "Timesheet"
        ];

        $companyQuickBooksPayroll = $this->CompanyApiConnector_model->getByCompanyIdAndApiName(1,'quickbooks_payroll');
        $token  = $this->quickbooksapi->refresh_token($companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id); 
        //Update company refresh token
        $data_quickbooks['qb_payroll_refresh_token'] = $token->getRefreshToken();
        $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_quickbooks);
        $result = $this->quickbooksapi->create_timesheet($timesheet_data, $token->getAccessToken(), $companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id);        
    }

    public function ajax_export_qb_timesheet()
    {
        $this->load->library('QuickbooksApi');
        $this->load->model('CompanyApiConnector_model');
        $this->load->model('QbImportEmployeeLogs_model');
        $this->load->model('Users_model');

        $company_id = logged('company_id');
        $post = $this->input->post();
        $date_from = date("Y-m-d", strtotime($post['date_from']));
        $date_to   = date("Y-m-d", strtotime($post['date_to']));  
        $attendance_logs = $this->attendance_logs($date_from, $date_to);  
        if( $attendance_logs ){
            foreach($attendance_logs as $logs){
                $importEmployeeLog = $this->QbImportEmployeeLogs_model->getByUserId($logs['user_id']);
                if( !$importEmployeeLog ){
                    $user = $this->Users_model->getUserByID($logs['user_id']);
                    if( $user ){                        
                        $companyQuickBooksPayroll = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'quickbooks_payroll'); 
                        $token = $this->quickbooksapi->refresh_token($companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id); 

                        //Update company refresh token
                        $data_quickbooks['qb_payroll_refresh_token'] = $token->getRefreshToken();
                        $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_quickbooks);

                        $user_data = [
                            "GivenName" => $user->FName,
                            "SSN" => "444-55-6666",
                            "PrimaryAddr" => [
                                "CountrySubDivisionCode" => $user->state,
                                "City" => $user->city,
                                "PostalCode" => $user->postal_code,
                            ],
                            "PrimaryPhone" => ["FreeFormNumber" =>  formatPhoneNumber($user->mobile)],
                            "FamilyName" => $user->LName
                        ];
                        $employee = $this->quickbooksapi->create_employee($user_data, $token->getAccessToken(), $companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id);
                    }                    
                }
            }
        }

        $token = $this->quickbooksapi->refresh_token($companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id);                         
        //Update company refresh token
        $data_quickbooks['qb_payroll_refresh_token'] = $token->getRefreshToken();
        $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_quickbooks);

        
        exit;
    }

    public function mailChimpList()
    {
        $this->load->library('MailChimpApi');

        $api_key   = 'fce81532f5350b3ac4152d3880e80652-us21';
        $server_prefix = 'us21';

        $mailChimp = new MailChimpApi;
        $response  = $mailChimp->getList($api_key, $server_prefix);

        echo "<pre>";
        print_r($response);
        exit;

    }

    public function mailChimpAddToList()
    {
        $this->load->library('MailChimpApi');

        $api_key   = 'fce81532f5350b3ac4152d3880e80652-us21';
        $server_prefix = 'us21';

        $list_id = 'b9ca0b851f';
        $member_info = [
            "email_address" => "bryan.yobi@gmail.com",
            "status" => "pending",
        ];
        $mailChimp = new MailChimpApi;
        $response  = $mailChimp->addMemberToList($list_id, $member_info, $api_key, $server_prefix);

        echo "<pre>";
        print_r($response);
        exit;
    }

    public function mailChimpOath2()
    {
        $this->load->library('MailChimpApi');

        $client_id = '567134062530';
        $client_secret = 'ded9c4026750c337c60af890acfb6f21f667f691a2c9a43df8';
        $oauth_callback = "http://127.0.0.1:8080";
        header('Location: https://login.mailchimp.com/oauth2/authorize?'.http_build_query([
            'response_type' => 'code',
            'client_id' => $client_id,
            'redirect_uri' => $oauth_callback,
        ]));
    }

    public function emailReport() {
        // EMAIL REPORT DETAILS
        $EMAIL_TO = 'bryann.revina03@gmail.com';
        $EMAIL_CC = 'bryann.revina03@gmail.com';
        $EMAIL_SUBJECT = 'Test Email';
        $EMAIL_BODY = 'This is a sample email';

        $EMAILER = email__getInstance(['subject' => $EMAIL_SUBJECT]);
        $EMAILER->addAddress($EMAIL_TO, $EMAIL_TO);
        $EMAILER->isHTML(true);
        $EMAILER->Subject = $EMAIL_SUBJECT;
        $EMAILER->Body = $EMAIL_BODY;
        $EMAILER->addCC("$EMAIL_CC");
        $EMAILER->addBCC("$EMAIL_CC");
        $EMAILER->Send();

        if ($EMAILER) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function activeCampaignContactList()
    {
        $this->load->library('ActiveCampaignApi');

        $activeCampaign = new ActiveCampaignApi;

        $account_url   = 'https://bryannrevina0399863.api-us1.com';
        $account_token = '986448e19af205c0c30df683f1a815f18b6a4b730df4c3e2cc0cfcca7c7db59f423fc239';

        $contacts = $activeCampaign->getContacts($account_url, $account_token);
        echo "<pre>";
        print_r($contacts);
    }

    public function getActiveCampaignList()
    {
        $this->load->library('ActiveCampaignApi');

        $activeCampaign = new ActiveCampaignApi;

        $account_url   = 'https://bryannrevina0399863.api-us1.com';
        $account_token = '986448e19af205c0c30df683f1a815f18b6a4b730df4c3e2cc0cfcca7c7db59f423fc239';

        $lists = $activeCampaign->getLists($account_url, $account_token);
        echo "<pre>";
        print_r($lists);
    }

    public function getActiveCampaignAutomation()
    {
        $this->load->library('ActiveCampaignApi');

        $activeCampaign = new ActiveCampaignApi;

        $account_url   = 'https://bryannrevina0399863.api-us1.com';
        $account_token = '986448e19af205c0c30df683f1a815f18b6a4b730df4c3e2cc0cfcca7c7db59f423fc239';

        $automations = $activeCampaign->getAutomations($account_url, $account_token);
        echo "<pre>";
        print_r($automations);
    }

    public function activeCampaignCreateContact()
    {
        $this->load->library('ActiveCampaignApi');

        $activeCampaign = new ActiveCampaignApi;

        $account_url   = 'https://bryannrevina0399863.api-us1.com';
        $account_token = '986448e19af205c0c30df683f1a815f18b6a4b730df4c3e2cc0cfcca7c7db59f423fc239';
        $contact       = [
            'contact' => [
                'email' => 'bdr04@gmail.com',
                'firstName' => 'Bryann JR',
                'lastName' => 'Revina',
                'phone' => '1231231241'
            ]            
        ];

        $contact = $activeCampaign->createContact($account_url, $account_token, $contact);
        echo "<pre>";
        print_r($contact);
    }

    public function activeCampaignListContact()
    {
        $this->load->library('ActiveCampaignApi');

        $activeCampaign = new ActiveCampaignApi;

        $account_url   = 'https://bryannrevina0399863.api-us1.com';
        $account_token = '986448e19af205c0c30df683f1a815f18b6a4b730df4c3e2cc0cfcca7c7db59f423fc239';
        $contact       = [
            'contactList' => [
                'list' => 'bdr04@gmail.com',
                'contact' => 'Bryann JR',
                'status' => 1                
            ]            
        ];

        $contact = $activeCampaign->addContactToList($account_url, $account_token, $contact);
        echo "<pre>";
        print_r($contact);
    }

    public function activeCampaignGetContact()
    {
        $this->load->library('ActiveCampaignApi');

        $activeCampaign = new ActiveCampaignApi;
        $query = [
            'email' => 'bryann.revina03@gmail.com'
        ];
        $account_url   = 'https://bryannrevina0399863.api-us1.com';
        $account_token = '986448e19af205c0c30df683f1a815f18b6a4b730df4c3e2cc0cfcca7c7db59f423fc239';

        $contacts = $activeCampaign->getContact($query, $account_url, $account_token);
        echo "<pre>";
        print_r($contacts);
    }

    public function createCommission()
    {
        $this->load->helper('user_helper');
        
        $obj_id   = 828;
        $obj_type = 'job';
        createEmployeeCommission($obj_id, $obj_type);
    }

    public function testSquareOauth()
    {
        $this->load->view('v2/pages/debug/square_oauth', $this->page_data);
    }

    public function squareTokenStatus()
    {
        $this->load->helper('square_helper');

        $token = 'EAAAEOsPygSaRwy27WWC3NEg0cstB9LXLw11cA4uFNb38YCW4XBIxtOzug2s_lZf';
        $status = accessTokenStatus($token);
        echo "<pre>";
        print_r($status);

    }

    public function debugApi(){
        $token = 'EAAAEOsPygSaRwy27WWC3NEg0cstB9LXLw11cA4uFNb38YCW4XBIxtOzug2s_lZf';
        $status = accessTokenStatus($token);       
        
    }
    
    public function customerQuery()
    {
        $company_id = 31;
        // build query
        $query = "select acs_profile.*, concat(acs_profile.first_name, ' ', acs_profile.last_name) as contact_name, concat(acs_profile.mail_add, ', ', acs_profile.city, ', ', acs_profile.state, ' ', acs_profile.zip_code) as contact_address, concat('https://nsmartrac.com/uploads/customer_qr/', acs_profile.qr_img) as qr_img, ";
        $query .= "acs_billing.mmr, acs_alarm.system_type, acs_office.entered_by, acs_office.lead_source, acs_profile.city, acs_profile.state, users.LName as tech_last_name, users.FName as tech_first_name from acs_profile ";
        $query .= "left join users on users.id = acs_profile.fk_user_id ";
        $query .= "left join acs_billing on acs_billing.fk_prof_id = acs_profile.prof_id ";
        $query .= "left join acs_alarm on acs_alarm.fk_prof_id = acs_profile.prof_id ";
        $query .= "left join acs_office on acs_office.fk_prof_id = acs_profile.prof_id ";
        $query .= "left join acs_office as ao on ao.fk_prof_id = users.id ";
        $query .= "where acs_profile.company_id = $company_id ";

        // check $monitoring_id
        //$monitoring_id = 1;
        if (!empty($monitoring_id)) {
            $query .= "and acs_alarm.monitor_id like '%$monitoring_id%' ";
        }
        // check $first_name
        //$first_name = 'bryann';
        if (!empty($first_name)) {
            $query .= "and acs_profile.first_name like '%$first_name%' ";
        }
        // check $last_name
        $last_name = 'jane';
        if (!empty($last_name)) {
            $query .= "and acs_profile.last_name like '%$last_name%' ";
        }
        // check $email
        //$email = 'bryann.revina03@gmail.com';
        if (!empty($email)) {
            $query .= "and acs_profile.email like '%$email%' ";
        }
        // check $phone
        //$phone = '23234234';
        if (!empty($phone)) {
            $query .= "and acs_profile.phone_h like '%$phone%' ";
        }
        // check $sales_date
        //$sales_date = '9/20/2020';
        if (!empty($sales_date)) {
            $query .= "and acs_office.sales_date like '%$sales_date%' ";
        }
        // check $monitoring_company
        //$monitoring_company = 'Stanley';
        if (!empty($monitoring_company)) {
            $query .= "and acs_alarm.monitor_comp like '%$monitoring_company%' ";
        }
        // check $panel_type
        //$panel_type = 'AlarmNet';
        if (!empty($panel_type)) {
            $query .= "and acs_alarm.panel_type like '%$panel_type%' ";
        }
        // check $account_type
        //$account_type = 'In-House';
        if (!empty($account_type)) {
            $query .= "and acs_alarm.acct_type like '%$account_type%' ";
        }
        // check $status
        //$status = 'New';
        if (!empty($status)) {
            $query .= "and acs_profile.status like '%$status%' ";
        }
        // check $address
        if (!empty($address)) {
            $query .= "and acs_profile.mail_add like '%$address%' ";
        }
        // check $city
        if (!empty($city)) {
            $query .= "and acs_profile.city like '%$city%' ";
        }
        // check $state
        if (!empty($state)) {
            $query .= "and acs_profile.state like '%$state%' ";
        }
        // check $postal
        if (!empty($postal)) {
            $query .= "and acs_profile.zip_code like '%$postal%' ";
        }
        // check $routing_number
        //$routing_number = '12345';
        if (!empty($routing_number)) {
            $query .= "and acs_billing.routing_num like '%$routing_number%' ";
        }
        // check $company_name
        //$monitoring_company = 'Stanley';
        if (!empty($company_name)) {
            $query .= "and acs_alarm.monitor_comp like '%$company_name%' ";
        }
        // check $credit_score
        if (!empty($credit_score)) {
            $query .= "and acs_office.credit_score like '%$credit_score%' ";
        }
        // check $contract_term
        if (!empty($contract_term)) {
            $query .= "and acs_billing.contract_term like '%$contract_term%' ";
        }

        echo $query;
    }

    public function generateEsignPreview()
    {
        $documentId = '1269';
        $this->db->where('docfile_id', $documentId);
        $this->db->order_by('id', 'asc');
        $allRecipients = $this->db->get('user_docfile_recipients')->result_array();
        $esign_password = 'Riwb5moQi%S@$c8ZM3dq'; //Refer to DocuSign private $password = 'Riwb5moQi%S@$c8ZM3dq';
        foreach($allRecipients as $r){
            $hash = encrypt($message, $esign_password);
            $url = base_url('eSign/signing?hash='.$hash);
            echo $url;exit;
        }
    }

    public function getPublicIP()
    {
        $this->load->helper(array('hashids_helper'));

        $this->load->model('Users_model');
        $user = $this->Users_model->getUser(81);

        $ip = getUserPublicIP();
        $encrypted_user_id = hashids_encrypt($user->id, '', 15);
        $this->page_data['user'] = $user;
        $this->page_data['encrypted_user_id'] = $encrypted_user_id;
        $this->page_data['ip_data'] = $ip;
        $body = $this->load->view('v2/pages/users/email_unrecognize_login', $this->page_data, true);

        $mail = email__getInstance();
        $mail->FromName = 'nSmarTrac';
        $recipient_name = $user->FName . ' ' . $user->LName;
        $mail->addAddress($user->email, $recipient_name);
        $mail->isHTML(true);
        $mail->Subject = "nSmartrac: Unrecognize Login";
        $mail->Body = $body;
        
        if ($mail->Send()) {
            echo 'Email Sent';                   
        }else{
            echo 'Cannot send email';
        }
    }
    
    public function fixCustomerRecords()
    {
        $this->load->model('AcsProfile_model');

        $total_updated = 0;

        $limit = 2000;
        $customers = $this->AcsProfile_model->getAllNotChecked($limit);
        if( $customers ){            
            foreach($customers as $c){
                $to_check = 0;  
                
                $default_customer_type = $c->customer_type;
                if( $c->customer_type == '' ){
                    $to_check = 1;
                    $default_customer_type = 'Residential';
                }
                
                $phone_m = str_replace(" ","",trim($c->phone_m));
                $default_phone_m = 'NA';
                if( trim($phone_m) == '' ){
                    $to_check = 1;
                    $phone_h = str_replace(" ","",trim($c->phone_h));
                    if( $phone_h != '' ){
                        $default_phone_m = $phone_h;
                    }
                }else{
                    $default_phone_m = $c->phone_m;
                }

                $phone_h = str_replace(" ","",trim($c->phone_h));
                $default_phone_h = 'NA';
                if( trim($phone_h) == '' ){
                    $to_check = 1;
                    $phone_m = str_replace(" ","",trim($c->phone_m));
                    if( $phone_m != '' ){
                        $default_phone_h = $phone_m;
                    }
                }else{
                    $default_phone_h = $c->phone_h;
                }

                $default_mail_add = 'NA';
                if( trim($c->mail_add) == '' ){
                    $to_check = 1;
                    if( $c->cross_street != '' ){
                        $default_mail_add = $c->cross_street;
                    }
                }else{
                    $default_mail_add = $c->mail_add;
                }

                if( $to_check == 1 ){
                    //Do update
                    $data = [
                        'customer_type' => $default_customer_type,
                        'phone_m' => $default_phone_m,
                        'phone_h' => $default_phone_h,
                        'mail_add' => $default_mail_add,
                        'is_checked' => 1
                    ];
                    $this->AcsProfile_model->updateCustomerByProfId($c->prof_id, $data);
                    
                    $total_updated++;
                }
                
            }
        }

        echo 'Total updated :' .$total_updated;        
    }

    public function fixAcsBillingDateValues()
    {
        $this->load->model('AcsProfile_model');
        
        $total_updated = 0;

        $conditions[] = ['field' => 'is_updated', 'value' => 0];
        $acsBilling = $this->AcsProfile_model->getAllBilling($conditions, 800);
        foreach($acsBilling as $bill){
            $bill_start_date = '1970-01-01';
            if( $bill->bill_start_date != '0000-00-00' ){
                $bill_start_date = date("Y-m-d", strtotime($bill->bill_start_date));
            }

            $bill_end_date = '1970-01-01';
            if( $bill->bill_end_date != '0000-00-00' ){
                $bill_end_date = date("Y-m-d", strtotime($bill->bill_end_date));
            }

            $data = [
                'bill_start_date' => $bill_start_date,
                'bill_end_date' => $bill_end_date,
                'is_updated' => 1
            ];
            $this->AcsProfile_model->updateBillingByBillId($bill->bill_id, $data);

            $total_updated++;
        }

        echo 'Total Updated :' . $total_updated;
    }

    public function geoApiGetLocation()
    {
        $url = 'https://api.geoapify.com/v1/geocode/reverse?lat=14.2901248&lon=121.1072512&lang=fr&apiKey=41ddeb87ff654af488b283ba54ba576f';
        $data = json_decode(file_get_contents($url), true);
        // echo "<pre>";
        // print_r($data);        
        $address  = $data['features'][0]['properties']['formatted'];
        $district = $data['features'][0]['properties']['district'];
        echo $address . ' ' . $district;
    }

    public function fixInvoicesData()
    {
        $this->load->model('Invoice_model');
        
        $total_updated = 0;
        $invoices = $this->Invoice_model->getAllInvoices();
        foreach($invoices as $invoice){
            $due_date = '1970-01-01';
            if( $invoice->due_date != '' ){
                $due_date = date("Y-m-d", strtotime($invoice->due_date));
            }

            $date_issued = '1970-01-01';
            if( $invoice->date_issued != '' ){
                $date_issued = date("Y-m-d", strtotime($invoice->date_issued));
            }

            $data = [
                'due_date' => $due_date,
                'date_issued' => $date_issued
            ];
            $this->Invoice_model->update($invoice->id, $data);

            $total_updated++;
        }

        echo 'Total Updated :' . $total_updated;
    }

    public function fixAccountingExpensesData()
    {
        $this->load->model('Accounting_expense');
        
        $total_updated = 0;
        $limit = 500;
        $expenses = $this->Accounting_expense->getAll($limit);
        foreach($expenses as $exp){
            $payment_date = '1970-01-01';
            if(strtotime($exp->payment_date)){
                $payment_date = date("Y-m-d", strtotime($exp->payment_date));
            }

            $created_at = $exp->created_at;
            if( $created_at == '0000-00-00 00:00:00' ){
                $created_at = NULL;
            }            

            $data = ['payment_date' => $payment_date, 'is_updated' => 1, 'created_at' => $created_at];

            $this->Accounting_expense->update($exp->id, $data);

            $total_updated++;
        }

        echo 'Total Updated :' . $total_updated;
    }

    public function plaidDeposits()
    {
        $this->load->helper(array('plaid_helper'));
        
        $this->load->model('PlaidAccount_model');
        $this->load->model('PlaidBankAccount_model');
        $this->load->model('PlaidErrorLogs_model');

        $is_valid = 1;
        $cid = logged('company_id');
        $uid = logged('id');

        $plaidAccounts = $this->PlaidBankAccount_model->getAllByCompanyId($cid);        
        $plaidAccount  = $this->PlaidAccount_model->getDefaultCredentials();

        if( $plaidAccount ){
            foreach($plaidAccounts as $pc){            
                try{
                    $balance = balanceGet($plaidAccount->client_id, $plaidAccount->client_secret, $pc->access_token, $pc->account_id);
                    echo "<pre";
                    print_r($balance);
                    exit;
                    
                }catch(Exception $e){
                    $is_valid = 0;
                    $err_data = [
                        'user_id' => $uid,
                        'log_date' => date("Y-m-d H:i:s"),
                        'log_msg' => $e->getMessage()
                    ];
                }         
            }
        }else{
            $err_data = [
                'user_id' => $uid,
                'log_date' => date("Y-m-d H:i:s"),
                'log_msg' => 'Token Error'
            ];
        }

        echo "<pre>";
        print_r($err_data);        
    }

    public function testPhpVersion(){
        phpinfo();
        exit;
    }

    public function fixCustomerDateOfBirth()
    {
        $this->load->model('AcsProfile_model');

        $total_updated = 0;        
        $limit = 500;
        $customers = $this->AcsProfile_model->getAllNotChecked($limit);
        
        if( $customers ){            
            foreach($customers as $c){
                if( strtotime($c->date_of_birth) > 0 ){
                    $date_of_birth = date("Y-m-d", strtotime($c->date_of_birth));
                }else{
                    $date_of_birth = NULL;
                }

                $data = [
                    'date_of_birth' => $date_of_birth,
                    'is_checked' => 1
                ];
                $this->AcsProfile_model->updateCustomerByProfId($c->prof_id, $data);
                
                $total_updated++;
            }
        }

        echo 'Total Updated : ' . $total_updated;
    }

    public function createAdiFinancingCategoriesData()
    {
        $this->load->model('FinancingPaymentCategory_model');
        
        $data = [
            'E' => 'Equipment',
            'MMR' => 'MMR',
            'RMR' => 'RMR',
            'MS' => 'Monthly Subscription',
            'AF' => 'Activation Fee',
            'FM' => 'First Month',
            'AFM' => 'Activation + First Month',
            'D' => 'Deposit',
            'O' => 'Other'
        ];

        $company_id = 1;

        $total = 0;
        foreach( $data as $key => $value ){
            $isExists = $this->FinancingPaymentCategory_model->getByNameAndCompanyId($value, $company_id);
            if( !$isExists ){
                $data = [
                    'company_id' => $company_id,
                    'name' => $value,
                    'value' => $key,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                $this->FinancingPaymentCategory_model->create($data);
                $total++;
            }
        }

        echo 'Total Created : ' . $total;
    }

    public function createAdiAccountingTerms()
    {
        $this->load->model('AccountingTerm_model');
        
        $data = [
            '0' => 'Due on Receipt',
            '5' => 'Net 5',
            '10' => 'Net 10',
            '14' => 'Net 14',
            '15' => 'Net 15',
            '21' => 'Net 21',
            '30' => 'Net 30',
        ];

        $company_id = 31;

        $total = 0;
        foreach( $data as $key => $value ){
            $isExists = $this->AccountingTerm_model->getByNameAndCompanyId($value, $company_id);
            if( !$isExists ){
                $data = [
                    'company_id' => $company_id,
                    'qbid' => NULL,
                    'name' => $value,
                    'type' => 1,
                    'net_due_days' => $key,
                    'day_of_month_due' => 0,
                    'discount_percentage' => 0,
                    'discount_days' => 0,
                    'discount_on_day_of_month' => 0,
                    'minimum_days_to_pay' => $key,
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                $this->AccountingTerm_model->create($data);
                $total++;
            }
        }

        echo 'Total Created : ' . $total;
    }

    public function fixAcsBillingNextBillingDate()
    {
        $this->load->model('AcsBilling_model');

        $total_updated = 0;
        $limit = 1000;
        $billing = $this->AcsBilling_model->getAllNotChecked($limit);
        foreach( $billing as $b ){
            $next_subscription_billing_date = NULL;            
            if( $b->next_subscription_billing_date != '' ){
                $next_subscription_billing_date = date("Y-m-d",strtotime($b->next_subscription_billing_date));
            }

            $next_billing_date = NULL;            
            if( $b->next_billing_date != '' ){
                $next_billing_date = date("Y-m-d",strtotime($b->next_billing_date));
            }

            $data = [
                'is_checked' => 1,
                'next_billing_date' => $next_billing_date,
                'next_subscription_billing_date' => $next_subscription_billing_date
            ];

            $this->AcsBilling_model->updateRecord($b->bill_id, $data);

            $total_updated++;

        } 

        echo 'Total updated : ' . $total_updated;
    }

    public function testValidateIndustrySpecificFields()
    {
        if(checkIndustryAllowedSpecificField('installation_cost')){
            echo 'Allowed';
        }else{
            echo 'Not Allowed';
        }
    }

    public function ringcentralSmsV2()
    {
        $this->load->helper('sms_helper');
        $this->load->model('RingCentralAccounts_model');

        $cid  = logged('company_id');
        $ringCentralAccount = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $to  = '8506199845';
        $sms_message = 'This is a test sms';
        $sms = smsRingCentral($ringCentralAccount, $to, $sms_message);
    }

    public function testBatchInsert()
    {
        $this->load->model('CustomerStatus_model');

        $comp_id = logged('company_id');
        //Create default customer status
		$data[] = [
			'company_id' => $comp_id,
			'name' => 'Active',
			'date_created' => date("Y-m-d H:i:d")
		];
		$data[] = [
			'company_id' => $comp_id,
			'name' => 'Inactive',
			'date_created' => date("Y-m-d H:i:d")
		];
		$data[] = [
			'company_id' => $comp_id,
			'name' => 'Collection',
			'date_created' => date("Y-m-d H:i:d")
		];

		$this->CustomerStatus_model->batchInsert($data);
    }

    public function alarmApi()
    {
        $this->load->helper(array('alarm_api_helper'));

        $alarmApi = new AlarmApi();
        $token    = $alarmApi->generateToken();
        //$data = $alarmApi->getCustomers($token['token']);
        //$customer_id = '4231200';
        //$data  = $alarmApi->getCustomerEquipmentList($customer_id, $token['token']);
        //$data    = $alarmApi->getReps($token['token']);
        $dealer_id = 13537;
        $data    = $alarmApi->getDealerInformation($dealer_id, $token['token']);
        echo "<pre>";
        print_r($data);
        
    }
}
/* End of file Debug.php */

/* Location: ./application/controllers/Debug.php */
