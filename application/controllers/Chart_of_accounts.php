<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts extends MY_Controller {
	
	public function add()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/chart_of_accounts/add', $this->page_data);
	}

	public function edit()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/chart_of_accounts/edit', $this->page_data);
	}

	public function fetch_acc_detail()
	{
		if($this->input->post('account_id'))
		{
			echo $this->accounts_has_account_details_model->fetch_acc_detail_id($this->input->post('account_id'));
		}
	}
}