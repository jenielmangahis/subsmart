<center><div class="<?php echo ($format == 'print') ? 'print': '' ?>" style="width:60% !important;margin:5%;">
    <div class="<?php echo ($format == 'print') ? 'invoice-paper print-body': 'invoice-paper' ?>" id="presenter-paper">
    <?php //if($format == 'print') : ?>
    <div style="text-align: right; margin-bottom: 10px;">
    <!-- <a class="btn-print" onclick="window.print();" href="#">Print</a> -->
    <a class="btn-print" data-print-modal="open" href="#" onclick="printDiv('printableArea')" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
    </div>
    <?php //endif; ?>

    <div  id="printableArea" style="width:100%;padding:2%;">
    
    <style>
        #background{
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
            <table class="table-print" style="width: 100%;">
                <tbody>
                    <tr>
                    <td>
                        <div style="margin-bottom: 20px;" align="right">
                            <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 200px; max-height: 200px;" />
                        </div>

                        <div id="presenter-from">
                                <b><?php echo $clients->business_name; ?></b><br>
                                <?php echo strtolower($clients->business_address) ?><br>
                                Email: <?php echo strtolower($clients->email_address) ?><br>
                                
                                <table>
                                    <tbody><tr>
                                        <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                        <td>
                                            <?php echo strtolower($clients->phone_number) ?><br><br><br>                          
                                        </td>
                                    </tr>
                                </tbody></table>

                                <br>
                        </div>

                    </td>
                    </tr>
                </tbody>
            </table>
            <p align="left" style="font-size: 24px;color:#8c97c0;">Packing Slip</p>
            <br><br><br><br>
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
                        <b>TO:</b><br>
                        <b><?php //echo get_customer_by_id($invoice->customer_id)->contact_name 
                            echo $users->contact_name .''. $users->first_name .' '. $users->middle_name .' '. $users->last_name;
                        ?></b>
                        <span class="middot">·</span><br>
                        <?php //echo get_customer_by_id($invoice->customer_id)->street_address 
                        echo $users->cross_street ?><br>
                        <?php //echo get_customer_by_id($invoice->customer_id)->city . ',' 
                        echo $users->city  . ','?>
                        <?php //echo get_customer_by_id($invoice->customer_id)->state . ',' 
                        echo $users->state  . ','?>
                        <?php //echo get_customer_by_id($invoice->customer_id)->postal_code
                        echo $users->zip_code ?><br>
                            <table>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                    <td>
                                        <?php //echo get_customer_by_id($invoice->customer_id)->mobile
                                        echo $users->phone_m ?><br>
                                        <?php //echo get_customer_by_id($invoice->customer_id)->phone
                                        echo $users->phone_h ?><br>                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody></table>

            <hr>
                <?php echo $invoice->job_name ?><br>
            <br><br>
            <div class="table-items-container">
                <?php $total_tax = 0; ?>
                <table class="table-print table-items" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">ACTIVITY</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">ACTIVITY</th>
                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Collections</td>
                            <td></td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Commission</td>
                            <td></td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
                <!-- <table class="table-print table-totals" style="width: 100%; margin-top: 10px;">
                    <tbody>
                        <tr>
                            <td style="width: 50%; text-align: right;"></td>
                            <td>
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 8px 0; text-align: right;" class="text-right">Subtotal (without tax)</td>
                                            <td style="padding: 8px 8px 8px 0; text-align: right;" class="text-right">$ </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; text-align: right;" class="text-right">Taxes</td>
                                            <td style="padding: 8px 8px 8px 0; text-align: right;" class="text-right">$ </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>Grand Total ($)</b></td>
                                            <td style="width: 120px; padding: 8px 8px 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>$</td>
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
                                        
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
            <br>
            <br>
            <hr style="border-color:#eaeaea;margin-bottom:0;">
            <p style="color:#888;">
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