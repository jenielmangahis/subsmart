<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Furnisher_model extends MY_Model
{

    public $table = 'furnishers';

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);

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
                $this->db->group_start();
                $this->db->like('reason', $filters['search'], 'both');                
                $this->db->group_end();
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->where('id', $id); 

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->where('id', $id); 
        $this->db->where('company_id', $company_id); 

        $query = $this->db->get();
        return $query->row();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file Furnisher_model.php */
/* Location: ./application/models/Furnisher_model.php */
