<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function timeActivity($new_data){
        $qry = $this->db->get_where('accounting_time_activity',array(
            'customer' => $new_data['customer']
        ));
        if ($new_data['start_end_times'] == null){
            $new_data['start_end_times'] = 0;
        }
        if ($qry->num_rows() == 0){
            $data = array(
                'date' => $new_data['date'],
                'customer' => $new_data['customer'],
                'service' => $new_data['service'],
                'billable' => $new_data['billable'],
                'start_end_times' => $new_data['start_end_times'],
                'time' => $new_data['time'],
                'description' => $new_data['description']
            );
            $this->db->insert('accounting_time_activity',$data);
            return true;
        }else{
            return false;
        }
    }

    public function addBill($new_data){
        $qry = $this->db->get_where('accounting_bill',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){
            $data = array(
                'vendor_id' => $new_data['vendor_id'],
                'mailing_address' => $new_data['mailing_address'],
                'terms' => $new_data['terms'],
                'bill_date' => $new_data['bill_date'],
                'due_date' => $new_data['due_date'],
                'bill_number' => $new_data['bill_number'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_bill',$data);
            return true;
        }else{
            return false;
        }
    }

    public function addExpense($new_data){
        $qry = $this->db->get_where('accounting_expense',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){

            $data = array(
                'vendor_id' => $new_data['vendor_id'],
                'payment_account' => $new_data['payment_account'],
                'payment_date' => $new_data['payment_date'],
                'payment_method' => $new_data['payment_method'],
                'ref_number' => $new_data['ref_number'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_expense',$data);
            return true;
        }else{
            return false;
        }

    }
    public function getCheck(){
        $query = $this->db->get('accounting_check');
        return $query->result();
    }

    public function addCheck($new_data){
        $qry = $this->db->get_where('accounting_check',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){

            $data = array(
                'vendor_id' => $new_data['vendor_id'],
                'mailing_address' => $new_data['mailing_address'],
                'bank_id' => $new_data['bank_id'],
                'payment_date' => $new_data['payment_date'],
                'check_number' => $new_data['check_num'],
                'print_later' => $new_data['print_later'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_check',$data);
            return true;
        }else{
            return false;
        }
    }
    public function editCheckData($update){
        $qry = $this->db->get_where('accounting_check',array('id'=>$update['check_id']));
        if ($qry->num_rows() == 1){
            $data  = array(
                'vendor_id' => $update['vendor_id'],
                'mailing_address' => $update['mailing_address'],
                'bank_id' => $update['bank_id'],
                'payment_date' => $update['payment_date'],
                'check_number' => $update['check_num'],
                'print_later' => $update['print_later'],
                'permit_number' => $update['permit_number'],
            );
            $this->db->where('id',$update['check_id']);
            $this->db->update('accounting_check',$data);
            return true;
        }else{
            return false;
        }

    }
    public function deleteCheckData($id){
        $qry  = $this->db->get_where('accounting_check',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->delete('accounting_check');
            return true;
        }else{
            return false;
        }
    }

    public function vendorCredit($new_data){
        $qry = $this->db->get_where('accounting_vendor_credit',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){

            $data = array(
                'vendor_id' => $new_data['vendor_id'],
                'mailing_address' => $new_data['mailing_address'],
                'payment_date' => $new_data['payment_date'],
                'ref_number' => $new_data['ref_number'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_vendor_credit',$data);
            return true;
        }else{
            return false;
        }

    }
    public function payDown($new_data){
        $qry = $this->db->get_where('accounting_paydown',array(
            'credit_card_id' => $new_data['credit_card_id']
        ));
        if ($qry->num_rows() == 0){

            $data = array(
                'credit_card_id' => $new_data['credit_card_id'],
                'amount' => $new_data['amount'],
                'date_payment' => $new_data['date_payment'],
                'payment_account' => $new_data['payment_account'],
                'check_number' => $new_data['check_number'],
            );
            $this->db->insert('accounting_paydown',$data);
            return true;
        }else{
            return false;
        }

    }
}