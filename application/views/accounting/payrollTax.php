<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
div.disabled
{
  pointer-events: none;

  /* for "disabled" effect */
  opacity: 0.5;
  background: #CCC;
}

.ul-class{
    padding:1%;
}
.ul-class li{
    padding:1%;
    color:green;
}

.ul-class li a{
    color:#0077C5;
}
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                          <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Payroll Tax Center</h3>
                    </div>
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                            <!-- <h2>Rules</h2> -->
                                <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                    <a href="<?php echo url('/accounting/salesTax')?>" class="banking-tab">Sales Tax</a>
                                    <a href="<?php echo url('/accounting/payrollTax')?>" class="banking-tab <?php echo ($this->uri->segment(1)=="link_bank")?:'-active';?>" style="text-decoration: none">Payroll Tax</a>
                                </div>
                            </div>
                        </div>
                            <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:20px;">
                            Go to Taxes and select Payroll Tax.<br>
                            Select Pay Taxes.<br>
                            Select Create payment on the tax you want to pay.<br>
                            Select E-pay.<br>
                            Always choose Earliest as it's the recommended date to pay taxes, then select Approve. ...<br>
                            An e-payment confirmation window appears, select Done.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-6">
                    <label>Taxes</label><hr>
                    <a href="#" class="btn btn-success" style="margin-top:26px;">Pay Taxes</a>
                    <br><br>
                    <label>You may also want to:</label><br>
                    <ul class="ul-class">
                        <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#">Edit your e-file and e-pay setup</a></li>
                        <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#">Edit your tax setup</a></li>
                        <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#">View your Tax Liability report</a></li>
                        <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#">View tax payments you have made</a></li>
                        <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#">Enter prior tax history</a></li>
                        <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#">Order tax forms</a></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <label>Forms</label><hr>
                    <br>
                    <label>You may also want to:</label><br>
                    <ul class="ul-class">
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <i class="fa fa-file-pdf-o  fa-4x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-11">
                                <a href="#">Quarterly Forms</a><br>Completed quarterly tax forms, ready for you to print and mail.<br><a href="#">View and Print Archived Forms >></a>
                                </div>
                            </div>
                         </li>
                         <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <i class="fa fa-file-pdf-o  fa-4x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-11">
                                <a href="#">Annual Forms</a><br>Annual forms, including W-2s.<br><a href="#">View and Print Archived Forms >></a>
                                </div>
                            </div>
                         </li>
                         <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <i class="fa fa-file-pdf-o  fa-4x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-11">
                                <a href="#">Employee Setup</a><br>Forms for you and your employee to complete. Includes mandatory and optional forms.<br><a href="#">View and Print Archived Forms >></a>
                                </div>
                            </div>
                         </li>
                         <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <i class="fa fa-file-pdf-o  fa-4x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-11">
                                <a href="#">Employer Setup</a><br>Application(s) for employer identification numbers.<br><a href="#">View and Print Archived Forms >></a>
                                </div>
                            </div>
                         </li>
                    </ul>
                </div>
            </div>
            
            <!-- end row -->
        </div>
    </div>
        <!-- end container-fluid -->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    //dropdown checkbox
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
    //DataTables JS
    $(document).ready(function() {
        $('#rules_table').DataTable({
            "paging":false,
            "language": {
                "emptyTable": "<h5>Use rules to save time</h5> <span>Make rules for your frequently occurring transactions and tell nSmartrac exactly what should happen when conditions are met. <a href='#' data-toggle=\"modal\" data-target=\"#createRules\" style='color: #0b97c4'>Create a rule</a></span>"
            }
        });
    } );
</script>
