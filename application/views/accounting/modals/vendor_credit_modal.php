<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($vendorCredit)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/vendor-credit/<?=$vendorCredit->id?>">
<?php endif; ?>
    <div id="vendorCreditModal" class="modal fade modal-fluid" role="dialog">
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
                                    <h5 class="dropdown-header">Recent Vendor Credits</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-vendor-credits">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Vendor Credit <span><?=isset($vendorCredit) ? "#$vendorCredit->ref_no" : ''?></span>
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
                                    <div class="row payee-details">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="vendor">Vendor</label>
                                                        <select name="vendor_id" id="vendor" class="form-control" required>
                                                            <?php if(isset($vendorCredit)) : ?>
                                                            <option value="<?=$vendorCredit->vendor_id?>">
                                                                <?php $vendor = $this->vendors_model->get_vendor_by_id($vendorCredit->vendor_id); ?>
                                                                <?=$vendor->display_name?>
                                                            </option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">AMOUNT</h6>
                                            <h2 class="text-right">
                                                <span class="transaction-total-amount">
                                                    <?php if(isset($vendorCredit)) : ?>
                                                        <?php
                                                            $amount = '$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ',');
                                                            $amount = str_replace('$-', '-$', $amount);
                                                            echo $amount;
                                                        ?>
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
                                                <span>This is a copy of a vendor credit. Revise as needed and save the vendor credit.</span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="mailing_address">Mailing address</label>
                                                <textarea name="mailing_address" id="mailing_address" class="form-control"><?=isset($vendorCredit) ? str_replace("<br />", "", $vendorCredit->mailing_address) : ''?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="payment_date">Payment date</label>
                                                <input type="text" name="payment_date" id="payment_date" class="form-control date" value="<?=isset($vendorCredit) ? ($vendorCredit->payment_date !== "" && !is_null($vendorCredit->payment_date) ? date("m/d/Y", strtotime($vendorCredit->payment_date)) : "") : date("m/d/Y")?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <div class="form-group" style="margin: 0 !important">
                                                <label for="ref_no">Ref no.</label>
                                                <input type="text" name="ref_no" id="ref_no" class="form-control" <?=isset($vendorCredit) ? "value='$vendorCredit->ref_no'" : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="permit_number">Permit no.</label>
                                                <input type="number" class="form-control" name="permit_number" id="permit_number" <?=isset($vendorCredit) ? "value='$vendorCredit->permit_no'" : ''?>> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
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
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
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
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
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
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
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
                                                                                <td>
                                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                                        <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                                    </div>
                                                                                </td>
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
                                                        <textarea name="memo" id="memo" class="form-control"><?=isset($vendorCredit) ? str_replace("<br />", "", $vendorCredit->memo) : ''?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="vendor-credit-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                            <?php if(isset($vendorCredit)) : ?>
                                                <h5 class="m-0 text-right">
                                                    <span class="transaction-total-amount">
                                                        <?php
                                                            $amount = '$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ',');
                                                            $amount = str_replace('$-', '-$', $amount);
                                                            echo $amount;
                                                        ?>
                                                    </span>
                                                </h5>
                                            <?php else : ?>
                                                <h5 class="m-0 text-right">Total : <span class="transaction-total-amount">$0.00</span></h5>
                                            <?php endif; ?>
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
                        <div class="col-md-4 <?=!isset($vendorCredit) ? 'd-flex' : ''?>">
                            <?php if(!isset($vendorCredit)) : ?>
                            <a href="#" class="text-white m-auto" onclick="makeRecurring('vendor_credit')">Make Recurring</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" onclick="makeRecurring('vendor_credit')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-vendor-credit">Copy</a>
                                                <a class="dropdown-item" href="#" id="delete-vendor-credit">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" onclick="saveAndNewForm(event)">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
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