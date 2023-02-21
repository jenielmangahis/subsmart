<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_recurring_transactions_model extends MY_Model
{
    public $table = 'accounting_recurring_transactions';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getCompanyRecurringTransactions($where, $columnName, $order)
    {
        $this->db->where($where);
        $this->db->where('status !=', 0);
        $this->db->order_by($columnName, $order);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function delete($id)
    {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])
                ->delete($this->table);
    }

    public function updateRecurringTransaction($id, $data)
    {
        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function getRecurringTransaction($id)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('id', $id);
        $this->db->where('status != 0');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    public function getAllByCompany_id($customer_id)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_recuring_delayed_charges($recurring_id)
    {
        $this->db->select('*');
        $this->db->from('accounting_delayed_charge');
        $this->db->where('recurring_id', $recurring_id);
        $this->db->order_by('delayed_credit_date', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_next_date($nextDate)
    {
        $this->db->where('recurring_type', 'scheduled');
        $this->db->where('next_date', $nextDate);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function update_by_batch($data)
    {
        return $this->db->update_batch($this->table, $data, 'id');
    }

    public function get_transactions_by_ids($ids = [])
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where_in('id', $ids);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_customer_recurring_invoices($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->db->where('is_recurring', 1);
        $this->db->where('view_flag', 0);
        $this->db->where('voided', 0);
        $query = $this->db->get('invoices');
        return $query->result();
    }

    public function get_customer_recurring_credit_memos($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->db->where('status', 1);
        $this->db->where('recurring', 1);
        $query = $this->db->get('accounting_credit_memo');
        return $query->result();
    }

    public function get_customer_recurring_sales_receipt($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->db->where('status', 1);
        $this->db->where('recurring', 1);
        $query = $this->db->get('accounting_sales_receipt');
        return $query->result();
    }

    public function get_customer_recurring_refund_receipt($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->db->where('status', 1);
        $this->db->where('recurring', 1);
        $query = $this->db->get('accounting_refund_receipt');
        return $query->result();
    }

    public function get_customer_recurring_delayed_credit($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->db->where('status', 1);
        $this->db->where('recurring', 1);
        $query = $this->db->get('accounting_delayed_credit');
        return $query->result();
    }

    public function get_customer_recurring_delayed_charge($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->db->where('status', 1);
        $this->db->where('recurring', 1);
        $query = $this->db->get('accounting_delayed_charge');
        return $query->result();
    }

    public function get_by_type_and_transaction_id($txnType, $txnId)
    {
        $this->db->where('txn_type', $txnType);
        $this->db->where('txn_id', $txnId);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}
