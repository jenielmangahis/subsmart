<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="billPaymentModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title"><a href="#"><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>Bill Payment #<span><?=$billPayment->to_print_check_no === "1" ? "To print" : $billPayment->starting_check_no?></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="payee">Payee</label>
                                                        <select name="payee_id" id="payee" class="form-control" required>
                                                            <option value="" disabled selected>&nbsp;</option>
                                                            <?php foreach($dropdown['payees'] as $payee) : ?>
                                                                <option value="<?=$payee->id?>" <?=$payee->id === $vendor->id ? 'selected' : ''?>><?=$payee->display_name?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="payment_account">Payment account</label>
                                                        <select name="payment_account" id="payment_account" class="form-control" required>
                                                            <?php foreach($dropdown['payment_accounts'] as $accType => $accounts) : ?>
                                                                <optgroup label="<?=$accType?>">
                                                                    <?php foreach($accounts as $account) : ?>
                                                                        <option value="<?=$account->id?>"><?=$account->name?></option>

                                                                        <?php if(count($account->childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                                <?php foreach($account->childAccs as $childAcc) : ?>
                                                                                    <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                                <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </optgroup>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">AMOUNT PAID</h6>
                                            <h2 class="text-right">$0.00</h2>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="mailing_address">Mailing address</label>
                                                <textarea name="mailing_address" id="mailing_address" class="form-control">
                                                    <?=$vendor->title !== "" ? $vendor->title." " : ""?>
                                                    <?=$vendor->f_name !== "" ? $vendor->f_name." " : ""?>
                                                    <?=$vendor->m_name !== "" ? $vendor->m_name." " : ""?>
                                                    <?=$vendor->l_name !== "" ? $vendor->l_name." " : ""?>
                                                    <?=$vendor->suffix !== "" ? $vendor->suffix."\n" : ""?>
                                                    <?=$vendor->street !== "" ? $vendor->street : ""?>
                                                    <?=$vendor->city !== "" ? "\n".$vendor->city : ""?>
                                                    <?=$vendor->state !== "" ? ", ".$vendor->state : ""?>
                                                    <?=$vendor->zip !== "" ? " ".$vendor->zip : ""?>
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="payment_date">Payment date</label>
                                                <input type="text" name="payment_date" id="payment_date" class="form-control date" value="<?=date("m/d/Y", strtotime($billPayment->payment_date))?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="starting_check_no">Ref no.</label>
                                                <input type="text" name="starting_check_no" id="starting_check_no" class="form-control" value="<?=$billPayment->to_print_check_no === "1" ? "To print" : $billPayment->starting_check_no?>" <?=$billPayment->to_print_check_no === "1" ? "disabled" : ""?>>
                                                <div class="form-check">
                                                    <input type="checkbox" name="print_later" id="print_later" class="form-check-input" <?=$billPayment->to_print_check_no === "1" ? "checked" : ""?>>
                                                    <label for="print_later" class="form-check-label">Print later</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9"></div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" class="form-control" value="" onchange="convertToDecimal(this)">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Outstanding Transactions</h4>
                                                    <table class="table table-bordered table-hover clickable" id="bills-table">
                                                        <thead>
                                                            <th></th>
                                                            <th>DESCRIPTION</th>
                                                            <th>DUE DATE</th>
                                                            <th>ORIGINAL AMOUNT</th>
                                                            <th>OPEN BALANCE</th>
                                                            <th>PAYMENT</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="memo">Memo</label>
                                                        <textarea name="memo" id="memo" class="form-control"><?=$billPayment->memo?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="bill-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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

        </div>
    </div>
    <!--end of modal-->
</form>
</div>