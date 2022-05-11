<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventType_model extends MY_Model
{
    public $table = 'event_types';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('event_types.*, users.id AS uid, users.company_id, business_profile.business_name');
        $this->db->from($this->table);
        $this->db->join('users', 'event_types.user_id = users.id', 'INNER'); 
        $this->db->join('business_profile', 'event_types.company_id = business_profile.company_id', 'LEFT'); 

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {

        $this->db->select('event_types.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'event_types.user_id = users.id', 'INNER'); 
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('event_types.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'event_types.user_id = users.id', 'INNER'); 

        $this->db->where('event_types.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateEventTypeById($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function deleteEvent($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file EventType_model.php */
/* Location: ./application/models/EventType_model.php */
