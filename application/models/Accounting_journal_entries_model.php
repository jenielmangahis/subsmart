<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_journal_entries_model extends MY_Model {

    public $table = 'accounting_journal_entries';
	
	public function __construct()
	{
		parent::__construct();
    }

	function getLastJournalNo()
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->order_by('journal_no', 'desc');
		$query = $this->db->get($this->table);

		return $query->row()->journal_no;
	}

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	public function insertEntryItem($data)
	{
		$this->db->insert('accounting_journal_entry_items', $data);
		return $this->db->insert_id();
	}

	function insertEntryItems($data)
	{
		$this->db->insert_batch('accounting_journal_entry_items', $data);
		return $this->db->insert_id();
	}

	function getById($id, $companyId = null) {
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $id);

		$query = $this->db->get($this->table);
		return $query->row();
	}

	function getEntries($journal_entry_id) {
		return $this->db->where('journal_entry_id', $journal_entry_id)->get('accounting_journal_entry_items')->result();
	}

	function update($id, $data) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);
		if($update) {
			return true;
		} else {
			return false;
		}
	}

	function deleteEntries($journal_entry_id) {
		return $this->db->where('journal_entry_id', $journal_entry_id)->delete('accounting_journal_entry_items');
	}

	public function update_entry($id, $journalId, $data)
	{
		$this->db->where('id', $id);
		$this->db->where('journal_entry_id', $journalId);
		$update = $this->db->update('accounting_journal_entry_items', $data);
		return $update ? true : false;
	}

	public function get_company_journal_entries($filters = [])
	{
		$this->db->where('company_id', $filters['company_id']);
		$this->db->where('status !=', 0);
		$this->db->where('recurring', null);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function delete_entry($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}
}