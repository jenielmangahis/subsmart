<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Offers extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();
        $this->load->model('Offers_model');
		$this->load->model('OffersRecipients_model');	
		$this->page_data['page']->title = 'Offers';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	
		$this->load->view('offers/index', $this->page_data);
	}

	public function add_offer()
	{
		$this->session->unset_userdata('offerId');
		$this->load->view('offers/add_offer', $this->page_data);
	}

	public function create_draft_offer()
	{	
		$json_data = [
			'is_success' => false,
			'err_msg' => 'Please enter Title'
		];

        $post = $this->input->post(); 

        if( $post['title'] != '' ){
        	$user = $this->session->userdata('logged');

        	$offers_data = [
        		'user_id' => $user['id'],
        		'title' => $post['title'],
        		'description' => $post['description'],
        		'terms_and_conditions' => $post['terms_and_conditions'],
        		'deal_price' => $post['deal_price'],
        		'original_price' => $post['original_price'],
        		'date_created' => date("Y-m-d H:i:s"),
        		'date_modified' => date("Y-m-d H:i:s")
        	];	

        	$offer_id = $this->Offers_model->create($offers_data);

        	$this->session->set_userdata('offerId', $offer_id);

        	$json_data = [
				'is_success' => true,
				'err_msg' => ''
			];
        }

		echo json_encode($json_data);
	}

}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */