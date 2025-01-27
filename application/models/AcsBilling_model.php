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

    public function saveData($data)
    {
        $this->db->insert($this->table, $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function updateRecord($bill_id, $data)
    {
        $this->db->where('bill_id', $bill_id);
        $this->db->from($this->table);
        $cust = $this->db->update($this->table, $data);

        return $cust;
    }

    public function getByProfId($prof_id, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('fk_prof_id', $prof_id);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                $this->db->where($c['field'], $c['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }
}
?>