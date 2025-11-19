<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#modal-add-account-type">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php //include viewPath('v2/includes/page_navigations/customer_settings_tabs'); ?>
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Notes history made to customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                        </div>
                    </div> 

                    <div class="col-6 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">                                
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modal-add-customer-internal-notes">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <form id="frm-with-selected">
                <table class="nsm-table" id="tbl-notes">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td data-name="Name">Added By</td>
                            <td data-name="Name">Customer</td>
                            <td data-name="Name" style="width:60%;">Notes</td>                            
                            <td data-name="Date Created" style="width:8%;">Date Created</td>
                            <td data-name="Manage" style="width:3%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($internalNotes)) :
                        ?>
                            <?php
                            foreach ($internalNotes as $note) :
                            ?>
                                <tr>
                                    <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="customerNotes[]" type="checkbox" value="<?= $note->id; ?>">
                                    </td>
                                    <?php } ?>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-layer'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary show"><?= $note->user_name; ?></td>
                                    <td class="fw-bold nsm-text-primary show"><?= $note->customer_name; ?></td>
                                    <td class="fw-bold nsm-text-primary show"><?= $note->notes; ?></td>
                                    <td><?= date("m/d/Y h:i A",strtotime($note->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $note->id; ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $note->id; ?>" data-value="<?= $note->customer_name; ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="6">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

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

        $(document).on('change', '#select-all', function(){
            $('tr:visible .row-select:checkbox').prop('checked', this.checked);  
            let total= $('#tbl-notes tr:visible input[name="customerNotes[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.row-select', function(){
            let total= $('#tbl-notes input[name="customerNotes[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('click', '.edit-item', function(){
            let note_id = $(this).attr('data-id');
            $('#nid').val(note_id);
            $('#modal-edit-customer-internal-notes').modal('show');

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_edit_internal_notes',
                data: {note_id:note_id},
                success: function(html) {    
                    $('#edit-customer-internal-notes-container').html(html);
                },
                beforeSend: function() {
                    $('#edit-customer-internal-notes-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on('click', '#with-selected-delete', function(){
            let total= $('#tbl-notes input[name="customerNotes[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Customer Notes',
                    html: `Are you sure you want to delete selected rows?<br/><br/>Note : This cannot be undone.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'customers/_delete_selected_account_types',
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Delete Customer Notes',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                            beforeSend: function(){
                                Swal.fire({
                                    icon: "info",
                                    title: "Processing",
                                    html: "Please wait while the process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            }
                        });

                    }
                });
            }        
        });

        $('#frm-save-customer-internal-notes').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customer/_create_internal_notes',
                dataType: 'json',
                data: $('#frm-save-customer-internal-notes').serialize(),
                success: function(data) {    
                    $('#btn-save-customer-internal-notes').html('Save');                   
                    if (data.is_success) {
                        $('#modal-add-customer-internal-notes').modal('hide');
                        Swal.fire({
                            title: 'Add Customer Internal Notes',
                            text: "Data has been created successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
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
                    $('#btn-save-customer-internal-notes').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-update-customer-internal-notes').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customer/_update_internal_notes',
                dataType: 'json',
                data: $('#frm-update-customer-internal-notes').serialize(),
                success: function(data) {    
                    $('#btn-update-customer-internal-notes').html('Save');                   
                    if (data.is_success) {
                        $('#modal-edit-customer-internal-notes').modal('hide');
                        Swal.fire({
                            title: 'Edit Customer Internal Notes',
                            text: "Data has been updated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
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
                    $('#btn-update-customer-internal-notes').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on("click", ".delete-item", function() {
            let nid = $(this).attr("data-id");
            let value = $(this).attr('data-value');

            Swal.fire({
                title: 'Delete Customer Notes',
                html: `Are you sure you want to delete selected customer note for customer <b>${value}</b>?<br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customer/_delete_internal_notes",
                        data: {
                            nid: nid
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Delete Customer Notes',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'Failed',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>