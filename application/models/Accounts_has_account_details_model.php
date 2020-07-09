<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_has_account_details_model extends MY_Model {

	public $table = 'accounts_has_account_details';
	
	public function __construct()
	{
		parent::__construct();
	}

	function fetch_acc_detail_id($account_id)
	{
		$this->db->where('account_id', $account_id);
		$this->db->order_by('account_id', 'ASC');
		$query = $this->db->get('accounts_has_account_details');
		$output = '<option value="">Select Detail Type</option>';
		foreach($query->result() as $row)
		{
			$output .= $this->account_detail_model->fetch_acc_detail($row->acc_detail_id,$account_id);
		}
		return $output;
	}
}