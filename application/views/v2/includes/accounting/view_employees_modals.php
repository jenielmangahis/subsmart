<div class="modal fade nsm-modal fade" id="edit_employee_modal" tabindex="-1"
    aria-labelledby="edit_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit_employee_form"
            action="<?php echo base_url(); ?>accounting/employees/update/personal-info/<?= $employee->id ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_employee_container" style="overflow-x: auto;max-height: 800px;">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Basic Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                            <input type="text" name="first_name" class="nsm-field form-control" required
                                value="<?= $employee->FName; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                            <input type="text" name="last_name" class="nsm-field form-control" required
                                value="<?= $employee->LName; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                            <input type="text" name="mobile" placeholder="xxx-xxx-xxxx" maxlength="12" id="mobile"
                                class="nsm-field form-control mobile-number" value="<?= $employee->mobile; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                            <input type="text" name="phone" placeholder="xxx-xxx-xxxx" maxlength="12"
                                class="nsm-field form-control phone-number" value="<?= $employee->phone; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">nSmart App Login Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                            <div class="nsm-field-group icon-right">
                                <input type="email" class="nsm-field form-control" id="employeeEmail" name="email"
                                    required value="<?= $employee->email; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Username</label>
                            <div class="nsm-field-group icon-right">
                                <input type="text" class="nsm-field form-control" id="employeeUsername" name="username"
                                    required value="<?= $employee->username; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Other Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                            <input type="text" class="nsm-field form-control" name="address"
                                value="<?= $employee->address; ?>">
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">State</label>
                            <input type="text" class="nsm-field form-control" name="state"
                                value="<?= $employee->state; ?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
                            <input type="text" class="nsm-field form-control" name="postal_code"
                                value="<?= $employee->postal_code; ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                            <select class="nsm-field form-select" name="status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="1" <?= $employee->status == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?= $employee->status == 0 ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Birth date</label>
                            <div class="nsm-field-group calendar">
                                <?php
                                $birthdate = 'Not Specified';
                                if ($employee->birthdate != '0000-00-00' || $employee->birthdate == null) {
                                    $birthdate = date("m/d/Y", strtotime($employee->birthdate));
                                }
                                ?>
                                <input type="text" class="form-control nsm-field date" id="birth-date" name="birth_date"
                                    value="<?php echo $birthdate; ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch nsm-switch d-inline-block me-3">
                                <?php
                                $is_checked_app = '';
                                if ($employee->has_app_access) {
                                    $is_checked_app = 'checked';
                                }

                                $is_checked_web = '';
                                if ($employee->has_web_access) {
                                    $is_checked_web = 'checked';
                                }
                                ?>
                                <input class="form-check-input" type="checkbox" id="app_access" name="app_access"
                                    <?php echo $is_checked_app; ?>>
                                <label class="form-check-label" for="app_access">App Access</label>
                            </div>
                            <div class="form-check form-switch nsm-switch d-inline-block">
                                <input class="form-check-input" type="checkbox" id="web_access" name="web_access"
                                    <?php echo $is_checked_web; ?>>
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
                                    <div class="nsm-img-upload"
                                        style="background-image: url('<?= base_url('/uploads/users/user-profile/' . $employee->profile_img); ?>');">
                                        <span class="nsm-upload-label disable-select">Drop or click image to
                                            upload</span>
                                        <input type="file" name="userfile" class="nsm-upload" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_status_modal" tabindex="-1"
    aria-labelledby="change_status_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form method="POST" id="edit-employee-status-form"
            action="<?php echo base_url(); ?>accounting/employees/update/status/<?= $employee->id ?>"
            enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee Status</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_employee_container" style="overflow-x: auto;max-height: 800px;">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                            <select class="nsm-field form-select" name="status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="1" <?= $employee->status == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?= $employee->status == 0 ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
    /**
     * Note: modal employee details
     */
