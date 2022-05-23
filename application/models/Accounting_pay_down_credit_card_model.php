<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_pay_down_credit_card_model extends MY_Model {

    public $table = 'accounting_pay_down_credit_card';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}
}