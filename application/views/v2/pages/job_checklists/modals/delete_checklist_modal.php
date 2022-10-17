
<div class="modal fade nsm-modal fade" id="modalDeleteChecklist" tabindex="-1" role="dialog" aria-labelledby="modalAddChecklistItemTitle" aria-hidden="true">

    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="exampleModalLongTitle">Delete</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <?php echo form_open_multipart('job_checklists/delete_checklist', ['id' => 'delete-card', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                <?php echo form_input(array('name' => 'cid', 'type' => 'hidden', 'value' => '', 'id' => 'cid'));?>
                <div class="modal-body">
                    <p>Delete selected item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-dismiss="modal">No</button>
                    <button type="submit" class="nsm-button error btn-delete-card">Yes</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
