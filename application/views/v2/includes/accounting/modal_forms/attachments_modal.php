<div class="modal right fade nsm-modal" id="existing-attachments-modal" role="dialog" data-bs-backdrop="false" style="width: 15%; margin-left: auto; right: 0">
    <div class="modal-dialog" role="document" style="width: 15% !important">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="nsm-button" data-bs-dismiss="modal" style="position: absolute; left: 0; top: 0; margin: 0"><i class="bx bx-fw bx-chevron-right"></i></button>
                <div class="row attachments-container">
                    <div class="col-12 pb-3">
                        <h4>Add to <?=ucfirst($type)?></h4>
                        <div class="d-flex justify-content-center">
                            <select class="form-control" id="attachment-types">
                                <option value="unlinked">Unlinked</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>