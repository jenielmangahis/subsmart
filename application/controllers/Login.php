<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public $data;

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set( setting('timezone') );

		if( !empty($this->db->username) && !empty($this->db->hostname) && !empty($this->db->database) ){ }else{
			die('Database is not configured');
		}

		if(is_logged()){
			redirect('dashboard','refresh');
		}

		$this->data = [
			'assets' => assets_url(),
			'body_classes'	=> setting('login_theme') == '1' ? 'login-page login-background' : 'login-page-side login-background'
		];

	}

	public function index()
	{
		$this->load->view('account/login', $this->data, FALSE);
	}


	public function check()
	{

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|xss_clean|callback_validate_username');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');

        $is_recaptcha_enabled = (setting('google_recaptcha_enabled') == '1');

        if($is_recaptcha_enabled)
        	$this->form_validation->set_rules('g-recaptcha-response', 'Google Recaptcha', 'callback_validate_recaptcha');

        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
            return;
        }

        $username = post('username');
        $password = post('password');

        $attempt = $this->users_model->attempt( compact('username', 'password') );

        if( $attempt=='valid' ){

        	// If Allowed, then retreive user row and login the user
			$user = $this->db->where( 'username', $username )->or_where( 'email', $username )->get( $this->users_model->table )->row();
        	$this->users_model->login( $user, post('remember_me') );

        	// Get all access modules
        	if( $user->role == 1 || $user->role == 2 ){ //Admin and nsmart tech
        		$access_modules = array(0 => 'all');
        	}else{
        		$this->load->model('Clients_model');
        		$this->load->model('IndustryType_model');
        		$this->load->model('IndustryTemplateModules_model');

        		$client = $this->Clients_model->getById($user->company_id);

        		if( $client ){
        			$industryType = $this->IndustryType_model->getById($client->industry_type_id);
        			if( $industryType ){
        				$industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->id);
        				foreach( $industryModules as $im ){
        					$access_modules[] = $im->industry_module_id;
        				}

        				$this->session->set_userdata('userAccessModules', $access_modules);
        			}
        		}
        	}
        }elseif( $attempt=='invalid_password' ){

        	// Show Message if invalid password

            $this->data['message'] = 'Invalid Password';
            $this->data['message_type'] = 'danger';

            $this->index();
            return;
        }elseif( $attempt=='not_allowed' ){

        	// Show Message if invalid password

            $this->data['message'] = 'You are not allowed to Login ! Contact Admin';
            $this->data['message_type'] = 'danger';

            $this->index();
            return;
        }else{
        	
        	// if invalid value or false returned by $attempt
            
            $this->data['message'] = 'Something Went Wrong !';
            $this->data['message_type'] = 'danger';

            $this->index();
            return;

        }

        /*$ipaddress = $this->timesheet_model->gtMyIpGlobal();
	   
        $get_location = json_decode(file_get_contents('http://ip-api.com/json/'.$ipaddress)); 
        $lat = $get_location->lat;
        $lng = $get_location->lon;

        $utimezone = $get_location->timezone;
         
        date_default_timezone_set($utimezone); 
        
        $this->users_model->update($user->id, [
			'user_time_zone'	=>	$utimezone,
			'time_zone_update'	=>	date('Y-m-d H:m:i'),
		]);*/

		$this->load->model('Activity_model', 'activity');
		$activity['activityName'] = "User Login";
		$activity['activity'] = " User ".logged('username')." is loggedin";
		$activity['user_id'] = logged('id');
		$isUserInserted = $this->activity->addEsignActivity($activity);
        redirect('dashboard');

	}

	public function validate_recaptcha($recaptchaResponse)
	{
		
		$userIp=$this->input->ip_address();
        $secret = setting('google_recaptcha_secretkey');

        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
         
        $status= json_decode($output, true);
 
        if ($status['success']) {
			return true;
		}else{
			$this->form_validation->set_message('validate_recaptcha', 'Google Recaptcha not valid !');  
			return false;
		}
	}

	public function validate_username($username)
	{
		$table = $this->users_model->table;
		$this->db->where('username', $username);
		$this->db->or_where('email', $username);

		$exists = $this->db->get($table)->num_rows();

		if($exists > 0){
			return true;
		}else{
			$this->form_validation->set_message('validate_username', 'Invalid Username/Email');  
			return false;
		}
	}

	public function forget()
	{
		$this->load->view('account/forget', $this->data, FALSE);
	}

	public function reset_password()
	{
		
		postAllowed();

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|xss_clean|callback_validate_username');

		if($this->form_validation->run() == FALSE){
			$this->forget();
			return;
		}

		$reset = $this->users_model->resetPassword( [ 'username' => post('username') ] );

		$this->data['message']	=	'Reset Link Sent to <a href="#">'.obfuscate_email($reset).'</a> ! Please check your email';
		$this->data['message_type']	=	'info';

		if($reset==='invalid'){
			$this->data['message']	=	'Invalid Email/Username';
			$this->data['message_type']	=	'danger';
		}

		$this->forget();

	}

	public function new_password()
	{
		$reset_token = !empty(get('token')) ? get('token') : false;

		$user = $this->users_model->getByWhere(['reset_token' => $reset_token]);

		if(!$reset_token || !$user || empty($user)){
			echo 'Invalid Request';
			redirect('login/forget', 'refresh'); return;
		}

		$user = $user[0];

		$this->data['user']	=	$user;

		$this->load->view('account/reset_password', $this->data, FALSE);

	}

	public function set_new_password()
	{

		postAllowed();

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$this->data['user']	=	$this->users_model->getByWhere(['reset_token' => post('token')])[0];
			$this->load->view('account/reset_password', $this->data, FALSE);
			return;
		}

		$reset_token = post('token');

		$user	=	$this->users_model->getByWhere(compact('reset_token'))[0];

		$this->users_model->update($user->id, [
			'password'	=>	hash( "sha256", post('password') ),
			'reset_token'	=>	'',
		]);

		$this->session->set_flashdata('message', 'New Password has been Updated, You can login now');
		$this->session->set_flashdata('message_type', 'success');
		redirect('login', 'refresh');

	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Admin/Login.php */