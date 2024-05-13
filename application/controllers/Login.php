<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(setting('timezone'));

        if (!empty($this->db->username) && !empty($this->db->hostname) && !empty($this->db->database)) {
        } else {
            die('Database is not configured');
        }

        if (is_logged()) {
            redirect('dashboard', 'refresh');
        }

        $this->data = [
            'assets' => assets_url(),
            'body_classes'	=> setting('login_theme') == '1' ? 'login-page login-background' : 'login-page-side login-background'
        ];
    }

    public function index()
    {   
        $remember_me = false;
        $remember_username = '';
        $remember_password = '';

        if( $this->input->cookie('remember_me') && $this->input->cookie('username') ){
            $remember_me = true;
            $remember_username = $this->input->cookie('username');
            $remember_password = $this->input->cookie('password');
        } 

        $this->data['remember_username'] = $remember_username;
        $this->data['remember_password'] = $remember_password;
        $this->data['remember_me'] = $remember_me;
        $this->load->view('account/login', $this->data, false);
    }

    public function timezonesetter()
    {
        $date_before = date('Y-m-d h:i:s A');
        $usertimezone = $this->input->post("usertimezone");
        date_default_timezone_set($usertimezone);
        $date_after = date('Y-m-d h:i:s A');
        $_SESSION['usertimezone'] = $usertimezone;
        $_SESSION['offset_zone'] = $this->input->post("offset_zone");
        $display = array(
            "usertimezone" => $usertimezone,
            "newphptimezone" => date_default_timezone_get(),
            "date_before" => $date_before,
            "date_after" => $date_after,
            "session_timezone" => $this->session->userdata('usertimezone'),
            "offset_zone" => $this->session->userdata('offset_zone')

        );
        echo json_encode($display);
    }
    public function check()
    {
        $this->load->model('Clients_model');
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');
        $this->load->model('CompanyDeactivatedModule_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('CalendarSettings_model');
                
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|xss_clean|callback_validate_username');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');

        $is_recaptcha_enabled = (setting('google_recaptcha_enabled') == '1');

        if ($is_recaptcha_enabled) {
            $this->form_validation->set_rules('g-recaptcha-response', 'Google Recaptcha', 'callback_validate_recaptcha');
        }   

        if( post('remember_me') ){
            set_cookie('username', post('username'), 604800);
            set_cookie('password', post('password'), 604800);
            set_cookie('remember_me', true, 604800);
        }else{
            delete_cookie('username');
            delete_cookie('password');
            delete_cookie('remember_me');
        }

        if ($this->form_validation->run() == false) {
            $this->index();
            return;
        }

        $username = post('username');
        $password = post('password');
        $is_startup = 0;

        $attempt = $this->users_model->attempt(compact('username', 'password'));

        if ($attempt == 'valid') {
            $user = $this->db->where('username', $username)->or_where('email', $username)->get($this->users_model->table)->row();
            if( $user->has_web_access == 0 ){
                $this->data['message'] = 'You do not have web access.';
                $this->data['message_type'] = 'danger';

                $this->index();
                return;
            }else{
                $calendarSettings = $this->CalendarSettings_model->getByCompanyId($user->company_id);
                $default_timezone = '';
                if( $calendarSettings && $calendarSettings->timezone != '' ){
                    date_default_timezone_set($calendarSettings->timezone);                    
                }
                // If Allowed, then retreive user row and login the user                
                $this->users_model->login($user, post('remember_me'), $default_timezone);

                $client = $this->Clients_model->getById($user->company_id);
                if( $client->is_plan_active == 3 ){
                    $this->data['message'] = 'Company account is currently disabled. Please contact system administrator.';
                    $this->data['message_type'] = 'danger';

                    $this->index();
                    return;
                }else{
                    // Get all access modules
                    if ($user->role == 1 || $user->role == 2) { //Admin and nsmart tech
                        $access_modules = array(0 => 'all');
                    } else {                
                        if ($client) {
                            if ($client->is_startup == 1) {
                                $is_startup = 1;
                            }

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
                    $this->session->set_userdata('client_industry', $client->industry_type_id);

                    //Capture ip and geolocation
                    $this->load->model('UserAllowedIP_model');
                    $user_location = getUserPublicIP();
                    if( $user_location['ip'] != '' ){
                        if( $user->last_login_ip_address != '' ){
                            $allowedIp = $this->UserAllowedIP_model->getByUserIdAndIPAddress($user->id, $user_location['ip']);
                            if( !$allowedIp ){
                                //Record location
                                $ip_location = [
                                    'user_id' => $user->id,
                                    'ip_address' => $user_location['ip'],
                                    'longitude' => $user_location['lon'],
                                    'latitude' => $user_location['lat'],
                                    'country' => $user_location['country'],
                                    'location' => $user_location['location'],
                                    'is_allowed' => 1,
                                    'date_created' => date("Y-m-d h:i:s")
                                ];

                                $this->UserAllowedIP_model->create($ip_location);

                                //Send email notification
                                $body = $this->generateUnrecognizeLoginEmailHtml($user, $user_location);
                                $mail = email__getInstance();
                                $mail->FromName = 'nSmarTrac';
                                $recipient_name = $user->FName . ' ' . $user->LName;
                                $mail->addAddress($user->email, $recipient_name);
                                $mail->isHTML(true);
                                $mail->Subject = "nSmartrac: Unrecognize Login";
                                $mail->Body = $body;
                                $mail->Send();
                            }else{
                                if( $allowedIp->is_allowed == 0 ){
                                    //redirect to logout 
                                    redirect('/logout');
                                }
                            }
                        }

                        //Log last login ip
                        $update_user = ['last_login_ip_address' => $user_location['ip']];
                        $this->users_model->update($user->id, $update_user);
                    }

                }
            }
        } elseif ($attempt == 'invalid_password') {

            // Show Message if invalid password

            $this->data['message'] = 'Invalid Password';
            $this->data['message_type'] = 'danger';

            $this->index();
            return;
        } elseif ($attempt == 'not_allowed') {

            // Show Message if invalid password

            $this->data['message'] = 'You are not allowed to Login ! Contact Admin';
            $this->data['message_type'] = 'danger';

            $this->index();
            return;
        } else {

            // if invalid value or false returned by $attempt

            $this->data['message'] = 'Something Went Wrong !';
            $this->data['message_type'] = 'danger';

            $this->index();
            return;
        }

        if ($is_startup == 1) {
            redirect('onboarding/business_info');
        } else {            
            if( $client->is_plan_active == 1 ){
                $billingErrors = $this->Customer_advance_model->get_customer_billing_errors($client->id);
                if( $billingErrors ){
                    redirect('customer/billing_errors');
                }else{
                    redirect('dashboard');
                }           
                redirect('dashboard');
            }else{
                if( $client->id == 1 ){
                    redirect('dashboard');
                }else{
                    $exempted_company_ids = exempted_company_ids();
                    if( !in_array($client->id, $exempted_company_ids) ){
                        redirect('mycrm/renew_plan');  
                    }else{
                        redirect('dashboard');
                    }
                    
                }
            }
            
        }
    }

    public function validate_recaptcha($recaptchaResponse)
    {
        $userIp = $this->input->ip_address();
        $secret = setting('google_recaptcha_secretkey');

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $status = json_decode($output, true);

        if ($status['success']) {
            return true;
        } else {
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

        if ($exists > 0) {
            return true;
        } else {
            $this->form_validation->set_message('validate_username', 'Invalid Username/Email');
            return false;
        }
    }

    public function forget()
    {
        $is_with_token = 0;
        $reset_token   = '';
        if (!empty(get('token'))) {
            $isTokenExists = $this->users_model->getResetToken(get('token'));
            if( $isTokenExists ){
                $is_with_token = 1;
                $reset_token   = get('token');
            }else{
                $is_with_token = 2;
            }
        } 

        $this->data['reset_token'] = $reset_token;
        $this->data['is_with_token'] = $is_with_token;
        $this->load->view('account/forget_new', $this->data, false);
        //$this->load->view('account/forget', $this->data, FALSE);
    }

    public function reset_password()
    {
        postAllowed();

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|xss_clean|callback_validate_username');

        if ($this->form_validation->run() == false) {
            $this->forget();
            return;
        }

        $reset = $this->users_model->resetPassword(['username' => post('username')]);

        $this->data['message']	=	'Reset Link Sent to <a href="#">' . obfuscate_email($reset) . '</a> ! Please check your email';
        $this->data['message_type']	=	'info';

        if ($reset === 'invalid') {
            $this->data['message']	=	'Invalid Email/Username';
            $this->data['message_type']	=	'danger';
        }

        $this->forget();
    }

    public function reset_password_new()
    {
        $this->load->view('account/forget_new', $this->data, false);
    }

    public function new_password()
    {
        $reset_token = !empty(get('token')) ? get('token') : false;

        $user = $this->users_model->getByWhere(['reset_token' => $reset_token]);

        if (!$reset_token || !$user || empty($user)) {
            echo 'Invalid Request';
            redirect('login/forget', 'refresh');
            return;
        }

        $user = $user[0];

        $this->data['user']	=	$user;

        $this->load->view('account/reset_password', $this->data, false);
    }

    public function set_new_password()
    {
        postAllowed();

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->data['user']	=	$this->users_model->getByWhere(['reset_token' => post('token')])[0];
            $this->load->view('account/reset_password', $this->data, false);
            return;
        }

        $reset_token = post('token');

        $user	=	$this->users_model->getByWhere(compact('reset_token'))[0];

        $this->users_model->update($user->id, [
            'password'	=>	hash("sha256", post('password')),
            'reset_token'	=>	'',
        ]);

        $this->session->set_flashdata('message', 'New Password has been Updated, You can login now');
        $this->session->set_flashdata('message_type', 'success');
        redirect('login', 'refresh');
    }

    public function ajax_check_user_id_exists()
    {
        $is_success = 0;
        $user = $this->users_model->getUserByUsernname(post('user_id'));
        if ($user) {
            /*if ($user->postal_code == post('user_zipcode')) {
                $is_success = 1;
                $msg = '';
            } else {
                $msg = 'User ID not found';
            }*/

            //Save token
            $token = $this->users_model->generate_verification_token($user->id);
            $this->users_model->update($user->id, [
                'reset_token'  =>  $token
            ]);

            //Send email            
            $url   = url('login/forget?token=' . $token);
            $subject = 'nSmarTrac : Password Reset';
            $to   = $user->email;
            $body = "<p>Hi <b>".$user->FName."</b></p>";
            $body .= "<p>Please click link below to reset your password.</p>";
            $body .= "<p><a href='".$url."'>Reset Your Password</a></p><br />";
            $body .= "<p>Thank you</p>";
            $body .= "<p>nSmarTrac Team</p>";

            $data = [
                'to' => $to, 
                'subject' => $subject, 
                'body' => $body,
                'cc' => '',
                'bcc' => '',
                'attachment' => ''
            ];

            $isSent = sendEmail($data);

            $is_success = 1;
            $msg = '';
        } else {
            $msg = 'User ID not found';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
        exit;
    }

    public function ajax_update_user_password()
    {
        $is_success = 0;
        if (post('new_password') != post('re_password')) {
            $msg = 'Password not match';
        } else {
            $user = $this->users_model->getResetToken(post('reset_token'));
            if ($user) {
                /*if ($user->postal_code == post('user_zipcode')) {
                    $this->users_model->update($user->id, [
                        'password'	=>	hash("sha256", post('new_password')),
                        'password_plain' => post('new_password'),
                        'reset_token'	=>	''
                    ]);
                    $is_success = 1;
                    $msg = 'You password was successfully changed. Redirecting to login page...';
                } else {
                    $msg = 'User ID not found';
                }*/
                $this->users_model->update($user->id, [
                    'password'  =>  hash("sha256", post('new_password')),
                    'password_plain' => post('new_password'),
                    'reset_token'   =>  ''
                ]);
                $is_success = 1;
                $msg = 'You password was successfully changed. Redirecting to login page...';

                //Send email
                $subject = 'nSmarTrac : Password Reset';
                $to   = $user->email;
                $body = "<p>Hi <b>".$user->FName."</b></p>";
                $body .= "<p>Your password has been changed. Below is your new password.</p>";
                $body .= "<p>New Password : ".post('new_password')."</p><br />";
                $body .= "<p>Thank you</p>";
                $body .= "<p>nSmarTrac Team</p>";

                $data = [
                    'to' => $to, 
                    'subject' => $subject, 
                    'body' => $body,
                    'cc' => '',
                    'bcc' => '',
                    'attachment' => ''
                ];

                $isSent = sendEmail($data);
                                
            } else {
                $msg = 'User not found';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
        exit;
    }

    public function customer(){

        $remember_me = false;
        $remember_username = '';
        $remember_password = '';

        if( $this->input->cookie('customer_remember_me') && $this->input->cookie('customer_username') ){
            $remember_me = true;
            $remember_username = $this->input->cookie('customer_username');
            $remember_password = $this->input->cookie('customer_password');
        } 

        $this->data['remember_username'] = $remember_username;
        $this->data['remember_password'] = $remember_password;
        $this->data['remember_me'] = $remember_me;

        $this->load->view('customer/login/index', $this->data, false);
    }

    public function customer_check()
    {
        $this->load->model('AcsAccess_model');
        $this->load->model('AcsProfile_model');

        $username = post('username');
        $password = post('password');

        if( post('remember_me') ){
            set_cookie('customer_username', post('username'), 604800);
            set_cookie('customer_password', post('password'), 604800);
            set_cookie('customer_remember_me', true, 604800);
        }else{
            delete_cookie('customer_username');
            delete_cookie('customer_password');
            delete_cookie('customer_remember_me');
        }

        $isExists = $this->AcsAccess_model->getByUsernamePassword($username, $password);

        if ( $isExists ) {
            if( $isExists->portal_status == 1 ){
                $customer = $this->AcsProfile_model->getByProfId($isExists->fk_prof_id);
                if( $customer ){
                    $customer_data = [
                        'prof_id' => $customer->prof_id,
                        'customer_type' => $customer->customer_type,
                        'company_id' => $customer->company_id,
                        'first_name' => $customer->first_name,
                        'middle_name' => $customer->middle_name,
                        'last_name' => $customer->last_name,
                        'email' => $customer->email
                    ];
                    $this->session->set_userdata('customer_data', $customer_data);
                    redirect('acs_access/dashboard');
                }else{

                }                
            }else{
                $this->data['message'] = 'Invalid Password';
                $this->data['message_type'] = 'danger';

                $this->customer();
                return;
            }            
        } else {
            $this->data['message'] = 'Invalid Password';
            $this->data['message_type'] = 'danger';

            $this->customer();
            return;
        }
    }

    public function generateUnrecognizeLoginEmailHtml($user, $ip_data)
    {
        $encrypted_user_id = hashids_encrypt($user->id, '', 15);

        $this->page_data['user'] = $user;
        $this->page_data['encrypted_user_id'] = $encrypted_user_id;
        $this->page_data['ip_data'] = $ip_data;
        return $this->load->view('v2/pages/users/email_unrecognize_login', $this->page_data, true);
    }

    public function unAuthorizeLogin($eid)
    {
        $this->load->helper(array('hashids_helper'));
        $this->load->model('Users_model');
        $this->load->model('UserAllowedIP_model');
        
        $user_id   = hashids_decrypt($eid, '', 15);
        $public_ip = $this->input->get('ip');
        $user      = $this->Users_model->getUser(81);
        if( $user ){
            //Change to random password then redirect to reset password
            $random_pw = generateRandomString(6);
            $data = [
                'password_plain' => $random_pw,
                'password' => hash("sha256", $random_pw)
            ];
            $this->Users_model->update($user->id, $data);

            //Update allowed ips
            $userAllowedIp = $this->UserAllowedIP_model->getByUserIdAndIPAddress($user_id, $public_ip);
            if( $userAllowedIp ){
                $data_ip = ['is_allowed' => 0];
                $this->UserAllowedIP_model->update($userAllowedIp->id, $data_ip);
            }

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );

            $data = ['user_id' => $user->id];
            $pusher = new Pusher\Pusher(
                'f3c73bc6ff54c5404cc8',
                '20b5e1eb05dc73068e61',
                '1168724',
                $options
            );
            $pusher->trigger('nsmarttrac-unauthorize-login', 'force-logout-user', $data);

            redirect('login/forget');
        }else{
            redirect('/');
        }
    }
}

/* End of file Login.php */
/* Location: ./application/controllers/Admin/Login.php */
