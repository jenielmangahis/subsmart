<?php
defined('BASEPATH') or exit('No direct script access allowed');
// include viewPath('v2/includes/header');
include viewPath('v2/includes/accounting_header');
echo put_header_assets();
?>

<!-- Script for autosaving form -->
<!-- <script src="<?php // base_url("assets/js/estimate/autosave-standard.js") 
                    ?>"></script> -->

<div class="wrapper" role="wrapper">
    <style>
        label>input {
            visibility: initial !important;
            position: initial !important;
        }

        .but:hover {
            font-weight: 900;
            color: black;
        }

        .but-red:hover {
            font-weight: 900;
            color: red;
        }

        .required:after {
            content: " *";
            color: red;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #10ab06;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #10ab06;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .signature_mobile {
            display: none;
        }

        .show_mobile_view {
            display: none;
        }

        @media only screen and (max-device-width: 600px) {
            .label-element {
                position: absolute;
                top: -8px;
                left: 25px;
                font-size: 12px;
                color: #666;
            }

            .input-element {
                padding: 30px 5px 10px 8px;
                width: 100%;
                height: 55px;
                /* border:1px solid #CCC; */
                font-weight: bold;
                margin-top: -15px;
            }

            .mobile_qty {
                background: transparent !important;
                border: none !important;
                outline: none !important;
                padding: 0px 0px 0px 0px !important;
                text-align: center;
            }

            .select-wrap {
                border: 2px solid #e0e0e0;
                margin-top: -10px;
                padding: 0 5px 5px;
                width: 100%;
            }

            .select-wrap label {
                font-size: 10px;
                text-transform: uppercase;
                color: #777;
                padding: 2px 8px 0;
            }

            .m_select {
                border-color: white !important;
                border: 0px !important;
                outline: 0px !important;
            }

            .select2 .select2-container .select2-container--default {
                border-color: white !important;
                border: 0px !important;
                outline: 0px !important;
            }

            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #fff !important;
                border-radius: 4px;
            }

            .sub_label {
                font-size: 12px !important;
            }

            .signature_web {
                display: none;
            }

            .signature_mobile {
                display: block;
            }

            .hidden_mobile_view {
                display: none;
            }

            .show_mobile_view {
                display: block;
            }

            .table_mobile {
                font-size: 14px;
            }

            div.dropdown-wrapper select {
                width: 115%
                    /* This hides the arrow icon */
                ;
                background-color: transparent
                    /* This hides the background */
                ;
                background-image: none;
                -webkit-appearance: none
                    /* Webkit Fix */
                ;
                border: none;
                box-shadow: none;
                padding: 0.3em 0.5em;
                font-size: 13px;
            }

            .signature-pad-canvas-wrapper {
                margin: 15px 0 0;
                border: 1px solid #cbcbcb;
                border-radius: 3px;
                overflow: hidden;
                position: relative;
            }

            .signature-pad-canvas-wrapper::after {
                content: 'Name';
                border-top: 1px solid #cbcbcb;
                color: #cbcbcb;
                width: 100%;
                margin: 0 15px;
                display: inline-flex;
                position: absolute;
                bottom: 10px;
                font-size: 13px;
                z-index: -1;
            }

            .tabs {
                list-style: none;
            }

            .tabs li {
                display: inline;
            }

            .tabs li a {
                color: black;
                float: left;
                display: block;
                /* padding: 4px 10px;  */
                /* margin-left: -1px;  */
                position: relative;
                /* left: 1px;  */
                background: #a2a5a3;
                text-decoration: none;
            }

            .tabs li a:hover {
                background: #ccc;
            }

            .group:after {
                visibility: hidden;
                display: block;
                font-size: 0;
                content: " ";
                clear: both;
                height: 0;
            }

            .box-wrap {
                position: relative;
                min-height: 250px;
            }

            .tabbed-area div div {
                background: white;
                padding: 20px;
                min-height: 250px;
                position: absolute;
                top: -1px;
                left: 0;
                width: 100%;
            }

            .tabbed-area div div,
            .tabs li a {
                border: 1px solid #ccc;
            }

            #box-one:target,
            #box-two:target,
            #box-three:target {
                z-index: 1;
            }

            .group li.active a,
            .group li a:hover,
            .group li.active a:focus,
            .group li.active a:hover {
                background-color: #52cc6e;
                color: black;
            }
        }

        .is-invalid+.select2-container {
            border: 1px solid #dc3545;
            border-radius: 4px;
        } 
        .select2-results__group{
            margin:0px !important;

        }
        .select2-container--default .select2-results__option .select2-results__option{
            padding:0px !important;
        }
        .custom-header {
            background-color: #6a4a86;
            color: #ffffff;
            font-size: 15px;
            padding: 10px;
        }
    </style>

    <!-- page wrapper start -->
    <div wrapper__sectio class="nsm-content">
        <div class="page-content" style="background-color:white;">
            <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
            <br><br>
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 style="font-family: Sarabun, sans-serif">Submit Standard Estimate</h4>
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Submit your estimate. Include a breakdown of all costs
                                for this job.
                            </li>
                        </ol> -->
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown d-flex justify-content-end">
                                <?php //if (hasPermissions('WORKORDER_MASTER')) :
                                ?>
                                <a href="<?php echo base_url('accounting/newEstimateList') ?>" class="nsm-button primary" aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Estimate
                                </a>
                                <?php //endif
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background-color:white; width:100%;padding:.5%;">
                    Submit your estimate. Include a breakdown of all costs for this job.
                </div>
                <div class="nsm-callout primary">
                    <button><i class="bx bx-x"></i></button>
                    Our standard estimate form is carefully design with quantity takeoff of each items. With a clear break down of the items to be included in each project, this will insure a higher acceptance rate. Try our options form layout if you wish to give your customers a choice of multiple projects.
                </div>

            </div>
            <!-- end row -->
            <?php echo form_open_multipart('estimate/savenewestimate', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <input type="hidden" name="module" value="accounting" />
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between">
                                                <label for="customers" class="required"><b>Customer</b></label>
                                                <div class="d-flex">
                                                    <a class="nsm-link d-flex align-items-center"  data-bs-toggle="modal" data-bs-target="#new_customer" href="javascript:void(0);">
                                                        <span class="bx bx-plus"></span>Create Customer
                                                    </a>
                                                    <a class="nsm-link d-flex align-items-center" style="margin-left:5px;" data-bs-toggle="modal" data-bs-target="#quick-add-lead" href="javascript:void(0);">
                                                        <span class="bx bx-plus"></span>Create Lead
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="sel-customerdiv">
                                                <select name="customer_id" id="sel-customer" class="form-control" required>
                                                    <?php if ($default_customer_id > 0) { ?>
                                                        <option value="<?php echo $default_customer_id; ?>" selected=""><?php echo $default_customer_name; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-2">
                                        <div class="col-md-6">
                                            <label for="job_name"><b>Customer Email</b></label>
                                            <input id="estimate-customer-email" type="text" class="form-control" disabled />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="job_name"><b>Customer Mobile</b></label>
                                            <input id="estimate-customer-mobile" type="text" class="form-control" disabled />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="job_name"><b>Job Name</b> (optional)</label>
                                            <input type="text" class="form-control" name="job_name" id="job_name" placeholder="Enter Job Name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="job_location"><b>Job Location</b></label>
                                            <!-- <input type="text" class="form-control" name="job_location" id="job_location" /> -->
                                            <textarea class="form-control" name="job_location" id="job_location" style="height:150px;"></textarea>

                                            <!-- <input type="hidden" id="city2" name="city2" />
                                                <input type="hidden" id="cityLat" name="cityLat" />
                                                <input type="hidden" id="cityLng" name="cityLng" /> -->
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="col-md-12 MAP_LOADER_CONTAINER">
                                        <div class="text-center MAP_LOADER">
                                            <iframe id="TEMPORARY_MAP_VIEW"
                                                src="http://maps.google.com/maps?output=embed" height="370" width="100%"
                                                style=""></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2 mb-3" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate Date</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                    <input required type="date" value="<?= date("Y-m-d"); ?>" class="form-control" name="estimate_date" id="estimate_date_" placeholder="Enter Estimate Date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-3">
                                    <label for="expiry_date" class="required"><b>Expiry Date</b></label>
                                    <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                    <input required type="date" value="<?= date("Y-m-d", strtotime("+5 days")); ?>" class="form-control" name="expiry_date" id="expiry_date_" placeholder="Enter Expiry Date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="purchase_order_number"><b>Purchase Order #</b>&nbsp;<small class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="purchase_order_number" id="purchase_order_number" placeholder="Enter Purchase Order#" onChange="jQuery('#customer_name').text(jQuery(this).val());" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="estimate_date">Estimate Type <span style="color:red;">*</span></label>
                                    <select name="estimate_type" class="form-control">
                                        <option value="Deposit">Deposit</option>
                                        <option value="Partial Payment">Partial Payment</option>
                                        <option value="Final Payment">Final Payment</option>
                                        <option value="Total Due" selected="selected">Total Due</option>
                                    </select>
                                </div>
                                <!-- </div>
                                    <div class="row" style="background-color:white;"> -->
                                <div class="col-md-3">
                                    <label for="status" class="required"><b>Estimate Status</b></label>
                                    <!-- <input type="text" class="form-control" name="zip" id="zip" required
                                                placeholder="Enter Estimate Status"/> -->
                                    <select required name="status" class="form-control" id="estimate-status">
                                        <option value="Draft">Draft</option>
                                        <option value="Submitted">Submitted</option>
                                        <option value="Accepted">Accepted</option>
                                        <option value="Declined By Customer">Declined By Customer</option>
                                        <option value="Lost">Lost</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-12">
                                    <h6 class="custom-header">Item List</h6>                                    
                                </div>
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead style="background-color:#E9E8EA;">
                                            <tr>
                                                <th>Name</th>
                                                <th>Group</th>
                                                <!-- <th>Description</th> -->
                                                <th width="150px">Quantity</th>
                                                <!-- <th>Location</th> -->
                                                <th width="150px">Price</th>
                                                <th class="hidden_mobile_view" width="150px">Discount</th>
                                                <th class="hidden_mobile_view" width="150px">Tax (Change in %)</th>
                                                <th class="hidden_mobile_view">Total</th>
                                                <th class="hidden_mobile_view"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body"></tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_estimate" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> &emsp; -->
                                    <!-- <a href="#" id="add_another" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Items in bulk</a> -->
                                    <div class="mt-4">
                                    <a class="link-modal-open nsm-link nsm-button primary" href="#" id="add_another_items" data-bs-toggle="modal" data-bs-target="#item_list"><span class="bx bx-plus-medical"></span> Add Items</a>
                                    <a class="link-modal-open nsm-link nsm-button primary" href="#" id="add_package" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><span class="bx bx-plus-medical"></span> Add Package</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;font-size:16px;">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-5">
                                    <!-- <table class="table" style="text-align:left;">
                                            <tr>
                                                <td>Subtotal</td>
                                                <td></td>
                                                <td>$ <span id="span_sub_total_invoice">0.00</span>
                                                    <input type="hidden" name="sub_total" id="item_total"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                                <td style="width:150px;">
                                                <input type="number" name="adjustment_input" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                    <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                </td>
                                                <td>0.00</td>
                                            </tr>
                                            <tr>
                                                <td><b>Grand Total ($)</b></td>
                                                <td></td>
                                                <td><b><span id="grand_total">0.00</span>
                                                    <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                            </tr>
                                        </table> -->
                                    <table class="table table_mobile" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <!-- <td></td> -->
                                            <td colspan="2" align="right">$<span id="span_sub_total_invoice">0.00</span>
                                                <input type="hidden" name="subtotal" id="item_total">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <!-- <td></td> -->
                                            <td colspan="2" align="right">$<span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:80%; display:inline-block; border: 1px dashed #d1d1d1">
                                                <i id="help-popover-adjustment" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;" data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""></i> 
                                            </td>
                                            <td colspan="2" style="text-align: right;">
                                                <div class="input-group mb-2" style="width: 40%;float: right;">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <input type="number" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:50%;display:inline;text-align: right;padding:0px;">
                                                </div>
                                                <span id="adjustmentText" style="display: none;">0.00</span>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                                <td>Markup $<span id="span_markup"></td> -->
                                        <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                        <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                        <!-- </tr> -->
                                        <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                            <td>Amount Saved</td>
                                            <td></td>
                                            <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input"></td>
                                        </tr>
                                        <tr>
                                            <td>Markup</td>
                                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td>
                                            <td style="text-align:right;">
                                                <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                <span id="markup_display">$<span id="span_markup_input_form">0.00</span></span>
                                            </td>
                                        </tr>
                                        <tr style="color:blue;font-weight:bold;font-size:16px;">
                                            <td><b>Grand Total ($)</b></td>
                                            <td  colspan="2" style="text-align:right;"><b><span id="grand_total">0.00</span>
                                                    <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-12">
                                    <h6>Request a Deposit</h6>
                                    <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <select name="deposit_request" class="form-control">
                                        <option value="1" selected="selected">Deposit amount $</option>
                                        <option value="2">Percentage %</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon bold">$</div> -->
                                        <input type="text" name="deposit_amount" value="0" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 form-group">
                                        0.00
                                    </div> -->
                            </div>
                            <br>
                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>
                                            <h6>Message to Customer</h6>
                                        </label> <span class="help help-sm help-block">Add a message that will be displayed on the estimate.</span>
                                        <textarea name="customer_message" id="message_est" cols="40" rows="2" class="form-control">I would be happy to have an opportunity to work with you.</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>
                                            <h6>Terms &amp; Conditions</h6>
                                        </label> <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the estimate.</span>
                                        <textarea name="terms_conditions" cols="40" rows="2" class="form-control" id="terms_conditions_est"></textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-4">
                                    <label for="billing_date">
                                        <h6>Attachment</h6>
                                    </label>
                                    <span class="help help-sm help-block">Optionally attach files to this invoice. Allowed type: pdf, doc, dock, png, jpg, gif</span>
                                    <input type="file" name="est_contract_upload" id="est_contract_upload" class="form-control" />
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><h6>Instructions</h6></label>
                                        <span class="help help-sm help-block">Optional internal notes, will not appear to customer</span>
                                        <textarea name="instructions" cols="40" rows="2" class="form-control" id="instructions_est"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <a href="<?php echo url('accounting/newEstimateList') ?>" class="nsm-button" style="color: black;">Cancel</a>
                                    <!-- <button type="button" class="nsm-button" style="margin: 0; height: 34px;" id="estimate-save-draft-btn">Save as Draft</button> -->
                                    <button type="button" class="nsm-button primary" style="margin: 0; height: 34px;" id="estimate-save-btn">Save</button>
                                    <!-- <button type="button" class="btn btn-success but" style="border-radius: 0 !important;">Preview</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>

            <!-- Modal Service Address -->
            <div class="modal fade nsm-modal" id="modalServiceAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="nsm-button primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL CLONE estimate -->
            <div class="modal fade nsm-modal" id="modalCloneEstimate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Clone Estimate</h4>
                        </div>
                        <div class="modal-body">
                            <form name="clone-modal-form">
                                <div class="validation-error" style="display: none;"></div>
                                <p>
                                    You are going create a new Estimate based on <b>Estimate #<span class="work_order_no"></span> <input type="hidden" id="wo_id" name="wo_id"> </b>.<br>
                                    Afterwards you can edit the newly created Estimate.
                                </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" type="button" data-bs-dismiss="modal">Close</button>
                            <button id="clone_workorder" class="nsm-button primary" type="button" data-clone-modal="submit">Clone
                                estimate
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade nsm-modal bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3">
                            <table id="dt-package-list" class="table-hover" style="width: 100%;">
                                <thead>
                                    <tr>                                        
                                        <td></td>
                                        <td>Name</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($packages as $package) { ?>
                                        <tr>
                                            <td>
                                                <button id="<?= $package->id; ?>" type="button" data-bs-dismiss="modal" class="nsm-button primary select_package"><span class="fa fa-plus"></span> </button>
                                            </td>
                                            <td><?php echo $package->name; ?></td>                                            
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Additional Contact -->
            <div class="modal fade nsm-modal" id="modalAdditionalContacts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="nsm-button primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Set Markup -->
            <div class="modal fade nsm-modal" id="modalSetMarkup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Set Markup</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Set percent or fixed markup that will be applied to each item.</p>
                            <p>The markup will not be visible to customer estimate.</p>

                            <!-- <div class="btn-group margin-right-sec" role="group" aria-label="...">
                                <button class="btn btn-default btn-markup-percent" type="button" name="markup_type_percent">%</button>
                                <button class="btn btn-success btn-markup-dollar" type="button" name="markup_type_dollar" id="markup_type_dollar">$</button>&emsp;&emsp;
                                <input class="form-control" name="markup_input" id="markup_input" type="number" style="width: 260px;">
                            </div> -->
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">$</span>
                                <input class="form-control" name="markup_input" id="markup_input" type="number"
                                    style="width: 260px;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="nsm-button primary setmarkup">Set Markup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade nsm-modal" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-fw bx-x m-0"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="modal_items_list" class="table-hover" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <td></td>
                                                <td>Name</td>                                              
                                                <td>Price</td>  
                                                <td>Type</td>                                              
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($items as $item){ ?>
                                                <tr>
                                                    <td style="width: 5% !important;">
                                                        <button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="nsm-button primary small select_item">
                                                        <i class='bx bx-plus-medical'></i>
                                                        </button>
                                                    </td>
                                                    <td><?php echo $item->title; ?></td>                     
                                                    <td><?php echo $item->type; ?></td>
                                                    <td style="text-align:right;0">$<?php echo $item->price; ?></td>                                                                                                        
                                                </tr>
                                                
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Modal New Customer -->
            <div class="modal fade nsm-modal" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="top: 107px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="nsm-button primary saveCustomer">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade nsm-modal" id="modalAddNewSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="source_name" value="" class="form-control" autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="nsm-button primary save">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<?php echo $file_selection; ?>
<?php include viewPath('v2/pages/job/modals/new_customer'); ?>
<?php include viewPath('v2/includes/leads/quick_add'); ?>
<?php include viewPath('v2/includes/footer'); ?>

<script>
    CKEDITOR.replace('terms_conditions_est');
</script>
<script>
    CKEDITOR.replace('message_est');
</script>
<script>
    CKEDITOR.replace('instructions_est');
</script>


<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo $url->assets ?>js/add.js"></script>

<script>
    $(document).ready(function() {
        

        $('#modal_items_list').DataTable({
            "autoWidth": false,
            "columnDefs": [{
                    width: 540,
                    targets: 0
                },
                {
                    width: 100,
                    targets: 0
                },
                {
                    width: 100,
                    targets: 0
                }
            ],
            "ordering": false,
        });

        //iterate through all the divs - get their ids, hide them, then call the on click
        $(".toggle").each(function() {
            var $context = $(this);
            var $button = $context.find("#rebatable_toggle");
            //            $currentId = $button.attr('id');
            // var $divOptions = $context.find('div').last();
            //$($divOptions).hide();
            $($button).on('change', function(event) {
                // alert('yeah');
                // $(this).click(function() {
                var id = $($button).attr("item-id");
                var get_val = $($button).val();
                // alert(id);

                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>accounting/changeRebate",
                    data: {
                        id: id,
                        get_val: get_val
                    },
                    dataType: 'json',
                    success: function(response) {
                        // alert('Successfully Change');
                        sucess("Rebate Updated Successfully!");
                        // $('.lamesa').load(window.location.href +  ' .lamesa');
                        // location.reload();
                        $('#item_list').modal('toggle');
                        // $("#item_list .modal-body").load(target, function() {
                        // $("#item_list").modal("show");
                        // });
                        $('#item_list').on('hidden.bs.modal', function(e) {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        alert('Error' + response);

                    }
                });

                function sucess(information, $id) {
                    Swal.fire({
                        title: 'Good job!',
                        text: information,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "<?= base_url(); ?>customer/preview/" + $id;
                        }
                    });
                }

                // });
            });
        });
    });
</script>

<script>
    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }


    $(document).ready(function() {
        $('#help-popover-adjustment').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
            } 
        }); 

        $('#sel-customer').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer_lead',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function(data) {
                return {
                        results: [{
                        children: $.map(data, function(item) {
                            item.text = item.name;
                            return item;
                        })
                        }]
                    };
                },
                cache: true
              },
              minimumInputLength: 0,
              templateResult: formatRepoCustomer,
              templateSelection: formatRepoCustomerSelection
        });

        function formatRepoCustomerSelection(repo) {
            return repo.text;
        }

        function formatRepoCustomer(repo) {
            if (!repo.id){
                var $container = $(repo.text);
                return $container;
            } 

            var $container = $(repo.html);

            return $container;
        }
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        $("#new_customer_form").submit(function(e) {
            e.preventDefault(); 
            var form = $(this);
            $.ajax({
                type: "POST",
                url: base_url + "customer/_quick_add_customer",
                data: form.serialize(), 
                dataType:'json',
                success: function(result)
                {
                    if(result.is_success == 1){
                        $('#new_customer').modal('hide');
                        Swal.fire({
                            html: 'Customer Added Successfully',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            $('#new_customer_form')[0].reset();
                        });                        
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });                        
                    }
                }
            });
        });

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it
            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>
