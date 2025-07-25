<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/view_employees_modals'); ?>
<style>
.select2-link {
    padding: 10px 10px;
    background: #cccccc;
}

.select2-link a {
    text-decoration: none !important;
    color: inherit !important;
}

.nav-link {
    color: black;
}

.employee_name_section {
    margin-top: 10px;
}

.employee_name {
    font-family: segoe UI;
    width: max-content;
}

.text_value {
    font-size: 16px;
}

.pointerCursor {
    cursor: pointer;
}

.employee_image_profile {
    height: 120px;
    width: 120px;
    object-fit: cover;
}

.employee_image_profile_edit {
    border-radius: 22px;
    position: absolute;
    left: 90px;
    top: 85px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/employees_subtabs'); ?>
    </div>
    <hr>

    <div class="row g-0">
        <div class="col-md-12 mb-3">
            <div class="float-start">
                <div class="row">
                    <div class="col">
                        <div class="position-relative">
                            <img class="rounded-circle employee_image_profile"
                                src="<?php echo !empty($employee->profile_img) ? userProfileImage($employee->id) : '/uploads/users/default.png' ?>">
                            <!-- <button class="btn btn-secondary btn-sm border-0 employee_image_profile_edit"><i class="bx bxs-pencil"></i></button> -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="employee_name_section">
                            <h2 class="m-0 fw-bold employee_name name_text"><?php echo "$employee->FName $employee->LName"; ?>
                            </h2>
                            <span class="status_text"><?php echo "$employee->status_text"; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-end"></div>
        </div>
        <div class="col-md-12 mb-3">
            <nav class="mb-3">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-profile" role="tab">Profile</button>
                    <button class="nav-link" id="nav-paycheck-list-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-paycheck-list" role="tab">Paycheck list</button>
                    <button class="nav-link" id="nav-notes-tab" data-bs-toggle="tab" data-bs-target="#nav-notes"
                        role="tab">Notes</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel">
                    <div class="nsm-card mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="float-start fw-bold">Personal Information</h4>
                                <a class="nsm-button border-0 float-end pointerCursor" data-bs-toggle="modal"
                                    data-bs-target="#edit_employee_modal">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">NAME</strong>
                                <p class="text_value name_text"><?php echo "$employee->FName $employee->LName"; ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">EMAIL</strong>
                                <p class="text_value email_text"><?php echo !in_array($employee->email, ['', null]) ? $employee->email : '<i>Not specified</i>'; ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">BIRTHDATE</strong>
                                <?php 
                                    $birth_date = 'Not Specified';
                                    if( strtotime($employee->birthdate) > 0 ){
                                        $birth_date = date("m/d/Y", strtotime($employee->birthdate));
                                    }
                                ?>
                                <p class="text_value birthdate_text"><?php echo $birth_date; ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">HOME ADDRESS</strong>
                                <p class="text_value address_text"><?php echo ($employee->complete_address) ? $employee->complete_address : '<i>Not specified</i>'; ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">PHONE NO.</strong>
                                <p class="text_value phone_text"><?php echo ($employee->phone) ? $employee->phone : '<i>Not specified</i>'; ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">SOCIAL SECURITY NO.</strong>
                                <p class="text_value phone_text"><?php echo ($employee->ssn) ? $employee->ssn : '<i>Not specified</i>'; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="nsm-card mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="float-start fw-bold">Employment details</h4>
                                <a class="nsm-button border-0 float-end pointerCursor" data-bs-toggle="modal"
                                    data-bs-target="#edit-employment-details-modal">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">STATUS</strong>
                                <p class="text_value status_text"><span id="emp-details-status"><?php echo $employee->status_text; ?></span></p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">HIRE DATE</strong>
                                <p class="text_value">
                                    <span id="emp-hire-date"><?php echo date("m/d/Y", strtotime($employee->date_hired)); ?></span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">EMPLOYEE NO.</strong>
                                <p class="text_value">
                                    <span id="emp-details-employee-number"><?php echo !in_array($employee->employee_number, ['', null]) ? $employee->employee_number : '<i>Not specified</i>'; ?></span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">WORK LOCATION</strong>
                                <?php 
                                    foreach( $workLocations as $workLocation ) {
                                        echo "<p class='text_value' style='margin-bottom: 0px !important'><i class='bx bx-buildings'></i>" . $workLocation->street . ' ' . $workLocation->city . ', ' . $workLocation->state . ' ' . $workLocation->zipcode . "</p>";
                                    } 
                                ?>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">TITLE</strong>
                                <p class="text_value">
                                    <span id="emp-details-employee-title"><?php echo ($employee->title && $employee->title != "-") ? $employee->title : '<i>Not specified</i>'; ?></span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">WORKER'S COMPANY CLASS</strong>
                                <p class="text_value">
                                    <?php 
                                        $emp_details = isset($employmentDetails[0]) ? $employmentDetails[0] : $employmentDetails; 
                                    ?>
                                    <span id="emp-details-worker-company-class"><?php echo !empty($emp_details->workers_comp_class) ? $emp_details->workers_comp_class : '<i>Not specified</i>'; ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="nsm-card mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="float-start fw-bold">Tax withholdings</h4>
                                <a class="nsm-button border-0 float-end pointerCursor" data-bs-toggle="modal" data-bs-target="#edit-tax-withholdings-modal">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">FEDERAL FILLING STATUS</strong>
                                <p class="text_value filing_status_text">
                                    <?php echo ($taxWithholdingData->filing_status) ? $taxWithholdingData->filing_status : "<i>Not specified</i>"; ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">TAX EXEMPTIONS</strong>
                                <?php
                                    if (!empty($taxWithholdingData->futa_status) || !empty($taxWithholdingData->ssmedi_status) || !empty($taxWithholdingData->flsui_status)) {
                                        echo "<p class='text_value tax_exemptions_text'>";
                                        echo (!empty($taxWithholdingData->futa_status)) ? "FUTA<br>" : "";
                                        echo (!empty($taxWithholdingData->ssmedi_status)) ? "Social Security and Medicare<br>" : "";
                                        echo (!empty($taxWithholdingData->flsui_status)) ? "FL SUI" : "";
                                        echo "</p>";
                                    } else {
                                        echo "<p class='text_value tax_exemptions_text'><i>Not specified</i></p>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="nsm-card mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="float-start fw-bold">Pay Types</h4>
                                <a class="nsm-button border-0 float-end pointerCursor" data-bs-toggle="modal" data-bs-target="#employeePayTypesModal">Edit</a>
                                <a class="nsm-button border-0 float-end pointerCursor" data-bs-toggle="modal" data-bs-target="#payCommissionSummary">Summary</a>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">SALARY</strong>
                                <p class="text_value" id="emp-pay-rate"></p>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted">COMMISSION</strong>
                                <div class="row" id="employee_commission_list_data"></div>
                            </div>
                        </div>
                    </div>
                    <div class="nsm-card mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="float-start fw-bold">Leave Credits</h4>
                                <a class="nsm-button border-0 float-end pointerCursor" data-bs-toggle="modal"
                                    data-bs-target="#leave-credits-modal">Edit</a>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <?php foreach( $employeeLeaveCredits as $key => $value ){ ?>
                                    <div class="col-md-3 mt-4">
                                        <strong class="text-muted text-uppercase"><?= $value['leave_type']; ?></strong>
                                        <p class="text_value"><span
                                                id="leave-credits-<?= $key; ?>"><?= $value['leave_credits']; ?></span>
                                            credits</p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nsm-card mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="float-start fw-bold"><h4 class="float-start fw-bold">Deductions and Contributions</h4></h4>
                                <a class="nsm-button border-0 float-end pointerCursor edit-deductions-and-contributions" data-bs-toggle="modal" data-bs-target="#edit-deductions-and-contributions" data-bs-backdrop="false">Edit</a>
                            </div>      
                            <div class="col-md-12">
                                <div class="row deductions_contributions_list_data" >
                                    <?php foreach($dc_data as $dc){ ?>
                                    <div class="col-md-4">
                                        <strong class="text-muted text-uppercase"><?= $dc->type.'- '.$dc->description ?></strong>
                                        <p class="text_value">
                                            $<?= number_format($dc->deductions_amount,0) ?>/paycheck(Deduction)</p>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="nav-paycheck-list" role="tabpanel">
                    <div class="nsm-card mb-3">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <span class="float-start">
                                    <button type="button" class="dropdown-toggle nsm-button"
                                        data-bs-toggle="dropdown"><span>Filter <i
                                                class='bx bx-fw bx-chevron-down'></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end p-3" id="table-filters"
                                        style="width: max-content">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="filter-date-range">Date range</label>
                                                <select class="nsm-field form-select" name="filter_date"
                                                    id="filter-date-range">
                                                    <option value="last-pay-date"
                                                        <?php echo $filter_date === 'last-pay-date' ? 'selected' : ''?>>
                                                        Last pay date</option>
                                                    <option value="this-month"
                                                        <?php echo $filter_date === 'this-month' ? 'selected' : ''?>>
                                                        This month</option>
                                                    <option value="this-quarter"
                                                        <?php echo empty($filter_date) || $filter_date === 'this-quarter' ? 'selected' : ''?>>
                                                        This quarter</option>
                                                    <option value="this-year"
                                                        <?php echo $filter_date === 'this-year' ? 'selected' : ''?>>This
                                                        year</option>
                                                    <option value="last-month"
                                                        <?php echo $filter_date === 'last-month' ? 'selected' : ''?>>
                                                        Last month</option>
                                                    <option value="last-quarter"
                                                        <?php echo $filter_date === 'last-quarter' ? 'selected' : ''?>>
                                                        Last quarter</option>
                                                    <option value="last-year"
                                                        <?php echo $filter_date === 'last-year' ? 'selected' : ''?>>Last
                                                        year</option>
                                                    <option value="first-quarter"
                                                        <?php echo $filter_date === 'first-quarter' ? 'selected' : ''?>>
                                                        First quarter</option>
                                                    <option value="second-quarter"
                                                        <?php echo $filter_date === 'second-quarter' ? 'selected' : ''?>>
                                                        Second quarter</option>
                                                    <option value="third-quarter"
                                                        <?php echo $filter_date === 'third-quarter' ? 'selected' : ''?>>
                                                        Third quarter</option>
                                                    <option value="fourth-quarter"
                                                        <?php echo $filter_date === 'fourth-quarter' ? 'selected' : ''?>>
                                                        Fourth quarter</option>
                                                    <option value="custom"
                                                        <?php echo $filter_date === 'custom' ? 'selected' : ''?>>Custom
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="filter-from-date">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="form-control nsm-field date"
                                                        id="filter-from-date" value="<?php echo $filter_from?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="filter-to-date">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="form-control nsm-field date"
                                                        id="filter-to-date" value="<?php echo $filter_to?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <button type="button" class="nsm-button" id="cancel-button">
                                                    Cancel
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="nsm-button primary float-end"
                                                    id="apply-button">
                                                    Apply
                                                </button>
                                            </div>
                                        </div>
                                    </ul>
                                </span>
                                <span class="float-end">
                                    <button type="button" class="dropdown-toggle nsm-button print-paychecks-button"
                                        disabled>Print</button>
                                </span>
                            </div>
                            <div class="col-md-12">
                                <table class="nsm-table" id="transactions-table">
                                    <thead>
                                        <tr>
                                            <td class="table-icon text-center">
                                                <input class="form-check-input select-all table-select" type="checkbox">
                                            </td>
                                            <td data-name="Pay Date">PAY DATE</td>
                                            <td data-name="Name">NAME</td>
                                            <td data-name="Total Pay">TOTAL PAY</td>
                                            <td data-name="Net Pay">NET PAY</td>
                                            <td data-name="Pay Method">PAY METHOD</td>
                                            <td data-name="Check Number">CHECK NUMBER</td>
                                            <td data-name="Status">STATUS</td>
                                            <td data-name="Manage"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($paychecks) > 0) : ?>
                                        <?php foreach($paychecks as $paycheck) : ?>
                                        <tr>
                                        <tr>
                                            <td>
                                                <div class="table-row-icon table-checkbox">
                                                    <input class="form-check-input select-one table-select"
                                                        type="checkbox" value="<?php echo $paycheck['id']?>">
                                                </div>
                                            </td>
                                            <td><?php echo $paycheck['pay_date']?></td>
                                            <td><?php echo $paycheck['name']?></td>
                                            <td><?php echo str_replace('$-', '-$', '$'.$paycheck['total_pay'])?></td>
                                            <td><?php echo str_replace('$-', '-$', '$'.$paycheck['net_pay'])?></td>
                                            <td><?php echo $paycheck['pay_method']?></td>
                                            <td><?php echo !in_array($paycheck['check_number'], ['-', 'Void']) ? '<input type="text" name="check_number[]" class="form-control nsm-field" value="'.$paycheck['check_number'].'">' : $paycheck['check_number'] ?>
                                            </td>
                                            <td><?php echo $paycheck['status']?></td>
                                            <td>
                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item print-paycheck" href="#">Print</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item delete-paycheck" href="#">Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item void-paycheck" href="#">Void</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item edit-paycheck" href="#">Edit</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="10">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-notes" role="tabpanel">
                    <div class="nsm-card">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="float-start fw-bold">Notes</h4>
                                <a class="nsm-button border-0 float-end pointerCursor" data-bs-toggle="modal" data-bs-target="#notes-modal">Edit</a>
                            </div>
                            <div class="col-md-12">
                                <span class="text_value employeeNotes"><?php echo ($pay_details->notes) ? $pay_details->notes : '<i>Not specified</i>'; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
<?php if ($userType != 7) { echo "$('.pointerCursor, .employee_image_profile_edit , .edit-deductions-and-contributions').remove();"; } ?>
$('a[data-bs-target="#edit-tax-withholdings-modal"]').click(function (e) { 
    const formType = "<?php echo "$taxWithholdingData->withholding_certificate" ?>";
    if (formType == "form_2020") {
        $('select > option[data-custom="form_2020"]').fadeIn('fast');
        $('select > option[data-custom="form_2019"]').hide();
        $('.form_2020_input').fadeIn('fast');
        $('.form_2019_input').hide();
        $('.form_2020_input > input').show().removeAttr('disabled');
        $('.form_2019_input > input').hide().attr('disabled', '');
    } else {
        $('select > option[data-custom="form_2020"]').hide();
        $('select > option[data-custom="form_2019"]').fadeIn('fast');
        $('.form_2020_input').hide();
        $('.form_2019_input').fadeIn('fast');
        $('.form_2020_input > input').hide().attr('disabled', '');
        $('.form_2019_input > input').show().removeAttr('disabled');
    }
});


</script>
<?php include viewPath('v2/includes/footer'); ?>