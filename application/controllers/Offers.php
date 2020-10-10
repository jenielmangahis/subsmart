<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Offers extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();
        $this->load->model('Offers_model');
		$this->load->model('OffersRecipients_model');	
		$this->load->model('Users_model');		
		$this->load->model('Customer_model');
		$this->load->model('CustomerGroup_model');
		$this->page_data['page']->title = 'Offers';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	
		$offers_draft_list = $this->Offers_model->getAllDraft();
        $offers_active_list = $this->Offers_model->getAllActive();
        $offers_inactive_list = $this->Offers_model->getAllInactive();
        $offers_ended_list = $this->Offers_model->getAllEnded();

        $this->page_data['offers_draft_list'] = $offers_draft_list;
        $this->page_data['offers_active_list'] = $offers_active_list;
        $this->page_data['offers_inactive_list'] = $offers_inactive_list;
        $this->page_data['offers_ended_list'] = $offers_ended_list;

		$this->load->view('offers/index', $this->page_data);
	}

	public function add_offer()
	{
		$this->session->unset_userdata('offerId');
		$this->load->view('offers/add_offer', $this->page_data);
	}

    public function edit_offer($id)
    {   
        $offer = $this->Offers_model->getById($id);
        $this->session->set_userdata('offerId', $id);
        $this->page_data['offer'] = $offer;
        $this->session->unset_userdata('offerId');
        $this->load->view('offers/edit_offer', $this->page_data);
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
        		'status' => 1,
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

    public function update_draft_offer()
    {   
        $json_data = [
            'is_success' => false,
            'err_msg' => 'Please enter Title'
        ];

        $post = $this->input->post(); 

        if( $post['title'] != '' ){
            $user = $this->session->userdata('logged');
            $offer_id = $this->session->userdata('offerId');
            $offers_data = [
                'user_id' => $user['id'],
                'title' => $post['title'],
                'description' => $post['description'],
                'terms_and_conditions' => $post['terms_and_conditions'],
                'deal_price' => $post['deal_price'],
                'original_price' => $post['original_price'],
                'status' => $post['status'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];  

            $offer_id = $this->Offers_model->updateOffers($offer_id,$offers_data);

            $json_data = [
                'is_success' => true,
                'err_msg' => ''
            ];
        }

        echo json_encode($json_data);
    }

	public function add_offer_send_to()
	{
		$user = $this->session->userdata('logged');
		$cid  = logged('company_id');
		
		$customers = $this->Customer_model->getAllByCompanyWithEmail($cid);
		$customerGroups = $this->CustomerGroup_model->getAllByCompany($cid);

		$this->page_data['customers'] = $customers;
		$this->page_data['customerGroups'] = $customerGroups;
		$this->load->view('offers/add_offer_send_to', $this->page_data);
	}

	public function save_offer_send_to_settings()
    {       
            $json_data = [
                    'is_success' => false,
                    'err_msg' => 'Please enter Title'
            ];

            $post = $this->input->post(); 
            $offer_id = $this->session->userdata('offerId');

            if( $post['to_type'] == 1 ){
                    //Use optionA data
                    $data_offers = [
                            'customer_type' => 1
                    ];

                    $offers = $this->Offers_model->updateOffers($offer_id,$data_offers);

                    $json_data = [
                            'is_success' => true,
                            'err_msg' => ''
                    ];

            }elseif( $post['to_type'] == 2 ){
                    //Use optionB data              
                    $data_offers = [
                            'customer_type' => 2
                           
                    ];
                    $offers = $this->Offers_model->updateOffers($offer_id,$data_offers);

                    $data_send_to = array();
                    if(isset($post['customer_group_id'])){
                            foreach( $post['customer_group_id'] as $key => $value ){
                                    $data_send_to = [
                                            'offer_id ' => $offer_id,
                                            'customer_id' => 0,
                                            'customer_group_id' => $value,
                                            'date_created' => date("Y-m-d H:i:s"),
                                            'date_modified' => date("Y-m-d H:i:s")
                                    ];

                                    $offersRecipients = $this->OffersRecipients_model->create($data_send_to);
                            }
                    }

                   
                    $json_data = [
                            'is_success' => true,
                            'err_msg' => ''
                    ];

            }elseif( $post['to_type'] == 3 ){
                    //Use optionC data
                     $data_offers = [
                            'customer_type' => 3
                    ];

                    $offers = $this->Offers_model->updateOffers($offer_id,$data_offers);

                    $data_send_to = array();
                    if(isset($post['customer_id'])){
                            foreach( $post['customer_id'] as $key => $value ){
                                    $data_send_to = [
                                            'offer_id ' => $offer_id,
                                            'customer_id' => $value,
                                            'customer_group_id' => 0,
                                            'date_created' => date("Y-m-d H:i:s"),
                                            'date_modified' => date("Y-m-d H:i:s")
                                    ];

                                    $offersRecipients = $this->OffersRecipients_model->create($data_send_to);
                                   
                            }
                    }


                 

                    $json_data = [
                            'is_success' => true,
                            'err_msg' => ''
                    ];
            }

            echo json_encode($json_data);
    }


    public function build_email()
	{
		$user = $this->session->userdata('logged');
		$cid  = logged('company_id');
			
		$this->load->view('offers/build_email', $this->page_data);
	}


	public function save_offer_build_email()
    {       
            $json_data = [
                    'is_success' => false,
                    'err_msg' => 'Please enter Title'
            ];

            $post = $this->input->post(); 
            $offer_id = $this->session->userdata('offerId');
            if($offer_id){
                    $data_offers = [
                        'subject' => post('subject'),
        				'email_body' => post('email_body'),
                    ];

                    $offers = $this->Offers_model->updateOffers($offer_id,$data_offers);

                    $json_data = [
                            'is_success' => true,
                            'err_msg' => ''
                    ];
            }
           
            echo json_encode($json_data);
    }


    public function email_preview()
    {
    	$user = $this->session->userdata('logged');
		$cid  = logged('company_id');
		$offer_id = $this->session->userdata('offerId');

		$offers = $this->Offers_model->getById($offer_id);

		$this->page_data['offers'] = $offers;	
		$this->load->view('offers/email_preview', $this->page_data);
    }


}



/* End of file Comapny.php */

/* Location: ./application/controllers/offers.php */