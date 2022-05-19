<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trac360 extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
        $this->page_data['page']->title = 'Trac360';
        $this->load->model('trac360_model');
    }

    public function getUsersCategories()
    {
        $company_id = logged('company_id');

        $return = array(
            'categories' => $this->db->query('select * from users_geo_positions_categories where company_id = ' . $company_id . ' order by id')->result_array(),
            'users' => $this->db->query(
                'select ' .

                    'a.user_id, ' .
                    'a.latitude, ' .
                    'a.longitude, ' .
                    'a.category_id, ' .
                    'b.img_type, ' .
                    'b.FName, ' .
                    'b.LName, ' .
                    'c.category_tag ' .

                    'from users_geo_positions a ' .

                    'left join users b on b.id = a.user_id ' .
                    'left join users_geo_positions_categories c on c.id = a.category_id ' .

                    'where a.company_id = ' . $company_id . ' ' .

                    'order by a.category_id'
            )->result_array()
        );

        echo json_encode($return);
    }

    public function getUsersGroups()
    {
        $company_id = logged('company_id');

        $return = array(
            'groups' => $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true),
            'users' => $this->users_model->getByWhere(array('company_id' => $company_id), [], true)
        );

        echo json_encode($return);
    }

    public function index()
    {
        add_css(array(
            "assets/css/trac360/people.css"
        ));
        add_footer_js(array(
            "assets/js/trac360/people.js"

        ));
        $company_id = logged('company_id');
        $user_id = logged('id');

        $user_locations = $this->trac360_model->get_current_user_location($company_id);


        $this->page_data['user_locations'] = $user_locations;
        $this->page_data['company_id'] = $company_id;
        $this->page_data['user_id'] = $user_id;
        $this->load->view('trac360/people', $this->page_data);
        // var_dump($data);
    }
    public function tester()
    {
        $pizza  = "8.045953500047293,123.51302520681782";
        $pieces = explode(",", $pizza);
        echo "lat:" . $pieces[0]; // piece1
        echo "lng:" . $pieces[1]; // piece2
    }

    public function getUserGeoPosition($uid)
    {
        $company_id = logged('company_id');

        $return = $this->users_geographic_positions_model->getRowByWhere(array('user_id' => $uid, 'company_id' => $company_id), 0, true);

        echo json_encode($return);
    }

    public function getNewGeoInfos()
    {
        $company_id = logged('company_id');

        $return = array(
            'users' => array(),
            'groups' => array(),
            'users_count' => 0,
            'groups_count' => 0
        );

        if (isset($_POST['user_ids'])) {
            $ids = $_POST['user_ids'];
            if (!empty($ids)) {
                $ids = 'and a.user_id not in(' . $ids . ') ';
            }

            $sql = 'select ' .

                'a.user_id, ' .
                'a.latitude, ' .
                'a.longitude, ' .
                'a.category_id, ' .
                'b.img_type, ' .
                'b.FName, ' .
                'b.LName, ' .
                'c.category_name, ' .
                'c.category_desc, ' .
                'c.category_tag ' .

                'from users_geo_positions a ' .

                'left join users b on b.id = a.user_id ' .
                'left join users_geo_positions_categories c on c.id = a.category_id ' .

                'where a.company_id = ' . $company_id . ' ' . $ids .

                'order by a.category_id';

            $users = $this->db->query($sql);

            $return['users_count'] = $users->num_rows();
            $return['users'] = $users->result_array();
        }

        if (isset($_POST['group_ids'])) {
            $ids = $_POST['group_ids'];
            if (!empty($ids)) {
                $ids = ' and id not in(' . $ids . ')';
            }

            $sql = 'select * from users_geo_positions_categories where company_id = ' . $company_id . $ids;

            $groups = $this->db->query($sql);

            $return['groups_count'] = $groups->num_rows();
            $return['groups'] = $groups->result_array();
        }

        echo json_encode($return);
    }

    public function addNewPeople()
    {
        $return = array(
            'error' => ""
        );

        $exists = $this->db->query(
            'select count(*) as `total`, a.category_id, concat(c.FName," ",c.LName) as `user_name`, b.category_name ' .
                'from users_geo_positions a ' .
                'left join users_geo_positions_categories b on b.id = a.category_id ' .
                'left join users c on c.id = a.user_id ' .
                'where user_id = ' . $_POST['user_id']
        )->row();

        if ($exists->total > 0) {
            $return['error'] = 'User <strong>' . $exists->user_name . '</strong> already added to the tracking list group <strong>' . $exists->category_name . '</strong>';
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

            if (!$this->users_geographic_positions_model->trans_create($data)) {
                $return['error'] = 'Error in adding person';
            }
        }

        echo json_encode($return);
    }

    public function deletePeople()
    {
        $return = array(
            'error' => ""
        );

        $exists = $this->db->query('select count(*) as `total` from users_geo_positions where user_id = ' . $_POST['user_id'])->row();
        if ($exists->total > 0) {
            if (!$this->users_geographic_positions_model->trans_delete(array(), array('user_id' => $_POST['user_id']))) {
                $return['error'] = 'Error in deleting person';
            }
        }

        echo json_encode($return);
    }

    public function addNewGroup()
    {
        $company_id = logged('company_id');

        $return = array(
            'users' => $this->users_model->getByWhere(array('company_id' => $company_id), [], true),
            'groups' => array(),
            'error' => ''
        );

        $category_name = trim($_POST['category_name']);
        $exists = $this->db->query('select count(*) as `total` from users_geo_positions_categories where lower(category_name) = "' . strtolower($category_name) . '"')->row();
        if ($exists->total > 0) {
            $return['error'] = 'Category record already exists';
        } else {
            $uid = logged('id');

            $data = array(
                'category_name' => $category_name,
                'category_desc' => $_POST['category_desc'],
                'category_tag' => $_POST['category_tag'],
                'date_created' => date('Y-m-d h:i:s'),
                'created_by' => $uid,
                'company_id' => $company_id
            );

            if (!$this->users_geographic_positions_categories_model->trans_create($data)) {
                $return['error'] = 'Error in adding group';
            } else {
                $return['groups'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true);
            }

            echo json_encode($return);
        }
    }

    public function deleteGroup()
    {
        $company_id = logged('company_id');

        $return = array(
            'users' => $this->users_model->getByWhere(array('company_id' => $company_id), [], true),
            'groups' => array(),
            'error' => ''
        );

        $group_id = $_POST['group_id'];
        $exists = $this->db->query('select count(*) as `total` from users_geo_positions_categories where id = ' . $group_id)->row();
        $used = $this->db->query('select count(*) as `total` from users_geo_positions where category_id = ' . $group_id)->row();

        if ($exists->total <= 0) {
            $return['groups'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true);
        } else if ($used->total > 0) {
            $return['error'] = 'Group is currently in used';
        } else {
            if (!$this->users_geographic_positions_categories_model->trans_delete(array(), array('id' => $group_id))) {
                $return['error'] = 'Error in deleting group';
            } else {
                $return['groups'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id), [], true);
            }
        }

        echo json_encode($return);
    }

    public function places()
    {
        $company_id = logged('company_id');
        $config['zoom'] = "auto";
        $config['apiKey'] = 'AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU';

        $this->googlemaps->initialize($config);

        $place_locations = $this->trac360_model->get_places($company_id);
        foreach ($place_locations as $place) {
            $marker = array();
            $marker['position'] = $place->coordinates;
            $marker['animation'] =  'DROP';
            $image = $image = base_url('assets/img/trac360/mansion.png');
            $marker['infowindow_content'] = $place->address;
            $marker['icon'] = $image;
            $marker['icon_scaledSize'] = '50,50';

            $this->googlemaps->add_marker($marker);
        }
        $data = $this->googlemaps->create_map();

        $this->page_data['map'] = $data['html'];
        $this->page_data['map_js'] = $data['js'];
        $this->load->view('trac360/places', $this->page_data);
    }
    public function current_user_update_last_tracked_location()
    {
        $user_id = $this->input->post("user_id");
        $company_id = $this->input->post("company_id");
        $lat = $this->input->post("lat");
        $lng = $this->input->post("lng");
        $formatted_address = $this->input->post("formatted_address");
        $this->trac360_model->current_user_update_last_tracked_location($user_id, $company_id, $lat, $lng, $formatted_address);
        $data = new stdClass();
        $data->user_id = $user_id;
        $data->company_id = $company_id;
        $data->lat = $lat;
        $data->lng = $lng;
        $data->formatted_address = $formatted_address;
        echo json_encode($data);
    }
}
