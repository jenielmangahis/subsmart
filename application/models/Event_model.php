<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends MY_Model
{

    public $table = 'events';

    public function getAllByCompany($comp_id, $user_id=0)
    {

        $this->db->select('events.id, company_id, customer_id, workorder_id, description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        if ($user_id) {
            $this->db->join('user_events', 'user_events.event_id = events.id');
            $this->db->where('user_events.user_id', $user_id);
        }

        $this->db->where('company_id', $comp_id);

        $query = $this->db->get();
        return $query->result();
    }


    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0)
    {

        $user_id = getLoggedUserID();

        $this->db->select('events.id, company_id, customer_id, workorder_id, description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
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

    

    public function getEvent($event_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $event_id);

        $query = $this->db->get();
        return $query->row();
    }
}
