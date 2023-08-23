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
                        <?php if(!isset($show_company_name)) : ?>
                        <tr>
                            <td colspan="34" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="34" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="34" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td data-name=""></td>
                            <?php endif; ?>
                            <td data-name="Template Type" <?=isset($columns) && !in_array('Template Type', $columns) ? 'style="display: none"' : ''?>>TEMPLATE TYPE</td>
                            <td data-name="Transaction Type" <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>>TRANSACTION TYPE</td>
                            <td data-name="Template Name" <?=isset($columns) && !in_array('Template Name', $columns) ? 'style="display: none"' : ''?>>TEMPLATE NAME</td>
                            <td data-name="Previous Date" <?=isset($columns) && !in_array('Previous Date', $columns) ? 'style="display: none"' : ''?>>PREVIOUS DATE</td>
                            <td data-name="Next Date" <?=isset($columns) && !in_array('Next Date', $columns) ? 'style="display: none"' : ''?>>NEXT DATE</td>
                            <td data-name="Name" <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>>NAME</td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Num Entered" <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>>NUM ENTERED</td>
                            <td data-name="End Date" <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>>END DATE</td>
                            <td data-name="Expired" <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>>EXPIRED</td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                            <td data-name="Payment Method" <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>>PAYMENT METHOD</td>
                            <td data-name="CC Expires" <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>>CC EXPIRES</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($templates) > 0) : ?>
                        <?php foreach($templates as $index => $template) : ?>
                        <?php if($group_by === 'none') : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Template Type', $columns) ? 'style="display: none"' : ''?>><?=$template['template_type']?></td>
                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$template['transaction_type']?></td>
                            <td <?=isset($columns) && !in_array('Template Name', $columns) ? 'style="display: none"' : ''?>><?=$template['template_name']?></td>
                            <td <?=isset($columns) && !in_array('Previous Date', $columns) ? 'style="display: none"' : ''?>><?=$template['previous_date']?></td>
                            <td <?=isset($columns) && !in_array('Next Date', $columns) ? 'style="display: none"' : ''?>><?=$template['next_date']?></td>
                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$template['name']?></td>
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$template['memo_desc']?></td>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$template['account']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$template['amount']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$template['create_date']?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$template['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$template['last_modified']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$template['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>><?=$template['num_entered']?></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>><?=$template['end_date']?></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>><?=$template['expired']?></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$template['split']?></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$template['payment_method']?></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>><?=$template['cc_expires']?></td>
                        </tr>
                        <?php else : ?>
                        <tr class="group-header">
                            <td colspan="<?=isset($columns) ? $total_index : '8'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$template['name']?></b></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$template['amount_total']?></b></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>></td>
                        </tr>
                        <?php foreach($template['templates'] as $temp) : ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td></td>
                            <?php endif; ?>
                            <td <?=isset($columns) && !in_array('Template Type', $columns) ? 'style="display: none"' : ''?>><?=$temp['template_type']?></td>
                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$temp['transaction_type']?></td>
                            <td <?=isset($columns) && !in_array('Template Name', $columns) ? 'style="display: none"' : ''?>><?=$temp['template_name']?></td>
                            <td <?=isset($columns) && !in_array('Previous Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['previous_date']?></td>
                            <td <?=isset($columns) && !in_array('Next Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['next_date']?></td>
                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$temp['name']?></td>
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$temp['memo_desc']?></td>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$temp['account']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$temp['amount']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['create_date']?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$temp['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$temp['last_modified']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$temp['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>><?=$temp['num_entered']?></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['end_date']?></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>><?=$temp['expired']?></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$temp['split']?></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$temp['payment_method']?></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>><?=$temp['cc_expires']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="group-total">
                            <td colspan="<?=isset($columns) ? $total_index : '8'?>"><b>Total for <?=$template['name']?></b></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$template['amount_total']?></b></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>></td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="35">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="35" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
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
                        <?php if(!isset($show_company_name)) : ?>
                        <tr>
                            <td colspan="34" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="34" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="34" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td data-name=""></td>
                            <?php endif; ?>
                            <td data-name="Template Type" <?=isset($columns) && !in_array('Template Type', $columns) ? 'style="display: none"' : ''?>>TEMPLATE TYPE</td>
                            <td data-name="Transaction Type" <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>>TRANSACTION TYPE</td>
                            <td data-name="Template Name" <?=isset($columns) && !in_array('Template Name', $columns) ? 'style="display: none"' : ''?>>TEMPLATE NAME</td>
                            <td data-name="Previous Date" <?=isset($columns) && !in_array('Previous Date', $columns) ? 'style="display: none"' : ''?>>PREVIOUS DATE</td>
                            <td data-name="Next Date" <?=isset($columns) && !in_array('Next Date', $columns) ? 'style="display: none"' : ''?>>NEXT DATE</td>
                            <td data-name="Name" <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>>NAME</td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Num Entered" <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>>NUM ENTERED</td>
                            <td data-name="End Date" <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>>END DATE</td>
                            <td data-name="Expired" <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>>EXPIRED</td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                            <td data-name="Payment Method" <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>>PAYMENT METHOD</td>
                            <td data-name="CC Expires" <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>>CC EXPIRES</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($templates) > 0) : ?>
                        <?php foreach($templates as $index => $template) : ?>
                        <?php if($group_by === 'none') : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Template Type', $columns) ? 'style="display: none"' : ''?>><?=$template['template_type']?></td>
                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$template['transaction_type']?></td>
                            <td <?=isset($columns) && !in_array('Template Name', $columns) ? 'style="display: none"' : ''?>><?=$template['template_name']?></td>
                            <td <?=isset($columns) && !in_array('Previous Date', $columns) ? 'style="display: none"' : ''?>><?=$template['previous_date']?></td>
                            <td <?=isset($columns) && !in_array('Next Date', $columns) ? 'style="display: none"' : ''?>><?=$template['next_date']?></td>
                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$template['name']?></td>
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$template['memo_desc']?></td>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$template['account']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$template['amount']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$template['create_date']?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$template['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$template['last_modified']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$template['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>><?=$template['num_entered']?></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>><?=$template['end_date']?></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>><?=$template['expired']?></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$template['split']?></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$template['payment_method']?></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>><?=$template['cc_expires']?></td>
                        </tr>
                        <?php else : ?>
                        <tr class="group-header">
                            <td colspan="<?=isset($columns) ? $total_index : '8'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$template['name']?></b></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$template['amount_total']?></b></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>></td>
                        </tr>
                        <?php foreach($template['templates'] as $temp) : ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td></td>
                            <?php endif; ?>
                            <td <?=isset($columns) && !in_array('Template Type', $columns) ? 'style="display: none"' : ''?>><?=$temp['template_type']?></td>
                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$temp['transaction_type']?></td>
                            <td <?=isset($columns) && !in_array('Template Name', $columns) ? 'style="display: none"' : ''?>><?=$temp['template_name']?></td>
                            <td <?=isset($columns) && !in_array('Previous Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['previous_date']?></td>
                            <td <?=isset($columns) && !in_array('Next Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['next_date']?></td>
                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$temp['name']?></td>
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$temp['memo_desc']?></td>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$temp['account']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$temp['amount']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['create_date']?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$temp['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$temp['last_modified']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$temp['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>><?=$temp['num_entered']?></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>><?=$temp['end_date']?></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>><?=$temp['expired']?></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$temp['split']?></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$temp['payment_method']?></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>><?=$temp['cc_expires']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="group-total">
                            <td colspan="<?=isset($columns) ? $total_index : '8'?>"><b>Total for <?=$template['name']?></b></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$template['amount_total']?></b></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Num Entered', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('End Date', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Expired', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>></td>
                            <td <?=isset($columns) && !in_array('CC Expires', $columns) ? 'style="display: none"' : ''?>></td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="35">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="35" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
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
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-general" aria-expanded="true" aria-controls="collapse-general">
                                        General
                                    </button>
                                </h2>
                                <div id="collapse-general" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-6">
                                                <label for="template-type"><b>Template Type</b></label>
                                                <select name="template_type" id="template-type" class="nsm-field form-control">
                                                    <option value="all" <?=empty($filter_template_type) || $filter_template_type === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="scheduled" <?=$filter_template_type === 'scheduled' ? 'selected' : ''?>>Scheduled</option>
                                                    <option value="reminder" <?=$filter_template_type === 'reminder' ? 'selected' : ''?>>Reminder</option>
                                                    <option value="unscheduled" <?=$filter_template_type === 'unscheduled' ? 'selected' : ''?>>Unscheduled</option>
                                                    <option value="manual" <?=$filter_template_type === 'manual' ? 'selected' : ''?>>Manual</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="template-interval"><b>Template Interval</b></label>
                                                <select name="template_interval" id="template-interval" class="nsm-field form-control">
                                                    <option value="all" <?=empty($filter_template_interval) || $filter_template_interval === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="daily" <?=$filter_template_interval === 'daily' ? 'selected' : ''?>>Daily</option>
                                                    <option value="weekly" <?=$filter_template_interval === 'weekly' ? 'selected' : ''?>>Weekly</option>
                                                    <option value="monthly" <?=$filter_template_interval === 'monthly' ? 'selected' : ''?>>Monthly</option>
                                                    <option value="yearly" <?=$filter_template_interval === 'yearly' ? 'selected' : ''?>>Yearly</option>
                                                    <option value="any-activity" <?=$filter_template_interval === 'any-activity' ? 'selected' : ''?>>Any Activity</option>
                                                    <option value="bi-monthly" <?=$filter_template_interval === 'bi-monthly' ? 'selected' : ''?>>Bi Monthly</option>
                                                    <option value="payroll-rule" <?=$filter_template_interval === 'payroll-rule' ? 'selected' : ''?>>Payroll Rule</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label for="number-format"><b>Number format</b></label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="negative-numbers"><b>Negative numbers</b></label>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($divide_by_100) ? 'checked' : ''?> type="checkbox" name="number_format" value="divide-by-100" id="divide-by-100">
                                                    <label class="form-check-label" for="divide-by-100">
                                                        Divide by 100
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($without_cents) ? 'checked' : ''?> type="checkbox" name="number_format" value="without-cents" id="without-cents">
                                                    <label class="form-check-label" for="without-cents">
                                                        Without cents
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="negative_numbers" id="negative-numbers" class="nsm-field form-control">
                                                    <option value="-100" <?=empty($negative_numbers) || $negative_numbers === '-100' ? 'selected' : ''?>>-100</option>
                                                    <option value="(100)" <?=$negative_numbers === '(100)' ? 'selected' : ''?>>(100)</option>
                                                    <option value="100-" <?=$negative_numbers === '100-' ? 'selected' : ''?>>100-</option>
                                                </select>
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($show_in_red) ? 'checked' : ''?> type="checkbox" name="show_in_red" value="1" id="show-in-red">
                                                    <label class="form-check-label" for="show-in-red">
                                                        Show in red
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
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-rows-columns" aria-expanded="true" aria-controls="collapse-rows-columns">
                                        Rows/Columns
                                    </button>
                                </h2>
                                <div id="collapse-rows-columns" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12">
                                                <label for="custom-group-by">Group by</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <select id="custom-group-by" class="form-control nsm-field">
                                                    <option value="none" <?=$group_by === 'none' ? 'selected' : ''?>>None</option>
                                                    <option value="account" <?=$group_by === 'account' ? 'selected' : ''?>>Account</option>
                                                    <option value="name" <?=$group_by === 'name' ? 'selected' : ''?>>Name</option>
                                                    <option value="transaction-type" <?=$group_by === 'transaction-type' ? 'selected' : ''?>>Transaction Type</option>
                                                    <option value="template-type" <?=empty($group_by) || $group_by === 'template-type' ? 'selected' : ''?>>Template Type</option>
                                                    <option value="payment-method" <?=$group_by === 'payment-method' ? 'selected' : ''?>>Payment Method</option>
                                                </select>
                                            </div>
                                            <div class="col-12 d-none">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="select-columns"><b>Select columns</b></label>
                                                        <a href="#" class="float-end text-decoration-none" id="reset-columns-to-default">Reset to default</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-template-type" <?=isset($columns) && in_array('Template Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-template-type">
                                                                Template Type
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-transaction-type" <?=isset($columns) && in_array('Transaction Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-transaction-type">
                                                                Transaction Type
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-template-name" <?=isset($columns) && in_array('Template Name', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-template-name">
                                                                Template Name
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-previous-date" <?=isset($columns) && in_array('Previous Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-previous-date">
                                                                Previous Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-next-date" <?=isset($columns) && in_array('Next Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-next-date">
                                                                Next Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-name" <?=isset($columns) && in_array('Name', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-name">
                                                                Name
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-memo-description" <?=isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-memo-description">
                                                                Memo/Description
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-account" <?=isset($columns) && in_array('Account', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-account">
                                                                Account
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-amount" <?=isset($columns) && in_array('Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-amount">
                                                                Amount
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-create-date" <?=isset($columns) && in_array('Create Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-create-date">
                                                                Create Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-created-by" <?=isset($columns) && in_array('Created By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-created-by">
                                                                Created By
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-last-modified" <?=isset($columns) && in_array('Last Modified', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-last-modified">
                                                                Last Modified
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-last-modified-by" <?=isset($columns) && in_array('Last Modified By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-last-modified-by">
                                                                Last Modified By
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-num-entered" <?=isset($columns) && in_array('Num Entered', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-num-entered">
                                                                Num Entered
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-end-date" <?=isset($columns) && in_array('End Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-end-date">
                                                                End Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-expired" <?=isset($columns) && in_array('Expired', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-expired">
                                                                Expired
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-split" <?=isset($columns) && in_array('Split', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-split">
                                                                Split
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-payment-method" <?=isset($columns) && in_array('Payment Method', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-payment-method">
                                                                Payment Method
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-cc-expires" <?=isset($columns) && in_array('CC Expires', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-cc-expires">
                                                                CC Expires
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a href="#" class="text-decoration-none" id="change-columns">Change columns</a>
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
                                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-filter" aria-expanded="false" aria-controls="collapse-filter">
                                        Filter
                                    </button>
                                </h2>
                                <div id="collapse-filter" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row grid-mb g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_transaction_type) ? 'checked' : '' ?> name="allow_filter_transaction_type" value="1" id="allow-filter-transaction-type">
                                                    <label class="form-check-label" for="allow-filter-transaction-type">
                                                        Transaction Type
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_transaction_type" id="filter-transaction-type" class="nsm-field form-control">
                                                    <option value="all" <?=!isset($filter_transaction_type) || $filter_transaction_type === 'all' ? 'selected' : '' ?>>All</option>
                                                    <option value="posting" <?=$filter_transaction_type === 'posting' ? 'selected' : '' ?>>Posting</option>
                                                    <option value="non-posting" <?=$filter_transaction_type === 'non-posting' ? 'selected' : '' ?>>Non-Posting</option>
                                                    <option value="credit-card-expense" <?=$filter_transaction_type === 'credit-card-expense' ? 'selected' : '' ?>?>Credit Card Expense</option>
                                                    <option value="check" <?=$filter_transaction_type === 'check' ? 'selected' : '' ?>>Check</option>
                                                    <option value="invoice" <?=$filter_transaction_type === 'invoice' ? 'selected' : '' ?>>Invoice</option>
                                                    <option value="payment" <?=$filter_transaction_type === 'payment' ? 'selected' : '' ?>>Payment</option>
                                                    <option value="journal-entry" <?=$filter_transaction_type === 'journal-entry' ? 'selected' : '' ?>>Journal Entry</option>
                                                    <option value="bill" <?=$filter_transaction_type === 'bill' ? 'selected' : '' ?>>Bill</option>
                                                    <option value="credit-card-credit" <?=$filter_transaction_type === 'credit-card-credit' ? 'selected' : '' ?>>Credit Card Credit</option>
                                                    <option value="vendor-credit" <?=$filter_transaction_type === 'vendor-credit' ? 'selected' : '' ?>>Vendor Credit</option>
                                                    <option value="credit" <?=$filter_transaction_type === 'credit' ? 'selected' : '' ?>>Credit</option>
                                                    <option value="bill-payment-check" <?=$filter_transaction_type === 'bill-payment-check' ? 'selected' : '' ?>>Bill Payment (Check)</option>
                                                    <option value="bill-payment-credit-card" <?=$filter_transaction_type === 'bill-payment-credit-card' ? 'selected' : '' ?>>Bill Payment (Credit Card)</option>
                                                    <option value="paycheck" <?=$filter_transaction_type === 'paycheck' ? 'selected' : '' ?>>Paycheck</option>
                                                    <option value="charge" <?=$filter_transaction_type === 'charge' ? 'selected' : '' ?>>Charge</option>
                                                    <option value="transfer" <?=$filter_transaction_type === 'transfer' ? 'selected' : '' ?>>Transfer</option>
                                                    <option value="deposit" <?=$filter_transaction_type === 'deposit' ? 'selected' : '' ?>>Deposit</option>
                                                    <option value="statement" <?=$filter_transaction_type === 'statement' ? 'selected' : '' ?>>Statement</option>
                                                    <option value="billable-expense-charge" <?=$filter_transaction_type === 'billable-expense-charge' ? 'selected' : '' ?>>Billable Expense Charge</option>
                                                    <option value="time-charge" <?=$filter_transaction_type === 'time-charge' ? 'selected' : '' ?>>Time Charge</option>
                                                    <option value="cash-expense" <?=$filter_transaction_type === 'cash-expense' ? 'selected' : '' ?>>Cash Expense</option>
                                                    <option value="sales-receipt" <?=$filter_transaction_type === 'sales-receipt' ? 'selected' : '' ?>>Sales Receipt</option>
                                                    <option value="credit-memo" <?=$filter_transaction_type === 'credit-memo' ? 'selected' : '' ?>>Credit Memo</option>
                                                    <option value="refund" <?=$filter_transaction_type === 'refund' ? 'selected' : '' ?>>Refund</option>
                                                    <option value="estimate" <?=$filter_transaction_type === 'estimate' ? 'selected' : '' ?>>Estimate</option>
                                                    <option value="obsolete-payroll-adjustment" <?=$filter_transaction_type === 'obsolete-payroll-adjustment' ? 'selected' : '' ?>>Obsolete Payroll Adjustment</option>
                                                    <option value="liability-payment-check" <?=$filter_transaction_type === 'liability-payment-check' ? 'selected' : '' ?>>Liability Payment (Check)</option>
                                                    <option value="liability-payment-credit-card" <?=$filter_transaction_type === 'liability-payment-credit-card' ? 'selected' : '' ?>>Liability Payment (Credit Card)</option>
                                                    <option value="payroll-ytd" <?=$filter_transaction_type === 'payroll-ytd' ? 'selected' : '' ?>>Payroll YTD</option>
                                                    <option value="liability-refund" <?=$filter_transaction_type === 'liability-refund' ? 'selected' : '' ?>>Liability Refund</option>
                                                    <option value="prior-liability-payments" <?=$filter_transaction_type === 'prior-liability-payments' ? 'selected' : '' ?>>Prior Liability Payments</option>
                                                    <option value="direct-deposit-withdrawal" <?=$filter_transaction_type === 'direct-deposit-withdrawal' ? 'selected' : '' ?>>Direct Deposit Withdrawal</option>
                                                    <option value="liability-payment-epay" <?=$filter_transaction_type === 'liability-payment-epay' ? 'selected' : '' ?>>Liability Payment (E-pay)</option>
                                                    <option value="liability-payment-marked-paid" <?=$filter_transaction_type === 'liability-payment-marked-paid' ? 'selected' : '' ?>>Liability Payment (Marked Paid)</option>
                                                    <option value="inventory-qty-adjust" <?=$filter_transaction_type === 'inventory-qty-adjust' ? 'selected' : '' ?>>Inventory Qty Adjust</option>
                                                    <option value="purchase-order" <?=$filter_transaction_type === 'purchase-order' ? 'selected' : '' ?>>Purchase Order</option>
                                                    <option value="payroll-check" <?=$filter_transaction_type === 'payroll-check' ? 'selected' : '' ?>>Payroll Check</option>
                                                    <option value="tax-payment" <?=$filter_transaction_type === 'tax-payment' ? 'selected' : '' ?>>Tax Payment</option>
                                                    <option value="payroll-adjustment" <?=$filter_transaction_type === 'payroll-adjustment' ? 'selected' : '' ?>>Payroll Adjustment</option>
                                                    <option value="payroll-refund" <?=$filter_transaction_type === 'payroll-refund' ? 'selected' : '' ?>>Payroll Refund</option>
                                                    <option value="sales-tax-payment" <?=$filter_transaction_type === 'sales-tax-payment' ? 'selected' : '' ?>>Sales Tax Payment</option>
                                                    <option value="sales-tax-adjustment" <?=$filter_transaction_type === 'sales-tax-adjustment' ? 'selected' : '' ?>>Sales Tax Adjustment</option>
                                                    <option value="job" <?=$filter_transaction_type === 'job' ? 'selected' : '' ?>>Job</option>
                                                    <option value="expense" <?=$filter_transaction_type === 'expense' ? 'selected' : '' ?>>Expense</option>
                                                    <option value="service-tax-partial-utilisation" <?=$filter_transaction_type === 'service-tax-partial-utilisation' ? 'selected' : '' ?>>Service Tax Partial Utilisation</option>
                                                    <option value="service-tax-defer" <?=$filter_transaction_type === 'service-tax-defer' ? 'selected' : '' ?>>Service Tax Defer</option>
                                                    <option value="service-tax-reversal" <?=$filter_transaction_type === 'service-tax-reversal' ? 'selected' : '' ?>>Service Tax Reversal</option>
                                                    <option value="service-tax-refund" <?=$filter_transaction_type === 'service-tax-refund' ? 'selected' : '' ?>>Service Tax Refund</option>
                                                    <option value="service-tax-gross-adjustment" <?=$filter_transaction_type === 'service-tax-gross-adjustment' ? 'selected' : '' ?>>Service Tax Gross Adjustment</option>
                                                    <option value="reverse-charge" <?=$filter_transaction_type === 'reverse-charge' ? 'selected' : '' ?>>Reverse Charge</option>
                                                    <option value="inventory-starting-value-from-desktop" <?=$filter_transaction_type === 'inventory-starting-value-from-desktop' ? 'selected' : '' ?>>Inventory Starting Value from Desktop</option>
                                                    <option value="inventory-starting-value" <?=$filter_transaction_type === 'inventory-starting-value' ? 'selected' : '' ?>>Inventory Starting Value</option>
                                                    <option value="credit-card-payment" <?=$filter_transaction_type === 'credit-card-payment' ? 'selected' : '' ?>>Credit Card Payment</option>
                                                    <option value="revenue-recognition" <?=$filter_transaction_type === 'revenue-recognition' ? 'selected' : '' ?>>Revenue Recognition</option>
                                                    <option value="employee-non-reimbursable-expense" <?=$filter_transaction_type === 'employee-non-reimbursable-expense' ? 'selected' : '' ?>>Employee Non-Reimbursable Expense</option>
                                                    <option value="employee-reimbursement" <?=$filter_transaction_type === 'employee-reimbursement' ? 'selected' : '' ?>>Employee Reimbursement</option>
                                                    <option value="employee-reimbursable-expense" <?=$filter_transaction_type === 'employee-reimbursable-expense' ? 'selected' : '' ?>>Employee Reimbursable Expense</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_distribution_account) ? 'checked' : '' ?> name="allow_filter_distribution_account" value="1" id="allow-filter-distribution-account">
                                                    <label class="form-check-label" for="allow-filter-distribution-account">
                                                        Distribution Account
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_distribution_account" id="filter-distribution-account" class="nsm-field form-control">
                                                    <?php if(isset($filter_distribution_account)) : ?>
                                                    <option value="<?=$filter_distribution_account->id?>" selected><?=$filter_distribution_account->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_account) ? 'checked' : '' ?> name="allow_filter_account" value="1" id="allow-filter-account">
                                                    <label class="form-check-label" for="allow-filter-account">
                                                        Account
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_account" id="filter-account" class="nsm-field form-control">
                                                    <?php if(isset($filter_account)) : ?>
                                                    <option value="<?=$filter_account->id?>" selected><?=$filter_account->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_name) ? 'checked' : '' ?> name="allow_filter_name" value="1" id="allow-filter-name">
                                                    <label class="form-check-label" for="allow-filter-name">
                                                        Name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_name" id="filter-name" class="nsm-field form-control">
                                                    <?php if(isset($filter_name)) : ?>
                                                    <option value="<?=$filter_name->id?>" selected><?=$filter_name->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_payment_method) ? 'checked' : '' ?> name="allow_filter_payment_method" value="1" id="allow-filter-payment-method">
                                                    <label class="form-check-label" for="allow-filter-payment-method">
                                                        Payment Method
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_payment_method" id="filter-payment-method" class="nsm-field form-control">
                                                    <?php if(isset($filter_payment_method)) : ?>
                                                    <option value="<?=$filter_payment_method->id?>" selected><?=$filter_payment_method->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($create_date) ? 'checked' : '' ?> type="checkbox" name="allow_filter_create_date" value="1" id="allow-filter-create-date">
                                                    <label class="form-check-label" for="allow-filter-create-date">
                                                        Create Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_create_date" id="filter-create-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=empty($create_date) || $create_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$create_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$create_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$create_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$create_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$create_date === 'custom' ? 'this-month' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=$create_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                                    <option value="this-quarter" <?=$create_date === 'custom' ? 'this-quarter' : ''?>>This Quarter</option>
                                                    <option value="this-quarter-to-date" <?=$create_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                                    <option value="this-year" <?=$create_date === 'custom' ? 'this-year' : ''?>>This Year</option>
                                                    <option value="this-year-to-date" <?=$create_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                                    <option value="this-year-to-last-month" <?=$create_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                                    <option value="yesterday" <?=$create_date === 'custom' ? 'yesterday' : ''?>>Yesterday</option>
                                                    <option value="recent" <?=$create_date === 'custom' ? 'recent' : ''?>>Recent</option>
                                                    <option value="last-week" <?=$create_date === 'custom' ? 'last-week' : ''?>>Last Week</option>
                                                    <option value="last-week-to-date" <?=$create_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                                    <option value="last-month" <?=$create_date === 'custom' ? 'last-month' : ''?>>Last Month</option>
                                                    <option value="last-month-to-date" <?=$create_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                                    <option value="last-quarter" <?=$create_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                                    <option value="last-quarter-to-date" <?=$create_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                                    <option value="last-year" <?=$create_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                                    <option value="last-year-to-date" <?=$create_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                                    <option value="since-30-days-ago" <?=$create_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$create_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$create_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$create_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <?php if(!empty($create_date) && $create_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-create-date-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$create_date_from?>" id="filter-create-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-create-date-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$create_date_to?>" id="filter-create-date-to">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($last_modified_date) ? 'checked' : '' ?> type="checkbox" name="allow_filter_last_modified_date" value="1" id="allow-filter-last-modified-date">
                                                    <label class="form-check-label" for="allow-filter-last-modified-date">
                                                        Last Modified Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_last_modified_date" id="filter-last-modified-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=empty($last_modified_date) || $last_modified_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$last_modified_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$last_modified_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$last_modified_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$last_modified_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$last_modified_date === 'custom' ? 'this-month' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=$last_modified_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                                    <option value="this-quarter" <?=$last_modified_date === 'custom' ? 'this-quarter' : ''?>>This Quarter</option>
                                                    <option value="this-quarter-to-date" <?=$last_modified_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                                    <option value="this-year" <?=$last_modified_date === 'custom' ? 'this-year' : ''?>>This Year</option>
                                                    <option value="this-year-to-date" <?=$last_modified_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                                    <option value="this-year-to-last-month" <?=$last_modified_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                                    <option value="yesterday" <?=$last_modified_date === 'custom' ? 'yesterday' : ''?>>Yesterday</option>
                                                    <option value="recent" <?=$last_modified_date === 'custom' ? 'recent' : ''?>>Recent</option>
                                                    <option value="last-week" <?=$last_modified_date === 'custom' ? 'last-week' : ''?>>Last Week</option>
                                                    <option value="last-week-to-date" <?=$last_modified_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                                    <option value="last-month" <?=$last_modified_date === 'custom' ? 'last-month' : ''?>>Last Month</option>
                                                    <option value="last-month-to-date" <?=$last_modified_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                                    <option value="last-quarter" <?=$last_modified_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                                    <option value="last-quarter-to-date" <?=$last_modified_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                                    <option value="last-year" <?=$last_modified_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                                    <option value="last-year-to-date" <?=$last_modified_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                                    <option value="since-30-days-ago" <?=$last_modified_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$last_modified_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$last_modified_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$last_modified_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <?php if(!empty($last_modified_date) && $last_modified_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-6">
                                                <label for="last-modified-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=empty($last_modified_date) || $last_modified_date === 'since-30-days-ago' ? date("m/d/Y", strtotime("-30 days")) : $last_modified_date_from?>" id="filter-last-modified-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="last-modified-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$last_modified_date === 'all-dates' ? '' : $last_modified_date_to?>" id="filter-last-modified-date-to">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($end_date) ? 'checked' : '' ?> type="checkbox" name="allow_filter_end_date" value="1" id="allow-filter-end-date">
                                                    <label class="form-check-label" for="allow-filter-end-date">
                                                        End Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_end_date" id="filter-end-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=empty($end_date) || $end_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$end_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$end_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$end_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$end_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$end_date === 'custom' ? 'this-month' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=$end_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                                    <option value="this-quarter" <?=$end_date === 'custom' ? 'this-quarter' : ''?>>This Quarter</option>
                                                    <option value="this-quarter-to-date" <?=$end_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                                    <option value="this-year" <?=$end_date === 'custom' ? 'this-year' : ''?>>This Year</option>
                                                    <option value="this-year-to-date" <?=$end_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                                    <option value="this-year-to-last-month" <?=$end_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                                    <option value="yesterday" <?=$end_date === 'custom' ? 'yesterday' : ''?>>Yesterday</option>
                                                    <option value="recent" <?=$end_date === 'custom' ? 'recent' : ''?>>Recent</option>
                                                    <option value="last-week" <?=$end_date === 'custom' ? 'last-week' : ''?>>Last Week</option>
                                                    <option value="last-week-to-date" <?=$end_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                                    <option value="last-month" <?=$end_date === 'custom' ? 'last-month' : ''?>>Last Month</option>
                                                    <option value="last-month-to-date" <?=$end_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                                    <option value="last-quarter" <?=$end_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                                    <option value="last-quarter-to-date" <?=$end_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                                    <option value="last-year" <?=$end_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                                    <option value="last-year-to-date" <?=$end_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                                    <option value="since-30-days-ago" <?=$end_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$end_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$end_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$end_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <?php if(!empty($end_date) && $end_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-end-date-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$end_date_from?>" id="filter-end-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-end-date-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$end_date_to?>" id="filter-end-date-to">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_memo) ? 'checked' : '' ?> type="checkbox" name="allow_filter_memo" value="1" id="allow-filter-memo">
                                                    <label class="form-check-label" for="allow-filter-memo">
                                                        Memo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_memo) ? $filter_memo : ''?>" name="filter_memo" id="filter-memo">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_amount) ? 'checked' : '' ?> type="checkbox" name="allow_filter_amount" value="1" id="allow-filter-amount">
                                                    <label class="form-check-label" for="allow-filter-amount">
                                                        Amount
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_amount) ? $filter_amount : ''?>" name="filter_amount" id="filter-amount">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_template_name) ? 'checked' : '' ?> type="checkbox" name="allow_filter_template_name" value="1" id="allow-filter-template-name">
                                                    <label class="form-check-label" for="allow-filter-template-name">
                                                        Template Name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_template_name) ? $filter_template_name : ''?>" name="filter_template_name" id="filter-template-name">
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
                                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-header-footer" aria-expanded="true" aria-controls="collapse-header-footer">
                                        Header/Footer
                                    </button>
                                </h2>
                                <div id="collapse-header-footer" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="Header"><b>Header</b></label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($show_logo) ? 'checked' : '' ?> type="checkbox" name="show_logo" value="1" id="show-logo">
                                                    <label class="form-check-label" for="show-logo">
                                                        Show logo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6"></div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_company_name) ? 'checked' : ''?> type="checkbox" name="show_company_name" value="1" id="show-company-name">
                                                    <label class="form-check-label" for="show-company-name">
                                                        Company name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="company_name" id="company-name" class="nsm-field form-control" value="<?=$company_name?>">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_report_title) ? 'checked' : ''?> type="checkbox" name="show_report_title" value="1" id="show-report-title">
                                                    <label class="form-check-label" for="show-report-title">
                                                        Report title
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="report_title" id="report-title" class="nsm-field form-control" value="<?=$report_title?>">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_report_period) ? 'checked' : ''?> type="checkbox" name="show_report_period" value="1" id="show-report-period">
                                                    <label class="form-check-label" for="show-report-period">
                                                        Report period
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6"></div>
                                            <div class="col-12">
                                                <label for="footer"><b>Footer</b></label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_date_prepared) ? 'checked' : ''?> type="checkbox" name="show_date_prepared" value="1" id="show-date-prepared">
                                                    <label class="form-check-label" for="show-date-prepared">
                                                        Date prepared
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_time_prepared) ? 'checked' : ''?> type="checkbox" name="show_time_prepared" value="1" id="show-time-prepared">
                                                    <label class="form-check-label" for="show-time-prepared">
                                                        Time prepared
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="alignment"><b>Alignment</b></label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label for="header-alignment">Header</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <select name="header_alignment" id="header-alignment" class="nsm-field form-control">
                                                    <option value="left" <?=$header_alignment === 'start' ? 'selected' : ''?>>Left</option>
                                                    <option value="center" <?=empty($header_alignment) || $header_alignment === 'center' ? 'selected' : ''?>>Center</option>
                                                    <option value="right" <?=$header_alignment === 'end' ? 'selected' : ''?>>Right</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-3">
                                                <label for="footer-alignment">Footer</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <select name="footer_alignment" id="footer-alignment" class="nsm-field form-control">
                                                    <option value="left" <?=$footer_alignment === 'start' ? 'selected' : ''?>>Left</option>
                                                    <option value="center" <?=empty($footer_alignment) || $footer_alignment === 'center' ? 'selected' : ''?>>Center</option>
                                                    <option value="right" <?=$footer_alignment === 'end' ? 'selected' : ''?>>Right</option>
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

