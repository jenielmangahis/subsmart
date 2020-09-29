<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Offers_model extends MY_Model
{
    public $table = 'offers';
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

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateOffers($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function deleteOffers($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file Offers_model.php */
/* Location: ./application/models/Offers_model.php */
