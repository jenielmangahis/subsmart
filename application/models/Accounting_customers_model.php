<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_customers_model extends MY_Model {

	public $table = 'acs_profile';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getCustomers(){
	    $customer = $this->db->get('acs_profile');
	    return $customer->result();
    }
	public function createCustomer($data){
	    $customer = $this->db->insert('acs_profile', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateCustomer($id, $data){
	    $this->db->where('id', $id);
		$customer = $this->db->update('acs_profile', $data);
		if($customer){
			return true;
		}else{
			return false;
		}
    }
	public function deleteCustomer($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('acs_profile');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getCustomerDetails($id){
	    $customer = $this->db->get_where('acs_profile', array('id' => $id));
	    return $customer->result();
	}
	public function getAllByCompany() {
		$this->db->where('company_id', logged('company_id'));
		$this->db->order_by('first_name', 'asc');
		$this->db->order_by('last_name', 'asc');
		$query = $this->db->get($this->table);

		return $query->result();
	}

	public function getCompanyCustomersWithBalance() {
		$this->db->where('company_id', logged('company_id'));
		$this->db->order_by('last_name', 'asc');
		$this->db->order_by('first_name', 'asc');
		$query = $this->db->get($this->table);

		return $query->result();
	}
}