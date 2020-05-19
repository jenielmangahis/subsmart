<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerTicket_model extends MY_Model
{
    public $table = 'customer_tickets';


    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', getLoggedUserID());

        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        return $query->result();
    }
}

/* End of file CustomerTicket_model.php */
/* Location: ./application/models/CustomerTicket_model.php */
