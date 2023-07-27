<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountingMailer extends MY_Controller{
   
    function  __construct(){
        parent::__construct();
    }    

    private function sendEmail($emailTo, $emailCC, $emailSubject, $emailBody) {
        
        $emailer = email__getInstance(['subject' => $emailSubject]);
        $emailer->addAddress($emailTo, $emailTo);
        $emailer->isHTML(true);
        $emailer->Body = $emailBody;
        $emailer->addCC("$emailCC");
        $emailer->addBCC("$emailCC");
        $emailer->Send();
        if ($emailer) {
            echo "true";
        } else {
            echo "false";
        }
        
    }

    public function emailReport($reportType) {

        $accountingValidReports = [
            "sales_tax_liability",
            "taxable_sales_detail",
            "taxable_sales_summary",
        ];

        if (in_array($reportType, $accountingValidReports)) {
            $emailTo = $this->input->post("emailTo");
            $emailCC = $this->input->post("emailCC");
            $emailSubject = $this->input->post("emailSubject");
            $emailBody = $this->input->post("emailBody");
            $this->sendEmail($emailTo, $emailCC, $emailSubject, $emailBody);
        } else {
            die("unable to send email report.");
        }

    }
}