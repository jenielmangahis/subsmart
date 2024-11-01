
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('v2/includes/header'); ?>

<!-- <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap.min.css") ?>"  type="text/css" media="print"> -->

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
        <i class="bx bx-note"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_tickets_tabs'); ?>
    </div>
    <div class="col-12">        
        <div style="float:right;padding-right:10%;">
            <a href="<?= base_url('tickets/editDetails/'.$tickets->id); ?>" class="nsm-button">Edit</a>
            <a href="<?php echo base_url('share_Link/ticketsPDF/' . $tickets->id) ?>" class="nsm-button success">Download as PDF</a> 
            <a href="#" class="nsm-button success" id="printServiceTicket" onclick="printDiv('printableArea')">Print</a>
        </div>
        <div class="nsm-page" style="padding-left:10%;padding-right:10%;padding-top:1%;" id="printArea">
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

                @media (max-width: 1366px) {
                    .lamesa { 
                        font-size:9px !important; 
                        width:125% !important;
                        margin-left: -35px !important;
                    }
                }
            </style>
            <div class="" style="padding:2%;">
                <!-- <div class="row">
                    <div class="col-md-3">
                        <br>
                        <?php //echo $tickets->id; ?>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <div class="">
                            <div style="text-align: center;border:solid gray 1px;">
                                <h5>Ticket no</h5><hr>
                                <h5><?php //echo $tickets->ticket_no; ?></h5>
                            </div>
                            <div style="font-size:16px;">
                            
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-4" style="text-align:center;">
                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 130px; max-height: 130px;" class="compLogo"/> 
                    </div>
                    <!-- <div class="col-md-4 spaceDiv"></div> -->
                    <div class="col-md-8">
                        <table class="nsm-table">
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Ticket no:</td>
                                    <td style="width: 60%;"><?php echo $tickets->ticket_no ? $tickets->ticket_no : '-'; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Scheduled Date:</td>
                                    <td style="width: 60%;">
                                        <?php 
                                            $date = '---';
                                            if( strtotime($tickets->ticket_date) > 0 ){
                                                $date =  date("m/d/Y", strtotime($tickets->ticket_date)); 
                                            }
                                        ?>
                                        <?php echo $date ? $date : '-'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Scheduled Time:</td>
                                    <td style="width: 60%;"><?php echo $tickets->scheduled_time.' to '.$tickets->scheduled_time_to; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Purchase Order No:</td>
                                    <td style="width: 60%;"><?php echo $tickets->purchase_order_no ? $tickets->purchase_order_no : '-'; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Status:</td>
                                    <td style="width: 60%;"><?php echo $tickets->ticket_status ? $tickets->ticket_status : '-'; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Business Name:</td>
                                    <td style="width: 60%;"><?php echo $tickets->business_name ? $tickets->business_name : '-'; ?></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <br><br>

                <?php if(!empty($clients)) { ?>

                    <div class="row">
                        <div class="col-md-6 nsm-callout primary">
                            <div style="font-size:16px;">
                                <b><?php echo $clients->business_name; ?></span></b> <br>
                                <span><?php echo $clients->street .' '. $clients->city .', '. $clients->state .' '. $clients->postal_code; ?></span><br>
                                <?php echo $clients->business_email; ?><br>
                                <?php echo formatPhoneNumber($clients->business_phone); ?>
                            </div>
                        </div>
                        <div class="col-md-6 nsm-callout primary">
                            <div style="font-size:16px;">
                                <b><span><?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?></span></b><br>
                                <span><?php echo $tickets->mail_add .' '. $tickets->city .', '. $tickets->state .' '. $tickets->zip_code; ?></span><br>
                                <span><?php echo $tickets->email; ?></span><br>
                                <span><?php echo formatPhoneNumber($tickets->phone_m); ?></span>
                            </div>
                        </div>
                    </div>
                    <br>                    

                <?php } ?>

                <div class="row">
                    <div class="nsm-card primary">
                        <div class="row">
                            <div class="col-md-8 serviceLocDiv">
                                <b>Service Location: </b> <br>
                                <?php echo $tickets->service_location; ?>
                            </div>
                            <div class="col-md-4 salesRepArea" style="text-align:center;border:solid #6a4a86 1px;">
                                <b>Sales Representative</b> <br>
                                <?php echo $reps->FName.' '.$reps->LName; ?><br>
                                <?php echo $tickets->sales_rep_no; ?><br>
                                <span>Team Lead/Mentor</span>: 
                                <?php echo $tickets->tl_mentor; ?>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="font-size:16px;">
                            <div class="col-md-12">
                                <table class="table table-bordered lamesa">
                                    <thead style="background-color: #F3F3F3;">
                                        <th style="text-align:center;">Job Tag</th>
                                        <th style="text-align:center;">Panel Type</th>
                                        <th style="text-align:center;">Service Type</th>
                                        <th style="text-align:center;">Warranty Type</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align:center;"><?php echo $tickets->job_tag; ?></td>
                                            <td style="text-align:center;"><?php echo $tickets->panel_type; ?></td>
                                            <td style="text-align:center;"><?php echo $tickets->service_type; ?></td>
                                            <td style="text-align:center;"><?php echo $tickets->warranty_type; ?></td>
                                        </tr>
                                    </tbody>
                                </table>                    
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered lamesa">
                                    <thead style="background-color: #F3F3F3;">
                                        <!-- <th>#</th> -->
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
                                            <!-- <td><?php //echo $i; ?></td> -->
                                            <td><?php echo $item->title; ?></td>
                                            <td><?php echo $item->item_type; ?></td>
                                            <td style="text-align:center;">$<?php echo number_format($item->costing,2); ?></td>
                                            <td style="text-align:center;"><?php echo $item->qty; ?></td>
                                            <td style="text-align:center;">$<?php echo '0'.number_format($item->discount,2); ?></td>
                                            <td style="text-align:center;">$<?php echo number_format($item->total,2); ?></td>
                                        </tr>
                                        <?php 
                                            $i++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 paymentArea">
                                <table class="table table-borderless" style="width:100%;">
                                    <tr>
                                        <td><b>Payment Method: </b></td>
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
                                        <td><b>Payment Details:</b></td>
                                        <td>
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
                                                $payment_ammount                = $payment->billing_frequency != null ? $payment->billing_frequency : '0.00';

                                                if($payment_method ==  'Cash'){
                                                    echo 'Amount Paid: '. $payment_ammount;
                                                }
                                                elseif($payment_method ==  'Check')
                                                {
                                                    echo 'Check Number: '. $check_number;
                                                    echo '<br> Rounting Number: '. $routing_number;
                                                    echo '<br> Account Number: '. $account_number;
                                                }
                                                elseif($payment_method ==  'Credit Card')
                                                {
                                                    echo 'Credit Number: '. $credit_number;
                                                    echo '<br> Credit Expiry: '. $credit_expiry;
                                                    echo '<br> CVC: '. $credit_cvc;
                                                }
                                                elseif($payment_method ==  'Debit Card')
                                                {
                                                    echo 'Credit Number: '. $credit_number;
                                                    echo '<br> Credit Expiry: '. $credit_expiry;
                                                    echo '<br> CVC: '. $credit_cvc;
                                                }
                                                elseif($payment_method ==  'ACH')
                                                {
                                                    echo 'Routing Number: '. $routing_number;
                                                    echo '<br> Account Number: '. $account_number;
                                                }
                                                elseif($payment_method ==  'Venmo')
                                                {
                                                    echo 'Account Credential: '. $account_credentials;
                                                    echo '<br> Account Note: '. $account_note;
                                                    echo '<br> Confirmation: '. $confirmation;
                                                }
                                                elseif($payment_method ==  'Paypal')
                                                {
                                                    echo 'Account Credential: '. $account_credentials;
                                                    echo '<br> Account Note: '. $account_note;
                                                    echo '<br> Confirmation: '. $confirmation;
                                                }
                                                elseif($payment_method ==  'Square')
                                                {
                                                    echo 'Account Credential: '. $account_credentials;
                                                    echo '<br> Account Note: '. $account_note;
                                                    echo '<br> Confirmation: '. $confirmation;
                                                }
                                                elseif($payment_method ==  'Invoicing')
                                                {
                                                    echo 'Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street;
                                                }
                                                elseif($payment_method ==  'Warranty Work')
                                                {
                                                    echo 'Account Credential: '. $account_credentials;
                                                    echo '<br> Account Note: '. $account_note;
                                                }
                                                elseif($payment_method ==  'Home Owner Financing')
                                                {
                                                    echo 'Account Credential: '. $account_credentials;
                                                    echo '<br> Account Note: '. $account_note;
                                                }
                                                elseif($payment_method ==  'e-Transfer')
                                                {
                                                    echo 'Account Credential: '. $account_credentials;
                                                    echo '<br> Account Note: '. $account_note;
                                                }
                                                elseif($payment_method ==  'Other Credit Card Professor')
                                                {
                                                    echo 'Credit Number: '. $credit_number;
                                                    echo '<br> Credit Expiry: '. $credit_expiry;
                                                    echo '<br> CVC: '. $credit_cvc;
                                                }
                                                elseif($payment_method ==  'Other Payment Type')
                                                {
                                                    echo 'Account Credential: '. $account_credentials;
                                                    echo '<br> Account Note: '. $account_note;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div class="col-md-4 spaceDiv">
                            </div>
                            <div class="col-md-4 summaryArea">
                                <table class="table table-bordered">
                                    <tr style="font-weight:bold;">
                                        <td>Subtotal</td>
                                        <td style="text-align:right;">$<?php echo number_format($tickets->subtotal,2); ?></td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td>Taxes</td>
                                        <td style="text-align:right;">$<?php if(empty($tickets->taxes)){ echo '0';} echo number_format($tickets->taxes,2); ?></td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td>Adjustment: <?php echo $tickets->adjustment; ?></td>
                                        <td style="text-align:right;">$<?php if(empty($tickets->adjustment_value)){ echo '0';} echo number_format($tickets->adjustment_value,2); ?></td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td>Markup</td>
                                        <td style="text-align:right;">$<?php if(empty($tickets->markup)){ echo '0';} echo number_format($tickets->markup,2); ?></td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td>Grand Total</td>
                                        <td style="text-align:right;">$<?php echo number_format($tickets->grandtotal,2); ?></td>
                                    </tr>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>
                
                <div class="nsm-card primary">
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-3">
                            <b>Assigned Technicians</b> <br>
                            <?php
                                $assigned_technician = unserialize($tickets->technicians);
                                if($assigned_technician){
                                    foreach($assigned_technician as $eid){
                                        $user = getUserName($eid);
                                        echo $custom_html = '<img src="'.userProfileImage($eid).'" style="width: 60px; border-radius: 10px;">&nbsp;'.$user['name'].'<br>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Service Description:</u></b> <br> <?php if(empty($tickets->service_description)){ echo 'N/A'; }else{ echo $tickets->service_description; } ?>
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Message:</u></b> <br><?php if(empty($tickets->message)){ echo 'N/A'; }else{ echo $tickets->message; } ?>
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Terms and Conditions:</u></b> <br> <?php echo $tickets->terms_conditions; ?>
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Attachments:</u></b> <br> <?php if(empty($tickets->attachments)){ echo 'N/A'; }else{ echo $tickets->attachments; } ?>
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <b>Instructions:</u></b> <br> <?php if(empty($tickets->instructions)){ echo 'N/A'; }else{ echo $tickets->instructions; } ?> 
                        </div>
                    </div>
                    <hr />
                    <div class="row" style="font-size:16px;">
                        <div class="col-md-12">
                            <span><b>Warranty Repair Service.</b> During the term of your agreement, we will repair or service any defective part of the System as follows: (A) What is covered. If you to renewal your Premium warranty Service, then we will, so long as you are providing services contract. If you decline the Premium Service, however, then you agree to pay to <?php echo $ticketsCompany->business_name; ?> or its assignee the Grand Total Value of the service. So as long as we are providing service pursuant to your agreement, you will agree to a visit charge for each service call, and you agree to pay the same. We can use new or used parts of the same functionality and keep all replaced parts. (B) What is not covered: Act of God and any non-normal conditions. </span>
                        </div>
                    </div>
                </div>

            </div>

            <div id="printableArea" class="" style="width:100% !important; display:none;">
                <div class="invoice-paper" id="presenter-paper">
                    <div id="" style="width:100%">
                    
                        <style>
                            #background
                            {
                                position:absolute;
                                z-index:0;
                                display:block;
                                margin-top: -100px;
                                margin-left: 20%;
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

                            #tbl-sales-rep #td-sales-rep {
                                text-align: center; background: #f4f4f4 !important; padding: 8px 0;
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
                                                <p style="margin: 0"><b><?php echo $clients->business_name; ?></b></p>
                                                <p style="margin: 0"><?php echo $clients->street; ?></p>
                                                <p style="margin: 0"><?php echo $clients->city; ?>, <?php echo $clients->state; ?> <?php echo $clients->postal_code; ?></p>
                                                <p style="margin: 0">Email: <?php echo strtolower($clients->business_email) != 'not specified' ? strtolower($clients->business_email) : ''; ?></p>
                                                <p style="margin: 0">Phone: <?php echo strtolower(formatPhoneNumber($clients->business_phone)); ?></p>
                                                <br>
                                            </div>

                                        </td>
                                        <td id="presenter-col-right" class="presenter-col-right" style="width: 50%; text-align: right;" valign="top">
                                            <div id="presenter-title-container" class="presenter-title-container" style="margin-top: 10px; margin-bottom: 20px;">
                                                <span class="presenter-title" style="font-size: 25pt;color:#8c97c0;">Service Ticket</span><br>
                                            </div>
                                            <div id="presenter-summary" class="presenter-summary">
                                                <table style="width: 100%">
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align: right;">Ticket No:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                                <?php echo $tickets->ticket_no ? $tickets->ticket_no : '-';; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">Scheduled Date:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                                <?php 
                                                                    $date = '-';
                                                                    if( strtotime($tickets->ticket_date) > 0 ){
                                                                        $date =  date("m/d/Y", strtotime($tickets->ticket_date)); 
                                                                    }
                                                                ?>
                                                                <?php echo $date ? $date : '-'; ?>                                               
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">Scheduled Time:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $tickets->scheduled_time.' to '.$tickets->scheduled_time_to; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">Purchase Order No:</td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $tickets->purchase_order_no ? $tickets->purchase_order_no : '-'; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;"><b>Status:</b></td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><b><?php echo $tickets->ticket_status ? $tickets->ticket_status : '-'; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;"><b>Business Name:</b></td>
                                                            <td style="width: 160px; text-align: right;" class="text-right"><b><?php echo $tickets->business_name ? $tickets->business_name : '-'; ?></b></td>
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
                                            <p style="margin: 0"><b><?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?></b></p>
                                            <p style="margin: 0"><?php echo $tickets->mail_add; ?></p>
                                            <p style="margin: 0"><?php echo $tickets->city; ?></span>, <span><?php echo $tickets->state; ?></span> <span><?php echo $tickets->zip_code; ?></p>
                                            <p style="margin: 0">Email: <?php echo strtolower($tickets->email) != 'not specified' ? strtolower($tickets->email) : ''; ?></p>
                                            <p style="margin: 0">Phone: <?php echo formatPhoneNumber($tickets->phone_m); ?></p>
                                        </td>
                                        <td style="width: 70%" valign="top"></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <div id="background">
                                <p id="bg-text"><?php echo $tickets->ticket_status; ?></p>
                            </div>

                            <br><br>

                            <br><br>
                            <div class="table-items-container">
                                <table class="table-print table-items tbl-sales-rep" id="tbl-sales-rep" style="width: 100%; border-collapse: collapse; font-size: 12px">
                                    <tbody>
                                        <tr class="table-items__tr">
                                            <td colspan="4" style="text-align: left; background: #ffffff !important; padding: 8px 0;" >
                                                <p><b>Service Location: </b><br />
                                                <?php echo $tickets->service_location; ?></p>
                                            </td>
                                            <td colspan="1" id="td-sales-rep" class="td-sales-rep" style="" >
                                                <b>Sales Representative</b> <br>
                                                <?php echo $reps->FName.' '.$reps->LName; ?><br>
                                                <?php echo formatPhoneNumber($tickets->sales_rep_no); ?><br>
                                                <span>Team Lead/Mentor</span>: 
                                                <?php echo $tickets->tl_mentor; ?>                                               
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
                                                <?php echo $tickets->job_tag ? $tickets->job_tag : '-'; ?>
                                            </td>
                                            <td style="text-align: center;" valign="top">
                                                <?php echo $tickets->panel_type ? $tickets->panel_type : '-'; ?>
                                            </td>
                                            <td style="text-align: center;" valign="top">
                                                <?php echo $tickets->service_type ? $tickets->service_type : '-'; ?>                  
                                            </td>
                                            <td style="text-align: center;" valign="top">
                                                <?php echo $tickets->warranty_type ? $tickets->warranty_type : '-'; ?>               
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                            <br><br>

                            <div class="table-items-container">
                                <?php $total_tax = 0; ?>
                                <table class="table table-bordered lamesa" style="width: 100%; border-collapse: collapse; font-size: 12px">
                                    <thead style="">
                                        <tr>
                                            <th style="background: #f4f4f4; text-align: center;">#</th>
                                            <th style="background: #f4f4f4; text-align: left;">Items</th>
                                            <th style="background: #f4f4f4; text-align: left; ">Item Type</th>
                                            <th style="background: #f4f4f4; text-align: center;">Price</th>
                                            <th style="background: #f4f4f4; text-align: center;">Qty</th>
                                            <th style="background: #f4f4f4; text-align: center;">Discount</th>
                                            <th style="background: #f4f4f4; text-align: right;" class="text-right">Total</th>
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
                                        <?php $i++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="text-align: left"><b>Payment Method: </b</td>
                                            <td colspan="2" style="text-align: left"><?php echo $tickets->payment_method; ?></td>
                                            <td colspan="2" style="text-align: right"><b>Subtotal</b></td>
                                            <td style="text-align: right">$<?php echo number_format($tickets->subtotal,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: left"><b>Payment Amount: </b</td>
                                            <td colspan="2" style="text-align: left">$<?php echo number_format($tickets->payment_amount,2); ?></td>
                                            <td colspan="2" style="text-align: right"><b>Taxes</b></td>
                                            <td style="text-align: right">$<?php if(empty($tickets->taxes)){ echo '0';} echo number_format($tickets->taxes,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: left"><!-- <b>Billing Date: </b>--></td>
                                            <td colspan="2" style="text-align: left"><?php //echo $tickets->billing_date ? $tickets->billing_date : '-'; ?></td>
                                            <td colspan="2" style="text-align: right"><b>Adjustment<?php echo $tickets->adjustment ? ': ' . $tickets->adjustment : ''; ?></b></td>
                                            <td style="text-align: right">$<?php echo number_format($tickets->adjustment_value,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: left"><!-- <b>Others: </b--></td>
                                            <td colspan="2" style="text-align: left">                              
                                            </td>
                                            <td colspan="2" style="text-align: right"><b>Markup</b></td>
                                            <td style="text-align: right">$<?php echo number_format($tickets->markup,2); ?></td>
                                        </tr>
                                        <?php $mmr = 0; ?>
                                        <?php if($invoiceD->monthly_monitoring != null && $invoiceD->monthly_monitoring > 0) { $mmr = $invoiceD->monthly_monitoring?>
                                        <tr>
                                            <td colspan="2" style="text-align: left"></td>
                                            <td colspan="2" style="text-align: left">                              
                                            </td>
                                            <td colspan="2" style="text-align: right"><b>MMR</b></td>
                                            <td style="text-align: right">$<?php echo number_format($invoiceD->monthly_monitoring,2); ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php $icost = 0; ?>
                                        <?php if($invoiceD->installation_cost != null && $invoiceD->installation_cost > 0) { $icost = $invoiceD->installation_cost; ?>
                                        <tr>
                                            <td colspan="2" style="text-align: left"></td>
                                            <td colspan="2" style="text-align: left">                              
                                            </td>
                                            <td colspan="2" style="text-align: right"><b>Installation Cost</b></td>
                                            <td style="text-align: right">$<?php echo number_format($invoiceD->installation_cost,2); ?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2" style="text-align: right; background: #f4f4f4;"><b>Grand Total</b></td>
                                            <td style="text-align: right; background: #f4f4f4;"><b>$<?php echo number_format($tickets->grandtotal + $mmr + $icost,2); ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br><br>
                            <hr style="border-color:#eaeaea;">
                            <div id="techArea" style="">
                                <b>Assigned Technicians</b> <br><br>
                                <?php
                                $assigned_technician = unserialize($tickets->technicians);
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

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
<script src="<?php echo $url->assets ?>js/jquery.signaturepad.js"></script>
<?php include viewPath('v2/includes/footer'); ?>
<?php //include viewPath('includes/footer'); ?>

<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>