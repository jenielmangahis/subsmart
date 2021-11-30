<div class="modal right fade" id="existing-attachments-modal" tabindex="-1" role="dialog" aria-labelledby="existing-attachments-modal">
    <div class="modal-dialog" role="document" style="width: 15% !important">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn" data-dismiss="modal"><i class="fa fa-chevron-right"></i></button>
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