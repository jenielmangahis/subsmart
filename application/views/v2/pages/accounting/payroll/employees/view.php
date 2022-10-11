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
                                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                <span>Actions</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item" id="change-status">Change status</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="delete-employee">Delete employee</a>
                                                </li>
                                            </ul>
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
                                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">
                                                Profile
                                            </button>
                                            <button class="nav-link" id="nav-paycheck-list-tab" data-bs-toggle="tab" data-bs-target="#nav-paycheck-list" type="button" role="tab" aria-controls="nav-paycheck-list" aria-selected="false">
                                                Paycheck list
                                            </button>
                                            <button class="nav-link" id="nav-document-tab" data-bs-toggle="tab" data-bs-target="#nav-document" type="button" role="tab" aria-controls="nav-document" aria-selected="false">
                                                Document
                                            </button>
                                            <button class="nav-link" id="nav-notes-tab" data-bs-toggle="tab" data-bs-target="#nav-notes" type="button" role="tab" aria-controls="nav-notes" aria-selected="false">
                                                Notes
                                            </button>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="row g-3">
                                                <div class="col-12 col-md-8">
                                                    <div class="nsm-card primary">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4 class="float-start">Personal Info</h4>
                                                                <button class="nsm-button float-end">Edit</button>
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
                                                                <h5><?=$employee->complete_address?></h5>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <h6>Social security number</h6>
                                                                <h5></h5>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <h6>Phone number</h6>
                                                                <h5><?=$employee->phone?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
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
                                                <div class="col-12 col-md-8">
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
                                                                <h6>Pay schedule</h6>
                                                                <h5><?=$employee->pay_schedule->name?></h5>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <h6>Employee ID</h6>
                                                                <h5>-</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="nsm-card primary">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4 class="float-start">Pay types</h4>
                                                                <button class="nsm-button float-end">Edit</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <h6>Salary</h6>
                                                                <h5><?=$employee->pay_rate?></h5>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <h6>Additional pay types</h6>
                                                                <h5>-</h5>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <h6>Time off</h6>
                                                                <h5>-</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-paycheck-list" role="tabpanel" aria-labelledby="nav-paycheck-list-tab"></div>
                                        <div class="tab-pane fade" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab"></div>
                                        <div class="tab-pane fade" id="nav-notes" role="tabpanel" aria-labelledby="nav-notes-tab"></div>
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