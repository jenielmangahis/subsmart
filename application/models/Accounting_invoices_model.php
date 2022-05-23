<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_invoices_model extends MY_Model {

	public $table = 'accounting_invoice';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getCustomerOverdueInvoices($data){
		$this->db->select('accounting_invoice.*');
		$this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
		$this->db->where('acs_profile.company_id', $data['company_id']);
		$this->db->where('accounting_invoice.customer_id', $data['customer_id']);
		$this->db->where('accounting_invoice.status', 1);
		$this->db->where('accounting_invoice.due_date <=', $data['end_date']);

		$query = $this->db->get($this->table);

		return $query->result();
	}
	public function getCustomerInvoicesByDate($data){
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
	public function getCustomerOpenInvoices($data){
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
	public function getCustomerTransactions($data){
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
	public function getStatementInvoices($data){
		$this->db->select('accounting_invoice.*, acs_profile.first_name, acs_profile.last_name, acs_profile.email');
		$this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
		$this->db->where('acs_profile.company_id', $data['company_id']);

		if($data['cust_bal_status'] === 'open') {
			$this->db->where('accounting_invoice.status', 1);
			$this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
			$this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);

			$this->db->or_where('accounting_invoice.status', 1);
			$this->db->where('acs_profile.company_id', $data['company_id']);
			$this->db->where('accounting_invoice.due_date <=', $data['end_date']);
		} else if($data['cust_bal_status'] === 'overdue') {
			$this->db->where('accounting_invoice.status', 1);
			$this->db->where('accounting_invoice.due_date <=', $data['end_date']);
		}

		$this->db->order_by('acs_profile.first_name', 'asc');
		$this->db->order_by('acs_profile.last_name', 'asc');

		$query = $this->db->get($this->table);

		return $query->result();
	}
	public function getTransactionInvoices($data){
		$this->db->select('accounting_invoice.*, acs_profile.first_name, acs_profile.last_name, acs_profile.email');
		$this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
		$this->db->where('acs_profile.company_id', $data['company_id']);

		if($data['cust_bal_status'] === 'open') {
			$this->db->where('accounting_invoice.status', 1);
			$this->db->where('accounting_invoice.invoice_date >=', $data['start_date']);
			$this->db->where('accounting_invoice.invoice_date <=', $data['end_date']);
		} else if($data['cust_bal_status'] === 'overdue') {
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

	public function getDataInvoices(){
		$this->db->select('accounting_invoice.*, acs_profile.first_name, acs_profile.last_name, acs_profile.email');
		$this->db->join('acs_profile', 'accounting_invoice.customer_id = acs_profile.prof_id', 'left');
		// $this->db->where('accounting_invoice.customer_id','acs_profile.prof_id');

		$query = $this->db->get($this->table);

		return $query->result();
	}

	public function getInvoices(){
	    $vendor = $this->db->get('accounting_invoice');
		return $vendor->result();
    }
	public function createInvoice($data){
	    $vendor = $this->db->insert('accounting_invoice', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
	}
	public function createInvoiceProd($data){
	    $vendor = $this->db->insert('product_details', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }
	public function updateInvoice($id, $data){
	    $this->db->where('id', $id);
		$vendor = $this->db->update('accounting_invoice', $data);
		if($vendor){
			return true;
		}else{
			return false;
		}
    }
	public function deleteInvoice($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_invoice');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getInvoiceDetails($id){
	    $vendor = $this->db->get_where('accounting_invoice', array('id' => $id));
	    return $vendor->result();
	}
	
	public function getCustomers(){
	    $vendor = $this->db->get('acs_profile');
	    return $vendor->result();
	}
	
	public function getPayTerms(){
		$vendor = $this->db->get('payment_term');
	    return $vendor->result();
	}
}