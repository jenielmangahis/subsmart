<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LeadContactForm extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->hasAccessModule(8); 
        $this->page_data['page']->title = 'Lead Contact Form';        
        $this->page_data['page']->menu = '';
    }

    public function index()
    {   
        $this->load->model('Inquiry_model');
        $this->load->model('Business_model');

        $company_id = logged('company_id');
        $default_email = logged('email');

        $business = $this->Business_model->getByCompanyId($company_id);
        $iframe_url = base_url("/online-leads/".$business->profile_slug);

        $leadForm = $this->Inquiry_model->getLeadFormByCompanyId($company_id);
        $customizeLeadForms = $this->Inquiry_model->getAllCustomizeLeadFormByCompany($company_id, 'lead_form');
        $customizeLeadFormsDefault = $this->Inquiry_model->getAllCustomizeLeadFormByDefault();
        $optionTextFont = $this->Inquiry_model->optionTextFont();
        
        $this->page_data['leadForm'] = $leadForm;
        $this->page_data['customizeLeadForms'] = $customizeLeadForms;
        $this->page_data['customizeLeadFormsDefault'] = $customizeLeadFormsDefault;
        $this->page_data['optionTextFont'] = $optionTextFont;
        $this->page_data['iframe_url'] = $iframe_url;
        $this->page_data['default_email'] = $default_email;
        $this->page_data['page']->tab   = 'Settings';
        $this->load->view('v2/pages/lead_contact_form/index', $this->page_data);
    }

    public function ajax_update_settings()
    {
        $this->load->model('Inquiry_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id  = logged('company_id');
        $post = $this->input->post();


        $this->Inquiry_model->deleteAllCustomizeLeadFormByCompanyId($company_id, []);
        
        if( $post['customFields'] ){
            foreach($post['customFields'] as $value){
                $data = [
                    'company_id' => $company_id,
                    'field' => $value['name'],
                    'visible' => $value['is_required'] ? 1 : 0,
                    'required' => $value['is_visible'] ? 1 : 0,
                    'type' => 'lead_form'
                ];

                $this->Inquiry_model->createCustomField($data);
            }
        }

        $iframe_code = '';
        $leadForm = $this->Inquiry_model->getLeadFormByCompanyId($company_id);
        if( $leadForm ){
            $data = [
                'iframe_code' => $iframe_code,
                'javascript_code' => '',
                'contact_page_url' => '',
                'text_color' => $post['custom_field_text_color'],
                'text_size' => $post['custom_field_text_size'],
                'text_font' => $post['custom_field_text_font'],
                'button_color' => $post['custom_field_button_color'],
                'button_text_color' => $post['custom_field_button_text_color'],
                'app_notification' => $post['notification_app_notification'] ? 1 : 0,
                'email_notification' => $post['notification_email'] ? 1 : 0,
                'email_notification_recipient' => $post['notification_email_recipient'],
                'google_analytics_tracking_id' => $post['google_analytics_tracking_id'],
                'google_analytics_origin' => '',
                'date_modified' => date("Y-m-d H:i:s"),
            ];

            $this->Inquiry_model->updateLeadForm($leadForm->id, $data);
        }else{
            $data = [
                'company_id' => $company_id,
                'type' => 'lead_form',
                'iframe_code' => $iframe_code,
                'javascript_code' => '',
                'contact_page_url' => '',
                'text_color' => $post['custom_field_text_color'],
                'text_size' => $post['custom_field_text_size'],
                'text_font' => $post['custom_field_text_font'],
                'button_color' => $post['custom_field_button_color'],
                'button_text_color' => $post['custom_field_button_text_color'],
                'app_notification' => $post['notification_app_notification'] ? 1 : 0,
                'email_notification' => $post['notification_email'] ? 1 : 0,
                'google_analytics_tracking_id' => $post['google_analytics_tracking_id'],
                'google_analytics_origin' => '',
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
            ];

            $this->Inquiry_model->createLeadForm($data);
        }
        
        $is_success = 1;
        $msg = '';

        //Activity Logs
        $activity_name = 'Lead Contact Form : Updated settings'; 
        createActivityLog($activity_name);

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_form_preview()
    {
        $this->load->model('Inquiry_model');

        $company_id = logged('company_id');
        $customizeLeadForms = $this->Inquiry_model->getAllCustomizeLeadFormByCompany($company_id, 'lead_form');
        $customizeLeadFormsDefault = $this->Inquiry_model->getAllCustomizeLeadFormByDefault();
        $leadForm = $this->Inquiry_model->getLeadFormByCompanyId($company_id);

        $this->page_data['leadForm'] = $leadForm;
        $this->page_data['customizeLeadForms'] = $customizeLeadForms;
        $this->page_data['customizeLeadFormsDefault'] = $customizeLeadFormsDefault;
        $this->load->view('v2/pages/lead_contact_form/ajax_form_preview', $this->page_data);
    }

    public function inquiries()
    {   
        $this->load->model('Inquiry_model');

        $company_id = logged('company_id');

        $inquiries = $this->Inquiry_model->getAllInquiriesByCompanyId($company_id);

        $this->page_data['inquiries'] = $inquiries;
        $this->page_data['page']->tab   = 'Inquiries';
        $this->load->view('v2/pages/lead_contact_form/inquiries', $this->page_data);
    }

    public function ajax_convert_to_lead()
    {
        $this->load->model('Inquiry_model');
        $this->load->model('Lead_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $user_id    = logged('id');
        $post = $this->input->post();


        $inquiry = $this->Inquiry_model->getInquiry($post['inquiry_id']);
        if( $inquiry ){
            $data = [
                'fk_sa_id' => 0,
                'fk_lead_type_id' => 0,
                'fk_sr_id' => $user_id,
                'prof_id' => 0,
                'company_id' => $company_id,
                'firstname' => $inquiry->first_name,
                'middlename' => '',
                'lastname' => $inquiry->last_name,
                'suffix' => '',
                'address' => '',
                'city' => '',
                'state' => '',
                'zip' => '',
                'county' => '',
                'country' => '',
                'phone_cell' => $inquiry->phone,
                'email_add' => $inquiry->email,
                'status' => 'Converted',
                'is_archive' => 'No',
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
                
            ];

            $lead_id = $this->Lead_model->createLead($data);

            if( $lead_id > 0 ){
                $data = ['lead_id' => $lead_id];
                $this->Inquiry_model->updateInquiry($inquiry->id, $data);

                $is_success = 1;
                $msg = '';

                //Activity Logs
                $name = $inquiry->first_name . ' ' . $inquiry->last_name;
                $activity_name = 'Lead Contact Inquiry : Converted inqury from ' . $name . ' to leads'; 
                createActivityLog($activity_name);
            }            
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_inquiry()
    {
        $this->load->model('Inquiry_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $inquiry = $this->Inquiry_model->getInquiry($post['inquiry_id']);
        if( $inquiry ){
            
            $this->Inquiry_model->deleteInquiry($post['inquiry_id'], []);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $name = $inquiry->first_name . ' ' . $inquiry->last_name;
            $activity_name = 'Lead Contact Inquiry : Deleted inqury from ' . $name; 
            createActivityLog($activity_name);          
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_with_selected_convert_to_lead()
    {
        $this->load->model('Inquiry_model');
        $this->load->model('Lead_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $user_id    = logged('id');
        $post = $this->input->post();

        $total_converted = 0;
        if( $post['inquiries'] ){
            foreach($post['inquiries'] as $value){
                $inquiry = $this->Inquiry_model->getInquiry($value);
                if( $inquiry && $inquiry->lead_id == 0 ){
                    $data = [
                        'fk_sa_id' => 0,
                        'fk_lead_type_id' => 0,
                        'fk_sr_id' => $user_id,
                        'prof_id' => 0,
                        'company_id' => $company_id,
                        'firstname' => $inquiry->first_name,
                        'middlename' => '',
                        'lastname' => $inquiry->last_name,
                        'suffix' => '',
                        'address' => '',
                        'city' => '',
                        'state' => '',
                        'zip' => '',
                        'county' => '',
                        'country' => '',
                        'phone_cell' => $inquiry->phone,
                        'email_add' => $inquiry->email,
                        'status' => 'Converted',
                        'is_archive' => 'No',
                        'date_created' => date("Y-m-d H:i:s"),
                        'date_updated' => date("Y-m-d H:i:s")
                        
                    ];

                    $lead_id = $this->Lead_model->createLead($data);
                    if( $lead_id > 0 ){
                        $data = ['lead_id' => $lead_id];
                        $this->Inquiry_model->updateInquiry($inquiry->id, $data);

                        //Activity Logs
                        $name = $inquiry->first_name . ' ' . $inquiry->last_name;
                        $activity_name = 'Lead Contact Inquiry : Converted inqury from ' . $name . ' to leads'; 
                        createActivityLog($activity_name);

                        $total_converted++;
                    }            
                }
            }
        }
        
        if( $total_converted > 0 ){
            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'No data has been converted to leads';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_with_selected_delete()
    {
        $this->load->model('Inquiry_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        if( $post['inquiries'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $this->Inquiry_model->bulkDeleteInquiries($post['inquiries'], $filter);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $total_deleted = count($post['inquiries']);
            if( $total_deleted > 1 ){
                $activity_name = 'Lead Contact Inquiry : Deleted ' . $total_deleted . ' inquiries'; 
            }else{
                $activity_name = 'Lead Contact Inquiry : Deleted ' . $total_deleted . ' inquiry'; 
            }
            
            createActivityLog($activity_name);          
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_view_inquiry()
    {
        $this->load->model('Inquiry_model');

        $company_id = logged('company_id');
        $post = $this->input->post();

        $inquiry = $this->Inquiry_model->getInquiry($post['inquiry_id']);
        if( $inquiry && $inquiry->company_id == $company_id ){
            $this->page_data['inquiry'] = $inquiry;
            $this->load->view('v2/pages/lead_contact_form/ajax_view_inquiry', $this->page_data);
        }
    }
}
