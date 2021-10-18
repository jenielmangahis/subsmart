<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment_model extends MY_Model
{

    public $table = 'appointments';

    public $type_none = 'none';
    public $type_request = 'request';
    public $type_transient = 'transient';
    public $type_new = 'new';
    public $type_new_request = 'new_request';

    public function getAllByCompany($company_id)
    {
        $where = array(
            'appointments.company_id'    => $company_id
          );

        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(users.FName, " ", users.LName)AS employee_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdAndCompanyId($id, $company_id)
    {
        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(users.FName, " ", users.LName)AS employee_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     

        $this->db->where('appointments.id', $id);
        $this->db->where('appointments.company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function optionAppointmentType(){
        $options = [
            $this->type_none => 'None',
            $this->type_request => 'Request',
            $this->type_transient => 'Transient',
            $this->type_new => 'New',
            $this->type_new_request => 'New Request'
        ];

        return $options;
    }
}

/* End of file Appointment_model.php */
/* Location: ./application/models/Appointment_model.php */
