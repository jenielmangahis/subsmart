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
}

/* End of file AcsAccess_model.php */
/* Location: ./application/models/AcsAccess_model.php */
