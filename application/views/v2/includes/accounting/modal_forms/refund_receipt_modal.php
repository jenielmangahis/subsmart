<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($receipt)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/refund-receipt/<?=$receipt->id?>">
<?php endif; ?>
    <div id="refundReceiptModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-history fa-lg"></i>
                                </a>
                                <div class="dropdown-menu" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Refund Receipts</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-refund-receipts">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Refund Receipt <span></span>
                            </h4>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row customer-details">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="customer">Customer</label>
                                                        <select name="customer" id="customer" class="form-control" required>
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
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email (Separate emails with a comma)" value="<?=isset($receipt) ? $receipt->email : ''?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                            <?php if(isset($receipt) && $receipt->status === '4') : ?>
                                                PAYMENT STATUS
                                                <?php else : ?>
                                                AMOUNT
                                                <?php endif; ?>
                                            </h6>
                                            <h2 class="text-right">
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
                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <h6 class="mt-0">This is a copy</h6>
                                                <span>This is a copy of a refund receipt. Revise as needed and save the refund receipt.</span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="billing-address">Billing address</label>
                                                <textarea name="billing_address" id="billing-address" class="form-control"><?=isset($receipt) ? str_replace("<br />", "", $receipt->billing_address) : ''?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="refund-receipt-date">Refund Receipt date</label>
                                                <input type="text" name="refund_receipt_date" id="refund-receipt-date" class="form-control date" value="<?=isset($receipt) ? date("m/d/Y", strtotime($receipt->refund_receipt_date)) : date("m/d/Y")?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="purchase-order-no">P.O. Number</label>
                                                <input type="text" class="form-control" name="purchase_order_no" id="purchase-order-no" value="<?=isset($receipt) ? $receipt->po_number : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <div class="form-group w-100">
                                                <label for="sales-rep">Sales Rep</label>
                                                <input type="text" name="sales_rep" id="sales-rep" class="form-control" value="<?=isset($receipt) ? $receipt->sales_rep : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 offset-md-3">
                                            <div class="form-group">
                                                <label for="location-of-sale">Location of sale</label>
                                                <input type="text" name="location_of_sale" id="location-of-sale" class="form-control" value="<?=isset($receipt) ? $receipt->location_of_sale : ''?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div id="label">
                                                    <label for="tags">Tags</label>
                                                    <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
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
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="payment_method">Payment method</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <?php if(isset($receipt)) : ?>
                                                        <option value="<?=$receipt->payment_method?>"><?=$this->accounting_payment_methods_model->getById($receipt->payment_method)->name?></option>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="refund-from-account">Refund From</label>
                                                <select name="refund_from_account" id="refund-from-account" class="form-control" required>
                                                    <?php if(isset($receipt)) : ?>
                                                        <option value="<?=$receipt->refund_from_account?>"><?=$this->chart_of_accounts_model->getName($receipt->refund_from_account)?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if(isset($receipt)) : ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Balance</label>
                                                <h4>
                                                    <?php
                                                    $balance = '$'.number_format(floatval($refundAcc->balance), 2, '.', ',');
                                                    $balance = str_replace('$-', '-$', $balance);
                                                    echo $balance;
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="check-no">Check no.</label>
                                                <input type="text" class="form-control" name="check_no" id="check-no" value="<?=isset($receipt) && $receipt->print_later === "1" ? 'To print' : $receipt->check_no?>" <?=isset($receipt) && $receipt->print_later === "1" ? 'disabled' : ''?>>
                                                <div class="form-check">
                                                    <div class="checkbox checkbox-sec">
                                                        <input type="checkbox" name="print_later" value="1" class="form-check-input" id="print-later" <?=isset($receipt) && $receipt->print_later === "1" ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="print-later">Print later</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="refund-receipt-item-table-container w-100">
                                                <div class="refund-receipt-item-table">
                                                    <table class="table table-bordered table-hover" id="item-table">
                                                        <thead>
                                                            <th width="20%">NAME</th>
                                                            <th>TYPE</th>
                                                            <th>LOCATION</th>
                                                            <th width="10%">QUANTITY</th>
                                                            <th width="10%">PRICE</th>
                                                            <th width="10%">DISCOUNT</th>
                                                            <th width="10%">TAX (CHANGE IN %)</th>
                                                            <th>TOTAL</th>
                                                            <th width="3%"></th>
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
                                                                            <select name="location[]" class="form-control" required>
                                                                                <?php foreach($locations as $location) : ?>
                                                                                    <option value="<?=$location['id']?>" <?=$item->location_id === $location['id'] ? 'selected' : ''?>><?=$location['name']?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td><input type="number" name="quantity[]" class="form-control text-right" required value="<?=$item->quantity?>"></td>
                                                                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->price), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->discount), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
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
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php else : ?>
                                                                    <?php $packageDetails = $item->packageDetails; ?>
                                                                    <?php $packageItems = $item->packageItems; ?>
                                                                    <tr class="package">
                                                                        <td><?=$packageDetails->name?><input type="hidden" name="package[]" value="<?=$packageDetails->id?>"></td>
                                                                        <td>Package</td>
                                                                        <td></td>
                                                                        <td><input type="number" name="quantity[]" class="form-control text-right" required value="<?=$item->quantity?>"></td>
                                                                        <td><span class="item-amount"><?=number_format(floatval($item->price), 2, '.', ',')?></span></td>
                                                                        <td></td>
                                                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
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
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="package-items">
                                                                        <td colspan="3">
                                                                            <table class="table m-0 bg-white">
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
                                                    </table>
                                                </div>
                                                <div class="refund-receipt-item-table-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a class="link-modal-open" href="#" id="add_item" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a> &emsp;
                                                            <a class="link-modal-open" href="#" id="add_group" data-target="#item_group_list"><span class="fa fa-plus-square fa-margin-right"></span>Add By Group</a> &emsp;
                                                            <a class="link-modal-open" href="#" id="add_create_package" data-target="#package_list"><span class="fa fa-plus-square fa-margin-right"></span>Add/Create Package</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message_refund">Message displayed on refund receipt</label>
                                                        <textarea name="message_refund" id="message_refund" class="form-control"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_refund_receipt) : ''?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message_statement">Message displayed on statement</label>
                                                        <textarea name="message_statement" id="message_statement" class="form-control"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_on_statement) : ''?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="expense-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="#" id="show-existing-attachments" class="text-info">Show existing</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <table class="table-borderless bg-transparent float-right table text-right w-50">
                                                <tbody>
                                                    <tr>
                                                        <td>Subtotal</td>
                                                        <td class="w-25">
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
                                                        <td class="w-25">
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
                                                        <td class="w-25">
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
                                                        <td class="d-flex align-items-center justify-content-end">
                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control w-50 mr-2" value="<?=isset($receipt) ? $receipt->adjustment_name : ''?>">
                                                            <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control adjustment_input_cm_c w-25 mr-2" onchange="convertToDecimal(this)" value="<?=isset($receipt) ? number_format(floatval($receipt->adjustment_value), 2, '.', ',') : ''?>">
                                                            <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                        </td>
                                                        <td class="w-25">
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
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>Grand Total ($)</td>
                                                        <td class="w-25">
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
                    </div>
                </div>

                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <?php if(isset($receipt)) : ?>
                                    <span><a href="#" class="text-white">Order checks</a></span>
                                    <span class="mx-3 divider"></span>
                                    <?php endif; ?>
                                    <span><a href="#" class="text-white" id="save-and-print">Print or Preview</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-white" onclick="makeRecurring('refund_receipt')">Make Recurring</a></span>
                                    <?php if(isset($receipt)) : ?>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
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
    <!--end of modal-->
</form>
</div>