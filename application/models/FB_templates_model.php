<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB_templates_model extends MY_Model {

	public $table = 'form_templates';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('FB_security_model', 'form_security');
		$this->load->model('FB_schedule_setting_model', 'form_schedule_setting');
		$this->load->model('FB_elements_model', 'form_elements');
		$this->load->model('FB_element_choices_model', 'form_element_choices');
		$this->load->model('FB_element_matrix_rows_model', 'form_element_matrix_rows');
		$this->load->model('FB_element_matrix_columns_model', 'form_element_matrix_columns');
		$this->load->model('FB_style_model', 'form_style');
		$this->load->model('Items_model', 'products');
    }
    
	function create($data){
		try {
			$this->db->insert($this->table, $data);
			$formID = $this->db->insert_id();

			$newData = [ 
				'form_id' => $formID
			];

			$this->generateQR($formID);

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

	public function getActiveCompanyDataByUserID($userID) {
		$profiledata = $this->business_model->getByWhere(array('id'=>$userID));	
		$res = ($profiledata) ? $profiledata[0] : '';
		return $res;
	}

	function getByUserID($userID, $data) {
		try {
			$folder_id = $data['folder'] ?: 0;
			$search_string = $data['search_string'];
			$this->db->select("*");
			if($folder_id != 2) {
				$this->db->where('folder_id <>', 2);
			}
			if($folder_id) {
				$this->db->where('folder_id', $folder_id);
			}
			if($search_string) {
				$this->db->like('name', $search_string);
			}
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
			$form = $this->db->get($this->table)->row();

			// $company = $this->getActiveCompanyDataByUserID($form->user_id);

			// $user = (object)$this->session->userdata('logged');		
			// $cid=logged('id');

			$products = $this->products->getByCompanyId(1);

			$this->db->select("*");
			$this->db->where('form_id', $id);
			$formStyle = $this->db->get($this->form_style->table);

			$this->db->select("*");
			$this->db->where('form_id', $id);
			$formStyle = $this->db->get($this->form_style->table);

			$this->db->select("*");
			$this->db->where('form_id', $id); 
			$this->db->order_by('element_order', 'ASC');
			$this->db->order_by('container_id', 'ASC');
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
				$this->db->select("*");
				$this->db->where(['element_id' => $element['id'], 'form_id' => $id]);
				$rules = $this->db->get($this->form_element_rules->table);
				$elementsArr[$i]['rules'] = $rules->result_array();				
				$elementsArr[$i]['items'] = $item->result_array();				
				$elementsArr[$i]['choices'] = $choice->result_array();				
				$elementsArr[$i]['matrix'] = $matrix;				
			}
			$data = [
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

	public function generateQR($form_id){
        $this->load->library('qrcode/ciqrcode');
        $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/assets/img/forms/qr/'.$form_id.'.png';

        $params['data'] = $_SERVER['DOCUMENT_ROOT'].'/fb/view/'.$form_id;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $SERVERFILEPATH;
        $this->ciqrcode->generate($params);
    }
}