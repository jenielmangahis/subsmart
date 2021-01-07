<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="singleTimeModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Time Activity</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 offset-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="start_end_time" id="startEndTime" class="form-check-input">
                                <label for="startEndTime">Enter Start and End Time</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control w-50">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select name="name" id="name" class="form-control">
                                    <option value="">Lauren Williams</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select name="customer" id="customer" class="form-control">
                                    <option value="">Betty Fuller</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service">Service</label>
                                <select name="service" id="service" class="form-control">
                                    <option value="">Credit</option>
                                </select>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="billable" id="billable" value="0">
                                <label class="form-check-label" for="billable">Billable(/hr)</label>
                                <input type="number" name="hourly_rate" id="hourlyRate" class="w-25 form-control hide">
                            </div>
                            <div class="form-check hide">
                                <input type="checkbox" name="taxable" id="taxable" class="form-check-input" value="0">
                                <label for="taxable" class="form-check-label">Taxable</label>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group w-50 hide">
                                <label for="startTime">Start time</label>
                                <select name="start_time" id="startTime" class="form-control">
                                    <option value="">12:00 AM</option>
                                </select>
                            </div>
                            <div class="form-group w-50 hide">
                                <label for="endTime">End Time</label>
                                <select name="end_time" id="endTime" class="form-control"></select>
                            </div>
                            <div class="form-group w-50">
                                <label for="breakTime">Time</label>
                                <input type="time" name="break_time" id="breakTime" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control h-auto"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Cancel</button>
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

                            <button type="button" class="btn btn-secondary btn-rounded border">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>