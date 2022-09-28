<div class="modal fade nsm-modal" id="print_items_modal" tabindex="-1" aria-labelledby="print_items_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_items_modal_label">Print Items List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($items) > 0) : ?>
						<?php foreach($items as $item) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$item['name']?><?=$item['status'] === '0' ? ' (deleted)' : ''?></td>
							<td><?=$item['sku']?></td>
							<td><?=$item['type']?></td>
							<td><?=$item['sales_desc']?></td>
							<td data-incomeaccountid="<?=$item['income_account_id']?>"><?=$item['income_account']?></td>
							<td data-expenseaccountid="<?=$item['expense_account_id']?>"><?=$item['expense_account']?></td>
							<td data-inventoryaccountid="<?=$item['inventory_account_id']?>"><?=$item['inventory_account']?></td>
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
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="13">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_items">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_items_modal" tabindex="-1" aria-labelledby="print_preview_items_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_items_modal_label">Print itemss List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="items_table_print">
                    <thead>
                        <tr>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($items) > 0) : ?>
						<?php foreach($items as $item) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$item['name']?><?=$item['status'] === '0' ? ' (deleted)' : ''?></td>
							<td><?=$item['sku']?></td>
							<td><?=$item['type']?></td>
							<td><?=$item['sales_desc']?></td>
							<td data-incomeaccountid="<?=$item['income_account_id']?>"><?=$item['income_account']?></td>
							<td data-expenseaccountid="<?=$item['expense_account_id']?>"><?=$item['expense_account']?></td>
							<td data-inventoryaccountid="<?=$item['inventory_account_id']?>"><?=$item['inventory_account']?></td>
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
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="13">
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

<!-- Select category modal -->
<div class="modal fade nsm-modal" id="assign_category_modal" tabindex="-1" aria-labelledby="assign_category_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="assign_category_modal_label">Assign Category</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="assign-category-form">
                <div class="modal-body" style="max-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <select id="category-id" class="form-control nsm-field" required></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-sm-6">
                            <button type="button" class="nsm-button m-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="nsm-button success float-end m-0">Apply</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end select category modal -->