<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promote extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'Create Deal';
		$this->page_data['page']->menu = false;

		$this->load->model('DealsSteals_model');
		$this->load->model('Users_model');    
        $this->load->model('Clients_model');          
        $this->load->model('Customer_model');
        $this->load->model('CustomerGroup_model');
	}

	public function deals(){
		$this->load->view('promote/deals', $this->page_data);
	}

	public function create_deals(){
		add_css(array(
            "assets/plugins/dropzone/dist/dropzone.css",
        ));
        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
        ));

		$this->load->view('promote/add_deals', $this->page_data);
	}

	public function ajax_save_deals_steals(){
		$is_success = true;
		$err_msg = '';

		$post = $this->input->post(); 
		$user = $this->session->userdata('logged');
		$data = [
			'user_id' => $user['id'],
			'title' => $post['title'],
			'description' => $post['description'],
			'terms_conditions' => $post['terms'],
			'deal_price' => $post['price'],
			'original_price' => $post['price_original'],			
			'date_created' => date("Y-m-d H:i:s"),
			'date_modified' => date("Y-m-d H:i:s")
		];

		$deals_steals_id = $this->DealsSteals_model->create($data);
        $this->session->set_userdata('dealsStealsId', $deals_steals_id);

		$json_data = ['is_success' => $is_success, 'err_msg' => $err_msg];
		echo json_encode($json_data);
	}

	public function add_send_to(){
		$user = $this->session->userdata('logged');
        $cid  = logged('company_id');
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        $dealsSteals = $this->DealsSteals_model->getById($deals_steals_id);
        $customers   = $this->Customer_model->getAllByCompany($cid);            
        $customerGroups = $this->CustomerGroup_model->getAllByCompany($cid);

        $selectedGroups = array();
        $selectedCustomer = array();
        $selectedExcludes = array();
        
        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->page_data['selectedCustomer'] = $selectedCustomer;
        $this->page_data['selectedGroups']   = $selectedGroups;
        $this->page_data['selectedExcludes'] = $selectedExcludes;
        $this->page_data['emailCampaign'] = $emailCampaign;
        $this->page_data['emailSendTo'] = $emailSendTo;
        $this->page_data['customers'] = $customers;
        $this->page_data['customerGroups'] = $customerGroups;
        $this->load->view('promote/add_send_to', $this->page_data);
	}

	public function create_send_to()
    {       
        $json_data = [
            'is_success' => true,
            'err_msg' => 'Cannot save data'
        ];

        $post = $this->input->post(); 
        $deals_steals_id = $this->session->userdata('dealsStealsId');
                
        $data_exclude_groups  = array();
        $data_customers       = array();
        $data_customer_groups = arraY();
        if( $post['to_type'] == 3 ){
                //Use optionB data    
                if( isset($post['optionB']['customer_id']) ){
                    foreach( $post['optionB']['customer_id'] as $key => $value ){
                    	$data_customers[] = $value;
                    }
                }
                

        }elseif( $post['to_type'] == 2 ){
                //Use optionC data
                if(isset($post['optionC']['customer_group_id'])){
                    foreach( $post['optionC']['customer_group_id'] as $key => $value ){
                    	$data_customer_groups[] = $value;
                    }
                }
        }

        if( isset($post['optionA']['exclude_customer_group_id']) ){
        	foreach( $post['optionA']['exclude_customer_group_id'] as $key => $value ){
            	$data_exclude_groups[] = $value;
            }
        }

        $data_setting = [
            'customer_type' => $post['optionA']['customer_type_service'],
            'sending_type' => $post['to_type'],
            'certain_customers' => serialize($data_customers),
            'certain_groups' => serialize($data_customer_groups),
            'exclude_customer_groups' => serialize($data_exclude_groups)
        ];

        $dealsSteals = $this->DealsSteals_model->updateDealsSteals($deals_steals_id, $data_setting);

        echo json_encode($json_data);
    }

    public function build_email(){
        $user = $this->session->userdata('logged');
        $cid  = logged('company_id');
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        $dealsSteals  = $this->DealsSteals_model->getById($deals_steals_id);
        $company      = $this->Clients_model->getById($cid);

        $this->page_data['company'] = $company;
        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->load->view('promote/build_email', $this->page_data);
    }

    public function create_email_message()
    {
        $json_data = [
                'is_success' => false,
                'err_msg' => 'Cannot save data'
        ];


        $post = $this->input->post(); 
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        $data = [
            'email_subject' => $post['email_subject'],
            'email_body' => $post['email_body']
        ];
        $emailBlast= $this->DealsSteals_model->updateDealsSteals($deals_steals_id,$data);

        $json_data = [
                'is_success' => true,
                'err_msg' => ''
        ];

        echo json_encode($json_data);

    }

    public function preview_email_message()
    {
    	echo 4;exit;
        $this->load->helper('functions');

        $cid  = logged('company_id');
        $email_blast_id = $this->session->userdata('emailBlastId');

        $emailBlast = $this->EmailBlast_model->getById($email_blast_id);
        if( $emailBlast->sending_type == $this->EmailBlast_model->sendingTypeAll() ){
            $customers   = $this->Customer_model->getAllByCompany($cid);  
            $total_recipients = count($customers);
        }else{
            $emailRecipients = $this->EmailBlastSendTo_model->getAllByEmailBlastId($email_blast_id);            
            $total_recipients = count($emailRecipients);     
        }
        

        $price_per_email = $this->EmailBlast_model->getPricePerEmail();
        $total_email_price = $total_recipients * $price_per_sms;
        $sendToOptions = $this->EmailBlast_model->sendToOptions();

        $this->page_data['send_to'] = $sendToOptions[$emailBlast->sending_type];
        $this->page_data['emailCampaign'] = $emailBlast;
        $this->page_data['total_email_price'] = $total_sms_price;
        $this->page_data['total_recipients'] = $total_recipients;
        $this->page_data['price_per_email'] = $price_per_email;
        $this->load->view('promote/preview_email_message', $this->page_data);
    }

}

/* End of file Promote.php */
/* Location: ./application/controllers/Promote.php */