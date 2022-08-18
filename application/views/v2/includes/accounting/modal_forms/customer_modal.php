<div id="customer-modal" class="modal fade modal-fluid nsm-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl m-auto">
        <!-- Modal content-->
        <form id="add-customer-form" class="m-auto">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Customer Information</span>
                <button type="button" class="cancel-add-customer" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body overflow-auto">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="row">
                            <div class="col-6 col-md-1">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control nsm-field mb-2">
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="f_name">First name</label>
                                <input type="text" name="f_name" id="f_name" class="form-control nsm-field mb-2">
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="m_name">Middle name</label>
                                <input type="text" name="m_name" id="m_name" class="form-control nsm-field mb-2">
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="l_name">Last name</label>
                                <input type="text" name="l_name" id="l_name" class="form-control nsm-field mb-2">
                            </div>
                            <div class="col-6 col-md-2">
                                <label for="suffix">Suffix</label>
                                <input type="text" name="suffix" id="suffix" class="form-control nsm-field mb-2">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="email">Email</label>
                        <input type="text" class="form-control nsm-field mb-2" name="email" id="email" placeholder="Separate multiple emails with commas">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="company">Company</label>
                        <input type="text" name="company" id="company" class="form-control nsm-field mb-2">
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control nsm-field mb-2">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control nsm-field mb-2">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" id="fax" class="form-control nsm-field mb-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="display_name"><span class="text-danger">*</span> Display name as</label>
                        <input type="text" name="display_name" id="display_name" class="form-control nsm-field mb-2" required>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website" class="form-control nsm-field mb-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="print_on_check_name" style="margin-right: 10px">Print on check as </label>
                        <input type="checkbox" value="1" name="use_display_name" id="use_display_name" class="form-check-input" checked><label for="use_display_name" class="form-check-label">Use display name</label>
                        <input type="text" name="print_on_check_name" id="print_on_check_name" class="form-control nsm-field mb-2" disabled>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="checkbox" value="1" name="sub_customer" id="sub_customer" class="form-check-input"><label for="sub_customer" class="form-check-label">Is sub-customer</label>
                                <select name="parent_customer" id="parent_customer" class="form-control nsm-field mb-2" disabled>
                                    <option value="" selected disabled>&nbsp;</option>
                                    <?php if(count($customers) > 0) : ?>
                                        <?php foreach($customers as $customer) :?>
                                            <option value="<?=$customer->prof_id?>"><?=$customer->first_name . ' ' . $customer->last_name?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="bill_with">&nbsp;</label>
                                <select name="bill_with" id="bill_with" class="form-control nsm-field mb-2" disabled>
                                    <option value="">Bill with parent</option>
                                    <option value="">Bill this customer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="address-tab" data-bs-toggle="tab" data-bs-target="#address-tab-pane" type="button" role="tab" aria-controls="address-tab-pane" aria-selected="true">Address</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes-tab-pane" type="button" role="tab" aria-controls="notes-tab-pane" aria-selected="false">Notes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tax-tab" data-bs-toggle="tab" data-bs-target="#tax-tab-pane" type="button" role="tab" aria-controls="tax-tab-pane" aria-selected="false">Tax info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane" aria-selected="false">Payment and billing</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="attachments-tab" data-bs-toggle="tab" data-bs-target="#attachments-tab-pane" type="button" role="tab" aria-controls="attachments-tab-pane" aria-selected="false">Attachments</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="additional-info-tab" data-bs-toggle="tab" data-bs-target="#additional-info-tab-pane" type="button" role="tab" aria-controls="additional-info-tab-pane" aria-selected="false">Additional info</button>
                            </li>
                        </ul>

                        <div class="tab-content mt-3" id="customer-details-tab">
                            <div class="tab-pane fade show active" id="address-tab-pane" role="tabpanel" aria-labelledby="address-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="street" style="margin-right: 10px">Address</label>
                                        <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                        <textarea name="street" id="street" cols="30" rows="2" class="form-control nsm-field mb-2" placeholder="Street" required></textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="shipping_address" style="margin-right: 10px">Shipping address </label>
                                        <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                        <input type="checkbox" value="1" name="same_as_billing_add" id="same_as_billing_add" class="form-check-input" checked>
                                        <label for="same_as_billing_add" class="form-check-label">Same as billing address</label>
                                        <textarea name="shipping_address" id="shipping_address" cols="30" rows="2" class="form-control nsm-field mb-2" placeholder="Street" disabled></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row h-100 align-items-end">
                                            <div class="col-12 col-md-6">
                                                <input name="city" type="text" class="form-control nsm-field mb-2" placeholder="City/Town" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input name="state" type="text" class="form-control nsm-field mb-2" placeholder="State/Province" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row h-100 align-items-end">
                                            <div class="col-6">
                                                <input name="shipping_city" id="shipping_city" type="text" class="form-control nsm-field mb-2" placeholder="City/Town" disabled>
                                            </div>
                                            <div class="col-6">
                                                <input name="shipping_state" id="shipping_state" type="text" class="form-control nsm-field mb-2" placeholder="State/Province" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row h-100 align-items-end">
                                            <div class="col-12 col-md-6">
                                                <input name="zip" type="text" class="form-control nsm-field mb-2" placeholder="ZIP Code" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input name="country" type="text" class="form-control nsm-field mb-2" placeholder="Country" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row h-100 align-items-end">
                                            <div class="col-6">
                                                <input name="shipping_zip" id="shipping_zip" type="text" class="form-control nsm-field mb-2" placeholder="ZIP Code" disabled>
                                            </div>
                                            <div class="col-6">
                                                <input name="shipping_country" id="shipping_country" type="text" class="form-control nsm-field mb-2" placeholder="Country" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="notes-tab-pane" role="tabpanel" aria-labelledby="notes-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="notes">Notes</label>
                                        <textarea name="notes" id="notes" cols="30" rows="2" class="form-control nsm-field mb-2"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tax-tab-pane" role="tabpanel" aria-labelledby="tax-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <input type="checkbox" value="1" name="cust_tax_exempt" id="cust_tax_exempt" class="form-check-input">
                                        <label for="cust_tax_exempt" class="form-check-label">This customer is tax exempt</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="tax_rate">Select tax rate</label>
                                        <select name="tax_rate" id="tax_rate" class="form-control nsm-field mb-2">
                                            <option value="">Based on location</option>
                                            <optgroup label="Custom Rates">
                                                <option value="">Escambia county &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 7.50%</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="payment-tab-pane" role="tabpanel" aria-labelledby="payment-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="cust_payment_method">Preferred payment method</label>
                                        <select name="cust_payment_method" id="cust_payment_method" class="form-control nsm-field mb-2">
                                            <option value="" selected disabled>&nbsp;</option>
                                            <?php foreach($paymentMethods as $paymentMethod) : ?>
                                                <option value="<?=$paymentMethod['id']?>"><?=$paymentMethod['name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="cust_payment_terms">Terms</label>
                                        <select name="cust_payment_terms" id="cust_payment_terms" class="form-control nsm-field mb-2">
                                            <option value="" selected disabled>&nbsp;</option>
                                            <option value="add-new">&plus; Add new</option>
                                            <?php if(count($terms) > 0) : ?>
                                            <?php foreach($terms as $term) : ?>
                                                <option value="<?=$term->id?>"><?=$term->name?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="delivery_method">Preferred delivery method</label>
                                        <select name="delivery_method" id="delivery_method" class="form-control nsm-field mb-2">
                                            <option value="">Print later</option>
                                            <option value="">Send later</option>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="opening_balance">Opening balance</label>
                                                <input type="number" name="opening_balance" id="opening_balance" class="form-control nsm-field mb-2 text-end" onchange="convertToDecimal(this)">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label for="as_of_date">as of</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" name="as_of_date" id="as_of_date" class="form-control nsm-field mb-2 date" value="<?=date("m/d/Y")?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="attachments-tab-pane" role="tabpanel" aria-labelledby="attachments-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                        <span>Maximum size: 20MB</span>
                                        <div id="customerAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                            <div class="dz-message" style="margin: 20px;border">
                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="additional-info-tab-pane" role="tabpanel" aria-labelledby="additional-info-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="customer_type">Customer Type</label>
                                        <select name="customer_type" id="customer_type" class="form-control nsm-field mb-2">
                                            <option value="Residential">Residential</option>
                                            <option value="Business">Business</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-12 col-md-6">
                        <button type="button" class="nsm-button cancel-add-customer" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="nsm-button success float-end" name="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- <script>
Dropzone.autoDiscover = false;
    var fname = [];
    var selected = [];
    var custAttachment = new Dropzone('#custAttachment', {
        url: base_url + 'users/profilePhoto',
        acceptedFiles: "image/*",
        maxFilesize:20,
        maxFiles: 1,
        addRemoveLinks:true,
        init: function() {
            
        },
        removedfile:function (file) {
            
        }
    });
</script> -->