<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends MY_Model
{

    public $table = 'events';
    public $table_items = 'event_items';

    public function get_all_events($limit = 0, $conditions = array())
    {
        $cid = logged('company_id');
        $this->db->from($this->table);
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->where("events.company_id", $cid);
        if (!empty($conditions)) {
            foreach ($conditions as $key => $value) {
                $this->db->where($value['field'], $value['value']);
            }
        }
        $this->db->order_by('id', "DESC");
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllEventsAdmin($filters=array(), $limit = 0)
    {
        $this->db->from($this->table);
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img,business_profile.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = events.company_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->order_by('id', "DESC");

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('event_number', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByStatus($status)
    {
        $this->db->from($this->table);
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img,business_profile.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = events.company_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->order_by('id', "DESC");
        $this->db->where('events.status', $status);        

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_specific_event($id)
    {
        $this->db->from($this->table);
        $this->db->select('events.*,events.id as job_unique_id,LName,FName,
        acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email,business_profile.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->join('business_profile', 'events.company_id = business_profile.id', 'left');
        $this->db->where("events.id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_specific_event_items($id)
    {
        $this->db->select('items.title,items.price,event_items.qty,event_items.event_id,event_items.items_id,event_items.item_price');
        $this->db->from('event_items');
        $this->db->join('items', 'items.id = event_items.items_id', 'left');
        $this->db->where("event_items.event_id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompany($company_id, $user_id = 0)
    {

        $this->db->select('events.id, events.company_id, customer_id, employee_id, event_type, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, events.status, LName,FName, acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email, events.event_number, events.event_address, events.event_tag');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'right');
        if ($user_id > 0) {
            /*$this->db->join('user_events', 'user_events.event_id = events.id');
            $this->db->where('user_events.user_id', $user_id);*/
            $this->db->where('events.employee_id', $user_id);
        }

        $this->db->where('events.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllEvents()
    {

        $this->db->select('events.*, customer_id, employee_id, event_type, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, events.status, LName,FName, acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'right');

        $query = $this->db->get();
        return $query->result();
    }


    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0)
    {
        $user_id = getLoggedUserID();

        $this->db->select('events.id, company_id, customer_id, employee_id, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        if ($uid) {
            $this->db->join('user_events', 'user_events.event_id = events.id');
            $this->db->where('user_events.user_id', $uid);
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();die;

        if ($query) {
            return $query->result();
        }

        return false;
    }

    public function getAllUpComingEvents($user_id = 0)
    {
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');

        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($start_date . ' +5 day'));

        $this->db->where('start_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');

        $this->db->order_by('id', 'DESC');

        $query = $this->db->limit(5);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllUpComingEventsByCompanyId($company_id = 0)
    {
        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +7 day'));

        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->join('acs_profile', 'acs_profile.prof_id = `events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->from($this->table);
        $this->db->where('events.company_id', $company_id);
        $this->db->where('events.start_date >=',$start_date);
        $this->db->order_by('events.start_date', 'ASC');

        //$query = $this->db->limit(5);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllEventsByCompanyIdAndDate($company_id = 0, $date)
    {
        $date = date('Y-m-d', strtotime($date));        

        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->join('acs_profile', 'acs_profile.prof_id = `events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->from($this->table);
        $this->db->where('events.company_id', $company_id);
        $this->db->where('events.start_date',$date);
        $this->db->order_by('events.start_date', 'ASC');

        //$query = $this->db->limit(5);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllInvoices()
    {
        $company_id = logged('company_id');
        $query = $this->db->get_where('invoices', array('company_id' => $company_id));

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTodayStats()
    {
        $company_id = logged('company_id');
        $this->db->from('jobs');
        $this->db->select('job_payments.amount,jobs.date_issued,jobs.status');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id', 'left');
        $this->db->where("jobs.company_id", $company_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getCollected()
    {
        $company_id = logged('company_id');
        $this->db->from('jobs');
        $this->db->select('job_payments.amount,jobs.date_issued,jobs.status');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id');
        $this->db->where("jobs.company_id", $company_id);
        $this->db->where("jobs.status", 'Completed');
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAccountSituation($toCheck = 'collect_date')
    {
        $company_id = logged('company_id');
        $this->db->select('COUNT(*) as total');
        $this->db->from('acs_office');
        $this->db->join('acs_profile', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where("acs_profile.company_id", $company_id);
        $this->db->where("acs_office.".$toCheck, date('m/d/Y'));
        $this->db->group_by('acs_profile.prof_id');
        $query = $this->db->get();
        //dd($this->db->last_query());

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTechLeaderboards()
    {
        $cid=logged('company_id');
        $this->db->select('users.id, users.FName, users.LName, COUNT(acs_office.technician) as totalCount');
        $this->db->from('users');
        $this->db->join('acs_office', 'users.id = acs_office.technician');
        $this->db->where('users.company_id', $cid);
        $this->db->where('users.role', 7);
        $this->db->group_by('technician');
        $this->db->order_by('totalCount', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomerCountPerId($id,$field='technician')
    {
        $this->db->select('count('.$field.') as totalCount');
        $this->db->from('acs_office');
        $this->db->where($field.'=', $id);
        $this->db->group_by($field);
        $this->db->order_by('totalCount', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function getJobCountPerId($id)
    {
        $this->db->select('count(jobs.id) as totalCount');
        $this->db->from('job_payments');
        $this->db->join('jobs', ' job_payments.job_id = jobs.id', 'left');
        $this->db->join('invoices', ' invoices.job_id = jobs.id');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $id);
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(jobs.date_issued, "%Y")');
        // $this->db->group_by('jobs.customer_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSalesLeaderboards()
    {
        $cid=logged('company_id');
        $this->db->select('users.id,FName,LName, count(fk_sales_rep_office) as customerCount');
        $this->db->from('users');
        $this->db->join('acs_office', 'acs_office.fk_sales_rep_office = users.id', 'left');
        $this->db->where('users.company_id', $cid);
        $this->db->where('fk_sales_rep_office !=', null);
        $this->db->group_by('users.id');
        $this->db->order_by('customerCount', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function will fetch lead source data with count of customer connected to it
     * 
     * @return object List of Lead Source per company ID with count on customer
    */
    public function getLeadSourceWithCount()
    {
        $cid=logged('company_id');
        $this->db->select('acs_office.lead_source, count(acs_office.lead_source) as leadSourceCount');
        $this->db->from('acs_profile');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.lead_source !=', "");
        $this->db->where('company_id =', $cid);
        $this->db->group_by('acs_office.lead_source');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function will fetch jobs status with count
     * 
     * @return object List of JOB STATUS with number of count
    */
    // public function getJobStatusWithCount()
    // {
    //     $cid=logged('company_id');
    //     $this->db->select('status, count(status) as statusCount');
    //     $this->db->from('jobs');
    //     $this->db->group_by('status');
    //     $this->db->order_by('statusCount');
    //     $this->db->where('company_id', $cid);
    //     $query = $this->db->get();
    //     return $query->result();
    // }


 public function getStatusCount($DATE)
    {
        $CURRENT_MONTH_COUNT = array();
        $CURRENT_YEAR_COUNT = array();
        $COMPANY_ID = logged('company_id');

        // GET SCHEDULED COUNT BASED ON CURRENT MONTH
        $this->db->select('"Scheduled" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Scheduled%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Scheduled%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(appointments.appointment_number) FROM appointments WHERE appointments.appointment_number LIKE "%JOB%" AND DATE_FORMAT(appointments.appointment_date, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") OR appointments.appointment_number LIKE "%EVENT%" AND DATE_FORMAT(appointments.appointment_date, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") OR appointments.appointment_number LIKE "%SERVICES%" AND DATE_FORMAT(appointments.appointment_date, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m"))) AS TOTAL');
        $scheduledQueryMonth = $this->db->get();
        array_push($CURRENT_MONTH_COUNT, $scheduledQueryMonth->row());

        // GET ARRIVAL COUNT BASED ON CURRENT MONTH
        $this->db->select('"Arrival" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Arrival%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Arrival%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $arrivalQueryMonth = $this->db->get();
        array_push($CURRENT_MONTH_COUNT, $arrivalQueryMonth->row());

        // GET STARTED COUNT BASED ON CURRENT MONTH
        $this->db->select('"Started" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Started%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Started%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $startedQueryMonth = $this->db->get();
        array_push($CURRENT_MONTH_COUNT, $startedQueryMonth->row());

        // GET APPROVED COUNT BASED ON CURRENT MONTH
        $this->db->select('"Approved" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Approved%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Approved%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $approvedQueryMonth = $this->db->get();
        array_push($CURRENT_MONTH_COUNT, $approvedQueryMonth->row());

        // GET FINISH COUNT BASED ON CURRENT MONTH
        $this->db->select('"Finish" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Finish%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Finish%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $finishQueryMonth = $this->db->get();
        array_push($CURRENT_MONTH_COUNT, $finishQueryMonth->row());

        // GET INVOICED COUNT BASED ON CURRENT MONTH
        $this->db->select('"Invoiced" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Invoiced%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Invoiced%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $invoicedQueryMonth = $this->db->get();
        array_push($CURRENT_MONTH_COUNT, $invoicedQueryMonth->row());

        // GET COMPLETED COUNT BASED ON CURRENT MONTH
        $this->db->select('"Completed" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Completed%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Completed%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Finished%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Finished%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $completedQueryMonth = $this->db->get();
        array_push($CURRENT_MONTH_COUNT, $completedQueryMonth->row());

        // GET SCHEDULED COUNT BASED ON CURRENT YEAR
        $this->db->select('"Scheduled" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Scheduled%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Scheduled%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(appointments.appointment_number) FROM appointments WHERE appointments.appointment_number LIKE "%JOB%" AND DATE_FORMAT(appointments.appointment_date, "%Y") = DATE_FORMAT(CURDATE(), "%Y") OR appointments.appointment_number LIKE "%EVENT%" AND DATE_FORMAT(appointments.appointment_date, "%Y") = DATE_FORMAT(CURDATE(), "%Y") OR appointments.appointment_number LIKE "%SERVICES%" AND DATE_FORMAT(appointments.appointment_date, "%Y") = DATE_FORMAT(CURDATE(), "%Y"))) AS TOTAL');
        $scheduledQueryYear = $this->db->get();
        array_push($CURRENT_YEAR_COUNT, $scheduledQueryYear->row());

        // GET ARRIVAL COUNT BASED ON CURRENT YEAR
        $this->db->select('"Arrival" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Arrival%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Arrival%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $arrivalQueryYear = $this->db->get();
        array_push($CURRENT_YEAR_COUNT, $arrivalQueryYear->row());

        // GET STARTED COUNT BASED ON CURRENT YEAR
        $this->db->select('"Started" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Started%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Started%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $startedQueryYear = $this->db->get();
        array_push($CURRENT_YEAR_COUNT, $startedQueryYear->row());

        // GET APPROVED COUNT BASED ON CURRENT YEAR
        $this->db->select('"Approved" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Approved%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Approved%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $approvedQueryYear = $this->db->get();
        array_push($CURRENT_YEAR_COUNT, $approvedQueryYear->row());

        // GET FINISH COUNT BASED ON CURRENT YEAR
        $this->db->select('"Finish" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Finish%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Finish%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $finishQueryYear = $this->db->get();
        array_push($CURRENT_YEAR_COUNT, $finishQueryYear->row());

        // GET INVOICED COUNT BASED ON CURRENT YEAR
        $this->db->select('"Invoiced" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Invoiced%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Invoiced%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $invoicedQueryYear = $this->db->get();
        array_push($CURRENT_YEAR_COUNT, $invoicedQueryYear->row());

        // GET COMPLETED COUNT BASED ON CURRENT YEAR
        $this->db->select('"Completed" AS STATUS, ((SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Completed%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Completed%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(jobs.status) FROM jobs WHERE jobs.status LIKE "%Finished%" AND jobs.job_number LIKE "%JOB%" AND DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.company_id = "'.$COMPANY_ID.'")+(SELECT COUNT(events.status) FROM events WHERE events.status LIKE "%Finished%" AND events.event_number LIKE "%EVENT%" AND DATE_FORMAT(events.date_created, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND events.company_id = "'.$COMPANY_ID.'")) AS TOTAL');
        $completedQueryYear = $this->db->get();
        array_push($CURRENT_YEAR_COUNT, $completedQueryYear->row());

        if ($DATE == "YEAR") {
            return $CURRENT_YEAR_COUNT;
        }
        if ($DATE == "MONTH") {
            return $CURRENT_MONTH_COUNT;
        }
    }


      /**
     * This function will fetch latest jobs of each company
     * 
     * @return object List of LATEST JOB limit 10
    */
    public function getLatestJobs()
    {
        $cid=logged('company_id');
        $this->db->select('first_name,last_name,city,state,jobs.id,jobs.status,job_number,job_type,start_date,amount');
        $this->db->from('jobs');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->order_by('jobs.id', 'desc');
        $this->db->where('jobs.company_id', $cid);
        if($cid == 58){
            $this->db->limit(25); // for SOLAR COMPANY it needs to be 25
        }else{
            $this->db->limit(10);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function will fetch jobs status with count
     * 
     * @return object List of JOB STATUS with number of count
    */
    public function getCustomerStatusWithCount()
    {
        $cid=logged('company_id');
        $this->db->select('status, count(status) as statusCount');
        $this->db->from('acs_profile');
        $this->db->group_by('status');
        $this->db->order_by('statusCount', 'desc');
        $this->db->where('company_id', $cid);
        $this->db->where('status !=', null);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function will fetch recent customers per company id
     * 
     * @return object List of RECENT CUSTOMER added
    */
    public function getRecentCustomer()
    {
        $company_id = logged('company_id');
        $this->db->from('acs_profile');
        $this->db->where('company_id', $company_id);
        $this->db->order_by('prof_id', 'desc');
        $this->db->limit(10);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * This function will fetch companies
     * 
     * @return object List of companies
    */
    public function getCompanies()
    {
        $this->db->from('business_profile');
        $this->db->order_by('id', 'asc');
        $this->db->limit(10);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTechRevenue($techId)
    {
        $this->db->select('SUM(job_payments.amount) as techRev');
        $this->db->from('job_payments');
        $this->db->join('jobs', ' job_payments.job_id = jobs.id', 'left');
        $this->db->join('invoices', ' invoices.job_id = jobs.id');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $techId);
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(jobs.date_issued, "%Y")');
        // $this->db->group_by('jobs.customer_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getTechRevenueSolar($salesRepId)
    {
        $this->db->select('SUM(acs_info_solar.proposed_payment) as techRev');
        $this->db->from('acs_info_solar');
        $this->db->join('acs_profile', ' acs_profile.prof_id = acs_info_solar.fk_prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $salesRepId);
        $this->db->group_by('acs_office.technician');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSalesRepRevenue($salesRepId)
    {
        $this->db->select('SUM(job_payments.amount) as salesRepRev');
        $this->db->from('job_payments');
        $this->db->join('jobs', ' job_payments.job_id = jobs.id', 'left');
        $this->db->join('users', 'users.id = jobs.employee_id', 'left');
        $this->db->where('jobs.employee_id', $salesRepId);
        $this->db->group_by('jobs.employee_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSalesRepRevenueSolar($salesRepId)
    {
        $this->db->select('SUM(acs_info_solar.proposed_solar) as salesRepRev');
        $this->db->from('acs_info_solar');
        $this->db->join('acs_profile', ' acs_profile.prof_id = acs_info_solar.fk_prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('fk_sales_rep_office', $salesRepId);
        $this->db->group_by('fk_sales_rep_office');
        $query = $this->db->get();
        return $query->result();
    }

    public function getTechCustomerCount($techId)
    {
        $this->db->select('SUM(job_payments.amount) as techRev');
        $this->db->from('job_payments');
        $this->db->join('jobs', ' job_payments.job_id = jobs.id', 'left');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $techId);
        $this->db->group_by('jobs.customer_id');
        $query = $this->db->get();
        return $query->result();
    }


    public function getSalesLeaderboardItems($company_id)
    {
        $this->db->select('*');
        $this->db->from('acs_profile');
        $this->db->where('company_id =', $company_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getSalesinOffice($prof_id)
    {
        $this->db->select('*');
        $this->db->from('acs_office');
        $this->db->where('fk_prof_id =', $prof_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getUser($user)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id =', $user);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getRoles($roles)
    {
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where('id =', $roles);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
        // $data = new stdClass();
        // // $data->class = $qu
    }

    public function getSalesLeaderboard()
    {
        $sales [][] = "";
        $salesItems = $this->getSalesLeaderboardItems(logged('company_id'));

        $z =1;
        //var_dump($salesItems[0]->prof_id);
        
        for ($k = 0; $k < count($salesItems);$k++) {
            $salesOffice = $this->getSalesinOffice($salesItems[$k]->prof_id);
            if( isset($salesOffice[$k]) ){
                $userName = $this->getUser($salesOffice[$k]->fk_sales_rep_office);
                $roles = $this->getRoles($userName[$k]->role);
                $x = 0;
                
                if ($sales[0][0] == "") {
                    $sales[$x][0] = $userName[$k]->FName[0] . $userName[$k]->LName[0];
                    $sales[$x][1] = $userName[$k]->FName . " " . $userName[$k]->LName;
                    $sales[$x][2] = $roles[$k]->title;
                    $sales[$x][3] = 1;
                    
                } else {

                    $name = $userName[$k]->FName . " " . $userName[$k]->LName;
                    for ($y = 0; $y < count($sales); $y++) {
                        if ($sales[$y][1] == $name) {
                            $sales[$y][3]++;
                        } else {
                            if($y==0){
                                $y++;
                            }
                            $sales[$y][0] = $userName[$k]->FName[0] . $userName[$k]->LName[0];
                            $sales[$y][1] = $userName[$k]->FName . " " . $userName[$k]->LName;
                            $sales[$y][2] = $roles[$k]->title;
                            $sales[$y][3] = 1;
                            
                        }
                    }
                }
            }            
        }
       
        return $sales;
       
    }

    public function getAllJobs()
    {
        $company_id = logged('company_id');
        $this->db->select('jobs.*, job_payments.amount');
        $this->db->from('jobs');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id');
        $this->db->where('jobs.company_id', $company_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllSales()
    {
        $query = $this->db->get_where('invoices', array('company_id' => logged('company_id'), 'status' => 'Paid'));

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllPInvoices()
    {
        $query = $this->db->get('accounting_receive_payment_invoices');

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllsubs()
    {
        $this->db->select('SUM(acs_billing.mmr) AS TOTAL_MMR');
        $this->db->from('acs_billing');
        $this->db->join('acs_alarm', 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
        // $this->db->where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "IN-HOUSE"');
        // $this->db->or_where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "PURCHASE"');
        // $this->db->where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_profile.status = "Installed"');
        $this->db->where('acs_profile.status', "Installed");

        $query = $this->db->get();
        return $query->row();
        // SELECT SUM(acs_billing.mmr) TOTAL_MMR FROM acs_billing JOIN acs_alarm ON acs_billing.fk_prof_id = acs_alarm.fk_prof_id WHERE MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "PURCHASE" OR MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "IN-HOUSE";
    }
    public function getAllJobsByCompanyId($company_id)
    {
        $query = $this->db->get_where('jobs', array('company_id' => $company_id));

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getEvent($event_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $event_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getEventByGoogleEventId($google_event_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('gevent_id', $google_event_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAllEventsWithAddress()
    {

        $this->db->select('events.id, company_id, customer_id, employee_id, workorder_id, description, event_description, event_address, event_zip_code, event_state, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        $this->db->where('events.event_address !=', '');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllCompanyEventsWithAddress($company_id)
    {

        $this->db->select('events.id, events.company_id, events.event_number, customer_id, employee_id, event_type, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, events.status, LName,FName, acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'right');

        $this->db->where('events.event_address !=', '');
        $this->db->where('events.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllUserEventsWithAddress($employee_id, $date_range = array(), $filter = array())
    {

        $this->db->select('events.id, events.event_number, events.company_id, customer_id, employee_id, event_address, event_state, event_zip_code, event_type, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, events.status, LName,FName, acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'right');

        $this->db->where('events.event_address !=', '');
        if (!empty($date_range)) {
            $start_date = $date_range['date_from'];
            $end_date   = $date_range['date_to'];
            $this->db->where('start_date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
        }

        if (!empty($filter)) {
            foreach ($filter as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        $this->db->where('events.employee_id', $employee_id);

        $query = $this->db->get();
        return $query->result();
    }
}
