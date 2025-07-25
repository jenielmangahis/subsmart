<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

<style>
    .nsm-card-title span {
        font-weight: bold;
        font-size: 18px;
    }
</style>
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
                            Add your social media links that will appear on your Public Profile page.
                        </div>
                    </div>
                </div>

                <?php echo form_open_multipart(null, ['id' => 'update_social_media', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <div>
                                            <span>Social Media Links</span>
                                            <label class="content-subtitle d-block">Note: All URLs have to start with
                                                http:// or
                                                https://</label>
                                        </div>
                                        <div>
                                            <div class="form-check form-switch"
                                                style="display: flex; align-items: center;gap: 10px;padding-left: 10px;">
                                                <input class="form-check-input m-0" name="is_show_links"
                                                    type="checkbox" value="1" <?php echo $profiledata && $profiledata->is_show_links == 1 ? 'checked' : ''; ?>>
                                                <label class="content-subtitle fw-bold d-block">Show this to public
                                                    page</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Facebook</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="color: #345191;"><i
                                                    class='bx bxl-facebook'></i></span>
                                            <input type="url" name="sm_facebook" class="nsm-field form-control"
                                                value="<?= isset($profiledata) ? $profiledata->sm_facebook : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Twitter</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="color: #2797d7;"><i
                                                    class='bx bxl-twitter'></i></span>
                                            <input type="url" name="sm_twitter" class="nsm-field form-control"
                                                value="<?= isset($profiledata) ? $profiledata->sm_twitter : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Google Review Page</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="color: #f13126;"><i
                                                    class='bx bxl-google'></i></span>
                                            <input type="url" name="sm_google" class="nsm-field form-control"
                                                value="<?= isset($profiledata) ? $profiledata->sm_google : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Youtube</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="color: #ff0000;"><i
                                                    class='bx bxl-youtube'></i></span>
                                            <input type="url" name="sm_youtube" class="nsm-field form-control"
                                                value="<?= isset($profiledata) ? $profiledata->sm_youtube : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="color: #bf249e;"><i
                                                    class='bx bxl-instagram'></i></span>
                                            <input type="url" name="sm_instagram" class="nsm-field form-control"
                                                value="<?= isset($profiledata) ? $profiledata->sm_instagram : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Pinterest</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="color: #c71f26;"><i
                                                    class='bx bxl-pinterest'></i></span>
                                            <input type="url" name="sm_pinterest" class="nsm-field form-control"
                                                value="<?= isset($profiledata) ? $profiledata->sm_pinterest : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">LinkedIn</label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="color: #0070ad;"><i
                                                    class='bx bxl-linkedin-square'></i></span>
                                            <input type="url" name="sm_linkedin" class="nsm-field form-control"
                                                value="<?= isset($profiledata) ? $profiledata->sm_linkedin : '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="nsm-button primary">Save Changes</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("submit", "#update_social_media", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "users/update_social_media";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            let formData = new FormData(_this[0]);


            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result.is_success == 1) {
                        Swal.fire({
                            title: 'Social Media',
                            text: "Social media links was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                //location.reload();
                            }
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }

                    _this.find("button[type=submit]").html("Save Changes");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
