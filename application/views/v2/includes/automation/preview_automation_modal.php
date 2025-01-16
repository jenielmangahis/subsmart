<div class="modal fade" id="previewEmail" data-bs-backdrop="static" tabindex="-1" aria-labelledby="previewEmailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-12 ">
                            <label class="mb-1 fw-xnormal">Subject</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <input name="preview_subject" class="form-control mt-0" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-1 fw-xnormal">From</label>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input name="sender" class="form-control mt-0" type="email" value="<?php echo logged('email'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="preview_message" id="preview_automation_msg" cols="30" rows="2" class="form-control ckeditor"></textarea>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>