<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/bill-payment/<?=$billPayment->id?>">
    <div id="billPaymentModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Checks</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-checks">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            &nbsp;
                            <span class="modal-title content-title">
                                Bill Payment #<span><?=$billPayment->to_print_check_no === "1" ? "To print" : $billPayment->check_no?></span>
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
                                            <label for="vendor">Payee</label>
                                            <select name="payee_id" id="vendor" class="form-control nsm-field" required>
                                                <option value="<?=$vendor->id?>"><?=$vendor->display_name?></option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="payment_account">Payment account</label>
                                            <select name="payment_account" id="payment_account" class="form-control nsm-field" required>
                                                <option value="<?=$billPayment->payment_account_id?>"><?=$this->chart_of_accounts_model->getName($billPayment->payment_account_id)?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6><?=$billPayment->status === "4" ? "PAYMENT STATUS" : "AMOUNT PAID" ?></h6>
                                    <h2><?=$billPayment->status === "4" ? "VOID" : "$<span class='transaction-total-amount'>".number_format(floatval($billPayment->total_amount), 2, '.', ',')."</span>" ?></h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <label for="mailing_address">Mailing address</label>
                                    <textarea name="mailing_address" id="mailing_address" class="form-control nsm-field"><?=str_replace("<br />", "", $billPayment->mailing_address)?></textarea>
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="payment_date">Payment date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="payment_date" id="payment_date" class="form-control nsm-field date" value="<?=date("m/d/Y", strtotime($billPayment->payment_date))?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 offset-md-2">
                                    <div class="mb-2">
                                        <label for="ref_no">Ref no.</label>
                                        <input type="text" name="ref_no" id="ref_no" class="form-control nsm-field" value="<?=$billPayment->to_print_check_no === "1" ? "To print" : $billPayment->starting_check_no?>" <?=$billPayment->to_print_check_no === "1" ? "disabled" : ""?>>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="print_later" id="print_later" value="1" class="form-check-input" <?=$billPayment->to_print_check_no === "1" ? "checked" : ""?>>
                                        <label for="print_later" class="form-check-label">Print later</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2 offset-md-10">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="total_amount" class="form-control nsm-field" value="<?=number_format(floatval($billPayment->total_amount), 2, '.', ',')?>" onchange="convertToDecimal(this)">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 grid-mb">
                                    <h4>Outstanding Transactions</h4>
                                </div>

                                <div class="col-12 col-md-6 grid-mb">
                                    <div class="nsm-field-group search">
                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search-bill-no" name="search" placeholder="Find Bill No.">
                                    </div>
                                    <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                        Filter <i class="bx bx-fw bx-chevron-right"></i>
                                    </button>
                                    <ul class="dropdown-menu p-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="bills-from">Bills from</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" name="bills_from" id="bills-from" class="form-control nsm-field mb-2 date" data-applied="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="bills-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" name="bills_to" id="bills-to" class="form-control nsm-field mb-2 date" data-applied="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="overdue-bills-only" data-applied="false">
                                                    <label for="overdue-bills-only" class="form-check-label">Overdue bills only</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="nsm-button m-0" type="button" onclick="resetBillsFilter(event)">Reset</button>
                                                <button class="nsm-button success float-end m-0" type="button" onclick="applyBillsFilter(event)">Apply</button>
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
                                                        150
                                                    </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" id="bills-table-rows">
                                                    <li><a class="dropdown-item" href="javascript:void(0);">50</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                                    <li><a class="dropdown-item active" href="javascript:void(0);">150</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-12 grid-mb">
                                    <table class="nsm-table" id="bills-table">
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
                                        <tbody>
                                            <?php if(count($bills) > 0) : ?>
                                            <?php foreach($bills as $bill) : ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?=$bill['id']?>" <?=$bill['selected'] ? 'checked' : ''?>>
                                                    </div>
                                                </td>
                                                <td><?=$bill['description']?></td>
                                                <td><?=$bill['due_date']?></td>
                                                <td><?=$bill['original_amount']?></td>
                                                <td><?=$bill['open_balance']?></td>
                                                <td><input type="number" value="<?=$bill['payment']?>" name="bill_payment[]" class="form-control nsm-field text-end" onchange="convertToDecimal(this)"></td>
                                            </tr>
                                            <?php endforeach;?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="nsm-empty">
                                                        <span>No results found.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <?php if(!is_null($billPayment->vendor_credits_applied) && $billPayment->vendor_credits_applied !== "" && $billPayment->vendor_credits_applied !== "[]") : ?>
                            <div class="row">
                                <div class="col-12 grid-mb">
                                    <h4>Credits</h4>
                                </div>

                                <div class="col-12 col-md-6 grid-mb">
                                    <div class="nsm-field-group search">
                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search-vcredit-no" name="search" placeholder="Find Vendor Credit No.">
                                    </div>
                                    <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                        Filter <i class="bx bx-fw bx-chevron-right"></i>
                                    </button>
                                    <ul class="dropdown-menu p-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="vcredit-from">Vendor Credit from</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" name="vcredit_from" id="vcredit-from" class="form-control nsm-field mb-2 date">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="vcredit-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" name="vcredit_to" id="vcredit-to" class="form-control nsm-field mb-2 date">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="nsm-button m-0" type="button" id="reset-credits-filter" onclick="resetCreditsFilter(event)">Reset</button>
                                                <button class="nsm-button success float-end m-0" type="button" id="apply-credits-filter" onclick="applyCreditsFilter(event)">Apply</button>
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
                                                        150
                                                    </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" id="credits-table-rows">
                                                    <li><a class="dropdown-item" href="javascript:void(0);">50</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                                    <li><a class="dropdown-item active" href="javascript:void(0);">150</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-12 grid-mb">
                                    <table class="nsm-table" id="vendor-credits-table">
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
                                        <tbody>
                                            <?php if(count($credits) > 0) : ?>
                                            <?php foreach($credits as $credit) : ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?=$credit['id']?>" <?=$credit['selected'] ? 'checked' : ''?>>
                                                    </div>
                                                </td>
                                                <td><?=$credit['description']?></td>
                                                <td><?=$credit['original_amount']?></td>
                                                <td><?=$credit['open_balance']?></td>
                                                <td><input type="number" value="<?=$credit['payment']?>" name="credit_payment[]" class="form-control nsm-field text-end" onchange="convertToDecimal(this)" max="<?=$credit['open_balance']?>" step="0.01"></td>
                                            </tr>
                                            <?php endforeach;?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="nsm-empty">
                                                        <span>No results found.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" class="nsm-field form-control mb-2"><?=str_replace("<br />", "", $billPayment->memo)?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="bill-payment-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                        <div class="col-md-4">
                            <?php if(isset($billPayment)) : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" id="print-check">Print check</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-dark text-decoration-none">Order checks</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="void-bill-payment">Void</a>
                                                <a class="dropdown-item" href="#" id="delete-bill-payment">Delete</a>
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