<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examples extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page_data['assets']	= $this->page_data['url']->assets;
	}

	public function error404()
	{
		$this->view('404');
	}

	public function error500()
	{
		$this->view('500');
	}

	public function blank()
	{
		$this->view('blank');
	}

	public function profile()
	{
		$this->view('profile');
	}

	public function invoice()
	{
		$this->view('invoice');
	}

	public function invoice_print()
	{
		$this->view('invoice_print');
	}

	public function lockscreen()
	{
		$this->view('lockscreen');
	}

	public function login()
	{
		$this->view('login');
	}

	public function pace()
	{
		$this->view('pace');
	}

	public function register()
	{
		$this->view('register');
	}







	private function view($key)
	{
		$this->load->view('adminlte/examples/'.$key, $this->page_data);
	}

}

/* End of file Examples.php */
/* Location: ./application/controllers/adminlte/Examples.php */