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

    function getCompanyPaymentMethods($order = 'asc', $status = [1])
	{
		return $this->db->where('company_id', getLoggedCompanyID())->where_in('status', $status)->order_by('name', $order)->get($this->table)->result_array();
	}

	public function getById($id)
	{
		return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])->get($this->table)->row();
	}

	public function delete($id) {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])
                ->update($this->table, ['status' => 0, 'updated_at' => date('Y-m-d h:i:s')]);
    }

	public function activate($id) {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])
                ->update($this->table, ['status' => 1, 'updated_at' => date('Y-m-d h:i:s')]);
    }

	public function updatePaymentMethod($id, $data) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);
		if($update) {
			return true;
		} else {
			return false;
		}
	}
}