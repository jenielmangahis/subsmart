<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benchmark extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page']->menu = 'benchmark';
		$this->page_data['module'] = 'benchmark';		
	}

	public function cron_customer_subscription(){		
		echo "Test Cron for Auto Generate Invoice for Customer Subscription <hr />";

		$this->load->model('AcsCustomerSubscriptionBilling_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_settings_model');
		$this->load->model('Customer_advance_model', 'customer_ad_model');

		$error_count   = 0;
		$success_count = 0;

        $activeSubscriptions = $this->customer_ad_model->get_all_active_subscriptions();	

		foreach( $activeSubscriptions as $as ) {
            $customer = $this->AcsProfile_model->getByProfId($as->fk_prof_id);            

            if( $as->mmr > 0 && $customer ){
                $totalUnpaidSubscriptions   = $this->AcsCustomerSubscriptionBilling_model->getTotalAmountUnpaidByCustomerId($as->fk_prof_id);
				$unpaidSubscriptionsDetails = $this->AcsCustomerSubscriptionBilling_model->getUnpaidDetailsByCustomerId($as->fk_prof_id);
                $total_amount               = $totalUnpaidSubscriptions->total_amount + $as->mmr;	
                
                $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($customer->company_id);
				$late_fee        = 0;
				$payment_fee     = 0;

				$current_date = date('Y-m-d');
                if( $invoiceSettings ){            
                    $next_number = (int) $invoiceSettings->invoice_num_next;     
                    $prefix      = $invoiceSettings->invoice_num_prefix;
                    
                    if( $invoiceSettings->payment_fee_percent > 0  ){                        
                        $payment_fee = $total_amount * ($invoiceSettings->payment_fee_percent/100);
                    }else{
                        $payment_fee = $invoiceSettings->payment_fee_amount;
                    }

					if($invoiceSettings->num_days_activate_late_fee > 0) {
						$late_fee_activated_date = date('Y-m-d', strtotime($unpaidSubscriptionsDetails->due_date . ' + ' . $invoiceSettings->num_days_activate_late_fee . ' days'));
					} else {
						$late_fee_activated_date = $unpaidSubscriptionsDetails->due_date;
					}				
					
					//Invoice is due, need to add late fee
					if(strtotime($current_date) >= strtotime($late_fee_activated_date)) {
						$date1 = new DateTime($current_date);
						$date2 = new DateTime($late_fee_activated_date);
						$total_days = $date2->diff($date1)->format("%a");

						if($total_days > 0) {
							$late_fee = $invoiceSettings->late_fee_amount_per_day * $total_days;
						} else {
							$late_fee = $invoiceSettings->late_fee_amount_per_day;
						}
					}elseif(strtotime($current_date) == strtotime($late_fee_activated_date)) {
						$late_fee = $invoiceSettings->late_fee_amount_per_day;
					}
                }else{
                    $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($customer->company_id);
                    $prefix     = 'INV-';
                    if( $lastInsert ){
                        $next_number   = $lastInsert->id + 1;
                    }else{
                        $next_number   = 1;
                    }

                    $payment_fee = 0;
					$late_fee    = 0;
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
						'date_issued' => $as->next_billing_date,
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
						'sub_total' => $total_amount,
						'taxes' => 0,
						'grand_total' => $total_amount,
						'view_flag' => 0,
						'no_tax' => 0,
						'late_fee' => $late_fee,
                        'payment_fee' => $payment_fee
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
							'company_id' => $company_id,
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
						'amount'         => $total_amount,
						'date_created'   => date("Y-m-d H:i:s")
					];
	
					$this->AcsCustomerSubscriptionBilling_model->create($data_subscription_billing);	
					
					/**
					 * Note: after adding subscription billing, update the 'acs_billing' next subscription date
					 */
					$current_bill_date = strtotime($as->next_billing_date);
					$next_month_bill_date = date("Y-m-d", strtotime("+1 month", $current_bill_date));			
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
