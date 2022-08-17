<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($ccPayment)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/credit-card-payment/<?=$ccPayment->id?>">
<?php endif; ?>
    <div id="payDownCreditModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-history fa-lg"></i>
                                </a>
                                <div class="dropdown-menu" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Transactions</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-cc-payments">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Pay down credit card
                            </h4>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Record payments made to your balance</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="credit_card_account">Which credit card did you pay?</label>
                                                <select name="credit_card_account" id="credit_card_account" class="form-control" required>
                                                    <?php if(isset($ccPayment)) : ?>
                                                        <option value="<?=$ccPayment->credit_card_id?>"><?=$this->chart_of_accounts_model->getName($ccPayment->credit_card_id)?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="vendor">Payee (optional)</label>
                                                <select name="payee" id="vendor" class="form-control" required>
                                                    <?php if(isset($ccPayment) && !is_null($ccPayment->payee_id) && $ccPayment->payee_id !== "") : ?>
                                                        <option value="<?=$ccPayment->payee_id?>"><?=$this->vendors_model->get_vendor_by_id($ccPayment->payee_id)->display_name?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">How much did you pay?</label>
                                                        <input type="number" name="amount" id="amount" <?=isset($ccPayment) ? "value='".number_format(floatval($ccPayment->amount), 2, '.', ',')."'" : ""?> class="form-control text-right" onchange="convertToDecimal(this)" step="0.01" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="paymentDate">Date of payment</label>
                                                        <input type="text" class="form-control date" name="payment_date" id="paymentDate" value="<?=isset($ccPayment) ? date('m/d/Y', strtotime($ccPayment->date)) : date('m/d/Y') ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="bank_account">What did you use to make this payment?</label>
                                                <select name="bank_account" id="bank_account" class="form-control" required>
                                                    <?php if(isset($ccPayment)) : ?>
                                                        <option value="<?=$ccPayment->bank_account_id?>"><?=$this->chart_of_accounts_model->getName($ccPayment->bank_account_id)?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 text-right">
                                            <p class="m-0">
                                                <?php if(isset($ccPayment)) : ?>
                                                    <?=$ccPayment->status === "4" ? "PAYMENT STATUS" : "TOTAL PAID" ?>
                                                <?php else : ?>
                                                    Total paid
                                                <?php endif; ?>
                                            </p>
                                            <h2 class="m-0" id="total-amount-paid">
                                                <?php if(isset($ccPayment)) : ?>
                                                    <?php if($ccPayment->status === "4") : ?>
                                                        VOID
                                                    <?php else : ?>
                                                        <?php
                                                            $amount = '$'.number_format(floatval($ccPayment->amount), 2, '.', ',');
                                                            $amount = str_replace('$-', '-$', $amount);
                                                            echo $amount;
                                                        ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    $0.00
                                                <?php endif; ?>
                                            </h2>
                                        </div>

                                        <div class="col-md-4">
                                            <h5>Memo and attachments</h5>
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control"><?=isset($ccPayment) ? str_replace("<br />", "", $ccPayment->memo) : ''?></textarea>
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
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="#" id="show-existing-attachments" class="text-info">Show existing</a>
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
                            <?php if(isset($ccPayment)) : ?>
                            <div class="dropup m-auto">
                                <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                <div class="dropdown-menu">
                                    <?php if($ccPayment->status !== "4") : ?>
                                        <a class="dropdown-item" href="#" id="void-credit-card-payment">Void</a>
                                    <?php endif; ?>
                                    <a class="dropdown-item" href="#" id="delete-credit-card-payment">Delete</a>
                                    <a class="dropdown-item" href="#">Transaction journal</a>
                                    <a class="dropdown-item" href="#">Audit history</a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" onclick="saveAndNewForm(event)">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
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
    <!--end of modal-->
</form>
</div>