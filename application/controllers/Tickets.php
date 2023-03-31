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
        $this->load->helper('form');
        $input = $this->input->post();
        $comp_id = logged('company_id');

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        
        $action = $this->input->post('action');
        $status = $this->input->post('ticket_status');
        /*if($action == 'Scheduled') 
        {
            $status = 'Scheduled';
        }else{
            $status = $this->input->post('ticket_status');
        }*/

        // implode(",", $this->input->post('assign_tech'));
        $techni = serialize($this->input->post('assign_tech'));
        $tDate = date("Y-m-d",strtotime($this->input->post('ticket_date')));

        // dd($status);

        // dd($this->input->post());
        
        $SEND_EMAIL_ON_SCHEDULE = $this->input->post('SEND_EMAIL_ON_SCHEDULE');
        
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
            'updated_at'                => date("Y-m-d H:i:s")
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
                    $data['ticket_id '] = $addQuery;


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

        // setting job number
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => '*',
        );
        $job_settings = $this->general->get_data_with_param($get_job_settings);
        if ($job_settings) {    
            $prefix   = $job_settings[0]->job_num_prefix;
            $next_num = str_pad($job_settings[0]->job_num_next, 5, '0', STR_PAD_LEFT);
            //$job_number = $job_settings[0]->job_num_prefix.'-000000'.$job_settings[0]->job_num_next;
        } else {
            $prefix = 'JOB-';
            $lastId = $this->jobs_model->getlastInsert($comp_id);
            if ($lastId) {
                $next_num = $lastId->id + 1;
                $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
            } else {
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
        // 
        
        $jobs_data = array(
            'job_number' => $job_number,
            'customer_id' => $input['customer_id'],
            'ticket_id' => $addQuery,
            'employee_id' => $input['employee_id'],
            'job_location' => $job_location,
            'job_description' => $input['job_description'],
            'start_date' => $tDate,
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
        
        customerAuditLog(logged('id'), $input['customer_id'], $jobs_id, 'Jobs', 'Added New Job #' . $job_number);
        //Google Calendar
        createSyncToCalendar($jobs_id, 'job', $comp_id);

        // insert data to job items table (items_id, qty, jobs_id)
        if (isset($input['item_id'])) {
            $devices = count($input['item_id']);
            for ($xx = 0; $xx < $devices; $xx++) {
                $job_items_data = array();
                $job_items_data['job_id'] = $jobs_id; //from jobs table
                $job_items_data['items_id'] = $input['item_id'][$xx];
                $job_items_data['qty'] = $input['quantity'][$xx];
                $job_items_data['location'] = $input['location'][$xx];
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

        // insert data to job payments table
        $job_payment_query = array(
            'amount' => $input['payment_amount: '],
            'job_id' => $jobs_id,
        );
        $this->general->add_($job_payment_query, 'job_payments');

        createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', $input['employee_id'], $input['employee_id'], 0);

            if( $this->input->post('redirect_calendar') == 1){
                redirect('workcalender');
            }else{
                $this->session->set_userdata('CREATE_INITIAL_INVOICE_ALERT', 'true');
                redirect('job/new_job1/'.$jobs_id);
            }
            
        } else {
            echo json_encode(0);
        }

        if ($SEND_EMAIL_ON_SCHEDULE == "true") { sendCustomerInvoiceToEmail($jobs_id); }
    }

    public function sendCustomerInvoiceToEmail($id) {
        $this->load->helper(['url', 'hashids_helper']);
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');

        $job = $this->jobs_model->get_specific_job($id);
        if ($job) {
            //Update hashid
            if ($job->hash_id == '') {
                $eid = hashids_encrypt($job->job_unique_id, '', 15);
                $job_id = hashids_decrypt($eid, '', 15);
                $this->jobs_model->update($job->id, ['hash_id' => $eid]);
            } else {
                $eid = $job->hash_id;
                $job_id = hashids_decrypt($eid, '', 15);
            }

            $url = base_url('/job_invoice_view/' . $eid);
            $customer = $this->AcsProfile_model->getByProfId($job->customer_id);

            $get_company_info = [
                'where' => [
                    'company_id' => $job->company_id,
                ],
                'table' => 'business_profile',
                'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
            ];

            $company = $this->general_model->get_data_with_param($get_company_info, false);
            $jobs_data_items = $this->jobs_model->get_specific_job_items($job_id);
            $group_items = [];
            foreach ($jobs_data_items as $ji) {
                $type = 'product';
                if ($ji->type != 'product') {
                    $type = 'service';
                }
                $group_items[$type][] = [
                    'item_name' => $ji->title,
                    'item_price' => $ji->price,
                    'item_qty' => $ji->qty,
                    'item_tax' => $ji->tax,
                ];
            }
            $msg = "";
            $subject = "nSmartrac: {$job->job_number} Invoice";
            $img_source = base_url('/uploads/users/business_profile/' . $company->id . '/' . $company->business_image);
            $msg .= "<img style='width: 300px;margin-top:41px;margin-bottom:24px;' alt='Logo' src='" . $img_source . "' /><br />";
            $msg .= "<h1>Your Invoice from " . $company->business_name . "</h1><br />";
            $msg .= "<p>Hi " . $customer->first_name . ",</p>";
            $msg .= "<p>Attached please find invoice <b>#" . $job->job_number . "</b> for your service</p>";
            $msg .= "<p>Thank you,</p><br />";

            $msg .= "<table>";
            $msg .= "<tr><td><b>Invoice Number</b></td><td>: " . $job->job_number . "</td></tr>";
            $msg .= "<tr><td><b>Service Date</b></td><td>: " . date('m/d/Y', strtotime($job->start_date)) . "</td></tr>";
            $msg .= "<tr><td colspan='2'><br /></td></tr>";
            $msg .= "<tr><td><b>Customer Name</b></td><td>: " . $job->first_name . ' ' . $job->last_name . "</td></tr>";
            $msg .= "<tr><td><b>Service Address</b></td><td>: " . $job->cust_city . ' ' . $job->cust_state . ' ' . $job->cust_zip_code . "</td></tr>";
            $msg .= "</table>";

            $grand_total = 0;
            foreach ($group_items as $type => $items) {
                $subtotal = 0;

                $msg .= "<h2>" . ucfirst($type) . "</h2>";
                $msg .= "<table>";
                foreach ($items as $i) {
                    $total = $i['item_price'] * $i['item_qty'];
                    $total_tax = $total_tax + $i['tax'];
                    //$msg  .= "<tr><td>".$item->title."</td><td>".$item->qty."x".$item->price."</td><td>".number_format((float)$total,2,'.',',')."</td></tr>";
                    $msg .= "<tr><td width='300'>" . $i['item_name'] . "</td><td>" . number_format((float) $total, 2, '.', ',') . "</td></tr>";
                    $subtotal = $subtotal + $total;
                }
                $msg .= "<tr><td colspan='2'><hr /></td></tr>";
                $msg .= "<tr><td width='300'>Subtotal</td><td>" . number_format((float) $subtotal, 2, '.', ',') . "</td></tr>";
                $msg .= "</table>";

                $grand_total += $subtotal;
            }

            $nsmart_logo = base_url("assets/dashboard/images/logo.png");
            $refer_friend = base_url("assets/img/refer_friend.jpg");
            $refer_friend_url = base_url('refer_friend');

            $msg .= "<br /><br />";
            $msg .= "<table>";
            //$msg .= "<tr><td width='300'><h3>Amount Due</h3></td><td><h2>".number_format((float)$grand_total, 2, '.', ',')."</h2></td></tr>";
            $msg .= "<tr><td width='300'><h3>Amount Due</h3></td><td><h2>" . number_format((float) $job->total_amount, 2, '.', ',') . "</h2></td></tr>";
            $msg .= "<tr><td colspan='2'><br><br></td></tr>";
            $msg .=
                "<tr><td colspan='2' style='text-align:center;'><a href='" .
                $url .
                "' style='background-color:#32243d;color:#fff;padding:10px 25px;border:1px solid transparent;border-radius:2px;font-size:22px;text-decoration:none;'>PAY NOW</a></td></tr>";
            $msg .= "</table>";

            if ($job->invoice_term != '') {
                $msg .= $job->invoice_term;
            } else {
                $msg .=
                    "<p style='margin-top:43px;width:23%;color:#222;font-size:16px;text-align:left;padding:19px;'>Delinquent Account are subject to Property Liens. Interest will be charged to delinquent accounts at the rate of 1.5% (18% Annum) per month. In the event of default, the customer agrees to pay all cost of collection, including attorney's fees, whether suit is brought or not.</p>";
            }

            $msg .=
                "<p style='width:24%;color:#222;font-size:16px;text-align:center;padding:1px;'><a href='tel:" .
                $company->business_phone .
                "'>" .
                $company->business_phone .
                "</a> | <a href='mailto:" .
                $company->business_email .
                "'>" .
                $company->business_email .
                "</a></p>";
            $msg .= "<a href='" . $refer_friend_url . "' style='margin-left:156px;'><img src='" . $refer_friend . "' style='width:122px;' /></a>";

            $msg .= "<br><br><br><br><br>";

            $msg .= "<table style='margin-left:48px;'>";
            $msg .= "<tr><td colspan='2' style='text-align:center;'><span style='display:inline-block;'>Powered By</span> <br><br> <img style='width:328px;margin-bottom:40px;' src='" . $nsmart_logo . "' /></td></tr>";
            $msg .= "</table>";

            $recipient = $customer->email;
            $attachment = $this->create_job_invoice_pdf($job->job_unique_id);

            $mail = email__getInstance(['subject' => $subject]);
            $mail->FromName = 'NsmarTrac';
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $this->generateJobInvoiceHTML($job->job_unique_id);
            // $mail->addAttachment($attachment);
            $mail->Send();
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

        // dd($addQuery);
        $delete2 = $this->tickets_model->delete_items($id);

        if ($addQuery > 0) {

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
                    $data['ticket_id '] = $addQuery;


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
        
        $this->page_data['headers'] = $this->tickets_model->getHeaders($company_id);
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyName'] = $this->tickets_model->getCompany($company_id);

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
        $this->page_data['tickets'] = $this->tickets_model->get_tickets_data_one($id);
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

        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->page_data['default_start_time'] = $default_start_time;
        $this->page_data['items'] = $this->items_model->getItemlist();        
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

        $is_valid = 1;
        $msg = '';

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

            //Google Calendar
            createSyncToCalendar($addQuery, 'service_ticket', $company_id);

            if ($addQuery > 0) {
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
            }
        }
        

        $json_data = ['is_success' => $is_valid, 'msg' => $msg];
        echo json_encode($json_data);       

        exit;
    }

    public function ajax_get_customer_basic_info()
    {
        $this->load->model('AcsProfile_model');

        $prof_id    = $this->input->post('id');
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getCustomerBasicInfoByProfIdAndCompanyId($prof_id, $company_id);
        if( $customer ){
            $json_data = [
                'mail_add' => $customer->mail_add,
                'city' => $customer->city,
                'state' => $customer->state,
                'zip_code' => $customer->zip_code,
                'phone_h' => formatPhoneNumber($customer->phone_h),
                'phone_m' => formatPhoneNumber($customer->phone_m),
                'business_name' => $customer->business_name
            ];    
        }else{
            $json_data = [
                'mail_add' => '',
                'city' => '',
                'state' => '',
                'zip_code' => '',
                'phone_h' => '',
                'phone_m' => '',
                'business_name' => ''
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
}



/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */
