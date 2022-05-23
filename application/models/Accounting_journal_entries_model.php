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

	function insertRecurringDetails($data)
	{
		$this->db->insert('accounting_recurring_journal_entries', $data);
		return $this->db->insert_id();
	}
}