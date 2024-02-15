<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/view_vendor_modals'); ?>

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
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/expenses'); ?>
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
                                            <span id="vendor-display-name"><?=$vendorDetails->display_name?> <?=$vendorDetails->status === '0' ? '(deleted)' : ''?></span>
                                            <?php if($vendorDetails->email !== "" && $vendorDetails->email !== null) : ?>
                                            <small><a href="mailto: <?=$vendorDetails->email?>" class="text-muted"><i class="fa fa-envelope-o"></i></a></small>
                                            <?php endif; ?>
                                        </h3>
                                        <p><?=$vendorAddress?></p>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <?php if($vendorDetails->status === '0') : ?>
                                            <button type="button" class="nsm-button" id="make-active">
                                                Make Active
                                            </button>
                                            <?php else : ?>
                                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                <span>Actions</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item edit-vendor">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="make-inactive">Make inactive</a>
                                                </li>
                                            </ul>

                                            <button type="button" class="dropdown-toggle nsm-button primary" data-bs-toggle="dropdown">
                                                <span>New transaction</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-time-activity">Time activity</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-bill">Bill</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-expense">Expense</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-check">Check</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-purchase-order">Purchase order</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-vendor-credit">Vendor Credit</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-cc-payment">Pay down credit card</a>
                                                </li>
                                            </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="cursor-pointer p-3 h-100 notes-container">
                                            <?=$vendorDetails->notes !== null && $vendorDetails->notes !== "" ? $vendorDetails->notes : "<i>No notes available. Please click to add note</i>"?>
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
                                                                    <select class="nsm-field form-select" name="filter_type" id="filter-type" data-applied="<?=empty($type) ? 'all' : $type?>">
                                                                        <option value="all" <?=empty($type) || $type === 'all' ? 'selected' : ''?>>All transactions</option>
                                                                        <option value="expenses" <?=$type === 'expenses' ? 'selected' : ''?>>Expenses</option>
                                                                        <option value="all-bills" <?=$type === 'all-bills' ? 'selected' : ''?>>All Bills</option>
                                                                        <option value="open-bills" <?=$type === 'open-bills' ? 'selected' : ''?>>Open Bills</option>
                                                                        <option value="overdue-bills" <?=$type === 'overdue-bills' ? 'selected' : ''?>>Overdue Bills</option>
                                                                        <option value="bill-payments" <?=$type === 'bill-payments' ? 'selected' : ''?>>Bill payments</option>
                                                                        <option value="checks" <?=$type === 'checks' ? 'selected' : ''?>>Checks</option>
                                                                        <option value="purchase-orders" <?=$type === 'purchase-orders' ? 'selected' : ''?>>Purchase orders</option>
                                                                        <option value="recently-paid" <?=$type === 'recently-paid' ? 'selected' : ''?>>Recently paid</option>
                                                                        <option value="vendor-credits" <?=$type === 'vendor-credits' ? 'selected' : ''?>>Vendor Credits</option>
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

                                                        <button type="button" class="nsm-button export-transactions">
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
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_payee" class="form-check-input">
                                                                <label for="chk_payee" class="form-check-label">Payee</label>
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
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_category" class="form-check-input">
                                                                <label for="chk_category" class="form-check-label">Category</label>
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
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                                                                <label for="chk_balance" class="form-check-label">Balance</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                                                                <label for="chk_status" class="form-check-label">Status</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
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
                                            <table class="nsm-table" id="transactions-table">
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
                                                        <td data-name="Due date">DUE DATE</td>
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
                                                        <td><?=$transaction['number']?></td>
                                                        <td><?=$transaction['payee']?></td>
                                                        <td><?=$transaction['method']?></td>
                                                        <td><?=$transaction['source']?></td>
                                                        <td>
                                                            <?php if($transaction['category'] !== '-Split-' && $transaction['category'] !== '') : ?>
                                                            <select name="expense_account[]" class="form-control nsm-field">
                                                                <option value="<?=$transaction['category']['id']?>"><?=$transaction['category']['name']?></option>
                                                            </select>
                                                            <?php else : ?>
                                                            <?=$transaction['category']?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?=$transaction['memo']?></td>
                                                        <td><?=$transaction['due_date']?></td>
                                                        <td><?=$transaction['balance']?></td>
                                                        <td><?=$transaction['total']?></td>
                                                        <td><?=$transaction['status']?></td>
                                                        <td class="overflow-visible">
                                                            <?php if(count($transaction['attachments']) > 0) : ?>
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                        <i class="bx bx-fw"><?=count($transaction['attachments'])?></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px">
                                                                        <?php foreach($transaction['attachments'] as $attachment) : ?>
                                                                        <li>
                                                                            <a href="#" class="dropdown-item view-attachment" data-href="/uploads/accounting/attachments/<?=$attachment->stored_name?>">
                                                                                <div class="row">
                                                                                    <div class="col-5 pr-0">
                                                                                        <?=in_array($attachment->file_extension, ['jpg', 'jpeg', 'png']) ? "<img src='/uploads/accounting/attachments/$attachment->stored_name' class='m-auto w-100'>" : "<div class='bg-muted text-center d-flex justify-content-center align-items-center h-100 text-white'><p class='m-0'>NO PREVIEW AVAILABLE</p></div>"?>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <div class="d-flex align-items-center h-100 w-100">
                                                                                            <span class="text-truncate"><?=$attachment->uploaded_name.'.'.$attachment->file_extension?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?=$transaction['manage']?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <tr>
                                                        <td colspan="15">
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
                                                                <td class="fw-bold nsm-text-primary">Website</td>
                                                                <td><?=$vendorDetails->website?></td>
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