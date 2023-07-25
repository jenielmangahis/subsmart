<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/invoice/autosave.js")?>"></script> -->

<?php include viewPath('v2/includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php //include viewPath('includes/sidebars/invoice'); ?>
    <link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<?php include viewPath('v2/pages/job/css/job_new'); ?>
    <style>
  .custom-signaturepad {
    padding-left: 0;
    padding-right: 0;
  }
  .custom-signaturepad .sigWrapper canvas {
      width: 100%;
  }
  .custom-signaturepad .sigPad  {
    width: 100% !important;
  }
  #group_area{
    background-color:#F9F9F9;
  }
  #group_area:hover{
    background-color:#EBFFE2;
  }
  .pointer {cursor: pointer;}
/* 
  #company_representative_approval_signature1a{
  border: solid 1px blue;  
  width: 100%;
} */

#signature-pad {min-height:200px;}
#signature-pad canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2 {min-height:200px;}
#signature-pad2 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3 {min-height:200px;}
#signature-pad3 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

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

input:checked + .slider {
  background-color: #10ab06;
}

input:focus + .slider {
  box-shadow: 0 0 1px #10ab06;
}

input:checked + .slider:before {
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

.signature_mobile
{
    display: none;
}

.show_mobile_view
{
    display: none;
}

@media only screen and (max-device-width: 600px) {
    .label-element{
        position:absolute;
        top:-8px;
        left:25px;
        font-size:12px;
        color:#666;
        }
    .input-element{
        padding:30px 5px 10px 8px;
        width:100%;
        height:55px;
        /* border:1px solid #CCC; */
        font-weight: bold;
        margin-top: -15px;
    }

        .mobile_qty
    {
        background: transparent !important;
        border: none !important;
        outline: none !important;
        padding: 0px 0px 0px 0px !important;
        text-align: center;
    }

    .select-wrap 
    {
    border: 2px solid #e0e0e0;
    /* border-radius: 4px; */
    margin-top: -10px;
    /* margin-bottom: 10px; */
    padding: 0 5px 5px;
    width:100%;
    /* background-color:#ebebeb; */
    }

    .select-wrap label
    {
    font-size:10px;
    text-transform: uppercase;
    color: #777;
    padding: 2px 8px 0;
    }

    .m_select
    {
    /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }
    .select2 .select2-container .select2-container--default{
        /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }

    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #fff !important;
    border-radius: 4px;
    }

    .sub_label{
        font-size:12px !important;
    }

    .signature_web
    {
        display: none;
    }

    .signature_mobile
    {
        display: block;
    }

    .hidden_mobile_view{
        display: none;
    }

    .show_mobile_view
    {
        display: block;
    }

    .table_mobile
    {
        font-size:14px;
    }

    div.dropdown-wrapper select { 
    width:115% /* This hides the arrow icon */; 
    background-color:transparent /* This hides the background */; 
    background-image:none; 
    -webkit-appearance: none /* Webkit Fix */; 
    border:none; 
    box-shadow:none; 
    padding:0.3em 0.5em; 
    font-size:13px;
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

    .tabs { list-style: none; }
.tabs li { display: inline; }
.tabs li a 
{ 
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
.tabs li a:hover 
{ 
    background: #ccc; 
}
.group:after 
{ 
    visibility: hidden; 
    display: block; 
    font-size: 0; 
    content: " "; 
    clear: both; 
    height: 0; 
}

.box-wrap 
{ 
    position: relative; 
    min-height: 250px; 
}
.tabbed-area div div 
{ 
    background: white; 
    padding: 20px; 
    min-height: 250px; 
    position: absolute; 
    top: -1px; 
    left: 0; 
    width: 100%; 
}

.tabbed-area div div, .tabs li a 
{ 
    border: 1px solid #ccc; 
}

#box-one:target, #box-two:target, #box-three:target {
  z-index: 1;
}

.group li.active a,
.group li a:hover,
.group li.active a:focus,
.group li.active a:hover{
  background-color: #52cc6e;
  color: black; 
}
}
</style>
<div class="row">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>
</div>
    <!-- page wrapper start -->
    <div wrapper__section>
        
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box" style="padding:0 0 0 2%;">
                <div class="row align-items-center">
                  <div class="col-sm-6">
                      <h3 class="page-title mt-0" style="font-size: 1.75rem; font-weight: 600;">Add New Invoice</h3>
                  </div>
                  <div class="col-sm-6">
                      <div class="float-right d-none d-md-block" style="float:right;">
                          <div class="dropdown">
                                  <a href="<?php echo base_url('invoice') ?>" class="btn btn-primary"
                                     aria-expanded="false">
                                      <i class="mdi mdi-settings mr-2"></i> Go Back to Invoices List
                                  </a>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="pl-3 pr-3 mt-2 row">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Complete the fields below to create a new invoice.</span>
                  </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('Invoice/addNewInvoice', ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>

            <div class="row "  style="padding:2%;">
                <div class="col-xl-12">
                    <div class="card2">
                        <div class="card-body">
                            <div class="row" style="background-color:white;">
                                <div class="col-md-5 form-group">
                                    <label for="invoice_customer">Customer</label>
                                    <!-- <select id="invoice_customer" name="customer_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select customer">
                                    </select> -->
                                    <select name="customer_id" id="customer-id" class="form-control searchable-dropdown" required>
                                    <option>Select a customer</option>
                                    <?php foreach ($customers as $customer):?>
                                    <option <?= $default_cust_id == $customer->prof_id ? 'selected="selected"' : ''; ?> value="<?php echo $customer->prof_id?>"><?php echo $customer->first_name."&nbsp;".$customer->last_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                <div class="col-md-5 form-group">
                                    <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewCustomer" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Customer</a>
                                </div>
                                <br>
                                <div class="col-md-5 form-group">
                                <br>
                                    <label for="job_location">Job Location <small class="help help-sm">(optional)</small></label>
                                    
                                    <input type="text" class="form-control" value="" name="jobs_location" id="invoice_jobs_location" />
                                </div>
                                <div class="col-md-5 form-group">
                                    <!-- <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewLocationAddress" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Location Address</a> -->
                                </div>
                                <div class="col-md-5 form-group">
                                <br>
                                    <label for="job_name">Job Name <small class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" value="" name="job_name" id="job_name" />
                                </div>
                                <div class="col-md-5 form-group">
                                <br>
                                    <label for="job_name">Business Name <small class="help help-sm">(optional)</small></label>
                                    <input type="text" name="business_name" id="business_name" class="nsm-field form-control" value="<?php echo $clients->business_name; ?>" />
                                </div>
                            </div>

                            <br>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                        <label>Terms</label>
                                            <select class="form-control" name="terms" id="addNewTermsInvoice">
                                                <option></option>
                                                <option value="0">Add New</option>
                                                <?php foreach($terms as $term) : ?>
                                                <option value="<?php echo $term->id; ?>"><?php echo $term->name . ' ' . $term->net_due_days; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Customer email</label>
                                            <input type="email" value="<?= !empty($w_customer) ? $w_customer->email : ''; ?>" class="form-control" name="customer_email" id="customer_email">
                                            <p><input type="checkbox"> Send later </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Location of sale</label>
                                            <input type="text" class="form-control" name="location_scale">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Tracking no.</label>
                                            <input type="text" class="form-control" name="tracking_number">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>Ship via</label>
                                            <input type="text" class="form-control" name="ship_via">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Shipping date</label>
                                            <input type="date" class="form-control" name="shipping_date">
                                        </div>
                                        <div class="col-md-3">
                                        <label>Tags</label> <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                            <input type="text" class="form-control" name="tags">
                                        </div>
                                    <!-- </div>
                                    <div class="row form-group"> -->
                                        <div class="col-md-3">
                                            <label>Billing address</label>
                                            <textarea class="form-control" style="width:100%;" name="billing_address" id="billing_address"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-3 form-group">
                                    <label for="estimate_date">Invoice Type <span style="color:red;">*</span></label>
                                    <select name="invoice_type" class="form-control">
                                        <option value="Deposit">Deposit</option>
                                        <option value="Partial Payment">Partial Payment</option>
                                        <option value="Final Payment">Final Payment</option>
                                        <option value="Total Due" selected="selected">Total Due</option>
                                    </select>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="work_order">Job# <small class="help help-sm">(optional)</small></label>
                                    <span class="fa fa-question-circle text-ter" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Field is auto-populated on create Invoice from a Work Order." data-original-title="" title=""></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="work_order_number" name="work_order_number">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="purchase_order">Purchase Order# <small class="help help-sm">(optional)</small></label>
                                    <span class="fa fa-question-circle text-ter" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional if you want to display the purchase order number on invoice." data-original-title="" title=""></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="purchase_order" id="purchase_order">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                            <label>Shipping to</label>
                                            <textarea class="form-control" style="width:100%;" name="shipping_to_address" id="shipping_address"></textarea>
                                        </div>

                                <!-- <div class="col-md-3 form-group">
                                </div> -->

                                <div class="col-md-3 form-group">
                                    <label for="invoice_number">Invoice#</label>
                                    <!-- <input type="text" class="form-control" name="invoice_number"
                                           id="invoice_number" value="<?php echo "INV-".date("YmdHis"); ?>" required placeholder="Enter Invoice#"
                                           autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/> -->
                                    <!-- <input type="text" class="form-control" name="invoice_number"
                                           id="invoice_number" value="<?php echo "INV-".date("YmdHis"); ?>" required placeholder="Enter Invoice#"
                                           onChange="jQuery('#customer_id').text(jQuery(this).val());"/> -->
                                    <input type="text" class="form-control" name="invoice_number" id="invoice_number" value="<?php echo "INV-"; 
                                           foreach ($number as $num):
                                                $next = $num->invoice_number;
                                                $arr = explode("-", $next);
                                                $date_start = $arr[0];
                                                $nextNum = $arr[1];
                                            //    echo $number;
                                           endforeach;
                                           $val = $nextNum + 1;
                                           echo str_pad($val,9,"0",STR_PAD_LEFT);
                                           ?>" required />
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="date_issued">Date Issued <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" id="start_date_" name="date_issued" required/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="due_date">Due Date <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" id="end_date_" name="due_date" required/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="status">Status</label><br/>
                                    <!-- <input type="text" name="status" class="form-control"> -->
                                                <select name="status" class="form-control">
                                                    <option value="Draft">Draft</option>
                                                    <option value="Submitted">Submitted</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Declined">Declined</option>
                                                    <option value="Schedule">Schedule</option>
                                                    <option value="Partially Paid">Partially Paid</option>
                                                    <option value="Paid">Paid</option>
                                                    <option value="Due">Due</option>
                                                    <option value="Overdue">Overdue</option>
                                                </select>
                                </div>
                            </div>

                            <div class="row" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-10 pt-2">
                                    <label for="">Manage invoice items</label>
                                </div>
                                <div class="col-md-2 row pr-0">
                                    <label for="" class="pt-2">Show qty as: </label>
                                    <select name="qty_type[]" id="show_qty_type" class="form-control mb-2" style="display:inline-block; width: 135px;">
                                        <option value="Quantity">Quantity</option>
                                        <option value="Hours">Hours</option>
                                        <option value="Square Feet">Square Feet</option>
                                        <option value="Rooms">Rooms</option>
                                    </select>
                                </div>
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead>
                                        <tr style="background-color:#E8E9E8;">
                                            <th><b>Item</b></th>
                                            <th><b>Type</th>
                                            <th width="100px" id="qty_type_value"><b>Quantity</b></th>
                                            <th width="100px"><b>Price</b></th>
                                            <th width="100px"><b>Discount</b></th>
                                            <th><b>Tax(%)</b></th>
                                            <th><b>Total</b></th>
                                        </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body">
                                        <!-- <tr>
                                            <td><input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="item[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="service">Service</option>
                                                    <option value="material">Material</option>
                                                    <option value="product">Product</option>
                                                </select></td>
                                            <td><input type="text" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" ></td>
                                            <td><input type="hidden" class="form-control tax" name="tax[]"
                                                       data-counter="0" id="tax_0" min="0" value="0">
                                                       <span id="span_tax_0">0.00 (7.5%)</span></td>
                                            <td><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                        </tr> -->
                                        <?php if( empty($w_items) ){ ?>
                                            <?php if(isset($jobs_data)): ?>
                                                <?php
                                                    $subtotal = 0.00;
                                                    foreach ($jobs_data_items as $item):
                                                    $item_price = $item->cost / $item->qty;
                                                    $total = $item->cost;
                                                    $hideSelectedItems .= "#ITEMLIST_PRODUCT_$item->id {display: none;}"; 
                                                ?>
                                                   <tr id=ss>
                                                        <td width="35%"><small>Item name</small>
                                                            <input value="<?= $item->title; ?>" type="text" name="item_name[]" class="form-control" readonly>
                                                            <input type="hidden" value='<?= $item->id ?>' name="item_id[]">
                                                        </td>
                                                        <td><small>Qty</small>
                                                            <input data-itemid='<?= $item->id ?>'  id='<?= $item->id ?>' value='<?= $item->qty; ?>' type="number" name="item_qty[]" class="form-control qty item-qty-<?= $item->id; ?>">
                                                        </td>
                                                        <td class="d-none"><small>Original Price</small>
                                                            <input readonly id='cost<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->price; ?>'  type="number" name="item_original_price[]" class="form-control item-original-price" placeholder="Cost">
                                                        </td>
                                                        <td><small>Unit Price</small>
                                                            <input id='price<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->retail; ?>'  type="number" name="item_price[]" class="form-control item-price" placeholder="Unit Price">
                                                        </td>
                                                        <td class="d-none"><small>Commission</small>
                                                            <input readonly step="any" id='commission<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->commission; ?>'  type="number" name="item_commission[]" class="form-control item-commission" placeholder="Commission">
                                                        </td>
                                                        <td class="d-none"><small>Margin</small>
                                                            <input readonly step="any" id='margin<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->margin; ?>'  type="number" name="item_margin[]" class="form-control item-margin" placeholder="Margin">
                                                        </td>
                                                        <!--<td width="10%"><small>Unit Cost</small><input type="text" name="item_cost[]" class="form-control"></td>-->
                                                        <!--<td width="25%"><small>Inventory Location</small><input type="text" name="item_loc[]" class="form-control"></td>-->
                                                        <td><small>Item Type</small><input readonly type="text" class="form-control" value='<?= $item->type ?>'></td>
                                                        <td>
                                                            <small>Amount</small><br>
                                                            <b data-subtotal='<?= $total ?>' id='sub_total<?= $item->id ?>' class="total_per_item">$<?= number_format((float)$total,2,'.',',');?></b>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="nsm-button items_remove_btn remove_item_row mt-2" onclick="$('#ITEMLIST_PRODUCT_<?php echo "$item->id"; ?>').show();"><i class="bx bx-trash" aria-hidden="true"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $subtotal = $subtotal + $total;
                                                    endforeach;
                                                ?>
                                            <?php endif; ?>
                                        <?php }else{ ?>
                                            <?php $item_row = 0; foreach($w_items as $data){ ?>

                                            <tr>
                                                <td width="30%">
                                                    <input type="text" class="form-control getItems"
                                                           onKeyup="getItems(this)" name="items[]" value="<?php echo $data->title; ?>">
                                                    <ul class="suggestions"></ul>
                                                    <div class="show_mobile_view"><span class="getItems_hidden"><?php echo $data->title; ?></span></div>
                                                    <input type="hidden" name="itemid[]" id="itemid" class="itemid" value="<?php echo $data->items_id; ?>">
                                                </td>
                                                <td width="20%">
                                                <div class="dropdown-wrapper">
                                                    <select name="item_type[]" id="item_typeid" class="form-control">
                                                        <option value="<?php echo $data->type; ?>"><?php echo $data->type; ?></option>
                                                        <option value="product">Product</option>
                                                        <option value="material">Material</option>
                                                        <option value="service">Service</option>
                                                        <option value="fee">Fee</option>
                                                    </select>
                                                </div>
                                                    </td>
                                                <td width="10%"><input type="number" data-itemid="<?php echo $data->items_id; ?>" class="form-control quantity mobile_qty hidden_mobile_view" name="quantity[]"
                                                           data-counter="0" id="quantity_<?php echo $item_row; ?>" value="<?php echo $data->qty; ?>"> 
                                                           <!-- <div class="show_mobile_view"><span>1</span><input type="hidden" class="form-control qtyest2" name="quantity[]"
                                                           data-counter="0" id="quantity_<?php echo $data->items_id; ?>" value="<?php echo $data->qty; ?>"></div>  -->
                                                           </td>
                                                <td width="10%"><input type="number" data-itemid="<?php echo $data->items_id; ?>" class="form-control price hidden_mobile_view" name="price[]"
                                                           data-counter="0" id="price_<?php echo $item_row; ?>" min="0" value="<?php echo $data->costing; ?>"> <input type="hidden" class="priceqty" id="priceqty_<?php echo $data->id; ?>" value="<?php $quantity1 = $data->qty;
                                                                                        $price1 = $data->costing; 
                                                                                        $total1 = $quantity1*$price1;
                                                                                        echo $total1;
                                                                                                    ?>"> 
                                                           <!-- <div class="show_mobile_view"><span class="price">0</span><input type="hidden" class="form-control price" name="price[]" data-counter="0" id="priceM_<?php echo $data->id; ?>" min="0" value="0"></div> -->
                                                           <input id="priceM_qty<?php echo $data->items_id; ?>"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty" value="" /></td>
                                                <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                                           data-counter="0" id="discount_<?php echo $item_row; ?>" min="0"  value="0" ></td>
                                                <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                                           data-counter="0" id="tax1_<?php echo $item_row; ?>" min="0" value="<?php echo number_format($data->tax,2); ?>">
                                                           <!-- <span id="span_tax_0">0.0</span> -->
                                                           </td>
                                                <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                                           data-counter="0" id="item_total_<?php echo $data->items_id; ?>" min="0" value="<?php $a = $data->qty * $data->costing; $b = $a + $data->tax; echo $b; ?>">
                                                           $<span id="span_total_<?php echo $item_row; ?>"><?php $a = $data->qty * $data->costing; $b = $a + $data->tax; echo number_format($b,2); ?></span></td>
                                                <td><a href="#" class="remove btn btn-sm btn-success"><i class="bx bx-fw bx-trash"></a></td>
                                            </tr>
                                            <?php $item_row++;} ?>

                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                    <style type="text/css">
                                                <?php echo $hideSelectedItems; ?>
                                            </style>
                                    <div class="row lamesa">
                                        <!-- <a class="link-modal-open pt-1 pl-2" href="#" id="add_another_new_invoice" style="color:#02A32C;"><span
                                                    class="fa fa-plus-square fa-margin-right" style="color:#02A32C;"></span>Add Items</a> -->
                                        <a href="#" id="add_another_new_invoice2" style="color:#02A32C;" data-toggle="modal" data-target="#item_list"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line </a>
                                        <hr style="display:inline-block; width:91%">
                                    </div>
                                    <!-- <div class="row" style="background-color:white;font-size:16px;">
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-5">
                                            <table class="table" style="text-align:left;">
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td></td>
                                                    <td>$ <span id="item_total_text">0.00</span>
                                                        <input type="hidden" name="sub_total" id="item_total"></td>
                                                </tr>
                                                <tr>
                                                    <td>Taxes</td>
                                                    <td></td>
                                                    <td>$ <span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                                    <td style="width:150px;">
                                                    <input type="number" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                        <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                    </td>
                                                    <td>0.00</td>
                                                </tr>
                                                    <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                <tr style="color:blue;font-weight:bold;font-size:18px;">
                                                    <td><b>Grand Total ($)</b></td>
                                                    <td></td>
                                                    <td><b><span id="grand_total">0.00</span>
                                                        <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div> -->
                                    <div class="row" style="background-color:white;font-size:16px;">
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-5">
                                            <table class="table table_mobile" style="text-align:left;">
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span id="span_sub_total_invoice">0.00</span>
                                                        <input type="hidden" name="subtotal" id="item_total"></td>
                                                </tr>
                                                <tr>
                                                    <td>Taxes</td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:; display:inline; border: 1px dashed #d1d1d1"></td>
                                                    <td align="center">
                                                    <input type="number" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:50%;display:inline;">
                                                        <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                    </td>
                                                    <td><span id="adjustmentText">0.00</span></td>
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
                                                <tr style="color:blue;font-weight:bold;font-size:16px;">
                                                    <td><b>Grand Total ($)</b></td>
                                                    <td></td>
                                                    <td><b><span id="grand_total">0.00</span>
                                                        <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                            <br>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h5>Request a Deposit</h5>
                                    <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <select name="deposit_request_type" class="form-control">
                                        <option value="$" selected="selected">Deposit amount $</option>
                                        <option value="%">Percentage %</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="input-group">
                                        <input type="text" name="deposit_amount" value="0" class="form-control"
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h5>Payment Schedule</h5>
                                    <span class="help help-sm help-block">Split the balance into multiple payment milestones.</span>
                                    <p><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Manage payment schedule </a></p>
                                </div>
                            </div>
                            <br>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h5>Accepted payment methods</h5>
                                    <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="credit_card_payments" value="1"
                                                checked id="credit_card_payments">
                                        <label for="credit_card_payments"><span>Credit Card Payments ()</span></label>
                                    </div>
                                    <span class="help help-sm help-block">Your client can pay your invoice using credit card or bank account online. You will be notified when your client makes a payment and the money will be transferred to your bank account automatically. </span>
                                    <div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>frontend/images/credit_cards.png" alt=""></div>
                                </div>
                                <div class="col-md-12">
                                    <span class="help help-sm help-block">Your payment processor is not set up
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewCustomer">setup payment</a></span>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="bank_transfer" value="1"
                                                checked id="bank_transfer">
                                        <label for="bank_transfer"><span>Bank Transfer</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="instapay" value="1"
                                                checked id="instapay">
                                        <label for="instapay"><span>Instapay</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="check" value="1"
                                                checked id="check">
                                        <label for="check"><span>Check</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="cash" value="1"
                                                checked id="cash">
                                        <label for="cash"><span>Cash</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="deposit" value="1"
                                                checked id="deposit">
                                        <label for="deposit"><span>Deposit</span></label>
                                    </div>
                            </div>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                            <br><br>
                                    <h5>Message to Customer</h5>
                                    <span class="help help-sm help-block">Add a message that will be displayed on the invoice.</span>
                                    <textarea name="message_to_customer" cols="40" rows="2" class="form-control">Thank you for your business.</textarea>
                                </div>
                                <div class="col-md-12">
                                <br><br>
                                    <h5>Terms &amp; Conditions</h5>
                                    <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the invoice.</span>
                                    <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control ckeditor editor1_tc"></textarea>
                                </div>
                            </div>
                            </div>

                            <div class="row" style="background-color:white;padding-top:2%;">
                                <div class="col-md-12">
                                    <h5>Attachments</h5>
                                    <div class="help help-sm help-block margin-bottom-sec">Optionally attach files to this invoice. Allowed type: pdf, doc, docx, png, jpg, gif.</div>

                                    <ul class="attachments" data-fileupload="attachment-list">
                                            </ul>
                                    <script async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/template" data-fileupload="attachment-list-template">
                                        <li data-attach-to-invoice="0">
                                            <a class="a-default" target="_blank" href="{{url}}"><span class="fa fa-{{icon}}"></span> {{name_original}}</a>
                                            <a class="attachments__delete a-default margin-left-sec" data-id="{{id}}" data-fileupload="attachment-delete" href="#"><span class="fa fa-trash-o icon"></span></a>
                                                        <input type="hidden" name="attachment_id[]" value="{{id}}">
                                                    </li>
                                        </script>
                                        <br>
                                    <div class="alert alert-danger" data-fileupload="attachment-error" role="alert" style="display: none;"></div>
                                    <div class="" data-fileupload="attachment-progressbar" style="display: none;">
                                        <div class="text">Uploading</div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                        </div>
                                    </div>
                                    <span class="btn btn-default btn-md fileinput-button vertical-top"><span class="fa fa-upload"></span> Upload File <input data-fileupload="attachment-file" name="attachment-file" type="file"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row" style="background-color:white;padding-top:10px;">
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-light but" style="border-radius: 0 !important;border:solid gray 1px;" data-action="save">Save</button>
                                    <!-- <button class="btn btn-success but" style="border-radius: 0 !important;" data-action="send">Preview</button> -->
                                    <a href="<?php echo url('invoice') ?>" class="btn but-red">cancel this</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <?php echo form_close(); ?>

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal New Customer -->
            <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

             <!--    Modal for creating rules-->
             <div class="modal-right-side">
                                <div class="modal right fade" id="createTagGroup" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel2" >Create New Group</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        
                                            <div class="modal-body pt-3">
                                                <!-- <div class="subheader">Rules only apply to unreviewed transactions.</div> -->
                                                    <form class="mb-3" id="tags_group_form">
                                                        <div class="form-row mb-3">
                                                            <div class="col-md-8">
                                                                <label for="tag-group-name">Group name</label>
                                                                <input type="text" name="tags_group_name" id="tag-group-name" class="form-control">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">&nbsp;</label>
                                                                <select id="e2" class="form-control" name="group_color" style="background-color: green; color: white">
                                                                    <option value="green" style="background-color:green">Green</option>
                                                                    <option value="yellow" style="background-color:yellow; color: black">Yellow</option>
                                                                    <option value="red" style="background-color:red">Red</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-success" type="submit">Save</button>
                                                    </form>
                                                    <table id="tags-group" class="table table-bordered mb-3 hide">
                                                        <tbody></tbody>
                                                    </table>
                                                    <h6>Add tags to this group</h6>
                                                    <form class="mb-3" id="tags_form">
                                                        <div class="form-row mb-3">
                                                            <div class="col-md-8">
                                                                <label for="tag_name">Tag name</label>
                                                                <input type="text" name="tag_name" id="tag_name" class="form-control">
                                                            </div>
                                                            <div class="col-md-4 d-flex align-items-end">
                                                                <button class="btn btn-success w-100">Add</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <table id="group-tags" class="table table-bordered mb-3 hide">
                                                        <tbody></tbody>
                                                    </table>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="" style="position: relative;display: inline-block;">Put similar tags in the same group to get better reports. <a href="#">Find out more</a></label>
                                                        <p><a href="#">Show me examples of groups</a></p>
                                                    </div>
                                                    <div class="form-group modaldivision">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                I have a clothing store. I want to see which seasonal collection sells the best.
                                                                </div>
                                                                <div class="col-md-6">
                                                                Group: Collection
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
                                                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>: 
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Spring</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
                                                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>: 
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Summer</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group modaldivision">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                I run a gym. I want to see which fitness classes and instructors make the most money.
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>Group: Fitness class</p>
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
                                                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Yoga</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
                                                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Rowing</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <p>Group: Instructor</p>
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
                                                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Daniel</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
                                                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Maria</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" data-dismiss="modal">Done</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--    end of modal-->



                            <div class="modal right fade" id="tags-modal" tabindex="-1" role="dialog" aria-labelledby="tags-modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" id="tags-list">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Manage your tags</h4>
                                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                                        </div>
                                        <div class="modal-body pt-3">
                                            <div class="row">
                                                <div class="col-6 d-flex">
                                                    <button type="button" class="btn btn-outline-secondary m-auto" onclick="getTagForm({}, 'create')">Create Tag</button>
                                                </div>
                                                <div class="col-6 d-flex">
                                                    <button type="button" class="btn btn-outline-secondary m-auto" onclick="getGroupTagForm()">Create Group</button>
                                                </div>
                                                <div class="col-12 py-3">
                                                    <input type="text" name="search_tag" id="search-tag" class="form-control" placeholder="Find tag by name">
                                                </div>
                                                <div class="col-12">
                                                    <table id="tags-table" class="table table-bordered table-hover">
                                                        <thead>
                                                            <th>Tags</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

            <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control" autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save">Save changes</button>
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

<!-- Modal -->
<div class="modal fade lamesa" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <table id="items_table" class="table table-hover" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td style="width: 0% !important;"></td>
                                                    <td><strong>Name</strong></td>
                                                    <td><strong>On Hand</strong></td>
                                                    <td><strong>Price</strong></td>
                                                    <td><strong>Type</strong></td>
                                                    <td class='d-none'><strong>Location</strong></td>
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
                                                        <button type="button" data-dismiss="modal" class='btn btn-sm btn-light border-1 select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-retail="<?= $item->retail; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                                    </td>
                                                    <td><?php echo $item->title; ?></td>
                                                    <td><?php foreach($itemsLocation as $itemLoc){
                                                        if($itemLoc->item_id == $item->id){
                                                            echo "<div class='data-block'>";
                                                            echo $itemLoc->name. " = " .$itemLoc->qty;
                                                            echo "</div>";
                                                        } 
                                                    }
                                                    ?></td>
                                                    <td><?php echo $item->retail; ?></td>
                                                    <td><?php echo $item->type; ?></td>
                                                    <td class='d-none'><?php echo $item->location_name; ?></td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-detail">
                            <div class="button-modal-list">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
<?php include viewPath('accounting/add_new_term'); ?>
<?php //include viewPath('v2/includes/footer'); ?>
<?php include viewPath('includes/footer'); ?>
<!-- Fancybox -->
<script src="<?= base_url("assets/js/v2/fancybox.umd.js") ?>"></script>

<!-- Switchery -->
<script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js"></script>

<!-- Main Script -->
<script type="text/javascript" src="<?= base_url("assets/js/v2/main.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.draggable.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.table.js") ?>"></script>

<script>
    $(document).ready(function () {
	$('#datepickerinv222').datepicker({
      uiLibrary: 'bootstrap'
    });
});

</script>

<script>
//   $(function() {
//     $("#rebatable_toggle").each(function(){
//     $(this).change(function() {
//     //   $('#console-event').html('Toggle: ' + $(this).prop('checked'))
//     alert('yeah');
//     })
//   })
$(document).ready(function () {

//iterate through all the divs - get their ids, hide them, then call the on click
$(".toggle").each(function () {
    var $context = $(this);
    var $button = $context.find("#rebatable_toggle");
    //            $currentId = $button.attr('id');
    // var $divOptions = $context.find('div').last();

    //$($divOptions).hide();
    $($button).on('change', function (event) {
        // alert('yeah');
        // $(this).click(function() {        
        var id = $($button).attr("item-id");
        var get_val = $($button).val();
        // alert(id);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/changeRebate",
            data: {id : id, get_val : get_val },
            dataType: 'json',
            success: function(response){
                // alert('Successfully Change');
                sucess("Rebate Updated Successfully!");
                // $('.lamesa').load(window.location.href +  ' .lamesa');
                // location.reload();
                $('#item_list').modal('toggle');
                // $("#item_list .modal-body").load(target, function() { 
                // $("#item_list").modal("show"); 
                // });
                $('#item_list').on('hidden.bs.modal', function (e) {
                    location.reload();
                    });
            },
                error: function(response){
                alert('Error'+response);
       
                }
        });

        function sucess(information,$id){
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
                    window.location.href="<?= base_url(); ?>customer/preview/"+$id;
                }
            });
        }

    // });
    });
});
});
</script>

