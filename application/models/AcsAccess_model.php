<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsAccess_model extends MY_Model
{

    public $table = 'acs_access';
    

    public function getByUsernamePassword($username, $password)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('access_login', $username); 
        $this->db->where('access_password', $password); 

        $query = $this->db->get();
        return $query->row();
    }

    public function getByProfId($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('fk_prof_id', $prof_id); 

        $query = $this->db->get();
        return $query->row();
    }

    public function updateByProfId($prof_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('fk_prof_id', $prof_id);
        $this->db->update();
    }
}

/* End of file AcsAccess_model.php */
/* Location: ./application/models/AcsAccess_model.php */
