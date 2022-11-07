<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('v2/includes/header'); ?>

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
        <div class="nsm-page" style="padding-left:10%;padding-right:10%;padding-top:1%;">
            <div class="nsm-page-content" style="box-shadow: 0.5rem 0.5rem #6a4a86, -0.5rem -0.5rem #E8E2EE;padding:2%;">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 200px; max-height: 180px;" class=""/> 
                        <?php //echo $tickets->id; ?>
                    </div>
                    <div class="col-md-6">
                        <div style="float:right;">
                            <div style="text-align:right;">
                                <h1>Tickets</h1>
                                <h4><?php echo $tickets->ticket_no; ?></h4>
                            </div>
                            <br>
                            <div style="font-size:16px;">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Scheduled Date:</td>
                                    <td><?php echo $tickets->ticket_date; ?></td>
                                </tr>
                                <tr>
                                    <td>Scheduled Time:</td>
                                    <td><?php echo $tickets->ticket_no; ?></td>
                                </tr>
                                <tr>
                                    <td>Purchase Order No:</td>
                                    <td><?php echo $tickets->purchase_order_no; ?></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td><?php echo $tickets->ticket_status; ?></td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>From</h4>
                        <div style="font-size:16px;">
                            <span><?php echo $ticketsCompany->business_name; ?></span><br>
                            <span><b>Name:</b> <?php echo $ticketsCompany->first_name .' '. $ticketsCompany->last_name; ?></span><br>
                            <span><b>Address:</b> <?php echo $ticketsCompany->business_address; ?></span><br>
                            <span><b>Email:</b> <?php echo $ticketsCompany->email_address; ?></span><br>
                            <span><b>Contact:</b> <?php echo $ticketsCompany->phone_number; ?></span><br>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <h4>To</h4>
                        <div style="font-size:16px;">
                            <span><b>Name:</b> <?php echo $tickets->first_name .' '. $tickets->middle_name .' '. $tickets->last_name; ?></span><br>
                            <span><b>Address:</b> <?php echo $tickets->mail_add .' '. $tickets->city .' '. $tickets->state .' '. $tickets->zip_code; ?></span><br>
                            <span><b>Email:</b> <?php echo $tickets->email; ?></span><br>
                            <span><b>Contact:</b> <?php echo $tickets->phone_h; ?></span><br>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead style="background-color: #E4D6FA;">
                                <th>#</th>
                                <th>Items</th>
                                <th>Item Type</th>
                                <th style="text-align:center;">Price</th>
                                <th style="text-align:center;">Qty</th>
                                <th style="text-align:center;">Discount</th>
                                <th style="text-align:center;">Total</th>
                            </thead>
                            <tbody>
                                <?php foreach($items as $item){ ?>
                                <tr>
                                    <td>#</td>
                                    <td><?php echo $item->title; ?></td>
                                    <td><?php echo $item->item_type; ?></td>
                                    <td style="text-align:center;"><?php echo $item->cost; ?></td>
                                    <td style="text-align:center;"><?php echo $item->qty; ?></td>
                                    <td style="text-align:center;"><?php echo $item->discount; ?></td>
                                    <td style="text-align:center;"><?php echo $item->total; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-4">
                        <table class="table">
                            <tr>
                                <td>Subtotal</td>
                                <td style="text-align:right;"><?php echo $tickets->subtotal; ?></td>
                            </tr>
                            <tr>
                                <td>Taxes</td>
                                <td style="text-align:right;"><?php echo $tickets->taxes; ?></td>
                            </tr>
                            <tr>
                                <td>Adjustment: <?php echo $tickets->adjustment; ?></td>
                                <td style="text-align:right;"><?php echo $tickets->adjustment_value; ?></td>
                            </tr>
                            <tr>
                                <td>Markup</td>
                                <td style="text-align:right;"><?php echo $tickets->markup; ?></td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td style="text-align:right;"><?php echo $tickets->grandtotal; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Service Description:</u></b> <br> <?php echo $tickets->service_description; ?>
                    </div>
                </div>
                <br><br><br>
                <div class="row" style="font-size:16px;text-align:center;">
                    <div class="col-md-6">
                        Service Location <br><b><?php echo $tickets->service_location; ?></b>
                    </div>
                    <div class="col-md-6">
                        Job Tag <br> <b><?php echo $tickets->job_tag; ?></b>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;text-align:center;">
                    <div class="col-md-4">
                        Panel Type <br> <b><?php echo $tickets->panel_type; ?></b>
                    </div>
                    <div class="col-md-4">
                        Service Type <br> <b><?php echo $tickets->service_type; ?></b>
                    </div>
                    <div class="col-md-4">
                        Warranty Type <br> <b><?php echo $tickets->warranty_type; ?></b>
                    </div>
                </div>
                <br><br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-6">
                        <table class="table" style="width:50%;">
                            <tr>
                                <td><b>Payment Method: </b></td>
                                <td><?php echo $tickets->payment_method; ?></td>
                            </tr>
                            <tr>
                                <td><b>Payment Amount: </b></td>
                                <td>$<?php echo number_format($tickets->payment_amount,2); ?></td>
                            </tr>
                            <tr>
                                <td><b>Billing Date: </b></td>
                                <td><?php echo $tickets->billing_date; ?></td>
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
                    <div class="col-md-6">
                        <table class="table" style="width:50%;float:right;">
                            <tr>
                                <td><b>Sales Representative</b></td>
                                <td><?php echo $tickets->sales_rep; ?></td>
                            </tr>
                            <tr>
                                <td><b>Contact No. </b></td>
                                <td><?php echo $tickets->sales_rep_no; ?></td>
                            </tr>
                            <tr>
                                <td><b>Team Lead/Mentor</b></td>
                                <td><?php echo $tickets->tl_mentor; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Message:</u></b> <br> <?php echo $tickets->message; ?>
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
                        <b>Attachments:</u></b> <br> <?php echo $tickets->attachments; ?>
                    </div>
                </div>
                <br><br>
                <div class="row" style="font-size:16px;">
                    <div class="col-md-12">
                        <b>Instructions:</u></b> <br> <?php echo $tickets->instructions; ?>
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