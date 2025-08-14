<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.1/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<style>
    table.dataTable.no-footer {
        border-bottom: 0px solid #dee2e6 !important;
    }

    table.dataTable thead th,
    table.dataTable thead td,
    table.dataTable tbody td {
        padding: 6px !important;
    }

    table.dataTable>thead>tr>th {
        border-bottom: 1px solid lightgray !important;
    }

    .dataTables_length,
    .dataTables_filter {
        display: none;
    }

    .display_none {
        display: none;
    }

    .fw-normal {
        font-weight: 500 !important;
    }

    .addCommissionOption {
        margin-top: -12px;
    }

    .hideInput {
        color: #ffffff00;
        background: #ffffff00;
        border: none;
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #6a4a86;
    }
</style>

<div class="modal fade nsm-modal fade" id="edit_employee_modal" tabindex="-1"
    aria-labelledby="edit_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="updatePersonalInfoForm">
            <input type="hidden" name="id" value="<?php echo $employee->id; ?>">
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
                            <input type="text" name="FName" class="nsm-field form-control" required
                                value="<?php echo $employee->FName; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                            <input type="text" name="LName" class="nsm-field form-control" required
                                value="<?php echo $employee->LName; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                            <input type="text" name="mobile" placeholder="xxx-xxx-xxxx" maxlength="12" id="mobile"
                                class="nsm-field form-control mobile-number" value="<?php echo $employee->mobile; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                            <input type="text" name="phone" placeholder="xxx-xxx-xxxx" maxlength="12"
                                class="nsm-field form-control phone-number" value="<?php echo $employee->phone; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">nSmart App Login Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Social Security number</label>
                            <input type="text" name="ssn" placeholder="xxx-xxx-3075" maxlength="12"
                            class="nsm-field form-control ssn-number" value="<?php echo $employee->ssn; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Birth date</label>
                            <input type="date" class="nsm-field form-control" id="birth-date" name="birthdate"
                                value="<?php echo $employee->birthdate; ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                            <div class="nsm-field-group icon-right">
                                <input type="email" class="nsm-field form-control" id="employeeEmail" name="email"
                                    required value="<?php echo $employee->email; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Username</label>
                            <div class="nsm-field-group icon-right">
                                <input type="text" class="nsm-field form-control" id="employeeUsername" name="username"
                                    required value="<?php echo $employee->username; ?>">
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
                                value="<?php echo $employee->address; ?>">
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">State</label>
                            <input type="text" class="nsm-field form-control" name="state"
                                value="<?php echo $employee->state; ?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
                            <input type="text" class="nsm-field form-control" name="postal_code"
                                value="<?php echo $employee->postal_code; ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="1" <?php echo $employee->status == 1 ? 'selected' : ''; ?>>Active
                                </option>
                                <option value="0" <?php echo $employee->status == 0 ? 'selected' : ''; ?>>Inactive
                                </option>
                            </select>
                        </div>
                      
                        <div class="col-12">
                            <div class="form-check form-switch nsm-switch d-inline-block me-3">
                                <input class="form-check-input" type="checkbox" id="app_access"
                                    <?php echo ($employee->has_app_access) ? "checked" : ""; ?>>
                                <input type="hidden" name="has_app_access"
                                    value="<?php echo ($employee->has_app_access) ? 1 : 0; ?>">
                                <label class="form-check-label" for="app_access">App Access</label>
                            </div>
                            <div class="form-check form-switch nsm-switch d-inline-block">
                                <input class="form-check-input" type="checkbox" id="web_access"
                                    <?php echo ($employee->has_web_access) ? "checked" : ""; ?>>
                                <input type="hidden" name="has_web_access"
                                    value="<?php echo ($employee->has_web_access) ? 1 : 0; ?>">
                                <label class="form-check-label" for="web_access">Web Access</label>
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
                        <div class="col-md-12 mb-3">
                            <h4 class="fw-bold employee_name">Let's get down to <?= $employee->FName ?>'s job specifics
                            </h4>
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
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <!-- <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button> -->
                    <button type="submit" name="btn_modal_save" id="btn-modal-employment-details"
                        class="nsm-button primary btn-modal-employment-details">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="edit-tax-withholdings-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="saveTaxwithholdingForm">
                <input type="hidden" name="employee_id" value="<?php echo $employee->id; ?>">
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
                                                        placeholder="0.00"
                                                        value="<?php echo $taxWithholdingData->claim_dependents_deduction; ?>">
                                                </div>
                                                <div class="col-md-12 mb-3 form_2020_input">
                                                    <strong class="text-muted">Other adjustments</strong>
                                                    <div class="row mt-2">
                                                        <div class="col-md-3 form_2020_input">
                                                            <label>Other income</label>
                                                            <input class="form-control mt-1 w-auto" name="other_income"
                                                                type="number" placeholder="0.00"
                                                                value="<?php echo $taxWithholdingData->other_income; ?>">
                                                        </div>
                                                        <div class="col-md-3 form_2020_input">
                                                            <label>Deductions</label>
                                                            <input class="form-control mt-1 w-auto" name="deductions"
                                                                type="number" placeholder="0.00"
                                                                value="<?php echo $taxWithholdingData->deductions; ?>">
                                                        </div>
                                                        <div class="col-md-3 form_2020_input">
                                                            <label>Extra withholding</label>
                                                            <input class="form-control mt-1 w-auto"
                                                                name="form2020_extra_withholding" type="number"
                                                                placeholder="0.00"
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
                                                        placeholder="0.00"
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

