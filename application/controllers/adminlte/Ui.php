<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ui extends MY_Controller {

	public function general()
	{
		$this->view('general');
	}

	public function icons()
	{
		$this->view('icons');
	}

	public function buttons()
	{
		$this->view('buttons');
	}

	public function sliders()
	{
		$this->view('sliders');
	}

	public function timeline()
	{
		$this->view('timeline');
	}

	public function modals()
	{
		$this->view('modals');
	}






	private function view($key)
	{
		$this->load->view('adminlte/ui/'.$key, $this->page_data);
	}
}

/* End of file Ui.php */
/* Location: ./application/controllers/adminlte/Ui.php */