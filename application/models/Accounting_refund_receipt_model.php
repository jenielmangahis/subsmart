<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_refund_receipt_model extends MY_Model {

	public $table = 'accounting_refund_receipt';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getRefundReceipts(){
	    $query = $this->db->get('accounting_refund_receipt');
	    return $query->result();
    }
	public function createRefundReceipts($data){
	    $query = $this->db->insert('accounting_refund_receipt', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateRefundReceipt($id, $data){
	    $this->db->where('id', $id);
		$query = $this->db->update('accounting_refund_receipt', $data);
		if($query){
			return true;
		}else{
			return false;
		}
    }
	public function deleteRefundReceipt($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_refund_receipt');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getRefundReceiptDetails($id){
	    $query = $this->db->get_where('accounting_refund_receipt', array('id' => $id));
	    return $query->result();
    }
}