?>
<div class="modal fade nsm-modal" id="edit-employment-details-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- <form method="POST" id="edit-employment-details-form" action="<?php echo base_url(); ?>accounting/employees/update/employment-details/<?= $employee->id ?>"> -->
            <form method="POST" id="edit-employment-details-form" action=""> 
            <input type="hidden" name="employee_id" value="<?= $employee->id ?>" />
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Employment details</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <h3>Let's get down to <?= $employee->FName ?>'s job specifics</h3>
                        </div>
                    </div>

                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="federal_withholding_panel">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#employment_details" aria-expanded="true"
                                    aria-controls="employment_details"> <strong>Employment Details</strong></button>
                            </h2>
                            <div id="employment_details" class="accordion-collapse collapse show"
                                aria-labelledby="employment_details_panel">
                                <div class="accordion-body">

                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2"
                                            for="employee_number">Employee Number</label>
                                        <input type="text" name="employee_number" class="nsm-field form-control"
                                            id="employee_number"
                                            value="<?= $employee->employee_number ? $employee->employee_number : '-'; ?>" />
                                    </div><br />                                

                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Hire date</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="form-control nsm-field date" id="hire-date"
                                                name="hire_date"
                                                value="<?= date("m/d/Y", strtotime($employee->date_hired)) ?>">
                                        </div>
                                    </div><br />
                                    <div class="col-12 work-location-grp">
                                        <label class="content-subtitle fw-bold d-block mb-2">Work location
                                            <!-- <a href="javascript:void(0)" onclick="javascript:addLocationForm()">(Add)</a></label> -->
                                            <select class="nsm-field form-select" id="work-location"
                                                name="work_location[]" multiple>
                                                <!-- <option value="" disabled selected>Select work location</option> -->
                                                <!-- <option value="add">&plus; Add new</option> -->
                                                <?php foreach ($worksites as $worksite) : ?>
                                                <?php
                                                    $selected = "";
                                                    if (in_array($worksite->id, $workLocations_ids)) {
                                                        $selected = "selected";
                                                    }
                                                    ?>
                                                <!-- <option value="<?= $worksite->id; ?>" <?= $employmentDetails->work_location_id == $worksite->id ? 'selected="selected"' : ''; ?>><?= $worksite->name; ?></option> -->
                                                <option <?php echo $selected; ?> value="<?= $worksite->id; ?>">
                                                    <?= $worksite->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                    </div><br />
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Title</label>
                                        <select class="nsm-field form-select" name="role" id="employee_role" required>
                                            <option value="" disabled>Select Title</option>
                                            <?php foreach ($roles as $r) : ?>
                                            <option value="<?= $r->id; ?>"
                                                <?= $r->id == $employee->role ? 'selected' : ''; ?>><?= $r->title; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div><br />
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold d-block mb-2">Workers' comp class</label>
                                        <input type="text" class="nsm-field form-control" id="workers-comp-class"
                                            name="workers_comp_class"
                                            value="<?= !empty($employmentDetails) ? $employmentDetails->workers_comp_class : '' ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="tax_exemptions_panel">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#right_and_permissions_collapse" aria-expanded="true"
                                    aria-controls="right_and_permissions_collapse"><strong>Rights & Permissions (Select
                                        Employee Role)</strong></button>
                            </h2>
                            <div id="right_and_permissions_collapse" class="accordion-collapse collapse show"
                                aria-labelledby="right_and_permissions_panel">
                                <div class="accordion-body">

                                    <div class="col-12" style="margin-bottom: 10px !important;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="role_7" value="7"
                                                name="user_type"
                                                <?= $employee->user_type == 7 ? 'checked="checked"' : ''; ?>>
                                            <label class="form-check-label" for="role_7">
                                                Admin
                                                <span class="content-subtitle d-block fst-italic">ALL Access</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px !important;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" id="role_1"
                                                name="user_type"
                                                <?= $employee->user_type == 1 ? 'checked="checked"' : ''; ?>>
                                            <label class="form-check-label" for="role_1">
                                                Office Manager
                                                <span class="content-subtitle d-block fst-italic">ALL except high
                                                    security file vault</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px !important;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="2" id="role_2"
                                                name="user_type"
                                                <?= $employee->user_type == 2 ? 'checked="checked"' : ''; ?>>
                                            <label class="form-check-label" for="role_2">
                                                Partner
                                                <span class="content-subtitle d-block fst-italic">ALL base on plan
                                                    type</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px !important;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="3" id="role_3"
                                                name="user_type"
                                                <?= $employee->user_type == 3 ? 'checked="checked"' : ''; ?>>
                                            <label class="form-check-label" for="role_3">
                                                Team Leader
                                                <span class="content-subtitle d-block fst-italic">No accounting or any
                                                    changes to company profile or deletion</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px !important;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="4" id="role_4"
                                                name="user_type"
                                                <?= $employee->user_type == 4 ? 'checked="checked"' : ''; ?>>
                                            <label class="form-check-label" for="role_4">
                                                Standard User
                                                <span class="content-subtitle d-block fst-italic">Cannot add or delete
                                                    employees, can not manage subscriptions</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px !important;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="5" id="role_5"
                                                name="user_type"
                                                <?= $employee->user_type == 5 ? 'checked="checked"' : ''; ?>>
                                            <label class="form-check-label" for="role_5">
                                                Field Sales
                                                <span class="content-subtitle d-block fst-italic">View only no
                                                    input</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-bottom: 10px !important;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="6" id="role_6"
                                                name="user_type"
                                                <?= $employee->user_type == 6 ? 'checked="checked"' : ''; ?>>
                                            <label class="form-check-label" for="role_6">
                                                Field Tech
                                                <span class="content-subtitle d-block fst-italic">App access only, no
                                                    Web access</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button> -->
                    <button type="submit" name="btn_modal_save" id="btn-modal-employment-details" class="nsm-button primary btn-modal-employment-details">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal" id="edit-tax-withholdings-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="saveTaxwithholdingForm">
                <div class="modal-header">
                    <span class="modal-title content-title">Tax withholdings</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h4 class="fw-bold employee_name"><?php echo "What are $employee->FName's withholdings?"; ?>
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <p class="fs-5"><?php echo "When was $employee->FName hired?"; ?></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check">
                                <input id="form_w4_2020" class="form-check-input" type="radio"
                                    name="withholding_certificate" value="form_2020"
                                    <?php echo ($taxWithholdingData->withholding_certificate == "form_2020") ? "checked" : "" ?>>
                                <label class="form-check-label" for="form_w4_2020">2020 or later (Form W-4)</label>
                            </div>
                            <div class="form-check">
                                <input id="form_w4_2019" class="form-check-input" type="radio"
                                    name="withholding_certificate" value="form_2019"
                                    <?php echo ($taxWithholdingData->withholding_certificate == "form_2019") ? "checked" : "" ?>>
                                <label class="form-check-label" for="form_w4_2019">2019 or earlier (Form W-4)</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="federal_withholding_panel">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#federal_withholding_collapse" aria-expanded="true"
                                            aria-controls="federal_withholding_collapse"> <strong>Federal
                                                withholding</strong></button>
                                    </h2>
                                    <div id="federal_withholding_collapse" class="accordion-collapse collapse show"
                                        aria-labelledby="federal_withholding_panel">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><?php echo "You can find the information for this section on $employee->FName's W-4 form."; ?>
                                                        <a class="fw-bold text-decoration-none"
                                                            href="https://drive.google.com/file/d/1Keip2AbW3V0jCGz0oZbCoz8DLU63CNZB/view?usp=sharing"
                                                            target="_blank">Need a blank W-4 form?</a>
                                                    </p>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <strong class="text-muted">Filing Status</strong>
                                                    <select id="filing_status" class="form-select mt-1 w-auto"
                                                        name="filing_status">
                                                        <!-- 2020 Form Options -->
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Single or Married Filing Separately") ? "selected" : "" ?>
                                                            value="Single or Married Filing Separately"
                                                            data-custom="form_2020">Single or Married Filing Separately
                                                        </option>
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Married Filing Jointly or Qualifying Widow(er)") ? "selected" : "" ?>
                                                            value="Married Filing Jointly or Qualifying Widow(er)"
                                                            data-custom="form_2020">Married Filing Jointly or Qualifying
                                                            Widow(er)</option>
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Head of Household") ? "selected" : "" ?>
                                                            value="Head of Household" data-custom="form_2020">Head of
                                                            Household</option>
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Exempt") ? "selected" : "" ?>
                                                            value="Exempt" data-custom="form_2020">Exempt</option>
                                                        <!-- 2019 Form Options -->
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Single") ? "selected" : "" ?>
                                                            value="Single" data-custom="form_2019">Single</option>
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Married") ? "selected" : "" ?>
                                                            value="Married" data-custom="form_2019">Married</option>
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Married, but withhold at higher Single rate") ? "selected" : "" ?>
                                                            value="Married, but withhold at higher Single rate"
                                                            data-custom="form_2019">Married, but withhold at higher
                                                            Single rate</option>
                                                        <option
                                                            <?php echo ($taxWithholdingData->filing_status == "Do not withhold (exempt)") ? "selected" : "" ?>
                                                            value="Do not withhold (exempt)" data-custom="form_2019">Do
                                                            not withhold (exempt)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-3 form_2020_input">
                                                    <input id="mark_w4" class="form-check-input" type="checkbox"
                                                        <?php echo ($taxWithholdingData->mark_w4 == 1) ? "checked" : ""; ?>>&nbsp;
                                                    <label class="text-muted"
                                                        for="mark_w4"><?php echo "Select yes if $employee->FName has marked this box on their W-4."; ?></label>
                                                    <input type="hidden" name="mark_w4"
                                                        value="<?php echo ($taxWithholdingData->mark_w4 == 1) ? 1 : 0; ?>">
                                                </div>
                                                <div class="col-md-12 mb-3 form_2020_input">
                                                    <strong class="text-muted">Claim dependent's deduction</strong>
                                                    <input class="form-control mt-1 w-auto"
                                                        name="claim_dependents_deduction" type="number"
                                                        placeholder="0.00" step="0.01"
                                                        value="<?php echo $taxWithholdingData->claim_dependents_deduction; ?>">
                                                </div>
                                                <div class="col-md-12 mb-3 form_2020_input">
                                                    <strong class="text-muted">Other adjustments</strong>
                                                    <div class="row mt-2">
                                                        <div class="col-md-3 form_2020_input">
                                                            <label>Other income</label>
                                                            <input class="form-control mt-1 w-auto" name="other_income"
                                                                type="number" placeholder="0.00" step="0.01"
                                                                value="<?php echo $taxWithholdingData->other_income; ?>">
                                                        </div>
                                                        <div class="col-md-3 form_2020_input">
                                                            <label>Deductions</label>
                                                            <input class="form-control mt-1 w-auto" name="deductions"
                                                                type="number" placeholder="0.00" step="0.01"
                                                                value="<?php echo $taxWithholdingData->deductions; ?>">
                                                        </div>
                                                        <div class="col-md-3 form_2020_input">
                                                            <label>Extra withholding</label>
                                                            <input class="form-control mt-1 w-auto"
                                                                name="form2020_extra_withholding" type="number"
                                                                placeholder="0.00" step="0.01"
                                                                value="<?php echo $taxWithholdingData->form2020_extra_withholding; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 form_2019_input">
                                                    <strong class="text-muted">Total number of allowances you are
                                                        claiming</strong>
                                                    <input class="form-control mt-1 w-auto"
                                                        name="total_number_allowances" type="number" placeholder="0"
                                                        value="<?php echo $taxWithholdingData->total_number_allowances; ?>">
                                                </div>
                                                <div class="col-md-12 mb-3 form_2019_input">
                                                    <strong class="text-muted">Extra withholding</strong>
                                                    <input class="form-control mt-1 w-auto"
                                                        name="form2019_extra_withholding" type="number"
                                                        placeholder="0.00" step="0.01"
                                                        value="<?php echo $taxWithholdingData->form2019_extra_withholding; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="tax_exemptions_panel">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#tax_exemptions_collapse" aria-expanded="true"
                                            aria-controls="tax_exemptions_collapse"><strong>Tax
                                                exemptions</strong></button>
                                    </h2>
                                    <div id="tax_exemptions_collapse" class="accordion-collapse collapse show"
                                        aria-labelledby="tax_exemptions_panel">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="text-muted">These are not common. Certain government
                                                        criteria must be met to take these exemptions.</p>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="futa_checkbox"
                                                            <?php echo ($taxWithholdingData->futa_status == 1) ? "checked" : ""; ?>>
                                                        <label class="form-check-label fw-bold"
                                                            for="futa_checkbox">FUTA</label>
                                                        <input type="hidden" name="futa_status"
                                                            value="<?php echo ($taxWithholdingData->futa_status == 1) ? 1 : 0; ?>">
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="ssmedi_checkbox"
                                                            <?php echo ($taxWithholdingData->ssmedi_status == 1) ? "checked" : ""; ?>>
                                                        <label class="form-check-label fw-bold"
                                                            for="ssmedi_checkbox">Social Security and Medicare</label>
                                                        <input type="hidden" name="ssmedi_status"
                                                            value="<?php echo ($taxWithholdingData->ssmedi_status == 1) ? 1 : 0; ?>">
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flsui_checkbox"
                                                            <?php echo ($taxWithholdingData->flsui_status == 1) ? "checked" : ""; ?>>
                                                        <label class="form-check-label fw-bold" for="flsui_checkbox">FL
                                                            SUI</label>
                                                        <input type="hidden" name="flsui_status"
                                                            value="<?php echo ($taxWithholdingData->flsui_status == 1) ? 1 : 0; ?>">
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
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade nsm-modal" id="edit-payment-method-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-payment-method-form"
            action="<?= base_url('/accounting/employees/update/payment-method/' . $employee->id) ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Select payment method</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>How would you like to pay <?= $employee->FName ?>?</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="payment-method">Payment method</label>
                            <select name="payment_method" id="payment-method" class="form-select nsm-field">
                                <option value="paper-check"
                                    <?= $pay_details->pay_method === 'paper-check' ? 'selected' : '' ?>>Paper check
                                </option>
                                <option value="direct-deposit"
                                    <?= $pay_details->pay_method === 'direct-deposit' ? 'selected' : '' ?>>Direct
                                    deposit</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="edit-pay-types-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-pay-types-form"
            action="<?= base_url('accounting/employees/update/pay-types/' . $employee->id) ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Pay types</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>Please select a payscale for <?= $employee->FName ?>?</h3>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                                    <select class="nsm-field form-select edit-emp-payscale" name="empPayscale" required>
                                        <option value="" disabled>Select payscale</option>
                                        <?php foreach ($payscale as $p) : ?>
                                        <option value="<?= $p->id; ?>"
                                            <?= $employee->payscale_id == $p->id ? 'selected="selected"' : ''; ?>>
                                            <?= $p->payscale_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 edit-pay-type-container">
                                    <label
                                        class="content-subtitle fw-bold d-block mb-2 edit-payscale-pay-type"><?= $salary_type_label; ?></label>
                                    <input class="form-control" name="salary_rate" type="number" step="any" min="0"
                                        value="<?= number_format($salary_rate, 2); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 mt-5">
                            <label class="content-title" style="display:inline-block;">Commission Settings</label>
                            <a class="nsm-button primary small btn-edit-add-new-commision" href="javascript:void(0);"><i
                                    class='bx bx-plus'></i> Add New</a>
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
                                    <?php foreach ($employeeCommissionSettings as $ecs) { ?>
                                    <tr>
                                        <td>
                                            <select class="nsm-field form-select" name="commission_setting_id[]">
                                                <?php foreach ($commissionSettings as $cs) { ?>
                                                <option value="<?= $cs->id; ?>"
                                                    <?= $ecs->commission_setting_id == $cs->id ? 'selected="selected"' : ''; ?>>
                                                    <?= $cs->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="nsm-field form-select" name="commission_setting_type[]">
                                                <?php foreach ($optionCommissionTypes as $key => $value) { ?>
                                                <option value="<?= $key; ?>"
                                                    <?= $ecs->commission_type == $key ? 'selected="selected"' : ''; ?>>
                                                    <?= $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><input type="number" step="any" name="commission_setting_value[]"
                                                class="nsm-field form-control" id=""
                                                value="<?= $ecs->commission_value; ?>" required /></td>
                                        <td><a class="nsm-button small btn-delete-commission-setting-row"
                                                style="display:block;" href="javascript:void(0);"><i
                                                    class='bx bx-trash'></i></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal" id="deduction_contributions_lists" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <form method="POST" id="edit-employment-details-form"
            action="<?php echo base_url(); ?>accounting/employees/update/employment-details/<?= $employee->id ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit deductions and contributions</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding: 20px">
                        <div class="col-12">
                            <h3>What deductions, contributions, or garnishment does <?= $employee->FName ?>'s have?</h3>
                        </div>
                        <div class="col-md-12 mt-5 mb-5">
                            <h5><strong>Deductions and contributions</strong></h5>
                            <p class="text_value">These may include health insurance, retirement plan, loan repayments,
                                and more.</p>
                        </div>
                        <div class="col-md-12">
                            <div class="row" >
                                <?php 
                                        foreach($dc_data as $dc){
                                            ?>
                                            <div class="col-md-8 mb-3">
                                                <div class="row" style="align-items:center">
                                                    <div class="col-md-9">
                                                        <p class="text_value">
                                                            <?= $dc->deduction_contribution_type.' - '.$dc->type?></p>
                                                        <strong class="text-muted"><?= $dc->description ?></strong>
                                                        <p class="text_value">
                                                            Deduction: $<?= number_format($dc->deductions_amount,0) ?>/paycheck ,
                                                            outsided
                                                            contribution: $<?= number_format($dc->contributions_amount,0) ?>,annual
                                                            maximum:
                                                            $<?= number_format($dc->annual_maximum,0) ?> </p>
                                                    </div>
                                                    <div class="col-md-3">

                                                        <a class="nsm-button border-0  pointerCursor update_deductions_contributions" style="font-size: 20px"
                                                         data-val="<?= $dc->id ?>"><i class="bx bx-fw bx-pencil"></i></a>

                                                            <a class="nsm-button border-0  pointerCursor edit-deductions-and-contributions" style="font-size: 20px"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit-deductions-and-contributions"
                                                            data-bs-backdrop="false"><i class="bx bx-fw bx-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php

                                        }
                                    ?>

                                <div class="col-md-12">

                                    <div class="col-md-4">
                                        <button type="button" class="nsm-button " data-bs-toggle="modal"
                                            data-bs-target="#edit-deductions-and-contributions"><i
                                                class="bx bx-fw bx-plus"></i> Add deductions/contribution</button>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" name="btn_modal_save" data-bs-dismiss="modal"
                        class="nsm-button success">Done</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal" id="edit-deductions-and-contributions" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="deductions_contributions_form">
            <input class="form-control" name="employee_id" type="hidden" value="<?= $employee->id; ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add deduction/contribution</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>Deductions/contribution</label>
                                    <select class="nsm-field form-select edit-deductions-and-contributions-name"
                                        name="deductions_contribution_name" required>
                                        <option value="">Select</option>
                                        <option value="deductions_contributions">Add Deductions/contributions</option>
                                    </select>
                                </div>



                            </div>
                        </div>
                        <div class="deductions-contribution-section" style="display:none">
                            <div class="col-12 col-md-6">
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <label>Deductions/contribution type</label>
                                        <select class="nsm-field form-select deduction_contribution_type"
                                            name="deduction_contribution_type" required>
                                            <option value="">Select</option>
                                            <option value="Flexible spending accounts">Flexible spending accounts
                                            </option>
                                            <option value="HSA plans">HSA plans</option>
                                            <option value="Other deductions">Other deductions</option>
                                            <option value="Health insurance">Health insurance</option>
                                            <option value="Retirement plans">Retirement plans</option>

                                        </select>
                                    </div>



                                </div>
                            </div>
                            <div class="edit-deduction-contribution-type-section" style="display:none">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label>Type</label>
                                            <select class=" nsm-field form-select edit_deduction_contribution_type"
                                                name="type" placeholder="" required>
                                                <option value="">Select one</option>
                                                <option value="401(k)">401(k)</option>
                                                <option value="401(k) Catch-up">401(k) Catch-up</option>
                                                <option value="403(b)">403(b)</option>
                                                <option value="403(b) Catch-up">403(b) Catch-up</option>
                                                <option value="After-tax Roth 401(k)">After-tax Roth 401(k)</option>
                                                <option value="After-tax Roth 401(k) Catch-up">After-tax Roth 401(k)
                                                    Catch-up
                                                </option>
                                                <option value="After-tax Roth 403(b)">After-tax Roth 403(b)</option>
                                                <option value="Company-only plan">Company-only plan</option>
                                                <option value="SARSEP">SARSEP</option>
                                                <option value="SARSEP Catch-up">SARSEP Catch-up</option>
                                                <option value="SIMPLE 401(k) Catch-up">SIMPLE 401(k) Catch-up</option>
                                                <option value="SIMPLE IRA">SIMPLE IRA</option>
                                                <option value="SIMPLE IRA Catch-up">SIMPLE IRA Catch-up</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="deduction-type-section " style="display:none">
                                    <div class="col-md-12 ">
                                        <div class="row">
                                            <div class="col-12 edit-pay-type-container mb-3">
                                                <label>Description (appears on paycheck) *</label>
                                                <input class="form-control" name="description" type="text" step="any"
                                                    required>
                                            </div>

                                            <div class="employee-deductions-section" style="display:none">
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <h6 class="fw-bold">Employee deductions</h6>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 edit-pay-type-container mb-3">
                                                            <label>Calculated as *</label>
                                                            <select class="nsm-field form-select edit-emp-payscale"
                                                                name="deductions_calculated_as" required>
                                                                <option value="None">None</option>
                                                                <option value="Flat amount">Flat amount</option>
                                                                <option value="Percent of gross pay">Percent of gross
                                                                    pay
                                                                </option>
                                                                <option value="Per hour worked">Per hour worked</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 edit-pay-type-container mb-3">
                                                            <label>Amount per paycheck *</label>
                                                            <input class="form-control" name="deductions_amount"
                                                                placeholder="$0" type="number" step="any" min="0"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <label>Annual maximum</label>
                                                    <input class="form-control" name="annual_maximum" type="number"
                                                        step="any" min="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-12 edit-pay-type-container mb-3">
                                                <h6 class="fw-bold">Company contribution</h6>
                                                <label for="">We'll track your contributions, but it's your
                                                    responsibility
                                                    to
                                                    pay your provider.</label>
                                            </div>
                                            <div class="col-6 edit-pay-type-container mb-3">
                                                <label>Calculated as *</label>
                                                <select class="nsm-field form-select edit-emp-payscale"
                                                    name="contribution_calculated_as" required>
                                                    <option value="None">None</option>
                                                    <option value="Flat amount">Flat amount</option>
                                                    <option value="Percent of gross pay">Percent of gross pay</option>
                                                    <option value="Per hour worked">Per hour worked</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 401_contribution_section" style="display:none">
                                        <div class="row">
                                            <div class="col-12 edit-pay-type-container mb-3">
                                                <h6 class="fw-bold">401(K) contributions from other employment</h6>
                                                <label for="">Enter an amount if the employee contributed to another
                                                    company's
                                                    401(k) plan during the current tax year.
                                                    inlcude both Roth and traditional cocntributions, minus any employer
                                                    matching
                                                </label>
                                            </div>
                                            <div class="col-6 edit-pay-type-container mb-3">
                                                <label>Amount</label>
                                                <input class="form-control" name="contributions_amount" type="number"
                                                    step="any" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save"
                        class="nsm-button primary btn_modal_save_deductions">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade nsm-modal" id="notes-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="saveNotesForm">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add notes</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="mb-2" for="notes">Notes for <?php echo "$employee->FName $employee->LName" ?></label>
                            <textarea name="notes" id="notes" class="form-control nsm-field"><?php echo $pay_details->notes ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="add-worksite-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="add-worksite-form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add work location</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control nsm-field" id="name" name="name" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="street">Street</label>
                            <input type="text" class="form-control nsm-field" id="street" name="street" required>
                        </div>
                        <div class="col-12 col-md-6 mt-2">
                            <label for="city">City</label>
                            <input type="text" class="form-control nsm-field" id="city" name="city" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control nsm-field" id="state" name="state" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="zip-code">ZIP code</label>
                            <input type="text" class="form-control nsm-field" id="zip-code" name="zip_code" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="leave-credits-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form method="POST" id="leave-credits-form" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Leave Credits</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($employeeLeaveCredits as $key => $value) { ?>
                        <div class="col-12 mb-2">
                            <label for=""><?= $value['leave_type']; ?></label>
                            <input type="number" min=0 value="<?= $value['leave_credits']; ?>"
                                class="form-control nsm-field" id="" name="leaveCredits[<?= $key; ?>]" required>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" id="btn-leave-credit"
                        class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$('select > option[data-custom="form_2019"], .form_2019_input').hide();
$('.form_2019_input > input').hide().attr('disabled', '');

function formDisabler(selector, state) {
    const element = $(selector);
    const submitButton = element.find('button[type="submit"]');

    if (state) {
        if (!submitButton.data('original-content')) {
            submitButton.data('original-content', submitButton.html());
        }
        submitButton.prop('disabled', true);
        submitButton.text('Processing...');
    } else {
        const originalContent = submitButton.data('original-content');
        if (originalContent) {
            submitButton.prop('disabled', false).html(originalContent);
        }
    }
}

function updateContent() {
    var text = [];

    if ($('#futa_checkbox').is(':checked')) {
        text.push('FUTA');
    }
    if ($('#ssmedi_checkbox').is(':checked')) {
        text.push('Social Security and Medicare');
    }
    if ($('#flsui_checkbox').is(':checked')) {
        text.push('FL SUI');
    }
    $('.tax_exemptions_text').html(text.length ? text.join('<br>') : '<i>Not specified</i>');
    $('.filing_status_text').text($('#filing_status').val());
}

$(function() {
    $('input[name="withholding_certificate"]').change(function(e) {
        const value = $(this).val();
        if (value == "form_2020") {
            $('select > option[data-custom="form_2020"]').fadeIn('fast');
            $('select > option[data-custom="form_2019"]').hide();
            $('#filing_status option').eq(0).prop('selected', true);
            $('.form_2020_input').fadeIn('fast');
            $('.form_2019_input').hide();
            $('.form_2020_input > input').show().removeAttr('disabled');
            $('.form_2019_input > input').hide().attr('disabled', '');
        } else {
            $('select > option[data-custom="form_2020"]').hide();
            $('select > option[data-custom="form_2019"]').fadeIn('fast');
            $('#filing_status option').eq(4).prop('selected', true);
            $('.form_2020_input').hide();
            $('.form_2019_input').fadeIn('fast');
            $('.form_2020_input > input').hide().attr('disabled', '');
            $('.form_2019_input > input').show().removeAttr('disabled');
        }
    });

    $('#mark_w4').change(function(e) {
        e.preventDefault();
        if ($(this).prop('checked') == true) {
            $('input[name="mark_w4"]').val(1);
        } else {
            $('input[name="mark_w4"]').val(0);
        }
    });


    $('#futa_checkbox').change(function(e) {
        e.preventDefault();
        if ($(this).prop('checked') == true) {
            $('input[name="futa_status"]').val(1);
        } else {
            $('input[name="futa_status"]').val(0);
        }
    });

    $('#ssmedi_checkbox').change(function(e) {
        e.preventDefault();
        if ($(this).prop('checked') == true) {
            $('input[name="ssmedi_status"]').val(1);
        } else {
            $('input[name="ssmedi_status"]').val(0);
        }
    });

    $('#flsui_checkbox').change(function(e) {
        e.preventDefault();
        if ($(this).prop('checked') == true) {
            $('input[name="flsui_status"]').val(1);
        } else {
            $('input[name="flsui_status"]').val(0);
        }
    });

    $('#saveTaxwithholdingForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);

        $.ajax({
            type: "POST",
            url: window.origin + "/accounting/employees/save_tax_withholding",
            data: form.serialize(),
            beforeSend: function() {
                formDisabler(form, true);
            },
            success: function(response) {
                formDisabler(form, false);
                updateContent();
                Swal.fire({
                    icon: "success",
                    title: "Tax withholding",
                    html: "Data has been saved successfully!",
                    showConfirmButton: true,
                    confirmButtonText: "Close",
                    showCloseButton: false,
                });
            },
            error: function(xhr, status, error) {
                formDisabler(form, false);
                console.error("Request failed:", status, error);
            }
        });
    });

    $('#saveNotesForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const notes = CKEDITOR.instances['notes'].getData()

        $.ajax({
            type: "POST",
            url: window.origin + "/accounting/employees/save_notes",
            data: form.serialize(),
            data: {
                notes: notes,
                user_id: <?php echo $employee->id; ?>,
            },
            beforeSend: function() {
                formDisabler(form, true);
            },
            success: function(response) {
                $('.employeeNotes').html(notes);
                formDisabler(form, false);
                updateContent();
                Swal.fire({
                    icon: "success",
                    title: "Notes",
                    html: "Data has been saved successfully!",
                    showConfirmButton: true,
                    confirmButtonText: "Close",
                    showCloseButton: false,
                });
            },
            error: function(xhr, status, error) {
                formDisabler(form, false);
                console.error("Request failed:", status, error);
            }
        });
    });

    $('.mobile-number').keydown(function(e) {
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
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <=
            105));
    });

    $('.phone-number').keydown(function(e) {
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
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <=
            105));
    });

    $('#leave-credits-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "accounting/employees/_update_leave_credits",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {
                $('#btn-leave-credit').html('Save');
                if (data.is_success) {
                    $('#leave-credits-modal').modal('hide');

                    var leave_credits = data.leave_credits;
                    $.each(leave_credits, function(index) {
                        console.log(leave_credits[index]);
                        var leave_id = leave_credits[index].lid;
                        var leave_value = leave_credits[index].value;
                        $(`#leave-credits-${leave_id}`).text(leave_value);
                    });

                    Swal.fire({
                        text: "Employee leave credits was successfully updated",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        //location.reload();    
                        //}
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {

                    });
                }
            },
            beforeSend: function() {
                $('#btn-leave-credit').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#edit-employment-details-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            //url: base_url + "accounting/employees/_update_leave_credits",
            url: base_url + "accounting/employees/_update_employment_details ",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(data) {
                $('#btn-modal-employment-details').html('Save');
                if (data.is_success) {
                    $('#edit-employment-details-modal').modal('hide');

                    var employee_details = data.employee_details;
                    $.each(employee_details, function(index) {
                        console.log(employee_details[index]);
                        var employee_number = employee_details[index].employee_number;      
                        var hire_date = employee_details[index].hire_date;   
                        var employee_status = employee_details[index].employee_status;
                        var worker_company_class = employee_details[index].worker_company_class;
                        var employee_title = employee_details[index].employee_title;
                        
                        $(`#emp-details-worker-company-class`).text(worker_company_class);
                        $(`#emp-details-employee-title`).text(employee_title);
                        $(`#emp-details-status`).text(employee_status);
                        $(`#emp-hire-date`).text(hire_date);  
                        $(`#emp-details-employee-number`).text(employee_number);                   
                    });

                    Swal.fire({
                        text: "Employee employment details was successfully updated",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            //location.reload();    
                        //}
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {

                    });
                }
            },
            beforeSend: function() {
                $('#btn-modal-employment-details').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });    

})
</script>