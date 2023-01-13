<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Debug extends MY_Controller {
    public function __construct()
    {

        parent::__construct();
        //$this->checkLogin();

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

        $ringcentral = smsRingCentral('8503081341', '+18509417380', 'test ringcentral');

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
        $to_number = '+8504638629';
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
        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($cid);

        $to_number = '8506195914';
        $replies = ringCentralMessageReplies($ringCentral,$to_number);

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

        $client_id = '62cd17c4e7bf0f001347726e';
        $client_secret = '1c19081bc8fb40a3716dc94aac8d28';
        $client_name = 'NsmarTrac';
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

        $client_id = '630c41bbbc22bd0014dea7b4';
        $client_secret = 'f0b47cf4bcff50491e2f34924bd30c';
        $client_name = 'NsmarTrac';
        $client_user_id = 'user_good';
        $access_token = 'access-development-5ce37cf9-1695-4dd1-932d-fa6d56cca00e';
        $account_id   = 'VepJM45qjqT6QZXbmx9AuDpgEr1ewPUn3wvB3';

        $start_date = date('Y-m-d', strtotime("-1 week"));
        $end_date   = date("Y-m-d");
        //$balance      = balanceGet($client_id, $client_secret, $access_token, $account_id);
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
}
/* End of file Debug.php */

/* Location: ./application/controllers/Debug.php */
