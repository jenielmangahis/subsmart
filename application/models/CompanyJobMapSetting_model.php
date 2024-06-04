<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyJobMapSetting_model extends MY_Model {

	public $table = 'company_job_map_settings';
	
	public function __construct()
	{
		parent::__construct();
    }

    public function getByCompanyId($cid)
    {        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("company_id", $cid);
        
        $query = $this->db->get();
        return $query->row();
    }
}