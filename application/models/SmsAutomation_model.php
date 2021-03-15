<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmsAutomation_model extends MY_Model
{
    public $table = 'sms_automation';

    public $rule_event_estimate_submitted = 'estimate_submitted';
    public $rule_event_invoice_paid = 'invoice_paid';
    public $rule_event_invoice_due = 'invoice_due';
    public $rule_event_work_order_completed = 'work_order_completed';

    public $customer_type_service_both = 0;
    public $customer_type_service_residential = 1;
    public $customer_type_service_commercial  = 2;

    public $status_draft = 0;
    public $status_active = 1;
    public $status_inactive = 2;
   
    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array(), $conditions=array())
    {

        $this->db->select('sms_automation.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'sms_automation.user_id = users.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('sms_automation.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'sms_automation.user_id = users.id', 'LEFT');

        $this->db->where('sms_automation.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateSmsAutomation($sms_automation_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $sms_automation_id);
        $this->db->update();
    }

    
    public function deleteSmsAutomation($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function optionRuleNotify(){
        $options = [
            $this->rule_event_estimate_submitted => 'Estimate Follow-up',
            $this->rule_event_invoice_due => 'Invoice Due',
            $this->rule_event_invoice_paid => 'Invoice Paid',
            $this->rule_event_work_order_completed => 'Work Order Completed'
        ];

        return $options;
    }

    public function optionRuleNotifyAt(){
        $options = [
            'P1D' => '1 Day',
            'P2D' => '2 Days',
            'P3D' => '3 Days',
            'P4D' => '4 Days',
            'P5D' => '5 Days',
            'P6D' => '6 Days',
            'P7D' => '7 Days',
            'P1W' => '1 Week',
            'P2W' => '2 Weeks',
            'P3W' => '3 Weeks',
            'P4W' => '4 Weeks'
        ];

        return $options;
    }

    public function optionCustomerTypeService(){
        $options = [
            $this->customer_type_service_both => 'Both Residential and Commercial',
            $this->customer_type_service_commercial => 'Commercial customers',
            $this->customer_type_service_residential => 'Residential customers'
        ];

        return $options;
    }

    public function optionStatus(){
        $options = [
            $this->status_draft => 'Draft',
            $this->status_active => 'Active',
            $this->status_inactive => 'Inactive' 
        ];

        return $options;
    }

    public function isDraft(){
        return $this->status_draft;
    }

    public function isActive(){
        return $this->status_active;
    }

    public function getPricePerSms(){
        return 0.05;
    }

}

/* End of file SmsAutomation_model.php */
/* Location: ./application/models/SmsAutomation_model.php */
