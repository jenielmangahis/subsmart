<div class="modal fade nsm-modal fade" id="addon_modal" tabindex="-1" aria-labelledby="addon_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('more/add_plugin', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <?php echo form_input(array('name' => 'pid', 'type' => 'hidden', 'value' => '', 'id' => 'pid'));?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add On Details</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="addon_details">
            </div>
            <div class="modal-footer">
                <button type="submit" class="nsm-button primary w-100">Add</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
