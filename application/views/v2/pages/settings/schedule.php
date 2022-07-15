<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>

<style>
    .calendar-account .nsm-card:hover {
        border-color: #6a4a86;
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
                        <label class="content-subtitle mb-2">TSet the caledar default view.</label>
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
                            <option value="0" <?php echo ($settings['calendar_first_day'] === "Sunday") ? "selected" : "" ?>>
                                Sunday
                            </option>
                            <option value="1" <?php echo ($settings['calendar_first_day'] === "Monday") ? "selected" : "" ?>>
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
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="content-title">Calendar Job/Event Display Options</label>
                        <label class="content-subtitle mb-2">TSet the caledar default view.</label>

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
    </div>
</div>

<script src="https://apis.google.com/js/client.js?onload=checkAuth"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".timepicker").datetimepicker({
            format: 'hh:mm A'
        });

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
                    location.href = base_url + 'settings/schedule?calendar_update=1';
                },
                error: function(e) {
                    console.log(e);
                }
            });
        } else {
            alert('warning!');
        }
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>