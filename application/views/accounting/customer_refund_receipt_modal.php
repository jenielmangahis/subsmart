<!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addrefundreceiptModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Refund Receipt
                    </div>
                    <button type="button" class="close" id="closeModalExpense" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form
                    action="<?php echo site_url()?>accounting/addRefundReceipt"
                    method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Customer
                                        <select class="form-control" name="customer_id" id="sel-customer3">
                                            <option></option>
                                            <?php foreach ($customers as $customer) : ?>
                                            <option
                                                value="<?php echo $customer->prof_id; ?>">
                                                <?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        Email
                                        <input type="email" class="form-control" name="email" id="email3">
                                        <a href="#" style="text-align:right;color:blue;"><i> Cc/Bcc </i></a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Billing address
                                        <textarea style="height:100px;width:100%;" name="billing_address"
                                            id="billing_address3"></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        Refund Receipt date<br>
                                        <input type="text" class="form-control" name="receipt_date"
                                            id="datepickerinv10">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        Tags <a href="#" style="float:right;color:blue;">Manage tags</a>
                                        <input type="text" class="form-control" name="tags">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Payment method
                                        <!-- <select class="form-control" name="payment_method"  id="rr_payment_method">
                                        <option></option>
                                        <option value="0">Add New</option>
                                        <?php foreach ($paymethods as $paymethod) { ?>
                                        <option
                                            value="<?php echo $paymethod->payment_method_id ; ?>">
                                            <?php echo $paymethod->quick_name; ?>
                                        </option>
                                        <?php } ?>
                                        </select> -->
                                        <select name="payment_method" id="payment_method_Receipt"
                                            class="form-control custom-select">
                                            <option value="">Choose method</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Check">Check</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Debit Card">Debit Card</option>
                                            <option value="ACH">ACH</option>
                                            <option value="Venmo">Venmo</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Square">Square</option>
                                            <option value="Invoicing">Invoicing</option>
                                            <option value="Warranty Work">Warranty Work</option>
                                            <option value="Home Owner Financing">Home Owner Financing</option>
                                            <option value="e-Transfer">e-Transfer</option>
                                            <option value="Other Credit Card Professor">Other Credit Card Professor
                                            </option>
                                            <option value="Other Payment Type">Other Payment Type</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        Refund From
                                        <select class="form-control" name="refund_form">
                                            <option></option>
                                            <option value="1">A</option>
                                            <option value="2">B</option>
                                            <option value="3">C</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6" align="right">
                                AMOUNT<h2><span id="grand_total_rr_total">0.00</span></h2><br>
                                Location of sale<br>
                                <input type="text" class="form-control" style="width:200px;" name="location_scale">
                            </div>
                        </div>

                        <hr>
                        <div class="col-md-6">
                            <div id="check_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Check Number</label>
                                        <input type="text" class="form-control" name="check_number" id="check_number" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="routing_number"
                                            id="routing_number" />
                                    </div>
                                    <!-- </div>
                                        <div class="row"> -->
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="account_number"
                                            id="account_number" />
                                    </div>
                                </div>
                            </div>
                            <div id="credit_card_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        Credit Card Type:<br>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Visa" <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Visa') ? 'checked' : '' ?>
                                            id="radio_credit_card">
                                            <label for="radio_credit_card"><span>Visa</span></label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Amex" <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Amex') ? 'checked' : '' ?>
                                            id="radio_credit_cardAmex">
                                            <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                                <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Mastercard') ? 'checked' : '' ?>
                                            id="radio_credit_cardMastercard">
                                            <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Discover" <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Discover') ? 'checked' : '' ?>
                                            id="radio_credit_cardMasterDiscover">
                                            <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="credit_number" id="credit_number"
                                            placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="credit_expiry" id="credit_expiry"
                                            placeholder="MM/YYYY" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="credit_cvc" id="credit_cvc"
                                            placeholder="CVC" />
                                    </div>
                                </div>
                            </div>
                            <div id="invoicing_Receipt" style="display:none;">

                                <!-- <input type="checkbox" id="same_as"> <b>Same as above in Monitoring Address</b> <br> -->
                                <br>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="monitored_location">Mail Address</label>
                                        <input type="text" class="form-control" name="mail-address" id="mail-address"
                                            placeholder="Monitored Location" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" name="mail_locality" id="mail_locality"
                                            placeholder="Enter Name" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="mail_state" id="mail_state"
                                            placeholder="Enter State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="zip">ZIP</label>
                                        <input type="text" id="mail_postcode" name="mail_postcode" class="form-control"
                                            placeholder="Enter Zip" />
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="cross_street">Cross Street</label>
                                        <input type="text" class="form-control" name="mail_cross_street"
                                            id="mail_cross_street" placeholder="Cross Street" />
                                    </div>
                                </div>
                            </div>
                            <div id="debit_card_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="debit_credit_number"
                                            id="credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="debit_credit_expiry"
                                            id="credit_expiry" placeholder="MM/YYYY" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="debit_credit_cvc" id="credit_cvc"
                                            placeholder="CVC" />
                                    </div>
                                </div>
                            </div>
                            <div id="ach_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="ach_routing_number"
                                            id="ach_routing_number" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="ach_account_number"
                                            id="ach_account_number" />
                                    </div>
                                </div>
                            </div>
                            <div id="venmo_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="account_credentials"
                                            id="account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="account_note" id="account_note" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="confirmation" id="confirmation" />
                                    </div>
                                </div>
                            </div>
                            <div id="paypal_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="paypal_account_credentials"
                                            id="paypal_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="paypal_account_note"
                                            id="paypal_account_note" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="paypal_confirmation"
                                            id="paypal_confirmation" />
                                    </div>
                                </div>
                            </div>
                            <div id="square_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="square_account_credentials"
                                            id="square_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="square_account_note"
                                            id="square_account_note" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="square_confirmation"
                                            id="square_confirmation" />
                                    </div>
                                </div>
                            </div>
                            <div id="warranty_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="warranty_account_credentials"
                                            id="warranty_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="warranty_account_note"
                                            id="warranty_account_note" />
                                    </div>
                                </div>
                            </div>
                            <div id="home_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="home_account_credentials"
                                            id="home_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="home_account_note"
                                            id="home_account_note" />
                                    </div>
                                </div>
                            </div>
                            <div id="e_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="e_account_credentials"
                                            id="e_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="e_account_note"
                                            id="e_account_note" />
                                    </div>
                                </div>
                            </div>
                            <div id="other_credit_card_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="other_credit_number"
                                            id="other_credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="other_credit_expiry"
                                            id="other_credit_expiry" placeholder="MM/YYYY" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="other_credit_cvc"
                                            id="other_credit_cvc" placeholder="CVC" />
                                    </div>
                                </div>
                            </div>
                            <div id="other_payment_area_Receipt" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="other_payment_account_credentials"
                                            id="other_payment_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="other_payment_account_note"
                                            id="other_payment_account_note" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <div class="row" style="margin:5px;">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="reportstable">
                                <thead>
                                    <!-- <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
                                    <th></th> -->
                                    <th>Name</th>
                                    <th>Type</th>
                                    <!-- <th>Description</th> -->
                                    <th width="150px">Quantity</th>
                                    <!-- <th>Location</th> -->
                                    <th width="150px">Price</th>
                                    <th width="150px">Discount</th>
                                    <th width="150px">Tax (Change in %)</th>
                                    <th>Total</th>
                                </thead>
                                <tbody id="items_table_body_refund_receipt">
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control getItemReceipt"
                                                onKeyup="getItemReceipt_k(this)" name="items[]">
                                            <ul class="suggestions"></ul>
                                        </td>
                                        <td><select name="item_type[]" class="form-control">
                                                <option value="product">Product</option>
                                                <option value="material">Material</option>
                                                <option value="service">Service</option>
                                                <option value="fee">Fee</option>
                                            </select></td>
                                        <td width="150px"><input type="number" class="form-control quantityrr"
                                                name="quantity[]" data-counter="0" id="quantity_0" value="1"></td>
                                        <td width="150px"><input type="number" class="form-control pricerr"
                                                name="price[]" data-counter="0" id="price_rr_0" min="0" value="0"></td>
                                        <td width="150px"><input type="number" class="form-control discountrr"
                                                name="discount[]" data-counter="0" id="discount_rr_0" min="0" value="0">
                                        </td>
                                        <td width="150px"><input type="text" class="form-control tax_change"
                                                name="tax[]" data-counter="0" id="tax1_rr_0" min="0" value="0">
                                            <!-- <span id="span_tax_0">0.0</span> -->
                                        </td>
                                        <td width="150px"><input type="hidden" class="form-control " name="total[]"
                                                data-counter="0" id="item_total_rr_0" min="0" value="0">
                                            $<span id="span_total_receipt_0">0.00</span></td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-1">
                                    <!-- <button class="btn1">Add lines</button> -->
                                    <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal"
                                        data-target="#item_list3"><span
                                            class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                </div>
                                <!-- <div class="col-md-1">
                           <button class="btn1">Clear all lines</button>
                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-1">
                            <b>Subtotal</b>
                        </div>
                        <div class="col-md-1">
                            <b>$0.00</b>
                        </div> -->
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-2">
                                    Message displayed on refund receipt<br>
                                    <textarea style="height:100px;width:100%;" name="message_refund"></textarea><br>
                                    Message displayed on statement<br>
                                    <textarea style="height:100px;width:100%;" name="mess_statement"></textarea>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-4">
                                    <!-- Taxable subtotal <b>$0.00</b><br>
                            <table class="table table-borderless" style="text-align:right;">
                                <tr>
                                    <td colspan="2">
                                        <select class="form-control" name="tax_rate">
                                            <option value="1">Based on location</option>
                                            <option readonly>CUSTOMER RATES</option>
                                            <option value="2">+ Add rate</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>$0.00</b><br><a href="">See the math</a></td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td align="right"><input type="text" name="shipping" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Tax on shipping</td>
                                    <td>0.00</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>$0.00</td>
                                </tr>
                                <tr>
                                    <td>Balance due</td>
                                    <td>$0.00</td>
                                </tr>
                            </table> -->
                                    <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td></td>
                                            <td>$ <span id="span_sub_total_rr">0.00</span>
                                                <input type="hidden" name="subtotal" id="item_total_rr">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td></td>
                                            <td>$ <span id="total_tax_rr_">0.00</span><input type="hidden" name="taxes"
                                                    id="total_tax_input_rr"></td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td></td>
                                            <td align="right">$</td>
                                            <td align="left" style="width:100px;"><input type="text" name="shipping"
                                                    id="shipping_value" class="form-control shipping_value" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:250px;"><input type="text" name="adjustment_name"
                                                    id="adjustment_name" placeholder="Adjustment Name"
                                                    class="form-control"
                                                    style="width:200px; display:inline; border: 1px dashed #d1d1d1">
                                            </td>
                                            <td style="width:150px;">
                                                <input type="number" name="adjustment_value" id="adjustment_input_rr"
                                                    value="0" class="form-control adjustment_input_rr"
                                                    style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover"
                                                    data-placement="top" data-trigger="hover"
                                                    data-content="Optional it allows you to adjust the total amount Eg. +10 or -10."
                                                    data-original-title="" title=""></span>
                                            </td>
                                            <td></td>
                                            <td>$<span id="adjustment_area_rr">0.00</span></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Markup $<span id="span_markup"></td> -->
                                        <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                        <input type="hidden" name="markup_input_form" id="markup_input_form"
                                            class="markup_input" value="0">
                                        <!-- </tr> -->
                                        <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                            <td>Amount Saved</td>
                                            <td></td>
                                            <td></td>
                                            <td><span id="offer_cost">0.00</span><input type="hidden"
                                                    name="voucher_value" id="offer_cost_input"></td>
                                        </tr>
                                        <tr style="color:blue;font-weight:bold;font-size:18px;">
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><span id="grand_total_rr">0.00</span>
                                                    <input type="hidden" name="grand_total" id="grand_total_rr_val"
                                                        value='0'></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="file-upload">
                                        <button class="file-upload-btn" type="button"
                                            onclick="$('.file-upload-input').trigger( 'click' )">Attachments</button>

                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" type='file' onchange="readURL(this);"
                                                accept="image/*" />
                                            <div class="drag-text">
                                                <i>Drag and drop files here or click the icon</i>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()"
                                                    class="remove-image">Remove <span class="image-title">Uploaded
                                                        File</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                </div>
                            </div>
                            <hr>


                        </div>


                        <div class="modal-footer-check">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                        type="button">Cancel</button>

                                </div>
                                <div class="col-md-5" align="center">
                                    <div class="middle-links">
                                        <a href="">Print or Preview</a>
                                    </div>
                                    <div class="middle-links end">
                                        <a href="">Make recurring</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dropdown" style="float: right">
                                        <button class="btn btn-dark cancel-button px-4" type="submit">Save</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                            id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                        <button class="btn btn-success" type="button" data-toggle="dropdown"
                                            style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="#" data-dismiss="modal" id="checkSaved">Save and close</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg"
                            style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and
                        security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>

