<script type="text/javascript">
$(function(){   
    $(".nsm-table").nsmPagination();
    $("#search_field").on("input", debounce(function() {
        let search = $(this).val();
        if( search == '' ){
            $(".nsm-table").nsmPagination();
            $("#roles-table").find("tbody .nsm-noresult").remove();
        }else{
            tableSearch($(this));        
        }
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('#roles-table input[name="roles[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#roles-table input[name="roles[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('click', '.btn-row-edit', function(){
        const job_title_id = $(this).attr('data-id');
        const job_title = $(this).attr('data-title');

        $('#jtid').val(job_title_id);
        $('#edit-job-title').val(job_title);
        $('#modal-edit-job-title').modal('show');
    });

    $(document).on('click', '.btn-row-delete', function(){
        const job_title_id = $(this).attr('data-id');
        const job_title = $(this).attr('data-title');

        Swal.fire({
            title: 'Delete Job Title',
            html: `Are you sure you want to delete job title <b>${job_title}</b>?<br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "users/_delete_job_title",
                    data: {
                        job_title_id: job_title_id
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Job Title',
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

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#roles-table input[name="roles[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Job Title',
                html: `Are you sure you want to delete selected rows?<br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_delete_selected_job_titles',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Job Title',
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

    $('#frm-add-job-title').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "users/_save_job_title",
            dataType: 'json',
            data: $('#frm-add-job-title').serialize(),
            success: function(data) {    
                $('#btn-save-job-title').html('Save');                   
                if (data.is_success) {
                    $('#modal-add-new-job-title').modal('hide');
                    Swal.fire({
                        title: 'Add Job Title',
                        text: "New job title has been added successfully.",
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
                $('#btn-save-job-title').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-update-job-title').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "users/_update_job_title",
            dataType: 'json',
            data: $('#frm-update-job-title').serialize(),
            success: function(data) {    
                $('#btn-update-job-title').html('Save');                   
                if (data.is_success) {
                    $('#modal-edit-job-title').modal('hide');
                    Swal.fire({
                        title: 'Edit Job Title',
                        text: "Job title has been updated successfully.",
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
                $('#btn-update-job-title').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>