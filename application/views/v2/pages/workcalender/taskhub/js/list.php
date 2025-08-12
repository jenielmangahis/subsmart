<script type="text/javascript">
$(function(){
    $(".nsm-table").nsmPagination({itemsPerPage:10});

    $("#search_field").on("input", debounce(function() {
        let search = $(this).val();
        if( search == '' ){
            $(".nsm-table").nsmPagination();
            $("#taskhub-list").find("tbody .nsm-noresult").remove();
        }else{
            tableSearch($(this));        
        }
    }, 1000));

    $('.filter-task').on('click', function(){
        var task_status = $(this).attr('data-status');
        location.href = base_url + 'taskhub?status=' + task_status;
    }); 

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#taskhub-list input[name="tasks[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#taskhub-list input[name="tasks[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-add-task').on('click', function(){
        location.href = base_url + 'taskhub/create';
    });

    $('#btn-archived, #btn-mobile-archived').on('click', function(){
        $('#modal-view-archive').modal('show');

         $.ajax({
            type: "POST",
            url: base_url + "taskhub/_archived_list",
            success: function(html) {    
                $('#tasks-archived-container').html(html);
            },
            beforeSend: function() {
                $('#tasks-archived-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });

    $(document).on('click', '#with-selected-change-status', function(){
        let total= $('#taskhub-list input[name="tasks[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            let html_content = `
                <div class="row task-change-status">
                    <div class="col-sm-12">
                        <label class="mb-2">Status</label>
                        <div class="input-group mb-3">
                            <select class="form-select" id="with-selected-status">
                                <option value="Backlog">Backlog</option>
                                <option value="Doing">Doing</option>
                                <option value="Review Fail">Review Fail</option>
                                <option value="On Testing">On Testing</option>
                                <option value="Review">Review</option>
                                <option value="Done">Done</option>
                                <option value="Closed">Closed</option>
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
                        url: base_url + "taskhub/_change_status_selected_tasks",
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

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#taskhub-list input[name="tasks[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Tasks',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'taskhub/_archive_selected_tasks',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Tasks',
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

    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-tasks input[name="tasks[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Tasks',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'taskhub/_restore_selected_tasks',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Restore Tasks',
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
        let total = $('#archived-tasks input[name="tasks[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Tasks',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'taskhub/_permanently_delete_selected_tasks',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Delete Tasks',
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
    
    $(document).on("click", ".btn-complete-task", function() {
        let id = $(this).attr('data-id');
        let title = $(this).attr("data-title");

        Swal.fire({
            title: 'Complete Task',
            text: "Are you sure you want to mark as completed task: " + title + "?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('taskhub/_task_mark_completed'); ?>",
                    dataType: 'json',
                    data: {
                        tsid: id
                    },
                    success: function(result) {
                        console.log(result);
                        if (result.is_success == 1) {
                            Swal.fire({
                                title: 'Update Successful!',
                                text: "Taskhub data is successfully updated!",
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
                                title: 'An Error Occured',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        }
                    },
                });
            }
        });
    });

    $("#btn-delete-tasks").on("click", function() {

        Swal.fire({
            title: 'Delete Tasks',
            html: "This will delete all selected tasks. Proceed with action?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('taskhub/_delete_selected_tasks'); ?>",
                    dataType: 'json',
                    data: $('#frm-with-selected').serialize(),
                    success: function(result) {
                        if (result.is_success == 1) {
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Taskhub data is successfully deleted!",
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
                                title: 'An Error Occured',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    //location.reload();
                                }
                            });
                        }
                    },
                });
            }
        });
    }); 
});
</script>