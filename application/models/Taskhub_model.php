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
            $this->db->where('company_id', $company_id);
            $this->db->order_by('priority','DESC');
            return $this->db->get('tasks')->result();
        }
        
}