<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style type="text/css">
    #ts_schedule_tbl thead td {
        text-align: center !important;
        font-size: 14px !important;
        font-weight: bold !important;
        padding: 10px;
    }

    #ts_schedule_tbl .day {
        background: #d6e6f3;
    }

    .week-day,
    .week-date,
    .employee-name,
    .sub-text {
        display: block;
    }

    .employee-name {
        font-weight: bold;
    }

    .sub-text {
        font-style: italic;
        color: grey;
    }

    .center {
        text-align: center;
    }

    .ts_schedule {
        width: 200px;
    }

    .week-label {
        font-weight: bold;
    }

    /*Table loader*/
    #ts_schedule_tbl_wrapper {
        display: none;
    }

    .table-ts-loader {
        display: block;
        margin: 0 auto;
        position: relative;
        z-index: 20;
        width: 100%;
        text-align: center;
    }

    .table-ts-loader .ts-loader-img {
        margin: auto;
        font-size:40px
    }

  
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                   <!-- Date Selector -->
                   <form
                            action="<?= base_url() ?>/timesheet/download_attendance_sheet_logs_to_excel"
                            target="_blank" method="POST">
                            <div class="d-flex mb-5">
                                <div class="col-lg-2" style="margin-bottom: 12px">
                                    <label for="from_date_logs" class="week-label">From:</label>
                                    <?php
                                    date_default_timezone_set($this->session->userdata('usertimezone'));
                                    ?>
                                    <input type="text" name="date_from" id="from_date_logs"
                                        class="form-control ts_schedule"
                                        value="<?php echo date('m/d/Y', strtotime('monday this week')) ?>">
                                </div>
                                <div class="col-lg-2" style="margin-bottom: 12px">
                                    <label for="to_date_logs" class="week-label">To:</label>
                                    <input type="text" name="date_to" id="to_date_logs" class="form-control ts_schedule"
                                        value="<?php echo date('m/d/Y') ?>">
                                </div>
                                <div class="col-lg-2" style="margin-bottom: 12px">
                                    <div><label for="to_date_logs" class="week-label">&nbsp;</label></div>
                                    <button type="submit" class="nsm-button primary  action-btn"><i class="fa fa-download"
                                            aria-hidden="true"></i> Export to Excel</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table id="timeLogTable" class="table table-bordered table-striped"
                                    style="display:none;">
                                    <thead>
                                        <tr>
                                            <td style="width: 200px;">Employee</td>
                                            <td>Action</td>
                                            <td>Shift Date</td>
                                            <td>Shift Start</td>
                                            <td>Shift End</td>
                                            <td>Clock In</td>
                                            <td>Clock Out</td>
                                            <td>Break in</td>
                                            <td>Break out</td>
                                            <td>Expected Hours</td>
                                            <td>Worked Hours</td>
                                            <td>Break Duration</td>
                                            <td>Over Time</td>
                                            <td>OT Status</td>
                                        </tr>
                                    </thead>
                                    <tbody class="employee-tbody">

                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                            <div class="table-ts-loader" >
                                        <span class="bx bx-loader bx-spin ts-loader-img"></span>
                                </div>
                        </div>
                      
                        <!-- end row -->    

                                            <!--Adding Project Schedule-->
                    <div class="modal-right-side">
                        <div class="modal right fade" id="edit_attendancelogs" tabindex="" role="dialog"
                            aria-labelledby="edit_attendance_log">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="edit_attendance_log"><i class="fa fa-pencil-square-o"></i> <span>Edit
                                                Attendance Log </span> <label id="edit_attendance_name">Lou Pinton</label><a
                                                id="editors_footprint">Edited by Lou Pinton last 03-22-2021 10:00 AM</a></h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="" method="post" id="formNewProject">
                                        <div class="modal-body">
                                            <input type="hidden" name="timesheet_attendance_id" id="form_timesheet_attendance_id">
                                            <input type="hidden" name="user_id" id="form_user_id">
                                            <input type="hidden" name="timesheet_shift_schedule_id" id="form_timesheet_shift_schedule_id">
                                            <div class="alert alert-success" role="alert">
                                                To edit shift schedule, please proceed to Schedule tab.
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Shift Start</label>
                                                        <input type="text" name="shift_start" id="form_shift_start" class="form-control"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group hiddenSection">
                                                        <label for="">Shift End</label>
                                                        <input type="text" name="shift_end" id="form_shift_end"
                                                            class="form-control ts-start-date" value="" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Clock In</label>
                                                        <input type="date" name="shift_start" id="form_clockin_date" class="form-control"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group hiddenSection">
                                                        <label for="">&nbsp;</label>
                                                        <input type="time" name="shift_end" id="form_clockin_time"
                                                            class="form-control ts-start-date" value=""
                                                            onchange="edit_attendance_log_form_changed()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Clock Out</label>
                                                        <input type="date" name="shift_start" id="form_clockout_date" class="form-control"
                                                            onchange="edit_attendance_log_form_changed()">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group hiddenSection">
                                                        <label for="">&nbsp;</label>
                                                        <input type="time" name="shift_end" id="form_clockout_time"
                                                            class="form-control ts-start-date" value=""
                                                            onchange="edit_attendance_log_form_changed()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Break In</label>
                                                        <input type="date" name="shift_start" id="form_breakin_date" class="form-control"
                                                            onchange="edit_attendance_log_form_changed()">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group hiddenSection">
                                                        <label for="">&nbsp;</label>
                                                        <input type="time" name="shift_end" id="form_breakin_time"
                                                            class="form-control ts-start-date" value=""
                                                            onchange="edit_attendance_log_form_changed()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Break Out</label>
                                                        <input type="date" name="shift_start" id="form_breakout_date" class="form-control"
                                                            onchange="edit_attendance_log_form_changed()">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group hiddenSection">
                                                        <label for="">&nbsp;</label>
                                                        <input type="time" name="shift_end" id="form_breakout_time"
                                                            class="form-control ts-start-date" value=""
                                                            onchange="edit_attendance_log_form_changed()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-info" role="alert">
                                                Overtime status of this attendance is <span id="form_ot_status"
                                                    style="font-weight: bold;">Approved</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group hiddenSection">

                                                        <table class="table table-bordered table-striped no-footer dataTable"
                                                            style="width: auto;" role="grid" aria-describedby="timeLogTable_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <td class="sorting" tabindex="0" aria-controls="timeLogTable"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Expected Hours: activate to sort column ascending"
                                                                        style="width: 25%;">Expected Shift Duration</td>
                                                                    <td class="sorting" tabindex="0" aria-controls="timeLogTable"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Expected Hours: activate to sort column ascending"
                                                                        style="width: 25%;">Expected Break Duration</td>
                                                                    <td class="sorting" tabindex="0" aria-controls="timeLogTable"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Worked Hours: activate to sort column ascending"
                                                                        style="width: 25%;">Expected Work Hours</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="employee-tbody">
                                                                <tr role="row" class="odd">
                                                                    <td class="center" id="form_expected_hours"></td>
                                                                    <td class="center" id="form_expected_break_duration"></td>
                                                                    <td class="center" id="form_expected_work_hours"></td>
                                                                </tr>
                                                            </tbody>
                                                            <thead>
                                                                <tr role="row">
                                                                    <td class="sorting" tabindex="0" aria-controls="timeLogTable"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Worked Hours: activate to sort column ascending"
                                                                        style="width: 25%;">Late in Minutes</td>
                                                                    <td class="sorting" tabindex="0" aria-controls="timeLogTable"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Worked Hours: activate to sort column ascending"
                                                                        style="width: 25%;">Worked Hours</td>
                                                                    <td class="sorting" tabindex="0" aria-controls="timeLogTable"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Break Duration: activate to sort column ascending"
                                                                        style="width: 25%;">Break Duration</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="employee-tbody">
                                                                <tr role="row" class="odd">

                                                                    <td class="center num_only time-log" id="form_minutes_late"></td>
                                                                    <td class="center num_only time-log" id="form_worked_hours">8.28</td>
                                                                    <td class="center num_only time-log" id="form_break_duration">0.00</td>
                                                                </tr>
                                                            </tbody>
                                                            <thead>
                                                                <tr role="row">
                                                                    <td class="sorting" tabindex="0" aria-controls="timeLogTable"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Break Duration: activate to sort column ascending"
                                                                        style="width: 25%;">Overtime</td>
                                                                    <td class="sorting" tabindex="0" colspan="2"
                                                                        aria-controls="timeLogTable" rowspan="1" colspan="1"
                                                                        aria-label="Over Time: activate to sort column ascending"
                                                                        style="text-align:center;">Payable Hours</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="employee-tbody">
                                                                <tr role="row" class="odd">
                                                                    <td class="center num_only time-log" id="form_over_time">0.00</td>
                                                                    <td class="center num_only time-log" colspan="2"
                                                                        id="form_payable_hours"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tsNotes">Notes</label>
                                                <textarea name="notes" id="form_attendance_notes" cols="30" rows="3" class="form-control"
                                                    placeholder="(Optional)" style="height: 100%!important;"
                                                    onchange="edit_attendance_log_form_changed()"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-success" id="save_edited_attendance_logs">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of modal-->
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>