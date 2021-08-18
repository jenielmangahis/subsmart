<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_account_settings_model extends MY_Model {

	public $table = 'accounting_account_settings';
	
	public function __construct()
	{
		parent::__construct();
	}

	function addSalesForm($data)
    {
        $details    = $this->db->insert('accounting_account_settings_sales', $data);
        $insert_id  = $this->db->insert_id();
        return  $insert_id;
    }

    function save_product_services_content($data)
    {
        $details    = $this->db->insert('accounting_account_settings_product_services', $data);
        $insert_id  = $this->db->insert_id();
        return  $insert_id;
    }
}