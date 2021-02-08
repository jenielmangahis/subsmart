<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_purchase_order_model extends MY_Model {

	public $table = 'accounting_purchase_order';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getPurchase(){
	    $vendor = $this->db->get('accounting_purchase_order');
	    return $vendor->result();
    }
	public function createPurchase($data){
	    $vendor = $this->db->insert('accounting_purchase_order', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
	}
	public function createVendorDetails($data){
	    $vendor = $this->db->insert('vendor_cat_details', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }
	public function updatePurchase($id, $data){
	    $this->db->where('id', $id);
		$vendor = $this->db->update('accounting_purchase_order', $data);
		if($vendor){
			return true;
		}else{
			return false;
		}
    }
	public function deletePurchase($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_purchase_order');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getPurchaseDetails($id){
	    $vendor = $this->db->get_where('accounting_purchase_order', array('id' => $id));
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