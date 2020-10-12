<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esign_model extends MY_Model {

	public $table = 'esign';
	public $categoryTable = 'esign_library_category';
	public $libraryTable = 'esign_library_template';

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
		$whereClouser = "(isActive = 1 AND ( isDefault = 1 OR user_id = $userId ) )";
		$this->db->select(['category_id','categoryName']);
		$this->db->from($this->categoryTable);
        $this->db->where($whereClouser);
		$query = $this->db->get();
        return $query->result_array();
	}

	public function getLibraryWithCategory($userId){
		return $this->db->from($this->libraryTable . " AS LT")
		->where('LT.user_id',$userId )
		->where('LT.isActive',1 )
		->join( $this->categoryTable. " AS CT", 'CT.category_id = LT.category_id')
		->select('LT.esignLibraryTemplateId, LT.title, LT.isActive, CT.categoryName, LT.isFavorite')
		->get()->result_array();
	}

}

