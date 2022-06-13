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
                                    <p style="margin: 0"><b><?php echo $company->business_name ?></b></p>
                                    <!-- <br> -->
                                    <p style="margin: 0"><?php echo $company->street ?></p>
                                    <!-- <br> -->
                                    <p style="margin: 0"><?php echo $company->city.', '.$company->state.', '.$company->postal_code?></p>
                                    <!-- <br> -->
                                    <p style="margin: 0">Email: <?php echo strtolower($company->business_email) ?></p>
                                    <!-- <br> -->
                                    <p style="margin: 0">Phone: <?php echo strtolower($company->business_phone) ?></p>

                                    <!-- <table>
                                        <tbody><tr>
                                            <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                            <td>
                                                <?php echo strtolower($user->phone) ?><br><br><br>                          
                                            </td>
                                        </tr>
                                    </tbody></table> -->

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
                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $invoice->invoice_type ?></td>
                                        </tr>
                                                                    <tr>
                                            <td style="text-align: right;">Work Order#:</td>
                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $invoice->work_order_number ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">Check Payable To:</td>
                                            <td style="width: 160px; text-align: right;" class="text-right"><?php echo $company->business_name ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;"><b>Balance Due:</b></td>
                                            <td style="width: 160px; text-align: right;" class="text-right"><b>
                                            <?php if($invoice->invoice_type == 'Total Due'){
                                                echo '$ '.number_format($invoice->grand_total, 2);
                                            } else{
                                                echo "$0.00";
                                            } ?>
                                            
                                            </b></td>
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
                            <p style="margin: 0"><b><?php echo $users->contact_name .''. $users->first_name .' '. $users->middle_name .' '. $users->last_name;?></b>
                            <!-- <span class="middot">·</span> -->
                            </p>
                            <!-- <br> -->
                            <p style="margin: 0"><?php echo $users->cross_street ?></p>
                            <!-- <br> -->
                            <p style="margin: 0"><?php echo $users->city.', '.$users->state.', '.$users->zip_code?></p>
                            <!-- <br> -->
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                        <td>
                                            <?php echo $users->phone_m ?><br>
                                            <?php echo $users->phone_h ?><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width: 70%" valign="top">
                            <p style="margin: 0"><b>JOB LOCATION:</b></p>
                            <!-- <br> -->
                            <p style="margin: 0"><b><?php echo $users->first_name .' '. $users->middle_name .' '. $users->last_name; ?></b></p>
                            <!-- <br> -->
                            <p style="margin: 0"><?php echo $users->cross_street?></p>
                            <!-- <br> -->
                            <p style="margin: 0"><?php echo $users->city.', '.$users->state.', '.$users->zip_code?></p>
                            <!-- <br> -->
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                        <td>
                                            <?php echo $users->phone_m ?><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

            <p style="margin:0"><b>JOB:</b></p>
            <!-- <br> -->
            <p style="margin: 0"><?php echo $invoice->job_name ?></p>
            <br>
            <br>
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
                        <?php foreach ($items as $item ) { ?>
                        <tr class="table-items__tr">
                            <td style="width:30px; text-align:center;" valign="top">
                                <?php echo intval($key) + 1 ?>
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
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" style="text-align: right"><b>Subtotal (without tax)</b></td>
                            <td></td>
                            <td style="text-align: right">$<?php echo number_format($invoice->sub_total, 2);?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" style="text-align: right"><b>Taxes</b></td>
                            <td></td>
                            <td style="text-align: right">$<?php echo number_format($invoice->taxes, 2);?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" style="text-align: right; background: #f4f4f4; padding: 8px 0"><b>Grand Total ($)</b></td>
                            <td style="background: #f4f4f4"></td>
                            <td style="text-align: right; background: #f4f4f4; padding: 8px 8px 8px 0;"><b>$<?php echo number_format($invoice->grand_total, 2);?></b></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" style="text-align: right"><b>Balance Due</b></td>
                            <td></td>
                            <td style="text-align: right"><b><?php echo $invoice->invoice_type === 'Total Due' ? '$'.number_format($invoice->grand_total, 2) : '$0.00' ?></b></td>
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