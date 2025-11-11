<hr />
<div class="d-block mb-4 mt-4">
    <span style="font-size:18px; font-weight:bold;">Payment Images</span>
</div>
<div class="mt-4 mb-4" id="img-payment-methods"></div>
<script>
$(function(){
    <?php if( isAdmin() ){ ?>
    load_customer_payment_method_images();

    $('#btn-billing-upload-payment-method').on('click', function(){
        $('#modal-admin-upload-image').modal('show');
    });

    $(document).on('click', '.btn-delete-payment-image', function(){
        let file_id = $(this).attr('data-id');
        let file_name = $(this).attr('data-name');
        
        Swal.fire({
            title: 'Delete Payment Image',
            html: `Are you sure you want to delete selected image?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'customer/_delete_payment_image',
                    dataType: 'json',
                    data: {
                        cdi: file_id
                    },
                    success: function(o) {
                        if (o.is_success == 1) {
                            load_customer_payment_method_images();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: o.msg
                            });
                        }
                    },
                });
            }
        });
    });

    $('#frm-admin-upload-image').on('submit', function(){
        event.preventDefault(); // Prevent default form submission

        let customer_id = "<?= $customer_id; ?>";
        let fileInput = $('#admin-image')[0];
        let files = fileInput.files;

        if (files.length > 0) {
            let url = base_url + 'customer/_upload_payment_method_image';
            let formData = new FormData();
            formData.append('admin_image', files[0]); 
            formData.append('customer_id', customer_id);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false, 
                dataType:'json',
                success: function(response) {
                    $('#modal-admin-upload-image').modal('hide');
                    if( response.is_success == 1 ) {
                        Swal.fire({
                            title: 'Payment Details',
                            text: "Data was successfully saved!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                load_customer_payment_method_images()
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
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error uploading file: ' + textStatus,
                    });
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
        } else {
            alert('Please select a file to upload.');
        }
    });

    function load_customer_payment_method_images(){
        let customer_id = "<?= $cus_id; ?>";
        let url = base_url + 'customer/_payment_method_images';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                customer_id: customer_id
            },
            success: function(html) {
                $('#img-payment-methods').html(html);
            },
            beforeSend: function(){
                $('#img-payment-methods').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }
    <?php } ?>
});
</script>