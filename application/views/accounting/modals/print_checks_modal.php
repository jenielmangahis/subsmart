<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form id="modal-form">
    <div id="printChecksModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Print Checks</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="payment_account" id="payment_account" class="form-control" required>
                                                            <option value="<?=$account->id?>" selected><?=$account->name?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex">
                                                    <p style="align-self: center; margin-bottom: 30px">Balance <span id="account-balance"><?= $balance ?></span></p>
                                                </div>
                                                <div class="col-md-2 d-flex">
                                                    <p style="align-self: center; margin-bottom: 30px"><span id="selected-checks">0</span> checks selected $<span id="selected-checks-total">0.00</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-transparent float-right" type="button" id="add-check-button">Add check</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <div class="arrow-level-down" style="margin-left: 2rem">
                                                        <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                                    </div>
                                                    <button class="btn btn-transparent" type="button" id="remove-from-list">
                                                        Remove from list
                                                    </button>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <select name="sort" id="sort" class="form-control">
                                                        <option value="payee">Sort by Payee</option>
                                                        <option value="order-created">Sort by Order created</option>
                                                        <option value="date-payee">Sort by Date / Payee</option>
                                                        <option value="date-order-created" selected>Sort by Date / Order created</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <select name="check_type" id="check-type" class="form-control">
                                                        <option value="all" selected>Show all checks</option>
                                                        <option value="regular">Show regular checks</option>
                                                        <option value="bill-payment">Show bill payment checks</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <div class="form-group" style="margin: 0 !important">
                                                        <label for="starting-check-no">Starting check no.</label>
                                                        <input type="number" value="<?=$startingCheckNo?>" name="starting_check_no" id="starting-check-no" class="form-control" required min="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="action-bar h-100 d-flex align-items-end">
                                                <ul class="ml-auto">
                                                    <li><a href="#"><i class="fa fa-print"></i></a></li>
                                                    <li>
                                                        <a class="hide-toggle dropdown-toggle" type="button" id="billsRows" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-3" aria-labelledby="billsRows" x-placement="bottom-start" style="position: absolute; transform: translate3d(970px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <p class="m-0">Rows</p>
                                                            <p class="m-0">
                                                                <select name="table_rows" id="table_rows" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                    <option value="50">50</option>
                                                                    <option value="75">75</option>
                                                                    <option value="100">100</option>
                                                                    <option value="150" selected>150</option>
                                                                    <option value="300">300</option>
                                                                </select>
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-3">
                                            <table class="table table-bordered table-hover clickable" id="checks-table">
                                                <thead>
                                                    <th width="3%">
                                                        <div class="d-flex justify-content-center">
                                                            <input type="checkbox" id="select-all-checks">
                                                        </div>
                                                    </th>
                                                    <th>DATE</th>
                                                    <th>TYPE</th>
                                                    <th>PAYEE</th>
                                                    <th>AMOUNT</th>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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
                            <a href="#" class="text-white m-auto" id="print-checks-setup">Print setup</a>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success float-right" id="preview-and-print">
                                Preview and print
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