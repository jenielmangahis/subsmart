<div class="" style="width:100% !important;">
    <div class="invoice-paper" id="presenter-paper">
        <div  id="printableArea" style="width:100%">
        
            <style>
                #background
                {
                    position:absolute;
                    z-index:0;
                    /* background:white; */
                    display:block;
                    /* min-height:80%;  */
                    margin-top: -100px;
                    margin-left: 20%;
                    /* min-width:60%; */
                    color:yellow;
                }

                #bg-text
                {
                    color:lightgreen;
                    font-size:150px;
                    transform:rotate(300deg);
                    -webkit-transform:rotate(300deg);
                    opacity: 0.4;
                }
            </style>

            <div class="presenter-paper-sm" id="presenter-paper-sm"></div>
            <div class="invoice-print" style="background: #ffffff;">
                <table class="table-print" style="width: 100%; margin-bottom: 10px;">
                    <tbody>
                        <tr>
                            <td>
                                <div style="margin-bottom: 20px;">
                                    <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px" />
                                </div>

                                <div id="presenter-from">
                                        <p style="margin: 0"><b><?php echo $bname ?></b></p>
                                        <p style="margin: 0"><?php echo $baddress ?></p>
                                        <p style="margin: 0"><?php echo $bcity; ?></p>
                                        <p style="margin: 0">Email: <?php echo strtolower($bemail) ?></p>
                                        <p style="margin: 0">Phone: <?php echo strtolower(formatPhoneNumber($bphone_h)) ?></p>

                                        <!-- <table>
                                            <tbody><tr>
                                                <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                                <td>
                                                    <?php//echo strtolower($user->phone) ?><br><br><br>                          
                                                </td>
                                            </tr>
                                        </tbody></table> -->

                                        <br>
                                </div>

                            </td>
                            <td id="presenter-col-right" class="presenter-col-right" style="width: 50%; text-align: right;" valign="top">
                                <div id="presenter-title-container" class="presenter-title-container" style="margin-top: 10px; margin-bottom: 20px;">
                                    <span class="presenter-title" style="font-size: 25pt;color:#8c97c0;">Service Ticket</span><br>
                                    <!-- <span style="font-size:16px;"># <?php //echo 'Invoice # here..'; ?></span> -->
                                </div>
                                <div id="presenter-summary" class="presenter-summary">
                                    <table style="width: 100%">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: right;">Ticket No:</td>
                                                <td style="width: 160px; text-align: right;" class="text-right">
                                                    <?php echo $ticket_no; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Scheduled Date:</td>
                                                <td style="width: 160px; text-align: right;" class="text-right">
                                                    <?php //echo get_format_date($ticket_date); ?>
                                                    <?php 
                                                        $date = '---';
                                                        if( strtotime($ticket_date) > 0 ){
                                                            $date =  date("m/d/Y", strtotime($ticket_date)); 
                                                        }       
                                                        echo $date;                                         
                                                    ?>                                                
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Scheduled Time:</td>
                                                <td style="width: 160px; text-align: right;" class="text-right"><?php echo $scheduled_time.' to '.$scheduled_time_to; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">Purchase Order No:</td>
                                                <td style="width: 160px; text-align: right;" class="text-right"><?php echo $purchase_order_no ? $purchase_order_no : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;"><b>Status:</b></td>
                                                <td style="width: 160px; text-align: right;" class="text-right"><b><?php echo $ticket_status ? $ticket_status : '-'; ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <table class="table-print" style="width: 100%;margin-top: -60px;">
                    <tbody>
                        <tr>
                            <td style="width: 30%" valign="top">
                                <p style="margin: 0"><b><?php echo $name; ?></b></p>
                                <p style="margin: 0"><?php echo $mail_add; ?><!-- <span class="middot">·</span> --></p>
                                <p style="margin: 0"><?php echo $city; ?></span>, <span><?php echo $state; ?></span>, <span><?php echo $zip_code; ?></p>
                                <p style="margin: 0"><?php echo $email; ?></p>
                                <p style="margin: 0">Phone: <?php echo formatPhoneNumber($phone_h); ?></p>
                                <!-- <table>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                            <td>
                                                <?php //echo $phone_h ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> -->
                            </td>
                            <td style="width: 70%" valign="top"></td>
                        </tr>
                    </tbody>
                </table>
                
                <div id="background">
                    <p id="bg-text"><?php echo $ticket_status; ?></p>
                </div>

                <br><br>

                <br><br>
                <div class="table-items-container">
                    <table class="table-print table-items" style="width: 100%; border-collapse: collapse; font-size: 12px">
                        <tbody>
                            <tr class="table-items__tr">
                                <td colspan="4" style="text-align: left; background: #ffffff; padding: 8px 0;" >
                                    <p><b>Service Location: </b><br />
                                    <?php echo $service_location; ?></p>
                                </td>
                                <td colspan="1" style="text-align: center; background: #f4f4f4; padding: 8px 0;" >
                                    <b>Sales Representative</b> <br>
                                    <?php echo $repsName; ?><br>
                                    <?php echo formatPhoneNumber($sales_rep_no); ?><br>
                                    <span>Team Lead/Mentor</span>: 
                                    <?php echo $tl_mentor; ?>                                               
                                </td>
                            </tr>  
                        </tbody>
                    </table>
                </div>
                <br>
                <br>

                <div class="table-items-container">
                    <table class="table-print table-items" style="width: 100%; border-collapse: collapse; font-size: 12px">
                        <thead>
                            <tr>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Job Tag</th>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Panel Type</th>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Service Type</th>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Warranty Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-items__tr">
                                <td style="text-align:center;" valign="top">
                                    <?php echo $job_tag ? $job_tag : '-'; ?>
                                </td>
                                <td style="text-align: center;" valign="top">
                                    <?php echo $panel_type ? $panel_type : '-'; ?>
                                </td>
                                <td style="text-align: center;" valign="top">
                                    <?php echo $service_type ? $service_type : '-'; ?>                  
                                </td>
                                <td style="text-align: center;" valign="top">
                                    <?php echo $warranty_type ? $warranty_type : '-'; ?>               
                                </td>
                            </tr>  
                        </tbody>
                    </table>
                </div>
                <br><br>

                <div class="table-items-container">
                    <?php $total_tax = 0; ?>
                    <table class="table-print table-items" style="width: 100%; border-collapse: collapse; font-size: 12px">
                        <thead>
                            <tr>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th>
                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Items</th>
                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Item Type</th>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Price</th>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Qty</th>
                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Discount</th>
                                <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($items as $item){ ?>
                                <tr class="table-items__tr">
                                    <td style="text-align:center;" valign="top"><?php echo $i; ?></td>
                                    <td style="text-align: left;" valign="top"><?php echo $item->title; ?></td>
                                    <td style="text-align: left;" valign="top"><?php echo $item->item_type; ?></td>
                                    <td style="text-align: center;" valign="top">$<?php echo number_format($item->costing,2); ?></td>
                                    <td style="text-align: center;" valign="top"><?php echo $item->qty; ?></td>
                                    <td style="text-align: center;" valign="top">$<?php echo number_format($item->discount,2); ?></td>
                                    <td style="text-align: right;" valign="top">$<?php echo number_format($item->total,2); ?></td>
                                </tr>
                                <tr class="table-items__tr-last">
                                    <td></td>
                                    <td colspan="6"></td>
                                </tr>
                            <?php $i++; } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: left"><b>Payment Method: </b</td>
                                <td colspan="2" style="text-align: left"><?php echo $payment_method; ?></td>
                                <td colspan="2" style="text-align: right"><b>Subtotal</b></td>
                                <td style="text-align: right">$<?php echo number_format($subtotal,2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: left"><b>Payment Amount: </b</td>
                                <td colspan="2" style="text-align: left">$<?php echo number_format($payment_amount,2); ?></td>
                                <td colspan="2" style="text-align: right"><b>Taxes</b></td>
                                <td style="text-align: right">$<?php echo number_format($taxes,2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: left"><b>Billing Date: </b</td>
                                <td colspan="2" style="text-align: left"><?php echo $billing_date ? $billing_date : '-'; ?></td>
                                <td colspan="2" style="text-align: right"><b>Adjustment<?php echo $adjustment ? ': ' . $adjustment : ''; ?></b></td>
                                <td style="text-align: right">$<?php echo number_format($adjustment_value,2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: left"><b>Others: </b</td>
                                <td colspan="2" style="text-align: left">
                                    <?php 
                                        //$payment_method                 = $tickets->payment_method;
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
                                        $payment_ammount                = $payment->billing_frequency != null ? $payment->billing_frequency : '0.00';

                                        if($payment_method ==  'Cash'){
                                            //echo '<b>Payment Details:</b>';
                                            echo 'Amount Paid: '. $payment_ammount;
                                        }
                                        elseif($payment_method ==  'Check')
                                        {
                                            // echo 'Payment Method: Check';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Check Number: '. $check_number;
                                            echo '<br> Rounting Number: '. $routing_number;
                                            echo '<br> Account Number: '. $account_number;
                                        }
                                        elseif($payment_method ==  'Credit Card')
                                        {
                                            // echo 'Payment Method: Credit Card';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Credit Number: '. $credit_number;
                                            echo '<br> Credit Expiry: '. $credit_expiry;
                                            echo '<br> CVC: '. $credit_cvc;
                                        }
                                        elseif($payment_method ==  'Debit Card')
                                        {
                                            // echo 'Payment Method: Debit Card';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Credit Number: '. $credit_number;
                                            echo '<br> Credit Expiry: '. $credit_expiry;
                                            echo '<br> CVC: '. $credit_cvc;
                                        }
                                        elseif($payment_method ==  'ACH')
                                        {
                                            // echo 'Payment Method: Debit Card';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Routing Number: '. $routing_number;
                                            echo '<br> Account Number: '. $account_number;
                                        }
                                        elseif($payment_method ==  'Venmo')
                                        {
                                            // echo 'Payment Method: Venmo';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Account Credential: '. $account_credentials;
                                            echo '<br> Account Note: '. $account_note;
                                            echo '<br> Confirmation: '. $confirmation;
                                        }
                                        elseif($payment_method ==  'Paypal')
                                        {
                                            // echo 'Payment Method: Paypal';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Account Credential: '. $account_credentials;
                                            echo '<br> Account Note: '. $account_note;
                                            echo '<br> Confirmation: '. $confirmation;
                                        }
                                        elseif($payment_method ==  'Square')
                                        {
                                            // echo 'Payment Method: Square';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Account Credential: '. $account_credentials;
                                            echo '<br> Account Note: '. $account_note;
                                            echo '<br> Confirmation: '. $confirmation;
                                        }
                                        elseif($payment_method ==  'Invoicing')
                                        {
                                            // echo 'Payment Method: Invoicing';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street;
                                        }
                                        elseif($payment_method ==  'Warranty Work')
                                        {
                                            // echo 'Payment Method: Warranty Work';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Account Credential: '. $account_credentials;
                                            echo '<br> Account Note: '. $account_note;
                                        }
                                        elseif($payment_method ==  'Home Owner Financing')
                                        {
                                            // echo 'Payment Method: Home Owner Financing';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Account Credential: '. $account_credentials;
                                            echo '<br> Account Note: '. $account_note;
                                        }
                                        elseif($payment_method ==  'e-Transfer')
                                        {
                                            // echo 'Payment Method: e-Transfer';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Account Credential: '. $account_credentials;
                                            echo '<br> Account Note: '. $account_note;
                                        }
                                        elseif($payment_method ==  'Other Credit Card Professor')
                                        {
                                            // echo 'Payment Method: Other Credit Card Professor';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Credit Number: '. $credit_number;
                                            echo '<br> Credit Expiry: '. $credit_expiry;
                                            echo '<br> CVC: '. $credit_cvc;
                                        }
                                        elseif($payment_method ==  'Other Payment Type')
                                        {
                                            // echo 'Payment Method: Other Payment Type';
                                            //echo '<b>Payment Details:</b>';
                                            echo '<br> Account Credential: '. $account_credentials;
                                            echo '<br> Account Note: '. $account_note;
                                        }
                                    ?>                                
                                </td>
                                <td colspan="2" style="text-align: right"><b>Markup</b></td>
                                <td style="text-align: right">$<?php echo number_format($markup,2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="2" style="text-align: right; background: #f4f4f4; padding: 8px 0"><b>Grand Total</b></td>
                                <td style="text-align: right; background: #f4f4f4; padding: 8px 8px 8px 0;"><b>$<?php echo number_format($grandtotal,2); ?></b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <br><br>
                <hr style="border-color:#eaeaea;">
                <div id="techArea" style="">
                    <b>Assigned Technicians</b> <br><br>
                    <?php
                    $assigned_technician = unserialize($technicians);
                    if($assigned_technician) {
                        foreach($assigned_technician as $eid){
                            $user = getUserName($eid);
                            echo $custom_html = '<div style="vertical-align: middle"><img src="'.userProfileImage($eid).'" style="width: 40px; border-radius: 10px;">&nbsp;'.$user['name'].'</div>';
                        }                    
                    } else {
                        echo "-";                    
                    }
                    ?>
                </div>
                            
                <br><br>
                <hr style="border-color:#eaeaea;">
                <p style="color:#888; margin: 0">
                    Business powered by nSmarTrac
                </p>
            </div>
        </div>
    </div>
</div>
<style>
.print {
    width: 43%;
    margin: auto;
}

.print-body {
    padding: 20px;
}

.phone-input {
  margin-bottom: 8px;
}

.phone-input>.input-group-btn>button.dropdown-toggle {

  height: 46px !important;
  background: #fff;
  border: 2px solid #e0e0e0;
  border-right: 0;
}

.phone-input>.input-group-btn>.dropdown-menu {

  padding: 15px;
}

.invoice-paper {
  box-shadow: 0 0 6px #ccc;
  position: relative;
  margin-bottom: 5px;
  font-size: 10.5pt;
  font-family: Sans-Serif;
}

.invoice-print,
.invoice-print table {
  font-size: 10.5pt;
  font-family: Sans-Serif;
}

.table-items .table-items__tr td {
  padding: 8px 0;
  background: #ffffff;
  border: none;
  font-family: Sans-Serif;
}

.table-items .table-items__tr-last td {
  background: #ffffff;
  border-bottom: 1px solid #eaeaea;
  color: #555;
  height: 1px;
  padding: 0;
  font-family: Sans-Serif;
}

.table-items .table-items__tr-last-border td {
  padding: 8px 0;
  background: #ffffff;
  border-bottom: 1px solid #eaeaea;
}
/*** ribbon ***/
.ribbon {
  position: absolute;
  left: -8px;
  top: -8px;
  z-index: 1;
  overflow: hidden;
  width: 100px;
  height: 100px;
  text-align: right;
}

.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  line-height: 26px;
  transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
  width: 130px;
  display: block;
  position: absolute;
  top: 24px;
  left: -28px;
  background: #9BC90D;
}

.ribbon span::before {
  content: "";
  position: absolute;
  left: 0px;
  top: 100%;
  z-index: -1;
  border: 5px solid #79A70A;
  border-left-color: #79A70A;
  border-right-color: transparent;
  border-bottom-color: transparent;
  border-top-color: #79A70A;
}

.ribbon span::after {
  content: "";
  position: absolute;
  right: 0px;
  top: 100%;
  z-index: -1;
  border: 5px solid #79A70A;
  border-left-color: transparent;
  border-bottom-color: transparent;
  border-right-color: #79A70A;
  border-top-color: #79A70A;
}

.ribbon-pending span,
.ribbon-draft span {
  color: #415667;
  background: #bdc4ce;
}

.ribbon-pending span::before,
.ribbon-draft span::before {
  border-left-color: #acb5c1;
  border-top-color: #acb5c1;
}

.ribbon-pending span::after,
.ribbon-draft span::after {
  border-right-color: #acb5c1;
  border-top-color: #acb5c1;
}

.ribbon-overdue span,
.ribbon-canceled span {
  color: #6b5426;
  background: #f0a528;
}

.ribbon-overdue span::before,
.ribbon-canceled span::before {
  border-left-color: #ef9d14;
  border-top-color: #ef9d14;
}

.ribbon-overdue span::after,
.ribbon-canceled span::after {
  border-right-color: #ef9d14;
  border-top-color: #ef9d14;
}

.ribbon-paid span {
  color: #275025;
  background: #86c365;
}

.ribbon-paid span::before {
  border-left-color: #7fbf5c;
  border-top-color: #7fbf5c;
}

.ribbon-paid span::after {
  border-right-color: #7fbf5c;
  border-top-color: #7fbf5c;
}

.panel-info {
  background: #f2f2f2;
  border-top: 1px solid #eaeaea;
  border-bottom: 1px solid #eaeaea;
  padding: 20px 30px;
}

.btn-print {
    display: inline-block;
    padding: 7px 25px;
    background: #fff;
    border: 1px solid #cccccc;
    color: #333;
    text-decoration: none;
    border-radius: 2px;
    font-size: 16px;
    font-family: Sans-Serif;
}
</style>