<div class="modal fade" id="employeePayTypesModal" data-bs-backdrop="static" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Pay scale settings</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body pt-3">
                <form class="payscale_form">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Setup pay scale for employee <u class="fw-bold"><?php echo "$employee->FName $employee->LName"; ?></u></h6>
                        </div>
                        <div class="col-md-12 d-none">
                            <input type="text" name="employee_id" class="form-control hideInput" value="<?php echo $employee->id; ?>">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mb-1" for="">Pay scale</label>
                            <select class="form-select payscale_select" name="payscale_option" required>
                                <option value="none">Not Specified</option>
                                <option value="commission_only">Commission Only</option>
                                <option value="base_hourly_rate">Base Hourly Rate</option>
                                <option value="base_daily_rate">Base Daily Rate</option>
                                <option value="base_weekly_rate">Base Weekly Rate</option>
                                <option value="yearly_salary">Yearly Salary</option>
                                <option value="monthly_salary">Monthly Salary</option>

                                <!-- removed: redundancy -->
                                <!-- <option value="compensation_hourly_rate">Compensation Hourly Rate</option> -->
                                <!-- <option value="compensation_flat_amount">Compensation Flat Amount</option> -->

                                <option value="part_time_hourly">Part Time Hourly</option>
                                <option value="temp_services">Temp Services</option>
                                
                                <!-- removed: Needs 3rd party to Pay which is difficult to implement for now-->
                                <!-- <option value="outside_source_payroll">Outside Source Payroll</option> -->

                                <option value="job_type_base_install">Job Type Base Install</option>
                                <option value="job_type_base_service">Job Type Base Service</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2 payscaleValueContainer display_none">
                            <label class="mb-1" for="">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text" id="dollarSign">$</span>
                                <input class="form-control payscale_value" type="number" step="any" placeholder="0.00" name="payscale_amount">
                            </div>
                        </div>
                        <div class="col-md-12 mt-4 commissionSettingsContainer display_none">
                            <label class="mb-1" for="">Commission Settings</label>
                            <button type="button" class="btn btn-sm btn-primary addCommissionOption fw-bold float-end"><i class="fas fa-plus"></i>&nbsp;Add</button>
                            <table class="commissionTable table table-hover table-bordered w-100">
                                <thead style="background: #00000008;">
                                    <tr>
                                        <th class="fw-normal">Name</th>
                                        <th class="fw-normal">Type</th>
                                        <th class="fw-normal">Value</th>
                                        <th style="width: 0;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="unspecified_commission">
                                        <td colspan="4"><i>No commission setup available...</i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
