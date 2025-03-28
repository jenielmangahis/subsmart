<!-- Modal for bank deposit-->
 <style>
#delayedCreditModal .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
#delayedCreditModal .modal-body{
    overflow-x:hidden;
}
#delayedCreditModal #item-table td:nth-child(8){
 text-align:right !important;
}
 </style>
<div class="full-screen-modal">
<?php if(!isset($credit)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="<?php echo base_url(); ?>accounting/update-transaction/delayed-credit/<?=$credit->id?>">
<?php endif; ?>
    <div id="delayedCreditModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Delayed Credits</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-delayed-credits">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Delayed Credit <span></span>
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row customer-details">
                                <?php if(isset($invoice)) : ?>
                                <div class="col-12">
                                    <div class="dropdown">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">
                                            Linked Invoice
                                        </a>
                                        <div class="dropdown-menu">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Invoice date">Invoice date</td>
                                                        <td data-name="Invoice no.">Invoice no.</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="<?=$invoice->id?>" data-type="invoice"><?=date("m/d/Y", strtotime($invoice->date_issued))?></a></td>
                                                        <td><?=str_replace($invoiceSetting->invoice_num_prefix, '', $invoice->invoice_number)?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-8 grid-mb">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <label for="customer">Customer</label>
                                            <div id="open-customer-info-window-container" style='display:none; float:right;'><span class="float-end"><a href="javascript:void(0)" class="nsm-button btn-small open-customer-info-window" style="margin-bottom:3px;display:inline-block;" id="open-customer-info-window">View Customer Info</a></span></div>
                                            <select name="customer" id="customer" class="form-control nsm-field" required>
                                                <?php if(isset($credit)) : ?>
                                                    <option value="<?=$credit->customer_id?>">
                                                    <?php
                                                        $customer = $this->accounting_customers_model->get_by_id($credit->customer_id);
                                                        echo $customer->first_name . ' ' . $customer->last_name;
                                                    ?>
                                                    </option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6>
                                        AMOUNT
                                    </h6>
                                    <h2>
                                        <span class="transaction-grand-total">
                                        <?php if(isset($credit)) : ?>
                                            <?php
                                            $amount = '$'.number_format(floatval($credit->total_amount), 2, '.', ',');
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
                                <div class="col-12">
                                    <div class="nsm-callout primary">
                                        <button><i class='bx bx-x'></i></button>
                                        <h6 class="mt-0">This is a copy</h6>
                                        <span>This is a copy of a delayed credit. Revise as needed and save the delayed credit.</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-2">
                                    <label for="delayed-credit-date">Delayed Credit date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="delayed_credit_date" id="delayed-credit-date" class="form-control nsm-field mb-2 date" value="<?=isset($credit) ? date("m/d/Y", strtotime($credit->delayed_credit_date)) : date("m/d/Y")?>">
                                    </div>

                                    <label for="tags">Tags</label>
                                    <span class="float-end"><a href="#" class="text-decoration-none" id="open-tags-modal">Manage tags</a></span>
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
                                <div class="col-12 col-md-4">
                                    <label for="memo">Memo</label>
                                    <textarea name="memo" id="memo" style="height:98px !important;" class="form-control nsm-field mb-2"><?=isset($credit) ? str_replace("<br />", "", $credit->memo) : ''?></textarea>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12 grid-mb">
                                    <table class="nsm-table" id="item-table">
                                        <thead>
                                            <td data-name="Item" style="width:28%;">ITEM</td>
                                            <td data-name="Type">TYPE</td>
                                            <td data-name="Location">LOCATION</td>
                                            <td data-name="Quantity" style="width:8%; text-align: center;">QUANTITY</td>
                                            <td data-name="Price" style="width:8%; text-align: center;">PRICE</td>
                                            <td data-name="Discount" style="width:8%; text-align: center;">DISCOUNT</td>
                                            <td data-name="Tax" style="width:10%; text-align: center;">TAX (CHANGE IN %)</td>
                                            <td data-name="Total" style="width:8%; text-align:right;">TOTAL</td>
                                            <td data-name="Manage" style="width:5%;"></td>
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

                            <div class="row mt-5">
                                <div class="col-12 col-md-6">                                    
                                    <div class="attachments">
                                        <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                        <span>Maximum size: 20MB</span>
                                        <div id="delayed-credit-attachments" class="dropzone justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                                <td>Subtotal</td>
                                                <td>
                                                    <span class="transaction-subtotal">
                                                    <?php if(isset($credit)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($credit->subtotal), 2, '.', ',');
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
                                                    <?php if(isset($credit)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($credit->tax_total), 2, '.', ',');
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
                                                    <?php if(isset($credit)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($credit->discount_total), 2, '.', ',');
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
                                                    <div class="row" style="float: right;">
                                                        <div class="col-10">
                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control nsm-field" value="<?= isset($credit) ? $credit->adjustment_name : '' ?>">
                                                        </div>
                                                        <div class="col-1 d-flex align-items-center" style="padding-left: 0 !important;">
                                                            <span id="modal-help-popover-adjustment" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input style="float: right; width: 75px;text-align:right;padding-right:1px !important;" type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control nsm-field adjustment_input_cm_c" onchange="convertToDecimal(this)" value="<?= isset($credit) ? number_format(floatval($credit->adjustment_value), 2, '.', ',') : '' ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Grand Total ($)</td>
                                                <td>
                                                    <span class="transaction-grand-total">
                                                    <?php if(isset($credit)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($credit->total_amount), 2, '.', ',');
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
                        <div class="col-md-4 <?=!isset($credit) ? 'd-flex' : ''?>">
                            <?php if(!isset($credit)) : ?>
                            <a href="#" class="text-dark text-decoration-none m-auto" onclick="makeRecurring('delayed_credit')">Make Recurring</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('delayed_credit')">Make Recurring</a>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-delayed-credit">Copy</a>
                                                <a class="dropdown-item" href="#" id="delete-delayed-credit">Delete</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <?php endif; ?>
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
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
        }
    });
});
</script>