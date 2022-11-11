<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Preferred Date</label>
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <input type="text" name="appointment_date" class="nsm-field form-control datepicker" value="<?= date("l, F d, Y", strtotime($appointment->appointment_date)); ?>" placeholder="Date" required style="padding: 0.375rem 0.75rem;">
        </div>
        <div class="col-12 col-md-3">
            <input type="text" name="appointment_time_from" class="nsm-field form-control timepicker" value="<?= date("h:i A", strtotime($appointment->appointment_time_from)); ?>" placeholder="Time From" required />
        </div>
        <div class="col-12 col-md-3">
            <input type="text" name="appointment_time_to" class="nsm-field form-control timepicker" value="<?= date("h:i A", strtotime($appointment->appointment_time_to)); ?>" placeholder="Time To" required />
        </div>
    </div>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Which Employee</label>
    <select class="nsm-field form-select" name="appointment_user_id" id="edit-appointment-user" required>
        <option value="<?= $appointment->user_id; ?>" selected><?= $appointment->employee_name; ?></option>
    </select>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Which Customer</label>
    <select class="nsm-field form-select" name="appointment_customer_id" id="edit-appointment-customer" >
        <option value="<?= $appointment->prof_id; ?>" selected><?= $appointment->customer_name; ?></option>
    </select>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
    <select name="appointment_type_id" id="appointment-type" class="nsm-field form-select" required>
        <?php foreach ($appointmentTypes as $a) { ?>
            <option <?= $appointment->appointment_type_id == $a->id ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
        <?php } ?>
    </select>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Tags</label>
    <select class="nsm-field form-select" name="appointment_tags[]" id="edit-appointment-tags" multiple="multiple" required>
        <?php foreach ($a_selected_tags as $key => $value) { ?>
            <option value="<?= $key; ?>" selected><?= $value; ?></option>
        <?php } ?>
    </select>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">URL Link</label>
    <input type="text" name="url_link" id="ulr-link" class="nsm-field form-control" placeholder="URL Link" value="<?= $appointment->url_link; ?>">
</div>