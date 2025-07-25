<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->checkLogin();
        $this->hasAccessModule(8);

		$this->page_data['page_title'] = 'Settings';
		$this->load->helper(array('form', 'url', 'hashids_helper', 'functions'));
		$this->load->library('session');

        
        //load Model
        $this->load->model('General_model', 'general_model');

        add_css(array(
            'assets/textEditor/summernote-bs4.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
            'assets/textEditor/summernote-bs4.js'
        ));
	}

    public function schedule()
    {
        $this->load->model('CalendarSettings_model');
        $this->load->model('ColorSettings_model');
        $this->load->model('GoogleAccounts_model');

        if(!checkRoleCanAccessModule('calendar-settings', 'read')){
            show403Error();
            return false;
        }  

        $get        = $this->input->get();
        $company_id = logged('company_id');
        $settings = $this->CalendarSettings_model->getByCompanyId($company_id);      

        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
        ));

        add_footer_js(array(
            'assets/js/v2/bootstrap-datetimepicker.v2.min.js',
            'assets/frontend/js/settings/main.js',
        ));
        
        $googleAccount = $this->GoogleAccounts_model->getByCompanyId($company_id);
        $is_glink = false;
        if( $googleAccount ){
            $is_glink = true;
        }

        $args = array('company_id' => $company_id);
        $colorSettings = $this->ColorSettings_model->getByWhere($args);
        
        $this->page_data['google_credentials'] = google_credentials();
        $this->page_data['module'] = 'calendar';
        $this->page_data['googleAccount'] = $googleAccount;
        $this->page_data['colorSettings'] = $colorSettings;
        $this->page_data['is_glink'] = $is_glink;
        $this->page_data['page']->menu = 'settings';
        $this->page_data['page']->title = 'Calendar Settings';
		$this->page_data['page']->parent = 'Calendar';
        $this->page_data['settings'] = $settings;
        // $this->load->view('settings/schedule', $this->page_data);
        $this->load->view('v2/pages/settings/schedule', $this->page_data);
    }

    public function email_templates()
    {
        if(!checkRoleCanAccessModule('settings-email-templates', 'write')){
            show403Error();
            return false;
        }

        $company_id = logged('company_id');
        $get_company_templates = array(
            'where' => array(
                'company_id' => $company_id,
            )
        );
        $emailTemplates = $this->general_model->get_all_with_keys($get_company_templates,'settings_email_template');

        $this->page_data['invoice_templates'] = $emailTemplates;
        $this->page_data['page']->menu = 'email_templates';
        $this->page_data['page']->title = 'Email Templates';
        $this->page_data['page']->parent = 'Company';        
        $this->load->view('v2/pages/settings/email_templates/list', $this->page_data);
    }

    public function email_templates_edit($id=null)
    {
        if(!checkRoleCanAccessModule('settings-email-templates', 'write')){
            show403Error();
            return false;
        }
        
        $input = $this->input->post();
        if ($input) {
            $input['user_id'] = logged('id');
            $input['date_added'] = date("d-m-Y h:i A");
            if($this->customer_ad_model->add($input,"customer_groups")){
                redirect(base_url('customer/group'));
            }
        }

        $get_template_data = array(
            'where' => array(
                'id' => $id,
            )
        );
        $this->page_data['template'] = $this->general_model->get_all_with_keys($get_template_data,'settings_email_template',FALSE);

        if(empty($this->page_data['template'])){
            redirect(base_url('settings/email_templates'));
        }

        $this->page_data['page']->menu = 'email_templates';
        $this->page_data['page']->title = 'Email Templates';
        $this->page_data['page']->parent = 'Company';      
        $this->load->view('v2/pages/settings/email_templates/edit', $this->page_data);        
    }

    public function email_templates_create()
    {
        if(!checkRoleCanAccessModule('settings-email-templates', 'write')){
            show403Error();
            return false;
        }

        $input = $this->input->post();
        if ($input) {
            unset($input['files']);
            $input['user_id'] = 0;
            $input['date_created'] = date("d-m-Y h:i A");
            if($this->general_model->add_($input,"settings_email_template")){
                redirect(base_url('settings/email_templates'));
            }
        }

        $this->page_data['page']->menu = 'email_templates';
        $this->page_data['page']->title = 'Email Templates';
        $this->page_data['page']->parent = 'Company';      
        $this->load->view('v2/pages/settings/email_templates/add', $this->page_data);
    }


    public function create_sms_template()
    {
        $this->load->model('SmsTemplate_model');

        $input = $this->input->post();
        if ($input) {
            unset($input['files']);
            $input['user_id'] = 0;
            $input['date_created'] = date("d-m-Y h:i A");
            if($this->general_model->add_($input,"settings_email_template")){
                redirect(base_url('settings/email_templates'));
            }
        }

        $this->page_data['option_template_types'] = $this->SmsTemplate_model->optionTemplateTypes();
        $this->page_data['option_details'] = $this->SmsTemplate_model->optionDetails();
        $this->page_data['page']->menu = 'email_templates';
        $this->load->view('settings/create_sms_template', $this->page_data);
    }

    public function edit_sms_template($id=null)
    {
        $this->load->model('SmsTemplate_model');

        $company_id  = logged('company_id');
        $smsTemplate = $this->SmsTemplate_model->getByIdAndCompanyId($id, $company_id);
        if( $smsTemplate ){
            $this->page_data['smsTemplate'] = $smsTemplate;
            $this->page_data['option_template_types'] = $this->SmsTemplate_model->optionTemplateTypes();
            $this->page_data['option_details'] = $this->SmsTemplate_model->optionDetails();
            $this->page_data['page']->menu = 'email_templates';
            $this->load->view('settings/edit_sms_template', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Cannot find data.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect(base_url('settings/sms_templates'));
        }
    }

    public function ajax_update_sms_template()
    {
        $this->load->model('SmsTemplate_model');

        $is_success = 0;

        $post       = $this->input->post();
        $company_id = logged('company_id');
        $smsTemplate = $this->SmsTemplate_model->getByIdAndCompanyId($post['smstid'], $company_id);
        if( $smsTemplate ){
            $data = [
                'type_id' => $post['type_id'],
                'title' => $post['title'],
                'details' => $post['details'],
                'sms_body' => $post['sms_body']
            ];
            
            $this->SmsTemplate_model->update($smsTemplate->id, $data);

            $is_success = 1;
        }
        
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function sms_templates()
    {   
        if(!checkRoleCanAccessModule('settings-sms-templates', 'read')){
			show403Error();
			return false;
		}

		$this->page_data['page']->title = 'SMS Templates';
        $this->page_data['page']->parent = 'Company';

        $this->load->model('SmsTemplate_model');

        $company_id = logged('company_id');
        $template_types = $this->SmsTemplate_model->optionTemplateTypes();
        $smsTemplates   = $this->SmsTemplate_model->getAllByCompanyId($company_id);

        $data_sms_templates = array();

        foreach($template_types as $key => $value){
            $data_sms_templates[$key]['name'] = $value;
            $data_sms_templates[$key]['data'] = array();
            foreach( $smsTemplates as $t ){
                if( $t->type_id == $key ){
                    $data_sms_templates[$key]['data'][] = $t;
                }
            }
        }

        $this->page_data['option_template_types'] = $this->SmsTemplate_model->optionTemplateTypes();
        $this->page_data['option_details'] = $this->SmsTemplate_model->optionDetails();
        $this->page_data['data_sms_templates'] = $data_sms_templates;
        $this->page_data['page']->menu = 'sms_templates';
        // $this->load->view('settings/sms_templates', $this->page_data);
        $this->load->view('v2/pages/settings/sms_templates', $this->page_data);
    }

    public function email_branding()
    {
		$this->page_data['page']->title = 'Email Branding';
        $this->page_data['page']->parent = 'Company';

        $this->load->model('SettingEmailBranding_model');

        $user = $this->session->userdata('logged');
        $company_id = logged('company_id');
        $settingEmailBranding = $this->SettingEmailBranding_model->findByCompanyId($company_id);

        if( $settingEmailBranding ){
            $setting_data = [
                'uid' => $user['id'],
                'email_from_name' => $settingEmailBranding->email_from_name,
                'email_template_footer_text' => $settingEmailBranding->email_template_footer_text,
                'logo' => $settingEmailBranding->logo,
            ];
        }else{
            $setting_data = [
                'uid' => $user['id'],
                'email_from_name' => '',
                'email_template_footer_text' => '',
                'logo' => ''
            ];
        }

        $this->page_data['page']->menu   = 'email_branding';
        $this->page_data['setting_data'] = $setting_data;
        // $this->load->view('settings/email_branding', $this->page_data);
        $this->load->view('v2/pages/settings/email_branding', $this->page_data);
    }

	public function notifications()
	{
		$this->page_data['page']->title = 'Notifications';
        $this->page_data['page']->parent = 'Company';

        $this->load->model('SettingNotification_model');
        $setting_data = "";
        $user = $this->session->userdata('logged');
        if($user) {
            $settingNotifications = $this->SettingNotification_model->getAllByUserId($user['id']);

            if( $settingNotifications ){
                $setting_notifications_data = $settingNotifications;

                $setting_data = array();
                foreach($setting_notifications_data as $settign_notif) {
                    $setting_data[$settign_notif->name] = $settign_notif->value;
                }
            }

        }

		$this->page_data['page']->menu = 'notifications';
        $this->page_data['setting_data'] = $setting_data;
		// $this->load->view('settings/notifications', $this->page_data);
		$this->load->view('v2/pages/settings/notifications', $this->page_data);
	}

    public function online_payments()
    {
        $this->load->model('SettingOnlinePayment_model');

        $user = $this->session->userdata('logged');

        $settingOnlinePayment = $this->SettingOnlinePayment_model->findByUserId($user['id']);

        if( $settingOnlinePayment ){
            $setting = [
                'paypal_email' => $settingOnlinePayment->paypal_email_address,
                'is_active' => $settingOnlinePayment->paypal_is_active
            ];
        }else{
            $setting = [
                'paypal_email' => '',
                'is_active' => 0
            ];
        }

        $this->page_data['setting'] = $setting;
        $this->page_data['page']->menu = 'online_payments';
        $this->load->view('settings/online_payments', $this->page_data);
    }

	/*public function notifications()
	{
		//ifPermissions('notifications');
		$this->page_data['page']->menu = 'notifications';
		$this->load->view('settings/notifications', $this->page_data);
	}*/

    public function tax_rates()
    {
		$this->page_data['page']->title = 'Tax Rates';
        $this->page_data['page']->parent = 'Sales';
        
        $company_id = logged('company_id');

        $this->load->model('TaxRates_model');
        $this->load->model('Users_model');

        $user = $this->session->userdata('logged');
        $user = $this->Users_model->getUser($user['id']);

        $taxRates = $this->TaxRates_model->getAllByCompanyId($company_id, true);
        if(!empty(get('search'))) {
            $search = get('search');
            $taxRates = array_filter($taxRates, function($taxRate, $key) use ($search) {
                return (stripos($taxRate['name'], $search) !== false);
            }, ARRAY_FILTER_USE_BOTH);

            $this->page_data['search'] = $search;
        }

        $this->page_data['taxRates'] = $taxRates;
        $this->page_data['page']->menu = 'tax_rates';
        $this->load->view('v2/pages/settings/tax_rates', $this->page_data);
    }

    public function create_tax_rate()
    {
        $this->load->model('TaxRates_model');
        $this->load->model('Users_model');

        $user = $this->session->userdata('logged');
        $user = $this->Users_model->getUser($user['id']);
        $post = $this->input->post();
        $comp_id = logged('company_id');

        // dd($post);

        if( !empty($post) ){
            // if( $user ){
            //     $is_default = 0;
            //     if( $post['is_default'] ){
                    $is_default = 1;
                // }
                $data = [
                    'name' => $post['tax_name'],
                    'rate' => $post['tax_rate'],
                    'is_default' => $is_default,
                    'company_id' => $comp_id
                ];

                $taxRates = $this->TaxRates_model->create($data);

                $this->session->set_flashdata('message', 'Add tax rate was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');

            // }else{
            //     $this->session->set_flashdata('message', 'Cannot find user');
            //     $this->session->set_flashdata('alert_class', 'alert-danger');
            // }

        }else{
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('settings/tax_rates');
    }

    public function ajax_edit_tax_rate()
    {
        $this->load->model('TaxRates_model');

        $post = $this->input->post();

        $taxRate = $this->TaxRates_model->getById($post['tid']);

        $this->page_data['taxRate'] = $taxRate;
        $this->load->view('v2/pages/settings/ajax_edit_tax_rate', $this->page_data);
    }

    public function update_tax_rate()
    {
        $this->load->model('TaxRates_model');
        $post = $this->input->post();
        $id   = $post['tid'];

        if( !empty($post) ){
            $is_default = 0;
            if( $post['is_default'] ){
                $is_default = 1;
            }
            $data = [
                'name' => $post['tax_name'],
                'rate' => $post['tax_rate'],
                'is_default' => $is_default
            ];

            $taxRates = $this->TaxRates_model->update($id, $data);

            $this->session->set_flashdata('message', 'Update tax rate was successful');
            $this->session->set_flashdata('alert_class', 'alert-success');

        }else{
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('settings/tax_rates');
    }

    public function delete_tax_rate()
    {
        $this->load->model('TaxRates_model');
        $this->TaxRates_model->delete(post('tid'));

        $this->session->set_flashdata('message', 'Tax rate has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('settings/tax_rates');
    }

    public function files_vault()
    {
        $this->load->view('settings/files_vault', $this->page_data);
    }

    public function quick_books()
    {
        $this->load->view('settings/quick_books', $this->page_data);
    }

    public function update_email_branding_setting()
    {
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $company_id = logged('company_id');

        $config['upload_path'] = 'uploads/email_branding/' . $user['id'];

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['file_name'] = $_FILES['file-logo']['name'];
        $config['allowed_types'] = 'gif|jpeg|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( !$this->upload->do_upload('file-logo')) {
            $logo_image = '';
        } else {
            $data = array('upload_data' => $this->upload->data());
            $logo_image = $data['upload_data']['file_name'];
        }

        if( !empty($post) ){
            $this->load->model('SettingEmailBranding_model');

            $settingEmailBranding = $this->SettingEmailBranding_model->findByCompanyId($company_id);
            if( $settingEmailBranding ){
                $data = array(
                    'email_from_name' => post('email_from_name'),
                    'email_template_footer_text' => post('email_template_footer_text'),
                    'logo' => $logo_image,
                    'updated' => date("Y-m-d H:i:s")
                );

                $this->SettingEmailBranding_model->update($settingEmailBranding->id,$data);

            }else{
                $data = array(
                    'company_id' => $company_id,
                    'user_id' => $user['id'],
                    'email_from_name' => post('email_from_name'),
                    'email_template_footer_text' => post('email_template_footer_text'),
                    'logo' => $logo_image,
                    'created' => date("Y-m-d H:i:s")
                );

                $settingEmailBranding = $this->SettingEmailBranding_model->create($data);
            }

            //Activity Logs
            $activity_name = 'Updated Email Branding Settings'; 
            createActivityLog($activity_name);

            // $this->session->set_flashdata('message', 'Your email branding setting was updated');
            // $this->session->set_flashdata('alert_class', 'alert-success');
        }

        redirect('settings/email_branding');
    }

    public function update_notification_setting()
    {
        postAllowed();
        $this->load->model('SettingNotification_model');

        /*
        $default_notify_by_email = "";
        $default_notify_by_sms = "";
        $event_notify_customer_on_add = "";
        $event_notify_customer_on_update = "";
        $same_as_residential = "";
        $event_notify_customer_on_add_commercial = "";
        $event_notify_customer_on_update_commercial = "";
        $event_notify_at = "";
        $event_notify_at_headsup_1 = "";
        $event_notify_at_headsup_2 = "";
        $event_notify_at_business = "";
        $event_notify_at_task = "";
        $estimate_send_to_business = "";
        $invoice_send_to_business = "";
        $work_order_notify_on_employee_action = "";
        $event_notify_customer_address = "";
        */

        $user = $this->session->userdata('logged');

        //Delete first the old settings data
        $this->SettingNotification_model->deleteByUserId($user['id']);

        $post = $this->input->post();
        if($post) {

            $data_array = array();
            foreach($post as $post_key => $post_data) {
                $data_array = array(
                    'user_id' => $user['id'],
                    'name' => $post_key,
                    'value' => $post_data,
                    'created_at' => date("Y-m-d H:i:s")
                );

                if($post_key != 'btn-submit') {
                    $this->SettingNotification_model->create($data_array);
                }

            }

            $this->session->set_flashdata('message', 'Your notification setting was updated');
            $this->session->set_flashdata('alert_class', 'alert-success');

        }

        redirect('settings/notifications');

    }

    public function update_online_payment_setting()
    {
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['email'] != $post['email_confirm'] ){
            $this->session->set_flashdata('message', 'Paypal email not same. Please try again');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }else{
            if( $post['active'] == 1 ){
                $is_active = 1;
            }else{
                $is_active = 0;
            }

            $this->load->model('SettingOnlinePayment_model');

            $settingOnlinePayment = $this->SettingOnlinePayment_model->findByUserId($user['id']);
            if( $settingOnlinePayment ){
                $data_setting = [
                    'paypal_email_address' => $post['email'],
                    'paypal_is_active' => $is_active,
                    'updated' => date("Y-m-d H:i:s")
                ];

                $this->SettingOnlinePayment_model->update($settingOnlinePayment->id,$data_setting);
            }else{
                $data_setting = [
                    'user_id' => $user['id'],
                    'paypal_email_address' => $post['email'],
                    'paypal_is_active' => $is_active,
                    'created' => date("Y-m-d H:i:s")
                ];

                $settingOnlinePayment = $this->SettingOnlinePayment_model->create($data_setting);
            }

            $this->session->set_flashdata('message', 'Your online payment setting was updated');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }

        redirect('settings/online_payments');

    }

    public function create_google_account()
    {
        include APPPATH . 'libraries/google-calendar-api.php';

        $this->load->model('GoogleAccounts_model');
        $this->load->model('Business_model');
        $this->load->model('GoogleCalendar_model');

        $company_id = logged('company_id');
        $google_credentials = google_credentials();
        $profile = google_get_oauth2_token($_POST['token'], $google_credentials['client_id'], $google_credentials['client_secret']);

        $user = $this->session->userdata('logged');
        $data = [
            'company_id' => $company_id,
            'google_email' => $profile['user']->email,
            'google_access_token' => $profile['access_token'],
            'google_refresh_token' => $profile['refreshToken'],
            'date_created' => date("Y-m-d H:i:s")
        ];

        $googleAccount = $this->GoogleAccounts_model->create($data);
        if( $googleAccount ){
            $company = $this->Business_model->getByCompanyId($company_id);
            if( $company ){
                $calendar_appointment_name = $company->business_name . ' - APPOINTMENTS';
                $calendar_events_name = $company->business_name . ' - EVENTS';
                $calendar_tc_off_name = $company->business_name . ' - TC OFF';  
                $calendar_job_name = $company->business_name . ' - JOBS';
                $calendar_services_name = $company->business_name . ' - SERVICE TICKET';              

                $capi = new GoogleCalendarApi();
                $token = $capi->getToken($google_credentials['client_id'], $google_credentials['redirect_url'], $google_credentials['client_secret'], $profile['refreshToken']);
                if( isset($token['access_token']) && $token['access_token'] != '' ){
                    //Appointment
                    $calendarAppointment = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_appointment_name);
                    if( isset($calendarAppointment['id']) ){
                        $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarAppointmentColorID(), $google_credentials['api_key'], $token['access_token'], $calendarAppointment['id']);
                        //Create calendar
                        $calendar_data = [
                            'company_id' => $company_id,
                            'calendar_id' => $calendarAppointment['id'],
                            'calendar_name' => $calendar_appointment_name,
                            'calendar_type' => $this->GoogleCalendar_model->calendarTypeAppointment(),
                            'created' => date("Y-m-d H:i:s")
                        ];

                        $this->GoogleCalendar_model->create($calendar_data);
                    }

                    //Event
                    $calendarEvent = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_events_name);
                    if( isset($calendarEvent['id']) ){
                        $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarEventColorID(), $google_credentials['api_key'], $token['access_token'], $calendarEvent['id']);
                        //Create calendar
                        $calendar_data = [
                            'company_id' => $company_id,
                            'calendar_id' => $calendarEvent['id'],
                            'calendar_name' => $calendar_events_name,
                            'calendar_type' => $this->GoogleCalendar_model->calendarTypeEvent(),
                            'created' => date("Y-m-d H:i:s")
                        ];

                        $this->GoogleCalendar_model->create($calendar_data);
                    }

                    //TC Off
                    $calendarTCOff = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_tc_off_name);
                    if( isset($calendarTCOff['id']) ){
                        $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarTCOffColorID(), $google_credentials['api_key'], $token['access_token'], $calendarTCOff['id']);
                        //Create calendar
                        $calendar_data = [
                            'company_id' => $company_id,
                            'calendar_id' => $calendarTCOff['id'],
                            'calendar_name' => $calendar_tc_off_name,
                            'calendar_type' => $this->GoogleCalendar_model->calendarTypeTCOff(),
                            'created' => date("Y-m-d H:i:s")
                        ];

                        $this->GoogleCalendar_model->create($calendar_data);
                    }

                    //Jobs
                    $calendarJob = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_job_name);
                    if( isset($calendarJob['id']) ){
                        $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarJobsColorID(), $google_credentials['api_key'], $token['access_token'], $calendarJob['id']);
                        //Create calendar
                        $calendar_data = [
                            'company_id' => $company_id,
                            'calendar_id' => $calendarJob['id'],
                            'calendar_name' => $calendar_job_name,
                            'calendar_type' => $this->GoogleCalendar_model->calendarTypeJob(),
                            'created' => date("Y-m-d H:i:s")
                        ];

                        $this->GoogleCalendar_model->create($calendar_data);
                    }

                    //Service Ticket
                    $calendarServiceTicket = $capi->createCalendar($google_credentials['api_key'], $token['access_token'], $calendar_services_name);
                    if( isset($calendarServiceTicket['id']) ){
                        $updateCalendar = $capi->updateCalendar($this->GoogleCalendar_model->calendarServiceTicketColorID(), $google_credentials['api_key'], $token['access_token'], $calendarServiceTicket['id']);
                        //Create calendar
                        $calendar_data = [
                            'company_id' => $company_id,
                            'calendar_id' => $calendarServiceTicket['id'],
                            'calendar_name' => $calendar_services_name,
                            'calendar_type' => $this->GoogleCalendar_model->calendarTypeServiceTicket(),
                            'created' => date("Y-m-d H:i:s")
                        ];

                        $this->GoogleCalendar_model->create($calendar_data);
                    }
                }

            } 
        }

        $return = ['is_success' => 1];

        echo json_encode($return);
    }

    public function ajax_update_enabled_google_calendar()
    {
        $this->load->model('GoogleAccounts_model');

        $post          = $this->input->post();
        $googleAccount = $this->GoogleAccounts_model->getByAuthUser();

        $calendars = array();
        if( $googleAccount->enabled_calendars ){
            $calendars = unserialize($googleAccount->enabled_calendars);
        }

        if( $post['show_calendar'] == 1 ){
            if( !in_array($post['cid'], $calendars) ){
                $calendars[] = $post['cid'];
            }

            $enabled_calendars = serialize($calendars);
        }else{
            foreach( $calendars as $key => $value ){
                if( $value == $post['cid'] ){
                    unset($calendars[$key]);
                }
            }

            $enabled_calendars = serialize($calendars);
        }

        $this->GoogleAccounts_model->update($googleAccount->id, array(
            'enabled_calendars' => $enabled_calendars
        ));
    }

    public function ajax_update_enabled_google_mini_calendar()
    {
        $this->load->model('GoogleAccounts_model');

        $post          = $this->input->post();
        $googleAccount = $this->GoogleAccounts_model->getByAuthUser();

        $calendars[] = $post['cid'];
        $enabled_calendars = serialize($calendars);

        $this->GoogleAccounts_model->update($googleAccount->id, array(
            'enabled_mini_calendars' => $enabled_calendars
        ));
    }

    public function ajax_get_google_enabled_calendars()
    {
        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $this->load->model('GoogleAccounts_model');

        $post = $this->input->post();

        $googleAccount = $this->GoogleAccounts_model->getByAuthUser();
        $enabled_calendars = unserialize($googleAccount->enabled_mini_calendars);

        $google_user_api = $this->GoogleAccounts_model->getByAuthUser();
        $google_credentials = google_credentials();

        $access_token = "";
        $refresh_token = "";
        $google_client_id = "";
        $google_secrect = "";

        if(isset($google_user_api->google_access_token)) {
            $access_token = $google_user_api->google_access_token;
        }

        if(isset($google_user_api->google_refresh_token)) {
            $refresh_token = $google_user_api->google_refresh_token;
        }

        if(isset($google_credentials['client_id'])) {
            $google_client_id = $google_credentials['client_id'];
        }

        if(isset($google_credentials['client_secret'])) {
            $google_secrect = $google_credentials['client_secret'];
        }

        //Set Client
        $client = new Google_Client();
        $client->setClientId($google_client_id);
        $client->setClientSecret($google_secrect);
        $client->setAccessToken($access_token);
        $client->refreshToken($refresh_token);
        $client->setScopes(array(
            'email',
            'profile',
            'https://www.googleapis.com/auth/calendar',
        ));
        $client->setApprovalPrompt('force');
        $client->setAccessType('offline');

        //Request
        $access_token  = $client->getAccessToken();
        $calendar      = new Google_Service_Calendar($client);
        $calendar_data = array();

        $c_index = 0;
        foreach( $enabled_calendars as $c ){
            $calendarListEntry = $calendar->calendarList->get($c);

            $optParams = array(
              'orderBy' => 'startTime',
              'singleEvents' => TRUE,
              'timeMin' => $post['start'],
              'timeMax' => $post['end'],
            );
            $events = $calendar->events->listEvents($c,$optParams);
            //$colors = $calendar->colors->get();

            foreach( $events->items as $event ){
                $bgcolor = "#38a4f8";
                if( $calendarListEntry->backgroundColor != '' ){
                    $bgcolor = $calendarListEntry->backgroundColor;
                }

                $calendar_data[$c_index]['title'] =  $event->summary;
                $calendar_data[$c_index]['description'] = $event->summary . "<br />" . "<i class='fa fa-calendar'></i> " . $event->start->date;
                $calendar_data[$c_index]['start'] = $event->start->date;
                $calendar_data[$c_index]['end']   = $event->end->date;
                $calendar_data[$c_index]['color'] = $bgcolor;
                $c_index++;
            }
        }

        echo json_encode($calendar_data);
    }

    public function calendar_unbind_account()
    {
        $company_id = logged('company_id');
        $post = $this->input->post();

        if( $post['account_type'] == 'gmail' ){
            $this->load->model('GoogleAccounts_model');
            $this->load->model('GoogleCalendar_model');

            $this->GoogleAccounts_model->deleteByCompanyId($company_id);
            $this->GoogleCalendar_model->deleteByCompanyId($company_id);
        }

        $this->session->set_flashdata('message', 'Calendar settings was successfully updated');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('settings/schedule');
    }

    public function ajax_create_email_template()
    {
        $this->load->model('EmailTemplate_model');

        $is_success = 0;
        $msg = '';

        $post       = $this->input->post();
        $user_id    = logged('id');
        $company_id = logged('company_id');

        $isExists = $this->EmailTemplate_model->getByTitle($post['title']);
        if( $isExists && $isExists->company_id == $company_id ){
            $msg = 'Email template ' . $post['title'] . ' already exists';
        }else{
            $post['details']      = 2; //Custom
            $post['user_id']      = $user_id;
            $post['company_id']   = $company_id;
            $post['date_created'] = date("d-m-Y h:i A");
            $this->general_model->add_($post,"settings_email_template");

            //Activity Logs
            $activity_name = 'Email Templates : Created email template '.$post['title']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data  = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_update_email_template()
    {
        $this->load->model('EmailTemplate_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $isExists = $this->EmailTemplate_model->getByTitleAndCompanyId($post['title'], $company_id);
        if( $isExists && $isExists->id != $post['etemplateid'] ){
            $msg = 'Email template ' . $post['title'] . ' already exists';
        }else{
            $get_template_data = array(
                'where' => array(
                    'id' => $post['etemplateid'],
                )
            );
    
            $emailTemplate = $this->general_model->get_all_with_keys($get_template_data,'settings_email_template',FALSE);
            if( $emailTemplate ){
                $data = [
                    'type_id' => $post['type_id'],
                    'title' => $post['title'],
                    'subject' => $post['subject'],
                    'details' => $post['details'],
                    'email_body' => $post['email_body']
                ];
                
                $this->EmailTemplate_model->update($emailTemplate->id, $data);
    
                //Activity Logs
                $activity_name = 'Email Templates : Updated template ' . $emailTemplate->title; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            }
        }
        
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_email_template()
    {
        $this->load->model('EmailTemplate_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $company_id    =  logged('company_id');
        
        $get_template_data = array(
            'where' => array(
                'id' => $post['tid'],
                'company_id' => $company_id
            )
        );

        $emailTemplate = $this->general_model->get_all_with_keys($get_template_data,'settings_email_template',FALSE);

        if( $emailTemplate ){
            $this->EmailTemplate_model->delete($post['tid']);

            //Activity Logs
            $activity_name = 'Email Templates : Deleted template ' . $emailTemplate->title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }
        
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function delete_email_template()
    {
        $this->load->model('EmailTemplate_model');

        $post = $this->input->post();
        $company_id    =  logged('company_id');
        
        $get_template_data = array(
            'where' => array(
                'id' => $post['tid'],
                'company_id' => $company_id
            )
        );

        $emailTemplate = $this->general_model->get_all_with_keys($get_template_data,'settings_email_template',FALSE);

        if( $emailTemplate ){
            $this->EmailTemplate_model->delete($post['tid']);

            $this->session->set_flashdata('message', 'Email template has been deleted successfully');
            $this->session->set_flashdata('alert_class', 'alert-success');
            $this->activity_model->add("Workstatus #$permission Deleted by User: #".logged('id'));
        }else{
            $this->session->set_flashdata('message', 'Cannot find data.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }
        
        
        redirect('settings/email_templates');
    }

    public function delete_sms_template()
    {
        $this->load->model('SmsTemplate_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $company_id    =  logged('company_id');

        $smsTemplate = $this->SmsTemplate_model->getByIdAndCompanyId($post['smstid'], $company_id);

        if( $smsTemplate ){
            $this->SmsTemplate_model->delete($post['smstid']);
            
            //Activity Logs
            $activity_name = 'SMS Templates : Delete sms template '.$smsTemplate->title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_sms_template()
    {
        $this->load->model('SmsTemplate_model');

        $is_success = 0;

        $post       = $this->input->post();
        $user_id    = logged('id');
        $company_id = logged('company_id');
        $post['user_id']      = $user_id;
        $post['company_id']   = $company_id;
        $post['date_created'] = date("d-m-Y h:i A");
        $this->SmsTemplate_model->create($post);

        $is_success = 1;
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function auto_sms()
    {
        $this->load->model('CompanyAutoSmsSettings_model');

        $cid     =  logged('company_id');
        $autoSms    = $this->CompanyAutoSmsSettings_model->getAllByCompanyId($cid);
        $moduleList = $this->CompanyAutoSmsSettings_model->moduleList();

        $recipients = array();
        if( $autoSms ){
            foreach($autoSms as $asms){
                if( $asms->send_to == 'all' ){
                    $recipients[$asms->id][] = 'All';
                }else{
                    if( $asms->send_to != '' ){
                        $a_send_to  = unserialize($asms->send_to);
                        foreach($a_send_to as $value){
                            $user = getUserName($value);
                            $recipients[$asms->id][] = $user['name'];
                        }
                    }

                    if( $asms->send_to_creator == 1 ){
                        $recipients[$asms->id][] = 'Send to Module Item Creator';
                    }                    

                    if( $asms->send_to_company_admin == 1 ){
                        $recipients[$asms->id][] = 'Send to Company Admin';
                    }

                    if( $asms->send_to_assigned_user == 1 ){
                        $recipients[$asms->id][] = 'Send to Assigned User';
                    }

                    if( $asms->send_to_assigned_agent == 1 ){
                        $recipients[$asms->id][] = 'Send to Assigned Agent';
                    }                   

                    if( $asms->send_to_customer == 1 ){
                        $recipients[$asms->id][] = 'Send to Customer';
                    }                   
                }
            }            
        }

        $this->page_data['page']->title = 'Auto SMS Notification';
        $this->page_data['page']->parent = 'Company';
        $this->page_data['autoSms'] = $autoSms;
        $this->page_data['enable_popper_tooltip'] = true;
        $this->page_data['moduleList'] = $moduleList;
        $this->page_data['recipients'] = $recipients;
        $this->load->view('v2/pages/settings/auto_sms_notification/list', $this->page_data);
    }

    public function ajax_load_auto_sms_notification_module_status()
    {
        $this->load->model('CompanyAutoSmsSettings_model');
        $this->load->model('Taskhub_status_model');

        $moduleStatus = array();
        $post = $this->input->post();
        if( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleEstimate() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->estimateModuleStatusList();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleJob() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->jobModuleStatusList();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleWorkOrder() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->workOrderModuleStatusList();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleEvent() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->eventModuleStatusList();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleCustomer() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->customerModuleStatusList();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleLead() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->leadModuleStatusList();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleTaskHub() ){
            $taskHubStatus = $this->Taskhub_status_model->getAll();
            foreach($taskHubStatus as $status){
                if( $status->status_text != '' ){
                    $moduleStatus[$status->status_text] = $status->status_text;
                }                
            }
        }

        $this->page_data['moduleStatus'] = $moduleStatus;
        $this->load->view('v2/pages/settings/auto_sms_notification/ajax_load_auto_sms_notification_module_status', $this->page_data);
    }

    public function ajax_load_auto_sms_notification_module_smart_tags()
    {
        $this->load->model('CompanyAutoSmsSettings_model');
        $this->load->model('Taskhub_status_model');

        $moduleStatus = array();
        $post = $this->input->post();
        if( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleEstimate() ){
            $smartTags = $this->CompanyAutoSmsSettings_model->estimateTags();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleJob() ){
            $smartTags = $this->CompanyAutoSmsSettings_model->jobSmartTags();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleWorkOrder() ){
            $smartTags = $this->CompanyAutoSmsSettings_model->workOrderTags();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleEvent() ){
            $smartTags = $this->CompanyAutoSmsSettings_model->eventsTags();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleCustomer() ){
            $smartTags = $this->CompanyAutoSmsSettings_model->customerTags();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleLead() ){
            $smartTags = $this->CompanyAutoSmsSettings_model->leadsTags();
        }elseif( $post['module_name'] == $this->CompanyAutoSmsSettings_model->moduleTaskHub() ){
            $smartTags = $this->Taskhub_status_model->taskHubTags();            
        }
            
        $tags = array();
        foreach($smartTags as $key => $value){
            $tags[] = ['key' => $key, 'value' => $value];
        }

        echo json_encode($tags);

        //$this->page_data['smartTags'] = $smartTags;
        //$this->load->view('v2/pages/settings/auto_sms_notification/ajax_load_auto_sms_notification_module_smart_tags', $this->page_data);
    }

    public function ajax_create_sms_auto_notification()
    {
        $this->load->model('CompanyAutoSmsSettings_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $cid  =  logged('company_id');
        $post = $this->input->post();
        if( $post['sms_text'] == '' ){
            $msg = 'Please specify sms message';
        }elseif( $post['module_status'] == '' ){
            $msg = 'Please specify status of the module that will trigger auto sms';
        }elseif( !isset($post['send_to_all']) && empty($post['send_to']) && !isset($post['send_creator']) && !isset($post['send_company_admin']) && !isset($post['send_assigned_user']) && !isset($post['send_assigned_agent']) && !isset($post['send_customer']) ){
            $msg = 'Please specify recipient of the sms notification';
        }else{            
            if( isset($post['send_to_all']) ){
                $send_to = 'all';
            }else{
                if(isset($post['send_to'])){
                    $send_to = array();
                    foreach($post['send_to'] as $value){
                        $send_to[] = $value;
                    }

                    $send_to = serialize($send_to);
                }else{
                    $send_to = '';
                }             
            }

            $send_to_creator = 0;
            if( isset($post['send_creator']) ){
                $send_to_creator = 1;
            }

            $send_to_company_admin = 0;
            if( isset($post['send_company_admin']) ){
                $send_to_company_admin = 1;
            }

            $send_to_assigned_user = 0;
            if( isset($post['send_assigned_user']) && ($post['module_name'] == 'taskhub' || $post['module_name'] == 'lead' || $post['module_name'] == 'job') ){
                $send_to_assigned_user = 1;
            }

            $send_to_assigned_agent = 0;
            if( isset($post['send_assigned_agent']) && ($post['module_name'] == 'lead' || $post['module_name'] == 'workorder') ){
                $send_to_assigned_agent = 1;
            }

            $send_to_customer = 0;
            if( isset($post['send_customer']) && ($post['module_name'] == 'estimate' || $post['module_name'] == 'job' || $post['module_name'] == 'workorder') ){
                $send_to_customer = 1;
            }

            $data = [
                'company_id' => $cid,
                'module_name' => $post['module_name'],
                'sms_text' => $post['sms_text'],
                'send_to' => $send_to,
                'module_status' => $post['module_status'],
                'send_to_creator' => $send_to_creator,
                'send_to_company_admin' => $send_to_company_admin,                
                'send_to_assigned_user' => $send_to_assigned_user,
                'send_to_assigned_agent' => $send_to_assigned_agent,
                'send_to_customer' => $send_to_customer,
                'is_enabled' => $post['is_enabled']
            ];

            $this->CompanyAutoSmsSettings_model->create($data);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);

    }

    public function ajax_delete_auto_sms_notification()
    {
        $this->load->model('CompanyAutoSmsSettings_model');

        $is_success = 0;
        $msg = "Cannot find data";

        $cid     =  logged('company_id');
        $post    = $this->input->post();   
        $autoSms = $this->CompanyAutoSmsSettings_model->getById($post['asmsid']);
        if( $autoSms ){
            if( $autoSms->company_id == $cid ){
                $this->CompanyAutoSmsSettings_model->delete($post['asmsid']);

                $is_success = 1;
                $msg = '';
            }
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_edit_auto_sms_notification()
    {
        $this->load->model('CompanyAutoSmsSettings_model');
        $this->load->model('Taskhub_status_model');

        $post    = $this->input->post();   
        $autoSms = $this->CompanyAutoSmsSettings_model->getById($post['sid']);

        $moduleList   = $this->CompanyAutoSmsSettings_model->moduleList();
        $moduleStatus = array();
        if( $autoSms->module_name == $this->CompanyAutoSmsSettings_model->moduleEstimate() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->estimateModuleStatusList();
            $defaultSmartTags = $this->CompanyAutoSmsSettings_model->estimateTags();
        }elseif( $autoSms->module_name == $this->CompanyAutoSmsSettings_model->moduleJob() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->jobModuleStatusList();
            $defaultSmartTags = $this->CompanyAutoSmsSettings_model->jobSmartTags();
        }elseif( $autoSms->module_name == $this->CompanyAutoSmsSettings_model->moduleWorkOrder() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->workOrderModuleStatusList();
            $defaultSmartTags = $this->CompanyAutoSmsSettings_model->workOrderTags();
        }elseif( $autoSms->module_name == $this->CompanyAutoSmsSettings_model->moduleEvent() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->eventModuleStatusList();
            $defaultSmartTags = $this->CompanyAutoSmsSettings_model->eventsTags();
        }elseif( $autoSms->module_name == $this->CompanyAutoSmsSettings_model->moduleCustomer() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->customerModuleStatusList();
            $defaultSmartTags = $this->CompanyAutoSmsSettings_model->customerTags();
        }elseif( $autoSms->module_name == $this->CompanyAutoSmsSettings_model->moduleLead() ){
            $moduleStatus = $this->CompanyAutoSmsSettings_model->leadModuleStatusList();
            $defaultSmartTags = $this->CompanyAutoSmsSettings_model->leadsTags();
        }elseif( $autoSms->module_name == $this->CompanyAutoSmsSettings_model->moduleTaskHub() ){
            $taskHubStatus = $this->Taskhub_status_model->getAll();
            foreach($taskHubStatus as $status){
                if( $status->status_text != '' ){
                    $moduleStatus[$status->status_text] = $status->status_text;
                }                
            }
            $defaultSmartTags = $this->CompanyAutoSmsSettings_model->taskHubTags();
        }

        $recipients  = array();
        $is_send_all = false; 
        if( $autoSms->send_to == 'all' ){
            $is_send_all = true;
        }else{
            if( $autoSms->send_to != '' ){
                $a_send_to  = unserialize($autoSms->send_to);
                foreach($a_send_to as $value){
                    $userData = getUserName($value);
                    $recipients[$userData['id']] = $userData['name'];
                }
            }            
        }

        $this->page_data['autoSms'] = $autoSms;
        $this->page_data['moduleList'] = $moduleList;
        $this->page_data['moduleStatus'] = $moduleStatus;
        $this->page_data['recipients'] = $recipients;
        $this->page_data['is_send_all'] = $is_send_all;
        $this->page_data['defaultSmartTags'] = $defaultSmartTags;
        $this->load->view('v2/pages/settings/auto_sms_notification/ajax_edit_auto_sms_notification', $this->page_data);
    }

    public function ajax_update_sms_auto_notification()
    {
        $this->load->model('CompanyAutoSmsSettings_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post    = $this->input->post();   
        $autoSms = $this->CompanyAutoSmsSettings_model->getById($post['smsid']);
        if($autoSms){
            if( $post['sms_text'] == '' ){
                $msg = 'Please specify sms message';
            }elseif( $post['module_status'] == '' ){
                $msg = 'Please specify status of the module that will trigger auto sms';
            }elseif( !isset($post['send_to_all']) && empty($post['send_to']) && !isset($post['send_creator']) && !isset($post['send_company_admin']) && !isset($post['send_assigned_user']) && !isset($post['send_assigned_agent']) && !isset($post['send_customer']) ){
                $msg = 'Please specify recipient of the sms notification';
            }else{  
                if( isset($post['send_to_all']) ){
                $send_to = 'all';
                }else{
                    if(isset($post['send_to'])){
                        $send_to = array();
                        foreach($post['send_to'] as $value){
                            $send_to[] = $value;
                        }

                        $send_to = serialize($send_to);
                    }else{
                        $send_to = '';
                    }             
                }  

                $send_to_creator = 0;
                if( isset($post['send_creator']) ){
                    $send_to_creator = 1;
                }

                $send_to_company_admin = 0;
                if( isset($post['send_company_admin']) ){
                    $send_to_company_admin = 1;
                }

                $send_to_assigned_user = 0;
                if( isset($post['send_assigned_user']) && ($post['module_name'] == 'lead' || $post['module_name'] == 'taskhub' || $post['module_name'] == 'job') ){
                    $send_to_assigned_user = 1;
                }

                $send_to_assigned_agent = 0;
                if( isset($post['send_assigned_agent']) && ($post['module_name'] == 'lead' || $post['module_name'] == 'workorder') ){
                    $send_to_assigned_agent = 1;
                }

                $send_to_customer = 0;
                if( isset($post['send_customer']) && ($post['module_name'] == 'estimate' || $post['module_name'] == 'job' || $post['module_name'] == 'workorder') ){
                    $send_to_customer = 1;
                }

                $data = [
                    'module_name' => $post['module_name'],
                    'sms_text' => $post['sms_text'],
                    'send_to' => $send_to,
                    'module_status' => $post['module_status'],
                    'send_to_creator' => $send_to_creator,
                    'send_to_company_admin' => $send_to_company_admin,                
                    'send_to_assigned_user' => $send_to_assigned_user,
                    'send_to_assigned_agent' => $send_to_assigned_agent,
                    'send_to_customer' => $send_to_customer,
                    'is_enabled' => $post['is_enabled']
                ];

                $this->CompanyAutoSmsSettings_model->update($autoSms->id, $data);

                $is_success = 1;
                $msg = '';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_edit_sms_template()
    {
        $this->load->model('SmsTemplate_model');

        $post = $this->input->post();   
        $company_id  = logged('company_id');
        $smsTemplate = $this->SmsTemplate_model->getByIdAndCompanyId($post['smstid'], $company_id);
        $this->page_data['smsTemplate'] = $smsTemplate;
        $this->page_data['option_template_types'] = $this->SmsTemplate_model->optionTemplateTypes();
        $this->page_data['option_details'] = $this->SmsTemplate_model->optionDetails();
        $this->page_data['page']->menu = 'email_templates';
        $this->load->view('v2/pages/settings/ajax_edit_sms_template', $this->page_data);
    }

    public function ajax_add_tax_rate(){
        $this->load->model('TaxRates_model');
        $this->load->model('Users_model');

        $is_success = 1;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        if( $post['tax_name'] == '' ){
            $msg = 'Please enter tax name';
            $is_succss = 0;
        }

        if( $post['tax_rate'] == '' ){
            $msg = 'Please enter tax rate';
            $is_succss = 0;
        }

        if( $is_success == 1 ){

            $is_default = 0;
            if( isset($post['is_default']) ){
                $is_default = 1;
                //Reset all company default. Can only set 1 default
                $this->TaxRates_model->resetDefaultTaxRateByCompanyId($cid);
            }

            $data = [
                'name' => $post['tax_name'],
                'rate' => $post['tax_rate'],
                'is_default' => $is_default,
                'company_id' => $cid
            ];

            $taxRates = $this->TaxRates_model->create($data);
            $msg = '';
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_update_tax_rate(){
        $this->load->model('TaxRates_model');
        $this->load->model('Users_model');

        $is_success = 1;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        if( $post['tax_name'] == '' ){
            $msg = 'Please enter tax name';
            $is_succss = 0;
        }

        if( $post['tax_rate'] == '' ){
            $msg = 'Please enter tax rate';
            $is_succss = 0;
        }

        if( $is_success == 1 ){

            $taxRate = $this->TaxRates_model->getById($post['tid']);
            if( $taxRate ){
                $is_default = 0;
                if( isset($post['is_default']) ){
                    $is_default = 1;
                    //Reset all company default. Can only set 1 default
                    $this->TaxRates_model->resetDefaultTaxRateByCompanyId($cid);
                }

                $data = [
                    'name' => $post['tax_name'],
                    'rate' => $post['tax_rate'],
                    'is_default' => $is_default,
                    'company_id' => $cid
                ];

                $taxRates = $this->TaxRates_model->update($post['tid'],$data);
                $msg = '';
            }else{
                $is_success = 0;
                $msg = 'Cannot find data';
            }            
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_tax_rate(){
        $this->load->model('TaxRates_model');
        $this->load->model('Users_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        $taxRate = $this->TaxRates_model->getById($post['tid']);
        if( $taxRate ){
            $this->TaxRates_model->delete($post['tid']);
            
            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'Cannot find data';
        }    

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_update_calendar_settings()
    {
        $this->load->model('CalendarSettings_model');
        $this->load->model('ColorSettings_model');

        $is_success = 0;
        $msg = 'Cannot find data';
        
        $post = $this->input->post();
        $cid  = logged('company_id');
        $uid  = logged('id');

        $settings = $this->CalendarSettings_model->getByCompanyId($cid);             
        if( $settings ){
            $calendar_settings = [
                'timezone' => $post['calendar_timezone'],
                'time_interval' => $post['calendar_time_interval'],
                'default_view' => $post['calendar_default_view'],
                'week_starts_on' => $post['calendar_week_starts_on'],
                'day_starts_on' => $post['calendar_day_starts_on'],
                'day_ends_on' => $post['calendar_day_ends_on'],
                'display_customer_name' => $post['calendar_display_customer_name'] ? $post['calendar_display_customer_name'] : 0,
                'display_job_details' => $post['calendar_display_job_details'] ? $post['calendar_display_job_details'] : 0,
                'display_price' => $post['calendar_display_price'] ? $post['calendar_display_price'] : 0,
                'display_url_link' => $post['calendar_display_url_link'] ? $post['calendar_display_url_link'] : 0,
                'auto_add_appointment' => $post['calendar_auto_add_appointment'] ? $post['calendar_auto_add_appointment'] : 0,
                'auto_add_job' => $post['calendar_auto_add_job'] ? $post['calendar_auto_add_job'] : 0,
                'auto_add_event' => $post['calendar_auto_add_event'] ? $post['calendar_auto_add_event'] : 0,
                'auto_add_ticket' => $post['calendar_auto_add_ticket'] ?  $post['calendar_auto_add_ticket'] : 0,
                'auto_add_tcoff' => $post['calendar_auto_add_tcoff'] ?  $post['calendar_auto_add_tcoff'] : 0,
                'google_calendar_email_notification' =>  $post['google_calendar_email_notification'],
                'google_calendar_popup_notification' => $post['google_calendar_popup_notification'],
                'calendar_auto_sms_notification' => $post['calendar_auto_sms_notification']                     
            ];

            $this->CalendarSettings_model->update($settings->id, $calendar_settings);
        }else{      
            $calendar_settings = [
                'company_id' => $cid,
                'timezone' => $post['calendar_timezone'],
                'time_interval' => $post['calendar_time_interval'],
                'default_view' => $post['calendar_default_view'],
                'week_starts_on' => $post['calendar_week_starts_on'],
                'day_starts_on' => $post['calendar_day_starts_on'],
                'day_ends_on' => $post['calendar_day_ends_on'],
                'display_customer_name' => $post['calendar_display_customer_name'] ? $post['calendar_display_customer_name'] : 0,
                'display_job_details' => $post['calendar_display_job_details'] ? $post['calendar_display_job_details'] : 0,
                'display_price' => $post['calendar_display_price'] ? $post['calendar_display_price'] : 0,
                'display_url_link' => $post['calendar_display_url_link'] ? $post['calendar_display_url_link'] : 0,
                'auto_add_appointment' => $post['calendar_auto_add_appointment'] ? $post['calendar_auto_add_appointment'] : 0,
                'auto_add_job' => $post['calendar_auto_add_job'] ? $post['calendar_auto_add_job'] : 0,
                'auto_add_event' => $post['calendar_auto_add_event'] ? $post['calendar_auto_add_event'] : 0,
                'auto_add_ticket' => $post['calendar_auto_add_ticket'] ?  $post['calendar_auto_add_ticket'] : 0,
                'google_calendar_email_notification' =>  $post['google_calendar_email_notification'],
                'google_calendar_popup_notification' => $post['google_calendar_popup_notification'],
                'calendar_auto_sms_notification' => $post['calendar_auto_sms_notification']                                       
            ];

            $this->CalendarSettings_model->create($calendar_settings);
        }            

        //Color Settings
        $this->ColorSettings_model->deleteAllByCompanyId($cid);
        foreach($post['color_name'] as $key => $value){
            $data = [
                'company_id' => $cid,
                'user_id' => $uid,
                'color_name' => $value,
                'color_code' => $post['color_code'][$key]
            ];
            $colorSetting = $this->ColorSettings_model->create($data);
        }

        //Activity Logs
        $activity_name = 'Updated Calendar Settings'; 
        createActivityLog($activity_name);

        $is_success = 1;
        $msg = '';

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_update_email_brandingg() 
    {
        $is_success = 0;
        $msg = "Cannot update data.";

        //Update - start
        postAllowed();

        $user       = $this->session->userdata('logged');
        $post       = $this->input->post();
        $company_id = logged('company_id');

        $logo_image = "";
        
        /*
        $config['upload_path'] = 'uploads/email_branding/' . $user['id'];

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['file_name'] = $_FILES['file-logo']['name'];
        $config['allowed_types'] = 'gif|jpeg|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( !$this->upload->do_upload('file-logo')) {
            $logo_image = '';
        } else {
            $data = array('upload_data' => $this->upload->data());
            $logo_image = $data['upload_data']['file_name'];
        }
        */

        if( !empty($post) ){
            $this->load->model('SettingEmailBranding_model');

            $settingEmailBranding = $this->SettingEmailBranding_model->findByCompanyId($company_id);
            if( $settingEmailBranding ){
                $data = array(
                    'email_from_name' => post('email_from_name'),
                    'email_template_footer_text' => post('email_template_footer_text'),
                    'logo' => $logo_image,
                    'updated' => date("Y-m-d H:i:s")
                );

                $this->SettingEmailBranding_model->update($settingEmailBranding->id,$data);

            }else{
                $data = array(
                    'company_id' => $company_id,
                    'user_id' => $user['id'],
                    'email_from_name' => post('email_from_name'),
                    'email_template_footer_text' => post('email_template_footer_text'),
                    'logo' => $logo_image,
                    'created' => date("Y-m-d H:i:s")
                );

                $settingEmailBranding = $this->SettingEmailBranding_model->create($data);
            }

            //Activity Logs
            $activity_name = 'Your email branding setting was updated'; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg        = $activity_name;            

        }
        //Update - end 

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_get_email_template(){
        $this->load->model('EmailTemplate_model');

        $subject = '';
        $content = '';

        $post = $this->input->post();
        $emailTemplate = $this->EmailTemplate_model->getById($post['tid']);
        if( $emailTemplate ){
            $subject = $emailTemplate->subject;
            $content = $emailTemplate->email_body;
        }

        $return = [
            'subject' => $subject,
            'content' => $content
        ];

        echo json_encode($return);
    
    }

    public function ajax_preview_email_template(){
        $this->load->model('EmailTemplate_model');

        $post = $this->input->post();
        $emailTemplate = $this->EmailTemplate_model->getById($post['tid']);

        $this->page_data['emailTemplate'] = $emailTemplate;
        $this->load->view('v2/pages/settings/email_templates/email_template_preview', $this->page_data);
    }
}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */
