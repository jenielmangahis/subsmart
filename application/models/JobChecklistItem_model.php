<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobChecklistItem_model extends MY_Model
{
    public $table = 'job_checklist_items';

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

    public function getAllByJobChecklistId($job_checklist_id, $filters=array())
    {

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('job_checklist_id', $job_checklist_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteAllByJobChecklistId($job_checklist_id){
        $this->db->delete($this->table, array('job_checklist_id' => $job_checklist_id));
    }
}

/* End of file JobChecklistItem_model.php */
/* Location: ./application/models/JobChecklistItem_model.php */
