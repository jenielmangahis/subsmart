<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/estimate'); ?>
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
   </style>


    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:2%;padding-left:1.5%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 style="font-family: Sarabun, sans-serif">Submit Bundle Estimate</h4>
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
                                    <a href="<?php echo base_url('estimate') ?>" class="btn btn-primary"
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
                This form is also known as a bundle estimate.  With each bundle of valued items in each project package, your prospect will have an extra incentives for choosing to do both plans you have layout for them.  Under each listing of stages or project your have a description section to help your prospect make an informed decision.  We added a bundle discount to help make your next group project have that exception value each prospect have grown to love.   
                </div>

            </div>
            <!-- end row -->
            <?php echo form_open_multipart('estimate/savenewestimateBundle', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border" style="margin-top: -20px;">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="customers" class="required"><b>Customer</b></label>
                                    <div id="sel-customerdiv">
                                    <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0">- none -</option>
                                        <?php foreach($customers as $c){ ?>
                                            <option value="<?= $c->prof_id; ?>"><?= $c->contact_name . '' . $c->first_name . ' ' . $c->last_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br><br><a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewCustomer" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Customer</a>
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
                                    <!-- <br><br><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus" aria-hidden="true"></i> New Location Address</a> -->
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
                                    <!-- <input type="text" class="form-control" name="estimate_number" id="estimate_date"
                                           required placeholder="Enter Estimate#" autofocus value="<?php echo $auto_increment_estimate_id; ?>" 
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());"/> -->
                                    <input type="text" class="form-control" name="estimate_number" id="estimate_date"
                                           required placeholder="Enter Estimate#"  value="<?php echo "EST-"; 
                                           foreach ($number as $num):
                                                $next = $num->estimate_number;
                                                $arr = explode("-", $next);
                                                $date_start = $arr[0];
                                                $nextNum = $arr[1];
                                            //    echo $number;
                                           endforeach;
                                           $val = $nextNum + 1;
                                           echo str_pad($val,9,"0",STR_PAD_LEFT);
                                           ?>" />
                                </div>
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate Date</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <!-- <div class="input-group date" data-provide="datepicker"> -->
                                        <input type="date" class="form-control" name="estimate_date" id="start_date_"
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
                                        <input type="date" class="form-control" name="expiry_date" id="end_date_"
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
                                            id="purchase_order_number" placeholder="Enter Purchase Order#"
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

                            <div class="row" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead style="background-color:#E9E8EA;">
                                        <tr>
                                            <th><b>Bundle-1 Items</b></th>
                                            <th><b>Type</b></th>
                                            <th width="100px"><b>Quantity</b></th>
                                            <th width="100px"><b>Price</b></th>
                                            <th width="100px"><b>Discount</b></th>
                                            <th width="150px"><b>Tax (Change in %)</b></th>
                                            <th width="100px"><b>Total</b></th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body_bundle1">
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
                                            <td><input type="text" class="form-control tax_changeoptions" name="tax[]"
                                                       data-counter="0" id="tax_1_0" min="0" value="0">
                                                       <!-- <span id="tax_111_0">0.00</span></td> -->
                                            <td><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_bundle1" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> -->
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
                                            <td>$ <span id="span_sub_total_invoice">0.00</span>
                                                <input type="hidden" name="sub_total" id="item_total"></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>$ <span id="total_tax_">0.00</span><input type="hidden" name="total_tax_" id="total_tax_input"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                            <td style="width:150px;">
                                            <input type="number" name="adjustment_input" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Bundle-1 Total</b></td>
                                            <td></td>
                                            <td><b><span id="grand_total">0.00</span>
                                                <input type="hidden" name="bundle1_total" id="grandtotal_input" value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- <div class="col-md-4">
                                </div> -->
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;margin-top:-70px;">
                                <div class="col-md-5 table-responsive">
                                    <label for="option1_m"><h6>Bundle 1 Message</h6></label>
                                    <textarea name="bundle1_message" cols="40" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead style="background-color:#E9E8EA;">
                                        <tr>
                                            <th><b>Bundle-2 Items</b></th>
                                            <th><b>Type</b></th>
                                            <th width="100px"><b>Quantity</b></th>
                                            <th width="100px"><b>Price</b></th>
                                            <th width="100px"><b>Discount</b></th>
                                            <th width="150px"><b>Tax (Change in %)</b></th>
                                            <th width="100px"><b>Total</b></th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body_bundle2">
                                        <tr>
                                        <td>
                                                <input type="text" class="form-control getItems2"
                                                       onKeyup="getItemsOption2(this)" name="items2[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type2[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select></td>
                                            <td><input type="number" class="form-control quantity2" name="quantity2[]"
                                                       data-counter="0" id="quantity2_0" value="1"></td>
                                            <!-- <td><input type="text" class="form-control" name="location[]"></td> -->
                                            <td><input type="number" class="form-control price2" name="price2[]"
                                                       data-counter="0" id="price2_0" min="0" value="0"></td>
                                            <td><input type="number" class="form-control discount2" name="discount2[]"
                                                       data-counter="0" id="discount2_0" min="0" value="0" readonly></td>
                                            <td><input type="text" class="form-control tax_changeoptionsb" name="tax2[]"
                                                       data-counter="0" id="tax2_1_0" min="0" value="0"></td>
                                            <td><input type="hidden" class="form-control " name="total2[]"
                                                       data-counter="0" id="item_total2_0" min="0" value="0">
                                                       $<span id="span_total2_0">0.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- <a href="#" id="add_another_bundle2" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> -->
                                    <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list2" style="color:#02A32C;"><span class="fa fa-plus-square fa-margin-right"></span>Add another line</a>
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
                                            <td>$ <span id="span_sub_total_invoice2">0.00</span>
                                                <input type="hidden" name="sub_total2" id="item_total2"></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>$ <span id="total_tax2_">0.00</span><input type="hidden" name="total_tax2_" id="total_tax2_input"></td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td>Markup $<span id="span_markup"></td>
                                            <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td>
                                            <td><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0"><span id="span_markup_input_form">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td>Bundle Discount</td>
                                            <td align="right">$</td>
                                            <td style="width:100px;"><input type="number" name="bundle_discount" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Bundle-2 Total</b></td>
                                            <td></td>
                                            <td><b><span id="grand_total2">0.00</span><input type="hidden" name="bundle2_total" id="grand_total_input2" value='0'></b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total</b></td>
                                            <td></td>
                                            <td><b><span id="supergrandtotal">0.00</span>
                                                <input type="hidden" name="supergrandtotal" id="supergrandtotal_input" value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- <div class="col-md-4">
                                </div> -->
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;margin-top:-70px;">
                                <div class="col-md-5 table-responsive">
                                    <label for="option2_m"><h6>Bundle 2 Message</h6></label>
                                    <textarea name="bundle2_message" cols="40" rows="2" class="form-control"></textarea>
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
                                        <option value="$" selected="selected">Deposit amount $</option>
                                        <option value="%">Percentage %</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-addon bold">$</div> -->
                                        <!-- <label><h4>$</h4></label> -->
                                        <input type="text" name="deposit_amount" value="0" class="form-control"
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

            <!-- Modal -->
            <div class="modal fade" id="item_list2" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
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
                                    <table id="items_table_estimate_option2" class="table table-hover" style="width: 100%;">
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
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item2">
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
<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets ?>js/add.js"></script>

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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script>
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

<script>

$(document).ready(function(){
 
    $('#sel-customer').change(function(){
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
            $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
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

<script>
$(".select_item").click(function () {
            var idd = this.id;
            console.log(idd);
            console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            // var qty = $(this).data('quantity');
            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 0;
            }else{
              // alert('0');
              var qty = $(this).data('quantity');
            }

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            // console.log(total);
            // alert(total);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
                "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" class=\"form-control qtyest\"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\"  id='discount_"+idd+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\"><input type=\"text\"  data-itemid='"+idd+"' class=\"form-control tax_changeoptions2\" name=\"tax[]\" data-counter=\"0\"  id='tax_1_"+idd+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' test=\"test\" id='span_total_"+idd+"' class=\"total_per_item\">"+total+
                "</span><input type=\"hidden\" name=\"total[]\" id='item_total_"+idd+"' value='"+total+"'></td>" +
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</tr>";
            tableBody = $("#table_body_bundle1");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td >"+title+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >"+price+"</td>\n" +
                "<td ></td>\n" +
                "<td >"+qty+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >0</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // calculate_subtotal();

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

//   alert( 'yeah' + tax1);

  $("#span_total_" + in_id).text(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax_11_" + in_id).val(tax1);
  $("#discount_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_'+ in_id).length ){
    $('#item_total_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltaxx = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltaxx += parseFloat($(this).val());
  });

//   alert(subtotaltaxx);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltaxx.toFixed(2));
//   $("#total_tax_").val(subtotaltaxx.toFixed(2));
$("#total_tax_input").val(subtotaltaxx.toFixed(2));
  

  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));

  var bundle1_total = $("#grand_total").text();
  var bundle2_total = $("#grand_total2").text();
  var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

  $("#supergrandtotal").text(super_grand.toFixed(2));
  $("#supergrandtotal_input").val(super_grand.toFixed(2));

//   alert(super_grand);

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();

        });

$(".select_item2").click(function () {
            var idd = this.id;
            console.log(idd);
            console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            var qty = $(this).data('quantity');

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            // console.log(total);
            // alert(total);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items2[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id2[]\"></td>\n" +
                "<td width=\"20%\"><select name=\"item_type2[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity2_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity2[]\" class=\"form-control qtyest2\"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input id='price2_"+idd+"' value='"+price+"'  type=\"number\" name=\"price2[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\"><input type=\"number\" name=\"discount2[]\" class=\"form-control discount2\"  id='discount2_"+idd+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_changeoptions2b\" name=\"tax2[]\" data-counter=\"0\"  id='tax2_1_"+idd+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total2_"+idd+"' class=\"total_per_item2\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span><input type=\"hidden\" name=\"total2[]\" id='item_total2_"+idd+"' value='"+total+"'></td>" +
                "</tr>";
            tableBody = $("#table_body_bundle2");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td >"+title+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >"+price+"</td>\n" +
                "<td ></td>\n" +
                "<td >"+qty+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >0</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // calculate_subtotal();

  var in_id = idd;
  var price = $("#price2_" + in_id).val();
  var quantity = $("#quantity2_" + in_id).val();
  var discount = $("#discount2_" + in_id).val();
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

//   alert( 'yeah' + tax1);

  $("#span_total2_" + in_id).text(total);
  $("#tax2_1_" + in_id).text(tax1);
  $("#tax2_11_" + in_id).val(tax1);
  $("#discount2_" + in_id).val(discount);

  if( $('#tax2_1_'+ in_id).length ){
    $('#tax2_1_'+in_id).val(tax1);
  }

  if( $('#item_total2_'+ in_id).length ){
    $('#item_total2_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price2_" + p).val();
    var quantity = $("#quantity2_" + p).val();
    var discount = $("#discount2_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total2_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltaxx = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax2_1_"]').each(function(){
      subtotaltaxx += parseFloat($(this).val());
  });

//   alert(subtotaltaxx);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice2").text(subtotal.toFixed(2));
  $("#item_total2").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax2_").text(subtotaltaxx.toFixed(2));
//   $("#total_tax2_").val(subtotaltaxx.toFixed(2));
$("#total_tax2_input").val(subtotaltaxx.toFixed(2));
  

  $("#grand_total2").text(grand_total_w.toFixed(2));
  $("#grand_total_input2").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));
  

  var bundle1_total = $("#grand_total").text();
  var bundle2_total = $("#grand_total2").text();
  var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

  $("#supergrandtotal").text(super_grand.toFixed(2));
  $("#supergrandtotal_input").val(super_grand.toFixed(2));


  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
  
  
        });

        // $("body").delegate(".qtyest", "keyup", function(){
        //     //console.log( "Handler for .keyup() called." );
        //     var id = this.id;
        //     var qty=this.value;
        //     var cost = $('#price'+id).val();
        //     var new_sub_total = Number(qty) * Number(cost);
        //     $('#sub_total'+id).data('subtotal',new_sub_total);
        //     $('#sub_total'+id).text('$' + formatNumber(new_sub_total));
        //     calculate_subtotal();
        // });
    $(document).on("focusout", ".qtyest", function () {
        
        var id = this.id;
        var in_id = $(this).attr('data-itemid');
            var qty=this.value;
            var cost = $('#price_'+in_id).val();
            var new_sub_total = Number(qty) * Number(cost);
            var new_sub_total_val = Number(qty) * Number(cost);
            var tax = '0.075';
            // var new_sub_total_tax =  new_sub_total * tax;
            var new_sub_total_tax = (parseFloat(new_sub_total) * 7.5) / 100;
            var new_sub_total_w_tax =  (parseFloat(new_sub_total_tax) + parseFloat(new_sub_total));
            // $('#sub_total'+id).data('subtotal',new_sub_total);
            // $('#sub_total'+id).text('$' + formatNumber(new_sub_total));
            // alert(new_sub_total_w_tax);
            $("#item_total_"+in_id).text(new_sub_total_w_tax.toFixed(2));
            $("#item_total_"+in_id).val(new_sub_total_w_tax.toFixed(2));
            // $(".total_per_item").text(new_sub_total_tax.toFixed(2));
            // var counter = $(this).data("counter");
            // var counter = jQuery(obj)
            // .parent()
            // .parent()
            // .parent()
            // .find(".price")
            // .data("counter");
            // calculate_subtotal();
            // calculation(counter);

            //   var in_id = id;
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

            //   alert( 'yeah' + tax1);

            $("#span_total_" + in_id).text(total);
            $("#tax_1_" + in_id).text(tax1);
            $("#tax_11_" + in_id).val(tax1);
            $("#discount_" + in_id).val(discount);

            if( $('#tax_1_'+ in_id).length ){
                $('#tax_1_'+in_id).val(tax1);
            }

            if( $('#item_total_'+ in_id).length ){
                $('#item_total_'+in_id).val(total);
            }

            var eqpt_cost = 0;
            var cnt = $("#count").val();
            var total_discount = 0;
            for (var p = 0; p <= cnt; p++) {
                var prc = $("#price_" + p).val();
                var quantity = $("#quantity_" + p).val();
                var discount = $("#discount_" + p).val();
                // var discount= $('#discount_' + p).val();
                // eqpt_cost += parseFloat(prc) - parseFloat(discount);
                eqpt_cost += parseFloat(prc) * parseFloat(quantity);
                total_discount += parseFloat(discount);
            }
            //   var subtotal = 0;
            // $( total ).each( function(){
            //   subtotal += parseFloat( $( this ).val() ) || 0;
            // });

            eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
            total_discount = parseFloat(total_discount).toFixed(2);
            // var test = 5;

            var subtotal = 0;
            // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
            });
            // $('#sum').text(subtotal);

            var subtotaltaxx = 0;
            // $("#span_total_0").each(function(){
                $('*[id^="tax_1_"]').each(function(){
                subtotaltaxx += parseFloat($(this).val());
            });

            //   alert(subtotaltaxx);

            $("#eqpt_cost").val(eqpt_cost);
            $("#total_discount").val(total_discount);
            $("#span_sub_total_0").text(total_discount);
            $("#span_sub_total_invoice").text(subtotal.toFixed(2));
            $("#item_total").val(subtotal.toFixed(2));
            
            var s_total = subtotal.toFixed(2);
            var adjustment = $("#adjustment_input").val();
            var grand_total = s_total - parseFloat(adjustment);
            var markup = $("#markup_input_form").val();
            var grand_total_w = grand_total + parseFloat(markup);

            $("#total_tax_").text(subtotaltaxx.toFixed(2));
            // $("#total_tax_").val(subtotaltaxx.toFixed(2));
            $("#total_tax_input").val(subtotaltaxx.toFixed(2));
            

            $("#grand_total").text(grand_total_w.toFixed(2));
            $("#grand_total_input").val(grand_total_w.toFixed(2));
            $("#grandtotal_input").val(grand_total_w.toFixed(2));

            var bundle1_total = $("#grand_total").text();
            var bundle2_total = $("#grand_total2").text();
            var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

            $("#supergrandtotal").text(super_grand.toFixed(2));
            $("#supergrandtotal_input").val(super_grand.toFixed(2));


            var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
            sls = parseFloat(sls).toFixed(2);
            $("#sales_tax").val(sls);
            cal_total_due();
        });

    $(document).on("focusout", ".qtyest2", function () {
        // alert('two');
        var id = this.id;
        var in_id = $(this).attr('data-itemid');
            var qty=this.value;
            var cost = $('#price_'+in_id).val();
            var new_sub_total = Number(qty) * Number(cost);
            var new_sub_total_val = Number(qty) * Number(cost);
            var tax = '0.075';
            // var new_sub_total_tax =  new_sub_total * tax;
            var new_sub_total_tax = (parseFloat(new_sub_total) * 7.5) / 100;
            var new_sub_total_w_tax =  (parseFloat(new_sub_total_tax) + parseFloat(new_sub_total));
            // $('#sub_total'+id).data('subtotal',new_sub_total);
            // $('#sub_total'+id).text('$' + formatNumber(new_sub_total));
            // alert(new_sub_total_w_tax);
            $("#item_total_"+in_id).text(new_sub_total_w_tax.toFixed(2));
            $("#item_total_"+in_id).val(new_sub_total_w_tax.toFixed(2));
            // $(".total_per_item").text(new_sub_total_tax.toFixed(2));
            // var counter = $(this).data("counter");
            // var counter = jQuery(obj)
            // .parent()
            // .parent()
            // .parent()
            // .find(".price")
            // .data("counter");
            // calculate_subtotal();
            // calculation(counter);

            // var in_id = idd;
            var price = $("#price2_" + in_id).val();
            var quantity = $("#quantity2_" + in_id).val();
            var discount = $("#discount2_" + in_id).val();
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

            //   alert( 'yeah' + tax1);

            $("#span_total2_" + in_id).text(total);
            $("#tax2_1_" + in_id).text(tax1);
            $("#tax2_11_" + in_id).val(tax1);
            $("#discount2_" + in_id).val(discount);

            if( $('#tax2_1_'+ in_id).length ){
                $('#tax2_1_'+in_id).val(tax1);
            }

            if( $('#item_total2_'+ in_id).length ){
                $('#item_total2_'+in_id).val(total);
            }

            var eqpt_cost = 0;
            var cnt = $("#count").val();
            var total_discount = 0;
            for (var p = 0; p <= cnt; p++) {
                var prc = $("#price2_" + p).val();
                var quantity = $("#quantity2_" + p).val();
                var discount = $("#discount2_" + p).val();
                // var discount= $('#discount_' + p).val();
                // eqpt_cost += parseFloat(prc) - parseFloat(discount);
                eqpt_cost += parseFloat(prc) * parseFloat(quantity);
                total_discount += parseFloat(discount);
            }
            //   var subtotal = 0;
            // $( total ).each( function(){
            //   subtotal += parseFloat( $( this ).val() ) || 0;
            // });

            eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
            total_discount = parseFloat(total_discount).toFixed(2);
            // var test = 5;

            var subtotal = 0;
            // $("#span_total_0").each(function(){
                $('*[id^="span_total2_"]').each(function(){
                subtotal += parseFloat($(this).text());
            });
            // $('#sum').text(subtotal);

            var subtotaltaxx = 0;
            // $("#span_total_0").each(function(){
                $('*[id^="tax2_1_"]').each(function(){
                subtotaltaxx += parseFloat($(this).val());
            });

            //   alert(subtotaltaxx);

            $("#eqpt_cost").val(eqpt_cost);
            $("#total_discount").val(total_discount);
            $("#span_sub_total_0").text(total_discount);
            $("#span_sub_total_invoice2").text(subtotal.toFixed(2));
            $("#item_total2").val(subtotal.toFixed(2));
            
            var s_total = subtotal.toFixed(2);
            var adjustment = $("#adjustment_input").val();
            var grand_total = s_total - parseFloat(adjustment);
            var markup = $("#markup_input_form").val();
            var grand_total_w = grand_total + parseFloat(markup);

            $("#total_tax2_").text(subtotaltaxx.toFixed(2));
            // $("#total_tax2_").val(subtotaltaxx.toFixed(2));
            $("#total_tax2_input").val(subtotaltaxx.toFixed(2));
            

            $("#grand_total2").text(grand_total_w.toFixed(2));
            $("#grand_total_input2").val(grand_total_w.toFixed(2));
            $("#grandtotal_input").val(grand_total_w.toFixed(2));

            var bundle1_total = $("#grand_total").text();
            var bundle2_total = $("#grand_total2").text();
            var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

            $("#supergrandtotal").text(super_grand.toFixed(2));
            $("#supergrandtotal_input").val(super_grand.toFixed(2));

            var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
            sls = parseFloat(sls).toFixed(2);
            $("#sales_tax").val(sls);
            cal_total_due();
        });

        // function calculate_subtotal(tax=0){
        //     var subtotal = 0 ;
        //     $('.total_per_item').each(function(index) {
        //         var idd = $(this).data('subtotal');
        //         // var idd = this.id;
        //         subtotal = Number(subtotal) + Number(idd);
        //     });
        //     var total = parseFloat(subtotal).toFixed(2);
        //     var tax_total=0;
        //     if(tax !== 0 || tax !== ''){
        //         tax_total = Number(total) *  Number(tax);
        //         total = Number(total) - Number(tax_total);
        //         total = parseFloat(total).toFixed(2);
        //         tax_total =  parseFloat(tax_total).toFixed(2);
        //         var tax_with_comma = Number(tax_total).toLocaleString('en');
        //         $('#invoice_tax_total').html('$' + tax_with_comma);
        //     }
        //     var withCommas = Number(total).toLocaleString('en');
        //     if(tax_total < 1){
        //         $('#invoice_sub_total').html('$' + formatNumber(total));
        //     }
        //     $('#invoice_overall_total').html('$' + formatNumber(total));
        //     $('#pay_amount').val(withCommas);
        // }