<div class="modal fade nsm-modal" id="email_report_modal" tabindex="-1" aria-labelledby="email_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="email_report_modal_label">Email Time Activities by Employee Detail List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="send-email-form">
                <div class="row">
                    <div class="col-12">
                        <label for="email-to">To</label>
                        <input type="email" class="nsm-field form-control" value="" id="email-to" name="email_to" required>
                    </div>
                    <div class="col-12">
                        <label for="email-cc">CC</label>
                        <input type="email" class="nsm-field form-control" value="" id="email-cc" name="email_cc">
                    </div>
                    <div class="col-12">
                        <label for="email-subject">Subject</label>
                        <input type="text" class="nsm-field form-control" value="Your <?=$report_title?> Report" id="email-subject" name="email_subject" required>
                    </div>
                    <div class="col-12">
                        <label for="email-body">Body</label>
                        <textarea name="email_body" id="email-body" maxlength="4000" class="nsm-field form-control mb-3" required>Hello

Attached is the <?=$report_title?> report for <?=$company_name?>. 

Regards
<?=$this->page_data['users']->FName.' '.$this->page_data['users']->LName?></textarea>
                    </div>
                    <div class="col-12">
                        <label for="email-file-name">Report file name</label>
                        <input type="text" class="nsm-field form-control" value="<?=$report_title?> Report" id="email-file-name" name="email_file_name" required>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_send_report">Send</button>
            </div>
        </div>
    </div>
</div>