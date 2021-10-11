<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_sales_receipt_model extends MY_Model
{
    public $table = 'accounting_sales_receipt';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getSalesReceipts()
    {
        $query = $this->db->get('accounting_sales_receipt');
        return $query->result();
    }
    public function createSalesReceipts($data)
    {
        $query = $this->db->insert('accounting_sales_receipt', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function updateSalesReceipt($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('accounting_sales_receipt', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteSalesReceipt($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('accounting_sales_receipt');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSalesReceiptDetails($id)
    {
        $query = $this->db->get_where('accounting_sales_receipt', array('id' => $id));
        return $query->result();
    }
    
    public function save_payment($data)
    {
        $vendor = $this->db->insert('accounting_payments', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function getAllByCompany($company_id)
    {
        $this->db->select('*');
        $this->db->from('accounting_sales_receipt');
        $this->db->join('acs_profile', 'accounting_sales_receipt.customer_id  = acs_profile.prof_id');
        // $this->db->where('estimates.company_id', $company_id);
        $this->db->where('accounting_sales_receipt.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function insert_accounting_recurring_sales_receipt($data)
    {
        $this->db->insert('accounting_recurring_sales_receipt', $data);
        return $this->db->insert_id();
    }
    public function getSalesReceiptDetails_by_id($id)
    {
        $query = $this->db->get_where('accounting_sales_receipt', array('id' => $id));
        return $query->row();
    }
    public function get_sales_receipt_items($sales_receipt_id)
    {
        $this->db->reset_query();
        $query = $this->db->query("SELECT * FROM item_details WHERE type='Sales Receipt' and type_id = ".$sales_receipt_id);
        return $query->result();
    }
    public function delete_sales_receipt_items($sales_receipt_id)
    {
        $this->db->delete('item_details', array('type_id' => $sales_receipt_id,'type'=>'Sales Receipt'));
    }
    public function get_sales_receipt_recurring($sales_receipt_id)
    {
        $this->db->select('*');
        $this->db->from('accounting_recurring_sales_receipt');
        $this->db->where('accounting_sales_receipt_id', $sales_receipt_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function update_sales_receipt_recurring($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('accounting_recurring_transactions', $data);
    }
    public function delete_receive_payment_details($where)
    {
        $this->db->delete('accounting_receive_payment', $where);
    }
    public function get_sum_of_sales_receipt_by_customer_id($customer_id="", $start_date="", $end_date="", $statement_type="")
    {
        $conditions ="";
        if ($statement_type=="Transaction Statement") {
            $conditions ="AND (accounting_sales_receipt.sales_receipt_date >= '".$start_date."' AND accounting_sales_receipt.sales_receipt_date<= '".$end_date."')";
        }

        $query = $this->db->query("SELECT COUNT(accounting_sales_receipt.id) as billed_count, SUM(accounting_sales_receipt.grand_total) as total_amount_billed FROM accounting_sales_receipt 
        WHERE accounting_sales_receipt.customer_id = ".$customer_id." ".$conditions);
        $results['billed']=$query->row();
        return $results;
    }
    public function get_ranged_sales_receipts_by_customer_id($customer_id, $start_date, $end_date, $statement_type="", $action="")
    {
        $conditions ="";
        if ($statement_type=="Transaction Statement" || ($statement_type=="Balance Forward" && $action=="print")) {
            $conditions ="AND (accounting_sales_receipt.sales_receipt_date >= '".$start_date."' AND accounting_sales_receipt.sales_receipt_date<= '".$end_date."')";
        }
        $query = $this->db->query("SELECT * FROM accounting_sales_receipt 
        WHERE accounting_sales_receipt.customer_id = ".$customer_id." ".$conditions);
        return $query->result();
    }
    public function getAllByCustomerId($customer_id)
    {
        $this->db->select('*');
        $this->db->from('accounting_sales_receipt');
        $this->db->join('acs_profile', 'accounting_sales_receipt.customer_id  = acs_profile.prof_id');
        // $this->db->where('estimates.company_id', $company_id);
        $this->db->where('accounting_sales_receipt.customer_id', $customer_id);

        $query = $this->db->get();
        return $query->result();
    }
    public function get_recuring_sales_receipt($recurring_id="0",$sales_receipt_id="0")
    {
        $this->db->select('*');
        $this->db->from('accounting_sales_receipt');
        $this->db->where('recurring_id', $recurring_id);
        $this->db->order_by('sales_receipt_date', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getsalesReceiptsItems($id)
    {
        $this->db->select('*');
        $this->db->from('accounting_sales_receipt');
        $this->db->join('acs_profile', 'accounting_sales_receipt.customer_id  = acs_profile.prof_id');
        $this->db->where('accounting_sales_receipt.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getclientsData($company_id)
    {
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where('id', $company_id);
        $query = $this->db->get();
        return $query->row();
    }
}
