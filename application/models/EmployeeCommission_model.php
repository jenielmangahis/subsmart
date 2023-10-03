<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeCommission_model extends MY_Model
{
    public $table = 'employee_commissions';

    public function getAll($filters=array())
    {
        $id = logged('id');
        $this->db->select('*');        
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByUserIdAndCommissionSettingIdAndObjectIdAndObjectType($user_id, $employee_commission_setting_id, $object_id, $object_type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        $this->db->where('employee_commission_setting_id', $employee_commission_setting_id);
        $this->db->where('object_id', $object_id);
        $this->db->where('object_type', $object_type);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function deleteAllByUserId($user_id)
    {        
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->table);;
    }
}

/* End of file EmployeeCommission_model.php */
/* Location: ./application/models/EmployeeCommission_model.php */
