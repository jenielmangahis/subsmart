<!DOCTYPE html>
<html>
<head>    
    <title>Work Order</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">
    <style>
    .job-details-container{
        height:100px;
        display:block;
    }
    .others-container{
        display:block;
        margin-top:20%;
    }
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;">
    <div style="width: 95%;margin: 0 auto; padding:1%;">
        <div style="margin-bottom:150px;">
            <?php echo $header; ?>
        </div>
        <br />
        <table style="margin-top:10%;">
            <tr>
                <td><img src="<?= getCompanyBusinessProfileImage(); ?>"  style="width: 150px;margin-right:40%;" /></td>
                <td style="width:250px;"><div style="width:300px;display:block;"></div></td>
                <td>
                <b><?php echo $workorder; ?></b> <br />
                <?php 
                    $agent_name = '---';
                    if( $first->FName != '' || $first->LName != '' ){
                        $agent_name = $first->FName.' '.$first->LName;
                    }
                ?>
                Job Tags: <?php echo $tags; ?> <br>
                Date Issued: <?php echo $wDate = $date_issued; ?> <br>
                Priority: <?php echo $priority; ?> <br>
                Password: <?php echo strMask($password); ?> <br>
                Security Number: <?php echo strMask($security_number); ?> <br>                
                Agent: <?php echo $agent_name; ?> <br>
                </td>                
            </tr>
        </table>        
        <div style="margin-top:10%;">
            <table style="width:100%;">
                <tr>
                    <td style="vertical-align:top;">
                        <b>FROM:</b><br>
                        <!-- <hr style="width: 50% !important; align:left !important;"> -->
                        <?php echo $company; ?><br>
                        <?php echo $business_address; ?><br>
                        Email: <?php echo $bussiness_email != '' ? $bussiness_email : '---'; ?><br>
                        Phone: <?php echo $phone_number != '' ? $phone_number : '---'; ?><br><br>
                    </td>
                    <td style="vertical-align:top;">
                        <b>TO:</b><br>
                        <?php echo $acs_name; ?><br>
                        Email: <?php echo $email != '' ? $email : '---'; ?><br>
                        Phone: <?php echo $phone != '' ? $phone : '---'; ?><br>
                        Mobile: <?php echo $mobile != '' ? $mobile : '---'; ?><br><br>
                    </td>
                </tr>
            </table>               
            <div class="job-details-container">
                <b>JOB DETAILS:</b>
                <hr>
                <table class="table">
                    <tr>
                        <td style="width:100px;">Job Name</td>
                        <td>: <?php echo $job_name != '' ? $job_name : '---'; ?></td>
                        <td style="width:100px;">&nbsp;</td>
                        <td style="width:100px;">Installation Date</td>
                        <td>: <?php echo date("m/d/Y", strtotime($installation_date)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr>                        
                        <td style="width:100px;">Status</td>
                        <td>: <?php echo $status; ?></td>
                        <td style="width:100px;">&nbsp;</td>
                        <td style="width:100px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width:100px;">Job Description</td>
                        <td colspan="4">: <?php echo $job_description; ?></td>
                    </tr>
                </table>
            </div>
            <br><br>
            <b>ITEMS:</b>
            <hr>
            <table class="pure-table" style="width:100%;">
                <tr style="background-color: #E9DDFF !important;">
                    <th>Items</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Total</th>
                </tr>
                <tbody>
                    <?php foreach($items as $item){ ?>
                    <tr>
                        <td><?php echo $item->title; ?></td>
                        <td><?php echo $item->qty; ?></td>
                        <td style="text-align:right;"><?php echo number_format($item->costing,2); ?></td>
                        <td style="text-align:right;"><?php echo $item->discount > 0 ? number_format($item->discount,2) : '0.00'; ?></td>
                        <td style="text-align:right;"><?php echo number_format($item->tax,2); ?> </td>
                        <td style="text-align:right;"><?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo number_format($b,2); ?></td>
                    </tr>
                    <?php } ?>
                    <tr style="background-color: #F7F4FF !important;">
                        <td colspan="5" style="background-color: #F8F8F8 !important;">Subtotal</td>
                        <td style="background-color: #F8F8F8 !important;text-align:right;"><?php echo number_format($subtotal,2); ?></td>
                    </tr>
                    <tr style="background-color: #E9DDFF !important;">
                        <td colspan="5" style="background-color: #F8F8F8 !important;">Taxes</td>
                        <td style="background-color: #F8F8F8 !important;text-align:right;"><?php echo number_format($taxes,2); ?></td>
                    </tr>
                    <?php if( $adjustment_value > 0 ){ ?>
                    <tr style="background-color: #F3F3F3 !important;">
                        <td style="background-color: #F8F8F8 !important;" colspan="5"><?php echo $adjustment_name; ?></td>
                        <td style="background-color: #F8F8F8 !important;text-align:right;"><?php echo $adjustment_value; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if( $otp_setup > 0 ){ ?>
                    <tr style="background-color: #F3F3F3 !important;">
                        <td style="background-color: #F8F8F8 !important;" colspan="5">One Time Program and Setup</td>
                        <td style="background-color: #F8F8F8 !important;text-align:right;"><?php echo $otp_setup; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if( $monthly_monitoring > 0 ){ ?>
                    <tr style="background-color: #F3F3F3 !important;">
                        <td style="background-color: #F8F8F8 !important;" colspan="5">Monthly Monitoring</td>
                        <td style="background-color: #F8F8F8 !important;text-align:right;"><?php echo $monthly_monitoring; ?></td>
                    </tr>
                    <?php } ?>
                    <tr style="background-color: #F3F3F3 !important;">
                        <td style="background-color: #F8F8F8 !important;" colspan="5"><b>Grand Total</b></td>
                        <td style="background-color: #F8F8F8 !important;text-align:right;"><b><?php echo number_format($total,2); ?></b></td>
                    </tr>
                </tbody>
            </table>
            <br /><br />
            <b>TERMS & CONDITIONS:</b>
            <hr>
            <?php echo strip_tags($terms_and_conditions); ?>
            <br /><br />
            <b>TERMS OF USE:</b>
            <hr>
            <?php echo strip_tags($terms_of_use); ?>
            <br /><br />            
            <b>INSTRUCTIONS:</b>
            <hr>
            <?php echo strip_tags($instructions); ?><br><br>            
            <br /><br />
            <b>PAYMENT DETAILS:</b>
            <hr>
            <table class="table">
                <tr>
                    <td>                        
                        <?php echo 'Amount: '.$amount; ?><br>
                        <?php 
                        if($payment_method ==  'Cash'){
                            echo 'Payment Method: Cash';
                        }
                        elseif($payment_method ==  'Check')
                        {
                            echo 'Payment Method: Check';
                            echo '<br> Check Number: '. $check_number;
                            echo '<br> Rounting Number: '. $routing_number;
                            echo '<br> Account Number: '. $account_number;
                        }
                        elseif($payment_method ==  'Credit Card')
                        {
                            echo 'Payment Method: Credit Card';
                            echo '<br> Credit Number: '. $credit_number;
                            echo '<br> Credit Expiry: '. $credit_expiry;
                            echo '<br> CVC: '. $credit_cvc;
                        }
                        elseif($payment_method ==  'Debit Card')
                        {
                            echo 'Payment Method: Debit Card';
                            echo '<br> Credit Number: '. $credit_number;
                            echo '<br> Credit Expiry: '. $credit_expiry;
                            echo '<br> CVC: '. $credit_cvc;
                        }
                        elseif($payment_method ==  'ACH')
                        {
                            echo 'Payment Method: Debit Card';
                            echo '<br> Routing Number: '. $routing_number;
                            echo '<br> Account Number: '. $account_number;
                        }
                        elseif($payment_method ==  'Venmo')
                        {
                            echo 'Payment Method: Venmo';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                            echo '<br> Confirmation: '. $confirmation;
                        }
                        elseif($payment_method ==  'Paypal')
                        {
                            echo 'Payment Method: Paypal';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                            echo '<br> Confirmation: '. $confirmation;
                        }
                        elseif($payment_method ==  'Square')
                        {
                            echo 'Payment Method: Square';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                            echo '<br> Confirmation: '. $confirmation;
                        }
                        elseif($payment_method ==  'Invoicing')
                        {
                            echo 'Payment Method: Invoicing';
                            echo '<br> Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street;
                        }
                        elseif($payment_method ==  'Warranty Work')
                        {
                            echo 'Payment Method: Warranty Work';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        elseif($payment_method ==  'Home Owner Financing')
                        {
                            echo 'Payment Method: Home Owner Financing';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        elseif($payment_method ==  'e-Transfer')
                        {
                            echo 'Payment Method: e-Transfer';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        elseif($payment_method ==  'Other Credit Card Professor')
                        {
                            echo 'Payment Method: Other Credit Card Professor';
                            echo '<br> Credit Number: '. $credit_number;
                            echo '<br> Credit Expiry: '. $credit_expiry;
                            echo '<br> CVC: '. $credit_cvc;
                        }
                        elseif($payment_method ==  'Other Payment Type')
                        {
                            echo 'Payment Method: Other Payment Type';
                            echo '<br> Account Credential: '. $account_credentials;
                            echo '<br> Account Note: '. $account_note;
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <br />
            <b>ASSIGNED TO:</b>
            <hr><br>
            <table>
                <tr>
                    <td align="center" style="padding:10px;">
                        <?php if( trim($company_representative_signature) != '' ){ ?>
                            <img src="<?php echo base_url($company_representative_signature); ?>" style="width:100px;"><br>
                            <?php echo $first->FName.' '.$first->LName; ?>
                        <?php } ?>
                    </td>
                    
                    <td align="center" style="padding:10px;">
                        <?php if( trim($primary_account_holder_signature) != '' ){ ?>
                            <img src="<?php echo base_url($primary_account_holder_signature); ?>" style="width:100px;"><br>
                            <?php echo $primary_account_holder_name; ?>
                        <?php } ?>
                    </td>
                    
                    <td align="center" style="padding:10px;">
                        <?php if( trim($secondary_account_holder_signature) != '' ){ ?>
                            <img src="<?php echo base_url($secondary_account_holder_signature); ?>" style="width:100px;"><br>
                            <?php echo $secondary_account_holder_name; ?>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <br>
        </div>
    </div>
</body>
</html>
