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
}