<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingRecurringTransactionPayment_model extends MY_Model
{
    public $table = 'accounting_recurring_transaction_payments';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCompanyId($cid)
    {        
        $this->db->select('accounting_recurring_transaction_payments.*,accounting_recurring_transactions.txn_id,accounting_recurring_transactions.txn_type');
        $this->db->from($this->table);
        $this->db->join('accounting_recurring_transactions', 'accounting_recurring_transaction_payments.accounting_recurring_transaction_id = accounting_recurring_transactions.id');
        $this->db->where('accounting_recurring_transaction_payments.company_id', $cid);

        $query = $this->db->get();
        return $query->result();
    }
}
