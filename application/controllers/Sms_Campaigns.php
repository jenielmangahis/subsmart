<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sms_Campaigns extends MY_Controller {



	public function __construct()
	{
		parent::__construct();

		$this->load->model('SmsBlast_model');
		$this->load->model('Users_model');
		$this->load->model('Contacts_model');

		$this->page_data['page']->title = 'SMS Campaigns';
		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	

		$this->load->view('sms_campaigns/index', $this->page_data);

	}

	public function add_sms_blast()
	{
		$this->session->unset_userdata('smsBlastId');
		$this->load->view('sms_campaigns/add_sms_blast', $this->page_data);
	}

	public function create_draft_campaign()
	{	
		$json_data = [
			'is_success' => false,
			'err_msg' => 'Please enter Campaign Name'
		];

        $post = $this->input->post(); 

        if( $post['sms_camapaign_name'] != '' ){
        	$user = $this->session->userdata('logged');

        	$sms_blast_data = [
        		'user_id' => $user['id'],
        		'campaign_name' => $post['sms_camapaign_name'],
        		'sms_text' => '',
        		'sending_type' => $this->SmsBlast_model->sendingTypeAll(),
        		'status' => $this->SmsBlast_model->statusDraft(),
        		'customer_type' => $this->SmsBlast_model->customerTypeResidential(),
        		'created' => date("Y-m-d H:i:s")
        	];	

        	$sms_id = $this->SmsBlast_model->create($sms_blast_data);

        	$this->session->set_userdata('smsBlastId', $sms_id);

        	$json_data = [
				'is_success' => true,
				'err_msg' => ''
			];
        }

		echo json_encode($json_data);
	}

	public function add_campaign_send_to()
	{
		$user = $this->session->userdata('logged');
		$cid  = logged('company_id');
		
		$contacts = $this->Contacts_model->getAllByCompanyId($cid);

		$this->page_data['contacts'] = $contacts;
		$this->load->view('sms_campaigns/add_campaign_send_to', $this->page_data);
	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */