<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_workspace_model extends MY_Model {

	public $table = 'wizard_workspace';

	public function getAllCompanies() {
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}


}
