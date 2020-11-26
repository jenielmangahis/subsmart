<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_elements_model extends MY_Model {

	public $table = 'form_elements';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('FB_element_choices_model', 'form_element_choices');
    }
    
	function create($data)
	{
		// $choiceData = [
		// 	'element_id' 	=> $newID,
		// 	'choice_text'	=> (gettype($data['choices'][1]) === 'array' ? $choice : $choice['choice_text'] )
		// ];
		// $response = [
		// 	'code' 		=> 200,
		// 	'message' 	=> 'created',
		// 	'data'		=> $choiceData
		// ];
		// return $response;
		try {
			$this->db->insert($this->table, $data['form_element']);
			$newID = $this->db->insert_id();
			foreach ($data['choices'] as $i => $choice) {
				$choiceData = [
					'element_id' 	=> $newID,
					'choice_text'	=> ( gettype($choice) === 'array' ? $choice['choice_text'] : $choice )
				];
				$this->db->insert($this->form_element_choices->table, $choiceData);			
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

	function update($data, $id)
	{
		try {
			$this->db->where('id', $id);
			$this->db->update($this->table, $data['form_element']);

			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_choices->table);
			
			foreach ($data['choices'] as $i => $choice) {
				$choiceData = [
					'element_id' 	=> $id,
					'choice_text'	=> $choice
				];
				$this->db->insert($this->form_element_choices->table, $choiceData);			
			}
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

	function updateOrder($data) {
		try {
			$this->db->update_batch($this->table, $data, 'id');
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

	function destroyElement($id) {
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