<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Recent/Edited Time Activities List</span>
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
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Contractor">CONTRACTOR</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Pay Method">PAY METHOD</td>
                            <td data-name="Pay Status">PAY STATUS</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
                        <?php foreach($transactions as $index => $transaction) : ?>
                        <tr>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['contractor']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['pay_method']?></td>
                            <td><?=$transaction['pay_status']?></td>
                            <td><?=$transaction['category']?></td>
                            <td><?=$transaction['amount']?></td>
                        </tr>
                        <?php endforeach; ?>
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
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Recent/Edited Time Activities List</span>
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
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Contractor">CONTRACTOR</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Pay Method">PAY METHOD</td>
                            <td data-name="Pay Status">PAY STATUS</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(count($transactions) > 0) : ?>
                        <?php foreach($transactions as $index => $transaction) : ?>
                        <tr>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['contractor']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['pay_method']?></td>
                            <td><?=$transaction['pay_status']?></td>
                            <td><?=$transaction['category']?></td>
                            <td><?=$transaction['amount']?></td>
                        </tr>
                        <?php endforeach; ?>
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