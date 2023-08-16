<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Total Pay</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td colspan="7" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="State">STATE</td>
                            <td data-name="Workers' Comp Class">WORKERS' COMP CLASS</td>
                            <td data-name="Premium Wage Paid">PREMIUM WAGE PAID</td>
                            <td data-name="Tips Paid">TIPS PAID</td>
                            <td data-name="Employee Taxes Paid by Employer">EMPLOYEE TAXES PAID BY EMPLOYER</td>
                            <td data-name="Wages Paid">WAGES PAID</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($comps) > 0) : ?>
                        <?php foreach($comps as $index => $comp) : ?>
                        <tr>
                            <td><?=$comp['employee']?></td>
                            <td><?=$comp['state']?></td>
                            <td><?=$comp['workers_comp_class']?></td>
                            <td><?=number_format($comp['premium_wage_paid'], 2)?></td>
                            <td><?=number_format($comp['tips_paid'], 2)?></td>
                            <td><?=number_format($comp['employee_taxes_paid_by_employer'], 2)?></td>
                            <td><?=number_format($comp['wages_paid'], 2)?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td></td>
                            <td><b><?=number_format($totals['premium_wage_paid'], 2)?></b></td>
                            <td><b><?=number_format($totals['tips_paid'], 2)?></b></td>
                            <td><b><?=number_format($totals['employee_taxes_paid_by_employer'], 2)?></b></td>
                            <td><b><?=number_format($totals['wages_paid'], 2)?></b></td>
                        </tr>
                        <?php else : ?>
                        <tr>
                            <td colspan="7">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-center">
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
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Total Pay</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="report_table_print">
                    <thead>
                        <tr>
                            <td colspan="7" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="State">STATE</td>
                            <td data-name="Workers' Comp Class">WORKERS' COMP CLASS</td>
                            <td data-name="Premium Wage Paid">PREMIUM WAGE PAID</td>
                            <td data-name="Tips Paid">TIPS PAID</td>
                            <td data-name="Employee Taxes Paid by Employer">EMPLOYEE TAXES PAID BY EMPLOYER</td>
                            <td data-name="Wages Paid">WAGES PAID</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($comps) > 0) : ?>
                        <?php foreach($comps as $index => $comp) : ?>
                        <tr>
                            <td><?=$comp['employee']?></td>
                            <td><?=$comp['state']?></td>
                            <td><?=$comp['workers_comp_class']?></td>
                            <td><?=number_format($comp['premium_wage_paid'], 2)?></td>
                            <td><?=number_format($comp['tips_paid'], 2)?></td>
                            <td><?=number_format($comp['employee_taxes_paid_by_employer'], 2)?></td>
                            <td><?=number_format($comp['wages_paid'], 2)?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td></td>
                            <td><b><?=number_format($totals['premium_wage_paid'], 2)?></b></td>
                            <td><b><?=number_format($totals['tips_paid'], 2)?></b></td>
                            <td><b><?=number_format($totals['employee_taxes_paid_by_employer'], 2)?></b></td>
                            <td><b><?=number_format($totals['wages_paid'], 2)?></b></td>
                        </tr>
                        <?php else : ?>
                        <tr>
                            <td colspan="7">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-center">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>