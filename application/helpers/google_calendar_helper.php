<?php

function createSyncToCalendar($module_id, $module_name, $company_id)
{   
    $CI =& get_instance();
    $CI->load->model('GoogleAccounts_model');
    $CI->load->model('GoogleCalendarSync_model');
    $CI->load->model('Settings_model');

    $googleAccount = $CI->GoogleAccounts_model->getByCompanyId($company_id);
    if( $googleAccount ){        
        $settings = $CI->Settings_model->getCompanyValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE, $company_id);
        $settings = unserialize($settings);
        if( $settings ){
            $auto_add_modules = $settings['google_calendar'];
            $is_valid_sync_calendar = false;
            if( $module_name == 'appointment' ){                
                if( in_array('Appointment', $settings['google_calendar']) ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'job' ){
                if( in_array('Job', $settings['google_calendar']) ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'event' ){
                if( in_array('Event', $settings['google_calendar']) ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $module_name == 'service_ticket' ){
                if( in_array('Service Ticket', $settings['google_calendar']) ){
                    $is_valid_sync_calendar = true;
                }
            }

            if( $is_valid_sync_calendar ){
                $data = [
                    'company_id' => $company_id,
                    'module_id' => $module_id,
                    'module_name' => $module_name,
                    'is_sync' => 0,
                    'created' => date('Y-m-d H:i:s')
                ];

                $CI->GoogleCalendarSync_model->create($data);
            }            
        }        
    }    
}