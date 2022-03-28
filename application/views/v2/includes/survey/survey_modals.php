<div class="modal fade nsm-modal fade" id="new_workspace_modal" tabindex="-1" aria-labelledby="new_workspace_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?= form_open('survey/workspace/add?redirect') ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_workspace_label">Add New Workspace</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Workspace Name" name="txtWorkspaceName" class="nsm-field form-control mb-2" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_workspace_modal" tabindex="-1" aria-labelledby="edit_workspace_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="edit_workspace_label">Edit Workspace</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="workspace_id">
                        <input type="text" placeholder="Workspace Name" id="txtWorkspaceName" class="nsm-field form-control mb-2" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="edit_workspace">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="template_modal" tabindex="-1" aria-labelledby="template_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="template_label">Template</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="template_details_container"></div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" onclick="location.href='<?=base_url()?>survey/add'">Add new survey from scratch instead</button>
                <button type="submit" class="nsm-button primary" id="btn_use_template">Use this template</button>
            </div>
        </div>
    </div>
</div>