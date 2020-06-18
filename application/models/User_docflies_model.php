<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_docflies_model extends MY_Model {

	public $table = 'user_docfile';

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
		$cid=logged('company_id');

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row();
	}

}