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

        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(users.FName, " ", users.LName)AS employee_name, appointment_types.name AS appointment_type');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotWaitListByCompany($company_id)
    {
        $where = array(
            'appointments.company_id'    => $company_id,
            'is_wait_list' => 0
          );

        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(ac_leads.firstname, " ",ac_leads.lastname)AS lead_name, CONCAT(users.FName, " ", users.LName)AS employee_name, appointment_types.name AS appointment_type,acs_profile.mail_add,acs_profile.city AS cust_city, acs_profile.state AS cust_state,acs_profile.zip_code AS cust_zip_code');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('ac_leads', 'appointments.lead_id = ac_leads.leads_id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdAndCompanyId($id, $company_id)
    {
        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(ac_leads.firstname, " ",ac_leads.lastname)AS lead_name, CONCAT(users.FName, " ", users.LName)AS employee_name, acs_profile.mail_add,acs_profile.city AS cust_city, acs_profile.state AS cust_state,acs_profile.zip_code AS cust_zip_code, acs_profile.phone_m AS cust_phone, appointment_types.name AS appointment_type, ac_leads.address AS lead_address, ac_leads.city AS lead_city, ac_leads.state AS lead_state, ac_leads.zip AS lead_zip, ac_leads.phone_cell AS lead_contact_number, ac_leads.firstname AS lead_first_name, ac_leads.lastname AS lead_last_name, ac_leads.email_add as lead_contact_email');
        $this->db->from($this->table);
        $this->db->join('ac_leads', 'appointments.lead_id = ac_leads.leads_id','left');     
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->where('appointments.id', $id);
        $this->db->where('appointments.company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getById($id)
    {
        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(users.FName, " ", users.LName)AS employee_name, acs_profile.mail_add,acs_profile.city AS cust_city, acs_profile.state AS cust_state,acs_profile.zip_code AS cust_zip_code, acs_profile.phone_m AS cust_phone, appointment_types.name AS appointment_type');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->where('appointments.id', $id);

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

    public function isCashPayment(){
        return 'cash';
    }

    public function isPaid(){
        return 1;
    }

    public function isConvergePayment(){
        return 'converge';
    }

    public function getAllCompanyWaitList($company_id)
    {
        $where = array(
            'appointments.company_id'    => $company_id,
            'is_wait_list' => 1
          );

        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(users.FName, " ", users.LName)AS employee_name, appointment_types.name AS appointment_type');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function createAppointment($post_data)
    {
        $this->db->insert($this->table, $post_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function generateAppointmentNumber( $id, $service_type )
    {
        /*if( $service_type != '' ){
            //$appointment_number = strtoupper($service_type) . '-' . str_pad($id, 3,"0",STR_PAD_LEFT);
            $appointment_number = strtoupper($service_type) . '-' . $id;
        }else{
            //$appointment_number = 'APPT-' . str_pad($id, 3,"0",STR_PAD_LEFT);
            $appointment_number = 'APPT-' . $id;
        }*/
        $appointment_number = 'APPT-' . $id;
        
        return $appointment_number; 
    }

    public function getAll()
    {        
        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(users.FName, " ", users.LName)AS employee_name, appointment_types.name AS appointment_type');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');          
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllUpcomingAppointmentsByCompany($company_id)
    {
        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +7 day'));

        $where = array(
            'appointments.company_id'    => $company_id,
            'appointments.appointment_date >=' => $start_date,
            'appointments.is_wait_list' => 0         
          );

        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(ac_leads.firstname, " ",ac_leads.lastname)AS lead_name, CONCAT(users.FName, " ", users.LName)AS employee_name, acs_profile.mail_add,acs_profile.city AS cust_city, acs_profile.state AS cust_state,acs_profile.zip_code AS cust_zip_code, acs_profile.phone_m AS cust_phone, appointment_types.name AS appointment_type, ac_leads.address AS lead_address, ac_leads.city AS lead_city, ac_leads.state AS lead_state, ac_leads.zip AS lead_zip, ac_leads.phone_cell AS lead_contact_number, ac_leads.firstname AS lead_first_name, ac_leads.lastname AS lead_last_name, ac_leads.email_add as lead_contact_email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('ac_leads', 'appointments.lead_id = ac_leads.leads_id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllAppointmentsByCompanyAndDate($company_id, $date)
    {
        $date  = date('Y-m-d', strtotime($date));
        $where = array(
            'appointments.company_id'    => $company_id,
            'appointments.appointment_date' => $date            
          );

        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, CONCAT(users.FName, " ", users.LName)AS employee_name, acs_profile.mail_add,acs_profile.city AS cust_city, acs_profile.state AS cust_state,acs_profile.zip_code AS cust_zip_code, acs_profile.phone_m AS cust_phone, appointment_types.name AS appointment_type');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');     
        $this->db->join('appointment_types', 'appointments.appointment_type_id = appointment_types.id','left');     
        $this->db->join('users', 'appointments.user_id = users.id','left');     
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function priorityOptions()
    {
        $options = [
            0 => 'Call 10 minutes out',
            1 => 'Call 20 minutes out',
            2 => 'Call 30 minutes out',
            3 => 'Standard',            
            4 => 'Low',
            5 => 'Emergency',
            6 => 'Urgent'           
        ];

        return $options;
    }

    public function priorityEventOptions()
    {
        $options = [
            0 => 'Optional',
            1 => 'Mandatory',
            2 => 'Invitation Only'
        ];

        return $options;
    }

    public function getAllByDateRange($start_date, $end_date)
    {
        $where = array(
            'appointments.company_id' => $company_id
          );

        $this->db->select('appointments.*, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer_name, acs_profile.mail_add,acs_profile.city AS cust_city, acs_profile.state AS cust_state,acs_profile.zip_code AS cust_zip_code, acs_profile.phone_m AS cust_phone');
        $this->db->from($this->table);   
        $this->db->join('acs_profile', 'appointments.prof_id = acs_profile.prof_id','left');          
        $this->db->where('appointments.appointment_date >=', $start_date);
        $this->db->where('appointments.appointment_date <=', $end_date);
        $this->db->order_by('appointments.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Appointment_model.php */
/* Location: ./application/models/Appointment_model.php */