<script>
$(document).ready(function() {
var options = {
  urlGetAll: base_url + "invoice/customer/json_list",
  urlGetAllJob: base_url + "invoice/job/json_list",
  urlAdd: base_url + "invoice/source/save/json",
  urlServiceAddressForm: base_url + "invoice/service_address_form",
  urlSaveServiceAddress: base_url + "invoice/save_service_address",
  urlGetServiceAddress: base_url + "invoice/json_get_address_services",
  urlRemoveServiceAddress: base_url + "invoice/remove_address_services",
  urlAdditionalContactForm: base_url + "invoice/new_customer_form",
  urlRecordPaymentForm: base_url + "invoice/record_payment_form",
  urlPayNowForm: base_url + "invoice/pay_now_form",
  urlSaveAdditionalContact: base_url + "invoice/save_new_customer",
  urlGetAdditionalContacts: base_url + "invoice/json_get_new_customers",
  urlRemoveInvoice: base_url + "invoice/delete",
  urlCloneInvoice: base_url + "invoice/clone",
  urlMarkAsSentInvoice: base_url + "invoice/mark_as_sent",
  urlSavePaymentRecord: base_url + "invoice/save_payment_record",
  urlPayNow: base_url + "invoice/stripePost",
};


  // open additional contact form
  $("#modalNewCustomer").on("shown.bs.modal", function (e) {
    var element = $(this);
    $(element).find(".modal-body").html("loading...");

    var service_address_index = $(e.relatedTarget).attr("data-id");
    var inquiry_id = $(e.relatedTarget).attr("data-inquiry-id");

    if (service_address_index && inquiry_id) {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        data: {
          index: service_address_index,
          inquiry_id: inquiry_id,
          action: "edit",
        },
        success: function (response) {
          // console.log(response);

          $(element).find(".modal-body").html(response);
        },
      });
    } else {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        success: function (response) {
          $(element).find(".modal-body").html(response);
        },
      });
    }
  });
});
</script>

