<?php
if ($tasks) :
    $task_limit = 4;
    $task_count = 0;
    foreach ($tasks as $task) :
        switch ($task->priority):
            case 'High':
                $class = "error";
                break;
            case 'Medium':
                $class = "default";
                break;
            case 'Low':
                $class = "success";
                break;
        endswitch;

        $assignee = $task->FName == "";
        $assignee_class = $assignee ? '' : 'success';

        if ($task->is_assigned == 1) :
            if ($task_count < $task_limit) :
?>
                <div class="nsm-taskhub-item <?= $class ?>" onclick="window.open('<?= base_url('taskhub/view/'.$task->task_id) ?>', '_blank', 'location=yes,height=1080,width=1280,scrollbars=yes,status=yes');">
                    <div class="taskhub-header">
                        <span><?= strtoupper($task->priority . ' priority') ?></span>
                    </div>
                    <div class="task-content">
                        <div class="row">
                            <div class="col-12 col-lg-7 mb-2">
                                <span class="content-title"><?php echo ucfirst($task->subject) ?></span>
                                <span class="content-subtitle d-block"><?= ucfirst(strtolower($task->description)) ?></span>
                            </div>
                            <div class="col-12 col-lg-5 d-flex flex-column justify-content-evenly align-items-end">
                                <span class="nsm-badge <?= $assignee_class ?>"><?= ($assignee ? 'Unassigned' : ucfirst($task->FName)) ?></span>
                                <span class="content-subtitle d-block"><?= date('F d, Y', strtotime($task->estimated_date_complete)) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            endif;
            $task_count++;
        endif;
    endforeach;
else :
    ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Task hub is empty.</span>
    </div>
<?php
endif;
?>