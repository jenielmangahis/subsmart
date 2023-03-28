
<div class="modal fade nsm-modal" id="print_credit_notes_modal" tabindex="-1" aria-labelledby="print_credit_notes_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_credit_notes_modal_label">Print Credit Notes List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Last Delivered">LAST DELIVERED</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments"><i class="bx bx-paperclip"></i></td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="P.O. Number">P.O. Number</td>
                            <td data-name="Sales Rep">SALES REP</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($notes) > 0) : ?>
                            <?php foreach($notes as $note) : ?>
                            <tr>
                                <td><?=$note['date']?></td>
                                <td><?=$note['type']?></td>
                                <td><?=$note['no']?></td>
                                <td><?=$note['customer']?></td>
                                <td><?=$note['memo']?></td>
                                <td><?=$note['total']?></td>
                                <td><?=$note['last_delivered']?></td>
                                <td><?=$note['email']?></td>
                                <td><?=$note['attachments']?></td>
                                <td><?=$note['status']?></td>
                                <td><?=$note['po_number']?></td>
                                <td><?=$note['sales_rep']?></td>
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
                <button type="button" class="nsm-button primary" id="btn_print_credit_notes">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_credit_notes_modal" tabindex="-1" aria-labelledby="print_preview_credit_notes_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_credit_notes_modal_label">Print customers List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="credit_notes_table_print">
                    <thead>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Last Delivered">LAST DELIVERED</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments"><i class="bx bx-paperclip"></i></td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="P.O. Number">P.O. Number</td>
                            <td data-name="Sales Rep">SALES REP</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($notes) > 0) : ?>
                            <?php foreach($notes as $note) : ?>
                            <tr>
                                <td><?=$note['date']?></td>
                                <td><?=$note['type']?></td>
                                <td><?=$note['no']?></td>
                                <td><?=$note['customer']?></td>
                                <td><?=$note['memo']?></td>
                                <td><?=$note['total']?></td>
                                <td><?=$note['last_delivered']?></td>
                                <td><?=$note['email']?></td>
                                <td><?=$note['attachments']?></td>
                                <td><?=$note['status']?></td>
                                <td><?=$note['po_number']?></td>
                                <td><?=$note['sales_rep']?></td>
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