<!-- Modal -->
<div class="modal fade" id="item_list3" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"
        style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
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
                        <table id="items_table_refund_receipt" class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td> Name</td>
                                    <td> Qty</td>
                                    <td> Price</td>
                                    <td> Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item) { // print_r($item);?>
                                <tr>
                                    <td><?php echo $item->title; ?>
                                    </td>
                                    <td></td>
                                    <td><?php echo $item->price; ?>
                                    </td>
                                    <td><button
                                            id="<?= $item->id; ?>"
                                            data-quantity="<?= $item->units; ?>"
                                            data-itemname="<?= $item->title; ?>"
                                            data-price="<?= $item->price; ?>"
                                            type="button" data-dismiss="modal"
                                            class="btn btn-sm btn-default select_item_rr">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                            class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('accounting/sidebar_new_modal/refund_receipt'); ?>
<script>
    function totalfunc() {
        var inputs = document.getElementsByName('amount[]');
        // alert(inputs);
        var sum = 0;
        for (var i = 0; i < inputs.length; i++) {
            sum += parseInt(inputs[i].value);
        }
        document.getElementById('total_amount').value = sum;

    }
</script>

<script>
    $(document).ready(function() {

        $('#sel-customer3').change(function() {
            var id = $(this).val();
            //  alert(id);

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>accounting/addLocationajax",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    //  alert('success');
                    console.log(response);
                    $("#email3").val(response['customer'].email);
                    $("#billing_address3").html(response['customer'].billing_address);

                },
                error: function(response) {
                    alert('Error' + response);

                }
            });
        });
    });
