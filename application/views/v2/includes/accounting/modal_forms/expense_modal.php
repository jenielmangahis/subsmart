<style>
#expenseModal .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
#expenseModal .modal-body{
    overflow-x:hidden;
}
</style>
<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($expense)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="<?php echo base_url(); ?>accounting/update-transaction/expense/<?=$expense->id?>">
<?php endif; ?>
    <div id="expenseModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Expenses</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-expenses">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Expense <span><?=isset($expense) && !is_null($expense->ref_no) && $expense->ref_no !== '' ? '#'.$expense->ref_no : ''?></span>
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row payee-details">
                                <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                <div class="col-12">
                                    <button class="nsm-button open-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-left"></i></button>

                                    <div class="dropdown">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">
                                            <?php if(count($expense->linked_transacs) > 1) : ?>
                                                <?=count($expense->linked_transacs)?> linked Purchase Orders
                                            <?php else : ?>
                                                1 linked Purchase Order
                                            <?php endif; ?>
                                        </a>
                                        <div class="dropdown-menu">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Type">Type</td>
                                                        <td data-name="Date">Date</td>
                                                        <td data-name="Amount">Amount</td>
                                                        <td data-name="Action"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($expense->linked_transacs as $linkedTransac) : ?>
                                                    <tr>
                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="<?=$linkedTransac['transaction']->id?>" data-type="purchase-order">Purchase Order</a></td>
                                                        <td><?=date("m/d/Y", strtotime($linkedTransac['transaction']->purchase_order_date))?></td>
                                                        <td>
                                                                <?php
                                                            $transacAmount = $linkedTransac['transaction']->total_amount;
                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                            echo str_replace('$-', '-$', $transacAmount);
                                                            ?>
                                                        </td>
                                                        <td><button type="button" class="nsm-button unlink-transaction" data-type="purchase-order" data-id="<?=$linkedTransac['transaction']->id?>">Remove</button></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <?php foreach($expense->linked_transacs as $linkedTransac) : ?>
                                        <input type="hidden" value="purchase_order-<?=$linkedTransac['transaction']->id?>" name="linked_transaction[]">
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-8 grid-mb">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="payee">Payee</label>
                                            <div id="open-payee-info-window-container" style='float:right;'>
                                                <a href="javascript:void(0)" class="nsm-button btn-small" style="margin-bottom:3px;display:inline-block;" id="open-payee-info-window">View Payee Info</a>
                                            </div>  
                                            <select name="payee" id="payee" class="form-control nsm-field">
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
                                        <div class="col-12 col-md-4">
                                            <label for="expense_payment_account">Payment account</label>
                                            <select name="expense_payment_account" id="expense_payment_account" class="form-control nsm-field" required>
                                                <?php if(isset($expense)) : ?>
                                                    <option value="<?=$expense->payment_account_id?>"><?=$this->chart_of_accounts_model->getName($expense->payment_account_id)?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="expense_payment_account">Balance</label>
                                            <input type="text"  class="form-control" id="expense_payment_balance" value="<?= $balance?>" readOnly>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6>
                                        <?php if(isset($expense)) : ?>
                                            <?=$expense->status === "4" ? "PAYMENT STATUS" : "AMOUNT" ?>
                                        <?php else : ?>
                                            AMOUNT
                                        <?php endif; ?>
                                    </h6>
                                    <h2>
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
                            <div class="col-md-8">
                                <div class="row">
                                    <?php if($is_copy) : ?>
                                    <div class="col-12">
                                        <div class="nsm-callout primary">
                                            <button><i class='bx bx-x'></i></button>
                                            <h6 class="mt-0">This is a copy</h6>
                                            <span>This is a copy of an expense. Revise as needed and save the expense.</span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4">
                                        <label for="payment_date">Payment date</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="payment_date" id="payment_date" class="form-control nsm-field mb-2 date" value="<?=isset($expense) ? ($expense->payment_date !== "" && !is_null($expense->payment_date) ? date("m/d/Y", strtotime($expense->payment_date)) : "") : date("m/d/Y")?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="payment_method">Payment method</label>
                                        <select name="payment_method" id="payment_method" class="form-control nsm-field mb-2">
                                            <?php if(isset($expense)) : ?>
                                                <option value="<?=$expense->payment_method_id?>"><?=$this->accounting_payment_methods_model->getById($expense->payment_method_id)->name?></option>
                                            <?php endif;?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="ref_no">Ref no.</label>
                                            <input type="text" name="ref_no" id="ref_no" class="form-control nsm-field" <?=isset($expense) ? "value='$expense->ref_no'" : ''?>>
                                    </div>
                                    <div class="col-12 col-md-8 grid-mb">
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
                                    <div class="cold-12 col-md-4 grid-mb">
                                        <label for="permit_number">Permit no.</label>
                                        <input type="number" class="form-control nsm-field mb-2" name="permit_number" id="permit_number" <?=isset($expense) ? "value='$expense->permit_no'" : ''?>> 
                                    </div>
                                </div>
                            </div>
                            </div>

                        

                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion grid-mb">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-category-details" aria-expanded="true" aria-controls="collapse-category-details">
                                                    Category details
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse show" id="collapse-category-details">
                                                <div class="accordion-body">
                                                    <table class="nsm-table" id="category-details-table">
                                                        <thead>
                                                            <tr>
                                                                <td data-name="Num" style="width:3%;text-align:center;">#</td>
                                                                <td data-name="Customer" style="width:15%;">CUSTOMER</td>
                                                                <td data-name="Expense Name">EXPENSE NAME</td>
                                                                <td data-name="Category" style="width:15%;">CATEGORY</td>
                                                                <td data-name="Description">DESCRIPTION</td>
                                                                <td data-name="Amount" style="width:10%;">AMOUNT</td>
                                                                <td data-name="Billable" style="width:8%;text-align:center;">BILLABLE</td>
                                                                <td data-name="Markup %" style="width:8%;">MARKUP %</td>
                                                                <td data-name="Tax" style="width:5%;text-align:center;">TAX</td>                                                                
                                                                <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                <td data-name="Linked"></td>
                                                                <?php endif; ?>
                                                                <td data-name="Manage" style="width:3%;"></td>
                                                            </tr>                                                            
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>
                                                                    <select name="category_customer[]" class="nsm-field form-control"></select>
                                                                </td>
                                                                <td>
                                                                    <select name="expense_account[]" class="nsm-field form-control" required></select>
                                                                </td>
                                                                <td>
                                                                    <select name="category[]" class="nsm-field form-control">
                                                                        <option disabled selected>&nbsp;</option>
                                                                        <option value="fixed">Fixed Cost</option>
                                                                        <option value="variable">Variable Cost</option>
                                                                        <option value="periodic">Periodic Cost</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="description[]" class="nsm-field form-control"></td>
                                                                <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox" style="margin: auto;">
                                                                        <input class="form-check-input table-select" name="category_billable[]" type="checkbox" value="1">
                                                                    </div>
                                                                </td>
                                                                <td><input type="number" name="category_markup[]" class="nsm-field form-control" onchange="convertToDecimal(this)"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox" style="margin: auto;">
                                                                        <input class="form-check-input table-select" name="category_tax[]" type="checkbox" value="1">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $count = 1; ?>
                                                            <?php if(isset($categories) && count($categories) > 0) : ?>
                                                            <?php foreach($categories as $category) : ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td>
                                                                    <select name="category_customer[]" class="nsm-field form-control">
                                                                        <option value="<?=$category->customer_id?>">
                                                                            <?php $customer = $this->accounting_customers_model->get_by_id($category->customer_id); ?>
                                                                            <?=$customer->first_name . ' ' . $customer->last_name?>
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="expense_account[]" class="nsm-field form-control" required>
                                                                        <option value="<?=$category->expense_account_id?>"><?=$this->chart_of_accounts_model->getName($category->expense_account_id)?></option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="category[]" class="nsm-field form-control">
                                                                        <?php if(isset($category->category) && $category->category != null) { ?>
                                                                                <option value="<?php echo $category->category ?>" selected><?php echo getItemCategoryName($category_list, $category->category); ?></option>
                                                                        <?php }else{ ?>
                                                                                <option disabled selected>&nbsp;</option>
                                                                        <?php } ?>                                                                        
                                                                        <option value="fixed" <?=$category->category === 'fixed' ? 'selected' : ''?>>Fixed Cost</option>
                                                                        <option value="variable" <?=$category->category === 'variable' ? 'selected' : ''?>>Variable Cost</option>
                                                                        <option value="periodic" <?=$category->category === 'periodic' ? 'selected' : ''?>>Periodic Cost</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="description[]" class="nsm-field form-control" value="<?=$category->description?>"></td>
                                                                <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=str_replace(',', '', number_format(floatval($category->amount), 2, '.', ','))?>"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox" style="margin: auto;">
                                                                        <input class="form-check-input table-select" name="category_billable[]" type="checkbox" value="1" <?=$category->billable === "1" ? 'checked' : ''?>>
                                                                    </div>
                                                                </td>
                                                                <td><input type="number" name="category_markup[]" class="nsm-field form-control" onchange="convertToDecimal(this)" value="<?=number_format(floatval($category->markup_percentage), 2, '.', ',')?>"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox" style="margin: auto;">
                                                                        <input class="form-check-input table-select" name="category_tax[]" type="checkbox" value="1" <?=$category->tax === "1" ? 'checked' : ''?>>
                                                                    </div>
                                                                </td>
                                                                <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                <td>
                                                                <?php if(!is_null($category->linked_transaction_type) && !is_null($category->linked_transaction_id)) : ?>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                                                        <div class="dropdown-menu">
                                                                            <table class="nsm-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td data-name="Type">Type</td>
                                                                                        <td data-name="Date">Date</td>
                                                                                        <td data-name="Amount">Amount</td>
                                                                                        <td data-name="Action"></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="<?=$category->linked_transaction_id?>" data-type="purchase-order">Puchase Order</a></td>
                                                                                        <td><?=date("m/d/Y", strtotime($category->linked_transac->purchase_order_date))?></td>
                                                                                        <td>
                                                                                            <?php
                                                                                            $transacAmount = $category->linked_transac->total_amount;
                                                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                            echo str_replace('$-', '-$', $transacAmount);
                                                                                            ?>
                                                                                        </td>
                                                                                        <td><button class="nsm-button unlink-transaction" data-type="puchase-order" data-id="<?=$category->linked_transaction_id?>">Remove</button></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" value="<?=$category->linked_transaction_type?>-<?=$category->linked_transaction_id?>" name="category_linked_transaction[]">
                                                                    <input type="hidden" value="<?=$category->linked_transaction_category_id?>" name="transaction_category_id[]">
                                                                <?php endif; ?>
                                                                </td>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $count++; endforeach; ?>
                                                            <?php endif; ?>

                                                            <?php do {?>
                                                            <tr>
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
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $count++; } while ($count <= 2) ?>
                                                            <!-- <tr>
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
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr> -->
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="11">
                                                                    <div class="nsm-page-buttons page-buttons-container">
                                                                        <button type="button" class="nsm-button" onclick="addTableLines(event)" data-target="#category-details-table">
                                                                            Add lines
                                                                        </button>
                                                                        <button type="button" class="nsm-button" onclick="clearTableLines(event)" data-target="#category-details-table">
                                                                            Clear all lines
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion mb-2">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button content-title <?=isset($items) && count($items) > 0 ? '' : ' collapsed'?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-item-details" aria-expanded="false" aria-controls="collapse-item-details">
                                                    Item details
                                                </button>
                                            </h2>
                                            <div id="collapse-item-details" class="accordion-collapse collapse <?=isset($items) && count($items) > 0 ? 'show' : ''?>">
                                                <div class="accordion-body">
                                                    <table class="nsm-table" id="item-details-table">
                                                        <thead>
                                                            <tr>
                                                                <td data-name="Product/Service">PRODUCT/SERVICE</td>
                                                                <td data-name="Type">TYPE</td>
                                                                <td data-name="Location">LOCATION</td>
                                                                <td data-name="Quantity">QUANTITY</td>
                                                                <td data-name="Price">PRICE</td>
                                                                <td data-name="Discount">DISCOUNT</td>
                                                                <td data-name="Tax">TAX (CHANGE IN %)</td>
                                                                <td data-name="Total">TOTAL</td>
                                                                <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                                                                <td data-name="Linked"></td>
                                                                <?php endif; ?>
                                                                <td data-name="Manage"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(isset($items) && count($items) > 0) : ?>
                                                                <?php foreach($items as $item) : ?>
                                                                    <?php $itemDetails = $this->items_model->getItemById($item->item_id)[0];?>
                                                                    <?php $locations = $this->items_model->getLocationByItemId($item->item_id);?>
                                                                    <tr>
                                                                        <td><?=$itemDetails->title?><input type="hidden" name="item[]" value="<?=$item->item_id?>"></td>
                                                                        <td><?=ucfirst($itemDetails->type)?></td>
                                                                        <td>
                                                                            <?php if(in_array($itemDetails->type, ['product', 'Product', 'inventory', 'Inventory'])) : ?>
                                                                            <select name="location[]" class="nsm-field form-control" required>
                                                                                <?php foreach($locations as $location) : ?>
                                                                                    <option value="<?=$location['id']?>" data-quantity="<?=$location['qty'] === null ? 0 : $location['qty']?>" <?=$item->location_id === $location['id'] ? 'selected' : ''?>><?=$location['name']?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td><input type="number" name="quantity[]" class="nsm-field form-control text-end" required value="<?=$item->quantity?>" max="<?=$locations[0]['qty']?>"></td>
                                                                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=number_format(floatval($item->rate), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=number_format(floatval($item->discount), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
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
                                                                                <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                                                                <div class="dropdown-menu">
                                                                                    <table class="nsm-table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td data-name="Type">Type</td>
                                                                                                <td data-name="Date">Date</td>
                                                                                                <td data-name="Amount">Amount</td>
                                                                                                <td data-name="Action"></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td><a class="text-decoration-none open-transaction" href="#" data-id="<?=$item->linked_transaction_id?>" data-type="purchase-order">Puchase Order</a></td>
                                                                                                <td><?=date("m/d/Y", strtotime($item->linked_transac->purchase_order_date))?></td>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    $transacAmount = $item->linked_transac->total_amount;
                                                                                                    $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                                    echo str_replace('$-', '-$', $transacAmount);
                                                                                                    ?>
                                                                                                </td>
                                                                                                <td><button class="nsm-button unlink-transaction" data-type="puchase-order" data-id="<?=$item->linked_transaction_id?>">Remove</button></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="<?=$item->linked_transaction_type?>-<?=$item->linked_transaction_id?>" name="item_linked_transaction[]">
                                                                            <input type="hidden" value="<?=$item->linked_transaction_item_id?>" name="transaction_item_id[]">
                                                                        <?php endif; ?>
                                                                        </td>
                                                                        <?php endif; ?>
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
                                                                        <button type="button" class="nsm-button" id="add_another_items">
                                                                            Add items
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 mt-5">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" style="height: 150px  !important" id="memo" class="nsm-field form-control mb-2"><?=isset($expense) ? str_replace("<br />", "", $expense->memo) : ''?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="expense-attachments" class="dropzone d-block justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                            </div>
                        </div>

                        <?php if(isset($expense) && !is_null($expense->linked_transacs)) : ?>
                        <div class="w-auto nsm-callout primary" style="display: none; max-width: 15%">
                            <div class="transactions-container h-100 p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Add to Expense</h4>
                                    </div>

                                    <?php foreach($linkableTransactions as $linkableTransac) : ?>
                                    <?php
                                    $title = $linkableTransac['type'];
                                    $title .= $linkableTransac['number'] !== '' ? ' #' . $linkableTransac['number'] : '';
                                    ?>

                                    <div class="col-12 grid-mb">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?=$title?></h5>
                                                <p class="card-subtitle"><?=$linkableTransac['formatted_date']?></p>
                                                <p class="card-text">
                                                    <strong>Total</strong>&emsp;<?=$linkableTransac['total']?>
                                                    <?php if($linkableTransac['type'] === 'Purchase Order') : ?>
                                                    <br>
                                                    <strong>Balance</strong>&emsp;<?=$linkableTransac['balance']?>
                                                    <?php endif; ?>
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="add-transaction text-decoration-none" data-id="<?=$linkableTransac['id']?>" data-type="<?=$linkableTransac['type']?>"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="open-transaction text-decoration-none" data-id="<?=$linkableTransac['id']?>" data-type="<?=$linkableTransac['type']?>"><strong>Open</strong></a></li>
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

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4 <?=!isset($expense) ? 'd-flex' : ''?>">
                            <?php if(!isset($expense)) : ?>
                            <a href="#" class="text-dark text-decoration-none m-auto" onclick="makeRecurring('expense')">Make Recurring</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('expense')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" onclick="saveAndNewForm(event)">
                                    Save and new
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
                                    </div>
                                </div>
                            </div>

                            <!-- <button type="button" class="nsm-button float-end" id="save">Save</button> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>