<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <?php if( checkRoleCanAccessModule('company-my-availability', 'write') ){ ?>
                <?php echo form_open_multipart('users/savebusinessdetail', ['id' => 'form-business-availability', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="action" value="availability" />
                <?php } ?>
                <div class="row mt-3 g-3 align-items-start">
                    <div class="col-12 col-md-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Working Days</span>
                                    <label class="content-subtitle d-block">Your working days will appear on your public profile.</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" data-day="monday" type="checkbox" name="weekday[0]" <?= array_key_exists("Monday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_0" value="Monday" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                            <label class="form-check-label fw-bold" for="weekday_0">Monday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="monHoursFromAvail" id="mondayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Monday']['time_from']; ?>" <?= !array_key_exists("Monday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="monHoursToAvail" id="mondayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Monday']['time_to']; ?>" <?= !array_key_exists("Monday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                                                        
                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" data-day="tuesday" type="checkbox" name="weekday[1]" <?= array_key_exists("Tuesday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_1" value="Tuesday" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                            <label class="form-check-label fw-bold" for="weekday_1">Tuesday</label>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="tueHoursFromAvail" id="tuesdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Tuesday']['time_from']; ?>" <?= !array_key_exists("Tuesday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="tueHoursToAvail" id="tuesdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Tuesday']['time_to']; ?>" <?= !array_key_exists("Tuesday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    
                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" data-day="wednesday" type="checkbox" name="weekday[2]" <?= array_key_exists("Wednesday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_2" value="Wednesday" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                            <label class="form-check-label fw-bold" for="weekday_2">Wednesday</label>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="wedHoursFromAvail" id="wednesdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Wednesday']['time_from']; ?>" <?= !array_key_exists("Wednesday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="wedHoursToAvail" id="wednesdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Wednesday']['time_to']; ?>" <?= !array_key_exists("Wednesday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    
                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" data-day="thursday" type="checkbox" name="weekday[3]" <?= array_key_exists("Thursday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_3" value="Thursday" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                            <label class="form-check-label fw-bold" for="weekday_3">Thursday</label>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="thuHoursFromAvail" id="thursdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Thursday']['time_from']; ?>" <?= !array_key_exists("Thursday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="thuHoursToAvail" id="thursdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Thursday']['time_to']; ?>" <?= !array_key_exists("Thursday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    
                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" data-day="friday" type="checkbox" name="weekday[4]" <?= array_key_exists("Friday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_4" value="Friday" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                            <label class="form-check-label fw-bold" for="weekday_4">Friday</label>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="friHoursFromAvail" id="fridayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Friday']['time_from']; ?>" <?= !array_key_exists("Friday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="friHoursToAvail" id="fridayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Friday']['time_to']; ?>" <?= !array_key_exists("Friday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                                                        
                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" data-day="saturday" type="checkbox" name="weekday[5]" <?= array_key_exists("Saturday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_5" value="Saturday" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                            <label class="form-check-label fw-bold" for="weekday_5">Saturday</label>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="satHoursFromAvail" id="saturdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Saturday']['time_from']; ?>" <?= !array_key_exists("Saturday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="satHoursToAvail" id="saturdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Saturday']['time_to']; ?>" <?= !array_key_exists("Saturday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                                                        
                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" data-day="sunday" type="checkbox" name="weekday[6]" <?= array_key_exists("Sunday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_6" value="Sunday" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                            <label class="form-check-label fw-bold" for="weekday_6">Sunday</label>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="sunHoursFromAvail" id="sundayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Sunday']['time_from']; ?>" <?= !array_key_exists("Sunday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="sunHoursToAvail" id="sundayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Sunday']['time_to']; ?>" <?= !array_key_exists("Sunday", $data_working_days) || !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>

                                    <?php if( checkRoleCanAccessModule('company-my-availability', 'write') ){ ?>
                                    <div class="col-12 text-end">
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="tuesday" type="button"><i class='bx bx-copy-alt'></i> Tue</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="wednesday" type="button"><i class='bx bx-copy-alt'></i> Wed</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="thursday" type="button"><i class='bx bx-copy-alt'></i> Thu</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="friday" type="button"><i class='bx bx-copy-alt'></i> Fri</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="saturday" type="button"><i class='bx bx-copy-alt'></i> Sat</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="sunday" type="button"><i class='bx bx-copy-alt'></i> Sun</button>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Time off / Unavailability</span>
                                    <label class="content-subtitle d-block">Please set your unavailable timings and time-off.</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">From</label>
                                        <input type="text" name="timeoff_from" class="nsm-field form-control datepicker" required value="<?= $profiledata->start_time_of_day; ?>" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">To</label>
                                        <input type="text" name="timeoff_to" class="nsm-field form-control datepicker" required value="<?= $profiledata->end_time_of_day; ?>" <?= !checkRoleCanAccessModule('company-my-availability', 'write') ? 'disabled="disabled"' : ''; ?> />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if( checkRoleCanAccessModule('company-my-availability', 'write') ){ ?>
                        <button type="submit" class="nsm-button primary m-0 mt-3 float-end">Save</button>
                        <?php } ?>
                    </div>
                </div>
                <?php if( checkRoleCanAccessModule('company-my-availability', 'write') ){ ?>
                <?php echo form_close(); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".timepicker").datetimepicker({
            format: 'hh:mm A'
        });

        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
        });

        <?php if( checkRoleCanAccessModule('company-my-availability', 'write') ){ ?>
        $('#form-business-availability .form-check-input').on('change', function(){
            let day = $(this).attr('data-day');
            if( $(this).is(':checked') ){
                $(`#${day}HoursFromAvail`).prop('disabled', false);
                $(`#${day}HoursToAvail`).prop('disabled', false);
            }else{
                $(`#${day}HoursFromAvail`).prop('disabled', true);
                $(`#${day}HoursToAvail`).prop('disabled', true);
            }
        }); 
 
        $(document).on("submit", "#form-business-availability", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "users/savebusinessdetail";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: "json",
                success: function(result) {
                    if( result.is_success ){
                        Swal.fire({
                            title: 'My Business Availability',
                            text: "Data was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(".btn-copy-time").click(function() {
            var dayKey = $(this).attr("data-key");
            var startToCopy = $("#mondayHoursFromAvail").val();
            var endToCopy = $("#mondayHoursToAvail").val();

            $("#" + dayKey + "HoursFromAvail").val(startToCopy);
            $("#" + dayKey + "HoursToAvail").val(endToCopy);
        });
        <?php } ?>
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>