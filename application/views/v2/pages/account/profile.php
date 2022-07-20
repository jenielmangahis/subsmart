<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/profile/profile_modals'); ?>

<?php
if ($user->profile_img != '') {
    $data_img = $user->profile_img;
} else {
    $data_img = 'default.png';
}
?>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li class="btn-edit-profile" data-id="<?= $user->id; ?>">
            <div class="nsm-fab-icon">
                <i class="bx bx-edit"></i>
            </div>
            <span class="nsm-fab-label">Edit Profile</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#register_signature_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-pen"></i>
            </div>
            <span class="nsm-fab-label">Create Signature</span>
        </li>
        <li class="btn-change-pw" data-name="<?php echo $user->FName . ' ' . $user->LName; ?>" data-id="<?php echo $user->id ?>">
            <div class="nsm-fab-icon">
                <i class="bx bx-key"></i>
            </div>
            <span class="nsm-fab-label">Change Password</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#change_photo_modal" data-id="<?= $user->id; ?>" data-img="<?= $data_img; ?>">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-circle"></i>
            </div>
            <span class="nsm-fab-label">Change Profile Picture</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Edit Profile
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button btn-edit-profile" data-id="<?= $user->id; ?>">
                                <i class='bx bx-fw bx-edit'></i> Edit Profile
                            </button>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#register_signature_modal">
                                <i class='bx bx-fw bx-pen'></i> Create Signature
                            </button>
                            <button type="button" class="nsm-button btn-change-pw" data-name="<?php echo $user->FName . ' ' . $user->LName; ?>" data-id="<?php echo $user->id ?>">
                                <i class='bx bx-fw bx-key'></i> Change Password
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#change_photo_modal" data-id="<?= $user->id; ?>" data-img="<?= $data_img; ?>">
                                <i class='bx bx-fw bx-user-circle'></i> Change Profile Picture
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="nsm-card p-5">
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="nsm-profile m-auto" style="background-image: url('<?php echo userProfile($user->id) ?>'); height: 200px; aspect-ratio: 1;"></div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 class="m-0"><?= $user->FName . ' ' . $user->LName; ?></h4>
                                        <label class="content-subtitle">
                                            <?php echo getUserType($user->user_type); ?>
                                        </label>
                                    </div>
                                    <div class="col-12">
                                        <div class="w-100 m-auto" style="max-width: 400px;">
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Name</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo $user->FName ?> <?php echo $user->LName ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Username</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo $user->username ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Email</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo $user->email ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Role</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo $user->role->title ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Phone Number</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo $user->phone ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Mobile Number</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo $user->mobile ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Address</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo nl2br($user->address) ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Last Login</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo ($user->last_login != '0000-00-00 00:00:00') ? date(setting('datetime_format'), strtotime($user->last_login)) : 'No Record' ?></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-subtitle fw-bold">Member Since</label>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <label class="content-subtitle"><?php echo ($user->created_at != '0000-00-00 00:00:00') ? date(setting('datetime_format'), strtotime($user->created_at)) : 'No Record' ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="nsm-card p-5">
                            <div class="nsm-card-content">
                                <div class="d-flex justify-content-evenly align-items-center flex-column h-100">
                                    <img src="<?php echo userSignature($user->id); ?>" id="profile_signature">
                                    <label class="content-subtitle mt-3 d-block">This is the electronic representation of your signature, update any time.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-edit-profile").on("click", function() {
            let id = $(this).attr("data-id");
            let _container = $("#edit_profile_container");

            showLoader(_container);
            $("#edit_profile_modal").modal("show");

            $.ajax({
                url: "<?php echo base_url('users/load_edit_profile'); ?>",
                type: "POST",
                dataType: "html",
                data: {
                    user_id: id
                },
                success: function(result) {
                    _container.html(result);
                }
            });
        });

        $("#edit_profile_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('users/_update_profile'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result == 1) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Your profile was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: "Cannot update profile. Please try again.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#edit_profile_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
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

            var url = "<?php echo base_url('users/_update_user_signature'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "html",
                data: _this.serialize(),
                success: function(result) {
                    $("#profile_signature").attr("src", first);
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Your signature was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    $("#register_signature_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".btn-change-pw", function() {
            var user_id = $(this).attr("data-id");
            var employee_name = $(this).attr("data-name");
            $("#changePasswordUserId").val(user_id);
            $("#changePasswordEmployeeName").val(employee_name);
            $("#change_pw_modal").modal("show");
            1
        });

        $("#toggle_passwords").on("click", function() {
            let _this = $(this);

            if (_this.hasClass("shown")) {
                _this.text("Show passwords");
                _this.removeClass("shown");
                $(".pw-field").attr("type", "password");
            } else {
                _this.text("Hide passwords");
                _this.addClass("shown");
                $(".pw-field").attr("type", "text");
            }
        });

        $(document).on("submit", "#changePasswordForm", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('users/_update_employee_password'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            let values = {};
            $.each(_this.serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            if (values['new_password'] && values['re_password']) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: "json",
                    data: {
                        values: values
                    },
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Save Successful!',
                                text: "Your password was successfully updated.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }

                        $("#change_pw_modal").modal('hide');
                        _this.trigger("reset");

                        _this.find("button[type=submit]").html("Save");
                        _this.find("button[type=submit]").prop("disabled", false);
                    },
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: "Passwords do not match.",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                });
            }
        });

        $(document).on("submit", "#editEmployeeProfileForm", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('users/ajaxUpdateEmployeeProfilePhoto'); ?>";
            var formData = new FormData($("#editEmployeeProfileForm")[0]);
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result == 1) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Employee photo was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: "Please select a valid image.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    $("#change_photo_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>