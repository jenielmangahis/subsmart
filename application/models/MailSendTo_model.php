<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MailSendTo_model extends MY_Model
{
    public $table = 'cron_mail_send_to';
   
    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like($filters['field'], $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllToSend()
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_sent', 0);
        $this->db->where('is_with_error', 0);
        $this->db->limit(10);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function updateSendTo($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }
}

/* End of file MailSendTo_model.php */
/* Location: ./application/models/MailSendTo_model.php */
