<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerInternalNotes_model extends MY_Model
{

    public $table = 'customer_internal_notes';

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('customer_internal_notes.*, CONCAT(users.FName, " ", users.LNAme) AS user_name, acs_profile.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'customer_internal_notes.user_id  = users.id');
        $this->db->join('acs_profile', 'customer_internal_notes.prof_id  = acs_profile.prof_id');                
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByProfId($prof_id)
    {        
        $this->db->select('customer_internal_notes.*, CONCAT(users.FName, " ", users.LNAme) AS user_name');
        $this->db->from($this->table);
        $this->db->join('users', 'customer_internal_notes.user_id  = users.id');        
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file CustomerInternalNotes_model.php */
/* Location: ./application/models/CustomerInternalNotes_model.php */
