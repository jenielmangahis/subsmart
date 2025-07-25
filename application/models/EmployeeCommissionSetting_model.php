<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeCommissionSetting_model extends MY_Model
{
    public $table = 'employee_commission_settings';

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
        // $this->db->select('employee_commission_settings.*, commission_settings.name');
        // $this->db->from($this->table);
        // $this->db->join('commission_settings', 'employee_commission_settings.commission_setting_id  = commission_settings.id', 'left');
        // $this->db->where('employee_commission_settings.user_id', $user_id);
        // $this->db->order_by('employee_commission_settings.id', 'DESC');

        // $query = $this->db->get();
        // return $query->result();
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

/* End of file EmployeeCommissionSetting_model.php */
/* Location: ./application/models/EmployeeCommissionSetting_model.php */