<script>
// $(document).ready(function(){
//     // $('#rebatable_toggle').click(function () {
//     //     alert('yeah');
//     // });
//     // $("#rebatable_toggle").change(function() {
//     // if(this.checked) {
//     //     alert('yeah');
//     // }
// // });
// // $("#rebatable_toggle").change(function(){
// //     if($(this).prop("checked") == true){
// //         alert('yeah');
// //     }else{
// //         alert('no');
// //     }
// // });

// // $('.toggle_checkbox').each(function() {

// // // $parent = $( el ).closest( '.toggle_checkbox' );
// // $( this ).click(function() {
// //     var yeah = $(this).attr("item-id");
// //     alert(yeah);
// // });

// // });



// });
// function myFunctionChecked() {
//     var yeah = $(this).attr("item-id");

//     alert(yeah);
// }

// $(".toggle_checkbox").each(function(){
//     // alert($(this).attr("item-id"));
//     $( this ).click(function() {        
//         var id = $(this).attr("item-id");
//         var get_val = $(this).val();
//         // alert(yeah);

//         $.ajax({
//             type: 'POST',
//             url:"<?php echo base_url(); ?>accounting/changeRebate",
//             data: {id : id, get_val : get_val },
//             dataType: 'json',
//             success: function(response){
//                 alert('Successfully Change');
//                 // $('.lamesa').load(window.location.href +  ' .lamesa');
//                 location.reload();
//                 $('#item_list').modal('toggle');
//             },
//                 error: function(response){
//                 alert('Error'+response);
       
