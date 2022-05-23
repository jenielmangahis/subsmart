<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliate_model extends MY_Model {

	public $table = 'affiliates';

	public function __construct()
	{
		parent::__construct();
	}

	public function add()
	{
		return $this->create([
			'title' => $message,
			'user' => ($user_id==0) ? logged('id') : $user_id,
			'ip_address' => !empty($ip_address) ? $ip_address : ip_address()
		]);
	}

	public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
	}

	public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
	}

	public function getByName($fname, $lname)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('first_name', $fname);
        $this->db->where('last_name', $lname);
        $query = $this->db->get();
        return $query->result();
    }
	
	function getRows($params = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function insert($data = array()) {
        if(!empty($data)){     

            $insert = $this->db->insert($this->table, $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
	}
	
	public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("date_created", $data)){
                $data['date_created'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

}

/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */