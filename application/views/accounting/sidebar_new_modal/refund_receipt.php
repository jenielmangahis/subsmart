<div class="full-screen-modal">
    <div id="addrefundreceiptModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Refund Receipt <span class="invoice_number"></span>
                    </div>
                    <button type="button" class="close" id="closeModalExpense" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form
                    action="<?php echo site_url() ?>accounting/addSalesReceipt"
                    method="post">
                    <input type="text" style="display: none;" value="" name="recurring_selected">
                    <input type="text" style="display: none;" value="" name="current_sales_recept_number">
                    <input type="text" style="display: none;" value="" name="submit_type">
                    <input type="text" style="display: none;" value="0" name="grand_total">
                    <input type="text" style="display: none;" value="0" name="subtotal">
                    <input type="text" style="display: none;" value="0" name="taxes">
                    <input type="text" style="display: none;" value="" name="submit-type">
                    <input type="text" style="display: none;" value="" name="invoice_id">
                    <div class="modal-body">
                        <div class="customer-info">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4 divided">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="label">Email
                                                    <a href="#" class="cc-bcc-btn float-right">cc/bcc</a>
                                                </div>
                                                <input type="email" class="form-control required" required=""
                                                    name="customer_email">
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
                                        <div class="form-group" style="margin-bottom: 5px!important;">
                                            <div class="label">Billing address</div>
                                            <textarea style="height: 100px;width: 100%;resize: auto;"
                                                name="billing_address" class="required" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="label">Refund Receipt date</div>
                                                    <input type="date" class="form-control required" required
                                                        name="shipping_date">
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3">

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="label">P.O Number</span> </div>
                                                    <input type="text" class="form-control " name="po_number">
                                                    <div class="label"><span class="faded-info">Not printed on
                                                            form</span></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="label">Sales Rep</span> </div>
                                                    <input type="text" class="form-control " name="po_number">
                                                    <div class="label"><span class="faded-info">Not printed on
                                                            form</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="job_type">Tags</label>
                                            <a href="#" class="manage-tags float-right">Manage Tags</a>
                                            <input type="text" class="form-control" name="tags">
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Payment method</div>
                                            <select name="payment_method" id="payment_method"
                                                class="form-control custom-select required" required>
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
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="label">Refund form</div>
                                            <select name="payment_method" id="payment_method"
                                                class="form-control custom-select required" required>
                                                <option value="">A</option>
                                                <option value="">B</option>
                                                <option value="">C</option>
                                                <option value="">D</option>
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
                                                    <input type="text" style="display: none;" name="itemid[]">
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
                                                    $<span class="total_per_item">0.00</span>
                                                    <input type="text" value="0" name="total[]" style="display: none;">
                                                </td>
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
                                <div class="form-group">
                                    <div class="label">Message displayed on refund receipt</div>
                                    <textarea name="message_to_customer" cols="40" rows="2" class="form-control"
                                        spellcheck="false"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="label">Message displayed on statement</div>
                                    <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control"
                                        spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="item-totals">
                                    <div class="label">
                                        <div for="">Subtotal</div>
                                        <div for="">Taxes</div>
                                        <div for="">Shipping</div>
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
                                        <div class="shipping">
                                            <input type="text" name="shipping" placeholder="0.00" value="0.00">
                                        </div>
                                        <div class="adjustment">
                                            <input type="text" name="adjustment_value" placeholder="0.00" value="0.00">
                                        </div>
                                        <div class="grand-total">$0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- <div class="file-upload">
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
                                </div> -->
                                <div class="attachement-file-section">
                                    <div class="label">
                                        <i class="fa fa-paperclip" aria-hidden="true"></i> Attachement
                                    </div>
                                    <button type="button" class="attachment-btn">
                                        <i class="fa fa-upload" aria-hidden="true"></i> Upload
                                    </button>
                                    <input type="file" class="form-control" name="attachment-file" multiple>
                                    <div class="attachement-viewer">
                                    </div>
                                    <input type="text" name="attachement-filenames" style="display: none;">
                                </div>
                            </div>
                            <div class="col-md-8">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-3" style="padding-left: 30px;">
                                <button class="btn btn-dark cancel-button" data-action="close-modal"
                                    type="button">Cancel</button>
                                <button class="btn btn-dark cancel-button" data-action="clear-modal-form"
                                    type="button">Clear</button>

                            </div>
                            <div class="col-md-6" align="center">
                                <div class="middle-links">
                                    <div class="pint-pries-option-section">
                                        <ul>
                                            <li>
                                                <a href="#" class="print-preview">Print or Preview </a>
                                            </li>
                                            <li>
                                                <a href="#" class="print-slip">Print packing slip</a>
                                            </li>
                                        </ul>
                                        <div class="anchor-holder">
                                            <img src="<?= base_url('assets/img/accounting/customers/anchor_down.png') ?>"
                                                alt="">
                                        </div>
                                    </div>
                                    <a href="" class="print-preview-option">Print or Preview</a>
                                </div>
                                <div class="middle-links end">
                                    <a href="">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-3 text-right" style="padding-right: 30px;">
                                <div class="right-option">
                                    <div class="sub-option">
                                        <ul>
                                            <li><button type="submit" data-action="save"
                                                    data-submit-type="save-close">Save and
                                                    close</button></li>
                                            <li><button type="submit" data-action="save"
                                                    data-submit-type="save-send">Save and
                                                    send</button></li>
                                        </ul>
                                    </div>
                                    <button type="submit" class="btn-save-new" data-action="save"
                                        data-submit-type="save-new">Save and new</button>
                                    <button href="#" class="btn-save-dropdown">
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp;
                                    </button>

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
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script>
<script>
    function initialize() {
        var input = document.getElementById('create_invoice_modal_job_location');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            document.getElementById('city2').value = place.name;
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>