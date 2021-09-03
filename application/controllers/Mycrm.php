<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mycrm extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'My CRM';

        $this->page_data['page']->menu = '';	
        
        add_css(array(
            'assets/frontend/css/mycrm/main.css',
        ));

	}

	public function index()
	{	
        $this->load->model('Business_model');
        
        $company_id = logged('company_id');
        $business   = $this->Business_model->getByCompanyId($company_id);

        $this->page_data['business'] = $business;
		$this->load->view('mycrm/index', $this->page_data);

    }
    
    public function membership()
	{	
		$this->load->model('Clients_model');
		$this->load->model('NsmartPlan_model');
		$this->load->model('SubscriberNsmartUpgrade_model');
		$this->load->model('CompanySubscriptionPayments_model');
		$this->load->model('CardsFile_model');
		$this->load->model('OfferCodes_model');

		$company_id = logged('company_id');
		$client = $this->Clients_model->getById($company_id);
		$plan   = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
		$nsPlans  = $this->NsmartPlan_model->getAll(); 
		$addons   = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
		$lastPayment  = $this->CompanySubscriptionPayments_model->getCompanyLastPayment($client->id);
		$firstPayment = $this->CompanySubscriptionPayments_model->getCompanyFirstPayment($client->id);
		$primaryCard  = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
		$offerCode    = $this->OfferCodes_model->getByClientId($company_id);

		$total_addon_price = 0;
		foreach($addons as $a){
			$total_addon_price += $a->service_fee;
		}

		if( $client->renewal_date != '' ){
			$start_billing_period = date("d-M-Y", strtotime($client->renewal_date));
			$end_billing_period   = date("d-M-Y", strtotime($client->plan_date_expiration));
		}else{
			$day = date("d", strtotime($client->plan_date_registered));
			$date_start = date("Y-m-" . $day);
			$start_billing_period = date("d-M-Y", strtotime($date_start));
			$end_billing_period   = date("d-M-Y", strtotime("+1 months ", strtotime($start_billing_period)));
		}	

        $default_plan_feature = plan_default_features();
        if( $plan->plan_name == 'Simple Start' ){
            $default_plan_feature = $default_plan_feature['simple-start'];
        }elseif( $plan->plan_name == 'Essential' ){
            $default_plan_feature = $default_plan_feature['essential'];
        }elseif( $plan->plan_name == 'Plus' ){
            $default_plan_feature = $default_plan_feature['plus'];
        }elseif( $plan->plan_name == 'PremierPro' ){
            $default_plan_feature = $default_plan_feature['premier-pro'];
        }elseif( $plan->plan_name == 'Industry Specific' ){
            $default_plan_feature = $default_plan_feature['industry-specific'];
        }elseif( $plan->plan_name == 'Enterprise' ){
            $default_plan_feature = $default_plan_feature['enterprise'];
        }

        if( $client->recurring_payment_type == 'monthly' ){
            $total_membership_cost = $plan->price + $total_addon_price;
            $total_plan_cost = $plan->price;
        }else{
            $total_membership_cost = ($plan->price + $total_addon_price) * 12;
            $total_plan_cost = $plan->price * 12;
            $total_addon_price = $total_addon_price * 12;
        }

        $this->page_data['plan_features'] = $plan_default_features;
		$this->page_data['lastPayment']  = $lastPayment;
		$this->page_data['firstPayment'] = $firstPayment;
		$this->page_data['nsPlans'] = $nsPlans;
		$this->page_data['start_billing_period'] = $start_billing_period;
		$this->page_data['end_billing_period'] = $end_billing_period;
		$this->page_data['total_membership_cost']      = $total_membership_cost;
        $this->page_data['total_plan_cost'] = $total_plan_cost;
		$this->page_data['total_addon_price']  = $total_addon_price;
		$this->page_data['primaryCard'] = $primaryCard;
		$this->page_data['addons'] = $addons;
		$this->page_data['plan']   = $plan;
        $this->page_data['default_plan_feature'] = $default_plan_feature;
		$this->page_data['client'] = $client;
		$this->page_data['offerCode'] = $offerCode;
		$this->load->view('mycrm/membership', $this->page_data);

    }
        
    public function payment_methods()
	{	

		$this->load->view('mycrm/payment_method', $this->page_data);

    }
    
    public function orders()
	{	
		$this->load->model('CompanySubscriptionPayments_model');

        $company_id = logged('company_id');
        $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);
        $a_settings = unserialize($settings[0]->value);
        if ($a_settings) {
            $user_timezone = $a_settings['calendar_timezone'];
        } else {
            $user_timezone = 'UTC';
        }

        date_default_timezone_set($user_timezone);

		$company_id = logged('company_id');
		$payments   = $this->CompanySubscriptionPayments_model->getAllByCompanyId($company_id);

		$this->page_data['payments'] = $payments;
		$this->load->view('mycrm/order', $this->page_data);

    }
    
    public function payment_balance()
	{	

		$this->load->view('mycrm/payment_balance', $this->page_data);

	}

	public function company_update_auto_renewal()
	{
		$this->load->model('Clients_model');

		$company_id = logged('company_id');
		$post 		= $this->input->post();
		if($post['is_active'] == 1){
			$is_auto_renew = 1;
		}else{
			$is_auto_renew = 0;
		}

		$this->Clients_model->update($company_id, array(
            'is_auto_renew' => $is_auto_renew
        ));

        echo json_encode(['is_success' => 1]);
	}

	public function company_upgrade_subscription()
	{
		$this->load->model('Business_model');
		$this->load->model('NsmartPlan_model');
		$this->load->model('Clients_model');
		$this->load->model('CompanySubscriptionPayments_model');

		$is_success = 0;		
		$message    = '';
		$company_id = logged('company_id');
		$post 		= $this->input->post();

		$plan   = $this->NsmartPlan_model->getById($post['plan_id']);
		if( $plan ){
			if( $post['subscription_type'] == 'yearly' ){
				$amount   = $plan->price * 12;
				$next_billing_date = date("Y-m-d", strtotime("+1 year"));
			}else{
				$amount   = $plan->price;
				$next_billing_date = date("Y-m-d", strtotime("+1 month"));
			}
			
			$company  = $this->Business_model->getByCompanyId($company_id);
            $client   = $this->Clients_model->getById($company_id);
			$address  = $company->street . " " . $company->city . " " . $company->state;
			$zip_code = $company->postal_code;
			$converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success']) {
            	$next_billing_date = date("Y-m-d", strtotime("+1 month"));
            	$data = [           
	            	'payment_method' => 'converge',     
	                'plan_date_registered' => date("Y-m-d"),
	                'plan_date_expiration' => date("Y-m-d", strtotime("+1 month")),                
	                'date_modified' => date("Y-m-d H:i:s"),
	                'is_plan_active' => 1,
	                'nsmart_plan_id' => $plan->nsmart_plans_id,
	                'is_trial' => 0,
	                'payment_method' => 'converge',
	                'next_billing_date' => $next_billing_date,
	                'num_months_discounted' => 0,
	                'recurring_payment_type' => $post['subscription_type']
            	];
            	$this->Clients_model->update($company_id, $data);

                //Update access modules
                $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                if ($industryType) {
                    $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->id);
                    foreach ($industryModules as $im) {
                        $access_modules[] = $im->industry_module_id;
                    }

                    $this->session->set_userdata('userAccessModules', $access_modules);
                    $this->session->set_userdata('is_plan_active', 1);
                }

            	//Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Paid Membership, ' . ucwords($post['subscription_type']),
                    'payment_date' => date("Y-m-d"),
                    'total_amount' => $amount,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);
                        
                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $is_success = 1;
            }else {
                $message = $result['msg'];
            }
		}

		echo json_encode(['is_success' => $is_success, 'message' => $message]);

	}

	public function company_pay_subscription()
	{
		$this->load->model('Business_model');
		$this->load->model('NsmartPlan_model');
		$this->load->model('Clients_model');
		$this->load->model('CompanySubscriptionPayments_model');
		$this->load->model('SubscriberNsmartUpgrade_model');

		$is_success = 0;		
		$message    = '';
		$company_id = logged('company_id');
		$post 		= $this->input->post();

		$client = $this->Clients_model->getById($company_id);
		$plan   = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
		if( $plan ){
			if( $client->num_months_discounted > 0 ){
				$amount   = $plan->price;
			}else{
				$amount   = $plan->discount;	
			}

			$addons   = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
			$total_addon_price = 0;
			foreach($addons as $a){
				$total_addon_price += $a->service_fee;
			}

			$amount = $amount + $total_addon_price;

            if( $client->recurring_payment_type == 'monthly' ){
                $amount = $amount;
                $next_billing_date = date("Y-m-d", strtotime("+1 month", strtotime($client->next_billing_date)));
            }else{
                $amount = $amount * 12;
                $next_billing_date = date("Y-m-d", strtotime("+1 year", strtotime($client->next_billing_date)));
            }

			$company  = $this->Business_model->getByCompanyId($company_id);
			$address  = $company->street . " " . $company->city . " " . $company->state;
			$zip_code = $company->postal_code;
			$converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success']) {
            	$num_months_discounted = 0;
            	if( $client->num_months_discounted > 0 ){
            		$num_months_discounted = $client->num_months_discounted - 1;	
            	}
            	
            	$data = [           
	            	'payment_method' => 'converge',     
	                //'plan_date_registered' => date("Y-m-d"),
	                //'plan_date_expiration' => date("Y-m-d", strtotime("+1 month")),                
	                'date_modified' => date("Y-m-d H:i:s"),
	                'is_plan_active' => 1,
	                //'nsmart_plan_id' => $plan->nsmart_plans_id,
	                'is_trial' => 0,
	                'next_billing_date' => $next_billing_date,
	                'num_months_discounted' => $num_months_discounted
            	];
            	$this->Clients_model->update($company_id, $data);

                //Update access modules
                $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                if ($industryType) {
                    $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->id);
                    foreach ($industryModules as $im) {
                        $access_modules[] = $im->industry_module_id;
                    }

                    $this->session->set_userdata('userAccessModules', $access_modules);
                    $this->session->set_userdata('is_plan_active', 1);
                }

            	//Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Paid Membership, ' . ucwords($client->recurring_payment_type),
                    'payment_date' => date("Y-m-d"),
                    'total_amount' => $amount,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);
                        
                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $is_success = 1;
            }else {
                $message = $result['msg'];
            }
		}

		echo json_encode(['is_success' => $is_success, 'message' => $message]);
	}

	public function converge_send_sale($data)
    {
    	include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = '';

        $exp_year = date("m/d/" . $data['exp_year']);
        $exp_date = $data['exp_month'] . date("y", strtotime($exp_year));
        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);
        $createSale = $converge->request('ccsale', [
            'ssl_card_number' => $data['card_number'],
            'ssl_exp_date' => $exp_date,
            'ssl_cvv2cvc2' => $data['card_cvc'],
            'ssl_amount' => $data['amount'],
            'ssl_avs_address' => $data['address'],
            'ssl_avs_zip' => $data['zip'],
        ]);

        if ($createSale['success'] == 1) {
            $is_success = true;
            $msg = '';
        } else {
            $is_success = false;
            $msg = $createSale['errorMessage'];
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function company_request_remove_addon(){
		$this->load->model('SubscriberNsmartUpgrade_model');

		$is_success = 0;
		$company_id = logged('company_id');
		$post 		= $this->input->post();

		$addon = $this->SubscriberNsmartUpgrade_model->getAddOnByClientIdAndId($company_id, $post['addon_id']);
		if( $addon ){
			$this->SubscriberNsmartUpgrade_model->update($addon->id, ['with_request_removal' => 1]);
	        $is_success = 1;
		}

		$json = ['is_success' => $is_success];

		echo json_encode($json);
    }

    public function company_cancel_remove_addon(){
		$this->load->model('SubscriberNsmartUpgrade_model');

		$is_success = 0;
		$company_id = logged('company_id');
		$post 		= $this->input->post();

		$addon = $this->SubscriberNsmartUpgrade_model->getAddOnByClientIdAndId($company_id, $post['addon_id']);
		if( $addon ){
			$this->SubscriberNsmartUpgrade_model->update($addon->id, ['with_request_removal' => 0]);
	        $is_success = 1;
		}

		$json = ['is_success' => $is_success];

		echo json_encode($json);
    }

    public function view_payment($id){
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment    = $this->CompanySubscriptionPayments_model->getById($id);
        $company    = $this->Business_model->getByCompanyId($payment->company_id);
        if($payment->company_id == $company_id){
        	$this->page_data['payment'] = $payment;
        	$this->page_data['company'] = $company;
	        $this->load->view('mycrm/view_payment_details', $this->page_data);     
        }else{
        	redirect('mycrm/orders');
        }
    }

    public function order_pdf($id){

        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');
        
        $company_id = logged('company_id');
        $payment    = $this->CompanySubscriptionPayments_model->getById($id);
        $company    = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment']   = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/subscription_order_pdf_template_a', $this->page_data, TRUE);  
            
        $this->load->library('Reportpdf');

        $title = 'subscription_order';

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

    public function invoice_pdf($id){

        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');
        
        $company_id = logged('company_id');
        $payment    = $this->CompanySubscriptionPayments_model->getById($id);
        $company    = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment']   = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/subscription_invoice_pdf_template_a', $this->page_data, TRUE);  
            
        $this->load->library('Reportpdf');

        $title = 'subscription_invoice';

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

    public function company_buy_plan_license()
    {
        $this->load->model('Business_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('Clients_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('SubscriberNsmartUpgrade_model');

        $is_success = 0;        
        $message    = '';
        $company_id = logged('company_id');
        $post       = $this->input->post();

        $client = $this->Clients_model->getById($company_id);
        $plan   = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        if( $plan ){
            $new_num_license = $client->number_of_license + $post['num_license'];                        
            $amount          = $plan->price_per_license * $post['num_license'];

            $company  = $this->Business_model->getByCompanyId($company_id);
            $address  = $company->street . " " . $company->city . " " . $company->state;
            $zip_code = $company->postal_code;
            $converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success']) {
                $data = [   
                    'number_of_license' => $new_num_license
                ];
                $this->Clients_model->update($company_id, $data);

                //Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Paid Plan License',
                    'payment_date' => date("Y-m-d"),
                    'total_amount' => $amount,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);
                        
                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $is_success = 1;
            }else {
                $message = $result['msg'];
            }
        }

        echo json_encode(['is_success' => $is_success, 'message' => $message]);
    }

    public function renew_plan()
    {   
        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('SubscriberNsmartUpgrade_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('CardsFile_model');
        $this->load->model('OfferCodes_model');

        $company_id = logged('company_id');
        $client = $this->Clients_model->getById($company_id);
        if( $client->is_plan_active == 1  ){
        	//return redirect('mycrm/membership');
        }

        $plan   = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $nsPlans  = $this->NsmartPlan_model->getAll(); 
        $addons   = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
        $lastPayment  = $this->CompanySubscriptionPayments_model->getCompanyLastPayment($client->id);
        $firstPayment = $this->CompanySubscriptionPayments_model->getCompanyFirstPayment($client->id);
        $primaryCard  = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
        $offerCode    = $this->OfferCodes_model->getByClientId($company_id);

        $total_addon_price = 0;
        foreach($addons as $a){
            $total_addon_price += $a->service_fee;
        }

        $day = date("d", strtotime($client->plan_date_registered));
        $date_start = date("Y-m-" . $day);
        $start_billing_period = date("d-M-Y", strtotime($date_start));
        $end_billing_period   = date("d-M-Y", strtotime("+1 months ", strtotime($start_billing_period)));

        $default_plan_feature = plan_default_features();
        if( $plan->plan_name == 'Simple Start' ){
            $default_plan_feature = $default_plan_feature['simple-start'];
        }elseif( $plan->plan_name == 'Essential' ){
            $default_plan_feature = $default_plan_feature['essential'];
        }elseif( $plan->plan_name == 'Plus' ){
            $default_plan_feature = $default_plan_feature['plus'];
        }elseif( $plan->plan_name == 'PremierPro' ){
            $default_plan_feature = $default_plan_feature['premier-pro'];
        }elseif( $plan->plan_name == 'Industry Specific' ){
            $default_plan_feature = $default_plan_feature['industry-specific'];
        }elseif( $plan->plan_name == 'Enterprise' ){
            $default_plan_feature = $default_plan_feature['enterprise'];
        }

        $this->page_data['plan_features'] = $plan_default_features;
        $this->page_data['lastPayment']  = $lastPayment;
        $this->page_data['firstPayment'] = $firstPayment;
        $this->page_data['nsPlans'] = $nsPlans;
        $this->page_data['start_billing_period'] = $start_billing_period;
        $this->page_data['end_billing_period'] = $end_billing_period;
        $this->page_data['total_monthly']      = $plan->price + $total_addon_price;
        $this->page_data['total_addon_price']  = $total_addon_price;
        $this->page_data['primaryCard'] = $primaryCard;
        $this->page_data['addons'] = $addons;
        $this->page_data['plan']   = $plan;
        $this->page_data['default_plan_feature'] = $default_plan_feature;
        $this->page_data['client'] = $client;
        $this->page_data['offerCode'] = $offerCode;
        $this->load->view('mycrm/renew_plan', $this->page_data);

    }

    public function plan_select()
    {
        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('SubscriberNsmartUpgrade_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('CardsFile_model');
        $this->load->model('OfferCodes_model');

        $company_id = logged('company_id');
        $client = $this->Clients_model->getById($company_id);
        if( $client->is_plan_active == 1  ){
        	//return redirect('mycrm/membership');
        }

        $plan   = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $nsPlans  = $this->NsmartPlan_model->getAll(); 
        $addons   = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
        $lastPayment  = $this->CompanySubscriptionPayments_model->getCompanyLastPayment($client->id);
        $firstPayment = $this->CompanySubscriptionPayments_model->getCompanyFirstPayment($client->id);
        $primaryCard  = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
        $offerCode    = $this->OfferCodes_model->getByClientId($company_id);

        $total_addon_price = 0;
        foreach($addons as $a){
            $total_addon_price += $a->service_fee;
        }

        $day = date("d", strtotime($client->plan_date_registered));
        $date_start = date("Y-m-" . $day);
        $start_billing_period = date("d-M-Y", strtotime($date_start));
        $end_billing_period   = date("d-M-Y", strtotime("+1 months ", strtotime($start_billing_period)));

        $monthly = number_format($plan->price,2);
        $yearly  = number_format($plan->discount,2);
        $yearly_total = number_format($plan->discount * 12,2);

        $a_monthly = explode(".", $monthly);
        $a_yearly  = explode(".", $yearly);
        $a_yearly_total = explode(".", $yearly_total);

        $this->page_data['plan_features'] = $plan_default_features;
        $this->page_data['lastPayment']  = $lastPayment;
        $this->page_data['firstPayment'] = $firstPayment;
        $this->page_data['nsPlans'] = $nsPlans;
        $this->page_data['start_billing_period'] = $start_billing_period;
        $this->page_data['end_billing_period'] = $end_billing_period;
        $this->page_data['total_monthly']      = $plan->price + $total_addon_price;
        $this->page_data['total_addon_price']  = $total_addon_price;
        $this->page_data['primaryCard'] = $primaryCard;
        $this->page_data['addons'] = $addons;
        $this->page_data['plan']   = $plan;
        $this->page_data['client'] = $client;
        $this->page_data['offerCode'] = $offerCode;
        $this->page_data['a_monthly'] = $a_monthly;
        $this->page_data['a_yearly']  = $a_yearly;
        $this->page_data['a_yearly_total'] =  $a_yearly_total;
        $this->load->view('mycrm/plan_select', $this->page_data);        
    }

    public function ajax_load_plan_payment_form()
    {
        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('SubscriberNsmartUpgrade_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Users_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $client = $this->Clients_model->getById($company_id);
        $plan   = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $company_total_users = $this->Users_model->countAllCompanyUsers($company_id);

        if( $post['plan_type'] == 'monthly' ){
            $plan_type  = 'monthly';
            $membership_price    = $plan->price;
            $license_total_price = $plan->price_per_license;
            $billing_start = date("d-M-Y");
            $billing_end   = date("d-M-Y", strtotime("+1 month"));
        }else{
            $plan_type = 'yearly';
            $membership_price = $plan->discount * 12;
            $license_total_price = $plan->price_per_license * 12;
            $billing_start = date("d-M-Y");
            $billing_end   = date("d-M-Y", strtotime("+1 year"));
        }

        $billing_period = $billing_start . " to " . $billing_end;
        $grand_total    = $membership_price + $license_total_price;        
        $remaining_license = $client->number_of_license - $company_total_users;
        if( $remaining_license < 0 ){
        	$remaining_license = 0;
        }
        
        $this->page_data['billing_period'] = $billing_period;
        $this->page_data['grand_total']    = $grand_total;
        $this->page_data['license_total_price'] = $license_total_price;
        $this->page_data['membership_price'] = $membership_price;
        $this->page_data['remaining_license'] = $remaining_license;
        $this->page_data['plan']      = $plan;
        $this->page_data['plan_type'] = $plan_type;
        $this->load->view('mycrm/ajax_load_plan_payment_form', $this->page_data);
    }

    public function ajax_renew_subscription(){        
        $this->load->model('Business_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('Clients_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('SubscriberNsmartUpgrade_model');

        $is_success = 0;        
        $message    = '';
        $company_id = logged('company_id');
        $post       = $this->input->post();

        $client = $this->Clients_model->getById($company_id);
        $plan   = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        if( $plan ){
            if( $post['membership_plan_type'] == 'monthly' ){
                $recurring_payment_type = 'monthly';
                $membership_price    = $plan->price;
                $license_total_price = $post['num_license'] * $plan->price_per_license;
                $billing_start = date("Y-m-d");
                $billing_end   = date("Y-m-d", strtotime("+1 month"));
            }else{
                $recurring_payment_type = 'yearly';
                $membership_price = $plan->discount * 12;
                $license_total_price = ($post['num_license'] * $plan->price_per_license) * 12;
                $billing_start = date("Y-m-d");
                $billing_end   = date("Y-m-d", strtotime("+1 year"));
            }

            $amount   = $membership_price + $license_total_price;
            $company  = $this->Business_model->getByCompanyId($company_id);
            $address  = $company->street . " " . $company->city . " " . $company->state;
            $zip_code = $company->postal_code;
            $converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code
            ];
            $result = $this->converge_send_sale($converge_data);
            if( $result['is_success'] == 1 ){
                $new_total_num_license = $client->number_of_license + $post['num_license'];
                $data = [           
                    'plan_date_expiration' => $billing_end,                
                    'number_of_license' => $new_total_num_license,
                    'date_modified' => date("Y-m-d H:i:s"),
                    'is_plan_active' => 1,
                    'is_trial' => 0,
                    'recurring_payment_type' => $recurring_payment_type,
                    'payment_method' => 'converge',
                    'next_billing_date' => $billing_end,
                    'renewal_date' => date("Y-m-d"),
                    'num_months_discounted' => 0
                ];
                $this->Clients_model->update($company_id, $data);

                //Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Renew Membership, ' . ucfirst($post['membership_plan_type']),
                    'payment_date' => date("Y-m-d"),
                    'total_amount' => $amount,
                    'date_created' => date("Y-m-d H:i:s")
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);
                        
                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $this->session->set_userdata('is_plan_active', 1);
                //Send mail
                //$this->send_invoice($payment_id);

                $is_success = 1;
            }else{
                $message = $result['msg'];
            }

            echo json_encode(['is_success' => $is_success, 'message' => $message]);

        }
    }

    public function send_invoice($payment_id)
    {
    	$this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');        
        $payment    = $this->CompanySubscriptionPayments_model->getById($payment_id);
        $company    = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment'] = $payment;
        $this->page_data['company'] = $company;
        $content    = $this->load->view('mycrm/email_template/invoice', $this->page_data, true);
        $attachment = $this->create_attachment_invoice($payment_id);

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: Order# ' . $payment->order_number;

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;
        $mail->addAttachment($attachment);
        $mail->MsgHTML($content);
        $mail->addAddress('bryann.revina@gmail.com');
        $mail->send();
        
        return true;
    }

    public function create_attachment_invoice($payment_id){

    	$this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');
        
        $company_id = logged('company_id');
        $payment    = $this->CompanySubscriptionPayments_model->getById($id);
        $company    = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment']   = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/subscription_invoice_pdf_template_a', $this->page_data, TRUE);  

        $this->load->library('Reportpdf');
        $title = 'subscription_invoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        //$obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetMargins(10, 5, 10, 0, true);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        //$obj_pdf->SetFont('courierI', '', 9);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $obj_pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        ob_clean();
        $obj_pdf->lastPage();
        // $obj_pdf->Output($title, 'I');
        $filename = strtolower($payment->order_number) . ".pdf";
        $file     = dirname(__DIR__, 2) . '/uploads/subscription_invoice/' . $filename;
        $obj_pdf->Output($file, 'F');
        //$obj_pdf->Output($file, 'F');
        return $file;
    }
}



/* End of file Mycrm.php */

/* Location: ./application/controllers/Mycrm.php */