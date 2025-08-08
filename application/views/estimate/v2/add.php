<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>
<style>
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
.add-item-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.select2-container--default .select2-results__option .select2-results__option {
    padding-left:0px !important;
}
.select2-results__group{
    margin-left: 0px !important;
}
#items_table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
#items_table td:nth-child(5){
text-align:right !important;
}
.show_mobile_view {
    display: none;
}
.row-total-amount{
    text-align:right;
}
.row-btn-actions{
    text-align:center;
    padding:13px !important;
}
.span-input{
    display: block;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #E9ECEF;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">        
        <li onclick="location.href='<?php echo base_url('estimate') ?>'">
            <div class="nsm-fab-icon">
                <i class='bx bx-fw bx-chart' ></i>
            </div>
            <span class="nsm-fab-label">Estimate List</span>
        </li> 
    </ul>
</div>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate__tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="row">
                <div class="col-12">
                    <div class="nsm-callout primary">
                        <button><i class='bx bx-x'></i></button>
                        Our standard estimate form is carefully design with quantity takeoff of each items. With a clear
                        break down of the items to be included in each project, this will insure a higher acceptance rate.
                        Try our options form layout if you wish to give your customers a choice of multiple projects.
                    </div>
                </div>
            </div>        
            <div class="nsm-page-content">
            <!-- end row -->
            <?php echo form_open_multipart('estimate/savenewestimate', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-between">
                                                <label for="job_name"><b>Customer</b></label>
                                                <div class="d-flex">
                                                    <a class="nsm-button btn-small d-flex" data-bs-toggle="modal"
                                                        data-bs-target="#quick-add-customer" href="javascript:void(0);">
                                                        Add New Customer
                                                    </a>
                                                    <a class="nsm-button btn-small d-flex d-flex"
                                                        style="margin-left:5px;" data-bs-toggle="modal"
                                                        data-bs-target="#quick-add-lead" href="javascript:void(0);">
                                                        Add New Lead
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
                                            <input id="estimate-customer-email" name="customer_email" type="text" class="form-control" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="job_name"><b>Customer Mobile</b></label>
                                            <input id="estimate-customer-mobile" name="customer_mobile" type="text" maxlength="12" placeholder="xxx-xxx-xxxx" class="form-control phone_number" />
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="job_location"><b>Job Location</b></label><a class="nsm-button btn-small btn-use-different-address" id="btn-use-different-address" data-id="0" href="javascript:void(0);" style="float: right; display:none;">Use Other Address</a>
                                            <input type="text" class="form-control" name="job_location" id="job_location" />
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
                                        id="estimate_date_" value="<?= date("Y-m-d"); ?>" placeholder="Enter Estimate Date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-3">
                                    <label for="expiry_date" class="required"><b>Expiry Date</b></label>
                                    <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                    <?php 
                                        $default_expiry_date = date("Y-m-d", strtotime('+14 days'));
                                    ?>
                                    <input required type="date" class="form-control" name="expiry_date"
                                        id="expiry_date_" value="<?= $default_expiry_date; ?>" placeholder="Enter Expiry Date">
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
                                    <label for="estimate_date"><b>Estimate Type</b> <span style="color:red;">*</span></label>
                                    <select name="estimate_type" class="form-select">
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
                                    <select required name="status" class="form-select" id="estimate-status">
                                        <option value="Draft">Draft</option>
                                        <option value="Submitted">Submitted</option>
                                        <option value="Accepted">Accepted</option>
                                        <option value="Declined By Customer">Declined By Customer</option>
                                        <option value="Lost">Lost</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 mt-5" style="background-color:white;font-size:16px;">
                                <input type="hidden" id="data_item_selected_id">

                                <div class="col-md-3">
                                    <b>Items Summary</b>
                                </div>
                            </div>

                            <div class="row mb-3" id="plansItemDiv" style="background-color:white;">
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
                                                <th class="hidden_mobile_view" style="width:8%;text-align:right;">Total</th>
                                                <th class="hidden_mobile_view" style="width:5%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body">
                                        </tbody>
                                    </table>
                                    <div class="add-item-container">
                                        <button class="nsm-button primary small link-modal-open" type="button" id="add_another_items">
                                            <i class='bx bx-plus'></i>Add Items
                                        </button>                                        
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="bold">Request a deposit <i id="help-popover-request-deposit" class='bx bx-fw bx-help-circle'></i></label>                                            
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-text">$</div>
                                                <input type="number" step="any" name="deposit_amount" id="deposit-amount" value="0" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="bold">Attachment</label>
                                            <i id="help-popover-attachment" class='bx bx-fw bx-help-circle'></i></label>                                       
                                            <input type="file" name="est_contract_upload" id="est_contract_upload"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
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
                            <hr />
                            <div class="row mb-3 mt-5">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bold">Message to customer</label>
                                        <i id="help-popover-message-customer" class='bx bx-fw bx-help-circle'></i></label>   
                                        <textarea name="customer_message" id="message_est" cols="40" rows="2"
                                            class="form-control">
                                            <?php echo $default_customer_message; ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bold">Terms & Conditions</label>
                                        <i id="help-popover-terms-conditions" class='bx bx-fw bx-help-circle'></i></label>                                           
                                        <textarea name="terms_conditions" cols="40" rows="2" class="form-control"
                                            id="terms_conditions_est">
                                            <?php echo $default_terms_condition; ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bold">Instructions</label>
                                        <i id="help-popover-instructions" class='bx bx-fw bx-help-circle'></i></label>              
                                        <textarea name="instructions" cols="40" rows="2" class="form-control"
                                            id="instructions_est"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group text-end">
                                    <a href="<?php echo url('estimate'); ?>" class="nsm-button" style="color: black;">Cancel</a>
                                    <button type="submit" class="nsm-button primary" style="margin: 0; height: 34px;" id="estimate-save-btn">Save</button>
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
            <div class="modal fade" id="item_list" tabindex="-1"  aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                            <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                        </div>
                        <div class="modal-body">
                                <div class="row">                        
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-12 col-md-12 grid-mb">
                                                <div class="nsm-field-group search">
                                                    <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" for="items_table" placeholder="Search List">
                                                </div>
                                            </div>
                                        </div>
                                        <table id="items_table" class="nsm-table w-100">
                                            <thead class="bg-light">
                                                <tr>
                                                    <td data-name="Action" style="width: 0% !important;"></td>
                                                    <td data-name="Name"><strong>Name</strong></td>
                                                    <td data-name="Type"><strong>Type</strong></td>
                                                    <td data-name="Stock"><strong>Stock</strong></td>
                                                    <td data-name="Price"><strong>Price</strong></td>                                        
                                                    <td data-name="Location" class='d-none'><strong>Location</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if (!empty($items)) {
                                                        foreach ($items as $item) {
                                                        $item_qty = get_total_item_qty($item->id);
                                                ?>
                                                <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                                    <td style="width: 0% !important;">
                                                        <button type="button" data-bs-dismiss="modal" class='nsm-button default select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-retail="<?= $item->retail; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                                    </td>
                                                    <td class="show nsm-text-primary"><?php echo $item->title; ?></td>
                                                    <td class="nsm-text-primary"><?php echo $item->type; ?></td>
                                                    <td>
                                                        <?php 
                                                        $total_stock = 0;
                                                        foreach($itemsLocation as $itemLoc){
                                                            if($itemLoc->item_id == $item->id){
                                                                $total_stock += $itemLoc->qty;
                                                                //echo "<div class='data-block'>";
                                                                //echo $itemLoc->name. " = " .$itemLoc->qty;
                                                                //echo "</div>";
                                                            } 
                                                        }
                                                        echo $total_stock;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if( $item->price > 0 ){
                                                                echo $item->price;
                                                            }else{
                                                                echo '0.00';
                                                            }                                                
                                                        ?>                                                
                                                    </td>                                        
                                                    <td class='d-none'><?php echo $item->location_name; ?></td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            
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

<?php include viewPath('v2/includes/customer/other_address'); ?>
<?php echo $file_selection; ?>
<?php include viewPath('v2/includes/customer/quick_add_customer'); ?>
<?php include viewPath('v2/includes/leads/quick_add'); ?>
<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets; ?>js/add.js"></script>
<script>
$(document).ready(function() {
    var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : ''; ?>"; 

    CKEDITOR.replace('instructions_est');
    CKEDITOR.replace('message_est');
    CKEDITOR.replace('terms_conditions_est');
    
    $("#items_table").nsmPagination({itemsPerPage:10});
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));
    
    $('#sel-customer').select2();    

    $('.phone_number').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $('#add_another_items').on('click', function(){
        $('#item_list').modal('show');
    });

    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }

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

    $(document).on('click', '.btn-use-other-address', function(){
        let prof_id = $(this).attr('data-id');
        let other_address = $(this).attr('data-address');
        let link_customer_address = `<a class="btn-use-different-address nsm-link" data-id="${prof_id}" href="javascript:void(0);">${other_address}</a>`;

        $('#other-address-customer').modal('hide');
        $('#job_location').val(other_address);
    });    

    $('#help-popover-adjustment').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        }
    });

    $('#help-popover-request-deposit').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'You can request an upfront payment on accept estimate.';
        }
    });

    $('#help-popover-message-customer').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Add a message that will be displayed on the estimate.';
        }
    });

    $('#help-popover-terms-conditions').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return `Mention your company's T&amp;C that will appear on the estimate.`;
        }
    });

    $('#help-popover-attachment').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return `Optionally attach files to this invoice.`;
        }
    });

    $('#help-popover-instructions').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return `Optional internal notes, will not appear to customer.`;
        }
    });

    $('#customer_id').change(function() {
        var customer_leads     = $(this).val();
        var customerLeads      = customer_leads.split("/");
        var customer_lead_type = customerLeads[1];
        var customer_lead_id   = customerLeads[0];

        if (customer_lead_type == 'Customer') {
            load_customer_data(customer_lead_id);
        } else {
            load_lead_data(customer_lead_id)
        }

        $("#btn-use-different-address").show();
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

                    if(response.prof_id) {
                        $(".btn-use-different-address").attr("data-id",response.prof_id);
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

    $('#grand_total_input').change(function() {
        //computeDepositAmount();
        no_tax();
    });

    $('#no-tax').on('change', function(){
        //computeDepositAmount();
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