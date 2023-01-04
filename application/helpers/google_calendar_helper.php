<?php

function createSyncToCalendar($object_id, $module_name, $company_id)
{   
    $CI =& get_instance();
    $CI->load->model('GoogleAccounts_model');
    $CI->load->model('GoogleCalendarSync_model');
    $CI->load->model('CalendarSettings_model');
    $CI->load->model('Settings_model');

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
                if( $settings->auto_add_job == 1 ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'event' ){
                if( $settings->auto_add_event == 1 ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'service_ticket' ){
                if( $settings->auto_add_ticket == 1 ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'tc-off' ){
                /*if( $settings->auto_add_ticket == 1 ){
                    $is_valid_sync_calendar = true;
                }*/
                $is_valid_sync_calendar = true;
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
                }else{
                    $msg = 'Already sync to google calendar';
                }               
            }else{                      
                $msg = 'Cannot sync data';
            }
        }     
    }    

    return ['is_valid' => $is_valid, 'msg' => $msg];
}