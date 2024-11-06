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
                <div style="float:left;width:50%;">
                    <div style="margin-bottom: 20px;">
                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px" />
                    </div>
                </div>
                <div style="float:right;width:50%;">
                    <div id="presenter-title-container" class="presenter-title-container" style="margin-top: 10px; margin-bottom: 20px;text-align:right;">
                        <span class="presenter-title" style="font-size: 25pt;color:#8c97c0;">Service Ticket</span><br>
                    </div>
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
                                    <?php 
                                        $ticketDate = '---';
                                        if( strtotime($ticket_date) > 0 ){
                                            $ticketDate = date("m/d/Y", strtotime($ticket_date)); 
                                        }       
                                        echo $ticketDate;                                         
                                    ?>                                                
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right;">Scheduled Time:</td>
                                <td style="width: 160px; text-align: right;" class="text-right"><?php echo $scheduled_time.' to '.$scheduled_time_to; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;"><b>Status:</b></td>
                                <td style="width: 160px; text-align: right;" class="text-right"><b><?php echo $ticket_status ? $ticket_status : '-'; ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="clear:both;"></div>
                <div style="height:50px;display:block;"></div>
                
                <div style="float:left;width:70%;">
                    <p style="margin: 0"><b><?php echo $bname; ?></b></p>
                    <p style="margin: 0"><?php echo $baddress; ?></p>
                    <p style="margin: 0"><?php echo $bcity; ?>, <?php echo $bstate; ?> <?php echo $bzip_code; ?></p>
                    <p style="margin: 0">Email: <?php echo strtolower($bemail) != 'not specified' ? strtolower($bemail) : ''; ?></p>
                    <p style="margin: 0">Phone: <?php echo strtolower(formatPhoneNumber($bphone_h)); ?></p>
                    <br>
                </div>
                <div style="float:right;width:30%;">
                    <p style="margin: 0"><b><?php echo $name; ?></b></p>
                    <p style="margin: 0"><?php echo $mail_add; ?></p>
                    <p style="margin: 0"><?php echo $city; ?></span>, <span><?php echo $state; ?></span> <span><?php echo $zip_code; ?></p>
                    <p style="margin: 0">Email: <?php echo strtolower($email) != 'not specified' ? strtolower($email) : ''; ?></p>
                    <p style="margin: 0">Phone: <?php echo formatPhoneNumber($phone_h); ?></p>
                    <br>
                </div>
                <div style="clear:both;"></div>
                <div id="background"><p id="bg-text"><?php echo $ticket_status; ?></p></div>
                <div style="height:10px;display:block;"></div>                
                <div class="table-items-container">
                    <table class="table-print table-items" style="width: 100%; border-collapse: collapse; font-size: 12px">
                        <tbody>
                            <tr class="table-items__tr">
                                <td tyle="text-align: left; background: #f4f4f4; padding: 8px 0;" >
                                    <b>Sales Representative</b> <br>
                                    <?php echo $repsName . ' / ' . formatPhoneNumber($sales_rep_no); ?><br><br />
                                    <b>Team Lead/Mentor</b> <br>                                    
                                    <?php echo $tl_mentor != '' ? $tl_mentor : '---'; ?>                                               
                                </td>
                            </tr>  
                        </tbody>
                    </table>
                </div>
                <div style="height:10px;display:block;"></div>
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
                            <?php $i++; ?>
                            <?php } ?>
                        </tbody>
                    </table>    
                    <div style="height:10px;display:block;"></div>
                    <div style="float:left;width:75%;">
                        <table>
                            <tr>
                                <td>Payment Method</td>
                                <td><?php echo $payment_method; ?></td>
                            </tr>
                            <tr>
                                <td>Payment Amount</td>
                                <td>$<?php echo number_format($payment_amount,2,".",""); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div style="float:right;width:25%;">
                        <table>
                            <tr>
                                <td style="width:100px;">Subtotal</td>
                                <td style="text-align:right;">$<?php echo number_format($subtotal,2); ?></td>
                            </tr>
                            <tr>
                                <td style="width:100px;">Taxes</td>
                                <td style="text-align:right;">$<?php echo number_format($taxes,2,".",""); ?></td>
                            </tr>
                            <?php if( $adjustment_value > 0 ){ ?>
                            <tr>
                                <td style="width:100px;"><?php echo $adjustment != '' ? $adjustment : 'Adjustment'; ?></td>
                                <td style="text-align:right;">$<?php echo number_format($adjustment_value,2,".",""); ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td style="width:100px;">Grand Total</td>
                                <td style="text-align:right;font-weight:bold;">$<?php echo number_format($grandtotal,2,".",""); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div style="clear:both;"></div>                                     
                </div>
                <div style="height:10px;display:block;"></div>       
                <hr style="border-color:#eaeaea;">
                <div style="display:block;margin-bottom:10px;">
                    <b>Assigned Technicians</b> <br><br>
                    <?php $assigned_technician = unserialize($technicians); ?>
                    <ul style="list-style:none;padding:0px;margin:0px;">
                        <?php if($assigned_technician) { ?>
                            <?php foreach($assigned_technician as $eid){ ?>
                            <li style="display:inline-block;padding:10px;">
                                <?php $user = getUserName($eid); ?>
                                <?php echo '<img style="height:25px;margin: 0 auto;" src="'.userProfileImage($eid).'" /><span style="display:block;height:30px;margin-top:30px;">'.$user['name'].'</span>'; ?>
                            </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <div style="display:block;margin-bottom:10px;">
                    <b>Terms and Conditions</b><br><br><?php echo $terms_conditions; ?>
                </div>
                <div style="display:block;margin-bottom:10px;">
                    <b>Instructions</b><br><br><?php if(empty($instructions)){ echo 'N/A'; }else{ echo $instructions; } ?> 
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