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
            echo $date = date("n/j/Y");
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

    }
    /* End of file Debug.php */

    /* Location: ./application/controllers/Debug.php */