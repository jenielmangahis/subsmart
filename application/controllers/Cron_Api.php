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
        
        $googleSync = $this->GoogleCalendarSync_model->getAllToSync(10);

        foreach($googleSync as $gs){            
            $is_valid   = false;
            switch ($gs->module_name) {
                case 'appointment':                
                    $appointment = $this->Appointment_model->getByIdAndCompanyId($gs->object_id, $gs->company_id);
                    if( $appointment ){               
                        $tags = '---';
                        if( $appointment->tag_ids != '' ){
                            $a_tags = explode(",", $appointment->tag_ids);     
                            $appointmentTags   = $this->Job_tags_model->getAllByIds($a_tags);
                            foreach($appointmentTags as $t){
                                $e_tags[] = $t->name;
                            }

                            $tags = implode(",", $e_tags);
                        }

                        $calendar_title = $appointment->appointment_number . ' - ' . $tags . ' : ' . $appointment->customer_name;
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

                        $location = $appointment->mail_add . ' ' . $appointment->cust_city . ', ' . $appointment->cust_state . ' ' . $appointment->cust_zip_code;

                        $description  = "<span><b>Customer Name : ".$appointment->customer_name."</b></span><br />";
                        $description .= "<span>Phone Number : ".$appointment->cust_phone."</span><br />";   
                        $description .= "<span>URL : ".$appointment->url_link."</span><br />";                    
                        $description .= "<span>Location : " . $appointment->mail_add . ' ' . $appointment->cust_city . ', ' . $appointment->cust_state . ' ' . $appointment->cust_zip_code . "</span><br />";
                        $description .= "<span>Notes : ". $appointment->notes ."</span><br />";

                        $is_valid = true;

                    }
                    break;
                case 'event':
                    $event = $this->Event_model->get_specific_event($gs->object_id);
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

                        $description  = "<span><b>Event Type : ".$event->event_type."</b></span><br />";
                        $description .= "<span>" . $event->event_address . "</span><br />";
                        $description  = "<span>Event Description : ".$event->event_description."</span><br />";

                        $is_valid = true;
                    }
                    break;
                case 'service_ticket':
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

                        $attendees = array();
                        $assigned_employees = unserialize($ticket->technicians);
                        if( !empty($assigned_employees) ){
                            foreach($assigned_employees as $eid){
                                $user = $this->Users_model->getUserByID($eid);
                                if( $user ){
                                    $attendees[] = ['email' => $user->email];
                                }
                            }
                        }

                        $location = $ticket->acs_city . ', ' . $ticket->acs_state . ' ' . $ticket->acs_zip;

                        $description  = "<span><b>Customer Name : ".$ticket->first_name . ' ' . $ticket->last_name."</b></span><br />";
                        $description .= "<span>Phone Number : ".$ticket->phone_m."</span><br />";                  
                        $description .= "<span>Service Location : " . $ticket->service_location . "</span><br />";
                        $description .= "<span>Notes : ". $appointment->notes ."</span><br />";

                        $is_valid = true;
                    }
                    break;
                case 'job':
                    $job = $this->Jobs_model->get_specific_job($gs->object_id);
                    if( $job ){
                        if( $job->tags != '' ){
                            $tags = $j->tags;
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
                        if( $job->e_employee_id != '' ){
                            $user = $this->Users_model->getUserByID($job->e_employee_id);
                            if( $user ){
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( $job->employee2_employee_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee2_employee_id);
                            if( $user ){
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( $job->employee3_employee_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee3_employee_id);
                            if( $user ){
                                $attendees[] = ['email' => $user->email];
                            }
                        }
                        if( $job->employee4_employee_id != '' ){
                            $user = $this->Users_model->getUserByID($job->employee4_employee_id);
                            if( $user ){
                                $attendees[] = ['email' => $user->email];
                            }
                        }

                        $location = $job->mail_add . ' ' . $job->cust_city . ', ' . $job->cust_state . ' ' . $job->cust_zip_code;

                        $description  = "<span><b>Customer Name : ".$job->first_name . ' ' . $job->last_name."</b></span><br />";
                        $description .= "<span>Job Type : ".$job->job_type."</span><br />";                
                        $description .= "<span>Phone Number : ".$job->cust_phone."</span><br />";                
                        $description .= "<span>Location : " . $job->mail_add . ' ' . $job->cust_city . ', ' . $job->cust_state . ' ' . $job->cust_zip_code . "</span><br />";

                        $is_valid = true;
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
                        $settings = $this->CalendarSettings_model->getByCompanyId($company_id); 
                        if( $settings ){
                            $email_minutes = 1440;//1day
                            if( $settings->google_calendar_email_notification != '' ){
                                $eNotif = explode(" " , $settings->google_calendar_email_notification);
                                if( isset($eNotif[0]) ){
                                    $email_minutes = $eNotif[0];
                                }
                            }

                            $popup_minutes = 5;
                            if( $settings->google_calendar_popup_notification != '' ){
                                $pNotif = explode(" " , $settings->google_calendar_popup_notification);
                                if( isset($pNotif[0]) ){
                                    $popup_minutes = $pNotif[0];
                                }
                            }
                            $reminders = [
                                'useDefault' => "FALSE",
                                'overrides' => [
                                    ['method' => 'email', 'minutes' => $email_minutes],
                                    ['method' => 'popup', 'minutes' => $popup_minutes]
                                ]
                            ];
                        }else{
                            $reminders = [
                                'useDefault' => "FALSE",
                                'overrides' => [
                                    ['method' => 'email', 'minutes' => 24 * 60],
                                    ['method' => 'popup', 'minutes' => 5]
                                ]
                            ];    
                        }

                        $user_timezone = $capi->getUserCalendarTimezone($data['access_token']);
                                            
                        if( $googleAccount->auto_sync_calendar_id != ''){
                            $event_id      = $capi->createCalendarEvent($googleAccount->auto_sync_calendar_id, $calendar_title, 'FIXED-TIME', $event_time, $user_timezone, $attendees, $location, $reminders, $description, $data['access_token']);
                        }else{
                            $event_id      = $capi->createCalendarEvent('primary', $calendar_title, 'FIXED-TIME', $event_time, $user_timezone, $attendees, $location, $reminders, $description, $data['access_token']);    
                        }

                        $googleSyncData = [
                            'is_sync' => 1,
                            'error_msg' => '',
                            'date_sync' => date("Y-m-d H:i:s")
                        ];
                    }else{
                        $googleSyncData = [
                            'is_sync' => 0,
                            'error_msg' => 'Cannot find valid google account',
                            'date_sync' => date("Y-m-d H:i:s")
                        ];
                    }  

                    $this->GoogleCalendarSync_model->update($gs->id,$googleSyncData);
                }else{
                    $googleSyncData = [
                        'is_sync' => 0,
                        'error_msg' => 'Cannot find valid google account',
                        'date_sync' => date("Y-m-d H:i:s")
                    ];

                    $this->GoogleCalendarSync_model->update($gs->id,$googleSyncData);
                }                
            }
        }
    }
        
}

