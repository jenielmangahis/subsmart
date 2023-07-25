<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PHPMailer extends MY_Controller{
   
    function  __construct(){
        parent::__construct();
        $this->checkLogin();
    }
    
    public function emailReport() {
        $REPORT = $this->input->post('REPORT');
        if ($REPORT == "sales_tax_liability") {
            // EMAIL REPORT DETAILS
            $EMAIL_TO = $this->input->post('EMAIL_TO');
            $EMAIL_CC = $this->input->post('EMAIL_CC');
            $EMAIL_SUBJECT = $this->input->post('EMAIL_SUBJECT');
            $EMAIL_BODY = $this->input->post('EMAIL_BODY');

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

        } else { die("unable to send email report."); }
    }
}