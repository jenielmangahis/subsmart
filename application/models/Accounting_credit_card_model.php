<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_credit_card_model extends MY_Model {

	public $table = 'accounting_credit_card';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getPurchase(){
	    $vendor = $this->db->get('accounting_credit_card');
	    return $vendor->result();
    }
	public function createPurchase($data){
	    $vendor = $this->db->insert('accounting_credit_card', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
	}
	public function createVendorDetails($data){
	    $vendor = $this->db->insert('vendor_credit_card_details', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }
	public function updatePurchase($id, $data){
	    $this->db->where('id', $id);
		$vendor = $this->db->update('accounting_credit_card', $data);
		if($vendor){
			return true;
		}else{
			return false;
		}
    }
	public function deletePurchase($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_credit_card');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getPurchaseDetails($id){
	    $vendor = $this->db->get_where('accounting_credit_card', array('id' => $id));
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