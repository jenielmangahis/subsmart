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
	public function createInvoice($data){
	    $vendor = $this->db->insert('accounting_invoice', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
	}
	public function createInvoiceProd($data){
	    $vendor = $this->db->insert('accounting_invoice_prods', $data);
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
	
	public function getCustomers(){
	    $vendor = $this->db->get('acs_profile');
	    return $vendor->result();
	}
	
	public function getPayTerms(){
		$vendor = $this->db->get('payment_term');
	    return $vendor->result();
	}
}