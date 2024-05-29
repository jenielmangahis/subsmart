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
        $this->db->order_by('tasks.task_id','DESC');
        return $this->db->get('tasks')->result();
    }

    public function getOngoingTasksByCompanyId($company_id)
    {
        $this->db->join('tasks_participants','tasks.task_id = tasks_participants.task_id', 'left');
        $this->db->join('users','users.id = tasks_participants.user_id', 'left');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','right');
        $this->db->where('tasks.company_id', $company_id);
        $this->db->where('tasks.status_id <>', 6);
        $this->db->order_by('priority','DESC');
        $this->db->order_by('tasks.task_id','DESC');
        return $this->db->get('tasks')->result();
    }

    public function getById($id)
    {
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color, CONCAT(acs_profile.first_name," ",acs_profile.last_name)AS customer_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile','tasks.prof_id = acs_profile.prof_id', 'left');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->where('tasks.task_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByCompanyIdOld($company_id)
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

    public function getAllByCompanyIdAndStatusOld($company_id, $status_id)
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color, CONCAT(acs_profile.first_name," ",acs_profile.last_name)AS customer_name');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->join('acs_profile','tasks.prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);

        $this->db->where('tasks.company_id', $company_id);
        $this->db->where('tasks.status_id', $status_id);
        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }    

    public function getAllByStatusId($status_id)
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color, CONCAT(acs_profile.first_name," ",acs_profile.last_name)AS customer_name');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->join('acs_profile','tasks.prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);

        $this->db->where('tasks.status_id', $status_id);
        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByPriority($priority)
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color, CONCAT(acs_profile.first_name," ",acs_profile.last_name)AS customer_name');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','left');
        $this->db->join('acs_profile','tasks.prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);

        $this->db->where('tasks.priority', $priority);
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

    public function getAllByTaskIds($ids = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where_in('task_id', $ids);
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

    public function getAll($filters=array())
    {
        $id = $user_id;
        $this->db->select('tasks.*, tasks_status.status_text, tasks_status.status_color, CONCAT(acs_profile.first_name," ",acs_profile.last_name)AS customer_name,business_profile.business_name');
        $this->db->join('tasks_status','tasks.status_id = tasks_status.status_id','LEFT');
        $this->db->join('acs_profile','tasks.prof_id = acs_profile.prof_id', 'LEFT');
        $this->db->join('business_profile', 'tasks.company_id = business_profile.company_id', 'LEFT'); 
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('tasks.subject', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('tasks.date_created','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function updateByTaskId($task_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('task_id', $task_id);
        $this->db->update();
    }

    public function completeAllTasksByCompanyId($company_id)
    {
        $this->db->from($this->table);
        $this->db->set(['status_id' => 6]);
        $this->db->where('company_id', $company_id);
        $this->db->update();
    }

    public function completeAllTasksByProfId($prof_id)
    {
        $this->db->from($this->table);
        $this->db->set(['status_id' => 6]);
        $this->db->set(['date_completed' => date('Y-m-d')]);
        $this->db->where('prof_id', $prof_id);
        $this->db->update();
    }

    public function completeAllTasksByTaskId($ids = array())
    {
        $this->db->from($this->table);
        $this->db->set(['status_id' => 6]);
        $this->db->set(['status' => 'Closed']);
        $this->db->set(['date_completed' => date('Y-m-d')]);
        $this->db->where_in('task_id', $ids);
        $this->db->update();
    }

    public function onGoingAllTasksByTaskId($ids = array())
    {
        $this->db->from($this->table);
        $this->db->set(['status_id' => 2]);
        $this->db->where_in('task_id', $ids);
        $this->db->update();
    }


    public function deleteByTaskId($task_id){
        $this->db->delete($this->table, array('task_id' => $task_id));
    }

    public function optionPriority(){
        $options = [
            'Low' => 'Low',
            'Medium' => 'Medium',
            'High' => 'High'
        ];

        return $options;
    }

    public function getAllByCompanyId($cid, $date_range = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);

        if( !empty($date_range) ){
            $date_start = $date_range['from'] . ' 00:00:00';
            $date_end   = $date_range['to'] . ' 23:59:59';
            $this->db->where("date_created >= ", $date_start);
            $this->db->where("date_created <= ", $date_end);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyIdAndPriority($cid, $priority, $date_range = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('priority', $priority);

        if( !empty($date_range) ){
            $date_start = $date_range['from'] . ' 00:00:00';
            $date_end   = $date_range['to'] . ' 23:59:59';
            $this->db->where("date_created >= ", $date_start);
            $this->db->where("date_created <= ", $date_end);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllOngoingTasksByCompanyId($cid, $date_range = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('status !=', 'Done');
        $this->db->where('status !=', 'Closed');

        if( !empty($date_range) ){
            $this->db->where("date_due >= ", $date_range['from']);
            $this->db->where("date_due <= ", $date_range['to']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyIdAndStatus($cid, $status, $date_range = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('status', $status);

        if( !empty($date_range) ){
            $date_start = $date_range['from'] . ' 00:00:00';
            $date_end   = $date_range['to'] . ' 23:59:59';
            $this->db->where("date_created >= ", $date_start);
            $this->db->where("date_created <= ", $date_end);
        }

        $query = $this->db->get();
        return $query->result();
    }
        
}
