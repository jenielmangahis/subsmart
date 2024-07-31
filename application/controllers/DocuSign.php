<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DocuSign extends MYF_Controller
{
    const ONE_MB = 1048576;
    private $password = 'Riwb5moQi%S@$c8ZM3dq';

    public function __construct()
    {
        parent::__construct();
    }

    public function signing()
    {
        $load_mobile_signing_js = 0;
        if( $this->input->get('is_mobile') ){
            $load_mobile_signing_js = 1;
        }

        $this->page_data['load_mobile_signing_js'] = $load_mobile_signing_js;

        $genPDF = $this->input->get('file');
        if($genPDF == "geratedpdf") {
            $this->load->view('esign/docusign/geratedpdf', $this->page_data);
        } else {
            $this->load->view('esign/docusign/signing', $this->page_data);
        }
    }
    

    public function apiSigning()
    {
        error_reporting(E_ERROR | E_PARSE);

        $decrypted = decrypt($this->input->get('hash', true), $this->password);
        $decrypted = json_decode($decrypted, true);
        
        ['recipient_id' => $recipientId, 'document_id' => $documentId, 'customer_id' => $customer_id] = $decrypted;
        $isSelfSigned = $decrypted['is_self_signed'] ?? false;
        
        $this->db->where('id', $recipientId);
        $this->db->where('docfile_id', $documentId);
        $recipient = $this->db->get('user_docfile_recipients')->row();

        $this->db->where('docfile_id', $documentId);
        $this->db->order_by('id', 'ASC');
        $firstRecipient = $this->db->get('user_docfile_recipients')->row();

        $secondRecipient = [];
        if( $firstRecipient ){
            $this->db->where('id !=', $firstRecipient->id);
            $this->db->where('docfile_id', $documentId);
            $this->db->order_by('id', 'ASC');
            $secondRecipient = $this->db->get('user_docfile_recipients')->row();
        }

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        if( $customer_id == 0 ){
            $customer_id = $document->customer_id;
        }

        $this->db->where('docfile_id', $documentId);
        if (!$isSelfSigned) {
            $this->db->where('user_docfile_recipients_id', $recipientId);
        }
        $fields = $this->db->get('user_docfile_fields')->result();
        foreach( $fields as $f ){
            if( $f->field_name == 'Subscriber Name' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"","placeholder":"Subscriber Name","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Name' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"","placeholder":"Subscriber Name","auto_populate_with":""}';
            }

            if( $f->field_name == 'Company' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"","placeholder":"Dealer Name","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Primary Contact' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Primary Contact","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Secondary Contact' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Secondary Contact","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'City' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"","placeholder":"City","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'State' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"","placeholder":"State","auto_populate_with":"","width":100}';
            }

            if( $f->field_name == 'ZIP' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"","placeholder":"ZIP","auto_populate_with":"","width":80}';
            }

            if( $f->field_name == 'CS Account Number' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"CS Account Number","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'County' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"County","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'date_not_later_a' ){
                $default_date = date('m/d/Y',strtotime('+3 days'));
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"'.$default_date.'","placeholder":"Date","auto_populate_with":""}';
            }

            if( $f->field_name == 'Date of Birth' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Date of Birth","auto_populate_with":""}';
            }

            if( $f->field_name == 'Social Security Number' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Social Security #","auto_populate_with":""}';
            }

            if( $f->field_name == 'Abort Code' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Abort Code","auto_populate_with":"","width":191}';
            }

            
            if( $f->field_name == 'date_not_later_b' ){
                $default_date = date('m/d/Y',strtotime('+3 days'));
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"'.$default_date.'","placeholder":"Password","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Address' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"","placeholder":"Address","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Primary Contact Last Name' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Primary Contact Last Name","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Primary Contact First Name' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Primary Contact First Name","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Primary Contact Number' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Primary Contact Number","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Secondary Contact Last Name' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Secondary Contact Last Name","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Secondary Contact First Name' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Secondary Contact First Name","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'Secondary Contact Number' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Secondary Contact Number","auto_populate_with":"","width":191}';
            }

            if( $f->field_name == 'ABA' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"ABA","auto_populate_with":""}';
            }

            if( $f->field_name == 'Checking Account Number' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Checking Account Number","auto_populate_with":""}';
            }

            if( $f->field_name == 'Account Number' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Account Number","auto_populate_with":""}';
            }

            if( $f->field_name == 'Panel Type' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Panel Type","auto_populate_with":""}';
            }

            if( $f->field_name == 'sales_tax' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"0.00","placeholder":"Sales Tax","auto_populate_with":"","width":100}';
            }

            if( $f->field_name == 'sales_tax' ){
                $f->specs = '{"is_required":true,"is_read_only":false,"value":"0.00","placeholder":"Sales Tax","auto_populate_with":"","width":100}';
            }

            if( $f->field_name == 'Job Account Number' ){
                $f->specs = '{"is_required":false,"is_read_only":false,"value":"","placeholder":"Job Account Number","auto_populate_with":""}';
            }
        }

        foreach ($fields as $field) {
            $this->db->where('recipient_id', $field->user_docfile_recipients_id);
            $this->db->where('field_id', $field->id);
            $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at !=', null);
        $this->db->where('id !=', $recipientId);
        $completedRecipients = $this->db->get('user_docfile_recipients')->result();

        $coRecipientFields = [];
        foreach ($completedRecipients as $_recipient) {
            $this->db->where('docfile_id', $documentId);
            $this->db->where('user_docfile_recipients_id', $_recipient->id);
            $_fields = $this->db->get('user_docfile_fields')->result();

            foreach ($_fields as $field) {
                $this->db->where('recipient_id', $field->user_docfile_recipients_id);
                $this->db->where('field_id', $field->id);
                $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
            }

            $coRecipientFields[] = [
                'recipient' => $_recipient,
                'fields' => $_fields,
            ];
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->order_by('id', 'ASC');
        $files = $this->db->get('user_docfile_documents')->result_array();

        $this->db->where('user_docfile_recipient_id', $recipientId);
        $workorderRecipient = $this->db->get('user_docfile_workorder_recipients')->row();

        if ($workorderRecipient) {
            $workorderRecipient = $this->_getWorkorderCustomer($workorderRecipient->workorder_id);
        }

        $jobRecipient = null;
        $jobRecipientJobId = null;
        if (!$workorderRecipient) {
            $this->db->where('user_docfile_recipient_id', $recipientId);
            $jobRecipient = $this->db->get('user_docfile_job_recipients')->row();

            if ($jobRecipient) {
                $jobRecipientJobId = $jobRecipient->job_id;
                $jobRecipient = $this->_getJobCustomer($jobRecipient->job_id);
            }
        }

        $this->db->select('id');
        $this->db->where('docfile_id', $documentId);
        $recipientIds = $this->db->get('user_docfile_recipients')->result_array();
        $recipientIds = array_map(function ($recipient) {
            return $recipient['id'];
        }, $recipientIds);

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at', null);
        $this->db->where('id !=', $recipientId);
        $nextRecipients = $this->db->get('user_docfile_recipients')->result();

        $is_finished = 1;
        if( count($nextRecipients) > 0 ){
            $is_finished = 0;
        }      

        $this->db->select('job_id');
        $this->db->where_in('user_docfile_recipient_id', $recipientIds);
        $jobId = $this->db->get('user_docfile_job_recipients')->row();
        //$jobId = is_null($jobId) ? null : $jobId->job_id;
        $jobId = $document->job_id;

        $this->db->where('docfile_id', $documentId);
        $generatedPDF = $this->db->get('user_docfile_generated_pdfs')->row();

        $autoPopulateData = [];
        $acscustomer_first_name;
        $acscustomer_last_name;
        $acscustomer_prof_id;
        
        foreach ($fields as $field) {
            if (!$field->specs) {
                continue;
            }

            if( $field->widget_type == 'dynamic-widget' ){
                continue;
            }

            $specs = json_decode($field->specs, true);
            if (!array_key_exists('auto_populate_with', $specs)) {
                continue;
            }

            if (empty($specs['auto_populate_with'])) {
                continue;
            }

            if (array_key_exists($specs['auto_populate_with'], $autoPopulateData)) {
                continue;
            }

            $this->db->where('color', $specs['auto_populate_with']);
            $this->db->where('docfile_id', $documentId);
            $currAutoPopulateData = $this->db->get('user_docfile_recipients')->row();
            
            $this->db->where('user_docfile_recipient_id', $currAutoPopulateData->id);
            $jobRecipient = $this->db->get('user_docfile_job_recipients')->row();

            if ($jobRecipient) {
                $jobRecipientJobId = $jobRecipient->job_id;
                $currAutoPopulateData = $this->_getJobCustomer($jobRecipient->job_id);

                $acscustomer_prof_id = $currAutoPopulateData->prof_id;

                $this->db->select('access_password');
                $this->db->where('fk_prof_id', $currAutoPopulateData->prof_id);
                $accessData = $this->db->get('acs_access')->row();
                $currAutoPopulateData->password = $accessData->access_password;

                $this->db->select('card_fname,card_lname,acct_num,credit_card_num,credit_card_exp_mm_yyyy,credit_card_exp');
                $this->db->where('fk_prof_id', $currAutoPopulateData->prof_id);
                $accessData = $this->db->get('acs_billing')->row();
                $currAutoPopulateData->card_first_name = $accessData->card_fname;
                $currAutoPopulateData->card_last_name = $accessData->card_lname;
                $currAutoPopulateData->card_name = $currAutoPopulateData->card_first_name . ' ' . $currAutoPopulateData->card_last_name;
                $currAutoPopulateData->card_account_number = $accessData->acct_num;
                $currAutoPopulateData->card_expiration = $accessData->credit_card_exp;
                $currAutoPopulateData->card_expiration_mm_yyyy = $accessData->credit_card_exp_mm_yyyy;
            }
            $acscustomer_first_name = $accessData->card_fname;
            $acscustomer_last_name = $currAutoPopulateData;
            $acscustomer_job = $jobRecipient;
            $autoPopulateData[$specs['auto_populate_with']] = $currAutoPopulateData;
        }

        $jobData = null;
        if (is_numeric($jobRecipientJobId)) {
            $this->db->where('id', $jobRecipientJobId);
            $job = $this->db->get('jobs')->row();

            if (!$job->amount) {
                $job->amount = 0;
            }

            // TODO: calculate job amount
            $this->db->select('job_items.job_id,items.id,items.title,items.price,job_items.qty,job_items.tax');
            $this->db->from('job_items');
            $this->db->join('items', 'items.id = job_items.items_id', 'left');
            $this->db->where('job_items.job_id', $job->id);
            $itemsQuery = $this->db->get();
            $items = $itemsQuery->result();

            foreach ($items as $item) {
                $total = (((float) $item->price) * (float) $item->qty); // include tax? (float) $item->tax
                $job->amount = $job->amount + $total;
            }

            // make sure to include tax_rate
            $job->amount = ((float) ($job->tax_rate)) + $job->amount;

            if ($job->work_order_id) {
                $this->db->select('installation_cost,otp_setup,monthly_monitoring');
                $this->db->where('id', $job->work_order_id);
                $workorderQuery = $this->db->get('work_orders');
                $workorder = $workorderQuery->row();

                if ($workorder) {
                    // make sure to include adjustment to total
                    if ($workorder->installation_cost) {
                        $job->amount = (float) $job->amount + (float) $workorder->installation_cost;
                        $job->installation_cost = (float) $workorder->installation_cost;
                    }
                    if ($workorder->otp_setup) {
                        $job->amount = (float) $job->amount + (float) $workorder->otp_setup;
                        $job->otp_setup = (float) $workorder->otp_setup;
                    }
                    if ($workorder->monthly_monitoring) {
                        $job->amount = (float) $job->amount + (float) $workorder->monthly_monitoring;
                        $job->mmr = (float) $workorder->monthly_monitoring;
                        $job->monthly_monitoring = $job->mmr;
                    }
                }
            }

            $jobData = $job;
            $jobData->equipment_cost = $job->amount;
        }
        
        #changes starts here
        #Clients
        $this->db->select('first_name, last_name, mail_add, city, state, zip_code, email, phone_h, phone_m, country, county AS county_name, date_of_birth, ssn');
        $this->db->where('prof_id', $customer_id);
        //$this->db->where('prof_id', 20797);
        $acs_client = $this->db->get('acs_profile')->row();
        if( $acs_client ){
            $acs_clientKeys = [
                'first_name', 'last_name', 'mail_add', 'city', 'state', 'zip_code', 'email', 'phone_h', 'phone_m', 'country', 'county_name', 'date_of_birth', 'ssn'
            ];

            $filteredClient = array_filter( (array)$acs_client , function($v) use ($acs_clientKeys) {
                return in_array($v, $acs_clientKeys);
            }, ARRAY_FILTER_USE_KEY);

        }else{
            $filteredClient = [
                'first_name' => '', 
                'last_name' => '',
                'mail_add' => '', 
                'city' => '',
                'state' => '',
                'zip_code' => '',
                'email' => '',
                'phone_h' => '',
                'phone_m' => '',
                'country' => '', 
                'county_name' => '',
                'date_of_birth' => '',
                'ssn' => ''
            ];
        }

        $autoPopulateData['client'] = $filteredClient;

        #custom service ticket location
        $this->db->where('id', $document->ticket_id);
        $service_ticket = $this->db->get('tickets')->row();
        $tickets_accessKeys = [
            'service_location',
            'acs_city',
            'acs_state',
            'acs_zip'
        ];
        $filteredTickets = array_filter( (array)$service_ticket , function($v) use ($tickets_accessKeys) {
            return in_array($v, $tickets_accessKeys);
        }, ARRAY_FILTER_USE_KEY);
        $autoPopulateData['service_ticket'] = $filteredTickets;

        #jobs data
        $this->db->where('id', $document->job_id);
        $jobs_data = $this->db->get('jobs')->row();
        if( $jobs_data ){
            $jobs_accessKeys = [
                'job_account_number',
                'job_number',
                'job_name',
                'job_type'
            ];
            $filteredJobs = array_filter( (array)$jobs_data , function($v) use ($jobs_accessKeys) {
                return in_array($v, $jobs_accessKeys);
            }, ARRAY_FILTER_USE_KEY);
        }else{
            $filteredJobs = [
                'job_account_number' => '',
                'job_number' => '',
                'job_name' => '',
                'job_type' => ''
            ];
        }
        
        $autoPopulateData['jobs'] = $filteredJobs;


        #acs alarm details
        $this->db->where('fk_prof_id', $customer_id);
        $acs_alarm = $this->db->get('acs_alarm')->row();
        if( $acs_alarm ){
            //$acs_alarm->passcode = '';
            $acs_alarm_accessKeys = [
                'alarm_cs_account',
                'monthly_monitoring',
                'panel_type',
                'otps',
                'passcode'
            ];
            
            $filteredAcs_alarm = array_filter( (array)$acs_alarm , function($v) use ($acs_alarm_accessKeys) {
                return in_array($v, $acs_alarm_accessKeys);
            }, ARRAY_FILTER_USE_KEY);
        }else{
            $filteredAcs_alarm = [
                'alarm_cs_account' => '', 
                'monthly_monitoring' => '0.00',
                'panel_type' => '', 
                'otps' => '0.00',
                'passcode' => ''
            ];
        }
        
        $autoPopulateData['acs_alarm'] = $filteredAcs_alarm;

        //Autopopulate second recipient
        if( $secondRecipient ){
            $second_recipient = [
                'second_recipient_name' => $secondRecipient->name,
                'second_recipient_email'=> $secondRecipient->email
            ];
        }else{
            $second_recipient = [
                'second_recipient_name' => '', 
                'second_recipient_email' => ''
            ];
        }

        $autoPopulateData['second_recipient'] = $second_recipient;

        #acs solar
        $this->db->where('fk_prof_id', $customer_id);
        $acs_info_solar = $this->db->get('acs_info_solar')->row();

        $acs_solar_info_accessKeys = [
            'kw_dc',
            'solar_system_size'
        ];
        
        $filteredAcs_solar = array_filter( (array)$acs_info_solar , function($v) use ($acs_solar_info_accessKeys) {
            return in_array($v, $acs_solar_info_accessKeys);
        }, ARRAY_FILTER_USE_KEY);
        $autoPopulateData['acs_info_solar'] = $filteredAcs_solar;

        #invoice details
        if( $document->job_id > 0 ){
            $this->db->select('monthly_monitoring AS inv_monthly_monitoring, program_setup AS inv_program_setup, installation_cost AS inv_installation_cost, taxes AS inv_taxes, sub_total AS inv_subtotal, (sub_total+taxes) AS inv_equipment_cost, grand_total AS inv_grand_total');
            $this->db->where('job_id', $document->job_id);
            $invoces = $this->db->get('invoices')->row();

            $invoices_accessKeys = [
                'inv_monthly_monitoring',
                'inv_program_setup',
                'inv_installation_cost',
                'inv_subtotal',
                'inv_equipment_cost',
                'inv_taxes',
                'inv_grand_total'
            ];
            
            $filtered_invoice = array_filter( (array)$invoces , function($v) use ($invoices_accessKeys) {
                return in_array($v, $invoices_accessKeys);
            }, ARRAY_FILTER_USE_KEY);
        }elseif( $document->ticket_id > 0 ){
            $this->db->select('monthly_monitoring AS inv_monthly_monitoring, program_setup AS inv_program_setup, installation_cost AS inv_installation_cost, taxes AS inv_taxes, sub_total AS inv_subtotal, (sub_total+taxes) AS inv_equipment_cost, grand_total AS inv_grand_total');
            $this->db->where('ticket_id', $document->ticket_id);
            $invoices = $this->db->get('invoices')->row();
            if( $invoices ){
                $invoices_accessKeys = [
                    'inv_monthly_monitoring',                
                    'inv_program_setup',
                    'inv_installation_cost',
                    'inv_subtotal',
                    'inv_equipment_cost',
                    'inv_taxes',
                    'inv_grand_total'
                ];
                
                $filtered_invoice = array_filter( (array)$invoices , function($v) use ($invoices_accessKeys) {
                    return in_array($v, $invoices_accessKeys);
                }, ARRAY_FILTER_USE_KEY);
            }else{
                //If not invoice data manual fetch total equipment cost from tickets_items
                $this->db->select('total,ticket_id,tax');
                $this->db->from('tickets_items');
                $this->db->where('ticket_id', $document->ticket_id);
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result();

                $total_equipment_cost = 0;
                $total_tax = 0;
                if( $items ){
                    foreach($items as $item){
                        $total_equipment_cost += $item->total;
                        $total_tax += $item->tax;
                    }

                    $grand_total = $total_equipment_cost + $total_tax;

                    $filtered_invoice = [
                        'inv_monthly_monitoring' => 0,
                        'inv_program_setup' => 0,
                        'inv_installation_cost' => 0,
                        'inv_subtotal' => 0,
                        'inv_equipment_cost' => $total_equipment_cost,
                        'inv_taxes' => $total_tax,
                        'inv_grand_total' => $grand_total
                    ];

                }else{
                    $filtered_invoice = [
                        'inv_monthly_monitoring' => 0,
                        'inv_program_setup' => 0,
                        'inv_installation_cost' => 0,
                        'inv_subtotal' => 0,
                        'inv_equipment_cost' => 0,
                        'inv_taxes' => 0,
                        'inv_grand_total' => 0
                    ];
                }
            }
            
        }else{
           $filtered_invoice = [
            'inv_monthly_monitoring' => 0,
            'inv_program_setup' => 0,
            'inv_installation_cost' => 0,
            'inv_subtotal' => 0,
            'inv_equipment_cost' => 0,
            'inv_taxes' => 0
           ];
        }        
        
        $autoPopulateData['invoices'] = $filtered_invoice;

        #emergency primary contact
        $this->db->select('first_name AS emergency_primary_contact_fname, last_name AS emergency_primary_contact_lname, phone AS emergency_primary_contact_phone, relation AS emergency_primary_contact_relation');
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id', 'ASC');
        $emergencyPrimaryContact = $this->db->get('contacts')->row();
        if( $emergencyPrimaryContact ){
            $contacts_accessKeys = [
                'emergency_primary_contact_fname',
                'emergency_primary_contact_lname',
                'emergency_primary_contact_phone',
                'emergency_primary_contact_relation'
            ];

            $filteredContacts = array_filter( (array)$emergencyPrimaryContact , function($v) use ($contacts_accessKeys) {
                return in_array($v, $contacts_accessKeys);
            }, ARRAY_FILTER_USE_KEY);
        }else{
            $filteredContacts = [
                'emergency_primary_contact_fname' => '',
                'emergency_primary_contact_lname' => '',
                'emergency_primary_contact_phone' => '',   
                'emergency_primary_contact_relation' => ''             
            ];
        }
        
        $autoPopulateData['primary_emergency_contacts'] = $filteredContacts;

        #emergency secondary contact
        $this->db->select('first_name AS emergency_secondary_contact_fname, last_name AS emergency_secondary_contact_lname, phone AS emergency_secondary_contact_phone, relation AS emergency_secondary_contact_relation');
        $this->db->where('customer_id', $customer_id);        
        $this->db->order_by('id', 'DESC');
        $emergencySecondaryContact = $this->db->get('contacts')->row();
        
        if( $emergencySecondaryContact ){
            $contacts_accessKeys = [
                'emergency_secondary_contact_fname',
                'emergency_secondary_contact_lname',
                'emergency_secondary_contact_phone',
                'emergency_secondary_contact_relation'
            ];
            
            $filteredContacts = array_filter( (array)$emergencySecondaryContact , function($v) use ($contacts_accessKeys) {
                return in_array($v, $contacts_accessKeys);
            }, ARRAY_FILTER_USE_KEY);
        }else{
            $filteredContacts = [
                'emergency_secondary_contact_fname' => '',
                'emergency_secondary_contact_lname' => '',
                'emergency_secondary_contact_phone' => '',     
                'emergency_secondary_contact_relation' => ''           
            ];
        }
        
        $autoPopulateData['secondary_emergency_contacts'] = $filteredContacts;

        #password
        $this->db->where('fk_prof_id', $customer_id);
        $acs_access = $this->db->get('acs_access')->row();
        if( $acs_access ){
            // $acs_accessKeys = [
            //     'access_password'
            // ];
            
            // $filteredAcs_access = array_filter( (array)$acs_access , function($v) use ($acs_accessKeys) {
            //     return in_array($v, $acs_accessKeys);
            // }, ARRAY_FILTER_USE_KEY);
            $filteredAcs_access = [
                'access_password' => ''
            ];
        }else{
            $filteredAcs_access = [
                'access_password' => ''
            ];
        }
        
        $autoPopulateData['acs_access'] = $filteredAcs_access;

        #company name
        $this->db->where('id', $document->user_id);
        $user = $this->db->get('users')->row();
        if( $user ){
            $this->db->select('business_name, street AS business_address, city AS business_city, state AS business_state, postal_code AS business_potal_code');
            $this->db->where('company_id', $user->company_id);
            $business_profile = $this->db->get('business_profile')->row();
            if( $business_profile ){
                $businessprofile_Keys = [
                    'business_name',
                    'business_address',
                    'business_city',
                    'business_potal_code',
                    'business_state'
                ];
                $filteredCompany = array_filter( (array)$business_profile , function($v) use ($businessprofile_Keys) {
                    return in_array($v, $businessprofile_Keys);
                }, ARRAY_FILTER_USE_KEY);
            }else{
                $filteredCompany = [
                    'business_name' => '',
                    'business_address' => '',
                    'business_city' => '',
                    'business_potal_code' => '',
                    'business_state' => '',
                ];
            }
        }else{
            $filteredCompany = [
                'business_name' => '',
                'business_address' => '',
                'business_city' => '',
                'business_potal_code' => '',
                'business_state' => '',
            ];
        }

        $autoPopulateData['business_profile'] = $filteredCompany;
        
        #billing
        $this->db->where('fk_prof_id', $customer_id);
        $billing = $this->db->get('acs_billing')->row();
        
        /*
        *   Billing Method: bill_method
        *   Checking Account Number: check_num
        *   ABA #: routing_num
        *   Acc #: acct_num
        *   Security Code: ?? credit_card_exp_mm_yyy - correct
        *   Exp. Date: credit_card_exp
        *   Equipment cost: Equiment Cost
        *   One Time Activation: Initial Dep
        *   1st Month Monitoring: Rate Plan
        */    
        
        if( $billing ){
            $billingKeys = [
                'bill_method', 'check_num', 'routing_num', 'card_fname', 'card_lname', 'acct_num', 'credit_card_num', 'equipment', 'credit_card_exp', 'credit_card_exp_mm_yyyy'
            ];
    
            $filteredBilling = array_filter( (array)$billing , function($v) use ($billingKeys) {
                return in_array($v, $billingKeys);
            }, ARRAY_FILTER_USE_KEY);
        }else{
            $filteredBilling = [
                'bill_method' => '', 
                'check_num' => '', 
                'routing_num' => '', 
                'card_fname' => '', 
                'card_lname' => '', 
                'acct_num' => '', 
                'credit_card_num' => '', 
                'equipment' => '', 
                'credit_card_exp' => '', 
                'credit_card_exp_mm_yyyy' => ''
            ];
        }

        $autoPopulateData['billing'] = $filteredBilling;

        #cost due at signing
        $cost_due = $this->db->select('o.equipment_cost, b.initial_dep as one_time_activation, b.mmr as first_month_monitoring')->from('acs_office as o')
                        ->join('acs_billing as b','o.fk_prof_id = b.fk_prof_id')
                        ->where('o.fk_prof_id', $customer_id)
                        ->get()->row();

        $equipment_cost = $cost_due->equipment_cost == '' ? 0 : number_format((float)$cost_due->equipment_cost, 2, '.', '');           
        $first_month_monitoring = $cost_due->first_month_monitoring == '' ? 0 : number_format((float)$cost_due->first_month_monitoring, 2, '.', '');                  
        $equipment_one_time_activationcost = $cost_due->one_time_activation == '' ? 0 :number_format((float)$cost_due->one_time_activation, 2, '.', ''); 
        $total_due = number_format($equipment_cost + $first_month_monitoring + $equipment_one_time_activationcost, 2, '.', ''); 

        $_cost = array(
            "equipment_cost" => $equipment_cost,
            "first_month_monitoring" => $first_month_monitoring,
            "one_time_activation" => $equipment_one_time_activationcost,
            "total_due" => $total_due
        );
        
        $autoPopulateData['cost_due'] = $_cost;

        #job payments
        $job_payments = $this->db->select('amount as jp_amount, program_setup as jp_program_setup, monthly_monitoring as jp_monthly_monitoring, tax as jp_tax, installation_cost as jp_intallation_cost, equipment_cost as jp_equipment_cost, (equipment_cost+tax)as jp_tax_equipment_cost')->from('job_payments')
                        ->where('job_id', $jobId)
                        ->get()->row();

        $jobPaymentsKeys = [
            'jp_amount', 'jp_program_setup', 'jp_monthly_monitoring', 'jp_tax', 'jp_intallation_cost', 'jp_equipment_cost', 'jp_tax_equipment_cost'
        ];

        $filteredJobPayments = array_filter( (array)$job_payments , function($v) use ($jobPaymentsKeys) {
            return in_array($v, $jobPaymentsKeys);
        }, ARRAY_FILTER_USE_KEY);
        
        
        $autoPopulateData['job_payments'] = $filteredJobPayments;

        #docusign envelope id
        $this->db->select('docusign_envelope_id');
        $this->db->where('docfile_id', $documentId);        
        $user_customer_docfile = $this->db->get('user_customer_docfile')->row();

        $userCustomerDocFileKeys = [
            'docusign_envelope_id'
        ];

        $filteredUserCustomerDocFile = array_filter( (array)$user_customer_docfile , function($v) use ($userCustomerDocFileKeys) {
            return in_array($v, $userCustomerDocFileKeys);
        }, ARRAY_FILTER_USE_KEY);
        
        $autoPopulateData['user_customer_docfile'] = $filteredUserCustomerDocFile;

        // $esign = $this->db->get_where('user_docfile_esign', array('hash' => $this->input->get('hash', true)));
        // $inDatabase = $esign->num_rows();

        // if ($inDatabase == 0)
        // {
        //     $this->db->insert('user_docfile_esign', array(
        //         'customerId' => $prof_id,
        //         'hash' => $this->input->get('hash', true),
        //         'jobId' => $jobId,
        //         'name' => $document->name
        //     ));
        // }

        $invoice_id = 0;
        if( $document->job_id > 0 ){
            $this->db->select('*');
            $this->db->where('job_id', $document->job_id);
            $invoice = $this->db->get('invoices')->row();
            if( $invoice ){
                $invoice_id = $invoice->id;
            }
        }elseif( $document->ticket_id > 0 ){
            $this->db->select('*');
            $this->db->where('ticket_id', $document->ticket_id);
            $invoice = $this->db->get('invoices')->row();
            if( $invoice ){
                $invoice_id = $invoice->id;
            }
        }
        

        #end of changes

        header('content-type: application/json');
        echo json_encode([
            'document' => $document,
            'recipient' => $recipient,
            'fields' => $fields,
            'files' => $files,
            'workorder_recipient' => $workorderRecipient,
            'job_recipient' => $jobRecipient,
            'co_recipients' => $coRecipientFields,
            'decrypted' => $decrypted,
            'generated_pdf' => $generatedPDF,
            'auto_populate_data' => $autoPopulateData,
            'recipient_ids' => $recipientIds,
            'is_finished' => $is_finished,
            'job_id' =>  $jobId,
            'inv_id' => $invoice_id,
            'job_data' => $jobData
        ]);
    }

    public function send()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $documentId = $payload['document_id'] ?? null;

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row_array();

        if (!$document) {
            set_status_header(404);
            echo json_encode(['error' => 404]);
            return;
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $recipient = $this->db->get('user_docfile_recipients')->row_array();

        $response = json_encode(['data' => $document]);
        if ($recipient['role'] === 'Needs to Sign') {
            ['error' => $error] = $this->sendEnvelope($document, $recipient);
            $response = json_encode(['success' => is_null($error), 'error' => $error]);
        } else if ($recipient['role'] === 'Signs in Person') {
            $message = json_encode(['recipient_id' => $recipient['id'], 'document_id' => $document['id']]);
            $hash = encrypt($message, $this->password);
            $response = json_encode(['hash' => $hash]);

            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', ['status' => 'Waiting for Others']);
        echo $response;
    }

    public function manage()
    {
        $this->checkLogin();

        add_css([
            'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css',
            'assets/css/esign/docusign/manage/manage.css',
            'assets/css/esign/docusign/template-create/template-create.css',
            'assets/css/esign/esign-builder/esign-builder.css',
            'assets/css/esign/esign.css',
        ]);

        add_footer_js([
            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',

            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js',
            'assets/js/esign/docusign/manage.js',
        ]);

        $this->load->view('esign/docusign/manage', $this->page_data);
    }

    public function apiManage($view)
    {
        ini_set('max_execution_time', '0');

        $view = strtolower($view);
        $documents = $this->getManageData($view);
        $data = [];

        foreach ($documents as $document) {
            if ($view === 'deleted') {
                $trashedAt = strtotime($document->trashed_at);
                $timeDiff = strtotime('now') - $trashedAt;
                $isMoreThan24Hours = $timeDiff > 86400;

                if ($isMoreThan24Hours) {
                    $this->db->where('id', $document->id);
                    $this->db->update('user_docfile', ['status' => 'Deleted']);
                    // continue;
                }
            }

            $this->db->where('docfile_id', $document->id);
            $document->recipients = $this->db->get('user_docfile_recipients')->result();

            if ($document->status === 'Waiting for Others') {
                // makes sure to order recipients.
                $recipientsCopy = array_merge([], $document->recipients);
                usort($recipientsCopy, function ($recipientA, $recipientB) {
                    return (int) $recipientA->id - (int) $recipientB->id;
                });

                $nextSignsInPerson = current(array_filter($recipientsCopy, function ($recipient) {
                    return $recipient->role === 'Signs in Person' && is_null($recipient->completed_at);
                }));

                if ($nextSignsInPerson) {
                    $document->next_recipient = $nextSignsInPerson;

                    $message = json_encode([
                        'recipient_id' => $document->next_recipient->id,
                        'document_id' => $document->id
                    ]);

                    $hash = encrypt($message, $this->password);
                    $document->next_recipient->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;
                }
            }

            array_push($data, $document);
        }

        if ($view === 'action_required') {
            foreach ($data as $document) {
                $recipientId = null;
                foreach ($document->recipients as $recipient) {
                    if ($recipient->email === logged('email')) {
                        $recipientId = $recipient->id;
                        break;
                    }
                }

                $message = json_encode([
                    'recipient_id' => $recipientId,
                    'document_id' => $document->id
                ]);
                $hash = encrypt($message, $this->password);
                $document->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $data, 'view' => $view]);
    }

    public function apiListManage($view)
    {
        $view = strtolower($view);
        $documents = $this->getManageData($view);
        $data = [];

        foreach ($documents as $document) {
            if ($view === 'deleted') {
                $trashedAt = strtotime($document->trashed_at);
                $timeDiff = strtotime('now') - $trashedAt;
                $isMoreThan24Hours = $timeDiff > 86400;

                if ($isMoreThan24Hours) {
                    $this->db->where('id', $document->id);
                    $this->db->update('user_docfile', ['status' => 'Deleted']);
                    // continue;
                }
            }

            $this->db->where('docfile_id', $document->id);
            $document->recipients = $this->db->get('user_docfile_recipients')->result();

            if ($document->status === 'Waiting for Others') {
                // makes sure to order recipients.
                $recipientsCopy = array_merge([], $document->recipients);
                usort($recipientsCopy, function ($recipientA, $recipientB) {
                    return (int) $recipientA->id - (int) $recipientB->id;
                });

                $nextSignsInPerson = current(array_filter($recipientsCopy, function ($recipient) {
                    return $recipient->role === 'Signs in Person' && is_null($recipient->completed_at);
                }));

                if ($nextSignsInPerson) {
                    $document->next_recipient = $nextSignsInPerson;

                    $message = json_encode([
                        'recipient_id' => $document->next_recipient->id,
                        'document_id' => $document->id
                    ]);

                    $hash = encrypt($message, $this->password);
                    $document->next_recipient->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;
                }
            }

            array_push($data, $document);
        }

        if ($view === 'action_required') {
            foreach ($data as $document) {
                $recipientId = null;
                foreach ($document->recipients as $recipient) {
                    if ($recipient->email === logged('email')) {
                        $recipientId = $recipient->id;
                        break;
                    }
                }

                $message = json_encode([
                    'recipient_id' => $recipientId,
                    'document_id' => $document->id
                ]);
                $hash = encrypt($message, $this->password);
                $document->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;
            }
        }
        header('content-type: application/json');
        echo json_encode(['data' => $data, 'view' => $view]);
    }

    private function getManageData($view)
    {
        $companyId = logged('company_id');

        $view = strtolower($view);
       
        if ($view === 'action_required') {
            return $this->getActionRequired();
        }
        $this->db->join('acs_profile', 'user_docfile.customer_id = acs_profile.prof_id', 'left');        
        $this->db->where('user_docfile.unique_key <>', '');
        $this->db->where('user_docfile.company_id >', 0);
        $this->db->where('user_docfile.company_id', $companyId);
        //$this->db->where('user_id', logged('id'));
        switch ($view) {
            case 'sent':
                $this->db->select('docfile_id');
                $this->db->group_by('docfile_id');
                $this->db->where('sent_at is NOT NULL', null, false);
                $docfileIds = $this->db->get('user_docfile_recipients')->result();
                $docfileIds = array_column($docfileIds, 'docfile_id');

                $this->db->where_not_in('user_docfile.status', ['Trashed', 'Deleted']);
                $this->db->where_in('user_docfile.id', empty($docfileIds) ? [-1] : $docfileIds);
                break;

            case 'drafts':
                $this->db->select('user_docfile.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');  
                $this->db->where('user_docfile.status', 'Draft');
                break;

            case 'deleted':
                $this->db->select('user_docfile.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');  
                $this->db->where('user_docfile.status', 'Trashed');
                break;
            
            case 'completed':            
                $this->db->select('user_docfile.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');  
                $this->db->where('user_docfile.status', 'Completed');
                break;

            case 'inbox':
                $this->db->select('user_docfile.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');  
                $this->db->where('user_docfile.status !=', 'Deleted');
                $this->db->where('user_docfile.status !=', 'Trashed');
                break;

            default:
                $this->db->select('user_docfile.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');  
                $this->db->where('user_docfile.status !=', 'Deleted');
                break;
        }

        $this->db->order_by('updated_at', 'DESC');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('user_docfile')->result();
    }

    public function apiTrash($documentId)
    {
        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', ['status' => 'Trashed', 'trashed_at' => date('Y-m-d H:i:s')]);

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $document]);
    }

    public function apiVoid($documentId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $reason = $payload['reason'] ?? null;

        if (!$reason || empty($reason)) {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', [
            'status' => 'Voided',
            'reason' => $reason,
        ]);

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        $this->db->where('id', logged('id'));
        $inviter = $this->db->get('users')->row();
        $inviterName = implode(' ', [$inviter->FName, $inviter->LName]);

        $this->db->where('docfile_id', $documentId);
        $this->db->where('role', 'Needs to Sign');
        $recipients = $this->db->get('user_docfile_recipients')->result();

        $mail = email__getInstance();
        $templatePath = VIEWPATH . 'esign/docusign/email/void.html';
        $template = file_get_contents($templatePath);

        foreach ($recipients as $recipient) {
            if (!is_null($recipient->signed_at)) {
                continue;
            }

            $data = [
                '%inviter%' => $inviterName,
                '%document_name%' => $document->name,
                '%reason%' => $document->reason,
            ];

            $message = strtr($template, $data);

            $mail->MsgHTML($message);
            $mail->addAddress($recipient->email);
            $mail->send();
            $mail->ClearAllRecipients();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $document]);
    }

    public function apiStoreFieldValue()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $isCreated = false;
        $tableName = 'user_docfile_recipient_field_values';

        $this->db->where('recipient_id', $payload['recipient_id']);
        $this->db->where('field_id', $payload['field_id']);
        $record = $this->db->get($tableName)->row();

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert($tableName, $payload);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update($tableName, $payload);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get($tableName)->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record, 'is_created' => $isCreated]);
    }

    public function apiCopy($documentId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $documentId);
        $source = (array) $this->db->get('user_docfile')->row();
        $source['status'] = 'Draft';
        unset($source['id']);
        unset($source['created_at']);
        unset($source['updated_at']);

        // 1. copy document
        $this->db->insert('user_docfile', $source);
        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('user_docfile')->row();

        $this->db->where('docfile_id', $documentId);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        foreach ($recipients as $recipient) {
            $currRecipientId = $recipient['id'];
            $recipient['docfile_id'] = $record->id;

            unset($recipient['id']);
            unset($recipient['sent_at']);
            unset($recipient['signed_at']);

            // 2. copy recipients
            $this->db->insert('user_docfile_recipients', $recipient);
            $recipientId = $this->db->insert_id();

            $this->db->where('docfile_id', $documentId);
            $this->db->where('user_docfile_recipients_id', $currRecipientId);
            $recipientFields = $this->db->get('user_docfile_fields')->result_array();

            if (empty($recipientFields)) {
                continue;
            }

            $fields = array_map(function ($field) use ($record, $recipientId) {
                unset($field['id']);
                unset($field['docfile_id']);
                unset($field['user_docfile_recipients_id']);
                unset($field['unique_key']);

                $field['docfile_id'] = $record->id;
                $field['user_docfile_recipients_id'] = $recipientId;
                $field['unique_key'] = uniqid();
                return $field;
            }, $recipientFields);

            $this->db->insert_batch('user_docfile_fields', $fields);
        }

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiComplete()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $decrypted = decrypt($payload['hash'], $this->password);

        $decrypted = json_decode($decrypted, true);
        ['recipient_id' => $recipientId, 'document_id' => $documentId, 'object_id' => $object_id, 'type' => $type] = $decrypted;

        $this->db->where('id', $recipientId);
        $this->db->update('user_docfile_recipients', ['completed_at' => date('Y-m-d H:i:s')]);

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $totalPending = $this->db->count_all_results('user_docfile_recipients');

        if ($totalPending === 0) {
            $this->db->where('id', $documentId);
            $this->db->update('user_docfile', ['status' => 'Completed']);
        }

        $this->db->where('id', $recipientId);
        $record = $this->db->get('user_docfile_recipients')->row();

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->where('id !=', $recipientId);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        $nextRecipient = null;
        foreach ($recipients as $recipient) {
            if ($recipient['id'] > $recipientId && $recipient['role'] !== 'Receives a copy') {
                $nextRecipient = $recipient;
                break;
            }
        }

        $this->db->where('id', $documentId);
        $envelope = $this->db->get('user_docfile')->row_array();
        $attachToCustomer = null;

        if (!is_null($nextRecipient)) {            
            if ($nextRecipient['role'] === 'Signs in Person') {
                $message = json_encode(['recipient_id' => $nextRecipient['id'], 'document_id' => $envelope['id'], 'object_id' => $object_id, 'type' => $type]);
                $hash = encrypt($message, $this->password);

                $this->db->where('id', $nextRecipient['id']);
                $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);

                if( $type == 'job' && $object_id > 0 ){
                    $this->db->where('id', $object_id);
                    $this->db->update('jobs', ['status' => 'Approved']);

                    //SMS Notification
                    $this->db->where('id', $object_id);
                    $job = $this->db->get('user_docfile_recipients')->row();
                    createCronAutoSmsNotification($job->company_id, $job->id, 'job', 'Approved', $job->employee_id);    

                }

                echo json_encode(['hash' => $hash]);
                return;
            }

            if ($nextRecipient['role'] === 'Needs to Sign') {
                $this->sendEnvelope($envelope, $nextRecipient);
            }
        } else {
            // Document is completed.
            $this->db->where('docfile_id', $documentId);
            $this->db->order_by('id', 'asc');
            $allRecipients = $this->db->get('user_docfile_recipients')->result_array();
            $this->sendCompletedNotice($envelope, $allRecipients);

            $recipientIds = array_map(function ($recipient) {
                return $recipient['id'];
            }, $allRecipients);

            $this->db->select('job_id');
            $this->db->where_in('user_docfile_recipient_id', $recipientIds);
            $jobId = $this->db->get('user_docfile_job_recipients')->row();
            $jobId = is_null($jobId) ? null : $jobId->job_id;

            if ( $envelope['job_id'] > 0 ) {
                $this->db->select('id,employee_id,company_id,customer_id');
                $this->db->where('id', $envelope['job_id']);
                $job = $this->db->get('jobs')->row();

                if ($job) {
                    $attachToCustomer = [
                        'customer_id' => $job->customer_id,
                        'esign_id' => $documentId
                    ];

                    $this->db->where('id', $job->id);
                    $this->db->update('jobs', ['status' => 'Approved']);

                    //SMS Notification
                    createCronAutoSmsNotification($job->company_id, $job->id, 'job', 'Approved', $job->employee_id);    
                }
            }
            
        }
        echo json_encode([
            'data' => $record,
            'next_recipient' => $nextRecipient,
            'has_user' => logged('id') !== false,
            'attach_to_customer' => $attachToCustomer
        ]);
    }

    private function sendCompletedNotice(array $envelope, array $recipients)
    {
        //User Docfile
        $this->db->select('*');
        $this->db->where('id', $envelope['id']);        
        $docFile = $this->db->get('user_docfile')->row();

        //Customer
        $this->db->select('*');
        $this->db->where('prof_id', $docFile->customer_id);        
        $customer = $this->db->get('acs_profile')->row();
        
        //$companyId = logged('company_id');
        $companyId = $docFile->company_id;
        $this->db->where('company_id', $companyId);
        $this->db->select('business_name, address, business_phone, business_email');
        $company = $this->db->get('business_profile')->row();


        $mail = email__getInstance(['subject' => 'Your document has been completed', 'from_name' => $company->business_name]);
        $templatePath = VIEWPATH . 'esign/docusign/email/completed.html';
        $template = file_get_contents($templatePath);

        //Change document status to Complted
        $this->db->where('id', $envelope['id']);
        $this->db->update('user_docfile', ['status' => 'Completed']);

        $attachmentName = preg_replace('/\s+/', '_', $envelope['subject']);
        $attachment = $this->generatePDF($envelope['id']);
        $mail->addStringAttachment($attachment, $attachmentName . '.pdf');

        $companyLogo = $this->getCompanyProfile();        
        $errors = [];
        foreach ($recipients as $recipient) {
            $message = json_encode([
                'recipient_id' => $recipient['id'],
                'document_id' => $envelope['id'],
                'is_self_signed' => false,
            ]);
            $hash = encrypt($message, $this->password);

            if( $customer ){
                $heading = '<h1 style="margin-bottom:0;font-size:3em;">Completed: ' . $envelope['name'] . ' ' . $customer->first_name . ' ' . $customer->last_name .'</h1>';
            }else{
                $heading = '<h1 style="margin-bottom:0;font-size:3em;">Completed: ' . $envelope['name'] . '</h1>';
            }

            $data = [
                '%heading%' => $heading,
                '%business_name%' => $company->business_name,
                '%business_address%' => $company->address,
                '%business_phone%' => formatPhoneNumber($company->business_phone),
                '%business_email%' => $company->business_email,
                '%message%' => nl2br(htmlentities($envelope['completed_message'], ENT_QUOTES, 'UTF-8')),
                '%link%' => $this->getSigningUrl() . '/signing?hash=' . $hash,
                '%company_logo%' => is_null($companyLogo) ? 'https://nsmartrac.com/uploads/users/business_profile/1/logo.jpg?1624851442' : $companyLogo,
            ];

            $message = strtr($template, $data);

            $mail->MsgHTML($message);
            $mail->addAddress($recipient['email']);
            $isSent = $mail->send();
            $mail->ClearAllRecipients();

            if (!$isSent) {
                $errors[$recipient['id']] = $mail->ErrorInfo;
            } else if ($recipient['role'] === 'Receives a copy') {
                $this->db->where('id', $recipient['id']);
                $this->db->update('user_docfile_recipients', ['completed_at' => date('Y-m-d H:i:s')]);
            }
        }

        return ['errors' => $errors];
    }

    public function apiUploadAttachment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $file = $_FILES['attachment'];
        ['field_id' => $fieldId, 'recipient_id' => $recipientId] = $this->input->post();

        if ($file['size'] > self::ONE_MB * 8) {
            echo json_encode([
                'success' => false,
                'reason' => 'Maximum file size is less than 8MB',
            ]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusign/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $tempName = $file['tmp_name'];
        $filename = $file['name'];
        $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);

        $isCreated = false;
        $tableName = 'user_docfile_recipient_field_values';

        $this->db->where('field_id', $fieldId);
        $this->db->where('recipient_id', $recipientId);
        $record = $this->db->get($tableName)->row();

        $data = [
            'value' => $filename,
            'field_id' => $fieldId,
            'recipient_id' => $recipientId,
        ];

        if (!is_null($record) && file_exists($filepath . $record->value)) {
            // unlink($filepath . $record->value);
        }

        move_uploaded_file($tempName, $filepath . $filename);

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert($tableName, $data);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update($tableName, $data);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get($tableName)->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record, 'is_created' => $isCreated]);
    }

    public function templateCreate()
    {
        $this->checkLogin();

        add_css([
            'assets/css/esign/esign-builder/esign-builder.css',
            'assets/css/esign/docusign/template-create/template-create.css',
        ]);

        add_footer_js([
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',

            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            'assets/js/esign/docusign/template-create.js',
        ]);

        $this->load->view('v2/pages/esign/docusign/template-create/index', $this->page_data);
    }

    public function apiStoreTemplate()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $files = $_FILES['files'];
        $count = isset($files['name']) && is_array($files['name']) ? count($files['name']) : 0;

        for ($i = 0; $i < $count; $i++) {
            if ($files['size'][$i] <= self::ONE_MB * 20) {
                continue;
            }

            echo json_encode(['success' => false, 'reason' => 'Maximum file size is less than 8MB']);
            return;
        }

        $filepath = FCPATH . 'uploads/docusigntemplates/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        [
            'name' => $name,
            'description' => $description,
            'subject' => $subject,
            'message' => $message,
            'completed_message' => $completedMessage,
            'recipients' => $recipients,
        ] = $this->input->post();

        $id = (int) $this->input->post('id');
        $recipients = json_decode($recipients, true);

        $payload = [
            'name' => $name,
            'description' => $description,
            'subject' => $subject,
            'message' => $message,
            'completed_message' => $completedMessage,
            'user_id' => logged('id'),
            'company_id' => logged('company_id'),
        ];

        $isCreated = false;
        if (!$id) { // not created yet
            $this->db->insert('user_docfile_templates', $payload);
            $id = $this->db->insert_id();

            $this->db->where('id', $id);
            $record = $this->db->get('user_docfile_templates')->row();
            $isCreated = true;
        } else {
            $this->db->where('id', $id);
            $this->db->update('user_docfile_templates', $payload);
        }

        $this->db->where('template_id', $id);
        $documents = $this->db->get('user_docfile_templates_documents')->result_array();

        foreach ($documents as $document) {
            if (in_array($document['name'], $files['name'])) {
                continue;
            }

            $this->db->where('id', $document['id']);
            $this->db->delete('user_docfile_templates_documents');
            // unlink($filepath . $document['name']);

            $this->db->where('docfile_document_id', $document['id']);
            $this->db->delete('user_docfile_templates_fields');
        }

        for ($i = 0; $i < $count; $i++) {
            $tempName = $files['tmp_name'][$i];
            $filename = $files['name'][$i];

            $this->db->where('name', $filename);
            $document = $this->db->get('user_docfile_templates_documents')->row_array();

            if ($document) {
                continue;
            }

            $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);
            $payload = [
                'name' => $filename,
                'path' => str_replace(FCPATH, '/', $filepath . $filename),
                'template_id' => $id,
            ];

            $this->db->insert('user_docfile_templates_documents', $payload);
            move_uploaded_file($tempName, $filepath . $filename);
        }

        $this->db->where('template_id', $id);
        $currRecipients = $this->db->get('user_docfile_templates_recipients')->result_array();
        $newRecipientIds = array_column($recipients, 'id');

        foreach ($currRecipients as $recipient) {
            if (!in_array($recipient['id'], $newRecipientIds)) {
                $this->db->where('id', $recipient['id']);
                $this->db->delete('user_docfile_templates_recipients');

                $this->db->where('recipients_id', $recipient['id']);
                $this->db->delete('user_docfile_templates_fields');
            }
        }

        if (!empty($recipients)) {
            foreach ($recipients as $recipient) {
                $payload = [
                    'user_id' => logged('id'),
                    'template_id' => $id,
                    'name' => $recipient['name'],
                    'email' => $recipient['email'],
                    'role' => $recipient['role'],
                    'color' => $recipient['color'],
                    'role_name' => $recipient['role_name'],
                ];

                if (strpos($recipient['id'], 'temp') === 0) {
                    $this->db->insert('user_docfile_templates_recipients', $payload);
                } else {
                    $this->db->where('id', $recipient['id']);
                    $this->db->update('user_docfile_templates_recipients', $payload);
                }
            }
        }

        $this->db->where('template_id', $id);
        $record = $this->db->get('user_docfile_templates_document_sequence')->row();

        ['document_sequence' => $sequence] = $this->input->post();
        ['sequence' => $sequence] = json_decode($sequence, true);

        $this->db->where('template_id', $id);
        $documents = $this->db->get('user_docfile_templates_documents')->result_array();

        $sequenceIds = [];
        foreach ($sequence as $documentName) {
            foreach ($documents as $document) {
                if (strpos($document['name'], $documentName) !== false) {
                    $sequenceIds[] = $document['id'];
                    break;
                }
            }
        }

        $payload = ['template_id' => $id, 'sequence' => implode(',', $sequenceIds)];
        if (!$record) {
            $this->db->insert('user_docfile_templates_document_sequence', $payload);
        } else {
            $this->db->where('template_id', $id);
            $this->db->update('user_docfile_templates_document_sequence', $payload);
        }

        $this->db->where('id', $id);
        $record = $this->db->get('user_docfile_templates')->row();
        echo json_encode(['data' => $record, 'is_created' => $isCreated, 's' => $sequenceIds]);
    }

    public function apiTemplates()
    {
        $sharedOnly = filter_var($this->input->get('shared'), FILTER_VALIDATE_BOOLEAN);
        $sharedAndOwned = filter_var($this->input->get('all'), FILTER_VALIDATE_BOOLEAN);

        $getOwned = function () {
            $this->db->where('company_id', logged('company_id'));
            //$this->db->where('user_id', logged('id'));
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get('user_docfile_templates')->result();
        };

        $getShared = function () {
            $this->db->where('user_id', logged('id'));
            $sharedTemplates = $this->db->get('user_docfile_templates_shared')->result_array();

            if (empty($sharedTemplates)) {
                return [];
            }

            $sharedTemplateIds = array_map(function ($template) {
                return $template['template_id'];
            }, $sharedTemplates);

            $this->db->where_in('id', $sharedTemplateIds);
            $this->db->order_by('created_at', 'DESC');
            $results = $this->db->get('user_docfile_templates')->result();

            $usersMap = []; // user_id => user_object
            foreach ($results as $result) {
                if (!array_key_exists($result->user_id, $usersMap)) {
                    $this->db->where('id', $result->user_id);
                    $usersMap[$result->user_id] = $this->db->get('users')->row();
                }

                $result->user = $usersMap[$result->user_id];
                $result->is_shared = true;
            }

            return $results;
        };

        $records = [];
        if ($sharedAndOwned) {
            $records = array_merge($getOwned(), $getShared());
        } else {
            $records = $sharedOnly ? $getShared() : $getOwned();
        }

        foreach ($records as $record) {
            $this->db->where_in('template_id', $record->id);
            $record->thumbnail = $this->db->get('user_docfile_templates_thumbnail')->row();
        }

        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $default = $this->db->get('user_docfile_template_defaults')->row();

        if ($default) {
            foreach ($records as $record) {
                $record->is_default = $default->template_id == $record->id;
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiTemplatesFromParams()
    {
        $sharedOnly = filter_var($this->input->get('shared'), FILTER_VALIDATE_BOOLEAN);
        $sharedAndOwned = filter_var($this->input->get('all'), FILTER_VALIDATE_BOOLEAN);

        $companyId = filter_var($this->input->get('company_id'));
        $userId = filter_var($this->input->get('user_id'));

        $getOwned = function () use ($userId, $companyId) {
            $this->db->where('company_id', $companyId);
            $this->db->where('user_id', $userId);
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get('user_docfile_templates')->result();
        };

        $getShared = function () use ($userId) {
            $this->db->where('user_id', $userId);
            $sharedTemplates = $this->db->get('user_docfile_templates_shared')->result_array();

            if (empty($sharedTemplates)) {
                return [];
            }

            $sharedTemplateIds = array_map(function ($template) {
                return $template['template_id'];
            }, $sharedTemplates);

            $this->db->where_in('id', $sharedTemplateIds);
            $this->db->order_by('created_at', 'DESC');
            $results = $this->db->get('user_docfile_templates')->result();

            $usersMap = []; // user_id => user_object
            foreach ($results as $result) {
                if (!array_key_exists($result->user_id, $usersMap)) {
                    $this->db->where('id', $result->user_id);
                    $usersMap[$result->user_id] = $this->db->get('users')->row();
                }

                $result->user = $usersMap[$result->user_id];
                $result->is_shared = true;
            }

            return $results;
        };

        $records = [];
        if ($sharedAndOwned) {
            $records = array_merge($getOwned(), $getShared());
        } else {
            $records = $sharedOnly ? $getShared() : $getOwned();
        }

        foreach ($records as $record) {
            $this->db->where_in('template_id', $record->id);
            $record->thumbnail = $this->db->get('user_docfile_templates_thumbnail')->row();
        }

        $this->db->where('company_id', $companyId);
        $default = $this->db->get('user_docfile_template_defaults')->row();

        if ($default) {
            foreach ($records as $record) {
                $record->is_default = $default->template_id == $record->id;
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiGetDefaultTemplate()
    {
        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $default = $this->db->get('user_docfile_template_defaults')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $default]);
    }

    public function apiSetDefault()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $userId = logged('id');
        $companyId = logged('company_id');

        $this->db->where('company_id', $companyId);
        $this->db->delete('user_docfile_template_defaults');

        $this->db->insert('user_docfile_template_defaults', [
            'user_id' => $userId,
            'company_id' => $companyId,
            'template_id' => $payload['template_id'],
        ]);

        $this->db->where('company_id', $companyId);
        $row = $this->db->get('user_docfile_template_defaults')->row();
        echo json_encode(['data' => $row]);
    }

    public function apiGetTemplateFields($templateId)
    {
        $query = <<<SQL
        SELECT `user_docfile_templates_fields`.*, `user_docfile_templates_recipients`.`color` FROM `user_docfile_templates_fields`
        LEFT JOIN `user_docfile_templates_recipients` ON `user_docfile_templates_recipients`.`id` = `user_docfile_templates_fields`.`recipients_id`
        WHERE `user_docfile_templates_fields`.`template_id` = ? AND `user_docfile_templates_fields`.`user_id` = ?
SQL;

        $records = $this->db->query($query, [$templateId, logged('id')])->result_array();
        header('content-type: application/json');
        echo json_encode(['fields' => $records]);
    }

    public function apiTemplateFile($templateId)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getSortedDocument($templateId)]);
    }

    private function getSortedDocument($templateId)
    {
        $this->db->where('template_id', $templateId);
        $this->db->order_by('id', 'ASC');
        $records = $this->db->get('user_docfile_templates_documents')->result();

        foreach ($records as $record) {
            $this->db->where('docfile_document_id', $record->id);
            $record->total_fields = $this->db->get('user_docfile_templates_fields')->num_rows();
        }

        $this->db->where('template_id', $templateId);
        $sequence = $this->db->get('user_docfile_templates_document_sequence')->row();
        $sorted = null;

        if ($sequence) {
            $sorted = [];
            $sequence = explode(',', $sequence->sequence);
            foreach ($sequence as $recordId) {
                foreach ($records as $record) {
                    if ($record->id == $recordId) {
                        $sorted[] = $record;
                        break;
                    }
                }
            }
        }

        return is_null($sorted) ? $records : $sorted;
    }

    public function apiTemplate($templateId)
    {
        $this->db->where('id', $templateId);
        $records = $this->db->get('user_docfile_templates')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiTemplateRecipients($templateId)
    {
        $this->db->where('template_id', $templateId);
        $records = $this->db->get('user_docfile_templates_recipients')->result();

        foreach ($records as $record) {
            $this->db->where('recipients_id', $record->id);
            $record->total_fields = $this->db->get('user_docfile_templates_fields')->num_rows();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiCreateTemplateFields()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $coordinates = json_encode($payload['coordinates']);
        $specs = $payload['specs'] ? json_encode($payload['specs']) : null;
        $docPage = $payload['doc_page'];
        if( $payload['specs']['name'] == 'panel_location' ){
          $field = 'panel_location';  
        }else{
            $field = $payload['field'];
        }
        
        $recipientId = $payload['recipient_id'];
        $userId = logged('id');
        $docfileDocumentId = $payload['docfile_document_id'];
        $templateId = $payload['template_id'];
        $uniqueKey = $payload['unique_key'];

        $this->db->where('template_id', $templateId);
        $this->db->where('user_id', $userId);
        $this->db->where('unique_key', $uniqueKey);
        $record = $this->db->get('user_docfile_templates_fields')->row();
        $isCreated = false;

        if( $field == 'Esign Envelope ID' ){
            $specs = '{"is_read_only":true, "placeholder":"Esign Envelope ID"}';
        }/*elseif( $field == 'Subscriber Name' || $field == 'Address' || $field == 'City' || $field == 'State'){
            $name = strtolower($field);
            $name = str_replace(" ", "_", $name);
            $specs = '{"is_required":true, "name":"'.$name.'"}';
        }*/

        // if( $payload['specs']['name'] == 'one_time_activation' ){
        //     $field = 'one_time_activation';
        // }
        
        $widget_type = 'default-widget';
        $widget_autopopulate_field_name = $field;
        if( $payload['widget_type'] == 'dynamic-widget' ){
            $widget_type = 'dynamic-widget';
            $widget_autopopulate_field_name = $payload['widget_field'];
        }

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert('user_docfile_templates_fields', [
                'coordinates' => $coordinates,
                'doc_page' => $docPage,
                'docfile_document_id' => $docfileDocumentId,
                'template_id' => $templateId,
                'field_name' => $field,
                'unique_key' => $uniqueKey,
                'user_id' => $userId,
                'recipients_id' => $recipientId,
                'specs' => $specs,
                'widget_type' => $widget_type,
                'widget_autopopulate_field_name' => $widget_autopopulate_field_name
            ]);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update('user_docfile_templates_fields', [
                'coordinates' => $coordinates,
                'doc_page' => $docPage,
                'docfile_document_id' => $docfileDocumentId,
                'template_id' => $templateId,
                'field_name' => $field,
                'unique_key' => $uniqueKey,
                'user_id' => $userId,
                'specs' => is_null($specs) ? $record->specs : $specs,
                'widget_type' => $widget_type,
                'widget_autopopulate_field_name' => $widget_autopopulate_field_name
            ]);
        }

        $query = <<<SQL
        SELECT `user_docfile_templates_fields`.*, `user_docfile_templates_recipients`.`color` FROM `user_docfile_templates_fields`
        LEFT JOIN `user_docfile_templates_recipients` ON `user_docfile_templates_recipients`.`id` = `user_docfile_templates_fields`.`recipients_id`
        WHERE `user_docfile_templates_fields`.`id` = ?
SQL;

        $recordId = $isCreated ? $this->db->insert_id() : $record->id;
        $record = $this->db->query($query, [$recordId])->row();
        echo json_encode(['record' => $record, 'is_created' => $isCreated]);
    }

    public function apiDeleteTemplateField($uniqueKey)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('user_id', logged('id'));
        $this->db->where('unique_key', $uniqueKey);
        $this->db->delete('user_docfile_templates_fields');

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

    public function templatePrepare()
    {
        return $this->templateCreate();
    }

    public function templateEdit()
    {
        return $this->templateCreate();
    }

    public function sendTemplate($templateId, $userId, $companyId, $jobIdParam = null, $ticketIdParam = null, $customer_id)
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusign/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $message = $payload['message'];
        $completedMessage = $payload['completed_message'];
        $subject = $payload['subject'];
        $recipients = $payload['recipients'];
        $workorderId = $payload['workorder_id'] ?? null;
        $jobId = $payload['job_id'] ?? null;
        $ticketId = $payload['ticket_id'] ?? null;

        $type = '';
        $object_id = 0;

        if( $payload['job_id'] > 0 ){
            $type = 'job';
            $object_id = $payload['job_id']; 
        }else{
            $type = 'job';
            $object_id = $jobIdParam; 
        }

        if( $payload['ticket_id'] > 0 ){
            $type = 'ticket';
            $object_id = $payload['ticket_id']; 
        }else{
            $type = 'ticket';
            $object_id = $ticketIdParam; 
        }

        if( $payload['workorder_id'] > 0 ){
            $type = 'workorder';
            $object_id = $payload['workorder_id'];
        }

        if (is_null($jobId) && is_numeric($jobIdParam)) {
            $jobId = $jobIdParam;
        }

        if (is_null($ticketId) && is_numeric($ticketIdParam)) {
            $ticketId = $ticketIdParam;
        }

        foreach ($recipients as $recipient) {
            if (
                empty(trim($recipient['email']))
                || empty(trim($recipient['name']))
            ) {
                http_response_code(422);
                exit(json_encode(['success' => false, 'message' => "Recipient's name and email are required"]));
            }
        }

        // copy template to user_docfile

        $this->db->select(['id', 'name']);
        $this->db->where('id', $templateId);
        $template = $this->db->get('user_docfile_templates')->row();

        $unique_key = guidv4();

        $this->db->insert('user_docfile', [
            'user_id' => $userId,
            'job_id' => $jobId,
            'ticket_id' => $ticketId,
            'customer_id' => $customer_id,
            'name' => $template->name,
            'type' => count($recipients) > 1 ? 'Multiple' : 'Single',
            'status' => 'Draft',
            'subject' => $subject,
            'message' => $message,
            'completed_message' => $completedMessage,
            'company_id' => $companyId,
            'unique_key' => $unique_key
        ]);
        $docfileId = $this->db->insert_id();

        //Record customer user docfile
        $this->db->insert('user_customer_docfile', [
            'docfile_id' => $docfileId,
            'customer_id' => $customer_id,
            'user_id' => $userId,
            'user_docfile_generated_pdfs_id' => 0,
            'docusign_envelope_id' => $unique_key,
            'date_created' => date("Y-m-d H:i:s")
        ]);

        // copy template document to user_docfile_documents

        $this->db->select(['id', 'name', 'path']);
        $this->db->where('template_id', $template->id);
        $this->db->order_by('id', 'ASC');
        $templateFiles = $this->db->get('user_docfile_templates_documents')->result();

        $docfileDocumentEntries = [];
        foreach ($templateFiles as $file) {
            $documentPath = $filepath . $file->name;
            copy(str_replace('//', '/', FCPATH . $file->path), $documentPath);
            array_push($docfileDocumentEntries, [
                'name' => $file->name,
                'path' => str_replace(FCPATH, '/', $documentPath),
                'docfile_id' => $docfileId,
                'template_id' => $file->id
            ]);
        }

        if (count($docfileDocumentEntries)) {
            $this->db->insert_batch('user_docfile_documents', $docfileDocumentEntries);
        }

        // copy template recipients to user_docfile_recipients and
        // template recipient fields to user_docfile_fields

        $this->db->where('template_id', $template->id);
        $templateRecipients = $this->db->get('user_docfile_templates_recipients')->result_array();

        $this->db->where('template_id', $template->id);
        $docfileFields = $this->db->get('user_docfile_templates_fields')->result_array();

        $this->db->select(['id', 'template_id']);
        $this->db->where('docfile_id', $docfileId);
        $docfileDocuments = $this->db->get('user_docfile_documents')->result_array();

        foreach ($recipients as $recipient) {
            $payload = [
                'user_id' => $userId,
                'docfile_id' => $docfileId,
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'role' => $recipient['role'],
                'color' => $recipient['color'],
            ];

            if (strpos($recipient['id'], 'temp') === 0) {
                $this->db->insert('user_docfile_recipients', $payload);
                continue;
            }

            $matchedRecipient = null;
            foreach ($templateRecipients as $templateRecipient) {
                if ($templateRecipient['id'] == $recipient['id']) {
                    $matchedRecipient = $templateRecipient;
                    break;
                }
            }

            if (is_null($matchedRecipient)) {
                continue;
            }

            $this->db->insert('user_docfile_recipients', $payload);
            $recipientId = $this->db->insert_id();

            $createdRecipientsFields = [];
            foreach ($docfileFields as $field) {

                if ($matchedRecipient['id'] != $field['recipients_id']) continue;
                if ($matchedRecipient['user_id'] != $field['user_id']) continue;
                if ($matchedRecipient['template_id'] != $field['template_id']) continue;

                $matchedDocument = null;
                foreach ($docfileDocuments as $document) {
                    if ($document['template_id'] == $field['docfile_document_id']) {
                        $matchedDocument = $document;
                        break;
                    }
                }

                if (is_null($matchedDocument)) {
                    continue;
                }

                if( $field['widget_type'] == 'dynamic-widget' ){
                    $field_name = 'AutoPopulateText';
                }else{
                    $field_name = $field['field_name'];
                }

                array_push($createdRecipientsFields, [
                    'coordinates' => $field['coordinates'],
                    'docfile_id' => $docfileId,
                    'field_name' => $field_name,
                    'doc_page' => $field['doc_page'],
                    'docfile_document_id' => $matchedDocument['id'],
                    'unique_key ' => uniqid(),
                    'user_id' => $userId,
                    'user_docfile_recipients_id' => $recipientId,
                    'specs' => $field['specs'],
                    'widget_type' => $field['widget_type'],
                    'widget_autopopulate_field_name' => $field['widget_autopopulate_field_name']
                ]);
            }

            $groupedFields = array_chunk($createdRecipientsFields, 50);
            foreach ($groupedFields as $group) {
                $this->db->insert_batch('user_docfile_fields', $group);
            }

            if (!is_null($workorderId)) {
                $this->db->insert('user_docfile_workorder_recipients', [
                    'user_docfile_recipient_id' => $recipientId,
                    'workorder_id' => $workorderId,
                ]);
            }

            if (!is_null($jobId) && in_array(strtoupper($recipient['role_name']), ['CUSTOMER', 'CLIENT'])) {
                $this->db->insert('user_docfile_job_recipients', [
                    'user_docfile_recipient_id' => $recipientId,
                    'job_id' => $jobId,
                ]);
            }
        }

        // copy sequence
        $this->db->select(['sequence']);
        $this->db->where('template_id', $template->id);
        $sequence = $this->db->get('user_docfile_templates_document_sequence')->row();

        if ($sequence) {
            $sequence = explode(',', $sequence->sequence);
            $sequenceIds = [];

            foreach ($sequence as $recordId) {
                foreach ($docfileDocuments as $document) {
                    if ($document['template_id'] == $recordId) {
                        $sequenceIds[] = $document['id'];
                        break;
                    }
                }
            }

            $payload = ['docfile_id' => $docfileId, 'sequence' => implode(',', $sequenceIds)];
            $this->db->insert('user_docfile_document_sequence', $payload);
        }

        $this->db->select(['id', 'subject', 'message', 'name']);
        $this->db->where('id', $docfileId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $this->db->select(['id', 'role', 'email']);
        $this->db->where('docfile_id', $docfileId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $recipient = $this->db->get('user_docfile_recipients')->row_array();

        $response = json_encode(['data' => $envelope]);
        if ($recipient['role'] === 'Needs to Sign') {
            ['error' => $error] = $this->sendEnvelope($envelope, $recipient);
            $response = json_encode(['success' => is_null($error), 'error' => $error]);
        } else if ($recipient['role'] === 'Signs in Person') {
            $message = json_encode(['recipient_id' => $recipient['id'], 'document_id' => $envelope['id'], 'customer_id' => $customer_id, 'object_id' => $object_id, 'type' => $type]); // add customer id here
            $hash = encrypt($message, $this->password);
            $response = json_encode(['hash' => $hash]);

            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        $this->db->where('id', $envelope['id']);
        $this->db->update('user_docfile', ['status' => 'Waiting for Others']);
        echo $response;
    }

    public function viewCompletedEsign($id)
    {
        $this->db->where('id', $id);
        $document = $this->db->get('user_docfile')->row();

        if (!$document || $document->status !== 'Completed') {
            show_404();
            return;
        }

        $this->db->where('docfile_id', $document->id);
        $this->db->order_by('id', 'DESC');
        $lastRecipient = $this->db->get('user_docfile_recipients')->row();

        $message = json_encode([
            'recipient_id' => $lastRecipient->id,
            'document_id' => $document->id
        ]);

        $hash = encrypt($message, $this->password);
        $signingURL = $this->getSigningUrl() . '/signing?hash=' . $hash;
        redirect($signingURL);
    }

    public function apiSendCompleteNotice($documentId)
    {
        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        if (!$document) {
            set_status_header(404);
            exit(json_encode(['error' => 'Document not found']));
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->where('role !=', 'Receives a copy');
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $pendingRecipient = $this->db->get('user_docfile_recipients')->row();

        if ($pendingRecipient) {
            header('content-type: application/json');
            exit(json_encode(['next_recipient' => $pendingRecipient, 'is_sent' => false]));
        }

        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', ['status' => 'Completed']);

        $this->db->where('docfile_id', $documentId);
        $this->db->order_by('id', 'asc');
        $allRecipients = $this->db->get('user_docfile_recipients')->result_array();

        $this->db->where('id', $documentId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $envelope['subject'] = 'Your document has been completed';
        $this->sendCompletedNotice($envelope, $allRecipients);

        header('content-type: application/json');
        exit(json_encode(['next_recipient' => null, 'is_sent' => true]));
    }

    public function apiSendTemplatePublic($templateId)
    {
        $userId = (int) $this->input->get('user_id', true);
        $companyId = (int) $this->input->get('company_id', true);
        $jobId = (int) $this->input->get('job_id', true);
        $ticketId = (int) $this->input->get('ticket_id', true);
        $customer_id = (int) $this->input->get('customer_id', true);
        $this->sendTemplate($templateId, $userId, $companyId, $jobId, $ticketId, $customer_id);
    }
    
    public function apiGetDocumentHash() {
        $recipientId = (int) $this->input->get('recipient_id', true);
        $documentId = (int) $this->input->get('document_id', true);
        $customerId = (int) $this->input->get('customer_id', true);
        $jobId = (int) $this->input->get('job_id', true);
        $ticketId = (int) $this->input->get('ticket_id', true);
        $type = "job";
        $objectId = $jobId;

        // check
        if (is_numeric($ticketId)) {
            $type = "ticket";
            $objectId = $ticketId;
        }


        $message = json_encode(['recipient_id' => $recipientId, 'document_id' => $documentId, 'customer_id' => $customerId, 'object_id' => $objectId, 'type' => $type]);
        $hash = encrypt($message, $this->password);
        $response = json_encode(['hash' => $hash]);

        echo $response;
    }

    public function apiSendTemplate($templateId, $customer_id)
    {
        if( $customer_id === null ){
            $customer_id = 0;
        }

        if( $job_id === null ){
            $job_id = 0;
        }

        $this->sendTemplate($templateId, logged('id'), logged('company_id'), $job_id,0, $customer_id );        
    }

    private function getSigningUrl()
    {
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]";

        if (isLocalhost()) {
            $baseUrl .= '/';
        }

        return rtrim($baseUrl, '/') . '/eSign';
    }

    private function sendEnvelope(array $envelope, array $recipient, bool $isSelfSigned = false)
    {
        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $this->db->select('business_name, address, business_phone, business_email');
        $company = $this->db->get('business_profile')->row();

        /*$this->db->where('id', $companyId);
        $this->db->select('business_name, business_address');
        $company = $this->db->get('clients')->row();*/

        //Customer
        $this->db->select('*');
        $this->db->where('prof_id', $envelope['customer_id']);        
        $customer = $this->db->get('acs_profile')->row();

        $mail = email__getInstance(['subject' => $envelope['subject'], 'from_name' => $company->business_name]);
        $templatePath = VIEWPATH . 'esign/docusign/email/invitation.html';
        $template = file_get_contents($templatePath);

        $this->db->where('id', logged('id'));
        $inviter = $this->db->get('users')->row();
        $inviterName = implode(' ', [$inviter->FName, $inviter->LName]);

        $message = json_encode([
            'recipient_id' => $recipient['id'],
            'document_id' => $envelope['id'],
            'is_self_signed' => $isSelfSigned,
        ]);
        $hash = encrypt($message, $this->password);
        $companyLogo = $this->getCompanyProfile();

        if( $customer ){
            $heading = '<h1 style="margin-bottom:0;font-size:3em;">Review: ' . $envelope['name'] . ' ' . $customer->first_name . ' ' . $customer->last_name . '</h1>';
        }else{
            $heading = '<h1 style="margin-bottom:0;font-size:3em;">Review: ' . $envelope['name'] . '</h1>';
        }

        $data = [
            '%heading%' => $heading,
            '%business_name%' => $company->business_name,
            //'%business_address%' => $company->business_address,            
            '%business_address%' => '',
            '%business_phone%' => formatPhoneNumber($company->business_phone),
            '%business_email%' => $company->business_email,
            '%link%' => $this->getSigningUrl() . '/signing?hash=' . $hash,
            '%inviter%' => $inviterName,
            '%message%' => nl2br(htmlentities($envelope['message'], ENT_QUOTES, 'UTF-8')),
            '%inviter_email%' => $inviter->email,
            '%company_logo%' => is_null($companyLogo) ? 'https://nsmartrac.com/uploads/users/business_profile/1/logo.jpg?1624851442' : $companyLogo,
        ];

        $message = strtr($template, $data);
        
        $mail->MsgHTML($message);
        $mail->addAddress($recipient['email']);
        $isSent = $mail->send();
        $mail->ClearAllRecipients();

        $error = null;
        if (!$isSent) {
            $error = $mail->ErrorInfo;
        } else {
            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        return ['error' => $error];
    }

    public function getCustomer($customerId)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('prof_id', $customerId);
        $row = $this->db->get('acs_profile')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $row]);
    }

    public function getWorkorderCustomer($workorderId)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->_getWorkorderCustomer($workorderId)]);
    }

    private function _getWorkorderCustomer($workorderId)
    {
        $query = <<<SQL
        SELECT * FROM `work_orders`
        LEFT JOIN acs_profile ON work_orders.customer_id = acs_profile.prof_id WHERE work_orders.id = ?
SQL;

        return $this->db->query($query, [$workorderId])->row();
    }

    public function getJobCustomer($jobId)
    {
        $job = $this->_getJobCustomer($jobId);
        $job->id = $jobId;
        $job->employee = $this->getJobEmployee($job);
        $job->admin = $this->getCompanyAdmin();

        header('content-type: application/json');
        echo json_encode(['data' => $job]);
    }

    private function _getJobCustomer($jobId)
    {
        $this->db->where('id', $jobId);
        $this->db->select('customer_id');
        $job = $this->db->get('jobs')->row();

        if (!$job) {
            return null;
        }

        $this->db->where('prof_id', $job->customer_id);
        return $this->db->get('acs_profile')->row();
    }

    public function getTicketCustomer($ticketid)
    {
        $ticket = $this->_getTicketCustomer($ticketid);
        $ticket->id = $ticketid;
        $ticket->employee = $this->getTicketEmployee($ticket);
        $ticket->admin = $this->getCompanyAdmin();

        header('content-type: application/json');
        echo json_encode(['data' => $ticket]);
    }

    private function _getTicketCustomer($ticketid)
    {
        $this->db->where('id', $ticketid);
        $this->db->select('customer_id');
        $ticket = $this->db->get('tickets')->row();

        if (!$ticket) {
            return null;
        }

        $this->db->where('prof_id', $ticket->customer_id);
        return $this->db->get('acs_profile')->row();
    }

    private function getTicketEmployee($ticket)
    {
        $this->db->where('id', $ticket->id);
        $this->db->select('sales_rep');
        $ticket = $this->db->get('tickets')->row();

        if (!$ticket) {
            return null;
        }

        $this->db->where('id', $ticket->sales_rep);
        $employee = $this->db->get('users')->row();

        return $employee;
    }

    private function getJobEmployee($job)
    {
        $employee = null;
        $employeeIdKeys = [
            'employee_id',
            'employee2_id',
            'employee3_id',
            'employee4_id',
        ];

        foreach ($employeeIdKeys as $key) {
            if (!is_null($employee)) {
                break;
            }

            if (is_null($job->$key) || $job->$key === 0) {
                continue;
            }

            $this->db->where('id', $job->$key);
            $employee = $this->db->get('users')->row();
        }

        return $employee;
    }

    private function getCompanyAdmin()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('user_type', 7); // 7 is for admins
        return $this->db->get('users')->row();
    }

    public function apiCopyTemplate($templateId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusigntemplates/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $this->db->where('id', $templateId);
        $baseTemplate = $this->db->get('user_docfile_templates')->row_array();
        unset($baseTemplate['id']);
        unset($baseTemplate['created_at']);
        $baseTemplate['name'] = $baseTemplate['name'] . ' - Copy';

        // copy template
        $this->db->insert('user_docfile_templates', $baseTemplate);

        // get new template
        $this->db->where('id', $this->db->insert_id());
        $newTemplate = $this->db->get('user_docfile_templates')->row();

        // get base template files
        $baseTemplateFiles = $this->getSortedDocument($templateId);
        $sequenceIds = [];
        $storedRecipientIds = [];
        foreach ($baseTemplateFiles as $baseFile) {

            // copy template file
            $documentPath = $filepath . $baseFile->name;
            $this->db->insert('user_docfile_templates_documents', [
                'name' => $baseFile->name,
                'path' => str_replace(FCPATH, '/', $documentPath),
                'template_id' => $newTemplate->id,
            ]);

            $newTemplateDocumentFileId = $this->db->insert_id();
            array_push($sequenceIds, $newTemplateDocumentFileId);

            $this->db->where('template_id', $templateId);
            $this->db->where('docfile_document_id', $baseFile->id);
            $recipientFields = $this->db->get('user_docfile_templates_fields')->result_array();

            // group fields with recipient id as key
            $groupedFields = [];
            foreach ($recipientFields as $field) {
                $groupedFields[$field['recipients_id']][] = $field;
            }

            foreach ($groupedFields as $recipientId => $fields) {
                if (!array_key_exists($recipientId, $storedRecipientIds)) {
                    // copy recipient
                    $this->db->where('id', $recipientId);
                    $baseTemplateRecipient = $this->db->get('user_docfile_templates_recipients')->row_array();
                    unset($baseTemplateRecipient['id']);
                    unset($baseTemplateRecipient['template_id']);

                    $baseTemplateRecipient['template_id'] = $newTemplate->id;
                    $this->db->insert('user_docfile_templates_recipients', $baseTemplateRecipient);
                    $storedRecipientIds[$recipientId] = $this->db->insert_id();
                }

                $newRecipientId = $storedRecipientIds[$recipientId];

                // copy recipient fields
                $newFields = array_map(function ($field) use ($newTemplate, $newRecipientId, $newTemplateDocumentFileId) {
                    unset($field['id']);
                    unset($field['template_id']);
                    unset($field['recipients_id']);
                    unset($field['unique_key']);
                    unset($field['docfile_document_id']);

                    $field['template_id'] = $newTemplate->id;
                    $field['recipients_id'] = $newRecipientId;
                    $field['unique_key'] = uniqid();
                    $field['docfile_document_id'] = $newTemplateDocumentFileId;
                    return $field;
                }, $fields);

                $this->db->insert_batch('user_docfile_templates_fields', $newFields);
            }
        }

        $payload = ['template_id' => $newTemplate->id, 'sequence' => implode(',', $sequenceIds)];
        $this->db->insert('user_docfile_templates_document_sequence', $payload);

        header('content-type: application/json');
        echo json_encode(['data' => $newTemplate]);
    }

    public function apiGetUsers($templateId)
    {
        $query = <<<SQL
        SELECT * FROM `users` WHERE company_id = ? AND id != ?
SQL;

        $users = $this->db->query($query, [logged('company_id'), logged('id')])->result_array();

        $this->db->where('template_id', $templateId);
        $sharedUsers = $this->db->get('user_docfile_templates_shared')->result_array();
        $sharedUserIds = array_column($sharedUsers, 'user_id');

        $users = array_map(function ($user) use ($sharedUserIds) {
            $user['is_selected'] = in_array($user['id'], $sharedUserIds);
            return $user;
        }, $users);

        header('content-type: application/json');
        echo json_encode(['data' => $users]);
    }

    public function apiShareTemplate()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['data' => null]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $userIds = $payload['user_ids'] ?? [];
        $templateId = $payload['template_id'];

        $this->db->where('template_id', $templateId);
        $sharedUsers = $this->db->get('user_docfile_templates_shared')->result_array();

        if (!empty($sharedUsers)) {
            $this->db->where('template_id', $templateId);
            $this->db->delete('user_docfile_templates_shared');
        }

        if (empty($userIds)) {
            echo json_encode(['data' => null]);
            return;
        }

        $fields = array_map(function ($id) use ($templateId) {
            return ['user_id' => $id, 'template_id' => $templateId];
        }, $userIds);

        $this->db->insert_batch('user_docfile_templates_shared', $fields);
        echo json_encode(['data' => $fields]);
    }

    public function apiDeleteTemplate($templateId)
    {
        $this->db->where('id', $templateId);
        $this->db->delete('user_docfile_templates');

        $this->db->where('template_id', $templateId);
        $documents = $this->db->get('user_docfile_templates_documents')->result_array();

        foreach ($documents as $document) {
            $this->db->where('id !=', $document['id']);
            $this->db->where('name', $document['name']);
            $result = $this->db->get('user_docfile_templates_documents')->row();

            if (!$result) { // used on another template
                // TODO: delete if not used.
                // unlink(FCPATH . 'uploads/docusigntemplates/' . $document['name']);
            }
        }

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_documents');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_fields');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_recipients');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_shared');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_document_sequence');

        $this->db->where('template_id', $templateId);
        $thumbnail = $this->db->get('user_docfile_templates_thumbnail')->row_array();

        if ($thumbnail) {
            unlink(FCPATH . 'uploads/docusigntemplatesthumbnail/' . $thumbnail['filename']);
        }

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_thumbnail');

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

    public function apiSaveEnvelopeAsTemplate($envelopeId)
    {

        $filepath = FCPATH . 'uploads/docusigntemplates/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $this->db->where('id', $envelopeId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $this->db->insert('user_docfile_templates', [
            'user_id' => logged('id'),
            'company_id' => logged('company_id'),
            'name' => $envelope['name'],
            'description' => '',
            'subject' => $envelope['subject'],
            'message' => $envelope['message'],
        ]);
        $templateId = $this->db->insert_id();

        $this->db->where('docfile_id', $envelopeId);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        foreach ($recipients as $index => $recipient) {
            $index += 1;
            $this->db->insert('user_docfile_templates_recipients', [
                'user_id' => logged('id'),
                'template_id' => $templateId,
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'role' => $recipient['role'],
                'color' => $recipient['color'],
                'role_name' => 'Recipient ' . $index,
            ]);

            $recipientId = $this->db->insert_id();

            $this->db->where('user_docfile_recipients_id', $recipient['id']);
            $fields = $this->db->get('user_docfile_fields')->result_array();

            $documents = []; // document_id => document
            $templateDocuments = []; // document_name => document_id

            foreach ($fields as $field) {
                if (!array_key_exists($field['docfile_document_id'], $documents)) {
                    $this->db->where('id', $field['docfile_document_id']);
                    $documents[$field['docfile_document_id']] = $this->db->get('user_docfile_documents')->row_array();
                }

                $document = $documents[$field['docfile_document_id']];
                $documentPath = $filepath . $document['name'];

                if (!array_key_exists($document['name'], $templateDocuments)) {
                    copy(FCPATH . $document['path'], $documentPath);
                    $this->db->insert('user_docfile_templates_documents', [
                        'name' => $document['name'],
                        'path' => str_replace(FCPATH, '/', $filepath . $document['name']),
                        'template_id' => $templateId,
                    ]);

                    $templateDocuments[$document['name']] = $this->db->insert_id();
                }

                $docfileDocumentId = $templateDocuments[$document['name']];
                $this->db->insert('user_docfile_templates_fields', [
                    'coordinates' => $field['coordinates'],
                    'doc_page' => $field['doc_page'],
                    'docfile_document_id' => $docfileDocumentId,
                    'template_id' => $templateId,
                    'field_name' => $field['field_name'],
                    'unique_key' => uniqid(),
                    'user_id' => logged('id'),
                    'recipients_id' => $recipientId,
                    'specs' => $field['specs'],
                ]);
            }
        }

        $this->db->where('id', $templateId);
        $template = $this->db->get('user_docfile_templates')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $template]);
    }

    public function getUserdate()
    {
        $this->load->model('CalendarSettings_model');
        $this->load->model('Jobs_model');

        $default_timezone   = 'America/New_York';

        $jid = $this->input->get('jid');
        if( $jid > 0 ){
            $job = $this->Jobs_model->get_specific_job($jid);
            if( $job ){
                $calender_settings  = $this->CalendarSettings_model->getByCompanyId($job->company_id); 
                if( $calender_settings ){
                    $default_timezone = $calender_settings->timezone;
                }
            }
        }

        date_default_timezone_set($default_timezone);
        $current_date_time = date("Y-m-d g:i A");

        header('content-type: application/json');
        echo json_encode(['current_date_time' => $current_date_time]);
    }

    public function apiUploadTemplateThumbnail()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusigntemplatesthumbnail/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $file = $_FILES['thumbnail'];
        ['template_id' => $templateId] = $this->input->post();

        if ($file['size'] > self::ONE_MB * 8) {
            echo json_encode([
                'success' => false,
                'reason' => 'Maximum file size is less than 8MB',
            ]);
            return;
        }

        $tempName = $file['tmp_name'];
        $filename = $file['name'];
        $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);

        $isCreated = false;
        $tableName = 'user_docfile_templates_thumbnail';

        $this->db->where('template_id', $templateId);
        $record = $this->db->get($tableName)->row();

        if (!is_null($record) && file_exists($filepath . $record->filename)) {
            unlink($filepath . $record->filename);
        }

        move_uploaded_file($tempName, $filepath . $filename);

        $data = [
            'template_id' => $templateId,
            'filename' => $filename,
            'filepath' => str_replace(FCPATH, '/', $filepath . $filename),
        ];

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert($tableName, $data);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update($tableName, $data);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get($tableName)->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record, 'is_created' => $isCreated]);
    }

    public function apiUserDetails()
    {
        $userId = logged('id');
        $this->db->where('user_id', $userId);
        $signature = $this->db->get('user_signatures')->row();

        $this->db->where('id', $userId);
        $details = $this->db->get('users')->row();

        $this->db->where('id', $details->company_id);
        $company = $this->db->get('business_profile')->row();

        header('content-type: application/json');
        echo json_encode([
            'data' => [
                'signature' => $signature,
                'details' => $details,
                'company' => $company,
            ],
        ]);
    }

    public function apiSubmitSelfSigned($envelopeId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payloadRecipients = $payload['recipients'] ?? [];
        $subject = $payload['subject'] ?? '';
        $message = $payload['message'] ?? '';

        foreach ($payloadRecipients as $recipient) {
            $this->db->insert('user_docfile_recipients', [
                'user_id' => logged('id'),
                'docfile_id' => $envelopeId,
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'role' => 'Receives a copy',
            ]);
        }

        $this->db->where('id', $envelopeId);
        $this->db->update('user_docfile', [
            'subject' => $subject,
            'message' => $message,
            'status' => 'Completed',
        ]);

        $this->db->where('id', $envelopeId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $this->db->where('docfile_id', $envelopeId);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        foreach ($recipients as $recipient) {
            $this->sendEnvelope($envelope, $recipient, true);
            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['completed_at' => date('Y-m-d H:i:s')]);
        }

        header('content-type: application/json');
        echo json_encode([
            'data' => [
                'status' => '👌',
                'envelope_id' => $envelopeId,
                'recipients' => $recipients,
            ],
        ]);
    }

    private function getCompanyProfile()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('business_image is NOT NULL', null, false);
        $this->db->select('business_image, id');
        $companyProfile = $this->db->get('business_profile')->row();

        if ($companyProfile) {
            return urlUpload('users/business_profile/' . $companyProfile->id . '/' . $companyProfile->business_image . '?' . time());
        }

        return null;
    }

    public function apiGetActionRequired()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getActionRequired()]);
    }

    private function getActionRequired()
    {
        $this->db->where('id', logged('id'));
        $this->db->select(['email']);
        $user = $this->db->get('users')->row();
        $currUserEmail = $user->email;

        $query = <<<SQL
        SELECT `user_docfile_recipients`.`docfile_id` FROM `user_docfile_recipients`
        LEFT JOIN `user_docfile` ON `user_docfile`.`id` = `user_docfile_recipients`.`docfile_id`
        WHERE `user_docfile`.`user_id` = ? AND `user_docfile_recipients`.`email` = ? AND
        `user_docfile_recipients`.`sent_at` IS NOT NULL AND `user_docfile_recipients`.`completed_at` IS NULL
SQL;

        $results = $this->db->query($query, [logged('id'), $currUserEmail])->result();
        $docfileIds = array_map(function ($result) {
            return $result->docfile_id;
        }, $results);

        if (empty($docfileIds)) {
            return [];
        }

        $this->db->select('user_docfile.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');  
        $this->db->join('acs_profile', 'user_docfile.customer_id = acs_profile.prof_id', 'left');       
        $this->db->where('user_docfile.status <>', 'Trashed');
        $this->db->where('user_docfile.status <>', 'Deleted');
        $this->db->where_in('user_docfile.id', $docfileIds);
        $this->db->where('user_docfile.unique_key <>', '');
        $this->db->order_by('user_docfile.id', 'DESC');
        return $this->db->get('user_docfile')->result();
    }

    public function apiGetDocuSignList()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getDocuSignList()]);
    }

    private function getDocuSignList()
    {
        $cid = logged('company_id');

        $query = <<<SQL
        SELECT `user_docfile_recipients`.`docfile_id` FROM `user_docfile_recipients`
        LEFT JOIN `user_docfile` ON `user_docfile`.`id` = `user_docfile_recipients`.`docfile_id`
        WHERE `user_docfile`.`company_id` = ? AND
        `user_docfile_recipients`.`sent_at` IS NOT NULL AND `user_docfile_recipients`.`completed_at` IS NULL
SQL;

        $results = $this->db->query($query, [$cid])->result();
        $docfileIds = array_map(function ($result) {
            return $result->docfile_id;
        }, $results);

        if (empty($docfileIds)) {
            return [];
        }

        $this->db->where('status <>', 'Trashed');
        $this->db->where('status <>', 'Deleted');
        $this->db->where_in('id', $docfileIds);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('user_docfile')->result();
    }



    public function apiGetHash()
    {
        $recipientId = $this->input->get('recipient_id', true);
        $decrypted = $this->input->get('document_id', true);

        $message = json_encode(['recipient_id' => $recipientId, 'document_id' => $decrypted]);
        $hash = encrypt($message, $this->password);
        $url = rtrim($this->getSigningUrl(), '/') . '/signing?hash=' . $hash;

        header('content-type: application/json');
        echo json_encode([
            'data' => $url
        ]);
    }

    private function getGeneratedPDFUploadPath()
    {
        $filePath = FCPATH . (implode(DIRECTORY_SEPARATOR, ['uploads', 'docusigngeneratedpdfs']) . DIRECTORY_SEPARATOR);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }

        return $filePath;
    }

    public function debugGeneratePDF(){
        $pdf = $this->debugGeneratePDFMaker(1306);
        echo 'Finish';
    }

    public function debugGeneratePDFMaker($documentId)
    {

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        // if (is_null($document)) {
        //     return;
        // }

        // if ($document->status !== 'Completed') {
        //     return;
        // }

        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        require_once(APPPATH . 'libraries/tcpdf/tcpdi.php');
        // require_once(APPPATH . 'libraries/fpdi/autoload.php');
        // require_once(APPPATH . 'libraries/fpdi/Fpdi.php');

        $this->db->where('docfile_id', $document->id);
        $generatedPDF = $this->db->get('user_docfile_generated_pdfs')->row();

        if ($generatedPDF) {
            $generatedPDFPath = FCPATH . ltrim($generatedPDF->path, '/');

            if (file_exists($generatedPDFPath)) {
                $pdf = new FPDI('P', 'px');
                $pageCount = $pdf->setSourceFile($generatedPDFPath);

                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    //$pageIndex = $pdf->importPage($pageNo, \PageBoundaries::MEDIA_BOX);
                    $pageIndex = $pdf->importPage($pageNo);
                    $pdf->AddPage();
                    //$pdf->useTemplate($pageIndex, null, null, 0, 0, true);
                    $pdf->useTemplate($pageIndex);
                }

                return $pdf->Output(null, 'S');
            } else {
                $this->db->where('id', $generatedPDF->id);
                $this->db->delete('user_docfile_generated_pdfs');
            }
        }

        $this->db->where('docfile_id', $document->id);
        $this->db->order_by('id', 'ASC');
        $files = $this->db->get('user_docfile_documents')->result();

        $this->db->where('docfile_id', $document->id);
        $fields = $this->db->get('user_docfile_fields')->result();

        $this->db->where('docfile_id', $document->id);
        $recipients = $this->db->get('user_docfile_recipients')->result();

        foreach ($fields as $field) {
            if (in_array($field->field_name, ['Email', 'Name'])) {
                $recipientMatch = null;

                foreach ($recipients as $recipient) {
                    if ($recipient->id === $field->user_docfile_recipients_id) {
                        $recipientMatch = $recipient;
                        break;
                    }
                }

                if (!is_null($recipientMatch)) {
                    $field->value = $recipientMatch;
                    continue;
                }
            }


            $this->db->where('recipient_id', $field->user_docfile_recipients_id);
            $this->db->where('field_id', $field->id);
            $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
        }

        $pdf = new FPDI('P', 'px');

        $envelopId = null;
        if ($document->unique_key) {
            $envelopId = 'eSign Envelope ID: ' . $document->unique_key;
        }

        foreach ($files as $file) {
            $filepath = FCPATH . ltrim($file->path, '/');
            $pageCount = 0;

            try {
                // version not supported
                // https://www.setasign.com/support/faq/fpdi/error-document-compression-technique-not-supported/
                // Manual fix. Make sure all PDF are version 1.4.
                $pageCount = $pdf->setSourceFile($filepath);
            } catch (\Throwable $th) {
                continue;
            }

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pageIndex = $pdf->importPage($pageNo);
                //$pageIndex = $pdf->importPage($pageNo, PdfReader\PageBoundaries::MEDIA_BOX);
                $pdf->AddPage();
                $pdf->useTemplate($pageIndex, null, null, 0, 0, true);

                if (!is_null($envelopId)) {
                    $pdf->setY(5);
                    $pdf->setX(5);
                    $pdf->SetFont('Courier', '', 10);
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->Cell(360, 10, $envelopId, 0, 0, 'L', 1);
                }


                foreach ($fields as $field) {
                    if ((int) $field->doc_page !== $pageNo) {
                        continue;
                    }

                    if ($field->docfile_document_id !== $file->id) {
                        continue;
                    }

                    if (!$field->value) {
                        continue;
                    }

                    $value = $field->value;
                    $coordinates = json_decode($field->coordinates);

                    if ($field->field_name === 'Name') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (29 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.666666666666664 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        // $pdf->SetFont('Courier', '', 10);
                        // $pdf->Write(0, $value->name);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->name, 0, 0, 'L');
                    }

                    if ($field->field_name === 'Email') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.6 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.666666666666664 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $value->email);
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->email, 0, 0, 'L');
                    }

                    if (in_array($field->field_name, ['Checkbox', 'Radio', '2 GIG Go Panel 2', '2 GIG Go Panel 3', 'Lynx3000', 'LynxTouch', 'Vista/SEM', 'DSC', 'Other'])) {
                        $field_value = $value->value;
                        $value = json_decode($value->value);

                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.3 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (31.5 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        if (is_array($value->subCheckbox)) {
                            foreach ($value->subCheckbox as $subItem) {
                                if ($subItem->isChecked) {
                                    $myTop = (int) $subItem->top;
                                    $myLeft = (int) $subItem->left;

                                    $myTopAdjusted = (39.5 / 100) * $myTop;
                                    $myTopAdjusted = $myTop - $myTopAdjusted;
                                    $myTopAdjusted = $topAdjusted + $myTopAdjusted;

                                    $myLeftAdjusted = (-35 / 100) * $myLeft;
                                    $myLeftAdjusted = $myLeft + $myLeftAdjusted;
                                    $myLeftAdjusted = $leftAdjusted + $myLeftAdjusted;

                                    $pdf->setY($myTopAdjusted);
                                    $pdf->setX($myLeftAdjusted);

                                    $pdf->SetFont('Courier', '', 10);
                                    $pdf->Write(0, 'x');
                                }
                            }
                        }

                        if ($value->isChecked || $field_value == 'on') {
                            $pdf->setY($topAdjusted);
                            $pdf->setX($leftAdjusted);

                            $pdf->SetFont('Courier', '', 10);
                            $pdf->Write(0, 'x');
                        }
                    }

                    if ($field->field_name === 'Signature') {
                        $dataURI = $value->value;
                        $dataPieces = explode(',', $dataURI);
                        $encodedImg = $dataPieces[1];
                        $decodedImg = base64_decode($encodedImg);

                        if ($decodedImg !== false) {
                            $temporaryPath = FCPATH . ltrim($field->unique_key, '/');
                            $signatureHeight = 30;

                            if (file_put_contents($temporaryPath, $decodedImg) !== false) {
                                $top = (int) $coordinates->pageTop;
                                $left = (int) $coordinates->left;

                                $topAdjusted = (32.5 / 100) * $top;
                                $topAdjusted = $top - $topAdjusted;

                                $leftAdjusted = (38 / 100) * $left;
                                $leftAdjusted = $left - $leftAdjusted;

                                $pdf->setY($topAdjusted);
                                $pdf->setX($leftAdjusted);

                                $pdf->Image($temporaryPath, null, null, null,  $signatureHeight);
                                unlink($temporaryPath);

                                if ($value->created_at) {
                                    $date = new DateTime($value->created_at);
                                    $formattedDate = $date->format('F jS Y, g:i:s A');

                                    $pdf->setY($topAdjusted +  $signatureHeight);
                                    $pdf->setX($leftAdjusted);
                                    //$pdf->SetFont('Courier', '', 7);
                                    // $pdf->SetTextColor(255, 255, 255);
                                    // $pdf->SetFillColor(0, 0, 0);
                                    // $pdf->Cell(140, 0, $formattedDate, 1, 0, 'L', true);
                                    //$pdf->Write(0, $formattedDate);

                                    $pdf->SetFont('Arial', '', 10);
                                    $pdf->Cell(0, 0, $formattedDate, 0, 0, 'L');
                                }
                            }
                        }
                    }

                    if ($field->field_name === 'Text') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;                        
                         if( $left > 790 ){
                             $left = 774;
                         }

                        $topAdjusted = (31.8 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (30 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;
                        

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Arial', '', 10);                        
                        $field_value = trim($value->value);
                        //$pdf->Write(0, $field_value);
                        $pdf->Cell(0, 0, $field_value, 0, 0, 'L');
                    }

                    /*if ($field->field_name === 'Subscriber Name') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.5 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->value);
                    }*/

                    $custom_fields = ['Subscriber Name','City','State','Address','Subscriber Email','ZIP','Primary Contact','Secondary Contact','Access Password','Primary Contact Name','Primary Contact Number','Contact Number','Checking Account Number','Account Number','CS Account Number','ABA','Card Number','Card Holder Name','Card Expiration','Card Security Code','Equipment Cost','Monthly Monitoring Rate','One Time Activation (OTP)','Total Due','Primary Contact First Name','Primary Contact Last Name','Abort Code','County','Secondary Contact Name','Secondary Contact First Name','Secondary Contact Last Name', 'Secondary Contact Number', 'Date of Birth', 'Social Security Number', 'Equipment', 'kW DC', 'System Size'];

                    if ( in_array($field->field_name, $custom_fields) ) {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.5 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;
                        
                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $field->field_name);

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $field->field_name, 0, 0, 'L');
                    }

                    if ($field->field_name === 'Date Signed') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.9 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.3 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $value->value);
                        

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->value, 0, 0, 'L');
                    }

                    if ($field->field_name === 'Formula') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;
                        if( $left >= 780 ){
                            $left = 774;
                        }

                        $topAdjusted = (31.8 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (30 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $field_value = trim($value->value);
                        $field_value = $field_value;
                        $pdf->SetFont('Arial', '', 10);
                        //$pdf->Write(0, $field_value);
                        $pdf->Cell(0, 0, $field_value, 0, 0, 'L');
                    }

                    if ($field->field_name === 'Dropdown') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.9 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.3 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->value);
                    }
                }
            }
        }

        $uploadPath = $this->getGeneratedPDFUploadPath();
        $fileName = uniqid($document->id . rand(1, 9999999)) . '.pdf';
        $uploadFilePath = $uploadPath . $fileName;

        $this->db->insert('user_docfile_generated_pdfs', [
            'path' => str_replace(FCPATH, '/', $uploadFilePath),
            'docfile_id' => $document->id,
            'label' => $document->name
        ]);

        $docfileGeneratedPdfId = $this->db->insert_id();
        $this->db->where('docfile_id', $document->id);
        $this->db->update('user_customer_docfile', ['user_docfile_generated_pdfs_id' => $docfileGeneratedPdfId]);

        // Display in browser
        // $pdf->Output('I');

        $pdf->Output($uploadFilePath, 'F');
        return $pdf->Output(null, 'S');
    }

    public function generatePDF($documentId)
    {

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        if (is_null($document)) {
            return;
        }

        if ($document->status !== 'Completed') {
            return;
        }

        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        require_once(APPPATH . 'libraries/tcpdf/tcpdi.php');

        $this->db->where('docfile_id', $document->id);
        $generatedPDF = $this->db->get('user_docfile_generated_pdfs')->row();

        if ($generatedPDF) {
            $generatedPDFPath = FCPATH . ltrim($generatedPDF->path, '/');

            if (file_exists($generatedPDFPath)) {
                $pdf = new FPDI('P', 'px');
                $pageCount = $pdf->setSourceFile($generatedPDFPath);

                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    $pageIndex = $pdf->importPage($pageNo);
                    $pdf->AddPage();
                    $pdf->useTemplate($pageIndex, null, null, 0, 0, true);
                }

                return $pdf->Output(null, 'S');
            } else {
                $this->db->where('id', $generatedPDF->id);
                $this->db->delete('user_docfile_generated_pdfs');
            }
        }

        $this->db->where('docfile_id', $document->id);
        $this->db->order_by('id', 'ASC');
        $files = $this->db->get('user_docfile_documents')->result();

        $this->db->where('docfile_id', $document->id);
        $fields = $this->db->get('user_docfile_fields')->result();

        $this->db->where('docfile_id', $document->id);
        $recipients = $this->db->get('user_docfile_recipients')->result();

        foreach ($fields as $field) {
            if (in_array($field->field_name, ['Email', 'Name'])) {
                $recipientMatch = null;

                foreach ($recipients as $recipient) {
                    if ($recipient->id === $field->user_docfile_recipients_id) {
                        $recipientMatch = $recipient;
                        break;
                    }
                }

                if (!is_null($recipientMatch)) {
                    $field->value = $recipientMatch;
                    continue;
                }
            }


            $this->db->where('recipient_id', $field->user_docfile_recipients_id);
            $this->db->where('field_id', $field->id);
            $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
        }

        $pdf = new FPDI('P', 'px');

        $envelopId = null;
        if ($document->unique_key) {
            $envelopId = 'eSign Envelope ID: ' . $document->unique_key;
        }

        foreach ($files as $file) {
            $filepath = FCPATH . ltrim($file->path, '/');
            $pageCount = 0;

            try {
                // version not supported
                // https://www.setasign.com/support/faq/fpdi/error-document-compression-technique-not-supported/
                // Manual fix. Make sure all PDF are version 1.4.
                $pageCount = $pdf->setSourceFile($filepath);
            } catch (\Throwable $th) {
                continue;
            }

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pageIndex = $pdf->importPage($pageNo);
                $pdf->AddPage();
                $pdf->useTemplate($pageIndex, null, null, 0, 0, true);

                if (!is_null($envelopId)) {
                    $pdf->setY(5);
                    $pdf->setX(5);
                    $pdf->SetFont('Arial', '', 10);
                    //$pdf->SetFillColor(255, 255, 255);
                    $pdf->Cell(360, 10, $envelopId, 0, 0, 'L', 1);
                }


                foreach ($fields as $field) {
                    if ((int) $field->doc_page !== $pageNo) {
                        continue;
                    }

                    if ($field->docfile_document_id !== $file->id) {
                        continue;
                    }

                    if (!$field->value) {
                        continue;
                    }

                    $value = $field->value;
                    $coordinates = json_decode($field->coordinates);

                    if ($field->field_name === 'Name') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (29 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.666666666666664 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $value->name);

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->name, 0, 0, 'L');
                    }

                    if ($field->field_name === 'Email') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.6 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.666666666666664 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $value->email);

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->email, 0, 0, 'L');
                    }

                    if (in_array($field->field_name, ['Checkbox', 'Radio', '2 GIG Go Panel 2', '2 GIG Go Panel 3', 'Lynx3000', 'LynxTouch', 'Vista/SEM', 'DSC', 'Other'])) {
                        $field_value = $value->value;
                        $value = json_decode($value->value);

                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.3 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (31.5 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        if (is_array($value->subCheckbox)) {
                            foreach ($value->subCheckbox as $subItem) {
                                if ($subItem->isChecked) {
                                    $myTop = (int) $subItem->top;
                                    $myLeft = (int) $subItem->left;

                                    $myTopAdjusted = (39.5 / 100) * $myTop;
                                    $myTopAdjusted = $myTop - $myTopAdjusted;
                                    $myTopAdjusted = $topAdjusted + $myTopAdjusted;

                                    $myLeftAdjusted = (-35 / 100) * $myLeft;
                                    $myLeftAdjusted = $myLeft + $myLeftAdjusted;
                                    $myLeftAdjusted = $leftAdjusted + $myLeftAdjusted;

                                    $pdf->setY($myTopAdjusted);
                                    $pdf->setX($myLeftAdjusted);

                                    //$pdf->SetFont('Courier', '', 10);
                                    //$pdf->Write(0, 'x');

                                    $pdf->SetFont('Arial', '', 10);
                                    $pdf->Cell(0, 0, 'x', 0, 0, 'L');
                                }
                            }
                        }

                        if ($value->isChecked || $field_value == 'on') {
                            $pdf->setY($topAdjusted);
                            $pdf->setX($leftAdjusted);

                            //$pdf->SetFont('Courier', '', 10);
                            //$pdf->Write(0, 'x');

                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(0, 0, 'x', 0, 0, 'L');
                        }
                    }

                    if ($field->field_name === 'Signature') {
                        $dataURI = $value->value;
                        $dataPieces = explode(',', $dataURI);
                        $encodedImg = $dataPieces[1];
                        $decodedImg = base64_decode($encodedImg);

                        if ($decodedImg !== false) {
                            $temporaryPath = FCPATH . ltrim($field->unique_key, '/');
                            $signatureHeight = 30;

                            if (file_put_contents($temporaryPath, $decodedImg) !== false) {
                                $top = (int) $coordinates->pageTop;
                                $left = (int) $coordinates->left;

                                $topAdjusted = (32.5 / 100) * $top;
                                $topAdjusted = $top - $topAdjusted;

                                $leftAdjusted = (38 / 100) * $left;
                                $leftAdjusted = $left - $leftAdjusted;

                                $pdf->setY($topAdjusted);
                                $pdf->setX($leftAdjusted);

                                $pdf->Image($temporaryPath, null, null, null,  $signatureHeight);
                                unlink($temporaryPath);

                                if ($value->created_at) {
                                    $date = new DateTime($value->created_at);
                                    $formattedDate = $date->format('F jS Y, g:i:s A');

                                    $pdf->setY($topAdjusted +  $signatureHeight);
                                    $pdf->setX($leftAdjusted);
                                    //$pdf->SetFont('Courier', '', 7);
                                    // $pdf->SetTextColor(255, 255, 255);
                                    // $pdf->SetFillColor(0, 0, 0);
                                    // $pdf->Cell(140, 0, $formattedDate, 1, 0, 'L', true);
                                    //$pdf->Write(0, $formattedDate);

                                    $pdf->SetFont('Arial', '', 10);
                                    $pdf->Cell(0, 0, $formattedDate, 0, 0, 'L');
                                }
                            }
                        }
                    }

                    if ($field->field_name === 'Text') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;                        
                        if( $left > 790 ){
                            $left = 774;
                        }

                        $topAdjusted = (31.8 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (30 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;                        

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);
                        
                        $pdf->SetFont('Arial', '', 10);                        
                        $pdf->Cell(0, 0, trim($value->value), 0, 0, 'L');
                        //$pdf->Write(0, $field_value);
                    }

                    if ($field->widget_type === 'dynamic-widget') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;                        
                        if( $left > 790 ){
                            $left = 774;
                        }

                        $topAdjusted = (31.8 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (30 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;                        

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);
                        
                        $pdf->SetFont('Arial', '', 10);                        
                        $pdf->Cell(0, 0, trim($value->value), 0, 0, 'L');
                    }

                    /*if ($field->field_name === 'Subscriber Name') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.5 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->value);
                    }*/

                    $custom_fields = ['Subscriber Name','City','State','Address','Subscriber Email','ZIP','Primary Contact','Secondary Contact','Access Password','Primary Contact Name','Primary Contact Number','Contact Number','Checking Account Number','Account Number','CS Account Number','ABA','Card Number','Card Holder Name','Card Expiration','Card Security Code','Equipment Cost','Monthly Monitoring Rate','One Time Activation (OTP)','Total Due','Primary Contact First Name','Primary Contact Last Name','Abort Code','County','Secondary Contact Name','Secondary Contact First Name','Secondary Contact Last Name', 'Secondary Contact Number', 'Date of Birth', 'Social Security Number', 'Equipment', 'kW DC', 'System Size', 'Job Account Number', 'Panel Type', 'date_not_later_b'];

                    if ( in_array($field->field_name, $custom_fields) ) {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.5 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $value->value);

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->value, 0, 0, 'L');
                    }

                    if ($field->field_name === 'Date Signed') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.9 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.3 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $value->value);

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->value, 0, 0, 'L');
                    }

                    if ($field->field_name === 'Formula') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;
                        if( $left >= 790 ){
                             $left = 774;
                        }

                        $topAdjusted = (31.8 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (30 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);
                        
                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, trim($field_value));

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, trim($value->value), 0, 0, 'L');
                    }

                    if ($field->field_name === 'Dropdown') {
                        $top = (int) $coordinates->pageTop;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.9 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.3 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        //$pdf->SetFont('Courier', '', 10);
                        //$pdf->Write(0, $value->value);

                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(0, 0, $value->value, 0, 0, 'L');
                    }
                }
            }
        }

        $uploadPath = $this->getGeneratedPDFUploadPath();
        $fileName = uniqid($document->id . rand(1, 9999999)) . '.pdf';
        $uploadFilePath = $uploadPath . $fileName;

        $this->db->insert('user_docfile_generated_pdfs', [
            'path' => str_replace(FCPATH, '/', $uploadFilePath),
            'docfile_id' => $document->id,
            'label' => $document->name
        ]);

        $docfileGeneratedPdfId = $this->db->insert_id();
        $this->db->where('docfile_id', $document->id);
        $this->db->update('user_customer_docfile', ['user_docfile_generated_pdfs_id' => $docfileGeneratedPdfId]);

        // Display in browser
        // $pdf->Output('I');

        $pdf->Output($uploadFilePath, 'F');
        return $pdf->Output(null, 'S');
    }

    public function apiGetEsignDetails($documentId)
    {
        $this->db->select('user_docfile.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');
        $this->db->join('acs_profile', 'user_docfile.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('user_docfile.id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        if (is_null($document)) {
            header('content-type: application/json');
            exit(json_encode(['data' => null]));
        }

        $this->db->where('docfile_id', $document->id);
        $document->recipients = $this->db->get('user_docfile_recipients')->result();


        $lastRecipient = end(array_values($document->recipients));
        $message = json_encode([
            'recipient_id' => $lastRecipient->id,
            'document_id' => $document->id
        ]);

        $hash = encrypt($message, $this->password);
        $document->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;

        exit(json_encode(['data' => $document]));
    }

    public function apiSearchDocument()
    {
        $query = $this->input->get('query', TRUE);

        $this->db->select('user_docfile.*,acs_profile.first_name AS customer_firstname,acs_profile.last_name AS customer_lastname');
        $this->db->join('acs_profile', 'user_docfile.customer_id = acs_profile.prof_id', 'left');
        $this->db->group_start();
            $this->db->like('user_docfile.name', $query, 'both');
            $this->db->or_like('user_docfile.subject', $query, 'both');
            $this->db->or_like('user_docfile.unique_key', $query, 'both');
            $this->db->or_like('acs_profile.first_name', $query, 'both');
            $this->db->or_like('acs_profile.last_name', $query, 'both');
        $this->db->group_end();
        $this->db->where('user_docfile.status', 'Completed');
        $this->db->where('user_docfile.unique_key !=', '');
        $results = $this->db->get('user_docfile')->result();


        $results = array_map(function ($document) {
            $this->db->where('docfile_id', $document->id);
            $document->generated_pdf = $this->db->get('user_docfile_generated_pdfs')->row();

            $this->db->where('docfile_id', $document->id);
            $recipients = $this->db->get('user_docfile_recipients')->result();

            $lastRecipient = end(array_values($recipients));
            $message = json_encode([
                'recipient_id' => $lastRecipient->id,
                'document_id' => $document->id
            ]);

            $hash = encrypt($message, $this->password);
            $document->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;

            return $document;
        }, $results);

        exit(json_encode(['data' => $results]));
    }
}

