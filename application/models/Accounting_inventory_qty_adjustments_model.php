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

	public function update($id, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);

		return $update;
	}

	public function get_by_id($id)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);

		return $query->row();
	}

	public function get_adjusted_products($adjustmentId)
	{
		$this->db->where('adjustment_id', $adjustmentId);
		$query = $this->db->get('accounting_inventory_qty_adjustment_items');

		return $query->result();
	}

	public function delete_adjustment_products($adjustmentId)
	{
		$this->db->where('adjustment_id', $adjustmentId);
		$delete = $this->db->delete('accounting_inventory_qty_adjustment_items');

		return $delete;
	}
}