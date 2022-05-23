<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_model extends MY_Model {
	public $table = 'tasks';
	public function __construct(){
		parent::__construct();

		$this->table_key = 'task_id';
	}
}