<script>
    $(document).ready(function() {

        $('#sel-customer').change(function() {
            var id = $(this).val();
            load_customer_address(id);
        });

        <?php if ($default_customer_id > 0) { ?>
            load_customer_address("<?= $default_customer_id; ?>");
        <?php } ?>

        function load_customer_address(id) {

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>/accounting/addLocationajax",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.customer.email) {
                        $("#estimate-customer-email").val(response.customer.email);
                    }

                    if (response.customer.phone_m) {
                        $("#estimate-customer-mobile").val(response.customer.phone_m);
                    }

                    $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].city + ', ' + response['customer'].state + ' ' + response['customer'].zip_code);

                    var customer_address = response['customer'].mail_add + ', ' + response['customer'].city + ', ' +
                        ' ' + response['customer'].state + ' ' + response['customer'].zip_code;
                    
                    var map_source = 'http://maps.google.com/maps?q=' + customer_address + '&output=embed';
                    var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +'" height="370" width="100%" style=""></iframe>';
                    $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');

                },
                error: function(response) {
                    //alert('Error'+response);

                }
            });
        }

        var table = $('#dt-package-list').DataTable({
            "searching": true,
            "paging": false,
            "autoWidth": false,
            "order": [],
            "aoColumnDefs": [{
                    "sWidth": "5%",
                    "aTargets": [0]
                },
                {
                    "sWidth": "95%",
                    "aTargets": [1]
                },
            ]
        });

        $(document).on('click', '.setmarkup', function() {
            // alert('yeah');
            var markup_amount = $('#markup_input').val();

            $("#markup_input_form").val(markup_amount);
            $("#span_markup_input_form").text(markup_amount);
            $("#span_markup").text(markup_amount);

            $('#modalSetMarkup').modal('toggle');
        });
    });
