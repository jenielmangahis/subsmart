<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_tags_model extends MY_Model {

    public $table = 'job_tags';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function getJobTagsByCompany()
	{
		$this->db->where('company_id', logged('company_id'));
        $query = $this->db->get($this->table);
	    return $query->result();
	}

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	function update($id, $data)
	{
		$this->db->where('id', $id);
		$tag = $this->db->update($this->table, ['name' => $data['name']]);

		if($tag){
			return true;
		}else{
			return false;
		}
	}
}