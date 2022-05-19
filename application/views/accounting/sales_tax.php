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
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                          <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Sales Tax</h3>
                    </div>
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                            <!-- <h2>Rules</h2> -->
                                <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                    <a href="<?php echo url('/accounting/salesTax')?>" class="banking-tab <?php echo ($this->uri->segment(1)=="link_bank")?:'-active';?>">Sales Tax</a>
                                    <a href="<?php echo url('/accounting/payrollTax')?>" class="banking-tab" style="text-decoration: none">Payroll Tax</a>
                                </div>
                            </div>
                        </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:20px;">
                To start recording sales tax for your company, you need to turn on this feature and set up sales tax items or tax groups.  Go to the Edit menu, then select Preferences.<br>On the Preferences window, select Sales Tax then go to the Company Preferences tab.  Select Yes to turn on sales tax.
                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-8">
                    <!-- <div class="row">
                        <div class="col-md-8"> -->
                            <h3>$0.08</h3>
                            <h5>SALES TAX DUE</h5>
                        <!-- </div>
                    </div> -->
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>From</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>To</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-primary" style="margin-top:26px;">Refresh</a>
                        </div>
                    </div>
                    <br>
                    <h6>Overdue</h6>
                    <div class="row" style="padding:1%;border:1px solid gray;box-shadow: 3px 6px #888888;margin-top:15px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <label>January 2021</label>
                                    <h6>Banks City, AL</h6>
                                </div>
                                <div class="col-md-3" style="text-align:right;">
                                    <label>Was due February 20</label>
                                    <h6>$0.00</h6>
                                </div>
                                <div class="col-md-2">
                                    <a href="#" class="btn btn-primary" style="margin-top:26px;">View Return</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding:1%;border:1px solid gray;box-shadow: 3px 6px #888888;margin-top:15px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <label>January 2021</label>
                                    <h6>Calera City, AL</h6>
                                </div>
                                <div class="col-md-3" style="text-align:right;">
                                    <label>Was due February 20</label>
                                    <h6>$0.00</h6>
                                </div>
                                <div class="col-md-2">
                                    <a href="#" class="btn btn-primary" style="margin-top:26px;">View Return</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding:1%;border:1px solid gray;box-shadow: 3px 6px #888888;margin-top:15px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <label>January 2021</label>
                                    <h6>Florida</h6>
                                </div>
                                <div class="col-md-3" style="text-align:right;">
                                    <label>Was due February 20</label>
                                    <h6>$0.08</h6>
                                </div>
                                <div class="col-md-2">
                                    <a href="#" class="btn btn-primary" style="margin-top:26px;">View Return</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h6>Upcoming</h6>
                    <div class="row disabled" style="padding:1%;border:1px solid gray;box-shadow: 3px 6px #888888;margin-top:15px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <label>January 2021</label>
                                    <h6>Banks City, AL</h6>
                                </div>
                                <div class="col-md-3" style="text-align:right;">
                                    <label>Accruing</label>
                                    <h6>$0.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row disabled" style="padding:1%;border:1px solid gray;box-shadow: 3px 6px #888888;margin-top:15px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <label>January 2021</label>
                                    <h6>Calera City, AL</h6>
                                </div>
                                <div class="col-md-3" style="text-align:right;">
                                    <label>Accruing</label>
                                    <h6>$0.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row disabled" style="padding:1%;border:1px solid gray;box-shadow: 3px 6px #888888;margin-top:15px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <label>January 2021</label>
                                    <h6>Florida</h6>
                                </div>
                                <div class="col-md-3" style="text-align:right;">
                                    <label>Accruing</label>
                                    <h6>$0.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row disabled" style="padding:1%;border:1px solid gray;box-shadow: 3px 6px #888888;margin-top:15px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <label>January to February 2021</label>
                                    <h6>Alabama</h6>
                                </div>
                                <div class="col-md-3" style="text-align:right;">
                                    <label>Accruing</label>
                                    <h6>$0.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" style="padding:3%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3" align="center">
                                    <a href="#" style="color:#0077C5;">History</a>
                                </div>
                                <div class="col-md-1" align="center">
                                    |
                                </div>
                                <div class="col-md-4" align="center">
                                    <a href="#" style="color:#0077C5;">Sales tax settings</a>
                                </div>
                                <div class="col-md-1" align="center">
                                    |
                                </div>
                                <div class="col-md-2" align="center">
                                    <a href="#" style="color:#0077C5;">Reports</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <table class="table">
                            <tr>
                                <td colspan="2"><h5>SHORTCUTS</h5></td>
                            <tr>
                            <tr>
                                <td><img src="<?php echo $url->assets ?>img/taxlogo/l1.png" alt=""></td>
                                <td><b>Tell us where you collect tax</b><br>Make sure you're only charging tax in the right states.</td>
                            <tr>
                            <tr>
                                <td><img src="<?php echo $url->assets ?>img/taxlogo/l2.png" alt=""></td>
                                <td><b>Update products and services</b><br>Get the most accurate rates by categorizing what you sell.</td>
                            <tr>
                            <tr>
                                <td><img src="<?php echo $url->assets ?>img/taxlogo/l3.png" alt=""></td>
                                <td><b>Double-check client addresses</b><br>Don't forget that tax rates can depend on customer location.</td>
                            <tr>
                            <tr>
                                <td><img src="<?php echo $url->assets ?>img/taxlogo/l4.png" alt=""></td>
                                <td><b>Run sales tax reports</b><br>Get a detailed look at the taxes you owe and why you owe them.</td>
                            <tr>
                            <tr>
                                <td><img src="<?php echo $url->assets ?>img/taxlogo/l4.png" alt=""></td>
                                <td><b>Look at past returns</b><br>Quickly see all the sales tax payments you've made so far.</td>
                            <tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- end row -->
        </div>
    </div>
    <br><br><br>
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
