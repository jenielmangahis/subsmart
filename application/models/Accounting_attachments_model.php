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

	public function get_unlinked_attachments()
	{
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id NOT IN (SELECT `attachment_id` FROM `accounting_attachment_links`)');

		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_attachments_by_ids($ids = [])
	{
		$this->db->where_in('id', $ids);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function link_attachment($data)
	{
		$this->db->insert('accounting_attachment_links', $data);
	    return $this->db->insert_id();
	}

	public function unlink_attachment($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('accounting_attachment_links');
	}

	public function get_attachment_link($data)
	{
		$this->db->where('type', $data['type']);
		$this->db->where('attachment_id', $data['attachment_id']);
		$this->db->where('linked_id', $data['linked_id']);
		$query = $this->db->get('accounting_attachment_links');
		return $query->row();
	}

	public function get_attachments($type, $linkedId)
	{
		$this->db->select('accounting_attachments.*');
		$this->db->from('accounting_attachments');
		$this->db->where('accounting_attachment_links.type', $type);
		$this->db->where('accounting_attachment_links.linked_id', $linkedId);
		$this->db->order_by('accounting_attachment_links.order_no', 'asc');
		$this->db->join('accounting_attachment_links', 'accounting_attachment_links.attachment_id = accounting_attachments.id');
		$query = $this->db->get();

		return $query->result();
	}

	public function unlink_attachments($type, $linkedId)
	{
		$this->db->where('type', $type);
		$this->db->where('linked_id', $linkedId);
		return $this->db->delete('accounting_attachment_links');
	}

	public function update_order($data = [])
	{
		$this->db->where('type', $data['type']);
		$this->db->where('attachment_id', $data['attachment_id']);
		$this->db->where('linked_id', $data['linked_id']);
		$update = $this->db->update('accounting_attachment_links', ['order_no' => $data['order_no']]);
		return $update ? true : false;
	}
}