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
		$this->db->order_by('credit_memo_date', 'desc');
		$this->db->where('status', 1);
		$query = $this->db->get($this->table);
		return $query->result();
	}
}