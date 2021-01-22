<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_style_model extends MY_Model {

	public $table = 'form_style';
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
		try {
			$this->db->insert($this->table, $data);
			$newID = $this->db->insert_id();

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