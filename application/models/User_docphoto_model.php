<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_docphoto_model extends MY_Model {

	public $table = 'user_docphoto';

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch($user_id = 0)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('user_id', $user_id);

		$query = $this->db->get();
		return $query->result();
	}

	 public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    public function getUser($user_id) {

		$parent_id = getLoggedUserID();
		// $cid=logged('company_id');

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('user_id', $user_id);
		// $this->db->where('role !=', 1);
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		return $query->result();
	}

}

