<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>

<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/workorder/autosave.js")?>"></script> -->

<?php include viewPath('includes/workorder/sign-modal'); ?>

<style>
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
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/workorder_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Create your workorder.
                        </div>
                    </div>
                </div>

                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'form_new_workorder', 'autocomplete' => 'off']); ?>
                
                <input type="hidden" id="siteurl" value="<?=base_url();?>">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="d-block">Header</span>
                                            <label class="nsm-subtitle">
                                                <?php echo $headers->content; ?>
                                            </label>
                                        </div>
                                        <div class="nsm-card-controls align-items-start">
                                            <a role="button" class="nsm-button btn-sm m-0 me-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#update_header_modal">
                                                Update Header
                                            </a>
                                        </div>
                                        <?php
                                        $dt = new DateTime();
                                        $timestamp = time();
                                        $selected_date = date('m-d-Y');
                                        ?>
                                        <input type="hidden" class="nsm-field form-control" id="headerID" name="header" value="<?php echo $headers->content; ?>">
                                        <input type="hidden" class="nsm-field form-control" id="company_name" value="<?php echo $clients->business_name; ?>">
                                        <input type="hidden" class="nsm-field form-control" id="current_date" value="<?= $selected_date ?>">
                                        <input type="hidden" class="nsm-field form-control" id="content_input" name="header2" value="<?php echo $headers->content; ?>">
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Work Order Number</label>
                                                <input type="text" name="workorder_number" id="workorder-number" class="nsm-field form-control" value="<?= $prefix . $next_num; ?>" readonly required />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="row g-3">
                                                    <div class="col-6">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Select Customer</label>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <a href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link" data-bs-toggle="modal" data-bs-target="#new_customer_modal">Add New Customer</a>
                                                    </div>
                                                </div>
                                                <select class="nsm-field form-select select2" name="customer_id" id="sel-customer">
                                                    <option value="0">- none -</option>
                                                    <?php foreach ($customers as $c) { ?>
                                                        <option value="<?= $c->prof_id; ?>" <?php if($estimate->customer_id == $c->prof_id){ echo 'selected'; } ?>><?= $c->contact_name . '' . $c->first_name . ' ' . $c->last_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Social Security Number</label>
                                                <input type="text" name="security_number" id="security_number" class="nsm-field form-control number-field" placeholder="xxx-xx-xxxx" value="<?php echo $customer->ssn; ?>" required />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Birth Date</label>
                                                <input type="text" name="birthdate" id="birthdate" class="nsm-field form-control" required value="<?php echo date("m/d/Y", strtotime($customer->date_of_birth)); ?>" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                                                <input type="text" name="phone_number" id="phone_no" class="nsm-field form-control number-field" value="<?php echo $customer->phone_h; ?>"  />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                                                <input type="text" name="mobile_number" id="mobile_no" class="nsm-field form-control number-field" value="<?php echo $customer->phone_m; ?>" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                                                <input type="email" name="email" id="email" class="nsm-field form-control" required value="<?php echo $customer->email; ?>"  />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                                                <input type="text" name="password" id="password" class="nsm-field form-control" value="<?= $acsAccess ? $acsAccess->access_password : 'Not Specified'; ?>" required />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Name (Optional)</label>
                                                <input type="text" name="business_name" id="business_name" class="nsm-field form-control" value="<?php echo $customer->business_name; ?>" />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Job Location</label>
                                                <input type="text" name="job_location" id="job_location" class="nsm-field form-control" required value="<?php echo $customer->mail_add.', '.$customer->city.', '.$customer->state.', '.$customer->zip_code; ?>"  />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                                <input type="text" name="city" id="city" class="nsm-field form-control" required  value="<?php echo $customer->city; ?>" />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">State</label>
                                                <input type="text" name="state" id="state" class="nsm-field form-control" required value="<?php echo $customer->state; ?>"  />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">Zip code</label>
                                                <input type="text" name="zip_code" id="zip" class="nsm-field form-control" required  value="<?php echo $customer->zip_code; ?>" />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">Cross Street</label>
                                                <input type="text" name="cross_street" id="cross_street" class="nsm-field form-control" value="<?php echo $customer->cross_street; ?>" />
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="acs_fullname" id="acs_fullname">
                                                <input type="hidden" name="company_name" id="company_name" value="<?php echo $companyDet->first_name . ' ' . $companyDet->last_name; ?>">
                                                <input type="hidden" name="business_address" id="business_address" value="<?php echo $companyDet->business_address; ?>">
                                                <input type="hidden" name="acs_phone_number" id="acs_phone_number" value="<?php echo $companyDet->phone_number; ?>">
                                                <!-- <hr> -->
                                            </div>

                                            <?php 
                                            // print_r($fieldsName);
                                            foreach ($fieldsName as $field) { ?>
                                                <div class="col-12 col-md-6">
                                                    <div class="row g-3">
                                                        <div class="col-6">
                                                            <label class="content-subtitle fw-bold d-block mb-2"><?php echo $field->name; ?></label>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            <a href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link btn-edit-field" data-id="<?php echo $field->id; ?>" data-name="<?php echo $field->name; ?>">Edit</a>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="custom_value[]" id="custom1_value" class="nsm-field form-control" />
                                                    <input type="hidden" class="custom_<?php echo $field->id; ?>" value="<?php echo $field->name; ?>" name="custom_field[]">
                                                </div>
                                            <?php } ?>

                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-12 col-md-6 d-flex align-items-center">
                                                <label class="content-title">Item Summary</label>
                                            </div>
                                            <div class="col-12 col-md-6 text-end">
                                                <label class="content-subtitle fw-bold me-2">Show as:</label>
                                                <select class="nsm-field form-select w-auto d-inline-block">
                                                    <option>Quantity</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="count" id="count" value="0">
                                                <!-- <table class="nsm-table">
                                                    <thead>
                                                        <tr>
                                                            <td data-name="Name">Name</td>
                                                            <td data-name="Group">Group</td>
                                                            <td data-name="Quantity">Quantity</td>
                                                            <td data-name="Price">Price</td>
                                                            <td data-name="Discount">Discount</td>
                                                            <td data-name="Tax (Change in %)">Tax (Change in %)</td>
                                                            <td data-name="Total">Total</td>
                                                            <td data-name="Manage"></td>
                                                        </tr>
                                                    </thead> -->
                                                    <!-- <tbody id="item_list_table">
                                                        <tr>
                                                            <td style="width: 100%; max-width: 20%;">
                                                                <select class="nsm-field form-select select2 item-selection" name="items[]">
                                                                </select>
                                                                <input type="hidden" name="itemid[]" class="itemid" value="0">
                                                                <input type="hidden" name="packageID[]" value="0">
                                                            </td>
                                                            <td>
                                                                <select class="nsm-field form-select" name="item_type[]" id="item_typeid">
                                                                    <option value="product">Product</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="service">Service</option>
                                                                    <option value="fee">Fee</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="quantity[]" id="quantity_0" class="nsm-field form-control quantity-field" value="1" data-counter="0" />
                                                            </td>
                                                            <td>
                                                                <input type="number" name="price[]" id="price_0" class="nsm-field form-control price-field" value="0" data-counter="0" min="0" />
                                                                <input type="hidden" class="priceqty" id="priceqty_0" value="0">
                                                            </td>
                                                            <td>
                                                                <input type="number" name="discount[]" id="discount_0" class="nsm-field form-control discount-field" value="0" data-counter="0" min="0" />
                                                            </td>
                                                            <td>
                                                                <input type="text" name="tax[]" id="tax1_0" class="nsm-field form-control tax-field" value="0" data-counter="0" min="0" readonly />
                                                            </td>
                                                            <td>
                                                                <input type="hidden" class="nsm-field form-control total-field" name="total[]" data-counter="0" id="item_total_0" min="0" value="0">
                                                                $<span id="span_total_0">0.00</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown table-management">
                                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a class="dropdown-item remove-item" href="javascript:void(0);" id="0">Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody> -->
                                                    <!-- <tbody id="jobs_items_table_body">
                                                        <tr style="display:;">
                                                            <td width="30%">
                                                                <input type="text" class="form-control getItems"
                                                                    onKeyup="getItems(this)" name="items[]">
                                                                <ul class="suggestions"></ul>
                                                                <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                                                <input type="hidden" name="item_id[]" id="itemid" class="item_id" value="0">
                                                                <input type="hidden" name="packageID[]" value="0">
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
                                                            <td width="10%"><input type="number" class="form-control price price hidden_mobile_view" name="price[]"
                                                                    data-counter="0" id="price_0" min="0" value="0"> <input type="hidden" class="priceqty" id="priceqty_0" value="0"> 
                                                                    <div class="show_mobile_view">
                                                                    </div><input id="priceM_qty0" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty"></td>
                                                            <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                                                    data-counter="0" id="discount_0" min="0" value="0"></td>
                                                            <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                                                    data-counter="0" id="tax1_0" min="0" value="0" readonly="">
                                                                    </td>
                                                            <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                                                    data-counter="0" id="item_total_0" min="0" value="0">
                                                                    $<span id="span_total_0">0.00</span></td>
                                                            <td><a href="#" class="remove btn btn-sm btn-danger" id="0"><i class="fa fa-trash" aria-hidden="true"></i>Remove</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table> -->
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
                                                        <th class=""></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="jobs_items_table_body">
                                                    <?php 
                                                    $i = 0;
                                                    foreach($items_data as $items_d){ ?>
                                                    <tr style="display:;">
                                                        <td width="30%">
                                                            <input type="text" class="form-control getItems"
                                                                onKeyup="getItems(this)" name="items[]" value="<?php echo $items_d->title; ?>">
                                                            <ul class="suggestions"></ul>
                                                            <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                                            <input type="hidden" name="item_id[]" id="itemid" class="item_id" value="<?php echo $items_d->id; ?>">
                                                            <input type="hidden" name="packageID[]" value="0">
                                                        </td>
                                                        <td width="20%">
                                                        <div class="dropdown-wrapper">
                                                            <select name="item_type[]" id="item_typeid" class="form-control">
                                                                <option value="product" <?php if($items_d->title == 'Product' || $items_d->title == 'product'){ echo 'selected'; } ?> >Product</option>
                                                                <option value="material" <?php if($items_d->title == 'Material' || $items_d->title == 'material'){ echo 'selected'; } ?> >Material</option>
                                                                <option value="service" <?php if($items_d->title == 'Service' || $items_d->title == 'service'){ echo 'selected'; } ?> >Service</option>
                                                                <option value="fee" <?php if($items_d->title == 'Fee' || $items_d->title == 'fee'){ echo 'selected'; } ?> >Fee</option>
                                                            </select>
                                                        </div>

                                                            </td>
                                                        <td width="10%"><input type="number" class="form-control quantity mobile_qty" name="quantity[]"
                                                                data-counter="0" id="quantity_<?php echo $i; ?>" value="<?php echo $items_d->qty; ?>"></td>
                                                        <td width="10%"><input type="number" class="form-control price price hidden_mobile_view" name="price[]"
                                                                data-counter="0" id="price_<?php echo $i; ?>" min="0" value="<?php echo $items_d->iCost; ?>"> <input type="hidden" class="priceqty" id="priceqty_<?php echo $i; ?>" value="0"> 
                                                                <div class="show_mobile_view">
                                                                </div><input id="priceM_qty<?php echo $i; ?>" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty" value="<?php echo $items_d->iCost; ?>"></td>
                                                        <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                                                data-counter="0" id="discount_<?php echo $i; ?>" min="0" value="<?php echo $items_d->discount; ?>"></td>
                                                        <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                                                data-counter="0" id="tax1_<?php echo $i; ?>" min="0" value="<?php echo $items_d->itax; ?>" readonly="">
                                                                </td>
                                                        <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                                                data-counter="0" id="item_total_<?php echo $i; ?>" min="0" value="<?php echo ($items_d->qty * $items_d->iCost) + $items_d->itax; ?>">
                                                                $<span id="span_total_<?php echo $i; ?>"><?php echo ($items_d->qty * $items_d->iCost) + $items_d->itax; ?></span></td>
                                                        <td><a href="#" class="remove btn btn-sm btn-danger" id="0"><i class="fa fa-trash" aria-hidden="true"></i>Remove</a></td>
                                                    </tr>
                                                    <?php 
                                                    $i++;
                                                } ?>
                                                
                                                <input type="hidden" name="count" value="<?php echo $i; ?>" id="count">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <button type="button" class="nsm-button ms-0" data-bs-toggle="modal" data-bs-target="#item_list"><i class='bx bx-fw bx-plus-circle'></i> Add Items</button>
                                                        <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add_by_group_modal"><i class='bx bx-fw bx-plus-circle'></i> Add By Group</button>
                                                        <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#package_modal"><i class='bx bx-fw bx-plus-circle'></i> Add/Create Package</button>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Enter an offer code</label>
                                                        <input type="text" name="offer_code" id="offer_code" class="nsm-field form-control mb-2" />
                                                        <button type="button" class="nsm-button primary m-0" id="btn_validate_offer">Validate</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="row g-3" style="margin-top: 0px;">
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">Subtotal</label>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        $ <span id="span_sub_total_invoice"><?php echo $estimate->sub_total; ?></span>
                                                        <input type="hidden" name="subtotal" id="item_total" value="<?php echo $estimate->sub_total; ?>" />
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">Taxes</label>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        $ <span id="total_tax_"><?php echo $estimate->tax1_total; ?></span>
                                                        <input type="hidden" name="taxes" id="total_tax_input" value="<?php echo $estimate->tax1_total; ?>" />
                                                    </div>
                                                    <div class="col-12 col-md-6 d-flex align-items-center">
                                                        <input type="text" class="nsm-field form-control" placeholder="Adjustment Name" name="adjustment_name" id="adjustment_name" style="border: 1px dashed #d1d1d1;">
                                                        <i class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;" data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Optional it allows you to adjust the total amount Eg. +10 or -10."></i>
                                                    </div>
                                                    <div class="col-12 col-md-3 offset-md-3 text-end">
                                                        <div class="input-group">
                                                            <span class="input-group-text">$</span>
                                                            <input type="number" name="adjustment_value" id="adjustment_input" class="nsm-field form-control text-end" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                        <hr>
                                                    </div>
                                                    <div class="col-12 col-md-6 saved-field d-none">
                                                        <label class="content-title">Amount Saved</label>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end saved-field d-none">
                                                        $ <span id="offer_cost">0.00</span>
                                                        <input type="hidden" name="voucher_value" id="offer_cost_input">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">Grand Total ($)</label>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end fw-bold">
                                                        $ <span id="grand_total"><?php echo $estimate->grand_total; ?></span>
                                                        <input type="hidden" name="grand_total" id="grand_total_input" value='<?php echo $estimate->grand_total; ?>'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">Checklist</span>
                                    <label class="nsm-subtitle">You can set up a checklist for employees.</label>
                                </div>
                                <div class="nsm-card-controls">
                                    <a role="button" class="nsm-button btn-sm m-0 me-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#select_checklist_modal">
                                        Select Checklist
                                    </a>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <ul class="selected-checklists"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="d-block">Job Detail</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-8">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Job Type</label>
                                                        <select name="job_type" id="job_type" class="nsm-field form-select">
                                                            <?php foreach ($job_types as $jt) { ?>
                                                                <option value="<?php echo $jt->title ?>"><?php echo $jt->title ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Job Tag</label>
                                                        <select name="job_tag" id="job_tag" class="nsm-field form-select">
                                                            <?php foreach ($job_tags as $tags) { ?>
                                                                <option value="<?php echo $tags->name; ?>"><?php echo $tags->name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Schedule Date Given</label>
                                                        <input type="date" name="schedule_date_given" class="nsm-field form-control datepicker" required />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Priority</label>
                                                        <select name="priority" class="nsm-field form-select">
                                                            <option value="Standard">Standard</option>
                                                            <option value="Emergency">Emergency</option>
                                                            <option value="Low">Low</option>
                                                            <option value="Urgent">Urgent</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Lead Source</label>
                                                        <select name="lead_source" class="nsm-field form-select">
                                                            <option value="0">- none -</option>
                                                            <?php foreach ($lead_source as $lead) { ?>
                                                                <option value="<?php echo $lead->ls_id; ?>"><?php echo $lead->ls_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Job Name</label>
                                                        <input type="text" name="job_name" class="nsm-field form-control" required />
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Job Description</label>
                                                        <textarea name="job_description" class="nsm-field form-control" rows="2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="d-block">Payment Detail</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Payment Method</label>
                                                <select name="payment_method" id="payment_method" class="nsm-field form-select">
                                                    <option value="">Choose method</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Check">Check</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Debit Card">Debit Card</option>
                                                    <option value="ACH">ACH</option>
                                                    <option value="Venmo">Venmo</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="Square">Square</option>
                                                    <option value="Invoicing">Invoicing</option>
                                                    <option value="Warranty Work">Warranty Work</option>
                                                    <option value="Home Owner Financing">Home Owner Financing</option>
                                                    <option value="e-Transfer">e-Transfer</option>
                                                    <option value="Other Credit Card Professor">Other Credit Card Professor</option>
                                                    <option value="Other Payment Type">Other Payment Type</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Amount ( $ )</label>
                                                <input type="number" step=".01" name="payment_amount" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12 col-md-4 d-none" id="cash_area">
                                                <div class="d-flex align-items-center h-100">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="collected_checkbox">
                                                        <label class="form-check-label" for="collected_checkbox">Cash collected already</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="invoicing">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="same_as">
                                                            <label class="form-check-label" for="same_as">Same as above Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Mail Address</label>
                                                        <input type="text" name="mail-address" class="nsm-field form-control" placeholder="Monitored Location" />
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                                        <input type="text" name="mail_locality" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle fw-bold d-block mb-2">State</label>
                                                        <input type="text" name="mail_state" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label class="content-subtitle fw-bold d-block mb-2">ZIP</label>
                                                        <input type="text" name="mail_postcode" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Cross Street</label>
                                                        <input type="text" name="mail_cross_street" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="check_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Check Number</label>
                                                        <input type="text" name="check_number" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Routing Number</label>
                                                        <input type="text" name="routing_number" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Number</label>
                                                        <input type="text" name="account_number" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="credit_card">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                        <input type="text" name="credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                        <input type="text" name="credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                        <input type="text" name="credit_cvc" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="debit_card">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                        <input type="text" name="debit_credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                        <input type="text" name="debit_credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                        <input type="text" name="debit_credit_cvc" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="ach_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Routing Number</label>
                                                        <input type="text" name="ach_routing_number" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Number</label>
                                                        <input type="text" name="ach_account_number" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="venmo_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="account_note" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                        <input type="text" name="confirmation" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="paypal_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="paypal_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="paypal_account_note" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                        <input type="text" name="paypal_confirmation" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="paypal_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="square_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="square_account_note" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Confirmation</label>
                                                        <input type="text" name="square_confirmation" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="paypal_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="warranty_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="warranty_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="home_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="home_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="home_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="e_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="e_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="e_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="other_credit_card">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Number</label>
                                                        <input type="text" name="other_credit_number" class="nsm-field form-control" placeholder="0000 0000 0000 000" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Credit Card Expiration</label>
                                                        <input type="text" name="other_credit_expiry" class="nsm-field form-control" placeholder="MM/YYYY" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">CVC</label>
                                                        <input type="text" name="other_credit_cvc" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none" id="other_payment_area">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Credential</label>
                                                        <input type="text" name="other_payment_account_credentials" class="nsm-field form-control" />
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Account Note</label>
                                                        <input type="text" name="other_payment_account_note" class="nsm-field form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title d-block">
                                            <span class="d-block">Terms and Conditions</span>
                                        </div>
                                        <div class="nsm-card-controls">
                                            <a role="button" class="nsm-button btn-sm m-0 me-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#update_termscon_modal">
                                                Update Terms and Condition
                                            </a>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                        <input type="hidden" class="form-control" name="terms_conditions" id="terms_conditions" value="<?php echo $terms_conditions->content; ?>" />
                                        <div class="row g-3">
                                            <div class="col-12" id="terms_and_condition_text">
                                                <?php echo $terms_conditions->content; ?>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                                                <select name="status" class="nsm-field form-select">
                                                    <option value="New">New</option>
                                                    <option value="Draft">Draft</option>
                                                    <option value="Scheduled">Scheduled</option>
                                                    <option value="Started">Started</option>
                                                    <option value="Paused">Paused</option>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Invoiced">Invoiced</option>
                                                    <option value="Withdrawn">Withdrawn</option>
                                                    <option value="Closed">Closed</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Purchase Order # (optional)</label>
                                                <input type="text" name="purchase_order_number" class="nsm-field form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title d-block">
                                            <span class="d-block">Terms of Use</span>
                                        </div>
                                        <div class="nsm-card-controls">
                                            <a role="button" class="nsm-button btn-sm m-0 me-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#update_termsuse_modal">
                                                Update Terms of Use
                                            </a>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                        <input type="hidden" class="form-control" name="terms_of_use" id="terms_of_use" value="<?php echo $terms_uses->content; ?>" />
                                        <div class="row g-3">
                                            <div class="col-12" id="terms_of_use_text">
                                                <?php echo $terms_uses->content; ?>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Instructions</label>
                                                <textarea name="instructions" class="nsm-field form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title d-block">
                                    <span class="d-block">Signature</span>
                                    <label class="content-subtitle">By Signing below you verify that the above information is true and complete, and you authorize payment and confirmation with nSmarTrac.</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                
                                <div class="row signature_web lawas">
                                    <div class="col-md-4">
                                    <h6>Company Representative Approval</h6> <a class="btn btn-success companySignature"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                        <div id="companyrep"></div>

                                        <input type="hidden" id="saveCompanySignatureDB1a"
                                            name="company_representative_approval_signature1a">
                                        <br>

                                        <label for="comp_rep_approval">Printed Name</label>
                                        <!-- <input type="text6" class="form-control mb-3"
                                            name="company_representative_printed_name"
                                            id="company_representative_printed_name" placeholder=""/> -->
                                            <select class="form-control mb-3" name="company_representative_printed_name">
                                                <option value="0">Select Name</option>
                                                <?php foreach($users_lists as $ulist){ ?>
                                                    <option <?php if($ulist->id == logged('id')){ echo "selected";} ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                                <?php } ?>
                                            </select>
                                            <!-- <canvas id="canvas_web" style="border: 1px solid #ddd;"></canvas>
                                                <input type="text" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" placeholder="Printed Name"/> -->
                                                <!-- <input type="hidden" id="saveCompanySignatureDB1aM_web" name="company_representative_approval_signature1aM_web"> -->
                                                <div id="company_representative_div"></div>

                                    </div>
                                    <div class="col-md-4">
                                        <h6>Primary Account Holder</h6><a class="btn btn-warning primarySignature"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                        <div id="primaryrep"></div>
                                        <input type="hidden" id="savePrimaryAccountSignatureDB2a"
                                            name="primary_account_holder_signature2a">
                                        <br>

                                        <label for="comp_rep_approval">Printed Name</label>
                                        <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                            id="primary_account_holder_name" placeholder=""/>
                                        <!-- <select class="form-control mb-3" name="primary_account_holder_name">
                                                <option value="0">Select Name</option>
                                                <?php //foreach($users_lists as $ulist){ ?>
                                                    <option value="<?php //echo $ulist->id ?>"><?php //echo $ulist->FName .' '.$ulist->LName; ?></option>
                                                <?php //} ?>
                                        </select> -->
                                        
                                            <!-- <input type="hidden" id="saveCompanySignatureDB1aM_web2" name="primary_representative_approval_signature1aM_web"> -->
                                            <div id="primary_representative_div"></div>

                                    </div>
                                    <div class="col-md-4">
                                        <h6>Secondary Account Holder</h6><a class="btn btn-danger secondarySignature"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                        <div id="secondaryrep"></div>
                                        <input type="hidden" id="saveSecondaryAccountSignatureDB3a"
                                            name="secondary_account_holder_signature3a">
                                        <br>

                                        <label for="comp_rep_approval">Printed Name</label>
                                        <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                            id="secondery_account_holder_name" placeholder=""/>
                                            <!-- <select class="form-control mb-3" name="secondery_account_holder_name">
                                                <option value="0">Select Name</option>
                                                <?php //foreach($users_lists as $ulist){ ?>
                                                    <option value="<?php //echo $ulist->id ?>"><?php //echo $ulist->FName .' '.$ulist->LName; ?></option>
                                                <?php //} ?>
                                            </select> -->

                                            <!-- <input type="hidden" id="saveCompanySignatureDB1aM_web3" name="secondary_representative_approval_signature1aM_web"> -->
                                            <div id="secondary_representative_div"></div>

                                    </div>
                                </div>
                                <div class="row g-3">
                                    <!-- <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Company Representative Approval</label>
                                        <select class="nsm-field form-select" name="company_representative_printed_name">
                                            <option value="0">Select Name</option>
                                            <?php foreach ($users_lists as $ulist) { ?>
                                                <option <?php if ($ulist->id == logged('id')) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName . ' ' . $ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>

                                        <input type="hidden" id="saveCompanySignatureDB1a" name="company_representative_approval_signature1aM_web">
                                        <div class="d-flex mt-2" id="cra_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 150px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#add_cra_sign_modal">
                                            <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                            <img src="" id="companyrep" class="m-auto d-none">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Primary Account Holder</label>
                                        <input type="text" name="primary_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />
                                        <input type="hidden" id="savePrimaryAccountSignatureDB2a" name="primary_account_holder_signature2a">
                                        <div class="d-flex mt-2" id="pah_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 150px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#add_pah_sign_modal">
                                            <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                            <img src="" id="primaryrep" class="m-auto d-none">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Secondary Account Holder</label>
                                        <input type="text" name="secondery_account_holder_name" class="nsm-field form-control" placeholder="Printed Name" />
                                        <input type="hidden" id="saveSecondaryAccountSignatureDB3a" name="secondary_account_holder_signature3a">
                                        <div class="d-flex mt-2" id="sah_sign_container" role="button" style="border: 1px solid #ced4da; border-radius: 0.25rem; min-height: 150px; padding: 1rem;" data-bs-toggle="modal" data-bs-target="#add_sah_sign_modal">
                                            <span class="m-auto" style="color: #c7c7c7;">Click to add signature</span>
                                            <img src="" id="secondaryrep" class="m-auto d-none">
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Attach Photo</label>
                                        <div class="nsm-img-upload m-auto">
                                            <span class="nsm-upload-label disable-select">Drop or click to upload file</span>
                                            <input type="file" name="attachment_photo" class="nsm-upload">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Attach Document</label>
                                        <div class="nsm-img-upload file-upload m-auto">
                                            <span class="nsm-upload-label disable-select">Drop or click to upload file</span>
                                            <input type="file" name="attachment_document" class="nsm-upload">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="nsm-button" onclick="location.href='<?php echo url('workorder') ?>'">Cancel</button>
                        <button type="button" class="nsm-button">Save Template</button>
                        <button type="submit" class="nsm-button primary">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>

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
                                                <td> Name</td>
                                                <td> Price</td>
                                                <td> Action</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($items as $item){ // print_r($item); ?>
                                                <tr>
                                                    <td><?php echo $item->title; ?></td>                                                
                                                    <td><?php echo $item->price; ?></td>
                                                    <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">Add
                                                    <span class="fa fa-plus"></span>
                                                </button></td>
                                                </tr>
                                                
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php //include viewPath('includes/footer'); ?>

<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<?php include viewPath('v2/includes/footer'); ?>

<script>
    
//     $(document).ready(function() {
// // Replace 'td' with your html tag
// $("#terms_of_use_text").html(function() { 

// // var companyName = $('#company_name').val();
// // var now = new Date();
// // now.setDate(now.getDate()+3);
// // var n=3; //number of days to add. 
// // var t = new Date();
// // t.setDate(t.getDate() + n); 
// // var month = "0"+(t.getMonth()+1);
// // var date = "0"+t.getDate();
// // month = month.slice(-2);
// // date = date.slice(-2);
// // var date = " "+ month +"-"+date +"-"+t.getFullYear();


// // var startDate = "16-APR-2021";
// var startDate = new Date();
// // var daaa = new Date();

// // var date = d.getDate();
// // var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
// // var year = d.getFullYear();
    
// // var startDate = date + "-" + month + "-" + year;

// // startDate = new Date(startDate.replace(/-/g, "/"));
// var endDate = "", noOfDaysToAdd = 3, count = 0;
// while(count < noOfDaysToAdd){
//     endDate = new Date(startDate.setDate(startDate.getDate() + 1));
//     if(endDate.getDay() != 0 && endDate.getDay() != 6){
//     count++;
//     }
// }
// //alert(endDate);
// var month = "0"+(endDate.getMonth()+1);
// var date = "0"+endDate.getDate();
// month = month.slice(-2);
// date = date.slice(-2);
// var date = " "+ month +"-"+date +"-"+endDate.getFullYear();

// // alert(now);  
//   return $(this).html().replace("{current_date_3}", date);  

// });
// });
// </script>
// <script type="text/javascript">
//     $(document).ready(function() {
//         initPopover();

//         $(".select2").select2();

//         $(".datepicker").datepicker({
//             format: 'mm/dd/yyyy',
//             autoclose: true
//         });

//         $("#select_item_list_table").nsmPagination();
//         $("#select_package_item_table").nsmPagination();
//         $("#add_by_group_table").nsmPagination();

//         $("#new_customer_modal").on("shown.bs.modal", function() {
//             $.ajax({
//                 url: "<?= base_url('invoice/new_customer_form') ?>",
//                 type: "GET",
//                 success: function(response) {
//                     $("#new_customer_container").html(response);
//                 },
//             });
//         });

//         $(document).on("change", "input[name=customer_type]", function() {
//             let _this = $(this);

//             if (_this.val() == "Commercial") {
//                 $("#business_name_area").removeClass("d-none");
//             } else {
//                 $("#business_name_area").addClass("d-none");
//             }
//         });

//         $('.number-field').keyup(function() {
//             var val = this.value.replace(/\D/g, '');
//             val = val.replace(/^(\d{3})/, '$1-');
//             val = val.replace(/-(\d{2})/, '-$1-');
//             val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
//             this.value = val;
//         });

//         $("#frm_new_customer").on("submit", function(e) {
//             let _this = $(this);
//             e.preventDefault();

//             var url = "<?php echo base_url('invoice/save_new_customer'); ?>";
//             _this.find("button[type=submit]").html("Saving");
//             _this.find("button[type=submit]").prop("disabled", true);

//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: _this.serialize(),
//                 success: function(result) {
//                     Swal.fire({
//                         title: 'Save Successful!',
//                         text: "New Customer has been added successfully.",
//                         icon: 'success',
//                         showCancelButton: false,
//                         confirmButtonText: 'Okay'
//                     });

//                     $("#new_customer_modal").modal('hide');
//                     _this.trigger("reset");

//                     _this.find("button[type=submit]").html("Save");
//                     _this.find("button[type=submit]").prop("disabled", false);
//                 },
//             });
//         });

//         $("#sel-customer").on("change", function() {
//             let id = $(this).val();

//             $.ajax({
//                 type: 'POST',
//                 url: "<?php echo base_url('accounting/addLocationajax'); ?>",
//                 data: {
//                     id: id
//                 },
//                 dataType: 'json',
//                 success: function(response) {
//                     var phone = response['customer'].phone_h;
//                     var mobile = response['customer'].phone_m;
//                     var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
//                     var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")

//                     $("#job_location").val(response['customer'].mail_add);
//                     $("#email").val(response['customer'].email);
//                     $("#birthdate").val(response['customer'].date_of_birth);
//                     $("#phone_no").val(test_p);
//                     $("#mobile_no").val(test_m);
//                     $("#city").val(response['customer'].city);
//                     $("#state").val(response['customer'].state);
//                     $("#zip").val(response['customer'].zip_code);
//                     $("#cross_street").val(response['customer'].cross_street);
//                     $("#acs_fullname").val(response['customer'].first_name + ' ' + response['customer'].last_name);

//                     $("#job_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

//                     $("#primary_account_holder_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

//                 },
//             });
//         });

//         $("#form_update_header").on("submit", function(e) {
//             let _this = $(this);
//             e.preventDefault();

//             var url = "<?php echo base_url('workorder/save_update_header'); ?>";
//             _this.find("button[type=submit]").html("Saving");
//             _this.find("button[type=submit]").prop("disabled", true);

//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: {
//                     id: $("#update_h_id").val(),
//                     content: CKEDITOR.instances['editor3'].getData()
//                 },
//                 success: function(result) {
//                     Swal.fire({
//                         title: 'Save Successful!',
//                         text: "Header has been updated successfully.",
//                         icon: 'success',
//                         showCancelButton: false,
//                         confirmButtonText: 'Okay'
//                     });

//                     $("#update_header_modal").modal('hide');
//                     _this.trigger("reset");

//                     _this.find("button[type=submit]").html("Save");
//                     _this.find("button[type=submit]").prop("disabled", false);
//                 },
//             });
//         });

//         $(document).on("click", ".btn-edit-field", function() {
//             let _this = $(this);
//             let id = _this.attr("data-id");
//             let name = _this.attr("data-name");
//             let _modal = $("#update_fields_modal");

//             _modal.find(".modal-title").html("Update " + name);
//             _modal.find("#update_custom_id").val(id);
//             _modal.find("#update_custom_name").val(name);
//             _modal.modal("show");
//         });

//         $("#form_update_fields").on("submit", function(e) {
//             let _this = $(this);
//             e.preventDefault();

//             var url = "<?php echo base_url('workorder/save_update_custom_name'); ?>";
//             _this.find("button[type=submit]").html("Saving");
//             _this.find("button[type=submit]").prop("disabled", true);

//             let id = _this.find("#update_custom_id").val();
//             let name = _this.find("#update_custom_name").val();

//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: {
//                     id: id,
//                     name: name,
//                 },
//                 success: function(result) {
//                     Swal.fire({
//                         title: 'Save Successful!',
//                         text: "New field name has been saved successfully.",
//                         icon: 'success',
//                         showCancelButton: false,
//                         confirmButtonText: 'Okay'
//                     });

//                     $("#update_fields_modal").modal('hide');
//                     _this.trigger("reset");

//                     _this.find("button[type=submit]").html("Save");
//                     _this.find("button[type=submit]").prop("disabled", false);
//                 },
//             });
//         });

//         $(document).on("select2:open", ".item-selection", function() {
//             let _this = $(this);
//             $.ajax({
//                 type: 'GET',
//                 url: "<?php echo base_url('items/getitemsV2'); ?>",
//                 success: function(result) {
//                     _this.empty();
//                     _this.html(result);
//                     $(".select2-container--open .select2-search__field")[0].focus();
//                 },
//             });
//         });

//         $(document).on("select2:select", ".item-selection", function() {
//             let _this = $(this);
//             let _selected = _this.find(':selected');

//             _this.closest("tr").find(".price-field").val(_selected.attr("data-price"));
//             _this.closest("tr").find(".discount-field").val(_selected.attr("data-discount"));
//             _this.closest("tr").find(".itemid").val(_selected.attr("data-id"));

//             let counter = _this.closest("tr").find(".price-field").attr("data-counter");
//             calculateTotal(counter);
//         });

//         $(document).on("click", ".remove-item", function() {
//             let _this = $(this);
//             _this.closest("tr").fadeOut(300, function() {
//                 _this.closest("tr").remove();
//             });
//             var count = parseInt($("#count").val()) - 1;
//             $("#count").val(count);
//             calculateTotal(count);
//         });

//         $(document).on("click", ".add-item", function() {
//             let _this = $(this);

//             let id = _this.data("id");
//             let title = _this.data('itemname');
//             let price = _this.data('price');
//             let qty = _this.data('quantity');

//             if (!_this.data('quantity')) {
//                 qty = 0;
//             }

//             let count = parseInt($("#count").val()) + 1;
//             $("#count").val(count);
//             let total_ = price * qty;
//             let tax_ = (parseFloat(total_).toFixed(2) * 7.5) / 100;
//             let taxes_t = parseFloat(tax_).toFixed(2);
//             let total = parseFloat(total_).toFixed(2);
//             let withCommas = Number(total).toLocaleString('en');
//             total = '$' + withCommas + '.00';

//             let _elememt = '<tr>';
//             _elememt += '<td style="width: 100%; max-width: 20%;">';
//             _elememt += '<select class="nsm-field form-select select2 item-selection" name="items[]" id="item_selection_' + count + '">';
//             _elememt += '<option value="' + title + '">' + title + '</option>';
//             _elememt += '</select>';
//             _elememt += '<input type="hidden" name="itemid[]" class="itemid" value="' + id + '">';
//             _elememt += '<input type="hidden" name="packageID[]" value="0">';
//             _elememt += '</td>';
//             _elememt += '<td>';
//             _elememt += '<select class="nsm-field form-select" name="item_type[]" id="item_typeid">';
//             _elememt += '<option value="product">Product</option>';
//             _elememt += '<option value="material">Material</option>';
//             _elememt += '<option value="service">Service</option>';
//             _elememt += '<option value="fee">Fee</option>';
//             _elememt += '</select>';
//             _elememt += '</td>';
//             _elememt += '<td>';
//             _elememt += '<input type="number" name="quantity[]" id="quantity_' + count + '" class="nsm-field form-control quantity-field" value="' + qty + '" data-counter="' + count + '" data-itemid="' + id + '"/>';
//             _elememt += '</td>';
//             _elememt += '<td>';
//             _elememt += '<input type="number" name="price[]" id="price_' + count + '" class="nsm-field form-control price-field" value="' + price + '" data-counter="' + count + '" min="0" data-itemid="' + id + '"/>';
//             _elememt += '<input type="hidden" class="priceqty" id="priceqty_' + id + '" value="' + price + '">';
//             _elememt += '</td>';
//             _elememt += '<td>';
//             _elememt += '<input type="number" name="discount[]" id="discount_' + count + '" class="nsm-field form-control discount-field" value="0" data-counter="' + count + '" min="0" />';
//             _elememt += '</td>';
//             _elememt += '<td>';
//             _elememt += '<input type="text" name="tax[]" id="tax1_' + count + '" class="nsm-field form-control tax-field" value="' + taxes_t + '" data-counter="' + count + '" min="0" readonly data-itemid="' + id + '"/>';
//             _elememt += '</td>';
//             _elememt += '<td>';
//             _elememt += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" data-counter="' + count + '" id="sub_total_text' + count + '" min="0" value="' + total + '">';
//             _elememt += '$<span id="span_total_' + count + '" data-subtotal="' + total_ + '">' + total + '</span>';
//             _elememt += '</td>';
//             _elememt += '<td>';
//             _elememt += '<div class="dropdown table-management">';
//             _elememt += '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">';
//             _elememt += '<i class="bx bx-fw bx-dots-vertical-rounded"></i>';
//             _elememt += '</a>';
//             _elememt += '<ul class="dropdown-menu dropdown-menu-end">';
//             _elememt += '<li>';
//             _elememt += '<a class="dropdown-item remove-item" href="javascript:void(0);" id="' + id + '">Remove</a>';
//             _elememt += '</li>';
//             _elememt += '</ul>';
//             _elememt += '</div>';
//             _elememt += '</td>';
//             _elememt += '</tr>';

//             $("#item_list_table").append(_elememt);
//             $("#item_selection_" + count).select2();
//             calculateTotal(count);
//         });

//         $(document).on("click", ".add-group", function() {
//             let _this = $(this);

//             let id = _this.data("id");
//             let title = _this.data('itemname');
//             let price = _this.data('price');
//             let qty = _this.data('quantity');

//             if (!_this.data('quantity')) {
//                 qty = 0;
//             }

//             $.ajax({
//                 type: 'POST',
//                 url: "<?php echo base_url('workorder/select_package'); ?>",
//                 data: {
//                     idd: id
//                 },
//                 dataType: 'json',
//                 success: function(result) {
//                     let inputs = "";
//                     $.each(result['items'], function(i, v) {
//                         inputs += v.title;
//                         let total_pu = v.price * v.units;
//                         let total_tax = (v.price * v.units) * 7.5 / 100;
//                         let total_temp = total_pu + total_tax;
//                         let total = total_temp.toFixed(2);

//                         let _elememt = '<tr>';
//                         _elememt += '<td style="width: 100%; max-width: 20%;">';
//                         _elememt += '<select class="nsm-field form-select select2 item-selection" name="items[]" id="item_selection_' + v.id + '">';
//                         _elememt += '<option value="' + v.title + '">' + v.title + '</option>';
//                         _elememt += '</select>';
//                         _elememt += '<input type="hidden" name="itemid[]" class="itemid" value="' + v.id + '">';
//                         _elememt += '<input type="hidden" name="packageID[]" value="0">';
//                         _elememt += '</td>';
//                         _elememt += '<td>';
//                         _elememt += '<select class="nsm-field form-select" name="item_type[]" id="item_typeid">';
//                         _elememt += '<option value="product">Product</option>';
//                         _elememt += '<option value="material">Material</option>';
//                         _elememt += '<option value="service">Service</option>';
//                         _elememt += '<option value="fee">Fee</option>';
//                         _elememt += '</select>';
//                         _elememt += '</td>';
//                         _elememt += '<td>';
//                         _elememt += '<input type="number" name="quantity[]" id="quantity_' + v.id + '" class="nsm-field form-control quantity-field" value="' + v.units + '" data-counter="' + v.id + '" data-itemid="' + v.id + '"/>';
//                         _elememt += '</td>';
//                         _elememt += '<td>';
//                         _elememt += '<input type="number" name="price[]" id="price_' + v.id + '" class="nsm-field form-control price-field" value="' + v.price + '" data-counter="' + v.id + '" min="0" data-itemid="' + v.id + '"/>';
//                         _elememt += '<input type="hidden" class="priceqty" id="priceqty_' + v.id + '" value="' + total_pu + '">';
//                         _elememt += '</td>';
//                         _elememt += '<td>';
//                         _elememt += '<input type="number" name="discount[]" id="discount_' + v.id + '" class="nsm-field form-control discount-field" value="0" data-counter="' + v.id + '" min="0" />';
//                         _elememt += '</td>';
//                         _elememt += '<td>';
//                         _elememt += '<input type="text" name="tax[]" id="tax1_' + v.id + '" class="nsm-field form-control tax-field" value="' + total_tax + '" data-counter="' + v.id + '" min="0" readonly data-itemid="' + v.id + '"/>';
//                         _elememt += '</td>';
//                         _elememt += '<td>';
//                         _elememt += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" data-counter="' + v.id + '" id="sub_total_text' + v.id + '" min="0" value="' + total + '">';
//                         _elememt += '$<span id="span_total_' + v.id + '" data-subtotal="' + total + '">' + total + '</span>';
//                         _elememt += '</td>';
//                         _elememt += '<td>';
//                         _elememt += '<div class="dropdown table-management">';
//                         _elememt += '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">';
//                         _elememt += '<i class="bx bx-fw bx-dots-vertical-rounded"></i>';
//                         _elememt += '</a>';
//                         _elememt += '<ul class="dropdown-menu dropdown-menu-end">';
//                         _elememt += '<li>';
//                         _elememt += '<a class="dropdown-item remove-item" href="javascript:void(0);" id="' + v.id + '">Remove</a>';
//                         _elememt += '</li>';
//                         _elememt += '</ul>';
//                         _elememt += '</div>';
//                         _elememt += '</td>';
//                         _elememt += '</tr>';

//                         $("#item_list_table").append(_elememt);
//                         $("#item_selection_" + v.id).select2();
//                     });

//                     var in_id = id;
//                     var price = $("#price_" + in_id).val();
//                     var quantity = $("#quantity_" + in_id).val();
//                     var discount = $("#discount_" + in_id).val();
//                     var tax = (parseFloat(price) * 7.5) / 100;
//                     var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
//                         2
//                     );
//                     if (discount == '') {
//                         discount = 0;
//                     }

//                     var total = (
//                         (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
//                         parseFloat(discount)
//                     ).toFixed(2);

//                     var total_wo_tax = price * quantity;

//                     $("#priceqty_" + in_id).val(total_wo_tax);
//                     $("#span_total_" + in_id).text(total);
//                     $("#sub_total_text" + in_id).val(total);
//                     $("#tax_1_" + in_id).text(tax1);
//                     $("#tax1_" + in_id).val(tax1);
//                     $("#discount_" + in_id).val(discount);

//                     if ($('#tax_1_' + in_id).length) {
//                         $('#tax_1_' + in_id).val(tax1);
//                     }

//                     if ($('#item_total_' + in_id).length) {
//                         $('#item_total_' + in_id).val(total);
//                     }

//                     var eqpt_cost = 0;
//                     var total_costs = 0;
//                     var cnt = $("#count").val();
//                     var total_discount = 0;
//                     var pquantity = 0;
//                     for (var p = 0; p <= cnt; p++) {
//                         var prc = $("#price_" + p).val();
//                         var quantity = $("#quantity_" + p).val();
//                         var discount = $("#discount_" + p).val();
//                         var pqty = $("#priceqty_" + p).val();
//                         pquantity += parseFloat(pqty);
//                         total_costs += parseFloat(prc);
//                         eqpt_cost += parseFloat(prc) * parseFloat(quantity);
//                         total_discount += parseFloat(discount);
//                     }

//                     var total_cost = 0;
//                     $('*[id^="price_"]').each(function() {
//                         total_cost += parseFloat($(this).val());
//                     });

//                     var tax_tot = 0;
//                     $('*[id^="tax1_"]').each(function() {
//                         tax_tot += parseFloat($(this).val());
//                     });

//                     over_tax = parseFloat(tax_tot).toFixed(2);

//                     $("#sales_taxs").val(over_tax);
//                     $("#total_tax_input").val(over_tax);
//                     $("#total_tax_").text(over_tax);


//                     eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
//                     total_discount = parseFloat(total_discount).toFixed(2);
//                     stotal_cost = parseFloat(total_cost).toFixed(2);
//                     priceqty = parseFloat(pquantity).toFixed(2);

//                     var subtotal = 0;
//                     $('*[id^="span_total_"]').each(function() {
//                         subtotal += parseFloat($(this).text());
//                     });

//                     var subtotaltax = 0;
//                     $('*[id^="tax_1_"]').each(function() {
//                         subtotaltax += parseFloat($(this).text());
//                     });


//                     var priceqty2 = 0;
//                     $('*[id^="priceqty_"]').each(function() {
//                         priceqty2 += parseFloat($(this).val());
//                     });

//                     $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

//                     $("#eqpt_cost").val(eqpt_cost);
//                     $("#total_discount").val(total_discount);
//                     $("#span_sub_total_0").text(total_discount);
//                     $("#item_total").val(priceqty2.toFixed(2));

//                     var s_total = subtotal.toFixed(2);
//                     var adjustment = $("#adjustment_input").val();
//                     var grand_total = s_total - parseFloat(adjustment);
//                     var markup = $("#markup_input_form").val();
//                     var grand_total_w = grand_total + parseFloat(markup);

//                     $("#grand_total").text(grand_total_w.toFixed(2));
//                     $("#grand_total_input").val(grand_total_w.toFixed(2));
//                     $("#grand_total_inputs").val(grand_total_w.toFixed(2));
//                     $("#payment_amount").val(grand_total_w.toFixed(2));

//                     var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
//                     sls = parseFloat(sls).toFixed(2);
//                     $("#sales_tax").val(sls);
//                 }
//             });
//         });

//         $(document).on("click", ".btn-show-items", function() {
//             let _this = $(this);

//             if (_this.closest("tr").next(".package-subitem").hasClass("d-none")) {
//                 _this.closest("tr").next(".package-subitem").removeClass("d-none");
//             } else {
//                 _this.closest("tr").next(".package-subitem").addClass("d-none");
//             }
//         });

//         $("#package_modal").on("show.bs.modal", function() {
//             getPackageItems();
//         });

//         $(document).on("click", ".add-packaege", function() {
//             let _this = $(this);
//             let id = _this.attr("data-pack-id");

//             $.ajax({
//                 type: 'POST',
//                 url: "<?php echo base_url('workorder/addNewPackageToList'); ?>",
//                 data: {
//                     packId: id
//                 },
//                 dataType: 'json',
//                 success: function(response) {
//                     console.log(response);
//                     let randNumber = 1 + Math.floor(Math.random() * 99999);

//                     $.each(response['pName'], function(a, b) {
//                         var pName = b.name;
//                         var rNumber = Math.floor(Math.random() * (9999 - 10000 + 1) + 100);

//                         let _element = '<tr>';
//                         _element += '<td class="fw-bold nsm-text-primary" colspan="6" style="border-bottom: 0px;">' + pName;
//                         _element += '<input type="hidden" id="priceqty_' + rNumber + '" value="' + b.amount_set + '">';
//                         _element += '<input type="hidden" name="itemid[]" value="0">';
//                         _element += '<input type="hidden" name="packageID[]" value="' + b.id + '">';
//                         _element += '<input type="hidden" name="quantity[]" value="1">';
//                         _element += '<input type="hidden" name="price[]" value="' + b.amount_set + '">';
//                         _element += '<input type="hidden" name="tax[]" value="0">';
//                         _element += '<input type="hidden" name="discount[]" value="0">';
//                         _element += '</td>';
//                         _element += '<td colspan="2" style="border-bottom: 0px;">';
//                         _element += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" id="sub_total_text' + rNumber + '" value="' + b.amount_set + '">';
//                         _element += '$<span data-subtotal="' + b.amount_set + '" id="span_total_' + rNumber + '">' + b.amount_set + '</span>';
//                         _element += '</td>';
//                         _element += '</tr>';

//                         $("#item_list_table").append(_element);
//                     });

//                     $.each(response['details'], function(i, v) {
//                         _element = '<tr>';
//                         _element += '<td colspan="2">' + v.title + '</td>';
//                         _element += '<td>' + v.quantity + '</td>';
//                         _element += '<td>' + v.price + '</td>';
//                         _element += '<td colspan="4"></td>';
//                         _element += '</tr>';
//                         $("#item_list_table").append(_element);
//                     });

//                     var priceqty2 = 0;
//                     $('*[id^="priceqty_"]').each(function() {
//                         priceqty2 += parseFloat($(this).val());
//                     });
//                     $("#item_total").val(priceqty2.toFixed(2));
//                     $("#span_sub_total_invoice").text(priceqty2.toFixed(2));


//                     var subtotal = 0;
//                     $('*[id^="span_total_"]').each(function() {
//                         subtotal += parseFloat($(this).text());
//                     });
//                     var s_total = subtotal.toFixed(2);
//                     var adjustment = $("#adjustment_input").val();
//                     var grand_total = s_total - parseFloat(adjustment);
//                     var markup = $("#markup_input_form").val();
//                     var grand_total_w = grand_total + parseFloat(markup);
//                     $("#grand_total_inputs").val(grand_total_w.toFixed(2));
//                     $("#grand_total").text(grand_total_w.toFixed(2));
//                     $("#grand_total_input").val(grand_total_w.toFixed(2));
//                     $("#payment_amount").val(grand_total_w.toFixed(2));

//                     console.log(grand_total, );
//                 }
//             });

//             $("#package_modal").modal("hide");
//         });

//         $(document).on("click", ".select-package-item", function() {
//             let _this = $(this);
//             let id = _this.attr("data-id");
//             let title = _this.attr("data-itemname");
//             let price = _this.attr("data-price");
//             let quantity = _this.attr("data-quantity");

//             if (!_this.attr("data-quantity")) {
//                 quantity = 0;
//             }

//             var count = parseInt($("#count").val()) + 1;
//             $("#count").val(count);
//             var total_ = price * quantity;
//             var tax_ = (parseFloat(total_).toFixed(2) * 7.5) / 100;
//             var taxes_t = parseFloat(tax_).toFixed(2);
//             var total = parseFloat(total_).toFixed(2);
//             var withCommas = Number(total).toLocaleString('en');
//             total = '$' + withCommas + '.00';

//             let _element = '<tr>';
//             _element += '<td style="width: 35%">';
//             _element += '<input type="text" class="nsm-field form-control" name="items[]" value="' + title + '"/>';
//             _element += '<input type="hidden" class="nsm-field form-control" name="item_id[]" value="' + id + '"/>';
//             _element += '<input type="hidden" class="nsm-field form-control" name="itemidPackage[]" value="' + id + '"/>';
//             _element += '</td>';
//             _element += '<td style="width: 30%">';
//             _element += '<select class="nsm-field form-select" name="item_typePackage[]">';
//             _element += '<option value="product">Product</option>';
//             _element += '<option value="material">Material</option>';
//             _element += '<option value="service">Service</option>';
//             _element += '<option value="fee">Fee</option>';
//             _element += '</select>';
//             _element += '</td>';
//             _element += '<td style="width: 15%">';
//             _element += '<input type="number" class="nsm-field form-control" name="quantityPackage[]" id="quantity_package_' + id + '" value="' + quantity + '" data-itemid="' + id + '" data-counter="0" min="0"/>';
//             _element += '</td>';
//             _element += '<td style="width: 15%">';
//             _element += '<input type="number" class="nsm-field form-control" name="pricePackage[]" id="price_package_' + id + '" value="' + price + '" data-itemid="' + id + '"/>';
//             _element += '<input type="hidden" class="nsm-field form-control" id="priceqtypackage_' + id + '" value="' + total_ + '"/>';
//             _element += '</td>';
//             _element += '<td>';
//             _element += '<div class="dropdown table-management">';
//             _element += '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">';
//             _element += '<i class="bx bx-fw bx-dots-vertical-rounded"></i>';
//             _element += '</a>';
//             _element += '<ul class="dropdown-menu dropdown-menu-end">';
//             _element += '<li>';
//             _element += '<a class="dropdown-item remove-package-item" href="javascript:void(0);" id="' + id + '">Remove</a>';
//             _element += '</li>';
//             _element += '</ul>';
//             _element += '</div>';
//             _element += '</td>';
//             _element += '</tr>';

//             $("#new_package_items").find(".empty-placeholder").addClass("d-none");
//             $("#new_package_items").append(_element);

//             var total_cost = 0;
//             $('*[id^="priceqtypackage_"]').each(function() {
//                 total_cost += parseFloat($(this).val());
//             });

//             $("#package_price").val(total_cost.toFixed(2));
//         });

//         $(document).on("click", ".remove-package-item", function() {
//             let _this = $(this);
//             _this.closest("tr").fadeOut(300, function() {
//                 _this.closest("tr").remove();
//                 var total_cost = 0;
//                 $('*[id^="priceqtypackage_"]').each(function() {
//                     total_cost += parseFloat($(this).val());
//                 });

//                 $("#package_price").val(total_cost.toFixed(2));

//                 if ($("#new_package_items").children("tr:not(.empty-placeholder)").length == 0) {
//                     $("#new_package_items .empty-placeholder").removeClass("d-none");
//                 }
//             });
//         });

//         $("#btn_create_package").on("click", function() {
//             let item = $('input[name="itemidPackage[]"]').map(function() {
//                 return this.value;
//             }).get();

//             let type = $('input[name="item_typePackage[]"]').map(function() {
//                 return this.value;
//             }).get();

//             let quantity = $('input[name="quantityPackage[]"]').map(function() {
//                 return this.value;
//             }).get();

//             let price = $('input[name="pricePackage[]"]').map(function() {
//                 return this.value;
//             }).get();

//             let package_name = $("#package_name").val();
//             let package_price = $("#package_price").val();
//             let package_price_set = $("#package_price_set").val();

//             $.ajax({
//                 type: 'POST',
//                 url: "<?php echo base_url('workorder/createPackage'); ?>",
//                 data: {
//                     item: item,
//                     type: type,
//                     quantity: quantity,
//                     price: price,
//                     package_price: package_price,
//                     package_name: package_name,
//                     package_price_set: package_price_set
//                 },
//                 dataType: 'json',
//                 success: function(response) {
//                     let randNumber = 1 + Math.floor(Math.random() * 99999);

//                     $.each(response['pName'], function(a, b) {
//                         let pName = b.name;
//                         let rNumber = Math.floor(Math.random() * (9999 - 10000 + 1) + 100);

//                         let _element = '<tr>';
//                         _element += '<td class="fw-bold nsm-text-primary" colspan="6" style="border-bottom: 0px;">' + pName;
//                         _element += '<input type="hidden" id="priceqty_' + rNumber + '" value="' + b.amount_set + '">';
//                         _element += '<input type="hidden" name="itemid[]" value="0">';
//                         _element += '<input type="hidden" name="packageID[]" value="' + b.id + '">';
//                         _element += '<input type="hidden" name="quantity[]" value="1">';
//                         _element += '<input type="hidden" name="price[]" value="' + b.amount_set + '">';
//                         _element += '<input type="hidden" name="tax[]" value="0">';
//                         _element += '<input type="hidden" name="discount[]" value="0">';
//                         _element += '</td>';
//                         _element += '<td colspan="2" style="border-bottom: 0px;">';
//                         _element += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" id="sub_total_text' + rNumber + '" value="' + b.amount_set + '">';
//                         _element += '$<span data-subtotal="' + b.amount_set + '" id="span_total_' + rNumber + '">' + b.amount_set + '</span>';
//                         _element += '</td>';
//                         _element += '</tr>';

//                         $("#item_list_table").append(_element);
//                     });

//                     $.each(response['details'], function(i, v) {
//                         _element = '<tr>';
//                         _element += '<td colspan="2">' + v.title + '</td>';
//                         _element += '<td>' + v.quantity + '</td>';
//                         _element += '<td>' + v.price + '</td>';
//                         _element += '<td colspan="4"></td>';
//                         _element += '</tr>';
//                         $("#item_list_table").append(_element);
//                     });

//                     var priceqty2 = 0;
//                     $('*[id^="priceqty_"]').each(function() {
//                         priceqty2 += parseFloat($(this).val());
//                     });
//                     $("#item_total").val(priceqty2.toFixed(2));
//                     $("#span_sub_total_invoice").text(priceqty2.toFixed(2));


//                     var subtotal = 0;
//                     // $("#span_total_0").each(function(){
//                     $('*[id^="span_total_"]').each(function() {
//                         subtotal += parseFloat($(this).text());
//                     });
//                     var s_total = subtotal.toFixed(2);
//                     var adjustment = $("#adjustment_input").val();
//                     var grand_total = s_total - parseFloat(adjustment);
//                     var markup = $("#markup_input_form").val();
//                     var grand_total_w = grand_total + parseFloat(markup);
//                     $("#grand_total_inputs").val(grand_total_w.toFixed(2));
//                     $("#grand_total").text(grand_total_w.toFixed(2));
//                     $("#grand_total_input").val(grand_total_w.toFixed(2));
//                     $("#payment_amount").val(grand_total_w.toFixed(2));
//                 }
//             });

//             $("#package_modal").modal("hide");
//             $("#package_name").val('');
//             $("#new_package_items").children("tr:not(.empty-placeholder)").remove();
//             $("#new_package_items .empty-placeholder").removeClass("d-none");
//             $("#package_price").val('');
//             $("#package_price_set").val('');
//         });

//         $("#btn_validate_offer").on("click", function() {
//             let offerCode = $("#offer_code").val();

//             $.ajax({
//                 type: 'POST',
//                 url: "<?php echo base_url('accounting/findoffercode'); ?>",
//                 data: {
//                     offer_code: offerCode
//                 },
//                 dataType: 'json',
//                 success: function(response) {
//                     if (response != null) {
//                         var cost = response['offer'].cost;
//                         $("#offer_cost").text('- $' + response['offer'].cost);
//                         $("#offer_cost").val(response['offer'].cost);

//                         var grand = $("#grand_total_input").val();
//                         var new_grand = grand - parseFloat(cost);

//                         $("#grand_total").text(new_grand.toFixed(2));
//                         $("#grand_total_input").val(new_grand.toFixed(2));
//                         $("#payment_amount").val(new_grand.toFixed(2));
//                         $('.saved-field').removeClass("d-none");
//                     } else {
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Error!',
//                             html: "Invalid code."
//                         });
//                     }

//                 },
//                 error: function(response) {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error!',
//                         html: "Invalid code."
//                     });

//                     $("#offer_cost").text('0');
//                     $("#offer_cost").val('0');

//                     var total1 = $("#span_sub_total_invoice").text();
//                     var total2 = $("#adjustment_input").val();

//                     var total3 = parseFloat(total1) - parseFloat(total2);
//                     $("#grand_total").text(total3.toFixed(2));
//                     $("#grand_total_input").val(total3.toFixed(2));
//                     $("#payment_amount").val(total3.toFixed(2));
//                 }
//             });
//         });

//         $("#btn_add_checklist").on("click", function() {
//             $('input.checklist-box:checked').each(function() {
//                 var id = this.value;

//                 $.ajax({
//                     type: "POST",
//                     url: "<?php echo base_url(); ?>workorder/getchecklistdetailsajax",
//                     dataType: "json",
//                     data: {
//                         id: id
//                     },
//                     success: function(response) {
//                         $("#select_checklist_modal").modal('hide');

//                         var current_row = $('.selected-checklists li').length + 1;
//                         var input_hidden = '<input type="hidden" name="checklists[]" value="' + response['checklists'][0].id + '" />';
//                         var check = '<li id="s-checklist-' + current_row + '" class="view-details" c_id="' + response['checklists'][0].id + '">' + response['checklists'][0].checklist_name + ' <a class="remove-checklist" data-row="' + current_row + '" href="javascript:void(0);">Remove</a>' + input_hidden + '</li>';
//                         $(".selected-checklists").append(check);

//                         var cID = response['checklists'][0].id;

//                         $('.view-details').each(function(e) {
//                             $(this).on('mouseover', function() {
//                                 var id = this.id;
//                                 var userid = $(this).attr('c_id');
//                             });
//                         });

//                         $.ajax({
//                             type: "POST",
//                             url: "<?php echo base_url('workorder/getchecklistitemsajax'); ?>",
//                             dataType: "json",
//                             data: {
//                                 cID: cID
//                             },
//                             success: function(result) {},
//                             error: function(result) {
//                                 console.log('Error' + result);
//                             }

//                         });
//                     }
//                 });
//             });
//         });

//         $("#form_update_termscon").on("submit", function(e) {
//             let _this = $(this);
//             e.preventDefault();

//             var url = "<?php echo base_url('workorder/save_update_tc'); ?>";
//             _this.find("button[type=submit]").html("Saving");
//             _this.find("button[type=submit]").prop("disabled", true);

//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: {
//                     id: $("#update_tc_id").val(),
//                     content: CKEDITOR.instances['editor3'].getData()
//                 },
//                 success: function(result) {
//                     Swal.fire({
//                         title: 'Save Successful!',
//                         text: "Terms and Condition has been updated successfully.",
//                         icon: 'success',
//                         showCancelButton: false,
//                         confirmButtonText: 'Okay'
//                     });

//                     $("#update_termscon_modal").modal('hide');
//                     $("#terms_and_condition_text").html(CKEDITOR.instances['editor3'].getData());
//                     _this.trigger("reset");

//                     _this.find("button[type=submit]").html("Save");
//                     _this.find("button[type=submit]").prop("disabled", false);
//                 },
//             });
//         });

//         $("#form_update_termsuse").on("submit", function(e) {
//             let _this = $(this);
//             e.preventDefault();

//             var url = "<?php echo base_url('workorder/save_update_tu'); ?>";
//             _this.find("button[type=submit]").html("Saving");
//             _this.find("button[type=submit]").prop("disabled", true);

//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: {
//                     id: $('#update_tu_id').val(),
//                     content: CKEDITOR.instances['editor2'].getData()
//                 },
//                 success: function(result) {
//                     Swal.fire({
//                         title: 'Save Successful!',
//                         text: "Terms of Use has been updated successfully.",
//                         icon: 'success',
//                         showCancelButton: false,
//                         confirmButtonText: 'Okay'
//                     });

//                     $("#update_termsuse_modal").modal('hide');
//                     $("#terms_of_use_text").html(CKEDITOR.instances['editor2'].getData());
//                     _this.trigger("reset");

//                     _this.find("button[type=submit]").html("Save");
//                     _this.find("button[type=submit]").prop("disabled", false);
//                 },
//             });
//         });

//         var signaturePad;
//         jQuery(document).ready(function() {
//             var signaturePadCanvas = document.querySelector('#canvasb');
//             signaturePad = new SignaturePad(signaturePadCanvas);
//             signaturePadCanvas.height = 300;
//             signaturePadCanvas.width = 680;
//         });

//         $(document).on('click touchstart', '#canvasb', function() {
//             var canvas_web = document.getElementById("canvasb");
//             var dataURL = canvas_web.toDataURL("image/png");
//             $("#saveCompanySignatureDB1a").val(dataURL);
//         });

//         $("#btn_save_cra_signature").on("click", function() {
//             $("#companyrep").attr("src", $("#saveCompanySignatureDB1a").val());
//             $("#companyrep").removeClass("d-none");
//             $("#cra_sign_container").find("span").addClass("d-none");
//             $("#add_cra_sign_modal").modal("hide");
//         });

//         $('#btn_clear_cra_signature').click(function() {
//             $('#cra_sign_area').signaturePad().clearCanvas();
//         });

//         var signaturePad;
//         jQuery(document).ready(function() {
//             var signaturePadCanvas = document.querySelector('#canvas2b');
//             signaturePad = new SignaturePad(signaturePadCanvas);
//             signaturePadCanvas.height = 300;
//             signaturePadCanvas.width = 680;
//         });

//         $(document).on('click touchstart', '#canvas2b', function() {
//             var canvas_web = document.getElementById("canvas2b");
//             var dataURL = canvas_web.toDataURL("image/png");
//             $("#savePrimaryAccountSignatureDB2a").val(dataURL);
//         });

//         $("#btn_save_pah_signature").on("click", function() {
//             $("#primaryrep").attr("src", $("#savePrimaryAccountSignatureDB2a").val());
//             $("#primaryrep").removeClass("d-none");
//             $("#pah_sign_container").find("span").addClass("d-none");
//             $("#add_pah_sign_modal").modal("hide");
//         });

//         $('#btn_clear_pah_signature').click(function() {
//             $('#pah_sign_area').signaturePad().clearCanvas();
//         });

//         var signaturePad;
//         jQuery(document).ready(function() {
//             var signaturePadCanvas = document.querySelector('#canvas3b');
//             signaturePad = new SignaturePad(signaturePadCanvas);
//             signaturePadCanvas.height = 300;
//             signaturePadCanvas.width = 680;
//         });

//         $(document).on('click touchstart', '#canvas3b', function() {
//             var canvas_web = document.getElementById("canvas3b");
//             var dataURL = canvas_web.toDataURL("image/png");
//             $("#saveSecondaryAccountSignatureDB3a").val(dataURL);
//         });

//         $("#btn_save_sah_signature").on("click", function() {
//             $("#secondaryrep").attr("src", $("#saveSecondaryAccountSignatureDB3a").val());
//             $("#secondaryrep").removeClass("d-none");
//             $("#sah_sign_container").find("span").addClass("d-none");
//             $("#add_sah_sign_modal").modal("hide");
//         });

//         $('#btn_clear_sah_signature').click(function() {
//             $('#sah_sign_area').signaturePad().clearCanvas();
//         });

//         $("#payment_method").on("change", function() {
//             let paymentMethod = $(this).val();

//             hideAllPaymentMethods();
//             switch(paymentMethod){
//                 case "Cash":
//                     $("#cash_area").removeClass("d-none");
//                     break;
//                 case "Invoicing":
//                     $("#invoicing").removeClass("d-none");
//                     break;
//                 case "Check":
//                     $("#check_area").removeClass("d-none");
//                     break;
//                 case "Credit Card":
//                     $("#credit_card").removeClass("d-none");
//                     break;
//                 case "Debit Card":
//                     $("#debit_card").removeClass("d-none");
//                     break;
//                 case "ACH":
//                     $("#ach_area").removeClass("d-none");
//                     break;
//                 case "Venmo":
//                     $("#venmo_area").removeClass("d-none");
//                     break;
//                 case "Paypal":
//                     $("#paypal_area").removeClass("d-none");
//                     break;
//                 case "Square":
//                     $("#square_area").removeClass("d-none");
//                     break;
//                 case "Warranty Work":
//                     $("#warranty_area").removeClass("d-none");
//                     break;
//                 case "Home Owner Financing":
//                     $("#home_area").removeClass("d-none");
//                     break;
//                 case "e-Transfer":
//                     $("#e_area").removeClass("d-none");
//                     break;
//                 case "Other Credit Card Professor":
//                     $("#other_credit_card").removeClass("d-none");
//                     break;
//                 case "Other Payment Type":
//                     $("#other_payment_area").removeClass("d-none");
//                     break;
//             }
//         });

//         $("#form_new_workorder").on("submit", function(e) {
//             let _this = $(this);
//             e.preventDefault();

//             var url = "<?php echo base_url('workorder/savenewWorkorder'); ?>";
//             _this.find("button[type=submit]").html("Submitting");
//             _this.find("button[type=submit]").prop("disabled", true);

//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: _this.serialize(),
//                 success: function(result) {
//                     Swal.fire({
//                         title: 'Save Successful!',
//                         text: "Workorder has been saved successfully.",
//                         icon: 'success',
//                         showCancelButton: false,
//                         confirmButtonText: 'Okay'
//                     }).then((result) => {
//                         if (result.value) {
//                             location.reload();
//                         }
//                     });

//                     _this.trigger("reset");

//                     _this.find("button[type=submit]").html("Submit");
//                     _this.find("button[type=submit]").prop("disabled", false);
//                 },
//             });
//         });
//     });

//     function initPopover() {
//         var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
//         var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
//             return new bootstrap.Popover(popoverTriggerEl)
//         })
//     }

//     function calculateTotal(counter) {
//         var price = $("#price_" + counter).val();
//         var quantity = $("#quantity_" + counter).val();
//         var discount = $("#discount_" + counter).val() ?
//             $("#discount_" + counter).val() :
//             0;
//         var tax = (parseFloat(price) * 7.5) / 100;
//         var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
//             2
//         );
//         var total = (
//             (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
//             parseFloat(discount)
//         ).toFixed(2);

//         $("#span_total_" + counter).text(total);
//         $("#total_" + counter).val(total);
//         $("#span_tax_" + counter).text(tax1);
//         $("#tax1_" + counter).val(tax1);

//         if ($('#tax_' + counter).length) {
//             $('#tax_' + counter).val(tax1);
//         }

//         if ($('#item_total_' + counter).length) {
//             $('#item_total_' + counter).val(total);
//         }

//         var eqpt_cost = 0;
//         var subtotal = 0;
//         var adjustment_amount = 0;
//         var cnt = $("#count").val();

//         if (
//             $("#adjustment_input").val() &&
//             $("#adjustment_input").val().toString().length > 1
//         ) {
//             adjustment_amount = $("#adjustment_input").val().substr(1);
//         }
//         for (var p = 0; p <= cnt; p++) {
//             var prc = $("#price_" + p).val();
//             var quantity = $("#quantity_" + p).val();
//             subtotal += parseFloat($("#span_total_" + p).text());
//             eqpt_cost += parseFloat(prc) * parseFloat(quantity);
//         }

//         $("#adjustment_amount").text(parseFloat(adjustment_amount));
//         $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
//         $("#invoice_sub_total").text(subtotal.toFixed(2));
//         $("#sub_total_form_input").val(subtotal.toFixed(2));

//         $("#span_sub_total_0").text(subtotal.toFixed(2));

//         var grandTotal = eval(
//             $("#invoice_sub_total").text() + $("#adjustment_input").val()
//         );
//         $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
//         $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));

//         eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
//         $("#eqpt_cost").val(eqpt_cost);

//         if ($("#grand_total").length && $("#grand_total").val().length) {
//             // console.log('none');
//             // alert('none');
//         } else {
//             $("#grand_total").text(grand_total_w.toFixed(2));
//             $("#grand_total_input").val(grand_total_w.toFixed(2));
//             $("#payment_amount").val(grand_total_w.toFixed(2));

//             var bundle1_total = $("#grand_total").text();
//             var bundle2_total = $("#grand_total2").text();
//             var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
//             $("#supergrandtotal").text(super_grand.toFixed(2));
//             $("#supergrandtotal_input").val(super_grand.toFixed(2));
//         }

//         var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
//         sls = parseFloat(sls).toFixed(2);
//         $("#sales_tax").val(sls);
//     }

//     function getPackageItems() {
//         $.ajax({
//             type: 'POST',
//             url: "<?php echo base_url('workorder/getPackageItemsById'); ?>",
//             dataType: 'json',
//             success: function(response) {
//                 var inputs = "";
//                 $.each(response['pItems'], function(i, v) {
//                     markup = '<td colspan="3">';
//                     markup += '<div class="row">';
//                     markup += '<div class="col-12">';
//                     markup += '<label class="content-subtitle fw-bold me-2">Title:</label>';
//                     markup += '<label class="content-subtitle">' + v.title + '</label>';
//                     markup += '</div>';
//                     markup += '<div class="col-12">';
//                     markup += '<label class="content-subtitle fw-bold me-2">Quantity:</label>';
//                     markup += '<label class="content-subtitle">' + v.quantity + '</label>';
//                     markup += '</div>';
//                     markup += '<div class="col-12">';
//                     markup += '<label class="content-subtitle fw-bold me-2">Price:</label>';
//                     markup += '<label class="content-subtitle">' + v.price + '</label>';
//                     markup += '</div>';
//                     markup += '</div>';
//                     markup += '</td>';
//                     $("#package_subitem_" + v.package_id).html(markup);
//                 });
//             },
//         });
//     }

//     function hideAllPaymentMethods() {
//         $("#cash_area").addClass("d-none");
//         $("#invoicing").addClass("d-none");
//         $("#check_area").addClass("d-none");
//         $("#credit_card").addClass("d-none");
//         $("#debit_card").addClass("d-none");
//         $("#ach_area").addClass("d-none");
//         $("#venmo_area").addClass("d-none");
//         $("#paypal_area").addClass("d-none");
//         $("#square_area").addClass("d-none");
//         $("#warranty_area").addClass("d-none");
//         $("#home_area").addClass("d-none");
//         $("#e_area").addClass("d-none");
//         $("#other_credit_card").addClass("d-none");
//         $("#other_payment_area").addClass("d-none");
//     }
</script>
<script src="<?php echo $url->assets;?>js/jquery-input-mask-phone-number.js"></script>

<script>
// $('.value').on('keydown keyup mousedown mouseup', function() {
//     	 var res = this.value, //grabs the value
//     		 len = res.length, //grabs the length
//     		 max = 9, //sets a max chars
//     		 stars = len>0?len>1?len>2?len>3?len>4?'XXX-XX-':'XXX-X':'XXX-':'XX':'X':'', //this provides the masking and formatting
//     		result = stars+res.substring(5); //this is the result
//     	 $(this).attr('maxlength', max); //setting the max length
//     	$(".number").val(result); //spits the value into the input
//     });

// $('#security_number').keyup(function() {
//     var val = this.value.replace(/\D/g, '');
//     var newVal = '';
//     var sizes = [3, 2, 4];

//     for (var i in sizes) {
//       if (val.length > sizes[i]) {
//         newVal += val.substr(0, sizes[i]) + '-';
//         val = val.substr(sizes[i]);
//       }
//       else
//         break;        
//     }

//     newVal += val;
//     this.value = newVal;
// });

$('#security_number').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{2})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });


// $('#phone_no').keyup(function () {
//     var foo = $(this).val().split("-").join(""); // remove hyphens
//     if (foo.length > 0) {
//         foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
//     }
//     $(this).val(foo);
// });

$('#phone_no').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{3})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });

