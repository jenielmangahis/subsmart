<div class="modal fade nsm-modal fade" id="custom-field-modal" tabindex="-1" aria-labelledby="custom_field_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart(null, ['id' => 'form-add-custom-field', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="custom_field_modal_label">Custom Field</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="text" placeholder="Name" name="custom_field_name" id="custom-field-name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit-custom-field-modal" tabindex="-1" aria-labelledby="edit_custom_field_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart(null, ['id' => 'form-update-custom-field', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <input type="hidden" name="cfid" value="" id="cfid" />
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="custom_field_modal_label">Custom Field</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="text" placeholder="Name" name="custom_field_name" id="edit-custom-field-name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>