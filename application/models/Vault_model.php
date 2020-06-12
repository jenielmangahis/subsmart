<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vault_model extends MY_Model {
	public $table = 'filevault';
	public function __construct(){
		parent::__construct();

		$this->table_key = 'file_id';
	}
}

/* End of file Permissions_model.php */
/* Location: ./application/models/Permissions_model.php */