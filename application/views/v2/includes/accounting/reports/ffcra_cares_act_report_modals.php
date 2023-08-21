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
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name=""></td>
                            <td data-name="Total Amount">TOTAL AMOUNT</td>
                            <td data-name="Credit Total">CREDIT TOTAL</td>
                            <?php foreach($employees as $employee) : ?>
                            <td data-name="<?=$employee['name']?>"><?=$employee['name']?></td>
                            <?php endforeach; ?>
                            <td data-name="Credit Amount">CREDIT AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>FFCRA & CARES ACT WAGES, TAXES & CREDITS</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FFCRA Wages</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Sick Lv Wages</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Wages</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FFCRA ER Health Premium</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Health Premium</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Wages and ER Health Premium</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CARES Act Wages</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Reg and OT Emp Retn Credit Wages</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total CARES Act Credits</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA & CARES Act Credits</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
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
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name=""></td>
                            <td data-name="Total Amount">TOTAL AMOUNT</td>
                            <td data-name="Credit Total">CREDIT TOTAL</td>
                            <?php foreach($employees as $employee) : ?>
                            <td data-name="<?=$employee['name']?>"><?=$employee['name']?></td>
                            <?php endforeach; ?>
                            <td data-name="Credit Amount">CREDIT AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>FFCRA & CARES ACT WAGES, TAXES & CREDITS</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FFCRA Wages</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Sick Lv Wages</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Wages</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FFCRA ER Health Premium</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Health Premium</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Wages and ER Health Premium</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CARES Act Wages</b></td>
                            <td></td>
                            <td></td>
                            <?php foreach($employees as $employee) : ?>
                            <td></td>
                            <?php endforeach; ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Reg and OT Emp Retn Credit Wages</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total CARES Act Credits</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA & CARES Act Credits</b></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php foreach($employees as $employee) : ?>
                            <td style="border-bottom: 1px solid black"></td>
                            <?php endforeach; ?>
                            <td style="border-bottom: 1px solid black"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="<?=count($employees) + 4?>" class="text-center">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>