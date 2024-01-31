<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/tags_transactions_modals'); ?>
<style>
.row-hover:hover{
    cursor:pointer;
}
.tag-name{
    font-size:12px;
}
.group-header{
    background-color:#b3b3b3;
}
.group-header:hover{
    background-color:#b3b3b3 !important;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/banking'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/tags_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb"></div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Update tags</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="#" class="dropdown-item disabled" id="add-tags">Add tags</a>
                                    <a href="#" class="dropdown-item disabled" id="remove-tags">Remove tags</a>
                                </li>
                            </ul>
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filters</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content" id="transactions-filter-dropdown">
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                            <option value="all-transactions" <?=empty($type) || $type === 'all-transactions' ? 'selected' : ''?>>All transactions</option>
                                            <option value="money-in" <?=!empty($type) && $type === 'money-in' ? 'selected' : ''?>>Money In</option>
                                            <option value="money-out" <?=!empty($type) && $type === 'money-out' ? 'selected' : ''?>>Money Out</option>
                                        </select>
                                    </div>
                                    <?php if(!empty($type) && $type != 'all-transactions') : ?>
                                        <div class="col-6 col-md-6">
                                            <label for="filter-<?=$type?>">Money <?=$type === 'money-in' ? 'in' : 'out'?> transactions</label>
                                            <select id="filter-<?=$type?>" class="form-select nsm-field">
                                                <?php if($type === 'money-in') : ?>
                                                <option value="all" <?=empty($moneyIn) || $moneyIn === 'all' ? 'selected' : ''?>>All money in</option>
                                                <option value="invoice" <?=!empty($moneyIn) && $moneyIn === 'invoice' ? 'selected' : ''?>>Invoice</option>
                                                <option value="sales-receipt" <?=!empty($moneyIn) && $moneyIn === 'sales-receipt' ? 'selected' : ''?>>Sales receipt</option>
                                                <option value="estimate" <?=!empty($moneyIn) && $moneyIn === 'estimate' ? 'selected' : ''?>>Estimate</option>
                                                <option value="cc-credit" <?=!empty($moneyIn) && $moneyIn === 'cc-credit' ? 'selected' : ''?>>Credit card credit</option>
                                                <option value="vendor-credit" <?=!empty($moneyIn) && $moneyIn === 'vendor-credit' ? 'selected' : ''?>>Vendor credit</option>
                                                <option value="credit-memo" <?=!empty($moneyIn) && $moneyIn === 'credit-memo' ? 'selected' : ''?>>Credit memo</option>
                                                <option value="activity-charge" <?=!empty($moneyIn) && $moneyIn === 'activity-charge' ? 'selected' : ''?>>Activity charge</option>
                                                <option value="deposit" <?=!empty($moneyIn) && $moneyIn === 'deposit' ? 'selected' : ''?>>Deposit</option>
                                                <?php else : ?>
                                                <option value="all" <?=empty($moneyOut) || $moneyOut === 'all' ? 'selected' : ''?>>All money out</option>
                                                <option value="expense" <?=!empty($moneyOut) && $moneyOut === 'expense' ? 'selected' : ''?>>Expense</option>
                                                <option value="bill" <?=!empty($moneyOut) && $moneyOut === 'bill' ? 'selected' : ''?>>Bill</option>
                                                <option value="credit-memo" <?=!empty($moneyOut) && $moneyOut === 'credit-memo' ? 'selected' : ''?>>Credit memo</option>
                                                <option value="refund-receipt" <?=!empty($moneyOut) && $moneyOut === 'refund-receipt' ? 'selected' : ''?>>Refund receipt</option>
                                                <option value="cash-purchase" <?=!empty($moneyOut) && $moneyOut === 'cash-purchase' ? 'selected' : ''?>>Cash purchase</option>
                                                <option value="check" <?=!empty($moneyOut) && $moneyOut === 'check' ? 'selected' : ''?>>Check</option>
                                                <option value="cc-expense" <?=!empty($moneyOut) && $moneyOut === 'cc-expense' ? 'selected' : ''?>>Credit card expense</option>
                                                <option value="purchase-order" <?=!empty($moneyOut) && $moneyOut === 'purchase-order' ? 'selected' : ''?>>Purchase order</option>
                                                <option value="vendor-credit" <?=!empty($moneyOut) && $moneyOut === 'vendor-credit' ? 'selected' : ''?>>Vendor credit</option>
                                                <option value="activity-credit" <?=!empty($moneyOut) && $moneyOut === 'activity-credit' ? 'selected' : ''?>>Activity credit</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                </div>                                
                                <div class="row">
                                    <div class="col-12 col-md-4 mt-3">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                            <option value="all" <?=!empty($date) && $date === 'all' ? 'selected' : ''?>>All dates</option>
                                            <option value="today" <?=!empty($date) && $date === 'today' ? 'selected' : ''?>>Today</option>
                                            <option value="yesterday" <?=!empty($date) && $date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                            <option value="this-week" <?=!empty($date) && $date === 'this-week' ? 'selected' : ''?>>This week</option>
                                            <option value="this-month" <?=!empty($date) && $date === 'this-month' ? 'selected' : ''?>>This month</option>
                                            <option value="this-quarter" <?=!empty($date) && $date === 'this-quarter' ? 'selected' : ''?>>This quarter</option>
                                            <option value="this-year" <?=empty($date) || $date === 'this-year' ? 'selected' : ''?>>This year</option>
                                            <option value="last-week" <?=!empty($date) && $date === 'last-week' ? 'selected' : ''?>>Last week</option>
                                            <option value="last-month" <?=!empty($date) && $date === 'last-month' ? 'selected' : ''?>>Last month</option>
                                            <option value="last-quarter" <?=!empty($date) && $date === 'last-quarter' ? 'selected' : ''?>>Last quarter</option>
                                            <option value="last-year" <?=!empty($date) && $date === 'last-year' ? 'selected' : ''?>>Last year</option>
                                            <option value="last-365-days" <?=!empty($date) && $date === 'last-365-days' ? 'selected' : ''?>>Last 365 days</option>
                                            <option value="custom" <?=!empty($date) && $date === 'custom' ? 'selected' : ''?>>Custom</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 mt-3">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=!empty($fromDate) ? $fromDate : date("01/01/Y")?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mt-3">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=!empty($toDate) ? $toDate : date("m/d/Y")?>" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-8 mt-3">
                                        <label for="filter-contact">Customer</label>
                                        <select class="nsm-field form-select" name="filter_contact" id="filter-contact">
                                            <?php if(!empty($contact)) : ?>
                                            <option value="<?=$contact->value?>" selected><?=$contact->name?></option>
                                            <?php else : ?>
                                            <option value="all-contacts" selected>All contacts</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-md-6">
                                        <button type="button" class="nsm-button" id="reset-filters-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-filters-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>

                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-purchase-tag'></i> Tags
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content" id="tags-filter-dropdown">
                                <div class="form-check">
                                    <input type="checkbox" <?=$untagged ? 'checked' : ''?> name="show_untagged_transactions" id="show_untagged_transactions" class="form-check-input">
                                    <label for="show_untagged_transactions" class="form-check-label">Show untagged transactions</label>
                                </div>
                                <?php foreach($groups as $group) : ?>
                                <div class="row">
                                    <div class="col">
                                        <label for="tag-group-<?=$group['id']?>"><?=$group['name']?></label>
                                        <select id="tag-group-<?=$group['id']?>" class="nsm-field form-select" multiple="multiple">
                                            <option value="all" <?=isset($selected[$group['id']]) && in_array('all', $selected[$group['id']]) ? 'selected' : ''?>>All <?=$group['name']?> tags</option>
                                            <?php foreach($group['tags'] as $tag) : ?>
                                            <option value="<?=$tag->id?>" <?=isset($selected[$group['id']]) && in_array($tag->id, $selected[$group['id']]) ? 'selected' : ''?>><?=$tag->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php if(count($ungrouped) > 0) : ?>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-ungrouped">Ungrouped</label>
                                        <select class="nsm-field form-select" name="filter_ungrouped" id="filter-ungrouped" multiple="multiple">
                                            <option value="all" <?=isset($selected['ungrouped']) && in_array('all', $selected['ungrouped']) ? 'selected' : ''?>>All ungrouped tags</option>
                                            <?php foreach($ungrouped as $uTag) : ?>
                                                <option value="<?=$uTag->id?>" <?=isset($selected['ungrouped']) && in_array($uTag->id, $selected['ungrouped']) ? 'selected' : ''?>><?=$uTag->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-tags-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-tags-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>

                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_transactions_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="transactions-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="From/To">CUSTOMER</td>
                            <!-- <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo">MEMO</td> -->
                            <td data-name="Type">TYPE</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="Tags">TAGS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
                        <?php foreach($transactions as $transaction) : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=str_replace(' ', '_', strtolower($transaction['type']))?>-<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td class="row-hover" style="width:10%;"><?=$transaction['date']?></td>
                            <td class="row-hover"><?=$transaction['from_to']?></td>
                            <!-- <td class="row-hover"><?=$transaction['category']?></td>
                            <td class="row-hover"><?=$transaction['memo']?></td> -->
                            <td class="row-hover"><?=$transaction['type']?></td>
                            <td class="row-hover">
                                <?php 
                                    $amount = '$'.number_format(floatval($transaction['amount']), 2);
                                    echo str_replace('$-', '-$', $amount);
                                ?>
                            </td>
                            <td>
                                <?php if(count($transaction['tags']) > 0) : ?>
                                    <span class="nsm-badge tag-name"><?=$transaction['tags'][0]->name?></span>
                                    <?php if(count($transaction['tags']) > 1) : ?>
                                    <div class="dropdown d-inline-block">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            + <?=count($transaction['tags']) - 1?>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end p-3">
                                            <?php foreach($transaction['tags'] as $index => $tag) : ?>
                                            <?php if($index > 0) : ?>
                                            <li>
                                                <span class="nsm-badge tag-name"><?=$tag->name?></span>
                                            </li>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="nsm-badge tag-name">---</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="14">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#transactions-table").nsmPagination({itemsPerPage:10});    
});
</script>
<?php include viewPath('v2/includes/footer'); ?>