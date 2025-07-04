<div class="modal fade nsm-modal fade" id="add_employee_modal" tabindex="-1" aria-labelledby="add_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="add_employee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Employee</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="overflow-x: auto;max-height: 800px;">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="custom-header">Employee Details</label>
                        </div>
                    </div>
                    <div class="row gy-3 mb-3">
                        <div class="col-12 col-md-8">
                            <div class="row gy-3 mb-4">                                
                                <div class="col-12">
                                    <label class="content-subtitle fw-bold d-block mb-2">Employee Number</label>
                                    <input type="text" name="emp_number" class="nsm-field form-control" id="emp_number" required />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                                    <input type="text" name="firstname" class="nsm-field form-control" required />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                                    <input type="text" name="lastname" class="nsm-field form-control" required />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                                    <!-- <input type="text" name="mobile" class="nsm-field form-control" value="" /> -->
                                    <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="mobile" id="mobile" value="" />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                                    <!-- <input type="text" name="phone" class="nsm-field form-control" value="" /> -->
                                    <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone" id="phone" value="" />
                                </div>   
                                <div class="col-12 col-md-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Title</label>
                                    <select class="nsm-field form-select" name="user_type" id="employee_role" required>
                                        <option value="" selected="selected" disabled>Select Title</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Role</label>
                                    <select class="nsm-field form-select" name="role" id="role" required>
                                        <option value="" selected="selected" disabled>Select Role</option>
                                        <?php foreach($roles as $key => $value){ ?>
                                        <option value="<?= $key; ?>"><?= $value['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                                 
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="col-12">
                                <label class="content-title">Profile Picture</label>
                            </div>
                            <div class="col-12">
                                <div class="nsm-img-upload">
                                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                    <input type="file" name="userfile" class="nsm-upload" accept="image/*">
                                </div>
                            </div>
                        </div>                            
                    </div>   
                    <div class="row gy-3 mb-4">                                                                                    
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                            <input type="text" class="nsm-field form-control" name="address" required>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="content-subtitle fw-bold d-block mb-2">City</label>
                            <input type="text" class="nsm-field form-control" name="city" required>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="content-subtitle fw-bold d-block mb-2">State</label>
                            <input type="text" class="nsm-field form-control" name="state" required>
                        </div>
                        <div class="col-12 col-md-2">
                            <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
                            <input type="text" class="nsm-field form-control" name="postal_code" required>
                        </div>     
                    </div>  

                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="custom-header">Login Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                            <div class="nsm-field-group icon-right">
                                <input type="email" class="nsm-field form-control" id="employee_username" name="email" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                            <select class="nsm-field form-select" name="status" required>
                                <option value="" selected="selected" disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="employee_password" name="password" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Confirm Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="employee_password_2" name="confirm_password" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-check form-switch nsm-switch d-inline-block me-3">
                                <input class="form-check-input" type="checkbox" id="app_access" name="app_access">
                                <label class="form-check-label" for="app_access">App Access</label>
                            </div>
                            <div class="form-check form-switch nsm-switch d-inline-block">
                                <input class="form-check-input" type="checkbox" id="web_access" name="web_access">
                                <label class="form-check-label" for="web_access">Web Access</label>
                            </div>
                        </div>
                    </div>
                    <?php //if(isSolarCompany() == 1){ 
                    ?>
                    <!-- <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">ADT Sales App Login Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Username</label>
                            <div class="nsm-field-group icon-right">
                                <input type="text" class="nsm-field form-control" id="portal_username" name="portal_username" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="portal_password" name="portal_password" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Confirm Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="portal_confirm_password" name="portal_confirm_password" />
                            </div>
                        </div>
                    </div> -->
                    <?php //} 
                    ?>
                    <div class="row gy-3 mb-4">
                                                                   
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" id="btn-save-employee" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_employee_modal" tabindex="-1" aria-labelledby="edit_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit_employee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_employee_container" style="overflow-x: auto;max-height: 800px;">
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" id="btn-update-employee" class="nsm-button primary" disabled>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="change_password_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Change Password</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="change_password_form">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Employee Name</label>
                            <input type="hidden" name="change_password_user_id" id="changePasswordUserId">
                            <input type="text" class="nsm-field form-control" id="changePasswordEmployeeName" readonly="" disabled="" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">New Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="newPassword" name="new_password" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Retype Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="rePassword" name="re_password" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary" id="btn-change-password" form="change_password_form">Save</button>
            </div>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_adt_portal_access_modal" tabindex="-1" aria-labelledby="change_password_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="change-adt-portal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Set ADT Sales Portal Login</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="adt-portal-access-container"></div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="employee_commissions_list_modal" tabindex="-1" aria-labelledby="employee_commissions_list_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Commissions List</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="employee-commissions-list-container"></div>                
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_profile_modal" tabindex="-1" aria-labelledby="change_profile_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Change Employee Photo</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="change_profile_form">
                <input type="hidden" name="user_id_prof" id="user_id_prof" value="" />
                <div class="row g-3">
                    <div class="col-12">                            
                        <div class="nsm-img-upload">
                            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                            <input type="file" name="user_photo" class="nsm-upload" accept="image/*" required>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" id="btn-row-change-profile-photo" class="nsm-button primary" form="change_profile_form">Save</button>
            </div>
        </div>        
    </div>
</div>

<div class="modal fade" id="modal-view-archive" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Archived</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body" id="users-archived-container"></div>            
        </div>
    </div>
</div>

<script type="text/javascript">
    function setDefaultEmpCommissionValue() {
        let selectedPayscaleOption = $('select[name="empPayscale"]').find('option:selected').text();

        if (selectedPayscaleOption.includes("Base (Hourly Rate)") || selectedPayscaleOption.includes("Base (Weekly Rate)") || selectedPayscaleOption.includes("Base (Monthly Rate)")) {
            $('select[name="empCommission"]').find('option[value="2"]').prop("selected", true);
            $('select[name="empCommissionPercentage"]').val("0");
        } else {
            $('select[name="empCommission"]').val('');
            $('select[name="empCommissionPercentage"]').val('0');
        }
        
    }

    function compensationHideShow() {
        let selectedOption = $('.add-emp-payscale').find('option:selected').text();
        let selectedValue = $('.add-emp-payscale').val();

        if ( selectedValue == 3 ) { //Base Hourly rate
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 4 ) { //Base (Weekly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').fadeIn('fast');
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 5 ) { //Base (Monthly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').fadeIn('fast');
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 6 ) { //Compensation (Base Amount)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').fadeIn('fast');
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 7 ) { //Compensation (Hourly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').fadeIn('fast');
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 8 ) { //Job Type Base(Install/Service)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').fadeIn('fast');
            $('.commission-percentage-grp').hide();
        } else {
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        }

        /*if (selectedOption.includes("Base (Hourly Rate)")) {
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Base (Weekly Rate)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').fadeIn('fast');
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Base (Monthly Rate)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').fadeIn('fast');
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Compensation (Base Amount)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').fadeIn('fast');
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Compensation (Hourly Rate)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').fadeIn('fast');
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Job Type Base(Install/Service)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').fadeIn('fast');
        } else {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        }*/
    }
    compensationHideShow();

    $('.add-emp-payscale').change(function() {
        var psid = $(this).val();
        var url  = base_url + 'payscale/_get_details'
        $.ajax({
            type: 'POST',
            url: url,
            data: {psid:psid},
            dataType: "json",
            success: function(result) {
                if( result.pay_type == 'Commission Only' ){
                    $('.add-pay-type-container').hide();
                }else{
                    var rate_label = result.pay_type + ' Rate';
                    $('.add-pay-type-container').show();
                    $('.add-payscale-pay-type').html(rate_label);
                }                
            },
        });
        //compensationHideShow();
        //setDefaultEmpCommissionValue();
    });

    $(function () {
        $('.phone_number').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

    });
</script>