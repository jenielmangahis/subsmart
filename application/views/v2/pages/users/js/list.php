<script type="text/javascript">
$(document).ready(function() {

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('input[name="users[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('input[name="users[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-archived, #btn-mobile-archived').on('click', function(){
        $('#modal-view-archive').modal('show');

         $.ajax({
            type: "POST",
            url: base_url + "users/_archived_list",
            success: function(html) {    
                $('#users-archived-container').html(html);
            },
            beforeSend: function() {
                $('#users-archived-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#tbl-users-list input[name="users[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Users',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_archive_selected_users',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Users',
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
                    });

                }
            });
        }        
    });

    $(document).on('click', '#with-selected-change-status', function(){
        let total= $('#tbl-users-list input[name="users[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            let html_content = `
                <div class="row user-change-status">
                    <div class="col-sm-12">
                        <label class="mb-2">Status</label>
                        <div class="input-group mb-3">
                            <select class="form-select" id="with-selected-status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            `; 

            Swal.fire({
                title: 'Change Status',
                html: html_content,
                icon: false,
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                confirmButtonText: 'Save',                    
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    let status  = $('#with-selected-status').val();

                    const form = document.getElementById('frm-with-selected');
                    const formData = new FormData(form);
                    formData.append('status', status); 

                    $.ajax({
                        type: "POST",
                        url: base_url + "users/_change_status_selected_users",
                        data:formData,
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Change Status',
                                text: 'Data was updated successfully.',
                                }).then((result) => {
                                    location.reload();
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
        }        
    });

    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-users input[name="users[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Users',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_restore_selected_users',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Restore Users',
                                    text: "Data restored successfully!",
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
                    });

                }
            });
        }        
    });

    $(document).on('click', '#with-selected-perma-delete', function(){
        let total = $('#archived-users input[name="users[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Users',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_permanently_delete_selected_users',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Delete Users',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        //location.reload();
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
                    });

                }
            });
        }        
    });

    $(document).on('click', '#btn-empty-archives', function(){        
        let total = $('#archived-users input[name="users[]"]').length;        
        if( total > 0 ){
            Swal.fire({
                title: 'Empty Archived',
                html: `Are you sure you want to <b>permanently delete</b> <b>${total}</b> archived users? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_delete_all_archived_users',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Empty Archived',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        //location.reload();
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
                    });

                }
            });
        }else{
            Swal.fire({                
                icon: 'error',
                title: 'Error',              
                html: 'Archived is empty',
            });
        }        
    });

    $(document).on('click', '.btn-restore-user', function(){
        let user_id   = $(this).attr('data-id');
        let user_name = $(this).attr('data-name');

        Swal.fire({
            title: 'Restore User',
            html: `Are you sure you want to restore user <b>${user_name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'users/_restore_user',
                    data: {
                        user_id: user_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Restore User',
                                html: "Data updated successfully!",
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

    $(document).on('click', '.btn-permanently-delete-user', function(){
        let user_id   = $(this).attr('data-id');
        let user_name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete User',
            html: `Are you sure you want to <b>permanently delete</b> user <b>${user_name}</b>? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'users/_delete_archived_user',
                    data: {
                        user_id: user_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete User',
                                html: "Data deleted successfully!",
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

    $('#add_employee_modal').modal({backdrop: 'static', keyboard: false});
    $('#edit_employee_modal').modal({backdrop: 'static', keyboard: false});

    populateEmployeeRoles();
    $(".nsm-table").nsmPagination();

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $("#btn-export-list, .btn-export-list").on("click", function() {
        location.href = base_url + 'users/export_list';
    });

    $("#employee_username").on("input", debounce(function() {
        let _this = $(this);
        let url = "<?php echo base_url('users/checkUsername'); ?>";
        let username = _this.val();

        _this.closest(".nsm-field-group").removeClass("error x check success");
        _this.next("small").remove();
        _this.removeClass("error");

        if (username != "") {
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                data: {
                    username: username
                },
                success: function(result) {
                    if (result > 0) {
                        _this.closest(".nsm-field-group").addClass("error x");
                        _this.after("<small class='nsm-text-error'>Username already exist</small>");
                        _this.addClass("error");
                    } else {
                        _this.closest(".nsm-field-group").addClass("check success");
                    }
                }
            });
        }
    }, 1000));

    $(".password-field").on("click", function(e) {
        let _this = $(this);
        let _container = _this.closest(".nsm-field-group");
        let shown = _container.hasClass("show");

        if (e.offsetX > 345) {
            if (shown) {
                _container.removeClass("show").addClass("hide");
                _this.attr("type", "text");
            } else {
                _container.removeClass("hide").addClass("show");
                _this.attr("type", "password");
            }
        }else{
            if (shown) {
                _container.removeClass("show").addClass("hide");
                _this.attr("type", "password");
            } else {
                _container.removeClass("hide").addClass("show");
                _this.attr("type", "text");
            }
        }
    });

    $('#add_employee_modal .form-select').select2({
        dropdownParent: $("#add_employee_modal")
    });

    $("#btn-share-url").on("click", function() {
        var _shareableLink = $("<input>");
        $("body").append(_shareableLink);
        _shareableLink.val("<?php echo base_url('/add_company_employee/' . $eid); ?>").select();
        document.execCommand('copy');
        _shareableLink.remove();

        Swal.fire({
            title: 'Success',
            text: "Shareable link has been copied to clipboard.",
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        });
    });

    $("#add_employee_form").on("submit", function(e) {
        let _this = $(this);
        e.preventDefault();

        let num_license = "<?= $num_license ?>";
        if( num_license > 0 ){
            var formData = new FormData($("#add_employee_form")[0]);
            var url = base_url + "user/_create_employee";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(result) {
                    if (result == 1) {
                        $('#add_employee_modal').modal('hide');
                        Swal.fire({
                            title: 'Create Employee',
                            text: "Data has been created successfully",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            location.reload();
                        });
                    } else if (result == 3) {
                        Swal.fire({
                            title: 'Failed',
                            text: "Insufficient license. Please purchase license to continue adding user.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Purchase License'
                        }).then((result) => {
                            window.location.href = base_url + 'mycrm/membership';
                        });
                    } else if (result == 4) {
                        Swal.fire({
                            title: 'Failed',
                            text: "ADT Sales App password not same",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else if (result == 5) {
                        Swal.fire({
                            title: 'Failed',
                            text: "ADT Sales App account already exists",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else if (result == 6) {
                        Swal.fire({
                            title: 'Failed',
                            text: "Username already exists",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });                        
                    } else {
                        Swal.fire({
                            title: 'Failed',
                            text: "Cannot create employee",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    //$("#add_employee_modal").modal('hide');
                    //_this.trigger("reset");
                    $('#btn-save-employee').html('Save');                    
                },
                beforeSend: function() {
                    $('#btn-save-employee').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        }else{
            let membership_url = base_url + 'mycrm/membership';
            let html_content = `
                <p>You do not have enough license to add new user.</p>
                <p>You can buy more license in your <a href="${membership_url}" target="_">crm monthly membership</a>.</p>
            `;  

            Swal.fire({
                title: 'Insufficient License',
                html: html_content,
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            }).then((result) => {
                
            });
        }
    });

    $(document).on("click", ".edit-item", function() {
        let id = $(this).attr("data-id");
        let _container = $("#edit_employee_container");
        let _form = $("#edit_employee_form");
        let url = "<?php echo base_url('users/_edit_employee'); ?>";
        showLoader(_container);

        $.ajax({
            url: url,
            type: "POST",
            dataType: "html",
            data: {
                user_id: id
            },
            success: function(result) {
                _container.html(result);
                _form.find("button[type=submit]").prop("disabled", false);
                $("#edit_employee_modal").modal("show");
            }
        });
    });

    $(document).on("click", ".btn-delete-commission-setting-row", function(e){  
        var tableRow = $(this).closest('tr'); 
        tableRow.find('td').fadeOut('fast', 
            function(){ 
                tableRow.remove();                    
            }
        );
    });

    function modalShowLoader(_elem) {
        let loader = '<div class="row">' +
            '<div class="col-12">' +
            '<div class="nsm-loader">' +
            '<i class="bx bx-loader-alt bx-spin"></i>' +
            '</div>' +
            '</div>' +
            '</div>';
        _elem.html(loader);
    }

    $(document).on('click', '.view-job-row', function(){
        var appointment_id = $(this).attr('data-id');
        var url = base_url + "job/_quick_view_details";  

        $('#modal-quick-view-job').modal('show');
        modalShowLoader($(".view-schedule-container")); 

        setTimeout(function () {
        $.ajax({
            type: "POST",
            url: url,
            data: {appointment_id:appointment_id},
            success: function(o)
            {          
                $(".view-schedule-container").html(o);
            }
        });
        }, 500);
    });

    $(document).on('click', '.delete-employee-commission-item', function(){
        let cid = $(this).attr('data-id');
        let url = base_url + "user/_get_employee_commission_status";  
        $.ajax({
            type: "POST",
            url: url,
            data: {cid:cid},
            dataType:'json',
            success: function(result)
            {          
                if( result.msg != '' ){
                    Swal.fire({
                        title: 'Failed',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }else{
                    if( result.is_paid == 1 ){
                        Swal.fire({
                            title: 'Failed',
                            text: 'Cannot delete already processed commission',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }else{
                        Swal.fire({
                            title: 'Delete Employee Commission',
                            text: "Are you sure you want to delete the selected employee commission?",
                            icon: 'question',
                            confirmButtonText: 'Proceed',
                            showCancelButton: true,
                            cancelButtonText: "Cancel"
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    type: 'POST',
                                    url: base_url + "user/_delete_employee_commission",
                                    data: {
                                        cid: cid
                                    },
                                    dataType: "json",
                                    success: function(aresult) {
                                        if (aresult.is_success) {
                                            Swal.fire({
                                                title: 'Success',
                                                text: "Data was successfully deleted.",
                                                icon: 'success',
                                                showCancelButton: false,
                                                confirmButtonText: 'Okay'
                                            }).then((result) => {
                                                load_employee_commissions_list(aresult.employee_id);
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Failed',
                                                text: aresult.msg,
                                                icon: 'error',
                                                showCancelButton: false,
                                                confirmButtonText: 'Okay'
                                            });
                                        }
                                    },
                                });
                            }
                        });    
                    }    
                }
            }
        });
    });

    $(document).on('click', '.commissions-list', function(){
        var eid = $(this).attr('data-id');
        $('#employee_commissions_list_modal').modal('show'); 
        load_employee_commissions_list(eid);            
    });

    function load_employee_commissions_list(eid){
        var url = base_url + 'user/_commission_list';
        $.ajax({
            url: url,
            type: "POST",
            data: {eid:eid},
            success: function(o) {
                $('#employee-commissions-list-container').html(o);
            }
        });
    }

    $(document).on('click', '.edit-employee-commission-item', function(){
        var rowcid = $(this).attr('data-id');
        var amount = $('.row-commission-amount-'+rowcid).text();
        
        $('#row-employee-commission-'+rowcid).val(amount);
        $('.row-commission-amount-'+rowcid).hide();
        $('.row-commission-form-group-'+rowcid).show();
    });

    $(document).on('click', '.row-employee-commission-cancel', function(){
        var rowid = $(this).attr('data-id');
        $('.row-commission-amount-'+rowid).show();            
        $('.row-commission-form-group-'+rowid).hide();
    });

    $(document).on('click', '.row-employee-commission-update', function(){
        var rowid = $(this).attr('data-id');
        var com_amount = $('#row-employee-commission-'+rowid).val();
        if( com_amount > 0 ){                
            $.ajax({
                url: base_url + 'user/_update_employee_commission',
                type: "POST",
                dataType: "json",
                data: {cid:rowid, amount:com_amount},
                success: function(data) {
                    if (data.is_success == 1) {                  
                        Swal.fire({
                            title: 'Success',
                            text: "Employee commission was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            $('.row-commission-amount-'+rowid).show();
                            $('.row-commission-amount-'+rowid).text(data.commission_amount);
                            $('.row-commission-form-group-'+rowid).hide();
                            $('#row-employee-commission-'+rowid).val(data.commission_amount);
                            $('.row-commission-total').text(data.total_commission);
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: data.msg,
                            icon: 'warning'
                        });
                    }
                }
            });
        }else{
            Swal.fire({
                showConfirmButton: false,
                title: 'Failed',
                text: 'Please enter commission amount',
                icon: 'warning'
            });
        }
    });

    $(document).on('submit', '#edit_employee_form', function(e){
        e.preventDefault();

        var _this = $(this);
        var formData = new FormData(this);
        $.ajax({
            url: base_url + 'users/_update_employee',
            type: "POST",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false, 
            success: function(data) {
                if (data.is_success == 1) {                  
                    Swal.fire({
                    title: 'Edit Employee',
                    text: "Data was successfully updated.",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    //if (result.value) {
                        location.reload()
                    //}
                    });
                } else {
                    Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: 'Failed',
                    text: data.msg,
                    icon: 'warning'
                    });
                }

                $("#edit_employee_modal").modal('hide');
                _this.trigger("reset");

                $('#btn-update-employee').html('Save');
            },
            beforeSend: function() {
                $('#btn-update-employee').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on("click", ".change-password-item", function() {
        let id = $(this).attr("data-id");
        let name = $(this).attr("data-name");

        $("#changePasswordUserId").val(id);
        $("#changePasswordEmployeeName").val(name);
        $("#change_password_modal").modal("show");
    });

    $("#change_password_form").on("submit", function(e) {
        let _this = $(this);
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: base_url + 'user/_change_user_password',
            data: _this.serialize(),
            dataType: "json",
            success: function(result) {
                if (result.is_success) {
                    $("#change_password_modal").modal('hide');
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Employee password has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
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
                
                _this.trigger("reset");
                $('#btn-change-password').html('Save');                                
            },
            beforeSend: function() {
                $('#btn-change-password').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on("click", ".delete-item", function() {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete User',
            html: `Are you sure you want to delete employee <b>${name}</b>?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "users/_delete_user",
                    data: {
                        eid: id
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Employee',
                                text: "Data was successfully deleted.",
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
                });
            }
        });
    });

    $(document).on("click", "#btn-add-employee", function(){
        let num_license = "<?= $num_license; ?>";

        if( num_license > 0 ){
            $('#commission-settings tbody').html('');
            $('#add_employee_modal').modal('show');
        }else{
            let membership_url = base_url + 'mycrm/membership';
            let html_content = `
                <p>You do not have enough license to add new user.</p>
                <p>You can buy more license in your <a href="${membership_url}" target="_">crm monthly membership</a>.</p>
            `;  

            Swal.fire({
                title: 'Insufficient License',
                html: html_content,
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            }).then((result) => {
                
            });
        }
    });

    $(document).on("click", ".update-profile-item", function(){
        let id = $(this).attr("data-id");
        let img = $(this).attr("data-img");
        let _form = $("#change_profile_form");

        _form.find(".nsm-img-upload").css("background-image", "url('<?= base_url('/uploads/users/user-profile/') ?>" + img + "')");         
        _form.find("#user_id_prof").val(id);
        $("#change_profile_modal").modal("show");
    });

    $("#change_profile_form").on("submit", function(e) {
        let _this = $(this);
        e.preventDefault();

        let url = base_url + "user/_update_employee_profile_photo";
        $('#btn-row-change-profile-photo').html("Saving");
        $('#btn-row-change-profile-photo').prop("disabled", true);
        let formData = new FormData(_this[0]);   

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType: "json",
            contentType: false,
            cache: false,
            processData:false,
            data: formData,
            success: function(result) {
                if (result == 1) {
                    $("#change_profile_modal").modal('hide');
                    Swal.fire({
                        title: 'Employee Photo',
                        text: "Employee photo has been updated successfully.",
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
                        text: "Please select a valid image.",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }

                $('#btn-row-change-profile-photo').find("button[type=submit]").html("Save");
                $('#btn-row-change-profile-photo').find("button[type=submit]").prop("disabled", false);
            },
        });
    });
});

function populateEmployeeRoles() {
    let _container = $("#employee_role");
    let url = "<?php echo base_url('users/getRoles'); ?>";

    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(result) {
            $.each(result, function(i, obj) {
                _container.append("<option value=" + obj.id + ">" + obj.text + "</option>");
            });
        }
    });
}

