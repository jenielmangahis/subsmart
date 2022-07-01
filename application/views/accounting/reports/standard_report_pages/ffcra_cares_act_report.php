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
                                    <h3 class="page-title" style="margin: 0 !important">FFCRA CARES Act Report</h3>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/reports" class="text-info"><i class="fa fa-chevron-left"></i> Back to report list</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dropdown float-right">
                                        <button class="btn btn-transparent dropdown-toggle hide-toggle rounded" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Share <i class="fa fa-caret-down"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Share</a>
                                            <a class="dropdown-item" href="#">Export to Excel</a>
                                            <a class="dropdown-item" href="#">Printer friendly</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <label for="date-range">Date Range</label>
                                                    <select name="date_range" id="date-range" class="form-control">
                                                        <option value="last-pay-date">Last pay date</option>
                                                        <option value="this-month">This month</option>
                                                        <option value="this-quarter">This quarter</option>
                                                        <option value="this-year">This year</option>
                                                        <option value="last-month">Last month</option>
                                                        <option value="last-quarter">Last quarter</option>
                                                        <option value="last-year">Last year</option>
                                                        <option value="1st-quarter">1st Quarter</option>
                                                        <option value="2nd-quarter">2nd Quarter</option>
                                                        <option value="custom">Custom</option>
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <label for="employees">Employee</label>
                                                    <select name="employee" id="employee" class="form-control">
                                                        <option value="active-employees">Active Employees</option>
                                                        <option value="inactive-employees">Inactive Employees</option>
                                                        <option value="all-employees">All Employees</option>
                                                        <option value="test-employee">Test Employee</option>
                                                    </select>
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <button class="btn btn-success rounded">Run Report</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <table class="table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>TOTAL AMOUNT</th>
                                                    <th>CREDIT TOTAL</th>
                                                    <th>Test Employee</th>
                                                    <th>CREDIT AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>FFCRA & CARES ACT WAGES, TAXES & CREDITS</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;FFCRA Wages</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;Total FFCRA Sick Lv Wages</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;Total FFCRA Wages</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;FFCRA ER Health Premium</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;Total FFCRA ER Health Premium</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;Total FFCRA Wages and ER Health Premium</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;CARES Act Wages</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;Total Reg and OT Emp Retn Credit Wages</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;Total CARES Act Credits</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>&emsp;Total FFCRA & CARES Act Credits</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
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