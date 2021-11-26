<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_invoices_model extends MY_Model
{
    public $table = 'accounting_invoice';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getCustomerOverdueInvoices($data)
    {
        $this->db->select('accounting_invoice.*');
        $this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $data['company_id']);
        $this->db->where('accounting_invoice.customer_id', $data['customer_id']);
        $this->db->where('accounting_invoice.status', 1);
        $this->db->where('accounting_invoice.due_date <=', $data['end_date']);

        $query = $this->db->get($this->table);

        return $query->result();
    }
    public function getCustomerInvoicesByDate($data)
    {
        $this->db->select('accounting_invoice.*');
        $this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $data['company_id']);
        $this->db->where('accounting_invoice.customer_id', $data['customer_id']);
        $this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
        $this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);
        $this->db->order_by('accounting_invoice.invoice_date', 'asc');

        $query = $this->db->get($this->table);

        return $query->result();
    }
    public function getCustomerOpenInvoices($data)
    {
        $this->db->select('accounting_invoice.*');
        $this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $data['company_id']);
        $this->db->where('accounting_invoice.customer_id', $data['customer_id']);
        $this->db->where('accounting_invoice.status', 1);
        $this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
        $this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);
        $this->db->order_by('accounting_invoice.invoice_date', 'asc');

        $query = $this->db->get($this->table);

        return $query->result();
    }
    public function getCustomerTransactions($data)
    {
        $this->db->select('accounting_invoice.*');
        $this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $data['company_id']);
        $this->db->where('accounting_invoice.customer_id', $data['customer_id']);
        $this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
        $this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);

        $this->db->order_by('accounting_invoice.invoice_date', 'asc');

        $query = $this->db->get($this->table);

        return $query->result();
    }
    public function getStatementInvoices($data)
    {
        $this->db->select('accounting_invoice.*, acs_profile.first_name, acs_profile.last_name, acs_profile.email');
        $this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $data['company_id']);

        if ($data['cust_bal_status'] === 'open') {
            $this->db->where('accounting_invoice.status', 1);
            $this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
            $this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);

            $this->db->or_where('accounting_invoice.status', 1);
            $this->db->where('acs_profile.company_id', $data['company_id']);
            $this->db->where('accounting_invoice.due_date <=', $data['end_date']);
        } elseif ($data['cust_bal_status'] === 'overdue') {
            $this->db->where('accounting_invoice.status', 1);
            $this->db->where('accounting_invoice.due_date <=', $data['end_date']);
        }

        $this->db->order_by('acs_profile.first_name', 'asc');
        $this->db->order_by('acs_profile.last_name', 'asc');

        $query = $this->db->get($this->table);

        return $query->result();
    }
    public function getTransactionInvoices($data)
    {
        $this->db->select('accounting_invoice.*, acs_profile.first_name, acs_profile.last_name, acs_profile.email');
        $this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $data['company_id']);

        if ($data['cust_bal_status'] === 'open') {
            $this->db->where('accounting_invoice.status', 1);
            $this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
            $this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);
        } elseif ($data['cust_bal_status'] === 'overdue') {
            $this->db->where_in('accounting_invoice.status', [1, 2]);
            $this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
            $this->db->where('accounting_invoice.due_date <', $data['end_date']);
        } else {
            $this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
            $this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);
        }

        $this->db->order_by('acs_profile.first_name', 'asc');
        $this->db->order_by('acs_profile.last_name', 'asc');

        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function getDataInvoices()
    {
        $this->db->select('accounting_invoice.*, acs_profile.first_name, acs_profile.last_name, acs_profile.email');
        $this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
        // $this->db->where('accounting_invoice.customer_id','acs_profile.prof_id');

        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function getInvoices()
    {
        $vendor = $this->db->get('accounting_invoice');
        return $vendor->result();
    }
    public function createInvoice($data)
    {
        $vendor = $this->db->insert('accounting_invoice', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function createInvoiceProd($data)
    {
        $vendor = $this->db->insert('product_details', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function additem_details($data)
    {
        $vendor = $this->db->insert('item_details', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function updateInvoice($id, $data)
    {
        $this->db->where('id', $id);
        $vendor = $this->db->update('accounting_invoice', $data);
        if ($vendor) {
            return true;
        } else {
            return false;
        }
    }
    public function updateInvoices($id, $data)
    {
        $this->db->where('id', $id);
        $vendor = $this->db->update('invoices', $data);
        if ($vendor) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteInvoice($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('accounting_invoice');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getInvoiceDetails($id)
    {
        $vendor = $this->db->get_where('accounting_invoice', array('id' => $id));
        return $vendor->result();
    }
    
    public function getCustomers()
    {
        $vendor = $this->db->get('acs_profile');
        return $vendor->result();
    }

    public function getCustomersInv()
    {
        // $vendor = $this->db->get('acs_profile');
        // return $vendor->result();
        // $where = array(
        //     'invoice_id'      => $id,
        //   );

        $this->db->select('*');
        $this->db->from('acs_profile');
        $this->db->join('invoices', 'acs_profile.prof_id   = invoices.customer_id');
        // $this->db->where($where);
        $query2 = $this->db->get();
        return $query2->result();
    }
    
    public function getPayTerms()
    {
        $vendor = $this->db->get('payment_term');
        return $vendor->result();
    }
    public function getCustomers_receive_payment($customer_id)
    {
        $this->db->select('*');
        $this->db->from('accounting_receive_payment');
        $this->db->where('customer_id', $customer_id);
        $vendor = $this->db->get();
        return $vendor->result();
    }
    public function get_customer_search_result($value)
    {
        $query = "SELECT * FROM  (SELECT *, CONCAT(first_name, ' ', last_name) name FROM acs_profile ) a WHERE name LIKE '%".$value."%' AND company_id = ".logged('company_id');
        $qry = $this->db->query($query);
        return $qry->result();
    }
    public function get_payements_by_customer_id($customer_id)
    {
        $this->db->select('*');

        $this->db->from('accounting_receive_payment');
        $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment.id = accounting_receive_payment_invoices.receive_payment_id');
        $this->db->join('invoices', 'accounting_receive_payment_invoices.invoice_number = invoices.invoice_number and accounting_receive_payment.customer_id = invoices.customer_id');
        
        $this->db->where('accounting_receive_payment.customer_id', $customer_id);

        $query = $this->db->get();
        return $query->result();
    }
    public function get_invoices_by_customer_id($customer_id="")
    {
        if ($customer_id!="") {
            $query = $this->db->query("SELECT * FROM invoices where customer_id = ".$customer_id." AND view_flag != 1 AND voided != 1 AND (status = 'Approved' OR status = 'Due' OR status = 'Partially Paid' OR status = 'Paid' OR status = 'Overdue')");
            // var_dump($this->db->last_query());
            return $query->result();
        }
    }
    public function get_payements_by_invoice($invoice_id)
    {
        $query = $this->db->query("SELECT accounting_receive_payment_invoices.*, accounting_receive_payment.* FROM accounting_receive_payment JOIN accounting_receive_payment_invoices ON accounting_receive_payment.id = accounting_receive_payment_invoices.receive_payment_id WHERE accounting_receive_payment.status=1 and accounting_receive_payment_invoices.invoice_id = ".$invoice_id);
        // var_dump($this->db->last_query());
        return $query->result();
    }
    public function get_filtered_invoices_by_customer_id($filter_date_from, $filter_date_to, $filter_overdue, $customer_id)
    {
        $this->db->select('*');

        $this->db->from('invoices');
        
        $this->db->where('customer_id', $customer_id);
        if ($filter_date_from != "") {
            $this->db->where('due_date >=', date("Y-m-d", strtotime($filter_date_from)));
        }
        if ($filter_date_to) {
            $this->db->where('due_date <=', date("Y-m-d", strtotime($filter_date_to)));
        }
        if ($filter_overdue == "true") {
            $this->db->where('due_date >', date("Y-m-d"));
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function get_invoice_by_invoice_no($find_inv)
    {
        $this->db->select('*');

        $this->db->from('invoices');
        
        $this->db->like('invoice_number', $find_inv);

        $query = $this->db->get();
        return $query->row();
    }
    public function get_invoice_by_invoice_id($id)
    {
        $this->db->select('*');

        $this->db->from('invoices');
        
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }
    public function get_invoice_by_estimate_id($estimate_id)
    {
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->where('estimate_id', $estimate_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_terms_by_id($term_id)
    {
        $this->db->select('*');

        $this->db->from('accounting_terms');
        
        $this->db->where('id', $term_id);

        $query = $this->db->get();
        return $query->row();
    }
    public function get_sum_of_invoices_by_customer_id($customer_id="", $start_date="", $end_date="", $statement_type="")
    {
        if ($customer_id != "") {
            $conditions ="";
            if ($statement_type=="Transaction Statement") {
                $conditions ="AND (invoices.date_issued >= '".$start_date."' AND invoices.date_issued <=  '".$end_date."')";
            }

            $sql="SELECT COUNT(invoices.id) as collectibles_count, SUM(grand_total) as total_collectibles FROM invoices WHERE customer_id = ".$customer_id." ".$conditions;
            $query = $this->db->query($sql);
            $results['collectibles']=$query->row();
            $this->db->reset_query();
            $sql="SELECT COUNT(accounting_receive_payment_invoices.id) as receive_count, SUM(accounting_receive_payment_invoices.payment_amount) as total_amount_received FROM accounting_receive_payment_invoices 
            JOIN accounting_receive_payment ON accounting_receive_payment_invoices.receive_payment_id = accounting_receive_payment.id 
            JOIN invoices ON accounting_receive_payment_invoices.invoice_id = invoices.id
            WHERE accounting_receive_payment.customer_id = ".$customer_id." ".$conditions;
            $query = $this->db->query($sql);
            $results['received']=$query->row();
            return $results;
        }
    }

    public function save_statement($data)
    {
        $query = $this->db->insert('accounting_statements', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function update_statement($data, $statement_id)
    {
        $this->db->where('id', $statement_id);
        $vendor = $this->db->update('accounting_statements', $data);
        if ($vendor) {
            return true;
        } else {
            return false;
        }
    }
    public function get_reanged_invoices_by_customer_id($customer_id, $start_date, $end_date, $statement_type="", $action="")
    {
        if ($customer_id != "") {
            $conditions ="";
            if ($statement_type=="Transaction Statement" || ($statement_type=="Balance Forward" && $action=="print")) {
                $conditions ="AND (date_issued >= '".$start_date."' AND date_issued <=  '".$end_date."')";
            }
            $sql="SELECT * FROM invoices WHERE customer_id = ".$customer_id." ".$conditions;
            $query = $this->db->query($sql);
            return $query->result();
        }
    }
    public function get_ranged_invoices_by_company_id($company_id, $start_date, $end_date)
    {
        if ($company_id != "") {
            $conditions ="AND (date_issued >= '".$start_date."' AND date_issued <=  '".$end_date."') AND (status = 'Approved' OR status = 'Due' OR status = 'Partially Paid'  OR status = 'Paid' )";
            $sql="SELECT * FROM invoices WHERE company_id = ".$company_id." ".$conditions;
            $query = $this->db->query($sql);
            return $query->result();
        }
    }
    public function get_amount_received_per_invoice($invoice_id)
    {
        $sql="SELECT SUM(payment_amount) as total_amount FROM accounting_receive_payment_invoices WHERE invoice_id = ".$invoice_id."";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function get_received_payment_by_invoice($invoice_id)
    {
        $sql="SELECT * FROM accounting_receive_payment 
        JOIN accounting_receive_payment_invoices ON accounting_receive_payment_invoices.receive_payment_id=accounting_receive_payment.id 
        WHERE accounting_receive_payment_invoices.invoice_id = ".$invoice_id."";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function check_token_available_for_shared_invoice_link($token)
    {
        $query = $this->db->query("SELECT * FROM account_shared_invoice_links WHERE token = '".$token."' and expired_at <= '".date('Y-m-d')."'");
        
        if (count($query->result()) > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function add_shared_invoice_link($data)
    {
        $query = $this->db->insert('account_shared_invoice_links', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function get_shared_invoice_link($token)
    {
        $sql="SELECT * FROM account_shared_invoice_links WHERE token = '".$token."' ";
        $query = $this->db->query($sql);
        return $query->row();
    }
    // for all sales queries
    public function get_filtered_invoices($where)
    {
        $sql="SELECT *, invoices.id as inv_id, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name, invoices.status AS INV_status FROM invoices JOIN acs_profile ON invoices.customer_id = acs_profile.prof_id JOIN business_profile ON acs_profile.company_id = business_profile.id WHERE ".$where;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_filtered_estimates($where)
    {
        $sql="SELECT * FROM estimates WHERE ".$where;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_filtered_sales_receipt($where)
    {
        $sql="SELECT * FROM accounting_sales_receipt JOIN acs_profile ON accounting_sales_receipt.customer_id  = acs_profile.prof_id WHERE ".$where;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_filtered_credit_memo($where)
    {
        $sql="SELECT * FROM accounting_credit_memo JOIN acs_profile ON accounting_credit_memo.customer_id  = acs_profile.prof_id WHERE ".$where;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_filtered_credit_statements($where)
    {
        $sql="SELECT * FROM accounting_statements JOIN accounting_statement_customers ON accounting_statements.id  = accounting_statement_customers.statement_id WHERE ".$where;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_filtered_credit_receive_payment($where)
    {
        $sql="SELECT * FROM accounting_receive_payment WHERE ".$where." ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_payements_by_invoice_and_receipt_payment_id($invoice_id, $receive_payment_id)
    {
        $sql="SELECT * FROM accounting_receive_payment_invoices JOIN accounting_receive_payment ON accounting_receive_payment_invoices.receive_payment_id = accounting_receive_payment.id WHERE accounting_receive_payment_invoices.invoice_id=".$invoice_id." and accounting_receive_payment_invoices.receive_payment_id=".$receive_payment_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
}
