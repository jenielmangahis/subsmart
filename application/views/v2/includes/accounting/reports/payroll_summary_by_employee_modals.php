<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Payroll Summary by Employee</span>
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
                            <?php if(empty($display_by) || $display_by === 'row') : ?>
                            <td>PAYROLL</td>
                            <td class="text-end">TOTAL</td>
                            <?php foreach($data as $row) : ?>
                            <td class="text-end"><?=$row['name']?></td>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <td data-name="Name">NAME</td>
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
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Payroll Summary by Employee</span>
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
                            <?php if(empty($display_by) || $display_by === 'row') : ?>
                            <td>PAYROLL</td>
                            <td class="text-end">TOTAL</td>
                            <?php foreach($data as $row) : ?>
                            <td class="text-end"><?=$row['name']?></td>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <td data-name="Name">NAME</td>
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
                                                    <option value="active" <?=$filter_status === 'active' ? 'selected' : ''?>>Active data</option>
                                                    <option value="inactive" <?=$filter_status === 'inactive' ? 'selected' : ''?>>Inactive data</option>
                                                    <option value="all" <?=empty($filter_status) || $filter_status === 'all' ? 'selected' : ''?>>All data</option>
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
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-how-to-group-results" aria-expanded="true" aria-controls="collapse-how-to-group-results">
                                        How to group results
                                    </button>
                                </h2>
                                <div id="collapse-what-to-include" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-4">
                                                <label for="group-by"><b>Group by</b></label>
                                                <select name="group_by" id="group-by" class="nsm-field form-control">
                                                    <option value="employee" <?=empty($group_by) || $group_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                                    <option value="weekly" <?=$group_by === 'weekly' ? 'selected' : ''?>>Weekly</option>
                                                    <option value="bi-weekly" <?=$group_by === 'bi-weekly' ? 'selected' : ''?>>Bi-weekly</option>
                                                    <option value="monthly" <?=$group_by === 'monthly' ? 'selected' : ''?>>Monthly</option>
                                                    <option value="quarterly" <?=$group_by === 'quarterly' ? 'selected' : ''?>>Quarterly</option>
                                                    <option value="yearly" <?=$group_by === 'yearly' ? 'selected' : ''?>>Yearly</option>
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