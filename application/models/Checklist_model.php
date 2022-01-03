<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklist_model extends MY_Model
{
    public $table = 'checklists';
    public $type_residential = 1;
    public $type_commercial  = 2;
    public $type_both = 3;

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

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($user_id, $filters=array())
    {        

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');

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

    public function getAttachType()
    {
        $types = [
            $this->type_residential => 'Residential Jobs',
            $this->type_commercial => 'Commercial Jobs',
            $this->type_both => 'Both Residential and Commercial Jobs',
        ];

        return $types;
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file Checklist_model.php */
/* Location: ./application/models/Checklist_model.php */
