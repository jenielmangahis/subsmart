<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DealsBookings_model extends MY_Model
{
    public $table = 'deals_bookings';

    public function getAll($filters=array())
    {
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

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('deals_bookings.*, deals_steals.id AS duid, deals_steals.title, deals_steals.deal_price');
        $this->db->from($this->table);
        $this->db->join('deals_steals', 'deals_bookings.deals_id = deals_steals.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('deals_bookings.company_id', $company_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }  

    public function getAllByDealsId($deals_id, $filters=array(), $conditions=array())
    {

        $this->db->select('deals_bookings.*, deals_steals.id AS duid, deals_steals.title, deals_steals.deal_price');
        $this->db->from($this->table);
        $this->db->join('deals_steals', 'deals_bookings.deals_id = deals_steals.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $key => $value ){
                $this->db->where($value['field'], $value['value']);                
            }
        }

        $this->db->where('deals_bookings.deals_id', $deals_id);

        $query = $this->db->get();
        return $query->result();
    }  

    public function getById($id)
    {
        $this->db->select('deals_bookings.*, deals_steals.id AS duid, deals_steals.title, deals_steals.deal_price');
        $this->db->from($this->table);
        $this->db->join('deals_steals', 'deals_bookings.deals_id = deals_steals.id', 'LEFT');

        $this->db->where('deals_bookings.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file DealsBookings_model.php */
/* Location: ./application/models/DealsBookings_model.php */
