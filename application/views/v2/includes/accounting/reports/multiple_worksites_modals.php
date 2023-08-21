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
                            <td colspan="<?=count($months) + 2?>" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($months) + 2?>" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($months) + 2?>" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Worksite">WORKSITE</td>
                            <?php foreach($months as $month) : ?>
                            <td data-name="No. of Employees (<?=$month?>)">NO. OF EMPLOYEES (<?=$month?>)</td>
                            <?php endforeach; ?>
                            <td data-name="Quarterly Wages">QUARTERLY WAGES</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($worksites) > 0) : ?>
                        <?php foreach($worksites as $worksite) : ?>
                        <tr>
                            <td><?=$worksite['name']?></td>
                            <?php foreach($months as $month) : ?>
                            <td><?=$worksite[strtolower($month)]?></td>
                            <?php endforeach; ?>
                            <td><?=number_format($worksite['quarterly_wages'], 2)?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>Total</b></td>
                            <?php foreach($months as $month) : ?>
                            <td><b><?=$totals[strtolower($month)]?></b></td>
                            <?php endforeach; ?>
                            <td><b><?=number_format($totals['quarterly_wages'], 2)?></b></td>
                        </tr>
                        <?php else : ?>
                        <tr>
                            <td colspan="<?=count($months) + 2?>">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="<?=count($months) + 2?>" class="text-center">
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
                            <td colspan="<?=count($months) + 2?>" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($months) + 2?>" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="<?=count($months) + 2?>" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Worksite">WORKSITE</td>
                            <?php foreach($months as $month) : ?>
                            <td data-name="No. of Employees (<?=$month?>)">NO. OF EMPLOYEES (<?=$month?>)</td>
                            <?php endforeach; ?>
                            <td data-name="Quarterly Wages">QUARTERLY WAGES</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($worksites) > 0) : ?>
                        <?php foreach($worksites as $worksite) : ?>
                        <tr>
                            <td><?=$worksite['name']?></td>
                            <?php foreach($months as $month) : ?>
                            <td><?=$worksite[strtolower($month)]?></td>
                            <?php endforeach; ?>
                            <td><?=number_format($worksite['quarterly_wages'], 2)?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>Total</b></td>
                            <?php foreach($months as $month) : ?>
                            <td><b><?=$totals[strtolower($month)]?></b></td>
                            <?php endforeach; ?>
                            <td><b><?=number_format($totals['quarterly_wages'], 2)?></b></td>
                        </tr>
                        <?php else : ?>
                        <tr>
                            <td colspan="<?=count($months) + 2?>">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="<?=count($months) + 2?>" class="text-center">
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
                                            <div class="col-3 col-md-4">
                                                <label for="filter-location"><b>Work location</b></label>
                                                <select name="filter_location" id="filter-location" class="nsm-field form-control">
                                                    <?php if(isset($filter_location)) : ?>
                                                    <option value="<?=$filter_location->id?>" selected><?=$filter_location->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All locations</option>
                                                    <?php endif; ?>
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