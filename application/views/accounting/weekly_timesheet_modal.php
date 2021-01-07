<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="weeklyTimesheetModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Weekly Timesheet</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="employee" id="employee" class="form-control">
                                <option value="">Joshua Pemberton</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="week_dates" id="weekDates" class="form-control">
                                <option value="">1/3/2021 to 1/9/2021</option>
                            </select>
                        </div>
                        <div class="col text-right">
                            <p class="m-0">TOTAL HOURS</p>
                            <h2 class="m-0">0:00</h2>
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
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th>#</th>
                                            <th class="w-50">DETAILS</th>
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
                                                            <select name="customer" id="customer" class="form-control">
                                                                <option value="">Betty Fuller</option>
                                                            </select>
                                                            <select name="service" id="service" class="form-control">
                                                                <option value="">Credit</option>
                                                            </select>
                                                            <textarea name="description" id="description" class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-end">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="billable" id="billable" value="0">
                                                                <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                                <input type="number" name="hourly_rate" id="hourlyRate" class="ml-2 w-25 form-control hide">
                                                                <input type="checkbox" name="taxable" id="taxable" class="ml-2 form-check-input hide" value="0">
                                                                <label class="form-check-label hide" for="taxable">Taxable</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="number" name="sunday_hours" id="sundayHours" class="form-control"></td>
                                                <td><input type="number" name="monday_hours" id="mondayHours" class="form-control"></td>
                                                <td><input type="number" name="tuesday_hours" id="tuesdayHours" class="form-control"></td>
                                                <td><input type="number" name="wednesday_hours" id="wednesdayHours" class="form-control"></td>
                                                <td><input type="number" name="thursday_hours" id="thursdayHours" class="form-control"></td>
                                                <td><input type="number" name="friday_hours" id="fridayHours" class="form-control"></td>
                                                <td><input type="number" name="saturday_hours" id="saturdayHours" class="form-control"></td>
                                                <td></td>
                                                <td><a href="#" class="h4"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <div class="row m-0">
                                                        <div class="col-md-6 p-0">
                                                            <select name="customer" id="customer" class="form-control">
                                                                <option value="">Betty Fuller</option>
                                                            </select>
                                                            <select name="service" id="service" class="form-control">
                                                                <option value="">Credit</option>
                                                            </select>
                                                            <textarea name="description" id="description" class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-end">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="billable" id="billable" value="0">
                                                                <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                                <input type="number" name="hourly_rate" id="hourlyRate" class="ml-2 w-25 form-control hide">
                                                                <input type="checkbox" name="taxable" id="taxable" class="ml-2 form-check-input hide" value="0">
                                                                <label class="form-check-label hide" for="taxable">Taxable</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="number" name="sunday_hours" id="sundayHours" class="form-control"></td>
                                                <td><input type="number" name="monday_hours" id="mondayHours" class="form-control"></td>
                                                <td><input type="number" name="tuesday_hours" id="tuesdayHours" class="form-control"></td>
                                                <td><input type="number" name="wednesday_hours" id="wednesdayHours" class="form-control"></td>
                                                <td><input type="number" name="thursday_hours" id="thursdayHours" class="form-control"></td>
                                                <td><input type="number" name="friday_hours" id="fridayHours" class="form-control"></td>
                                                <td><input type="number" name="saturday_hours" id="saturdayHours" class="form-control"></td>
                                                <td></td>
                                                <td><a href="#" class="h4"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <div class="row m-0">
                                                        <div class="col-md-6 p-0">
                                                            <select name="customer" id="customer" class="form-control">
                                                                <option value="">Betty Fuller</option>
                                                            </select>
                                                            <select name="service" id="service" class="form-control">
                                                                <option value="">Credit</option>
                                                            </select>
                                                            <textarea name="description" id="description" class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-end">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="billable" id="billable" value="0">
                                                                <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                                <input type="number" name="hourly_rate" id="hourlyRate" class="ml-2 w-25 form-control hide">
                                                                <input type="checkbox" name="taxable" id="taxable" class="ml-2 form-check-input hide" value="0">
                                                                <label class="form-check-label hide" for="taxable">Taxable</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="number" name="sunday_hours" id="sundayHours" class="form-control"></td>
                                                <td><input type="number" name="monday_hours" id="mondayHours" class="form-control"></td>
                                                <td><input type="number" name="tuesday_hours" id="tuesdayHours" class="form-control"></td>
                                                <td><input type="number" name="wednesday_hours" id="wednesdayHours" class="form-control"></td>
                                                <td><input type="number" name="thursday_hours" id="thursdayHours" class="form-control"></td>
                                                <td><input type="number" name="friday_hours" id="fridayHours" class="form-control"></td>
                                                <td><input type="number" name="saturday_hours" id="saturdayHours" class="form-control"></td>
                                                <td></td>
                                                <td><a href="#" class="h4"><i class="fa fa-trash"></i></a></td>
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
                                                <td>0:00</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="timesheet-table-footer">
                                    <button type="button" class="btn btn-outline-secondary border">Add lines</button>
                                    <button type="button" class="btn btn-outline-secondary border">Clear all lines</button>
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
                                <button type="button" class="btn btn-success">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and close</a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary btn-rounded border float-right mr-2" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>