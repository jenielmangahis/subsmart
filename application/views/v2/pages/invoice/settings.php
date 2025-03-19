<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoce_tabs_v2'); ?>
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
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['id' => 'frm-invoice-settings', 'class' => 'form-validate require-validation', 'autocomplete' => 'off']); ?>
                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Logo</span>
                                        </div>
                                        <label class="nsm-subtitle">Customize your invoice, estimate or email to better match your branding. Your logo will appear on the top left corner.</label>
                                    </div>
                                    <div class="nsm-card-content">
                                        <input type="hidden" name="img_setting" value="<?php echo $setting->logo ?>">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="nsm-img-upload" style="background-image: url('<?php echo base_url() . 'uploads/invoice/settings/'.$setting->company_id.'/'. $setting->logo ?>')">
                                                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                                    <input type="file" name="userfile" class="nsm-upload" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button class="nsm-button m-0">Delete Logo</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Invoice Number</span>
                                        </div>
                                        <label class="nsm-subtitle">Set the prefix and the next auto-generated number.</label>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-3">
                                                <input type="text" placeholder="Prefix" name="prefix" class="nsm-field form-control" value="<?php echo ($setting) ? $setting->invoice_num_prefix : 'INV-' ?>" autocomplete="off" />
                                                <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_prefix" data-formerrors-message="true"></span>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" placeholder="Next Number" name="base" class="nsm-field form-control" value="<?php echo ($setting) ? $setting->invoice_num_next : 1  ?>" autocomplete="off" />
                                                <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_base" data-formerrors-message="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Invoice PDF</span>
                                        </div>
                                        <label class="nsm-subtitle">Select invoice template you want to use.</label>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-12">
                                                <div class="input-group mb-3">
                                                <select class="nsm-field form-select" name="invoice_template">
                                                    <option value="1" <?php echo $setting->invoice_template == 1 ? 'selected' : ''; ?>>Standard</option>
                                                    <!-- <option value="2" <?php echo $setting->invoice_template == 2 ? 'selected' : ''; ?>>Mailing</option> -->
                                                    <option value="3" <?php echo $setting->invoice_template == 3 ? 'selected' : ''; ?>>Mobile</option>
                                                </select>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Payment Fee</span>
                                            <div class="form-check pull-right">
                                                <input class="form-check-input chk-field-group" name="disable_payment_fee" type="checkbox" value="1" <?= $setting && $setting->disable_payment_fee == 1 ? 'checked="checked"' : ''; ?> id="chk-enable-payment-fee">
                                                <label class="form-check-label" for="chk-enable-payment-fee">Disable Payment Fee</label>
                                            </div>
                                        </div>
                                        <label class="nsm-subtitle">Add a payment fee (percent or fixed) to online payments.</label>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="">%</span>
                                                    <input type="number" step="any" min=0 class="form-control nsm-field" placeholder="Payment Fee Percent %" name="payment_fee_percent" id="payment_fee_percent" <?= $setting && $setting->disable_payment_fee == 1 ? 'disabled=""' : ''; ?> value="<?php echo ($setting) ? $setting->payment_fee_percent : '0.00' ?>">                                                    
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="">$</span>
                                                    <input type="number" step="any" min=0 class="form-control nsm-field" placeholder="Payment Fee Fixed $" name="payment_fee_amount" id="payment_fee_amount" <?= $setting && $setting->disable_payment_fee == 1 ? 'disabled=""' : ''; ?> value="<?php echo ($setting) ? $setting->payment_fee_amount : '0.00' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Late Fee</span>
                                                    <div class="form-check pull-right">
                                                        <input class="form-check-input chk-field-group" name="disable_late_fee" type="checkbox" value="1" <?= $setting && $setting->disable_late_fee == 1 ? 'checked="checked"' : ''; ?> id="chk-enable-late-fee">
                                                        <label class="form-check-label" for="chk-enable-late-fee">Disable Late Fee</label>
                                                    </div>
                                                </div>
                                                <label class="nsm-subtitle">Late fee amount per day when invoice is overdue</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-6">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="">$</span>
                                                            <input type="number" step="any" min=0 class="form-control nsm-field" placeholder="Amount" name="late_fee_amount_per_day" id="late_fee_amount_per_day" <?= $setting && $setting->disable_late_fee == 1 ? 'disabled=""' : ''; ?> value="<?php echo ($setting) ? $setting->late_fee_amount_per_day : '0.00' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Activate Late Fee</span>
                                                </div>
                                                <label class="nsm-subtitle">Number of business days before activating late fee charges</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-6">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id=""><i class='bx bx-alarm' ></i></span>
                                                            <input type="number" step="any" min=0 class="form-control nsm-field" placeholder="Number of days" name="num_days_activate_late_fee" id="num_days_activate_late_fee" <?= $setting && $setting->disable_late_fee == 1 ? 'disabled=""' : ''; ?> value="<?php echo ($setting) ? $setting->num_days_activate_late_fee : '0'; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                            <!-- <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-content text-center">
                                        <button onclick="location.href='<?php echo base_url('invoice') . '/settings/preferences/notifications' ?>'" class="nsm-button primary">
                                            Manage invoice notifications
                                        </button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-content">
                                        <div class="nsm-tab">
                                            <nav>
                                                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="nav-residential-tab" data-bs-toggle="tab" data-bs-target="#nav-residential" type="button" role="tab" aria-controls="nav-residential" aria-selected="true">Residential</button>
                                                    <button class="nav-link" id="nav-commercial-tab" data-bs-toggle="tab" data-bs-target="#nav-commercial" type="button" role="tab" aria-controls="nav-commercial" aria-selected="false">Commercial</button>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-residential" role="tabpanel" aria-labelledby="nav-residential-tab">
                                                    <div class="row g-2">
                                                        <div class="col-12 col-md-6">
                                                            <div class="nsm-card-title">
                                                                <span>Residential Invoice Default Message</span>
                                                            </div>
                                                            <label class="nsm-subtitle">Custom message that will be placed at the bottom section of the invoice.</label>
                                                            <textarea name="message" id="message" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->residential_message : '' ?></textarea>
                                                            <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="nsm-card-title">
                                                                <span>Residential Invoice Default Terms & Conditions</span>
                                                            </div>
                                                            <label class="nsm-subtitle">Your T&C that will appear at the bottom section of the invoice.</label>
                                                            <textarea name="terms" id="terms" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->residential_terms_and_conditions : '' ?></textarea>
                                                            <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="nav-commercial" role="tabpanel" aria-labelledby="nav-commercial-tab">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1" id="same_as_residential" name="terms_message_as_residential">
                                                                <label class="form-check-label" for="same_as_residential">
                                                                    Set default value as Residential
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-12 col-md-6">
                                                            <div class="nsm-card-title">
                                                                <span>Commercial Invoice Default Message</span>
                                                            </div>
                                                            <label class="nsm-subtitle">Custom message that will be placed at the bottom section of the invoice.</label>
                                                            <textarea name="message_commercial" id="message_commercial" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->commercial_message : '' ?></textarea>
                                                            <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="nsm-card-title">
                                                                <span>Commercial Invoice Default Terms & Conditions</span>
                                                            </div>
                                                            <label class="nsm-subtitle">Your T&C that will appear at the bottom section of the invoice.</label>
                                                            <textarea name="terms_commercial" id="terms_commercial" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" ><?php echo ($setting) ? $setting->commercial_terms_and_conditions : '' ?></textarea>
                                                            <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Make Check Payable To</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">This field will appear in the invoice payment section.</label>
                                                <input type="text" name="payment_to" class="nsm-field form-control" value="<?php echo ($setting) ? $setting->check_payable_to : '' ?>" autocomplete="off" />
                                                <span class="validation-error-field hide" data-formerrors-for-name="payment_to" data-formerrors-message="true"></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Due Terms</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">System calculates due date based on this option.</label>
                                                <select class="nsm-field form-select" name="due_terms">
                                                    <?php if ($setting) : ?>
                                                        <option value="onreceipt" selected="selected"><?php echo $setting->due_terms ?></option>
                                                    <?php else : ?>
                                                        <option value="onreceipt" selected="selected">Due on Reciept</option>
                                                    <?php endif; ?>
                                                    <option value="net7">Net 7</option>
                                                    <option value="net15">Net 15</option>
                                                    <option value="net30">Net 30</option>
                                                    <option value="net45">Net 45</option>
                                                    <option value="net60">Net 60</option>
                                                    <option value="endofmonth">Due End of the month</option>
                                                </select>
                                                <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Accepted Payment Methods</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">Select payment methods that will be listed on your invoice.</label>
                                                <div class="d-block">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="payment_cc" value="1" id="payment_method_cc" <?php echo ($setting && $setting->accept_credit_card) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="payment_method_cc">Credit Card</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="payment_check" value="1" id="payment_method_check" <?php echo ($setting && $setting->accept_check) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="payment_method_check">Check</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="payment_cash" value="1" id="payment_method_cash" <?php echo ($setting && $setting->accept_cash) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="payment_method_cash">Cash</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="payment_deposit" value="1" id="payment_method_deposit" <?php echo ($setting && $setting->accept_direct_deposit) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="payment_method_deposit">Direct Deposit</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Accepting Mobile Payments</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">Check if you accept credit card payments using mobile devices (e.g. Square ).</label>
                                                <div class="d-block">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="payment_mobile_status" value="1" id="payment_mobile_status" <?php echo ($setting && $setting->mobile_payment) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="payment_mobile_status">Direct Deposit</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Invoice Template</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">Select from the options below the item fields you want hidden on your invoice template.</label>
                                                <div class="d-block">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="hide_item_price" value="1" id="hide_item_price" <?php echo ($setting && $setting->hide_item_price) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="hide_item_price">Hide item price</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="hide_item_qty" value="1" id="hide_item_qty" <?php echo ($setting && $setting->hide_item_qty) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="hide_item_qty">Hide item quantity</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="hide_item_tax" value="1" id="hide_item_tax" <?php echo ($setting && $setting->hide_item_tax) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="hide_item_tax">Hide item tax</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="hide_item_discount" value="1" id="hide_item_discount" <?php echo ($setting && $setting->hide_item_discount) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="hide_item_discount">Hide item discount</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="hide_item_total" value="1" id="hide_item_total" <?php echo ($setting && $setting->hide_item_total) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="hide_item_total">Hide item total</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="hide_from_email" value="1" id="hide_from_email" <?php echo ($setting && $setting->hide_from_email) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="hide_from_email">Hide business email</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="show_item_type_subtotal" value="1" id="show_item_type_subtotal" <?php echo ($setting && $setting->hide_item_subtotal) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="show_item_type_subtotal">Display subtotal for service, material, product</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Invoice From - Phone Number</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">What phone number should appear on invoice.</label>
                                                <div class="d-block">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="from_phone_show" value="1" id="from_phone_show" <?php echo ($setting && $setting->hide_business_phone) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="from_phone_show">Business Phone</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="from_office_phone_show" value="1" id="from_office_phone_show" <?php echo ($setting && $setting->hide_office_phone) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="from_office_phone_show">Office Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Tipping</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">Allows you to accept tip along with the credit card payments when the customer pays an invoice online.</label>
                                                <div class="d-block">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="tip_status" value="1" id="tip_status" <?php echo ($setting && $setting->accept_tip) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="tip_status">Accept tip</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="nsm-card-title">
                                                    <span>Autoconvert Completed Work Order to Invoice</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">When a Work Order is marked as completed the system will automatically convert the Work Order to Invoice.</label>
                                                <div class="d-block">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="autoconvert_work_order" value="1" id="autoconvert_work_order" <?php echo ($setting && $setting->auto_convert_completed_work_order) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="autoconvert_work_order">Autoconvert completed work order to invoice</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="nsm-card-title">
                                                    <span>Recurring Invoice</span>
                                                </div>
                                                <label class="nsm-subtitle mb-3">Then a new child invoice is created select to save it as draft or send it to customer.</label>
                                                <div class="d-block">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="recurring_on_add_child" value="1" id="recurring_on_add_child" <?php echo ($setting && $setting->recurring === '1') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="recurring_on_add_child">Create child invoice as draft</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="recurring_on_add_child" value="2" id="recurring_on_add_child_2" <?php echo ($setting && $setting->recurring === '2') ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="recurring_on_add_child_2">Create and send child invoice to customer</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <?php if( $industrySpecificFields ){ ?>
                                <div class="col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-content">
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <div class="nsm-card-title">
                                                        <span>Industry Specific Fields</span>
                                                    </div>
                                                    <label class="nsm-subtitle mb-3"></label>
                                                    <div class="d-block">
                                                        <?php foreach( $industrySpecificFields as $field_value => $field_name ){ ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="industry_specific_fields[]" value="<?= $field_value; ?>" id="industry-specific-<?= $field_value; ?>">
                                                            <label class="form-check-label" for="industry-specific-<?= $field_value; ?>">Disable <?= $field_name; ?></label>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-12 text-end">
                                <button type="submit" data-action="save" id="btn-save-invoice-settings" class="nsm-button primary">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#payment_fee_percent').on('change', function(){
            $('#payment_fee_amount').val(0);
        });

        $('#payment_fee_amount').on('change', function(){
            $('#payment_fee_percent').val(0);
        });

        $('#chk-enable-payment-fee').on('change', function(){
            if( $(this).is(':checked') ){
                $('#payment_fee_percent').attr('disabled', true);
                $('#payment_fee_amount').attr('disabled', true);
            }else{
                $('#payment_fee_percent').attr('disabled', false);
                $('#payment_fee_amount').attr('disabled', false);
            }
        });

        $('#chk-enable-late-fee').on('change', function(){
            if( $(this).is(':checked') ){
                $('#late_fee_amount_per_day').attr('disabled', true);
                $('#num_days_activate_late_fee').attr('disabled', true);
            }else{
                $('#late_fee_amount_per_day').attr('disabled', false);
                $('#num_days_activate_late_fee').attr('disabled', false);
            }
        });

        $('#frm-invoice-settings').on('submit', function(e){
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: base_url + "invoice/_save_setting",
                data: formData, 
                dataType:'json',
                success: function(result) {
                    if( result.is_success == 1 ){
                        Swal.fire({                            
                            text: "Invoice setting was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                //location.reload();
                            //}
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }
                    $('#btn-save-invoice-settings').html('Save Changes');
                }, beforeSend: function() {
                    $('#btn-save-invoice-settings').html('<span class="bx bx-loader bx-spin"></span>');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>