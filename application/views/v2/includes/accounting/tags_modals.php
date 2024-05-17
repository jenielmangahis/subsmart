<div class="modal-right-side" id="modalTagsAddNew">
    <div class="modal right fade nsm-modal" tabindex="-1" id="tag-group-modal" role="dialog">
        <div class="modal-dialog" role="document" style="width: 25%">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create New Group</span>
                    <button type="button" data-bs-dismiss="modal" id="closeModalTags"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <form id="tags-group-form">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="tag-group-name">Group name</label>
                                        <input type="text" name="tags_group_name" id="tag-group-name" class="form-control nsm-field" required="">
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
                                        <input type="text" name="tag_name" id="tag_name" class="form-control nsm-field" disabled required="">
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
                            <button type="button" data-bs-dismiss="modal" id="closeModalTags"><i class="bx bx-fw bx-x m-0"></i></button>
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
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="nsm-button primary">Save</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_accounting_tag_modal" tabindex="-1" aria-labelledby="edit_accounting_tag_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="frm-accounting-edit-tag">
            <input type="hidden"  name="tid" id="edit-tid" value="" />
            <input type="hidden"  name="tag_type" id="edit-tag-type" value="" />
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Tag</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Tag Name" name="tag_name" id="edit-tag-name" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>