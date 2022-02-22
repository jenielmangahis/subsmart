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
                                                <div class="col-md-2 d-flex align-items-center">
                                                    <div class="dropdown w-100">
                                                        <button class="btn btn-transparent w-100" type="button" id="findByInvoice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Find by invoice no.</button>
                                                        <div class="dropdown-menu p-3" style="width: 150%" aria-labelledby="findByInvoice">
                                                            <div class="form-group">
                                                                <label for="invoice-no">Invoice no.</label>
                                                                <input type="text" class="form-control" id="invoice-no">
                                                            </div>
                                                            <button class="btn-transparent float-left w-25" type="button" onclick="cancelFindByInvoice()">Cancel</button>
                                                            <button class="btn-transparent float-right w-25" type="button" onclick="findCustByInvoiceNo()">Find</button>
                                                        </div>
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
                                                <input type="text" name="ref_no" id="ref_no" class="form-control" <?=isset($payment) ? "value='$payment->ref_no'" : ''?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="deposit_to_account">Deposit to</label>
                                                <select name="deposit_to_account" id="deposit_to_account" class="form-control" required>
                                                    <?php if(isset($payment)) : ?>
                                                        <option value="<?=$payment->deposit_to?>"><?=$this->chart_of_accounts_model->getName($payment->deposit_to)?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="received-amount">Amount received</label>
                                                        <input type="number" name="received_amount" step=".01" class="form-control text-right" id="received-amount" value="0.00" onchange="convertToDecimal(this)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 display-with-customer hide">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Outstanding Transactions</h4>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-row">
                                                        <div class="col-3">
                                                            <input type="text" name="search" id="search-invoice-no" class="form-control" placeholder="Find Invoice No.">
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="dropdown d-inline-block d-flex align-items-center h-100">
                                                                <a href="javascript:void(0);" class="btn btn-transparent hide-toggle" id="invoicesFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter <i class="fa fa-chevron-right"></i></a>

                                                                <div class="dropdown-menu p-3 w-auto" aria-labelledby="invoicesFilterDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <div class="inner-filter-list">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group" style="margin: 0 !important">
                                                                                            <label for="invoices-from">Invoices from</label>
                                                                                            <input type="text" name="invoices_from" id="invoices-from" class="form-control date" value="<?=date("m/d/Y")?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group" style="margin: 0 !important">
                                                                                            <label for="invoices-to">To</label>
                                                                                            <input type="text" name="invoices_to" id="invoices-to" class="form-control date" value="<?=date("m/d/Y")?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <div class="checkbox checkbox-sec">
                                                                                        <input type="checkbox" name="overdue_invoices_only" id="overdue_invoices_only" class="form-check-input" value="1">
                                                                                        <label for="overdue_invoices_only" class="form-check-label">Overdue invoices only</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="btn-group">
                                                                            <a href="#" class="btn-main" id="reset-btn" onclick="resetInvoicesFilter(event)">Reset</a>
                                                                            <a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applyInvoicesFilter(event)">Apply</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="action-bar h-100 d-flex align-items-center">
                                                        <ul class="ml-auto">
                                                            <li class="">
                                                                <a class="hide-toggle dropdown-toggle" type="button" id="invoices" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-cog"></i>
                                                                </a>
                                                                <div class="dropdown-menu p-3" aria-labelledby="invoices" x-placement="bottom-start" style="position: absolute; transform: translate3d(970px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <p class="m-0">Rows</p>
                                                                    <p class="m-0">
                                                                        <select name="table_rows" id="invoices_table_rows" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                            <option value="50" selected>50</option>
                                                                            <option value="75">75</option>
                                                                            <option value="100">100</option>
                                                                            <option value="150">150</option>
                                                                            <option value="300">300</option>
                                                                        </select>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 my-3">
                                                    <table class="table table-bordered table-hover clickable" id="invoices-table">
                                                        <thead>
                                                            <th>
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="checkbox checkbox-sec m-0">
                                                                        <input type="checkbox" id="select-all-invoices">
                                                                        <label for="select-all-invoices" class="p-0" style="width: 24px; height: 24px"></label>
                                                                    </div>
                                                                </div>
                                                            </th>
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
                                        <div class="col-md-4 offset-md-8 display-with-customer hide">
                                            <table class="bg-transparent float-right table text-right w-50">
                                                <tbody>
                                                    <tr>
                                                        <td class="border-0">Amount to Apply</td>
                                                        <td class="border-0"><span class="amount-to-apply">$0.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-0">Amount to Credit</td>
                                                        <td class="border-0"><span class="amount-to-credit">$0.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-0"></td>
                                                        <td class="border-0"><button type="button" class="btn btn-transparent" id="clear-payment">Clear payment</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="memo">Memo</label>
                                                        <textarea name="memo" id="memo" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="receive-payment-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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