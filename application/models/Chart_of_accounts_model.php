<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts_model extends MY_Model {

	public $table = 'accounting_chart_of_accounts';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function saverecords($data)
	{
		$this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	public function updaterecords($data)
	{
		$this->db->where('id', $data['id']);
		$update = $this->db->update($this->table, $data);
		if($update) {
			return true;
		} else {
			return false;
		}
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

	public function getFilteredAccounts($status, $order, $orderColumn)
	{
		$this->db->where('accounting_chart_of_accounts.company_id', logged('company_id'));
		$this->db->where_in('accounting_chart_of_accounts.active', $status);

		switch($orderColumn) {
			case 'nsmartrac_balance' :
				$this->db->order_by('balance', $order);
			break;
			case 'name' :
				$this->db->order_by('name', $order);
			break;
			default :
				$this->db->join('account', 'account.id = accounting_chart_of_accounts.account_id');
				$this->db->order_by('account.account_name', $order);
			break;
		}

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
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		return $this->db->update($this->table, ['active' => 0]);
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

	public function makeActive($id)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		return $this->db->update($this->table, ['active' => 1]);
	}
}