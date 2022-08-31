<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($ccPayment)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/credit-card-payment/<?=$ccPayment->id?>">
<?php endif; ?>
    <div id="payDownCreditModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Transactions</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-cc-payments">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Pay down credit card
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <h6>Record payments made to your balance</h6>
                                </div>

                                <div class="col-12 col-md-6 grid-mb">
                                    <label for="credit_card_account">Which credit card did you pay?</label>
                                    <select name="credit_card_account" id="credit_card_account" class="form-control nsm-field" required>
                                        <?php if(isset($ccPayment)) : ?>
                                            <option value="<?=$ccPayment->credit_card_id?>"><?=$this->chart_of_accounts_model->getName($ccPayment->credit_card_id)?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 offset-md-3 text-end grid-mb">
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
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 grid-mb">
                                    <label for="vendor">Payee (optional)</label>
                                    <select name="payee" id="vendor" class="form-control nsm-field" required>
                                        <?php if(isset($ccPayment) && !is_null($ccPayment->payee_id) && $ccPayment->payee_id !== "") : ?>
                                            <option value="<?=$ccPayment->payee_id?>"><?=$this->vendors_model->get_vendor_by_id($ccPayment->payee_id)->display_name?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 grid-mb">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="amount">How much did you pay?</label>
                                            <input type="number" name="amount" id="amount" <?=isset($ccPayment) ? "value='".number_format(floatval($ccPayment->amount), 2, '.', ',')."'" : ""?> class="form-control nsm-field text-end" onchange="convertToDecimal(this)" step="0.01" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="paymentDate">Date of payment</label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" class="form-control nsm-field date" name="payment_date" id="paymentDate" value="<?=isset($ccPayment) ? date('m/d/Y', strtotime($ccPayment->date)) : date('m/d/Y') ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 grid-mb">
                                    <label for="bank_account">What did you use to make this payment?</label>
                                    <select name="bank_account" id="bank_account" class="form-control nsm-field" required>
                                        <?php if(isset($ccPayment)) : ?>
                                            <option value="<?=$ccPayment->bank_account_id?>"><?=$this->chart_of_accounts_model->getName($ccPayment->bank_account_id)?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="accordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-memo-attachments" aria-expanded="true" aria-controls="collapse-memo-attachments">
                                                    Memo and attachments
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse show" id="collapse-memo-attachments">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            <label for="memo">Memo</label>
                                                            <textarea name="memo" id="memo" class="form-control nsm-field mb-2"><?=isset($ccPayment) ? str_replace("<br />", "", $ccPayment->memo) : ''?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="attachments">
                                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                                <span>Maximum size: 20MB</span>
                                                                <div id="cc-payment-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                        <div class="col-md-4 d-flex">
                            <?php if(isset($ccPayment)) : ?>
                            <div class="dropup m-auto">
                                <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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