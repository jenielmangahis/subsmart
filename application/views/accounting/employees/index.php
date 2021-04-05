<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }
    .show>.btn-primary.dropdown-toggle {
        background-color: #32243D;
        border: 1px solid #32243D;
    }
    #employees-table .btn-group .btn:hover, #employees-table .btn-group .btn:focus {
        color: unset;
    }
    #employees-table .btn-group .btn {
        padding: 10px;
    }
    .action-bar ul li {
        margin-right: 0 !important;
    }
    .action-bar ul li button.btn-transparent {
        color: #6B6C72 !important;
    }
    .action-bar ul li button.btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }
    .view-password {
        position: absolute;
        bottom: 2px;
        right: 15px;
        width: 24px;
        height: 24px;
        cursor: pointer;
    }
    #add-pay-schedule-modal .card.shadow .card-body, #edit-pay-schedule-modal .card.shadow .card-body {
        padding: 0;
    }
    #add-pay-schedule-modal .form-row, #edit-pay-schedule-modal .form-row {
        margin-top: 30px;
    }
    #add-pay-schedule-modal span.select2-selection.select2-selection--single, #edit-pay-schedule-modal span.select2-selection.select2-selection--single {
        min-width: unset !important;
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
                                    <h3 class="page-title" style="margin: 0 !important">Employees</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Here you will get a detailed summary of pay rate, payment method, pay schedule and the status of each of your employee. With this report, you will be able to forecast a better budget for future weeks.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
                                    <a href="<?php echo url('/accounting/employees')?>" class="banking-tab-active text-decoration-none">Employees</a>
                                    <a href="<?php echo url('/accounting/contractors')?>" class="banking-tab">Contractors</a>
                                    <a href="<?php echo url('/accounting/workers-comp')?>" class="banking-tab">Worker's Comp</a>
                                    <a href="#" class="banking-tab">Benefits</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <!-- <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6> -->
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" id="run-payroll-button" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    Run payroll
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Bonus only</a>
                                                    <a class="dropdown-item" href="#">Commision only</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            		    <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <div class="form-check float-right mb-3">
                                            <label for="privacy">Privacy </label>
                                            <input type="checkbox" name="privacy" id="privacy">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="col-3">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Find an employee">
                                            </div>
                                            <div class="col-4">
                                                <select name="" id="employee-status" class="form-control">
                                                    <option value="active" selected>Active Employees</option>
                                                    <option value="inactive">Inactive Employees</option>
                                                    <option value="all">All Employees</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><button class="btn btn-transparent" type="button" id="add-employee-button">Add an employee</button></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Show columns</p>
                                                        <p class="m-0"><input type="checkbox" onchange="showCol(this)" checked="checked" name="chk_pay_rate" id="chk-pay-rate"> Pay rate</p>
                                                        <p class="m-0"><input type="checkbox" onchange="showCol(this)" checked="checked" name="chk_pay_method" id="chk-pay-method"> Pay method</p>
                                                        <p class="m-0"><input type="checkbox" onchange="showCol(this)" checked="checked" name="chk_status" id="chk-status"> Status</p>
                                                        <p class="m-0"><input type="checkbox" onchange="showCol(this)" name="chk_email_address" id="chk-email-address"> Email Address</p>
                                                        <p class="m-0"><input type="checkbox" onchange="showCol(this)" name="chk_phone_num" id="chk-phone-num"> Phone number</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="employees-table" class="table table-bordered table-hover" style="width:100%">
									<thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th class="pay-rate">PAY RATE</th>
                                            <th class="pay-method">PAY METHOD</th>
                                            <th class="status">STATUS</th>
                                            <th class="email-address hide">EMAIL ADDRESS</th>
                                            <th class="phone-num hide">PHONE NUMBER</th>
                                        </tr>
									</thead>
									<tbody class="cursor-pointer"></tbody>
								</table>
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

<div class="append-modal"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>