<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Employee Details List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td colspan="9" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Hours" <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">HOURS</td>
                            <td data-name="Gross Pay" <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">GROSS PAY</td>
                            <td data-name="Other Pay" <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">OTHER PAY</td>
                            <td data-name="Employee Taxes and Deductions" <?=isset($columns) && !in_array('Employee Taxes and Deductions', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYEE TAXES & DEDUCTIONS</td>
                            <td data-name="Net Pay" <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?>>NET PAY</td>
                            <td data-name="Employer Taxes and Contributions" <?=isset($columns) && !in_array('Employer Taxes and Contributions', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYER TAXES & CONTRIBUTIONS</td>
                            <td data-name="Total Payroll Cost" <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end">TOTAL PAYROLL COST</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($paychecks) > 0) : ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                    <div class="col-12 col-md-6"><b><?=$totals['gross_hours']?>h</b></div>
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
                                    <div class="col-12 col-md-6"><b><?=$totals['adjusted_gross_pay']?></b></div>
                                    <?php else : ?>
                                    <div class="col-12"><b><?=$totals['gross_pay']?></b></div>
                                    <div class="col-12"><b><?=$totals['adjusted_gross_pay']?></b></div>
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
                                    <!-- <div class="col-12 col-md-6">SS</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['ss_tax']?></div>
                                    <div class="col-12 col-md-6">Med</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['medicare_tax']?></div> -->
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
                                        <!-- <div class="col-12 col-md-6">FL SUI</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_sui_tax']?></div>
                                        <div class="col-12 col-md-6">FUTA</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_futa_tax']?></div>
                                        <div class="col-12 col-md-6">SS</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_ss_tax']?></div>
                                        <div class="col-12 col-md-6">Med</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_medicare_tax']?></div> -->
                                        <?php endif; ?>
                                    </div>
                            </td>
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
                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['hours']?>h</div>
                                    <div class="col-12 col-md-6"><b>Adjusted Gross</b></div>
                                    <div class="col-12 col-md-6">&nbsp;</div>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12"><?=$paycheck['gross_pay']?></div>
                                    <div class="col-12"><?=$paycheck['employee_taxes']?></div>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['other_pay']?></td>
                            <td <?=isset($columns) && !in_array('Employee Taxes and Deductions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Total</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employee_taxes']?></div>
                                    <div class="col-12 col-md-6"><b>Employee Taxes</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employee_taxes']?></div>
                                    <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                    <div class="col-12 col-md-6">SS</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['ss_tax']?></div>
                                    <div class="col-12 col-md-6">Med</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['medicare_tax']?></div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?>><?=$paycheck['net_pay']?></td>
                            <td <?=isset($columns) && !in_array('Employer Taxes and Contributions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Total</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_taxes']?></div>
                                    <div class="col-12 col-md-6"><b>Employer Taxes</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_taxes']?></div>
                                    <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                    <div class="col-12 col-md-6">FL SUI</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_sui_tax']?></div>
                                    <div class="col-12 col-md-6">FUTA</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_futa_tax']?></div>
                                    <div class="col-12 col-md-6">SS</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_ss_tax']?></div>
                                    <div class="col-12 col-md-6">Med</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_medicare_tax']?></div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['total_payroll_cost']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="9">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-center">
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
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Employee Details List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="report_table_print">
                    <thead>
                        <tr>
                            <td colspan="9" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Hours" <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">HOURS</td>
                            <td data-name="Gross Pay" <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">GROSS PAY</td>
                            <td data-name="Other Pay" <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">OTHER PAY</td>
                            <td data-name="Employee Taxes and Deductions" <?=isset($columns) && !in_array('Employee Taxes and Deductions', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYEE TAXES & DEDUCTIONS</td>
                            <td data-name="Net Pay" <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?>>NET PAY</td>
                            <td data-name="Employer Taxes and Contributions" <?=isset($columns) && !in_array('Employer Taxes and Contributions', $columns) ? 'style="display: none"' : ''?> class="text-end">EMPLOYER TAXES & CONTRIBUTIONS</td>
                            <td data-name="Total Payroll Cost" <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end">TOTAL PAYROLL COST</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($paychecks) > 0) : ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                    <div class="col-12 col-md-6"><b><?=$totals['gross_hours']?>h</b></div>
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
                                    <div class="col-12 col-md-6"><b><?=$totals['adjusted_gross_pay']?></b></div>
                                    <?php else : ?>
                                    <div class="col-12"><b><?=$totals['gross_pay']?></b></div>
                                    <div class="col-12"><b><?=$totals['adjusted_gross_pay']?></b></div>
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
                                    <!-- <div class="col-12 col-md-6">SS</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['ss_tax']?></div>
                                    <div class="col-12 col-md-6">Med</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['medicare_tax']?></div> -->
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
                                        <!-- <div class="col-12 col-md-6">FL SUI</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_sui_tax']?></div>
                                        <div class="col-12 col-md-6">FUTA</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_futa_tax']?></div>
                                        <div class="col-12 col-md-6">SS</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_ss_tax']?></div>
                                        <div class="col-12 col-md-6">Med</div>
                                        <div class="col-12 col-md-6"><?=$paycheck['employer_medicare_tax']?></div> -->
                                        <?php endif; ?>
                                    </div>
                            </td>
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
                            <td <?=isset($columns) && !in_array('Hours', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Gross</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['hours']?>h</div>
                                    <div class="col-12 col-md-6"><b>Adjusted Gross</b></div>
                                    <div class="col-12 col-md-6">&nbsp;</div>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Gross Pay', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12"><?=$paycheck['gross_pay']?></div>
                                    <div class="col-12"><?=$paycheck['employee_taxes']?></div>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Other Pay', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['other_pay']?></td>
                            <td <?=isset($columns) && !in_array('Employee Taxes and Deductions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Total</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employee_taxes']?></div>
                                    <div class="col-12 col-md-6"><b>Employee Taxes</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employee_taxes']?></div>
                                    <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                    <div class="col-12 col-md-6">SS</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['ss_tax']?></div>
                                    <div class="col-12 col-md-6">Med</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['medicare_tax']?></div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Net Pay', $columns) ? 'style="display: none"' : ''?>><?=$paycheck['net_pay']?></td>
                            <td <?=isset($columns) && !in_array('Employer Taxes and Contributions', $columns) ? 'style="display: none"' : ''?> class="text-end">
                                <div class="row">
                                    <div class="col-12 col-md-6"><b>Total</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_taxes']?></div>
                                    <div class="col-12 col-md-6"><b>Employer Taxes</b></div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_taxes']?></div>
                                    <?php if(!isset($total_display) || isset($total_display) && $total_display === 'total-and-details') : ?>
                                    <div class="col-12 col-md-6">FL SUI</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_sui_tax']?></div>
                                    <div class="col-12 col-md-6">FUTA</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_futa_tax']?></div>
                                    <div class="col-12 col-md-6">SS</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_ss_tax']?></div>
                                    <div class="col-12 col-md-6">Med</div>
                                    <div class="col-12 col-md-6"><?=$paycheck['employer_medicare_tax']?></div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td <?=isset($columns) && !in_array('Total Payroll Cost', $columns) ? 'style="display: none"' : ''?> class="text-end"><?=$paycheck['total_payroll_cost']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="9">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-center">
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
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-who-to-include" aria-expanded="true" aria-controls="collapse-who-to-include">
                                        Who to include
                                    </button>
                                </h2>
                                <div id="collapse-who-to-include" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-4">
                                                <label for="filter-employee"><b>Employee</b></label>
                                                <select name="filter_employee" id="filter-employee" class="nsm-field form-control">
                                                    <option value="active" <?=$filter_status === 'active' ? 'selected' : ''?>>Active employees</option>
                                                    <option value="inactive" <?=$filter_status === 'inactive' ? 'selected' : ''?>>Inactive employees</option>
                                                    <option value="all" <?=empty($filter_status) || $filter_status === 'all' ? 'selected' : ''?>>All employees</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="total_display" value="totals-only" id="totals-only-display" <?=isset($total_display) && $total_display === 'totals-only' ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="totals-only-display">
                                                                Totals only
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="total_display" value="total-and-details" id="total-and-details-display" <?=!isset($total_display) || isset($total_display) && $total_display === 'total-and-details' ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="total-and-details-display">
                                                                Total and details
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <a href="#" class="text-decoration-none" id="<?=!isset($columns) ? 'unselect-all-columns' : 'select-all-columns'?>"><?=!isset($columns) ? 'Unselect' : 'Select'?> all</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-gross-pay" <?=isset($columns) && in_array('Gross Pay', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-gross-pay">
                                                                Gross Pay
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-other-pay" <?=isset($columns) && in_array('Other Pay', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-other-pay">
                                                                Other Pay
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-employer-taxes" <?=isset($columns) && in_array('Employer Taxes and Contributions', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-employer-taxes">
                                                                Employer Taxes & Contributions
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-employee-taxes" <?=isset($columns) && in_array('Employee Taxes and Deductions', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-employee-taxes">
                                                                Employee Taxes & Deductions
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-net-pay" <?=isset($columns) && in_array('Net Pay', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-net-pay">
                                                                Net Pay
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-hours" <?=isset($columns) && in_array('Hours', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-hours">
                                                                Hours
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-total-payroll-cost" <?=isset($columns) && in_array('Total Payroll Cost', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-total-payroll-cost">
                                                                Total Payroll Cost
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-pay-period" <?=isset($columns) && in_array('Pay Period', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-pay-period">
                                                                Pay Period
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-pay-method" <?=isset($columns) && in_array('Pay Method', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-pay-method">
                                                                Pay Method
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