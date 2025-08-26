<div class="modal fade" id="modal-add-new-job-title" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border:none;">
                <span class="modal-title content-title" style="font-size: 17px;">Add Job Title</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-add-job-title">
                <div class="row gy-3 mb-4">                        
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                        <input type="text" name="job_title" class="nsm-field form-control" id="job-title" required />
                    </div>
                </div>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary" id="btn-save-job-title" form="frm-add-job-title">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-job-title" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border:none;">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Job Title</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-update-job-title">
                <input type="hidden" id="jtid" name="jtid" value="" />
                <div class="row gy-3 mb-4">                        
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                        <input type="text" name="job_title" class="nsm-field form-control" id="edit-job-title" required />
                    </div>
                </div>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary" id="btn-update-job-title" form="frm-update-job-title">Save</button>
            </div>
        </div>
    </div>
</div>