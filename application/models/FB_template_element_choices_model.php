<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_template_element_choices_model extends MY_Model {

	public $table = 'form_template_element_choices';
	
	public function __construct()
	{
		parent::__construct();
    }
    
	function create($data)
	{
		try {
			$data->id = null;
			$this->db->insert($this->table, $data['form_element']);
			$newID = $this->db->insert_id();
			foreach ($data['choices'] as $i => $choice) {
				$this->db->insert($this->table, $data['form_element']);			
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