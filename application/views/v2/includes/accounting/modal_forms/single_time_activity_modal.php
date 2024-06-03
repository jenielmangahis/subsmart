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
        <div id="singleTimeModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col-6 d-flex align-items-center">
                                <div class="dropdown mr-1">
                                    <a href="javascript:void(0);" class="h4 recent-transactions-button" data-bs-toggle="dropdown">
                                        <i class="bx bx-fw bx-history"></i>
                                    </a>
                                    <div class="dropdown-menu p-3" style="width: 500px">
                                        <h5 class="dropdown-header">Recent Time Activities</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-time-activities">
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <span class="modal-title content-title">
                                    Time Activity
                                </span>
                            </div>
                        </div>
                        <button type="button" id="time-activity-settings-button"><i class="bx bx-fw bx-cog"></i></button>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-2">
                                        <label for="date">Date</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="form-control nsm-field date" name="date" id="date" value="<?=!isset($timeActivity) ? date('m/d/Y') : date('m/d/Y', strtotime($timeActivity->date))?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 offset-md-2 d-flex align-items-end">
                                        <div class="form-check">
                                            <input type="checkbox" name="start_end_time" id="startEndTime" value="1" class="form-check-input" <?=isset($timeActivity) && !is_null($timeActivity->start_time) ? 'checked' : ''?> onchange="showHiddenFields(this)">
                                            <label for="startEndTime">Enter Start and End Time</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <div class="grid-mb">
                                            <label for="name">Name</label>
                                            <select name="person_tracking" id="person_tracking" class="form-control nsm-field" required>
                                                <option value="" disabled <?=!isset($timeActivity) ? 'selected' : ''?>>Whose time are you tracking?</option>
                                                <?php if(isset($timeActivity)) : ?>
                                                <option value="<?=$timeActivity->name_key.'-'.$timeActivity->name_id?>" selected><?=$timeActivity->name?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="grid-mb">
                                            <label for="customer">Customer</label>
                                            <select name="customer" id="customer" class="form-control nsm-field" required>
                                                <option value="" disabled <?=!isset($timeActivity) ? 'selected' : ''?>>Choose a customer</option>
                                                <?php if(isset($timeActivity)) : ?>
                                                <option value="<?=$timeActivity->customer_id?>" selected><?=$timeActivity->customer?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="grid-mb" <?=!is_null($timesheetSettings) && $timesheetSettings->service === "0" ? 'style="display: none"' : ''?>>
                                            <label for="service">Service</label>
                                            <select name="service" id="service" class="form-control nsm-field" required>
                                                <option value="" disabled <?=!isset($timeActivity) ? 'selected' : ''?>>Choose the service worked on</option>
                                                <?php if(isset($timeActivity)) : ?>
                                                <option value="<?=$timeActivity->service_id?>" selected><?=$timeActivity->service?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <?php if(is_null($timesheetSettings) || $timesheetSettings->billable === "1") : ?>
                                        <div class="row">
                                            <div class="col-4 d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="billable" id="billable" value="1" onchange="showHiddenFields(this)" <?=isset($timeActivity) && $timeActivity->billable === "1" ? 'checked' : ''?>>
                                                    <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <input type="number" name="hourly_rate" id="hourlyRate" step=".01" class="form-control nsm-field text-end" <?=isset($timeActivity) && $timeActivity->billable === "1" ? '' : 'style="display: none"'?> value="<?=isset($timeActivity) && $timeActivity->billable === "1" ? number_format(floatval(str_replace(',', '', $timeActivity->hourly_rate)), 2) : '0.00'?>" onchange="convertToDecimal(this)">
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check" <?=isset($timeActivity) && $timeActivity->billable === "1" ? '' : 'style="display: none"'?>>
                                                    <input type="checkbox" name="taxable" id="taxable" class="form-check-input" value="1" <?=isset($timeActivity) && $timeActivity->taxable === "1" ? 'checked' : ''?>>
                                                    <label for="taxable" class="form-check-label">Taxable</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12 col-md-4 offset-md-2">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="grid-mb" <?=isset($timeActivity) && $timeActivity->start_time !== "" && !is_null($timeActivity->start_time) ? '' : 'style="display: none"'?>>
                                                    <label for="startTime">Start time</label>
                                                    <select name="start_time" id="startTime" class="form-control nsm-field">
                                                        <option disabled selected>&nbsp;</option>
                                                        <?php foreach ($dropdown['times'] as $time) :?>
                                                        <option value="<?=$time['value']?>" <?=isset($timeActivity) && substr($timeActivity->start_time, 0, -3) === $time['value'] ? 'selected' : ''?>><?=$time['display']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="grid-mb" <?=isset($timeActivity) && $timeActivity->start_time !== "" && !is_null($timeActivity->start_time) ? '' : 'style="display: none"'?>>
                                                    <label for="endTime">End Time</label>
                                                    <select name="end_time" id="endTime" class="form-control nsm-field">
                                                        <option disabled selected>&nbsp;</option>
                                                        <?php foreach ($dropdown['times'] as $time) :?>
                                                        <option value="<?=$time['value']?>" <?=isset($timeActivity) && substr($timeActivity->end_time, 0, -3) === $time['value'] ? 'selected' : ''?>><?=$time['display']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="grid-mb <?=isset($timeActivity) && $timeActivity->start_time !== "" && !is_null($timeActivity->start_time) ? 'd-none' : ''?>">
                                                    <label for="time"><?=isset($timeActivity) && $timeActivity->start_time !== "" && !is_null($timeActivity->start_time) ? 'Break' : 'Time'?></label>
                                                    <input type="text" name="time" id="breaktime-a" class="form-control nsm-field" placeholder="hh:mm" required value="<?=isset($timeActivity) && !is_null($timeActivity->start_time) ? substr($timeActivity->break_duration, 0, -3) : substr($timeActivity->time, 0, -3)?>">
                                                </div>
                                                <div class="grid-mb <?=isset($timeActivity) && $timeActivity->start_time !== "" && !is_null($timeActivity->start_time) ? '' : 'd-none'?>">
                                                    <label for="break">Break</label>
                                                    <input type="text" name="break" id="breaktime-b" class="form-control nsm-field" placeholder="hh:mm" value="<?=isset($timeActivity) ? substr($timeActivity->break_duration, 0, -3) : ''?>">
                                                </div>
                                                <div class="grid-mb">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" class="form-control nsm-field"><?=$timeActivity->description?></textarea>
                                                </div>
                                                <?php if(isset($timeActivity)) : ?>
                                                <div id="summary">
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
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col-md-4">
                                <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-4 d-flex">
                                <?php if(isset($timeActivity)) : ?>
                                <a href="#" class="text-dark text-decoration-none m-auto" id="delete-time-activity">Delete</a>
                                <?php endif; ?>
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

                                <!-- <button type="button" class="nsm-button float-end" id="save">Save</button> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end of modal-->
        
    </form>
    <script>
           $(document).ready(function(){

                $('#time').datetimepicker({
                    format: 'LT'
                });

                $('#breaktime-a').datetimepicker({
                    format: 'LT'
                });

                $('#breaktime-b').datetimepicker({
                    format: 'LT'
                });
            });
    </script>
</div>