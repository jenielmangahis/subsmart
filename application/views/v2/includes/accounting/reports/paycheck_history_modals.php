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