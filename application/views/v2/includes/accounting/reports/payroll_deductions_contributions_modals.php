<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Payroll Deductions/Contributions</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td colspan="5" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Description">DESCRIPTION</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Employee Deductions">EMPLOYEE DEDUCTIONS</td>
                            <td data-name="Company Contributions">COMPANY CONTRIBUTIONS</td>
                            <td data-name="Plan Total">PLAN TOTAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($data) > 0) : ?>
                        <?php foreach($data as $index => $row) : ?>
                        <tr>
                            <td><?=$row['description']?></td>
                            <td><?=$row['type']?></td>
                            <td><?=$row['employee_deductions']?></td>
                            <td><?=$row['company_contributions']?></td>
                            <td><?=$row['plan_total']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="5">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">
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
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Payroll Deductions/Contributions</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="report_table_print">
                    <thead>
                        <tr>
                            <td colspan="5" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Description">DESCRIPTION</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Employee Deductions">EMPLOYEE DEDUCTIONS</td>
                            <td data-name="Company Contributions">COMPANY CONTRIBUTIONS</td>
                            <td data-name="Plan Total">PLAN TOTAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($data) > 0) : ?>
                        <?php foreach($data as $index => $row) : ?>
                        <tr>
                            <td><?=$row['description']?></td>
                            <td><?=$row['type']?></td>
                            <td><?=$row['employee_deductions']?></td>
                            <td><?=$row['company_contributions']?></td>
                            <td><?=$row['plan_total']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="5">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">
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
                                            <div class="col-12 col-md-4">
                                                <label for="filter-type"><b>Deduction/Contribution type</b></label>
                                                <select name="filter_type" id="filter-type" class="nsm-field form-control">
                                                    <option value="all" <?=empty($filter_type) || $filter_type === 'all' ? 'selected' : ''?>>All deductions and contributions</option>
                                                    <option value="garnishments" <?=$filter_type === 'garnishments' ? 'selected' : ''?>>Garnishments</option>
                                                    <option value="payroll-correction" <?=$filter_type === 'payroll-correction' ? 'selected' : ''?>>Payroll Correction</option>
                                                </select>
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