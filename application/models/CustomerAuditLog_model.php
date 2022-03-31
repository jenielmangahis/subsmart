<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerAuditLog_model extends MY_Model
{

    public $table = 'customer_audit_logs';

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id); 

        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByCustomerId($customer_id)
    {

        $this->db->select('*');
        $this->db->select('customer_audit_logs.*, CONCAT(users.FName, " ", users.LName)AS employee_name');
        $this->db->join('users', 'customer_audit_logs.user_id = users.id');
        $this->db->from($this->table);
        $this->db->where('prof_id', $customer_id);
        $this->db->order_by("customer_audit_logs.id DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file CustomerAuditLog_model.php */
/* Location: ./application/models/CustomerAuditLog_model.php */
