<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/products_and_services_modals'); ?>

<style>
    .nsm-counter.selected {
        border-bottom: 6px solid rgba(0, 0, 0, 0.35);
    }

    #import-items-modal .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }

    #import-items-modal label {
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }

    #import-items-modal hr {
        border: 2px solid #32243d !important;
        width: 100%;
    }

    #import-items-modal .required {
        color: red !important;
    }

    #import-items-modal .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #import-items-modal .card {
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    #import-items-modal #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    #import-items-modal table {
        overflow-x: scroll !important;
        overflow-y: scroll !important;
        display: block !important;
        height: 500px !important;
    }

    /**  */
    /* #import-items-modal * {
        margin: 0;
        padding: 0;
    } */
    #import-items-modal #progress-bar-container li .step-inner {
        position: absolute;
        width: 100%;
        bottom: 0;
        font-size: 14px;
    }

    #import-items-modal #progress-bar-container li.active,
    #import-items-modal #progress-bar-container li:hover {
        color: #444;
    }

    #import-items-modal #progress-bar-container li::after {
        content: " ";
        display: block;
        width: 6px;
        height: 6px;
        background-color: #777;
        margin: auto;
        border: 7px solid #fff;
        border-radius: 50%;
        margin-top: 40px;
        box-shadow: 0 2px 13px -1px rgba(0, 0, 0, 0.2);
        transition: all ease 0.25s;
    }

    #import-items-modal #progress-bar-container li:hover::after {
        background: #555;
    }

    #import-items-modal #progress-bar-container li.active::after {
        background: #207893;
    }

    #import-items-modal #progress-bar-container #line {
        width: 80%;
        margin: auto;
        background-color: #eee;
        height: 6px;
        position: absolute;
        left: 10%;
        top: 50px;
        z-index: 1;
        border-radius: 50px;
        transition: all ease 0.75s;
    }

    #import-items-modal #progress-bar-container #line-progress {
        content: " ";
        width: 10%;
        height: 100%;
        background-color: #207893;
        background: linear-gradient(to right #207893 0%, #2ea3b7 100%);
        position: absolute;
        z-index: 2;
        border-radius: 50px;
        transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.25);
    }

    #import-items-modal #progress-content-section {
        position: relative;
        top: 100px;
        width: 90%;
        margin: auto;
        background: #f3f3f3;
        border-radius: 4px;
    }

    #import-items-modal #progress-content-section .section-content {
        padding: 30px 40px;
        text-align: center;
    }

    #import-items-modal .section-content h2 {
        font-size: 17px;
        text-transform: uppercase;
        color: #333;
        letter-spacing: 1px;
    }

    #import-items-modal .section-content p {
        font-size: 16px;
        line-height: 1.8rem;
        color: #777;
    }

    #import-items-modal .section-content {
        display: none;
        animation: FadeinUp 0.7s ease 1 forwards;
        transform: translateY(15px);
        opacity: 0;
    }

    #import-items-modal .section-content.active {
        display: block;
        opacity: 1;
    }

    #import-items-modal .progress-wrapper {
        margin: auto;
        max-width: auto;
    }

    #import-items-modal #progress-bar-container {
        position: relative;
        margin: auto;
        height: 100%;
        margin-top: 65px;
    }

    #import-items-modal #progress-bar-container ul {
        padding-top: 15px;
        z-index: 999;
        position: absolute;
        width: 100%;
        margin-top: -40px;
    }

    #import-items-modal #progress-bar-container li::before {
        content: " ";
        display: block;
        margin: auto;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #aaa;
        transition: all ease 0.3s;
    }

    #import-items-modal #progress-bar-container li.active::before,
    #import-items-modal #progress-bar-container li:hover::before {
        border: 2px solid #fff;
        background-color: #32243d;
    }

    #import-items-modal #progress-bar-container li {
        list-style: none;
        float: left;
        width: 33%;
        text-align: center;
        color: #aaa;
        text-transform: uppercase;
        font-size: 11px;
        cursor: pointer;
        font-weight: 700;
        transition: all ease 0.2s;
        vertical-align: bottom;
        height: 60px;
        position: relative;
    }

    @keyframes FadeInUp {
        0% {
            transform: translateY(15px);
            opacity: 0;
        }

        100% {
            transform: translateY(0px);
            opacity: 1;
        }
    }

    #import-items-modal .btn-primary:disabled {
        color: #fff !important;
        ;
        background-color: #ccc !important;
        border: 1px solid transparent !important;
        ;
    }

    #import-items-modal .tbl {
        border-collapse: collapse;
    }

    #import-items-modal .tbl th,
    .tbl td {
        padding: 2px;
        border: solid 1px #777;
    }

    #import-items-modal .tbl th {
        background-color: lightblue;
    }

    #import-items-modal .tbl-separate {
        border-collapse: separate;
        border-spacing: 5px;
    }

    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .nsm-counter:hover {
        cursor: pointer;
    }


    .table-filter {
        width: 400px !important;
    }

    .nsm-field.form-select {
        width: 100%;
        max-width: 300px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    .reset-indicator {
        border-color: #9c27b066 !important;
        box-shadow: 0 0 0 0.25rem rgb(156 39 176 / 17%) !important;
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
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="nsm-counter primary h-100 mb-2 <?= $stock_status === 'low-stock' ? 'selected' : '' ?>" id="low-stock">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="lowStockCount"><?= $low_stock_count ?></h2>
                                    <span>LOW STOCK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="nsm-counter error h-100 mb-2 <?= $stock_status === 'out-of-stock' ? 'selected' : '' ?>" id="out-of-stock">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="outOfStockCount"><?= $out_of_stock ?></h2>
                                    <span>OUT OF STOCK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="totalStock"><?= $total_stock ?></h2>
                                    <span>TOTAL ITEMS</span>
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-non-inventory">Change to Non-Inventory</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="make-service">Change to Services</a></li>
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
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status" data-applied="<?= empty($status) ? 'active' : $status ?>">
                                            <option value="active" <?= empty($status) || $status === 'active' ? 'selected' : '' ?>>Active</option>
                                            <option value="inactive" <?= $status === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                            <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type" data-applied="<?= empty($type) ? 'all' : $type ?>">
                                            <option value="all" <?= empty($type) || $type === 'all' ? 'selected' : '' ?>>All</option>
                                            <option value="inventory" <?= $type === 'inventory' ? 'selected' : '' ?>>Inventory</option>
                                            <option value="non-inventory" <?= $type === 'non-inventory' ? 'selected' : '' ?>>Non-inventory</option>
                                            <option value="service" <?= $type === 'service' ? 'selected' : '' ?>>Service</option>
                                            <option value="bundle" <?= $type === 'bundle' ? 'selected' : '' ?>>Bundle</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-category" class="w-100">Category</label>
                                        <select name="filter_category[]" id="filter-category" class="nsm-field form-select" multiple="multiple">
                                            <option value="all">All</option>
                                            <option value="0">Uncategorized</option>
                                            <?php foreach ($this->items_model->getItemCategories() as $category) : ?>
                                                <option value="<?= $category->item_categories_id ?>"><?= $category->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-stock-status">Stock status</label>
                                        <select class="nsm-field form-select" name="filter_stock_status" id="filter-stock-status" data-applied="<?= empty($stock_status) ? 'all' : $stock_status ?>">
                                            <option value="all" <?= empty($stock_status) || $stock_status === 'all' ? 'selected' : '' ?>>All</option>
                                            <option value="low-stock" <?= $stock_status === 'low-stock' ? 'selected' : '' ?>>Low stock</option>
                                            <option value="out-of-stock" <?= $stock_status === 'out-of-stock' ? 'selected' : '' ?>>Out of stock</option>
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
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#import-items-modal">
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
                                            10
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">10</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">50</a></li>
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
                                    <input type="checkbox" id="group-by-category" class="form-check-input" <?= !empty($group_by_category) ? 'checked' : '' ?>>
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
                            <!-- <td data-name="Sales Description">SALES DESCRIPTION</td>
                            <td data-name="Income Account">INCOME ACCOUNT</td>
                            <td data-name="Expense Account">EXPENSE ACCOUNT</td>
                            <td data-name="Inventory Account">INVENTORY ACCOUNT</td>
                            <td data-name="Purchase Description">PURCHASE DESCRIPTION</td> -->
                            <td data-name="Sales Price">SALES PRICE</td>
                            <td data-name="Category">Category</td>
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
                        <?php if (count($items) > 0) : ?>
                            <?php foreach ($items as $item) : ?>
                                <?php if ($item['is_category']) : ?>
                                    <tr>
                                        <td></td>
                                        <td class="fw-bold nsm-text-primary default" colspan="15"><?= $item['name'] ?></td>
                                    </tr>
                                <?php else : ?>
                                    <tr data-status="<?= $item['status'] ?>" data-id="<?= $item['id'] ?>">
                                        <td>
                                        
                                                <div class="table-row-icon table-checkbox">
                                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?= $item['id'] ?>">
                                                </div>
                             
                                        </td>
                                        <td class="nsm-text-primary nsm-link default"><?= $item['name'] ?: 'No name provided' ?></td>
                                        <td><?= $item['sku'] ?: 'No SKU available' ?></td>
                                        <td><?= $item['type'] ?: 'No type provided' ?></td>
                                        <td><?= $item['sales_price'] ?: 'No sales price' ?></td>
                                        <td><?= $item['category'] ?: 'No category available' ?></td>
                                        <td><?= $item['cost'] ?: 'No cost available' ?></td>
                                        <td>
                                            <?php if ($item['tax_rate_id'] !== "0" && $item['tax_rate_id'] !== null && $item['tax_rate_id'] !== "") : ?>
                                                <div class="table-row-icon table-checkbox">
                                                    <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                                </div>
                                            <?php else : ?>
                                                No tax available
                                            <?php endif; ?>
                                        </td>

                                        <td><?= $item['qty_on_hand'] ?: 'No quantity on hand available' ?></td>
                                        <td><?= $item['qty_po'] ?: 'No quantity available' ?></td>
                                        <td><?= $item['reorder_point'] ?: 'No reorder point avaliable' ?></td>
                                        <td>
                                            <?php if ($item['type'] === 'Product') : ?>
                                                <button class="nsm-button btn-sm see-item-locations">See Locations</button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown float-end">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php if ($item['status'] !== "0") : ?>
                                                        <li>
                                                            <a class="dropdown-item edit-item" href="#">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item make-inactive" href="#">Make inactive</a>
                                                        </li>
                                                        <?php if ($item['type'] !== 'Bundle') : ?>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lowStockElement = document.getElementById('lowStockCount');
        const outOfStockElement = document.getElementById('outOfStockCount');
        const totalStockElement = document.getElementById('totalStock');

        const lowStockCount = parseInt(lowStockElement.innerText);
        const outOfStockCount = parseInt(outOfStockElement.innerText);

        const totalStock = lowStockCount + outOfStockCount;

        totalStockElement.innerText = totalStock.toString();
    });
</script>
<script>
    $(document).ready(function() {
        $("#items-table").nsmPagination({
            itemsPerPage: 10,
        });

        function updateRowsPerPage(numRows) {
            $("#items-table").nsmPagination({
                itemsPerPage: numRows
            });
            $("#items-table tbody tr").hide();
            $("#items-table tbody tr").slice(0, numRows).show();
        }

        document.getElementById("table-rows").querySelectorAll(".dropdown-item").forEach(function(item) {
            item.addEventListener("click", function() {
                var numRows = parseInt(this.textContent);
                updateRowsPerPage(numRows);
            });
        });

        $('#filter-category').change(function() {
            if ($(this).val() && $(this).val().includes('all')) {
                console.log('All option selected');
                $('#filter-category option').prop('selected', true);
            } else {
                console.log('Other option selected');
            }
        });
    });
</script>