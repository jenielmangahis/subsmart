<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($payment)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/receive-payment/<?=$payment->id?>">
<?php endif; ?>
    <div id="receivePaymentModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Received Payments</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-receive-payments">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Receive Payment <span></span>
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 col-md-8 grid-mb">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <label for="customer">Customer</label>
                                            <select name="customer" id="customer" class="form-control nsm-field" required>
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
                                        <div class="col-12 col-md-2 d-flex align-items-end">
                                            <div class="dropdown">
                                                <button class="nsm-button" type="button" id="findByInvoice" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Find by invoice no.</button>
                                                <div class="dropdown-menu p-3" style="width: 150%" aria-labelledby="findByInvoice">
                                                    <div class="row">
                                                        <div class="col-12 grid-mb">
                                                            <label for="invoice-no">Invoice no.</label>
                                                            <input type="text" class="form-control nsm-field" id="invoice-no">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button class="nsm-button m-0" type="button" onclick="cancelFindByInvoice()">Cancel</button>
                                                            <button class="nsm-button m-0 float-end" type="button" onclick="findCustByInvoiceNo()">Find</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6>
                                        <?php if(!isset($payment)) : ?>
                                            AMOUNT
                                        <?php else : ?>
                                            <?php if($payment->status === '4') : ?>
                                                PAYMENT STATUS
                                            <?php else : ?>
                                                AMOUNT RECEIVED
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </h6>
                                    <h2>
                                        <span class="transaction-total-amount">
                                            <?php if(isset($payment)) : ?>
                                                <?php if($payment->status === '4') : ?>
                                                    VOID
                                                <?php else : ?>
                                                    <?php
                                                    $amount = '$'.number_format(floatval($payment->amount), 2, '.', ',');
                                                    $amount = str_replace('$-', '-$', $amount);
                                                    echo $amount;
                                                    ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                            $0.00
                                            <?php endif; ?>
                                        </span>
                                    </h2>
                                </div>

                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="payment_date">Payment date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="payment_date" id="payment_date" class="form-control nsm-field date" value="<?=isset($payment) ? ($payment->payment_date !== "" && !is_null($payment->payment_date) ? date("m/d/Y", strtotime($payment->payment_date)) : "") : date("m/d/Y")?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="payment_method">Payment method</label>
                                    <select name="payment_method" id="payment_method" class="form-control nsm-field">
                                        <?php if(isset($payment)) : ?>
                                            <option value="<?=$payment->payment_method?>"><?=$this->accounting_payment_methods_model->getById($payment->payment_method)->name?></option>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="ref_no">Ref no.</label>
                                    <input type="text" name="ref_no" id="ref_no" class="form-control nsm-field" value="<?=isset($payment) ? $payment->ref_no : ''?>">
                                </div>
                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="deposit_to_account">Deposit to</label>
                                    <select name="deposit_to_account" id="deposit_to_account" class="form-control nsm-field" required>
                                        <?php if(isset($payment)) : ?>
                                            <option value="<?=$payment->deposit_to?>"><?=$this->chart_of_accounts_model->getName($payment->deposit_to)?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 offset-md-4 grid-mb">
                                    <label for="received-amount">Amount received</label>
                                    <input type="number" name="received_amount" step=".01" class="form-control nsm-field text-end" id="received-amount" value="<?=isset($payment) ? number_format(floatval($payment->amount), 2, '.', ',') : "0.00"?>" onchange="convertToDecimal(this)">
                                </div>
                            </div>

                            <div class="row" id="invoices-container">
                                <div class="col-12 grid-mb">
                                    <h4>Outstanding Transactions</h4>
                                </div>
                                <div class="col-12 col-md-6 grid-mb">
                                    <div class="nsm-field-group search">
                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search-invoice-no" name="search" placeholder="Find Invoice No.">
                                    </div>
                                    <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                        Filter <i class="bx bx-fw bx-chevron-right"></i>
                                    </button>
                                    <ul class="dropdown-menu p-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="invoices-from">Invoices from</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="form-control nsm-field mb-2 date" id="invoices-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="invoices-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="form-control nsm-field mb-2 date" id="invoices-to">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" id="overdue-invoices-only">
                                                    <label for="overdue-invoices-only">Overdue invoices only</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="nsm-button m-0" type="button" onclick="resetInvoicesFilter(event)">Reset</button>
                                                <button class="nsm-button success float-end m-0" type="button" onclick="applyInvoicesFilter(event)">Apply</button>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6 grid-mb text-end">
                                    <div class="nsm-page-buttons page-button-container">
                                        <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                            <i class="bx bx-fw bx-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                            <p class="m-0">Rows</p>
                                            <div class="dropdown d-inline-block">
                                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                    <span>
                                                        50
                                                    </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" id="invoice-table-rows">
                                                    <li><a class="dropdown-item active" href="javascript:void(0);" onclick="invoiceTableRows(this)">50</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="invoiceTableRows(this)">75</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="invoiceTableRows(this)">100</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="invoiceTableRows(this)">150</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="invoiceTableRows(this)">300</a></li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 grid-mb">
                                    <table class="nsm-table" id="invoices-table">
                                        <thead>
                                            <tr>
                                                <td class="table-icon text-center">
                                                    <input class="form-check-input select-all table-select" type="checkbox">
                                                </td>
                                                <td data-name="Description">DESCRIPTION</td>
                                                <td data-name="Due Date">DUE DATE</td>
                                                <td data-name="Original Amount">ORIGINAL AMOUNT</td>
                                                <td data-name="Open Balance">OPEN BALANCE</td>
                                                <td data-name="Payment">PAYMENT</td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" id="credits-container">
                                <div class="col-12 grid-mb">
                                    <h4>Credits</h4>
                                </div>
                                <div class="col-12 col-md-6 grid-mb">
                                    <div class="nsm-field-group search">
                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search-credit-memo-no" name="search" placeholder="Find Credit Memo No.">
                                    </div>
                                    <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                        Filter <i class="bx bx-fw bx-chevron-right"></i>
                                    </button>
                                    <ul class="dropdown-menu p-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="credit-memo-from">Credit Memo from</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="form-control nsm-field mb-2 date" id="credit-memo-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="credit-memo-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="form-control nsm-field mb-2 date" id="credit-memo-to">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="nsm-button m-0" type="button" onclick="resetCreditMemoFilter(event)">Reset</button>
                                                <button class="nsm-button success float-end m-0" type="button" onclick="applyCreditMemoFilter(event)">Apply</button>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6 grid-mb text-end">
                                    <div class="nsm-page-buttons page-button-container">
                                        <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                            <i class="bx bx-fw bx-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                            <p class="m-0">Rows</p>
                                            <div class="dropdown d-inline-block">
                                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                    <span>
                                                        50
                                                    </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" id="credits-table-rows">
                                                    <li><a class="dropdown-item active" href="javascript:void(0);" onclick="creditsTableRows(this)">50</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="creditsTableRows(this)">75</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="creditsTableRows(this)">100</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="creditsTableRows(this)">150</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="creditsTableRows(this)">300</a></li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 grid-mb">
                                    <table class="nsm-table" id="credits-table">
                                        <thead>
                                            <tr>
                                                <td class="table-icon text-center">
                                                    <input class="form-check-input select-all table-select" type="checkbox">
                                                </td>
                                                <td data-name="Description">DESCRIPTION</td>
                                                <td data-name="Original Amount">ORIGINAL AMOUNT</td>
                                                <td data-name="Open Balance">OPEN BALANCE</td>
                                                <td data-name="Payment">PAYMENT</td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                           
                            <div class="row" id="payment-summary">
                                <div class="col-12 col-md-3 offset-md-9 grid-mb">
                                    <table class="nsm-table text-end">
                                        <tfoot>
                                            <tr>
                                                <td>Amount to Apply</td>
                                                <td>
                                                    <span class="amount-to-apply">
                                                        <?php if(isset($payment)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($payment->amount_to_apply), 2, '.', ',');
                                                        $amount = str_replace('$-', '-$', $amount);
                                                        echo $amount;
                                                        ?>
                                                        <?php else : ?>
                                                        $0.00
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Amount to Credit</td>
                                                <td>
                                                    <span class="amount-to-credit">
                                                        <?php if(isset($payment)) : ?>
                                                        <?php
                                                        $amount = '$'.number_format(floatval($payment->amount_to_credit), 2, '.', ',');
                                                        $amount = str_replace('$-', '-$', $amount);
                                                        echo $amount;
                                                        ?>
                                                        <?php else : ?>
                                                        $0.00
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><button type="button" class="nsm-button" id="clear-payment">Clear payment</button></td>
                                            </tr>
                                            <tr class="d-none">
                                                <td colspan="2"><span id="credit-message"></span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" class="nsm-field form-control mb-2"><?=isset($payment) ? str_replace("<br />", "", $payment->memo) : ""?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="receive-payment-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4 <?=!isset($payment) ? 'd-flex' : ''?>">
                            <?php if(!isset($payment)) : ?>
                            <a href="#" class="text-dark text-decoration-none m-auto" id="save-and-print">Print</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" id="save-and-print">Print</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                        <div class="dropdown-menu">
                                            <?php if($payment->status !== "4") : ?>
                                                <a class="dropdown-item" href="#" id="void-payment">Void</a>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="#" id="delete-payment">Delete</a>
                                            <a class="dropdown-item" href="#">Transaction journal</a>
                                            <a class="dropdown-item" href="#">Audit history</a>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
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
    </div>
    <!--end of modal-->
</form>
</div>