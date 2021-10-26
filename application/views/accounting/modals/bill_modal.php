<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($bill)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/vendors/<?=$bill->vendor_id?>/update-transaction/bill/<?=$bill->id?>">
<?php endif; ?>
    <div id="billModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title"><a href="#"><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>Bill <span><?=isset($bill) && !is_null($bill->bill_no) && $bill->bill_no !== "" ? '#'.$bill->bill_no : ''?></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row"  style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0"  style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="vendor">Vendor</label>
                                                        <select name="vendor_id" id="vendor" class="form-control" required>
                                                            <?php if(isset($bill)) : ?>
                                                                <option value="<?=$bill->vendor_id?>">
                                                                    <?php $vendor = $this->vendors_model->get_vendor_by_id($bill->vendor_id); ?>
                                                                    <?=$vendor->display_name?>
                                                                </option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                                <?php if(isset($bill)) : ?>
                                                    <?php if(!$is_copy) : ?>
                                                        <?=$bill->status === "1" ? "BALANCE DUE" : "PAYMENT STATUS"?>
                                                    <?php else : ?>
                                                        AMOUNT
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    AMOUNT
                                                <?php endif; ?>
                                            </h6>
                                            <h2 class="text-right">
                                                <?php if(isset($bill)) : ?>
                                                    <?php if(!$is_copy) : ?>
                                                        <?php if($bill->status === "1") : ?>
                                                            <span class="transaction-total-amount">
                                                            <?php
                                                                $amount = '$'.number_format(floatval($bill->remaining_balance), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                            ?>
                                                            </span>
                                                        <?php else : ?>
                                                            PAID
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <span class="transaction-total-amount">
                                                            <?php
                                                                $amount = '$'.number_format(floatval($bill->remaining_balance), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                            ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <span class="transaction-total-amount">
                                                        <?php 
                                                            if(isset($purchaseOrder)) {
                                                                $amount = '$'.number_format(floatval($purchaseOrder->total_amount), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                            } else {
                                                                echo "$0.00";
                                                            }
                                                        ?>
                                                    </span>
                                                <?php endif; ?>
                                            </h2>
                                            <?php if(isset($bill)) : ?>
                                                <?php if(!$is_copy) : ?>
                                                    <?php if($bill->status === "1") : ?>
                                                        <div class="d-flex justify-content-end">
                                                            <button class="btn btn-secondary mr-3" type="button">
                                                                Schedule online payment
                                                            </button>
                                                            <button class="btn btn-transparent" type="button">
                                                                Mark as paid
                                                            </button>                                                    
                                                        </div>
                                                        <?php if(count($bill_payments) > 0) : ?>
                                                        <div class="btn-group dropleft d-inline-block float-right">
                                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn text-info p-0">
                                                                <?=count($bill_payments)?> payment made (<?=$total_payment?>)
                                                            </button>
                                                            <div class="dropdown-menu p-3" id="payments-dropdown" style="min-width: 275px">
                                                                <table class="table bg-white m-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Date</th>
                                                                            <th>Amount applied</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach($bill_payments as $payment) : ?>
                                                                            <?php $paymentDetails = $this->vendors_model->get_bill_payment_item_by_bill_id($payment->id, $bill->id); ?>
                                                                            <tr>
                                                                                <td><a href="#" class="text-info"><?=date("m/d/Y", strtotime($payment->payment_date))?></a></td>
                                                                                <td class="text-right">$<?=number_format(floatval($paymentDetails->total_amount), 2, '.', ',')?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if($is_copy) : ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <h6 class="mt-0">This is a copy</h6>
                                                <span>This is a copy of an expense. Revise as needed and save the expense.</span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="mailing_address">Mailing address</label>
                                                <textarea name="mailing_address" id="mailing_address" class="form-control"><?=isset($purchaseOrder) || isset($bill) ? (isset($bill) && !isset($purchaseOrder)) ? str_replace("<br />", "", $bill->mailing_address) : str_replace("<br />", "", $purchaseOrder->mailing_address) : ""?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="term">Terms</label>
                                                <select name="term" id="term" class="form-control">
                                                    <?php if(isset($bill)) : ?>
                                                        <?php if($bill->term_id !== null && $bill->term_id !== "") : ?>
                                                            <option value="<?=$term->id?>"><?=$term->name?></option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bill_date">Bill date</label>
                                                <input type="text" name="bill_date" id="bill_date" class="form-control date" value="<?=isset($bill) ? date("m/d/Y", strtotime($bill->bill_date)) : date("m/d/Y")?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="due_date">Due date</label>
                                                <input type="text" name="due_date" id="due_date" class="form-control date" value="<?=$due_date?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" style="margin: 0 !important">
                                                <label for="bill_no">Bill no.</label>
                                                <input type="text" name="bill_no" id="bill_no" class="form-control" <?=isset($bill) ? "value='$bill->bill_no'" : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="permit_number">Permit no.</label>
                                                <input type="number" class="form-control" name="permit_number" id="permit_number" <?=isset($bill) ? "value='$bill->permit_no'" : ''?>> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div id="label">
                                                    <label for="tags">Tags</label>
                                                    <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                                </div>
                                                <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                                    <?php if(isset($purchaseOrder)) : ?>
                                                        <?php if($purchaseOrder->tags !== null && $purchaseOrder->tags !== "") : ?>
                                                            <?php foreach(json_decode($purchaseOrder->tags, true) as $tagId) : ?>
                                                                <?php 
                                                                    $tag = $this->tags_model->getTagById($tagId);
                                                                    $name = $tag->name;
                                                                    if($tag->group_tag_id !== null) {
                                                                        $group = $this->tags_model->getGroupById($tag->group_tag_id);
                                                                        $name = $group->name.': '.$tag->name;
                                                                    }
                                                                ?>
                                                                <option value="<?=$tag->id?>" selected><?=$name?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    <?php elseif(isset($bill)) : ?>
                                                        <?php if($bill->tags !== null && $bill->tags !== "") : ?>
                                                            <?php foreach(json_decode($bill->tags, true) as $tagId) : ?>
                                                                <?php 
                                                                    $tag = $this->tags_model->getTagById($tagId);
                                                                    $name = $tag->name;
                                                                    if($tag->group_tag_id !== null) {
                                                                        $group = $this->tags_model->getGroupById($tag->group_tag_id);
                                                                        $name = $group->name.': '.$tag->name;
                                                                    }
                                                                ?>
                                                                <option value="<?=$tag->id?>" selected><?=$name?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="category-details">
                                                <button class="btn" type="button" data-toggle="collapse" data-target="#category-details" aria-expanded="true" aria-controls="category-details">
                                                    <i class="fa fa-caret-down"></i> Category details
                                                </button>
                                                <div class="collapse show" id="category-details">
                                                    <div class="category-details-table-container w-100">
                                                        <div class="category-details-table">
                                                            <table class="table table-bordered table-hover clickable" id="category-details-table">
                                                                <thead>
                                                                    <th></th>
                                                                    <th class="text-right">#</th>
                                                                    <th width="15%">EXPENSE NAME</th>
                                                                    <th width="10%">CATEGORY</th>
                                                                    <th>DESCRIPTION</th>
                                                                    <th width="10%">AMOUNT</th>
                                                                    <th width="3%">BILLABLE</th>
                                                                    <th width="10%">MARKUP %</th>
                                                                    <th width="3%">TAX</th>
                                                                    <th width="15%">CUSTOMER</th>
                                                                    <?php if(isset($purchaseOrder)) : ?>
                                                                        <th></th>
                                                                    <?php endif; ?>
                                                                    <th></th>
                                                                </thead>
                                                                <tbody class="cursor-pointer">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td>
                                                                            <select name="expense_account[]" class="form-control" required></select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="category[]" class="form-control">
                                                                                <option disabled selected>&nbsp;</option>
                                                                                <option value="fixed">Fixed Cost</option>
                                                                                <option value="variable">Variable Cost</option>
                                                                                <option value="periodic">Periodic Cost</option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="description[]" class="form-control"></td>
                                                                        <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01"></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <input type="checkbox" name="category_billable[]" class="form-check" value="1">
                                                                            </div>
                                                                        </td>
                                                                        <td><input type="number" name="category_markup[]" class="form-control" onchange="convertToDecimal(this)"></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <input type="checkbox" name="category_tax[]" class="form-check" value="1">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <select name="category_customer[]" class="form-control"></select>
                                                                        </td>
                                                                        <?php if(isset($purchaseOrder)) : ?>
                                                                            <td></td>
                                                                        <?php endif; ?>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                    <?php $count = 1; ?>
                                                                    <?php if(isset($categories) && count($categories) > 0) : ?>
                                                                    <?php foreach($categories as $category) : ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><?=$count?></td>
                                                                        <td>
                                                                            <select name="expense_account[]" class="form-control" required>
                                                                                <option value="<?=$category->expense_account_id?>"><?=$this->chart_of_accounts_model->getName($category->expense_account_id)?></option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="category[]" class="form-control">
                                                                                <option disabled selected>&nbsp;</option>
                                                                                <option value="fixed" <?=$category->category === 'fixed' ? 'selected' : ''?>>Fixed Cost</option>
                                                                                <option value="variable" <?=$category->category === 'variable' ? 'selected' : ''?>>Variable Cost</option>
                                                                                <option value="periodic" <?=$category->category === 'periodic' ? 'selected' : ''?>>Periodic Cost</option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="description[]" class="form-control" value="<?=$category->description?>"></td>
                                                                        <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($category->amount), 2, '.', ',')?>"></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <input type="checkbox" name="category_billable[]" class="form-check" value="1" <?=$category->billable === "1" ? 'checked' : ''?>>
                                                                            </div>
                                                                        </td>
                                                                        <td><input type="number" name="category_markup[]" class="form-control" onchange="convertToDecimal(this)" value="<?=number_format(floatval($category->markup_percentage), 2, '.', ',')?>"></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <input type="checkbox" name="category_tax[]" class="form-check" value="1" <?=$category->tax === "1" ? 'checked' : ''?>>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <select name="category_customer[]" class="form-control">
                                                                                <?php if($category->customer_id !== null && $category->customer_id !== "") : ?>
                                                                                <option value="<?=$category->customer_id?>">
                                                                                    <?php $customer = $this->accounting_customers_model->get_by_id($category->customer_id); ?>
                                                                                    <?=$customer->first_name . ' ' . $customer->last_name?>
                                                                                </option>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </td>
                                                                        <?php if(isset($purchaseOrder)) : ?>
                                                                            <td>
                                                                                <div class="d-flex justify-content-center">
                                                                                    <a href="#"><i class="fa fa-link"></i></a>
                                                                                </div>
                                                                            </td>
                                                                        <?php endif; ?>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                    <?php $count++; endforeach; ?>
                                                                    <?php endif; ?>
                                                                    <?php do {?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><?=$count?></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <?php if(isset($purchaseOrder)) : ?>
                                                                            <td></td>
                                                                        <?php endif; ?>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                    <?php $count++; } while ($count <= 2) ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>2</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <?php if(isset($purchaseOrder)) : ?>
                                                                            <td></td>
                                                                        <?php endif; ?>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-footer">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#category-details-table" onclick="addTableLines(event)">Add lines</button>
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#category-details-table" onclick="clearTableLines(event)">Clear all lines</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-details">
                                                <button class="btn<?=isset($items) && count($items) > 0 ? '' : ' collapsed'?>" type="button" data-toggle="collapse" data-target="#item-details" aria-expanded="<?=isset($items) && count($items) > 0 ? 'true' : 'false'?>" aria-controls="item-details">
                                                    <i class="fa fa-caret-<?=isset($items) && count($items) > 0 ? 'down' : 'right'?>"></i> Item details
                                                </button>
                                                <div class="collapse <?=isset($items) && count($items) > 0 ? 'show' : ''?>" id="item-details">
                                                    <div class="item-details-table-container w-100">
                                                        <div class="item-details-table">
                                                            <table class="table table-bordered table-hover clickable" id="item-details-table">
                                                                <thead>
                                                                    <th width="20%">PRODUCT/SERVICE</th>
                                                                    <th>TYPE</th>
                                                                    <th width="10%">LOCATION</th>
                                                                    <th width="10%">QUANTITY</th>
                                                                    <th width="10%">PRICE</th>
                                                                    <th width="10%">DISCOUNT</th>
                                                                    <th width="10%">TAX (CHANGE IN %)</th>
                                                                    <th>TOTAL</th>
                                                                    <?php if(isset($purchaseOrder)) : ?>
                                                                        <th></th>
                                                                    <?php endif; ?>
                                                                    <th width="3%"></th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if(isset($items) && count($items) > 0) : ?>
                                                                    <?php foreach($items as $item) : ?>
                                                                        <?php $itemDetails = $this->items_model->getItemById($item->item_id)[0];?>
                                                                        <?php $locations = $this->items_model->getLocationByItemId($item->item_id);?>
                                                                        <tr>
                                                                            <td><?=$itemDetails->title?><input type="hidden" name="item[]" value="<?=$item->item_id?>"></td>
                                                                            <td>Product</td>
                                                                            <td>
                                                                                <select name="location[]" class="form-control" required>
                                                                                    <?php foreach($locations as $location) : ?>
                                                                                        <option value="<?=$location['id']?>" data-quantity="<?=$location['qty'] === null ? 0 : $location['qty']?>" <?=$item->location_id === $location['id'] ? 'selected' : ''?>><?=$location['name']?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="number" name="quantity[]" class="form-control text-right" required value="<?=$item->quantity?>" max="<?=$locations[0]['qty']?>"></td>
                                                                            <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->rate), 2, '.', ',')?>"></td>
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
                                                                            <?php if(isset($purchaseOrder)) : ?>
                                                                                <td>
                                                                                    <div class="d-flex justify-content-center">
                                                                                        <a href="#"><i class="fa fa-link"></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            <?php endif; ?>
                                                                            <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-footer">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a class="link-modal-open" href="#" id="add_another_items" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="memo">Memo</label>
                                                        <textarea name="memo" id="memo" class="form-control"><?=isset($purchaseOrder) || isset($bill) ? (isset($bill)) ? str_replace("<br />", "", $bill->memo) : str_replace("<br />", "", $purchaseOrder->memo) : ''?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="bill-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="m-0 text-right">Total : <span class="transaction-total-amount">$0.00</span></h5>
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
                        <div class="col-md-4 d-flex">
                            <a href="#" class="text-white m-auto">Make Recurring</a>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" id="save-and-schedule-payment">
                                    Save and schedule payment
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="save-and-close">Save and close</a>
                                    <a class="dropdown-item" href="#" id="save-and-new">Save and new</a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary btn-rounded border float-right mr-2" id="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>