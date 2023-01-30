<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_delayed_charge_model extends MY_Model {

	public $table = 'accounting_delayed_charge';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getDelayedCharges(){
	    $query = $this->db->get('accounting_delayed_charge');
	    return $query->result();
    }
	public function createDelayedCharge($data){
	    $query = $this->db->insert('accounting_delayed_charge', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateDelayedCharge($id, $data){
	    $this->db->where('id', $id);
		$query = $this->db->update('accounting_delayed_charge', $data);
		if($query){
			return true;
		}else{
			return false;
		}
    }
	public function deleteDelayedCharge($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_delayed_charge');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getDelayedChargeDetails($id){
	    $query = $this->db->get_where('accounting_delayed_charge', array('id' => $id));
	    return $query->row();
    }
	public function delete_delayed_charge_items($delayed_charge_id)
	{
		$this->db->delete('accounting_delayed_charge_items', array('delayed_charge_id'=>$delayed_charge_id));
	}
	public function additem_details($data)
    {
        $this->db->insert('accounting_delayed_charge_items', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

	public function get_company_delayed_charges($filters = [])
    {
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('status !=', 0);
		$this->db->where('recurring', null);
        $query = $this->db->get($this->table);
        return $query->result();
    }

	public function get_customer_delayed_charges($customerId, $companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('customer_id', $customerId);
		$this->db->where('recurring', null);
        $this->db->where_not_in('status', [0, 2]);
        $query = $this->db->get($this->table);
        return $query->result();
    }

	public function get_unbilled_charges()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('remaining_balance >', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}