<div class="modal fade" id="payCommissionSummary" data-bs-backdrop="static" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Earnings Summary</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body pt-3">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="payscale_tab" data-bs-toggle="tab" data-bs-target="#payscale_container" type="button" role="tab" aria-controls="home" aria-selected="true">Pay scale</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="commission_tab" data-bs-toggle="tab" data-bs-target="#commission_container" type="button" role="tab" aria-controls="profile" aria-selected="false">Commission</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payroll_tab" data-bs-toggle="tab" data-bs-target="#payroll_container" type="button" role="tab" aria-controls="profile" aria-selected="false">Payroll</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="payscale_container" role="tabpanel" aria-labelledby="payscale_tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover table-bordered w-100 mb-0 payscaleSummaryTable">
                                            <thead style="background: #00000008;">
                                                <tr>
                                                    <th class="fw-normal">Pay scale</th>
                                                    <th class="fw-normal">Amount</th>
                                                    <th class="fw-normal">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="commission_container" role="tabpanel" aria-labelledby="commission_tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover table-bordered w-100 mb-0 commissionSummaryTable">
                                            <thead style="background: #00000008;">
                                                <tr>
                                                    <th class="fw-normal">Commission</th>
                                                    <th class="fw-normal">Reference No.</th>
                                                    <th class="fw-normal">Status</th>
                                                    <th class="fw-normal">Amount</th>
                                                    <th class="fw-normal">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payroll_container" role="tabpanel" aria-labelledby="commission_tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover table-bordered w-100 mb-0 payrollSummaryTable">
                                            <thead style="background: #00000008;">
                                                <tr>
                                                    <th class="fw-normal">Period</th>
                                                    <th class="fw-normal">Total Amount</th>
                                                    <th class="fw-normal">Status</th>
                                                    <th class="fw-normal">Check ID</th>
                                                    <th class="fw-normal">Last Updated</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
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

