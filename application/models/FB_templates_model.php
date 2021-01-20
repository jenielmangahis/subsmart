<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_templates_model extends MY_Model {

	public $table = 'form_templates';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('FB_security_model', 'form_security');
		$this->load->model('FB_schedule_setting_model', 'form_schedule_setting');
		$this->load->model('FB_template_elements_model', 'form_template_elements');
		$this->load->model('FB_template_element_choices_model', 'form_template_element_choices');
		$this->load->model('FB_template_element_matrix_rows_model', 'form_template_element_matrix_rows');
		$this->load->model('FB_template_element_matrix_columns_model', 'form_template_element_matrix_columns');
		$this->load->model('FB_template_style_model', 'form_template_style');
		$this->load->model('FB_template_element_items_model', 'form_template_element_items');
		$this->load->model('Items_model', 'products');
    }
    
	function create($data){
		try {
			$data->id = null;
			$this->db->insert($this->table, $data);
			$formID = $this->db->insert_id();

			$newData = [ 
				'form_id' => $formID
			];

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

	public function getActiveCompanyDataByUserID($userID) {
		$profiledata = $this->business_model->getByWhere(array('id'=>$userID));	
		$res = ($profiledata) ? $profiledata[0] : '';
		return $res;
	}

	function getAll() {
		try {
			$this->db->select("*");
			$q = $this->db->get($this->table);
			$res = [
				'data' 	=> $q->result(),
				'code'	=> 200,
				'message'	=> 'Form templates fetched successfuly.'
			];
		}catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error fetching forms templates. please try again later or contact customer support.'
			];
		}
		return $res;
	}

	function getByFormTemplateID($id) {
		try {
			$this->db->select("*");
			$this->db->where('id', $id);
			$form = $this->db->get($this->table)->row();

			// $company = $this->getActiveCompanyDataByUserID($form->user_id);

			// $user = (object)$this->session->userdata('logged');		
			// $cid=logged('id');

			$products = $this->products->getByCompanyId(1);

			$this->db->select("*");
			$this->db->where('form_id', $id);
			$formStyle = $this->db->get($this->form_template_style->table);

			$this->db->select("*");
			$this->db->where('form_id', $id); 
			$this->db->order_by('element_order', 'ASC');
			$this->db->order_by('container_id', 'ASC');
			$elements = $this->db->get($this->form_template_elements->table);
			$elementsArr = $elements->result_array();
			foreach ($elementsArr as $i => $element) {
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$choice = $this->db->get($this->form_template_element_choices->table);
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$matrix['rows'] = $this->db->get($this->form_template_element_matrix_rows->table)->result_array();
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$matrix['columns'] = $this->db->get($this->form_template_element_matrix_columns->table)->result_array();
				$this->db->select("*");
				$this->db->where('element_id', $element['id']);
				$item = $this->db->get($this->form_template_element_items->table);
				$elementsArr[$i]['items'] = $item->result_array();				
				$elementsArr[$i]['choices'] = $choice->result_array();				
				$elementsArr[$i]['matrix'] = $matrix;				
			}
			$data = [
				// 'id'			=> $id,
				'form'			=> $form,
				'form_style'	=> $formStyle->row(),
				'elements'		=> $elementsArr,
				'products'		=> $products,
				// 'company'		=> $company,
				// 'cid'			=> $cid,
			];	

			$res = [
				'data' 	=> $data,
				'code'	=> 200,
				'message'	=> 'Templates fetched successfuly'
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
		$customStyle = $data['customize_items'];
		$customStyle['form_id'] = $id;
		unset($data['customize_items']);
		try {
			$this->db->set($data);
			$this->db->where('id', $id);
			$this->db->update($this->table);	

			$this->db->select("form_id");
			$this->db->where('form_id', $id);
			$rows = $this->db->get($this->form_style->table);
			if($rows->num_rows()) {
				$this->db->set($customStyle);
				$this->db->where('form_id', $id);
				$this->db->update($this->form_style->table);	
			} else {
				$this->db->insert($this->form_style->table, $customStyle);
			}

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
		// return $res = [
	 	// 	'data' 	=> ['data' => $data, 'custom_style' => $customStyle],
	 	// 	'code'	=> 500,
	 	// 	'message'	=> 'Error updating form styles. please try again later or contact customer support.'
	 	// ];
	}

}