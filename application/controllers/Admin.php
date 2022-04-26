<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(setting('timezone'));

        /*add_css(array(
           // 'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            "assets/css/accounting/accounting.css",
            'assets/css/dashboard.css',
            'assets/barcharts/css/chart.min.css',
            'assets/barcharts/css/chart.min.css',
            'assets/fa-5/css/fontawesome.min.css',
            'assets/fa-5/css/all.min.css'
        ));
        add_header_js(array(
            'assets/barcharts/js/chart.min.js',
            'assets/barcharts/js/utils.js',
            'assets/barcharts/js/chartjs-plugin-labels.js',
            'assets/js/timeago/dist/timeago.min.js',
            
        ));
        add_footer_js(array(
            //'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/dashboard/main.js',
            'assets/ringcentral/config.js',
            'assets/ringcentral/es6-promise.auto.js',
            'assets/ringcentral/fetch.umd.js',
            'assets/ringcentral/pubnub.4.20.1.js',
            'assets/ringcentral/ringcentral.js',
            'assets/ringcentral/rc_authentication.js'
        ));*/
        
        if (is_admin_logged()) {
            redirect('admin/dashboard', 'refresh');
        }

        $this->page_data = [
            'url' => assets_url()
        ];

        $this->data = [
            'assets' => assets_url(),
            'body_classes'  => setting('login_theme') == '1' ? 'login-page login-background' : 'login-page-side login-background'
        ];
    }

    public function login()
    {
        $this->load->view('admin/login', $this->data, false);
    }

    public function check()
    {
        $username = post('username');
        $password = post('password');
        $is_startup = 0;

        $attempt = $this->users_model->admin_attempt(compact('username', 'password'));

        if ($attempt == 'valid') {            
            $user = $this->db->where('username', $username)->or_where('email', $username)->get($this->users_model->table)->row();
            $this->users_model->admin_login($user, post('remember_me'));

            $access_modules = array(0 => 'all');
        } elseif ($attempt == 'invalid_password') {
            $this->data['message'] = 'Invalid Password';
            $this->data['message_type'] = 'danger';

            $this->login();
            return;
        } elseif ($attempt == 'not_allowed') {
            $this->data['message'] = 'You are not allowed to Login ! Contact Admin';
            $this->data['message_type'] = 'danger';

            $this->login();
            return;
        } else {
            $this->data['message'] = 'Something Went Wrong !';
            $this->data['message_type'] = 'danger';

            $this->login();
            return;
        }
        $this->load->model('Activity_model', 'activity');
        $activity['activityName'] = "User Login";
        $activity['activity'] = " User " . logged('username') . " is loggedin";
        $activity['user_id'] = logged('id');

        $isUserInserted = $this->activity->addEsignActivity($activity);
        redirect('admin/users');
    }

    public function users(){
        $this->load->model('Users_model');
        $this->load->model('PayScale_model');
        $this->load->model('Business_model');
        $this->load->model('Clients_model');
        $cid_search = 'All Companies';
        if( get('cid') ){
            $users   = $this->Users_model->getCompanyUsers(get('cid'));
            $company = $this->Business_model->getByCompanyId(get('cid'));
            $cid_search = $company->business_name;
        }else{
            $users = $this->Users_model->getAllUsers();
        }

        $this->page_data['page_title'] = 'Users';
        $this->page_data['page_parent'] = 'Users';
        $this->page_data['cid_search']  = $cid_search;
        $this->page_data['rolesList'] = $this->users_model->userRolesList();
        $this->page_data['roles']     = $this->users_model->getRoles();
        $this->page_data['companies'] = $this->Business_model->getAll();
        $this->page_data['users']    = $users;
        $this->page_data['payscale'] = $this->PayScale_model->getAll();
        $this->load->view('admin/users/list', $this->page_data);
    }

    public function logout(){
        if(is_admin_logged()){
            $this->load->model('Activity_model', 'activity');
            $activity['activityName'] = "Admin User Logout";
            $activity['activity'] = " User ".logged('username')." is logged out";
            $activity['user_id'] = logged('id');
            $this->activity->addEsignActivity($activity);
        }

        $this->activity_model->add("User: ".getLoggedFullName(logged('id')).' Admin Logged Out'); 

        $this->users_model->admin_logout();
        $this->users_model->logout();

        $this->session->unset_userdata('admin_bypass');

        redirect('admin/login','refresh');
    }

    public function ajaxCreateUser(){
        $this->load->model('Users_model');

        $post = $this->input->post();

        $is_success = 0;
        $msg = '';

        $isUsernameExists = $this->Users_model->getUserByEmail($post['user_email']);
        if( $isUsernameExists ){
            $msg = 'Email already taken';
        }else{
            $add = array(
                'company_id' => $post['company_id'],
                'FName' => $post['firstname'],
                'LName' => $post['lastname'],
                'username' => $post['user_email'],
                'email' => $post['user_email'],
                'password' => hash("sha256",$post['user_password']),
                'password_plain' => $post['user_password'],
                'role' => $post['role'],
                'user_type' => $post['user_type'],
                'status' => $post['status'],
                'address' => $post['address'],
                'state' => $post['state'],
                'city' => $post['city'],
                'postal_code' => $post['postal_code'],
                'payscale_id' => 0,
                'employee_number' => $post['emp_number']
            );

            $last_id = $this->users_model->addNewEmployee($add);

            //Create timesheet record
            $this->load->model('TimesheetTeamMember_model');
            $this->TimesheetTeamMember_model->create([
                'user_id' => $last_id,
                'name' => $post['firstname'] . ' ' . $post['lastname'],
                'email' => $post['user_email'],
                'role' => 'Employee',
                'department_id' => 0,
                'department_role' => 'Member',
                'will_track_location' => 1,
                'status' => 1,
                'company_id' => $post['company_id']
            ]);
            //End Timesheet     

            //Create Trac360 record
            $this->load->model('Trac360_model');
            $data = [
                'user_id' => $last_id,
                'name' => $post['firstname'] . ' ' . $post['lastname'],
                'company_id' => $post['company_id']
            ];
            $this->Trac360_model->add('trac360_people', $data);
            //End Trac360

            $is_success = 1;
        }
        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function getRoles(){
        $cid = logged('company_id');
        $role_title = $this->input->get('search');
        $roles = $this->users_model->getRolesBySearch($role_title, $cid);
        $data = array();
        foreach ($roles as $role){
            $data[] = array(
                'id' => $role->id,
                'text' => $role->title,
                'selected' => true
            );
        }
        echo json_encode($data);

    }

    private $user_path = './uploads/users/user-profile/';
    public function profilePhoto(){
        if (! empty($_FILES)){
            $config = array(
                'upload_path' => './uploads/users/user-profile/',
                'allowed_types' => '*',
                'overwrite' => TRUE,
                'max_size' => '20000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload',$config);
            if ($this->upload->do_upload("file")){
                $uploadData = $this->upload->data();
                $data = array(
                    'profile_image'=> $uploadData['file_name'],
                    'date_created' => time()
                );
                $query = $this->users_model->addProfilePhoto($data);
                $return = new stdClass();
                $return->photo = $uploadData['file_name'];
                $return->id = $query;
                echo json_encode($return);
            }
        }else{
            echo json_encode('error');
        }
    }

    public function removeTemporaryImg(){
        $file = $this->input->post('image');
        $image_id = $this->input->post('image_id');
        if ($file && file_exists($this->user_path. $file)){
            unlink( $this->user_path. $file);
            $this->db->where('id',$image_id);
            $this->db->delete('user_profile_photo');
            echo json_encode(1);
        }
    }

    public function ajax_edit_employee(){
        $this->load->model('Users_model');
        $this->load->model('PayScale_model');
        $this->load->model('Business_model');

        $user_id  = $this->input->post('user_id');
        $get_user = $this->Users_model->getUser($user_id);
        $get_role = $this->db->get_where('roles',array('id' => $get_user->role));

        $roles = $this->users_model->getRoles();

        $this->page_data['payscale'] = $this->PayScale_model->getAll();
        $this->page_data['rolesList'] = $this->users_model->userRolesList();
        $this->page_data['companies'] = $this->Business_model->getAll();
        $this->page_data['roles'] = $roles;
        $this->page_data['user'] = $get_user;
        $this->page_data['role'] = $get_role;
        $this->load->view('admin/users/modal_edit_form', $this->page_data);
    }

    public function ajaxUpdateUser(){
        $this->load->model('Users_model');
        
        $post = $this->input->post();

        $is_success = 0;
        $msg = '';

        if( $post['company_id'] == '' ){
            $msg = 'Please select company';
        }

        if( $post['emp_number'] == '' ){
            $msg = 'Please specify employee number';
        }

        if( $msg == '' ){
            $data = array(
                'company_id' => $post['company_id'],
                'FName' => $post['firstname'],
                'LName' => $post['lastname'],
                'role' => $post['role'],
                'status' => $post['status'],
                'address' => $post['address'],
                'state' => $post['state'],
                'city' => $post['city'],
                'postal_code' => $post['postal_code'],
                //'payscale_id' => $post['empPayscale'],
                'user_type' => $post['user_type'],
                'employee_number' => $post['emp_number']
            );

            $user = $this->Users_model->update($user_id,$data);

            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function removeProfilePhoto(){
        $file = $this->input->post('name');
        $index = $this->input->post('index');
        if ($file && file_exists($this->user_path. $file[$index])){
            unlink( $this->user_path. $file[$index]);
            $this->db->where('profile_image',$file[$index]);
            $this->db->delete('user_profile_photo');
            echo json_encode(1);
        }
    }

    public function ajaxUpdateEmployeePassword(){
        $this->load->model('Users_model');

        $is_success = false;
        $msg = "";

        $post = $this->input->post();

        $new_password = $post['new_password'];
        $re_password  = $post['re_password'];
        $user_id      = $post['eid'];

        if( $new_password != $re_password ){
            $msg = "Password not same";
        }else{
            $data = array(
                'password' => hash("sha256",$new_password),
                'password_plain' => $new_password,
            );

            $user = $this->Users_model->update($user_id,$data);

            $is_success = true;
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajaxUpdateEmployeeStatus(){
        $this->load->model('Users_model');

        $is_success = true;
        $msg = "";

        $user_id = $this->input->post('status_user_id');
        $status  = $this->input->post('status_user_status');

        $data = array(            
            'status' => $status
        );

        $user = $this->Users_model->update($user_id,$data);

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajaxUpdateCompanyStatus(){
        $this->load->model('Clients_model');

        $is_success = true;
        $msg = "";

        $post = $this->input->post();

        $company_id = $post['cid'];
        $status     = $post['status'];

        $data = array(            
            'is_plan_active' => $status
        );

        $company = $this->Clients_model->update($company_id,$data);

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajaxDeleteUser(){
        $this->load->model('Users_model');
        
        $id = post('delete_user_id');
        $user = $this->users_model->delete($id);

        //Delete Timesheet 
        $this->load->model('TimesheetTeamMember_model');
        $this->TimesheetTeamMember_model->deleteByUserId($id);
        //Delete Tract360
        $this->load->model('Trac360_model');
        $this->Trac360_model->deleteUser('trac360_people', $id);

        $this->activity_model->add("User #$id Deleted by User:".logged('name'));
        
        $return = ['is_success' => 1];
        echo json_encode($return);
    }

    public function ajaxDeleteCompany(){
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('Business_model');
        
        $is_success = 0;
        $msg = "";

        $post = $this->input->post();

        $company = $this->Clients_model->getById($post['cid']);
        if( $company ){
            $this->Users_model->deleteAllByCompanyId($post['cid']);
            $this->Business_model->deleteByCompanyId($post['cid']);
            $this->Clients_model->deleteClient($post['cid']);

            $is_success = 1;

        }else{
            $msg = 'Cannot find data';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajaxUpdateEmployeeProfilePhoto(){
        $this->load->model('Users_model');

        $user_id = $this->input->post('values[user_id_prof]');
        $profile_img = $this->input->post('values[profile_img]');

        $user = $this->Users_model->getUser($user_id);

        if( $profile_img == '' ){
            $profile_img = $user->profile_img;
        }
        $data = array(            
            'profile_img' => $profile_img
        );

        $user = $this->Users_model->update($user_id,$data);

        echo json_encode(1);
    }

    public function nsmart_plans() {
        $this->load->model('NsmartPlan_model');

        $nSmartPlans   = $this->NsmartPlan_model->getAll();
        $option_status = $this->NsmartPlan_model->getPlanStatus();
        $option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

        $this->page_data['option_status'] = $option_status;
        $this->page_data['option_discount_types'] = $option_discount_types;
        $this->page_data['nSmartPlans'] = $nSmartPlans;
        $this->load->view('admin/nsmart_plans/list', $this->page_data);
    }

    public function add_new_plan() {
        $this->load->model('NsmartPlan_model');

        $option_status = $this->NsmartPlan_model->getPlanStatus();
        $option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

        $this->page_data['option_status'] = $option_status;
        $this->page_data['option_discount_types'] = $option_discount_types;
        $this->load->view('admin/nsmart_plans/add_new_plan', $this->page_data);
    }

    public function create_nsmart_plan() {
        $this->load->model('NsmartPlan_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['plan_name'] != '' ){
            if( $this->NsmartPlan_model->isPlanNameExists($post['plan_name']) ){
                $this->session->set_flashdata('message', 'Plan name already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'plan_name' => $post['plan_name'],
                    'plan_description' => $post['plan_description'],
                    'num_license' => $post['num_license'],
                    'price_per_license' => $post['price_per_license'],
                    'price' => $post['plan_price'],
                    'discount' => $post['plan_discount'],
                    'discount_type' => $post['plan_discount_type'],
                    'status' => $post['plan_status'],
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $nsPlan = $this->NsmartPlan_model->create($data);

                $this->session->set_flashdata('message', 'Add new plan was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter plan name');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/nsmart_plans');
    }

    public function edit_nsmart_plan($plan_id) {
        $this->load->model('NsmartPlan_model');
        $nSmartPlan = $this->NsmartPlan_model->getById($plan_id);

        if( $nSmartPlan ){
            $option_status = $this->NsmartPlan_model->getPlanStatus();
            $option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

            $this->page_data['nSmartPlan'] = $nSmartPlan;
            $this->page_data['option_status'] = $option_status;
            $this->page_data['option_discount_types'] = $option_discount_types;
            $this->load->view('admin/nsmart_plans/edit_plan', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/nsmart_plans');
        }
    }

    public function update_nsmart_plan() {
        $this->load->model('NsmartPlan_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $nSmartPlan = $this->NsmartPlan_model->getById($post['plan_id']);

        if( $nSmartPlan ){
            if( $post['plan_name'] != '' ){
                $data = [
                    'plan_name' => $post['plan_name'],
                    'plan_description' => $post['plan_description'],
                    'price' => $post['plan_price'],
                    'num_license' => $post['num_license'],
                    'price_per_license' => $post['price_per_license'],
                    'discount' => $post['plan_discount'],
                    'discount_type' => $post['plan_discount_type'],
                    'status' => $post['plan_status'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $nsPlan = $this->NsmartPlan_model->updatePlan($post['plan_id'],$data);

                $this->session->set_flashdata('message', 'Plan was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter plan name');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/edit_nsmart_plan/'.$post['plan_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/nsmart_plans');
        }
    }

    public function delete_nsmart_plan(){
        $this->load->model('NsmartPlan_model');

        $this->NsmartPlan_model->deletePlan(post('pid'));

        $this->session->set_flashdata('message', 'Plan has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/nsmart_plans');
    }

    public function nsmart_features() {
        $this->load->model('NsmartPlan_model');
        $this->load->model('PlanHeadings_model');
        $this->load->model('NsmartFeature_model');
        $this->load->model('NsmartPlanModules_model');

        $planHeadings = $this->PlanHeadings_model->getAll();
        $data_features = array();
        foreach( $planHeadings as $ph ){
            $modules = $this->NsmartPlanModules_model->getAllByPlanHeadingId($ph->id);
            foreach( $modules as $m ){
                $data_features[$ph->title][$m->nsmart_feature_id]['feature_name'] = $m->feature_name; 
                $data_features[$ph->title][$m->nsmart_feature_id]['feature_id'] = $m->nsmart_feature_id;  
                $data_features[$ph->title][$m->nsmart_feature_id]['plans'][] = $m->plan_name;
            }
        }

        $this->page_data['data_features'] = $data_features;
        $this->load->view('admin/nsmart_features/list', $this->page_data);

    }

    public function add_new_feature() {
        $this->load->model('NsmartPlan_model');
        $this->load->model('PlanHeadings_model');
        $this->load->model('NsmartFeature_model');

        $planHeadings   = $this->PlanHeadings_model->getAll();
        $plans   = $this->NsmartPlan_model->getAll();

        $this->page_data['planHeadings'] = $planHeadings;
        $this->page_data['plans'] = $plans;
        $this->load->view('admin/nsmart_features/add_new_feature', $this->page_data);
    }   

    public function create_nsmart_feature() {
        $this->load->model('NsmartPlan_model');
        $this->load->model('PlanHeadings_model');
        $this->load->model('NsmartFeature_model');
        $this->load->model('NsmartPlanModules_model');
        
        $post = $this->input->post();

        if( $post['feature_name'] != '' ){
            $data_feature = [
                'feature_name' => $post['feature_name'],
                'feature_description' => $post['feature_description'],
                'plan_heading_id' => $post['feature_heading'],
                'date_created' => date("Y-m-d H:i:s")
            ];

            $nsmart_feature_id = $this->NsmartFeature_model->save($data_feature);
            if( $nsmart_feature_id > 0 ){
                foreach( $post['plans'] as $id => $value ){
                    $data_plan_modules = [
                        'nsmart_plans_id' => $id,
                        'nsmart_feature_id' => $nsmart_feature_id,
                        'plan_heading_id' => $post['feature_heading']
                    ];

                    $nsPlanFeature = $this->NsmartPlanModules_model->create($data_plan_modules);
                }

                $this->session->set_flashdata('message', 'Add new plan feature was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');

            }else{
                $this->session->set_flashdata('message', 'Cannot save feature.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

        }else{
            $this->session->set_flashdata('message', 'Please enter feature name');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/nsmart_features');
    }

    public function edit_nsmart_feature($feature_id) {
        $this->load->model('NsmartPlan_model');
        $this->load->model('PlanHeadings_model');
        $this->load->model('NsmartFeature_model');
        $this->load->model('NsmartPlanModules_model');

        $nSmartFeature = $this->NsmartFeature_model->getById($feature_id);
        $option_plan = $this->NsmartPlanModules_model->getByFeatureId($feature_id);
        $planHeadings   = $this->PlanHeadings_model->getAll();
        $plans   = $this->NsmartPlan_model->getAll();

        $option_plan_id_array = array();
        if($option_plan) {
            foreach($option_plan as $op) {
                $option_plan_id_array[] = $op->nsmart_plans_id;
            }
        }       

        if( $nSmartFeature ){
            if($_POST){

                foreach( $post['plans'] as $id => $value ){
                    $data_plan_modules = [
                        'nsmart_plans_id' => $id,
                        'nsmart_feature_id' => $post['id'],
                        'plan_heading_id' => $post['feature_heading']
                    ];

                    $nsPlanFeature = $this->NsmartPlanModules_model->create($data_plan_modules);
                }

                $data = [
                        'feature_name' => $post['feature_name'],
                        'feature_description' => $post['feature_description'],
                        'feature_heading_id' => $post['feature_heading'],
                        'date_updated' => date("Y-m-d H:i:s")
                        ];

                $nsPlan = $this->NsmartFeature_model->updateFeature($post['id'],$data);
                $this->session->set_flashdata('message', 'Feature was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }

            $this->page_data['planHeadings'] = $planHeadings;
            $this->page_data['nSmartFeature'] = $nSmartFeature;
            $this->page_data['plans'] = $plans;
            $this->page_data['option_plan'] = $option_plan;
            $this->page_data['default_option_plans'] = $option_plan_id_array;
            $this->load->view('admin/nsmart_features/edit_feature', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/nsmart_features',$this->page_data);
        }
    }

    public function update_nsmart_feature() {
        $this->load->model('NsmartPlanModules_model');
        $this->load->model('NsmartFeature_model');

        if($_POST){
            $this->NsmartPlanModules_model->deletePlanModules($_POST['id']);
            $data_plan_modules = array();

            foreach( $_POST['plans'] as $key => $value ){
                $data_plan_modules = [
                    'nsmart_plans_id' => $key,
                    'nsmart_feature_id' => $_POST['id'],
                    'plan_heading_id' => $_POST['feature_heading']
                ];
                $nsPlanFeature = $this->NsmartPlanModules_model->save($data_plan_modules);
            }

            $data = array();
            $data = ['feature_name' => $_POST['feature_name'],
                    'feature_description' => $_POST['feature_description'],
                    'plan_heading_id' => $_POST['feature_heading'],
                    'date_updated' => date("Y-m-d H:i:s")
                    ];
            $nsPlan = $this->NsmartFeature_model->updateFeature($_POST['id'],$data);
            $this->session->set_flashdata('message', 'Feature was successfully updated');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }

         redirect('admin/edit_nsmart_feature/'. $_POST['id'] );
    }

    public function delete_nsmart_plan_feature(){
        $this->load->model('NsmartFeature_model');
        $this->load->model('NsmartPlanModules_model');

        $this->NsmartPlanModules_model->deletePlanModules(post('fid'));
        $id = $this->NsmartFeature_model->deleteFeature(post('fid'));

        $this->session->set_flashdata('message', 'Plan feature has been deleted successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/nsmart_features');
    }

    public function add_new_plan_headings() {
        $this->load->view('admin/plan_headings/add_new_headings', $this->page_data);
    }

    public function create_plan_headings() {
        $this->load->model('PlanHeadings_model');

        $post = $this->input->post();

        if( $post['plan_heading_name'] != '' ){
            if( $this->PlanHeadings_model->isTitle($post['plan_heading_name']) ){
                $this->session->set_flashdata('message', 'Title already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'title' => $post['plan_heading_name'],
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $planHeading = $this->PlanHeadings_model->create($data);

                $this->session->set_flashdata('message', 'Add new plan heading was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter title');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/nsmart_features');
    }

    public function nsmart_addons() {
        $this->load->model('NsmartAddons_model');

        $nSmartAddons   = $this->NsmartAddons_model->getAll();
        
        $this->page_data['nSmartAddons'] = $nSmartAddons;
        $this->load->view('admin/nsmart_addons/list', $this->page_data);
    }

    public function add_new_addon(){
        $this->load->model('NsmartPlan_model');

        $option_status = $this->NsmartPlan_model->getPlanStatus();

        $this->page_data['option_status'] = $option_status;
        $this->load->view('admin/nsmart_addons/add_new_addon', $this->page_data);
    }

    public function create_plan_addon() {
        $this->load->model('NsmartAddons_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['addon_name'] != '' ){
            if( $this->NsmartAddons_model->isAddonNameExists($post['addon_name']) ){
                $this->session->set_flashdata('message', 'Addon name already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'name' => $post['addon_name'],
                    'description' => $post['description'],
                    'price' => $post['price'],
                    'status' => $post['status'],
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $nsPlan = $this->NsmartAddons_model->create($data);

                $this->session->set_flashdata('message', 'Add new addon was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter addon name');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/nsmart_addons');
    }

    public function edit_addon($addon_id) {
        $this->load->model('NsmartAddons_model');
        $this->load->model('NsmartPlan_model');

        $nSmartAddon = $this->NsmartAddons_model->getById($addon_id);

        if( $nSmartAddon ){
            $option_status = $this->NsmartPlan_model->getPlanStatus();

            $this->page_data['nSmartAddon'] = $nSmartAddon;
            $this->page_data['option_status'] = $option_status;
            $this->load->view('admin/nsmart_addons/edit_addon', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/nsmart_addons');
        }
    }

    public function update_plan_addon() {
        $this->load->model('NsmartAddons_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $nSmartAddon = $this->NsmartAddons_model->getById($post['addon_id']);

        if( $nSmartAddon ){
            if( $post['addon_name'] != '' ){
                $data = [
                    'name' => $post['addon_name'],
                    'description' => $post['description'],
                    'price' => $post['price'],
                    'status' => $post['status'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $nsAddon = $this->NsmartAddons_model->updateAddon($post['addon_id'],$data);

                $this->session->set_flashdata('message', 'Addon was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter addon name');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/edit_addon/'.$post['addon_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/nsmart_addons');
        }
    }

    public function delete_plan_addon(){
        $this->load->model('NsmartAddons_model');
        $post = $this->input->post();

        $id = $this->NsmartAddons_model->deleteAddon(post('pid'));

        $this->session->set_flashdata('message', 'Addon has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/nsmart_addons');
    }

    public function plan_upgrades() {
        $this->load->model('NsmartUpgrades_model');
        $nSmartUpgrades   = $this->NsmartUpgrades_model->getAll();
        
        $this->page_data['nSmartUpgrades'] = $nSmartUpgrades;
        $this->load->view('admin/nsmart_upgrades/list', $this->page_data);
    }

    public function add_new_upgrade() {
        
        $this->load->view('admin/nsmart_upgrades/add_new_upgrade', $this->page_data);
    }

    public function create_plan_upgrade() {
        $this->load->model('NsmartUpgrades_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['upgrade_name'] != '' ){
            if( $this->NsmartUpgrades_model->isUpgradeNameExists($post['upgrade_name']) ){
                $this->session->set_flashdata('message', 'Upgrade name already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'name' => $post['upgrade_name'],
                    'description' => $post['description'],
                    'sms_fee' => $post['sms_fee'],
                    'service_fee' => $post['service_fee'],
                    'status' => $post['status'],
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $nsPlan = $this->NsmartUpgrades_model->create($data);

                $this->session->set_flashdata('message', 'Add new upgrade was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter upgrade name');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/plan_upgrades');
    }

    public function edit_plan_upgrade($upgrade_id) {
        $this->load->model('NsmartUpgrades_model');
        
        $nSmartUpgrades = $this->NsmartUpgrades_model->getById($upgrade_id);

        if( $nSmartUpgrades ){
            $this->page_data['nSmartUpgrades'] = $nSmartUpgrades;
            $this->load->view('admin/nsmart_upgrades/edit_upgrade', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/plan_upgrades');
        }
    }

    public function update_plan_upgrade() {
        $this->load->model('NsmartUpgrades_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $NsmartUpgrades = $this->NsmartUpgrades_model->getById($post['upgrade_id']);

        if( $NsmartUpgrades ){
            if( $post['upgrade_name'] != '' ){
                $data = [
                    'name' => $post['upgrade_name'],
                    'description' => $post['description'],
                    'sms_fee' => $post['sms_fee'],
                    'service_fee' => $post['service_fee'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                $nsAddon = $this->NsmartUpgrades_model->updateUpgrade($post['upgrade_id'],$data);

                $this->session->set_flashdata('message', 'Upgrade was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter Upgrade name');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/edit_plan_upgrade/'.$post['upgrade_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/plan_upgrades');
        }
    }

    public function delete_nsmart_upgrade()
    {
        $this->load->model('NsmartUpgrades_model');

        $post = $this->input->post();

        $id = $this->NsmartUpgrades_model->deleteUpgrade(post('u_id'));

        $this->session->set_flashdata('message', 'Upgrade has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/plan_upgrades');
    }

    public function industry_modules()
    {
        $this->load->model('IndustryModules_model');

        $industryModules   = $this->IndustryModules_model->getAll();
        
        $this->page_data['industryModules'] = $industryModules;
        $this->load->view('admin/industry_modules/list', $this->page_data);
    }

    public function add_new_industry_module()
    {
        
        $this->load->view('admin/industry_modules/add_new_module', $this->page_data);
    }

    public function create_industry_module()
    {
        $this->load->model('IndustryModules_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['name'] != '' ){
            if( $this->IndustryModules_model->getByName($post['name']) ){
                $this->session->set_flashdata('message', 'Module name already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'name' => $post['name'],
                    'description' => $post['description'],
                    'status' => 1,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $industry_modules = $this->IndustryModules_model->create($data);

                $this->session->set_flashdata('message', 'Add new modules was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter module name');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/industry_modules');
    }

    public function edit_industry_module($module_id)
    {
        $this->load->model('IndustryModules_model');

        $industryModules = $this->IndustryModules_model->getById($module_id);

        if( $industryModules ){
            $this->page_data['industryModules'] = $industryModules;
            $this->load->view('admin/industry_modules/edit_module', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/industry_modules');
        }
    }

    public function update_industry_module()
    {
        $this->load->model('IndustryModules_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryModules = $this->IndustryModules_model->getById($post['module_id']);

        if( $industryModules ){
            if( $post['name'] != '' ){
                $data = [
                    'name' => $post['name'],
                    'description' => $post['description'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                $industryModulesUpdate = $this->IndustryModules_model->updateIndustryModules($post['module_id'],$data);

                $this->session->set_flashdata('message', 'Module was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter module name');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/edit_industry_module/'.$post['module_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/industry_modules');
        }
    }

    public function delete_industry_module()
    {
        $this->load->model('IndustryModules_model');

        $post = $this->input->post();

        $id = $this->IndustryModules_model->deleteIndustryModules(post('mid'));

        $this->session->set_flashdata('message', 'Module has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/industry_modules');
    }

    public function industry_template() 
    {
        $this->load->model('IndustryTemplate_model');

        $industryTemplate   = $this->IndustryTemplate_model->getAll();
        
        $this->page_data['industryTemplate'] = $industryTemplate;
        $this->load->view('admin/industry_template/list', $this->page_data);
    }

    public function add_new_industry_template()
    {
        
        $this->load->view('admin/industry_template/add_new_template', $this->page_data);
    }

    public function create_industry_template() 
    {
        $this->load->model('IndustryTemplate_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['name'] != '' ){
            if( $this->IndustryTemplate_model->getByName($post['name']) ){
                $this->session->set_flashdata('message', 'Template name already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'name' => $post['name'],
                    'status' => 1,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $industry_template = $this->IndustryTemplate_model->create($data);

                $this->session->set_flashdata('message', 'Add new template was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter module name');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/industry_template');
    }

    public function edit_industry_template($template_id) 
    {
        $this->load->model('IndustryTemplate_model');

        $industryTemplate = $this->IndustryTemplate_model->getById($template_id);

        if( $industryTemplate ){
            $this->page_data['industryTemplate'] = $industryTemplate;
            $this->load->view('admin/industry_template/edit_template', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/industry_template');
        }
    }

    public function update_industry_template() 
    {
        $this->load->model('IndustryTemplate_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryTemplate = $this->IndustryTemplate_model->getById($post['template_id']);

        if( $industryTemplate ){
            if( $post['name'] != '' ){
                $data = [
                    'name' => $post['name'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                $industryTemplateUpdate = $this->IndustryTemplate_model->updateIndustryTemplate($post['template_id'],$data);

                $this->session->set_flashdata('message', 'Template was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter module name');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/edit_industry_template/'.$post['template_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/industry_template');
        }
    }

    public function assign_industry_template_modules($template_id) 
    {
        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryModules_model');
        $this->load->model('IndustryTemplateModules_model');

        $industryTemplate = $this->IndustryTemplate_model->getById($template_id);
        $industryModules = $this->IndustryModules_model->getAll();
        $industryTemplateModules = $this->IndustryTemplateModules_model->getAllByTemplateId($template_id);

        if( $industryTemplate ){
            $this->page_data['industryTemplate'] = $industryTemplate;
            $this->page_data['industryModules'] = $industryModules;
            $this->page_data['industryTemplateModules']  = $industryTemplateModules;
            $this->load->view('admin/industry_template/assign_template_modules', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/industry_template');
        }
    }

    public function update_industry_template_modules() 
    {

        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryTemplateModules_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryTemplate = $this->IndustryTemplate_model->getById($post['template_id']);

        if( $industryTemplate ){
            if( $post['name'] != '' ){

                if(is_array($post['modules'])){
                    $this->IndustryTemplateModules_model->deleteIndustryTemplateModulesByTemplateId($post['template_id']);
                    foreach ($post['modules'] as $key => $module_id) {
                        $data = [
                            'industry_template_id' => $post['template_id'],
                            'industry_module_id ' => $module_id,
                            'status' => 1,   
                            'date_created' => date("Y-m-d H:i:s"),
                            'date_modified' => date("Y-m-d H:i:s")
                        ];
                        $industryTemplateModules = $this->IndustryTemplateModules_model->create($data);
                    }   
                }
                

                $this->session->set_flashdata('message', 'Template Modules was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter module name');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/assign_industry_template_modules/'.$post['template_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/industry_template');
        }
    }

    public function delete_industry_template()
    {
        $this->load->model('IndustryTemplate_model');

        $post = $this->input->post();

        $id = $this->IndustryTemplate_model->deleteIndustryTemplate(post('tid'));

        $this->session->set_flashdata('message', 'Template has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/industry_template');
    }

    public function industry_type() 
    {
        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryType_model');

        $this->load->library('pagination');
        //$offset = ($page-1)*$config["per_page"];
        $industryTemplate   = $this->IndustryTemplate_model->getAll();

        $total_records = $this->IndustryType_model->countAllRecords();
        $uri_segment   = $this->uri->segment(3);
        $per_page      = 10;
        if($uri_segment == 0 || empty($uri_segment)){
            $uri_segment = 5;
        }else{
            $uri_segment = $uri_segment + $per_page;
        }

        $industryTypes   = $this->IndustryType_model->getAll(array('limit_perpage' => $per_page, 'offset' => $uri_segment));        

        $config['total_rows']  = $total_records;
        $config['per_page']    = $per_page;
        $config['base_url']    = base_url(). 'admin/industry_type';
        $config['total_rows']  = $total_records;
        $config['num_links']   = 1;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $this->page_data['pagination']    = $this->pagination->create_links();
        $this->page_data['industryTypes'] = $industryTypes;
        $this->page_data['industryTemplate'] = $industryTemplate;
        $this->load->view('admin/industry_type/list', $this->page_data);
    }

    public function add_new_industry_type() 
    {
        $this->load->model('IndustryTemplate_model');

        $businessTypes = [ 
          'Building Contractors' => 'Building Contractors',
          'Financial Services' => 'Financial Services',
          'Technical Services' => 'Technical Services',
          'Health And Beauty' => 'Health And Beauty',
          'Transportation' => 'Transportation',
          'Organization / Cleaning' => 'Organization / Cleaning',
          'Entertainment Services' => 'Entertainment Services',
          'Design Services' => 'Design Services',
          'Other' => 'Other',
        ];
        $industryTemplate   = $this->IndustryTemplate_model->getAll();

        $this->page_data['industryTemplate'] = $industryTemplate;
        $this->page_data['businessTypes'] = $businessTypes;            
        $this->load->view('admin/industry_type/add_new_industry_type', $this->page_data);
    }

    public function create_industry_type() 
    {
        $this->load->model('IndustryType_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['name'] != '' ){
            if( $this->IndustryType_model->getByName($post['name']) ){
                $this->session->set_flashdata('message', 'Type name already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'name' => $post['name'],
                    'business_type_name' => $post['business_type_name'],
                    'industry_template_id' => $post['industry_template_id'],
                    'status' => 1,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $industryType = $this->IndustryType_model->create($data);

                $this->session->set_flashdata('message', 'Add new type was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/industry_type');
    }

    public function edit_industry_type($type_id) 
    {
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplate_model');

        $industryType = $this->IndustryType_model->getById($type_id);
        $industryTemplate   = $this->IndustryTemplate_model->getAll();
        $businessTypes = [ 
                      'Building Contractors' => 'Building Contractors',
                      'Financial Services' => 'Financial Services',
                      'Technical Services' => 'Technical Services',
                      'Health And Beauty' => 'Health And Beauty',
                      'Transportation' => 'Transportation',
                      'Organization / Cleaning' => 'Organization / Cleaning',
                      'Entertainment Services' => 'Entertainment Services',
                      'Design Services' => 'Design Services',
                      'Other' => 'Other',
                    ];

        if( $industryType ){
            $this->page_data['businessTypes'] = $businessTypes;
            $this->page_data['industryType'] = $industryType;
            $this->page_data['industryTemplate'] = $industryTemplate;
            $this->load->view('admin/industry_type/edit_industry_type', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/industry_type');
        }
    }

    public function update_industry_type() 
    {
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplate_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryTemplate = $this->IndustryType_model->getById($post['type_id']);

        if( $industryTemplate ){
            if( $post['name'] != '' ){
                $data = [
                    'name' => $post['name'],
                    'business_type_name' => $post['business_type_name'],
                    'industry_template_id' => $post['industry_template_id'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                $industryTemplateUpdate = $this->IndustryType_model->updateIndustryType($post['type_id'],$data);

                $this->session->set_flashdata('message', 'Type was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter type name');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/edit_industry_type/'.$post['type_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/industry_type');
        }
    }

    public function delete_industry_type()
    {
        $this->load->model('IndustryType_model');

        $post = $this->input->post();

        $id = $this->IndustryType_model->deleteIndustryType(post('tid'));

        $this->session->set_flashdata('message', 'Industry Type has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/industry_type');
    }

    public function subscribers() 
    {
        $this->load->model('Clients_model');

        $subscriptions   = $this->Clients_model->getAll();

        $this->page_data['subscriptions'] = $subscriptions;
        $this->load->view('admin/subscribers/list', $this->page_data);
    }

    public function ajax_load_subscriber_details() 
    {
        $this->load->model('Clients_model');
        $this->load->model('SubscriberNsmartUpgrade_model');
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');

        $post = $this->input->post();

        $sid = $post['sid'];
        $cid = logged('company_id');

        $subscriber   = $this->Clients_model->getById($sid);
        $upgrades     = $this->SubscriberNsmartUpgrade_model->getAllByClientId($cid);
        $industryType = $this->IndustryType_model->getById($subscriber->industry_type_id);
        $templateModules = $this->IndustryTemplateModules_model->getAllByIndustryTemplateId($industryType->industry_template_id);

        $this->page_data['templateModules'] = $templateModules;
        $this->page_data['subscriber'] = $subscriber;
        $this->page_data['upgrades']   = $upgrades;
        $this->load->view('admin/companies/ajax_subscriber_details', $this->page_data);
    }

    public function ajax_load_company_module_details() 
    {
        $this->load->model('Clients_model');
        $this->load->model('SubscriberNsmartUpgrade_model');
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');
        $this->load->model('CompanyDeactivatedModule_model');

        $post = $this->input->post();
        $sid  = $post['sid'];

        $subscriber   = $this->Clients_model->getById($sid);
        $industryType = $this->IndustryType_model->getById($subscriber->industry_type_id);
        $templateModules = $this->IndustryTemplateModules_model->getAllByIndustryTemplateId($industryType->industry_template_id);
        $deactivatedModules = $this->CompanyDeactivatedModule_model->getAllByCompanyId($subscriber->id);

        $deactivated_modules = array();
        foreach($deactivatedModules as $d){
            $deactivated_modules[$d->industry_module_id] = $d->industry_module_id;
        }

        $this->page_data['deactivated_modules'] = $deactivated_modules;
        $this->page_data['templateModules'] = $templateModules;
        $this->page_data['subscriber'] = $subscriber;
        $this->load->view('admin/subscribers/ajax_company_module_details', $this->page_data);
    }

    public function offer_codes() 
    {   
        $this->load->model('OfferCodes_model');
        $offerCodes   = $this->OfferCodes_model->getAll();
        
        $this->page_data['offerCodes'] = $offerCodes;
        $this->load->view('admin/offer_codes/list', $this->page_data);
    }

    public function add_new_offer() 
    {
        
        $this->load->view('admin/offer_codes/add_new_offer_code', $this->page_data);
    }

    public function create_offer_code() 
    {
        $this->load->model('OfferCodes_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['offer_code'] != '' ){
            if( $this->OfferCodes_model->getByOfferCodes($post['offer_code']) ){
                $this->session->set_flashdata('message', 'Offer Code already exists');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }else{
                $data = [
                    'offer_code' => $post['offer_code'],
                    'trial_days' => $post['trial_days'],
                    'status' => 0,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $OfferCodes = $this->OfferCodes_model->create($data);

                $this->session->set_flashdata('message', 'Add new Offer Code was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }
        }else{
            $this->session->set_flashdata('message', 'Please enter Offer Code');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('admin/offer_codes');
    }

    public function edit_offer_code($offer_id) 
    {
        $this->load->model('OfferCodes_model');

        $offerCodes = $this->OfferCodes_model->getById($offer_id);

        if( $offerCodes ){
            $this->page_data['offerCodes'] = $offerCodes;
            $this->load->view('admin/offer_codes/edit_offer_code', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('admin/offer_codes');
        }
    }

    public function update_offer_code() 
    {
        $this->load->model('OfferCodes_model');

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $offerCodes = $this->OfferCodes_model->getById($post['offer_id']);

        if( $offerCodes ){
            if( $post['offer_id'] != '' ){
                $data = [
                    'offer_code' => $post['offer_code'],
                    'trial_days' => $post['trial_days'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                $offerCodes = $this->OfferCodes_model->updateOfferCodes($post['offer_id'],$data);

                $this->session->set_flashdata('message', 'Offer code was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Please enter Offer code');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

            redirect('admin/edit_offer_code/'.$post['offer_id']);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('admin/offer_codes');
        }
    }

    public function delete_offer_code()
    {
        $this->load->model('OfferCodes_model');

        $post = $this->input->post();

        $id = $this->OfferCodes_model->deleteOfferCodes(post('offer_code_id'));

        $this->session->set_flashdata('message', 'Offer Code has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('admin/offer_codes');
    }

    public function companies()
    {
        $this->load->model('Clients_model');

        $cid_search = 'All Companies';
        if( get('status') != '' ){
            if( get('status') == 'expired' ){
                $cid_search = 'Status : Expired';
                $status = 0;
            }elseif( get('status') == 'deactivated' ){
                $cid_search = 'Status : Deactivated';
                $status = 3;
            }else{
                $cid_search = 'Status : Active';
                $status = 1;
            }

            $companies = $this->Clients_model->getAllByStatus($status);
        }else{
            $companies = $this->Clients_model->getAll();
        }

        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['companies'] = $companies;
        $this->page_data['page_title'] = 'Companies';
        $this->page_data['page_parent'] = 'Companies';
        $this->load->view('admin/companies/list', $this->page_data);
    }

    public function events() 
    {
        $this->load->model('Event_model');
        $this->page_data['events'] = $this->Event_model->admin_get_all_events();
        $this->page_data['title'] = 'Events';
        $this->load->view('admin/events/list', $this->page_data);
    }

    public function new_event($id=null) 
    {
        $this->load->model('Event_model', 'event_model');
        $this->load->model('General_model', 'general');

        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // check if settings has been set
        $get_event_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'event_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_event_settings);
        // add default event settings if not set
        if(empty($event_settings)){
            $event_settings_data = array(
                'event_prefix' => 'EVENT',
                'event_next_num' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'event_settings');
        }

        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);


        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'table' => 'event_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);
        //echo logged('company_id');

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'event_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);

        // get items
        $get_items = array(
            'where' => array(
                'company_id' => logged('company_id'),
                'is_active' => 1,
            ),
            'table' => 'items',
            'select' => 'id,title,price',
        );
        $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        if(!$id==NULL){
            $this->page_data['jobs_data'] = $this->event_model->get_specific_event($id);
            $this->page_data['event_items'] = $this->event_model->get_specific_event_items($id);
            //print_r($this->page_data['jobs_data_items'] );
        }

        $this->load->view('admin/events/event_new', $this->page_data);
    }

    public function event_preview($id=null) 
    {
        $this->load->model('Event_model', 'event_model');
        $this->load->model('General_model', 'general');
        $this->load->helper('functions');

        $comp_id = logged('company_id');
        $user_id = logged('id');
        // get all employees
        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'table' => 'job_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);
        //echo logged('company_id');

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_job_types = array(
            'table' => 'job_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);

        echo logged('company_id');

        // get items
        $get_items = array(
            'where' => array(
                'company_id' => logged('company_id'),
                'is_active' => 1,
            ),
            'table' => 'items',
            'select' => 'id,title,price',
        );
        $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        // get estimates
        $get_estimates = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'estimates',
            'select' => 'id,estimate_number,estimate_date,job_name,customer_id',
        );
        $this->page_data['estimates'] = $this->general->get_data_with_param($get_estimates);

        // get workorder
        $get_workorder = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'work_orders',
            'select' => 'id,work_order_number,start_date,job_name,customer_id',
        );
        $this->page_data['workorders'] = $this->general->get_data_with_param($get_workorder);

        // get invoices
        $get_invoices = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'invoices',
            'select' => 'id,invoice_number,date_issued,job_name,customer_id',
        );
        $this->page_data['invoices'] = $this->general->get_data_with_param($get_invoices);
        if($id!=NULL){
            $this->page_data['jobs_data'] = $this->event_model->get_specific_event($id);
            $this->page_data['event_items'] = $this->event_model->get_specific_event_items($id);
            print_r($this->page_data['event_items']);
        }
        $this->load->view('admin/events/event_preview', $this->page_data);
    }

    public function loadStreetView($address = null)
    {
        $this->load->library('wizardlib');
        $addr = ($address==null?post('address'):$address);
        return $this->wizardlib->getStreetView($addr);
    }

    public function delete_event() 
    {
        $this->load->model('General_model', 'general');
        
        $remove_event = array(
            'where' => array(
                'id' => $_POST['job_id']
            ),
            'table' => 'events'
        );
        if($this->general->delete_($remove_event)){
            echo '1';
        }
    }

    public function pay_scale()
    {   
        $this->load->model('PayScale_model');
        $this->load->model('Clients_model');

        $this->page_data['companies'] = $this->Clients_model->getAll();
        $this->page_data['payscale'] = $this->PayScale_model->getAll();
        $this->load->view('admin/payscale/list', $this->page_data);
    }

    public function ajax_add_payscale()
    {
        $this->load->model('PayScale_model');

        $payscale_name = $this->input->post('payscale_name');
        $company_id    = $this->input->post('company_id');
        $data = array(
            'payscale_name' => $payscale_name,
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );
        $query = $this->PayScale_model->create($data);

        $json_data = ['is_success' => true, 'msg' => ''];

        echo json_encode($json_data);
    }

    public function ajax_edit_payscale()
    {
        $this->load->model('PayScale_model');
        $this->load->model('Clients_model');

        $pid = $this->input->post('pid');
        $payscale = $this->PayScale_model->getById($pid);

        $this->page_data['companies'] = $this->Clients_model->getAll();
        $this->page_data['payscale'] = $payscale;
        $this->load->view('admin/payscale/modal_edit_form', $this->page_data);
    }

    public function ajax_update_payscale()
    {
        $this->load->model('PayScale_model');

        $is_success = false;
        $msg = "";

        $payscale_name = $this->input->post('payscale_name');
        $company_id    = $this->input->post('company_id');
        $pid = $this->input->post('pid');

        $data = array(
            'company_id' => $company_id,
            'payscale_name' => $payscale_name,
            'date_updated' => date("Y-m-d H:i:s")
        );

        $payscale = $this->PayScale_model->update($pid,$data);

        $is_success = true;

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_payscale()
    {
        $this->load->model('PayScale_model');

        $is_success = false;
        $msg = "";

        $post = $this->input->post();
        $id = $this->PayScale_model->deletePayScale($post['pid']);

        $is_success = true;

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function job()
    {   
        $this->load->model('Jobs_model', 'jobs_model');

        $this->page_data['jobs'] = $this->jobs_model->admin_get_all_jobs();
        $this->page_data['title'] = 'Jobs';
        $this->load->view('admin/job/list', $this->page_data);
    }

    public function update_plan_status()
    {
        $this->load->model('NsmartPlan_model');

        $post = $this->input->post();
        $data = [
            'status' => $post['plan_status'],
            'date_updated' => date("Y-m-d H:i:s")
        ];
        $nsPlan = $this->NsmartPlan_model->updatePlan($post['plan_id'],$data);

        $this->session->set_flashdata('message', 'Plan was successfully updated');
        $this->session->set_flashdata('alert_class', 'alert-success');
        
        redirect('admin/nsmart_plans');
    }

    public function save_company_deactivated_module()
    {
        $this->load->model('CompanyDeactivatedModule_model');

        $post = $this->input->post();
        
        if( $post['is_activated'] == 1 ){
            $isModuleExist = $this->CompanyDeactivatedModule_model->getByCompanyIdAndIndustryModuleId($post['company_id'], $post['module_id']);
            if( $isModuleExist ){
                $this->CompanyDeactivatedModule_model->delete($isModuleExist->id);
            }
        }else{
            $data = [
                'company_id' => $post['company_id'],
                'industry_module_id' => $post['module_id']
            ];

            $result = $this->CompanyDeactivatedModule_model->save($data);
        }
        

        $json_data = ['is_success' => 1];

        echo json_encode($json_data);
    }

    public function export_users_list()
    {
        $this->load->model('users_model');
        $this->load->model('roles_model');
        
        $users   = $this->users_model->getAllUsers();

        $delimiter = ",";
        $time      = time();
        $filename  = "users_list_".$time.".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Company Name', 'Last Name', 'First Name', 'Role', 'Title', 'Email', 'Phone', 'Mobile', 'Address', 'City', 'State');
        fputcsv($f, $fields, $delimiter);

        if (!empty($users)) {
            foreach ($users as $u) {
                $csvData = array(
                    $u->business_name,
                    $u->LName,
                    $u->FName,
                    getUserType($u->user_type),
                    ucfirst($this->roles_model->getById($u->role)->title),
                    $u->email,
                    $u->phone,
                    $u->mobile,
                    $u->address,
                    $u->city,
                    $u->state
                );
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function export_company_list()
    {
        $this->load->model('Business_model');
        $this->load->model('Clients_model');
        
        $clients   = $this->Clients_model->getAll();

        $delimiter = ",";
        $time      = time();
        $filename  = "company_list_".$time.".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Company Name', 'Contact Name', 'Industry', 'Plan', 'Number of License', 'Status');
        fputcsv($f, $fields, $delimiter);

        if (!empty($clients)) {
            foreach ($clients as $c) {
                if($c->bp_business_name != ''){
                    $status = "-";
                    if( $c->is_plan_active == 1 ){
                        $status = "Active";
                    }elseif( $c->is_plan_active == 3 ){
                        $status = "Deactivated";
                    }else{
                        $status = "Expire";
                    }

                    if( $c->bp_contact_name != '' ){
                        $contact_name = $c->bp_contact_name;
                    }else{
                        $contact_name = "---";
                    }

                    $plan = $c->plan_name.' / '.$c->price;

                    $csvData = array(
                        $c->bp_business_name,
                        $contact_name,
                        $c->industry_type_name,
                        $plan,
                        $c->number_of_license,
                        $status
                    );
                    fputcsv($f, $csvData, $delimiter);
                }                
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function ajax_switch_to_company_user()
    {
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');
        $this->load->model('CompanyDeactivatedModule_model');


        $is_valid = 0;
        $msg      = 'Invalid account type';

        $uid  = adminLogged('id');
        $user = $this->Users_model->getUserByID($uid);
        $data = ['username' => $user->username, 'password' => $user->password_plain];
        $attempt = $this->Users_model->attempt($data);

        if ($attempt == 'valid') {
            $this->Users_model->login($user);

            $client = $this->Clients_model->getById($user->company_id);
            // Get all access modules
            if ($user->role == 1 || $user->role == 2) { //Admin and nsmart tech
                $access_modules = array(0 => 'all');
            } else {                
                if ($client) {
                    $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                    if ($industryType) {
                        $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->industry_template_id);
                        foreach ($industryModules as $im) {
                            $access_modules[] = $im->industry_module_id;
                        }
                    }
                }
            }

            //Get company deactivated modules
            $deactivatedModules  = $this->CompanyDeactivatedModule_model->getAllByCompanyId($client->id);
            $deactivated_modules = array();

            foreach( $deactivatedModules as $dm ){
                $deactivated_modules[$dm->industry_module_id] = $dm->industry_module_id;
            } 

            $this->session->set_userdata('deactivated_modules', $deactivated_modules);
            $this->session->set_userdata('userAccessModules', $access_modules);
            $this->session->set_userdata('is_plan_active', $client->is_plan_active);      

            $this->load->model('Activity_model', 'activity');
            $activity['activityName'] = "Admin User Logout";
            $activity['activity'] = " User ".logged('username')." is logged out";
            $activity['user_id'] = adminLogged('id');
            $this->activity->addEsignActivity($activity);

            $this->activity_model->add("User: ".getLoggedFullName(logged('id')).' Admin Logged Out'); 
            $this->users_model->admin_logout();

            $is_valid = 1;    
            $msg = '';  

            $this->session->unset_userdata('admin_bypass');
        }

        $json_data = ['is_valid' => $is_valid, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajaxLoginCompanyUser()
    {
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');
        $this->load->model('CompanyDeactivatedModule_model');
        $this->load->model('Customer_advance_model');

        $is_valid = 0;
        $msg      = 'Invalid account';
        $redirect_url = '';

        $post = $this->input->post();

        $uid  = $post['uid'];
        $user = $this->Users_model->getUserByID($uid);
        $data = ['username' => $user->username, 'password' => $user->password_plain];
        $attempt = $this->Users_model->attempt($data, true);

        if ($attempt == 'valid') {
            $this->users_model->login($user);

            $client = $this->Clients_model->getById($user->company_id);
            if( $client->is_plan_active == 3 ){
                $msg = 'Company account is currently disabled. Cannot login.';                
            }else{
                // Get all access modules
                if ($user->role == 1 || $user->role == 2) { //Admin and nsmart tech
                    $access_modules = array(0 => 'all');
                } else {                
                    if ($client) {
                        $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                        if ($industryType) {
                            $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->industry_template_id);
                            foreach ($industryModules as $im) {
                                $access_modules[] = $im->industry_module_id;
                            }
                        }
                    }
                }

                //Get company deactivated modules
                $deactivatedModules  = $this->CompanyDeactivatedModule_model->getAllByCompanyId($client->id);
                $deactivated_modules = array();

                foreach( $deactivatedModules as $dm ){
                    $deactivated_modules[$dm->industry_module_id] = $dm->industry_module_id;
                } 

                $this->session->set_userdata('deactivated_modules', $deactivated_modules);
                $this->session->set_userdata('userAccessModules', $access_modules);
                $this->session->set_userdata('is_plan_active', $client->is_plan_active);

                 $is_valid = 1;
                 $msg = '';

                 $this->session->set_userdata('admin_bypass', true);
            }

            /*$this->load->model('Activity_model', 'activity');
            $activity['activityName'] = "User Login";
            $activity['activity'] = " User " . logged('username') . " is loggedin";
            $activity['user_id'] = logged('id');

            $isUserInserted = $this->activity->addEsignActivity($activity);*/

            if( $client->is_plan_active == 1 ){
                $billingErrors = $this->Customer_advance_model->get_customer_billing_errors($client->id);
                if( $billingErrors ){
                   $redirect_url = base_url('customer/billing_errors');
                }else{
                   $redirect_url = base_url('dashboard');
                }      
            }else{
                if( $client->id == 1 ){
                    $redirect_url = base_url('dashboard');
                }else{
                    $exempted_company_ids = exempted_company_ids();
                    if( !in_array($client->id, $exempted_company_ids) ){
                        $redirect_url = base_url('mycrm/renew_plan');  
                    }else{
                        $redirect_url = base_url('dashboard');
                    }
                    
                }
            }
        }

        $json_data = ['is_valid' => $is_valid, 'msg' => $msg, 'redirect_url' => $redirect_url];
        echo json_encode($json_data);
    }
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
