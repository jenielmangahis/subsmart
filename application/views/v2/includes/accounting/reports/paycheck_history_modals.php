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
                            <td colspan="8" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Total Pay" <?=isset($columns) && !in_array('Total Pay', $columns) ? 'style="display: none"' : ''?>>TOTAL PAY</td>
                            <td data-name="Net Pay">NET PAY</td>
                            <td data-name="Pay Method" <?=isset($columns) && !in_array('Pay Method', $columns) ? 'style="display: none"' : ''?>>PAY METHOD</td>
                            <td data-name="Check Number" <?=isset($columns) && !in_array('Check Number', $columns) ? 'style="display: none"' : ''?>>CHECK NUMBER</td>
                            <td data-name="Status" <?=isset($columns) && !in_array('Status', $columns) ? 'style="display: none"' : ''?>>STATUS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($employees) > 0) : ?>
                        <?php foreach($employees as $index => $employee) : ?>
                        <tr>
                            <td><?=$employee['pay_date']?></td>
                            <td><?=$employee['name']?></td>
                            <td <?=isset($columns) && !in_array('Total Pay', $columns) ? 'style="display: none"' : ''?>><?=$employee['total_pay']?></td>
                            <td><?=$employee['net_pay']?></td>
                            <td <?=isset($columns) && !in_array('Pay Method', $columns) ? 'style="display: none"' : ''?>><?=$employee['pay_method']?></td>
                            <td <?=isset($columns) && !in_array('Check Number', $columns) ? 'style="display: none"' : ''?>><?=$employee['check_number']?></td>
                            <td <?=isset($columns) && !in_array('Status', $columns) ? 'style="display: none"' : ''?>><?=$employee['status']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="8">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8" class="text-center">
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
                            <td colspan="8" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Total Pay" <?=isset($columns) && !in_array('Total Pay', $columns) ? 'style="display: none"' : ''?>>TOTAL PAY</td>
                            <td data-name="Net Pay">NET PAY</td>
                            <td data-name="Pay Method" <?=isset($columns) && !in_array('Pay Method', $columns) ? 'style="display: none"' : ''?>>PAY METHOD</td>
                            <td data-name="Check Number" <?=isset($columns) && !in_array('Check Number', $columns) ? 'style="display: none"' : ''?>>CHECK NUMBER</td>
                            <td data-name="Status" <?=isset($columns) && !in_array('Status', $columns) ? 'style="display: none"' : ''?>>STATUS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($employees) > 0) : ?>
                        <?php foreach($employees as $index => $employee) : ?>
                        <tr>
                            <td><?=$employee['pay_date']?></td>
                            <td><?=$employee['name']?></td>
                            <td <?=isset($columns) && !in_array('Total Pay', $columns) ? 'style="display: none"' : ''?>><?=$employee['total_pay']?></td>
                            <td><?=$employee['net_pay']?></td>
                            <td <?=isset($columns) && !in_array('Pay Method', $columns) ? 'style="display: none"' : ''?>><?=$employee['pay_method']?></td>
                            <td <?=isset($columns) && !in_array('Check Number', $columns) ? 'style="display: none"' : ''?>><?=$employee['check_number']?></td>
                            <td <?=isset($columns) && !in_array('Status', $columns) ? 'style="display: none"' : ''?>><?=$employee['status']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="8">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8" class="text-center">
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
                                                        <a href="#" class="text-decoration-none" id="<?=!isset($columns) ? 'unselect-all-columns' : 'select-all-columns'?>"><?=!isset($columns) ? 'Unselect' : 'Select'?> all</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-total-pay" <?=isset($columns) && in_array('Total Pay', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-total-pay">
                                                                Total Pay
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
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-check-number" <?=isset($columns) && in_array('Check Number', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-check-number">
                                                                Check Number
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-status" <?=isset($columns) && in_array('Status', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-status">
                                                                Status
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-tax-adjustment-checks" <?=isset($columns) && in_array('Tax Adjustment Checks', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-tax-adjustment-checks">
                                                                Tax Adjustment Checks
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