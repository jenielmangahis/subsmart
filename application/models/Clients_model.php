<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_model extends MY_Model
{
    public $table = 'clients';
   
    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('first_name', $filters['search'], 'both');
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

    
    public function deleteClient($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    
}

/* End of file NsmartPlan_model.php */
/* Location: ./application/models/NsmartPlan_model.php */
