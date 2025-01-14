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
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->result();
    }
}
