<div class="modal fade" id="start_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Start Job</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="update_status_to_started">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                            <label>This will stop travel duration tracking and start on job duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Start Job At:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="job_start_date" id="job_start_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                                <input type="time" name="job_start_time" class="form-control" value="<?= date("H:i"); ?>" required />
                            </div>
                            <input type="hidden" name="job_id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                            <input type="hidden" name="job_status" id="start_status" value="Started">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary" id="btn-started-status">Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>