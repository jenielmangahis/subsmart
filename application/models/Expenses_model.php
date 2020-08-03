<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTransaction(){
        $qry = $this->db->get('accounting_expense_transaction');
        return $qry->result();
    }
    public function getExpenseCategory(){
        $qry = $this->db->get('accounting_expense_category');
        return $qry->result();
    }

    public function transaction($type,$update,$update_id){
        $id = 0;
        if ($update == true){
            $new_update = array(
              'date_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('id',$update_id);
            $this->db->update('accounting_expense_transaction',$new_update);
        }else{
            $data = array(
                'type' => $type,
                'date_created' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s')
            );
            $this->db->insert('accounting_expense_transaction',$data);
            $id = $this->db->insert_id();
        }

        return $id;
    }

    public function expenseCategory($trans_id,$cu,$new_data){
        $category = $new_data['category'];
        $description = $new_data['description'];
        $amount = $new_data['amount'];
        if ($cu == true){
            for ($x = 0; $x < count($category);$x++){
                $update = array(
                    'category' => $category[$x],
                    'description' => $description[$x],
                    'amount' => $amount[$x]
                );
                $this->db->where('transaction_type_id',$trans_id);
                $this->db->update('accounting_expense_category',$update);
            }
        }else{
            for ($x = 0;$x < count($category);$x++){
                $data[] = [
                    'transaction_type_id' => $trans_id,
                    'category' => $category[$x],
                    'description' => $description[$x],
                    'amount' => $amount[$x]
                ];
            }
            $this->db->insert_batch('accounting_expense_category',$data);
        }

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
                'taxable' => $new_data['taxable'],
                'start_time' => $new_data['start_time'],
                'end_time' => $new_data['end_time'],
                'break' => $new_data['break'],
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
        $type = "Bill";
        $trans_id = $this->transaction($type,false,null);
        $qry = $this->db->get_where('accounting_bill',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){
            $data = array(
                'transaction_id' => $trans_id,
                'vendor_id' => $new_data['vendor_id'],
                'mailing_address' => $new_data['mailing_address'],
                'terms' => $new_data['terms'],
                'bill_date' => $new_data['bill_date'],
                'due_date' => $new_data['due_date'],
                'bill_number' => $new_data['bill_number'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_bill',$data);
            $trans_bill = $this->db->insert_id();
            $this->expenseCategory($trans_bill,false,$new_data);
            return true;
        }else{
            return false;
        }
    }

    public function addExpense($new_data){
        $type = "Expense";
        $trans_id = $this->transaction($type,false,null);
        $qry = $this->db->get_where('accounting_expense',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){

            $data = array(
                'transaction_id' => $trans_id,
                'vendor_id' => $new_data['vendor_id'],
                'payment_account' => $new_data['payment_account'],
                'payment_date' => $new_data['payment_date'],
                'payment_method' => $new_data['payment_method'],
                'ref_number' => $new_data['ref_number'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_expense',$data);
            $trans_expense = $this->db->insert_id();
            $this->expenseCategory($trans_expense,false,$new_data);
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
        $type = "Check";
        $trans_id = $this->transaction($type,false,null);
        $qry = $this->db->get_where('accounting_check',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){

            $data = array(
                'transaction_id' => $trans_id,
                'vendor_id' => $new_data['vendor_id'],
                'mailing_address' => $new_data['mailing_address'],
                'bank_id' => $new_data['bank_id'],
                'payment_date' => $new_data['payment_date'],
                'check_number' => $new_data['check_num'],
                'print_later' => $new_data['print_later'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_check',$data);
            $trans_check = $this->db->insert_id();
            $this->expenseCategory($trans_check,false,$new_data);
            return true;
        }else{
            return false;
        }
    }
    public function editCheckData($update){
        $this->transaction(null,true,$update['transaction_id']);
        $qry = $this->db->get_where('accounting_check',array('id'=>$update['check_id']));
        if ($qry->num_rows() == 1){
            $data  = array(
                'vendor_id' => $update['vendor_id'],
                'mailing_address' => $update['mailing_address'],
                'bank_id' => $update['bank_id'],
                'payment_date' => $update['payment_date'],
                'check_number' => $update['check_num'],
                'print_later' => $update['print_later'],
                'permit_number' => $update['permit_number']
            );
            $this->db->where('id',$update['check_id']);
            $this->db->update('accounting_check',$data);
            $this->expenseCategory($update['check_id'],false,$update);
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
        $type = "Vendor Credit";
        $trans_id = $this->transaction($type,false,null);
        $qry = $this->db->get_where('accounting_vendor_credit',array(
            'vendor_id' => $new_data['vendor_id']
        ));
        if ($qry->num_rows() == 0){

            $data = array(
                'transaction_id' => $trans_id,
                'vendor_id' => $new_data['vendor_id'],
                'mailing_address' => $new_data['mailing_address'],
                'payment_date' => $new_data['payment_date'],
                'ref_number' => $new_data['ref_number'],
                'permit_number' => $new_data['permit_number'],
            );
            $this->db->insert('accounting_vendor_credit',$data);
            $trans_credit = $this->db->insert_id();
            $this->expenseCategory($trans_credit,false,$new_data);
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