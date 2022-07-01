<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }

    .btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }

    .btn-transparent {
        color: #6B6C72 !important;
    }

    .btn-transparent:focus {
        border-color: #6B6C72 !important;
    }

    .action-bar ul li a:after {
        width: 0 !important;
    }
    .action-bar ul li a > i {
        font-size: 20px !important;
    }
    .action-bar ul li {
        margin-right: 5px !important;
    }
    .action-bar ul li .dropdown-menu .dropdown-item {
        font-size: 1rem;
        padding-right: 0 !important;
    }
    .action-bar ul li .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    .action-bar ul li .dropdown-menu a:not(.dropdown-item):hover {
       background-color: revert;
    }
    .report-container .action-bar li a {
        font-size: 14px !important;
    }
    .report-container .action-bar li a i {
        font-size: unset !important;
    }
    .report-container #report-table {
        font-size: 12px !important;
    }
    .report-container .report-footer {
        font-size: 10px;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Recurring Template List Report</h3>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/reports" class="text-info"><i class="fa fa-chevron-left"></i> Back to report list</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <a href="javascript:void(0);" id="add-new-account-button" class="btn btn-success float-right">
                                        Save customization
                                    </a>
                                    <a href="#" class="btn btn-transparent mr-2 float-right" style="padding: 10px 12px !important">
                                        Customize
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="row-columns">Rows/columns</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-row">
                                                                <div class="col-4 d-flex align-items-center">
                                                                    <label>Group by</label>
                                                                </div>
                                                                <div class="col">
                                                                    <select id="row-columns" class="form-control">
                                                                        <option value="none">None</option>
                                                                        <option value="account">Account</option>
                                                                        <option value="name">Name</option>
                                                                        <option value="transaction-type">Transaction Type</option>
                                                                        <option value="template-type">Template Type</option>
                                                                        <option value="payment-method">Payment Method</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 border-left d-flex align-items-center justify-content-center">
                                                    <button class="btn btn-transparent">Run Report</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row report-container">
                                    <div class="col">
                                        <div class="m-auto border" style="width: 60%">
                                            <div class="container-fluid">
                                                <div class="row border-bottom">
                                                    <div class="col-md-6" style="font-size: 10px !important">
                                                        <div class="action-bar h-100 d-flex align-items-center">
                                                            <ul>
                                                                <li>
                                                                    <a class="hide-toggle dropdown-toggle text-info" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Sort <i class="fa fa-caret-down text-info"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <p class="m-0">Sort by</p>
                                                                            <select name="sort_by" id="sort-by" class="form-control">
                                                                                <option value="default" selected>Default</option>
                                                                                <option value="account">Account</option>
                                                                                <option value="cc-expires">CC Expires</option>
                                                                                <option value="create-date">Create Date</option>
                                                                                <option value="created-by">Created By</option>
                                                                                <option value="end-date">End Date</option>
                                                                                <option value="expired">Expired</option>
                                                                                <option value="last-modified">Last Modified</option>
                                                                                <option value="last-modified-by">Last Modified By</option>
                                                                                <option value="memo-desc">Memo/Description</option>
                                                                                <option value="name">Name</option>
                                                                                <option value="nex-date">Next Date</option>
                                                                                <option value="num-entered">Num Entered</option>
                                                                                <option value="payment-method">Payment Method</option>
                                                                                <option value="previous-date">Previous Date</option>
                                                                                <option value="split">Split</option>
                                                                                <option value="template-name">Template Name</option>
                                                                                <option value="template-type">Template Type</option>
                                                                                <option value="transaction-type">Transaction Type</option>
                                                                            </select>
                                                                            <p class="m-0">Sort in</p>
                                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                                <input type="radio" id="sort-asc" name="sort_order" checked>
                                                                                <label for="sort-asc">Ascending order</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                                <input type="radio" id="sort-desc" name="sort_order">
                                                                                <label for="sort-desc">Descending order</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li><a href="#" class="text-info">Add notes</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="action-bar h-100 d-flex align-items-center">
                                                            <ul class="ml-auto">
                                                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-print"></i></a></li>
                                                                <li>
                                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="#">Export to Excel</a>
                                                                        <a class="dropdown-item" href="#">Export to PDF</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-cog"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                        <p class="m-0">Display density</p>
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <input type="checkbox" checked="checked" id="compact-display">
                                                                            <label for="compact-display">Compact</label>
                                                                        </div>
                                                                        <p class="m-0">Change columns</p>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-template-type">
                                                                                    <label for="col-template-type">Template Type</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-previous-date">
                                                                                    <label for="col-previous-date">Previous Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-memo-desc">
                                                                                    <label for="col-memo-desc">Memo/Description</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-transaction-type">
                                                                                    <label for="col-transaction-type">Transaction Type</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-next-date">
                                                                                    <label for="col-next-date">Next Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-account">
                                                                                    <label for="col-account">Account</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-template-name">
                                                                                    <label for="col-template-name">Template Name</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-name">
                                                                                    <label for="col-name">Name</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-amount">
                                                                                    <label for="col-amount">Amount</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row hidden-cols" style="display: none">
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-create-date">
                                                                                    <label for="col-create-date">Create Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified-by">
                                                                                    <label for="col-last-modified-by">Last Modified By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-expired">
                                                                                    <label for="col-expired">Expired</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-cc-expires">
                                                                                    <label for="col-cc-expires">CC Expires</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-created-by">
                                                                                    <label for="col-created-by">Created By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-num-entered">
                                                                                    <label for="col-num-entered">Num Entered</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-split">
                                                                                    <label for="col-split">Split</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified">
                                                                                    <label for="col-last-modified">Last Modified</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-end-date">
                                                                                    <label for="col-end-date">End Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-payment-method">
                                                                                    <label for="col-payment-method">Payment Method</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <p class="m-0"><a href="#" class="text-info" id="show-cols"><i class="fa fa-caret-down text-info"></i> Show More</a></p>
                                                                        <p class="m-0"><a href="#" class="text-info">Reorder columns</a></p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <h4><span class="company-name">nSmarTrac</span> <i class="material-icons" style="font-size:16px">edit</i></h4>
                                                        <p>Recurring Template List</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table" style="width: 100%;" id="report-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>TRANSACTION TYPE</th>
                                                                    <th>TEMPLATE NAME</th>
                                                                    <th>PREVIOUS DATE</th>
                                                                    <th>NEXT DATE</th>
                                                                    <th>NAME</th>
                                                                    <th>MEMO/DESCRIPTION</th>
                                                                    <th>ACCOUNT</th>
                                                                    <th class="text-right">AMOUNT</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr data-toggle="collapse" data-target="#accordion" class="clickable collapse-row collapsed">
                                                                    <td><i class="fa fa-caret-right"></i> Scheduled</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                </tr>
                                                                <tr class="clickable collapse-row collapse"  id="accordion">
                                                                    <td>&emsp;Invoice</td>
                                                                    <td>Template Name</td>
                                                                    <td>06/15/2022</td>
                                                                    <td>07/15/2022</td>
                                                                    <td>Test Customer</td>
                                                                    <td></td>
                                                                    <td>Test Account</td>
                                                                    <td class="text-right">22,544.77</td>
                                                                </tr>
                                                                <tr class="clickable collapse-row collapse"  id="accordion">
                                                                    <td><b>Total for Scheduled</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row report-footer">
                                                    <div class="col-12 text-center">
                                                        <p><?=date("l, F j, Y h:i A eP")?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of container fluid -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>


<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>