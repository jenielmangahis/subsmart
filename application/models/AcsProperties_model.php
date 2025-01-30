<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsProperties_model extends MY_Model
{
    public $table = 'acs_properties';

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

    public function getById($id, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                $this->db->where($c['field'], $c['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getByCustomerId($customer_id, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);

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