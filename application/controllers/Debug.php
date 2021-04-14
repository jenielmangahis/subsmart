    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');



    class Debug extends MY_Controller {



        public function __construct()

        {

            parent::__construct();
            $this->checkLogin();

            $this->load->model('IndustryType_model');
            $this->load->model('Users_model');
            $this->load->model('ServiceCategory_model');
            $this->load->model('PayScale_model');

        }

        public function generateEmployeeNumber()
        {   
            $users = $this->users_model->getAllUsers();
            foreach($users as $u){
                $employee_number = $this->users_model->generateRandomEmployeeNumber();
                $this->users_model->update($u->id, ['employee_number' => $employee_number]);
            }

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
                    $mail->addAddress('bryan.yobi@gmail.com', 'Bryann');  
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
    }



    /* End of file Users.php */

    /* Location: ./application/controllers/Users.php */