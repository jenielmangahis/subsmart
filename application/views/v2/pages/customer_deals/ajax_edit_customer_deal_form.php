<input type="hidden" name="customer_deal_id" value="<?= $customerDeal->id; ?>" />
<div class="row">
    <div class="col-sm-12">
        <label class="mb-2">Customer <?= $customerDeal->customer_first_name . ' ' . $customerDeal->customer_last_name; ?></label>
        <div class="input-group mb-3">
            <select class="edit-select-customer form-select" name="customer_id">
                <option value="<?= $customerDeal->customer_id; ?>" selected="selected"><?= $customerDeal->customer_firstname . ' ' . $customerDeal->customer_lastname; ?></option>
            </select>                                
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Title</label>
        <div class="input-group mb-3">
            <input type="text" name="deal_title" value="<?= $customerDeal->deal_title; ?>" id="edit-deal-title" class="form-control" required="" autocomplete="off" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Value</label>
        <div class="input-group mb-3">
            <input type="number" step="any" name="deal_value" value="<?= number_format($customerDeal->value,2,".",""); ?>" class="form-control" required="" autocomplete="off" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Stage</label>
        <div class="input-group mb-3">
            <select class="form-select edit-select-stage" name="deal_stage_id">
                <?php foreach($customerDealStages as $stage){ ?>
                    <option value="<?= $stage->id; ?>" <?= $customerDeal->customer_deal_stage_id == $stage->id ? 'selected="selected"' : ''; ?>><?= $stage->name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Label</label>
        <a href="javascript:void(0);" class="nsm-button btn-small float-end" id="btn-edit-quick-add-label"><span class="fa fa-plus"></span> Add New Label</a> 
        <div class="input-group mb-3">
            <select class="form-select edit-select-label" name="deal_label[]" multiple=""></select>
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Probability</label>
        <div class="input-group mb-3">
            <input type="number" step="any" name="deal_probability" value="<?= number_format($customerDeal->probability,2,".",""); ?>" class="form-control" required="" autocomplete="off" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Expected close date</label>
        <div class="input-group mb-3">
            <input type="date" name="expected_close_date" value="<?= date("Y-m-d", strtotime($customerDeal->expected_close_date)); ?>" class="form-control" required="" autocomplete="off" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Source Channel</label>
        <div class="input-group mb-3">
            <select class="form-select edit-select-channel" name="source_channel">
                <?php foreach($optionSourceChannel as $channel){ ?>
                    <option value="<?= $channel; ?>" <?= $customerDeal->source_channel == $channel ? 'selected="selected"' : ''; ?>><?= $channel; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Source Channel ID</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" value="<?= $customerDeal->source_channel_id; ?>" name="source_channel_id" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Owner</label>
        <div class="input-group mb-3">
            <select class="form-select edit-company-users" name="owner_id">
                <option value="<?= $owner->id; ?>" selected=""><?= $owner->FName . ' ' . $owner->LName; ?></option>
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Visible to</label>
        <div class="input-group mb-3">
            <select class="form-select edit-select-visible-to" name="visible_to">
                <?php foreach($optionVisibleTo as $visibleTo){ ?>
                    <option value="<?= $visibleTo; ?>" <?= $customerDeal->visible_to == $visibleTo ? 'selected="selected"' : ''; ?>><?= $visibleTo; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>

<script>
$(function(){
    $('.edit-select-stage').select2({
        dropdownParent: $("#modal-edit-deal"),
        placeholder: 'Select Stage',
    });

    $('.edit-select-channel').select2({
        dropdownParent: $("#modal-edit-deal"),
        placeholder: 'Select Stage',
    });

    $('.edit-select-visible-to').select2({
        dropdownParent: $("#modal-edit-deal"),
        placeholder: 'Select Visible To',
    });

    $('.edit-select-label').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer_deal_labels',
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
        placeholder: 'Select label',
        dropdownParent: $("#modal-edit-deal"),        
        templateResult: editFormatResultCustomerDealLabel,
        templateSelection: editFormatSelectionCustomerDealLabel
    });

    $('.edit-select-customer').select2({
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
            escapeMarkup: function(markup) {
                return markup;
            },
            cache: true
        },
        placeholder: 'Select Customer',
        dropdownParent: $("#modal-edit-deal"),
        minimumInputLength: 0,
        templateResult: editFormatRepoCustomer,
        templateSelection: editFormatRepoCustomerSelection
    });

    $('.edit-company-users').select2({
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
        dropdownParent: $("#modal-edit-deal"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: editFormatRepoUser,
        templateSelection: editFormatRepoSelectionUser
    });
    
    function editFormatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function editFormatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            let customer_name = repo.first_name + ' ' + repo.last_name;
            let deal_name = customer_name + ' deal';
            $('#edit-deal-title').val(deal_name);

            return customer_name;
        } else {
            return repo.text;
        }
    }    

    function editFormatResultCustomerDealLabel(data){
        if (data.loading) {
            return data.text;
        }

        let bgColor  = data.color;
        let labelId  = data.id;            
        let $result  = $(`<span style="color:${bgColor}">${data.name}</span><a class="float-end select-label-edit" href="javascript:void(0);"><i class='bx bx-pencil' data-name="${data.name}" data-id="${labelId}" data-color="${bgColor}"></i></a><a class="float-end" style="margin-right:10px;" href="javascript:void(0);"><i class='bx bx-trash-alt' data-name="${data.name}" data-id="${labelId}"></i></a>`);

        return $result;
    }

    function editFormatSelectionCustomerDealLabel(data, container){
        console.log(data);
        let color  = data.title;
        let name   = data.text;

        $(container).css("background-color", color);
        if( color == '#ffffff' ){
            return $(`<span style="color:#000000;">${name}</span>`);
        }else{
            return $(`<span style="color:#ffffff;">${name}</span>`);
        }
    }

    function editFormatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }
        
        var $container = $(
            '<div>' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function editFormatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }

    var initialValue = { id: 5, text: 'Orange', color:'red' }; // Example pre-selected value
    // Create the DOM option and pre-select it
    <?php foreach( $dealLabels as $label ){ ?>
        var option = new Option('<?= $label->name; ?>', '<?= $label->id; ?>', true, true);
        option.setAttribute("title","<?= $label->color; ?>");
        $('.edit-select-label').append(option).trigger('change');
    <?php } ?>

    $('.edit-select-label').on('select2:selecting', function (e) {        
        if (e.params.args.originalEvent.target.className === 'bx bx-trash-alt') {                  
            let label_id   = e.params.args.originalEvent.target.getAttribute('data-id');      
            let label_name = e.params.args.originalEvent.target.getAttribute('data-name');      
            
            Swal.fire({
                title: 'Delete Label',
                html: `Are you sure you want to delete label <b>${label_name}</b> ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "customer_deals/_delete_label",
                        data: {label_id:label_id},
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Delete Label',
                                text: 'Customer deals label was successfully deleted.',
                                }).then((result) => {
                                    $(this).trigger('change');
                                    //e.params.args.originalEvent.currentTarget.remove();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
            e.preventDefault();
        }else if( e.params.args.originalEvent.target.className === 'bx bx-pencil' ){
            let label_id   = e.params.args.originalEvent.target.getAttribute('data-id');      
            let label_name = e.params.args.originalEvent.target.getAttribute('data-name');      
            let label_color = e.params.args.originalEvent.target.getAttribute('data-color');
            let modal_name  = 'modal-edit-deal';
            
            $('#customer-deal-modal-name').val(modal_name);
            $('#modal-edit-deal').modal('hide');
            $('#modal-quick-edit-label').modal('show');
            $('#edit-customer-deal-label-name').val(label_name);
            $('#edit-customer-deal-label-color').val(label_color);
            $('#cdlid').val(label_id);

            e.preventDefault();
        }
    });

    $('#btn-edit-quick-add-label').on('click', function(){
        let modal_name = 'modal-edit-deal';

        $('#customer-deal-modal-name').val(modal_name);
        $('#modal-edit-deal').modal('hide');
        $('#modal-quick-add-label').modal('show');
    });
});
</script>