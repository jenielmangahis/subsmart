<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trac360 extends MY_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->checkLogin();
		$this->page_data['page']->title = 'Trac360';
	}

        public function getUsersCategories(){
                $company_id = logged('company_id');

                $return = array(
                        'categories' => $this->db->query('select * from users_geo_positions_categories where company_id = ' . $company_id . ' order by id')->result_array(),
                        'users' => $this->db->query(
                                        'select '.

                                        'a.user_id, '.
                                        'a.latitude, '.
                                        'a.longitude, '.
                                        'a.category_id, '.
                                        'b.img_type, '.
                                        'b.FName, '.
                                        'b.LName, '.
                                        'c.category_tag '.

                                        'from users_geo_positions a '.

                                        'left join users b on b.id = a.user_id '.
                                        'left join users_geo_positions_categories c on c.id = a.category_id '.

                                        'where a.company_id = ' . $company_id . ' ' .

                                        'order by a.category_id'
                        )->result_array()
                );

                echo json_encode($return);
        }

	public function index(){
		$company_id = logged('company_id');

                if(false){
                        $marker = array();
                        $marker['title'] = 'Test Marker';
                        $marker['position'] = '49.164911,-123.17792';
                        $marker['icon'] = base_url() . "uploads/users/default.png";
                        $marker['icon_scaledSize'] = '30,30';

                        $this->googlemaps->add_marker($marker);
                }

                $config['center'] = '49.164911,-123.17792';
                $config['zoom'] = 13;
                $config['apiKey'] = 'AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU';

                $this->googlemaps->initialize($config);

                $data = $this->googlemaps->create_map();

                $this->page_data['map'] = $data['html'];
                $this->page_data['map_js'] = $data['js'];
                $this->page_data['trac360_manager'] = $this->load->view('modals/trac360_manager', array(), true);

	        $this->load->view('trac360/main', $this->page_data);
	}

        public function getUserGeoPosition($uid){
                $company_id = logged('company_id');

                $return = $this->users_geographic_positions_model->getRowByWhere(array('user_id' => $uid,'company_id' => $company_id), 0, true);

                echo json_encode($return);
        }
}