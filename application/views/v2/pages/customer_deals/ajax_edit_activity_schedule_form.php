<div class="row">                        
    <div class="col-sm-12">
        <label class="mb-2">Activity Subject</label>
        <div class="input-group mb-3">
            <input type="text" name="activity_name" value="<?= $activitySchedule->activity_name; ?>" class="form-control" required="" autocomplete="off" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Activity Type</label>
        <div class="input-group mb-3">
            <select class="form-select select-activity-type" name="activity_type">
                <?php foreach($optionActivityTypes as $key => $value){ ?>
                    <option data-icon="<?= $value['icon']; ?>" value="<?= $key; ?>" <?= $activitySchedule->activity_type == $value['name'] ? 'selected="selected"' : ''; ?>><?= $value['name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">From</label>
        <div class="input-group mb-3" style="width:65%;">
            <input type="date" class="form-control" name="date_from" value="<?= date("Y-m-d", strtotime($activitySchedule->date_from)); ?>" style="margin-right:2px;" />
            <input type="time" class="form-control" name="time_from" value="<?= date("H:i", strtotime($activitySchedule->time_from)); ?>" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">To</label>
        <div class="input-group mb-3" style="width:65%;">
            <input type="date" class="form-control" name="date_to" value="<?= date("Y-m-d", strtotime($activitySchedule->date_to)); ?>" style="margin-right:2px;" />
            <input type="time" class="form-control" name="time_to" value="<?= date("H:i", strtotime($activitySchedule->time_to)); ?>" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Priority</label>
        <div class="input-group mb-3">
            <select class="form-select select-activity-priority" name="activity_priority">
                <?php foreach($optionsPriorities as $key => $value){ ?>
                    <option data-icon="<?= $value['icon']; ?>" data-color="<?= $value['color']; ?>" value="<?= $key; ?>" <?= $activitySchedule->priority == $key ? 'selected="selected"' : ''; ?>><?= $value['name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Owner</label>
        <div class="input-group mb-3">
            <select class="form-select activity-edit-company-users" name="owner_id"></select>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <label class="mb-2">Location</label>
        <div class="autocomplete-panel">
            <div id="edit-autocomplete" class="autocomplete-container"></div>
            <input type="hidden" name="activity_location" id="autocomplete-map-address" value="<?= $activitySchedule->location; ?>" class="form-control" />
        </div>                     
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Notes</label>
        <textarea name="activity_notes" id="ck-edit-activity-notes" class="form-control"><?= $activitySchedule->notes; ?></textarea>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_done" value="1" <?= $activitySchedule->is_done == 'Yes' ? 'checked=""' : ''; ?> id="activity-is-done">
            <label class="form-check-label" for="activity-is-done">
                Mark as Done
            </label>
        </div>
    </div>                    
</div>
<script>
$(function(){
    const myAPIKey = "<?= GEOAPIKEY ?>";  
    const autocompleteInput = new autocomplete.GeocoderAutocomplete(
        document.getElementById("edit-autocomplete"), 
        myAPIKey, 
        { /* Geocoder options */ 
    });

    $('.geoapify-autocomplete-input').val('<?= $activitySchedule->location; ?>');

    CKEDITOR.replace( 'ck-edit-activity-notes', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '150px',
    });

    $('.activity-edit-company-users').select2({
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
        dropdownParent: $("#modal-edit-deal-scheduled-activity"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatActivityEditRepoUser,
        templateSelection: formatActivityEditRepoSelectionUser
    });

    function formatActivityEditRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }
        
        let $container = $(
            '<div>' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatActivityEditRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }
});
</script>