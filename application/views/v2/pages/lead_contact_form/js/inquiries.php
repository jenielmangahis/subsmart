<script>
$(function(){
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