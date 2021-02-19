<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracker extends MY_Controller {
	public function __construct(){
		parent::__construct();
		//$this->checkLogin(1);
	}

	public function imageTracker(){
		$this->load->model('CreditNote_model');
		$this->load->helper(array('hashids_helper'));
		$eid = $_GET['id'];
		$credit_note_id = hashids_decrypt($eid, '', 15);
		$creditNote     = $this->CreditNote_model->getById($credit_note_id);
		if( $creditNote->is_seen == 0 ){
			$this->CreditNote_model->update($creditNote->id, ['is_seen' => 1]);
		}		
		
		$image = base_url('/assets/img/tracking_pixel.png'); 
		ob_clean(); 
		header("content-type: image/png");
		echo file_get_contents($image);
		exit;
	}

	public function estimateImageTracker(){
		$this->load->model('Estimate_model');
		$this->load->helper(array('hashids_helper'));
		$eid = $_GET['id'];
		$estimate_id = hashids_decrypt($eid, '', 15);
		$estimate    = $this->Estimate_model->getEstimate($estimate_id);
		if( $estimate->is_mail_open == 0 ){
			$this->Estimate_model->update($estimate->id, ['is_mail_open' => 1, 'mail_open_date' => date("Y-m-d H:i:s")]);
		}		
		
		$image = base_url('/assets/img/tracking_pixel.png'); 
		ob_clean(); 
		header("content-type: image/png");
		echo file_get_contents($image);
		exit;
	}
}
