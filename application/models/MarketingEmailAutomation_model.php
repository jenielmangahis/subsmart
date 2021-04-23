<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MarketingEmailAutomation_model extends MY_Model
{
    public $table = 'email_automation';

    public $rule_event_estimate_followup = 'estimate_followup';
    public $rule_event_invoice_paid = 'invoice_paid';
    public $rule_event_invoice_due = 'invoice_due';
    public $rule_event_workorder_completed = 'workorder_completed';

    public $customer_type_both = 0;
    public $customer_type_residential = 1;
    public $customer_type_commercial = 2;

    public $is_active = 1;
    public $is_inactive = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }  

    public function getAllByCompanyId($company_id, $filters=array(), $conditions=array())
    {

        $this->db->select('email_automation.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'email_automation.user_id = users.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
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

    public function getByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query;
    }

    public function deleteEmailAutomationById($id){
        $this->db->delete($this->table, array('id' => $id));
    }


    public function getById($id)
    {
        $this->db->select('email_automation.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'email_automation.user_id = users.id', 'LEFT');

        $this->db->where('email_automation.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();

        return  $last_id;
    }

    public function delete($id)
    {
        $user_id = logged('id');
        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    }   

    public function optionsRuleEvent(){
        $options = [
            $this->rule_event_estimate_followup => 'Estimate Follow-up',
            $this->rule_event_workorder_completed => 'Workorder Completed',
            $this->rule_event_invoice_due => 'Invoice Due',
            $this->rule_event_invoice_paid => 'Invoice Paid'
        ];

        return $options;
    }   

    public function optionCustomerType(){
        $options = [
            $this->customer_type_both => 'Both',
            $this->customer_type_commercial => 'Commercial',
            $this->customer_type_residential => 'Residential'
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

    public function isActive(){
        return $this->is_active;
    }

    public function isInactive(){
        return $this->is_inactive;
    }

    public function optionsIsActive(){
        $option = [
            $this->is_active => 'Active',
            $this->is_inactive => 'Inactive',
        ];

        return $option;
    }

}

/* End of file MarketingEmailAutomation_model.php */
/* Location: ./application/models/MarketingEmailAutomation_model.php */
