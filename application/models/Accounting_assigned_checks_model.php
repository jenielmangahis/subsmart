<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_assigned_checks_model extends MY_Model {

	public $table = 'accounting_assigned_checks';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function assign_check_no($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_check_no($data)
    {
        $this->db->where('transaction_type', $data['transaction_type']);
        $this->db->where('transaction_id', $data['transaction_id']);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function unassign_check_no($data)
    {
        $this->db->where('transaction_type', $data['transaction_type']);
        $this->db->where('transaction_id', $data['transaction_id']);
        $delete = $this->db->delete($this->table);
        return $delete;
    }

    public function get_assigned_check_no($whereData)
    {
        $this->db->where('transaction_type', $whereData['transaction_type']);
        $this->db->where('transaction_id', $whereData['transaction_id']);
        $this->db->where('payment_account_id', $whereData['payment_account_id']);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function get_last_assigned($paymentAccountId)
    {
        $this->db->where('payment_account_id', $paymentAccountId);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get($this->table);
        return $query->row();
    }
}