<style>

.autocomplete-left{
    display: inline-block;
    width: 65px;    
}
.autocomplete-right{
    display: inline-block;
    width: 75s%;
    vertical-align: top;
}
.autocomplete-img {
    height: 50px;
    width: 50px;
}
#refundReceiptModal .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
#refundReceiptModal .modal-body{
    overflow-x:hidden;
}

</style>
<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($receipt)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="<?php echo base_url(); ?>accounting/update-transaction/refund-receipt/<?=$receipt->id?>">
<?php endif; ?>
    <div id="refundReceiptModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Refund Receipts</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-refund-receipts">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Refund Receipt <span></span>
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
                                            <div id="open-customer-info-window-container" style='display:none; float:right;'><span class="float-end"><a href="javascript:void(0)" class="nsm-button btn-small open-customer-info-window" style="margin-bottom:3px;display:inline-block;" id="open-customer-info-window">View Customer Info</a></span></div> 
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
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control nsm-field mb-2" placeholder="Email (Separate emails with a comma)" value="<?=isset($receipt) ? $receipt->email : ''?>">
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
                                        <span>This is a copy of a refund receipt. Revise as needed and save the refund receipt.</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-2">
                                    <label for="billing-address">Billing address</label>
                                    <textarea name="billing_address" id="billing-address" class="form-control nsm-field mb-2" style="height:185px;"><?=isset($receipt) ? str_replace("<br />", "", $receipt->billing_address) : ''?></textarea>

                                    <label for="tags">Tags</label>
                                    <span class="float-end"><a href="#" class="text-decoration-none mt-2" id="open-tags-modal">Manage tags</a></span>
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
                                <div class="col-12 col-md-2">
                                    <label for="refund-receipt-date">Refund Receipt date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="refund_receipt_date" id="refund-receipt-date" class="form-control nsm-field mb-2 date" value="<?=isset($receipt) ? date("m/d/Y", strtotime($receipt->refund_receipt_date)) : date("m/d/Y")?>">
                                    </div>

                                    <label for="purchase-order-no" class="mt-2">P.O. Number</label>
                                    <input type="text" class="form-control nsm-field mb-2" name="purchase_order_no" id="purchase-order-no" value="<?=isset($receipt) ? $receipt->po_number : ''?>">

                                    <label for="payment_method" class="mt-2">Payment method</label>
                                    <select name="payment_method" id="payment_method" class="form-control nsm-field">
                                        <?php if(isset($receipt)) : ?>
                                            <option value="<?=$receipt->payment_method?>"><?=$this->accounting_payment_methods_model->getById($receipt->payment_method)->name?></option>
                                        <?php endif;?>
                                    </select>
                                    
                                    <?php if(isset($receipt)) { ?>
                                    <label class="mt-2">Balance</label>
                                    <?php
                                        $balance = '$'.number_format(floatval($refundAcc->balance), 2, '.', ',');
                                        $balance = str_replace('$-', '-$', $balance);
                                    ?>
                                    <input type="text" readonly="" disabled="" class="form-control" value="<?= $balance; ?>" />      
                                    <?php } ?>
                                    
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="sales-rep" class="mt-2">Sales Rep</label>
                                    <!-- <input type="text" name="sales_rep" id="sales-rep" class="form-control nsm-field mb-2" value="<?=isset($receipt) ? $receipt->sales_rep : ''?>"> -->
                                    <select id="sales-rep" name="sales_rep" class="form-control" class="form-control nsm-field mb-2"></select>

                                    <label for="location-of-sale" class="mt-2">Location of sale</label>
                                    <input type="text" name="location_of_sale" id="location-of-sale" class="form-control nsm-field mb-2" value="<?=isset($receipt) ? $receipt->location_of_sale : ''?>">

                                    <label for="refund-from-account" class="mt-2">Refund From</label>
                                    <select name="refund_from_account" id="refund-from-account" class="form-control nsm-field" required>
                                        <?php if(isset($receipt)) : ?>
                                            <option value="<?=$receipt->refund_from_account?>"><?=$this->chart_of_accounts_model->getName($receipt->refund_from_account)?></option>
                                        <?php endif; ?>
                                    </select>
                                    <?php if(isset($receipt)) { ?>
                                        <label for="check-no" class="mt-2">Check no.</label>
                                        <input type="text" class="form-control nsm-field mb-2" name="check_no" id="check-no" value="<?=isset($receipt) && $receipt->print_later === "1" ? 'To print' : $receipt->check_no?>" <?=isset($receipt) && $receipt->print_later === "1" ? 'disabled' : ''?>>
                                        <div class="form-check">
                                            <input type="checkbox" name="print_later" value="1" class="form-check-input" id="print-later" <?=isset($receipt) && $receipt->print_later === "1" ? 'checked' : ''?>>
                                            <label class="form-check-label" for="print-later">Print later</label>
                                        </div>
                                    <?php } ?>
                                </div>    
                                
                                <div class="col-12 col-md-4">
                                    <label for="message_refund" class="mt-2">Message displayed on refund receipt</label>
                                    <textarea name="message_refund" id="message_refund" class="form-control nsm-field mb-2" style="height:100px;"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_refund_receipt) : ''?></textarea>

                                    <label for="message_statement" class="mt-2">Message displayed on statement</label>
                                    <textarea name="message_statement" id="message_statement" class="form-control nsm-field mb-2" style="height:100px;"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_on_statement) : ''?></textarea>
                                </div>
                            </div>
                            <div class="row mt-2">
                                
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <table class="nsm-table" id="item-table">
                                        <thead>
                                            <td data-name="Item" style="width: 20%">ITEM</td>
                                            <td data-name="Type" style="width: 10%">TYPE</td>
                                            <td data-name="Location" style="width: 15%; text-align: center;">LOCATION</td>
                                            <td data-name="Quantity" style="text-align: center;">QUANTITY</td>
                                            <td data-name="Price" style="text-align: center;">PRICE</td>
                                            <td data-name="Discount" style="text-align: center;">DISCOUNT</td>
                                            <td data-name="Tax" style="text-align: center;">TAX (CHANGE IN %)</td>
                                            <td data-name="Total" style="width: 7%;">TOTAL</td>
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
                                                <td colspan="10" style="">
                                                    <div class="nsm-page-buttons page-buttons-container" style="margin-bottom: 15px; margin-top: 15px;">
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

                            <div class="row mt-4">
                                <div class="col-12 col-md-6">
                                    <div class="attachments">
                                        <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                        <span>Maximum size: 20MB</span> 
                                        <div id="refund-receipt-attachments" class="dropzone d-block justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                <div class="col-12 col-md-3 offset-md-3">
                                    <table class="nsm-table float-end text-end">
                                        <tfoot>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>Subtotal</td>
                                                <td style="min-width: 75px;">
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
                                                <td>&nbsp;</td>
                                                <td>Taxes</td>
                                                <td style="min-width: 60px;">
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
                                                <td>&nbsp;</td>
                                                <td>Discounts</td>
                                                <td style="min-width: 60px;">
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
                                                <td><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control nsm-field" value="<?=isset($receipt) ? $receipt->adjustment_name : ''?>"></td>
                                                <td style="width: 150px;">
                                                    <!-- <div class="row">
                                                        <div class="col-8">
                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control nsm-field" value="<?=isset($receipt) ? $receipt->adjustment_name : ''?>">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control nsm-field adjustment_input_cm_c" onchange="convertToDecimal(this)" value="<?=isset($receipt) ? number_format(floatval($receipt->adjustment_value), 2, '.', ',') : ''?>" style="display:inline-block; width:80%;">
                                                            <span class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Optional it allows you to adjust the total amount Eg. +10 or -10."></span>
                                                        </div>
                                                    </div> -->
                                                    <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control nsm-field adjustment_input_cm_c" onchange="convertToDecimal(this)" value="<?=isset($receipt) ? number_format(floatval($receipt->adjustment_value), 2, '.', ',') : ''?>" style="display:inline-block; width:80%;">
                                                    <!-- <span class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Optional it allows you to adjust the total amount Eg. +10 or -10."></span> -->                                                  
                                                    <span id="modal-help-popover-adjustment" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""></span>
                                                </td>
                                                <td style="min-width: 60px;">
                                                    <span class="transaction-adjustment">
                                                    <?php if(isset($receipt)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($receipt->adjustment_value), 2, '.', ',');
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
                                                <td>&nbsp;</td>
                                                <td>Grand Total&nbsp;</td>
                                                <td style="min-width: 60px;">
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
                                    <?php if(isset($receipt)) : ?>
                                    <span><a href="#" class="text-dark text-decoration-none">Order checks</a></span>
                                    <span class="mx-3 divider"></span>
                                    <?php endif; ?>
                                    <span><a href="#" class="text-dark text-decoration-none" id="save-and-print">Print or Preview</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('refund_receipt')">Make Recurring</a></span>
                                    <?php if(isset($receipt)) : ?>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-refund-receipt">Copy</a>
                                                <?php if($receipt->status !== "4") : ?>
                                                <a class="dropdown-item" href="#" id="void-refund-receipt">Void</a>
                                                <?php endif; ?>
                                                <a class="dropdown-item" href="#" id="delete-refund-receipt">Delete</a>
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
$(function(){
    
    $('#modal-help-popover-adjustment').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        } 
    }); 

    $('#sales-rep').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        dropdownParent: $('#refundReceiptModal .modal-content'),
        placeholder: 'Select User',
        maximumSelectionLength: 5,
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser,
        initSelection: function(element, callback) {
            //callback({id: 'default', text: '<?php echo isset($receipt) ? $receipt->sales_rep : ''; ?>' });
            callback({
                id: 'default', 
                text: '<?php echo isset($receipt->sales_rep) ? $default_sales_representative : ''; ?>',
             });            
        }       
    });

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }    
});
</script>