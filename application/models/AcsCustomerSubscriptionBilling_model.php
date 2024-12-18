<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsCustomerSubscriptionBilling_model extends MY_Model
{
    public $table = 'acs_customer_subscription_billing';

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($cid, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);

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

    public function getCustomerSubscriptionBillingByFilter($filter = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if($filter['recurring_date']) {
            $this->db->where('recurring_date', $filter['recurring_date']);
        }

        if($filter['billing_id']) {
            $this->db->where('billing_id', $filter['billing_id']);
        }

        if($filter['customer_id']) {
            $this->db->where('customer_id', $filter['customer_id']);
        }

        if($filter['company_id']) {
            $this->db->where('company_id', $filter['company_id']);
        }

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getPaymentSubscriptionHistory($keyword)
    {
        $this->db->select(
            'acs_customer_subscription_billing.*,
            invoices.invoice_number,acs_profile.first_name,
            acs_profile.last_name,invoices.status'
        );
        $this->db->from($this->table);
        $this->db->join('invoices', 'acs_customer_subscription_billing.invoice_id = invoices.id', 'left');
        $this->db->join('acs_profile', 'acs_customer_subscription_billing.customer_id = acs_profile.prof_id', 'left');

        if ( $keyword != '' ) {
            $this->db->like('invoices.invoice_number', $keyword, 'both');
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getPaymentSubscriptionHistoryByCustomerId($customer_id, $keyword)
    {
        $this->db->select(
            'acs_customer_subscription_billing.*,
            invoices.invoice_number,acs_profile.first_name,
            acs_profile.last_name,invoices.status'
        );
        $this->db->from($this->table);
        $this->db->join('invoices', 'acs_customer_subscription_billing.invoice_id = invoices.id', 'left');
        $this->db->join('acs_profile', 'acs_customer_subscription_billing.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_customer_subscription_billing.customer_id', $customer_id);

        if ( $keyword != '' ) {
            $this->db->group_start();            
            $this->db->like('invoices.invoice_number', $keyword, 'both');
            $this->db->group_end();            
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getByInvoiceId($invoice_id)
    {
        $this->db->select('acs_customer_subscription_billing.*, acs_billing.bill_start_date, acs_billing.bill_end_date');
        $this->db->from($this->table);
        $this->db->join('acs_billing', 'acs_customer_subscription_billing.billing_id = acs_billing.bill_id', 'left');
        $this->db->where('acs_customer_subscription_billing.invoice_id', $invoice_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getTotalAmountUnpaidByCustomerId($prof_id)
    {
        $this->db->select('COALESCE(SUM(invoices.grand_total),0)AS total_amount');
        $this->db->from($this->table);
        $this->db->join('invoices', 'acs_customer_subscription_billing.invoice_id = invoices.id', 'left');
        $this->db->where('acs_customer_subscription_billing.customer_id', $prof_id);
        $this->db->where('invoices.status', 'Unpaid');

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file AcsCustomerSubscriptionBilling_model.php */
/* Location: ./application/models/AcsCustomerSubscriptionBilling_model.php */
