<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountingVendors_model extends MY_Model {

	public $table = 'accounting_vendors';
	
	public function __construct()
	{
		parent::__construct();
	}
	public function select()
	{
	    $query = $this->db->get('accounting_vendors');  
	    return $query->result();  
	}
}