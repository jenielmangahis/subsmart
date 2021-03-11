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
                
                $customers = $this->Customer_model->getAllByCompanyWithMobile($cid);            
                $customerGroups = $this->CustomerGroup_model->getAllByCompany($cid);

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

                $post = $this->input->post(); 
                
                $sms_blast_id = $this->session->userdata('smsBlastId');

                if( $post['to_type'] == 1 ){
                        //Use optionA data
                        $data_setting = [
                                'sms_blast_id' => $sms_blast_id,
                                'customer_type' => $post['optionA']['customer_type_service'],
                                'sending_type' => $post['to_type']
                        ];

                        $smsBlastSettingId = $this->SmsBlastSetting_model->create($data_setting);

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

                }elseif( $post['to_type'] == 2 ){
                        //Use optionB data              
                        $data_setting = [
                                'sms_blast_id' => $sms_blast_id,
                                'customer_type' => $post['optionC']['customer_type_service'],
                                'sending_type' => $post['to_type']
                        ];

                        $smsBlastSettingId = $this->SmsBlastSetting_model->create($data_setting);

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

                }elseif( $post['to_type'] == 3 ){
                        //Use optionC data
                        $data_setting = [
                                'sms_blast_id' => $sms_blast_id,
                                'customer_type' => $post['optionC']['customer_type_service'],
                                'sending_type' => $post['to_type']
                        ];

                        $smsBlastSettingId = $this->SmsBlastSetting_model->create($data_setting);

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
            $json_data = [
                    'is_success' => false,
                    'err_msg' => 'Please enter Campaign Name'
            ];


            $post = $this->input->post(); 
            $sms_blast_id = $this->session->userdata('smsBlastId');

            if( isset($post['is_scheduled']) ){
                $send_date = $post['send_date'];
                $send_time = date("H:i:s",strtotime($post['send_date'] . " " . $post['send_time']));
            }else{
                $send_date = date("Y-m-d");
                $send_time = date("H:i:s");
            }

            $service_price = $this->SmsBlast_model->getServicePrice();
            $price_per_sms = $this->SmsBlast_model->getPricePerSms();
            $total_sms_price = $total_recipients * $price_per_sms;
            $grand_total     = $total_sms_price + $service_price;

            $data = [
                'price_variables' => $price_variables,
                'send_date' => $send_date,
                'send_time' => $send_time,
                'total_price' => $total_price,
                'is_paid' => 0,
                'is_sent' => 0
            ];
            $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id,$data);

            $json_data = [
                    'is_success' => true,
                    'err_msg' => ''
            ];

            echo json_encode($json_data);

        }
}



/* End of file Sms_Campaigns.php */

/* Location: ./application/controllers/Sms_Campaigns.php */