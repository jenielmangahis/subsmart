<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormsBuilder_model extends MY_Model {
	private $forms_table = "fb_forms";
	private $elements_table = "fb_forms_elements";
	private $answers_table = "fb_forms_answers";
	private $choices_table = "fb_choices";
	private $images_table = "fb_forms_images";
	private $products_table = "fb_forms_products";

	public function __construct(){
		parent::__construct();
	}
	
	public function getForms($id = null){
		$this->db->select("*");

		if($id !== null){
			$this->db->where('forms_id', $id);
			$query =  $this->db->get($this->forms_table);
			return $query->row();
		}
		$query =  $this->db->get($this->forms_table);
		return $query->result();
	}

	public function addNewForm($data){
		$this->db->insert($this->forms_table, $data);
		return array(	
			"status" => 1,
			"id" => $this->db->insert_id()
		);
	}

	public function updateFormSettings($id, $data){
		$this->db->where('forms_id', $id);
		$query = $this->db->update('fb_forms', $data);
		return array(
			"status" => 1
		);
	}

	public function getFormElements($form_id = null, $element_id = null){
		$this->db->select("*");

		if($form_id !== null){
			if($element_id !== null){
				$this->db->where('fe_id', $element_id);
				$query =  $this->db->get($this->elements_table);
				return $query->row();
			}

			$this->db->where('fe_form_id', $form_id);
			$query =  $this->db->get($this->elements_table);
			return $query->result();
		}
		$query =  $this->db->get($this->elements_table);
		return $query->result();
	}

	public function addFormElement($data){
		$this->db->insert($this->elements_table, $data);
		return array(
			"status" => 1,
			"id" => $this->db->insert_id()
		);
	}

	public function updateFormElement($element_id, $data){
		$this->db->where('fe_id', $element_id);
		$query = $this->db->update($this->elements_table, $data);
		return array(
			"status" => 1
		);
	}

	public function deleteFormElement($element_id){
		$this->db->where('fe_id', $element_id);
		$query = $this->db->delete($this->elements_table);
		return array(
			"status" => 1
		);
	}
	
	public function getElementChoices($element_id){
		$this->db->select("*");
		$this->db->where("fc_element_id", $element_id);
		$query = $this->db->get($this->choices_table);
		return $query->result();
	}

	public function addElementChoices($data){
		$this->db->insert($this->choices_table, $data);
		return array(
			"status" => 1,
			"id" => $this->db->insert_id()
		);
	}
	
	public function updateElementChoices($element_id, $data){
		$this->db->where('fe_id', $element_id);
		$query = $this->db->delete($this->choices_table);
		$this->db->where('fc_id', $element_id);
		$query = $this->db->update($this->choices_table, $data);
		return array(
			"status" => 1
		);
	}

	public function deleteElementChoices($element_id){
		$this->db->where('fc_element_id', $element_id);
		$query = $this->db->delete($this->choices_table);
		return array(
			"status" => 1
		);
	}

	public function submitAnswers($data){
		$this->db->insert($this->answers_table, $data);
		return array(
			"status" => 1,
			"id" => $this->db->insert_id()
		);
	}

	public function getAnswers($form_id){
		$this->db->select('*');
		$this->db->where('fa_form_id', $form_id);
		$query = $this->db->get($this->answers_table);
		return $query->result();
	}

	public function deleteAnswers($column, $id){
		$this->db->where($column, $id);
		$query = $this->db->delete($this->answers_table);
		return array(
			"status" => 1
		);
	}

	public function getElementImages($element_id){
		$this->db->select("*");
		$this->db->where('element_id', $element_id);
		$query = $this->db->get($this->images_table);
		return $query->result();
	}

	public function addElementImages($data){
		$this->db->insert($this->images_table, $data);
		return array(
			"status" => 1,
			"id" => $this->db->insert_id()
		);
	}

	// foreign data

	public function addFormProducts($data){
		$this->db->insert($this->products_table, $data);
		return array(
			"status" => 1,
			"id" => $this->db->insert_id()
		);
	}

	public function getProductsList(){
		$this->db->select('*');
		$items = $this->db->get('items')->result_array();
		foreach ($items as $i => $item) {
			$this->db->where('item_id', $item['id']);
			$locations = $this->db->get('items_has_storage_loc')->result_array();
			$items[$i]['locations'] = $locations;
		}
		return $items;
	}




}

/* End of file Permissions_model.php */
/* Location: ./application/models/Permissions_model.php */