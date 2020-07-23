<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_model extends MY_Model {

	public $table = 'wizard';

	public function getAllCompanies() {
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}


}
