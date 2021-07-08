<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/vendors/<?=$check->payee_id?>/update-transaction/check/<?=$check->id?>">
    <div id="checkModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title"><a href="#"><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>Check <span>#<?=$check->to_print === "1" ? 'To print' : $check->check_no?></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="payee">Payee</label>
                                                        <select name="payee" id="payee" class="form-control">
                                                            <option value="" disabled selected>&nbsp;</option>
                                                            <?php if(count($dropdown['vendors']) > 0) : ?>
                                                            <optgroup label="Vendors">
                                                            <?php foreach($dropdown['vendors'] as $vendor) : ?>
                                                                <option value="vendor-<?=$vendor->id?>" <?=$check->payee_type === 'vendor' && $check->payee_id === $vendor->id ? 'selected' : ''?>><?=$vendor->display_name?></option>
                                                            <?php endforeach; ?>
                                                            </optgroup>
                                                            <?php endif; ?>
                                                            <?php if(count($dropdown['customers']) > 0) : ?>
                                                            <optgroup label="Customers">
                                                            <?php foreach($dropdown['customers'] as $customer) : ?>
                                                                <option value="customer-<?=$customer->prof_id?>" <?=$check->payee_type === 'customer' && $check->payee_id === $customer->prof_id ? 'selected' : ''?>><?=$customer->first_name . ' ' . $customer->last_name?></option>
                                                            <?php endforeach; ?>
                                                            </optgroup>
                                                            <?php endif; ?>
                                                            <?php if(count($dropdown['employees']) > 0) : ?>
                                                            <optgroup label="Employees">
                                                            <?php foreach($dropdown['employees'] as $employee) : ?>
                                                                <option value="employee-<?=$employee->id?>" <?=$check->payee_type === 'employee' && $check->payee_id === $employee->id ? 'selected' : ''?>><?=$employee->FName . ' ' . $employee->LName?></option>
                                                            <?php endforeach; ?>
                                                            </optgroup>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bank_account">Bank account</label>
                                                        <select name="bank_account" id="bank_account" class="form-control" required>
                                                            <?php foreach($dropdown['bank_accounts'] as $account) : ?>
                                                                <option value="<?=$account->id?>" <?=$check->bank_account_id === $account->id ? 'selected' : ''?>><?=$account->name?></option>

                                                                <?php if(count($account->childAccs) > 0) : ?>
                                                                    <optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                        <?php foreach($account->childAccs as $childAcc) : ?>
                                                                            <option value="<?=$childAcc->id?>" <?=$check->bank_account_id === $childAcc->id ? 'selected' : ''?>>&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                        <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d-flex ">
                                                    <p style="align-self: flex-end; margin-bottom: 30px">Balance <span id="account-balance"><?= $balance ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right"><?=$check->status === "4" ? "PAYMENT STATUS" : "AMOUNT" ?></h6>
                                            <h2 class="text-right">
                                            <?php if($check->status === "4") : ?>
                                                VOID
                                            <?php else : ?>
                                                $<span class="transaction-total-amount"><?=number_format(floatval($check->total_amount), 2, '.', ',')?></span>
                                            <?php endif; ?>
                                            </h2>
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
                                                <textarea name="mailing_address" id="mailing_address" class="form-control"><?=str_replace("<br />", "", $check->mailing_address)?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="payment_date">Payment date</label>
                                                <input type="text" name="payment_date" id="payment_date" class="form-control date" value="<?=date("m/d/Y", strtotime($check->payment_date))?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="check_no">Check no.</label>
                                                <input type="text" name="check_no" id="check_no" class="form-control" value="<?=$check->to_print === "1" ? 'To print' : $check->check_no?>" <?=$check->to_print === "1" ? 'disabled' : ''?>>
                                                <div class="form-check">
                                                    <input type="checkbox" name="print_later" id="print_later" class="form-check-input" value="1" <?=$check->to_print === "1" ? 'checked' : ''?>>
                                                    <label for="print_later" class="form-check-label">Print later</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div id="label">
                                                    <label for="tags">Tags</label>
                                                    <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                                </div>
                                                <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                                    <?php if($check->tags !== null && $check->tags !== "") : ?>
                                                        <?php foreach(json_decode($check->tags, true) as $tagId) : ?>
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
                                                                            <select name="expense_name[]" class="form-control" required>
                                                                                <option value="" selected disabled>&nbsp;</option>
                                                                                <?php foreach($dropdown['categories'] as $accType => $accounts) : ?>
                                                                                    <optgroup label="<?=$accType?>">
                                                                                        <?php foreach($accounts as $account) : ?>
                                                                                            <option value="<?=$account->id?>"><?=$account->name?></option>

                                                                                            <?php if(count($account->childAccs) > 0) : ?>
                                                                                                <optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                                                    <?php foreach($account->childAccs as $childAcc) : ?>
                                                                                                        <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                                                    <?php endforeach; ?>
                                                                                                </optgroup>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </optgroup>
                                                                                <?php endforeach; ?>
                                                                            </select>
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
                                                                            <select name="category_customer[]" class="form-control">
                                                                                <option value="" selected disabled>&nbsp;</option>
                                                                                <?php if(count($dropdown['customers']) > 0) : ?>
                                                                                    <?php foreach($dropdown['customers'] as $customer) :?>
                                                                                        <option value="<?=$customer->prof_id?>"><?=$customer->first_name . ' ' . $customer->last_name?></option>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </td>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                    <?php $count = 1; ?>
                                                                    <?php if(count($categories) > 0) : ?>
                                                                    <?php foreach($categories as $category) : ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><?=$count?></td>
                                                                        <td>
                                                                            <select name="expense_name[]" class="form-control" required>
                                                                                <option value="" selected disabled>&nbsp;</option>
                                                                                <?php foreach($dropdown['categories'] as $accType => $accounts) : ?>
                                                                                    <optgroup label="<?=$accType?>">
                                                                                        <?php foreach($accounts as $account) : ?>
                                                                                            <option value="<?=$account->id?>" <?=$category->expense_account_id === $account->id ? 'selected' : ''?>><?=$account->name?></option>

                                                                                            <?php if(count($account->childAccs) > 0) : ?>
                                                                                                <optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                                                    <?php foreach($account->childAccs as $childAcc) : ?>
                                                                                                        <option value="<?=$childAcc->id?>" <?=$category->expense_account_id === $childAcc->id ? 'selected' : ''?>>&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                                                    <?php endforeach; ?>
                                                                                                </optgroup>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </optgroup>
                                                                                <?php endforeach; ?>
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
                                                                                <option value="" selected disabled>&nbsp;</option>
                                                                                <?php if(count($dropdown['customers']) > 0) : ?>
                                                                                    <?php foreach($dropdown['customers'] as $customer) :?>
                                                                                        <option value="<?=$customer->prof_id?>" <?=$category->customer_id === $customer->prof_id ? 'selected' : ''?>><?=$customer->first_name . ' ' . $customer->last_name?></option>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </td>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                    <?php $count++; endforeach; ?>
                                                                    <?php endif; ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><?=$count === 1 ? $count+1 : $count?></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
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
                                                <button class="btn<?=count($items) > 0 ? '' : ' collapsed'?>" type="button" data-toggle="collapse" data-target="#item-details" aria-expanded="<?=count($items) > 0 ? 'true' : 'false'?>" aria-controls="item-details">
                                                    <i class="fa fa-caret-<?=count($items) > 0 ? 'down' : 'right'?>"></i> Item details
                                                </button>
                                                <div class="collapse <?=count($items) > 0 ? 'show' : ''?>" id="item-details">
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
                                                                            <td>$<span class="row-total"><?=number_format(floatval($item->total), 2, '.', ',')?></span></td>
                                                                            <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
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
                                                        <textarea name="memo" id="memo" class="form-control"><?=$check->memo?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="check-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                            <h5 class="m-0 text-right">Total : $<span class="expense-total"><?=number_format(floatval($check->total_amount), 2, '.', ',')?></span></h5>
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
                                <button type="submit" class="btn btn-success">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and close</a>
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