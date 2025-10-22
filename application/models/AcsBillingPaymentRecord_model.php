<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsBillingPaymentRecord_model extends MY_Model
{
    public $table = 'acs_billing_payment_records';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCustomerId($customer_id, $sort = [], $filters = [])
    {
        $this->db->select('acs_billing_payment_records.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname, acs_profile.business_name AS customer_business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_billing_payment_records.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_billing_payment_records.customer_id', $customer_id);
        
        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('acs_billing_payment_records.id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getById($id)
    {
        $this->db->select('acs_billing_payment_records.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname, acs_profile.business_name AS customer_business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_billing_payment_records.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_billing_payment_records.id', $id);        

        $query = $this->db->get();
        return $query->row();
    }  
}
/* End of file AcsBillingPaymentRecord_model.php */
/* Location: ./application/models/AcsBillingPaymentRecord_model.php */
