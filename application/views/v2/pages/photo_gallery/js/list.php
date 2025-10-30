<script type="text/javascript">
$(function(){ 
    
    $('#search_photos').keyup(function(){
        var sSearch = this.value;
        sSearch = sSearch.split(" ");

        $('.photo-gallery-container').hide();
        $.each(sSearch, function(i){
            $('.photo-gallery-container:contains("' + sSearch[i] + '")').show();
        });
    });

    $('#btn-add-photo').on('click', function(){
        $('#modal-add-photo').modal('show');
    });

    $('#add-more-photo-rows').on('click', function(){
        var container = $('#add-photo-container');
        var html = `<div class="input-group mb-3 row-photo-attachment">
            <input type="file" name="photos[]" class="form-control input-photo" /> 
            <button type="button" class="nsm-button default btn-small float-end btn-photo-delete-row"><i class='bx bx-trash' ></i></button>                     
        </div>`;
        container.append(html);
    });

    $(document).on('click', '.btn-photo-delete-row', function(){
        $(this).closest('.row-photo-attachment').remove();
    });

    $(document).on('click', '.btn-edit-caption', function(){
        var photo_id = $(this).attr('data-id');
        var caption  = $(this).attr('data-caption');

        $('#edit-photo-id').val(photo_id);
        $('#edit-photo-caption').val(caption);
        $('#modal-edit-caption').modal('show');
    });

    $('#frm-add-photo').on('submit', function(e){
        e.preventDefault();

        var url = base_url + 'photo_gallery/_upload_images';
        var formData = new FormData();

        $('.input-photo').each(function() {
            if (this.files[0]) { // Check if a file is selected
                formData.append('photos[]', this.files[0]);
            }
        });

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false,
            dataType:'json',
            success: function(response) {                
                if (response.is_success) {
                    Swal.fire({
                        title: 'Add Photos',
                        text: "Images has been uploaded successfully.",
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
            error: function(xhr, status, error) {
                
            },
            beforeSend: function(){
                $('#modal-add-photo').modal('hide');
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
    });

    $('#frm-update-photo-caption').on('submit', function(e){
        e.preventDefault();

        var url = base_url + 'photo_gallery/_update_caption';

        $.ajax({
            url: url,
            type: 'POST',
            data: $('#frm-update-photo-caption').serialize(),
            dataType:'json',
            success: function(response) {                
                if (response.is_success) {
                    Swal.fire({
                        title: 'Edit Caption',
                        text: "Image caption was successfully updated.",
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
            error: function(xhr, status, error) {
                
            },
            beforeSend: function(){
                $('#modal-edit-caption').modal('hide');
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
    });

    $(document).on('click', '.btn-delete-photo', function(){
        var photo_id   = $(this).attr('data-id');
        var photo_caption = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Photo',
            html: `Are you sure you want to delete selected photo? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'photo_gallery/_delete_photo',
                    data: {
                        photo_id: photo_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Photo',
                                html: "Photo deleted successfully!",
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