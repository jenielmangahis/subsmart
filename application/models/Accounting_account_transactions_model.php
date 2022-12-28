<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_account_transactions_model extends MY_Model {

	public $table = 'accounting_account_transactions';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_account_transactions_by_type($accountId, $transactionType)
	{
		$this->db->where('account_id', $accountId);
		$this->db->where('transaction_type', $transactionType);
		$this->db->order_by('transaction_date', 'desc');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_account_transactions($accountId)
	{
		$this->db->where('account_id', $accountId);
		$this->db->order_by('transaction_date', 'desc');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function delete_account_transactions_by_transaction($transactionType, $transactionId)
	{
		$this->db->where('transaction_type', $transactionType);
		$this->db->where('transaction_id', $transactionId);
		$query = $this->db->delete($this->table);
		return $query;
	}
}