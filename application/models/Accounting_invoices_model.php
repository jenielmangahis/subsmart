<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_invoices_model extends MY_Model {

	public $table = 'accounting_invoices';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getInvoices(){
	    $vendor = $this->db->get('accounting_invoices');
	    return $vendor->result();
    }
	public function createInvoice($data,$data2){
	    $vendor = $this->db->insert('accounting_invoices', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateInvoice($id, $data){
	    $this->db->where('id', $id);
		$vendor = $this->db->update('accounting_invoices', $data);
		if($vendor){
			return true;
		}else{
			return false;
		}
    }
	public function deleteInvoice($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_invoices');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getInvoiceDetails($id){
	    $vendor = $this->db->get_where('accounting_invoices', array('id' => $id));
	    return $vendor->result();
    }
}