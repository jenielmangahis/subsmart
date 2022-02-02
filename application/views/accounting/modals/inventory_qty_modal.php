<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($adjustment)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/inventory-qty-adjust/<?=$adjustment->id?>">
<?php endif; ?>
    <div id="inventoryModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-history fa-lg"></i>
                                </a>
                                <div class="dropdown-menu" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Transactions</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-qty-adjustments">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Inventory Quantity Adjustment #<?=$adjustment_no?>
                            </h4>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="adjustmentDate">Adjustment Date</label>
                                                <input type="text" class="form-control date" name="adjustment_date" id="adjustmentDate" value="<?=!isset($adjustment) ? date('m/d/Y') : date('m/d/Y', strtotime($adjustment->adjustment_date)) ?>"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 offset-md-8">
                                            <div class="form-group">
                                                <label for="referenceNo">Reference no.</label>
                                                <input type="number" required name="reference_no" id="referenceNo" class="form-control" value="<?=$adjustment_no?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="inventoryAdjAccount">Inventory Adjustment Account</label>
                                                <select name="inventory_adj_account" id="inventory_adj_account" class="form-control" required>
                                                    <?php if(isset($adjustment)) : ?>
                                                    <option value="<?=$adjustment->account->id?>"><?=$adjustment->account->name?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-5">
                                            <?php if(isset($adjustment)) : ?>
                                            <div class="new-adjustments">
                                                <button class="btn" type="button" data-toggle="collapse" data-target="#new-adjustments" aria-expanded="true" aria-controls="new-adjustments">
                                                    <i class="fa fa-caret-down"></i> New adjustments
                                                </button>
                                                <div class="collapse show" id="new-adjustments">
                                            <?php endif; ?>
                                                    <div class="inventory-table-container w-100">
                                                        <div class="inventory-table">
                                                            <table class="table table-bordered table-hover clickable" id="inventory-adjustments-table">
                                                                <thead>
                                                                    <th></th>
                                                                    <th>#</th>
                                                                    <th width="20%">PRODUCT</th>
                                                                    <th width="20%">DESCRIPTION</th>
                                                                    <th width="15%">LOCATION</th>
                                                                    <th width="10%">QTY ON HAND</th>
                                                                    <th width="10%">NEW QTY</th>
                                                                    <th width="10%">CHANGE IN QTY</th>
                                                                    <th></th>
                                                                </thead>
                                                                <tbody class="cursor-pointer">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td>
                                                                            <select name="product[]" class="form-control" required></select>
                                                                        </td>
                                                                        <td></td>
                                                                        <td>
                                                                            <select name="location[]" class="form-control" required></select>
                                                                        </td>
                                                                        <td></td>
                                                                        <td><input type="number" name="new_qty[]" class="form-control text-right" required></td>
                                                                        <td><input type="number" name="change_in_qty[]" class="form-control text-right" required></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>2</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-footer">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#inventory-adjustments-table" onclick="addTableLines(event)">Add lines</button>
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#inventory-adjustments-table" onclick="clearTableLines(event)">Clear all lines</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php if(isset($adjustment)) : ?>
                                                </div>
                                            </div>

                                            <div class="previous-adjustments">
                                                <button class="btn" type="button" data-toggle="collapse" data-target="#previous-adjustments" aria-expanded="true" aria-controls="previous-adjustments">
                                                    <i class="fa fa-caret-down"></i> Previous adjustments
                                                </button>

                                                <div class="collapse show" id="previous-adjustments">
                                                    <div class="previous-adjustment-table-container w-100">
                                                        <div class="previous-adjustment-table">
                                                            <table class="table table-bordered table-hover" id="previous-adjustments-table">
                                                                <thead>
                                                                    <th>#</th>
                                                                    <th width="20%">PRODUCT</th>
                                                                    <th width="20%">DESCRIPTION</th>
                                                                    <th width="15%">LOCATION</th>
                                                                    <th width="10%">CHANGE IN QTY</th>
                                                                    <th></th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $count = 1; ?>
                                                                    <?php foreach($adjustedProds as $adjustedProd) : ?>
                                                                    <tr>
                                                                        <td><?=$count?></td>
                                                                        <td>
                                                                            <select name="adjusted_product[]" class="form-control" required>
                                                                                <option value="<?=$adjustedProd->product_id?>"><?=$adjustedProd->product->title?></option>
                                                                            </select>
                                                                        </td>
                                                                        <td><?=$adjustedProd->product->description?></td>
                                                                        <td>
                                                                            <select name="adjusted_location[]" class="form-control" required>
                                                                                <?php foreach($adjustedProd->locations as $location) : ?>
                                                                                    <option value="<?=$location['id']?>" <?=$location['id'] === $adjustedProd->location_id ? 'selected' : ''?>><?=$location['name']?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="adjusted_change_in_qty[]" class="form-control text-right" value="<?=$adjustedProd->change_in_quantity?>" required>
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $count++; endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-footer">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#previous-adjustments-table" onclick="clearTableLines(event)">Clear all lines</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control"><?=$adjustment->memo?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4 d-flex">

                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right ml-2">
                                <button type="button" class="btn btn-success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary btn-rounded border float-right" id="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>