<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_attachments_model extends MY_Model {

    public $table = 'accounting_attachments';
	
	public function __construct()
	{
		parent::__construct();
    }

	function insertBatch($data)
	{
		$this->db->insert_batch($this->table, $data);
		return $this->db->insert_id();
	}

	function getCompanyAttachments()
	{
		return $this->db->where(['company_id' => getLoggedCompanyID(), 'status' => 1])->get($this->table)->result_array();
	}

	public function updateAttachment($id, $data) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);
		if($update) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($id) {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])
                ->update($this->table, ['status' => 0, 'updated_at' => date('Y-m-d h:i:s')]);
    }

	public function getById($id) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);

		$query = $this->db->get($this->table);
        return $query->row();
	}
}