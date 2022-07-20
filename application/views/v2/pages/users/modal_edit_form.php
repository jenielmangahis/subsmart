<div class="row gy-3 mb-4">
    <div class="col-12">
        <label class="content-title">Basic Details</label>
    </div>
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Employee Number</label>
        <input type="hidden" name="user_id" value="<?= $user->id; ?>" id="editUserID">
        <input type="text" name="emp_number" class="nsm-field form-control" id="emp_number" required value="<?= $user->employee_number ? $user->employee_number : '-'; ?>" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
        <input type="text" name="firstname" class="nsm-field form-control" required value="<?= $user->FName; ?>" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
        <input type="text" name="lastname" class="nsm-field form-control" required value="<?= $user->LName; ?>" />
    </div>
</div>
<div class="row gy-3 mb-4">
    <div class="col-12">
        <label class="content-title">Login Details</label>
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Email</label>
        <div class="nsm-field-group icon-right">
            <input type="email" class="nsm-field form-control" id="employeeEmail" name="email" required value="<?= $user->email; ?>">
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Username</label>
        <div class="nsm-field-group icon-right">
            <input type="text" class="nsm-field form-control" id="employeeUsername" name="username" required value="<?= $user->username; ?>">
        </div>
    </div>
</div>
<div class="row gy-3 mb-4">
    <div class="col-12">
        <label class="content-title">Other Details</label>
    </div>
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Address</label>
        <input type="text" class="nsm-field form-control" name="address" required value="<?= $user->address; ?>">
    </div>
    <div class="col-12 col-md-8">
        <label class="content-subtitle fw-bold d-block mb-2">State</label>
        <input type="text" class="nsm-field form-control" name="state" required value="<?= $user->state; ?>">
    </div>
    <div class="col-12 col-md-4">
        <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
        <input type="text" class="nsm-field form-control" name="postal_code" required value="<?= $user->postal_code; ?>">
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Title</label>
        <select class="nsm-field form-select" name="role" id="employee_role" required>
            <option value="" disabled>Select Title</option>
            <?php foreach ($roles as $r) { ?>
                <option value="<?= $r->id; ?>" <?= $r->id == $user->role ? 'selected="selected"' : ''; ?>><?= $r->title; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Status</label>
        <select class="nsm-field form-select" name="status" required>
            <option value="" disabled>Select Status</option>
            <option value="1" <?= $user->status == 1 ? 'selected="selected"' : ''; ?>>Active</option>
            <option value="0" <?= $user->status == 0 ? 'selected="selected"' : ''; ?>>Inactive</option>
        </select>
    </div>
    <div class="col-12">
        <div class="form-check form-switch nsm-switch d-inline-block me-3">
            <?php
            $is_checked = '';
            if ($user->has_app_access == 1) {
                $is_checked = 'checked="checked"';
            }
            ?>
            <input class="form-check-input" type="checkbox" id="app_access" name="app_access" <?= $is_checked; ?>>
            <label class="form-check-label" for="app_access">App Access</label>
        </div>
        <div class="form-check form-switch nsm-switch d-inline-block">
            <?php
            $is_checked = '';
            if ($user->has_web_access == 1) {
                $is_checked = 'checked="checked"';
            }
            ?>
            <input class="form-check-input" type="checkbox" id="web_access" name="web_access" <?= $is_checked; ?>>
            <label class="form-check-label" for="web_access">Web Access</label>
        </div>
    </div>
</div>
<div class="row gy-3">
    <div class="col-12 col-md-6">
        <div class="row g-3">
            <div class="col-12">
                <label class="content-title">Profile Picture</label>
            </div>
            <div class="col-12">
                <div class="nsm-img-upload" style="background-image: url('<?= base_url('/uploads/users/user-profile/'.$user->profile_img); ?>');">
                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                    <input type="file" name="userfile" class="nsm-upload" accept="image/*">
                </div>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                <select class="nsm-field form-select" name="empPayscale" required>
                    <option value="" disabled>Select payscale</option>
                    <?php foreach($payscale as $p){ ?>
                        <option value="<?= $p->id; ?>" <?= $user->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row g-3">
            <div class="col-12">
                <label class="content-title">Rights and Permissions</label>
                <label class="content-subtitle">Select employee role</label>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="role_7" value="7" name="user_type" <?= $user->user_type == 7 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="role_7">
                        Admin
                        <span class="content-subtitle d-block fst-italic">ALL Access</span>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" id="role_1" name="user_type" <?= $user->user_type == 1 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="role_1">
                        Office Manager
                        <span class="content-subtitle d-block fst-italic">ALL except high security file vault</span>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="2" id="role_2" name="user_type" <?= $user->user_type == 2 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="role_2">
                        Partner
                        <span class="content-subtitle d-block fst-italic">ALL base on plan type</span>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="3" id="role_3" name="user_type" <?= $user->user_type == 3 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="role_3">
                        Team Leader
                        <span class="content-subtitle d-block fst-italic">No accounting or any changes to company profile or deletion</span>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="4" id="role_4" name="user_type" <?= $user->user_type == 4 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="role_4">
                        Standard User
                        <span class="content-subtitle d-block fst-italic">Cannot add or delete employees, can not manage subscriptions</span>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="5" id="role_5" name="user_type" <?= $user->user_type == 5 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="role_5">
                        Field Sales
                        <span class="content-subtitle d-block fst-italic">View only no input</span>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="6" id="role_6" name="user_type" <?= $user->user_type == 6 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="role_6">
                        Field Tech
                        <span class="content-subtitle d-block fst-italic">App access only, no Web access</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>