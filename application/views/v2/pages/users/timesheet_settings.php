<?php include viewPath('v2/includes/header'); ?>
<style>
.form-check{
    text-align:center;
}
.form-check-input{
    display: block !important;      
    margin-left:0px !important;
    float:none !important;
    margin:0 auto !important;
}
.form-check-label{
    display: inline-block !important;
    text-align: center !important;
}
.setting-header {
    background-color: #6A4A86;
    padding: 10px;
    color: #ffffff;
    font-size: 14px;
}
.col-day-week{
    display:inline-block;
    width:13%;
}
.col-day-week-timesheet{
    display: inline-block;
    width: 126px;
    padding: 9px;
    background-color: #cecece;

}
.col-timesheet-report{
    display:inline-block;
    width:27%;
}
.timepicker-icon{
    font-size: 30px;
}
.report-schedule-timesheet{
    margin-bottom: 20px;
    margin-top: 32px;
    display: block;
    font-size: 15px;
    text-align: center;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('email_campaigns/add_email_blast') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Timesheet Settings
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">                    
                    <div class="tab-pane container active" id="timesheet_report_settings">
                        <form action="" method="POST" id="frm-timesheet-settings">
                        <div class="row">
                            <div class="col-md-12">                                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="content-title setting-header mb-4 mt-4">Select Start Day Of The Week</label>
                                        <div class="report_schedule">
                                            <div class="col-day-week">
                                                <div class="form-check">
                                                    <input type="radio" name="week_start" value="Sunday" class="form-check-input" <?= $timesheetSettings && $timesheetSettings->workweek_start_day == 'Sunday' ? 'checked=""' : ''; ?> checked="" id="Sunday"><br />
                                                    <label class="form-check-label" for="Sunday">Sun</label>
                                                </div>
                                            </div>

                                            <div class="col-day-week">
                                                <div class="form-check">
                                                    <input type="radio" name="week_start" value="Monday" class="form-check-input" <?= $timesheetSettings && $timesheetSettings->workweek_start_day == 'Monday' ? 'checked=""' : ''; ?> id="Monday"><br />
                                                    <label class="form-check-label" for="Monday">Mon</label>
                                                </div>
                                            </div>

                                            <div class="col-day-week">
                                                <div class="form-check">
                                                    <input type="radio" name="week_start" value="Tuesday" class="form-check-input" <?= $timesheetSettings && $timesheetSettings->workweek_start_day == 'Tuesday' ? 'checked=""' : ''; ?> id="Tuesday"><br />
                                                    <label class="form-check-label" for="Tuesday">Tue</label>
                                                </div>
                                            </div>

                                            <div class="col-day-week">
                                                <div class="form-check">
                                                    <input type="radio" name="week_start" value="Wednesday" class="form-check-input" <?= $timesheetSettings && $timesheetSettings->workweek_start_day == 'Wednesday' ? 'checked=""' : ''; ?> id="Wednesday"><br />
                                                    <label class="form-check-label" for="Wednesday">Wed</label>
                                                </div>
                                            </div>

                                            <div class="col-day-week">
                                                <div class="form-check">
                                                    <input type="radio" name="week_start" value="Thursday" class="form-check-input" <?= $timesheetSettings && $timesheetSettings->workweek_start_day == 'Thursday' ? 'checked=""' : ''; ?> id="Thursday"><br />
                                                    <label class="form-check-label" for="Thursday">Thu</label>
                                                </div>
                                            </div>

                                            <div class="col-day-week">
                                                <div class="form-check">
                                                    <input type="radio" name="week_start" value="Friday" class="form-check-input" <?= $timesheetSettings && $timesheetSettings->workweek_start_day == 'Friday' ? 'checked=""' : ''; ?> id="Friday"><br />
                                                    <label class="form-check-label" for="Thursday">Fri</label>
                                                </div>
                                            </div>

                                            <div class="col-day-week">
                                                <div class="form-check">
                                                    <input type="radio" name="week_start" value="Saturday" class="form-check-input" <?= $timesheetSettings && $timesheetSettings->workweek_start_day == 'Saturday' ? 'checked=""' : ''; ?> id="Saturday"><br />
                                                    <label class="form-check-label" for="Saturday">Sat</label>
                                                </div>
                                            </div>
                                        </div>

                                        <label for="" class="content-title setting-header mb-4 mt-4">Timesheet Report</label>
                                        <div class="form-group ">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="est_wage_privacy" id="est_wage_privacy" <?= $timesheetSettings && $timesheetSettings->timesheet_report_with_estimated_wages == 1 ? 'checked=""' : '' ?>>
                                                <label class="custom-control-label" for="est_wage_privacy">
                                                        Include <b>Estimated Wages</b> to the weekly timesheet report.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" on class="custom-control-input" name="subcribe_weekly_report" id="subcribe_weekly_report" <?= $timesheetSettings && $timesheetSettings->allow_email_report == 1 ? 'checked=""' : '' ?>>
                                                <label class="custom-control-label" for="subcribe_weekly_report">Toggle on if you want to receive the timesheet report</label>
                                            </div>
                                        </div>

                                        <?php 
                                            $show_send_report_groups = 1;
                                            if( $timesheetSettings && $timesheetSettings->allow_email_report == 0 ){
                                                $show_send_report_groups = 0;                                                
                                            }

                                            $days_report_email = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                                            if( $timesheetSettings ){
                                                $days_report_email = json_decode($timesheetSettings->allow_email_timesheet_report_days);
                                            }
                                        ?>

                                        <div class="row report_series_div mt-4 mb-4" <?= $show_send_report_groups == 0 ? 'style="display:none;"' : ''; ?>>
                                            <div class="col-md-6">
                                                <label class="form-label"><b>Receive timesheet report</b></label>
                                                <select class="form-control" name="receive_timesheet_report" id="receive-timesheet-report">
                                                    <?php if( $timesheetSettings ){ ?>
                                                        <option value="daily" <?= $timesheetSettings->allow_email_timesheet_report_type == 'daily' ? 'selected="selected"' : '' ?>>Daily</option>
                                                        <option value="biweekly" <?= $timesheetSettings->allow_email_timesheet_report_type == 'biweekly' ? 'selected="selected"' : '' ?>>Biweekly</option>
                                                        <option value="weekly" <?= $timesheetSettings->allow_email_timesheet_report_type == 'weekly' ? 'selected="selected"' : '' ?>>Weekly</option>
                                                    <?php }else{ ?>
                                                        <option value="daily" selected="">Daily</option>
                                                        <option value="biweekly">Biweekly</option>
                                                        <option value="weekly">Weekly</option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label"><b>Select timezone for your Timesheet Report</b></label>
                                                <select class="form-control" id="tz_display_name" name="timesheet_report_timezone">
                                                    <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                                        <option value="<?= $key ?>" <?= $timesheetSettings && $timesheetSettings->timesheet_report_timezone == $key ? 'selected="selected"' : ''; ?>>
                                                            <?= $key ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="report-schedule-timesheet" <?= $show_send_report_groups == 0 ? 'style="display:none;"' : ''; ?>>
                                            <div class="col-day-week-timesheet">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="schedDay[]" value="Sun" class="custom-control-input" id="sched_sun" onclick="return false;" <?= in_array('Sun',$days_report_email) ? 'checked=""' : ''; ?>>
                                                        <label class="custom-control-label" for="sched_sun">Sun</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-day-week-timesheet">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="schedDay[]" value="Mon" class="custom-control-input" id="sched_m" onclick="return false;" <?= in_array('Mon',$days_report_email) ? 'checked=""' : ''; ?>>
                                                        <label class="custom-control-label" for="sched_m">Mon</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-day-week-timesheet">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="schedDay[]" value="Tue" class="custom-control-input" id="sched_t" onclick="return false;" <?= in_array('Tue',$days_report_email) ? 'checked=""' : ''; ?>>
                                                        <label class="custom-control-label" for="sched_t">Tue</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-day-week-timesheet">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="schedDay[]" value="Wed" class="custom-control-input" id="sched_w" onclick="return false;" <?= in_array('Wed',$days_report_email) ? 'checked=""' : ''; ?>>
                                                        <label class="custom-control-label" for="sched_w">Wed</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-day-week-timesheet">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="schedDay[]" value="Thu" class="custom-control-input" id="sched_th" onclick="return false;" <?= in_array('Thu',$days_report_email) ? 'checked=""' : ''; ?>>
                                                        <label class="custom-control-label" for="sched_th">Thu</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-day-week-timesheet">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="schedDay[]" value="Fri" class="custom-control-input" id="sched_f" onclick="return false;" <?= in_array('Fri',$days_report_email) ? 'checked=""' : ''; ?>>
                                                        <label class="custom-control-label" for="sched_f">Fri</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-day-week-timesheet">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="schedDay[]" value="Sat" class="custom-control-input" id="sched_sat" onclick="return false;" <?= in_array('Sat',$days_report_email) ? 'checked=""' : ''; ?>>
                                                        <label class="custom-control-label" for="sched_sat">Sat</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4 report-schedule-time-email" <?= $show_send_report_groups == 0 ? 'style="display:none;"' : ''; ?>>
                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label"><b>Select time</b></label>
                                                <input type="text" name="calendar_day_starts_on" class="nsm-field form-control timepicker" value="<?= $timesheetSettings ? $timesheetSettings->send_time_timesheet_report : $default_time; ?>" required />             
                                                <div id="passwordHelpBlock" class="form-text">Time in which timesheet report will be sent.</div>                                   
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label"><b>Email Address</b></label>
                                                <input type="email" class="form-control" name="email_report" id="email_report" value="<?= $timesheetSettings ? $timesheetSettings->timesheet_report_recipient_email : $default_email; ?>" placeholder="Enter email" required>
                                                <div id="passwordHelpBlock" class="form-text">This is where we will send the timesheet report.</div>
                                            </div>                                            
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-5">
                                        <div class="col-6">
                                            <button type="submit" class="nsm-button primary" style="float: right;">Save Changes</button>
                                        </div>                    
                                    </div>

                                </div> <!-- last -->
                            </div>                                
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
$(function(){    
    $(".timepicker").datetimepicker({
        format: 'hh:mm A'
    });

    $('#frm-timesheet-settings').on('submit', function(e){
        e.preventDefault();

        var url = base_url + 'timesheet/_update_settings';
        Swal.fire({
            title: "Update Timesheet Settings",
            html: "Are all entries correct?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {                
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#frm-timesheet-settings').serialize(),
                    dataType: "json",
                    success: function(data) {                        
                        if( data.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Settings was successfully updated',
                            }).then((result) => {
                                //window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.msg,
                            });
                        }
                    },
                });
            }
        });
    });

});
</script>
<?php include viewPath('v2/includes/footer'); ?>