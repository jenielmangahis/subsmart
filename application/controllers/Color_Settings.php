<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color_Settings extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->checkLogin();

		$this->load->model('ColorSettings_model');
		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->page_data['page']->title = 'Color Settings ';
		$this->page_data['page']->menu = 'color_settings';		
	}


	public function index(){			
		$colorSettings = $this->ColorSettings_model->getAll();
		$this->page_data['colorSettings'] = $colorSettings;
		$this->load->view('color_settings/index', $this->page_data);
	}

	public function add_new_color() {

		$this->load->view('color_settings/add_new', $this->page_data);
	}	
}



/* End of file Color_Settings.php */

/* Location: ./application/controllers/Color_Settings.php */