<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsTransactionHistory_model extends MY_Model
{
    public $table = 'acs_transaction_history';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCustomerId($customer_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file AcsTransactionHistory_model.php */
/* Location: ./application/models/AcsTransactionHistory_model.php */
