<div class="modal fade nsm-modal" id="print_attachments_modal" tabindex="-1" aria-labelledby="print_attachments_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_attachments_modal_label">Print Vendor Transactions List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Thumbnail">THUMBNAIL</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Size">SIZE</td>
                            <td data-name="Uploaded">UPLOADED</td>
                            <td data-name="Links">LINKS</td>
                            <td data-name="Note">NOTE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($attachments) > 0) : ?>
                        <?php foreach($attachments as $attachment) : ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon img" style="background-image: <?=base_url("uploads/accounting/attachments/".$attachment['stored_name'].".jpg")?>"></div>
                                </td>
                                <td><?=$attachment['type']?></td>
                                <td class="fw-bold nsm-text-primary nsm-link default"><?=$attachment['name']?></td>
                                <td><?=$attachment['size']?></td>
                                <td><?=date('m/d/Y', strtotime($attachment['created_at']))?></td>
                                <td></td>
                                <td><?=$attachment['notes']?></td>
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
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_attachments">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_attachments_modal" tabindex="-1" aria-labelledby="print_preview_attachments_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_attachments_modal_label">Print vendors List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="attachments_table_print">
                    <thead>
                        <tr>
                            <td data-name="Thumbnail">THUMBNAIL</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Size">SIZE</td>
                            <td data-name="Uploaded">UPLOADED</td>
                            <td data-name="Links">LINKS</td>
                            <td data-name="Note">NOTE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($attachments) > 0) : ?>
                        <?php foreach($attachments as $attachment) : ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon img" style="background-image: <?=base_url("uploads/accounting/attachments/".$attachment['stored_name'].".jpg")?>"></div>
                                </td>
                                <td><?=$attachment['type']?></td>
                                <td class="fw-bold nsm-text-primary nsm-link default"><?=$attachment['name']?></td>
                                <td><?=$attachment['size']?></td>
                                <td><?=date('m/d/Y', strtotime($attachment['created_at']))?></td>
                                <td></td>
                                <td><?=$attachment['notes']?></td>
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
                </table>
            </div>
        </div>
    </div>
</div>