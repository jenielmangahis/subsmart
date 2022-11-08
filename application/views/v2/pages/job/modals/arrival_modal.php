<div class="modal fade" id="omw_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Arrival</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="update_status_to_omw" method="post">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                            <label>This will start travel duration tracking.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Arrive at:</label>
                            <div class="input-group mb-3">
                                <input type="date" name="omw_date" id="omw_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                                <select id="omw_time" name="omw_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" name="id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                            <input type="hidden" name="status" id="status" value="Arrival">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary"><i class="bx bx-paper-plane"></i> Save</button>
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>