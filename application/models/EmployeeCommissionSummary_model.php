<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeCommissionSummary_model extends MY_Model
{
    public $table = 'employee_commission_summary';

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

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByEmployeeIdAndCompanyId($employee_id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employee_id', $employee_id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }    

    public function getByEmployeeIdAndCompanyIdByDate($employee_id, $company_id, $filterDates = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employee_id', $employee_id);
        $this->db->where('company_id', $company_id);

        $start_date = date('Y-m-d 00:00:00', strtotime($filterDates['start']));
        $end_date = date('Y-m-d 00:00:00', strtotime($filterDates['end']));

        if($filterDates) {
            $this->db->where('DATE(date_created) >=', $start_date);
		    $this->db->where('DATE(date_created) <=', $end_date);
        }
        
        $query = $this->db->get();
        return $query->result();
    } 

    public function deleteById($user_id)
    {        
        $this->db->where('id', $user_id);
        $this->db->delete($this->table);;
    }

}

/* End of file EmployeePayscaleSetting.php */
/* Location: ./application/models/EmployeePayscaleSetting.php */
