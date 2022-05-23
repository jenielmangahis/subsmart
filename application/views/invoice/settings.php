<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/invoice'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Settings</h1>
                    </div>
                    <div class="col-sm-12">
                        <div class="validation-error" id="estimate-error" style="display: none;">You selected Credit Card Payments as payment method for this invoice. Please configure the <a href="https://www.markate.com/pro/settings/payments/main">Online Payment processor</a> first to accept cart payments.</div>
                    </div>
                </div>
            </div>
            <?php echo form_open_multipart('invoice/save_setting/' . (($setting) ? $setting->id : ''), ['class' => 'form-validate require-validation', 'id' => 'settings_form', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Logo</h5>
                                    <span class="help help-sm help-block">Customize your invoice, estimate or email to better match your branding. Your logo will appear on the top left corner.</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="margin-bottom-sec">
                                        <?php if ($setting) : ?>
                                            <input type="hidden" name="img_setting" value="<?php echo $setting->logo ?>">
                                            <img class="img-responsive" id="img_profile" style="max-width: 80%;" data-fileupload="image-logo" src="<?php echo base_url() .'uploads/'. $setting->logo ?>">
                                         <?php endif;?>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload Logo <input data-fileupload="file-logo" name="userfile" onchange="readURL(this);" type="file"></span> <a class="a-default margin-left" href="#" data-fileupload="delete-logo"><span class="fa fa-trash"></span> Delete Logo</a>
                                    </div>
                                    <div class="" data-fileupload="progressbar-logo" style="display: none;">
                                        <div class="text">Uploading</div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                        </div>
                                    </div>
                                    <div class="alert alert-danger" data-fileupload="error-logo" role="alert" style="display: none;"></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Invoice Number</h5>
                                    <span class="help help-sm help-block">Set the prefix and the next auto-generated number.</span>
                                </div>
                                <div class="col-sm-1">
                                    <div class="margin-bottom-qui">Prefix</div>
                                    <input type="text" name="prefix" class="form-control" autocomplete="off" value="<?php echo ($setting) ? $setting->invoice_num_prefix : 0 ?>">
                                    <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_prefix" data-formerrors-message="true"></span>
                                </div>
                                <div class="col-sm-2">
                                    <div class="margin-bottom-qui">Next number</div>
                                    <input type="text" name="base" value="<?php echo ($setting) ? $setting->invoice_num_next : ''  ?>" class="form-control" autocomplete="off">
                                    <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_base" data-formerrors-message="true"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tabs">
                                        <ul class="clearfix">
                                            <li data-tab="residential" id="res_li" class="active">
                                                <a href="#" id="inv-set-residential">
                                                    Residential
                                                </a>
                                            </li>
                                            <li data-tab="commercial" id="com_li">
                                                <a href="#" id="inv-set-commercial">
                                                    Commercial
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="invoice_type" id="invoice_type" value="residential">
                                    <div id="tab_residential" class="tab-panel">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Residential Invoice Default Message</label>
                                                    <div class="help help-sm help-block">Custom message that will be placed at the bottom section of the invoice.</div>
                                                    <textarea name="message" id="message" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->message : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Residential Invoice Default Terms &amp; Conditions</label>
                                                    <div class="help help-sm help-block">Your T&amp;C that will appear at the bottom section of the invoice.</div>
                                                    <textarea name="terms" id="terms" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->terms_and_conditions : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab_commercial" class="tab-panel" style="display: none;">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="terms_message_as_residential" value="1" id="same_as_residential">
                                                        <label for="same_as_residential">Set default value as Residential</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Commercial Invoice Default Message</label>
                                                    <div class="help help-sm help-block">Custom message that will be placed at the bottom section of the invoice.</div>
                                                    <textarea name="message_commercial" id="message_commercial" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->commercial_message : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Commercial Invoice Default Terms &amp; Conditions</label>
                                                    <div class="help help-sm help-block">Your T&amp;C that will appear at the bottom section of the invoice.</div>
                                                    <textarea name="terms_commercial" id="terms_commercial" cols="40" rows="2" class="form-control" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->commercial_terms_and_conditions : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Make Check Payable To</label>
                                    <div class="help help-sm help-block">This field will appear in the invoice payment section.</div>
                                    <input type="text" name="payment_to" value="<?php echo ($setting) ? $setting->check_payable_to : '' ?>" class="form-control" autocomplete="off" placeholder="" required="">
                                    <span class="validation-error-field hide" data-formerrors-for-name="payment_to" data-formerrors-message="true"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label>Due Terms</label>
                                    <div class="help help-sm help-block">System calculates due date based on this option.</div>
                                    <select name="due_terms" class="form-control">
                                        <?php if ($setting) : ?>
                                            <option value="onreceipt" selected="selected"><?php echo $setting->due_terms ?></option>
                                        <?php else :?>
                                            <option value="onreceipt" selected="selected">Due on Reciept</option>
                                        <?php endif;?>
                                        <option value="net7">Net 7</option>
                                        <option value="net15">Net 15</option>
                                        <option value="net30">Net 30</option>
                                        <option value="net45">Net 45</option>
                                        <option value="net60">Net 60</option>
                                        <option value="endofmonth">Due End of the month</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Accepted Payment Methods</h5>
                                    <div class="help help-sm help-block">Select payment methods that will be listed on your invoice.</div>
                                    <div>
                                        <div class="checkbox checkbox-sec">
                                            <input type="checkbox" name="payment_cc" value="cc" <?php echo ($setting && $setting->accept_credit_card) ? 'checked' : ''?> id="payment_method_cc">
                                            <label for="payment_method_cc"><span>Credit Card</span></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec">
                                            <input type="checkbox" name="payment_check" value="check" <?php echo ($setting && $setting->accept_check) ? 'checked' : ''?> id="payment_method_check">
                                            <label for="payment_method_check"><span>Check</span></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec">
                                            <input type="checkbox" name="payment_cash" value="cash" <?php echo ($setting && $setting->accept_cash) ? 'checked' : ''?> id="payment_method_cash">
                                            <label for="payment_method_cash"><span>Cash</span></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec">
                                            <input type="checkbox" name="payment_deposit" value="deposit" <?php echo ($setting && $setting->accept_direct_deposit) ? 'checked' : ''?> id="payment_method_deposit">
                                            <label for="payment_method_deposit"><span>Direct Deposit</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h5>Accepting Mobile Payments</h5>
                                    <div class="help help-sm help-block">Check if you accept credit card payments using mobile devices (e.g. Square ).</div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="payment_mobile_status" value="1" <?php echo ($setting && $setting->mobile_payment) ? 'checked' : ''?> id="payment_mobile_status">
                                        <label for="payment_mobile_status"><span>I accept mobile payments</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Payment Fee</h5>
                                    <span class="help help-sm help-block">Add a payment fee (percent or fixed) to online payments.</span>
                                </div>
                                <div class="col-sm-3">
                                    <label class="weight-normal" for="payment_fee_percent">Payment Fee Percent %</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="payment_fee_percent" id="payment_fee_percent" value="<?php echo ($setting) ? $setting->payment_fee_percent : ''?>" class="form-control">
                                        <div class="input-group-append" data-for="payment_fee_percent">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="weight-normal" for="payment_fee_amount">Payment Fee Fixed $</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" data-payment-modal="payment_fee_amount" name="payment_fee_amount" value="<?php echo ($setting) ? $setting->payment_fee_amount : '0.00'?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Invoice Template</h5>
                                    <div class="help help-sm help-block">Select from the options below the item fields you want hidden on your invoice template.</div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="hide_item_price" value="1" <?php echo ($setting && $setting->hide_item_price) ? 'checked' : ''?> id="hide_item_price">
                                                <label for="hide_item_price"><span>Hide item price</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="hide_item_qty" value="1" <?php echo ($setting && $setting->hide_item_qty) ? 'checked' : ''?> id="hide_item_qty">
                                                <label for="hide_item_qty"><span>Hide item quantity</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="hide_item_tax" value="1" <?php echo ($setting && $setting->hide_item_tax) ? 'checked' : ''?> id="hide_item_tax">
                                                <label for="hide_item_tax"><span>Hide item tax</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="hide_item_discount" value="1" <?php echo ($setting && $setting->hide_item_discount) ? 'checked' : ''?> id="hide_item_discount">
                                                <label for="hide_item_discount"><span>Hide item discount</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="hide_item_total" value="1" <?php echo ($setting && $setting->hide_item_total) ? 'checked' : ''?> id="hide_item_total">
                                                <label for="hide_item_total"><span>Hide item total</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="hide_from_email" value="1" <?php echo ($setting && $setting->hide_from_email) ? 'checked' : ''?> id="hide_from_email">
                                                <label for="hide_from_email"><span>Hide business email</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="show_item_type_subtotal" value="1" <?php echo ($setting && $setting->hide_item_subtotal) ? 'checked' : ''?> id="show_item_type_subtotal">
                                                <label for="show_item_type_subtotal"><span>Display subtotal for service, material, product</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h5>Invoice From - Phone Number</h5>
                                    <div class="help help-sm help-block">What phone number should appear on invoice.</div>
                                    <div>
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="from_phone_show" value="1" <?php echo ($setting && $setting->hide_business_phone) ? 'checked' : ''?> id="from_phone_show">
                                            <label for="from_phone_show"><span>Business Phone</span></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="from_office_phone_show" value="1" <?php echo ($setting && $setting->hide_office_phone) ? 'checked' : ''?> id="from_office_phone_show">
                                            <label for="from_office_phone_show"><span>Office Phone</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h5>Tipping</h5>
                                        <div class="help help-sm help-block">Allows you to accept tip along with the credit card payments when the customer pays an invoice online.</div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="tip_status" value="1" <?php echo ($setting && $setting->accept_tip) ? 'checked' : ''?> id="tip_status">
                                                    <label for="tip_status"><span>Accept tip</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <h5>Autoconvert Completed Work Order to Invoice</h5>
                                        <div class="help help-sm help-block">When a Work Order is marked as completed the system will automatically convert the Work Order to Invoice.</div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="checkbox checkbox-sec margin-right long-text-break">
                                                    <input type="checkbox" name="autoconvert_work_order" value="1" <?php echo ($setting && $setting->auto_convert_completed_work_order) ? 'checked' : ''?> id="autoconvert_work_order">
                                                    <label for="autoconvert_work_order"><span>Autoconvert completed work order to invoice</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Recurring Invoice</h5>
                                    <div class="help help-sm help-block">
                                        Then a new child invoice is created select to save it as draft or send it to customer.
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="radio" name="recurring_on_add_child" value="1" <?php echo ($setting && $setting->recurring === '1') ? 'checked' : ''?> id="recurring_on_add_child_1">
                                            <label for="recurring_on_add_child_1"><span>Create child invoice as draft</span></label>
                                        </div>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="recurring_on_add_child" value="2" <?php echo ($setting && $setting->recurring === '2') ? 'checked' : ''?> id="recurring_on_add_child_2">
                                        <label for="recurring_on_add_child_2"><span>Create and send child invoice to customer</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <a class="link-modal-open" href="<?php echo base_url('invoice') .'/settings/preferences/notifications' ?>">Manage invoice notifications</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary margin-right" data-action="save">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
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