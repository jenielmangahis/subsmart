<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
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
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-5 offset-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" name="start_end_time" id="startEndTime" value="1" class="form-check-input" onclick="showHiddenFields(this)">
                                                <label for="startEndTime">Enter Start and End Time</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="text" class="form-control w-50 date" name="date" id="date" value="<?php echo date('m/d/Y') ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <select name="name" id="name" class="form-control" required>
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
                                            <div class="form-group">
                                                <label for="customer">Customer</label>
                                                <select name="customer" id="customer" class="form-control" required>
                                                    <option value="" disabled selected>Choose a customer</option>
                                                    <?php foreach($dropdown['customers'] as $customer) :?>
                                                        <option value="<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="service">Service</label>
                                                <select name="service" id="service" class="form-control" required>
                                                    <option value="" disabled selected>Choose the service worked on</option>
                                                    <?php foreach($dropdown['services'] as $service) : ?>
                                                        <option value="<?=$service->id?>"><?=$service->title?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="billable" id="billable" value="1" onclick="showHiddenFields(this)">
                                                <label class="form-check-label" for="billable">Billable(/hr)</label>
                                                <input type="number" name="hourly_rate" id="hourlyRate" class="w-25 form-control hide">
                                            </div>
                                            <div class="form-check hide">
                                                <input type="checkbox" name="taxable" id="taxable" class="form-check-input" value="1">
                                                <label for="taxable" class="form-check-label">Taxable</label>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group w-50 hide">
                                                <label for="startTime">Start time</label>
                                                <select name="start_time" id="startTime" class="form-control">
                                                    <option disabled selected>&nbsp;</option>
                                                    <?php foreach($dropdown['times'] as $time) :?>
                                                        <option value="<?php echo $time['value']; ?>"><?php echo $time['display']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group w-50 hide">
                                                <label for="endTime">End Time</label>
                                                <select name="end_time" id="endTime" class="form-control">
                                                    <option disabled selected>&nbsp;</option>
                                                    <?php foreach($dropdown['times'] as $time) :?>
                                                        <option value="<?php echo $time['value']; ?>"><?php echo $time['display']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group w-50">
                                                <label for="time">Time</label>
                                                <input type="text" name="time" id="time" class="form-control" placeholder="hh:mm" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control h-auto"></textarea>
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
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right ml-2">
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

                            <button type="submit" class="btn btn-secondary btn-rounded border float-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>