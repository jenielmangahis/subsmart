<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors_model extends MY_Model {

	public $table = 'accounting_vendors';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getAllByCompany($status = [1]) {
		$this->db->where('company_id', logged('company_id'));
		$this->db->where_in('status', $status);
		$this->db->order_by('f_name', 'asc');
		$query = $this->db->get($this->table);

		return $query->result();
	}
	public function getVendors(){
	    $vendor = $this->db->get('accounting_vendors');
	    return $vendor->result();
    }
	public function createVendor($data){
	    $vendor = $this->db->insert('accounting_vendors', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateVendor($id, $data){
		$this->db->where('company_id', logged('company_id'));
	    $this->db->where('id', $id);
		$vendor = $this->db->update('accounting_vendors', $data);
		if($vendor){
			return true;
		}else{
			return false;
		}
    }
	public function updateVendorWithVendorID($id, $data){
	    $this->db->where('vendor_id', $id);
		$vendor = $this->db->update('accounting_vendors', $data);
		if($vendor){
			return true;
		}else{
			return false;
		}
    }
	public function getVendorDetails($id){
	    $vendor = $this->db->get_where('accounting_vendors', array('vendor_id' => $id));
	    return $vendor->result();
    }
	public function getvendortransactions($id){
		$listOfID = array();
		$allData = array();
		
	    $getBill = $this->db->get_where('accounting_bill', array('vendor_id' => $id));
		foreach($getBill->result() as $billRow){
			array_push($listOfID,$billRow->transaction_id);
		}
		
		$getCheck = $this->db->get_where('accounting_check', array('vendor_id' => $id));
		foreach($getCheck->result() as $checkRow){
			array_push($listOfID,$checkRow->transaction_id);
		}
		
		$getExpense = $this->db->get_where('accounting_expense', array('vendor_id' => $id));
		foreach($getExpense->result() as $expenseRow){
			array_push($listOfID,$expenseRow->transaction_id);
		}
		
		$getVendorCredit = $this->db->get_where('accounting_vendor_credit', array('vendor_id' => $id));
		foreach($getVendorCredit->result() as $vendorcreditRow){
			array_push($listOfID,$vendorcreditRow->transaction_id);
		}
		
		if(count($listOfID) > 0){
			$this->db->where_in('id', $listOfID);
			$this->db->order_by('date_created', 'DESC');
			$query = $this->db->get('accounting_expense_transaction');
			
			foreach($query->result() as $row){
				$category = array();

				switch($row->type){
					case 'Bill':
						$getCategory = $this->db->get_where('accounting_expense_category', array('transaction_id' => $row->id));
						foreach($getCategory->result() as $categoryRow){
							
							$categoryData = array(
								'category_id' => $categoryRow->category_id,
								'description' => $categoryRow->description
							);
							array_push($category,$categoryData);
						}
						$queryTransaction = $this->db->get_where('accounting_bill', array('transaction_id' => $row->id));
						$info = $queryTransaction->result();
							$billData = array(
								'transaction_id' => $row->id,
								'type' => $row->type,
								'mailing_address' => $info[0]->mailing_address,
								'terms' => $info[0]->terms,
								'bill_date' => $info[0]->bill_date,
								'due_date' => $info[0]->due_date,
								'bill_number' => $info[0]->bill_number,
								'permit_number' => $info[0]->permit_number,
								'memo' => $info[0]->memo,
								'category' => $category,
								'total' => $row->total,
								'transaction_date_created' => $row->date_created,
								'transaction_date_modified' => $row->date_modified,
							);
							array_push($allData,$billData);
						
					break;
					
					case 'Check':
						$getCategory = $this->db->get_where('accounting_expense_category', array('transaction_id' => $row->id));
						foreach($getCategory->result() as $categoryRow){
							
							$categoryData = array(
								'category_id' => $categoryRow->category_id,
								'description' => $categoryRow->description
							);
							array_push($category,$categoryData);
						}
						$queryTransaction = $this->db->get_where('accounting_check', array('transaction_id' => $row->id));
						$info = $queryTransaction->result();
							$checkData = array(
								'transaction_id' => $row->id,
								'type' => $row->type,
								'mailing_address' => $info[0]->mailing_address,
								'bank_id' => $info[0]->bank_id,
								'payment_date' => $info[0]->payment_date,
								'check_number' => $info[0]->check_number,
								'print_later' => $info[0]->print_later,
								'permit_number' => $info[0]->permit_number,
								'memo' => $info[0]->memo,
								'category' => $category,
								'total' => $row->total,
								'transaction_date_created' => $row->date_created,
								'transaction_date_modified' => $row->date_modified,
							);
							array_push($allData,$checkData);
					break;
					
					case 'Expense':
						$getCategory = $this->db->get_where('accounting_expense_category', array('transaction_id' => $row->id));
						foreach($getCategory->result() as $categoryRow){
							
							$categoryData = array(
								'category_id' => $categoryRow->category_id,
								'description' => $categoryRow->description
							);
							array_push($category,$categoryData);
						}
						$queryTransaction = $this->db->get_where('accounting_expense', array('transaction_id' => $row->id));
						$info = $queryTransaction->result();
							$expenseData = array(
								'transaction_id' => $row->id,
								'type' => $row->type,
								'payment_method' => $info[0]->payment_method,
								'payment_account' => $info[0]->payment_account,
								'payment_date' => $info[0]->payment_date,
								'ref_number' => $info[0]->ref_number,
								'permit_number' => $info[0]->permit_number,
								'memo' => $info[0]->memo,
								'category' => $category,
								'total' => $row->total,
								'transaction_date_created' => $row->date_created,
								'transaction_date_modified' => $row->date_modified,
							);
							array_push($allData,$expenseData);
						
					break;
					
					case 'Vendor Credit':
						$getCategory = $this->db->get_where('accounting_expense_category', array('transaction_id' => $row->id));
						foreach($getCategory->result() as $categoryRow){
							
							$categoryData = array(
								'category_id' => $categoryRow->category_id,
								'description' => $categoryRow->description
							);
							array_push($category,$categoryData);
						}
						$queryTransaction = $this->db->get_where('accounting_vendor_credit', array('transaction_id' => $row->id));
						$info = $queryTransaction->result();
							$vendorcreditData = array(
								'transaction_id' => $row->id,
								'type' => $row->type,
								'mailing_address' => $info[0]->mailing_address,
								'payment_date' => $info[0]->payment_date,
								'ref_number' => $info[0]->ref_number,
								'permit_number' => $info[0]->permit_number,
								'memo' => $info[0]->memo,
								'category' => $category,
								'total' => $row->total,
								'transaction_date_created' => $row->date_created,
								'transaction_date_modified' => $row->date_modified,
							);
							array_push($allData,$vendorcreditData);
						
					break;
				}
			}
		}
		return $allData;
	}

	public function get_vendor_by_id($id)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row();
	}

	public function get_company_contractors($status)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('contractor', 1);
		$this->db->where_in('status', $status);
		$this->db->order_by('display_name', 'asc');
		$query = $this->db->get($this->table);

		return $query->result();
	}

	public function get_contractor($vendorId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $vendorId);
		$this->db->where('contractor', 1);
		return $this->db->get($this->table)->row();
	}

	public function get_contractor_types()
	{
		return $this->db->get('accounting_contractor_types')->result();
	}

	public function update_contractor($vendorId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $vendorId);
		$update = $this->db->update($this->table, $data);

		return $update;
	}

	public function update_contractor_status($contractorId, $status)
	{
		$this->db->where('id', $contractorId);
		$update = $this->db->update($this->table, ['status' => $status, 'updated_at' => date("Y-m-d H:i:s")]);

		return $update;
	}

	public function get_vendor_bill_transactions($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('vendor_id', $vendorId);
		if($filters['start-date']) {
			$this->db->where('bill_date >=', $filters['start-date']);
			$this->db->where('bill_date <=', $filters['end-date']);
		}
		if(isset($filters['status'])) {
			if(is_array($filters['status'])) {
				$this->db->where_in('status', $filters['status']);
			} else {
				$this->db->where('status', $filters['status']);
			}
		} else {
			$this->db->where('status', 1);
		}

		$query = $this->db->get('accounting_bill');

		return $query->result();
	}

	public function get_vendor_check_transactions($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('payee_type', 'vendor');
		$this->db->where('payee_id', $vendorId);
		if($filters['start-date']) {
			$this->db->where('payment_date >=', $filters['start-date']);
			$this->db->where('payment_date <=', $filters['end-date']);
		}
		if(isset($filters['status'])) {
			if(is_array($filters['status'])) {
				$this->db->where_in('status', $filters['status']);
			} else {
				$this->db->where('status', $filters['status']);
			}
		} else {
			$this->db->where('status', 1);
		}

		$query = $this->db->get('accounting_check');

		return $query->result();
	}

	public function get_vendor_expense_transactions($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('payee_type', 'vendor');
		$this->db->where('payee_id', $vendorId);
		if(isset($filters['start-date'])) {
			$this->db->where('payment_date >=', $filters['start-date']);
			$this->db->where('payment_date <=', $filters['end-date']);
		}
		if(isset($filters['status'])) {
			if(is_array($filters['status'])) {
				$this->db->where_in('status', $filters['status']);
			} else {
				$this->db->where('status', $filters['status']);
			}
		} else {
			$this->db->where('status', 1);
		}
		
		$query = $this->db->get('accounting_expense');

		return $query->result();
	}

	public function get_vendor_credit_card_payments($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('payee_id', $vendorId);
		if(isset($filters['start-date'])) {
			$this->db->where('date >=', $filters['start-date']);
			$this->db->where('date <=', $filters['end-date']);
		}

		$query = $this->db->get('accounting_pay_down_credit_card');

		return $query->result();
	}

	public function get_vendor_purchase_orders($vendorId, $filters = [])
	{
		$this->db->where('vendor_id', $vendorId);
		if(isset($filters['start-date'])) {
			$this->db->where('purchase_order_date >=', $filters['start-date']);
			$this->db->where('purchase_order_date <=', $filters['end-date']);
		}
		$query = $this->db->get('accounting_purchase_order');
		return $query->result();
	}
}