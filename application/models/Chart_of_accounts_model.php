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

	public function get_by_name($name)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('name', $name);
		$query = $this->db->get($this->table);
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
		$this->db->order_by('name', 'asc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getChildAccounts($parentAccId, $status = [1], $exemptedID = null)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where_in('active', $status);
		$this->db->where('parent_acc_id', $parentAccId);
		if($exemptedID) {
			$this->db->where('id !=', $exemptedID);
		}
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function getFilteredAccounts($status, $order = 'asc', $orderColumn = 'name')
	{
		$company_id = logged('company_id');
		$this->db->where('accounting_chart_of_accounts.company_id', $company_id);
		$this->db->where_in('accounting_chart_of_accounts.active', $status);

		if($orderColumn !== 'nsmartrac_balance') {
			$this->db->where('accounting_chart_of_accounts.parent_acc_id', null);
		}

		$this->db->or_where('accounting_chart_of_accounts.company_id', $company_id);
		$this->db->where_in('accounting_chart_of_accounts.active', $status);

		if($orderColumn !== 'nsmartrac_balance') {
			$this->db->where('accounting_chart_of_accounts.parent_acc_id', 0);
		}

		$this->db->or_where('accounting_chart_of_accounts.company_id', $company_id);
		$this->db->where_in('accounting_chart_of_accounts.active', $status);

		if($orderColumn !== 'nsmartrac_balance') {
			$this->db->where('accounting_chart_of_accounts.parent_acc_id', '');
		}

		switch($orderColumn) {
			case 'nsmartrac_balance' :
				$this->db->order_by('balance', $order);
				$this->db->order_by('name', 'asc');
			break;
			case 'name' :
				$this->db->order_by('name', $order);
			break;
			default :
				$this->db->select('accounting_chart_of_accounts.*, account.account_name');
				$this->db->join('account', 'account.id = accounting_chart_of_accounts.account_id');
				$this->db->order_by('account.account_name', $order);
				$this->db->order_by('accounting_chart_of_accounts.name', 'asc');
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

	public function get_checks_registers($accountId)
	{
		$this->db->where('bank_account_id', $accountId);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$query = $this->db->get('accounting_check');
		return $query->result();
	}

	public function get_invoice_item_registers($accountId)
	{
		$this->db->select('invoices_items.*');
		$this->db->where('items_accounting_details.income_account_id', $accountId);
		$this->db->join('invoices', 'invoices.id = invoices_items.invoice_id');
		$this->db->join('items_accounting_details', 'items_accounting_details.item_id = invoices_items.items_id');
		$query = $this->db->get('invoices_items');
		return $query->result();
	}

	public function get_receive_payment_registers($accountId)
	{
		$this->db->where('deposit_to', $accountId);
		$this->db->where('status !=', 0);
		$query = $this->db->get('accounting_receive_payment');
		return $query->result();
	}

	public function get_journal_entry_registers($accountId)
	{
		$this->db->select('accounting_journal_entry_items.*');
		$this->db->from('accounting_journal_entry_items');
		$this->db->where('accounting_journal_entry_items.account_id', $accountId);
		$this->db->where('accounting_journal_entries.status !=', 0);
		$this->db->where('accounting_journal_entries.recurring', null);
		$this->db->join('accounting_journal_entries', 'accounting_journal_entries.id = accounting_journal_entry_items.journal_entry_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_vendor_transaction_item_registers($accountId, $transactionType)
	{
		$this->db->select('accounting_vendor_transaction_items.*');
		$this->db->from('accounting_vendor_transaction_items');
		$this->db->where('items_accounting_details.inv_asset_acc_id', $accountId);
		$this->db->where('accounting_vendor_transaction_items.transaction_type', $transactionType);
		$this->db->join('items_accounting_details', 'items_accounting_details.item_id = accounting_vendor_transaction_items.item_id');

		switch($transactionType) {
			case 'Expense' :
				$this->db->where('accounting_expense.status !=', 0);
				$this->db->where('accounting_expense.recurring', null);
				$this->db->join('accounting_expense', 'accounting_expense.id = accounting_vendor_transaction_items.transaction_id');
			break;
			case 'Check' :
				$this->db->where('accounting_check.status !=', 0);
				$this->db->where('accounting_check.recurring', null);
				$this->db->join('accounting_check', 'accounting_check.id = accounting_vendor_transaction_items.transaction_id');
			break;
			case 'Bill' :
				$this->db->where('accounting_bill.status !=', 0);
				$this->db->where('accounting_bill.recurring', null);
				$this->db->join('accounting_bill', 'accounting_bill.id = accounting_vendor_transaction_items.transaction_id');
			break;
			case 'Purchase Order' :
				$this->db->where('accounting_purchase_order.status !=', 0);
				$this->db->where('accounting_purchase_order.recurring', null);
				$this->db->join('accounting_purchase_order', 'accounting_purchase_order.id = accounting_vendor_transaction_items.transaction_id');
			break;
			case 'Vendor Credit' :
				$this->db->where('accounting_vendor_credit.status !=', 0);
				$this->db->where('accounting_vendor_credit.recurring', null);
				$this->db->join('accounting_vendor_credit', 'accounting_vendor_credit.id = accounting_vendor_transaction_items.transaction_id');
			break;
			case 'Credit Card Credit' :
				$this->db->where('accounting_credit_card_credits.status !=', 0);
				$this->db->where('accounting_credit_card_credits.recurring', null);
				$this->db->join('accounting_credit_card_credits', 'accounting_credit_card_credits.id = accounting_vendor_transaction_items.transaction_id');
			break;
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_vendor_transaction_category_registers($accountId, $transactionType)
	{
		$this->db->select('accounting_vendor_transaction_categories.*');
		$this->db->from('accounting_vendor_transaction_categories');
		$this->db->where('accounting_vendor_transaction_categories.expense_account_id', $accountId);
		$this->db->where('accounting_vendor_transaction_categories.transaction_type', $transactionType);

		switch($transactionType) {
			case 'Expense' :
				$this->db->where('accounting_expense.status !=', 0);
				$this->db->where('accounting_expense.recurring', null);
				$this->db->join('accounting_expense', 'accounting_expense.id = accounting_vendor_transaction_categories.transaction_id');
			break;
			case 'Check' :
				$this->db->where('accounting_check.status !=', 0);
				$this->db->where('accounting_check.recurring', null);
				$this->db->join('accounting_check', 'accounting_check.id = accounting_vendor_transaction_categories.transaction_id');
			break;
			case 'Bill' :
				$this->db->where('accounting_bill.status !=', 0);
				$this->db->where('accounting_bill.recurring', null);
				$this->db->join('accounting_bill', 'accounting_bill.id = accounting_vendor_transaction_categories.transaction_id');
			break;
			case 'Purchase Order' :
				$this->db->where('accounting_purchase_order.status !=', 0);
				$this->db->where('accounting_purchase_order.recurring', null);
				$this->db->join('accounting_purchase_order', 'accounting_purchase_order.id = accounting_vendor_transaction_categories.transaction_id');
			break;
			case 'Vendor Credit' :
				$this->db->where('accounting_vendor_credit.status !=', 0);
				$this->db->where('accounting_vendor_credit.recurring', null);
				$this->db->join('accounting_vendor_credit', 'accounting_vendor_credit.id = accounting_vendor_transaction_categories.transaction_id');
			break;
			case 'Credit Card Credit' :
				$this->db->where('accounting_credit_card_credits.status !=', 0);
				$this->db->where('accounting_credit_card_credits.recurring', null);
				$this->db->join('accounting_credit_card_credits', 'accounting_credit_card_credits.id = accounting_vendor_transaction_categories.transaction_id');
			break;
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function get_credit_card_credit_registers($accountId)
	{
		$this->db->where('bank_credit_account_id', $accountId);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$query = $this->db->get('accounting_credit_card_credits');
		return $query->result();
	}

	public function get_transfer_registers($accountId)
	{
		$this->db->where('transfer_from_account_id', $accountId);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$this->db->or_where('transfer_to_account_id', $accountId);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$query = $this->db->get('accounting_transfer_funds_transaction');
		return $query->result();
	}

	public function get_deposit_registers($accountId)
	{
		$this->db->where('account_id', $accountId);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$this->db->or_where('cash_back_account_id', $accountId);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$query = $this->db->get('accounting_bank_deposit');
		return $query->result();
	}

	public function get_deposit_payment_registers($accountId)
	{
		$this->db->select('accounting_bank_deposit_funds.*');
		$this->db->from('accounting_bank_deposit_funds');
		$this->db->where('accounting_bank_deposit_funds.received_from_account_id', $accountId);
		$this->db->where('accounting_bank_deposit.status !=', 0);
		$this->db->where('accounting_bank_deposit.recurring', null);
		$this->db->join('accounting_bank_deposit', 'accounting_bank_deposit.id = accounting_bank_deposit_funds.bank_deposit_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_sales_receipt_registers($accountId)
	{
		$this->db->where('deposit_to_account', $accountId);
		$this->db->where('status !=', 0);
		$query= $this->db->get('accounting_sales_receipt');
		return $query->result();
	}

	public function get_credit_memo_registers($accountId)
	{
		$this->db->select('item_details.*');
		$this->db->where('items_accounting_details.income_account_id', $accountId);
		$this->db->where('accounting_credit_memo.status !=', 0);
		$this->db->where('item_details.type', 'Credit Memo');
		$this->db->join('accounting_credit_memo', 'accounting_credit_memo.id = item_details.type_id');
		$this->db->join('items_accounting_details', 'items_accounting_details.item_id = item_details.item');
		$query = $this->db->get('item_details');
		return $query->result();
	}

	public function get_refund_from_registers($accountId)
	{
		$this->db->where('refund_form', $accountId);
		$this->db->where('status !=', 0);
		$query = $this->db->get('accounting_refund_receipt');
		return $query->result();
	}

	public function get_refund_item_registers($accountId)
	{
		$this->db->select('item_details.*');
		$this->db->where('items_accounting_details.income_account_id', $accountId);
		$this->db->where('accounting_refund_receipt.status !=', 0);
		$this->db->where('item_details.type', 'Refund Receipt');
		$this->db->join('accounting_refund_receipt', 'accounting_refund_receipt.id = item_details.type_id');
		$this->db->join('items_accounting_details', 'items_accounting_details.item_id = item_details.item');
		$query = $this->db->get('item_details');
		return $query->result();
	}

	public function get_qty_adjustments_registers($accountId)
	{
		$this->db->where('inventory_adjustment_account_id', $accountId);
		$this->db->where('status !=', 0);
		$query = $this->db->get('accounting_inventory_qty_adjustments');
		return $query->result();
	}

	public function get_qty_adjustment_item_registers($accountId)
	{
		$this->db->select('*');
		$this->db->from('accounting_inventory_qty_adjustment_items');
		$this->db->where('items_accounting_details.inv_asset_acc_id', $accountId);
		$this->db->where('accounting_inventory_qty_adjustments.status !=', 0);
		$this->db->join('items_accounting_details', 'items_accounting_details.item_id = accounting_inventory_qty_adjustment_items.product_id');
		$this->db->join('accounting_inventory_qty_adjustments', 'accounting_inventory_qty_adjustments.id = accounting_inventory_qty_adjustment_items.adjustment_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_expense_registers($accountId)
	{
		$this->db->where('payment_account_id', $accountId);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$query = $this->db->get('accounting_expense');
		return $query->result();
	}

	public function get_adjustment_acc_starting_value_registers($accountId)
	{
		$this->db->where('inv_adj_account', $accountId);
		$this->db->where('status !=', 0);
		$query = $this->db->get('accounting_item_starting_value_adjustment');
		return $query->result();
	}

	public function get_adjusted_starting_value_registers($accountId)
	{
		$this->db->where('inv_asset_account', $accountId);
		$this->db->where('status !=', 0);
		$query = $this->db->get('accounting_item_starting_value_adjustment');
		return $query->result();
	}

	public function get_credit_card_payment_registers($accountId)
	{
		$this->db->where('credit_card_id', $accountId);
		$this->db->or_where('bank_account_id', $accountId);
		$this->db->where('status !=', 0);
		$query = $this->db->get('accounting_pay_down_credit_card');
		return $query->result();
	}

	public function get_bill_payment_registers($accountId)
	{
		$this->db->where('payment_account_id', $accountId);
		$this->db->where('status !=', 0);
		$query = $this->db->get('accounting_bill_payments');
		return $query->result();
	}

	public function get_company_active_accounts($companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('active', 1);
		$query = $this->db->get($this->table);
		return $query->result();
	}
}