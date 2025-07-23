<script>
$(function(){
    $(".nsm-table").nsmPagination();
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('input[name="inquiries[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('input[name="inquiries[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('click', '#with-selected-convert-leads', function(){
        let total= $('input[name="inquiries[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Convert to Lead',
                html: "Are you sure you want to <b>convert to lead</b> all selected rows?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'lead_contact_form/inquiries/_with_selected_convert_to_lead',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Convert to Lead',
                                    text: "Inquiries was successfully converted to leads!",
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

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('input[name="inquiries[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Inquiry',
                html: "Are you sure you want to <b>delete</b> all selected rows?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'lead_contact_form/inquiries/_with_selected_delete',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Inquiry',
                                    html: "Inquiries was successfully deleted",
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

    $(document).on('click', '.btn-view-inquiry', function(){
        let inquiry_id = $(this).attr('data-id');

        $('#modal-view-inquiry').modal('show');

        $.ajax({
            type: 'POST',
            url: base_url + 'lead_contact_form/inquiries/_view_inquiry',
            data: {inquiry_id: inquiry_id},
            success: function(html) {
                $('#view-inquiry-container').html(html);
            },
            beforeSend: function() {
                $('#view-inquiry-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '.btn-convert-to-lead', function(){
        let inquiry_id = $(this).attr('data-id'); 
        let lead_name  = $(this).attr('data-name');
        Swal.fire({
            title: 'Convert to Lead',
            html: `Are you sure you want to convert to lead <b>${lead_name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'lead_contact_form/inquiries/_convert_to_lead',
                    data: {
                        inquiry_id: inquiry_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Convert to Lead',
                                html: "Inquiry was successfully converted to leads",
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

    $(document).on('click', '.btn-delete-inquiry', function(){
        let inquiry_id = $(this).attr('data-id'); 
        let lead_name  = $(this).attr('data-name');
        Swal.fire({
            title: 'Delete Inquiry',
            html: `Are you sure you want to delete inquiry from <b>${lead_name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'lead_contact_form/inquiries/_delete',
                    data: {
                        inquiry_id: inquiry_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Inquiry',
                                html: "Inquiry was successfully deleted",
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
    
});
</script>