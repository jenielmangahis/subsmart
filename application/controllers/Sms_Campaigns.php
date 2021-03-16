<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sms_Campaigns extends MY_Controller {



        public function __construct()
        {
                parent::__construct();

                $this->load->model('SmsBlast_model');
                $this->load->model('Users_model');              
                $this->load->model('Customer_model');
                $this->load->model('CustomerGroup_model');
                $this->load->model('SmsBlastSetting_model');
                $this->load->model('SmsBlastSendTo_model');

                $this->page_data['page']->title = 'SMS Campaigns';
                $this->page_data['page']->menu = '';    

                add_css(array(
                    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
                    'assets/plugins/timepicker/bootstrap-timepicker.css',
                ));

                add_footer_js(array(
                    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
                    'assets/plugins/timepicker/bootstrap-timepicker.js'
                ));

        }

        public function index()
        {       
                $this->page_data['status_active'] = $this->SmsBlast_model->statusActive();                
                $this->page_data['status_scheduled'] = $this->SmsBlast_model->statusScheduled();
                $this->page_data['status_closed']    = $this->SmsBlast_model->statusClosed();
                $this->page_data['status_draft']     = $this->SmsBlast_model->statusDraft();
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
                if($this->session->userdata('smsBlastId')){
                    $sms_blast_id   = $this->session->userdata('smsBlastId');
                    $sms_blast_data = ['campaign_name' => $post['sms_camapaign_name']];
                    $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $sms_blast_data);
                }else{
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
                    } 
                }

                $json_data = [
                        'is_success' => true,
                        'err_msg' => ''
                ];
                

                echo json_encode($json_data);
        }

        public function add_campaign_send_to()
        {
                $user = $this->session->userdata('logged');
                $cid  = logged('company_id');
                $sms_blast_id = $this->session->userdata('smsBlastId');

                $smsCampaign = $this->SmsBlast_model->getById($sms_blast_id);
                $smsSendTo   = $this->SmsBlastSendTo_model->getAllBySmsBlastId($smsCampaign->id);
                $customers   = $this->Customer_model->getAllByCompanyWithMobile($cid);            
                $customerGroups = $this->CustomerGroup_model->getAllByCompany($cid);

                $selectedGroups = array();
                $selectedCustomer = array();
                $selectedExcludes = array();
                foreach($smsSendTo as $st){
                    if( $st->customer_group_id > 0 ){
                        $selectedGroups[$st->customer_group_id] = $st->customer_group_id;
                    }

                    if( $st->customer_id > 0 ){
                        $selectedCustomer[$st->customer_id] = $st->customer_id;
                    }

                    if( $st->exclude > 0 ){
                        $selectedExcludes[$st->exclude] = $st->exclude;
                    }
                    
                }

                $this->page_data['selectedCustomer'] = $selectedCustomer;
                $this->page_data['selectedGroups']   = $selectedGroups;
                $this->page_data['selectedExcludes'] = $selectedExcludes;
                $this->page_data['smsCampaign'] = $smsCampaign;
                $this->page_data['smsSendTo'] = $smsSendTo;
                $this->page_data['customers'] = $customers;
                $this->page_data['customerGroups'] = $customerGroups;
                $this->load->view('sms_campaigns/add_campaign_send_to', $this->page_data);
        }

        public function create_campaign_send_to()
        {       
                $json_data = [
                        'is_success' => false,
                        'err_msg' => 'Please enter Campaign Name'
                ];

                $post         = $this->input->post(); 
                $sms_blast_id = $this->session->userdata('smsBlastId');
                
                $data_setting = [
                    'customer_type' => $post['optionA']['customer_type_service'],
                    'sending_type' => $post['to_type']
                ];

                $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $data_setting);
                $this->SmsBlastSendTo_model->deleteAllBySmsBlastId($sms_blast_id);

                if( $post['to_type'] == 1 ){
                        //Use optionA data
                        $data_send_to = array();
                        if( !empty($post['optionA']['exclude_customer_group_id']) ){
                                foreach( $post['optionA']['exclude_customer_group_id'] as $key => $value ){
                                        $data_send_to = [
                                                'sms_blast_id' => $sms_blast_id,
                                                'customer_id' => 0,
                                                'customer_group_id' => $value,
                                                'exclude' => 1
                                        ];

                                        $smsBlastSendTo = $this->SmsBlastSendTo_model->create($data_send_to);
                                }       
                        }

                        $json_data = [
                                'is_success' => true,
                                'err_msg' => ''
                        ];

                }elseif( $post['to_type'] == 3 ){
                        //Use optionB data           
                        $   
                        $data_send_to = array();
                        foreach( $post['optionB']['customer_id'] as $key => $value ){
                                $data_send_to = [
                                        'sms_blast_id' => $sms_blast_id,
                                        'customer_id' => $value,
                                        'customer_group_id' => 0,
                                        'exclude' => 0
                                ];

                                $smsBlastSendTo = $this->SmsBlastSendTo_model->create($data_send_to);
                        }

                        $json_data = [
                                'is_success' => true,
                                'err_msg' => ''
                        ];

                }elseif( $post['to_type'] == 2 ){
                        //Use optionC data
                        $data_send_to = array();
                        if(isset($post['optionC']['customer_group_id'])){
                                foreach( $post['optionC']['customer_group_id'] as $key => $value ){
                                        $data_send_to = [
                                                'sms_blast_id' => $sms_blast_id,
                                                'customer_id' => 0,
                                                'customer_group_id' => $value,
                                                'exclude' => 0
                                        ];

                                        $smsBlastSendTo = $this->SmsBlastSendTo_model->create($data_send_to);
                                }
                        }

                        $json_data = [
                                'is_success' => true,
                                'err_msg' => ''
                        ];
                }

                echo json_encode($json_data);
        }

        public function build_sms()
        {
                $user = $this->session->userdata('logged');
                $cid  = logged('company_id');
                $sms_blast_id = $this->session->userdata('smsBlastId');
                $smsCampaign = $this->SmsBlast_model->getById($sms_blast_id);

                $this->page_data['smsCampaign'] = $smsCampaign;
                $this->load->view('sms_campaigns/build_sms', $this->page_data);
        }

        public function create_sms_message()
        {
                $json_data = [
                        'is_success' => false,
                        'err_msg' => 'Please enter Campaign Name'
                ];


                $post = $this->input->post(); 
                $sms_blast_id = $this->session->userdata('smsBlastId');

                $data = ['sms_text' => $post['sms_text']];
                $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id,$data);

                $json_data = [
                        'is_success' => true,
                        'err_msg' => ''
                ];

                echo json_encode($json_data);

        }

        public function preview_sms_message()
        {
            $this->load->helper('functions');
            $sms_blast_id = $this->session->userdata('smsBlastId');

            $smsBlast = $this->SmsBlast_model->getById($sms_blast_id);
            $sms_text = $smsBlast->sms_text;

            $smsRecipients = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms_blast_id);
            $total_recipients = count($smsRecipients); 

            $service_price = $this->SmsBlast_model->getServicePrice();
            $price_per_sms = $this->SmsBlast_model->getPricePerSms();
            $total_sms_price = $total_recipients * $price_per_sms;
            $grand_total     = $total_sms_price + $service_price;

            $this->page_data['smsBlast'] = $smsBlast;
            $this->page_data['grand_total'] = $grand_total;
            $this->page_data['total_sms_price'] = $total_sms_price;
            $this->page_data['total_recipients'] = $total_recipients;
            $this->page_data['service_price'] = $service_price;
            $this->page_data['price_per_sms'] = $price_per_sms;
            $this->page_data['sms_text'] = $sms_text;
            $this->load->view('sms_campaigns/preview_sms', $this->page_data);
        }

        public function create_send_schedule()
        {
            $is_success = 1;
            $msg = '';

            $post = $this->input->post(); 
            $sms_blast_id = $this->session->userdata('smsBlastId');

            if( isset($post['is_scheduled']) ){
                $send_date = date("Y-m-d",strtotime($post['send_date']));
                $send_time = date("H:i:s",strtotime($post['send_date'] . " " . $post['send_time']));
            }else{
                $send_date = date("Y-m-d");
                $send_time = date("H:i:s");
            }

            $service_price = $this->SmsBlast_model->getServicePrice();
            $price_per_sms = $this->SmsBlast_model->getPricePerSms();
            $total_sms_price = $total_recipients * $price_per_sms;
            $grand_total     = $total_sms_price + $service_price;

            $price_variables = [
                'service_price' => $service_price,
                'price_per_sms' => $price_per_sms,
                'total_sms_price' => $total_sms_price
            ];

            $data = [
                'price_variables' => serialize($price_variables),
                'send_date' => $send_date,
                'send_time' => $send_time,
                'total_price' => $total_price,
                'status' => $this->SmsBlast_model->statusScheduled(),
                'is_paid' => 0,
                'is_sent' => 0
            ];

            $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id,$data);


            $msg = "Sms campaign was successfully saved.";
            $json_data = [
                    'is_success' => $is_success,
                    'msg' => $msg
            ];

            echo json_encode($json_data);

        }

        public function ajax_load_campaigns($status){
            $company_id = logged('company_id');
            if( $status > 0 ){
                $conditions[] = ['field' => 'sms_blast.status','value' => $status];    
            }else{
                $conditions = array();
            }
            
            $smsBlast      = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);
            $sendToOptions = $this->SmsBlast_model->sendToOptions();
            $statusOptions = $this->SmsBlast_model->statusOptions();
            
            $this->page_data['statusOptions'] = $statusOptions;
            $this->page_data['sendToOptions'] = $sendToOptions;
            $this->page_data['smsBlast']      = $smsBlast;
            $this->load->view('sms_campaigns/ajax_load_campaigns', $this->page_data);
        }

        public function ajax_load_sms_campaign_counter(){
            $company_id = logged('company_id');

            $smsAll = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), array());

            $conditions[0] = ['field' => 'sms_blast.status','value' => $this->SmsBlast_model->statusScheduled()];
            $smsScheduled = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);

            $conditions[0] = ['field' => 'sms_blast.status','value' => $this->SmsBlast_model->statusActive()];
            $smsActive = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);

            $conditions[0] = ['field' => 'sms_blast.status','value' => $this->SmsBlast_model->statusClosed()];
            $smsClosed = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);

            $conditions[0] = ['field' => 'sms_blast.status','value' => $this->SmsBlast_model->statusDraft()];
            $smsDraft = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);

            $json_data = [
                'total_sms' => count($smsAll),
                'total_scheduled' => count($smsScheduled),
                'total_active' => count($smsActive),
                'total_closed' => count($smsClosed),
                'total_draft' => count($smsDraft)
            ];

            echo json_encode($json_data);
        }

        public function ajax_close_campaign(){
            $is_success = 0;
            $msg = '';

            $post     = $this->input->post(); 
            $smsBlast = $this->SmsBlast_model->getById($post['smsid']);
            if( $smsBlast ){
                $data = ['status' => $this->SmsBlast_model->statusClosed()];
                $this->SmsBlast_model->updateSmsBlast($post['smsid'], $data);

                $is_success = 1;
                $msg = 'SMS Campaign was successfully updated';
            }else{
                $msg = 'Record not found';
            }
            $json_data = [
                'is_success' => $is_success,
                'msg' => $msg
            ]; 

            echo json_encode($json_data);
        }

        public function edit_sms_campaign($id){
            $company_id = logged('company_id');
            $smsCampaign = $this->SmsBlast_model->getById($id);
            $this->session->unset_userdata('smsBlastId');
            if( $smsCampaign ){
                if( $smsCampaign->company_id == $company_id ){

                    $this->session->set_userdata('smsBlastId', $smsCampaign->id);
                    $this->page_data['smsCampaign'] = $smsCampaign;
                    $this->page_data['creditNoteItems'] = $creditNoteItems;

                    $this->load->view('sms_campaigns/edit_sms_blast', $this->page_data);
                }else{
                    $this->session->set_flashdata('message', 'Record not found.');
                    $this->session->set_flashdata('alert_class', 'alert-danger');
                    redirect('credit_notes');
                }
            }else{
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
                redirect('credit_notes');
            }
        }

        public function ajax_clone_campaign(){
            $is_success = 0;
            $msg    = '';
            $sms_id = 0;

            $post     = $this->input->post(); 
            $smsBlast = $this->SmsBlast_model->getById($post['smsid']);
            if( $smsBlast ){
                $data = (array)$smsBlast;
                unset($data['id']);
                unset($data['uid']);
                unset($data['company_id']);
                $sms_id     = $this->SmsBlast_model->create($data);
                if( $sms_id > 0 ){
                    $smsSendTo = $this->SmsBlastSendTo_model->getAllBySmsBlastId($post['smsid']);
                    foreach($smsSendTo as $st){
                        $data_send_to = (array)$st;
                        unset($data_send_to['id']);
                        $data_send_to['sms_blast_id'] = $sms_id;

                        $smsBlastSendTo = $this->SmsBlastSendTo_model->create($data_send_to);
                    }
                    
                    $is_success = 1;
                    $msg = 'SMS Campaign was successfully updated';
                }else{
                    $msg = 'Record not found';
                }
                
            }else{
                $msg = 'Record not found';
            }
            $json_data = [
                'sms_id' => $sms_id,
                'is_success' => $is_success,
                'msg' => $msg
            ]; 

            echo json_encode($json_data);
        }
}



/* End of file Sms_Campaigns.php */

/* Location: ./application/controllers/Sms_Campaigns.php */