$(document).on("focusout", ".tax_changeoptions", function () {
  var counter = $(this).data("counter");
  // alert(counter);
  //calculation(counter);
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val();
  var rate_val = this.value;
//   alert(rate_val);
  var tax = (parseFloat(price) * parseFloat(rate_val)) / 100;
  var tax1 = (((parseFloat(price) * parseFloat(rate_val)) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_" + counter).text(total);
  $("#tax_1_" + counter).text(tax1);
  $("#tax_111_" + counter).text(tax1);
  $("#tax_1_" + counter).val(tax1);
  $("#discount_" + counter).val(discount);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_1_'+ counter).length ){
    $('#tax_1_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
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

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
//   $("#total_tax_").val(subtotaltax.toFixed(2));
  $("#total_tax_input").val(subtotaltax.toFixed(2));
  

  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));

  var bundle1_total = $("#grand_total").text();
  var bundle2_total = $("#grand_total2").text();
  var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

  $("#supergrandtotal").text(super_grand.toFixed(2));
  $("#supergrandtotal_input").val(super_grand.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

$(document).on("focusout", ".tax_changeoptions2", function () {
  // var counter = $(this).data("counter");
  var counter = $(this).attr('data-itemid');
//   alert(counter);
  //calculation(counter);
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val();
  var rate_val = this.value;
//   alert(rate_val);
  var tax = (parseFloat(price) * parseFloat(rate_val)) / 100;
  var tax1 = (((parseFloat(price) * parseFloat(rate_val)) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_" + counter).text(total);
  $("#tax_1_" + counter).text(tax1);
  $("#tax_111_" + counter).text(tax1);
  $("#tax_1_" + counter).val(tax1);
  $("#discount_" + counter).val(discount);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_1_'+ counter).length ){
    $('#tax_1_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
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

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
//   $("#total_tax_").val(subtotaltax.toFixed(2));
$("#total_tax_input").val(subtotaltax.toFixed(2));
  

  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));

  var bundle1_total = $("#grand_total").text();
  var bundle2_total = $("#grand_total2").text();
  var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

  $("#supergrandtotal").text(super_grand.toFixed(2));
  $("#supergrandtotal_input").val(super_grand.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});












$(document).on("focusout", ".tax_changeoptionsb", function () {
  var counter = $(this).data("counter");
  // alert(counter);
  //calculation(counter);
  var price = $("#price2_" + counter).val();
  var quantity = $("#quantity2_" + counter).val();
  var discount = $("#discount2_" + counter).val();
  var rate_val = this.value;
//   alert(rate_val);
  var tax = (parseFloat(price) * parseFloat(rate_val)) / 100;
  var tax1 = (((parseFloat(price) * parseFloat(rate_val)) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total2_" + counter).text(total);
  $("#tax2_1_" + counter).text(tax1);
  $("#tax2_11_" + counter).text(tax1);
  $("#tax2_1_" + counter).val(tax1);
  $("#discount2_" + counter).val(discount);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax2_1_'+ counter).length ){
    $('#tax2_1_'+counter).val(tax1);
  }

  if( $('#item_total2_'+ counter).length ){
    $('#item_total2_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price2_" + p).val();
    var quantity = $("#quantity2_" + p).val();
    var discount = $("#discount2_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total2_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax2_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#sub_total2").text(total_discount);
  $("#span_sub_total_invoice2").text(subtotal.toFixed(2));
  $("#item_total2").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax2_").text(subtotaltax.toFixed(2));
//   $("#total_tax2_").val(subtotaltax.toFixed(2));
$("#total_tax2_input").val(subtotaltax.toFixed(2));
  

  $("#grand_total2").text(grand_total_w.toFixed(2));
  $("#grand_total_input2").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});



$(document).on("focusout", ".tax_changeoptions2b", function () {
  // var counter = $(this).data("counter");
  var counter = $(this).attr('data-itemid');
//   alert(counter);
  //calculation(counter);
  var price = $("#price2_" + counter).val();
  var quantity = $("#quantity2_" + counter).val();
  var discount = $("#discount2_" + counter).val();
  var rate_val = this.value;
//   alert(rate_val);
  var tax = (parseFloat(price) * parseFloat(rate_val)) / 100;
  var tax1 = (((parseFloat(price) * parseFloat(rate_val)) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total2_" + counter).text(total);
  $("#tax2_1_" + counter).text(tax1);
  $("#tax2_11_" + counter).text(tax1);
  $("#tax2_1_" + counter).val(tax1);
  $("#discount2_" + counter).val(discount);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax2_1_'+ counter).length ){
    $('#tax2_1_'+counter).val(tax1);
  }

  if( $('#item_total2_'+ counter).length ){
    $('#item_total2_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price2_" + p).val();
    var quantity = $("#quantity2_" + p).val();
    var discount = $("#discount2_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total2_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax2_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#sub_total2").text(total_discount);
  $("#span_sub_total_invoice2").text(subtotal.toFixed(2));
  $("#item_total2").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax2_").text(subtotaltax.toFixed(2));
//   $("#total_tax2_").val(subtotaltax.toFixed(2));
$("#total_tax2_input").val(subtotaltax.toFixed(2));
  

  $("#grand_total2").text(grand_total_w.toFixed(2));
  $("#grand_total_input2").val(grand_total_w.toFixed(2));
  $("#supergrandtotal_input").val(super_grand.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

</script>

<script type="text/javascript">
$(window).on('beforeunload', function(){
    var c = confirm();
    if(c){
        return true;
    }
    else
        return false;
});
</script>

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