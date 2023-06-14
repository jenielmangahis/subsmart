<?php

defined('BASEPATH') or exit('No direct script access allowed');

// add services
include_once 'application/services/JobType.php';
include_once 'application/services/Priority.php';
include_once 'application/services/InvoiceCustomer.php';

class Share_Link extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        // $this->checkLogin();

        // $this->page_data['page']->title = 'Workorder Management';

        // $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'workorder';
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('Users_model', 'users_model');
        $this->load->model('General_model', 'general');
        $this->load->model('Tickets_model', 'tickets_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        
        
        $user_id = getLoggedUserID();
        $this->load->helper('functions');
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

    public function public_view_agreement($id)
    {
        $company_id = logged('company_id');

        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $work =  $this->workorder_model->getById($id);
        
        $this->page_data['company'] = $this->workorder_model->getCompanyCompanyId($work->company_id);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['items'] = $this->workorder_model->getItems($id);

        $this->page_data['itemsA'] = $this->workorder_model->getItemsAlarm($id);
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        
        $WOitems = $this->workorder_model->getworkorderItems($id);
        $this->page_data['workorder_items'] = $WOitems;

        $this->page_data['first'] = $this->workorder_model->getuserfirst($work->company_representative_name);
        $this->page_data['second'] = $this->workorder_model->getusersecond($work->primary_account_holder_name);
        $this->page_data['third'] = $this->workorder_model->getuserthird($work->secondary_account_holder_name);

        $this->page_data['lead'] = $this->workorder_model->getleadSource($work->lead_source_id);
        $this->page_data['contacts'] = $this->workorder_model->get_contacts($work->customer_id);
        $this->page_data['solars'] = $this->workorder_model->get_solar($id);
        $this->page_data['solar_files'] = $this->workorder_model->get_solar_files($id);
        
        $this->page_data['agreements'] = $this->workorder_model->get_agreements($id);
        $this->page_data['agree_items'] = $this->workorder_model->get_agree_items($id);

        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);

        $spt_query = array(
            'table' => 'ac_system_package_type',
            'order' => array(
                'order_by' => 'id',
            ),
            'where' => array(
                'company_id' => $company_id,
            ),
            'select' => '*',
        );

        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);

        // $this->page_data['Workorder']->role = $this->roles_model->getByWhere(['id' => $this->page_data['Workorder']->role])[0];

        // $this->page_data['Workorder']->activity = $this->activity_model->getByWhere(['user' => $id], ['order' => ['id', 'desc']]);

        // print_r($this->page_data['items']);
        add_footer_js('assets/js/esign/docusign/workorder.js');
        $this->load->view('workorder/public_view_agreement', $this->page_data);
    }

    
    public function work_order_pdf_($wo_id)
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

    public function work_order_pdf_alarm_($wo_id)
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

    public function sendLinkToEmail()
    {
        $test = $this->input->post('emails_list');
    //    var_dump('test'.$test);

        $arr = explode(',',$test);

        $message = $this->input->post('email_content'); 

        foreach($arr as $recipient)
        {
            //echo $recipient."<br>";

            include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $subject   = 'nSmarTrac: Shared Link';
            $mail = new PHPMailer;
            //$mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout    =   10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';

            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            // $email->attach("/home/yoursite/location-of-file.jpg", "inline");
            $mail->Subject = $subject;
            $mail->Body    = $message;
            // $cid = $email->attachment_cid($filename);


            $json_data['is_success'] = 1;
            $json_data['error']      = '';

            if(!$mail->Send()) {
                /*echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;*/
                $json_data['is_success'] = 0;
                $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
            }

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

            echo json_encode($json_data);
        }
        

    }

    
    public function public_view_solar($id)
    {
        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $work =  $this->workorder_model->getById($id);
        
        $this->page_data['company'] = $this->workorder_model->getCompanyCompanyId($work->company_id);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['items'] = $this->workorder_model->getItems($id);

        $this->page_data['itemsA'] = $this->workorder_model->getItemsAlarm($id);
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        
        $WOitems = $this->workorder_model->getworkorderItems($id);
        $this->page_data['workorder_items'] = $WOitems;

        $this->page_data['first'] = $this->workorder_model->getuserfirst($work->company_representative_name);
        $this->page_data['second'] = $this->workorder_model->getusersecond($work->primary_account_holder_name);
        $this->page_data['third'] = $this->workorder_model->getuserthird($work->secondary_account_holder_name);

        $this->page_data['lead'] = $this->workorder_model->getleadSource($work->lead_source_id);
        $this->page_data['contacts'] = $this->workorder_model->get_contacts($work->customer_id);
        $this->page_data['solars'] = $this->workorder_model->get_solar($id);
        $this->page_data['solar_files'] = $this->workorder_model->get_solar_files($id);
        
        $this->page_data['agreements'] = $this->workorder_model->get_agreements($id);
        $this->page_data['agree_items'] = $this->workorder_model->get_agree_items($id);

        // add_footer_js('assets/js/esign/docusign/workorder.js');
        $this->load->view('workorder/public_view_solar', $this->page_data);
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

        $lead = $this->workorder_model->getleadSource($workData->lead_source_id);

        $data = array(
            'workorder'                         => $workorder,
            'tags'                              => $workData->tags,
            'job_type'                          => $workData->job_type,
            'priority'                          => $workData->priority,
            'password'                          => $workData->password,
            'security_number'                   => $workData->security_number,
            'source_name'                       => $lead->ls_name,
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

            'header'                            => $workData->header,
            
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

    public function work_order_pdf_agreement($wo_id)
    {
        
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workorder = $this->workorder_model->get_workorder_data($wo_id);
        $job_tags = $this->workorder_model->get_job_tags_data($workorder->job_tags);
        // var_dump($workData);

        $source_id = $workorder->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorderNo = $workorder->work_order_number;
        $c_id = $workorder->company_id;
        $p_id = $workorder->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrderAlarm($wo_id);
        $items = $this->workorder_model->get_agree_items($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;
        $agreements = $this->workorder_model->get_agreements($wo_id);

        $company_id = $workorder->company_id;

        $first = $this->workorder_model->getuserfirst($workorder->company_representative_name);
        $second = $this->workorder_model->getusersecond($workorder->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workorder->secondary_account_holder_name);

        $firstNumeric = $this->workorder_model->firstNumeric($workorder->company_representative_name);

        // dd($wo_id);

        $data = array(
            'workorder'                         => $workorderNo,
            'company_representative_signature'  => $workorder->company_representative_signature,
            'company_representative_name'       => $workorder->company_representative_name,
            'primary_account_holder_signature'  => $workorder->primary_account_holder_signature,
            'primary_account_holder_name'       => $workorder->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workorder->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workorder->secondary_account_holder_name,

            'items'                             => $items,

            'total'                             => $workorder->grand_total,
            'subtotal'                          => $workorder->subtotal,
            'taxes'                             => $workorder->taxes,
            'otp_setup'                         => $workorder->otp_setup,
            'monthly_monitoring'                => $workorder->monthly_monitoring,
            'installation_cost'                 => $workorder->installation_cost,
            'email'                             => $workorder->email,

            'comments'                          => $workorder->comments,
            'terms_and_conditions'              => $workorder->terms_and_conditions,
            'header'                            => $workorder->header,

            'password'                          => $workorder->password,
            'security_number'                   => $workorder->security_number,

            'lead_source'                       => $workorder->ls_name,
            'account_type'                      => $workorder->account_type,
            'panel_communication'               => $workorder->panel_communication,
            'panel_type'                        => $workorder->panel_type,
            'job_tags'                          => $workorder->job_tags,
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

            'template'                          => '3',
            'business_logo'                     => $business_logo,

            'first'                             => $workorder->company_representative_name,
            'second'                            => $second,
            'third'                             => $third,
            'firstNumeric'                      => $firstNumeric->FName.' '.$firstNumeric->LName,

            'company_id'                        => $company_id,

            'firstname'                         => $agreements->firstname,
            'lastname'                          => $agreements->lastname,
            'businessname'                      => $agreements->businessname,
            'firstname_spouse'                  => $agreements->firstname_spouse,
            'lastname_spouse'                   => $agreements->lastname_spouse,
            'address'                           => $agreements->address,
            'phone_number'                      => $workorder->phone_number,
            'mobile_number'                     => $workorder->mobile_number,
            'city'                              => $agreements->city,
            'state'                             => $agreements->state,
            'county'                            => $agreements->county,
            'postcode'                          => $agreements->postcode,
            'first_ecn'                         => $agreements->first_ecn,
            'second_ecn'                        => $agreements->second_ecn,
            'third_ecn'                         => $agreements->third_ecn,
            'first_ecn_no'                      => $agreements->first_ecn_no,
            'second_ecn_no'                     => $agreements->second_ecn_no,
            'third_ecn_no'                      => $agreements->third_ecn_no,
            'installation_date'                 => $workorder->install_date,
            'intall_time'                       => $workorder->install_time,
            'sales_re_name'                     => $agreements->sales_re_name,
            'sale_rep_phone'                    => $agreements->sale_rep_phone,
            'team_leader'                       => $agreements->team_leader,
            'billing_date'                      => $agreements->billing_date,
        );

        // dd($agreements);


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_installation";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template_agreement', $data, $filename, "portrait");
        // $this->pdf->render();


        // $this->pdf->stream("welcome.pdf");
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

    public function work_order_pdf_solar($wo_id)
    {
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workorder = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workorder->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorderNo = $workorder->work_order_number;
        $c_id = $workorder->company_id;
        $p_id = $workorder->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrderAlarm($wo_id);
        $items = $this->workorder_model->get_agree_items($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;
        $agreements = $this->workorder_model->get_agreements($wo_id);

        $company_id = $workorder->company_id;

        $first = $this->workorder_model->getuserfirst($workorder->company_representative_name);
        $second = $this->workorder_model->getusersecond($workorder->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workorder->secondary_account_holder_name);

        $solars = $this->workorder_model->get_solar($wo_id);
        $solar_files = $this->workorder_model->get_solar_files($wo_id);

        $data = array(
            'workorder'                         => $workorderNo,
            'company_representative_signature'  => $workorder->company_representative_signature,
            'company_representative_name'       => $workorder->company_representative_name,
            'primary_account_holder_signature'  => $workorder->primary_account_holder_signature,
            'primary_account_holder_name'       => $workorder->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workorder->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workorder->secondary_account_holder_name,

            'comments'                          => $workorder->comments,
            'header'                            => $workorder->header,

            'lead_source'                       => $workorder->ls_name,
            'panel_communication'               => $workorder->panel_communication,
            // 'source' => $source

            'template'                          => '3',
            'business_logo'                     => $business_logo,

            'first'                             => $first->FName.' '.$first->LName,
            'second'                            => $second,
            'third'                             => $third,

            'company_id'                        => $company_id,

            'tor'                               => $solars->tor,
            'sfoh'                              => $solars->sfoh,
            'aor'                               => $solars->aor,
            'spmp'                              => $solars->spmp,
            'hoa'                               => $solars->hoa,
            'hoa_text'                          => $solars->hoa_text,
            'estimated_bill'                    => $solars->estimated_bill,
            'ebis'                              => $solars->ebis,
            'hdygi'                             => $solars->hdygi,
            'hdygi_file'                        => $solars->hdygi_file,
            'eba_text'                          => $solars->eba_text,
            'es'                                => $solars->es,
            'options'                           => $solars->options,

            'firstname'                         => $customerData->first_name,
            'lastname'                          => $customerData->last_name,
            'address'                           => $customerData->mail_add,
            'city'                              => $customerData->city,
            'state'                             => $customerData->state,
            'county'                            => $customerData->county,
            'postcode'                          => $customerData->zip_code,
            'email'                             => $customerData->email,

            'solar_files'                       => $solar_files,
        );

        // dd($agreements);


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_solar";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template_solar', $data, $filename, "portrait");
    }

    public function approveEstimate($hashedId)
    {
        $this->load->helper('hashids_helper');

        $id = hashids_decrypt($hashedId, '', 15);
        $estimate = $this->estimate_model->getEstimate($id);

        $status = trim($estimate->status);
        $this->page_data['estimate'] = $estimate;

		$company = $this->business_model->getByCompanyId($estimate->company_id);
        $this->page_data['company'] = $company;

        if ($status !== 'Submitted') {
            $isSuccess = false;
            $message = 'Something went wrong approving this estimate.';

            switch ($status) {
                case 'Draft':
                    $message = 'Estimate with status of draft cannot be approved.';
                    break;

                case 'Accepted':
                    $isSuccess = true;
                    $message = 'This estimate has already been approved.';
                    break;

                case 'Declined By Customer':
                    $message = 'This estimate has already been declined.';
                    break;
            }

            $this->page_data['message'] = $message;
            $this->page_data['is_success'] = $isSuccess;
            $this->load->view('estimate/estimate_status', $this->page_data);
            return;
        }

        if (
            (in_array(trim($estimate->deposit_request), ['1', '2', '$', '%']) && is_numeric($estimate->deposit_amount) && (float) $estimate->deposit_amount >= 1) &&
            in_array($status, ['Submitted', 'Draft']) 
        ) {
            return redirect('/share_Link/estimate_deposit/' . $hashedId);
        }

        $this->estimate_model->update($estimate->id, ['status' => 'Accepted']);

        $this->page_data['message'] = 'Estimate has been successfully accepted.';
        $this->page_data['is_success'] = true;
        $this->load->view('estimate/estimate_status', $this->page_data);
    }

    public function declineEstimate($hashedId)
    {
        $this->load->helper('hashids_helper');

        $id = hashids_decrypt($hashedId, '', 15);
        $estimate = $this->estimate_model->getEstimate($id);

        $status = trim($estimate->status);
        $this->page_data['estimate'] = $estimate;

        $company = $this->business_model->getByCompanyId($estimate->company_id);
        $this->page_data['company'] = $company;

        if ($status !== 'Submitted') {
            $isSuccess = false;
            $message = 'Something went wrong declining this estimate.';

            switch ($status) {
                case 'Draft':
                    $message = 'Estimate with status of draft cannot be declined.';
                    break;

                case 'Accepted':
                    $message = 'This estimate has already been approved.';
                    break;

                case 'Declined By Customer':
                    $isSuccess = true;
                    $message = 'This estimate has already been declined.';
                    break;
            }

            $this->page_data['message'] = $message;
            $this->page_data['is_success'] = $isSuccess;
            $this->load->view('estimate/estimate_status', $this->page_data);
            return;
        }

        $this->estimate_model->update($id, ['status' => 'Declined By Customer']);

        $this->page_data['is_success'] = true;
        $this->page_data['message'] = 'Estimate has been successfully declined.';
        $this->load->view('estimate/estimate_status', $this->page_data);
    }

    public function estimate_deposit($hashedId)
    {
        $this->load->model('general_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('Customer_model', 'customer_model');

        $this->load->helper('functions');
    	$this->load->helper('hashids_helper');

        $estimateId = hashids_decrypt($hashedId, '', 15);
        $estimate = $this->estimate_model->getEstimate($estimateId);
        $companyId = $estimate->company_id;

        $status = trim($estimate->status);
        if ($status === 'Accepted') {
            return redirect('/share_Link/approveEstimate/' . $hashedId);
        }
        if ($status === 'Declined By Customer') {
            return redirect('/share_Link/declineEstimate/' . $hashedId);
        }

        $getCompanyInfo = [
            'where' => [
                'company_id' => $companyId,
            ],
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        ];

        $this->page_data['company_info'] = $this->general_model->get_data_with_param($getCompanyInfo, false);
        $this->page_data['onlinePaymentAccount'] = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($companyId);
    	$this->page_data['estimate'] = $estimate;
        $this->page_data['customer'] = $this->customer_model->getCustomer($estimate->customer_id);

        $items_dataOP1 = $this->estimate_model->getItemlistByIDOption1($estimate->id);
        $items_dataOP2 = $this->estimate_model->getItemlistByIDOption2($estimate->id);

        $items_dataBD1 = $this->estimate_model->getItemlistByIDBundle1($estimate->id);
        $items_dataBD2 = $this->estimate_model->getItemlistByIDBundle2($estimate->id);
        $items = $this->estimate_model->getEstimatesItems($estimate->id);

        $workData = $estimate;
        $data =  [
            'items_dataOP1'                 => $items_dataOP1,
            'items_dataOP2'                 => $items_dataOP2,
            'items_dataBD1'                 => $items_dataBD1,
            'items_dataBD2'                 => $items_dataBD2,

            'estimate_number'               => $workData->estimate_number,
            'job_location'                  => $workData->job_location,
            'job_name'                      => $workData->job_name,
            'estimate_date'                 => $workData->estimate_date,
            'expiry_date'                   => $workData->expiry_date,
            'purchase_order_number'         => $workData->purchase_order_number,
            'status'                        => $workData->status,
            'estimate_type'                 => $workData->estimate_type,
            'type'                          => $workData->type,
            'deposit_request'               => $workData->deposit_request,
            'deposit_amount'                => $workData->deposit_amount,
            'customer_message'              => $workData->customer_message,
            'terms_conditions'              => $workData->terms_conditions,
            'instructions'                  => $workData->instructions,
            'email'                         => $workData->email,
            'phone'                         => $workData->phone_number,
            'mobile'                        => $workData->mobile_number,
            'terms_and_conditions'          => $workData->terms_and_conditions,
            'terms_of_use'                  => $workData->terms_of_use,
            'job_description'               => $workData->job_description,
            'instructions'                  => $workData->instructions,
            'bundle1_message'               => $workData->bundle1_message,
            'bundle2_message'               => $workData->bundle2_message,

            'items'                         => $items,

            'bundle_discount'               => $workData->bundle_discount,
            // 'deposit_amount'                => $workData->deposit_amount,
            'bundle1_total'                 => $workData->bundle1_total,
            'bundle2_total'                 => $workData->bundle2_total,

            'option_message'                => $workData->option_message,
            'option2_message'               => $workData->option2_message,
            'option1_total'                 => $workData->option1_total,
            'option2_total'                 => $workData->option2_total,

            'sub_total'                     => $workData->sub_total,
            'sub_total2'                    => $workData->sub_total2,
            'tax1_total'                    => $workData->tax1_total,
            'tax2_total'                    => $workData->tax2_total,

            'grand_total'                   => $workData->grand_total,
            'adjustment_name'               => $workData->adjustment_name,
            'adjustment_value'              => $workData->adjustment_value,
            'markup_type'                   => $workData->markup_type,
            'markup_amount'                 => $workData->markup_amount,
        ];
        foreach ($data as $key => $value) {
            $this->page_data[$key] = $value;
        }

		$this->load->view('pages/estimate_deposit', $this->page_data);
    }

    public function update_estimate_status_accepted() {
        $this->load->model('Estimate_model', 'estimate_model');
    
        $post = $this->input->post();    	
        $this->estimate_model->update($post['estimate_id'], ['status' => 'Accepted']);
    
        $json_data = ['is_success' => 1];
        echo json_encode($json_data);
      }

      public function ticketsPDF($tkID)
    {
        
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $tickets = $this->tickets_model->get_tickets_data_one($tkID);
        // $customer = $this->tickets_model->get_tickets_data_one($tickets->customer_id);
        $header = $this->tickets_model->get_tickets_header($tickets->company_id);
        $clients = $this->tickets_model->get_tickets_clients($tickets->company_id);
        $items = $this->tickets_model->get_ticket_items($tickets->id);
        $rep = $this->tickets_model->getUserDetails($tickets->sales_rep);

        $payment = $this->tickets_model->get_ticket_payments($tickets->id);
        

        // dd($wo_id);

        $data = array(
            //customer details
            'workorder'         => $workorderNo,
            'name'              => $tickets->first_name.' '.$tickets->middle_name.' '.$tickets->last_name,
            'mail_add'          => $tickets->mail_add,
            'city'              => $tickets->city,
            'state'             => $tickets->state,
            'zip_code'          => $tickets->zip_code,
            'email'             => $tickets->email,
            'phone_h'           => $tickets->phone_h,

            //clients details
            'bname'                 => $clients->business_name,
            'baddress'              => $clients->street,
            'bcity'                 => $clients->city,
            'bstate'                => $clients->state,
            'bzip_code'             => $clients->postal_code,
            'bemail'                => $clients->business_email,
            'bphone_h'              => $clients->business_phone,

            //tickets details
            'service_location'              => $tickets->service_location,
            'service_description'           => $tickets->service_description,
            'job_tag'                       => $tickets->job_tag,
            'ticket_no'                     => $tickets->ticket_no,
            'ticket_date'                   => $tickets->ticket_date,
            'scheduled_time'                => $tickets->scheduled_time,
            'scheduled_time_to'             => $tickets->scheduled_time_to,
            'technicians'                   => $tickets->technicians,
            'purchase_order_no'             => $tickets->purchase_order_no,
            'ticket_status'                 => $tickets->ticket_status,
            'panel_type'                    => $tickets->panel_type,
            'service_type'                  => $tickets->service_type,
            'warranty_type'                 => $tickets->warranty_type,
            'customer_phone'                => $tickets->customer_phone,
            // 'employee_id'                => $tickets->employee_id,
            'subtotal'                      => $tickets->subtotal,
            'taxes'                         => $tickets->taxes,
            'adjustment'                    => $tickets->adjustment,
            'adjustment_value'              => $tickets->adjustment_value,
            'markup'                        => $tickets->markup,
            'grandtotal'                    => $tickets->grandtotal,
            'payment_method'                => $tickets->payment_method,
            'billing_date'                  => $tickets->billing_date,
            'sales_rep'                     => $tickets->sales_rep,
            'sales_rep_no'                  => $tickets->sales_rep_no,
            'tl_mentor'                     => $tickets->tl_mentor,
            'message'                       => $tickets->message,
            'terms_conditions'              => $tickets->terms_conditions,
            'attachments'                   => $tickets->attachments,
            'instructions'                  => $tickets->instructions,
            'header'                        => $header->content,
            'items'                         => $items,
            'repsName'                      => $rep->FName.' '.$rep->LName,
            'payment'                       => $payment,
        );

        // dd($agreements);
            
        $filename = "nSmarTrac_Service_Ticket_".$tkID."000";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('tickets/tickets_pdf', $data, $filename, "portrait");
        // $this->pdf->render();


        // $this->pdf->stream("welcome.pdf");
    }

    
    public function genview_invoice($id)
    {
        $invoice = get_invoice_by_id($id);
        // $user = get_user_by_id(logged('id'));
        // $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));
        
        $this->page_data['clients'] = $this->invoice_model->getclientsData(logged('company_id'));

        // if (!empty($setting)) {
        //     foreach ($setting as $key => $value) {
        //         if (is_serialized($value)) {
        //             $setting->{$key} = unserialize($value);
        //         }
        //     }
        //     $this->page_data['setting'] = $setting;
        // }

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            // $this->page_data['user'] = $user;
        }

        $invoiceData = $this->invoice_model->getinvoice($id);
        $inv_no = $invoiceData->invoice_number;


        $this->page_data['record_payment'] = $this->input->get('do');
        $this->page_data['payments'] = $this->invoice_model->getPayments($inv_no);
        $this->page_data['items'] = $this->invoice_model->getItemsInv($id);

        $this->page_data['invoice_template'] = $this->generateInvoiceHTML($id);
        $this->load->view('invoice/genview_public', $this->page_data);
    }

    public function public_preview_($id = null){
        $this->load->model('IndustryType_model');

        // $this->page_data['page']->title = 'Customer Preview';
        // $this->page_data['page']->parent = 'Customers';

        $this->load->model('jobs_model');
        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $userid = $id;
        $user_id = logged('id');
        $companyId = logged('company_id');
        if(isset($userid) || !empty($userid)){
            $customer = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['industryType'] = $this->IndustryType_model->getById($customer->industry_type_id);
            $this->page_data['profile_info'] = $customer;
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
            if($companyId == 58){
                $this->page_data['solar_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_info_solar");
            }
            
            $get_customer_notes = array(
                'where' => array(
                    'fk_prof_id' => $userid
                ),
                'table' => 'acs_notes',
                'select' => '*',
            );
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);

            $get_login_user = array(
                'where' => array(
                    'id' => $user_id
                ),
                'table' => 'users',
                'select' => 'id,FName,LName',
            );
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_customer_job_items($id);

            $customer_papers_query = array(
                'where' => array(
                    'customer_id' => $userid
                ),
                'table' => 'acs_papers',
                'select' => '*',
            );
            $this->page_data['papers'] = $this->general->get_data_with_param($customer_papers_query);
            if (count($this->page_data['papers'])) {
                $this->page_data['papers'] = $this->page_data['papers'][0];
            }

            $customer_contacts = array(
                'where' => array(
                    'customer_id' => $userid
                ),
                'table' => 'contacts',
                'select' => '*',
                'order' => array(
                    'order_by' => 'id',
                    'ordering' => 'asc'
                ),
            );
            $this->page_data['contacts'] = $this->general->get_data_with_param($customer_contacts);
        }
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_salesarea","sa_id");
        $this->page_data['employees'] = $this->customer_ad_model->get_all(FALSE,"","ASC","users","id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['companyId'] = logged('company_id');
       
       // print_r($this->page_data['profile_info']);
        $this->load->view('v2/pages/customer/public_preview', $this->page_data);
    }
 
	public function isAllowedModuleAccess($module_id = 0){
		$this->load->helper(array('user_helper'));

		$role_id  = logged('role');
		$is_allowed = true;
		if( $role_id != 1 && $role_id != 2 ){
			//$is_allowed = validateUserAccessModule($module_id); //Activate to validate
			$is_allowed = true;

			/*if( !$is_allowed ){
				$this->session->set_flashdata('alert_class', 'danger');
        		$this->session->set_flashdata('message', 'No access to module');

        		redirect('dashboard');
			}*/
		}

		return $is_allowed;
	}

    public function generateInvoiceHTML($id)
    {
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');

        $invoice = get_invoice_by_id($id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
        }

        $this->page_data['items'] = $this->invoice_model->getItemsInv($id);

        $get_company_info = array(
            'where' => array(
                'company_id' => $invoice->company_id,
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );

        $this->page_data['company_info'] = $this->general_model->get_data_with_param($get_company_info, false);
        $this->page_data['customer'] = $this->AcsProfile_model->getByProfId($invoice->customer_id);

        return $this->load->view('invoice/invoice-new', $this->page_data, true);
    }

    public function print($id)
    {
        $this->page_data['invoice_template'] = $this->generateInvoiceHTML($id);
        $this->load->view('invoice/print', $this->page_data);
    }

    public function previewInvoicePDF($id)
    {
        $invoice = get_invoice_by_id($id);
        $user = get_user_by_id(logged('id'));
        $company = get_company_by_id(logged('company_id'));
        $this->page_data['invoice'] = $invoice;
        $this->page_data['user'] = $user;
        // $this->page_data['items'] = $user;
        $this->page_data['items'] = $this->invoice_model->getItemsInv($id);
        $this->page_data['users'] = $this->invoice_model->getInvoiceCustomer($id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
        }
        $format = $this->input->get('format');
        $this->page_data['company'] = $company;
        $this->page_data['format'] = $format;
        // print_r($this->page_data['users']);

        if ($format === "pdf") {
            $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->library('pdf');
            $this->pdf->load_view('invoice/pdf/template', $this->page_data, $filename, "portrait");
        }elseif($format === "save_pdf"){
            $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->library('pdf');
            $this->pdf->save_pdf('invoice/pdf/template', $this->page_data, $filename, "P");
            
        } else {
            $this->page_data['profile'] = (companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets;
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->view('invoice/pdf/template', $this->page_data, "portrait");
        }
    }
}



/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */
