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
		$this->load->model('Business_model');
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

		$post  = $this->input->post(); 
		$user  = $this->session->userdata('logged');
		$photo = $this->upload_photo();
		$data = [
			'user_id' => $user['id'],
			'title' => $post['title'],
			'description' => $post['description'],
			'terms_conditions' => $post['terms'],
			'deal_price' => $post['price'],
			'original_price' => $post['price_original'],
			'photos' => $photo,			
			'date_created' => date("Y-m-d H:i:s"),
			'date_modified' => date("Y-m-d H:i:s")
		];

		$deals_steals_id = $this->DealsSteals_model->create($data);
        $this->session->set_userdata('dealsStealsId', $deals_steals_id);

		$json_data = ['is_success' => $is_success, 'err_msg' => $err_msg];
		echo json_encode($json_data);
	}

	public function upload_photo(){

		$comp_id = logged('company_id');
		$target_dir = "./uploads/deals_steals/$comp_id/";
		
		if(!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}

		$tmp_name = $_FILES['image']['tmp_name'];
		$extension = strtolower(end(explode('.',$_FILES['image']['name'])));
		// basename() may prevent filesystem traversal attacks;
		// further validation/sanitation of the filename may be appropriate
		$name = basename($_FILES["image"]["name"]);
		move_uploaded_file($tmp_name, "./uploads/deals_steals/$comp_id/$name");
		return $name;
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
        $company      = $this->Business_model->getByCompanyId($cid);

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
        $this->load->helper('functions');

        $cid  = logged('company_id');
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        $dealsSteals = $this->DealsSteals_model->getById($deals_steals_id);
        
        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->load->view('promote/preview_email_message', $this->page_data);
    }

    public function generate_preview(){
        $post = $this->input->post(); 
        $cid  = logged('company_id');

        $subject = $post['email_subject'];
        $message = $post['email_body'];

        $company = $this->Business_model->getByCompanyId($cid);

        $this->page_data['message'] = replaceSmartTags($message);
        $this->page_data['subject'] = $subject;
        $this->page_data['company'] = $company;
        $this->load->view('promote/preview_email', $this->page_data);
    }

}

/* End of file Promote.php */
/* Location: ./application/controllers/Promote.php */