<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Folders_model extends MY_Model {
	public $table = 'file_folders';
	public function __construct(){
		parent::__construct();

		$this->table_key = 'folder_id';
	}
}

/* End of file Permissions_model.php */

/* Location: ./application/models/Permissions_model.php */