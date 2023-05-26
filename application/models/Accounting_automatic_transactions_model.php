<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_automatic_transactions_model extends MY_Model
{

	public $table = 'accounting_automatic_transactions';

    public function get_by_company_id($companyId)
    {
        $this->db->where('company_id', $companyId);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}