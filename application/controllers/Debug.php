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

                $server = 'mail.nsmartrac.com';
                $recipient = 'bryann.revina03@gmail.com';
                $port   = 465 ;
                $username = 'webmaster@nsmartrac.com';
                $password = 'Lol123lol!@#';
                $from     = 'webmaster@ficoheroes.com';

                $mail = new PHPMailer;
                $mail->SMTPDebug = 4;                         
                //$mail->isSMTP();                                     
                //$mail->Host = $server; 
                //$mail->SMTPAuth = true;  
                     
                //$mail->Username   = $username; 
                //$mail->Password   = $password;

                //$mail->getSMTPInstance()->Timelimit = 5;
                //$mail->SMTPSecure = 'ssl';   
                //$mail->SMTPSecure = "tls";                           
                //$mail->Timeout    =   10; // set the timeout (seconds)
                //$mail->Port = $port;

                $subject = "NsmarTrac : Estimate"; 
                $msg = "<p>Hi " . $customer->first_name . ",</p>";
                $msg .= "<p>Please check the estimate for your approval.</p>";
                $msg .= "<p>Click <a href='".$url."'>Your Estimate</a> to view and approve estimate.</p><br />";
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
}



/* End of file Users.php */

/* Location: ./application/controllers/Users.php */