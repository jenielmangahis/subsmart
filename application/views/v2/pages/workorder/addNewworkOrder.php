<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/workorder/workorder_modals'); ?>

<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/workorder/autosave.js")?>"></script> -->

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

                <?php echo form_open_multipart('workorder/savenewWorkorder', ['class' => 'form-validate', 'id' => 'form_new_workorder', 'autocomplete' => 'off']); ?>
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
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Work Order Number</label>
                                                <input type="text" name="workorder_number" id="workorder-number" class="nsm-field form-control" value="<?= $prefix . $next_num; ?>" readonly required />
                                            </div>
                                            <div class="col-12 col-md-3">
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
                                                        <option value="<?= $c->prof_id; ?>"><?= $c->contact_name . '' . $c->first_name . ' ' . $c->last_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Security Number</label>
                                                <input type="text" name="security_number" id="security_number" class="nsm-field form-control number-field" placeholder="xxx-xx-xxxx" required />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Birth Date</label>
                                                <input type="text" name="birthdate" id="birthdate" class="nsm-field form-control datepicker" required />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                                                <input type="text" name="phone_number" id="phone_no" class="nsm-field form-control number-field" />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                                                <input type="text" name="mobile_number" id="mobile_no" class="nsm-field form-control number-field" />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                                                <input type="email" name="email" id="email" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                                                <input type="text" name="password" id="password" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Job Location</label>
                                                <input type="text" name="job_location" id="job_location" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">City</label>
                                                <input type="text" name="city" id="city" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">State</label>
                                                <input type="text" name="state" id="state" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">Zip code</label>
                                                <input type="text" name="zip_code" id="zip" class="nsm-field form-control" required />
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">Cross Street</label>
                                                <input type="text" name="cross_street" id="cross_street" class="nsm-field form-control" />
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="acs_fullname" id="acs_fullname">
                                                <input type="hidden" name="company_name" id="company_name" value="<?php echo $companyDet->first_name . ' ' . $companyDet->last_name; ?>">
                                                <input type="hidden" name="business_address" id="business_address" value="<?php echo $companyDet->business_address; ?>">
                                                <input type="hidden" name="acs_phone_number" id="acs_phone_number" value="<?php echo $companyDet->phone_number; ?>">
                                                <hr>
                                            </div>

                                            <?php foreach ($fields as $field) { ?>
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
                                                <table class="nsm-table">
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
                                                    </thead>
                                                    <tbody id="item_list_table">
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
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <button type="button" class="nsm-button ms-0" data-bs-toggle="modal" data-bs-target="#add_item_list_modal"><i class='bx bx-fw bx-plus-circle'></i> Add Items</button>
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
                                                        $ <span id="span_sub_total_invoice">0.00</span>
                                                        <input type="hidden" name="subtotal" id="item_total" />
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">Taxes</label>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        $ <span id="total_tax_">0.00</span>
                                                        <input type="hidden" name="taxes" id="total_tax_input" />
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
                                                        $ <span id="grand_total">0.00</span>
                                                        <input type="hidden" name="grand_total" id="grand_total_input" value='0'>
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
                                                        <input type="text" name="schedule_date_given" class="nsm-field form-control datepicker" required />
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
                                                        <label class="content-subtitle fw-bold d-block mb-2">Job Type</label>
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
                                                <input type="text" name="payment_amount" class="nsm-field form-control" required />
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
                                                    <option value="New">Neasw</option>
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
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
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
                                    </div>
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
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url("assets/js/workorder/autosave.js")?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        initPopover();

        $(".select2").select2();

        $(".datepicker").datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        $("#select_item_list_table").nsmPagination();
        $("#select_package_item_table").nsmPagination();
        $("#add_by_group_table").nsmPagination();

        $("#new_customer_modal").on("shown.bs.modal", function() {
            $.ajax({
                url: "<?= base_url('invoice/new_customer_form') ?>",
                type: "GET",
                success: function(response) {
                    $("#new_customer_container").html(response);
                },
            });
        });

        $(document).on("change", "input[name=customer_type]", function() {
            let _this = $(this);

            if (_this.val() == "Commercial") {
                $("#business_name_area").removeClass("d-none");
            } else {
                $("#business_name_area").addClass("d-none");
            }
        });

        $('.number-field').keyup(function() {
            var val = this.value.replace(/\D/g, '');
            val = val.replace(/^(\d{3})/, '$1-');
            val = val.replace(/-(\d{2})/, '-$1-');
            val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
            this.value = val;
        });

        $("#frm_new_customer").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('invoice/save_new_customer'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "New Customer has been added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });

                    $("#new_customer_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#sel-customer").on("change", function() {
            let id = $(this).val();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('accounting/addLocationajax'); ?>",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    var phone = response['customer'].phone_h;
                    var mobile = response['customer'].phone_m;
                    var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
                    var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")

                    $("#job_location").val(response['customer'].mail_add);
                    $("#email").val(response['customer'].email);
                    $("#birthdate").val(response['customer'].date_of_birth);
                    $("#phone_no").val(test_p);
                    $("#mobile_no").val(test_m);
                    $("#city").val(response['customer'].city);
                    $("#state").val(response['customer'].state);
                    $("#zip").val(response['customer'].zip_code);
                    $("#cross_street").val(response['customer'].cross_street);
                    $("#acs_fullname").val(response['customer'].first_name + ' ' + response['customer'].last_name);

                    $("#job_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

                    $("#primary_account_holder_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

                },
            });
        });

        $("#form_update_header").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('workorder/save_update_header'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: $("#update_h_id").val(),
                    content: CKEDITOR.instances['editor3'].getData()
                },
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Header has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });

                    $("#update_header_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".btn-edit-field", function() {
            let _this = $(this);
            let id = _this.attr("data-id");
            let name = _this.attr("data-name");
            let _modal = $("#update_fields_modal");

            _modal.find(".modal-title").html("Update " + name);
            _modal.find("#update_custom_id").val(id);
            _modal.find("#update_custom_name").val(name);
            _modal.modal("show");
        });

        $("#form_update_fields").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('workorder/save_update_custom_name'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            let id = _this.find("#update_custom_id").val();
            let name = _this.find("#update_custom_name").val();

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: id,
                    name: name,
                },
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "New field name has been saved successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });

                    $("#update_fields_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("select2:open", ".item-selection", function() {
            let _this = $(this);
            $.ajax({
                type: 'GET',
                url: "<?php echo base_url('items/getitemsV2'); ?>",
                success: function(result) {
                    _this.empty();
                    _this.html(result);
                    $(".select2-container--open .select2-search__field")[0].focus();
                },
            });
        });

        $(document).on("select2:select", ".item-selection", function() {
            let _this = $(this);
            let _selected = _this.find(':selected');

            _this.closest("tr").find(".price-field").val(_selected.attr("data-price"));
            _this.closest("tr").find(".discount-field").val(_selected.attr("data-discount"));
            _this.closest("tr").find(".itemid").val(_selected.attr("data-id"));

            let counter = _this.closest("tr").find(".price-field").attr("data-counter");
            calculateTotal(counter);
        });

        $(document).on("click", ".remove-item", function() {
            let _this = $(this);
            _this.closest("tr").fadeOut(300, function() {
                _this.closest("tr").remove();
            });
            var count = parseInt($("#count").val()) - 1;
            $("#count").val(count);
            calculateTotal(count);
        });

        $(document).on("click", ".add-item", function() {
            let _this = $(this);

            let id = _this.data("id");
            let title = _this.data('itemname');
            let price = _this.data('price');
            let qty = _this.data('quantity');

            if (!_this.data('quantity')) {
                qty = 0;
            }

            let count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            let total_ = price * qty;
            let tax_ = (parseFloat(total_).toFixed(2) * 7.5) / 100;
            let taxes_t = parseFloat(tax_).toFixed(2);
            let total = parseFloat(total_).toFixed(2);
            let withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';

            let _elememt = '<tr>';
            _elememt += '<td style="width: 100%; max-width: 20%;">';
            _elememt += '<select class="nsm-field form-select select2 item-selection" name="items[]" id="item_selection_' + count + '">';
            _elememt += '<option value="' + title + '">' + title + '</option>';
            _elememt += '</select>';
            _elememt += '<input type="hidden" name="itemid[]" class="itemid" value="' + id + '">';
            _elememt += '<input type="hidden" name="packageID[]" value="0">';
            _elememt += '</td>';
            _elememt += '<td>';
            _elememt += '<select class="nsm-field form-select" name="item_type[]" id="item_typeid">';
            _elememt += '<option value="product">Product</option>';
            _elememt += '<option value="material">Material</option>';
            _elememt += '<option value="service">Service</option>';
            _elememt += '<option value="fee">Fee</option>';
            _elememt += '</select>';
            _elememt += '</td>';
            _elememt += '<td>';
            _elememt += '<input type="number" name="quantity[]" id="quantity_' + count + '" class="nsm-field form-control quantity-field" value="' + qty + '" data-counter="' + count + '" data-itemid="' + id + '"/>';
            _elememt += '</td>';
            _elememt += '<td>';
            _elememt += '<input type="number" name="price[]" id="price_' + count + '" class="nsm-field form-control price-field" value="' + price + '" data-counter="' + count + '" min="0" data-itemid="' + id + '"/>';
            _elememt += '<input type="hidden" class="priceqty" id="priceqty_' + id + '" value="' + price + '">';
            _elememt += '</td>';
            _elememt += '<td>';
            _elememt += '<input type="number" name="discount[]" id="discount_' + count + '" class="nsm-field form-control discount-field" value="0" data-counter="' + count + '" min="0" />';
            _elememt += '</td>';
            _elememt += '<td>';
            _elememt += '<input type="text" name="tax[]" id="tax1_' + count + '" class="nsm-field form-control tax-field" value="' + taxes_t + '" data-counter="' + count + '" min="0" readonly data-itemid="' + id + '"/>';
            _elememt += '</td>';
            _elememt += '<td>';
            _elememt += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" data-counter="' + count + '" id="sub_total_text' + count + '" min="0" value="' + total + '">';
            _elememt += '$<span id="span_total_' + count + '" data-subtotal="' + total_ + '">' + total + '</span>';
            _elememt += '</td>';
            _elememt += '<td>';
            _elememt += '<div class="dropdown table-management">';
            _elememt += '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">';
            _elememt += '<i class="bx bx-fw bx-dots-vertical-rounded"></i>';
            _elememt += '</a>';
            _elememt += '<ul class="dropdown-menu dropdown-menu-end">';
            _elememt += '<li>';
            _elememt += '<a class="dropdown-item remove-item" href="javascript:void(0);" id="' + id + '">Remove</a>';
            _elememt += '</li>';
            _elememt += '</ul>';
            _elememt += '</div>';
            _elememt += '</td>';
            _elememt += '</tr>';

            $("#item_list_table").append(_elememt);
            $("#item_selection_" + count).select2();
            calculateTotal(count);
        });

        $(document).on("click", ".add-group", function() {
            let _this = $(this);

            let id = _this.data("id");
            let title = _this.data('itemname');
            let price = _this.data('price');
            let qty = _this.data('quantity');

            if (!_this.data('quantity')) {
                qty = 0;
            }

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('workorder/select_package'); ?>",
                data: {
                    idd: id
                },
                dataType: 'json',
                success: function(result) {
                    let inputs = "";
                    $.each(result['items'], function(i, v) {
                        inputs += v.title;
                        let total_pu = v.price * v.units;
                        let total_tax = (v.price * v.units) * 7.5 / 100;
                        let total_temp = total_pu + total_tax;
                        let total = total_temp.toFixed(2);

                        let _elememt = '<tr>';
                        _elememt += '<td style="width: 100%; max-width: 20%;">';
                        _elememt += '<select class="nsm-field form-select select2 item-selection" name="items[]" id="item_selection_' + v.id + '">';
                        _elememt += '<option value="' + v.title + '">' + v.title + '</option>';
                        _elememt += '</select>';
                        _elememt += '<input type="hidden" name="itemid[]" class="itemid" value="' + v.id + '">';
                        _elememt += '<input type="hidden" name="packageID[]" value="0">';
                        _elememt += '</td>';
                        _elememt += '<td>';
                        _elememt += '<select class="nsm-field form-select" name="item_type[]" id="item_typeid">';
                        _elememt += '<option value="product">Product</option>';
                        _elememt += '<option value="material">Material</option>';
                        _elememt += '<option value="service">Service</option>';
                        _elememt += '<option value="fee">Fee</option>';
                        _elememt += '</select>';
                        _elememt += '</td>';
                        _elememt += '<td>';
                        _elememt += '<input type="number" name="quantity[]" id="quantity_' + v.id + '" class="nsm-field form-control quantity-field" value="' + v.units + '" data-counter="' + v.id + '" data-itemid="' + v.id + '"/>';
                        _elememt += '</td>';
                        _elememt += '<td>';
                        _elememt += '<input type="number" name="price[]" id="price_' + v.id + '" class="nsm-field form-control price-field" value="' + v.price + '" data-counter="' + v.id + '" min="0" data-itemid="' + v.id + '"/>';
                        _elememt += '<input type="hidden" class="priceqty" id="priceqty_' + v.id + '" value="' + total_pu + '">';
                        _elememt += '</td>';
                        _elememt += '<td>';
                        _elememt += '<input type="number" name="discount[]" id="discount_' + v.id + '" class="nsm-field form-control discount-field" value="0" data-counter="' + v.id + '" min="0" />';
                        _elememt += '</td>';
                        _elememt += '<td>';
                        _elememt += '<input type="text" name="tax[]" id="tax1_' + v.id + '" class="nsm-field form-control tax-field" value="' + total_tax + '" data-counter="' + v.id + '" min="0" readonly data-itemid="' + v.id + '"/>';
                        _elememt += '</td>';
                        _elememt += '<td>';
                        _elememt += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" data-counter="' + v.id + '" id="sub_total_text' + v.id + '" min="0" value="' + total + '">';
                        _elememt += '$<span id="span_total_' + v.id + '" data-subtotal="' + total + '">' + total + '</span>';
                        _elememt += '</td>';
                        _elememt += '<td>';
                        _elememt += '<div class="dropdown table-management">';
                        _elememt += '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">';
                        _elememt += '<i class="bx bx-fw bx-dots-vertical-rounded"></i>';
                        _elememt += '</a>';
                        _elememt += '<ul class="dropdown-menu dropdown-menu-end">';
                        _elememt += '<li>';
                        _elememt += '<a class="dropdown-item remove-item" href="javascript:void(0);" id="' + v.id + '">Remove</a>';
                        _elememt += '</li>';
                        _elememt += '</ul>';
                        _elememt += '</div>';
                        _elememt += '</td>';
                        _elememt += '</tr>';

                        $("#item_list_table").append(_elememt);
                        $("#item_selection_" + v.id).select2();
                    });

                    var in_id = id;
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
                        pquantity += parseFloat(pqty);
                        total_costs += parseFloat(prc);
                        eqpt_cost += parseFloat(prc) * parseFloat(quantity);
                        total_discount += parseFloat(discount);
                    }

                    var total_cost = 0;
                    $('*[id^="price_"]').each(function() {
                        total_cost += parseFloat($(this).val());
                    });

                    var tax_tot = 0;
                    $('*[id^="tax1_"]').each(function() {
                        tax_tot += parseFloat($(this).val());
                    });

                    over_tax = parseFloat(tax_tot).toFixed(2);

                    $("#sales_taxs").val(over_tax);
                    $("#total_tax_input").val(over_tax);
                    $("#total_tax_").text(over_tax);


                    eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
                    total_discount = parseFloat(total_discount).toFixed(2);
                    stotal_cost = parseFloat(total_cost).toFixed(2);
                    priceqty = parseFloat(pquantity).toFixed(2);

                    var subtotal = 0;
                    $('*[id^="span_total_"]').each(function() {
                        subtotal += parseFloat($(this).text());
                    });

                    var subtotaltax = 0;
                    $('*[id^="tax_1_"]').each(function() {
                        subtotaltax += parseFloat($(this).text());
                    });


                    var priceqty2 = 0;
                    $('*[id^="priceqty_"]').each(function() {
                        priceqty2 += parseFloat($(this).val());
                    });

                    $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                    $("#eqpt_cost").val(eqpt_cost);
                    $("#total_discount").val(total_discount);
                    $("#span_sub_total_0").text(total_discount);
                    $("#item_total").val(priceqty2.toFixed(2));

                    var s_total = subtotal.toFixed(2);
                    var adjustment = $("#adjustment_input").val();
                    var grand_total = s_total - parseFloat(adjustment);
                    var markup = $("#markup_input_form").val();
                    var grand_total_w = grand_total + parseFloat(markup);

                    $("#grand_total").text(grand_total_w.toFixed(2));
                    $("#grand_total_input").val(grand_total_w.toFixed(2));
                    $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                    $("#payment_amount").val(grand_total_w.toFixed(2));

                    var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
                    sls = parseFloat(sls).toFixed(2);
                    $("#sales_tax").val(sls);
                }
            });
        });

        $(document).on("click", ".btn-show-items", function() {
            let _this = $(this);

            if (_this.closest("tr").next(".package-subitem").hasClass("d-none")) {
                _this.closest("tr").next(".package-subitem").removeClass("d-none");
            } else {
                _this.closest("tr").next(".package-subitem").addClass("d-none");
            }
        });

        $("#package_modal").on("show.bs.modal", function() {
            getPackageItems();
        });

        $(document).on("click", ".add-packaege", function() {
            let _this = $(this);
            let id = _this.attr("data-pack-id");

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('workorder/addNewPackageToList'); ?>",
                data: {
                    packId: id
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let randNumber = 1 + Math.floor(Math.random() * 99999);

                    $.each(response['pName'], function(a, b) {
                        var pName = b.name;
                        var rNumber = Math.floor(Math.random() * (9999 - 10000 + 1) + 100);

                        let _element = '<tr>';
                        _element += '<td class="fw-bold nsm-text-primary" colspan="6" style="border-bottom: 0px;">' + pName;
                        _element += '<input type="hidden" id="priceqty_' + rNumber + '" value="' + b.amount_set + '">';
                        _element += '<input type="hidden" name="itemid[]" value="0">';
                        _element += '<input type="hidden" name="packageID[]" value="' + b.id + '">';
                        _element += '<input type="hidden" name="quantity[]" value="1">';
                        _element += '<input type="hidden" name="price[]" value="' + b.amount_set + '">';
                        _element += '<input type="hidden" name="tax[]" value="0">';
                        _element += '<input type="hidden" name="discount[]" value="0">';
                        _element += '</td>';
                        _element += '<td colspan="2" style="border-bottom: 0px;">';
                        _element += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" id="sub_total_text' + rNumber + '" value="' + b.amount_set + '">';
                        _element += '$<span data-subtotal="' + b.amount_set + '" id="span_total_' + rNumber + '">' + b.amount_set + '</span>';
                        _element += '</td>';
                        _element += '</tr>';

                        $("#item_list_table").append(_element);
                    });

                    $.each(response['details'], function(i, v) {
                        _element = '<tr>';
                        _element += '<td colspan="2">' + v.title + '</td>';
                        _element += '<td>' + v.quantity + '</td>';
                        _element += '<td>' + v.price + '</td>';
                        _element += '<td colspan="4"></td>';
                        _element += '</tr>';
                        $("#item_list_table").append(_element);
                    });

                    var priceqty2 = 0;
                    $('*[id^="priceqty_"]').each(function() {
                        priceqty2 += parseFloat($(this).val());
                    });
                    $("#item_total").val(priceqty2.toFixed(2));
                    $("#span_sub_total_invoice").text(priceqty2.toFixed(2));


                    var subtotal = 0;
                    $('*[id^="span_total_"]').each(function() {
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

                    console.log(grand_total, );
                }
            });

            $("#package_modal").modal("hide");
        });

        $(document).on("click", ".select-package-item", function() {
            let _this = $(this);
            let id = _this.attr("data-id");
            let title = _this.attr("data-itemname");
            let price = _this.attr("data-price");
            let quantity = _this.attr("data-quantity");

            if (!_this.attr("data-quantity")) {
                quantity = 0;
            }

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * quantity;
            var tax_ = (parseFloat(total_).toFixed(2) * 7.5) / 100;
            var taxes_t = parseFloat(tax_).toFixed(2);
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';

            let _element = '<tr>';
            _element += '<td style="width: 35%">';
            _element += '<input type="text" class="nsm-field form-control" name="items[]" value="' + title + '"/>';
            _element += '<input type="hidden" class="nsm-field form-control" name="item_id[]" value="' + id + '"/>';
            _element += '<input type="hidden" class="nsm-field form-control" name="itemidPackage[]" value="' + id + '"/>';
            _element += '</td>';
            _element += '<td style="width: 30%">';
            _element += '<select class="nsm-field form-select" name="item_typePackage[]">';
            _element += '<option value="product">Product</option>';
            _element += '<option value="material">Material</option>';
            _element += '<option value="service">Service</option>';
            _element += '<option value="fee">Fee</option>';
            _element += '</select>';
            _element += '</td>';
            _element += '<td style="width: 15%">';
            _element += '<input type="number" class="nsm-field form-control" name="quantityPackage[]" id="quantity_package_' + id + '" value="' + quantity + '" data-itemid="' + id + '" data-counter="0" min="0"/>';
            _element += '</td>';
            _element += '<td style="width: 15%">';
            _element += '<input type="number" class="nsm-field form-control" name="pricePackage[]" id="price_package_' + id + '" value="' + price + '" data-itemid="' + id + '"/>';
            _element += '<input type="hidden" class="nsm-field form-control" id="priceqtypackage_' + id + '" value="' + total_ + '"/>';
            _element += '</td>';
            _element += '<td>';
            _element += '<div class="dropdown table-management">';
            _element += '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">';
            _element += '<i class="bx bx-fw bx-dots-vertical-rounded"></i>';
            _element += '</a>';
            _element += '<ul class="dropdown-menu dropdown-menu-end">';
            _element += '<li>';
            _element += '<a class="dropdown-item remove-package-item" href="javascript:void(0);" id="' + id + '">Remove</a>';
            _element += '</li>';
            _element += '</ul>';
            _element += '</div>';
            _element += '</td>';
            _element += '</tr>';

            $("#new_package_items").find(".empty-placeholder").addClass("d-none");
            $("#new_package_items").append(_element);

            var total_cost = 0;
            $('*[id^="priceqtypackage_"]').each(function() {
                total_cost += parseFloat($(this).val());
            });

            $("#package_price").val(total_cost.toFixed(2));
        });

        $(document).on("click", ".remove-package-item", function() {
            let _this = $(this);
            _this.closest("tr").fadeOut(300, function() {
                _this.closest("tr").remove();
                var total_cost = 0;
                $('*[id^="priceqtypackage_"]').each(function() {
                    total_cost += parseFloat($(this).val());
                });

                $("#package_price").val(total_cost.toFixed(2));

                if ($("#new_package_items").children("tr:not(.empty-placeholder)").length == 0) {
                    $("#new_package_items .empty-placeholder").removeClass("d-none");
                }
            });
        });

        $("#btn_create_package").on("click", function() {
            let item = $('input[name="itemidPackage[]"]').map(function() {
                return this.value;
            }).get();

            let type = $('input[name="item_typePackage[]"]').map(function() {
                return this.value;
            }).get();

            let quantity = $('input[name="quantityPackage[]"]').map(function() {
                return this.value;
            }).get();

            let price = $('input[name="pricePackage[]"]').map(function() {
                return this.value;
            }).get();

            let package_name = $("#package_name").val();
            let package_price = $("#package_price").val();
            let package_price_set = $("#package_price_set").val();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('workorder/createPackage'); ?>",
                data: {
                    item: item,
                    type: type,
                    quantity: quantity,
                    price: price,
                    package_price: package_price,
                    package_name: package_name,
                    package_price_set: package_price_set
                },
                dataType: 'json',
                success: function(response) {
                    let randNumber = 1 + Math.floor(Math.random() * 99999);

                    $.each(response['pName'], function(a, b) {
                        let pName = b.name;
                        let rNumber = Math.floor(Math.random() * (9999 - 10000 + 1) + 100);

                        let _element = '<tr>';
                        _element += '<td class="fw-bold nsm-text-primary" colspan="6" style="border-bottom: 0px;">' + pName;
                        _element += '<input type="hidden" id="priceqty_' + rNumber + '" value="' + b.amount_set + '">';
                        _element += '<input type="hidden" name="itemid[]" value="0">';
                        _element += '<input type="hidden" name="packageID[]" value="' + b.id + '">';
                        _element += '<input type="hidden" name="quantity[]" value="1">';
                        _element += '<input type="hidden" name="price[]" value="' + b.amount_set + '">';
                        _element += '<input type="hidden" name="tax[]" value="0">';
                        _element += '<input type="hidden" name="discount[]" value="0">';
                        _element += '</td>';
                        _element += '<td colspan="2" style="border-bottom: 0px;">';
                        _element += '<input type="hidden" class="nsm-field form-control total-field" name="total[]" id="sub_total_text' + rNumber + '" value="' + b.amount_set + '">';
                        _element += '$<span data-subtotal="' + b.amount_set + '" id="span_total_' + rNumber + '">' + b.amount_set + '</span>';
                        _element += '</td>';
                        _element += '</tr>';

                        $("#item_list_table").append(_element);
                    });

                    $.each(response['details'], function(i, v) {
                        _element = '<tr>';
                        _element += '<td colspan="2">' + v.title + '</td>';
                        _element += '<td>' + v.quantity + '</td>';
                        _element += '<td>' + v.price + '</td>';
                        _element += '<td colspan="4"></td>';
                        _element += '</tr>';
                        $("#item_list_table").append(_element);
                    });

                    var priceqty2 = 0;
                    $('*[id^="priceqty_"]').each(function() {
                        priceqty2 += parseFloat($(this).val());
                    });
                    $("#item_total").val(priceqty2.toFixed(2));
                    $("#span_sub_total_invoice").text(priceqty2.toFixed(2));


                    var subtotal = 0;
                    // $("#span_total_0").each(function(){
                    $('*[id^="span_total_"]').each(function() {
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
                }
            });

            $("#package_modal").modal("hide");
            $("#package_name").val('');
            $("#new_package_items").children("tr:not(.empty-placeholder)").remove();
            $("#new_package_items .empty-placeholder").removeClass("d-none");
            $("#package_price").val('');
            $("#package_price_set").val('');
        });

        $("#btn_validate_offer").on("click", function() {
            let offerCode = $("#offer_code").val();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('accounting/findoffercode'); ?>",
                data: {
                    offer_code: offerCode
                },
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        var cost = response['offer'].cost;
                        $("#offer_cost").text('- $' + response['offer'].cost);
                        $("#offer_cost").val(response['offer'].cost);

                        var grand = $("#grand_total_input").val();
                        var new_grand = grand - parseFloat(cost);

                        $("#grand_total").text(new_grand.toFixed(2));
                        $("#grand_total_input").val(new_grand.toFixed(2));
                        $("#payment_amount").val(new_grand.toFixed(2));
                        $('.saved-field').removeClass("d-none");
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: "Invalid code."
                        });
                    }

                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: "Invalid code."
                    });

                    $("#offer_cost").text('0');
                    $("#offer_cost").val('0');

                    var total1 = $("#span_sub_total_invoice").text();
                    var total2 = $("#adjustment_input").val();

                    var total3 = parseFloat(total1) - parseFloat(total2);
                    $("#grand_total").text(total3.toFixed(2));
                    $("#grand_total_input").val(total3.toFixed(2));
                    $("#payment_amount").val(total3.toFixed(2));
                }
            });
        });

        $("#btn_add_checklist").on("click", function() {
            $('input.checklist-box:checked').each(function() {
                var id = this.value;

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>workorder/getchecklistdetailsajax",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#select_checklist_modal").modal('hide');

                        var current_row = $('.selected-checklists li').length + 1;
                        var input_hidden = '<input type="hidden" name="checklists[]" value="' + response['checklists'][0].id + '" />';
                        var check = '<li id="s-checklist-' + current_row + '" class="view-details" c_id="' + response['checklists'][0].id + '">' + response['checklists'][0].checklist_name + ' <a class="remove-checklist" data-row="' + current_row + '" href="javascript:void(0);">Remove</a>' + input_hidden + '</li>';
                        $(".selected-checklists").append(check);

                        var cID = response['checklists'][0].id;

                        $('.view-details').each(function(e) {
                            $(this).on('mouseover', function() {
                                var id = this.id;
                                var userid = $(this).attr('c_id');
                            });
                        });

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('workorder/getchecklistitemsajax'); ?>",
                            dataType: "json",
                            data: {
                                cID: cID
                            },
                            success: function(result) {},
                            error: function(result) {
                                console.log('Error' + result);
                            }

                        });
                    }
                });
            });
        });

        $("#form_update_termscon").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('workorder/save_update_tc'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: $("#update_tc_id").val(),
                    content: CKEDITOR.instances['editor3'].getData()
                },
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Terms and Condition has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });

                    $("#update_termscon_modal").modal('hide');
                    $("#terms_and_condition_text").html(CKEDITOR.instances['editor3'].getData());
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form_update_termsuse").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('workorder/save_update_tu'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: $('#update_tu_id').val(),
                    content: CKEDITOR.instances['editor2'].getData()
                },
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Terms of Use has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });

                    $("#update_termsuse_modal").modal('hide');
                    $("#terms_of_use_text").html(CKEDITOR.instances['editor2'].getData());
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        var signaturePad;
        jQuery(document).ready(function() {
            var signaturePadCanvas = document.querySelector('#canvasb');
            signaturePad = new SignaturePad(signaturePadCanvas);
            signaturePadCanvas.height = 300;
            signaturePadCanvas.width = 680;
        });

        $(document).on('click touchstart', '#canvasb', function() {
            var canvas_web = document.getElementById("canvasb");
            var dataURL = canvas_web.toDataURL("image/png");
            $("#saveCompanySignatureDB1a").val(dataURL);
        });

        $("#btn_save_cra_signature").on("click", function() {
            $("#companyrep").attr("src", $("#saveCompanySignatureDB1a").val());
            $("#companyrep").removeClass("d-none");
            $("#cra_sign_container").find("span").addClass("d-none");
            $("#add_cra_sign_modal").modal("hide");
        });

        $('#btn_clear_cra_signature').click(function() {
            $('#cra_sign_area').signaturePad().clearCanvas();
        });

        var signaturePad;
        jQuery(document).ready(function() {
            var signaturePadCanvas = document.querySelector('#canvas2b');
            signaturePad = new SignaturePad(signaturePadCanvas);
            signaturePadCanvas.height = 300;
            signaturePadCanvas.width = 680;
        });

        $(document).on('click touchstart', '#canvas2b', function() {
            var canvas_web = document.getElementById("canvas2b");
            var dataURL = canvas_web.toDataURL("image/png");
            $("#savePrimaryAccountSignatureDB2a").val(dataURL);
        });

        $("#btn_save_pah_signature").on("click", function() {
            $("#primaryrep").attr("src", $("#savePrimaryAccountSignatureDB2a").val());
            $("#primaryrep").removeClass("d-none");
            $("#pah_sign_container").find("span").addClass("d-none");
            $("#add_pah_sign_modal").modal("hide");
        });

        $('#btn_clear_pah_signature').click(function() {
            $('#pah_sign_area').signaturePad().clearCanvas();
        });

        var signaturePad;
        jQuery(document).ready(function() {
            var signaturePadCanvas = document.querySelector('#canvas3b');
            signaturePad = new SignaturePad(signaturePadCanvas);
            signaturePadCanvas.height = 300;
            signaturePadCanvas.width = 680;
        });

        $(document).on('click touchstart', '#canvas3b', function() {
            var canvas_web = document.getElementById("canvas3b");
            var dataURL = canvas_web.toDataURL("image/png");
            $("#saveSecondaryAccountSignatureDB3a").val(dataURL);
        });

        $("#btn_save_sah_signature").on("click", function() {
            $("#secondaryrep").attr("src", $("#saveSecondaryAccountSignatureDB3a").val());
            $("#secondaryrep").removeClass("d-none");
            $("#sah_sign_container").find("span").addClass("d-none");
            $("#add_sah_sign_modal").modal("hide");
        });

        $('#btn_clear_sah_signature').click(function() {
            $('#sah_sign_area').signaturePad().clearCanvas();
        });

        $("#payment_method").on("change", function() {
            let paymentMethod = $(this).val();

            hideAllPaymentMethods();
            switch(paymentMethod){
                case "Cash":
                    $("#cash_area").removeClass("d-none");
                    break;
                case "Invoicing":
                    $("#invoicing").removeClass("d-none");
                    break;
                case "Check":
                    $("#check_area").removeClass("d-none");
                    break;
                case "Credit Card":
                    $("#credit_card").removeClass("d-none");
                    break;
                case "Debit Card":
                    $("#debit_card").removeClass("d-none");
                    break;
                case "ACH":
                    $("#ach_area").removeClass("d-none");
                    break;
                case "Venmo":
                    $("#venmo_area").removeClass("d-none");
                    break;
                case "Paypal":
                    $("#paypal_area").removeClass("d-none");
                    break;
                case "Square":
                    $("#square_area").removeClass("d-none");
                    break;
                case "Warranty Work":
                    $("#warranty_area").removeClass("d-none");
                    break;
                case "Home Owner Financing":
                    $("#home_area").removeClass("d-none");
                    break;
                case "e-Transfer":
                    $("#e_area").removeClass("d-none");
                    break;
                case "Other Credit Card Professor":
                    $("#other_credit_card").removeClass("d-none");
                    break;
                case "Other Payment Type":
                    $("#other_payment_area").removeClass("d-none");
                    break;
            }
        });

        $("#form_new_workorder").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('workorder/savenewWorkorder'); ?>";
            _this.find("button[type=submit]").html("Submitting");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Workorder has been saved successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Submit");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });

    function initPopover() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    }

    function calculateTotal(counter) {
        var price = $("#price_" + counter).val();
        var quantity = $("#quantity_" + counter).val();
        var discount = $("#discount_" + counter).val() ?
            $("#discount_" + counter).val() :
            0;
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

        if ($('#tax_' + counter).length) {
            $('#tax_' + counter).val(tax1);
        }

        if ($('#item_total_' + counter).length) {
            $('#item_total_' + counter).val(total);
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

        if ($("#grand_total").length && $("#grand_total").val().length) {
            // console.log('none');
            // alert('none');
        } else {
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
    }

    function getPackageItems() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('workorder/getPackageItemsById'); ?>",
            dataType: 'json',
            success: function(response) {
                var inputs = "";
                $.each(response['pItems'], function(i, v) {
                    markup = '<td colspan="3">';
                    markup += '<div class="row">';
                    markup += '<div class="col-12">';
                    markup += '<label class="content-subtitle fw-bold me-2">Title:</label>';
                    markup += '<label class="content-subtitle">' + v.title + '</label>';
                    markup += '</div>';
                    markup += '<div class="col-12">';
                    markup += '<label class="content-subtitle fw-bold me-2">Quantity:</label>';
                    markup += '<label class="content-subtitle">' + v.quantity + '</label>';
                    markup += '</div>';
                    markup += '<div class="col-12">';
                    markup += '<label class="content-subtitle fw-bold me-2">Price:</label>';
                    markup += '<label class="content-subtitle">' + v.price + '</label>';
                    markup += '</div>';
                    markup += '</div>';
                    markup += '</td>';
                    $("#package_subitem_" + v.package_id).html(markup);
                });
            },
        });
    }

    function hideAllPaymentMethods() {
        $("#cash_area").addClass("d-none");
        $("#invoicing").addClass("d-none");
        $("#check_area").addClass("d-none");
        $("#credit_card").addClass("d-none");
        $("#debit_card").addClass("d-none");
        $("#ach_area").addClass("d-none");
        $("#venmo_area").addClass("d-none");
        $("#paypal_area").addClass("d-none");
        $("#square_area").addClass("d-none");
        $("#warranty_area").addClass("d-none");
        $("#home_area").addClass("d-none");
        $("#e_area").addClass("d-none");
        $("#other_credit_card").addClass("d-none");
        $("#other_payment_area").addClass("d-none");
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>