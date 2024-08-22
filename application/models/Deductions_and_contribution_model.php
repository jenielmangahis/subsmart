<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deductions_and_contribution_model extends MY_Model
{
    public $table = 'accounting_deductions_and_contributions';


    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getByUser($id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employee_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function updateDeductions($id, $data)
    {
        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

   

}
  
