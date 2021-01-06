<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="depositModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Bank Deposit</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="bankAccount">Account</label>
                                        <select name="bank_account" id="bankAccount" class="form-control">
                                            <option value="">Cash on hand</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex ">
                                    <p style="align-self: flex-end; margin-bottom: 30px">Balance -$695.00</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-right">AMOUNT</h6>
                            <h2 class="text-right">$0.00</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div id="label">
                                    <label for="tags">Tags</label>
                                    <span class="float-right"><a href="#" class="text-info">Manage tags</a></span>
                                </div>
                                <input type="text" name="tags" id="tags" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12 p-0 mb-5">
                            <a href="#" class="text-info mb-3">Don't see the payments you want to deposit?</a>

                            <div class="funds-table-container w-100">
                                <div class="funds-table-header">
                                    <h4>Add funds to this deposit</h4>
                                </div>
                                <div class="funds-table">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th>RECEIVED FROM</th>
                                            <th>ACCOUNT</th>
                                            <th>DESCRIPTION</th>
                                            <th>PAYMENT METHOD</th>
                                            <th>REF NO.</th>
                                            <th>AMOUNT</th>
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
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="funds-table-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-outline-secondary border">Add lines</button>
                                            <button type="button" class="btn btn-outline-secondary border">Clear all lines</button>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="other-funds-total">
                                                <span class="float-right ml-5">$0.00</span>
                                                <span class="float-right">Other funds total</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 p-0">
                            <div class="form-group">
                                <label for="memo">Memo</label>
                                <textarea name="memo" id="memo" class="form-control w-50"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cashBackTarget">Cash back goes to</label>
                                        <select name="cash_back_target" id="cashBackTarget" class="form-control">
                                            <option value="">Cash on hand</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cashBackMemo">Cash back memo</label>
                                        <textarea name="cash_back_memo" id="cashBackMemo" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cashBackAmount">Cash back amount</label>
                                        <input type="number" name="cash_back_amount" id="cashBackAmount" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="cash-back-total">
                                        <span class="float-right ml-5">$0.00</span>
                                        <span class="float-right">Total </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 p-0">
                            <div class="attachments">
                                <div class="attachments-header">
                                    <button type="button">Attachments</button>
                                    <span>Maximum size: 20MB</span>
                                </div>
                                <div class="attachments-list">
                                    <div class="attachments-container border">
                                        <div class="attachments-container-label">
                                            Drag/Drop files here or click the icon
                                        </div>
                                    </div>
                                </div>
                                <div class="attachments-footer w-100 d-flex">
                                    <span class="m-auto"><a href="#" class="text-info">Show existing</a></span>
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