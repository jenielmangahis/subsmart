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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form onsubmit="submitModalForm(event, this)" id="modal-form">
        <div id="singleTimeModal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="height: 100%;">
                    <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                        <div class="row w-100">
                            <div class="col-6 d-flex align-items-center">
                                <div class="dropup mr-1">
                                    <a href="javascript:void(0);" class="h4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-history fa-lg"></i>
                                    </a>
                                    <div class="dropdown-menu" style="width: 500px">
                                        <h5 class="dropdown-header">Recent Time Activities</h5>
                                        <table class="table table-borderless table-hover cursor-pointer" id="recent-time-activities">
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <h4 class="modal-title">
                                    Time Activity
                                </h4>
                            </div>
                        </div>
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
                                            <div class="col-md-5 offset-md-4">
                                                <div class="checkbox checkbox-sec">
                                                    <input type="checkbox" name="start_end_time" id="startEndTime"
                                                        value="1" class="form-check-input"
                                                        onchange="showHiddenFields(this)">
                                                    <label for="startEndTime">Enter Start and End Time</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="text" class="form-control w-50 date" name="date"
                                                        id="date"
                                                        value="<?php echo date('m/d/Y') ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <select name="name" id="person_tracking" class="form-control" required>
                                                        <option value="" disabled selected>Whose time are you tracking?</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="customer">Customer</label>
                                                    <select name="customer" id="customer" class="form-control" required>
                                                        <option value="" disabled selected>Choose a customer</option>
                                                    </select>
                                                </div>
                                                <div class="form-group <?=$timesheetSettings->service === "0" ? 'hide' : ''?>">
                                                    <label for="service">Service</label>
                                                    <select name="service" id="service" class="form-control" required>
                                                        <option value="" disabled selected>Choose the service worked on
                                                        </option>
                                                        <?php foreach ($dropdown['services'] as $service) : ?>
                                                        <option
                                                            value="<?=$service->id?>">
                                                            <?=$service->title?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?php if($timesheetSettings->billable === "1") : ?>
                                                <div class="form-check form-check-inline">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input class="form-check-input" type="checkbox" name="billable"
                                                            id="billable" value="1" onchange="showHiddenFields(this)">
                                                        <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                    </div>
                                                    <input type="number" name="hourly_rate" id="hourlyRate"
                                                        class="w-25 form-control hide">
                                                </div>
                                                <div class="form-check hide">
                                                    <div class="checkbox checkbox-sec">
                                                        <input type="checkbox" name="taxable" id="taxable"
                                                            class="form-check-input" value="1">
                                                        <label for="taxable" class="form-check-label">Taxable</label>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group w-50 hide">
                                                    <label for="startTime">Start time</label>
                                                    <select name="start_time" id="startTime" class="form-control">
                                                        <option disabled selected>&nbsp;</option>
                                                        <?php foreach ($dropdown['times'] as $time) :?>
                                                        <option
                                                            value="<?php echo $time['value']; ?>">
                                                            <?php echo $time['display']; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group w-50 hide">
                                                    <label for="endTime">End Time</label>
                                                    <select name="end_time" id="endTime" class="form-control">
                                                        <option disabled selected>&nbsp;</option>
                                                        <?php foreach ($dropdown['times'] as $time) :?>
                                                        <option
                                                            value="<?php echo $time['value']; ?>">
                                                            <?php echo $time['display']; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group w-50">
                                                    <label for="time">Time</label>
                                                    <input type="text" name="time" id="time" class="form-control"
                                                        placeholder="hh:mm" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description"
                                                        class="form-control h-auto"></textarea>
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
                                <button type="button" class="btn btn-secondary btn-rounded border"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group dropup float-right ml-2">
                                    <button type="button" class="btn btn-success" id="save-and-new">
                                        Save and new
                                    </button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="save-and-close">Save and close</a>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary btn-rounded border float-right"
                                    id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of modal-->
    </form>
</div>