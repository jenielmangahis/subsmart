<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_participants_model extends MY_Model {
	public $table = 'tasks_participants';
	public function __construct(){
		parent::__construct();
	}

	public function getAllByTaskId($task_id, $filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('task_id', $task_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getIsAssignedByTaskId($task_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('task_id', $task_id);
        $this->db->where('is_assigned', 1);
        $query = $this->db->get()->row();

        return $query;
    }

    public function deleteAllByTaskId($task_id){
		$this->db->delete($this->table, array('task_id' => $task_id));
	}
}