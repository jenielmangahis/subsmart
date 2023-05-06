<div class="modal fade nsm-modal fade" id="job_settings_modal" tabindex="-1" aria-labelledby="job_settings_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_update_job_settings">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="job_settings_modal_label">Job Settings</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <input type="text" placeholder="Job Prefix" name="job_settings_prefix" class="nsm-field form-control mb-2" value="<?= $settings_prefix; ?>" required />
                    </div>
                    <div class="col-8">
                        <input type="number" placeholder="Job Next Number" name="job_settings_next_number" class="nsm-field form-control mb-2" value="<?= $settings_next_num; ?>" step="any" required />
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
                        <div class="col-md-12 mb-2">
                            <input type="text" placeholder="Name" name="name" class="nsm-field form-control mb-2" required />
                            <input type="number" placeholder="Percentage" name="rate" min="0" step="any" class="nsm-field form-control" required />
                        </div>
                        <div class="col-md-12 mb-2">
                            <input class="form-check-input" type="checkbox" id="DEFAULT_TAXRATE">
                            <label class="form-check-label" for="DEFAULT_TAXRATE">Set to Default Tax Rate</label>
                            <input type="hidden" name="DEFAULT_TAXRATE" value="false" readonly="">
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

<div class="modal fade nsm-modal fade" id="edit_tax_rate_modal" tabindex="-1" aria-labelledby="eidt_tax_rate_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_edit_tax">
            <input type="hidden" name="tid" id="edit-tid" value="">
            <div class="modal-content"> 
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit_tax_rate_modal_label">Edit Tax Rate</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input type="text" placeholder="Name" name="tax_name" id="edit-tax-name" class="nsm-field form-control mb-2" required />
                            <input type="number" placeholder="Percentage" id="edit-tax-rate" name="tax_rate" min="0" step="any" class="nsm-field form-control" required />
                        </div>
                        <div class="col-md-12 mb-2">
                            <input class="form-check-input" type="checkbox" id="UPDATE_DEFAULT_TAXRATE">
                            <label class="form-check-label" for="UPDATE_DEFAULT_TAXRATE">Set to Default Tax Rate</label>
                            <input type="hidden" name="UPDATE_DEFAULT_TAXRATE" value="false" readonly="">
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

<script type="text/javascript">
    $("#DEFAULT_TAXRATE").on('change', function(event) {
        event.preventDefault();
        if ($(this).prop("checked") == true) {
            $("input[name='DEFAULT_TAXRATE']").val("true");
        } else {
            $("input[name='DEFAULT_TAXRATE']").val("false");
        }
    });
    $("#UPDATE_DEFAULT_TAXRATE").on('change', function(event) {
        event.preventDefault();
        if ($(this).prop("checked") == true) {
            $("input[name='UPDATE_DEFAULT_TAXRATE']").val("true");
        } else {
            $("input[name='UPDATE_DEFAULT_TAXRATE']").val("false");
        }
    });
</script>