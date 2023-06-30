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
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
        <input type="text" name="mobile" class="nsm-field form-control" value="<?= $user->mobile; ?>" />
    </div>
    <div class="col-12 col-md-6">
        <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
        <input type="text" name="phone" class="nsm-field form-control" value="<?= $user->phone; ?>" />
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
    <div class="col-12 col-md-5">
        <label class="content-subtitle fw-bold d-block mb-2">City</label>
        <input type="text" class="nsm-field form-control" name="city" required value="<?= $user->city; ?>">
    </div>
    <div class="col-12 col-md-5">
        <label class="content-subtitle fw-bold d-block mb-2">State</label>
        <input type="text" class="nsm-field form-control" name="state" required value="<?= $user->state; ?>">
    </div>
    <div class="col-12 col-md-2">
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
            <div class="col-8">
                <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                <select class="nsm-field form-select" name="empPayscale" required>
                    <option value="" disabled>Select payscale</option>
                    <?php foreach($payscale as $p){ ?>
                        <option value="<?= $p->id; ?>" <?= $user->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-4">
                <label class="content-subtitle fw-bold d-block mb-2">Base Salary</label>
                <input class="form-control" name="empBaseSalary" type="number" step="any" min="0" value="<?php echo ($user->base_salary) ? $user->base_salary : "0"; ?>">
            </div>
            <div class="col-12 compensation_baseamount" style="display: none;">
                <label class="content-subtitle fw-bold d-block mb-2">Compensation&nbsp;<small class="text-muted fw-normal">(Base Amount)</small></label>
                <input class="form-control" name="empCompensationBase" type="number" step="any" min="0" value="<?php echo ($user->compensation_base) ? $user->compensation_base : "0"; ?>">
            </div>
            <div class="col-12 compensation_hourlyrate" style="display: none;">
                <label class="content-subtitle fw-bold d-block mb-2">Compensation&nbsp;<small class="text-muted fw-normal">(Hourly Rate)</small></label>
                <input class="form-control" name="empCompensationHourlyRate" type="number" step="any" min="0" value="<?php echo ($user->compensation_rate) ? $user->compensation_rate : "0"; ?>">
            </div>
            <div class="col-9">
                <label class="content-subtitle fw-bold d-block mb-2">Commission</label>
                <select class="nsm-field form-select" name="empCommission" required>
                    <option value="" disabled>Select Type</option>
                    <option value="0" <?php echo $user->commission_id == 0 ? 'selected="selected"' : ''; ?>>Percentage (Gross, Net)</option>
                    <option value="1" <?php echo $user->commission_id == 1 ? 'selected="selected"' : ''; ?>>Net + Percentage</option>
                </select>
            </div>
            <div class="col-3">
                <label class="content-subtitle fw-bold d-block mb-2">&nbsp;</label>
                <select class="nsm-field form-select" name="empCommissionPercentage" required>
                    <option <?php echo $user->commission_percentage == 0.01 ? 'selected="selected"' : '';?> value="0.01">1%</option>
                    <option <?php echo $user->commission_percentage == 0.02 ? 'selected="selected"' : '';?> value="0.02">2%</option>
                    <option <?php echo $user->commission_percentage == 0.03 ? 'selected="selected"' : '';?> value="0.03">3%</option>
                    <option <?php echo $user->commission_percentage == 0.04 ? 'selected="selected"' : '';?> value="0.04">4%</option>
                    <option <?php echo $user->commission_percentage == 0.05 ? 'selected="selected"' : '';?> value="0.05">5%</option>
                    <option <?php echo $user->commission_percentage == 0.06 ? 'selected="selected"' : '';?> value="0.06">6%</option>
                    <option <?php echo $user->commission_percentage == 0.07 ? 'selected="selected"' : '';?> value="0.07">7%</option>
                    <option <?php echo $user->commission_percentage == 0.08 ? 'selected="selected"' : '';?> value="0.08">8%</option>
                    <option <?php echo $user->commission_percentage == 0.09 ? 'selected="selected"' : '';?> value="0.09">9%</option>
                    <option <?php echo $user->commission_percentage == 0.10 ? 'selected="selected"' : '';?> value="0.10">10%</option>
                    <option <?php echo $user->commission_percentage == 0.11 ? 'selected="selected"' : '';?> value="0.11">11%</option>
                    <option <?php echo $user->commission_percentage == 0.12 ? 'selected="selected"' : '';?> value="0.12">12%</option>
                    <option <?php echo $user->commission_percentage == 0.13 ? 'selected="selected"' : '';?> value="0.13">13%</option>
                    <option <?php echo $user->commission_percentage == 0.14 ? 'selected="selected"' : '';?> value="0.14">14%</option>
                    <option <?php echo $user->commission_percentage == 0.15 ? 'selected="selected"' : '';?> value="0.15">15%</option>
                    <option <?php echo $user->commission_percentage == 0.16 ? 'selected="selected"' : '';?> value="0.16">16%</option>
                    <option <?php echo $user->commission_percentage == 0.17 ? 'selected="selected"' : '';?> value="0.17">17%</option>
                    <option <?php echo $user->commission_percentage == 0.18 ? 'selected="selected"' : '';?> value="0.18">18%</option>
                    <option <?php echo $user->commission_percentage == 0.19 ? 'selected="selected"' : '';?> value="0.19">19%</option>
                    <option <?php echo $user->commission_percentage == 0.20 ? 'selected="selected"' : '';?> value="0.20">20%</option>
                    <option <?php echo $user->commission_percentage == 0.25 ? 'selected="selected"' : '';?> value="0.25">25%</option>
                    <option <?php echo $user->commission_percentage == 0.30 ? 'selected="selected"' : '';?> value="0.30">30%</option>
                    <option <?php echo $user->commission_percentage == 0.35 ? 'selected="selected"' : '';?> value="0.35">35%</option>
                    <option <?php echo $user->commission_percentage == 0.40 ? 'selected="selected"' : '';?> value="0.40">40%</option>
                    <option <?php echo $user->commission_percentage == 0.50 ? 'selected="selected"' : '';?> value="0.50">50%</option>
                    <option <?php echo $user->commission_percentage == 0.51 ? 'selected="selected"' : '';?> value="0.51">51%</option>
                    <!-- <option value="0" <?php echo $user->commission_id == 0 ? 'selected="selected"' : ''; ?>>Percentage (Gross, Net)</option> -->
                    <!-- <option value="1" <?php echo $user->commission_id == 1 ? 'selected="selected"' : ''; ?>>Net + Percentage</option> -->
                </select>
            </div>
            <hr class="mb-0">
            <div class="col-6">
                <label class="content-subtitle fw-bold d-block mb-2">Total Salary</label>
                <span><?php echo ($commission->totalSalary) ? "$".number_format($commission->totalSalary, 2) : "$0"; ?></span>
            </div>
            <div class="col-6">
                <label class="content-subtitle fw-bold d-block mb-2">Total Commission</label>
                <span><?php echo ($commission->totalCommission) ? "$".number_format($commission->totalCommission, 2) : "$0"; ?></span>
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
<script type="text/javascript">
    function compensationHideShow() {
        let selectedOption = $('select[name="empPayscale"]').find('option:selected').text();
        if (selectedOption.includes("Compensation (Base Amount)")) {
            $('.compensation_baseamount').fadeIn('fast');
            $('.compensation_hourlyrate').hide();
        } else if(selectedOption.includes("Compensation (Hourly Rate)")) {
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').fadeIn('fast');
        } else {
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
        }
    } compensationHideShow();

    $('select[name="empPayscale"]').change(function() {
        compensationHideShow();
    });
</script>