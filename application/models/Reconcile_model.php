<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile_model extends MY_Model {

	public $table = 'accounting_reconcile';

	public function saverecords($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="insert into accounting_reconcile values('','$chart_of_accounts_id','$ending_balance','$ending_date','$first_date','$service_charge','$expense_account','$second_date','$interest_earned','$income_account')";
		echo $this->db->query($query);
	}

	public function updaterecords($id,$chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="update accounting_reconcile set chart_of_accounts_id = '$chart_of_accounts_id', ending_balance = '$ending_balance', ending_date ='$ending_date', first_date ='$first_date', service_charge = '$service_charge', expense_account ='$expense_account', second_date ='$second_date', interest_earned ='$interest_earned', income_account ='$income_account' where id = '$id'";;
		echo $this->db->query($query);
	}

	public function select()  
	  {  
	    $query = $this->db->get('accounting_reconcile');  
	    return $query->result();  
	  } 

	public function selectonwhere($id)  
	  {  
	  	$this->db->from('accounting_reconcile');  
    	$this->db->where('chart_of_accounts_id',$id); 
    	$result =  $this->db->get()->result();
        return $result;
	  } 
	public function getById($id)  
	  {  
	  	$this->db->from('accounting_reconcile');  
    	$this->db->where('id',$id); 
    	$result =  $this->db->get()->result();
        return $result[0];
	  } 

	public function delete($id)
	{
		$this->db->query("delete from accounting_reconcile where id='".$id."'");
	}

	public function checkexist($id)
	{
		$query = $this->db->query("SELECT * FROM accounting_chart_of_accounts where EXISTS (SELECT id FROM accounting_reconcile WHERE accounting_reconcile."."chart_of_accounts_id = ".$id.")");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row->id;
		}
		else
		{
			return 0;
		}


	}


}
?>