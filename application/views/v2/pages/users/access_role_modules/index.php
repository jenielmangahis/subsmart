<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/users/users_modals'); ?>
<style>
.container-header{
    background-color:#6a4a86;
    padding:10px;
    margin-top:6px;
}
.container-modules h3, .edit-container-modules h3{
    font-size:15px;
    color:#ffffff;
    display:inline-block;
}
.chk-row-allow-all{
    color:#ffffff;
    float:right;
    margin-top:3px;
}

.chk-row-allow-all-widgets, .chk-row-allow-all-modules{    
    float:right;
    margin-top:3px;
}

.module-permissions{
    list-style:none;
    padding:0px;
}
.module-permissions li{
    display:inline-block;
    width:95px;
    margin:10px;
}
.container-modules, .edit-container-modules{
    max-height:600px;
    overflow-y:auto;
}
#tbl-roles-access-modules .bx{
    font-size:21px;
}
#tbl-roles-access-modules .bx-x-circle{
    color:#ff8080;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li data-bs-toggle="modal" data-bs-target="#add_employee_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add New</span>
        </li>
    </ul>
</div>


<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage Roles Access Modules.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_link" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modal-add-new-role-permission">
                                <i class='bx bx-fw bx-user-plus'></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="tbl-roles-access-modules">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Role">Role</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($roleAccessModules as $rm){ ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-windows'></i>
                                    </div>
                                </td>
                                <td class="fw-bold nsm-text-primary"><?= getRoleName($rm->role_id); ?></td>                                                                
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">                                            
                                            <li><a class="dropdown-item btn-edit-role-permission" href="javascript:void(0);" data-id="<?= $rm->role_id; ?>">Edit</a></li>
                                            <li><a class="dropdown-item btn-delete-role-permission" href="javascript:void(0);" data-role="<?= getRoleName($rm->role_id); ?>" data-id="<?= $rm->role_id; ?>">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-add-new-role-permission" tabindex="-1" aria-labelledby="job_settings_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-center">
            <form id="frm-create-role-permission">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="job_settings_modal_label">Add New</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Role</label>
                            <select class="form-control select-roles" name="role">
                                <?php foreach($roles as $key => $role){ ?>
                                    <?php if( $key != 7 ){ //Remove admin ?>
                                    <option value="<?= $key; ?>"><?= $role['name']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Access Type</label>
                            <select class="form-control select-access-type" name="access_type">
                                <option value="access-all" selected="">Access All</option>
                                <option value="define-access">Define Access</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="nsm-page-nav mt-4 grp-role-access" style="display:none;">
                        <ul>
                            <li class="li-tab active">
                                <a class="nsm-page-link role-access-tab" data-type="widgets" href="javascript:void(0);">
                                    <i class='bx bx-fw bxs-widget'></i>
                                    <span>Widgets</span>
                                </a>
                            </li>
                            <li class="li-tab">
                                <a class="nsm-page-link role-access-tab" data-type="modules" href="javascript:void(0);">
                                    <i class='bx bx-fw bx-windows'></i>
                                    <span>Modules</span>
                                </a>
                            </li>
                            <li><label></label></li>
                        </ul>
                    </div>
                    
                    <div class="grp-role-access" style="display:none;">
                        <div class="module-list-group" style="display:none;">
                            <?php include viewPath('v2/pages/users/access_role_modules/_modules_list'); ?>
                        </div>
                        <div class="widget-list-group" >
                            <?php include viewPath('v2/pages/users/access_role_modules/_widget_list'); ?>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn-save-role-access-modules">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-role-permission" tabindex="-1" aria-labelledby="job_settings_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-center">
            <form id="frm-update-role-permission">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="job_settings_modal_label">Edit</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit-role-permission-container"></div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn-update-role-access-modules">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script type="text/javascript">
$(function(){
    $(".nsm-table").nsmPagination();
    $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
    }, 1000));

    $('#modal-add-new-role-permission').modal({backdrop: 'static', keyboard: false});
    $("#modal-add-new-role-permission").on('shown', function(){
        $('#modal-edit-role-permission #edit-role-permission-container').html('');
    });

    $('.select-roles').select2({
        dropdownParent: $("#modal-add-new-role-permission"),
        placeholder: 'Select role',
        minimumInputLength: 0
    });

    $('.select-access-type').select2({
        dropdownParent: $("#modal-add-new-role-permission"),        
        minimumInputLength: 0
    });

    $('.select-access-type').on('change', function(){
        var selected = $(this).val();
        if( selected == 'access-all' ){
            $('.grp-role-access').hide();
            //$('.container-modules').hide();            
        }else{
            $('.grp-role-access').show();
            //$('.container-modules').show();
        }
    });

    $('.role-access-tab').on('click', function(){
        var type = $(this).attr('data-type');

        if( type == 'modules' ){
            $('.module-list-group').show();
            $('.widget-list-group').hide();
        }else{
            $('.widget-list-group').show();
            $('.module-list-group').hide();
        }

        $('.li-tab').removeClass('active');
        $(this).parent('.li-tab').addClass('active');
    });

    $('.chk-all-rights').on('change', function(){
        var module = $(this).attr('data-module');
        if( $(this).is(':checked') ){
            $('.chk-'+module+'-rights').prop('checked', true);
        }else{
            $('.chk-'+module+'-rights').prop('checked', false);
        }
    });

    $('.widget-list-group .chk-all-widgets').on('change', function(){
        if( $(this).is(':checked') ){
            $('.widget-list-group .chk-widgets').prop('checked', true);
        }else{
            $('.widget-list-group .chk-widgets').prop('checked', false);
        }
    });

    $('#modules-all').on('change', function(){
        if( $(this).is(':checked') ){
            $('.module-check-input').prop('checked', true);
        }else{
            $('.module-check-input').prop('checked', false);
        }
    });

    $('.btn-edit-role-permission').on('click', function(){
        var rid = $(this).attr('data-id');
        $('#modal-edit-role-permission').modal('show');
        $.ajax({
            url: base_url + 'users/_edit_role_access_module',
            method: 'post', 
            data: {rid:rid},  
            success: function (html) {
                $('#edit-role-permission-container').html(html);
            },
            beforeSend: function() {
                $('#edit-role-permission-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
        
    });

    $(document).on('click', '.btn-delete-role-permission', function(){
        var rid = $(this).attr('data-id');
        var role = $(this).attr('data-role');

        Swal.fire({
            title: 'Role Access Modules',
            html: `Proceed with deleting access modules and widgets for role <b>${role}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "users/_delete_role_access_module",
                    data: {rid:rid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Role Access Modules',
                            text: 'Data was successfully deleted.',
                            }).then((result) => {
                                window.location.reload();
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

    $('#frm-create-role-permission').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: base_url + 'users/_save_role_access_module',
            method: 'post', 
            data: $('#frm-create-role-permission').serialize(),           
            dataType:'json',
            success: function (data) {
                $('#modal-add-new-role-permission').modal('hide');
                $('#btn-save-role-access-modules').html('Save');
                if (data.is_success) {
                    Swal.fire({
                        title: 'Create role access module',
                        html: 'Data was successfully created',
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
                        icon: 'error',
                        title: 'Error',
                        text: data.msg,
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-role-access-modules').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });  
    });

    $('#frm-update-role-permission').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: base_url + 'users/_update_role_access_module',
            method: 'post', 
            data: $('#frm-update-role-permission').serialize(),           
            dataType:'json',
            success: function (data) {                
                $('#btn-update-role-access-modules').html('Save');
                if (data.is_success == 1) {
                    $('#modal-edit-role-permission').modal('hide');
                    Swal.fire({
                        title: 'Update role access module',
                        html: 'Data was successfully updated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            //location.reload();  
                        //}
                    });

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.msg,
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-role-access-modules').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });  
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>