<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile extends MY_Controller {
	
	public function add()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/reconcile/add', $this->page_data);
	}
}