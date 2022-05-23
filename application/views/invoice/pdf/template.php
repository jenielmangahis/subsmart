<div class="<?php echo ($format == 'print') ? 'print': '' ?>">
    <div class="class="<?php echo ($format == 'print') ? 'invoice-paper print-body': 'invoice-paper' ?>" id="presenter-paper">
    <?php if($format == 'print') : ?>
    <div style="text-align: right; margin-bottom: 10px;"><a class="btn-print" onclick="window.print();" href="#">Print</a></div>
    <?php endif; ?>
    <div class="presenter-paper-sm" id="presenter-paper-sm"></div>
    <div class="invoice-print" style="background: #ffffff;">
        <table class="table-print" style="width: 100%; margin-bottom: 10px;">
            <tbody>
                <tr>
                    <td id="presenter-col-left" class="presenter-col-left" style="width: 50%" valign="top">
                        <div style="margin-bottom: 20px;">
                            <img class="invoice-print-logo" style="max-width: 230px; max-height: 200px;" src="<?php echo $profile ?>">
                        </div>
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
                    <td id="presenter-col-right" class="presenter-col-right" style="width: 50%; text-align: right;" valign="top">
                        <div id="presenter-title-container" class="presenter-title-container" style="margin-top: 10px; margin-bottom: 20px;">
                            <span class="presenter-title" style="font-size: 30pt;">INVOICE</span><br>
                            <span># <?php echo $invoice->invoice_number ?></span>
                        </div>
                        <div id="presenter-summary" class="presenter-summary">
                            <table style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right;">Date Issued:</td>
                                        <td style="width: 180px; text-align: right;" class="text-right">
                                            <?php echo get_format_date($invoice->date_issued) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Date Due:</td>
                                        <td style="width: 180px; text-align: right;" class="text-right">
                                        <?php echo ($invoice->due_date > date('Y-m-d')) ? get_format_date($invoice->due_date) : "Due on Receipt" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Type:</td>
                                        <td style="width: 180px; text-align: right;" class="text-right"><?php echo $invoice->invoice_type ?></td>
                                    </tr>
                                                                <tr>
                                        <td style="text-align: right;">Work Order#:</td>
                                        <td style="width: 180px; text-align: right;" class="text-right"><?php echo $invoice->work_order_number ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">Check Payable To:</td>
                                        <td style="width: 180px; text-align: right;" class="text-right"><?php echo $user->FName . ' ' . $user->LName ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;"><b>Balance Due:</b></td>
                                        <td style="width: 180px; text-align: right;" class="text-right"><b>$0.00</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table-print" style="width: 100%">
            <tbody>
                <tr>
                <td style="width: 50%" valign="top">
                    <b>TO:</b><br>
                    <b><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></b>
                    <span class="middot">·</span><br>
                    <?php echo get_customer_by_id($invoice->customer_id)->suite_unit ?>
                    <?php echo get_customer_by_id($invoice->customer_id)->street_address ?><br>
                    <?php echo get_customer_by_id($invoice->customer_id)->city . ',' ?>
                    <?php echo get_customer_by_id($invoice->customer_id)->state . ',' ?>
                    <?php echo get_customer_by_id($invoice->customer_id)->postal_code?><br>
                        <table>
                        <tbody>
                            <tr>
                                <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                <td>
                                    <?php echo get_customer_by_id($invoice->customer_id)->mobile?><br>
                                    <?php echo get_customer_by_id($invoice->customer_id)->phone?><br>                        
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%" valign="top">
                    <b>JOB LOCATION:</b><br>
                    <b><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></b><br>
                    <?php echo get_customer_by_id($invoice->customer_id)->suite_unit ?>
                    <?php echo get_customer_by_id($invoice->customer_id)->street_address ?><br>
                    <?php echo get_customer_by_id($invoice->customer_id)->city . ',' ?>
                    <?php echo get_customer_by_id($invoice->customer_id)->state . ',' ?>
                    <?php echo get_customer_by_id($invoice->customer_id)->postal_code?><br>
                    Phone:&nbsp; <?php echo get_customer_by_id($invoice->customer_id)->phone?>                
                </td>
            </tr>
        </tbody></table>

        <br>

        <b>JOB:</b>
        <br>
            <?php echo $invoice->job_name ?><br>
        <br>
        <div class="table-items-container">
            <?php $total_tax = 0; ?>
            <?php if (false) : ?>
            <?php// if ($invoice->invoice_items[0]['item'] != '') : ?>
            <table class="table-print table-items" style="width: 100%; border-collapse: collapse;">
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
                    <?php foreach ($invoice->invoice_items as $key => $value ) : ?>
                    <tr class="table-items__tr">
                        <td style="width:30px; text-align:center;" valign="top">
                            <?php echo intval($key) + 1 ?>
                        </td>
                        <td valign="top">
                            <?php echo $value['item'] ?>
                        </td>
                        <td style="width: 50px; text-align: right;" valign="top">
                            <?php echo $value['quantity'] ?>                    
                        </td>
                        <td style="width: 80px; text-align: right;" valign="top">
                            $<?php echo number_format($value['price'], 2, '.', ',') ?>                    
                        </td>
                        <td style="width: 80px; text-align: right;" valign="top">
                            $0.00                    
                        </td>
                        <td style="width: 80px; text-align: right;" valign="top">
                            $<?php echo number_format($value['tax'], 2, '.', ',') ?> <br>(7.5%) 
                            <?php $total_tax += floatval($value['tax']); ?>                   
                        </td>
                        <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right;" valign="top">
                            $<?php echo number_format($value['total'], 2, '.', ',') ?>                    
                        </td>
                    </tr>
                    <tr class="table-items__tr-last">
                        <td></td>
                        <td colspan="6"></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
            <table class="table-print table-totals" style="width: 100%; margin-top: 10px;">
                <tbody>
                    <tr>
                        <td style="width: 50%; text-align: right;"></td>
                        <td>
                            <table style="width: 100%; border-collapse: collapse;">
                                <tbody>
                                    <tr>
                                        <td style="padding: 8px 0; text-align: right;" class="text-right">Subtotal (without tax)</td>
                                        <td style="padding: 8px 8px 8px 0; text-align: right;" class="text-right">$<?php echo (false) ? number_format(floatval($invoice->invoice_totals['sub_total'] - $total_tax), 2, '.', ',') : '' ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; text-align: right;" class="text-right">Taxes</td>
                                        <td style="padding: 8px 8px 8px 0; text-align: right;" class="text-right">$<?php echo (false) ? number_format($total_tax, 2, '.', ',') : '' ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>Grand Total ($)</b></td>
                                        <td style="width: 120px; padding: 8px 8px 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>$<?php echo (false) ? number_format($invoice->invoice_totals['grand_total'], 2, '.', ',') : '' ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; text-align: right;"></td>
                        <td>
                            <table style="width: 100%; border-collapse: collapse;">
                                <tbody>
                                    <tr>
                                        <td style="padding: 4px 0; text-align: right;" class="text-right"><b>Balance Due</b></td>
                                        <td style="width: 120px; padding: 4px 8px 4px 0; text-align: right;" class="text-right"><b>$0.00</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <p>
            <b>Accepted payment methods</b><br>
            <?php echo ($invoice->accept_credit_card) ? "Credit Card," : '' ?> 
            <?php echo ($invoice->accept_check) ? "Check" : '' ?>
            <?php echo ($invoice->accept_cash) ? "Cash" : '' ?>
            <?php echo ($invoice->accept_direct_deposit) ? "Direct Deposit" : '' ?>    
        </p>
        <p>
            Accepting Mobile Payments
        </p>
        
            <p>
            <b>Message</b><br>
            <?php echo ($invoice->message_to_customer)?>  
        </p>
        <br>
        <hr style="border-color:#eaeaea;">
        <p style="color:#888;">
            Business powered by nSmarTrac
        </p>
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