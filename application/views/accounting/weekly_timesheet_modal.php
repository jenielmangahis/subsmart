<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="weeklyTimesheetModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form onsubmit="submitModalForm(event, this)" id="modal-form">
                <div class="modal-content" style="height: 100%;">
                    <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                        <h4 class="modal-title">Weekly Timesheet</h4>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <div class="modal-body">
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
                                            <option value="vendor-<?php echo $vendor->id;?>"><?php echo $vendor->f_name . ' ' . $vendor->l_name;?></option>
                                        <?php endforeach; ?> 
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="week_dates" id="weekDates" class="form-control" required onchange="tableWeekDate()">
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
                                <span class="float-right h4 ml-1">
                                    <a href="#"><i class="fa fa-cog"></i></a>
                                </span>
                                <span class="float-right h4">
                                    <a href="#"><i class="fa fa-print"></i></a>
                                </span>
                            </div>
                            <div class="col-md-12">
                                <div class="timesheet-table-container">
                                    <div class="timesheet-table">
                                        <table class="table table-bordered table-hover" id="timesheet-table">
                                            <thead>
                                                <th>#</th>
                                                <th width="45%">DETAILS</th>
                                                <th class="text-right">
                                                    <p class="m-0">SUN</p>
                                                    <p class="m-0">3</p>
                                                </th>
                                                <th class="text-right">
                                                    <p class="m-0">MON</p>
                                                    <p class="m-0">4</p>
                                                </th>
                                                <th class="text-right">
                                                    <p class="m-0">TUE</p>
                                                    <p class="m-0">5</p>
                                                </th>
                                                <th class="text-right">
                                                    <p class="m-0">WED</p>
                                                    <p class="m-0">6</p>
                                                </th>
                                                <th class="text-right">
                                                    <p class="m-0">THU</p>
                                                    <p class="m-0">7</p>
                                                </th>
                                                <th class="text-right">
                                                    <p class="m-0">FRI</p>
                                                    <p class="m-0">8</p>
                                                </th>
                                                <th class="text-right">
                                                    <p class="m-0">SAT</p>
                                                    <p class="m-0">9</p>
                                                </th>
                                                <th class="text-right">TOTAL</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <div class="row m-0">
                                                            <div class="col-md-6 p-0">
                                                                <select name="customer[]" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach($dropdown['customers'] as $customer):?>
                                                                        <option value="<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <select name="service[]" class="form-control">
                                                                    <option value="">Credit</option>
                                                                </select>
                                                                <textarea name="description[]" class="form-control"></textarea>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-end pr-0">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input weekly-billable" type="checkbox" name="billable[]" value="1" onclick="showHiddenFields(this)">
                                                                    <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="sunday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="monday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="tuesday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="wednesday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="thursday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="friday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="saturday_hours[]" class="form-control day-input"></td>
                                                    <td class="total-cell"></td>
                                                    <td><a href="#" class="deleteRow h4"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>
                                                        <div class="row m-0">
                                                            <div class="col-md-6 p-0">
                                                                <select name="customer[]" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach($dropdown['customers'] as $customer):?>
                                                                        <option value="<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <select name="service[]" class="form-control">
                                                                    <option value="">Credit</option>
                                                                </select>
                                                                <textarea name="description[]" class="form-control"></textarea>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-end pr-0">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input weekly-billable" type="checkbox" name="billable[]" value="1" onclick="showHiddenFields(this)">
                                                                    <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="sunday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="monday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="tuesday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="wednesday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="thursday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="friday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="saturday_hours[]" class="form-control day-input"></td>
                                                    <td class="total-cell"></td>
                                                    <td><a href="#" class="deleteRow h4"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>
                                                        <div class="row m-0">
                                                            <div class="col-md-6 p-0">
                                                                <select name="customer[]" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach($dropdown['customers'] as $customer):?>
                                                                        <option value="<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <select name="service[]" class="form-control">
                                                                    <option value="">Credit</option>
                                                                </select>
                                                                <textarea name="description[]" class="form-control"></textarea>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-end pr-0">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input weekly-billable" type="checkbox" name="billable[]" value="1" onclick="showHiddenFields(this)">
                                                                    <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="sunday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="monday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="tuesday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="wednesday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="thursday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="friday_hours[]" class="form-control day-input"></td>
                                                    <td><input type="text" name="saturday_hours[]" class="form-control day-input"></td>
                                                    <td class="total-cell"></td>
                                                    <td><a href="#" class="deleteRow h4"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-right">
                                                    <td></td>
                                                    <td>TOTAL</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>00:00</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="timesheet-table-footer">
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
                    <div class="modal-footer bg-secondary">
                        <div class="row w-100">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group dropup float-right">
                                    <button type="submit" class="btn btn-success">
                                        Save and new
                                    </button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Save and close</a>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-secondary btn-rounded border float-right mr-2">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!--end of modal-->
</div>