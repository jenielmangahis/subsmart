<div class="<?php echo ($format == 'print') ? 'print': '' ?>" style="width:<?php echo ($format == 'print') ? '50%': '100%' ?> !important;">
    <div class="<?php echo ($format == 'print') ? 'invoice-paper print-body': 'invoice-paper' ?>" id="presenter-paper">
    <?php if($format == 'print') : ?>
    <div style="text-align: right; margin-bottom: 10px;">
    <!-- <a class="btn-print" onclick="window.print();" href="#">Print</a> -->
    <a class="btn-print" data-print-modal="open" href="#" onclick="printDiv('printableArea')" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
    </div>
    <?php endif; ?>

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
                                <!-- <img class="invoice-print-logo" style="max-width: 230px; max-height: 200px;" src="<?php echo $profile ?>"> -->
                                <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px" />
                            </div>

                            <div id="presenter-from">
                                    <p style="margin: 0"><b>FROM:</b></p>
                                    <!-- <br> -->
                                    <p style="margin: 0"><b><?= (!empty($company->business_name) && strtoupper(trim($company->business_name)) !== 'NA') ? strtoupper(trim($company->business_name)) : ''; ?></b></p>
                                    <!-- <br> -->
                                    <p style="margin: 0"><?= (!empty($company->street) && strtoupper($company->street) !== 'NA') ? strtoupper($company->street) : ''; ?></p>
                                    <!-- <br> -->
                                    <p style="margin: 0"><?= (!empty($company->city) && !empty($company->state) && !empty($company->postal_code) && strtoupper($company->city . ', ' . $company->state . ' ' . $company->postal_code) !== 'NA') ? strtoupper($company->city . ', ' . $company->state . ' ' . $company->postal_code) : ''; ?></p>
                                    <!-- <br> -->
                                    <p style="margin: 0"><?= (!empty($company->business_email) && strtolower($company->business_email) !== 'na') ? strtolower($company->business_email) : ''; ?></p>
                                    <!-- <br> -->
                                    <p style="margin: 0">TEL: <?= (!empty($company->business_phone) && $company->business_phone !== 'NA') ? formatPhoneNumber($company->business_phone) : '--'; ?></p>
                                    <br>
                            </div>

                        </td>
                        <td id="presenter-col-right" class="presenter-col-right" style="width: 50%; text-align: right;" valign="top">
                            <div id="presenter-title-container" class="presenter-title-container" style="margin-top: 10px; margin-bottom: 20px;">
                                <span class="presenter-title" style="font-size: 25pt;color:#8c97c0;">INVOICE</span><br>
                                <span style="font-size:16px;"># <?php echo $invoice->invoice_number ?></span>
                            </div>
                            <div id="presenter-summary" class="presenter-summary">
                                <table style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right;">Date Issued:</td>
                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                <?php echo get_format_date($invoice->date_issued) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">Date Due:</td>
                                            <td style="width: 160px; text-align: right;" class="text-right">
                                            <?php echo ($invoice->due_date > date('Y-m-d')) ? get_format_date($invoice->due_date) : "Due on Receipt" ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">Type:</td>
                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                <?= (!empty($invoice->invoice_type) && $invoice->invoice_type !== 'NA') ? $invoice->invoice_type : '--'; ?>
                                            </td>
                                        </tr>
                                                                    <tr>
                                            <td style="text-align: right;">Job Number #:</td>
                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                <?= (!empty($invoice->job_id) && $invoice->job_id !== 'NA') ? $invoice->job_id : '--'; ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">Check Payable To:</td>
                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $company->business_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;"><b>Balance Due:</b></td>
                                            <td style="width: 160px; text-align: right;" class="text-right">
                                                <b>
                                                <?php if($invoice->status !== 'Paid'){
                                                        echo '$ '.number_format((float) ($invoice->balance), 2);
                                                    } else{
                                                    echo "$0.00";
                                                } ?>
                                                </b>
                                            </td>
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
                    <!-- <tr>
                    
                    <td id="presenter-col-left" class="presenter-col-left" style="width: 50%" valign="top">
                            <div id="presenter-from">
                                <b>FROM:</b>
                                <br>
                                <b><?php echo $user->FName . ' ' . $user->LName ?></b><br>
                                <?php echo strtolower($user->address) ?><br>
                                Email: <?php echo strtolower($user->email) ?><br>
                                
                                <table>
                                    <tbody><tr>
                                        <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                        <td>
                                            <?php echo strtolower($user->phone) ?><br><br><br>                          
                                        </td>
                                    </tr>
                                </tbody></table>

                                <br>
                            </div>

                        </td>

                    </tr> -->
                    <tr>
                        <td style="width: 30%" valign="top">
                            <p style="margin: 0"><b>TO:</b></p>
                            <!-- <br> -->
                            <p style="margin: 0"><b><?= (!empty($customer->first_name) && !empty($customer->last_name) && strtoupper($customer->first_name . ' ' . $customer->last_name) !== 'NA') ? strtoupper($customer->first_name . ' ' . $customer->last_name) : ''; ?></b></p>
                            <!-- <br> -->
                            <p style="margin: 0"><?= (!empty($customer->mail_add) && strtoupper($customer->mail_add) !== 'NA') ? strtoupper($customer->mail_add) : ''; ?></p>
                            <p style="margin: 0"><?= (!empty($customer->city) && !empty($customer->state) && !empty($customer->zip_code) && strtoupper($customer->city . ' ' . $customer->state . ' ' . $customer->zip_code) !== 'NA') ? strtoupper($customer->city . ' ' . $customer->state . ' ' . $customer->zip_code) : ''; ?></p>
                            <!-- <br> -->
                            <p style="margin: 0">TEL: <?= (!empty($customer->phone_m) && $customer->phone_m !== 'NA') ? $customer->phone_m : '--'; ?></p>
                        </td>
                        <td style="width: 70%" valign="top">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <?php if($invoice->status === 'Paid') : ?>
            <div id="background">
                <p id="bg-text">PAID</p>
            </div>

            <br><br>
            <?php endif; ?>
            <br><br>

            <!-- <p style="margin:0"><b>JOB:</b></p>
            <br> job_location 
            <p style="margin: 0">Job Name: <?php echo $invoice->job_name ?></p>
            <p style="margin: 0">Job Location: <?php echo $invoice->job_location ?></p>
            <br>
            <br> -->
            <!-- <br> -->
            <div class="table-items-container">
                <?php $total_tax = 0; ?>
                <table class="table-print table-items" style="width: 100%; border-collapse: collapse; font-size: 12px">
                    <thead>
                        <tr>
                            <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th>
                            <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Materials</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Qty</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Price</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Discount</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Tax</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1?>
                        <?php foreach ($items as $item ) { ?>
                        <tr class="table-items__tr">
                            <td style="width:30px; text-align:center;" valign="top">
                                <?php echo $count; ?>
                            </td>
                            <td valign="top">
                                <?php echo $item->title; ?>
                            </td>
                            <td style="width: 50px; text-align: right;" valign="top">
                                <?php echo $item->qty;?>                    
                            </td>
                            <td style="width: 80px; text-align: right;" valign="top">
                                $<?php echo number_format($item->costing, 2); ?>                    
                            </td>
                            <td style="width: 80px; text-align: right;" valign="top">
                                $<?php echo number_format($item->discount, 2); ?>
                            </td>
                            <td style="width: 80px; text-align: right;" valign="top">
                                <?php echo number_format($item->tax, 2); ?>             
                            </td>
                            <td style="width: 90px; text-align: right;" valign="top">
                                $<?php echo number_format($item->total, 2); ?>                 
                            </td>
                        </tr>
                        <tr class="table-items__tr-last">
                            <td></td>
                            <td colspan="6"></td>
                        </tr>
                        <?php $count++;} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3" style="text-align: right"><b>Subtotal (without tax)</b></td>
                            <td style="text-align: right">$<?php if(empty($invoice->sub_total) || $invoice->sub_total == 0){ echo '0.00'; }else{ echo number_format($invoice->sub_total, 2); }?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3" style="text-align: right"><b>Taxes</b></td>
                            <td style="text-align: right">$<?php echo number_format($invoice->taxes, 2);?></td>
                        </tr>
                        <?php if( $invoice->installation_cost > 0 ){ ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: right"><b>Installation Cost</b></td>
                                <td style="text-align: right">$<?php echo number_format($invoice->installation_cost, 2);?></td>
                            </tr>
                        <?php } ?>
                        <?php if( $invoice->program_setup > 0 ){ ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: right"><b>One Time (Program and Setup)</b></td>
                                <td style="text-align: right">$<?php echo number_format($invoice->program_setup, 2);?></td>
                            </tr>
                        <?php } ?>
                        <?php if( $invoice->monthly_monitoring > 0 ){ ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: right"><b>Monthly Monitoring</b></td>
                                <td style="text-align: right">$<?php echo number_format($invoice->monthly_monitoring, 2);?></td>
                            </tr>
                        <?php } ?>
                        <?php if( $invoice->adjustment_value > 0 ){ ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: right">  <b><?=  $invoice->adjustment_name != '' ? $invoice->adjustment_name : 'Adjustment' ?></b></td>
                                <td style="text-align: right">$<?php echo number_format($invoice->adjustment_value, 2);?></td>
                            </tr>
                        <?php } ?>
                        <?php if( $invoice->no_tax == 1 ){ ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: right"><b>Tax Exempted</b></td>
                                <td style="text-align: right">YES</td>
                            </tr>
                        <?php } ?>
                        <?php if( $invoice->late_fee > 0  ){ ?>
                            <tr>
                                <td colspan="3"></td>
                                <?php if($total_late_days > 0) { ?>
                                    <td colspan="3" style="text-align: right"><b>Late Fee (<?php echo $total_late_days; ?> Days)</b></td>
                                <?php } else { ?>
                                    <td colspan="3" style="text-align: right"><b>Late Fee</b></td>
                                <?php } ?>
                                <td style="text-align: right">$<?php echo number_format($invoice->late_fee, 2);?></td>

                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3" style="text-align: right; background: #f4f4f4; padding: 8px 0"><b>Grand Total ($)</b></td>
                            <td style="text-align: right; background: #f4f4f4"><b>$<?php echo number_format($invoice->grand_total, 2);?></b></td>
                        </tr>
                        <?php if($partial_payment_amount > 0) { ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: right"><b>Partial Payment</b></td>
                                <td style="text-align: right">
                                    <b>  
                                        <?php echo number_format((float) ($partial_payment_amount), 2); ?>
                                    </b>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="3" style="text-align: right"><b>Balance Due</b></td>
                            <td style="text-align: right">
                                <b>  
                                    <?php //echo number_format((float) ($invoice->grand_total - $invoice->deposit_request), 2); ?>
                                    <?php echo "$" . number_format((float) ($invoice->balance), 2); ?>
                                </b>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br>
            <br>
            <p style="margin: 0"><b>Accepted payment methods</b></p>
            <!-- <br> -->
            <p style="margin: 0">
                <?php echo ($invoice->accept_credit_card) ? "Credit Card," : '' ?> 
                <?php echo ($invoice->accept_check) ? "Check," : '' ?>
                <?php echo ($invoice->accept_cash) ? "Cash," : '' ?>
                <?php echo ($invoice->accept_direct_deposit) ? "Direct Deposit" : '' ?>    
            </p>
            <p style="margin: 0">
                Accepting Mobile Payments
            </p>
            <br>
            <p style="margin: 0"><b>Message</b></p>
            <p style="margin: 0"><?php echo ($invoice->message_to_customer)?></p>
            <br>
            <br>
            <br>
            <br>
            <p style="margin: 0;font-size:30px;color:red"><b>THANK YOU FOR YOUR BUSINESS</b></p>
            <p style="margin-top:10px">
                <?php if($footer_residential_terms_and_conditions != "") { ?>
                    <?php echo $footer_residential_terms_and_conditions; ?>
                <?php } else { ?>
                    All claims must be made within 5 days after receipt of goods. Goods returned without our authorized return number on the carton will be
                refused. The purchase of products and services are subject to and governed solely by the Terms and Conditions.
                <?php } ?>
            </p>
            <a href="https://nsmartrac.com/terms-and-condition">https://nsmartrac.com/terms-and-condition</a>
            <div style="color: red;margin-top:10px">
                <?php if($footer_residential_message != "") { ?>
                    <?php echo $footer_residential_message; ?>
                <?php } else { ?>
                    Past due balances may be subject to a Late Charge not to exceed 1.5% per month.
                <?php } ?>                
             </div>
            <br>
            <br>
            <br>
            <hr style="border-color:#eaeaea;">
            <p style="color:#888; margin: 0">
                Business powered by nSmarTrac
            </p>
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

<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>