</script>

<script>
    $(document).on("focusout", ".adjustment_input_rr", function() {
        // var counter = $(this).data("counter");
        // alert('yeah');
        // calculationcm(counter);
        var grand_total = $("#grand_total_input").val();
        var adjustment = $("#adjustment_input_rr").val();
        var shipping = $("#shipping_value").val();

        grand_total = parseFloat(grand_total) + parseFloat(adjustment);

        var subtotal = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="span_total_receipt_"]').each(function() {
            subtotal += parseFloat($(this).text());
        });

        // alert(subtotaltax);

        var s_total = subtotal.toFixed(2);
        var grand_total_w = (s_total - parseFloat(adjustment)) + parseFloat(shipping);
        // var markup = $("#markup_input_form").val();
        // var grand_total_w = s_total + parseFloat(adjustment);

        // $("#total_tax_").text(subtotaltax.toFixed(2));
        // $("#total_tax_").val(subtotaltax.toFixed(2));

        $("#grand_total_input").val(grand_total_w.toFixed(2));
        $("#grand_total_rr").text(grand_total_w.toFixed(2));
        $("#grand_total_rr_val").val(grand_total_w.toFixed(2));
        $("#adjustment_area_rr").text(adjustment);
        $("#grand_total_rr_total").text(grand_total_w.toFixed(2));
        // alert(grand_total_w); _val
    });
