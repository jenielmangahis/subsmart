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
                            <td colspan="3" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Item">ITEM</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><b>Total pay</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Paycheck wages</td>
                                <td><?=number_format($total_pay['paycheck_wages'], 2)?></td>
                            </tr>
                            <tr>
                                <td>Non-paycheck wages</td>
                                <td><?=number_format($total_pay['non_paycheck_wages'], 2)?></td>
                            </tr>
                            <tr>
                                <td>Reimbursements</td>
                                <td><?=number_format($total_pay['reimbursements'], 2)?></td>
                            </tr>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td><b><?=number_format($total_pay['subtotal'], 2)?></b></td>
                            </tr>
                            <tr>
                                <td><b>Company Contributions</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td><b><?=number_format($company_contributions['subtotal'], 2)?></b></td>
                            </tr>
                            <tr>
                                <td><b>Employer taxes</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Social Security Employer</td>
                                <td><?=number_format($employer_taxes['ss_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td>Medicare Employer</td>
                                <td><?=number_format($employer_taxes['medicare_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td>FUTA Employer</td>
                                <td><?=number_format($employer_taxes['futa_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td>FL SUI Employer</td>
                                <td><?=number_format($employer_taxes['fl_sui_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td><b><?=number_format($employer_taxes['subtotal'], 2)?></b></td>
                            </tr>
                            <tr>
                                <td><b>Total payroll cost</b></td>
                                <td><b><?=number_format($total_payroll_cost, 2)?></b></td>
                            </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">
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
                            <td colspan="3" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Item">ITEM</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><b>Total pay</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Paycheck wages</td>
                                <td><?=number_format($total_pay['paycheck_wages'], 2)?></td>
                            </tr>
                            <tr>
                                <td>Non-paycheck wages</td>
                                <td><?=number_format($total_pay['non_paycheck_wages'], 2)?></td>
                            </tr>
                            <tr>
                                <td>Reimbursements</td>
                                <td><?=number_format($total_pay['reimbursements'], 2)?></td>
                            </tr>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td><b><?=number_format($total_pay['subtotal'], 2)?></b></td>
                            </tr>
                            <tr>
                                <td><b>Company Contributions</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td><b><?=number_format($company_contributions['subtotal'], 2)?></b></td>
                            </tr>
                            <tr>
                                <td><b>Employer taxes</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Social Security Employer</td>
                                <td><?=number_format($employer_taxes['ss_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td>Medicare Employer</td>
                                <td><?=number_format($employer_taxes['medicare_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td>FUTA Employer</td>
                                <td><?=number_format($employer_taxes['futa_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td>FL SUI Employer</td>
                                <td><?=number_format($employer_taxes['fl_sui_employer'], 2)?></td>
                            </tr>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td><b><?=number_format($employer_taxes['subtotal'], 2)?></b></td>
                            </tr>
                            <tr>
                                <td><b>Total payroll cost</b></td>
                                <td><b><?=number_format($total_payroll_cost, 2)?></b></td>
                            </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>