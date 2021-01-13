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
}