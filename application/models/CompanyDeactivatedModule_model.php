<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyDeactivatedModule_model extends MY_Model
{
    public $table = 'company_deactivated_modules';


    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array(), $conditions=array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        
        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('card_owner_name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->where('company_id', $company_id);

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

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();

        return  $last_id;
    }

    public function getByCompanyIdAndIndustryModuleId($company_id, $industry_module_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('industry_module_id', $industry_module_id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file CompanyDeactivatedModule_model.php */
/* Location: ./application/models/CompanyDeactivatedModule_model.php */