//                 }
//         });

//     });
// });

</script>


<script>
    $(function() {
        $("nav:first").addClass("closed");
    });
</script>

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
<script>
function initialize() {
          var input = document.getElementById('invoice_jobs_location');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>

$(document).ready(function(){
 
    $('#customer-id').change(function(){
    var id  = $(this).val();
    // alert(id);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/addLocationajax",
            data: {id : id },
            dataType: 'json',
            success: function(response){
                // alert('success');
                console.log(response['customer']);
            $("#invoice_jobs_location").val(response['customer'].mail_add + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
            $("#customer_email").val(response['customer'].email);
            $("#shipping_address").val(response['customer'].mail_add);
            $("#billing_address").val(response['customer'].mail_add);
        
            },
                error: function(response){
                alert('Error'+response);
       
                }
        });
    });
});

</script>


<script>
    //dropdown checkbox
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
    //DataTables JS
    $(document).ready(function() {
        $('#group-tags-select2').select2({
            ajax: {
                url: '/accounting/get-group-tags',
                dataType: 'json'
            }
        });

        $('#tags_table').DataTable({
            autoWidth: false,
            searching: false,
            processing: true,
            serverSide: true,
            lengthChange: false,
            pageLength: 50,
            ordering: false,
            info: false,
            paging: false,
            ajax: {
                url: 'load-all-tags/',
                dataType: 'json',
                contentType: 'application/json', 
                type: 'POST',
                data: function(d) {
                    return JSON.stringify(d);
                },
                pagingType: 'full_numbers',
            },
            columns: [
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'transactions',
                    name: 'transactions',
                },
                {
                    data: 'actions',
                    name: 'actions',
                }
            ],
            fnCreatedRow: function(nRow, aData, iDataIndex) {
                if(aData['type'] === 'group-tag') {
                    $(nRow).attr('id', `child-${aData['parentIndex']}`);
                    $(nRow).addClass('collapse bg-muted');
                }
            }
        });
    } );
</script>
