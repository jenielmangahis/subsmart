<?php

defined('BASEPATH') or exit('No direct script access allowed');

// add services
include_once 'application/services/JobType.php';
include_once 'application/services/Priority.php';

class Tickets extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->checkLogin();

        $this->load->helper('google_calendar_helper');

        $this->page_data['page']->title = 'Workorder Management';

        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'workorder';
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('Users_model', 'users_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('General_model', 'general');
        $this->load->model('Tickets_model', 'tickets_model');
        $this->load->model('Customer_model', 'customer_model');
        
        $user_id = getLoggedUserID();

        // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/frontend/css/workorder/main.css',
            //"assets/css/accounting/sidebar.css",
            'assets/css/accounting/sales.css'
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/frontend/js/workorder/main.js'
        ));
    }

    
    public function savenewTicket()
    {   
        $this->load->helper(array('hashids_helper', 'form'));
        $this->load->model('JobSettings_model');

        $input = $this->input->post();
        $comp_id = logged('company_id');

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        
        $action = $this->input->post('action');
        $status = $this->input->post('ticket_status');

        $techni = serialize($this->input->post('assign_tech'));
        $tDate = date("Y-m-d",strtotime($this->input->post('ticket_date')));

        $new_data = array(
            'customer_id'               => $this->input->post('customer_id'),
            'business_name'             => $this->input->post('business_name'),
            'service_location'          => $this->input->post('service_location'),
            'service_description'       => $this->input->post('service_description'),
            'acs_city'                  => $this->input->post('customer_city'),
            'acs_state'                 => $this->input->post('customer_state'),
            'acs_zip'                   => $this->input->post('customer_zip'),
            'job_tag'                   => $this->input->post('job_tag'),
            'ticket_no'                 => $this->input->post('ticket_no'),
            'ticket_date'               => $tDate,
            'scheduled_time'            => $this->input->post('scheduled_time'),
            'scheduled_time_to'         => $this->input->post('scheduled_time_to'),
            'purchase_order_no'         => $this->input->post('purchase_order_no'),
            'ticket_status'             => $status,
            'panel_type'                => $this->input->post('panel_type'),
            'service_type'              => $this->input->post('service_type'),
            'warranty_type'             => $this->input->post('warranty_type'),
            'job_description'           => $this->input->post('job_description'),
            'technicians'               => $techni,
            'subtotal'                  => $this->input->post('subtotal'),
            'taxes'                     => $this->input->post('taxes'),
            'adjustment'                => $this->input->post('adjustment'),
            'adjustment_value'          => $this->input->post('adjustment_value'),
            'markup'                    => $this->input->post('markup'),
            'grandtotal'                => $this->input->post('grandtotal'),
            'payment_method'            => $this->input->post('payment_method'),
            'payment_amount'            => $this->input->post('payment_amount'),
            'billing_date'              => $this->input->post('billing_date'),
            'sales_rep'                 => $this->input->post('sales_rep'),
            'sales_rep_no'              => $this->input->post('sales_rep_no'),
            'tl_mentor'                 => $this->input->post('tl_mentor'),
            'message'                   => $this->input->post('message'),
            'terms_conditions'          => $this->input->post('terms_conditions'),
            'attachments'               => $this->input->post('attachments'),
            'instructions'              => $this->input->post('instructions'),
            'customer_phone'            => $this->input->post('customer_phone'),
            'employee_id'               => $this->input->post('employee_id'),
            'created_by'                => logged('id'),
            // 'hash_id'                   => $hasID,
            'company_id'                => $company_id,
            'created_at'                => date("Y-m-d H:i:s"),
            'updated_at'                => date("Y-m-d H:i:s"),
            'otp_setup'                 => $this->input->post('otps'),
            'monthly_monitoring'        => $this->input->post('monthly_monitoring'),
            'installation_cost'         => $this->input->post('installation_cost')
        );        

        $addQuery = $this->tickets_model->save_tickets($new_data);
        
        $this->load->helper(array('hashids_helper'));
        // $hasID = bin2hex(random_bytes(18));
        $hasID = hashids_encrypt($addQuery, '', 15);

        $update_data = array(
            'id'                        => $addQuery,
            'hash_id'                   => $hasID,
        );

        $updateaddQuery = $this->tickets_model->updateTicketsHash_ID($update_data);

        //Google Calendar
        createSyncToCalendar($addQuery, 'service_ticket', $company_id);

        if($this->input->post('payment_method') == 'Cash'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'is_collected'              => '1',
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Check'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'check_number'              => $this->input->post('check_number'),
                'routing_number'            => $this->input->post('routing_number'),
                'account_number'            => $this->input->post('account_number'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Credit Card'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'credit_number'             => $this->input->post('credit_number'),
                'credit_expiry'             => $this->input->post('credit_expiry'),
                'credit_cvc'                => $this->input->post('credit_cvc'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Debit Card'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'credit_number'             => $this->input->post('debit_credit_number'),
                'credit_expiry'             => $this->input->post('debit_credit_expiry'),
                'credit_cvc'                => $this->input->post('debit_credit_cvc'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'ACH'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'routing_number'            => $this->input->post('ach_routing_number'),
                'account_number'            => $this->input->post('ach_account_number'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Venmo'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('account_credentials'),
                'account_note'              => $this->input->post('account_note'),
                'confirmation'              => $this->input->post('confirmation'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Paypal'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('paypal_account_credentials'),
                'account_note'              => $this->input->post('paypal_account_note'),
                'confirmation'              => $this->input->post('paypal_confirmation'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Square'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('square_account_credentials'),
                'account_note'              => $this->input->post('square_account_note'),
                'confirmation'              => $this->input->post('square_confirmation'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Warranty Work'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('warranty_account_credentials'),
                'account_note'              => $this->input->post('warranty_account_note'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Home Owner Financing'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('home_account_credentials'),
                'account_note'              => $this->input->post('home_account_note'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'e-Transfer'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('e_account_credentials'),
                'account_note'              => $this->input->post('e_account_note'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Credit Card Professor'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'credit_number'             => $this->input->post('other_credit_number'),
                'credit_expiry'             => $this->input->post('other_credit_expiry'),
                'credit_cvc'                => $this->input->post('other_credit_cvc'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Payment Type'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('other_payment_account_credentials'),
                'account_note'              => $this->input->post('other_payment_account_note'),
                'ticket_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->save_payment($payment_data);
        }

        // dd($addQuery);

        if ($addQuery > 0) {

            //Auto update customer info
            $this->load->model('AcsProfile_model');
            $customer = $this->AcsProfile_model->getByProfId($this->input->post('customer_id'));
            if( $customer ){
                $phone_h = $customer->phone_h;
                if( $this->input->post('customer_phone') != '' ){
                    $phone_h = $this->input->post('customer_phone');
                }

                $phone_m = $customer->phone_m;
                if( $this->input->post('customer_mobile') != '' ){
                    $phone_m = $this->input->post('customer_mobile');
                }

                $business_name = $customer->business_name;
                if( $this->input->post('business_name') != '' ){
                    $business_name = $this->input->post('business_name');
                }

                $city = $customer->city;
                if( $this->input->post('customer_city') != '' ){
                    $city = $this->input->post('customer_city');
                }

                $state = $customer->state;
                if( $this->input->post('customer_state') != '' ){
                    $state = $this->input->post('customer_state');
                }

                $zip_code = $customer->zip_code;
                if( $this->input->post('customer_zip') != '' ){
                    $zip_code = $this->input->post('customer_zip');
                }

                $customer_data = [
                    'phone_h' => $phone_h,
                    'phone_m' => $phone_m,
                    'business_name' => $business_name,
                    'city' => $city,
                    'state' => $state,
                    'zip_code' => $zip_code
                ];
                $this->AcsProfile_model->updateCustomerByProfId($customer->prof_id, $customer_data);

            }

            //Activity Logs
            $this->load->model('Activity_model');
            $user_id = logged('id');
            $activity_name = 'Created Service Ticket Number ' . $this->input->post('ticket_no'); 
            $this->Activity_model->add($activity_name,$user_id);

            $temp_items             = $this->input->post('temp_items');
            $temp_item_type         = $this->input->post('temp_item_type');
            $temp_quantity          = $this->input->post('temp_quantity');
            $temp_price             = $this->input->post('temp_price');
            $temp_tax               = $this->input->post('temp_tax');
            $temp_total             = $this->input->post('temp_total');
            $temp_discount          = $this->input->post('temp_discount');
            $saveForFuture          = $this->input->post('saveForFuture');
            
            if($temp_items)
            {
                $b = 0;
                foreach($temp_items as $row2){
                    $data2['title'] = $temp_items[$b];
                    $data2['company_id'] = $company_id;
                    $data2['type'] = $temp_item_type[$b];
                    $data2['qty'] = $temp_quantity[$b];
                    $data2['price'] = $temp_price[$b];
                    $data2['discount'] = $temp_discount[$b];
                    $data2['tax'] = $temp_tax[$b];
                    $data2['total'] = $temp_total[$b];
                    $data2['added_from'] = 'Tickets';
                    $data2['id_form '] = $addQuery;
                    $addQuery3 = $this->estimate_model->add_estimate_temp_items($data2);

                    if((int) $saveForFuture[$b] == 1)
                    {
                        $data3['company_id']    = $company_id;
                        $data3['title']         = $temp_items[$b];
                        $data3['type']          = $temp_item_type[$b];
                        $data3['qty_order']     = $temp_quantity[$b];
                        $data3['price']         = $temp_price[$b];
                        $data3['retail']        = $temp_price[$b];
                        $data3['is_active']     = 1;
                        $addQuery4              = $this->estimate_model->add_new_items($data3);

                        $data4['items_id']      = $addQuery4;
                        $data4['qty']           = $temp_quantity[$b];
                        $data4['cost']          = $temp_price[$b];
                        $data4['tax']           = $temp_tax[$b];
                        $data4['total']         = $temp_total[$b];
                        $data4['ticket_id ']    = $addQuery;
                        $addQuery5              = $this->tickets_model->add_ticket_items($data4);

                        $deleteItem = $this->estimate_model->delete_temp_itemType($addQuery3,'Tickets');

                    }

                    $b++;
                }
            }

                $item_id    = $this->input->post('item_id');
                $item_type  = $this->input->post('item_type');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $discount   = $this->input->post('discount');
                $h          = $this->input->post('tax');
                $gtotal     = $this->input->post('total');

                $i = 0;
                foreach($item_id as $row){
                    $data['items_id']   = $item_id[$i];
                    $data['qty']        = $quantity[$i];
                    $data['cost']       = $price[$i];
                    $data['tax']        = $h[$i];
                    $data['item_type']  = $item_type[$i];
                    $data['discount']   = $discount[$i];
                    $data['total']      = $gtotal[$i];
                    $data['ticket_id '] = $addQuery;


                    $addQuery2 = $this->tickets_model->add_ticket_items($data);
                    $i++;
                }

        // setting job number
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => '*',
        );
        $job_settings     = $this->general->get_data_with_param($get_job_settings);
        $is_with_settings = 0;
        if ($job_settings) {
            $is_with_settings = 1;    
            $prefix   = $job_settings[0]->job_num_prefix;
            $next_num = str_pad($job_settings[0]->job_num_next, 5, '0', STR_PAD_LEFT);
        }else{
             $prefix = 'JOB-';
             $lastId = $this->jobs_model->getlastInsert($comp_id);
            if ($lastId) {
                $next_num = $lastId->id + 1;
                $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
            }else {
                $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            }
        }

        $job_number = $prefix . $next_num;
        // get customer info
        
        $get_customer_info = array(
            'where' => array(
                'prof_id' => $input['customer_id'],
            ),
            'table' => 'acs_profile',
            'select' => 'prof_id,first_name,last_name,mail_add,city,state,city,zip_code,email,phone_m',
        );
        $customer = $this->general->get_data_with_param($get_customer_info, false);
        $job_location = $customer->mail_add;

        // set data for jobs table
        $jobs_data = array(
            'job_number' => $job_number,
            'customer_id' => $input['customer_id'],
            'ticket_id' => $addQuery,
            'employee_id' => $input['employee_id'],
            'job_location' => $job_location,
            'job_description' => $input['job_description'],
            'start_date' => $tDate,
            'end_date' => $tDate,
            'event_color' => 0,
            'start_time' => $input['scheduled_time'],
            'end_time' => $input['scheduled_time_to'],
            'tags' => $input['job_tag'],
            'status' => $input['ticket_status'],
            'company_id' => $comp_id,
            'date_created' => date('Y-m-d H:i:s'),
            'tax_rate' => $input['taxes'],
            'employee_id' => $input['employee_id'],
            'job_type' => $input['service_type'],
            'date_issued' => $tDate,
            'work_order_id' => $input['work_order_id'] != NULL ? $input['work_order_id'] : 0
        );

        $assign_techs =  $input['assign_tech'];
        if(!empty($input['assign_tech'])){
            for($x = 0; $x < (count($input['assign_tech'])); $x++){
                $jobs_data['employee'.($x+2).'_id'] = $input['assign_tech'][$x];
            }
        }
        if (!empty($input['message'])) {
            $jobs_data['message'] = $input['message'];
        }

        // insert data to job        
        $jobs_id = $this->general->add_return_id($jobs_data, 'jobs');

        //Update job settings
        if( $is_with_settings == 1 ){
            $jobs_settings_data = array(
                'job_num_next' => $job_settings[0]->job_num_next + 1
            );
            $this->general->update_with_key($jobs_settings_data, $job_settings[0]->id, 'job_settings');
        }else{
            $data_job_settings = [
                'job_num_prefix' => $prefix,
                'job_num_next' => $lastId->id + 1,
                'company_id' => $comp_id
            ];

            $this->JobSettings_model->create($data_job_settings);
        }

        //Create initial job_payment data
        $job_payment_query = array(
            'amount' => $this->input->post('grandtotal'),
            'program_setup' => $this->input->post('otps'),
            'monthly_monitoring' => $this->input->post('monthly_monitoring'),
            'installation_cost' => $this->input->post('installation_cost'),
            'equipment_cost' => $this->input->post('subtotal'),
            'tax' => $this->input->post('taxes'),
            'job_id' => $jobs_id,
            'date_created' => date("Y-m-d h:i:s")
        );
        $this->general->add_($job_payment_query, 'job_payments');
        
        //Create hash_id
        $job_hash_id = hashids_encrypt($jobs_id, '', 15);
        $this->jobs_model->update($jobs_id, ['hash_id' => $job_hash_id]);
        
        customerAuditLog(logged('id'), $input['customer_id'], $jobs_id, 'Jobs', 'Added New Job #' . $job_number);
        //Google Calendar
        createSyncToCalendar($jobs_id, 'job', $comp_id);

        // insert data to job items table (items_id, qty, jobs_id)
        if (isset($input['item_id'])) {
            $devices = count($input['item_id']);
            for ($xx = 0; $xx < $devices; $xx++) {
                $job_items_data = array();
                $job_items_data['job_id']   = $jobs_id; //from jobs table
                $job_items_data['items_id'] = $input['item_id'][$xx];
                $job_items_data['qty']      = $input['quantity'][$xx];
                $job_items_data['cost']     = $input['price'][$xx] * $input['quantity'][$xx];
                $job_items_data['location'] = $input['location'][$xx];
                $job_items_data['discount'] = 0;
                $job_items_data['total']    = $input['total'][$xx];
                //$job_items_data['tax']      = $input['tax'][$xx];
                $job_items_data['tax']      = $input['tax'][$xx];
                $job_items_data['item_name'] = $input['items'][$xx];
                $this->general->add_($job_items_data, 'job_items');
                unset($job_items_data);
            }
        }

        // insert data to job url links table
        $link = isset($input['link']) ? $input['link'] : 'none';
        $jobs_links_data = array(
            'link' => $link,
            'job_id' => $jobs_id,
        );
        $this->general->add_($jobs_links_data, 'job_url_links');

        // insert data to jobs approval table
        $jobs_approval_data = array(
            'authorize_name' => $input['authorize_name'],
            'signature_link' => $input['signature_link'],
            'datetime_signed' => $input['datetime_signed'],
            'jobs_id' => $jobs_id,
        );
        $this->general->add_($jobs_approval_data, 'jobs_approval');

        createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', $input['employee_id'], $input['employee_id'], 0);
        foreach($assign_techs as $uid){
            createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $uid, 0);
        }

        // GET CUSTOMER AND USER INFO
        $getUserInfo = array(
            'where' => array('id' => logged('id')),
            'table' => 'users'
        );
        $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

        $getCustomerInfo = array(
            'where' => array('prof_id' => $this->input->post('customer_id')),
            'table' => 'acs_profile'
        );
        $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

        // JOB CUSTOMER ACTIVITY LOG RECORDING
        $customerLogsRecording = array(
            'date' => date('m/d/Y')."<br>".date('h:i A'),
            'customer_id' => $this->input->post('customer_id'),
            'user_id' => logged('id'),
            'logs' => "$getUserInfo->FName $getUserInfo->LName scheduled a job with you. <a href='#' onclick='window.open(`".base_url('job/new_job1/').$jobs_id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>$job_number</a>"
        );
        $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);

        // SERVICE TICKET CUSTOMER ACTIVITY LOG RECORDING
        $customerLogsRecording = array(
            'date' => date('m/d/Y')."<br>".date('h:i A'),
            'customer_id' => $this->input->post('customer_id'),
            'user_id' => logged('id'),
            'logs' => "$getUserInfo->FName $getUserInfo->LName created a service ticket with you. <a href='#' onclick='window.open(`".base_url('tickets/viewDetails/').$addQuery."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('ticket_no')."</a>"
        );
        $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);


        if( $this->input->post('redirect_calendar') == 1){
            redirect('workcalender');
        }else{
            redirect('job/new_job1/'.$jobs_id);
        }
            
        } else {
            echo json_encode(0);
        }
    }

    public function saveUpdateTicket()
    {
        $id = $this->input->post('ticketID');

        $this->load->helper('form');

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        
        $action = $this->input->post('action');
        // if($action == 'Scheduled') 
        // {
        //     $status = 'Scheduled';
        // }else{
            $status = $this->input->post('ticket_status');
        // }

        // implode(",", $this->input->post('assign_tech'));
        $ticketsData = $this->tickets_model->get_tickets_data_one($id);
        $technician = serialize($this->input->post('assign_tech'));
        if($technician == 'N;')
        {
            $techni = $ticketsData->technicians;
        }else{
            $techni = serialize($this->input->post('assign_tech'));
        }
        
        // dd($techni);
        // dd($status);

        // dd($this->input->post());
        $update_data = array(
            'id'                        => $this->input->post('ticketID'),
            'customer_id'               => $this->input->post('customer_id'),
            'business_name'             => $this->input->post('business_name'),
            'service_location'          => $this->input->post('service_location'),
            'service_description'       => $this->input->post('service_description'),
            'acs_city'                  => $this->input->post('customer_city'),
            'acs_state'                 => $this->input->post('customer_state'),
            'acs_zip'                   => $this->input->post('customer_zip'),
            'job_tag'                   => $this->input->post('job_tag'),
            'ticket_no'                 => $this->input->post('ticket_no'),
            'ticket_date'               => $this->input->post('ticket_date'),
            'scheduled_time'            => $this->input->post('scheduled_time'),
            'scheduled_time_to'         => $this->input->post('scheduled_time_to'),
            'purchase_order_no'         => $this->input->post('purchase_order_no'),
            'job_description'           => $this->input->post('job_description'),
            'ticket_status'             => $status,
            'panel_type'                => $this->input->post('panel_type'),
            'service_type'              => $this->input->post('service_type'),
            'warranty_type'             => $this->input->post('warranty_type'),
            'technicians'               => $techni,
            'subtotal'                  => $this->input->post('subtotal'),
            'taxes'                     => $this->input->post('taxes'),
            'adjustment'                => $this->input->post('adjustment'),
            'adjustment_value'          => $this->input->post('adjustment_value'),
            'markup'                    => $this->input->post('markup'),
            'grandtotal'                => $this->input->post('grandtotal'),
            'payment_method'            => $this->input->post('payment_method'),
            'payment_amount'            => $this->input->post('payment_amount'),
            'billing_date'              => $this->input->post('billing_date'),
            'sales_rep'                 => $this->input->post('sales_rep'),
            'sales_rep_no'              => $this->input->post('sales_rep_no'),
            'tl_mentor'                 => $this->input->post('tl_mentor'),
            'message'                   => $this->input->post('message'),
            'terms_conditions'          => $this->input->post('terms_conditions'),
            'attachments'               => $this->input->post('attachments'),
            'instructions'              => $this->input->post('instructions'),
            'customer_phone'            => $this->input->post('customer_phone'),
            'employee_id'               => $this->input->post('employee_id'),
            'created_by'                => logged('id'),
            'company_id'                => $company_id,
            'created_at'                => date("Y-m-d H:i:s"),
            'updated_at'                => date("Y-m-d H:i:s")
        );

        $addQuery = $this->tickets_model->updateTickets($update_data);

        //Activity Logs
        $this->load->model('Activity_model');
        $user_id = logged('id');
        $activity_name = 'Updated Service Ticket Number ' . $this->input->post('ticket_no'); 
        $this->Activity_model->add($activity_name,$user_id);

        
        if($this->input->post('payment_method') == 'Cash'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'is_collected'      => '1',
                'ticket_id'         => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_cash($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Check'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'check_number'      => $this->input->post('check_number'),
                'routing_number'    => $this->input->post('routing_number'),
                'ticket_id'         => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_check($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Credit Card'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'credit_number'     => $this->input->post('credit_number'),
                'credit_expiry'     => $this->input->post('credit_expiry'),
                'credit_cvc'        => $this->input->post('credit_cvc'),
                'ticket_id'         => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_creditCard($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Debit Card'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'credit_number'     => $this->input->post('debit_credit_number'),
                'credit_expiry'     => $this->input->post('debit_credit_expiry'),
                'credit_cvc'        => $this->input->post('debit_credit_cvc'),
                'ticket_id'         => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_debitCard($payment_data);
        }
        elseif($this->input->post('payment_method') == 'ACH'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'routing_number'    => $this->input->post('ach_routing_number'),
                'account_number'    => $this->input->post('ach_account_number'),
                'ticket_id'         => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_ACH($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Venmo'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('account_credentials'),
                'account_note'          => $this->input->post('account_note'),
                'confirmation'          => $this->input->post('confirmation'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Venmo($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Paypal'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('paypal_account_credentials'),
                'account_note'          => $this->input->post('paypal_account_note'),
                'confirmation'          => $this->input->post('paypal_confirmation'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Paypal($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Square'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('square_account_credentials'),
                'account_note'          => $this->input->post('square_account_note'),
                'confirmation'          => $this->input->post('square_confirmation'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Square($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Warranty Work'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('warranty_account_credentials'),
                'account_note'          => $this->input->post('warranty_account_note'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Warranty($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Home Owner Financing'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('home_account_credentials'),
                'account_note'          => $this->input->post('home_account_note'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Home($payment_data);
        }
        elseif($this->input->post('payment_method') == 'e-Transfer'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('e_account_credentials'),
                'account_note'          => $this->input->post('e_account_note'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Transfer($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Credit Card Professor'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'credit_number'         => $this->input->post('other_credit_number'),
                'credit_expiry'         => $this->input->post('other_credit_expiry'),
                'credit_cvc'            => $this->input->post('other_credit_cvc'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Professor($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Payment Type'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('other_payment_account_credentials'),
                'account_note'          => $this->input->post('other_payment_account_note'),
                'ticket_id'             => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->tickets_model->update_Other($payment_data);
        }

        $ticket_id = $this->input->post('ticketID');
        //Google Calendar
        createSyncToCalendar($ticket_id, 'service_ticket', $company_id);

        // dd($addQuery);
        $delete2 = $this->tickets_model->delete_items($id);
        //if ($addQuery > 0) {        
        if ($addQuery) {

                $item_id    = $this->input->post('item_id');
                $item_type  = $this->input->post('item_type');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $discount   = $this->input->post('discount');
                $h          = $this->input->post('tax');
                $gtotal     = $this->input->post('total');
                
        
        // dd( $this->input->post('item_id'));

                $i = 0;
                foreach($item_id as $row){
                    $data['items_id']   = $item_id[$i];
                    $data['qty']        = $quantity[$i];
                    $data['cost']       = $price[$i];
                    $data['tax']        = $h[$i];
                    $data['item_type']  = $item_type[$i];
                    $data['discount']   = $discount[$i];
                    $data['total']      = $gtotal[$i];
                    $data['ticket_id '] = $this->input->post('ticketID');


                    $addQuery2 = $this->tickets_model->add_ticket_items($data);
                    $i++;
                }

            // // }
            // $userid = logged('id');

            // $getname = $this->tickets_model->getname($userid);

            //     $notif = array(
            
            //         'user_id'               => $userid,
            //         'title'                 => 'New Ticket',
            //         'content'               => $getname->FName. ' has created new Ticket.'. $this->input->post('ticket_number'),
            //         'date_created'          => date("Y-m-d H:i:s"),
            //         'status'                => '1',
            //         'company_id'            => getLoggedCompanyID()
            //     );
    
            //     $notification = $this->tickets_model->save_notification($notif);

            // GET CUSTOMER AND USER INFO
            $getUserInfo = array(
                'where' => array('id' => logged('id')),
                'table' => 'users'
            );
            $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

            $getCustomerInfo = array(
                'where' => array('prof_id' => $this->input->post('customer_id')),
                'table' => 'acs_profile'
            );
            $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

            // SERVICE TICKET CUSTOMER ACTIVITY LOG RECORDING
            $customerLogsRecording = array(
                'date' => date('m/d/Y')."<br>".date('h:i A'),
                'customer_id' => $this->input->post('customer_id'),
                'user_id' => logged('id'),
                'logs' => "$getUserInfo->FName $getUserInfo->LName updated a service ticket. <a href='#' onclick='window.open(`".base_url('tickets/viewDetails/').$this->input->post('ticketID')."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('ticket_no')."</a>"
            );
            $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);


            if( $this->input->post('redirect_calendar') == 1){
                redirect('workcalender');
            }else{
                redirect('customer/ticketslist');
            }
            
        } else {
            echo json_encode(0);
        }
    }

    public function viewDetails($id)
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();        

        $tickets = $this->tickets_model->get_tickets_data_one($id);
        $ticket_rep  = $tickets->sales_rep;

        $this->page_data['reps'] = $this->tickets_model->get_ticket_representative($ticket_rep);
        // var_dump($ticket_rep);
        
        $this->page_data['ticketsCompany'] = $this->tickets_model->get_tickets_company($tickets->company_id);
        $this->page_data['tickets'] = $this->tickets_model->get_tickets_data_one($id);
        $this->page_data['items'] = $this->tickets_model->get_ticket_items($id);
        $this->page_data['payment'] = $this->tickets_model->get_ticket_payments($id);
        $this->page_data['clients'] = $this->tickets_model->get_tickets_clients($tickets->company_id);

        $ticketdet = $this->tickets_model->get_tickets_data_one($id);
            // $tech = explode(",", $tick->technicians);
            // $assigned_technician = unserialize($ticketdet->technicians);
            // // var_dump($assigned_technician);
            //     foreach($assigned_technician as $eid){
            //         $custom_html = '<div class="nsm-profile me-3 calendar-tile-assigned-tech" style="background-image: url(\''.userProfileImage($eid).'\'); width: 30px;display:inline-block;">'.getUserName($eid).'</div>';
            //     }
        // $this->page_data['technicians'] = $custom_html;

        $assigned_technician = unserialize($ticketdet->technicians);
            if(!empty($assigned_technician))
            {
                // var_dump($assigned_technician);
                    foreach($assigned_technician as $eid){
                        $custom_html = '<div class="nsm-profile me-3 calendar-tile-assigned-tech" style="background-image: url(\''.userProfileImage($eid).'\'); width: 30px;display:inline-block;">'.getUserName($eid).'</div>';
                    }

            }else
            {
                $custom_html = '<span></span>';
            }

        
        $this->load->view('tickets/view', $this->page_data);
    }

    public function editDetails($id)
    {
        $this->hasAccessModule(39);
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');
        $this->page_data['page']->title = 'Tickets';

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        /*if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }*/
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $default_customer_id = 0;
        if( $this->input->get('cus_id') ){
            $default_customer_id = $this->input->get('cus_id');
        }

        $this->page_data['default_customer_id'] = $default_customer_id;

        $default_start_date = date("Y-m-d");
        $default_start_time = '';
        $default_user = 0;
        $redirect_calendar = 0;

        if( $this->input->get('start_date') ){
            $default_start_date = $this->input->get('start_date');
            $redirect_calendar = 1;
        }

        if( $this->input->get('start_time') ){
            $default_start_time = $this->input->get('start_time');
            $redirect_calendar = 1;
        }

        if( $this->input->get('user') ){
            $default_user = $this->input->get('user');
            $redirect_calendar = 1;
        }

        $this->page_data['redirect_calendar'] = $redirect_calendar;
        $this->page_data['default_user'] = $default_user;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->page_data['default_start_time'] = $default_start_time;

        $this->page_data['items'] = $this->items_model->getItemlist();
        $type = $this->input->get('type');
        $this->page_data['tags'] = $this->Job_tags_model->getJobTagsByCompany($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['serviceType'] = $this->tickets_model->getServiceType($company_id);
        $this->page_data['tickets'] = $this->tickets_model->get_tickets_data_one($id);
        $this->page_data['itemLists'] = $this->tickets_model->get_ticket_items($id);
        
        $this->page_data['itemsLists'] = $this->tickets_model->get_ticket_items($id);
        
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('tickets/edit_ticket', $this->page_data);
    }

    
    public function addTicketCust($id)
    {
        $this->hasAccessModule(39);
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');
        $this->page_data['page']->title = 'Services';

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        /*if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }*/
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        $this->page_data['custIndividual'] = $this->AcsProfile_model->getCustByProfId($id);

        // dd($this->AcsProfile_model->getCustByProfId($id));

        $default_customer_id = 0;
        if( $this->input->get('cus_id') ){
            $default_customer_id = $this->input->get('cus_id');
        }

        $this->page_data['default_customer_id'] = $default_customer_id;
        
        //Settings
            $prefix = 'SERVICE-';
            $lastInserted = $this->tickets_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next = $lastInserted->ticket_no;
                $arr = explode("-", $next);
                $val = $arr[1];

                $next_num = $val + 1;
                // dd($next_num);
            }else{
                $next_num = 1;
            }

        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

        // dd($next_num);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;

        $this->page_data['items'] = $this->items_model->getItemlist();
        $type = $this->input->get('type');
        $this->page_data['tags'] = $this->Job_tags_model->getJobTagsByCompany($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['serviceType'] = $this->tickets_model->getServiceType($company_id);
        
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['headers'] = $this->tickets_model->getHeaders($company_id);
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyName'] = $this->tickets_model->getCompany($company_id);

        $this->page_data['cus_id'] = $id;
        
        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('tickets/customer_tickets', $this->page_data);
    }

    public function addnewTicketApmt()
    {
        
        $this->hasAccessModule(39);
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');
        $this->page_data['page']->title = 'Services';

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        /*if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }*/
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        $this->page_data['custIndividual'] = $this->AcsProfile_model->getCustByProfId($id);

        // dd($this->AcsProfile_model->getCustByProfId($id));

        $default_customer_id = 0;
        if( $this->input->get('cus_id') ){
            $default_customer_id = $this->input->get('cus_id');
        }

        $this->page_data['default_customer_id'] = $default_customer_id;

        $userID = $_GET['appointment_user_id'];

        //Settings
            $prefix = 'SERVICE-';
            $lastInserted = $this->tickets_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next = $lastInserted->ticket_no;
                $arr = explode("-", $next);
                $val = $arr[1];

                $next_num = $val + 1;
                // dd($next_num);
            }else{
                $next_num = 1;
            }

        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

        // dd($next_num);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;


        $this->page_data['items'] = $this->items_model->getItemlist();
        $type = $this->input->get('type');
        $this->page_data['tags'] = $this->Job_tags_model->getJobTagsByCompany($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['serviceType'] = $this->tickets_model->getServiceType($company_id);  

        $this->page_data['appointment_date'] = $this->input->post('appointment_date');
        $this->page_data['appointment_time'] = $this->input->post('appointment_time');
        $this->page_data['appointment_user_id'] = $this->input->post('appointment_user_id');
        $this->page_data['appointment_customer_id'] = $this->input->post('appointment_customer_id');
        $this->page_data['appointment_type_id'] = $this->input->post('appointment_type_id');
        
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['headers'] = $this->tickets_model->getHeaders($company_id);
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);

        $this->page_data['user'] = $this->tickets_model->getUserDetails($userID);
        $this->page_data['companyName'] = $this->tickets_model->getCompany($company_id);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('tickets/customer_tickets_apmt', $this->page_data);
    }

    public function saveServiceType()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $data = array(
            
            'service_name'  => $this->input->post('service_name'),
            'company_id'    => $company_id,
        );

        $custom_dataQuery = $this->tickets_model->saveServiceType($data);

        $is_success = 1;
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function deleteTicket()
    {
        $ticketID = $this->input->post('tkID');
        
        $user_login = logged('FName') . ' ' . logged('LName');
        
        $ticketInfo = $this->tickets_model->getTicketInfo($ticketID);
        // Record Job delete to Customer Activities Module in Customer Dashboard
            $action = "$user_login deleted a service ticket. $ticketInfo->ticket_no";

            $customerLogPayload = array(
                'date' => date('m/d/Y')."<br>".date('h:i A'),
                'customer_id' => $ticketInfo->customer_id,
                'user_id' => logged('id'),
                'logs' => "$action"
            );
            $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogPayload);

        $is_success =  $this->tickets_model->delete_tickets($ticketID);
        echo json_encode($is_success);
    }

    public function saveTickets()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $data = array(
            
            'content'  => $this->input->post('content'),
            'company_id'    => $company_id,
        );

        $query = $this->tickets_model->saveHeader($data);

        $is_success = 1;
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function updateHeader()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $data = array(
            'company_id'    => $company_id,
            'content'       => $this->input->post('content'),
        );

        $query = $this->tickets_model->updateHeader($data);

        $is_success = 1;
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function custom_service_tickets()
    {
        
        $this->hasAccessModule(39);
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');
        $this->page_data['page']->title = 'Services';

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        /*if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }*/
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        $this->page_data['custIndividual'] = $this->AcsProfile_model->getCustByProfId($id);

        // dd($this->AcsProfile_model->getCustByProfId($id));

        $default_customer_id = 0;
        if( $this->input->get('cus_id') ){
            $default_customer_id = $this->input->get('cus_id');
        }

        $this->page_data['default_customer_id'] = $default_customer_id;

        $userID = $_GET['appointment_user_id'];

        //Settings
            $prefix = 'SERVICE-';
            $lastInserted = $this->tickets_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next = $lastInserted->ticket_no;
                $arr = explode("-", $next);
                $val = $arr[1];

                $next_num = $val + 1;
                // dd($next_num);
            }else{
                $next_num = 1;
            }

        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

        // dd($next_num);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;


        $this->page_data['items'] = $this->items_model->getItemlist();
        $type = $this->input->get('type');
        $this->page_data['tags'] = $this->Job_tags_model->getJobTagsByCompany($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['serviceType'] = $this->tickets_model->getServiceType($company_id);

        $this->page_data['appointment_date'] = $this->input->post('appointment_date');
        $this->page_data['appointment_time'] = $this->input->post('appointment_time');
        $this->page_data['appointment_user_id'] = $this->input->post('appointment_user_id');
        $this->page_data['appointment_customer_id'] = $this->input->post('appointment_customer_id');
        $this->page_data['appointment_type_id'] = $this->input->post('appointment_type_id');
        
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyName'] = $this->tickets_model->getCompany($company_id);

        $this->page_data['user'] = $this->tickets_model->getUserDetails($userID);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('tickets/custom_add', $this->page_data);
    }

    public function settings()
    {
        
        $user_id = logged('id');
        $company_id = logged('company_id');
        $role = logged('role');

        $this->page_data['tickets'] = $this->tickets_model->get_tickets_data();

        $this->load->view('tickets/settings', $this->page_data);
    }

    public function ajax_quick_view_details()
    {
        $company_id  = getLoggedCompanyID();
        $user_id     = getLoggedUserID();
        $post        = $this->input->post();
        $id          = $post['appointment_id'];

        $tickets     = $this->tickets_model->get_tickets_data_one($id);
        $ticket_rep  = $tickets->sales_rep;
        
        $this->page_data['reps'] = $this->tickets_model->get_ticket_representative($ticket_rep);
        $this->page_data['ticketsCompany'] = $this->tickets_model->get_tickets_company($tickets->company_id);
        $this->page_data['tickets'] = $tickets;
        $this->page_data['items'] = $this->tickets_model->get_ticket_items($id);
        $this->page_data['payment'] = $this->tickets_model->get_ticket_payments($id);
        $this->page_data['clients'] = $this->tickets_model->get_tickets_clients($tickets->company_id);
        $this->load->view('tickets/ajax_quick_view_details', $this->page_data);
    }

    public function ajax_quick_add_service_ticket_form()
    {
        $this->load->helper('functions');
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('User_docflies_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id    = logged('id');
        $company_id = logged('company_id');
        $role = logged('role');
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);       

        $default_start_date = date("Y-m-d");
        $default_start_time = '';

        if( $this->input->get('date_selected') ){
            $default_start_date = $this->input->get('date_selected');
        }

        if( $this->input->get('start_time') ){
            $default_start_time = $this->input->get('start_time');
        }
        
        //Settings
        $prefix = 'SERVICE-';
        $lastInserted = $this->tickets_model->getlastInsert($company_id);
        if( $lastInserted ){
            $next = $lastInserted->ticket_no;
            $arr = explode("-", $next);
            $val = $arr[1];

            $next_num = $val + 1;            
        }else{
            $next_num = 1;
        }

        $next_num  = str_pad($next_num, 5, '0', STR_PAD_LEFT);
        $ratePlans = $this->Customer_advance_model->getAllSettingsRatePlansByCompanyId($company_id);

        //esign templates
        $esignTemplates  = $this->User_docflies_model->getAllDocfileTemplatesByCompanyId($company_id);
        $defaultTemplate = $this->User_docflies_model->getDefaultTemplateByCompanyId($company_id);
        if( $defaultTemplate ){
            foreach($esignTemplates as $record){
                $record->is_default = $defaultTemplate->template_id == $record->id ? 1 : 0;
            }
        }

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->page_data['default_start_time'] = $default_start_time;
        $this->page_data['items'] = $this->items_model->getItemlist();        
        $this->page_data['ratePlans'] = $ratePlans;
        $this->page_data['esignTemplates'] = $esignTemplates;
        $this->page_data['tags'] = $this->Job_tags_model->getJobTagsByCompany($company_id);
        $this->page_data['type'] = $this->input->get('type');
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['serviceType'] = $this->tickets_model->getServiceType($company_id);
        $this->page_data['headers'] = $this->tickets_model->getHeaders($company_id);
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->load->view('tickets/ajax_quick_add_service_ticket_form', $this->page_data);
    }

    public function ajax_create_service_ticket()
    {
        $this->load->helper(array('hashids_helper', 'form'));
        $this->load->model('JobSettings_model');
        $this->load->model('Customer_advance_model');

        $jobs_id  = 0;
        $is_valid = 1;
        $msg = '';
        $esign_id = 0;        

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        if( $this->input->post('customer_id') == '' || $this->input->post('customer_id') == 0 ){
            $msg = 'Please select customer';
            $is_valid = 0;
        }

        /*if( $this->input->post('business_name') == '' ){
            $msg = 'Please specify business name';
            $is_valid = 0;
        }*/

        if( $this->input->post('customer_city') == '' || $this->input->post('service_location') == '' || $this->input->post('customer_state') == ''){
            $msg = 'Please specify location (city, state, service location)';
            $is_valid = 0;
        }

        if( $this->input->post('customer_phone') == '' ){
            $msg = 'Please specify contact number';
            $is_valid = 0;
        }

        if( $this->input->post('assign_tech') == '' ){
            $msg = 'Please select assigned technician';
            $is_valid = 0;
        }

        if( $this->input->post('item_id') === null ){
            $msg = 'Please select an item';
            $is_valid = 0;   
        }

        if( $is_valid == 1 ){

            $monthly_monitoring_cost = 0;
            $update_customer_mmr     = 0;
            $update_customer_billing = 0;
            $installation_cost = 0;
            $otp_cost = 0;
            if( $this->input->post('is_with_esign') ){
                $otp_cost = $this->input->post('otp');
                $installation_cost = $this->input->post('installation_cost');
                $monthly_monitoring_cost = $this->input->post('monthly_monitoring_rate');
                $esign_id = $this->input->post('esign_template');
                $update_customer_mmr = 1;
                $update_customer_billing = 1;
            }

            $techni = serialize($this->input->post('assign_tech'));
            $tDate  = date("Y-m-d",strtotime($this->input->post('ticket_date')));
            $status = $this->input->post('ticket_status');

            $new_data = array(
                'customer_id'               => $this->input->post('customer_id'),
                'business_name'             => $this->input->post('business_name'),
                'service_location'          => $this->input->post('service_location'),
                'service_description'       => $this->input->post('service_description'),
                'acs_city'                  => $this->input->post('customer_city'),
                'acs_state'                 => $this->input->post('customer_state'),
                'acs_zip'                   => $this->input->post('customer_zip'),
                'job_tag'                   => $this->input->post('job_tag'),
                'ticket_no'                 => $this->input->post('ticket_no'),
                'ticket_date'               => $tDate,
                'scheduled_time'            => $this->input->post('scheduled_time'),
                'scheduled_time_to'         => $this->input->post('scheduled_time_to'),
                'purchase_order_no'         => $this->input->post('purchase_order_no'),
                'ticket_status'             => $status,
                'panel_type'                => $this->input->post('panel_type'),
                'service_type'              => $this->input->post('service_type'),
                'warranty_type'             => $this->input->post('warranty_type'),
                'technicians'               => $techni,
                'subtotal'                  => $this->input->post('subtotal'),
                'taxes'                     => $this->input->post('taxes'),
                'adjustment'                => '',
                'adjustment_value'          => 0,
                'markup'                    => '',
                'grandtotal'                => $this->input->post('grandtotal'),
                'payment_method'            => '',
                'payment_amount'            => 0,
                'billing_date'              => '',
                'sales_rep'                 => $this->input->post('sales_rep'),
                'sales_rep_no'              => $this->input->post('sales_rep_no'),
                'tl_mentor'                 => $this->input->post('tl_mentor'),
                'message'                   => $this->input->post('message'),
                'terms_conditions'          => $this->input->post('terms_conditions'),
                'attachments'               => '',
                'instructions'              => $this->input->post('instructions'),
                'job_description'           => $this->input->post('job_description'),
                'customer_phone'            => $this->input->post('customer_phone'),
                'employee_id'               => $this->input->post('employee_id'),
                'created_by'                => logged('id'),
                'monthly_monitoring'        => $monthly_monitoring_cost,
                'otp_setup'                 => $otp_cost,
                'installation_cost'         => $installation_cost,
                // 'hash_id'                   => $hasID,
                'company_id'                => $company_id,
                'created_at'                => date("Y-m-d H:i:s"),
                'updated_at'                => date("Y-m-d H:i:s")
            );
            

            $addQuery = $this->tickets_model->save_tickets($new_data);
            $hasID    = hashids_encrypt($addQuery, '', 15);

            $update_data = array(
                'id'                        => $addQuery,
                'hash_id'                   => $hasID,
            );

            $updateaddQuery = $this->tickets_model->updateTicketsHash_ID($update_data);

            //Update customer mmr
            if( $update_customer_mmr == 1 ){
                $check = [
                    'where' => [
                        'fk_prof_id' => $this->input->post('customer_id'),
                    ],
                    'table' => 'acs_alarm',
                ];
                $exist = $this->general->get_data_with_param($check, false);
                if ($exist) {
                    $input_alarm['panel_type'] = $this->input->post('panel_type');
                    $input_alarm['monthly_monitoring'] = $monthly_monitoring_cost;
                    $input_alarm['otps'] = $otp_cost;   
                    $this->general->update_with_key_field($input_alarm, $this->input->post('customer_id'), 'acs_alarm', 'fk_prof_id');
                }else{
                    $input_alarm['fk_prof_id'] = $this->input->post('customer_id');
                    $input_alarm['monitor_comp'] = '';
                    $input_alarm['monitor_id'] = 0;
                    $input_alarm['acct_type'] = '';
                    $input_alarm['online'] = 'Yes';
                    $input_alarm['in_service'] = 'Yes';
                    $input_alarm['equipment'] = '';
                    $input_alarm['collections'] = '';
                    $input_alarm['credit_score_alarm'] = '';
                    $input_alarm['passcode'] = '';
                    $input_alarm['install_code'] = '';
                    $input_alarm['mcn'] = 0;
                    $input_alarm['scn'] = 0;
                    $input_alarm['panel_type'] = $this->input->post('panel_type');
                    $input_alarm['system_type'] = '';
                    $input_alarm['warranty_type'] = $this->input->post('warranty_type');
                    $input_alarm['dealer'] = '';
                    $input_alarm['alarm_login'] = '';
                    $input_alarm['alarm_customer_id'] = '';
                    $input_alarm['alarm_cs_account'] = '';
                    $input_alarm['comm_type'] = '';
                    $input_alarm['account_cost'] = 0;
                    $input_alarm['pass_thru_cost'] = 0;
                    $input_alarm['monthly_monitoring'] = $monthly_monitoring_cost;
                    $input_alarm['otps'] = $otp_cost;   
                    $this->general->add_($input_alarm, 'acs_alarm');
                }
            }

            //Update customer billing
            if( $update_customer_billing == 1 ){
                $billing = $this->Customer_advance_model->get_data_by_id('fk_prof_id', $this->input->post('customer_id'), 'acs_billing');
                if( $billing ){
                    $input_billing['routing_num'] = $this->input->post('routing_number');
                    $input_billing['acct_num'] = $this->input->post('account_number');
                    $input_billing['check_num'] = $this->input->post('checking_account_number');
                    $input_billing['credit_card_exp_mm_yyyy'] = $this->input->post('card_security_code');
                    $this->general->update_with_key_field($input_billing, $this->input->post('customer_id'), 'acs_billing', 'fk_prof_id');
                }else{
                    $input_billing['fk_prof_id'] = $this->input->post('customer_id');
                    $input_billing['card_address'] = $this->input->post('service_location');
                    $input_billing['city'] = $this->input->post('customer_city');
                    $input_billing['state'] = $this->input->post('customer_state');
                    $input_billing['zip'] = $this->input->post('customer_zip');
                    $input_billing['mmr'] = $monthly_monitoring_cost;
                    $input_billing['bill_start_date'] = NULL;
                    $input_billing['bill_end_date'] = NULL;
                    $input_billing['routing_num'] = $this->input->post('routing_number');
                    $input_billing['acct_num'] = $this->input->post('account_number');
                    $input_billing['check_num'] = $this->input->post('checking_account_number');
                    $input_billing['credit_card_exp_mm_yyyy'] = $this->input->post('card_security_code');
                    $this->general->add_($input_billing, 'acs_billing');
                } 
            }               

            //Google Calendar
            createSyncToCalendar($addQuery, 'service_ticket', $company_id);

            if ($addQuery > 0) {
                $item_id    = $this->input->post('item_id');
                $item_type  = $this->input->post('item_type');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $discount   = $this->input->post('discount');
                $tax        = $this->input->post('tax');
                $gtotal     = $this->input->post('total');

                $i = 0;
                foreach($item_id as $row){
                    $data['items_id']   = $item_id[$i];
                    $data['qty']        = $quantity[$i];
                    $data['cost']       = $price[$i];
                    $data['tax']        = $tax[$i];
                    $data['item_type']  = $item_type[$i];
                    $data['discount']   = $discount[$i];
                    $data['total']      = $gtotal[$i];
                    $data['ticket_id '] = $addQuery;
                    $addQuery2 = $this->tickets_model->add_ticket_items($data);
                    $i++;
                }
            }

            //Auto create job             
            $get_job_settings = array(
                'where' => array(
                    'company_id' => $company_id
                ),
                'table' => 'job_settings',
                'select' => '*',
            );
            $job_settings     = $this->general->get_data_with_param($get_job_settings);
            $is_with_settings = 0;
            if ($job_settings) {
                $is_with_settings = 1;    
                $prefix   = $job_settings[0]->job_num_prefix;
                $next_num = str_pad($job_settings[0]->job_num_next, 5, '0', STR_PAD_LEFT);
            }else{
                 $prefix = 'JOB-';
                 $lastId = $this->jobs_model->getlastInsert($company_id);
                if ($lastId) {
                    $next_num = $lastId->id + 1;
                    $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
                }else {
                    $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
                }
            }
            $job_number = $prefix . $next_num;

            // get customer info
            $get_customer_info = array(
                'where' => array(
                    'prof_id' => $this->input->post('customer_id'),
                ),
                'table' => 'acs_profile',
                'select' => 'prof_id,first_name,last_name,mail_add,city,state,city,zip_code,email,phone_m',
            );
            $customer = $this->general->get_data_with_param($get_customer_info, false);
            $job_location = $customer->mail_add;
            $job_description = $this->input->post('job_description');
            
            $jobs_data = array(
                'job_number' => $job_number,
                'customer_id' => $this->input->post('customer_id'),
                'ticket_id' => $addQuery,
                'employee_id' => $this->input->post('employee_id'),
                'job_location' => $job_location,
                'job_description' => $job_description,
                'created_by' => logged('id'),
                'start_date' => date("Y-m-d",strtotime($this->input->post('ticket_date'))),
                'end_date' => date("Y-m-d",strtotime($this->input->post('ticket_date'))),
                'start_time' => $this->input->post('scheduled_time'),
                'event_color' => 0,
                'end_time' => $this->input->post('scheduled_time_to'),
                'tags' => $this->input->post('job_tag'),
                'status' => $this->input->post('ticket_status'),
                'company_id' => $company_id,
                'date_created' => date('Y-m-d H:i:s'),
                'tax_rate' => $this->input->post('taxes'),
                'employee_id' => $this->input->post('employee_id'),
                'job_type' => $this->input->post('service_type'),
                'date_issued' => date("Y-m-d",strtotime($this->input->post('ticket_date'))),
                'work_order_id' => 0
            );
            
            $assign_techs =  $this->input->post('assign_tech');
            if(!empty($assign_techs)){
                for($x = 0; $x < (count($assign_techs)); $x++){
                    $jobs_data['employee'.($x+2).'_id'] = $assign_techs[$x];
                }
            }
            if (!empty($this->input->post('message'))) {
                $jobs_data['message'] = $this->input->post('message');
            }
            
            $jobs_id = $this->general->add_return_id($jobs_data, 'jobs');
            $invoice_id = $this->createInitialInvoice($jobs_id);

            //Update job settings
            if( $is_with_settings == 1 ){
                $jobs_settings_data = array(
                    'job_num_next' => $job_settings[0]->job_num_next + 1
                );
                $this->general->update_with_key($jobs_settings_data, $job_settings[0]->id, 'job_settings');
            }else{
                $data_job_settings = [
                    'company_id' => $company_id,
                    'job_num_prefix' => $prefix,
                    'job_num_next' => $lastId->id + 1
                ];

                $this->JobSettings_model->create($data_job_settings);
            }

            //Create hash_id
            $job_hash_id = hashids_encrypt($jobs_id, '', 15);
            $this->jobs_model->update($jobs_id, ['hash_id' => $job_hash_id]);
            
            customerAuditLog(logged('id'), $this->input->post('customer_id'), $jobs_id, 'Jobs', 'Added New Job #' . $job_number);

            //Google Calendar
            createSyncToCalendar($jobs_id, 'job', $company_id);

            // insert data to job items table (items_id, qty, jobs_id)
            $item_id    = $this->input->post('item_id');
            $item_type  = $this->input->post('item_type');
            $quantity   = $this->input->post('quantity');
            $price      = $this->input->post('price');
            $discount   = $this->input->post('discount');
            $tax        = $this->input->post('tax');
            $gtotal     = $this->input->post('total');
            $item_name  = $this->input->post('items');
            $i = 0;
            foreach($item_id as $row){
                $job_items_data = array();
                $job_items_data['items_id']   = $item_id[$i];
                $job_items_data['qty']        = $quantity[$i];
                $job_items_data['cost']       = $price[$i] * $quantity[$i];
                $job_items_data['tax']        = $tax[$i];
                $job_items_data['discount']   = 0;
                $job_items_data['total']      = $gtotal[$i];
                $job_items_data['job_id']     = $jobs_id;
                $job_items_data['location']   = '';
                $job_items_data['points']     = 0;
                $job_items_data['item_name']  = $item_name[$i];
                $this->general->add_($job_items_data, 'job_items');
                $i++;
            }

            // insert data to job url links table
            $link = isset($input['link']) ? $input['link'] : 'none';
            $jobs_links_data = array(
                'link' => 'none',
                'job_id' => $jobs_id,
            );
            $this->general->add_($jobs_links_data, 'job_url_links');

            // insert data to jobs approval table
            /*$jobs_approval_data = array(
                'authorize_name' => $input['authorize_name'],
                'signature_link' => $input['signature_link'],
                'datetime_signed' => $input['datetime_signed'],
                'jobs_id' => $jobs_id,
            );
            $this->general->add_($jobs_approval_data, 'jobs_approval');*/

            // insert data to job payments table
            $job_payment_query = array(
                'amount' => $this->input->post('grandtotal'),
                'job_id' => $jobs_id,
            );
            $this->general->add_($job_payment_query, 'job_payments');

            createCronAutoSmsNotification($company_id, $jobs_id, 'job', 'Scheduled', $this->input->post('employee_id'), $this->input->post('employee_id'), 0);
            foreach($assign_techs as $uid){
                createCronAutoSmsNotification($company_id, $jobs_id, 'job', 'Scheduled', 0, $uid, 0);
            }

            // GET CUSTOMER AND USER INFO
            $getUserInfo = array(
                'where' => array('id' => logged('id')),
                'table' => 'users'
            );
            $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

            $getCustomerInfo = array(
                'where' => array('prof_id' => $this->input->post('customer_id')),
                'table' => 'acs_profile'
            );
            $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

            // JOB CUSTOMER ACTIVITY LOG RECORDING
            $customerLogsRecording = array(
                'date' => date('m/d/Y')."<br>".date('h:i A'),
                'customer_id' => $this->input->post('customer_id'),
                'user_id' => logged('id'),
                'logs' => "$getUserInfo->FName $getUserInfo->LName scheduled a job with you. <a href='#' onclick='window.open(`".base_url('job/new_job1/').$jobs_id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>$job_number</a>"
            );
            $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);

            // SERVICE TICKET CUSTOMER ACTIVITY LOG RECORDING
            $customerLogsRecording = array(
                'date' => date('m/d/Y')."<br>".date('h:i A'),
                'customer_id' => $this->input->post('customer_id'),
                'user_id' => logged('id'),
                'logs' => "$getUserInfo->FName $getUserInfo->LName created a service ticket with you. <a href='#' onclick='window.open(`".base_url('tickets/viewDetails/').$addQuery."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('ticket_no')."</a>"
            );
            $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);

            //Activity Logs
            $activity_name = 'Created Caledar Schedule ' . $this->input->post('ticket_no'); 
            createActivityLog($activity_name);
        }

        $json_data = ['is_success' => $is_valid, 'msg' => $msg, 'job_id' => $jobs_id, 'esign_id' => $esign_id, 'customer_id' => $this->input->post('customer_id')];
        echo json_encode($json_data);       

        exit;
    }

    public function ajax_get_customer_basic_info()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('Customer_advance_model');

        $prof_id    = $this->input->post('id');
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getCustomerBasicInfoByProfIdAndCompanyId($prof_id, $company_id);
        if( $customer ){
            $routing_number = ''; //ABA
            $acct_num  = '';
            $check_num = '';
            $cvc = '';

            $billing = $this->Customer_advance_model->get_data_by_id('fk_prof_id', $prof_id, 'acs_billing');            
            if($billing){
                $routing_number = $billing->routing_num;
                $acct_num  = $billing->acct_num;
                $check_num = $billing->check_num;
                $cvc = $billing->credit_card_exp_mm_yyyy;
            }
            $json_data = [
                'mail_add' => $customer->mail_add,
                'city' => $customer->city,
                'state' => $customer->state,
                'zip_code' => $customer->zip_code,
                'phone_h' => formatPhoneNumber($customer->phone_h),
                'phone_m' => formatPhoneNumber($customer->phone_m),
                'business_name' => $customer->business_name,
                'routing_number' => $routing_number,
                'acct_num' => $acct_num,
                'check_num' => $check_num,
                'cvc' => $cvc
            ];     
        }else{
            $json_data = [
                'mail_add' => '',
                'city' => '',
                'state' => '',
                'zip_code' => '',
                'phone_h' => '',
                'phone_m' => '',
                'business_name' => '',
                'routing_number' => '',
                'acct_num' => '',
                'check_num' => '',
                'cvc' => ''
            ];
        }
        
        echo json_encode($json_data);
    }

    public function ajax_quick_delete_ticket()
    {
        $company_id = logged('company_id');
        $is_success = 0;
        $msg  = 'Cannot find data'; 
        
        $post   = $this->input->post();
        $ticket = $this->tickets_model->get_tickets_by_id_and_company_id($post['schedule_id'],$company_id);
        if( $ticket ){
            if( $this->tickets_model->delete_tickets($ticket->id) ){

                customerAuditLog(logged('id'), $ticket->customer_id, $ticket->id, 'Service Ticket', 'Deleted Ticket #'.$ticket->ticket_no);

                $is_success = 1;
                $msg = '';
            }    
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);       

        exit;
    }

    public function createInitialInvoice($job_id)
    {
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_settings_model');

        $company_id = logged('company_id');
        
        $this->db->where('id', $job_id);
        $job = $this->db->get('jobs')->row();

        $this->db->where('prof_id', $job->customer_id);
        $customer = $this->db->get('acs_profile')->row();

        $workorder = array();
        if( $job->work_order_id > 0 ){
            $this->db->where('id', $job->work_order_id);
            $workorder = $this->db->get('work_orders')->row();
        }
        
        $this->db->where('id', $job->ticket_id);
        $ticket = $this->db->get('tickets')->row();

        $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($company_id);
        if( $invoiceSettings ){            
            $next_number = (int) $invoiceSettings->invoice_num_next;     
            $prefix      = $invoiceSettings->invoice_num_prefix;        
        }else{
            $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($company_id);
            $prefix     = 'INV-';
            if( $lastInsert ){
                $next_number   = $lastInsert->id + 1;
            }else{
                $next_number   = 1;
            }
        }

        $invoiceNumber = formatInvoiceNumberV2($prefix, $next_number);        

        $monthly_monitoring = $ticket->monthly_monitoring;
        $program_setup      = $ticket->otp_setup;
        $installation_cost  = $ticket->installation_cost;

        $grand_total = $ticket->grandtotal;
        $sub_total   = $ticket->subtotal;
        $tax         = $ticket->taxes;

        $new_data = array(
            'customer_id'               => $job->customer_id,
            'job_location'              => $job->job_location,
            'job_name'                  => $job->job_name,
            'job_id'                    => $job->id,
            'job_number'                => $job->job_number,
            'business_name'             => $customer->business_name,
            'tags'                      => $job->tags,
            'invoice_type'              => 'Total Due',
            'work_order_number'         => !empty($workorder) ? $workorder->work_order_number : '',
            'purchase_order'            => '',
            'invoice_number'            => $invoiceNumber,
            'date_issued'               => date("Y-m-d"),
            'customer_email'            => $customer->email,
            'online_payments'           => '',
            'billing_address'           => $customer->mail_add,
            'shipping_to_address'       => $customer->mail_add,
            'ship_via'                  => '',
            'shipping_date'             => '',
            'tracking_number'           => '',
            'terms'                     => 0,     
            'tip'                       => 0,       
            'due_date'                  => date("Y-m-d", strtotime("+5 days")),
            'location_scale'            => '',
            'message_to_customer'       => '',
            'terms_and_conditions'      => !empty($workorder) ? $workorder->terms_and_conditions : '',            
            'attachments'               => $job->attachment,
            'status'                    => 'Draft',
            'company_id'                => $company_id,
            'deposit_request_type'      => '$',
            'deposit_request'           => '0',
            'monthly_monitoring'        => $monthly_monitoring,
            'program_setup'             => $program_setup,
            'installation_cost'         => $installation_cost,
            'payment_methods'           => $job->BILLING_METHOD,
            'sub_total'                 => $sub_total,
            'taxes'                     => $tax,
            'adjustment_name'           => !empty($workorder) ? $workorder->adjustment_name : '',
            'adjustment_value'          => !empty($workorder) ? $workorder->adjustment_value : 0,
            'grand_total'               => $grand_total,
            'user_id'                   => logged('id'),
            'date_created'              => date("Y-m-d H:i:s"),
            'date_updated'              => date("Y-m-d H:i:s")
        );

        $invoice_id = $this->Invoice_model->createInvoice($new_data);

        //Update invoice settings
        if( $invoiceSettings ){
            $invoice_settings_data = ['invoice_num_next' => $next_number + 1];
            $this->Invoice_settings_model->update($invoiceSettings->id, $invoice_settings_data);
        }else{
            $invoice_settings_data = [
                'invoice_num_prefix' => $prefix,
                'invoice_num_next' => $next_number,
                'check_payable_to' => '',
                'accept_credit_card' => 1,
                'accept_check' => 0,
                'accept_cash'  => 1,
                'accept_direct_deposit' => 0,
                'accept_credit' => 0,
                'mobile_payment' => 1,
                'capture_customer_signature' => 1,
                'hide_item_price' => 0,
                'hide_item_qty' => 0,
                'hide_item_tax' => 0,
                'hide_item_discount' => 0,
                'hide_item_total' => 0,
                'hide_from_email' => 0,
                'hide_item_subtotal' => 0,
                'hide_business_phone' => 0,
                'hide_office_phone' => 0,
                'accept_tip' => 0,
                'due_terms' => '',
                'auto_convert_completed_work_order' => 0,
                'message' => 'Thank you for your business.',
                'terms_and_conditions' => 'Thank you for your business.',
                'company_id' => $company_id,
                'commercial_message' => 'Thank you for your business.',
                'commercial_terms_and_conditions' => 'Thank you for your business.',
                'logo' => '',
                'payment_fee_percent' => '',
                'payment_fee_amount' => '',
                'recurring' => ''
            ];

            $this->Invoice_settings_model->create($invoice_settings_data);
        }

        //Job Items
        $jobItems = $this->jobs_model->get_specific_job_items($job->id);
        foreach( $jobItems as $item ){
            $invoice_item_data = [
                'invoice_id' => $invoice_id,
                'items_id' => $item->fk_item_id,
                'qty' => $item->qty,
                'cost' => $item->cost,
                'tax' => $item->tax,
                'discount' => $item->discount,
                'total' => $item->total
            ];

            $this->Invoice_model->add_invoice_details($invoice_item_data);
        }

        return $invoice_id;
    }
}



/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */
