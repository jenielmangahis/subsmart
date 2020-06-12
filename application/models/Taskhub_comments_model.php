<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskhub_comments_model extends MY_Model {
	public $table = 'tasks_comments';
	public function __construct(){
		parent::__construct();
	}
}