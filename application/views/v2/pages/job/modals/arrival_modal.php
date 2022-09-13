<div class="modal fade" id="omw_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Arrival</h4>
            </div>
            <form id="update_status_to_omw" method="post">
            <div class="modal-body">
                <p>This will start travel duration tracking.</p>
                <p>Arrive at:</p>
                <input type="date" name="omw_date" id="omw_date" class="form-control" required>
                <input type="hidden" name="id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                <input type="hidden" name="status" id="status" value="Arrival">
                <select id="omw_time" name="omw_time" class="form-control" required>
                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                        <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <span class="fa fa-paper-plane-o"></span> Save
                </button>
                <button type="button" id="" class="btn btn-default" data-bs-dismiss="modal">
                    <span class="fa fa-remove"></span> Close
                </button>
            </div>
            </form>
        </div>
    </div>
</div>