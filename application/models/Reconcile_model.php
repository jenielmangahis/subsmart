<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile_model extends MY_Model {

	public $table = 'accounting_reconcile';

	public function saverecords($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="insert into accounting_reconcile values('','$chart_of_accounts_id','$ending_balance','$ending_date','$first_date','$service_charge','$expense_account','$second_date','$interest_earned','$income_account','','SVCCHRG','Service Charge','Interest Earned','','','','','','','',1')";
		echo $this->db->query($query);
	}

	public function updaterecords($id,$chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account)
	{
		$query="update accounting_reconcile set chart_of_accounts_id = '$chart_of_accounts_id', ending_balance = '$ending_balance', ending_date ='$ending_date', first_date ='$first_date', service_charge = '$service_charge', expense_account ='$expense_account', second_date ='$second_date', interest_earned ='$interest_earned', income_account ='$income_account' where id = '$id'";;
		echo $this->db->query($query);
	}

	public function updatepgrecords($id,$first_date,$service_charge,$expense_account,$CHRG,$memo_sc)
	{
		$query="update accounting_reconcile set first_date ='$first_date', service_charge = '$service_charge', expense_account ='$expense_account',CHRG = '$CHRG', memo_sc = '$memo_sc' where id = '$id'";;
		echo $this->db->query($query);
	}

	public function updatepg2records($id,$second_date,$interest_earned,$income_account,$memo_it)
	{
		$query="update accounting_reconcile set second_date ='$second_date', income_account = '$income_account', interest_earned ='$interest_earned', memo_it = '$memo_it' where id = '$id'";;
		echo $this->db->query($query);
	}

	public function update_sc_records($reconcile_id,$mailing_address,$first_date,$checkno,$memo_sc,$descp_sc,$expense_account,$service_charge)
	{
		$query="update accounting_reconcile set mailing_address ='$mailing_address', first_date = '$first_date', checkno ='$checkno', memo_sc = '$memo_sc',descp_sc = '$descp_sc',expense_account = '$expense_account',service_charge = '$service_charge' where id = '$reconcile_id'";
		echo $this->db->query($query);
		echo $query;
	}

	public function updatepgscrecords($id,$scid,$first_date,$checkno,$service_charge_sub,$expense_account_sub,$descp_sc_sub)
	{
		$query="update accounting_reconcile set first_date ='$first_date',checkno = '$checkno' where id = '$id'";;
		echo $this->db->query($query);
		$query2 ="update accounting_reconcile_has_servicecharge set service_charge_sub = '$service_charge_sub', expense_account_sub ='$expense_account_sub', descp_sc_sub = '$descp_sc_sub' where id = '$scid'";;
		echo $this->db->query($query2);
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

  	public function selecthistorywhere($chart_of_accounts_id)  
  	{  
	  	$this->db->from('accounting_reconcile');  
		$this->db->where('adjustment_date is NOT NULL', NULL, FALSE); 
		$this->db->where('chart_of_accounts_id',$chart_of_accounts_id); 
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

	 public function save_service($reconcile_id,$chart_of_accounts_id,$expense_account_sub,$service_charge_sub,$descp_sc_sub)
	{
		$query="insert into accounting_reconcile_has_servicecharge values('','$reconcile_id','$chart_of_accounts_id','$expense_account_sub','$service_charge_sub','$descp_sc_sub')";
		echo $this->db->query($query);
	}

	public function update_service($id,$expense_account_sub,$service_charge_sub,$descp_sc_sub)
	{
		$query="update accounting_reconcile_has_servicecharge set expense_account_sub = '$expense_account_sub',service_charge_sub = '$service_charge_sub',descp_sc_sub = '$descp_sc_sub' where id = '$id'";
		echo $this->db->query($query);
	}

	public function select_service($id,$chart_of_accounts_id)
	{
		$this->db->from('accounting_reconcile_has_servicecharge');  
		$this->db->where('reconcile_id',$id);
		$this->db->where('chart_of_accounts_id',$chart_of_accounts_id);
		$result =  $this->db->get()->result();
	    return $result;	
	}

	public function remove_sc_records($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('accounting_reconcile_has_servicecharge');  
	}

	public function uploadfile($reconcile_id,$id,$filename,$filepath,$fileexe,$filedate)
	{
		$query="insert into accounting_uploadfiles values('',$reconcile_id,'$id','$filename','$filepath','$fileexe','$filedate')";
		echo $this->db->query($query);	
	}

	public function getUploads($params = array())
	{
		$this->db->select('*');
        $this->db->from('accounting_uploadfiles');
        $this->db->where('reconcile_id','4');
        if(array_key_exists('id',$params) && !empty($params['id'])){
            $this->db->where('id',$params['id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
	}

	public function recurr_save($reconcile_id,$chart_of_accounts_id,$template_name,$template_type,$template_interval,$advanced_day,$day,$dayname,$daynum,$weekday,$weekname,$monthday,$monthname,$startdate,$endtype,$enddate,$occurrence,$payeename,$account_type,$payment_date,$mailing_address,$checkno,$permitno,$memo_recurr_sc)
	{
		$query="insert into accounting_recurr values('','$reconcile_id','$chart_of_accounts_id','$template_name','$template_type','$template_interval','$advanced_day','$day','$dayname','$daynum','$weekday','$weekname','$monthday','$monthname','$startdate','$endtype','$enddate','$occurrence','$payeename','$account_type','$payment_date','$mailing_address','$checkno','$permitno','$memo_recurr_sc')";
		$this->db->query($query);
		$insert_id = $this->db->insert_id();

   		echo $insert_id;
	}

	 public function save_recurr_service($mainid,$reconcile_id,$chart_of_accounts_id,$expense_account_sub,$service_charge_sub,$descp_sc_sub)
	{
		$query="insert into accounting_reconcile_has_servicecharge_recurr values('','$mainid','$reconcile_id','$chart_of_accounts_id','$expense_account_sub','$service_charge_sub','$descp_sc_sub')";
		echo $this->db->query($query);
	}

	public function update_recurr_service($id,$expense_account_sub,$service_charge_sub,$descp_sc_sub)
	{
		$query="update accounting_reconcile_has_servicecharge_recurr set expense_account_sub = '$expense_account_sub',service_charge_sub = '$service_charge_sub',descp_sc_sub = '$descp_sc_sub' where id = '$id'";
		echo $this->db->query($query);
	}

	public function remove_sc_recurr_records($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('accounting_reconcile_has_servicecharge_recurr');  
	}

	public function select_recurr_service($id,$chart_of_accounts_id)
	{
		$this->db->from('accounting_reconcile_has_servicecharge_recurr');  
		$this->db->where('reconcile_id',$id);
		$this->db->where('chart_of_accounts_id',$chart_of_accounts_id);
		$result =  $this->db->get()->result();
	    return $result;	
	}

	public function check_save($reconcile_id,$chart_of_accounts_id,$check_payee_popup,$check_account_popup,$mailing_address,$checkno,$permitno,$memo_sc)
	{
		$query="insert into accounting_addcheck values('','$reconcile_id','$chart_of_accounts_id','$check_payee_popup','$check_account_popup','$mailing_address','$checkno','$permitno','$memo_sc')";
		 $this->db->query($query);
		 $insert_id = $this->db->insert_id();

   		echo $insert_id;
	}

	 public function save_check_service($mainid,$reconcile_id,$chart_of_accounts_id,$expense_account_sub,$service_charge_sub,$descp_sc_sub)
	{
		$query="insert into accounting_reconcile_has_servicecharge_check values('','$mainid','$reconcile_id','$chart_of_accounts_id','$expense_account_sub','$service_charge_sub','$descp_sc_sub')";
		echo $this->db->query($query);
	}


	public function remove_sc_check_records($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('accounting_reconcile_has_servicecharge_check');  
	}

	public function save_interest($reconcile_id,$chart_of_accounts_id,$income_account_sub,$interest_earned_sub,$descp_it_sub)
	{
		$query="insert into accounting_reconcile_has_interestearned values('','$reconcile_id','$chart_of_accounts_id','$income_account_sub','$interest_earned_sub','$descp_it_sub')";
		echo $this->db->query($query);
	}

	public function update_interest($id,$income_account_sub,$interest_earned_sub,$descp_it_sub)
	{
		$query="update accounting_reconcile_has_interestearned set income_account_sub = '$income_account_sub',interest_earned_sub = '$interest_earned_sub',descp_it_sub = '$descp_it_sub' where id = '$id'";
		echo $this->db->query($query);
	}

	public function select_interest($id,$chart_of_accounts_id)
	{
		$this->db->from('accounting_reconcile_has_interestearned');  
		$this->db->where('reconcile_id',$id);
		$this->db->where('chart_of_accounts_id',$chart_of_accounts_id);
		$result =  $this->db->get()->result();
	    return $result;	
	}

	public function select_recurr_interest($id,$chart_of_accounts_id)
	{
		$this->db->from('accounting_reconcile_has_interestearned_recurr');  
		$this->db->where('reconcile_id',$id);
		$this->db->where('chart_of_accounts_id',$chart_of_accounts_id);
		$result =  $this->db->get()->result();
	    return $result;	
	}

	public function remove_it_records($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('accounting_reconcile_has_interestearned');  
	}

	public function update_it_records($reconcile_id,$second_date,$memo_it,$descp_it,$income_account,$interest_earned,$cash_back_account,$cash_back_memo,$cash_back_amount)
	{
		$query="update accounting_reconcile set second_date ='$second_date', memo_it = '$memo_it',descp_it = '$descp_it',income_account = '$income_account',interest_earned = '$interest_earned',cash_back_account='$cash_back_account',cash_back_memo='$cash_back_memo',cash_back_amount='$cash_back_amount' where id = '$reconcile_id'";
		echo $this->db->query($query);
		echo $query;
	}
}
?>