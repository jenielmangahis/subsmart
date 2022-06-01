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
                            <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.5rem !important;font-weight: 600 !important;">Audit Log</h3>
                            <a href="<?php echo url('accounting/reports')?>" class="" style="color:#479cd4;">
                                <i class="fa fa-angle-left" style="font-size:24px"></i> Back to report list
                            </a>
                            <!-- <br>
                            <a href="#" class="" data-toggle="popover" title="See a snapshot in time" data-content="Choose a time period to see where things stood at the end of it." style="text-decoration:underline;text-decoration-style: dotted;">
                                <span class="back-to-reports" data-dojo-attach-point="_allReportsLink">Report period</span>
                            </a> -->
                    </div>
                    <div class="row" style="margin-top:6px;">
                        <div class="col-md-6">
                            <table style="width:70%;" class="table">
                                <tr>
                                    <td>
                                        <select class="form-control" style="min-width:200px;">
                                            <option>Filter</option>
                                        </select>
                                    </td>
                                    <td>
                                        &emsp;This month X 
                                    </td>
                                    <!-- <td>&emsp;To&emsp;</td> -->
                                    <td>
                                        &emsp;Clear filter / View All&emsp;
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- <div class="col-md-6" align="right">
                            <a href="#" class="btn btn-seconday">Customize</a>
                            <a href="#" class="btn btn-success">Save Customization</a>
                        </div> -->
                    </div>

                    <div class="">

                        <div class="row" style="padding:5px;">
                            <div class="col-md-3">
                                <!-- <a href="#" style="color:#479cd4;">Collapse</a>&emsp;
                                <a href="#" style="color:#479cd4;">Sort <i class="fa fa-angle-down"></i></a>&emsp;
                                <a href="#" style="color:#479cd4;"> Add notes</a> -->
                            </div>
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-upload" style="font-size:24px"></i>&nbsp;
                                <i class="material-icons">settings</i>&nbsp;
                            </div>
                        </div>
                        <!-- <center>
                            <h4>nSmarTrac <i class="material-icons" style="font-size:16px">edit</i></h4>
                            <p>Profit and Loss <br> As of July 31, 2021</p>
                        </center> -->

                        <table class="table table-bordered" style="width: 100%;">
                            <thead>
                                <th>DATE CHANGED</th>
                                <th>USER</th>
                                <th>EVENT</th>
                                <th>NAME</th>
                                <th>DATE</th>
                                <th>AMOUNT</th>
                                <th>HISTORY</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000020</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000019</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000018</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Check</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000017</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Expense</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000016</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000015</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Deleted Time Charge</td>
                                    <td>Test Cust</td>
                                    <td>08/01/2021</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Deleted Time Charge</td>
                                    <td>Test Cust</td>
                                    <td>08/01/2021</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Deleted Time Charge</td>
                                    <td>Test Cust</td>
                                    <td>08/01/2021</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000014</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000013</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000012</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000011</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000010</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000009</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Expense</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000008</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000007</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000006</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000005</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000004</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000003</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000002</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
                                </tr>
                                <tr>
                                    <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                    <td>System Administration</td>
                                    <td>Added Invoice No. INV-0000000001</td>
                                    <td>Loucelle Emperio</td>
                                    <td>08/01/2021</td>
                                    <td>$49.91</td>
                                    <td><a href="#">View</a></td>
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
