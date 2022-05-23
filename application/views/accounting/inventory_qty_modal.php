<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="inventoryModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Inventory Quantity Adjustment #1</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="adjustmentDate">Adjustment Date</label>
                                <input type="date" name="adjustment_date" id="adjustmentDate" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2 offset-md-8">
                            <div class="form-group">
                                <label for="referenceNo">Reference no.</label>
                                <input type="text" name="reference_no" id="referenceNo" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inventoryAdjAccount">Inventory Adjustment Account</label>
                                <select name="inventory_adj_acc" id="inventoryAdjAccount" class="form-control">
                                    <option value="">Cost of Goods Sold</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12 p-0 mb-5">
                            <div class="inventory-table-container w-100">
                                <div class="inventory-table">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th>PRODUCT</th>
                                            <th>DESCRIPTION</th>
                                            <th>QTY ON HAND</th>
                                            <th>NEW QTY</th>
                                            <th>CHANGE IN QTY</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="inventory-table-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-outline-secondary border">Add lines</button>
                                            <button type="button" class="btn btn-outline-secondary border">Clear all lines</button>
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
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>