$(document).on('click', '.change-adt-portal-access', function(){
    let uid = $(this).attr("data-id");
    let _container = $("#adt-portal-access-container");
    let url = "<?php echo base_url('user/_load_edit_adt_portal_login_details'); ?>";
    $("#change_adt_portal_access_modal").modal("show");
    showLoader(_container);

    $.ajax({
        url: url,
        type: "POST",
        data: {uid:uid},
        success: function(result) {
            _container.html(result);
            // _form.find("button[type=submit]").prop("disabled", false);                
        }
    });
});

$(document).on('click', '.btn-add-new-commision', function(e){
    let url = base_url + "user/_add_commission_form";
    $.ajax({
        type: 'POST',
        url: url,
        success: function(o) {
            $("#commission-settings tbody").append(o).children(':last').hide().fadeIn(400);                
        },
    });
});

$(document).on('click', '.btn-edit-add-new-commision', function(e){
    let url = base_url + "user/_add_commission_form";
    $.ajax({
        type: 'POST',
        url: url,
        success: function(o) {
            $("#edit-commission-settings tbody").append(o).children(':last').hide().fadeIn(400);                
        },
    });
});

$(document).on('submit', '#change-adt-portal-login', function(e){
    let _this = $(this);
    e.preventDefault();

    let url = "<?php echo base_url(); ?>user/_update_adt_portal_login_details";
    _this.find("button[type=submit]").html("Saving");
    _this.find("button[type=submit]").prop("disabled", true);
    let formData = new FormData(_this[0]);   

    $.ajax({
        type: 'POST',
        url: url,
        data: _this.serialize(),
        dataType: "json",
        contentType: false,
        cache: false,
        processData:false,
        data: formData,
        success: function(result) {
            if (result.is_success == 1) {
                $("#change_adt_portal_access_modal").modal("hide");
                Swal.fire({
                    title: 'Save Successful!',
                    text: "Employee ADT Sales Portal Access was successfully updated.",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {                        
                    /*if (result.value) {
                        location.reload();
                    }*/
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

            _this.find("button[type=submit]").html("Save");
            _this.find("button[type=submit]").prop("disabled", false);
        },
    });
});
</script>