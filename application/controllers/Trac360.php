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
        $company_id = logged('company_id');
        $user_id = logged('id');

        $user_locations = $this->trac360_model->get_current_user_location($company_id);
        $locations = array();
        foreach ($user_locations as $user) {
            $found = false;
            $found_ctr = 0;
            $current_user_location = "";
            if ($user->last_tracked_location != "") {
                for ($i = 0; $i < count($locations); $i++) {
                    if ($locations[$i][0] == $user->last_tracked_location) {
                        $found = true;
                        $found_ctr = $i;
                        break;
                    }
                }
                if (!$found) {
                    $locations[] = array($user->last_tracked_location, array($user->name), $user->profile_img);
                } else {
                    $names = $locations[$found_ctr][1];
                    $names[] =  $user->name;
                    $locations[$found_ctr][1] = $names;
                }
                $current_user_location = $user->last_tracked_location;
            } else {
                $last_loc = $this->trac360_model->get_last_location_from_timesheet_logs($user->user_id);
                for ($i = 0; $i < count($locations); $i++) {
                    if ($locations[$i][0] == $last_loc->user_location) {
                        $found = true;
                        $found_ctr = $i;
                        break;
                    }
                }
                if (!$found) {
                    $locations[] = array($last_loc->user_location, array($user->name), $user->profile_img);
                } else {
                    $names = $locations[$found_ctr][1];
                    $names[] =  $user->name;
                    $locations[$found_ctr][1] = $names;
                }
                $current_user_location = $last_loc->user_location;
            }
            if ($user->user_id == $user_id) {
            }
        }

        $config['zoom'] = "6";
        $config['center'] = $current_user_location;
        $config['apiKey'] = 'AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU';

        $this->googlemaps->initialize($config);

        for ($i = 0; $i < count($locations); $i++) {
            $marker = array();
            $names = $locations[$i][1];
            $name = "";
            for ($x = 0; $x < count($names); $x++) {
                if ($name == "") {
                    $name = $names[$x];
                } else {
                    $name .= "<br>" . $names[$x];
                }
            }

            $marker['infowindow_content'] = $name;

            $marker['position'] = $locations[$i][0];

            $marker['animation'] =  'DROP';

            $marker['icon'] = base_url() . "uploads/users/default.png";
            $marker['icon_scaledSize'] = '30,30';
            $this->googlemaps->add_marker($marker);
        }



        $data = $this->googlemaps->create_map();

        $this->page_data['map'] = $data['html'];
        $this->page_data['map_js'] = $data['js'];
        $this->page_data['apiKey'] = 'AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU';
        $this->page_data['categories'] = $this->users_geographic_positions_categories_model->getByWhere(array('company_id' => $company_id));
        $this->page_data['users'] = $this->users_model->getByWhere(array('company_id' => $company_id));

        $this->page_data['trac360_manager'] = $this->load->view('modals/trac360_manager', array(), true);
        $this->page_data['current_user_location'] = $current_user_location;
        $this->load->view('trac360/main', $this->page_data);
        // var_dump($data);
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
}
