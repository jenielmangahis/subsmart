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
            <a href="#" class="nsm-button success" id="printServiceTicket" onclick="printDiv('printArea')">Print</a>
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