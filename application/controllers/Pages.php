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

		/*$encrypted = hashids_encrypt(2, '', 15);
    	$decrypted = hashids_decrypt($encrypted, '', 15);*/

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
					$msg = "Cannot create employee.";
				}
			}
		}else{
			$msg = 'Password does not match';
		}

		$data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
		exit;
	}

	public function estimate_customer_view( $eid )
    {
    	$this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        
        $this->load->helper(array('hashids_helper'));
        
        $estimate_id = hashids_decrypt($eid, '', 15);
        $estimate = $this->estimate_model->getEstimate($estimate_id);
        if( $estimate ){            
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $estimateItems = unserialize($estimate->estimate_items);

            $this->page_data['estimate'] = $estimate;
            $this->page_data['customer'] = $customer;
            $this->page_data['estimateItems'] = $estimateItems;

            $is_valid = true;
        }else{
            $is_valid = false;
        }

        $this->page_data['eid'] = $eid;
        $this->page_data['is_valid'] = $is_valid;
        $this->load->view('pages/estimate_customer_view', $this->page_data);
    }

    public function customer_approve_estimate()
    {
    	$this->load->model('Estimate_model', 'estimate_model');
        
        $this->load->helper(array('hashids_helper'));
        
    	$post = $this->input->post();
    	$estimate_id = hashids_decrypt($post['eid'], '', 15);
    	$estimate    = $this->estimate_model->getEstimate($estimate_id);
    	if( $estimate ){
    		$this->estimate_model->update($estimate->id, ['status' => 'Accepted']);
    		$this->session->set_flashdata('message', 'Your estimate was successfully updated');
        	$this->session->set_flashdata('alert_class', 'alert-success');
    	}else{
    		$this->session->set_flashdata('message', 'Cannot find estimate');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
    	}

    	redirect('estimate_customer_view/' . $post['eid']);
    }

    public function customer_update_estimate($type)
    {
    	$this->load->model('Estimate_model', 'estimate_model');
        
        $this->load->helper(array('hashids_helper'));
        
    	$post = $this->input->post();
    	$estimate_id = hashids_decrypt($post['eid'], '', 15);
    	$estimate    = $this->estimate_model->getEstimate($estimate_id);
    	if( $estimate ){
    		if( $type == 1 ){ //Accept
    			$this->estimate_model->update($estimate->id, ['status' => 'Accepted']);
    		}else{ //Declined
    			$this->estimate_model->update($estimate->id, ['status' => 'Declined By Customer', 'remarks' => $post['reason']]);
    		}
    		
    		$this->session->set_flashdata('message', 'Your estimate was successfully updated');
        	$this->session->set_flashdata('alert_class', 'alert-success');
    	}else{
    		$this->session->set_flashdata('message', 'Cannot find estimate');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
    	}

    	redirect('estimate_customer_view/' . $post['eid']);
    }

    public function credit_note_customer_view( $eid )
    {
    	$this->load->model('CreditNote_model');
    	$this->load->model('CreditNoteItem_model');
    	$this->load->model('AcsProfile_model');
    	$this->load->model('Clients_model');
    	$this->load->model('Users_model');
        
        $this->load->helper(array('hashids_helper'));

        $credit_note_id = hashids_decrypt($eid, '', 15);
        $creditNote = $this->CreditNote_model->getById($credit_note_id);
        if( $creditNote ){            
        	$user     = $this->Users_model->getUser($creditNote->user_id);
            $customer = $this->AcsProfile_model->getByProfId($creditNote->customer_id);
            $client   = $this->Clients_model->getById($user->company_id);
            $creditNoteItems = $this->CreditNoteItem_model->getAllByCreditNoteId($creditNote->id);

            $this->page_data['status'] = $this->CreditNote_model->optionStatus();   
            $this->page_data['customer'] = $customer;
            $this->page_data['client'] = $client;
            $this->page_data['creditNote'] = $creditNote;
            $this->page_data['creditNoteItems'] = $creditNoteItems;

            $is_valid = true;
        }else{
            $is_valid = false;
        }

        $this->page_data['eid'] = $eid;
        $this->page_data['is_valid'] = $is_valid;
        $this->load->view('pages/credit_note_customer_view', $this->page_data);
    }

    public function job_customer_invoice_view( $eid )
    {
    	$this->load->model('Jobs_model');
    	$this->load->model('AcsProfile_model');
    	$this->load->model('Clients_model');

    	$this->load->helper(array('hashids_helper'));

    	$job_id   = hashids_decrypt($eid, '', 15);
    	$job      = $this->Jobs_model->get_specific_job($job_id);
    	if( $job ){
    		$customer = $this->AcsProfile_model->getByProfId($job->customer_id);
    		$client   = $this->Clients_model->getById($job->company_id);

    		$this->page_data['client'] = $client;
    		$this->page_data['customer'] = $customer;
    	}

    	$this->page_data['page']->title = 'nSmartTrac - Customer Job Invoice';	
    	$this->page_data['job'] = $job;
		$this->page_data['eid'] = $eid;
		$this->page_data['is_job_valid'] = $is_job_valid;
		$this->load->view('pages/job_customer_invoice_view', $this->page_data);
    }

    public function converge_token_request(){
    	$this->load->model('Jobs_model');
    	$this->load->model('AcsProfile_model');
    	$this->load->model('Clients_model');

    	$this->load->helper(array('hashids_helper'));

    	// Set variables
		$merchantID = "2179135"; //Converge 6 or 7-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
		$merchantUserID = "adiAPI"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
		$merchantPinCode = "U3L0MSDPDQ254QBJSGTZSN4DQS00FBW5ELIFSR0FZQ3VGBE7PXP07RMKVL024AVR"; //Converge PIN (64 CHAR A/N)

		//$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
		$url = "https://api.convergepay.com/hosted-payments/transaction_token"; // URL to Converge production session token server

		$post = $this->input->post();
		$job_id   = hashids_decrypt($post['job_id'], '', 15);
    	$job      = $this->Jobs_model->get_specific_job($job_id);

    	$job      = $this->Jobs_model->get_specific_job($job_id);
    	$customer = $this->AcsProfile_model->getByProfId($job->customer_id);
    	$client   = $this->Clients_model->getById($job->company_id);
		/*Payment Field Variables*/

		// In this section, we set variables to be captured by the PHP file and passed to Converge in the curl request.
		$firstname = $customer->first_name; //Post first name
		$lastname  = $customer->last_name; //Post first name
		$amount    = $post['total_amount']; //Post Tran Amount
		//$merchanttxnid = $_POST['ssl_merchant_txn_id']; //Capture user-defined ssl_merchant_txn_id as POST data
		//$invoicenumber = $_POST['ssl_invoice_number']; //Capture user-defined ssl_invoice_number as POST data

		//Follow the above pattern to add additional fields to be sent in curl request below.

		$ch = curl_init();    // initialize curl handle
		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
		curl_setopt($ch,CURLOPT_POST, true); // set POST method
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// Set up the post fields. If you want to add custom fields, you would add them in Converge, and add the field name in the curlopt_postfields string.
		curl_setopt($ch,CURLOPT_POSTFIELDS,
		"ssl_merchant_id=$merchantID".
		"&ssl_user_id=$merchantUserID".
		"&ssl_pin=$merchantPinCode".
		"&ssl_transaction_type=CCSALE".
		"&ssl_first_name=$firstname".
		"&ssl_last_name=$lastname".
		"&ssl_get_token=Y".
		"&ssl_add_token=Y".
		"&ssl_amount=$amount"
		);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);

		$result = curl_exec($ch); // run the curl procss
		curl_close($ch); // Close cURL

		//session tokens need to be URL encoded
		$token = urlencode($result);
		$is_success = true;

		$json_data = ['is_success' => $is_success, 'token' => $token];

		echo json_encode($json_data);
		//echo $sessiontoken;  //shows the session token.
    }

    public function front_company_business_profile( $slug ){
    	$this->load->model('Business_model');
    	$this->load->model('ServiceCategory_model');
    	
    	add_css(array(
            "assets/css/jquery.fancybox.css"
        ));

        add_footer_js(array(
            "assets/js/jquery.fancybox.min.js"
        ));

    	$comp_id = logged('company_id');
        $profiledata = $this->Business_model->getBySlug($slug);
        $selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($comp_id);

        $this->page_data['profiledata'] = $profiledata;
        $this->page_data['selectedCategories'] = $selectedCategories;
        $this->load->view('pages/company_business_profile', $this->page_data);        
    }

}
