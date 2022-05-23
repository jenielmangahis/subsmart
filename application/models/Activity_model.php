<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends MY_Model {

	public $table = 'activity_logs';
	public $esign_table = 'esign_activity';

	public function __construct()
	{
		parent::__construct();
	}

	public function add($message, $user_id = 0, $ip_address = false)
	{
		return $this->create([
			'title' => $message,
			'user' => ($user_id==0) ? logged('id') : $user_id,
			'ip_address' => !empty($ip_address) ? $ip_address : ip_address()
		]);
	}
	
	public function addEsignActivity($data){
		return $this->db->insert($this->esign_table, $data); 	
	}

    public function getActivity($userId, $limit=[], $isHistoryActivity = 0){
        $loginActivities = ['User Login', 'User Logout'];
        $this->db->where('user_id', $userId);
        if($isHistoryActivity){
            $this->db->where_in('activityName', $loginActivities);
		}else {
            $this->db->where_not_in('activityName', $loginActivities);
		}
		if(sizeof($limit) > 1) {
            $this->db->limit($limit[0] , $limit[1]);
		}
		$this->db->order_by("createdAt", "desc");
		return $this->db->get($this->esign_table)->result_array();
		$result = $this->db->get($this->esign_table);
		if($result){
            return $result->result_array();
        }else{
            return false;
        }
	}
	
}

/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */