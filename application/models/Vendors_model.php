<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors_model extends MY_Model {

	public $table = 'accounting_vendors';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getVendors(){
	    $vendor = $this->db->get('accounting_vendors');
	    return $vendor->result();
    }
	public function getVendorDetails($id){
	    $vendor = $this->db->get_where('accounting_vendors', array('vendor_id' => $id));
	    return $vendor->result();
    }
	public function getvendortransactions($id){
	    $getBill = $this->db->get_where('accounting_bill', array('vendor_id' => $id));
	    return $getBill->result();
    }
}