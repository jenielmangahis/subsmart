<div class="modal fade nsm-modal fade" id="modal-add-photo" tabindex="-1" aria-labelledby="modal-add-photo_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add Photo</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-add-photo" method="POST">                   
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="nsm-button default btn-small float-end mb-2" id="add-more-photo-rows"><i class='bx bx-plus'></i> Add More</button>
                            <label class="mb-2"></label>
                            <div id="add-photo-container">
                                <div class="input-group mb-3">
                                    <input type="file" name="photos[]" class="form-control input-photo" />                          
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-save-photo" form="frm-add-photo">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-edit-caption" tabindex="-1" aria-labelledby="modal-edit-caption_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Edit Caption</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-update-photo-caption">
                <input type="hidden" name="photo_id" id="edit-photo-id" value="" />
                <div class="row">
                    <div class="col-sm-12">
                        <label class="mb-2">Caption</label>
                        <div class="input-group mb-3">
                            <input type="text" name="photo_caption" id="edit-photo-caption" value="" class="form-control" required="" autocomplete="off" />
                        </div>
                    </div>                 
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-update-photo-caption" form="frm-update-photo-caption">Save</button>
            </div>
            </form>                
        </div>
    </div>
</div>
