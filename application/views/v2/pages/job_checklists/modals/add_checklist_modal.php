<div class="modal fade nsm-modal fade" id="modalAddChecklistItem" tabindex="-1" role="dialog" aria-labelledby="modalAddChecklistItemTitle" aria-hidden="true">
    <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-add-checklist-item', 'autocomplete' => 'off' ]); ?>
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title content-title" id="exampleModalLongTitle">Add New Item</span>
            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="item_name" id="item_name" value="" class="form-control" autocomplete="off" required="">
                    </div>
                </div>          
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="nsm-button primary btn-add-checklist">Add</button>
        </div>
    </div>
    </div>
    <?php echo form_close(); ?>
</div>