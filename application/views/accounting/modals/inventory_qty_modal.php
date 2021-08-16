<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="inventoryModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Inventory Quantity Adjustment #<?php echo $adjustment_no; ?></h4>
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
                                                <input type="text" class="form-control date" name="adjustment_date" id="adjustmentDate" value="<?php echo date('m/d/Y') ?>"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 offset-md-8">
                                            <div class="form-group">
                                                <label for="referenceNo">Reference no.</label>
                                                <input type="number" required name="reference_no" id="referenceNo" class="form-control" value="<?php echo $adjustment_no; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="inventoryAdjAccount">Inventory Adjustment Account</label>
                                                <select name="inventory_adj_acc" id="inventory_adj_account" class="form-control" required></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-5">
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
                                                                    <select name="product[]" class="form-control" required>
                                                                        <option value="" disabled selected>&nbsp;</option>
                                                                        <?php foreach($items as $item) : ?>
                                                                            <option value="<?=$item->id?>"><?=$item->title?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <select name="location[]" class="form-control"></select>
                                                                </td>
                                                                <td></td>
                                                                <td><input type="number" name="new_qty[]" class="form-control text-right" required></td>
                                                                <td><input type="number" name="change_in_qty[]" class="form-control text-right" required></td>
                                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
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
                                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
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
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control"></textarea>
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
                                <button type="button" class="btn btn-success" id="save-and-close">
                                    Save and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="save-and-new">Save and new</a>
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