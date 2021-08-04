<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">
    <style>
        /* body
        {
            margin:5px;
        } */
table {
 border-collapse: collapse;
}
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto; padding:1%;">
        <div style="text-align: justify; text-justify: inter-word;">
            <!-- This workorder agreement (the "agreement") is made as of 05-07-2021, by and between ADI Smart Home, (the "Company") and the ("Customer") as the address shown below (the "Premise/Service") -->
            <?php echo $header; ?>
        </div>

        <div class="" style="float: right;">
            <h3>WORK ORDER <br> # <?php echo $workorder; ?></h3>
            <br>
            Job Tags: <?php echo $tags; ?> <br>
            Date Issued: <?php echo $wDate = $date_issued; ?> <br>
            Priority: <?php echo $priority; ?> <br>
            Password: <?php echo $password; ?> <br>
            Security Number: <?php echo $security_number; ?> <br>
            <!-- Custom Field: <?php //echo $security_number; ?> <br> -->
            Source: <?php echo $source_name; ?> <br>
            Agent: <?php echo $first->FName.' '.$first->LName; ?> <br>
            <!-- Contacts: <br> -->
				
        </div>


        <div style="padding: 2%;">
        <img src="<?php echo base_url('uploads/users/business_profile/'.$company_id.'/'.$business_logo); ?>" style="width:110px;height:80px;">
        </div>

        <div style="margin-top:5%">

            <div>
                <b>FROM:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $company; ?><br>
                License: <?php echo $business_address; ?><br>
                <?php echo $business_address; ?><br>
                Phone: <?php echo $phone_number; ?><br><br>
            </div>

            <div>
                <b>CUSTOMER:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $acs_name; ?><br>
                <?php if(!empty($business_name)){ echo $business_name.'<br>'; } ?>
                <?php if(!empty($job_location)){ echo $job_location.'<br>'; } ?>
                <?php if(!empty($job_location2)){ echo $job_location2.'<br>'; } ?>
                Email: <?php echo $email; ?><br>
                Phone: <?php echo $phone; ?><br>
                Mobile: <?php echo $mobile; ?><br><br>
            </div>

            <div>
                <b>ADDITIONAL:</b>
                <hr><br>
                <?php if($template == '1'){ ?>
                <?php foreach($customs as $c){ ?>
                    <?php if(empty($c->value)){ }else{ ?>
                        <?php echo $c->name; ?>: <?php echo $c->value; ?><br>
                    <?php } ?>
                <?php } 
                }
                else{ ?>
                <?php if(!empty($first_verification_name)){ echo $first_verification_name.'<br>'; } ?> 
                <?php if(!empty($first_number)){ echo $first_number.'<br>'; } ?>
                <?php if(!empty($first_relation)){ echo $first_relation.'<br><br>'; } ?>

				<?php if(!empty($second_verification_name)){ echo $second_verification_name.'<br>'; } ?>
                <?php if(!empty($second_number)){ echo $second_number.'<br>'; } ?>
                <?php if(!empty($second_relation)){ echo $second_relation.'<br><br>'; } ?>

				<?php if(!empty($third_verification_name)){ echo $third_verification_name.'<br>'; } ?>
                <?php if(!empty($third_number)){ echo $third_number.'<br>'; } ?>
                <?php if(!empty($third_relation)){ echo $third_relation.'<br><br>'; } ?>


                <?php }
                ?>
                <br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS & CONDITIONS:</b>
                <hr>
                <?php echo $terms_and_conditions; ?>
            </div>


            <div class=""><br>
                <b>JOB DETAILS:</b>
                <hr><center>
                <div align="center">
                <table class="pure-table" style="border-collapse: collapse !important;align:center !important;width:100%;">
                    <tr style="background-color: #E9DDFF !important;">
                        <th>Items</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                        </tr>
                        <?php foreach($items as $item){ ?>
                        <tr>
                            <td data-column=""><?php echo $item->title; ?></td>
                            <td data-column=""><?php echo $item->qty; ?></td>
                            <td data-column=""><?php echo $item->costing; ?></td>
                            <td data-column=""><?php //echo $item->discount; ?>0</td>
                            <td data-column=""><?php echo $item->tax; ?> </td>
                            <td data-column=""><?php //echo $item->total; 
                             $a = $item->qty * $item->costing; $b = $a + $item->tax; echo $b; ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="background-color: #F7F4FF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Subtotal</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $subtotal; ?></td>
                        </tr>
                        <tr style="background-color: #E9DDFF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Taxes</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $taxes; ?></td>
                        </tr>
                        <?php if(empty($adjustment_value)){  } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><?php echo $adjustment_name; ?></td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $adjustment_value; ?></td>
                        </tr>
                        <?php } ?>
                        <?php if(empty($voucher_value)){  } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Voucher</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $voucher_value; ?></td>
                        </tr>
                        <?php } ?>
                        <?php if(empty($otp_setup)){ } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">One Time Program and Setup</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $otp_setup; ?></td>
                        </tr>
                        <?php } ?>
                        <?php if(empty($monthly_monitoring)){ } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Monthly Monitoring</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $monthly_monitoring; ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><b>Grand Total</b></td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><b><?php echo $total; ?></b></td>
                        </tr>
                    </tbody>
                </table></div></center>
            </div>

            <br><br>
            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS OF USE:</b>
                <hr>
                <?php echo $terms_of_use; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>JOB DESCRIPTION:</b>
                <hr>
                <?php echo $job_description; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>INSTRUCTIONS:</b>
                <hr>
                <?php echo $instructions; ?><br><br>
            </div>

            <!-- <div style="text-align: justify; text-justify: inter-word;">
                <b>ACCEPTED PAYMENT METHODS:</b>
                <hr>
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
                </ul> 
                <br><br><br>
            </div> -->

            <div style="text-align: justify; text-justify: inter-word;">
                <b>PAYMENT DETAILS:</b>
                <hr>
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
                <br><br><br>
            </div>

            <div>
                <b>ASSIGNED TO:</b>
                <hr><br>
                <table>
                    <tr>
                        <td align="center">
                            <?php if(empty($company_representative_signature)){ } else{ ?>
                            <img src="<?php echo base_url($company_representative_signature); ?>" style="width:30%;height:80px;"><br>
                            <?php echo $first->FName.' '.$first->LName; ?>
                            <?php } ?>
                        </td>
                        
                        <td align="center">
                            <?php if(empty($primary_account_holder_signature)){ } else{ ?>
                            <img src="<?php echo base_url($primary_account_holder_signature); ?>" style="width:30%;height:80px;"><br>
                            <?php echo $second->FName.' '.$second->LName; ?>
                            <?php } ?>
                        </td>
                        
                        <td align="center">
                            <?php if(empty($secondary_account_holder_signature)){ } else{ ?>
                            <img src="<?php echo base_url($secondary_account_holder_signature); ?>" style="width:30%;height:80px;"><br>
                            <?php echo $third->FName.' '.$third->LName; ?>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <br>
            </div>

        </div>

    </div>
</body>
</html>
