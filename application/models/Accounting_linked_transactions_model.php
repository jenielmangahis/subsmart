<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_linked_transactions_model extends MY_Model
{
    public $table = 'accounting_linked_transactions';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_by_batch($data)
    {
        $this->db->insert_batch($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_linked_transactions($linkedToType, $linkedToId)
    {
        $this->db->where('linked_to_type', $linkedToType);
        $this->db->where('linked_to_id', $linkedToId);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_linked_to_transaction($linkedTransacType, $linkedTransacId)
    {
        $this->db->where('linked_transaction_type', $linkedTransacType);
        $this->db->where('linked_transaction_id', $linkedTransacId);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function unlink($linkId)
    {
        $this->db->where('id', $linkId);
        return $this->db->delete($this->table);
    }

    public function unlink_all_from_linked_to($transactionType, $transactionId)
    {
        $this->db->where('linked_to_type', $transactionType);
        $this->db->where('linked_to_id', $transactionId);
        return $this->db->delete($this->table);
    }
}
