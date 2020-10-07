<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trac360 extends MY_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->checkLogin();
		$this->page_data['page']->title = 'Trac360';
	}

	public function index(){
		$company_id = logged('company_id');

        $users_geo = $this->db->query(
			'select '.

			'a.user_id, '.
			'a.latitude, '.
			'a.longitude, '.
			'b.FName, '.
			'b.LName '.

			'from users_geo_positions a '.

			'left join users b on b.id = a.user_id '.

			'where a.company_id = ' . $company_id . ''
        )->result();

        $first = true;

        $c_latitude = 0;
        $c_longitude = 0;

        foreach ($users_geo as $user_geo) {
        	if($first){
        		$c_latitude = $user_geo->latitude;
        		$c_longitude = $user_geo->longitude;

        		$first = !$first;
        	}

        	$marker = array();
        	$marker['id'] = $user_geo->user_id;
        	$marker['title'] = $user_geo->FName . ' ' . $user_geo->LName;
        	$marker['position'] = $user_geo->latitude . ',' . $user_geo->longitude;

        	$this->googlemaps->add_marker($marker);
        }

        $config['center'] = $c_latitude . ', ' . $c_longitude;
        $config['zoom'] = 13;
        $config['apiKey'] = 'AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU';

        $this->googlemaps->initialize($config);

        $data = $this->googlemaps->create_map();

        $this->page_data['map'] = $data['html'];
        $this->page_data['map_js'] = $data['js'];
  
        $this->page_data['users_geo'] = $users_geo;
		$this->load->view('trac360/main', $this->page_data);
	}
}