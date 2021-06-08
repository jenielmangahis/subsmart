<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(setting('timezone'));

        add_css(array(
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
        ));
        
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

        $this->page_data['companies'] = $this->Business_model->getAll();
        $this->page_data['users'] = $this->Users_model->getAllUsers();
        $this->page_data['payscale'] = $this->PayScale_model->getAll();
        $this->load->view('admin/users/list', $this->page_data);
    }

    public function logout(){
        if(is_admin_logged()){
            $this->load->model('Activity_model', 'activity');
            $activity['activityName'] = "User Logout";
            $activity['activity'] = " User ".logged('username')." is logged out";
            $activity['user_id'] = logged('id');
            $this->activity->addEsignActivity($activity);
        }

        $this->activity_model->add("User: ".getLoggedFullName(logged('id')).' Logged Out'); 

        $this->users_model->admin_logout();

        redirect('admin/login','refresh');
    }

    public function create_employee(){
        $this->load->model('IndustryType_model');

        $company_id = $this->input->post('values[company_id]');
        $fname = $this->input->post('values[firstname]');
        $lname = $this->input->post('values[lastname]');
        $email = $this->input->post('values[email]');
        $username = $this->input->post('values[username]');
        $password = $this->input->post('values[password]');
        $address = $this->input->post('values[address]');

        $city  = $this->input->post('values[city]');
        $state  = $this->input->post('values[state]');
        $postal_code  = $this->input->post('values[postal_code]');

        $user_type = $this->input->post('values[user_type]');
        $role = $this->input->post('values[role]');
        $status = $this->input->post('values[status]');
        $web_access = $this->input->post('values[web_access]');
        $app_access = $this->input->post('values[app_access]');
        $profile_img = $this->input->post('values[profile_photo]');
        $payscale_id = $this->input->post('values[empPayscale]');
        $emp_number  = $this->input->post('values[emp_number]');
        $cid=logged('company_id');
        $add = array(
            'company_id' => $company_id,
            'FName' => $fname,
            'LName' => $lname,
            'username' => $username,
            'email' => $username,
            'password' => hash("sha256",$password),
            'password_plain' => $password,
            'role' => $role,
            'user_type' => $user_type,
            'status' => $status,
            'company_id' => $cid,
            'profile_img' => $profile_img,
            'address' => $address,
            'state' => $state,
            'city' => $city,
            'postal_code' => $postal_code,
            'payscale_id' => $payscale_id,
            'employee_number' => $emp_number
        );
        $last_id = $this->users_model->addNewEmployee($add);

        //Create timesheet record
        $this->load->model('TimesheetTeamMember_model');
        $this->TimesheetTeamMember_model->create([
            'user_id' => $last_id,
            'name' => $fname . ' ' . $lname,
            'email' => $username,
            'role' => 'Employee',
            'department_id' => 0,
            'department_role' => 'Member',
            'will_track_location' => 1,
            'status' => 1,
            'company_id' => $cid
        ]);
        //End Timesheet     

        //Create Trac360 record
        $this->load->model('Trac360_model');
        $data = [
            'user_id' => $last_id,
            'name' => $fname . ' ' . $lname,
            'company_id' => $cid
        ];
        $this->Trac360_model->add('trac360_people', $data);
        //End Trac360

        if ($last_id > 0 ){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
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
        $this->load->model('Business_model');

        $user_id = $this->input->post('user_id');
        $get_user = $this->Users_model->getUser($user_id);
        $get_role = $this->db->get_where('roles',array('id' => $get_user->role));

        $cid   = logged('company_id');      
        $roles = $this->users_model->getRoles($cid);

        if( $role_id == 1 || $role_id == 2 ){
            $this->page_data['payscale'] = $this->PayScale_model->getAll();
        }else{
            $this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
        }

        $this->page_data['companies'] = $this->Business_model->getAll();
        $this->page_data['roles'] = $roles;
        $this->page_data['user'] = $get_user;
        $this->page_data['role'] = $get_role;
        $this->load->view('admin/users/modal_edit_form', $this->page_data);
    }

    public function ajaxUpdateEmployee(){
        $this->load->model('Users_model');
        $company_id = $this->input->post('values[company_id]');
        $user_id = $this->input->post('values[user_id]');
        $fname = $this->input->post('values[firstname]');
        $lname = $this->input->post('values[lastname]');
        $email = $this->input->post('values[email]');
        $username = $this->input->post('values[username]');
        $password = $this->input->post('values[password]');
        $address = $this->input->post('values[address]');

        $city  = $this->input->post('values[city]');
        $state  = $this->input->post('values[state]');
        $postal_code  = $this->input->post('values[postal_code]');

        $role = $this->input->post('values[role]');
        $status = $this->input->post('values[status]');
        $web_access = $this->input->post('values[web_access]');
        $app_access = $this->input->post('values[app_access]');
        $profile_img = $this->input->post('values[profile_photo]');
        $payscale_id = $this->input->post('values[empPayscale]');
        $emp_number  = $this->input->post('values[emp_number]');
        $user_type   = $this->input->post('values[user_type]');
        $user = $this->Users_model->getUser($user_id);

        if( $profile_img == '' ){
            $profile_img = $user->profile_img;
        }

        $data = array(
            'company_id' => $company_id,
            'FName' => $fname,
            'LName' => $lname,
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'status' => $status,            
            'profile_img' => $profile_img,
            'address' => $address,
            'state' => $state,
            'city' => $city,
            'postal_code' => $postal_code,
            'payscale_id' => $payscale_id,
            'user_type' => $user_type,
            'employee_number' => $emp_number
        );

        $user = $this->Users_model->update($user_id,$data);

        echo json_encode(1);
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

        $new_password = $this->input->post('values[new_password]');
        $re_password  = $this->input->post('values[re_password]');
        $user_id = $this->input->post('values[change_password_user_id]');

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

    public function delete($id){
        $user = $this->users_model->delete($id);
        //Delete Timesheet 
        $this->load->model('TimesheetTeamMember_model');
        $this->TimesheetTeamMember_model->deleteByUserId($id);
        //Delete Tract360
        $this->load->model('Trac360_model');
        $this->Trac360_model->deleteUser('trac360_people', $id);

        $this->activity_model->add("User #$id Deleted by User:".logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'User has been Deleted Successfully');
        redirect('admin/users');
    }
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
