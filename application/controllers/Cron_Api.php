<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Api extends MYF_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function createAdtSalesPortalProjects()
    {
        $this->load->helper('adt_portal_helper');
        $this->load->model('UserPortalAccount_model');

        $userPortalAccounts = $this->UserPortalAccount_model->getAll();
        foreach($userPortalAccounts as $up){
            $projects = portalSyncProjects($up->user_id, $up->company_id, $up->username, $up->password_plain);
            if( $projects['total_projects'] > 0 ){
                $syncResult = portalUpdateIsSyncProjects($projects['project_ids']);
            }
        }
    }

    public function v1CreateAdtSalesPortalProjectsNonAPI()
    {
        $this->load->helper('adt_portal_helper');
        $this->load->model('UserPortalAccount_model');

        $total_updated = 0;
        $portalUsers = $this->UserPortalAccount_model->getAll();        
        foreach( $portalUsers as $pu ){
            $projectResult = portalSyncProjectsNonAPI($pu->user_id, $pu->company_id, $pu->username, $pu->password_plain);            
            if( $projectResult['total_projects'] > 0 ){
                $updateResult  = portalUpdateIsSyncProjectsNonAPI($projectResult['project_ids']);
                $total_updated += $updateResult['total_updated'];
            }
        }

        echo 'Total Sync projects : ' . $total_updated;
        exit;
    }

    public function createAdtSalesPortalProjectsNonAPI()
    {
        $this->load->helper('adt_portal_helper');
        $this->load->model('UserPortalAccount_model');
        $this->load->model('CustomerSettings_model');
        $this->load->model('AdtSalesSyncLogs_model');

        $total_updated = 0;          
        $enabledCompanies  = $this->CustomerSettings_model->getAllEnabledAdtSyncSetting();
        foreach($enabledCompanies as $c){
            $total_per_company = 0;
            $portalUsers = $this->UserPortalAccount_model->getAllByCompanyId($c->company_id);               
            foreach( $portalUsers as $pu ){
                $projectResult = portalSyncProjectsNonAPI($pu->user_id, $pu->company_id, $pu->username, $pu->password_plain);            
                if( $projectResult['total_projects'] > 0 ){
                    $updateResult  = portalUpdateIsSyncProjectsNonAPI($projectResult['project_ids']);
                    $total_updated += $updateResult['total_updated'];
                    $total_per_company += $updateResult['total_updated'];
                }
            }

            $data = [
                'company_id' => $c->company_id,
                'total_sync' => $total_per_company,
                'date_sync' => date("Y-m-d H:i:s")
            ];

            $this->AdtSalesSyncLogs_model->create($data);
        }
        
        echo 'Total Sync projects : ' . $total_updated;
        exit;
    }

    public function syncDataToAdtSalesPortal()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('AdtPortal_model');
        $this->load->model('AdtSalesSyncLogs_model');

        $conditions[] = ['field' => 'adt_sales_project_id >', 'value' => '0'];
        $customers  = $this->AcsProfile_model->getAllByIsSync(0, $conditions);
        $syncData   = array();
        $total_sync_data = 0;
        foreach( $customers as $c ){
            $adtProject = $this->AdtPortal_model->getByProjectByProjectId($c->adt_sales_project_id);
            if( $adtProject ){
                $adt_data = [
                    'street_address' => $c->mail_add,
                    'city' => $c->city,
                    'state' => $c->state,
                    'postal_code' => $c->zip_code,
                    'homeown_first_name' => $c->first_name,
                    'homeown_email' => $c->email,
                    'homeown_phone' => $c->phone_h,
                    'hoa_phone' => $c->phone_m,
                    'homeown_last_name' => $c->last_name
                ];
                $this->AdtPortal_model->updateProjectByProjectId($c->adt_sales_project_id, $adt_data);
                if( isset($syncData[$c->company_id]) ){
                    $syncData[$c->company_id]['total_sync'] += 1;
                }else{
                    $syncData[$c->company_id]['total_sync'] = 1;
                }

                $this->AcsProfile_model->updateByAdtSalesProjectId($c->adt_sales_project_id, ['is_sync' => 1]);

                $total_sync_data++;
            }
        }

        foreach($syncData as $key => $value){
            $sync_data = [
                'company_id' => $key,
                'total_sync' => $value['total_sync']
            ]; 

            $this->AdtSalesSyncLogs_model->create($sync_data);
        }

        echo 'Total Sync Data : ' . $total_sync_data;
    }

    public function syncGoogleCalendar()
    {
        include APPPATH . 'libraries/google-calendar-api.php';

        $this->load->model('GoogleCalendarSync_model');
        $this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Estimate_model');
        $this->load->model('Tickets_model');
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');
        $this->load->model('GoogleAccounts_model');
        $this->load->model('Users_model');
        $this->load->model('CalendarSettings_model');
        $this->load->model('GoogleCalendar_model');
        $this->load->model('TechnicianDayOffSchedule_model');
        $this->load->helper(array('hashids_helper'));       
        
        $googleSync = $this->GoogleCalendarSync_model->getAllToSync(10);
        $total_sync = 0;
        foreach($googleSync as $gs){                    
            $is_valid = false;
            $err_msg  = '';        
            $all_day_event = 'FIXED-TIME';    
            switch ($gs->module_name) {
                case 'appointment':     
                    $appointment = $this->Appointment_model->getByIdAndCompanyId($gs->object_id, $gs->company_id);
                    if( $appointment ){                                   
                        $tags = '';
                        $location = '';
                        if( $appointment->tag_ids != '' ){
                            $a_tags = explode(",", $appointment->tag_ids);    
                            $e_tags = array();
                            if( $appointment->appointment_type_id == 4 ){ //Events
                                $appointmentTags   = $this->EventTags_model->getAllByIds($a_tags);
                                foreach($appointmentTags as $t){
                                    $e_tags[] = $t->name;
                                }

                                $tags = implode(",", $e_tags);
                            }else{
                                $appointmentTags   = $this->Job_tags_model->getAllByIds($a_tags);
                                foreach($appointmentTags as $t){
                                    $e_tags[] = $t->name;
                                }

                                $tags = implode(",", $e_tags);    
                            }  

                            if( $tags ){
                                $tags = ' - ' . $tags;
                            }
                            
                        }

                        if( $appointment->appointment_type_id == 4 ){
                            $calendar_type  = $this->GoogleCalendar_model->calendarTypeEvent();
                            $calendar_title = $appointment->appointment_number . $tags . ' : ' . $appointment->event_name;
                            if( $appointment->event_location != '' ){
                                $location = $appointment->event_location;
                            }                        
                        }else{
                            $calendar_type  = $this->GoogleCalendar_model->calendarTypeAppointment();
                            $calendar_title = $appointment->appointment_number . $tags . ' : ' . $appointment->customer_name;
                            $location       = $appointment->mail_add . ' ' . $appointment->cust_city . ', ' . $appointment->cust_state . ' ' . $appointment->cust_zip_code;
                        }

                        $start_time     = date("Y-m-d\TH:i:s", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time_from));
                        $end_time     = date("Y-m-d\TH:i:s", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time_to));
                        $event_time = [
                            'start_time' => $start_time,
                            'end_time' => $end_time
                        ];

                        $attendees = array();
                        $assigned_employees = json_decode($appointment->assigned_employee_ids);
                        if( !empty($assigned_employees) ){
                            foreach($assigned_employees as $eid){
                                $user = $this->Users_model->getUserByID($eid);
                                if( $user ){
                                    $attendees[] = ['email' => $user->email];
                                }
                            }
                        }

                        $appointment_eid = hashids_encrypt($appointment->id, '', 15);
                        $view_link       = base_url('appointment/'.$appointment_eid);

                        /*$description  = "<span><b>Customer Name : ".$appointment->customer_name."</b></span><br />";
                        $description .= "<span>Phone Number : ".$appointment->cust_phone."</span><br />";   
                        //$description .= "<span>URL : ".$appointment->url_link."</span><br />";                    
                        $description .= "<span>Location : " . $appointment->mail_add . ' ' . $appointment->cust_city . ', ' . $appointment->cust_state . ' ' . $appointment->cust_zip_code . "</span><br />";
                        $description .= "<span>Notes : ". $appointment->notes ."</span><br />";
                        $description .= "View : <a href='".$view_link."'>".$view_link."</a><br />"; */
                        $description = $appointment->notes ."\n";
                        $description .= $view_link . "\n"; 

                        $is_valid = true;

                    }else{
                        $err_msg = 'Cannot find object data';
                    }
                    break;
                case 'tc-off':
                $calendar_type         = $this->GoogleCalendar_model->calendarTypeTCOff();
                $technicianScheduleOff = $this->TechnicianDayOffSchedule_model->getById($gs->object_id);
                if( $technicianScheduleOff ){
                    $tech_names = array();
                    $technicians_ids = explode(",", $technicianScheduleOff->technician_user_ids);
                    $users = $this->Users_model->getAllByIds($technicians_ids);
                    foreach($users as $u){
                        $tech_names[] = $u->FName . ' ' . $u->LName;
                    }

                    $calendar_title = 'Schedule Off - ' . implode(", ", $tech_names);
                    $start_time     = date("Y-m-d", strtotime($technicianScheduleOff->leave_start_date));
                    $end_time       = date("Y-m-d", strtotime($technicianScheduleOff->leave_end_date));
                    $event_time = [
                        'start_date' => $start_time,
                        'end_date' => $end_time
                    ];

                    $attendees = array();
                    if( $technicianScheduleOff->task_to_user_id != '' ){
                        $user = $this->Users_model->getUserByID($technicianScheduleOff->task_to_user_id);
                        if( $user ){
                            $attendees[] = ['email' => $user->email];
                        }
                    }

                    if( $technicianScheduleOff->technician_user_ids != '' ){
                        $technicians_ids = explode(",", $technicianScheduleOff->technician_user_ids);
                        $users = $this->Users_model->getAllByIds($technicians_ids);
                        foreach($users as $user){
                            $attendees[] = ['email' => $user->email];
                        }
                    }
                    
                    $location  = '';
                    $description = $technicianScheduleOff->task_details;
                    
                    $all_day_event = 'FIXED-DATE';
                    $is_valid = true;
                }
                break;
                case 'event':
                    $calendar_type = $this->GoogleCalendar_model->calendarTypeEvent();
                    $event         = $this->Event_model->get_specific_event($gs->object_id);
                    if( $event ){
                        if( $event->event_tag != '' ){
                            $tags = $event->event_tag;
                        }else{
                            $tags = '---';
                        }

                        $calendar_title = $event->event_number . ' - ' . $tags;
                        $start_time     = date("Y-m-d\TH:i:s", strtotime($event->start_date . ' ' . $event->start_time));
                        $end_time     = date("Y-m-d\TH:i:s", strtotime($event->end_date . ' ' . $event->end_time));
                        $event_time = [
                            'start_time' => $start_time,
                            'end_time' => $end_time
                        ];

                        $attendees = array();
                        if( $event->employee_id != '' ){
                            $user = $this->Users_model->getUserByID($event->employee_id);
                            if( $user ){
                                $attendees[] = ['email' => $user->email];
                            }
                        }

                        $location = $event->event_address;    

                        $description  = "Event Type : ".$event->event_type."\n";
                        $description .= $event->event_address . "\n";
                        $description .= "Event Description : ".$event->event_description."\n";

                        $is_valid = true;
                    }else{
                        $err_msg = 'Cannot find object data';
                    }
                    break;
                case ($gs->module_name == 'service_ticket' || $gs->module_name == 'ticket'):
                    $calendar_type = $this->GoogleCalendar_model->calendarTypeServiceTicket();
                    $ticket = $this->Tickets_model->get_tickets_by_id_and_company_id($gs->object_id, $gs->company_id);
                    if( $ticket ){
                        if( $ticket->job_tag != '' ){
                            $tags = $ticket->job_tag;
                        }else{
                            $tags = '---';
                        }

                        $customer_name  =  $ticket->first_name . ' ' . $ticket->last_name;
                        $calendar_title = $ticket->ticket_no . ' - ' . $tags . ' : ' . $customer_name;
                        $start_time     = date("Y-m-d\TH:i:s", strtotime($ticket->ticket_date . ' ' . $ticket->scheduled_time));
                        $end_time     = date("Y-m-d\TH:i:s", strtotime($ticket->ticket_date . ' ' . $ticket->scheduled_time));
                        $event_time = [
                            'start_time' => $start_time,
                            'end_time' => $end_time
                        ];

                        $techNames = array();
                        $attendees = array();
                        $assigned_employees = unserialize($ticket->technicians);
                        if( !empty($assigned_employees) ){
                            foreach($assigned_employees as $eid){
                                $user = $this->Users_model->getUserByID($eid);
                                if( $user ){
                                    $attendees[] = ['email' => $user->email];
                                    $techNames[] = $user->FName;
                                }
                            }
                        }

                        if( !empty($techNames) ){
                            $calendar_title = $calendar_title . ' - ' . implode("/", $techNames);
                        }

                        $location = $ticket->service_location . ' ' . $ticket->acs_city . ' ' . $ticket->acs_zip;

                        if( $ticket->job_description != '' ){
                            $job_description = $ticket->job_description;
                        }else{
                            $job_description = 'None';
                        }

                        if( $ticket->instructions != '' ){
                            $instructions = strip_tags($ticket->instructions);
                        }else{
                            $instructions = 'None';
                        }

                        //$description  = "Customer Name : ".$ticket->first_name . ' ' . $ticket->last_name."\n";
                        $description = "Phone Number : ".formatPhoneNumber($ticket->customer_phone)."\n";                  
                        $description .= "Service Location : " . $ticket->service_location . "\n";
                        $description .= "Job Description : ". $job_description ."\n";
                        $description .= "Instructions / Notes : ". $instructions ."\n";

                        $is_valid = true;
                    }else{
                        $err_msg = 'Cannot find object data';
                    }
                    break;
                case 'job':
                    $calendar_type = $this->GoogleCalendar_model->calendarTypeJob();
                    $job = $this->Jobs_model->get_specific_job($gs->object_id);
                    if( $job ){
                        if( $job->tags != '' ){
                            $tags = $job->tags;
                        }else{
                            $tags = '---';
                        }

                        $customer_name  = $job->first_name . ' ' . $job->last_name;
                        $calendar_title = $job->job_number.' - '.$tags.' : '.$customer_name;

                        $start_time     = date("Y-m-d\TH:i:s", strtotime($job->start_date . ' ' . $job->start_time));
                        $end_time     = date("Y-m-d\TH:i:s", strtotime($job->end_date . ' ' . $job->end_time));
                        $event_time = [
                            'start_time' => $start_time,
                            'end_time' => $end_time
                        ];

                        $attendees = array();
                        $techNames = array();
                        if( $job->employee_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee_id);
                            if( $user ){
                                $techNames[] = $user->FName;
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( $job->employee2_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee2_id);
                            if( $user ){
                                $techNames[] = $user->FName;
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( $job->employee3_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee3_id);
                            if( $user ){
                                $techNames[] = $user->FName;
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( $job->employee4_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee4_id);
                            if( $user ){
                                $techNames[] = $user->FName;
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( !empty($techNames) ){
                            $calendar_title = $calendar_title . ' - ' . implode("/", $techNames);
                        }

                        $location = $job->mail_add . ' ' . $job->cust_city . ' ' . $job->cust_zip_code;

                        if( $job->hash_id != '' ){
                            $job_eid = $job->hash_id;
                        }else{
                            $job_eid = hashids_encrypt($job->job_unique_id, '', 15);
                            $this->jobs_model->update($job->job_unique_id, ['hash_id' => $job_eid]);
                        }

                        $view_link = base_url('/job_invoice_view/' . $job_eid);
                        
                        if( $job->job_description != '' ){
                            $job_description = $job->job_description;
                        }else{
                            $job_description = 'None';
                        }

                        if( $job->message != '' ){
                            $job_notes = strip_tags($job->message);
                        }else{
                            $job_notes = 'None';
                        }

                        $phone_m = $job->phone_m;
                        if( $job->phone_m == '' ){
                            $phone_m = formatPhoneNumber($job->phone_h);
                        }else{
                            $phone_m = formatPhoneNumber($job->phone_m);
                        }                        

                        //$description  = "Customer Name : ".$job->first_name . ' ' . $job->last_name."\n";
                        //$description .= "Job Type : ".$job->job_type."\n";                
                        $description = "Phone Number : ".$phone_m."\n";                
                        //$description .= "Location : " . $job->mail_add . ' ' . $job->cust_city . ', ' . $job->cust_zip_code . "\n";
                        $description .= "Job Description : ". $job_description ."\n";
                        $description .= "Notes : ". $job_notes ."\n";
                        $description .= $view_link . "\n";

                        $is_valid = true;
                    }else{
                        $err_msg = 'Cannot find object data';
                    }
                    break;
                default:
                    break;
            }

            if( $is_valid ){
                $googleAccount      = $this->GoogleAccounts_model->getByCompanyId($gs->company_id);
                $google_credentials = google_credentials();

                if( $googleAccount ){
                    $capi = new GoogleCalendarApi();
                    $data = $capi->getToken($google_credentials['client_id'], $google_credentials['redirect_url'], $google_credentials['client_secret'], $googleAccount->google_refresh_token);
                    if( $data['access_token'] ){
                        $settings = $this->CalendarSettings_model->getByCompanyId($gs->company_id); 
                        if( $settings ){
                            //$email_minutes = 1440;//1day
                            $email_minutes = 0;
                            if( $settings->google_calendar_email_notification != '' && $settings->google_calendar_email_notification != 'disabled'){
                                $eNotif = explode(" " , $settings->google_calendar_email_notification);
                                if( isset($eNotif[0]) ){
                                    $email_minutes = $eNotif[0];
                                }
                            }

                            //$popup_minutes = 5;
                            $popup_minutes = 0;
                            if( $settings->google_calendar_popup_notification != '' && $settings->google_calendar_popup_notification != 'disabled' ){
                                $pNotif = explode(" " , $settings->google_calendar_popup_notification);
                                if( isset($pNotif[0]) ){
                                    $popup_minutes = $pNotif[0];
                                }
                            }

                            if( $email_minutes > 0 && $popup_minutes > 0 ){
                                $reminders = [
                                    'useDefault' => "FALSE",
                                    'overrides' => [
                                        ['method' => 'email', 'minutes' => $email_minutes],
                                        ['method' => 'popup', 'minutes' => $popup_minutes]
                                    ]
                                ];    
                            }elseif( $email_minutes > 0 ){
                                $reminders = [
                                    'useDefault' => "FALSE",
                                    'overrides' => [
                                        ['method' => 'email', 'minutes' => $email_minutes]
                                    ]
                                ];
                            }elseif( $popup_minutes > 0 ){
                                $reminders = [
                                    'useDefault' => "FALSE",
                                    'overrides' => [
                                        ['method' => 'popup', 'minutes' => $popup_minutes]
                                    ]
                                ];
                            }
                        }/*else{
                            $reminders = [
                                'useDefault' => "FALSE",
                                'overrides' => [
                                    ['method' => 'email', 'minutes' => 24 * 60],
                                    ['method' => 'popup', 'minutes' => 5]
                                ]
                            ];    
                        }*/

                        $user_timezone = $capi->getUserCalendarTimezone($data['access_token']);
                        $googleCalendar = $this->GoogleCalendar_model->getByCompanyIdAndCalendarType($gs->company_id, $calendar_type);
                        if( $googleCalendar ){
                          $event_id  = $capi->createCalendarEvent($googleCalendar->calendar_id, $calendar_title, $all_day_event, $event_time, $user_timezone, $attendees, $location, $reminders, $description, $data['access_token']);
                        }else{
                            $is_valid = false;
                        }

                        if( $is_valid ){
                            $googleSyncData = [
                                'is_sync' => 1,
                                'error_msg' => '',
                                'is_with_error' => 0,
                                'date_sync' => date("Y-m-d H:i:s")
                            ];

                            $total_sync++;
                        }else{
                            $googleSyncData = [
                                'is_sync' => 0,
                                'error_msg' => 'Cannot sync data. Please check google credentials',
                                'is_with_error' => 1,
                                'date_sync' => date("Y-m-d H:i:s")
                            ];
                        }
                        
                    }else{
                        $googleSyncData = [
                            'is_sync' => 0,
                            'error_msg' => 'Cannot find valid google account',
                            'is_with_error' => 1,
                            'date_sync' => date("Y-m-d H:i:s")
                        ];
                    }  

                    $this->GoogleCalendarSync_model->update($gs->id,$googleSyncData);
                }else{
                    $googleSyncData = [
                        'is_sync' => 0,
                        'error_msg' => 'Cannot find valid google account',
                        'is_with_error' => 1,
                        'date_sync' => date("Y-m-d H:i:s")
                    ];

                    $this->GoogleCalendarSync_model->update($gs->id,$googleSyncData);
                }                
            }else{
                $googleSyncData = [
                    'is_sync' => 0,
                    'error_msg' => $err_msg,
                    'is_with_error' => 1,
                    'date_sync' => date("Y-m-d H:i:s")
                ];

                $this->GoogleCalendarSync_model->update($gs->id,$googleSyncData);
            }
        }

        echo 'Total Sync : ' . $total_sync;
    }
        
}