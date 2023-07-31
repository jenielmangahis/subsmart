<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountingMailer extends MY_Controller{
   
    function  __construct(){
        parent::__construct();
    }    

    private function sendEmail($emailTo, $emailCC, $emailSubject, $emailBody, $customAttachmentName, $reportFilePath) {
        
        $emailer = email__getInstance(['subject' => $emailSubject]);
        $emailer->addAddress($emailTo, $emailTo);
        $emailer->isHTML(true);
        $emailer->Body = $emailBody;
        $emailer->addCC($emailCC);
        $emailer->addBCC($emailCC);
        
        if ($reportFilePath !== '') {
            if ($customAttachmentName !== '') {
                $emailer->addAttachment(FCPATH . "assets/pdf/accounting/" . $reportFilePath, $customAttachmentName);
            } else {
                $emailer->addAttachment(FCPATH . "assets/pdf/accounting/" . $reportFilePath);
            }
        }

        $sendStatus = $emailer->Send();
        if ($sendStatus) {
            echo "true";
        } else {
            echo "false";
        }
        
    }

    public function emailReport($reportType) {
        // List of valid reports to request
        $accountingValidReports = array(
            "sales_tax_liability",
            "taxable_sales_detail",
            "taxable_sales_summary",
            "customer_contact_list",
        );
        // Conditional Statements on the array
        if (in_array($reportType, $accountingValidReports)) {
            // Sending Report to email process
            $emailTo = $this->input->post("emailTo");
            $emailCC = $this->input->post("emailCC");
            $emailSubject = $this->input->post("emailSubject");
            $emailBody = $this->input->post("emailBody");
            $reportFilePath = $this->input->post("reportFilePath");
            $customAttachmentName = $this->input->post("customAttachmentName");
            $this->sendEmail($emailTo, $emailCC, $emailSubject, $emailBody, $customAttachmentName, $reportFilePath);
        } else {
            // If $reportType was not in the $accountingValidReports then return die() method
            die("unable to send email report.");
        }

    }
}