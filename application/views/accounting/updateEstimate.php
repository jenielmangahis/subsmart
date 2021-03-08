<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
   

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Update Estimate</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Submit your estimate. Include a breakdown of all costs
                                for this job.
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                    <a href="<?php echo base_url('accounting/newEstimateList') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Estimate
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('estimate/update/' . $estimate->id, ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border" style="margin-top: -20px;">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="customers" class="required"><b>Customer</b></label>
                                    <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0"><?php echo $estimate->customer_id; ?></option>
                                        <?php foreach($customers as $c){ ?>
                                            <?php echo "<pre>";print_r($c); ?>
                                            <option <?= $c->prof_id == $estimate->customer_id ? 'selected="selected"' : ''; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
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
                                    <input type="text" class="form-control"
                                           value="<?php echo $estimate->job_location ?>" name="job_location"
                                           id="job_location" required placeholder="Enter address" autofocus
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-3">
                                    <br><br><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus" aria-hidden="true"></i> New Location Address</a>
                                </div>
                            </div>
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="job_name"><b>Job Name</b> (optional)</label>
                                    <input type="text" class="form-control" name="job_name" id="job_name"
                                           placeholder="Enter Job Name" required  value="<?php echo $estimate->job_name; ?>" />
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate#</b></label>
                                    <input type="text" value="<?= $estimate->estimate_number; ?>" class="form-control" name="estimate_number" id="estimate" required placeholder="Enter Estimate#"/>
                                </div>
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Estimate Date</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <div class="input-group date" data-provide="datepicker">
                                    <input type="text"
                                               value="<?php echo date('d/m/Y', strtotime($estimate->estimate_date)) ?>"
                                               class="form-control" name="estimate_date" id="estimate_date"
                                               placeholder="Enter Estimate Date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="expiry_date" class="required"><b>Expiry Date</b></label>
                                    <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <div class="input-group date" data-provide="datepicker">
                                    <input type="text"
                                               value="<?php echo date('d/m/Y', strtotime($estimate->expiry_date)) ?>"
                                               class="form-control" name="expiry_date" id="expiry_date"
                                               placeholder="Enter Expiry Date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" style="background-color:white;">
                                    <div class="col-md-3">
                                        <label for="purchase_order_number" class="required"><b>Purchase Order#</b></label>
                                        <input type="text" class="form-control" name="purchase_order_number"
                                            id="purchase_order_number" required placeholder="Enter Purchase Order#"
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" value="<?php echo $estimate->purchase_order_number; ?>" />
                                    </div>
                                <!-- </div>
                                <div class="row" style="background-color:white;"> -->
                                    <div class="col-md-3">
                                        <label for="status" class="required"><b>Estimate Status</b></label>
                                        <!-- <input type="text" class="form-control" name="zip" id="zip" required
                                            placeholder="Enter Estimate Status"/> -->
                                            <select name="status" class="form-control">
                                                    <option value="Draft">Draft</option>
                                                    <option value="Submitted">Submitted</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Declined">Declined</option>
                                                    <option value="Schedule">Schedule</option>
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
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead style="background-color:#E9E8EA;">
                                        <tr>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th width="100px">Quantity</th>
                                            <th>Location</th>
                                            <th width="100px">Cost</th>
                                            <th width="100px">Discount</th>
                                            <th>Tax(%)</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        <tr>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                </select></td>
                                            <td><input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="item[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><input type="text" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td><input type="text" class="form-control" name="location[]"></td>
                                            <td><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" readonly></td>
                                            <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                            <td><span id="span_total_0">0.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a href="#" id="add_another" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line</a> &emsp;
                                    <a href="#" id="add_another" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Items in bulk</a>
                                    <hr>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;font-size:16px;">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td style="width:250px;"><input type="text" class="form-control" placeholder="Adjustment"></td>
                                            <td style="width:150px;">
                                                <select class="form-control">
                                                    <option>0</option>
                                                </select>
                                            </td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Markup</td>
                                            <td><a href="#" style="color:#02A32C;">set markup</a></td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td><b>0.00</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

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
                                        <input type="text" name="deposit_amount"  value="<?php echo $estimate->deposit_amount; ?>" class="form-control"
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
                                        <textarea name="customer_message" cols="40" rows="2" class="form-control"><?php echo $estimate->customer_message; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><h6>Terms &amp; Conditions</h6></label> <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the estimate.</span>
                                        <textarea name="terms_conditions" cols="40" rows="2"
                                                  class="form-control"><?php echo $estimate->terms_conditions; ?></textarea>
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
                                                  class="form-control"><?php echo $estimate->instructions; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-danger but" style="border-radius: 0 !important;border:solid gray 1px;">Update</button>
                                    <button type="button" class="btn btn-success but" style="border-radius: 0 !important;">Preview</button>
                                    <a href="<?php echo url('accounting/newEstimateList') ?>" class="btn but-red">Cancel this</a>
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
<?php include viewPath('includes/footer'); ?>

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
        // $("#customer_source").select2().select2('val', 1);
        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val("<?php echo $estimate->customer_id ?>") //set value for option to post it
                .text("<?php echo $estimate->customer->contact_name ?>")) //set a text for show in select
            .val("<?php echo $estimate->customer_id ?>") //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>