// $('#mobile_no').keyup(function () {
//     var foo = $(this).val().split("-").join(""); // remove hyphens
//     if (foo.length > 0) {
//         foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
//     }
//     $(this).val(foo);
// });

$('#mobile_no').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{3})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });

</script>

<script>
// $('.enter_signature').click(function(){
//     // alert("nisulod");
//         if(signaturePad.isEmpty()){
//             console.log('it is empty');
//             return false;            
//         }
//     });

var signaturePad;
jQuery(document).ready(function () {
  var signaturePadCanvas = document.querySelector('#canvasb');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad = new SignaturePad(signaturePadCanvas);

//   signaturePadCanvas.width  = 780;
  signaturePadCanvas.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

//   signaturePadCanvas2.width  = 780;
  signaturePadCanvas2.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

//   signaturePadCanvas3.width  = 780;
  signaturePadCanvas3.height = 300;
});


// $(document).on('click touchstart','#sign',function(){
//     // alert('test');
//     var canvas_web = document.getElementById("sign");    
//     var dataURL = canvas_web.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web").val(dataURL);
// });

// $(document).on('click touchstart','#sign2',function(){
//     // alert('test');
//     var canvas_web2 = document.getElementById("sign2");    
//     var dataURL = canvas_web2.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web2").val(dataURL);
// });

