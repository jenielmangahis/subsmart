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
                                    <h3 class="page-title" style="margin: 0 !important">Retirement plans report</h3>
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
                                            <a class="dropdown-item" href="#">Export to Excel</a>
                                            <a class="dropdown-item" href="#">Print or save PDF</a>
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
                                                    <select name="date_range" id="date-range" class="form-control">
                                                        <option value="last-pay-date">Last pay date</option>
                                                        <option value="this-month">This month</option>
                                                        <option value="this-quarter">This quarter</option>
                                                        <option value="this-year">This year</option>
                                                        <option value="last-month">Last month</option>
                                                        <option value="last-quarter">Last quarter</option>
                                                        <option value="last-year">Last year</option>
                                                        <option value="first-quarter">First quarter</option>
                                                        <option value="second-quarter">Second quarter</option>
                                                        <option value="third-quarter">Third quarter</option>
                                                        <option value="custom">Custom</option>
                                                    </select>
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <input type="text" name="start_date" id="start-date" class="date form-control" value="<?=date("06/30/Y")?>">
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <input type="text" name="end_date" id="end-date" class="date form-control" value="<?=date("06/30/Y")?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-end align-items-end">
                                        <div class="form-group">
                                            <a href="#" class="btn"><i class="fa fa-sliders"></i> Customize</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <table class="table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Employee</th>
                                                    <th class="text-right">Employee deductions</th>
                                                    <th class="text-right">Company distributions</th>
                                                    <th class="text-right">Plan total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="4">There are no results matching the criteria.</td>
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