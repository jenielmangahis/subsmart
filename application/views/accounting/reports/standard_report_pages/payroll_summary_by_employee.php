<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath("v2/includes/accounting/reports/$modalsView"); ?>

<style>
    #display-by-col {
        margin-left: 0 !important;
    }
    #display-by-col i {
        transform: rotate(90deg);
    }
    .display-button.active {
        border-color: rgba(106, 74, 134, 0.1);
        background-color: rgba(106, 74, 134, 0.5);
        color: #6a4a86;
    }
    .display-button.active i {
        color: #6a4a86;
    }
</style>
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
                            <div class="btn-group" role="group">
                                <button type="button" class="nsm-button display-button <?=!empty($display_by) && $display_by === 'row' ? 'active' : '' ?>" id="display-by-row">
                                    <i class='bx bx-fw bx-menu'></i>
                                </button>
                                <button type="button" class="nsm-button display-button <?=empty($display_by) || $display_by === 'col' ? 'active' : '' ?>" id="display-by-col">
                                    <i class='bx bx-fw bx-menu'></i>
                                </button>
                            </div>
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
                                            <?php if(empty($display_by) || $display_by === 'col') : ?>
                                            <td data-name="Payroll">PAYROLL</td>
                                            <td data-name="Total" class="text-end">TOTAL</td>
                                            <?php foreach($data as $row) : ?>
                                            <td data-name="<?=$row['name']?>" class="text-end"><?=$row['name']?></td>
                                            <?php endforeach; ?>
                                            <?php else : ?>
                                            <td data-name="Name"><?=empty($group_by) ? 'NAME' : 'TIME PERIOD'?></td>
                                            <td data-name="Hours" <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">HOURS</td>
                                            <td data-name="Gross Pay" <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">GROSS PAY</td>
                                            <td data-name="Other Pay" <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">OTHER PAY</td>
                                            <td data-name="Employee Taxes and Deductions" <?=isset($columns) && !in_array('Employee Taxes and Deductions', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYEE TAXES & DEDUCTIONS</td>
                                            <td data-name="Net Pay" <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?>>NET PAY</td>
                                            <td data-name="Employer Taxes and Contributions" <?=isset($columns) && !in_array('Employer Taxes and Contributions', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYER TAXES & CONTRIBUTIONS</td>
                                            <td data-name="Total Payroll Cost" <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end">TOTAL PAYROLL COST</td>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(empty($display_by) || $display_by === 'col') : ?>
                                        <?php if(isset($columns) && in_array('Hours', $columns) || !isset($columns)) :?>
                                        <tr>
                                            <td><b>Hours</b></td>
                                            <td class="text-end"><b><?=$totals['hours'] > 0 ? $totals['hours'].'h' : '-'?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=$row['hours'] > 0 ? $row['hours'].'h' : '-'?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if(isset($columns) && in_array('Gross Pay', $columns) || !isset($columns)) :?>
                                        <tr>
                                            <td><b>Gross Pay</b></td>
                                            <td class="text-end"><b><?=$totals['gross_pay']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['gross_pay'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                        <tr>
                                            <td>Commission</td>
                                            <td class="text-end"><?=$totals['commission']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['commission'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td><b>Adjusted gross</b></td>
                                            <td class="text-end"><b><?=$totals['adjusted_gross']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['adjusted_gross'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if(isset($columns) && in_array('Employee Taxes and Deductions', $columns) || !isset($columns)) :?>
                                        <tr>
                                            <td><b>Employee taxes & deductions</b></td>
                                            <td class="text-end"><b><?=$totals['employee_taxes']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['employee_taxes'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td><b>Employee taxes</b></td>
                                            <td class="text-end"><b><?=$totals['employee_taxes']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['employee_taxes'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                        <tr>
                                            <td>Federal Income Tax</td>
                                            <td class="text-end"><?=$totals['federal_income_tax']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['federal_income_tax'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td>Social Security</td>
                                            <td class="text-end"><?=$totals['ss_tax']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['ss_tax'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td>Medicare</td>
                                            <td class="text-end"><?=$totals['medicare_tax']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['medicare_tax'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(isset($columns) && in_array('Net Pay', $columns) || !isset($columns)) :?>
                                        <tr>
                                            <td><b>Net pay</b></td>
                                            <td class="text-end"><b><?=$totals['net_pay']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['net_pay'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if(isset($columns) && in_array('Employer Taxes and Contributions', $columns) || !isset($columns)) :?>
                                        <tr>
                                            <td><b>Employer taxes & contributions</b></td>
                                            <td class="text-end"><b><?=$totals['employer_taxes']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['employer_taxes'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td><b>Employer taxes</b></td>
                                            <td class="text-end"><b><?=$totals['employer_taxes']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['employer_taxes'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                        <tr>
                                            <td>FUTA Employer</td>
                                            <td class="text-end"><?=$totals['futa_employer']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['futa_employer'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td>Social Security Employer</td>
                                            <td class="text-end"><?=$totals['ss_employer']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['ss_employer'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td>Medicare Employer</td>
                                            <td class="text-end"><?=$totals['medicare_employer']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['medicare_employer'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td>FL SUI Employer</td>
                                            <td class="text-end"><?=$totals['fl_sui_employer']?></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['fl_sui_employer'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(isset($columns) && in_array('Total Payroll Cost', $columns) || !isset($columns)) :?>
                                        <tr>
                                            <td><b>Total payroll cost</b></td>
                                            <td class="text-end"><b><?=$totals['total_payroll_cost']?></b></td>
                                            <?php foreach($data as $row) : ?>
                                            <td class="text-end"><?=number_format($row['total_payroll_cost'], 2)?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php endif; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                                    <div class="col-12 col-md-6"><b><?=$totals['hours'] > 0 ? $totals['hours'].'h' : '-'?></b></div>
                                                    <div class="col-12 col-md-6"><b>Adjusted Gross</b></div>
                                                    <div class="col-12 col-md-6">&nbsp;</div>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                    <?php if(isset($columns) && !in_array('Hours', $columns)) : ?>
                                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                                    <div class="col-12 col-md-6"><b><?=$totals['gross_pay']?></b></div>
                                                    <div class="col-12 col-md-6"><b>Adjusted Gross</b></div>
                                                    <div class="col-12 col-md-6"><b><?=$totals['adjusted_gross']?></b></div>
                                                    <?php else : ?>
                                                    <div class="col-12"><b><?=$totals['gross_pay']?></b></div>
                                                    <div class="col-12"><b><?=$totals['adjusted_gross']?></b></div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"></td>
                                            <td <?=isset($columns) && !in_array('Employee Taxes and Deductions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                    <div class="col-12 col-md-6"><b>Total</b></div>
                                                    <div class="col-12 col-md-6"><b><?=$totals['employee_taxes']?></b></div>
                                                    <div class="col-12 col-md-6"><b>Employee Taxes</b></div>
                                                    <div class="col-12 col-md-6"><b><?=$totals['employee_taxes']?></b></div>
                                                    <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                                    <div class="col-12 col-md-6">SS</div>
                                                    <div class="col-12 col-md-6"><?=$totals['ss_tax']?></div>
                                                    <div class="col-12 col-md-6">Med</div>
                                                    <div class="col-12 col-md-6"><?=$totals['medicare_tax']?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?>><b><?=$totals['net_pay']?></b></td>
                                            <td <?=isset($columns) && !in_array('Employer Taxes and Contributions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                        <div class="col-12 col-md-6"><b>Total</b></div>
                                                        <div class="col-12 col-md-6"><b><?=$totals['employer_taxes']?></b></div>
                                                        <div class="col-12 col-md-6"><b>Employer Taxes</b></div>
                                                        <div class="col-12 col-md-6"><b><?=$totals['employer_taxes']?></b></div>
                                                        <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                                        <div class="col-12 col-md-6">FL SUI</div>
                                                        <div class="col-12 col-md-6"><?=$totals['fl_sui_employer']?></div>
                                                        <div class="col-12 col-md-6">FUTA</div>
                                                        <div class="col-12 col-md-6"><?=$totals['futa_employer']?></div>
                                                        <div class="col-12 col-md-6">SS</div>
                                                        <div class="col-12 col-md-6"><?=$totals['ss_employer']?></div>
                                                        <div class="col-12 col-md-6">Med</div>
                                                        <div class="col-12 col-md-6"><?=$totals['medicare_employer']?></div>
                                                        <?php endif; ?>
                                                    </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end"><b><?=$totals['total_payroll_cost']?></b></td>
                                        </tr>
                                        <?php foreach($data as $row) : ?>
                                        <tr>
                                            <td><?=$row['name']?></td>
                                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                                    <div class="col-12 col-md-6"><?=$row['hours']?>h</div>
                                                    <div class="col-12 col-md-6"><b>Adjusted Gross</b></div>
                                                    <div class="col-12 col-md-6">&nbsp;</div>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                    <?php if(isset($columns) && !in_array('Hours', $columns)) : ?>
                                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['gross_pay'], 2)?></div>
                                                    <div class="col-12 col-md-6"><b>Adjusted Gross</b></div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['gross_pay'], 2)?></div>
                                                    <?php else : ?>
                                                    <div class="col-12"><?=number_format($row['gross_pay'], 2)?></div>
                                                    <div class="col-12"><?=number_format($row['gross_pay'], 2)?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$row['other_pay']?></td>
                                            <td <?=isset($columns) && !in_array('Employee Taxes and Deductions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                    <div class="col-12 col-md-6"><b>Total</b></div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['employee_taxes'], 2)?></div>
                                                    <div class="col-12 col-md-6"><b>Employee Taxes</b></div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['employee_taxes'], 2)?></div>
                                                    <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                                    <div class="col-12 col-md-6">SS</div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['ss_tax'], 2)?></div>
                                                    <div class="col-12 col-md-6">Med</div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['medicare_tax'], 2)?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?>><?=$row['net_pay']?></td>
                                            <td <?=isset($columns) && !in_array('Employer Taxes and Contributions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                                <div class="row">
                                                    <div class="col-12 col-md-6"><b>Total</b></div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['employer_taxes'], 2)?></div>
                                                    <div class="col-12 col-md-6"><b>Employer Taxes</b></div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['employer_taxes'], 2)?></div>
                                                    <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                                    <div class="col-12 col-md-6">FL SUI</div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['sui_employer'], 2)?></div>
                                                    <div class="col-12 col-md-6">FUTA</div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['futa_employer'], 2)?></div>
                                                    <div class="col-12 col-md-6">SS</div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['ss_employer'], 2)?></div>
                                                    <div class="col-12 col-md-6">Med</div>
                                                    <div class="col-12 col-md-6"><?=number_format($row['medicare_employer'], 2)?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=number_format($row['total_payroll_cost'], 2)?></td>
                                        </tr>
                                        <?php endforeach; ?>
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