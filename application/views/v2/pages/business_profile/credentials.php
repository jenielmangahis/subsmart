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
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            <label class="content-subtitle fw-bold d-block">Showcase Your Business Credentials</label>
                            Pick from the sections below if your business is Licensed/Bonded/Insured/BBB. Adding your
                            professional Credentials will help you attract more customers.
                        </div>
                    </div>
                </div>
                
                <?php if( checkRoleCanAccessModule('company-my-credentials', 'write') ){ ?>
                <?php echo form_open_multipart(null, ['id' => 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="action" value="credentials" />
                <?php } ?>
                <div class="row g-3">
                    <div class="col-md-6 d-flex justify-content-between">
                        <div>
                            <?php
                            $licensed_checked = '';
                            if ($profiledata->is_licensed == 1) {
                                $licensed_checked = "checked='checked'";
                            }
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_licensed" id="checkbox_license"
                                    <?= $licensed_checked ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>>
                                <label class="form-check-label fw-bold" for="checkbox_license">Licensed</label>
                            </div>
                            <label class="content-subtitle" id="license_placeholder"
                                <?= $profiledata->is_licensed == 1 ? 'style="display:none;"' : '' ?>>Not licensed.
                                Select to activate.</label>
                        </div>
                        <div>
                            <div class="form-check form-switch"
                                style="display: flex; align-items: center;gap: 10px;padding-left: 10px;">
                                <input class="form-check-input m-0" name="is_show_licensed" type="checkbox"
                                    value="1" <?php echo $profiledata && $profiledata->is_show_licensed == 1 ? 'checked' : ''; ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>>
                                <label class="content-subtitle fw-bold d-block">Show Licensed To Public Page</label>


                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="license_details"
                        <?= $profiledata->is_licensed == 1 ? '' : 'style="display:none;"' ?>>
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">License Number</label>
                                <input type="text" name="license_number" class="nsm-field form-control" required
                                    value="<?= $profiledata->license_number ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">License Class</label>
                                <input type="text" name="license_class" class="nsm-field form-control" required
                                    value="<?= $profiledata->license_class ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">License State</label>
                                <select class="nsm-field form-select" name="license_state" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>>
                                    <option value="" disabled>Select State</option>
                                    <?php foreach ($states as $key => $value) { ?>
                                    <option <?= $profiledata->license_state == $key ? 'selected="selected"' : '' ?>
                                        value="<?= $key ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">License Expiration Date</label>
                                <input type="text" name="license_exp_date" class="nsm-field form-control datepicker"
                                    required
                                    value="<?= $profiledata->license_expiry_date != '0000-00-00' ? date('m/d/Y', strtotime($profiledata->license_expiry_date)) : '' ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-12 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-1">Upload License</label>
                                <label class="content-subtitle d-block mb-3 text-muted">Optional. Upload a scanned copy
                                    of your license. Only image file types (JPG, PNG, GIF) are allowed.</label>
                                <?php
                                $license_image = '';
                                if ($profiledata->license_image != '') {
                                    $license_image = urlUpload('users/business_profile/' . $profiledata->company_id . '/' . $profiledata->license_image);
                                }
                                ?>
                                <div class="nsm-img-upload m-auto"
                                    style="<?= $license_image != '' ? 'background-image: url(' . $license_image . ');' : '' ?>">
                                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                    <input type="file" name="license_image" class="nsm-upload" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-md-6">
                            <hr>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-md-6 d-flex justify-content-between">
                            <div>
                                <?php
                                $bonded_checked = '';
                                if ($profiledata->is_bonded == 1) {
                                    $bonded_checked = "checked='checked'";
                                }
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_bonded"
                                        id="checkbox_bonded" <?= $bonded_checked ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>>
                                    <label class="form-check-label fw-bold" for="checkbox_bonded">Bonded</label>
                                </div>
                                <label class="content-subtitle" id="bond_placeholder"
                                    <?= $profiledata->is_bonded == 1 ? 'style="display:none;"' : '' ?>>Not bonded.
                                    Select to
                                    activate.</label>
                            </div>
                            <div>
                                <div class="form-check form-switch"
                                    style="display: flex; align-items: center;gap: 10px;padding-left: 10px;">
                                    <input class="form-check-input m-0" name="is_show_bonded" type="checkbox"
                                        value="1" <?php echo $profiledata && $profiledata->is_show_bonded == 1 ? 'checked' : ''; ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>>
                                    <label class="content-subtitle fw-bold d-block">Show Bonded To Public Page</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="bond_details"
                        <?= $profiledata->is_bonded == 1 ? '' : 'style="display:none;"' ?>>
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Bond Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="bonded_amount" class="nsm-field form-control"
                                        required value="<?= $profiledata->bond_amount ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Bond Expiration Date</label>
                                <input type="text" name="bonded_exp_date"
                                    class="nsm-field form-control datepicker" required
                                    value="<?= $profiledata->bond_expiry_date != '0000-00-00' ? date('m/d/Y', strtotime($profiledata->bond_expiry_date)) : '' ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-12 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-1">Upload Bond</label>
                                <label class="content-subtitle d-block mb-3 text-muted">Optional. Upload a scanned copy
                                    of your bond. Only image file types (JPG, PNG, GIF) are allowed.</label>
                                <?php
                                $bond_image = '';
                                if ($profiledata->bond_image != '') {
                                    $bond_image = urlUpload('users/business_profile/' . $profiledata->company_id . '/' . $profiledata->bond_image);
                                }
                                ?>
                                <div class="nsm-img-upload m-auto"
                                    style="<?= $bond_image != '' ? 'background-image: url(' . $bond_image . ');' : '' ?>">
                                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                    <input type="file" name="bond_image" class="nsm-upload" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="col-md-6 d-flex justify-content-between">
                            <div>
                                <?php
                                $insured_checked = '';
                                if ($profiledata->is_business_insured == 1) {
                                    $insured_checked = "checked='checked'";
                                }
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_insured"
                                        id="checkbox_insured" <?= $insured_checked ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>>
                                    <label class="form-check-label fw-bold" for="checkbox_insured">Insured</label>
                                </div>
                                <label class="content-subtitle" id="insured_placeholder"
                                    <?= $profiledata->is_business_insured == 1 ? 'style="display:none;"' : '' ?>>Not
                                    insured.
                                    Select to activate.</label>
                            </div>
                            <div>
                                <div class="form-check form-switch"
                                    style="display: flex; align-items: center;gap: 10px;padding-left: 10px;">
                                    <input class="form-check-input m-0" name="is_show_business_insured"
                                        type="checkbox" value="1" <?php echo $profiledata && $profiledata->is_show_business_insured == 1 ? 'checked' : ''; ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>>
                                    <label class="content-subtitle fw-bold d-block">Show Insured To Public Page</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="insured_details"
                        <?= $profiledata->is_business_insured == 1 ? '' : 'style="display:none;"' ?>>
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Insured Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="insured_amount" class="nsm-field form-control"
                                        required value="<?= $profiledata->insured_amount ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?>/>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Insurance Expiration Date</label>
                                <input type="text" name="insured_exp_date"
                                    class="nsm-field form-control datepicker" required
                                    value="<?= $profiledata->insurance_expiry_date != '0000-00-00' ? date('m/d/Y', strtotime($profiledata->insurance_expiry_date)) : '' ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-12 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-1">Upload Insurance</label>
                                <label class="content-subtitle d-block mb-3 text-muted">Optional. Upload a scanned copy
                                    of your bond. Only image file types (JPG, PNG, GIF) are allowed.</label>
                                <?php
                                $insurance_image = '';
                                if ($profiledata->insurance_image != '') {
                                    $insurance_image = urlUpload('users/business_profile/' . $profiledata->company_id . '/' . $profiledata->insurance_image);
                                }
                                ?>
                                <div class="nsm-img-upload m-auto"
                                    style="<?= $insurance_image != '' ? 'background-image: url(' . $insurance_image . ');' : '' ?>">
                                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                    <input type="file" name="insurance_image" class="nsm-upload"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="col-md-6 d-flex justify-content-between">
                            <div>
                                <?php
                                $bbb_acredited_checked = '';
                                if ($profiledata->is_bbb_acredited == 1) {
                                    $bbb_acredited_checked = "checked='checked'";
                                }
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_bbb"
                                        id="checkbox_acredited" <?= $bbb_acredited_checked ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    <label class="form-check-label fw-bold" for="checkbox_acredited">BBB
                                        Accredited</label>
                                </div>
                                <label class="content-subtitle" id="acredited_placeholder"
                                    <?= $profiledata->is_bbb_acredited == 1 ? 'style="display:none;"' : '' ?>>Not BBB
                                    accredited. Select to activate.</label>
                            </div>
                            <div>
                                <div class="form-check form-switch"
                                    style="display: flex; align-items: center;gap: 10px;padding-left: 10px;">
                                    <input class="form-check-input m-0" name="is_show_bbb_acredited" type="checkbox"
                                        value="1" <?php echo $profiledata && $profiledata->is_show_bbb_acredited == 1 ? 'checked' : ''; ?> <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    <label class="content-subtitle fw-bold d-block">Show BBB Acredited To Public
                                        Page</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12" id="acredited_details"
                        <?= $profiledata->is_bbb_acredited == 1 ? '' : 'style="display:none;"' ?>>
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Please provide your business BBB
                                    Link</label>
                                <input type="text" name="bbb_url" class="nsm-field form-control"
                                    value="<?= $profiledata->bbb_link ?>" <?= !checkRoleCanAccessModule('company-my-credentials', 'write') ? 'disabled="disabled"' : ''; ?> />
                            </div>
                        </div>
                    </div>
                    <?php if( checkRoleCanAccessModule('company-my-credentials', 'write') ){ ?>
                    <div class="col-12 col-md-6 text-end">
                        <button type="submit" class="nsm-button primary">Save</button>
                    </div>
                    <?php } ?>
                </div>
                <?php if( checkRoleCanAccessModule('company-my-credentials', 'write') ){ ?>
                <?php echo form_close(); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
        });

        $("#checkbox_license").on("change", function() {
            let _this = $(this);

            if (_this.is(":checked")) {
                $("#license_details").show();
                $("#license_placeholder").hide();
            } else {
                $("#license_details").hide();
                $("#license_placeholder").show();
            }
        });

        $("#checkbox_bonded").on("change", function() {
            let _this = $(this);

            if (_this.is(":checked")) {
                $("#bond_details").show();
                $("#bond_placeholder").hide();
            } else {
                $("#bond_details").hide();
                $("#bond_placeholder").show();
            }
        });

        $("#checkbox_insured").on("change", function() {
            let _this = $(this);

            if (_this.is(":checked")) {
                $("#insured_details").show();
                $("#insured_placeholder").hide();
            } else {
                $("#insured_details").hide();
                $("#insured_placeholder").show();
            }
        });

        $("#checkbox_acredited").on("change", function() {
            let _this = $(this);

            if (_this.is(":checked")) {
                $("#acredited_details").show();
                $("#acredited_placeholder").hide();
            } else {
                $("#acredited_details").hide();
                $("#acredited_placeholder").show();
            }
        });

        <?php if( checkRoleCanAccessModule('company-my-credentials', 'write') ){ ?>
        $(document).on("submit", "#form-business-details", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('users/savebusinessdetail'); ?>";
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
                            title: 'My Business Credentials',
                            text: "Data was successfully updated.",
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

                    //_this.trigger("reset");
                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
        <?php } ?>
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
