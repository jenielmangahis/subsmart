<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts_model extends MY_Model {

	public $table = 'accounting_chart_of_accounts';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function saverecords($account_id,$acc_detail_id,$name,$description,$sub_acc_id,$time,$balance,$time_date)
	{
		$query="insert into accounting_chart_of_accounts values('','$account_id','$acc_detail_id','$name','$description','$sub_acc_id','$time','$balance','$time_date','1','','')";
		echo $this->db->query($query);
	}

	public function updaterecords($id,$account_id,$acc_detail_id,$name,$description,$sub_acc_id,$time,$balance,$time_date)
	{
		$query="update accounting_chart_of_accounts set account_id = '$account_id', acc_detail_id = '$acc_detail_id', name ='$name', description ='$description', sub_acc_id = '$sub_acc_id', time ='$time', balance ='$balance', time_date ='$time_date' where id = $id";
		echo $this->db->query($query);
	}

	public function update_name($id,$name)
	{
		$query="update accounting_chart_of_accounts set name ='$name' where id = $id";
		echo $this->db->query($query);
	}

	public function select()
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('active','1');
		$query = $this->db->get('accounting_chart_of_accounts');
		return $query->result();
	}

	public function updateBalance($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->where('company_id', $data['company_id']);
		$balance = $this->db->update($this->table, ['balance' => $data['balance']]);

		return $balance;
	}

    public function getById($id)
    {
    	$this->db->from('accounting_chart_of_accounts');  
    	$this->db->where('id',$id); 
    	$result =  $this->db->get()->result();
        return $result[0];
    }

    public function inactive($id)
	{
		$query="update accounting_chart_of_accounts set active = 0 where id = $id";
		echo $this->db->query($query);
	}

	public function insert($data)
	{
	  $this->db->insert_batch('accounting_chart_of_accounts', $data);
	}

	public function getName($id)
	{
		$this->db->from('accounting_chart_of_accounts');  
    	$this->db->where('id',$id); 
    	$result =  $this->db->get()->result();
        foreach ($result as $row) {
		    return $row->name;
		}
	}

	public function getBalance($id)
	{
		$this->db->from('accounting_chart_of_accounts');  
    	$this->db->where('id',$id); 
    	$result =  $this->db->get()->result();
        foreach ($result as $row) {
		    return $row->balance;
		}
	}
}