<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Script for autosaving form -->
<!-- <script src="<?= base_url("assets/js/invoice/autosave-update.js") ?>"></script> -->
<?php include viewPath('v2/includes/header'); ?>
<link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">
<style>
    .show_mobile_view {
        display: none;
    }

    .span-input {
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        text-align: right;
    }

    #jobs_items_table_body .nsm-button {
        margin: 0 auto;
        display: block;
    }

    #jobs_items_table_body .nsm-button i {
        position: relative;
        left: 2px;
    }

    .custom-ticket-header {
        background-color: #6a4a86;
        color: #ffffff;
        font-size: 15px;
        padding: 10px;
    }

    .bold {
        font-weight: bold;
    }

    .block-label {
        display: block;
        height: 30px;
    }

    #item_list .nsm-table thead td {
        background-color: #6a4a86 !important;
        color: #ffffff;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoce_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>

    <!-- page wrapper start -->
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Complete the fields below to create a new invoice.
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart(null, ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="nsm-card primary">
                        <div class="nsm-card-header d-block">
                            <div class="nsm-card-title"><span><i class='bx bx-user-circle'></i>&nbsp;Customer Details</span></div>
                        </div>
                        <div class="nsm-card-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="invoice_customer" class="bold">Customer</label>
                                    <a class="link-modal-open nsm-button btn-small" href="javascript:void(0);" id="btn-add-new-customer" data-bs-toggle="modal" data-bs-target="#quick-add-customer" style="float:right;">Add New</a>
                                    <select name="customer_id" id="customer_id" class="form-select" required></select>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label class="bold">Customer email</label><br />
                                    <input type="email" class="form-control" name="customer_email" id="customer_email" value="" />
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label class="bold" for="status">Status</label><br />
                                    <select name="status" class="form-select">
                                        <option value="Draft">Draft</option>
                                        <!-- <option value="Partially Paid">Partially Paid</option> -->
                                        <option value="Paid">Paid</option>
                                        <option value="Due">Due</option>
                                        <option value="Overdue">Overdue</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label class="bold" for="job_name">Job Name <small class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" value="" />
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label class="bold" for="job_location">Address</label>
                                    <a class="btn-use-different-address nsm-button default btn-small float-end" style="display:none;" id="btn-use-different-address" data-id="" href="javascript:void(0);">Use Other Address</a>
                                    <textarea class="form-control" name="jobs_location" id="invoice_jobs_location" style="height:100px;" required=""></textarea>
                                </div>
                                <div class="col-md-5 mt-4">
                                    <label for="customer_city" class="required"><b>City</b></label>
                                    <input type="text" class="form-control" name="jobs_city" id="jobs_city" required value=""/>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="customer_state" class="required"><b>State</b></label>
                                    <input type="text" class="form-control" name="jobs_state" id="jobs_state" required value=""/>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <label for="customer_zip" class="required"><b>Zip Code</b></label>
                                    <input type="text" class="form-control" name="jobs_zip" id="jobs_zip" required value=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="nsm-card primary">
                        <div class="MAP_LOADER_CONTAINER">
                            <div class="text-center MAP_LOADER">
                                <iframe id="TEMPORARY_MAP_VIEW"
                                    <?php $location = ''; ?>
                                    src="http://maps.google.com/maps?q=<?= $location; ?>&output=embed" height="470" width="100%"
                                    style=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title"><span><i class='bx bx-list-plus'></i>&nbsp;Invoice Details</span></div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row form-group">
                                            <div class="col-md-3 form-group">
                                                <label for="date_issued" class="bold block-label">Date Issued <span style="color:red;">*</span></label>
                                                <input type="date" class="form-control" id="" name="date_issued" value="<?= date("Y-m-d"); ?>" />
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="due_date" class="bold block-label">Due Date <span style="color:red;">*</span></label>
                                                <input type="date" class="form-control" id="" name="due_date" value="<?= date("Y-m-d", strtotime("+5 days")); ?>" />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bold block-label">Location of sale</label>
                                                <input type="text" class="form-control" name="location_scale" value="">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bold block-label">
                                                    Terms
                                                    <a class="link-modal-open nsm-button btn-small" id="btn-quick-add-payment-terms" href="javascript:void(0);" style="float:right;">Add New</a>
                                                </label>
                                                <select class="form-select" name="terms" id="payment-terms">
                                                    <?php foreach ($terms as $term) : ?>
                                                        <option value="<?php echo $term->id; ?>"><?php echo $term->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group mt-4">
                                            <div class="col-md-3">
                                                <label class="bold block-label">
                                                    Tags
                                                    <a class="link-modal-open nsm-button btn-small" href="javascript:void(0);" id="btn-quick-add-job-tags" style="float:right;">Add New</a>
                                                </label>
                                                <select class="form-select" name="tags" id="tags">
                                                    <?php foreach ($tags as $t) { ?>
                                                        <option value="<?= $t->name; ?>" <?php if ($t->name == $invoice->tags) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $t->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="estimate_date" class="bold block-label">Invoice Type <span style="color:red;">*</span></label>
                                                <select name="invoice_type" class="form-select">
                                                    <option value="Deposit">Deposit</option>
                                                    <option value="Partial Payment">Partial Payment</option>
                                                    <option value="Final Payment">Final Payment</option>
                                                    <option value="Total Due" selected="selected">Total Due</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="purchase_order" class="bold block-label">Purchase Order Number <span class="bx bx-fw bx-help-circle" id="popover-po"></span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="purchase_order" id="purchase_order" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bold">Sales Representative</label>
                                                <select class="form-select mb-3" name="user_id" id="user_id">                                            
                                                    <?php foreach($users_lists as $ulist){ ?>
                                                        <option value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>                                            
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-3">
                                                <label class="bold">Tracking no.</label>
                                                <input type="text" class="form-control" name="tracking_number" value="">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bold">Shipping date</label>
                                                <input type="date" class="form-control" name="shipping_date" value="">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bold">Ship via</label>
                                                <input type="text" class="form-control" name="ship_via" value="">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-3">
                                                <label class="bold">Shipping to</label>
                                                <textarea class="form-control" style="width:100%;" name="shipping_to_address" id="shipping_address"></textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="bold">Billing address</label>
                                                <textarea class="form-control" style="width:100%;" name="billing_address" id="billing_address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <h6 class="card_header custom-ticket-header">Invoice Items</h6>
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr style="background-color:#E8E9E8;">
                                                    <th style="width:30% !important;"><b>Item</b></th>
                                                    <th style="width:20% !important;"><b>Type</th>
                                                    <th style="width:8% !important;" id="qty_type_value"><b>Quantity</b></th>
                                                    <th style="width:10% !important;"><b>Price</b></th>
                                                    <th style="width:10% !important;"><b>Discount</b></th>
                                                    <th style="width:10% !important;"><b>Tax(%)</b></th>
                                                    <th style="width:15% !important;"><b>Total</b></th>
                                                    <th style="width:2% !important;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="jobs_items_table_body"></tbody>
                                        </table>

                                        <input type="hidden" name="count" value="0" id="count">
                                        <a href="javascript:void(0);" id="add-item" class="nsm-button primary small "> <i class='bx bx-plus'></i>Add Item</a>
                                        <hr class="mb-4" />

                                        <div class="row mt-5">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5>Request a deposit <span class="bx bx-fw bx-help-circle" id="popover-request-deposit"></span></h5>
                                                        <span class="help help-sm help-block"></span>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <select name="deposit_request_type" class="form-select">
                                                            <option value="%">Percentage %</option>
                                                            <option value="$">Deposit amount $</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group mb-3">
                                                        <div class="input-group">
                                                            <input type="text" name="deposit_amount" value="0.00" class="form-control"
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-4">
                                                        <h5>Attachment <span class="bx bx-fw bx-help-circle" id="popover-request-attachment"></span></h5>
                                                        <input data-fileupload="attachment-file" class="form-control mt-4" name="attachment-file" type="file"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-borderless table_mobile" style="text-align:left;">
                                                    <tr>
                                                        <td class="bold">Subtotal</td>
                                                        <!-- <td></td> -->
                                                        <td colspan="2" align="right">$ <span id="span_sub_total_invoice">0.00</span>
                                                            <input type="hidden" name="subtotal" id="item_total" value="0.00">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="is_tax_exempted" value="1" id="chk-tax-exempted">
                                                                <label class="form-check-label" for="chk-tax-exempted">
                                                                    Taxes (check if no tax)
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td colspan="2" align="right">
                                                            <div style="display:none;">
                                                                $ <span id="total_tax_">0.00</span>
                                                            </div>
                                                            <input type="number" step="any" min="0" class="form-control" id="total_tax_input" name="taxes" value="0.00" required="" style="width:50%;text-align:right;" />
                                                        </td>
                                                    </tr>
                                                    <?php if( $industrySpecificFields && array_key_exists('installation_cost', $industrySpecificFields) ){ ?>
                                                        <?php if( !in_array('installation_cost', $disabled_industry_specific_fields) ){ ?>
                                                        <tr>
                                                            <td class="bold">Installation Cost</td>
                                                            <td colspan="2" align="right">
                                                                <input type="number" step="any" min="0" class="form-control" id="adjustment_ic" name="installation_cost" value="0.00" required="" style="width:50%;text-align:right;" />
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>                                                    
                                                    <?php if( $industrySpecificFields && array_key_exists('otps', $industrySpecificFields) ){ ?>
                                                        <?php if( !in_array('otps', $disabled_industry_specific_fields) ){ ?>
                                                        <tr>
                                                            <td class="bold">One time (Program and Setup)</td>
                                                            <td colspan="2" align="right">
                                                                <input type="number" step="any" min="0" class="form-control" id="otps" name="program_setup" value="0.00" required="" style="width:50%;text-align:right;" />
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>                                                                                                        
                                                    <?php if( $industrySpecificFields && array_key_exists('monthly_monitoring_rate', $industrySpecificFields) ){ ?>
                                                        <?php if( !in_array('monthly_monitoring_rate', $disabled_industry_specific_fields) ){ ?>
                                                        <tr>
                                                            <td class="bold">Monthly Monitoring</td>
                                                            <td colspan="2" align="right">
                                                                <input type="number" step="any" min="0" class="form-control" id="adjustment_mm" name="monthly_monitoring" value="0.00" required="" style="width:50%;text-align:right;" />
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="adjustment_name" id="adjustment_name" value="" placeholder="Adjustment Name" class="form-control" style="border:1px dashed #d1d1d1;width:80%;margin-right:4px; display:inline;">
                                                            <span class="bx bx-fw bx-help-circle" id="popover-request-adjustment"></span>
                                                        </td>
                                                        <td colspan="2" align="right">
                                                            <input type="number" step="any" name="adjustment_value" id="adjustment_input" value="0.00" class="form-control adjustment_input" style="width:50%;text-align:right;">
                                                            <span id="adjustmentText" style="display:none;">0.00</span>
                                                        </td>
                                                    </tr>
                                                    <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                                        <td class="bold">Amount Saved</td>
                                                        <td><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0"></td>
                                                        <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input" value="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="bold">Grand Total ($)</td>
                                                        <td class="text-end">
                                                            <b>$ <span id="grand_total">0.00</span></b>
                                                            <input type="hidden" name="grand_total" id="grand_total_input" value="0.00">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <hr />
                                <br><br>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-6">
                                        <h5>Message to Customer <span class="bx bx-fw bx-help-circle" id="popover-request-mc"></span></h5>
                                        <textarea name="message_to_customer" cols="40" rows="2" class="form-control ckeditor">Thank you for your business.</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Terms &amp; Conditions <span class="bx bx-fw bx-help-circle" id="popover-request-tc"></span></h5>
                                        <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control ckeditor editor1_tc"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-12 form-group">
                                        <button class="nsm-button primary" id="btn-save-invoice">Save</button>
                                        <a href="<?php echo url('invoice') ?>" class="btn">Cancel</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>

                <?php echo form_close(); ?>

                <!-- Modal Quick Add Job Tags -->
                <div class="modal fade nsm-modal fade" id="modal-quick-add-job-tag" tabindex="-1" aria-labelledby="modal-quick-add-job-tag-label" aria-hidden="true">
                    <div class="modal-dialog modal-md" style="margin-top:13%;">
                        <form id="quick-add-job-tag-form" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title content-title">Quick Add : Job Tag</span>
                                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="job-tag-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                                            <input type="text" name="job_tag_name" id="job-tag-name" class="nsm-field form-control" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="nsm-button primary" id="btn-quick-add-job-tag-submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Quick Add Payment Terms -->
                <div class="modal fade nsm-modal fade" id="modalAddTerms" tabindex="-1" aria-labelledby="modalAddTerms-label" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Quick Add : Payment Term</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form id="frm-quick-add-payment-term" action="" method="post">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control nsm-field mb-2" value="" required="">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-check mb-2 mt-2">
                                                <input class="form-check-input" type="radio" name="payment_term_type" id="payment-term-type-1" value="1">
                                                <label class="form-check-label" for="payment-term-type-1">
                                                    Due in fixed number of days
                                                </label>
                                            </div>
                                            <div class="row px-4 mb-2">
                                                <div class="col-auto">
                                                    <div class="input-group">
                                                        <input type="number" style="width:90px;" class="form-control nsm-field" id="net-due-days" name="net_due_days" value="">
                                                        <div class="input-group-text">days</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="payment_term_type" id="payment-term-type-2" value="2">
                                                <label class="form-check-label" for="payment-term-type-2">
                                                    Due by certain day of the month
                                                </label>
                                            </div>
                                            <div class="row px-4 mb-2">
                                                <div class="col-auto">
                                                    <div class="input-group">
                                                        <input type="number" style="width:90px;" class="form-control nsm-field" id="day-of-month-due" name="day_of_month_due" value="">
                                                        <div class="input-group-text">day of month</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="row px-4 mb-2">
                                                <div class="col-12">
                                                    <p>Due the next month if issued within</p>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-auto">
                                                        <div class="input-group">
                                                            <input type="number" style="width:90px;" class="form-control nsm-field" id="minimum-days-to-pay" name="minimum_days_to_pay" value="" required="">
                                                            <div class="input-group-text">days of due date</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="display:block;">
                                    <div style="float:right;">
                                        <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="nsm-button primary" id="btn-quick-add-payment-terms">Save</button>
                                    </div>
                                </div>
                            </form>
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
    <div class="modal fade" id="item_list" tabindex="-1" aria-labelledby="item_listLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                    <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-12 grid-mb">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" for="quick-add-items-list" placeholder="Search List">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="quick-add-items-list" class="nsm-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td data-name="Add" style="width: 5% !important;"></td>
                                        <td data-name="Name"><strong>Name</strong></td>
                                        <td data-name="Type"><strong>Type</strong></td>
                                        <td data-name="Qty"><strong>Stock</strong></td>
                                        <td data-name="Price" style="text-align:right;"><strong>Price</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) { ?>
                                        <?php $item_qty = get_total_item_qty($item->id); ?>
                                        <?php //if ($item_qty[0]->total_qty > 0) { 
                                        ?>
                                        <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                            <td class="nsm-text-primary">
                                                <button type="button" data-bs-dismiss="modal" class='nsm nsm-button default select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="1" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-plus-medical'></i></button>
                                            </td>
                                            <td class="nsm-text-primary show"><?php echo $item->title; ?></td>
                                            <td class="nsm-text-primary"><?php echo $item->type; ?></td>
                                            <td><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : "0"; ?></td>
                                            <td style="text-align:right;"><?php echo $item->price; ?></td>
                                        </tr>
                                        <?php //} 
                                        ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include viewPath('v2/includes/customer/quick_add_customer'); ?>
    <?php include viewPath('v2/includes/customer/other_address'); ?>
    <?php include viewPath('v2/includes/footer'); ?>
    <script>
        $(document).ready(function() {

            $('#btn-add-new-customer').on('click', function(){
                $('#target-id-dropdown').val('customer_id');
                $('#origin-modal-id').val('');
            });

            $('#popover-po').popover({
                placement: 'top',
                html: true,
                trigger: "hover focus",
                content: function() {
                    return 'Optional if you want to display the purchase order number on invoice.';
                }
            });

            $('#popover-request-deposit').popover({
                placement: 'top',
                html: true,
                trigger: "hover focus",
                content: function() {
                    return 'You can request an upfront payment on accept estimate.';
                }
            });

            $('#popover-request-attachment').popover({
                placement: 'top',
                html: true,
                trigger: "hover focus",
                content: function() {
                    return 'Optionally attach files to this invoice. Allowed type: pdf, doc, docx, png, jpg, gif.';
                }
            });

            $('#popover-request-adjustment').popover({
                placement: 'top',
                html: true,
                trigger: "hover focus",
                content: function() {
                    return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
                }
            });

            $('#popover-request-mc').popover({
                placement: 'top',
                html: true,
                trigger: "hover focus",
                content: function() {
                    return 'Add a message that will be displayed on the invoice.';
                }
            });

            $('#popover-request-tc').popover({
                placement: 'top',
                html: true,
                trigger: "hover focus",
                content: function() {
                    return `Mention your company's T&C that will appear on the invoice.`;
                }
            });

            $('#chk-tax-exempted').on('change', function(){
                var counter = $("#count").val();
                calculation(counter);
            });

            $('#adjustment_ic, #otps, #adjustment_mm').on('change', function(){
                var counter = $("#count").val();
                calculation(counter);
            });

            $('#invoice_form').on('submit', function(e) {
                e.preventDefault();

                var _this = $(this);
                e.preventDefault();

                var formData = new FormData(this);

                var url = base_url + "invoice/_create_invoice";
                $('#btn-save-invoice').html("Saving");
                $('#btn-save-invoice').prop("disabled", true);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function(result) {
                        if (result.is_success == 1) {
                            Swal.fire({
                                title: 'Create Invoice',
                                text: "Invoice has been created successfully.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                location.href = base_url + 'invoice';
                                //}
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }

                        $('#btn-save-invoice').html("Save");
                        $('#btn-save-invoice').prop("disabled", false);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $("#new_customer_form").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: base_url + "customer/_quick_save_customer",
                    data: $('#new_customer_form').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#NEW_CUSTOMER_MODAL_CLOSE').html('Save');
                        if (response.is_success == 1) {
                            $('#new_customer').modal('hide');

                            $("#customer_id").append(`<option value="${response.customer_id}">${response.customer_name}</option>`);
                            $("#customer_id").val(response.customer_id);
                            $("#customer_id").trigger('change');
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {

                            });
                        }
                    },
                    beforeSend: function() {
                        $('#NEW_CUSTOMER_MODAL_CLOSE').html('Saving');
                    }
                });
            });

            $("#quick-add-items-list").nsmPagination({
                itemsPerPage: 10
            });
            $("#search_field").on("input", debounce(function() {
                tableSearch($(this));
            }, 1000));

            $('#customer_id').select2({
                ajax: {
                    url: base_url + 'autocomplete/_company_customer',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data,
                        };
                    },
                    cache: true
                },
                placeholder: 'Select Customer',        
                minimumInputLength: 0,
                templateResult: formatRepoCustomer,
                templateSelection: formatRepoCustomerSelection
            });

            function formatRepoCustomer(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
                );

                return $container;
            }

            function formatRepoCustomerSelection(repo) {
                if (repo.first_name != null) {
                    return repo.first_name + ' ' + repo.last_name;
                } else {
                    return repo.text;
                }
            }

            $('#user_id').select2({});

            $('#tags').select2({
                minimumInputLength: 0
            });

            $('#add-item').on('click', function() {
                $('#item_list').modal('show');
            });

            $('#btn-quick-add-job-tags').on('click', function() {
                $('#quick-add-job-tag-form').trigger("reset");
                $('#modal-quick-add-job-tag').modal('show');
            });

            $('#quick-add-job-tag-form').on('submit', function(e) {
                e.preventDefault();
                var url = base_url + 'job/_quick_create_job_tag';

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    data: $('#quick-add-job-tag-form').serialize(),
                    success: function(data) {
                        $('#btn-quick-add-job-tag-submit').html('Save');
                        if (data.is_success) {
                            $('#modal-quick-add-job-tag').modal('hide');
                            $('#tags').append($('<option>', {
                                value: data.job_tag_name,
                                text: data.job_tag_name
                            }));
                            $('#tags').val(data.job_tag_name);
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {

                            });
                        }
                    },
                    beforeSend: function() {
                        $('#btn-quick-add-job-tag-submit').html('<span class="bx bx-loader bx-spin"></span>');
                    }
                });
            });

            $('#btn-quick-add-payment-terms').on('click', function() {
                $('#frm-quick-add-payment-term').trigger("reset");
                $('#modalAddTerms').modal('show');
            });

            $('#frm-quick-add-payment-term').on('submit', function(e) {
                e.preventDefault();
                var url = base_url + 'accounting/payment_terms/_save_payment_terms';

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    data: $('#frm-quick-add-payment-term').serialize(),
                    success: function(data) {
                        $('#btn-quick-add-payment-terms').html('Save');
                        if (data.is_success) {
                            $('#modalAddTerms').modal('hide');
                            var payment_term_name = data.payment_term_name;
                            var payment_term_id = data.payment_term_id
                            $('#payment-terms').append($('<option>', {
                                value: payment_term_id,
                                text: payment_term_name
                            }));
                            $('#payment-terms').val(payment_term_id);
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {

                            });
                        }
                    },
                    beforeSend: function() {
                        $('#btn-quick-add-payment-terms').html('<span class="bx bx-loader bx-spin"></span>');
                    }
                });
            });

            $('#customer_id').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>accounting/addLocationajax",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        var phone = response['customer'].phone_h;
                        var mobile = response['customer'].phone_m;
                        var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
                        var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")

                        var service_location = response['customer'].mail_add + ' ' + response['customer'].city + ', ' + response['customer'].state + ' ' + response['customer'].zip_code;

                        $("#invoice_jobs_location").val(response['customer'].mail_add);
                        $("#jobs_city").val(response['customer'].city);
                        $("#jobs_state").val(response['customer'].state);
                        $("#jobs_zip").val(response['customer'].zip_code);

                        $("#customer_email").val(response['customer'].email);
                        $("#shipping_address").val(response['customer'].mail_add);
                        $("#billing_address").val(response['customer'].mail_add);

                        var map_source = 'http://maps.google.com/maps?q=' + service_location +
                            '&output=embed';
                        var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="' + map_source +
                            '" height="470" width="100%" style=""></iframe>';
                        $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');

                        $('#btn-use-different-address').attr('data-id', id);
                        $('#btn-use-different-address').show();
                    },
                    error: function(response) {

                    }
                });
            });

            $(document).on('click', '.btn-use-other-address', function(){
                let prof_id = $(this).attr('data-id');
                let mail_add = $(this).attr('data-mailadd');
                let city = $(this).attr('data-city');
                let state = $(this).attr('data-state');
                let zip   = $(this).attr('data-zip');
                let other_address = $(this).attr('data-address');
                
                $('#other-address-customer').modal('hide');        
                $('#invoice_jobs_location').val(mail_add);
                $("#jobs_city").val(city);
                $("#jobs_state").val(state);
                $("#jobs_zip").val(zip);

                let map_source = 'http://maps.google.com/maps?q='+other_address+'&output=embed';
                let map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="'+map_source+'" height="470" width="100%" style=""></iframe>';
                $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');

                $('.btn-use-different-address').popover({
                    placement: 'top',
                    html : true, 
                    trigger: "hover focus",
                    content: function() {
                        return 'Use other address';
                    } 
                }); 
            });
        });
    </script>