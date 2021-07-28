<div class="full-screen-modal">
    <div id="create_invoice_modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Invoice <span class="invoice_number"></span>
                    </div>
                    <button type="button" class="close" id="closeModalExpense" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form
                    action="<?php echo site_url()?>accounting/addSalesReceipt"
                    method="post">
                    <input type="text" style="display: none;" value="" name="recurring_selected">
                    <input type="text" style="display: none;" value="" name="current_sales_recept_number">
                    <input type="text" style="display: none;" value="" name="submit_type">
                    <input type="text" style="display: none;" value="0" name="grand_total_amount">
                    <div class="modal-body">
                        <div class="customer-info">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3 divided">
                                            <div class="form-group">
                                                <div class="label">
                                                    Customer
                                                </div>
                                                <select class="form-control required" required name="customer_id"
                                                    id="sel-customer2">
                                                    <option></option>
                                                    <?php foreach ($customers as $customer) : ?>
                                                    <option
                                                        value="<?php echo $customer->prof_id; ?>"
                                                        data-text="<?php echo $customer->first_name . ' ' . $customer->last_name; ?>">
                                                        <?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="label">
                                                    Job Location <span class="faded-info">(optional, select or add new
                                                        one)</span>
                                                </div>
                                                <input type="text" class="form-control " name="invoice_job_location">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="label">
                                                    Job Name <span class="faded-info">(optional)</span>
                                                </div>
                                                <input type="text" class="form-control " name="job_name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row error-message-section" style="display: none;">
                            <div class="col-md-12">
                                <div class="error-message">
                                    <h3 class="title"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        Something's not quite right</h3>
                                    <label for="title">Please double check your data.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Terms</div>
                                            <select class="form-control required" required name="terms">
                                                <option></option>
                                                <option value="1">Add new</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="margin-bottom: 0!important;">
                                            <div class="label">Email</div>
                                            <input type="email" class="form-control required" required=""
                                                name="customer_email">
                                            <div style="margin-top:5px;"><input type="checkbox"> Send later</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Location of sale</div>
                                            <input type="text" class="form-control required" required
                                                name="location_scale">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Tracking no.</div>
                                            <input type="text" class="form-control required" required
                                                name="tracking_number">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Ship via</div>
                                            <input type="text" class="form-control required" required name="ship_via">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Shipping date</div>
                                            <input type="date" class="form-control required" required
                                                name="shipping_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="job_type">Tags</label>
                                            <a href="#" class="manage-tags float-right">Manage Tags</a>
                                            <input type="text" class="form-control" name="tags">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="margin-bottom: 5px!important;">
                                            <div class="label">Billing address</div>
                                            <textarea style="height: 50px;width: 100%;resize: auto;"
                                                name="billing_address" class="required" required=""></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Invoice Type</div>
                                            <select name="invoice_type" class="form-control">
                                                <option value="Deposit">Deposit</option>
                                                <option value="Partial Payment">Partial Payment</option>
                                                <option value="Final Payment">Final Payment</option>
                                                <option value="Total Due" selected="selected">Total Due</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Job# <span class="faded-info">(optional)</span> </div>
                                            <input type="text" class="form-control " name="work_order_number">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Purchase Order# <span
                                                    class="faded-info">(optional)</span> </div>
                                            <input type="text" class="form-control " name="purchase_order">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="margin-bottom: 5px!important;">
                                            <div class="label">Shipping to</div>
                                            <textarea style="height: 50px;width: 100%;resize: auto;"
                                                name="shipping_to_address" class="required" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Invoice# </div>
                                            <input type="text" class="form-control required" equired=""
                                                name="invoice_number">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Date Issued </div>
                                            <input type="date" class="form-control required" equired=""
                                                name="date_issued">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Due Date </div>
                                            <input type="date" class="form-control required" equired="" name="due_date">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Status</div>
                                            <select name="status" class="form-control">
                                                <option value="Draft" selected="">Draft</option>
                                                <option value="Submitted">Submitted</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Declined">Declined</option>
                                                <option value="Schedule">Schedule</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="items-section">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>PRODUCT/SERVICE</th>
                                                <th>TYPE</th>
                                                <th width="150px" class="text-right">Quantity</th>
                                                <th width="150px" class="text-right">Price</th>
                                                <th width="150px" class="text-right">Discount</th>
                                                <th width="150px" class="text-right">Tax (Change in %)</th>
                                                <th style="text-align: right;">Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="item">
                                                <td>
                                                    <input type="text" style="display: none;" name="item_ids[]">
                                                    <input type="text" class="form-control required" required=""
                                                        name="items[]" autocomplete="off">
                                                    <ul class="suggestions"></ul>
                                                </td>
                                                <td><select name="item_type[]" class="form-control">
                                                        <option value="product">Product</option>
                                                        <option value="material">Material</option>
                                                        <option value="service">Service</option>
                                                        <option value="fee">Fee</option>
                                                    </select></td>
                                                <td width="150px"><input type="number"
                                                        class="form-control required item-field-monitary" required=""
                                                        name="quantity[]" data-counter="0" value="">
                                                </td>
                                                <td width="150px"><input type="number"
                                                        class="form-control required item-field-monitary" required=""
                                                        name="price[]" data-counter="0" min="0" value="">
                                                </td>
                                                <td width="150px"><input type="number"
                                                        class="form-control required item-field-monitary" required=""
                                                        name="discount[]" data-counter="0" min="0" value="">
                                                </td>
                                                <td width="150px"><input type="text" class="form-control"
                                                        data-itemfieldtype="tax" required="" name="tax[]"
                                                        data-type="tax" data-counter="0" min="0" value="">
                                                    <input type="text" class="tax-hide" name="tax_percent[]"
                                                        value="7.5">
                                                </td>
                                                <td width="150px" style="text-align: right;"><input type="hidden"
                                                        class="form-control total_per_input" name="total[]"
                                                        data-counter="0" min="0" value="0">
                                                    $<span class="total_per_item">0.00</span></td>
                                                <td class="item-action">
                                                    <a href="#" class="delete-item">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="item-buttons">
                                    <button type="button" class="default-button add-lines">
                                        Add lines
                                    </button>
                                    <button type="button" class="default-button clear-all-lines">
                                        Clear all lines
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="item-totals">
                                    <div class="label">
                                        <div for="">Subtotal</div>
                                        <div for="">Taxes</div>
                                        <div style="position:relative;">
                                            <input type="text" name="adjustment_name" placeholder="Adjustment name">
                                            <span class="fa fa-question-circle clarification" data-toggle="popover"
                                                data-placement="top" data-trigger="hover"
                                                data-content="Optional it allows you to adjust the total amount Eg. +10 or -10."
                                                data-original-title="" title=""></span>
                                        </div>
                                        <div style="padding-top:20px;">Grand total</div>
                                    </div>
                                    <div class="amount">
                                        <div class="subtotal">$0</div>
                                        <div class="taxes">$0</div>
                                        <div class="adjustment">
                                            <input type="text" name="adjustment_value" placeholder="0.00" value="0.00">
                                        </div>
                                        <div class="grand-total">$0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5 class="label">
                                        Request a Deposit
                                        <label class="faded-info">You can request an upfront payment on accept
                                            estimate.</label>
                                    </h5>
                                    <select name="deposit_request_type" class="form-control">
                                        <option value="$" selected="selected">Deposit amount $</option>
                                        <option value="%">Percentage %</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5 class="label">
                                        &nbsp;
                                        <label class="faded-info" style="color:transparent;">You can request an upfront
                                            payment on accept
                                            estimate.</label>
                                    </h5>
                                    <input type="text" name="deposit_amount" value="0" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5 class="label">
                                        Payment Schedule
                                        <label class="faded-info">Split the balance into multiple payment
                                            milestones.</label>
                                    </h5>
                                    <div><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus-square"
                                                aria-hidden="true"></i> Manage payment schedule </a></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="label">
                                        Accepted payment methods
                                    </h5>
                                    <label class="faded-info">Select the payment methods that will appear on this
                                        invoice.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="credit_card_payments" id="credit_card_payments"
                                            checked>
                                        <label for="credit_card_payments"><span>Credit Card Payments ()</span></label>
                                    </div>
                                    <div class="faded-info">Your client can pay your invoice using credit card or bank
                                        account online. You will be notified when your client makes a payment and the
                                        money will be transferred to your bank account automatically.
                                    </div>
                                    <div class="payment-methods-img">
                                        <img src="<?=base_url("/assets/frontend/images/credit_cards.png")?>"
                                            alt="">
                                    </div>
                                    <div class="faded-info">Your payment processor is not set up <a href="#">setup
                                            payment</a>
                                    </div>
                                </div>

                                <div class="form-check">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="bank_transfer" id="bank_transfer" checked>
                                        <label for="bank_transfer"><span>Bank Transfer</span></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="instapay" id="instapay" checked>
                                        <label for="instapay"><span>Instapay</span></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="check" id="check" checked>
                                        <label for="check"><span>Check</span></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="cash" id="cash" checked>
                                        <label for="cash"><span>Cash</span></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="deposit" id="deposit" checked>
                                        <label for="deposit"><span>Deposit</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:30px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Message to Customer</h5>
                                    <div class="faded-info">Add a message that will be displayed on the invoice.</div>
                                    <textarea name="message_to_customer" cols="40" rows="2" class="form-control"
                                        spellcheck="false">Thank you for your business.</textarea>
                                </div>
                                <div class="form-group">
                                    <h5>Terms & Conditions</h5>
                                    <div class="faded-info">
                                        Mention your company's T&C that will appear on the invoice.
                                    </div>
                                    <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control"
                                        spellcheck="false"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

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
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                <span class="image-title">Uploaded
                                                    File</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                    type="button">Cancel</button>
                                <button class="btn btn-dark cancel-button" id="cancel_recurring" type="button"
                                    style="display: none;">Cancel</button>
                                <button class="btn btn-dark cancel-button" id="clearsalereceipt"
                                    type="button">Clear</button>

                            </div>
                            <div class="col-md-5" align="center">
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button class="btn btn-dark cancel-button px-4" data-submit-type="save"
                                        type="submit">Save</button>
                                    <button type="submit" data-submit-type="save-send" class="btn btn-success"
                                        id="checkSaved" style="border-radius: 20px 0 0 20px">Save and send</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown"
                                        style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span>&nbsp;</button>
                                    <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                        <li>
                                            <button type="submit" data-submit-type="save-close" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and close</button>
                                        </li>
                                        <li>
                                            <button type="submit" data-submit-type="save-new" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and new</button>
                                        </li>
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