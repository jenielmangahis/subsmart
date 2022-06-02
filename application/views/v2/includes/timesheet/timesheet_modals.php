<div class="modal fade nsm-modal fade" id="request_leave_modal" tabindex="-1" aria-labelledby="request_leave_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="request_leave_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Request Leave</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Leave Type</label>
                            <select class="nsm-field form-select" name="pto">
                                <option value="" selected="selected" disabled>Select Type</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Leave Date</label>
                            <input type="text" class="nsm-field form-control" name="leave_date" id="startDateLeave" required data-role="tagsinput">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="request_adjustment_modal" tabindex="-1" aria-labelledby="request_adjustment_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="request_adjustment_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Request Attendance Correction</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="nsm-field form-control" name="timesheet_attendance_id" id="form_timesheet_attendance_id">
                    <input type="hidden" class="nsm-field form-control" name="user_id" id="form_user_id">
                    <input type="hidden" class="nsm-field form-control" name="timesheet_shift_schedule_id" id="form_timesheet_shift_schedule_id">
                    <div class="row gy-3">
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Shift Start</label>
                            <input type="text" class="nsm-field form-control" name="shift_start" id="form_shift_start" disabled>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Shift End</label>
                            <input type="text" class="nsm-field form-control" name="shift_end" id="form_shift_end" disabled>
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">Clock In</label>
                            <input type="text" class="nsm-field form-control" name="shift_start" id="form_clockin_date" disabled>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Clock In Time</label>
                            <input type="text" class="nsm-field form-control datetime" name="shift_end" id="form_clockin_time" onchange="edit_attendance_log_form_changed()">
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">Clock Out</label>
                            <input type="text" class="nsm-field form-control" name="shift_start" id="form_clockout_date" onchange="edit_attendance_log_form_changed()">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Clock Out Time</label>
                            <input type="text" class="nsm-field form-control datetime" name="shift_end" id="form_clockout_time" onchange="edit_attendance_log_form_changed()">
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">Break In</label>
                            <input type="text" class="nsm-field form-control" name="shift_start" id="form_breakin_date" onchange="edit_attendance_log_form_changed()">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Break In Time</label>
                            <input type="text" class="nsm-field form-control datetime" name="shift_end" id="form_breakin_time" onchange="edit_attendance_log_form_changed()">
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">Break Out</label>
                            <input type="text" class="nsm-field form-control" name="shift_start" id="form_breakout_date" onchange="edit_attendance_log_form_changed()">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Break Out Time</label>
                            <input type="text" class="nsm-field form-control datetime" name="shift_end" id="form_breakout_time" onchange="edit_attendance_log_form_changed()">
                        </div>
                        <div class="col-12">
                            <div class="nsm-callout primary">Overtime status of this attendance is <span id="form_ot_status" class="fw-bold">Approved</span></div>
                        </div>
                        <div class="col-12">
                            <table class="nsm-table">
                                <thead>
                                    <tr>
                                        <td data-name="Expected Shift Duration">Expected Shift<br>Duration</td>
                                        <td data-name="Expected Break Duration">Expected Break<br>Duration</td>
                                        <td data-name="Expected Work Hours">Expected Work<br>Hours</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="nsm-text-primary" id="form_expected_hours">-</td>
                                        <td id="form_expected_break_duration">-</td>
                                        <td id="form_expected_work_hours">-</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table class="nsm-table mt-3">
                                <thead>
                                    <tr>
                                        <td data-name="Late in Minutes">Late in Minutes</td>
                                        <td data-name="Worked Hours">Worked Hours</td>
                                        <td data-name="Break Duration">Break Duration</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="nsm-text-primary" id="form_minutes_late">-</td>
                                        <td id="form_worked_hours">8.28</td>
                                        <td id="form_break_duration">0.00</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="nsm-table mt-3">
                                <thead>
                                    <tr>
                                        <td data-name="Overtime">Overtime</td>
                                        <td data-name="Payable Hours">Payable Hours</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="nsm-text-primary" id="form_over_time">0.00</td>
                                        <td id="form_payable_hours">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>