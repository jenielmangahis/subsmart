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
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="nsm-tab">
                                    <nav>
                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            <button class="nav-link" id="nav-transaction-tab" data-bs-toggle="tab" data-bs-target="#nav-transaction" type="button" role="tab" aria-controls="nav-transaction" aria-selected="false">
                                                Transaction List
                                            </button>
                                            <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="true">
                                                Vendor Details
                                            </button>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="nav-transaction" role="tabpanel" aria-labelledby="nav-transaction-tab">
                                            <div class="row g-2">
                                                <div class="col-12 grid-mb text-end">
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

                                                    <div class="nsm-page-buttons page-button-container">
                                                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                            <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="filter-type">Type</label>
                                                                    <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                                                        <option value="all-transactions" selected="selected">All transactions</option>
                                                                        <option value="expenses">Expenses</option>
                                                                        <option value="all-bills">All Bills</option>
                                                                        <option value="open-bills">Open Bills</option>
                                                                        <option value="overdue-bills">Overdue Bills</option>
                                                                        <option value="bill-payments">Bill payments</option>
                                                                        <option value="checks">Checks</option>
                                                                        <option value="purchase-orders">Purchase orders</option>
                                                                        <option value="recently-paid">Recently paid</option>
                                                                        <option value="vendor-credits">Vendor Credits</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="filter-date">Date</label>
                                                                    <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                                                        <option value="all-dates" selected="selected">All dates</option>
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
                                                                        <option value="last-365-days">Last 365 days</option>
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
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_type" id="chk_type" class="form-check-input">
                                                                <label for="chk_type" class="form-check-label">Type</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_no" id="chk_no" class="form-check-input">
                                                                <label for="chk_no" class="form-check-label">No.</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_payee" id="chk_payee" class="form-check-input">
                                                                <label for="chk_payee" class="form-check-label">Payee</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_method" id="chk_method" class="form-check-input">
                                                                <label for="chk_method" class="form-check-label">Method</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_source" id="chk_source" class="form-check-input">
                                                                <label for="chk_source" class="form-check-label">Source</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_category" id="chk_category" class="form-check-input">
                                                                <label for="chk_category" class="form-check-label">Category</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_memo" id="chk_memo" class="form-check-input">
                                                                <label for="chk_memo" class="form-check-label">Memo</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_due_date" id="chk_due_date" class="form-check-input">
                                                                <label for="chk_due_date" class="form-check-label">Due date</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_balance" id="chk_balance" class="form-check-input">
                                                                <label for="chk_balance" class="form-check-label">Balance</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_status" id="chk_status" class="form-check-input">
                                                                <label for="chk_status" class="form-check-label">Status</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" onchange="showCol(this)" name="chk_attachments" id="chk_attachments" class="form-check-input">
                                                                <label for="chk_attachments" class="form-check-label">Attachments</label>
                                                            </div>
                                                            <p class="m-0">Rows</p>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="compact" id="compact" class="form-check-input">
                                                                <label for="compact" class="form-check-label">Compact</label>
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
                                                                <?php foreach($categoryAccs as $type => $categories) : ?>
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
                                        <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                                            <div class="row g-2">
                                                <div class="col-12 grid-mb text-end">
                                                    <div class="nsm-page-buttons page-button-container">
                                                        <button type="button" class="nsm-button">
                                                            <i class='bx bx-fw bx-pencil'></i> Edit
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <table class="nsm-table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Vendor</td>
                                                                <td><?=$vendorDetails->display_name?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Email</td>
                                                                <td><?=$vendorDetails->email?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Phone</td>
                                                                <td><?=$vendorDetails->phone?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Mobile</td>
                                                                <td><?=$vendorDetails->mobile?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Fax</td>
                                                                <td><?=$vendorDetails->fax?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Other</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Website</td>
                                                                <td><?=$vendorDetails->website?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="attachments-container w-50">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="previewVendorAttachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                                <div class="col-12 col-md-4">
                                                    <table class="nsm-table">
                                                        <tbody>
                                                            <tr rowspan="2">
                                                                <td class="fw-bold nsm-text-primary">Billing address</td>
                                                                <td>
                                                                    <p class="m-0"><?=$vendorDetails->street?></p>
                                                                    <p class="m-0"><?=$vendorDetails->city?>,<?=$vendorDetails->state?></p>
                                                                    <p class="m-0"><?=$vendorDetails->zip?></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Terms</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Company</td>
                                                                <td><?=$vendorDetails->company?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Notes</td>
                                                                <td>
                                                                    <div class="notes-container w-50">
                                                                        <textarea name="notes" class="form-control nsm-field cursor-pointer" disabled><?=$vendorDetails->notes === '' || $vendorDetails->notes === null ? 'No notes available. Please click to add notes.' : $vendorDetails->notes?></textarea>                              
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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

<?php include viewPath('v2/includes/footer'); ?>