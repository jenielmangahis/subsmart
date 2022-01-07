<div class="modal fade nsm-modal fade" id="new_workorder_modal" tabindex="-1" aria-labelledby="new_workorder_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_workorder_modal_label">New Work Order</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <label class="content-title">What type of work order you want to create</label>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Create new work order</label>
                        <?php if (empty($company_work_order_used->work_order_template_id)) : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/NewworkOrder') ?>'">New Work Order</button>
                        <?php elseif ($company_work_order_used->work_order_template_id == '0') : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/NewworkOrder') ?>'">New Work Order</button>
                        <?php else : ?>
                            <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/NewworkOrderAlarm') ?>'">New Work Order</button>
                        <?php endif; ?>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2">Existing work order</label>
                        <button type="button" class="nsm-button w-50 primary" onclick="location.href='<?php echo base_url('workorder/NewworkOrder?type=2') ?>'">Existing</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="clone_workorder_modal" tabindex="-1" aria-labelledby="clone_workorder_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="clone_workorder_modal_label">Clone Work Order</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="hidden" id="wo_id" name="wo_id">
                        <label class="content-title d-block mb-2">You are going create a new work order based on</label>
                        <label class="content-title d-block mb-2">Work Order Number: <span class="work_order_no"></span></label>
                        <label class="content-subtitle d-block">Afterwards you can edit the newly created work order.</label>
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

<div class="modal fade nsm-modal fade" id="update_field_modal" tabindex="-1" aria-labelledby="update_field_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('workorder/updatecustomField', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="update_field_modal_label">Update Field</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row text-center gy-3">
                    <div class="col-12">
                        <input type="hidden" class="nsm-field form-control" name="custom_id" id="custom_id"><br>
                        <input type="text" placeholder="Name" name="custom_name" id="custom_name_update" class="nsm-field form-control" required />
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Update</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>