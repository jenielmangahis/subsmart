<style>
#inventoryModal .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
.span-input{
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    text-align:right;
}
</style>
<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <?php if (!isset($adjustment)) : ?>
        <form onsubmit="submitModalForm(event, this)" id="modal-form">
        <?php else : ?>
            <form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/inventory-qty-adjust/<?= $adjustment->id ?>">
            <?php endif; ?>
            <div id="inventoryModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                            <h5 class="dropdown-header">Recent Transactions</h5>
                                            <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-qty-adjustments">
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <span class="modal-title content-title">
                                        Inventory Quantity Adjustment <span>#<?= $adjustment_no ?></span>
                                    </span>
                                </div>
                            </div>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label class="control-label" for="adjustmentDate">Adjustment Date</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="date" style="width:50%;" class="form-control nsm-field" name="adjustment_date" id="adjustmentDate" value="<?= !isset($adjustment) ? date('Y-m-d') : date('Y-m-d', strtotime($adjustment->adjustment_date)) ?>" />
                                                </div>
                                                <label for="inventoryAdjAccount" class="mt-2">Inventory Adjustment Account</label>
                                                <select name="inventory_adj_account" id="inventory_adj_account" class="form-control nsm-field" required>
                                                    <?php if (isset($adjustment)) : ?>
                                                        <option value="<?= $adjustment->account->id ?>"><?= $adjustment->account->name ?></option>
                                                    <?php endif; ?>
                                                </select>
                                                <label class="control-label mt-2" for="referenceNo">Reference no.</label>
                                                <input type="number" required name="reference_no" id="referenceNo" class="form-control nsm-field" value="<?= $adjustment_no ?>">

                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="memo">Memo</label>
                                                <textarea name="memo" id="memo" style="width:400px !important;height:159px !important;" class="nsm-field form-control"><?= isset($adjustment) ? str_replace("<br />", "", $adjustment->memo) : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 grid-mb">
                                            <?php if (isset($adjustment)) : ?>
                                                <div class="accordion grid-mb">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-new-adjustments" aria-expanded="true" aria-controls="collapse-new-adjustments">
                                                                New adjustments
                                                            </button>
                                                        </h2>
                                                        <div id="collapse-new-adjustments" class="accordion-collapse collapse show">
                                                            <div class="accordion-body">
                                                            <?php endif; ?>
                                                            <table class="nsm-table clickable" id="inventory-adjustments-table">
                                                                <thead>
                                                                    <tr>
                                                                        <td data-name="Num">#</td>
                                                                        <td data-name="Product">PRODUCT</td>
                                                                        <td data-name="Description">DESCRIPTION</td>
                                                                        <td data-name="Location">LOCATION</td>
                                                                        <td data-name="Qty on Hand">QTY ON HAND</td>
                                                                        <td data-name="New Qty">NEW QTY</td>
                                                                        <td data-name="Change in Qty">CHANGE IN QTY</td>
                                                                        <td data-name="Manage"></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td style="width: 25%;">
                                                                            <select name="product[]" class="form-control nsm-field" required></select>
                                                                        </td>
                                                                        <td style="width: 30%;"><input type="text" name="description[]" class="form-control nsm-field" required></td>
                                                                        <td style="width: 15%;">
                                                                            <select name="location[]" class="form-control nsm-field" required></select>
                                                                        </td>
                                                                        <td style="width:9rem;"><span class="span-input"></span></td>
                                                                        <td style="width:9rem;"><input type="number" name="new_qty[]" class="form-control nsm-field text-end" required></td>
                                                                        <td style="width:9rem;"><input type="number" name="change_in_qty[]" class="form-control nsm-field text-end" required></td>
                                                                        <td>
                                                                            <button type="button" class="nsm-button delete-row">
                                                                                <i class='bx bx-fw bx-trash'></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $count = 2; ?>
                                                                    <?php do { ?>
                                                                        <tr>
                                                                            <td><?= $count ?></td>
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
                                                                        </tr>
                                                                    <?php $count++;
                                                                    } while ($count <= 2) ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="11">
                                                                            <div class="nsm-page-buttons page-buttons-container">
                                                                                <button type="button" class="nsm-button" onclick="addTableLines(event)" data-target="#inventory-adjustments-table">
                                                                                    Add lines
                                                                                </button>
                                                                                <button type="button" class="nsm-button" onclick="clearTableLines(event)" data-target="#inventory-adjustments-table">
                                                                                    Clear all lines
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            <?php if (isset($adjustment)) : ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-previous-adjustments" aria-expanded="true" aria-controls="collapse-previous-adjustments">
                                                                Previous adjustments
                                                            </button>
                                                        </h2>
                                                        <div id="collapse-previous-adjustments" class="accordion-collapse collapse show">
                                                            <div class="accordion-body">
                                                                <table class="nsm-table" id="previous-adjustments-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td data-name="Num">#</td>
                                                                            <td data-name="Product">PRODUCT</td>
                                                                            <td data-name="Description">DESCRIPTION</td>
                                                                            <td data-name="Location">LOCATION</td>
                                                                            <td data-name="Change in Qty">CHANGE IN QTY</td>
                                                                            <td data-name="Manage"></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $count = 1; ?>
                                                                        <?php foreach ($adjustedProds as $adjustedProd) : ?>
                                                                            <tr>
                                                                                <td><?= $count ?></td>
                                                                                <td>
                                                                                    <select name="adjusted_product[]" class="form-control nsm-field" required>
                                                                                        <option value="<?= $adjustedProd->product_id ?>"><?= $adjustedProd->product->title ?></option>
                                                                                    </select>
                                                                                </td>
                                                                                <td><?= $adjustedProd->product->description ?></td>
                                                                                <td>
                                                                                    <select name="adjusted_location[]" class="form-control nsm-field" required>
                                                                                        <?php foreach ($adjustedProd->locations as $location) : ?>
                                                                                            <option value="<?= $location['id'] ?>" <?= $location['id'] === $adjustedProd->location_id ? 'selected' : '' ?>><?= $location['name'] ?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" name="adjusted_change_in_qty[]" class="form-control nsm-field text-end" value="<?= $adjustedProd->change_in_quantity ?>" required>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="nsm-button delete-row">
                                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        <?php $count++;
                                                                        endforeach; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="6">
                                                                                <div class="nsm-page-buttons page-buttons-container">
                                                                                    <button type="button" class="nsm-button" onclick="clearTableLines(event)" data-target="#previous-adjustments-table">
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
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-md-6">
                                    <!-- Split dropup button -->
                                    <div class="btn-group float-end" role="group">
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