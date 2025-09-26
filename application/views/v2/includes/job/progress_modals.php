<div class="modal fade" id="status-arrived-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bxs-truck' ></i> Arrival</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-status-arrival" method="post">
                    <input type="hidden" name="jobid" id="jobid" value="<?= $job->id; ?>">
                    <input type="hidden" name="status" value="Arrival">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will start travel duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Arrive at:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="omw_date" id="omw_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                <select id="omw_time" name="omw_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= strtolower($job->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="status-started-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bxs-watch' ></i> Start Job</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-status-started" method="post">
                    <input type="hidden" name="jobid" id="jobid" value="<?= $job->id; ?>">
                    <input type="hidden" name="status" value="Started">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will stop travel duration tracking and start on job duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Start at:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="job_start_date" id="job_start_date" class="form-control" value="<?= date('Y-m-d');?>" required>
                                <select id="job_start_time" name="job_start_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                    <option <?= strtolower($job->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="status-approved-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-pen' ></i> Send eSign - Customer Job Approval</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <form id="frm-status-approved" method="post">
                <input type="hidden" name="jobid" id="esign-job-id" value="<?= $job->id; ?>" />
                <input type="hidden" name="job_customer_id" id="esign-job-customer-id" value="<?= $job->customer_id; ?>" />
                <input type="hidden" name="status" value="Approved">
                <div class="modal-body" id="job-send-esign-container"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="status-finished-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bxs-flag-checkered'></i> Finish Job</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="frm-status-finished" method="post">
                    <input type="hidden" name="jobid" id="jobid" value="<?= $job->id; ?>">
                    <input type="hidden" name="status" value="Finished">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <label>This will stop on job duration tracking and mark the job end time.</label>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="mb-2">Finish job at:</label>
                            <div class="input-group">
                                <input type="date" name="job_finished_date" id="job_finished_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                                <select id="job_finished_time" name="job_finished_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="nsm-button primary">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body"></div>
        </div>
    </div>
</div>