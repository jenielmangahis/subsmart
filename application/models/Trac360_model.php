<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trac360_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($table, $data){
		$this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
	}

    public function deleteUser($table, $user_id){
        $this->db->delete($table, array('user_id' => $user_id));
    } 
}