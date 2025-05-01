<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_Automation_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Automation_model', 'automation_model');
        $this->load->model('Automation_Queue_model', 'automation_queue_model');

        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('AcsProfile_model', 'AcsProfile_model');   
    }

    public function cronCreatedInvoiceMailAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;

        $is_live_mail_credentials = isLiveMailSmptCredentials();

        /**
         * Send email automation for creating new invoice - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_email',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'created'
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params); 
        if($automationsData) {

            foreach($automationsData as $automationData) {
                
                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }                            
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end                         
                            
                            if($trigger_automation == 1) {
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
    
                                            //Update queue status
                                            $queue_data['is_triggered'] = 1;
                                            $queue_data['status']       = 'sent';
                                            $this->automation_queue_model->updateAutomationQueue($automation_queue->id, $queue_data);  
    
                                            $automation_success++;
                                        }
                                        
                                    } else {
        
                                        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        
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
        $is_live_mail_credentials = isLiveMailSmptCredentials();

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

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
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
                                            //Update queue status
                                            $queue_data['is_triggered'] = 1;
                                            $queue_data['status']       = 'sent';
                                            $this->automation_queue_model->updateAutomationQueue($automation_queue->id, $queue_data);  
    
                                            $automation_success++;
                                        }
                                        
                                    } else {
        
                                        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
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

            }
        }
        /**
         * Send email automation for set invoice paid - End
         */

         echo 'automation fail: ' . $automation_fail;
         echo '<hr />';
         echo 'automation success: ' . $automation_success;
    }

    public function cronSetToDueInvoiceMailAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;
        $is_live_mail_credentials = isLiveMailSmptCredentials();

        /**
         * Send email automation for set invoice paid - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'operation' => 'send',
            'trigger_event' => 'due',
            'trigger_action' => 'send_email',
            'status' => 'active',
            'trigger_time' => 0,
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  
        if($automationsData) {
            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
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
                                            //Update queue status
                                            $queue_data['is_triggered'] = 1;
                                            $queue_data['status']       = 'sent';
                                            $this->automation_queue_model->updateAutomationQueue($automation_queue->id, $queue_data);

                                            $automation_success++;
                                        }
                                        
                                    } else {
        
                                        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
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

            }
        }

        echo 'automation fail: ' . $automation_fail;
        echo '<hr />';
        echo 'automation success: ' . $automation_success;        
    }

    public function cronSetToPastDueInvoiceMailAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;
        $is_live_mail_credentials = isLiveMailSmptCredentials();

        /**
         * Send email automation for set invoice paid - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'operation' => 'send',
            'trigger_event' => 'past_due',
            'trigger_action' => 'send_email',
            'status' => 'active',
            'trigger_time' => 0,
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  
        if($automationsData) {
            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
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
                                            //Update queue status
                                            $queue_data['is_triggered'] = 1;
                                            $queue_data['status']       = 'sent';
                                            $this->automation_queue_model->updateAutomationQueue($automation_queue->id, $queue_data);

                                            $automation_success++;
                                        }
                                        
                                    } else {
        
                                        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
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

            }
        }

        echo 'automation fail: ' . $automation_fail;
        echo '<hr />';
        echo 'automation success: ' . $automation_success; 
    }

    public function cronSentInvoiceMailAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;
        $is_live_mail_credentials = isLiveMailSmptCredentials();

        /**
         * Send email automation for set invoice paid - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'operation' => 'send',
            'trigger_event' => 'sent',
            'trigger_action' => 'send_email',
            'status' => 'active',
            'trigger_time' => 0,
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  
        if($automationsData) {
            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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
                            
                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
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
                                            //Update queue status
                                            $queue_data['is_triggered'] = 1;
                                            $queue_data['status']       = 'sent';
                                            $this->automation_queue_model->updateAutomationQueue($automation_queue->id, $queue_data);
                                            
                                            $automation_success++;
                                        }
                                        
                                    } else {
        
                                        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
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

            }
        }

        echo 'automation fail: ' . $automation_fail;
        echo '<hr />';
        echo 'automation success: ' . $automation_success; 
    }

    public function cronCreatedInvoiceSMSAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;

        /**
         * Send email automation for creating new invoice - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_sms',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'created',
            'trigger_time' => 0,
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  

        if($automationsData) {

            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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
                            $sendSmsNumber = "";
    
                            if($automationData->target == 'user') {
                                $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);
                                if($targetUser) {
                                    $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                    $sendSmsNumber = $targetUser->mobile;
                                }
                            }elseif($automationData->target == 'client') {
                                if($invoice && $invoice->customer_id) {
                                    $targetUser = $this->AcsProfile_model->getByProfId($invoice->customer_id);    
                                    if($targetUser) {
                                        $targetName    = $targetUser->first_name . ' ' . $targetUser->last_name;
                                        $sendSmsNumber = $targetUser->phone_m;
                                    } 
                                }
                            }elseif($automationData->target == 'sales_rep') {
                                if($invoice && $invoice->user_id) {
                                    $targetUser = $this->users_model->getCompanyUserById($invoice->user_id);
                                    if($targetUser) {
                                        $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                        $sendSmsNumber = $targetUser->mobile;;
                                    }                                   
                                }
                            }

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
                                if($targetName != "" && $sendSmsNumber != "") {
        
                                    //Send SMS Here - start
                                    /*if( $client->default_sms_api == 'ring_central' ){
                                        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($client->id);
                                        if( $ringCentral ){ 
                                            $smsApi = 'ring_central';
                                            $is_with_valid_sms_account = true;
                                        }                
                                    }elseif( $client->default_sms_api == 'vonage' ){
                                        $smsApi = 'vonage';
                                        $is_with_valid_sms_account = true;
                                    }
                                    
                                    $sms_body_with_smart_tags = $this->replaceSmartTags($automationData->sms_body, $invoice->id);
                                    if( $smsApi == 'ring_central' ){
                                        $isSent = smsRingCentral($ringCentral, $sms->mobile_number, $sms_body_with_smart_tags);                            
                                        if( $isSent['is_sent'] == 1 ){
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        } 
                                    }elseif( $smsApi == 'vonage' ){
                                        $isSent = smsVonage($sms->mobile_number, $sms_body_with_smart_tags);
                                        if( $isSent['is_success'] == 1 ){        
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        }
                                    }*/
                                    //Send SMS Here - end                                 

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

    public function cronPaidInvoiceSMSAutomation() 
    {
        $automation_fail = 0; 
        $automation_success = 0;

        /**
         * Send email automation for updating invoice status to paid - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_sms',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'paid',
            'trigger_time' => 0,
        ];    

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  

        if($automationsData) {

            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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
                            $sendSmsNumber = "";
    
                            if($automationData->target == 'user') {
                                $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);
                                if($targetUser) {
                                    $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                    $sendSmsNumber = $targetUser->mobile;
                                }
                            }elseif($automationData->target == 'client') {
                                if($invoice && $invoice->customer_id) {
                                    $targetUser = $this->AcsProfile_model->getByProfId($invoice->customer_id);    
                                    if($targetUser) {
                                        $targetName    = $targetUser->first_name . ' ' . $targetUser->last_name;
                                        $sendSmsNumber = $targetUser->phone_m;
                                    } 
                                }
                            }elseif($automationData->target == 'sales_rep') {
                                if($invoice && $invoice->user_id) {
                                    $targetUser = $this->users_model->getCompanyUserById($invoice->user_id);
                                    if($targetUser) {
                                        $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                        $sendSmsNumber = $targetUser->mobile;;
                                    }                                   
                                }
                            }

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
                                if($targetName != "" && $sendSmsNumber != "") {
        
                                    //Send SMS Here - start
                                    /*if( $client->default_sms_api == 'ring_central' ){
                                        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($client->id);
                                        if( $ringCentral ){ 
                                            $smsApi = 'ring_central';
                                            $is_with_valid_sms_account = true;
                                        }                
                                    }elseif( $client->default_sms_api == 'vonage' ){
                                        $smsApi = 'vonage';
                                        $is_with_valid_sms_account = true;
                                    }
                                    
                                    $sms_body_with_smart_tags = $this->replaceSmartTags($automationData->sms_body, $invoice->id);
                                    if( $smsApi == 'ring_central' ){
                                        $isSent = smsRingCentral($ringCentral, $sms->mobile_number, $sms_body_with_smart_tags);                            
                                        if( $isSent['is_sent'] == 1 ){
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        } 
                                    }elseif( $smsApi == 'vonage' ){
                                        $isSent = smsVonage($sms->mobile_number, $sms_body_with_smart_tags);
                                        if( $isSent['is_success'] == 1 ){        
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        }
                                    }*/
        
                                }
                            }
            
                        }
                    }                    
                }

            }

        }
        /**
         * Send email automation for updating invoice status to paid - End
         */

         echo 'automation fail: ' . $automation_fail;
         echo '<hr />';
         echo 'automation success: ' . $automation_success;       
    }

    public function cronSetToDueInvoiceSMSAutomation() 
    {
        $automation_fail = 0; 
        $automation_success = 0;

        /**
         * Send email automation for updating invoice status to due - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_sms',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'due',
            'trigger_time' => 0,
        ];    

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  

        if($automationsData) {

            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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
                            $sendSmsNumber = "";
    
                            if($automationData->target == 'user') {
                                $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);
                                if($targetUser) {
                                    $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                    $sendSmsNumber = $targetUser->mobile;
                                }
                            }elseif($automationData->target == 'client') {
                                if($invoice && $invoice->customer_id) {
                                    $targetUser = $this->AcsProfile_model->getByProfId($invoice->customer_id);    
                                    if($targetUser) {
                                        $targetName    = $targetUser->first_name . ' ' . $targetUser->last_name;
                                        $sendSmsNumber = $targetUser->phone_m;
                                    } 
                                }
                            }elseif($automationData->target == 'sales_rep') {
                                if($invoice && $invoice->user_id) {
                                    $targetUser = $this->users_model->getCompanyUserById($invoice->user_id);
                                    if($targetUser) {
                                        $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                        $sendSmsNumber = $targetUser->mobile;;
                                    }                                   
                                }
                            }

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
                                if($targetName != "" && $sendSmsNumber != "") {
        
                                    //Send SMS Here - start
                                    /*if( $client->default_sms_api == 'ring_central' ){
                                        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($client->id);
                                        if( $ringCentral ){ 
                                            $smsApi = 'ring_central';
                                            $is_with_valid_sms_account = true;
                                        }                
                                    }elseif( $client->default_sms_api == 'vonage' ){
                                        $smsApi = 'vonage';
                                        $is_with_valid_sms_account = true;
                                    }
                                    
                                    $sms_body_with_smart_tags = $this->replaceSmartTags($automationData->sms_body, $invoice->id);
                                    if( $smsApi == 'ring_central' ){
                                        $isSent = smsRingCentral($ringCentral, $sms->mobile_number, $sms_body_with_smart_tags);                            
                                        if( $isSent['is_sent'] == 1 ){
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        } 
                                    }elseif( $smsApi == 'vonage' ){
                                        $isSent = smsVonage($sms->mobile_number, $sms_body_with_smart_tags);
                                        if( $isSent['is_success'] == 1 ){        
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        }
                                    }*/
        
                                }
                            }
            
                        }
                    }                    
                }

            }

        }
        /**
         * Send email automation for updating invoice status to due - End
         */

         echo 'automation fail: ' . $automation_fail;
         echo '<hr />';
         echo 'automation success: ' . $automation_success;     
    }

    public function cronSetToPastDueInvoiceSMSAutomation() 
    {
        $automation_fail = 0; 
        $automation_success = 0;

        /**
         * Send email automation for updating invoice status to past due - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_sms',
            'operation' => 'send',
            'status' => 'active',
            'trigger_event' => 'past_due',
            'trigger_time' => 0,
        ];    

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  

        if($automationsData) {

            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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
                            $sendSmsNumber = "";
    
                            if($automationData->target == 'user') {
                                $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);
                                if($targetUser) {
                                    $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                    $sendSmsNumber = $targetUser->mobile;
                                }
                            }elseif($automationData->target == 'client') {
                                if($invoice && $invoice->customer_id) {
                                    $targetUser = $this->AcsProfile_model->getByProfId($invoice->customer_id);    
                                    if($targetUser) {
                                        $targetName    = $targetUser->first_name . ' ' . $targetUser->last_name;
                                        $sendSmsNumber = $targetUser->phone_m;
                                    } 
                                }
                            }elseif($automationData->target == 'sales_rep') {
                                if($invoice && $invoice->user_id) {
                                    $targetUser = $this->users_model->getCompanyUserById($invoice->user_id);
                                    if($targetUser) {
                                        $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                                        $sendSmsNumber = $targetUser->mobile;;
                                    }                                   
                                }
                            }

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
                                if($targetName != "" && $sendSmsNumber != "") {
        
                                    //Send SMS Here - start
                                    /*if( $client->default_sms_api == 'ring_central' ){
                                        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($client->id);
                                        if( $ringCentral ){ 
                                            $smsApi = 'ring_central';
                                            $is_with_valid_sms_account = true;
                                        }                
                                    }elseif( $client->default_sms_api == 'vonage' ){
                                        $smsApi = 'vonage';
                                        $is_with_valid_sms_account = true;
                                    }
                                    
                                    $sms_body_with_smart_tags = $this->replaceSmartTags($automationData->sms_body, $invoice->id);
                                    if( $smsApi == 'ring_central' ){
                                        $isSent = smsRingCentral($ringCentral, $sms->mobile_number, $sms_body_with_smart_tags);                            
                                        if( $isSent['is_sent'] == 1 ){
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        } 
                                    }elseif( $smsApi == 'vonage' ){
                                        $isSent = smsVonage($sms->mobile_number, $sms_body_with_smart_tags);
                                        if( $isSent['is_success'] == 1 ){        
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        }
                                    }*/
        
                                }                            
                            }
            
                        }
                    }
                }                

            }

        }
        /**
         * Send email automation for updating invoice status to past due - End
         */

         echo 'automation fail: ' . $automation_fail;
         echo '<hr />';
         echo 'automation success: ' . $automation_success;
    }

    public function cronSentInvoiceSMSAutomation()
    {
        $automation_fail = 0; 
        $automation_success = 0;
        $is_live_mail_credentials = isLiveMailSmptCredentials();

        /**
         * Send email automation for set invoice paid - Start
         */
        $auto_to_user_params = [
            'entity' => 'invoice',
            'operation' => 'send',
            'trigger_event' => 'sent',
            'trigger_action' => 'send_sms',
            'status' => 'active',
            'trigger_time' => 0,
        ];

        $automationsData = $this->automation_model->getAutomationsListByParams($auto_to_user_params);  
        if($automationsData) {
            foreach($automationsData as $automationData) {

                $current_time    = date('H:i');
                $sent_start_time = date('H:i', strtotime($automationData->start_time));
                $sent_end_time   = date('H:i', strtotime($automationData->end_time));

                $startTimeStamp = strtotime($sent_start_time);
                $endTimeStamp   = strtotime($sent_end_time);
                $checkTimeStamp = strtotime($current_time);   
                
                //Add condition to check if sending is in between automation start & end time
                if ($checkTimeStamp >= $startTimeStamp && $checkTimeStamp <= $endTimeStamp) {
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

                            //Todo: add condition here for date time sent
                            $trigger_automation   = 0;
                            $invoice_due_date     = null;
                            $invoice_created_date = null;   
                            $current_date_time    = date('Y-m-d H:i'); 

                            if($invoice) {
                                $invoice_due_date     = date('Y-m-d H:i', strtotime($invoice->due_date));
                                $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created));
                            }

                            if($automationData->date_reference == 'create_date' && $invoice_created_date != null) {                                
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->date_created . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }elseif($automationData->date_reference == 'due_date' && $invoice_due_date != null) {
                                if($automationData->timing_reference == 'after') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date. ' + ' .$add_trigger_minutes. ' minutes'));
                                }elseif($automationData->timing_reference == 'before') {
                                    $add_trigger_minutes = $automationData->trigger_time;
                                    $invoice_created_date = date('Y-m-d H:i', strtotime($invoice->due_date . ' - ' .$add_trigger_minutes. ' minutes'));
                                }

                                if ($current_date_time >= $invoice_created_date) {
                                    $trigger_automation = 1;
                                }
                            }
                    
                            if($automationData->trigger_time == 0) {
                                $trigger_automation = 1;
                            }

                            //Add custom condition checking - start
                            $a_conditions       = json_decode($automationData->conditions, true);
                            $a_conditions_count = count($a_conditions);

                            $is_custom_condition_success_count = 0;
                            $invoice_grand_total = $invoice->grand_total;
                
                            if($a_conditions_count > 0) {
                                foreach($a_conditions as $a_condition) {
                                    if($a_condition['property'] == 'amount') {

                                        if($a_condition['operator'] == '>') {
                                            if($invoice_grand_total > $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '<') {
                                            if($invoice_grand_total < $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }elseif($a_condition['operator'] == '=') {
                                            if($invoice_grand_total == $a_condition['value']) {
                                                $is_custom_condition_success_count++;
                                            }
                                        }
    
                                    }
                                }

                                if($is_custom_condition_success_count != $a_conditions_count) {
                                    $trigger_automation = 0;
                                }

                            }
                            //Add custom condition checking - end 
                            
                            if($trigger_automation == 1) {
                                if($targetName != "" && $customerEmail != "") {
        
                                    //Send SMS Here - start
                                    /*if( $client->default_sms_api == 'ring_central' ){
                                        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($client->id);
                                        if( $ringCentral ){ 
                                            $smsApi = 'ring_central';
                                            $is_with_valid_sms_account = true;
                                        }                
                                    }elseif( $client->default_sms_api == 'vonage' ){
                                        $smsApi = 'vonage';
                                        $is_with_valid_sms_account = true;
                                    }
                                    
                                    $sms_body_with_smart_tags = $this->replaceSmartTags($automationData->sms_body, $invoice->id);
                                    if( $smsApi == 'ring_central' ){
                                        $isSent = smsRingCentral($ringCentral, $sms->mobile_number, $sms_body_with_smart_tags);                            
                                        if( $isSent['is_sent'] == 1 ){
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        } 
                                    }elseif( $smsApi == 'vonage' ){
                                        $isSent = smsVonage($sms->mobile_number, $sms_body_with_smart_tags);
                                        if( $isSent['is_success'] == 1 ){        
                                            $total_sent++;
                                        }else{
                                            $total_error_sent++;
                                        }
                                    }*/
        
                                }
                            }
                        }
                    }                    
                }

            }
        }

        echo 'automation fail: ' . $automation_fail;
        echo '<hr />';
        echo 'automation success: ' . $automation_success; 
    }

    public function replaceSmartTags($message, $invoice_id = 0){
        $invoice = $this->invoice_model->getinvoice($invoice_id); 
        if($invoice) {
            $message = str_replace("{due_date}", $invoice->due_date, $message);
            $message = str_replace("{invoice_number}", $invoice->invoice_number, $message);
            $message = str_replace("{total_due}", $invoice->total_due, $message);
            $message = str_replace("{invoice_totals}", $invoice->invoice_totals, $message);
            
            $invoice_link = base_url('invoice/genview/' . $invoice->id);
            $message = str_replace("{invoice_link}", "<a target='_blank' href='" . $invoice_link . "'>".$invoice->invoice_number."</a>", $message);
        }
        return $message;
    }    
}
