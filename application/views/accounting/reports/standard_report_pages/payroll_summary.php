<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath("v2/includes/accounting/reports/$modalsView"); ?>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="filter-report-period">Report period</label>
                                        <select class="nsm-field form-select" name="filter_report_period" id="filter-report-period">
                                            <option value="last-pay-date" <?=empty($filter_date) || $filter_date === 'last-pay-date' ? 'selected' : ''?>>Last pay date</option>
                                            <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This Month</option>
                                            <option value="this-quarter" <?=$filter_date === 'this-quarter' ? 'selected' : ''?>>This Quarter</option>
                                            <option value="this-year" <?=$filter_date === 'this-year' ? 'selected' : ''?>>This Year</option>
                                            <option value="last-month" <?=$filter_date === 'last-month' ? 'selected' : ''?>>Last Month</option>
                                            <option value="last-quarter" <?=$filter_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                            <option value="last-year" <?=$filter_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                            <option value="first-quarter" <?=$filter_date === 'first-quarter' ? 'selected' : ''?>>First quarter</option>
                                            <option value="second-quarter" <?=$filter_date === 'second-quarter' ? 'selected' : ''?>>Second quarter</option>
                                            <option value="third-quarter" <?=$filter_date === 'third-quarter' ? 'selected' : ''?>>Third quarter</option>
                                            <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if(!empty($filter_date) && $filter_date !== 'all-dates' || empty($filter_date)) : ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="filter-report-period-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="filter-report-period-to">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary" id="run-report">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#settings-modal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center">
                    <div class="col-auto">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_report_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <div class="col-12 grid-mb">
                                        <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0 fw-bold"><?=$report_title?></p>
                                    </div>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0"><?=$report_period?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Pay Date">PAY DATE</td>
                                            <td data-name="Name">NAME</td>
                                            <td data-name="Hours" <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?>>HOURS</td>
                                            <td data-name="Gross Pay" <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">GROSS PAY</td>
                                            <td data-name="Pretax Deductions" <?=isset($columns) && !in_array('Pretax Deductions', $columns) ? 'style="display: none"' : ''?>>PRETAX DEDUCTIONS</td>
                                            <td data-name="Other Pay" <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?>>OTHER PAY</td>
                                            <td data-name="Employee Taxes" <?=isset($columns) && !in_array('Employee Taxes', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYEE TAXES</td>
                                            <td data-name="Aftertax Deductions" <?=isset($columns) && !in_array('Aftertax Deductions', $columns) ? 'style="display: none"' : ''?>>AFTERTAX DEDUCTIONS</td>
                                            <td data-name="Net Pay" <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">NET PAY</td>
                                            <td data-name="Employer Taxes" <?=isset($columns) && !in_array('Employer Taxes', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYER TAXES</td>
                                            <td data-name="Company Contributions" <?=isset($columns) && !in_array('Company Contributions', $columns) ? 'style="display: none"' : ''?>>COMPANY CONTRIBUTIONS</td>
                                            <td data-name="Total Payroll Cost" <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end">TOTAL PAYROLL COST</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($paychecks) > 0) : ?>
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td></td>
                                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?>><b><?=$totals['hours']?>h</b></td>
                                            <td <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"><b><?=$totals['gross_pay']?></b></td>
                                            <td <?=isset($columns) && !in_array('Pretax Deductions', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Employee Taxes', $columns) ? 'style="display: none"' : ''?> class="text-end"><b><?=$totals['employee_taxes']?></b></td>
                                            <td <?=isset($columns) && !in_array('Aftertax Deductions', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"><b><?=$totals['net_pay']?></b></td>
                                            <td <?=isset($columns) && !in_array('Employer Taxes', $columns) ? 'style="display: none"' : ''?> class="text-end"><b><?=$totals['employer_taxes']?></b></td>
                                            <td <?=isset($columns) && !in_array('Company Contributions', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end"><b><?=$totals['total_payroll_cost']?></b></td>
                                        </tr>
                                        <?php foreach($paychecks as $index => $paycheck) : ?>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-12"><b><?=$paycheck['pay_date']?></b></div>
                                                    <div class="col-12"><?=isset($columns) && in_array('Pay Period', $columns) || !isset($columns) ? $paycheck['pay_period'] : ''?></div>
                                                </div>
                                            </td>
                                            <td><?=$paycheck['name']?></td>
                                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?>><?=$paycheck['hours']?>h</td>
                                            <td <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['gross_pay']?></td>
                                            <td <?=isset($columns) && !in_array('Pretax Deductions', $columns) ? 'style="display: none"' : ''?>><?=$paycheck['pretax_deductions']?></td>
                                            <td <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?>><?=$paycheck['other_pay']?></td>
                                            <td <?=isset($columns) && !in_array('Employee Taxes', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['employee_taxes']?></td>
                                            <td <?=isset($columns) && !in_array('Aftertax Deductions', $columns) ? 'style="display: none"' : ''?>><?=$paycheck['aftertax_deductions']?></td>
                                            <td <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['net_pay']?></td>
                                            <td <?=isset($columns) && !in_array('Employer Taxes', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['employer_taxes']?></td>
                                            <td <?=isset($columns) && !in_array('Company Contributions', $columns) ? 'style="display: none"' : ''?>><?=$paycheck['company_contributions']?></td>
                                            <td <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['total_payroll_cost']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="12">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0"><?=date($prepared_timestamp)?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const companyName = "<?=$clients->business_name?>"
</script>
<?php include viewPath('v2/includes/footer'); ?>