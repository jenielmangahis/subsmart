<div class="modal fade nsm-modal fade" id="edit_employee_modal" tabindex="-1" aria-labelledby="edit_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit_employee_form" action="<?php echo base_url(); ?>accounting/employees/update/personal-info/<?=$employee->id?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_employee_container" style="overflow-x: auto;max-height: 800px;">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Basic Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                            <input type="text" name="first_name" class="nsm-field form-control" required value="<?= $employee->FName; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                            <input type="text" name="last_name" class="nsm-field form-control" required value="<?= $employee->LName; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">    
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                            <input type="text" name="mobile" placeholder="xxx-xxx-xxxx" maxlength="12" id="mobile" class="nsm-field form-control mobile-number" value="<?= $employee->mobile; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                            <input type="text" name="phone" placeholder="xxx-xxx-xxxx" maxlength="12" class="nsm-field form-control phone-number" value="<?= $employee->phone; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">nSmart App Login Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                            <div class="nsm-field-group icon-right">
                                <input type="email" class="nsm-field form-control" id="employeeEmail" name="email" required value="<?= $employee->email; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Username</label>
                            <div class="nsm-field-group icon-right">
                                <input type="text" class="nsm-field form-control" id="employeeUsername" name="username" required value="<?= $employee->username; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Other Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                            <input type="text" class="nsm-field form-control" name="address" value="<?= $employee->address; ?>">
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">State</label>
                            <input type="text" class="nsm-field form-control" name="state" value="<?= $employee->state; ?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
                            <input type="text" class="nsm-field form-control" name="postal_code" value="<?= $employee->postal_code; ?>">
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
                                    if($employee->birthdate != '0000-00-00' || $employee->birthdate == null) {
                                        $birthdate = date("m/d/Y", strtotime($employee->birthdate));
                                    }
                                ?>                                
                                <input type="text" class="form-control nsm-field date" id="birth-date" name="birth_date" value="<?php echo $birthdate; ?>">
                            </div>
                        </div>
                                            
                        <div class="col-12">
                            <div class="form-check form-switch nsm-switch d-inline-block me-3">
                                <?php 
                                    $is_checked_app = '';
                                    if($employee->has_app_access) {
                                        $is_checked_app = 'checked';
                                    }

                                    $is_checked_web = '';
                                    if($employee->has_web_access) {
                                        $is_checked_web = 'checked';
                                    }
                                ?>
                                <input class="form-check-input" type="checkbox" id="app_access" name="app_access" <?php echo $is_checked_app; ?>>
                                <label class="form-check-label" for="app_access">App Access</label>
                            </div>
                            <div class="form-check form-switch nsm-switch d-inline-block">
                                <input class="form-check-input" type="checkbox" id="web_access" name="web_access" <?php echo $is_checked_web; ?>>
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
                                    <div class="nsm-img-upload" style="background-image: url('<?= base_url('/uploads/users/user-profile/'.$employee->profile_img); ?>');">
                                        <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                        <input type="file" name="userfile" class="nsm-upload" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_status_modal" tabindex="-1" aria-labelledby="change_status_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form method="POST" id="edit-employee-status-form" action="/accounting/employees/update/status/<?=$employee->id?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee Status</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
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
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="edit-employment-details-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-employment-details-form" action="/accounting/employees/update/employment-details/<?=$employee->id?>">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Employment details</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>Let's get down to <?=$employee->FName?>'s job specifics</h3>
                    </div>
                </div>
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="content-title">Basic Details</label>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2" for="employee_number">Employee Number</label>
                                <input type="text" name="employee_number" class="nsm-field form-control" id="employee_number" value="<?= $employee->employee_number ? $employee->employee_number : '-'; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="content-title">Employment Details</label>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Hire date</label>
                                <div class="nsm-field-group calendar">
                                    <input type="text" class="form-control nsm-field date" id="hire-date" name="hire_date" value="<?=date("m/d/Y", strtotime($employee->date_hired))?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Work location</label>
                                <select class="nsm-field form-select" id="work-location" name="work_location">
                                    <option value="" disabled selected>Select work location</option>
                                    <option value="add">&plus; Add new</option>
                                    <?php foreach($worksites as $worksite) : ?>
                                        <option value="<?= $worksite->id; ?>" <?= $employmentDetails->work_location_id == $worksite->id ? 'selected="selected"' : ''; ?>><?= $worksite->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Title</label>
                                <select class="nsm-field form-select" name="role" id="employee_role" required>
                                    <option value="" disabled>Select Title</option>
                                    <?php foreach ($roles as $r) : ?>
                                        <option value="<?= $r->id; ?>" <?= $r->id == $employee->role ? 'selected' : ''; ?>><?= $r->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Workers' comp class</label>
                                <input type="text" class="nsm-field form-control" id="workers-comp-class" name="workers_comp_class" value="<?=!empty($employmentDetails) ? $employmentDetails->workers_comp_class : ''?>">
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
                                    <input class="form-check-input" type="radio" id="role_7" value="7" name="user_type" <?= $employee->user_type == 7 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_7">
                                        Admin
                                        <span class="content-subtitle d-block fst-italic">ALL Access</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" id="role_1" name="user_type" <?= $employee->user_type == 1 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_1">
                                        Office Manager
                                        <span class="content-subtitle d-block fst-italic">ALL except high security file vault</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="2" id="role_2" name="user_type" <?= $employee->user_type == 2 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_2">
                                        Partner
                                        <span class="content-subtitle d-block fst-italic">ALL base on plan type</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="3" id="role_3" name="user_type" <?= $employee->user_type == 3 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_3">
                                        Team Leader
                                        <span class="content-subtitle d-block fst-italic">No accounting or any changes to company profile or deletion</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="4" id="role_4" name="user_type" <?= $employee->user_type == 4 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_4">
                                        Standard User
                                        <span class="content-subtitle d-block fst-italic">Cannot add or delete employees, can not manage subscriptions</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="5" id="role_5" name="user_type" <?= $employee->user_type == 5 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_5">
                                        Field Sales
                                        <span class="content-subtitle d-block fst-italic">View only no input</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="6" id="role_6" name="user_type" <?= $employee->user_type == 6 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_6">
                                        Field Tech
                                        <span class="content-subtitle d-block fst-italic">App access only, no Web access</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="edit-payment-method-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <form method="POST" id="edit-payment-method-form" action="<?= base_url('/accounting/employees/update/payment-method/' . $employee->id) ?>">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select payment method</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>How would you like to pay <?=$employee->FName?>?</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="payment-method">Payment method</label>
                        <select name="payment_method" id="payment-method" class="form-select nsm-field">
                            <option value="paper-check" <?=$pay_details->pay_method === 'paper-check' ? 'selected' : ''?>>Paper check</option>
                            <option value="direct-deposit" <?=$pay_details->pay_method === 'direct-deposit' ? 'selected' : ''?>>Direct deposit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="edit-pay-types-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <form method="POST" id="edit-pay-types-form" action="<?= base_url('accounting/employees/update/pay-types/' . $employee->id) ?>">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Pay types</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>Please select a payscale for <?=$employee->FName?>?</h3>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                                <select class="nsm-field form-select edit-emp-payscale" name="empPayscale" required>
                                    <option value="" disabled>Select payscale</option>
                                    <?php foreach($payscale as $p) : ?>
                                        <option value="<?= $p->id; ?>" <?= $employee->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 edit-pay-type-container">
                                <label class="content-subtitle fw-bold d-block mb-2 edit-payscale-pay-type"><?= $salary_type_label; ?></label>
                                <input class="form-control" name="salary_rate" type="number" step="any" min="0" value="<?= number_format($salary_rate,2); ?>">
                            </div>
                        </div>
                    </div>
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
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="notes-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <form method="POST" id="edit-notes-form" action="/accounting/employees/update/notes/<?=$employee->id?>">
    <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title content-title">Add notes</span>
            <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="notes">Notes for <?=$employee->FName?></label>
                    <textarea name="notes" id="notes" class="form-control nsm-field"><?=$pay_details->notes?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
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
            <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="name">Name</label>
                    <input type="text" class="form-control nsm-field" id="name" name="name" required>
                </div>
                <div class="col-12">
                    <label for="street">Street</label>
                    <input type="text" class="form-control nsm-field" id="street" name="street" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control nsm-field" id="city" name="city" required>
                </div>
                <div class="col-12 col-md-3">
                    <label for="state">State</label>
                    <input type="text" class="form-control nsm-field" id="state" name="state" required>
                </div>
                <div class="col-12 col-md-3">
                    <label for="zip-code">ZIP code</label>
                    <input type="text" class="form-control nsm-field" id="zip-code" name="zip_code" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
        </div>
    </div>
    </form>
    </div>
</div>

<script>

$(function() {
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
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
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
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });    
})



</script>