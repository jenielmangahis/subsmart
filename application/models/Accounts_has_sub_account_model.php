<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_has_sub_account_model extends MY_Model {

	public $table = 'accounts_has_sub_account';
	
	public function __construct()
	{
		parent::__construct();
	}

	function fetch_sub_acc_id($account_id)
	{
		$this->db->where('account_id', $account_id);
		$this->db->order_by('account_id', 'ASC');
		$query = $this->db->get('accounts_has_sub_account');
		$output = '<option value="">Select Sub Account Type</option>';
		foreach($query->result() as $row)
		{
			$output .= $this->account_detail_model->fetch_acc_detail($row->sub_acc_id,$account_id);
		}
		return $output;
	}
}