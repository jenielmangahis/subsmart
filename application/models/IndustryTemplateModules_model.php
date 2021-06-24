<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndustryTemplateModules_model extends MY_Model
{
    public $table = 'industry_template_modules';
    public $status_active   = 1;
    public $status_inactive = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByTemplateId($template_id)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('industry_template_id', $template_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllActive($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->where('status', 1);

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

  
    public function updateIndustryTemplateModules($industryTemplateModules_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $industryTemplateModules_id);
        $this->db->update();
    }

    public function deleteIndustryTemplateModules($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function deleteIndustryTemplateModulesByTemplateId($template_id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('industry_template_id' => $template_id));
    } 

    public function isActive()
    {
        return $this->status_active;
    }

    public function isInactive()
    {
        return $this->status_inactive;
    }

    public function getAllByIndustryTemplateId( $id )
    {
        $this->db->select('industry_template_modules.*,industry_modules.name AS industry_module_name,industry_modules.description AS industry_module_description');
        $this->db->from($this->table);
        $this->db->join('industry_modules', 'industry_template_modules.industry_module_id = industry_modules.id', 'left');
        $this->db->where('industry_template_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function batchInsert( $data )
    {
        $this->db->insert_batch($this->table, $data); 
    }
}

/* End of file IndustryTemplateModules_model.php */
/* Location: ./application/models/IndustryTemplateModules_model.php */