</script>

<script type="text/javascript">
    // $(window).on('beforeunload', function(){
    //     var c = confirm();
    //     if(c){
    //         return true;
    //     }
    //     else
    //         return false;
    // });
</script>

<script>
    jQuery(document).ready(function() {
        $(document).on('click', '#Commercial', function() {
            $('#business_name_area').show();
        });
        $(document).on('click', '#customer_type', function() {
            $('#business_name_area').hide();
        });
        $(document).on('click', '#advance', function() {
            $('#business_name_area').hide();
        });
    });
</script>
<script>
    $(function() {
        $("#datepicker_dateissued").datepicker({
            format: 'M dd, yyyy'
        });
    });
</script>
<script>
    $('#ssn').keyup(function() {
        var foo = $(this).val().split("-").join(""); // remove hyphens
        if (foo.length > 0) {
            foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
        }
        $(this).val(foo);
    });

    $('#credit_number').keyup(function() {
        var foo = $(this).val().split("-").join(""); // remove hyphens
        if (foo.length > 0) {
            foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
        }
        $(this).val(foo);
    });

    $('#credit_number2').keyup(function() {
        var foo = $(this).val().split("-").join(""); // remove hyphens
        if (foo.length > 0) {
            foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
        }
        $(this).val(foo);
    });

    $('#other_credit_number').keyup(function() {
        var foo = $(this).val().split("-").join(""); // remove hyphens
        if (foo.length > 0) {
            foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
        }
        $(this).val(foo);
    });
    $('#spouse_contact_ssn').keyup(function() {
        var foo = $(this).val().split("-").join(""); // remove hyphens
        if (foo.length > 0) {
            foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
        }
        $(this).val(foo);
    });
