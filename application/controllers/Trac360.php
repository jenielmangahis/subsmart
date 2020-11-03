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

                $config['zoom'] = 13;
                $config['apiKey'] = 'AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU';

                $this->googlemaps->initialize($config);

                $data = $this->googlemaps->create_map();

                $this->page_data['map'] = $data['html'];
                $this->page_data['map_js'] = $data['js'];

                $this->page_data['categories'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id));
                $this->page_data['users'] = $this->users_model->getByWhere(array('company_id' => $company_id));   

                $this->page_data['trac360_manager'] = $this->load->view('modals/trac360_manager', array(), true);

	        $this->load->view('trac360/main', $this->page_data);
	}

        public function getUserGeoPosition($uid){
                $company_id = logged('company_id');

                $return = $this->users_geographic_positions_model->getRowByWhere(array('user_id' => $uid,'company_id' => $company_id), 0, true);

                echo json_encode($return);
        }

        public function getNewGeoInfos(){
                $company_id = logged('company_id');

                $return = array(
                        'users' => array(),
                        'groups' => array(),
                        'users_count' => 0,
                        'groups_count' => 0
                        );

                if(isset($_POST['user_ids'])){
                        $ids = $_POST['user_ids'];

                        $sql = 'select '.

                                'a.user_id, '.
                                'a.latitude, '.
                                'a.longitude, '.
                                'a.category_id, '.
                                'b.img_type, '.
                                'b.FName, '.
                                'b.LName, '.
                                'c.category_name, '.
                                'c.category_desc, '.
                                'c.category_tag '.

                                'from users_geo_positions a '.

                                'left join users b on b.id = a.user_id '.
                                'left join users_geo_positions_categories c on c.id = a.category_id '.

                                'where a.company_id = ' . $company_id . ' ' .
                                  'and a.user_id not in('. $ids .') '.
                                  
                                'order by a.category_id';

                        $users = $this->db->query($sql);

                        $return['users_count'] = $users->num_rows();
                        $return['users'] = $users->result_array();        
                }

                if(isset($_POST['group_ids'])){
                    $ids = $_POST['group_ids'];

                    $sql = 'select * from users_geo_positions_categories where company_id = ' . $company_id . ' and id not in('. $ids .')';

                    $groups = $this->db->query($sql);

                    $return['groups_count'] = $groups->num_rows();
                    $return['groups'] = $groups->result_array();
                } 

                echo json_encode($return);
        }

        public function addNewPeople(){
            $return = array(
                'error' => ""
            );

            $exists = $this->db->query('select count(*) as `total` from users_geo_positions where user_id = ' . $_POST['user_id'])->row();
            if($exists->total > 0){
                $return['error'] = 'User already added to the tracking list';
            } else {
                $company_id = logged('company_id');

                $data = array(
                    'category_id' => $_POST['category_id'],
                    'user_id' => $_POST['user_id'],
                    'latitude' => $_POST['latitude'],
                    'longitude' => $_POST['longitude'],
                    'company_id' => $company_id,
                    'date_added' => date('Y-m-d h:i:s')
                );

                if(!$this->users_geographic_positions_model->trans_create($data)){
                    $return['error'] = 'Error in adding person';
                }
            }

            echo json_encode($return);
        }

        public function deletePeople(){
            $return = array(
                'error' => ""
            );
            
            $exists = $this->db->query('select count(*) as `total` from users_geo_positions where user_id = ' . $_POST['user_id'])->row();
            if($exists->total > 0){
                if(!$this->users_geographic_positions_model->trans_delete(array(),array('user_id' => $_POST['user_id']))){
                    $return['error'] = 'Error in deleting person';
                }
            }

            echo json_encode($return);    
        }
}