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
    .modal span.select2-selection.select2-selection--single {
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
                                    <div class="card-body" style="padding: 0">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5 class="m-0">Personal details</h5>
                                                    <?php if($contractor_details === null) : ?>
                                                    <a href="#" class="text-info">Add</a>
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
                                Payments
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
                                                                <input type="radio" name="contractor_type" id="contractor-<?=strtolower($type->name)?>" class="form-check-input" value="<?=$type->id?>">
                                                                <label for="contractor-<?=strtolower($type->name)?>" class="form-check-label" <?=$contractor_details !== null && $contractor_details->contractor_type_id === $type->id ? 'checked' : ''?>><?="$type->name - $type->description"?></label>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-3 individual-type-field hide">
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input type="text" name="title" id="title" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 individual-type-field hide">
                                                        <div class="form-group">
                                                            <label for="first_name">First *</label>
                                                            <input type="text" name="first_name" id="first_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 individual-type-field hide">
                                                        <div class="form-group">
                                                            <label for="middle_name">Middle</label>
                                                            <input type="text" name="middle_name" id="middle_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 individual-type-field hide">
                                                        <div class="form-group">
                                                            <label for="last_name">Last *</label>
                                                            <input type="text" name="last_name" id="last_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 individual-type-field hide">
                                                        <div class="form-group">
                                                            <label for="suffix">Suffix</label>
                                                            <input type="text" name="suffix" id="suffix" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 business-type-field hide">
                                                        <div class="form-group">
                                                            <label for="business_name">Business name *</label>
                                                            <input type="text" name="business_name" id="business_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 default-field hide">
                                                        <div class="form-group">
                                                            <label for="name">Display name *</label>
                                                            <input type="text" name="name" id="name" class="form-control" value="<?=$contractor->name?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 individual-type-field hide">
                                                        <div class="form-group">
                                                            <label for="social_sec_num">Social Security number *</label>
                                                            <input type="text" name="social_sec_num" id="social_sec_num" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 business-type-field hide">
                                                        <div class="form-group">
                                                            <label for="emp_id_num">Employer Identification Number *</label>
                                                            <input type="text" name="emp_id_num" id="emp_id_num" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 default-field hide">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" name="email" id="email" class="form-control" value="<?=$contractor->email?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 default-field hide">
                                                        <div class="form-group">
                                                            <label for="address">Address *</label>
                                                            <textarea name="address" id="address" class="form-control" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5 default-field hide">
                                                        <div class="form-group">
                                                            <label for="city">City *</label>
                                                            <input type="text" name="city" id="city" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 default-field hide">
                                                        <div class="form-group">
                                                            <label for="state">State *</label>
                                                            <select name="state" id="state" class="form-control" required>
                                                                <option value="AK">AK</option>
                                                                <option value="AL">AL</option>
                                                                <option value="AR">AR</option>
                                                                <option value="AZ">AZ</option>
                                                                <option value="CA">CA</option>
                                                                <option value="CO">CO</option>
                                                                <option value="CT">CT</option>
                                                                <option value="DC">DC</option>
                                                                <option value="DE">DE</option>
                                                                <option value="FL">FL</option>
                                                                <option value="GA">GA</option>
                                                                <option value="HI">HI</option>
                                                                <option value="IA">IA</option>
                                                                <option value="ID">ID</option>
                                                                <option value="IL">IL</option>
                                                                <option value="IN">IN</option>
                                                                <option value="KS">KS</option>
                                                                <option value="KY">KY</option>
                                                                <option value="LA">LA</option>
                                                                <option value="MA">MA</option>
                                                                <option value="MD">MD</option>
                                                                <option value="ME">ME</option>
                                                                <option value="MI">MI</option>
                                                                <option value="MN">MN</option>
                                                                <option value="MO">MO</option>
                                                                <option value="MS">MS</option>
                                                                <option value="MT">MT</option>
                                                                <option value="NC">NC</option>
                                                                <option value="ND">ND</option>
                                                                <option value="NE">NE</option>
                                                                <option value="NH">NH</option>
                                                                <option value="NJ">NJ</option>
                                                                <option value="NM">NM</option>
                                                                <option value="NV">NV</option>
                                                                <option value="NY">NY</option>
                                                                <option value="OH">OH</option>
                                                                <option value="OK">OK</option>
                                                                <option value="OR">OR</option>
                                                                <option value="PA">PA</option>
                                                                <option value="RI">RI</option>
                                                                <option value="SC">SC</option>
                                                                <option value="SD">SD</option>
                                                                <option value="TN">TN</option>
                                                                <option value="TX">TX</option>
                                                                <option value="UT">UT</option>
                                                                <option value="VA">VA</option>
                                                                <option value="VT">VT</option>
                                                                <option value="WA">WA</option>
                                                                <option value="WI">WI</option>
                                                                <option value="WV">WV</option>
                                                                <option value="WY">WY</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5 default-field hide">
                                                        <div class="form-group">
                                                            <label for="zip_code">ZIP code *</label>
                                                            <input type="text" name="zip_code" id="zip_code" class="form-control" required>
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