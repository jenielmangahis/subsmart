<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <?php echo form_open_multipart('users/savebusinessdetail', ['id' => 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="action" value="availability" />
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
                                            <input class="form-check-input" type="checkbox" name="weekday[0]" <?= array_key_exists("Monday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_0" value="Monday">
                                            <label class="form-check-label fw-bold" for="weekday_0">Monday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="monHoursFromAvail" id="mondayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Monday']['time_from']; ?>" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="monHoursToAvail" id="mondayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Monday']['time_to']; ?>" />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="weekday[1]" <?= array_key_exists("Tuesday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_1" value="Tuesday">
                                            <label class="form-check-label fw-bold" for="weekday_1">Tuesday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="tueHoursFromAvail" id="tuesdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Tuesday']['time_from']; ?>" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="tueHoursToAvail" id="tuesdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Tuesday']['time_to']; ?>" />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="weekday[2]" <?= array_key_exists("Wednesday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_2" value="Wednesday">
                                            <label class="form-check-label fw-bold" for="weekday_2">Wednesday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="wedHoursFromAvail" id="wednesdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Wednesday']['time_from']; ?>" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="wedHoursToAvail" id="wednesdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Wednesday']['time_to']; ?>" />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="weekday[3]" <?= array_key_exists("Thursday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_3" value="Thursday">
                                            <label class="form-check-label fw-bold" for="weekday_3">Thursday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="thuHoursFromAvail" id="thursdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Thursday']['time_from']; ?>" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="thuHoursToAvail" id="thursdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Thursday']['time_to']; ?>" />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="weekday[4]" <?= array_key_exists("Friday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_4" value="Friday">
                                            <label class="form-check-label fw-bold" for="weekday_4">Friday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="friHoursFromAvail" id="fridayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Friday']['time_from']; ?>" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="friHoursToAvail" id="fridayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Friday']['time_to']; ?>" />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="weekday[5]" <?= array_key_exists("Saturday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_5" value="Saturday">
                                            <label class="form-check-label fw-bold" for="weekday_5">Saturday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="satHoursFromAvail" id="saturdayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Saturday']['time_from']; ?>" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="satHoursToAvail" id="saturdayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Saturday']['time_to']; ?>" />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="weekday[6]" <?= array_key_exists("Sunday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_6" value="Sunday">
                                            <label class="form-check-label fw-bold" for="weekday_6">Sunday</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="sunHoursFromAvail" id="sundayHoursFromAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Sunday']['time_from']; ?>" />
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="sunHoursToAvail" id="sundayHoursToAvail" class="nsm-field form-control timepicker" required value="<?= $data_working_days['Sunday']['time_to']; ?>" />
                                    </div>

                                    <div class="col-12 text-end">
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="tuesday" type="button"><i class='bx bx-copy-alt'></i> Tue</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="wednesday" type="button"><i class='bx bx-copy-alt'></i> Wed</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="thursday" type="button"><i class='bx bx-copy-alt'></i> Thu</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="friday" type="button"><i class='bx bx-copy-alt'></i> Fri</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="saturday" type="button"><i class='bx bx-copy-alt'></i> Sat</button>
                                        <button class="nsm-button btn-sm btn-copy-time" data-key="sunday" type="button"><i class='bx bx-copy-alt'></i> Sun</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>Time Off / Unavailability</span>
                                    <label class="content-subtitle d-block">Please set your unavailable timings and time-off.</label>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Time Off From</label>
                                        <input type="text" name="timeoff_from" class="nsm-field form-control datepicker" required value="<?= $profiledata->start_time_of_day; ?>" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Time Off To</label>
                                        <input type="text" name="timeoff_to" class="nsm-field form-control datepicker" required value="<?= $profiledata->end_time_of_day; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="nsm-button primary m-0 mt-3 float-end">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
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

        $(document).on("submit", "#form-business-details", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('users/savebusinessdetail'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Services was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    _this.trigger("reset");

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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>