</script>

<script>
    $(document).on("focusout", ".shipping_value", function() {
        // var counter = $(this).data("counter");
        // alert('yeah');
        // calculationcm(counter);
        var grand_total = $("#grand_total_input").val();
        var adjustment = $("#adjustment_input_rr").val();
        var shipping = $("#shipping_value").val();

        grand_total = (parseFloat(grand_total) + parseFloat(adjustment)) + parseFloat(shipping);

        var subtotal = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="span_total_receipt_"]').each(function() {
            subtotal += parseFloat($(this).text());
        });

        // alert(subtotaltax);

        var s_total = subtotal.toFixed(2);
        var grand_total_w = (s_total - parseFloat(adjustment)) + parseFloat(shipping);
        // var markup = $("#markup_input_form").val();
        // var grand_total_w = s_total + parseFloat(adjustment);

        // $("#total_tax_").text(subtotaltax.toFixed(2));
        // $("#total_tax_").val(subtotaltax.toFixed(2));

        $("#grand_total_input").val(grand_total_w.toFixed(2));
        $("#grand_total_rr").text(grand_total_w.toFixed(2));
        $("#grand_total_rr_val").val(grand_total_w.toFixed(2));
        $("#adjustment_area_rr").text(adjustment);
        $("#grand_total_rr_total").text(grand_total_w.toFixed(2));
        // alert(grand_total_w);
    });
