<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                            <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.5rem !important;font-weight: 600 !important;">Balance Sheet Detail Report</h3>
                            <a href="<?php echo url('accounting/reports')?>" class="" style="color:#479cd4;">
                                <i class="fa fa-angle-left" style="font-size:24px"></i> Back to report list
                            </a>
                            <br>
                            <a href="#" class="" data-toggle="popover" title="See a snapshot in time" data-content="Choose a time period to see where things stood at the end of it." style="text-decoration:underline;text-decoration-style: dotted;">
                                <span class="back-to-reports" data-dojo-attach-point="_allReportsLink">Report period</span>
                            </a>
                    </div>
                    <div class="row" style="margin-top:6px;">
                        <div class="col-md-6">
                            <table style="width:70%;" class="table">
                                <tr>
                                    <td>
                                        <select class="form-control" style="min-width:200px;">
                                            <option>This month to date</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control">
                                    </td>
                                    <td> To </td>
                                    <td>
                                        <input type="text" class="form-control">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6" align="right">
                            <a href="#" class="btn btn-primary">Customize</a>
                            <a href="#" class="btn btn-success">Save Customization</a>
                        </div>
                    </div>
                    <div class="row" style="margin-top:6px;">
                        <div class="col-md-8">
                            <table style="width:100%;" class="table">
                                <tr>
                                    <td>
                                        <p>Accounting method</p><br>
                                        <input type="radio" name="same"> Cash
                                        <input type="radio" name="same"> Accrual
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-primary"  value="Run report">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="" style="border: solid gray 1px;">

                        <div class="row" style="padding:5px;">
                            <div class="col-md-3">
                                <a href="#" style="color:#479cd4;">Sort <i class="fa fa-angle-down"></i></a>&emsp;
                                <a href="#" style="color:#479cd4;"> Add notes</a>
                            </div>
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-2" align="right">
                                <i class="fa fa-envelope" style="font-size:24px"></i>&nbsp;
                                <i class="material-icons">local_printshop</i>&nbsp;
                                <i class="fa fa-upload" style="font-size:24px"></i>&nbsp;
                                <i class="material-icons">settings</i>&nbsp;
                            </div>
                        </div>
                        <center>
                            <h4>nSmarTrac <i class="material-icons" style="font-size:16px">edit</i></h4>
                            <p>Balance Sheet Detail <br> As of August 2, 2021</p>
                        </center>

                        <table class="table" style="width: 100%;">
                            <thead>
                                <th><b>DATE</b></th>
                                <th><b>TRANSACTION TYPE</b></th>
                                <th><b>NUM</b></th>
                                <th><b>NAME</b></th>
                                <th><b>MEMO/DESCRIPTION</b></th>
                                <th><b>SPLIT</b></th>
                                <th><b>DEBIT</b></th>
                                <th><b>CREDIT</b></th>
                                <th><b>AMOUNT</b></th>
                                <th><b>BALANCE</b></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ASSETS</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>$571,265.66</td>
                                </tr>
                                <tr>
                                    <td>&emsp; Current Assets</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp; Bank Accounts</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Checking</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>305,061.93</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Test Bank (Cash on hand)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>990.77</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;&emsp; Sub-bank (Cash on hand)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>990.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;&emsp; <b>Total Test Bank (Cash on hand)</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>1,980.77</b></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Test Category</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>10.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>$307,052.70</b></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp; Accounts Receivable</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 08/01/2021</td>
                                    <td>Payment</td>
                                    <td></td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>Undeposited Funds</td>
                                    <td></td>
                                    <td>$74.99	</td>
                                    <td>-74.99	</td>
                                    <td>198,875.55</td>
                                </tr>
                                
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 08/01/2021</td>
                                    <td>Payment</td>
                                    <td></td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>Undeposited Funds</td>
                                    <td></td>
                                    <td>$74.99	</td>
                                    <td>-74.99	</td>
                                    <td>198,875.55</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Invoice</td>
                                    <td>12345</td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>-Split-</td>
                                    <td>$49.99</td>
                                    <td></td>
                                    <td>49.99</td>
                                    <td>198,925.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Payment</td>
                                    <td></td>
                                    <td>Smith, John</td>
                                    <td></td>
                                    <td>Undeposited Funds</td>
                                    <td></td>
                                    <td>-58.00</td>
                                    <td>49.99</td>
                                    <td>198,867.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Invoice</td>
                                    <td>12345</td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>-Split-</td>
                                    <td>$49.99</td>
                                    <td></td>
                                    <td>49.99</td>
                                    <td>198,925.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Invoice</td>
                                    <td>12345</td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>-Split-</td>
                                    <td>$49.99</td>
                                    <td></td>
                                    <td>49.99</td>
                                    <td>198,925.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Invoice</td>
                                    <td>12345</td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>-Split-</td>
                                    <td>$49.99</td>
                                    <td></td>
                                    <td>49.99</td>
                                    <td>198,925.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Invoice</td>
                                    <td>12345</td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>-Split-</td>
                                    <td>$49.99</td>
                                    <td></td>
                                    <td>49.99</td>
                                    <td>198,925.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Invoice</td>
                                    <td>12345</td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>-Split-</td>
                                    <td>$49.99</td>
                                    <td></td>
                                    <td>49.99</td>
                                    <td>198,925.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp; 07/01/2021</td>
                                    <td>Invoice</td>
                                    <td>12345</td>
                                    <td>Doe, John</td>
                                    <td></td>
                                    <td>-Split-</td>
                                    <td>$49.99</td>
                                    <td></td>
                                    <td>49.99</td>
                                    <td>198,925.54</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>$205,324.93</b></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp; Other Current Assets</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>207.95</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Inventory</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>25.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>25,705.75</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Test OCA</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1,000.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>9,068.80</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>16,347.82</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>$52,355.32</b></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>$564,732.95</b></td>
                                </tr>
                                <tr>
                                    <td>&emsp;</i> Fixed Assets</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;Accumulated Depreciation</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>-26,176.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;Fixed Asset Computers</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>6,069.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>25,289.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;Fixed Asset Phone</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1,200.00</td>
                                </tr>
                                <tr>
                                    <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>$6,382.00</b></td>
                                </tr>
                                <tr>
                                    <td>&emsp;<b>TOTAL ASSETS</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>$571,114.95</b></td>
                                </tr>
                                <tr>
                                    <td>LIABILITIES AND EQUITY</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>$571,265.66</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
    </div>
        <!-- end container-fluid -->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
