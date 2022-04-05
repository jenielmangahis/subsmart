<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerMessageReply_model extends MY_Model
{

    public $table = 'customer_message_replies';

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
        $this->db->join('acs_profile', 'customer_messages.prof_id  = acs_profile.prof_id');                
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByCustomerMessageId($customer_message_id)
    {        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_message_id', $customer_message_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file CustomerMessageReply_model.php */
/* Location: ./application/models/CustomerMessageReply_model.php */
