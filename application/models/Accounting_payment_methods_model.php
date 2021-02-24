<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_payment_methods_model extends MY_Model {

    public $table = 'accounting_payment_methods';
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

    function getCompanyPaymentMethods($order)
	{
		return $this->db->where(['company_id' => getLoggedCompanyID(), 'status' => 1])->order_by('name', $order)->get($this->table)->result_array();
	}
}