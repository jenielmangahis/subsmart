<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout extends MY_Controller {

	public function top_nav()
	{
		$this->view('top_nav');
	}

	public function boxed()
	{
		$this->page_data['page']->body_classes = 'layout-boxed';
		$this->view('boxed');
	}

	public function fixed()
	{
		$this->page_data['page']->body_classes = 'fixed';
		$this->view('fixed');
	}

	public function collapsed_sidebar()
	{
		$this->page_data['page']->body_classes = 'sidebar-collapse';
		$this->view('collapsed_sidebar');
	}

	private function view($key)
	{
		$this->load->view('adminlte/layout/'.$key, $this->page_data);
	}

}

/* End of file Layout.php */
/* Location: ./application/controllers/adminlte/Layout.php */