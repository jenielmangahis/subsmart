<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/products_and_services_modals'); ?>

<style>
    .nsm-counter.selected {
        border-bottom: 6px solid rgba(0, 0, 0, 0.35);
    }
</style>

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
                        <div class="nsm-counter primary h-100 mb-2 <?=$stock_status === 'low-stock' ? 'selected' : ''?>" id="low-stock">
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
                        <div class="nsm-counter error h-100 mb-2 <?=$stock_status === 'out-of-stock' ? 'selected' : ''?>" id="out-of-stock">
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
                        <form action="<?php echo base_url('accounting/products-and-services') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Find products and services" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="assign-category">Assign category</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-inactive">Make inactive</a></li>
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
                                <li><a class="dropdown-item" href="/accounting/product-categories" id="manage-categories">Manage categories</a></li>
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
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status" data-applied="<?=empty($status) ? 'active' : $status?>">
                                            <option value="active" <?=empty($status) || $status === 'active' ? 'selected' : ''?>>Active</option>
                                            <option value="inactive" <?=$status === 'inactive' ? 'selected' : ''?>>Inactive</option>
                                            <option value="all" <?=$status === 'all' ? 'selected' : ''?>>All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type" data-applied="<?=empty($type) ? 'all' : $type?>">
                                            <option value="all" <?=empty($type) || $type === 'all' ? 'selected' : ''?>>All</option>
                                            <option value="inventory" <?=$type === 'inventory' ? 'selected' : ''?>>Inventory</option>
                                            <option value="non-inventory" <?=$type === 'non-inventory' ? 'selected' : ''?>>Non-inventory</option>
                                            <option value="service" <?=$type === 'service' ? 'selected' : ''?>>Service</option>
                                            <option value="bundle" <?=$type === 'bundle' ? 'selected' : ''?>>Bundle</option>
                                        </select>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col">
                                        <label for="filter-category" class="w-100">Category</label>
                                        <select name="filter_category[]" id="filter-category" class="nsm-field form-select" multiple="multiple">
                                            <option value="0" <?=empty($selectedCategories) || in_array('0', $selectedCategories) ? 'selected' : ''?>>Uncategorized</option>
                                            <?php foreach ($this->items_model->getItemCategories() as $category) : ?>
                                            <option value="<?=$category->item_categories_id?>" <?=empty($selectedCategories) || in_array($category->item_categories_id, $selectedCategories) ? 'selected' : ''?>><?=$category->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col">
                                        <label for="filter-stock-status">Stock status</label>
                                        <select class="nsm-field form-select" name="filter_stock_status" id="filter-stock-status" data-applied="<?=empty($stock_status) ? 'all' : $stock_status?>">
                                            <option value="all" <?=empty($stock_status) || $stock_status === 'all' ? 'selected' : ''?>>All</option>
											<option value="low-stock" <?=$stock_status === 'low-stock' ? 'selected' : ''?>>Low stock</option>
											<option value="out-of-stock" <?=$stock_status === 'out-of-stock' ? 'selected' : ''?>>Out of stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-button">
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
                            <button type="button" class="nsm-button" id="add-item-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_items_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_income_account" class="form-check-input">
                                    <label for="chk_income_account" class="form-check-label">Income Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_expense_account" class="form-check-input">
                                    <label for="chk_expense_account" class="form-check-label">Expense Account</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_inventory_account" class="form-check-input">
                                    <label for="chk_inventory_account" class="form-check-label">Inventory Account</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_purch_desc" class="form-check-input">
                                    <label for="chk_purch_desc" class="form-check-label">Purchase Description</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_qty_po" class="form-check-input">
                                    <label for="chk_qty_po" class="form-check-label">Qty on PO</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_sku" class="form-check-input">
                                    <label for="chk_sku" class="form-check-label">SKU</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_type" class="form-check-input">
                                    <label for="chk_type" class="form-check-label">Type</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_sales_desc" class="form-check-input">
                                    <label for="chk_sales_desc" class="form-check-label">Sales Description</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_sales_price" class="form-check-input">
                                    <label for="chk_sales_price" class="form-check-label">Sales Price</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_cost" class="form-check-input">
                                    <label for="chk_cost" class="form-check-label">Cost</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_taxable" class="form-check-input">
                                    <label for="chk_taxable" class="form-check-label">Taxable</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_qty_on_hand" class="form-check-input">
                                    <label for="chk_qty_on_hand" class="form-check-label">Qty on hand</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked name="col_chk" id="chk_reorder_point" class="form-check-input">
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
                                    <input type="checkbox" id="group-by-category" class="form-check-input" <?=!empty($group_by_category) ? 'checked' : ''?>>
                                    <label for="group-by-category" class="form-check-label">Group by category</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="items-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Name">NAME</td>
                            <td data-name="SKU">SKU</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Sales Description">SALES DESCRIPTION</td>
                            <td data-name="Income Account">INCOME ACCOUNT</td>
                            <td data-name="Expense Account">EXPENSE ACCOUNT</td>
                            <td data-name="Inventory Account">INVENTORY ACCOUNT</td>
                            <td data-name="Purchase Description">PURCHASE DESCRIPTION</td>
                            <td data-name="Sales Price">SALES PRICE</td>
                            <td data-name="Cost">COST</td>
                            <td data-name="Taxable">TAXABLE</td>
                            <td data-name="Qty on hand">QTY ON HAND</td>
                            <td data-name="Qty on PO">QTY ON PO</td>
                            <td data-name="Reorder point">REORDER POINT</td>
                            <td data-name="Locations">Locations</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($items) > 0) : ?>
						<?php foreach($items as $item) : ?>
                        <?php if($item['is_category']) : ?>
                        <tr>
                            <td></td>
                            <td class="fw-bold nsm-text-primary default" colspan="15"><?=$item['name']?></td>
                        </tr>
                        <?php else : ?>
						<tr data-status="<?=$item['status']?>" data-id="<?=$item['id']?>">
							<td>
                                <?php if($item['type'] !== 'Bundle') : ?>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$item['id']?>">
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="nsm-text-primary nsm-link default"><?=$item['name']?></td>
							<td><?=$item['sku']?></td>
							<td><?=$item['type']?></td>
							<td><?=$item['sales_desc']?></td>
							<td data-id="<?=$item['income_account_id']?>"><?=$item['income_account']?></td>
							<td data-id="<?=$item['expense_account_id']?>"><?=$item['expense_account']?></td>
							<td data-id="<?=$item['inventory_account_id']?>"><?=$item['inventory_account']?></td>
							<td><?=$item['purch_desc']?></td>
							<td><?=$item['sales_price']?></td>
							<td><?=$item['cost']?></td>
							<td>
								<?php if($item['tax_rate_id'] !== "0" && $item['tax_rate_id'] !== null && $item['tax_rate_id'] !== "") : ?>
								<div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                </div>
								<?php endif; ?>
							</td>
							<td><?=$item['qty_on_hand']?></td>
							<td><?=$item['qty_po']?></td>
							<td><?=$item['reorder_point']?></td>
                            <td>
                                <?php if($item['type'] === 'Product') : ?>
                                    <button class="nsm-button btn-sm see-item-locations">See Locations</button>
                                <?php endif; ?>
                            </td>
							<td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php if($item['status'] !== "0") : ?>
                                        <li>
                                            <a class="dropdown-item edit-item" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item make-inactive" href="#">Make inactive</a>
                                        </li>
                                        <?php if($item['type'] !== 'Bundle') : ?>
                                        <li>
                                            <a class="dropdown-item" href="#">Run report</a>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="dropdown-item duplicate" href="#">Duplicate</a>
                                        </li>
                                        <?php else : ?>
                                        <li>
                                            <a class="dropdown-item make-active" href="#">Make active</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Run report</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
						</tr>
                        <?php endif; ?>
						<?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="15">
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