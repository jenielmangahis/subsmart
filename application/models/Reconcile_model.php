<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile_model extends MY_Model {

	public $table = 'reconcile';

	public function saverecords($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="insert into reconcile values('','$chart_of_accounts_id','$ending_balance','$ending_date','$first_date','$service_charge','$expense_account','$second_date','$interest_earned','$income_account')";
		echo $this->db->query($query);
	}

	public function updaterecords($id,$chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="update reconcile set chart_of_accounts_id = '$chart_of_accounts_id', ending_balance = '$ending_balance', ending_date ='$ending_date', first_date ='$first_date', service_charge = '$service_charge', expense_account ='$expense_account', second_date ='$second_date', interest_earned ='$interest_earned', income_account ='$income_account' where id = '$id'";;
		echo $this->db->query($query);
	}

	public function select()  
	  {  
	    $query = $this->db->get('reconcile');  
	    return $query->result();  
	  } 

	public function selectonwhere($id)  
	  {  
	  	$this->db->from('reconcile');  
    	$this->db->where('chart_of_accounts_id',$id); 
    	$result =  $this->db->get()->result();
        return $result;
	  } 
	public function getById($id)  
	  {  
	  	$this->db->from('reconcile');  
    	$this->db->where('id',$id); 
    	$result =  $this->db->get()->result();
        return $result[0];
	  } 

	public function delete($id)
	{
		$this->db->query("delete from reconcile where id='".$id."'");
	}

	public function checkexist()
	{
		$query = $this->db->query("SELECT * FROM chart_of_accounts where EXISTS (SELECT id FROM reconcile WHERE reconcile."."chart_of_accounts_id = chart_of_accounts."."id)");
		echo $query->num_rows();
	}


}
?>