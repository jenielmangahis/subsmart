<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerMessages_model extends MY_Model
{

    public $table = 'customer_messages';
    public $status_new = 'New';
    public $status_read = 'Read';

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('customer_messages.*, acs_profile.company_id');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_messages.prof_id  = acs_profile.prof_id');                
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByProfId($prof_id)
    {        
        $this->db->select('customer_messages.*, acs_profile.company_id');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_messages.prof_id  = acs_profile.prof_id');   
        $this->db->where('customer_messages.prof_id', $prof_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByProfIdAndCompanyId($prof_id, $company_id)
    {        
        $this->db->select('customer_messages.*, acs_profile.company_id, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_messages.prof_id  = acs_profile.prof_id');   
        $this->db->where('customer_messages.prof_id', $prof_id);
        $this->db->where('acs_profile.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function statusRead(){
        return $this->status_read;
    }

    public function statusNew(){
        return $this->status_new;
    }
}

/* End of file CustomerMessages_model.php */
/* Location: ./application/models/CustomerMessages_model.php */
