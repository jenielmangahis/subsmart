<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($transfer)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/transfer/<?=$transfer->id?>">
<?php endif; ?>
    <div id="transferModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Transfers</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-transfers">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Transfer
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>

                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row">
                                <?php if($is_copy) : ?>
                                <div class="col-12">
                                    <div class="nsm-callout primary">
                                        <button><i class='bx bx-x'></i></button>
                                        <h6 class="mt-0">This is a copy</h6>
                                        <span>This is a copy of a transfer. Revise as needed and save the transfer.</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-2">
                                    <label for="transfer_from_account">Transfer Funds From</label>
                                    <select name="transfer_from_account" id="transfer_from_account" class="form-control nsm-field" required>
                                        <?php if(isset($transfer)) : ?>
                                        <option value="<?=$transfer->transfer_from->id?>"><?=$transfer->transfer_from->name?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-12 col-md-2 offset-md-1">
                                    <label for="">Balance</label>
                                    <h3><?=isset($transfer) ? str_replace('$-', '-$', '$'.number_format(floatval($transfer->transfer_from->balance), 2, '.', ',')) : ''?></h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <label for="transfer_to_account">Transfer Funds To</label>
                                    <select name="transfer_to_account" id="transfer_to_account" class="form-control nsm-field" required>
                                        <?php if(isset($transfer)) : ?>
                                        <option value="<?=$transfer->transfer_to->id?>"><?=$transfer->transfer_to->name?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-12 col-md-2 offset-md-1">
                                    <label for="">Balance</label>
                                    <h3><?=isset($transfer) ? str_replace('$-', '-$', '$'.number_format(floatval($transfer->transfer_to->balance), 2, '.', ',')) : ''?></h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <label for="transferAmount">Transfer Amount</label>
                                    <input type="number" name="transfer_amount" value="<?=isset($transfer) ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : ''?>" step="0.01" onchange="convertToDecimal(this)" id="transferAmount" class="form-control nsm-field text-end" required>
                                </div>

                                <div class="col-12 col-md-2 offset-md-1">
                                    <label for="date">Date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" class="form-control nsm-field mb-2 date" name="date" id="date" value="<?=!isset($transfer) ? date('m/d/Y') : ($transfer->transfer_date !== "" && !is_null($transfer->transfer_date) ? date("m/d/Y", strtotime($transfer->transfer_date)) : "")?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label for="memo">Memo</label>
                                    <textarea name="memo" id="memo" class="form-control nsm-field mb-2"><?=$transfer->transfer_memo?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="attachments">
                                        <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                        <span>Maximum size: 20MB</span>
                                        <div id="transfer-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                            <div class="dz-message" style="margin: 20px;border">
                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="#" id="show-existing-attachments" class="text-decoration-none">Show existing</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4 <?=!isset($transfer) ? 'd-flex' : ''?>">
                            <?php if(!isset($transfer)) : ?>
                            <a href="#" class="text-dark text-decoration-none m-auto" onclick="makeRecurring('transfer')">Make Recurring</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('transfer')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="void-transfer">Void</a>
                                                <a class="dropdown-item" href="#" id="delete-transfer">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" onclick="saveAndNewForm(event)">
                                    Save and new
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
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