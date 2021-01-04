<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($data){
		$this->db->insert('tags', $data);
		$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
	}

    public function addtagGroup($data){
		$this->db->insert('tags_group', $data);
		$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
	}
}