</script>

<script>
    $(document).ready(function() {

        $('#sel-customer').change(function() {
            var id = $(this).val();
            //  alert(id);

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>accounting/addLocationajax",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    //  alert('success');
                    console.log(response);
                    $("#email").val(response['customer'].email);
                    $("#billing_address").html(response['customer'].billing_address);

                },
                error: function(response) {
                    alert('Error' + response);

                }
            });
        });
    });
</script>

<script>
    function getItemReceipt_k(obj) {
        var sk = jQuery(obj).val();
        var site_url = jQuery("#siteurl").val();
        jQuery.ajax({
            url: site_url + "items/getitem_Receipt",
            data: {
                sk: sk
            },
            type: "GET",
            success: function(data) {
                /* alert(data); */
                jQuery(obj).parent().find(".suggestions").empty().html(data);
            },
            error: function() {
                alert("An error has occurred");
            },
        });
    }
    // over_tax = parseFloat(tax_tot).toFixed(2);
    // alert(over_tax);

    function setitemReceipt(obj, title, price, discount, itemid) {
        // alert( 'yeah');
        // alert('setitemCM');
        jQuery(obj).parent().parent().find(".getItemReceipt").val(title);
        jQuery(obj).parent().parent().parent().find(".pricerr").val(price);
        jQuery(obj).parent().parent().parent().find(".discountrr").val(discount);
        jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
        var counter = jQuery(obj)
            .parent()
            .parent()
            .parent()
            .find(".pricerr")
            .data("counter");
        jQuery(obj).parent().empty();
        calculationReceipt(counter);
    }

    $(document).on("focusout", ".pricerr", function() {
        var counter = $(this).data("counter");
        calculationReceipt(counter);
    });

    // $(document).on("focusout", ".quantitycm", function () {
    //   var counter = $(this).data("counter");
    //   calculationcm(counter);
    // });
    $(document).on("focusout", ".discountrr", function() {
        var counter = $(this).data("counter");
        calculationReceipt(counter);
    });


    $(document).on("focusout", ".quantityrr2", function() {
        // var counter = $(this).data("counter");
        //   calculationcm(counter);
        // var idd = this.id;
        var idd = $(this).attr('data-itemid');
        var in_id = idd;
        var price = $("#price_rr_" + in_id).val();
        var quantity = $("#quantity_" + in_id).val();
        var discount = $("#discount_rr_" + in_id).val();
        var tax = (parseFloat(price) * 7.5) / 100;
        var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
            2
        );
        if (discount == '') {
            discount = 0;
        }

        var total = (
            (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
            parseFloat(discount)
        ).toFixed(2);

        //   alert( 'yeah' + total);

        $("#span_total_receipt_" + in_id).text(total);
        $("#tax_1_" + in_id).text(tax1);
        $("#tax1_rr_" + in_id).val(tax1);
        $("#discount_rr_" + in_id).val(discount);

        if ($('#tax_1_' + in_id).length) {
            $('#tax_1_' + in_id).val(tax1);
        }

        if ($('#item_total_rr_' + in_id).length) {
            $('#item_total_rr_' + in_id).val(total);
        }

        var eqpt_cost = 0;
        var cnt = $("#count").val();
        var total_discount = 0;
        for (var p = 0; p <= cnt; p++) {
            var prc = $("#price_rr_" + p).val();
            var quantity = $("#quantity_" + p).val();
            var discount = $("#discount_rr_" + p).val();
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

        var subtotalrr = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="span_total_receipt_"]').each(function() {
            subtotalrr += parseFloat($(this).text());
        });
        // $('#sum').text(subtotal);

        var subtotaltax = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="tax_1_"]').each(function() {
            subtotaltax += parseFloat($(this).text());
        });

        // alert(subtotalcm);

        $("#eqpt_cost").val(eqpt_cost);
        $("#total_discount").val(total_discount);
        $("#span_sub_total_0").text(total_discount);
        $("#span_sub_total_rr").text(subtotal.toFixed(2));
        $("#item_total_rr").val(subtotal.toFixed(2));

        var s_total = subtotal.toFixed(2);
        var adjustment = $("#adjustment_input_rr").val();
        var grand_total = s_total - parseFloat(adjustment);
        var markup = $("#markup_input_form").val();
        var grand_total_w = grand_total + parseFloat(markup);

        $("#total_tax_rr_").text(subtotaltax.toFixed(2));
        $("#total_tax_rr_").val(subtotaltax.toFixed(2));


        $("#grand_total_rr").text(grand_total_w.toFixed(2));
        $("#grand_total_rr_val").val(grand_total_w.toFixed(2));
        $("#grand_total_rr_total").text(grand_total_w.toFixed(2));
        $("#grand_total_input").val(grand_total_w.toFixed(2));

        var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
        sls = parseFloat(sls).toFixed(2);
        $("#sales_tax").val(sls);
        cal_total_due();
    });

    function calculationReceipt(counter) {
        // alert( 'yeah');
        var price = $("#price_rr_" + counter).val();
        var quantity = $("#quantity_" + counter).val();
        var discount = $("#discount_rr_" + counter).val();
        var tax = (parseFloat(price) * 7.5) / 100;
        var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
            2
        );
        if (discount == '') {
            discount = 0;
        }

        var total = (
            (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
            parseFloat(discount)
        ).toFixed(2);

        // console.log( 'yeah' + total);

        $("#span_total_receipt_" + counter).text(total);
        $("#tax_1_" + counter).text(tax1);
        $("#tax_111_" + counter).text(tax1);
        $("#tax_1_" + counter).val(tax1);
        $("#discount_rr_" + counter).val(discount);
        $("#tax1_rr_" + counter).val(tax1);
        // $("#tax1_" + counter).val(tax1);
        // $("#tax_" + counter).val(tax1);
        // alert(tax1);

        if ($('#tax_1_' + counter).length) {
            $('#tax_1_' + counter).val(tax1);
        }

        if ($('#item_total_rr_' + counter).length) {
            $('#item_total_rr_' + counter).val(total);
        }

        // alert('dri');

        var eqpt_cost = 0;
        var cnt = $("#count").val();
        var total_discount = 0;
        for (var p = 0; p <= cnt; p++) {
            var prc = $("#price_rr_" + p).val();
            var quantity = $("#quantity_" + p).val();
            var discount = $("#discount_rr_" + p).val();
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
        $('*[id^="span_total_receipt_"]').each(function() {
            subtotal += parseFloat($(this).text());
        });
        // $('#sum').text(subtotal);
        var subtotaltax = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="tax_1_"]').each(function() {
            subtotaltax += parseFloat($(this).text());
        });

        //   alert(subtotal);

        $("#eqpt_cost").val(eqpt_cost);
        $("#total_discount").val(total_discount);
        $("#span_sub_total_0").text(total_discount);
        $("#span_sub_total_rr").text(subtotal.toFixed(2));
        $("#item_total_rr").val(subtotal.toFixed(2));

        var s_total = subtotal.toFixed(2);
        var adjustment = $("#adjustment_input_rr").val();
        var grand_total = s_total - parseFloat(adjustment);
        var markup = $("#markup_input_form").val();
        var grand_total_w = grand_total + parseFloat(markup);

        $("#total_tax_rr_").text(subtotaltax.toFixed(2));
        $("#total_tax_input_rr").val(subtotaltax.toFixed(2));


        $("#grand_total_rr").text(grand_total_w.toFixed(2));
        $("#grand_total_rr_val").val(grand_total_w.toFixed(2));
        $("#grand_total_rr_total").text(grand_total_w.toFixed(2));
        $("#grand_total_input").val(grand_total_w.toFixed(2));
        $("#grandtotal_input").val(grand_total_w.toFixed(2));
        // alert(grand_total_w);

        if ($("#grand_total").length && $("#grand_total").val().length) {
            // console.log('none');
            // alert('none');
        } else {
            $("#grand_total_rr").text(grand_total_w.toFixed(2));
            $("#grand_total_rr_val").val(grand_total_w.toFixed(2));
            $("#grand_total_input").val(grand_total_w.toFixed(2));

            var bundle1_total = $("#grand_total").text();
            var bundle2_total = $("#grand_total2").text();
            var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

            $("#supergrandtotal").text(super_grand.toFixed(2));
            $("#supergrandtotal_input").val(super_grand.toFixed(2));
        }

        var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
        sls = parseFloat(sls).toFixed(2);
        $("#sales_tax").val(sls);
        cal_total_due();
    }
