<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/employees_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb"></div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content" id="table-filters">
                                <div class="row">
                                    <div class="col grid-mb">
                                        <label for="filter-employee">Employee</label>
                                        <select class="nsm-field form-select" name="filter_employee" id="filter-employee" data-applied="all-employees">
                                            <option value="all-employees" selected>All employees</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 grid-mb">
                                        <label for="filter-date-range">Date range</label>
                                        <select class="nsm-field form-select" name="filter_date_range" id="filter-date-range" data-applied="last-pay-date">
                                            <option value="last-pay-date" selected>Last pay date</option>
                                            <option value="this-month">This month</option>
                                            <option value="this-quarter">This quarter</option>
                                            <option value="this-year">This year</option>
                                            <option value="last-month">Last month</option>
                                            <option value="last-quarter">Last quarter</option>
                                            <option value="last-year">Last year</option>
                                            <option value="first-quarter">First quarter</option>
                                            <option value="second-quarter">Second quarter</option>
                                            <option value="third-quarter">Third quarter</option>
                                            <option value="fourth-quarter">Fourth quarter</option>
                                            <option value="custom">Custom</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 grid-mb">
                                        <label for="filter-from-date">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 grid-mb">
                                        <label for="filter-to-date">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="">
                                        </div>
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
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Share <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="print-save-pdf">Print or save PDF</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="paycheck-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Pay date">PAY DATE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Total pay">TOTAL PAY</td>
                            <td data-name="Net pay">NET PAY</td>
                            <td data-name="Pay method">PAY METHOD</td>
                            <td data-name="Check number">CHECK NUMBER</td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count([]) > 0) : ?>
						<?php foreach([] as $paycheck) : ?>

                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="14">
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