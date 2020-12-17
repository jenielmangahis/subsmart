<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_model extends MY_Model {

	public $table = 'forms';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('FB_security_model', 'form_security');
		$this->load->model('FB_schedule_setting_model', 'form_schedule_setting');
		$this->load->model('FB_elements_model', 'form_elements');
		$this->load->model('FB_element_choices_model', 'form_element_choices');
		$this->load->model('FB_element_matrix_rows_model', 'form_element_matrix_rows');
		$this->load->model('FB_element_matrix_columns_model', 'form_element_matrix_columns');
		$this->load->model('FB_element_items_model', 'form_element_items');
    }
    
	function create($data){
		try {
			$this->db->insert($this->table, $data);
			$formID = $this->db->insert_id();

			$newData = [ 
				'form_id' => $formID
			];

			$this->form_security->create($newData);
			$this->form_schedule_setting->create($newData);

			$response = [
				'code' 		=> 200,
				'message' 	=> 'created',
				'data'		=> $newData
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

	function getAllByUserID($userID) {
		try {
			$this->db->select("*");
			$this->db->where('user_id', $userID);
			$q = $this->db->get($this->table);
			$res = [
				'data' 	=> $q->result(),
				'code'	=> 200,
				'message'	=> 'Here are your forms, master'
			];
		}catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error fetching forms. please try again later or contact customer support.'
			];
		}
		return $res;
	}

	function getByFormID($id) {
		try {
			$this->db->select("*");
			$this->db->where('id', $id);
			$form = $this->db->get($this->table);


			$this->db->select("*");
			$this->db->where('form_id', $id); 
			$this->db->order_by('element_order', 'ASC');
			$elements = $this->db->get($this->form_elements->table);
			$elementsArr = $elements->result_array();
			foreach ($elementsArr as $i => $element) {
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$choice = $this->db->get($this->form_element_choices->table);
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$matrix['rows'] = $this->db->get($this->form_element_matrix_rows->table)->result_array();
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$matrix['columns'] = $this->db->get($this->form_element_matrix_columns->table)->result_array();
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$item = $this->db->get($this->form_element_items->table);
				$elementsArr[$i]['items'] = $item->result_array();				
				$elementsArr[$i]['choices'] = $choice->result_array();				
				$elementsArr[$i]['matrix'] = $matrix;				
			}
			$data = [
				'form'		=> $form->row(),
				'elements'	=> $elementsArr
			];	

			$res = [
				'data' 	=> $data,
				'code'	=> 200,
				'message'	=> 'Here are your forms, master'
			];
		}catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error fetching forms. please try again later or contact customer support.'
			];
		}
		return $res;
	}

	function update($data, $id) {
		try {
			$this->db->set($data);
			$this->db->where('id', $id);
			$this->db->update($this->table);	

			$res = [
				'data' 	=> [],
				'code'	=> 200,
				'message'	=> 'Updated'
			];
		}catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error updating form styles. please try again later or contact customer support.'
			];
		}
		return $res;
	}
}