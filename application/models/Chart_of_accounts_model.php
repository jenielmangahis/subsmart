<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts_model extends MY_Model {

	public $table = 'chart_of_accounts';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function saverecords($account_id,$acc_detail_id,$name,$description,$sub_acc_id,$time)
	{
		$query="insert into chart_of_accounts values('','$account_id','$acc_detail_id','$name','$description','$sub_acc_id','$time','','')";
		echo $this->db->query($query);
	}
}