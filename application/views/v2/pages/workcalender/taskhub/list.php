<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>
<style>
.nsm-profile-name{
  margin-top:9px;  
}
.taskhub-list .nsm-badge{
    font-size:14px;

}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li>
            <div class="nsm-fab-icon">
                <i class="bx bx-check"></i>
            </div>
            <span class="nsm-fab-label">Clear All</span>
        </li>
        <!-- <li>
            <div class="nsm-fab-icon">
                <i class="bx bx-search"></i>
            </div>
            <span class="nsm-fab-label">Search Task</span>
        </li> -->
        <li onclick="location.href='<?php echo base_url('taskhub/create') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add Task</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/taskhub_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">
                            You can set up Tasks for yourself and assign them to other people in your organization.
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2" id="task-completed">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo isset($total_backlog) ? $total_backlog : 0; ?></h2>
                                    <span>BACKLOG</span>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2 " id="task-ongoing">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo isset($total_task_doing) ? $total_task_doing : 0; ?></h2>
                                    <span>DOING</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2" id="task-completed">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo isset($total_task_review_fail) ? $total_task_review_fail : 0; ?></h2>
                                    <span>REVIEW FAIL</span>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2" id="task-completed">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo isset($total_task_on_testing) ? $total_task_on_testing : 0; ?></h2>
                                    <span>ON TESTING</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2 " id="task-ongoing">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo isset($total_task_review) ? $total_task_review : 0; ?></h2>
                                    <span>REVIEW</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2" id="task-completed">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo isset($total_task_done) ? $total_task_done : 0; ?></h2>
                                    <span>DONE</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2 " id="task-ongoing">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo isset($total_task_closed) ? $total_task_closed : 0; ?></h2>
                                    <span>CLOSED</span>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
 
                <div class="row">

             
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('taskhub') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Find task" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>   

                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>           
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Status</label>
                                        <select class="nsm-field form-select filter-task-hub-type" name="filter_type" id="filter-task-hub-type">            
                                            <option value="0" <?=$status == 0 ? 'selected' : ''?>>All</option>
                                            <option value="1" <?=$status == 1 ? 'selected' : ''?>>New</option>
                                            <option value="2" <?=$status == 2 ? 'selected' : ''?>>On Going</option>
                                            <option value="3" <?=$status == 3 ? 'selected' : ''?>>On Hold</option>
                                            <option value="4" <?=$status == 4 ? 'selected' : ''?>>Resumed</option>
                                            <option value="5" <?=$status == 5 ? 'selected' : ''?>>For Evaluation</option>
                                            <option value="6" <?=$status == 6 ? 'selected' : ''?>>Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-filter-subtask-button">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>                            

                            
                            <div class="dropdown d-inline-block">
                                <input type="hidden" class="nsm-field form-control" id="selected_ids">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span>
                                        Batch Actions
                                    </span> <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                    <li><a class="dropdown-item dropdown-item-mark-ongoing disabled" href="javascript:void(0);" id="btn-mark-ongoing"><i class='bx bx-fw bx-pen'></i> Mark Ongoing</a></li>                                                               
                                    <li><a class="dropdown-item dropdown-item-mark-complete disabled" href="javascript:void(0);" id="btn-mark-completed"><i class='bx bx-fw bx-check'></i> Mark Completed</a></li>
                                    <li><a class="dropdown-item dropdown-item-delete disabled" href="javascript:void(0);" id="btn-delete-tasks"><i class='bx bx-fw bx-trash'></i> Delete</a></li>
                                </ul>
                            </div>

                            <?php //if( $selected_customer_id == 0 ){ ?>
                            <!-- <button name="btn_clear" type="button" class="nsm-button btn-clear-all">
                                <i class='bx bx-fw bx-check'></i> Clear All
                            </button> -->
                            <button name="btn_add" type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('taskhub/create'); ?>'">
                                <i class='bx bx-fw bx-plus'></i> Add Task
                            </button>
                            <?php //} ?>
                            <!-- <button name="btn_search" type="button" class="nsm-button">
                                <i class='bx bx-fw bx-search'></i> Search Task
                            </button> -->
                            
                        </div>
                    </div>
                </div>
                
                <div class="nsm-widget-table">
                    <form id="frm-taskhub" method="POST">
                    <table class="nsm-table taskhub-list">
                        <thead>
                            <tr>
                                <td class="table-icon text-center">
                                    <input class="form-check-input table-select select-all-tasks check-input-all-tasks" id="check-input-all-tasks" type="checkbox">
                                </td>
                                <td class="table-icon"></td>
                                <td data-name="Subject" style="width:40%;">Task</td>     
                                <td data-name="Assigned" style="width:20%;">Assigned To</td>           
                                <td data-name="Priority">Priority</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Date Started">Date Started</td>
                                <td data-name="Date Completion">Completion Date</td>
                                <td data-name="Date Created">Date Created</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($tasks) > 0) : ?>
                                <?php foreach ($tasks as $key => $row) : ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon table-checkbox">
                                                <input class="form-check-input select-one table-select check-input-task" id="check-input-task" name="taskId[]" type="checkbox" value="<?=$row->task_id?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-task'></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo url('taskhub/view/' . $row->task_id) ?>'">
                                            <?php echo $row->subject; ?>
                                        </td>   
                                        <td>
                                            <div class="widget-item">
                                                <?php if($row->assigned_employee_ids != null) { ?>
                                                    <table>
                                                        <?php 
                                                            $assignees_json_decode = json_decode($row->assigned_employee_ids);
                                                            if($assignees_json_decode && is_array($assignees_json_decode)) {
                                                                foreach($assignees_json_decode as $uid) {
                                                                    $user_id = (int) $uid;
                                                                    $image = userProfilePicture($user_id);
                                                                    $assignee = $this->users_model->getUser($user_id);
                                                                    if($assignee) {
                                                                        echo '<tr>';
                                                                            echo '<td><div class="nsm-profile" style="background-image: url(' . $image . ');"></div></td>';
                                                                            echo '<td><span class="nsm-profile-name">' . $assignee->FName . ' ' . $assignee->LName . '</span></td>';
                                                                        echo '</tr>';
                                                                    } else {
                                                                        echo 'No Assigned User';
                                                                    }
                                                                }
                                                            } else {
                                                                echo 'No Assigned User';
                                                            }
                                                        ?>
                                                    </table>
                                                <?php }else{ ?>
                                                        No Assigned User
                                                <?php } ?>
                                                
                                            </div>                                
                                        </td>                                       
                                        <td>
                                            <?php
                                            switch ($row->priority):
                                                case 'High':
                                                    $class_priority = "error";
                                                    break;
                                                case 'Medium':
                                                    $class_priority = "secondary";
                                                    break;
                                                case 'Low':
                                                    $class_priority = "";
                                                    break;
                                            endswitch;
                                            ?>
                                            <span class="nsm-badge <?= $class_priority ?>"><?php echo ucwords($row->priority); ?></span>
                                        </td>
                                        <td>
                                        <?php
                                            switch ($row->status):
                                                case 'New':
                                                    $task_status = "primary";
                                                    break;
                                                case 'Resumed':
                                                    $task_status = "primary";
                                                    break;
                                                case 'On Hold':
                                                    $task_status = "error";
                                                    break;
                                                case 'Completed':
                                                    $task_status = "success";
                                                    break;
                                                case 'Complete':
                                                    $task_status = "success";
                                                    break;
                                                case 'Closed':
                                                    $task_status = "success";
                                                    break;
                                                case 'Re-opened':
                                                    $task_status = "primary";
                                                    break;
                                                case 'On Going':
                                                    $task_status = "secondary";
                                                    break;
                                                default:
                                                    $task_status = "";
                                                    break;
                                            endswitch;
                                            ?>

                                            <span class="nsm-badge <?= $task_status ?>"><?= $row->status != '' ? $row->status == 'Closed' ? 'Completed' : $row->status : 'Draft'; ?></span>
                                        </td>
                                        <td>
                                            <?php //echo date("F d, Y", strtotime($row->date_started)); ?>
                                            <?php 
                                                $date_started = "--";
                                                if($row->date_started != null) {
                                                    $date_started = date("F d, Y", strtotime($row->date_started));
                                                } else {
                                                    $date_started = date("F d, Y", strtotime($row->date_created));
                                                }
                                                echo $date_started;
                                            ?>
                                        </td>
                                        <td>
                                            <?php //echo date("F d, Y", strtotime($row->date_completed)); ?>
                                            <?php 
                                                $date_completed = '--';
                                                if($row->date_completed != null) {
                                                    $date_completed = date("F d, Y", strtotime($row->date_completed));
                                                }
                                                echo $date_completed;
                                            ?>
                                        </td>
                                        <td><?php echo date("F d, Y", strtotime($row->date_created)); ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" name="dropdown_edit" href="<?php echo url('taskhub/edit/' . $row->task_id) ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item btn-delete-task" href="javascript:void(0);" data-subject="<?= $row->subject; ?>" data-id="<?= $row->task_id; ?>">Delete</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item btn-complete-task" name="dropdown_completed" href="javascript:void(0);" data-subject="<?= $row->subject; ?>" data-id="<?= $row->task_id; ?>">Mark Completed</a>
                                                    </li>
                                                    <!-- <li>
                                                        <a class="dropdown-item" name="dropdown_updated" href="<?php echo url('taskhub/addupdate/' . $row->task_id) ?>">Add Update</a>
                                                    </li> -->
                                                    <li>
                                                        <a class="dropdown-item" name="dropdown_view_comments" href="<?php echo url('taskhub/view/' . $row->task_id) ?>">Add Update</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination({itemsPerPage:10});

        $("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");

            _form.submit();
        }, 1000));        

        $("#btn-mark-completed").on("click", function() {

            Swal.fire({
                title: 'Complete All',
                text: "This will mark all selected tasks as completed. Proceed with action?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('taskhub/_complete_selected_tasks'); ?>",
                        dataType: 'json',
                        data: $('#frm-taskhub').serialize(),
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Update Successful!',
                                    text: "Taskhub data is successfully updated!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'An Error Occured',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        //location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });

        $("#btn-mark-ongoing").on("click", function() {

            Swal.fire({
                title: 'Ongoing All',
                text: "This will mark all selected tasks as ongoing. Proceed with action?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('taskhub/_ongoing_selected_tasks'); ?>",
                        dataType: 'json',
                        data: $('#frm-taskhub').serialize(),
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Update Successful!',
                                    text: "Taskhub data is successfully updated!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'An Error Occured',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        //location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });

        $("#btn-delete-tasks").on("click", function() {

            Swal.fire({
                title: 'Delete All',
                text: "This will delete all selected tasks. Proceed with action?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('taskhub/_delete_selected_tasks'); ?>",
                        dataType: 'json',
                        data: $('#frm-taskhub').serialize(),
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Delete Successful!',
                                    text: "Taskhub data is successfully deleted!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'An Error Occured',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        //location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });        

        $(document).on("click", ".btn-complete-task", function() {
            let id = $(this).attr('data-id');
            let subject = $(this).attr("data-subject");

            Swal.fire({
                title: 'Complete Task',
                text: "Are you sure you want to mark as completed task: " + subject + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('taskhub/_task_mark_completed'); ?>",
                        dataType: 'json',
                        data: {
                            tsid: id
                        },
                        success: function(result) {
                            console.log(result);
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Update Successful!',
                                    text: "Taskhub data is successfully updated!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'An Error Occured',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", ".btn-delete-task", function() {
            let id = $(this).attr('data-id');
            let subject = $(this).attr("data-subject");

            Swal.fire({
                title: 'Delete Task',
                text: "Are you sure you want to delete task: " + subject + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('taskhub/_delete_task'); ?>",
                        dataType: 'json',
                        data: {
                            tsid: id
                        },
                        success: function(result) {
                            console.log(result);
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Delete Successful!',
                                    text: "Taskhub data is successfully updated!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'An Error Occured',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        //location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });

        $('#apply-filter-subtask-button').on('click', function() {
            var filterType = $('.filter-task-hub-type').val();            
            //var url = `${base_url}accounting/customers/view/${customerId}?`;
            var url = `${base_url}taskhub?`;
            url += filterType !== 0 ? `status=${filterType}&` : '';
            if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
                url = url.slice(0, -1); 
            }
            location.href = url;
        });        
    });        
</script>
<?php include viewPath('v2/includes/footer'); ?>