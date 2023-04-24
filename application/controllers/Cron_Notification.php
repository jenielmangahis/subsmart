<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Notification extends MYF_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function auto_sms_notification()
    {
        $this->load->helper('sms_helper');
        $this->load->model('RingCentralSmsLogs_model');
        $this->load->model('RingCentralAccounts_model');
        $this->load->model('TwilioAccounts_model');
        $this->load->model('TwilioSmsLogs_model');
        $this->load->model('Clients_model');
        $this->load->model('CronAutoSmsNotification_model');
        $this->load->model('VonageSms_model');

        $total_sent = 0;  
        $filter[] = ['field' => 'cron_auto_sms_notification.is_sent', 'value' => 0];
        $filter[] = ['field' => 'cron_auto_sms_notification.is_with_error', 'value' => 0];
        $cronAutoSms  = $this->CronAutoSmsNotification_model->getAll($filter, 15); 
        foreach($cronAutoSms as $sms){            
            $is_with_valid_sms_account = false;
            $smsApi = '';
            $client = $this->Clients_model->getById($sms->company_id);
            if( $client ){
                if( $client->default_sms_api == 'ring_central' ){
                    $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($client->id);
                    if( $ringCentral ){ 
                        $smsApi = 'ring_central';
                        $is_with_valid_sms_account = true;
                    }                
                }elseif( $client->default_sms_api == 'vonage' ){
                    $smsApi = 'vonage';
                    $is_with_valid_sms_account = true;
                }/*elseif( $client->default_sms_api == 'twilio' ){
                    $twilioAccount = $this->TwilioAccounts_model->getByCompanyId($client->id);
                    if( $twilioAccount ){
                        $smsApi = 'twilio';
                        $is_with_valid_sms_account = true;  
                    }
                }*/
                
                if( $is_with_valid_sms_account ){                    
                    $sms_message = $this->smsReplaceSmartTags($sms->module_name, $sms->obj_id, $sms->sms_message, $sms->user_id);

                    /*if( $smsApi == 'twilio' ){
                        $isSent  = smsTwilio($twilioAccount, $sms->mobile_number, $sms_message);
                        //$isSent['is_success'] = 1; 
                        if( $isSent['is_sent'] ){  
                            $cronSms = $this->CronAutoSmsNotification_model->getById($sms->id);
                            $data = [
                                'is_sent' => 1,
                                'date_sent' => date('Y-m-d H:i:s')
                            ];
                            $this->CronAutoSmsNotification_model->update($sms->id, $data);

                            $total_sent++;
                        }else{
                            $err_msg = $isSent['msg'];
                            $data = [
                                'is_sent' => 0,
                                'is_with_error' => 1,
                                'err_msg' => $err_msg
                            ];
                            $this->CronAutoSmsNotification_model->update($sms->id, $data);
                        }
                    }elseif( $smsApi == 'ring_central' ){
                        $isSent = smsRingCentral($ringCentral, $sms->mobile_number, $sms_message);
                        //$isSent['is_sent'] = true;
                        if( $isSent['is_success'] == 1 ){
                            $cronSms = $this->CronAutoSmsNotification_model->getById($sms->id);
                            $data = [
                                'is_sent' => 1,
                                'date_sent' => date('Y-m-d H:i:s')
                            ];
                            $this->CronAutoSmsNotification_model->update($sms->id, $data);

                            $total_sent++;
                        }else{
                            $err_msg = $isSent['msg'];
                            $data = [
                                'is_sent' => 0,
                                'is_with_error' => 1,
                                'err_msg' => $err_msg
                            ];
                            $this->CronAutoSmsNotification_model->update($sms->id, $data);
                        }    
                    }*/

                    //Check if has duplicate
                    $filters[] = ['field' => 'mobile_number', 'value' => $sms->mobile_number];
                    $filters[] = ['field' => 'company_auto_sms_id', 'value' => $sms->company_auto_sms_id];
                    $filters[] = ['field' => 'is_sent', 'value' => 1];
                    //$filters[] = ['field' => 'is_with_error', 'value' => 0];
                    $isDuplicate = $this->CronAutoSmsNotification_model->getByObjectId($sms->obj_id, $filters);
                    if( $isDuplicate ){
                        $data = [
                            'is_sent' => 0,
                            'is_with_error' => 1,
                            'err_msg' => 'Duplicate Number'
                        ];
                        $this->CronAutoSmsNotification_model->update($sms->id, $data);
                    }else{
                        if( $smsApi == 'ring_central' ){
                            $isSent = smsRingCentral($ringCentral, $sms->mobile_number, $sms_message);                            
                            if( $isSent['is_success'] == 1 ){
                                $cronSms = $this->CronAutoSmsNotification_model->getById($sms->id);
                                $data = [
                                    'is_sent' => 1,
                                    'date_sent' => date('Y-m-d H:i:s')
                                ];
                                $this->CronAutoSmsNotification_model->update($sms->id, $data);

                                $total_sent++;
                            }else{
                                $err_msg = $isSent['msg'];
                                $data = [
                                    'is_sent' => 0,
                                    'is_with_error' => 1,
                                    'err_msg' => $err_msg
                                ];
                                $this->CronAutoSmsNotification_model->update($sms->id, $data);
                            } 
                        }elseif( $smsApi == 'vonage' ){
                            $isSent = smsVonage($sms->mobile_number, $sms_message);
                            if( $isSent['is_success'] == 1 ){
                                $cronSms = $this->CronAutoSmsNotification_model->getById($sms->id);
                                $data = [
                                    'api_name' => $smsApi,
                                    'is_sent' => 1,
                                    'date_sent' => date('Y-m-d H:i:s')
                                ];
                                $this->CronAutoSmsNotification_model->update($sms->id, $data);

                                //Log vonage sms
                                $vonage_data = [
                                    'company_id' => $client->id,
                                    'messageId' => $isSent['data']['message_id'], 
                                    'channel' => 'sms',
                                    'sms_from' => VONAGE_NUMBER, 
                                    'sms_to' => $isSent['data']['to'],
                                    'sms_message' => $sms_message,
                                    'status' => $isSent['data']['status']
                                ];

                                $this->VonageSms_model->create($vonage_data);

                                $total_sent++;
                            }else{
                                $err_msg = $isSent['msg'];
                                $data = [
                                    'api_name' => $smsApi,
                                    'is_sent' => 0,
                                    'is_with_error' => 1,
                                    'err_msg' => $err_msg
                                ];
                                $this->CronAutoSmsNotification_model->update($sms->id, $data);
                            }
                        }
                    }          
                } 
            }                               
        }

        echo "Total Sent Auto SMS Notification : " . $total_sent;
        exit;
    }

    public function smsReplaceSmartTags($module_name, $object_id, $sms_message, $user_id)
    {
        $this->load->model('Estimate_model');
        $this->load->model('Workorder_model');
        $this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Business_model');
        $this->load->model('CompanyAutoSmsSettings_model');
        $this->load->model('Taskhub_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('Users_model');

        $order_number  = '';
        $customer_name = '';
        $business_name = '';
        $customer_email = '';
        $customer_phone = '';
        $sales_agent = '';
        $lead_name  = '';
        $lead_email = '';
        $lead_phone = '';
        $sales_agent = '';
        $tags = '';
        $installation_date = '';
        $creator_name = '';
        $scheduled_text = '';

        $recipient = $this->Users_model->getUserByID($user_id);

        if( $module_name == $this->CompanyAutoSmsSettings_model->moduleJob() ){
            $job = $this->Jobs_model->get_specific_job($object_id);
            if( $job ){
                $company = $this->Business_model->getByCompanyId($job->company_id);
                if( $company ){
                    $business_name = $company->business_name;
                }
                $tags = '';

                if($job->tags != '' ){
                    $tags = $job->tags;
                }

                $order_number  = $job->job_number;
                $customer_name = $job->first_name . ' ' . $job->last_name;
                $customer_email = $job->email;
                $customer_phone = $job->phone_m;

                $jobCreator = $this->Users_model->getUserByID($job->created_by);
                if( $jobCreator ){
                    $creator_name = $jobCreator->FName . ' ' . $jobCreator->LName;
                }

                $date_start = date('F d, D', strtotime($job->start_date)) . ' ' . date("g:i A", strtotime($job->start_time));
                $date_end   = date('F d, D', strtotime($job->end_date)) . ' ' . date("g:i A", strtotime($job->end_time));

                $scheduled_text = 'will start on ' . $date_start . ' and scheduled to complete on ' . $date_end;                
            }
        }elseif( $module_name == $this->CompanyAutoSmsSettings_model->moduleEstimate() ){
            $estimate = $this->Estimate_model->getById($object_id);
            if( $estimate ){
                $company = $this->Business_model->getByCompanyId($estimate->company_id);
                if( $company ){
                    $business_name = $company->business_name;
                }

                $tags = '';

                if($job->tags != '' ){
                    $tags = $estimate->tags;
                }

                $order_number  = $estimate->estimate_number;
                $customer_name = $estimate->first_name . ' ' . $job->last_name;

                $date = date('F d, D', strtotime($job->start_date));

                $scheduled_text = 'scheduled on ' . $date;                
            }
        }elseif( $module_name == $this->CompanyAutoSmsSettings_model->moduleWorkOrder() ){
            $workorder = $this->Workorder_model->adminGetById($object_id);
            if( $workorder ){
                $company = $this->Business_model->getByCompanyId($workorder->company_id);
                if( $company ){
                    $business_name = $company->business_name;
                }
                $order_number  = $workorder->work_order_number;
                $customer_name = $workorder->first_name . ' ' . $workorder->last_name;
                $customer_email = $workorder->email;
                $customer_phone = $workorder->phone_m;

                $workorderCreator = $this->Users_model->getUserByID($workorder->employee_id);
                if( $workorderCreator ){
                    $creator_name = $workorderCreator->FName . ' ' . $workorderCreator->LName;
                }

                //$tags = 'Not Specified';
                $tags = '';
                /*if($workorder->job_tags > 0 ){
                    $jobTag = $this->Workorder_model->get_job_tags_data($workorder->job_tags);
                    if( $jobTag ){
                        $tags = $jobTag->name;
                    }
                    
                }*/

                if($workorder->job_tags != '' ){
                    $tags = $workorder->job_tags;
                }
                
                //$installation_date  = 'Not Specified';
                $installation_date  = '';
                if( $workorder->install_date != '' && $workorder->install_time != '' ){
                    $installation_date = date("m/d/Y",strtotime($workorder->install_date)) . ' at ' . $workorder->install_time;
                }
                /*$workOrderAgreement = $this->Workorder_model->get_agreements($workorder->id);
                if( $workOrderAgreement && $workOrderAgreement->intall_time != '' ){
                    $installation_date = date("m/d/Y",strtotime($workOrderAgreement->installation_date)) . ' at ' . $workOrderAgreement->intall_time;    
                }*/
                
            }
        }elseif( $module_name == $this->CompanyAutoSmsSettings_model->moduleEvent() ){
            $event = $this->Event_model->get_specific_event($object_id);
            if( $event ){
                $company = $this->Business_model->getByCompanyId($event->company_id);
                if( $company ){
                    $business_name = $company->business_name;
                }
                $order_number  = $event->event_number;
                $customer_name = $event->first_name . ' ' . $event->last_name;
                $customer_email = $event->email;
                $customer_phone = $event->phone_m;
            }
        }elseif( $module_name == $this->CompanyAutoSmsSettings_model->moduleTaskHub() ){
            $task = $this->Taskhub_model->getById($object_id);
            if( $task ){
                $customer = $this->Customer_advance_model->get_data_by_id('prof_id',$task->prof_id,"acs_profile");
                $company  = $this->Business_model->getByCompanyId($task->company_id);
                if( $company ){
                    $business_name = $company->business_name;
                }

                $customer_name = $customer->first_name . ' ' . $customer->last_name;
                $customer_email = $customer->email;
                $customer_phone = $customer->phone_m;
            }
        }elseif( $module_name == $this->CompanyAutoSmsSettings_model->moduleLead() ){
            $lead = $this->Customer_advance_model->get_data_by_id('leads_id',$object_id,"ac_leads");
            if( $lead ){
                $company  = $this->Business_model->getByCompanyId($lead->company_id);
                if( $company ){
                    $business_name = $company->business_name;
                }

                $salesAgent = $this->Users_model->getUserByID($lead->fk_sr_id);
                if( $salesAgent ){
                    $sales_agent = $salesAgent->FName . ' ' . $salesAgent->LName;
                }

                $lead_name = $lead->firstname . ' ' . $lead->lastname;
                $lead_email = $lead->email_add;
                $lead_phone = $lead->phone_cell;
            }
        }elseif( $module_name == $this->CompanyAutoSmsSettings_model->moduleCustomer() ){
            $customer = $this->Customer_advance_model->get_data_by_id('prof_id',$object_id,"acs_profile");
            if( $customer ){
                $company  = $this->Business_model->getByCompanyId($customer->company_id);
                if( $company ){
                    $business_name = $company->business_name;
                }

                /*$salesAgent = $this->Users_model->getUserByID($lead->fk_sr_id);
                if( $salesAgent ){
                    $sales_agent = $salesAgent->FName . ' ' . $salesAgent->LName;
                }*/

                //$customer_name = $customer->first_name . ' ' . $customer->last_name;
                $customer_name = $customer->first_name;
                $customer_email = $customer->email;
                $customer_phone = $customer->phone_m;
            }
        }

        $sms_message = str_replace("{{order.number}}", $order_number, $sms_message);
        $sms_message = str_replace("{{customer.name}}", $customer_name, $sms_message);
        $sms_message = str_replace("{{business.name}}", $business_name, $sms_message);
        $sms_message = str_replace("{{customer.email}}", $customer_email, $sms_message);
        $sms_message = str_replace("{{customer.phone}}", $customer_phone, $sms_message);

        $sms_message = str_replace("{{lead.name}}", $lead_name, $sms_message);
        $sms_message = str_replace("{{lead.phone}}", $lead_phone, $sms_message);
        $sms_message = str_replace("{{lead.email}}", $lead_email, $sms_message);

        $sms_message = str_replace("{{creator.name}}", $creator_name, $sms_message);  

        $sms_message = str_replace("{{tech.firstname}}", $recipient->FName, $sms_message);  
        $sms_message = str_replace("{{tech.lastname}}", $recipient->LName, $sms_message);  

        if( $scheduled_text != '' ){
            $sms_message = str_replace("{{scheduled.information}}", $scheduled_text, $sms_message);      
        }

        if( $tags != '' ){
            $sms_message = str_replace("{{tags}}", $tags, $sms_message);
        }else{
            $sms_message = str_replace("Tag :", "", $sms_message);
            $sms_message = str_replace("{{tags}}", "", $sms_message);
        }

        if( $installation_date != '' ){
            if( $tags == '' ){
                $sms_message = str_replace("and is booked for", "Booked for", $sms_message);
            }
            $sms_message = str_replace("{{installation.date}}", $installation_date, $sms_message);
        }else{
            $sms_message = str_replace("and is booked for", "", $sms_message);
            $sms_message = str_replace("{{installation.date}}", "", $sms_message);
        }

        return $sms_message;
    }

    public function testSmartTags()
    {
        $this->load->model('Jobs_model');
        $job = $this->Jobs_model->get_specific_job(100);
        echo "<pre>";
        print_r($job);
        exit;
        $sms = 'THIS IS A SAMPLE SMS {{order.number}} {{customer.name}} AAA {{business.name}}';
        $sms = $this->smsReplaceSmartTags('estimate', 2, $sms);
        echo $sms;
        exit;
    }
}

