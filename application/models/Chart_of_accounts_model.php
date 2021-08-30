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

	public function getByAccAndDetailType($status, $accTypeId, $accDetailId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('active', $status);
		$this->db->where('account_id', $accTypeId);
		$this->db->where('acc_detail_id', $accDetailId);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getParentAccsByAccAndDetailType($status, $accTypeId, $accDetailId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('active', $status);
		$this->db->where('account_id', $accTypeId);
		if(is_array($accDetailId)) {
			$this->db->where_in('acc_detail_id', $accDetailId);
		} else {
			$this->db->where('acc_detail_id', $accDetailId);
		}
		$this->db->where('parent_acc_id', null);

		$this->db->or_where('company_id', $company_id);
		$this->db->where('active', $status);
		$this->db->where('account_id', $accTypeId);
		if(is_array($accDetailId)) {
			$this->db->where_in('acc_detail_id', $accDetailId);
		} else {
			$this->db->where('acc_detail_id', $accDetailId);
		}
		$this->db->where('parent_acc_id', 0);

		$this->db->or_where('company_id', $company_id);
		$this->db->where('active', $status);
		$this->db->where('account_id', $accTypeId);
		if(is_array($accDetailId)) {
			$this->db->where_in('acc_detail_id', $accDetailId);
		} else {
			$this->db->where('acc_detail_id', $accDetailId);
		}
		$this->db->where('parent_acc_id', '');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getByAccountType($accTypeId, $parentAccId = null, $company_id)
	{
		$this->db->where('company_id', $company_id);
		$this->db->where('active', 1);
		$this->db->where('account_id', $accTypeId);
		if($parentAccId) {
			$this->db->where('parent_acc_id', $parentAccId);
		} else {
			$this->db->where('parent_acc_id', null);
			$this->db->or_where('company_id', $company_id);
			$this->db->where('active', 1);
			$this->db->where('account_id', $accTypeId);
			$this->db->where('parent_acc_id', 0);
			$this->db->or_where('company_id', $company_id);
			$this->db->where('active', 1);
			$this->db->where('account_id', $accTypeId);
			$this->db->where('parent_acc_id', '');
		}
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getChildAccounts($parentAccId, $exemptedID = null)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('active', 1);
		$this->db->where('parent_acc_id', $parentAccId);
		if($exemptedID) {
			$this->db->where('id !=', $exemptedID);
		}
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getFilteredAccounts($status, $order, $orderColumn)
	{
		$company_id = logged('company_id');
		$this->db->where('accounting_chart_of_accounts.company_id', $company_id);
		$this->db->where_in('accounting_chart_of_accounts.active', $status);
		$this->db->where('accounting_chart_of_accounts.parent_acc_id', null);

		$this->db->or_where('accounting_chart_of_accounts.company_id', $company_id);
		$this->db->where_in('accounting_chart_of_accounts.active', $status);
		$this->db->where('accounting_chart_of_accounts.parent_acc_id', 0);

		switch($orderColumn) {
			case 'nsmartrac_balance' :
				$this->db->order_by('balance', $order);
			break;
			case 'name' :
				$this->db->order_by('name', $order);
			break;
			default :
				$this->db->select('accounting_chart_of_accounts.*, account.account_name');
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

	public function get_expense_accounts()
	{
		$companyId = logged('company_id');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 14);
		$this->db->where('parent_acc_id', null);
		$this->db->or_where('parent_acc_id', '');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 14);
		$this->db->or_where('parent_acc_id', 0);
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 14);
		$query = $this->db->get('accounting_chart_of_accounts');
		return $query->result();
	}

	public function get_other_expense_accounts()
	{
		$companyId = logged('company_id');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 15);
		$this->db->where('parent_acc_id', null);
		$this->db->or_where('parent_acc_id', '');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 15);
		$this->db->or_where('parent_acc_id', 0);
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 15);
		$query = $this->db->get('accounting_chart_of_accounts');
		return $query->result();
	}

	public function get_cogs_accounts()
	{
		$companyId = logged('company_id');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 13);
		$this->db->where('parent_acc_id', null);
		$this->db->or_where('parent_acc_id', '');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 13);
		$this->db->or_where('parent_acc_id', 0);
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 13);
		$query = $this->db->get('accounting_chart_of_accounts');
		return $query->result();
	}

	public function get_credit_card_accounts()
	{
		$companyId = logged('company_id');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 7);
		$this->db->where('parent_acc_id', null);
		$this->db->where('active', 1);
		$this->db->or_where('parent_acc_id', '');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 7);
		$this->db->where('active', 1);
		$this->db->or_where('parent_acc_id', 0);
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 7);
		$this->db->where('active', 1);
		$query = $this->db->get('accounting_chart_of_accounts');
		return $query->result();
	}

	public function get_bank_accounts()
	{
		$companyId = logged('company_id');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 3);
		$this->db->where('parent_acc_id', null);
		$this->db->where('active', 1);
		$this->db->or_where('parent_acc_id', '');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 3);
		$this->db->where('active', 1);
		$this->db->or_where('parent_acc_id', 0);
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 3);
		$this->db->where('active', 1);
		$query = $this->db->get('accounting_chart_of_accounts');
		return $query->result();
	}

	public function get_other_current_assets_account()
	{
		$companyId = logged('company_id');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 2);
		$this->db->where('parent_acc_id', null);
		$this->db->where('active', 1);
		$this->db->or_where('parent_acc_id', '');
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 2);
		$this->db->where('active', 1);
		$this->db->or_where('parent_acc_id', 0);
		$this->db->where('company_id', $companyId);
		$this->db->where('account_id', 2);
		$this->db->where('active', 1);
		$query = $this->db->get('accounting_chart_of_accounts');
		return $query->result();
	}
}