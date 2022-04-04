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
                    <button role="button" class="nsm-button w-100 ms-0 mt-3" onclick="location.href='<?= base_url('taskhub?status=6&cus_id='.$cus_id); ?>'">
                        <i class='bx bx-fw bx-task'></i> View Completed Tasks
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-list-plus'></i> Add Task
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>