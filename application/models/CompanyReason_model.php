<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyReason_model extends MY_Model
{

    public $table = 'company_reasons';

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllDefaultAndByCompanyId($company_id, $filters = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->group_start();
        $this->db->where('company_id', 0);
        $this->db->or_where('company_id', $company_id);
        $this->db->group_end();

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

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file CompanyReason_model.php */
/* Location: ./application/models/CompanyReason_model.php */
