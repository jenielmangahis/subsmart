<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_model extends MY_Model {
	public $table = 'tasks';
	public function __construct(){
		parent::__construct();

		$this->table_key = 'task_id';
	}
        
        public function getTask($company_id)
        {
            $this->db->join('tasks_participants','tasks.task_id = tasks_participants.task_id', 'left');
            $this->db->join('users','users.id = tasks_participants.user_id', 'left');
            $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','right');
            $this->db->where('tasks.company_id', $company_id);
            $this->db->order_by('priority','DESC');
            return $this->db->get('tasks')->result();
        }
        
}