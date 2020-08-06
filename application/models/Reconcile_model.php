<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile_model extends MY_Model {

	public $table = 'reconcile';

	public function saverecords($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="insert into reconcile values('','$chart_of_accounts_id','$ending_balance','$ending_date','$first_date','$service_charge','$expense_account','$second_date','$interest_earned','$income_account')";
		echo $this->db->query($query);
	}

	public function select()  
	  {  
	     $query = $this->db->get('reconcile');  
	     return $query->result();  
	  } 
}
?>