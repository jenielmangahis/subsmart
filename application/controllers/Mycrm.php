<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mycrm extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'My CRM';

        $this->page_data['page']->menu = '';

        add_css([
            'assets/frontend/css/mycrm/main.css',
        ]);
    }

    public function index()
    {
        $this->page_data['page']->title = 'My Account';
        $this->page_data['page']->parent = 'Company';

        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $business = $this->Business_model->getByCompanyId($company_id);

        $this->page_data['business'] = $business;
        // $this->load->view('mycrm/index', $this->page_data);
        $this->load->view('v2/pages/mycrm/index', $this->page_data);
    }

    public function account_summary()
    {
        $this->page_data['page']->title = 'Account Summary';
        $this->page_data['page']->parent = 'Company';

        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('SubscriberNsmartUpgrade_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('CardsFile_model');
        $this->load->model('OfferCodes_model');

        $company_id = logged('company_id');
        $client = $this->Clients_model->getById($company_id);
        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $nsPlans = $this->NsmartPlan_model->getAll();
        $addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
        $lastPayment = $this->CompanySubscriptionPayments_model->getCompanyLastPayment($client->id);
        $firstPayment = $this->CompanySubscriptionPayments_model->getCompanyFirstPayment($client->id);
        $primaryCard = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
        $offerCode = $this->OfferCodes_model->getByClientId($company_id);

        $total_addon_price = 0;
        foreach ($addons as $a) {
            $total_addon_price += $a->service_fee;
        }

        if ($client->renewal_date != '') {
            $start_billing_period = date('d-M-Y', strtotime($client->renewal_date));
            $end_billing_period = date('d-M-Y', strtotime($client->plan_date_expiration));
        } else {
            $day = date('d', strtotime($client->plan_date_registered));
            $date_start = date('Y-m-'.$day);
            $start_billing_period = date('d-M-Y', strtotime($date_start));
            $end_billing_period = date('d-M-Y', strtotime('+1 months ', strtotime($start_billing_period)));
        }

        $default_plan_feature = plan_default_features();
        if ($plan->plan_name == 'Simple Start') {
            $default_plan_feature = $default_plan_feature['simple-start'];
        } elseif ($plan->plan_name == 'Essential') {
            $default_plan_feature = $default_plan_feature['essential'];
        } elseif ($plan->plan_name == 'Plus') {
            $default_plan_feature = $default_plan_feature['plus'];
        } elseif ($plan->plan_name == 'PremierPro') {
            $default_plan_feature = $default_plan_feature['premier-pro'];
        } elseif ($plan->plan_name == 'Industry Specific') {
            $default_plan_feature = $default_plan_feature['industry-specific'];
        } elseif ($plan->plan_name == 'Enterprise') {
            $default_plan_feature = $default_plan_feature['enterprise'];
        }

        if ($client->recurring_payment_type == 'monthly') {
            $total_membership_cost = $plan->price + $total_addon_price;
            $total_plan_cost = $plan->price;
        } else {
            $total_membership_cost = ($plan->price + $total_addon_price) * 12;
            $total_plan_cost = $plan->price * 12;
            $total_addon_price *= 12;
        }

        $this->page_data['plan_features'] = $plan_default_features;
        $this->page_data['lastPayment'] = $lastPayment;
        $this->page_data['firstPayment'] = $firstPayment;
        $this->page_data['nsPlans'] = $nsPlans;
        $this->page_data['start_billing_period'] = $start_billing_period;
        $this->page_data['end_billing_period'] = $end_billing_period;
        $this->page_data['total_membership_cost'] = $total_membership_cost;
        $this->page_data['total_plan_cost'] = $total_plan_cost;
        $this->page_data['total_addon_price'] = $total_addon_price;
        $this->page_data['primaryCard'] = $primaryCard;
        $this->page_data['addons'] = $addons;
        $this->page_data['plan'] = $plan;
        $this->page_data['default_plan_feature'] = $default_plan_feature;
        $this->page_data['client'] = $client;
        $this->page_data['offerCode'] = $offerCode;
        $this->page_data['payments'] = $this->CompanySubscriptionPayments_model->getAllByCompanyId(logged('company_id'));

        // $this->load->view('mycrm/membership', $this->page_data);
        $this->load->view('v2/pages/mycrm/account_summary', $this->page_data);
    }

    public function membership()
    {
        $this->page_data['page']->title = 'Monthly Membership';
        $this->page_data['page']->parent = 'Company';

        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('SubscriberNsmartUpgrade_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('CardsFile_model');
        $this->load->model('OfferCodes_model');

        $company_id = logged('company_id');
        $client = $this->Clients_model->getById($company_id);
        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $nsPlans = $this->NsmartPlan_model->getAll();
        $addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
        $lastPayment = $this->CompanySubscriptionPayments_model->getCompanyLastPayment($client->id);
        $firstPayment = $this->CompanySubscriptionPayments_model->getCompanyFirstPayment($client->id);
        $primaryCard = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
        $offerCode = $this->OfferCodes_model->getByClientId($company_id);

        $total_addon_price = 0;
        foreach ($addons as $a) {
            $total_addon_price += $a->service_fee;
        }

        if ($client->renewal_date != '') {
            $start_billing_period = date('d-M-Y', strtotime($client->renewal_date));
            $end_billing_period = date('d-M-Y', strtotime($client->plan_date_expiration));
        } else {
            $day = date('d', strtotime($client->plan_date_registered));
            $date_start = date('Y-m-'.$day);
            $start_billing_period = date('d-M-Y', strtotime($date_start));
            $end_billing_period = date('d-M-Y', strtotime('+1 months ', strtotime($start_billing_period)));
        }

        $default_plan_feature = plan_default_features();
        if ($plan->plan_name == 'Simple Start') {
            $default_plan_feature = $default_plan_feature['simple-start'];
        } elseif ($plan->plan_name == 'Essential') {
            $default_plan_feature = $default_plan_feature['essential'];
        } elseif ($plan->plan_name == 'Plus') {
            $default_plan_feature = $default_plan_feature['plus'];
        } elseif ($plan->plan_name == 'PremierPro') {
            $default_plan_feature = $default_plan_feature['premier-pro'];
        } elseif ($plan->plan_name == 'Industry Specific') {
            $default_plan_feature = $default_plan_feature['industry-specific'];
        } elseif ($plan->plan_name == 'Enterprise') {
            $default_plan_feature = $default_plan_feature['enterprise'];
        }

        if ($client->recurring_payment_type == 'monthly') {
            $total_membership_cost = $plan->price + $total_addon_price;
            $total_plan_cost = $plan->price;
        } else {
            $total_membership_cost = ($plan->price + $total_addon_price) * 12;
            $total_plan_cost = $plan->price * 12;
            $total_addon_price *= 12;
        }

        $this->page_data['plan_features'] = $plan_default_features;
        $this->page_data['lastPayment'] = $lastPayment;
        $this->page_data['firstPayment'] = $firstPayment;
        $this->page_data['nsPlans'] = $nsPlans;
        $this->page_data['start_billing_period'] = $start_billing_period;
        $this->page_data['end_billing_period'] = $end_billing_period;
        $this->page_data['total_membership_cost'] = $total_membership_cost;
        $this->page_data['total_plan_cost'] = $total_plan_cost;
        $this->page_data['total_addon_price'] = $total_addon_price;
        $this->page_data['primaryCard'] = $primaryCard;
        $this->page_data['addons'] = $addons;
        $this->page_data['plan'] = $plan;
        $this->page_data['default_plan_feature'] = $default_plan_feature;
        $this->page_data['client'] = $client;
        $this->page_data['offerCode'] = $offerCode;
        // $this->load->view('mycrm/membership', $this->page_data);
        $this->load->view('v2/pages/mycrm/membership', $this->page_data);
    }

    public function payment_methods()
    {
        $this->load->view('mycrm/payment_method', $this->page_data);
    }

    public function orders()
    {
        $this->page_data['page']->title = 'Orders';
        $this->page_data['page']->parent = 'Company';

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
        $payments = $this->CompanySubscriptionPayments_model->getAllByCompanyId($company_id);

        $this->page_data['payments'] = $payments;
        // $this->load->view('mycrm/order', $this->page_data);
        $this->load->view('v2/pages/mycrm/order', $this->page_data);
    }

    public function payment_balance()
    {
        $this->load->view('mycrm/payment_balance', $this->page_data);
    }

    public function company_update_auto_renewal()
    {
        $this->load->model('Clients_model');

        $company_id = logged('company_id');
        $post = $this->input->post();
        if ($post['is_active'] == 1) {
            $is_auto_renew = 1;
        } else {
            $is_auto_renew = 0;
        }

        $this->Clients_model->update($company_id, [
            'is_auto_renew' => $is_auto_renew,
        ]);

        echo json_encode(['is_success' => 1]);
    }

    public function company_upgrade_subscription()
    {
        $this->load->model('Business_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('Clients_model');
        $this->load->model('CompanySubscriptionPayments_model');

        $is_success = 0;
        $message = '';
        $company_id = logged('company_id');
        $post = $this->input->post();

        $plan = $this->NsmartPlan_model->getById($post['plan_id']);
        if ($plan) {
            if ($post['subscription_type'] == 'yearly') {
                $amount = $plan->price * 12;
                $next_billing_date = date('Y-m-d', strtotime('+1 year'));
            } else {
                $amount = $plan->price;
                $next_billing_date = date('Y-m-d', strtotime('+1 month'));
            }

            $company = $this->Business_model->getByCompanyId($company_id);
            $client = $this->Clients_model->getById($company_id);
            $address = $company->street.' '.$company->city.' '.$company->state;
            $zip_code = $company->postal_code;
            $converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code,
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success']) {
                $next_billing_date = date('Y-m-d', strtotime('+1 month'));
                $data = [
                    'payment_method' => 'converge',
                    'plan_date_registered' => date('Y-m-d'),
                    'plan_date_expiration' => date('Y-m-d', strtotime('+1 month')),
                    'date_modified' => date('Y-m-d H:i:s'),
                    'is_plan_active' => 1,
                    'nsmart_plan_id' => $plan->nsmart_plans_id,
                    'is_trial' => 0,
                    'payment_method' => 'converge',
                    'next_billing_date' => $next_billing_date,
                    'num_months_discounted' => 0,
                    'recurring_payment_type' => $post['subscription_type'],
                ];
                $this->Clients_model->update($company_id, $data);

                // Update access modules
                $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                if ($industryType) {
                    $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->id);
                    foreach ($industryModules as $im) {
                        $access_modules[] = $im->industry_module_id;
                    }

                    $this->session->set_userdata('userAccessModules', $access_modules);
                    $this->session->set_userdata('is_plan_active', 1);
                }

                // Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Paid Membership, '.ucwords($post['subscription_type']),
                    'payment_date' => date('Y-m-d'),
                    'total_amount' => $amount,
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);

                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $is_success = 1;
            } else {
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
        $message = '';
        $company_id = logged('company_id');
        $post = $this->input->post();

        $client = $this->Clients_model->getById($company_id);
        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        if ($plan) {
            if ($client->num_months_discounted > 0) {
                $amount = $plan->price;
            } else {
                $amount = $plan->discount;
            }

            $addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
            $total_addon_price = 0;
            foreach ($addons as $a) {
                $total_addon_price += $a->service_fee;
            }

            $amount += $total_addon_price;

            if ($client->recurring_payment_type == 'monthly') {
                $amount = $amount;
                $next_billing_date = date('Y-m-d', strtotime('+1 month', strtotime($client->next_billing_date)));
            } else {
                $amount *= 12;
                $next_billing_date = date('Y-m-d', strtotime('+1 year', strtotime($client->next_billing_date)));
            }

            $company = $this->Business_model->getByCompanyId($company_id);
            $address = $company->street.' '.$company->city.' '.$company->state;
            $zip_code = $company->postal_code;
            $converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code,
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success']) {
                $num_months_discounted = 0;
                if ($client->num_months_discounted > 0) {
                    $num_months_discounted = $client->num_months_discounted - 1;
                }

                $data = [
                    'payment_method' => 'converge',
                    // 'plan_date_registered' => date("Y-m-d"),
                    // 'plan_date_expiration' => date("Y-m-d", strtotime("+1 month")),
                    'date_modified' => date('Y-m-d H:i:s'),
                    'is_plan_active' => 1,
                    // 'nsmart_plan_id' => $plan->nsmart_plans_id,
                    'is_trial' => 0,
                    'next_billing_date' => $next_billing_date,
                    'num_months_discounted' => $num_months_discounted,
                ];
                $this->Clients_model->update($company_id, $data);

                // Update access modules
                $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                if ($industryType) {
                    $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->id);
                    foreach ($industryModules as $im) {
                        $access_modules[] = $im->industry_module_id;
                    }

                    $this->session->set_userdata('userAccessModules', $access_modules);
                    $this->session->set_userdata('is_plan_active', 1);
                }

                // Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Paid Membership, '.ucwords($client->recurring_payment_type),
                    'payment_date' => date('Y-m-d'),
                    'total_amount' => $amount,
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                $payment_id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($payment_id);

                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($payment_id, $data);

                // Send mail
                $this->send_invoice_email($payment_id);

                $is_success = 1;
            } else {
                $message = $result['msg'];
            }
        }

        echo json_encode(['is_success' => $is_success, 'message' => $message]);
    }

    public function converge_send_sale($data)
    {
        include APPPATH.'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = '';

        $exp_year = date('m/d/'.$data['exp_year']);
        $exp_date = $data['exp_month'].date('y', strtotime($exp_year));
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

    public function company_request_remove_addon()
    {
        $this->load->model('SubscriberNsmartUpgrade_model');

        $is_success = 0;
        $company_id = logged('company_id');
        $post = $this->input->post();

        $addon = $this->SubscriberNsmartUpgrade_model->getAddOnByClientIdAndId($company_id, $post['addon_id']);
        if ($addon) {
            $this->SubscriberNsmartUpgrade_model->update($addon->id, ['with_request_removal' => 1]);
            $is_success = 1;
        }

        $json = ['is_success' => $is_success];

        echo json_encode($json);
    }

    public function company_cancel_remove_addon()
    {
        $this->load->model('SubscriberNsmartUpgrade_model');

        $is_success = 0;
        $company_id = logged('company_id');
        $post = $this->input->post();

        $addon = $this->SubscriberNsmartUpgrade_model->getAddOnByClientIdAndId($company_id, $post['addon_id']);
        if ($addon) {
            $this->SubscriberNsmartUpgrade_model->update($addon->id, ['with_request_removal' => 0]);
            $is_success = 1;
        }

        $json = ['is_success' => $is_success];

        echo json_encode($json);
    }

    public function view_payment($id)
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment = $this->CompanySubscriptionPayments_model->getById($id);
        $company = $this->Business_model->getByCompanyId($payment->company_id);
        if ($payment->company_id == $company_id) {
            $this->page_data['payment'] = $payment;
            $this->page_data['company'] = $company;
            $this->page_data['page']->title = 'Orders : Payment Details';
            $this->page_data['page']->menu = 'cards_file';
            // $this->load->view('mycrm/view_payment_details', $this->page_data);
            $this->load->view('v2/pages/mycrm/view_payment_details', $this->page_data);
        } else {
            redirect('mycrm/orders');
        }
    }

    public function order_pdf($id)
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment = $this->CompanySubscriptionPayments_model->getById($id);
        $company = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment'] = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/subscription_order_pdf_template_a', $this->page_data, true);

        $this->load->library('Reportpdf');

        $title = 'subscription_order';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once dirname(__FILE__).'/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html.$content, true, false, true, false, '');
        // echo $display;
        $content = ob_get_contents();
        ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output($title, 'I');
    }

    public function send_statement_pdf($id)
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment = $this->CompanySubscriptionPayments_model->getById($id);
        $company = $this->Business_model->getByCompanyId($payment->company_id);
        $recipient = $company->business_email;

        $this->load->helper(['url', 'hashids_helper']);
        $imageUrl = getCompanyBusinessProfileImage();

        $data = [
            'payment' => $payment,
            'company' => $company,
        ];
        $config = ['subject' => 'PDF Statement'];
        if (logged('company_id') == 58) {
            $cc[] = 'bryann.revina03@gmail.com';
            $cc[] = 'moresecureadi@gmail.com';
            $cc[] = 'ntominbox@gmail.com';
            $config['cc'] = $cc;
        }
        $mail = email__getInstance($config);
        $mail->addAddress($recipient, $recipient);

        $mail->isHTML(true);
        $mail->Body = $this->load->view('mycrm/email_template/send_email_statement', $data, true);
    }

    public function pdf_statement($id)
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment = $this->CompanySubscriptionPayments_model->getById($id);
        $company = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment'] = $payment;
        $this->page_data['company'] = $company;
        $this->page_data['id'] = $id;
        $this->page_data['url'] = base_url('mycrm/send_statement_pdf/'.$id);
        $content = $this->load->view('mycrm/pdf_statement', $this->page_data, true);

        $this->load->library('Reportpdf');

        $title = 'PDF Statement';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $obj_pdf->setFontSubsetting(false);

        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once dirname(__FILE__).'/lang/eng.php';
            $pdf->setLanguageArray($l);
        }

        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html.$content, true, false, true, false, '');

        // Replace placeholder with hyperlink
        $obj_pdf->SetXY(110, 227.2); // Set position (adjust as needed)
        $obj_pdf->SetTextColor(255, 255, 255);
        $obj_pdf->SetFillColor(92, 184, 92);
        $obj_pdf->Cell(40, 10.5, 'Email', 0, 1, 'C', 1, $this->page_data['url']);

        $obj_pdf->Output($title, 'I');
    }

    public function invoice_pdf($id)
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment = $this->CompanySubscriptionPayments_model->getById($id);
        $company = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment'] = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/subscription_invoice_pdf_template_a', $this->page_data, true);

        $this->load->library('Reportpdf');

        $title = 'subscription_invoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once dirname(__FILE__).'/lang/eng.php';
            $pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html.$content, true, false, true, false, '');
        // echo $display;
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
        $message = '';
        $company_id = logged('company_id');
        $post = $this->input->post();

        $client = $this->Clients_model->getById($company_id);
        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        if ($plan) {
            $new_num_license = $client->number_of_license + $post['num_license'];
            $amount = $plan->price_per_license * $post['num_license'];

            $company = $this->Business_model->getByCompanyId($company_id);
            $address = $company->street.' '.$company->city.' '.$company->state;
            $zip_code = $company->postal_code;
            $converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code,
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success']) {
                $data = [
                    'number_of_license' => $new_num_license,
                ];
                $this->Clients_model->update($company_id, $data);

                // Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Paid Plan License',
                    'payment_date' => date('Y-m-d'),
                    'total_amount' => $amount,
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);

                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($id, $data);

                $is_success = 1;
            } else {
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
        if ($client->is_plan_active == 1) {
            // return redirect('mycrm/membership');
        }

        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $nsPlans = $this->NsmartPlan_model->getAll();
        $addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
        $lastPayment = $this->CompanySubscriptionPayments_model->getCompanyLastPayment($client->id);
        $firstPayment = $this->CompanySubscriptionPayments_model->getCompanyFirstPayment($client->id);
        $primaryCard = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
        $offerCode = $this->OfferCodes_model->getByClientId($company_id);

        $total_addon_price = 0;
        foreach ($addons as $a) {
            $total_addon_price += $a->service_fee;
        }

        $day = date('d', strtotime($client->plan_date_registered));
        $date_start = date('Y-m-'.$day);
        $start_billing_period = date('d-M-Y', strtotime($date_start));
        $end_billing_period = date('d-M-Y', strtotime('+1 months ', strtotime($start_billing_period)));

        $default_plan_feature = plan_default_features();
        if ($plan->plan_name == 'Simple Start') {
            $default_plan_feature = $default_plan_feature['simple-start'];
        } elseif ($plan->plan_name == 'Essential') {
            $default_plan_feature = $default_plan_feature['essential'];
        } elseif ($plan->plan_name == 'Plus') {
            $default_plan_feature = $default_plan_feature['plus'];
        } elseif ($plan->plan_name == 'PremierPro') {
            $default_plan_feature = $default_plan_feature['premier-pro'];
        } elseif ($plan->plan_name == 'Industry Specific') {
            $default_plan_feature = $default_plan_feature['industry-specific'];
        } elseif ($plan->plan_name == 'Enterprise') {
            $default_plan_feature = $default_plan_feature['enterprise'];
        }

        $this->page_data['plan_features'] = $plan_default_features;
        $this->page_data['lastPayment'] = $lastPayment;
        $this->page_data['firstPayment'] = $firstPayment;
        $this->page_data['nsPlans'] = $nsPlans;
        $this->page_data['start_billing_period'] = $start_billing_period;
        $this->page_data['end_billing_period'] = $end_billing_period;
        $this->page_data['total_monthly'] = $plan->price + $total_addon_price;
        $this->page_data['total_addon_price'] = $total_addon_price;
        $this->page_data['primaryCard'] = $primaryCard;
        $this->page_data['addons'] = $addons;
        $this->page_data['plan'] = $plan;
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
        if ($client->is_plan_active == 1) {
            // return redirect('mycrm/membership');
        }

        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $nsPlans = $this->NsmartPlan_model->getAll();
        $addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
        $lastPayment = $this->CompanySubscriptionPayments_model->getCompanyLastPayment($client->id);
        $firstPayment = $this->CompanySubscriptionPayments_model->getCompanyFirstPayment($client->id);
        $primaryCard = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
        $offerCode = $this->OfferCodes_model->getByClientId($company_id);

        $total_addon_price = 0;
        foreach ($addons as $a) {
            $total_addon_price += $a->service_fee;
        }

        $day = date('d', strtotime($client->plan_date_registered));
        $date_start = date('Y-m-'.$day);
        $start_billing_period = date('d-M-Y', strtotime($date_start));
        $end_billing_period = date('d-M-Y', strtotime('+1 months ', strtotime($start_billing_period)));

        $monthly = number_format($plan->price, 2);
        $yearly = number_format($plan->discount, 2);
        $yearly_total = number_format($plan->discount * 12, 2);

        $a_monthly = explode('.', $monthly);
        $a_yearly = explode('.', $yearly);
        $a_yearly_total = explode('.', $yearly_total);

        $this->page_data['plan_features'] = $plan_default_features;
        $this->page_data['lastPayment'] = $lastPayment;
        $this->page_data['firstPayment'] = $firstPayment;
        $this->page_data['nsPlans'] = $nsPlans;
        $this->page_data['start_billing_period'] = $start_billing_period;
        $this->page_data['end_billing_period'] = $end_billing_period;
        $this->page_data['total_monthly'] = $plan->price + $total_addon_price;
        $this->page_data['total_addon_price'] = $total_addon_price;
        $this->page_data['primaryCard'] = $primaryCard;
        $this->page_data['addons'] = $addons;
        $this->page_data['plan'] = $plan;
        $this->page_data['client'] = $client;
        $this->page_data['offerCode'] = $offerCode;
        $this->page_data['a_monthly'] = $a_monthly;
        $this->page_data['a_yearly'] = $a_yearly;
        $this->page_data['a_yearly_total'] = $a_yearly_total;
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
        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        $company_total_users = $this->Users_model->countAllCompanyUsers($company_id);

        if ($post['plan_type'] == 'monthly') {
            $plan_type = 'monthly';
            $membership_price = $plan->price;
            $license_total_price = $plan->price_per_license;
            $billing_start = date('d-M-Y');
            $billing_end = date('d-M-Y', strtotime('+1 month'));
        } else {
            $plan_type = 'yearly';
            $membership_price = $plan->discount * 12;
            // $license_total_price = $plan->price_per_license * 12;
            $license_total_price = $plan->price_per_license;
            $billing_start = date('d-M-Y');
            $billing_end = date('d-M-Y', strtotime('+1 year'));
        }

        $billing_period = $billing_start.' to '.$billing_end;
        $grand_total = $membership_price + $license_total_price;
        $remaining_license = $client->number_of_license - $company_total_users;
        if ($remaining_license < 0) {
            $remaining_license = 0;
        }

        $this->page_data['billing_period'] = $billing_period;
        $this->page_data['grand_total'] = $grand_total;
        $this->page_data['license_total_price'] = $license_total_price;
        $this->page_data['membership_price'] = $membership_price;
        $this->page_data['remaining_license'] = $remaining_license;
        $this->page_data['plan'] = $plan;
        $this->page_data['plan_type'] = $plan_type;
        $this->load->view('mycrm/ajax_load_plan_payment_form', $this->page_data);
    }

    public function ajax_renew_subscription()
    {
        $this->load->model('Business_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('Clients_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('SubscriberNsmartUpgrade_model');

        $is_success = 0;
        $message = '';
        $company_id = logged('company_id');
        $post = $this->input->post();

        $client = $this->Clients_model->getById($company_id);
        $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
        if ($plan) {
            if ($post['membership_plan_type'] == 'monthly') {
                $recurring_payment_type = 'monthly';
                $membership_price = $plan->price;
                $license_total_price = $post['num_license'] * $plan->price_per_license;
                $billing_start = date('Y-m-d');
                $billing_end = date('Y-m-d', strtotime('+1 month'));
            } else {
                $recurring_payment_type = 'yearly';
                $membership_price = $plan->discount * 12;
                $license_total_price = ($post['num_license'] * $plan->price_per_license) * 12;
                $billing_start = date('Y-m-d');
                $billing_end = date('Y-m-d', strtotime('+1 year'));
            }

            $amount = $membership_price + $license_total_price;
            $company = $this->Business_model->getByCompanyId($company_id);
            $address = $company->street.' '.$company->city.' '.$company->state;
            $zip_code = $company->postal_code;
            $converge_data = [
                'company_id' => $company->company_id,
                'amount' => $amount,
                'card_number' => $post['card_number'],
                'exp_month' => $post['exp_month'],
                'exp_year' => $post['exp_year'],
                'card_cvc' => $post['cvc'],
                'address' => $address,
                'zip' => $zip_code,
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success'] == 1) {
                $new_total_num_license = $client->number_of_license + $post['num_license'];
                $data = [
                    'plan_date_expiration' => $billing_end,
                    'number_of_license' => $new_total_num_license,
                    'date_modified' => date('Y-m-d H:i:s'),
                    'is_plan_active' => 1,
                    'is_trial' => 0,
                    'recurring_payment_type' => $recurring_payment_type,
                    'payment_method' => 'converge',
                    'next_billing_date' => $billing_end,
                    'renewal_date' => date('Y-m-d'),
                    'num_months_discounted' => 0,
                ];
                $this->Clients_model->update($company_id, $data);

                // Record payment
                $data_payment = [
                    'company_id' => $company_id,
                    'description' => 'Renew Membership, '.ucfirst($post['membership_plan_type']),
                    'payment_date' => date('Y-m-d'),
                    'total_amount' => $amount,
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                $payment_id = $this->CompanySubscriptionPayments_model->create($data_payment);
                $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($payment_id);

                $data = ['order_number' => $order_number];
                $this->CompanySubscriptionPayments_model->update($payment_id, $data);

                $this->session->set_userdata('is_plan_active', 1);

                // Send mail
                $this->send_invoice_email($payment_id);

                $is_success = 1;
            } else {
                $message = $result['msg'];
            }

            echo json_encode(['is_success' => $is_success, 'message' => $message]);
        }
    }

    public function send_invoice_email($payment_id)
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment = $this->CompanySubscriptionPayments_model->getById($payment_id);
        $company = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment'] = $payment;
        $this->page_data['company'] = $company;
        $body = $this->load->view('mycrm/email_template/invoice', $this->page_data, true);
        $attachment = $this->create_attachment_invoice($payment_id);

        $subject = 'nSmarTrac: Order# '.$payment->order_number;
        $to = 'webtestcustomer@nsmartrac.com';

        $data = [
            'to' => 'webtestcustomer@nsmartrac.com',
            'subject' => $subject,
            'body' => $body,
            'cc' => '',
            'bcc' => '',
            'attachment' => $attachment,
        ];

        $isSent = sendEmail($data);

        return true;
    }

    public function create_attachment_invoice($payment_id)
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $payment = $this->CompanySubscriptionPayments_model->getById($id);
        $company = $this->Business_model->getByCompanyId($payment->company_id);
        $this->page_data['payment'] = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/subscription_invoice_pdf_template_a', $this->page_data, true);

        $this->load->library('Reportpdf');
        $title = 'subscription_invoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        // $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetMargins(10, 5, 10, 0, true);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // $obj_pdf->SetFont('courierI', '', 9);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once dirname(__FILE__).'/lang/eng.php';
            $obj_pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html.$content, true, false, true, false, '');
        ob_clean();
        $obj_pdf->lastPage();
        // $obj_pdf->Output($title, 'I');
        $filename = strtolower($payment->order_number).'.pdf';
        $file = dirname(__DIR__, 2).'/uploads/subscription_invoice/'.$filename;
        $obj_pdf->Output($file, 'F');

        // $obj_pdf->Output($file, 'F');
        return $file;
    }

    public function ajax_load_employee_list()
    {
        $this->load->model('Users_model');

        $company_id = logged('company_id');
        $users = $this->users_model->getCompanyUsers($company_id);
        $total_users = count($users);

        $this->page_data['users'] = $users;
        $this->page_data['total_users'] = $total_users;
        $this->load->view('mycrm/ajax_load_employee_list', $this->page_data);
    }

    public function ajax_delete_employee()
    {
        $this->load->model('Users_model');

        $is_success = false;

        $post = $this->input->post();
        $company_id = logged('company_id');

        if ($this->Users_model->getCompanyUser($post['eid'], $company_id)) {
            $this->Users_model->deleteCompanyUser($post['eid'], $company_id);
            $is_success = true;
        }

        $json_data = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function ajax_add_employee()
    {
        $this->load->model('Users_model');
        $this->load->model('Clients_model');

        $is_success = false;
        $err_num = 0;

        $post = $this->input->post();
        $company_id = logged('company_id');

        $client = $this->Clients_model->getById($company_id);
        $company_total_users = $this->Users_model->countAllCompanyUsers($company_id);
        $total_license = $client->number_of_license - $company_total_users;
        if ($total_license > 0) {
            $isEmailExists = $this->Users_model->getCompanyUserByEmail($company_id, $post['manage_employee_email']);
            if (empty($isEmailExists)) {
                $data_user = [
                    'FName' => $post['manage_employee_fname'],
                    'LName' => $post['manage_employee_lname'],
                    'email' => $post['manage_employee_email'],
                    'username' => $post['manage_employee_email'],
                    'password' => '',
                    'password_plain' => '',
                    'role' => '',
                    'user_type' => '',
                    'status' => 1,
                    'company_id' => $company_id,
                ];
                $this->Users_model->addNewEmployee($data_user);
                $is_success = true;
            } else {
                $err_num = 2;
            }
        } else {
            $err_num = 1;
        }

        $json_data = ['is_success' => $is_success, 'err_num' => $err_num];

        echo json_encode($json_data);
    }

    public function ajax_add_multi_account()
    {
        $this->load->helper(['hashids_helper']);

        $this->load->model('Users_model');
        $this->load->model('CompanyMultiAccount_model');
        $this->load->model('Business_model');

        $is_success = 0;
        $msg = '';
        $email = '';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $validate = $this->checkCompanyMaxLinkAccount();
        if ($validate['is_limit'] == 1) {
            $msg = $validate['msg'];
        } else {
            $login_data = ['username' => $post['multi_email'], 'password' => $post['multi_password']];
            $isValid = $this->Users_model->attempt($login_data);
            if ($isValid == 'valid') {
                // Create data
                $user = $this->Users_model->getUserByEmail($post['multi_email']);
                if ($user->company_id != $company_id) {
                    // Check if company id already in the list. Can only accept 1 company user
                    $isExists = $this->CompanyMultiAccount_model->getByParentCompanyIdAndLinkCompanyId($company_id, $user->company_id);
                    if ($isExists) {
                        $msg = 'An account under company <b>'.$isExists->company_name.'</b> already exists. Cannot accept more than 1 account under same company';
                    } else {
                        if ($user->status == 1) {
                            $data_multi = [
                                'parent_company_id' => $company_id,
                                'link_company_id' => $user->company_id,
                                'link_user_id' => $user->id,
                                'status' => $this->CompanyMultiAccount_model->statusNotVerified(),
                                'created' => date('Y-m-d H:i:s'),
                            ];

                            $lastId = $this->CompanyMultiAccount_model->create($data_multi);
                            $hash_id = hashids_encrypt($lastId, '', 15);
                            $this->CompanyMultiAccount_model->update($lastId, ['hash_id' => $hash_id]);

                            // Send activation link
                            $is_sent = $this->sendMultiAccountActivationEmail($hash_id, $user->email);

                            $email = $user->email;
                            $is_success = 1;
                        } else {
                            $msg = 'Email <b>'.$post['multi_email'].'</b> is currently inactive. Cannot login email.';
                        }
                    }
                } else {
                    $business = $this->Business_model->getByCompanyId($company_id);
                    $msg = 'Email <b>'.$post['multi_email'].'</b> belongs to current logged company <b>'.$business->business_name.'</b>. Cannot link company data.';
                }
            } else {
                $msg = 'Invalid email / password';
            }
        }

        $json_data = ['is_success' => $is_success, 'email' => $email, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_load_multi_account_list()
    {
        $this->load->model('CompanyMultiAccount_model');

        $company_id = logged('company_id');

        $multiAccounts = $this->CompanyMultiAccount_model->getByAllByCompanyParentId($company_id);

        $this->page_data['status_verified'] = $this->CompanyMultiAccount_model->statusVerified();
        $this->page_data['multiAccounts'] = $multiAccounts;
        $this->load->view('v2/pages/mycrm/ajax_load_multi_account_list', $this->page_data);
    }

    public function ajax_delete_multi_account()
    {
        $this->load->model('CompanyMultiAccount_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $multiAccount = $this->CompanyMultiAccount_model->getByIdAndParentCompanyId($post['mid'], $company_id);
        if ($multiAccount) {
            $this->CompanyMultiAccount_model->delete($multiAccount->id);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_resend_multi_account_activation_email()
    {
        $this->load->model('CompanyMultiAccount_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $multiAccount = $this->CompanyMultiAccount_model->getByParentCompanyIdAndLinkUserId($company_id, $post['uid']);
        if ($multiAccount) {
            if ($multiAccount->status == $this->CompanyMultiAccount_model->statusNotVerified()) {
                $isSent = $this->sendMultiAccountActivationEmail($multiAccount->hash_id, $multiAccount->user_email);
                if ($isSent == 1) {
                    $is_success = 1;
                    $msg = '';
                } else {
                    $msg = 'Cannot send email. Please contact system administrator.';
                }
            } else {
                $msg = 'Account already verified. Cannot resend activation email.';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function sendMultiAccountActivationEmail($hash_id, $recipient_email)
    {
        $is_sent = 1;

        $subject = 'nSmarTrac: Multi Account Activation';

        $activation_link = base_url('activate_multi_account/'.$hash_id);
        $msg = '<p>To activate your multi account click the link below.</p><br />';
        $msg .= "<a href='".$activation_link."'>Activate Multi Account</a>";
        $msg .= '<br /><br />From <br />nSmartrac Team';

        $mail = email__getInstance(['subject' => $subject]);
        $mail->FromName = 'nSmarTrac';
        $mail->addAddress($recipient_email, $recipient_email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $msg;
        if (!$mail->Send()) {
            $is_sent = 0;
        }

        return $is_sent;
    }

    public function ajax_hdr_load_multi_account_list()
    {
        $this->load->model('CompanyMultiAccount_model');

        $loggedMultiAccount = getSessionParentMultiAccount();
        $company_id = logged('company_id');
        $conditions[] = ['field' => 'company_multi_accounts.status', 'value' => $this->CompanyMultiAccount_model->statusVerified()];
        $multiAccounts = $this->CompanyMultiAccount_model->getByAllByCompanyParentId($company_id, $conditions);
        $profiledata = $this->business_model->getByCompanyId($company_id);

        $this->page_data['multiAccounts'] = $multiAccounts;
        $this->page_data['loggedMultiAccount'] = $loggedMultiAccount;
        $this->page_data['profiledata'] = $profiledata;
        $this->load->view('v2/pages/mycrm/ajax_hdr_load_multi_account_list', $this->page_data);
    }

    public function ajax_login_multi_account()
    {
        $this->load->model('CompanyMultiAccount_model');
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');
        $this->load->model('CompanyDeactivatedModule_model');

        $is_valid = 0;
        $msg = '';

        $post = $this->input->post();
        $user_id = logged('id');
        $company_id = logged('company_id');

        $multiAccount = $this->CompanyMultiAccount_model->getByParentCompanyIdAndHashId($company_id, $post['hashid']);
        if ($multiAccount) {
            // Login User
            $user = $this->Users_model->getUserByID($multiAccount->link_user_id);
            $client = $this->Clients_model->getById($user->company_id);
            if ($client->is_plan_active == 3) {
                $msg = 'Company account is currently disabled. Cannot login.';
            } else {
                $data = ['username' => $user->username, 'password' => $user->password_plain];
                $attempt = $this->Users_model->attempt($data, true);
                if ($attempt == 'valid') {
                    // Get all access modules
                    if ($user->role == 1 || $user->role == 2) { // Admin and nsmart tech
                        $access_modules = [0 => 'all'];
                    } else {
                        if ($client) {
                            $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                            if ($industryType) {
                                $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->industry_template_id);
                                foreach ($industryModules as $im) {
                                    $access_modules[] = $im->industry_module_id;
                                }
                            }
                        }
                    }

                    // Get company deactivated modules
                    $deactivatedModules = $this->CompanyDeactivatedModule_model->getAllByCompanyId($client->id);
                    $deactivated_modules = [];

                    foreach ($deactivatedModules as $dm) {
                        $deactivated_modules[$dm->industry_module_id] = $dm->industry_module_id;
                    }

                    $this->session->set_userdata('deactivated_modules', $deactivated_modules);
                    $this->session->set_userdata('userAccessModules', $access_modules);
                    $this->session->set_userdata('is_plan_active', $client->is_plan_active);
                    $this->session->set_userdata('multi_account_parent_company_id', $company_id);
                    $this->session->set_userdata('multi_account_parent_user_id', $user_id);

                    $is_valid = 1;
                    $msg = '';
                } else {
                    $msg = 'Invalid multi account login password.';
                }
            }
            if ($attempt == 'valid') {
                $this->Users_model->login($user);
                $client = $this->Clients_model->getById($user->company_id);
                if ($client->is_plan_active == 3) {
                    $msg = 'Company account is currently disabled. Cannot login.';
                } else {
                    // Get all access modules
                    if ($user->role == 1 || $user->role == 2) { // Admin and nsmart tech
                        $access_modules = [0 => 'all'];
                    } else {
                        if ($client) {
                            $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                            if ($industryType) {
                                $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->industry_template_id);
                                foreach ($industryModules as $im) {
                                    $access_modules[] = $im->industry_module_id;
                                }
                            }
                        }
                    }

                    // Get company deactivated modules
                    $deactivatedModules = $this->CompanyDeactivatedModule_model->getAllByCompanyId($client->id);
                    $deactivated_modules = [];

                    foreach ($deactivatedModules as $dm) {
                        $deactivated_modules[$dm->industry_module_id] = $dm->industry_module_id;
                    }

                    $this->session->set_userdata('deactivated_modules', $deactivated_modules);
                    $this->session->set_userdata('userAccessModules', $access_modules);
                    $this->session->set_userdata('is_plan_active', $client->is_plan_active);
                    $this->session->set_userdata('multi_account_parent_company_id', $company_id);
                    $this->session->set_userdata('multi_account_parent_user_id', $user_id);

                    $is_valid = 1;
                    $msg = '';
                }
            } else {
                $msg = 'Invalid multi account login password.';
            }
        } else {
            $msg = 'Cannot find multi account data.';
        }

        $json_data = ['is_valid' => $is_valid, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_login_main_multi_account()
    {
        $this->load->model('CompanyMultiAccount_model');
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('IndustryType_model');
        $this->load->model('IndustryTemplateModules_model');
        $this->load->model('CompanyDeactivatedModule_model');

        $is_valid = 0;
        $msg = '';

        $multi_parent_company_id = $this->session->userdata('multi_account_parent_company_id');
        $multi_parent_user_id = $this->session->userdata('multi_account_parent_user_id');
        if ($multi_parent_company_id > 0 && $multi_parent_user_id > 0) {
            $user = $this->Users_model->getUserByID($multi_parent_user_id);
            $client = $this->Clients_model->getById($user->company_id);

            $this->Users_model->login($user);
            // Get all access modules
            if ($user->role == 1 || $user->role == 2) { // Admin and nsmart tech
                $access_modules = [0 => 'all'];
            } else {
                if ($client) {
                    $industryType = $this->IndustryType_model->getById($client->industry_type_id);
                    if ($industryType) {
                        $industryModules = $this->IndustryTemplateModules_model->getAllByTemplateId($industryType->industry_template_id);
                        foreach ($industryModules as $im) {
                            $access_modules[] = $im->industry_module_id;
                        }
                    }
                }
            }

            // Get company deactivated modules
            $deactivatedModules = $this->CompanyDeactivatedModule_model->getAllByCompanyId($client->id);
            $deactivated_modules = [];

            foreach ($deactivatedModules as $dm) {
                $deactivated_modules[$dm->industry_module_id] = $dm->industry_module_id;
            }

            $this->session->set_userdata('deactivated_modules', $deactivated_modules);
            $this->session->set_userdata('userAccessModules', $access_modules);
            $this->session->set_userdata('is_plan_active', $client->is_plan_active);
            $this->session->set_userdata('multi_account_parent_company_id', $company_id);
            $this->session->set_userdata('multi_account_parent_user_id', $user_id);

            $this->session->unset_userdata('multi_account_parent_company_id');
            $this->session->unset_userdata('multi_account_parent_user_id');

            $is_valid = 1;
            $msg = '';
        } else {
            $msg = 'Cannot find main account data';
        }

        $json_data = ['is_valid' => $is_valid, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_check_company_max_link_account()
    {
        $json_data = $this->checkCompanyMaxLinkAccount();
        echo json_encode($json_data);
    }

    public function checkCompanyMaxLinkAccount()
    {
        $this->load->model('CompanyMultiAccount_model');

        $is_limit = 0;
        $msg = '';
        $company_id = logged('company_id');
        $max_link_account = $this->CompanyMultiAccount_model->maxLinkAccount();
        $companyAccounts = $this->CompanyMultiAccount_model->getByAllByCompanyParentId($company_id);
        if (count($companyAccounts) >= $max_link_account) {
            $is_limit = 1;
            $msg = 'You have reached maximum link account ('.$max_link_account.'). Cannot link more account.';
        }

        $validate = ['is_limit' => $is_limit, 'msg' => $msg];

        return $validate;
    }
}

/* End of file Mycrm.php */

/* Location: ./application/controllers/Mycrm.php */
