<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/products_and_services_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
							If you are not enrolled in our inventory management system, you may want to consider this feature. With this powerful feature means being able to track the products you sell and the services you provide per location. This feature means less shrinkage and more profitability.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=$low_stock_count?></h2>
                                    <span>LOW STOCK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter error h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=$out_of_stock?></h2>
                                    <span>OUT OF STOCK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Find products and services">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="assign-category">Assign category</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="make-inactive">Make inactive</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="adjust-quantity">Adjust quantity</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="reorder">Reorder</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-non-inventory">Make non-inventory</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-service">Make service</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    More
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="manage-categories">Manage categories</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="run-report">Run report</a></li>
                            </ul>
                        </div>

						<div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3 table-filter" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-status">Status</label>
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                            <option value="active" selected="selected">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="all">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                            <option value="all" selected="selected">All</option>
                                            <option value="inventory">Inventory</option>
                                            <option value="non-inventory">Non-inventory</option>
                                            <option value="service">Service</option>
                                            <option value="bundle">Bundle</option>
                                        </select>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col">
                                        <label for="filter-category" class="w-100">Category</label>
                                        <div class="dropdown d-inline-block w-100">
											<button type="button" class="dropdown-toggle nsm-button w-100 m-0 d-flex justify-content-between align-items-center" data-bs-toggle="dropdown">
												<span>
													All
												</span> <i class='bx bx-fw bx-chevron-down'></i>
											</button>
											<ul class="dropdown-menu dropdown-menu-end" id="table-rows">
												<li><a class="dropdown-item active" href="javascript:void(0);">Uncategorized</a></li>
												<?php foreach ($this->items_model->getItemCategories() as $category) : ?>
												<li><a class="dropdown-item active" href="javascript:void(0);" data-value="<?=$category->item_categories_id?>"><?=$category->name?></a></li>
												<?php endforeach; ?>
											</ul>
										</div>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col">
                                        <label for="filter-stock-status">Stock status</label>
                                        <select class="nsm-field form-select" name="filter_stock_status" id="filter-stock-status">
                                            <option value="all" selected="selected">All</option>
											<option value="low-stock">Low stock</option>
											<option value="out-of-stock">Out of stock</option>
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
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_income_account" class="form-check-input">
                                    <label for="chk_income_account" class="form-check-label">Income Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_expense_account" class="form-check-input">
                                    <label for="chk_expense_account" class="form-check-label">Expense Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_inventory_account" class="form-check-input">
                                    <label for="chk_inventory_account" class="form-check-label">Inventory Account</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_purch_desc" class="form-check-input">
                                    <label for="chk_purch_desc" class="form-check-label">Purchase Description</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_qty_po" class="form-check-input">
                                    <label for="chk_qty_po" class="form-check-label">Qty on PO</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_sku" class="form-check-input">
                                    <label for="chk_sku" class="form-check-label">SKU</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_type" class="form-check-input">
                                    <label for="chk_type" class="form-check-label">Type</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_sales_desc" class="form-check-input">
                                    <label for="chk_sales_desc" class="form-check-label">Sales Description</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_sales_price" class="form-check-input">
                                    <label for="chk_sales_price" class="form-check-label">Sales Price</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_cost" class="form-check-input">
                                    <label for="chk_cost" class="form-check-label">Cost</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_taxable" class="form-check-input">
                                    <label for="chk_taxable" class="form-check-label">Taxable</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_qty_on_hand" class="form-check-input">
                                    <label for="chk_qty_on_hand" class="form-check-label">Qty on hand</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="col(this)" id="chk_reorder_point" class="form-check-input">
                                    <label for="chk_reorder_point" class="form-check-label">Reorder point</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            50
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">50</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">150</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                    </ul>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" id="compact" class="form-check-input">
                                    <label for="compact" class="form-check-label">Compact</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" id="group-by-category" class="form-check-input">
                                    <label for="group-by-category" class="form-check-label">Group by category</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Income Account">INCOME ACCOUNT</td>
                            <td data-name="Expense Account">EXPENSE ACCOUNT</td>
                            <td data-name="Inventory Account">INVENTORY ACCOUNT</td>
                            <td data-name="Purchase Description">PURCHASE DESCRIPTION</td>
                            <td data-name="Sales Price">SALES PRICE</td>
                            <td data-name="Cost">COST</td>
                            <td data-name="Taxable">TAXABLE</td>
                            <td data-name="Qty on hand">QTY ON HAND</td>
                            <td data-name="Qty on PO">QTY ON PO</td>
                            <td data-name="Reorder Point">REORDER POINT</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($items) > 0) : ?>
						<?php foreach($items as $item) : ?>
						<?php $accountingDetails = $this->items_model->getItemAccountingDetails($item->id); ?>
						<tr>
							<td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$item->id?>">
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$item->title?></td>
							<td><?=ucfirst($item->type)?></td>
							<td><?=$this->chart_of_accounts_model->getName($accountingDetails->income_account_id)?></td>
							<td><?=$this->chart_of_accounts_model->getName($accountingDetails->expense_account_id)?></td>
							<td><?=$this->chart_of_accounts_model->getName($accountingDetails->inv_asset_acc_id)?></td>
							<td><?=$accountingDetails->purchase_description?></td>
							<td><?=$item->price?></td>
							<td><?=$item->cost?></td>
							<td>
								<?php if($accountingDetails->tax_rate_id !== "0" && $accountingDetails->tax_rate_id !== null && $accountingDetails->tax_rate_id !== "") : ?>
								<div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                </div>
								<?php endif; ?>
							</td>
							<td><?=$this->items_model->countQty($item->id)?></td>
							<td><?=!is_null($accountingDetails) ? $accountingDetails->qty_po : ''?></td>
							<td><?=$item->re_order_points?></td>
							<td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Make inactive</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Run report</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Duplicate</a>
                                        </li>
                                    </ul>
                                </div>
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