// $(document).on('click touchstart','#sign3',function(){
//     // alert('test');
//     var canvas_web3 = document.getElementById("sign3");    
//     var dataURL = canvas_web3.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web3").val(dataURL);
// });

$(document).on('click touchstart','#canvasb',function(){
    // alert('test');
    var canvas_web = document.getElementById("canvasb");    
    // alert(canvas_web);
    var dataURL = canvas_web.toDataURL("image/png");
    $("#saveCompanySignatureDB1aMb").val(dataURL);
});

$(document).on('click touchstart','#canvas2b',function(){
    // alert('test');
    var canvas_web2 = document.getElementById("canvas2b");    
    var dataURL = canvas_web2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aMb").val(dataURL);
});

$(document).on('click touchstart','#canvas3b',function(){
    // alert('test');
    var canvas_web3 = document.getElementById("canvas3b");    
    var dataURL = canvas_web3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aMb").val(dataURL);
});

$(document).on('click touchstart','.companySignature',function(){
    $("#company-representative-approval-signature").modal("show");
});

$(document).on('click touchstart','.primarySignature',function(){
    $("#primary-account-holder-signature").modal("show");
});

$(document).on('click touchstart','.secondarySignature',function(){
    $("#secondary-account-holder-signature").modal("show");
});



$(document).on('click touchstart','.edit_first_signature',function(){
    // alert('test');
    var first = $("#saveCompanySignatureDB1aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web").val(first);

    // $(".img1").hide();

    var input_conf = '<img src="'+first+'">'

    $('#companyrep').html(input_conf);
    
    $('.companySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_second_signature',function(){
    // alert('test');
    var first = $("#savePrimaryAccountSignatureDB2aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web2").val(first);

    // $(".img2").hide();

    var input_conf = '<img src="'+first+'">'

    $('#primaryrep').html(input_conf);

    $('.primarySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_third_signature',function(){
    // alert('test');
    var first = $("#saveSecondaryAccountSignatureDB3aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web3").val(first);

    // $(".img3").hide();

    var input_conf = '<img src="'+first+'">'

    $('#secondaryrep').html(input_conf);

    $('.secondarySignature').modal('hide');
    
});

$(document).on('click','.btn-edit-header',function(){
    //    alert('yeah');
    $('#update_header_modal').modal('show');
});
</script>

<script>
  $( function() {
    $( "#datepicker2" ).datepicker();
  } );
</script>

<script>
// $('.addCreatePackage').on('click', function(){
$(".addCreatePackage").click(function () {
// var item = $("#itemidPackage").val();
var item = $('input[name="itemidPackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var type = $('input[name="item_typePackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var quantity = $('input[name="quantityPackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var price = $('input[name="pricePackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var package_name =  $("#package_name").val();
var package_price =  $("#package_price").val();
var package_price_set =  $("#package_price_set").val();

// console.log('items '+item);
// console.log('type '+type);
// console.log('quantity '+quantity);
// console.log('price '+price);
    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>workorder/createPackage",
        data : {item: item, type:type, quantity:quantity, price:price, package_price:package_price, package_name:package_name, package_price_set:package_price_set },
        dataType: 'json',
        success: function(response){

        // console.log(result);
        var Randnumber = 1 + Math.floor(Math.random() * 99999);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);

                        

                markup = "<tr id=\"ss\">" +
                        // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                        // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                        // "<td>\n" +
                        // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                        // "</td>\n" +
                        "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                        "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+

                        "</tbody></table></div></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                    "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                });
                    
                    var inputs = "";
                        $.each(response['details'], function (i, v) {
                            inputs += v.package_name ;
                            // "<tr>"+
                            // "<td>"+ v.item_id +"</td>"+
                            // "<td>"+ v.quantity +"</td>"+
                            // "<td>"+ v.price +"</td>"+
                            // "</tr>"+
                        // });

                    markup2 = "<tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                            "<td></td>"+
                            "<td>"+ v.title +"</td>"+
                            "<td>"+ v.quantity +"</td>"+
                            "<td>"+ v.price +"</td>"+
                        "</tr>";
                    tableBody2 = $("#packageBody"+Randnumber);
                    tableBody2.append(markup2);

                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });
                $("#item_total").val(priceqty2.toFixed(2));
                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                
                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

        },
    });

    

    $(".createPackage").modal("hide");
    // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('.createPackage').removeData('bs.modal')
    // });
    $("#divcreatePackage").load(" #divcreatePackage");

});
</script>

<script>
$(".addNewPackageToList").click(function () {
    var packId = $(this).attr('pack-id');

    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>workorder/addNewPackageToList",
        data : {packId: packId },
        dataType: 'json',
        success: function(response){

        // console.log(result);
        var Randnumber = 1 + Math.floor(Math.random() * 99999);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);

                        

                markup = "<tr id=\"ss\">" +
                        // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                        // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                        // "<td>\n" +
                        // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                        // "</td>\n" +
                        "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                        "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+

                        "</tbody></table></div></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                    "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                });
                    
                    var inputs = "";
                        $.each(response['details'], function (i, v) {
                            inputs += v.package_name ;
                            // "<tr>"+
                            // "<td>"+ v.item_id +"</td>"+
                            // "<td>"+ v.quantity +"</td>"+
                            // "<td>"+ v.price +"</td>"+
                            // "</tr>"+
                        // });

                    markup2 = "<tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                            "<td></td>"+
                            "<td>"+ v.title +"</td>"+
                            "<td>"+ v.quantity +"</td>"+
                            "<td>"+ v.price +"</td>"+
                        "</tr>";
                    tableBody2 = $("#packageBody"+Randnumber);
                    tableBody2.append(markup2);

                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });
                $("#item_total").val(priceqty2.toFixed(2));
                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                
                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

        },
    });

    $(".createPackage").modal("hide");
    // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('.createPackage').removeData('bs.modal')
    // });
    // $("#divcreatePackage").load(" #divcreatePackage");

});
</script>

