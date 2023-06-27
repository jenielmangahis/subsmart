<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Mail extends MYF_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function send_acs_mail(){
        $this->load->model('AcsSentEmail_model');
        $this->load->model('MailSettings_model');
        $this->load->model('Business_model');

        $total_sent    = 0;
        $mail_setting  = $this->MailSettings_model->getSetting();        
        $acsSentEmails = $this->AcsSentEmail_model->getAllNotSent(10);
        if( $mail_setting && $mail_setting->is_enabled == 1 ){
            $settings_total_sent = $mail_setting->total_sent;
            foreach($acsSentEmails as $sentMail ){
                if( $total_sent < $mail_setting->daily_max_email_sent ){
                    $company = $this->Business_model->getByCompanyId($sentMail->company_id);
                    if( $company ){
                        $from = $company->business_name;
                    }else{
                        $from = 'nSmarTrac';    
                    }
                    
                    $subject  = $sentMail->subject;
                    $body     = $sentMail->message;                    
                    $to       = $sentMail->to_email;

                    $mail = email__getInstance(['subject' => $subject]);
                    $mail->FromName = $from;
                    $mail->addAddress($to, $to);
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $body;
                    if (!$mail->Send()) {
                        $data_acs_email = [
                            'is_with_error' => 1,
                            'err_message' => 'Cannot send email'
                        ];                                                
                    }else{
                        $settings_total_sent++;
                        $data_acs_email = [
                            'is_sent' => 1,
                            'date_sent' => date("Y-m-d H:i:s")
                        ];

                        $mail_setting_data   = ['total_sent' => $settings_total_sent];                        
                        $this->MailSettings_model->updateSentCount($mail_setting_data);
                    }

                    $this->AcsSentEmail_model->update($sentMail->id, $data_acs_email);

                }else{
                    break;
                }

                $total_sent++;
            }
        } 

        echo 'Total Sent : ' . $total_sent;       
    }

    public function send_mail(){
        $this->load->model('MailSettings_model');
        $this->load->model('MailSendTo_model');
        
        $mail_setting = $this->MailSettings_model->getSetting();
        $mails      = $this->MailSendTo_model->getAllToSend();
        $total_sent = $mail_setting->total_sent;

        if( $mail_setting->is_enabled == 1 ){
            if( $total_sent < $mail_setting->daily_max_email_sent ){
                foreach( $mails as $m ){
                    if( $total_sent < $mail_setting->daily_max_email_sent ){
                        $subject  = $m->email_subject;
                        $body     = $m->email_body;
                        $from     = 'nSmarTrac';

                        $mail = email__getInstance(['subject' => $subject]);
                        $mail->FromName = $from;
                        $mail->addAddress($m->email_to, $m->email_to);
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = $body;
                        if (!$mail->Send()) {
                            $update_send_to_data = [
                                'is_with_error' => 1,
                                'err_note' => 'Cannot send email'
                            ];                        
                            $this->MailSendTo_model->updateSendTo($m->id, $update_send_to_data);
                        }else{
                            $total_sent++;
                            $update_send_to_data = ['is_sent' => 1];
                            $mail_setting_data   = ['total_sent' => $total_sent];
                            $this->MailSendTo_model->updateSendTo($m->id, $update_send_to_data);
                            $this->MailSettings_model->updateSentCount($mail_setting_data);
                        }

                        /*$server   = MAIL_SERVER;
                        $port     = MAIL_PORT;
                        $username = MAIL_USERNAME;
                        $password = MAIL_PASSWORD;
                        $from     = MAIL_FROM;
                        $subject  = $m->email_subject;
                        $body     = $m->email_body;

                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->getSMTPInstance()->Timelimit = 5;
                        $mail->Host = $server;
                        $mail->SMTPDebug = 0;
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
                            //$mail->addAddress('webtestcustomer@nsmartrac.com');   
                        }

                        if( $m->email_bcc != '' ){
                            $mail->bcc($m->email_bcc);       
                        }

                        if( $m->email_bcc != '' ){
                            $mail->cc($m->email_cc);       
                        }

                        if( $m->email_attachment != '' ){
                            $mail->addAttachment($m->email_attachment);
                        }

                        try {
                            $mail->Send();
                            $total_sent++;
                            $update_send_to_data = ['is_sent' => 1];
                            $mail_setting_data   = ['total_sent' => $total_sent];
                            $this->MailSendTo_model->updateSendTo($m->id, $update_send_to_data);
                            $this->MailSettings_model->updateSentCount($mail_setting_data);
                        }catch(Exception $e) {
                            $error = 'Mailer Error: ' . $mail->ErrorInfo;
                            $update_send_to_data = [
                                'is_with_error' => 1,
                                'err_note' => $error
                            ];                        
                            $this->MailSendTo_model->updateSendTo($m->id, $update_send_to_data);
                        }*/

                        
                    }else{
                        break;
                    }           
                }
            }
        }
        
        echo "Done";
    }

    public function reset_email_counter(){
        $this->load->model('MailSettings_model');
        
        $mail_setting = $this->MailSettings_model->getSetting();
        $mail_setting_data   = ['total_sent' => 0];
        $this->MailSettings_model->updateSentCount($mail_setting_data);
    }
}

