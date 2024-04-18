<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/invoice/autosave.js")?>"></script> -->

<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/pages/job/css/job_new'); ?>
<style>
.show_mobile_view{
    display:none;
}
.row-item-total{
    text-align:right;
}
.invoice-item-header{
    background-color:#6a4a86;
    padding:10px;
    color:#ffffff;
    font-size:12px;
    display:block;
    font-weight:bold;
}
.custom-table-button{
    background-color: #ffffff;
    margin-bottom: 0px !important;
    padding: 2px;
    margin-left: 3px !important;
    display: inline-block;
    font-size: 12px;
    padding-right:8px;
}
.custom-table-button:hover{
    background-color: #ffffff !important;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>
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
            <?php echo form_open_multipart(null, ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>
            <div class="row g-3 align-items-start">
                <div class="col-md-4">
                    <div class="nsm-card primary" style="margin-top: 30px;">
                        <div class="nsm-card-header d-block">
                            <div class="nsm-card-title"><span><i class='bx bx-list-plus'></i>&nbsp;Invoice Details</span></div>
                        </div>

                        <div class="nsm-card-content">
                            <div class="form-group">
                                <label for="purchase_order">Purchase Order Number</label>
                                <span class="bx bxs-help-circle" id="help-popover-purchase-order-number"></span>
                                <input type="text" class="form-control" name="purchase_order" id="purchase_order">
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-5 form-group">
                                    <label for="date_issued">Date Issued</label>
                                    <input type="date" class="form-control default-datepicker" name="date_issued" required/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control default-datepicker" name="due_date" required/>
                                </div>
                            </div>                            
                            <div class="form-group mt-3">
                                <div class="d-flex justify-content-between">
                                    <h6>Job Tag</h6>
                                    <a class="nsm-link d-flex align-items-center btn-quick-add-job-tag" href="javascript:void(0);">
                                        <span class="bx bx-plus"></span>Create Job Tag
                                    </a>
                                </div>                                  
                                <select id="job_tag" name="job_tag" class="form-control">
                                    <option value="">Select Tags</option>
                                    <?php if(!empty($tags)): ?>
                                        <?php foreach ($tags as $tag): ?>
                                            <?php
                                                $marker_icon = 'administrative_tools_48px.png'; 
                                                if( $tag->marker_icon != '' ){
                                                    $marker_icon = $tag->marker_icon;
                                                } 
                                            ?>
                                            <option <?php if(isset($jobs_data) && $jobs_data->tags == $tag->name) {echo 'selected'; } ?> value="<?= $tag->id; ?>" data-image="<?= $marker_icon; ?>"><?= $tag->name; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="status">Status</label><br/>
                                <select name="status" id="status" class="form-control">
                                    <option value="Draft">Draft</option>
                                    <option value="Partially Paid">Partially Paid</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Due">Due</option>
                                    <option value="Overdue">Overdue</option>
                                </select>
                            </div>  
                            <div class="form-group grp-amount-paid mt-3" style="display:none;">
                                <label for="payment-method">Payment Method</label>
                                <select name="payment_method" id="payment-method" class="form-control">
                                    <option value="cash">Cash</option>
                                    <option value="square">Credit Card</option>
                                    <option value="square">Check</option>                                    
                                </select>
                            </div> 
                            <div class="form-group grp-amount-paid mt-3" style="display:none;">
                                <label for="reference-number">Payment Date</label>
                                <input type="date" class="form-control default-datepicker" name="payment_date"/>
                            </div>                               
                            <div class="form-group grp-amount-paid mt-3" style="display:none;">
                                <label for="purchase_order">Amount Paid</label>
                                <input type="number" step="any" value="0" class="form-control" name="amount_paid" id="amount-paid">
                            </div>  
                            <div class="form-group grp-amount-paid mt-3" style="display:none;">
                                <label for="reference-number">Reference Number</label>
                                <input type="text" class="form-control" name="reference_number" id="reference-number"/>
                            </div>  
                            <div class="form-group mt-3">
                                <label for="status">Attachment</label>
                                <span class="bx bxs-help-circle" id="help-popover-attachment"></span><br />                                
                                <span class="btn btn-default btn-md fileinput-button vertical-top"><span class="fa fa-upload"></span> Upload File <input data-fileupload="attachment-file" name="attachment_file" type="file"></span>
                            </div>                            
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    
                    <div class="nsm-card primary" style="margin-top: 30px;">
                        <div class="nsm-card-header d-block">
                            <div class="nsm-card-title"><span><i class='bx bxs-wrench'></i>&nbsp;Job Details</span></div>
                        </div>

                        <div class="nsm-card-content">
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <div class="d-flex justify-content-between">
                                        <h6>Customer</h6>
                                        <a class="nsm-link d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#new_customer" href="javascript:void(0);">
                                            <span class="bx bx-plus"></span>Create Customer
                                        </a>
                                    </div>  
                                    <select name="customer_id" id="customer-id" class="form-control searchable-dropdown" required>
                                        <option>Select a customer</option>
                                        <?php foreach ($customers as $customer):?>
                                        <option <?= $default_cust_id == $customer->prof_id ? 'selected="selected"' : ''; ?> value="<?php echo $customer->prof_id?>"><?php echo $customer->first_name."&nbsp;".$customer->last_name;?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-7 form-group">
                                    <label for="job_name">Business Name <small class="help help-sm">(optional)</small></label>
                                    <input type="text" name="business_name" id="business_name" class="nsm-field form-control" value="<?php echo $clients->business_name; ?>" />
                                </div>                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-5 form-group">
                                    <label for="job_name">Job Name</label>
                                    <input type="text" class="form-control" value="" name="job_name" id="job_name" />
                                </div>
                                <div class="col-md-7 form-group">
                                    <label for="job_location">Job Location</label>     
                                    <input type="text" class="form-control" value="" name="jobs_location" id="invoice_jobs_location" /> 
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12 form-group mt-4">
                                    <label for="job_name">Message to Customer</label>
                                    <span class="bx bxs-help-circle" id="help-popover-customer-message"></span>
                                    <textarea name="message_to_customer" id="ck-message-to-customer" class="form-control">Thank you for your business.</textarea>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="job_name">Terms & Conditions</label>
                                    <span class="bx bxs-help-circle" id="help-popover-terms-conditions"></span>
                                    <textarea name="terms_and_conditions" id="ck-terms-conditions" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="nsm-card primary" style="margin-top: 30px;">
                        <div class="nsm-card-header d-block">
                            <div class="nsm-card-title"><span><i class='bx bx-list-ol' ></i>&nbsp;Invoice items</span></div>
                        </div>

                        <div class="col-md-12 table-responsive">
                            <input type="hidden"  value="0" id="row-product-count">    
                            <span class="invoice-item-header">
                                Products
                                <button type="button" class="nsm-button small ms-0 mb-4 btn-add-product custom-table-button"><i class='bx bx-plus' style="position:relative;top:1px;color:#000000 !important;"></i> Add</button>
                            </span>                        
                            <table class="nsm-table" id="product-list-table">
                                <thead>                                    
                                    <tr>                                        
                                        <td class="ProductName" style="width:40% !important;">Name</td>
                                        <td class="ProductQuantity" style="width:10% !important;">Quantity</td>
                                        <td class="ProductPrice" style="width:15% !important;">Price</td>
                                        <td class="ProductDiscount" style="width:10% !important;">Discount</td>
                                        <td class="ProductTax" style="width:10% !important;">Tax (<?= $default_tax_percentage ?>)</td>
                                        <td class="ProductTotal" style="width:15% !important;text-align:right;">Total</td>
                                        <td class="ProductAction" style="width:5% !important;"></td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                            <input type="hidden"  value="0" id="row-service-count">    
                            <span class="invoice-item-header">
                                Services
                                <button type="button" class="nsm-button small ms-0 mb-4 btn-add-services custom-table-button"><i class='bx bx-plus' style="position:relative;top:1px;color:#000000 !important;"></i> Add</button>
                            </span>                        
                            <table class="nsm-table" id="service-list-table">
                                <thead>                                    
                                    <tr>                                        
                                        <td class="ServiceName" style="width:40% !important;">Name</td>     
                                        <td class="ServiceQuantity" style="width:10% !important;">Quantity</td>                                   
                                        <td class="ServicePrice" style="width:15% !important;">Price</td>
                                        <td class="ServiceDiscount" style="width:10% !important;">Discount</td>
                                        <td class="ServiceTax" style="width:10% !important;">Tax (<?= $default_tax_percentage ?>)</td>
                                        <td class="ServiceTotal" style="width:15% !important;text-align:right;">Total</td>
                                        <td class="ServiceAction" style="width:5% !important;"></td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>                        
                        <hr />
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Request a Deposit</h5>
                                        <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                        <input type="hidden" value="$" name="deposit_request_type" class="form-control" />    
                                        <div class="input-group">
                                            <div class="input-group-text">$</div>
                                            <input type="number" step="any" name="deposit_amount" value="0" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Payment Schedule</h5>
                                        <span class="help help-sm help-block">Split the balance into multiple payment milestones.</span>
                                        <p><a href="#" id="manage-payment-schedule" style="color: #02A32C;"><i class="bx bx-fw bxs-plus-square" aria-hidden="true"></i> Manage payment schedule</a></p>
                                        <div id="payment-schedule-input" style="display: none;">
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="payment-schedule-date" class="form-label">Payment schedule:</label>
                                                    <input type="date" class="form-control nsm-field" id="payment-schedule-date" name="payment-schedule-date">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="payment-schedule-months" class="form-label">Months to pay:</label>
                                                    <select class="form-select nsm-field" id="payment-schedule-months">
                                                            <option value="">Select month</option>
                                                        <option value="1">1 month</option>
                                                        <option value="2">2 months</option>
                                                        <option value="3">3 months</option>
                                                        <option value="4">4 months</option>
                                                        <option value="5">5 months</option>
                                                        <option value="6">6 months</option>
                                                        <option value="7">7 months</option>
                                                        <option value="8">8 months</option>
                                                        <option value="9">9 months</option>
                                                        <option value="10">10 months</option>
                                                        <option value="11">11 months</option>
                                                        <option value="12">12 months</option>
                                                        <option value="13">13 months</option>
                                                        <option value="14">14 months</option>
                                                        <option value="15">15 months</option>
                                                        <option value="16">16 months</option>
                                                        <option value="17">17 months</option>
                                                        <option value="18">18 months</option>
                                                        <option value="19">19 months</option>
                                                        <option value="20">20 months</option>
                                                        <option value="21">21 months</option>
                                                        <option value="22">22 months</option>
                                                        <option value="23">23 months</option>
                                                        <option value="24">24 months</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <span>Monthly payment:</span>
                                            <span id="monthly_amount">$0.00</span>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <h5>Accepted payment methods</h5>
                                        <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                                    </div>
                                    <div class="col-md-6">  
                                        <div class="row">   
                                            <div class="col-md-3">                                                                            
                                                <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                    <input type="checkbox" name="credit_card_payments" value="1" <?=isset($paymentMethods) && in_array('Credit Card', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="credit-card-payments">
                                                    <label for="credit-card-payments"><span>Credit Card</span></label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">   
                                                <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                    <input type="checkbox" name="bank_transfer" value="1" <?=isset($paymentMethods) && in_array('Bank Transfer', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="bank-transfer">
                                                    <label for="bank-transfer"><span>Bank Transfer</span></label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">   
                                                <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                    <input type="checkbox" name="instapay" value="1" <?=isset($paymentMethods) && in_array('Instapay', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="instapay-payment">
                                                    <label for="instapay-payment"><span>Instapay</span></label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">   
                                                <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                    <input type="checkbox" name="check" value="1" <?=isset($paymentMethods) && in_array('Check', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="check-payment">
                                                    <label for="check-payment"><span>Check</span></label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">   
                                                <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                    <input type="checkbox" name="cash" value="1" <?=isset($paymentMethods) && in_array('Cash', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="cash-payment">
                                                    <label for="cash-payment"><span>Cash</span></label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">   
                                                <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                    <input type="checkbox" name="deposit" value="1" <?=isset($paymentMethods) && in_array('Deposit', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="deposit-payment">
                                                    <label for="deposit-payment"><span>Deposit</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                            
                                        <span class="help help-sm help-block" style="padding:10px; display:block;text-align:left;">Your client can pay your invoice using credit card or bank account online. You will be notified when your client makes a payment and the money will be transferred to your bank account automatically. </span>
                                        <div class="float-left mini-stat-img mr-4" style="padding:10px;"><img src="<?php echo $url->assets ?>frontend/images/credit_cards.png" alt=""></div>                                            
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
                                        <input type="hidden" name="subtotal" id="item_subtotal" value="0" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-title">Taxes</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        $ <span id="span_total_tax_invoice">0.00</span>
                                        <input type="hidden" name="taxes" id="item_total_tax" value="0" />
                                    </div>                                    
                                    <?php //if( in_array($cid, adi_company_ids()) ){ ?>
                                    <div class="col-12 col-md-6 d-flex align-items-center">
                                        <label class="content-title">Installation Cost</label>
                                    </div>
                                    <div class="col-12 col-md-3 offset-md-3 text-end">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="any" min=0 name="adjustment_ic" id="adjustment-ic" class="nsm-field form-control text-end" value="0">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center">
                                        <label class="content-title">One time (Program and Setup)</label>
                                    </div>
                                    <div class="col-12 col-md-3 offset-md-3 text-end">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="any" min=0 name="adjustment_otps" id="adjustment-otps" class="nsm-field form-control text-end" value="0">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center">
                                        <label class="content-title">Monthly Monitoring</label>
                                    </div>
                                    <div class="col-12 col-md-3 offset-md-3 text-end">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="any" min=0 name="monthly_monitoring" id="adjustment-mm" class="nsm-field form-control text-end" value="0">
                                        </div>
                                    </div>
                                    <?php //} ?>
                                    <div class="col-12 col-md-6 d-flex align-items-center">
                                        <input type="text" class="nsm-field form-control" placeholder="Adjustment Name" name="adjustment_name" id="adjustment_name" style="border: 1px dashed #d1d1d1;">                                                        
                                        <i id="help-popover-adjustment" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i>
                                    </div>
                                    <div class="col-12 col-md-3 offset-md-3 text-end">
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="any" min=0 name="adjustment_value" id="adjustment-input" class="nsm-field form-control text-end" value="0">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex align-items-center">
                                        <label class="content-title">Is Tax Exempted</label>
                                    </div>
                                    <div class="col-12 col-md-3 offset-md-3 text-end">
                                        <div class="input-group">
                                            <select class="form-control" id="tax-exempted" name="is_tax_exempted" style="text-align:center;">
                                                <option value="1">Yes</option>
                                                <option value="0" selected="selected">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <label class="content-title">Grand Total ($)</label>
                                    </div>
                                    <div class="col-12 col-md-6 text-end fw-bold">
                                        $ <span id="grand_total">0.00</span>
                                        <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                        <input type="hidden" name="grand_total" id="grand_total_input" value='0'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="button" class="nsm-button" onclick="location.href='<?php echo url('invoice') ?>'">Cancel</button>                    
                    <button type="submit" class="nsm-button primary">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
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
                                    <td>On Hand</td>                                                
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
                                    </tr>
                                    
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


</div>      
<?php include viewPath('v2/includes/job/quick_add'); ?>
<?php include viewPath('v2/includes/inventory/quick_add_item_modals'); ?>
<?php include viewPath('v2/pages/job/modals/new_customer'); ?>
<?php include viewPath('v2/includes/footer'); ?>

<!-- Main Script -->
<script>
$(document).ready(function() {
    var default_tax_percentage = '<?= $default_tax_percentage; ?>';
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

    $("#product-list-table").nsmPagination();    
    $("#service-list-table").nsmPagination();    

    CKEDITOR.replace( 'ck-message-to-customer', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '140px',
    });

    CKEDITOR.replace( 'ck-terms-conditions', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '140px',
    });
    
    CKEDITOR.editorConfig = function( config ) {
        config.height = '200px';
    };

    $('#modal-edit-product-stock').modal({backdrop: 'static', keyboard: false});
    $('#modal-product-list').modal({backdrop: 'static', keyboard: false});
    $('#modal-services-list').modal({backdrop: 'static', keyboard: false});

    $('#help-popover-customer-message').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Add a message that will be displayed on the invoice.';
        } 
    });

    $('#manage-payment-schedule').on('click', function(event) {
        event.preventDefault();
        var paymentScheduleContainer = $('#payment-schedule-input');

        if (paymentScheduleContainer.is(':hidden')) {
        paymentScheduleContainer.show();
        $(this).html('<i class="bx bx-fw bxs-minus-square" aria-hidden="true"></i> Hide payment schedule');
        return;
        } 

      paymentScheduleContainer.hide();
      $(this).html('<i class="bx bx-fw bxs-plus-square" aria-hidden="true"></i> Manage payment schedule');
  
    });

    $('#payment-schedule-months').on('change', function() {
        var selectedMonths = $(this).val();
        var grandTotal = parseFloat($('#grand_total_input').val());
        
        if (!isNaN(grandTotal) && !isNaN(selectedMonths) && selectedMonths !== '') {
            var monthlyPayment = grandTotal / selectedMonths;
            $('#monthly_amount').html('$'+monthlyPayment.toFixed(2));
        }
    
    })

    $('#help-popover-terms-conditions').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Mention your company\'s Terms and Conditions that will appear on the invoice.';
        } 
    });

    $('#help-popover-attachment').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Attach files to this invoice. Allowed type: pdf, doc, docx, png, jpg, gif.';
        } 
    });

    $('#help-popover-purchase-order-number').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'If you want to display the purchase order number on invoice.';
        } 
    });

    $('#help-popover-adjustment').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        } 
    }); 

    $("#job_tag").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    function formatState (opt) {
        if (!opt.id) {
            return opt.text;
        } 
        var optimage = $(opt.element).attr('data-image'); 
        if(!optimage){
           return opt.text;
        } else {                    
            var $opt = $(
               '<span><img src="<?php echo base_url('uploads/icons/'); ?>' + optimage + '" style="width: 20px; margin-top: -4px;" /> ' + opt.text + '</span>'
            );
            return $opt;
        }
    }

    $('.btn-quick-add-job-tag').on('click', function(){
        $('#quick_add_job_tag').modal('show');
    });

    $('.btn-add-product').on('click', function(){
        $('#modal-product-list').modal('show');
        $('#search_product').val('');
        loadAddProductList();
    });

    $('.btn-add-services').on('click', function(){
        $('#modal-services-list').modal('show');
        $('#search_services').val('');
        loadAddServicesList();
    });

    $(document).on('click', '.edit-product-stock', function(){
        var storageid   = $(this).attr('data-storageid');
        var itemid      = $(this).attr('data-itemid');
        var containerid = 'product-stock-container';

        $('#modal-product-list').modal('hide');
        $('#modal-edit-product-stock').modal('show');
        loadEditProductStock(storageid, itemid, containerid);
    });

    $('#status').on('change', function(){
        var selected = $(this).val();
        if( selected == 'Partially Paid' ){
            $('.grp-amount-paid').show();
        }else{
            $('.grp-amount-paid').hide();
        }
    });

    $('#search_product').on('input', debounce(function() {
        var query = $(this).val();
        productSearch(query);
    }, 500));

    
    $('#search_services').on('input', debounce(function() {
        var query = $(this).val();
        serviceSearch(query);
    }, 500));

    $('#tax-exempted').on('change', function(){
        recomputeTotalSummary();
    });

    function recomputeProductRowTotal(row_number){
        var row_product_quantity = $('.row-product-qty-'+row_number).val();
	    var row_product_price    = $('.row-product-price-'+row_number).val();
        var row_product_discount = $('.row-product-discount-'+row_number).val();
        var row_product_total    = computeItemRowTotal(row_product_quantity,row_product_price,row_product_discount);
        var row_product_tax      = computeItemTax(default_tax_percentage, row_product_total);
        var row_with_tax_total   = parseFloat(row_product_total) + parseFloat(row_product_tax);

        $('.row-product-tax-'+row_number).val(row_product_tax);
        $('.row-product-total-'+row_number).val(row_with_tax_total);
        $('.row-product-total-label-'+row_number).text(row_with_tax_total.toFixed(2));

        recomputeTotalSummary();
    }

    function recomputeTotalSummary(){
        var product_sub_total = computeProductSubTotal();
        var product_total_tax = computeProductTotalTax(default_tax_percentage);

        var service_sub_total = computeServicesSubTotal();
        var service_total_tax = computeServicesTotalTax(default_tax_percentage);

        var invoice_sub_total = parseFloat(product_sub_total) + parseFloat(service_sub_total);
        var invoice_tax_total = parseFloat(product_total_tax) + parseFloat(service_total_tax);

        $('#span_sub_total_invoice').html(invoice_sub_total.toFixed(2));
        $('#item_subtotal').val(invoice_sub_total.toFixed(2));        

        $('#span_total_tax_invoice').html(invoice_tax_total.toFixed(2))
        $('#item_total_tax').val(invoice_tax_total.toFixed(2));

        var adjustmentIdSelectors = ['adjustment-ic','adjustment-otps','adjustment-mm', 'adjustment-input'];
        var total_adjustment_selectors = 0;
        adjustmentIdSelectors.forEach(selector => {
            var $element = document.getElementById(selector);
            if ($element) {
                total_adjustment_selectors = parseFloat(total_adjustment_selectors) + parseFloat($element.value);                
            }
        });

        var is_tax_exempted = $('#tax-exempted').val();
        if( is_tax_exempted == 1 ){
            var grand_total = parseFloat(invoice_sub_total) + parseFloat(total_adjustment_selectors);
        }else{
            var grand_total = parseFloat(invoice_sub_total) + parseFloat(invoice_tax_total) + parseFloat(total_adjustment_selectors);
        }
        
        $('#grand_total').html(grand_total.toFixed(2));
        $('#grand_total_input').val(grand_total.toFixed(2));

        $('#monthly_amount').text('$' + grand_total.toFixed(2))
    }

    //Adjustments
    $(document).on('input', '#adjustment-ic, #adjustment-otps, #adjustment-mm, #adjustment-input', function(){
        recomputeTotalSummary();
    });

    //Products
    $(document).on('input', '.row-product-qty, .row-product-discount, .row-product-price', function(){
        var row_number = $(this).attr('data-row');
        recomputeProductRowTotal(row_number)
    });

    $(document).on('click', '.btn-delete-item-row', function(){
        var row_number = $(this).attr('data-row');
        $(this).closest('tr').fadeOut(1200,function(here){ 
            $(this).closest('tr').remove();          
        });    
        recomputeProductRowTotal(row_number);
    });

    $(document).on('click', '.add-product', function(){
        var product_name   = $(this).attr('data-productname');
        var product_id     = $(this).attr('data-itemid');
        var product_price  = $(this).attr('data-itemprice');
        var product_onhand = $(this).attr('data-onhand');
        var storage_id     = $(this).attr('data-storageid');
        var product_tax    = computeItemTax(default_tax_percentage, product_price);
        var product_total  = parseFloat(product_price) + parseFloat(product_tax);

        if( product_onhand <= 0 ){
            Swal.fire({
                title: 'Error',
                text: 'Cannot add item. Item is currently out of stock.',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        }else{
            var rowcount = parseInt($("#row-product-count").val()) + 1;
            $("#row-product-count").val(rowcount);

            var row_html = "<tr><td><label class='row-item-name'>"+product_name+"</label><input data-row='"+rowcount+"' type='hidden' name='productIds[]' value='"+product_id+"' /><input data-row='"+rowcount+"' type='hidden' name='storageLocIds[]' value='"+storage_id+"' /></td><td><input data-row='"+rowcount+"' type='number' name='productQty[]' step='1' min='0' max='"+product_onhand+"' value='1' class='form-control row-product-qty row-product-qty-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' name='productPrice[]' value='"+product_price+"' step='any' class='form-control row-product-price row-product-price-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' name='productDiscount[]' step='any' min='0' value='0' class='form-control row-product-discount row-product-discount-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' readonly='' name='productTax[]' value='"+product_tax+"' class='form-control row-product-tax row-product-tax-"+rowcount+"' /></td><td class='row-item-total'><span class='row-product-total-label-"+rowcount+"'>"+product_total.toFixed(2)+"</span><input type='hidden' name='productTotal[]' value='"+product_total+"' class='form-control row-product-total row-product-total-"+rowcount+"' /></td><td><a data-row='"+rowcount+"' class='remove nsm-button btn-delete-item-row'><i class='bx bx-fw bx-trash'></i></a></td></tr>";

            $("#product-list-table tbody").append(row_html);

            recomputeProductRowTotal(rowcount);
        }        
    });

    //Services
    function recomputeServiceRowTotal(row_number){
        var row_service_quantity = $('.row-service-qty-'+row_number).val();
	    var row_service_price    = $('.row-service-price-'+row_number).val();
        var row_service_discount = $('.row-service-discount-'+row_number).val();
        var row_service_total    = computeItemRowTotal(row_service_quantity,row_service_price,row_service_discount);
        var row_service_tax      = computeItemTax(default_tax_percentage, row_service_total);
        var row_with_tax_total   = parseFloat(row_service_total) + parseFloat(row_service_tax);

        $('.row-service-tax-'+row_number).val(row_service_tax);
        $('.row-service-total-'+row_number).val(row_with_tax_total);
        $('.row-service-total-label-'+row_number).text(row_with_tax_total.toFixed(2));

        recomputeTotalSummary();
    }

    $(document).on('input', '.row-service-qty, .row-service-price, .row-service-discount', function(){
        var row_number = $(this).attr('data-row');
        recomputeServiceRowTotal(row_number)
    });

    $(document).on('click', '.add-services', function(){
        var service_name   = $(this).attr('data-servicename');
        var service_id     = $(this).attr('data-itemid');
        var service_price  = $(this).attr('data-itemprice');
        var service_onhand = $(this).attr('data-onhand');
        var service_tax    = computeItemTax(default_tax_percentage, service_price);
        var service_total  = parseFloat(service_price) + parseFloat(service_tax);

        var rowcount = parseInt($("#row-service-count").val()) + 1;
        $("#row-service-count").val(rowcount);

        var row_html = "<tr><td><label class='row-item-name'>"+service_name+"</label><input data-row='"+rowcount+"' type='hidden' name='serviceIds[]' value='"+service_id+"' /></td><td><input data-row='"+rowcount+"' type='number' name='serviceQty[]' step='1' min='1' max='"+service_onhand+"' value='1' class='form-control row-service-qty row-service-qty-"+rowcount+"' readonly='' /></td><td><input data-row='"+rowcount+"' type='number' name='servicePrice[]' value='"+service_price+"' step='any' class='form-control row-service-price row-service-price-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' name='serviceDiscount[]' min='0' step='any' value='0' class='form-control row-service-discount row-service-discount-"+rowcount+"' /></td><td><input data-row='"+rowcount+"' type='number' readonly='' name='serviceTax[]' value='"+service_tax+"' class='form-control row-service-tax row-service-tax-"+rowcount+"' /></td><td class='row-item-total'><span class='row-service-total-label-"+rowcount+"'>"+service_total.toFixed(2)+"</span><input type='hidden' name='serviceTotal[]' value='"+service_total+"' class='form-control row-service-total row-service-total-"+rowcount+"' /></td><td><a data-row='"+rowcount+"' class='remove nsm-button btn-delete-item-row'><i class='bx bx-fw bx-trash'></i></a></td></tr>";

        $("#service-list-table tbody").append(row_html);

        recomputeServiceRowTotal(rowcount);  
    });

    $("#new_customer_form").submit(function(e) {    
        e.preventDefault(); 
        var form = $(this);        
        $.ajax({
            type: "POST",
            url: base_url + "/customer/add_new_customer_from_jobs",
            data: form.serialize(), 
            success: function(data)
            {
                $('#new_customer').modal('hide');
                if(data === "Success"){
                    Swal.fire({                        
                        text: "Customer added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            
                        //}
                    });                     
                }else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Cannot add data.',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            }
        });
    });    

    $('#customer-id').select2({
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

    $('#customer-id').change(function(){
        var id  = $(this).val();
        load_customer_location(id);
    });

    function load_customer_location(customer_id){
        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/addLocationajax",
            data: {id : customer_id },
            dataType: 'json',
            success: function(response){
                console.log(response['customer']);
                $("#invoice_jobs_location").val(response['customer'].mail_add + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
                // $("#customer_email").val(response['customer'].email);
                // $("#shipping_address").val(response['customer'].mail_add);
                // $("#billing_address").val(response['customer'].mail_add);
            },error: function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Cannot find customer data'
                });
            }
        });
    }

    $('#invoice_form').on('submit', function(e){
        e.preventDefault();

        var _this = $(this);
        e.preventDefault();

        var formData = new FormData(this);

        var url = base_url + "invoice/_create_invoice";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    Swal.fire({
                        //title: 'Save Successful!',
                        text: "Invoice has been saved successfully.",
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
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }

                _this.find("button[type=submit]").html("Submit");
                _this.find("button[type=submit]").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>