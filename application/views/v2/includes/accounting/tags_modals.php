<div class="modal-right-side">
    <div class="modal right fade nsm-modal" tabindex="-1" id="tag-group-modal" role="dialog">
        <div class="modal-dialog" role="document" style="width: 25%">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create New Group</span>
                    <button type="button" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <form id="tags-group-form">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="tag-group-name">Group name</label>
                                        <input type="text" name="tags_group_name" id="tag-group-name" class="form-control nsm-field">
                                    </div>
                                    <div class="col-12">
                                        <button class="nsm-button success" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <table id="tags-group" class="nsm-table d-none">
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <h4>Add tags to this group</h4>
                        </div>
                        <div class="col-12">
                            <form id="tags-form">
                                <div class="row">
                                    <div class="col-12 col-md-9">
                                        <label for="tag_name">Tag name</label>
                                        <input type="text" name="tag_name" id="tag_name" class="form-control nsm-field" disabled>
                                    </div>
                                    <div class="col-12 col-md-3 d-flex align-items-end">
                                        <button class="nsm-button success w-100" type="submit" disabled>Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <table id="group-tags" class="nsm-table d-none">
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="nsm-button primary" data-bs-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-right-side">
    <div class="modal right fade nsm-modal" id="tag-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width: 25%">
            <form id="create-tag-form" class="h-100">
                <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">Create New Tag</span>
                            <button type="button" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="tag-name">Tag name</label>
                                    <input type="text" name="tag_name" id="tag-name" class="form-control nsm-field">
                                </div>
                                <div class="col-12">
                                    <label for="group">Group</label>
                                    <select name="group_id" id="group" class="form-select nsm-field"></select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="nsm-button primary">Save</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>