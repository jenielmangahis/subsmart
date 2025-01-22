<div class="modal fade nsm-modal fade" id="manage_modules_modal" tabindex="-1" aria-labelledby="manage_modules_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="manage_modules_modal_label">Manage Modules</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <label class="content-subtitle">Select the modules you would like to display in your layout</label>
                    </div>
                    <div class="col-12" id="modules_container">
                        <div class="nsm-loader">
                            <i class='bx bx-loader-alt bx-spin'></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="widgetIDs" />
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-send-esign" tabindex="-1" aria-labelledby="modal-send-esign_label" aria-hidden="true">
    <div class="modal-dialog">
        <input type="hidden" id="customer-esign" value="" />
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="edit_cc_label">Send eSign</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="customer-send-esign"></div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-customer-send-esign-template">Send</button>
            </div>
        </div>
    </div>
</div>