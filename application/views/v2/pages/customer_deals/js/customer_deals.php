<script type="text/javascript">
$(function(){    
    load_deal_stages();

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
        dropdownParent: $("#modal-add-new-deal"),
        placeholder: 'Select Visible To',
        templateResult: function(data) {
            if (data.element) {
                var bgColor = $(data.element).data('color');
                if (bgColor) {
                    $(data.element).css('background-color', bgColor);
                }
            }
            return data.text;
        },
        templateSelection: function(data, container) {
            const option = $(data.element);
            const color  = option.data("color");

            $(container).css("background-color", color);
            if( color == '#ffffff' ){
                return $(`<span style="color:#000000;">${data.text}</span>`);
            }else{
                return $(`<span style="color:#ffffff;">${data.text}</span>`);
            }
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

        var $container = $(
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

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }
        
        var $container = $(
            '<div>' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
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
        $('#modal-add-new-deal').modal('hide');
        $('#modal-quick-add-label').modal('show');
    });

    $('#modal-quick-add-label').on('hidden.bs.modal', function () {
        $('#modal-add-new-deal').modal('show');
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
                                html: "Data Deleted Successfully!",
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
                        text: "Label has been created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            const selectElement = $('.select-label');
                            const newOption = $('<option>', {
                            value: data.label.id,
                            text: data.label.name,
                            'data-color': data.label.color
                            });
                            selectElement.append(newOption);
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
});
</script>