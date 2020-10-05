<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trac360 extends MY_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->checkLogin();
		$this->page_data['page']->title = 'Trac360';
	}

	public function index(){
		$config['center'] = '0' . ', ' . '0';
        $config['zoom'] = 15;
        $config['apiKey'] = 'AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU';

        $this->googlemaps->initialize($config);
        $data = $this->googlemaps->create_map();

        $this->page_data['map'] = $data['html'];
        $this->page_data['map_js'] = $data['js'];
		$this->load->view('trac360/main', $this->page_data);
	}
}