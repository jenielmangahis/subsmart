<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LeadSource_model extends MY_Model
{
    public $table = 'ac_leadsource';

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('ls_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('fk_company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('ls_id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function createLeadSource($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('ls_id' => $id));
    } 

}
/* End of file LeadSource_model.php */
/* Location: ./application/models/LeadSource_model.php */

