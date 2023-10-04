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
                <div class="nsm-img-upload" style="background-size: contain; background-image: url('<?= base_url('/uploads/users/user-profile/' . $user->profile_img); ?>');">
                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                    <input type="file" name="userfile" class="nsm-upload" accept="image/*">
                </div>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                <select class="nsm-field form-select edit-emp-payscale" name="empPayscale" required>
                    <option value="" disabled>Select payscale</option>
                    <?php foreach ($payscale as $p) { ?>
                        <option value="<?= $p->id; ?>" <?= $user->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 edit-pay-type-container">
                <label class="content-subtitle fw-bold d-block mb-2 edit-payscale-pay-type"><?= $salary_type_label; ?></label>
                <input class="form-control" name="salary_rate" type="number" step="any" min="0" value="<?= number_format($salary_rate,2); ?>">
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

    <div class="row gy-3">
            <div class="col-12 col-md-12 mt-5">
                <label class="content-title" style="display:inline-block;">Commission Settings</label>
                <a class="nsm-button primary small btn-edit-add-new-commision" href="javascript:void(0);"><i class='bx bx-plus'></i> Add New</a>
            </div>
            <div class="col-12 col-md-12">
                <table class="table" id="edit-commission-settings">
                    <thead>
                    <tr>
                        <td style="width: 50%;">Name</td>
                        <td style="width:30%;">Type</td>
                        <td>Value</td>
                        <td style="width:5%;"></td>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($employeeCommissionSettings as $ecs){ ?>
                            <tr>
                                <td>
                                    <select class="nsm-field form-select" name="commission_setting_id[]">
                                        <?php foreach( $commissionSettings as $cs ){ ?>
                                            <option value="<?= $cs->id; ?>" <?= $ecs->commission_setting_id == $cs->id ? 'selected="selected"' : ''; ?>><?= $cs->name; ?></option>
                                        <?php } ?>
                                    </select>   
                                </td>
                                <td>
                                    <select class="nsm-field form-select" name="commission_setting_type[]">
                                        <?php foreach($optionCommissionTypes as $key => $value){ ?>
                                            <option value="<?= $key; ?>" <?= $ecs->commission_type == $key ? 'selected="selected"' : ''; ?>><?= $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input type="number" step="any" name="commission_setting_value[]" class="nsm-field form-control" id="" value="<?= $ecs->commission_value; ?>" required /></td>
                                <td><a class="nsm-button small btn-delete-commission-setting-row" style="display:block;" href="javascript:void(0);"><i class='bx bx-trash'></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<script type="text/javascript">
    function setCommissionPercentage() {
        const selectedValue = $('#empCommission').find('option:selected').val();
        const empCommissionPercentage = $('select[name="empCommissionPercentage"]');

        if (selectedValue == 2) {
            empCommissionPercentage.prop("disabled", true);
            empCommissionPercentage.css("opacity", "0.75");
        } else {
            empCommissionPercentage.prop("disabled", false);
            empCommissionPercentage.css("opacity", "1");
        }
    }

    function setDefaultEmpCommissionValue() {
        let selectedPayscaleOption = $('select[name="empPayscale"]').find('option:selected').text();

        if (selectedPayscaleOption.includes("Base (Hourly Rate)") || selectedPayscaleOption.includes("Base (Weekly Rate)") || selectedPayscaleOption.includes("Base (Monthly Rate)")) {
            $('select[name="empCommission"]').find('option[value="2"]').prop("selected", true);
            $('select[name="empCommissionPercentage"]').val("0");
        }
    }

    function editCompensationHideShow() {
        let selectedOption = $('.edit-emp-payscale').find('option:selected').text();
        let selectedValue = $('.edit-emp-payscale').val();

        if ( selectedValue == 3 ) { //Base Hourly rate
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.edit-commission-percentage-grp').show();
        } else if ( selectedValue == 4 ) { //Base (Weekly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').fadeIn('fast');
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.edit-commission-percentage-grp').show();
        } else if ( selectedValue == 5 ) { //Base (Monthly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').fadeIn('fast');
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.edit-commission-percentage-grp').show();
        } else if ( selectedValue == 6 ) { //Compensation (Base Amount)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').fadeIn('fast');
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.edit-commission-percentage-grp').show();
        } else if ( selectedValue == 7 ) { //Compensation (Hourly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').fadeIn('fast');
            $('.jobtypebase_install').hide();
            $('.edit-commission-percentage-grp').show();
        } else if ( selectedValue == 8 ) { //Job Type Base(Install/Service)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').fadeIn('fast');
            $('.commission-percentage-grp').show();
        } else {
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.edit-commission-percentage-grp').hide();
        }

        // if (selectedOption.includes("Base (Hourly Rate)")) {
        //     $('.base_hourlyrate').fadeIn('fast');
        //     $('.base_weeklyrate').hide();
        //     $('.base_monthlyrate').hide();
        //     $('.compensation_baseamount').hide();
        //     $('.compensation_hourlyrate').hide();
        //     $('.jobtypebase_install').hide();
        // } else if (selectedOption.includes("Base (Weekly Rate)")) {
        //     $('.base_hourlyrate').hide();
        //     $('.base_weeklyrate').fadeIn('fast');
        //     $('.base_monthlyrate').hide();
        //     $('.compensation_baseamount').hide();
        //     $('.compensation_hourlyrate').hide();
        //     $('.jobtypebase_install').hide();
        // } else if (selectedOption.includes("Base (Monthly Rate)")) {
        //     $('.base_hourlyrate').hide();
        //     $('.base_weeklyrate').hide();
        //     $('.base_monthlyrate').fadeIn('fast');
        //     $('.compensation_baseamount').hide();
        //     $('.compensation_hourlyrate').hide();
        //     $('.jobtypebase_install').hide();
        // } else if (selectedOption.includes("Compensation (Base Amount)")) {
        //     $('.base_hourlyrate').hide();
        //     $('.base_weeklyrate').hide();
        //     $('.base_monthlyrate').hide();
        //     $('.compensation_baseamount').fadeIn('fast');
        //     $('.compensation_hourlyrate').hide();
        //     $('.jobtypebase_install').hide();
        // } else if (selectedOption.includes("Compensation (Hourly Rate)")) {
        //     $('.base_hourlyrate').hide();
        //     $('.base_weeklyrate').hide();
        //     $('.base_monthlyrate').hide();
        //     $('.compensation_baseamount').hide();
        //     $('.compensation_hourlyrate').fadeIn('fast');
        //     $('.jobtypebase_install').hide();
        // } else if (selectedOption.includes("Job Type Base (Install/Service)")) {
        //     $('.base_hourlyrate').hide();
        //     $('.base_weeklyrate').hide();
        //     $('.base_monthlyrate').hide();
        //     $('.compensation_baseamount').hide();
        //     $('.compensation_hourlyrate').hide();
        //     $('.jobtypebase_install').fadeIn('fast');
        // } else {
        //     $('.base_hourlyrate').hide();
        //     $('.base_weeklyrate').hide();
        //     $('.base_monthlyrate').hide();
        //     $('.compensation_baseamount').hide();
        //     $('.compensation_hourlyrate').hide();
        //     $('.jobtypebase_install').hide();
        // }
    }
    editCompensationHideShow();

    $('.edit-emp-payscale').change(function() {
        var psid = $(this).val();
        var url  = base_url + 'payscale/_get_details'
        $.ajax({
            type: 'POST',
            url: url,
            data: {psid:psid},
            dataType: "json",
            success: function(result) {
                if( result.pay_type == 'Commission Only' ){
                    $('.edit-pay-type-container').hide();
                }else{
                    var rate_label = result.pay_type + ' Rate';
                    $('.edit-pay-type-container').show();
                    $('.edit-payscale-pay-type').html(rate_label);
                }                
            },
        });
        //editCompensationHideShow();
        //setDefaultEmpCommissionValue();
    });

</script>