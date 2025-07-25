<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Sms_Campaigns extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('SmsBlast_model');
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('Customer_model');
        $this->load->model('CustomerGroup_model');
        $this->load->model('SmsBlastSetting_model');
        $this->load->model('SmsBlastSendTo_model');

        $this->page_data['page']->title = 'SMS Blast';
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
        $this->page_data['page']->title = 'SMS Blast';
        $this->page_data['page']->parent = 'Marketing';

        $this->page_data['status_active'] = $this->SmsBlast_model->statusActive();
        $this->page_data['status_scheduled'] = $this->SmsBlast_model->statusScheduled();
        $this->page_data['status_closed']    = $this->SmsBlast_model->statusClosed();
        $this->page_data['status_draft']     = $this->SmsBlast_model->statusDraft();
        $this->load->view('v2/pages/sms_campaigns/index', $this->page_data);
    }

    public function add_sms_blast()
    {
        $this->session->unset_userdata('smsBlastId');
        $this->load->view('v2/pages/sms_campaigns/add_sms_blast', $this->page_data);
    }

    public function create_draft_campaign()
    {
        $json_data = [
            'is_success' => false,
            'err_msg' => 'Please enter Campaign Name'
        ];

        $post = $this->input->post();
        if ($this->session->userdata('smsBlastId')) {
            $sms_blast_id   = $this->session->userdata('smsBlastId');
            $sms_blast_data = ['campaign_name' => $post['sms_camapaign_name']];
            $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $sms_blast_data);
        } else {
            if ($post['sms_camapaign_name'] != '') {
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
        foreach ($smsSendTo as $st) {
            if ($st->customer_group_id > 0) {
                $selectedGroups[$st->customer_group_id] = $st->customer_group_id;
            }

            if ($st->customer_id > 0) {
                $selectedCustomer[$st->customer_id] = $st->customer_id;
            }

            if ($st->exclude > 0) {
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
        //$this->load->view('sms_campaigns/add_campaign_send_to', $this->page_data);
        $this->load->view('v2/pages/sms_campaigns/add_campaign_send_to', $this->page_data);
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

        if ($post['to_type'] == 1) {
            //Use optionA data
            $data_send_to = array();
            if (!empty($post['optionA']['exclude_customer_group_id'])) {
                foreach ($post['optionA']['exclude_customer_group_id'] as $key => $value) {
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
        } elseif ($post['to_type'] == 3) {
            //Use optionB data    
            $data_send_to = array();
            if (isset($post['optionB']['customer_id'])) {
                foreach ($post['optionB']['customer_id'] as $key => $value) {
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
            } else {
                $json_data = [
                    'is_success' => false,
                    'err_msg' => 'Please select customer'
                ];
            }
        } elseif ($post['to_type'] == 2) {
            //Use optionC data
            $data_send_to = array();
            if (isset($post['optionC']['customer_group_id'])) {
                foreach ($post['optionC']['customer_group_id'] as $key => $value) {
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

        $company = $this->Clients_model->getById($cid);

        $this->page_data['company'] = $company;
        $this->page_data['smsCampaign'] = $smsCampaign;
        $this->load->view('v2/pages/sms_campaigns/build_sms', $this->page_data);
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
        $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $data);

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
        $this->load->view('v2/pages/sms_campaigns/preview_sms', $this->page_data);
    }

    public function create_send_schedule()
    {
        $is_success = 1;
        $msg = '';

        $post = $this->input->post();
        $sms_blast_id = $this->session->userdata('smsBlastId');

        if (isset($post['is_scheduled'])) {
            $send_date = date("Y-m-d", strtotime($post['send_date']));
            $send_time = date("H:i:s", strtotime($post['send_date'] . " " . $post['send_time']));
        } else {
            $send_date = date("Y-m-d");
            $send_time = date("H:i:s");
        }

        $smsRecipients = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms_blast_id);
        $total_recipients = count($smsRecipients);

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
            'total_price' => $grand_total,
            'status' => $this->SmsBlast_model->statusScheduled(),
            'is_paid' => 0,
            'is_sent' => 0
        ];

        $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $data);


        $msg = "Sms campaign was successfully saved.";
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_load_campaigns($status)
    {
        $company_id = logged('company_id');
        if ($status == 'all') {
            $conditions = array();
        } else {
            $conditions[] = ['field' => 'sms_blast.status', 'value' => $status];
        }

        $filters = array();
        $get_data     = $this->input->get();        
        if($get_data['search_key'] != 'na') {
            $filters['search'] = $get_data['search_key'];
        }        

        $smsBlast      = $this->SmsBlast_model->getAllByCompanyId($company_id, $filters, $conditions);
        $sendToOptions = $this->SmsBlast_model->sendToOptions();
        $statusOptions = $this->SmsBlast_model->statusOptions();
        $status_draft  = $this->SmsBlast_model->statusDraft();


        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['sendToOptions'] = $sendToOptions;
        $this->page_data['smsBlast']      = $smsBlast;
        $this->page_data['status_draft']  = $status_draft;

        // $this->load->view('sms_campaigns/ajax_load_campaigns', $this->page_data);
        $this->load->view('v2/pages/sms_campaigns/load_campaigns', $this->page_data);
    }

    public function ajax_load_sms_campaign_counter()
    {
        $company_id = logged('company_id');

        $smsAll = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), array());

        $conditions[0] = ['field' => 'sms_blast.status', 'value' => $this->SmsBlast_model->statusScheduled()];
        $smsScheduled = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'sms_blast.status', 'value' => $this->SmsBlast_model->statusActive()];
        $smsActive = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'sms_blast.status', 'value' => $this->SmsBlast_model->statusClosed()];
        $smsClosed = $this->SmsBlast_model->getAllByCompanyId($company_id, array(), $conditions);

        $conditions[0] = ['field' => 'sms_blast.status', 'value' => $this->SmsBlast_model->statusDraft()];
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

    public function ajax_close_campaign()
    {
        $is_success = 0;
        $msg = '';

        $post     = $this->input->post();
        $smsBlast = $this->SmsBlast_model->getById($post['smsid']);
        if ($smsBlast) {
            $data = ['status' => $this->SmsBlast_model->statusClosed()];
            $this->SmsBlast_model->updateSmsBlast($post['smsid'], $data);

            $is_success = 1;
            $msg = 'SMS Campaign was successfully updated';
        } else {
            $msg = 'Record not found';
        }
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function edit_sms_campaign($id)
    {
        $company_id = logged('company_id');
        $smsCampaign = $this->SmsBlast_model->getById($id);
        $this->session->unset_userdata('smsBlastId');
        if ($smsCampaign) {
            if ($smsCampaign->company_id == $company_id) {

                $this->session->set_userdata('smsBlastId', $smsCampaign->id);
                $this->page_data['smsCampaign'] = $smsCampaign;
                $this->load->view('v2/pages/sms_campaigns/edit_sms_blast', $this->page_data);
            } else {
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
                redirect('sms_campaigns');
            }
        } else {
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('sms_campaigns');
        }
    }

    public function ajax_clone_campaign()
    {
        $is_success = 0;
        $msg    = '';
        $sms_id = 0;

        $post     = $this->input->post();
        $smsBlast = $this->SmsBlast_model->getById($post['smsid']);
        if ($smsBlast) {
            $data = (array)$smsBlast;
            unset($data['id']);
            unset($data['uid']);
            unset($data['company_id']);
            $sms_id     = $this->SmsBlast_model->create($data);
            if ($sms_id > 0) {
                $smsSendTo = $this->SmsBlastSendTo_model->getAllBySmsBlastId($post['smsid']);
                foreach ($smsSendTo as $st) {
                    $data_send_to = (array)$st;
                    unset($data_send_to['id']);
                    $data_send_to['sms_blast_id'] = $sms_id;

                    $smsBlastSendTo = $this->SmsBlastSendTo_model->create($data_send_to);
                }

                $is_success = 1;
                $msg = 'SMS Campaign was successfully updated';
            } else {
                $msg = 'Record not found';
            }
        } else {
            $msg = 'Record not found';
        }
        $json_data = [
            'sms_id' => $sms_id,
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function payment()
    {
        $this->load->model('CardsFile_model');
        $this->load->helper('functions');

        $cid  = logged('company_id');
        $sms_blast_id = $this->session->userdata('smsBlastId');

        $smsBlast = $this->SmsBlast_model->getById($sms_blast_id);
        $sms_text = $smsBlast->sms_text;

        $smsRecipients = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms_blast_id);
        $total_recipients = count($smsRecipients);

        $service_price = $this->SmsBlast_model->getServicePrice();
        $price_per_sms = $this->SmsBlast_model->getPricePerSms();
        $total_sms_price = $total_recipients * $price_per_sms;
        $grand_total     = $total_sms_price + $service_price;
        $creditCards = $this->CardsFile_model->getAllByCompanyId($cid);

        $this->page_data['creditCards'] = $creditCards;
        $this->page_data['smsBlast'] = $smsBlast;
        $this->page_data['grand_total'] = $grand_total;
        $this->page_data['total_sms_price'] = $total_sms_price;
        $this->page_data['total_recipients'] = $total_recipients;
        $this->page_data['service_price'] = $service_price;
        $this->page_data['price_per_sms'] = $price_per_sms;
        $this->page_data['sms_text'] = $sms_text;
        $this->load->view('v2/pages/sms_campaigns/payment', $this->page_data);
    }

    public function process_payment()
    {
        $this->load->helper(array('paypal_helper'));
        // Load Paypal SDK
        include APPPATH . 'libraries/paypal-php-sdk/vendor/autoload.php';

        // Stripe SDK
        include APPPATH . 'libraries/stripe/init.php';

        $post = $this->input->post();

        $sms_blast_id = $this->session->userdata('smsBlastId');

        $smsBlast = $this->SmsBlast_model->getById($sms_blast_id);
        $sms_text = $smsBlast->sms_text;

        $smsRecipients = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms_blast_id);
        $total_recipients = count($smsRecipients);

        $service_price = $this->SmsBlast_model->getServicePrice();
        $price_per_sms = $this->SmsBlast_model->getPricePerSms();
        $total_sms_price = $total_recipients * $price_per_sms;
        $grand_total     = $total_sms_price + $service_price;

        if ($post['payment_method'] == 'stripe') {
        } elseif ($post['payment_method'] == 'paypal') {

            //Add custom data such as item/subscription id etc.
            //$userID = 123456;        

            /*
             * Paypal Process Here - Start
            */

            $client_id     = paypal_credential('client_id');
            $client_secret = paypal_credential('client_secret');

            $return_url = base_url('/sms_campaign/paypal?status=1');
            $cancel_url = base_url('/sms_campaign/paypal?status=2');

            //Add paypal client id & secret
            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    $client_id,
                    $client_secret
                )
            );

            $payer = new \PayPal\Api\Payer();
            $payer->setPaymentMethod("paypal");

            $redirectUrls = new \PayPal\Api\RedirectUrls();
            $redirectUrls->setReturnUrl($return_url)
                ->setCancelUrl($cancel_url);

            $amount = new \PayPal\Api\Amount();
            $amount->setCurrency("USD")
                ->setTotal($grand_total);

            // Set transaction object
            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount)
                ->setDescription("NSmartrac : SMS Campaign");

            // Create the full payment object
            $payment = new \PayPal\Api\Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

            try {
                $payment->create($apiContext);

                // Get PayPal redirect URL and redirect the customer
                $approvalUrl = $payment->getApprovalLink();

                // Redirect the customer to $approvalUrl
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }

            $this->session->set_userdata('regiserUserId', $uid);
            $this->session->set_userdata('regiserClientId', $cid);

            header("Location:" . $approvalUrl);
        } elseif ($post['payment_method'] == 'converge') {
            //Converge
            // Provide Converge Credentials
            $merchantID =  '2179135'; // "2159250"; //Converge 6-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
            $merchantUserID = 'adiAPI'; // "nsmartapi"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
            $merchantPIN = 'U3L0MSDPDQ254QBJSGTZSN4DQS00FBW5ELIFSR0FZQ3VGBE7PXP07RMKVL024AVR'; // "UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X"; //Converge PIN (64 CHAR A/N)

            //$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
            $url    = CONVERGE_TOKENURL; // URL to Converge production session token server
            $hppurl = CONVERGE_HPPURL; // URL to the demo Hosted Payments Page            

            /*Payment Field Variables*/

            // In this section, we set variables to be captured by the PHP file and passed to Converge in the curl request.

            //$amount = $post['plan_price']; //Hard-coded transaction amount for testing.
            $amount = $grand_total; //Hard-coded transaction amount for testing.

            //$amount  = $_POST['ssl_amount'];   //Capture ssl_amount as POST data
            //$firstname  = $_POST['ssl_first_name'];   //Capture ssl_first_name as POST data
            //$lastname  = $_POST['ssl_last_name'];   //Capture ssl_last_name as POST data
            //$merchanttxnid = $_POST['ssl_merchant_txn_id']; //Capture ssl_merchant_txn_id as POST data
            //$invoicenumber = $_POST['ssl_invoice_number']; //Capture ssl_invoice_number as POST data

            $ssl_description = 'NSmartrac : SMS Campaign';
            $ssl_firstname = $post['firstname'];
            $ssl_lastname  = $post['lastname'];
            $ssl_email = $post['email'];
            $ssl_phone = $post['phone'];

            //Follow the above pattern to add additional fields to be sent in curl request below.
            //$merchanttxnid = "3234342343";
            $ch = curl_init();    // initialize curl handle
            curl_setopt($ch, CURLOPT_URL, $url); // set POST target URL
            curl_setopt($ch, CURLOPT_POST, true); // set POST method
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //Build the request for the session id. Make sure all payment field variables created above get included in the CURLOPT_POSTFIELDS section below.  ccsale

            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                "ssl_merchant_id=$merchantID" .
                    "&ssl_user_id=$merchantUserID" .
                    "&ssl_pin=$merchantPIN" .
                    "&ssl_transaction_type=ccaddrecurring" .
                    "&ssl_next_payment_date=$next_billing" .
                    "&ssl_description=$ssl_description" .
                    "&ssl_phone=$ssl_phone" .
                    "&ssl_first_name=$ssl_firstname" .
                    "&ssl_last_name=$ssl_lastname" .
                    "&ssl_email=$ssl_email" .
                    //"&ssl_test_mode=TRUE".
                    //"&ssl_txn_id=$merchanttxnid".
                    "&ssl_amount=$amount"
            );

            $result = curl_exec($ch); // run the curl to post to Converge
            curl_close($ch); // Close cURL

            $sessiontoken = urlencode($result);
            /*echo "<pre>";
            print_r($sessiontoken);
            exit;*/
            /* Now we redirect to the HPP */
            //header("Location: https://api.demo.convergepay.com/hosted-payments?ssl_txn_auth_token=$sessiontoken");  //Demo Redirect

            $hppurl = $hppurl . "?ssl_txn_auth_token=$sessiontoken";
            header("Location: " . $hppurl); //Prod Redirect 
        }
    }

    public function get_paypal()
    {
        $this->load->helper(array('paypal_helper'));

        $is_success = 0;
        $msg = '';
        $approvalUrl = '';

        // Load Paypal SDK
        include APPPATH . 'libraries/paypal-php-sdk/vendor/autoload.php';

        // Stripe SDK
        include APPPATH . 'libraries/stripe/init.php';

        $post = $this->input->post();

        $sms_blast_id = $this->session->userdata('smsBlastId');

        $smsBlast = $this->SmsBlast_model->getById($sms_blast_id);
        $sms_text = $smsBlast->sms_text;

        $smsRecipients = $this->SmsBlastSendTo_model->getAllBySmsBlastId($sms_blast_id);
        $total_recipients = count($smsRecipients);

        $service_price = $this->SmsBlast_model->getServicePrice();
        $price_per_sms = $this->SmsBlast_model->getPricePerSms();
        $total_sms_price = $total_recipients * $price_per_sms;
        $grand_total     = $total_sms_price + $service_price;

        //Add custom data such as item/subscription id etc.
        //$userID = 123456;        

        /*
         * Paypal Process Here - Start
        */

        $client_id     = paypal_credential('client_id');
        $client_secret = paypal_credential('client_secret');

        $return_url = base_url('/sms_campaigns/process_paypal_payment?status=1');
        $cancel_url = base_url('/sms_campaigns/process_paypal_payment?status=2');

        //Add paypal client id & secret
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $client_id,
                $client_secret
            )
        );

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod("paypal");

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl($return_url)
            ->setCancelUrl($cancel_url);

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency("USD")
            ->setTotal($grand_total);

        // Set transaction object
        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
            ->setDescription("NSmartrac : SMS Campaign");

        // Create the full payment object
        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);

            // Get PayPal redirect URL and redirect the customer
            $approvalUrl = $payment->getApprovalLink();
            $is_success = 1;

            // Redirect the customer to $approvalUrl
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            $msg = 'Cannot process paypal payment';
            $is_success = 0;
            /*echo $ex->getCode();
          echo $ex->getData();
          die($ex);*/
        } catch (Exception $ex) {
            $msg = 'Cannot process paypal payment';
            $is_success = 0;
            //die($ex);
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
            'approvalUrl' => $approvalUrl
        ];

        echo json_encode($json_data);
    }

    public function process_paypal_payment()
    {
        if (isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
            $sms_blast_id = $this->session->userdata('smsBlastId');
            $smsBlast = $this->SmsBlast_model->getById($sms_blast_id);

            $payment_variables = serialize($_GET);

            $sms_blast_data = [
                'payment_gateway' => $this->SmsBlast_model->paymentGatewayPaypal(),
                'payment_variables' => $payment_variables,
                'status' => $this->SmsBlast_model->statusActive(),
                'is_paid' => $this->SmsBlast_model->isPaid()
            ];

            $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $sms_blast_data);

            $this->session->set_flashdata('message', 'Payment process completed');
            $this->session->set_flashdata('alert_class', 'alert-success');
        } else {
            $this->session->set_flashdata('message', 'Payment process failed');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        $this->session->unset_userdata('smsBlastId');

        redirect('sms_campaigns');
        exit;
    }

    public function ajax_process_stripe_payment()
    {
        $is_success = true;
        $msg = '';

        $post = $this->input->post();
        $sms_blast_id = $this->session->userdata('smsBlastId');
        $smsBlast = $this->SmsBlast_model->getById($sms_blast_id);

        $payment_variables = ['stripeToken' => $post['stripeToken']];

        $sms_blast_data = [
            'payment_gateway' => $this->SmsBlast_model->paymentGatewayStripe(),
            'payment_variables' => serialize($payment_variables),
            'status' => $this->SmsBlast_model->statusActive(),
            'is_paid' => $this->SmsBlast_model->isPaid()
        ];
        $smsBlast = $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $sms_blast_data);

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function activate_campaign()
    {
        $this->load->model('CardsFile_model');
        $this->load->model('Clients_model');
        $this->load->model('MarketingOrderPayments_model');

        $is_success = false;
        $msg = '';

        $cid  = logged('company_id');
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if (isset($post['payment_method_token'])) {
            $sms_blast_id = $this->session->userdata('smsBlastId');
            $smsBlast     = $this->SmsBlast_model->getById($sms_blast_id);
            if ($smsBlast) {
                $creditCard = $this->CardsFile_model->getById($post['payment_method_token']);
                if ($creditCard && $creditCard->company_id == $cid) {
                    $company = $this->Clients_model->getById($creditCard->company_id);

                    $expiration_month =  str_pad($creditCard->expiration_month, 2, '0', STR_PAD_LEFT);
                    $exp_date         =  $expiration_month . $creditCard->expiration_year;
                    $data_cc = [
                        'card_number' => $creditCard->card_number,
                        'exp_date' => $exp_date,
                        'cvc' => $creditCard->card_cvv,
                        'ssl_first_name' => $company->first_name,
                        'ssl_last_name' => $company->last_name,
                        'ssl_amount' => $smsBlast->total_price,
                        'ssl_address' => $company->business_address,
                        'ssl_zip' => $company->zip_code
                    ];

                    $result_payment = $this->convergePayment($data_cc);
                    if ($result_payment['is_success'] === 1) {
                        $data = ['status' => $this->SmsBlast_model->statusActive(), 'is_paid' => $this->SmsBlast_model->isPaid(), 'cards_file_id' => $post['payment_method_token']];
                        $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $data);
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
                        $this->SmsBlast_model->updateSmsBlast($sms_blast_id, $data);

                        $is_success = true;
                        $msg = 'Sms automation was successfully activated.';
                    } else {
                        $msg = $result_payment['msg'];
                    }
                } else {
                    $msg = 'Cannot find data';
                }
            } else {
                $msg = 'Cannot find data';
            }
        } else {
            $msg = 'Please select credit card';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function convergePayment($data)
    {
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

        if ($createSale['success'] == 1) {
            $is_success = 1;
        } else {
            $msg = $createSale['errorMessage'];
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function payment_details()
    {

        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');

        $sms_blast_id = $this->session->userdata('smsBlastId');
        $smsBlast     = $this->SmsBlast_model->getById($sms_blast_id);
        $company         = $this->Business_model->getByCompanyId($company_id);
        if ($smsBlast) {
            if ($smsBlast->order_number != '') {
                $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($smsBlast->order_number);

                $this->page_data['smsBlast']   = $smsBlast;
                $this->page_data['orderPayments'] = $orderPayments;
                $this->page_data['company'] = $company;
                $this->load->view('v2/pages/sms_campaigns/payment_details', $this->page_data);
            } else {
                redirect('sms_automation');
            }
        } else {
            redirect('sms_automation');
        }
    }

    public function campaign_invoice_pdf($id)
    {

        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');

        $smsBlast = $this->SmsBlast_model->getById($id);
        $company  = $this->Business_model->getByCompanyId($smsBlast->company_id);
        $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($smsBlast->order_number);
        $this->page_data['smsBlast']   = $smsBlast;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $content = $this->load->view('sms_campaigns/campaign_customer_invoice_pdf_template_a', $this->page_data, TRUE);

        $this->load->library('Reportpdf');

        $title = 'sms_campaign_invoice';

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

    public function view_campaign($id)
    {
        $this->load->model('MarketingOrderPayments_model');

        $smsCampaign = $this->SmsBlast_model->getById($id);
        $orderPayments = $this->MarketingOrderPayments_model->getByOrderNumber($smsCampaign->order_number);
        $statusOptions = $this->SmsBlast_model->statusOptions();

        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['smsCampaign']   = $smsCampaign;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->load->view('sms_campaigns/view_campaign', $this->page_data);
    }

    public function view_payment($id)
    {
        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');

        $orderPayments = $this->MarketingOrderPayments_model->getById($id);        
        $smsCampaign   = $this->SmsBlast_model->getByOrderNumber($orderPayments->order_number);
        $company       = $this->Business_model->getByCompanyId($smsCampaign->company_id);
        $statusOptions = $this->SmsBlast_model->statusOptions();

        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['smsCampaign']   = $smsCampaign;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $this->load->view('v2/pages/sms_campaigns/view_payment_details', $this->page_data);
    }

    public function order_pdf($id)
    {

        $this->load->model('MarketingOrderPayments_model');
        $this->load->model('Business_model');

        $smsBlast    = $this->SmsBlast_model->getById($id);
        $company     = $this->Business_model->getByCompanyId($smsBlast->company_id);
        $orderPayments   = $this->MarketingOrderPayments_model->getByOrderNumber($smsBlast->order_number);
        $this->page_data['smsBlast']   = $smsBlast;
        $this->page_data['orderPayments'] = $orderPayments;
        $this->page_data['company'] = $company;
        $content = $this->load->view('sms_campaigns/campaign_customer_order_pdf_template_a', $this->page_data, TRUE);

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

    public function view_logs($id)
    {
        $this->load->model('SmsLogs_model');

        $smsBlast = $this->SmsBlast_model->getById($id);
        $smsLogs  = $this->SmsLogs_model->getAllCampaignBySmsId($smsBlast->id);

        $this->page_data['smsBlast'] = $smsBlast;
        $this->page_data['smsLogs']  = $smsLogs;
        $this->load->view('v2/pages/sms_campaigns/view_logs', $this->page_data);
    }

    public function ajax_delete_selected()
    {
        $is_success = 0;
        $msg = 'Nothing to delete';

        $post = $this->input->post();

        if($post && $post['with_selected_action'] == 'delete') {
            $total_deleted = 0;
            foreach($post['row_selected'] as $smsBlast_id){
                $smsBlastDelete = $this->SmsBlast_model->deleteSmsBlast($smsBlast_id);
                $total++;
            }

            if( $total > 0 ){
                $is_success = 1;
                $msg = 'Selected SMS Blast was successfully deleted';
            }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }   
    
    public function ajax_delete_sms_blast()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $smsBlast =  $this->SmsBlast_model->getById($post['smsb_id']);
        if( $smsBlast ){
            
            $smsBlastDelete = $this->SmsBlast_model->deleteSmsBlast($post['smsb_id']);

            if($smsBlastDelete) {
                $is_success = 1;
                $msg = '';
            }

        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }    
}



/* End of file Sms_Campaigns.php */

/* Location: ./application/controllers/Sms_Campaigns.php */