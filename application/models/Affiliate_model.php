<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliate_model extends MY_Model {

	public $table = 'affiliates';

	public function __construct()
	{
		parent::__construct();
	}

	public function add()
	{
		return $this->create([
			'title' => $message,
			'user' => ($user_id==0) ? logged('id') : $user_id,
			'ip_address' => !empty($ip_address) ? $ip_address : ip_address()
		]);
	}

}

/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */