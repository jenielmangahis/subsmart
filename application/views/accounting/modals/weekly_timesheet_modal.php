<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div class="modal right fade" id="time-activity-settings" tabindex="-1" role="dialog" aria-labelledby="tags-modal">
        <div class="modal-dialog" role="document" style="width: 20%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Choose what you use</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="row">
                        <div class="col">
                            <div class="label">
                                Changes you make here apply to all timesheets
                            </div>
                            <div class="form-check">
                                <div class="checkbox checkbox-sec">
                                    <input type="checkbox" id="toggle-service" value="1" <?=$timesheetSettings->service === "1" ? 'checked' : ''?>>
                                    <label for="toggle-service">Show service</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div class="checkbox checkbox-sec">
                                    <input type="checkbox" id="toggle-billable" value="1" <?=$timesheetSettings->billable === "1" ? 'checked' : ''?>>
                                    <label for="toggle-billable">Make time activities billable</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div class="checkbox checkbox-sec">
                                    <input type="checkbox" id="toggle-cost_rates" value="1" <?=$timesheetSettings->cost_rates === "1" ? 'checked' : ''?>>
                                    <label for="toggle-cost_rates">Show cost rates per time entry</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form onsubmit="submitModalForm(event, this)" id="modal-form">
        <div id="weeklyTimesheetModal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="height: 100%;">
                    <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                        <h4 class="modal-title">Weekly Timesheet</h4>
                        <div class="float-right">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                            <button type="button" id="time-activity-settings-button"><i class="fa fa-cog fa-lg"></i></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card p-0 m-0">
                                    <div class="card-body" style="padding-bottom: 1.25rem">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select name="person_tracking" id="person_tracking" class="form-control" required>
                                                    <option value="" disabled selected>Whose time are you tracking?</option>
                                                    <optgroup label="Employees">
                                                        <?php foreach($dropdown['employees'] as $employee):?>
                                                            <option value="employee-<?php echo $employee->id;?>"><?php echo $employee->FName . ' ' . $employee->LName;?></option>
                                                        <?php endforeach; ?> 
                                                    </optgroup>
                                                    <optgroup label="Vendors">
                                                        <?php foreach($dropdown['vendors'] as $vendor):?>
                                                            <option value="vendor-<?php echo $vendor->id;?>"><?=$vendor->display_name === null || $vendor->display_name === '' ? $vendor->f_name . ' ' . $vendor->l_name : $vendor->display_name?></option>
                                                        <?php endforeach; ?> 
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="week_dates" id="weekDates" class="form-control" required onchange="tableWeekDate(this)">
                                                    <?php foreach($dropdown['weeks'] as $week): ?>
                                                        <option value="<?php echo $week['firstDay'] . '-' . $week['lastDay']; ?>" <?php echo ($week['selected']) ? 'selected' : ''?>><?php echo $week['firstDay'] . ' to ' . $week['lastDay']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col text-right">
                                                <p class="m-0">TOTAL HOURS</p>
                                                <h2 class="m-0" id="totalHours">00:00</h2>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="action-bar h-100 d-flex align-items-center">
                                                    <ul class="ml-auto">
                                                        <li><a href="#" id="save-and-print"><i class="fa fa-print"></i></a></li>
                                                        <li><a href="#" id="save-and-download"><i class="fa fa-download"></i></a></li>
                                                        <li>
                                                            <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-cog"></i>
                                                            </a>
                                                            <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                <p class="m-0">Columns</p>
                                                                <div class="m-0">
                                                                    <div class="checkbox checkbox-sec mt-0 mb-2">
                                                                        <input type="checkbox" class="show-field" id="show_sunday" checked>
                                                                        <label for="show_sunday">Sun</label>
                                                                    </div>
                                                                </div>
                                                                <div class="m-0">
                                                                    <div class="checkbox checkbox-sec mt-0 mb-2">
                                                                        <input type="checkbox" class="show-field" id="show_monday" checked>
                                                                        <label for="show_monday">Mon</label>
                                                                    </div>
                                                                </div>
                                                                <div class="m-0">
                                                                    <div class="checkbox checkbox-sec mt-0 mb-2">
                                                                        <input type="checkbox" class="show-field" id="show_tuesday" checked>
                                                                        <label for="show_tuesday">Tue</label>
                                                                    </div>
                                                                </div>
                                                                <div class="m-0">
                                                                    <div class="checkbox checkbox-sec mt-0 mb-2">
                                                                        <input type="checkbox" class="show-field" id="show_wednesday" checked>
                                                                        <label for="show_wednesday">Wed</label>
                                                                    </div>
                                                                </div>
                                                                <div class="m-0">
                                                                    <div class="checkbox checkbox-sec mt-0 mb-2">
                                                                        <input type="checkbox" class="show-field" id="show_thursday" checked>
                                                                        <label for="show_thursday">Thu</label>
                                                                    </div>
                                                                </div>
                                                                <div class="m-0">
                                                                    <div class="checkbox checkbox-sec mt-0 mb-2">
                                                                        <input type="checkbox" class="show-field" id="show_friday" checked>
                                                                        <label for="show_friday">Fri</label>
                                                                    </div>
                                                                </div>
                                                                <div class="m-0">
                                                                    <div class="checkbox checkbox-sec mt-0 mb-2">
                                                                        <input type="checkbox" class="show-field" id="show_saturday" checked>
                                                                        <label for="show_saturday">Sat</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="timesheet-table-container">
                                                    <div class="timesheet-table">
                                                        <table class="table table-bordered table-hover" id="timesheet-table">
                                                            <thead>
                                                                <th>#</th>
                                                                <th>DETAILS</th>
                                                                <th class="text-right sunday_field" width="5%">
                                                                    <p class="m-0">SUN</p>
                                                                    <p class="m-0">3</p>
                                                                </th>
                                                                <th class="text-right monday_field" width="5%">
                                                                    <p class="m-0">MON</p>
                                                                    <p class="m-0">4</p>
                                                                </th>
                                                                <th class="text-right tuesday_field" width="5%">
                                                                    <p class="m-0">TUE</p>
                                                                    <p class="m-0">5</p>
                                                                </th>
                                                                <th class="text-right wednesday_field" width="5%">
                                                                    <p class="m-0">WED</p>
                                                                    <p class="m-0">6</p>
                                                                </th>
                                                                <th class="text-right thursday_field" width="5%">
                                                                    <p class="m-0">THU</p>
                                                                    <p class="m-0">7</p>
                                                                </th>
                                                                <th class="text-right friday_field" width="5%">
                                                                    <p class="m-0">FRI</p>
                                                                    <p class="m-0">8</p>
                                                                </th>
                                                                <th class="text-right saturday_field" width="5%">
                                                                    <p class="m-0">SAT</p>
                                                                    <p class="m-0">9</p>
                                                                </th>
                                                                <th class="text-right" width="5%">TOTAL</th>
                                                                <th width="0%"></th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="row m-0">
                                                                            <div class="col-md-6 p-0">
                                                                                <select name="customer[]" class="form-control">
                                                                                    <option value="" disabled selected>Choose a customer</option>
                                                                                    <?php foreach($dropdown['customers'] as $customer):?>
                                                                                        <option value="<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                                <div class="service-cont <?=$timesheetSettings->service === "0" ? 'hide' : ''?>">
                                                                                    <select name="service[]" class="form-control">
                                                                                        <option value="" disabled selected>Choose the service worked on</option>
                                                                                        <?php foreach($dropdown['services'] as $service) : ?>
                                                                                            <option value="<?=$service->id?>"><?=$service->title?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <textarea name="description[]" class="form-control" placeholder="Description"></textarea>
                                                                            </div>
                                                                            <div class="col-md-6 d-flex align-items-end pr-0">
                                                                                <?php if($timesheetSettings->billable === "1") : ?>
                                                                                <div class="form-check form-check-inline">
                                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                                        <input class="form-check-input weekly-billable" id="billable_1" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                                                                        <label class="form-check-label" for="billable_1">Billable(/hr)</label>
                                                                                    </div>
                                                                                </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="sunday_field"><input type="text" name="sunday_hours[]" class="form-control day-input"></td>
                                                                    <td class="monday_field"><input type="text" name="monday_hours[]" class="form-control day-input"></td>
                                                                    <td class="tuesday_field"><input type="text" name="tuesday_hours[]" class="form-control day-input"></td>
                                                                    <td class="wednesday_field"><input type="text" name="wednesday_hours[]" class="form-control day-input"></td>
                                                                    <td class="thursday_field"><input type="text" name="thursday_hours[]" class="form-control day-input"></td>
                                                                    <td class="friday_field"><input type="text" name="friday_hours[]" class="form-control day-input"></td>
                                                                    <td class="saturday_field"><input type="text" name="saturday_hours[]" class="form-control day-input"></td>
                                                                    <td class="total-cell"></td>
                                                                    <td><a href="#" class="deleteRow h4"><i class="fa fa-trash"></i></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <div class="row m-0">
                                                                            <div class="col-md-6 p-0">
                                                                                <select name="customer[]" class="form-control">
                                                                                    <option value="" disabled selected>Choose a customer</option>
                                                                                    <?php foreach($dropdown['customers'] as $customer):?>
                                                                                        <option value="<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                                <div class="service-cont <?=$timesheetSettings->service === "0" ? 'hide' : ''?>">
                                                                                    <select name="service[]" class="form-control">
                                                                                        <option value="" disabled selected>Choose the service worked on</option>
                                                                                        <?php foreach($dropdown['services'] as $service) : ?>
                                                                                            <option value="<?=$service->id?>"><?=$service->title?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <textarea name="description[]" class="form-control" placeholder="Description"></textarea>
                                                                            </div>
                                                                            <div class="col-md-6 d-flex align-items-end pr-0">
                                                                                <?php if($timesheetSettings->billable === "1") : ?>
                                                                                <div class="form-check form-check-inline">
                                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                                        <input class="form-check-input weekly-billable" id="billable_2" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                                                                        <label class="form-check-label" for="billable_2">Billable(/hr)</label>
                                                                                    </div>
                                                                                </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="sunday_field"><input type="text" name="sunday_hours[]" class="form-control day-input"></td>
                                                                    <td class="monday_field"><input type="text" name="monday_hours[]" class="form-control day-input"></td>
                                                                    <td class="tuesday_field"><input type="text" name="tuesday_hours[]" class="form-control day-input"></td>
                                                                    <td class="wednesday_field"><input type="text" name="wednesday_hours[]" class="form-control day-input"></td>
                                                                    <td class="thursday_field"><input type="text" name="thursday_hours[]" class="form-control day-input"></td>
                                                                    <td class="friday_field"><input type="text" name="friday_hours[]" class="form-control day-input"></td>
                                                                    <td class="saturday_field"><input type="text" name="saturday_hours[]" class="form-control day-input"></td>
                                                                    <td class="total-cell"></td>
                                                                    <td><a href="#" class="deleteRow h4"><i class="fa fa-trash"></i></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <div class="row m-0">
                                                                            <div class="col-md-6 p-0">
                                                                                <select name="customer[]" class="form-control">
                                                                                    <option value="" disabled selected>Choose a customer</option>
                                                                                    <?php foreach($dropdown['customers'] as $customer):?>
                                                                                        <option value="<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                                <div class="service-cont <?=$timesheetSettings->service === "0" ? 'hide' : ''?>">
                                                                                    <select name="service[]" class="form-control">
                                                                                        <option value="" disabled selected>Choose the service worked on</option>
                                                                                        <?php foreach($dropdown['services'] as $service) : ?>
                                                                                            <option value="<?=$service->id?>"><?=$service->title?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <textarea name="description[]" class="form-control" placeholder="Description"></textarea>
                                                                            </div>
                                                                            <div class="col-md-6 d-flex align-items-end pr-0">
                                                                                <?php if($timesheetSettings->billable === "1") : ?>
                                                                                <div class="form-check form-check-inline">
                                                                                    <div class="checkbox checkbox-sec">
                                                                                        <input class="form-check-input weekly-billable" id="billable_3" type="checkbox" name="billable[]" value="1" onchange="showHiddenFields(this)">
                                                                                        <label class="form-check-label" for="billable_3">Billable(/hr)</label>
                                                                                    </div>
                                                                                </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="sunday_field"><input type="text" name="sunday_hours[]" class="form-control day-input"></td>
                                                                    <td class="monday_field"><input type="text" name="monday_hours[]" class="form-control day-input"></td>
                                                                    <td class="tuesday_field"><input type="text" name="tuesday_hours[]" class="form-control day-input"></td>
                                                                    <td class="wednesday_field"><input type="text" name="wednesday_hours[]" class="form-control day-input"></td>
                                                                    <td class="thursday_field"><input type="text" name="thursday_hours[]" class="form-control day-input"></td>
                                                                    <td class="friday_field"><input type="text" name="friday_hours[]" class="form-control day-input"></td>
                                                                    <td class="saturday_field"><input type="text" name="saturday_hours[]" class="form-control day-input"></td>
                                                                    <td class="total-cell"></td>
                                                                    <td><a href="#" class="deleteRow h4"><i class="fa fa-trash"></i></a></td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="text-right">
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
                                                            </tfoot>
                                                        </table>
                                                    </div>

                                                    <div class="table-footer">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="button" id="add-table-line" class="btn btn-outline-secondary border" data-target="#timesheet-table">Add lines</button>
                                                                <button type="button" id="clear-table-line" class="btn btn-outline-secondary border" data-target="#timesheet-table">Clear all lines</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <div class="row w-100">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-4 d-flex">
                                <a href="#" class="text-white m-auto" id="copy-last-timesheet">Copy last timesheet</a>
                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group dropup float-right">
                                    <button type="button" class="btn btn-success" id="save-and-new">
                                        Save and new
                                    </button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="save-and-close">Save and close</a>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary btn-rounded border float-right mr-2" id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of modal-->
    </form>
</div>