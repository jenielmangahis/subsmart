<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

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
                            Your settings let you control how the business profile is shown to customers. Take a quick look and make sure all of your settings are correct.
                        </div>
                    </div>
                </div>

                <?php echo form_open_multipart(null, ['id' => 'update_business_details', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Your Business Profile URL</span>
                                    <label class="content-subtitle d-block">Your company profile URL Slug</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-1">
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">
                                            Name
                                            <a href="<?= base_url('business/' . $profiledata->profile_slug); ?>" class="nsm-button btn-small pull-right" target="_new" style="margin-bottom:3px;">View Profile</a>
                                        </label>
                                        <input type="text" class="nsm-field form-control" required value="<?= isset($profiledata) ? $profiledata->profile_slug : '';  ?>" disabled="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Business Tags</span>
                                    <label class="content-subtitle d-block">Enter tags/keywords and get better visibility. This helps customers find you on search. Example: cleaner, plumber</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-1">
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
                                        <input type="text" class="nsm-field form-control" name="company_tags" data-role="tagsinput" value="<?= isset($profiledata) ? $profiledata->business_tags : ''; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Cover Picture</span>
                                    <label class="content-subtitle d-block">Add a cover photo to showcase your Business Profile page's personality.&nbsp;Your cover picture is the large photo featured at the top of your public profile.</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="nsm-img-upload" style="background-image: url('<?= getCompanyCoverPhoto($company_id); ?>')">                                            
                                            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                            <input type="file" name="cover_photo" class="nsm-upload" accept="image/*">
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
        $(document).on("submit", "#update_business_details", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "users/update_profile_setting";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            let formData = new FormData(_this[0]);   

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType:'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(result) {
                    if( result.is_success == 1 ){
                        Swal.fire({
                            title: 'Profile Setting',
                            text: "Setting was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                //location.reload();
                            }
                        });

                    }else{
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