<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Tasks</span>
            </div>
            <label class="nsm-subtitle">0 Task(s)</label>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <th data-name="Subject">Subject</th>
                                    <th data-name="Date to Complete">Date to Complete</th>
                                    <th data-name="Status">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($task_info)) :
                                    foreach ($task_info as $task) :
                                ?>
                                        <tr>
                                            <td class="fw-bold nsm-text-primary"><?= $task->subject; ?></td>
                                            <td><?= $task->estimated_date_complete; ?></td>
                                            <td><span class="nsm-badge"><?= $task->status_text; ?></span></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else :
                                    ?>
                                    <tr>
                                        <td colspan="3">
                                            <div class="nsm-empty">
                                                <span>No tasks found.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <a href="<?= base_url('taskhub?status=6&cus_id='.$cus_id); ?>" target="_blank">
                    <button role="button" class="nsm-button w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-task'></i> View Completed Tasks
                    </button>
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3 newTask">
                        <i class='bx bx-fw bx-list-plus'></i> Add Task
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade nsm-modal fade" id="estimates_import" tabindex="-1" aria-labelledby="estimates_import_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_estimate_modal_label">New Task</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Subject</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select id="fk_sr_id" name="fk_sr_id"  class="form-control">
                            <option value="1">New</option>
                            <option value="2">On Going</option>
                            <option value="3">On Hold</option>
                            <option value="4">Resumed</option>
                            <option value="5">For Evaluation</option>
                            <option value="6">Complete</option>
                            <option value="7">ReOpened</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Customer</label><br>
                            <b><?= ucwords($profile_info->first_name) . '  ' . ucwords($profile_info->last_name) ?></b>
                            <input type="hidden" class="form-control" name="firstname" id="firstname" value="<?= $profile_info->prof_id ?>"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Assign To</label>
                            <select id="fk_sr_id" name="fk_sr_id"  class="form-control">
                                <?php foreach ($users as $user): ?>
                                    <option  value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="modal-footer">
                <div class="button-modal-list">
                    <button type="button" class="btn btn-primary"><span class="fa fa-paper-plane"></span> Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $(document).on('click', '.newTask', function(){
        $('#estimates_import').modal('show');
    });
});
</script>