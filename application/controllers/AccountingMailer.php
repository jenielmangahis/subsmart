<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountingMailer extends MY_Controller{
   
    function  __construct(){
        parent::__construct();
    }
    
    public function emailReport($reportType) {
        if ($reportType == "sales_tax_liability") {
            $emailTo = $this->input->post("emailTo");
            $emailCC = $this->input->post("emailCC");
            $emailSubject = $this->input->post("emailSubject");
            $emailBody = $this->input->post("emailBody");

            $emailer = email__getInstance(['subject' => $emailSubject]);
            $emailer->addAddress($EMAIL_TO, $EMAIL_TO);
            $emailer->isHTML(true);
            $emailer->Subject = $emailSubject;
            $emailer->Body = $emailBody;
            $emailer->addCC("$emailCC");
            $emailer->addBCC("$emailCC");
            $emailer->Send();

            if ($emailer) {
                echo "true";
            } else {
                echo "false";
            }

        } else { die("unable to send email report."); }
    }
}