<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/receipts_modals'); ?>

<style>
    #receiptsReview_length {
        display: none;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/banking'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/receipts_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            The more you uses your bank rules, the better it gets at categorizing. After a while, it can even scan transactions and add details like payees. Step 1: Create a bank rule. Go to the Banking menu or Transactions menu. Then select the Rules tab. Select New rule. Enter a name in the Rule field. From the drop-down, select Money in or Money out.  Simply acknowledge and our accounting platform will remember your selection for that particular entry for the next time.  Saving you time and money.
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-12 col-md-1 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by name or conditions">
                        </div> -->
                        <div class="form-group row">
                            <div class="col-sm-7">
                                <select id="receiptsReview_showentries" class="form-select form-select">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <label for="receiptsReview_showentries" class="col-sm-3 col-form-label">Entries</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-11 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="confirm" data-action="confirm">Confirm selected</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="review" data-action="review">Review selected</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="delete" data-action="delete">Delete selected</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-dates">Dates</label>
                                        <select class="nsm-field form-select" name="filter_dates" id="filter-dates">
                                            <option value="all-dates" selected="selected">All Dates</option>
                                            <option value="custom">Custom</option>
                                            <option value="since-365-days">Since 365 days</option>
                                            <option value="this-month">This Month</option>
                                            <option value="this-quarter">This Quarter</option>
                                            <option value="this-year">This Year</option>
                                            <option value="last-month">Last Month</option>
                                            <option value="last-quarter">Last Quarter</option>
                                            <option value="last-year">Last Year</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" id="filter-from">
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
                                        <label for="filter-account-category">Account/Category</label>
                                        <select class="nsm-field form-select" name="filter_account_category" id="filter-account-category">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-amount">Amount</label>
                                        <select class="nsm-field form-select" name="filter_amount" id="filter-amount">
                                            <option value="between" selected>Between</option>
                                            <option value="less-than">Less Than</option>
                                            <option value="greater-than">Greater Than</option>
                                            <option value="equals">Equals</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-minimum">Minimum</label>
                                        <input type="number" class="nsm-field form-control" id="filter-minimum" placeholder="Enter amount">
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-maximum">Maximum</label>
                                        <input type="number" class="nsm-field form-control" id="filter-maximum" placeholder="Enter amount">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" type="reset">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end receiptsButton">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-upload'></i> Upload
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="receiptsUploadDropzone">Upload from computer</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="googleDriveConnectButton">Upload from Google Drive</a></li>
                            </ul>
                            <button type="button" class="nsm-button" id="receiptForwardingButton">
                                Set up receipt forwarding
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <table class="table nsm-table w-100" id="receiptsReview">
                        <thead>
                            <tr>
                                <th class="table-icon text-center">
                                    <input class="form-check-input select-all table-select" type="checkbox">
                                </th>
                                <th data-name="Receipt">RECEIPT</th>
                                <th data-name="Created by">CREATED BY</th>
                                <th data-name="Date">DATE</th>
                                <th data-name="Description">DESCRIPTION</th>
                                <th data-name="Payment Account">PAYMENT ACCOUNT</th>
                                <th data-name="Amount/Tax">AMOUNT/TAX</th>
                                <th data-name="Category">Category</th>
                                <th data-name="Manage"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count([]) > 0) : ?>
                            <?php foreach([] as $receipt) : ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox">
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Copy</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Disable</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>