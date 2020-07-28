<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updateReceipt($new_data){
        $qry = $this->db->get_where('accounting_receipt',array('id'=> $new_data['id']));

        if ($qry->num_rows() == 0){
            $data = array(
                'document_type' => $new_data['document_type'],
                'payee_id' => $new_data['payee_id'],
                'bank_account' => $new_data['bank_account'],
                'transaction_date' => $new_data['transaction_date'],
                'category' => $new_data['category'],
                'description' => $new_data['description'],
                'total_amount' => $new_data['total_amount'],
                'memo' => $new_data['memo'],
                'ref_number' => $new_data['ref_number']
            );
            $this->db->where('id',$new_data['id']);
            $this->db->update('accounting_receipt',$data);
            return true;
        }else{
            return false;
        }
    }

    public function deleteReceiptData($id){
        $qry  = $this->db->get_where('accounting_receipt',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->delete('accounting_receipt');
            return true;
        }else{
            return false;
        }
    }
}