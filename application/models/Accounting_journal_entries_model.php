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

	function insertEntryItems($data)
	{
		$this->db->insert_batch('accounting_journal_entry_items', $data);
		return $this->db->insert_id();
	}

	function getById($id) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);
		$this->db->where('status', 1);

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

	function deleteEntries($deposit_id) {
		return $this->db->where('journal_entry_id', $deposit_id)->delete('accounting_journal_entry_items');
	}
}