<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trac360_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return $this->db->insert_id();
    }

    public function deleteUser($table, $user_id)
    {
        $this->db->delete($table, array('user_id' => $user_id));
    }
    public function get_current_user_location($company_id)
    {
        $query = $this->db->query("SELECT trac360_people.*,users.FName,users.LName, users.profile_img FROM trac360_people JOIN users ON trac360_people.user_id = users.id WHERE trac360_people.company_id = " . $company_id);
        return $query->result();
    }

    public function getTrac360PeopleByCompanyIdAndUserId($cid, $uid = array(), $date_range = array())
    {
        $this->db->select('trac360_people.*, users.FName,users.LName, users.profile_img');        
        $this->db->from('trac360_people');   
        $this->db->join('users', 'trac360_people.user_id  = users.id');
        $this->db->where('trac360_people.company_id', $cid);
        $this->db->where_in('trac360_people.user_id', $uid);

        if( $date_range ){
            $this->db->where('trac360_people.last_tracked_location_date >=', $date_range['from']);
            $this->db->where('trac360_people.last_tracked_location_date <=', $date_range['to']);
        }

        $this->db->order_by('trac360_people.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function get_last_location_from_timesheet_logs($user_id)
    {
        $this->db->order_by('date_created', 'DESC')->limit(1);
        return $this->db->get_where('timesheet_logs', array('user_id' => $user_id))->row();
    }
    public function get_places($company_id)
    {
        $query = $this->db->query("SELECT * FROM trac360_places WHERE company_id = " . $company_id);
        return $query->result();
    }
    public function current_user_update_last_tracked_location($user_id, $company_id, $lat, $lng, $formatted_address)
    {
        $update = array(
            "last_tracked_location" => $lat . "," . $lng,
            "last_tracked_location_address" => $formatted_address,
            "last_tracked_location_date" => date('Y-m-d H:i:s')
        );
        $this->db->reset_query();
        $this->db->where('user_id', $user_id);
        $this->db->where('company_id', $company_id);
        $this->db->update("trac360_people", $update);

        $this->db->reset_query();
        $query = $this->db->query("SELECT trac360_people.*,users.FName,users.LName, users.profile_img FROM trac360_people JOIN users ON trac360_people.user_id = users.id WHERE trac360_people.company_id = " . $company_id . " AND trac360_people.user_id=" . $user_id);
        return $query->row();
    }
    public function insert_to($table, $data)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function delete_place($place_id)
    {
        $this->db->reset_query();
        $query = $this->db->query("DELETE FROM trac360_places WHERE id = ".$place_id);
        $this->db->reset_query();
        $query = $this->db->query("DELETE FROM trac360_notify_people WHERE place_id = ".$place_id);
    }
    public function update_place($update, $place_id)
    {
        $this->db->where("id", $place_id);
        $this->db->update("trac360_places", $update);
    }

    public function get_employees($company_id)
    {
        $this->db->reset_query();
        $qry = $this->db->query("SELECT id,FName,LName,profile_img from users WHERE company_id = ".$company_id);
        return $qry->result();
    }
    public function initial_settings_setter($place_id, $user_id, $created_by)
    {
        $this->db->reset_query();
        $qry = $this->db->query("SELECT * FROM trac360_notify_people WHERE place_id = ".$place_id." AND user_id = ".$user_id." AND created_by = ".$created_by);
        $settings = $qry->row();
        if ($settings != null) {
            return true;
        } else {
            $this->db->reset_query();
            $insert = array(
                'created_by' => $created_by,
                'place_id' => $place_id,
                'user_id' => $user_id,
                'notify_when_arrive' => 1,
                'notify_when_leave' => 1
            );
            $this->db->insert('trac360_notify_people', $insert);
            $qry = $this->db->query("SELECT * FROM trac360_notify_people WHERE place_id = ".$place_id." AND user_id = ".$user_id." AND created_by = ".$created_by);
            return true;
        }
    }
    public function get_notify_settings($place_id, $created_by, $or_query)
    {
        $this->db->reset_query();
        $qry = $this->db->query("SELECT * FROM trac360_notify_people WHERE place_id = ".$place_id." AND created_by = ".$created_by ." AND (".$or_query.")");
        return $qry->result();
    }
    public function update_notification($created_by, $update, $place_id, $user_id)
    {
        $this->db->reset_query();
        $this->db->where('user_id', $user_id);
        $this->db->where('place_id', $place_id);
        $this->db->where('created_by', $created_by);
        $this->db->update("trac360_notify_people", $update);
    }
    public function getAllUpcomingJobsByUser_id($user_id)
    {
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');
        $start_date = date('Y-m-d');
        
        $this->db->where('jobs.start_date >= "'. $start_date . '"');
        $this->db->where('jobs.employee_id', $user_id);
        $this->db->order_by('jobs.start_date', 'ASC');
        $query = $this->db->get();
        //print_r($this->db->last_query());  exit;
        return $query->result();
    }
    public function getAllpreviousJobs()
    {
        $this->db->select('jobs.id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from("jobs");
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $start_date = date('Y-m-d');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');

        $start_date = date('Y-m-d', strtotime(date('Y-m-d') . ' -30 day'));
        $end_date   = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day'));
        
        $this->db->where('jobs.start_date < "'. $end_date.'"');
        $this->db->order_by('jobs.start_date', 'DESC');
        $this->db->limit(30);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllpreviousJobsByCompanyID($company_id = 0)
    {
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');
        $end_date   = date('Y-m-d', strtotime(date('Y-m-d')));
        
        
        $this->db->where('jobs.start_date < "'. $end_date.'"');

        $this->db->where('jobs.company_id', $company_id);
        $this->db->limit(30);
        $this->db->order_by('jobs.start_date', 'DESC');
        $query = $this->db->get();
        //print_r($this->db->last_query());  exit;
        return $query->result();
    }

    public function getAllUpcomingJobsByCompanyId($company_id = 0)
    {
        $this->db->reset_query();
        
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');

        //echo $start_date . "/" . $end_date;exit;
        
        $this->db->where_in('jobs.status', array("New", "Scheduled"));
        $this->db->where('jobs.start_date >= "'. date("Y-m-d") . '"');
        $this->db->where('jobs.company_id', $company_id);
        $this->db->order_by('jobs.start_date', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
    public function getAllUpcomingJobs()
    {
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');

        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +30 day'));

        //echo $start_date . "/" . $end_date;exit;
        
        $this->db->where_in('jobs.status', array("New", "Scheduled"));
        $this->db->where('jobs.start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        $this->db->order_by('jobs.start_date', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_all_jobs($date_from, $date_to, $company_id, $purpose="")
    {
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');

        //echo $start_date . "/" . $end_date;exit;
        
        $this->db->where('jobs.company_id', $company_id);

        if ($purpose == "live") {
            $this->db->where_in('jobs.status', array("Started", "Arrival", "Paused"));
        } else {
            $this->db->where('jobs.start_date BETWEEN "'. $date_from . '" and "'. $date_to .'"');
        }
        $this->db->order_by('jobs.start_date', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_employee_history($date_from, $date_to, $user_id)
    {
        $this->db->reset_query();
        $qry = $this->db->query("SELECT * from trac360_user_visit_details WHERE date_created >= '".$date_from."' AND date_created <= '".$date_to." 23:59:59' AND user_id = ".$user_id);
        return $qry->result();
    }
    
    public function get_all_jobs_byID($date_from, $date_to, $user_id)
    {
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');

        //echo $start_date . "/" . $end_date;exit;
        
        $this->db->where('jobs.start_date BETWEEN "'. $date_from . '" and "'. $date_to .' 23:59:59"');
        $this->db->where('jobs.employee_id', $user_id);
        $this->db->order_by('jobs.start_date', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_jobs_travel_history($job_id, $user_id)
    {
        $this->db->reset_query();
        $qry = $this->db->query("SELECT * from trac360_user_visit_details WHERE job_id = $job_id AND user_id = ".$user_id);
        return $qry->result();
    }
    public function get_job_byID($job_id)
    {
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');

        //echo $start_date . "/" . $end_date;exit;
        
        $this->db->where('jobs.id', $job_id);
        $this->db->order_by('jobs.start_date', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_seach_live_jobs($job_long_id, $company_id)
    {
        $this->db->select('jobs.id, jobs.employee_id, jobs.job_number, jobs.job_name, jobs.event_color, jobs.job_description, jobs.job_location, jobs.job_type, jobs.tags, jobs.start_date, 
        jobs.end_date, jobs.company_id, jobs.start_time, jobs.end_time, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name,
        job_tags.name as tags_name,cust.first_name,cust.last_name,cust.mail_add,cust.city as cust_city,cust.state as cust_state,cust.zip_code as cust_zip_code,job_url_links.link,users.profile_img,jpd.amount,users.FName,users.LName,
        business_profile.address as office_address, business_profile.city as office_city, business_profile.state as office_state, business_profile.postal_code as office_postal_code, business_profile.business_name');

        $this->db->from('jobs');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id', 'left');
        $this->db->join('job_payments as jpd', 'jobs.id = jpd.job_id', 'left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags', 'left');
        $this->db->join('acs_profile as cust', 'cust.prof_id = jobs.customer_id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = users.company_id', 'left');

        $this->db->where('jobs.company_id', $company_id);
        $this->db->like('jobs.job_number', $job_long_id);
        $this->db->where_in('jobs.status', array("Started", "Arrival", "Paused"));
        $this->db->order_by('jobs.start_date', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}
