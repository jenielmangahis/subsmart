<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_updates_model extends MY_Model {
	public $table = 'tasks_updates';
	public function __construct(){
		parent::__construct();

		$this->table_key = 'update_id';
	}
}