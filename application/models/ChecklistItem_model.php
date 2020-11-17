<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChecklistItem_model extends MY_Model
{
    public $table = 'checklist_items';

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

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByChecklistId($checklist_id)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('checklist_id', $checklist_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file ChecklistItem_model.php */
/* Location: ./application/models/ChecklistItem_model.php */
