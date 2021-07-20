<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
?>

<style>
    div.disabled {
    pointer-events: none;
    opacity: 0.5;
    background: #CCC;
    }
</style>

<template id="overdueItemTemplate">
    <div class="taxItem">
        <div>
            <div class="taxItem__textSecondary" data-value="date"></div>
            <div class="taxItem__textPrimary" data-value="address"></div>
        </div>
        <div class="text-right pr-4">
            <div class="taxItem__textSecondary">
                <i class="fa fa-info-circle text-danger"></i>
                Was due <span data-value="due_date"></span>
            </div>
            <div class="taxItem__textPrimary" data-value="price"></div>
        </div>
        <div>
            <button class="btn btn-primary">View return</button>
        </div>
    </div>
</template>

<template id="dueItemTemplate">
    <div class="taxItem">
        <div>
            <div class="taxItem__textSecondary" data-value="date"></div>
            <div class="taxItem__textPrimary" data-value="address"></div>
        </div>
        <div class="text-right pr-4">
            <div class="taxItem__textSecondary">
                <i class="fa fa-info-circle text-warning"></i>
                Due <span data-value="due_date"></span>
            </div>
            <div class="taxItem__textPrimary" data-value="price"></div>
        </div>
        <div>
            <button class="btn btn-primary">View return</button>
        </div>
    </div>
</template>

<template id="upcomingItemTemplate">
    <div class="taxItem taxItem--isUpcoming">
        <div>
            <div class="taxItem__textSecondary" data-value="date"></div>
            <div class="taxItem__textPrimary" data-value="address"></div>
        </div>
        <div class="text-right">
            <div class="taxItem__textSecondary">
                Accruing
            </div>
            <div class="taxItem__textPrimary" data-value="price"></div>
        </div>
    </div>
</template>

<div class="wrapper" role="wrapper">
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
                                    <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                        <a href="<?php echo url('/accounting/salesTax') ?>" class="banking-tab <?php echo ($this->uri->segment(1) == "link_bank") ?: '-active'; ?>">Sales Tax</a>
                                        <a href="<?php echo url('/accounting/payrollTax') ?>" class="banking-tab" style="text-decoration: none">Payroll Tax</a>
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

            <div class="row">
                <div class="col-md-8">
                    <h3>$0.08</h3>
                    <h5>SALES TAX DUE</h5>

                    <br>

                    <div class="dropdownWithSearchContainer">
                        <div>
                            <label>Due Date Start</label>
                            <div class="dropdownWithSearch">
                                <input type="text" class="form-control dropdownWithSearch__input">
                                <button class="dropdownWithSearch__btn">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label>Due Date End</label>
                            <div class="dropdownWithSearch">
                                <input type="text" class="form-control dropdownWithSearch__input">
                                <button class="dropdownWithSearch__btn">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>

                        <button class="btn btn-primary">Refresh</a>
                    </div>

                    <br>

                    <div class="taxList">
                        <h6 class="taxList__title">Overdue</h6>
                        <div id="overdueContainer">
                            <div class="taxList__loader"></div>
                        </div>
                    </div>

                    <div class="taxList">
                        <h6 class="taxList__title">Due</h6>
                        <div id="dueContainer">
                            <div class="taxList__loader"></div>
                        </div>
                    </div>

                    <div class="taxList">
                        <h6 class="taxList__title">Upcoming</h6>
                        <div id="upcomingContainer">
                            <div class="taxList__loader"></div>
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
        </div>
    </div>

    <br>
    <br>
    <br>

	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('includes/footer_accounting');?>
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
