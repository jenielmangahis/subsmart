<div id="new-customer-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg m-auto">
        <!-- Modal content-->
        <form id="add-customer-form">
        <div class="modal-content max-width">
            <div class="modal-header" style="border-bottom: 0">
                <div class="modal-title">Customer Information</div>
                <button type="button" class="close cancel-add-customer">&times;</button>
            </div>
            <div class="modal-body overflow-auto">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card p-0 m-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col-sm-2">
                                                    <div class="form-ib">
                                                        <label for="title">Title</label>
                                                        <input type="text" name="title" id="title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="f_name">First name</label>
                                                        <input type="text" name="f_name" id="f_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="m_name">Middle name</label>
                                                        <input type="text" name="m_name" id="m_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="l_name">Last name</label>
                                                        <input type="text" name="l_name" id="l_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-ib">
                                                        <label for="suffix">Suffix</label>
                                                        <input type="text" name="suffix" id="suffix" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="company">Company</label>
                                                        <input type="text" name="company" id="company" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="display_name"><span class="text-danger">*</span> Display name as</label>
                                                        <input type="text" name="display_name" id="display_name" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="print_on_check_name" style="margin-right: 10px">Print on check as </label>
                                                        <input type="checkbox" value="1" name="use_display_name" id="use_display_name" checked><label for="use_display_name" class="ml-3">Use display name</label>
                                                        <input type="text" name="print_on_check_name" id="print_on_check_name" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control" name="email" id="email" placeholder="Separate multiple emails with commas">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" name="phone" id="phone" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" name="mobile" id="mobile" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="fax">Fax</label>
                                                        <input type="text" name="fax" id="fax" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="website">Website</label>
                                                        <input type="text" name="website" id="website" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <input type="checkbox" value="1" name="sub_customer" id="sub_customer"><label for="sub_customer" class="ml-3">Is sub-customer</label>
                                                        <select name="parent_customer" id="parent_customer" class="form-control" disabled>
                                                            <option value="" selected disabled>&nbsp;</option>
                                                            <?php if(count($customers) > 0) : ?>
                                                                <?php foreach($customers as $customer) :?>
                                                                    <option value="<?=$customer->prof_id?>"><?=$customer->first_name . ' ' . $customer->last_name?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="bill_with">&nbsp;</label>
                                                        <select name="bill_with" id="bill_with" class="form-control" disabled>
                                                            <option value="">Bill with parent</option>
                                                            <option value="">Bill this customer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="banking-tab-container">
                                            <a href="#address-tab" role="tab" aria-controls="address-tab" aria-selected="true" data-toggle="tab" class="banking-tab-active text-decoration-none">Address</a>
                                            <a href="#notes-tab" role="tab" aria-controls="notes-tab" aria-selected="false" data-toggle="tab" class="banking-tab">Notes</a>
                                            <a href="#tax-tab" role="tab" aria-controls="tax-tab" aria-selected="false" data-toggle="tab" class="banking-tab">Tax info</a>
                                            <a href="#payment-tab" role="tab" aria-controls="payment-tab" aria-selected="false" data-toggle="tab" class="banking-tab">Payment and billing</a>
                                            <a href="#attachments-tab" role="tab" aria-controls="attachments-tab" aria-selected="false" data-toggle="tab" class="banking-tab">Attachments</a>
                                            <a href="#additional-info-tab" role="tab" aria-controls="additional-info-tab" aria-selected="false" data-toggle="tab" class="banking-tab">Additional info</a>
                                        </div>

                                        <div class="tab-content mt-3" id="customer-details-tabs">
                                            <div class="tab-pane fade show active" id="address-tab" role="tabpanel" aria-labelledby="address-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col-12">
                                                                    <div class="form-ib">
                                                                        <label for="street" style="margin-right: 10px">Address</label>
                                                                        <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                                                        <textarea name="street" id="street" cols="30" rows="2" class="form-control" placeholder="Street" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="city" type="text" class="form-control" placeholder="City/Town" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="state" type="text" class="form-control" placeholder="State/Province" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="zip" type="text" class="form-control" placeholder="ZIP Code" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="country" type="text" class="form-control" placeholder="Country" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col-12">
                                                                    <div class="form-ib">
                                                                        <label for="shipping_address" style="margin-right: 10px">Shipping address </label>
                                                                        <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                                                        <input type="checkbox" value="1" name="same_as_billing_add" id="same_as_billing_add" checked>
                                                                        <label for="same_as_billing_add" class="ml-3">Same as billing address</label>
                                                                        <textarea name="shipping_address" id="shipping_address" cols="30" rows="2" class="form-control" placeholder="Street" disabled></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="shipping_city" id="shipping_city" type="text" class="form-control" placeholder="City/Town" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="shipping_state" id="shipping_state" type="text" class="form-control" placeholder="State/Province" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="shipping_zip" id="shipping_zip" type="text" class="form-control" placeholder="ZIP Code" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-ib mt-1">
                                                                        <input name="shipping_country" id="shipping_country" type="text" class="form-control" placeholder="Country" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="notes-tab" role="tabpanel" aria-labelledby="notes-tab">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    <div class="form-ib">
                                                                        <label for="notes">Notes</label>
                                                                        <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tax-tab" role="tabpanel" aria-labelledby="tax-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col-8">
                                                                    <div class="form-ib">
                                                                        <input type="checkbox" value="1" name="cust_tax_exempt" id="cust_tax_exempt">
                                                                        <label for="cust_tax_exempt" class="ml-3">This customer is tax exempt</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-10">
                                                                    <div class="form-ib">
                                                                        <label for="tax_rate">Select tax rate</label>
                                                                        <select name="tax_rate" id="tax_rate" class="form-control">
                                                                            <option value="">Based on location</option>
                                                                            <optgroup label="Custom Rates">
                                                                                <option value="">Escambia county &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 7.50%</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col-6">
                                                                    <div class="form-ib">
                                                                        <label for="cust_payment_method">Preferred payment method</label>
                                                                        <select name="cust_payment_method" id="cust_payment_method" class="form-control">
                                                                            <option value="" selected disabled>&nbsp;</option>
                                                                            <?php foreach($paymentMethods as $paymentMethod) : ?>
                                                                                <option value="<?=$paymentMethod['id']?>"><?=$paymentMethod['name']?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-6">
                                                                    <div class="form-ib">
                                                                        <label for="delivery_method">Preferred delivery method</label>
                                                                        <select name="delivery_method" id="delivery_method" class="form-control">
                                                                            <option value="">Print later</option>
                                                                            <option value="">Send later</option>
                                                                            <option value="">None</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col-4">
                                                                    <div class="form-ib">
                                                                        <label for="cust_payment_terms">Terms</label>
                                                                        <select name="cust_payment_terms" id="cust_payment_terms" class="form-control">
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
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-4">
                                                                    <div class="form-ib">
                                                                        <label for="opening_balance">Opening balance</label>
                                                                        <input type="number" name="opening_balance" id="opening_balance" class="form-control text-right" onchange="convertToDecimal(this)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-ib">
                                                                        <label for="as_of_date">as of</label>
                                                                        <input type="text" name="as_of_date" id="as_of_date" class="form-control datepicker" value="<?=date("m/d/Y")?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="attachments-tab" role="tabpanel" aria-labelledby="attachments-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    <div class="form-ib">
                                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                                        <span>Maximum size: 20MB</span>
                                                                        <div id="custAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                                            <div class="dz-message" style="margin: 20px;border">
                                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="additional-info-tab" role="tabpanel" aria-labelledby="additional-info-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-ib-group">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    <div class="form-ib">
                                                                        <label for="customer_type">Customer Type</label>
                                                                        <select name="customer_type" id="customer_type" class="form-control">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-md-6"><button type="button" class="btn btn-transparent cancel-add-customer">Cancel</button></div>
                    <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>