<div class="modal-content" id="group-tag-form">
    <div class="modal-header">
        <button type="button" onclick="showTagsList(this)"><i class="bx bx-fw bx-chevron-left"></i> Back</a>
        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
    </div>
    <div class="modal-body">
        <div class="row mt-3">
            <div class="col-12">
                <h5>Create new group</h5>
            </div>
            <div class="col-12 mt-3">
                <form id="tags-group-form">
                    <label for="tag_group_name">Group name</label>
                    <input type="text" name="tags_group_name" id="tag_group_name" class="form-control nsm-field mb-2">
                    <button class="nsm-button success" type="submit">Save</button>
                </form>
            </div>
            <div class="col-12 mt-3">
                <table id="tags_group" class="nsm-table hide">
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-12 mt-3">
                <h6>Add tags to this group</h6>
                <form class="mb-3" id="tags-form">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <label for="tag-name">Tag name</label>
                            <input type="text" name="tag_name" id="tag-name" class="form-control nsm-field mb-2">
                        </div>
                        <div class="col-12 col-md-4 d-flex align-items-end">
                            <button class="nsm-button success w-100 mb-2">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <table id="group_tags" class="nsm-table hide">
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="nsm-button success" data-bs-dismiss="modal">Done</button>
    </div>
</div>