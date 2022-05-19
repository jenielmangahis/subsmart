<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($expense)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/expense/<?=$expense->id?>">
<?php endif; ?>
    <div id="expenseModal" class="modal fade modal-fluid" role="dialog">
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
                                    <h5 class="dropdown-header">Recent Expenses</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-expenses">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Expense <span><?=isset($expense) && !is_null($expense->ref_no) && $expense->ref_no !== '' ? '#'.$expense->ref_no : ''?></span>
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
                                        <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                        <div class="col-md-12">
                                            <a href="#" class="float-right btn btn-transparent rounded-0 open-transactions-container" style="padding:12px 15px !important">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>

                                            <div class="dropdown">
                                                <a href="#" class="text-info" id="linked-transaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php if(count($expense->linked_transacs) > 1) : ?>
                                                        <?=count($expense->linked_transacs)?> linked Purchase Orders
                                                    <?php else : ?>
                                                        1 linked Purchase Order
                                                    <?php endif; ?>
                                                </a>
                                                <div class="dropdown-menu p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                                    <div class="row">
                                                        <div class="col-3"><strong>Type</strong></div>
                                                        <div class="col-3"><strong>Date</strong></div>
                                                        <div class="col-3"><strong>Amount</strong></div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                    <?php foreach($expense->linked_transacs as $linkedTransac) : ?>
                                                    <div class="row my-1">
                                                        <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="<?=$linkedTransac['transaction']->id?>" data-type="purchase-order">Purchase Order</a></div>
                                                        <div class="col-3 d-flex align-items-center"><?=date("m/d/Y", strtotime($linkedTransac['transaction']->purchase_order_date))?></div>
                                                        <div class="col-3 d-flex align-items-center">
                                                            <?php
                                                            $transacAmount = $linkedTransac['transaction']->total_amount;
                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                            echo str_replace('$-', '-$', $transacAmount);
                                                            ?>
                                                        </div>
                                                        <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" data-type="purchase-order" data-id="<?=$linkedTransac['transaction']->id?>" style="font-size: 13px !important">Remove</button></div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                            <?php foreach($expense->linked_transacs as $linkedTransac) : ?>
                                                <input type="hidden" value="purchase_order-<?=$linkedTransac['transaction']->id?>" name="linked_transaction[]">
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="payee">Payee</label>
                                                        <select name="payee" id="payee" class="form-control">
                                                            <?php if(isset($expense)) : ?>
                                                                <option value="<?=$expense->payee_type.'-'.$expense->payee_id?>">
                                                                <?php
                                                                    switch($expense->payee_type) {
                                                                        case 'vendor' :
                                                                            $vendor = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                                                                            echo $vendor->display_name;
                                                                        break;
                                                                        case 'customer' :
                                                                            $customer = $this->accounting_customers_model->get_by_id($expense->payee_id);
                                                                            echo $customer->first_name . ' ' . $customer->last_name;
                                                                        break;
                                                                        case 'employee' :
                                                                            $employee = $this->users_model->getUser($expense->payee_id);
                                                                            echo $employee->FName . ' ' . $employee->LName;
                                                                        break;
                                                                    }
                                                                ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="expense_payment_account">Payment account</label>
                                                        <select name="expense_payment_account" id="expense_payment_account" class="form-control" required>
                                                            <?php if(isset($expense)) : ?>
                                                                <option value="<?=$expense->payment_account_id?>"><?=$this->chart_of_accounts_model->getName($expense->payment_account_id)?></option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d-flex ">
                                                    <p style="align-self: flex-end; margin-bottom: 30px">Balance <span id="account-balance"><?= $balance ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                                <?php if(isset($expense)) : ?>
                                                    <?=$expense->status === "4" ? "PAYMENT STATUS" : "AMOUNT" ?>
                                                <?php else : ?>
                                                    AMOUNT
                                                <?php endif; ?>
                                            </h6>
                                            <h2 class="text-right">
                                                <?php if(isset($expense)) : ?>
                                                    <?php if($expense->status === "4") : ?>
                                                    VOID
                                                    <?php else : ?>
                                                        <span class="transaction-total-amount">
                                                            <?php
                                                                $amount = '$'.number_format(floatval($expense->total_amount), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                            ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <span class="transaction-total-amount">$0.00</span>
                                                <?php endif; ?>
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php if($is_copy) : ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <h6 class="mt-0">This is a copy</h6>
                                                <span>This is a copy of an expense. Revise as needed and save the expense.</span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_date">Payment date</label>
                                                <input type="text" name="payment_date" id="payment_date" class="form-control date" value="<?=isset($expense) ? ($expense->payment_date !== "" && !is_null($expense->payment_date) ? date("m/d/Y", strtotime($expense->payment_date)) : "") : date("m/d/Y")?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_method">Payment method</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <?php if(isset($expense)) : ?>
                                                        <option value="<?=$expense->payment_method_id?>"><?=$this->accounting_payment_methods_model->getById($expense->payment_method_id)->name?></option>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="ref_no">Ref no.</label>
                                                <input type="text" name="ref_no" id="ref_no" class="form-control" <?=isset($expense) ? "value='$expense->ref_no'" : ''?>>
                                            </div>
                                            <div class="form-group">
                                                <label for="permit_number">Permit no.</label>
                                                <input type="number" class="form-control" name="permit_number" id="permit_number" <?=isset($expense) ? "value='$expense->permit_no'" : ''?>> 
                                            </div>
                                        </div>
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
                                                                    <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                    <th width="3%"></th>
                                                                    <?php endif; ?>
                                                                    <th width="3%"></th>
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
                                                                                <option value="<?=$category->customer_id?>">
                                                                                    <?php $customer = $this->accounting_customers_model->get_by_id($category->customer_id); ?>
                                                                                    <?=$customer->first_name . ' ' . $customer->last_name?>
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                        <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                        <td>
                                                                        <?php if(!is_null($category->linked_transaction_type) && !is_null($category->linked_transaction_id)) : ?>
                                                                            <div class="dropdown">
                                                                                <a href="#" class="text-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-link"></i></a>
                                                                                <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                                                                    <div class="row">
                                                                                        <div class="col-3"><strong>Type</strong></div>
                                                                                        <div class="col-3"><strong>Date</strong></div>
                                                                                        <div class="col-3"><strong>Amount</strong></div>
                                                                                        <div class="col-3"></div>
                                                                                        <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="<?=$category->linked_transaction_id?>" data-type="purchase-order">Purchase Order</a></div>
                                                                                        <div class="col-3 d-flex align-items-center"><?=date("m/d/Y", strtotime($category->linked_transac->purchase_order_date))?></div>
                                                                                        <div class="col-3 d-flex align-items-center">
                                                                                            <?php
                                                                                            $transacAmount = $category->linked_transac->total_amount;
                                                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                            echo str_replace('$-', '-$', $transacAmount);
                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" data-type="purchase-order" data-id="<?=$category->linked_transaction_id?>" style="font-size: 13px !important">Remove</button></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="<?=$category->linked_transaction_type?>-<?=$category->linked_transaction_id?>" name="category_linked_transaction[]">
                                                                            <input type="hidden" value="<?=$category->linked_transaction_category_id?>" name="transaction_category_id[]">
                                                                        <?php endif; ?>
                                                                        </td>
                                                                        <?php endif; ?>
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
                                                                        <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                        <td></td>
                                                                        <?php endif; ?>
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
                                                <button class="btn <?=isset($items) && count($items) > 0 ? '' : ' collapsed'?>" type="button" data-toggle="collapse" data-target="#item-details" aria-expanded="<?=isset($items) && count($items) > 0 ? 'true' : 'false'?>" aria-controls="item-details">
                                                    <i class="fa fa-caret-<?=isset($items) && count($items) > 0 ? 'down' : 'right'?>"></i> Item details
                                                </button>
                                                <div class="collapse <?=isset($items) && count($items) > 0 ? 'show' : ''?>" id="item-details">
                                                    <div class="item-details-table-container w-100">
                                                        <div class="item-details-table">
                                                            <table class="table table-bordered table-hover" id="item-details-table">
                                                                <thead>
                                                                    <th width="20%">PRODUCT/SERVICE</th>
                                                                    <th>TYPE</th>
                                                                    <th width="10%">LOCATION</th>
                                                                    <th width="10%">QUANTITY</th>
                                                                    <th width="10%">PRICE</th>
                                                                    <th width="10%">DISCOUNT</th>
                                                                    <th width="10%">TAX (CHANGE IN %)</th>
                                                                    <th>TOTAL</th>
                                                                    <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                    <th width="3%"></th>
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
                                                                                <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                                <td>
                                                                                <?php if(!is_null($item->linked_transaction_type) && !is_null($item->linked_transaction_id)) : ?>
                                                                                    <div class="dropdown">
                                                                                        <a href="#" class="text-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-link"></i></a>
                                                                                        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                                                                            <div class="row">
                                                                                                <div class="col-3"><strong>Type</strong></div>
                                                                                                <div class="col-3"><strong>Date</strong></div>
                                                                                                <div class="col-3"><strong>Amount</strong></div>
                                                                                                <div class="col-3"></div>
                                                                                                <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="<?=$item->linked_transaction_id?>" data-type="purchase-order">Purchase Order</a></div>
                                                                                                <div class="col-3 d-flex align-items-center"><?=date("m/d/Y", strtotime($item->linked_transac->purchase_order_date))?></div>
                                                                                                <div class="col-3 d-flex align-items-center">
                                                                                                    <?php
                                                                                                    $transacAmount = $item->linked_transac->total_amount;
                                                                                                    $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                                    echo str_replace('$-', '-$', $transacAmount);
                                                                                                    ?>
                                                                                                </div>
                                                                                                <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" data-type="purchase-order" data-id="<?=$item->linked_transaction_id?>" style="font-size: 13px !important">Remove</button></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="hidden" value="<?=$item->linked_transaction_type?>-<?=$item->linked_transaction_id?>" name="item_linked_transaction[]">
                                                                                    <input type="hidden" value="<?=$item->linked_transaction_item_id?>" name="transaction_item_id[]">
                                                                                <?php endif; ?>
                                                                                </td>
                                                                                <?php endif; ?>
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
                                                        <div class="item-details-table-footer">
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
                                                        <textarea name="memo" id="memo" class="form-control"><?=isset($expense) ? str_replace("<br />", "", $expense->memo) : ''?></textarea>
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
                                            <?php if(isset($expense)) : ?>
                                                <h5 class="m-0 text-right">
                                                    <span class="transaction-total-amount">
                                                        <?php
                                                            $amount = '$'.number_format(floatval($expense->total_amount), 2, '.', ',');
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

                        <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                        <div class="col-xl-2" style="display: none">
                            <div class="transactions-container bg-white h-100" style="padding: 15px">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Add to Expense</h4>
                                    </div>
                                    <?php foreach($linkableTransactions as $linkableTransac) : ?>
                                    <?php
                                    $title = $linkableTransac['type'];
                                    $title .= $linkableTransac['number'] !== '' ? ' #' . $linkableTransac['number'] : '';
                                    ?>
                                    <div class="col-12">
                                        <div class="card border">
                                            <div class="card-body p-0">
                                                <h5 class="card-title"><?=$title?></h5>
                                                <p class="card-subtitle"><?=$linkableTransac['formatted_date']?></p>
                                                <p class="card-text">
                                                    <strong>Total</strong> <?=$linkableTransac['total']?>
                                                    <br><strong>Balance</strong> <?=$linkableTransac['balance']?>
                                                </p>
                                                <ul class="d-flex justify-content-around">
                                                    <li><a href="#" class="text-info add-transaction" data-id="<?=$linkableTransac['id']?>" data-type="purchase-order"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="text-info open-transaction" data-id="<?=$linkableTransac['id']?>" data-type="purchase-order">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4 <?=!isset($expense) ? 'd-flex' : ''?>">
                            <?php if(!isset($expense)) : ?>
                            <a href="#" class="text-white m-auto" onclick="makeRecurring('expense')">Make Recurring</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" onclick="makeRecurring('expense')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-expense">Copy</a>
                                                <?php if($expense->status !== "4") : ?>
                                                    <a class="dropdown-item" href="#" id="void-expense">Void</a>
                                                <?php endif; ?>
                                                <a class="dropdown-item" href="#" id="delete-expense">Delete</a>
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