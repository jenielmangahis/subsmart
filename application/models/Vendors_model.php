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
	public function get_vendors_with_unbilled_po($status = [1])
	{
		$companyId = logged('company_id');

		$this->db->select('accounting_vendors.*');
		$this->db->where('accounting_vendors.company_id', $companyId);
		$this->db->where_in('accounting_vendors.status', $status);
		$this->db->where('accounting_purchase_order.status', 1);
		$this->db->where('accounting_purchase_order.purchase_order_date >=', date("Y-m-d", strtotime("-365 days")));
		$this->db->order_by('accounting_vendors.f_name', 'asc');
		$this->db->from($this->table);
		$this->db->join('accounting_purchase_order', 'accounting_purchase_order.vendor_id = accounting_vendors.id');
		$query = $this->db->get();

		return $query->result();
	}
	public function get_vendors_with_open_bills($status = [1])
	{
		$companyId = logged('company_id');

		$this->db->select('accounting_vendors.*');
		$this->db->where('accounting_vendors.company_id', $companyId);
		$this->db->where_in('accounting_vendors.status', $status);
		$this->db->where('accounting_bill.status', 1);
		$this->db->where('accounting_bill.bill_date >=', date("Y-m-d", strtotime("-365 days")));
		$this->db->order_by('accounting_vendors.f_name', 'asc');
		$this->db->from($this->table);
		$this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id');
		$query = $this->db->get();

		return $query->result();
	}
	public function get_vendors_with_overdue_bills($status = [1])
	{
		$companyId = logged('company_id');

		$this->db->select('accounting_vendors.*');
		$this->db->where('accounting_vendors.company_id', $companyId);
		$this->db->where_in('accounting_vendors.status', $status);
		$this->db->where('accounting_bill.status', 1);
        $this->db->where('accounting_bill.due_date <', date("Y-m-d"));
		$this->db->where('accounting_bill.bill_date >=', date("Y-m-d", strtotime("-365 days")));
		$this->db->order_by('accounting_vendors.f_name', 'asc');
		$this->db->from($this->table);
		$this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id');
		$query = $this->db->get();

		return $query->result();
	}
	public function get_vendors_with_payments($status = [1])
	{
		$companyId = logged('company_id');
		$startDate = date("Y-m-d", strtotime("-30 days"));

		$this->db->select('accounting_vendors.*');
		$this->db->where('accounting_vendors.company_id', $companyId);
		$this->db->where_in('accounting_vendors.status', $status);
		$this->db->where('accounting_bill_payments.status', 1);
		$this->db->where('accounting_bill_payments.payment_date >=', $startDate);

		$this->db->or_where('accounting_vendors.company_id', $companyId);
		$this->db->where_in('accounting_vendors.status', $status);
		$this->db->where('accounting_expense.status', 1);
		$this->db->where('accounting_expense.payee_type', 'vendor');
		$this->db->where('accounting_expense.payment_date >=', $startDate);

		$this->db->or_where('accounting_check.status', 1);
		$this->db->where('accounting_check.payee_type', 'vendor');
		$this->db->where('accounting_vendors.company_id', $companyId);
		$this->db->where_in('accounting_vendors.status', $status);
		$this->db->where('accounting_check.payment_date >=', $startDate);

		$this->db->or_where('accounting_pay_down_credit_card.status', 1);
		$this->db->where('accounting_vendors.company_id', $companyId);
		$this->db->where_in('accounting_vendors.status', $status);
		$this->db->where('accounting_pay_down_credit_card.date >=', $startDate);

		$this->db->order_by('accounting_vendors.f_name', 'asc');
		$this->db->from($this->table);
		$this->db->join('accounting_bill_payments', 'accounting_bill_payments.payee_id = accounting_vendors.id', 'left');
		$this->db->join('accounting_expense', 'accounting_expense.payee_id = accounting_vendors.id', 'left');
		$this->db->join('accounting_check', 'accounting_check.payee_id = accounting_vendors.id', 'left');
		$this->db->join('accounting_pay_down_credit_card', 'accounting_pay_down_credit_card.payee_id = accounting_vendors.id', 'left');
		$query = $this->db->get();

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

	public function update_multiple_vendor_by_id($data)
	{
		return $this->db->update_batch($this->table, $data, 'id');
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
		$this->db->where('recurring', null);
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
			$this->db->where('status !=', 0);
		}

		$query = $this->db->get('accounting_bill');

		return $query->result();
	}

	public function get_vendor_check_transactions($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('payee_type', 'vendor');
		$this->db->where('payee_id', $vendorId);
		$this->db->where('recurring', null);
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
			$this->db->where('status !=', 0);
		}

		$query = $this->db->get('accounting_check');

		return $query->result();
	}

	public function get_vendor_expense_transactions($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('payee_type', 'vendor');
		$this->db->where('payee_id', $vendorId);
		$this->db->where('recurring', null);
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
			$this->db->where('status !=', 0);
		}

		$this->db->order_by('created_at', $filters['order']);
		
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
		$this->db->where('status !=', 0);
		$this->db->order_by('created_at', $filters['order']);

		$query = $this->db->get('accounting_pay_down_credit_card');

		return $query->result();
	}

	public function get_vendor_purchase_orders($vendorId, $filters = [])
	{
		$this->db->where('vendor_id', $vendorId);
		$this->db->where('recurring', null);
		if(isset($filters['start-date'])) {
			$this->db->where('purchase_order_date >=', $filters['start-date']);
			$this->db->where('purchase_order_date <=', $filters['end-date']);
		}
		$this->db->where('status', 1);
		$this->db->order_by('created_at', $filters['order']);
		$query = $this->db->get('accounting_purchase_order');
		return $query->result();
	}

	public function get_vendor_bill_payments($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('payee_id', $vendorId);
		$this->db->where('status !=', 0);
		$this->db->order_by('created_at', $filters['order']);
		return $this->db->get('accounting_bill_payments')->result();
	}

	public function get_vendor_paid_bills($vendorId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('vendor_id', $vendorId);
		$this->db->where('status', 2);
		$this->db->order_by('created_at', $filters['order']);

		$query = $this->db->get('accounting_bill');

		return $query->result();
	}

	public function get_vendor_open_bills($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('vendor_id', $vendorId);
		$this->db->where('status', 1);
		$this->db->where('recurring', null);
		if(isset($filters['start-date'])) {
			$this->db->where('bill_date >=', $filters['start-date']);
			$this->db->where('bill_date <=', $filters['end-date']);
		}
		if(isset($filters['overdue']) && $filters['overdue'] === "true") {
			$this->db->where('due_date <', date("Y-m-d"));
		}
		$this->db->order_by('created_at', $filters['order']);

		$query = $this->db->get('accounting_bill');

		return $query->result();
	}

	public function get_vendor_overdue_bills($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('vendor_id', $vendorId);
		$this->db->where('status', 1);
		if(isset($filters['start-date'])) {
			$this->db->where('due_date >=', $filters['start-date']);
			$this->db->where('due_date <=', $filters['end-date']);
		}
		$this->db->order_by('created_at', $filters['order']);

		$query = $this->db->get('accounting_bill');

		return $query->result();
	}

	public function get_vendor_credit_transactions($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('vendor_id', $vendorId);
		$this->db->where('recurring', null);
		if(isset($filters['start-date'])) {
			$this->db->where('payment_date >=', $filters['start-date']);
			$this->db->where('payment_date <=', $filters['end-date']);
		}
		$this->db->where('status !=', 0);
		$this->db->order_by('created_at', $filters['order']);

		$query = $this->db->get('accounting_vendor_credit');

		return $query->result();
	}

	public function get_vendor_cc_credit_transactions($vendorId, $filters = [])
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('payee_type', 'vendor');
		$this->db->where('payee_id', $vendorId);
		$this->db->where('recurring', null);
		if(isset($filters['start-date'])) {
			$this->db->where('payment_date >=', $filters['start-date']);
			$this->db->where('payment_date <=', $filters['end-date']);
		}
		$this->db->order_by('created_at', $filters['order']);

		$query = $this->db->get('accounting_credit_card_credits');

		return $query->result();
	}

	public function update_transaction_category($data)
	{
		$this->db->where('transaction_type', $data['transaction_type']);
		$this->db->where('transaction_id', $data['transaction_id']);
		$update = $this->db->update('accounting_vendor_transaction_categories', ['expense_account_id' => $data['new_category']]);

		return $update;
	}

	public function get_expense_by_id($expenseId, $companyId = null)
	{
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $expenseId);
		$query = $this->db->get('accounting_expense');
		return $query->row();
	}

	public function update_expense($expenseId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $expenseId);
		$update = $this->db->update('accounting_expense', $data);
		return $update;
	}

	public function get_company_last_check($companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('status', 1);
		$this->db->where_not_in('check_no', ['', null]);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get('accounting_check');
		return $query->row();
	}

	public function get_check_by_id($checkId, $companyId = null)
	{
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $checkId);
		$query = $this->db->get('accounting_check');
		return $query->row();
	}

	public function get_check_by_comp($company_id)
	{
		$this->db->where('company_id', $company_id);
		$query = $this->db->get('accounting_check');
		return $query->result();
	}

	public function update_check($checkId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $checkId);
		$update = $this->db->update('accounting_check', $data);
		return $update;
	}

	public function get_company_last_bill($companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('status', 1);
		$this->db->where_not_in('check_no', ['', null]);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get('accounting_bill');
		return $query->row();
	}

	public function get_bill_by_id($billId, $companyId = null)
	{
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $billId);
		$query = $this->db->get('accounting_bill');
		return $query->row();
	}

	public function get_bill_payment_by_id($billPaymentId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $billPaymentId);
		$query = $this->db->get('accounting_bill_payments');
		return $query->row();
	}

	public function update_bill_payment($billPaymentId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $billPaymentId);
		$update = $this->db->update('accounting_bill_payments', $data);
		return $update;
	}

	public function delete_bill_payment_items($billPaymentId)
	{
		$this->db->where('bill_payment_id', $billPaymentId);
		$delete = $this->db->delete('accounting_bill_payment_items');
		return $delete;
	}

	public function get_bill_payments_by_bill_id($billId)
	{
		$this->db->select('*');
		$this->db->where('accounting_bill_payments.company_id', logged('company_id'));
		$this->db->where('accounting_bill_payment_items.bill_id', $billId);
		$this->db->from('accounting_bill_payments');
		$this->db->join('accounting_bill_payment_items', 'accounting_bill_payment_items.bill_payment_id = accounting_bill_payments.id');
		return $this->db->get()->result();
	}

	public function get_bill_payment_items($billPaymentId)
	{
		$this->db->where('bill_payment_id', $billPaymentId);
		$query = $this->db->get('accounting_bill_payment_items');
		return $query->result();
	}

	public function get_bill_payment_item_by_bill_id($billPaymentId, $billId)
	{
		$this->db->where('bill_payment_id', $billPaymentId);
		$this->db->where('bill_id', $billId);
		$query = $this->db->get('accounting_bill_payment_items');
		return $query->row();
	}

	public function update_bill($billId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $billId);
		$update = $this->db->update('accounting_bill', $data);
		return $update;
	}

	public function get_purchase_order_by_id($purchaseOrderId, $companyId = null)
	{
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $purchaseOrderId);
		$query = $this->db->get('accounting_purchase_order');
		return $query->row();
	}

	public function update_purchase_order($purchaseOrderId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $purchaseOrderId);
		$update = $this->db->update('accounting_purchase_order', $data);
		return $update;
	}

	public function get_vendor_credit_by_id($vendorCreditId, $companyId = null)
	{
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $vendorCreditId);
		$query = $this->db->get('accounting_vendor_credit');
		return $query->row();
	}

	public function update_vendor_credit($vendorCreditId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $vendorCreditId);
		$update = $this->db->update('accounting_vendor_credit', $data);
		return $update;
	}

	public function get_credit_card_payment_by_id($ccPaymentId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $ccPaymentId);
		$query = $this->db->get('accounting_pay_down_credit_card');
		return $query->row();
	}

	public function update_credit_card_payment($ccPaymentId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $ccPaymentId);
		$update = $this->db->update('accounting_pay_down_credit_card', $data);
		return $update;
	}

	public function get_credit_card_credit_by_id($ccCreditId, $companyId = null)
	{
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $ccCreditId);
		$query = $this->db->get('accounting_credit_card_credits');
		return $query->row();
	}

	public function update_credit_card_credit($ccCreditId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $ccCreditId);
		$update = $this->db->update('accounting_credit_card_credits', $data);
		return $update;
	}

	public function get_bill_payment_bills_by_vendor_id($billPaymentId, $vendorId, $filters = [])
	{
		$this->db->select('accounting_bill.*');
		$this->db->where('accounting_bill.vendor_id', $vendorId);
		$this->db->where('accounting_bill_payment_items.bill_payment_id', $billPaymentId);
		if(isset($filters['from']) && !is_null($filters['from'])) {
			$this->db->where('accounting_bill.bill_date >=', $filters['from']);
		}
		if(isset($filters['to'])  && !is_null($filters['to'])) {
			$this->db->where('accounting_bill.bill_date <=', $filters['to']);
		}
		if($filters['overdue']) {
			$this->db->where('accounting_bill.due_date <', date("Y-m-d"));
		}
		$this->db->order_by('accounting_bill.bill_date', 'asc');
		$this->db->from('accounting_bill');
		$this->db->join('accounting_bill_payment_items', 'accounting_bill_payment_items.bill_id = accounting_bill.id');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_bill_payment_bills($billPaymentId, $filters = [])
	{
		$this->db->select('accounting_bill.*');
		$this->db->where('accounting_bill_payment_items.bill_payment_id', $billPaymentId);

		if(isset($filters['from']) && !is_null($filters['from'])) {
			$this->db->where('accounting_bill.bill_date >=', $filters['from']);
		}

		if(isset($filters['to'])  && !is_null($filters['to'])) {
			$this->db->where('accounting_bill.bill_date <=', $filters['to']);
		}

		if($filters['overdue']) {
			$this->db->where('accounting_bill.due_date <', date("Y-m-d"));
		}

		$this->db->order_by('accounting_bill.bill_date', 'asc');
		$this->db->from('accounting_bill');
		$this->db->join('accounting_bill_payment_items', 'accounting_bill_payment_items.bill_id = accounting_bill.id');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_multiple_category_by_id($data)
	{
		return $this->db->update_batch('accounting_vendor_transaction_categories', $data, 'id');
	}

	public function update_transaction_category_details($id, $data)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('accounting_vendor_transaction_categories', $data);
		return $update;
	}

	public function update_transaction_item($id, $data)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('accounting_vendor_transaction_items', $data);
		return $update ? true : false;
	}

	public function delete_transaction_category($id, $transactionType)
	{
		$this->db->where('id', $id);
		$this->db->where('transaction_type', $transactionType);
		$delete = $this->db->delete('accounting_vendor_transaction_categories');
		return $delete ? true : false;
	}

	public function delete_transaction_item($id, $transactionType)
	{
		$this->db->where('id', $id);
		$this->db->where('transaction_type', $transactionType);
		$delete = $this->db->delete('accounting_vendor_transaction_items');
		return $delete ? true : false;
	}

	public function get_data_in_invoice($company_id){
		$query = $this->db->get('invoices');
		return $query->result();
	}
	public function get_data_in_arpi($company_id){
		$this->db->select('customer_email, date_issued, grand_total');
		$this->db->from('invoices');
		$this->db->join('accounting_receive_payment_invoices', 'invoice_id = invoices.id');

		$query = $this->db->get();
		return $query->result();
	}

	public function savecashflowplan($new_data){
	
        $vendor = $this->db->insert('cashflow_planned', $new_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
	public function update_cashflow_date_amount($id,$data){
        $updateCashFlow = $this->db->update('cashflow_planned', $data, array('id' => $id));
		$insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function update_invoice_date_amount($id,$data){
        $updateCashFlow = $this->db->update('invoices', $data, array('id' => $id));
		$insert_id = $this->db->insert_id();

		return  $insert_id;
    }

	public function remove_cashflow_customer($id){
		$getId = $this->db->where('id', $id);
		$removeID = $this->db->delete('cashflow_planned');	
	}

	public function getcashflowplan($company_id)
	{
		// $this->db->where('company_id', $company_id);
		$query = $this->db->get('cashflow_planned');
		return $query->result();
	}

	public function addcashflowplan($company_id){
		
	}

	public function save_role($new_data){
        // $vendor = $this->db->insert('employee_role', $new_data);
		$vendor = $this->db->insert('roles', $new_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

	public function getRoles($company_id)
	{
		// $query = $this->db->get('employee_role');
		// $query = $this->db->get('roles');
		// return $query->result();

		$where = array(
            'company_id'      => $company_id,
          );

        $this->db->select('*');
        // $this->db->from('employee_role');
		$this->db->from('roles');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
	}

	public function getRoleAmount($id)
	{
		$where = array(
            'id'      => $id,
          );

        $this->db->select('role_amount');
        // $this->db->from('employee_role');
		$this->db->from('roles');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
	}

	public function getEmployees($company_id)
	{
		$where = array(
            'users.company_id'      => $company_id,
          );

        $this->db->select('*, users.id AS uid');
		$this->db->from('users');
		$this->db->join('roles', 'users.role  = roles.id');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
	}

	public function getEmployeeByID($id)
	{
		$where = array(
            'users.id'      => $id,
          );

        $this->db->select('*');
		$this->db->from('users');
		$this->db->join('roles', 'users.role  = roles.id');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
	}
}