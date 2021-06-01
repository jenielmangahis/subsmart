<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trac360 extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
        $this->page_data['page']->title = 'Trac360';
        $this->load->model('trac360_model');
        $this->load->model('jobs_model');
    }

    public function getUsersCategories()
    {
        $company_id = logged('company_id');

        $return = array(
            'categories' => $this->db->query('select * from users_geo_positions_categories where company_id = ' . $company_id . ' order by id')->result_array(),
            'users' => $this->db->query(
                'select ' .

                    'a.user_id, ' .
                    'a.latitude, ' .
                    'a.longitude, ' .
                    'a.category_id, ' .
                    'b.img_type, ' .
                    'b.FName, ' .
                    'b.LName, ' .
                    'c.category_tag ' .

                    'from users_geo_positions a ' .

                    'left join users b on b.id = a.user_id ' .
                    'left join users_geo_positions_categories c on c.id = a.category_id ' .

                    'where a.company_id = ' . $company_id . ' ' .

                    'order by a.category_id'
            )->result_array()
        );

        echo json_encode($return);
    }

    public function getUsersGroups()
    {
        $company_id = logged('company_id');

        $return = array(
            'groups' => $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true),
            'users' => $this->users_model->getByWhere(array('company_id' => $company_id), [], true)
        );

        echo json_encode($return);
    }

    public function index()
    {
        add_css(array(
            "assets/css/trac360/people.css",
            "assets/css/timesheet/calendar/main.css",
            "assets/css/trac360/calendar.css"
        ));
        add_footer_js(array(
            "assets/js/trac360/people.js",
            "assets/js/trac360/calendar.js",
            "assets/js/timesheet/calendar/main.js",

        ));
        $company_id = logged('company_id');
        $user_id = logged('id');

        $user_locations = $this->trac360_model->get_current_user_location($company_id);


        $this->page_data['user_locations'] = $user_locations;
        $this->page_data['company_id'] = $company_id;
        $this->page_data['user_id'] = $user_id;

        $role    = logged('role');

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        if ($role == 1 || $role == 2) {
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobs();
        } else {
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobsByCompanyId($company_id);
        }

        $this->page_data['upcomingJobs'] = $upcomingJobs;


        $this->load->view('trac360/people', $this->page_data);
        // var_dump($data);
    }
    public function tester()
    {
        if ($this->session->userdata('usertimezone') == "") {
            var_dump(json_decode(get_cookie('logged'))->usertimezone);
        } else {
            var_dump($this->session->userdata('usertimezone'));
            var_dump(json_decode(get_cookie('logged'))->usertimezone);
            var_dump(json_decode(get_cookie('logged'))->offset_zone);
            echo count($this->session->userdata('logged'));
        }
    }

    public function getUserGeoPosition($uid)
    {
        $company_id = logged('company_id');

        $return = $this->users_geographic_positions_model->getRowByWhere(array('user_id' => $uid, 'company_id' => $company_id), 0, true);

        echo json_encode($return);
    }

    public function getNewGeoInfos()
    {
        $company_id = logged('company_id');

        $return = array(
            'users' => array(),
            'groups' => array(),
            'users_count' => 0,
            'groups_count' => 0
        );

        if (isset($_POST['user_ids'])) {
            $ids = $_POST['user_ids'];
            if (!empty($ids)) {
                $ids = 'and a.user_id not in(' . $ids . ') ';
            }

            $sql = 'select ' .

                'a.user_id, ' .
                'a.latitude, ' .
                'a.longitude, ' .
                'a.category_id, ' .
                'b.img_type, ' .
                'b.FName, ' .
                'b.LName, ' .
                'c.category_name, ' .
                'c.category_desc, ' .
                'c.category_tag ' .

                'from users_geo_positions a ' .

                'left join users b on b.id = a.user_id ' .
                'left join users_geo_positions_categories c on c.id = a.category_id ' .

                'where a.company_id = ' . $company_id . ' ' . $ids .

                'order by a.category_id';

            $users = $this->db->query($sql);

            $return['users_count'] = $users->num_rows();
            $return['users'] = $users->result_array();
        }

        if (isset($_POST['group_ids'])) {
            $ids = $_POST['group_ids'];
            if (!empty($ids)) {
                $ids = ' and id not in(' . $ids . ')';
            }

            $sql = 'select * from users_geo_positions_categories where company_id = ' . $company_id . $ids;

            $groups = $this->db->query($sql);

            $return['groups_count'] = $groups->num_rows();
            $return['groups'] = $groups->result_array();
        }

        echo json_encode($return);
    }

    public function addNewPeople()
    {
        $return = array(
            'error' => ""
        );

        $exists = $this->db->query(
            'select count(*) as `total`, a.category_id, concat(c.FName," ",c.LName) as `user_name`, b.category_name ' .
                'from users_geo_positions a ' .
                'left join users_geo_positions_categories b on b.id = a.category_id ' .
                'left join users c on c.id = a.user_id ' .
                'where user_id = ' . $_POST['user_id']
        )->row();

        if ($exists->total > 0) {
            $return['error'] = 'User <strong>' . $exists->user_name . '</strong> already added to the tracking list group <strong>' . $exists->category_name . '</strong>';
        } else {
            $company_id = logged('company_id');

            $data = array(
                'category_id' => $_POST['category_id'],
                'user_id' => $_POST['user_id'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'company_id' => $company_id,
                'date_added' => date('Y-m-d h:i:s')
            );

            if (!$this->users_geographic_positions_model->trans_create($data)) {
                $return['error'] = 'Error in adding person';
            }
        }

        echo json_encode($return);
    }

    public function deletePeople()
    {
        $return = array(
            'error' => ""
        );

        $exists = $this->db->query('select count(*) as `total` from users_geo_positions where user_id = ' . $_POST['user_id'])->row();
        if ($exists->total > 0) {
            if (!$this->users_geographic_positions_model->trans_delete(array(), array('user_id' => $_POST['user_id']))) {
                $return['error'] = 'Error in deleting person';
            }
        }

        echo json_encode($return);
    }

    public function addNewGroup()
    {
        $company_id = logged('company_id');

        $return = array(
            'users' => $this->users_model->getByWhere(array('company_id' => $company_id), [], true),
            'groups' => array(),
            'error' => ''
        );

        $category_name = trim($_POST['category_name']);
        $exists = $this->db->query('select count(*) as `total` from users_geo_positions_categories where lower(category_name) = "' . strtolower($category_name) . '"')->row();
        if ($exists->total > 0) {
            $return['error'] = 'Category record already exists';
        } else {
            $uid = logged('id');

            $data = array(
                'category_name' => $category_name,
                'category_desc' => $_POST['category_desc'],
                'category_tag' => $_POST['category_tag'],
                'date_created' => date('Y-m-d h:i:s'),
                'created_by' => $uid,
                'company_id' => $company_id
            );

            if (!$this->users_geographic_positions_categories_model->trans_create($data)) {
                $return['error'] = 'Error in adding group';
            } else {
                $return['groups'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true);
            }

            echo json_encode($return);
        }
    }

    public function deleteGroup()
    {
        $company_id = logged('company_id');

        $return = array(
            'users' => $this->users_model->getByWhere(array('company_id' => $company_id), [], true),
            'groups' => array(),
            'error' => ''
        );

        $group_id = $_POST['group_id'];
        $exists = $this->db->query('select count(*) as `total` from users_geo_positions_categories where id = ' . $group_id)->row();
        $used = $this->db->query('select count(*) as `total` from users_geo_positions where category_id = ' . $group_id)->row();

        if ($exists->total <= 0) {
            $return['groups'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true);
        } elseif ($used->total > 0) {
            $return['error'] = 'Group is currently in used';
        } else {
            if (!$this->users_geographic_positions_categories_model->trans_delete(array(), array('id' => $group_id))) {
                $return['error'] = 'Error in deleting group';
            } else {
                $return['groups'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true);
            }
        }

        echo json_encode($return);
    }

    public function places()
    {
        add_css(array(
            "assets/css/trac360/places.css",
            "assets/css/trac360/calendar.css",
            "assets/css/timesheet/calendar/main.css",
        ));
        add_footer_js(array(
            "assets/js/trac360/places.js",
            "assets/js/trac360/calendar.js",
            "assets/js/timesheet/calendar/main.js",

        ));
        $company_id = logged('company_id');
        $user_id = logged('id');

        $all_places = $this->trac360_model->get_places($company_id);
        $user_locations = $this->trac360_model->get_current_user_location($company_id);


        $this->page_data['all_places'] = $all_places;
        $this->page_data['company_id'] = $company_id;
        $this->page_data['user_id'] = $user_id;
        $this->page_data['user_locations'] = $user_locations;
        $this->load->view('trac360/places', $this->page_data);
    }
    public function current_user_update_last_tracked_location()
    {
        $user_id = $this->input->post("user_id");
        $company_id = $this->input->post("company_id");
        $lat = $this->input->post("lat");
        $lng = $this->input->post("lng");
        $formatted_address = $this->input->post("formatted_address");
        $this->trac360_model->current_user_update_last_tracked_location($user_id, $company_id, $lat, $lng, $formatted_address);
        $data = new stdClass();
        $data->user_id = $user_id;
        $data->company_id = $company_id;
        $data->lat = $lat;
        $data->lng = $lng;
        $data->formatted_address = $formatted_address;
        echo json_encode($data);
    }
    public function add_new_address()
    {
        $new_place_name =$this->input->post("new_place_name");
        $new_formatted_address=$this->input->post("new_formatted_address");
        $new_address_radius=$this->input->post("new_address_radius");
        $lat=$this->input->post("lat");
        $lng=$this->input->post("lng");
        $user_id = logged('id');
        $company_id = logged("company_id");
        $insert = array(
            "coordinates" => $lat.",".$lng,
            "address"=>$new_formatted_address,
            "zone_radius"=>$new_address_radius,
            "created_by"=>$user_id,
            "company_id"=>$company_id,
            "place_name"=>$new_place_name
        );
        $place_id = $this->trac360_model->insert_to("trac360_places", $insert);
        
        $all_users = $this->trac360_model->get_employees(logged('company_id'));
        foreach ($all_users as $user) {
            if ($user->id != $user_id) {
                $setting = $this->trac360_model->initial_settings_setter($place_id, $user->id, logged('id'));
            }
        }


        $data = new stdClass();
        $data->places = $this->get_all_places($company_id, $user_id);
        $data->place_id = $place_id;
        echo json_encode($data);
    }
    public function delete_place()
    {
        $place_id = $this->input->post("place_id");
        $this->trac360_model->delete_place($place_id);
        $data = new stdClass();
        $data->places = $this->get_all_places(logged("company_id"), logged("id"));
        echo json_encode($data);
    }
    public function update_place()
    {
        $place_id = $this->input->post("place_id");
        $place_name = $this->input->post("place_name");
        $address = $this->input->post("address");
        $zone_radius = $this->input->post("zone_radius");
        $lat = $this->input->post("lat");
        $lng = $this->input->post("lng");
        $update = array(
            "coordinates" => $lat.",".$lng,
            "place_name" => $place_name,
            "address" => $address,
            "zone_radius" => $zone_radius
        );
        
        $this->trac360_model->update_place($update, $place_id);
        $data = new stdClass();
        $data->places = $this->get_all_places(logged("company_id"), logged("id"));
        echo json_encode($data);
    }
    public function get_all_places($company_id, $user_id)
    {
        $all_places = $this->trac360_model->get_places($company_id);
        $places = '';
        foreach ($all_places as $place) {
            $exploded_coordinated=explode(",", $place->coordinates);
            $places .='<div id="sec-2-address-btn-'.$place->id.'"
            class="sec-2-option sec-2-address-btn"
            onclick="selected_place('.$place->coordinates.',\''.$place->place_name.'\',\''.$place->address.'\','.$place->zone_radius.','.$place->id.')">
    <div class="row ">
    <div class="col-md-2 profile">
        <center><img
                src="'.base_url("assets/img/trac360/map_marker.png").'"
                alt="user" class="">
        </center>
    </div>
    <div class="col-md-10 details">
        <p class="last_tract_location first-p">'.$place->place_name.'
        </p>
        <p class="last_tract_location second-p">'.$place->address.'
        </p>
        <div class="places-actions-btn">
            <button href="#" class="place-notif-action" id="place_notif_modal_btn"
            data-user-id="'.$place->created_by.'"
            data-place-id="'.$place->id.'">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </button>';
            if ($place->created_by == $user_id || logged("role") < 5) {
                $places .='<button href="#" class="place-edit-action edit_address_modal_btn"
                data-lat="'.$exploded_coordinated[0].'"
                data-lng="'.$exploded_coordinated[1].'"
                data-place-name="'.$place->place_name.'"
                data-address="'.$place->address.'"
                data-radius="'.$place->zone_radius.'"
                data-user-id="'.$place->created_by.'"
                data-place-id="'.$place->id.'">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>';
            }
            $places .='</div>
                </div>
            </div>
        </div>';
        }
        return $places;
    }
    public function get_notify_settings()
    {
        $place_id = $this->input->post("place_id");
        $user_id = $this->input->post("user_id");
        $or_query = "";
        $all_users = $this->trac360_model->get_employees(logged('company_id'));
        foreach ($all_users as $user) {
            if ($user->id != $user_id) {
                $setting = $this->trac360_model->initial_settings_setter($place_id, $user->id, logged('id'));
                if ($or_query == "") {
                    $or_query = $user->id;
                } else {
                    $or_query .= " or ".$user->id;
                }
            }
        }
        $notify_settings = $this->trac360_model->get_notify_settings($place_id, logged('id'), $or_query);
        $data = new stdClass();
        $data->notify_settings =$notify_settings;
        echo json_encode($data);
    }
    public function save_notif_changes()
    {
        $all_users = $this->trac360_model->get_employees(logged('company_id'));
        foreach ($all_users as $user) {
            $arrives = 0;
            if ($this->input->post("arrives_".$user->id) == "on") {
                $arrives =1;
            }
            $leaves = 0;
            if ($this->input->post("leaves_".$user->id) == "on") {
                $leaves =1;
            }
            $update = array(
                "notify_when_arrive" => $arrives,
                "notify_when_leave" => $leaves
            );
            $this->trac360_model->update_notification(logged("id"), $update, $this->input->post("place_id"), $user->id);
        }
        echo json_encode("success");
    }
    public function get_employee_upcoming_jobs()
    {
        $user_id = $this->input->post('user_id');
        $role    = logged('role');
        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);
        $upcomingJobs = $this->trac360_model->getAllUpcomingJobsByUser_id($user_id);
        $html='';
        if (!empty($upcomingJobs)) {
            foreach ($upcomingJobs as $jb) {
                $html .= '<div class="row no-margin jobs-list-item" data-address="'.$jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code.'" data-job-title="'.$jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name.'" data-office-address = "'.$jb->office_address.', '.$jb->office_city.', '.$jb->office_state.', '.$jb->office_postal_code.'" data-business-name="'.$jb->business_name.'">
              <div class="col-md-4 job-sched text-center">
                <a href="#">
                  <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                    <em>'.date('D', strtotime($jb->start_date)) .'</em>
                    <strong style="background-color: #58c04e;">'.date('M', strtotime($jb->start_date)) .'</strong>
                    <span>'. date('d', strtotime($jb->start_date)) .'</span>
                  </time>
                </a>
                <div class="job-status text-center mb-2"
                  style="background:'.$jb->event_color.'; color:#ffffff;">
                  <b>'.strtoupper($jb->status) .'</b>
                </div>
                <span class="text-center after-status">ARRIVAL TIME</span><br>
                <span class="job-caption text-center">
                  '.get_format_time($jb->start_time).' - '.get_format_time_plus_hours($jb->end_time).'
                </span>
              </div>
              <div class="col-md-8 job-details">
                <a style="color: #000!important;" href="#">
                  <h6 style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                    '.$jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name.'
                  </h6>';
                $html.='<b style="color:#45a73c;">'.$jb->first_name. ' '. $jb->last_name.'
                  </b><br>';
                
                $html.='<small class="text-muted">'.$jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code.'</small><br>
                    <i> <small class="text-muted">'.$jb->job_description.'</small></i><br>';
                $amount = $jb->amount!="" ? number_format((float)$jb->amount, 2, '.', ',') : '0.00' ;
                $html .='<small>Amount : $ '.$amount.'</small>
                  <br>';
                
                $html .='<a  target=""><small
                      style="color: darkred;">'.$jb->link.'</small></a>';
                
                $html .='</div>
            </div>';
            }
        } else {
            $html .='<div class="cue-event-name no-data">No upcoming jobs.</div>';
        }

        $data = new stdClass();
        $data->upcomingJobs =$upcomingJobs;
        $data->html =$html;
        echo json_encode($data);
    }
    public function jobs()
    {
        add_css(array(
            "assets/css/trac360/people.css",
            "assets/css/trac360/jobs.css",
            "assets/css/trac360/calendar.css",
            "assets/css/timesheet/calendar/main.css",
        ));
        add_footer_js(array(
            "assets/js/trac360/jobs.js",
            "assets/js/trac360/jobs_includes/live_jobs.js",
            "assets/js/trac360/calendar.js",
            "assets/js/timesheet/calendar/main.js",

        ));
        $company_id = logged('company_id');
        $user_id = logged('id');
        $role    = logged('role');

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);
        if ($role == 1 || $role == 2) {
            $upcomingJobs = $this->trac360_model->getAllUpcomingJobsByCompanyId($company_id); //$this->trac360_model->getAllUpcomingJobs();
        } else {
            $upcomingJobs = $this->trac360_model->getAllUpcomingJobsByCompanyId($company_id);
        }
        
        if ($role == 1 || $role == 2) {
            $previousJobs = $this->trac360_model->getAllpreviousJobsByCompanyID($company_id);//$this->trac360_model->getAllpreviousJobs();
        } else {
            $previousJobs = $this->trac360_model->getAllpreviousJobsByCompanyID($company_id);
        }
        
        $liveJobs = $this->trac360_model->get_all_jobs(date("Y-m-d"), date("Y-m-d"), logged('company_id'), "live");
        

        $this->page_data['upcomingJobs'] = $upcomingJobs;
        $this->page_data['previousJobs'] = $previousJobs;
        $this->page_data['company_id'] = $company_id;
        $this->page_data['user_id'] = $user_id;
        $this->page_data['liveJobs'] = $liveJobs;


        $this->load->view('trac360/jobs', $this->page_data);
        // var_dump($data);
    }
    public function get_jobs_for_calendar()
    {
        $date_from =date('Y-m-d', strtotime('first day of last month', strtotime($this->input->post("date_viewed"))));
        $date_to = date("Y-m-t", strtotime($this->input->post("date_viewed")));
        $all_jobs=$this->trac360_model->get_all_jobs($date_from, $date_to, logged('company_id'));
        $scredules = array();
        foreach ($all_jobs as $job) {
            $scredules[]=array(
                "title" => $job->FName .' '.$job->LName.' : '.$job->job_number . ' : ' . $job->job_type. ' - ' . $job->tags_name,
                "start" => $job->start_date.'T'.date('H:i:s', $job->start_time),
                "end" => $job->end_date.'T'.date('H:i:s', $job->end_time),
                "url" => $job->job_number . ' : ' . $job->job_type. ' - ' . $job->tags_name
            );
        }
        $data = new stdClass();
        $data->scredules = $scredules;
        $data->all_jobs= $all_jobs;
        $data->date_from=$date_from;
        $data->date_to=$date_to;
        echo json_encode($data);
    }
    public function history($job_id=0)
    {
        add_css(array(
            "assets/css/timesheet/calendar/main.css",
            "assets/css/trac360/people.css",
            "assets/css/trac360/jobs.css",
            "assets/css/trac360/calendar.css",
            "assets/css/trac360/history.css",
        ));
        add_footer_js(array(
            "assets/js/timesheet/calendar/main.js",
            "assets/js/trac360/calendar.js",
            "assets/js/trac360/history.js",
            "assets/js/trac360/history_includes/employee-jobs-panel.js",
            "assets/js/trac360/history_includes/employee-history-panel.js",
            "assets/js/trac360/history_includes/single-job-view-panel.js",

        ));
        $company_id = logged('company_id');
        $user_id = logged('id');
        $role    = logged('role');

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);
        if ($role == 1 || $role == 2) {
            $previousJobs = $this->trac360_model->getAllpreviousJobsByCompanyID($company_id);//$this->trac360_model->getAllpreviousJobs();
        } else {
            $previousJobs = $this->trac360_model->getAllpreviousJobsByCompanyID($company_id);
        }

        $this->page_data['previousJobs'] = $previousJobs;
        $this->page_data['company_id'] = $company_id;
        $this->page_data['user_id'] = $user_id;
        
        $user_locations = $this->trac360_model->get_current_user_location($company_id);
        $this->page_data['user_locations'] = $user_locations;



        if ($job_id > 0) {
            $jb = $this->trac360_model->get_job_byID($job_id);
            $this->page_data['external_employee_id'] = $jb->employee_id;
            $this->page_data['external_employee_name'] = $jb->FName.' '.$jb->LName;
            $this->page_data['external_job_item_selected_view_html'] ='';

            $this->page_data['external_job_selcted'] = true;
            $this->page_data['external_job_id'] = $job_id;

            $this->page_data['external_job_item_selected_view_html'] .='<div class="col-md-4 job-sched text-center">
                                        <a href="#">
                                            <time style="font-size: 10px; text-align: left;" datetime="2021-02-09"
                                                class="icon-calendar-live">
                                                <em>'.date('D', strtotime($jb->start_date)).'</em>
                                                <strong style="background-color: #58c04e;">'.date('M', strtotime($jb->start_date)) .'</strong>
                                                <span>'.date('d', strtotime($jb->start_date)) .'</span>
                                            </time>
                                        </a>
                                        <div class="job-status text-center mb-2"
                                            style="background:'.$jb->event_color.'; color:#ffffff;">
                                            <b>'.strtoupper($jb->status) .'</b>
                                        </div>
                                        <span class="text-center after-status">ARRIVAL TIME</span><br>
                                        <span class="job-caption text-center">
                                            '.get_format_time($jb->start_time).' - '. get_format_time_plus_hours($jb->end_time).'
                                        </span>
                                    </div>
                                    <div class="col-md-8 job-details">
                                        <a style="color: #000!important;" href="#">
                                            <h6
                                                style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                                                '.$jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name.'
                                            </h6>
                                            <b style="color:#45a73c;">
                                                '.$jb->first_name. ' '. $jb->last_name.'
                                            </b><br>';
                                            
            $this->page_data['external_job_item_selected_view_html'] .='<small class="text-muted">'.$jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code.'</small><br>
                <i> <small class="text-muted">'.$jb->job_description.'</small></i><br>';
                            
            if ($jb->amount!="") {
                $amoun =number_format((float)$jb->amount, 2, '.', ',') ;
            } else {
                $amount = '0.00';
            }
            $this->page_data['external_job_item_selected_view_html'] .='<small>Amount : $ '.$amount .'</small>
                <br>';
            if ($jb->link!='') {
                $this->page_data['external_job_item_selected_view_html'] .='<a href="'.$jb->link.'" target="">
            <small style="color: darkred; width:400px; overflow:hidden">Click here for the link </small></a>';
            }
            
            $this->page_data['external_job_item_selected_view_html'] .='</div>';
        }
        $this->load->view('trac360/history', $this->page_data);
        // var_dump($data);
    }
    public function get_employee_history()
    {
        $date_from = date("Y-m-d", strtotime($this->input->post("the_date_from")));
        $date_to = date("Y-m-d", strtotime($this->input->post("the_date_to")));
        $user_id = $this->input->post("the_user_id");
        $history_details = $this->trac360_model->get_employee_history($date_from, $date_to, $user_id);
        $info_count =0;
        $route_latlng = array();
        $html='';
        foreach ($history_details as $history) {
            $explode= explode(",", $history->last_coordinate);
            $explode[]=$history->last_address;
            $route_latlng [] = $explode;
            $info_class="";
            $info_icon = "";
            if ($info_count == 0) {
                $info_class="first-info";
                $info_icon = "fa-car";
            } elseif ($info_count+1 < count($history_details)) {
                $info_class="middle-info" ;
                $info_icon="fa-stop-circle" ;
            } else {
                $info_class="last-info" ;
                $info_icon="fa-map-marker" ;
            }
            $html .='<tr class="last-coords-details ' .$info_class.'"
    data-i="'.$info_count.'">
    <td class="connected-icon">
        <div><i class="fa '.$info_icon.'" aria-hidden="true"></i></div>
    </td>
    <td>
        <div class="address">'.$history->last_address.'</div>
        <div class="date-time">'.date('M d, Y h:i A', strtotime($history->date_created)).'</div>
    </td>
    </tr>';
            $info_count++;
        }
        $data = new stdClass();
        $data->html = $html;
        $data->route_latlng = $route_latlng;
        echo json_encode($data);
    }
    public function get_employee_prev_jobs()
    {
        $date_from = date("Y-m-d", strtotime($this->input->post("the_date_from")));
        $date_to = date("Y-m-d", strtotime($this->input->post("the_date_to")));
        $user_id = $this->input->post("the_user_id");
        $html = '';

        $all_jobs=$this->trac360_model->get_all_jobs_byID($date_from, $date_to, $user_id);

        foreach ($all_jobs as $jb) {
            $clickable_class ='clickable';
            if (date("Y-m-d", strtotime($jb->start_date)) > date("Y-m-d")) {
                $clickable_class ='upcoming-job';
            }
            $html .= '<div class="row no-margin jobs-list-item  '.$clickable_class.'"
        data-address="'.$jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code.'"
        data-job-title="'.$jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name.'"
        data-office-address="'.$jb->office_address.', '.$jb->office_city.', '.$jb->office_state.', '.$jb->office_postal_code.'"
        data-business-name="'.$jb->business_name.'" data-employee-name="'.$jb->FName.' '.$jb->LName.'"
        data-job-id="'.$jb->id.'" data-user-id="'.$jb->employee_id.'">
        <div class="col-md-4 job-sched text-center">
            <a href="#">
                <time style="font-size: 10px; text-align: left;" datetime="2021-02-09" class="icon-calendar-live">
                    <em>'.date('D', strtotime($jb->start_date)) .'</em>
                    <strong style="background-color: #58c04e;">'.date('M', strtotime($jb->start_date)) .'</strong>
                    <span>'. date('d', strtotime($jb->start_date)) .'</span>
                </time>
            </a>
            <div class="job-status text-center mb-2" style="background:'.$jb->event_color.'; color:#ffffff;">
                <b>'.strtoupper($jb->status) .'</b>
            </div>
            <span class="text-center after-status">ARRIVAL TIME</span><br>
            <span class="job-caption text-center">
                '.get_format_time($jb->start_time).' - '.get_format_time_plus_hours($jb->end_time).'
            </span>
        </div>
        <div class="col-md-8 job-details">
            <a style="color: #000!important;" href="#">
                <h6 style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                    '.$jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name.'
                </h6>';
            $html.='<b style="color:#45a73c;">'.$jb->first_name. ' '. $jb->last_name.'
                </b><br>';

            $html.='<small class="text-muted">'.$jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.'
                    '.$jb->cust_zip_code.'</small><br>
                <i> <small class="text-muted">'.$jb->job_description.'</small></i><br>';
            $amount = $jb->amount!="" ? number_format((float)$jb->amount, 2, '.', ',') : '0.00' ;
            $html .='<small>Amount : $ '.$amount.'</small>
                <br>';

            $html .='<a target=""><small style="color: darkred;">'.$jb->link.'</small></a>';

            $html .='
        </div>
    </div>';
        }
        $data = new stdClass();
        $data->html = $html;


        echo json_encode($data);
    }
    public function get_jobs_travel_history()
    {
        $job_id = $this->input->post("job_id");
        $user_id = $this->input->post("user_id");
        $history_details = $this->trac360_model->get_jobs_travel_history($job_id, $user_id);
        $info_count =0;
        $route_latlng = array();
        $html='';
        foreach ($history_details as $history) {
            $explode= explode(",", $history->last_coordinate);
            $explode[]=$history->last_address;
            $route_latlng [] = $explode;
            $info_class="";
            $info_icon = "";
            if ($info_count == 0) {
                $info_class="first-info";
                $info_icon = "fa-car";
            } elseif ($info_count+1 < count($history_details)) {
                $info_class="middle-info" ;
                $info_icon="fa-stop-circle" ;
            } else {
                $info_class="last-info" ;
                $info_icon="fa-map-marker" ;
            }
            $html .='<tr class="last-coords-details '
        .$info_class.'" data-i="'.$info_count.'">
        <td class="connected-icon">
            <div><i class="fa '.$info_icon.'" aria-hidden="true"></i></div>
        </td>
        <td>
            <div class="address">'.$history->last_address.'</div>
            <div class="date-time">'.date('M d, Y h:i A', strtotime($history->date_created)).'</div>
        </td>
        </tr>';
            $info_count++;
        }
        $data = new stdClass();
        $data->html = $html;
        $data->route_latlng = $route_latlng;
        echo json_encode($data);
    }
    public function get_seach_live_jobs()
    {
        $job_long_id = $this->input->post("the_job_long_id");
        $liveJobs = array();
        $html ="";
        if ($job_long_id=="") {
            $liveJobs = $this->trac360_model->get_all_jobs(date("Y-m-d"), date("Y-m-d"), logged('company_id'), "live");
        } else {
            $liveJobs = $this->trac360_model->get_seach_live_jobs($job_long_id, logged('company_id'));
        }
        if (count($liveJobs) > 0) {
            foreach ($liveJobs as $jb) {
                $html .='<div class="job-item-panel"
                    data-job-id="'.$jb->id.'">
                    <div class="employee-name">
                        <p><span class="name">'.$jb->FName .' '.$jb->LName.'</span>
                        </p>
                    </div>
                    <div class="row no-margin jobs-list-item">
                        <div class="col-md-4 job-sched text-center">
                            <a href="#">
                                <time style="font-size: 10px; text-align: left;" datetime="2021-02-09"
                                    class="icon-calendar-live">
                                    <em>'.date('D', strtotime($jb->start_date)).'</em>
                                    <strong style="background-color: #58c04e;">'.date('M', strtotime($jb->start_date)) .'</strong>
                                    <span>'.date('d', strtotime($jb->start_date)) .'</span>
                                </time>
                            </a>
                            <div class="job-status text-center mb-2"
                                style="background:'.$jb->event_color.'; color:#ffffff;">
                                <b>'.strtoupper($jb->status).'</b>
                            </div>
                            <span class="text-center after-status">ARRIVAL TIME</span><br>
                            <span class="job-caption text-center">
                                '.get_format_time($jb->start_time).' - '.get_format_time_plus_hours($jb->end_time).'
                            </span>
                        </div>
                        <div class="col-md-8 job-details">
                            <a style="color: #000!important;" href="#">
                                <h6
                                    style="font-weight:600; margin:0;font-size: 14px;text-transform: uppercase; color:#616161;">
                                    '.$jb->job_number . ' : ' . $jb->job_type. ' - ' . $jb->tags_name.'
                                </h6>
                                <b style="color:#45a73c;">
                                    '.$jb->first_name. ' '. $jb->last_name.'
                                </b><br>';
                $html.='<small class="text-muted">'.$jb->mail_add .' '. $jb->cust_city.' '.$jb->cust_state.' '.$jb->cust_zip_code.'</small><br>
                    <i> <small class="text-muted">'.$jb->job_description.'</small></i><br>';
                
                $amount = '0.00';
                if ($jb->amount != "") {
                    $amount= number_format((float)$jb->amount, 2, '.', ',') ;
                }
                $html.='<small>Amount : $ '.$amount.'</small>
                    <br>';
                
                $click_me = "";
                if ($jb->link!='') {
                    $click_me ="Click here for the link";
                }
                $html.='<a href="'.$jb->link.'" target="">
                        <small style="color: darkred; width:400px; overflow:hidden">'.$click_me.'</small></a>';
                
                $html.='</div>
                    </div>
                    </div>';
            }
        }
        $data = new stdClass();
        $data->html = $html;
        echo json_encode($data);
    }
}
