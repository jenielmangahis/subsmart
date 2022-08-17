<?php include viewPath('v2/includes/accounting_header'); ?>

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
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Tags are customizable labels that let you track your money however you want. When you put tags into groups, you get deeper insights into how your business is doing. You'll need groups to get reports for your tags. You can tag transactions such as invoices, expenses and bills.
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by tag name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filters</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                            <option value="all-transactions" selected="selected">All transactions</option>
                                            <option value="money-in">Money In</option>
                                            <option value="money-out">Money Out</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                            <option value="all">All dates</option>
                                            <option value="today">Today</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="this-week">This week</option>
                                            <option value="this-month">This month</option>
                                            <option value="this-quarter">This quarter</option>
                                            <option value="this-year">This year</option>
                                            <option value="last-week">Last week</option>
                                            <option value="last-month">Last month</option>
                                            <option value="last-quarter">Last quarter</option>
                                            <option value="last-year">Last year</option>
                                            <option value="last-365-days" selected="selected">Last 365 days</option>
                                            <option value="custom">Custom</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y", strtotime("-1 year"))?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y")?>" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-contact">Contact</label>
                                        <select class="nsm-field form-select" name="filter_contact" id="filter-contact">
                                            <option value="all-contacts" selected="selected">All contacts</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>

                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-purchase-tag'></i> Tags
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="show_untagged_transactions" id="show_untagged_transactions" class="form-check-input">
                                    <label for="show_untagged_transactions" class="form-check-label">Show untagged transactions</label>
                                </div>
                                <?php foreach($groups as $group) : ?>
                                <div class="row">
                                    <div class="col">
                                        <label for="tag-group-<?=$group['id']?>"><?=$group['name']?></label>
                                        <select id="tag-group-<?=$group['id']?>" class="nsm-field form-select" multiple="multiple">
                                            <option value="all-<?=$group['name']?>-tags">All <?=$group['name']?> tags</option>
                                            <?php foreach($group['tags'] as $tag) : ?>
                                            <option value="<?=$tag->id?>"><?=$tag->name?></option>
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
                                            <option value="all">All ungrouped tags</option>
                                            <?php foreach($ungrouped as $uTag) : ?>
                                                <option value="<?=$uTag->id?>"><?=$uTag->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>

                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="From/To">FROM/TO</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo">MEMO</td>
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
                                    <input class="form-check-input select-one table-select" type="checkbox">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['from_to']?></td>
                            <td><?=$transaction['category']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['type']?></td>
                            <td>
                                <?php 
                                    $amount = '$'.$transaction['amount'];
                                    echo str_replace('$-', '-$', $amount);
                                ?>
                            </td>
                            <td>
                                <?php foreach($transaction['tags'] as $tag) : ?>
                                <span class="nsm-badge"><?=$tag->name?></span>
                                <?php endforeach; ?>
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

<?php include viewPath('v2/includes/footer'); ?>