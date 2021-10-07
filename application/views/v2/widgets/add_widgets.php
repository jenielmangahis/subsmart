<div class="modal fade nsm-modal fade" id="manage_widgets_modal" tabindex="-1" aria-labelledby="manage_widgets_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="manage_widgets_modal_label">Manage Widgets</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <label class="content-subtitle">Select the widgets you would like to display in your dashboard</label>
                    </div>
                    <div class="col-12" id="add_widget_container">
                        <div class="nsm-loader">
                            <i class='bx bx-loader-alt bx-spin'></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <label class="content-subtitle mb-2 d-block">Track stats important to your business</label>
                        <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('mycrm/membership') ?>'">UPGRADE PLAN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>