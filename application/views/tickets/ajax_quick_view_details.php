<style>
@media print {
    .mustRight 
    { 
        float: right !important; 
        margin-top:-80px !important;
        font-size: 12px !important;
    }
    .descriptionTags
    {
        width:25% !important;
    }
    .salesRepArea
    {
        width:25% !important;
        float: right !important; 
    }
    .serviceLocDiv
    {
        width:75% !important;
    }
    .paymentArea
    {
        width:60% !important;
    }
    .spaceDiv
    {
        width:5% !important;
    }
    .summaryArea
    {
        width:35% !important;
    }
    .compLogo
    {
        width: 80px; 
        height: 80px;
    }
} 
.quick-view-schedule-container .title-border{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
.ticket-bill-method{
    display:block;
    margin-top:10px;
}
.clear{
    clear:both;
}
.ticket-bill-method span label{
    width: 130px;
    display: inline-block;
    font-weight: bold;
    margin-bottom: 3px;
    /* text-transform: capitalize; */
}
</style>
<div class="nsm-page-content quick-view-schedule-container" style="padding:2%;">
    <input type="hidden" value="<?= $tickets->id ?>" id="esignTicketId" />
    <input type="hidden" value="<?= $tickets->customer_id; ?>" id="ticket_customer_id">
    <div class="row">
        <div class="col-md-5">
            <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="margin-top: 33px; max-width: 130px; max-height: 130px;" class="compLogo"/> 
        </div>
        <div class="col-md-7">
            <table class="table-borderless mustRight" style="width:100%;">
                <tr>
                    <td colspan="2"><h1 style="text-align:right;"><b><?= $tickets->ticket_no; ?></b></h1></td>
                </tr> 
                <tr>
                    <td align="right">Job Tags:</td>
                    <td align="right"><b><?php echo $tickets->job_tag; ?></b></td>
                </tr>
                <tr>
                    <td align="right">Purchase Order No:</td>
                    <td align="right"><b><?php echo $tickets->purchase_order_no != '' ? $tickets->purchase_order_no : '---'; ?></b></td>
                </tr>                 
                <tr>
                    <td align="right">Panel Type:</td>
                    <td align="right"><b><?php echo $tickets->panel_type != '' ? $tickets->panel_type : '---'; ?></b></td>
                </tr>                
                <tr>
                    <td align="right" style="width:47%;">Scheduled Date:</td>
                    <td align="right"><?php echo date('m/d/Y', strtotime($tickets->ticket_date)); ?></td>
                </tr>
                <tr>
                    <td align="right">Scheduled Time:</td>
                    <td align="right"><?php echo $tickets->scheduled_time.' to '.$tickets->scheduled_time_to; ?></td>
                </tr>
                <tr>
                    <td align="right">Status:</td>
                    <td align="right"><b><?php echo $tickets->ticket_status; ?></b></td>
                </tr>
                <?php if($tickets->business_name != ''){ ?>
                <tr>
                    <td align="right">Business Name:</td>
                    <td align="right"><?php echo $tickets->business_name; ?></td>
                </tr>
                <?php } ?>
            </table>            
        </div>
    </div>
    <br />
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <h6 class="title-border">FROM :</h6>
                    <div style="font-size:14px;padding:3px;">
                        <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                            <i class='bx bx-buildings'></i> <?php echo $clients->business_name; ?>
                        </span>
                        <span><?php echo $clients->street .' <br>'. $clients->city .', '. $clients->state .' '. $clients->postal_code; ?></span><br>
                        <?php if( $clients->business_email != '' ){ ?>
                            <span> Email: <a href="mailto:<?= $clients->business_email; ?>"><?= $clients->business_email; ?></a></span><br />
                        <?php } ?>
                        <span> Contact Number: <?= formatPhoneNumber($clients->business_phone); ?></span>
                    </div>  
                </div>
                <div class="col-md-5">
                    <h6 class="title-border">TECHNICIANS :</h6>
                    <?php 
                        $assigned_employees = array();
                        $emp_ids = unserialize($tickets->technicians);
                        if( is_array($emp_ids) ){
                            foreach($emp_ids as $eid){
                                $assigned_employees[] = $eid;    
                            }
                        }    

                        if( !empty($assigned_employees) ){
                            if( !in_array($tickets->sales_rep, $assigned_employees) ){
                                $assigned_employees[] = $tickets->sales_rep;    
                            }                            
                        }else{
                            $assigned_employees[] = $tickets->sales_rep;    
                        }
                    ?>
                    <?php foreach($assigned_employees as $eid){ ?>
                        <div class="nsm-list-icon primary" style="background-color:#ffffff;display:inline-block;float:none !important;">
                            <div class="nsm-profile" style="background-image: url('<?= userProfileImage($eid); ?>');" data-img="<?= userProfileImage($eid); ?>"></div>                            
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <h6 class="title-border" style="margin-top: 5px;">TO : </h6>
                    <div style="font-size:14px;padding:3px;">                
                        <?php if( $tickets->customer_type == 'Business' && $tickets->acs_business_name != '' ){ ?>
                            <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                                <i class='bx bx-user-circle' ></i> <?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?> - 
                                <i class='bx bx-buildings'></i> <?= $tickets->acs_business_name; ?>
                            </span>
                        <?php }else{ ?>
                            <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                                <i class='bx bx-user-circle'></i> <?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?>
                            </span>
                        <?php } ?>
                        <span><?php echo $tickets->mail_add .' <br>'. $tickets->city .', '. $tickets->state .' '. $tickets->zip_code; ?></span><br>
                        <?php if( $tickets->email != '' ){ ?>
                            <span>Email: <a href="mailto:<?php echo $tickets->email; ?>"><?php echo $tickets->email; ?></a></span><br>
                        <?php } ?>
                        <span>Contact Number: <?php echo formatPhoneNumber($tickets->phone_m); ?></span>
                    </div>
                </div>
                <div class="col-md-5">
                    <?php if( $esign && $billing ){ ?>
                        <div class="ticket-bill-method">
                            <h6 class="title-border">BILLING</h6>
                            <span style="font-size:16px;font-weight: bold; display: block; margin-bottom:6px;">
                                <?php 
                                    $billing_method = $billing->bill_method;
                                    if( $billing_method == 'CC' ){
                                        $billing_method = 'Credit Card';
                                    }
                                    if( $billing_method == 'CHECK' ){
                                        $billing_method = 'Check';
                                    }
                                ?>
                                <i class='bx bx-spreadsheet'></i> <label><?php echo $billing_method != '' ? $billing_method : '---'; ; ?></label>
                            </span>   
                            <?php if( $billing->bill_method == 'CC' ){ ?>     
                                <span><label>Card Type</label> : <?= $billing->card_type; ?><br /></span>        
                                <?php 
                                    if (logged("user_type") == 1){
                                        $cc_num = $billing->credit_card_num;
                                    }else{
                                        $cc_num = strMask($billing->credit_card_num,'X');
                                    } 
                                ?>
                                <span><label>Card Number</label> : <?= $cc_num; ?><br /></span>
                                <span><label>Card Expiration</label> : <?= $billing->credit_card_exp; ?><br /></span>
                                <span><label>Card CVC</label> : <?= $billing->credit_card_exp_mm_yyyy; ?><br /></span>
                            <?php } ?>
                            <?php if( $billing->bill_method == 'Debit Card' ){ ?>        
                                <?php 
                                    if (logged("user_type") == 1){
                                        $cc_num = $billing->credit_card_num;
                                    }else{
                                        $cc_num = strMask($billing->credit_card_num,'X');
                                    } 
                                ?>
                                <span><label>Card Number</label> : <?= $cc_num; ?><br /></span>
                                <span><label>Card Expiration</label> : <?= $billing->credit_card_exp; ?><br /></span>
                                <span><label>Card CVC</label> : <?= $billing->credit_card_exp_mm_yyyy; ?><br /></span>
                            <?php } ?>
                            <?php if( $billing->bill_method == 'CHECK' ){ ?>  
                                <span><label>Bank Name</label> : <?= $billing->bank_name; ?><br /></span>
                                <span><label>Check Number</label> : <?= $billing->check_num; ?><br /></span>
                                <span><label>Routing Number</label> : <?= $billing->routing_num; ?><br /></span>
                                <span><label>Account Number</label> : <?= $billing->acct_num; ?><br /></span>
                            <?php } ?>
                            <?php if( $billing->bill_method == 'ACH' ){ ?>                                  
                                <span><label>Routing Number</label> : <?= $billing->routing_num; ?><br /></span>
                                <span><label>Account Number</label> : <?= $billing->acct_num; ?><br /></span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>    
    <br />
    <div class="row">        
        <div class="col-md-12">
            <h6 class="title-border">ITEMS :</h6>
            <table class="table table-bordered">
                <thead style="background-color: #F3F3F3;">
                    <th>#</th>
                    <th>Items</th>
                    <th>Item Type</th>
                    <th style="text-align:center;">Price</th>
                    <th style="text-align:center;">Qty</th>
                    <th style="text-align:center;">Discount</th>
                    <th style="text-align:center;">Total</th>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total_discount = 0;
                     foreach($items as $item){ ?>
                    <?php $total_discount = $total_discount + $item->discount; ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item->title; ?></td>
                        <td><?php echo $item->item_type; ?></td>
                        <td style="text-align:right;">$<?php echo number_format($item->costing,2); ?></td>
                        <td style="text-align:center;"><?php echo $item->qty; ?></td>
                        <td style="text-align:right;">$<?php echo number_format($item->discount,2); ?></td>
                        <td style="text-align:right;">$<?php echo number_format($item->total,2); ?></td>
                    </tr>
                    <?php 
                        $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 paymentArea">   
            <table class="table table-bordered">                
                <?php if( $tickets->otp_setup > 0 ){ ?>
                <tr style="font-weight:bold;">
                    <td>One Time (Program and Setup)</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->otp_setup,2); ?></td>
                </tr>
                <?php } ?>
                <?php if( $tickets->monthly_monitoring > 0 ){ ?>
                <tr style="font-weight:bold;">
                    <td>Monthly Monitoring</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->monthly_monitoring,2); ?></td>
                </tr>
                <?php } ?>
                <?php if( $tickets->installation_cost > 0 ){ ?>
                <tr style="font-weight:bold;">
                    <td>Installation Cost</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->installation_cost,2); ?></td>
                </tr>
                <?php } ?>
                <tr style="font-weight:bold;"><td colspan="2">Service Description</td></tr>
                <tr><td colspan="2"><?= $tickets->service_description; ?></td></tr>
                <tr style="font-weight:bold;"><td colspan="2">Instructions / Notes</td></tr>
                <tr>
                    <td colspan="2">
                        <?php 
                            if( $tickets->instructions != '' ){
                                echo  $tickets->instructions;
                            }else{
                                echo "None";
                            }
                        ?>
                    </td>
                </tr>
                <tr style="font-weight:bold;"><td colspan="2">URL</td></tr>
                <tr>
                    <td colspan="2"><a target="_new" href="<?= base_url('view_service_ticket/'.$tickets->company_id.'/'.$tickets->id); ?>"><?= base_url('view_service_ticket/'.$tickets->company_id.'/'.$tickets->id); ?></a></td>
                </tr>
            </table>         
            <!-- <table class="table table-borderless">
                <tr>
                    <td style="width:150px;"><b>Payment Method: </b></td>
                    <td style="text-align:;"><?php echo $tickets->payment_method; ?></td>
                </tr>
                <tr>
                    <td><b>Payment Amount: </b></td>
                    <td style="text-align:;">$<?php echo number_format($tickets->payment_amount,2); ?></td>
                </tr>
                <tr>
                    <td><b>Billing Date: </b></td>
                    <td style="text-align:;"><?php echo $tickets->billing_date; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <?php 
                    $payment_method                 = $tickets->payment_method;
                    $check_number                   = $payment->check_number;
                    $routing_number                 = $payment->routing_number;
                    $account_number                 = $payment->account_number;
                    $credit_number                  = $payment->credit_number;
                    $credit_expiry                  = $payment->credit_expiry;
                    $credit_cvc                     = $payment->credit_cvc;
                    $account_credentials            = $payment->account_credentials;
                    $account_note                   = $payment->account_note;
                    $confirmation                   = $payment->confirmation;
                    $mail_address                   = $payment->mail_address;
                    $mail_locality                  = $payment->mail_locality;
                    $mail_state                     = $payment->mail_state;
                    $mail_postcode                  = $payment->mail_postcode;
                    $mail_cross_street              = $payment->mail_cross_street;
                    $billing_date                   = $payment->billing_date;
                    $billing_frequency              = $payment->billing_frequency;

                        if($payment_method ==  'Cash'){
                            echo '<b>Payment Details:</b>';
                        }
                        elseif($payment_method ==  'Check')
                        {
                            // echo 'Payment Method: Check';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Check Number: '. $check_number;
                            echo '<br> Rounting Number: '. $routing_number;
                            echo '<br> Account Number: '. $account_number;
                        }
                        elseif($payment_method ==  'Credit Card')
                        {
                            // echo 'Payment Method: Credit Card';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Credit Number: '. $credit_number;
                            echo '<br> Credit Expiry: '. $credit_expiry;
                            echo '<br> CVC: '. $credit_cvc;
                        }
                        elseif($payment_method ==  'Debit Card')
                        {
                            // echo 'Payment Method: Debit Card';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Credit Number: '. $credit_number;
                            echo '<br> Credit Expiry: '. $credit_expiry;
                            echo '<br> CVC: '. $credit_cvc;
                        }
                        elseif($payment_method ==  'ACH')
                        {
                            // echo 'Payment Method: Debit Card';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Routing Number: '. $routing_number;
                            echo '<br> Account Number: '. $account_number;
                        }
                        elseif($payment_method ==  'Venmo')
                        {
                            // echo 'Payment Method: Venmo';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                            echo '<br> Confirmation: '. $confirmation;
                        }
                        elseif($payment_method ==  'Paypal')
                        {
                            // echo 'Payment Method: Paypal';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                            echo '<br> Confirmation: '. $confirmation;
                        }
                        elseif($payment_method ==  'Square')
                        {
                            // echo 'Payment Method: Square';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                            echo '<br> Confirmation: '. $confirmation;
                        }
                        elseif($payment_method ==  'Invoicing')
                        {
                            // echo 'Payment Method: Invoicing';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street;
                        }
                        elseif($payment_method ==  'Warranty Work')
                        {
                            // echo 'Payment Method: Warranty Work';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        elseif($payment_method ==  'Home Owner Financing')
                        {
                            // echo 'Payment Method: Home Owner Financing';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        elseif($payment_method ==  'e-Transfer')
                        {
                            // echo 'Payment Method: e-Transfer';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        elseif($payment_method ==  'Other Credit Card Professor')
                        {
                            // echo 'Payment Method: Other Credit Card Professor';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Credit Number: '. $credit_number;
                            echo '<br> Credit Expiry: '. $credit_expiry;
                            echo '<br> CVC: '. $credit_cvc;
                        }
                        elseif($payment_method ==  'Other Payment Type')
                        {
                            // echo 'Payment Method: Other Payment Type';
                            echo '<b>Payment Details:</b>';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        ?>
                    </td>
                </tr>
            </table> -->
        </div>
        <div class="col-md-6 summaryArea">
            <table class="table table-bordered">
                <tr style="font-weight:bold;">
                    <td>Subtotal</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->subtotal,2); ?></td>
                </tr>                
                <tr style="font-weight:bold;">
                    <td>Taxes</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->taxes,2); ?></td>
                </tr>
                <tr style="font-weight:bold;">
                    <td>Discount</td>
                    <td style="text-align:right;">$<?php echo number_format($total_discount,2); ?></td>
                </tr>
                <!-- <tr style="font-weight:bold;">
                    <td>Adjustment: <?php echo $tickets->adjustment; ?></td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->adjustment_value,2); ?></td>
                </tr> -->
                <!-- <tr style="font-weight:bold;">
                    <td>Markup</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->markup,2); ?></td>
                </tr> -->
                <tr style="font-weight:bold;">
                    <td>Grand Total</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->grandtotal,2); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>