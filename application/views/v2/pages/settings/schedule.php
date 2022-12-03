<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>

<style>
    .calendar-account .nsm-card:hover {
        border-color: #6a4a86;
    }
    .event-colors{
        list-style: none;
        padding: 0px;
        margin-top: 28px;
    }
    .event-colors li{
        display: inline-block;
        margin: 5px;
        width: 100%;
    }
    .event-colors .e-color{
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 100%;
        border: 3px solid #fff;
    }
    .event-colors .e-color-name{
        position: relative;
        top: -10px;
    }
    .event-colors .e-color-actions{
        float: right;
    }
    .event-colors .e-color-actions a{
        display: inline-block;
        margin: 5px;
        font-size: 11px;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/calendar_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Configure your settings to allow employees to see the full schedule or just their own. You can also set up notification. Simply select the item on each field line and save.
                        </div>
                    </div>
                </div>
                <?php echo form_open('settings/schedule', ['class' => 'form-validate require-validation', 'id' => 'schedule_settings_form', 'autocomplete' => 'off']); ?>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <label class="content-title">Calendar Timezone</label>
                        <label class="content-subtitle mb-2">Select the timezone that will be used to display all calendar dates.</label>
                        <select name="calendar_timezone" class="nsm-field form-select" required>
                            <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                <option value="<?php echo $key ?>" <?php echo ($settings['calendar_timezone'] === $key) ? "selected" : "" ?>>
                                    <?php echo $zone ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="content-title">Job Time Settings</label>
                        <label class="content-subtitle mb-2">Time Interval Settings</label>
                        <select name="job_time_setting" id="library_template" class="nsm-field form-select" required>
                            <option value="" selected disabled>Select</option>
                            <option <?= $settings['job_time_setting'] == 1 ? 'selected="selected"' : ''; ?> value="1">1 hour</option>
                            <option <?= $settings['job_time_setting'] == 2 ? 'selected="selected"' : ''; ?> value="2">2 hours</option>
                            <option <?= $settings['job_time_setting'] == 3 ? 'selected="selected"' : ''; ?> value="3">3 hours</option>
                            <option <?= $settings['job_time_setting'] == 4 ? 'selected="selected"' : ''; ?> value="4">4 hours</option>
                            <option <?= $settings['job_time_setting'] == 5 ? 'selected="selected"' : ''; ?> value="5">5 hours</option>
                            <option <?= $settings['job_time_setting'] == 6 ? 'selected="selected"' : ''; ?> value="6">6 hours</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <label class="content-title">Calendar Default View</label>
                        <label class="content-subtitle mb-2">Set the caledar default view.</label>
                        <select name="calendar_default_view" class="nsm-field form-select" required>
                            <?php foreach (config_item('calender_views') as $key => $zone) { ?>
                                <option value="<?php echo $zone ?>" <?php echo ($settings['calendar_default_view'] === $key) ? "selected" : "" ?>>
                                    <?php echo $zone ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="content-title">Calendar Week Starts On</label>
                        <label class="content-subtitle mb-2">Select the day when a week starts.</label>
                        <select name="calendar_first_day" class="nsm-field form-select" required>
                            <option value="Sunday" <?php echo ($settings['calendar_first_day'] === "Sunday") ? "selected" : "" ?>>
                                Sunday
                            </option>
                            <option value="Monday" <?php echo ($settings['calendar_first_day'] === "Monday") ? "selected" : "" ?>>
                                Monday
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <label class="content-title mb-2">Calendar Day Starts On</label>
                        <input type="text" name="calender_day_starts_on" class="nsm-field form-control timepicker" value="<?php echo (!empty($settings['calender_day_starts_on'])) ? $settings['calender_day_starts_on'] : '' ?>" required />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="content-title mb-2">Calendar Day Ends On</label>
                        <input type="text" name="calender_day_ends_on" class="nsm-field form-control timepicker" value="<?php echo (!empty($settings['calender_day_ends_on'])) ? $settings['calender_day_ends_on'] : '' ?>" required />
                    </div>
                </div>                
                <div class="row g-3 mb-2">
                    <div class="col-12 col-md-4 calendar-account">
                        <label class="content-title">Calendar Account</label>
                        <label class="content-subtitle mb-2">&nbsp;</label>
                        <ul style="list-style: none; margin: unset; padding: unset">
                            <?php if ($is_glink) { ?>
                                <li type="button" id="btn_disconnect_gmail" class="mb-2">
                                    <div class="nsm-card">
                                        <div class="nsm-card-header mb-0">
                                            <div class="nsm-card-title">
                                                <span>Gmail / G Suite - Connected</span>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                            <label class="content-subtitle fw-bold">Gmail Account <span style="color:red;">(Unbind Account)</span></label>
                                            <label class="content-subtitle">Note : This will check or create NsmarTrac calendar for auto add events to google calendar</label>
                                        </div>
                                    </div>
                                </li>
                            <?php } else { ?>
                                <li type="button" onclick="checkAuth()" class="mb-2">
                                    <div class="nsm-card">
                                        <div class="nsm-card-header mb-0">
                                            <div class="nsm-card-title">
                                                <span>Gmail / G Suite</span>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                            <label class="content-subtitle fw-bold">Gmail Account</label>
                                            <label class="content-subtitle">Note : This will check or create NsmarTrac calendar for auto add events to google calendar</label>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <li type="button" class="mb-2">
                                <div class="nsm-card">
                                    <div class="nsm-card-header mb-0">
                                        <div class="nsm-card-title">
                                            <span>Hotmail Account</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <label class="content-subtitle">Hotmail Account</label>
                                    </div>
                                </div>
                            </li>
                            <li type="button" class="mb-2">
                                <div class="nsm-card">
                                    <div class="nsm-card-header mb-0">
                                        <div class="nsm-card-title">
                                            <span>Apple</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <label class="content-subtitle">Apple Account</label>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="mt-5">
                            <label class="content-title">Calendar Event Color</label>
                            <label class="content-subtitle mb-2" style="display:block;width: 100%;">
                                Define event color to easily identity an event.
                                <a class="nsm-button primary btn-add-event-color" href="javascript:void(0);" style="float:right;font-size: 11px;"><i class='bx bx-plus-circle'></i> Add Event Color</a>
                            </label>
                            <?php $row_count = 0; ?>
                            <ul class="event-colors">
                                <?php foreach ($colorSettings as $c) { ?>
                                    <?php $rowid = generateRandomString(5); ?>
                                    <li id="c-row-<?= $rowid; ?>">
                                        <input type="hidden" name="color_name[]" value="<?= $c->color_name; ?>" />
                                        <input type="hidden" name="color_code[]" value="<?= $c->color_code; ?>" />
                                        <span class="e-color" style="background-color: <?= $c->color_code; ?>;"></span> 
                                        <span class="e-color-name"><?= $c->color_name; ?></span>
                                        <span class="e-color-actions">
                                            <a class="nsm-button primary btn-edit-event-color" data-id="<?= $rowid; ?>" data-cname="<?= $c->color_name; ?>" data-ccode="<?= $c->color_code; ?>"><i class='bx bx-calendar-edit'></i></a>
                                            <a class="nsm-button primary btn-delete-event-color" href="javascript:void(0);"><i class='bx bx-trash' ></i></a>
                                        </span>
                                    </li>
                                    <?php $row_count++; ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="content-title">Calendar Job/Event Display Options</label>
                        <label class="content-subtitle mb-2">Set the calendar information.</label>

                        <div class="nsm-card h-auto">
                            <div class="nsm-card-content">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="work_order_show_customer" id="work_order_show_customer" value="1" <?= !empty($settings['work_order_show_customer']) && $settings['work_order_show_customer'] == 1 ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_customer">Customer name</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="work_order_show_details" id="work_order_show_details" value="1" <?= !empty($settings['work_order_show_details']) && $settings['work_order_show_details'] == 1 ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_details">Job address and description</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="work_order_show_price" id="work_order_show_price" value="1" <?= !empty($settings['work_order_show_price']) && $settings['work_order_show_price'] == 1 ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_price">Price</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="work_order_show_link" id="work_order_show_link" value="1" <?= !empty($settings['work_order_show_link']) && $settings['work_order_show_link'] == 1 ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_link">Url Links</label>
                                </div>
                                <hr>
                                <a href="<?php echo base_url('settings') . '/notifications' ?>" class="nsm-link">Manage schedule notifications</a>
                            </div>
                        </div>

                        <div class="mt-3">
                        <label class="content-title">Auto add to Google Calendar</label>
                        <label class="content-subtitle mb-2">Select which module will auto add to your google calendar.</label>

                        <div class="nsm-card h-auto">
                            <div class="nsm-card-content">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="google_calendar[]" id="" value="Appointment" <?= !empty($settings['google_calendar']) && in_array('Appointment', $settings['google_calendar']) ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_customer">Appointment</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="google_calendar[]" id="" value="Job" <?= !empty($settings['google_calendar']) && in_array('Job', $settings['google_calendar']) ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_details">Job</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="google_calendar[]" id="" value="Event" <?= !empty($settings['google_calendar']) && in_array('Event', $settings['google_calendar']) ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_price">Events</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="google_calendar[]" id="" value="Service Ticket" <?= !empty($settings['google_calendar']) && in_array('Service Ticket', $settings['google_calendar']) ? "checked=checked" : "" ?>>
                                    <label class="form-check-label" for="work_order_show_link">Service Tickets</label>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="mt-3">
                            <label class="content-title">Calendar Default Tab</label>
                            <label class="content-subtitle mb-2">Set the calendar default view.</label>

                            <div class="nsm-card h-auto">
                                <div class="nsm-card-content">
                                    <div class="form-check">
                                        <input class="form-check-input chk-default-calendar-tab" type="checkbox" name="calendar_default_tab" id="default_tab_employee" value="employee" <?= !empty($settings['calendar_default_tab']) && $settings['calendar_default_tab'] == 'employee' ? "checked=checked" : "" ?>>
                                        <label class="form-check-label" for="default_tab_employee">Employee</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input chk-default-calendar-tab" type="checkbox" name="calendar_default_tab" id="default_tab_month" value="month" <?= !empty($settings['calendar_default_tab']) && $settings['calendar_default_tab'] == 'month' ? "checked=checked" : "" ?>>
                                        <label class="form-check-label" for="default_tab_month">Month</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input chk-default-calendar-tab" type="checkbox" name="calendar_default_tab" id="default_tab_day" value="day" <?= !empty($settings['calendar_default_tab']) && $settings['calendar_default_tab'] == 'day' ? "checked=checked" : "" ?>>
                                        <label class="form-check-label" for="default_tab_day">Day</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input chk-default-calendar-tab" type="checkbox" name="calendar_default_tab" id="default_tab_3d" value="3d" <?= !empty($settings['calendar_default_tab']) && $settings['calendar_default_tab'] == '3d' ? "checked=checked" : "" ?>>
                                        <label class="form-check-label" for="default_tab_3d">3 Days</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input chk-default-calendar-tab" type="checkbox" name="calendar_default_tab" id="default_tab_week" value="week" <?= !empty($settings['calendar_default_tab']) && $settings['calendar_default_tab'] == 'week' ? "checked=checked" : "" ?>>
                                        <label class="form-check-label" for="default_tab_week">Week</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input chk-default-calendar-tab" type="checkbox" name="calendar_default_tab" id="default_tab_list" value="list" <?= !empty($settings['calendar_default_tab']) && $settings['calendar_default_tab'] == 'list' ? "checked=checked" : "" ?>>
                                        <label class="form-check-label" for="default_tab_list">List</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <button type="submit" class="nsm-button primary">Save Changes</button>
                    </div>                    
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <!-- Add event color -->
        <div class="modal fade nsm-modal fade" id="modalAddEventColor" aria-labelledby="modalAddEventColorLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="new_feed_modal_label">Add Event Color</span>
                        <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                <input type="text" name="color_name" id="add-color-name" value=""  class="nsm-field form-control" required="" autocomplete="off" />
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Color</label>
                                <input type="text" name="color_code" id="add-color-code" class="nsm-field form-control" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button name="btn_close_modal" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button name="btn_add_event_color" type="button" class="nsm-button primary btn-append-event-color">Add</button>
                    </div>
                    </form>                      
                </div>
            </div>
        </div>

        <!-- Add edit color -->
        <div class="modal fade nsm-modal fade" id="modalEditEventColor" aria-labelledby="modalEditEventColorLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="new_feed_modal_label">Edit Event Color</span>
                        <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-color-id" value="">
                        <div class="row g-3">
                            <div class="col-12 col-md-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                <input type="text" name="edit_color_name" id="edit-color-name" value=""  class="nsm-field form-control" required="" autocomplete="off" />
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Color</label>
                                <input type="text" name="edit_color_code" id="edit-color-code" class="nsm-field form-control" required="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button name="btn_close_modal" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button name="btn_add_event_color" type="button" class="nsm-button primary btn-update-event-color">Update</button>
                    </div>
                    </form>                      
                </div>
            </div>
        </div>


    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/bootstrap-colorpicker.min.css") ?>">
<script src="<?= base_url("assets/js/bootstrap-colorpicker.min.js"); ?>"></script>
<script src="https://apis.google.com/js/client.js?onload=checkAuth"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#add-color-code').colorpicker({
            horizontal: true,
            format: "hex"
        });

        $('#edit-color-code').colorpicker({
            horizontal: true,
            format: "hex"
        });

        $(".timepicker").datetimepicker({
            format: 'hh:mm A'
        });

        $('.btn-add-event-color').click(function(){
            $('#modalAddEventColor').modal('show');
        });

        $(document).on('click', '.btn-edit-event-color', function(){
            var cname = $(this).data('cname');
            var ccode = $(this).data('ccode');
            var cid   = $(this).data('id');

            $('#edit-color-name').val(cname);
            $('#edit-color-code').val(ccode);
            $('#edit-color-id').val(cid);

            $('#edit-color-code').colorpicker('setValue', ccode);

            $('#modalEditEventColor').modal('show');
        });

        $(document).on('click', '.btn-delete-event-color', function(){
            $(this).closest('li').fadeOut(300,function(){
                $(this).closest('li').remove();
            });
        });

        $('.btn-append-event-color').click(function(){
            var color_name = $('#add-color-name').val();
            var color_code = $('#add-color-code').val();
            var color_id   = generateRowId(5);
            var append_color = '<li id="c-row-'+color_id+'"><input type="hidden" name="color_name[]" value="'+color_name+'" /><input type="hidden" name="color_code[]" value="'+color_code+'" /><span class="e-color" style="background-color: '+color_code+';"></span><span class="e-color-name"> '+color_name+'</span><span class="e-color-actions"><a class="nsm-button primary btn-edit-event-color" data-id="'+color_id+'" data-cname="'+color_name+'" data-ccode="'+color_code+'"><i class=\'bx bx-calendar-edit\'></i></a> <a class="nsm-button primary btn-delete-event-color" href="javascript:void(0);"><i class=\'bx bx-trash\'></i></a></span></li>';
            $('.event-colors').append(append_color);

            $('#modalAddEventColor').modal('hide');
            $('#add-color-name').val('');
            $('#add-color-code').val('');
        });

        $('.btn-update-event-color').click(function(){
            var color_name = $('#edit-color-name').val();
            var color_code = $('#edit-color-code').val();
            var color_id   = $('#edit-color-id').val();
            var new_color_id = generateRowId(5);

            var update_append_color = '<li id="c-row-'+new_color_id+'"><input type="hidden" name="color_name[]" value="'+color_name+'" /><input type="hidden" name="color_code[]" value="'+color_code+'" /><span class="e-color" style="background-color: '+color_code+';"></span><span class="e-color-name"> '+color_name+'</span><span class="e-color-actions"><a class="nsm-button primary btn-edit-event-color" data-id="'+new_color_id+'" data-cname="'+color_name+'" data-ccode="'+color_code+'"><i class=\'bx bx-calendar-edit\'></i></a> <a class="nsm-button primary btn-delete-event-color" href="javascript:void(0);"><i class=\'bx bx-trash\'></i></a></span></li>';

            $('#c-row-'+color_id).fadeOut(300, function(){ 
                $('#c-row-'+color_id).remove();               
                $(update_append_color).hide().appendTo(".event-colors").fadeIn(300);
            });

            $('#modalEditEventColor').modal('hide');            
        });

        function generateRowId(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        $("#btn_disconnect_gmail").click(function() {
            Swal.fire({
                title: 'Unbind Account',
                text: "Unbind your Gmail account?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('settings/calendar_unbind_account'); ?>",
                        data: {
                            account_type: "gmail"
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Success!',
                                text: "Account is successfully unbinded.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });

        $("#schedule_settings_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('settings/schedule'); ?>";
            _this.find("button[type=submit]").html("Saving Changes");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Calendar settings has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });

                    _this.find("button[type=submit]").html("Save Changes");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });

    $(document).on('change', '.chk-default-calendar-tab', function(){
        $(".chk-default-calendar-tab").prop( "checked", false );
        $(this).prop( "checked", true );
    });

    function checkAuth() {
        gapi.auth.authorize({
            'client_id': "<?= $google_credentials['client_id']; ?>",
            'scope': 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/calendar.events',
            'prompt': 'consent',
            'access_type': 'offline',
            'response_type': 'code token',
        }, handleAuthResult);
    }

    function handleAuthResult(authResult) {
        //console.log(authResult);
        var msg1 = '<div class="alert alert-info" role="alert"><img src="' + base_url + '/assets/img/spinner.gif" style="display:inline;" /> Connecting Gmail Account...</div>';
        var url = base_url + "settings/create_google_account";
        var auth_code = authResult['code'];
        if (typeof auth_code !== "undefined") {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    token: authResult['code']
                },
                dataType: 'json',
                beforeSend: function(data) {

                },
                success: function(data) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Calendar Gmail/Gsuit Account Updated Successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });
                    //location.href = base_url + 'settings/schedule?calendar_update=1';
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>