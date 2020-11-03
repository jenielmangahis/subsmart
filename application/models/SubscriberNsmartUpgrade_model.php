<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubscriberNsmartUpgrade_model extends MY_Model
{
    public $table = 'subscriber_nsmart_upgrades';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

}

/* End of file SubscriberNsmartUpgrade_model.php */
/* Location: ./application/models/SubscriberNsmartUpgrade_model.php */
