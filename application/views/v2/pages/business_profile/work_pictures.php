<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#add_image_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Add photos to spotlight features of your business or past projects pictures.
                        </div>
                    </div>
                </div>
                <?php if( checkRoleCanAccessModule('company-my-portfolio', 'write') ){ ?>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#add_image_modal">
                                <i class='bx bx-plus' ></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row g-3">
                    <?php
                    $images = array();
                    if ($profiledata->work_images != '') {
                        $images = unserialize($profiledata->work_images);
                    }
                    ?>
                    <?php if ($images) { ?>
                        <?php foreach ($images as $key => $i) { ?>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card p-0 workspace-item">
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <div class="col-12 thumbnail-header">
                                                <div class="nsm-card-thumbnail" style="background-image: url('<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>')"></div>
                                            </div>
                                            <div class="col-12 text-center p-3">
                                                <div class="nsm-card-title mb-2">
                                                    <span><?= $i['caption']; ?></span>
                                                </div>
                                                <?php if( checkRoleCanAccessModule('company-my-portfolio', 'write') ){ ?>
                                                <button class="nsm-button btn-sm btn-edit" data-caption="<?= $i['caption']; ?>" data-id="<?= $key; ?>"><i class='bx bx-edit'></i> Edit</button>
                                                <?php } ?>
                                                <button class="nsm-button btn-sm" data-fancybox data-src="<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>"><i class='bx bx-zoom-in'></i> Zoom</button>
                                                <?php if( checkRoleCanAccessModule('company-my-portfolio', 'delete') ){ ?>
                                                <button class="nsm-button btn-sm btn-delete" data-name="<?= $i['file']; ?>" data-id="<?= $key; ?>"><i class='bx bx-trash'></i> Delete</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".btn-edit", function() {
            let id = $(this).attr("data-id");
            let caption = $(this).attr("data-caption");

            $("#caption_image_key").val(id);
            $("#image_caption").val(caption);

            $("#edit_image_caption_modal").modal("show");
        });

        $(document).on("submit", "#form-edit-image-caption", function(e) {            
            e.preventDefault();            
            let _this = $(this);
            
            $.ajax({
                type: 'POST',
                url: base_url + 'users/_update_work_image_caption',
                data: _this.serialize(),
                dataType: "json",
                success: function(result) {
                    $('#btn-update-image-caption').html("Saving");
                    $('#btn-update-image-caption').prop("disabled", true);
                    Swal.fire({
                        title: 'My Business Portfolio',
                        text: "Image caption was successfully updated",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });

                    $("#edit_image_caption_modal").modal("hide");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
                beforeSend: function(){
                    $('#btn-update-image-caption').html('<span class="bx bx-loader bx-spin"></span>');
                    $('#btn-update-image-caption').prop("disabled", true);
                }
            });
        });

        $(document).on("click", ".btn-delete", function() {
            let _this = $(this);
            let id = $(this).attr('data-id');
            let name = $(this).attr("data-name");

            Swal.fire({
                title: 'Delete Image',
                text: "Are you sure you want delete the selected image?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('users/_delete_work_picture'); ?>",
                        data: {
                            image_name: name,
                            image_key: id
                        },
                        success: function(result) {
                            _this.closest(".col-md-3").fadeOut(500, function(){
                                _this.closest(".col-md-3").remove();
                            });
                            Swal.fire({
                                title: 'My Business Portfolio',
                                text: "Image is deleted successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });

        $(document).on("submit", "#add_work_picture_form", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "user/_upload_portfolio_image";            
            let formData = new FormData(_this[0]);   

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                dataType:'json',
                success: function(data) {
                    $('#btn-portfolio-add-image').html("Save");
                    $('#btn-portfolio-add-image').prop("disabled", false);

                    if (data.is_success) {
                        $("#add_image_modal").modal("hide");
                        Swal.fire({
                            title: 'My Business Portfolio',
                            text: "Photo was uploaded successfully.",
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
                beforeSend: function(){
                    $('#btn-portfolio-add-image').html('<span class="bx bx-loader bx-spin"></span>');
                    $('#btn-portfolio-add-image').prop("disabled", true);
                },
                error: function(result){
                    
                }
            });
        });

        $('#work-picture').on('change', function(e) {
            e.preventDefault();
            let _parent = $(this).closest(".nsm-img-upload");
            let reader = new FileReader();

            if ($(this)[0].files[0]) {
                reader.readAsDataURL($(this)[0].files[0]);
                reader.onload = function() {
                    let imgPreview = _parent;
                    imgPreview.css("background-image", "url('" + reader.result + "')");
                };
            } 

        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>