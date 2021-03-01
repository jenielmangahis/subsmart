<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends MY_Model
{

    public $table = 'events';

    public function getAllByCompany($company_id, $user_id=0)
    {

        $this->db->select('events.id, company_id, customer_id, employee_id, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        if ($user_id) {
            $this->db->join('user_events', 'user_events.event_id = events.id');
            $this->db->where('user_events.user_id', $user_id);
        }

        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllEvents()
    {

        $this->db->select('events.id, company_id, customer_id, employee_id, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        if ($user_id) {
            $this->db->join('user_events', 'user_events.event_id = events.id');
            $this->db->where('user_events.user_id', $user_id);
        }

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

        if ( $query ) {
            return $query->result();
        }

        return false;
    }

    public function getAllUpComingEvents($user_id = 0)
    {
        $this->db->select('
                events.id, company_id, customer_id, employee_id, 
                workorder_id, description, event_description, 
                start_date, start_time, end_date, end_time, event_color,what_of_even,
                event_address, event_state, notify_at, instructions, is_recurring, status'
            );

        $this->db->from($this->table);
        $this->db->join('user_events', 'user_events.event_id = events.id');

        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($start_date . ' +5 day'));

        $this->db->where('start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');

        $this->db->order_by('id', 'DESC');

        $query = $this->db->limit(5);
        $query = $this->db->get();

        if ( $query ) {
            return $query->result();
        }
    }

    public function getAllUpComingEventsByCompanyId($company_id = 0)
    {
        $this->db->select('
                events.id, company_id, customer_id, employee_id, 
                workorder_id, description, event_description, 
                start_date, start_time, end_date, end_time, event_color,what_of_even, 
                event_address, event_state, notify_at, instructions, is_recurring, status'
            );

        $this->db->from($this->table);
        $this->db->join('user_events', 'user_events.event_id = events.id');

        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($start_date . ' +5 day'));

        $this->db->where('company_id', $company_id);
        $this->db->where('start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');

        $this->db->order_by('id', 'DESC');

        $query = $this->db->limit(5);
        $query = $this->db->get();

        if ( $query ) {
            return $query->result();
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

        $this->db->select('events.id, events.event_type_id, company_id, customer_id, employee_id, workorder_id, description, event_description, event_address, event_zip_code, event_state, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        $this->db->where('events.event_address !=', '');
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllUserEventsWithAddress($employee_id)
    {

        $this->db->select('events.id, events.event_type_id, company_id, customer_id, employee_id, workorder_id, description, event_description, event_address, event_zip_code, event_state, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        $this->db->where('events.event_address !=', '');
        $this->db->where('employee_id', $employee_id);

        $query = $this->db->get();
        return $query->result();
    }
}
