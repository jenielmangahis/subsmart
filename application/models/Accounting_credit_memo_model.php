<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_credit_memo_model extends MY_Model {

	public $table = 'accounting_credit_memo';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getCreditMemos(){
	    $vendor = $this->db->get('accounting_credit_memo');
	    return $vendor->result();
    }
	public function createCreditMemo($data){
	    $vendor = $this->db->insert('accounting_credit_memo', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateCreditMemo($id, $data){
	    $this->db->where('id', $id);
		$vendor = $this->db->update('accounting_credit_memo', $data);
		if($vendor){
			return true;
		}else{
			return false;
		}
    }
	public function deleteCreditMemo($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_credit_memo');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getCreditMemoDetails($id){
	    $vendor = $this->db->get_where('accounting_credit_memo', array('id' => $id));
	    return $vendor->row();
    }

	public function getAllByCompany($company_id)
	{
		$this->db->select('*');
        $this->db->from('accounting_credit_memo');
        // $this->db->where('company_id', $company_id);
		$this->db->join('acs_profile', 'accounting_credit_memo.customer_id  = acs_profile.prof_id');
        $this->db->where('accounting_credit_memo.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
	}

	public function insert_transaction_item($item)
	{
		$this->db->insert('accounting_customer_transaction_items', $item);
		return $this->db->insert_id();
	}

	public function insert_transaction_items($items)
	{
		$this->db->insert_batch('accounting_customer_transaction_items', $items);
		return $this->db->insert_id();
	}

	public function get_company_credit_memos($filters = [])
	{
		$this->db->where('company_id', $filters['company_id']);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$query = $this->db->get($this->table);
        return $query->result();
	}

	public function get_customer_transaction_items($transactionType, $transactionId)
	{
		$this->db->where('transaction_type', $transactionType);
		$this->db->where('transaction_id', $transactionId);
		$query = $this->db->get('accounting_customer_transaction_items');
		return $query->result();
	}

	public function update_customer_transaction_item($transacItemId, $transacItemData)
	{
		$this->db->where('id', $transacItemId);
		$update = $this->db->update('accounting_customer_transaction_items', $transacItemData);
		return $update;
	}

	public function delete_customer_transaction_item($transactionItemId, $transactionType)
	{
		$this->db->where('id', $transactionItemId);
		$this->db->where('transaction_type', $transactionType);
		$delete = $this->db->delete('accounting_customer_transaction_items');
		return $delete;
	}

	public function get_customer_open_credit_memos($filters = [])
	{
		if(isset($filters['customer_id'])) {
            $this->db->where('customer_id', $filters['customer_id']);
        }

		if(isset($filters['from_date'])) {
            $this->db->where('credit_memo_date >=', $filters['from_date']);
        }

        if(isset($filters['to_date'])) {
            $this->db->where('credit_memo_date <=', $filters['to_date']);
        }

		$this->db->where('balance >', 0);
		$this->db->order_by('credit_memo_date', 'asc');
		$this->db->where('status', 1);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_credit_memo_payments($creditMemoId)
	{
		$this->db->select('accounting_receive_payment_credits.*');
		$this->db->where('accounting_receive_payment_credits.credit_memo_id', $creditMemoId);
		$this->db->where('accounting_receive_payment.status', 1);
		$this->db->join('accounting_receive_payment', 'accounting_receive_payment.id = accounting_receive_payment_credits.receive_payment_id');
		$query = $this->db->get('accounting_receive_payment_credits');
		return $query->result();
	}

	public function delete_customer_transaction_items($transactionType, $transactionId)
	{
		$this->db->where('transaction_type', $transactionType);
		$this->db->where('transaction_id', $transactionId);
		$delete = $this->db->delete('accounting_customer_transaction_items');
		return $delete;
	}

	public function get_transaction_item_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('accounting_customer_transaction_items');
		return $query->row();
	}

	public function get_customer_credit_memos($data)
    {
        $this->db->where('company_id', $data['company_id']);
        $this->db->where('customer_id', $data['customer_id']);

		if(isset($data['start_date'])) {
			$this->db->where('credit_memo_date >=', $data['start_date']);
		}
		if(isset($data['end_date'])) {
			$this->db->where('credit_memo_date <=', $data['end_date']);
		}
        $query = $this->db->get('accounting_credit_memo');
        return $query->result();
    }
}