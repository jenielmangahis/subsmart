<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_elements_model extends MY_Model {

	public $table = 'form_elements';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('FB_element_choices_model', 'form_element_choices');
		$this->load->model('FB_element_matrix_rows_model', 'form_element_matrix_rows');
		$this->load->model('FB_element_matrix_columns_model', 'form_element_matrix_columns');
		$this->load->model('FB_element_items_model', 'form_element_items');
		$this->load->model('FB_element_rules_model', 'form_element_rules');
	}
	
	function getFormElements($id) {
		try {
			$this->db->select('*');
			$this->db->where('form_id', $id);
			$elements = $this->db->get($this->table);

			$res = [
				'data' 	=> $elements->result(),
				'code'	=> 200,
				'message'	=> 'Here are your form elements, master'
			];
		} catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error fetching form elements. please try again later or contact customer support.'
			];
		}

		return $res;
	}
    
	function create($data){
		try {
			$this->db->insert($this->table, $data['form_element']);
			$newID = $this->db->insert_id();
			if($data['choices']) {
				foreach ($data['choices'] as $i => $choice) {
					$choiceData = [
						'id'			=> null,
						'element_id' 	=> $newID,
						'choice_text'	=> ( gettype($choice) === 'array' ? $choice['choice_text'] : $choice )
					];
					$this->db->insert($this->form_element_choices->table, $choiceData);			
				}
			}
			
			if(isset($data['choices_and_prices'])) {
				foreach ($data['choices_and_prices'] as $i => $row) {
					$items_data = $row;
					$items_data['id'] = null;
					$items_data['element_id'] = $newID;
					$this->db->insert($this->form_element_items->table, $items_data);			
				}
			}

			if(isset($data['matrix_rows'])) {
				foreach ($data['matrix_rows'] as $i => $matrixRow) {
					$matrixRowData = [
						'id' 	=> null,
						'element_id' 	=> $newID,
						'text'	=> ( gettype($matrixRow) === 'array' ? $matrixRow['text'] : $matrixRow )
					];
					$this->db->insert($this->form_element_matrix_rows->table, $matrixRowData);			
				}
				foreach ($data['matrix_columns'] as $i => $matrixColumn) {
					$matrixColumnData = [
						'id' 	=> null,
						'element_id' 	=> $newID,
						'text'	=> ( gettype($matrixColumn) === 'array' ? $matrixColumn['text'] : $matrixColumn )
					];
					$this->db->insert($this->form_element_matrix_columns->table, $matrixColumnData);			
				}	
			}		

			if(isset($data['element_rules'])) {
				$elementRules = json_decode($data['element_rules']);
	
				foreach($elementRules as $elementRule) {
					$elementRule->element_id = $newID;
					$elementRule->form_id = $data['form_element']['form_id'];
					$elementRule->status = 1;
					if($elementRule->rule_item = "null") {
						unset($elementRule->rule_item);
					}
					$this->db->insert($this->form_element_rules->table, $elementRule);
				}
			}

			$response = [
				'code' 		=> 200,
				'message' 	=> 'created',
				'data'		=> ['new_id' => $newID]
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


			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_items->table);
			
			foreach ($data['choices_and_prices'] as $i => $row) {
				$items_data = $row;
				$items_data['element_id'] = $id;
				$this->db->insert($this->form_element_items->table, $items_data);			
			}


			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_matrix_rows->table);
			
			foreach ($data['matrix_rows'] as $i => $row) {
				$matrixRowData = [
					'element_id' => $id,
					'text'	=> $row
				];
				$this->db->insert($this->form_element_matrix_rows->table, $matrixRowData);			
			}


			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_matrix_columns->table);
			
			foreach ($data['matrix_columns'] as $i => $column) {
				$matrixColumnData = [
					'element_id' => $id,
					'text'	=> $column
				];
				$this->db->insert($this->form_element_matrix_columns->table, $matrixColumnData);			
			}
			
			$elementRules = json_decode($data['element_rules']);

			$this->db->where(['element_id' => $id, 'form_id' => $data['form_element']['form_id']]);
			$this->db->delete($this->form_element_rules->table);
			
			foreach($elementRules as $elementRule) {
				$elementRule->status = 1;
				$elementRule->element_id = $id;
				$elementRule->form_id = $data['form_element']['form_id'];
				if($elementRule->rule_item == "null") {
					unset($elementRule->rule_item);
				}
				$this->db->insert($this->form_element_rules->table, $elementRule);
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
		for($i = 0; $i < count($data); $i++) {
			unset($data[$i]['rules']);
		}
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
			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_matrix_columns->table);
			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_choices->table);
			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_items->table);
			$this->db->where('element_id', $id);
			$this->db->delete($this->form_element_rules->table);
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