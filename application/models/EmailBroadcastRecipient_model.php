<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailBroadcastRecipient_model extends MY_Model
{
    public $table = 'email_broadcast_recipients';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByEmailBroadCastId($email_broadcast_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('email_broadcast_id', $email_broadcast_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllSentByEmailBroadCastId($email_broadcast_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('email_broadcast_id', $email_broadcast_id);
        $this->db->where('is_sent', 1);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotSentByEmailBroadCastId($email_broadcast_id, $conditions = [], $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('email_broadcast_id', $email_broadcast_id);
        $this->db->where('is_sent', 0);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        if( $limit > 0 ){
            $this->db->limit($limit);  
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllWithErrorByEmailBroadCastId($email_broadcast_id, $conditions = [], $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('email_broadcast_id', $email_broadcast_id);
        $this->db->where('is_with_error', 1);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        if( $limit > 0 ){
            $this->db->limit($limit);  
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteAllByEmailBroadcastId($email_broadcast_id)
    {
        $this->db->where('email_broadcast_id', $email_broadcast_id);
        $this->db->delete($this->table);
    }
}

/* End of file EmailBroadcast_model.php */
/* Location: ./application/models/EmailBroadcast_model.php */
