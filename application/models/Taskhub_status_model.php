<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_status_model extends MY_Model {
	public $table = 'tasks_status';
	public function __construct(){
		parent::__construct();
	}
}