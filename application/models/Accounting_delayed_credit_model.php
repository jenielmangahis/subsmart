<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_delayed_credit_model extends MY_Model
{
    public $table = 'accounting_delayed_Credit';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getDelayedCredit()
    {
        $query = $this->db->get('accounting_delayed_Credit');
        return $query->result();
    }
    public function createDelayedCredit($data)
    {
        $query = $this->db->insert('accounting_delayed_Credit', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function updateDelayedCredit($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('accounting_delayed_Credit', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteDelayedCredit($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('accounting_delayed_Credit');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getDelayedCreditDetails($id)
    {
        $query = $this->db->get_where('accounting_delayed_credit', array('id' => $id));
        return $query->row();
    }
	public function delete_delayed_credit_items($delayed_credit_id)
	{
		$this->db->delete('accounting_delayed_credits_items', array('delayed_credit_id'=>$delayed_credit_id));
	}
	public function additem_details($data)
    {
        $this->db->insert('accounting_delayed_credits_items', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function get_company_delayed_credits($filters = [])
    {
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('status !=', 0);
		$this->db->where('recurring', null);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_customer_delayed_credits($customerId, $companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('customer_id', $customerId);
		$this->db->where('recurring', null);
        $this->db->where_not_in('status', [0, 2]);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_unbilled_credits()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('remaining_balance >', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