<script>
// $("#packageID").click(function () {
$(document).ready(function()
{
    // $( "#packageID" ).each(function(i) {
    //     $(this).on("click", function(){
    //     var packId = $(this).attr('pack-id');
    //     alert(packId);
        $.ajax({
            type : 'POST',
            url : "<?php echo base_url(); ?>workorder/getPackageItemsById",
            // data : {packId: packId },
            dataType: 'json',
            success: function(response){
                var inputs = "";
                $.each(response['pItems'], function (i, v) {
                    // inputs += v.package_name ;
                    markup2 = "<tr>" +
                                "<td></td>"+
                                "<td>"+ v.title +"</td>"+
                                "<td>"+ v.quantity +"</td>"+
                                "<td>"+ v.price +"</td>"+
                            "</tr>";
                        tableBody2 = $("#packageItems"+v.package_id);
                        tableBody2.append(markup2);
                });
            },
        // });
        // });
    });
});
</script>

<script>
// $("#company_representative_approval_signature1aM").on("click touchstart",
//   function () {
//     alert('yeah');
//     var canvas = document.getElementById(
//       "signM"
//     );    
//     var dataURL = canvas.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM").val(dataURL);
//     // console.log(dataURL);
//   }
// );

// $(document).on('click','#signature-padM',function(){
//        alert('yeah');
//     // $('#item_group_type').val();
// });
// var canvas = document.getElementById('canvas');
// var dataURL = canvas.toDataURL("image/png");
// test = $("#saveCompanySignatureDB1aM").val(dataURL);
// // var dataURL = canvas.toDataURL();
// console.log(test);
// jQuery(document).ready(function($){
    