</script>

<script>
    $(".select_package").click(function() {
        var idd = this.id;
        console.log(idd);
        console.log($(this).data('itemname'));
        var title = $(this).data('itemname');
        var price = $(this).data('price');

        if (!$(this).data('quantity')) {
            // alert($(this).data('quantity'));
            var qty = 0;
        } else {
            // alert('0');
            var qty = $(this).data('quantity');
        }


        $.ajax({
            type: 'POST',
            //url: "<?php echo base_url(); ?>workorder/select_package",
            url: base_url + "estimate/_get_package_items",
            data: {
                idd: idd
            },
            dataType: 'json',
            success: function(response) {
                // alert('Successfully Change');
                console.log(response['items']);

                // var objJSON = JSON.parse(response['items'][0].title);
                var inputs = "";
                var count = parseFloat($("#count").val());
                var markup, markup2 = "";

                $.each(response['items'], function(i, v) {
                    inputs += v.title;
                    count = count + 1;
                    $("#count").val(count);
                    if (v.units <= 0) {
                        v.units = 0;
                    }
                    var total_pu = v.price * v.units;
                    var total_tax = (v.price * v.units) * 7.5 / 100;

                    if( isNaN(total_tax) ){
                        total_tax = 0;
                    }

                    if( isNaN(total_pu) ){
                        total_pu = 0;
                    }

                    var total_temp = total_pu + total_tax;
                    var total = total_temp.toFixed(2);


                    markup = "<tr id=\"ss\">" +
                        "<td width=\"35%\"><input value='" + v.title + "' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='" + v.id + "' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">" + v.title + "</span></div></td>\n" +
                        "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        "<td width=\"10%\"><input data-itemid='" + v.id + "' id='quantity_" + count + "' value='0' type=\"number\" name=\"quantity[]\" data-counter='" + count + "'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
                        "<td width=\"10%\"><input id='price_" + count + "' value='" + v.price + "'  type=\"number\" name=\"price[]\" class=\"form-control price hidden_mobile_view \" placeholder=\"Unit Price\" data-counter='" + count + "'><input type=\"hidden\" class=\"priceqty\" id='priceqty_" + v.id + "' value='" + total_pu + "'><div class=\"show_mobile_view\"><span class=\"price\">" + v.price + "</span><input type=\"hidden\" class=\"form-control price\" name=\"price[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='" + v.price + "'></div></td>\n" +
                        //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                        // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                        "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_" + count + "' value=\"0\" data-counter='" + count + "'></td>\n" +
                        // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                        "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='" + v.id + "' class=\"form-control tax_change\" name=\"tax[]\" data-counter='" + count + "' id='tax1_" + count + "' min=\"0\" readonly value='" + total_tax + "'></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='" + total + "' id='span_total_" + count + "' class=\"total_per_item\">" + total +
                        // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text" + v.id + "' value='" + total + "'></td>" +
                        "<td style='padding:10px;'>" +
                        '<a href="#" class="remove nsm-button"><i class="bx bx-fw bx-trash" aria-hidden="true"></i></a>' +
                        "</td>\n" +
                        "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                    markup2 = "<tr id=\"sss\">" +
                        "<td >" + v.title + "</td>\n" +
                        "<td ></td>\n" +
                        "<td ></td>\n" +
                        "<td >" + v.price + "</td>\n" +
                        "<td ></td>\n" +
                        "<td >" + v.units + "</td>\n" +
                        "<td ></td>\n" +
                        "<td ></td>\n" +
                        "<td >0</td>\n" +
                        "<td ></td>\n" +
                        "<td ></td>\n" +
                        "</tr>";

                    calculation(count);

                });
                // $("#input_container").html(inputs);

                tableBody2 = $("#device_audit_datas");
                tableBody2.append(markup2);
                // alert(inputs);
            },
            error: function(response) {
                alert('Error' + response);

            }
        });



        //   if(!$(this).data('quantity')){
        //     // alert($(this).data('quantity'));
        //     var qty = 0;
        //   }else{
        //     // alert('0');
        //     var qty = $(this).data('quantity');
        //   }

        //   var count = parseInt($("#count").val()) + 1;
        //   $("#count").val(count);
        //   var total_ = price * qty;
        //   var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
        //   var taxes_t = parseFloat(tax_).toFixed(2);
        //   var total = parseFloat(total_).toFixed(2);
        //   var withCommas = Number(total).toLocaleString('en');
        //   total = '$' + withCommas + '.00';
        //   // console.log(total);
        //   // alert(total);
        //   markup = "<tr id=\"ss\">" +
        //       "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div></td>\n" +
        //       "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
        //       "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
        //       // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
        //       "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span><input type=\"hidden\" class=\"form-control price\" name=\"price[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='"+price+"'></div></td>\n" +
        //       // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
        //       // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
        //       "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"'></td>\n" +
        //       // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
        //       "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
        //       "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
        //       // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
        //       "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
        //       "</tr>";
        //   tableBody = $("#jobs_items_table_body");
        //   tableBody.append(markup);
        //   markup2 = "<tr id=\"sss\">" +
        //       "<td >"+title+"</td>\n" +
        //       "<td ></td>\n" +
        //       "<td ></td>\n" +
        //       "<td >"+price+"</td>\n" +
        //       "<td ></td>\n" +
        //       "<td >"+qty+"</td>\n" +
        //       "<td ></td>\n" +
        //       "<td ></td>\n" +
        //       "<td >0</td>\n" +
        //       "<td ></td>\n" +
        //       "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
        //       "</tr>";
        //   tableBody2 = $("#device_audit_datas");
        //   tableBody2.append(markup2);
        //   // calculate_subtotal();
        //   // var counter = $(this).data("counter");
        //   // calculation(idd);

        // var in_id = idd;
        // var price = $("#price_" + in_id).val();
        // var quantity = $("#quantity_" + in_id).val();
        // var discount = $("#discount_" + in_id).val();
        // var tax = (parseFloat(price) * 7.5) / 100;
        // var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
        // 2
        // );
        // if( discount == '' ){
        // discount = 0;
        // }

        // var total = (
        // (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
        // parseFloat(discount)
        // ).toFixed(2);

        // var total_wo_tax = price * quantity;

        // // alert( 'yeah' + total);


        // $("#priceqty_" + in_id).val(total_wo_tax);
        // $("#span_total_" + in_id).text(total);
        // $("#sub_total_text" + in_id).val(total);
        // $("#tax_1_" + in_id).text(tax1);
        // $("#tax1_" + in_id).val(tax1);
        // $("#discount_" + in_id).val(discount);

        // if( $('#tax_1_'+ in_id).length ){
        // $('#tax_1_'+in_id).val(tax1);
        // }

        // if( $('#item_total_'+ in_id).length ){
        // $('#item_total_'+in_id).val(total);
        // }

        // var eqpt_cost = 0;
        // var total_costs = 0;
        // var cnt = $("#count").val();
        // var total_discount = 0;
        // var pquantity = 0;
        // for (var p = 0; p <= cnt; p++) {
        // var prc = $("#price_" + p).val();
        // var quantity = $("#quantity_" + p).val();
        // var discount = $("#discount_" + p).val();
        // var pqty = $("#priceqty_" + p).val();
        // // var discount= $('#discount_' + p).val();
        // // eqpt_cost += parseFloat(prc) - parseFloat(discount);
        // pquantity += parseFloat(pqty);
        // total_costs += parseFloat(prc);
        // eqpt_cost += parseFloat(prc) * parseFloat(quantity);
        // total_discount += parseFloat(discount);
        // }
        // //   var subtotal = 0;
        // // $( total ).each( function(){
        // //   subtotal += parseFloat( $( this ).val() ) || 0;
        // // });

        // var total_cost = 0;
        // // $("#span_total_0").each(function(){
        // $('*[id^="price_"]').each(function(){
        // total_cost += parseFloat($(this).val());
        // });

        // // var totalcosting = 0;
        // // $('*[id^="span_total_"]').each(function(){
        // //   totalcosting += parseFloat($(this).val());
        // // });


        // // alert(total_cost);

        // var tax_tot = 0;
        // $('*[id^="tax1_"]').each(function(){
        // tax_tot += parseFloat($(this).val());
        // });

        // over_tax = parseFloat(tax_tot).toFixed(2);
        // // alert(over_tax);

        // $("#sales_taxs").val(over_tax);
        // $("#total_tax_input").val(over_tax);
        // $("#total_tax_").text(over_tax);


        // eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
        // total_discount = parseFloat(total_discount).toFixed(2);
        // stotal_cost = parseFloat(total_cost).toFixed(2);
        // priceqty = parseFloat(pquantity).toFixed(2);
        // // var test = 5;

        // var subtotal = 0;
        // // $("#span_total_0").each(function(){
        // $('*[id^="span_total_"]').each(function(){
        // subtotal += parseFloat($(this).text());
        // });
        // // $('#sum').text(subtotal);

        // var subtotaltax = 0;
        // // $("#span_total_0").each(function(){
        // $('*[id^="tax_1_"]').each(function(){
        // subtotaltax += parseFloat($(this).text());
        // });


        // var priceqty2 = 0;
        // $('*[id^="priceqty_"]').each(function(){
        // priceqty2 += parseFloat($(this).val());
        // });

        // $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
        // // $("#span_sub_total_invoice").text(priceqty);

        // $("#eqpt_cost").val(eqpt_cost);
        // $("#total_discount").val(total_discount);
        // $("#span_sub_total_0").text(total_discount);
        // // $("#span_sub_total_invoice").text(stotal_cost);
        // // $("#item_total").val(subtotal.toFixed(2));
        // $("#item_total").val(priceqty2.toFixed(2));

        // var s_total = subtotal.toFixed(2);
        // var adjustment = $("#adjustment_input").val();
        // var grand_total = s_total - parseFloat(adjustment);
        // var markup = $("#markup_input_form").val();
        // var grand_total_w = grand_total + parseFloat(markup);

        // // $("#total_tax_").text(subtotaltax.toFixed(2));
        // // $("#total_tax_").val(subtotaltax.toFixed(2));




        // $("#grand_total").text(grand_total_w.toFixed(2));
        // $("#grand_total_input").val(grand_total_w.toFixed(2));
        // $("#grand_total_inputs").val(grand_total_w.toFixed(2));

        // var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
        // sls = parseFloat(sls).toFixed(2);
        // $("#sales_tax").val(sls);
        // cal_total_due();
    });
