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
                        Our standard estimate form is carefully design with quantity takeoff of each items. With a clear break down of the items to be included in each project, this will insure a higher acceptance rate. Try our options form layout if you wish to give your customers a choice of multiple projects.
                    </div>
                </div>
            </div>
            <div class="nsm-page-content">
            <?php echo form_open_multipart('estimate/update/' . $estimate->id, ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <input type="hidden" name="est_id" value="<?php echo $estimate->id; ?>">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="customers" class="required"><b>Customer</b></label>
                                            <div class="d-flex" style="float: right;">
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
                                            <div id="sel-customerdiv">
                                                <select name="customer_id" id="sel-customer" class="form-control" required>
                                                    <option value="">- Select Customer -</option>
                                                    <?php if ($default_customer_id > 0) { ?>
                                                    <option value="<?php echo $default_customer_id; ?>" selected>
                                                        <?php echo $default_customer_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
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

                                    <div class="row mb-3 mt-3">
                                        <div class="col-md-6">
                                            <label for="job_name"><b>Customer Email</b></label>
                                            <input id="estimate-customer-email" type="text" class="form-control" name="customer_email" value="<?= !is_null($selectedCustomer) ? $estimate->customer->email : ''; ?>" />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="job_name"><b>Customer Mobile</b></label>
                                            <input id="estimate-customer-mobile" type="text" class="form-control phone_number" name="customer_mobile" maxlength="12" placeholder="xxx-xxx-xxxx" value="<?= !is_null($selectedCustomer) ? $estimate->customer->phone_m : ''; ?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="job_location"><b>Job Location</b> </label><a class="nsm-button btn-small btn-use-different-address" id="btn-use-different-address" data-id="0" href="javascript:void(0);" style="float: right;">Use Other Address</a>
                                            <!-- <input
                                                id="autocomplete"
                                                placeholder="Enter Location"
                                                type="text"
                                                class="form-control"
                                                autocomplete="on" runat="server"
                                            /> -->
                                            <!-- <input type="text" class="form-control" name="job_location" id="job_location" /> -->
                                            <?php 
                                                $job_location = "";
                                                if($estimate->job_location != null && $estimate->job_location != '') {
                                                    $job_location = $estimate->job_location;
                                                } else {
                                                    $job_location = $cust->mail_add . ' ' . $cust->city . ', ' . $cust->state . ' ' . $cust->zip_code;
                                                }
                                            ?>
                                            <input type="text" class="form-control" name="job_location" id="job_location" value="<?php echo $job_location; ?>" />

                                            <!-- <input type="hidden" id="city2" name="city2" />
                                            <input type="hidden" id="cityLat" name="cityLat" />
                                            <input type="hidden" id="cityLng" name="cityLng" /> -->
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <br><br><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus" aria-hidden="true"></i> New Location Address</a> 
                                        </div> -->
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="job_name"><b>Job Name</b> (optional)</label>
                                            <input type="text" class="form-control" name="job_name" id="job_name" placeholder="Enter Job Name" value="<?php echo $estimate->job_name; ?>" />
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
                            <div class="row mb-3">
                            <div class="row mb-3">                                
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate#</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_number" id="estimate_date"
                                           required placeholder="Enter Estimate#"  value="<?php echo "EST-" . date("YmdHis"); ?>" /> -->
                                    <input type="text" class="form-control" name="estimate_number" id="estimate_date" value="<?php echo $estimate->estimate_number; ?>" readonly />
                                </div>
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

                            <div class="row mb-3">
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

                            <div class="row mb-3" style="font-size:16px;">
                                <div class="col-md-3">
                                    <b>Items Summary</b>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class=" table-responsive2">
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
                                                <th class="hidden_mobile_view" style="width:8%;text-align:right;">Total</th>
                                                <th class="hidden_mobile_view" style="width:5%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body">
                                           
                                            <?php $count = 0;
                                            foreach ($itemsDetails as $data) { ?>
                                                <tr>
                                                    <td width="30%">
                                                        <div>
                                                            <input type="text" class="form-control getItems" onKeyup="getItems(this)" name="items[]" value="<?php echo $data->title; ?>">
                                                            <ul class="suggestions"></ul>
                                                            <input type="hidden" name="itemid[]" id="itemid" class="itemid" value="<?php echo $data->items_id; ?>">
                                                        </div>
                                                      
                                                    </td>
                                                    <td width="20%">
                                                        <div>
                                                            <select name="item_type[]" class="form-control">
                                                                <option value="product">Product</option>
                                                                <option value="material">Material</option>
                                                                <option value="service">Service</option>
                                                                <option value="fee">Fee</option>
                                                            </select>
                                                        </div>
                                                     
                                                    </td>
                                                    <td width="10%">
                                                        <input type="number" class="form-control quantity " name="quantity[]" data-counter="<?php echo $count; ?>" data-itemid="<?php echo $data->id; ?>" id="quantity_<?= $count; ?>" value="<?php echo $data->qty; ?>">
                                                    </td>
                                                    <td width="10%">
                                                        <input type="text" class="form-control price text-end" name="price[]" data-counter="<?php echo $count; ?>" data-itemid="<?php echo $data->id; ?>" id="price_<?php echo $count; ?>" min="0" value="<?php echo $data->costing; ?>">
                                                        <input type="hidden" class="priceqty" id="priceqty_<?php echo $data->id; ?>" value="<?php echo $aaa = $data->costing * $data->qty; ?>">
                                                    </td>
                                                    <td  width="10%">
                                                        <input type="number" class="form-control discount" name="discount[]" data-counter="<?php echo $count; ?>" id="discount_<?php echo $count; ?>" min="0" value="<?php echo $data->discount; ?>" />
                                                    </td>
                                                    <td  width="10%" class="row-total-amount"><input type="text" class="form-control tax_change text-end" name="tax[]" data-counter="<?php echo $count; ?>" id="tax1_<?php echo $count; ?>" min="0" value="<?php echo number_format($data->tax,2,".",""); ?>" readonly>
                                                        <!-- <span id="span_tax_0">0.0</span> -->
                                                    </td>
                                                    <td class="row-total-amount">
                                                        <?php
                                                        $total_item_price = $data->costing * $data->qty;
                                                        $tax = $data->tax > 0 ? $data->tax : 0;
                                                        $discount = $data->discount > 0 ? $data->discount : 0;
                                                        $total_row_price = ($total_item_price + $tax) - $data->discount;
                                                        $total_row_price = number_format($total_row_price,2,".","");
                                                        ?>
                                                        <input type="hidden" class="form-control " name="total[]" data-counter="<?php echo $count; ?>" id="item_total_<?php echo $count; ?>" min="0" value="<?php echo $total_row_price; ?>">
                                                        <span class="span-input" id="span_total_<?php echo $count; ?>"><?php echo $total_row_price; ?></span>
                                                    </td>
                                                    <td class='row-btn-actions'><a href="javascript:void(0);" class="remove nsm-button danger"><i class="bx bx-fw bx-trash" aria-hidden="true"></i></a></td>
                                                </tr>
                                            <?php $count++;
                                            } ?>
                                        <input type="hidden" name="count" value="<?= $count ?>" id="count">

                                        </tbody>
                                    </table>
                                    <a class="link-modal-open nsm-button primary" href="#" id="add_another_items" data-bs-toggle="modal" data-bs-target="#item_list"><i class='bx bx-plus-medical'></i> Add Items</a> &emsp;                                    
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
                                            <td colspan="2" align="right">$<span id="span_sub_total_invoice"><?php echo $estimate->sub_total; ?></span>
                                                <input type="hidden" name="subtotal" id="item_total" value="<?php echo $estimate->sub_total; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <!-- <td></td> -->
                                            <td colspan="2" align="right">$<span id="total_tax_"><?php echo $estimate->tax1_total; ?></span><input type="hidden" name="taxes" id="total_tax_input" value="<?php echo $estimate->tax1_total; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="no_tax" type="checkbox" value="1" id="no-tax" <?= $estimate->no_tax == 1 ? 'checked="checked"' : ''; ?>>
                                                    <label class="form-check-label" for="noTax" style="font-size:15px;">
                                                        No Tax
                                                    </label>
                                                </div>
                                            </td>
                                            <td colspan="2"></td>
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
                                                    <input type="number" step="any" name="adjustment_value" id="adjustment_input" value="<?php echo number_format($adjustment_value, 2,".",""); ?>" class="form-control adjustment_input" style="width:50%;display:inline;text-align: right;padding:0px;">                                                    
                                                </div>                                                
                                                <span id="adjustmentText" style="display: none;"><?php echo $estimate->adjustment_value; ?></span>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Markup $<span id="span_markup"></td> -->
                                        <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                        <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
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
                                        <?php
                                            if( $estimate->no_tax == 1 ){
                                                $estimate_grand_total = $estimate->grand_total - $estimate->tax1_total;
                                            }else{
                                                $estimate_grand_total = $estimate->grand_total;
                                            }
                                        ?>
                                        <tr style="color:blue;font-weight:bold;font-size:16px;">
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td style="text-align: right;"><b>$<span id="grand_total"><?php echo $estimate_grand_total; ?></span>
                                            <input type="hidden" name="grand_total" id="grand_total_input" value="<?php echo $estimate->grand_total; ?>"></b></td>
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
                                        <textarea name="customer_message" id="message_est" cols="40" rows="2" class="form-control"><?php echo $estimate->customer_message; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bold">Terms & Conditions</label>
                                        <i id="help-popover-terms-conditions" class='bx bx-fw bx-help-circle'></i></label>
                                        <textarea name="terms_conditions" cols="40" rows="2" class="form-control" id="terms_conditions_est"><?php echo $estimate->terms_conditions; ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bold">Instructions</label>
                                        <i id="help-popover-instructions" class='bx bx-fw bx-help-circle'></i></label>         
                                        <textarea name="instructions" cols="40" rows="2" class="form-control" id="instructions_est"><?php echo $estimate->instructions; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <a href="<?php echo url('estimate') ?>" class="nsm-button">Cancel</a>
                                    <button type="submit" class="nsm-button primary" style="margin: 0; height: 34px;">Save</button>
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
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<?php include viewPath('v2/includes/customer/other_address'); ?>
<?php include viewPath('v2/includes/customer/quick_add_customer'); ?>
<?php include viewPath('v2/includes/leads/quick_add'); ?>

<?php echo $file_selection; ?>
<?php include viewPath('v2/includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/add.js"></script>
<script>
          

    $(document).ready(function() {
        $('#deposit-percentage').keypress(function(){
            computeDepositAmount();
        });

        $('#deposit-percentage').keyup(function(){
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

        $(document).on('click', '.select_item2a', function(){
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
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view-a\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+count+"'><div class=\"show_mobile_view-a\"><span class=\"price\">"+price+"</span></div></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\" class=\"hidden_mobile_view-a\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\" class=\"hidden_mobile_view-a\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"hidden_mobile_view-a\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
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

        <?php if ($estimate->customer_id > 0) { ?>
            load_customer_data("<?php echo $estimate->customer_id; ?>");
        <?php } ?> 
    });
</script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('terms_conditions_est');
        CKEDITOR.replace('message_est');
        CKEDITOR.replace('instructions_est');
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        $("#items_table").nsmPagination({itemsPerPage:10});
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on('click', '.btn-use-other-address', function(){
            let prof_id = $(this).attr('data-id');
            let other_address = $(this).attr('data-address');
            let link_customer_address = `<a class="btn-use-different-address nsm-link" data-id="${prof_id}" href="javascript:void(0);">${other_address}</a>`;

            $('#other-address-customer').modal('hide');
            $('#job_location').val(other_address);

            var map_source = 'http://maps.google.com/maps?q=' + other_address +
                '&output=embed';
            var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +
                '" height="370" width="100%" style=""></iframe>';
            $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');               
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

        $('#sel-customer').select2({
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

        function validatecard() {
            var inputtxt = $('.card-number').val();

            if (inputtxt == 4242424242424242) {
                $('.require-validation').submit();
            } else {
                alert("Not a valid card number!");
                return false;
            }
        }

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

        $('#sel-customer').change(function() {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>/accounting/addLocationajax",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
                    
                    if (response.customer.email) {
                        $("#estimate-customer-email").val(response.customer.email);
                    }

                    if(response.customer.prof_id) {
                        $(".btn-use-different-address").attr("data-id",response.customer.prof_id);
                        load_customer_data(response.customer.prof_id); 
                    }

                    if (response.customer.phone_m) {
                        $("#estimate-customer-mobile").val(response.customer.phone_m);
                    }else{
                        $("#estimate-customer-mobile").val('');
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
    });
</script>