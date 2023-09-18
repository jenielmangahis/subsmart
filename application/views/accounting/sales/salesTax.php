<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>
<style>
    
element.style {
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #6a4a86;
    background-color: white;
    border: solid #6a4a86 2px;
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
            <div class="taxItem__textSecondary" data-value="due_date"></div>
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

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
    </div>
    <div class="col-6">
        <br>
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link active" aria-current="page" href="<?=url('/accounting/salesTax')?>">Sales Tax</a>
            <a class="nav-link" href="<?=url('/accounting/payrollTax')?>">Payroll Tax</a>
            <a class="nav-link" href="<?=url('/accounting/payrollTaxFillings')?>">1099 filings</a>
        </nav>
    <br>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-6">
                        <div class="nsm-callout primary">
                        To start recording sales tax for your company, you need to turn on this feature and set up sales tax items or tax groups.  Go to the Edit menu, then select Preferences.<br>On the Preferences window, select Sales Tax then go to the Company Preferences tab.  Select Yes to turn on sales tax.
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="float:right;">
                            <button class="nsm-button primary">Sales Tax Settings</button>
                            <button class="nsm-button primary">Economic Nexus</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6" id="app-builder">
                        <div class="margin-bottom">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-content">
                                    <div class="col-md-12" style="margin-top: 20px;">
                                    <h3><span id="totalTax">0.00</span></h3>
                                    <h5>SALES TAX DUE</h5>

                                    <br>

                                    <div class="dropdownWithSearchContainer" id="dueDateInputs">
                                        <div>
                                            <label>Due Date Start</label>
                                            <div data-type="due_start" class="dropdownWithSearch">
                                                <input type="text" class="form-control dropdownWithSearch__input">
                                                <button class="dropdownWithSearch__btn">
                                                    <i class="fa fa-chevron-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <label>Due Date End</label>
                                            <div data-type="due_end" class="dropdownWithSearch">
                                                <input type="text" class="form-control dropdownWithSearch__input">
                                                <button class="dropdownWithSearch__btn">
                                                    <i class="fa fa-chevron-down"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <button class="nsm-button primary" id="refreshList" disabled>Refresh</button>
                                        <span class="dropdownWithSearchContainer__error d-none">
                                            Invalid date range, end date must be after start date.
                                        </span>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <table class="table">
                        <thead>
                            <th>AGENCY</th>
                            <th>PERIOD</th>
                            <th>DUE DATE</th>
                            <th>AMOUNT</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Florida Department of Revenue</td>
                                <td>Feb 1 - Feb 28 2023</td>
                                <td>03/20/2023</td>
                                <td>1,650.26</td>
                                <td>Overdue</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#taxReturnModal">View Tax Return</a></td>
                            </tr>
                            <tr>
                                <td>Florida Department of Revenue</td>
                                <td>Aug 01 - Aug 31 2023</td>
                                <td>09/20/2023</td>
                                <td>397.12</td>
                                <td>Due</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#taxReturnModal">View Tax Return</a></td>
                            </tr>
                            <tr>
                                <td>Florida Department of Revenue</td>
                                <td>Sept 01 - Sept 30 2023</td>
                                <td>10/20/2023</td>
                                <td>436.30</td>
                                <td>Open</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#taxReturnModal">View Tax Return</a></td>
                            </tr>
                            <tr>
                                <td>Florida Department of Revenue</td>
                                <td>Dec 1 - Dec 31 2023</td>
                                <td>01/20/2024</td>
                                <td>1,092.11</td>
                                <td>Open</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#taxReturnModal">View Tax Return</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="taxReturnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#393a3d;color:white;">
        <h5 class="modal-title" id="exampleModalLabel">Review your sales tax</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div style="margin-left:10%;margin-right:10%;margin-top:3%;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Florida Department of Revenue</h4>
                            Tax Period: January 2023 <br>
                            Due date:  Was due February 20<br><br>
                            nSmarTrac<br>
                            6055 BORN CT<br>
                            Pensacola, FL 32526<br>
                        </div>
                        <div class="col-md-6">
                            <h4>File your sales tax now</h4>
                            1. Print the tax form from your state's website and fill it out.<br>
                            2. Write a check to your agency or print one.<br>
                            3. Mail the form and check to your agency.<br>
                            4. When you're done, come back to record the payment in nSmarTrac.
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th>LEVEL</th>
                                <th>GROSS SALES</th>
                                <th>NONTAXABLE SALES</th>
                                <th>TAXABLE SALES</th>
                                <th>TAX AMOUNT</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>State</td>
                                    <td>2,000.00</td>
                                    <td>1,500</td>
                                    <td>3,000.00</td>
                                    <td>300.00</td>
                                </tr>
                                <tr>
                                    <td>County</td>
                                    <td>2,000.00</td>
                                    <td>1,500</td>
                                    <td>3,000.00</td>
                                    <td>60.00</td>
                                </tr>
                                <tr>
                                    <td>Custom</td>
                                    <td>36.00</td>
                                    <td>0.00</td>
                                    <td>10.00</td>
                                    <td>3.00</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><h5>Total Tax</h5></td>
                                    <td><h5>363.00</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><h4>Total after adjustments</h4></td>
                                    <td><h4>363.00</h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Record Payment</button>
      </div>
    </div>
  </div>
</div>


<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const isLocalhost = ["localhost", "127.0.0.1"].includes(location.hostname);
    //     if (!isLocalhost) return;

    //     $.ajaxSetup({
    //         beforeSend: function (xhr,settings) {
    //             if (settings.url.startsWith("/accounting/")) {
    //                 settings.url = settings.url.replace("/accounting/", "/nsmartrac/accounting/")
    //             }
    //         }
    //     });
    // });
</script>

<?php include viewPath('v2/includes/footer');?>