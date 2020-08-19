<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormsBuilder_model extends MY_Model {
	private $forms_table = "fb_forms";
	private $elements_table = "fb_forms_elements";
	private $answers_table = "fb_forms_answers";
	private $choices_table = "fb_forms_choices";

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

	public function getFormElements($form_id = null){
		$this->db->select("*");

		if($form_id !== null){
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

}

/* End of file Permissions_model.php */
/* Location: ./application/models/Permissions_model.php */