<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TimesheetTeamMember_model extends MY_Model
{
    public $table = 'timesheet_team_members';

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
        $this->db->order_by('sort', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAllByUserId($user_id)
    {
        $id = $user_id;
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $id);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }     

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function deleteByUserId($user_id){

        $this->db->delete($this->table, array('user_id' => $user_id));

    }
}

/* End of file BookingCoupon_model.php */
/* Location: ./application/models/BookingCoupon_model.php */