<div class="modal fade nsm-modal" id="edit-pay-types-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-pay-types-form">
            <input type="hidden" name="eid" value="<?= $employee->id; ?>" />
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Pay types</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <h4 class="fw-bold employee_name">Please select a payscale for <?= $employee->FName ?>?</h4>
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
    <div class="modal-dialog modal-lg">
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
                            <h4 class="fw-bold ">What deductions, contributions, or garnishment does
                                <?= $employee->FName ?>'s have?</h4>
                        </div>
                        <div class="col-md-12 mt-5 mb-5">
                            <h5><strong>Deductions and contributions</strong></h5>
                            <p class="text_value">These may include health insurance, retirement plan, loan repayments,
                                and more.</p>
                        </div>
                        <div class="col-md-12">
                            <div class="row deductions_contributions_list_items">
                                <?php 
                                        foreach($dc_data as $dc){
                                            ?>
                                <div class="col-md-12 mb-3">
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

                                            <a class="nsm-button border-0  pointerCursor update_deductions_contributions"
                                                style="font-size: 16px" data-val="<?= $dc->id ?>"><i
                                                    class="bx bx-fw bx-pencil"></i></a>

                                            <a class="nsm-button border-0  pointerCursor delete-deductions-and-contributions"
                                                style="font-size: 16px" data-val="<?= $dc->id ?>"
                                                data-employee_id="<?= $dc->employee_id ?>"><i
                                                    class="bx bx-fw bx-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php

                                        }
                                    ?>


                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-8">
                                        <button type="button"
                                            class="nsm-button add-deduction-and-contributions-modal"><i
                                                class="bx bx-fw bx-plus"></i> Add deductions/contribution</button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close " class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" name="btn_modal_save" data-bs-dismiss="modal"
                        class="nsm-button success">Done</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="update-deductions-and-contributions" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="update_deductions_contributions_form">
            <input class="form-control" name="employee_id" type="hidden" value="<?= $employee->id; ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title ">Update deduction/contribution</span>
                    <button type="button" name="btn_modal_close"><i
                            class='bx bx-fw bx-x m-0 update-deductions-and-contributions-close'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="deductions-contribution-section">
                            <div class="col-12 col-md-6">
                                <input type="hidden" name="id" class="update_deduction_id">
                                <select class="nsm-field form-select edit-deductions-and-contributions-name"
                                    name="deductions_contribution_name" style="display:none" >
                                    <option value="deductions_contributions">Add Deductions/contributions</option>
                                </select>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label>Deductions/contribution type</label>
                                        <select
                                            class="nsm-field form-select deduction_contribution_type update_deduction_contribution_type"
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
                            <div class="edit-deduction-contribution-type-section">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label>Type</label>
                                            <select
                                                class=" nsm-field form-select edit_deduction_contribution_type update_deduction_type"
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
                                                <input class="form-control update_deduction_description"
                                                    name="description" type="text" step="any" required>
                                            </div>

                                            <div class="employee-deductions-section" style="display:none">
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <h6 class="fw-bold">Employee deductions</h6>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 edit-pay-type-container mb-3">
                                                            <label>Calculated as *</label>
                                                            <select
                                                                class="nsm-field form-select edit-emp-payscale update_deductions_calculated_as"
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
                                                            <input class="form-control update_deductions_amount"
                                                                name="deductions_amount" placeholder="$0" type="number"
                                                                step="any" min="0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <label>Annual maximum</label>
                                                    <input class="form-control update_annual_maximum"
                                                        name="annual_maximum" type="number" step="any" min="0">
                                                </div>
                                            </div>

                                            <div class="tax-option-section" style="display:none">
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <h6 class="fw-bold">Tax options</h6>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="mb-3">To avoid tax penalties, ask you plan administrator or check your plan documents to select the right option:</label>
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input update_tax_option" type="radio"
                                                                    name="tax_options" value="pretax">
                                                                <label class="form-check-label" ><strong>Pretax:</strong> Premium is deducted <strong>before</strong> taxes</label>
                                                            </div>

                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input update_tax_option" type="radio"
                                                                    name="tax_options" value="posttax">
                                                                <label class="form-check-label" ><strong>Post-tax:</strong> Premium is deducted <strong>after</strong> taxes</label>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cold-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="company-contribution-section"   >
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <h6 class="fw-bold mb-3">Company contribution</h6>
                                                    <label >We'll track your contributions, but it's your responsibility to pay your provider.</label>
                                                    
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 edit-pay-type-container mb-3">
                                                            <label>Calculated as *</label>
                                                            <select
                                                                class="nsm-field form-select edit-emp-payscale contribution_calculated_as2 update_contribution_calculated_as2"
                                                                name="contribution_calculated_as" >
                                                                <option value="None">None</option>
                                                                <option value="Flat amount">Flat amount</option>
                                                                <option value="Percent of gross pay">Percent of gross
                                                                    pay
                                                                </option>
                                                                <option value="Per hour worked">Per hour worked</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 edit-pay-type-container mb-3">
                                                            <label class="calculated_label2">Amount per paycheck
                                                                *</label>
                                                            <input class="form-control update_calculated_contribution_amount" name="calculated_contribution_amount"
                                                                placeholder="$0" type="number" step="any" min="0"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 edit-pay-type-container ">
                                                    <label class="calculated_as_label mb-3">Though this is an after tax deduction, the deduction amount
                                                        is based off of a percentage
                                                        of the employee's gross earnigs.
                                                    </label>

                                                </div>
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <label>Annual maximum</label>
                                                    <input class="form-control update_contribution_annual_maximum" name="contribution_annual_maximum" type="number"
                                                        step="any" min="0" disabled>
                                                </div>
                                            </div>
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
                                                <input class="form-control update_contributions_amount"
                                                    name="contributions_amount" type="number" step="any" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close"
                        class="nsm-button update-deductions-and-contributions-close">Close</button>
                    <button type="submit" name="btn_modal_save"
                        class="nsm-button primary btn_modal_save_deductions">Save</button>
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
                    <span class="modal-title content-title ">Add deduction/contribution</span>
                    <button type="button" name="btn_modal_close" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0 edit-deductions-contributions-close-modal'></i></button>
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
                        <div class="deductions-contribution-section deductions-contribution-section-add"
                            style="display:none">
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
                                            <select
                                                class=" nsm-field form-select edit_deduction_contribution_type edit_deduction_contribution_type_add"
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
                                                            <select
                                                                class="nsm-field form-select edit-emp-payscale contribution_calculated_as"
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
                                                            <label class="calculated_label">Amount per paycheck
                                                                *</label>
                                                            <input class="form-control" name="deductions_amount"
                                                                placeholder="$0" type="number" step="any" min="0"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 edit-pay-type-container ">
                                                    <label class="calculated_as_label mb-3">Though this is an after tax deduction, the deduction amount
                                                        is based off of a percentage
                                                        of the employee's gross earnigs.
                                                    </label>

                                                </div>
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <label>Annual maximum</label>
                                                    <input class="form-control" name="annual_maximum" type="number"
                                                        step="any" min="0">
                                                </div>
                                            </div>

                                            <div class="tax-option-section" style="display:none">
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <h6 class="fw-bold">Tax options</h6>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="mb-3">To avoid tax penalties, ask you plan administrator or check your plan documents to select the right option:</label>
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tax_options" value="pretax">
                                                                <label class="form-check-label" ><strong>Pretax:</strong> Premium is deducted <strong>before</strong> taxes</label>
                                                            </div>

                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tax_options" value="posttax">
                                                                <label class="form-check-label" ><strong>Post-tax:</strong> Premium is deducted <strong>after</strong> taxes</label>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>

                                    <div class="cold-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="company-contribution-section"   >
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <h6 class="fw-bold mb-3">Company contribution</h6>
                                                    <label >We'll track your contributions, but it's your responsibility to pay your provider.</label>
                                                    
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 edit-pay-type-container mb-3">
                                                            <label>Calculated as *</label>
                                                            <select
                                                                class="nsm-field form-select edit-emp-payscale contribution_calculated_as2"
                                                                name="contribution_calculated_as" >
                                                                <option value="None">None</option>
                                                                <option value="Flat amount">Flat amount</option>
                                                                <option value="Percent of gross pay">Percent of gross
                                                                    pay
                                                                </option>
                                                                <option value="Per hour worked">Per hour worked</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 edit-pay-type-container mb-3">
                                                            <label class="calculated_label2">Amount per paycheck
                                                                *</label>
                                                            <input class="form-control update_calculated_contribution_amount" name="calculated_contribution_amount"
                                                                placeholder="$0" type="number" step="any" min="0"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 edit-pay-type-container ">
                                                    <label class="calculated_as_label mb-3">Though this is an after tax deduction, the deduction amount
                                                        is based off of a percentage
                                                        of the employee's gross earnigs.
                                                    </label>

                                                </div>
                                                <div class="col-12 edit-pay-type-container mb-3">
                                                    <label>Annual maximum</label>
                                                    <input class="form-control update_contribution_annual_maximum" name="contribution_annual_maximum" type="number"
                                                        step="any" min="0" placeholder="$0" disabled>
                                                </div>
                                            </div>
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
                    <button type="button" name="btn_modal_close "
                        class="nsm-button edit-deductions-contributions-close-modal">Close</button>
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
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="mb-2" for="notes">Notes for
                                <?php echo "$employee->FName $employee->LName" ?></label>
                            <textarea name="notes" id="notes"
                                class="form-control nsm-field"><?php echo $pay_details->notes ?></textarea>
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
    $(document).ready(function () {
        const payscale_with_value = [
            "base_hourly_rate",
            "base_daily_rate",
            "base_weekly_rate",
            "yearly_salary",
            "monthly_salary",
            // "compensation_hourly_rate", removed bcoz of redundancy
            // "compensation_flat_amount", removed bcoz of redundancy
            "part_time_hourly",
            "temp_services",
            "outside_source_payroll",
            "job_type_base_install",
            "job_type_base_service",
        ];

        const commissionNameOptions = `
            <option value="per_job_install">Per Job Install</option>
            <option value="per_job_service">Per Job Service</option>
        `;

        const commissionTypeOptions = `
            <option value="net_percentage">Net Percentage</option>
            <option value="gross_percentage">Gross Percentage</option>
            <option value="fixed_amount">Fixed Amount</option>
        `;

        function fetchSettings() {
            $.ajax({
                type: 'POST',
                url: `${window.origin}/payscale/getPayscaleCommissionSettings`,
                data: { employee_id: <?php echo $employee->id; ?> },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        const payscale = response.payscale || {};
                        const payscaleName = payscale.payscale_name || 'none';
                        $('.payscale_select').val(payscaleName).trigger('change');

                        if (payscale_with_value.includes(payscaleName)) {
                            const amount = payscale.payscale_amount ?? '';
                            $('input[name="payscale_amount"]').val(amount);
                        } else {
                            $('input[name="payscale_amount"]').val('');
                        }

                        let payRateText = "";
                        if (payscaleName === "none") {
                            payRateText = "<i class='text-muted'>Not Specified</i>";
                        } else if (payscaleName === "commission_only") {
                            payRateText = "Commission Only";
                        } else {
                            const formattedName = ucwords(payscaleName.replace(/_/g, ' '));
                            const amount = payscale.payscale_amount ?? '0.00';
                            payRateText = `${formattedName} <small class='text-muted'>(\$${amount})</small>`;
                        }
                        $('#emp-pay-rate').html(payRateText);

                        const commissions = Array.isArray(response.commissions) ? response.commissions : [];
                        const tbody = $('.commissionTable tbody');
                        const commissionListContainer = $('#employee_commission_list_data');

                        tbody.empty();
                        commissionListContainer.empty();

                        if (commissions.length > 0) {
                            commissions.forEach(function(item) {
                                const commissionName = item.commission_name || 'per_job_install';
                                const commissionType = item.commission_type || 'net_percentage';
                                const commissionValue = item.commission_value ?? '';

                                const row = `
                                    <tr>
                                        <td>
                                            <select class="form-select border-0" name="commission_name[]" required>
                                                ${commissionNameOptions}
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select border-0" name="commission_type[]" required>
                                                ${commissionTypeOptions}
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control border-0" type="number" step="any" placeholder="0.00" name="commission_amount[]" value="${commissionValue}" required>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-danger border-0 removeCommissionOption"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                `;
                                tbody.append(row);
                                tbody.find('tr:last select[name="commission_name[]"]').val(commissionName);
                                tbody.find('tr:last select[name="commission_type[]"]').val(commissionType);

                                let commissionTypeText = commissionType.replace(/_/g, ' ');
                                commissionTypeText = ucwords(commissionTypeText);

                                let commissionValueText = commissionType.includes('percentage') 
                                    ? `${commissionValue}%` 
                                    : `\$${commissionValue}`;

                                const commissionNameText = ucwords(commissionName.replace(/_/g, ' '));

                                const listItem = `
                                    <div class="col-12">
                                        <p class="text_value mb-1">${commissionNameText} — ${commissionTypeText}: ${commissionValueText}</p>
                                    </div>
                                `;
                                commissionListContainer.append(listItem);
                            });
                        } else {
                            tbody.append(`
                                <tr class="unspecified_commission">
                                    <td colspan="4"><i>No commission setup available...</i></td>
                                </tr>
                            `);
                            commissionListContainer.html("<i class='text-muted'>No commissions set</i>");
                        }

                    } else {
                        console.log('No data found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        } 
        fetchSettings();

        function ucwords(str) {
            return str.replace(/\b\w/g, function(l) { return l.toUpperCase(); });
        }

        function formDisabler(selector, state) {
            const element = $(selector);
            const submitButton = element.find('button[type="submit"]');
            element.find("input, button, textarea, select").prop('disabled', state);

            if (state) {
                element.find('a').hide();
                if (!submitButton.data('original-content')) {
                    submitButton.data('original-content', submitButton.html());
                }
                submitButton.prop('disabled', true).html('Processing...');
            } else {
                element.find('a').show();
                const originalContent = submitButton.data('original-content');
                if (originalContent) {
                    submitButton.prop('disabled', false).html(originalContent);
                }
            }
        }

        $(document).on('change', '.payscale_select', function() {
            const payscale = $(this).val();

            if (payscale_with_value.includes(payscale)) {
                $('.payscale_value').attr('required', '');
                $('.payscaleValueContainer').fadeIn('fast');
            } else {
                $('.payscale_value').removeAttr('required');
                $('.payscaleValueContainer').hide();
            }

            if (payscale === "none") {
                $('.commissionSettingsContainer').hide();
            } else {
                $('.commissionSettingsContainer').fadeIn('fast');
            }
        });

        $(document).on('click', '.addCommissionOption', function() {
            const unspecified_commission = $('.unspecified_commission').length;
            const optionContent = `
                <tr>
                    <td>
                        <select class="form-select border-0" name="commission_name[]" required>
                            ${commissionNameOptions}
                        </select>
                    </td>
                    <td>
                        <select class="form-select border-0" name="commission_type[]" required>
                            ${commissionTypeOptions}
                        </select>
                    </td>
                    <td>
                        <input class="form-control border-0" type="number" step="any" placeholder="0.00" name="commission_amount[]" required>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger border-0 removeCommissionOption"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;

            if (unspecified_commission == 1) {
                $('.unspecified_commission').remove();
                $('.commissionTable > tbody').append(optionContent);
            } else {
                $('.commissionTable > tbody').append(optionContent);
            }
        });

        $(document).on('click', '.removeCommissionOption', function() {
            $(this).closest('tr').remove();

            const commissionTableLength = $('.commissionTable > tbody > tr').length;
            if (commissionTableLength == 0) {
                $('.commissionTable > tbody').append(`
                    <tr class="unspecified_commission">
                        <td colspan="4"><i>No commission setup available...</i></td>
                    </tr>
                `);
            }
        });

        $(document).on('submit', '.payscale_form', function(e) {
            e.preventDefault();
            const data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: base_url + 'payscale/setPayscaleCommissionSettings',
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    formDisabler('.payscale_form', true); 
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "Settings Saved!",
                            html: "Payscale & Commission settings have been saved successfully.",
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Failed to Save!",
                            html: "An error occurred while saving the settings.",
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                        });
                    }
                    formDisabler('.payscale_form', false);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Failed to Save!",
                        html: "An error occurred while saving the settings.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                    formDisabler('.payscale_form', false);
                }
            });
        });

        const payscaleSummaryTable = $('.payscaleSummaryTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": `${window.origin}/Payscale/getPayscaleSummaryServerside/<?php echo $employee->id; ?>`,
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
        });

        const commissionSummaryTable = $('.commissionSummaryTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": `${window.origin}/Payscale/getCommissionSummaryServerside/<?php echo $employee->id; ?>`,
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
        });

        const payrollSummaryTable = $('.payrollSummaryTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": `${window.origin}/Payscale/getPayrollSummaryServerside/<?php echo $employee->id; ?>`,
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
        });

        $(document).on('click', '#payscale_tab', function () {
            payscaleSummaryTable.ajax.reload(null, false);
        });

        $(document).on('click', '#commission_tab', function () {
            commissionSummaryTable.ajax.reload(null, false);
        });

        $(document).on('click', '#payroll_tab', function () {
            payrollSummaryTable.ajax.reload(null, false);
        });

        $('#payCommissionSummary').on('shown.bs.modal', function () {
            payscaleSummaryTable.ajax.reload(null, false);
            commissionSummaryTable.ajax.reload(null, false);
            payrollSummaryTable.ajax.reload(null, false);
        });
    });

// =================================

$('select > option[data-custom="form_2019"], .form_2019_input').hide();
$('.form_2019_input > input').hide().attr('disabled', '');

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

    $('#app_access').change(function(e) {
        e.preventDefault();
        if ($(this).prop('checked') == true) {
            $('input[name="has_app_access"]').val(1);
        } else {
            $('input[name="has_app_access"]').val(0);
        }
    });

    $('#web_access').change(function(e) {
        e.preventDefault();
        if ($(this).prop('checked') == true) {
            $('input[name="has_web_access"]').val(1);
        } else {
            $('input[name="has_web_access"]').val(0);
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

    $('#updatePersonalInfoForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);

        $.ajax({
            type: "POST",
            url: base_url +
                "/accounting/employees/update_employee_data/personal_information",
            data: form.serialize(),
            beforeSend: function() {
                formDisabler(form, true);
            },
            success: function(response) {
                formDisabler(form, false);
                const name = $('input[name="FName"]').val() + " " + $('input[name="LName"]')
                    .val();
                const email = $('input[name="email"]').val();
                const birthdate = moment($('input[name="birthdate"]').val()).format('L');
                const address = $('input[name="address"]').val();
                const state = $('input[name="state"]').val();
                const postalCode = $('input[name="postal_code"]').val();
                const formattedAddress = `${address},<br>${state} ${postalCode}`;
                const phone = $('input[name="email"]').val();
                const status = ($('select[name="status"]').val() == 1) ? "Active" :
                    "Inactive";

                $('.name_text').text(name);
                $('.email_text').text(email);
                $('.birthdate_text').text(birthdate);
                $('.address_text').html(formattedAddress);
                $('.phone_text').text(phone);
                $('.status_text').text(status);
                Swal.fire({
                    icon: "success",
                    title: "Personal Information",
                    html: "Data has been updated successfully!",
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

    $('#saveTaxwithholdingForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);

        $.ajax({
            type: "POST",
            url: window.origin + "/accounting/employees/update_employee_data/tax_withholding",
            data: form.serialize(),
            beforeSend: function() {
                formDisabler(form, true);
            },
            success: function(response) {
                formDisabler(form, false);
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
                $('.tax_exemptions_text').html(text.length ? text.join('<br>') :
                    '<i>Not specified</i>');
                $('.filing_status_text').text($('#filing_status').val());
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
            url: window.origin + "/accounting/employees/update_employee_data/employee_notes",
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

    $('.ssn-number').keydown(function(e) {
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
                        var employee_number = employee_details[index]
                            .employee_number;
                        var hire_date = employee_details[index].hire_date;
                        var employee_status = employee_details[index]
                            .employee_status;
                        var worker_company_class = employee_details[index]
                            .worker_company_class;
                        var employee_title = employee_details[index].employee_title;

                        $(`#emp-details-worker-company-class`).text(
                            worker_company_class);
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
                $('#btn-modal-employment-details').html(
                    '<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    function load_employee_commission_list(eid){
        $.ajax({
            url: base_url + 'accounting/employees/_employee_commission_settings',
            method: 'post', 
            data: {eid:eid}, 
            success: function (html) {
                $('#employee_commission_list_data').html(html);
            },
            beforeSend: function() {
                $('#employee_commission_list_data').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });  
    }

    $('#edit-pay-types-form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'accounting/employees/_update_employee_pay_type',
            dataType: 'json',
            data: $('#edit-pay-types-form').serialize(),
            success: function(data) {                
                $('#btn-edit-pay-type').html('Save');                   
                if (data.is_success) {
                    $('#edit-pay-types-modal').modal('hide');
                    load_employee_commission_list(data.eid);  
                    $('#emp-pay-rate').html(data.pay_rate);          
                }else{
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
                $('#btn-edit-pay-type').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

})
</script>