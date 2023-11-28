<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/view_employees_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/employees_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h3 class="m-0"><?=$employee->FName?> <?=$employee->LName?></h3>
                                        <h5><?=$employee->status_text?></h5>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#change_status_modal">
                                                Change status
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="nsm-tab">
                                    <nav>
                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            <button class="nav-link <?=$has_filter === false ? 'active' : ''?>" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="<?=$has_filter === false ? 'true' : 'false'?>">
                                                Profile
                                            </button>
                                            <button class="nav-link <?=$has_filter === true ? 'active' : ''?>" id="nav-paycheck-list-tab" data-bs-toggle="tab" data-bs-target="#nav-paycheck-list" type="button" role="tab" aria-controls="nav-paycheck-list" aria-selected="<?=$has_filter === true ? 'true' : 'false'?>">
                                                Paycheck list
                                            </button>
                                            <button class="nav-link" id="nav-notes-tab" data-bs-toggle="tab" data-bs-target="#nav-notes" type="button" role="tab" aria-controls="nav-notes" aria-selected="false">
                                                Notes
                                            </button>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade <?=$has_filter === false ? 'show active' : ''?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="row">
                                                <div class="col-12 col-md-8">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <div class="nsm-card primary">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h4 class="float-start">Personal Info</h4>
                                                                        <button class="nsm-button float-end" data-bs-toggle="modal" data-bs-target="#edit_employee_modal">Edit</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Name</h6>
                                                                        <h5><?=$employee->FName?> <?=$employee->LName?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Email</h6>
                                                                        <h5><?=!in_array($employee->email, ['', null]) ? $employee->email : '-'?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Birth date</h6>
                                                                        <h5><?=date("m/d/Y", strtotime($employee->birthdate))?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Home address</h6>
                                                                        <h5><?=$employee->complete_address ? $employee->complete_address : '-'?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Phone number</h6>
                                                                        <h5><?=$employee->phone ? $employee->phone : '-'?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="nsm-card primary">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h4 class="float-start">Payment method</h4>
                                                                        <button class="nsm-button float-end" data-bs-toggle="modal" data-bs-target="#edit-payment-method-modal">Edit</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Payment method</h6>
                                                                        <h5><?=$employee->payment_method?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="nsm-card primary">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h4 class="float-start">Employment details</h4>
                                                                        <button class="nsm-button float-end" data-bs-toggle="modal" data-bs-target="#edit-employment-details-modal">Edit</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Status</h6>
                                                                        <h5><?=$employee->status_text?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Hire date</h6>
                                                                        <h5><?=date("m/d/Y", strtotime($employee->date_hired))?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Work location</h6>
                                                                        <h5><?=!is_null($empWorksite) ? $empWorksite : '-'?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Employee Number</h6>
                                                                        <h5><?=!in_array($employee->employee_number, ['', null]) ? $employee->employee_number : '-'?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Title</h6>
                                                                        <h5><?=$employee->title?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Workers' comp class</h6>
                                                                        <h5><?=!empty($employmentDetails->workers_comp_class) ? $employmentDetails->workers_comp_class : '-'?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="nsm-card primary">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h4 class="float-start">Pay types</h4>
                                                                        <button class="nsm-button float-end" data-bs-toggle="modal" data-bs-target="#edit-pay-types-modal">Edit</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Salary</h6>
                                                                        <h5><?=$employee->pay_rate?></h5>
                                                                    </div>
                                                                    <div class="col-12 col-md-4">
                                                                        <h6>Commission Settings</h6>
                                                                        <?php foreach($employeeCommissionSettings as $ecs) : ?>
                                                                            <?php foreach( $commissionSettings as $cs ){ ?>
                                                                                <?php if($ecs->commission_setting_id === $cs->id) : ?>
                                                                                    <h5><?=$ecs->commission_type === 'amount' ? '$'.number_format(floatval($ecs->commission_value), 2) : number_format(floatval($ecs->commission_value), 2).'%'?> <?=$cs->name?></h5>
                                                                                <?php endif; ?>
                                                                            <?php } ?>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="nsm-card primary">
                                                        <div class="nsm-card-header">
                                                            <div class="nsm-card-title">
                                                                <span>Profile Picture</span>
                                                            </div>
                                                        </div>
                                                        <div class="nsm-card-content">
                                                            <div class="d-flex flex-column align-items-center text-center">
                                                                <img src="<?=!empty($employee->profile_img) ? userProfileImage($employee->id) : '/uploads/users/default.png' ?>" alt="Admin" class="rounded-circle w-75">
                                                                <div class="mt-3 d-flex justify-content-center">
                                                                    <button class="nsm-button" id="change-profile-photo" onclick="document.getElementById('user-profile-photo').click()">Change Photo</button>
                                                                    <?php if(!empty($employee->profile_img)) : ?>
                                                                    <button class="nsm-button primary" id="remove-photo">Remove Photo</button>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="file" name="userfile" id="user-profile-photo" class="d-none" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade <?=$has_filter === true ? 'show active' : ''?>" id="nav-paycheck-list" role="tabpanel" aria-labelledby="nav-paycheck-list-tab">
                                            <div class="row g-2">
                                                <div class="col-12 col-md-6 grid-mb">
                                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                        <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end p-3" id="table-filters" style="width: max-content">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <label for="filter-date-range">Date range</label>
                                                                <select class="nsm-field form-select" name="filter_date" id="filter-date-range">
                                                                    <option value="last-pay-date" <?=$filter_date === 'last-pay-date' ? 'selected' : ''?>>Last pay date</option>
                                                                    <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This month</option>
                                                                    <option value="this-quarter" <?=empty($filter_date) || $filter_date === 'this-quarter' ? 'selected' : ''?>>This quarter</option>
                                                                    <option value="this-year" <?=$filter_date === 'this-year' ? 'selected' : ''?>>This year</option>
                                                                    <option value="last-month" <?=$filter_date === 'last-month' ? 'selected' : ''?>>Last month</option>
                                                                    <option value="last-quarter" <?=$filter_date === 'last-quarter' ? 'selected' : ''?>>Last quarter</option>
                                                                    <option value="last-year" <?=$filter_date === 'last-year' ? 'selected' : ''?>>Last year</option>
                                                                    <option value="first-quarter" <?=$filter_date === 'first-quarter' ? 'selected' : ''?>>First quarter</option>
                                                                    <option value="second-quarter" <?=$filter_date === 'second-quarter' ? 'selected' : ''?>>Second quarter</option>
                                                                    <option value="third-quarter" <?=$filter_date === 'third-quarter' ? 'selected' : ''?>>Third quarter</option>
                                                                    <option value="fourth-quarter" <?=$filter_date === 'fourth-quarter' ? 'selected' : ''?>>Fourth quarter</option>
                                                                    <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <label for="filter-from-date">From</label>
                                                                <div class="nsm-field-group calendar">
                                                                    <input type="text" class="form-control nsm-field date" id="filter-from-date" value="<?=$filter_from?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <label for="filter-to-date">To</label>
                                                                <div class="nsm-field-group calendar">
                                                                    <input type="text" class="form-control nsm-field date" id="filter-to-date" value="<?=$filter_to?>">
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
                                                                <button type="button" class="nsm-button primary float-end" id="apply-button">
                                                                    Apply
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </ul>
                                                </div>
                                                <div class="col-12 col-md-6 grid-mb text-end">
                                                    <div class="nsm-page-buttons page-button-container">
                                                        <button type="button" class="dropdown-toggle nsm-button print-paychecks-button" disabled>
                                                            Print
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
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
                                                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$paycheck['id']?>">
                                                                </div>
                                                            </td>
                                                            <td><?=$paycheck['pay_date']?></td>
                                                            <td><?=$paycheck['name']?></td>
                                                            <td><?=str_replace('$-', '-$', '$'.$paycheck['total_pay'])?></td>
                                                            <td><?=str_replace('$-', '-$', '$'.$paycheck['net_pay'])?></td>
                                                            <td><?=$paycheck['pay_method']?></td>
                                                            <td><?=!in_array($paycheck['check_number'], ['-', 'Void']) ? '<input type="text" name="check_number[]" class="form-control nsm-field" value="'.$paycheck['check_number'].'">' : $paycheck['check_number'] ?></td>
                                                            <td><?=$paycheck['status']?></td>
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
                                        <div class="tab-pane fade" id="nav-notes" role="tabpanel" aria-labelledby="nav-notes-tab">
                                            <div class="row g-3">
                                                <?php if($pay_details->notes) : ?>
                                                <div class="col-12 col-md-8">
                                                    <div class="nsm-card primary">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4 class="float-start">Notes</h4>
                                                                <button class="nsm-button float-end" data-bs-toggle="modal" data-bs-target="#notes-modal"><i class="bx bx-fw bx-pencil"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <p><?=$pay_details->notes?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php else : ?>
                                                <div class="col-12 text-center">
                                                    <h6>You don't have any notes</h6>
                                                    <button class="nsm-button" data-bs-toggle="modal" data-bs-target="#notes-modal">Add notes</button>
                                                </div>
                                                <?php endif;?>
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
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>