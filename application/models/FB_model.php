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
		$this->load->model('FB_style_model', 'form_style');
		$this->load->model('Items_model', 'products');
		$this->load->model('FB_templates_model', 'form_templates');
		$this->load->model('FB_template_elements_model', 'form_template_elements');
		$this->load->model('FB_template_element_choices_model', 'form_template_element_choices');
		$this->load->model('FB_template_element_matrix_rows_model', 'form_template_element_matrix_rows');
		$this->load->model('FB_template_element_matrix_columns_model', 'form_template_element_matrix_columns');
		$this->load->model('FB_template_style_model', 'form_template_style');
		$this->load->model('FB_template_element_items_model', 'form_template_element_items');
    }
    
	function create($data, $from_template = false){
		try {
			if($from_template) {
				$data->id = null;
			} else {
				$data['id'] = null;
			}
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

	public function getActiveCompanyDataByUserID($userID) {
		$profiledata = $this->business_model->getByWhere(array('id'=>$userID));	
		$res = ($profiledata) ? $profiledata[0] : '';
		return $res;
	}

	function getByUserID($userID, $data) {
		try {
			$folder_id = isset($data['folder']) ? $data['folder'] : 0;
			$search_string = isset($data['search_string']) ? $data['search_string']: 0;
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
				'message'	=> 'Forms fetched successfuly'
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
	
	public function generateFormFromTemplate($form_id, $name) {
		try {
			$fullTemplate = $this->form_templates->getByFormTemplateID($form_id)['data'];
			$templateForm = $fullTemplate['form'];
			$templateElements = $fullTemplate['elements'];
			$templateFormStyle = $fullTemplate['form_style'];
			$templateForm->name = $name;

			$formCreate = $this->create($templateForm, true);

			if($formCreate['code'] == 200) {
				$containerIDs = [];
				$waitList = [];
				$formID = $formCreate['data']['form_id'];
				
				$templateFormStyle->id = null;
				$templateFormStyle->form_id = $formID;
				$this->form_style->create($templateFormStyle);

				foreach ($templateElements as $i => $element) {
					if($element['element_type'] == 'ContainerBlock') {
						$oldContainerID = $element['id'];
					}

					$element['id'] = null;
					$element['form_id'] = $formID;
					$newElementData['choices_and_prices'] = $element['items'];
					$newElementData['matrix_row'] = $element['matrix']['rows'];
					$newElementData['matrix_column'] = $element['matrix']['columns'];
					$newElementData['choices'] = $element['choices'];
					
					unset($element['items']);
					unset($element['matrix']);
					unset($element['choices']);

					$newElementData['form_element'] = $element;

					if($newElementData['form_element']['container_id'] != 0 && $newElementData['form_element']['container_id'] != null) {
						if(array_key_exists($newElementData['form_element']['container_id'], $containerIDs)){
							$newElementData['form_element']['container_id'] = $containerIDs[$newElementData['form_element']['container_id']];
						} else {
							$waitList = $newElementData;
							continue;
						}
					}
					
					$newelement = $this->form_elements->create($newElementData);
					if($element['element_type'] == 'ContainerBlock') {
						$containerIDs[$oldContainerID] = $newelement['data']['new_id'];
					}
				}

				if($waitList) {

					foreach ($waitList as $i => $waitListItem) {
						$waitListItemContainerID = $waitListItem['form_element']['container_id'];
						$waitListItem['form_element']['container_id'] = $containerIDs[$waitListItemContainerID];
					}

					$newelement = $this->form_elements->create($waitListItem);
				}
			}
			$res = [
				'data' 	=> [
					'form_id' => $formCreate['data']['form_id'],
					'container_ids' => $containerIDs,
					'new_element' => $newelement,
					'wait_list'	=> $waitList,
					'template'	=> $fullTemplate
				],
				// 'data'	=> $fullTemplate,
				'code'	=> 200,
				'message'	=> 'Created'
			];
		}catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error creating form from template. please try again later or contact customer support.'
			];
		}
		return $res;
	}

	public function generateTemplateFromForm($form_id) {
		try {
			$fullForm = $this->getByFormID($form_id)['data'];
			$form = $fullForm['form'];
			$formElements = $fullForm['elements'];
			$formStyle = $fullForm['form_style'];

			unset($form->status);
			unset($form->daily_summary_email);
			unset($form->private_notes);
			unset($form->social_description);
			unset($form->social_image);
			unset($form->favorite);

			$formCreate = $this->form_templates->create($form, true);


			// return $res = [
			// 	'data' 	=> [
			// 		'full_template' => $fullForm,
			// 		'template_form'	=> $templateForm,
			// 		'template_elements'	=> $formElements,
			// 		'template_form_style'	=> $formStyle,
			// 		// 'form_create'	=> $formCreate,
			// 	],
			// 	// 'data'	=> $fullForm,
			// 	'code'	=> 200,
			// 	'message'	=> 'Created'
			// ];

			if($formCreate['code'] == 200) {
				$containerIDs = [];
				$waitList = [];
				$formID = $formCreate['data']['form_id'];
				
				$formStyle->id = null;
				$formStyle->form_id = $formID;
				$this->form_template_style->create($formStyle);

				foreach ($formElements as $i => $element) {
					if($element['element_type'] == 'ContainerBlock') {
						$oldContainerID = $element['id'];
					}

					$element['id'] = null;
					$element['form_id'] = $formID;
					$newElementData['choices_and_prices'] = $element['items'];
					$newElementData['matrix_row'] = $element['matrix']['rows'];
					$newElementData['matrix_column'] = $element['matrix']['columns'];
					$newElementData['choices'] = $element['choices'];
					
					unset($element['items']);
					unset($element['matrix']);
					unset($element['choices']);
					unset($element['rules']);

					$newElementData['form_element'] = $element;

					if($newElementData['form_element']['container_id'] != 0 && $newElementData['form_element']['container_id'] != null) {
						if(array_key_exists($newElementData['form_element']['container_id'], $containerIDs)){
							$newElementData['form_element']['container_id'] = $containerIDs[$newElementData['form_element']['container_id']];
						} else {
							$waitList = $newElementData;
							continue;
						}
					}
					
					$newelement = $this->form_template_elements->create($newElementData);
					if($element['element_type'] == 'ContainerBlock') {
						$containerIDs[$oldContainerID] = $newelement['data']['new_id'];
					}
				}

				if($waitList) {

					foreach ($waitList as $i => $waitListItem) {
						$waitListItemContainerID = $waitListItem['form_element']['container_id'];
						$waitListItem['form_element']['container_id'] = $containerIDs[$waitListItemContainerID];
					}

					$newelement = $this->form_template_elements->create($waitListItem);
				}
			}
			$res = [
				'data' 	=> [
					'form_id' => $formCreate['data']['form_id'],
					'container_ids' => $containerIDs,
					'new_element' => $newelement,
					'wait_list'	=> $waitList,
					'template'	=> $fullTemplate
				],
				// 'data'	=> $fullTemplate,
				'code'	=> 200,
				'message'	=> 'Created'
			];
		}catch(\Exception $e) {
			$res = [
				'data' 	=> [],
				'code'	=> 500,
				'message'	=> 'Error creating form from template. please try again later or contact customer support.'
			];
		}
		return $res;
	}
}