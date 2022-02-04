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

    <?php if(!isset($timeActivity)) : ?>
    <form onsubmit="submitModalForm(event, this)" id="modal-form">
    <?php else : ?>
    <form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/time-activity/<?=$timeActivity->id?>">
    <?php endif; ?>
        <div id="singleTimeModal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="height: 100%;">
                    <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                        <div class="row w-100">
                            <div class="col-6 d-flex align-items-center">
                                <div class="dropdown mr-1">
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
                        <button type="button" id="time-activity-settings-button"><i class="fa fa-cog fa-lg"></i></button>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
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
                                                        value="1" class="form-check-input" <?=isset($timeActivity) && !is_null($timeActivity->start_time) ? 'checked' : ''?>
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
                                                        value="<?=!isset($timeActivity) ? date('m/d/Y') : date('m/d/Y', strtotime($timeActivity->date))?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <select name="name" id="person_tracking" class="form-control" required>
                                                        <option value="" disabled <?=!isset($timeActivity) ? 'selected' : ''?>>Whose time are you tracking?</option>
                                                        <?php if(isset($timeActivity)) : ?>
                                                        <option value="<?=$timeActivity->name_key.'-'.$timeActivity->name_id?>" selected><?=$timeActivity->name?></option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="customer">Customer</label>
                                                    <select name="customer" id="customer" class="form-control" required>
                                                        <option value="" disabled <?=!isset($timeActivity) ? 'selected' : ''?>>Choose a customer</option>
                                                        <?php if(isset($timeActivity)) : ?>
                                                        <option value="<?=$timeActivity->customer_id?>" selected><?=$timeActivity->customer?></option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group <?=$timesheetSettings->service === "0" ? 'hide' : ''?>">
                                                    <label for="service">Service</label>
                                                    <select name="service" id="service" class="form-control" required>
                                                        <option value="" disabled <?=!isset($timeActivity) ? 'selected' : ''?>>Choose the service worked on</option>
                                                        <?php if(isset($timeActivity)) : ?>
                                                        <option value="<?=$timeActivity->service_id?>" selected><?=$timeActivity->service?></option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <?php if($timesheetSettings->billable === "1") : ?>
                                                <div class="form-check form-check-inline">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input class="form-check-input" type="checkbox" name="billable" id="billable" value="1" onchange="showHiddenFields(this)" <?=isset($timeActivity) && $timeActivity->billable === "1" ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                    </div>
                                                    <input type="number" name="hourly_rate" id="hourlyRate" class="w-25 form-control <?=isset($timeActivity) && $timeActivity->billable === "1" ? '' : 'hide'?>" value="<?=isset($timeActivity) && $timeActivity->billable === "1" ? floatval($timeActivity->hourly_rate) : ''?>">
                                                </div>
                                                <div class="form-check <?=isset($timeActivity) && $timeActivity->billable === "1" ? '' : 'hide'?>">
                                                    <div class="checkbox checkbox-sec">
                                                        <input type="checkbox" name="taxable" id="taxable" class="form-check-input" value="1" <?=isset($timeActivity) && $timeActivity->taxable === "1" ? 'checked' : ''?>>
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
                                                        <option value="<?=$time['value']?>" <?=isset($timeActivity) && substr($timeActivity->start_time, 0, -3) === $time['value'] ? 'selected' : ''?>><?=$time['display']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group w-50 hide">
                                                    <label for="endTime">End Time</label>
                                                    <select name="end_time" id="endTime" class="form-control">
                                                        <option disabled selected>&nbsp;</option>
                                                        <?php foreach ($dropdown['times'] as $time) :?>
                                                        <option value="<?=$time['value']?>" <?=isset($timeActivity) && substr($timeActivity->end_time, 0, -3) === $time['value'] ? 'selected' : ''?>><?=$time['display']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group w-50">
                                                    <label for="time">Time</label>
                                                    <input type="text" name="time" id="time" class="form-control" placeholder="hh:mm" required value="<?=isset($timeActivity) && $timeActivity->start_time !== null ? substr($timeActivity->break_duration, 0, -3) : substr($timeActivity->time, 0, -3)?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" class="form-control h-auto"><?=$timeActivity->description?></textarea>
                                                </div>
                                                <?php if(isset($timeActivity)) : ?>
                                                <div class="form-group" id="summary">
                                                    <label for="summary">Summary</label>
                                                    <p><?=$totalTime?></p>
                                                </div>
                                                <?php endif; ?>
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
                            <div class="col-md-4 d-flex">
                                <?php if(isset($timeActivity)) : ?>
                                <a href="#" class="text-white m-auto" id="delete-time-activity">Delete</a>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4">
                                <!-- Split dropup button -->
                                <div class="btn-group dropup float-right ml-2">
                                    <button type="button" class="btn btn-success" onclick="saveAndNewForm(event)">
                                        Save and new
                                    </button>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
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