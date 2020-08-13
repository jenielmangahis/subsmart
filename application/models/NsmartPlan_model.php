<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NsmartPlan_model extends MY_Model
{
    public $table = 'nsmart_plans';
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

        $this->db->order_by('nsmart_plans_id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('nsmart_plans_id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getPlanStatus()
    {
        $status = [
            $this->status_active => 'Active',
            $this->status_inactive => 'Inactive'
        ];

        return $status;
    }

    public function isPlanNameExists($plan_name)
    {
        $is_exists = false;

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('plan_name', $plan_name);

        $query = $this->db->get()->row();
        if( $query ){
            $is_exists = true;
        }

        return $is_exists;
    }

    public function updatePlan($plan_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('nsmart_plans_id', $plan_id);
        $this->db->update();
    }

    public function deletePlan($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('nsmart_plans_id' => $id));
    } 

    public function isActive()
    {
        return $this->status_active;
    }

    public function isInactive()
    {
        return $this->status_inactive;
    }

    public function getDiscountTypes()
    {
        $types = [
            $this->discount_percent => '% Percentage',
            $this->discount_amount  => '$ Amount'
        ];

        return $types;
    }

    public function isDiscountPercentage()
    {
        return $this->discount_percent;
    }

    public function isDiscountAmount()
    {
        return $this->discount_amount;
    }
}

/* End of file NsmartPlan_model.php */
/* Location: ./application/models/NsmartPlan_model.php */
