<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/vendors/<?=$ccPayment->payee_id?>/update-transaction/credit-card-payment/<?=$ccPayment->id?>">
    <div id="payDownCreditModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Pay down credit card</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Record payments made to your balance</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="credit_card_account">Which credit card did you pay?</label>
                                                <select name="credit_card" id="credit_card_account" class="form-control" required>
                                                    <option value="<?=$ccPayment->credit_card_id?>"><?=$this->chart_of_accounts_model->getName($ccPayment->credit_card_id)?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="vendor">Payee (optional)</label>
                                                <select name="payee" id="vendor" class="form-control" required>
                                                    <option value="<?=$ccPayment->payee_id?>"><?=$this->vendors_model->get_vendor_by_id($ccPayment->payee_id)->display_name?></option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">How much did you pay?</label>
                                                        <input type="number" name="amount" id="amount" class="form-control text-right" onchange="convertToDecimal(this)" step="0.01" value="<?=number_format(floatval($ccPayment->amount), 2, '.', ',')?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="paymentDate">Date of payment</label>
                                                        <input type="text" class="form-control date" name="payment_date" id="paymentDate" value="<?=date('m/d/Y', strtotime($ccPayment->date))?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="bank_account">What did you use to make this payment?</label>
                                                <select name="bank_account" id="bank_account" class="form-control" required>
                                                    <option value="<?=$ccPayment->bank_account_id?>"><?=$this->chart_of_accounts_model->getName($ccPayment->bank_account_id)?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 text-right">
                                            <p class="m-0"><?=$ccPayment->status === "4" ? "PAYMENT STATUS" : "TOTAL PAID" ?></p>
                                            <h2 class="m-0" id="total-amount-paid">
                                            <?php if($ccPayment->status === "4") : ?>
                                                VOID
                                            <?php else : ?>
                                                $<?=number_format(floatval($ccPayment->amount), 2, '.', ',')?>
                                            <?php endif; ?>
                                            </h2>
                                        </div>

                                        <div class="col-md-4">
                                            <h5>Memo and attachments</h5>
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control"><?=$ccPayment->memo?></textarea>
                                            </div>

                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="pay-down-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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