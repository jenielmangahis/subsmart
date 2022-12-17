<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Workcalender extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $this->checkLogin();

        $this->load->helper('google_calendar_helper');

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
            //'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/js/v2/bootstrap-datetimepicker.v2.min.js',
            'assets/plugins/timeline_calendar/main.js',
            'assets/frontend/js/workcalender/workcalender.js',
            'assets/js/quick_launch.js',
            'assets/js/jquery.slidebox.min.js',
        ));
    }

    public function index()
    {
        $this->page_data['page']->title = 'Schedule';
        $this->page_data['page']->parent = 'Calendar';

        $this->hasAccessModule(4); 
        $this->load->model('Event_model', 'event_model');
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentType_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('CalendarSettings_model');

        add_css(array(
            'assets/css/bootstrap-multiselect.min.css',
            'assets/js/v2/drawer/drawer.min.css',            
        ));

        add_footer_js(array(
            'assets/js/bootstrap-multiselect.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.js',
            'assets/js/v2/drawer/drawer.min.js',
        ));


        $role = logged('role');
        $company_id = logged('company_id');
        $events = $this->event_model->getAllByCompany($company_id);

        $this->page_data['events'] = array();
        $this->session->set_userdata('calendar_filter_eids', 'multiselect-all');

        // Setting of the calender
        $calender_settings  = $this->CalendarSettings_model->getByCompanyId($company_id); 
        $default_time_to    = date("H:00 A");
        $calendar_start_day = 0;
        $default_timezone   = 'Central Time (UTC -5)';
        $default_time_to_interval = 0;
        $default_calendar_view    = 'Month';  

        if( $calender_settings ){
            if( $calender_settings->time_interval != '' ){
                $timeInterval = explode(" ", $calender_settings->time_interval);
                if( $timeInterval[0] ){
                    $default_time_to = date("H:00 A", strtotime("+".trim($timeInterval[0]).' hours'));
                    $default_time_to_interval = trim($timeInterval[0]);
                }
                
            }

            if( $calender_settings->week_starts_on == 'Monday' ){
                $calendar_start_day = 1;
            }

            if( $calender_settings->default_view != '' ){
                $default_calendar_view = $calender_settings->default_view;
            }

            if( $calender_settings->timezone != '' ){
                $default_timezone = $calender_settings->timezone;
            }
        } 

        $this->page_data['calendar_start_day'] = $calendar_start_day;
        $this->page_data['default_time_to'] = $default_time_to;
        $this->page_data['default_time_to_interval'] = $default_time_to_interval;
        $this->page_data['default_calendar_view'] = $default_calendar_view;
        $this->page_data['default_timezone'] = $default_timezone;
        
        if (!empty($events)) {
            $inc = 0;
            foreach ($events as $key => $event) {
                $customer = acs_prof_get_customer_by_prof_id($event->customer_id);

                // label of the event
                if (!empty($customer)) {
                    /*if (!empty($calender_settings)) {
                        $title = acs_prof_make_calender_event_label($calender_settings, $event, $customer);
                    } else {
                        $date = date('a', strtotime($event->start_time));
                        $date = substr($date, -2, 1);
                        $title = date('g', strtotime($event->start_time)) . $date;
                        $title .= ' ' . $customer->first_name . ' ' . $customer->last_name . ', ' . $customer->phone_m;
                    }*/

                    $date = date('a', strtotime($event->start_time));
                    $date = substr($date, -2, 1);
                    $title = date('g', strtotime($event->start_time)) . $date;
                    $title .= ' ' . $customer->first_name . ' ' . $customer->last_name . ', ' . $customer->phone_m;
                }

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

                $this->page_data['events'][$key]['eventId'] = $event->id;
                $this->page_data['events'][$key]['status'] = $event->status;
                $this->page_data['events'][$key]['title'] = (!empty($customer)) ? $title : '';
                $this->page_data['events'][$key]['start'] = date('Y-m-d', strtotime($event->start_date));
                $this->page_data['events'][$key]['end'] = date('Y-m-d', strtotime($event->end_date));
                $this->page_data['events'][$key]['backgroundColor'] = $event->event_color;
            }
        }

        $this->load->library('user_agent');
        if ($this->agent->is_mobile()) {
            $is_mobile = 1;
        } else {
            $is_mobile = 0;
        }

        //Default created by
        $user_id = logged('id');
        $userLogged = $this->Users_model->getUser($user_id);
        $this->page_data['userLogged'] = $userLogged; 

        $onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $appointmentPriorityOptions = $this->Appointment_model->priorityOptions();
        $appointmentPriorityEventOptions = $this->Appointment_model->priorityEventOptions();
        
        $this->load->model('Users_model', 'user_model');

        $default_users  = $this->Users_model->getCompanyUsers($company_id, null, 5);
        $a_default_uid  = array();
        foreach($default_users as $u){
            $a_default_uid[$u->id] = $u->id;
        }

        $this->page_data['a_default_uid'] = $a_default_uid;
        $this->page_data['appointmentPriorityOptions']      = $appointmentPriorityOptions;
        $this->page_data['appointmentPriorityEventOptions'] = $appointmentPriorityEventOptions;
        $this->page_data['mini_calendar_events'] = $this->mini_calendar_events();
        $this->page_data['onlinePaymentAccount'] = $onlinePaymentAccount;
        $this->page_data['appointmentTypes'] = $this->AppointmentType_model->getAllByCompany($company_id, true);
        $this->page_data['get_recent_users'] = $get_recent_users;        
        $this->page_data['resources_users'] = $resources_users;
        $this->page_data['resources_user_events'] = $resources_user_events;
        $this->page_data['is_mobile'] = $is_mobile;
        $this->page_data['users'] = $this->user_model->getUsers();        
        // $this->load->view('workcalender/calender', $this->page_data);
        $this->load->view('v2/pages/workcalender/calender', $this->page_data);
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
        $this->load->model('EventTags_model');
        $this->load->model('Tickets_model');
        $this->load->model('Job_tags_model');

        $post = $this->input->post();
        $role = logged('role');
        $company_id = logged('company_id');

        $events = $this->event_model->getAllByCompany($company_id);

        $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);
        $a_settings = unserialize($settings[0]->value);
        if ($a_settings) {
            $user_timezone = $a_settings['calendar_timezone'];
        } else {
            $user_timezone = 'UTC';
        }

        $google_user_api       = $this->GoogleAccounts_model->getByCompanyId($company_id);
        $get_users             = $this->Users_model->getUsers();
        $resources_user_events = array();
        $inc = 0;
        //Events
        foreach ($events as $event) {
            if ($event->event_description != '') {
                if ($event->employee_id > 0) {
                    $starttime = $event->start_date . " " . $event->start_time;
                    $start_date_time = date('Y-m-d H:i:s', strtotime($event->start_date . " " . $event->start_time));
                    $start_date_end  = date('Y-m-d H:i:s', strtotime($event->end_date . " " . $event->end_time));
                    $title = $event->start_time . " - " . $event->end_time;

                    $custom_html = '<div class="calendar-title-header">';
                        if( $event->event_tag != '' ){
                            $tags = $event->event_tag;
                        }else{
                            $tags = '---';
                        }

                        if (isset($a_settings['work_order_show_customer'])) {
                            $custom_html  .= '<a class="calendar-tile-minmax event-min-max-'.$event->id.'" data-type="event" data-id="'.$event->id.'" href="javascript:void(0);"><span style="font-size:16px;font-weight:bold;display:inline-block;">'. $event->event_number . ' - ' . $tags . '</span></a>';
                        }
                    $custom_html .= '</div>';

                    $view_btn    = '<a class="calendar-tile-view nsm-button primary btn-sm" href="javascript:void(0);" data-type="event" data-id="'.$event->id.'"><i class="bx bx-window-open"></i> View</a>';

                    $gcalendar_btn = '';
                    if( $google_user_api ){
                        $gcalendar_btn = '<a class="calendar-tile-add-gcalendar nsm-button primary btn-sm" href="javascript:void(0);" data-type="event" data-id="'.$event->id.'"><i class="bx bxl-google"></i> Add to Google Calendar</a>';
                    }

                    $custom_html .= '<div class="calendar-tile-details event-tile-'.$event->id.'">';
                        $custom_html .= "<small style='font-size:15px;'><i class='bx bxs-location-plus'></i> " . $event->event_address . "</small>";
                        $custom_html .= "<br /><small style='font-size:15px;display:inline-block;margin-right:5px;height:25px;vertical-align:top;'><i class='bx bxs-user-pin'></i> Tech : </small>";
                        $custom_html .= '<div class="nsm-profile me-3 calendar-tile-assigned-tech" style="background-image: url(\''.userProfileImage($event->employee_id).'\'); width: 20px;display:inline-block;"></div>';
                        $custom_html .= '<br /><small style="font-size:15px;"><i class="bx bx-calendar"></i> ' . $event->start_time . " - " . $event->end_time . "</small>";
                        $custom_html .= '<br/><br/>' . $view_btn . $gcalendar_btn;
                    $custom_html .= '</div>';

                    $resourceIds = array();
                    $resourceIds[] = 'user' . $event->employee_id;
                    $resources_user_events[$inc]['eventId'] = $event->id;
                    $resources_user_events[$inc]['eventType'] = 'events';
                    $resources_user_events[$inc]['resourceIds'] = $resourceIds;
                    $resources_user_events[$inc]['title'] = $title;
                    $resources_user_events[$inc]['customHtml'] = $custom_html;
                    $resources_user_events[$inc]['start'] = $start_date_time;
                    $resources_user_events[$inc]['end'] = $start_date_end;                    
                    $resources_user_events[$inc]['allDay'] = false;
                    $resources_user_events[$inc]['starttime'] = strtotime($starttime);
                    $resources_user_events[$inc]['backgroundColor'] = $event->event_color;

                    $inc++;
                }
            }
        }

        //Service Tickets
        $serviceTickets = $this->Tickets_model->get_tickets_by_company_id($company_id);
        foreach($serviceTickets as $st){
            $start_date_time = date('Y-m-d H:i:s', strtotime($st->ticket_date . " " . $st->scheduled_time)); 
            $start_date_end  = $start_date_time;
            $backgroundColor = "#ff751a";

            $custom_html = '<div class="calendar-title-header">';
                if( $st->job_tag != '' ){
                    $tags = $st->job_tag;
                }else{
                    $tags = '---';
                }

                $customer_name =  $st->first_name . ' ' . $st->last_name;
                $view_btn      = '<a class="calendar-tile-view nsm-button primary btn-sm" href="javascript:void(0);" data-type="ticket" data-id="'.$st->id.'"><i class="bx bx-window-open"></i> View</a>';

                $gcalendar_btn = '';
                if( $google_user_api ){
                    $gcalendar_btn = '<a class="calendar-tile-add-gcalendar nsm-button primary btn-sm" href="javascript:void(0);" data-type="ticket" data-id="'.$st->id.'"><i class="bx bxl-google"></i> Add to Google Calendar</a>';
                }

                $custom_html  .= '<a class="calendar-tile-minmax" data-type="ticket" data-id="'.$st->id.'" href="javascript:void(0);"><span style="font-size:16px;font-weight:bold;display:inline-block;">'. $st->ticket_no . ' - ' . $tags . ' : ' . $customer_name  . '</span></a>';
            $custom_html .= '</div>';

            $custom_html .= '<div class="calendar-tile-details ticket-tile-'.$st->id.'">';
                $custom_html .= "<small style='font-size:15px;'><i class='bx bxs-location-plus'></i> " . $st->service_location . ", " . $st->acs_zip . "</small>";
                $custom_html .= "<br /><small style='font-size:15px;display:inline-block;margin-right:5px;height:25px;vertical-align:top;'><i class='bx bxs-user-pin'></i> Tech : </small>";
                $resourceIds = array();
                if( $st->technicians != '' ){
                    $assigned_technician = unserialize($st->technicians);
                    if( is_array($assigned_technician) ){
                        foreach($assigned_technician as $eid){
                            $resourceIds[] = 'user' . $eid;
                            $custom_html .= '<div class="nsm-profile me-3 calendar-tile-assigned-tech" style="background-image: url(\''.userProfileImage($eid).'\'); width: 20px;display:inline-block;"></div>';
                        }                    
                    }                    
                }
                
                $custom_html .= '<br /><small style="font-size:15px;"><i class="bx bx-calendar"></i> ' . date("g:i A", strtotime($st->scheduled_time)) . " to " . date("g:i A", strtotime($st->scheduled_time_to)) . "</small>";
                $custom_html .= '<br/><br/>' . $view_btn . $gcalendar_btn;
            $custom_html .= '</div>';

            $resources_user_events[$inc]['eventId'] = $st->id;
            $resources_user_events[$inc]['eventType'] = 'service_tickets';
            $resources_user_events[$inc]['resourceIds'] = $resourceIds;
            $resources_user_events[$inc]['title'] = 'Service Ticket : ' . date('Y-m-d g:i A', strtotime($st->ticket_date));
            $resources_user_events[$inc]['customHtml'] = $custom_html;
            $resources_user_events[$inc]['start'] = $start_date_time;
            $resources_user_events[$inc]['end'] = $start_date_end;
            $resources_user_events[$inc]['starttime'] = $start_date_time;
            $resources_user_events[$inc]['backgroundColor'] = $backgroundColor;

            $inc++;
        }

        //Appointments
        $appointments = $this->Appointment_model->getAllNotWaitListByCompany($company_id);
        foreach ($appointments as $a) {
            $starttime = $a->appointment_date . " " . $a->appointment_time;
            $start_date_time = date('Y-m-d H:i:s', strtotime($a->appointment_date . " " . $a->appointment_time_from));
            $start_date_end  = date('Y-m-d H:i:s', strtotime($a->appointment_date . " " . $a->appointment_time_to));
            $backgroundColor = "#38a4f8";

            //$appointment_number = strtoupper(str_replace("APPT", $a->appointment_type, $a->appointment_number));
            $custom_html = '<div class="calendar-title-header">';
                $tags = '---';
                if( $a->tag_ids != '' ){
                    $a_tags = explode(",", $a->tag_ids);     
                    $appointmentTags   = $this->Job_tags_model->getAllByIds($a_tags);
                    foreach($appointmentTags as $t){
                        $e_tags[] = $t->name;
                    }

                    $tags = implode(",", $e_tags);
                }

                $customer_name = $j->first_name . ' ' . $j->last_name;
                $view_btn      = '<a class="calendar-tile-view nsm-button primary btn-sm" href="javascript:void(0);" data-type="appointment" data-id="'.$a->id.'"><i class="bx bx-window-open"></i> View</a>';

                $gcalendar_btn = '';
                if( $google_user_api ){
                    $gcalendar_btn = '<a class="calendar-tile-add-gcalendar nsm-button primary btn-sm" href="javascript:void(0);" data-type="appointment" data-id="'.$a->id.'"><i class="bx bxl-google"></i> Add to Google Calendar</a>';
                }
                $custom_html  .= '<a class="calendar-tile-minmax" data-type="appointment" data-id="'.$a->id.'" href="javascript:void(0);"><span style="font-size:16px;font-weight:bold;display:inline-block;">'. $a->appointment_number . ' - ' . $tags . ' : ' . $a->customer_name . '</span></a>';
                //$custom_html .= '<a class="calendar-tile-minmax" data-type="appointment" data-id="'.$a->id.'"><i class="bx bx-chevron-down"></i></a>';
            $custom_html .= '</div>';

            $custom_html .= '<div class="calendar-tile-details appointment-tile-'.$a->id.'">';
                $custom_html .= "<small style='font-size:15px;'><i class='bx bxs-location-plus'></i> " . $a->mail_add . ", " . $a->cust_zip_code . "</small>";
                $custom_html .= "<br /><small style='font-size:15px;display:inline-block;margin-right:5px;height:25px;vertical-align:top;'><i class='bx bxs-user-pin'></i> Tech : </small>";
                $assigned_technician = json_decode($a->assigned_employee_ids);
                $resourceIds = array();
                foreach($assigned_technician as $key => $eid){    
                    $resourceIds[] = "user" . $eid;                                    
                    $custom_html .= '<div class="nsm-profile me-3 calendar-tile-assigned-tech" style="background-image: url(\''.userProfileImage($eid).'\'); width: 20px;display:inline-block;"></div>';
                }
                $custom_html .= '<br /><small style="font-size:15px;"><i class="bx bx-calendar"></i> ' . date("H:i A", strtotime($a->appointment_time_from)) . ' to ' . date("H:i A", strtotime($a->appointment_time_to)) . "</small>";  
                $custom_html .= '<br/><br/>'. $view_btn . $gcalendar_btn;              
            $custom_html .= '</div>';

            $resources_user_events[$inc]['resourceIds'] = $resourceIds;
            $resources_user_events[$inc]['eventId'] = $a->id;
            $resources_user_events[$inc]['eventType'] = 'appointments';
            $resources_user_events[$inc]['title'] = 'Appointment : ' . date('Y-m-d g:i A', strtotime($a->appointment_date . " " . $a->appointment_time));
            $resources_user_events[$inc]['customHtml'] = $custom_html;
            $resources_user_events[$inc]['start'] = $start_date_time;
            $resources_user_events[$inc]['end'] = $start_date_end;
            $resources_user_events[$inc]['starttime'] = strtotime($start_date_time);
            $resources_user_events[$inc]['backgroundColor'] = $backgroundColor;

            $inc++; 
        }

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

                $custom_html = '<div class="calendar-title-header">';

                if( $j->tags != '' ){
                    $tags = $j->tags;
                }else{
                    $tags = '---';
                }

                $view_btn = '<a class="calendar-tile-view nsm-button primary btn-sm" href="javascript:void(0);" data-type="job" data-id="'.$j->id.'"><i class="bx bx-window-open"></i> View</a>';

                $gcalendar_btn = '';
                if( $google_user_api ){
                    $gcalendar_btn = '<a class="calendar-tile-add-gcalendar nsm-button primary btn-sm" href="javascript:void(0);" data-type="job" data-id="'.$j->id.'"><i class="bx bxl-google"></i> Add to Google Calendar</a>';
                }

                if (isset($a_settings['work_order_show_customer'])) {
                    if( $j->first_name != '' ||  $j->last_name != ''){
                        $customer_name = $j->first_name . ' ' . $j->last_name;
                        $custom_html .= '<a class="calendar-tile-minmax job-min-max-'.$j->id.'" data-type="job" data-id="'.$j->id.'" href="javascript:void(0);"><span style="font-size:16px;font-weight:bold;display:inline-block;">'.$j->job_number.' - '.$tags.' : '.$customer_name.'</span></a>';
                    }else{
                        $custom_html .= '<a class="calendar-tile-minmax" data-type="appointment" data-id="'.$a->id.'" href="javascript:void(0);"><span style="font-size:16px;font-weight:bold;display:inline-block;border-bottom:1px solid;line-height:41px;">'.$j->job_number.' - '.$tags.'</span></a>';                        
                    }
                }
                $custom_html .= '</div>';
                
                $custom_html .= '<div class="calendar-tile-details job-tile-'.$j->id.'">';
                //$custom_html .= '<small style="font-size:15px;"><i class="bx bxs-purchase-tag-alt"></i> Tags : ' . $tags . '</small>';
                //$custom_html .= '<br /><small style="font-size:15px;"><i class="bx bx-task"></i> Status : ' . $j->status . '</small>';

                if (isset($a_settings['work_order_show_details'])) {
                    $custom_html .= "<small style='font-size:15px;'><i class='bx bxs-location-plus'></i> " . $j->mail_add . ", ". $j->cust_zipcode. "</small>";
                }

                $custom_html .= "<br /><small style='font-size:15px;display:inline-block;margin-right:5px;height:25px;vertical-align:top;'><i class='bx bxs-user-pin'></i> Tech : </small>";                

                $assigned_employees = array();
                $assigned_employees[] = $j->employee_id;
                if( $j->employee2_id > 0 ){
                    $assigned_employees[] = $j->employee2_id;
                }
                if( $j->employee3_id > 0 ){
                    $assigned_employees[] = $j->employee3_id;
                }
                if( $j->employee4_id > 0 ){
                    $assigned_employees[] = $j->employee4_id;
                }

                $resourceIds = array();
                foreach($assigned_employees as $eid){
                    $resourceIds[] = 'user' . $eid;
                    $custom_html .= '<div class="nsm-profile me-3 calendar-tile-assigned-tech" style="background-image: url(\''.userProfileImage($eid).'\'); width: 20px;display:inline-block;"></div>';
                }
                
                $custom_html .= '<br /><small style="font-size:15px;"><i class="bx bx-calendar"></i> ' . $j->start_time . " - " . $j->end_time . "</small>";

                $custom_html .= '<br/><br/>' . $view_btn . $gcalendar_btn;

                /*if (isset($a_settings['work_order_show_price'])) {
                    $jobItems = $this->Jobs_model->get_specific_job_items($j->id);
                    $total_price = 0;
                    foreach ($jobItems as $item) {
                        $total_price += ($item->price * $item->qty);
                    }
                    $total_price = $j->amount;

                    $custom_html .= "<hr /><small style='font-weight:bold;font-size:17px;'>Total Cost : $". number_format((float)$total_price, 2, '.', ',') . "</small>";
                }*/

                $custom_html .= "</div>";

                /*if( isset($a_settings['work_order_show_link']) ){
                    $custom_html .= "<br /><small><a href=''>".$event->url_link."</a></small>";
                }*/
                
                $resources_user_events[$inc]['eventId'] = $j->id;
                $resources_user_events[$inc]['eventType'] = 'jobs';
                $resources_user_events[$inc]['resourceIds'] = $resourceIds;
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
        $upcomingEvents = $this->event_model->getAllUpComingEventsByCompanyId($company_id);

        $this->page_data['upcomingEvents'] = $upcomingEvents;        
        $this->load->view('v2/pages/workcalender/ajax_load_upcoming_events', $this->page_data);
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
                    'appointment_time_from' => $new_appointment_time,
                    'user_id' => $post['user_id']
                ];
            }else{
                $appointment_data = [
                    'appointment_date' => $new_start_date,
                    'appointment_time_from' => $new_appointment_time
                ];
            }
            $this->general->update_with_key_field($appointment_data, $post['event_id'], 'appointments', 'id');
        }elseif( $post['event_type'] == 'service_tickets' ){
            $new_appointment_time = date("H:i:s",strtotime($post['start_date']));
            if( $post['user_id'] > 0 ){
                $appointment_data = [
                    'ticket_date' => date("m/d/Y", strtotime($new_start_date)),
                    'scheduled_time_to' => $new_appointment_time,
                    'user_id' => $post['user_id']
                ];
            }else{
                $appointment_data = [
                    'ticket_date' => date("m/d/Y", strtotime($new_start_date)),
                    'scheduled_time_to' => $new_appointment_time,
                ];
            }
            $this->general->update_with_key_field($appointment_data, $post['event_id'], 'tickets', 'id');
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
        $this->load->model('AppointmentType_model');

        $post       = $this->input->post();
        $user_id    = getLoggedUserID();
        $company_id = logged('company_id');
        $is_success = false;
        $message    = 'Cannot create appointment';

        if ($post['appointment_date'] != '' && $post['appointment_time_from'] != '' && $post['appointment_time_to'] != '' && !empty($post['appointment_user_id']) && $post['appointment_customer_id'] != '' && $post['appointment_type_id'] != '') {

            if( $post['appointment_tags'] != '' ){
                $tags = implode(",", $post['appointment_tags']);
            }else{
                $tags = '';
            }

            $sales_agent_id = 0;
            $price = 0;
            $invoice_number = '';
            if( $post['appointment_type_id'] == 3 || $post['appointment_type_id'] == 1 ){
                $sales_agent_id = $post['appointment_sales_agent_id'];
                $price = $post['appointment_price'];
                $invoice_number = $post['appointment_invoice_number'];
            }

            if( $post['appointment_type_id'] == 2 ){
                $price = $post['appointment_price'];
                $invoice_number = $post['appointment_invoice_number'];   
            } 

            $appointment_priority = $post['appointment_priority'];
            if( $post['appointment_priority'] == 'Others' ){
                $appointment_priority = $post['appointment_priority_others'];
            }

            $appointmentType = $this->AppointmentType_model->getById($post['appointment_type_id']);            
            $data_appointment = [
                'appointment_date' => date("Y-m-d",strtotime($post['appointment_date'])),
                'appointment_time_to' => date("H:i:s", strtotime($post['appointment_time_to'])),
                'appointment_time_from' => date("H:i:s", strtotime($post['appointment_time_from'])),
                'user_id' => $user_id,
                'prof_id' => $post['appointment_customer_id'],
                'company_id' => $company_id,
                'tag_ids' => $tags,
                'url_link' => $post['url_link'],
                'total_item_price' => 0,
                'total_item_discount' => 0,
                'total_amount' => 0,
                'appointment_type_id' => $post['appointment_type_id'],
                'is_paid' => 0,
                'priority' => $appointment_priority,
                'is_wait_list' => 0,
                'assigned_employee_ids' => json_encode($post['appointment_user_id']),
                'notes' => $post['appointment_notes'],
                'cost' => $price,
                'sales_agent_id' => $sales_agent_id,
                'invoice_number' => $invoice_number,
                'created' => date("Y-m-d H:i:s")
            ];

            $last_id = $this->Appointment_model->createAppointment($data_appointment);
            $appointment_number = $this->Appointment_model->generateAppointmentNumber($last_id, $appointmentType->name);
            $this->Appointment_model->update($last_id, ['appointment_number' => $appointment_number]);

            //Google Calendar
            createSyncToCalendar($last_id, 'appointment', $company_id);

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
        $this->load->model('AppointmentType_model');

        $post       = $this->input->post();
        $user_id    = getLoggedUserID();
        $company_id = logged('company_id');
        $is_success = false;
        $message    = 'Cannot create appointment';

        if ($post['appointment_date'] != '' && $post['appointment_time_from'] != '' && $post['appointment_customer_id'] != '' && $post['appointment_type_id'] != '') {

            $data_appointment = [
                'appointment_date' => date("Y-m-d",strtotime($post['appointment_date'])),
                'appointment_time_from' => date("H:i:s", strtotime($post['appointment_time_from'])),
                'appointment_time_to' => date("H:i:s", strtotime($post['appointment_time_to'])),
                'user_id' => $user_id,
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
            $appointmentType    = $this->AppointmentType_model->getById($post['appointment_type_id']);     
            $appointment_number = $this->Appointment_model->generateAppointmentNumber($last_id, $appointmentType->name);
            $this->Appointment_model->update($last_id, ['appointment_number' => $appointment_number]);

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
        $this->load->model('Job_tags_model');

        $post = $this->input->post();
        $company_id  = logged('company_id');
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $company_id);
        //$tags = $this->EventTags_model->getAllByCompanyId($company_id, array());  

        $text_tags = '';
        if( $appointment->tag_ids != '' ){
            $a_tags = explode(",", $appointment->tag_ids);     
            $appointmentTags   = $this->Job_tags_model->getAllByIds($a_tags);
            $e_tags = array();
            foreach($appointmentTags as $t){
                $e_tags[] = $t->name;
            }
            if( !empty($e_tags) ){
                $text_tags = implode(",", $e_tags);
            }            
        }

        $tags = $this->Job_tags_model->getAllByCompanyId($company_id, array());  

        $a_tags = array();
        $selected_tags = explode(",", $appointment->tag_ids);
        foreach($tags as $t){
            if( in_array($t->id, $selected_tags) ){
                $a_tags[$t->id] = ['name' => $t->name, 'icon' => $t->marker_icon, 'is_marker_icon_default_list' => $t->is_marker_icon_default_list, 'cid' => $t->company_id];
            }
        }

        $this->page_data['a_tags'] = $a_tags;
        $this->page_data['text_tags'] = $text_tags;
        $this->page_data['appointment'] = $appointment;
        // $this->load->view('workcalender/ajax_load_view_appointment', $this->page_data);
        $this->load->view('v2/pages/workcalender/ajax_load_view_appointment', $this->page_data);
    }

    public function ajax_edit_appointment()
    {
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentType_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');
        $this->load->model('Users_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        //$tags = $this->EventTags_model->getAllByCompanyId($cid, array());
        $tags = $this->Job_tags_model->getAllByCompanyId($cid, array());
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['appointment_id'], $cid);        
        $appointmentTypes = $this->AppointmentType_model->getAllByCompany($cid, true);

        $a_tags = array();
        $selected_tags = explode(",", $appointment->tag_ids);
        foreach($tags as $t){
            if( in_array($t->id, $selected_tags) ){
                $a_tags[$t->id] = $t->name;
            }
        }

        $assigned_employee_ids = json_decode($appointment->assigned_employee_ids);
        $attendees = array();
        foreach($assigned_employee_ids as $uid){
            $user = $this->Users_model->getUser($uid);
            if( $user ){
                $attendees[] = [
                    'id' => $user->id,
                    'name' => $user->FName . ' ' . $user->LName
                ];
            }
        }

        $salesAgent = $this->Users_model->getUser($appointment->sales_agent_id);

        $appointmentPriorityOptions = $this->Appointment_model->priorityOptions();
        $appointmentPriorityEventOptions = $this->Appointment_model->priorityEventOptions();

        $this->page_data['a_selected_tags'] = $a_tags;
        $this->page_data['appointment'] = $appointment;
        $this->page_data['attendees'] = $attendees;
        $this->page_data['salesAgent'] = $salesAgent;
        $this->page_data['appointmentTypes'] = $appointmentTypes;
        $this->page_data['appointmentPriorityOptions'] = $appointmentPriorityOptions;
        $this->page_data['appointmentPriorityEventOptions'] = $appointmentPriorityEventOptions;
        // $this->load->view('workcalender/ajax_edit_appointment', $this->page_data);
        $this->load->view('v2/pages/workcalender/ajax_edit_appointment', $this->page_data);
    }

    public function ajax_update_appointment()
    {
        $this->load->model('Appointment_model');
        $this->load->model('AppointmentType_model');

        $is_success = false;
        $message    = 'Cannot find appointment';

        $post       = $this->input->post();
        $cid = logged('company_id');
        $appointment = $this->Appointment_model->getByIdAndCompanyId($post['aid'], $cid);

        if( $appointment ){
            $old_appointment_type_id = $appointment->appointment_type_id;
            if ($post['appointment_date'] != '' && $post['appointment_time_from'] != '' && $post['appointment_time_to'] != '' && $post['appointment_user_id'] != '' && $post['appointment_customer_id'] != '' && $post['appointment_type_id'] > 0) {

                if( $post['appointment_tags'] != '' ){
                    $tags = implode(",", $post['appointment_tags']);
                }else{
                    $tags = '';
                }

                $sales_agent_id = 0;
                $price = 0;
                $invoice_number = '';
                if( $post['appointment_type_id'] == 3 || $post['appointment_type_id'] == 1 ){
                    $sales_agent_id = $post['appointment_sales_agent_id'];
                    $price = $post['appointment_price'];
                    $invoice_number = $post['appointment_invoice_number'];
                }

                if( $post['appointment_type_id'] == 2 ){
                    $price = $post['appointment_price'];
                    $invoice_number = $post['appointment_invoice_number'];   
                } 

                $appointment_priority = $post['appointment_priority'];
                if( $post['appointment_priority'] == 'Others' ){
                    $appointment_priority = $post['appointment_priority_others'];
                }

                $data_appointment = [
                    'appointment_date' => date("Y-m-d",strtotime($post['appointment_date'])),
                    'appointment_time_to' => date("H:i:s", strtotime($post['appointment_time_to'])),
                    'appointment_time_from' => date("H:i:s", strtotime($post['appointment_time_from'])),
                    'prof_id' => $post['appointment_customer_id'],
                    'tag_ids' => $tags,
                    'url_link' => $post['url_link'],
                    'total_item_price' => 0,
                    'total_item_discount' => 0,
                    'total_amount' => 0,
                    'appointment_type_id' => $post['appointment_type_id'],
                    'is_paid' => 0,
                    'priority' => $appointment_priority,
                    'is_wait_list' => 0,
                    'assigned_employee_ids' => json_encode($post['appointment_user_id']),
                    'notes' => $post['appointment_notes'],
                    'cost' => $price,
                    'sales_agent_id' => $sales_agent_id,
                    'invoice_number' => $invoice_number,
                ];

                $this->Appointment_model->update($appointment->id, $data_appointment);

                if( $old_appointment_type_id != $post['appointment_type_id'] ){
                    $appointmentType = $this->AppointmentType_model->getById($post['appointment_type_id']);  
                    $appointment_number = $this->Appointment_model->generateAppointmentNumber($appointment->id, $appointmentType->name);
                    $this->Appointment_model->update($appointment->id, ['appointment_number' => $appointment_number]);
                }

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
        // $this->load->view('workcalender/ajax_checkout_appointment', $this->page_data);
        $this->load->view('v2/pages/workcalender/ajax_checkout_appointment', $this->page_data);
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
        // $this->load->view('workcalender/ajax_view_appointment_payment_details', $this->page_data);
        $this->load->view('v2/pages/workcalender/ajax_view_appointment_payment_details', $this->page_data);
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
            $get_users  = $this->Users_model->getCompanyUsers($company_id, null, 5);
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
        // $this->load->view('workcalender/ajax_load_checkout_item_list', $this->page_data);
        $this->load->view('v2/pages/workcalender/ajax_load_checkout_item_list', $this->page_data);
    }

    public function ajax_load_wait_list()
    {
        $this->load->model('Appointment_model');
        
        $cid   = logged('company_id');
        $waitList = $this->Appointment_model->getAllCompanyWaitList($cid);
        
        $this->page_data['waitList'] = $waitList;
        // $this->load->view('workcalender/ajax_load_wait_list', $this->page_data);
        $this->load->view('v2/pages/workcalender/ajax_load_wait_list', $this->page_data);
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
        // $this->load->view('workcalender/ajax_edit_appointment_wait_list', $this->page_data);
        $this->load->view('v2/pages/workcalender/ajax_edit_appointment_wait_list', $this->page_data);
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
                    'appointment_time_from' => date("H:i:s", strtotime($post['start_date'])),
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
                        'appointment_time_from' => date("H:i:s", strtotime($post['start_date'])),
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

    public function ajax_load_upcoming_service_tickets()
    {
        $this->load->model('Tickets_model');

        $cid = logged('company_id');  
        $upcomingServiceTickets = $this->Tickets_model->get_upcoming_tickets_by_company_id($cid);

        $this->page_data['upcomingServiceTickets'] = $upcomingServiceTickets;        
        $this->load->view('v2/pages/workcalender/ajax_load_upcoming_service_tickets', $this->page_data);
    }

    public function ajax_load_upcoming_schedules()
    {
        $this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Estimate_model');
        $this->load->model('Tickets_model');
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');

        $cid = logged('company_id');
        
        $upcomingJobs   = $this->Jobs_model->getAllUpcomingJobsByCompanyId($cid);
        $upcomingEvents = $this->Event_model->getAllUpComingEventsByCompanyId($cid);
        $upcomingServiceTickets = $this->Tickets_model->get_upcoming_tickets_by_company_id($cid);
        $scheduledEstimates = $this->Estimate_model->getAllPendingEstimatesByCompanyId($cid);    
        $upcomingAppointments = $this->Appointment_model->getAllUpcomingAppointmentsByCompany($cid);    

        $upcomingSchedules = array();

        foreach( $upcomingJobs as $job ){
            $date_index = date("Y-m-d", strtotime($job->start_date));
            $upcomingSchedules[$date_index][] = [
                'type' => 'job',
                'data' => $job
            ];
        }

        foreach( $upcomingEvents as $event ){
            $date_index = date("Y-m-d", strtotime($event->start_date));
            $upcomingSchedules[$date_index][] = [
                'type' => 'event',
                'data' => $event
            ];
        }

        foreach( $scheduledEstimates as $estimate ){
            $date_index = date("Y-m-d", strtotime($estimate->estimate_date));
            $upcomingSchedules[$date_index][] = [
                'type' => 'estimate',
                'data' => $estimate
            ];
        }

        foreach( $upcomingServiceTickets as $ticket ){
            $date_index = date("Y-m-d", strtotime($ticket->ticket_date));
            $upcomingSchedules[$date_index][] = [
                'type' => 'ticket',
                'data' => $ticket
            ];
        }

        foreach( $upcomingAppointments as $appointment ){
            $date_index = date("Y-m-d", strtotime($appointment->appointment_date));
            $appointment_tags = explode(",", $appointment->tag_ids);
            //$appointmentTags = $this->EventTags_model->getAllByIds($appointment_tags);
            $appointmentTags   = $this->Job_tags_model->getAllByIds($appointment_tags);

            $appointment_tags = '';
            $aTags = array();
            foreach($appointmentTags as $tags){
                $aTags[] = $tags->name;
            }

            if( !empty($aTags) ){
                $appointment_tags = implode(",", $aTags);
            }
            
            $appointment->appt_tags = $appointment_tags;
            $upcomingSchedules[$date_index][] = [
                'type' => 'appointment',
                'data' => $appointment
            ];
        }

        ksort($upcomingSchedules);

        $this->page_data['upcomingSchedules'] = $upcomingSchedules;
        $this->load->view('v2/pages/workcalender/ajax_load_upcoming_schedules', $this->page_data);
    }

    public function mini_calendar_events()
    {
        $this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Estimate_model');
        $this->load->model('Tickets_model');
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');

        $cid = logged('company_id');
        
        $upcomingJobs   = $this->Jobs_model->getAllUpcomingJobsByCompanyId($cid);
        $upcomingEvents = $this->Event_model->getAllUpComingEventsByCompanyId($cid);
        $upcomingServiceTickets = $this->Tickets_model->get_upcoming_tickets_by_company_id($cid);
        $scheduledEstimates = $this->Estimate_model->getAllPendingEstimatesByCompanyId($cid);    
        $upcomingAppointments = $this->Appointment_model->getAllUpcomingAppointmentsByCompany($cid);    

        $upcomingSchedules = array();

        $unique_dates = array();
        foreach( $upcomingJobs as $job ){
            $date = date("Y-m-d", strtotime($job->start_date));
            if( !array_key_exists($date, $unique_dates) ){
                $upcomingSchedules[] = [
                    'name' => 'job',
                    'date' => $date
                ];

                $unique_dates[$date] = $date;
            }                        
        }

        foreach( $upcomingEvents as $event ){
            $date = date("Y-m-d", strtotime($event->start_date));
            if( !array_key_exists($date, $unique_dates) ){
                $upcomingSchedules[] = [
                    'name' => 'event',
                    'date' => $date
                ];            

                $unique_dates[$date] = $date;
            }            
        }

        foreach( $scheduledEstimates as $estimate ){
            $date = date("Y-m-d", strtotime($estimate->estimate_date));
            if( !array_key_exists($date, $unique_dates) ){
                $upcomingSchedules[] = [
                    'name' => 'estimate',
                    'date' => $date
                ]; 

                $unique_dates[$date] = $date;
            }            
        }

        foreach( $upcomingServiceTickets as $ticket ){
            $date = date("Y-m-d", strtotime($ticket->ticket_date));
            if( !array_key_exists($date, $unique_dates) ){
                $upcomingSchedules[] = [
                    'name' => 'ticket',
                    'date' => $date
                ]; 

                $unique_dates[$date] = $date;
            }            
        }

        foreach( $upcomingAppointments as $appointment ){
            $date = date("Y-m-d", strtotime($appointment->appointment_date));
            if( !array_key_exists($date, $unique_dates) ){
                $upcomingSchedules[] = [
                    'name' => 'appointment',
                    'date' => $date
                ]; 

                $unique_dates[$date] = $date;
            }            
        }

        return json_encode($upcomingSchedules);
    }

    public function ajax_load_upcoming_calendar_by_date(){
        $this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Estimate_model');
        $this->load->model('Tickets_model');
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');

        $post = $this->input->post();
        $cid = logged('company_id');
        
        $date = $post['selected_date'];
        $upcomingSchedules = array();

        if( $date != '' ){
            $upcomingJobs   = $this->Jobs_model->getAllJobsByCompanyIdAndDate($cid, $date);
            $upcomingEvents = $this->Event_model->getAllEventsByCompanyIdAndDate($cid, $date);
            $upcomingServiceTickets = $this->Tickets_model->get_utickets_by_company_id_and_date($cid, $date);
            $scheduledEstimates = $this->Estimate_model->getAllPendingEstimatesByCompanyIdAndDate($cid, $date);    
            $upcomingAppointments = $this->Appointment_model->getAllAppointmentsByCompanyAndDate($cid, $date); 

            foreach( $upcomingJobs as $job ){
                $date_index = date("Y-m-d", strtotime($job->start_date));
                $upcomingSchedules[$date_index][] = [
                    'type' => 'job',
                    'data' => $job
                ];
            }

            foreach( $upcomingEvents as $event ){
                $date_index = date("Y-m-d", strtotime($event->start_date));
                $upcomingSchedules[$date_index][] = [
                    'type' => 'event',
                    'data' => $event
                ];
            }

            foreach( $scheduledEstimates as $estimate ){
                $date_index = date("Y-m-d", strtotime($estimate->estimate_date));
                $upcomingSchedules[$date_index][] = [
                    'type' => 'estimate',
                    'data' => $estimate
                ];
            }

            foreach( $upcomingServiceTickets as $ticket ){
                $date_index = date("Y-m-d", strtotime($ticket->ticket_date));
                $upcomingSchedules[$date_index][] = [
                    'type' => 'ticket',
                    'data' => $ticket
                ];
            }

            foreach( $upcomingAppointments as $appointment ){
                $date_index = date("Y-m-d", strtotime($appointment->appointment_date));
                $appointment_tags = explode(",", $appointment->tag_ids);
                //$appointmentTags = $this->EventTags_model->getAllByIds($appointment_tags);
                $appointmentTags   = $this->Job_tags_model->getAllByIds($appointment_tags);

                $appointment_tags = '';
                $aTags = array();
                foreach($appointmentTags as $tags){
                    $aTags[] = $tags->name;
                }

                if( !empty($aTags) ){
                    $appointment_tags = implode(",", $aTags);
                }
                
                $appointment->appt_tags = $appointment_tags;
                $upcomingSchedules[$date_index][] = [
                    'type' => 'appointment',
                    'data' => $appointment
                ];
            }

            ksort($upcomingSchedules);
        }        

        $this->page_data['upcomingSchedules'] = $upcomingSchedules;
        $this->load->view('v2/pages/workcalender/ajax_load_mini_upcoming_schedules', $this->page_data);

    }

    public function ajax_add_to_google_calendar()
    {
        include APPPATH . 'libraries/google-calendar-api.php';

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

        $this->load->helper(array('hashids_helper'));

        $company_id = logged('company_id');
        $is_valid   = false;
        $post = $this->input->post();

        switch ($post['tile_type']) {
            case 'appointment':
                $appointment = $this->Appointment_model->getByIdAndCompanyId($post['tile_id'], $company_id);
                if( $appointment ){
                    $tags = '---';
                    if( $appointment->tag_ids != '' ){
                        $a_tags = explode(",", $appointment->tag_ids);     
                        $appointmentTags   = $this->Job_tags_model->getAllByIds($a_tags);
                        $e_tags = array();
                        foreach($appointmentTags as $t){
                            $e_tags[] = $t->name;
                        }

                        if( !empty($e_tags) ){
                            $tags = implode(",", $e_tags);
                        }                        
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

                    $appointment_eid = hashids_encrypt($appointment->id, '', 15);
                    $view_link       = base_url('appointment/'.$appointment_eid);

                    /*$description  = "Customer Name : ".$appointment->customer_name."\n";
                    $description .= "Phone Number : ".$appointment->cust_phone."\n";                       
                    //$description .= "URL Link : <a href='".$appointment->url_link."'>".$appointment->url_link."</a><br />";                              
                    $description .= "Location : " . $appointment->mail_add . ' ' . $appointment->cust_city . ', ' . $appointment->cust_state . ' ' . $appointment->cust_zip_code . "\n";*/
                    $description = $appointment->notes ."\n";
                    $description .= $view_link . "\n"; 

                    $is_valid = true;

                }
                break;
            case 'event':
                $event = $this->Event_model->get_specific_event($post['tile_id']);
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

                    /*$description  = "<b>Event Type : ".$event->event_type."</b><br />";
                    $description .= $event->event_address . "<br />";
                    $description .= "Event Description : ".$event->event_description."<br />";*/
                    $description = $event->event_description ."\n";                    

                    $is_valid = true;
                }
                break;
            case 'ticket':
                $ticket = $this->Tickets_model->get_tickets_by_id_and_company_id($post['tile_id'], $company_id);
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

                    /*$description  = "<b>Customer Name : ".$ticket->first_name . ' ' . $ticket->last_name."</b><br />";
                    $description .= "Phone Number : ".$ticket->phone_m."<br />";                  
                    $description .= "Service Location : " . $ticket->service_location . "<br />";
                    $description .= "Notes : ". $appointment->notes ."<br />";*/

                    $description = $ticket->service_location ."\n";

                    $is_valid = true;
                }
                break;
            case 'job':
                $job = $this->Jobs_model->get_specific_job($post['tile_id']);
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

                    $description  = "Customer Name : ".$job->first_name . ' ' . $job->last_name."\n";
                    $description .= "Job Type : ".$job->job_type."\\n";                
                    $description .= "Phone Number : ".$job->cust_phone."\n";                
                    $description .= "Location : " . $job->mail_add . ' ' . $job->cust_city . ', ' . $job->cust_state . ' ' . $job->cust_zip_code . "\n";

                    $is_valid = true;
                }
                break;
            default:
                break;
        }

        if( $is_valid ){
            $googleAccount      = $this->GoogleAccounts_model->getByCompanyId($company_id);
            $google_credentials = google_credentials();

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
            }else{
                $is_valid = false;
            }  
        }

        $return = ['is_success' => $is_valid];
        echo json_encode($return);

        exit;
    }
}


/* End of file items.php */

/* Location: ./application/controllers/items.php */
