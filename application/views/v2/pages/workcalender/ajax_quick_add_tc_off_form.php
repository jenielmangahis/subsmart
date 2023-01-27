<div class="nsm-card primary">
    <div class="nsm-card-content">   
        <div class="row g-3">         
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Leave Date</label>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <input type="text" name="tc_off_start_date" id="tc_off_start_date" class="nsm-field form-control tc-off-datepicker" placeholder="Start Date" required style="padding: 0.375rem 0.75rem;" value="<?= date("l, F d, Y", strtotime($default_start_date)); ?>">                                    
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" name="tc_off_end_date" id="tc_off_end_date" class="nsm-field form-control tc-off-datepicker" placeholder="End Date" required style="padding: 0.375rem 0.75rem;" value="<?= date("l, F d, Y", strtotime($default_start_date)); ?>">                                    
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Technicians</label>
                <select class="nsm-field form-select" name="tc_off_user_ids[]" id="quick-add-tc-off-users" multiple="multiple"></select>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Assign Task To <small>(optional)</small></label>
                <select class="nsm-field form-select" name="tc_off_task_to_user_id" id="quick-add-tc-off-assign-to"></select>
            </div>
            <div class="col-12">
                <div class="col-12">
                    <label class="content-subtitle fw-bold d-block mb-2">Task / Leave Details</label>
                    <textarea name="tc_off_task_details" id="tc-off-task-details" class="nsm-field form-control" required=""></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $('.tc-off-datepicker').datepicker({        
        format: 'DD, MM dd, yyyy',
        autoclose: true,
    });

    $('#quick-add-tc-off-assign-to').select2({
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
        dropdownParent: $("#modal-quick-add-tc-off"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('#quick-add-tc-off-users').select2({
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
        dropdownParent: $("#modal-quick-add-tc-off"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });
});
</script>
 