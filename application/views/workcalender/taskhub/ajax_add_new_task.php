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
    <div class="col-6 mt-3 company-select">
        <label for="">Customer <small>(optional)</small></label>
        <select name="customer_id" id="taskhub-customer-id" class="nsm-field mb-2 form-control"></select>
    </div>
    <div class="col-6 mt-3 company-select">
        <label for="">Assigned to</label>
        <select name="user_id" id="taskhub-user-id" class="nsm-field mb-2 form-control" required=""></select>
    </div>
</div>
<div class="row">    
    <div class="col-6 mt-3">
        <label for="">Status</label>
        <select class="form-control" name="status" id="status">
            <?php foreach($taskStatus as $ts){ ?>
                <option value="<?= $ts->status_id; ?>"><?= $ts->status_text; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-6 mt-3">
        <label for="">Priority</label>
        <select class="form-control" name="priority" id="priority">
            <?php foreach($optionPriority as $key => $value){ ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php } ?>
        </select>
    </div>

</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="">Subject</label>
        <input type="text" name="subject" id="event-name" class="form-control" required="">
    </div>
    <div class="col-6 mt-3">
        <label for="">Estimated Date of Completion</label>
        <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control dt-default" name="estimated_date_complete">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 mt-3">
    <label for="">Description</label>
    <textarea class="form-control" name="description" id="task-editor" style="height:100px;"></textarea>
</div>   
<script>
$(function(){
    CKEDITOR.replace('task-editor',{
        height: '200px',
    });

    $('#taskhub-customer-id').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
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
        placeholder: 'Select Customer',        
        minimumInputLength: 0,
        templateResult: formatRepoCustomer,
        templateSelection: formatRepoCustomerSelection
    });

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