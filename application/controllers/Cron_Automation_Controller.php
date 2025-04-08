<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_Automation_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Automation_model', 'automation_model');
        $this->load->model('Automation_queue_model', 'automation_queue_model');

        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('AcsProfile_model', 'AcsProfile_model');   

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
    }

    public function cronCreatedInvoiceMailAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;

        $is_live_mail_credentials = false;

        /**
         * Send email automation for creating new invoice - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_email',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'created',
            'trigger_time' => 0,
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  
        if($automationsData) {

            foreach($automationsData as $automationData) {

                $automation_id = $automationData->id;
                $filters['automation_id'] = $automation_id;
                $filters['is_triggered']  = 0;
                $filters['status']        = 'new';                
                $automation_queues = $this->automation_queue_model->getActiveAutomationQueue($filters);  

                if($automation_queues) {
                    foreach($automation_queues as $automation_queue) {
                        $queue_entity_id = $automation_queue->entity_id;
                        $invoice = $this->invoice_model->getinvoice($queue_entity_id); 
                        
                        $targetName    = "";
                        $customerEmail = "";

                        if($automationData->target == 'user') {
                            $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);
                            if($targetUser) {
                                $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                $customerEmail = $targetUser->email;
                            }
                        }elseif($automationData->target == 'client') {
                            if($invoice && $invoice->customer_id) {
                                $targetUser = $this->AcsProfile_model->getByProfId($invoice->customer_id);    
                                if($targetUser) {
                                    $targetName    = $targetUser->first_name . ' ' . $targetUser->last_name;
                                    $customerEmail = $targetUser->email;
                                } 
                            }
                        }elseif($automationData->target == 'sales_rep') {
                            if($invoice && $invoice->user_id) {
                                $targetUser = $this->users_model->getCompanyUserById($invoice->user_id);
                                if($targetUser) {
                                    $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                    $customerEmail = $targetUser->email;
                                }                                   
                            }
                        }
                        
                        if($targetName != "" && $customerEmail != "") {

                            if($is_live_mail_credentials) {
                                
                                $mail = email__getInstance();
                                $mail->FromName = 'nSmarTrac';
                                
                                $mail->addAddress($customerEmail, $targetName);
                                $mail->isHTML(true);
                                $mail->Subject = $automationData->email_subject;
                                $body_with_smart_tags = $this->replaceSmartTags($automationData->email_body, $invoice->id);
                                $mail->Body    = $body_with_smart_tags;
                        
                                if (!$mail->Send()) {
                                    $automation_fail++;
                                } else {
                                    $automation_success++;
                                }
                                
                            } else {

                                $host     = 'smtp.mailtrap.io';
                                $port     = 2525;
                                $username = 'd7c92e3b5e901d';
                                $password = '203aafda110ab7';
                                $from     = 'noreply@nsmartrac.com';
                                $subject  = $automationData->email_subject;
                
                                $mail = new PHPMailer;
                                $mail->isSMTP();
                                $mail->Host = $host;
                                $mail->SMTPAuth = true;
                                $mail->Username = $username;
                                $mail->Password = $password;
                                $mail->SMTPSecure = 'tls';
                                $mail->Port = $port;
                
                                // Sender and recipient settings
                                $mail->setFrom('noreply@nsmartrac.com', 'nSmartrac');
                                $mail->addAddress($customerEmail, $targetName);
                
                                $mail->IsHTML(true);
                                
                                $mail->Subject = $subject;
                                $body_with_smart_tags = $this->replaceSmartTags($automationData->email_body, $invoice->id);
                                $mail->Body    = $body_with_smart_tags;
                
                                // Send the email
                                if(!$mail->send()){
                                    $automation_fail++; // echo 'mailer error: ' . $mail->ErrorInfo;
                                } else {

                                    //Update queue status
                                    $queue_data['is_triggered'] = 1;
                                    $queue_data['status']       = 'sent';
                                    $this->automation_queue_model->updateAutomationQueue($automation_queue->id, $queue_data);                                    

                                    $automation_success++;
                                }

                            }

                        }
        
                    }
                }
    

            }

        }
        /**
         * Send email automation for creating new invoice - End
         */

         echo 'automation fail: ' . $automation_fail;
         echo '<hr />';
         echo 'automation success: ' . $automation_success;

    }

    public function cronPaidInvoiceMailAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;
        $is_live_mail_credentials = false;

        /**
         * Send email automation for set invoice paid - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_email',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'paid',
            'trigger_time' => 0,
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  
        if($automationsData) {
            foreach($automationsData as $automationData) {

                $automation_id = $automationData->id;
                $filters['automation_id'] = $automation_id;
                $filters['is_triggered']  = 0;
                $filters['status']        = 'new';
                $automation_queues = $this->automation_queue_model->getActiveAutomationQueue($filters);  

                if($automation_queues) {
                    foreach($automation_queues as $automation_queue) {
                        $queue_entity_id = $automation_queue->entity_id;
                        $invoice = $this->invoice_model->getinvoice($queue_entity_id); 
                        
                        $targetName    = "";
                        $customerEmail = "";

                        if($automationData->target == 'user') {
                            $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);
                            if($targetUser) {
                                $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                $customerEmail = $targetUser->email;
                            }
                        }elseif($automationData->target == 'client') {
                            if($invoice && $invoice->customer_id) {
                                $targetUser = $this->AcsProfile_model->getByProfId($invoice->customer_id);    
                                if($targetUser) {
                                    $targetName    = $targetUser->first_name . ' ' . $targetUser->last_name;
                                    $customerEmail = $targetUser->email;
                                } 
                            }
                        }elseif($automationData->target == 'sales_rep') {
                            if($invoice && $invoice->user_id) {
                                $targetUser = $this->users_model->getCompanyUserById($invoice->user_id);
                                if($targetUser) {
                                    $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                    $customerEmail = $targetUser->email;
                                }                                   
                            }
                        }
                        
                        if($targetName != "" && $customerEmail != "") {

                            if($is_live_mail_credentials) {
                                
                                $mail = email__getInstance();
                                $mail->FromName = 'nSmarTrac';
                                
                                $mail->addAddress($customerEmail, $targetName);
                                $mail->isHTML(true);
                                $mail->Subject = $automationData->email_subject;
                                $body_with_smart_tags = $this->replaceSmartTags($automationData->email_body, $invoice->id);
                                $mail->Body    = $body_with_smart_tags;
                        
                                if (!$mail->Send()) {
                                    $automation_fail++;
                                } else {
                                    $automation_success++;
                                }
                                
                            } else {

                                $host     = 'smtp.mailtrap.io';
                                $port     = 2525;
                                $username = 'd7c92e3b5e901d';
                                $password = '203aafda110ab7';
                                $from     = 'noreply@nsmartrac.com';
                                $subject  = $automationData->email_subject;
                
                                $mail = new PHPMailer;
                                $mail->isSMTP();
                                $mail->Host = $host;
                                $mail->SMTPAuth = true;
                                $mail->Username = $username;
                                $mail->Password = $password;
                                $mail->SMTPSecure = 'tls';
                                $mail->Port = $port;
                
                                // Sender and recipient settings
                                $mail->setFrom('noreply@nsmartrac.com', 'nSmartrac');
                                $mail->addAddress($customerEmail, $targetName);
                
                                $mail->IsHTML(true);
                                $mail->Subject = $subject;
                                $body_with_smart_tags = $this->replaceSmartTags($automationData->email_body, $invoice->id);
                                $mail->Body    = $body_with_smart_tags;

                                // Send the email
                                if(!$mail->send()){
                                    $automation_fail++;
                                } else {
                                    $automation_success++;

                                    //Update queue status
                                    $queue_data['is_triggered'] = 1;
                                    $queue_data['status']       = 'sent';
                                    $this->automation_queue_model->updateAutomationQueue($automation_queue->id, $queue_data);
                                }

                            }

                        }
        
                    }
                }
    

            }

        }
        /**
         * Send email automation for set invoice paid - End
         */

         echo 'automation fail: ' . $automation_fail;
         echo '<hr />';
         echo 'automation success: ' . $automation_success;
    }

    public function cronSmsAutomation()
    {
        
    }

    public function replaceSmartTags($message, $invoice_id = 0){
        $invoice = $this->invoice_model->getinvoice($invoice_id); 
        if($invoice) {
            $message = str_replace("{due_date}", $invoice->due_date, $message);
            $message = str_replace("{invoice_number}", $invoice->invoice_number, $message);
            $message = str_replace("{total_due}", $invoice->total_due, $message);
            $message = str_replace("{invoice_totals}", $invoice->invoice_totals, $message);
        }
        return $message;
    }    
}
