<?php include viewPath('v2/includes/accounting_header'); ?>

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
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by name or conditions">
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="confirm">Confirm selected</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="review">Review selected</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="delete">Delete selected</a></li>
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

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-upload'></i> Upload
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="upload-from-computer">Upload from computer</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="upload-from-google-drive">Upload from Google Drive</a></li>
                            </ul>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_conditions" id="chk_conditions" class="form-check-input">
                                    <label for="chk_conditions" class="form-check-label">Conditions</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_settings" id="chk_settings" class="form-check-input">
                                    <label for="chk_settings" class="form-check-label">Settings</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_status" id="chk_status" class="form-check-input">
                                    <label for="chk_status" class="form-check-label">Status</label>
                                </div>
                                <p class="m-0">Page Size</p>
                                <div class="form-check">
                                    <input type="radio" checked="checked" name="page_size" id="page-size-50" class="form-check-input">
                                    <label for="page-size-50" class="form-check-label">50</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-75" class="form-check-input">
                                    <label for="page-size-75" class="form-check-label">75</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-100" class="form-check-input">
                                    <label for="page-size-100" class="form-check-label">100</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-200" class="form-check-input">
                                    <label for="page-size-200" class="form-check-label">200</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-300" class="form-check-input">
                                    <label for="page-size-300" class="form-check-label">300</label>
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
                            <td data-name="Receipt">RECEIPT</td>
                            <td data-name="Created by">CREATED BY</td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Description">DESCRIPTION</td>
                            <td data-name="Payment Account">PAYMENT ACCOUNT</td>
                            <td data-name="Amount/Tax">AMOUNT/TAX</td>
                            <td data-name="Category">Category</td>
                            <td data-name="Manage"></td>
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

<?php include viewPath('v2/includes/footer'); ?>