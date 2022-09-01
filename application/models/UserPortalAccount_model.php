<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserPortalAccount_model extends MY_Model
{    
    public $table = 'user_portal_accounts';


    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters['search']) ){
            foreach($filters['search'] as $f){
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
        }

        $this->db->order_by('id', 'DESC');

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

    public function getByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file UserPortalAccount_model.php */
/* Location: ./application/models/UserPortalAccount_model.php */
