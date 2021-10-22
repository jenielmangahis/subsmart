<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="transferModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group w-50">
                                                <label for="transfer_from_account">Transfer Funds From</label>
                                                <select name="transfer_from_account" id="transfer_from_account" class="form-control" required>
                                                    <?php if(isset($transfer)) : ?>
                                                    <option value="<?=$transfer->transfer_from->id?>"><?=$transfer->transfer_from->name?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="transferFromBalance">Balance</label>
                                                <h3></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group w-50">
                                                <label for="transfer_to_account">Transfer Funds To</label>
                                                <select name="transfer_to_account" id="transfer_to_account" class="form-control" required>
                                                    <?php if(isset($transfer)) : ?>
                                                    <option value="<?=$transfer->transfer_to->id?>"><?=$transfer->transfer_to->name?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="transferToBalance">Balance</label>
                                                <h3></h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group w-50">
                                                <label for="transferAmount">Transfer Amount</label>
                                                <input type="number" name="transfer_amount" value="<?=number_format(floatval($transfer->transfer_amount), 2, '.', ',')?>" step="0.01" onchange="convertToDecimal(this)" id="transferAmount" class="form-control text-right" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group w-50">
                                                <label for="date">Date</label>
                                                <input type="text" class="form-control date" name="date" id="date" value="<?=!isset($transfer) ? date('m/d/Y') : date('m/d/Y', strtotime($transfer->transfer_date))?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group w-50">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control"><?=$transfer->transfer_memo?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="transfer-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                    <div class="dz-message" style="margin: 20px;border">
                                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                    </div>
                                                </div>
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
                            <a href="#" class="text-white m-auto" onclick="makeRecurring('transfer')">Make Recurring</a>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" id="save-and-new">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="save-and-close">Save and close</a>
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