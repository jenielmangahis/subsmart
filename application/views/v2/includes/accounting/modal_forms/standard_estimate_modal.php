<div class="full-screen-modal">
    <form onsubmit="submitModalForm(event, this)" id="modal-form">
        <div id="standard-estimate-modal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Standard Estimate</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="min-height: 100%">
                            <div class="col">
                                <div class="row customer-details">
                                    <div class="col-12 col-md-8 grid-mb">
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <label for="customer">Customer</label>
                                                <select name="customer" id="customer" class="form-control nsm-field" required>
                                                    <?php if(isset($estimate)) : ?>
                                                        <option value="<?=$estimate->customer_id?>">
                                                        <?php
                                                            $customer = $this->accounting_customers_model->get_by_id($estimate->customer_id);
                                                            echo $customer->first_name . ' ' . $customer->last_name;
                                                        ?>
                                                        </option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 text-end grid-mb">
                                        <h6>AMOUNT</h6>
                                        <h2>
                                            <span class="transaction-grand-total">
                                                $0.00
                                            </span>
                                        </h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="customer-email">Customer Email</label>
                                        <input type="text" name="customer_email" id="customer-email" class="form-control nsm-field mb-2" value="" disabled>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="customer-mobile">Customer Mobile</label>
                                        <input type="text" name="customer_mobile" id="customer-mobile" class="form-control nsm-field mb-2" value="" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label for="job-location">Job Location</label>
                                        <input type="text" name="job_location" id="job-location" class="form-control nsm-field mb-2" value="">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="job-name">Job Name</label>
                                        <input type="text" name="job_name" id="job-name" class="form-control nsm-field mb-2" value="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-no">Estimate # <span class="text-danger">*</span></label>
                                        <input type="text" name="estimate_no" id="estimate-no" class="form-control nsm-field mb-2" value="<?=$est_number?>">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-date">Estimate Date <span class="text-danger">*</span></label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="estimate_date" id="estimate-date" class="form-control date nsm-field mb-2" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="expiry-date">Expiry Date <span class="text-danger">*</span></label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="expiry_date" id="expiry-date" class="form-control date nsm-field mb-2" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="purchase-order-no">Purchase Order #</label>
                                        <input type="text" name="purchase_order_no" id="purchase-order-no" class="form-control nsm-field mb-2" value="">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-type">Estimate Type <span class="text-danger">*</span></label>
                                        <select name="estimate_type" id="estimate-type" class="form-control nsm-field">
                                            <option value="Deposit">Deposit</option>
                                            <option value="Partial Payment">Partial Payment</option>
                                            <option value="Final Payment">Final Payment</option>
                                            <option value="Total Due" selected>Total Due</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-status">Estimate Status <span class="text-danger">*</span></label>
                                        <select name="estimate_status" id="estimate-status" class="form-control nsm-field">
                                            <option value="Draft">Draft</option>
                                            <option value="Submitted">Submitted</option>
                                            <option value="Accepted">Accepted</option>
                                            <option value="Declined By Customer">Declined By Customer</option>
                                            <option value="Lost">Lost</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <table class="nsm-table" id="item-table">
                                            <thead>
                                                <td data-name="Item">ITEM</td>
                                                <td data-name="Group">GROUP</td>
                                                <td data-name="Quantity">QUANTITY</td>
                                                <td data-name="Price">PRICE</td>
                                                <td data-name="Discount">DISCOUNT</td>
                                                <td data-name="Tax">TAX (CHANGE IN %)</td>
                                                <td data-name="Total">TOTAL</td>
                                                <td data-name="Manage"></td>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($items) && count($items) > 0) : ?>
                                                    <?php foreach($items as $item) : ?>
                                                        <?php if(!is_null($item->itemDetails)) : ?>
                                                        <?php $itemDetails = $item->itemDetails;?>
                                                        <?php $locations = $item->locations;?>
                                                        <tr>
                                                            <td><?=$itemDetails->title?><input type="hidden" name="item[]" value="<?=$item->item_id?>"></td>
                                                            <td><?=ucfirst($itemDetails->type)?></td>
                                                            <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="<?=$item->quantity?>"></td>
                                                            <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->price), 2, '.', ',')?>"></td>
                                                            <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->discount), 2, '.', ',')?>"></td>
                                                            <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
                                                            <td>
                                                                <span class="row-total">
                                                                    <?php
                                                                        $rowTotal = '$'.number_format(floatval($item->total), 2, '.', ',');
                                                                        $rowTotal = str_replace('$-', '-$', $rowTotal);
                                                                        echo $rowTotal;
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="nsm-button delete-row">
                                                                    <i class='bx bx-fw bx-trash'></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php else : ?>
                                                        <?php $packageDetails = $item->packageDetails; ?>
                                                        <?php $packageItems = $item->packageItems; ?>
                                                        <tr class="package">
                                                            <td><?=$packageDetails->name?><input type="hidden" name="package[]" value="<?=$packageDetails->id?>"></td>
                                                            <td>Package</td>
                                                            <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="<?=$item->qty?>"></td>
                                                            <td><span class="item-amount"><?=number_format(floatval($item->cost), 2, '.', ',')?></span></td>
                                                            <td></td>
                                                            <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
                                                            <td>
                                                                <span class="row-total">
                                                                    <?php
                                                                        $rowTotal = '$'.number_format(floatval($item->total), 2, '.', ',');
                                                                        $rowTotal = str_replace('$-', '-$', $rowTotal);
                                                                        echo $rowTotal;
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="nsm-button delete-row">
                                                                    <i class='bx bx-fw bx-trash'></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr class="package-items">
                                                            <td colspan="3">
                                                                <table class="nsm-table">
                                                                    <thead>
                                                                        <tr class="package-item-header">
                                                                            <th>Item Name</th>
                                                                            <th>Quantity</th>
                                                                            <th>Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="package-items-table">
                                                                        <?php foreach($packageItems as $packageItem) : ?>
                                                                            <?php $item = $this->items_model->getItemById($packageItem->item_id)[0]; ?>
                                                                            <tr class="package-item">
                                                                                <td><?=$item->title?></td>
                                                                                <td><?=$packageItem->quantity?></td>
                                                                                <td><?=number_format(floatval($packageItem->price), 2, '.', ',')?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="10">
                                                        <div class="nsm-page-buttons page-buttons-container">
                                                            <button type="button" class="nsm-button" id="add_item">
                                                                Add items
                                                            </button>
                                                            <button type="button" class="nsm-button" id="add_create_package">
                                                                Add/Create Package
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-3 offset-md-9">
                                        <table class="nsm-table float-end text-end">
                                            <tfoot>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td>
                                                        <span class="transaction-subtotal">$0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Taxes</td>
                                                    <td>
                                                        <span class="transaction-taxes">$0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Discounts</td>
                                                    <td>
                                                        <span class="transaction-discounts">$0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control nsm-field" value="">
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control nsm-field adjustment_input_cm_c" onchange="convertToDecimal(this)" value="">
                                                            </div>
                                                            <div class="col-1 d-flex align-items-center">
                                                                <span class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Optional it allows you to adjust the total amount Eg. +10 or -10."></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="transaction-adjustment">$0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Grand Total ($)</td>
                                                    <td>
                                                        <span class="transaction-grand-total">$0.00</span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h6>Request a Deposit</h6>
                                        <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <select name="deposit_request" class="form-control nsm-field">
                                            <option value="1" selected="selected">Deposit amount $</option>
                                            <option value="2">Percentage %</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <input type="text" name="deposit_amount" value="0" class="form-control nsm-field mb-2" autocomplete="off">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="message-to-customer">Message to Customer</label>
                                        <span class="help help-sm help-block">Add a message that will be displayed on the estimate.</span>
                                        <textarea name="customer_message" id="estimate-message-to-customer" cols="40" rows="2" class="form-control nsm-field mb-2">I would be happy to have an opportunity to work with you.</textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="terms-and-conditions">Terms &amp; Conditions</label>
                                        <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the estimate.</span>
                                        <textarea name="terms_conditions" id="estimate-terms-and-conditions" cols="40" rows="2" class="form-control nsm-field mb-2"></textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="attachments">
                                            <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                            <span>Maximum size: 20MB</span>
                                            <div id="estimate-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                <div class="dz-message" style="margin: 20px;border">
                                                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="#" id="show-existing-attachments" class="text-decoration-none">Show existing</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="instructions">Instructions</label>
                                        <span class="help help-sm help-block">Optional internal notes, will not appear to customer</span>
                                        <textarea name="instructions" id="estimate-instructions" cols="40" rows="2" class="form-control nsm-field"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col-md-4">
                                <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-4">
                                <div class="row h-100">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <span><a href="#" class="text-dark text-decoration-none" id="print-or-preview">Print or Preview</a></span>
                                        <span class="mx-3 divider"></span>
                                        <span><a href="#" onclick="makeRecurring('standard_estimate')" class="text-dark text-decoration-none">Make recurring</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group float-end" role="group">
                                    <button type="button" class="nsm-button success" id="save-and-send">
                                        Save and send
                                    </button>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-fw bx-chevron-up text-white"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
                                            <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="nsm-button float-end" id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of modal-->
    </form>
</div>