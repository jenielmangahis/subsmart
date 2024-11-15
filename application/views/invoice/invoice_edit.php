<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Script for autosaving form -->
<!-- <script src="<?=base_url("assets/js/invoice/autosave-update.js")?>"></script> -->
<?php include viewPath('v2/includes/header'); ?>
<link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">
    

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
            <?php echo form_open_multipart('invoice/updateInvoice', ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>

            <div class="row">
                <div class="col-12">
                    <div class="nsm-card primary">
                        <div class="">
                            <div class="row" style="background-color:white;">
                                <div class="col-md-5 form-group">
                                <input type="hidden" value="<?php echo $invoice->id; ?>" name="invoiceDataID">
                                    <label for="invoice_customer">Customer</label>
                                    <!-- <select id="invoice_customer" name="customer_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select customer">
                                    </select> -->
                                    <select name="customer_id" id="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                    <option>Select a customer</option>
                                    <?php foreach ($customers as $customer):?>
                                    <option <?php if(isset($customers)){ if($customer->prof_id == $invoice->customer_id){echo "selected";} } ?>  value="<?php echo $customer->prof_id?>"><?php echo $customer->first_name."&nbsp;".$customer->last_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                <div class="col-md-5 form-group">
                                    <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewCustomer" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Customer</a>
                                </div>
                                <div class="col-md-5 form-group">
                                <br>
                                    <label for="job_location">Job Location <small class="help help-sm">(optional)</small></label>
                                    
                                    <input type="text" class="form-control" name="jobs_location" id="invoice_jobs_location" value="<?php echo $invoice->job_location; ?>"/>
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
                                    <input type="text" class="form-control" name="job_name" id="job_name"  value="<?php echo $invoice->job_name; ?>"/>
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
                                                <option <?php if(isset($terms)){ if($term->id == $invoice->terms){echo "selected";} } ?> value="<?php echo $term->id; ?>"><?php echo $term->name . ' ' . $term->net_due_days; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Customer email</label>
                                            <input type="email" class="form-control" name="customer_email" id="customer_email" value="<?php echo $invoice->customer_email; ?>">
                                            <p><input type="checkbox"> Send later </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Location of sale</label>
                                            <input type="text" class="form-control" name="location_scale" value="<?php echo $invoice->location_scale; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Tracking no.</label>
                                            <input type="text" class="form-control" name="tracking_number" value="<?php echo $invoice->tracking_number; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>Ship via</label>
                                            <input type="text" class="form-control" name="ship_via" value="<?php echo $invoice->ship_via; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Shipping date</label>
                                            <input type="date" class="form-control" name="shipping_date" value="<?php echo $invoice->shipping_date; ?>">
                                        </div>
                                        <div class="col-md-3">
                                        <label>Tags</label> <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                            <input type="text" class="form-control" name="tags" value="<?php echo $invoice->tags; ?>">
                                        </div>
                                    <!-- </div>
                                    <div class="row form-group"> -->
                                        <div class="col-md-3">
                                            <label>Billing address</label>
                                            <textarea class="form-control" style="width:100%;" name="billing_address" id="billing_address"><?php echo $invoice->billing_address; ?></textarea>
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
                                        <input type="text" class="form-control" id="job_number" name="job_number">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="purchase_order">Purchase Order# <small class="help help-sm">(optional)</small></label>
                                    <span class="fa fa-question-circle text-ter" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional if you want to display the purchase order number on invoice." data-original-title="" title=""></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="purchase_order" id="purchase_order" value="<?php echo $invoice->purchase_order; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                            <label>Shipping to</label>
                                            <textarea class="form-control" style="width:100%;" name="shipping_to_address" id="shipping_address"><?php echo $invoice->shipping_to_address; ?></textarea>
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
                                    <input type="text" class="form-control" name="invoice_number" id="invoice_number" value="<?php echo $invoice->invoice_number; ?>" readonly/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="date_issued">Date Issued <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" id="" name="date_issued"  value="<?php echo $invoice->date_issued; ?>"/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="due_date">Due Date <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" id="" name="due_date" value="<?php echo $invoice->due_date; ?>"/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="status">Status</label><br/>
                                    <!-- <input type="text" name="status" class="form-control"> -->
                                                <select name="status" class="form-control">
                                                    <option <?php if(isset($invoice)){ if($invoice->status == "Draft"){echo "selected";} } ?>  value="Draft">Draft</option>
                                                    <option <?php if(isset($invoice)){ if($invoice->status == "Partially Paid"){echo "selected";} } ?> value="Partially Paid">Partially Paid</option>
                                                    <option <?php if(isset($invoice)){ if($invoice->status == "Paid"){echo "selected";} } ?> value="Paid">Paid</option>
                                                    <option <?php if(isset($invoice)){ if($invoice->status == "Due"){echo "selected";} } ?> value="Due">Due</option>
                                                    <option <?php if(isset($invoice)){ if($invoice->status == "Overdue"){echo "selected";} } ?> value="Overdue">Overdue</option>
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
                                        <?php 
                                        $i = 0;
                                        foreach($itemsDetails as $data){ ?>

                                                        <tr id="ss">
                                                            <td width="35%">
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
                                                            <td width="10%"><input data-itemid="<?php echo $i; ?>" id="quantity_<?php echo $i; ?>" value="<?php echo $data->qty; ?>" type="number" name="quantity[]" data-counter="<?php echo $i; ?>" min="0" class="form-control quantity mobile_qty valid" aria-invalid="false"></td>
                                                            <td width="10%"><input data-itemid="<?php echo $i; ?>" id="price_<?php echo $i; ?>" value="<?php echo $data->iCost; ?>" type="number" name="price[]" data-counter="<?php echo $i; ?>" class="form-control price hidden_mobile_view" placeholder="Unit Price"><input type="hidden" class="priceqty" id="priceqty_<?php echo $i; ?>" value="<?php echo $aaa = $data->iCost * $data->qty; ?>"><div class="show_mobile_view"><span class="price"><?php echo $data->iCost; ?></span></div></td>
                                                            <td width="10%" class="hidden_mobile_view"><input type="number" name="discount[]" value="<?php echo $data->discount; ?>" class="form-control discount" data-counter="<?php echo $i; ?>" id="discount_<?php echo $i; ?>"></td>
                                                            <td width="20%" class="hidden_mobile_view"><input type="text" data-itemid="<?php echo $i; ?>" class="form-control tax_change valid" name="tax[]" data-counter="<?php echo $i; ?>" id="tax1_<?php echo $i; ?>" min="0" value="<?php echo $data->tax; ?>" aria-invalid="false"></td>
                                                            <td style="text-align: center" class="hidden_mobile_view" width="15%"><input type="hidden" class="form-control " name="total[]"
                                                                    data-counter="0" id="sub_total_text<?php echo $i; ?>" min="0" value="<?php echo $data->total; ?>">
                                                                    $<span id="span_total_<?php echo $i; ?>"><?php echo $data->total; ?></span></td>
                                                            <td>
                                                            <a href="#" class="remove nsm-button danger" id="<?php echo $i; ?>"><i class="bx bx-fw bx-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                    
                                    <input type="hidden" name="count" value="<?php echo $i; ?>" id="count">
                                    <div class="row">
                                        <!-- <a class="link-modal-open pt-1 pl-2" href="#" id="add_another_new_invoice" style="color:#02A32C;"><span
                                                    class="fa fa-plus-square fa-margin-right" style="color:#02A32C;"></span>Add Items</a> -->
                                        <a href="#" id="add_another_new_invoice2" style="color:#02A32C;" data-toggle="modal" data-target="#item_list"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line </a>
                                        <hr style="display:inline-block; width:91%">
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-7">
                                        &nbsp;
                                        </div>
                                        <div class="col-md-5 row pr-0">
                                            <div class="col-sm-5">
                                                <label style="padding: 0 .75rem;">Subtotal</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                                $ <span id="item_total_text"> <?php echo $invoice->sub_total; ?></span>
                                                <input type="hidden" name="sub_total" id="item_total" value="<?php echo $invoice->sub_total; ?>">
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1" value="<?php echo $invoice->adjustment_name; ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                $ <input type="number" name="adjustment_input" id="adjustment_input"  value="<?php echo $invoice->adjustment_value; ?>" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </div>
                                            <div class="col-sm-3 text-right pt-2">
                                                $ <label id="adjustment_amount"><?php echo $invoice->adjustment_value; ?></label>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <label style="padding: .375rem .75rem;">Grand Total ($)</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                            <input type="hidden" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block"><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                $ <span id="grand_total"><?php echo $invoice->grand_total; ?></span>
                                                <input type="hidden" name="grand_total" id="grand_total_input"  value="<?php echo $invoice->grand_total; ?>">
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
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
                                                    <td colspan="2" align="right">$ <span id="span_sub_total_invoice"><?php echo number_format(intval($invoice->sub_total) ,2); ?></span>
                                                        <input type="hidden" name="subtotal" id="item_total" value="<?php echo $invoice->sub_total; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Taxes</td>
                                                    <td colspan="2" align="right">
                                                        <div style="display:none;">
                                                        $ <span id="total_tax_"><?php echo number_format(intval($invoice->taxes), 2); ?></span><input type="hidden" name="taxes" id="total_tax_input" value="<?php echo $invoice->taxes; ?>">
                                                        </div>
                                                        <input type="number" step="any" min="0" class="form-control" id="taxes" name="taxes" value="<?= $invoice->taxes > 0 ? number_format($invoice->taxes, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Installation Cost</td>                                                    
                                                    <td colspan="2" align="right">
                                                        <input type="number" step="any" min="0" class="form-control" id="adjustment_ic" name="installation_cost" value="<?= $invoice->installation_cost > 0 ? number_format($invoice->installation_cost, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>One time (Program and Setup)</td>                                                    
                                                    <td colspan="2" align="right">
                                                        <input type="number" step="any" min="0" class="form-control" id="program_setup" name="program_setup" value="<?= $invoice->program_setup > 0 ? number_format($invoice->program_setup, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Monthly Monitoring</td>                                                    
                                                    <td colspan="2" align="right">
                                                        <input type="number" step="any" min="0" class="form-control" id="monthly_monitoring" name="monthly_monitoring" value="<?= $invoice->monthly_monitoring > 0 ? number_format($invoice->monthly_monitoring, 2, ".","") : '0.00'; ?>" required="" style="width:50%;text-align:right;" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="adjustment_name" id="adjustment_name" value="<?php echo $invoice->adjustment_name; ?>" placeholder="Adjustment Name" class="form-control" style="width:80%;margin-right:4px; display:inline;"><span class="bx bx-fw bx-help-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span></td>
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
                                                    <td>Amount Saved</td>
                                                    <td></td>
                                                    <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input" value="0"></td>
                                                </tr>
                                                <tr style="color:blue;font-weight:bold;font-size:16px;">
                                                    <td><b>Grand Total ($)</b></td>
                                                    <td></td>
                                                    <td><b>$ <span id="grand_total"><?php echo number_format(intval($invoice->grand_total), 2); ?></span>
                                                        <input type="hidden" name="grand_total" id="grand_total_input" value="<?php echo $invoice->grand_total; ?>"></b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>


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
                                        <input type="text" name="deposit_amount"  value="<?php echo $invoice->deposit_request; ?>" class="form-control"
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
                            <br><br>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                <br>
                                    <h5>Message to Customer</h5>
                                    <span class="help help-sm help-block">Add a message that will be displayed on the invoice.</span>
                                    <textarea name="message_to_customer" cols="40" rows="2" class="form-control"><?php echo $invoice->message_to_customer; ?></textarea>
                                </div>
                                <br>
                                <div class="col-md-12">
                                <br>
                                    <h5>Terms &amp; Conditions</h5>
                                    <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the invoice.</span>
                                    <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control ckeditor editor1_tc"><?php echo $invoice->terms_and_conditions; ?></textarea>
                                </div>
                            </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                <br>
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
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <button class="nsm-button primary but" data-action="update">Update</button>                                    
                                    <a href="<?php echo url('invoice') ?>" class="btn">Cancel</a>
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
<div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script>
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
 
    $('#customer_id').change(function(){
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
