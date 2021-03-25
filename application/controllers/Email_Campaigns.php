<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Email_Campaigns extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();

        $this->load->model('EmailBlast_model');
        $this->load->model('Users_model');    
        $this->load->model('Clients_model');          
        $this->load->model('Customer_model');
        $this->load->model('CustomerGroup_model');
        $this->load->model('EmailBlastSendTo_model');

		$this->page_data['page']->title = 'Email Campaigns';

		$this->page_data['page']->menu = '';	

	}

	public function index(){	

		$this->load->view('email_campaigns/index', $this->page_data);

	}

	public function add_email_blast(){

        $this->session->unset_userdata('emailBlastId');
        $this->load->view('email_campaigns/add_email_blast', $this->page_data);
    }

    public function create_draft_campaign(){       
        $is_success = false;
        $msg = '';

        $post = $this->input->post(); 
        if($this->session->userdata('emailBlastId')){
            $email_blast_id   = $this->session->userdata('emailBlastId');
            $email_blast_data = ['campaign_name' => $post['email_camapaign_name']];
            $smsBlast = $this->EmailBlast_model->updateEmailBlast($email_blast_id, $email_blast_data);
            $is_success = true;
        }else{
            if( $post['email_camapaign_name'] != '' ){
                $user = $this->session->userdata('logged');

                $email_blast_data = [
                        'user_id' => $user['id'],
                        'campaign_name' => $post['email_camapaign_name'],
                        'email_body' => '',
                        'email_subject' => '',
                        'sending_type' => $this->EmailBlast_model->sendingTypeAll(),
                        'status' => $this->EmailBlast_model->statusDraft(),
                        'customer_type' => $this->EmailBlast_model->customerTypeResidential(),
                        'created' => date("Y-m-d H:i:s")
                ];      

                $email_id = $this->EmailBlast_model->create($email_blast_data);
                $this->session->set_userdata('emailBlastId', $email_id);
                $is_success = true;
            }else{
            	$msg = 'Cannot create email blast';
            }
        }

        $json_data = [
                'is_success' => $is_success,
                'err_msg' => $msg
        ];
        

        echo json_encode($json_data);
    }

    public function add_campaign_send_to(){
        $user = $this->session->userdata('logged');
        $cid  = logged('company_id');
        $email_blast_id = $this->session->userdata('emailBlastId');

        $emailCampaign = $this->EmailBlast_model->getById($email_blast_id);
        $emailSendTo   = $this->EmailBlastSendTo_model->getAllByEmailBlastId($emailCampaign->id);
        $customers   = $this->Customer_model->getAllByCompany($cid);            
        $customerGroups = $this->CustomerGroup_model->getAllByCompany($cid);

        $selectedGroups = array();
        $selectedCustomer = array();
        $selectedExcludes = array();
        foreach($emailSendTo as $et){
            if( $et->customer_group_id > 0 ){
                $selectedGroups[$et->customer_group_id] = $et->customer_group_id;
            }

            if( $et->customer_id > 0 ){
                $selectedCustomer[$et->customer_id] = $et->customer_id;
            }

            if( $et->exclude > 0 ){
                $selectedExcludes[$et->exclude] = $et->exclude;
            }
            
        }

        $this->page_data['selectedCustomer'] = $selectedCustomer;
        $this->page_data['selectedGroups']   = $selectedGroups;
        $this->page_data['selectedExcludes'] = $selectedExcludes;
        $this->page_data['emailCampaign'] = $emailCampaign;
        $this->page_data['emailSendTo'] = $emailSendTo;
        $this->page_data['customers'] = $customers;
        $this->page_data['customerGroups'] = $customerGroups;
        $this->load->view('email_campaigns/add_campaign_send_to', $this->page_data);
    }

    public function create_campaign_send_to()
    {       
        $json_data = [
            'is_success' => false,
            'err_msg' => 'Cannot save data'
        ];

        $post = $this->input->post(); 
        $email_blast_id = $this->session->userdata('emailBlastId');
        
        $data_setting = [
            'customer_type' => $post['optionA']['customer_type_service'],
            'sending_type' => $post['to_type']
        ];

        $emailBlast = $this->EmailBlast_model->updateEmailBlast($email_blast_id, $data_setting);
        $this->EmailBlastSendTo_model->deleteAllByEmailBlastId($email_blast_id);

        if( $post['to_type'] == 1 ){
                //Use optionA data
                $data_send_to = array();
                if( !empty($post['optionA']['exclude_customer_group_id']) ){
                        foreach( $post['optionA']['exclude_customer_group_id'] as $key => $value ){
                                $data_send_to = [
                                        'email_blast_id' => $email_blast_id,
                                        'customer_id' => 0,
                                        'customer_group_id' => $value,
                                        'exclude' => 1
                                ];

                                $emailBlastSendTo = $this->EmailBlastSendTo_model->create($data_send_to);
                        }       
                }

                $json_data = [
                        'is_success' => true,
                        'err_msg' => ''
                ];

        }elseif( $post['to_type'] == 3 ){
                //Use optionB data    
                $data_send_to = array();
                if( isset($post['optionB']['customer_id']) ){
                    foreach( $post['optionB']['customer_id'] as $key => $value ){
                            $data_send_to = [
                                    'email_blast_id' => $email_blast_id,
                                    'customer_id' => $value,
                                    'customer_group_id' => 0,
                                    'exclude' => 0
                            ];

                            $emailBlastSendTo = $this->EmailBlastSendTo_model->create($data_send_to);
                    }

                    $json_data = [
                            'is_success' => true,
                            'err_msg' => ''
                    ];   
                }else{
                    $json_data = [
                            'is_success' => false,
                            'err_msg' => 'Please select customer'
                    ];
                }
                

        }elseif( $post['to_type'] == 2 ){
                //Use optionC data
                $data_send_to = array();
                if(isset($post['optionC']['customer_group_id'])){
                        foreach( $post['optionC']['customer_group_id'] as $key => $value ){
                                $data_send_to = [
                                        'email_blast_id' => $email_blast_id,
                                        'customer_id' => 0,
                                        'customer_group_id' => $value,
                                        'exclude' => 0
                                ];

                                $emailBlastSendTo = $this->EmailBlastSendTo_model->create($data_send_to);
                        }
                }

                $json_data = [
                        'is_success' => true,
                        'err_msg' => ''
                ];
        }

        echo json_encode($json_data);
    }

    public function build_email(){
        $user = $this->session->userdata('logged');
        $cid  = logged('company_id');
        $email_blast_id = $this->session->userdata('emailBlastId');

        $emailCampaign  = $this->EmailBlast_model->getById($email_blast_id);
        $company        = $this->Clients_model->getById($cid);

        $this->page_data['company'] = $company;
        $this->page_data['emailCampaign'] = $emailCampaign;
        $this->load->view('email_campaigns/build_email', $this->page_data);
    }
}



/* End of file Email_Campaigns.php */

/* Location: ./application/controllers/Email_Campaigns.php */