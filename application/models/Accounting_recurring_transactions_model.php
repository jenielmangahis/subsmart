<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_recurring_transactions_model extends MY_Model
{
    public $table = 'accounting_recurring_transactions';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getCompanyRecurringTransactions($where, $columnName, $order)
    {
        return $this->db->where($where)->order_by($columnName, $order)->get($this->table)->result_array();
    }

    public function delete($id)
    {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])
                ->update($this->table, ['status' => 0, 'updated_at' => date('Y-m-d h:i:s')]);
    }

    public function updateRecurringTransaction($id, $data)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function getRecurringTransaction($id)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('id', $id);
        $this->db->where('status != 0');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    public function getAllByCompany_id($customer_id)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
