<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FormsBuilder_model extends MY_Model {
	public $table = 'formbuilder_default_forms';
	public $table_custom = 'formbuilder_forms';
	public function __construct(){
		parent::__construct();
	}

	public function getAllForms() {

		$comp_id = logged('comp_id');
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('company_id', $comp_id);

		$query = $this->db->get();
		return $query->result();
	}

	public function getById($id) {

		$comp_id = logged('comp_id');
		$this->db->select('*');
		$this->db->from($this->table_custom);
		$this->db->where('company_id', $comp_id);
		$this->db->where('id', $id);

		$query = $this->db->get();

		if(count($query->result()) > 0)
		{	
			return $query->result();
		} else {
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

	}
}

/* End of file Permissions_model.php */
/* Location: ./application/models/Permissions_model.php */