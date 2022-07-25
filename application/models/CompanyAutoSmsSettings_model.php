<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyAutoSmsSettings_model extends MY_Model
{    
    public $table = 'company_auto_sms_settings';
    public $module_job = 'job';
    public $module_estimate = 'estimate';
    public $module_work_order = 'workorder';
    public $module_event = 'event';
    public $module_customer = 'customer';
    public $module_taskhub  = 'taskhub';


    public function getAll($filters=array())
    {
        $this->db->select('company_auto_sms_settings.*, business_profile.business_name');
        $this->db->from($this->table);
        $this->db->join('business_profile', 'business_profile.company_id = company_auto_sms_settings.company_id', 'left');

        if ( !empty($filters['search']) ){
            $this->db->or_like('business_profile.business_name', $filters['search'], 'both');        
        }

        $this->db->order_by('company_auto_sms_settings.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('company_auto_sms_settings.*, business_profile.business_name');
        $this->db->from($this->table);
        $this->db->join('business_profile', 'business_profile.company_id = company_auto_sms_settings.company_id', 'left');
        $this->db->where('company_auto_sms_settings.company_id', $company_id);

        if ( !empty($filters['search']) ){
            $this->db->or_like('business_profile.business_name', $filters['search'], 'both');        
        }

        $this->db->order_by('company_auto_sms_settings.id', 'DESC');

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

    public function getByCompanyId($company_id, $filter = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if( !empty($filter) ){
            foreach($filter as $value){                
                $this->db->where($value['field'], $value['value']);
            }
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function moduleEstimate()
    {
        return $this->module_estimate;
    }

    public function moduleJob()
    {
        return $this->module_job;
    }

    public function moduleWorkOrder()
    {
        return $this->module_work_order;
    }

    public function moduleEvent()
    {
        return $this->module_event;
    }

    public function moduleCustomer()
    {
        return $this->module_customer;
    }

    public function moduleTaskHub()
    {
        return $this->module_taskhub;
    }

    public function moduleList()
    {
        $modules = [
            $this->module_job => 'Jobs',
            $this->module_estimate => 'Estimates',
            $this->module_work_order => 'Work Orders',
            $this->module_event => 'Events',
            $this->module_customer => 'Customers',
            $this->module_taskhub => 'Taskhub',
        ];

        return $modules;
    }

    public function jobModuleStatusList()
    {
        $status = [
            'Arrival' => 'Arrival',
            'Scheduled' => 'Scheduled',
            'Started' => 'Started',
            'New' => 'New',
            'Completed' => 'Completed',
            //'Email Opened' => 'Email Opened',
        ];

        return $status;
    }

    public function estimateModuleStatusList()
    {
        $status = [
            'Submitted' => 'Submitted',
            'Accepted' => 'Accepted',
            'Declined By Customer' => 'Declined By Customer',
            'Lost' => 'Lost',
            'Email Opened' => 'Email Opened'
        ];

        return $status;
    }

    public function workOrderModuleStatusList()
    {
        $status = [
            'New' => 'New',
            'Scheduled' => 'Scheduled',
            'Started' => 'Started',
            'Paused' => 'Paused',
            'Invoiced' => 'Invoiced',
            'Withdrawn' => 'Withdrawn',
            'Closed' => 'Closed',
            //'Email Opened' => 'Email Opened'
        ];

        return $status;
    }

    public function eventModuleStatusList()
    {
        $status = [
            'Scheduled' => 'Scheduled',
            'Started' => 'Started',
            'Completed' => 'Completed',
            //'Email Opened' => 'Email Opened'
        ];

        return $status;
    }

    public function customerModuleStatusList()
    {
        $status = [
            'New' => 'New'
        ];

        return $status;
    }
}

/* End of file CompanyAutoSmsSettings_model.php */
/* Location: ./application/models/CompanyAutoSmsSettings_model.php */
