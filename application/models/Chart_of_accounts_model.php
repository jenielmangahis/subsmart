<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts_model extends MY_Model {

	public $table = 'chart_of_accounts';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function saverecords($account_id,$acc_detail_id,$name,$description,$sub_acc_id,$time,$balance,$time_date)
	{
		$query="insert into chart_of_accounts values('','$account_id','$acc_detail_id','$name','$description','$sub_acc_id','$time','$balance','$time_date','','')";
		echo $this->db->query($query);
	}

	public function select()  
      {  
         $query = $this->db->get('chart_of_accounts');  
         return $query->result();  
      } 

    public function getById($id)
    {
    	$this->db->from('chart_of_accounts');  
    	$this->db->where('id',$id); 
    	$result =  $this->db->get()->result();
        return $result[0];
    }
}