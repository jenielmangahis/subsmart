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

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        // dd($this->input->post());
        $new_data = array(
            'customer_id'               => $this->input->post('customer_id'),
            'service_location'          => $this->input->post('service_location'),
            'service_description'       => $this->input->post('service_description'),
            'job_tag'                   => $this->input->post('job_tag'),
            'ticket_no'                 => $this->input->post('ticket_no'),
            'ticket_date'               => $this->input->post('ticket_date'),
            'scheduled_time'            => $this->input->post('scheduled_time'),
            'purchase_order_no'         => $this->input->post('purchase_order_no'),
            'ticket_status'             => $this->input->post('ticket_status'),
            'panel_type'                => $this->input->post('panel_type'),
            'service_type'              => $this->input->post('service_type'),
            'warranty_type'             => $this->input->post('warranty_type'),
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
            'instructions'              => $this->input->post('instructions'),
            'created_by'                => logged('id'),
            'company_id'                => $company_id,
            'created_at'                => date("Y-m-d H:i:s"),
            'updated_at'                => date("Y-m-d H:i:s")
        );

        $addQuery = $this->tickets_model->save_tickets($new_data);

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

        $this->page_data['ticketsCompany'] = $this->tickets_model->get_tickets_company($tickets->company_id);
        $this->page_data['tickets'] = $this->tickets_model->get_tickets_data_one($id);
        $this->page_data['items'] = $this->tickets_model->get_ticket_items($id);
        $this->page_data['payment'] = $this->tickets_model->get_ticket_payments($id);
        
        $this->load->view('tickets/view', $this->page_data);
    }

}



/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */

