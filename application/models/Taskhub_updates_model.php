<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_updates_model extends MY_Model {
	public $table = 'tasks_updates';
	public function __construct(){
		parent::__construct();

		$this->table_key = 'update_id';
	}

    public function getAllActivityByTaskId($task_id, $limit = 15)
    {
		$this->db->select('tasks_updates.*, users.FName, users.LName');
		$this->db->join('users', 'tasks_updates.performed_by = users.id','left');
        $this->db->from($this->table);
        $this->db->where('tasks_updates.task_id', $task_id);
        $this->db->order_by('tasks_updates.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result();
    }	

    public function getAllActivityByCompanyId($company_id)
    {
        $this->db->select('tasks_updates.*, tasks.title AS task_name');
        $this->db->join('tasks', 'tasks_updates.task_id = tasks.task_id','left');
        $this->db->from($this->table);
        $this->db->where('tasks.company_id', $company_id);
        $this->db->order_by('tasks_updates.id', 'DESC');

        $query = $this->db->get();

        return $query->result();
    }	
}