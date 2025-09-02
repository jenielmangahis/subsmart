<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_user_employment_details_model extends MY_Model {

	public $table = 'accounting_user_employment_details';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function get_employment_details_by_worksite($worksiteId)
    {
        //$this->db->where('work_location_id', $worksiteId);
        $this->db->like('work_location_id', $worksiteId);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_employment_details($userId)
    {
        $this->db->select('accounting_user_employment_details.*,accounting_worksites.name AS worksite_name, accounting_worksites.street AS worksite_address, accounting_worksites.city AS worksite_city, accounting_worksites.state AS worksite_state, accounting_worksites.zip_code AS worksite_zipcode');
        $this->db->from($this->table);
        $this->db->join('accounting_worksites', 'accounting_user_employment_details.work_location_id = accounting_worksites.id', 'left');
        $this->db->where('accounting_user_employment_details.user_id', $userId);

        $query = $this->db->get();
        return $query->row();
    }

    public function update_employment_details($userId, $data)
    {
        if(isset($data['work_location_id']) && is_array($data['work_location_id'])) {
            $converted_data['workers_comp_class'] = $data['workers_comp_class'];
            $work_location_ids = implode(',', $data['work_location_id']); 
            $converted_data['work_location_id'] = $work_location_ids;

            $this->db->where('user_id', $userId);
            $update = $this->db->update($this->table, $converted_data);
            return $update;
        } else {
            $this->db->where('user_id', $userId);
            $update = $this->db->update($this->table, $data);
            return $update;
        }
    }

    public function get_all_employment_details($userId)
    {
        $this->db->select('accounting_user_employment_details.*,accounting_worksites.name AS worksite_name, accounting_worksites.street AS worksite_address, accounting_worksites.city AS worksite_city, accounting_worksites.state AS worksite_state, accounting_worksites.zip_code AS worksite_zipcode');
        $this->db->from($this->table);
        $this->db->join('accounting_worksites', 'accounting_user_employment_details.work_location_id = accounting_worksites.id', 'left');
        $this->db->where('accounting_user_employment_details.user_id', $userId);

        $query = $this->db->get();
        return $query->result();
    }

    public function saveEmployeeData($data, $category)
    {
        $company_id = logged('company_id');
        
        switch ($category) {
            case 'personal_information':
                $this->db->where('id', $data['id']);
                $this->db->where('company_id', $company_id );
                $query = $this->db->update('users', $data);
                return $query;
                break;
            case 'tax_withholding':
                $this->db->select('id');
                $this->db->from('accounting_tax_withholding');
                $this->db->where('employee_id', $data['employee_id']);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $this->db->where('employee_id', $data['employee_id']);
                    $this->db->where('company_id', $company_id);
                    $query = $this->db->update('accounting_tax_withholding', $data);
                    return $query;
                } else {
                    $data['company_id'] = $company_id;
                    $query = $this->db->insert('accounting_tax_withholding', $data);
                    return $query;
                }
                break;
            case 'employee_notes':
                $this->db->select('id');
                $this->db->from('employee_pay_details');
                $this->db->where('user_id', $data['user_id']);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $this->db->where('user_id', $data['user_id']);
                    $this->db->where('company_id', $company_id);
                    $query = $this->db->update('employee_pay_details', $data);
                    return $query;
                } else {
                    $data['company_id'] = $company_id;
                    $query = $this->db->insert('employee_pay_details', $data);
                    return $query;
                }
                break;
        }
    }

    public function optionEmploymentStatus()
    {
        $options = [ 
            'Full-Time' => 'Full-Time',
            'Part-Time' => 'Part-Time',
            'On-call' => 'On-call',
            'Contractual Employee' => 'Contractual Employee',
            'Seasonal Employee' => 'Seasonal Employee',
            'Leased Employee' => 'Leased Employee'
        ];

        return $options;
    }
    
}