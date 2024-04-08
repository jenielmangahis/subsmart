<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($receipt)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="<?php echo base_url(); ?>accounting/update-transaction/sales-receipt/<?=$receipt->id?>">
<?php endif; ?>
    <div id="salesReceiptModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4 recent-transactions-button" data-bs-toggle="dropdown">
                                    <i class="bx bx-fw bx-history"></i>
                                </a>
                                <div class="dropdown-menu p-3" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Sales Receipts</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-sales-receipts">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Sales Receipt <span></span>
                            </span>
                        </div>
                    </div>
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
                                                <?php if(isset($receipt)) : ?>
                                                    <option value="<?=$receipt->customer_id?>">
                                                    <?php
                                                        $customer = $this->accounting_customers_model->get_by_id($receipt->customer_id);
                                                        echo $customer->first_name . ' ' . $customer->last_name;
                                                    ?>
                                                    </option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="email">Email <i class="invalid-email-warning" style="color: red; display: none;">Invalid email address</i></label>
                                            <input type="email" name="email" id="email" class="form-control nsm-field mb-2 sales-receipt-email" placeholder="Please enter your email" value="<?=isset($receipt) ? $receipt->email : ''?>" required>
                                            <div class="form-check">
                                                <div class="checkbox checkbox-sec">
                                                    <input type="checkbox" name="send_later" value="1" class="form-check-input" id="send-later" <?=isset($receipt) && $receipt->send_later === "1" ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="send-later">Send later</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6>
                                        <?php if(isset($receipt) && $receipt->status === '4') : ?>
                                        PAYMENT STATUS
                                        <?php else : ?>
                                        AMOUNT
                                        <?php endif; ?>
                                    </h6>
                                    <h2>
                                        <span class="transaction-grand-total">
                                        <?php if(isset($receipt)) : ?>
                                            <?php if($receipt->status === '4') : ?>
                                                VOID
                                            <?php else : ?>
                                                <?php
                                                $amount = '$'.number_format(floatval($receipt->total_amount), 2, '.', ',');
                                                $amount = str_replace('$-', '-$', $amount);
                                                echo $amount;
                                                ?>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            $0.00
                                        <?php endif; ?>
                                        </span>
                                    </h2>
                                </div>
                            </div>

                            <div class="row">
                                <?php if($is_copy) : ?>
                                <div class="col-12">
                                    <div class="nsm-callout primary">
                                        <button><i class='bx bx-x'></i></button>
                                        <h6 class="mt-0">This is a copy</h6>
                                        <span>This is a copy of a sales receipt. Revise as needed and save the sales receipt.</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-2">
                                    <label for="billing-address">Billing address</label>
                                    <textarea name="billing_address" id="billing-address" rows="4" class="form-control nsm-field mb-2"><?=isset($receipt) ? str_replace("<br />", "", $receipt->billing_address) : ''?></textarea>
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="sales-receipt-date">Sales Receipt date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="sales_receipt_date" id="sales-receipt-date" class="form-control nsm-field mb-2 date" value="<?=isset($receipt) ? date("m/d/Y", strtotime($receipt->sales_receipt_date)) : date("m/d/Y")?>">
                                    </div>

                                    
                                    <label for="purchase-order-no">P.O. Number</label>
                                    <input type="text" class="form-control nsm-field mb-2" name="purchase_order_no" id="purchase-order-no" value="<?=isset($receipt) ? $receipt->po_number : ''?>">
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="sales-rep">Sales Representative</label>
                                    <!-- <input type="text" name="sales_rep" id="sales-rep" class="form-control nsm-field mb-2" value="<?=isset($receipt) ? $receipt->sales_rep : ''?>"> -->
                                    <?php 
                                        $default_user = "";
                                        if( isset($receipt) ){
                                            $default_user = $receipt->sales_rep;
                                        }
                                    ?>
                                    <select name="sales_rep" id="sales-representatives" class="form-control nsm-field sales-representatives" required>
                                        <option value="10001">Select All</option>
                                        <?php if(!empty($sales_rep)): ?>
                                            <?php foreach ($sales_rep as $employee): ?>
                                                <option <?= $default_user == $employee->id ? 'selected' : '';  ?> value="<?= $employee->id; ?>"><?= $employee->FName.','.$employee->LName; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>                                
                                    <label for="location-of-sale">Location of sale</label>
                                    <input type="text" name="location_of_sale" id="location-of-sale" class="form-control nsm-field mb-2" value="<?=isset($receipt) ? $receipt->location_of_sale : ''?>">                                    
                                </div>
                                <!-- <div class="col-12 col-md-2 offset-md-4">
                                    <label for="location-of-sale">Location of sale</label>
                                    <input type="text" name="location_of_sale" id="location-of-sale" class="form-control nsm-field mb-2" value="<?=isset($receipt) ? $receipt->location_of_sale : ''?>">
                                </div> -->
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 grid-mb">
                                    <div id="label">
                                        <label for="tags">Tags</label>
                                        <span class="float-end"><a href="#" class="text-decoration-none" id="open-tags-modal">Manage tags</a></span>
                                    </div>
                                    <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                        <?php if(isset($tags) && count($tags) > 0) : ?>
                                            <?php foreach($tags as $tag) : ?>
                                                <?php 
                                                    $name = $tag->name;
                                                    if($tag->group_tag_id !== null) {
                                                        $group = $this->tags_model->getGroupById($tag->group_tag_id);
                                                        $name = $group->name.': '.$tag->name;
                                                    }
                                                ?>
                                                <option value="<?=$tag->id?>" selected><?=$name?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <label for="payment_method">Payment method</label>
                                    <select name="payment_method" id="payment_method" class="form-control nsm-field">
                                        <?php if(isset($receipt)) : ?>
                                            <option value="<?=$receipt->payment_method?>"><?=$this->accounting_payment_methods_model->getById($receipt->payment_method)->name?></option>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="ref_no">Reference no.</label>
                                    <input type="number" name="ref_no" id="ref_no" class="form-control nsm-field mb-2" value="<?=isset($receipt) ? $receipt->reference_no : ''?>">
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="deposit_to_account">Deposit to</label>
                                    <select name="deposit_to_account" id="deposit_to_account" class="form-control nsm-field" required>
                                        <?php if(isset($receipt)) : ?>
                                            <option value="<?=$receipt->deposit_to_account?>"><?=$this->chart_of_accounts_model->getName($receipt->deposit_to_account)?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <table class="nsm-table" id="item-table">
                                        <thead>
                                            <td data-name="Item">ITEM</td>
                                            <td data-name="Type">TYPE</td>
                                            <td data-name="Location">LOCATION</td>
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
                                                        <td>
                                                            <?php if($itemDetails->type === 'product' || $itemDetails->type === 'item') : ?>
                                                            <select name="location[]" class="form-control nsm-field" required>
                                                                <?php foreach($locations as $location) : ?>
                                                                    <option value="<?=$location['id']?>" <?=$item->location_id === $location['id'] ? 'selected' : ''?>><?=$location['name']?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <?php endif; ?>
                                                        </td>
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
                                                        <td></td>
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
                                                        <button type="button" class="nsm-button" id="add_group">
                                                            Add By Group
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
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="message_sales_receipt">Message displayed on sales receipt</label>
                                            <textarea name="message_sales_receipt" id="message_sales_receipt" class="form-control nsm-field mb-2"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_sales_receipt) : ''?></textarea>

                                           
                                        </div>
                                        <div class="col-12 col-md-6">
                                        <label for="message_statement">Message displayed on statement</label>
                                            <textarea name="message_statement" id="message_statement" class="form-control nsm-field mb-2"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_on_statement) : ''?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="sales-receipt-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%; flex-wrap:wrap;">
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
                                    </div>
                                </div>

                                <div class="col-12 col-md-3 offset-md-3">
                                    <table class="nsm-table float-end text-end">
                                        <tfoot>
                                            <tr>
                                                <td>Subtotal</td>
                                                <td>
                                                    <span class="transaction-subtotal">
                                                    <?php if(isset($receipt)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($receipt->subtotal), 2, '.', ',');
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
                                                    <span class="transaction-taxes">
                                                    <?php if(isset($receipt)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($receipt->tax_total), 2, '.', ',');
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
                                                <td>Discounts</td>
                                                <td>
                                                    <span class="transaction-discounts">
                                                    <?php if(isset($receipt)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($receipt->discount_total), 2, '.', ',');
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
                                                <td>
                                                    <div class="row" style="float: right; margin-right: -20px !important;">
                                                        <div class="col-10">
                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control sales-receipt-adjustment-name nsm-field" value="<?=isset($receipt) ? $receipt->adjustment_name : ''?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control nsm-field adjustment_input_cm_c" onchange="convertToDecimal(this)" value="<?=isset($receipt) ? number_format(floatval($receipt->adjustment_value), 2, '.', ',') : ''?>">
                                                        </div> -->
                                                        <div class="col-1 d-flex align-items-center" style="padding-left: 0 !important;">
                                                            <span id="modal-help-popover-adjustment" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""></span>
                                                            <!-- <span class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Optional it allows you to adjust the total amount Eg. +10 or -10."></span> -->
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input style="float: right; width: 75px;" type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control sales-receipt-adjustment-value nsm-field adjustment_input_cm_c" disabled onchange="convertToDecimal(this)" value="<?=isset($receipt) ? number_format(floatval($receipt->adjustment_value), 2, '.', ',') : ''?>">
                                                    <!-- <span class="transaction-adjustment">
                                                    <?php if(isset($receipt)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($receipt->adjustment_value), 2, '.', ',');
                                                        $amount = str_replace('$-', '-$', $amount);
                                                        echo $amount;
                                                        ?>
                                                    <?php else : ?>
                                                        $0.00
                                                    <?php endif; ?>
                                                    </span> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Grand Total ($)</td>
                                                <td>
                                                    <span class="transaction-grand-total">
                                                    <?php if(isset($receipt)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($receipt->total_amount), 2, '.', ',');
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

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" id="save-and-print">Print or Preview</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('sales_receipt')">Make Recurring</a></span>
                                    <?php if(isset($receipt)) : ?>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-sales-receipt">Copy</a>
                                                <?php if($receipt->status !== "4") : ?>
                                                <a class="dropdown-item" href="#" id="void-sales-receipt">Void</a>
                                                <?php endif; ?>
                                                <a class="dropdown-item" href="#" id="delete-sales-receipt">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group float-md-end" role="group">
                                <button type="button" class="nsm-button success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
                                        <a class="dropdown-item" href="#" onclick="saveAndSendForm(event)">Save and send</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>

<script>
    $(document).ready(function() {

        //$('.sales-representative').select2();

        $(".sales-receipt-adjustment-name").change(function(){
            var sales_receipt_adj_name = $('.sales-receipt-adjustment-name').val();
            var sales_receipt_adj_value = $('.sales-receipt-adjustment-value').val();
            $('.sales-receipt-adjustment-value').prop("disabled", false); 
            if(sales_receipt_adj_name == '') {
                $('.sales-receipt-adjustment-value').prop("disabled", true); 
            }
        } );        

        $(".sales-receipt-email").change(function(){
            
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            var sales_receipt_email = $(".sales-receipt-email").val();
            if (testEmail.test(sales_receipt_email)) {
                $(".invalid-email-warning").hide();
            } else {
                $(".invalid-email-warning").show();
            }                

        });        

        $('#modal-help-popover-adjustment').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
            } 
        });    

        $('#modal-help-popover-unscheduled').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list.';
            } 
        });         

    });
</script>