</script>
<script>
    $(".select_item_rr").click(function() {
        var idd = this.id;
        console.log(idd);
        console.log($(this).data('itemname'));
        var title = $(this).data('itemname');
        var price = $(this).data('price');

        if (!$(this).data('quantity')) {
            // alert($(this).data('quantity'));
            var qty = 0;
        } else {
            // alert('0');
            var qty = $(this).data('quantity');
        }

        var count = parseInt($("#count").val()) + 1;
        $("#count").val(count);
        var total_ = price * qty;
        var tax_ = (parseFloat(total_).toFixed(2) * 7.5) / 100;
        var taxes_t = parseFloat(tax_).toFixed(2);
        var total = parseFloat(total_).toFixed(2);
        var withCommas = Number(total).toLocaleString('en');
        total = '$' + withCommas + '.00';
        // console.log(total);
        // alert(total);
        markup = "<tr id=\"ss\">" +
            "<td width=\"35%\"><input value='" + title +
            "' type=\"text\" name=\"items[]\" class=\"form-control\" ><input type=\"hidden\" value='" + idd +
            "' name=\"item_id[]\"></td>\n" +
            "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
            "<td width=\"10%\"><input data-itemid='" + idd + "' id='quantity_" + idd + "' value='" + qty +
            "' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest\"></td>\n" +
            // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
            "<td width=\"10%\"><input id='price_rr_" + idd + "' value='" + price +
            "'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
            // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
            // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
            "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_rr_" +
            idd + "'></td>\n" +
            // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
            "<td width=\"20%\"><input type=\"text\" data-itemid='" + idd +
            "' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_rr_" + idd +
            "' min=\"0\" value='" + taxes_t + "'></td>\n" +
            "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='" + total_ +
            "' id='span_total_receipt_" + idd + "' class=\"total_per_item\">" + total +
            // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
            "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text" + idd + "' value='" + total +
            "'></td>" +
            "</tr>";
        tableBody = $("#items_table_body_refund_receipt");
        tableBody.append(markup);
        markup2 = "<tr id=\"sss\">" +
            "<td >" + title + "</td>\n" +
            "<td ></td>\n" +
            "<td ></td>\n" +
            "<td >" + price + "</td>\n" +
            "<td ></td>\n" +
            "<td >" + qty + "</td>\n" +
            "<td ></td>\n" +
            "<td ></td>\n" +
            "<td >0</td>\n" +
            "<td ></td>\n" +
            "<td ><a href=\"#\" data-name='" + title + "' data-price='" + price + "' data-quantity='" + qty +
            "' id='" + idd +
            "' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
            "</tr>";
        tableBody2 = $("#device_audit_datas");
        tableBody2.append(markup2);
        // calculate_subtotal();
        // var counter = $(this).data("counter");
        // calculation(idd);

        var in_id = idd;
        var price = $("#price_rr_" + in_id).val();
        var quantity = $("#quantity_" + in_id).val();
        var discount = $("#discount_rr_" + in_id).val();
        var tax = (parseFloat(price) * 7.5) / 100;
        var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
            2
        );
        if (discount == '') {
            discount = 0;
        }

        var total = (
            (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
            parseFloat(discount)
        ).toFixed(2);

        // alert( 'yeah' + total);

        $("#span_total_receipt_" + in_id).text(total);
        $("#sub_total_text" + in_id).val(total);
        $("#tax_1_" + in_id).text(tax1);
        $("#tax1_rr_" + in_id).val(tax1);
        $("#discount_rr_" + in_id).val(discount);

        if ($('#tax_1_' + in_id).length) {
            $('#tax_1_' + in_id).val(tax1);
        }

        if ($('#item_total_rr_' + in_id).length) {
            $('#item_total_rr_' + in_id).val(total);
        }

        var eqpt_cost = 0;
        // var total_cost = 0;
        var cnt = $("#count").val();
        var total_discount = 0;
        for (var p = 0; p <= cnt; p++) {
            var prc = $("#price_rr_" + p).val();
            var quantity = $("#quantity_" + p).val();
            var discount = $("#discount_rr_" + p).val();
            // var discount= $('#discount_' + p).val();
            // eqpt_cost += parseFloat(prc) - parseFloat(discount);
            // total_cost += parseFloat(prc);
            eqpt_cost += parseFloat(prc) * parseFloat(quantity);
            total_discount += parseFloat(discount);
        }
        //   var subtotal = 0;
        // $( total ).each( function(){
        //   subtotal += parseFloat( $( this ).val() ) || 0;
        // });

        var total_cost = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="price_rr_"]').each(function() {
            total_cost += parseFloat($(this).val());
        });

        var tax_tot = 0;
        $('*[id^="tax1_rr_"]').each(function() {
            tax_tot += parseFloat($(this).val());
        });

        over_tax = parseFloat(tax_tot).toFixed(2);
        // alert(over_tax);

        $("#sales_taxs").val(over_tax);
        $("#total_tax_input_rr").val(over_tax);
        $("#total_tax_rr_").text(over_tax);


        eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
        total_discount = parseFloat(total_discount).toFixed(2);
        stotal_cost = parseFloat(total_cost).toFixed(2);
        // var test = 5;

        var subtotal = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="span_total_receipt_"]').each(function() {
            subtotal += parseFloat($(this).text());
        });
        // $('#sum').text(subtotal);

        var subtotaltax = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="tax_1_"]').each(function() {
            subtotaltax += parseFloat($(this).text());
        });

        // alert(subtotaltax);

        $("#eqpt_cost").val(eqpt_cost);
        $("#total_discount").val(total_discount);
        $("#span_sub_total_0").text(total_discount);
        $("#span_sub_total_invoice_rr").text(subtotal.toFixed(2));
        // $("#item_total").val(subtotal.toFixed(2));
        $("#item_total_rr").val(stotal_cost);

        var s_total = subtotal.toFixed(2);
        var adjustment = $("#adjustment_input_rr").val();
        var grand_total = s_total - parseFloat(adjustment);
        var markup = $("#markup_input_form").val();
        var grand_total_w = grand_total + parseFloat(markup);

        // $("#total_tax_").text(subtotaltax.toFixed(2));
        // $("#total_tax_").val(subtotaltax.toFixed(2));




        $("#grand_total_rr").text(grand_total_w.toFixed(2));
        $("#grand_total_input").val(grand_total_w.toFixed(2));
        $("#grand_total_rr_total").text(grand_total_w.toFixed(2));
        $("#grand_total_rr_val").val(grand_total_w.toFixed(2));
        $("#span_sub_total_rr").text(grand_total_w.toFixed(2));

        var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
        sls = parseFloat(sls).toFixed(2);
        $("#sales_tax").val(sls);
        cal_total_due();
    });
