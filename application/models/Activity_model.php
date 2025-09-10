<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends MY_Model {

	public $table = 'activity_logs';
	public $esign_table = 'esign_activity';

	public function __construct()
	{
		parent::__construct();
	}

    public function getAll($conditions = [], $limit = 0)
    {
        $this->db->select('*');        
        $this->db->from($this->table);

        if ( !empty($conditions) ) {
            foreach($conditions as $c){
                $this->db->where($c['field'], $c['value']);
            }
        }

        $this->db->order_by('activity_logs.id', 'ASC');

        if( $limit > 0 ){
            $this->db->limit($limit);
        } 

        $query = $this->db->get();
        return $query->result();
    }  
        
    public function getActivityLogs($company_id, $order_by = '', $limit = 0)
    {
        $this->db->select('activity_logs.*, users.FName AS first_name, users.LName AS last_name, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'activity_logs.user_id = users.id', 'LEFT');
        $this->db->where('activity_logs.company_id', $company_id);            
        $this->db->where('activity_logs.is_archived', 'No');             

        if( $order_by ){
            $this->db->order_by($order_by['field'], $order_by['sort']);
        }else{
            $this->db->order_by('activity_logs.id', 'DESC');
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }            

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllArchivedActivityLogs($company_id, $order_by = [], $limit = 0)
    {
        $this->db->select('activity_logs.*, users.FName AS first_name, users.LName AS last_name, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'activity_logs.user_id = users.id', 'LEFT');
        $this->db->where('activity_logs.company_id', $company_id);            
        $this->db->where('activity_logs.is_archived', 'Yes');             

        if( $order_by ){
            $this->db->order_by($order_by['field'], $order_by['sort']);
        }else{
            $this->db->order_by('activity_logs.id', 'DESC');
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }            

        $query = $this->db->get();
        return $query->result();
    }

    public function getActivityLogsByUserId($user_id, $limit = 0)
    {
        $this->db->select('activity_logs.*, users.FName AS first_name, users.LName AS last_name, users.email');
        $this->db->join('users', 'activity_logs.user_id = users.id', 'LEFT');
        $this->db->where('users.id', $user_id);            
        $this->db->order_by('activity_logs.id', 'DESC');
        if( $limit > 0 ){
            $this->db->limit($limit);
        }            

        return $this->db->get($this->table)->result();
    }

	public function add($message, $user_id = 0, $company_id = 0, $ip_address = false)
	{
		return $this->create([
            'company_id' => $company_id,
			'activity_name' => $message,
			'user_id' => $user_id,			
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
	}
	
	public function addEsignActivity($data){
		$data['company_id'] = logged('company_id');		
		return $this->db->insert($this->esign_table, $data); 	
	}

	public function getAllByCompanyId($company_id, $filters=array(), $conditions=array())
    {

        $this->db->select('activity_logs.*, users.id AS uid');
        $this->db->from($this->table);
        $this->db->join('users', 'activity_logs.user_id = users.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->where('activity_logs.company_id', $company_id);
        $this->db->order_by('activity_logs.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
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

    public function bulkUpdate($ids = [], $data = [], $filters = [])
    {
        $this->db->where_in('id', $ids);
        
        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function bulkDelete($ids = [], $filters = [])
    {
        if( count($ids) > 0 ){
            $this->db->where_in('id', $ids);

            if( $filters ){
                foreach( $filters as $filter ){
                    $this->db->where($filter['field'], $filter['value']);
                }
            }

            $this->db->delete($this->table);
        }        

        return $this->db->affected_rows();
    }

    public function deleteAllArchived($filters = [])
    {
        $this->db->where('is_archived', 'Yes');

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
	
}

/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */