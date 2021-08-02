<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.collapse-row.collapsed + tr {
  display: none;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                            <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.5rem !important;font-weight: 600 !important;">Balance Sheet Report</h3>
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
                                            <option>This Year-to-date</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control">
                                    </td>
                                    <td>&emsp;To&emsp;</td>
                                    <td>
                                        <input type="text" class="form-control">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6" align="right">
                            <a href="#" class="btn btn-seconday">Customize</a>
                            <a href="#" class="btn btn-success">Save Customization</a>
                        </div>
                    </div>
                    <div class="row" style="margin-top:6px;margin-bottom:30px;">
                        <div class="col-md-9">
                            <table style="width:100%;" class=" ">
                                <tr>
                                    <td>
                                        <p><a href="#" class="" data-toggle="popover" title="Slice and dice your data" data-content="See separate columns for day, week, customer, and more." style="text-decoration:underline;text-decoration-style: dotted;">
                                            <span class="back-to-reports" data-dojo-attach-point="_allReportsLink">Display columns by</span>
                                        </a></p>
                                        <select class="form-control" style="width:250px;">
                                            <option>Total Only</option>
                                        </select>
                                    </td>
                                    <td>
                                        <p><a href="#" class="" data-toggle="popover" title="Declutter your report" data-content="Choose Active to hide empty rows or columns. Choose Non-zero to also hide ones where the total is zero. Find out more" style="text-decoration:underline;text-decoration-style: dotted;">
                                            <span class="back-to-reports" data-dojo-attach-point="_allReportsLink">Display columns by</span>
                                        </a></p>
                                        <select class="form-control" style="width:250px;">
                                            <option>Active rows/active columns</option>
                                        </select>
                                    </td>
                                    <td>
                                        <p><a href="#" class="" data-toggle="popover" title="Compare time periods side by side" data-content="See what changed from one period to the next. Find out more" style="text-decoration:underline;text-decoration-style: dotted;">
                                            <span class="back-to-reports" data-dojo-attach-point="_allReportsLink">Display columns by</span>
                                        </a></p>
                                        <select class="form-control" style="width:250px;">
                                            <option>Select period</option>
                                        </select>
                                    </td>
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

                    <div class="" style="margin-top:6px;margin:0 20% 0 20%;border: solid gray 1px;">

                        <div class="row" style="padding:5px;">
                            <div class="col-md-3">
                                <a href="#" style="color:#479cd4;">Collapse</a>&emsp;
                                <a href="#" style="color:#479cd4;">Sort <i class="fa fa-angle-down"></i></a>&emsp;
                                <a href="#" style="color:#479cd4;"> Add notes</a>
                            </div>
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-2">
                                <i class="fa fa-envelope" style="font-size:24px"></i>&nbsp;
                                <i class="material-icons">local_printshop</i>&nbsp;
                                <i class="fa fa-upload" style="font-size:24px"></i>&nbsp;
                                <i class="material-icons">settings</i>&nbsp;
                            </div>
                        </div>
                        <center>
                            <h4>nSmarTrac <i class="material-icons" style="font-size:16px">edit</i></h4>
                            <p>Balance Sheet <br> As of July 31, 2021</p>
                        </center>

                        <table class="table" style="width: 100%;">
                            <thead>
                                <th></th>
                                <th style="text-align:right;">TOTAL</th>
                            </thead>
                            <tbody>
                                <tr data-toggle="collapse" data-target="#accordion" class="clickable collapse-row collapsed">
                                    <td><i class="fa fa-caret-right"></i> ASSETS</td>
                                    <td style="text-align:right;">$571,265.66</td>
                                </tr>
                                <tr data-toggle="collapse" data-target="#accordion1" class="clickable collapse-row collapse" id="accordion">
                                    <td>&emsp;<i class="fa fa-caret-right"></i> Current Assets</td>
                                    <td style="text-align:right;"></td>
                                </tr>
                                <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion2">
                                    <td>&emsp;&emsp;<i class="fa fa-caret-right"></i> Bank Accounts</td>
                                    <td style="text-align:right;"></td>
                                </tr>
                                <tr id="accordion2" class="collapse">
                                    <td>&emsp;&emsp;&emsp;Checking</td>
                                    <td style="text-align:right;">305,061.93</td>
                                </tr>
                                <tr id="accordion2" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion3">
                                    <td>&emsp;&emsp;&emsp;<i class="fa fa-caret-right"> Test Bank (Cash on hand)</td>
                                    <td style="text-align:right;">990.77</td>
                                </tr>
                                <tr id="accordion3" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;&emsp; Sub-bank (Cash on hand)</td>
                                    <td style="text-align:right;">990.00</td>
                                </tr>
                                <tr id="accordion3" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;&emsp; <b>Total Test Bank (Cash on hand)</b></td>
                                    <td style="text-align:right;"><b>1,980.77</b></td>
                                </tr>
                                <tr id="accordion2" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Test Category</td>
                                    <td style="text-align:right;">10.00</td>
                                </tr>
                                <tr id="accordion2" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                    <td style="text-align:right;"><b>$307,052.70</b></td>
                                </tr>
                                <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion4">
                                    <td>&emsp;&emsp;<i class="fa fa-caret-right"></i> Accounts Receivable</td>
                                    <td style="text-align:right;"></td>
                                </tr>
                                <tr id="accordion4" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Accounts Receivable</td>
                                    <td style="text-align:right;">205,324.93</td>
                                </tr>
                                <tr id="accordion4" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                    <td style="text-align:right;"><b>$205,324.93</b></td>
                                </tr>
                                <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion5">
                                    <td>&emsp;&emsp;<i class="fa fa-caret-right"></i> Other Current Assets</td>
                                    <td style="text-align:right;"></td>
                                </tr>
                                <tr id="accordion5" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                    <td style="text-align:right;">207.95</td>
                                </tr>
                                <tr id="accordion5" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Inventory</td>
                                    <td style="text-align:right;">25.00</td>
                                </tr>
                                <tr id="accordion5" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                    <td style="text-align:right;">25,705.75</td>
                                </tr>
                                <tr id="accordion5" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Test OCA</td>
                                    <td style="text-align:right;">1,000.00</td>
                                </tr>
                                <tr id="accordion5" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                    <td style="text-align:right;">9,068.80</td>
                                </tr>
                                <tr id="accordion5" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                    <td style="text-align:right;">16,347.82</td>
                                </tr>
                                <tr id="accordion5" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                    <td style="text-align:right;"><b>$52,355.32</b></td>
                                </tr>
                                <tr id="accordion1" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                    <td style="text-align:right;"><b>$564,732.95</b></td>
                                </tr>
                                <tr data-toggle="collapse" data-target="#accordion1" class="clickable collapse-row collapse" id="accordion6">
                                    <td>&emsp;<i class="fa fa-caret-right"></i> Fixed Assets</td>
                                    <td style="text-align:right;"></td>
                                </tr>
                                <tr id="accordion6" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;Accumulated Depreciation</td>
                                    <td style="text-align:right;">-26,176.00</td>
                                </tr>
                                <tr id="accordion6" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;Fixed Asset Computers</td>
                                    <td style="text-align:right;">6,069.00</td>
                                </tr>
                                <tr id="accordion6" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                    <td style="text-align:right;">25,289.00</td>
                                </tr>
                                <tr id="accordion6" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;Fixed Asset Phone</td>
                                    <td style="text-align:right;">1,200.00</td>
                                </tr>
                                <tr id="accordion6" class="collapse clickable collapse-row">
                                    <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                    <td style="text-align:right;"><b>$6,382.00</b></td>
                                </tr>
                                <tr  class="clickable collapse-row collapse"  id="accordion">
                                    <td>&emsp;<b>TOTAL ASSETS</b></td>
                                    <td style="text-align:right;"><b>$571,114.95</b></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-caret-right"></i> LIABILITIES AND EQUITY</td>
                                    <td style="text-align:right;">$571,265.66</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <!-- <tr>
                                    <td><b>Total</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                </tr> -->
                            </tfoot>
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
