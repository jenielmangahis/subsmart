<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

	// public function __construct()
 //    {
 //        parent::__construct();
 //        $this->checkLogin();
 //    }

	/*public function index()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/business_tools', $this->page_data);
	}*/

	public function banking()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/banking', $this->page_data);
	}

	public function expenses()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/expenses', $this->page_data);
	}

	public function receivables()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/receivables', $this->page_data);
	}

	public function workers()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/workers', $this->page_data);
	}

	public function taxes()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/taxes', $this->page_data);
	}

	public function chart_of_accounts()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/chart_of_accounts', $this->page_data);
	}

	public function my_accountant()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/my_accountant', $this->page_data);
	}
}