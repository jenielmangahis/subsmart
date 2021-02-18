<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Event extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Events';
        $this->page_data['page']->menu = 'events';
        $this->load->model('Event_model', 'event_model');

        $this->checkLogin();

        $user_id = getLoggedUserID();
    }

    public function index()
    {
        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');
            $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id);
        }
        if ($role == 4) {
            $this->page_data['customers'] = $this->customer_model->getAllByUserId();
        }
        $this->load->view('event/list', $this->page_data);
    }


    public function save()
    {
        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $company_id = logged('company_id');
        $post = $this->input->post();

        if( isset($post['is_recurring']) ){
            $is_recurring = 1;
        }else{
            $is_recurring = 0;
        }

        $data = array(
            'company_id' => $company_id,
            'customer_id' => $post['customer_id'],
            'gevent_id' => 0,
            'employee_id' => $post['user_id'][0],
            'what_of_even' => ($post['what_of_even']) ? $post['what_of_even'] : '',
            'description' => $post['description'],
            'start_date' => date('Y-m-d', strtotime($post['start_date'])),
            'start_time' => $post['start_time'],
            'end_date' => date('Y-m-d', strtotime($post['end_date'])),
            'end_time' => $post['end_time'],
            'event_color' => $post['event_color'],
            'notify_at' => $post['notify_at'],
            'event_description' => $post['description'],
            'instructions' => $post['instructions'],
            'is_recurring' => $is_recurring,
            'event_location' => $post['event_location']
        );

        if (!empty(post('event_id'))) {

            if ($this->event_model->update(post('event_id'), $data)) {
                $event_id = post('event_id');
            } else {
                $event_id = 0;
            }
        } else {

            $event_id = $this->event_model->create($data);
        }

        // add user events
        $this->load->model('UserEvent_model', 'UserEvent_model');

        if (!empty(post('user_id'))) {

            // clear old event users
            if (!empty(post('event_id'))) {

                $userEvents = $this->UserEvent_model->getByEventId(post('event_id'));
                if ($userEvents) {

                    foreach ($userEvents as $userEvent) {

                        $this->UserEvent_model->delete($userEvent->id);
                    }
                }
            }

            foreach (post('user_id') as $user_id) {

                $this->UserEvent_model->create([
                    'user_id' => $user_id,
                    'event_id' => $event_id
                ]);
            }
        }

        //Add to app default google calendar
        $this->load->model('GoogleAccounts_model');
        $google_user_api    = $this->GoogleAccounts_model->getByAuthUser();
        $google_credentials = google_credentials();        
        $access_token = "";
        $refresh_token = "";
        $google_client_id = "";
        $google_secrect = "";

        if(isset($google_user_api->google_access_token)) {
            $access_token = $google_user_api->google_access_token;
        }

        if(isset($google_user_api->google_refresh_token)) {
            $refresh_token = $google_user_api->google_refresh_token;
        }

        if(isset($google_credentials['client_id'])) {
            $google_client_id = $google_credentials['client_id'];
        }

        if(isset($google_credentials['client_secret'])) {
            $google_secrect = $google_credentials['client_secret'];
        }

        //Set Client
        $client = new Google_Client();
        $client->setClientId($google_client_id);
        $client->setClientSecret($google_secrect);
        $client->setAccessToken($access_token);
        $client->refreshToken($refresh_token);

        $cal = new Google_Service_Calendar($client);

        //Check if default calendar existst
        $calendars = $cal->calendarList->listCalendarList();
        $is_exists = false;
        $calendar_id = '';

        foreach( $calendars as $c ){
            if( $c->id == $google_user_api->auto_sync_calendar_id ){
                $is_exists = true;
                $calendar_id = $c->id;
            }
        }

        if( $is_exists ){
            $rfc_start_date = date("c", strtotime($post['start_date'] . ' ' . $post['start_time']));
            $rfc_end_date   = date("Y-m-d H:i:s", strtotime($post['end_date'] . ' ' . $post['end_time']));
            $rfc_end_date   = date("Y-m-d H:i:s",strtotime($rfc_end_date));
            $rfc_end_date   = date("c", strtotime($rfc_end_date));

            $event    = new Google_Service_Calendar_Event(array(
              'summary' => $post['description'],
              'location' => '',
              'description' => $post['description'] . ' - ' . $post['instructions'],
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
            $gEvent = $cal->events->insert($google_user_api->auto_sync_calendar_id, $event);

            $event = $this->event_model->getEvent($event_id);
            if( $event ){
                $this->event_model->update($event_id, ['gevent_id' => $gEvent->id]);
            }
        }

        die(json_encode(
            array(
                'event_id' => $event_id
            )
        ));
    }


    public function remove()
    {

        if ($this->event_model->delete(post('event_id'))) {

            // remove user events            
            $this->load->model('UserEvent_model', 'UserEvent_model');

            $userEvents = $this->UserEvent_model->getByEventId(post('event_id'));
            if ($userEvents) {

                foreach ($userEvents as $userEvent) {

                    $this->UserEvent_model->delete($userEvent->id);
                }
            }

            die(json_encode(
                array(
                    'status' => 'success'
                )
            ));
        } else {

            die(json_encode(
                array(
                    'status' => 'error'
                )
            ));
        }
    }


    public function get_event_form()
    {        
        $this->load->model('ColorSettings_model');
        $this->load->model('EventType_model');

        $get = $this->input->get();

        // popup open request to edit a particular event
        if (!empty($get['event_id'])) {

            $this->page_data['event'] = $this->event_model->getById($get['event_id']);

            // load the event users
            $this->load->model('UserEvent_model', 'UserEvent_model');
            $users = $this->UserEvent_model->getByEventId($get['event_id']);

            // load one user for the event
            if (!empty($users)) {
                $this->page_data['event']->user = current($users);
            }
        }

        // print_r($this->page_data['event']); die;
        $user_id = logged('id');
        $role_id = logged('role');
        if( $role_id == 1 || $role_id == 2 ){
            $args = array();
            $eventTypes = $this->EventType_model->getAll();
        }else{
            $args = array('company_id' => logged('company_id'));
            $eventTypes = $this->EventType_model->getAllByCompanyId(logged('company_id'));
        }

        $colorSettings = $this->ColorSettings_model->getByWhere($args);

        $this->page_data['eventTypes'] = $eventTypes;
        $this->page_data['colorSettings'] = $colorSettings;
        
        die($this->load->view('event/event_form', $this->page_data, true));
    }


    public function modal_details($id)
    {
        $this->page_data['event'] = $this->event_model->getEvent($id);
        die($this->load->view('event/modal_details', $this->page_data, true));
    }

    public function filter_events()
    {
        $post = $this->input->post();
        $role = logged('role');

        // print_r($post); die;

        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (isset($post['employee_id']))
                $events = $this->event_model->getAllByCompany($company_id, $post['employee_id']);
            else
                $events = $this->event_model->getAllByCompany($company_id);
        }
        if ($role == 4) {
            if (isset($post['employee_id']))
                $events = $this->event_model->getAllByUserId('', '', 0, $post['employee_id']);
            else
                $events = $this->event_model->getAllByUserId();
        }

        // print_r($post); die;

        $this->page_data['events'] = array();

        foreach ($events as $key => $event) {

            $customer = get_customer_by_id($event->customer_id);

            $this->page_data['events'][$key]['eventId'] = $event->id;
            $this->page_data['events'][$key]['status'] = $event->status;
            $this->page_data['events'][$key]['title'] = (!empty($customer)) ? date('h:m a', strtotime($event->start_time)) . ' ' . $customer->contact_name : '';
            $this->page_data['events'][$key]['start'] = date('Y-m-d', strtotime($event->start_date));
            $this->page_data['events'][$key]['end'] = date('Y-m-d', strtotime($event->end_date));
            // $this->page_data['events'][$key]['userName'] 		= ($user) ? $user->name : '';
            $this->page_data['events'][$key]['backgroundColor'] = $event->event_color;
        }


        // workorders
        $this->load->model('Workorder_model', 'workorder_model');
        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (!empty($post['employee_id'])) {

                $workorders = $this->workorder_model->getAllOrderByCompany($company_id, ['user_id' => $post['employee_id']]);
            } else {

                $workorders = $this->workorder_model->getAllOrderByCompany($company_id);
            }
        }
        if ($role == 4) {

            if (!empty($post['employee_id'])) {

                $workorders = $this->workorder_model->getAllByUserId('', '', 0, 0, ['user_id' => $post['employee_id']]);
            } else {

                $workorders = $this->workorder_model->getAllByUserId();
            }
        }


        // perform serialize decode operation
        foreach ($workorders as $key => $workorder) {

            $workorder->$key = serialize_to_array($workorder);
        }


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
        }

        // echo '<pre>'; print_r($this->page_data['events']); die;


        die(json_encode($this->page_data['events']));
    }


    public function json_events()
    {

        $post = $this->input->post();
        $role = logged('role');

        $events = $this->event_model->getAllByUserId();

        // print_r($events); die;

        $this->page_data['events'] = array();

        // setting of the calender
        $calender_settings = get_setting(DB_SETTINGS_TABLE_KEY_SCHEDULE);

        foreach ($events as $key => $event) {
            $title    = '';
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
            $this->page_data['events'][$key]['title'] = $title;
            $this->page_data['events'][$key]['start'] = $event->start_date;
            $this->page_data['events'][$key]['end'] = $event->end_date;
            // $this->page_data['events'][$key]['userName'] 		= ($user) ? $user->name : '';
            $this->page_data['events'][$key]['backgroundColor'] = $event->event_color;
        }

        // workorders
        $this->load->model('Workorder_model', 'workorder_model');
        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');
            $workorders = $this->workorder_model->getAllOrderByCompany($company_id);
        }

        if ($role == 4) {
            $workorders = $this->workorder_model->getAllByUserId();
        }

        if(empty($workorders)) {
            $workorders = $this->workorder_model->getAllByUserId();
        }

        // perform serialize decode operation
        foreach ($workorders as $key => $workorder) {

            $workorder->$key = serialize_to_array($workorder);
        }

        if (!empty($workorders)) {

            // perform serialize decode operation
            foreach ($workorders as $key => $workorder) {

                $workorder->$key = serialize_to_array($workorder);
            }

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
                    $workorder_events[$k]['backgroundColor'] = get_event_color($workorder->status_id);
                }

                $this->page_data['events'] = array_merge($this->page_data['events'], $workorder_events);
            }
        }

        die(json_encode($this->page_data['events']));
    }

    public function import_outlook_calendar($event_id)
    {
        $event = $this->event_model->getEvent($event_id);
        if($event){
            if( $event->description != '' ){
                $details = get_customer_by_id($event->customer_id)->contact_name . " - " . $event->description;
            }else{  
                $details = get_customer_by_id($event->customer_id)->contact_name;
            }
            $event_date_from = date("Ymd\THis\Z", strtotime($event->start_date . ' ' . $event->start_time));
            $event_date_to   = date("Ymd\THis\Z", strtotime($event->end_date . ' ' . $event->end_time));
            
            header('Content-type: text/calendar; charset=utf-8');
            header('Content-Disposition: attachment; filename=calendar.ics');

            // Build the ics file
            echo "BEGIN:VCALENDAR\n";
            echo "VERSION:2.0\n";
            echo "PRODID:-//nsmartrac v1.0//EN\n";
            echo "DTSTART:".$event_date_from."\n";
            echo "DTEND:".$event_date_to."\n";
            echo "SUMMARY:".$details."\n";
            echo "DESCRIPTION:".$details."\n";
            echo "END:VEVENT\n";
            echo "END:VCALENDAR";
        } else {
            // If $id isn't set, then kick the user back to home. Do not pass go, and do not collect $200.
            header('Location: /');
        }

        exit;
        
    }
}
