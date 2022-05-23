<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeds_model extends MY_Model {

	public $table = 'feed';
	
	public function __construct()
	{
		parent::__construct();
    }

    function getByCompanyId() {
        $comp_id = logged('company_id');

        $this->db->select("*");
        $this->db->where('sender_id', $comp_id);
        $res = $this->db->get($this->table)->result();
        
        return $res;
    }
}