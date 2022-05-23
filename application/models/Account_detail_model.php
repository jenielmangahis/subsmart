<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_detail_model extends MY_Model {

	public $table = 'account_detail';
	
	public function __construct()
	{
		parent::__construct();
	}

	function fetch_acc_detail($acc_detail_id)
	 {
	  $this->db->where('acc_detail_id', $acc_detail_id);
	  $this->db->order_by('acc_detail_name', 'ASC');
	  $query = $this->db->get('account_detail');
	  $output ='';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->acc_detail_id.'" id="id_'.$row->acc_detail_id.'">'.$row->acc_detail_name.'</option>';
	  }
	  return $output;
	 }

	 function getName($acc_detail_id)
	{
		$this->db->select('acc_detail_name');
	    $this->db->from('account_detail');
	    $this->db->where('acc_detail_id', $acc_detail_id);
	    return $this->db->get()->row()->acc_detail_name;
	}
}