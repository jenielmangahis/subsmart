<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($charge)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/delayed-charge/<?=$charge->id?>">
<?php endif; ?>
    <div id="delayedChargeModal" class="modal fade modal-fluid" role="dialog">
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
                                    <h5 class="dropdown-header">Recent Delayed Charges</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-delayed-charges">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Delayed Charge <span></span>
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
                                                            <?php if(isset($charge)) : ?>
                                                                <option value="<?=$charge->customer_id?>">
                                                                <?php
                                                                    $customer = $this->accounting_customers_model->get_by_id($charge->customer_id);
                                                                    echo $customer->first_name . ' ' . $customer->last_name;
                                                                ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                                AMOUNT
                                            </h6>
                                            <h2 class="text-right">
                                                <span class="transaction-grand-total">
                                                <?php if(isset($charge)) : ?>
                                                    <?php
                                                    $amount = '$'.number_format(floatval($charge->total_amount), 2, '.', ',');
                                                    $amount = str_replace('$-', '-$', $amount);
                                                    echo $amount;
                                                    ?>
                                                <?php else : ?>
                                                    $0.00
                                                <?php endif; ?>
                                                </span>
                                            </h2>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="delayed-charge-date">Delayed Charge date</label>
                                                <input type="text" name="delayed_charge_date" id="delayed-charge-date" class="form-control date" value="<?=isset($charge) ? date("m/d/Y", strtotime($charge->delayed_charge_date)) : date("m/d/Y")?>">
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
                                        <div class="col-md-12">
                                            <div class="delayed-charge-item-table-container w-100">
                                                <div class="delayed-charge-item-table">
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
                                                <div class="delayed-charge-item-table-footer">
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
                                                        <label for="memo">Memo</label>
                                                        <textarea name="memo" id="memo" class="form-control"><?=isset($charge) ? str_replace("<br />", "", $charge->memo) : ''?></textarea>
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
                                                            <?php if(isset($charge)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($charge->subtotal), 2, '.', ',');
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
                                                            <?php if(isset($charge)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($charge->tax_total), 2, '.', ',');
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
                                                            <?php if(isset($charge)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($charge->discount_total), 2, '.', ',');
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
                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control w-50 mr-2" value="<?=isset($charge) ? $charge->adjustment_name : ''?>">
                                                            <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control adjustment_input_cm_c w-25 mr-2" onchange="convertToDecimal(this)" value="<?=isset($charge) ? number_format(floatval($charge->adjustment_value), 2, '.', ',') : ''?>">
                                                            <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="transaction-adjustment">
                                                            <?php if(isset($charge)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($charge->adjustment_value), 2, '.', ',');
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
                                                            <?php if(isset($charge)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($charge->total_amount), 2, '.', ',');
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
                        <div class="col-md-4 <?=!isset($charge) ? 'd-flex' : ''?>">
                            <?php if(!isset($charge)) : ?>
                            <a href="#" class="text-white m-auto" onclick="makeRecurring('delayed_charge')">Make Recurring</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <a href="#" class="text-white" onclick="makeRecurring('delayed_charge')">Make Recurring</a>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-delayed-charge">Copy</a>
                                                <a class="dropdown-item" href="#" id="delete-delayed-charge">Delete</a>
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
                                <button type="button" class="btn btn-success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
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