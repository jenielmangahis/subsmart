<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Tickets</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">
    
    <link href="<?php echo base_url() ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style>
        /* body
        {
            margin:5px;
        } */
table {
 border-collapse: collapse;
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
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto; padding:1%;">
        <div style="text-align: justify; text-justify: inter-word;">
            <!-- This workorder agreement (the "agreement") is made as of 05-07-2021, by and between ADI Smart Home, (the "Company") and the ("Customer") as the address shown below (the "Premise/Service") -->
            <?php echo $header; ?>
        </div>
        <br>
        <div style="float:left;">
            <img src="<?php echo base_url().'assets/img/alarm_logo.jpeg' ?>" class="company-logo2" style="width:100px;"/> 

        </div>  
        <div class="" style="float: right;">
                            <table class="table-borderless mustRight">
                                <tr>
                                    <td colspan="2" style="text-align: center;"><h4><b>Service Ticket</b></h4></td>
                                </tr>
                                <tr>
                                    <td>Ticket no:</td>
                                    <td><?php echo $ticket_no; ?></td>
                                </tr>
                                <tr>
                                    <td>Scheduled Date:</td>
                                    <td><?php echo $ticket_date; ?></td>
                                </tr>
                                <tr>
                                    <td>Scheduled Time:</td>
                                    <td><?php echo $scheduled_time.' to '.$scheduled_time_to; ?></td>
                                </tr>
                                <tr>
                                    <td>Purchase Order No:</td>
                                    <td><?php echo $purchase_order_no; ?></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td><?php echo $ticket_status; ?></td>
                                </tr>
                            </table>
        </div>
        <br><br><br><br><br><br><br>
        <div>
            <h6><?php echo $bname; ?></h6>
            <span><?php echo $baddress; ?></span> <br>
            <span><?php echo $bcity; ?></span>, <span><?php echo $bstate; ?></span>, <span><?php echo $bzip_code; ?></span> <br>
            <span><?php echo $bemail; ?></span> <br>
            <span><?php echo $bphone_h; ?></span> <br>
        </div>
        <br>
        <div>
            <h6><?php echo $name; ?></h6>
            <span><?php echo $mail_add; ?></span> <br>
            <span><?php echo $city; ?></span>, <span><?php echo $state; ?></span>, <span><?php echo $zip_code; ?></span> <br>
            <span><?php echo $email; ?></span> <br>
            <span><?php echo $phone_h; ?></span> <br>
        </div>
                <div style="float:right;text-align:center;border:solid gray 1px;padding:2px;width:200px;">
                    <b>Sales Representative</b> <br>
                    <?php echo $repsName; ?><br>
                    <?php echo $sales_rep_no; ?><br>
                    <span>Team Lead/Mentor</span>: 
                    <?php echo $tl_mentor; ?>
                </div>
        <br>
        <div>
            <h6>Service Location:</h6>
            <span><?php echo $service_location; ?></span> <br>
        </div>
                <br>
                <table style="width:100%;">
                    <tr>
                        <td style="border:solid gray 1px;text-align:center;padding:3px;"><b>Job Tag </b> <br> <?php echo $job_tag; ?></td>
                        <td style="border:solid gray 1px;text-align:center;padding:3px;"><b>Panel Type </b> <br> <?php echo $panel_type; ?></td>
                        <td style="border:solid gray 1px;text-align:center;padding:3px;"><b>Service Type </b> <br> <?php echo $service_type; ?></td>
                        <td style="border:solid gray 1px;text-align:center;padding:3px;"><b>Warranty Type</b> <br> <?php echo $warranty_type; ?></td>
                    </tr>
                </table>
                <!-- <div class="row" style="font-size:16px;">
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Job Tag </b> <br>
                        <?php //echo $job_tag; ?>
                    </div>
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Panel Type </b> <br>
                        <?php //echo $panel_type; ?>
                    </div>
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Service Type </b> <br>
                        <?php //echo $service_type; ?>
                    </div>
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Warranty Type</b> <br>
                        <?php //echo $warranty_type; ?>
                    </div>
                </div> -->
        <br>
        <div>
            
                        <table class="table table-bordered">
                            <tr style="background-color: #F3F3F3;">
                                <th>#</th>
                                <th>Items</th>
                                <th>Item Type</th>
                                <th style="text-align:center;">Price</th>
                                <th style="text-align:center;">Qty</th>
                                <th style="text-align:center;">Discount</th>
                                <th style="text-align:center;">Total</th>
                            </tr>
                            <!-- <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> -->
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
                            <!-- </tbody> -->
                        </table>
        </div>

                    <div style="float:right;">
                        <table class="" style="width:40%;">
                            <tr style="font-weight:bold;">
                                <td>Subtotal</td>
                                <td style="text-align:right;">$<?php echo number_format($subtotal,2); ?></td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td>Taxes</td>
                                <td style="text-align:right;">$<?php echo number_format($taxes,2); ?></td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td>Adjustment: <?php echo $adjustment; ?></td>
                                <td style="text-align:right;">$<?php echo number_format($adjustment_value,2); ?></td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td>Markup</td>
                                <td style="text-align:right;">$<?php echo number_format($markup,2); ?></td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td>Grand Total</td>
                                <td style="text-align:right;">$<?php echo number_format($grandtotal,2); ?></td>
                            </tr>
                        </table>
                    </div>
        <div id="paymentAreaDet">
                        <table class="table-borderless" style="width:30%;">
                            <tr>
                                <td><b>Payment Method: </b></td>
                                <td style="text-align:;"><?php echo $payment_method; ?></td>
                            </tr>
                            <tr>
                                <td><b>Payment Amount: </b></td>
                                <td style="text-align:;">$<?php echo number_format($payment_amount,2); ?></td>
                            </tr>
                            <tr>
                                <td><b>Billing Date: </b></td>
                                <td style="text-align:;"><?php echo $billing_date; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <?php 
                                // $payment_method                 = $tickets->payment_method;
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
        <!-- <br>
        <div style="float:right;">
                        
        </div> -->
        <br><br>
        <div id="techArea">
                    <b>Assigned Technicians</b> <br><br>
                        <?php //echo $technicians; 
                        $assigned_technician = unserialize($technicians);
                        // var_dump($assigned_technician);
                            foreach($assigned_technician as $eid){
                                $user = getUserName($eid);
                                echo $custom_html = '<img src="'.userProfileImage($eid).'" style="width: 60px;">'.$user['name'].'<br>';
                            }
                        ?>
        </div>
        
        <br>
                <div class="row" style="font-size:;">
                    <div class="col-md-12">
                        <b>Service Description:</u></b> <br> <?php if(empty($service_description)){ echo 'N/A'; }else{ echo $ervice_description; } ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:;">
                    <div class="col-md-12">
                        <b>Message:</u></b> <br><?php if(empty($message)){ echo 'N/A'; }else{ echo $message; } ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:;">
                    <div class="col-md-12">
                        <b>Terms and Conditions:</u></b> <br> <?php echo $terms_conditions; ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:;">
                    <div class="col-md-12">
                        <b>Attachments:</u></b> <br> <?php if(empty($attachments)){ echo 'N/A'; }else{ echo $attachments; } ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:;">
                    <div class="col-md-12">
                        <b>Instructions:</u></b> <br> <?php if(empty($instructions)){ echo 'N/A'; }else{ echo $instructions; } ?> 
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:;">
                    <div class="col-md-12">
                        <span><b>Warranty Repair Service.</b> During the term of your agreement, we will repair or service any defective part of the System as follows: (A) What is covered. If you to renewal your Premium warranty Service, then we will, so long as you are providing services contract. If you decline the Premium Service, however, then you agree to pay to <?php echo $bname; ?> or its assignee the Grand Total Value of the service. So as long as we are providing service pursuant to your agreement, you will agree to a visit charge for each service call, and you agree to pay the same. We can use new or used parts of the same functionality and keep all replaced parts. (B) What is not covered: Act of God and any non-normal conditions. </span>
                    </div>
                </div>


    </div>
</body>
</html>
