
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyApiConnector_model extends MY_Model
{
    public $table = 'company_api_connectors';

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);        

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('vn_from_number', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

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

    public function getByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyIdAndApiName($company_id, $api_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('api_name', $api_name);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllEnabledByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('status', 1);
        
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file CompanyApiConnector_model.php */
/* Location: ./application/models/CompanyApiConnector_model.php */
