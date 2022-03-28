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
        $this->page_data['page']->title = 'Email Blast';
        $this->page_data['page']->parent = 'Marketing';

        $this->page_data['status_active'] = $this->EmailBlast_model->statusActive();                
        $this->page_data['status_scheduled'] = $this->EmailBlast_model->statusScheduled();
        $this->page_data['status_closed']    = $this->EmailBlast_model->statusClosed();
        $this->page_data['status_draft']     = $this->EmailBlast_model->statusDraft();
		$this->load->view('v2/pages/email_campaigns/index', $this->page_data);

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
                        'cards_file_id' => 0,
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

        $message = str_replace("{{customer.name}}", 'John Doe', $message);
        $message = str_replace("{{customer.first_name}}", 'John', $message);
        $message = str_replace("{{customer.last_name}}", 'Doe', $message);
        $message = str_replace("{{business.email}}", $company->email_address, $message);
        $message = str_replace("{{business.phone}}", $company->phone_number, $message);
        $message = str_replace("{{business.name}}", $company->business_name, $message);

        return $message;
    }

    public function create_email_message()
    {
        $json_data = [
                'is_success' => false,
                'err_msg' => 'Cannot save data'
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
            'total_cost' => $total_email_price,
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
        $this->load->model('CardsFile_model');
        $this->load->helper('functions');     

        $cid  = logged('company_id');   
        $email_blast_id = $this->session->userdata('emailBlastId');

        $emailBlast = $this->EmailBlast_model->getById($email_blast_id);

        $emailRecipients = $this->EmailBlastSendTo_model->getAllByEmailBlastId($email_blast_id);
        $total_recipients = count($emailRecipients); 

        $price_per_email = $this->EmailBlast_model->getPricePerEmail();
        $total_email_price = $total_recipients * $price_per_email;

        $creditCards = $this->CardsFile_model->getAllByCompanyId($cid);

        $this->page_data['creditCards'] = $creditCards;
        $this->page_data['emailBlast'] = $emailBlast;
        $this->page_data['total_recipients'] = $total_recipients;
        $this->page_data['total_price'] = $price_per_email;
        $this->load->view('email_campaigns/payment', $this->page_data);
    }

    public function activate_automation(){
        $this->load->model('CardsFile_model');
        $this->load->model('Clients_model');
        $this->load->model('MarketingOrderPayments_model');

        $is_success = false;
        $msg = '';

        $cid  = logged('company_id');
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( isset($post['payment_method_token']) ){
            $email_blast_id = $this->session->userdata('emailBlastId');
            $emailBlast = $this->EmailBlast_model->getById($email_blast_id);
            if( $emailBlast ){
                $creditCard = $this->CardsFile_model->getById($post['payment_method_token']);
                if( $creditCard && $creditCard->company_id == $cid ){
                    $company = $this->Clients_model->getById($creditCard->company_id);

                    $total_cost       = $this->EmailBlast_model->getPricePerEmail();
                    $expiration_month =  str_pad($creditCard->expiration_month, 2, '0', STR_PAD_LEFT);             
                    $exp_date         =  $expiration_month . $creditCard->expiration_year;
                    $data_cc = [
                        'card_number' => $creditCard->card_number,
                        'exp_date' => $exp_date,
                        'cvc' => $creditCard->card_cvv,
                        'ssl_first_name' => $company->first_name,
                        'ssl_last_name' => $company->last_name,
                        'ssl_amount' => $total_cost,
                        'ssl_address' => $company->business_address,
                        'ssl_zip' => $company->zip_code
                    ];
                    $result_payment = $this->convergePayment($data_cc);
                    if( $result_payment['is_success'] === 1 ){
                        $data = ['status' => $this->EmailBlast_model->statusActive(), 'total_cost' => $total_cost, 'is_paid' => 1, 'cards_file_id' => $post['payment_method_token']];
                        $this->EmailBlast_model->updateEmailBlast($email_blast_id,$data);

                        $date_paid = date("Y-m-d H:i:s");
                        //Create payment data
                        $data = [
                            'user_id' => $user['id'],
                            'order_number' => '',
                            'payment_method' => $this->MarketingOrderPayments_model->paymentMethodCC(),
                            'date_paid' => $date_paid,
                            'status' => $this->MarketingOrderPayments_model->statusCompleted(),
                        ];

                        $order_id     = $this->MarketingOrderPayments_model->create($data);
                        $order_number = $this->MarketingOrderPayments_model->generateORNumber($order_id);
                        
                        $data = ['order_number' => $order_number];
                        $this->MarketingOrderPayments_model->updateOrderPayment($order_id, $data);

                        //Attach order number
                        $data = ['order_number' => $order_number, 'date_paid' => $date_paid];
                        $this->EmailBlast_model->updateEmailBlast($email_blast_id,$data);

                        $is_success = true;
                        $msg = 'Email automation was successfully activated.';
                    }else{
                        $msg = $result_payment['msg'];
                    }
                }else{
                    $msg = 'Cannot find data';
                }
            }else{
                $msg = 'Cannot find data';
            }  
        }else{
            $msg = 'Please select credit card';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
        
    }

    public function ajax_load_campaigns($status){
        $company_id = logged('company_id');
        if( $status == 'all' ){
            $conditions = array();
        }else{
            $conditions[] = ['field' => 'email_blast.status','value' => $status];    
        }        
        
        $emailBlast      = $this->EmailBlast_model->getAllByCompanyId($company_id, array(), $conditions);
        $sendToOptions = $this->EmailBlast_model->sendToOptions();
        $statusOptions = $this->EmailBlast_model->statusOptions();
        $status_draft  = $this->EmailBlast_model->statusDraft();
        
        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['sendToOptions'] = $sendToOptions;
        $this->page_data['emailBlast']    = $emailBlast;
        $this->page_data['status_draft']  = $status_draft;
        $this->load->view('v2/pages/email_campaigns/ajax_load_campaigns', $this->page_data);
    }

    public function ajax_load_email_campaign_counter(){
        $company_id = logged('company_id');

        $emailAll = $this->EmailBlast_model->getAllByCompanyId($company_id, array(), array());

        $conditions[0] = ['field' => 'email_blast.status','value' => $this->EmailBlast_model->statusScheduled()];
        $smsScheduled = $this->EmailBlast_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'email_blast.status','value' => $this->EmailBlast_model->statusActive()];
        $smsActive = $this->EmailBlast_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'email_blast.status','value' => $this->EmailBlast_model->statusClosed()];
        $smsClosed = $this->EmailBlast_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'email_blast.status','value' => $this->EmailBlast_model->statusDraft()];
        $smsDraft = $this->EmailBlast_model->getAllByCompanyId($company_id, array(), $conditions);

        $json_data = [
            'total_email' => count($emailAll),
            'total_scheduled' => count($smsScheduled),
            'total_active' => count($smsActive),
            'total_closed' => count($smsClosed),
            'total_draft' => count($smsDraft)
        ];

        echo json_encode($json_data);
    }

    public function edit_email_campaign($id){
        $company_id = logged('company_id');
        $emailCampaign = $this->EmailBlast_model->getById($id);
        $this->session->unset_userdata('emailBlastId');
        if( $emailCampaign ){
            if( $emailCampaign->company_id == $company_id ){

                $this->session->set_userdata('emailBlastId', $emailCampaign->id);
                $this->page_data['emailCampaign'] = $emailCampaign;
                $this->load->view('email_campaigns/edit_email_blast', $this->page_data);
            }else{
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
                redirect('email_campaigns');
            }
        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('email_campaigns');
        }
    }

    public function ajax_clone_campaign(){
        $is_success = 0;
        $msg    = '';
        $email_id = 0;

        $post     = $this->input->post(); 
        $emailBlast = $this->EmailBlast_model->getById($post['emailid']);
        if( $emailBlast ){
            $data = (array)$emailBlast;
            unset($data['id']);
            unset($data['uid']);
            unset($data['company_id']);
            $email_id     = $this->EmailBlast_model->create($data);
            if( $email_id > 0 ){
                $emailSendTo = $this->EmailBlastSendTo_model->getAllByEmailBlastId($post['emailid']);
                foreach($emailSendTo as $st){
                    $data_send_to = (array)$st;
                    unset($data_send_to['id']);
                    $data_send_to['email_blast_id'] = $email_id;

                    $smsBlastSendTo = $this->EmailBlastSendTo_model->create($data_send_to);
                }
                
                $is_success = 1;
                $msg = 'Email Campaign was successfully updated';
            }else{
                $msg = 'Record not found';
            }
            
        }else{
            $msg = 'Record not found';
        }
        $json_data = [
            'email_id' => $email_id,
            'is_success' => $is_success,
            'msg' => $msg
        ]; 

        echo json_encode($json_data);
    }

    public function ajax_close_campaign(){
        $is_success = 0;
        $msg = '';

        $post     = $this->input->post(); 
        $emailBlast = $this->EmailBlast_model->getById($post['emailid']);
        if( $emailBlast ){
            $data = ['status' => $this->EmailBlast_model->statusClosed()];
            $this->EmailBlast_model->updateEmailBlast($post['smsid'], $data);

            $is_success = 1;
            $msg = 'Email Campaign was successfully updated';
        }else{
            $msg = 'Record not found';
        }
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ]; 

        echo json_encode($json_data);
    }

    public function convergePayment( $data ){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $msg = '';
        $is_success = 0;

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $createSale = $converge->request('ccsale', [
            'ssl_card_number' => $data['card_number'],
            'ssl_exp_date' => $data['exp_date'],
            'ssl_cvv2cvc2' => $data['cvc'],
            'ssl_first_name' => $data['ssl_first_name'],
            'ssl_last_name' => $data['ssl_last_name'],
            'ssl_amount' => $data['ssl_amount'],
            'ssl_avs_address' => $data['ssl_address'],
            'ssl_avs_zip' => $data['ssl_zip'],
        ]);

        if( $createSale['success'] == 1 ){
            $is_success = 1;
        }else{
            $msg = $createSale['errorMessage'];
        }
        
        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function payment_details(){

        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');

        $company_id      = logged('company_id');
        $email_blast_id  = $this->session->userdata('emailBlastId');
        $emailBlast      = $this->EmailBlast_model->getById($email_blast_id);
        $company         = $this->Business_model->getByCompanyId($company_id);
        if( $emailBlast ){
            if( $emailBlast->order_number != '' ){
                $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($emailBlast->order_number);

                $this->page_data['emailBlast']   = $emailBlast;
                $this->page_data['orderPayments'] = $orderPayments;
                $this->page_data['company'] = $company;
                $this->load->view('email_campaigns/payment_details', $this->page_data);        
            }else{
                redirect('email_campaigns');
            }
        }else{
            redirect('email_campaigns');
        }
    }

    public function invoice_pdf($id){

        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');
        
        $emailBlast = $this->EmailBlast_model->getById($id);
        $company  = $this->Business_model->getByCompanyId($emailBlast->company_id);
        $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($emailBlast->order_number);
        $this->page_data['emailBlast']   = $emailBlast;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $content = $this->load->view('email_campaigns/campaign_customer_invoice_pdf_template_a', $this->page_data, TRUE);  
            
        $this->load->library('Reportpdf');

        $title = 'email_campaign_invoice';

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

    public function view_campaign($id){
        $this->load->model('MarketingOrderPayments_model');
        
        $emailCampaign = $this->EmailBlast_model->getById($id);
        $orderPayments = $this->MarketingOrderPayments_model->getByOrderNumber($emailCampaign->order_number);
        $statusOptions = $this->EmailBlast_model->statusOptions();

        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['emailCampaign']   = $emailCampaign;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->load->view('email_campaigns/view_campaign', $this->page_data);    
    }

    public function view_payment($id){
        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');

        $orderPayments = $this->MarketingOrderPayments_model->getById($id);
        $emailCampaign   = $this->EmailBlast_model->getByOrderNumber($orderPayments->order_number);
        $company       = $this->Business_model->getByCompanyId($smsCampaign->company_id);
        $statusOptions = $this->EmailBlast_model->statusOptions();

        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['emailCampaign']   = $emailCampaign;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $this->load->view('email_campaigns/view_payment_details', $this->page_data);     
    }

    public function order_pdf($id){

        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');
        
        $emailBlast    = $this->EmailBlast_model->getById($id);
        $company     = $this->Business_model->getByCompanyId($emailBlast->company_id);
        $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($emailBlast->order_number);
        $this->page_data['emailBlast']   = $emailBlast;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $content = $this->load->view('email_campaigns/campaign_customer_order_pdf_template_a', $this->page_data, TRUE);  
            
        $this->load->library('Reportpdf');

        $title = 'campaign_order';

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
}



/* End of file Email_Campaigns.php */

/* Location: ./application/controllers/Email_Campaigns.php */