</script>


<script>
    $('#addcreditmemoModal').modal({
        backdrop: 'static',
        keyboard: false
    })
</script>

<script>
    document.getElementById("payment_method_Receipt").onchange = function() {
        if (this.value == 'Cash') {
            // alert('cash');
            // $('#exampleModal').modal('toggle');
            $('#cash_area_Receipt').show();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Invoicing') {

            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#invoicing_Receipt').show();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Check') {
            // alert('Check');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').show();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Credit Card') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').show();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Debit Card') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').show();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'ACH') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').show();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Venmo') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#venmo_area_Receipt').show();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Paypal') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').show();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Square') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').show();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Warranty Work') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').show();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Home Owner Financing') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').show();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'e-Transfer') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').show();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Other Credit Card Professor') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').show();
            $('#other_payment_area_Receipt').hide();
        } else if (this.value == 'Other Payment Type') {
            // alert('Credit card');
            $('#cash_area_Receipt').hide();
            $('#check_area_Receipt').hide();
            $('#credit_card_Receipt').hide();
            $('#debit_card_Receipt').hide();
            $('#invoicing_Receipt').hide();
            $('#ach_area_Receipt').hide();
            $('#venmo_area_Receipt').hide();
            $('#paypal_area_Receipt').hide();
            $('#square_area_Receipt').hide();
            $('#warranty_area_Receipt').hide();
            $('#home_area_Receipt').hide();
            $('#e_area_Receipt').hide();
            $('#other_credit_card_Receipt').hide();
            $('#other_payment_area_Receipt').show();
        }
    }
</script>