<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/taskhub/modals'); ?>
<style>
.nsm-profile-name{
  margin-top:9px;  
}
#taskhub-list .nsm-badge{
    font-size:14px;
}
.swal2-html-container{
    overflow:hidden;
}
.task-change-status{
    text-align:left;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <?php if(checkRoleCanAccessModule('taskhub', 'write')){ ?>
    <ul class="nsm-fab-options">        
        <li onclick="location.href='<?= base_url('taskhub/create'); ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-fw bx-task"></i>
            </div>
            <span class="nsm-fab-label">Add Task</span>
        </li>
        <li class="btn-export-list">
            <div class="nsm-fab-icon">
                <i class="bx bx-export"></i>
            </div>
            <span class="nsm-fab-label">Export List</span>
        </li>
        <li id="btn-mobile-archived">
            <div class="nsm-fab-icon">
                <i class='bx bx-archive'></i>
            </div>
            <span class="nsm-fab-label">Archived</span>
        </li>          
    </ul>
    <?php } ?>      
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/taskhub_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/taskhub_subtabs'); ?>
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
                        <div class="nsm-counter success h-100 mb-2" id="task-completed">
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
                        <div class="nsm-counter primary h-100 mb-2 " id="task-ongoing">
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
                        <div class="nsm-counter success h-100 mb-2" id="task-completed">
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
                        <div class="nsm-counter primary h-100 mb-2 " id="task-ongoing">
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
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Task" value="">
                        </div>
                    </div>   

                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter : <?= $filter; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item filter-task" data-status="All" href="javascript:void(0);">All</a></li>
                                <?php foreach($status_selection as $status){ ?>
                                    <li><a class="dropdown-item filter-task" data-status="<?= $status; ?>" href="javascript:void(0);"><?= $status; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if( checkRoleCanAccessModule('taskhub', 'write') ){ ?>  
                            <div class="dropdown d-inline-block show">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item btn-with-selected" id="with-selected-change-status" href="javascript:void(0);" data-action="change-status">Change Status</a></li>   
                                    <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if( checkRoleCanAccessModule('taskhub', 'write') ){ ?>                              
                            <div class="btn-group nsm-main-buttons">
                                <button type="button" class="btn btn-nsm" id="btn-add-task"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Task</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" id="btn-archived" href="javascript:void(0);">Archived</a></li>                               
                                    <li><a class="dropdown-item" id="btn-export-list" href="javascript:void(0);">Export</a></li>                               
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <div class="nsm-widget-table">
                    <form id="frm-with-selected">
                    <table class="nsm-table" id="taskhub-list">
                        <thead>
                            <tr>
                                <?php if(checkRoleCanAccessModule('taskhub', 'write')){ ?>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                                <?php } ?>
                                <td class="table-icon"></td>
                                <td data-name="Title" style="width:30%;">Task</td>     
                                <td data-name="Assigned" style="width:15%;">Assigned To</td>           
                                <td data-name="Priority">Priority</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Due Date">Due Date</td>
                                <td data-name="Date Completion">Completion Date</td>
                                <td data-name="Date Created">Date Created</td>
                                <td data-name="Manage" style="width:2%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($tasks) > 0) : ?>
                                <?php foreach ($tasks as $key => $row) : ?>
                                    <tr>
                                        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                                        <td class="show">
                                            <input class="form-check-input row-select table-select" name="tasks[]" type="checkbox" value="<?= $row->task_id; ?>">
                                        </td>
                                        <?php } ?>
                                        <td class="show">
                                            <div class="table-row-icon">
                                                <i class='bx bx-task'></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary default show">
                                            <?php echo $row->title; ?>
                                        </td>   
                                        <td>
                                            <div class="d-flex align-items-center">                
                                                <?php 
                                                    if($row->assigned_employee_ids != null) {
                                                        $assignees_json_decode = json_decode($row->assigned_employee_ids);
                                                        if($assignees_json_decode && is_array($assignees_json_decode)) {      
                                                            foreach($assignees_json_decode as $uid) {
                                                                $user_id = (int) $uid;
                                                                $image = userProfilePicture($user_id);
                                                                $assignee = $this->users_model->getUser($user_id);
                                                                if($assignee) {
                                                                    if($image == "") {
                                                                        $firstName = $assignee->FName;
                                                                        $lastName  = $assignee->LName;
                                                                        $user_initial = strtoupper($firstName[0] . $lastName[0]);
                                                                        echo '<div class="nsm-profile" style="background-image: url('. $image . '); width: 40px; margin-right: -10px !important;"><span>' . $user_initial . '</span></div>';
                                                                    } else {
                                                                        echo '<div class="nsm-profile" style="background-image: url('. $image . '); width: 40px; margin-right: -10px !important;"></div>';
                                                                    }
                                                                } else {
                                                                    echo '<div class="nsm-profile" style="background-image: url('. url('uploads/users/default.png') . '); width: 40px; margin-right: -10px !important;"></div>';
                                                                } 
                                                            }
                                                        } else {
                                                            echo '<div class="nsm-profile" style="background-image: url('. url('uploads/users/default.png') . '); width: 40px; margin-right: -10px !important;"></div>';
                                                        }
                                                    } else {
                                                        echo '<div class="nsm-profile" style="background-image: url('. url('uploads/users/default.png') . '); width: 40px; margin-right: -10px !important;"></div>';
                                                    }
                                                ?>                                       
                                            </div>                                            
                                        </td>                                       
                                        <td class="nsm-text-primary">
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
                                        <td class="nsm-text-primary">
                                        <?php
                                            switch ($row->status):
                                                case 'Backlog':
                                                    $task_status = "warning";
                                                    break;
                                                case 'Doing':
                                                    $task_status = "primary";
                                                    break;
                                                case 'Review Fail':
                                                    $task_status = "error";
                                                    break;
                                                case 'On Testing':
                                                    $task_status = "success";
                                                    break;
                                                case 'Review':
                                                    $task_status = "success";
                                                    break;
                                                case 'Done':
                                                    $task_status = "success";
                                                    break;
                                                case 'Closed':
                                                    $task_status = "primary";
                                                    break;
                                                default:
                                                    $task_status = "";
                                                    break;
                                            endswitch;
                                            ?>
                                            <span class="nsm-badge <?= $task_status ?>"><?= $row->status != '' ? $row->status : 'Draft'; ?></span>
                                        </td>
                                        <td>
                                            <?php //echo date("F d, Y", strtotime($row->date_started)); ?>
                                            <?php 
                                                $dude_date = "--";
                                                if($row->date_due != NULL) {
                                                    $dude_date = date("m/d/Y", strtotime($row->date_due));
                                                }

                                                echo $dude_date;
                                            ?>
                                        </td>
                                        <td>
                                            <?php //echo date("F d, Y", strtotime($row->date_completed)); ?>
                                            <?php 
                                                $date_completed = '--';
                                                if($row->date_completed != null) {
                                                    $date_completed = date("m/d/Y", strtotime($row->date_completed));
                                                }
                                                echo $date_completed;
                                            ?>
                                        </td>
                                        <td><?php echo date("m/d/Y", strtotime($row->date_created)); ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php if( checkRoleCanAccessModule('taskhub', 'write') ){ ?>  
                                                        <li>
                                                            <a class="dropdown-item" name="dropdown_edit" href="<?php echo url('taskhub/edit/' . $row->task_id) ?>">Edit</a>
                                                        </li>
                                                        <?php if( $row->status != 'Done' && $row->status != 'Closed' ){ ?>
                                                        <li>
                                                            <a class="dropdown-item btn-complete-task" name="dropdown_completed" href="javascript:void(0);" data-title="<?= $row->title; ?>" data-id="<?= $row->task_id; ?>">Mark Completed</a>
                                                        </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if( checkRoleCanAccessModule('taskhub', 'delete') ){ ?>  
                                                    <li>
                                                        <a class="dropdown-item btn-delete-task" href="javascript:void(0);" data-title="<?= $row->title; ?>" data-id="<?= $row->task_id; ?>">Delete</a>
                                                    </li>
                                                    <?php } ?>                                                    
                                                    <li>
                                                        <a class="dropdown-item" name="dropdown_view_comments" href="<?php echo url('taskhub/view/' . $row->task_id) ?>">View</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="10">
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
        <?php if( checkRoleCanAccessModule('taskhub', 'write') ){ ?>  
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
        <?php } ?>

        <?php if( checkRoleCanAccessModule('taskhub', 'delete') ){ ?>  
        $("#btn-delete-tasks").on("click", function() {

            Swal.fire({
                title: 'Delete Tasks',
                html: "This will delete all selected tasks. Proceed with action?",
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
        <?php } ?>
        
    });        
</script>
<?php include viewPath('v2/pages/workcalender/taskhub/js/list'); ?>
<?php include viewPath('v2/includes/footer'); ?>