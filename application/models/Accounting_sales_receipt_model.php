<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_sales_receipt_model extends MY_Model {

	public $table = 'accounting_sales_receipt';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getSalesReceipts(){
	    $query = $this->db->get('accounting_sales_receipt');
	    return $query->result();
    }
	public function createSalesReceipt($data){
	    $query = $this->db->insert('accounting_sales_receipt', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateSalesReceipt($id, $data){
	    $this->db->where('id', $id);
		$query = $this->db->update('accounting_sales_receipt', $data);
		if($query){
			return true;
		}else{
			return false;
		}
    }
	public function deleteSalesReceipt($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_sales_receipt');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getSalesReceiptDetails($id){
	    $query = $this->db->get_where('accounting_sales_receipt', array('id' => $id));
	    return $query->result();
    }
}