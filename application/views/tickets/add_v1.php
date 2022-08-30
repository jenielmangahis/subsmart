<style>
hr{
    border: 0.5px solid #32243d !important;
    width: 100%;
}
.form-group {
    margin-bottom: 2px !important;
}
.banking-tab-container {
    border-bottom: 1px solid grey;
    padding-left: 0;
}
.form-line{
    padding-bottom: 1px;
}
.input_select{
    color: #363636;
    border: 2px solid #e0e0e0;
    box-shadow: none;
    display: inline-block !important;
    width: 100%;
    background-color: #fff;
    background-clip: padding-box;
    font-size: 11px !important;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 15px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/tickets_s'); ?>
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
    <div wrapper__section style="margin-top:40px;padding-left:1.5%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box" style="padding:25px 0px 20px 0px;">
                <div class="row align-items-center" style="padding:0px 7px;">
                    <div class="col-sm-6">
                        <h5 class="page-title pt-1 mb-0 mt-0" style="position:relative;top:2px;"> Service Ticket</h5>
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
                                    <a href="<?php echo base_url('customer/ticketslist') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Ticket list
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <?php echo form_open_multipart('estimate/save', ['class' => 'form-validate require-validation', 'id' => 'estimate_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border pr-0 pl-0" style="margin-top: -20px;">
                <div class="col-xl-12 pl-0 pr-0">
                    <div class="card pt-2" style="box-shadow: none !important;">
                      <div class="pl-3 pr-3 mt-0 row">
                        <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                        </div>
                      </div>
                        <div class="card-body pl-0">
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="customers" class="required"><b>Customer</b></label>
                                    <select id="sel-customer" name="customer_id" data-customer-source="dropdown" required="" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0">- Select Customer -</option>
                                        <?php foreach($customers as $c){ ?>
                                            <?php if( $default_customer_id > 0 ){ ?>
                                                <option <?= $default_customer_id == $c->prof_id ? 'selected="selected"' : ''; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                            <?php }else{ ?>
                                                <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                            <?php } ?>                                            
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <br><br><a href="<?= base_url('customer/add_advance'); ?>" class="btn btn-sm btn-primary" target="_new" id=""><i class="fa fa-plus" aria-hidden="true"></i> New Customer</a>
                                </div>
                            </div>
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="job_location"><b>Job Location</b> (optional)</label>
                                    <input type="text" class="form-control" name="job_location" id="job_location"
                                           required placeholder="Enter address" autofocus
                                           onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-3" style="display: none;">
                                    <br><br><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus" aria-hidden="true"></i> New Location Address</a>
                                </div>
                            </div>
                            <div class="row" style="background-color:white;margin-top:-2%;">
                                <div class="col-md-6">
                                    <label for="job_name"><b>Job Name</b> (optional)</label>
                                    <input type="text" class="form-control" name="job_name" id="job_name"
                                           placeholder="Enter Job Name" required/>
                                </div>
                            </div>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-4 form-group">
                                    <label for="city">Job Tag</label><label style="float:right;color:green;"><a class="btn btn-sm btn-primary" target="_new" href="<?= base_url('job/job_tags'); ?>">Manage Tag</a></label>
                                    <select class="form-control">
                                        <?php foreach($tags as $t){ ?>
                                            <option value="<?= $t->id; ?>"><?= $t->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Ticket#</b></label>
                                    <input type="text" class="form-control" name="estimate_number" id="estimate_date"
                                           required placeholder="Enter Ticket#" autofocus value="TK-0000001" />
                                </div>
                                <div class="col-md-3">
                                    <label for="estimate_date" class="required"><b>Ticket Date</b></label>
                                    <!-- <input type="text" class="form-control" name="estimate_date" id="estimate_date" required placeholder="Enter Estimate Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="estimate_date" id="estimate_date"
                                               placeholder="Enter Ticket Date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="expiry_date" class="required"><b>Expiry Date</b></label>
                                    <!-- <input type="text" class="form-control" name="expiry_date" id="expiry_date" required placeholder="Enter Expiry Date" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());" /> -->
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control" name="expiry_date" id="expiry_date"
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
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                    </div>
                                <!-- </div>
                                <div class="row" style="background-color:white;"> -->
                                    <div class="col-md-3">
                                        <label for="zip" class="required"><b>Ticket Status</b></label>
                                        <input type="text" class="form-control" name="zip" id="zip" required
                                            placeholder="Enter Ticket Status"/>
                                    </div>
                            </div>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-4 form-group">
                                    <label for="city">Service Type</label>
                                    <select class="form-control">
                                                <option>---</option>
                                    </select>
                                </div>
                            </div>


                            <!-- <div class="row">
                                <div class="col-md-12 form-group mt-3">
                                    <label for="street_address"> Plan Type:</label>
                                    <div class="c__custom c__custom_width  ">
                                        <?php if (count($plans) > 0) { ?>
                                            <?php foreach ($plans as $pn) { ?>
                                                <div class="checkbox checkbox-sec margin-right mr-4">
                                                    <input onClick="getplanItems(<?= $pn->id; ?>)" type="radio"
                                                           name="plan_id" value="<?= $pn->id; ?>"
                                                           id="radio_credit_card<?= $pn->id; ?>">
                                                    <label for="radio_credit_card<?= $pn->id; ?>"><span><?= $pn->plan_name; ?></span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div> -->
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

                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Equipment Cost</td>
                                            <td class="d-flex align-items-center">$ &nbsp;&nbsp;<input type="text"
                                                                                                       value="0.00"
                                                                                                       name="eqpt_cost"
                                                                                                       id="eqpt_cost"
                                                                                                       readonly
                                                                                                       class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales Tax</td>
                                            <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"
                                                                                                        value="0.00"
                                                                                                        name="sales_tax"
                                                                                                        id="sales_tax"
                                                                                                        readonly
                                                                                                        class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Installation Cost</td>
                                            <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"
                                                                                                        value="0.00"
                                                                                                        name="inst_cost"
                                                                                                        id="inst_cost"
                                                                                                        onfocusout="cal_total_due()"
                                                                                                        class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>One time P/Dated <br/>Program and Setup</td>
                                            <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"
                                                                                                        value="0.00"
                                                                                                        name="one_time"
                                                                                                        id="one_time"
                                                                                                        onfocusout="cal_total_due()"
                                                                                                        class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Monthly Monitoring</td>
                                            <td class="d-flex align-items-center">$ &nbsp;&nbsp; <input type="text"
                                                                                                        value="0.00"
                                                                                                        name="m_monitoring"
                                                                                                        id="m_monitoring"
                                                                                                        onfocusout="cal_total_due()"
                                                                                                        class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Due</td>
                                            <td class="d-flex align-items-center">$ &nbsp;&nbsp; <span id="total_due">0.00</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> -->

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h6>Request a Deposit</h6>
                                    <span class="help help-sm help-block">You can request an upfront payment on accept Ticket.</span>
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
                                        <label><h6>Message to Customer</h6></label> <span class="help help-sm help-block">Add a message that will be displayed on the Ticket.</span>
                                        <textarea name="customer_message" cols="40" rows="2" class="form-control">I would be happy to have an opportunity to work with you.</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><h6>Terms &amp; Conditions</h6></label> <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the Ticket.</span>
                                        <textarea name="terms_conditions" cols="40" rows="2"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-md-12">
                                    <label>Attachments</label>
                                    <div class="help help-sm help-block margin-bottom-sec">Optionally attach files to this invoice. Allowed type: pdf, doc, docx, png, jpg, gif</div>


                                    <span class="btn btn-default btn-md fileinput-button vertical-top"><span class="fa fa-upload"></span> Upload File <input data-fileupload="attachment-file" name="attachment-file" type="file"></span>
                                </div> -->
                            </div>


                            <div class="row" style="background-color:white;">
                              <div class="col-md-4">
                                  <label for="billing_date"><h6>Attachments</h6></label>
                                  <span class="help help-sm help-block">Optionally attach files to this invoice. Allowed type: pdf, doc, dock, png, jpg, gif</span>
                                  <input type="file" name="est_contract_upload" id="est_contract_upload"
                                         class="form-control"/>
                              </div>
                              <!-- <div class="col-md-1">
                                <label for="or_separator"></label>
                                <h5 name="or_separator" id="or_separator" class="text-center"> OR </h5>
                              </div> -->
                              <!-- <div class="col-md-7">
                                <label for="title">File<small> Select document from file vault</small></label>
                                <div class="input-group">
                                  <input type="text" class="form-control" name="fs_selected_file_text" id="fs_selected_file_text" placeholder="Selected File" disabled>
                                  <input type="number" class="form-control" name="fs_selected_file" id="fs_selected_file" hidden>
                                  <div class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="btn-fileVault-SelectFile">
                                      <i class="fa fa-folder-open-o"></i>
                                    </button>
                                  </div>
                                </div>
                              </div>-->
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

                            <!-- <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Proposal Kit Template</label> <span class="help help-sm help-block">Apply a proposal template to this estimate to create a proposal.</span>
                                        <textarea name="message" cols="40" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div> -->


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
