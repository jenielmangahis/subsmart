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

        $cid_search = 'All nSmart Plans';
        $search = '';

        if( get('status') != '' ){
            if( get('status') == 'active' ){
                $cid_search = 'Status Active';
                $status = 1;
            }else{
                $cid_search = 'Status Inactive';
                $status = 0;
            }

            $nSmartPlans = $this->NsmartPlan_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $nSmartPlans = $this->NsmartPlan_model->getAll($filters);
        }else{
            $nSmartPlans   = $this->NsmartPlan_model->getAll();            
        }

        $option_status = $this->NsmartPlan_model->getPlanStatus();
        $option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

        $this->page_data['option_status'] = $option_status;
        $this->page_data['option_discount_types'] = $option_discount_types;
        $this->page_data['nSmartPlans'] = $nSmartPlans;

        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['page_title'] = 'nSmart Plans';
        $this->page_data['page_parent'] = 'nSmart Plans';

        $this->load->view('admin/nsmart_plans/list', $this->page_data);
    }

    public function ajaxSaveNsmartPlan(){
        $this->load->model('NsmartPlan_model');

        $is_success = 0;
        $msg = '';

        $post = $this->input->post();

        if( $post['plan_name'] != '' ){
            if( $this->NsmartPlan_model->isPlanNameExists($post['plan_name']) ){
                $msg = 'Plan name already exists';                
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

                $this->NsmartPlan_model->create($data);

                $is_success = 1;
                $msg = '';      
            }
        }else{
            $msg = 'Please enter plan name';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxUpdateNsmartPlan(){
        $this->load->model('NsmartPlan_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $nSmartPlan = $this->NsmartPlan_model->getById($post['nspid']);

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

                $this->NsmartPlan_model->updatePlan($post['nspid'],$data);

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Please enter plan name';                
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteNsmartPlan(){
        $this->load->model('NsmartPlan_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $nsmartPlan = $this->NsmartPlan_model->getById($post['nspid']);
        if( $nsmartPlan ){
            $this->NsmartPlan_model->deletePlan(post('nspid'));

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_edit_nsmart_plan(){
        $this->load->model('NsmartPlan_model');

        $post = $this->input->post();
        $nSmartPlan = $this->NsmartPlan_model->getById($post['nspid']);

        $option_status = $this->NsmartPlan_model->getPlanStatus();
        $option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

        $this->page_data['nSmartPlan'] = $nSmartPlan;
        $this->page_data['option_status'] = $option_status;
        $this->page_data['option_discount_types'] = $option_discount_types;
        $this->load->view('admin/nsmart_plans/ajax_edit_nsmart_plan', $this->page_data);
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

        $search = '';
        $cid_search = 'All Addons';

        if( get('status') != '' ){
            if( get('status') == 'active' ){
                $cid_search = 'Status Active';
                $status = 1;
            }else{
                $cid_search = 'Status Inactive';
                $status = 0;
            }

            $nSmartAddons = $this->NsmartAddons_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $nSmartAddons = $this->NsmartAddons_model->getAll($filters);
        }else{
            $nSmartAddons   = $this->NsmartAddons_model->getAll();
        }
        
        $this->page_data['nSmartAddons'] = $nSmartAddons;
        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['page_title'] = 'Settings : Addons';
        $this->page_data['page_parent'] = 'Settings';
        $this->load->view('admin/nsmart_addons/list', $this->page_data);
    }

    public function ajaxSaveAddon() {
        $this->load->model('NsmartAddons_model');

        $is_success = 0;
        $msg = '';

        $post = $this->input->post();
        
        if( $post['addon_name'] != '' ){
            if( $this->NsmartAddons_model->isAddonNameExists($post['addon_name']) ){
                $msg = 'Addon name already exists';
            }else{
                $data = [
                    'name' => $post['addon_name'],
                    'description' => $post['addon_description'],
                    'price' => $post['addon_price'],
                    'status' => $post['addon_status'],
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $this->NsmartAddons_model->create($data);

                $is_success = 1;
                $msg = '';
            }
        }else{
            $msg = 'Please enter addon name';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_edit_addon()
    {
        $this->load->model('NsmartAddons_model');

        $post = $this->input->post();

        $addon = $this->NsmartAddons_model->getById($post['aid']);

        $this->page_data['addon'] = $addon;
        $this->load->view('admin/nsmart_addons/ajax_edit_addon', $this->page_data);
    }

    public function ajaxUpdateAddon() {
        $this->load->model('NsmartAddons_model');

        $post = $this->input->post();

        $is_success = 0;
        $msg = 'Cannot find data';

        $nSmartAddon = $this->NsmartAddons_model->getById($post['aid']);

        if( $nSmartAddon ){
            if( $post['addon_name'] != '' ){
                $data = [
                    'name' => $post['addon_name'],
                    'description' => $post['addon_description'],
                    'price' => $post['addon_price'],
                    'status' => $post['addon_status'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $nsAddon = $this->NsmartAddons_model->updateAddon($post['aid'],$data);

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Please enter addon name';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteAddon(){
        $this->load->model('NsmartAddons_model');
        
        $post = $this->input->post();

        $is_success = 0;
        $msg = 'Cannot find data';

        $addon = $this->NsmartAddons_model->getById($post['aid']);
        if( $addon ){
            $this->NsmartAddons_model->deleteAddon($post['aid']);

            $is_success = 1;
            $msg = '';            
        }
        
        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
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

        $cid_search = 'All Industry Modules';
        $search = '';
        if( get('status') != '' ){
            if( get('status') == 'active' ){
                $cid_search = 'Status Active';
                $status = 1;
            }else{
                $cid_search = 'Status Inactive';
                $status = 0;
            }

            $industryModules = $this->IndustryModules_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $industryModules = $this->IndustryModules_model->getAll($filters);
        }else{
            $industryModules   = $this->IndustryModules_model->getAll();
        }
            
        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['industryModules'] = $industryModules;
        $this->page_data['page_title'] = 'Settings : Industry Modules';
        $this->page_data['page_parent'] = 'Settings';
        $this->load->view('admin/industry_modules/list', $this->page_data);
    }

    public function ajax_edit_industry_module()
    {
        $this->load->model('IndustryModules_model');

        $post = $this->input->post();

        $industryModule = $this->IndustryModules_model->getById($post['mid']);

        $this->page_data['industryModule'] = $industryModule;
        $this->load->view('admin/industry_modules/ajax_edit_industry_module', $this->page_data);
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

    public function industry_templates() 
    {
        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryModules_model');

        $cid_search = 'All Industry Templates';
        $search = '';
        if( get('status') != '' ){
            if( get('status') == 'active' ){
                $cid_search = 'Status Active';
                $status = 1;
            }else{
                $cid_search = 'Status Inactive';
                $status = 0;
            }

            $industryTemplate = $this->IndustryTemplate_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $industryTemplate   = $this->IndustryTemplate_model->getAll($filters);
        }else{
            $industryTemplate   = $this->IndustryTemplate_model->getAll();
        }
        
        $industryModules = $this->IndustryModules_model->getAll();

        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['industryModules'] = $industryModules;
        $this->page_data['industryTemplate'] = $industryTemplate;
        $this->page_data['page_title'] = 'Settings : Industry Templates';
        $this->page_data['page_parent'] = 'Settings';
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

    public function industry_types() 
    {
        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryType_model');

        $cid_search = 'All Industry Types';
        $search = '';
        if( get('status') != '' ){
            if( get('status') == 'active' ){
                $cid_search = 'Status Active';
                $status = 1;
            }else{
                $cid_search = 'Status Inactive';
                $status = 0;
            }

            $industryTypes = $this->IndustryModules_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $industryTypes   = $this->IndustryType_model->getAll($filters);                    
        }else{
            $industryTypes   = $this->IndustryType_model->getAll();        
        }
        
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
        $industryTemplate   = $this->IndustryTemplate_model->getAll();

        $this->page_data['businessTypes'] = $businessTypes;          
        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['industryTypes']    = $industryTypes;
        $this->page_data['industryTemplate'] = $industryTemplate;
        $this->page_data['page_title'] = 'Settings : Industry Types';
        $this->page_data['page_parent'] = 'Settings';
        $this->load->view('admin/industry_type/list', $this->page_data);
    }

    public function ajaxSaveIndustryType() 
    {
        $this->load->model('IndustryType_model');

        $is_success = 0;
        $msg = '';

        $post = $this->input->post();

        if( $post['industry_type_name'] != '' ){
            if( $this->IndustryType_model->getByName($post['industry_type_name']) ){
                $msg = 'Industry type name already exists';                
            }else{
                $data = [
                    'name' => $post['industry_type_name'],
                    'business_type_name' => $post['business_type_name'],
                    'industry_template_id' => $post['industry_template_id'],
                    'status' => $post['status'],
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $industryType = $this->IndustryType_model->create($data);


                $is_success = 1;
                $msg = '';                
            }
        }else{
            $msg = 'Please enter industry type name';            
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_edit_industry_type()
    {
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplate_model');

        $post = $this->input->post();

        $industryType = $this->IndustryType_model->getById($post['tid']);
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

        $this->page_data['businessTypes'] = $businessTypes;
        $this->page_data['industryType']  = $industryType;
        $this->page_data['industryTemplate'] = $industryTemplate;
        $this->load->view('admin/industry_type/ajax_edit_industry_type', $this->page_data);
    }

    public function ajaxUpdateIndustryType() 
    {
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplate_model');

        $post = $this->input->post();

        $is_success = 0;
        $msg = 'Cannot find data';

        $industryTemplate = $this->IndustryType_model->getById($post['tid']);

        if( $industryTemplate ){
            if( $post['industry_type_name'] != '' ){
                $data = [
                    'name' => $post['industry_type_name'],
                    'business_type_name' => $post['business_type_name'],
                    'industry_template_id' => $post['industry_template_id'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                
                $industryTemplateUpdate = $this->IndustryType_model->updateIndustryType($post['tid'],$data);

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Please enter industry type name';                
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteIndustryType()
    {
        $this->load->model('IndustryType_model');

        $post = $this->input->post();

        $is_success = 0;
        $msg = 'Cannot find data';

        $industryType = $this->IndustryType_model->getById($post['tid']);
        if( $industryType ){

            $this->IndustryType_model->deleteIndustryType($post['tid']);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
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
        $sid  = $post['cid'];

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

        $search = '';
        $cid_search = 'All Offer Codes';

        if( get('status') != '' ){
            if( get('status') == 'used' ){
                $cid_search = 'Status Used';
                $status = 1;
            }else{
                $cid_search = 'Status Unused';
                $status = 0;
            }

            $offerCodes = $this->OfferCodes_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $offerCodes = $this->OfferCodes_model->getAll($filters);
        }else{
            $offerCodes   = $this->OfferCodes_model->getAll();
        }
        
        $this->page_data['offerCodes'] = $offerCodes;
        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['page_title'] = 'Offer Codes';
        $this->page_data['page_parent'] = 'Offer Codes';
        $this->load->view('admin/offer_codes/list', $this->page_data);
    }

    public function ajaxSaveOfferCode() 
    {
        $this->load->model('OfferCodes_model');

        $is_success = 0;
        $msg = '';

        $post = $this->input->post();

        if( $post['offer_code'] != '' ){
            if( $this->OfferCodes_model->getByOfferCodes($post['offer_code']) ){
                $msg = 'Offer Code already exists';                
            }else{
                $data = [
                    'offer_code' => $post['offer_code'],
                    'trial_days' => $post['trial_days'],
                    'status' => 0,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $this->OfferCodes_model->create($data);

                $msg = '';
                $is_success = 1;
            }
        }else{
            $msg = 'Please enter Offer Code';            
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_edit_offer_code() 
    {
        $this->load->model('OfferCodes_model');

        $post = $this->input->post();
        $offerCode = $this->OfferCodes_model->getById($post['oid']);

        if( $offerCode ){
            $this->page_data['offerCode'] = $offerCode;
            $this->load->view('admin/offer_codes/ajax_edit_offer_code', $this->page_data);
        }
    }

    public function ajaxUpdateOfferCode() 
    {
        $this->load->model('OfferCodes_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $offerCode = $this->OfferCodes_model->getById($post['oid']);

        if( $offerCode ){
            if( $post['offer_code'] != '' ){
                $data = [
                    'offer_code' => $post['offer_code'],
                    'trial_days' => $post['trial_days'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                
                $this->OfferCodes_model->updateOfferCodes($post['oid'],$data);

                $msg = '';
                $is_success = 1;

            }else{
                $msg = 'Please enter Offer code';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteOfferCode()
    {
        $this->load->model('OfferCodes_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $offerCode = $this->OfferCodes_model->getById($post['oid']);
        if( $offerCode ){
            $this->OfferCodes_model->deleteOfferCodes(post('oid'));

            $msg = '';
            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
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
        $search = '';
        if( get('status') != '' ){
            if( get('status') == 'expired' ){
                $cid_search = 'Status Expired';
                $status = 0;
            }elseif( get('status') == 'deactivated' ){
                $cid_search = 'Status Deactivated';
                $status = 3;
            }else{
                $cid_search = 'Status Active';
                $status = 1;
            }

            $companies = $this->Clients_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $companies = $this->Clients_model->getAll($filters);
        }else{
            $companies = $this->Clients_model->getAll();
        }

        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['companies'] = $companies;
        $this->page_data['page_title'] = 'Companies';
        $this->page_data['page_parent'] = 'Companies';
        $this->load->view('admin/companies/list', $this->page_data);
    }

    public function events() 
    {
        $this->load->model('Event_model');

        $cid_search = 'All Events';
        $search = '';
        if( get('status') != '' ){
            $cid_search = ucwords(get('status'));
            $status = ucwords(get('status'));
            $events = $this->Event_model->getAllByStatus($status);
        }elseif( get('search') != '' ){
            $search  = trim(get('search'));
            $filters = ['search' => $search];
            $events = $this->Event_model->getAllEventsAdmin($filters);
        }else{
            $events   = $this->Event_model->getAllEventsAdmin();
        }

        $this->page_data['search'] = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['events'] = $events;
        $this->page_data['page_title'] = 'Events';
        $this->page_data['page_parent'] = 'Events';
        $this->load->view('admin/events/list', $this->page_data);
    }

    public function export_events()
    {
        $this->load->model('Event_model');

        $events   = $this->Event_model->getAllEventsAdmin();

        $delimiter = ",";
        $time      = time();
        $filename  = "events_list_".$time.".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Company Name', 'Event Number', 'Customer Name', 'Start Date', 'End Date', 'Event Address', 'Event Type', 'Event Tags', 'Status');
        fputcsv($f, $fields, $delimiter);

        if (!empty($events)) {
            foreach ($events as $event) {
                $csvData = array(
                    $event->business_name,
                    $event->event_number,
                    $event->first_name . ' ' . $event->last_name,
                    date('F g, Y g:i A',strtotime($event->start_date . ' ' .  $event->start_time)),
                    date('F g, Y g:i A',strtotime($event->end_date . ' ' .  $event->end_time)),
                    $event->event_address . ' ' . $event->event_zip_code,
                    $event->event_type,
                    $event->event_tag,
                    $event->status
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

    public function ajax_view_event()
    {
        $this->load->model('Event_model');
        $this->load->model('Business_model');
        $this->load->helper('functions');

        $post = $this->input->post();

        $get_company_info = array(
            'where' => array(
                'company_id' => $post['eid'],
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name,business_image',
        );

        $event = $this->Event_model->get_specific_event($post['eid']);
        $company_info = $this->Business_model->getByCompanyId($event->company_id);
        /*echo "<pre>";
        print_r($company_info);
        exit;*/
        $event_items  = $this->Event_model->get_specific_event_items($post['eid']);

        $this->page_data['event'] = $event;
        $this->page_data['company_info'] = $company_info;        
        $this->page_data['event_items']  = $event_items;
        $this->load->view('admin/events/ajax_view_event', $this->page_data);
    }

    public function ajaxDeleteEvent()
    {
        $this->load->model('General_model', 'general');

        $post = $this->input->post();
        
        $remove_event = array(
            'where' => array(
                'id' => $post['eid']
            ),
            'table' => 'events'
        );
        $this->general->delete_($remove_event);

        $remove_event_items = array(
            'where' => array(
                'event_id' => $post['eid']
            ),
            'table' => 'event_items'
        );
        $this->general->delete_($remove_event_items);

        $json_data = [
            'is_success' => 1,
            'msg' => ''
        ];

        echo json_encode($json_data);
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

    public function ajaxSaveIndustryModule()
    {
        $this->load->model('IndustryModules_model');

        $is_success = 0;
        $msg = '';

        $post = $this->input->post();

        if( $post['module_name'] != '' ){
            if( $this->IndustryModules_model->getByName($post['module_name']) ){
                $msg = 'Module name already exists';                
            }else{
                $data = [
                    'name' => $post['module_name'],
                    'description' => $post['module_description'],
                    'status' => 1,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $industry_modules = $this->IndustryModules_model->create($data);

                $is_success = 1;
                $msg = '';
            }
        }else{
            $msg = 'Please enter module name';            
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxUpdateIndustryModule()
    {
        $this->load->model('IndustryModules_model');
        
        $post = $this->input->post();

        $is_success = 0;
        $msg = '';

        $industryModule = $this->IndustryModules_model->getById($post['mid']);

        if( $industryModule ){
            if( $post['module_name'] != '' ){
                $data = [
                    'name' => $post['module_name'],
                    'description' => $post['module_description'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                $industryModulesUpdate = $this->IndustryModules_model->update($post['mid'],$data);

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Please enter module name';  
            }

        }else{
            $msg = 'Cannot find data';  
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteIndustryModule()
    {
        $this->load->model('IndustryModules_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();        

        $industryModule = $this->IndustryModules_model->getById($post['mid']);
        if( $industryModule ){
            $this->IndustryModules_model->deleteIndustryModules($post['mid']);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajaxSaveIndustryTemplate() 
    {
        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryTemplateModules_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();        

        if( $post['template_name'] != '' ){
            if( $this->IndustryTemplate_model->getByName($post['template_name']) ){
                $msg = 'Template name already exists';
            }else{
                $data = [
                    'name' => $post['template_name'],
                    'status' => $post['status'],
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $industryTemplateId = $this->IndustryTemplate_model->create($data);

                if(is_array($post['modules'])){
                    foreach ($post['modules'] as $key => $module_id) {
                        $data = [
                            'industry_template_id' => $industryTemplateId,
                            'industry_module_id ' => $module_id,
                            'status' => 1,   
                            'date_created' => date("Y-m-d H:i:s"),
                            'date_modified' => date("Y-m-d H:i:s")
                        ];
                        $industryTemplateModules = $this->IndustryTemplateModules_model->create($data);
                    }   
                }

                $is_success = 1;
                $msg = '';
            }
        }else{
            $msg = 'Please enter template name';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_edit_industry_template()
    {
        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryModules_model');
        $this->load->model('IndustryTemplateModules_model');


        $post = $this->input->post();

        $industryTemplate = $this->IndustryTemplate_model->getById($post['tid']);
        $industryTemplateModules = $this->IndustryTemplateModules_model->getAllByTemplateId($post['tid']);
        $industryModules = $this->IndustryModules_model->getAll();

        $this->page_data['industryTemplate'] = $industryTemplate;
        $this->page_data['industryModules']  = $industryModules;
        $this->page_data['industryTemplateModules'] = $industryTemplateModules;
        $this->load->view('admin/industry_template/ajax_edit_industry_template', $this->page_data);
    }

    public function ajaxUpdateIndustryTemplate() 
    {
        $this->load->model('IndustryTemplate_model');
        $this->load->model('IndustryTemplateModules_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();      

        $industryTemplate = $this->IndustryTemplate_model->getById($post['tid']);

        if( $industryTemplate ){
            if( $post['template_name'] != '' ){
                $data = [
                    'name' => $post['template_name'],
                    'status' => $post['status'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
                $industryTemplateUpdate = $this->IndustryTemplate_model->updateIndustryTemplate($post['tid'],$data);

                if(is_array($post['modules'])){
                    $this->IndustryTemplateModules_model->deleteIndustryTemplateModulesByTemplateId($industryTemplate->id);
                    foreach ($post['modules'] as $key => $module_id) {
                        $data = [
                            'industry_template_id' => $industryTemplate->id,
                            'industry_module_id ' => $module_id,
                            'status' => 1,   
                            'date_created' => date("Y-m-d H:i:s"),
                            'date_modified' => date("Y-m-d H:i:s")
                        ];
                        $industryTemplateModules = $this->IndustryTemplateModules_model->create($data);
                    }   
                }

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Please enter template name';
            }            
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajaxDeleteIndustryTemplate()
    {
        $this->load->model('IndustryTemplate_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();        

        $industryTemplate = $this->IndustryTemplate_model->getById($post['tid']);
        if( $industryTemplate ){
            $this->IndustryTemplate_model->deleteIndustryTemplate($post['tid']);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
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

    public function event_types()
    {
        $this->load->model('EventType_model');
        $this->load->model('Business_model');

        $search = '';
        if( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $eventTypes = $this->EventType_model->getAll($filters);
        }else{
            $eventTypes = $this->EventType_model->getAll();
        }
            
        $this->page_data['search'] = $search;
        $this->page_data['eventTypes']  = $eventTypes;
        $this->page_data['companies']   = $this->Business_model->getAll();
        $this->page_data['page_title']  = 'Event Types';
        $this->page_data['page_parent'] = 'Events';
        $this->load->view('admin/event_types/list', $this->page_data);
    }

    public function ajaxSaveEventType()
    {
        $this->load->model('EventType_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $post = $this->input->post();

        if( $post['event_name'] != ''){
            $marker_icon = $this->eventTypeMoveUploadedFile($post['company_id']);
            $data_event_type = [
                'company_id' => $post['company_id'],
                'user_id' => 0,
                'title' => $post['event_name'],
                'icon_marker' => $marker_icon,
                'is_marker_icon_default_list' => 0,
                'created' => date("Y-m-d H:i:s"),
                'modified' => date("Y-m-d H:i:s")
            ];

            $this->EventType_model->create($data_event_type);

            $msg = '';
            $is_success = 1;

        }else{
            $msg = 'Please specify event type name';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function eventTypeMoveUploadedFile( $company_id ) {
        if(isset($_FILES['image_marker']) && $_FILES['image_marker']['tmp_name'] != '') {
            $target_dir = "./uploads/event_types/" . $company_id . "/"; 
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['image_marker']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['image_marker']['name'])));
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = trim(basename($_FILES["image_marker"]["name"]));
            move_uploaded_file($tmp_name, $target_dir . $name);

            return $name;
        }
    }

    public function ajaxDeleteEventType()
    {
        $this->load->model('EventType_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $eventType = $this->EventType_model->getById($post['eid']);
        if( $eventType ){
            $this->EventType_model->deleteById($post['eid']);

            $msg = '';
            $is_success = 1;
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function event_icons()
    {
        $this->load->model('Icons_model');
        
        $search = '';
        if( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $icons = $this->Icons_model->getAll($filters);
        }else{
            $icons   = $this->Icons_model->getAll();
        }
            
        $this->page_data['search'] = $search;
        $this->page_data['icons']  = $icons;
        $this->page_data['page_title'] = 'Settings : Event Icons';
        $this->page_data['page_parent'] = 'Settings';
        $this->load->view('admin/event_icons/list', $this->page_data);
    }

    public function ajaxSaveEventIcon()
    {
        $this->load->model('Icons_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $post = $this->input->post();

        if( $post['icon_name'] != ''){
            $marker_icon = $this->eventIconMoveUploadedFile();
            $data_event_icon = [
                'name' => $post['icon_name'],
                'image' => $marker_icon
            ];

            $this->Icons_model->create($data_event_icon);

            $msg = '';
            $is_success = 1;

        }else{
            $msg = 'Please specify event type name';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function eventIconMoveUploadedFile() 
    {
        if(isset($_FILES['image_marker']) && $_FILES['image_marker']['tmp_name'] != '') {
            $target_dir = "./uploads/icons/"; 
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['image_marker']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['image_marker']['name'])));
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = trim(basename($_FILES["image_marker"]["name"]));
            move_uploaded_file($tmp_name, $target_dir . $name);

            return $name;
        }
    }

    public function ajax_edit_event_icon()
    {
        $this->load->model('Icons_model');

        $post = $this->input->post();

        $eventIcon = $this->Icons_model->getById($post['eiid']);

        $this->page_data['eventIcon'] = $eventIcon;
        $this->load->view('admin/event_icons/ajax_edit_event_icon', $this->page_data);
    }

    public function ajaxUpdateEventIcon()
    {
        $this->load->model('Icons_model');

        $is_success = 0;
        $msg = 'Cannot find data.';

        $post = $this->input->post();

        $eventIcon = $this->Icons_model->getById($post['eiid']);
        if( $eventIcon ){
            if( $post['icon_name'] != ''){
                $marker_icon = $eventIcon->image;
                if(isset($_FILES['image_marker']) && $_FILES['image_marker']['tmp_name'] != '') {
                    $marker_icon = $this->eventIconMoveUploadedFile();
                }
                
                $data_event_icon = [
                    'name' => $post['icon_name'],
                    'image' => $marker_icon
                ];

                $this->Icons_model->update($eventIcon->id, $data_event_icon);

                $msg = '';
                $is_success = 1;

            }else{
                $msg = 'Please specify event type name';
            }
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteEventIcon()
    {
        $this->load->model('Icons_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();   
        $eventIcon = $this->Icons_model->getById($post['eiid']);
        if( $eventIcon ){
            $file = "uploads/icons/" . $eventIcon->image;
            $this->Icons_model->delete($eventIcon->id);

            $is_success = 1;
            $msg = '';

            unlink($file);
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);     
    }

    public function event_tags()
    {
        $this->load->model('EventTags_model');
        $this->load->model('Business_model');
        
        $search = '';
        if( get('search') != '' ){
            $search  = trim(get('search'));
            $filters = ['search' => $search];
            $eventTags = $this->EventTags_model->getAll($filters);
        }else{
            $eventTags = $this->EventTags_model->getAll();
        }
            
        $this->page_data['search'] = $search;
        $this->page_data['eventTags']  = $eventTags;
        $this->page_data['companies']  = $this->Business_model->getAll();
        $this->page_data['page_title'] = 'Event Tags';
        $this->page_data['page_parent'] = 'Events';
        $this->load->view('admin/event_tags/list', $this->page_data);
    }

    public function ajaxSaveEventTag()
    {
        $this->load->model('EventTags_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $post = $this->input->post();

        if( $post['event_tag_name'] != ''){
            $marker_icon = $this->eventTagMoveUploadedFile($post['company_id']);
            $data_event_type = [
                'company_id' => $post['company_id'],
                'name' => $post['event_tag_name'],
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => 0
            ];

            $this->EventTags_model->create($data_event_type);

            $msg = '';
            $is_success = 1;

        }else{
            $msg = 'Please specify event tag name';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function eventTagMoveUploadedFile( $company_id ) {
        if(isset($_FILES['image_marker']) && $_FILES['image_marker']['tmp_name'] != '') {
            $target_dir = "./uploads/event_tags/" . $company_id . "/"; 
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['image_marker']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['image_marker']['name'])));
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = trim(basename($_FILES["image_marker"]["name"]));
            move_uploaded_file($tmp_name, $target_dir . $name);

            return $name;
        }
    }

    public function ajax_edit_event_tag()
    {
        $this->load->model('EventTags_model');
        $this->load->model('Business_model');

        $post = $this->input->post();

        $eventTag = $this->EventTags_model->getById($post['etid']);

        $this->page_data['companies'] = $this->Business_model->getAll();
        $this->page_data['eventTag']  = $eventTag;
        $this->load->view('admin/event_tags/ajax_edit_event_tag', $this->page_data);
    }

    public function ajaxUpdateEventTag()
    {
        $this->load->model('EventTags_model');

        $is_success = 0;
        $msg = 'Cannot find data.';

        $post = $this->input->post();
        $eventTag = $this->EventTags_model->getById($post['etid']);
        if( $eventTag ){
            if( $post['event_tag_name'] != ''){
                $marker_icon = $eventTag->marker_icon;
                if(isset($_FILES['image_marker']) && $_FILES['image_marker']['tmp_name'] != '') {
                    $marker_icon = $this->eventTagMoveUploadedFile($post['company_id']);
                }
                
                $data_event_type = [
                    'company_id' => $post['company_id'],
                    'name' => $post['event_tag_name'],
                    'marker_icon' => $marker_icon
                ];

                $this->EventTags_model->update($eventTag->id, $data_event_type);

                $msg = '';
                $is_success = 1;

            }else{
                $msg = 'Please specify event tag name';
            }
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteEventTag()
    {
        $this->load->model('EventTags_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();   
        $eventTag = $this->EventTags_model->getById($post['etid']);
        if( $eventTag ){
            if( $eventTag->is_marker_icon_default_list == 0 ){
                $file = "uploads/event_tags/" . $eventTag->company_id . "/" . $eventTag->marker_icon;    
                unlink($file);
            }
            
            $this->EventTags_model->delete($eventTag->id);

            $is_success = 1;
            $msg = '';            
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);     
    }

    public function taskhub()
    {
        $this->load->model('Taskhub_model');
        $this->load->model('Business_model');
        $this->load->model('Taskhub_status_model');       

        $search = '';
        $cid_search = 'All Status';
        if( get('status') != '' ){            
            $taskStatus = $this->Taskhub_status_model->getById(get('status'));
            $cid_search = 'Status ' . $taskStatus->status_text;
            $tasksHub = $this->Taskhub_model->getAllByStatusId($taskStatus->status_id);
        }elseif( get('search') != '' ){
            $search  = trim(get('search'));
            $filters = ['search' => $search];
            $tasksHub = $this->Taskhub_model->getAll($filters);
        }else{
            $tasksHub = $this->Taskhub_model->getAll();
        }
            
        $this->page_data['search']  = $search;
        $this->page_data['cid_search'] = $cid_search;
        $this->page_data['taskStatus'] = $this->Taskhub_status_model->get();
        $this->page_data['tasksHub'] = $tasksHub;
        $this->page_data['companies']  = $this->Business_model->getAll();
        $this->page_data['page_title'] = 'Taskhub';
        $this->page_data['page_parent'] = 'Taskhub';
        $this->load->view('admin/taskhub/list', $this->page_data);
    }

    public function ajax_load_taskhub_company_fields()
    {
        $this->load->model('Users_model');
        $this->load->model('AcsProfile_model');

        $post = $this->input->post();

        $companyCustomers = $this->AcsProfile_model->getAllByCompanyId($post['cid']);
        $companyUsers     = $this->Users_model->getCompanyUsers($post['cid']);

        $this->page_data['companyCustomers'] = $companyCustomers;
        $this->page_data['companyUsers'] = $companyUsers;
        $this->load->view('admin/taskhub/ajax_load_taskhub_company_fields', $this->page_data);
    }

    public function ajaxSaveTaskHub()
    {
        $this->load->model('Taskhub_model');
        $this->load->model('Taskhub_participants_model');
        $this->load->model('Taskhub_status_model');   

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();  

        if( $post['subject'] != '' ){
            $taskStatus = $this->Taskhub_status_model->getById($post['status']);
            $task_data = [
                'prof_id' => $post['customer_id'],
                'subject' => $post['subject'],
                'description' => $post['description'],
                'created_by' => adminLogged('id'),
                'date_created' => date('Y-m-d h:i:s'),
                'estimated_date_complete' => date('Y-m-d', strtotime($post['estimated_date_complete'])),
                'actual_date_complete' => '',
                'task_color' => $taskStatus->status_color,
                'status_id' => $taskStatus->status_id,
                'priority' => 'low',
                'company_id' => $post['company_id'],
                'view_count' => 0
            ];

            $taskId = $this->Taskhub_model->create($task_data);

            $data_participant = [
                'task_id' => $taskId,
                'user_id' => $post['user_id'],
                'is_assigned' => 1
            ];

            $this->Taskhub_participants_model->create($data_participant);

            $is_success = 1;
            $msg = '';

        }else{
            $msg = 'Please enter subject';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);   
    }

    public function ajax_edit_taskhub()
    {
        $this->load->model('Business_model');
        $this->load->model('Taskhub_model');
        $this->load->model('Taskhub_participants_model');
        $this->load->model('Taskhub_status_model');
        $this->load->model('Users_model');
        $this->load->model('AcsProfile_model');

        $post = $this->input->post();

        $task = $this->Taskhub_model->getById($post['thid']);

        $companyCustomers = $this->AcsProfile_model->getAllByCompanyId($task->company_id);
        $companyUsers     = $this->Users_model->getCompanyUsers($task->company_id);
        $assignedUser     = $this->Taskhub_participants_model->getIsAssignedByTaskId($task->task_id);

        $this->page_data['task']  = $task;
        $this->page_data['taskStatus'] = $this->Taskhub_status_model->get();
        $this->page_data['companies']  = $this->Business_model->getAll();
        $this->page_data['companyCustomers'] = $companyCustomers;
        $this->page_data['companyUsers'] = $companyUsers;
        $this->page_data['assignedUser'] = $assignedUser;
        $this->load->view('admin/taskhub/ajax_edit_taskhub', $this->page_data);
    }

    public function ajaxUpdateTaskHub()
    {
        $this->load->model('Taskhub_model');
        $this->load->model('Taskhub_participants_model');
        $this->load->model('Taskhub_status_model');   

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $task = $this->Taskhub_model->getById($post['thid']);
        if( $task ){
            if( $post['subject'] != '' ){
                $taskStatus = $this->Taskhub_status_model->getById($post['status']);
                $data_task = [
                    'prof_id' => $post['customer_id'],
                    'subject' => $post['subject'],
                    'description' => $post['description'],                    
                    'estimated_date_complete' => date('Y-m-d', strtotime($post['estimated_date_complete'])),
                    'task_color' => $taskStatus->status_color,
                    'status_id' => $taskStatus->status_id,
                    'company_id' => $post['company_id'],
                ];
                $this->Taskhub_model->updateByTaskId($task->task_id, $data_task);

                $this->Taskhub_participants_model->deleteAllByTaskId($task->task_id);

                $data_participant = [
                    'task_id' => $task->task_id,
                    'user_id' => $post['user_id'],
                    'is_assigned' => 1
                ];

                $this->Taskhub_participants_model->create($data_participant);

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Please enter subject';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteTaskHub()
    {
        $this->load->model('Taskhub_model');
        $this->load->model('Taskhub_participants_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $task = $this->Taskhub_model->getById($post['thid']);
        if( $task ){
            $this->Taskhub_participants_model->deleteAllByTaskId($task->task_id);
            $this->Taskhub_model->deleteByTaskId($task->task_id);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function taskhub_status()
    {
        $this->load->model('Taskhub_status_model');

        $search = '';
        if( get('search') != '' ){
            $search  = get('search');
            $filters = ['search' => $search];
            $taskStatus = $this->Taskhub_status_model->getAll($filters);
        }else{
            $taskStatus = $this->Taskhub_status_model->getAll();
        }
            
        $this->page_data['search'] = $search;
        $this->page_data['taskStatus']  = $taskStatus;
        $this->page_data['page_title']  = 'Task Status';
        $this->page_data['page_parent'] = 'Settings';
        $this->load->view('admin/taskhub_status/list', $this->page_data);
    }

    public function ajaxSaveTaskhubStatus()
    {
        $this->load->model('Taskhub_status_model');

        $is_success = 0;
        $msg = '';

        $post = $this->input->post();
        if( $post['status_text'] == '' ){
            $msg = 'Please enter status name';
        }elseif( $post['status_color'] == '' ){
            $msg = 'Please specify task status color';
        }else{
            $data = [
                'status_text' => $post['status_text'],
                'status_color' => $post['status_color']
            ];

            $this->Taskhub_status_model->create($data);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_edit_taskhub_status()
    {
        $this->load->model('Taskhub_status_model');

        $post = $this->input->post();
        $taskStatus = $this->Taskhub_status_model->getById($post['tsid']);

        $this->page_data['taskStatus'] = $taskStatus;   
        $this->load->view('admin/taskhub_status/ajax_edit_taskhub_status', $this->page_data);
    }

    public function ajaxUpdateTaskhubStatus()
    {
        $this->load->model('Taskhub_status_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $taskStatus = $this->Taskhub_status_model->getById($post['tsid']);
        if( $taskStatus ){
            $data = [
                'status_text' => $post['status_text'],
                'status_color' => $post['status_color']
            ];

            $this->Taskhub_status_model->updateByStatusId($post['tsid'], $data);

            $is_success = 1;
            $msg = '';  
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajaxDeleteTaskhubStatus()
    {
        $this->load->model('Taskhub_status_model');
        
        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $taskStatus = $this->Taskhub_status_model->getById($post['tsid']);
        if( $taskStatus ){
            $data = [
                'status_text' => $post['status_text'],
                'status_color' => $post['status_color']
            ];

            $this->Taskhub_status_model->updateByStatusId($post['tsid'], $data);

            $is_success = 1;
            $msg = '';  
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
