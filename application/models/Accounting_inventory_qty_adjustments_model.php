<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_inventory_qty_adjustments_model extends MY_Model {

    public $table = 'accounting_inventory_qty_adjustments';
	
	public function __construct()
	{
		parent::__construct();
	}

	function getLastAdjustmentNo()
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->order_by('adjustment_no', 'desc');
		$query = $this->db->get($this->table);

		return $query->row()->adjustment_no;
	}

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	function insertAdjProduct($data)
	{
		$this->db->insert_batch('accounting_inventory_qty_adjustment_items', $data);
		return $this->db->insert_id();
	}
}