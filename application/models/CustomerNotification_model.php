<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerNotification_model extends MY_Model
{
    public $table = 'customer_notifications';
    public $status_new  = 'New';
    public $status_read = 'Read'; 
   
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

    public function getAllByProfId($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByProfIdAndModule($prof_id, $module)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);
        $this->db->where('module', $module);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByProfIdAndStatus($prof_id, $status)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);
        $this->db->where('status', $status);

        $query = $this->db->get();
        return $query->result();
    }

    public function clearAllNotificationByProfId($prof_id)
    {
        $this->db->from($this->table);
        $this->db->set(['status' => $this->status_read]);
        $this->db->where('prof_id', $prof_id);
        $this->db->update();
    }

    public function statusNew()
    {
        return $this->status_new;
    }

    public function statusRead()
    {
        return $this->status_read;
    }
}

/* End of file CustomerNotification_model.php */
/* Location: ./application/models/CustomerNotification_model.php */
