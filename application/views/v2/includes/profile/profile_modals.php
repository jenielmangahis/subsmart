<div class="modal fade nsm-modal fade" id="edit_profile_modal" tabindex="-1" aria-labelledby="edit_profile_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="edit_profile_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Profile</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_profile_container">
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
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
                <button type="button" class="nsm-button" id="btn_clear_signature">Clear</button>
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save Signature</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_pw_modal" tabindex="-1" aria-labelledby="change_pw_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="changePasswordForm">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Change Password</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="change_password_user_id" id="changePasswordUserId">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Employee Name</label>
                            <input type="text" id="changePasswordEmployeeName" class="nsm-field form-control" readonly disabled />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">New Password</label>
                            <input type="password" name="new_password" id="newPassword" class="nsm-field form-control pw-field" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Retype Password</label>
                            <input type="password" name="re_password" id="rePassword" class="nsm-field form-control pw-field" />
                            <a href="javascript:void(0);" class="nsm-link mt-2 float-end" id="toggle_passwords">Show passwords</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="change_photo_modal" tabindex="-1" aria-labelledby="change_photo_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editEmployeeProfileForm">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Change Employee Photo</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id_prof" id="user_id_prof" value="<?= $user->id; ?>">
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-img-upload circle m-auto">
                                <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                <input type="file" name="user_photo" class="nsm-upload" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>