<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Folders_permissions_model extends MY_Model {
	public $table = 'folders_permissions';
	public function __construct(){
		parent::__construct();
	}
}