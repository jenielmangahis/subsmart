<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ServiceCategory_model extends MY_Model
{
    public $table = 'service_category';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('service_name', $filters['search'], 'both');
            }
        }

       $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteCategory($id){
        $this->db->delete($this->table, array('id' => $id));
    }  

    public function getAllCategoriesByCompanyID($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteCategoryByCompanyID($id){
        $this->db->delete($this->table, array('company_id' => $id));
    }  

}

/* End of file ServiceCategory_model.php */
/* Location: ./application/models/ServiceCategory_model.php */
