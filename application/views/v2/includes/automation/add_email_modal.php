<div class="modal fade" id="addEmail" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addEmailLabel" aria-hidden="true">
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
                                <input name="schedule_cc" class="form-control mt-0" type="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="mb-1 fw-xnormal">From</label>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <input name="schedule_cc_checkbox" class="form-check-input mt-0 ccCheckbox cursorPointer" type="checkbox" checked>
                            </div>
                            <input name="schedule_cc" class="form-control mt-0" type="email" value="<?php echo logged('email');; ?>" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <textarea name="automation_msg" id="automation_msg" cols="30" rows="2" class="form-control ckeditor">Thank you for your business.</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined" data-bs-dismiss="modal">Close</button>
                <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                    <i class='bx bx-fw bx-check'></i> Save and close
                </button>
            </div>
        </div>
    </div>
</div>