<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Memo</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div id="memo_input_div">
                        <textarea name="memo_txt" id="memo_txt" disabled readonly class="nsm-field form-control" rows="7"><?= isset($profile_info) ? $profile_info->notes : ''; ?></textarea>
                        <div class="memo-update-tools mt-3 text-end" style="display: none;">
                            <button class="nsm-button btn-sm m-0 me-2" id="save_memo">
                                Save Memo
                            </button>
                            <button class="nsm-button btn-sm error m-0" id="memo_cancel">
                                Cancel
                            </button>
                        </div> 
                    </div>
                </div>
                <div class="col-12">
                    <div class="memo-edit-tools">
                        <div class="row g-2">
                            <div class="col-12 col-md-4">
                                <button role="button" class="nsm-button w-100 ms-0" id="edit_memo">
                                    <i class='bx bx-fw bx-edit'></i> Edit Memo
                                </button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button role="button" class="nsm-button w-100 ms-0" id="clear_memo">
                                    <i class='bx bx-fw bx-eraser'></i> Clear Memo
                                </button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button role="button" class="nsm-button w-100 ms-0" onclick="window.open('<?= base_url('customer/internal_notes/'.$cus_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                                    <i class='bx bx-fw bx-history'></i> View History
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>