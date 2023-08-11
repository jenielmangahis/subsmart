<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Payroll Tax Liability</span>
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
                            <td data-name="Tax Amount">TAX AMOUNT</td>
                            <td data-name="Tax Paid">TAX PAID</td>
                            <td data-name="Tax Owed">TAX OWED</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Federal Taxes (941/943/944)</b></td>
                            <td><b><?=number_format($data['federal_taxes_tax_amount'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_taxes_tax_paid'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_taxes_tax_owed'], 2)?></b></td>
                        </tr>
                        <tr>
                            <td>Federal Income Tax</td>
                            <td><?=number_format($data['federal_income_tax_amount'], 2)?></td>
                            <td><?=number_format($data['federal_income_tax_paid'], 2)?></td>
                            <td><?=number_format($data['federal_income_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Social Security</td>
                            <td><?=number_format($data['ss_tax_amount'], 2)?></td>
                            <td><?=number_format($data['ss_tax_paid'], 2)?></td>
                            <td><?=number_format($data['ss_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Social Security Employer</td>
                            <td><?=number_format($data['ss_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['ss_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['ss_employer_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Medicare</td>
                            <td><?=number_format($data['medicare_tax_amount'], 2)?></td>
                            <td><?=number_format($data['medicare_tax_paid'], 2)?></td>
                            <td><?=number_format($data['medicare_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Medicare Employer</td>
                            <td><?=number_format($data['medicare_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['medicare_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['medicare_employer_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td><b>Federal Unemployment</b></td>
                            <td><b><?=number_format($data['federal_unemployment_tax_amount'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_unemployment_tax_paid'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_unemployment_tax_owed'], 2)?></b></td>
                        </tr>
                        <tr>
                            <td>FUTA Employer</td>
                            <td><?=number_format($data['futa_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['futa_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['futa_employer_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td><b>FL Unemployment Tax</b></td>
                            <td><b><?=number_format($data['fl_unemployment_tax_amount'], 2)?></b></td>
                            <td><b><?=number_format($data['fl_unemployment_tax_paid'], 2)?></b></td>
                            <td><b><?=number_format($data['fl_unemployment_tax_owed'], 2)?></b></td>
                        </tr>
                        <tr>
                            <td>FL SUI Employer</td>
                            <td><?=number_format($data['fl_sui_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['fl_sui_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['fl_sui_employer_tax_owed'], 2)?></td>
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
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Payroll Tax Liability</span>
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
                            <td data-name="Tax Amount">TAX AMOUNT</td>
                            <td data-name="Tax Paid">TAX PAID</td>
                            <td data-name="Tax Owed">TAX OWED</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Federal Taxes (941/943/944)</b></td>
                            <td><b><?=number_format($data['federal_taxes_tax_amount'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_taxes_tax_paid'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_taxes_tax_owed'], 2)?></b></td>
                        </tr>
                        <tr>
                            <td>Federal Income Tax</td>
                            <td><?=number_format($data['federal_income_tax_amount'], 2)?></td>
                            <td><?=number_format($data['federal_income_tax_paid'], 2)?></td>
                            <td><?=number_format($data['federal_income_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Social Security</td>
                            <td><?=number_format($data['ss_tax_amount'], 2)?></td>
                            <td><?=number_format($data['ss_tax_paid'], 2)?></td>
                            <td><?=number_format($data['ss_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Social Security Employer</td>
                            <td><?=number_format($data['ss_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['ss_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['ss_employer_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Medicare</td>
                            <td><?=number_format($data['medicare_tax_amount'], 2)?></td>
                            <td><?=number_format($data['medicare_tax_paid'], 2)?></td>
                            <td><?=number_format($data['medicare_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td>Medicare Employer</td>
                            <td><?=number_format($data['medicare_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['medicare_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['medicare_employer_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td><b>Federal Unemployment</b></td>
                            <td><b><?=number_format($data['federal_unemployment_tax_amount'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_unemployment_tax_paid'], 2)?></b></td>
                            <td><b><?=number_format($data['federal_unemployment_tax_owed'], 2)?></b></td>
                        </tr>
                        <tr>
                            <td>FUTA Employer</td>
                            <td><?=number_format($data['futa_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['futa_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['futa_employer_tax_owed'], 2)?></td>
                        </tr>
                        <tr>
                            <td><b>FL Unemployment Tax</b></td>
                            <td><b><?=number_format($data['fl_unemployment_tax_amount'], 2)?></b></td>
                            <td><b><?=number_format($data['fl_unemployment_tax_paid'], 2)?></b></td>
                            <td><b><?=number_format($data['fl_unemployment_tax_owed'], 2)?></b></td>
                        </tr>
                        <tr>
                            <td>FL SUI Employer</td>
                            <td><?=number_format($data['fl_sui_employer_tax_amount'], 2)?></td>
                            <td><?=number_format($data['fl_sui_employer_tax_paid'], 2)?></td>
                            <td><?=number_format($data['fl_sui_employer_tax_owed'], 2)?></td>
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