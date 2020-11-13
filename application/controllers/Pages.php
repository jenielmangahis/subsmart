<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
	public function __construct(){
		parent::__construct();
		//$this->checkLogin(1);
	}

	public function index(){
		$this->page_data['page']->title = 'nSmartTrac - Terms and Condition';	
		$this->load->view('pages/terms_and_condition', $this->page_data);
	}

	public function terms_and_condition(){
		$this->page_data['page']->title = 'nSmartTrac - Terms and Condition';	
		$this->load->view('pages/terms_and_condition', $this->page_data);
	}

	public function privacy_policy(){
		$this->page_data['page']->title = 'nSmartTrac - Privacy Policy';	
		$this->load->view('pages/privacy_policy', $this->page_data);
	}

	public function anti_spam_policy(){
		$this->page_data['page']->title = 'nSmartTrac - Anti Spam Policy';	
		$this->load->view('pages/anti_spam_policy', $this->page_data);
	}

	public function find_pros(){
		$this->page_data['page']->title = 'nSmartTrac - Find Pros';	
		$this->load->view('pages/find_pros', $this->page_data);
	}

	public function find_pros_form(){
		$find_pro = $this->input->get('find_pro');
		
		$this->page_data['business'] = getIndustryBusiness();
		$this->page_data['find_pro'] = $find_pro;
		$this->page_data['page']->title = 'nSmartTrac - Find Pros';	
		$this->load->view('pages/find_pros_form', $this->page_data);
	}

	public function ajax_send_find_pros(){

		if($this->input->post()) {

			$find_pro = $this->input->post('find_pro');
			$location_type = $this->input->post('location_type');
			$location_street = $this->input->post('location_street');
			$location_zip = $this->input->post('location_zip');
			$recurring_cleaning = $this->input->post('recurring_cleaning');
			$name = $this->input->post('name');
			$contact_number = $this->input->post('contact_number');
			$email_address = $this->input->post('email_address');
			$address = $this->input->post('address');
			$brief_description = $this->input->post('brief_description');

			$message = '';
			$message .= '<strong>Find Pro: </strong>' . $find_pro . '<br />';
			$message .= '<strong>Location Type: </strong>' . $location_type . '<br />';
			$message .= '<strong>Street: </strong>' . $location_street . '<br />';
			$message .= '<strong>Zip Code: </strong>' . $location_zip . '<br />';
			$message .= '<strong>Zip Code: </strong>' . $recurring_cleaning . '<br />';

			$message .= '<strong>Name: </strong>' . $name . '<br />';
			$message .= '<strong>Contact Number: </strong>' . $contact_number . '<br />';
			$message .= '<strong>Email: </strong>' . $email_address . '<br />';
			$message .= '<strong>Full Address: </strong>' . $address . '<br />';
			$message .= '<strong>Brieft Dscription of Project: </strong>' . $brief_description . '<br />';

	        $this->load->library('email');

			$config = array();
			/*$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'smtp.mailtrap.io';
			$config['smtp_user'] = 'd7c92e3b5e901d';
			$config['smtp_pass'] = '203aafda110ab7';
			$config['smtp_port'] = 2525;
			$config['mailtype']  = 'html';*/

			$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'mail.nsmartrac.com';
			$config['smtp_user'] = 'admin@nsmartrac.com';
			$config['smtp_pass'] = 'UqzD+td4Yb&S';
			$config['smtp_port'] = 25;
			$config['mailtype']  = 'html';

			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
			$this->email->from('admin@nsmartrac.com');
			$this->email->to($email_address);
			$this->email->subject('nSmarTrac : Find Pro');
			$this->email->message($message);
			if($this->email->send()){
				$response['is_success'] = 1;
			}else{
				$response['is_success'] = 0;
			}

		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function front_add_employee( $eid ) {

		$this->load->helper(array('hashids_helper'));

		$this->load->model('Clients_model');
		$this->load->model('Users_model');

		$encrypted = hashids_encrypt(2, '', 15);
    	$decrypted = hashids_decrypt($encrypted, '', 15);

		$cid      = hashids_decrypt($eid, '', 15);
		$client   = $this->Clients_model->getById($cid);
		$is_valid = true;
		if( !$client ){
			$is_valid = false;
		}

		$this->page_data['page']->title = 'nSmartTrac - Add Company Employees';	
		$this->page_data['client'] = $client;
		$this->page_data['eid'] = $eid;
		$this->page_data['is_valid'] = $is_valid;
		$this->load->view('pages/front_add_employee', $this->page_data);
	}

	public function front_save_company_employee() {
		$this->load->helper(array('hashids_helper'));
		$this->load->model('Clients_model');
		$this->load->model('Users_model');
		$this->load->model('TimesheetTeamMember_model');

		$post = $this->input->post();

		$is_success = false;
		$msg = 'Cannot save employee. Please try again later.';

		if( $post['password'] == $post['confirm_password'] ){
			//Check if username already taken
			$isUsernameTaken = $this->Users_model->getUserByUsernname($post['username']);
			if( $isUsernameTaken ){
				$msg = 'Username already taken.';
			}else{
				$cid      = hashids_decrypt($post['eid'], '', 15);
				$client   = $this->Clients_model->getById($cid);
				if( $client ){
					$uid = $this->users_model->create([
		                'role' => 30,
		                'FName' => $post['firstname'],
		                'LName' => $post['lastname'],
		                'username' => $post['username'],
		                'email' => $post['email'],
		                'company_id' => $cid,
		                'status' => 1,
		                'password_plain' =>  $post['password'],
		                'password' => hash( "sha256", $post['password'] ),
		            ]);

		            $timesheetMember = $this->TimesheetTeamMember_model->create([
		            	'user_id' => $uid,
		            	'name' => $post['firstname'] . ' ' . $post['lastname'],
		            	'email' => $post['email'],
		            	'role' => 'Employee',
		            	'department_id' => 0,
		            	'department_role' => 'Member',
		            	'will_track_location' => 1,
		            	'status' => 1,
		            	'company_id' => $cid
		            ]);

		            $msg = "Employee was successfully created.";
		            $is_success = true;
				}else{
					$msg = "Cannot save employee.";
				}
			}
		}else{
			$msg = 'Password does not match';
		}

		$data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
		exit;
	}

}