</script>

<script>
    window.document.addEventListener("DOMContentLoaded", async () => {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        if (!params.customer || !params.customer.length) return;

        const $customer = document.querySelector("[name=customer_id]");
        if (!$customer) return;

        await sleep(300);
        $($customer).val(params.customer).trigger("change");
    });
</script>

<script>
    window.document.addEventListener("DOMContentLoaded", async () => {
        //const $saveDraftButton = document.getElementById("estimate-save-draft-btn");
        const $saveButton = document.getElementById("estimate-save-btn");

        const $statusSelect = document.getElementById("estimate-status");
        const $form = document.getElementById("estimate_form");

        // $saveDraftButton.addEventListener("click", () => {
        //     $statusSelect.value = "Draft";
        //     if (!isFormValid($form)) return;
        //     $form.submit();
        // });

        $saveButton.addEventListener("click", () => {
            $statusSelect.value = "Submitted";
            const adjustment_name = $('#adjustment_name').val();
            const adjustment_value = $('#adjustment_input').val();

            if( adjustment_name == '' && adjustment_value > 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Please enter adjustment name'
                });
            }else{
                if (!isFormValid($form)) return;
                $form.submit();
            }
        });

        function isFormValid($formElement) {
            const $requiredInputs = [...$formElement.querySelectorAll("[required]")];
            let $firstInputHasError = null;

            for (let index = 0; index < $requiredInputs.length; index++) {
                const $input = $requiredInputs[index];
                $input.classList.remove("is-invalid");

                if ($input.getAttribute("name") === "customer_id" && $input.value === "0") {
                    $input.classList.add("is-invalid");
                    $firstInputHasError = $firstInputHasError ? $firstInputHasError : $input;
                }

                if (!$input.value) {
                    $input.classList.add("is-invalid");
                    $firstInputHasError = $firstInputHasError ? $firstInputHasError : $input;
                }
            }

            if ($firstInputHasError) {
                $firstInputHasError.focus();
            }

            return $firstInputHasError === null;
        }
    });
