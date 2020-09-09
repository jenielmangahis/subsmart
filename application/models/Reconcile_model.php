<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile_model extends MY_Model {

	public $table = 'accounting_reconcile';

	public function saverecords($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="insert into accounting_reconcile values('','$chart_of_accounts_id','$ending_balance','$ending_date','$first_date','$service_charge','$expense_account','$second_date','$interest_earned','$income_account','','1')";
		echo $this->db->query($query);
	}

	public function updaterecords($id,$chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="update accounting_reconcile set chart_of_accounts_id = '$chart_of_accounts_id', ending_balance = '$ending_balance', ending_date ='$ending_date', first_date ='$first_date', service_charge = '$service_charge', expense_account ='$expense_account', second_date ='$second_date', interest_earned ='$interest_earned', income_account ='$income_account' where id = '$id'";;
		echo $this->db->query($query);
	}

	public function select()  
	  {  
	    /*$query = $this->db->get('accounting_reconcile');  
	    return $query->result(); */ 
	    $this->db->from('accounting_reconcile');  
    	$this->db->where('active','1'); 
    	$result =  $this->db->get()->result();
        return $result;
	  }

	 public function selectAll()  
	  {  
	    $query = $this->db->get('accounting_reconcile');  
	    return $query->result();
	  } 

	public function selectonwhere($id)  
	  {  
	  	$this->db->from('accounting_reconcile');  
    	$this->db->where('chart_of_accounts_id',$id); 
    	$this->db->where('active','1'); 
    	$result =  $this->db->get()->result();
        return $result;
	  } 

	public function selectonwherewithinactive($id)  
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
		//$this->db->query("delete from accounting_reconcile where id='".$id."'");
		$query="update accounting_reconcile set active = 0 where id = $id";
		echo $this->db->query($query);
	}

	public function checkexist($id)
	{
		$query = $this->db->query("SELECT * FROM accounting_chart_of_accounts where EXISTS (SELECT id FROM accounting_reconcile WHERE accounting_reconcile."."chart_of_accounts_id = accounting_chart_of_accounts."."id)");
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
		   {
		      if($row->id == $id)
		      {
		      	return $row->id;
		      }
		   }
		}
		else
		{
			return 0;
		}


	}

	public function selectsummary()  
  	{  
	  	$this->db->from('accounting_reconcile');  
		$this->db->where('adjustment_date is NOT NULL', NULL, FALSE); 
		$result =  $this->db->get()->result();
	    return $result;
  	}

  	public function updatesingle($id,$adjustment_date)
	{
		$query="update accounting_reconcile set adjustment_date = '$adjustment_date' where id = '$id'";
		echo $this->db->query($query);
	}

	public function fetch_ending_date($chart_of_accounts_id)
	 {
	  $this->db->where('chart_of_accounts_id', $chart_of_accounts_id);
	  $query = $this->db->get('accounting_reconcile');
	  $output ='';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->id.'">'.$row->ending_date.'</option>';
	  }
	  return $output;
	 }
}
?>