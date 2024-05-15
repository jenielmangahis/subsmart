<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/paycheck_list_modals'); ?>

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
                    <div class="col-12 col-md-4 grid-mb">
                        <form id="search_form" action="javascript:void(0);" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find an employee" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
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
                                <li><a class="dropdown-item" href="javascript:void(0);" id="batch-delete">Delete</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="batch-void">Void</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content" id="table-filters">
                                <div class="row">
                                    <div class="col grid-mb">
                                        <label for="filter-employee">Employee</label>
                                        <select class="nsm-field form-select" name="filter_employee[]" id="filter-employee" multiple="multiple">
                                            <option value="all">All</option>
                                            <?php foreach ($employees as $employee) : ?>
                                                <option value="<?= $employee->id ?>" <?= isset($selectedEmployee) && $selectedEmployee->id == $employee->id ? 'selected' : '' ?>>
                                                    <?= $employee->name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <select class="nsm-field form-select" name="filter_employee" id="filter-employee">
                                            <?php if (isset($employee)) : ?>
                                                <option value="<?= $employee->id ?>" selected><?= $employee->name ?></option>
                                            <?php else : ?>
                                                <option value="all" selected>All</option>
                                            <?php endif; ?>
                                        </select> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 grid-mb">
                                        <label for="filter-date-range">Date range</label>
                                        <select class="nsm-field form-select" name="filter_date_range" id="filter-date-range" data-applied="last-pay-date">
                                            <option value="last-pay-date" <?= empty($filter_date) || $filter_date === 'last-pay-date' ? 'selected' : '' ?>>Last pay date</option>
                                            <option value="this-month" <?= $filter_date === 'this-month' ? 'selected' : '' ?>>This month</option>
                                            <option value="this-quarter" <?= $filter_date === 'this-quarter' ? 'selected' : '' ?>>This quarter</option>
                                            <option value="this-year" <?= $filter_date === 'this-year' ? 'selected' : '' ?>>This year</option>
                                            <option value="last-month" <?= $filter_date === 'last-month' ? 'selected' : '' ?>>Last month</option>
                                            <option value="last-quarter" <?= $filter_date === 'last-quarter' ? 'selected' : '' ?>>Last quarter</option>
                                            <option value="last-year" <?= $filter_date === 'last-year' ? 'selected' : '' ?>>Last year</option>
                                            <option value="first-quarter" <?= $filter_date === 'first-quarter' ? 'selected' : '' ?>>First quarter</option>
                                            <option value="second-quarter" <?= $filter_date === 'second-quarter' ? 'selected' : '' ?>>Second quarter</option>
                                            <option value="third-quarter" <?= $filter_date === 'third-quarter' ? 'selected' : '' ?>>Third quarter</option>
                                            <option value="fourth-quarter" <?= $filter_date === 'fourth-quarter' ? 'selected' : '' ?>>Fourth quarter</option>
                                            <option value="custom" <?= $filter_date === 'custom' ? 'selected' : '' ?>>Custom</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 grid-mb">
                                        <label for="filter-from-date">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" id="date-range-start" value="<?= $start_date ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 grid-mb">
                                        <label for="filter-to-date">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" id="date-range-end" value="<?= $end_date ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-filter">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-filter">
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
                                <li><a class="dropdown-item" href="javascript:void(0);" id="print-save-pdf" data-bs-toggle="modal" data-bs-target="#print-save-pdf-modal">Print or save PDF</a></li>
                            </ul>
                            <button type="button" class="dropdown-toggle nsm-button print-paychecks-button" disabled>
                                Print
                            </button>
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
                        <?php if (count($paychecks) > 0) : ?>
                            <?php foreach ($paychecks as $paycheck) : ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon table-checkbox">
                                            <input class="form-check-input select-one table-select" type="checkbox" value="<?= $paycheck['id'] ?>">
                                        </div>
                                    </td>
                                    <td><?= isset($paycheck['pay_date']) ? $paycheck['pay_date'] : 'No pay date' ?></td>
                                    <td><?= isset($paycheck['name']) ? $paycheck['name'] : 'No name provided' ?></td>
                                    <td><?= isset($paycheck['total_pay']) ? str_replace('$-', '-$', '$' . $paycheck['total_pay']) : '0' ?></td>
                                    <td><?= isset($paycheck['net_pay']) ? str_replace('$-', '-$', '$' . $paycheck['net_pay']) : '0' ?></td>
                                    <td><?= isset($paycheck['pay_method']) ? $paycheck['pay_method'] : 'No payment method' ?></td>
                                    <td><?= !in_array($paycheck['check_number'], ['-', 'Void']) ? '<input type="text" name="check_number[]" class="form-control nsm-field" value="' . $paycheck['check_number'] . '">' : $paycheck['check_number'] ?></td>
                                    <td><?= $paycheck['status'] ?></td>
                                    <td>
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item print-paycheck" href="#">Print</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-paycheck" href="#">Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item void-paycheck" href="#">Void</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item edit-paycheck" href="#">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr class="no-results">
                                <td colspan="9">
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