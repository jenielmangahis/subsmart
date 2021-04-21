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
    #myTabContent #details .card h5.edit-icon {
        display: none;
        color: #498002;
        margin: 0;
    }
    #myTabContent #details .card:hover h5.edit-icon {
        display: block;
    }
    span.select2-selection.select2-selection--single {
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
                                                <a class="dropdown-item" href="/accounting/contractors/set-status/<?=$contractor->id?>/inactive">Mark as inactive</a>
                                                <?php else : ?>
                                                <a class="dropdown-item" href="/accounting/contractors/set-status/<?=$contractor->id?>/active">Mark as active</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
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
                                </div>
                                <div class="col-md-12 banking-tab-container">
                                    <a href="#details" role="tab" aria-controls="details" aria-selected="true" data-toggle="tab" class="banking-tab-active text-decoration-none">Details</a>
                                    <a href="#payments" role="tab" aria-controls="payments" aria-selected="false" data-toggle="tab" class="banking-tab">Payments</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="card cursor-pointer border">
                                    <div class="card-body" style="padding: 0">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5 class="m-0">Personal details</h5>
                                                    <?php if($contractor_details === null) : ?>
                                                    <a href="#" class="text-info">Add</a>
                                                    <?php else : ?>
                                                    <h5 class="edit-icon"><i class="fa fa-pencil"></i></h5>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($contractor_details) : ?>
                                        <div class="row mt-3">
                                            <div class="col-md-2">
                                                <p class="m-0">Contractor type</p>
                                                <h5 class="mt-0"><?=$contractor_details->contractor_type_id === "1" ? "Individual" : "Business"?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="m-0">Name</p>
                                                <?php
                                                    $name = $contractor_details->title !== "" ? $contractor_details->title : "";
                                                    $name .= ' '.$contractor_details->first_name;
                                                    $name .= $contractor_details->middle_name !== "" ? " $contractor_details->middle_name" : "";
                                                    $name .= ' '.$contractor_details->last_name;
                                                    $name .= $contractor_details->suffix !== "" ? " $contractor_details->suffix" : "";
                                                ?>
                                                <h5 class="mt-0"><?=$name?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="m-0">Display name</p>
                                                <h5 class="mt-0"><?=$contractor->name?></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="m-0"><?=$contractor_details->contractor_type_id === "1" ? "Social Security number" : "Employer Identification number" ?></p>
                                                <h5 class="mt-0"><?=$contractor_details->contractor_type_id === "1" ? $contractor_details->social_security_number : $contractor_details->employer_id_number?></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="m-0">Email</p>
                                                <h5 class="mt-0"><?=$contractor->email?></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="m-0">Address</p>
                                                <h5 class="m-0"><?="$contractor_details->address <br>$contractor_details->city, $contractor_details->state $contractor_details->zip_code"?></h5>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <select name="date" id="date" class="form-control">
                                                        <option value="all">All</option>
                                                        <option value="this-month">This month</option>
                                                        <option value="last-3-months">Last 3 months</option>
                                                        <option value="last-12-months">Last 12 months</option>
                                                        <option value="year-to-date">Year to date</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="type">Type</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="all">All</option>
                                                        <option value="check">Check</option>
                                                        <option value="expense">Expense</option>
                                                        <option value="bill-payment">Bill payment</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="payment-method">Payment method</label>
                                                    <select name="payment_method" id="payment-method" class="form-control">
                                                        <option value="all">All</option>
                                                        <option value="check">Check</option>
                                                        <option value="direct-deposit">Direct deposit</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6>0 payments found</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6 class="float-right">Total : $0.00</h6>
                                            </div>
                                            <div class="col-sm-12">
                                                <table class="table table-bordered my-3" id="contractor-payments-table">
                                                    <thead>
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Payment method</th>
                                                        <th>Amount</th>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
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

            <div class="modal-right-side">
                <div class="modal right fade" id="personal-details-modal" tabindex="" role="dialog" aria-labelledby="details-modal-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <h3 class="modal-title" id="details-modal-label">&nbsp;</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-light">&times;</span></button>
                            </div>
                            <form action="/accounting/contractors/<?=$contractor->id?>/update-details" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card p-0 my-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label for="">Contractor type *</label>
                                                            <?php foreach($contractorTypes as $type) : ?>
                                                            <div class="form-check">
                                                                <input type="radio" name="contractor_type" id="contractor-<?=strtolower($type->name)?>" class="form-check-input" value="<?=$type->id?>" <?=$contractor_details !== null && $contractor_details->contractor_type_id === $type->id ? 'checked' : ''?>>
                                                                <label for="contractor-<?=strtolower($type->name)?>" class="form-check-label"><?="$type->name - $type->description"?></label>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-3 individual-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "2" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input type="text" name="title" id="title" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->title : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 individual-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "2" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="first_name">First *</label>
                                                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->first_name : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 individual-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "2" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="middle_name">Middle</label>
                                                            <input type="text" name="middle_name" id="middle_name" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->middle_name : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 individual-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "2" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="last_name">Last *</label>
                                                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->last_name : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 individual-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "2" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="suffix">Suffix</label>
                                                            <input type="text" name="suffix" id="suffix" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->suffix : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 business-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "1" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="business_name">Business name *</label>
                                                            <input type="text" name="business_name" id="business_name" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->business_name : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 default-field <?=$contractor_details === null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="name">Display name *</label>
                                                            <input type="text" name="name" id="name" class="form-control" value="<?=$contractor->name?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 individual-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "2" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="social_sec_num">Social Security number *</label>
                                                            <input type="text" name="social_sec_num" id="social_sec_num" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->social_security_number : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 business-type-field <?=$contractor_details === null || $contractor_details->contractor_type_id === "1" && $contractor_details !== null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="emp_id_num">Employer Identification Number *</label>
                                                            <input type="text" name="emp_id_num" id="emp_id_num" class="form-control" value="<?=$contractor_details !== null ? $contractor_details->employer_id_number : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 default-field <?=$contractor_details === null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" name="email" id="email" class="form-control" value="<?=$contractor->email?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 default-field <?=$contractor_details === null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="address">Address *</label>
                                                            <textarea name="address" id="address" class="form-control" required><?=$contractor_details !== null ? $contractor_details->address : ""?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5 default-field <?=$contractor_details === null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="city">City *</label>
                                                            <input type="text" name="city" id="city" class="form-control" required value="<?=$contractor_details !== null ? $contractor_details->city : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 default-field <?=$contractor_details === null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="state">State *</label>
                                                            <select name="state" id="state" class="form-control" required>
                                                                <option value="AK" <?=$contractor_details !== null && $contractor_details->state === "AK" ? "selected" : ""?>>AK</option>
                                                                <option value="AL" <?=$contractor_details !== null && $contractor_details->state === "AL" ? "selected" : ""?>>AL</option>
                                                                <option value="AR" <?=$contractor_details !== null && $contractor_details->state === "AR" ? "selected" : ""?>>AR</option>
                                                                <option value="AZ" <?=$contractor_details !== null && $contractor_details->state === "AZ" ? "selected" : ""?>>AZ</option>
                                                                <option value="CA" <?=$contractor_details !== null && $contractor_details->state === "CA" ? "selected" : ""?>>CA</option>
                                                                <option value="CO" <?=$contractor_details !== null && $contractor_details->state === "CO" ? "selected" : ""?>>CO</option>
                                                                <option value="CT" <?=$contractor_details !== null && $contractor_details->state === "CT" ? "selected" : ""?>>CT</option>
                                                                <option value="DC" <?=$contractor_details !== null && $contractor_details->state === "DC" ? "selected" : ""?>>DC</option>
                                                                <option value="DE" <?=$contractor_details !== null && $contractor_details->state === "DE" ? "selected" : ""?>>DE</option>
                                                                <option value="FL" <?=$contractor_details !== null && $contractor_details->state === "FL" ? "selected" : ""?>>FL</option>
                                                                <option value="GA" <?=$contractor_details !== null && $contractor_details->state === "GA" ? "selected" : ""?>>GA</option>
                                                                <option value="HI" <?=$contractor_details !== null && $contractor_details->state === "HI" ? "selected" : ""?>>HI</option>
                                                                <option value="IA" <?=$contractor_details !== null && $contractor_details->state === "IA" ? "selected" : ""?>>IA</option>
                                                                <option value="ID" <?=$contractor_details !== null && $contractor_details->state === "ID" ? "selected" : ""?>>ID</option>
                                                                <option value="IL" <?=$contractor_details !== null && $contractor_details->state === "IL" ? "selected" : ""?>>IL</option>
                                                                <option value="IN" <?=$contractor_details !== null && $contractor_details->state === "IN" ? "selected" : ""?>>IN</option>
                                                                <option value="KS" <?=$contractor_details !== null && $contractor_details->state === "KS" ? "selected" : ""?>>KS</option>
                                                                <option value="KY" <?=$contractor_details !== null && $contractor_details->state === "KY" ? "selected" : ""?>>KY</option>
                                                                <option value="LA" <?=$contractor_details !== null && $contractor_details->state === "LA" ? "selected" : ""?>>LA</option>
                                                                <option value="MA" <?=$contractor_details !== null && $contractor_details->state === "MA" ? "selected" : ""?>>MA</option>
                                                                <option value="MD" <?=$contractor_details !== null && $contractor_details->state === "MD" ? "selected" : ""?>>MD</option>
                                                                <option value="ME" <?=$contractor_details !== null && $contractor_details->state === "ME" ? "selected" : ""?>>ME</option>
                                                                <option value="MI" <?=$contractor_details !== null && $contractor_details->state === "MI" ? "selected" : ""?>>MI</option>
                                                                <option value="MN" <?=$contractor_details !== null && $contractor_details->state === "MN" ? "selected" : ""?>>MN</option>
                                                                <option value="MO" <?=$contractor_details !== null && $contractor_details->state === "MO" ? "selected" : ""?>>MO</option>
                                                                <option value="MS" <?=$contractor_details !== null && $contractor_details->state === "MS" ? "selected" : ""?>>MS</option>
                                                                <option value="MT" <?=$contractor_details !== null && $contractor_details->state === "MT" ? "selected" : ""?>>MT</option>
                                                                <option value="NC" <?=$contractor_details !== null && $contractor_details->state === "NC" ? "selected" : ""?>>NC</option>
                                                                <option value="ND" <?=$contractor_details !== null && $contractor_details->state === "ND" ? "selected" : ""?>>ND</option>
                                                                <option value="NE" <?=$contractor_details !== null && $contractor_details->state === "NE" ? "selected" : ""?>>NE</option>
                                                                <option value="NH" <?=$contractor_details !== null && $contractor_details->state === "NH" ? "selected" : ""?>>NH</option>
                                                                <option value="NJ" <?=$contractor_details !== null && $contractor_details->state === "NJ" ? "selected" : ""?>>NJ</option>
                                                                <option value="NM" <?=$contractor_details !== null && $contractor_details->state === "NM" ? "selected" : ""?>>NM</option>
                                                                <option value="NV" <?=$contractor_details !== null && $contractor_details->state === "NV" ? "selected" : ""?>>NV</option>
                                                                <option value="NY" <?=$contractor_details !== null && $contractor_details->state === "NY" ? "selected" : ""?>>NY</option>
                                                                <option value="OH" <?=$contractor_details !== null && $contractor_details->state === "OH" ? "selected" : ""?>>OH</option>
                                                                <option value="OK" <?=$contractor_details !== null && $contractor_details->state === "OK" ? "selected" : ""?>>OK</option>
                                                                <option value="OR" <?=$contractor_details !== null && $contractor_details->state === "OR" ? "selected" : ""?>>OR</option>
                                                                <option value="PA" <?=$contractor_details !== null && $contractor_details->state === "PA" ? "selected" : ""?>>PA</option>
                                                                <option value="RI" <?=$contractor_details !== null && $contractor_details->state === "RI" ? "selected" : ""?>>RI</option>
                                                                <option value="SC" <?=$contractor_details !== null && $contractor_details->state === "SC" ? "selected" : ""?>>SC</option>
                                                                <option value="SD" <?=$contractor_details !== null && $contractor_details->state === "SD" ? "selected" : ""?>>SD</option>
                                                                <option value="TN" <?=$contractor_details !== null && $contractor_details->state === "TN" ? "selected" : ""?>>TN</option>
                                                                <option value="TX" <?=$contractor_details !== null && $contractor_details->state === "TX" ? "selected" : ""?>>TX</option>
                                                                <option value="UT" <?=$contractor_details !== null && $contractor_details->state === "UT" ? "selected" : ""?>>UT</option>
                                                                <option value="VA" <?=$contractor_details !== null && $contractor_details->state === "VA" ? "selected" : ""?>>VA</option>
                                                                <option value="VT" <?=$contractor_details !== null && $contractor_details->state === "VT" ? "selected" : ""?>>VT</option>
                                                                <option value="WA" <?=$contractor_details !== null && $contractor_details->state === "WA" ? "selected" : ""?>>WA</option>
                                                                <option value="WI" <?=$contractor_details !== null && $contractor_details->state === "WI" ? "selected" : ""?>>WI</option>
                                                                <option value="WV" <?=$contractor_details !== null && $contractor_details->state === "WV" ? "selected" : ""?>>WV</option>
                                                                <option value="WY" <?=$contractor_details !== null && $contractor_details->state === "WY" ? "selected" : ""?>>WY</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5 default-field <?=$contractor_details === null ? "hide" : ""?>">
                                                        <div class="form-group">
                                                            <label for="zip_code">ZIP code *</label>
                                                            <input type="text" name="zip_code" id="zip_code" class="form-control" required value="<?=$contractor_details !== null ? $contractor_details->zip_code : ""?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer p-0">
                                <button class="btn btn-success text-white w-100 rounded-0" type="submit">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-modal"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>