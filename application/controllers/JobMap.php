<?php

defined('BASEPATH') or exit('No direct script access allowed');

class JobMap extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->checkLogin();

        $this->page_data['page']->title = 'Bird\s Eye View';
        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'workorder';
    }


    /**
     *
     */
    public function index()
    {
        $this->load->model('CompanyJobMapSetting_model');

		
        $this->hasAccessModule(25);      

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',            
            'assets/js/v2/bootstrap-datetimepicker.v2.min.js',
            'assets/plugins/timeline_calendar/main.js',
            'assets/frontend/js/workcalender/workcalender.js',
            'assets/js/quick_launch.js'            
        ));

        $is_allowed = $this->isAllowedModuleAccess(25);
        if( !$is_allowed ){
            $this->page_data['module'] = 'bird_eye_view';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $cid  = logged('company_id');        
        $mapSetting = $this->CompanyJobMapSetting_model->getByCompanyId($cid);        

        $this->page_data['mapSetting'] = $mapSetting;
        $this->page_data['page']->title = 'Bird\'s Eye View';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/job_map/bird_eye_view', $this->page_data);
    }

    public function ajax_calendar_data()
    {
        $this->load->model('Jobs_model');
        $this->load->model('ColorSettings_model');
        $this->load->model('Tickets_model');
        $this->load->model('Job_tags_model');
        $this->load->model('JobTags_model');
        $this->load->model('CalendarSettings_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $settings = $this->CalendarSettings_model->getByCompanyId($cid);
        if( $settings && $settings->timezone != '' ){
            $user_timezone = $settings->timezone;
        }else{
            $user_timezone = 'America/Chicago';
        }

        $date_from = date("Y-m-d", strtotime($post['start']));
        $date_to   = date("Y-m-d", strtotime($post['end']));
        $resources_map_events = [];

        //Jobs        
        $date_range['from'] = $date_from;
        $date_range['to']   = $date_to;        
        $jobs = $this->Jobs_model->getAllJobsByCompanyIdAndStartDate($cid, $date_range);    
        $inc  = 0;    
        foreach ($jobs as $j) {
            if( $j->work_order_id > 0 ){
                $scheduled_workorder_ids[] = $j;
            }

            if ($j->job_description != '') {
                $starttime = $j->start_date . " " . $j->start_time;
                $start_date = date('Y-m-d H:i:s', strtotime($j->start_date . " " . $j->start_time));
                $end_date   = date('Y-m-d H:i:s', strtotime($j->end_date . " " . $j->end_time));
                $backgroundColor = "#38a4f8";

                $colorSetting = $this->ColorSettings_model->getById($j->event_color);
                if($colorSetting){
                    $backgroundColor = $colorSetting->color_code;
                }

                $custom_html = '<div class="calendar-title-header">';

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
                }

                $custom_html .= '<a class="quick-calendar-tile" data-type="job" data-id="'.$j->id.'" href="javascript:void(0);"><span>'.$j->job_number.'</span></a>';
                $custom_html .= "</div>";                
                
                $resources_map_events[$inc]['eventId'] = $j->id;
                $resources_map_events[$inc]['eventType'] = 'job';
                $resources_map_events[$inc]['eventOrderNum'] = $j->job_number;
                $resources_map_events[$inc]['resourceIds'] = $resourceIds;
                $resources_map_events[$inc]['title'] = $j->job_description;
                $resources_map_events[$inc]['customHtml'] = $custom_html;
                $resources_map_events[$inc]['start'] = $start_date;
                $resources_map_events[$inc]['end'] = $end_date;                
                $resources_map_events[$inc]['backgroundColor'] = $backgroundColor;

                $inc++;
            }           
        }    

        //Service Tickets
        $date_range['from'] = $date_from;
        $date_range['to']   = $date_to;
        $serviceTickets = $this->Tickets_model->getAllTicketsByCompanyIdAndDateRange($cid, $date_range);
        foreach($serviceTickets as $st){
            $start_date_time = date('Y-m-d H:i:s', strtotime($st->ticket_date . " " . $st->scheduled_time)); 
            $start_date_end  = $start_date_time;
            $backgroundColor = "#ff751a";

            $custom_html = '<div class="calendar-title-header">';
            $custom_html  .= '<a class="quick-calendar-tile" data-type="ticket" data-id="'.$st->id.'" href="javascript:void(0);"><span>'. $st->ticket_no .'</span></a>';
            $resourceIds = array();
            if( $st->technicians != '' ){
                $assigned_technician = unserialize($st->technicians);
                if( is_array($assigned_technician) ){
                    foreach($assigned_technician as $eid){
                        $resourceIds[] = 'user' . $eid;                            
                    }                    
                }                    
            }
            $custom_html .= '</div>';

            $resources_map_events[$inc]['eventId'] = $st->id;
            $resources_map_events[$inc]['eventType'] = 'service_ticket';
            $resources_map_events[$inc]['eventOrderNum'] = $st->ticket_no;
            $resources_map_events[$inc]['resourceIds'] = $resourceIds;
            $resources_map_events[$inc]['title'] = 'Service Ticket : ' . date('Y-m-d g:i A', strtotime($st->ticket_date));
            $resources_map_events[$inc]['customHtml'] = $custom_html;
            $resources_map_events[$inc]['start'] = $start_date_time;
            $resources_map_events[$inc]['end'] = $start_date_end;
            $resources_map_events[$inc]['starttime'] = $start_date_time;
            $resources_map_events[$inc]['backgroundColor'] = $backgroundColor;

            $inc++;
        }
        
        echo json_encode($resources_map_events);
    }

    public function ajax_update_map_marker()
    {
        $is_valid = 1;
        $post = $this->input->post();
        $date_range['from'] = date("Y-m-d",strtotime($post['start_date']));
        $date_range['to']   = date("Y-m-d",strtotime($post['end_date']));
        $geoDataFeatures    = $this->createJobMapLocations($date_range);

        $return = ['is_valid' => $is_valid, 'geoFeatures' => $geoDataFeatures];
        echo json_encode($return);

    }

    public function ajax_get_map_location()
    {
        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');

        $post = $this->input->post();
        $is_valid  = 0;
        $latitude  = 0;
        $longitude = 0;

        $cid  = logged('company_id');
        $object_type = $post['object_type'];
        $object_id   = $post['object_id'];
        
        if( $object_type == 'job' ){
            $object = $this->Jobs_model->getByIdAndCompanyId($object_id, $cid);
            if( $object ){
                $address = $object->mail_add;
                $city    = $object->cust_city;
                $state   = $object->cust_state;
                $zip     = $object->cust_zipcode;

                $location = $address . ' ' . $city . ', ' . $state . ' ' . $zip;
                $param    = [
                    'text' => $location,
                    'format' => 'json',
                    'apiKey' => GEOAPIKEY
                ];            
                $url = 'https://api.geoapify.com/v1/geocode/search?'.http_build_query($param);
                $data = file_get_contents($url);            
                $data = json_decode($data);
                if( $data && isset($data->results[0] )){
                    $latitude  = $data->results[0]->lat;
                    $longitude = $data->results[0]->lon;

                    $is_valid = 1;
                }
            }
        }elseif( $object_type == 'service_ticket' ){
            $object = $this->Tickets_model->getByIdAndCompanyId($object_id, $cid);
            if( $object ){
                $address = $object->mail_add;
                $city    = $object->cust_city;
                $state   = $object->cust_state;
                $zip     = $object->cust_zipcode;

                $location = $address . ' ' . $city . ', ' . $state . ' ' . $zip;
                $param    = [
                    'text' => $location,
                    'format' => 'json',
                    'apiKey' => GEOAPIKEY
                ];            
                $url = 'https://api.geoapify.com/v1/geocode/search?'.http_build_query($param);
                $data = file_get_contents($url);            
                $data = json_decode($data);
                if( $data && isset($data->results[0] )){
                    $latitude  = $data->results[0]->lat;
                    $longitude = $data->results[0]->lon;

                    $is_valid = 1;
                }
            }
        }

        $return = ['is_valid' => $is_valid, 'latitude' => $latitude, 'longitude' => $longitude];
        echo json_encode($return);
    }

    public function createJobMapLocations($date_range = [])
    {        
        ini_set('max_execution_time', '0'); 

        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');

        $geoDataFeatures = [];

        $cid  = logged('company_id');
        if( empty($date_range) ){
            $date_range['from'] = date("Y-m-d", strtotime("-3 months"));
            $date_range['to']   = date("Y-m-d");
        }

        $customer_location = [];
        $map_data      = [];

        $jobs = $this->Jobs_model->getAllJobsByCompanyIdAndStartDate($cid, $date_range);    
        foreach($jobs as $j){
            $address = $j->mail_add;
            $city    = $j->cust_city;
            $state   = $j->cust_state;
            $zip     = $j->cust_zipcode;

            $location      = $address . ' ' . $city . ', ' . $state . ' ' . $zip;
            $customer_name = $j->first_name . ' ' . $j->last_name;            
            if( !in_array($j->customer_id, $customer_location) ){  
                $param    = [
                    'text' => $location,
                    'format' => 'json',
                    'apiKey' => GEOAPIKEY
                ];            
                $url = 'https://api.geoapify.com/v1/geocode/search?'.http_build_query($param);
                $data = file_get_contents($url);            
                $data = json_decode($data);
                if( $data && isset($data->results[0] )){  
                    $customer_location[$j->customer_id] = [
                        'name' => $customer_name,
                        'location' => $location,
                        'latitude' => $data->results[0]->lat,
                        'longitude' => $data->results[0]->lon
                    ];    
                }               
            } 

            $map_data[$j->customer_id][] = [
                'type' => 'job',
                'number' => $j->job_number,
                'location' => $location,
                'date' => date("m/d/Y",strtotime($j->start_date)),
            ];
        }

        $tickets = $this->Tickets_model->getAllByCompanyIdAndTicketDate($cid, $date_range);
        foreach($tickets as $t){
            $address = $t->mail_add;
            $city    = $t->cust_city;
            $state   = $t->cust_state;
            $zip     = $t->cust_zipcode;

            $location = $address . ' ' . $city . ', ' . $state . ' ' . $zip;
            $customer_name = $t->first_name . ' ' . $t->last_name;

            
            if( !in_array($t->customer_id, $customer_location) ){     
                $param    = [
                    'text' => $location,
                    'format' => 'json',
                    'apiKey' => GEOAPIKEY
                ];            
                $url = 'https://api.geoapify.com/v1/geocode/search?'.http_build_query($param);
                $data = file_get_contents($url);            
                $data = json_decode($data);
                if( $data && isset($data->results[0] )){
                    $customer_location[$t->customer_id] = [
                        'name' => $customer_name,
                        'location' => $location,
                        'latitude' => $data->results[0]->lat,
                        'longitude' => $data->results[0]->lon
                    ];   
                }                  
            }

            $map_data[$t->customer_id][] = [
                'type' => 'ticket',
                'number' => $t->ticket_no,
                'location' => $location,
                'date' => date("m/d/Y",strtotime($t->ticket_date))                        
            ];
        }   

        if( $customer_location ){
            foreach( $customer_location as $key => $data ){

                if( $map_data[$key] ){
                    $lon = $data['longitude'];
                    $lat = $data['latitude'];

                    $msg = "<div class='map-popup-container'>
                    <ul>
                        <li class='map-info-details header-info'><i class='bx bx-user-pin'></i> ".$data['name']."</li>
                        <li class='map-info-details header-info'><i class='bx bx-map'></i> ".$data['location']."</li>
                        <li class='map-info-divider'><hr /></li>
                    ";

                    foreach($map_data[$key] as $subdata){
                        $msg .= "<li class='map-info-details header-info'><i class='bx bx-briefcase'></i> ".$subdata['number']. " - " . $subdata['date'] ."</li>"; 
                    }

                    $msg .= '</ul></div>';

                    $geoDataFeatures[] = [
                        'type' => 'Feature',
                        'trac_id' => 'trac-' . $key,
                        'properties' => [
                            'message' => $msg,
                            'marker_color' => 'mediumpurple'
                        ],
                        'geometry' => [
                            'type' => 'Point',
                            'coordinates' => [$lon, $lat]
                        ]
                    ];
                }
            }
        }

        return $geoDataFeatures;
    }

    public function ajax_calendar_resource_users()
    {
        $this->load->model('Users_model');

        $cid = logged('company_id');    
        $tech_field_user_type = 6;
        
        $techs  = $this->Users_model->getCompanyUsersByUserType($cid, $tech_field_user_type);

        $resources_users = array();
        if (!empty($techs)) {
            $inc = 0;
            $default_imp_img = base_url('uploads/users/default.png');
            foreach ($techs as $get_user) {
                $default_imp_img = userProfileImage($get_user->id);
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

    public function ajax_update_map_settings()
    {
        $this->load->model('CompanyJobMapSetting_model');

        $is_success = 0;
        $message    = 'Cannot update settings';

        $post = $this->input->post();
        $cid  = logged('company_id');
        
        $mapSetting = $this->CompanyJobMapSetting_model->getByCompanyId($cid);
        if( $mapSetting ){
            $data = [              
                'map_style' => $post['map_style'],
                'map_zoom_level' => $post['map_zoom_level'],
                'center_map_latitude' => $post['center_map_latitude'],
                'center_map_longitude' => $post['center_map_longitude'],      
                'map_location' => $post['map_location'],          
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $this->CompanyJobMapSetting_model->update($mapSetting->id, $data);
        }else{
            $data = [
                'company_id' => $cid, 
                'map_style' => $post['map_style'],
                'map_zoom_level' => $post['map_zoom_level'],
                'center_map_latitude' => $post['center_map_latitude'],
                'center_map_longitude' => $post['center_map_longitude'],
                'map_location' => $post['map_location'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $this->CompanyJobMapSetting_model->create($data);
        }

        $is_success = 1;
        $message = '';

        $json_data = [
            'is_success' => $is_success,
            'message' => $message
        ];

        echo json_encode($json_data);
    }
}
/* End of file JobMap.php */

/* Location: ./application/controllers/JobMap.php */

