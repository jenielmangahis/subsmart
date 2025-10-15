<div class="col-12">
    <input type="hidden" name="is_wait_list" id="w_is_wait_list" value="<?= $appointment->is_wait_list; ?>">
    <label class="content-subtitle fw-bold d-block mb-2">Preferred Date</label>
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <input type="text" name="appointment_date" class="nsm-field form-control datepicker" value="<?= date("l, F d, Y", strtotime($appointment->appointment_date)); ?>" placeholder="Date" required style="padding: 0.375rem 0.75rem;">
        </div>
        <div class="col-12 col-md-6">
            <input type="time" name="appointment_time" class="nsm-field form-control" value="<?= date("h:i:s", strtotime($appointment->appointment_time)); ?>" placeholder="Time" required />
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
<div class="col-12" id="edit-wait-list-customer-container" style="<?= $appointment->appointment_type_id == 1 || $appointment->appointment_type_id == 2 || $appointment->appointment_type_id == 3 ? '' : 'display:none'; ?>">
    <label class="content-subtitle fw-bold d-block mb-2">Which Customer</label>
    <select class="nsm-field form-select" name="appointment_customer_id" id="wishlist-edit-appointment-customer">
        <option value="<?= $appointment->prof_id; ?>" selected><?= $appointment->customer_name; ?></option>
    </select>
</div>
<div class="col-12 col-md-12 mb-2" id="edit-lead-container" style="<?= $appointment->appointment_type_id != 1 && $appointment->appointment_type_id != 2 && $appointment->appointment_type_id != 3 && $appointment->appointment_type_id != 4 ? '' : 'display:none'; ?>">
    <div class="row">
        <div class="col-12 col-md-6 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">Appointment with</label>
            <input type="text" value="<?= $appointment->lead_first_name; ?>" name="first_name" placeholder="First Name" class="nsm-field form-control" />                          
        </div> 
        <div class="col-12 col-md-6 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">&nbsp;</label>
            <input type="text" value="<?= $appointment->lead_last_name; ?>" name="last_name" placeholder="Last Name" class="nsm-field form-control" />                          
        </div>   
        <div class="col-12 col-md-6 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">Contact Number</label>
            <input type="text" value="<?= $appointment->lead_contact_number; ?>" name="contact_number" placeholder="xxx-xxx-xxxx" class="nsm-field form-control edit-phone-number-format" />                          
        </div>  
        <div class="col-12 col-md-6 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
            <input type="email" value="<?= $appointment->lead_contact_email; ?>" name="contact_email" placeholder="Email" class="nsm-field form-control" />                          
        </div>  
        <div class="col-12 col-md-12 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">Address</label>
            <input type="text" value="<?= $appointment->lead_address; ?>" name="address" placeholder="Address" class="nsm-field form-control" />   
        </div>  
        <div class="col-6 col-md-6 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">City</label>
            <input type="text" value="<?= $appointment->lead_city; ?>" name="city" placeholder="City" class="nsm-field form-control" />                          
        </div>  
        <div class="col-6 col-md-4 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">State</label>
            <input type="text" value="<?= $appointment->lead_state; ?>" name="state" placeholder="State" class="nsm-field form-control" />                          
        </div>  
        <div class="col-6 col-md-2 mb-2">
            <label class="content-subtitle fw-bold d-block mb-2">Zip</label>
            <input type="text" value="<?= $appointment->lead_zip; ?>" name="zip" placeholder="zip" class="nsm-field form-control" />                          
        </div> 
    </div>
</div>
<div class="col-12">
    <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
    <select name="appointment_type_id" id="edit-wait-list-appointment-type" class="nsm-field form-select" required>
        <?php foreach ($appointmentTypes as $a) { ?>
            <option <?= $appointment->appointment_type_id == $a->id ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
        <?php } ?>
    </select>
</div>
<script>
$(function(){
    $('#edit-wait-list-appointment-type').on('change', function(){
        let selected = $(this).val();
        if( selected == 1 || selected == 2 || selected == 3 ){
            $('#edit-wait-list-customer-container').fadeIn(500);
            $('#edit-lead-container').fadeOut(500);
        }else if( selected == 4 ){
            $('#edit-wait-list-customer-container').fadeOut(500);
            $('#edit-lead-container').fadeOut(500);
        }else{
            $('#edit-wait-list-customer-container').fadeOut(500);
            $('#edit-lead-container').fadeIn(500);
        }
    });

    $('.edit-phone-number-format').keydown(function(e) {
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