<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsBilling_model extends MY_Model
{
    public $table = 'acs_billing';

    public function getBilling($gb)
    {
        $this->db->select('fk_prof_id');
        $this->db->from($this->table);
        $this->db->group_by($gb);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAll($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        
        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    // This method needs is_checked field.
    // Only used in correcting records
    public function getAllNotChecked($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_checked', 0);

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function updateRecord($bill_id, $data)
    {
        $this->db->where('bill_id', $bill_id);
        $this->db->from($this->table);
        $cust = $this->db->update($this->table, $data);

        return $cust;
    }
}
?>