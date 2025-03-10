<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="payBillsModal" class="modal fade modal-fluid" role="dialog">
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
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-transactions">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Pay Bills
                            </h4>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="payment_account">Payment account</label>
                                                        <select name="payment_account" id="payment_account" class="form-control" required></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex ">
                                                    <p style="align-self: flex-end; margin-bottom: 30px">Balance <span id="account-balance"><?= $balance ?></span></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="payment_date">Payment date</label>
                                                        <input type="text" name="payment_date" id="payment_date" class="form-control date" value="<?=date("m/d/Y")?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="starting_check_no">Starting check no.</label>
                                                        <input type="text" name="starting_check_no" id="starting_check_no" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-center">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="print_later" id="print_later" class="form-check-input" value="1">
                                                        <label for="print_later" class="form-check-label">Print later</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">TOTAL PAYMENT AMOUNT</h6>
                                            <h2 class="text-right"><span class="transaction-total-amount">$0.00</span></h2>
                                        </div>
                                    </div>

                                    <div class="row pb-3">
                                        <div class="col-md-6">
                                            <div class="dropdown d-inline-block">
                                                <a href="#" class="dropdown-toggle btn btn-transparent" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>

                                                <div class="dropdown-menu p-3" aria-labelledby="filterDropdown">
                                                    <div class="inner-filter-list">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="due_date">Due date</label>
                                                                    <select name="due_date" id="due_date" class="form-control">
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
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="from">From</label>
                                                                    <input type="text" name="from" id="from" class="form-control date">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="to">To</label>
                                                                    <input type="text" name="to" id="to" class="form-control date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="payee">Payee</label>
                                                                    <select name="payee" id="pay-bills-vendor" class="form-control"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="overdue_only" id="overdue_only" class="form-check-input">
                                                                        <label for="overdue_only">Overdue status only</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="btn-group">
                                                            <a href="#" class="btn-main" onclick="resetbillsfilter()">Reset</a>
                                                            <a href="#" id="" class="btn-main apply-btn btn btn-success" onclick="applybillsfilter()">Apply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="action-bar h-100 d-flex align-items-center">
                                                <ul class="ml-auto">
                                                    <li>
                                                        <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-cog"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                            <p class="m-0">Rows</p>
                                                            <p class="m-0">
                                                                <select name="table_rows" id="table_rows" class="form-control">
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
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover clickable" id="bills-table">
                                                <thead>
                                                    <th>
                                                        <div class="d-flex justify-content-center">
                                                            <input type="checkbox" id="select-all-bills">
                                                        </div>
                                                    </th>
                                                    <th>PAYEE</th>
                                                    <th>REF NO.</th>
                                                    <th>DUE DATE</th>
                                                    <th>OPEN BALANCE</th>
                                                    <th>CREDIT APPLIED</th>
                                                    <th>PAYMENT</th>
                                                    <th>TOTAL AMOUNT</th>
                                                </thead>
                                                <tbody class="cursor-pointer"></tbody>
                                            </table>
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
                                <button type="button" class="btn btn-success">
                                    Schedule payments online
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
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
    <!--end of modal-->
</form>
</div>