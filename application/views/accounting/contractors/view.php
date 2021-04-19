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
    .contractor-icon {
        height: 100px;
        width: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #d4d7dc;
        border-radius: 50%;
    }
    .contractor-icon span {
        color: #8d9096;
        font-size: 3.4rem;
    }
    .contractor-details-container, .contractor-icon-container {
        margin: 0 10px;
    }
    .contractor-details-container h4 {
        margin: 0;
    }
    .contractor-details-container .btn-group button:hover, .contractor-details-container .btn-group button:focus {
        color: unset;
    }
    #myTabContent .tab-pane {
        padding: 15px;
    }
    #myTabContent #details .card:hover {
        border-color: #498002 !important;
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
                                    <h3 class="page-title" style="margin: 0 !important">Contractors</h3>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">See how easy paying and tracking contractors can be. This accounting features makes it easy to pay contractors today & W-2 employees tomorrow.  Get started by adding a Contractor.</span>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row pb-3">
                                <!-- <div class="col-md-12 banking-tab-container">
									<a href="<?php //echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
									<a href="<?php //echo url('/accounting/employees')?>" class="banking-tab">Employees</a>
									<a href="<?php //echo url('/accounting/contractors')?>" class="banking-tab-active text-decoration-none">Contractors</a>
									<a href="<?php //echo url('/accounting/workers-comp')?>" class="banking-tab">Worker's Comp</a>
									<a href="#" class="banking-tab">Benefits</a>
                                </div> -->
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/contractors" class="text-info"><i class="fa fa-chevron-left"></i> Contractors</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" id="write-check-button" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    Write check
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Create expense</a>
                                                    <a class="dropdown-item" href="#">Create bill</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-5 d-flex align-items-center">
                                    <div class="contractor-icon-container">
                                        <div class="contractor-icon">
                                            <span><?=strtoupper(substr($contractor->name, 0, 1))?></span>
                                        </div>
                                    </div>
                                    <div class="contractor-details-container">
                                        <h4><?=$contractor->name?> <?=$contractor->status === "0" ? '(deleted)' : ''?></h5>
                                        <div class="btn-group">
                                            <button class="btn" type="button" id="statusDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?=$contractor->status === "1" ? 'Active' : 'Inactive' ?>&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
                                            </button>

                                            <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                                <?php if($contractor->status === "1") : ?>
                                                <a class="dropdown-item" href="/accounting/employees/set-status/<?=$contractor->id?>/inactive">Mark as inactive</a>
                                                <?php else : ?>
                                                <a class="dropdown-item" href="/accounting/employees/set-status/<?=$contractor->id?>/active">Mark as active</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 banking-tab-container">
                                    <a href="#details" role="tab" aria-controls="details" aria-selected="true" data-toggle="tab" class="banking-tab-active text-decoration-none">Details</a>
                                    <a href="#payments" role="tab" aria-controls="payments" aria-selected="false" data-toggle="tab" class="banking-tab">Payments</a>
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
                            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="card cursor-pointer border">
                                    <div class="card-body" style="padding-bottom: 1.25rem">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">Personal details</h5>
                                            <a href="#" class="text-info">Add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                                Payments
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