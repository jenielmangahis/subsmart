<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketSettings_model extends MY_Model
{

    public $table = 'ticket_settings';

    public function getByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where('company_id',$cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);  
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}

?>