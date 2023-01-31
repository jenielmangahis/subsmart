<div class="nsm-card primary">
    <input type="hidden" name="tcid" value="<?= $technicianScheduleOff->id; ?>">
    <div class="nsm-card-content">   
        <div class="row g-3">         
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Leave Date</label>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <input type="text" name="tc_off_start_date" id="tc_off_start_date" class="nsm-field form-control edit-tc-off-datepicker" placeholder="Start Date" required style="padding: 0.375rem 0.75rem;" value="<?= date("l, F d, Y", strtotime($technicianScheduleOff->leave_start_date)); ?>">                                    
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" name="tc_off_end_date" id="tc_off_end_date" class="nsm-field form-control edit-tc-off-datepicker" placeholder="End Date" required style="padding: 0.375rem 0.75rem;" value="<?= date("l, F d, Y", strtotime($technicianScheduleOff->leave_end_date)); ?>">                                    
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Technicians</label>
                <select class="nsm-field form-select" name="tc_off_user_ids[]" id="quick-edit-tc-off-users" multiple="multiple">
                    <?php foreach($tech_assigned as $t){ ?>
                        <option value="<?= $t['id']; ?>" selected="selected"><?= $t['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Assign Task To <small>(optional)</small></label>
                <select class="nsm-field form-select" name="tc_off_task_to_user_id" id="quick-edit-tc-off-assign-to">
                    <?php if($taskAssigned){ ?>
                        <option value="<?= $taskAssigned->id; ?>" selected="selected"><?= $taskAssigned->FName . ' ' . $taskAssigned->LName; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12">
                <div class="col-12">
                    <label class="content-subtitle fw-bold d-block mb-2">Task / Leave Details</label>
                    <textarea name="tc_off_task_details" id="tc-off-task-details" class="nsm-field form-control" required=""><?= $technicianScheduleOff->task_details; ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $('.edit-tc-off-datepicker').datepicker({        
        format: 'DD, MM dd, yyyy',
        autoclose: true,
    });

    $('#quick-edit-tc-off-assign-to').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        dropdownParent: $("#modal-quick-edit-tc-off"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('#quick-edit-tc-off-users').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,                
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data,
                };
            },
            cache: true
        },
        dropdownParent: $("#modal-quick-edit-tc-off"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });
});
</script>
 