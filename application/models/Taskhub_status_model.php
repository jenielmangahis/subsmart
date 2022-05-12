<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_status_model extends MY_Model {
	public $table = 'tasks_status';
	public function __construct(){
		parent::__construct();
	}

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('status_text', $filters['search'], 'both');
            }
        }

        $this->db->order_by('status_id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

	public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_id', $id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function updateByStatusId($status_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('status_id', $status_id);
        $this->db->update();
    }
}