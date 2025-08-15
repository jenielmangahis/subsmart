<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/invoice/autosave-update.js")?>"></script> -->
<?php include viewPath('v2/includes/header'); ?>
<link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">
<style>
.show_mobile_view{
    display:none;
}
.span-input{
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
    text-align:right;
}
#jobs_items_table_body .nsm-button {
    margin: 0 auto;
    display: block;
}
#jobs_items_table_body .nsm-button i{
    position: relative;
    left: 2px;
}
.custom-ticket-header {
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
.bold{
    font-weight:bold;
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
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">        
        <li onclick="location.href='<?= base_url('invoice'); ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-receipt"></i>
            </div>
            <span class="nsm-fab-label">List Invoice</span>
        </li>
    </ul>   
</div>
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
                            Edit Invoice.
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
                                    <input type="hidden" value="<?php echo $invoice->job_id; ?>" name="invoiceJobId">
                                    <input type="hidden" value="<?php echo $invoice->id; ?>" name="invoiceDataID">
                                    <label for="invoice_customer" class="bold">Customer</label>
                                    <a class="link-modal-open nsm-button btn-small" href="javascript:void(0);" id="btn-add-new-customer" data-bs-toggle="modal" data-bs-target="#quick-add-customer" style="float:right;">Add New</a>
                                    <select name="customer_id" id="customer_id" class="form-select" required>
                                        <option value="<?= $customer->prof_id; ?>" selected=""><?= $customer->first_name . ' ' . $customer->last_name; ?></option>                                    
                                </select>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label class="bold">Customer email</label><br />
                                    <input type="email" class="form-control" name="customer_email" id="customer_email" value="<?php echo $invoice->customer_email; ?>" />
                                </div>  
                                <div class="col-md-12 mt-4">
                                    <label class="bold" for="status">Status</label><br/>
                                    <select name="status" class="form-select">
                                        <option <?php if(isset($invoice)){ if($invoice->status == "Draft"){echo "selected";} } ?>  value="Draft">Draft</option>
                                        <option <?php if(isset($invoice)){ if($invoice->status == "Partially Paid"){echo "selected";} } ?> value="Partially Paid">Partially Paid</option>
                                        <option <?php if(isset($invoice)){ if($invoice->status == "Paid"){echo "selected";} } ?> value="Paid">Paid</option>
                                        <option <?php if(isset($invoice)){ if($invoice->status == "Due"){echo "selected";} } ?> value="Due">Due</option>
                                        <option <?php if(isset($invoice)){ if($invoice->status == "Overdue"){echo "selected";} } ?> value="Overdue">Overdue</option>
                                    </select>
                                </div>   
                                <?php if( $job_number != '' ){ ?>
                                <div class="col-md-12 mt-4">
                                    <label class="bold" for="work_order">Job Number</label>                                    
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="job_number" name="job_number" value="<?= $job_number; ?>" readonly="" disabled="">
                                    </div>
                                </div>                      
                                <?php } ?>
                                <?php if( $ticket_number != '' ){ ?>
                                <div class="col-md-12 mt-4">
                                    <label class="bold" for="work_order">Service Ticket Number</label>                                    
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ticket_number" name="ticket_number" value="<?= $ticket_number; ?>" readonly="" disabled="">
                                    </div>
                                </div>                      
                                <?php } ?>
                                <div class="col-md-12 mt-4">                            
                                    <label class="bold" for="job_name">Job Name <small class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="job_name" id="job_name"  value="<?php echo $invoice->job_name; ?>"/>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label class="bold" for="job_location">Address</label>
                                    <a class="btn-use-different-address nsm-button default btn-small float-end" id="btn-use-different-address" data-id="<?= $invoice->customer_id; ?>" href="javascript:void(0);">Use Other Address</a>
                                    <textarea class="form-control" name="jobs_location" id="invoice_jobs_location" style="height:100px;"><?php echo $invoice->job_address; ?></textarea>
                                </div>
                                <div class="col-md-5 mt-4">
                                    <label for="customer_city" class="required"><b>City</b></label>
                                    <input type="text" class="form-control" name="jobs_city" id="jobs_city" required value="<?= $invoice->job_city; ?>"/>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="customer_state" class="required"><b>State</b></label>
                                    <input type="text" class="form-control" name="jobs_state" id="jobs_state" required value="<?= $invoice->job_state; ?>"/>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <label for="customer_zip" class="required"><b>Zip Code</b></label>
                                    <input type="text" class="form-control" name="jobs_zip" id="jobs_zip" required value="<?= $invoice->job_zip; ?>"/>
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
                                    <?php $location = $customer->mail_add . ' ' . $customer->city . ', ' . $customer->state . ' ' . $customer->zip_code; ?>
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
                                            <label for="invoice_number" class="bold block-label">Invoice Number</label>                                    
                                            <input type="text" class="form-control" name="invoice_number" id="invoice_number" value="<?php echo $invoice->invoice_number; ?>" readonly/>
                                        </div>                                
                                        <div class="col-md-3 form-group">
                                            <label for="date_issued" class="bold block-label">Date Issued <span style="color:red;">*</span></label>
                                            <input type="date" class="form-control" id="" name="date_issued"  value="<?php echo $invoice->date_issued; ?>"/>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="due_date" class="bold block-label">Due Date <span style="color:red;">*</span></label>
                                            <input type="date" class="form-control inv_due_date" id="inv_due_date" name="due_date" value="<?php echo $invoice->due_date; ?>"/>
                                        </div>         
                                        <div class="col-md-3">
                                            <label class="bold block-label">
                                                Terms
                                                <a class="link-modal-open nsm-button btn-small" id="btn-quick-add-payment-terms" href="javascript:void(0);" style="float:right;">Add New</a>
                                            </label>                                            
                                            <select class="form-select" name="terms" id="payment-terms">                                                                                                
                                                <?php foreach($terms as $term) : ?>
                                                <option <?php if(isset($terms)){ if($term->id == $invoice->terms){echo "selected";} } ?> value="<?php echo $term->id; ?>"><?php echo $term->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="row form-group mt-4">
                                        <div class="col-md-3">
                                            <label class="bold block-label">Location of sale</label>
                                            <input type="text" class="form-control" name="location_scale" value="<?php echo $invoice->location_scale; ?>">
                                        </div>                                        
                                        <div class="col-md-3">
                                            <label class="bold block-label">
                                                Tags
                                                <a class="link-modal-open nsm-button btn-small" href="javascript:void(0);" id="btn-quick-add-job-tags" style="float:right;">Add New</a>
                                            </label>     
                                            <select class="form-select" name="tags" id="tags">
                                                <?php foreach($tags as $t){ ?>
                                                    <option value="<?= $t->name; ?>" <?php if($t->name == $invoice->tags){ echo 'selected'; } ?>><?= $t->name; ?></option>
                                                <?php } ?>
                                            </select>    
                                        </div>
                                        <div class="col-md-3">
                                            <label for="estimate_date" class="bold block-label">Invoice Type <span style="color:red;">*</span></label>
                                            <select name="invoice_type" class="form-select">
                                                <option value="Deposit" <?= $invoice->invoice_type == 'Deposit' ? 'selected="selected"' : ''; ?>>Deposit</option>
                                                <option value="Partial Payment" <?= $invoice->invoice_type == 'Partial Payment' ? 'selected="selected"' : ''; ?>>Partial Payment</option> 
                                                <option value="Final Payment" <?= $invoice->invoice_type == 'Final Payment' ? 'selected="selected"' : ''; ?>>Final Payment</option>
                                                <option value="Total Due" <?= $invoice->invoice_type == 'Total Due' ? 'selected="selected"' : ''; ?>>Total Due</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="bold">Sales Representative</label>
                                            <select class="form-select mb-3" name="user_id" id="user_id">                                            
                                                <?php foreach($users_lists as $ulist){ ?>
                                                    <option <?= $invoice->user_id == $ulist->id ? 'selected="selected"' : ''; ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>                                                                           
                                    </div>
                                    <div class="row mt-4">                                
                                        <div class="col-md-3 form-group">
                                            <label for="purchase_order" class="bold block-label">Purchase Order Number <span class="bx bx-fw bx-help-circle" id="popover-po"></span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="purchase_order" id="purchase_order" value="<?php echo $invoice->purchase_order; ?>">
                                            </div>
                                        </div>      
                                        <div class="col-md-3">
                                            <label class="bold">Shipping date</label>
                                            <input type="date" class="form-control" name="shipping_date" value="<?php echo $invoice->shipping_date; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="bold">Tracking no.</label>
                                            <input type="text" class="form-control" name="tracking_number" value="<?php echo $invoice->tracking_number; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="bold">Ship via</label>
                                            <input type="text" class="form-control" name="ship_via" value="<?php echo $invoice->ship_via; ?>">
                                        </div>                 
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-3">
                                            <label class="bold">Shipping to</label>
                                            <textarea class="form-control" style="width:100%;" name="shipping_to_address" id="shipping_address"><?php echo $invoice->shipping_to_address; ?></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="bold">Billing address</label>
                                            <textarea class="form-control" style="width:100%;" name="billing_address" id="billing_address"><?php echo $invoice->billing_address; ?></textarea>
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
                                            <th><b>Item</b></th>
                                            <th><b>Type</th>
                                            <th width="100px" id="qty_type_value"><b>Quantity</b></th>
                                            <th width="100px"><b>Price</b></th>
                                            <th width="100px"><b>Discount</b></th>
                                            <th><b>Tax(%)</b></th>
                                            <th><b>Total</b></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body">
                                        <?php 
                                        $i = 0;
                                        foreach($itemsDetails as $data){ ?>

                                                        <tr id="ss">
                                                            <td width="40%">
                                                                <div class="hidden_mobile_view">
                                                                    <input type="text" class="form-control getItems"
                                                                        onKeyup="getItems(this)" name="items[]" value="<?php echo $data->title; ?>">
                                                                    <ul class="suggestions"></ul>
                                                                    <input type="hidden" name="itemid[]" id="itemid" class="itemid" value="<?php echo $data->items_id; ?>">
                                                                </div>
                                                                <div class="show_mobile_view">
                                                                <?php echo $data->item; ?>
                                                                </div>
                                                            </td>
                                                            <td width="15%">
                                                                <div class="hidden_mobile_view">
                                                                    <select name="item_type[]" class="form-select">
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
                                                            <td width="8%">
                                                                <input data-itemid="<?php echo $i; ?>" id="quantity_<?php echo $i; ?>" value="<?php echo $data->qty; ?>" type="number" name="quantity[]" data-counter="<?php echo $i; ?>" min="0" class="form-control quantity mobile_qty valid" aria-invalid="false">
                                                            </td>
                                                            <td width="10%">
                                                                <input data-itemid="<?php echo $i; ?>" id="price_<?php echo $i; ?>" value="<?php echo $data->iCost; ?>" type="number" name="price[]" data-counter="<?php echo $i; ?>" class="form-control price text-end hidden_mobile_view" placeholder="Unit Price"><input type="hidden" class="priceqty" id="priceqty_<?php echo $i; ?>" value="<?php echo $aaa = $data->iCost * $data->qty; ?>"><div class="show_mobile_view"><span class="price"><?php echo $data->iCost; ?></span></div>
                                                            </td>
                                                            <td width="10%" class="hidden_mobile_view">
                                                                <input type="number" name="discount[]" value="<?php echo $data->discount; ?>" class="form-control text-end discount" data-counter="<?php echo $i; ?>" id="discount_<?php echo $i; ?>">
                                                            </td>
                                                            <td width="8%" class="hidden_mobile_view">
                                                                <input type="text" data-itemid="<?php echo $i; ?>" class="form-control text-end tax_change valid" name="tax[]" data-counter="<?php echo $i; ?>" id="tax1_<?php echo $i; ?>" min="0" value="<?php echo $data->tax; ?>" aria-invalid="false" readonly="">
                                                            </td>
                                                            <td style="width:10%;text-align: center" class="hidden_mobile_view">
                                                                <input type="hidden" class="form-control " name="total[]"
                                                                    data-counter="0" id="sub_total_text<?php echo $i; ?>" min="0" value="<?php echo $data->total; ?>">
                                                                    <span id="span_total_<?php echo $i; ?>" class="span-input"><?php echo $data->total; ?></span>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="remove nsm-button danger" id="<?php echo $i; ?>"><i class="bx bx-fw bx-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                    
                                    <input type="hidden" name="count" value="<?php echo $i; ?>" id="count">
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
                                                        <option value="%" <?= $invoice->deposit_request_type == '%' ? 'selected="selected"' : ''; ?>>Percentage %</option>
                                                        <option value="$" <?= $invoice->deposit_request_type == '$' ? 'selected="selected"' : ''; ?>>Deposit amount $</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 form-group mb-3">
                                                    <div class="input-group">
                                                        <input type="text" name="deposit_amount"  value="<?php echo $invoice->deposit_request; ?>" class="form-control"
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
                                                    <td colspan="2" align="right" style="padding-right: 33px;">$ <span id="span_sub_total_invoice"><?php echo number_format(intval($invoice->sub_total) ,2); ?></span>
                                                        <input type="hidden" name="subtotal" id="item_total" value="<?php echo $invoice->sub_total; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="is_tax_exempted" value="1" <?= $invoice->no_tax == 1 ?  'checked="checked"' : ''; ?> id="chk-tax-exempted">
                                                            <label class="form-check-label" for="chk-tax-exempted">
                                                                Taxes (check if no tax)
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td colspan="2" align="right">
                                                        <div style="display:none;">
                                                        $ <span id="total_tax_"><?php echo number_format(intval($invoice->taxes), 2); ?></span>
                                                        </div>
                                                        <input type="number" step="any" min="0" class="form-control" id="total_tax_input" name="taxes" value="<?= $invoice->taxes > 0 ? number_format($invoice->taxes, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                    </td>
                                                </tr>
                                                <?php if( $industrySpecificFields && array_key_exists('installation_cost', $industrySpecificFields) ){ ?>
                                                    <?php if( !in_array('installation_cost', $disabled_industry_specific_fields) ){ ?>
                                                        <tr>
                                                            <td class="bold">Installation Cost</td>                                                    
                                                            <td colspan="2" align="right">
                                                                <input type="number" step="any" min="0" class="form-control" id="adjustment_ic" name="installation_cost" value="<?= $invoice->installation_cost > 0 ? number_format($invoice->installation_cost, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if( $industrySpecificFields && array_key_exists('otps', $industrySpecificFields) ){ ?>
                                                    <?php if( !in_array('otps', $disabled_industry_specific_fields) ){ ?>
                                                        <tr>
                                                            <td class="bold">One time (Program and Setup)</td>                                                    
                                                            <td colspan="2" align="right">
                                                                <input type="number" step="any" min="0" class="form-control" id="otps" name="program_setup" value="<?= $invoice->program_setup > 0 ? number_format($invoice->program_setup, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                
                                                <?php if( $industrySpecificFields && array_key_exists('monthly_monitoring_rate', $industrySpecificFields) ){ ?>
                                                    <?php if( !in_array('monthly_monitoring_rate', $disabled_industry_specific_fields) ){ ?>
                                                        <tr>
                                                            <td class="bold">Monthly Monitoring</td>                                                    
                                                            <td colspan="2" align="right">
                                                                <input type="number" step="any" min="0" class="form-control" id="adjustment_mm" name="monthly_monitoring" value="<?= $invoice->monthly_monitoring > 0 ? number_format($invoice->monthly_monitoring, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="adjustment_name" id="adjustment_name" value="<?php echo $invoice->adjustment_name; ?>" placeholder="Adjustment Name" class="form-control" style="border:1px dashed #d1d1d1;width:80%;margin-right:4px; display:inline;">
                                                        <span class="bx bx-fw bx-help-circle" id="popover-request-adjustment"></span>
                                                    </td>
                                                    <td colspan="2" align="right">
                                                        <input type="number" name="adjustment_value" id="adjustment_input" value="<?php if(empty($invoice->adjustment_value)){ echo "0"; }else{echo $invoice->adjustment_value; } ?>" class="form-control adjustment_input" style="width:50%;text-align:right;">                                                        
                                                        <span id="adjustmentText" style="display:none;"><?php echo $invoice->adjustment_value; ?></span>
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Markup $<span id="span_markup"></td> -->
                                                    <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                                    <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                <!-- </tr> -->
                                                <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                                    <td class="bold">Amount Saved</td>
                                                    <td></td>
                                                    <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">
                                                        <?php $late_days_text = ""; ?>
                                                        <?php if($total_late_days > 0) { ?>
                                                                <?php $late_days_text = "(" . $total_late_days . " Day/s)"; ?>
                                                        <?php } ?>
                                                        Late Fee <?php echo $late_days_text ?>
                                                    </td>                                                    
                                                    <td colspan="2" align="right">
                                                        <!-- $ <span id="late_fee"><?php //echo number_format(intval($invoice->late_fee), 2); ?></span> -->
                                                        <input type="number" step="any" min="0" class="form-control late_fee" id="late_fee" name="late_fee" value="<?= $invoice->late_fee > 0 ? number_format($invoice->late_fee, 2, ".","") : number_format($dlate_fee,2); ?>" required="" style="width:50%;text-align:right;" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="bold">Grand Total</td>                                                    
                                                    <td class="text-end" style="padding-right: 33px;">
                                                        <?php if($invoice->late_fee > 0) { ?>
                                                            <b>$ <span id="grand_total"><?php echo number_format(intval($invoice->grand_total), 2); ?></span></b>
                                                            <input type="hidden" name="grand_total" id="grand_total_input" value="<?php echo $invoice->grand_total; ?>">
                                                        <?php } else { ?>
                                                            <b>$ <span id="grand_total"><?php echo number_format(intval($invoice->grand_total + $dlate_fee), 2); ?></span></b>
                                                            <input type="hidden" name="grand_total" id="grand_total_input" value="<?php echo $invoice->grand_total + $dlate_fee; ?>">
                                                        <?php } ?>

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
                                    <textarea name="message_to_customer" cols="40" rows="2" class="form-control ckeditor"><?php echo $invoice->message_to_customer; ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <h5>Terms &amp; Conditions <span class="bx bx-fw bx-help-circle" id="popover-request-tc"></span></h5>
                                    <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control ckeditor editor1_tc"><?php echo $invoice->terms_and_conditions; ?></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <button class="nsm-button primary" id="btn-update-invoice">Save</button>                                    
                                    <a href="<?php echo url('invoice') ?>" class="nsm-button">Cancel</a>
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
                                        <input class="form-check-input" type="radio" name="payment_term_type" id="payment-term-type-2" value="2" >
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
<div class="modal fade" id="item_list" tabindex="-1"  aria-labelledby="item_listLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:5%;margin-left:31%;">
        <div class="modal-content" style="width:700px !important;">
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
                                <?php foreach($items as $item){ ?>
                                    <?php $item_qty = get_total_item_qty($item->id); ?>
                                    <?php //if ($item_qty[0]->total_qty > 0) { ?>
                                        <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                            <td class="nsm-text-primary">
                                                <button type="button"  data-dismiss="modal" class='nsm nsm-button default select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="1" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-plus-medical'></i></button>
                                            </td>
                                            <td class="nsm-text-primary"><?php echo $item->title; ?></td>
                                            <td class="nsm-text-primary"><?php echo $item->type; ?></td>
                                            <td><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : "0"; ?></td>
                                            <td style="text-align:right;"><?php echo $item->price; ?></td>                                            
                                        </tr>
                                    <?php //} ?>
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

$(document).ready(function(){
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

    $('#invoice_form').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'invoice/_update_invoice';

        for ( instance in CKEDITOR.instances ){
            CKEDITOR.instances[instance].updateElement();
        }        

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data:new FormData(this),
            processData:false,
            contentType:false,
            success: function(data) {    
                $('#btn-update-invoice').html('Save');                   
                if (data.is_success) {
                    Swal.fire({
                        text: "Invoice was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.href = base_url + 'invoice';    
                        //}
                    });    
                }else{
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
                $('#btn-update-invoice').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#new_customer_form").submit(function(e) {        
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: base_url + "customer/_quick_save_customer",
            data: $('#new_customer_form').serialize(),
            dataType:'json',
            success: function(response)
            {
                $('#NEW_CUSTOMER_MODAL_CLOSE').html('Save');
                if( response.is_success == 1 ){
                    $('#new_customer').modal('hide');    
                    
                    $("#customer_id").append(`<option value="${response.customer_id}">${response.customer_name}</option>`);
                    $("#customer_id").val(response.customer_id);
                    $("#customer_id").trigger('change');
                }else{
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
            beforeSend: function(){
                $('#NEW_CUSTOMER_MODAL_CLOSE').html('Saving');
            }
        });
    });

    $("#quick-add-items-list").nsmPagination({itemsPerPage:10});
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

    $('#add-item').on('click',function(){
        $('#item_list').modal('show');
    });

    $('#btn-quick-add-job-tags').on('click', function(){
        $('#quick-add-job-tag-form').trigger("reset");
        $('#modal-quick-add-job-tag').modal('show');
    });

    $('#quick-add-job-tag-form').on('submit', function(e){
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
                }else{
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

    $('#btn-quick-add-payment-terms').on('click', function(){
        $('#frm-quick-add-payment-term').trigger("reset");
        $('#modalAddTerms').modal('show');
    });

    $('#frm-quick-add-payment-term').on('submit', function(e){
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
                    var payment_term_id   = data.payment_term_id
                    $('#payment-terms').append($('<option>', {
                        value: payment_term_id,
                        text: payment_term_name
                    }));
                    $('#payment-terms').val(payment_term_id);
                }else{
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

    $('#customer_id').change(function(){
        var id  = $(this).val();    
        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/addLocationajax",
            data: {id : id },
            dataType: 'json',
            success: function(response){            
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
                '" height="370" width="100%" style=""></iframe>';
                $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');
            },
            error: function(response){            
        
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
