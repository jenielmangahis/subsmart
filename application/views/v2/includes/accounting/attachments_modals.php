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
                                    <?php if($attachment['type'] === 'Image') : ?>
                                    <div class="table-row-icon img" style="background-image: url('<?=base_url("uploads/accounting/attachments/".$attachment['thumbnail']."")?>')"></div>
                                    <?php else : ?>
                                    No preview available
                                    <?php endif; ?>
                                </td>
                                <td><?=$attachment['type']?></td>
                                <td class="fw-bold nsm-text-primary nsm-link default"><?=$attachment['name']?></td>
                                <td><?=$attachment['size']?></td>
                                <td><?=$attachment['upload_date']?></td>
                                <td>
                                    <?php if(count($attachment['links']) > 0) : ?>
                                    <?php foreach($attachment['links'] as $link) : ?>
                                    <?=$link['text']?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
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
                                    <?php if($attachment['type'] === 'Image') : ?>
                                    <div class="table-row-icon img" style="background-image: url('<?=base_url("uploads/accounting/attachments/".$attachment['thumbnail']."")?>')"></div>
                                    <?php else : ?>
                                    No preview available
                                    <?php endif; ?>
                                </td>
                                <td><?=$attachment['type']?></td>
                                <td class="fw-bold nsm-text-primary nsm-link default"><?=$attachment['name']?></td>
                                <td><?=$attachment['size']?></td>
                                <td><?=$attachment['upload_date']?></td>
                                <td>
                                    <?php if(count($attachment['links']) > 0) : ?>
                                    <?php foreach($attachment['links'] as $link) : ?>
                                    <?=$link['text']?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
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

<div class="modal fade nsm-modal" id="edit-attachment-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Edit Attachment</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="edit-attachment-form" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-2">
                            <label for="file_name">File name</label>
                            <input type="text" name="file_name" id="file_name" class="form-control nsm-field">
                        </div>
                        <div class="mb-2">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control nsm-field"></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="file-preview">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-12 col-md-6">
                        <button type="button" class="nsm-button" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="nsm-button primary float-end">Save</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="upload-attachments-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add Attachments</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="attachments-container">
                            <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                            <span>Maximum size: 20MB</span>
                            <div id="attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                <div class="dz-message" style="margin: 20px;border">
                                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>