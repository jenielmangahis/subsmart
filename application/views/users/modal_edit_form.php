<style>
    #modalEditEmployee .modal-body {
        max-height: 80vh;
    }

    .modal-backdrop {
        width: 100%;
        height: 100%;
    }

    .custom-control-input:checked~.custom-control-label:before {
        border-color: #5a65c5;
        background-color: #24c528;
    }

    .custom-control-label::before {
        position: absolute;
        top: 0.25rem;
        left: -1.5rem;
        display: block;
        width: 1rem;
        height: 1rem;
        pointer-events: none;
        content: "";
        background-color: #f94a23;
        border: #adb5bd solid 1px;
    }

    .custom-switch .custom-control-label::after {
        top: calc(0.25rem + 2px);
        left: calc(-2.25rem + 2px);
        width: calc(1rem - 4px);
        height: calc(1rem - 4px);
        background-color: #ffffff;
        border-radius: 0.5rem;
        transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out;
        transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out;
    }

    .clock_in_address_map:after,
    .clock_out_address_map:after,
    #clock_out_address_map:after,
    #clock_out_address_map1:after {
        width: 22px;
        height: 40px;
        display: block;
        content: ' ';
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -40px 0 0 -11px;
        animation: ease;
        animation-duration: 20s;
        background: url(https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png);
        background-size: 22px 40px;
        pointer-events: none;
    }


    .clock_in_address_radius_container,
    .clock_out_address_radius_container,
    .clock_out_address_radius_container1 {
        position: absolute;
        z-index: 1;
        padding: 20px 10px;
        width: 100%;
    }

    label.radius_number_view,
    label.radius_number_view1,
    label.clock_in_radius_number_view,
    label.clock_out_radius_number_view {
        background-color: #FFFFFF;
        padding: 5px 30px;
        font-size: 13px;
        margin-left: 10px;
        border: solid 1px #6241A4;
        border-radius: 10px;
        color: #666666;
        float: right;
    }

    input#clock_in_address_radius,
    input#clock_in_address_radius,
    input#clock_out_address_radius {
        width: 200px;
        height: 2px;
        float: right;
        margin-top: 15px;
    }
</style>
<input type="hidden" name="user_id" value="<?= $user->id; ?>" id="editUserID">
<div class="section-title">Basic Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Employee Number</label>
            <input type="text" name="emp_number" class="form-control" id="emp_number" value="<?= $user->employee_number ? $user->employee_number : '-'; ?>" placeholder="Enter Employee Number">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">First Name</label>
            <input type="text" name="firstname" class="form-control" value="<?= $user->FName; ?>" placeholder="Enter First Name">
        </div>
        <div class="col-md-6">
            <label for="">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="<?= $user->LName; ?>" placeholder="Enter Last Name">
        </div>
    </div>
</div>
<div class="section-title">Login Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="" style="display: block">Email</label>
            <input type="text" name="email" class="form-control" value="<?= $user->email; ?>" id="employeeEmail" placeholder="e.g: email@mail.com" style="width: 90%">
            <i class="fa fa-sync-alt check-if-exist" title="Check if Email is already exist" data-toggle="tooltip"></i>
            <span class="email-error"></span>
        </div>
        <div class="col-md-6">
            <label for="" style="display: block">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $user->username; ?>" id="employeeUsername" placeholder="e.g: nsmartrac" style="width: 90%">
            <i class="fa fa-sync-alt check-if-exist" title="Check if Username already exist" data-toggle="tooltip"></i>
            <span class="username-error"></span>
        </div>
    </div>
