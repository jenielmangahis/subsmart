<div class="modal fade nsm-modal fade" id="new_tax_rate_modal" tabindex="-1" aria-labelledby="new_tax_rate_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_add_tax">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_tax_rate_modal_label">Add New Tax Rate</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Name" name="name" class="nsm-field form-control mb-2" required />
                        <input type="number" placeholder="Percentage" name="rate" min="0" class="nsm-field form-control" required />
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

<div class="modal fade nsm-modal fade" id="job_settings_modal" tabindex="-1" aria-labelledby="job_settings_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="job_settings_modal_label">Job Settings</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" placeholder="Job Prefix" class="nsm-field form-control mb-2" value="JOB-" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>