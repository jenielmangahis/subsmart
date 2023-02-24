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
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12">        
        <div style="float:right;padding-right:10%;">
            <a href="<?= base_url('tickets/editDetails/'.$tickets->id); ?>" class="btn btn-primary">Edit</a>
            <a href="<?php echo base_url('share_Link/ticketsPDF/' . $tickets->id) ?>" class="btn btn-success">Download as PDF</a> <a href="#" class="btn btn-primary" id="printServiceTicket" onclick="printDiv('printArea')">Print</a>
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
                <div class="row">
                    <div class="col-md-3">
                       <br><br>
                        <?php //echo $tickets->id; ?>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-3">
                        <div class="">
                            <!-- <div style="text-align: center;border:solid gray 1px;">
                                <h5>Ticket no</h5><hr>
                                <h5><?php //echo $tickets->ticket_no; ?></h5>
                            </div> -->
                            <div style="font-size:16px;">
                            
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 130px; max-height: 130px;" class="compLogo"/> 
                    </div>
                    <div class="col-md-4 spaceDiv">
                    </div>
                    <div class="col-md-4 summaryArea">
                        <table class="">
                            <tr style="font-weight:;">
                                <td>Ticket no:</td>
                                <td style="text-align:right;"><?php echo $tickets->ticket_no; ?></td>
                            </tr>
                            <tr style="font-weight:;">
                                <td>Scheduled Date:</td>
                                <td style="text-align:right;"><?php echo $tickets->ticket_date; ?></td>
                            </tr>
                            <tr style="font-weight:;">
                                <td>Scheduled Time:</td>
                                <td style="text-align:right;"><?php echo $tickets->scheduled_time.' to '.$tickets->scheduled_time_to; ?></td>
                            </tr>
                            <tr style="font-weight:;">
                                <td>Purchase Order No:</td>
                                <td style="text-align:right;"><?php echo $tickets->purchase_order_no; ?></td>
                            </tr>
                            <tr style="font-weight:;">
                                <td>Status:</td>
                                <td style="text-align:right;"><?php echo $tickets->ticket_status; ?></td>
                            </tr>
                            <tr style="font-weight:;">
                                <td>Business Name:</td>
                                <td style="text-align:right;"><?php echo $tickets->business_name; ?></td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <h4>From</h4> -->
                        <div style="font-size:16px;">
                            <b><?php echo $clients->business_name; ?></span></b> <br>
                            <span><?php echo $clients->street .' <br>'. $clients->city .', '. $clients->state .' '. $clients->postal_code; ?></span><br>
                            <?php echo $clients->email_address; ?><br>
                            <?php echo $clients->phone_number; ?>
                        </div>
                    <!-- </div>
                </div> -->
                <br>
                <!-- <div class="row">
                    <div class="col-md-4"> -->
                        <!-- <h4>To</h4> -->
                        <div style="font-size:16px;">
                            <b><span><?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?></span></b><br>
                            <span><?php echo $tickets->mail_add .' <br>'. $tickets->city .', '. $tickets->state .' '. $tickets->zip_code; ?></span><br>
                            <span><?php echo $tickets->email; ?></span><br>
                            <span><?php echo $tickets->phone_h; ?></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9 serviceLocDiv">
                        <b>Service Location: </b> <br>
                        <?php echo $tickets->service_location; ?>
                    </div>
                    <div class="col-md-3 salesRepArea" style="text-align:center;border:solid gray 1px;">
                        <b>Sales Representative</b> <br>
                        <?php echo $reps->FName.' '.$reps->LName; ?><br>
                        <?php echo $tickets->sales_rep_no; ?><br>
                        <span>Team Lead/Mentor</span>: 
                        <?php echo $tickets->tl_mentor; ?>
                    </div>
                </div>
                <br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Job Tag </b> <br>
                        <?php echo $tickets->job_tag; ?>
                    </div>
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Panel Type </b> <br>
                        <?php echo $tickets->panel_type; ?>
                    </div>
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Service Type </b> <br>
                        <?php echo $tickets->service_type; ?>
                    </div>
                    <div class="col-md-3 descriptionTags" style="border:solid gray 1px;text-align:center;">
                        <b>Warranty Type</b> <br>
                        <?php echo $tickets->warranty_type; ?>
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
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-3">
                        <b>Assigned Technicians</b> <br>
                        <?php //echo $technicians; 
                        $assigned_technician = unserialize($tickets->technicians);
                        if($assigned_technician){
                        // var_dump($assigned_technician);
                            foreach($assigned_technician as $eid){
                                $user = getUserName($eid);
                                echo $custom_html = '<img src="'.userProfileImage($eid).'" style="width: 60px;">'.$user['name'].'<br>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Service Description:</u></b> <br> <?php if(empty($tickets->service_description)){ echo 'N/A'; }else{ echo $tickets->service_description; } ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Message:</u></b> <br><?php if(empty($tickets->message)){ echo 'N/A'; }else{ echo $tickets->message; } ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Terms and Conditions:</u></b> <br> <?php echo $tickets->terms_conditions; ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Attachments:</u></b> <br> <?php if(empty($tickets->attachments)){ echo 'N/A'; }else{ echo $tickets->attachments; } ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Instructions:</u></b> <br> <?php if(empty($tickets->instructions)){ echo 'N/A'; }else{ echo $tickets->instructions; } ?> 
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <span><b>Warranty Repair Service.</b> During the term of your agreement, we will repair or service any defective part of the System as follows: (A) What is covered. If you to renewal your Premium warranty Service, then we will, so long as you are providing services contract. If you decline the Premium Service, however, then you agree to pay to <?php echo $ticketsCompany->business_name; ?> or its assignee the Grand Total Value of the service. So as long as we are providing service pursuant to your agreement, you will agree to a visit charge for each service call, and you agree to pay the same. We can use new or used parts of the same functionality and keep all replaced parts. (B) What is not covered: Act of God and any non-normal conditions. </span>
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