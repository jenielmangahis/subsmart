<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_refund_receipt_model extends MY_Model
{
    public $table = 'accounting_refund_receipt';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getRefundReceipts()
    {
        $query = $this->db->get('accounting_refund_receipt');
        return $query->result();
    }
    public function createRefundReceipts($data)
    {
        $query = $this->db->insert('accounting_refund_receipt', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function updateRefundReceipt($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('accounting_refund_receipt', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteRefundReceipt($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('accounting_refund_receipt');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getRefundReceiptDetails($id)
    {
        $query = $this->db->get_where('accounting_refund_receipt', array('id' => $id));
        return $query->result();
    }
	public function getRefundReceiptDetails_by_id($id)
    {
        $query = $this->db->get_where('accounting_refund_receipt', array('id' => $id));
        return $query->row();
    }
	public function additem_details($data)
    {
        $query = $this->db->insert('refund_receipt_items', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }public function get_refund_receipt_items($refund_receipt_id)
    {
        $this->db->reset_query();
        $query = $this->db->query("SELECT *,refund_receipt_items.cost AS sri_cost FROM refund_receipt_items JOIN items ON refund_receipt_items.items_id = items.id WHERE  refund_receipt_items.refund_receipt_id= ".$refund_receipt_id);
        return $query->result();
    }
	public function delete_refund_receipt_items($refund_receipt_id)
    {
        $this->db->delete('refund_receipt_items', array('refund_receipt_id' => $refund_receipt_id));
    }
}