//     var canvas = document.getElementById("canvas");
//     var signaturePad = new SignaturePad(canvas);
//     var dataURL = canvas.toDataURL("image/png");
//     test = $("#saveCompanySignatureDB1aM").val(dataURL);

//     onsole.log(test);
    
//     // $('#clear-signature').on('click', function(){
//     //     signaturePad.clear();
//     // });
    
// });

            $(document).ready(function() {
				// $('#canvas').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
                var canvas = document.getElementById("canvas");    
                var signaturePad = new SignaturePad(canvas);

                var canvas2 = document.getElementById("canvas2");    
                var signaturePad2 = new SignaturePad(canvas2);

                var canvas3 = document.getElementById("canvas3");    
                var signaturePad3 = new SignaturePad(canvas3);

                var canvas_web = document.getElementById("canvas_web");    
                var signaturePad4 = new SignaturePad(canvas_web);

			});

// $("#canvas").on("click touchstart",
//   function () {
//     // alert('yeah');
//     var canvas = document.getElementById(
//       "canvas"
//     );    
//     var signaturePad = new SignaturePad(canvas);
//     var dataURL = canvas.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM").val(dataURL);
//     // console.log(dataURL);
//   }
// );

$("#btnSaveSign").click(function(e){
    var canvas = document.getElementById("canvas");    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);
                        // console.log(dataURL);
						//ajax call to save image inside folder
						// $.ajax({
						// 	url: "<?php echo base_url(); ?>accounting/testSave",
						// 	data: { dataURL : dataURL },
						// 	type: 'post',
						// 	dataType: 'json',
						// 	success: function (response) {
						// 	   alert('success');
						// 	}
						// });

$.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>accounting/testSave",
    data : {dataURL: dataURL},
    success: function(result){
    // $('#res').html('Signature Uploaded successfully');
    console.log(dataURL)
    // location.reload();
    
    },
    });
					
			});


