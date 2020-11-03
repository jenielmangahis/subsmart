<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esign_model extends MY_Model {

	public $table = 'esign';
	public $categoryTable = 'esign_library_category';
	public $libraryTable = 'esign_library_template';
	public $defaultLibraryTable = 'esign_default_library_template';
	public $librariesMaster = 'esign_library_master';

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

	public function getLibraryCategory($userId = 0, $libraryId = 0){
		$this->db->where('CM.isActive', 1)
		->where('LM.isActive', 1)
		->group_start()
		->where('CM.isDefault',1)
		->or_where('CM.user_id',$userId )
		->group_end()
		->group_start()
		->where('LM.userId',null)
		->or_where('LM.userId',$userId )
		->group_end()
		->select(['CM.category_id', 'CM.categoryName', 'CM.isDefault', 'CM.fk_esignLibraryMaster', 'LM.libraryName'])
		->join( $this->librariesMaster. " AS LM", 'LM.pk_esignLibraryMaster = CM.fk_esignLibraryMaster')
		->from($this->categoryTable." AS CM");
		if($libraryId){
			$this->db->where('CM.fk_esignLibraryMaster', $libraryId);
		}
		$query = $this->db->get();
        return $query->result_array();
	}


	public function updateLibraryCategory($whereClouser, $dataToUpdate){
		foreach($whereClouser as $key => $val) {
			$this->db->where($key, $val);
		}
		return $this->db->update($this->categoryTable,$dataToUpdate);
	}


	public function getLibraryWithCategory($userId){
		return $this->db->from($this->libraryTable . " AS LT")
		->where('LT.user_id',$userId )
		->where('LT.isActive',1 )
		->join( $this->categoryTable. " AS CT", 'CT.category_id = LT.category_id')
		->select('LT.esignLibraryTemplateId, LT.title, LT.isActive, CT.categoryName, LT.isFavorite')
		->get()->result_array();
	}

	public function getLibraries($userId = 0){
		$this->db->from($this->librariesMaster)
		->select('libraryName, pk_esignLibraryMaster, userId')
		->where('isActive',1 )
		->group_start()
		->where('userId',null);
		if($userId){
			$this->db->or_where('userId', $userId, null, false);
		}
		$this->db->group_end();
		return $this->db->get()->result_array();
	}
	public function updateLibraryMaster($whereClouser, $dataToUpdate){
		foreach($whereClouser as $key => $val) {
			$this->db->where($key, $val);
		}
		return $this->db->update($this->librariesMaster,$dataToUpdate);
	}
	public function updateLibraryTemplate($whereClouser, $dataToUpdate){
		foreach($whereClouser as $key => $val) {
			$this->db->where($key, $val);
		}
		return $this->db->update($this->libraryTable,$dataToUpdate);
	}

	public function getAllDefaultLibrary($userId = 0){
		return $this->db->from($this->defaultLibraryTable)
		->where('isActive', 1)
		->select("title, content, category_id, status,  $userId as user_id ")
		->get()->result_array();
	}

	public function insertBatchUserWiseTemplate($data){
		// return $this->db->insert_batch($this->libraryTable, $data); 
		return $this->db->insert_batch($this->libraryTable, $data); 
	}

	public function insertCategory($data){
		return $this->db->insert($this->categoryTable, $data); 
	}
	
	public function insertLibrary($data){
		return $this->db->insert($this->librariesMaster, $data); 
	}
	
}

