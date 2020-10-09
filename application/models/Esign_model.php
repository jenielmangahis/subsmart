<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esign_model extends MY_Model {

	public $table = 'esign';
	public $categoryTable = 'esign_library_category';

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

	public function getLibraryCategory($userId = 0){
		$this->db->select(['category_id','categoryName']);
		$this->db->from($this->categoryTable);
        $this->db->where('isActive', 1);
        $this->db->where('isDefault', 1);
        $this->db->or_where('user_id', $userId);
		$query = $this->db->get();
        return $query->result_array();
	}

}

