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

                    <div class="dropdownWithSearchContainer" id="dueDateInputs">
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

    <div class="modal fade taxModal" tabindex="-1" role="dialog" id="reviewSalesTaxModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review your sales tax</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="taxModal__section row mb-3">
                    <div class="col">
                        <div>
                            <div class="taxModal__title">Florida Department of Revenue</div>
                            <div>Tax Period: June 2021</div>
                            <div>Due date:  Due July 20</div>
                        </div>

                        <div class="taxModal__spacer"></div>

                        <div>
                            <div class="taxModal__title taxModal__title--secondary">ADI Smart Security</div>
                            <div>6055 BORN CT</div>
                            <div>Pensacola, FL 32504</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="taxModal__title">File your sales tax now</div>
                        <ol class="taxModal__list">
                            <li>Print the tax form from your state's website and fill it out.</li>
                            <li>Write a check to your agency or print one.</li>
                            <li>Mail the form and check to your agency.</li>
                            <li>When you're done, come back to record the payment in QuickBooks.</li>
                        </ol>
                    </div>
                </div>

                <div class="taxModal__section">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th class="text-right">Gross Sales</th>
                                <th class="text-right">Nontaxable Sales</th>
                                <th class="text-right">Taxable Sales</th>
                                <th class="text-right">Tax Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>State</th>
                                <td class="text-right">7720.12</td>
                                <td class="text-right">378.83</td>
                                <td class="text-right">7341.29</td>
                                <td class="text-right">337.12</td>
                            </tr>
                            <tr>
                                <th>County</th>
                                <td class="text-right">7720.12</td>
                                <td class="text-right">378.83</td>
                                <td class="text-right">7341.29</td>
                                <td class="text-right">64.68</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="taxModal__total">
                        <div class="taxModal__title taxModal__title--secondary">Total tax</div>
                        <div class="taxModal__title taxModal__title--secondary">$401.80</div>
                    </div>

                    <div class="taxModal__spacer"></div>

                    <a class="taxModal__link" href="#" id="addAdjustmentLink">+ Add an adjustment</a>

                    <div class="taxModal__spacer"></div>

                    <div class="taxModal__total taxModal__total--big">
                        <div class="taxModal__title taxModal__title--secondary">Total after adjustments</div>
                        <div class="taxModal__title taxModal__title--secondary">$401.80</div>
                    </div>

                    <div class="taxModal__spacer"></div>

                    <div class="text-center">
                        <a class="taxModal__link" href="#">View tax liability report</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Record Payment</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>

    <div class="addAdjustment" id="addAdjustment">
        <div class="addAdjustment__inner">
            <div class="addAdjustment__header">
                <div class="addAdjustment__title">Add an adjustment</div>
                <button class="addAdjustment__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <p>
                An adjustment is an increase or decrease to the sales tax, including credits discounts, interest, penalties and corrections.
            </p>

            <form>
                <div class="form-group">
                    <label for="reason">Reason</label>
                    <select class="form-control" id="reason">
                        <option selected>Reason</option>
                        <option value="credit_or_discount">Credit/Discount</option>
                        <option value="prior_prepayments">Prior prepayments</option>
                        <option value="pre_payments">Pre payments</option>
                        <option value="other">Other (penalties, interest, rounding errors)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="adjustment_date">Adjustment Date</label>
                    <input type="date" class="form-control" id="adjustment_date">
                </div>

                <div class="form-group">
                    <label for="account">Account</label>
                    <div class="dropdownWithSearch" id="adjustmentAccount">
                        <input type="text" class="form-control dropdownWithSearch__input" id="account" placeholder="Select account">
                        <button type="button" class="dropdownWithSearch__btn">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" placeholder="Enter amount">
                </div>

                <div>
                    <div class="addAdjustment__title addAdjustment__title--small">Total tax due</div>
                    <div class="addAdjustment__total">$401.80</div>
                </div>
            </form>

            <div class="addAdjustment__footer">
                <button type="button" class="btn btn-primary">Add Adjustment</button>
            </div>

        </div>
    </div>

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