</script>
<script>
    $(document).on('click', '.saveCustomer', function() {

        var first_name = $('[name="first_name"]').val();
        var middle_name = $('[name="middle_name"]').val();
        var last_name = $('[name="last_name"]').val();
        var contact_email = $('[name="contact_email"]').val();
        var contact_mobile = $('[name="contact_mobile"]').val();
        var contact_phone = $('[name="contact_phone"]').val();
        var customer_type = $('[name="customer_type"]').val();
        var street_address = $('[name="street_address"]').val();
        var suite_unit = $('[name="suite_unit"]').val();
        var city = $('[name="city"]').val();
        var postcode = $('[name="postcode"]').val();
        var state = $('[name="state"]').val();
        // alert(first_name);

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>estimate/addNewCustomer",
            data: {
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                contact_email: contact_email,
                contact_mobile: contact_mobile,
                contact_phone: contact_phone,
                customer_type: customer_type,
                street_address: street_address,
                suite_unit: suite_unit,
                city: city,
                postcode: postcode,
                state: state
            },
            dataType: 'json',
            success: function(response) {
                // alert('success');
                location.reload();
            },
            error: function(response) {
                location.reload();

            }
        });

    });
</script>
<script>
    function handleInputChange() {
        var input = document.getElementById('markup_input');
        var span = document.getElementById('span_markup_input_form');

        if (input.value === '' || isNaN(input.value)) {
            input.value = '0.00';
            span.textContent = '0.00';
        }
    }

    function setDefault() {
        var input = document.getElementById('markup_input');
        if (input.value === '') {
            input.value = '0.00';
        }
    }

    document.getElementById('markup_input').addEventListener('input', handleInputChange);
    document.getElementById('markup_input').addEventListener('focus', setDefault);

    document.querySelector('.btn-markup-percent').addEventListener('click', function() {
        var input = document.getElementById('markup_input');
        var display = document.getElementById('markup_display');
        var span = document.getElementById('span_markup_input_form');
        input.value = '0';
        display.innerHTML = '%<span id="span_markup_input_form">0.00</span>';
    });

    document.querySelector('.btn-markup-dollar').addEventListener('click', function() {
        var input = document.getElementById('markup_input');
        var display = document.getElementById('markup_display');
        var span = document.getElementById('span_markup_input_form');
        input.value = '0';
        display.innerHTML = '$<span id="span_markup_input_form">0.00</span>';
    });
</script>
<!-- <script src="<?php //base_url("assets/js/custom.js") 
                    ?>"></script> -->