<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GoogleCalendarSync_model extends MY_Model
{
    public $table = 'google_calendar_sync';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);
        $this->db->order_by('id', 'DESC');

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

    public function getByObjectIdAndModuleName($object_id, $module_name)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('object_id', $object_id);
        $this->db->where('module_name', $module_name);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllToSync($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_sync', 0);
        $this->db->where('is_with_error', 0);
        //$this->db->where('error_msg', null);
        $this->db->order_by('id', 'ASC');

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file BookingCoupon_model.php */
/* Location: ./application/models/BookingCoupon_model.php */
