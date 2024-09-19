<style>
#payBillsModal .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
.span-input{
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
</style>
<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="payBillsModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-transactions">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Pay Bills
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-8 grid-mb">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <label for="payment_account">Payment account</label>
                                            <select name="payment_account" id="payment_account" class="form-control nsm-field" required>
                                                <option value="<?=$account->id?>"><?=$account->name?></option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="payment_account">Balance</label>
                                            <span class="span-input text-end" style="align-self: flex-end; margin-bottom: 0px"><span id="account-balance"><?= $balance ?></span></span>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="payment_date">Payment date</label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" name="payment_date" id="payment_date" class="form-control nsm-field date" value="<?=date("m/d/Y")?>" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="starting_check_no">Starting check no.</label>
                                            <input type="text" name="starting_check_no" id="starting_check_no" value="<?=$startingCheckNo?>" class="form-control nsm-field">
                                        </div>
                                        <div class="col-12 col-md-2 d-flex align-items-end">
                                            <div class="form-check">
                                                <input type="checkbox" name="print_later" id="print_later" class="form-check-input" value="1">
                                                <label for="print_later" class="form-check-label">Print later</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6>TOTAL PAYMENT AMOUNT</h6>
                                    <h2><span class="transaction-total-amount">$0.00</span></h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 grid-mb text-end">
                                    <div class="dropdown">
                                        <button class="nsm-button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter <i class="bx bx-fw bx-chevron-down"></i></button>

                                        <div class="dropdown-menu p-3" style="width: max-content">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <label for="due_date">Due date</label>
                                                    <select name="due_date" id="due_date" class="form-control nsm-field">
                                                        <option value="last-365-days" selected>Last 365 days</option>
                                                        <option value="custom">Custom</option>
                                                        <option value="today">Today</option>
                                                        <option value="yesterday">Yesterday</option>
                                                        <option value="this-week">This week</option>
                                                        <option value="this-month">This month</option>
                                                        <option value="this-quarter">This quarter</option>
                                                        <option value="this-year">This year</option>
                                                        <option value="last-week">Last week</option>
                                                        <option value="last-month">Last month</option>
                                                        <option value="last-quarter">Last quarter</option>
                                                        <option value="last-year">Last year</option>
                                                        <option value="all-dates">All dates</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="from">From</label>
                                                    <div class="nsm-field-group calendar">
                                                        <input type="date" name="from" id="from" class="form-control nsm-field" value="<?=date("Y-m-d", strtotime(" -365 days"))?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="to">To</label>
                                                    <div class="nsm-field-group calendar">
                                                        <input type="date" name="to" id="to" class="form-control nsm-field" value="<?= date("Y-m-d"); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="payee">Payee</label>
                                                    <select name="payee" id="pay-bills-vendor" class="form-control nsm-field"></select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-check" style="margin-left:4px;">
                                                        <input type="checkbox" name="overdue_only" id="overdue_only" class="form-check-input">
                                                        <label for="overdue_only" class="form-check-label">Overdue status only</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <button class="nsm-button float-end" type="button" onclick="resetbillsfilter()">Reset</button>
                                                    <button class="nsm-button success float-end" type="button" onclick="applybillsfilter()">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 grid-mb text-end">
                                    <div class="nsm-page-button page-button-container">
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
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="billTableRows(this)">50</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="billTableRows(this)">75</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="billTableRows(this)">100</a></li>
                                                    <li><a class="dropdown-item active" href="javascript:void(0);" onclick="billTableRows(this)">150</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="billTableRows(this)">300</a></li>
                                                </ul>
                                            </div>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>

                            <div class="col-12">
                                <table class="nsm-table" id="bills-table">
                                    <thead>
                                        <tr>
                                            <td class="table-icon text-center">
                                                <div class="table-row-icon table-checkbox">
                                                    <input class="form-check-input select-all table-select" type="checkbox">
                                                </div>
                                            </td>
                                            <td data-name="Payee">PAYEE</td>
                                            <td data-name="Ref No." style="width:15%;">REF NO.</td>
                                            <td data-name="Due Date" style="width:10%;">DUE DATE</td>
                                            <td data-name="Open Balance" style="width:10%;">OPEN BALANCE</td>
                                            <td data-name="Credit Applied">CREDIT APPLIED</td>
                                            <td data-name="Payment" style="width:10%;">PAYMENT</td>
                                            <td data-name="Total Amount" style="width:9%;text-align:right;">TOTAL AMOUNT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (count($bills) > 0) : ?>
                                        <?php foreach($bills as $bill) : ?>
                                        <tr data-vcredits="<?=$bill['vendor_credits']?>" data-payeeid="<?=$bill['payee_id']?>">
                                            <td>
                                                <div class="table-row-icon table-checkbox">
                                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$bill['id']?>">
                                                </div>
                                            </td>
                                            <td><span class="span-input"><?= $bill['payee'] ? $bill['payee'] : '---'; ?></span></td>
                                            <td><span class="span-input"><?=$bill['ref_no']?></span></td>
                                            <td><span class="span-input"><?=$bill['due_date']?></span></td>
                                            <td><span class="span-input"><?=$bill['open_balance']?></span></td>
                                            <td>
                                                <?php if(!in_array($bill['vendor_credits'], ['', '0.00', null])) : ?>
                                                <?php $max = floatval($bill['vendor_credits']) > floatval($bill['open_balance']) ? $bill['open_balance'] : $bill['vendor_credits'];?>
                                                <div class="row">
                                                    <div class="col-12 col-md-9">
                                                        <input type="number" class="form-control nsm-field text-end credit-applied" step=".01" max="<?=$max?>" onchange="convertToDecimal(this)">
                                                    </div>
                                                    <div class="col-12 col-md-3 d-md-flex align-items-center">
                                                        <span class="available-credit"><?=$bill['vendor_credits']?></span> &nbsp;available
                                                    </div>
                                                </div>
                                                <?php else : ?>
                                                <span class="float-end">Not available</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><input type="number" class="form-control nsm-field text-end payment-amount" onchange="convertToDecimal(this)"></td>
                                            <td style="text-align:right;">
                                                <span class="span-input">$0.00</span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="8">
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
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-6">
                            <!-- Split dropup button -->
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success">
                                Schedule payments online
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="savePayBills(event)">Save</a>
                                        <a class="dropdown-item" href="#" onclick="savePrintPayBills(event)">Save and print</a>
                                        <a class="dropdown-item" href="#" onclick="saveClosePayBills(event)">Save and close</a>
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