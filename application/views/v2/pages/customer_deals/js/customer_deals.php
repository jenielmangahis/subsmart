<script type="text/javascript">
$(function(){    
    load_deal_stages();
    const myAPIKey = "<?= GEOAPIKEY ?>";  
    const autocompleteInput = new autocomplete.GeocoderAutocomplete(
        document.getElementById("autocomplete"), 
        myAPIKey, 
        { /* Geocoder options */ 
    });

    CKEDITOR.replace( 'ck-activity-notes', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '150px',
    });

    $('#modal-view-archive').on('show.bs.modal', function (e) {
        $('#btn-archive').popover('hide');
    });

    $('#btn-stage-view').on('click', function(){
        location.href = base_url + 'customer_deals';
    });

    $('#btn-forecast-view').on('click', function(){
        location.href = base_url + 'customer_deals/forecast'
    });

    $('#btn-stage-view').on('click', function(){
        location.href = base_url + 'customer_deals'
    });

    $('#btn-stage-view').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Stages';
        } 
    });

    $('#btn-list-view').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'List';
        } 
    });

    $('#btn-forecast-view').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Forecast';
        } 
    });

    $('#btn-archive').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Archive';
        } 
    });

    $('.select-stage').select2({
        dropdownParent: $("#modal-add-new-deal"),
        placeholder: 'Select Stage',
    });

    $('.select-channel').select2({
        dropdownParent: $("#modal-add-new-deal"),
        placeholder: 'Select Stage',
    });

    $('.select-visible-to').select2({
        dropdownParent: $("#modal-add-new-deal"),
        placeholder: 'Select Visible To',
    });

    $('.select-label').select2({
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
        dropdownParent: $("#modal-add-new-deal"),        
        templateResult: formatResultCustomerDealLabel,
        templateSelection: formatSelectionCustomerDealLabel
    });

    function formatResultCustomerDealLabel(data){
        if (data.loading) {
            return data.text;
        }

        let bgColor  = data.color;
        let labelId  = data.id;            
        let $result  = $(`<div class="select-label-action-buttons"><span style="color:${bgColor}">${data.name}</span><a class="float-end select-label-edit" href="javascript:void(0);" style="display:none;"><i class='bx bx-pencil' data-name="${data.name}" data-id="${labelId}" data-color="${bgColor}"></i></a><a class="float-end select-label-delete" style="margin-right:10px;display:none;" href="javascript:void(0);"><i class='bx bx-trash-alt' data-name="${data.name}" data-id="${labelId}"></i></a></div>`);

        return $result;
    }

    function formatSelectionCustomerDealLabel(data, container){
        let color  = data.color;
        let name   = data.name;

        $(container).css("background-color", color);
        if( color == '#ffffff' ){
            return $(`<span style="color:#000000;">${name}</span>`);
        }else{
            return $(`<span style="color:#ffffff;">${name}</span>`);
        }
    }

    $(document).on('mouseenter', '.select2-results__option', function() {
        $(this).find('a').show();     
    }).on('mouseleave', '.select2-results__option', function() {
        $(this).find('a').hide();     
    });

    $('.select-label').on('select2:selecting', function (e) {        
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
            let modal_name  = 'modal-add-new-deal';
            
            $('#customer-deal-modal-name').val(modal_name);
            $('#modal-add-new-deal').modal('hide');
            $('#modal-quick-edit-label').modal('show');
            $('#edit-customer-deal-label-name').val(label_name);
            $('#edit-customer-deal-label-color').val(label_color);
            $('#cdlid').val(label_id);

            e.preventDefault();
        }
    });

    $('.select-customer').select2({
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
        dropdownParent: $("#modal-add-new-deal"),
        minimumInputLength: 0,
        templateResult: formatRepoCustomer,
        templateSelection: formatRepoCustomerSelection
    });

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        let $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            let customer_name = repo.first_name + ' ' + repo.last_name;
            let deal_name = customer_name + ' deal';
            $('#deal-title').val(deal_name);

            return customer_name;
        } else {
            return repo.text;
        }
    }

    $('.company-users').select2({
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
        dropdownParent: $("#modal-add-new-deal"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $('.activity-company-users').select2({
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
        dropdownParent: $("#modal-create-deal-scheduled-activity"),
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }
        
        let $container = $(
            '<div>' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }

    $('.select-activity-type').select2({
        placeholder: 'Select Activity Type',
        dropdownParent: $("#modal-create-deal-scheduled-activity"),
        escapeMarkup : function(markup) {
            return markup;
        },
        templateResult: formatRepoActivityType,
        templateSelection: formatRepoSelectionActivityType
    });

    function formatRepoActivityType(state){
        if (!state.id) {
            return state.text;
        }
        let icon = '<i class="' + state.element.dataset.icon + '"></i>';
        let $state = $('<span>' + icon + ' ' + state.text + '</span>');
        return $state;
    };

    function formatRepoSelectionActivityType(state, container){
        if (!state.id) {
            return selected.text;
        }
        
        let icon = "<i class='" + $(state.element).data('icon') + "'></i> ";
        return icon + state.text;
    }

    $('.select-activity-priority').select2({
        placeholder: 'Select Priority',
        dropdownParent: $("#modal-create-deal-scheduled-activity"),
        escapeMarkup : function(markup) {
            return markup;
        },
        templateResult: formatRepoActivityPriority,
        templateSelection: formatRepoSelectionActivityPriority
    });

    function formatRepoActivityPriority(state){
        if (!state.id) {
            return state.text;
        }

        let icon   = '<i class="' + state.element.dataset.icon + '"></i>';
        let color  = state.element.dataset.color; 
        let $state = $(`<span style="">${icon} ${state.text}</span>`);

        if( color != '' ){
            $state = $(`<span style="background-color:${color};color:#ffffff;width:75px;display:block;">${icon} ${state.text}</span>`);
        }

        return $state;
    };

    function formatRepoSelectionActivityPriority(state, container){
        if (!state.id) {
            return selected.text;
        }

        let icon   = "<i class='" + $(state.element).data('icon') + "'></i> ";
        let color  = state.element.dataset.color; 
        let $state = $(`<span>${icon} ${state.text}</span>`);

        if( color != '' ){            
            $state = $(`<span style="background-color:${color};padding-right:9px;padding-left:3px;color:#ffffff;">${icon} ${state.text}</span>`);            
        }

        return $state;
    }

    $('#btn-new-deal').on('click', function(){
        $('#modal-add-new-deal').modal('show');
    });

    $('#btn-add-new-stage').on('click', function(){
        $('#modal-add-new-deal-stage').modal('show');
    });

    $(document).on('click', '.btn-edit-deal-stage', function(){
        let stage_id = $(this).attr('data-id');

        $('#cdid').val(stage_id);
        $('#modal-edit-deal-stage').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_edit_deal_stage",
            data: {stage_id:stage_id},
            success: function(html) {    
                $('#edit-deal-stage-container').html(html);
            },
            beforeSend: function() {
                $('#edit-deal-stage-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#toggle-rotting-days').on('change', function(){
        if( $(this).is(':checked') ){
            $('#rotting-num-days').show();
        }else{
            $('#rotting-num-days').hide();
        }
    });

    $('#btn-quick-add-label').on('click', function(){
        let modal_name = 'modal-add-new-deal';

        $('#customer-deal-modal-name').val(modal_name);
        $('#modal-add-new-deal').modal('hide');
        $('#modal-quick-add-label').modal('show');
    });

    $('#modal-quick-add-label').on('hidden.bs.modal', function () {
        let modal_name = $('#customer-deal-modal-name').val();
        $(`#${modal_name}`).modal('show');
    });

    $('#modal-quick-edit-label').on('hidden.bs.modal', function () {
        let modal_name = $('#customer-deal-modal-name').val();
        $(`#${modal_name}`).modal('show');
    });

    $('#frm-add-new-deal-stage').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_create_deal_stage",
            dataType: 'json',
            data: $('#frm-add-new-deal-stage').serialize(),
            success: function(data) {    
                $('#btn-save-deal-stage').html('Save');                   
                if (data.is_success) {
                    $('#modal-add-new-deal-stage').modal('hide');
                    Swal.fire({
                        title: 'Deal Stage',
                        text: "New deal stage has been added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            load_deal_stages();
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-deal-stage').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-edit-deal-stage').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_update_deal_stage",
            dataType: 'json',
            data: $('#frm-edit-deal-stage').serialize(),
            success: function(data) { 
                $('#btn-update-deal-stage').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-edit-deal-stage').modal('hide');
                    Swal.fire({
                        title: 'Deal Stage',
                        text: "Deal stage has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            load_deal_stages();
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-deal-stage').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '.btn-delete-deal-stage', function(){
        let stage = $(this).attr("data-name");
        let id   = $(this).attr("data-id");

        Swal.fire({
            title: 'Delete Deal Stage',
            html: `Are you sure you want to delete deal stage <b>${stage}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'customer_deals/_delete_deal_stage',
                    data: {
                        cdid: id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Deal Stage',
                                html: "Data deleted successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    load_deal_stages();
                                //}
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    });

    $('#frm-add-new-deal').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_create_deal",
            dataType: 'json',
            data: $('#frm-add-new-deal').serialize(),
            success: function(data) { 
                $('#btn-save-customer-deal').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-add-new-deal').modal('hide');
                    $('#frm-add-new-deal')[0].reset();
                    $('.select-customer').val(null).trigger('change');
                    $('.select-label').val(null).trigger('change');
                    $('.select-channel').val('None').trigger('change');
                    $('.company-users').val(null).trigger('change');
                    $('.select-visible-to').val('Item Owner').trigger('change');

                    Swal.fire({
                        title: 'Customer Deal',
                        text: "New customer deal has been created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            load_deal_stages();
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-customer-deal').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-update-deal').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_update_deal",
            dataType: 'json',
            data: $('#frm-update-deal').serialize(),
            success: function(data) { 
                $('#btn-update-customer-deal').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-edit-deal').modal('hide');
                    Swal.fire({
                        title: 'Customer Deal',
                        text: "Customer deal has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            load_deal_stages();
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-customer-deal').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-save-customer-deal-label').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_create_deal_label",
            dataType: 'json',
            data: $('#frm-save-customer-deal-label').serialize(),
            success: function(data) { 
                $('#btn-save-deal-label').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-quick-add-label').modal('hide');
                    Swal.fire({
                        title: 'Deal Label',
                        text: "New deal label has been created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {                            
                            $(".select-label").trigger('change');
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-deal-label').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });

    });

    $('#frm-update-customer-deal-label').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_update_deal_label",
            dataType: 'json',
            data: $('#frm-update-customer-deal-label').serialize(),
            success: function(data) { 
                $('#btn-update-deal-label').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-quick-edit-label').modal('hide');
                    Swal.fire({
                        title: 'Deal Label',
                        text: "Deal label has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {                            
                            $(".select-label").trigger('change');
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-deal-label').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });

    });

    $(document).on('click', '.stage-quick-add-deal-btn', function(){
        let stage_id = $(this).attr('data-id');
        $('#modal-add-new-deal').modal('show');

        $('.select-stage').val(stage_id);
        $('.select-stage').trigger('change');
    });

    $(document).on('click', '.btn-view-customer-deals', function(){
        let customer_deal_id = $(this).attr('data-id');
        $('#modal-view-customer-deals').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_view_customer_deal",
            data: {customer_deal_id:customer_deal_id},
            success: function(html) {    
                $('#view-customer-deals-container').html(html);
            },
            beforeSend: function() {
                $('#view-customer-deals-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });

    });

    $(document).on('click', '#btn-delete-customer-deals', function(){
        let customer_deal_id = $(this).attr('data-id');
        let customer_deal_title = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Customer Deal',
            html: `Are you sure you want to delete customer deal <b>${customer_deal_title}</b>?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "customer_deals/_delete_customer_deal",
                    data: {customer_deal_id:customer_deal_id},
                    dataType:'json',
                    success: function(result) {
                        $('#modal-view-customer-deals').modal('hide');
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Delete Customer Deal',
                            text: 'Customer deal was successfully deleted.',
                            }).then((result) => {
                                load_deal_stages();
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
    });

    $(document).on('click', '#btn-edit-customer-deals', function(){
        let customer_deal_id = $(this).attr('data-id');

        $('#modal-view-customer-deals').modal('hide');
        $('#modal-edit-deal').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_edit_customer_deal_form",
            data:{customer_deal_id:customer_deal_id},
            success: function(html) {    
                $('#edit-deal-form-container').html(html);
            },
            beforeSend: function() {
                $('#edit-deal-form-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $("#customer-deal-lost").droppable({
        accept: ".deal-stage-item",
        hoverClass: "lost-container",
        drop: function(event, ui) {
            let item = $(ui.draggable[0]);
            let deal_id = item.attr('data-id');
            let status  = 'Lost';
            if( deal_id > 0 ){
                let html_content = `
                    <div class="row mark-lost-form">
                        <div class="col-sm-12">
                            <label class="mb-2">Lost Reason</label>
                            <div class="input-group mb-3">
                                <select class="form-select select-lost-reason" id="lost-reason">
                                <?php foreach( $optionLostReasons as $reason ){ ?>
                                    <option value="<?= $reason; ?>"><?= $reason; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Comments</label>
                            <div class="input-group mb-3">
                                <textarea id="lost-comment" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p>Manage lost reasons in <a class="nsm nsm-link" href="<?= base_url('customer/customer_deal_lost_reasons') ?>">Customer Settings</a></p>
                        </div>
                    </div>
                `;       

                Swal.fire({
                    title: 'Mark as lost',
                    html: html_content,
                    icon: false,
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    confirmButtonText: 'Mark as lost',                    
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let lost_reason  = $('#lost-reason').val();
                        let lost_comment = $('#lost-comment').val();
                        $.ajax({
                            type: "POST",
                            url: base_url + "customer_deals/_update_customer_deal_status",
                            data:{deal_id:deal_id, lost_reason:lost_reason, lost_comment:lost_comment, status:status},
                            dataType:'json',
                            success: function(result) {                            
                                if( result.is_success == 1 ) {
                                    ui.draggable.remove();
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Mark as lost',
                                    text: 'Customer deal was updated successfully.',
                                    }).then((result) => {
                                        load_deal_stages();
                                    });
                                } else {
                                    ui.draggable.draggable('option','revert',true); 
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
            }
        }
    });

    $("#customer-deal-won").droppable({
        accept: ".deal-stage-item",
        hoverClass: "won-container",
        drop: function(event, ui) {
            let item = $(ui.draggable[0]);
            let deal_id = item.attr('data-id');
            let status  = 'Won';
            if( deal_id > 0 ){
                $.ajax({
                    type: "POST",
                    url: base_url + "customer_deals/_update_customer_deal_status",
                    data:{deal_id:deal_id, status:status},
                    dataType:'json',
                    success: function(data) {    
                        load_deal_stage_summary(data.stage_id);

                        Swal.fire({
                        icon: 'success',
                        text: 'Customer deals was successfully updated.',
                        }).then((result) => {                            
                            //e.params.args.originalEvent.currentTarget.remove();
                        });
                    },
                    beforeSend: function() {
                        
                    }
                });
            }
            ui.draggable.remove();
        }
    });

    $("#customer-deal-delete").droppable({
        accept: ".deal-stage-item",
        hoverClass: "delete-container",
        drop: function(event, ui) {
            let item = $(ui.draggable[0]);            
            let customer_deal_id = item.attr('data-id');
            let deal_title = item.attr('data-name');

            Swal.fire({
                title: 'Delete Customer Deal',
                html: `Are you sure you want to delete customer deal <b>${deal_title}</b>?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "customer_deals/_delete_customer_deal",
                        data: {customer_deal_id:customer_deal_id},
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                ui.draggable.remove();
                                Swal.fire({
                                icon: 'success',
                                title: 'Delete Customer Deal',
                                text: 'Customer deal was successfully deleted.',
                                }).then((result) => {
                                    load_deal_stages();
                                });
                            } else {
                                ui.draggable.draggable('option','revert',true); 
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
        }
    });

    $(document).on('click', '.btn-view-activity-scheduled', function(){
        let customer_deal_id = $(this).attr('data-id');

        $('.btn-create-schedule-activity').attr('data-id', customer_deal_id);
        $('#modal-customer-deal-activity-schedules').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_deal_scheduled_activities",
            data:{customer_deal_id:customer_deal_id},
            success: function(html) {    
                $('#activity-schedules-container').html(html);
            },
            beforeSend: function() {
                $('#activity-schedules-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $(document).on('click', '.btn-create-schedule-activity', function(){
        let customer_deal_id = $(this).attr('data-id');

        $('#cdi').val(customer_deal_id);
        CKEDITOR.instances['ck-activity-notes'].setData('');
        $('#modal-customer-deal-activity-schedules').modal('hide');
        $('#modal-create-deal-scheduled-activity').modal('show');
    });

    $(document).on('submit', '#frm-save-activity-schedule', function(e){
        e.preventDefault();

        let autocomplete_address = $('.geoapify-autocomplete-input').val();
        $('#autocomplete-map-address').val(autocomplete_address);

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_create_customer_deal_activity_schedule",
            dataType: 'json',
            data: $('#frm-save-activity-schedule').serialize(),
            success: function(data) { 
                $('#btn-save-schedule-activity').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-create-deal-scheduled-activity').modal('hide');
                    $('#frm-save-activity-schedule')[0].reset();

                    Swal.fire({
                        title: 'Activity Schedule',
                        text: "New activity schedule has been created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {                            
                            //load_deal_stages();
                        //}
                    });     

                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-schedule-activity').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('change', '.opt-is-done', function(){
        let activity_id = $(this).attr('data-id');
        let obj = $(this);

        $('.opt-is-done').popover('hide');

        if( $(this).prop('checked') ){
            obj.parent().parent().parent().fadeOut(500, function() {
                $(this).remove();
                $.ajax({
                    type: "POST",
                    url: base_url + "customer_deals/_activity_is_done",
                    data:{activity_id:activity_id},
                    dataType:'json',
                    success: function(data) {    
                        if( data.is_success ){           
                            $(this).find('.activity-card').remove();   
                        }
                    },
                    beforeSend: function() {
                        
                    }
                });
            });            
        }
    });

    $(document).on('click', '.activity-info', function(){
        let activity_id = $(this).attr('data-id');
        let activity_type = $(this).attr('data-type');

        $('#edit-asid').val(activity_id);
        $('#modal-customer-deal-activity-schedules').modal('hide');
        $('#modal-edit-deal-scheduled-activity').modal('show');    
        $('#btn-delete-schedule-activity').attr('data-id', activity_id);
        $('#btn-delete-schedule-activity').attr('data-name', activity_type);    
        
        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_edit_activity_schedule_form",
            data:{activity_id:activity_id},
            success: function(html) {    
                $('#edit-activity-schedule-container').html(html);
            },
            beforeSend: function() {
                $('#edit-activity-schedule-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $(document).on('submit', '#frm-update-activity-schedule', function(e){
        e.preventDefault();

        let autocomplete_address = $('.geoapify-autocomplete-input').val();
        $('#autocomplete-map-address').val(autocomplete_address);

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_update_customer_deal_activity_schedule",
            dataType: 'json',
            data: $('#frm-update-activity-schedule').serialize(),
            success: function(data) { 
                $('#btn-update-schedule-activity').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-edit-deal-scheduled-activity').modal('hide');
                    $('#frm-update-activity-schedule')[0].reset();

                    Swal.fire({
                        title: 'Activity Schedule',
                        text: "Activity schedule has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {                            
                            //load_deal_stages();
                        //}
                    });     

                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-schedule-activity').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#btn-delete-schedule-activity', function(){
        let activity_id = $(this).attr('data-id');
        let activity_type = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Scheduled Activity',
            html: `Are you sure you want to delete selected activity <b>${activity_type}</b> ?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "customer_deals/_delete_deal_activity_schedule",
                    data: {activity_id:activity_id},
                    dataType:'json',
                    success: function(result) {
                        $('#btn-delete-schedule-activity').html('Delete');
                        $('#modal-edit-deal-scheduled-activity').modal('hide');

                        if( result.is_success == 1 ) {                            
                            Swal.fire({
                            icon: 'success',
                            title: 'Delete Scheduled Activity',
                            text: 'Activity schedule was successfully deleted.',
                            }).then((result) => {                                
                                
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    },beforeSend: function() {
                        $('#btn-delete-schedule-activity').html('<span class="bx bx-loader bx-spin"></span>');
                    }
                });
            }
        });
    }); 

    $('#btn-archive').on('click', function(){
        $('#modal-view-archive').modal('show');

         $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_archive_deals",
            success: function(html) {    
                $('#customer-deals-archive-container').html(html);
            },
            beforeSend: function() {
                $('#customer-deals-archive-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $(document).on('click', '.btn-restore-customer-deal', function(){
        let deal_id = $(this).attr('data-id');
        let deal_title = $(this).attr('data-title');

        Swal.fire({
            title: 'Restore Customer Deal',
            html: `Are you sure you want to restore customer deal <b>${deal_title}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'customer_deals/_restore_deals',
                    data: {
                        deal_id: deal_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Restore Customer Deal',
                                html: "Data updated successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    load_deal_stages();
                                //}
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    });

    $('#btn-add-new-lost-reason').on('click', function(){
        $('#modal-add-new-lost-reason').modal('show');
    });

    $('#frm-add-new-lost-reason').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_create_lost_reason",
            dataType: 'json',
            data: $('#frm-add-new-lost-reason').serialize(),
            success: function(data) { 
                $('#btn-save-lost-reason').html('Save');                  
                if (data.is_success) {                     
                    $('#modal-add-new-lost-reason').modal('hide');
                    $('#frm-add-new-lost-reason')[0].reset();

                    Swal.fire({
                        title: 'Lost Reason',
                        text: "New lost reason has been added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {                            
                            
                        //}
                    });     

                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-lost-reason').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    function load_deal_stages(){        
        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_deal_stages",
            success: function(html) {    
                $('#deal-stages').html(html);
            },
            beforeSend: function() {
                $('#deal-stages').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    }

    function load_deal_stage_summary(stage_id){
        $.ajax({
            type: "POST",
            url: base_url + "customer_deals/_deal_stage_summary",
            data:{stage_id:stage_id},
            dataType:'json',
            success: function(data) {   
                
                let total_deals = data.total_records + ' deal';
                if( data.total_records > 1 ){
                    total_deals = data.total_records + ' deals';
                }

                $(`#stage-${stage_id}-total-amount`).text(data.total_value);
                $(`#stage-${stage_id}-total-deals`).text(total_deals);
            },
            beforeSend: function() {
                
            }
        });
    }
});
</script>