<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomField_model extends MY_Model
{

    public $table = 'custom_fields';

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($company_id, $options = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }    
}

/* End of file CustomField_model.php */
/* Location: ./application/models/CustomField_model.php */