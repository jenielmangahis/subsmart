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
                <div class="modal-body pb-0">
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
                                <select name="inventory_adj_acc" id="inventoryAdjAccount" class="form-control" required>
                                    <optgroup label="Cost of Goods Sold">
                                        <option value="cogs-1">Cost of Goods Sold</option>
                                    </optgroup>
                                    <optgroup label="Expenses">
                                        <option value="expenses-1">Advertising</option>
                                    </optgroup>
                                    <optgroup label="Other Expense">
                                        <option value="oexpense-1">Miscellaneous</option>
                                    </optgroup>
                                    <optgroup label="Income">
                                        <option value="income-1">Billable Expense Income</option>
                                    </optgroup>
                                    <optgroup label="Other Income">
                                        <option value="oincome-1">Interest Earned</option>
                                    </optgroup>
                                    <optgroup label="Equity">
                                        <option value="equity-1">Additional Paid In Capital</option>
                                    </optgroup>
                                    <optgroup label="Other Current Assets">
                                        <option value="ocassets-1">Inventory Asset</option>
                                    </optgroup>
                                    <optgroup label="Other Assets">
                                        <option value="oassets-1">Shareholder Investment</option>
                                    </optgroup>
                                    <optgroup label="Bank">
                                        <option value="bank-1">Cash on hand</option>
                                    </optgroup>
                                    <optgroup label="Other Current Liabilities">
                                        <option value="ocliab-1">Alabama Department of Revenue Payable</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12 p-0 mb-5">
                            <div class="inventory-table-container w-100">
                                <div class="inventory-table">
                                    <table class="table table-bordered table-hover clickable" id="inventory-adjustments-table">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th width="20%">PRODUCT</th>
                                            <th width="20%">DESCRIPTION</th>
                                            <th width="15%">QTY ON HAND</th>
                                            <th width="15%">NEW QTY</th>
                                            <th width="15%">CHANGE IN QTY</th>
                                            <th></th>
                                        </thead>
                                        <tbody class="cursor-pointer">
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td>
                                                    <select name="product[]" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="1">test product</option>
                                                    </select>
                                                </td>
                                                <td></td>
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
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="inventory-table-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-outline-secondary border" data-target="#inventory-adjustments-table" onclick="addTableLines(event)">Add lines</button>
                                            <button type="button" class="btn btn-outline-secondary border" data-target="#inventory-adjustments-table" onclick="clearTableLines(event)">Clear all lines</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 p-0">
                            <div class="form-group">
                                <label for="memo">Memo</label>
                                <textarea name="memo" id="memo" class="form-control"></textarea>
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
                                <button type="submit" class="btn btn-success">
                                    Save and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and new</a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary btn-rounded border float-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>