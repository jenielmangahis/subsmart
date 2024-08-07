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
        $this->load->model('JobTags_model');
        $this->load->model('Workorder_model');
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
                            $location       = $appointment->mail_add . ',  ' . $appointment->cust_city . ', ' . $appointment->cust_zip_code;
                        }

                        $start_time     = date("Y-m-d\TH:i:s", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time_from));
                        $end_time     = date("Y-m-d\TH:i:s", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time_to));
                        $event_time = [
                            'start_time' => $start_time,
                            'end_time' => $end_time
                        ];

                        $techNames = array();
                        $attendees = array();
                        $assigned_employees = json_decode($appointment->assigned_employee_ids);
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
                    $end_time       = date("Y-m-d", strtotime($technicianScheduleOff->leave_end_date .' +1 day'));
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
                        $end_time       = date("Y-m-d\TH:i:s", strtotime($event->end_date . ' ' . $event->end_time));
                        $event_time = [
                            'start_time' => $start_time,
                            'end_time' => $end_time
                        ];

                        $attendees = array();
                        if( $event->employee_id != '' ){
                            $attendees = json_decode($event->employee_id);
                            foreach($attendees as $uid){
                                $user = $this->Users_model->getUserByID($uid);
                                if( $user ){
                                    $attendees[] = ['email' => $user->email];
                                }
                            }                            
                        }

                        $location = $event->event_address;    

                        $description  = "Event Type : ".$event->event_type."\n";                        
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

                        $location = $ticket->service_location . ',  ' . $ticket->acs_city . ', ' . $ticket->acs_zip;

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
                        /*if( $job->employee_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee_id);
                            if( $user ){
                                $techNames[] = $user->FName;
                                $attendees[] = ['email' => $user->email];
                            }
                        }*/
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

                        $location = $job->mail_add . ',  ' . $job->cust_city . ', ' . $job->cust_zip_code;

                        if( $job->hash_id != '' ){
                            $job_eid = $job->hash_id;
                        }else{
                            $job_eid = hashids_encrypt($job->job_unique_id, '', 15);
                            $this->Jobs_model->update($job->job_unique_id, ['hash_id' => $job_eid]);
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
                case 'workorder':
                    $calendar_type = $this->GoogleCalendar_model->calendarTypeJob();                    
                    $workorder     = $this->Workorder_model->getworkorder($gs->object_id);
                    $job           = $this->Jobs_model->get_specific_job_by_work_order_id($gs->object_id);
                    if( $workorder && $job ){
                        $tags = '---';
                        if( $workorder->job_tags > 0 ){
                            $jobTag = $this->JobTags_model->getById($workorder->job_tags);
                            if( $jobTag ){
                                $tags = $jobTag->name;
                            }                    
                        }

                        $customer_name  = $workorder->acs_first_name . ' ' . $workorder->acs_last_name;
                        $calendar_title = $workorder->work_order_number.' - '.$tags.' : '.$customer_name;

                        $start_time     = date("Y-m-d\TH:i:s", strtotime($job->start_date . ' ' . $job->start_time));
                        $end_time     = date("Y-m-d\TH:i:s", strtotime($job->end_date . ' ' . $job->end_time));
                        $event_time = [
                            'start_time' => $start_time,
                            'end_time' => $end_time
                        ];

                        $attendees = array();
                        $techNames = array();

                        if( $workorder->employee_id != '' ){
                            $user = $this->Users_model->getUserByID($workorder->employee_id);
                            if( $user ){
                                $techNames[] = $user->FName;
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( !empty($techNames) ){
                            $calendar_title = $calendar_title . ' - ' . implode("/", $techNames);
                        }

                        $location = $workorder->acs_mail_add . ',  ' . $workorder->acs_city . ', ' . $workorder->acs_zipcode;
                        

                        //$view_link = base_url('/job_invoice_view/' . $job_eid);
                        
                        if( $workorder->comments != '' ){
                            $workorder_comments = $workorder->comments;
                        }else{
                            $workorder_comments = 'None';
                        }

                        $phone_m = formatPhoneNumber($workorder->acs_phone_m);
                        if( $workorder->acs_phone_m == '' ){
                            $phone_m = formatPhoneNumber($workorder->acs_phone_h);
                        }                        
                        
                        $description = "Phone Number : ".$phone_m."\n";                                        
                        $description .= "Workorder Comments : ". $workorder_comments ."\n";
                        
                        //$description .= $view_link . "\n";

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
                            if( $gs->g_event_id != '' ){                                
                                $event_id  = $capi->updateCalendarEvent($gs->g_event_id, $googleCalendar->calendar_id, $calendar_title, $all_day_event, $event_time, $user_timezone, $attendees, $location, $reminders, $description, $data['access_token']);                          
                                if( $event_id == '' ){
                                    $is_valid = false;
                                }
                            }else{
                                $event_id  = $capi->createCalendarEvent($googleCalendar->calendar_id, $calendar_title, $all_day_event, $event_time, $user_timezone, $attendees, $location, $reminders, $description, $data['access_token']);                          
                                if( $event_id == '' ){
                                    $is_valid = false;
                                }
                            }                            
                        }else{
                            $is_valid = false;
                        }

                        if( $is_valid ){
                            $googleSyncData = [
                                'g_event_id' => $event_id,
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

    public function syncGoogleContacts()
    {
        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $this->load->model('CompanyApiConnector_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('GoogleContactLogs_model');

        $total_records = 0;

        $filter['search'][] = ['field' => 'is_with_error', 'value' => 0];
        $googleContactLogs = $this->GoogleContactLogs_model->getAllNotSync($filter, 10);
        foreach( $googleContactLogs as $log ){
            $is_sync = 0;
            $company_id = $log->company_id;
            $companyGoogleContactsApi = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'google_contacts');
            if( $companyGoogleContactsApi && $companyGoogleContactsApi->google_access_token != '' ){            
                $customer = $this->AcsProfile_model->getCustomerBasicInfoByProfIdAndCompanyId($log->object_id, $company_id);
                if( $customer ){
                    //Set Client
                    $google_credentials = google_credentials();
                    $client = new Google_Client();
                    $client->setClientId($google_credentials['client_id']);
                    $client->setClientSecret($google_credentials['client_secret']);                    
                    $client->refreshToken($companyGoogleContactsApi->google_refresh_token);
                    $access_token = $client->getAccessToken();
                    $client->setAccessToken($access_token);                    
                    $client->setScopes(array(
                        'email',
                        'profile',
                        'https://www.googleapis.com/auth/contacts',
                    ));
                    $client->setApprovalPrompt('force');
                    $client->setAccessType('offline');

                    try {                    
                        $service = new Google_Service_PeopleService($client);            
                        $person  = new Google_Service_PeopleService_Person();

                        $email   = new Google_Service_PeopleService_EmailAddress();
                        $email->setValue($customer->email);
                        $person->setEmailAddresses($email);

                        $customer_name = $customer->first_name . ' ' . $customer->last_name;
                        $name = new Google_Service_PeopleService_Name();
                        $name->setDisplayName($customer_name);
                        $person->setNames($name);

                        if( $customer->phone_m != '' ){
                            $phoneNumber = new Google_Service_People_PhoneNumber();
                            $phoneNumber->setType('mobile');
                            $phoneNumber->setValue(formatPhoneNumber($customer->phone_m));
                            $person->setPhoneNumbers($phoneNumber);    
                        }                    

                        $gc = $service->people->createContact($person);
                        $is_sync = 1;

                        $data_logs = [                            
                            'google_contact_id' => $gc->resourceName,                            
                            'action_date' => date("Y-m-d H:i:s"),
                            'is_with_error' => 0,
                            'is_sync' => 1,
                            'error_message' => ''
                        ];

                        $this->GoogleContactLogs_model->update($log->id, $data_logs);

                    } catch (Exception $e) {
                        $is_sync   = 0;
                        $data_logs = [
                            'is_with_error' => 1,                            
                            'error_message' => $e->getMessage()
                        ];

                        $this->GoogleContactLogs_model->update($log->id, $data_logs);
                    }
                }

                //Update google contacts api 
                if( $is_sync == 1 ){
                    $data_google_contacts = [                        
                        //'google_contacts_total_imported' => $companyGoogleContactsApi->google_contacts_total_imported + 1,                        
                        'google_last_sync' => date("Y-m-d H:i:s"),                
                    ];
                }else{
                    $data_google_contacts = [                        
                        'google_contacts_total_imported' => $companyGoogleContactsApi->google_contacts_total_imported - 1,                        
                        'google_contacts_total_failed' => $companyGoogleContactsApi->google_contacts_total_failed + 1,
                        'google_last_sync' => date("Y-m-d H:i:s"),                
                    ];
                }
                
                $this->CompanyApiConnector_model->update($companyGoogleContactsApi->id, $data_google_contacts);
            }

            $total_records++;
        }

        echo "Total Updated : " . $total_records;
    }

    public function exportCustomerMailChimpList()
    {
        $this->load->model('CompanyApiConnector_model');
        $this->load->model('MailChimpExportCustomerLogs_model');
        $this->load->library('MailChimpApi');

        $total_exported = 0;
        $exportMailChimpData = $this->MailChimpExportCustomerLogs_model->getAllNotSync(10);
        foreach( $exportMailChimpData as $mc ){            
            if( $mc->customer_email != '' ){
                $companyApiConnector = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($mc->company_id, 'mailchimp');
                if( $companyApiConnector ){
                    $list_id = $mc->mailchimp_list_id;
                    $customer_address = unserialize($mc->customer_address);                                        
                    $customer_info = [
                        "email_address" => $mc->customer_email,
                        "status" => $mc->mailchimp_status,
                        "merge_fields" => [
                            "FNAME" => $mc->customer_firstname,
                            "LNAME" => $mc->customer_lastname,
                            "PHONE" => $mc->customer_phone,
                            "ADDRESS" => [
                                 "addr1" => $customer_address['address'],
                                  "city" => $customer_address['city'],
                                  "state" => $customer_address['state'],
                                  "zip" => $customer_address['zip']
                            ]
                        ]                        
                    ];   
                    
                    $mailChimp = new MailChimpApi;
                    $response  = $mailChimp->addMemberToList($list_id, $customer_info, $companyApiConnector->mailchimp_access_token, $companyApiConnector->mailchimp_server_prefix);
                    if( $response->id ){
                        $data_mailchimp_logs = [
                            'mailchimp_id' => $response->id,
                            'mailchimp_hash_id' => $response->unique_email_id,
                            'is_sync' => 1,
                            'is_with_error' => 0,
                            'error_message' => '',
                            'action_date' => date("Y-m-d H:i:s")
                        ];
                        $total_exported++;
                    }else{                          
                        $data_mailchimp_logs = [
                            'mailchimp_hash_id' => 0,
                            'mailchimp_email_id' => 0,
                            'is_sync' => 0,
                            'is_with_error' => 1,
                            'error_message' => $response['error'],
                            'action_date' => date("Y-m-d H:i:s")
                        ];
                    }
                    $this->MailChimpExportCustomerLogs_model->update($mc->id, $data_mailchimp_logs);
                }                
            }               
        }

        echo 'Total Exported : ' . $total_exported;
    }

    public function syncQbPayrollEmployees()
    {
        $this->load->library('QuickbooksApi');
        $this->load->model('CompanyApiConnector_model');
        $this->load->model('QbImportEmployeeLogs_model');
        $this->load->model('Users_model');

        $total_imported    = 0;
        $importEmployeeLogs = $this->QbImportEmployeeLogs_model->getAllNotSync(5);
        foreach($importEmployeeLogs as $logs){
            $user = $this->Users_model->getUserByID($logs->user_id);
            if( $user ){                        
                $companyQuickBooksPayroll = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($logs->company_id,'quickbooks_payroll'); 
                if( $companyQuickBooksPayroll ){
                    $token = $this->quickbooksapi->refresh_token($companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id); 

                    //Update company refresh token
                    $data_quickbooks['qb_payroll_refresh_token'] = $token->getRefreshToken();
                    $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_quickbooks);

                    $user_data = [
                        "GivenName" => $user->FName,
                        "SSN" => "",
                        "PrimaryAddr" => [
                            "CountrySubDivisionCode" => $user->state,
                            "City" => $user->city,
                            "PostalCode" => $user->postal_code,
                        ],
                        "PrimaryPhone" => ["FreeFormNumber" =>  formatPhoneNumber($user->mobile)],
                        "FamilyName" => $user->LName
                    ];
                    $qb_employee = $this->quickbooksapi->create_employee($user_data, $token->getAccessToken(), $companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id);

                    if( $qb_employee['is_imported'] ){                                                                
                        $data_qb_employee_log = [
                            'qb_user_id' => $qb_employee['qb_user_id'],
                            'name' => $user->FName . ' ' . $user->LName,
                            'is_sync' => 1,
                            'is_with_error' => 0,
                            'error_message' => '',
                            'action_date' => date("Y-m-d H:i:s")
                        ];                        

                        $data_qb_sync_summary = [
                            'qb_total_employee_synced' => $companyQuickBooksPayroll->qb_total_employee_synced + 1
                        ];
                        $total_imported++;
                    }else{                              
                        if( $qb_employee['err_code'] == 6240 || $qb_employee['err_code'] == 400){                            
                            $a_err_details = explode(':', $qb_employee['err_msg']);
                            if( isset($a_err_details[1]) ){
                                $qb_id = trim(str_replace('Id=', "", $a_err_details[1]));
                                $qb_id = (int)$qb_id;
                                if( $qb_id > 0 ){
                                    $data_qb_employee_log = [
                                        'qb_user_id' => $qb_id,
                                        'name' => $user->FName . ' ' . $user->LName,
                                        'is_sync' => 1,
                                        'is_with_error' => 0,
                                        'error_message' => '',
                                        'action_date' => date("Y-m-d H:i:s")
                                    ];  

                                    $data_qb_sync_summary = [
                                        'qb_total_employee_synced' => $companyQuickBooksPayroll->qb_total_employee_synced + 1
                                    ];
                                    $total_imported++;  
                                }else{
                                    $data_qb_employee_log = [
                                        'qb_user_id' => 0,
                                        'is_sync' => 0,
                                        'is_with_error' => 1,
                                        'error_message' => $qb_employee['err_msg'],                            
                                        'action_date' => date("Y-m-d H:i:s")
                                    ];   

                                    $data_qb_sync_summary = [
                                        'qb_total_employee_failed_synced' => $companyQuickBooksPayroll->qb_total_employee_failed_synced + 1
                                    ]; 
                                }
                            }
                            
                        }else{
                            $data_qb_employee_log = [
                                'qb_user_id' => 0,
                                'is_sync' => 0,
                                'is_with_error' => 1,
                                'error_message' => $qb_employee['err_msg'],                            
                                'action_date' => date("Y-m-d H:i:s")
                            ];   

                            $data_qb_sync_summary = [
                                'qb_total_employee_failed_synced' => $companyQuickBooksPayroll->qb_total_employee_failed_synced + 1
                            ];    
                        }                                       
                        
                    }

                    $this->QbImportEmployeeLogs_model->update($logs->id,$data_qb_employee_log);
                    $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_qb_sync_summary);   
                }
            } 
        }

        echo $total_imported;
        
    }

    public function syncQbPayrollTimesheet()
    {
        $this->load->library('QuickbooksApi');
        $this->load->model('CompanyApiConnector_model');
        $this->load->model('QbImportEmployeeLogs_model');
        $this->load->model('QbImportTimesheetLogs_model');
        $this->load->model('Users_model');

        $total_imported    = 0;
        $importTimesheetLogs = $this->QbImportTimesheetLogs_model->getAllNotSync(10);
        foreach($importTimesheetLogs as $logs){
            $qbEmployee = $this->QbImportEmployeeLogs_model->getByUserId($logs->user_id);
            if( $qbEmployee ){
                $companyQuickBooksPayroll = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($logs->company_id,'quickbooks_payroll');
                if( $companyQuickBooksPayroll ){
                    if( $qbEmployee->qb_user_id > 0 ){
                        $token = $this->quickbooksapi->refresh_token($companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id); 
                        //Update company refresh token
                        $data_quickbooks['qb_payroll_refresh_token'] = $token->getRefreshToken();                        
                        $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_quickbooks);

                        $attendance_start_date = date('Y-m-d\TH:i:s', strtotime($logs->start_date . ' ' . $logs->start_time));
                        $attendance_end_date   = date('Y-m-d\TH:i:s', strtotime($logs->end_date . ' ' . $logs->end_time));
                        
                        /*$timesheet_data = [
                            "NameOf" => "Employee",
                            "EmployeeRef" => [
                                "value" => $qbEmployee->qb_user_id,
                                "name" => $qbEmployee->name
                            ],
                            "StartTime" => $attendance_start_date,
                            "EndTime" => $attendance_end_date,
                            "BillableStatus" => $logs->billable_status,
                            "Taxable" => $logs->taxable == 1 ? true : false,
                            "HourlyRate" => $logs->hourly_rate,
                            "Description"=> $logs->description
                        ];*/

                        $timesheet_data = [
                            "NameOf" => "Employee",
                            "EmployeeRef" => [
                                "value" => $qbEmployee->qb_user_id,
                                "name" => $qbEmployee->name
                            ],
                            'TxnDate' => date("Y-m-d", strtotime($logs->start_date)),
                            "StartTime" => $logs->start_time,
                            "EndTime" => $logs->end_time,
                            "BillableStatus" => $logs->billable_status,
                            "Taxable" => $logs->taxable == 1 ? true : false,
                            "HourlyRate" => $logs->hourly_rate,
                            "Description"=> $logs->description
                        ];

                        $qb_timesheet = $this->quickbooksapi->create_timesheet($timesheet_data, $token->getAccessToken(), $companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id);        
                        if( $qb_timesheet['is_imported'] ){
                            $data_qb_timesheet_log = [
                                'qb_timesheet_id' => $qb_timesheet['qb_timesheet_id'],
                                'qb_user_id' => $qbEmployee->qb_user_id,
                                'qb_employee_name' => $qbEmployee->name,
                                'is_sync' => 1,
                                'is_with_error' => 0,
                                'error_message' => '',
                                'action_date' => date("Y-m-d H:i:s")
                            ];   

                            $data_qb_sync_summary = [
                                'qb_total_attendance_synced' => $companyQuickBooksPayroll->qb_total_attendance_synced + 1
                            ];

                            $total_imported++;

                        }else{
                            $data_qb_timesheet_log = [
                                'qb_timesheet_id' => 0,
                                'is_sync' => 0,
                                'is_with_error' => 1,
                                'error_message' => $qb_timesheet['err_msg'],
                                'action_date' => date("Y-m-d H:i:s")
                            ];   

                            $data_qb_sync_summary = [
                                'qb_total_attendance_failed_synced' => $companyQuickBooksPayroll->qb_total_attendance_failed_synced + 1
                            ];
                        }
                    }else{
                        $data_qb_timesheet_log = [
                            'is_sync' => 0,
                            'is_with_error' => 1,
                            'error_message' => 'Cannot find employee in QuickBooks',
                            'action_date' => date("Y-m-d H:i:s")
                        ];
                    }

                    $this->QbImportTimesheetLogs_model->update($logs->id,$data_qb_timesheet_log);
                    $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_qb_sync_summary);  

                }else{
                    $qb_timesheet = [
                        'is_sync' => 0,
                        'is_with_error' => 1,
                        'error_message' => 'Cannot find QuickBooks account',
                        'action_date' => date("Y-m-d H:i:s")
                    ];

                    $this->QbImportTimesheetLogs_model->update($logs->id,$qb_timesheet);
                } 
                               
            }else{
                $qb_timesheet = [
                    'is_sync' => 0,
                    'is_with_error' => 1,
                    'error_message' => 'Cannot find employee in QuickBooks',
                    'action_date' => date("Y-m-d H:i:s")
                ];

                $this->QbImportTimesheetLogs_model->update($logs->id,$qb_timesheet);
            }
        }
        echo $total_imported;        
    }

    public function activeCampaignCustomerExport()
    {
        $this->load->library('ActiveCampaignApi');
        $this->load->model('CompanyApiConnector_model');        
        $this->load->model('ActiveCampaignExportCustomerLogs_model');

        $customerExport = $this->ActiveCampaignExportCustomerLogs_model->getAllNotSync(10);
        $total_exported = 0;
        foreach( $customerExport as $customer ){  
            $companyActiveCampaign = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($customer->company_id,'active_campaign');                  
            if( $companyActiveCampaign  && $companyActiveCampaign->status == 1 ){
                $company_total_exported = $companyActiveCampaign->active_campaign_customer_total_exported;
                $company_total_failed   = $companyActiveCampaign->active_campaign_customer_total_failed;

                if( $customer->customer_email != '' ){                                
                    $customer_phone = '';
                    if( $customer->customer_phone != '' ){
                        $customer_phone = formatPhoneNumber($customer->customer_phone);
                    }     

                    $export_data = [
                        'contact' => [
                            'email' => $customer->customer_email,
                            'firstName' => $customer->customer_firstname,
                            'lastName' => $customer->customer_lastname,
                            'phone' => $customer_phone
                        ]            
                    ];

                    $activeCampaign = new ActiveCampaignApi;
                    $export_result  = $activeCampaign->createContact($companyActiveCampaign->active_campaign_account_url, $companyActiveCampaign->active_campaign_token, $export_data);
                    if( $export_result['data'] ){
                        $export_customer = [
                            'active_campaign_customer_id' => $export_result['data']->contact->id,
                            'active_campaign_customer_hash' => $export_result['data']->contact->hash,                            
                            'is_sync' => 1,
                            'is_with_error' => 0,
                            'error_message' => '',
                            'action_date' => date("Y-m-d H:i:S")
                        ];                        

                        $company_total_exported++;
                        $total_exported++;
                    }else{
                        if( $export_result['error_message'] == 'Email address already exists in the system.' ){
                            $query = ['email' => $customer->customer_email];
                            $activeCampaignContact  = $activeCampaign->getContact($query, $companyActiveCampaign->active_campaign_account_url, $companyActiveCampaign->active_campaign_token, $export_data);
                            if( $activeCampaignContact['contacts']->contacts[0] ){
                                $export_customer = [
                                    'active_campaign_customer_id' => $activeCampaignContact['contacts']->contacts[0]->id,
                                    'active_campaign_customer_hash' => $activeCampaignContact['contacts']->contacts[0]->hash,                            
                                    'is_sync' => 1,
                                    'is_with_error' => 0,
                                    'error_message' => '',
                                    'action_date' => date("Y-m-d H:i:S")
                                ];                        

                                $company_total_exported++;
                                $total_exported++;
                            }else{
                                $export_customer = [                            
                                    'is_sync' => 0,
                                    'is_with_error' => 1,
                                    'error_message' => $export_result['error_message'],
                                    'action_date' => date("Y-m-d H:i:S")
                                ];

                                $company_total_failed++;  
                            }
                        }else{
                            $export_customer = [                            
                                'is_sync' => 0,
                                'is_with_error' => 1,
                                'error_message' => $export_result['error_message'],
                                'action_date' => date("Y-m-d H:i:S")
                            ];

                            $company_total_failed++;
                        }                        
                    }

                    $this->CompanyApiConnector_model->update($companyActiveCampaign->id,['active_campaign_customer_total_exported' => $company_total_exported, 'active_campaign_customer_total_failed' => $company_total_failed]);
                    $this->ActiveCampaignExportCustomerLogs_model->update($customer->id, $export_customer);                
                }else{
                    $export_customer = [                            
                        'is_sync' => 0,
                        'is_with_error' => 1,
                        'error_message' => 'Invalid email',
                        'action_date' => date("Y-m-d H:i:S")
                    ];

                    $company_total_failed++;

                    $this->CompanyApiConnector_model->update($companyActiveCampaign->id,['active_campaign_customer_total_failed' => $company_total_failed]);
                    $this->ActiveCampaignExportCustomerLogs_model->update($customer->id, $export_customer);
                }
            }            
        }

        echo 'Total Exported : ' . $total_exported;
    }

    public function activeCampaignListAutomationExport()
    {
        $this->load->library('ActiveCampaignApi');
        $this->load->model('CompanyApiConnector_model');        
        $this->load->model('ActiveCampaignExportListAutomationLogs_model');
        $this->load->model('ActiveCampaignExportCustomerLogs_model');

        $total_exported = 0;

        $listAutomationExport = $this->ActiveCampaignExportListAutomationLogs_model->getAllNotSync(10);
        foreach( $listAutomationExport as $listAutomation ){
            $customerExportData     = $this->ActiveCampaignExportCustomerLogs_model->getByCustomerId($listAutomation->customer_id);
            $companyActiveCampaign  = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($listAutomation->company_id,'active_campaign'); 
            if( $customerExportData && ($companyActiveCampaign && $companyActiveCampaign->status == 1) ){

                $company_total_list_exported = $companyActiveCampaign->active_campaign_list_total_exported;
                $company_total_list_failed   = $companyActiveCampaign->active_campaign_list_total_failed;

                $company_total_automation_exported = $companyActiveCampaign->active_campaign_automation_total_exported;
                $company_total_automation_failed   = $companyActiveCampaign->active_campaign_automation_total_failed;

                if( $customerExportData->is_sync == 1 && $customerExportData->active_campaign_customer_id > 0 ){

                    $activeCampaign = new ActiveCampaignApi;                    
                    if( $listAutomation->type == $this->ActiveCampaignExportListAutomationLogs_model->typeAutomation() ){
                        $contactAutomation = [
                            'contactAutomation' => [
                                'automation' => $listAutomation->object_id,
                                'contact' => $customerExportData->active_campaign_customer_id
                            ]            
                        ];
                        $automationList = $activeCampaign->addContactToAutomation($companyActiveCampaign->active_campaign_account_url, $companyActiveCampaign->active_campaign_token, $contactAutomation);
                        if( $automationList['error_message'] == '' ){
                            $export_list_automation = [
                                'active_campaign_id' => $automationList['data']->contactAutomation->id,
                                'is_sync' => 1,
                                'is_with_error' => 0,
                                'error_message' => '',
                                'action_date' => date("Y-m-d H:i:s")
                            ];
                            $total_exported++;
                            $company_total_automation_exported++;

                        }else{
                            $export_list_automation = [
                                'is_sync' => 0,
                                'is_with_error' => 1,
                                'error_message' => $contactList['error_message'],
                                'action_date' => date("Y-m-d H:i:s")
                            ];
                            $company_total_automation_failed++;
                        }
                    }else{
                        $contactList = [
                            'contactList' => [
                                'list' => $listAutomation->object_id,
                                'contact' => $customerExportData->active_campaign_customer_id,
                                'status' => 1                
                            ]            
                        ];
                        $contactList = $activeCampaign->addContactToList($companyActiveCampaign->active_campaign_account_url, $companyActiveCampaign->active_campaign_token, $contactList);  
                        if( $contactList['error_message'] == '' ){
                            $export_list_automation = [
                                'active_campaign_id' => $contactList['data']->contactList->id,
                                'is_sync' => 1,
                                'is_with_error' => 0,
                                'error_message' => '',
                                'action_date' => date("Y-m-d H:i:s")
                            ];
                            $total_exported++;
                            $company_total_list_exported++;
                        }else{
                            $export_list_automation = [
                                'is_sync' => 0,
                                'is_with_error' => 1,
                                'error_message' => $contactList['error_message'],
                                'action_date' => date("Y-m-d H:i:s")
                            ];
                            $company_total_list_failed++;
                        }  
                    }
                }else{
                    if( $listAutomation->type == $this->ActiveCampaignExportListAutomationLogs_model->typeAutomation() ){
                        $company_total_automation_failed++;
                    }else{
                        $company_total_list_failed++;
                    }

                    $export_list_automation = [
                        'is_sync' => 0,
                        'is_with_error' => 1,
                        'error_message' => 'Customer not found in your Active Campaign Account',
                        'action_date' => date("Y-m-d H:i:s")
                    ];
                }

                $data_company_api_connector = [
                    'active_campaign_list_total_exported' => $company_total_list_exported,
                    'active_campaign_list_total_failed' => $company_total_list_failed,
                    'active_campaign_automation_total_exported' => $company_total_automation_exported,
                    'active_campaign_automation_total_failed' => $company_total_automation_failed,
                ];

                $this->CompanyApiConnector_model->update($companyActiveCampaign->id,$data_company_api_connector);
                $this->ActiveCampaignExportListAutomationLogs_model->update($listAutomation->id, $export_list_automation);
            }
        }

        echo 'Total Exported : ' . $total_exported;
    }

    public function renewAllSquareToken()
    {
        $this->load->helper('square_helper');
        $this->load->model('CompanyOnlinePaymentAccount_model');

        $squareAccounts = $this->CompanyOnlinePaymentAccount_model->getAllSquareAccounts();

        $total_updated = 0;
        foreach($squareAccounts as $square){
            $refresh_token  = 'EQAAEFDeZngEdy2UWmjReuOsiw_7vjFZewm4mdHKCazPF3opFRy1cguuAqLL79E3';
            $result = renewToken($refresh_token);
            if( property_exists($result, 'access_token') ){
                $data = [
                    'square_access_token' => $result->access_token,
                    'square_refresh_token' => $result->refresh_token
                ];

                $this->CompanyOnlinePaymentAccount_model->update($square->id, $data);
                $total_updated++;
            }
        }

        echo 'Total Updated : ' . $total_updated;
    }        
}
