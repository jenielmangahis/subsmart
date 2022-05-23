<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_participants_model extends MY_Model {
	public $table = 'tasks_participants';
	public function __construct(){
		parent::__construct();
	}
}