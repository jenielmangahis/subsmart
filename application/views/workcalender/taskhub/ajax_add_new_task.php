<style> 
    .select2-container--open {
        z-index: 9999999
    }
    .select2-container{
        width: 100% !important; 
    }
    .badge{
        display: block;
        width: 100%;
        padding: 5px;
    }    
</style>

<div class="row">
    <div class="col-6 mt-3">
        <label class="content-subtitle fw-bold d-block mb-2">Title</label>
        <input type="text" name="title" class="nsm-field form-control" value="" required>        
    </div>
    <div class="col-6 mt-3 company-select">
        <?php if (isset($status_selection)) { ?>
            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
            <select name="status" id="status-select" class="nsm-field form-select status-select">
                <?php foreach($status_selection as $status) { ?>
                <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                <?php } ?>
            </select>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-6 mt-3 company-select">
        <label class="content-subtitle fw-bold d-block mb-2">Assign To</label>
        <select name="assigned_to" id="taskhub-user-id" class="nsm-field mb-2 form-control" required=""></select>
    </div>
    <div class="col-6 mt-3 company-select">
        <label class="content-subtitle fw-bold d-block mb-2">Priority</label>
        <select name="priority" id="priority-select" class="nsm-field form-select priority-select">
            <?php foreach ($optionPriority as $key => $value) { ?>
                <?php if ($task) { ?>
                    <option <?= $taskHub->priority == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                <?php } else { ?>
                    <option value="<?= $key; ?>"><?= $value; ?></option>
                <?php } ?>

            <?php } ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-6 mt-3 company-select">
        <label class="content-subtitle fw-bold d-block mb-2">Due Date</label>
        <input type="text" name="date_due" class="nsm-field form-control datepicker" value="" required>
    </div>
    <div class="col-6 mt-3 company-select">
        <label class="content-subtitle fw-bold d-block mb-2">Select a group for this task</label>
        <select name="group" id="group-select" class="nsm-field form-select group-select" required>
            <option value="0">Select a Group</option>
            <?php foreach($taskslists as $row) { ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Notes</label>
        <textarea name="notes" class="nsm-field form-control ckeditortaskhub" id="ckeditortaskhub" placeholder="Enter Notes" required></textarea>
    </div>    
</div>

<script>

$(function(){

    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
    });

    CKEDITOR.replace('ckeditortaskhub',{
        height: '200px',
    });

    CKEDITOR.config.toolbarGroups = [
        //{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        //{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        //{ name: 'links' },
        { name: 'insert' },
        //{ name: 'forms' },
        //{ name: 'tools' },
        //{ name: 'document',       groups: [ 'mode', 'document', 'doctools' ] },
        //{ name: 'others' },
        //'/',
        //{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'styles' },
        { name: 'colors' },
        //{ name: 'about' }
    ];

    $('#status-select').select2();
    $('#priority-select').select2();
    
    $('#taskhub-user-id').select2({
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
        placeholder: 'Select User',
        maximumSelectionLength: 5,
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        dropdownParent: $('#modalAddTaskHub'),
        templateSelection: formatRepoSelectionUser
    });

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            return repo.first_name + ' ' + repo.last_name;
        } else {
            return repo.text;
        }
    }

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }  

});

</script>