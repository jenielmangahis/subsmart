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
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#add_image_modal">
                                <i class='bx bx-fw bx-image-add'></i> Upload Image
                            </button>
                        </div>
                    </div>
                </div>
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
                                <div class="nsm-card p-0 workspace-item" role="button">
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <div class="col-12 thumbnail-header">
                                                <div class="nsm-card-thumbnail" style="background-image: url('<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>')"></div>
                                            </div>
                                            <div class="col-12 text-center p-3">
                                                <div class="nsm-card-title mb-2">
                                                    <span><?= $i['caption']; ?></span>
                                                </div>
                                                <button class="nsm-button btn-sm btn-edit" data-caption="<?= $i['caption']; ?>" data-id="<?= $key; ?>"><i class='bx bx-edit'></i> Edit</button>
                                                <button class="nsm-button btn-sm" data-fancybox data-src="<?= url("uploads/work_pictures/" . $profiledata->company_id . "/" . $i['file']); ?>"><i class='bx bx-zoom-in'></i> Zoom</button>
                                                <button class="nsm-button btn-sm btn-delete" data-name="<?= $i['file']; ?>" data-id="<?= $key; ?>"><i class='bx bx-trash'></i> Delete</button>
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
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('users/_update_work_image_caption'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: "json",
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Image caption was successfully updated",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    _this.trigger("reset");
                    $("#edit_image_caption_modal").modal("hide");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".btn-delete", function() {
            let _this = $(this);
            let id = $(this).attr('data-id');
            let name = $(this).attr("data-name");

            Swal.fire({
                title: 'Deleting Picture',
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
                                title: 'Success',
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

            var url = "<?php echo base_url('users/upload_work_picture_v2'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);
            let formData = new FormData(_this[0]);   

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function(result) {
                    console.log(result);
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "New image was added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    _this.trigger("reset");
                    $("#add_image_modal").modal("hide");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>