<div class="modal-content" id="tag-form">
    <div class="modal-header">
        <button type="button" id="back-to-tags-list"><i class="bx bx-fw bx-chevron-left"></i> Back</a>
        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
    </div>
    <div class="modal-body">
        <div class="row mt-3">
            <div class="col-12">
                <h5>Create new tag</h5>
            </div>
            <div class="col-12 mt-3">
                <label for="tagName">Tag name</label>
                <input type="text" name="tag_name" id="tagName" class="form-control nsm-field mb-2" required>
            </div>
            <div class="col-12 mt-3">
                <label for="tagGroup">Group</label>
                <select class="form-control nsm-field mb-2" name="group_id" id="tagGroup">
                    <option></option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="nsm-button success">Save</button>
        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
    </div>
</div>