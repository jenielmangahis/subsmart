<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PointRatingSystem_model extends MY_Model {

    public function addPointRating($comp_id, $employee_type, $employee_ids, $module, $jobs_id, $point) {
        $filtered_employee_ids = array_filter($employee_ids);
        $unique_employee_ids = array_unique($filtered_employee_ids);
        $total_employees = count($unique_employee_ids);
        $points_per_employee = $total_employees > 0 ? $point / $total_employees : 0;

        $insert_data = [
            'company_id'    => $comp_id,
            'employee_type' => $employee_type,
            'employee_id'   => json_encode($unique_employee_ids), 
            'module'        => $module,
            'module_id'     => $jobs_id,
            'points'        => number_format($points_per_employee, 2),
            'status'        => 1,
        ];

        return $this->db->insert('point_rating_system', $insert_data);
    }

    public function updatePointRating($comp_id, $employee_type, $employee_ids, $module, $jobs_id, $point) {
        $filtered_employee_ids = array_filter($employee_ids); 
        $unique_employee_ids = array_unique($filtered_employee_ids);
        $unique_employee_ids = array_values($unique_employee_ids);
        $total_employees = count($unique_employee_ids);
        $points_per_employee = $total_employees > 0 ? $point / $total_employees : 0;
    
        $data = [
            'company_id'    => $comp_id,
            'employee_type' => $employee_type,
            'employee_id'   => json_encode($unique_employee_ids),
            'module'        => $module,
            'module_id'     => $jobs_id,
            'points'        => number_format($points_per_employee, 2),
            'status'        => 1,
        ];
    
        $this->db->where('module', $module);
        $this->db->where('module_id', $jobs_id);
        $query = $this->db->get('point_rating_system');
    
        if ($query->num_rows() > 0) {
            $this->db->where('module', $module);
            $this->db->where('module_id', $jobs_id);
            return $this->db->update('point_rating_system', $data);
        } else {
            return $this->db->insert('point_rating_system', $data);
        }
    }

    public function deletePointRating($cid, $job_id, $module) {
        $this->db->where('module', $module);
        $this->db->where('company_id', $cid);
        $this->db->where('module_id', $job_id);
        return $this->db->update('point_rating_system', ['status' => 0]);
    }
}
