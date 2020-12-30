<div class="modal fade" id="formDeleteModal" tabindex="-1" role="dialog" aria-labelledby="formDeleteModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-light">Danger!</h5>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this form <b id="deleteFormName"></b> and all of its results and settings?
                </p>
                <p>After 7 days, this form will become unrecoverable.</p>
                <input type="hidden" name="form-id" id="deleteFormID">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="handleDeleteForm()">Yes, delete it</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it</button>
            </div>

        </div>
    </div>
</div>