<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div class="modal right fade nsm-modal" id="time-activity-settings" role="dialog" style="z-index: 1056">
        <div class="modal-dialog" role="document" style="width: 20%">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Choose what you use</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="row">
                        <div class="col">
                            <div class="label">
                                Changes you make here apply to all timesheets
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="toggle-service" value="1" <?=is_null($timesheetSettings) || $timesheetSettings->service === "1" ? 'checked' : ''?>>
                                <label for="toggle-service" class="form-check-label">Show service</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="toggle-billable" value="1" <?=is_null($timesheetSettings) || $timesheetSettings->billable === "1" ? 'checked' : ''?>>
                                <label for="toggle-billable" class="form-check-label">Make time activities billable</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="toggle-cost_rates" value="1" <?=is_null($timesheetSettings) || $timesheetSettings->cost_rates === "1" ? 'checked' : ''?>>
                                <label for="toggle-cost_rates" class="form-check-label">Show cost rates per time entry</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form onsubmit="submitModalForm(event, this)" id="modal-form">
        <div id="weeklyTimesheetModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Weekly Timesheet</span>
                        <button type="button" id="time-activity-settings-button"><i class="bx bx-fw bx-cog"></i></button>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 col-md-2 grid-mb">
                                        <select name="person_tracking" id="person_tracking" class="form-control nsm-field" required>
                                            <option value="" disabled selected>Whose time are you tracking?</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2 grid-mb">
                                        <select name="week_dates" id="weekDates" class="form-control nsm-field" required onchange="tableWeekDate(this)">
                                            <?php foreach($dropdown['weeks'] as $week): ?>
                                                <option value="<?php echo $week['firstDay'] . '-' . $week['lastDay']; ?>" <?php echo ($week['selected']) ? 'selected' : ''?>><?php echo $week['firstDay'] . ' to ' . $week['lastDay']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2 offset-md-6 text-end grid-mb">
                                        <h6>TOTAL HOURS</h6>
                                        <h2 id="totalHours">00:00</h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6 offset-md-6 grid-mb text-end">
                                        <div class="nsm-page-button page-button-container">
                                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_printable_checks_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button primary">
                                                <i class='bx bx-fw bx-export'></i>
                                            </button>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                                <p class="m-0">Columns</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_sun" class="form-check-input">
                                                    <label for="chk_sun" class="form-check-label">Sun</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_mon" class="form-check-input">
                                                    <label for="chk_mon" class="form-check-label">Mon</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_tue" class="form-check-input">
                                                    <label for="chk_tue" class="form-check-label">Tue</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_wed" class="form-check-input">
                                                    <label for="chk_wed" class="form-check-label">Wed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_thu" class="form-check-input">
                                                    <label for="chk_thu" class="form-check-label">Thu</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_fri" class="form-check-input">
                                                    <label for="chk_fri" class="form-check-label">Fri</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_sat" class="form-check-input">
                                                    <label for="chk_sat" class="form-check-label">Sat</label>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <table class="nsm-table clickable" id="timesheet-table">
                                            <thead>
                                                <tr>
                                                    <td data-name="Num">#</td>
                                                    <td data-name="Details" width="25%">DETAILS</td>
                                                    <td class="sunday_field text-end">
                                                        <p class="m-0">SUN</p>
                                                        <p class="m-0">3</p>
                                                    </td>
                                                    <td class="monday_field text-end">
                                                        <p class="m-0">MON</p>
                                                        <p class="m-0">4</p>
                                                    </td>
                                                    <td class="tuesday_field text-end">
                                                        <p class="m-0">TUE</p>
                                                        <p class="m-0">5</p>
                                                    </td>
                                                    <td class="wednesday_field text-end">
                                                        <p class="m-0">WED</p>
                                                        <p class="m-0">6</p>
                                                    </td>
                                                    <td class="thursday_field text-end">
                                                        <p class="m-0">THU</p>
                                                        <p class="m-0">7</p>
                                                    </td>
                                                    <td class="friday_field text-end">
                                                        <p class="m-0">FRI</p>
                                                        <p class="m-0">8</p>
                                                    </td>
                                                    <td class="saturday_field text-end">
                                                        <p class="m-0">SAT</p>
                                                        <p class="m-0">9</p>
                                                    </td>
                                                    <td data-name="Total">TOTAL</td>
                                                    <td data-name="Manage"></td>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <div class="row m-0">
                                                                <div class="col-6 p-0">
                                                                    <select name="customer[]" class="form-control nsm-field">
                                                                        <option value="" disabled selected>Choose a customer</option>
                                                                    </select>
                                                                    <div class="service-cont" <?=!is_null($timesheetSettings) && $timesheetSettings->service === "0" ? 'style="display: none"' : ''?>>
                                                                        <select name="service[]" class="form-control nsm-field">
                                                                            <option value="" disabled selected>Choose the service worked on</option>
                                                                        </select>
                                                                    </div>
                                                                    <textarea name="description[]" class="form-control nsm-field" placeholder="Description"></textarea>
                                                                </div>
                                                                <div class="col-6 d-flex align-items-end pr-0">
                                                                    <?php if(is_null($timesheetSettings) || $timesheetSettings->billable === "1") : ?>
                                                                    <div class="row">
                                                                        <div class="col d-flex align-items-center pe-0">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input weekly-billable" id="billable_1" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                                                                <label class="form-check-label" for="billable_1">Billable(/hr)</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="sunday_field"><input type="text" name="sunday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="monday_field"><input type="text" name="monday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="tuesday_field"><input type="text" name="tuesday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="wednesday_field"><input type="text" name="wednesday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="thursday_field"><input type="text" name="thursday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="friday_field"><input type="text" name="friday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="saturday_field"><input type="text" name="saturday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="total-cell"></td>
                                                        <td>
                                                            <button type="button" class="nsm-button delete-row">
                                                                <i class='bx bx-fw bx-trash'></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <div class="row m-0">
                                                                <div class="col-6 p-0">
                                                                    <select name="customer[]" class="form-control nsm-field">
                                                                        <option value="" disabled selected>Choose a customer</option>
                                                                    </select>
                                                                    <div class="service-cont" <?=!is_null($timesheetSettings) && $timesheetSettings->service === "0" ? 'style="display: none"' : ''?>>
                                                                        <select name="service[]" class="form-control nsm-field">
                                                                            <option value="" disabled selected>Choose the service worked on</option>
                                                                        </select>
                                                                    </div>
                                                                    <textarea name="description[]" class="form-control nsm-field" placeholder="Description"></textarea>
                                                                </div>
                                                                <div class="col-6 d-flex align-items-end pr-0">
                                                                    <?php if(is_null($timesheetSettings) || $timesheetSettings->billable === "1") : ?>
                                                                    <div class="row">
                                                                        <div class="col d-flex align-items-center pe-0">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input weekly-billable" id="billable_2" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                                                                <label class="form-check-label" for="billable_2">Billable(/hr)</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="sunday_field"><input type="text" name="sunday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="monday_field"><input type="text" name="monday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="tuesday_field"><input type="text" name="tuesday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="wednesday_field"><input type="text" name="wednesday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="thursday_field"><input type="text" name="thursday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="friday_field"><input type="text" name="friday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="saturday_field"><input type="text" name="saturday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="total-cell"></td>
                                                        <td>
                                                            <button type="button" class="nsm-button delete-row">
                                                                <i class='bx bx-fw bx-trash'></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <div class="row m-0">
                                                                <div class="col-6 p-0">
                                                                    <select name="customer[]" class="form-control nsm-field">
                                                                        <option value="" disabled selected>Choose a customer</option>
                                                                    </select>
                                                                    <div class="service-cont" <?=!is_null($timesheetSettings) && $timesheetSettings->service === "0" ? 'style="display: none"' : ''?>>
                                                                        <select name="service[]" class="form-control nsm-field">
                                                                            <option value="" disabled selected>Choose the service worked on</option>
                                                                        </select>
                                                                    </div>
                                                                    <textarea name="description[]" class="form-control nsm-field" placeholder="Description"></textarea>
                                                                </div>
                                                                <div class="col-6 d-flex align-items-end pr-0">
                                                                    <?php if(is_null($timesheetSettings) || $timesheetSettings->billable === "1") : ?>
                                                                    <div class="row">
                                                                        <div class="col d-flex align-items-center pe-0">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input weekly-billable" id="billable_3" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                                                                <label class="form-check-label" for="billable_3">Billable(/hr)</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="sunday_field"><input type="text" name="sunday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="monday_field"><input type="text" name="monday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="tuesday_field"><input type="text" name="tuesday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="wednesday_field"><input type="text" name="wednesday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="thursday_field"><input type="text" name="thursday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="friday_field"><input type="text" name="friday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="saturday_field"><input type="text" name="saturday_hours[]" class="form-control nsm-field day-input"></td>
                                                        <td class="total-cell"></td>
                                                        <td>
                                                            <button type="button" class="nsm-button delete-row">
                                                                <i class='bx bx-fw bx-trash'></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <tfoot>
                                                <tr class="text-end">
                                                    <td></td>
                                                    <td>TOTAL</td>
                                                    <td class="sunday_total"></td>
                                                    <td class="monday_total"></td>
                                                    <td class="tuesday_total"></td>
                                                    <td class="wednesday_total"></td>
                                                    <td class="thursday_total"></td>
                                                    <td class="friday_total"></td>
                                                    <td class="saturday_total"></td>
                                                    <td>00:00</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="11">
                                                        <div class="nsm-page-buttons page-buttons-container">
                                                            <button type="button" class="nsm-button" id="add-table-line" data-target="#timesheet-table">
                                                                Add lines
                                                            </button>
                                                            <button type="button" class="nsm-button" id="clear-table-line" data-target="#timesheet-table">
                                                                Clear all lines
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col-md-4">
                                <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-4 d-flex">
                                <a href="#" class="text-dark text-decoration-none m-auto" id="copy-last-timesheet">Copy last timesheet</a>
                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group float-end" role="group">
                                    <button type="button" class="nsm-button success" onclick="saveAndNewForm(event)">
                                        Save and new
                                    </button>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-fw bx-chevron-up text-white"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="nsm-button float-end" id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of modal-->
    </form>
</div>