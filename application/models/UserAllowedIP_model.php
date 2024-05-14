<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserAllowedIP_model extends MY_Model
{
    public $table = 'user_allowed_ip';

    public function getAllByUserId($user_id, $conditions = [], $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                if ($c['field'] != '' && $c['value'] != '') {
                    $this->db->where($c['field'], $c['value']);
                }
            }
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByIPAddress($ip_address, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('ip_address', $ip_address);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                if ($c['field'] != '' && $c['value'] != '') {
                    $this->db->where($c['field'], $c['value']);
                }
            }
        }

        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getByUserIdAndIPAddress($user_id, $ip_address)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('user_id', $user_id);
        $this->db->where('ip_address', $ip_address);
        $query = $this->db->get()->row();

        return $query;
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('id', $id);
        $query = $this->db->get()->row();

        return $query;
    }
}

/* End of file UserAllowedIP_model.php */
/* Location: ./application/models/UserAllowedIP_model.php */
