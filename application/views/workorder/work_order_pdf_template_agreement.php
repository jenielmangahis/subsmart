<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <!-- <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css"> -->
    <!-- <link href="<?php echo base_url() ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <style>
        body
        {
            font-size:8px;
        }
        table, th, td {
            border: 1px solid gray;
            border-collapse: collapse;
        }
        /* .table2 table, th, td {
            border: 0px solid white;
            border-collapse: collapse;
        } */
        hr {
            border: none;
            height: 1px;
            /* Set the hr color */
            color: #333; /* old IE */
            background-color: #333; /* Modern Browsers */
            /* margin-top:-2px; */
            /* margin-bottom:-2px; */
        }
        @page{margin:2px}
/* table {
 border-collapse: collapse;
}

.left,
.right {
  display: inline-block;
  background: red;
} */
    </style>
<style>
</style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 8px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:2px;width: 95%;margin: 0 auto; padding:1%;">

        <div class="" style="float: right;">
            <h6>WORK ORDER <br> # <?php echo $workorder; ?></h6>
        </div>

        <div style="">
            <img src="<?php echo base_url('assets/img/alarm_logo.jpeg'); ?>" style="width:75px;height:75px;">
        </div>

        <!-- <div class="agreement" id="container">     -->         
        <div style="font-size:8px;"><?php echo $header; ?></div>
        <!-- </div> -->
        <!-- <hr> -->
        <table style="border: 0px solid white;border-collapse: collapse;width:100%;font-size:8px;">
            <tr>
                <td style="border: 0px solid white;border-collapse: collapse;">
                    <?php echo $lead_source; ?><hr style="margin-top:0px;margin-bottom:0px;">
                    Lead Source
                </td>
                <td style="border: 0px solid white;border-collapse: collapse;">
                </td>
                <td style="border: 0px solid white;border-collapse: collapse;">
                    <?php echo $account_type; ?><hr style="margin-top:0px;margin-bottom:0px;">
                    Account Type
                </td>
                <td style="border: 0px solid white;border-collapse: collapse;">
                </td>
                <td style="border: 0px solid white;border-collapse: collapse;">
                    <?php echo $panel_communication; ?><hr style="margin-top:0px;margin-bottom:0px;">
                    Communication Type
                </td>
                <td style="border: 0px solid white;border-collapse: collapse;">
                </td>
                <td style="border: 0px solid white;border-collapse: collapse;">
                    <?php echo $panel_type; ?><hr style="margin-top:0px;margin-bottom:0px;">
                    Panel Type
                </td>
                <td style="border: 0px solid white;border-collapse: collapse;">
                    <?php echo $job_tags; ?><hr style="margin-top:0px;margin-bottom:0px;">
                    Job Tags
                </td>
            </tr>
        </table>
        <br>
        
        <!-- <div class="left" id="left" style="float: ;"> -->
                <!-- <center>
                    <div class="front" style="text-align:center;background-color:#4a5594;color:white;border-radius:20px;">
                        <h6>Items</h6>
                    </div>
                </center><br> -->
                <div class="table" style="font-size:9px;">
                    <center>
						<div class="front" style="text-align:center;background-color:#4a5594;color:white;width:350px;font-size:8px;padding:2px;">
							<b>Items</b>
						</div>
					</center>
                    <table style="width:354px;background-color:#ced4e4;font-size:8px;">
                        <tr align="center">
                            <th>Items</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Price</th>
                        </tr>
                            <?php foreach($items as $aItems) { ?>
                            <tr>
                                <td style="font-size:8px;"><?php echo $aItems->item; if($aItems->check_data == NULL){ echo ''; }else{ echo ' ('. $aItems->check_data .') ';} ?></td>
                                <td style="font-size:8px;"><?php echo $aItems->qty ?></td>
                                <td style="font-size:8px;"><?php echo $aItems->location ?></td>
                                <td style="font-size:8px;"><?php echo $aItems->price ?></td>
                            </tr>
                            <?php }?>
                    </table>
                    <br>
                    <table style="border: 0px solid white;border-collapse: collapse;font-size:8px;width:350px;">
                        <tr>
                            <td colspan="2" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($installation_date)){ echo '<br>'; } else{ echo $installation_date; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Installation Date:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($intall_time)){ echo '<br>'; } else{ echo $intall_time; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Install Time Date:</b></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"> </td>
                        </tr> -->
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($payment_method)){ echo '<br>'; } else{ echo $payment_method; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Payment Method:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($amount)){ echo '<br>'; } else{ echo $amount; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Amount ( $ )</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($billing_date)){ echo '<br>'; } else{ echo $billing_date; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Billing Date</b></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"> </td>
                        </tr> -->
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr> -->
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;">
                            <div style="text-align: justify; text-justify: inter-word;font-size:8px;">
                                <!-- <b>PAYMENT DETAILS:</b>
                                <hr> -->
                                    <?php //echo 'Amount: '.$amount; ?>
                                    <?php 
                                    if($payment_method ==  'Cash'){
                                        echo 'Payment Method: Cash';
                                    }
                                    elseif($payment_method ==  'Check')
                                    {
                                        // echo 'Payment Method: Check';
                                        echo '<br> Check Number: '. $check_number;
                                        echo '<br> Rounting Number: '. $routing_number;
                                        echo '<br> Account Number: '. $account_number;
                                    }
                                    elseif($payment_method ==  'Credit Card')
                                    {
                                        // echo 'Payment Method: Credit Card';
                                        echo '<br> Credit Number: '. $credit_number;
                                        echo '<br> Credit Expiry: '. $credit_expiry;
                                        echo '<br> CVC: '. $credit_cvc;
                                    }
                                    elseif($payment_method ==  'Debit Card')
                                    {
                                        // echo 'Payment Method: Debit Card';
                                        echo '<br> Credit Number: '. $credit_number;
                                        echo '<br> Credit Expiry: '. $credit_expiry;
                                        echo '<br> CVC: '. $credit_cvc;
                                    }
                                    elseif($payment_method ==  'ACH')
                                    {
                                        // echo 'Payment Method: Debit Card';
                                        echo '<br> Routing Number: '. $routing_number;
                                        echo '<br> Account Number: '. $account_number;
                                    }
                                    elseif($payment_method ==  'Venmo')
                                    {
                                        // echo 'Payment Method: Venmo';
                                        echo '<br> Account Credential: '. $account_credentials;
                                        echo '<br> Account Note: '. $account_note;
                                        echo '<br> Confirmation: '. $confirmation;
                                    }
                                    elseif($payment_method ==  'Paypal')
                                    {
                                        // echo 'Payment Method: Paypal';
                                        echo '<br> Account Credential: '. $account_credentials;
                                        echo '<br> Account Note: '. $account_note;
                                        echo '<br> Confirmation: '. $confirmation;
                                    }
                                    elseif($payment_method ==  'Square')
                                    {
                                        // echo 'Payment Method: Square';
                                        echo '<br> Account Credential: '. $account_credentials;
                                        echo '<br> Account Note: '. $account_note;
                                        echo '<br> Confirmation: '. $confirmation;
                                    }
                                    elseif($payment_method ==  'Invoicing')
                                    {
                                        // echo 'Payment Method: Invoicing';
                                        echo '<br> Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street;
                                    }
                                    elseif($payment_method ==  'Warranty Work')
                                    {
                                        // echo 'Payment Method: Warranty Work';
                                        echo '<br> Account Credential: '. $account_credentials;
                                        echo '<br> Account Note: '. $account_note;
                                    }
                                    elseif($payment_method ==  'Home Owner Financing')
                                    {
                                        // echo 'Payment Method: Home Owner Financing';
                                        echo '<br> Account Credential: '. $account_credentials;
                                        echo '<br> Account Note: '. $account_note;
                                    }
                                    elseif($payment_method ==  'e-Transfer')
                                    {
                                        // echo 'Payment Method: e-Transfer';
                                        echo '<br> Account Credential: '. $account_credentials;
                                        echo '<br> Account Note: '. $account_note;
                                    }
                                    elseif($payment_method ==  'Other Credit Card Professor')
                                    {
                                        // echo 'Payment Method: Other Credit Card Professor';
                                        echo '<br> Credit Number: '. $credit_number;
                                        echo '<br> Credit Expiry: '. $credit_expiry;
                                        echo '<br> CVC: '. $credit_cvc;
                                    }
                                    elseif($payment_method ==  'Other Payment Type')
                                    {
                                        // echo 'Payment Method: Other Payment Type';
                                        echo '<br> Account Credential: '. $account_credentials;
                                        echo '<br> Account Note: '. $account_note;
                                    }
                                    ?>
                                <!-- <br><br><br> -->
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"> </td>
                        </tr> -->
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr> -->
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($comments)){ echo '<br>'; } else{ echo $comments; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Notes:</b></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"> </td>
                        </tr> -->
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($sales_re_name)){ echo '<br>'; }else{ echo $sales_re_name; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Sales Rep's Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:8px;"><?php if (empty($sales_re_name)){ echo '<br>'; }else{ echo $sale_rep_phone; } ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Cell Phone:</b></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;"> </td>
                        </tr> -->
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td conlspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:8px;" colspan="3"><?php if (empty($sales_re_name)){ echo '<br>'; }else{ echo $team_leader;} ?><hr style="margin-top:0px;margin-bottom:0px;"><b>Team Leader:</b></td>
                        </tr>
                    </table>

                    
                </div>
            <!-- </div>
            <div class="right" id="right" style="float: ;"> -->
                <!-- <center>
                    <div class="front" style="text-align:center;background-color:#4a5594;color:white;border-radius:20px;">
                        <h6>Details:</h6>
                     </div>
                </center> -->
                <div class="table2" style="width:450px;margin-top:-900px;margin-left:380px;font-size:8px;">
                    <table style="border: 0px solid white;border-collapse: collapse;width:350px;font-size:9px;">
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($password)){ echo '<br>'; }else{echo $password;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Password:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($security_number)){ echo '<br>'; }else{echo $security_number;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>SSN:</b></td>
                        </tr>
                    </table>
                    <br>
                    <center>
						<div class="front" style="text-align:center;background-color:#4a5594;color:white;width:350px;padding:2px;">
							<b>Details:</b>
							</div>
					</center>
                    <br>
                    <table style="border: 0px solid white;border-collapse: collapse;width:350px;font-size:8px;">
                        <!-- <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr> -->
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $firstname;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>First name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $lastname;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Last name:</b></td>
                        </tr>
                        <?php if($account_type == 'Commercial'){ ?>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($businessname)){ echo '<br>'; }else{echo $businessname;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Business Name:</b></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname_spouse)){ echo '<br>'; }else{echo $firstname_spouse;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>First name (Spouse):</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($lastname_spouse)){ echo '<br>'; }else{echo $lastname_spouse;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Last name (Spouse):</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($address)){ echo '<br>'; }else{echo $address;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Address:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($city)){ echo '<br>'; }else{echo $city;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>City:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($state)){ echo '<br>'; }else{echo $state;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>State:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($postcode)){ echo '<br>'; }else{echo $postcode;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Postcode:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($county)){ echo '<br>'; }else{echo $county;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>County:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($phone_number)){ echo '<br>'; }else{echo $phone_number;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Phone:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($mobile_number)){ echo '<br>'; }else{echo $mobile_number;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Mobile:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($email)){ echo '<br>'; }else{echo $email;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Email:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($first_ecn)){ echo '<br>'; }else{echo $first_ecn;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>1st Emergency Contact Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($first_ecn_no)){ echo '<br>'; }else{echo $first_ecn_no;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Phone:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($second_ecn)){ echo '<br>'; }else{echo $second_ecn;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>2nd Emergency Contact Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($second_ecn_no)){ echo '<br>'; }else{echo $second_ecn_no;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Phone:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:0px;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($third_ecn)){ echo '<br>'; }else{echo $third_ecn;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>3rd Emergency Contact Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($third_ecn_no)){ echo '<br>'; }else{echo $third_ecn_no;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Phone:</b></td>
                        </tr>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Equipment Cost</b></td>
                            <td style="margin:;padding:6px;"><?php echo $subtotal; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Sales Tax</b></td>
                            <td style="margin:;padding:6px;"><?php echo $taxes; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Installation Cost</b></td>
                            <td style="margin:;padding:6px;"><?php echo $installation_cost; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>One time (Program and Setup)</b></td>
                            <td style="margin:;padding:6px;"><?php echo $otp_setup; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Monthly Monitoring</b></td>
                            <td style="margin:;padding:6px;"><?php echo $monthly_monitoring; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Total Due</b></td>
                            <td style="margin:;padding:6px;"><?php echo $total; ?></td>
                        </tr>
                    </table>
                </div> 
                <!-- <hr style="margin-top:0px;margin-bottom:-1px;"> -->
                <br><br>
                <?php
                if($payment_method ==  'Cash'){
                    
                }
                elseif(empty($payment_method))
                {

                }else{
                    echo '<br><br><br><br><br><br><br>';
                }
                ?>
                <br><br><br><br><br><br>
                <b style="font-size:8px;">Agreement</b>
                <br>
                <div style="font-size:6px;"><?php echo $terms_and_conditions; ?></div>
        
                <b style="font-size:7px;">ASSIGNED TO:</b>
                <hr>
                <table style="border: 0px solid white;border-collapse: collapse;width:100%;">
                    <tr>
                        <td style="border: 0px solid white;border-collapse: collapse;margin:0 0 5px 0;" align="center">
                            <?php if(empty($company_representative_signature)){ echo '<p style="width:200px;height:50px;"> </p>'; } else{ ?>
                            <center><img src="<?php echo base_url($company_representative_signature); ?>" style="width:200px;height:50px;" align="center"></center><br>
                            <?php if(empty($first)){ echo '<br>'; } else{ echo $first; } ?>
                            <hr style="margin-top:0px;margin-bottom:-1px;">
                            <center>Company Representative Approval</center>
                            <?php } ?>
                        </td>
                        
                        <td style="border: 0px solid white;border-collapse: collapse;margin:0 0 5px 0;" align="center">
                            <?php if(empty($primary_account_holder_signature)){ echo '<p style="width:200px;height:50px;"> </p>'; } else{ ?>
                            <center><img src="<?php echo base_url($primary_account_holder_signature); ?>" style="width:200px;height:50px;" align="center"></center><br>
                            <?php if(empty($primary_account_holder_name)){ echo '<br>'; } else{ echo $primary_account_holder_name; } ?>
                            <hr style="margin-top:0px;margin-bottom:-1px;">
                            <center>Primary Account Holder</center>
                            <?php } ?>
                        </td>
                        
                        <td style="border: 0px solid white;border-collapse: collapse;margin:0 0 5px 0;" align="center">
                            <?php if(empty($secondary_account_holder_signature)){ echo '<p style="width:200px;height:50px;"> </p>'; } else{ ?>
                            <center><img src="<?php echo base_url($secondary_account_holder_signature); ?>" style="width:200px;height:50px;" align="center"></center><br>
                            <?php if(empty($secondary_account_holder_name)){ echo '<br>'; } else{ echo $secondary_account_holder_name; } ?>
                            <hr style="margin-top:0px;margin-bottom:-1px;">
                            <center>Secondary Account Holder</center>
                            <?php } ?>
                        </td>
                    </tr>
                </table>

    </div>
</body>
</html>
