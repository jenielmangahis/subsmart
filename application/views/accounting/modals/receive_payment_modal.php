<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($payment)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/receive-payment/<?=$payment->id?>">
<?php endif; ?>
    <div id="receivePaymentModal" class="modal fade modal-fluid" role="dialog">
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
                                    <h5 class="dropdown-header">Recent Received Payments</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-received-payments">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Receive Payment <span></span>
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
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="customer">Customer</label>
                                                        <select name="customer" id="customer" class="form-control" required>
                                                            <?php if(isset($payment)) : ?>
                                                                <option value="<?=$payment->customer_id?>">
                                                                <?php
                                                                    $customer = $this->accounting_customers_model->get_by_id($payment->customer_id);
                                                                    echo $customer->first_name . ' ' . $customer->last_name;
                                                                ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex align-items-end">
                                                    <div>
                                                        <div class="dropdown">
                                                            <button class="btn btn-transparent w-100" type="button" id="findByInvoice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Find by invoice no.</button>
                                                            <div class="dropdown-menu p-3" style="width: 150%" aria-labelledby="findByInvoice">
                                                                <div class="form-group">
                                                                    <label for="invoice-no">Invoice no.</label>
                                                                    <input type="text" class="form-control" id="invoice-no">
                                                                </div>
                                                                <button class="btn-transparent float-left w-25">Cancel</button>
                                                                <button class="btn-transparent float-right w-25">Find</button>
                                                            </div>
                                                        </div>
                                                        <label for="">Dont have an invoice? <a href="#" class="text-info">Create a new sale</a></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                                AMOUNT
                                            </h6>
                                            <h2 class="text-right">
                                                <span class="transaction-total-amount">$0.00</span>
                                            </h2>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_date">Payment date</label>
                                                <input type="text" name="payment_date" id="payment_date" class="form-control date" value="<?=isset($payment) ? ($payment->payment_date !== "" && !is_null($payment->payment_date) ? date("m/d/Y", strtotime($payment->payment_date)) : "") : date("m/d/Y")?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_method">Payment method</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <?php if(isset($payment)) : ?>
                                                        <option value="<?=$payment->payment_method_id?>"><?=$this->accounting_payment_methods_model->getById($payment->payment_method_id)->name?></option>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="ref_no">Ref no.</label>
                                                <input type="text" name="ref_no" id="ref_no" class="form-control" <?=isset($expense) ? "value='$expense->ref_no'" : ''?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="deposit_to">Deposit to</label>
                                                <select name="deposit_to_account" id="deposit_to" class="form-control" required>
                                                    <?php if(isset($payment)) : ?>
                                                        <option value="<?=$payment->deposit_to?>"><?=$this->chart_of_accounts_model->getName($payment->deposit_to)?></option>
                                                    <?php endif; ?>
                                                </select>
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
                            <a href="#" class="text-white m-auto">Print</a>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
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