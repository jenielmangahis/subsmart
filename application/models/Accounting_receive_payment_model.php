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

    public function getReceivePaymentsByComp($company_id)
    {
        // $vendor = $this->db->get('accounting_receive_payment');
        // return $vendor->result();
        $where = array(
            'company_id'    => $company_id
        );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
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
    public function insert_receive_payment($data)
    {
        $this->db->insert('accounting_receive_payment', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function insert_receive_payment_invoices($data)
    {
        $this->db->insert('accounting_receive_payment_invoices', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function update_receive_payment_invoices($data, $where)
    {
        $this->db->where($where);
        $this->db->update('accounting_receive_payment_invoices', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function delete_receive_payment($receive_payment_id)
    {
        $where = array("id" => $receive_payment_id);
        $this->db->where($where);
        $this->db->delete('accounting_receive_payment');
        $this->delete_receive_payment_invoices(array("receive_payment_id" => $receive_payment_id));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function delete_receive_payment_invoices($where)
    {
        $this->db->where($where);
        $query = $this->db->delete('accounting_receive_payment_invoices');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function update_receive_payment_details($data, $receive_payment_id)
    {
        $where = array(
            "id" => $receive_payment_id
        );
        $this->db->update('accounting_receive_payment', $data, $where);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_invoice_receive_payment($invoice_id, $receive_payment_id = 0)
    {
        $this->db->select('accounting_receive_payment_invoices.*,accounting_receive_payment.payment_date,,accounting_receive_payment.id as receive_payment_id');
        $this->db->where('accounting_receive_payment_invoices.invoice_id', $invoice_id);
        $this->db->where('accounting_receive_payment_invoices.receive_payment_id !=', $receive_payment_id);
        $this->db->where('accounting_receive_payment.status', 1);
        $this->db->from('accounting_receive_payment_invoices');
        $this->db->join('accounting_receive_payment', 'accounting_receive_payment.id = accounting_receive_payment_invoices.receive_payment_id');
        $this->db->order_by('accounting_receive_payment.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function update_payment_method($data, $receive_payment_id)
    {
        $where = array(
            "transaction_id" => $receive_payment_id
        );
        $this->db->update('accounting_payments', $data, $where);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_ranged_received_payment_by_company_id($company_id, $start_date, $end_date)
    {
        if ($company_id != "") {
            $conditions = "AND (payment_date >= '" . $start_date . "' AND payment_date <=  '" . $end_date . "')";
            $sql = "SELECT * FROM accounting_receive_payment WHERE company_id = " . $company_id . " " . $conditions . " ORDER BY payment_date ASC";
            $query = $this->db->query($sql);
            return $query->result();
        }
    }
    public function get_sum_received_payments($company_id, $start_date, $end_date)
    {
        if ($company_id != "") {
            $conditions = "AND (payment_date >= '" . $start_date . "' AND payment_date <=  '" . $end_date . "')";
            $sql = "SELECT SUM(amount) as total_sum FROM accounting_receive_payment WHERE company_id = " . $company_id . " " . $conditions . " ORDER BY payment_date ASC";
            $query = $this->db->query($sql);
            return $query->row()->total_sum;
        }
    }

    public function amount_received_in_a_day($date)
    {
        $sql = "SELECT SUM(amount) as money_in FROM `accounting_receive_payment` WHERE payment_date = '" . $date . "'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function amount_expense_in_a_day($date)
    {
        $sql = "SELECT SUM(total_amount) as money_out FROM `accounting_expense` WHERE payment_date = '" . $date . "'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function amount_received_in_a_month($from, $to)
    {
        $sql = "SELECT SUM(amount) as money_in FROM `accounting_receive_payment` WHERE payment_date >= '" . $from . "' AND payment_date <= '" . $to . "'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function amount_expense_in_a_month($from, $to)
    {
        $sql = "SELECT SUM(total_amount) as money_out FROM `accounting_expense` WHERE payment_date >= '" . $from . "' AND payment_date <= '" . $to . "'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function get_payment_methods($company_id)
    {
        $sql = "SELECT * FROM accounting_payment_methods WHERE company_id = " . $company_id . " and status = 1 ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_deposits_to($company_id)
    {
        $sql = "SELECT * FROM accounting_chart_of_accounts WHERE company_id = " . $company_id . " and active = 1 ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function add_payment_invoices($paymentInvoices)
    {
        $this->db->insert_batch('accounting_receive_payment_invoices', $paymentInvoices);
		return $this->db->insert_id();
    }
}
