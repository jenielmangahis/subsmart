<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventTags_model extends MY_Model
{
    public $table = 'event_tags';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('event_tags.*,business_profile.business_name');
        $this->db->from($this->table);
        $this->db->join('business_profile', 'event_tags.company_id = business_profile.company_id', 'LEFT'); 

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if ( !empty($filters) ) {
            if ( $filters['search'] != '' ) {
                $this->db->like('name', $filters['search'], 'both');                
            }
        }

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

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file EventType_model.php */
/* Location: ./application/models/EventTags_model.php */
