<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="payDownCreditModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Pay down credit card</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12">
                            <h6>Record payments made to your balance</h6>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="creditCard">Which credit card did you pay?</label>
                                <select name="credit_card" id="creditCard" class="form-control" required>
                                    <option value="1">Test Credit Card</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payee">Payee (optional)</label>
                                <select name="payee" id="payee" class="form-control" required>
                                    <?php foreach($dropdown['vendors'] as $vendor) : ?>
                                        <option value="<?php echo $vendor->id; ?>"><?php echo $vendor->f_name . ' ' . $vendor->l_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">How much did you pay?</label>
                                        <input type="number" name="amount" id="amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paymentDate">Date of payment</label>
                                        <input type="date" name="payment_date" id="paymentDate" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bankAccount">What did you use to make this payment?</label>
                                <select name="bank_account" id="bankAccount" class="form-control" required>
                                    <option value="1">Cash on hand</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="m-0">Total paid</p>
                            <h2 class="m-0" id="total-amount-paid">$0.00</h2>
                        </div>

                        <div class="col-md-4">
                            <h5>Memo and attachments</h5>
                            <div class="form-group">
                                <label for="memo">Memo</label>
                                <textarea name="memo" id="memo" class="form-control"></textarea>
                            </div>

                            <div class="pay-down-attachments attachments">
                                <div class="attachments-header">
                                    <button type="button" onclick="document.getElementById('pay-down-attachments').click();">Attachments</button>
                                    <span>Maximum size: 20MB</span>
                                </div>
                                <div class="attachments-list">
                                    <div class="attachments-container border" onclick="document.getElementById('pay-down-attachments').click();">
                                        <div class="attachments-container-label">
                                            Drag/Drop files here or click the icon
                                        </div>
                                    </div>
                                </div>
                                <div class="attachments-footer w-100 d-flex">
                                    <span class="m-auto"><a href="#" class="text-info">Show existing</a></span>
                                </div>
                                <input type="file" name="attachments[]" id="pay-down-attachments" class="hide" multiple="multiple">
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