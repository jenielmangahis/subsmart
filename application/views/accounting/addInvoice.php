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
   </style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 style="font-family: Sarabun, sans-serif">New Invoice</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Complete the fields below to create a new invoice.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('invoice') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Invoices
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="validation-error" id="estimate-error" style="display: none;">You selected Credit Card Payments as payment method for this invoice. Please configure the <a href="https://www.markate.com/pro/settings/payments/main">Online Payment processor</a> first to accept cart payments.</div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('invoice/save', ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>

            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="background-color:white;">
                                <div class="col-md-5 form-group">
                                    <label for="invoice_customer">Customer</label>
                                    <select id="invoice_customer" name="customer_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select customer">
                                    </select>
                                </div>
                                <div class="col-md-5 form-group">
                                    <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewCustomer" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Customer</a>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="invoice_job_location">Job Location <small class="help help-sm">(optional, select or add new one)</small></label>
                                    <select id="invoice_job_location" name="invoice_job_location_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select Address">
                                    </select>
                                </div>
                                <div class="col-md-5 form-group">
                                    <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewLocationAddress" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Location Address</a>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="job_name">Job Name <small class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" required/>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Customer email</label>
                                            <input type="email" class="form-control" name="customer_email">
                                            <p><input type="checkbox"> Send later </p>
                                        </div>
                                        <div class="col-md-3">
                                        <label>Location of sale</label>
                                        <input type="text" class="form-control" style="width:200px;" name="location_scale">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                        <label>Billing address</label>
                                            <textarea class="form-control" style="height:100px;width:100%;" name="billing_address"></textarea>
                                        </div>
                                        <div class="col-md-3">
                                        <label>Terms</label>
                                            <select class="form-control" name="terms" id="addNewTerms1">
                                                <option></option>
                                                <!-- <option>Add New</option>
                                                <option>John Doe</option>-->
                                                <option value="0">Add New</option> 
                                                <?php foreach($terms as $term) : ?>
                                                <option value="<?php echo $term->id; ?>"><?php echo $term->description . ' ' . $term->day; ?></option>
                                                <?php endforeach; ?>
                                            </select><br><br>
                                            <label>Ship via</label><br>
                                            <input type="text" class="form-control" name="ship_via">
                                        </div>
                                        <div class="col-md-3">
                                        <label>Shipping date</label><br>
                                            <input type="text" class="form-control" name="shipping_date" id="datepickerinv2"><br>
                                            <label>Tracking no.</label><br>
                                            <input type="text" class="form-control" name="tracking_number">
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                        <label>Shipping to</label>
                                            <textarea class="form-control" style="height:100px;width:100%;" name="shipping_to_address"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label>Tags</label> <a href="#" style="float:right;color:blue;">Manage tags</a>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <br><br>
                            
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
                                        <input type="text" class="form-control" id="work_order" name="work_order" id="work_order">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="purchase_order">Purchase Order# <small class="help help-sm">(optional)</small></label>
                                    <span class="fa fa-question-circle text-ter" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional if you want to display the purchase order number on invoice." data-original-title="" title=""></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="purchase_order" id="purchase_order">
                                    </div>
                                </div>
                                
                                <div class="col-md-3 form-group">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="invoice_number">Invoice#</label>
                                    <!-- <input type="text" class="form-control" name="invoice_number"
                                           id="invoice_number" value="<?php echo "INV-".date("YmdHis"); ?>" required placeholder="Enter Invoice#"
                                           autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/> -->
                                    <input type="text" class="form-control" name="invoice_number"
                                           id="invoice_number" value="INV-00000001" required placeholder="Enter Invoice#"
                                           autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="date_issued">Date Issued <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="issued_date" name="date_issued" required/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="due_date">Due Date <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="due_date" name="due_date" required/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="status">Status</label><br/>
                                    <input type="text" value="Draft" class="form-control" readonly>
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
                                        <input type="hidden" name="count" value="0" id="count">
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
                                        <tbody id="table_body_new">
                                        <tr>
                                            <td><input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="item[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="service">Service</option>
                                                    <option value="material">Material</option>
                                                    <option value="product">Product</option>
                                                </select></td>
                                            <td><input type="text" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td><input type="hidden" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0">
                                                       <span id="span_discount_0">0.00 (0.00%)</span></td>
                                            <td><input type="hidden" class="form-control tax" name="tax[]"
                                                       data-counter="0" id="tax_0" min="0" value="0">
                                                       <span id="span_tax_0">0.00 (7.5%)</span></td>
                                            <td><input type="hidden" class="form-control total" name="total[]"
                                                       data-counter="0" id="total_0" min="0" value="0">
                                                       <span id="span_total_0">0.00</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <!-- <a class="link-modal-open pt-1 pl-2" href="#" id="add_another_new_invoice" style="color:#02A32C;"><span
                                                    class="fa fa-plus-square fa-margin-right" style="color:#02A32C;"></span>Add Items</a> -->
                                        <a href="#" id="add_another_new_invoice" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line </a>
                                        <hr style="display:inline-block; width:91%">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                        &nbsp;
                                        </div>
                                        <div class="col-md-5 row pr-0">
                                            <div class="col-sm-5">
                                                <label style="padding: 0 .75rem;">Subtotal</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                                <label id="invoice_sub_total">0.00</label>
                                                <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="adjustment_name" value="" placeholder="Adjustment" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="adjustment_total" id="adjustment_input" value="0" class="form-control" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </div>
                                            <div class="col-sm-3 text-right pt-2">
                                                <label id="adjustment_amount">0.00</label>
                                                <input type="hidden" name="adjustment_amount" id="adjustment_amount_form_input" value='0'>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <label style="padding: .375rem .75rem;">Grand Total ($)</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                                <label id="invoice_grand_total">0.00</label>
                                                <input type="hidden" name="grand_total" id="grand_total_form_input" value='0'>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
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
                                    <select name="deposit_request" class="form-control">
                                        <option value="1" selected="selected">Deposit amount $</option>
                                        <option value="2">Percentage %</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="input-group">
                                        <input type="text" name="deposit_amount" value="0" class="form-control"
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>

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
                                    <h5>Message to Customer</h5>
                                    <span class="help help-sm help-block">Add a message that will be displayed on the invoice.</span>
                                    <textarea name="message" cols="40" rows="2" class="form-control">Thank you for your business.</textarea>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <h5>Terms &amp; Conditions</h5>
                                    <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the invoice.</span>
                                    <textarea name="terms" cols="40" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
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

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-light but" style="border-radius: 0 !important;border:solid gray 1px;" data-action="update">Save as Draft</button>
                                    <button class="btn btn-success but" style="border-radius: 0 !important;" data-action="send">Preview</button>
                                    <a href="<?php echo url('invoice') ?>" class="btn but-red">cancel this</a>
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
                                    <input type="text" name="title" value="" class="form-control"
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
<?php include viewPath('includes/footer_accounting'); ?>
<script>

    document.getElementById('contact_mobile').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('contact_phone').addEventListener('input', function (e) {
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