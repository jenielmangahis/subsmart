<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FileFoldersCategories_model extends MY_Model {
	public $table = 'file_folders_categories';
	public function __construct(){
		parent::__construct();

		$this->table_key = 'category_id';
	}
}