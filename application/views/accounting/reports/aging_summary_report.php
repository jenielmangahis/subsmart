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
                            <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.5rem !important;font-weight: 600 !important;">A/R Aging Summary Report</h3>
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
                            <table style="width:70%;">
                                <tr>
                                    <td>
                                        <select class="form-control" style="min-width:200px;">
                                            <option>Today</option>
                                        </select>
                                    </td>
                                    <td>&emsp;as of&emsp;</td>
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
                                        <p><a href="#" class="" data-toggle="popover" title="Declutter your report" data-content="Choose Active to hide empty rows or columns. Choose Non-zero to also hide ones where the total is zero. Find out more" style="text-decoration:underline;text-decoration-style: dotted;">
                                            <span class="back-to-reports" data-dojo-attach-point="_allReportsLink">Show non-zero or active only</span>
                                        </a></p>
                                        <select class="form-control" style="width:250px;">
                                            <option>Active rows/active columns</option>
                                        </select>
                                    </td>
                                    <td>
                                        <p>Aging method</p><br>
                                        <input type="radio" name="same"> Current
                                        <input type="radio" name="same"> Report date
                                    </td>
                                    <td>
                                        <p>Days per aging period</p>
                                        <input type="text" class="form-control">
                                    </td>
                                    <td>
                                        <p>Number of periods</p>
                                        <input type="text" class="form-control">
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
                            <p>A/R Aging Summary <br> As of July 31, 2021</p>
                        </center>

                        <table class="table" style="width: 100%;">
                            <thead>
                                <th></th>
                                <th>CURRENT</th>
                                <th>1 - 30</th>
                                <th>31 - 60</th>
                                <th>61 - 90</th>
                                <th>91 AND OVER</th>
                                <th>TOTAL</th>
                            </thead>
                            <tbody>
                                <?php foreach($customers as $customer){ ?>
                                <tr>
                                    <td><?php echo $customer->first_name . ' ' . $customer->last_name; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>$0.00</td>
                                    <td>$0.00</td>
                                </tr>

                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                    <td><b>$0.00</b></td>
                                </tr>
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