// https://www.uuidgenerator.net/dev-corner/php
function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


// https://stackoverflow.com/a/50373095/8062659

function sign($message, $key)
{
    return hash_hmac('sha256', $message, $key) . $message;
}

function verify($bundle, $key)
{
    return hash_equals(
        hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
        mb_substr($bundle, 0, 64, '8bit')
    );
}

function getKey($password, $keysize = 16)
{
    return hash_pbkdf2('sha256', $password, 'some_token', 100000, $keysize, true);
}

function encrypt($message, $password)
{
    $iv = random_bytes(16);
    $key = getKey($password);
    $result = sign(openssl_encrypt($message, 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv), $key);
    return bin2hex($iv) . bin2hex($result);
}

function decrypt($hash, $password)
{
    $iv = hex2bin(substr($hash, 0, 32));
    $data = hex2bin(substr($hash, 32));
    $key = getKey($password);
    if (!verify($data, $key)) {
        return null;
    }
    return openssl_decrypt(mb_substr($data, 64, null, '8bit'), 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv);
}

function getMailInstance($config = [])
{
    $config = array_replace([
        'isHTML' => true,
        'subject' => 'nSmarTrac: DocuSign',
    ], $config);

    $server = MAIL_SERVER;
    $port = MAIL_PORT;
    $username = MAIL_USERNAME;
    $password = MAIL_PASSWORD;
    $from = MAIL_FROM;
    $subject = $config['subject'];

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
    $mail->IsHTML($config['isHTML']);

    if (isLocalhost()) {
        // Send using gmail
        $mail->Host = 'tls://smtp.gmail.com:587';
        $mail->Username = null;
        $mail->Password = null;
        $mail->port = 587;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
    }

    return $mail;
}

function isLocalhost(): bool
{
    $whitelist = ['127.0.0.1', '::1'];
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}
