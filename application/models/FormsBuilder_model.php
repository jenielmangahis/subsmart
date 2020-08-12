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
		}

		return $this->db->get($this->forms_table);		
	}

	public function addNewForm($data){
		$this->db->insert($this->forms_table, $data);
		return array(	
			"status" => 1,
			"id" => $this->db->insert_id()
		);
	}

	public function updateFormSettings($id, $data){
		return;
	}
}

/* End of file Permissions_model.php */
/* Location: ./application/models/Permissions_model.php */