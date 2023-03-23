
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
                            <td data-name="Activity Date">ACTIVITY DATE</td>
                            <td data-name="Create Date">CREATE DATE</td>
                            <td data-name="Created By">CREATED BY</td>
                            <td data-name="Last Modified">LAST MODIFIED</td>
                            <td data-name="Last Modified By">LAST MODIFIED BY</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="Product/Service">PRODUCT/SERVICE</td>
                            <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                            <td data-name="Rates">RATES</td>
                            <td data-name="Duration">DURATION</td>
                            <td data-name="Start Time">START TIME</td>
                            <td data-name="End Time">END TIME</td>
                            <td data-name="Break">BREAK</td>
                            <td data-name="Taxable">TAXABLE</td>
                            <td data-name="Billable">BILLABLE</td>
                            <td data-name="Invoice Date">INVOICE DATE</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($activities) > 0) : ?>
                        <?php foreach($activities as $activity) : ?>
                        <tr>
                            <td><?=$activity['activity_date']?></td>
                            <td><?=$activity['create_date']?></td>
                            <td><?=$activity['created_by']?></td>
                            <td><?=$activity['last_modified']?></td>
                            <td><?=$activity['last_modified_by']?></td>
                            <td><?=$activity['customer']?></td>
                            <td><?=$activity['employee']?></td>
                            <td><?=$activity['product_service']?></td>
                            <td><?=$activity['memo_desc']?></td>
                            <td><?=$activity['rates']?></td>
                            <td><?=$activity['duration']?></td>
                            <td><?=$activity['start_time']?></td>
                            <td><?=$activity['end_time']?></td>
                            <td><?=$activity['break']?></td>
                            <td><?=$activity['taxable']?></td>
                            <td><?=$activity['billable']?></td>
                            <td><?=$activity['invoice_date']?></td>
                            <td><?=$activity['amount']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="19">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
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
                            <td colspan="19" class="text-center">
                                <h4><?=$clients->business_name?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="19" class="text-center">
                                Recent/Edited Time Activities
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Activity Date">ACTIVITY DATE</td>
                            <td data-name="Create Date">CREATE DATE</td>
                            <td data-name="Created By">CREATED BY</td>
                            <td data-name="Last Modified">LAST MODIFIED</td>
                            <td data-name="Last Modified By">LAST MODIFIED BY</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="Product/Service">PRODUCT/SERVICE</td>
                            <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                            <td data-name="Rates">RATES</td>
                            <td data-name="Duration">DURATION</td>
                            <td data-name="Start Time">START TIME</td>
                            <td data-name="End Time">END TIME</td>
                            <td data-name="Break">BREAK</td>
                            <td data-name="Taxable">TAXABLE</td>
                            <td data-name="Billable">BILLABLE</td>
                            <td data-name="Invoice Date">INVOICE DATE</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($activities) > 0) : ?>
                        <?php foreach($activities as $activity) : ?>
                        <tr>
                            <td><?=$activity['activity_date']?></td>
                            <td><?=$activity['create_date']?></td>
                            <td><?=$activity['created_by']?></td>
                            <td><?=$activity['last_modified']?></td>
                            <td><?=$activity['last_modified_by']?></td>
                            <td><?=$activity['customer']?></td>
                            <td><?=$activity['employee']?></td>
                            <td><?=$activity['product_service']?></td>
                            <td><?=$activity['memo_desc']?></td>
                            <td><?=$activity['rates']?></td>
                            <td><?=$activity['duration']?></td>
                            <td><?=$activity['start_time']?></td>
                            <td><?=$activity['end_time']?></td>
                            <td><?=$activity['break']?></td>
                            <td><?=$activity['taxable']?></td>
                            <td><?=$activity['billable']?></td>
                            <td><?=$activity['invoice_date']?></td>
                            <td><?=$activity['amount']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="19">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>