<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benchmark extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page']->menu = 'benchmark';
		$this->page_data['module'] = 'benchmark';		
	}

	public function test_customer_subscription(){		
		echo "Test Cron for Auto Generate Invoice for Customer Subscription <hr />";

		$this->load->model('AcsCustomerSubscriptionBilling_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_settings_model');
		$this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('accounting_recurring_transactions_model');

		$error_count   = 0;
		$success_count = 0;

		$current_date = date("Y-m-d");
        $date_from    = date('Y-m-d', strtotime('-14 days', strtotime($current_date))); 
        $date_to      = date("Y-m-d");

		$full_details = $_GET['full_details'];

		$next_billing_date = $_GET['next_billing_date'];
		if(isset($next_billing_date)) {
			$activeSubscriptions = $this->customer_ad_model->getAllActiveSubscriptionsByNextBillingDate($next_billing_date); 
		} else {
			$activeSubscriptions = $this->customer_ad_model->getAllActiveSubscriptionsWithSub14Days($current_date);
		}

        $deduct_days_computation = 0;
		foreach( $activeSubscriptions as $as ) {
            $customer = $this->AcsProfile_model->getByProfId($as->fk_prof_id);    

            if( $as->mmr > 0 && $customer && $as->bill_method != '' ){

                $totalUnpaidSubscriptions   = $this->AcsCustomerSubscriptionBilling_model->getTotalAmountUnpaidByCustomerId($as->fk_prof_id);
				$unpaidSubscriptionsDetails = $this->AcsCustomerSubscriptionBilling_model->getUnpaidDetailsByCustomerId($as->fk_prof_id);

                $total_amount               = $totalUnpaidSubscriptions->total_amount + $as->mmr;
                $invoiceSettings            = $this->Invoice_settings_model->getByCompanyId($customer->company_id);

                $current_date    = date('Y-m-d');
				$late_fee        = 0;
				$payment_fee     = 0;  
				$total_late_days = 0;

                if( $invoiceSettings ){            
                    $next_number = (int) $invoiceSettings->invoice_num_next;     
                    $prefix      = $invoiceSettings->invoice_num_prefix;	
                }else{
                    $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($customer->company_id);
                    $prefix     = 'INV-';
                    if( $lastInsert ){
                        $next_number   = $lastInsert->id + 1;
                    }else{
                        $next_number   = 1;
                    }
                }

                $total_amount = $total_amount + $payment_fee + $late_fee;

				$recurring_date            = $as->next_billing_date;
				$filter['recurring_date']  = $as->next_billing_date;
				$filter['billing_id']      = $as->bill_id;
				$filter['customer_id']     = $customer->prof_id;
				$filter['company_id']      = $customer->company_id;

				$isCustomerSubscriptionBillingDuplicate = 0;

				if(!$isCustomerSubscriptionBillingDuplicate) {
					/**
					 *  Note: no records founds, proceed to add invoice
					 */

					$invoice_number = formatInvoiceNumberV2($prefix, $next_number);

					//Create New Invoice
					$address = $customer->mail_add . ' ' . $customer->city . ', ' . $customer->state . ' ' . $customer->zip_code; 
					$data_invoice = [
						'job_id' => 0,
						'ticket_id' => 0,
						'customer_id' => $customer->prof_id,
						'job_location' => $address,
						'billing_address' => $address,
						'location_scale' => $address,
						'business_name' => '',
						'job_name' => '',
						'job_number' => '',
						'estimate_id' => 0,
						'invoice_type' => 'Total Due',
						'work_order_number' => '',
						'invoice_number' => $invoice_number,
						'date_issued' => date('Y-m-d', strtotime('-13 days', strtotime($as->next_billing_date))),
						'due_date' => $as->next_billing_date,
						'status' => 'Unpaid',
						'customer_email' => $customer->email,
						'total_due' => $total_amount,
						'balance' => $total_amount,
						'date_created' => date("Y-m-d H:i:s"),
						'date_updated' => date("Y-m-d H:i:s"),
						'company_id' => $customer->company_id,
						'is_recurring' => 1,
						'invoice_totals' => $total_amount,
						'user_id' => 0,
						'adjustment_name' => 'Customer Subscription',
						'adjustment_value' => $total_amount,
						'sub_total' => 0,
						'taxes' => 0,
						'grand_total' => $total_amount,
						'view_flag' => 0,
						'no_tax' => 0,
						'late_fee' => $late_fee,
                        'payment_fee' => $payment_fee,
                        'generate_type' => 'Cron Job'
					];		

					if(isset($full_details) && $full_details == 'true') {
						echo '<pre>';
						print_r($data_invoice);
						echo '</pre>';
					}

					echo '<table style="border: 1px solid black; width: 100%;">';
						echo '<tr>';
							echo '<th style="border: 1px solid black;">Subscription Date</th>';
							echo '<th style="border: 1px solid black;">Sub Total</th>';
							echo '<th style="border: 1px solid black;">Subscription</th>';
							echo '<th style="border: 1px solid black;">Payment Fee</th>';
							echo '<th style="border: 1px solid black;">Late Days</th>';
							echo '<th style="border: 1px solid black;">Late Fee</th>';
							echo '<th style="border: 1px solid black;">Subscription (Unpaid)</th>';
							echo '<th style="border: 1px solid black;">Grand Total</th>';
						echo '</tr>';

						echo '<tr>';
						echo '<th style="border: 1px solid black;">' . $next_billing_date . '</th>';
							echo '<th style="border: 1px solid black;">' . $data_invoice['sub_total'] . '</th>';
							echo '<th style="border: 1px solid black;">' . $as->mmr . '</th>';
							echo '<th style="border: 1px solid black;">' . $data_invoice['payment_fee'] . '</th>';
							echo '<th style="border: 1px solid black;">' . $total_late_days . '</th>';
							echo '<th style="border: 1px solid black;">' . $data_invoice['late_fee'] . '</th>';
							echo '<th style="border: 1px solid black;">' . $totalUnpaidSubscriptions->total_amount . '<br />(' . $unpaidSubscriptionsDetails->invoice_number . ')' . '</th>';
							echo '<th style="border: 1px solid black;">' . $data_invoice['grand_total'] . '</th>';
						echo '</tr>';
					echo '</table>';
					echo '<br />';
					echo '<hr />';
					
					/**
					 * Note: after adding subscription billing, update the 'acs_billing' next subscription date
					 */
                    
                    //Adjust bill month base on frequency
                    if($as->frequency == 0) { 
                        //note 1 time payment
                        $current_bill_date = strtotime($as->next_billing_date);
                        $next_month_bill_date = date("Y-m-d", strtotime($as->next_billing_date));	

                    }elseif($as->frequency == 1) {
                        //note every month
                        $current_bill_date = strtotime($as->next_billing_date);
                        $next_month_bill_date = date("Y-m-d", strtotime("+1 month", $current_bill_date));		                

                    }elseif($as->frequency == 3) {
                        //every 3 months
                        $current_bill_date = strtotime($as->next_billing_date);
                        $next_month_bill_date = date("Y-m-d", strtotime("+3 month", $current_bill_date));		

                    }elseif($as->frequency == 6) {
                        //every 6 months
                        $current_bill_date = strtotime($as->next_billing_date);
                        $next_month_bill_date = date("Y-m-d", strtotime("+6 month", $current_bill_date));		

                    }elseif($as->frequency == 12) {
                        //every year
                        $current_bill_date = strtotime($as->next_billing_date);
                        $next_month_bill_date = date("Y-m-d", strtotime("+12 month", $current_bill_date));		
                    } else {
                        //default every month
                        $current_bill_date = strtotime($as->next_billing_date);
                        $next_month_bill_date = date("Y-m-d", strtotime("+1 month", $current_bill_date));	
                    }   
                    
                    $bill_day         = date("d", strtotime($next_month_bill_date));
                    $setting_bill_day = $as->bill_day;
        
                    if($bill_day != $setting_bill_day) {
                        $next_month_bill_date = date("Y-m-" . $setting_bill_day, strtotime($next_month_bill_date));
                    }
                    
					$success_count++;
				} else {
					/**
					 * Note: already exist & will not add invoice
					 */
					$error_count++;
				}
			}
		}		

	}

    public function test_late_invoice_computation() {
        $this->load->model('Invoice_settings_model', 'invoice_settings_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('accounting_recurring_transactions_model');

        /**
         * Update invoice late info - start
         */
        $invoices_data = $this->invoice_model->getAllActiveInvoice([],1);

        $deduct_days_computation = 0;
        $total_records           = 0;
        $total_pause             = 0;
        foreach($invoices_data as $inv_data) {

            $recurr_transaction = $this->accounting_recurring_transactions_model->get_by_type_transaction_id_status('invoice', $inv_data->id, 2); //2 is pause
            if(!$recurr_transaction) {

                $invoiceSettings = $this->invoice_settings_model->getByCompanyId($inv_data->company_id);
                $customer_billing_info = $this->customer_ad_model->getActiveSubscriptionsByCustomerId($inv_data->customer_id);	

                $current_date    		 = date('Y-m-d');
                $new_invoice_grand_total = 0;
                $late_fee        	     = 0;
                $days_activate_late_fee  = 0;
                $invdata         		 = [];

				$with_customer_late_fee    = 0;
                $with_customer_payment_fee = 0;

				if( $customer_billing_info->late_fee > 0 ){
                    $with_customer_late_fee = 1;
                }
    
                if( $customer_billing_info->payment_fee > 0 ){
                    $with_customer_payment_fee = 1;
                }     
                
                $late_fee_activated_date = $inv_data->due_date;
                if(strtotime($current_date) >= strtotime($late_fee_activated_date)) {
                    $date1 = new DateTime($current_date);
                    $date2 = new DateTime($late_fee_activated_date);
                    $total_days = $date2->diff($date1)->format("%a");

                    $days_activate_late_fee = isset($invoiceSettings->num_days_activate_late_fee) ? $invoiceSettings->num_days_activate_late_fee : 0;
                    if($total_days > $days_activate_late_fee) {
                        $late_fee_percentage = $customer_billing_info->payment_fee != null ? $customer_billing_info->payment_fee : 0; 
                    
                        if($customer_billing_info->mmr != null && $customer_billing_info->mmr > 0) {
                            $late_fee += ($late_fee_percentage / 100) * $customer_billing_info->mmr;
                        }

                        if($total_days > 0) {
                            $default_late_fee = $customer_billing_info->late_fee != null ? $customer_billing_info->late_fee : 0;
                            if($total_days >= 10) {
                                $late_fee += $default_late_fee * ($total_days - $deduct_days_computation);                        
                            } else {
                                $late_fee += $default_late_fee * ($total_days - $deduct_days_computation);      
                            }   
                        }                        

                    }
                }       

				if( $invoiceSettings ){   

                    if( $with_customer_late_fee == 0 ){
                        $late_fee = 0;
                        if( $total_days > 0 && $invoiceSettings->late_fee_amount_per_day > 0 && $invoiceSettings->disable_late_fee == 0 ){    
							$default_late_fee = $invoiceSettings->late_fee_amount_per_day != null ? $invoiceSettings->late_fee_amount_per_day : 0;                    
                            $late_fee += $invoiceSettings->late_fee_amount_per_day * ($total_days - $deduct_days_computation);
                        }                                            
                    }

                    if( $with_customer_payment_fee == 0 ) {
                        $payment_fee = 0;
                        if( $invoiceSettings->disable_payment_fee == 0 ){
                            if( $invoiceSettings->payment_fee_percent > 0 ){       
								$late_fee_percentage = $invoiceSettings->payment_fee_percent != null ? $invoiceSettings->payment_fee_percent : 0;                  
                                $payment_fee = ($invoiceSettings->payment_fee_percent/100) * $customer_billing_info->mmr;
                            }else{
                                $payment_fee = $invoiceSettings->payment_fee_amount;
                            }

                            $late_fee += $payment_fee;
                        }                             
                    }
                }

                $new_invoice_grand_total = (int) $customer_billing_info->mmr + $late_fee;	
				
				echo '<table style="border: 1px solid black; width: 100%;">';
				echo '<tr>';
					echo '<th style="border: 1px solid black;">Invoice #</th>';
					echo '<th style="border: 1px solid black;">Due Date</th>';
					echo '<th style="border: 1px solid black;">Current Date</th>';
					echo '<th style="border: 1px solid black;">MMR</th>';
					echo '<th style="border: 1px solid black;">Late Fee Percentage</th>';
					echo '<th style="border: 1px solid black;">Late Amount Per Day</th>';
					echo '<th style="border: 1px solid black;">Total Days Late</th>';
					echo '<th style="border: 1px solid black;">Late Fee</th>';
					echo '<th style="border: 1px solid black;">Grand Total</th>';
				echo '</tr>';

				echo '<tr>';
				echo '<th style="border: 1px solid black;">' . $inv_data->invoice_number . '</th>';
					echo '<th style="border: 1px solid black;">' . $inv_data->due_date . '</th>';
					echo '<th style="border: 1px solid black;">' . $current_date . '</th>';
					echo '<th style="border: 1px solid black;">' . $customer_billing_info->mmr . '</th>';
					echo '<th style="border: 1px solid black;">' . $late_fee_percentage . '%</th>';
					echo '<th style="border: 1px solid black;">' . $default_late_fee . '</th>';
					echo '<th style="border: 1px solid black;">' . $total_days  . '</th>';
					echo '<th style="border: 1px solid black;">' . $late_fee . '</th>';
					echo '<th style="border: 1px solid black;">' . $new_invoice_grand_total . '</th>';
				echo '</tr>';
			echo '</table>';
			echo '<br />';
			echo '<hr />';				

            } else {

            }            

        }     
        /**
         * Update invoice late info - end
         */
    }

    //Note: for manual add of customer invoice
    public function manualAddCustomerInvoice() {
		$this->load->model('AcsCustomerSubscriptionBilling_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_settings_model');
		$this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('accounting_recurring_transactions_model');

        $prof_id = $_GET['prof_id'];

		$error_count   = 0;
		$success_count = 0;

        $current_date = date("Y-m-d");
        $date_from    = date('Y-m-d', strtotime('-14 days', strtotime($current_date))); 
        $date_to      = date("Y-m-d");

        if(isset($prof_id) && $prof_id != '') {
            $activeSubscriptions = $this->customer_ad_model->getActiveSubscriptionsByProfId($prof_id);	   
						
            $deduct_days_computation = 0;
            foreach( $activeSubscriptions as $as ) {
                $customer = $this->AcsProfile_model->getByProfId($as->fk_prof_id);   
				
				$with_customer_late_fee = 0;
				$with_customer_payment_fee = 0;
	
				if( $as->late_fee > 0 ){
					$with_customer_late_fee = 1;
				}
	
				if( $as->payment_fee > 0 ){
					$with_customer_payment_fee = 1;
				}     				
    
                if( $as->mmr > 0 && $customer && $as->bill_method != '' ){
                    $totalUnpaidSubscriptions   = $this->AcsCustomerSubscriptionBilling_model->getTotalAmountUnpaidByCustomerId($as->fk_prof_id);
                    $unpaidSubscriptionsDetails = $this->AcsCustomerSubscriptionBilling_model->getUnpaidDetailsByCustomerId($as->fk_prof_id);
                    $total_amount               = $totalUnpaidSubscriptions->total_amount + $as->mmr;	
                    
                    $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($customer->company_id);
    
                    $current_date    = date('Y-m-d');
                    $late_fee        = 0;
                    $payment_fee     = 0;
    
                    if( $invoiceSettings ){            
                        $next_number = (int) $invoiceSettings->invoice_num_next;     
                        $prefix      = $invoiceSettings->invoice_num_prefix;	
                    }else{
                        $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($customer->company_id);
                        $prefix     = 'INV-';
                        if( $lastInsert ){
                            $next_number   = $lastInsert->id + 1;
                        }else{
                            $next_number   = 1;
                        }
                    }
    
                    $total_amount = $total_amount + $payment_fee + $late_fee;
    
                    $recurring_date            = $as->next_billing_date;
                    $filter['recurring_date']  = $as->next_billing_date;
                    $filter['billing_id']      = $as->bill_id;
                    $filter['customer_id']     = $customer->prof_id;
                    $filter['company_id']      = $customer->company_id;
    
                    $isCustomerSubscriptionBillingDuplicate = $this->AcsCustomerSubscriptionBilling_model->getCustomerSubscriptionBillingByFilter($filter);	
                    if(!$isCustomerSubscriptionBillingDuplicate) {
                        /**
                         *  Note: no records founds, proceed to add invoice
                         */
    
                        $invoice_number = formatInvoiceNumberV2($prefix, $next_number);
    
                        //Create New Invoice
                        $address = $customer->mail_add . ' ' . $customer->city . ', ' . $customer->state . ' ' . $customer->zip_code; 
                        $data_invoice = [
                            'job_id' => 0,
                            'ticket_id' => 0,
                            'customer_id' => $customer->prof_id,
                            'job_location' => $address,
                            'billing_address' => $address,
                            'location_scale' => $address,
                            'business_name' => '',
                            'job_name' => '',
                            'job_number' => '',
                            'estimate_id' => 0,
                            'invoice_type' => 'Total Due',
                            'work_order_number' => '',
                            'invoice_number' => $invoice_number,
                            'date_issued' => date('Y-m-d', strtotime('-13 days', strtotime($as->next_billing_date))),
                            'due_date' => $as->next_billing_date,
                            'status' => 'Unpaid',
                            'customer_email' => $customer->email,
                            'total_due' => $total_amount,
                            'balance' => $total_amount,
                            'date_created' => date("Y-m-d H:i:s"),
                            'date_updated' => date("Y-m-d H:i:s"),
                            'company_id' => $customer->company_id,
                            'is_recurring' => 1,
                            'invoice_totals' => $total_amount,
                            'user_id' => 0,
                            'adjustment_name' => 'Customer Subscription',
                            'adjustment_value' => $total_amount,
                            'sub_total' => 0,
                            'taxes' => 0,
                            'grand_total' => $total_amount,
                            'view_flag' => 0,
                            'no_tax' => 0,
                            'late_fee' => $late_fee,
                            'payment_fee' => $payment_fee,
                            'generate_type' => 'Cron Job'
                        ];		
    
                        $invoice_id = $this->Invoice_model->create($data_invoice);
    
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
                                'company_id' => $customer->company_id,
                                'commercial_message' => 'Thank you for your business.',
                                'commercial_terms_and_conditions' => 'Thank you for your business.',
                                'logo' => '',
                                'payment_fee_percent' => '',
                                'payment_fee_amount' => '',
                                'recurring' => '',
                                'invoice_template' => 1,
                                'residential_message' => 'Thank you for your business.',
                                'residential_terms_and_conditions' => 'Thank you for your business.',
                                'invoice_template' => 0,
                                'late_fee_amount_per_day' => 0,
                                'num_days_activate_late_fee' => 0,
                            ];
                            $this->Invoice_settings_model->create($invoice_settings_data);
                        }		
                        
                        $data_subscription_billing = [
                            'company_id'  	 => $customer->company_id,
                            'customer_id' 	 => $customer->prof_id,
                            'billing_id'  	 => $as->bill_id,
                            'invoice_id'  	 => $invoice_id,
                            'recurring_date' => $recurring_date ? $recurring_date : date("Y-m-d"),
                            'subscription_amount' => $totalUnpaidSubscriptions->total_amount + $as->mmr,
                            'late_fee_amount' => $late_fee,
                            'total_amount' => $total_amount,
                            'status'         => 'Unpaid',
                            'date_created'   => date("Y-m-d H:i:s")
                        ];

                        echo '<pre>';
                        print_r($data_subscription_billing);
                        echo '</pre>';
        
                        $this->AcsCustomerSubscriptionBilling_model->create($data_subscription_billing);	
                        
                        /**
                         * Note: after adding subscription billing, update the 'acs_billing' next subscription date
                         */
                        
                        //Adjust bill month base on frequency
                        if($as->frequency == 0) { 
                            //note 1 time payment
                            $current_bill_date = strtotime($as->next_billing_date);
                            $next_month_bill_date = date("Y-m-d", strtotime($as->next_billing_date));	
    
                        }elseif($as->frequency == 1) {
                            //note every month
                            $current_bill_date = strtotime($as->next_billing_date);
                            $next_month_bill_date = date("Y-m-d", strtotime("+1 month", $current_bill_date));		                
    
                        }elseif($as->frequency == 3) {
                            //every 3 months
                            $current_bill_date = strtotime($as->next_billing_date);
                            $next_month_bill_date = date("Y-m-d", strtotime("+3 month", $current_bill_date));		
    
                        }elseif($as->frequency == 6) {
                            //every 6 months
                            $current_bill_date = strtotime($as->next_billing_date);
                            $next_month_bill_date = date("Y-m-d", strtotime("+6 month", $current_bill_date));		
    
                        }elseif($as->frequency == 12) {
                            //every year
                            $current_bill_date = strtotime($as->next_billing_date);
                            $next_month_bill_date = date("Y-m-d", strtotime("+12 month", $current_bill_date));		
                        } else {
                            //default every month
                            $current_bill_date = strtotime($as->next_billing_date);
                            $next_month_bill_date = date("Y-m-d", strtotime("+1 month", $current_bill_date));	
                        }   
                        
                        $bill_day         = date("d", strtotime($next_month_bill_date));
                        $setting_bill_day = $as->bill_day;
            
                        if($bill_day != $setting_bill_day) {
                            $next_month_bill_date = date("Y-m-" . $setting_bill_day, strtotime($next_month_bill_date));
                        }
                        
                        $data = [
                            'bill_id' => $as->bill_id,
                            'next_billing_date' => $next_month_bill_date,
                        ];
                        $this->customer_ad_model->update_data($data, 'acs_billing', 'bill_id');					
    
                        $success_count++;
                    } else {
                        /**
                         * Note: already exist & will not add invoice
                         */
                        $error_count++;
                    }
                }
            }
    
            echo 'Success count: ' . $success_count . '<br />';
            echo 'Fail count: ' . $error_count . '<br />';            
        }
    }	

	public function fetch_query_test() {
		echo 'QUERY TEST <hr />';

		$this->load->model('AcsCustomerSubscriptionBilling_model');
		$this->load->model('Customer_advance_model', 'customer_ad_model');

		$results = $this->AcsCustomerSubscriptionBilling_model->getPaymentSubscriptionHistory();	 

		echo '<pre>';
		print_r($results);
		echo '</pre>';


	} 

    public function testMailFunctionBackup() {
        echo 'TEST MAIL FUNCTION <hr />';

        $this->load->model('Automation_model', 'automation_model');

        $auto_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_email',
            'operation' => 'send',
            'target' => 'user',
            'status' => 'active',
            'id' => 78945612345
        ];
        $automationData = $this->automation_model->getAutomationByParams($auto_params);     
        if($automationData) {

            $targetName    = "";
            $customerEmail = "";

            $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);

            if($targetUser) {
                $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                $customerEmail = $targetUser->email;
            }

            if($targetName != "" && $customerEmail != "") {

                $mail = email__getInstance();
                $mail->FromName = 'NsmarTrac';
                
                $mail->addAddress($customerEmail, $targetName);
                $mail->isHTML(true);
                $mail->Subject = $automationData->title;
                $mail->Body    = '<p>' . $automationData->email_subject . '</p>';
        
                if (!$mail->Send()) {
                    echo 'Cannot send email <hr />';
                    $automation_success++;
                } else {
                    echo 'Your mail was successfully sent <hr />';
                    $automation_fail++;
                }

            }

        } else {

            echo 'Static Mail Sending Test<hr />';

            $mail = email__getInstance();

            $mail->FromName = 'NsmarTrac';
            $customerName = 'Jeniel Mangahis';
            $mail->addAddress('bryannrevina@nsmartrac.com', $customerName);
            $mail->isHTML(true);
            $mail->Subject = "nSmartrac: New Recurring Invoice Generated";
            $mail->Body = '<p>Please do note that this is only a test</p>';
    
            if (!$mail->Send()) {
                echo 'email sending failed <br />';
            } else {
                echo 'sending email successfull <br />';
            }            

        }

    }
   
    public function testMailFunction() {
        echo 'TEST MAIL FUNCTION <hr />';

        $this->load->model('Automation_model', 'automation_model');

        $auto_params = [
            'entity' => 'invoice',
            'trigger_action' => 'send_email',
            'operation' => 'send',
            'target' => 'user',
            'status' => 'active'
        ];

        $automationData = $this->automation_model->getAutomationByParams($auto_params);     
        if($automationData) {

            $targetName    = "";
            $customerEmail = "";

            $targetUser = $this->users_model->getCompanyUserById($automationData->target_id);

            if($targetUser) {
                $targetName    = $targetUser->FName . ' ' . $targetUser->LName;
                $customerEmail = $targetUser->email;
            }

            if($targetName != "" && $customerEmail != "") {
            
                $host     = 'smtp.mailtrap.io';
                $port     = 2525;
                $username = 'd7c92e3b5e901d';
                $password = '203aafda110ab7';
                $from     = 'noreply@nsmartrac.com';
                $subject  = 'nSmarTrac Test';
            
                include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = $host;
                $mail->SMTPAuth = true;
                $mail->Username = $username;
                $mail->Password = $password;
                $mail->SMTPSecure = 'tls';
                $mail->Port = $port;

                // Sender and recipient settings
                $mail->setFrom('from@example.com', 'From Name');
                $mail->addAddress('recipient@example.com', 'Recipient Name');

                
                $mail->IsHTML(true);
                
                $mail->Subject = $subject;
                $mail->Body    = '<p>This is the plain text message body</p>';

                // Send the email
                if(!$mail->send()){
                    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }               

            }

        }

    }    

    public function generateMailHTML()
    { 
        return $this->load->view('benchmark/mail-html-template', $this->page_data, true);        
    }

}
?>
