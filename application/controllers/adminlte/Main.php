<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function widgets()
	{
		$this->view('widgets');
	}

	public function calendar()
	{
		$this->view('calendar');
	}

	public function chartjs()
	{
		$this->view('chartjs');
	}






	private function view($key)
	{
		$this->load->view('adminlte/'.$key, $this->page_data);
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/adminlte/Main.php */