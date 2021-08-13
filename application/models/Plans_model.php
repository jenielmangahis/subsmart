<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans_model extends MY_Model {
	public $table = 'plan_type';
	public function __construct(){
		parent::__construct();
	}

	public function deletePlan($id){
        $this->db->delete($this->table, array('id' => $id));
    } 
}



/* End of file Permissions_model.php */

/* Location: ./application/models/Permissions_model.php */