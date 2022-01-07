<div class="modal fade nsm-modal fade" id="new_estimate_modal" tabindex="-1" aria-labelledby="new_estimate_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_estimate_modal_label">New Estimate</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <label class="content-title">What type of estimate you want to create</label>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Create a regular estimate with items</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('estimate/add') ?>'">Standard Estimate</button>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Customers can select all or only certain options</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('estimate/addoptions?type=2') ?>'">Options Estimate</button>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Customers can select both Bundle Packages to<br>obtain an overall discount</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('estimate/addbundle?type=3') ?>'">Bundle Estimate</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="clone_estimate_modal" tabindex="-1" aria-labelledby="clone_estimate_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="clone_estimate_modal_label">Clone Estimate</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="hidden" id="wo_id" name="est_id">
                        <label class="content-title d-block mb-2">You are going create a new Estimate based on</label>
                        <label class="content-title d-block mb-2">Estimate Number: <span class="work_order_no"></span></label>
                        <label class="content-subtitle d-block">Afterwards you can edit the newly created Estimate.</label>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="clone_workorder">Clone</button>
            </div>
        </div>
    </div>
</div>