</script>

<script>
// $('.enter_signature').click(function(){
//     // alert("nisulod");
//         if(signaturePad.isEmpty()){
//             console.log('it is empty');
//             return false;            
//         }
//     });

// var signaturePad;
// jQuery(document).ready(function () {
//   var signaturePadCanvas = document.querySelector('#canvas');
// //   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
// //   signaturePadCanvas.setAttribute("width", parentWidth);
//   signaturePad = new SignaturePad(signaturePadCanvas);
// });

// var signaturePad2;
// jQuery(document).ready(function () {
//   var signaturePadCanvas2 = document.querySelector('#canvas2');
// //   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
// //   signaturePadCanvas.setAttribute("width", parentWidth);
//   signaturePad2 = new SignaturePad(signaturePadCanvas2);
// });

// var signaturePad3;
// jQuery(document).ready(function () {
//   var signaturePadCanvas3 = document.querySelector('#canvas3');
// //   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
// //   signaturePadCanvas.setAttribute("width", parentWidth);
//   signaturePad3 = new SignaturePad(signaturePadCanvas3);
// });

// // web
// var signaturePad3;
// jQuery(document).ready(function () {
//   var signaturePadCanvas4 = document.querySelector('#canvas_web');
// //   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
// //   signaturePadCanvas.setAttribute("width", parentWidth);
//   signaturePad4 = new SignaturePad(signaturePadCanvas4);
// });

