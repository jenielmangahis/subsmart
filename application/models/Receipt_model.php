<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getReceipt(){
        // $qry = $this->db->get('accounting_receipts');
        // return $qry->result();
        $where = array(
            'to_expense'       => '0',
          );


        $this->db->select('*');

        $this->db->from('accounting_receipts');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function updateReceipt($new_data){
        $qry = $this->db->get_where('accounting_receipts',array('id'=> $new_data['receipt_id']));

        if ($qry->num_rows() == 1){
            $data = array(
                'document_type'     => $new_data['document_type'],
                'payee_id'          => $new_data['payee_id'],
                'bank_account'      => $new_data['bank_account'],
                'transaction_date'  => $new_data['transaction_date'],
                'category'          => $new_data['category'],
                'description'       => $new_data['description'],
                'total_amount'      => $new_data['total_amount'],
                'memo'              => $new_data['memo'],
                'ref_number'        => $new_data['ref_number'],
                'for_expense'       => '1'
            );
            $this->db->where('id',$new_data['receipt_id']);
            $this->db->update('accounting_receipts',$data);
            return true;
        }else{
            return false;
        }
    }

    public function deleteReceiptData($id){
        $qry  = $this->db->get_where('accounting_receipts',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->delete('accounting_receipts');
        }
    }

    public function getReceipt_two(){
        // $qry = $this->db->get('accounting_receipts');
        // return $qry->result();

        $where = array(
            'to_expense'       => '1',
          );


        $this->db->select('*');

        $this->db->from('accounting_receipts');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function getReceiptBYID($id)
    {
        $this->db->select('*');
        $this->db->from('accounting_receipts');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $cus = $query->row();
    }
}