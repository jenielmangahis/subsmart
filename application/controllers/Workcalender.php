<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Workcalender extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $this->checkLogin();

        $this->page_data['page']->title = 'Work Calender';
        $this->page_data['page']->menu  = 'Workcalender';
        $this->page_data['module']      = 'calendar';

        //$this->load->model('Workorder_model', 'workorder_model');
        $this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
        $this->load->model('Workzone_model', 'workzone_model');
        $this->load->model('Users_model');
        $this->load->model('GoogleAccounts_model');
        $user_id = getLoggedUserID();

        // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/libs/jcanvas/global.css',
            'assets/plugins/timeline_calendar/main.css',
            'assets/css/wokrcalendar/workcalendar.css',
            'assets/css/slidebox.css',
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/plugins/timeline_calendar/main.js',
            'assets/frontend/js/workcalender/workcalender.js',
            'assets/js/quick_launch.js',
            'assets/js/jquery.slidebox.min.js',
        ));
    }

    public function index()
    {

        $this->hasAccessModule(4); 
        $this->load->model('Event_model', 'event_model');
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentType_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');

        add_css(array(
            'assets/css/bootstrap-multiselect.min.css',
        ));

        add_footer_js(array(
            'assets/js/bootstrap-multiselect.min.js',
        ));


        $role = logged('role');
        $company_id = logged('company_id');
        if ($role == 2 || $role == 3) {           
            $events = $this->event_model->getAllByCompany($company_id);
        }
        if ($role == 4) {
            $events = $this->event_model->getAllByUserId();
        }

        $this->page_data['events'] = array();
        $this->session->set_userdata('calendar_filter_eids', 'multiselect-all');

        // setting of the calender
        $calender_settings = get_setting(DB_SETTINGS_TABLE_KEY_SCHEDULE);

        if (!empty($events)) {
            foreach ($events as $key => $event) {
                $customer = acs_prof_get_customer_by_prof_id($event->customer_id);

                // label of the event
                if (!empty($customer)) {
                    if (!empty($calender_settings)) {
                        $title = acs_prof_make_calender_event_label($calender_settings, $event, $customer);
                    } else {
                        $date = date('a', strtotime($event->start_time));
                        $date = substr($date, -2, 1);
                        $title = date('g', strtotime($event->start_time)) . $date;
                        $title .= ' ' . $customer->first_name . ' ' . $customer->last_name . ', ' . $customer->phone_m;
                    }
                }

                $this->page_data['events'][$key]['eventId'] = $event->id;
                $this->page_data['events'][$key]['status'] = $event->status;
                $this->page_data['events'][$key]['title'] = (!empty($customer)) ? $title : '';
                $this->page_data['events'][$key]['start'] = date('Y-m-d', strtotime($event->start_date));
                $this->page_data['events'][$key]['end'] = date('Y-m-d', strtotime($event->end_date));
                $this->page_data['events'][$key]['backgroundColor'] = $event->event_color;
            }
        }


        /*// workorders
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');
            $company_id = 15;
            $workorders = $this->workorder_model->getAllOrderByCompany($company_id);
        }
        if ($role == 4) {

            $workorders = $this->workorder_model->getAllByUserId();
        }

        // perform serialize decode operation
        foreach ($workorders as $key => $workorder) {

            $workorder->$key = serialize_to_array($workorder);
        }

        //echo '<pre>'; print_r($workorders); die;

        if (!empty($workorders)) {

            $workorder_events = array();

            foreach ($workorders as $k => $workorder) {

                $user = get_user_by_id($workorder->user_id);

                // label of the event
                if (!empty($workorder->customer)) {

                    if (!empty($calender_settings)) {

                        $title = make_calender_wordorder_label($calender_settings, $workorder);

                    } else {

                        $date = date('a', strtotime($workorder->date_issued));
                        $date = substr($date, -2, 1);
                        $title = date('g', strtotime($workorder->date_issued)) . $date;
                        $title .= ' ' . $workorder->customer['first_name'] . ' ' . $workorder->customer['last_name'] . ', ';
                        $title .= $workorder->customer['contact_mobile'];
                        $title .= ', $' . $workorder->total['eqpt_cost'];
                    }
                }

                $workorder_events[$k]['wordOrderId'] = $workorder->id;
                $workorder_events[$k]['workorder_status'] = $workorder->account_type;
                $workorder_events[$k]['title'] = $title;
                $workorder_events[$k]['start'] = date('Y-m-d', strtotime($workorder->date_issued));
                $workorder_events[$k]['end'] = date('Y-m-d', strtotime($workorder->date_issued));
                $workorder_events[$k]['userName'] = ($user) ? $user->name : '';
                $workorder_events[$k]['backgroundColor']    = get_event_color($workorder->status_id);
            }

            $this->page_data['events'] = array_merge($this->page_data['events'], $workorder_events);
        }*/

        $this->page_data['wordorders'] = array();

        // workorders
        // $workorders = $this->workorder_model->getAllByUserId('', '', 0, logged('id'), array());
        $workorders = array();

        // perform serialize decode operation
        foreach ($workorders as $key => $workorder) {
            $workorder->$key = serialize_to_array($workorder);
        }

        //echo '<pre>'; print_r($workorders); die;

        if (!empty($workorders)) {
            $workorder_events = array();

            foreach ($workorders as $k => $workorder) {
                $user = get_user_by_id($workorder->user_id);

                // label of the event
                if (!empty($workorder->customer)) {
                    if (!empty($calender_settings)) {
                        $title = make_calender_wordorder_label($calender_settings, $workorder);
                    } else {
                        $date = date('a', strtotime($workorder->date_issued));
                        $date = substr($date, -2, 1);
                        $title = date('g', strtotime($workorder->date_issued)) . $date;
                        $title .= ' ' . $workorder->customer['first_name'] . ' ' . $workorder->customer['last_name'] . ', ';
                        $title .= $workorder->customer['contact_mobile'];
                        $title .= ', $' . $workorder->total['eqpt_cost'];
                    }
                }

                $workorder_events[$k]['wordOrderId'] = $workorder->id;
                $workorder_events[$k]['workorder_status'] = $workorder->account_type;
                $workorder_events[$k]['title'] = $title;
                $workorder_events[$k]['start'] = date('Y-m-d', strtotime($workorder->date_issued));
                $workorder_events[$k]['end'] = date('Y-m-d', strtotime($workorder->date_issued));
                $workorder_events[$k]['userName'] = ($user) ? $user->name : '';
                $workorder_events[$k]['backgroundColor']    = get_event_color($workorder->status_id);
            }

            $this->page_data['wordorders'] = array_merge($this->page_data['wordorders'], $workorder_events);
        }

        //echo '<pre>'; print_r($this->page_data['events']); die;

        // load all user for calender toolbar
        $this->load->library('user_agent');
        if ($this->agent->is_mobile()) {
            $is_mobile = 1;
        } else {
            $is_mobile = 0;
        }

        $company_id = logged('company_id');
        if ($role == 2 || $role == 3) {
            $get_users  = $this->Users_model->getAllUsers();
            $get_recent_users = $this->Users_model->getAllRecentUsers();
        } else {
            $get_users  = $this->Users_model->getUsers();
            $get_recent_users = $this->Users_model->getAllUsersByCompany($company_id);
        }

        $resources_users = array();
        $resources_user_events = array();

        if (!empty($get_users)) {
            $inc = 0;
            $default_imp_img = base_url('uploads/users/default.png');
            foreach ($get_users as $get_user) {
                $default_imp_img = userProfileImage($get_user->id);

                /*if( $get_user->profile_img != null ) {
                        $default_imp_img = base_url('uploads/users/'.$get_user->profile_img ."." . $get_user->img_type );
                } else {
                    $default_imp_img = base_url('uploads/users/default.png');
                }*/

                $resources_users[$inc]['id'] = "user" . $get_user->id;
                $resources_users[$inc]['building'] = 'Employee';
                $resources_users[$inc]['title'] = "#" . $get_user->id . " " . $get_user->FName . " " . $get_user->LName;
                $resources_users[$inc]['imageurl'] = $default_imp_img;
                $inc++;
            }
        }

        if (!empty($events)) {
            $inc = 0;
            foreach ($events as $event) {
                if ($event->employee_id > 0) {
                    $start_date_time = date('Y-m-d H:i:s', strtotime($event->start_date . " " . $event->start_time));
                    $start_date_end  = date('Y-m-d H:i:s', strtotime($event->end_date . " " . $event->end_time));
                    $resources_user_events[$inc]['resourceId'] = $event->employee_id;
                    $resources_user_events[$inc]['title'] = $event->event_description;
                    $resources_user_events[$inc]['start'] = $start_date_time;
                    $resources_user_events[$inc]['end'] = $start_date_end;
                    $resources_user_events[$inc]['eventColor'] = $event->event_color;
                    $inc++;
                } elseif ($event->employee_id == 0) {
                    foreach ($get_users as $get_user) {
                        $start_date_time = date('Y-m-d H:i:s', strtotime($event->start_date . " " . $event->start_time));
                        $start_date_end  = date('Y-m-d H:i:s', strtotime($event->end_date . " " . $event->end_time));
                        $resources_user_events[$inc]['resourceId'] = $get_user->id;
                        $resources_user_events[$inc]['title'] = $event->event_description;
                        $resources_user_events[$inc]['start'] = $start_date_time;
                        $resources_user_events[$inc]['end'] = $start_date_end;
                        $resources_user_events[$inc]['eventColor'] = $event->event_color;
                        $inc++;
                    }
                }
            }
        }

        $enabled_calendar = array();
        $enabled_mini_calendar = array();
        $calendar_list    = array();
        $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
        if ($google_user_api) {
            $google_credentials = google_credentials();

            $access_token = "";
            $refresh_token = "";
            $google_client_id = "";
            $google_secrect = "";
            $calendar_list = array();

            if (isset($google_user_api->google_access_token)) {
                $access_token = $google_user_api->google_access_token;
            }

            if (isset($google_user_api->google_refresh_token)) {
                $refresh_token = $google_user_api->google_refresh_token;
            }

            if (isset($google_credentials['client_id'])) {
                $google_client_id = $google_credentials['client_id'];
            }

            if (isset($google_credentials['client_secret'])) {
                $google_secrect = $google_credentials['client_secret'];
            }

            if( $refresh_token ){
                //Set Client
                $client = new Google_Client();
                $client->setClientId($google_client_id);
                $client->setClientSecret($google_secrect);
                $client->setAccessToken($access_token);
                $client->refreshToken($refresh_token);
                $client->setScopes(array(
                    'email',
                    'profile',
                    'https://www.googleapis.com/auth/calendar',
                ));
                $client->setApprovalPrompt('force');
                $client->setAccessType('offline');
                
                //Request
                $access_token = $client->getAccessToken();
                if(!$client->isAccessTokenExpired()) {
                    $calendar     = new Google_Service_Calendar($client);
                    $data = $calendar->calendarList->listCalendarList();

                    $calendar_list = $data->getItems();
                    $email = $google_user_api->google_email;
                    $enabled_calendar = unserialize($google_user_api->enabled_calendars);
                    $enabled_mini_calendar = unserialize($google_user_api->enabled_mini_calendars);  
                }                
            }
        }

        $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE]);
        $onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $this->load->model('Users_model', 'user_model');

        $this->page_data['onlinePaymentAccount'] = $onlinePaymentAccount;
        $this->page_data['appointmentTypes'] = $this->AppointmentType_model->getAllByCompany($company_id, true);
        $this->page_data['settings'] = $settings;
        $this->page_data['enabled_calendar'] = $enabled_calendar;
        $this->page_data['enabled_mini_calendar'] = $enabled_mini_calendar;
        $this->page_data['get_recent_users'] = $get_recent_users;

        $this->page_data['resources_users'] = $resources_users;
        $this->page_data['resources_user_events'] = $resources_user_events;
        $this->page_data['is_mobile'] = $is_mobile;
        $this->page_data['users'] = $this->user_model->getUsers();

        $this->page_data['calendar_list'] = $calendar_list;

        $this->load->view('workcalender/calender', $this->page_data);
    }

    public function edit($id)
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $this->page_data['workorder']->zones = $this->workzone_model->getZones($user_id);
        $this->load->view('workcalender/edit', $this->page_data);

        // print_r($this->page_data['workorder']->zones); die;
    }


    public function short_details($id)
    {
        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $this->page_data['workorder']->user = get_user_by_id($this->page_data['workorder']->user_id);

        if ($this->page_data['workorder']->customer_id) {
            $this->page_data['workorder']->customer = get_customer_by_id($this->page_data['workorder']->customer_id);
        }

//        echo '<pre>';
//        print_r($this->page_data['workorder']);
//        die;

        die($this->load->view('workcalender/short-details', $this->page_data, true));
    }


    public function save()
    {
        postAllowed();
        ifPermissions('add_plan');

        $company_id = logged('company_id');
        $permission = $this->Workstatus_model->create([
            'company_id' => $company_id,
            'title' => $this->input->post('title'),
            'color' => $this->input->post('color')
        ]);

        $this->activity_model->add("New Workstatus #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Workstatus Created Successfully');

        redirect('workstatus');
    }


    public function update($id)
    {
        postAllowed();

        $user = (object)$this->session->userdata('logged');

        if (count(post('notify_by')) > 0) {
            $notify_by = implode(',', post('notify_by'));
        } else {
            $notify_by = '';
        }


        if (count(post('assign_to')) > 0) {
            $assign_to = implode(',', post('assign_to'));
        } else {
            $assign_to = '';
        }

        if (count(post('item')) > 0) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $type = post('type');

            foreach (post('item') as $key => $val) {
                $itemArray[] = array(

                    'item' => $items[$key],
                    'type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'price' => $price[$key]
                );
            }

            $workorder_items = serialize($itemArray);
        } else {
            $workorder_items = '';
        }

        // zone
        // if(count(post('zones')) > 0) {

        //  $zones = post('zones');
        //  $quantity = post('quantity');
        //  $price = post('price');
        //  $type = post('type');

        //  foreach(post('item') as $key=>$val) {

        //      $itemArray[] = array(

        //          'item' => $items[$key],
        //          'type' => $type[$key],
        //          'quantity'=> $quantity[$key],
        //          'price' => $price[$key]
        //      );
        //  }

        //  $workorder_items = serialize($itemArray);
        // } else {

        //  $workorder_items = '';
        // }

        if (count(post('premises_chk')) > 0) {
            $premises_chk = implode(',', post('premises_chk'));
        } else {
            $premises_chk = '';
        }

        if (count(post('chk_emerg_email')) > 0) {
            $chk_emerg_email = implode(',', post('chk_emerg_email'));
        } else {
            $chk_emerg_email = '';
        }

        if (count(post('chk_emerg_location')) > 0) {
            $chk_emerg_location = implode(',', post('chk_emerg_location'));
        } else {
            $chk_emerg_location = '';
        }

        if (!empty(post('plan_type')) && count(post('plan_type')) > 0) {
            $plan_type = implode(',', post('plan_type'));
        } else {
            $plan_type = '';
        }

        if (!empty(post('chk_dvr')) && count(post('chk_dvr')) > 0) {
            $chk_dvr = implode(',', post('chk_dvr'));
        } else {
            $chk_dvr = '';
        }

        if (count(post('deadbolt')) > 0) {
            $deadbolt = implode(',', post('deadbolt'));
        } else {
            $deadbolt = '';
        }

        if (count(post('handle')) > 0) {
            $handle = implode(',', post('handle'));
        } else {
            $handle = '';
        }

        if (!empty(post('thermostat')) && count(post('thermostat')) > 0) {
            $thermostat = implode(',', post('thermostat'));
        } else {
            $thermostat = '';
        }

        if (!empty(post('doorbell_cam')) && count(post('doorbell_cam')) > 0) {
            $doorbell_cam = implode(',', post('doorbell_cam'));
        } else {
            $doorbell_cam = '';
        }

        if (!empty(post('inst_time')) && count(post('inst_time')) > 0) {
            $inst_time = implode(',', post('inst_time'));
        } else {
            $inst_time = '';
        }

        if (!empty(post('chk_enhance_dvr')) && count(post('chk_enhance_dvr')) > 0) {
            $chk_enhance_dvr = implode(',', post('chk_enhance_dvr'));
        } else {
            $chk_enhance_dvr = '';
        }

        if (!empty(post('chk_enhance_pers')) && count(post('chk_enhance_pers')) > 0) {
            $chk_enhance_pers = implode(',', post('chk_enhance_pers'));
        } else {
            $chk_enhance_pers = '';
        }

        if (post('card_no') != '') {
            $card = array(

                'card_no' => post('card_no'),
                'exp_date' => post('exp_date'),
                'cvv' => post('cvv')
            );

            $card_details = serialize($card);
        } else {
            $card_details = '';
        }

        if (count(post('chk_billing_dates')) > 0) {
            $chk_billing_dates = implode(',', post('chk_billing_dates'));
        } else {
            $chk_billing_dates = '';
        }

        if (post('chk_inactive')) {
            $chk_inactive = post('chk_inactive');
        } else {
            $chk_inactive = '';
        }

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );


        $data = array(

            'user_id' => $user->id,
            'agreement_name' => post('agreement_name'),
            'contact_name' => post('contact_name'),
            'contact_pwd' => post('contact_pwd'),
            'contact_ssn' => post('contact_ssn'),
            'contact_dob' => date('Y-m-d', strtotime(post('contact_dob'))),
            'contact_email' => post('contact_email'),
            'contact_mobile' => post('contact_mobile'),
            'contact_phone' => post('contact_phone'),
            'workorder_date' => date('Y-m-d', strtotime(post('workorder_date'))),
            'customer_type' => post('customer_type'),
            'notify_by' => $notify_by,
            'street_address' => post('street_address'),
            'suit' => post('suit'),
            'city' => post('city'),
            'zip' => post('zip'),
            'state' => post('state'),
            'premises' => post('premises'),
            'premises_chk' => $premises_chk,
            'company_phone' => post('company_phone'),
            'verification_name' => post('verification_name'),
            'verification_phone' => post('verification_phone'),
            'emrg_contact_1' => post('emrg_contact_1'),
            'emrg_contact_phone_1' => post('emrg_contact_phone_1'),
            'emrg_contact_2' => post('emrg_contact_2'),
            'emrg_contact_phone_2' => post('emrg_contact_phone_2'),
            'emrg_contact_email' => post('emrg_contact_email'),
            'emerg_contact_location' => post('emerg_contact_location'),
            'chk_emerg_email' => $chk_emerg_email,
            'chk_emerg_location' => $chk_emerg_location,
            'plan_type' => $plan_type,
            'chk_dvr' => $chk_dvr,
            'deadbolt' => $deadbolt,
            'handle' => $handle,
            'thermostat' => $thermostat,
            'doorbell_cam' => $doorbell_cam,
            'inst_date' => date('Y-m-d', strtotime(post('inst_date'))),
            'notes_to_tech' => post('notes_to_tech'),
            'inst_time' => $inst_time,
            'workorder_items' => $workorder_items,
            'workorder_eqpt_cost' => serialize($eqpt_cost),
            'chk_enhance_dvr' => $chk_enhance_dvr,
            'chk_enhance_pers' => $chk_enhance_pers,
            'radio_credit_card' => post('radio_credit_card'),
            'card_details' => $card_details,
            'chk_billing_dates' => $chk_billing_dates,
            'checking_account' => post('checking_account'),
            'routing' => post('routing'),
            'sales_rep_name' => post('sales_rep_name'),
            'cell_phone' => post('cell_phone'),
            'notes_to_lauren' => post('notes_to_lauren'),
            'chk_inactive' => $chk_inactive,
            'prev_prod_name' => post('prev_prod_name'),
            'comp_rep_approval' => post('comp_rep_approval'),
            'customer_sign' => post('customer_sign'),
            'post_service_uid' => post('post_service_uid'),
            'post_service_pwd' => post('post_service_pwd'),
            'post_service_pre_install' => post('post_service_pre_install'),
            'post_service_wifi_pwd' => post('post_service_wifi_pwd'),
            'post_service_panel_location' => post('post_service_panel_location'),
            'post_service_trans_location' => post('post_service_trans_location'),
            'note_to_admin' => post('note_to_admin'),
            'date_of_trans' => date('Y-m-d', post('date_of_trans')),
            'date_later_midnight' => date('Y-m-d', post('date_later_midnight')),
            'cancel_custome_sign' => post('cancel_custome_sign'),
            'cancel_trans_date' => date('Y-m-d', post('cancel_trans_date')),
            'cancel_customer_name' => post('cancel_customer_name'),
            'cancel_customer_address' => post('cancel_customer_address'),
            'cancel_customer_phone' => post('cancel_customer_phone'),
            'cancel_customer_phone' => post('cancel_customer_phone'),
            'workorder_status' => post('workorder_status'),
            'assign_to' => $assign_to

        );

        $id = $this->workorder_model->update($id, $data);

        // update zones
        if (count(post('zone')) > 0) {
            $zones = post('zone');

            // clear
            $oldZones = $this->workzone_model->getAll(['user_id' => logged('id'), 'company_id' => logged('company_id'), 'workorder_id' => $id]);
            foreach ($oldZones as $zone) {
                $this->workzone_model->delete($zone->id);
            }

            foreach ($zones['existing'] as $k => $zone) {
                $zdata = array();
                $zdata['user_id'] = logged('id');
                $zdata['company_id'] = logged('company_id');
                $zdata['workorder_id'] = $id;
                $zdata['existing'] = $zone;
                $zdata['zone_number'] = $zones['zone_number'][$k];
                $zdata['repeat_issue'] = $zones['repeat_issue'][$k];
                $zdata['location'] = $zones['location'][$k];

                // echo '<pre>'; print_r($zdata); die;

                $new_zone_id = $this->workzone_model->create($zdata);
            }
        }


        // if (!empty($_FILES['attachment']['name'])) {

        //  $path = $_FILES['attachment']['name'];

        //  $ext = pathinfo($path, PATHINFO_EXTENSION);

        //  $this->uploadlib->initialize([

        //      'file_name' => $id.'.'.$ext

        //  ]);

        //  $image = $this->uploadlib->uploadImage('attachment', '/workorders');


        //  if($image['status']){

        //      $this->workorder_model->update($id, ['img_type' => $ext]);

        //  }

        // }

        $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Workorder has been Updated Successfully');

        redirect('workorder');
    }


    public function filter_events()
    {
        $post = $this->input->post();
        $role = logged('role');

        $this->page_data['workorders'] = $this->workorder_model->getAllByUserId('', '', 0, $post['employee_id']);

        // $this->page_data['events'] = $this->workorder_model->getAllByUserId();

        $this->page_data['events'] = array();

        foreach ($this->page_data['workorders'] as $key => $workorder) {
            $user = get_user_by_id($workorder->user_id);

            $this->page_data['events'][$key]['wordOrderId'] = $workorder->id;
            $this->page_data['events'][$key]['workorder_status'] = $workorder->workorder_status;
            $this->page_data['events'][$key]['title'] = 'WO-00' . $workorder->id;
            $this->page_data['events'][$key]['start'] = $workorder->workorder_date;
            $this->page_data['events'][$key]['userName'] = ($user) ? $user->name : '';
            $this->page_data['events'][$key]['backgroundColor'] = get_event_color($workorder->workorder_status);
        }

        die(json_encode($this->page_data['events']));
    }

    public function print_calender()
    {
        // echo $this->input->get('default_view');
        // echo $this->input->get('default_date');

        $this->page_data['default_date'] = $this->input->get('default_date');
        $this->page_data['default_view'] = $this->input->get('default_view');


        $this->load->model('Event_model', 'event_model');

        $role = logged('role');
        if ($role == 2 || $role == 3 || $role == 6) {
            $company_id = logged('company_id');
            $company_id = 15;
            $events = $this->event_model->getAllByCompany($company_id);
        } elseif ($role == 4) {
            $events = $this->event_model->getAllByUserId();
        } else {
            $company_id = logged('company_id');
            $events = $this->event_model->getAllByCompany($company_id);
        }

        $this->page_data['events'] = array();

        // setting of the calender
        $calender_settings = get_setting(DB_SETTINGS_TABLE_KEY_SCHEDULE);

        if (!empty($events)) {
            foreach ($events as $key => $event) {
                $customer = get_customer_by_id($event->customer_id);

                // label of the event
                if (!empty($customer)) {
                    if (!empty($calender_settings)) {
                        $title = make_calender_event_label($calender_settings, $event, $customer);
                    } else {
                        $date = date('a', strtotime($event->start_time));
                        $date = substr($date, -2, 1);
                        $title = date('g', strtotime($event->start_time)) . $date;
                        $title .= ' ' . $customer->contact_name . ', ' . $customer->mobile;
                    }
                }

                $this->page_data['events'][$key]['eventId'] = $event->id;
                $this->page_data['events'][$key]['status'] = $event->status;
                $this->page_data['events'][$key]['title'] = (!empty($customer)) ? $title : '';
                $this->page_data['events'][$key]['start'] = date('Y-m-d', strtotime($event->start_date));
                if ($event->end_date != "1970-01-01" && $event->end_date != "" && $event->end_date != null) {
                    $this->page_data['events'][$key]['end'] = date('Y-m-d', strtotime($event->end_date));
                }
                // $this->page_data['events'][$key]['userName']         = ($user) ? $user->name : '';
                $this->page_data['events'][$key]['backgroundColor'] = $event->event_color;
            }
        }
        $this->load->view('workcalender/reports/calender-print', $this->page_data);
    }

    public function main_calendar_events()
    {
        $this->load->model('Event_model', 'event_model');
        $this->load->model('Jobs_model');
        $this->load->model('GoogleAccounts_model');
        $this->load->model('ColorSettings_model');
        $this->load->model('DealsBookings_model');
        $this->load->model('ColorSettings_model');
        $this->load->model('Appointment_model');

        $post = $this->input->post();
        $role = logged('role');
        $company_id = logged('company_id');
        /*if ($role == 2 || $role == 3 || $role == 22) {
            $company_id = logged('company_id');
            $events = $this->event_model->getAllByCompany($company_id);
        }*/

        $events = $this->event_model->getAllByCompany($company_id);

        /*if ($role == 4) {
            $events = $this->event_model->getAllByUserId();
        }*/

        if (empty($events) && $role == 1) {
            $events = $this->event_model->getAllByUserId();
        }

        $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);
        $a_settings = unserialize($settings[0]->value);
        if ($a_settings) {
            $user_timezone = $a_settings['calendar_timezone'];
        } else {
            $user_timezone = 'UTC';
        }

        $get_users             = $this->Users_model->getUsers();
        $resources_user_events = array();
        $inc = 0;
        if (!empty($events)) {
            foreach ($events as $event) {
                if ($event->event_description != '') {
                    if ($event->employee_id > 0) {
                        $starttime = $event->start_date . " " . $event->start_time;
                        $start_date_time = date('Y-m-d\TH:i:s', strtotime($event->start_date . " " . $event->start_time));
                        $start_date_end  = date('Y-m-d\TH:i:s', strtotime($event->end_date . " " . $event->end_time));

                        $title = $event->start_time . " - " . $event->end_time;
                        /*$custom_html = "<i class='fa fa-calendar'></i> " . $event->start_time . " - " . $event->end_time . "<br /><small>" . $event->event_type . "</small><br /><small>" . $event->FName . ' ' . $event->LName . "</small><br /><small>" . $event->mail_add . " " . $event->cus_city . " " . $event->cus_state . "</small>";*/

                        $custom_html = $event->start_time . " - " . $event->end_time . "<br /><small>" . $event->event_type . "</small>";
                        if (isset($a_settings['work_order_show_customer'])) {
                            $custom_html .= "<br /><b><small style='font-weight:bolder;'>" . $event->FName . ' ' . $event->LName . "</small></b>";
                        }

                        if (isset($a_settings['work_order_show_details'])) {
                            $custom_html .= "<br /><small>" . $event->mail_add . " " . $event->cus_city . " " . $event->cus_state . " - " . $event->event_description . "</small>";
                        }

                        if (isset($a_settings['work_order_show_link'])) {
                            $custom_html .= "<br /><small><a href='".$event->url_link."'>".$event->url_link."</a></small>";
                        }

                        if (isset($a_settings['work_order_show_price'])) {
                            $eventItems = $this->event_model->get_specific_event_items($event->id);
                            $total_price = 0;
                            foreach ($eventItems as $item) {
                                $total_price += ($item->price * $item->qty);
                            }

                            $custom_html .= "<br /><small>Price : ". number_format((float)$total_price, 2, '.', ',') . "</small>";
                        }

                        $resources_user_events[$inc]['eventId'] = $event->id;
                        $resources_user_events[$inc]['eventType'] = 'events';
                        $resources_user_events[$inc]['resourceId'] = 'user' . $event->employee_id;
                        $resources_user_events[$inc]['title'] = $title;
                        $resources_user_events[$inc]['customHtml'] = $custom_html;
                        $resources_user_events[$inc]['start'] = $event->start_date;
                        $resources_user_events[$inc]['end'] = $event->end_date;
                        $resources_user_events[$inc]['starttime'] = strtotime($starttime);
                        $resources_user_events[$inc]['backgroundColor'] = $event->event_color;

                        $inc++;
                    }/*elseif($event->employee_id == 0) {
                        foreach($get_users as $get_user) {
                            $start_date_time = date('Y-m-d H:i:s',strtotime($event->start_date . " " . $event->start_time));
                            $start_date_end  = date('Y-m-d H:i:s',strtotime($event->end_date . " " . $event->end_time));
                            $resources_user_events[$inc]['eventId'] = $event->id;
                            $resources_user_events[$inc]['eventType'] = 'events';
                            $resources_user_events[$inc]['resourceId'] = 'user' . $get_user->id;
                            $resources_user_events[$inc]['title'] = $event->event_description;
                            $resources_user_events[$inc]['start'] = $start_date_time;
                            $resources_user_events[$inc]['end'] = $start_date_end;
                            $resources_user_events[$inc]['backgroundColor'] = $event->event_color;
                        $inc++;
                        }

                    }*/
                }
            }
        }

        //Appointments
        $appointments = $this->Appointment_model->getAllNotWaitListByCompany($company_id);
        foreach ($appointments as $a) {
            $starttime = $a->appointment_date . " " . $a->appointment_time;
            $start_date_time = date('Y-m-d\TH:i:s', strtotime($a->appointment_date . " " . $a->appointment_time));
            $start_date_end  = $start_date_time;
            $backgroundColor = "#38a4f8";

            $custom_html = "<i class='fa fa-user'></i> <small class='event-caption'>" . $a->customer_name . " - " . $a->appointment_type . "</small><br /><i class='fa fa-list'></i> <small class='event-caption'>" . $a->appointment_type . "</small>";

            $resources_user_events[$inc]['eventId'] = $a->id;
            $resources_user_events[$inc]['eventType'] = 'appointments';
            $resources_user_events[$inc]['resourceId'] = 'user' . $a->user_id;
            $resources_user_events[$inc]['title'] = 'Appointment : ' . date('Y-m-d g:i A', strtotime($a->appointment_date . " " . $a->appointment_time));
            $resources_user_events[$inc]['customHtml'] = $custom_html;
            $resources_user_events[$inc]['start'] = $start_date_time;
            $resources_user_events[$inc]['end'] = $start_date_end;
            $resources_user_events[$inc]['starttime'] = $start_date_time;
            $resources_user_events[$inc]['backgroundColor'] = $backgroundColor;

            $inc++;
        }

        //Google Events
        $googleColor = $this->ColorSettings_model->getByCompanyIdAndColorName($company_id, 'Google');
        $enabled_calendar = array();
        $calendar_list    = array();
        $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
        if ($google_user_api) {
            $google_credentials = google_credentials();

            $access_token = "";
            $refresh_token = "";
            $google_client_id = "";
            $google_secrect = "";
            $calendar_list = array();

            if (isset($google_user_api->google_access_token)) {
                $access_token = $google_user_api->google_access_token;
            }

            if (isset($google_user_api->google_refresh_token)) {
                $refresh_token = $google_user_api->google_refresh_token;
            }

            if (isset($google_credentials['client_id'])) {
                $google_client_id = $google_credentials['client_id'];
            }

            if (isset($google_credentials['client_secret'])) {
                $google_secrect = $google_credentials['client_secret'];
            }

            //Set Client
            $client = new Google_Client();
            $client->setClientId($google_client_id);
            $client->setClientSecret($google_secrect);
            $client->setAccessToken($access_token);
            $client->refreshToken($refresh_token);
            $client->setScopes(array(
                'email',
                'profile',
                'https://www.googleapis.com/auth/calendar',
            ));
            $client->setApprovalPrompt('force');
            $client->setAccessType('offline');

            //Request
            $access_token = $client->getAccessToken();
            if(!$client->isAccessTokenExpired()) {
                $calendar     = new Google_Service_Calendar($client);
                $data = $calendar->calendarList->listCalendarList();

                $calendar_list = $data->getItems();
                $email = $google_user_api->google_email;
                $enabled_mini_calendar = array();
                if ($google_user_api->enabled_calendars != '') {
                    $enabled_mini_calendar = unserialize($google_user_api->enabled_calendars);   
                }                

                foreach ($calendar_list as $cl) {
                    if (in_array($cl['id'], $enabled_mini_calendar) && !empty($enabled_mini_calendar)) {
                        //Display in events
                        $optParams = array(
                          'orderBy' => 'starttime',
                          'singleEvents' => true,
                          'timeMin' => $post['start'],
                          'timeMax' => $post['end'],
                        );
                        $events = $calendar->events->listEvents($cl['id'], $optParams);
                        $bgcolor = "#38a4f8";
                        if ($cl->backgroundColor != '') {
                            $bgcolor = $cl->backgroundColor;
                        }

                        foreach ($events->items as $event) {
                            $gevent = $this->event_model->getEventByGoogleEventId($event->id);

                            if (empty($gevent)) {
                                $is_with_time = false;

                                if ($event->start->timeZone != '') {
                                    $tz = new DateTimeZone($event->start->timeZone);
                                } else {
                                    $tz = new DateTimeZone($user_timezone);
                                }

                                if ($event->start->dateTime != '') {
                                    $date = new DateTime($event->start->dateTime);
                                    $date->setTimezone($tz);

                                    $start_date = $date->format('Y-m-d');
                                    $custom_html_start_date = $date->format('g:i a');
                                    $starttime = $start_date . ' ' . $date->format('g:i a');
                                    $is_with_time = true;
                                } else {
                                    $date = new DateTime($event->start->date);
                                    $date->setTimezone($tz);

                                    $start_date = $date->format('Y-m-d') . " 00:00";
                                    $starttime  = $start_date . ' ' . date("g:i A");
                                    $custom_html_start_date = $date->format('Y-m-d');
                                }

                                if ($event->end->dateTime != '') {
                                    $date = new DateTime($event->end->dateTime);
                                    $date->setTimezone($tz);
                                    //$end_date = $event->end->dateTime;
                                    $end_date = $date->format('Y-m-d');

                                    $custom_html_end_date = $date->format('g:i a');
                                    $start_time = $date->format('g:i a');
                                    $is_with_time = true;
                                } else {
                                    $date = new DateTime($event->end->date);
                                    $date->setTimezone($tz);

                                    $end_date = $date->format('Y-m-d') . " 23:59";
                                    $custom_html_end_date = $date->format('Y-m-d');
                                }

                                if ($googleColor) {
                                    $bgcolor = $googleColor->color_code;
                                }

                                if ($event->summary != '') {
                                    if ($is_with_time) {
                                        $custom_html = $custom_html_start_date . " - " . $custom_html_end_date . "<br /><small>Google Event</small><br /><small>" . $event->summary . "</small>";
                                    } else {
                                        $custom_html = $event->summary . "<br /><small>Google Event</small><br />";
                                    }
                                    

                                    $resources_user_events[$inc]['googleCalendarLink'] = $event->htmlLink;
                                    $resources_user_events[$inc]['geventID'] = $event->id;
                                    $resources_user_events[$inc]['eventType'] = 'google_events';
                                    $resources_user_events[$inc]['resourceId'] = "user17";
                                    $resources_user_events[$inc]['calendarID'] = $cl['id'];
                                    $resources_user_events[$inc]['title'] = $event->summary;
                                    $resources_user_events[$inc]['customHtml'] = $custom_html;
                                    $resources_user_events[$inc]['description'] = $event->summary . "<br />" . "<i class='fa fa-calendar'></i> " . $start_date . " - " . $end_date;
                                    $resources_user_events[$inc]['start'] = $start_date;
                                    $resources_user_events[$inc]['end'] = $end_date;
                                    $resources_user_events[$inc]['starttime'] = strtotime($starttime);
                                    $resources_user_events[$inc]['backgroundColor'] = $bgcolor;

                                    $inc++;
                                }
                            }
                        }
                    }
                }
            }            
        }

        /*echo "<pre>";
        print_r($resources_user_events);
        exit;*/

        //Jobs
        $jobs = $this->Jobs_model->get_all_jobs();
        foreach ($jobs as $j) {
            if ($j->job_description != '') {
                $starttime = $j->start_date . " " . $j->start_time;
                $start_date_time = date('Y-m-d H:i:s', strtotime($j->start_date . " " . $j->start_time));
                $start_date_end  = date('Y-m-d H:i:s', strtotime($j->end_date . " " . $j->end_time));
                $backgroundColor = "#38a4f8";

                $colorSetting = $this->ColorSettings_model->getById($j->event_color);
                if($colorSetting){
                    $backgroundColor = $colorSetting->color_code;
                }

                //$custom_html = "<i class='fa fa-calendar'></i> " . $j->start_time . " - " . $j->end_time . "<br /><small>" . $j->job_type . "</small><br /><small>" . $j->FName . ' ' . $j->LName . "</small><br /><small>" . $j->mail_add . " " . $j->cus_city . " " . $j->cus_state . "</small>";

                $custom_html = $j->start_time . " - " . $j->end_time . "<br /><small>" . $j->job_type . "</small>";

                if (isset($a_settings['work_order_show_customer'])) {
                    $custom_html .= "<br /><b><small style='font-weight:bolder;'>" . $j->FName . ' ' . $j->LName . "</small></b>";
                }

                if (isset($a_settings['work_order_show_details'])) {
                    $custom_html .= "<br /><small>" . $j->mail_add . " " . $j->cus_city . " " . $j->cus_state . " - " . $j->job_description . "</small>";
                }

                if (isset($a_settings['work_order_show_price'])) {
                    $jobItems = $this->Jobs_model->get_specific_job_items($j->id);
                    $total_price = 0;
                    foreach ($jobItems as $item) {
                        $total_price += ($item->price * $item->qty);
                    }

                    $custom_html .= "<br /><small>Price : ". number_format((float)$total_price, 2, '.', ',') . "</small>";
                }

                /*if( isset($a_settings['work_order_show_link']) ){
                    $custom_html .= "<br /><small><a href=''>".$event->url_link."</a></small>";
                }*/


                $resources_user_events[$inc]['eventId'] = $j->id;
                $resources_user_events[$inc]['eventType'] = 'jobs';
                $resources_user_events[$inc]['resourceId'] = 'job' . $j->employee_id;
                $resources_user_events[$inc]['title'] = $j->job_description;
                $resources_user_events[$inc]['customHtml'] = $custom_html;
                $resources_user_events[$inc]['start'] = $start_date_time;
                $resources_user_events[$inc]['end'] = $start_date_end;
                $resources_user_events[$inc]['starttime'] = strtotime($starttime);
                $resources_user_events[$inc]['backgroundColor'] = $backgroundColor;

                $inc++;
            }
        }

        //Deals Booking
        /*$bookings = $this->DealsBookings_model->getAllByCompanyId($company_id);
        foreach( $bookings as $b ){

            $custom_html  = "<i class='fa fa-calendar'></i> " . date("Y-m-d g:i A", strtotime($b->date_created)) . "<br />";
            $custom_html .= "<small>Deals Steals : " . $b->title . "</small> <br />";
            $custom_html .= "<small>Name : " . $b->name . "</small> <br />";

            $resources_user_events[$inc]['eventId'] = $b->id;
            $resources_user_events[$inc]['eventType'] = 'booking';
            $resources_user_events[$inc]['resourceId'] = 'user17';
            $resources_user_events[$inc]['title'] = $title;
            $resources_user_events[$inc]['customHtml'] = $custom_html;
            $resources_user_events[$inc]['start'] = date("Y-m-d", strtotime($b->date_created));
            $resources_user_events[$inc]['end'] = date("Y-m-d", strtotime($b->date_created));
            $resources_user_events[$inc]['starttime'] = strtotime($b->date_created);
            $resources_user_events[$inc]['backgroundColor'] = '#42b9f5';

            $inc++;
        }*/

        echo json_encode($resources_user_events);
    }

    public function ajax_create_google_event()
    {
        $this->load->model('Event_model', 'event_model');

        $post = $this->input->post();


        $is_success = false;
        $message    = 'Cannot create event';

        if ($post['gevent_name'] != '' && $post['gevent_date_from'] != '' && $post['gevent_date_to'] != '' && $post['gevent_start_time'] != '' && $post['gevent_end_time'] != '') {
            $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
            if ($google_user_api) {
                $google_credentials = google_credentials();

                $google_credentials = google_credentials();

                $access_token = "";
                $refresh_token = "";
                $google_client_id = "";
                $google_secrect = "";
                $calendar_list = array();

                if (isset($google_user_api->google_access_token)) {
                    $access_token = $google_user_api->google_access_token;
                }

                if (isset($google_user_api->google_refresh_token)) {
                    $refresh_token = $google_user_api->google_refresh_token;
                }

                if (isset($google_credentials['client_id'])) {
                    $google_client_id = $google_credentials['client_id'];
                }

                if (isset($google_credentials['client_secret'])) {
                    $google_secrect = $google_credentials['client_secret'];
                }

                //Set Client
                $client = new Google_Client();
                $client->setClientId($google_client_id);
                $client->setClientSecret($google_secrect);
                $client->setAccessToken($access_token);
                $client->refreshToken($refresh_token);

                //Request
                $date_to = date("Y-m-d", strtotime($post['gevent_date_to'] . ' +1 day'));

                $rfc_start_date = date("c", strtotime($post['gevent_date_from'] . ' ' . $post['gevent_start_time']));
                $rfc_end_date   = date("Y-m-d H:i:s", strtotime($post['gevent_date_to'] . ' ' . $post['gevent_end_time']));
                $rfc_end_date   = date("Y-m-d H:i:s", strtotime($rfc_end_date . ' +1 day'));
                $rfc_end_date   = date("c", strtotime($rfc_end_date));

                $calendar = new Google_Service_Calendar($client);
                $event    = new Google_Service_Calendar_Event(array(
                  'summary' => $post['gevent_name'],
                  'location' => '',
                  'description' => $post['gevent_name'],
                  'start' => array(
                    'dateTime' => $rfc_start_date,
                    'timeZone' => 'America/Los_Angeles'
                  ),
                  'end' => array(
                    'dateTime' => $rfc_end_date,
                    'timeZone' => 'America/Los_Angeles'
                  )/*,
                  'recurrence' => array(
                    'RRULE:FREQ=DAILY'
                  ),*/
                ));

                $calendarId = $post['gevent_gcid'];
                $event = $calendar->events->insert($calendarId, $event);

                //Save to db
                $company_id = logged('company_id');

                if (isset($post['is_recurring'])) {
                    $is_recurring = 1;
                } else {
                    $is_recurring = 0;
                }

                $data = array(
                    'company_id' => $company_id,
                    'customer_id' => $post['customer_id'],
                    'employee_id' => $post['user_id'][0],
                    'gevent_id' => $event->id,
                    'what_of_even' => ($post['what_of_even']) ? $post['what_of_even'] : '',
                    'description' => $post['gevent_description'],
                    'start_date' => date('Y-m-d', strtotime($post['gevent_date_from'])),
                    'start_time' => $post['gevent_start_time'],
                    'end_date' => date('Y-m-d', strtotime($post['gevent_date_to'])),
                    'end_time' => $post['gevent_end_time'],
                    'event_color' => '',
                    'notify_at' => $post['notify_at'],
                    'event_description' => $post['gevent_description'],
                    'instructions' => '',
                    'is_recurring' => $is_recurring
                );
                $event_id = $this->event_model->create($data);

                $is_success = true;
                $message    = 'Google event was successfully created.';
            }
        } else {
            $message = 'Required fields cannot be empty';
        }

        $json_data = [
            'is_success' => $is_success,
            'message' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_create_google_calendar()
    {
        $post = $this->input->post();

        $is_success = false;
        $message    = 'Cannot create event';

        if ($post['gcalendar_name'] != '') {
            $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
            if ($google_user_api) {
                $google_credentials = google_credentials();

                $access_token = "";
                $refresh_token = "";
                $google_client_id = "";
                $google_secrect = "";
                $calendar_list = array();

                if (isset($google_user_api->google_access_token)) {
                    $access_token = $google_user_api->google_access_token;
                }

                if (isset($google_user_api->google_refresh_token)) {
                    $refresh_token = $google_user_api->google_refresh_token;
                }

                if (isset($google_credentials['client_id'])) {
                    $google_client_id = $google_credentials['client_id'];
                }

                if (isset($google_credentials['client_secret'])) {
                    $google_secrect = $google_credentials['client_secret'];
                }

                //Set Client
                $client = new Google_Client();
                $client->setClientId($google_client_id);
                $client->setClientSecret($google_secrect);
                $client->setAccessToken($access_token);
                $client->refreshToken($refresh_token);

                //Request
                $service = new Google_Service_Calendar($client);

                $calendar = new Google_Service_Calendar_Calendar(array(
                  'summary' => $post['gcalendar_name'],
                  'timezone' => 'America/Los_Angeles'
                ));
                $event = $service->calendars->insert($calendar);

                $is_success = true;
                $message    = 'Google calendar was successfully created.';
            }
        } else {
            $message = 'Please enter calendar name';
        }

        $json_data = [
            'is_success' => $is_success,
            'message' => $message
        ];

        echo json_encode($json_data);
    }

    public function modal_gevent_details()
    {
        $post = $this->input->post();
        $this->page_data['gevent'] = $post;
        $this->load->view('workcalender/gevent_details', $this->page_data);
    }

    public function debug_google_events()
    {
        $this->load->model('GoogleAccounts_model');
        $this->load->model('Event_model', 'event_model');

        //Google Events
        $resources_user_events = array();
        $inc = 0;

        $enabled_calendar = array();
        $calendar_list    = array();
        $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
        $post['start'] = '2020-09-27T00:00:00+08:00';
        $post['end'] = '2020-11-08T00:00:00+08:00';

        $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE]);
        $a_settings = unserialize($settings[0]->value);
        if ($a_settings) {
            $user_timezone = $a_settings['calendar_timezone'];
        } else {
            $user_timezone = 'UTC';
        }

        if ($google_user_api) {
            $google_credentials = google_credentials();

            $access_token = "";
            $refresh_token = "";
            $google_client_id = "";
            $google_secrect = "";
            $calendar_list = array();

            if (isset($google_user_api->google_access_token)) {
                $access_token = $google_user_api->google_access_token;
            }

            if (isset($google_user_api->google_refresh_token)) {
                $refresh_token = $google_user_api->google_refresh_token;
            }

            if (isset($google_credentials['client_id'])) {
                $google_client_id = $google_credentials['client_id'];
            }

            if (isset($google_credentials['client_secret'])) {
                $google_secrect = $google_credentials['client_secret'];
            }

            //Set Client
            $client = new Google_Client();
            $client->setClientId($google_client_id);
            $client->setClientSecret($google_secrect);
            $client->setAccessToken($access_token);
            $client->refreshToken($refresh_token);
            $client->setScopes(array(
                'email',
                'profile',
                'https://www.googleapis.com/auth/calendar',
            ));
            $client->setApprovalPrompt('force');
            $client->setAccessType('offline');

            //Request
            $access_token = $client->getAccessToken();
            $calendar     = new Google_Service_Calendar($client);
            $data = $calendar->calendarList->listCalendarList();

            $calendar_list = $data->getItems();
            $email = $google_user_api->google_email;
            $enabled_mini_calendar = unserialize($google_user_api->enabled_calendars);
            foreach ($calendar_list as $cl) {
                if (in_array($cl['id'], $enabled_mini_calendar)) {
                    //Display in events
                    $optParams = array(
                      'orderBy' => 'startTime',
                      'singleEvents' => true,
                      'timeMin' => $post['start'],
                      'timeMax' => $post['end'],
                    );
                    $events = $calendar->events->listEvents($cl['id'], $optParams);
                    $bgcolor = "#38a4f8";
                    if ($cl->backgroundColor != '') {
                        $bgcolor = $cl->backgroundColor;
                    }

                    foreach ($events->items as $event) {
                        $gevent = $this->event_model->getEventByGoogleEventId($event->id);

                        if (empty($gevent)) {
                            if ($event->start->timeZone != '') {
                                $tz = new DateTimeZone($event->start->timeZone);
                                $timezone = $event->start->timeZone;
                            } else {
                                $tz = new DateTimeZone($user_timezone);
                                $timezone = $user_timezone;
                            }

                            if ($event->start->dateTime != '') {
                                $date = new DateTime($event->start->dateTime);
                                $date->setTimezone($tz);

                                $start_date = $date->format('Y-m-d H:i:s');
                            } else {
                                $date = new DateTime($event->start->date);
                                $date->setTimezone($tz);

                                $start_date = $date->format('Y-m-d H:i:s');
                            }

                            if ($event->end->dateTime != '') {
                                $date = new DateTime($event->end->dateTime);
                                $date->setTimezone($tz);

                                $end_date = $date->format('Y-m-d H:i:s');
                            } else {
                                $date = new DateTime($event->end->date);
                                $date->setTimezone($tz);

                                $end_date = $date->format('Y-m-d H:i:s');
                            }

                            if ($event->summary != '') {
                                $resources_user_events[$inc]['geventID'] = $event->id;
                                $resources_user_events[$inc]['resourceId'] = "user17";
                                $resources_user_events[$inc]['timezone'] = $timezone;
                                $resources_user_events[$inc]['title'] = $event->summary;
                                $resources_user_events[$inc]['description'] = $event->summary . "<br />" . "<i class='fa fa-calendar'></i> " . $event->start->date;
                                $resources_user_events[$inc]['start'] = $start_date;
                                $resources_user_events[$inc]['end'] = $end_date;
                                $resources_user_events[$inc]['color'] = $bgcolor;
                                $resources_user_events[$inc]['events'] = $event;

                                $inc++;
                            }
                        }
                    }
                }
            }
        }

        echo "<pre>";
        print_r($resources_user_events);
        exit;
    }

    public function ajax_load_upcoming_events()
    {
        $this->load->model('Event_model', 'event_model', 'settings_model');

        $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE]);
        if ($settings[0]) {
            date_default_timezone_set($settings['calendar_timezone']);
        }

        $company_id = logged('company_id');
        $role_id = logged('role');
        if ($role_id == 1 || $role_id == 2) {
            $upcoming_events = $this->event_model->getAllUpComingEvents();
        } else {
            $upcoming_events = $this->event_model->getAllUpComingEventsByCompanyId($company_id);
        }

        //Google Events
        $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);
        $a_settings = unserialize($settings[0]->value);
        if ($a_settings) {
            $user_timezone = $a_settings['calendar_timezone'];
        } else {
            $user_timezone = 'UTC';
        }

        $inc = 0;
        $google_events    = array();
        $enabled_calendar = array();
        $calendar_list    = array();
        $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
        if ($google_user_api) {
            $google_credentials = google_credentials();

            $access_token = "";
            $refresh_token = "";
            $google_client_id = "";
            $google_secrect = "";
            $calendar_list = array();

            if (isset($google_user_api->google_access_token)) {
                $access_token = $google_user_api->google_access_token;
            }

            if (isset($google_user_api->google_refresh_token)) {
                $refresh_token = $google_user_api->google_refresh_token;
            }

            if (isset($google_credentials['client_id'])) {
                $google_client_id = $google_credentials['client_id'];
            }

            if (isset($google_credentials['client_secret'])) {
                $google_secrect = $google_credentials['client_secret'];
            }

            //Set Client
            $client = new Google_Client();
            $client->setClientId($google_client_id);
            $client->setClientSecret($google_secrect);
            $client->setAccessToken($access_token);
            $client->refreshToken($refresh_token);
            $client->setScopes(array(
                'email',
                'profile',
                'https://www.googleapis.com/auth/calendar',
            ));
            $client->setApprovalPrompt('force');
            $client->setAccessType('offline');

            //Request
            $access_token = $client->getAccessToken();
            if(!$client->isAccessTokenExpired()) {
                $calendar     = new Google_Service_Calendar($client);
                $data = $calendar->calendarList->listCalendarList();

                $calendar_list = $data->getItems();
                $email = $google_user_api->google_email;

                $start_date = date("Y-m-d");
                $end_date   = date("Y-m-d", strtotime("+5 days"));

                $start_date = $start_date . 'T00:00:00+08:00';
                $end_date   = $end_date . 'T00:00:00+08:00';

                $optParams = array(
                  'orderBy' => 'startTime',
                  'singleEvents' => true,
                  'timeMin' => $start_date,
                  'timeMax' => $end_date,
                );

                foreach ($calendar_list as $cl) {
                    //Display in events
                    $events = $calendar->events->listEvents($cl['id'], $optParams);
                    $bgcolor = "#38a4f8";
                    if ($cl->backgroundColor != '') {
                        $bgcolor = $cl->backgroundColor;
                    }

                    foreach ($events->items as $event) {
                        $gevent = $this->event_model->getEventByGoogleEventId($event->id);

                        if (empty($gevent)) {
                            if ($event->start->timeZone != '') {
                                $tz = new DateTimeZone($event->start->timeZone);
                            } else {
                                $tz = new DateTimeZone($user_timezone);
                            }

                            if ($event->start->dateTime != '') {
                                $date = new DateTime($event->start->dateTime);
                                $date->setTimezone($tz);
                                $start_date = $date->format('Y-m-d g:i a');
                            } else {
                                $date = new DateTime($event->start->date);
                                $date->setTimezone($tz);
                                $start_date = $date->format('Y-m-d');
                            }

                            if ($event->end->dateTime != '') {
                                $date = new DateTime($event->end->dateTime);
                                $date->setTimezone($tz);
                                $end_date = $date->format('Y-m-d g:i a');
                            } else {
                                $date = new DateTime($event->end->date);
                                $date->setTimezone($tz);
                                $end_date = $date->format('Y-m-d');
                            }

                            if ($event->summary != '') {
                                $google_events[$inc]['geventID'] = $event->id;
                                $google_events[$inc]['resourceId'] = "user17";
                                $google_events[$inc]['title'] = $event->summary;
                                $google_events[$inc]['description'] = $event->summary;
                                $google_events[$inc]['start'] = $start_date;
                                $google_events[$inc]['end'] = $end_date;
                                $google_events[$inc]['color'] = $bgcolor;

                                $inc++;
                            }
                        }
                    }
                }
            }            
        }

        $events = array();
        foreach ($upcoming_events as $u) {
            $events[$u->start_date][] = [
                'event_id' => $u->id,
                'type' => 'events',
                'event_title' => get_customer_by_id($u->customer_id)->contact_name,
                'event_type' => $u->event_type,
                'event_tag' => $u->event_tag,
                'event_number' => $u->event_number,
                'event_description' => $u->event_description,
                'start_date' => date('F j, Y', strtotime($u->start_date)),
                'end_date' => date('F j, Y', strtotime($u->end_date)),
                'start_time' => $u->start_time,
                'end_time' => $u->end_time,
                'what_of_even' => $u->what_of_even,
                'event_color' => $u->event_color,
                'address' => $u->event_address . ' ' . $u->event_state,
                'url_link' => $u->url_link,
                'profile_img' => $u->profile_img,
                'first_name' => $u->FName,
                'last_name' => $u->LName,
            ];
        }

        foreach ($google_events as $g) {
            $start_date = date("Y-m-d", strtotime($g['start']));
            $events[$start_date][] = [
                'event_id' => $g['geventID'],
                'type' => 'g-events',
                'event_number' => '',
                'event_title' => $g['title'],
                'event_type' => 'Google Event',
                'event_description' => $g['description'],
                'start_date' => date('F j, Y', strtotime($g['start'])),
                'end_date' => date('F j, Y', strtotime($g['end'])),
                'start_time' => date('H:i:s', strtotime($g['start'])),
                'end_time' => date('H:i:s', strtotime($g['end'])),
                'event_color' => '#4cb052',
                'what_of_even' => 'Google Calendar',
                'address' => ''
            ];
        }

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        $this->page_data['events'] = $events;
        $this->load->view('workcalender/ajax_load_upcoming_events', $this->page_data);
    }

    public function debugCalendar()
    {
        $this->load->model('GoogleAccounts_model');
        $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
        if ($google_user_api) {
            $google_credentials = google_credentials();

            $google_credentials = google_credentials();

            $access_token = "";
            $refresh_token = "";
            $google_client_id = "";
            $google_secrect = "";
            $calendar_list = array();

            if (isset($google_user_api->google_access_token)) {
                $access_token = $google_user_api->google_access_token;
            }

            if (isset($google_user_api->google_refresh_token)) {
                $refresh_token = $google_user_api->google_refresh_token;
            }

            if (isset($google_credentials['client_id'])) {
                $google_client_id = $google_credentials['client_id'];
            }

            if (isset($google_credentials['client_secret'])) {
                $google_secrect = $google_credentials['client_secret'];
            }

            //Set Client
            $client = new Google_Client();
            $client->setClientId($google_client_id);
            $client->setClientSecret($google_secrect);
            $client->setAccessToken($access_token);
            $client->refreshToken($refresh_token);

            //Request
            $service = new Google_Service_Calendar($client);
            $calendars = $service->calendarList->listCalendarList();
            $calendar_name = $this->GoogleAccounts_model->getDefaultAutoSyncCalendarName();
            $is_exists = false;
            $calendar_id = '';

            foreach ($calendars as $c) {
                if ($c->summary == $calendar_name) {
                    $is_exists = true;
                    $calendar_id = $c->id;
                }
            }

            echo $calendar_id;
            exit;
            $calendarId = '7knabuhd3oucjobelbarl1i3ts@group.calendar.google.com';
            $calendarListEntry = $service->calendarList->get($calendarId);
            echo "<pre>";
            print_r($calendarListEntry);
            exit;
        }
    }

    public function ajax_update_event()
    {
        $this->load->model('General_model', 'general');

        $post = $this->input->post();
        $new_start_date = date("Y-m-d",strtotime($post['start_date']));
        if( $post['end_date'] ){
            $new_end_date = date("Y-m-d",strtotime($post['end_date']));
        }else{
            $new_end_date = $new_start_date;
        }        

        if( $post['event_type'] == 'jobs' ){
            if( $post['user_id'] > 0 ){
                $jobs_data = [
                    'start_date' => $new_start_date,
                    'end_date' => $new_end_date,
                    'employee_id' => $post['user_id']
                ];
            }else{
                $jobs_data = [
                    'start_date' => $new_start_date,
                    'end_date' => $new_end_date
                ];
            }
            
            $this->general->update_with_key_field($jobs_data, $post['event_id'], 'jobs', 'id');
        }elseif( $post['event_type'] == 'appointments' ){
            $new_appointment_time = date("H:i:s",strtotime($post['start_date']));
            if( $post['user_id'] > 0 ){
                $appointment_data = [
                    'appointment_date' => $new_start_date,
                    'appointment_time' => $new_appointment_time,
                    'user_id' => $post['user_id']
                ];
            }else{
                $appointment_data = [
                    'appointment_date' => $new_start_date,
                    'appointment_time' => $new_appointment_time
                ];
            }
            $this->general->update_with_key_field($appointment_data, $post['event_id'], 'appointments', 'id');
        }else{
            if( $post['user_id'] > 0 ){
                $events_data = [
                    'start_date' => $new_start_date,
                    'end_date' => $new_end_date,
                    'employee_id' => $post['user_id']
                ];
            }else{
                $events_data = [
                    'start_date' => $new_start_date,
                    'end_date' => $new_end_date
                ];
            }
            
            $this->general->update_with_key_field($events_data, $post['event_id'], 'events', 'id');
        }
    }

    public function ajax_update_google_event()
    {
        $is_success = false;

        $post = $this->input->post();
        $google_user_api  = $this->GoogleAccounts_model->getByAuthUser();
        if ($google_user_api) {
            $company_id = logged('company_id');
            $settings   = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);
            $a_settings = unserialize($settings[0]->value);
            if ($a_settings) {
                $user_timezone = $a_settings['calendar_timezone'];
            } else {
                $user_timezone = 'UTC';
            }

            $google_credentials = google_credentials();

            $access_token = "";
            $refresh_token = "";
            $google_client_id = "";
            $google_secrect = "";
            $calendar_list = array();

            if (isset($google_user_api->google_access_token)) {
                $access_token = $google_user_api->google_access_token;
            }

            if (isset($google_user_api->google_refresh_token)) {
                $refresh_token = $google_user_api->google_refresh_token;
            }

            if (isset($google_credentials['client_id'])) {
                $google_client_id = $google_credentials['client_id'];
            }

            if (isset($google_credentials['client_secret'])) {
                $google_secrect = $google_credentials['client_secret'];
            }

            $new_start_date = new DateTime($post['start_date']);
            if( $post['end_date'] ){
                $new_end_date = new DateTime($post['end_date']);
            }else{
                $new_end_date = new DateTime($post['start_date']);
            }

            try{
                //Set Client
                $client = new Google_Client();
                $client->setClientId($google_client_id);
                $client->setClientSecret($google_secrect);
                $client->setAccessToken($access_token);
                $client->refreshToken($refresh_token);

                //Request
                $service = new Google_Service_Calendar($client);
                $event   = $service->events->get($post['calendar_id'],$post['event_id']);
                //print_r($event);

                $start = new Google_Service_Calendar_EventDateTime();
                $start->setTimeZone($user_timezone);
                $start->setDateTime($new_start_date->format(\DateTime::RFC3339));  
                $event->setStart($start);
                $end = new Google_Service_Calendar_EventDateTime();
                $end->setDateTime($new_end_date->format(\DateTime::RFC3339));  
                $event->setEnd($end);

                $service->events->update($post['calendar_id'],$event->getId(),$event);
                $is_success = true;
            }catch(Exception $e){
                $is_success = false;
            }
        }

        $json_data = ['is_success' => $is_success];
        echo json_encode($json_data);
    }

    public function ajax_create_appointment()
    {
        $this->load->model('Appointment_model');

        $post       = $this->input->post();
        $company_id = logged('company_id');
        $is_success = false;
        $message    = 'Cannot create appointment';

        if ($post['appointment_date'] != '' && $post['appointment_time'] != '' && $post['appointment_user_id'] != '' && $post['appointment_customer_id'] != '' && $post['appointment_type_id'] != '') {

            if( $post['appointment_tags'] != '' ){
                $tags = implode(",", $post['appointment_tags']);
            }else{
                $tags = '';
            }

            $data_appointment = [
                'appointment_date' => date("Y-m-d",strtotime($post['appointment_date'])),
                'appointment_time' => date("H:i:s", strtotime($post['appointment_time'])),
                'user_id' => $post['appointment_user_id'],
                'prof_id' => $post['appointment_customer_id'],
                'company_id' => $company_id,
                'tag_ids' => $tags,
                'total_item_price' => 0,
                'total_item_discount' => 0,
                'total_amount' => 0,
                'appointment_type_id' => $post['appointment_type_id'],
                'is_paid' => 0,
                'is_wait_list' => 0,
                'created' => date("Y-m-d H:i:s")
            ];

            $last_id = $this->Appointment_model->createAppointment($data_appointment);

            customerAuditLog(logged('id'), $post['appointment_customer_id'], $last_id, 'Appointment', 'Created an appointment');

            $is_success = true;
            $message    = '';

        } else {

            $message = 'Required fields cannot be empty';
            
            if( $post['appointment_user_id'] == '' ){
                $message = 'Please select employee to assign to this appointment';
            }
            
            if( $post['appointment_customer_id'] == '' ){
                $message = 'Please select customer to assign to this appointment';
            }

            if( $post['appointment_type_id'] == '' ){
                $message = 'Please select appointment type';
            }
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_create_appointment_wait_list()
    {
        $this->load->model('Appointment_model');

        $post       = $this->input->post();
        $company_id = logged('company_id');
        $is_success = false;
        $message    = 'Cannot create appointment';

        if ($post['appointment_date'] != '' && $post['appointment_time'] != '' && $post['appointment_customer_id'] != '' && $post['appointment_type_id'] != '') {

            $data_appointment = [
                'appointment_date' => date("Y-m-d",strtotime($post['appointment_date'])),
                'appointment_time' => date("H:i:s", strtotime($post['appointment_time'])),
                'user_id' => 0,
                'prof_id' => $post['appointment_customer_id'],
                'company_id' => $company_id,
                'tag_ids' => '',
                'total_item_price' => 0,
                'total_item_discount' => 0,
                'total_amount' => 0,
                'appointment_type_id' => $post['appointment_type_id'],
                'is_paid' => 0,
                'is_wait_list' => 1,
                'created' => date("Y-m-d H:i:s")
            ];

            $last_id = $this->Appointment_model->createAppointment($data_appointment);

            customerAuditLog(logged('id'), $post['appointment_customer_id'], $last_id, 'Appointment', 'Created appointment waitlist');

            $is_success = true;
            $message    = '';

        } else {

            $message = 'Required fields cannot be empty';

            if( $post['appointment_customer_id'] == '' ){
                $message = 'Please select customer';
            }

            if( $post['appointment_type_id'] == '' ){
                $message = 'Please select appointment type';
            }
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_view_appointment()
    {
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');

        $post = $this->input->post();
        $company_id  = logged('company_id');
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $company_id);
        $tags = $this->EventTags_model->getAllByCompanyId($company_id, array());  

        $a_tags = array();
        $selected_tags = explode(",", $appointment->tag_ids);
        foreach($tags as $t){
            if( in_array($t->id, $selected_tags) ){
                $a_tags[$t->id] = ['name' => $t->name, 'icon' => $t->marker_icon, 'is_marker_icon_default_list' => $t->is_marker_icon_default_list, 'cid' => $t->company_id];
            }
        }

        $this->page_data['a_tags'] = $a_tags;
        $this->page_data['appointment'] = $appointment;
        $this->load->view('workcalender/ajax_load_view_appointment', $this->page_data);
    }

    public function ajax_edit_appointment()
    {
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentType_model');
        $this->load->model('EventTags_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $tags = $this->EventTags_model->getAllByCompanyId($cid, array());
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $cid);        
        $appointmentTypes = $this->AppointmentType_model->getAllByCompany($cid, true);

        $a_tags = array();
        $selected_tags = explode(",", $appointment->tag_ids);
        foreach($tags as $t){
            if( in_array($t->id, $selected_tags) ){
                $a_tags[$t->id] = $t->name;
            }
        }

        $this->page_data['a_selected_tags'] = $a_tags;
        $this->page_data['appointment'] = $appointment;
        $this->page_data['appointmentTypes'] = $appointmentTypes;
        $this->load->view('workcalender/ajax_edit_appointment', $this->page_data);
    }

    public function ajax_update_appointment()
    {
        $this->load->model('Appointment_model');

        $is_success = false;
        $message    = 'Cannot find appointment';

        $post       = $this->input->post();
        $cid = logged('company_id');
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['aid'], $cid);

        if( $appointment ){
            if ($post['appointment_date'] != '' && $post['appointment_time'] != '' && $post['appointment_user_id'] != '' && $post['appointment_customer_id'] != '' && $post['appointment_type_id'] > 0) {

                if( $post['appointment_tags'] != '' ){
                    $tags = implode(",", $post['appointment_tags']);
                }else{
                    $tags = '';
                }

                $data_appointment = [
                    'appointment_date' => date("Y-m-d",strtotime($post['appointment_date'])),
                    'appointment_time' => date("H:i:s", strtotime($post['appointment_time'])),
                    'user_id' => $post['appointment_user_id'],
                    'prof_id' => $post['appointment_customer_id'],
                    'tag_ids' => $tags,
                    'appointment_type_id' => $post['appointment_type_id']
                ];

                $this->Appointment_model->update($appointment->id, $data_appointment);

                customerAuditLog(logged('id'), $post['appointment_customer_id'], $appointment->id, 'Appointment', 'Updated appointment id '.$appointment->id);

                $is_success = true;
                $message    = '';

            } else {
                $message = 'Required fields cannot be empty';
            }
        }

        $json_data = [
            'is_success' => $is_success,
            'message' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_update_appointment_waitlist()
    {
        $this->load->model('Appointment_model');

        $is_success = false;
        $message    = 'Cannot find waitlist';
        $is_wait_list = 0;

        $post       = $this->input->post();
        $cid = logged('company_id');
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['wid'], $cid);

        if( $appointment ){
            if ($post['appointment_date'] != '' && $post['appointment_time'] != '' && $post['appointment_user_id'] != '' && $post['appointment_customer_id'] != '' && $post['appointment_type_id'] > 0) {
                if( $post['appointment_tags'] != '' ){
                    $a_tags = implode($post['appointment_tags']);
                }else{
                    $a_tags = '';
                }

                $data_appointment = [
                    'is_wait_list' => $post['is_wait_list'],
                    'appointment_date' => date("Y-m-d",strtotime($post['appointment_date'])),
                    'appointment_time' => date("H:i:s", strtotime($post['appointment_time'])),
                    'user_id' => $post['appointment_user_id'],
                    'prof_id' => $post['appointment_customer_id'],
                    'tag_ids' => $a_tags,
                    'appointment_type_id' => $post['appointment_type_id']
                ];

                $this->Appointment_model->update($appointment->id, $data_appointment);

                customerAuditLog(logged('id'), $post['appointment_customer_id'], $appointment->id, 'Appointment', 'Updated appointment id '.$appointment->id);

                $is_success = true;
                $message    = '';
                $is_wait_list = $post['is_wait_list'];

            } else {
                $message = 'Required fields cannot be empty';
            }
        }

        $json_data = [
            'is_wait_list' => $is_wait_list,
            'is_success' => $is_success,
            'message' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_appointment()
    {
        $this->load->model('Appointment_model');

        $is_success = false;
        $message    = 'Cannot find appointment';

        $post       = $this->input->post();
        $cid = logged('company_id');
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $cid);

        if( $appointment ){
            $appointment_id = $appointment->id;
            $appointment_cus_id = $appointment->prof_id;

            $this->Appointment_model->delete($appointment->id);

            customerAuditLog(logged('id'), $appointment_cus_id, $appointment_id, 'Appointment', 'Deleted appointment id '.$appointment_id);

            $is_success = true;
            $message    = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'message' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_checkout_appointment()
    {
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('AppointmentItem_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Business_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $tags = $this->EventTags_model->getAllByCompanyId($cid, array());
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $cid);
        $optionAppointmentTypes = $this->Appointment_model->optionAppointmentType();

        $a_tags = array();
        $selected_tags = explode(",", $appointment->tag_ids);
        foreach($tags as $t){
            if( in_array($t->id, $selected_tags) ){
                $a_tags[$t->id] = $t->name;
            }
        }

        $appointmentItems = $this->AppointmentItem_model->getAllByAppointmentId($appointment->id);
        $onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($cid);
        $customer = $this->AcsProfile_model->getByProfId($appointment->prof_id);
        $company  = $this->Business_model->getByCompanyId($cid);

        $this->page_data['company']  = $company;
        $this->page_data['customer'] = $customer;
        $this->page_data['onlinePaymentAccount'] = $onlinePaymentAccount;
        $this->page_data['a_selected_tags'] = $a_tags;
        $this->page_data['appointment'] = $appointment;
        $this->page_data['appointmentItems'] = $appointmentItems;
        $this->page_data['optionAppointmentTypes'] = $optionAppointmentTypes;
        $this->load->view('workcalender/ajax_checkout_appointment', $this->page_data);
    }

    public function ajax_view_appointment_payment_details()
    {
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('AppointmentItem_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $tags = $this->EventTags_model->getAllByCompanyId($cid, array());
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $cid);
        $optionAppointmentTypes = $this->Appointment_model->optionAppointmentType();

        $a_tags = array();
        $selected_tags = explode(",", $appointment->tag_ids);
        foreach($tags as $t){
            if( in_array($t->id, $selected_tags) ){
                $a_tags[$t->id] = $t->name;
            }
        }

        $appointmentItems = $this->AppointmentItem_model->getAllByAppointmentId($appointment->id);

        $this->page_data['a_selected_tags'] = $a_tags;
        $this->page_data['appointment'] = $appointment;
        $this->page_data['appointmentItems'] = $appointmentItems;
        $this->page_data['optionAppointmentTypes'] = $optionAppointmentTypes;
        $this->load->view('workcalender/ajax_view_appointment_payment_details', $this->page_data);
    }

    public function ajax_save_checkout_items()
    {
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentItem_model');

        $post       = $this->input->post();
        $cid        = logged('company_id');
        $is_success = false;
        $message    = 'Cannot create appointment';

        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['aid'], $cid);

        if( $appointment ) {
            if( isset($post['item_id']) ){
                $this->AppointmentItem_model->deleteAllByAppointmentId($appointment->id);
                $total_tax = 0;
                $total_discount = 0;
                $total_items    = 0;
                foreach( $post['item_id'] as $key => $value ){
                    if( isset($post['price'][$key]) && isset($post['discount'][$key]) ){

                        $data_item = [
                            'appointment_id' => $appointment->id,
                            'item_id' => $value,
                            'item_name' => $post['item_name'][$key],
                            'item_price' => $post['price'][$key],
                            'qty' => $post['qty'][$key],
                            'tax_percentage' => $post['tax'][$key],
                            'discount_amount' => $post['discount'][$key],
                            'created' => date("Y-m-d H:i:s")
                        ];

                        $tax_amount = ($post['price'][$key] * $post['qty'][$key]) * ($post['tax'][$key] / 100);
                        $total_tax += $tax_amount;

                        $this->AppointmentItem_model->create($data_item);

                        $total_discount += $post['discount'][$key];
                        $total_items += $post['price'][$key];                    
                    }
                }

                $total_amount = ($total_items + $total_tax) - $total_discount;
                $data_appointment = [
                    'total_item_price' => $total_items,
                    'total_item_discount' => $total_discount,
                    'total_amount' => $total_amount,
                    'total_tax' => $total_tax
                ];

                $this->Appointment_model->update($appointment->id, $data_appointment);

                $is_success = true;
                $message    = '';
            }else{
                $message    = 'Please select an item';
            }
        } else {
            $message = 'Required fields cannot be empty';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_appointment_cash_checkout()
    {
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentItem_model');

        $post       = $this->input->post();
        $cid        = logged('company_id');
        $is_success = false;
        $message    = 'Cannot find appointment';

        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['cash_checkout_aid'], $cid);

        if( $appointment ) {
            if( $post['cash_amount_receive'] <= 0 ){
                $message = 'Please enter amount received';
            }elseif( $post['cash_date_received'] == '' ){
                $message = 'Please enter amount date received';
            }else{
                $data_appointment = [
                    'payment_gateway' => $this->Appointment_model->isCashPayment(),
                    'date_paid' => date("Y-m-d", strtotime($post['cash_date_received'])),
                    'amount_received' => $post['cash_amount_receive'],
                    'is_paid' => $this->Appointment_model->isPaid()              
                ];

                $this->Appointment_model->update($appointment->id, $data_appointment);

                $is_success = true;
                $message    = '';
            }            

        } else {
            $message = 'Cannot find data';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $message
        ];

        echo json_encode($json_data);
    }

    public function ajax_appointment_converge_checkout()
    {
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentItem_model');
        $this->load->model('AcsProfile_model');

        $post       = $this->input->post();
        $cid        = logged('company_id');
        $is_success = false;
        $message    = 'Cannot find appointment';

        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['converge_checkout_aid'], $cid);
        if( $appointment ) {
            if( $post['converge_amount_receive'] <= 0 ){
                $message = 'Please enter amount received';
            }else{
                $customer = $this->AcsProfile_model->getByProfId($appointment->prof_id);
                if( $customer ){
                    $converge_data = [
                        'amount' => $post['converge_amount_receive'],
                        'card_number' => $post['card_number'],
                        'exp_month' => $post['exp_month'],
                        'exp_year' => $post['exp_year'],
                        'card_cvc' => $post['cvc'],
                        'address' => $customer->mail_add,
                        'zip' => $customer->zip_code
                    ];
                    $result = $this->converge_send_sale($converge_data);
                    if ($result['is_success']) {
                        $data_appointment = [
                            'payment_gateway' => $this->Appointment_model->isConvergePayment(),
                            'date_paid' => date("Y-m-d"),
                            'amount_received' => $post['converge_amount_receive'],
                            'is_paid' => $this->Appointment_model->isPaid()              
                        ];

                        $this->Appointment_model->update($appointment->id, $data_appointment);

                        $is_success = true;
                        $message = '';
                    }else{
                        $message = 'Cannot process payment';
                        $message .= "\n" . $result['msg'];
                    }
                }else{
                    $message = 'Cannot find customer';
                }
            }  
        } else {
            $message = 'Cannot find data';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $message
        ];

        echo json_encode($json_data);
    }

    public function converge_send_sale($data)
    {
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = '';

        $comp_id = logged('company_id');
        $convergeCred = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($comp_id);
        if ($convergeCred) {
            $exp_year = date("m/d/" . $data['exp_year']);
            $exp_date = $data['exp_month'] . date("y", strtotime($exp_year));
            /*$converge = new \wwwroth\Converge\Converge([
                'merchant_id' => $convergeCred->converge_merchant_id,
                'user_id' => $convergeCred->converge_merchant_user_id,
                'pin' => $convergeCred->converge_merchant_pin,
                'demo' => false,
            ]);*/
            $converge = new \wwwroth\Converge\Converge([
                'merchant_id' => CONVERGE_MERCHANTID,
                'user_id' => CONVERGE_MERCHANTUSERID,
                'pin' => CONVERGE_MERCHANTPIN,
                'demo' => false,
            ]);
            $createSale = $converge->request('ccsale', [
                'ssl_card_number' => $data['card_number'],
                'ssl_exp_date' => $exp_date,
                'ssl_cvv2cvc2' => $data['card_cvc'],
                'ssl_amount' => $data['amount'],
                'ssl_avs_address' => $data['address'],
                'ssl_avs_zip' => $data['zip'],
            ]);

            if ($createSale['success'] == 1) {
                $is_success = true;
                $msg = '';
            } else {
                $is_success = false;
                $msg = $createSale['errorMessage'];
            }
        } else {
            $msg = 'Converge account not found';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function main_calendar_resource_users()
    {
        $company_id = logged('company_id');
        $calendar_filter_eids = $this->session->userdata('calendar_filter_eids');        
        if( $calendar_filter_eids == 'multiselect-all' || $calendar_filter_eids == null ){
            $get_users  = $this->Users_model->getCompanyUsers($company_id, null);
        }else{            
            $filters['eids'] = $calendar_filter_eids;
            $get_users  = $this->Users_model->getCompanyUsers($company_id, $filters);
        }

        $resources_users = array();
        $resources_user_events = array();

        if (!empty($get_users)) {
            $inc = 0;
            $default_imp_img = base_url('uploads/users/default.png');
            foreach ($get_users as $get_user) {
                $default_imp_img = userProfileImage($get_user->id);

                /*if( $get_user->profile_img != null ) {
                        $default_imp_img = base_url('uploads/users/'.$get_user->profile_img ."." . $get_user->img_type );
                } else {
                    $default_imp_img = base_url('uploads/users/default.png');
                }*/

                $resources_users[$inc]['id'] = "user" . $get_user->id;
                $resources_users[$inc]['building'] = 'Employee';
                $resources_users[$inc]['title'] = "#" . $get_user->id . " " . $get_user->FName . " " . $get_user->LName;
                $resources_users[$inc]['employee_name'] = $get_user->FName . " " . $get_user->LName;
                $resources_users[$inc]['imageurl'] = $default_imp_img;
                $inc++;
            }
        }

        echo json_encode($resources_users);
    }

    public function ajax_load_checkout_item_list()
    {
        $this->load->model('Items_model');

        $cid   = logged('company_id');
        $filters[] = ['field' => 'type', 'value' => 'product'];
        $filters[] = ['field' => 'type', 'value' => 'service'];
        $items = $this->Items_model->getByCompanyId($cid, $filters);
        
        $this->page_data['items'] = $items;
        $this->load->view('workcalender/ajax_load_checkout_item_list', $this->page_data);
    }

    public function ajax_load_wait_list()
    {
        $this->load->model('Appointment_model');
        
        $cid   = logged('company_id');
        $waitList = $this->Appointment_model->getAllCompanyWaitList($cid);
        
        $this->page_data['waitList'] = $waitList;
        $this->load->view('workcalender/ajax_load_wait_list', $this->page_data);
    }

    public function ajax_load_edit_wait_list()
    {
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentType_model');
        $this->load->model('EventTags_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $tags = $this->EventTags_model->getAllByCompanyId($cid, array());
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $cid);        
        $appointmentTypes = $this->AppointmentType_model->getAllByCompany($cid, true);

        $a_tags = array();
        $selected_tags = explode(",", $appointment->tag_ids);
        foreach($tags as $t){
            if( in_array($t->id, $selected_tags) ){
                $a_tags[$t->id] = $t->name;
            }
        }

        $this->page_data['a_selected_tags'] = $a_tags;
        $this->page_data['appointment'] = $appointment;
        $this->page_data['appointmentTypes'] = $appointmentTypes;
        $this->load->view('workcalender/ajax_edit_appointment_wait_list', $this->page_data);
    }

    public function ajax_update_calendar_drop_waitlist()
    {
        $this->load->model('Appointment_model');

        $is_error = 1;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');        
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['wid'], $cid); 
        if( $appointment ){
            if( $appointment->user_id > 0 ){
                $user_id = $appointment->user_id;
                if( $post['user_id'] > 0 ){
                    $user_id = $post['user_id'];
                }

                $data_appointment = [
                    'appointment_date' => date("Y-m-d",strtotime($post['start_date'])),
                    'appointment_time' => date("H:i:s", strtotime($post['start_date'])),
                    'user_id' => $user_id,
                    'is_wait_list' => 0
                ];

                $this->Appointment_model->update($appointment->id, $data_appointment);

                customerAuditLog(logged('id'), $appointment->prof_id, $appointment->id, 'Appointment', 'Moved waitlist id '.$appointment->id.' to appointment');

                $is_error = 0;
                $msg = '';

            }else{
                if( $post['user_id'] > 0 ){
                    $data_appointment = [
                        'appointment_date' => date("Y-m-d",strtotime($post['start_date'])),
                        'appointment_time' => date("H:i:s", strtotime($post['start_date'])),
                        'user_id' => $post['user_id'],
                        'is_wait_list' => 0
                    ];

                    $this->Appointment_model->update($appointment->id, $data_appointment);

                    $is_error = 0;
                    $msg = '';
                }else{
                    $msg = 'Please assign an employee. You can do this by clicking edit wait list or drop the wait list in employee column in calendar.';    
                }
            }
        }    

        $json_data = ['is_error' => $is_error, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_update_calendar_employee_filter()
    {
        $post = $this->input->post();
        $this->session->set_userdata('calendar_filter_eids', $post['eids']);

        $json_data = ['is_error' => 0, 'msg' => ''];

        echo json_encode($json_data);
    }

    public function ajax_set_appointment_paid()
    {
        $this->load->model('Appointment_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');        
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['aid'], $cid);

        if( $appointment ){
            $data_appointment = [
                'payment_gateway' => $post['payment_gateway'],
                'date_paid' => date("Y-m-d"),
                'amount_received' => $appointment->total_amount,
                'is_paid' => $this->Appointment_model->isPaid()              
            ];

            $is_success = 1;
            $this->Appointment_model->update($appointment->id, $data_appointment);
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function print_contact( $contact_id )
    {
        $user = $this->Users_model->getUser($contact_id);

        $this->page_data['user'] = $user;
        $this->load->view('workcalender/print_contact', $this->page_data);
    }
}


/* End of file items.php */

/* Location: ./application/controllers/items.php */
