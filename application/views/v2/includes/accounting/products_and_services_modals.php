<div class="modal fade nsm-modal" id="print_items_modal" tabindex="-1" aria-labelledby="print_items_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_items_modal_label">Print Items List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table" id="print-items-list">
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
                        <?php if (count($items) > 0) : ?>
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary nsm-link default">
                                        <?= $item['name'] . ($item['status'] === '0' ? ' (deleted)' : 'No name provided') ?>
                                    </td>
                                    <td><?= $item['sku'] ?: 'SKU unavailable' ?></td>
                                    <td><?= $item['type'] ?: 'No type provided' ?></td>
                                    <td><?= $item['sales_desc'] ?: 'No sales description' ?></td>
                                    <td data-incomeaccountid="<?= $item['income_account_id'] ?>">
                                        <?= $item['income_account'] ?: 'Income account unavailable' ?>
                                    </td>
                                    <td data-expenseaccountid="<?= $item['expense_account_id'] ?>">
                                        <?= $item['expense_account'] ?: 'Expense account unavailable' ?>
                                    </td>
                                    <td data-inventoryaccountid="<?= $item['inventory_account_id'] ?>">
                                        <?= $item['inventory_account'] ?: 'Inventory account unavailable' ?>
                                    </td>
                                    <td><?= $item['purch_desc'] ?: 'No purchase description' ?></td>
                                    <td><?= $item['sales_price'] ?: 'Sales price unavailable' ?></td>
                                    <td><?= $item['cost'] ?: '0' ?></td>
                                    <td>
                                        <?= ($item['tax_rate_id'] !== "0" && $item['tax_rate_id'] !== null && $item['tax_rate_id'] !== "No tax provided") ? '<div class="table-row-icon table-checkbox"><input class="form-check-input select-one table-select" type="checkbox" disabled checked></div>' : 'No tax provided' ?>
                                    </td>
                                    <!-- <td>
                                        <?php if ($item['tax_rate_id'] !== "0" && $item['tax_rate_id'] !== null && $item['tax_rate_id'] !== "No tax provided") : ?>
                                            <div class="table-row-icon table-checkbox">
                                                <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                            </div>
                                        <?php endif; ?> -->
                                    </td>
                                    <td><?= $item['qty_on_hand'] ?: '0' ?></td>
                                    <td><?= $item['qty_po'] ?: '0' ?></td>
                                    <td><?= $item['reorder_point'] ?: '0' ?></td>
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
                <span class="modal-title content-title" id="print_preview_items_modal_label">Print items List</span>
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
                        <?php if (count($items) > 0) : ?>
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary nsm-link default"><?= $item['name'] ?><?= $item['status'] === '0' ? ' (deleted)' : '' ?></td>
                                    <td><?= $item['sku'] ?></td>
                                    <td><?= $item['type'] ?></td>
                                    <td><?= $item['sales_desc'] ?></td>
                                    <td data-incomeaccountid="<?= $item['income_account_id'] ?>"><?= $item['income_account'] ?></td>
                                    <td data-expenseaccountid="<?= $item['expense_account_id'] ?>"><?= $item['expense_account'] ?></td>
                                    <td data-inventoryaccountid="<?= $item['inventory_account_id'] ?>"><?= $item['inventory_account'] ?></td>
                                    <td><?= $item['purch_desc'] ?></td>
                                    <td><?= $item['sales_price'] ?></td>
                                    <td><?= $item['cost'] ?></td>
                                    <td>
                                        <?php if ($item['tax_rate_id'] !== "0" && $item['tax_rate_id'] !== null && $item['tax_rate_id'] !== "") : ?>
                                            <div class="table-row-icon table-checkbox">
                                                <input class="form-check-input select-one table-select" type="checkbox" disabled checked>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $item['qty_on_hand'] ?></td>
                                    <td><?= $item['qty_po'] ?></td>
                                    <td><?= $item['reorder_point'] ?></td>
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

<!-- MODAL SECTION -->
<div class="modal fade nsm-modal" id="item-locations-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Item Locations</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mt-1 mb-1">
                        <table id="item-locations-table" class="nsm-table">
                            <thead>
                                <tr>
                                    <td class='d-none' data-name="Item_ID">Item ID</td>
                                    <td data-name="Location">Location</td>
                                    <td data-name="Quantity">Quantity</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL SECTION -->

<div class="modal fade nsm-modal" id="import-items-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Import Items</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process to import all your items.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="progress-wrapper" style="padding-bottom: 100px;">
                            <div id="progress-bar-container">
                                <ul>
                                    <li class="step step1 active">
                                        <div class="step-inner">Step 1</div>
                                    </li>
                                    <li class="step step2">
                                        <div class="step-inner">Step 2</div>
                                    </li>
                                    <li class="step step3">
                                        <div class="step-inner">Step 3</div>
                                    </li>
                                </ul>

                                <div id="line">
                                    <div id="line-progress"></div>
                                </div>

                                <div id="progress-content-section">
                                    <div class="section-content step1 active">
                                        <h2>Step 1</h2>
                                        <p>Select and CSV Upload</p>

                                        <form id="import_item" enctype="multipart/form-data" style="text-align: center;">
                                            <input id="file-upload" name="file" type="file" accept=".csv" />
                                            <input name="file2" value="1" type="hidden" />
                                            <br><br>
                                        </form>
                                    </div>

                                    <div class="section-content step2">
                                        <h2>Step 2</h2>
                                        <p>Map Headings</p>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Product/Service Name</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector0" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>SKU</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector1" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Type</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector2" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Sales Description</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector3" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Sales Price/Rate</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector4" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Rebatable</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector5" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Purchase Description</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector6" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Purchase Cost</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector7" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Location</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector8" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Quantity On Hand</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector9" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-start">
                                                <b>Reorder Point</b> <span class='mapping-line'></span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector10" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="result"></div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-primary btn-sm step step01" ><span class="fa fa-arrow-left"></span> Back</button>
                                        <button type="button" class="btn btn-primary btn-sm step step03" ><span class="fa fa-arrow-right"></span> Next</button> -->
                                    </div>
                                    <div class="section-content step3">
                                        <h2>Step 3</h2>
                                        <p>Items Preview </p>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table tbl" style="height: 100px;overflow-y: auto; overflow-x: hidden;border-collapse: collapse; ">
                                                    <thead>
                                                        <tr id='tableHeader'>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="imported_items"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="nsm-button primary step02" id="nextBtn1" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<div id="overlay">
    <div>
        <img src="<?= base_url() ?>/assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
        <center>
            <p>Processing...</p>
        </center>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#print-items-list").nsmPagination({
            itemsPerPage: 10,
        });
    });
</script>