<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addCategories($new_data){
        $qry = $this->db->get_where('accounting_list_category',array('category_name'=>$new_data['detail_type'],'type'=>$new_data['account_type']));
        if ($qry->num_rows() == 0){
            $data = array(
                'category_name'=>$new_data['detail_type'],
                'type'=>$new_data['account_type'],
                'display_name'=>$new_data['name'],
                'description' => $new_data['description'],
                'sub_account' => $new_data['sub_account'],
                'date_created' => date('Y-m-d H:i:s'),
                'status' => 1
            );
            $this->db->insert('accounting_list_category',$data);
            return true;
        }else{
            return false;
        }

    }

    public function getTransaction(){
        $qry = $this->db->get('accounting_expense_transaction');
        return $qry->result();
    }
    public function getExpenseCategory(){
        $qry = $this->db->get('accounting_expense_category');
        return $qry->result();
    }

    public function transaction($type,$update,$update_id,$total){
        $id = 0;
        if ($update == true){
            $new_update = array(
              'total' => $total,
              'date_modified' => date('Y-m-d H:i:s')
            );
            $this->db->where('id',$update_id);
            $this->db->update('accounting_expense_transaction',$new_update);
        }else{
            $data = array(
                'type' => $type,
                'total' => $total,
                'date_created' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s')
            );
            $this->db->insert('accounting_expense_transaction',$data);
            $id = $this->db->insert_id();
        }

        return $id;
    }

    public function expenseCategory($transaction_id,$expenses_id,$cu,$new_data){
        $category = $new_data['category'];
        $description = $new_data['description'];
        $amount = $new_data['amount'];
        if ($cu == true){
            $category_id = $new_data['category_id'];
            for ($x = 0; $x < count($category_id);$x++){
                if ($category[$x] != 0 || $amount[$x] == 0){
                    $update = array(
                        'category_id' => $category[$x],
                        'description' => $description[$x],
                        'amount' => $amount[$x]
                    );
                    $find = array(
                        'id' => $category_id[$x]
                    );
                    $check = $this->db->where($find);
                    if($check == true){
                        $this->db->update('accounting_expense_category',$update);
                    }else{
                        $insert = array(
                            'transaction_id' => $transaction_id,
                            'expenses_id' => $expenses_id,
                            'category_id' => $category[$x],
                            'description' => $description[$x],
                            'amount' => $amount[$x]
                        );
                        $this->db->insert('accounting_expense_category',$insert);
                    }
                }

            }
        }else{
            for ($x = 0;$x < count($category);$x++){
                if ($category[$x] != null || $category[$x] != 0){
                $data = array(
                    'transaction_id' => $transaction_id,
                    'expenses_id' => $expenses_id,
                    'category_id' => $category[$x],
                    'description' => $description[$x],
                    'amount' => $amount[$x]
                );
                $this->db->insert('accounting_expense_category',$data);
                }
            }
        }
    }

    public function getAttachment(){
        $query = $this->db->get('accounting_expense_attachment');
        return $query->result();
    }
    public function getAttachmentById($transaction_id){
        $existing_attachment = $this->db->get('accounting_existing_attachment');
        $existing = $existing_attachment->result();
        foreach ($existing as $data){
            if ($data->trans_from_id == $transaction_id){
                $this->db->where('id !=',$data->attachment_id);
            }
        }
        $this->db->where('transaction_id !=',$transaction_id);
        $query = $this->db->get('accounting_expense_attachment');
        return $query->result();
    }

    public function getAddedAttachment($attachment_id,$expense_id,$type){
        $query = $this->db->get_where('accounting_existing_attachment',array('attachment_from_id'=> $attachment_id,'expenses_id'=>$expense_id,'expenses_type'=> $type));
        if ($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }

    }

    public function expensesAttachment($transaction_id,$id,$type,$file_name){
        if ($file_name['file_name'] != null){
            $attachment = $file_name['file_name'];
            $original_fname = $file_name['original_fname'];
            for($x = 0;$x < count($attachment);$x++){
                $data = array(
                    'transaction_id' => $transaction_id,
                    'original_filename' => $original_fname[$x],
                    'expenses_id' => $id,
                    'type' => $type,
                    'date_created' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $this->db->where('attachment',$attachment[$x]);
                $this->db->update('accounting_expense_attachment',$data);
            }
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

    public function getBill(){
        $qry = $this->db->get('accounting_bill');
        return $qry->result();
    }

    // public function addBill($new_data){
    //     $type = "Bill";
    //     $qry = $this->db->get_where('accounting_bill',array(
    //         'bill_number' => $new_data['bill_number']
    //     ));
    //     if ($qry->num_rows() == 0){
    //         $trans_id = $this->transaction($type,false,null,$new_data['total']);
    //         $data = array(
    //             'transaction_id' => $trans_id,
    //             'vendor_id' => $new_data['vendor_id'],
    //             'mailing_address' => $new_data['mailing_address'],
    //             'terms' => $new_data['terms'],
    //             'bill_date' => $new_data['bill_date'],
    //             'due_date' => $new_data['due_date'],
    //             'bill_number' => $new_data['bill_number'],
    //             'permit_number' => $new_data['permit_number'],
    //             'memo' => $new_data['memo']
    //         );
    //         $this->db->insert('accounting_bill',$data);
    //         $bill_id = $this->db->insert_id();
    //         $this->expenseCategory($trans_id,$bill_id,false,$new_data);
    //         $this->expensesAttachment($trans_id,$bill_id,$type,$new_data);
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    public function addBill($data){
	    $vendor = $this->db->insert('accounting_bill', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }

    public function editBillData($data){
        $type = 'Bill';
        $this->transaction(null,true,$data['transaction_id'],$data['total']);
        $qry = $this->db->get_where('accounting_bill',array('id'=>$data['bill_id']));
        if ($qry->num_rows() == 1){
            $update  = array(
                'vendor_id' => $data['vendor_id'],
                'mailing_address' => $data['mailing_address'],
                'terms' => $data['terms'],
                'bill_date' => $data['bill_date'],
                'due_date' => $data['due_date'],
                'bill_number' => $data['bill_number'],
                'permit_number' => $data['permit_number'],
                'memo' => $data['memo']
            );
            $this->db->where('id',$data['bill_id']);
            $this->db->update('accounting_bill',$update);
            $cu = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$data['bill_id']));
            $this->expenseCategory($data['transaction_id'],$data['bill_id'],($cu->num_rows() > 0)?true:false,$data);
            $this->expensesAttachment($data['transaction_id'],$data['bill_id'],$type,$data);
            return true;
        }else{
            return false;
        }

    }

    public function deleteBillData($id){
        $qry  = $this->db->get_where('accounting_bill',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->delete('accounting_bill');
            //Transaction table
            $this->db->where('id',$qry->row()->transaction_id);
            $this->db->delete('accounting_expense_transaction');
            //Expense Category table
            $this->db->where('id',$id);
            $this->db->delete('accounting_expense_category');
            return true;
        }else{
            return false;
        }
    }

    public function getExpense(){
        $qry = $this->db->get('accounting_expense');
        return $qry->result();
    }

    public function addtransaction($new_data){
        $vendor = $this->db->insert('accounting_expense_transaction', $new_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function addExpense($new_data){
        // $type = "Expense";
        // $trans_id = $this->transaction($type,false,null,$new_data['total']);
        // $qry = $this->db->get_where('accounting_expense',array(
        //     'vendor_id' => $new_data['vendor_id']
        // ));
        // if ($qry->num_rows() == 0){
        //     $data = array(
        //         'transaction_id' => $trans_id,
        //         'vendor_id' => $new_data['vendor_id'],
        //         'payment_account' => $new_data['payment_account'],
        //         'payment_date' => $new_data['payment_date'],
        //         'payment_method' => $new_data['payment_method'],
        //         'ref_number' => $new_data['ref_number'],
        //         'permit_number' => $new_data['permit_number'],
        //         'memo' => $new_data['memo']
        //     );
        //     $this->db->insert('accounting_expense',$data);
        //     $expense_id = $this->db->insert_id();
        //     $this->expenseCategory($trans_id,$expense_id,false,$new_data);
        //     $this->expensesAttachment($trans_id,$expense_id,$type,$new_data);
        //     return true;
        // }else{
        //     return false;
        // }

        $vendor = $this->db->insert('accounting_expense', $new_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }

    public function saveItems($new_data){
        $vendor = $this->db->insert('item_details', $new_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }
    public function updateExpenseData($data){
        $type = 'Expense';
        $this->transaction(null,true,$data['transaction_id'],$data['total']);
        $qry = $this->db->get_where('accounting_expense',array('id'=>$data['expense_id']));
        if ($qry->num_rows() == 1){
            $update  = array(
                'vendor_id' => $data['vendor_id'],
                'payment_account' => $data['payment_account'],
                'payment_date' => $data['payment_date'],
                'payment_method' => $data['payment_method'],
                'ref_number' => $data['ref_number'],
                'permit_number' => $data['permit_number'],
                'memo' => $data['memo']
            );
            $this->db->where('id',$data['expense_id']);
            $this->db->update('accounting_expense',$update);
            $cu = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$data['expense_id']));
            $this->expenseCategory($data['transaction_id'],$data['expense_id'],($cu->num_rows() > 0)?true:false,$data);
            $this->expensesAttachment($data['transaction_id'],$data['expense_id'],$type,$data);
            return true;
        }else{
            return false;
        }
    }

    public function deleteExpenseData($id){
        $qry  = $this->db->get_where('accounting_expense',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->delete('accounting_expense');
            //Transaction table
            $this->db->where('id',$qry->row()->transaction_id);
            $this->db->delete('accounting_expense_transaction');
            //Expense Category table
            $this->db->where('id',$id);
            $this->db->delete('accounting_expense_category');
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
        // $type = "Check";
        // $trans_id = $this->transaction($type,false,null,$new_data['total']);
        // $qry = $this->db->get_where('accounting_check',array(
        //     'check_number' => $new_data['check_num']
        // ));
        // if ($qry->num_rows() == 0){
        //     $data = array(
        //         'transaction_id' => $trans_id,
        //         'vendor_id' => $new_data['vendor_id'],
        //         'mailing_address' => $new_data['mailing_address'],
        //         'bank_id' => $new_data['bank_id'],
        //         'payment_date' => $new_data['payment_date'],
        //         'check_number' => $new_data['check_num'],
        //         'print_later' => $new_data['print_later'],
        //         'permit_number' => $new_data['permit_number'],
        //         'memo' => $new_data['memo']
        //     );
        //     $this->db->insert('accounting_check',$data);
        //     $check_id = $this->db->insert_id();
        //     $this->expenseCategory($trans_id,$check_id,false,$new_data);
        //     $this->expensesAttachment($trans_id,$check_id,$type,$new_data);
        //     return true;
        // }else{
        //     return false;
        // }
        $vendor = $this->db->insert('accounting_check', $new_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function editCheckData($update){
        $type='Check';
        $this->transaction(null,true,$update['transaction_id'],$update['total']);
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
                'memo' => $update['memo'],
            );
            $this->db->where('id',$update['check_id']);
            $this->db->update('accounting_check',$data);
            $cu = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$update['check_id']));
            $this->expenseCategory($update['transaction_id'],$update['check_id'],($cu->num_rows() > 0)?true:false,$update);
            $this->expensesAttachment($update['transaction_id'],$update['check_id'],$type,$update);
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
            //Transaction table
            $this->db->where('id',$qry->row()->transaction_id);
            $this->db->delete('accounting_expense_transaction');
            //Expense Category table
            $this->db->where('id',$id);
            $this->db->delete('accounting_expense_category');
            return true;
        }else{
            return false;
        }
    }

    public function getVendorCredit(){
        $qry = $this->db->get('accounting_vendor_credit');
        return $qry->result();
    }

    public function vendorCredit($new_data){
        $type = "Vendor Credit";
        $trans_id = $this->transaction($type,false,null,$new_data['total']);
        $qry = $this->db->get_where('accounting_vendor_credit',array(
            'transaction_id' => $trans_id
        ));
        if ($qry->num_rows() == 0){
            $data = array(
                'transaction_id' => $trans_id,
                'vendor_id' => $new_data['vendor_id'],
                'mailing_address' => $new_data['mailing_address'],
                'payment_date' => $new_data['payment_date'],
                'ref_number' => $new_data['ref_number'],
                'permit_number' => $new_data['permit_number'],
                'memo' => $new_data['memo'],
            );
            $this->db->insert('accounting_vendor_credit',$data);
            $vc_id = $this->db->insert_id();
            $this->expenseCategory($trans_id,$vc_id,false,$new_data);
            $this->expensesAttachment($trans_id,$vc_id,$type,$new_data);
            return true;
        }else{
            return false;
        }

    }

    public function updateVendorCredit($update){
        $type = 'Vendor Credit';
        $this->transaction(null,true,$update['transaction_id'],$update['total']);
        $qry = $this->db->get_where('accounting_vendor_credit',array('id'=>$update['vc_id']));
        if ($qry->num_rows() == 1){
            $data  = array(
                'vendor_id' => $update['vendor_id'],
                'mailing_address' => $update['mailing_address'],
                'payment_date' => $update['payment_date'],
                'ref_number' => $update['ref_number'],
                'permit_number' => $update['permit_number'],
                'memo' => $update['memo']
            );
            $this->db->where('id',$update['vc_id']);
            $this->db->update('accounting_vendor_credit',$data);
            $cu = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$update['vc_id']));
            $this->expenseCategory($update['transaction_id'],$update['vc_id'],($cu->num_rows() > 0)?true:false,$update);
            $this->expensesAttachment($update['transaction_id'],$update['vc_id'],$type,$update);
            return true;
        }else{
            return false;
        }

    }

    public function deleteVendorCredit($id){
        $qry  = $this->db->get_where('accounting_vendor_credit',array('id'=>$id));
        if ($qry->num_rows() == 1){
            //Vendor credit table
            $this->db->where('id',$id);
            $this->db->delete('accounting_vendor_credit');
            //Transaction table
            $this->db->where('id',$qry->row()->transaction_id);
            $this->db->delete('accounting_expense_transaction');
            //Expense Category table
            $this->db->where('id',$id);
            $this->db->delete('accounting_expense_category');
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

    public function insert_vendor_transaction_categories($data)
    {
        $this->db->insert_batch('accounting_vendor_transaction_categories', $data);
        return $this->db->insert_id();
    }

    public function insert_vendor_transaction_items($data)
    {
        $this->db->insert_batch('accounting_vendor_transaction_items', $data);
        return $this->db->insert_id();
    }

    public function get_open_bills($filters = [])
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('status', 1);
        if(isset($filters['start_date'])) {
            $this->db->where('due_date >=', $filters['start_date']);
        }
        if(isset($filters['end_date'])) {
            $this->db->where('due_date <=', $filters['end_date']);
        }
        if(isset($filters['vendor_id'])) {
            $this->db->where('vendor_id', $filters['vendor_id']);
        }
        $query = $this->db->get('accounting_bill');
        return $query->result();
    }

    public function insert_bill_payment($data)
    {
        $this->db->insert('accounting_bill_payments', $data);
        return $this->db->insert_id();
    }

    public function insert_bill_payment_items($data)
    {
        $this->db->insert_batch('accounting_bill_payment_items', $data);
        return $this->db->insert_id();
    }

    public function add_vendor_credit($data)
    {
        $this->db->insert('accounting_vendor_credit', $data);
        return $this->db->insert_id();
    }

    public function add_purchase_order($data)
    {
        $this->db->insert('accounting_purchase_order', $data);
        return $this->db->insert_id();
    }

    public function add_credit_card_credit($data)
    {
        $this->db->insert('accounting_credit_card_credits', $data);
        return $this->db->insert_id();
    }

    public function update_bill_data($billId, $data)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $billId);
        return $this->db->update('accounting_bill', $data);
    }

    public function get_bill_data($billId)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $billId);
        $query = $this->db->get('accounting_bill');
        return $query->row();
    }

    public function get_transaction_categories($transactionId, $transactionType)
    {
        $this->db->where('transaction_type', $transactionType);
        $this->db->where('transaction_id', $transactionId);
        $query = $this->db->get('accounting_vendor_transaction_categories');
        return $query->result();
    }

    public function get_transaction_items($transactionId, $transactionType)
    {
        $this->db->where('transaction_type', $transactionType);
        $this->db->where('transaction_id', $transactionId);
        $query = $this->db->get('accounting_vendor_transaction_items');
        return $query->result();
    }
}