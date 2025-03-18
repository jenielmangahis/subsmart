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
				
                $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($customer->company_id);

                $current_date    = date('Y-m-d');
				$late_fee        = 0;
				$payment_fee     = 0;  
				$total_late_days = 0;

                if($unpaidSubscriptionsDetails) {
                    //Invoice is due, need to add late fee
                    $recurr_transaction = $this->accounting_recurring_transactions_model->get_by_type_transaction_id_status('invoice', $unpaidSubscriptionsDetails->invoice_id, 2); //2 is pause
                    if(!$recurr_transaction) { //check first if transaction is not pause the late fee
                        $late_fee_activated_date = $unpaidSubscriptionsDetails->due_date;
                        if(strtotime($current_date) >= strtotime($late_fee_activated_date)) {
                            $date1 = new DateTime($current_date);
                            $date2 = new DateTime($late_fee_activated_date);
                            $total_days = $date2->diff($date1)->format("%a");
							$total_late_days = $total_days;
    
                            $days_activate_late_fee = isset($invoiceSettings->num_days_activate_late_fee) ? $invoiceSettings->num_days_activate_late_fee : 0;
    
                            if($total_days > $days_activate_late_fee) {
                                $late_fee_percentage = $as->payment_fee != null ? $as->payment_fee : 0; 
    
                                if($as->mmr != null && $as->mmr > 0) {
                                    $late_fee += ($late_fee_percentage / 100) * $as->mmr;
                                }
        
                                if($total_days > 0) {
                                    $default_late_fee = $as->late_fee != null ? $as->late_fee : 0;
                                    if($total_days >= 10) {
                                        $late_fee += $default_late_fee * ($total_days - $deduct_days_computation);                        
                                    } else {
                                        $late_fee += $default_late_fee * ($total_days - $deduct_days_computation);
                                    }   
                                }
                            }
                        }
                    }
                }

                if( $invoiceSettings ){            
                    $next_number = (int) $invoiceSettings->invoice_num_next;     
                    $prefix      = $invoiceSettings->invoice_num_prefix;	
                    
                    if( $invoiceSettings->payment_fee_percent > 0  ){                        
                        $payment_fee = $total_amount * ($invoiceSettings->payment_fee_percent/100);
                    }else{
                        $payment_fee = $invoiceSettings->payment_fee_amount;
                    }

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
        $invoices_data = $this->invoice_model->getAllActiveInvoice();

        $deduct_days_computation = 0;
        $total_records           = 0;
        $total_pause             = 0;
        foreach($invoices_data as $inv_data) {

            $recurr_transaction = $this->accounting_recurring_transactions_model->get_by_type_transaction_id_status('invoice', $inv_data->id, 2); //2 is pause
            if(!$recurr_transaction) {

                $invoiceSettings = $this->invoice_settings_model->getByCompanyId($inv_data->company_id);

                $current_date    = date('Y-m-d');
                $new_invoice_grand_total = 0;
                $late_fee        = 0;
                $days_activate_late_fee = 0;
                $invdata         = [];

                $customer_billing_info = $this->customer_ad_model->getActiveSubscriptionsByCustomerId($inv_data->customer_id);	
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
					echo '<th style="border: 1px solid black;">' . $late_fee_percentage . '</th>';
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

	public function fetch_query_test() {
		echo 'QUERY TEST <hr />';

		$this->load->model('AcsCustomerSubscriptionBilling_model');
		$this->load->model('Customer_advance_model', 'customer_ad_model');

		$results = $this->AcsCustomerSubscriptionBilling_model->getPaymentSubscriptionHistory();	 

		echo '<pre>';
		print_r($results);
		echo '</pre>';


	}

}
?>
