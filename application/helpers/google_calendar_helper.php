<?php

function createSyncToCalendar($object_id, $module_name, $company_id, $is_manual_sync = 0)
{   
    $CI =& get_instance();
    $CI->load->model('GoogleAccounts_model');
    $CI->load->model('GoogleCalendarSync_model');
    $CI->load->model('CalendarSettings_model');
    $CI->load->model('Settings_model');
    $CI->load->model('Jobs_model');

    $is_valid = 0;
    $msg = 'API Error';

    $googleAccount = $CI->GoogleAccounts_model->getByCompanyId($company_id);
    if( $googleAccount ){    
        $settings = $CI->CalendarSettings_model->getByCompanyId($company_id);
        IF( $settings ){                    
            $is_valid_sync_calendar = false;

            if( $module_name == 'appointment' ){                
                if( $settings->auto_add_appointment == 1 ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'job' ){
                $job = $CI->Jobs_model->get_specific_job($object_id);
                if( $job && $job->status == 'Scheduled' ){
                    if( $settings->auto_add_job == 1 ){
                        $is_valid_sync_calendar = true;
                    }
                } 
            }

            if( $module_name == 'event' ){
                if( $settings->auto_add_event == 1 ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'service_ticket' || $module_name == 'ticket' ){
                if( $settings->auto_add_ticket == 1 ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'tc-off' ){
                if( $settings->auto_add_tcoff == 1 ){
                    $is_valid_sync_calendar = true;
                }                
            } 

            if( $is_valid_sync_calendar ){                
                $isExists = $CI->GoogleCalendarSync_model->getByObjectIdAndModuleName($object_id, $module_name);
                if( !$isExists ){
                    $data = [
                        'company_id' => $company_id,
                        'object_id' => $object_id,
                        'module_name' => $module_name,
                        'is_sync' => 0,
                        'is_with_error' => 0,
                        'created' => date('Y-m-d H:i:s')
                    ];

                    $CI->GoogleCalendarSync_model->create($data);

                    $is_valid = 1;
                    $msg = '';
                }else{
                    if( $is_manual_sync == 1 ){
                         $data = [
                            'company_id' => $company_id,
                            'object_id' => $object_id,
                            'module_name' => $module_name,
                            'is_sync' => 0,
                            'is_with_error' => 0,
                            'created' => date('Y-m-d H:i:s')
                        ];

                        $CI->GoogleCalendarSync_model->create($data);

                        $is_valid = 1;
                        $msg = '';
                    }else{
                        $msg = 'Already sync to google calendar';    
                    }
                    
                }               
            }else{                      
                $msg = 'Cannot sync data';
            }
        }     
    }else{
        $msg = 'You do not have any gmail account connected. Please connect your gmail account in calendar settings.';
    } 

    //Create SMS
    //createSmsNotification($object_id, $module_name, $company_id);  

    return ['is_valid' => $is_valid, 'msg' => $msg];
}

function createSmsNotification($object_id, $module_name, $company_id)
{
    $CI =& get_instance();
    $CI->load->model('GoogleAccounts_model');
    $CI->load->model('GoogleCalendarSync_model');
    $CI->load->model('CalendarSettings_model');
    $CI->load->model('Appointment_model');
    $CI->load->model('Settings_model');
    $CI->load->model('Jobs_model');
    $CI->load->model('Users_model');
    $CI->load->model('AcsProfile_model');
    $CI->load->model('GoogleCalendarSmsNotification_model');
    $CI->load->helper(array('hashids_helper'));       

    $is_valid = 0;
    $msg = 'API Error';

    $settings = $CI->CalendarSettings_model->getByCompanyId($company_id);
    $isSmsExists = $CI->GoogleCalendarSmsNotification_model->getByObjectIdAndModuleName($object_id, $module_name);
    if( !$isSmsExists ){
        if( $settings ){
            if( $settings->calendar_auto_sms_notification != '' ){
                $smsSettings = explode(" ", $settings->calendar_auto_sms_notification);            
                if( $smsSettings[0] > 0 ){
                    switch ($module_name) {
                        case 'job':                     
                            $job = $CI->Jobs_model->get_specific_job($object_id);                        
                            if( $job ){
                                $schedule_date = $job->start_date . ' ' . $job->start_time;
                                $send_date     = date("Y-m-d h:i:s", strtotime($schedule_date . ' + ' . $smsSettings[0] . ' minute'));

                                if( $job->hash_id != '' ){
                                    $job_eid = $job->hash_id;
                                }else{
                                    $job_eid = hashids_encrypt($job->job_unique_id, '', 15);
                                    $CI->Jobs_model->update($job->job_unique_id, ['hash_id' => $job_eid]);
                                }

                                $view_link = "<a href='".base_url('/job_invoice_view/' . $job_eid)."'>View Job</a>";
                                $sms_message  = "You have an upcoming job - ". $job->job_number ."<br />";
                                $sms_message .= "To view this job click ".$view_link;  

                                $recipients = array();
                                if( $job->e_employee_id != '' ){
                                    $user = $CI->Users_model->getUserByID($job->e_employee_id);
                                    if( $user && $user->mobile != '' ){
                                        $recipients[] = ['mobile_number' => $user->mobile];
                                    }
                                }
                                if( $job->employee2_employee_id != '' ){
                                    $user = $CI->Users_model->getUserByID($job->employee2_employee_id);
                                    if( $user && $user->mobile != '' ){
                                        $recipients[] = ['mobile_number' => $user->mobile];
                                    }
                                }
                                if( $job->employee3_employee_id != '' ){
                                    $user = $CI->Users_model->getUserByID($job->employee3_employee_id);
                                    if( $user && $user->mobile != '' ){
                                        $recipients[] = ['mobile_number' => $user->mobile];
                                    }
                                }
                                if( $job->employee4_employee_id != '' ){
                                    $user = $CI->Users_model->getUserByID($job->employee4_employee_id);
                                    if( $user && $user->mobile != '' ){
                                        $recipients[] = ['mobile_number' => $user->mobile];
                                    }
                                }

                                $customer = $CI->AcsProfile_model->getByProfId($job->customer_id);
                                if( $customer && $customer->phone_m != '' ){
                                    $recipients[] = ['mobile_number' => $customer->phone_m];
                                }

                                $is_valid      = 1;
                            }

                            break;
                        case 'appointment':
                            $appointment = $CI->Appointment_model->getById($object_id);
                            if( $appointment ){
                                $schedule_date = $appointment->appointment_date . ' ' . $appointment->appointment_time_from;
                                $send_date     = date("Y-m-d h:i:s", strtotime($schedule_date . ' + ' . $smsSettings[0] . ' minute'));
                            }

                            $appointment_eid = hashids_encrypt($appointment->id, '', 15);
                            $view_link       = "<a href='".base_url('appointment/'.$appointment_eid)."'>View Appointment</a>";
                            $sms_message  = "You have an upcoming appointment - ". $appointment->appointment_number ."<br />";
                            $sms_message .= "To view this appointment click ".$view_link;  

                            $recipients = array();
                            $assigned_employees = json_decode($appointment->assigned_employee_ids);
                            if( !empty($assigned_employees) ){
                                foreach($assigned_employees as $eid){
                                    $user = $CI->Users_model->getUserByID($eid);
                                    if( $user && $user->mobile != '' ){
                                        $recipients[] = ['mobile_number' => $user->mobile];
                                    }
                                }
                            }

                            $is_valid = 1;

                        default:                        
                        break;
                    }

                    if( $is_valid && !empty($recipients) ){
                        foreach($recipients as $recipient){
                            $data_sms = [
                                'object_id' => $object_id,
                                'module_name' => $module_name,
                                'mobile_number' => $recipient['mobile_number'],
                                'sms_message' => $sms_message,
                                'send_date' => $send_date,
                                'is_sent' => 0
                            ];

                            $CI->GoogleCalendarSmsNotification_model->create($data_sms);
                        }         

                        $msg = '';
                    }
                }
            }
        }
    }else{
        $msg = 'SMS data already exists';
    }
    
    return ['is_valid' => $is_valid, 'msg' => $msg];
}