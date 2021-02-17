<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracker extends MY_Controller {
	public function __construct(){
		parent::__construct();
		//$this->checkLogin(1);
	}

	public function imageTracker($eid){
		$this->load->helper(array('hashids_helper'));

		$credit_note_id = hashids_decrypt($eid, '', 15);
		
		$image = base_url('/assets/img/trackingpixel.png');  
		header("content-type: image/png");
		echo file_get_contents($image);
		exit;
	}
}
