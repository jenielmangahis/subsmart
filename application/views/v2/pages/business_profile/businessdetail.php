<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <?php echo form_open_multipart(null, [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3 mt-3 align-items-start">
                    <div class="col-12 col-md-12">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Profile Picture</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="nsm-img-upload circle m-auto" style="background-image: url('<?= businessProfileImage($profiledata->id); ?>');">
                                                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                                    <input type="file" name="image" id="company-logo" class="nsm-upload" accept="image/*">
                                                </div>
                                                <label class="content-subtitle text-muted w-100 text-center mt-4">Help your customers recognize your business by uploading a profile picture. Accepted files type: gif, jpg, png.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Basic Info</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Name <span class="nsm-text-error">*</span></label>
                                                <input type="text" placeholder="e.g. Acme Inc" name="business_name" class="nsm-field form-control" autocomplete="off" value="<?php echo ($profiledata) ? $profiledata->business_name : '' ?>" required />
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Street Address <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="address" id="address" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->address ?>" placeholder="e.g. 123 Old Oak Drive" required/>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Suite/Unit</label>
                                                <input type="text" name="unit_nbr" id="unit_nbr" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->unit_nbr ?>" placeholder="e.g. Ap #12" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">City <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="city" id="city" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->city ?>" placeholder="e.g. Phoenix" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Zip/Postal Code <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="zip" id="zip" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->zip ?>" placeholder="e.g. 86336" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">State/Province <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="state" id="state" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->state ?>" required/>
                                            </div>

                                            <div class="col-12 col-md-4 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Phone <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="business_phone" id="business_phone" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->business_phone ?>" required/>
                                                <label class="content-subtitle text-muted">We'll send you text/sms notifications to this number.</label>
                                            </div>

                                            <div class="col-12 col-md-4 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Office Phone <small class="text-muted">(optional)</small></label>
                                                <input type="text" name="office_phone" value="<?php echo $profiledata->office_phone ?>"  class="nsm-field form-control" autocomplete="off" placeholder="e.g 123 456 7890">
                                            </div>

                                            <div class="col-12 col-md-1 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Ext <small class="text-muted">(optional)</small></label>
                                                <input type="text" name="office_phone_extn" value="<?php echo $profiledata->office_phone_extn ?>" class="nsm-field form-control" autocomplete="off" placeholder="e.g. 123">
                                            </div>

                                            <div class="col-12 col-md-3 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Contact Person <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="contact_name" value="<?php echo $profiledata->contact_name ?>"  class="nsm-field form-control" autocomplete="off" placeholder="" required />
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">24/7 Emergency Phone Number <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="phone_emergency" value="<?php echo $profiledata->phone_emergency ?>"  class="nsm-field form-control" autocomplete="off" placeholder="e.g 123 456 7890" required="">
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Email <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="business_email" value="<?php echo $profiledata->business_email ?>"  class="nsm-field form-control" autocomplete="off" placeholder="Business Email" required="">
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Website <small class="text-muted">(optional)</small></label>
                                                <input type="text" name="website" value="<?php echo ($profiledata) ? $profiledata->website : '' ?>"  class="nsm-field form-control" autocomplete="off" placeholder="Enter your business website, if any">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>About</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-3">
                                                <label class="content-subtitle fw-bold d-block mb-2">Year of Establishment <span class="nsm-text-error">*</span></label>
                                                <input type="text" class="nsm-field form-control" name="year_est" value="<?= ($profiledata) ? $profiledata->year_est : '' ;?>" id="yrMybus">
                                                <label class="content-subtitle text-muted">Enter the year of company establishment.</label>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold d-block mb-2">Number of Employees <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="employee_count" value="<?php echo ($profiledata) ? $profiledata->employee_count : '' ?>"  class="nsm-field form-control" autocomplete="off" placeholder="e.g. 5" required="">
                                                <label class="content-subtitle text-muted">Enter the number of people working for you.</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Do you work with other Business or Sub Contract?</label>
                                                <div style="display:inline-block;width: 100px; margin-right: 10px;">
                                                  <input type="radio" class="" name="is_subcontract_allowed" value="1" <?php if($profiledata->is_subcontract_allowed==1){ ?> checked="checked" <?php } ?> id="is_subcontract_allowed_1">
                                                  <label for="is_subcontract_allowed_1"><span>Yes</span></label>
                                                </div>
                                                <div style="display:inline-block;width: 100px; margin-right: 10px;">
                                                  <input type="radio" class="" name="is_subcontract_allowed" value="0"  <?php if($profiledata->is_subcontract_allowed==0){ ?> checked="checked" <?php } ?> id="is_subcontract_allowed_2">
                                                  <label for="is_subcontract_allowed_2"><span>No</span></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Number (EIN #) <small class="text-muted">(optional)</small></label>
                                                <input type="text" name="business_number" value="<?php echo $profiledata->business_number; ?>"  class="nsm-field form-control" autocomplete="off">
                                            </div>
                                            <div class="col-12 col-md-6 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Service Location <small class="text-muted">(optional)</small></label>
                                                <input type="text" name="service_location" class="form-control" value="<?php echo $profiledata->service_location ?>"  class="nsm-field form-control" id="service_locations" data-role="tagsinput">
                                                <label class="content-subtitle text-muted">Enter the areas or neighborhoods where you provide your services.</label>
                                            </div>
                                            <div class="col-12 col-md-12 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Short Description <span class="help help-sm help-bold pull-right">characters left: <span class="char-counter-left">1962</span></span></label>
                                                <textarea name="business_desc" cols="40" rows="8" class="nsm-field form-control businessdetail-desc" autocomplete="off"><?php echo ($profiledata) ? $profiledata->business_desc: ''; ?> </textarea>
                                                <label class="content-subtitle text-muted">Give customers more details on what your business actually does. Describe your company's values and goals. Minimum 25 characters.</label>
                                            </div>
                                            <div class="col-12 col-md-12 mt-5 text-end">
                                                <button class="nsm-button primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        function descriptionCharCounter(){
            var chars_max   = 1962;
            var chars_total = $(".businessdetail-desc").val().length;
            var chars_left  = chars_max - chars_total;

            $(".char-counter-left").html(chars_left);

            return chars_left;
       }

       $(".businessdetail-desc").keydown(function(e){
            var chars_left = descriptionCharCounter();
            if( chars_left <= 0 ){
                if (e.keyCode != 46 && e.keyCode != 8 ) return false;
            }else{
                return true;
            }
       });

       descriptionCharCounter();

       $(document).on("submit", "#form-business-details", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "/user/_update_business_details";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            var data = new FormData(this);
            data.append('image', $('#company-logo')[0].files[0]);

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                enctype: 'multipart/form-data',
                processData: false,  // Important!
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Business profile was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>