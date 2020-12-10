<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ColorSettings_model extends MY_Model
{
    public $table = 'nsmart_plans';
    public $status_active   = 1;
    public $status_inactive = 0;
    public $discount_percent = 1;
    public $discount_amount   = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('nsmart_plans_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->where('user_id', $user_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('nsmart_plans_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file ColorSettings_model.php */
/* Location: ./application/models/ColorSettings_model.php */