</div>
<div class="section-title">Other Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label for="">Address</label>
            <input type="text" name="address" value="<?= $user->address; ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">State</label>
            <input type="text" name="state" value="<?= $user->state; ?>" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="">Zip Code</label>
            <input type="text" name="postal_code" value="<?= $user->postal_code; ?>" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Title</label>
            <select name="role" id="employeeRole" class="form-control edit-select2-role">
                <option value="">Select Title</option>
                <?php foreach ($roles as $r) { ?>
                    <option value="<?= $r->id; ?>" <?= $r->id == $user->role ? 'selected="selected"' : ''; ?>><?= $r->title; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="1" <?= $user->status == 1 ? 'selected="selected"' : ''; ?>>Active</option>
                <option value="0" <?= $user->status == 0 ? 'selected="selected"' : ''; ?>>Inactive</option>
            </select>
        </div>
        <div class="col-md-6">
            <div class="input-switch">
                <label for="">App Access</label><br>
                <?php
                $is_checked = '';
                if ($user->has_app_access == 1) {
                    $is_checked = 'checked="checked"';
                }
                ?>
                <input type="checkbox" name="app_access" class="edit-js-switch" <?= $is_checked; ?> />
            </div>
            <div class="input-switch">
                <?php
                $is_checked = '';
                if ($user->has_web_access == 1) {
                    $is_checked = 'checked="checked"';
                }
                ?>
                <label for="">Web Access</label><br>
                <input type="checkbox" name="web_access" class="edit-js-switch" <?= $is_checked; ?> />
            </div>
        </div>
    </div>
</div>
<div class="section-title">Profile Image</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Image</label>
            <div id="editEmployeeProfilePhoto" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                <div class="dz-message" style="margin: 20px;">
                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                </div>
            </div>
            <input type="hidden" name="img_id" id="editPhotoId">
            <input type="hidden" name="profile_photo" id="editPhotoName">
            <div>
                <label for="">Payscale</label>
                <select name="empPayscale" id="empPayscale" class="form-control select2-payscale">
                    <option value="">Select payscale</option>
                    <?php foreach ($payscale as $p) { ?>
                        <option value="<?= $p->id; ?>" <?= $user->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-container">
                <img src="/uploads/users/default.png" alt="Profile photo">
            </div>
            <label>Rights and Permissions</label>
            <div class="help help-sm help-block">Select employee role</div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 7 ? 'checked="checked"' : ''; ?> name="user_type" value="7" id="role_7">
                    <label for="role_7"><span>Admin</span></label>
                </div>
                <div class="help help-sm help-block">
                    ALL Access<br>
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 1 ? 'checked="checked"' : ''; ?> name="user_type" value="1" id="role_1">
                    <label for="role_1"><span>Office Manager</span></label>
                </div>
                <div class="help help-sm help-block">
                    ALL except high security file vault<br>
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 2 ? 'checked="checked"' : ''; ?> name="user_type" value="2" id="role_2">
                    <label for="role_2"><span>Partner</span></label>
                </div>
                <div class="help help-sm help-block">
                    ALL base on plan type
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 3 ? 'checked="checked"' : ''; ?> name="user_type" value="3" id="role_3">
                    <label for="role_3"><span>Team Leader</span></label>
                </div>
                <div class="help help-sm help-block">
                    No accounting or any changes to company profile or deletion
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 4 ? 'checked="checked"' : ''; ?> name="user_type" value="4" id="role_4">
                    <label for="role_4"><span>Standard User</span></label>
                </div>
                <div class="help help-sm help-block">
                    Can not add or delete employees, can not manage subscriptions
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 5 ? 'checked="checked"' : ''; ?> name="user_type" value="5" id="role_5">
                    <label for="role_5"><span>Field Sales</span></label>
                </div>
                <div class="help help-sm help-block">
                    View only no input
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 6 ? 'checked="checked"' : ''; ?> name="user_type" value="6" id="role_6">
                    <label for="role_6"><span>Field Tech</span></label>
                </div>
                <div class="help help-sm help-block">
                    App access only, no Web access
                </div>
            </div>
        </div>
    </div>
</div>
<div id="manage_timsheet_clockin_clockout_gps">
</div>

<script>
    $(function() {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.edit-js-switch'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                size: 'small'
            });
        });

        $('.edit-select2-role').select2({
            placeholder: 'Select Title',
            allowClear: true,
            width: 'resolve'
        });

        $('.select2-payscale').select2({
            placeholder: 'Select Payscale',
            allowClear: true,
            width: 'resolve'
        });

        Dropzone.autoDiscover = false;
        var fname = [];
        var selected = [];
        var profilePhoto = new Dropzone('#editEmployeeProfilePhoto', {
            url: base_url + 'users/profilePhoto',
            acceptedFiles: "image/*",
            maxFilesize: 20,
            maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var file_name = JSON.parse(response)['photo'];
                    fname.push(file_name.replace(/\"/g, ""));
                    selected.push(file);
                    $('#editPhotoId').val(JSON.parse(response)['id']);
                    $('#editPhotoName').val(JSON.parse(response)['photo']);
                });
            },
            removedfile: function(file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type: "POST",
                    url: base_url + 'users/removeProfilePhoto',
                    dataType: 'json',
                    data: {
                        name: name,
                        index: index
                    },
                    success: function(data) {
                        if (data == 1) {
                            $('#editPhotoId').val(null);
                        }
                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });
    });
</script>