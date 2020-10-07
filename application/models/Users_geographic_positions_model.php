<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_geographic_positions_model extends MY_Model {
	public $table = 'users_geo_positions';
	public function __construct(){
		parent::__construct();
	}
}