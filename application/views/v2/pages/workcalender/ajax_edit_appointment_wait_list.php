<div class="col-12">
    <input type="hidden" name="is_wait_list" id="w_is_wait_list" value="<?= $appointment->is_wait_list; ?>">
    <label class="content-subtitle fw-bold d-block mb-2">Preferred Date</label>
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <input type="text" name="appointment_date" class="nsm-field form-control datepicker" value="<?= date("l, F d, Y", strtotime($appointment->appointment_date)); ?>" placeholder="Date" required style="padding: 0.375rem 0.75rem;">
        </div>
        <div class="col-12 col-md-6">
            <input type="text" name="appointment_time" class="nsm-field form-control timepicker" value="<?= date("h:i A", strtotime($appointment->appointment_time)); ?>" placeholder="Time" required />
        </div>
    </div>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Which Employee</label>
    <select class="nsm-field form-select" name="appointment_user_id" id="wishlist-edit-appointment-user" required>
        <?php if ($appointment->user_id > 0) { ?>
            <option value="<?= $appointment->user_id; ?>" selected><?= $appointment->employee_name; ?></option>
        <?php } ?>
    </select>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Which Customer</label>
    <select class="nsm-field form-select" name="appointment_customer_id" id="wishlist-edit-appointment-customer">
        <option value="<?= $appointment->prof_id; ?>" selected><?= $appointment->customer_name; ?></option>
    </select>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
    <select name="appointment_type_id" id="wait-list-appointment-type" class="nsm-field form-select" required>
        <?php foreach ($appointmentTypes as $a) { ?>
            <option <?= $appointment->appointment_type_id == $a->id ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
        <?php } ?>
    </select>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
    <select class="nsm-field form-select" name="appointment_tags[]" id="wishlist-edit-appointment-tags" required>
        <?php foreach ($a_selected_tags as $key => $value) { ?>
            <option value="<?= $key; ?>" selected><?= $value; ?></option>
        <?php } ?>
    </select>
</div>