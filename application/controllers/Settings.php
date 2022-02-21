<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->checkLogin();
        $this->hasAccessModule(8);

		$this->page_data['page_title'] = 'Settings';
		$this->load->helper(array('form', 'url', 'hashids_helper'));
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

        $this->page_data['google_credentials'] = google_credentials();
        $this->page_data['module'] = 'calendar';
        $post       = $this->input->post();
        $get        = $this->input->get();
        $company_id = logged('company_id');

        $settings = $this->settings_model->getCompanyValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE, $company_id);
        $this->page_data['settings'] = unserialize($settings);
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/frontend/js/settings/main.js',
        ));

        if(isset($get['calendar_update']) && $get['calendar_update'] == 1) {
            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Calendar Gmail/Gsuit Account Updated Successfully');
        }

        if (!empty($post)) {
            $this->load->model('Settings_model', 'setting_model');
            if (!empty($settings)) {
                $settings = $this->settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);

                if (!empty($settings)) {

                    // as where return multiple result as an array
                    // we need only first result
                    $setting = current($settings);

                    $this->setting_model->update($setting->id, [
                        'key' => DB_SETTINGS_TABLE_KEY_SCHEDULE,
                        'value' => serialize($post)
                    ]);
                }

                $this->session->set_flashdata('alert', 'Schedule Settings Updated Successfully');
            } else {                
                $this->setting_model->create([
                    'company_id' => $company_id,
                    'key'   => DB_SETTINGS_TABLE_KEY_SCHEDULE,
                    'value' => serialize($post)
                ]);

                $this->session->set_flashdata('alert', 'Schedule Settings Created Successfully');
            }

            $this->session->set_flashdata('alert-type', 'success');

            redirect('settings/Schedule');
            exit();

        } else {
            $this->load->model('GoogleAccounts_model');
            $googleAccount = $this->GoogleAccounts_model->getByAuthUser();
            $is_glink = false;
            if( $googleAccount ){
                $is_glink = true;
            }
            $this->page_data['is_glink'] = $is_glink;
            $this->page_data['page']->menu = 'settings';
            $this->load->view('settings/schedule', $this->page_data);
        }
    }

    public function email_templates()
    {
        $company_id = logged('company_id');

        $get_invoice_template = array(
            'where' => array(
                'company_id' => $company_id,
            )
        );

        $emailTemplates = $this->general_model->get_all_with_keys($get_invoice_template,'settings_email_template');
        $this->page_data['invoice_templates'] = $emailTemplates;
        $this->page_data['page']->menu = 'email_templates';
        $this->load->view('settings/email_templates', $this->page_data);
    }

    public function email_templates_edit($id=null)
    {
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
        $this->load->view('settings/email_templates_edit', $this->page_data);
    }

    public function email_templates_create()
    {
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
        $this->load->view('settings/email_template_create', $this->page_data);
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

        $this->page_data['data_sms_templates'] = $data_sms_templates;
        $this->page_data['page']->menu = 'sms_templates';
        $this->load->view('settings/sms_templates', $this->page_data);
    }

    public function email_branding()
    {
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
        $this->load->view('settings/email_branding', $this->page_data);
    }

	public function notifications()
	{
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
		$this->load->view('settings/notifications', $this->page_data);
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

        $taxRates = $this->TaxRates_model->getAllByCompanyId($company_id);

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

            $this->session->set_flashdata('message', 'Your email branding setting was updated');
            $this->session->set_flashdata('alert_class', 'alert-success');
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
        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $this->load->model('GoogleAccounts_model');

        $google_credentials = google_credentials();
        $profile = google_get_oauth2_token($_POST['token'], $google_credentials['client_id'], $google_credentials['client_secret']);

        $user = $this->session->userdata('logged');
        $data = [
            'user_id' => $user['id'],
            'google_email' => $profile['user']->email,
            'google_access_token' => $profile['access_token'],
            'google_refresh_token' => $profile['refreshToken'],
            'date_created' => date("Y-m-d H:i:s")
        ];
        $googleAccount = $this->GoogleAccounts_model->create($data);
        if( $googleAccount ){
            $google_user_api    = $this->GoogleAccounts_model->getByAuthUser();
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

            $timezone = 'America/Chicago';
            $calendar_name = $this->GoogleAccounts_model->getDefaultAutoSyncCalendarName();
            $cal = new Google_Service_Calendar($client);

            //Check if default calendar existst
            $calendars = $cal->calendarList->listCalendarList();
            $calendar_name = $this->GoogleAccounts_model->getDefaultAutoSyncCalendarName();
            $is_exists = false;
            $calendar_id = '';

            foreach( $calendars as $c ){
                if( $c->summary == $calendar_name ){
                    $is_exists = true;
                    $calendar_id = $c->id;
                }
            }

            if( !$is_exists ){
                $google_calendar = new Google_Service_Calendar_Calendar($client);
                $google_calendar->setSummary($calendar_name);
                $google_calendar->setTimeZone($timezone);

                $created_calendar = $cal->calendars->insert($google_calendar);

                $calendar_id = $created_calendar->getId();

            }

            $this->GoogleAccounts_model->update($googleAccount,['auto_sync_calendar_id' => $calendar_id]);
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
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['account_type'] == 'gmail' ){
            $this->load->model('GoogleAccounts_model');

            $this->GoogleAccounts_model->deleteByUserId($user['id']);
        }

        $this->session->set_flashdata('message', 'Calendar settings was successfully updated');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('settings/schedule');
    }

    public function ajax_create_email_template()
    {
        $is_success = 0;

        $post       = $this->input->post();
        $user_id    = logged('id');
        $company_id = logged('company_id');
        $post['user_id']      = $user_id;
        $post['company_id']   = $company_id;
        $post['date_created'] = date("d-m-Y h:i A");
        $this->general_model->add_($post,"settings_email_template");

        $is_success = 1;
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function ajax_update_email_template()
    {
        $this->load->model('EmailTemplate_model');

        $is_success = 0;

        $post       = $this->input->post();

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

            $is_success = 1;
        }
        
        $json_data  = ['is_success' => $is_success];

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

        $post = $this->input->post();
        $company_id    =  logged('company_id');

        $smsTemplate = $this->SmsTemplate_model->getByIdAndCompanyId($post['smstid'], $company_id);

        if( $smsTemplate ){
            $this->SmsTemplate_model->delete($post['smstid']);

            $this->session->set_flashdata('message', 'SMS template has been deleted successfully');
            $this->session->set_flashdata('alert_class', 'alert-success');
            $this->activity_model->add("Workstatus #$permission Deleted by User: #".logged('id'));
        }else{
            $this->session->set_flashdata('message', 'Cannot find data.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }
        
        
        redirect('settings/sms_templates');
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
}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */
