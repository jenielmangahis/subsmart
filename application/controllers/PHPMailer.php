<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PHPMailer extends CI_Controller{
   
    function  __construct(){
        parent::__construct();
    }
    
    function index () {
        // MICROSOFT OUTLOOK EMAIL HOST SERVER
        $MAIL_HOST_SERVER = "smtp-mail.outlook.com";

        // MICROSOFT OUTLOOK EMAIL LOGIN CREDENTIALS
        $EMAIL_USERNAME = "<EMAIL>";
        $EMAIL_PASSWORD = "<PASSWORD>"

        $EMAIL_TO = $_POST['EMAIL_TO'];
        $EMAIL_CC = $_POST['EMAIL_CC'];
        $EMAIL_SUBJECT = $_POST['EMAIL_SUBJECT'];
        $EMAIL_BODY = $_POST['EMAIL_BODY'];

        /* Load PHPMailer library */
        $this->load->library('phpmailer_lib');
       
        /* PHPMailer object */
        $mail = $this->phpmailer_lib->load();
       
        /* SMTP configuration */
        $mail->isSMTP();
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPKeepAlive = true;
        $mail->Host     = $MAIL_HOST_SERVER;
        $mail->SMTPAuth = true;
        $mail->Username = $EMAIL_USERNAME;
        $mail->Password = $EMAIL_PASSWORD;
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
       
        $mail->setFrom($EMAIL_USERNAME, 'nSmartrac');
        $mail->addReplyTo($EMAIL_USERNAME, 'nSmartrac');
       
        /* Add a recipient */
        $mail->addAddress("$EMAIL_TO");
       
        /* Add cc or bcc */
        $mail->addCC("$EMAIL_CC");
        $mail->addBCC("$EMAIL_CC");
       
        /* Email subject */
        $mail->Subject = "$EMAIL_SUBJECT";
       
        /* Set email format to HTML */
        $mail->isHTML(true);
       
        /* Email body content */
        $mailContent = "$EMAIL_BODY";
        $mail->Body = $mailContent;
       
        /* Send email */
        if(!$mail->send()){
            echo "false";
        }else{
            echo "true";
        }
    }
}