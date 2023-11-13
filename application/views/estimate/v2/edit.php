<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>

<!-- Script for autosaving form -->
<!-- <script src="<?= base_url("assets/js/estimate/autosave-standard-update.js") ?>"></script> -->

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

        .dataTables_filter, .dataTables_length{
            display: none;
        }

        .help-block{            
            font-size: 13px;
            display: inline-block;
            margin-left: 3px;
            font-style: italic;
        }
        label.bold{
            font-weight:bold;
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
                width: 115%;
                background-color: transparent;
                background-image: none;
                -webkit-appearance: none;
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
                position: relative;
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
    </style>

    <!-- page wrapper start -->
    <div wrapper__sectio class="nsm-content">
        <div class="page-content" style="background-color:white;">
            <?php include viewPath('estimate/v2/header'); ?>

            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 style="font-family: Sarabun, sans-serif">Update Estimate</h4>
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
                                <a href="<?php echo base_url('estimate') ?>" class="nsm-button primary" aria-expanded="false">
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
            <?php echo form_open_multipart('estimate/update/' . $estimate->id, ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <input type="hidden" name="est_id" value="<?php echo $estimate->id; ?>">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="customers" class="required"><b>Customer</b></label>
                                    <div id="sel-customerdiv">
                                        <select name="customer_id" id="sel-customer" class="form-control" required>
                                            <option value="0">Select a customer</option>
                                            <?php foreach ($customers as $customer) : ?>
                                                <option <?php if (isset($estimate)) {
                                                            if ($estimate->customer_id == $customer->prof_id) {
                                                                echo "selected";
                                                            }
                                                        } ?> value="<?php echo $customer->prof_id; ?>"><?php echo $customer->first_name . " " . $customer->last_name; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br><br><a class="link-modal-open nsm-button small btn-quick-add-customer" href="javascript:void(0)"><i class='bx bx-plus-medical'></i> New Customer</a>
                                </div>
                            </div>

                            <?php
                                $selectedCustomer = null;
                                foreach ($customers as $customer) {
                                    if ($customer->prof_id == $estimate->customer_id) {
                                        $selectedCustomer = $customer;
                                        break;
                                    }
                                }
                            ?>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="job_name"><b>Customer Email</b></label>
                                    <input id="estimate-customer-email" type="text" class="form-control" disabled value="<?= !is_null($selectedCustomer) ? $selectedCustomer->email : ''; ?>" />
                                </div>

                                <div class="col-md-3">
                                    <label for="job_name"><b>Customer Mobile</b></label>
                                    <input id="estimate-customer-mobile" type="text" class="form-control" disabled value="<?= !is_null($selectedCustomer) ? $selectedCustomer->phone_m : ''; ?>" />
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="job_location"><b>Job Location</b> </label>
                                    <!-- <input
                                        id="autocomplete"
                                        placeholder="Enter Location"
                                        type="text"
                                        class="form-control"
                                        autocomplete="on" runat="server"
                                    /> -->
                                    <!-- <input type="text" class="form-control" name="job_location" id="job_location" /> -->
                                    <input type="text" class="form-control" name="job_location" id="job_location" value="<?php echo $estimate->job_location; ?>" />

                                    <!-- <input type="hidden" id="city2" name="city2" />
                                    <input type="hidden" id="cityLat" name="cityLat" />
                                    <input type="hidden" id="cityLng" name="cityLng" /> -->
                                </div>
                                <div class="col-md-3">
                                    <!-- <br><br><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus" aria-hidden="true"></i> New Location Address</a> -->
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="job_name"><b>Job Name</b> (optional)</label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" placeholder="Enter Job Name" value="<?php echo $estimate->job_name; ?>" />
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3" style="background-color:white;">                                
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate Date</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                    <input type="date" class="form-control" name="estimate_date" id="estimate_date_" placeholder="Enter Estimate Date" value="<?php echo $estimate->estimate_date; ?>">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-3">
                                    <label for="expiry_date" class="required"><b>Expiry Date</b></label>
                                    <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                    <input type="date" class="form-control" name="expiry_date" id="expiry_date_" value="<?php echo $estimate->expiry_date; ?>" placeholder="Enter Expiry Date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="purchase_order_number"><b>Purchase Order# </b><small class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="purchase_order_number" id="purchase_order_number" placeholder="Enter Purchase Order#" onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $estimate->purchase_order_number; ?>" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="estimate_date"><b>Estimate Type</b> <span style="color:red;">*</span></label>
                                    <select name="estimate_type" class="form-control">
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->type == 'Deposit') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Deposit">Deposit</option>
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->type == 'Partial Payment') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Partial Payment">Partial Payment</option>
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->type == 'Final Payment') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Final Payment">Final Payment</option>
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->type == 'Total Due') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Total Due">Total Due</option>
                                    </select>
                                </div>
                                <!-- </div>
                                <div class="row" style="background-color:white;"> -->
                                <div class="col-md-3">
                                    <label for="status" class="required"><b>Estimate Status</b></label>
                                    <!-- <input type="text" class="form-control" name="zip" id="zip" required
                                            placeholder="Enter Estimate Status"/> -->
                                    <select name="status" class="form-control">
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->status == 'Draft') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Draft">Draft</option>
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->status == 'Submitted') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Submitted">Submitted</option>
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->status == 'Accepted') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Accepted">Accepted</option>
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->status == 'Declined By Customer') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Declined By Customer">Declined By Customer</option>
                                        <option <?php if (isset($estimate)) {
                                                    if ($estimate->status == 'Lost') {
                                                        echo "selected";
                                                    }
                                                } ?> value="Lost">Lost</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;font-size:16px;">
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

                            <div class="row mb-3" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
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
                                            <!-- <tr>
                                            <td width="30%">
                                                <input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="items[]">
                                                <ul class="suggestions"></ul>
                                                <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                            </td>
                                            <td width="20%">
                                            <div class="dropdown-wrapper">
                                                <select name="item_type[]" id="item_typeid" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select>
                                            </div>

                                                </td>
                                            <td width="10%"><input type="number" class="form-control quantity hidden_mobile_view" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"> <div class="show_mobile_view"><span>1</span><input type="hidden" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></div> </td>
                                            <td width="10%"><input type="number" class="form-control price hidden_mobile_view" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"> <input type="hidden" class="priceqty" id="priceqty_0"> <div class="show_mobile_view"><span class="price">0</span><input type="hidden" class="form-control price" name="price[]" data-counter="0" id="priceM_0" min="0" value="0"></div><input id="priceM_qty0" value=""  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty"></td>
                                            <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" ></td>
                                            <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                                       data-counter="0" id="tax1_0" min="0" value="0">
                                                       </td>
                                            <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                        </tr> -->
                                            <!-- <tr>
                                            <td width="30%">
                                                <input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="items[]">
                                                <ul class="suggestions"></ul>
                                                <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                                <input type="hidden" name="itemid[]" id="itemid" class="itemid">
                                            </td>
                                            <td width="20%">
                                            <div class="dropdown-wrapper">
                                                <select name="item_type[]" id="item_typeid" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select>
                                            </div>
                                                </td>
                                            <td width="10%"><input type="number" class="form-control quantity mobile_qty" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td width="10%"><input type="number" class="form-control price hidden_mobile_view" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"> <input type="hidden" class="priceqty" id="priceqty_0">
                                                       <div class="show_mobile_view"><span class="price">0</span>
                                                       </div><input id="priceM_qty0" value=""  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty"></td>
                                            <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0"  readonly></td>
                                            <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                                       data-counter="0" id="tax1_0" min="0" value="0">
                                                       </td>
                                            <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                            <td><a href="#" class="remove btn btn-sm btn-success" id="0"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        </tr> -->
                                            <?php $count = 0;
                                            foreach ($itemsDetails as $data) { ?>
                                                <tr>
                                                    <td width="30%">
                                                        <div class="hidden_mobile_view">
                                                            <input type="text" class="form-control getItems" onKeyup="getItems(this)" name="items[]" value="<?php echo $data->title; ?>">
                                                            <ul class="suggestions"></ul>
                                                            <input type="hidden" name="itemid[]" id="itemid" class="itemid" value="<?php echo $data->items_id; ?>">
                                                        </div>
                                                        <div class="show_mobile_view">
                                                            <?php echo $data->item; ?>
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="hidden_mobile_view">
                                                            <select name="item_type[]" class="form-control">
                                                                <option value="product">Product</option>
                                                                <option value="material">Material</option>
                                                                <option value="service">Service</option>
                                                                <option value="fee">Fee</option>
                                                            </select>
                                                        </div>
                                                        <div class="show_mobile_view">
                                                            <?php echo $data->item_type; ?>
                                                        </div>
                                                    </td>
                                                    <td width="10%">
                                                        <input type="number" class="form-control quantity hidden_mobile_view" name="quantity[]" data-counter="<?php echo $count; ?>" data-itemid="<?php echo $data->id; ?>" id="quantity_<?= $count; ?>" value="<?php echo $data->qty; ?>">
                                                    </td>
                                                    <td width="10%">
                                                        <input type="text" class="form-control price hidden_mobile_view" name="price[]" data-counter="<?php echo $count; ?>" data-itemid="<?php echo $data->id; ?>" id="price_<?php echo $count; ?>" min="0" value="<?php echo $data->costing; ?>">
                                                        <input type="hidden" class="priceqty" id="priceqty_<?php echo $data->id; ?>" value="<?php echo $aaa = $data->costing * $data->qty; ?>">
                                                        <div class="show_mobile_view"><?php echo $data->costing; ?></div>
                                                    </td>
                                                    <td class="hidden_mobile_view" width="10%">
                                                        <input type="number" class="form-control discount" name="discount[]" data-counter="<?php echo $count; ?>" id="discount_<?php echo $count; ?>" min="0" value="<?php echo $data->discount; ?>" />
                                                    </td>
                                                    <td class="hidden_mobile_view" width="10%"><input type="text" class="form-control tax_change" name="tax[]" data-counter="<?php echo $count; ?>" id="tax1_<?php echo $count; ?>" min="0" value="<?php echo $data->tax; ?>" readonly>
                                                        <!-- <span id="span_tax_0">0.0</span> -->
                                                    </td>
                                                    <td class="hidden_mobile_view" width="10%">
                                                        <?php
                                                        $total_item_price = $data->costing * $data->qty;
                                                        $tax = $data->tax > 0 ? $data->tax : 0;
                                                        $discount = $data->discount > 0 ? $data->discount : 0;
                                                        $total_row_price = ($total_item_price + $tax) - $data->discount;
                                                        ?>
                                                        <input type="hidden" class="form-control " name="total[]" data-counter="<?php echo $count; ?>" id="item_total_<?php echo $count; ?>" min="0" value="<?php echo $total_row_price; ?>">
                                                        <span id="span_total_<?php echo $count; ?>"><?php echo $total_row_price; ?></span>
                                                    </td>
                                                    <td><a href="javascript:void(0);" class="remove nsm-button danger"><i class="bx bx-fw bx-trash" aria-hidden="true"></i></a></td>
                                                </tr>
                                            <?php $count++;
                                            } ?>
                                        <input type="hidden" name="count" value="<?= $count ?>" id="count">

                                        </tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_estimate" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> &emsp; -->
                                    <!-- <a href="#" id="add_another" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Items in bulk</a> -->
                                    <a class="link-modal-open nsm-button primary" href="#" id="add_another_items" data-bs-toggle="modal" data-bs-target="#item_list"><i class='bx bx-plus-medical'></i> Add Items</a> &emsp;
                                    <!-- <a class="link-modal-open" href="#" id="add_package" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="fa fa-plus-square fa-margin-right"></span>Add By Group</a> -->
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
                                            <td colspan="2" align="right">$ <span id="span_sub_total_invoice"><?php echo $estimate->sub_total; ?></span>
                                                <input type="hidden" name="subtotal" id="item_total" value="<?php echo $estimate->sub_total; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <!-- <td></td> -->
                                            <td colspan="2" align="right">$ <span id="total_tax_"><?php echo $estimate->tax1_total; ?></span><input type="hidden" name="taxes" id="total_tax_input" value="<?php echo $estimate->tax1_total; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:90%; display:inline-block; border: 1px dashed #d1d1d1" value="<?php echo $estimate->adjustment_name; ?>">
                                                <span id="help-popover-adjustment" class="fa fa-question-circle"></span>
                                            </td>
                                            <td colspan="2" style="text-align: right;">
                                                <div class="input-group mb-2" style="width: 40%;float: right;">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <?php
                                                    $adjustment_value = 0;
                                                    if ($estimate->adjustment_value > 0) {
                                                        $adjustment_value = $estimate->adjustment_value;
                                                    }
                                                    ?>
                                                    <input type="number" step="any" name="adjustment_value" id="adjustment_input" value="<?php echo number_format($adjustment_value, 2 ,".", ""); ?>" class="form-control adjustment_input" style="width:50%;display:inline;text-align: right;padding:0px;">
                                                </div>
                                                <span id="adjustmentText" style="display: none;"><?php echo $estimate->adjustment_value; ?></span>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Markup $<span id="span_markup"></td> -->
                                        <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                        <!-- <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0"> -->
                                        <!-- </tr> -->
                                        <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                            <td>Amount Saved</td>
                                            <td></td>
                                            <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Markup
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalSetMarkup" style="color:#02A32C;">set markup</a>
                                            </td>
                                            <td style="text-align:right;">
                                                $<span id="span_markup"><?php echo $estimate->markup_amount; ?></span>
                                                <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="<?php echo $estimate->markup_amount; ?>">                                                
                                                <!-- <span id="span_markup_input_form">0.00</span> -->
                                            </td>

                                            <!-- <td>Markup $<span id="span_markup">0.00</span></td>
                                            <td><a href="#" data-bs-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td>
                                            <td><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="<?php echo $estimate->markup_amount; ?>"><span id="span_markup_input_form"><?php echo $estimate->markup_amount; ?></span></td> -->
                                        </tr>
                                        <tr style="color:blue;font-weight:bold;font-size:16px;">
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td><b>$ <span id="grand_total"><?php echo $estimate->grand_total; ?></span>
                                                    <input type="hidden" name="grand_total" id="grand_total_input" value="<?php echo $estimate->grand_total; ?>"></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-12">
                                    <label class="bold">Request a Deposit</label>
                                    <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                </div>
                                <div class="col-md-2 form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon bold">$</div> -->
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">%</div>
                                        </div>                                        
                                        <input type="number" step="any" name="deposit_amount" id="deposit-percentage" value="<?= $estimate->deposit_amount; ?>" class="form-control" placeholder="Percentage of total amount" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2 form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <?php 
                                            $deposit_amount = $estimate->grand_total * ($estimate->deposit_amount/100);
                                        ?>
                                        <input type="text" id="deposit-total-amount" value="<?= number_format($deposit_amount,2); ?>" readonly="" disabled="" class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 form-group">
                                    <select name="deposit_request" class="form-control">
                                        <option value="1" <?= $estimate->deposit_request == "1" ? "selected" : ""; ?>>Deposit amount $</option>
                                        <option value="2" <?= $estimate->deposit_request == "2" ? "selected" : ""; ?>>Percentage %</option>
                                    </select>
                                </div> -->
                                <div class="col-md-3 form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon bold">$</div> -->                                        
                                        <!-- <input type="text" name="deposit_amount" value="<?php echo $estimate->deposit_amount; ?>" class="form-control" autocomplete="off"> -->
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 form-group">
                                    0.00
                                </div> -->
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bold">Message to Customer</label> 
                                        <span class="help help-sm help-block">Add a message that will be displayed on the estimate.</span>
                                        <textarea name="customer_message" id="message_est" cols="40" rows="2" class="form-control"><?php echo $estimate->customer_message; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bold">Terms & Conditions</label>
                                        <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the estimate.</span>
                                        <textarea name="terms_conditions" cols="40" rows="2" class="form-control" id="terms_conditions_est"><?php echo $estimate->terms_conditions; ?></textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-4">
                                    <label class="bold">Attachment</label>
                                    <span class="help help-sm help-block">Optionally attach files to this invoice. Allowed type: pdf, doc, dock, png, jpg, gif</span>
                                    <?php if ($estimate->attachments != '') { ?>
                                        <a class="btn btn-sm btn-primary" target="_new" style="margin-top:10px; margin-bottom: 10px;" href="<?= base_url('uploads/estimates/' . $estimate->id . '/' . $estimate->attachments); ?>"><?= $estimate->attachments; ?></a>
                                    <?php } ?>

                                    <input type="file" name="est_contract_upload" id="est_contract_upload" class="form-control" />
                                </div>
                            </div>

                            <div class="row mb-3" style="background-color:white;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bold">Instructions</label>
                                        <span class="help help-sm help-block">Optional internal notes, will not appear to customer</span>
                                        <textarea name="instructions" cols="40" rows="2" class="form-control" id="instructions_est"><?php echo $estimate->instructions; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="nsm-button primary" style="margin: 0; height: 34px;">Update</button>
                                    <a class="nsm-button primary" href="<?php echo url('estimate/view/' . $estimate->id); ?>" class="btn but-red">Preview</a>
                                    <!-- <button type="button" class="btn btn-success but" style="border-radius: 0 !important;">Preview</button> -->
                                    <a href="<?php echo url('estimate') ?>" class="nsm-button">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>

            <!-- Modal Service Address -->
            <div class="modal nsm-modal fade" id="modalServiceAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <div class="modal nsm-modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bx bx-fw bx-x m-0"></i>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3">
                            <table id="items_table_newWorkorder" class="table table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td> Name</td>
                                        <td> Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($packages as $package) { // print_r($item);
                                    ?>
                                        <tr>
                                            <td><?php echo $package->name; ?></td>
                                            <td>
                                                <button id="<?= $package->item_categories_id; ?>" type="button" data-bs-dismiss="modal" class="btn btn-sm btn-default select_package"><span class="fa fa-plus"></span> </button>
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
            <div class="modal nsm-modal fade" id="modalAdditionalContacts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="modal nsm-modal fade" id="modalSetMarkup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input class="form-control" name="markup_input" id="markup_input" type="number" style="width: 260px;">
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
            <div class="modal fade" id="item_list" tabindex="-1"  aria-labelledby="newcustomerLabel" aria-hidden="true">            
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                            <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <input id="ITEM_CUSTOM_SEARCH" style="width: 200px;" class="form-control" type="text" placeholder="Search Item...">
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
                                            <?php foreach ($items as $item) { ?>
                                                <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                                    <td style="width: 0% !important;">
                                                        <button type="button" data-bs-dismiss="modal" class='nsm-button primary small select_item2a' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                                    </td>
                                                    <td><?php echo $item->title; ?></td>
                                                    <td>
                                                        <?php 
                                                            foreach($itemsLocation as $itemLoc){
                                                                if($itemLoc->item_id == $item->id){
                                                                    echo "<div class='data-block'>";
                                                                    echo $itemLoc->name. " = " .$itemLoc->qty;
                                                                    echo "</div>";
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

            <!-- Modal New Customer -->
            <div class="modal nsm-modal fade" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="nsm-button primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal New Customer -->
            <div class="modal fade nsm-modal" id="modalQuickAddCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="frm-estimate-quick-add-customer" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-fw bx-x m-0"></i>
                                </button>
                            </div>
                            <div class="modal-body pt-0 pl-3 pb-3"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal nsm-modal fade" id="modalAddNewSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!-- page wrapper end -->
</div>

<?php echo $file_selection; ?>
<?php include viewPath('v2/includes/footer'); ?>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo $url->assets ?>js/add.js"></script>

<script>
    CKEDITOR.replace('terms_conditions_est');
</script>
<script>
    CKEDITOR.replace('message_est');
</script>
<script>
    CKEDITOR.replace('instructions_est');
</script>

<script>
    //   $(function() {
    //     $("#rebatable_toggle").each(function(){
    //     $(this).change(function() {
    //     //   $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    //     alert('yeah');
    //     })
    //   })
    $(document).ready(function() {
        $('#help-popover-adjustment').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
            } 
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

        var ITEMS_TABLE = $('#items_table').DataTable({
            "ordering": false,
        });

        $("#ITEM_CUSTOM_SEARCH").keyup(function() {
            ITEMS_TABLE.search($(this).val()).draw()
        });

        $('#deposit-percentage').keypress(function(){
            computeDepositAmount();
        });

        $('#deposit-percentage').keyup(function(){
            computeDepositAmount();
        });

        function computeDepositAmount(){
            var deposit_amount = $('#deposit-percentage').val() / 100;
            var total_amount   = $('#grand_total_input').val();

            if( total_amount > 0 ){
                total_amount = total_amount * deposit_amount;
                $('#deposit-total-amount').val(total_amount.toFixed(2));    
            }else{
                $('#deposit-total-amount').val('0.00');   
            }
        }

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

        $(".select_item2a").click(function () {
        // taxRate();
            var idd = this.id;
            var title = $(this).data('itemname');
            var price = parseInt($(this).attr('data-price'));
            // var qty = parseInt($(this).attr('data-quantity'));
            var location_name = $(this).data('location_name');
            var location_id = $(this).data('location_id');
            var item_type = $(this).data('item_type');
            // var total_ = price * qty;
            // var total_ = 0;
            // var total_price = price + total_;
            // var total = parseFloat(total_price).toFixed(2);
            // var withCommas = Number(total).toLocaleString('en');
            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 1;
            }else{
              // alert('0');
              var qty = $(this).data('data-quantity');
            }
            var return_first = function () {
                var tax_rate = null;
                $.ajax({
                    'async': false,
                    type : 'POST',
                    url: "<?php echo base_url(); ?>/workorder/getTaxRate",
                    success: function(result){
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
            for (var i=0;i<json.length;++i)
            {
                tax_rate_ = json[i].rate;
            }
            // alert(tax_rate_);
            var taxRate = tax_rate_;

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var tax_ =(parseFloat(total_).toFixed(2) * taxRate) / 100;
            var taxes_t = parseFloat(tax_).toFixed(2);
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            $("#ITEMLIST_PRODUCT_"+idd).hide();
            if( item_type == 'Product' ){
                var item_type_dropdown = '<select name="item_type[]" class="form-control"><option selected="selected" value="product">Product</option><option value="service">Service</option><option value="fee">Fee</option></select>';
            }else if( item_type == 'Fees' ){
                var item_type_dropdown = '<select name="item_type[]" class="form-control"><option value="product">Product</option><option value="service">Service</option><option selected="selected" value="fee">Fee</option></select>';
            }else if( item_type == 'Service' ){
                var item_type_dropdown = '<select name="item_type[]" class="form-control"><option value="product">Product</option><option  selected="selected" value="service">Service</option><option value="fee">Fee</option></select>';
            }else{
                var item_type_dropdown = '<select name="item_type[]" class="form-control"><option selected="selected" value="product">Product</option><option  value="service">Service</option><option value="fee">Fee</option></select>';
            }
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
                "<td width=\"20%\"><div class=\"dropdown-wrapper\">"+item_type_dropdown+"</div></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+count+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
                "<td>\n" +
                "<a href=\"javascript:void(0);\" class=\"remove nsm-button danger\" id='"+count+"'><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
                "</td>\n" +
                "</tr>";
            tableBody = $("#jobs_items_table_body");
            tableBody.append(markup);
            calculation(count);
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

        $('#modalQuickAddCustomer').modal({backdrop: 'static', keyboard: false});

        $('.btn-quick-add-customer').on('click', function(){
            $('#modalQuickAddCustomer').modal('show');            
            $.ajax({
                url: base_url + 'invoice/new_customer_form',
                type: "GET",
                success: function (response) {
                    $('#modalQuickAddCustomer .modal-body').html(response);
                },
                beforeSend: function(data) {
                    $('#modalQuickAddCustomer .modal-body').html('<span class="bx bx-loader bx-spin"></span>')
                },
            });
        });

        $('#sel-customer').select2();
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it

            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
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
</script>

<script>
    $(document).ready(function() {

        $('#sel-customer').change(function() {
            var id = $(this).val();
            //alert(id);

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>/accounting/addLocationajax",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // alert('success');
                    // console.log(response['customer']);
                    $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);

                    if (response.customer.email) {
                        $("#estimate-customer-email").val(response.customer.email);
                    }

                    if (response.customer.phone_m) {
                        $("#estimate-customer-mobile").val(response.customer.phone_m);
                    }
                },
                error: function(response) {
                    alert('Error' + response);

                }
            });
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

    $(function() {
        $("#datepicker_dateissued").datepicker({
            format: 'M dd, yyyy'
        });
    });
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
                $.each(response['items'], function(i, v) {
                    inputs += v.title;
                    var total_pu = v.price * v.units;
                    var total_tax = (v.price * v.units) * 7.5 / 100;
                    var total_temp = total_pu + total_tax;
                    var total = total_temp.toFixed(2);


                    markup = "<tr id=\"ss\">" +
                        "<td width=\"35%\"><input value='" + v.title + "' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='" + v.id + "' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">" + v.title + "</span></div></td>\n" +
                        "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        "<td width=\"10%\"><input data-itemid='" + v.id + "' id='quantity_" + v.id + "' value='" + v.units + "' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
                        "<td width=\"10%\"><input id='price_" + v.id + "' value='" + v.price + "'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_" + v.id + "' value='" + total_pu + "'><div class=\"show_mobile_view\"><span class=\"price\">" + v.price + "</span><input type=\"hidden\" class=\"form-control price\" name=\"price[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='" + v.price + "'></div></td>\n" +
                        //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                        // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                        "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_" + v.id + "' value=\"0\"></td>\n" +
                        // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                        "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='" + v.id + "' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_" + v.id + "' min=\"0\" value='" + total_tax + "'></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='" + total + "' id='span_total_" + v.id + "' class=\"total_per_item\">" + total +
                        // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text" + v.id + "' value='" + total + "'></td>" +
                        "<td>\n" +
                        '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
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

                });
                // $("#input_container").html(inputs);

                tableBody2 = $("#device_audit_datas");
                tableBody2.append(markup2);
                // alert(inputs);

                var in_id = idd;
                var price = $("#price_" + in_id).val();
                var quantity = $("#quantity_" + in_id).val();
                var discount = $("#discount_" + in_id).val();
                var tax = (parseFloat(price) * 7.5) / 100;
                var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
                    2
                );
                if (discount == '') {
                    discount = 0;
                }

                var total = (
                    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
                    parseFloat(discount)
                ).toFixed(2);

                var total_wo_tax = price * quantity;

                // alert( 'yeah' + total);


                $("#priceqty_" + in_id).val(total_wo_tax);
                $("#span_total_" + in_id).text(total);
                $("#sub_total_text" + in_id).val(total);
                $("#tax_1_" + in_id).text(tax1);
                $("#tax1_" + in_id).val(tax1);
                $("#discount_" + in_id).val(discount);

                if ($('#tax_1_' + in_id).length) {
                    $('#tax_1_' + in_id).val(tax1);
                }

                if ($('#item_total_' + in_id).length) {
                    $('#item_total_' + in_id).val(total);
                }

                var eqpt_cost = 0;
                var total_costs = 0;
                var cnt = $("#count").val();
                var total_discount = 0;
                var pquantity = 0;
                for (var p = 0; p <= cnt; p++) {
                    var prc = $("#price_" + p).val();
                    var quantity = $("#quantity_" + p).val();
                    var discount = $("#discount_" + p).val();
                    var pqty = $("#priceqty_" + p).val();
                    // var discount= $('#discount_' + p).val();
                    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
                    pquantity += parseFloat(pqty);
                    total_costs += parseFloat(prc);
                    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
                    total_discount += parseFloat(discount);
                }
                //   var subtotal = 0;
                // $( total ).each( function(){
                //   subtotal += parseFloat( $( this ).val() ) || 0;
                // });

                var total_cost = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="price_"]').each(function() {
                    total_cost += parseFloat($(this).val());
                });

                // var totalcosting = 0;
                // $('*[id^="span_total_"]').each(function(){
                //   totalcosting += parseFloat($(this).val());
                // });


                // alert(total_cost);

                var tax_tot = 0;
                $('*[id^="tax1_"]').each(function() {
                    tax_tot += parseFloat($(this).val());
                });

                over_tax = parseFloat(tax_tot).toFixed(2);
                // alert(over_tax);

                $("#sales_taxs").val(over_tax);
                $("#total_tax_input").val(over_tax);
                $("#total_tax_").text(over_tax);


                eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
                total_discount = parseFloat(total_discount).toFixed(2);
                stotal_cost = parseFloat(total_cost).toFixed(2);
                priceqty = parseFloat(pquantity).toFixed(2);
                // var test = 5;

                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function() {
                    subtotal += parseFloat($(this).text());
                });
                // $('#sum').text(subtotal);

                var subtotaltax = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="tax_1_"]').each(function() {
                    subtotaltax += parseFloat($(this).text());
                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function() {
                    priceqty2 += parseFloat($(this).val());
                });

                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
                // $("#span_sub_total_invoice").text(priceqty);

                $("#eqpt_cost").val(eqpt_cost);
                $("#total_discount").val(total_discount);
                $("#span_sub_total_0").text(total_discount);
                // $("#span_sub_total_invoice").text(stotal_cost);
                // $("#item_total").val(subtotal.toFixed(2));
                $("#item_total").val(priceqty2.toFixed(2));

                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);

                // $("#total_tax_").text(subtotaltax.toFixed(2));
                // $("#total_tax_").val(subtotaltax.toFixed(2));




                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));

                var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
                sls = parseFloat(sls).toFixed(2);
                $("#sales_tax").val(sls);
                cal_total_due();


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