// // $( "#canvas_web" ).keypress(function() {
// //   alert('test');
// // });

// $(document).on('click touchstart','#sign',function(){
//     // alert('test');
//     var canvas_web = document.getElementById("sign");    
//     var dataURL = canvas_web.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web").val(dataURL);
// });

// $(document).on('click touchstart','#sign2',function(){
//     // alert('test');
//     var canvas_web2 = document.getElementById("sign2");    
//     var dataURL = canvas_web2.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web2").val(dataURL);
// });

// $(document).on('click touchstart','#sign3',function(){
//     // alert('test');
//     var canvas_web3 = document.getElementById("sign3");    
//     var dataURL = canvas_web3.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web3").val(dataURL);
// });

function submit() {
//   if (signaturePad.isEmpty() || signaturePad2.isEmpty() || signaturePad3.isEmpty()) {
//     // console.log("Empty!");
//     alert('Please check, you must sign all tab.')
//   }
//   else{
    // sigpad= $("#output-2a").val();
    var canvas = document.getElementById("canvas");    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);

    var canvas2 = document.getElementById("canvas2");    
    var dataURL2 = canvas2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aM").val(dataURL2);

    var canvas3 = document.getElementById("canvas3");    
    var dataURL3 = canvas3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aM").val(dataURL3);

    var input1 = $("#comp_rep_approval1").val();
    var input2 = $("#comp_rep_approval2").val();
    var input3 = $("#comp_rep_approval3").val();
    
    $.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>accounting/testSave",
    data : {dataURL: dataURL, dataURL2: dataURL2, dataURL3: dataURL3},
    success: function(result){
        // $('#res').html('Signature Uploaded successfully');
        alert('Signature Uploaded successfully');
        console.log(dataURL);
        console.log(dataURL2);
        console.log(dataURL3);

        // var image = new Image();
        // image.src = '"' + dataURL + '"';
        // document.body.appendChild(image);

        // var input_conf = '<br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        var input_conf = '<br><div style="border:solid gray 1px;padding:2%;width:400px !important;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        $("#saveCompanySignatureDB1aM_web").val(dataURL);
        $("#saveCompanySignatureDB1aM_web2").val(dataURL2);
        $("#saveCompanySignatureDB1aM_web3").val(dataURL3);

        $("#company_representative_printed_name").val(input1);
        $("#primary_account_holder_name").val(input2);
        $("#secondery_account_holder_name").val(input3);

        $('.signatureArea').html(input_conf);

        $('#signature_mobile').modal('toggle');
        // if (confirm('Some message')) {
        //     alert('Thanks for confirming');
        // } else {
        //     alert('Why did you press cancel? You should have confirmed');
        // }

        // location.reload();
    },
    });
//   }
}
</script>

<script>
$(document).ready(function(){
    if(window.matchMedia("(max-width: 600px)").matches){
        // alert("This is a mobile device.");
        $(document).on("click", ".testing", function () {
            $('.getItems').hide();
            $('#item_typeid').removeClass('form-control');
        });
        $(document).on("click", ".select_item", function () {
            $('.getItems').hide();
        });
    } 
    // else{
    //     $('.getItems_hidden').hide();
    // }
});
</script>

<script>
    $(document).on("focusout", "#one_time", function () {
        var counter = $(this).val();
        var m_monitoring = $("#m_monitoring").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(m_monitoring);
        //  alert(grand_tot);
        var grand = $("#grand_total_input").val(grand_tot.toFixed(2));

        $("#payment_amount").val(grand_tot.toFixed(2));
    });

    $(document).on("focusout", "#m_monitoring", function () {
        var counter = $(this).val();
        // var grand = $("#grand_total_input").val();
        var one_time = $("#one_time").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(one_time);
        //  alert(grand_tot);
        var grand = $("#grand_total_input").val(grand_tot.toFixed(2));
        $("#payment_amount").val(grand_tot.toFixed(2));
    });

    // $(document).on("checked", "#same_as", function () {
    //     alert('yeah');
    // });
    </script>

<script>
// $(document).on('click','.show_mobile_view',function(){
//     //    alert('yeah');
//     $('#update_group').modal('show');
// });
$(document).on('click','.groupChange',function(){
    //    alert('yeah');
    $('#item_group_type').val();
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

<script>
var wrapper = document.getElementById("signature-pad");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad2");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign2'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad3");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign3'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>



<!-- MOBILE AREA -->
<!-- <script>
var wrapper = document.getElementById("signature-padM");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('signM'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad2M");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign2M'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad3M");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign3M'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script> -->



<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
<script>
function initialize() {
          var input = document.getElementById('job_location');
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

<script src="<?php echo $url->assets ?>js/add.js"></script>
<script>
jQuery(document).ready(function () {
    $(document).on('click','#Commercial',function(){
        $('#business_name_area').show();
    });
    $(document).on('click','#customer_type',function(){
        $('#business_name_area').hide();
    });
    $(document).on('click','#advance',function(){
        $('#business_name_area').hide();
    });
});
</script>

<script>

    document.getElementById('mobile_no_').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('phone_no_').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
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
    
</script>

<script>
// var value = $("#headerContent").text();
// if(value.indexOf("agreement") != -1)
// //   alert("true");
// return $(this).text().replace("agreement", "yeahhhhh"); 
// else
//   alert("false");
// $(".headerContent").text(function () {
//     return $(this).text().replace("agreement", "yeahhhhh"); 
// });​​​​​

jQuery(function($){

// Replace 'td' with your html tag
$("#headerContent").html(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).html().replace("{curr_date}", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerID").val(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).val().replace("{curr_date}", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerID").val(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).val().replace("{comp_name}", companyName);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerContent").html(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).html().replace("{comp_name}", companyName);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#thisdiv3").html(function() { 

    // var companyName = $('#company_name').val();
    // var now = new Date();
    // now.setDate(now.getDate()+3);
    // var n=3; //number of days to add. 
    // var t = new Date();
    // t.setDate(t.getDate() + n); 
    // var month = "0"+(t.getMonth()+1);
    // var date = "0"+t.getDate();
    // month = month.slice(-2);
    // date = date.slice(-2);
    // var date = " "+ month +"-"+date +"-"+t.getFullYear();


    // var startDate = "16-APR-2021";
    var startDate = new Date();
    // var daaa = new Date();
    
    // var date = d.getDate();
    // var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
    // var year = d.getFullYear();
        
    // var startDate = date + "-" + month + "-" + year;

    // startDate = new Date(startDate.replace(/-/g, "/"));
    var endDate = "", noOfDaysToAdd = 3, count = 0;
    while(count < noOfDaysToAdd){
        endDate = new Date(startDate.setDate(startDate.getDate() + 1));
        if(endDate.getDay() != 0 && endDate.getDay() != 6){
        count++;
        }
    }
    //alert(endDate);
    var month = "0"+(endDate.getMonth()+1);
    var date = "0"+endDate.getDate();
    month = month.slice(-2);
    date = date.slice(-2);
    var date = " "+ month +"-"+date +"-"+endDate.getFullYear();

// alert(now);  
      return $(this).html().replace("{current_date_3}", date);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#terms_of_use").val(function() { 

    // var companyName = $('#company_name').val();
    // var now = new Date();
    // now.setDate(now.getDate()+3);
    // var n=3; //number of days to add. 
    // var t = new Date();
    // t.setDate(t.getDate() + n); 
    // var month = "0"+(t.getMonth()+1);
    // var date = "0"+t.getDate();
    // month = month.slice(-2);
    // date = date.slice(-2);
    // var date = " "+ month +"-"+date +"-"+t.getFullYear();


    // var startDate = "16-APR-2021";
    var startDate = new Date();
    // var daaa = new Date();
    
    // var date = d.getDate();
    // var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
    // var year = d.getFullYear();
        
    // var startDate = date + "-" + month + "-" + year;

    // startDate = new Date(startDate.replace(/-/g, "/"));
    var endDate = "", noOfDaysToAdd = 3, count = 0;
    while(count < noOfDaysToAdd){
        endDate = new Date(startDate.setDate(startDate.getDate() + 1));
        if(endDate.getDay() != 0 && endDate.getDay() != 6){
        count++;
        }
    }
    //alert(endDate);
    var month = "0"+(endDate.getMonth()+1);
    var date = "0"+endDate.getDate();
    month = month.slice(-2);
    date = date.slice(-2);
    var date = " "+ month +"-"+date +"-"+endDate.getFullYear();

// alert(now);  
      return $(this).val().replace("{current_date_3}", date);  

});
});
</script>

<script>
// var value = $("#headerContent").text();
// if(value.indexOf("agreement") != -1)
// //   alert("true");
// return $(this).text().replace("agreement", "yeahhhhh"); 
// else
//   alert("false");
// $(".headerContent").text(function () {
//     return $(this).text().replace("agreement", "yeahhhhh"); 
// });​​​​​

jQuery(function($){

// Replace 'td' with your html tag
$("#content_input").val(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).val().replace("day", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#content_input").val(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).val().replace("ADI", companyName);  

});
});
</script>

<script>
$(document).on('click','#headerContent',function(){
    //    alert('yeah');
    $('#update_header_modal').modal('show');
});

$(document).on('click','.save_update_header',function(){
    //    alert('yeah');
    var id = $('#update_h_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor3'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_header",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#update_header_modal").modal('hide')
                $('#header_area').load(window.location.href +  ' #header_area');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
});

</script>

<script>
$(document).on('click','.save_terms_and_conditions',function(){
    //    alert('yeah');
    var id = $('#update_tc_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor1'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_tc",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#terms_conditions_modal").modal('hide')
                $('#thisdiv2').load(window.location.href +  ' #thisdiv2');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
        
    });

</script>

<script>
$(document).on('click','.save_terms_of_use',function(){
    //    alert('yeah');
    var id = $('#update_tu_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor2'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_tu",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#terms_use_modal").modal('hide')
                $('#thisdiv3').load(window.location.href +  ' #thisdiv3');
            },
                error: function(response){
                alert('Error'+response);
       
                }
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


    $(document).ready(function () {
        $('#sel-customer').select2();
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it
                .text("<?php echo get_customer_by_id($_GET['customer_id'])->contact_name ?>")) //set a text for show in select
            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>

<script>

$(document).ready(function(){
    $( "#birthdate" ).datepicker({
        format: 'mm/dd/yyyy'
    });
    
    $("#form_new_workorder").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        const $overlay = document.getElementById('overlay');
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "workorder/savenewWorkorder",
            data: form.serialize(), // serializes the form's elements.
            dataType:'json',
            success: function(data) {
                if( data.is_success == 1 ){
                    Swal.fire({
                        //title: 'Connect Successful!',
                        html: "Workorder was successfully created",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.href = base_url + 'workorder';
                        //}
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
            }, beforeSend: function() {
                if ($overlay) $overlay.style.display = "flex";
            }
        });
    });

    $('#sel-customer').change(function(){
    var customer_id  = $(this).val();
        $.ajax({
            type: 'POST',
            url: base_url + "/customer/_get_customer_data",
            data: {customer_id : customer_id },
            dataType: 'json',
            success: function(response){   

            $("#job_location").val(response.mail_add);
            $("#email").val(response.email);
            $("#birthdate").val(response.date_of_birth);
            $("#phone_no").val(response.phone_h);
            $("#mobile_no").val(response.phone_m);
            $('#security_number').val(response.ssn);
            $("#city").val(response.city);
            $("#state").val(response.state);
            $("#zip").val(response.zip_code);
            $("#cross_street").val(response.cross_street);
            $("#acs_fullname").val(response.first_name +' '+ response.last_name);
            $("#business_name").val(response.business_name);
            $("#password").val(response.access_password);

            $("#job_name").val(response.first_name + ' ' + response.last_name);

            $("#primary_account_holder_name").val(response.first_name + ' ' + response.last_name);
        
            },
                error: function(response){

                }
        });

        function normalize(phone) {
            //normalize string and remove all unnecessary characters
            phone = phone.replace(/[^\d]/g, "");

            //check if number length equals to 10
            if (phone.length == 10) {
                //reformat and return phone number
                return phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
            }

            return null;
        }

    });


    $(document).on('click','.setmarkup',function(){
       // alert('yeah');
        var markup_amount = $('#markup_input').val();

        $("#markup_input_form").val(markup_amount);
        $("#span_markup_input_form").text(markup_amount);
        $("#span_markup").text(markup_amount);

        $('#modalSetMarkup').modal('toggle');
    });
});

</script>

<script>
    $(document).on('click', '.remove-checklist', function(){
        var checklist_row_id = $(this).attr('data-row');
        $("#s-checklist-"+checklist_row_id).remove();
    });

    $(document).ready(function(){

        $('.add_checklist_items').click(function(){
            // alert('test');
            $('input[id="checkist_checkbox"]:checked').each(function() {
            // alert(this.value);
            var id = this.value;
            // $("#checklist_added").html(this.value);
            // $("#checklist_modal").modal('hide')

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>workorder/getchecklistdetailsajax",
                dataType:"json",
                data : { id : id },
                success: function(response){

                  //console.log('yeahhhhhhhhhhhhhhh'+response['checklists'][0].checklist_name); 
                  //console.log(response); 

                  $("#checklist_modal").modal('hide')
                //   $("#checklist_added").html(response['checklists'].checklist_name);
                //   $(".business_name").html(response['client'].business_name);
                // var objJSON = JSON.parse(response['checklists'].checklist_name);
                // var inputs = "";
                // $.each(objJSON, function (i, v) {
                //     inputs += response['checklists'].checklist_name;
                // });

                //New Code
                var current_row  = $('.selected-checklists li').length + 1;
                var input_hidden = '<input type="hidden" name="checklists[]" value="'+response['checklists'][0].id+'" />';
                var check = '<li id="s-checklist-'+current_row+'" id="view_details" c_id="'+ response['checklists'][0].id +'">'+response['checklists'][0].checklist_name+' <a class="remove-checklist" data-row="'+current_row+'" href="javascript:void(0);"><i class="fa fa-trash-o icon"></i></a>'+input_hidden+'</li>';
                $(".selected-checklists").append(check);

                //Old code
                //var check = '<ul> <li id="view_details" ><h6>'+ response['checklists'][0].checklist_name +'</h6> </li> </ul>';
                //$("#checklist_added").append(check);

                
                var cID = response['checklists'][0].id;
                // alert(cID);

                
                // initialize tooltip
                $('#view_details').each(function(e){
                // $("#view_details").mouseover(function(){
                // track:true,
                // open: function( event, ui ) {
                    $(this).on('mouseover', function(){
                    var id = this.id;
                    var userid = $(this).attr('c_id');
                    // alert(userid);
                    
                        // $.ajax({
                        //     url:'fetch_details.php',
                        //     type:'post',
                        //     data:{userid:userid},
                        //     success: function(response){
                        //         alert(userid);
                        
                        //     // Setting content option
                        //     //$("#"+id).tooltip('option','content',response);
                        
                        //     }
                        });

                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>workorder/getchecklistitemsajax",
                    dataType:"json",
                    data : { cID : cID },
                    success: function(result){
                        // console.log('aaaaa'+result['citems'][0].item_name); 
                        // $("#citems").append(result['citems'][0].item_name);
                    },
                        error: function(result){
                        alert('Error'+result);
        
                    }

                });

                // $.each(response, function () {
                //     $("#checklist_added").html( this.checklist_name);
                //     // $("#pics_Id").append("<div>" + this.id + "</div>");
                // });


                },
                    error: function(response){
                    alert('Error'+response);
       
                }

              });
            });
        });


    });
