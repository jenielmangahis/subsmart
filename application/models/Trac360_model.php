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
        $query = $this->db->query("SELECT trac360_people.*, users.profile_img FROM trac360_people JOIN users ON trac360_people.user_id = users.id WHERE trac360_people.company_id = " . $company_id);
        return $query->result();
    }
    public function get_last_location_from_timesheet_logs($user_id)
    {
        $this->db->order_by('date_created', 'DESC')->limit(1);
        return $this->db->get_where('timesheet_logs', array('user_id' => $user_id))->row();
    }
    public function get_places($company_id)
    {
        $query = $this->db->query("SELECT *FROM trac360_places WHERE company_id = " . $company_id);
        return $query->result();
    }
}
