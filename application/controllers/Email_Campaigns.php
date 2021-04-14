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

    public function generate_preview(){
        $post = $this->input->post(); 
        $cid  = logged('company_id');

        $subject = $post['email_subject'];
        $message = $post['email_body'];
        $company = $this->Clients_model->getById($cid);

        $this->page_data['message'] = $this->replaceSmartTags($message);
        $this->page_data['subject'] = $subject;
        $this->page_data['company'] = $company;
        $this->load->view('email_campaigns/preview_email', $this->page_data);
    }

    public function replaceSmartTags($message){
        $cid  = logged('company_id');
        $company = $this->Clients_model->getById($cid);

        $message = str_replace("{{customer.name}}", $company->first_name . ' ' . $company->last_name, $message);
        $message = str_replace("{{business.email}}", $company->email_address, $message);
        $message = str_replace("{{business.phone}}", $company->phone_number, $message);
        $message = str_replace("{{business.name}}", $company->business_name, $message);

        return $message;
    }

    public function create_email_message()
    {
        $json_data = [
                'is_success' => false,
                'err_msg' => 'Please enter Campaign Name'
        ];


        $post = $this->input->post(); 
        $email_blast_id = $this->session->userdata('emailBlastId');

        $data = [
            'email_subject' => $post['email_subject'],
            'email_body' => $post['email_body']
        ];
        $emailBlast= $this->EmailBlast_model->updateEmailBlast($email_blast_id,$data);

        $json_data = [
                'is_success' => true,
                'err_msg' => ''
        ];

        echo json_encode($json_data);

    }

    public function preview_email_message()
    {
        $this->load->helper('functions');
        $email_blast_id = $this->session->userdata('emailBlastId');

        $emailBlast = $this->EmailBlast_model->getById($email_blast_id);

        $emailRecipients = $this->EmailBlastSendTo_model->getAllByEmailBlastId($email_blast_id);
        $total_recipients = count($emailRecipients); 

        $price_per_email = $this->EmailBlast_model->getPricePerEmail();
        $total_email_price = $total_recipients * $price_per_sms;
        $sendToOptions = $this->EmailBlast_model->sendToOptions();

        $this->page_data['send_to'] = $sendToOptions[$emailBlast->sending_type];
        $this->page_data['emailBlast'] = $emailBlast;
        $this->page_data['total_email_price'] = $total_sms_price;
        $this->page_data['total_recipients'] = $total_recipients;
        $this->page_data['price_per_email'] = $price_per_email;
        $this->load->view('email_campaigns/preview_email_message', $this->page_data);
    }

    public function create_send_schedule(){
        $is_success = 1;
        $msg = '';

        $post = $this->input->post(); 
        $email_blast_id = $this->session->userdata('emailBlastId');

        if( isset($post['is_scheduled']) ){
            $send_date = date("Y-m-d",strtotime($post['send_date']));
        }else{
            $send_date = date("Y-m-d");
        }

        $emailRecipients = $this->EmailBlastSendTo_model->getAllByEmailBlastId($email_blast_id);
        $total_recipients = count($emailRecipients); 

        $price_per_email = $this->EmailBlast_model->getPricePerEmail();
        $total_email_price = $total_recipients * $price_per_email;

        $price_variables = [
            'price_per_email' => $price_per_email,
            'total_email_price' => $total_email_price
        ];

        $data = [
            'price_variables' => serialize($price_variables),
            'send_date' => $send_date,
            'total_price' => $total_email_price,
            'status' => $this->EmailBlast_model->statusScheduled(),
            'is_paid' => 0,
            'is_sent' => 0
        ];

        $smsBlast = $this->EmailBlast_model->updateEmailBlast($email_blast_id,$data);


        $msg = "Sms campaign was successfully saved.";
        $json_data = [
                'is_success' => $is_success,
                'msg' => $msg
        ];

        echo json_encode($json_data);

    }

    public function payment(){
        $this->load->helper('functions');
        $email_blast_id = $this->session->userdata('emailBlastId');

        $emailBlast = $this->EmailBlast_model->getById($email_blast_id);

        $emailRecipients = $this->EmailBlastSendTo_model->getAllByEmailBlastId($email_blast_id);
        $total_recipients = count($emailRecipients); 

        $price_per_email = $this->EmailBlast_model->getPricePerEmail();
        $total_email_price = $total_recipients * $price_per_email;

        $this->page_data['emailBlast'] = $emailBlast;
        $this->page_data['price_per_email'] = $price_per_email;
        $this->page_data['total_recipients'] = $total_recipients;
        $this->load->view('email_campaigns/payment', $this->page_data);
    }
}



/* End of file Email_Campaigns.php */

/* Location: ./application/controllers/Email_Campaigns.php */