</script>


<script>
$(document).ready(function(){

// $('.mytxtc').each(function(){
//     alert($(this).attr('label-id'););
    
// });
// $(".mytxtc").each(function () {

// var label = $(this).text(); // It will get current label text
// alert($(this).text());
// // roomOcc.push(label);

// });
$(function () {
    $('#collected_checkbox').click(function() {
        // alert('yes');
        var actualTime = "";
        $('#collected_checkbox_label').toggleClass("highlight");
    });
});

$('#modal_items_list').DataTable({
    "autoWidth" : false,
    "columnDefs": [
    { width: 540, targets: 0 },
    { width: 100, targets: 0 },
    { width: 100, targets: 0 }
    ],
    "ordering": false,
});

$('.mytxtc').each(function(e){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        // e.preventDefault();
        $(this).on('click', function(){
            var id = $(this).attr('label-id');
            var name = $(this).attr('label-name');
            $('#update_custom_id').val(id);
            $('#update_custom_name').val(name);
            // alert(id);
            // $(document).on("click", "label.mytxt", function () {
                // var txt = $(this).text();
                // $(this).replaceWith("<input class='mytxt'/>");
                // $(this).val(txt);
                // $('.custom_'+id).val(id);
            // });

            
        });

        // $(this).on("click", function () {
        //         var txt = $(this).val();
        //         $(this).replaceWith("<label class='mytxt'></label>");
        //         $(this).text(txt);
        //         $('.custom_'+id).val(txt);
        //     });
    });

$('.saveUpdateCustomField').on('click', function(){
    //   alert('yeah');
      var id = $('#update_custom_id').val();
      var name = $('#update_custom_name').val();

      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_custom_name",
            type: "POST",
            data: {id : id, name : name },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                $("#modalupdateCustom").modal('hide')
                $('#thisdiv').load(window.location.href +  ' #thisdiv');
            }
	    });
  });


});
</script>

<script>

$(document).ready(function(){
 
    $('.validate_offer').click(function(){
    var offer_code  = $("#offer_code").val();
    // alert(offer_code);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/findoffercode",
            data: {offer_code : offer_code },
            dataType: 'json',
            success: function(response){
                // data = response.trim();
                // alert('success');
            // alert(response['offer'].cost);
            if (response != null){   
                var cost = response['offer'].cost;
                $("#offer_cost").text( '- $' + response['offer'].cost);
                $("#offer_cost").val(response['offer'].cost);

                var grand = $("#grand_total_input").val();
                var new_grand = grand - parseFloat(cost);

                $("#grand_total").text(new_grand.toFixed(2));
                $("#grand_total_input").val(new_grand.toFixed(2));
                $("#payment_amount").val(new_grand.toFixed(2));
                // alert('computed');
                $('#saved').show();
                $('.invalid_code').hide();
            }
            else{   
                
                alert('invalid');
            }
        
            },
                error: function(response){
                // alert('Error'+response);
                $('.invalid_code').show();
                $("#offer_cost").text('0');
                $("#offer_cost").val('0');

                var total1 = $("#span_sub_total_invoice").text();
                var total2 = $("#adjustment_input").val();

                var total3  = parseFloat(total1) - parseFloat(total2);
                $("#grand_total").text(total3.toFixed(2));
                $("#grand_total_input").val(total3.toFixed(2));
                $("#payment_amount").val(total3.toFixed(2));
                // var counter = $(this).data("counter");
                // calculation(counter);
       
                }
        });
    });

    function calculation(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val()
    ? $("#discount_" + counter).val()
    : 0;
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  $("#span_total_" + counter).text(total);
  $("#total_" + counter).val(total);
  $("#span_tax_" + counter).text(tax1);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_'+ counter).length ){
    $('#tax_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var subtotal = 0;
  var adjustment_amount = 0;
  var cnt = $("#count").val();

  if (
    $("#adjustment_input").val() &&
    $("#adjustment_input").val().toString().length > 1
  ) {
    adjustment_amount = $("#adjustment_input").val().substr(1);
  }
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    subtotal += parseFloat($("#span_total_" + p).text());
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
  }

  $("#adjustment_amount").text(parseFloat(adjustment_amount));
  $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
  $("#invoice_sub_total").text(subtotal.toFixed(2));
  $("#sub_total_form_input").val(subtotal.toFixed(2));

  $("#span_sub_total_0").text(subtotal.toFixed(2));

  var grandTotal = eval(
    $("#invoice_sub_total").text() + $("#adjustment_input").val()
  );
  $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
  $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  $("#eqpt_cost").val(eqpt_cost);

  // alert('dri');

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));
    $("#payment_amount").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}


});

</script>


<script>
$(document).on("click", "label.mytxt", function () {
        var txt = $(".mytxt").text();
        $(".mytxt").replaceWith("<input class='mytxt'/>");
        $(".mytxt").val(txt);
        $(".custom1").val(txt);
    });

    $(document).on("blur", "input.mytxt", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt'></label>");
        $(".mytxt").text(txt);
        $(".custom1").val(txt);
});
$(document).on("click", "label.mytxt2", function () {
        var txt = $(".mytxt2").text();
        $(".mytxt2").replaceWith("<input class='mytxt2'/>");
        $(".mytxt2").val(txt);
        $(".custom2").val(txt);
    });

    $(document).on("blur", "input.mytxt2", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt2'></label>");
        $(".mytxt2").text(txt);
        $(".custom2").val(txt);
});

$(document).on("click", "label.mytxt3", function () {
        var txt = $(".mytxt3").text();
        $(".mytxt3").replaceWith("<input class='mytxt3'/>");
        $(".mytxt3").val(txt);
        $(".custom3").val(txt);
    });

    $(document).on("blur", "input.mytxt3", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt3'></label>");
        $(".mytxt3").text(txt);
        $(".custom3").val(txt);
});

$(document).on("click", "label.mytxt4", function () {
        var txt = $(".mytxt4").text();
        $(".mytxt4").replaceWith("<input class='mytxt4'/>");
        $(".mytxt4").val(txt);
        $(".custom4").val(txt);
    });

    $(document).on("blur", "input.mytxt4", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt4'></label>");
        $(".mytxt4").text(txt);
        $(".custom4").val(txt);
});

$(document).on("click", "label.mytxt5", function () {
        var txt = $(".mytxt5").text();
        $(".mytxt5").replaceWith("<input class='mytxt5'/>");
        $(".mytxt5").val(txt);
        $(".custom5").val(txt);
    });

    $(document).on("blur", "input.mytxt5", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt5'></label>");
        $(".mytxt5").text(txt);
        $(".custom5").val(txt);
});

$(document).on("click", "label.mytxt6", function () {
        var txt = $(".mytxt6").text();
        $(".mytxt6").replaceWith("<input class='form-control mytxt6' />");
        $(".mytxt6").val(txt);
        $(".custom6").val(txt);
    });

    $(document).on("blur", "input.mytxt6", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='form-control mytxt6'></label>");
        $(".mytxt6").text(txt);
        $(".custom6").val(txt);
});

document.getElementById("payment_method").onchange = function() {
    if (this.value == 'Cash') {
        // alert('cash');
		// $('#exampleModal').modal('toggle');
        $('#cash_area').show();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#invoicing').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    	}
    else if(this.value == 'Invoicing'){

        $('#cash_area').hide();
        $('#check_area').hide();
        $('#invoicing').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
	
    else if(this.value == 'Check'){
        // alert('Check');
        $('#cash_area').hide();
        $('#check_area').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Credit Card'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').show();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Debit Card'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').show();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#invoicing').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'ACH'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').show();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Venmo'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#invoicing').hide();
        $('#venmo_area').show();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Paypal'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').show();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Square'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').show();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Warranty Work'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').show();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Home Owner Financing'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').show();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'e-Transfer'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').show();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Other Credit Card Professor'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').show();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Other Payment Type'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').show();
    }
}
</script>

<script>
$(".select_package").click(function () {
  var idd = this.id;
  console.log(idd);
  console.log($(this).data('itemname'));
  var title = $(this).data('itemname');
  var price = $(this).data('price');

    if(!$(this).data('quantity')){
    // alert($(this).data('quantity'));
    var qty = 0;
  }else{
    // alert('0');
    var qty = $(this).data('quantity');
  }
  

$.ajax({
    type: 'POST',
    url:"<?php echo base_url(); ?>workorder/select_package",
    data: {idd : idd },
    dataType: 'json',
    success: function(response){
        // alert('Successfully Change');
        console.log(response['items']);

        // var objJSON = JSON.parse(response['items'][0].title);
                var inputs = "";
                $.each(response['items'], function (i, v) {
                    inputs += v.title ;
                    var total_pu = v.price * v.units;
                    var total_tax = (v.price * v.units) * 7.5 / 100;
                    var total_temp = total_pu + total_tax;
                    var total = total_temp.toFixed(2);

                    
                  markup = "<tr id=\"ss\">" +
                      "<td width=\"35%\"><input value='"+v.title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+v.id+"' name=\"itemid[]\" id=\"itemid\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+v.title+"</span></div></td>\n" +
                      "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                      "<td width=\"10%\"><input data-itemid='"+v.id+"' id='quantity_"+v.id+"' value='"+v.units+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
                      "<td width=\"10%\"><input id='price_"+v.id+"' value='"+v.price+"'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+v.id+"' value='"+total_pu+"'><div class=\"show_mobile_view\"><span class=\"price\">"+v.price+"</span><input type=\"hidden\" class=\"form-control price\" name=\"price_[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='"+v.price+"'></div></td>\n" +
                    //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                    // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                      "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+v.id+"' value=\"0\"></td>\n" +
                    // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                      "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+v.id+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+v.id+"' min=\"0\" value='"+total_tax+"'></td>\n" +
                      "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total+"' id='span_total_"+v.id+"' class=\"total_per_item\">"+total+
                    // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                      "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+v.id+"' value='"+total+"'></td>" +
                      "<td>\n" +
                        '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                        "</td>\n" +
                      "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                    markup2 = "<tr id=\"sss\">" +
                      "<td >"+v.title+"</td>\n" +
                      "<td ></td>\n" +
                    "<td ></td>\n" +
                    "<td >"+v.price+"</td>\n" +
                    "<td ></td>\n" +
                    "<td >"+v.units+"</td>\n" +
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
                if( discount == '' ){
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

                if( $('#tax_1_'+ in_id).length ){
                $('#tax_1_'+in_id).val(tax1);
                }

                if( $('#item_total_'+ in_id).length ){
                $('#item_total_'+in_id).val(total);
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
                $('*[id^="price_"]').each(function(){
                total_cost += parseFloat($(this).val());
                });

                // var totalcosting = 0;
                // $('*[id^="span_total_"]').each(function(){
                //   totalcosting += parseFloat($(this).val());
                // });


                // alert(total_cost);

                var tax_tot = 0;
                $('*[id^="tax1_"]').each(function(){
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
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                // $('#sum').text(subtotal);

                var subtotaltax = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="tax_1_"]').each(function(){
                subtotaltax += parseFloat($(this).text());
                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
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
                $("#payment_amount").val(grand_total_w.toFixed(2));

                var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
                sls = parseFloat(sls).toFixed(2);
                $("#sales_tax").val(sls);
                cal_total_due();


    },
        error: function(response){
        alert('Error'+response);

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
// $(document).on("click",".pdf_sheet", function(){
//     // window.open(url, '_blank');
//     // alert('yes!');
//     var subjectID = $("#workorder_number").val();
//     // $("#workorder_number").val();view_workorder_number
//     // var session = $("#SessionFrom").val()+"-"+$("#SessionTo").val();
//     // var courseID = $("#classesID").val();
//     // var yearsOrSemester = $("#yearSemesterID").val();
//     // var form = '';
//     // form += '<input type="hidden" name="subjectID" value="' + subjectID + '">';
//     // form += '<input type="hidden" name="session" value="' + session + '">';
//     // form += '<input type="hidden" name="courseID" value="' + courseID + '">';
//     // form += '<input type="hidden" name="yearsOrSemester" value="' + yearsOrSemester+ '">';
//     // form += '</form>';
//     // $('body').append(form);
//     // $('#static_form').submit();
//     $.ajax({
//         type : 'POST',
//         url : "<?php echo base_url(); ?>workorder/preview",
//         // data : {dataURL: dataURL},
//         success: function(result){
//         // $('#res').html('Signature Uploaded successfully');
//         alert('yes');
//         // console.log(dataURL)
//         // location.reload();
        
//         },
//     });


// });
$('#clear').click(function() {
  $('#signArea').signaturePad().clearCanvas();
});

$('#clear2').click(function() {
  $('#signArea2').signaturePad().clearCanvas();
});

$('#clear3').click(function() {
  $('#signArea3').signaturePad().clearCanvas();
});
</script>
<script>
  $( function() {
    $( "#datepicker_dateissued" ).datepicker({
        format: 'mm/dd/yyyy'
    });
  } );

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
</script>
