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
    }
    public function update_place($update, $place_id)
    {
        $this->db->where("id", $place_id);
        $this->db->update("trac360_places", $update);
    }
}
