<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NsmartPlanModules_model extends MY_Model
{
    public $table = 'nsmart_plans_has_modules';
    public $status_active   = 1;
    public $status_inactive = 0;
    public $discount_percent = 1;
    public $discount_amount   = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
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

    public function getByPlanId($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('nsmart_plans_id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByFeatureId($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('nsmart_feature_id', $id);

        $query = $this->db->get();
        return $query->result();        
    }

    public function getAllByPlanHeadingId($id)
    {
        $user_id = logged('id');

        $this->db->select('nsmart_plans_has_modules.*,p.plan_name,f.feature_name');
        $this->db->from('nsmart_plans_has_modules');
        $this->db->join('nsmart_plans as p', 'nsmart_plans_has_modules.nsmart_plans_id = p.nsmart_plans_id', 'LEFT');
        $this->db->join('nsmart_features as f', 'nsmart_plans_has_modules.nsmart_feature_id = f.id', 'LEFT');
        $this->db->where('nsmart_plans_has_modules.plan_heading_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();

        return  $last_id;
    }

    public function updatePlanModules($plan_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $plan_id);
        $this->db->update();
    }

     public function deletePlanModules($id){
        
        $this->db->delete($this->table, array('nsmart_feature_id' => $id));
    } 
}

/* End of file NsmartPlanModules_model.php */
/* Location: ./application/models/NsmartPlanModules_model.php */
