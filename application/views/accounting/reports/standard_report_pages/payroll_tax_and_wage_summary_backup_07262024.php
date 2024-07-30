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
                                            <td data-name="Tax Types">TAX TYPES</td>
                                            <td data-name="Total Wages">TOTAL WAGES</td>
                                            <td data-name="Excess Wages">EXCESS WAGES</td>
                                            <td data-name="Taxable Wages">TAXABLE WAGES</td>
                                            <td data-name="Tax Amount">TAX AMOUNT</td>
                                            <td data-name="Tax Percentage" <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>>TAX PERCENTAGE</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Federal Taxes (941/943/944)</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=number_format($data['federal_taxes'], 2)?></b></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>></td>
                                        </tr>
                                        <tr>
                                            <td>Federal Income Tax</td>
                                            <td><?=number_format($data['federal_income_tax_wages'], 2)?></td>
                                            <td><?=number_format($data['federal_income_excess_wages'], 2)?></td>
                                            <td><?=number_format($data['federal_income_taxable_wages'], 2)?></td>
                                            <td><?=number_format($data['federal_income_tax_amount'], 2)?></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>><?=number_format($data['federal_income_tax_percentage'], 2)?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Social Security</td>
                                            <td><?=number_format($data['ss_tax_wages'], 2)?></td>
                                            <td><?=number_format($data['ss_excess_wages'], 2)?></td>
                                            <td><?=number_format($data['ss_taxable_wages'], 2)?></td>
                                            <td><?=number_format($data['ss_tax_amount'], 2)?></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>><?=number_format($data['ss_tax_percentage'], 2)?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Social Security Employer</td>
                                            <td><?=number_format($data['ss_employer_tax_wages'], 2)?></td>
                                            <td><?=number_format($data['ss_employer_excess_wages'], 2)?></td>
                                            <td><?=number_format($data['ss_employer_taxable_wages'], 2)?></td>
                                            <td><?=number_format($data['ss_employer_tax_amount'], 2)?></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>><?=number_format($data['ss_employer_tax_percentage'], 2)?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Medicare</td>
                                            <td><?=number_format($data['medicare_tax_wages'], 2)?></td>
                                            <td><?=number_format($data['medicare_excess_wages'], 2)?></td>
                                            <td><?=number_format($data['medicare_taxable_wages'], 2)?></td>
                                            <td><?=number_format($data['medicare_tax_amount'], 2)?></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>><?=number_format($data['medicare_tax_percentage'], 2)?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Medicare Employer</td>
                                            <td><?=number_format($data['medicare_employer_tax_wages'], 2)?></td>
                                            <td><?=number_format($data['medicare_employer_excess_wages'], 2)?></td>
                                            <td><?=number_format($data['medicare_employer_taxable_wages'], 2)?></td>
                                            <td><?=number_format($data['medicare_employer_tax_amount'], 2)?></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>><?=number_format($data['medicare_employer_tax_percentage'], 2)?>%</td>
                                        </tr>
                                        <tr>
                                            <td><b>Federal Unemployment</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=number_format($data['federal_unemployment'], 2)?></b></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>></td>
                                        </tr>
                                        <tr>
                                            <td>FUTA Employer</td>
                                            <td><?=number_format($data['futa_employer_tax_wages'], 2)?></td>
                                            <td><?=number_format($data['futa_employer_excess_wages'], 2)?></td>
                                            <td><?=number_format($data['futa_employer_taxable_wages'], 2)?></td>
                                            <td><?=number_format($data['futa_employer_tax_amount'], 2)?></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>><?=number_format($data['futa_employer_tax_percentage'], 2)?>%</td>
                                        </tr>
                                        <tr>
                                            <td><b>FL Unemployment Tax</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=number_format($data['fl_unemployment'], 2)?></b></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>></td>
                                        </tr>
                                        <tr>
                                            <td>FL SUI Employer</td>
                                            <td><?=number_format($data['fl_sui_employer_tax_wages'], 2)?></td>
                                            <td><?=number_format($data['fl_sui_employer_excess_wages'], 2)?></td>
                                            <td><?=number_format($data['fl_sui_employer_taxable_wages'], 2)?></td>
                                            <td><?=number_format($data['fl_sui_employer_tax_amount'], 2)?></td>
                                            <td <?=isset($columns) && !in_array('Tax Percentage', $columns) ? 'style="display: none"' : ''?>><?=number_format($data['fl_sui_employer_tax_percentage'], 2)?>%</td>
                                        </tr>
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