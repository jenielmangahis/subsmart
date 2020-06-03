<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/invoice'); ?>
    <link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">New Recurring Invoice</h1>
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
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Recurring Invoices
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="validation-error" id="estimate-error" style="display: none;">You selected Credit Card Payments as payment method for this invoice. Please configure the <a href="#">Online Payment processor</a> first to accept cart payments.</div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('invoice/save_recurring', ['class' => 'form-validate require-validation', 'id' => 'recurring_form', 'autocomplete' => 'off']); ?>

            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
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
                                       data-target="#modalNewCustomer"><span
                                                class="fa fa-plus fa-margin-right"></span>New Customer</a>
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
                                       data-target="#modalNewLocationAddress"><span
                                                class="fa fa-plus fa-margin-right"></span>New Location Address</a>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="job_name">Job Name <small class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" required/>
                                </div>
                            </div>
                            
                            <div class="row">
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
                                    <label for="work_order">Work Order# <small class="help help-sm">(optional)</small></label>
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
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Start On</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="start_on" id="start_on" class="form-control">
                                        <div class="input-group-append" data-for="start_on">
                                            <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="due_terms">Due Terms</label>
                                    <span class="fa fa-question-circle text-ter" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="The system calculates invoice due date based on this option." data-original-title="" title=""></span>
                                    <select name="due_terms" class="form-control">
                                        <option value="Due on Reciept">Due on Reciept</option>
                                        <option value="Net 7">Net 7</option>
                                        <option value="Net 15">Net 15</option>
                                        <option value="Net 30">Net 30</option>
                                        <option value="Net 45">Net 45</option>
                                        <option value="Net 60">Net 60</option>
                                        <option value="Due End of the month">Due End of the month</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <label for="repeats">Repeats</label>
                                    <select name="repeats" class="form-control">
                                        <option value="Daily">Daily</option>
                                        <option selected value="Weekly">Weekly</option>
                                        <option value="Montly">Monthly</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Ends</label>
                                    <div class="recurring-ends-row"><label class="weight-normal">
                                        <input type="radio" name="recurring_end" value="never" checked="checked"> Never</label>
                                    </div>
                                    <div class="recurring-ends-row"><label class="weight-normal">
                                        <input type="radio" name="recurring_end" value="on">
                                        <span style="display:inline-block; width: 45px;"> On</span></label> 
                                        <input type="text" name="recurring_until" value="" id="recurring_until" class="hasDatepicker">
                                    </div>
                                    <div class="recurring-ends-row">
                                        <label class="weight-normal">
                                            <input type="radio" name="recurring_end" value="count">
                                            <span style="display:inline-block; width: 45px;"> After</span>
                                        </label> 
                                        <input type="text" name="recurring_count" value="0" class="recurring-count text-center">&nbsp; invoices
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="" data-calendar="recurring-interval" style="display: block;">
                                        <label>Repeat Every</label>
                                        <div>
                                            <select name="recurring_interval" class="recurring-interval form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                            </select>
                                            <span data-calendar="recurring-interval-text">weeks</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                </div>
                                <div class="col-md-6">
                                    <div class="" data-calendar="recurring-frequency-week" style="display: block;">
                                        <div class="margin-bottom-sec">
                                            <label>Repeat on</label>
                                            <div>
                                                <div class="checkbox checkbox-sec margin-right-sec">
                                                    <input type="checkbox" name="recurring_frequency_weekday[]" value="mo" id="recurring_frequency_weekday_mo">
                                                    <label for="recurring_frequency_weekday_mo">Mo</label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right-sec">
                                                    <input type="checkbox" name="recurring_frequency_weekday[]" value="tu" id="recurring_frequency_weekday_tu">
                                                    <label for="recurring_frequency_weekday_tu">Tu</label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right-sec">
                                                    <input type="checkbox" name="recurring_frequency_weekday[]" value="we" id="recurring_frequency_weekday_we">
                                                    <label for="recurring_frequency_weekday_we">We</label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right-sec">
                                                    <input type="checkbox" name="recurring_frequency_weekday[]" value="th" id="recurring_frequency_weekday_th">
                                                    <label for="recurring_frequency_weekday_th">Th</label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right-sec">
                                                    <input type="checkbox" name="recurring_frequency_weekday[]" value="fr" id="recurring_frequency_weekday_fr">
                                                    <label for="recurring_frequency_weekday_fr">Fr</label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right-sec">
                                                    <input type="checkbox" name="recurring_frequency_weekday[]" value="sa" id="recurring_frequency_weekday_sa">
                                                    <label for="recurring_frequency_weekday_sa">Sa</label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right-sec">
                                                    <input type="checkbox" name="recurring_frequency_weekday[]" value="su" id="recurring_frequency_weekday_su">
                                                    <label for="recurring_frequency_weekday_su">Su</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <label>Send Invoice On</label>
                                    <div class="help help-sm help-block">The child invoice will be created as draft and sent at selected time.</div>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-6">
                                            <div class="input-group mb-3">
                                                <input type="text" name="recurring_scheduled_time" value="7:00am" class="form-control ui-timepicker-input" id="recurring_scheduled_time" autocomplete="off">
                                                <div class="input-group-append calendar-button" data-for="recurring_scheduled_time">
                                                    <span class="input-group-text"><span class="fa fa-clock-o"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="plansItemDiv">
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
                                        <tr>
                                            <th>Item</th>
                                            <th>Type</th>
                                            <th width="100px" id="qty_type_value">Quantity</th>
                                            <th width="100px">Price</th>
                                            <th width="100px">Discount</th>
                                            <th>Tax(%)</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body">
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
                                        <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice"><span
                                                    class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
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

                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Accepted payment methods</h5>
                                    <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                                </div>
                                <div class="col-md-12">
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
                            </div>

                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <h5>Message to Customer</h5>
                                    <span class="help help-sm help-block">Add a message that will be displayed on the invoice.</span>
                                    <textarea name="message" cols="40" rows="2" class="form-control">Thank you for your business.</textarea>
                                </div>
                                <div class="col-sm-6">
                                    <h5>Terms &amp; Conditions</h5>
                                    <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the invoice.</span>
                                    <textarea name="terms" cols="40" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="col-sm-12">
                                    <h5>Attachments</h5>
                                    <div class="margin-bottom">No files</div>
                                </div>
                                <div class="col-sm-12">
                                    <h5>Recurring Settings</h5>
                                    <div class="margin-bottom">Create and send child invoice to customer</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button class="btn btn-primary margin-right" data-action="save">Save</button>
                                    <a class="a-ter" href="<?php echo url('invoice/recurring') ?>">cancel this</a>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">New Customer</h4>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Add New Source</h4>
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
<?php include viewPath('includes/footer'); ?>

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