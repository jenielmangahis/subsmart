<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/expenses'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            An expense is generally anything that your company spends money on to keep it up and running. Examples of expenses are rent, phone bills, website hosting fees, office supplies, accountant fees, trash service, janitorial fees, etc. Simply click new transaction and you will see you will see a list of options to chose from. Once you choose the type of transactions; just enter the information and click save new.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Filter by name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print-transactions">Print transactions</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="categorize-selected">Categorize selected</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Other Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="print-checks">Print checks</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="pay-bills">Pay bills</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                            <option value="all-transactions" selected="selected">All transactions</option>
                                            <option value="expense">Expense</option>
                                            <option value="bill">Bill</option>
                                            <option value="bill-payments">Bill payments</option>
                                            <option value="check">Check</option>
                                            <option value="purchase-order">Purchase order</option>
                                            <option value="recently-paid">Recently paid</option>
                                            <option value="vendor-credit">Vendor Credit</option>
                                            <option value="credit-card-payment">Credit Card Payment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="filter-status">Status</label>
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                            <option value="any" selected="selected">Any</option>
                                            <option value="print-later">Print later</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="filter-delivery-method">Delivery method</label>
                                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                                            <option value="all-statuses" selected="selected">All statuses</option>
                                            <option value="open">Open</option>
                                            <option value="overdue">Overdue</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                            <option value="last-365-days" selected="selected">Last 365 days</option>
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
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y")?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="filter-payee">Payee</label>
                                        <select class="nsm-field form-select" name="filter_payee" id="filter-payee">
                                            <option value="all" selected="selected">All</option>
                                            <?php if(count($dropdown['customers']) > 0) : ?>
                                            <optgroup label="Customer">
                                            <?php foreach($dropdown['customers'] as $customer) : ?>
                                                <option value="<?=$customer->prof_id?>"><?=$customer->first_name . ' ' . $customer->last_name?></option>
                                            <?php endforeach; ?>
                                            </optgroup>
                                            <?php endif;?>

                                            <?php if(count($dropdown['vendors']) > 0) : ?>
                                            <optgroup label="Vendor">
                                            <?php foreach($dropdown['vendors'] as $vendor) : ?>
                                                <option value="<?=$vendor->id?>"><?=$vendor->display_name?></option>
                                            <?php endforeach; ?>
                                            </optgroup>
                                            <?php endif;?>

                                            <?php if(count($dropdown['employees']) > 0) : ?>
                                            <optgroup label="Employee">
                                            <?php foreach($dropdown['employees'] as $employee) : ?>
                                                <option value="<?=$employee->id?>"><?=$employee->FName . ' ' . $employee->LName?></option>
                                            <?php endforeach; ?>
                                            </optgroup>
                                            <?php endif;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="filter-category">Category</label>
                                        <select class="nsm-field form-select" name="filter_category" id="filter-category">
                                            <option value="all" selected="selected">All</option>
                                            <?php foreach($dropdown['categories'] as $type => $categories) : ?>
                                            <?php if(count($categories) > 0) : ?>
                                            <optgroup label="<?=$type?>">
                                                <?php foreach($categories as $category) : ?>
                                                    <option value="<?=$category->id?>"><?=$category->name?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    <i class='bx bx-fw bx-list-plus'></i> New transaction
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-time-activity">Time activity</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-bill">Bill</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-expense">Expense</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-check">Check</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-purchase-order">Purchase order</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-vendor-credit">Vendor Credit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-cc-payment">Pay down credit card</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" onchange="col_type()" name="chk_type" id="chk_type" class="form-check-input">
                                    <label for="chk_type" class="form-check-label">Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" onchange="col_detailtype()" name="chk_detail_type" id="chk_detail_type" class="form-check-input">
                                    <label for="chk_detail_type" class="form-check-label">Detail Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" onchange="col_nbalance()" name="chk_nsmart_balance" id="chk_nsmart_balance" class="form-check-input">
                                    <label for="chk_nsmart_balance" class="form-check-label">nSmarTrac Balance</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" onchange="col_bank_balance()" name="chk_bank_balance" id="chk_bank_balance" class="form-check-input">
                                    <label for="chk_bank_balance" class="form-check-label">Bank Balance</label>
                                </div>
                                <p class="m-0">Other</p>
                                <div class="form-check">
                                    <input type="checkbox" id="inc_inactive" value="1" class="form-check-input">
                                    <label for="inc_inactive" class="form-check-label">Include Inactive</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            150
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
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
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Payee">PAYEE</td>
                            <td data-name="Method">METHOD</td>
                            <td data-name="Source">SOURCE</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Due Date">DUE DATE</td>
                            <td data-name="Balance">BALANCE</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Status">STATUS</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox">
                                </div>
                            </td>
                            <td>07/03/2022</td>
                            <td>Check</td>
                            <td>123</td>
                            <td>Test Payee</td>
                            <td></td>
                            <td></td>
                            <td>
                                <select class="nsm-field form-select" name="row_category[]">
                                    <?php foreach($dropdown['categories'] as $type => $categories) : ?>
                                    <?php if(count($categories) > 0) : ?>
                                    <optgroup label="<?=$type?>">
                                        <?php foreach($categories as $category) : ?>
                                            <option value="<?=$category->id?>"><?=$category->name?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td>$0.00</td>
                            <td>$100.00</td>
                            <td><span class="text-success fw-bold">Paid</span></td>
                            <td></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">Attach a file</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">View/Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Copy</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Void</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>