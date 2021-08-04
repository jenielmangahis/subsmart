<?php

defined('BASEPATH') or exit('No direct script access allowed');

// add services
include_once 'application/services/JobType.php';
include_once 'application/services/Priority.php';

class Share_Link extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();

        // $this->checkLogin();

        $this->page_data['page']->title = 'Workorder Management';

        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'workorder';
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('Users_model', 'users_model');
        
        $user_id = getLoggedUserID();

        // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/frontend/css/workorder/main.css',
            "assets/css/accounting/sidebar.css",
            'assets/css/accounting/sales.css'
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/frontend/js/workorder/main.js'
        ));
    }

    public function preview($id)
    {
        // $filename = "nSmarTrac_work_order";
        // $data = "test";
        $data = $this->workorder_model->getById($id);
        $acs = $this->workorder_model->get_customerData_data($data->customer_id);
        $company = $this->workorder_model->getcompany_data($acs->company_id);
        $items = $this->workorder_model->getworkorderItems($data->id);
        $payment = $this->workorder_model->getpayment($data->id);
        $lead = $this->workorder_model->getleadSource($data->lead_source_id);
        
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/work_order_pdf_template', $data, $filename, "portrait");
        $this->load->library('pdf');
        // $this->pdf->load_html_file($data->company_representative_signature);
        $html = $data;
        $html .= '<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">';
        $html .= '<div style="font-family: Gill Sans, sans-serif; font-size: 11px;">';
        $html .= "<p>".$data->header."</p>";
        $html .= '<div style="float:right;"><b>WORK ORDER</b> <br>#'.$data->work_order_number.'<br>
                                Job Tags: '.$data->tags.' <br>
                                Date Issued: '.$data->date_issued.' <br>
                                Priority: '.$data->priority.' <br>
                                Password: '.$data->password.' <br>
                                Security Number: '.$data->security_number.' <br>
                                Source: '.$lead->ls_name.' <br></div>
                                Agent: '.$acs->first_name.' '.$acs->last_name.' <br>';

        $html .= '<div style="margin-top:12%;"><b>FROM:</b><hr> <br>'.$company->first_name.' '.$company->last_name.'<br>Address: '.$company->business_address.'<br> Phone: '.$company->phone_number.'</div><br><br>';
        $html .= '<div><b>TO:</b><hr> <br>'.$acs->first_name.' '.$acs->last_name.'<br>'.$acs->business_name.'<br>Address: '.$acs->mail_add.' '.$acs->city.' '.$acs->state.' '.$acs->country.' '.$acs->zip_code.' '.$acs->cross_street.' '.'<br>Email: '.$acs->email.'<br>Phone:'.$acs->phone_h.'<br> Mobile: '.$acs->phone_m.'</div><br><br>';

        $html .= '<div><b>ADDITIONAL:</b><hr> <br>'.$data->instructions.'</div><br><br>';
        $html .= '<div><b>TERMS & CONDITIONS:</b><hr> <br>'.$data->terms_and_conditions.'</div><br><br>';

        $html .= '<div><b>JOB DETAILS:</b><hr> <br>
                    <table class="pure-table" style="border-collapse: collapse !important;">
                        <tr style="background-color: #E9DDFF !important;">
                            <th>Items</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                        </tr>';

                    foreach($items as $item){
         $html .=
                        '<tr>
                            <td data-column="">'.$item->title.'</td>
                            <td data-column="">'.$item->qty.'</td>
                            <td data-column="">'.$item->costing.'</td>
                            <td data-column="">0</td>
                            <td data-column="">'.$item->tax.'</td>
                            <td data-column="">'.$item->total.'</td>
                        </tr>';
                     } 
        $html .='

                        <tr style="background-color: #F7F4FF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Subtotal</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->subtotal.'</td>
                        </tr>
                        
                        <tr style="background-color: #E9DDFF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Taxes</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->taxes.'</td>
                        </tr>';

                        if(empty($data->adjustment_value)){  } else{ 

        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><?php echo $adjustment_name; ?></td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->adjustment_value.'</td>
                        </tr>';

                        }if(empty($data->voucher_value)){  } else{
        $html .='        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Voucher</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->voucher_value.'</td>
                        </tr>';

                        }if(empty($data->otp_setup)){ } else{
        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">One Time Program and Setup</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->otp_setup.'</td>
                        </tr>';

                        }if(empty($data->monthly_monitoring)){ } else{ 
        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Monthly Monitoring</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->monthly_monitoring.'</td>
                        </tr>';
                        }

        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><b>Grand Total</b></td>
                            <td style="background-color: #F8F8F8 !important;"><b>'.$data->grand_total.'</b></td>
                        </tr>
        </table>
        </div><br><br>';

        $html .= '<div><b>TERMS OF USE:</b><hr> <br>'.$data->terms_of_use.'</div><br><br>';
        $html .= '<div><b>JOB DESCRIPTION:</b><hr> <br>'.$data->job_description.'</div><br><br>';
        $html .= '<div><b>INSTRUCTIONS:</b><hr> <br>'.$data->instructions.'</div><br><br>';

        $html .= '<div><b>ACCEPTED PAYMENT METHODS:</b><hr>
                <ul>
                    <li>Cash</li>
                    <li>Check</li>
                    <li>Credit Card</li>
                    <li>Debit Card</li>
                    <li>ACH</li>
                    <li>Venmo</li>
                    <li>Paypal</li>
                    <li>Square</li>
                    <li>Invoicing</li>
                    <li>Warranty Work</li>
                    <li>Home Owner Financing</li>
                    <li>Home Owner Financing</li>
                    <li>e-Transfer</li>
                    <li>Other Credit Card Professor</li>
                    <li>Other Payment Type</li>
                </ul> </div>
                ';
            
        $html .= '<div><b>PAYMENT DETAILS:</b><hr> <br>Amount: '.$data->payment_amount.'<br>Payment Method: '.$data->payment_method.'</div><br><br>';
                    
                    if($data->payment_method ==  'Check')
                    {
        $html .=    'Check Number: '. $payment->check_number.
                    '<br>Rounting Number: '. $payment->routing_number.
                    '<br>Account Number: '. $payment->account_number.'';
                    }
                    elseif($data->payment_method ==  'Credit Card')
                    {
        $html .=    'Credit Number: '. $payment->credit_number.
                    '<br>Credit Expiry: '. $payment->credit_expiry.
                    '<br>CVC: '. $payment->credit_cvc.'';
                    }
                    elseif($data->payment_method ==  'Debit Card')
                    {
        $html .=    'Credit Number: '. $payment->credit_number.
                    '<br> Credit Expiry: '. $payment->credit_expiry.
                    '<br> CVC: '. $payment->credit_cvc.'';
                    }
                    elseif($data->payment_method ==  'ACH')
                    {
        $html .=    'Routing Number: '. $routing_number.
                    '<br> Account Number: '. $account_number.'';
                    }
                    elseif($data->payment_method ==  'Venmo')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.
                    '<br> Confirmation: '. $confirmation.'';
                    }
                    elseif($data->payment_method ==  'Paypal')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.
                    '<br> Confirmation: '. $confirmation.'';
                    }
                    elseif($data->payment_method ==  'Square')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.
                    '<br> Confirmation: '. $confirmation.'';
                    }
                    elseif($data->payment_method ==  'Invoicing')
                    {
        $html .=    'Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street.'';
                    }
                    elseif($data->payment_method ==  'Warranty Work')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
                    elseif($data->payment_method ==  'Home Owner Financing')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
                    elseif($data->payment_method ==  'e-Transfer')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
                    elseif($data->payment_method ==  'Other Credit Card Professor')
                    {
        $html .=    'Credit Number: '. $credit_number.
                    '<br> Credit Expiry: '. $credit_expiry.
                    '<br> CVC: '. $credit_cvc.'';
                    }
                    elseif($data->payment_method ==  'Other Payment Type')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
        $html .= '';

        $html .= '<div><b>ASSIGNED TO:</b><hr> <br>'.$data->instructions.'</div><br><br>';
        
        $html .= '<table>
                    <tr>
                        <td align="center">';
                            if(empty($data->company_representative_signature)){ } else{ 
        $html .=            '<img src="'.base_url($data->company_representative_signature).'" style="width:30%;height:80px;"><br>
                            '.$data->company_representative_name.'';
                            }
        $html .=    '</td>
                        <td align="center">';
                            if(empty($data->primary_account_holder_signature)){ } else{ 
        $html .=             '<img src="'.base_url($data->primary_account_holder_signature).'" style="width:30%;height:80px;"><br>
                            '.$data->primary_account_holder_name.'';
                             }
        $html .=        '</td>
                        <td align="center">';
                            if(empty($data->secondary_account_holder_signature)){ } else{ 
        $html .=        '<img src="'.base_url($data->secondary_account_holder_signature).'" style="width:30%;height:80px;"><br>
                            '.$data->secondary_account_holder_name.'';
                            }
        $html .=        '</td>
                    </tr>
                </table>';

        $html .= '</div>';

        $this->pdf->createPDF($html, 'mypdf', false);
        exit(0);
    }

    public function public_view($id)
    {

        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $work =  $this->workorder_model->getById($id);
        
        $this->page_data['company'] = $this->workorder_model->getCompanyCompanyId($work->company_id);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['items'] = $this->workorder_model->getItems($id);

        $this->page_data['itemsA'] = $this->workorder_model->getItemsAlarm($id);
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        $this->page_data['workorder_items'] = $this->workorder_model->getworkorderItems($id);

        $this->page_data['first'] = $this->workorder_model->getuserfirst($work->company_representative_name);
        $this->page_data['second'] = $this->workorder_model->getusersecond($work->primary_account_holder_name);
        $this->page_data['third'] = $this->workorder_model->getuserthird($work->secondary_account_holder_name);
        
        $this->page_data['lead'] = $this->workorder_model->getleadSource($work->lead_source_id);

        // $this->page_data['Workorder']->role = $this->roles_model->getByWhere(['id' => $this->page_data['Workorder']->role])[0];

        // $this->page_data['Workorder']->activity = $this->activity_model->getByWhere(['user' => $id], ['order' => ['id', 'desc']]);

        // print_r($this->page_data['items']);
        add_footer_js('assets/js/esign/docusign/workorder.js');
        $this->load->view('workorder/public_view', $this->page_data);
    }

    
    public function work_order_pdf($wo_id)
    {
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workData = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workData->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorder = $workData->work_order_number;
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrder($wo_id);
        $items = $this->workorder_model->getworkorderItems($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;
        $company_id = $workData->company_id;

        $first = $this->workorder_model->getuserfirst($workData->company_representative_name);
        $second = $this->workorder_model->getusersecond($workData->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workData->secondary_account_holder_name);

        $data = array(
            'workorder'                         => $workorder,
            'tags'                              => $workData->tags,
            'job_type'                          => $workData->job_type,
            'priority'                          => $workData->priority,
            'header'                            => $workData->header,
            'password'                          => $workData->password,
            'security_number'                   => $workData->security_number,
            'source_name'                       => $workData->lead_source_id,
            'company_representative_signature'  => $workData->company_representative_signature,
            'company_representative_name'       => $workData->company_representative_name,
            'primary_account_holder_signature'  => $workData->primary_account_holder_signature,
            'primary_account_holder_name'       => $workData->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,

            'company'                           => $cliets->business_name,
            'business_address'                  => $cliets->business_address,
            'phone_number'                      => $cliets->phone_number,
            'acs_name'                          => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'job_location'                      => $workData->job_location,
            'job_location2'                     => $workData->city.', '.$workData->state.', '.$workData->zip_code.', '.$workData->cross_street,
            'email'                             => $workData->email,
            'phone'                             => $workData->phone_number,
            'mobile'                            => $workData->mobile_number,
            'terms_and_conditions'              => $workData->terms_and_conditions,
            'terms_of_use'                      => $workData->terms_of_use,
            'job_description'                   => $workData->job_description,
            'instructions'                      => $workData->instructions,
            'first_verification_name'           => $customerData->first_verification_name,
            'first_number'                      => $customerData->first_number,
            'first_relation'                    => $customerData->first_relation,
            'second_verification_name'          => $customerData->second_verification_name,
            'second_number'                     => $customerData->second_number,
            'second_relation'                   => $customerData->second_relation,
            'third_verification_name'           => $customerData->third_verification_name,
            'third_number'                      => $customerData->third_number,
            'third_relation'                    => $customerData->third_relation,
            'date_issued'                       => $workData->date_issued,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,
            'business_name'                     => $customerData->business_name,

            'customs'                           => $customs,
            'items'                             => $items,

            'total'                             => $workData->grand_total,
            'subtotal'                          => $workData->subtotal,
            'taxes'                             => $workData->taxes,
            'adjustment_name'                   => $workData->adjustment_name,
            'adjustment_value'                  => $workData->adjustment_value,
            'voucher_value'                     => $workData->voucher_value,
            'otp_setup'                         => $workData->otp_setup,
            'monthly_monitoring'                => $workData->monthly_monitoring,

            'payment_method'                    => $payment->payment_method,
            'amount'                            => $payment->amount, //
            'check_number'                      => $payment->check_number,
            'routing_number'                    => $payment->routing_number,
            'account_number'                    => $payment->account_number,
            'credit_number'                     => $payment->credit_number,
            'credit_expiry'                     => $payment->credit_expiry,
            'credit_cvc'                        => $payment->credit_cvc,
            'account_credentials'               => $payment->account_credentials,
            'account_note'                      => $payment->account_note,
            'confirmation'                      => $payment->confirmation,
            'mail_address'                      => $payment->mail_address,
            'mail_locality'                     => $payment->mail_locality,
            'mail_state'                        => $payment->mail_state,
            'mail_postcode'                     => $payment->mail_postcode,
            'mail_cross_street'                 => $payment->mail_cross_street,
            'billing_date'                      => $payment->billing_date,
            'billing_frequency'                 => $payment->billing_frequency,

            'template'                          => '1',
            'business'                          => $business,

            'business_logo'                     => $business_logo,

            'first'                             => $first,
            'second'                            => $second,
            'third'                             => $third,
            'company_id'                        => $company_id,
            
            // 'source' => $source
        );


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_standard";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template', $data, $filename, "portrait");
        // $this->pdf->render();


        // $this->pdf->stream($filename);
    }

    public function work_order_pdf_alarm($wo_id)
    {
        
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workData = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workData->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorder = $workData->work_order_number;
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrderAlarm($wo_id);
        $items = $this->workorder_model->getworkorderItems($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;

        $company_id = $workData->company_id;

        $first = $this->workorder_model->getuserfirst($workData->company_representative_name);
        $second = $this->workorder_model->getusersecond($workData->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workData->secondary_account_holder_name);

        $data = array(
            'workorder'                         => $workorder,
            'tags'                              => $workData->tags,
            'job_type'                          => $workData->job_type,
            'priority'                          => $workData->priority,
            'header'                            => $workData->header,
            'password'                          => $workData->password,
            'security_number'                   => $workData->security_number,
            'source_name'                       => $workData->lead_source_id,
            'company_representative_signature'  => $workData->company_representative_signature,
            'company_representative_name'       => $workData->company_representative_name,
            'primary_account_holder_signature'  => $workData->primary_account_holder_signature,
            'primary_account_holder_name'       => $workData->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,

            'company'                           => $cliets->business_name,
            'business_address'                  => $cliets->business_address,
            'phone_number'                      => $cliets->phone_number,
            'acs_name'                          => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'job_location'                      => $workData->job_location,
            'job_location2'                     => $workData->city.', '.$workData->state.', '.$workData->zip_code.', '.$workData->cross_street,
            'email'                             => $workData->email,
            'phone'                             => $workData->phone_number,
            'mobile'                            => $workData->mobile_number,
            'terms_and_conditions'              => $workData->terms_and_conditions,
            'terms_of_use'                      => $workData->terms_of_use,
            'job_description'                   => $workData->job_description,
            'instructions'                      => $workData->instructions,
            'first_verification_name'           => $customerData->first_verification_name,
            'first_number'                      => $customerData->first_number,
            'first_relation'                    => $customerData->first_relation,
            'second_verification_name'          => $customerData->second_verification_name,
            'second_number'                     => $customerData->second_number,
            'second_relation'                   => $customerData->second_relation,
            'third_verification_name'           => $customerData->third_verification_name,
            'third_number'                      => $customerData->third_number,
            'third_relation'                    => $customerData->third_relation,
            'date_issued'                       => $workData->date_issued,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,
            'business_name'                     => $customerData->business_name,

            'customs'                           => $customs,
            'items'                             => $items,

            'total'                             => $workData->grand_total,
            'subtotal'                          => $workData->subtotal,
            'taxes'                             => $workData->taxes,
            'adjustment_name'                   => $workData->adjustment_name,
            'adjustment_value'                  => $workData->adjustment_value,
            'voucher_value'                     => $workData->voucher_value,
            'otp_setup'                         => $workData->otp_setup,
            'monthly_monitoring'                => $workData->monthly_monitoring,
            // 'source' => $source

            'payment_method'                    => $payment->payment_method,
            'amount'                            => $payment->amount, //
            'check_number'                      => $payment->check_number,
            'routing_number'                    => $payment->routing_number,
            'account_number'                    => $payment->account_number,
            'credit_number'                     => $payment->credit_number,
            'credit_expiry'                     => $payment->credit_expiry,
            'credit_cvc'                        => $payment->credit_cvc,
            'account_credentials'               => $payment->account_credentials,
            'account_note'                      => $payment->account_note,
            'confirmation'                      => $payment->confirmation,
            'mail_address'                      => $payment->mail_address,
            'mail_locality'                     => $payment->mail_locality,
            'mail_state'                        => $payment->mail_state,
            'mail_postcode'                     => $payment->mail_postcode,
            'mail_cross_street'                 => $payment->mail_cross_street,
            'billing_date'                      => $payment->billing_date,
            'billing_frequency'                 => $payment->billing_frequency,

            'template'                          => '2',
            'business_logo'                     => $business_logo,

            'first'                             => $first,
            'second'                            => $second,
            'third'                             => $third,

            'company_id'                        => $company_id,
        );


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_alarm";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template', $data, $filename, "portrait");
        // $this->pdf->render();


        // $this->pdf->stream("welcome.pdf");
    }
}



/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */
