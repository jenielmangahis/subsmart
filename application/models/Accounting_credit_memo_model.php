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
	    return $vendor->result();
    }
}