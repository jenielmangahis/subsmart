<?php include viewPath('v2/includes/header'); ?>
<!-- include viewPath('v2/includes/business/business_modals'); ?> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<style>
.w9pdf-filepath {
    font-weight: 700;
    font-size: 17px;
    color: #545454;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <?php echo form_open_multipart(null, ['id' => 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']); ?>
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3 mt-3 align-items-start">
                    <div class="col-12 col-md-12">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Profile Picture <span id="help-popover-business-logo" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span></span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <input type="hidden" name="id" value="<?php echo $profiledata->id; ?>">
                                            <div class="col-12">
                                                <div class="nsm-img-upload circle m-auto" id="basic-image-container"
                                                    style="background-image:url('<?php echo getCompanyBusinessProfileImage(); ?>');background-size:contain;">
                                                    <span class="nsm-upload-label disable-select">Drop or click image to
                                                        upload</span>
                                                    <input type="file" id="image-input" name="image"
                                                        class="nsm-upload" accept="image/*">
                                                </div>

                                                <div id="image-preview-container"
                                                    style="display: none; width: 100%; height: 500px; ">
                                                    <img id="image-preview"
                                                        style="max-width: 100%; max-height: 100%; display: block; margin: auto;" />
                                                </div>
                                                <div id="image-preview-buttons"
                                                    class="align-items-center justify-content-center"
                                                    style="display:none ;">
                                                    <button type="button" id="cancel-crop"
                                                        class="nsm-button  mt-3">Cancel</button>
                                                    <button type="button" id="apply-crop"
                                                        class="nsm-button primary mt-3">Apply Crop</button>
                                                </div>
                                                <div id="image-preview-change"
                                                    class="align-items-center justify-content-center"
                                                    style="display:none ;">
                                                    <button type="button" id="reset-image"
                                                        class="nsm-button  mt-3">Reset Image</button>
                                                    <button type="button" id="change-image"
                                                        class="nsm-button primary  mt-3">Change Image</button>
                                                </div>
                                                <div id="crop-action-button"
                                                    class="mt-3 align-items-center justify-content-center"
                                                    style="display:none;">
                                                    <button type="button" id="crop-image" class="nsm-button ">Crop
                                                        Image</button>
                                                </div>
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
                                        <div class="nsm-card-controls align-items-baseline">
                                            <button type="button" class="nsm-button btn-sm primary" id="btn-w9-form">
                                                <i class='bx bx-fw bxs-file-pdf'></i> W-9 Form
                                            </button>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Name <span
                                                        class="nsm-text-error">*</span></label>
                                                <input type="text" placeholder="e.g. Acme Inc" name="business_name"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    value="<?php echo $profiledata ? $profiledata->business_name : ''; ?>" required />
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Street
                                                    Address <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="address" id="address"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    value="<?php echo $profiledata->address; ?>" placeholder="e.g. 123 Old Oak Drive"
                                                    required />
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Suite/Unit</label>
                                                <input type="text" name="unit_nbr" id="unit_nbr"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    value="<?php echo $profiledata->unit_nbr; ?>" placeholder="e.g. Ap #12" />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">City <span
                                                        class="nsm-text-error">*</span></label>
                                                <input type="text" name="city" id="city"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    value="<?php echo $profiledata->city; ?>" placeholder="e.g. Phoenix" required />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Zip/Postal Code
                                                    <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="zip" id="zip"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    value="<?php echo $profiledata->zip; ?>" placeholder="e.g. 86336" required />
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">State/Province
                                                    <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="state" id="state"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    value="<?php echo $profiledata->state; ?>" required />
                                            </div>

                                            <div class="col-12 col-md-4 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Phone
                                                    <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="business_phone" id="business_phone"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    value="<?php echo $profiledata->business_phone; ?>" required />
                                            </div>

                                            <div class="col-12 col-md-4 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Office Phone
                                                    <small class="text-muted">(optional)</small></label>
                                                <input type="text" name="office_phone"
                                                    value="<?php echo $profiledata->office_phone; ?>" class="nsm-field form-control"
                                                    autocomplete="off" placeholder="e.g 123 456 7890">
                                            </div>

                                            <div class="col-12 col-md-1 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Ext <small
                                                        class="text-muted">(optional)</small></label>
                                                <input type="text" name="office_phone_extn"
                                                    value="<?php echo $profiledata->office_phone_extn; ?>" class="nsm-field form-control"
                                                    autocomplete="off" placeholder="e.g. 123">
                                            </div>

                                            <div class="col-12 col-md-3 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Contact Person
                                                    <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="contact_name"
                                                    value="<?php echo $profiledata->contact_name; ?>" class="nsm-field form-control"
                                                    autocomplete="off" placeholder="" required />
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">24/7 Emergency
                                                    Phone Number <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="phone_emergency"
                                                    value="<?php echo $profiledata->phone_emergency; ?>" class="nsm-field form-control"
                                                    autocomplete="off" placeholder="e.g 123 456 7890" required="">
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Email
                                                    <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="business_email"
                                                    value="<?php echo $profiledata->business_email; ?>" class="nsm-field form-control"
                                                    autocomplete="off" placeholder="Business Email" required="">
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Website
                                                    <small class="text-muted">(optional)</small></label>
                                                <input type="text" name="website" value="<?php echo $profiledata ? $profiledata->website : ''; ?>"
                                                    class="nsm-field form-control" autocomplete="off"
                                                    placeholder="Enter your business website, if any">
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
                                        <div class="row">
                                            <div class="col-12 col-md-8 col-sm-12">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Year of
                                                            Establishment <span class="nsm-text-error">*</span> <span id="help-popover-year-establishment" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span></label>
                                                        <input type="text" class="nsm-field form-control" name="year_est"
                                                            value="<?= $profiledata ? $profiledata->year_est : '' ?>"
                                                            id="yrMybus">
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Number of
                                                            Employees <span class="nsm-text-error">*</span><span id="help-popover-num-employees" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span></label>
                                                        <input type="text" name="employee_count"
                                                            value="<?php echo $profiledata ? $profiledata->employee_count : ''; ?>" class="nsm-field form-control"
                                                            autocomplete="off" placeholder="e.g. 5" required="">                                                
                                                    </div>           
                                                    <div class="col-12 col-md-4">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Business Type</label>
                                                        <select class="form-control form-select" id="business_type" name="business_type" required="">
                                                            <?php foreach($optionBusinessType as $type){ ?>
                                                                <option <?= $profiledata && $profiledata->business_type == $type ? 'selected="selected"' : ''; ?> value="<?= $type; ?>"><?= $type; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                 
                                                </div>
                                                <div class="row g-3">                                                    
                                                    <div class="col-12 col-md-3 mt-5">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Employer Identification Number <small class="text-muted">(optional)</small></label>
                                                        <input type="text" name="EIN" id="ein" value="<?php echo $profiledata->EIN; ?>" class="nsm-field form-control" autocomplete="off">
                                                    </div>
                                                    <div class="col-12 col-md-3 mt-5">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Social Security Number <small class="text-muted">(optional)</small></label>
                                                        <input type="text" name="ssn" id="ssn" value="<?php echo $profiledata->ssn; ?>" class="nsm-field form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6 mt-5">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Service Location
                                                            <small class="text-muted">(optional)</small> <span id="help-popover-service-location" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span></label>
                                                        <input type="text" name="service_location" class="form-control"
                                                            value="<?php echo $profiledata->service_location; ?>" class="nsm-field form-control"
                                                            id="service_locations" data-role="tagsinput">
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <label class="content-subtitle fw-bold d-block mb-2">Do you work with
                                                            other Business or Sub Contract?</label>
                                                        <div style="display:inline-block;width: 100px; margin-right: 10px;">
                                                            <input type="radio" class=""
                                                                name="is_subcontract_allowed" value="1"
                                                                <?php if($profiledata->is_subcontract_allowed==1){ ?> checked="checked" <?php } ?>
                                                                id="is_subcontract_allowed_1">
                                                            <label for="is_subcontract_allowed_1"><span>Yes</span></label>
                                                        </div>
                                                        <div style="display:inline-block;width: 100px; margin-right: 10px;">
                                                            <input type="radio" class=""
                                                                name="is_subcontract_allowed" value="0"
                                                                <?php if($profiledata->is_subcontract_allowed==0){ ?> checked="checked" <?php } ?>
                                                                id="is_subcontract_allowed_2">
                                                            <label for="is_subcontract_allowed_2"><span>No</span></label>
                                                        </div>
                                                    </div>                                                    
                                                </div>   
                                            </div>
                                            <div class="col-12 col-md-4 col-sm-12">
                                                <div class="d-flex justify-content-evenly align-items-center flex-column h-100">
                                                    <img src="" id="profile_signature" alt="Signature">
                                                    <label class="content-subtitle mt-3 d-block">This is the electronic representation of owner signature, update any time.</label>
                                                    <button name="btn_create_signature" type="button" class="nsm-button custom-prof-btn primary" data-bs-toggle="modal" data-bs-target="#register_signature_modal">
                                                        <i class='bx bx-fw bx-pen'></i> Digital Signature
                                                    </button>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="row g-3 mt-4">
                                            <div class="col-12 col-md-12 mt-5">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Short
                                                    Description <span id="help-popover-business-description" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span> <span
                                                        class="help help-sm help-bold pull-right">characters left:
                                                        <span class="char-counter-left">1962</span></span></label>
                                                <textarea name="business_desc" cols="40" rows="8" class="nsm-field form-control businessdetail-desc"
                                                    autocomplete="off"><?php echo $profiledata ? $profiledata->business_desc : ''; ?> </textarea>
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

    <div class="modal fade nsm-modal fade" id="register_signature_modal" tabindex="-1" aria-labelledby="register_signature_label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <?php echo form_open_multipart('', ['id' => 'form-signature', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Register Signature</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="sign_area">
                                <canvas id="canvas-a" class="nsm-sign-canvas"></canvas>
                                <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" value="Company Representative" />
                                <input type="hidden" id="saveUserSignatureDB1aMb" name="user_approval_signature1aM">
                                <input type="hidden" id="saveUserSignatureDB1aM_web" name="user_approval_signature1aM_web">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_clear" class="nsm-button" id="btn_clear_signature">Clear</button>
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_save" class="nsm-button primary">Save Signature</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script src="<?php echo $url->assets ?>js/jquery.maskedinput.js"></script>

<?php include viewPath('v2/includes/footer'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        
        let cropper;
        const imageInput = $("#image-input");
        const imagePreviewContainer = $("#image-preview-container");
        const imagePreviewButtons = $("#image-preview-buttons");
        const imagePreviewChange = $("#image-preview-change");
        const cropActionButton = $("#crop-action-button");

        const imagePreview = $("#image-preview");
        const imagePrevCrop = $("#image-prev-crop");

        const applyCropButton = $("#apply-crop");
        const basicContainer = $("#basic-image-container");
        const cropImageContainer = $("#crop-image-container");

        $("#ssn").mask("999-99-9999");
        $("#ein").mask("99-9999999");

        $('#help-popover-business-logo').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Help your customers recognize your business by uploading a profile picture. Accepted files type: gif, jpg, png.';
            }
        });

        $('#help-popover-year-establishment').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'How long your business has been operating since its founding.';
            }
        });

        $('#help-popover-num-employees').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Number of people working for you.';
            }
        });

        $('#help-popover-service-location').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Areas or neighborhoods where you provide your services.';
            }
        });

        $('#help-popover-business-description').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return `Give customers more details on what your business actually does. Describe your company's values and goals. Minimum 25 characters.`;
            }
        });

        let triggerChange = false

        $('#btn-w9-form').on('click', function(){
            //let url = base_url + 'uploads/irsw9/fw9.pdf';
            let url = base_url + 'company/download_w9_form';
            window.open(url, '_blank').focus();
        });

        var signaturePad;
        jQuery(document).ready(function() {
            var signaturePadCanvas = document.querySelector('#canvas-a');
            signaturePad = new SignaturePad(signaturePadCanvas);

            signaturePadCanvas.width = 680;
            signaturePadCanvas.height = 300;
        });

        $("#btn_clear_signature").on("click", function() {
            $("#sign_area").signaturePad().clearCanvas();
        });

        $(document).on('click touchstart', '#canvas-a', function() {
            var canvas_web = document.getElementById("canvas-a");
            var dataURL = canvas_web.toDataURL("image/png");
            $("#saveUserSignatureDB1aMb").val(dataURL);
        });

        $(document).on("submit", "#form-signature", function(e) {
            let _this = $(this);
            let first = $("#saveUserSignatureDB1aMb").val();
            $("#saveUserSignatureDB1aM_web").val(first);
            e.preventDefault();
            
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: base_url + 'company/_update_company_signature',
                dataType: "html",
                data: _this.serialize(),
                success: function(result) {
                    $("#profile_signature").attr("src", first);
                    Swal.fire({
                        title: 'Digital Signature',
                        text: "Company signature was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });

                    $("#register_signature_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on('change','#image-input', function(e) {
            e.preventDefault();
            cropActionButton.show().addClass('d-flex');
            let _parent = $(this).closest(".nsm-img-upload");
            let reader = new FileReader();



            if ($(this)[0].files[0]) {
                reader.readAsDataURL($(this)[0].files[0]);
                reader.onload = function() {
                    let imgPreview = _parent;
                    imgPreview.css("background-image", "url('" + reader.result + "')");
                    imagePreviewChange.hide().removeClass('d-flex');

                    if (triggerChange) {
                        basicContainer.show();
                        imagePreviewContainer.hide();
                    }


                };
            } else {
                cropActionButton.hide().removeClass('d-flex');
            }

        });




        $('#cancel-crop').on('click', function(e) {
            e.preventDefault();
            cropActionButton.hide().removeClass('d-flex');
            cropper.destroy();
            basicContainer.show();
            imagePreviewContainer.hide();
            imagePreviewButtons.hide().removeClass('d-flex');
            cropActionButton.show().addClass('d-flex');
        });




        $('#crop-image').on('click', function(e) {

            e.preventDefault();


            const file = imageInput[0].files[0];
            console.log('file', file);

            if (file) {
                cropActionButton.hide().removeClass('d-flex');
                basicContainer.hide();
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.attr('src', event.target.result);
                    imagePreviewContainer.show();
                    imagePreviewButtons.show().addClass('d-flex');

                    applyCropButton.show();


                    cropper = new Cropper(imagePreview[0], {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: "move",
                        preview: ".img-preview",
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        $('#reset-image').on('click', function(e) {
            // $('#image-input').trigger('click');
            imagePreviewContainer.hide();
            imagePreviewChange.hide().removeClass('d-flex');
            basicContainer.show();

            const file = imageInput[0].files[0]
            if (file) {
                cropActionButton.show().addClass('d-flex');

            }
        });

        $('#change-image').on('click', function(e) {
            imageInput.trigger('click');
            triggerChange = true;


        });



        $('#apply-crop').on('click', function(e) {
            e.preventDefault();

            if (cropper) {
                cropper.getCroppedCanvas().toBlob(function(blob) {
                    const croppedFile = new File([blob], "cropped-image.png", {
                        type: 'image/png'
                    });

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    imageInput[0].files = dataTransfer.files;

                    const croppedImageURL = URL.createObjectURL(blob);
                    imagePreview.attr('src', croppedImageURL);

                    imagePreview.addClass('crop-image-container');
                    imagePreviewContainer.css('height', 'unset');


                    imagePreviewButtons.hide().removeClass('d-flex');
                    imagePreviewChange.show().addClass('d-flex');
                    cropper.destroy();
                    basicContainer.hide();
                });
            } else {
                Swal.fire({
                    title: 'Crop Error',
                    text: 'No cropper instance found. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'Okay',
                });
            }
        });




        function descriptionCharCounter() {
            var chars_max = 1962;
            var chars_total = $(".businessdetail-desc").val().length;
            var chars_left = chars_max - chars_total;

            $(".char-counter-left").html(chars_left);

            return chars_left;
        }

        $(".businessdetail-desc").keydown(function(e) {
            var chars_left = descriptionCharCounter();
            if (chars_left <= 0) {
                if (e.keyCode != 46 && e.keyCode != 8) return false;
            } else {
                return true;
            }
        });

        descriptionCharCounter();

        $(document).on("submit", "#form-business-details",async function(e) {
            e.preventDefault();
            let _this = $(this);
           
            let formData = new FormData(this);

            const croppedImageSrc = $("#image-preview").attr("src");

            if (croppedImageSrc && croppedImageSrc.startsWith("blob:")) {
                try {
                    const response = await fetch(croppedImageSrc);
                    const blob = await response.blob();

                    formData.append("cropped_image", blob, "cropped-image.png");
                } catch (error) {
                    console.error("Failed to fetch blob from cropped image:", error);
                    Swal.fire({
                        title: "Error",
                        text: "Failed to process the cropped image. Please try again.",
                        icon: "error",
                        confirmButtonText: "Okay",
                    });
                    return;
                }
            }

            let url = "<?php echo base_url('users/updateBusinessDetailsInfo'); ?>";
            _this.find("button[type=submit]").html("Saving").prop("disabled", true);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Business profile was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        location.reload();
                    });
                    $("#edit_basic_info_modal").modal("hide");
                    _this.trigger("reset");
                    _this.find("button[type=submit]").html("Save").prop("disabled",
                        false);
                },
                error: function(err) {
                    console.error("Upload failed:", err);
                    _this.find("button[type=submit]").html("Save").prop("disabled",
                        false);
                },
            });
         
        });
    });
</script>