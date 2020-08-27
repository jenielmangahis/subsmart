<?php

defined('BASEPATH') or exit('No direct script access allowed');





class Workcalender extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Work calender';
        $this->page_data['page']->menu = 'Workcalender';
        $this->page_data['module'] = 'calendar'; 

        // $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Workzone_model', 'workzone_model');

        $user_id = getLoggedUserID();

        // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/plugins/timeline_calendar/main.css'
            /*'packages/fullcalendar/packages/core/main.css',
            'packages/fullcalendar/packages/daygrid/main.css',
            'packages/fullcalendar/packages/timegrid/main.css',
            'packages/fullcalendar/packages/list/main.css',*/
           // 'packages/fullcalendar-scheduler/lib/main.css'
            // 'packages/fullcalendar/packages/timeline/main.css',
            // 'packages/fullcalendar/packages/resource-timeline/main.css',
            // 'packages/fullcalendar/packages/resource-daygrid/main.css',
            // 'packages/fullcalendar/packages/resource-timegrid/main.css',
            // 'packages/fullcalendar/packages/resource-timeline/main.css',
            // 'packages/fullcalendar/packages/scrollgrid/main.css',
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/plugins/timeline_calendar/main.js',
            /*'packages/fullcalendar/packages/core/main.js',
            'packages/fullcalendar/packages/interaction/main.js',
            'packages/fullcalendar/packages/daygrid/main.js',
            'packages/fullcalendar/packages/timegrid/main.js',
            'packages/fullcalendar/packages/list/main.js',*/
            // 'packages/fullcalendar-scheduler/lib/main.js',
            /*'packages/fullcalendar/packages/timeline/main.js',
            'packages/fullcalendar/packages/resource-timeline/main.js',
            'packages/fullcalendar/packages/resource-daygrid/main.js',
            'packages/fullcalendar/packages/resource-timegrid/main.js',
            'packages/fullcalendar/packages/resource-timeline/main.js',
            'packages/fullcalendar/packages/scrollgrid/main.js',*/
            'assets/frontend/js/workcalender/workcalender.js',
        ));
    }

    public function index()
    {
         $this->load->model('Event_model', 'event_model');

        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');
             $events = $this->event_model->getAllByCompany($company_id);
        }
        if ($role == 4) {
             $events = $this->event_model->getAllByUserId();
        }

        $this->page_data['calendar_events'] = array();

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

                  //   resourceId:'a',
            //   title:"My repeating event",
            //   start:'2020-08-27 10:00',
            //   end:'2020-08-27 13:00',
            //   eventColor: '#378006'


                $calendar_events[$key]['resourceId'] = $event->id;
                //$this->page_data['events'][$key]['status'] = $event->status;
                $calendar_events[$key]['title'] = (!empty($customer)) ? $title : '';
                $calendar_events[$key]['start'] = date('Y-m-d', strtotime($event->start_date));
                $calendar_events[$key]['end'] = date('Y-m-d', strtotime($event->end_date));
                // $this->page_data['events'][$key]['userName'] 		= ($user) ? $user->name : '';
                $calendar_events[$key]['eventColor'] = $event->event_color;
            }

             echo "<pre>";
            print_r($calendar_events);
            echo "</pre>";
            exit();
            $this->page_data['calendar_events'] = $calendar_events;
          
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

//        echo '<pre>'; print_r($workorders); die;

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
				$workorder_events[$k]['backgroundColor'] 	= get_event_color($workorder->status_id);
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

//        echo '<pre>'; print_r($workorders); die;

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

//         echo '<pre>'; print_r($this->page_data['events']); die;

        // load all user for calender toolbar

        $this->load->library('user_agent');
        if ($this->agent->is_mobile()) {
            $is_mobile = 1;
        } else {
            $is_mobile = 0;
        }

        $this->load->model('Users_model', 'user_model');
        $this->page_data['is_mobile'] = $is_mobile;
        $this->page_data['users'] = $this->user_model->getUsers();

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

        // 	$zones = post('zones');
        // 	$quantity = post('quantity');
        // 	$price = post('price');
        // 	$type = post('type');

        // 	foreach(post('item') as $key=>$val) {

        // 		$itemArray[] = array(

        // 			'item' => $items[$key],
        // 			'type' => $type[$key],
        // 			'quantity'=> $quantity[$key],
        // 			'price' => $price[$key]
        // 		);
        // 	}

        // 	$workorder_items = serialize($itemArray);
        // } else {

        // 	$workorder_items = '';
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

        // 	$path = $_FILES['attachment']['name'];

        // 	$ext = pathinfo($path, PATHINFO_EXTENSION);

        // 	$this->uploadlib->initialize([

        // 		'file_name' => $id.'.'.$ext

        // 	]);

        // 	$image = $this->uploadlib->uploadImage('attachment', '/workorders');


        // 	if($image['status']){

        // 		$this->workorder_model->update($id, ['img_type' => $ext]);

        // 	}

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
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id'); $company_id = 15;
            $events = $this->event_model->getAllByCompany($company_id);
        }
        if ($role == 4) {
            $events = $this->event_model->getAllByUserId();
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
                if($event->end_date != "1970-01-01" && $event->end_date != "" && $event->end_date != null){

                $this->page_data['events'][$key]['end'] = date('Y-m-d', strtotime($event->end_date));
                }
                // $this->page_data['events'][$key]['userName']         = ($user) ? $user->name : '';
                $this->page_data['events'][$key]['backgroundColor'] = $event->event_color;
            }
        }
        $this->load->view('workcalender/reports/calender-print', $this->page_data);
    }
}


/* End of file items.php */

/* Location: ./application/controllers/items.php */
