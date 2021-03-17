<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
   <style>
   .but:hover {
    font-weight: 900;
    color:black;
    }
    .but-red:hover {
    font-weight: 900;
    color:red;
    }
    .required:after {
    content:" *";
    color: red;
    }
    .input-groupss{
    position:relative;width:100%;overflow:hidden;
    }
    .input-groupss input{position:relative;height:45px;border-radius:30px;min-width:500px;box-shadow:none;border:1px solid #eaeaea;padding-left:160px;}
    .input-groupss label{position:absolute;left:0;height:48px;background:#55ccf2;padding:0px 25px;border-radius:30px;line-height:48px;font-size:18px;color:#fff;top:0;width:100px;font-weight:100;}
   </style>

    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:2%;padding-left:1.5%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 style="font-family: Sarabun, sans-serif">Submit Options Estimate</h4>
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Submit your estimate. Include a breakdown of all costs
                                for this job.
                            </li>
                        </ol> -->
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('accounting/newEstimateList') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Estimate
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="background-color:white; width:100%;padding:.5%;">
                    Submit your estimate. Include a breakdown of all costs for this job.
                </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:28px;">
                    This form can be used for any job which can be divided into stages, options, etc.   Under each listing of stages, options, etc. your have a description section to help your prospects make a better decision.  
                </div>

            </div>
            <!-- end row -->
            <?php echo form_open_multipart('accounting/savenewestimateOptions', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border" style="margin-top: -20px;">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="customers" class="required"><b>Customer</b></label>
                                    <select id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0">- none -</option>
                                        <?php foreach($customers as $c){ ?>
                                            <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <br><br><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus" aria-hidden="true"></i> New Customer</a>
                                </div>
                            </div>
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="job_location"><b>Job Location</b> (optional, select or add new one)</label>
                                    <input type="text" class="form-control" name="job_location" id="job_location"
                                           required placeholder="Enter address" autofocus
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-3">
                                    <br><br>
                                    <!-- <a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus" aria-hidden="true"></i> New Location Address</a> -->
                                </div>
                            </div>
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="job_name"><b>Job Name</b> (optional)</label>
                                    <input type="text" class="form-control" name="job_name" id="job_name"
                                           placeholder="Enter Job Name" required/>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate#</b></label>
                                    <input type="text" class="form-control" name="estimate_number" id="estimate_date"
                                           required placeholder="Enter Estimate#" autofocus value="<?php echo $auto_increment_estimate_id; ?>" 
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate Date</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                        <input type="date" class="form-control" name="estimate_date" id="estimate_date_"
                                               placeholder="Enter Estimate Date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-3">
                                    <label for="expiry_date" class="required"><b>Expiry Date</b></label>
                                    <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                        <input type="date" class="form-control" name="expiry_date" id="expiry_date_"
                                               placeholder="Enter Expiry Date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            
                            <div class="row" style="background-color:white;">
                                    <div class="col-md-3">
                                        <label for="purchase_order_number"><b>Purchase Order#</b><small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control" name="purchase_order_number"
                                            id="purchase_order_number" required placeholder="Enter Purchase Order#"
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                    </div>
                                <!-- </div>
                                <div class="row" style="background-color:white;"> -->
                                    <div class="col-md-3">
                                        <label for="zip" class="required"><b>Estimate Status</b></label>
                                        <!-- <input type="text" class="form-control" name="zip" id="zip" required
                                            placeholder="Enter Estimate Status"/> -->
                                            <select name="status" class="form-control">
                                                    <option value="product">Draft</option>
                                                    <option value="material">Submitted</option>
                                                    <option value="service">Approved</option>
                                                    <option value="service">Declined</option>
                                                    <option value="service">Schedule</option>
                                                </select>
                                    </div>
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;">
                                <div class="col-md-3">
                                    <a href="#" style="color:#02A32C;"><b>Items list</b></a> | <b>Items Summary</b>
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

                            <div class="row" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-14 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <input type="hidden" name="count2" value="0" id="count2">
                                        <thead style="background-color:#E9E8EA;">
                                        <tr>
                                            <th><b>Option-1 Items</b></th>
                                            <th><b>Type</b></th>
                                            <th width="100px"><b>Quantity</b></th>
                                            <th width="100px"><b>Price</b></th>
                                            <th width="100px"><b>Discount</b></th>
                                            <th width="100px"><b>Total</b></th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body_option1">
                                        <tr>
                                        <td>
                                                <input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="items[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select></td>
                                            <td><input type="number" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <!-- <td><input type="text" class="form-control" name="location[]"></td> -->
                                            <td><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" readonly></td>
                                            <input type="hidden" class="form-control tax" name="tax[]"
                                                       data-counter="0" id="tax_1_0" min="0" value="0">
                                            <td><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_option1" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> -->
                                    <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list" style="color:#02A32C;"><span class="fa fa-plus-square fa-margin-right"></span>Add another line</a>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;margin-top:-60px;">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <!-- <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Option-1 Total</b></td>
                                            <td></td>
                                            <td><b>0.00</b></td>
                                        </tr>
                                    </table> -->
                                    <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td>$ <span id="span_sub_total_invoice">0.00</span>
                                                <input type="hidden" name="sub_total" id="item_total"></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>$ <span id="total_tax_">0.00<input type="hidden" name="total_tax_" id="total_tax_"></td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                            <td style="width:150px;">
                                            <input type="number" name="adjustment_input" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td>Markup $<span id="span_markup"></td>
                                            <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td>
                                            <td><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0"><span id="span_markup_input_form">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td><b><span id="grand_total">0.00</span>
                                                <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;margin-top:-70px;">
                                <div class="col-md-6 table-responsive">
                                    <label for="option1_m"><h6>Option 1 Message</h6></label>
                                    <textarea name="option1_message" cols="40" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead style="background-color:#E9E8EA;">
                                        <tr>
                                            <th><b>Option-2 Items</b></th>
                                            <th><b>Type</b></th>
                                            <th width="100px"><b>Quantity</b></th>
                                            <th width="100px"><b>Price</b></th>
                                            <th width="100px"><b>Discount</b></th>
                                            <th width="100px"><b>Total</b></th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body_option2">
                                        <tr>
                                        <td>
                                                <input type="text" class="form-control getItems2"
                                                       onKeyup="getItemsOption2(this)" name="items[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select></td>
                                            <td><input type="number" class="form-control quantity2" name="quantity[]"
                                                       data-counter="0" id="quantity_2_0" value="1"></td>
                                            <!-- <td><input type="text" class="form-control" name="location[]"></td> -->
                                            <td><input type="number" class="form-control price2" name="price[]"
                                                       data-counter="0" id="price_2_0" min="0" value="0"></td>
                                            <td><input type="number" class="form-control discount2" name="discount[]"
                                                       data-counter="0" id="discount_2_0" min="0" value="0" readonly></td>
                                            <input type="hidden" class="form-control tax" name="tax[]"
                                                       data-counter="0" id="tax_2_0" min="0" value="0">
                                            <td><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_2_0" min="0" value="0">
                                                       $<span id="span_total_2_0">0.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_option2" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> -->
                                    <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list" style="color:#02A32C;"><span class="fa fa-plus-square fa-margin-right"></span>Add another line</a>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;margin-top:-60px;">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-5">
                                <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td>$ <span id="span_sub_total_option2">0.00</span>
                                                <input type="hidden" name="sub_total" id="item_total_2"></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>$ <span id="total_tax_2">0.00<input type="hidden" name="total_tax_2" id="total_tax_2"></td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                            <td style="width:150px;">
                                            <input type="number" name="adjustment_input2" id="adjustment_input2" value="0" class="form-control adjustment_input2" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td>Markup $<span id="span_markup"></td>
                                            <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td>
                                            <td><input type="hidden" name="markup_input_form2" id="markup_input_form2" class="markup_input" value="0"><span id="span_markup_input_form2">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td><b><span id="grand_total2">0.00</span>
                                                <input type="hidden" name="grand_total2" id="grand_total_input2" value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- <div class="col-md-4">
                                </div> -->
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;margin-top:-70px;">
                                <div class="col-md-6 table-responsive">
                                    <label for="option2_m"><h6>Option 2 Message</h6></label>
                                    <textarea name="option2_message" cols="40" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h6>Request a Deposit</h6>
                                    <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <select name="deposit_request" class="form-control">
                                        <option value="1" selected="selected">Deposit amount $</option>
                                        <option value="2">Percentage %</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon bold">$</div> -->
                                        <!-- <label><h4>$</h4></label> -->
                                        <input type="text" name="deposit_amount" value="0" class="input-groupss form-control"
                                               autocomplete="off">
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 form-group">
                                    0.00
                                </div> -->
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><h6>Message to Customer</h6></label> <span class="help help-sm help-block">Add a message that will be displayed on the estimate.</span>
                                        <textarea name="customer_message" cols="40" rows="2" class="form-control">I would be happy to have an opportunity to work with you.</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><h6>Terms &amp; Conditions</h6></label> <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the estimate.</span>
                                        <textarea name="terms_conditions" cols="40" rows="2"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row" style="background-color:white;">
                              <div class="col-md-4">
                                  <label for="billing_date"><h6>Attachments</h6></label>
                                  <span class="help help-sm help-block">Optionally attach files to this invoice. Allowed type: pdf, doc, dock, png, jpg, gif</span>
                                  <input type="file" name="est_contract_upload" id="est_contract_upload"
                                         class="form-control"/>
                              </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><h6>Instructions</h6></label><span class="help help-sm help-block">Optional internal notes, will not appear to customer</span>
                                        <textarea name="instructions" cols="40" rows="2"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-light but" style="border-radius: 0 !important;border:solid gray 1px;">Save as Draft</button>
                                    <button type="button" class="btn btn-success but" style="border-radius: 0 !important;">Preview</button>
                                    <a href="<?php echo url('workorder') ?>" class="btn but-red">Cancel this</a>
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

            <!-- Modal Additional Contact -->
            <div class="modal fade" id="modalAdditionalContacts" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
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
                        <div class="modal-body" style="min-height: calc(100vh - 210px);
                                                        overflow-y: auto;
                                                        overflow-x: hidden;
                                                        max-height: 100%;
                                                        position: relative;">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="items_table_estimate" class="table table-hover" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <td> Name</td>
                                            <td> Qty</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item); ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>
                                                <td></td>
                                                <td><?php echo $item->price; ?></td>
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
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

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer_accounting'); ?>

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


    // $(document).ready(function () {
    //     $('#sel-customer').select2();
    //     var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

    //     /*$('#customers')
    //         .empty() //empty select
    //         .append($("<option/>") //add option tag in select
    //             .val(customer_id) //set value for option to post it
    //             .text("<?php echo get_customer_by_id($_GET['customer_id'])->contact_name ?>")) //set a text for show in select
    //         .val(customer_id) //select option of select2
    //         .trigger("change"); //apply to select2*/
    // });
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
                // console.log(response['customer']);
            $("#job_location").val(response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
            $("#customer_email").val(response['customer'].email);
            $("#shipping_address").val(response['customer'].mail_add);
            $("#billing_address").val(response['customer'].mail_add);
        
            },
                error: function(response){
                alert('Error'+response);
       
                }
        });
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