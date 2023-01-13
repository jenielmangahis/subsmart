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
</style>
<div class="nsm-page-content quick-view-schedule-container" style="padding:2%;">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="margin-top: 33px; max-width: 130px; max-height: 130px;" class="compLogo"/> 
        </div>
        <div class="col-md-6">
            <div class="" style="float:right;">
                <div style="font-size:16px;">
                <table class="table-borderless mustRight">
                    <tr>
                        <td colspan="2"><h1 style="text-align:right;"><b><?= $tickets->ticket_no; ?></b></h1></td>
                    </tr>                                
                    <tr>
                        <td style="width:180px;">Scheduled Date:</td>
                        <td><?php echo $tickets->ticket_date; ?></td>
                    </tr>
                    <tr>
                        <td>Scheduled Time:</td>
                        <td><?php echo $tickets->scheduled_time.' to '.$tickets->scheduled_time_to; ?></td>
                    </tr>
                    <tr>
                        <td>Purchase Order No:</td>
                        <td><?php echo $tickets->purchase_order_no; ?></td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td><?php echo $tickets->ticket_status; ?></td>
                    </tr>
                    <?php if($tickets->business_name != ''){ ?>
                    <tr>
                        <td>Business Name:</td>
                        <td><?php echo $tickets->business_name; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h6 class="title-border">FROM :</h6>
            <div style="font-size:16px;padding:3px;">
                <b><?php echo $clients->business_name; ?></span></b> <br>
                <span><?php echo $clients->street .' <br>'. $clients->city .', '. $clients->state .' '. $clients->postal_code; ?></span><br>
                <?php echo $clients->email_address; ?><br>
                <?php echo $clients->phone_number; ?>
            </div>
        </div>
        <div class="col-md-12">
            <h6 class="title-border">TO :</h6>
            <div style="font-size:16px;padding:3px;">
                <b><span><?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?></span></b><br>
                <span><?php echo $tickets->mail_add .' <br>'. $tickets->city .', '. $tickets->state .' '. $tickets->zip_code; ?></span><br>
                <span><?php echo $tickets->email; ?></span><br>
                <span><?php echo $tickets->phone_h; ?></span>
            </div>
        </div>
    </div>
    <br>
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
                     foreach($items as $item){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item->title; ?></td>
                        <td><?php echo $item->item_type; ?></td>
                        <td style="text-align:center;">$<?php echo number_format($item->costing,2); ?></td>
                        <td style="text-align:center;"><?php echo $item->qty; ?></td>
                        <td style="text-align:center;">$<?php echo number_format($item->discount,2); ?></td>
                        <td style="text-align:center;">$<?php echo number_format($item->total,2); ?></td>
                    </tr>
                    <?php 
                        $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8 paymentArea">            
            <table class="table table-borderless">
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
            </table>
            
        </div>
        <div class="col-md-4 summaryArea">
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
                    <td>Adjustment: <?php echo $tickets->adjustment; ?></td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->adjustment_value,2); ?></td>
                </tr>
                <tr style="font-weight:bold;">
                    <td>Markup</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->markup,2); ?></td>
                </tr>
                <tr style="font-weight:bold;">
                    <td>Grand Total</td>
                    <td style="text-align:right;">$<?php echo number_format($tickets->grandtotal,2); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>