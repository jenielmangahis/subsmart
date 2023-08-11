<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Payroll Tax and Wage Summary</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td colspan="12" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="12" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="12" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
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
                    <tfoot>
                        <tr>
                            <td colspan="12" class="text-center">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_report">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_report_modal" tabindex="-1" aria-labelledby="print_preview_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Payroll Tax and Wage Summary</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="report_table_print">
                    <thead>
                        <tr>
                            <td colspan="12" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="12" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="12" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
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
                    <tfoot>
                        <tr>
                            <td colspan="12" class="text-center">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="settings-modal" tabindex="-1" aria-labelledby="settings_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="settings_modal_label">Customize report</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-what-to-include" aria-expanded="true" aria-controls="collapse-what-to-include">
                                        What to include
                                    </button>
                                </h2>
                                <div id="collapse-what-to-include" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <a href="#" class="text-decoration-none" id="<?=!isset($columns) ? 'unselect-all-columns' : 'select-all-columns'?>"><?=!isset($columns) ? 'Unselect' : 'Select'?> all</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-tax-percentage" <?=isset($columns) && in_array('Tax Percentage', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-tax-percentage">
                                                                Tax Percentage
                                                            </label>
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
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" id="run-report-button">Run report</button>
            </div>
        </div>
    </div>
</div>