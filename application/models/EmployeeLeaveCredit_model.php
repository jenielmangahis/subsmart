<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeLeaveCredit_model extends MY_Model
{
    public $table = 'employee_leave_credits';

    public function getById($id)
    {
        $this->db->select('employee_leave_credits.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'employee_leave_credits.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'employee_leave_credits.pto_id = timesheet_pto.id', 'left');
        $this->db->where('employee_leave_credits.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $cid)
    {
        $this->db->select('employee_leave_credits.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'employee_leave_credits.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'employee_leave_credits.pto_id = timesheet_pto.id', 'left');
        $this->db->where('employee_leave_credits.id', $id);
        $this->db->where('employee_leave_credits.company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByUserIdAndPtoId($uid, $ptoid)
    {
        $this->db->select('employee_leave_credits.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'employee_leave_credits.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'employee_leave_credits.pto_id = timesheet_pto.id', 'left');
        $this->db->where('employee_leave_credits.user_id', $uid);
        $this->db->where('employee_leave_credits.pto_id', $ptoid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAll()
    {
        $this->db->select('employee_leave_credits.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'employee_leave_credits.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'employee_leave_credits.pto_id = timesheet_pto.id', 'left');
        $this->db->where('users.company_id', $cid);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($cid, $conditions = [])
    {
        $this->db->select('employee_leave_credits.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'employee_leave_credits.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'employee_leave_credits.pto_id = timesheet_pto.id', 'left');
        $this->db->where('users.company_id', $cid);

        if( !empty($conditions) ){
            $this->db->group_start();            
            foreach( $conditions as $c ){
                $this->db->or_like($c['field'], $c['value']);    
            }
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->result();
    }   
    
    public function getAllByUserId($uid, $conditions = [])
    {
        $this->db->select('employee_leave_credits.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'employee_leave_credits.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'employee_leave_credits.pto_id = timesheet_pto.id', 'left');
        $this->db->where('employee_leave_credits.user_id', $uid);

        if( !empty($conditions) ){
            $this->db->group_start();            
            foreach( $conditions as $c ){
                $this->db->or_like($c['field'], $c['value']);    
            }
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->result();
    }   
}

/* End of file EmployeeLeaveCredit_model.php */
/* Location: ./application/models/EmployeeLeaveCredit_model.php */
