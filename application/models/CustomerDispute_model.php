<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDispute_model extends MY_Model
{

    public $table = 'customer_disputes';

    public function getAll()
    {

        $this->db->select('customer_disputes.*, furnishers.name AS furnisher_name');
        $this->db->from($this->table);
        $this->db->join('furnishers', 'customer_disputes.furnisher_id = furnishers.id');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCustomerId($customer_id)
    {

        $this->db->select('customer_disputes.*, furnishers.name AS furnisher_name');
        $this->db->from($this->table);
        $this->db->join('furnishers', 'customer_disputes.furnisher_id = furnishers.id');
        $this->db->where('customer_disputes.prof_id', $customer_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('customer_disputes.*, furnishers.name AS furnisher_name, company_reasons.reason');
        $this->db->from($this->table);
        $this->db->join('furnishers', 'customer_disputes.furnisher_id = furnishers.id');
        $this->db->join('company_reasons', 'customer_disputes.company_reason_id = company_reasons.id');
        $this->db->where('customer_disputes.id', $id); 

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCustomerId($id, $customer_id)
    {
        $this->db->select('customer_disputes.*, furnishers.name AS furnisher_name');
        $this->db->from($this->table);
        $this->db->join('furnishers', 'customer_disputes.furnisher_id = furnishers.id');
        $this->db->where('customer_disputes.id', $id); 
        $this->db->where('customer_disputes.prof_id', $customer_id); 

        $query = $this->db->get();
        return $query->row();
    }

    public function saveDispute($post_data)
    {
        $this->db->insert($this->table, $post_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file CustomerDispute_model.php */
/* Location: ./application/models/CustomerDispute_model.php */
