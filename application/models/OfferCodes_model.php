<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OfferCodes_model extends MY_Model
{
    public $table = 'offer_codes';
    public $status_active   = 1;
    public $status_inactive = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('offer_code', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllActive($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('offer_code', $filters['search'], 'both');
            }
        }

        $this->db->where('status', 1);

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

    public function getByClientId($client_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('client_id', $client_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByOfferCodes($offer_code)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('offer_code', $offer_code);

        $query = $this->db->get()->row();
        return $query;
    }

  
    public function updateOfferCodes($offerCodes_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $offerCodes_id);
        $this->db->update();
    }

    public function deleteOfferCodes($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function isActive()
    {
        return $this->status_active;
    }

    public function isInactive()
    {
        return $this->status_inactive;
    }

    public function getAllByStatus($status_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status', $status_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file OfferCodes_model.php */
/* Location: ./application/models/OfferCodes_model.php */
