<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="transferModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form onsubmit="submitModalForm(event)" id="modal-form">
                <input type="hidden" name="modal_name" value="transfer">
                <div class="modal-content" style="height: 100%;">
                    <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                        <h4 class="modal-title">Transfer</h4>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>

                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group w-50">
                                    <label for="transferFrom">Transfer Funds From</label>
                                    <select name="transfer_from" id="transferFrom" class="form-control" required>
                                        <option value="1">Cash on hand</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transferFromBalance">Balance</label>
                                    <h3 id="transferFromBalance">$ -695.00</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group w-50">
                                    <label for="transferTo">Transfer Funds To</label>
                                    <select name="transfer_to" id="transferTo" class="form-control" required>
                                        <option value="1">Cash on hand</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transferToBalance">Balance</label>
                                    <h3 id="transferToBalance">$ -695.00</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group w-50">
                                    <label for="transferAmount">Transfer Amount</label>
                                    <input type="number" name="transfer_amount" id="transferAmount" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group w-50">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="memo">Memo</label>
                                    <textarea name="memo" id="memo" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                            <div class="col-md-4 p-0">
                                <div class="transfer-attachments attachments">
                                    <div class="attachments-header">
                                        <button type="button" onclick="document.getElementById('transfer-attachments').click();">Attachments</button>
                                        <span>Maximum size: 20MB</span>
                                    </div>
                                    <div class="attachments-list">
                                        <div class="attachments-container border" onclick="document.getElementById('transfer-attachments').click();">
                                            <div class="attachments-container-label">
                                                Drag/Drop files here or click the icon
                                            </div>
                                        </div>
                                    </div>
                                    <div class="attachments-footer w-100 d-flex">
                                        <span class="m-auto"><a href="#" class="text-info">Show existing</a></span>
                                    </div>
                                    <input type="file" name="attachments[]" id="transfer-attachments" class="hide" multiple="multiple">
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
                                <a href="#" class="text-white m-auto">Make Recurring</a>
                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group dropup float-right">
                                    <button type="submit" class="btn btn-success">
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
            </form>

        </div>
    </div>
    <!--end of modal-->
</div>