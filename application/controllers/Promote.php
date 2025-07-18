<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promote extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'Deals & Steals';
		$this->page_data['page']->menu = false;

		$this->load->model('DealsSteals_model');
		$this->load->model('Users_model');    
		$this->load->model('Business_model');
        $this->load->model('Clients_model');          
        $this->load->model('Customer_model');
        $this->load->model('CustomerGroup_model');
	}

	public function deals()
    {        
        $company_id  = logged('company_id');

        $filter = 'All Deals';

        if( get('filter') ){
            switch (get('filter')) {
                case 'active':
                    $status_value = 1;
                    $filter = 'Active Deals';
                    break;
                case 'scheduled':
                    $status_value = 2;
                    $filter = 'Scheduled Deals';
                    break;
                case 'ended':
                    $status_value = 3;
                    $filter = 'Ended Deals';
                    break;
                case 'draft':
                    $status_value = 0;
                    $filter = 'Draft Deals';
                    break;
                default:
                    $status_value = 1;
                    $filter = 'Active Deals';
                    break;
            }
            $conditions[] = ['field' => 'deals_steals.status', 'value' => $status_value];
            $dealsSteals = $this->DealsSteals_model->getAllByCompanyId($company_id, [], $conditions);
        }else{
            $dealsSteals = $this->DealsSteals_model->getAllByCompanyId($company_id, [], []);
        }        
        
        $activeSummaryDeals = $this->DealsSteals_model->activeSummaryDealsByCompanyId($company_id);
        $statusOptions = $this->DealsSteals_model->statusOptions();

        $this->page_data['dealsSteals']      = $dealsSteals;
        $this->page_data['activeSummaryDeals'] = $activeSummaryDeals;
        $this->page_data['statusOptions']    = $statusOptions;
        $this->page_data['filter']           = $filter;
 		$this->page_data['status_active']    = $this->DealsSteals_model->statusActive();                
        $this->page_data['status_scheduled'] = $this->DealsSteals_model->statusScheduled();
        $this->page_data['status_ended']     = $this->DealsSteals_model->statusEnded();
        $this->page_data['status_draft']     = $this->DealsSteals_model->statusDraft();
        $this->page_data['status_expired']   = $this->DealsSteals_model->statusExpired();
        $this->page_data['dealStealPrice']   = $this->DealsSteals_model->dealStealPrice();
        $this->page_data['page']->title = 'Deals & Steals';
        $this->page_data['page']->parent = 'Marketing';
		$this->load->view('v2/pages/promote/deals', $this->page_data);
	}

	public function create_deals()
    {		
        $this->session->unset_userdata('dealsStealsId');

        $this->page_data['enable_deals_steals'] = true;
		$this->load->view('v2/pages/promote/add_deals', $this->page_data);
	}

	public function ajax_save_deals_steals()
    {
		$is_success = true;
		$err_msg = '';

		$post    = $this->input->post(); 
		$user_id = logged('id');
        $company_id = logged('company_id');

        if( $post['price_deal'] > $post['price_original'] ){
            $err_msg = 'Deal price must be less than or equal to original price';
            $is_success = false;
        }

        if( $is_success ){
            if($this->session->userdata('dealsStealsId')){
                $deals_id    = $this->session->userdata('dealsStealsId');
                $dealsSteals = $this->DealsSteals_model->getById($deals_id);
                if( $_FILES['image']['tmp_name'] != '' ){
                    $photo = $this->upload_photo();
                }else{
                    $photo = $dealsSteals->photos;
                }
                
                $data = [
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'terms_conditions' => $post['terms'],
                    'deal_price' => $post['price_deal'],
                    'original_price' => $post['price_original'],
                    'photos' => $photo,
                    'views_count' => 0,
                    'is_expired' => 'No',
                    'date_modified' => date("Y-m-d H:i:s"),                    
                ];
                $dealsSteals = $this->DealsSteals_model->updateDealsSteals($deals_id, $data);
                $is_success = true;
            }else{
                $photo = $this->upload_photo();
                $data = [
                    'company_id' => $company_id,
                    'user_id' => $user_id,
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'terms_conditions' => $post['terms'],
                    'deal_price' => $post['price_deal'],
                    'original_price' => $post['price_original'],
                    'photos' => $photo,         
                    'valid_from' => date("Y-m-d"),
                    'valid_to' => date("Y-m-d", strtotime("+1 month")),
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'status' => $this->DealsSteals_model->statusDraft()
                ];

                $deals_steals_id = $this->DealsSteals_model->create($data);
                $this->session->set_userdata('dealsStealsId', $deals_steals_id);
                $is_success = true;
            }
        }        

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

	public function add_send_to()
    {		
        $company_id  = logged('company_id');
        $deals_steals_id = $this->session->userdata('dealsStealsId');        
        $dealsSteals     = $this->DealsSteals_model->getById($company_id);
        if( $dealsSteals && $dealsSteals->company_id == $company_id && $dealsSteals->status == $this->DealsSteals_model->statusDraft() ){
            $customers   = $this->Customer_model->getAllByCompany($company_id);            
            $customerGroups = $this->CustomerGroup_model->getAllByCompany($company_id);

            $selectedExcludes  = unserialize($dealsSteals->exclude_customer_groups);
            $selectedCustomers = unserialize($dealsSteals->certain_customers);
            $selectedGroups    = unserialize($dealsSteals->certain_groups);

            $this->page_data['dealsSteals'] = $dealsSteals;
            $this->page_data['selectedCustomers'] = $selectedCustomers;
            $this->page_data['selectedGroups']    = $selectedGroups;
            $this->page_data['selectedExcludes']  = $selectedExcludes;
            $this->page_data['emailCampaign'] = $emailCampaign;
            $this->page_data['emailSendTo'] = $emailSendTo;
            $this->page_data['customers'] = $customers;
            $this->page_data['customerGroups'] = $customerGroups;
            $this->page_data['enable_deals_steals'] = true;
            $this->load->view('v2/pages/promote/add_send_to', $this->page_data);
        }else{
            redirect('promote/deals'); 
        }
	}

	public function create_send_to()
    {       
        $is_success = true;
		$err_msg = '';

        $post = $this->input->post(); 
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        if( $deals_steals_id <= 0 ){
            $is_success = false;
            $err_msg = 'Cannot find data';
        } 

        if( $is_success ){
            $data_exclude_groups  = [];
            $data_customers       = [];
            $data_customer_groups = [];
            if( $post['to_type'] == 3 ){
                //Use optionB data    
                if( isset($post['optionB']['customer_id']) ){
                    foreach( $post['optionB']['customer_id'] as $key => $value ){
                        $data_customers[$value] = $value;
                    }
                }
            }elseif( $post['to_type'] == 2 ){
                //Use optionC data
                if(isset($post['optionC']['customer_group_id'])){
                    foreach( $post['optionC']['customer_group_id'] as $key => $value ){
                        $data_customer_groups[$value] = $value;
                    }
                }
            }

            if( isset($post['optionA']['exclude_customer_group_id']) ){
                foreach( $post['optionA']['exclude_customer_group_id'] as $key => $value ){
                    $data_exclude_groups[$value] = $value;
                }
            }

            $data_setting = [
                'customer_type' => $post['optionC']['customer_type_service'],
                'sending_type' => $post['to_type'],
                'certain_customers' => serialize($data_customers),
                'certain_groups' => serialize($data_customer_groups),
                'exclude_customer_groups' => serialize($data_exclude_groups)
            ];

            $dealsSteals = $this->DealsSteals_model->updateDealsSteals($deals_steals_id, $data_setting);
        }

        $json_data = ['is_success' => $is_success, 'err_msg' => $err_msg];
		echo json_encode($json_data);
    }

    public function build_email()
    {
        $company_id  = logged('company_id');
        $deals_steals_id = $this->session->userdata('dealsStealsId');
        $dealsSteals     = $this->DealsSteals_model->getById($deals_steals_id);
        if( $dealsSteals && $dealsSteals->company_id == $company_id && $dealsSteals->status == $this->DealsSteals_model->statusDraft() ){
            $company      = $this->Business_model->getByCompanyId($company_id);
            $this->page_data['company'] = $company;
            $this->page_data['dealsSteals'] = $dealsSteals;
            $this->page_data['enable_deals_steals'] = true;
            $this->load->view('v2/pages/promote/build_email', $this->page_data);
        }else{
            redirect('promote/deals'); 
        }        
    }

    public function create_email_message()
    {
        $is_success = true;
		$err_msg = '';

        $post = $this->input->post(); 
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        if( $deals_steals_id <= 0 ){
            $is_success = false;
            $err_msg = 'Cannot find data';
        } 

        if( $is_success ){
            $data = [
                'email_subject' => $post['email_subject'],
                'email_body' => $post['email_body']
            ];
            $dealsSteals = $this->DealsSteals_model->updateDealsSteals($deals_steals_id,$data);
        }

        $json_data = ['is_success' => $is_success, 'err_msg' => $err_msg];
		echo json_encode($json_data);
    }

    public function preview_email_message()
    {
        $this->load->helper('functions');

        $company_id  = logged('company_id');
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        $dealsSteals = $this->DealsSteals_model->getById($deals_steals_id);
        if( $dealsSteals && $dealsSteals->company_id != $company_id && $dealsSteals->status != 0 ){
            redirect('promote/deals');
        }

        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->page_data['deals_price'] = $this->DealsSteals_model->dealStealPrice();
        $this->page_data['enable_deals_steals'] = true;
        $this->load->view('v2/pages/promote/preview_email_message', $this->page_data);
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
        $this->load->view('v2/pages/promote/preview_email', $this->page_data);
    }

    public function ajax_update_validity(){
    	$is_success = true;
		$err_msg = '';

        $post = $this->input->post(); 
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        if( $deals_steals_id <= 0 ){
            $is_success = false;
            $err_msg = 'Cannot find data';
        }elseif( strtotime($post['valid_from']) > strtotime($post['valid_to']) ){
            $is_success = false;
            $err_msg = 'Invalid valid from and to date. Valid from should be less than or equal to valid to date.';
        }
        
        if( $is_success ){
            $data = [
                'valid_from' => date("Y-m-d",strtotime($post['valid_from'])),
                'valid_to' => date("Y-m-d",strtotime($post['valid_to']))
            ];

            $dealsSteals = $this->DealsSteals_model->updateDealsSteals($deals_steals_id,$data);
        }
        

        $json_data = ['is_success' => $is_success, 'err_msg' => $err_msg];
		echo json_encode($json_data);
    }

    public function payment()
    {
    	$company_id  = logged('company_id');        
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        $dealsSteals = $this->DealsSteals_model->getById($deals_steals_id);

        if( $dealsSteals && $dealsSteals->company_id != $company_id && $dealsSteals->status != 0 ){        
            redirect('promote/deals');
        }
        
        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->page_data['deals_price'] = $this->DealsSteals_model->dealStealPrice();
        $this->page_data['enable_deals_steals'] = true;
        $this->load->view('v2/pages/promote/payment', $this->page_data);
    }

    public function ajax_activate_deals()
    {
        $this->load->model('Clients_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->helper('converge_payment_helper');

    	$is_success = false;
        $msg = '';        
        
        $post = $this->input->post();
        $company_id = logged('company_id');
        $client     = $this->Clients_model->getById($company_id);
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        if( $deals_steals_id > 0 && $client ){
            $address    = $company->street.' '.$company->city.' '.$company->state;
            $zip_code   = $company->postal_code;
            $total_cost = $this->DealsSteals_model->dealStealPrice();
            $paymentData = [
                'amount' => $total_cost,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code,
            ];
            $paymentResult = convergeSendSale($paymentData);
            if( $paymentResult['is_success'] ){
                $dealsSteals = $this->DealsSteals_model->getById($deals_steals_id);
                $data = [
                    'status' => $this->DealsSteals_model->statusActive(), 
                    'total_cost' => $total_cost, 
                    'date_activated' => date("Y-m-d"), 
                    'date_expiration' => date("Y-m-d", strtotime('+1 month'))
                ];
                $this->DealsSteals_model->updateDealsSteals($dealsSteals->id,$data);

                // Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'payment_id' => $paymentResult['ssl_txn_id'],
                    'payment_api' => $this->CompanySubscriptionPayments_model->paymentApiConverge(),
                    'transaction_type' => $this->CompanySubscriptionPayments_model->transactionTypeDealsSteals(),
                    'description' => 'Deals Steals : ' . $dealsSteals->title,
                    'payment_date' => date('Y-m-d'),
                    'total_amount' => $total_cost,
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);

                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $is_success = true;
                $msg = 'Deals Steals was successfully activated.';

                //Activity Logs
                $activity_name = 'Deals Steals : Activated deals ' . $dealsSteals->title; 
                createActivityLog($activity_name);

            }else{
                $is_success = false;
                $msg = $paymentResult['msg'];
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_load_deals_list($status){
    	$company_id = logged('company_id');
        if( $status == 'all' ){
            $conditions = array();
        }else{
            $conditions[] = ['field' => 'deals_steals.status','value' => $status];    
        }      
        $dealsSteals   = $this->DealsSteals_model->getAllByCompanyId($company_id, array(), $conditions);
        $statusOptions = $this->DealsSteals_model->statusOptions();
        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['status_selected']  = $status; 
        $this->page_data['status_active']    = $this->DealsSteals_model->statusActive();                
        $this->page_data['status_scheduled'] = $this->DealsSteals_model->statusScheduled();
        $this->page_data['status_ended']     = $this->DealsSteals_model->statusEnded();
        $this->page_data['status_draft']     = $this->DealsSteals_model->statusDraft();
        $this->load->view('promote/ajax_load_deals_list', $this->page_data);
    }

    public function ajax_load_deals_list_v2($status){
    	$company_id = logged('company_id');
        if( $status == 'all' ){
            $conditions = array();
        }else{
            $conditions[] = ['field' => 'deals_steals.status','value' => $status];    
        }      
        $dealsSteals   = $this->DealsSteals_model->getAllByCompanyId($company_id, array(), $conditions);
        $statusOptions = $this->DealsSteals_model->statusOptions();
        $this->page_data['dealsSteals'] = $dealsSteals;
        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['status_selected']  = $status; 
        $this->page_data['status_active']    = $this->DealsSteals_model->statusActive();                
        $this->page_data['status_scheduled'] = $this->DealsSteals_model->statusScheduled();
        $this->page_data['status_ended']     = $this->DealsSteals_model->statusEnded();
        $this->page_data['status_draft']     = $this->DealsSteals_model->statusDraft();
        $this->load->view('v2/pages/promote/ajax_load_deals_list', $this->page_data);
    }

    public function ajax_load_status_counter(){
    	$company_id = logged('company_id');

        $dealsAll = $this->DealsSteals_model->getAllByCompanyId($company_id, array(), array());

        $conditions[0] = ['field' => 'deals_steals.status','value' => $this->DealsSteals_model->statusScheduled()];
        $dealsScheduled = $this->DealsSteals_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'deals_steals.status','value' => $this->DealsSteals_model->statusActive()];
        $dealsActive = $this->DealsSteals_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'deals_steals.status','value' => $this->DealsSteals_model->statusEnded()];
        $dealsEnded = $this->DealsSteals_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'deals_steals.status','value' => $this->DealsSteals_model->statusDraft()];
        $dealsDraft = $this->DealsSteals_model->getAllByCompanyId($company_id, array(), $conditions);

        $json_data = [
            'total_email' => count($dealsAll),
            'total_scheduled' => count($dealsScheduled),
            'total_active' => count($dealsActive),
            'total_ended' => count($dealsEnded),
            'total_draft' => count($dealsDraft)
        ];

        echo json_encode($json_data);
    }

    public function ajax_close_deal(){
        $is_success = 0;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post(); 
        $dealsSteals = $this->DealsSteals_model->getById($post['deal_id']);
        if( $dealsSteals ){
            if($dealsSteals->company_id == $company_id){
                $data = ['status' => $this->DealsSteals_model->statusEnded()];
                $this->DealsSteals_model->updateDealsSteals($post['deal_id'], $data);

                $is_success = 1;
                $msg = 'Deals was successfully updated';
            }else{
                $msg = 'Record not found';
            }            
        }else{
            $msg = 'Record not found';
        }
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ]; 

        echo json_encode($json_data);
    }

    public function edit_deals($id)
    {
        $company_id = logged('company_id');
        $dealSteals = $this->DealsSteals_model->getById($id);
        if( $dealSteals && $dealSteals->company_id == $company_id && $dealSteals->status == $this->DealsSteals_model->statusDraft() ){
            $this->session->set_userdata('dealsStealsId', $dealSteals->id);

            $this->page_data['dealSteals'] = $dealSteals;
            $this->page_data['enable_deals_steals'] = true;
            $this->load->view('v2/pages/promote/edit_deals', $this->page_data);
        }else{
           redirect('promote/deals'); 
        }
    }

    public function ajax_delete_deal()
    {
        $is_success = 0;
        $msg = '';

        $post = $this->input->post(); 
        $company_id = logged('company_id');
        $dealSteals = $this->DealsSteals_model->getById($post['deal_id']);

        if( $company_id == $dealSteals->company_id ){
            $this->DealsSteals_model->deleteById($post['deal_id']);
            $is_success = 1;    
        }else{
            $msg = 'Cannot find data';
        }
        

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ]; 

        echo json_encode($json_data);
    }

    public function ajax_send_payment(){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('CardsFile_model');        
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('Clients_model');  

        $is_success = false;
        $msg = '';
        $order_number = '';

        $post  = $this->input->post(); 
        $user  = $this->session->userdata('logged');
        $company_id = logged('company_id');        
        $deals_steals_id = $this->session->userdata('dealsStealsId');

        $ccFile = $this->CardsFile_model->getById($post['payment_method_token']);
        if( $ccFile->company_id === $company_id ){

            $dealsSteals = $this->DealsSteals_model->getById($deals_steals_id);
            $company     = $this->Business_model->getByCompanyId($company_id);
            $client      = $this->Clients_model->getById($company_id);

            //$exp_date =  $data['exp_month'] . date("y",strtotime($data['exp_year']));
            $company_address  = $company->street . " " . $company->city . " " . $company->state;
            $company_zip      = $company->postal_code;
            $expiration_month =  str_pad($ccFile->expiration_month, 2, '0', STR_PAD_LEFT);             
            $exp_date =  $expiration_month . $ccFile->expiration_year;            

            $converge = new \wwwroth\Converge\Converge([
                'merchant_id' => CONVERGE_MERCHANTID,
                'user_id' => CONVERGE_MERCHANTUSERID,
                'pin' => CONVERGE_MERCHANTPIN,
                'demo' => true,
            ]);

            $createSale = $converge->request('ccsale', [
                'ssl_card_number' => $ccFile->card_number,
                'ssl_exp_date' => $exp_date,
                'ssl_cvv2cvc2' => $ccFile->card_cvv,
                'ssl_first_name' => $client->first_name,
                'ssl_last_name' => $client->last_name,
                'ssl_amount' => $this->DealsSteals_model->dealStealPrice(),
                'ssl_avs_address' => $company_address,
                'ssl_avs_zip' => $company_zip,
            ]);

            if( $createSale['success'] == 1 ){
                //Create payment data
                $data = [
                    'user_id' => $user['id'],
                    'order_number' => '',
                    'payment_method' => $this->MarketingOrderPayments_model->paymentMethodCC(),
                    'date_paid' => date("Y-m-d H:i:s"),
                    'status' => $this->MarketingOrderPayments_model->statusCompleted(),
                ];

                $order_id     = $this->MarketingOrderPayments_model->create($data);
                $order_number = $this->MarketingOrderPayments_model->generateORNumber($order_id);
                
                $data = ['order_number' => $order_number];
                $this->MarketingOrderPayments_model->updateOrderPayment($order_id, $data);

                $is_success = true;
                $msg = '';
            }else{
                $msg = $createSale['errorMessage'];
            }
        }else{
            $msg = 'Invalid credit card number';
        }

        $return = ['is_success' => $is_success, 'order_number' => $order_number, 'msg' => $msg];
        
        echo json_encode($return);
    }

    public function payment_details(){

        $this->load->model('MarketingOrderPayments_model');

        $company_id = logged('company_id');   

        $deals_steals_id = $this->session->userdata('dealsStealsId');
        $dealsSteals     = $this->DealsSteals_model->getById($deals_steals_id);
        $company         = $this->Business_model->getByCompanyId($company_id);
        if( $dealsSteals ){
            if( $dealsSteals->order_number != '' ){
                $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($dealsSteals->order_number);

                $this->page_data['dealsSteals']   = $dealsSteals;
                $this->page_data['orderPayments'] = $orderPayments;
                $this->page_data['company'] = $company;
                $this->load->view('promote/payment_details', $this->page_data);        
            }else{
                redirect('promote/deals');
            }
        }else{
            redirect('promote/deals');
        }
    }

    public function deals_invoice_pdf($id){

        $this->load->model('MarketingOrderPayments_model');
        
        $dealsSteals = $this->DealsSteals_model->getById($id);
        $company     = $this->Business_model->getByCompanyId($dealsSteals->company_id);
        $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($dealsSteals->order_number);
        $this->page_data['dealsSteals']   = $dealsSteals;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $content = $this->load->view('promote/deals_customer_invoice_pdf_template_a', $this->page_data, TRUE);  
            
        $this->load->library('Reportpdf');

        $title = 'deals_invoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);        
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        //echo $display;
        $content = ob_get_contents();
        ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output($title, 'I');
    }

    public function view_deals($id){
        $this->load->model('MarketingOrderPayments_model');
        
        $dealsSteals = $this->DealsSteals_model->getById($id);
        $company     = $this->Business_model->getByCompanyId($dealsSteals->company_id);
        $orderPayments = $this->MarketingOrderPayments_model->getByOrderNumber($dealsSteals->order_number);
        $statusOptions = $this->DealsSteals_model->statusOptions();

        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['dealsSteals']   = $dealsSteals;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $this->page_data['page']->tab = 'Preview Deals';
        $this->load->view('v2/pages/promote/view_deals', $this->page_data);    
    }

    public function view_booking($booking_id){
        $this->load->model('DealsBookings_model');
        
        $booking = $this->DealsBookings_model->getById($booking_id);
        $this->page_data['booking'] = $booking;
        $this->load->view('promote/view_booking', $this->page_data);    
    }

    public function bookings($id){
        $this->load->model('DealsBookings_model');

        $company_id = logged('company_id');

        $dealsSteals = $this->DealsSteals_model->getById($id);
        if( $dealsSteals && $dealsSteals->company_id == $company_id ){
            $bookings    = $this->DealsBookings_model->getAllByDealsId($dealsSteals->id);        

            $this->page_data['dealsSteals'] = $dealsSteals;
            $this->page_data['bookings'] = $bookings;
            $this->page_data['page']->tab = 'Bookings';
            $this->load->view('v2/pages/promote/bookings', $this->page_data); 
        }else{
            redirect('promote/deals');
        }
    }

    public function view_deals_payment($id){
        $this->load->model('MarketingOrderPayments_model');

        $orderPayments = $this->MarketingOrderPayments_model->getById($id);
        $dealsSteals   = $this->DealsSteals_model->getByOrderNumber($orderPayments->order_number);
        $company       = $this->Business_model->getByCompanyId($dealsSteals->company_id);
        $statusOptions = $this->DealsSteals_model->statusOptions();

        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['dealsSteals']   = $dealsSteals;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $this->load->view('promote/view_payment_details', $this->page_data);     
    }

    public function deals_order_pdf($id){

        $this->load->model('MarketingOrderPayments_model');
        
        $dealsSteals = $this->DealsSteals_model->getById($id);
        $company     = $this->Business_model->getByCompanyId($dealsSteals->company_id);
        $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($dealsSteals->order_number);
        $this->page_data['dealsSteals']   = $dealsSteals;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $content = $this->load->view('promote/deals_customer_order_pdf_template_a', $this->page_data, TRUE);  
            
        $this->load->library('Reportpdf');

        $title = 'deals_order';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);        
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        //echo $display;
        $content = ob_get_contents();
        ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output($title, 'I');
    }

    public function ajax_view_deals_steals()
    {
        $post = $this->input->post();
        $company_id  = logged('company_id');

        $dealsSteals = $this->DealsSteals_model->getById($post['deal_id']);
        if( $dealsSteals && $dealsSteals->company_id == $company_id ){
            $this->page_data['dealsSteals'] = $dealsSteals;
            $this->load->view('v2/pages/promote/ajax_view_deals_steals', $this->page_data);
        }
    }

    public function ajax_reactivate_deal()
    {
        $this->load->model('Clients_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->helper('converge_payment_helper');

    	$is_success = false;
        $msg = 'Invalid data';        
        
        $post = $this->input->post();
        $company_id  = logged('company_id');
        $client      = $this->Clients_model->getById($company_id);
        $dealsSteals = $this->DealsSteals_model->getById($post['deal_id']);

        if( ($dealsSteals && $dealsSteals->company_id == $company_id) && $client ){
            $address    = $company->street.' '.$company->city.' '.$company->state;
            $zip_code   = $company->postal_code;
            $total_cost = $this->DealsSteals_model->dealStealPrice();
            $paymentData = [
                'amount' => $total_cost,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code,
            ];
            $paymentResult = convergeSendSale($paymentData);
            if( $paymentResult['is_success'] ){
                $data = [
                    'status' => $this->DealsSteals_model->statusActive(), 
                    'total_cost' => $total_cost, 
                    'date_activated' => date("Y-m-d"), 
                    'date_expiration' => date("Y-m-d", strtotime('+1 month')),
                    'is_expired' => 'No'
                ];
                $this->DealsSteals_model->updateDealsSteals($dealsSteals->id,$data);

                // Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'payment_id' => $paymentResult['ssl_txn_id'],
                    'payment_api' => $this->CompanySubscriptionPayments_model->paymentApiConverge(),
                    'transaction_type' => $this->CompanySubscriptionPayments_model->transactionTypeDealsSteals(),
                    'description' => 'Deals Steals : ' . $dealsSteals->title,
                    'payment_date' => date('Y-m-d'),
                    'total_amount' => $total_cost,
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);

                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $is_success = true;
                $msg = 'Deals Steals was successfully activated.';

                //Activity Logs
                $activity_name = 'Deals Steals : Activated deals ' . $dealsSteals->title; 
                createActivityLog($activity_name);

            }else{
                $is_success = false;
                $msg = $paymentResult['msg'];
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_selected()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post(); 
        $company_id = logged('company_id');

        $filter[]   = ['field' => 'company_id', 'value' => $company_id];
        $dealSteals = $this->DealsSteals_model->bulkDelete($post['deals'], $filter);

        //Activity Logs
        $activity_name = 'Deals Steals : Deleted ' .count($post['deals']). ' deal(s)'; 
        createActivityLog($activity_name);

        $is_success = 1;
        $msg = '';

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ]; 

        echo json_encode($json_data);
    }
}
/* End of file Promote.php */
/* Location: ./application/controllers/Promote.php */