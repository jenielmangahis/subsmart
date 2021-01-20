<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_template_folders_model extends MY_Model {

	public $table = 'form_template_folders';
	
	public function __construct()
	{
		parent::__construct();
    }
    
	function getAll()
	{
		try {
			$this->db->select("*");
			
			$q = $this->db->get($this->table);
			$res = [
				'data' 	=> $q->result(),
				'code'	=> 200,
				'message'	=> 'Folders fetched successfully'
			];
		}catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error fetching folders. please try again later or contact customer support.'
			];
		}
		return $res;
	}

	function create($data)
	{
		try {
			$this->db->insert($this->table, $data);
			$response = [
				'code' 		=> 200,
				'message' 	=> 'created',
				'data'		=> []
			];
		} catch(\Exception $e) {
			$response = [
				'code' 		=> 500,
				'message' 	=> $e->getMessage(),
				'data'		=> []
			];
		}

	    return $response;
	}

	function update($data, $id){
		try {
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			
			$response = [
				'code' 		=> 200,
				'message' 	=> 'updated',
				'data'		=> []
			];
		} catch(\Exception $e) {
			$response = [
				'code' 		=> 500,
				'message' 	=> $e->getMessage(),
				'data'		=> []
			];
		}

	    return $response;
	}

	function destroy($id) {
		try {
			$this->db->where('id', $id);
			$this->db->delete($this->table);
			$response = [
				'code' 		=> 200,
				'message' 	=> 'deleted',
				'data'		=> []
			];
		} catch(\Exception $e) {
			$response = [
				'code' 		=> 500,
				'message' 	=> $e->getMessage(),
				'data'		=> []
			];
		}
		return $response;
	}
}