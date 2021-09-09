<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Mail extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
	}

    public function send_mail(){
        $this->load->model('MailSettings_model');
        $this->load->model('MailSendTo_model');
        
        $mail_setting = $this->MailSettings_model->getSetting();
        $mails      = $this->MailSendTo_model->getAllToSend();
        $total_sent = $mail_setting->total_sent;

        if( $total_sent < $mail_setting->daily_max_email_sent ){
            foreach( $mails as $m ){
                if( $total_sent < $mail_setting->daily_max_email_sent ){
                    $server   = MAIL_SERVER;
                    $port     = MAIL_PORT;
                    $username = MAIL_USERNAME;
                    $password = MAIL_PASSWORD;
                    $from     = MAIL_FROM;
                    $subject  = $m->email_subject;
                    $body     = $m->email_body;
                    $to       = $m->email_to

                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->getSMTPInstance()->Timelimit = 5;
                    $mail->Host = $server;
                    $mail->SMTPAuth = true;
                    $mail->Username = $username;
                    $mail->Password = $password;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Timeout = 10; // seconds
                    $mail->Port = $port;
                    $mail->From = $from;
                    $mail->FromName = 'nSmarTrac';
                    $mail->Subject = $subject;
                    $mail->MsgHTML($body);
                    if( $m->email_to != '' ){
                        $mail->addAddress($m->email_to);    
                    }

                    if( $m->email_bcc != '' ){
                        $mail->bcc($m->email_bcc);       
                    }

                    if( $m->email_attachment != '' ){
                        $mail->addAttachment($m->email_attachment);
                    }
                    
                    if (!$mail->Send()) {                
                        $error = 'Mailer Error: ' . $mail->ErrorInfo;
                        $update_send_to_data = [
                            'is_with_error' => 1,
                            'note' => $error
                        ];
                    }else{
                        $total_sent++;
                        $update_send_to_data = ['is_sent' => 1];
                        $mail_setting_data   = ['total_sent' => $total_sent];

                        $this->MailSettings_model->updateSentCount($mail_setting_data);
                    }

                    $this->MailSendTo_model->updateSendTo($mail->id, $update_send_to_data);
                }else{
                    break;
                }           
            }
        }
        

        echo "Done";
    }
}

