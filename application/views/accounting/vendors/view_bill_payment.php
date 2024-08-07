<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/bill-payment/<?=$billPayment->id?>">
    <div id="billPaymentModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title"><a href="#"><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>Bill Payment #<span><?=$billPayment->to_print_check_no === "1" ? "To print" : $billPayment->check_no?></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row"  style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0"  style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="vendor">Payee</label>
                                                        <select name="payee_id" id="vendor" class="form-control" required>
                                                            <option value="<?=$vendor->id?>"><?=$vendor->display_name?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="payment_account">Payment account</label>
                                                        <select name="payment_account" id="payment_account" class="form-control" required>
                                                            <option value="<?=$billPayment->payment_account_id?>"><?=$this->chart_of_accounts_model->getName($billPayment->payment_account_id)?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right"><?=$billPayment->status === "4" ? "PAYMENT STATUS" : "AMOUNT PAID" ?></h6>
                                            <h2 class="text-right"><?=$billPayment->status === "4" ? "VOID" : "$<span class='transaction-total-amount'>".number_format(floatval($billPayment->total_amount), 2, '.', ',')."</span>" ?></h2>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="mailing_address">Mailing address</label>
                                                <textarea name="mailing_address" id="mailing_address" class="form-control"><?=str_replace("<br />", "", $billPayment->mailing_address)?></textarea>
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
                                                <label for="ref_no">Ref no.</label>
                                                <input type="text" name="ref_no" id="ref_no" class="form-control" value="<?=$billPayment->to_print_check_no === "1" ? "To print" : $billPayment->starting_check_no?>" <?=$billPayment->to_print_check_no === "1" ? "disabled" : ""?>>
                                                <div class="form-check">
                                                    <input type="checkbox" name="print_later" id="print_later" value="1" class="form-check-input" <?=$billPayment->to_print_check_no === "1" ? "checked" : ""?>>
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
                                                        <input type="number" name="total_amount" class="form-control" value="<?=number_format(floatval($billPayment->total_amount), 2, '.', ',')?>" onchange="convertToDecimal(this)">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Outstanding Transactions</h4>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-row">
                                                        <div class="col-3">
                                                            <input type="text" name="search" id="search" class="form-control" placeholder="Find Bill no.">
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="dropdown d-inline-block d-flex align-items-center h-100">
                                                                <a href="javascript:void(0);" class="btn btn-transparent dropdown-toggle hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter <i class="fa fa-chevron-right"></i></a>

                                                                <div class="dropdown-menu p-3 w-auto" aria-labelledby="filterDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <div class="inner-filter-list">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="bills-from">Bills from</label>
                                                                                            <input type="text" name="bills_from" id="bills-from" class="form-control date">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="bills-to">To</label>
                                                                                            <input type="text" name="bills_to" id="bills-to" class="form-control date">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" name="overdue_bills_only" id="overdue_bills_only" class="form-check-input" value="1">
                                                                                    <label for="overdue_bills_only" class="form-check-label">Overdue bills only</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="btn-group">
                                                                            <a href="#" class="btn-main" id="reset-btn" onclick="resetBillsFilter()">Reset</a>
                                                                            <a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applyBillsFilter()">Apply</a>
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
                                                                <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-cog"></i>
                                                                </a>
                                                                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(970px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <p class="m-0">Rows</p>
                                                                    <p class="m-0">
                                                                        <select name="table_rows" id="table_rows" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                            <option value="50">50</option>
                                                                            <option value="75">75</option>
                                                                            <option value="100">100</option>
                                                                            <option value="150" selected>150</option>
                                                                            <option value="300">300</option>
                                                                        </select>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 my-3">
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

                                            <?php if(!is_null($billPayment->vendor_credits_applied) && $billPayment->vendor_credits_applied !== "" && $billPayment->vendor_credits_applied !== "[]") : ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Credits</h4>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-row">
                                                        <div class="col-3">
                                                            <input type="text" name="search" id="search-vcredit-no" class="form-control" placeholder="Find Vendor Credit No.">
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="dropdown d-inline-block d-flex align-items-center h-100">
                                                                <a href="javascript:void(0);" class="btn btn-transparent dropdown-toggle hide-toggle" id="vCreditFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter <i class="fa fa-chevron-right"></i></a>

                                                                <div class="dropdown-menu p-3 w-auto" aria-labelledby="vCreditFilterDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <div class="inner-filter-list">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="vcredit-from">Vendor Credit from</label>
                                                                                            <input type="text" name="vcredit_from" id="vcredit-from" class="form-control date" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="vcredit-to">To</label>
                                                                                            <input type="text" name="vcredit_to" id="vcredit-to" class="form-control date" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="btn-group">
                                                                            <a href="#" class="btn-main" id="vcredits-reset-btn" onclick="resetCreditsFilter()">Reset</a>
                                                                            <a href="#" id="vcredits-apply-btn" class="btn-main apply-btn" onclick="applyCreditsFilter()">Apply</a>
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
                                                                <a class="hide-toggle dropdown-toggle" type="button" id="vCreditsRows" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-cog"></i>
                                                                </a>
                                                                <div class="dropdown-menu p-3" aria-labelledby="vCreditsRows" x-placement="bottom-start" style="position: absolute; transform: translate3d(970px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                    <p class="m-0">Rows</p>
                                                                    <p class="m-0">
                                                                        <select name="table_rows" id="vcredits_table_rows" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                            <option value="50">50</option>
                                                                            <option value="75">75</option>
                                                                            <option value="100">100</option>
                                                                            <option value="150" selected>150</option>
                                                                            <option value="300">300</option>
                                                                        </select>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 my-3">
                                                    <table class="table table-bordered table-hover clickable" id="vendor-credits-table">
                                                        <thead>
                                                            <th>
                                                                <div class="d-flex justify-content-center">
                                                                    <input type="checkbox" id="select-all-credits">
                                                                </div>
                                                            </th>
                                                            <th>DESCRIPTION</th>
                                                            <th>ORIGINAL AMOUNT</th>
                                                            <th>OPEN BALANCE</th>
                                                            <th>PAYMENT</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <?php endif; ?>
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
                    </div>
                </div>

                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            <?php if(isset($billPayment)) : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white" id="print-check">Print check</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-white">Order checks</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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