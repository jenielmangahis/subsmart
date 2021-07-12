<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_receive_payment_model extends MY_Model
{
    public $table = 'accounting_receive_payment';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getReceivePayments()
    {
        $vendor = $this->db->get('accounting_receive_payment');
        return $vendor->result();
    }
    public function createReceivePayment($data)
    {
        $vendor = $this->db->insert('accounting_receive_payment', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function updateReceivePayment($id, $data)
    {
        $this->db->where('id', $id);
        $vendor = $this->db->update('accounting_receive_payment', $data);
        if ($vendor) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteReceivePayment($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('accounting_receive_payment');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getReceivePaymentDetails($id)
    {
        $vendor = $this->db->get_where('accounting_receive_payment', array('id' => $id));
        return $vendor->row();
    }
    
    public function savepaymentmethod($data)
    {
        $vendor = $this->db->insert('payment_method', $data);
        $insert = $this->db->insert_id();
        return  $insert;
    }

    public function getpaymethod()
    {
        $vendor = $this->db->get('payment_method');
        return $vendor->result();
    }
}
