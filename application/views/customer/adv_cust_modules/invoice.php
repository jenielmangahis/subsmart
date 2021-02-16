<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="invoices module ui-state-default" id="<?= $id ?>">
    <div class="col-sm-12 individual-module">
        <h6>Invoice</h6>
        <div class="row">
            <div class="col-sm-12">
                <div style="position:relative;display: inline-block;float: left;" class="boverdue">Balance</div>
                <!-- updated on 10-11-2016 start (fixed chargebee permission issue) -->
                <div style="position:relative; float: right; text-align: right;">
                    <div class="normaltext1">
                        <a href="#" class="js-qwynlraxz">Chargebee Transaction History</a>
                    </div>
                    <!-- updated on 25-01-2017 start (updated tooltip message for chargebee) -->
                    <div style="line-height: 18px; margin-left: -15px; margin-top: 45px; width: 220px; display: none;" class="tooltipbox" id="pwd-tiptxt">
                        <p style="font-weight:normal; font-size:13px; margin:0px; left:18px;" class="clientname">
                            Requires Chargebee (recommended) <span class="normaltext1"><a href="https://app.creditrepaircloud.com/mycompany/chargebee_settings" class="js-qwynlraxz">click here</a></span>
                        </p>
                        <div class="tooltiparrow1"></div>
                        <div class="tooltiparrow2"></div>
                    </div>
                    <!-- updated on 25-01-2017 end -->
                </div>
            </div>

            <!-- updated on 10-11-2016 end -->
            <div class="balance" style="width:97%;">

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-bordered">

                    <tbody><tr>

                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Total Invoiced
                        </td>

                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Received
                        </td>

                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Outstanding
                        </td>
                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Past Due
                        </td>

                    </tr>
                    <tr class="gridrow">
                        <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                        <td valign="top" height="15" align="center">
                            <span id="Total_Invoice">$0</span>
                        </td>
                        <td valign="top" height="15" align="center">
                            <span id="received_total">$0</span>
                        </td>
                        <td valign="top" height="15" align="center">
                            <span id="Total_Outstanding">$0</span>
                        </td>
                        <td valign="top" height="15" align="center">
                            <span id="Past_Due">$0</span>
                        </td>
                        <!-- updated on 10-11-2016 end -->
                    </tr>



                    </tbody></table>
            </div>
            <div>
            </div>

            <div class="invoicetext" style="margin-left:0px; margin-top:6px;">
                <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                <a style="color:#58bc4f;" href="https://app.creditrepaircloud.com/invoices/add/NTk=" class="js-qwynlraxz">
                    Create Invoice</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="https://app.creditrepaircloud.com/invoices/client_invoices_history/NTk=/item" class="js-qwynlraxz">
                    All Invoices</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="https://app.creditrepaircloud.com/invoices/client_invoices_history/NTk=/payment" class="js-qwynlraxz">
                    Payments</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                <a href="#" class="js-qwynlraxz">
                    New Task</a>
                <!--<a href="javascript:void(0);">Billing Reminders</a><br />-->
                <!--<a href="javascript:void(0);">Billing Notes</a><br />-->
                <!--<a href="javascript:void(0);">Reminders</a>-->
            </div>
            <!--Updated by akshay 05-06-2017 s-->

            <div style="margin-right:15px; padding-top:1px;" align="right" class="normaltext1">
                <a href="#" style="color:#58bc4f;"><span class="fa fa-envelope"></span> Email Invoice</a>&nbsp;&nbsp;

                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>

        </div>
    </div>
</div>