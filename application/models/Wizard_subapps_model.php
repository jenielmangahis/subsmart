<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_subapps_model extends MY_Model {

	public $table = 'wizard_subapps';

	public function getApps() {
		$this->db->where('show_app','1');
	 	$query = $this->db->get('wizard_subapps');  
        return $query->result();
	}


}
