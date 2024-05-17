<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>

<!-- Script for autosaving form -->
<script src="<?php echo base_url('assets/js/estimate/autosave-standard.js'); ?>"></script>

<div class="wrapper" role="wrapper">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <style>
    .remove {
        display: block;
        width: 38px;
        float: right;
    }

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

    .MAP_LOADER_CONTAINER {
        min-height: 350px;
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

    .dataTables_filter,
    .dataTables_length {
        display: none;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px 18px;
        border-bottom: 1px solid lightgray;
    }

    table.dataTable.no-footer {
        border-bottom: 0px !important;
        margin-bottom: 10px !important;
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-color: lightgray;
        border-width: 0;
    }

    .help-block {
        font-size: 13px;
        display: inline-block;
        margin-left: 3px;
        font-style: italic;
    }

    label.bold {
        font-weight: bold;
    }

    .add-item-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #jobs_items_table_body tr td {
        border: none;
    }

    #jobs_items_table_body tr:not(.description) td {
        padding-top: 20px;
    }

    #jobs_items_table_body tr.description {
        border-bottom: 1px solid lightgray;
    }

    #jobs_items_table_body tr.description td {
        padding-bottom: 20px;
    }

    #jobs_items_table_body tr.description td {
        margin-bottom: 20px;
    }
    </style>

    <!-- page wrapper start -->
    <div wrapper__sectio class="nsm-content">
        <div class="page-content" style="background-color:white;">
            <?php include viewPath('estimate/v2/header'); ?>

            <div class="page-title-box">
                <!-- <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 style="font-family: Sarabun, sans-serif">Submit Standard Estimate</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Submit your estimate. Include a breakdown of all costs
                                for this job.
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown d-flex justify-content-end">
                                <a href="<?php echo base_url('estimate'); ?>" class="nsm-button primary" aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Estimate
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background-color:white; width:100%;padding:.5%;">
                    Submit your estimate. Include a breakdown of all costs for this job.
                </div> -->
                <div class="nsm-callout primary">
                    <button><i class="bx bx-x"></i></button>
                    Our standard estimate form is carefully design with quantity takeoff of each items. With a clear
                    break down of the items to be included in each project, this will insure a higher acceptance rate.
                    Try our options form layout if you wish to give your customers a choice of multiple projects.
                </div>

            </div>
            <!-- end row -->
            <?php echo form_open_multipart('estimate/savenewestimate', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-between">
                                                <label for="job_name"><b>Customer</b></label>
                                                <div class="d-flex">
                                                    <a class="nsm-link d-flex align-items-center" data-bs-toggle="modal"
                                                        data-bs-target="#new_customer" href="javascript:void(0);">
                                                        <span class="bx bx-plus"></span>Create Customer
                                                    </a>
                                                    <a class="nsm-link d-flex align-items-center"
                                                        style="margin-left:5px;" data-bs-toggle="modal"
                                                        data-bs-target="#quick-add-lead" href="javascript:void(0);">
                                                        <span class="bx bx-plus"></span>Create Lead
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="sel-customerdiv">
                                                <select id="customer_id" name="customer_id"
                                                    data-customer-source="dropdown"
                                                    class="form-control searchable-dropdown" required>
                                                    <option value="">- Select Customer -</option>
                                                    <?php if ($default_customer_id > 0) { ?>
                                                    <option value="<?php echo $default_customer_id; ?>" selected>
                                                        <?php echo $default_customer_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="job_name"><b>Customer Email</b></label>
                                            <input id="estimate-customer-email" type="text" class="form-control"
                                                disabled />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="job_name"><b>Customer Mobile</b></label>
                                            <input id="estimate-customer-mobile" type="text" class="form-control"
                                                disabled />
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="job_location"><b>Job Location</b></label>
                                            <input type="text" class="form-control" name="job_location"
                                                id="job_location" />
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="job_name"><b>Job Name</b> (optional)</label>
                                            <input type="text" class="form-control" name="job_name" id="job_name"
                                                placeholder="Enter Job Name" />
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="job_name"><b>Business Name</b> (optional)</label>
                                            <input type="text" name="business_name" id="business_name"
                                                class="nsm-field form-control" value="" />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-1"></div>
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
                            <hr>
                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate Date</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                    <input required type="date" class="form-control" name="estimate_date"
                                        id="estimate_date_" placeholder="Enter Estimate Date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-3">
                                    <label for="expiry_date" class="required"><b>Expiry Date</b></label>
                                    <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                    <input required type="date" class="form-control" name="expiry_date"
                                        id="expiry_date_" placeholder="Enter Expiry Date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="purchase_order_number"><b>Purchase Order#</b><small
                                            class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="purchase_order_number"
                                        id="purchase_order_number" placeholder="Enter Purchase Order#"
                                        onChange="jQuery('#customer_name').text(jQuery(this).val());" />
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

                                <div class="col-md-6 mt-4">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reminder_14d" value="1" id="reminder14d">
                                    <label class="form-check-label" for="reminder14d">
                                        <b>Remind me in 14 days</b>
                                    </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;font-size:16px;">
                                <input type="hidden" id="data_item_selected_id">

                                <div class="col-md-3">
                                    <b>Items Summary</b>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3" align="right">
                                    <b>Show qty as: </b>
                                    <select class="dropdown">
                                        <option>Quantity</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 mt-5" id="plansItemDiv" style="background-color:white;">
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
                                        <tbody id="jobs_items_table_body">
                                        </tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_estimate" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> &emsp; -->
                                    <!-- <a href="#" id="add_another" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Items in bulk</a> -->
                                    <div class="add-item-container">
                                        <a class="nsm-button primary" href="#" id="add_another_items"
                                            data-bs-toggle="modal" data-bs-target="#item_list"><i
                                                class='bx bx-plus-medical'></i> Add Another Line</a>
                                        <a class="nsm-button primary" href="#"
                                            onclick="window.open('<?php echo base_url('estimate/add_new_inventory_item'); ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');"><i
                                                class='bx bx-plus-medical'></i> Add Items</a>
                                    </div>
                                    &emsp;
                                    <!-- <a class="link-modal-open nsm-link" href="#" id="add_package" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><span class="fa fa-plus-square fa-margin-right"></span> Add Package</a> &emsp; -->
                                    <!-- <span class="link-modal-open nsm-link" id="createNewItem" style="border:solid white 1px;background-color:white;"><span class="fa fa-plus-square fa-margin-right"></span> Create New Item</span> -->
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
                                            <td colspan="2" align="right">$<span id="total_tax_">0.00</span><input
                                                    type="hidden" name="taxes" id="total_tax_input"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="no_tax" type="checkbox" value="1" id="no-tax">
                                                    <label class="form-check-label" for="noTax" style="font-size:15px;">
                                                        No Tax
                                                    </label>
                                                </div>
                                            </td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="adjustment_name" id="adjustment_name"
                                                    placeholder="Adjustment Name" class="form-control"
                                                    style="width:90%; display:inline-block; border: 1px dashed #d1d1d1">
                                                <i id="help-popover-adjustment"
                                                    class='bx bx-fw bx-info-circle ms-2 text-muted'
                                                    style="margin-top: 0px !important;" data-bs-trigger="hover"
                                                    data-bs-container="body" data-bs-toggle="popover"
                                                    data-bs-placement="top" data-bs-content=""></i>
                                            </td>
                                            <td colspan="2" style="text-align: right;">
                                                <div class="input-group mb-2" style="width: 40%;float: right;">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <input type="number" step="any" min=0 name="adjustment_value"
                                                        id="adjustment_input" value="0"
                                                        class="form-control adjustment_input"
                                                        style="width:50%;display:inline;text-align: right;padding:0px;">
                                                </div>
                                                <span id="adjustmentText" style="display: none;">0.00</span>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                                <td>Markup $<span id="span_markup"></td> -->
                                        <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                        <input type="hidden" name="markup_input_form" id="markup_input_form"
                                            class="markup_input" value="0">
                                        <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                        <!-- <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0"> -->
                                        <!-- </tr> -->
                                        <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                            <td>Amount Saved</td>
                                            <td></td>
                                            <td><span id="offer_cost">0.00</span><input type="hidden"
                                                    name="voucher_value" id="offer_cost_input"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Markup
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalSetMarkup"
                                                    style="color:#02A32C;">set markup</a>
                                            </td>
                                            <td style="text-align:right;">
                                                $<span id="span_markup">0.00</span>
                                                <input type="hidden" name="markup_input_form" id="markup_input_form"
                                                    class="markup_input" value="0">
                                                <!-- <span id="span_markup_input_form">0.00</span> -->
                                            </td>
                                        </tr>
                                        <tr style="color:blue;font-weight:bold;font-size:16px;">
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td style="text-align:right;"><b>$<span id="grand_total">0.00</span>
                                                    <input type="hidden" name="grand_total" id="grand_total_input"
                                                        value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-12">
                                    <label class="bold">Request a Deposit</label>
                                    <span class="help help-sm help-block">You can request an upfront payment on accept
                                        estimate.</span>
                                </div>
                                <!-- <div class="col-md-3 form-group">
                                    <select name="deposit_request" class="form-control">
                                        <option value="1" selected="selected">Deposit amount $</option>
                                        <option value="2">Percentage %</option>
                                    </select>
                                </div> -->
                                <div class="col-md-2 form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon bold">$</div> -->
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">%</div>
                                        </div>
                                        <input type="number" step="any" name="deposit_amount" id="deposit-percentage"
                                            value="0" class="form-control" placeholder="Percentage of total amount"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2 form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" id="deposit-total-amount" value="0.00" readonly=""
                                            disabled="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bold">Message to Customer</label>
                                        <span class="help help-sm help-block">Add a message that will be displayed on
                                            the estimate.</span>
                                        <textarea name="customer_message" id="message_est" cols="40" rows="2"
                                            class="form-control">
                                            <?php echo $default_customer_message; ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bold">Terms &amp; Conditions</label>
                                        <span class="help help-sm help-block">Mention your company's T&amp;C that will
                                            appear on the estimate.</span>
                                        <textarea name="terms_conditions" cols="40" rows="2" class="form-control"
                                            id="terms_conditions_est">
                                            <?php echo $default_terms_condition; ?>
                                        </textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-4">
                                    <label class="bold">Attachment</label>
                                    <span class="help help-sm help-block">Optionally attach files to this invoice.
                                        Allowed type: pdf, doc, dock, png, jpg, gif</span>
                                    <input type="file" name="est_contract_upload" id="est_contract_upload"
                                        class="form-control" />
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bold">Instructions</label>
                                        <span class="help help-sm help-block">Optional internal notes, will not appear
                                            to customer</span>
                                        <textarea name="instructions" cols="40" rows="2" class="form-control"
                                            id="instructions_est"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <a href="<?php echo url('estimate'); ?>" class="nsm-button"
                                        style="color: black;">Cancel</a>
                                    <!-- <button type="button" class="nsm-button" style="margin: 0; height: 34px;" id="estimate-save-draft-btn">Save as Draft</button> -->
                                    <button type="submit" class="nsm-button primary" style="margin: 0; height: 34px;"
                                        id="estimate-save-btn">Save</button>
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
            <div class="modal fade nsm-modal" id="modalServiceAddress" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="modal fade nsm-modal" id="modalCloneEstimate" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    You are going create a new Estimate based on <b>Estimate #<span
                                            class="work_order_no"></span> <input type="hidden" id="wo_id" name="wo_id">
                                    </b>.<br>
                                    Afterwards you can edit the newly created Estimate.
                                </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" type="button" data-bs-dismiss="modal">Close</button>
                            <button id="clone_workorder" class="nsm-button primary" type="button"
                                data-clone-modal="submit">Clone
                                estimate
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade nsm-modal bd-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3">
                            <table id="dt-package-list" class="table table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($packages as $package) { ?>
                                    <tr>
                                        <td><?php echo $package->name; ?></td>
                                        <td>
                                            <button id="<?php echo $package->item_categories_id; ?>" type="button"
                                                data-bs-dismiss="modal"
                                                class="btn btn-sm btn-default select_package"><span
                                                    class="fa fa-plus"></span> </button>
                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="nsm-button primary">Save changes</button> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Additional Contact -->
            <div class="modal fade nsm-modal" id="modalAdditionalContacts" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="modal fade nsm-modal" id="modalSetMarkup" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Set Markup</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <p>Set percent or fixed markup that will be applied to each item.</p> -->
                            <p>Set fixed markup that will be applied to each item.</p>
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
            <div class="modal fade" id="item_list" tabindex="-1" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                            <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button"
                                name="name-button" style="cursor: pointer;"></i>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <input id="ITEM_CUSTOM_SEARCH" style="width: 200px;" class="form-control"
                                        type="text" placeholder="Search Item...">
                                </div>
                                <div class="col-sm-12">
                                    <table id="items_table" class="table table-hover table-sm w-100">
                                        <thead class="bg-light">
                                            <tr>
                                                <td></td>
                                                <td><strong>Name</strong></td>
                                                <td><strong>On Hand</strong></td>
                                                <td><strong>Price</strong></td>
                                                <td><strong>Type</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <button style="display:none" type="button" data-bs-dismiss="modal"
                                                data-trigger="trigger_button"
                                                class='nsm-button primary small select_item2a'><i
                                                    class='bx bx-plus-medical'></i></button>
                                            <?php foreach ($items as $item) { ?>
                                            <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                                <td style="width: 0% !important;">
                                                    <button type="button" data-bs-dismiss="modal"
                                                        class='nsm-button primary small select_item2a'
                                                        id="<?php echo $item->id; ?>"
                                                        data-item_type="<?php echo ucfirst($item->type); ?>"
                                                        data-quantity="<?php echo $item_qty[0]->total_qty; ?>"
                                                        data-itemname="<?php echo $item->title; ?>"
                                                        data-description="<?php echo $item->description; ?>"
                                                        data-price="<?php echo $item->price; ?>"
                                                        data-location_name="<?php echo $item->location_name; ?>"
                                                        data-location_id="<?php echo $item->location_id; ?>"><i
                                                            class='bx bx-plus-medical'></i></button>
                                                </td>
                                                <td><?php echo $item->title; ?></td>
                                                <td>
                                                    <?php
                                                            foreach ($itemsLocation as $itemLoc) {
                                                                if ($itemLoc->item_id == $item->id) {
                                                                    echo "<div class='data-block'>";
                                                                    echo $itemLoc->name.' = '.$itemLoc->qty;
                                                                    echo '</div>';
                                                                }
                                                            }
                                                ?>
                                                </td>
                                                <td><?php echo $item->price; ?></td>
                                                <td><?php echo $item->type; ?></td>

                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade nsm-modal" id="modalAddNewSource" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" name="source_name" value="" class="form-control"
                                        autocomplete="off">
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
    <!-- page wrapper end -->
</div>

<?php echo $file_selection; ?>
<?php include viewPath('v2/pages/job/modals/new_customer'); ?>
<?php include viewPath('v2/includes/leads/quick_add'); ?>
<?php
// JS to add only Job module
add_footer_js([
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
]);
?>
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
<script src="<?php echo $url->assets; ?>js/add.js"></script>

<script>
//   $(function() {
//     $("#rebatable_toggle").each(function(){
//     $(this).change(function() {
//     //   $('#console-event').html('Toggle: ' + $(this).prop('checked'))
//     alert('yeah');
//     })
//   })
$(document).ready(function() {

    $('#customer_id').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer_lead',
            dataType: 'json',
            delay: 250,
            data: function(params) {
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
        if (!repo.id) {
            var $container = $(repo.text);
            return $container;
        }

        var $container = $(repo.html);

        return $container;
    }

    $("#new_customer_form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "customer/_quick_add_customer",
            data: form.serialize(),
            dataType: 'json',
            success: function(result) {
                if (result.is_success == 1) {
                    $('#new_customer').modal('hide');
                    Swal.fire({
                        html: 'Customer Added Successfully',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
            }
        });
    });

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
                        window.location.href =
                            "<?php echo base_url(); ?>customer/preview/" + $id;
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
    $('#sel-customer').select2();
    var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : ''; ?>";

    /*$('#customers')
        .empty() //empty select
        .append($("<option/>") //add option tag in select
            .val(customer_id) //set value for option to post it
        .val(customer_id) //select option of select2
        .trigger("change"); //apply to select2*/
});
</script>

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script> -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo google_credentials()['api_key']; ?>&callback=initialize&libraries=&v=weekly"></script>
<script>
    function initialize() {
        var input = document.getElementById('job_location');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            document.getElementById('city2').value = place.name;
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script> -->

<script>
$(document).ready(function() {
    $('#help-popover-adjustment').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        }
    });

    $('#customer_id').change(function() {
        var customer_leads = $(this).val();
        var customerLeads = customer_leads.split("/");
        var customer_lead_type = customerLeads[1];
        var customer_lead_id = customerLeads[0];

        if (customer_lead_type == 'Customer') {
            load_customer_data(customer_lead_id);
        } else {
            load_lead_data(customer_lead_id)
        }
    });

    <?php if ($default_customer_id > 0) { ?>
    load_customer_data("<?php echo $default_customer_id; ?>");
    <?php } ?>

    function load_lead_data(lead_id) {
        $.ajax({
            type: "POST",
            url: base_url + 'customer/_get_lead_data',
            data: {
                lead_id: lead_id
            },
            dataType: 'json',
            beforeSend: function(response) {

            },
            success: function(response) {
                setTimeout(function() {
                    var lead_business_name = '';
                    var lead_name = response.firstname + ' ' + response.lastname;
                    var lead_email = response.email_add;
                    var lead_phone = response.phone_home;
                    var lead_mobile = response.phone_cell;
                    var lead_address = response.address + ', ' + response.city + ', ' +
                        ' ' + response.state + ' ' + response.zip;

                    if (lead_email == '') {
                        lead_email = 'Not Specified';
                    }

                    if (lead_phone == '') {
                        lead_phone = 'Not Specified';
                    }

                    if (lead_mobile == '') {
                        lead_mobile = 'Not Specified';
                    }

                    $("#estimate-customer-email").val(lead_email);
                    $("#estimate-customer-mobile").val(lead_mobile);
                    $("#job_location").val(lead_address);
                    $('#business_name').val(lead_business_name);

                    var map_source = 'http://maps.google.com/maps?q=' + lead_address +
                        '&output=embed';
                    var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +
                        '" height="370" width="100%" style=""></iframe>';
                    $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');
                }, 200);
            },
            error: function(e) {

            }
        });
    }

    function load_customer_data(customer_id) {
        $.ajax({
            type: "POST",
            url: base_url + 'customer/_get_customer_data',
            data: {
                customer_id: customer_id
            },
            dataType: 'json',
            beforeSend: function(response) {

            },
            success: function(response) {
                setTimeout(function() {
                    var customer_business_name = response.business_name;
                    var customer_name = response.first_name + ' ' + response.last_name;
                    var customer_email = response.email;
                    var customer_phone = response.phone_h;
                    var customer_mobile = response.phone_m;
                    var customer_address = response.mail_add + ', ' + response.city + ', ' +
                        ' ' + response.state + ' ' + response.zip_code;

                    if (customer_business_name == '') {
                        customer_business_name = 'Not Specified';
                    }

                    if (customer_email == '') {
                        customer_email = 'Not Specified';
                    }

                    if (customer_phone == '') {
                        customer_phone = 'Not Specified';
                    }

                    if (customer_mobile == '') {
                        customer_mobile = 'Not Specified';
                    }

                    $("#estimate-customer-email").val(customer_email);
                    $("#estimate-customer-mobile").val(customer_mobile);
                    $("#job_location").val(customer_address);
                    $('#business_name').val(customer_business_name);

                    var map_source = 'http://maps.google.com/maps?q=' + customer_address +
                        '&output=embed';
                    var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +
                        '" height="370" width="100%" style=""></iframe>';
                    $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');
                }, 200);
            },
            error: function(e) {

            }
        });
    }

    var table = $('#dt-package-list').DataTable({
        "searching": true,
        "paging": false,
        "autoWidth": false,
        "order": [],
        "aoColumnDefs": [{
                "sWidth": "95%",
                "aTargets": [0]
            },
            {
                "sWidth": "5%",
                "aTargets": [1]
            },
        ]
    });

    $(document).on('click', '.setmarkup', function() {
        // alert('yeah');
        var markup_amount = $('#markup_input').val();

        $("#markup_input_form").val(markup_amount);
        //$("#span_markup_input_form").text(markup_amount);
        $("#span_markup").text(markup_amount);

        $('#modalSetMarkup').modal('toggle');
    });

    $('#modalQuickAddCustomer').modal({
        backdrop: 'static',
        keyboard: false
    });

    $('.btn-quick-add-customer').on('click', function() {
        $('#modalQuickAddCustomer').modal('show');
        $.ajax({
            url: base_url + 'invoice/new_customer_form',
            type: "GET",
            success: function(response) {
                $('#modalQuickAddCustomer .modal-body').html(response);
            },
            beforeSend: function(data) {
                $('#modalQuickAddCustomer .modal-body').html(
                    '<span class="bx bx-loader bx-spin"></span>')
            },
        });
    });

    $('#frm-estimate-quick-add-customer').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>estimate/addNewCustomer",
            data: $('#frm-estimate-quick-add-customer').serialize(),
            dataType: 'json',
            success: function(response) {
                $('#modalQuickAddCustomer').modal('hide');
                Swal.fire({
                    text: 'Customer data was created successfully',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.reload();
                });

            },
            error: function(response) {
                console.log(response);

            }
        });
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
    var ITEMS_TABLE = $('#items_table').DataTable({
        "ordering": false,
    });

    $("#ITEM_CUSTOM_SEARCH").keyup(function() {
        ITEMS_TABLE.search($(this).val()).draw()
    });

    $("#datepicker_dateissued").datepicker({
        format: 'M dd, yyyy'
    });

    $('#deposit-percentage').keypress(function() {
        computeDepositAmount();
    });

    $('#grand_total_input').change(function() {
        computeDepositAmount();
        no_tax();
    });

    $('#no-tax').on('change', function(){
        computeDepositAmount();
        no_tax();
    });

    function no_tax(){
        if($('#no-tax').is(':checked')) {
            var grand_total = $('#grand_total_input').val();
            var total_tax   = $('#total_tax_input').val();
            var new_grand_total = parseFloat(grand_total) - parseFloat(total_tax);
        }else{            
            var grand_total = $('#grand_total_input').val();
            var new_grand_total = parseFloat(grand_total);
        }

        if( isNaN(new_grand_total) ){
            new_grand_total = 0;
        }

        $('#grand_total').text(new_grand_total.toFixed(2));
    }

    function computeDepositAmount() {
        if($('#no-tax').is(':checked')) {
            var grand_total = $('#grand_total_input').val();
            var total_tax   = $('#total_tax_input').val();
            var new_grand_total = parseFloat(grand_total) - parseFloat(total_tax);
        }else{            
            var grand_total = $('#grand_total_input').val();
            var new_grand_total = parseFloat(grand_total);
        }

        var deposit_amount = $('#deposit-percentage').val() / 100;
        var total_amount   = new_grand_total;

        if (total_amount > 0) {
            total_amount = total_amount * deposit_amount;
            $('#deposit-total-amount').val(total_amount.toFixed(2));
        } else {
            $('#deposit-total-amount').val('0.00');
        }
    }
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
        url: "<?php echo base_url(); ?>workorder/select_package",
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
                var total_temp = total_pu + total_tax;
                var total = total_temp.toFixed(2);


                markup = "<tr id=\"ss\">" +
                    "<td width=\"35%\"><input value='" + v.title +
                    "' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='" +
                    v.id +
                    "' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">" +
                    v.title + "</span></div></td>\n" +
                    "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                    "<td width=\"10%\"><input data-itemid='" + v.id + "' id='quantity_" +
                    count + "' value='" + v.units +
                    "' type=\"number\" name=\"quantity[]\" data-counter='" + count +
                    "'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
                    "<td width=\"10%\"><input id='price_" + count + "' value='" + v.price +
                    "'  type=\"number\" name=\"price[]\" class=\"form-control price hidden_mobile_view \" placeholder=\"Unit Price\" data-counter='" +
                    count + "'><input type=\"hidden\" class=\"priceqty\" id='priceqty_" + v
                    .id + "' value='" + total_pu +
                    "'><div class=\"show_mobile_view\"><span class=\"price\">" + v.price +
                    "</span><input type=\"hidden\" class=\"form-control price\" name=\"price[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='" +
                    v.price + "'></div></td>\n" +
                    //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                    // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                    "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_" +
                    count + "' value=\"0\" data-counter='" + count + "'></td>\n" +
                    // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                    "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='" +
                    v.id +
                    "' class=\"form-control tax_change\" name=\"tax[]\" data-counter='" +
                    count + "' id='tax1_" + count + "' min=\"0\" readonly value='" +
                    total_tax + "'></td>\n" +
                    "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='" +
                    total + "' id='span_total_" + count + "' class=\"total_per_item\">" +
                    total +
                    // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                    "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text" + v
                    .id + "' value='" + total + "'></td>" +
                    "<td>\n" +
                    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                    "</td>\n" +
                    "</tr>";
                tableBody = $("#jobs_items_table_body");
                tableBody.append(markup);
                markup2 = "<tr id=\"sss\">" +
                    "<td >"
                "</td>\n" +
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
    const $saveDraftButton = document.getElementById("estimate-save-draft-btn");
    const $saveButton = document.getElementById("estimate-save-btn");

    const $statusSelect = document.getElementById("estimate-status");
    const $form = document.getElementById("estimate_form");

    $saveDraftButton.addEventListener("click", () => {
        $statusSelect.value = "Draft";
        if (!isFormValid($form)) return;
        $form.submit();
    });

    $saveButton.addEventListener("click", () => {
        $statusSelect.value = "Submitted";
        if (!isFormValid($form)) return;
        $form.submit();
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
let itemSelectedId = []
$(".select_item2a").click(function() {
    // taxRate();
    itemSelectedId = $('#data_item_selected_id').val() ?
        $('#data_item_selected_id').val().split(",") : [];

    if (!itemSelectedId.includes(this.id.toString())) {

        itemSelectedId.push(this.id.toString());
    }
    // Convert array back to string with comma separator
    $('#data_item_selected_id').val(itemSelectedId.join(","));




    var idd = $(this).attr('id');

    var items = <?php echo json_encode($items); ?>;
    var title = $(this).attr('data-itemname');
    var price = parseInt($(this).attr('data-price'));
    // var qty = parseInt($(this).attr('data-quantity'));
    var location_name = $(this).data('location_name');
    var description = $(this).attr('data-description');
    var location_id = $(this).data('location_id');
    var item_type = $(this).data('item_type');

    // var total_ = price * qty;
    // var total_ = 0;
    // var total_price = price + total_;
    // var total = parseFloat(total_price).toFixed(2);
    // var withCommas = Number(total).toLocaleString('en');
    if (!$(this).data('quantity')) {
        // alert($(this).data('quantity'));
        var qty = 1;
    } else {
        // alert('0');
        var qty = $(this).data('data-quantity');
    }
    var return_first = function() {
        var tax_rate = null;
        $.ajax({
            'async': false,
            type: 'POST',
            url: "<?php echo base_url(); ?>/workorder/getTaxRate",
            success: function(result) {
                //   console.log('test '+result);
                // return result;
                // var json = $.parseJSON(result);
                // for (var i=0;i<json.length;++i)
                // {
                //     tax_rate = json[i].rate;
                // }
                tax_rate = result;
            }
        });
        return tax_rate;
    }();

    // alert(return_first);
    var json = $.parseJSON(return_first);
    var tax_rate_ = 0;
    for (var i = 0; i < json.length; ++i) {
        tax_rate_ = json[i].rate;
    }
    // alert(tax_rate_);
    var taxRate = tax_rate_;

    var count = $(this).attr('data-count') ? parseInt($(this).attr('data-count')) : parseInt($("#count").val());
    if (!$(this).attr('data-replace')) {
        count += 1
    }
    $("#count").val(count);
    var total_ = price * qty;
    var tax_ = (parseFloat(total_).toFixed(2) * taxRate) / 100;
    var taxes_t = parseFloat(tax_).toFixed(2);
    var total = parseFloat(total_).toFixed(2);
    var withCommas = Number(total).toLocaleString('en');
    total = '$' + withCommas + '.00';
    $("#ITEMLIST_PRODUCT_" + idd).hide();
    // markup = "<tr id='ss'>" +
    //     "<td width='35%'><small>Item name</small><input readonly value='"+title+"' type='text' name='item_name[]' class='form-control' ><input type='hidden' value='"+idd+"' name='item_id[]'></td>" +
    //     "<td><small>Qty</small><input data-itemid='"+idd+"' id='"+idd+"' value='1' type='number' name='item_qty[]' class='form-control item-qty-"+idd+" qty' min='0'></td>" +
    //     "<td><small>Unit Price</small><input data-id='"+idd+"' id='price"+idd+"' value='"+price+"'  type='number' name='item_price[]' class='form-control item-price' step='any' placeholder='Unit Price'></td>" +
    //     "<td><small>Item Type</small><input readonly type='text' class='form-control' value='"+item_type+"'></td>" +
    //     // "<td width='25%'><small>Inventory Location</small><input type='text' name='item_loc[]' class='form-control'></td>" +
    //     "<td><small>Amount</small><br><b data-subtotal='"+total_price+"' id='sub_total"+idd+"' class='total_per_item'>$"+total+"</b></td>" +
    //     "<td><button type='button' class='nsm-button items_remove_btn remove_item_row mt-2' onclick='$(`#ITEMLIST_PRODUCT_"+idd+"`).show();'><i class='bx bx-trash'></i></button></td>" +
    //     "</tr>";
    if (item_type == 'Product') {
        var item_type_dropdown =
            '<select name="item_type[]" class="form-control"><option selected="selected" value="product">Product</option><option value="service">Service</option><option value="fee">Fee</option></select>';
    } else if (item_type == 'Fees') {
        var item_type_dropdown =
            '<select name="item_type[]" class="form-control"><option value="product">Product</option><option value="service">Service</option><option selected="selected" value="fee">Fee</option></select>';
    } else if (item_type == 'Service') {
        var item_type_dropdown =
            '<select name="item_type[]" class="form-control"><option value="product">Product</option><option  selected="selected" value="service">Service</option><option value="fee">Fee</option></select>';
    } else {
        var item_type_dropdown =
            '<select name="item_type[]" class="form-control"><option selected="selected" value="product">Product</option><option  value="service">Service</option><option value="fee">Fee</option></select>';
    }
    var options = '';


    items.forEach(function(item) {
        options += `<option value="` + item.id + `"   data-item_type="${item.type.charAt(0).toUpperCase() + item.type.slice(1)}"
        data-itemname="` + item.title + `" data-price="` + item.price + `"  data-location_name="` + item
            .location_name + `" data-description="` + item.description + `" data-count="` + count + `"
        data-location_id="` + item.location_id + `" `;
        if (item.title == title) {
            options += ' selected="selected"';
        }
        options += '>' + item.title + '</option>';
    });
    // <input value='" + title +"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" >
    markup = "<tr id='jobs_items_table_body_tr_" + idd + "'>" +
        "<td width=\"35%\">" +
        `          <select name="items[]" class="getItemsSearch" class="form-control getItems"  id=` + idd + `>
                                            ` + options + `
                                        </select>` + "<input type=\"hidden\" value='" +
        idd +
        "' name=\"item_id[]\"><div class=\"show_mobile_view\"></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='" +
        idd + "'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
        "<td width=\"20%\"><div class=\"dropdown-wrapper\">" + item_type_dropdown + "</div></td>\n" +
        "<td width=\"10%\"><input data-itemid='" + idd + "' id='quantity_" + count + "' value='" + qty +
        "' type=\"number\" name=\"quantity[]\" data-counter='" + count +
        "'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
        // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
        "<td width=\"10%\"><input data-itemid='" + idd + "' id='price_" + count + "' value='" + price +
        "'  type=\"number\" name=\"price[]\" data-counter='" + count +
        "' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_" +
        count + "'><div class=\"show_mobile_view\"><span class=\"price\">" + price + "</span></div></td>\n" +
        // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
        // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
        "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='" +
        count + "' id='discount_" + count + "'></td>\n" +
        // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
        "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='" + idd +
        "' class=\"form-control tax_change\" name=\"tax[]\" data-counter='" + count + "' id='tax1_" + count +
        "' readonly min=\"0\" value='" + taxes_t + "'></td>\n" +
        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='" +
        total_ + "' id='span_total_" + count + "' class=\"total_per_item\">" + total +
        // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text" + count + "' value='" + total +
        "'></td>" +
        "<td>\n" +
        "<a href=\"#\" class=\"remove nsm-button danger\" id='" + count +
        "'data-row-remove='" + idd + "'  ><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
        "</td>\n" +
        `<tr class='description' id="description_` + idd + `">
    <td colspan='7'>
    <label><b>Description : </b></label> <span>` +
        (description !== '' ? description : '-----') + `</span>
    <td>
    </tr>` +
        "</tr>";


    tableBody = $("#jobs_items_table_body");
    if ($(this).attr('data-replace')) {
        var tableRow = $("#jobs_items_table_body_tr_" + $(this).attr('data-to-replace')).first();
        tableRow.closest("tr")
            .find(".remove")
            .first()
            .attr('data-remove', true)
            .click();
        tableRow.siblings("tr#description_" + $(this).attr('data-to-replace')).remove();
        $(tableRow).replaceWith(markup);
    } else {
        tableBody.append(markup);
        $('.getItemsSearch').each(function() {
            var $select = $(this);
            $select.find('option').each(function() {
                var optionValue = $(this).val();
                if (itemSelectedId.includes(optionValue.toString())) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
        });
    }


    $(this).removeAttr('data-replace');
    $(this).removeAttr('data-to-replace');

    $('.getItemsSearch').select2();
    // markup2 = "<tr id=\"sss\">" +
    //     "<td >"+title+"</td>\n" +
    //     "<td >0</td>\n" +
    //     "<td >"+price+"</td>\n" +
    //     "<td id='device_qty"+idd+"'>"+qty+"</td>\n" +
    //     "<td id='device_sub_total"+idd+"'>"+total+"</td>\n" +
    //     "<td ></td>\n" +
    //     "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></a> </td>\n" + // <a href="javascript:void(0)" class="remove_audit_item_row"><span class="fa fa-trash"></span></i></a>
    //     "</tr>";
    markup2 = "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>" +
        "<td></td>";

    //device audit
    markup3 = "<tr id='ss'>" +
        "<td>" + title + "</td>" +
        "<td>" + item_type + "</td>" +
        "<td></td>" +
        "<td>" + price + "</td>" +
        "<td id='device_qty" + idd + "'>" + qty + "</td>" +
        "<td id='device_sub_total" + idd + "'>" + total + "</td>" +
        "<td>" +
        "<input hidden name='item_id1[]' value='" + idd + "'>" +
        "<input hidden name='location_qty[]' id='location_qty" + idd + "' value='" + qty + "'>" +
        "<select id='location" + idd + "' name='location[]' class='form-control location'>" +
        "<option>Select Location</option>" +
        "<option value='" + location_id + "' selected>" + location_name + "</option>" +
        "<?php
                    if ($getAllLocation) {
                        foreach ($getAllLocation as $getAllLocations) {
                            if ($getAllLocations->default == 'true') {
                                echo "<option selected value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>";
                            } else {
                                echo "<option value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>";
                            }
                        }
                    }
?>" +
        "</select>" +
        "</td>";

    tableBody3 = $("#device_audit_append");
    tableBody3.append(markup3);
    calculation(count);


    tableBody2 = $("#device_audit_datas");
    tableBody2.append(markup2);
    //calculate_subtotal();
    $(".location").select2({
        placeholder: "Choose Location"
    });
});


async function getLoc(id, qty) {
    var postData = new FormData();
    postData.append('id', id);
    postData.append('qty', qty);
    fetch('<?php echo base_url('job/getItemLocation'); ?>', {
        method: 'POST',
        body: postData
    }).then(response => response.json()).then(response => {
        var {
            locations
        } = response;
        var select = document.querySelector('#location' + id);
        const locations_len = Object.keys(locations);
        // Avoid TypeError: Cannot set properties of null (setting 'innerHTML')
        if (select === null) return;
        console.log(locations);
        select.innerHTML = '';
        // Loop through each location and append a new option element to the select
        if (locations_len.length > 1) {
            var options = document.createElement('option');
            options.text = "Select Location";
            options.value = "0";
            select.appendChild(options);
        }


        // Get all the location name promises
        var promises = locations.map(function(location) {
            return getLocName(location.loc_id);
        });

        // Wait for all the promises to resolve
        Promise.all(promises).then(function(names) {
            // Loop through each location and append a new option element to the select
            locations.forEach(function(location, index) {
                var option = document.createElement('option');
                option.text = names[index];
                option.value = location.id;
                select.appendChild(option);
            });
        });
    }).catch((error) => {
        console.log(error);
    })
}

function getLocName(id) {
    var postData = new FormData();
    postData.append('id', id);
    return fetch('<?php echo base_url('inventory/getLocationNameById'); ?>', {
        method: 'POST',
        body: postData
    }).then(response => response.json()).then(response => {
        var {
            location
        } = response;
        return location.location_name;
    }).catch((error) => {
        console.log(error);
    })
}


function taxRate() {
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>/workorder/getTaxRate",
        success: function(result) {
            //   console.log('test '+result);
            return result;
            // var json = $.parseJSON(result);
            // for (var i=0;i<json.length;++i)
            // {
            //     tax_rate = json[i].rate;
            // }
        },
        error: function() {
            alert('Error occured');
        }
    });
}
</script>


<!-- <script src="<?php // base_url("assets/js/custom.js")?>"></script> -->