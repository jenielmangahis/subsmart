<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MYF_Controller {
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
    	include APPPATH . 'libraries/braintree/lib/Braintree.php'; 

        // load models
        $this->load->model('general_model');
        $this->load->model('jobs_model');
        $this->load->model('Estimate_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');

        // load helpers
        $this->load->helper('functions');
    	//$this->load->helper(array('hashids_helper'));
        
    	$job  = $this->jobs_model->get_specific_job_by_hash_id($eid);    	
    	if($job){
    		$companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($job->company_id);
    		$braintree_token = '';
            if( $companyOnlinePaymentAccount && ($companyOnlinePaymentAccount->braintree_merchant_id != '' && $companyOnlinePaymentAccount->braintree_public_key != '' && $companyOnlinePaymentAccount->braintree_private_key != '') ){
                $gateway = new Braintree\Gateway([
                    'environment' => BRAINTREE_ENVIRONMENT,
                    'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
                    'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
                    'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
                ]);

                try {
                	$braintree_token = $gateway->ClientToken()->generate();	
                } catch (Exception $e) {
                	$braintree_token = '';
                }
            }

    		$job_id = $job->id;
    		if( $job->estimate_id > 0 ){
    			$estimate = $this->Estimate_model->getEstimate($job->estimate_id);
    			if( $estimate ){
    				$estimate_deposit_amount = $estimate->deposit_amount;
    			}
    		}else{
    			$estimate_deposit_amount = 0;
    		}

            $get_company_info = array(
                'where' => array(
                    'company_id' => $job->company_id,
                ),
                'table' => 'business_profile',
                'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
            );

            $this->page_data['braintree_token'] = $braintree_token;
            $this->page_data['estimate_deposit_amount'] = $estimate_deposit_amount;
            $this->page_data['onlinePaymentAccount'] = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($job->company_id);
            $this->page_data['company_info'] = $this->general_model->get_data_with_param($get_company_info,FALSE);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($job_id);
    	}else{
    	    redirect('home');
        }
    	$this->page_data['page']->title = 'nSmartTrac - Customer Job Invoice';	
    	$this->page_data['jobs_data'] = $job;
		$this->page_data['eid'] = $eid;
		//$this->page_data['is_job_valid'] = $is_job_valid;
		$this->load->view('pages/job_customer_invoice_view', $this->page_data);
    }

    public function converge_token_request(){
    	$this->load->model('Jobs_model');
    	$this->load->model('AcsProfile_model');
    	$this->load->model('Clients_model');
    	$this->load->model('CompanyOnlinePaymentAccount_model');

    	$this->load->helper(array('hashids_helper'));

    	$token = '';
		$is_success = false;

		$post = $this->input->post();
		//$job_id   = hashids_decrypt($post['job_id'], '', 15);
		$job_id   = $post['job_id'];
    	$job      = $this->Jobs_model->get_specific_job($job_id);

    	$job      = $this->Jobs_model->get_specific_job($job_id);
    	$customer = $this->AcsProfile_model->getByProfId($job->customer_id);
    	$client   = $this->Clients_model->getById($job->company_id);

    	$onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($job->company_id);

		if (!is_null($this->input->get('is_estimate', TRUE)) && isset($post['estimate_id'])) {
			$this->load->model('Estimate_model', 'estimate_model');
			$estimate = $this->estimate_model->getEstimate($post['estimate_id']);
			$customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);

			$client   = $this->Clients_model->getById($estimate->company_id);
			$onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($estimate->company_id);
		}

    	if( $onlinePaymentAccount ){
    		// Set variables
    		$merchantID = $onlinePaymentAccount->converge_merchant_id;
    		$merchantUserID = $onlinePaymentAccount->converge_merchant_user_id;
    		$merchantPinCode = $onlinePaymentAccount->converge_merchant_pin;

	    	/*$merchantID = "2159250"; //Converge 6 or 7-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
			$$merchantUserID = "nsmartapi"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
			$merchantPinCode = "UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X"; //Converge PIN (64 CHAR A/N)*/

			/*$merchantID = "2179135"; //Converge 6 or 7-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
			$merchantUserID = "adiAPI"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
			$merchantPinCode = "U3L0MSDPDQ254QBJSGTZSN4DQS00FBW5ELIFSR0FZQ3VGBE7PXP07RMKVL024AVR"; //Converge PIN (64 CHAR A/N)*/

			$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
			//$url = "https://api.convergepay.com/hosted-payments/transaction_token"; // URL to Converge production session token server

			/*Payment Field Variables*/
			// In this section, we set variables to be captured by the PHP file and passed to Converge in the curl request.
			$firstname = $customer->first_name; //Post first name
			$lastname  = $customer->last_name; //Post first name
			$address   = $customer->mail_add;
			$zipcode   = $customer->zip_code;
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
			"&ssl_avs_address=$address".
	        "&ssl_avs_zip=$zipcode".
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
			//$token = urlencode($result);
			$token = $result;
			$is_success = true;
    	}    	

		$json_data = ['is_success' => $is_success, 'token' => $token];

		echo json_encode($json_data);
		//echo $sessiontoken;  //shows the session token.
    }

    public function front_company_business_profile( $slug ){
    	$this->load->model('Business_model');
    	$this->load->model('ServiceCategory_model');
    	$this->load->model('DealsSteals_model');
    	
    	add_css(array(
            "assets/css/jquery.fancybox.css"
        ));

        add_footer_js(array(
            "assets/js/jquery.fancybox.min.js"
        ));
    	
        $profiledata = $this->Business_model->getBySlug($slug);        
        $selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($profiledata->company_id);

        $conditions[] = ['field' => 'deals_steals.status', 'value' => $this->DealsSteals_model->statusActive()];
        $dealsSteals  = $this->DealsSteals_model->getAllByCompanyId($profiledata->company_id, array(), $conditions);

        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->page_data['profiledata'] = $profiledata;
        $this->page_data['selectedCategories'] = $selectedCategories;
        $this->load->view('pages/company_business_profile', $this->page_data);        
    }

    public function update_job_status_paid(){
    	$this->load->model('Jobs_model');
    	$this->load->model('General_model', 'general');

    	$post = $this->input->post();    	
    	//$job_id = hashids_decrypt($post['jobid'], '', 15);
    	$job = $this->Jobs_model->get_specific_job($post['job_id']);
    	$this->Jobs_model->update($job->job_unique_id, ['status' => 'Completed']);

    	$payment_data = array();
    	if( $post['payment_method'] != '' ){
    		$payment_data['method'] = $post['payment_method'];
    	}else{
    		$payment_data['method'] = 'CC';	
    	}
        
        $payment_data['is_paid'] = 1;
        $payment_data['paid_datetime'] =date("m-d-Y h:i:s");;
        $check = array(
            'where' => array(
                'jobs_id' => $post['job_id']
            ),
            'table' => 'jobs_pay_details'
        );
        $exist = $this->general->get_data_with_param($check,FALSE);
        if($exist){
            $this->general->update_with_key_field($payment_data, $post['jobs_id'], 'jobs_pay_details','jobs_id');
        }else{
            $this->general->add_($payment_data, 'jobs_pay_details');
        }

    	$json_data = ['is_success' => 1];
    	echo json_encode($json_data);
    }

    public function front_refer_friend(){
    	$this->page_data['page']->title = 'Refer a Friend';	
        $this->load->view('pages/refer_friend', $this->page_data);        
    }

    public function send_refer_email(){
    	include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
    	
    	$is_success = true;
    	$post    = $this->input->post();

    	$subject = "NsmarTrac : Refer a Friend";
    	$refer_friend = base_url("assets/img/refer_friend.jpg");
    	$nsmart_logo  = base_url("assets/dashboard/images/logo.png");
    	$msg .= "<img style='width: 162px;margin-top:41px;margin-bottom:24px;' alt='Logo' src='".$refer_friend."' /><br />";
    	$msg .= "<p>Someone has refer a friend. Below are the details</p>";
    	$row = 1;
    	$msg .= "<table style='font-size: 14px;padding: 5px;'>";
    		$msg .= "<tr><td></td><td style='padding:5px;'>Name</td><td style='padding:5px;'>Email</td></tr>";
    		foreach($post['refer'] as $value){
    			if( $value['name'] != '' && $value['email'] != '' ){
    				$msg .= "<tr><td style='padding:5px;'>".$row.".</td><td style='padding:5px;'>".$value['name']."</td><td style='padding:5px;'>".$value['email']."</td></tr>";
    				$row++;
    			}    			
    		}
    	$msg .= "</table>";

    	$msg .= "<br><br><br><br><br>";
            
        $msg .= "<table style='margin-left:48px;'>";
            $msg .= "<tr><td colspan='2' style='text-align:center;'><span style='display:inline-block;'>Powered By</span> <br><br> <img style='width:328px;margin-bottom:40px;' src='".$nsmart_logo."' /></td></tr>";
        $msg .= "</table>";

        //Email Sending
        $server    = MAIL_SERVER;
        $port      = MAIL_PORT ;
        $username  = MAIL_USERNAME;
        $password  = MAIL_PASSWORD;
        $from      = MAIL_FROM;        
        $recipient = 'support@nsmartrac.com';

        $mail = new PHPMailer;
        //$mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout    =   10; // set the timeout (seconds)
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'NsmarTrac';
        $mail->addAddress($recipient, $recipient);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $msg;

        if(!$mail->Send()) {
            $is_success = false;
        }

    	$json_data = ['is_success' => $is_success];

    	echo json_encode($json_data);
    }

    public function deals_view($slug, $id){
    	$this->load->model('DealsSteals_model');
    	$this->load->model('Business_model');

    	$dealsSteals = $this->DealsSteals_model->getById($id);
    	$company     = $this->Business_model->getByCompanyId($dealsSteals->company_id);

    	$this->page_data['page']->title = 'Deals';	
    	$this->page_data['dealsSteals'] = $dealsSteals;
    	$this->page_data['company']     = $company;
    	$this->load->view('pages/deals_view', $this->page_data);       
    }

    public function deals_booking($id){
    	$this->load->model('DealsSteals_model');
    	$this->load->model('Business_model');

    	$dealsSteals   = $this->DealsSteals_model->getById($id);
    	$company       = $this->Business_model->getByCompanyId($dealsSteals->company_id);

    	$this->page_data['page']->title = 'Deals : Booking';	
    	$this->page_data['company']     = $company;
    	$this->page_data['dealsSteals'] = $dealsSteals;
    	$this->load->view('pages/deals_booking', $this->page_data);       
    }

    public function create_deals_booking(){
    	$this->load->model('DealsSteals_model');
    	$this->load->model('DealsBookings_model');
    	$this->load->model('Business_model');
    	$this->load->model('Customer_advance_model');

    	$is_success = 0;
    	$msg  = 'Check form inputs and try again.';
    	$post = $this->input->post();  

    	if( $post['name'] != '' && $post['email'] != '' && $post['phone'] != '' ){

    		$dealsSteals   = $this->DealsSteals_model->getById($post['did']);
    		$company       = $this->Business_model->getByCompanyId($dealsSteals->company_id);

    		$data = [
    			'deals_id' => $post['did'],
    			'company_id' => $dealsSteals->company_id,
    			'name' => $post['first_name'] . " " . $post['last_name'],
    			'phone' => $post['phone'],
    			'email' => $post['email'],
    			'address' => $post['address_full'],
    			'message' => $post['message'],
    			'date_created' => date("Y-m-d H:i:s")
    		];
    		$this->DealsBookings_model->create($data);	

    		$leads_input = array(
	            'firstname'     => $post['first_name'],
	            'lastname'      => $post['last_name'],
	            'phone_cell'    => $post['phone'],
	            'email_add'     => $post['email'],
	            'address'       => $post['address_full'],
	        );

	        $this->Customer_advance_model->add($leads_input, "ac_leads");

    		$this->page_data['dealsSteals']  = $dealsSteals;
    		$this->page_data['company']      = $company;
    		$this->page_data['booking_data'] = $post;

    		$server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;

    		//Email customer
    		$subject_customer = "Deal Booked with " . $company->business_name . " " . date("d-M-Y g:i a");
    		$msg_customer     = $this->load->view('pages/deals_email_template_customer', $this->page_data, TRUE);
    		$recipient = $post['email'];

    		$mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout    =   10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = $company->business_name;
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject_customer;
            $mail->Body    = $msg_customer;
            $mail->Send();

    		//Email company
    		$subject_company  = "New inquiry on " . date("d-M-Y g:i A");
    		$msg_company      = $this->load->view('pages/deals_email_template_company', $this->page_data, TRUE);
    		$recipient        = $company->business_email;

    		$mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout    =   10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'nSmarTrac';
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject_company;
            $mail->Body    = $msg_company;
            //$mail->Send();

    		$is_success = 1;
    		$msg = '';
    	}

    	$json_data = ['is_success' => $is_success, 'msg' => $msg];
    	echo json_encode($json_data);
    }

    /**
	*
	*
	* @param eid hash company_id
    */
    public function external_booking_page( $eid )
    {    	
    	$this->load->model('BookingCategory_model');
		$this->load->model('BookingServiceItem_model');
		$this->load->model('BookingSetting_model');
        
    	$this->load->helper(array('form', 'url', 'hashids_helper'));
    	$cid = hashids_decrypt($eid, '', 15);

    	$filter[] = ['field' => 'company_id', 'value' => $cid];
		$categories       = $this->BookingCategory_model->getAllCategories($filter);
		$booking_settings = $this->BookingSetting_model->findByCompanyId($cid);
		$bussinessProfile = $this->business_model->getByCompanyId($cid);

		$uri_segment_method_name = $this->uri->segment(2);
		$products = array();

		$search_query = '';
		$filters      = array();

		if( isset($post['search']) && $post['search'] !== '' ){
			$filters['search'] = $post['search'];
			$search_query      = $post['search'];
		}

		foreach( $categories as $c ){
			$serviceItems = $this->BookingServiceItem_model->getAllCompanyProductsByCategoryId($cid, $c->id, $filters);
			if( $serviceItems ){
				$products[] = ['category' => $c, 'products' => $serviceItems];
			}
		}
		
		if( $this->input->get('style') != '' ){
			$view = 'grid_items';
		}else{
			$view = 'front_items';
		}

		$cart_items = $this->session->userdata('cartItems');
		$coupon     = $this->session->userdata('coupon');
		$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);

		$this->page_data['uri_segment_method_name'] = $uri_segment_method_name;
		$this->page_data['booking_settings'] = $booking_settings;
		$this->page_data['search_query'] = $search_query;
		$this->page_data['cart_data']    = $cart_data;
		$this->page_data['bussinessProfile'] = $bussinessProfile;
		$this->page_data['coupon'] = $coupon;
		$this->page_data['products']     = $products;
		$this->page_data['eid'] = $eid;

		$this->load->view('online_booking/' . $view, $this->page_data);
    }

    public function ajax_update_booking_cart()
    {
    	$is_success = 0;
    	$msg = '';

    	$post       = $this->input->post();
    	$cart_items = $this->session->userdata('cartItems');
    	$key        = $post['pid'];
    	if( $post['qty'] > 0 ){
    		if( !empty($cart_items) ){
	    		if( isset($cart_items['products'][$key]) ){
	    			$new_qty = $post['qty'] + $cart_items['products'][$key];
	    			$cart_items['products'][$key] = $new_qty;
	    		}else{
	    			$cart_items['products'][$key] = $post['qty'];
	    		}
	    	}else{
	    		$cart_items['products'][$key] = $post['qty'];
	    	}

	    	$this->session->set_userdata('cartItems',$cart_items);

	    	$is_success = 1;
    	}else{
    		$msg = 'Cannot accept quantity less than 1';
    	}
    	
    	$json_data = ['is_success' => $is_success, 'msg' => $msg];
    	echo json_encode($json_data);

    	/*$this->session->set_flashdata('message', 'Cart was successfully updated');
        $this->session->set_flashdata('alert_class', 'alert-success');*/
    }

    public function ajax_update_cart_coupon()
    {
    	$this->load->model('BookingCoupon_model');
    	$this->load->helper(array('hashids_helper'));  

    	$is_success = 0;
    	$is_coupon_valid = 0;
    	$msg = '';

    	$post       = $this->input->post();
    	$coupon_code = $post['coupon_code'];
    	if( $coupon_code ) {
    		$cid = hashids_decrypt($post['eid'], '', 15);
	    	$coupon_exist = $this->BookingCoupon_model->isCompanyCouponCodeExists($coupon_code, $cid);
	    	if($coupon_exist){
	    		$coupon = $this->BookingCoupon_model->getByCouponCode($coupon_code);
	    		$date_today = date("Y-m-d");
	    		if( $coupon->status == 1 ){
	    			if( $date_today <= $coupon->date_valid_to ){
	    				if( $coupon->used_per_coupon > 0 ){
	    					$is_coupon_valid = 1;
	    				}else{
	    					$msg = 'Coupon code already reached max usage';
	    				}		    			
		    		}else{
		    			$msg = 'Coupon code already expired';
		    		}
	    		}else{
	    			$msg = 'Coupon code already expired';
	    		}
	    	}else{
	    		$msg = 'Invalid coupon code';
	    	}


	    	if( $is_coupon_valid ){
	    		$coupon_details = array(
					'coupon_name' => $coupon->coupon_name,
					'coupon_amount' => $coupon->discount_from_total,
					'coupon_code' => $coupon->coupon_code,
					'type' => $coupon->discount_from_total_type,
					'id' => $coupon->id,
				);

	    		$cart_items['coupon'] = $coupon_details;
	    		$this->session->set_userdata('coupon',$cart_items);

	    		$is_success = 1;
	    	}	    	
    	}

    	$json_data = ['is_success' => $is_success, 'msg' => $msg];
    	echo json_encode($json_data);
    }

    public function ajax_delete_coupon()
    {
    	unset($_SESSION['coupon']);
    }

    public function external_front_schedule($eid)
	{
		$this->load->model('BookingServiceItem_model');
		$this->load->model('BookingSetting_model');
        $this->load->model('Users_model');

		$this->load->helper(array('hashids_helper'));  

		$cid = hashids_decrypt($eid, '', 15);

		$bussinessProfile = $this->business_model->getByCompanyId($cid);
		$booking_settings = $this->BookingSetting_model->findByCompanyId($cid);

		$coupon = $this->session->userdata('coupon');
		$cart_items = $this->session->userdata('cartItems');
		$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);
		$uri_segment_method_name = $this->uri->segment(2);

		$is_cont_to_booking_form = false;
		if(!empty($cart_items['schedule_data'])) {
			$is_cont_to_booking_form = true;
		}

		$this->page_data['is_cont_to_booking_form'] = $is_cont_to_booking_form;
		$this->page_data['uri_segment_method_name'] = $uri_segment_method_name;
		$this->page_data['booking_settings'] = $booking_settings;
		$this->page_data['week_start_date'] = date("Y-m-d");
		$this->page_data['cart_data']    = $cart_data;
		$this->page_data['coupon']    = $coupon;
		$this->page_data['bussinessProfile']  = $bussinessProfile;
		$this->page_data['eid'] = $eid;

		$this->load->view('online_booking/front_schedule', $this->page_data);
	}

	public function ajax_load_week_schedule()
    {
    	$this->load->model('BookingTimeSlot_model');
    	$this->load->helper(array('hashids_helper'));  

    	$post = $this->input->post();
    	$cid  = hashids_decrypt($post['eid'], '', 15);
    	$start_date = $post['week_start_date'];
    	$end_date   = date("Y-m-d", strtotime($start_date . " +7 days"));

    	$start      = new \DateTime($start_date);
        $end        = new \DateTime($end_date);
        $interval   = \DateInterval::createFromDateString('1 day');
        $period     = new \DatePeriod($start, $interval, $end);

		$cart_items = $this->session->userdata('cartItems');

        $schedules = $this->BookingTimeSlot_model->findAllByCompanyId($cid);

        $week_schedules = array();

        foreach ($period as $dt) {
            $date = $dt->format("Y-m-d");
            $week_schedules[$date] = array();

            foreach( $schedules as $s ){
            	$day = $dt->format("D");
            	$days = unserialize($s->days);
            	if( in_array($day, $days) ){
            		$week_schedules[$date][] = ['id' => $s->id, 'time_start' => $s->time_start, 'time_end' => $s->time_end];
            	}
            }
        }

        $prev_date = date("Y-m-d", strtotime($start_date . " -7 days"));
        $next_date = date("Y-m-d", strtotime($start_date . " +7 days"));

        $selected_sched = array();
        if(!empty($cart_items['schedule_data'])) {
        	$selected_sched = $cart_items['schedule_data'];
        }

        $this->page_data['selected_sched'] = $selected_sched;
        $this->page_data['eid'] = $post['eid'];
        $this->page_data['prev_date'] = $prev_date;
        $this->page_data['next_date'] = $next_date;
        $this->page_data['week_schedules'] = $week_schedules;
		$this->load->view('online_booking/ajax_load_week_schedule', $this->page_data);
    }

    public function ajax_user_set_schedule()
    {
    	$post = $this->input->post();
    	$cart_items = $this->session->userdata('cartItems');
    	$cart_items['schedule_data'] = $post;

    	$this->session->set_userdata('cartItems',$cart_items);
    }

    public function front_booking_form($eid)
	{
		$this->load->model('BookingSetting_model');
		$this->load->model('BookingForms_model');
		$this->load->model('BookingServiceItem_model');

		$this->load->helper(array('hashids_helper'));  

		$cid = hashids_decrypt($eid, '', 15);
		$bussinessProfile = $this->business_model->getByCompanyId($cid);
		$booking_settings = $this->BookingSetting_model->findByCompanyId($cid);
		$forms 			  = $this->BookingForms_model->getAllByCompanyId($cid);

		$coupon = $this->session->userdata('coupon');
		$cart_items = $this->session->userdata('cartItems');
		$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);
		$uri_segment_method_name = $this->uri->segment(2);

		$this->page_data['forms'] = $forms;
		$this->page_data['uri_segment_method_name'] = $uri_segment_method_name;
		$this->page_data['booking_settings'] = $booking_settings;
		$this->page_data['cart_data']        = $cart_data;
		$this->page_data['coupon']           = $coupon;
		$this->page_data['booking_schedule'] = $cart_items['schedule_data'];
		$this->page_data['bussinessProfile'] = $bussinessProfile;
		$this->page_data['eid'] = $eid;

		$this->load->view('online_booking/front_booking_form', $this->page_data);
	}

	public function save_product_booking()
    {
    	$this->load->model('BookingInfo_model');
    	$this->load->model('BookingServiceItem_model');
    	$this->load->model('BookingWorkOrder_model');
    	$this->load->model('BookingCoupon_model');

    	$this->load->helper(array('hashids_helper'));  

    	$coupon_id     = null;
    	$custom_fields = array();
    	$post    = $this->input->post();
    	$cid     = hashids_decrypt($post['eid'], '', 15);
    	$cart_items = $this->session->userdata('cartItems');
    	$coupon     = $this->session->userdata('coupon');

    	$in_array = array(
			'full_name', 'contact_number','email',
			'address','message','preferred_time_to_contact',
			'how_did_you_hear_about_us','eid'
		);

    	foreach($post as $p_key => $p) {
			if (!in_array($p_key, $in_array)) {
			    $custom_fields[$p_key] = $p;
			}
    	}

    	$bussinessProfile = $this->business_model->getByCompanyId($cid);

    	if( $bussinessProfile ){
    		$cart_items = $this->session->userdata('cartItems');
			$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);

			$discounted_amount = 0;
			$coupon_id = 0;
			$bookingCoupon = array();

	    	if(isset($coupon)) {
	    		$bookingCoupon = $this->BookingCoupon_model->getByIdAndCompanyId($coupon['coupon']['id'], $cid);
	    		if( $bookingCoupon ){
	    			$coupon_id = $bookingCoupon->id;
	    			if( $bookingCoupon->discount_from_total_type == 1 ){
	    				$discounted_amount = ($bookingCoupon->discount_from_total * 100) - $cart_data['total_amount'];
	    			}else{
	    				$discounted_amount = $bookingCoupon->discount_from_total;
	    			}
	    		}
	    	}

			$subtotal_amount = $cart_data['total_amount'];
			$total_amount    = $cart_data['total_amount'] - $discounted_amount;

    		$data_booking_info = [
	    		'company_id' => $cid,
	    		'coupon_id' => $coupon_id,
	    		'name' => $post['full_name'],
	    		'phone' => $post['contact_number'],
	    		'email' => $post['email'],
	    		'address' => $post['address'],
	    		'message' => $post['message'],
	    		'preferred_time_to_contact' => $post['preferred_time_to_contact'],
	    		'how_did_you_hear_about_us' => $post['how_did_you_hear_about_us'],
	    		'schedule_date' => $cart_items['schedule_data']['date'],
	    		'schedule_time_from' => $cart_items['schedule_data']['time_start'],
	    		'schedule_time_to' => $cart_items['schedule_data']['time_end'],
	    		'form_data' => serialize($custom_fields),
	    		'subtotal_amount' => $subtotal_amount,
	    		'discounted_amount' => $discounted_amount,
	    		'total_amount' => $total_amount,
	    		'status' => 1,
	    		'date_created' => date("Y-m-d H:i:s")
	    	];

	    	$booking_info_id = $this->BookingInfo_model->save($data_booking_info);

	    	if( $booking_info_id > 0 ){	    		
				foreach( $cart_items['products'] as $pid =>  $qty ){
					$item = $this->BookingServiceItem_model->getById($pid);
					$total_amount = $item->price * $qty;
					$data_booking_work_orders = [
						'booking_info_id' => $booking_info_id,
						'service_item_id' => $pid,
						'quantity_ordered' => $qty,
						'item_price' => $item->price,
						'item_unit' => $item->price_unit,
						'total_amout' => $total_amount,
						'total_discount' => 0,
						'coupon_id' => $coupon_id,
						'schedule_date' => $cart_items['schedule_data']['date'],
						'schedule_time_from' => $cart_items['schedule_data']['time_start'],
						'schedule_time_to' => $cart_items['schedule_data']['time_end'],
						'date_created' => date("Y-m-d H:i:s")
					];

					$this->BookingWorkOrder_model->create($data_booking_work_orders);
				}

				//Update coupon
				if( $bookingCoupon ){
					$status = $bookingCoupon->status;
					$total_usage = $bookingCoupon->used_per_coupon - 1;
					if( $total_usage <= 0 ){
						$status = 0;
					}	

					$coupon_data = [
						'status' => $status,
						'used_per_coupon' => $total_usage
					];

					$this->BookingCoupon_model->update($bookingCoupon->id, $coupon_data);
				}
				

				//Send email notification
				$bussinessProfile = $this->business_model->getByCompanyId($cid);
				$subject = 'nSmartrac : Online Booking';
				$body = "Someone made an online booking. Below are the details.";
				$body .= "<table>";
					$body .= "<tr><td>Name :".$post['full_name']."</td></tr>";
					$body .= "<tr><td>Phone :".$post['contact_number']."</td></tr>";
					$body .= "<tr><td>Email :".$post['email']."</td></tr>";
					$body .= "<tr><td>Message :".$post['message']."</td></tr>";
					$body .= "<tr><td>Preferred time to contact :".$post['preferred_time_to_contact']."</td></tr>";
				$body .= "</table>";

				$data = [
	                'to' => $bussinessProfile->business_email, 
	                'subject' => $subject, 
	                'body' => $body,
	                'cc' => '',
	                'bcc' => '',
	                'attachment' => ''
	            ];

	            $isSent = sendEmail($data);

				$this->session->set_flashdata('message', 'Your product booking has been saved.');
        		$this->session->set_flashdata('alert_class', 'alert-info');

        		$this->session->unset_userdata('cartItems');
    			$this->session->unset_userdata('coupon');

    			redirect('booking/products/'.$post['eid']);

	    	}else{
	    		$this->session->set_flashdata('message', 'Canot save data. Please try again later.');
        		$this->session->set_flashdata('alert_class', 'alert-danger');

        		redirect('booking/product_booking_form/'.$post['eid']);
	    	}

    	}else{
    		$this->session->set_flashdata('message', 'Merchant not found');
        	$this->session->set_flashdata('alert_class', 'alert-danger');

        	redirect('booking/product_booking_form/'.$post['eid']);
    	}
    }

    public function front_survey($id)
    {
    	$this->load->model('Survey_model', 'survey_model');

	    add_css(array(
	        'assets/dashboard/css/bootstrap.min.css',
	    ));

	    $this->page_data['survey'] = $this->survey_model->view($id);
	    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
	    $this->page_data['survey_theme'] = $this->survey_model->getThemes($this->page_data['survey']->theme_id);
	    $this->load->view('survey/preview', $this->page_data);
	}

	public function survey_answer($id)
	{
		$this->load->model('Survey_model', 'survey_model');
	    $answered = $this->survey_model->saveAnswer($_POST, $_FILES,$id);
	    echo json_encode($answered);
	    exit;
  	}

  	public function surveyImageUploadedFile( $survey_id )
  	{
      if(isset($_FILES['file']) && $_FILES['file']['tmp_name'] != '') {
          $target_dir = "./uploads/survey/image_db/" . $survey_id . "/";
          if(!file_exists($target_dir)) {
              mkdir($target_dir, 0777, true);
          }

          $tmp_name = str_replace(" ", "-",$_FILES['file']['tmp_name']);
          $extension = strtolower(end(explode('.',$_FILES['file']['name'])));
          $name = 'attached_image_'.time().".".$extension;
          move_uploaded_file($tmp_name, $target_dir . $tmp_name);

          return $tmp_name;
      }
  }

  public function ajax_survey_question_logic_jump()
  {
  	$this->load->model('Survey_model', 'survey_model');

  	$post = $this->input->post();
  	$logicJumps = $this->survey_model->getSurveyLogicByQuestionIdFrom($post['survey_item_id']);
  	$surveyQuestions = $this->survey_model->getSurveyQuestionsBySurveyId($post['sid']);

  	$answer = strtolower($post['value']);
  	$jump_question_id = 0;

  	foreach( $logicJumps as $lj ){
  		$logic_value = strtolower($lj->sl_value);
  		switch ($lj->sl_condition) {
  			case 'is-equal-to':
  				if( $logic_value == $answer ){
  					$jump_question_id = $lj->sl_question_id_to;
  					break 2;
  				}  				
  				break;
  			case 'not-equal-to':
  				if( $logic_value <> $answer ){
  					$jump_question_id = $lj->sl_question_id_to;	
  				}
  				break 2;
  			default:  				
  				break;
  		}
  	}

  	$next = false;
  	$next_question_id = 0;
  	foreach($surveyQuestions as $sq){

  		if( $next == true ){
  			$next_question_id = $sq->id;
  			break;
  		}

  		if( $post['survey_item_id'] == $sq->id ){
  			$next = true;
  		}
  	}



  	$json_data = ['jump_id' => $jump_question_id, 'next_question_id' => $next_question_id];
  	echo json_encode($json_data);
  }

  	public function front_appointment_view($eid)
    {
    	$this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');

        $this->load->helper(array('hashids_helper'));

        $appointment_id = hashids_decrypt($eid, '', 15);
        $appointment    = $this->Appointment_model->getById($appointment_id);
        if( $appointment ){
        	$text_tags = '';
	        if( $appointment->tag_ids != '' ){
	            $a_tags = explode(",", $appointment->tag_ids);     
	            $appointmentTags   = $this->Job_tags_model->getAllByIds($a_tags);
	            $e_tags = array();
	            foreach($appointmentTags as $t){
	                $e_tags[] = $t->name;
	            }
	            if( !empty($e_tags) ){
	                $text_tags = implode(",", $e_tags);
	            }            
	        }

	        $tags = $this->Job_tags_model->getAllByCompanyId($company_id, array());  

	        $a_tags = array();
	        $selected_tags = explode(",", $appointment->tag_ids);
	        foreach($tags as $t){
	            if( in_array($t->id, $selected_tags) ){
	                $a_tags[$t->id] = ['name' => $t->name, 'icon' => $t->marker_icon, 'is_marker_icon_default_list' => $t->is_marker_icon_default_list, 'cid' => $t->company_id];
	            }
	        }

	        $this->page_data['a_tags'] = $a_tags;
	        $this->page_data['text_tags'] = $text_tags;
	        $this->page_data['appointment'] = $appointment;
	        $this->load->view('pages/appointment_view', $this->page_data);
        }else{
        	redirect('home');
        }
	}

	public function front_activate_multi_account( $eid )
	{
		$this->load->helper(array('hashids_helper'));
		$this->load->model('CompanyMultiAccount_model');

		$id = hashids_decrypt($eid, '', 15);
		$is_valid     = 0;
		$multiAccount = $this->CompanyMultiAccount_model->getById($id);

		if( $multiAccount ){
			if( $multiAccount->status == $this->CompanyMultiAccount_model->statusNotVerified() ){
				$this->CompanyMultiAccount_model->update($multiAccount->id, ['date_activated' => date("Y-m-d H:i:s"), 'status' => $this->CompanyMultiAccount_model->statusVerified()]);

				$is_valid = 1;
				$msg = 'Account activated';
			}else{
				$msg = 'Account already active';
			}
		}else{
			$msg = 'Account doesnt exists';
		}

		$this->page_data['msg'] = $msg;
		$this->page_data['is_valid'] = $is_valid;
	    $this->load->view('pages/front_activate_multi_account', $this->page_data);

	}

	public function testVonageWebhook()
	{
		$post = $this->input->post();
		print_r($post);
		exit;
	}

	public function ajax_braintree_process_payment()
	{
		include APPPATH . 'libraries/braintree/lib/Braintree.php'; 
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('jobs_model');

		$is_success = 0;
		$msg  = '';

		$post = $this->input->post();
        $job  = $this->jobs_model->get_specific_job($post['jobid']);
        if( $job ){
        	$companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($job->company_id);

	        if( $companyOnlinePaymentAccount ){
	        	$job_items = $this->jobs_model->get_specific_job_items($job->id);
	        	$total_amount = 0;
	        	foreach($job_items as $item){
	        		$total_amount += ($item->cost * $item->qty);
	        	}	

	        	$estimate_deposit_amount = 0;
	        	if( $job->estimate_id > 0 ){
	    			$estimate = $this->Estimate_model->getEstimate($job->estimate_id);
	    			if( $estimate ){
	    				$estimate_deposit_amount = $estimate->deposit_amount;
	    			}
	    		}

	    		$total_amount = ($total_amount + $job->tax_rate) - $estimate_deposit_amount;

	            $gateway = new Braintree\Gateway([
	                'environment' => BRAINTREE_ENVIRONMENT,
	                'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
	                'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
	                'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
	            ]);
	            $result = $gateway->transaction()->sale([
	                'amount' => floatval($total_amount),
	                'paymentMethodNonce' => $post['nonce'],
	                'options' => [
	                    'submitForSettlement' => true
	                ]
	            ]);

	            if($result->success || !is_null($result->transaction)) {
	                $is_success = 1;
	            }else{
	                $errorString = "";
	                foreach($result->errors->deepAll() as $error) {
	                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
	                }
	                $msg = $errorString;                
	            }
	        }else{
	        	$msg = 'Cannot process payment using braintree.';
	        }	
        }   
        

		$data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
	}
}
