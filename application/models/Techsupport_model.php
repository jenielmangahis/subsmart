<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Techsupport_model extends MY_Model
{
    protected $table = 'techsupport_schedule';

    public function addSchedule($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function updateSchedule($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function deleteSchedule($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function getSchedule($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    public function getAllSchedules($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->get($this->table)->result();
    }
}