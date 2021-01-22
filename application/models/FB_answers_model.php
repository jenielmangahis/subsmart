<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_answers_model extends MY_Model {

	public $table = 'form_element_matrix_rows';
	
	public function __construct()
	{
		parent::__construct();
    }
    
	function create($data)
	{
		
		try {
			$this->db->insert($this->table, $data);
			$newID = $this->db->insert_id();
			foreach ($data['choices'] as $i => $choice) {
				$this->db->insert($this->table, $data);			
			}
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
}