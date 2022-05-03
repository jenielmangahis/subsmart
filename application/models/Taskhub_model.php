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

    public function getById($id)
    {
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color, CONCAT(acs_profile.first_name," ",acs_profile.last_name)AS customer_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile','tasks.prof_id = acs_profile.prof_id', 'left');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','right');
        $this->db->where('tasks.task_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByCompanyId($company_id)
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color, CONCAT(acs_profile.first_name," ",acs_profile.last_name)AS customer_name');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->join('acs_profile','tasks.prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);

        $this->db->where('tasks.company_id', $company_id);
        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotCompletedTasksByCompanyId($company_id)
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->from($this->table);

        $this->db->where('tasks.company_id', $company_id);
        $this->db->where('tasks.status_id <>', 6); //Refer to task status table. 6 = completed
        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotCompletedTasksByCustomerId($customer_id)
    {
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->from($this->table);

        $this->db->where('tasks.prof_id', $customer_id);
        $this->db->where('tasks.status_id <>', 6); //Refer to task status table. 6 = completed
        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllTasksByCompanyIdAndStatusId($company_id, $status_id)
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->from($this->table);

        $this->db->where('tasks.company_id', $company_id);
        $this->db->where('tasks.status_id', $status_id); //Refer to task status table. 6 = completed
        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllTasksByCustomerIdAndStatusId($customer_id, $status_id)
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->from($this->table);

        $this->db->where('tasks.prof_id', $customer_id);
        $this->db->where('tasks.status_id', $status_id); //Refer to task status table. 6 = completed
        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyTasksWithFilter($company_id, $keyword, $status_id , $date_range = array())
    {
        $this->db->select('tasks.*, DATE_FORMAT(tasks.estimated_date_complete,\'%b %d, %Y\') as estimated_date_complete_formatted, DATE_FORMAT(tasks.date_created,\'%b %d, %Y\') as date_created_formatted, tasks_status.status_text, tasks_status.status_color');
        //$this->db->join('tasks_participants','tasks.task_id = tasks_participants.task_id', 'left');
        //$this->db->join('users','users.id = tasks_participants.user_id', 'left');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','right');
        $this->db->where('tasks.company_id', $company_id);

        if( $status_id > 0 ){
            $this->db->where('tasks.status_id', $status_id);            
        }

        if( !empty($date_range) ){
            $this->db->where('tasks.date_created >=', $date_range['from']);         
            $this->db->where('tasks.date_created <=', $date_range['to']);         
        }

        if ( $keyword != '' ) {
            $this->db->like('tasks.subject', $keyword, 'both');
        }

        $this->db->order_by('priority','DESC');
        return $this->db->get('tasks')->result();
    }

    public function saveTask($post_data)
    {
        $this->db->insert($this->table, $post_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
        
}