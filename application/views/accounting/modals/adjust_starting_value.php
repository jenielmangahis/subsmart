<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form action="/accounting/adjust-starting-value/<?=$item->id?>" method="post" id="modal-form">
<!-- <form onsubmit="submitModalForm(event, this)" id="modal-form"> -->
    <div id="adjust-starting-value-modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Inventory Starting Value <span>#START</span></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <span id="product-name"><strong><?=$item->title?></strong></span>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">VALUE</h6>
                                            <h2 class="text-right total-value">$0.00</h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="location">Location</label>
                                            <select name="location" id="location" class="form-control">
                                                <option disabled selected>&nbsp;</option>
                                                <?php foreach($locations as $location) : ?>
                                                    <option value="<?=$location['id']?>" data-initial_qty="<?=$location['initial_qty']?>"><?=$location['name']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="initialQty">Initial quantity on hand</label>
                                                <input type="number" name="initial_qty_on_hand" id="initialQty" class="form-control text-right">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="asOfDate">As of date</label>
                                                <input type="text" name="as_of_date" id="asOfDate" class="form-control" value="<?=!is_null($accountingDetails) ? date('m/d/Y', strtotime($accountingDetails->as_of_date)) : date('m/d/Y')?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2 offset-md-4">
                                            <div class="form-group">
                                                <label for="refNo">Reference no.</label>
                                                <input type="text" name="ref_no" id="refNo" class="form-control" value="START">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="initialCost">Initial cost</label>
                                                <input type="number" step="0.01" name="initial_cost" id="initialCost" value="<?=$item->cost?>" class="form-control text" onchange="convertToDecimal(this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Inventory asset account</label>
                                                <h6><?=$invAssetAcc->name?></h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="invAdjustmentAcc">Inventory adjustment account</label>
                                                <select name="inventory_adj_account" id="inventory_adj_account" class="form-control" required></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control"><?=$item->title?> - Opening inventory and value</textarea>
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
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white">Transaction Journal</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-white">Audit History</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <button type="button" class="btn btn-success float-right" id="save-and-close">
                                Save and close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>