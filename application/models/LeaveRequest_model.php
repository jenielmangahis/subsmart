<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LeaveRequest_model extends MY_Model
{
    public $table = 'timesheet_leave';
    public $request_pending  = 1;
    public $request_approved = 2;
    public $request_disapproved = 3;

    public function getById($id)
    {
        $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');
        $this->db->where('timesheet_leave.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $cid)
    {
        $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');
        $this->db->where('timesheet_leave.id', $id);
        $this->db->where('users.company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAll()
    {
        $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');        
        $this->db->where('users.company_id', $cid);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($cid, $conditions = [])
    {
        $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');        
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
        $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');        
        $this->db->where('users.id', $uid);

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

    public function getAllLeaveByUserIdAndDate($uid, $date)
    {
        $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');        
        $this->db->where('users.id', $uid);
        $this->db->where('timesheet_leave.date_from <=', $date);
        $this->db->where('timesheet_leave.date_to >=', $date);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllLeaveByCompanyIdAndDate($cid, $date)
    {
        $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee,timesheet_pto.name AS leave_type');
        $this->db->from($this->table);
        $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
        $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');        
        $this->db->where('users.company_id', $cid);
        $this->db->where('timesheet_leave.date_from <=', $date);
        $this->db->where('timesheet_leave.date_to >=', $date);

        $query = $this->db->get();
        return $query->result();
    }

    public function bulkUpdate($ids = [], $data = [], $filters = [])
    {
        $this->db->where_in('id', $ids);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function bulkDelete($ids = [], $filters = [])
    {
        if( count($ids) > 0 ){
            $this->db->where_in('id', $ids);

            if( $filters ){
                foreach( $filters as $filter ){
                    $this->db->where($filter['field'], $filter['value']);
                }
            }

            $this->db->delete($this->table);
        }        

        return $this->db->affected_rows();
    }

    public function deleteAllArchived($filters = [])
    {
        $this->db->join('users', 'timesheet_overtime_requests.user_id = users.id', 'left');
        $this->db->where('is_archived', 1);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function requestStatusPending()
    {
        return $this->request_pending;
    }

    public function requestStatusApproved()
    {
        return $this->request_approved;
    }

    public function requestStatusDisApproved()
    {
        return $this->request_disapproved;
    }

    public function optionStatus()
    {
        $options = [
            $this->request_approved => 'Approve',
            $this->request_disapproved => 'Disapprove'
        ];

        return $options;
    }
}

/* End of file LeaveRequest_model.php */
/* Location: ./application/models/LeaveRequest_model.php */
