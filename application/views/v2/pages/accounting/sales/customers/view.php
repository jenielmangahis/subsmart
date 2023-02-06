<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/view_customer_modals'); ?>

<style>
    .notes-container {
        border-radius: 5px;
        border: 1px solid transparent;
    }
    .notes-container:hover {
        border-color: #dee2e6;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h3 class="m-0">
                                            <span id="customer-business-name"><?=$customer->business_name === '' ? $customer->first_name.' '.$customer->last_name : $customer->business_name?></span>
                                            <?php if($customer->email !== "" && $customer->email !== null) : ?>
                                            <small><a href="mailto: <?=$customer->email?>" class="text-muted"><i class="fa fa-envelope-o"></i></a></small>
                                            <?php endif; ?>
                                        </h3>
                                        <p><?=$vendorAddress?></p>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                <span>Actions</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item edit-customer">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="make-inactive">Make inactive</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="merge-contacts">Merge contacts</a>
                                                </li>
                                            </ul>

                                            <button type="button" class="dropdown-toggle nsm-button primary" data-bs-toggle="dropdown">
                                                <span>New transaction</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-invoice">Invoice</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-payment">Payment</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-standard-estimate">Standard Estimate</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-options-estimate">Options Estimate</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-bundle-estimate">Bundle Estimate</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-payment-link">Payment Link</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-sales-receipt">Sales Receipt</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-credit-memo">Credit Memo</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-delayed-charge">Delayed Charge</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-time-activity">Time Activity</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-statement">Statement</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="cursor-pointer p-3 h-100 notes-container">
                                            <?=$customer->notes !== null && $customer->notes !== "" ? $customer->notes : "<i>No notes available. Please click to add note</i>"?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 offset-md-6 grid-mb">
                                        <div class="float-end">
                                            <div>
                                                <h4 class="m-0"><span id="total-open-pay"><?=str_replace('$-', '-$', '$'.number_format($openBalance, 2, '.', ','))?></span></h4>
                                                <p class="m-0">OPEN</p>
                                            </div>
                                            <div>
                                                <h4 class="m-0"><span id="total-open-pay"><?=str_replace('$-', '-$', '$'.number_format($overdueBalance, 2, '.', ','))?></span></h4>
                                                <p class="m-0">OVERDUE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="nsm-card primary overflow-visible">
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
                                                            <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print-packing-slip">Print packing slip</a></li>
                                                            <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-transactions">Send transactions</a></li>
                                                            <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-reminders">Send reminders</a></li>
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
                                                                    <select class="nsm-field form-select" name="filter_type" id="filter-type" data-applied="<?=empty($type) ? 'all' : $type?>">
                                                                        <option value="all" <?=empty($type) || $type === 'all' ? 'selected' : ''?>>All transactions</option>
                                                                        <option value="all-plus-deposits" <?=$type === 'all-plus-deposits' ? 'selected' : ''?>>All plus deposits</option>
                                                                        <option value="all-invoices" <?=$type === 'all-invoices' ? 'selected' : ''?>>All invoices</option>
                                                                        <option value="open-invoices" <?=$type === 'open-invoices' ? 'selected' : ''?>>Open invoices</option>
                                                                        <option value="overdue-invoices" <?=$type === 'overdue-invoices' ? 'selected' : ''?>>Overdue invoices</option>
                                                                        <option value="open-estimates" <?=$type === 'open-estimates' ? 'selected' : ''?>>Open estimates</option>
                                                                        <option value="credit-memos" <?=$type === 'credit-memos' ? 'selected' : ''?>>Credit memos</option>
                                                                        <option value="unbilled-income" <?=$type === 'unbilled-income' ? 'selected' : ''?>>Unbilled income</option>
                                                                        <option value="recently-paid" <?=$type === 'recently-paid' ? 'selected' : ''?>>Recently paid</option>
                                                                        <option value="money-received" <?=$type === 'money-received' ? 'selected' : ''?>>Money received</option>
                                                                        <option value="recurring-templates" <?=$type === 'recurring-templates' ? 'selected' : ''?>>Recurring templates</option>
                                                                        <option value="statements" <?=$type === 'statements' ? 'selected' : ''?>>Statements</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="filter-date">Date</label>
                                                                    <select class="nsm-field form-select" name="filter_date" id="filter-date" data-applied="<?=empty($date) ? 'all' : $date?>">
                                                                        <option value="all" <?=empty($date) || $date === 'all' ? 'selected' : ''?>>All dates</option>
                                                                        <option value="today" <?=$date === 'today' ? 'selected' : ''?>>Today</option>
                                                                        <option value="yesterday" <?=$date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                                                        <option value="this-week" <?=$date === 'this-week' ? 'selected' : ''?>>This week</option>
                                                                        <option value="this-month" <?=$date === 'this-month' ? 'selected' : ''?>>This month</option>
                                                                        <option value="this-quarter" <?=$date === 'this-quarter' ? 'selected' : ''?>>This quarter</option>
                                                                        <option value="this-year" <?=$date === 'this-year' ? 'selected' : ''?>>This year</option>
                                                                        <option value="last-week" <?=$date === 'last-week' ? 'selected' : ''?>>Last week</option>
                                                                        <option value="last-month" <?=$date === 'last-month' ? 'selected' : ''?>>Last month</option>
                                                                        <option value="last-quarter" <?=$date === 'last-quarter' ? 'selected' : ''?>>Last quarter</option>
                                                                        <option value="last-year" <?=$date === 'last-year' ? 'selected' : ''?>>Last year</option>
                                                                        <option value="last-365-days" <?=$date === 'last-365-days' ? 'selected' : ''?>>Last 365 days</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-6">
                                                                    <button type="button" class="nsm-button" id="reset-button">
                                                                        Reset
                                                                    </button>
                                                                </div>
                                                                <div class="col-6">
                                                                    <button type="button" class="nsm-button primary float-end" id="apply-button">
                                                                        Apply
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </ul>

                                                        <button type="button" class="nsm-button export-items">
                                                            <i class='bx bx-fw bx-export'></i> Export
                                                        </button>
                                                        <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_vendor_transactions_modal">
                                                            <i class='bx bx-fw bx-printer'></i>
                                                        </button>
                                                        <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                            <i class="bx bx-fw bx-cog"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                                            <p class="m-0">Columns</p>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                                                                <label for="chk_type" class="form-check-label">Type</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                                                                <label for="chk_no" class="form-check-label">No.</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                                                                <label for="chk_customer" class="form-check-label">Customer</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_method" class="form-check-input">
                                                                <label for="chk_method" class="form-check-label">Method</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_source" class="form-check-input">
                                                                <label for="chk_source" class="form-check-label">Source</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                                                                <label for="chk_memo" class="form-check-label">Memo</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                                                                <label for="chk_due_date" class="form-check-label">Due date</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_aging" class="form-check-input">
                                                                <label for="chk_aging" class="form-check-label">Aging</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                                                                <label for="chk_balance" class="form-check-label">Balance</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                                                                <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                                                                <label for="chk_email" class="form-check-label">Email</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                                                                <label for="chk_attachments" class="form-check-label">Attachments</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                                                                <label for="chk_status" class="form-check-label">Status</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                                                                <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                                                                <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
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
                                            <table class="nsm-table" id="transactions-table">
                                                <thead>
                                                    <tr>
                                                        <td class="table-icon text-center">
                                                            <input class="form-check-input select-all table-select" type="checkbox">
                                                        </td>
                                                        <td data-name="Date">DATE</td>
                                                        <td data-name="Type">TYPE</td>
                                                        <td data-name="No.">NO.</td>
                                                        <td data-name="Customer">CUSTOMER</td>
                                                        <td data-name="Method">METHOD</td>
                                                        <td data-name="Source">SOURCE</td>
                                                        <td data-name="Memo">MEMO</td>
                                                        <td data-name="Due date">DUE DATE</td>
                                                        <td data-name="Aging">AGING</td>
                                                        <td data-name="Balance">BALANCE</td>
                                                        <td data-name="Total">TOTAL</td>
                                                        <td data-name="Last Delivered">LAST DELIVERED</td>
                                                        <td data-name="Email">EMAIL</td>
                                                        <td class="table-icon text-center" data-name="Attachments">
                                                            <i class='bx bx-paperclip'></i>
                                                        </td>
                                                        <td data-name="Status">STATUS</td>
                                                        <td data-name="P.O. Number">P.O. NUMBER</td>
                                                        <td data-name="Sales Rep">SALES REP</td>
                                                        <td data-name="Manage"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($transactions) > 0) : ?>
                                                        <?php foreach($transactions as $transaction) : ?>
                                                        <tr>
                                                            <td>
                                                                <div class="table-row-icon table-checkbox">
                                                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                                                </div>
                                                            </td>
                                                            <td><?=$transaction['date']?></td>
                                                            <td><?=$transaction['type']?></td>
                                                            <td><?=$transaction['no']?></td>
                                                            <td><?=$transaction['customer']?></td>
                                                            <td><?=$transaction['method']?></td>
                                                            <td><?=$transaction['source']?></td>
                                                            <td><?=$transaction['memo']?></td>
                                                            <td><?=$transaction['due_date']?></td>
                                                            <td><?=$transaction['aging']?></td>
                                                            <td><?=$transaction['balance']?></td>
                                                            <td><?=$transaction['total']?></td>
                                                            <td><?=$transaction['last_delivered']?></td>
                                                            <td><?=$transaction['email']?></td>
                                                            <td><?=$transaction['attachments']?></td>
                                                            <td><?=$transaction['status']?></td>
                                                            <td><?=$transaction['po_number']?></td>
                                                            <td><?=$transaction['sales_rep']?></td>
                                                            <td><?=$transaction['manage']?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <tr>
                                                        <td colspan="19">
                                                            <div class="nsm-empty">
                                                                <span>No results found.</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                                            <div class="row g-2">
                                                <div class="col-12 grid-mb text-end">
                                                    <div class="nsm-page-buttons page-button-container">
                                                        <button type="button" class="nsm-button edit-customer">
                                                            <i class='bx bx-fw bx-pencil'></i> Edit
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <table class="nsm-table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Customer</td>
                                                                <td><?=in_array($customer->business_name, ['', null]) ?  $customer->first_name.' '.$customer->last_name : $customer->business_name?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Email</td>
                                                                <td><?=$customer->email?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Phone</td>
                                                                <td><?=$customer->phone_h?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Mobile</td>
                                                                <td><?=$customer->phone_m?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Other</td>
                                                                <td></td>
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
                                                    <div class="attachments-container w-75">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="previewVendorAttachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                                <div class="col-12 col-md-4">
                                                    <table class="nsm-table">
                                                        <tbody>
                                                            <tr rowspan="2">
                                                                <td class="fw-bold nsm-text-primary">Billing address</td>
                                                                <td>
                                                                    <p class="m-0"><?=$customer->mail_add?></p>
                                                                    <p class="m-0"><?=$customer->city?>,<?=$customer->state?></p>
                                                                    <p class="m-0"><?=$customer->zip_code?></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Terms</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Payment method</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Preferred delivery method</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Customer type</td>
                                                                <td><?=$customer->customer_type?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Customer language</td>
                                                                <td>English</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Tax reg. no.</td>
                                                                <td></td>
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