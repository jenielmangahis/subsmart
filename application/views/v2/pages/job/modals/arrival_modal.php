<div class="modal fade nsm-modal" id="omw_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Arrival</span>
                <button type="button" data-bs-dismiss="modal" aria-label="name-button" name="name-button"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <form id="update_status_to_omw" method="post">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <p>This will start travel duration tracking.</p>
                        <p>Arrive at:</p>
                        <input type="date" name="omw_date" id="omw_date" class="form-control mb-2" value="<?php echo date('Y-m-d');?>" required>
                        <input type="hidden" name="id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                        <input type="hidden" name="status" id="status" value="Arrival">
                        <select id="omw_time" name="omw_time" class="form-control" required>
                            <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="nsm-button primary"><i class='bx bx-paper-plane'></i> Save</button>
                    <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>