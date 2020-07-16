<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_sub_account_model extends MY_Model {

	public $table = 'account_sub_account';
	
	public function __construct()
	{
		parent::__construct();
	}

	function fetch_acc_sub_acc($sub_acc_id)
	 {
	  $this->db->where('sub_acc_id', $sub_acc_id);
	  $this->db->order_by('sub_acc_name', 'ASC');
	  $query = $this->db->get('account_sub_account');
	  $output ='';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->sub_acc_id.'" id="id_'.$row->sub_acc_id.'">'.$row->acc_detail_name.'</option>';
	  }
	  return $output;
	 }
}