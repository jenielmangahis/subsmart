<div class="full-screen-modal">
    <?php if(!isset($estimate)) : ?>
    <form onsubmit="submitModalForm(event, this)" id="modal-form">
    <?php else : ?>
    <form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/option-estimate/<?=$estimate->id?>">
    <?php endif; ?>
        <div id="options-estimate-modal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Options Estimate</span>
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
                                        <?php if(isset($estimate)) : ?>
                                            <?php if(!$is_copy) : ?>
                                                <div class="d-flex justify-content-end">
                                                    <div class="btn-group float-end" role="group">
                                                        <button type="button" class="nsm-button">
                                                            Create invoice
                                                        </button>
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="nsm-button dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-fw bx-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">Copy to purchase order</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="customer-email">Customer Email</label>
                                        <input type="text" name="customer_email" id="customer-email" class="form-control nsm-field mb-2" value="<?=isset($estimate) ? $customer->email : ''?>" disabled>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="customer-mobile">Customer Mobile</label>
                                        <input type="text" name="customer_mobile" id="customer-mobile" class="form-control nsm-field mb-2" value="<?=isset($estimate) ? $customer->phone_m : ''?>" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label for="job-location">Job Location</label>
                                        <input type="text" name="job_location" id="job-location" class="form-control nsm-field mb-2" value="<?=isset($estimate) ? $estimate->job_location : ''?>">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="job-name">Job Name</label>
                                        <input type="text" name="job_name" id="job-name" class="form-control nsm-field mb-2" value="<?=isset($estimate) ? $estimate->job_name : ''?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-no">Estimate # <span class="text-danger">*</span></label>
                                        <input type="text" name="estimate_no" id="estimate-no" class="form-control nsm-field mb-2" value="<?=isset($estimate) ? $estimate->estimate_number : $est_number?>" <?=isset($estimate) ? 'disabled' : ''?>>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-date">Estimate Date <span class="text-danger">*</span></label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="estimate_date" id="estimate-date" class="form-control date nsm-field mb-2" value="<?=isset($estimate) ? date("m/d/Y", strtotime($estimate->estimate_date)) : ''?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="expiry-date">Expiry Date <span class="text-danger">*</span></label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="expiry_date" id="expiry-date" class="form-control date nsm-field mb-2" value="<?=isset($estimate) ? date("m/d/Y", strtotime($estimate->expiry_date)) : ''?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <label for="purchase-order-no">Purchase Order #</label>
                                        <input type="text" name="purchase_order_no" id="purchase-order-no" class="form-control nsm-field mb-2" value="<?=isset($estimate) ? $estimate->purchase_order_number : ''?>">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-type">Estimate Type <span class="text-danger">*</span></label>
                                        <select name="estimate_type" id="estimate-type" class="form-control nsm-field">
                                            <option value="Deposit" <?=isset($estimate) && $estimate->type === 'Deposit' ? 'selected' : '' ?>>Deposit</option>
                                            <option value="Partial Payment" <?=isset($estimate) && $estimate->type === 'Partial Payment' ? 'selected' : '' ?>>Partial Payment</option>
                                            <option value="Final Payment" <?=isset($estimate) && $estimate->type === 'Final Payment' ? 'selected' : '' ?>>Final Payment</option>
                                            <option value="Total Due" <?=isset($estimate) && $estimate->type === 'Total Due' || !isset($estimate) ? 'selected' : '' ?>>Total Due</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="estimate-status">Estimate Status <span class="text-danger">*</span></label>
                                        <select name="estimate_status" id="estimate-status" class="form-control nsm-field">
                                            <option value="Draft" <?=isset($estimate) && $estimate->status === 'Draft' || !isset($estimate) ? 'selected' : '' ?>>Draft</option>
                                            <option value="Submitted" <?=isset($estimate) && $estimate->status === 'Submitted' ? 'selected' : '' ?>>Submitted</option>
                                            <option value="Accepted" <?=isset($estimate) && $estimate->status === 'Accepted' ? 'selected' : '' ?>>Accepted</option>
                                            <option value="Declined By Customer" <?=isset($estimate) && $estimate->status === 'Declined By Customer' ? 'selected' : '' ?>>Declined By Customer</option>
                                            <option value="Lost" <?=isset($estimate) && $estimate->status === 'Lost' ? 'selected' : '' ?>>Lost</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <div class="accordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-option-1" aria-expanded="false" aria-controls="collapse-option-1">
                                                        Option 1 Items
                                                    </button>
                                                </h2>
                                                <div id="collapse-option-1" class="accordion-collapse collapse show">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-12 mb-2">
                                                                <table class="nsm-table" id="option-1-item-table">
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
                                                                        <?php if(isset($itemsOption1) && count($itemsOption1) > 0) : ?>
                                                                            <?php foreach($itemsOption1 as $item) : ?>
                                                                                <?php $itemDetails = $item->itemDetails;?>
                                                                                <?php $locations = $item->locations;?>
                                                                                <tr>
                                                                                    <td><?=$itemDetails->title?><input type="hidden" name="item[]" value="<?=$item->item_id?>"></td>
                                                                                    <td><?=ucfirst($itemDetails->type)?></td>
                                                                                    <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="<?=$item->qty?>"></td>
                                                                                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->costing), 2, '.', ',')?>"></td>
                                                                                    <td><input type="number" name="discount[]" disabled onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->discount), 2, '.', ',')?>"></td>
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
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="10">
                                                                                <div class="nsm-page-buttons page-buttons-container">
                                                                                    <button type="button" class="nsm-button" id="add_option_1_item">
                                                                                        Add items
                                                                                    </button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <label for="option-1-message">Option 1 Message</label>
                                                                <textarea name="option_1_message" id="option-1-message" cols="40" rows="2" class="form-control nsm-field mb-2"><?=isset($estimate) ? $estimate->option_message : ''?></textarea>
                                                            </div>
                                                            <div class="col-12 col-md-3 offset-md-3">
                                                                <table class="nsm-table float-end text-end">
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td>Subtotal</td>
                                                                            <td>
                                                                                <span class="table-subtotal">
                                                                                <?php if(isset($estimate)) : ?>
                                                                                    <?php
                                                                                    $amount = '$'.number_format(floatval($estimate->sub_total), 2, '.', ',');
                                                                                    $amount = str_replace('$-', '-$', $amount);
                                                                                    echo $amount;
                                                                                    ?>
                                                                                <?php else : ?>
                                                                                    $0.00
                                                                                <?php endif; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Taxes</td>
                                                                            <td>
                                                                                <span class="table-taxes">
                                                                                <?php if(isset($estimate)) : ?>
                                                                                    <?php
                                                                                    $amount = '$'.number_format(floatval($estimate->tax1_total), 2, '.', ',');
                                                                                    $amount = str_replace('$-', '-$', $amount);
                                                                                    echo $amount;
                                                                                    ?>
                                                                                <?php else : ?>
                                                                                    $0.00
                                                                                <?php endif; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Grand Total ($)</td>
                                                                            <td>
                                                                                <span class="table-total">
                                                                                <?php if(isset($estimate)) : ?>
                                                                                    <?php
                                                                                    $amount = '$'.number_format(floatval($estimate->option1_total), 2, '.', ',');
                                                                                    $amount = str_replace('$-', '-$', $amount);
                                                                                    echo $amount;
                                                                                    ?>
                                                                                <?php else : ?>
                                                                                    $0.00
                                                                                <?php endif; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <div class="accordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-option-2" aria-expanded="false" aria-controls="collapse-option-2">
                                                        Option 2 Items
                                                    </button>
                                                </h2>
                                                <div id="collapse-option-2" class="accordion-collapse collapse show">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-12 mb-2">
                                                                <table class="nsm-table" id="option-2-item-table">
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
                                                                        <?php if(isset($itemsOption2) && count($itemsOption2) > 0) : ?>
                                                                            <?php foreach($itemsOption2 as $item) : ?>
                                                                                <?php $itemDetails = $item->itemDetails;?>
                                                                                <?php $locations = $item->locations;?>
                                                                                <tr>
                                                                                    <td><?=$itemDetails->title?><input type="hidden" name="item[]" value="<?=$item->item_id?>"></td>
                                                                                    <td><?=ucfirst($itemDetails->type)?></td>
                                                                                    <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="<?=$item->qty?>"></td>
                                                                                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->costing), 2, '.', ',')?>"></td>
                                                                                    <td><input type="number" name="discount[]" disabled onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?=number_format(floatval($item->discount), 2, '.', ',')?>"></td>
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
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="10">
                                                                                <div class="nsm-page-buttons page-buttons-container">
                                                                                    <button type="button" class="nsm-button" id="add_option_2_item">
                                                                                        Add items
                                                                                    </button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <label for="option-2-message">Option 2 Message</label>
                                                                <textarea name="option_2_message" id="option-2-message" cols="40" rows="2" class="form-control nsm-field mb-2"><?=isset($estimate) ? $estimate->option2_message : ''?></textarea>
                                                            </div>
                                                            <div class="col-12 col-md-3 offset-md-3">
                                                                <table class="nsm-table float-end text-end">
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td>Subtotal</td>
                                                                            <td>
                                                                                <span class="table-subtotal">
                                                                                <?php if(isset($estimate)) : ?>
                                                                                    <?php
                                                                                    $amount = '$'.number_format(floatval($estimate->sub_total2), 2, '.', ',');
                                                                                    $amount = str_replace('$-', '-$', $amount);
                                                                                    echo $amount;
                                                                                    ?>
                                                                                <?php else : ?>
                                                                                    $0.00
                                                                                <?php endif; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Taxes</td>
                                                                            <td>
                                                                                <span class="table-taxes">
                                                                                <?php if(isset($estimate)) : ?>
                                                                                    <?php
                                                                                    $amount = '$'.number_format(floatval($estimate->tax2_total), 2, '.', ',');
                                                                                    $amount = str_replace('$-', '-$', $amount);
                                                                                    echo $amount;
                                                                                    ?>
                                                                                <?php else : ?>
                                                                                    $0.00
                                                                                <?php endif; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Grand Total ($)</td>
                                                                            <td>
                                                                                <span class="table-total">
                                                                                <?php if(isset($estimate)) : ?>
                                                                                    <?php
                                                                                    $amount = '$'.number_format(floatval($estimate->option2_total), 2, '.', ',');
                                                                                    $amount = str_replace('$-', '-$', $amount);
                                                                                    echo $amount;
                                                                                    ?>
                                                                                <?php else : ?>
                                                                                    $0.00
                                                                                <?php endif; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h6>Request a Deposit</h6>
                                        <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <select name="deposit_request" class="form-control nsm-field">
                                            <option value="1" <?=isset($estimate) && $estimate->deposit_request === '1' ? 'selected' : ''?>>Deposit amount $</option>
                                            <option value="2" <?=isset($estimate) && $estimate->deposit_request === '2' ? 'selected' : ''?>>Percentage %</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <input type="text" name="deposit_amount" value="0" class="form-control nsm-field mb-2" autocomplete="off" value="<?=isset($estimate) ? $estimate->deposit_amount : '0.00'?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="message-to-customer">Message to Customer</label>
                                        <span class="help help-sm help-block">Add a message that will be displayed on the estimate.</span>
                                        <textarea name="customer_message" id="estimate-message-to-customer" cols="40" rows="2" class="form-control nsm-field mb-2"><?=isset($estimate) ? $estimate->customer_message : 'I would be happy to have an opportunity to work with you.'?></textarea>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="terms-and-conditions">Terms &amp; Conditions</label>
                                        <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the estimate.</span>
                                        <textarea name="terms_conditions" id="estimate-terms-and-conditions" cols="40" rows="2" class="form-control nsm-field mb-2"><?=isset($estimate) ? $estimate->terms_conditions : ''?></textarea>
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
                                        <textarea name="instructions" id="estimate-instructions" cols="40" rows="2" class="form-control nsm-field"><?=isset($estimate) ? $estimate->instructions : ''?></textarea>
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
                                        <span><a href="#" onclick="makeRecurring('options_estimate')" class="text-dark text-decoration-none">Make recurring</a></span>
                                        <?php if(isset($estimate)) : ?>
                                        <span class="mx-3 divider"></span>
                                        <span>
                                            <div class="dropup">
                                                <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" id="copy-estimate">Copy</a>
                                                    <a class="dropdown-item" href="#" id="delete-estimate">Delete</a>
                                                    <a class="dropdown-item" href="#">Audit history</a>
                                                </div>
                                            </div>
                                        </span>
                                        <?php endif; ?>
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