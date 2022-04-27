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

    public function admin_get_all_events($limit = 0)
    {
        $this->db->from($this->table);
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img,clients.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('clients', 'clients.id = events.company_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->order_by('id', "DESC");
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
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
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
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email');
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
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->join('acs_profile', 'acs_profile.prof_id = `events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->from($this->table);
        //$this->db->join('user_events', 'user_events.event_id = events.id');

        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($start_date . ' +5 day'));

        $this->db->where('events.company_id', $company_id);
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

    public function getAllInvoices()
    {
        $query = $this->db->get('invoices');

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getAllPayment()
    {
        $query = $this->db->get('accounting_receive_payment');

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getAllJobs(){
        $query = $this->db->get('jobs');

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
        $query = $this->db->get('acs_transaction_history');

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getAllJobsByCompanyId($company_id)
    {
        $query = $this->db->get_where('job_status', array('comp_id' => $company_id));

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
